<?php

namespace App\Http\Livewire\VillageBanking\Shares;

use App\Models\User;
use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\InsuranceConfig;
use App\Models\VillageBanking\InsuranceContribution;
use App\Models\VillageBanking\Loan;
use App\Models\VillageBanking\Month;
use App\Models\VillageBanking\Repayment;
use App\Models\VillageBanking\ShareDeclaration as ShareDeclarationModel;
use App\Models\VillageBanking\VillageBankConfiguration;
use App\Traits\HasVillageBankScope;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShareDeclaration extends Component
{
    use HasVillageBankScope;

    public $circleId = '';
    public $monthId  = '';

    /* ── Share amounts keyed by user_id ──── */
    public $shares = [];

    /* ── Insurance amounts keyed by user_id  */
    public $insuranceAmounts = [];

    /* ── Repayment amounts keyed by user_id ── */
    public $repaymentAmounts = [];
    public $loanBalances     = [];   // user_id => [ 'total' => float, 'loans' => [...] ]
    public $repaymentErrors  = [];

    /* ── Insurance config for the circle ──── */
    public $insuranceType  = '';
    public $insuranceValue = 0;

    /* ── UI ───────────────────────────────── */
    public $showInsuranceModal = false;
    public $configType  = 'fixed';
    public $configValue = '';

    /* ── Share‑unit config (from VB config) ── */
    public $shareUnitAmount  = 200;
    public $minShareAmount   = 200;
    public $maxShareAmount   = 10000;
    public $shareErrors      = [];

    /* ── Lifecycle ────────────────────────── */

    public function mount()
    {
        $this->autoSelectCurrentCircleAndMonth();
    }

    protected function autoSelectCurrentCircleAndMonth()
    {
        $today = Carbon::today();

        // Find an active month whose date range covers today
        $currentMonth = Month::where('status', 'active')
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->first();

        if (!$currentMonth) return;

        $circle = Circle::where('id', $currentMonth->circle_id)
            ->where('status', 'active')
            ->first();

        if (!$circle) return;

        // Only proceed if this circle belongs to the currently selected village bank
        $scopedIds = $this->scopedCircleQuery()
            ->where('status', 'active')
            ->pluck('id');

        if (!$scopedIds->contains($circle->id)) return;

        $this->circleId = (string) $circle->id;
        $this->loadInsuranceConfig();
        $this->loadShareConfig();

        $this->monthId = (string) $currentMonth->id;
        $this->loadExistingDeclarations();
    }

    public function updatedCircleId()
    {
        $this->monthId = '';
        $this->shares  = [];
        $this->insuranceAmounts = [];
        $this->repaymentAmounts = [];
        $this->loanBalances     = [];
        $this->shareErrors      = [];
        $this->repaymentErrors  = [];
        $this->loadInsuranceConfig();
        $this->loadShareConfig();
    }

    public function updatedMonthId()
    {
        $this->shareErrors     = [];
        $this->repaymentErrors = [];
        $this->loadExistingDeclarations();
    }

    /* ── Share‑unit config from VB ────────── */

    public function loadShareConfig()
    {
        if (empty($this->circleId)) {
            $this->shareUnitAmount = 200;
            $this->minShareAmount  = 200;
            $this->maxShareAmount  = 10000;
            return;
        }

        $circle = Circle::find($this->circleId);
        if (!$circle) return;

        $config = VillageBankConfiguration::forBank($circle->village_bank_id);
        $this->shareUnitAmount = (float) $config->share_unit_amount;
        $this->minShareAmount  = $this->shareUnitAmount * (int) $config->min_shares_per_month;
        $this->maxShareAmount  = $this->shareUnitAmount * (int) $config->max_shares_per_month;
    }

    /* ── Insurance config ────────────────── */

    public function loadInsuranceConfig()
    {
        if (empty($this->circleId)) {
            $this->insuranceType  = '';
            $this->insuranceValue = 0;
            return;
        }

        $config = InsuranceConfig::where('circle_id', $this->circleId)->first();
        if ($config) {
            $this->insuranceType  = $config->type;
            $this->insuranceValue = $config->value;
            $this->configType     = $config->type;
            $this->configValue    = $config->value;
        } else {
            $this->insuranceType  = '';
            $this->insuranceValue = 0;
            $this->configType     = 'fixed';
            $this->configValue    = '';
        }
    }

    public function openInsuranceModal()
    {
        $this->showInsuranceModal = true;
    }

    public function saveInsuranceConfig()
    {
        $this->validate([
            'configType'  => 'required|in:percentage,fixed',
            'configValue' => 'required|numeric|min:0',
        ]);

        InsuranceConfig::updateOrCreate(
            ['circle_id' => $this->circleId],
            ['type' => $this->configType, 'value' => $this->configValue]
        );

        $this->loadInsuranceConfig();
        // Pre-fill insurance amounts for members who already have shares
        $this->prefillInsuranceAmounts();
        $this->showInsuranceModal = false;
        session()->flash('message', 'Insurance configuration saved.');
    }

    /* ── Pre-fill insurance from config ──── */

    public function prefillInsuranceAmounts()
    {
        if (empty($this->insuranceType)) {
            return;
        }

        foreach ($this->shares as $userId => $shareVal) {
            if (is_numeric($shareVal) && (float) $shareVal > 0) {
                // Only prefill if the user hasn't entered a manual amount
                if (empty($this->insuranceAmounts[$userId]) || $this->insuranceAmounts[$userId] === '') {
                    $this->insuranceAmounts[$userId] = (string) $this->getInsuranceAmount($shareVal);
                }
            }
        }
    }

    /* ── Auto-fill insurance when share changes ── */

    public function updatedShares($value, $key)
    {
        // Clear previous error for this member
        unset($this->shareErrors[$key]);

        // Validate share amount is a multiple of the unit and within min/max
        if (!empty($value) && is_numeric($value) && (float) $value > 0) {
            $amount = (float) $value;
            $unit   = $this->shareUnitAmount;

            if ($unit > 0 && fmod(round($amount, 2), round($unit, 2)) != 0) {
                $this->shareErrors[$key] = 'Must be a multiple of K' . number_format($unit, 0);
            } elseif ($amount < $this->minShareAmount) {
                $this->shareErrors[$key] = 'Minimum is K' . number_format($this->minShareAmount, 0);
            } elseif ($amount > $this->maxShareAmount) {
                $this->shareErrors[$key] = 'Maximum is K' . number_format($this->maxShareAmount, 0);
            }

            // Auto-compute insurance for that member
            if (!empty($this->insuranceType)) {
                $this->insuranceAmounts[$key] = (string) $this->getInsuranceAmount($value);
            }
        } elseif (empty($value) || !is_numeric($value) || (float) $value <= 0) {
            $this->insuranceAmounts[$key] = '';
        }
    }

    /* ── Load existing declarations ──────── */

    public function loadExistingDeclarations()
    {
        $this->shares           = [];
        $this->insuranceAmounts = [];
        $this->repaymentAmounts = [];
        $this->loanBalances     = [];

        if (empty($this->circleId) || empty($this->monthId)) {
            return;
        }

        $circle = Circle::with('members')->findOrFail($this->circleId);

        // All month IDs for this circle (loans may span any month)
        $circleMonthIds = Month::where('circle_id', $this->circleId)->pluck('id');

        foreach ($circle->members as $member) {
            $existingShare = ShareDeclarationModel::where('user_id', $member->id)
                ->where('month_id', $this->monthId)
                ->first();
            $this->shares[$member->id] = $existingShare ? (string) $existingShare->amount : '';

            $existingInsurance = InsuranceContribution::where('user_id', $member->id)
                ->where('month_id', $this->monthId)
                ->first();
            $this->insuranceAmounts[$member->id] = $existingInsurance ? (string) $existingInsurance->amount : '';

            // Load outstanding loans for this member in this circle
            $loans = Loan::where('borrower_id', $member->id)
                ->whereIn('month_id', $circleMonthIds)
                ->whereIn('status', ['active', 'approved'])
                ->where('outstanding_balance', '>', 0)
                ->orderBy('created_at', 'asc')
                ->get(['id', 'amount', 'total_payable', 'outstanding_balance', 'status', 'created_at']);

            $totalBalance = $loans->sum('outstanding_balance');

            $this->loanBalances[$member->id] = [
                'total' => (float) $totalBalance,
                'loans' => $loans->map(fn ($l) => [
                    'id'        => $l->id,
                    'amount'    => (float) $l->amount,
                    'payable'   => (float) $l->total_payable,
                    'balance'   => (float) $l->outstanding_balance,
                    'status'    => $l->status,
                    'date'      => $l->created_at->format('d M Y'),
                ])->toArray(),
            ];

            $this->repaymentAmounts[$member->id] = '';
        }
    }

    /* ── Calculate insurance for a member ── */

    public function getInsuranceAmount($shareAmount)
    {
        if (empty($this->insuranceType) || empty($shareAmount) || !is_numeric($shareAmount)) {
            return 0;
        }

        if ($this->insuranceType === 'fixed') {
            return (float) $this->insuranceValue;
        }

        return round(((float) $shareAmount * (float) $this->insuranceValue) / 100, 2);
    }

    /* ── Save ALL declarations (shares + insurance) ── */

    public function saveAllDeclarations()
    {
        if (empty($this->circleId) || empty($this->monthId)) {
            session()->flash('warning', 'Please select a circle and month.');
            return;
        }

        $month = Month::findOrFail($this->monthId);
        if ($month->status !== 'active') {
            session()->flash('warning', 'Declarations can only be made for an active month.');
            return;
        }

        // Re-validate all shares before saving
        $this->shareErrors = [];
        $unit = $this->shareUnitAmount;
        $hasErrors = false;

        foreach ($this->shares as $userId => $amount) {
            if (!empty($amount) && is_numeric($amount) && (float) $amount > 0) {
                $amt = (float) $amount;
                if ($unit > 0 && fmod(round($amt, 2), round($unit, 2)) != 0) {
                    $this->shareErrors[$userId] = 'Must be a multiple of K' . number_format($unit, 0);
                    $hasErrors = true;
                } elseif ($amt < $this->minShareAmount) {
                    $this->shareErrors[$userId] = 'Minimum is K' . number_format($this->minShareAmount, 0);
                    $hasErrors = true;
                } elseif ($amt > $this->maxShareAmount) {
                    $this->shareErrors[$userId] = 'Maximum is K' . number_format($this->maxShareAmount, 0);
                    $hasErrors = true;
                }
            }
        }

        if ($hasErrors) {
            session()->flash('warning', 'Please fix the highlighted share amounts before saving.');
            return;
        }

        // Validate repayment amounts don't exceed balances
        $this->repaymentErrors = [];
        foreach ($this->repaymentAmounts as $userId => $repAmt) {
            if (!empty($repAmt) && is_numeric($repAmt) && (float) $repAmt > 0) {
                $balance = $this->loanBalances[$userId]['total'] ?? 0;
                if ((float) $repAmt > $balance + 0.01) {
                    $this->repaymentErrors[$userId] = 'Exceeds balance of K' . number_format($balance, 2);
                    $hasErrors = true;
                }
            }
        }

        if ($hasErrors) {
            session()->flash('warning', 'Please fix the highlighted amounts before saving.');
            return;
        }

        $sharesSaved      = 0;
        $insuranceSaved   = 0;
        $repaymentsSaved  = 0;
        $totalRepaid      = 0;

        foreach ($this->shares as $userId => $amount) {
            if (!empty($amount) && is_numeric($amount) && (float) $amount > 0) {
                ShareDeclarationModel::updateOrCreate(
                    ['user_id' => $userId, 'month_id' => $this->monthId],
                    ['amount' => (float) $amount]
                );
                $sharesSaved++;
            }
        }

        foreach ($this->insuranceAmounts as $userId => $amount) {
            if (!empty($amount) && is_numeric($amount) && (float) $amount > 0) {
                InsuranceContribution::updateOrCreate(
                    ['user_id' => $userId, 'month_id' => $this->monthId],
                    ['amount' => (float) $amount]
                );
                $insuranceSaved++;
            }
        }

        // Process repayments — oldest loan first (FIFO)
        foreach ($this->repaymentAmounts as $userId => $repAmt) {
            if (empty($repAmt) || !is_numeric($repAmt) || (float) $repAmt <= 0) continue;

            $remaining = (float) $repAmt;
            $memberLoans = $this->loanBalances[$userId]['loans'] ?? [];

            DB::transaction(function () use ($memberLoans, &$remaining, &$repaymentsSaved, &$totalRepaid) {
                foreach ($memberLoans as $loanData) {
                    if ($remaining <= 0) break;

                    $loan = Loan::find($loanData['id']);
                    if (!$loan || (float) $loan->outstanding_balance <= 0) continue;

                    $payment = min($remaining, (float) $loan->outstanding_balance);
                    $newBalance = round((float) $loan->outstanding_balance - $payment, 2);

                    Repayment::create([
                        'loan_id'           => $loan->id,
                        'amount_paid'       => $payment,
                        'remaining_balance' => $newBalance,
                        'penalty_applied'   => 0,
                    ]);

                    $loan->outstanding_balance = $newBalance;
                    if ($newBalance <= 0) {
                        $loan->status = 'completed';
                    }
                    $loan->save();

                    $remaining -= $payment;
                    $totalRepaid += $payment;
                    $repaymentsSaved++;
                }
            });
        }

        // Reload to reflect new balances
        $this->loadExistingDeclarations();

        $parts = [];
        if ($sharesSaved > 0) $parts[] = $sharesSaved . ' share(s)';
        if ($insuranceSaved > 0) $parts[] = $insuranceSaved . ' insurance';
        if ($repaymentsSaved > 0) $parts[] = 'K' . number_format($totalRepaid, 2) . ' repaid across ' . $repaymentsSaved . ' loan(s)';
        session()->flash('message', implode(', ', $parts) . ' saved successfully.');
    }

    /* ── Computed properties ──────────────── */

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
        if (empty($this->circleId)) {
            return collect();
        }

        return Month::where('circle_id', $this->circleId)
            ->where('status', 'active')
            ->orderBy('month_number')
            ->get();
    }

    public function getMembersProperty()
    {
        if (empty($this->circleId)) {
            return collect();
        }

        return Circle::findOrFail($this->circleId)
            ->members()
            ->orderBy('name')
            ->get();
    }

    public function getTotalSharesProperty()
    {
        return collect($this->shares)
            ->filter(fn ($v) => is_numeric($v) && (float) $v > 0)
            ->sum(fn ($v) => (float) $v);
    }

    public function getTotalInsuranceProperty()
    {
        return collect($this->insuranceAmounts)
            ->filter(fn ($v) => is_numeric($v) && (float) $v > 0)
            ->sum(fn ($v) => (float) $v);
    }

    public function getTotalRepaymentsProperty()
    {
        return collect($this->repaymentAmounts)
            ->filter(fn ($v) => is_numeric($v) && (float) $v > 0)
            ->sum(fn ($v) => (float) $v);
    }

    /* ── Render ───────────────────────────── */

    public function render()
    {
        return view('livewire.village-banking.shares.share-declaration', [
            'circles'         => $this->circles,
            'months'          => $this->months,
            'membersList'     => $this->members,
            'totalShares'     => $this->totalShares,
            'totalInsurance'  => $this->totalInsurance,
            'totalRepayments' => $this->totalRepayments,
        ])->layout('layouts.main.master-livewire');
    }
}
