<?php

namespace App\Livewire\VillageBanking\Loans;

use App\Models\User;
use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\Loan;
use App\Models\VillageBanking\Month;
use App\Models\VillageBanking\VillageBankMember;
use App\Services\LoanEligibilityService;
use App\Traits\HasVillageBankScope;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.main.master-livewire')]
class LoanRequest extends Component
{
    use HasVillageBankScope;
    public $circleId = '';
    public $monthId = '';
    public $borrowerId = '';
    public $amount = '';
    public $interestRate = 20;
    public $duration = 1;

    public $successMessage = '';

    /* ── Eligibility data (populated when borrower+month are set) ── */
    public $eligibility = null;

    public function mount()
    {
        $this->autoSelectCurrentCircleAndMonth();
    }

    /**
     * Auto-select the circle + month whose date range covers today.
     */
    protected function autoSelectCurrentCircleAndMonth()
    {
        $today = Carbon::today();

        // Find the active month that covers today's date
        $currentMonth = Month::where('status', 'active')
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->first();

        if (!$currentMonth) return;

        // Only use it if its circle belongs to a scoped village bank
        $circle = Circle::where('id', $currentMonth->circle_id)
            ->where('status', 'active')
            ->first();

        if (!$circle) return;

        // Check VB scope (if user has a selected village bank)
        $scopedIds = $this->scopedCircleQuery()
            ->where('status', 'active')
            ->pluck('id');

        if (!$scopedIds->contains($circle->id)) return;

        $this->circleId = (string) $circle->id;
        $this->loadDefaults();
        $this->monthId = (string) $currentMonth->id;
    }

    protected function rules()
    {
        return [
            'circleId'     => 'required|exists:circles,id',
            'monthId'      => 'required|exists:months,id',
            'borrowerId'   => 'required|exists:users,id',
            'amount'       => 'required|numeric|min:1',
            'interestRate' => 'required|numeric|min:0|max:100',
            'duration'     => 'required|integer|min:1|max:12',
        ];
    }

    protected $messages = [
        'circleId.required'   => 'Select a circle.',
        'monthId.required'    => 'Select a month.',
        'borrowerId.required' => 'Select a borrower.',
        'amount.required'     => 'Loan amount is required.',
        'amount.min'          => 'Amount must be at least 1.',
    ];

    public function updatedCircleId()
    {
        $this->monthId = '';
        $this->borrowerId = '';
        $this->eligibility = null;
        $this->loadDefaults();
    }

    public function updatedMonthId()
    {
        $this->eligibility = null;
        $this->checkEligibility();
    }

    public function updatedBorrowerId()
    {
        $this->eligibility = null;
        $this->checkEligibility();
    }

    /**
     * Load default interest rate and duration from VB config when circle changes.
     */
    protected function loadDefaults()
    {
        if (empty($this->circleId)) return;

        $circle = Circle::with('villageBank.configuration')->find($this->circleId);
        if ($circle && $circle->villageBank && $circle->villageBank->configuration) {
            $config = $circle->villageBank->configuration;
            $this->interestRate = $config->default_interest_rate;
            $this->duration = $config->default_loan_duration;
        }
    }

    /**
     * Compute eligibility when both borrower and month are selected.
     */
    public function checkEligibility()
    {
        if (empty($this->borrowerId) || empty($this->monthId)) {
            $this->eligibility = null;
            return;
        }

        $this->eligibility = LoanEligibilityService::calculate(
            (int) $this->borrowerId,
            (int) $this->monthId
        );
    }

    public function getTotalPayableProperty()
    {
        if (!is_numeric($this->amount) || !is_numeric($this->interestRate) || (float)$this->amount <= 0) {
            return 0;
        }
        return round((float)$this->amount * (1 + (float)$this->interestRate / 100), 2);
    }

    public function submitRequest()
    {
        $this->validate();

        // ── Compliance check: rules + constitution ──
        $month  = Month::findOrFail($this->monthId);
        $circle = Circle::with('villageBank')->findOrFail($this->circleId);

        if ($circle->villageBank) {
            $membership = VillageBankMember::where('village_bank_id', $circle->village_bank_id)
                ->where('user_id', $this->borrowerId)
                ->first();

            if ($membership && ! $membership->isCompliant()) {
                $gaps = $membership->complianceGaps();
                session()->flash('warning', implode(' ', $gaps) . ' Please visit the Compliance Center to resolve this.');
                return;
            }
        }

        if ($month->status !== 'active') {
            session()->flash('warning', 'Loans can only be requested for an active month.');
            return;
        }

        if (!$month->allow_loan_requests) {
            session()->flash('warning', 'Loan requests are not allowed in this month (' . ($month->label ?? 'Month ' . $month->month_number) . ').');
            return;
        }

        // Check borrower is in the circle
        $circle = Circle::findOrFail($this->circleId);
        if (!$circle->members()->where('users.id', $this->borrowerId)->exists()) {
            $this->addError('borrowerId', 'Selected borrower is not a member of this circle.');
            return;
        }

        // Re-check eligibility and enforce limits
        $elig = LoanEligibilityService::calculate((int) $this->borrowerId, (int) $this->monthId);
        if (!empty($elig['errors'])) {
            foreach ($elig['errors'] as $err) {
                session()->flash('warning', $err);
            }
            return;
        }
        if ((float) $this->amount > $elig['max_borrowable']) {
            $this->addError('amount', 'Amount exceeds the maximum borrowable of K' . number_format($elig['max_borrowable'], 2) . '.');
            return;
        }

        $totalPayable = $this->totalPayable;

        Loan::create([
            'borrower_id'         => $this->borrowerId,
            'month_id'            => $this->monthId,
            'amount'              => (float) $this->amount,
            'interest_rate'       => (float) $this->interestRate,
            'duration'            => (int) $this->duration,
            'total_payable'       => $totalPayable,
            'outstanding_balance' => $totalPayable,
            'status'              => 'pending',
        ]);

        $this->reset(['circleId', 'monthId', 'borrowerId', 'amount', 'duration']);
        $this->interestRate = 20;
        $this->eligibility = null;
        $this->resetErrorBag();
        $this->successMessage = 'Loan request submitted. Awaiting approval.';
    }

    /* ── Computed ───────────────────────── */

    public function getCirclesProperty()
    {
        return $this->scopedCircleQuery()
            ->where('status', 'active')
            ->withCount('members')
            ->orderBy('name')
            ->get();
    }

    public function getMonthsProperty()
    {
        if (empty($this->circleId)) return collect();
        return Month::where('circle_id', $this->circleId)->where('status', 'active')->orderBy('month_number')->get();
    }

    public function getMembersProperty()
    {
        if (empty($this->circleId)) return collect();
        return Circle::findOrFail($this->circleId)->members()->where('status', 'active')->orderBy('name')->get();
    }

    public function render()
    {
        return view('livewire.village-banking.loans.loan-request', [
            'circles'      => $this->circles,
            'months'       => $this->months,
            'membersList'  => $this->members,
            'totalPayable' => $this->totalPayable,
        ]);
    }
}
