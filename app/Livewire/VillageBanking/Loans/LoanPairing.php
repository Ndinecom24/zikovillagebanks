<?php

namespace App\Livewire\VillageBanking\Loans;

use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\Loan;
use App\Models\VillageBanking\LoanPairing as LoanPairingModel;
use App\Models\VillageBanking\Month;
use App\Models\VillageBanking\ShareDeclaration;
use App\Models\VillageBanking\VillageBankConfiguration;
use App\Traits\HasVillageBankScope;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.main.master-livewire')]
class LoanPairing extends Component
{
    use HasVillageBankScope;

    public $circleId = '';
    public $monthId  = '';

    /* ── Pairing mode: peer | central ──── */
    public $pairingMode = 'peer';

    /* ── Manual pairing form ───────────── */
    public $selectedLoanId = '';
    public $pairings = [];  // lender_id => amount

    /* ── Schedule view ─────────────────── */
    public $showSchedule = false;

    /* ── Lifecycle ─────────────────────── */

    public function mount()
    {
        $this->autoSelectCurrentCircleAndMonth();
    }

    protected function autoSelectCurrentCircleAndMonth()
    {
        $today = Carbon::today();

        $currentMonth = Month::where('status', 'active')
            ->where('start_date', '<=', $today)
            ->where('end_date', '>=', $today)
            ->first();

        if (!$currentMonth) return;

        $circle = Circle::where('id', $currentMonth->circle_id)
            ->where('status', 'active')
            ->first();

        if (!$circle) return;

        $scopedIds = $this->scopedCircleQuery()
            ->where('status', 'active')
            ->pluck('id');

        if (!$scopedIds->contains($circle->id)) return;

        $this->circleId = (string) $circle->id;
        $this->monthId  = (string) $currentMonth->id;
    }

    /* ── Watchers ──────────────────────── */

    public function updatedCircleId()
    {
        $this->monthId        = '';
        $this->selectedLoanId = '';
        $this->pairings       = [];
        $this->showSchedule   = false;
    }

    public function updatedMonthId()
    {
        $this->selectedLoanId = '';
        $this->pairings       = [];
        $this->showSchedule   = false;
    }

    public function updatedSelectedLoanId()
    {
        $this->pairings = [];
        $this->loadExistingPairingsForLoan();
    }

    protected function loadExistingPairingsForLoan()
    {
        if (empty($this->selectedLoanId)) return;

        $existing = LoanPairingModel::where('loan_id', $this->selectedLoanId)
            ->pluck('amount', 'lender_id');

        foreach ($existing as $lenderId => $amount) {
            $this->pairings[$lenderId] = (string) $amount;
        }
    }

    /* ── Save manual pairings (single loan) ── */

    public function savePairings()
    {
        if (empty($this->selectedLoanId)) {
            session()->flash('warning', 'Select a loan to pair.');
            return;
        }

        $loan = Loan::findOrFail($this->selectedLoanId);

        if (!in_array($loan->status, ['approved'])) {
            session()->flash('warning', 'Only approved loans can be paired.');
            return;
        }

        $totalPaired = 0;
        $savedCount  = 0;

        foreach ($this->pairings as $lenderId => $amount) {
            if (empty($amount) || !is_numeric($amount) || (float) $amount <= 0) {
                continue;
            }

            LoanPairingModel::updateOrCreate(
                ['loan_id' => $loan->id, 'lender_id' => $lenderId],
                ['amount' => (float) $amount]
            );

            $totalPaired += (float) $amount;
            $savedCount++;
        }

        $allPaired = LoanPairingModel::where('loan_id', $loan->id)->sum('amount');
        if ($allPaired >= (float) $loan->amount) {
            $loan->update(['status' => 'active']);
            session()->flash('message', $savedCount . ' pairing(s) saved. Loan is now fully paired and active.');
        } else {
            session()->flash('message', $savedCount . ' pairing(s) saved. K' . number_format($loan->amount - $allPaired, 2) . ' remaining.');
        }
    }

    /* ── Auto-pair a single selected loan ── */

    public function autoPairSelected()
    {
        if (empty($this->selectedLoanId)) {
            session()->flash('warning', 'Select a loan first.');
            return;
        }

        $loan = Loan::findOrFail($this->selectedLoanId);
        if ($loan->status !== 'approved') {
            session()->flash('warning', 'Only approved loans can be auto-paired.');
            return;
        }

        $result = $this->performAutoPair($loan);

        if ($result['success']) {
            // Reload pairings in the form
            $this->pairings = [];
            $this->loadExistingPairingsForLoan();
            session()->flash('message', $result['message']);
        } else {
            session()->flash('warning', $result['message']);
        }
    }

    /* ── Auto-pair ALL approved loans in the month ── */

    public function autoPairAllLoans()
    {
        if (empty($this->monthId)) {
            session()->flash('warning', 'Select a month first.');
            return;
        }

        $loans = $this->approvedLoans;

        if ($loans->isEmpty()) {
            session()->flash('warning', 'No approved loans to pair.');
            return;
        }

        $paired   = 0;
        $skipped  = 0;
        $messages = [];

        foreach ($loans as $loan) {
            $result = $this->performAutoPair($loan);
            if ($result['success']) {
                $paired++;
            } else {
                $skipped++;
            }
        }

        session()->flash('message', $paired . ' loan(s) auto-paired.' . ($skipped > 0 ? ' ' . $skipped . ' skipped (no eligible lenders).' : ''));
    }

    /* ── Core auto-pair logic ──────────── */

    protected function performAutoPair(Loan $loan): array
    {
        $circle = Circle::find($this->circleId);
        if (!$circle) return ['success' => false, 'message' => 'Circle not found.'];

        $monthId = (int) $this->monthId;
        $circleMonthIds = Month::where('circle_id', $circle->id)->pluck('id');

        // Already-paired amount
        $existingPaired = (float) LoanPairingModel::where('loan_id', $loan->id)->sum('amount');
        $remaining = (float) $loan->amount - $existingPaired;

        if ($remaining <= 0) {
            return ['success' => false, 'message' => $loan->borrower->name . ' is already fully paired.'];
        }

        if ($this->pairingMode === 'central') {
            // Central mode: pair entire amount to the admin (current user)
            return DB::transaction(function () use ($loan, $remaining) {
                LoanPairingModel::updateOrCreate(
                    ['loan_id' => $loan->id, 'lender_id' => Auth::id()],
                    ['amount' => $remaining]
                );

                $totalNow = (float) LoanPairingModel::where('loan_id', $loan->id)->sum('amount');
                if ($totalNow >= (float) $loan->amount) {
                    $loan->update(['status' => 'active']);
                }

                return [
                    'success' => true,
                    'message' => $loan->borrower->name . ' paired to central (K' . number_format($remaining, 2) . ').',
                ];
            });
        }

        // Peer mode: distribute proportionally by share declarations
        $lenders = $circle->members()
            ->where('users.id', '!=', $loan->borrower_id)
            ->get();

        if ($lenders->isEmpty()) {
            return ['success' => false, 'message' => 'No eligible lenders for ' . $loan->borrower->name . '.'];
        }

        // Get each lender's shares in this circle for proportional splitting
        $lenderShares = [];
        foreach ($lenders as $lender) {
            $shares = (float) ShareDeclaration::where('user_id', $lender->id)
                ->whereIn('month_id', $circleMonthIds)
                ->sum('amount');
            if ($shares > 0) {
                $lenderShares[$lender->id] = $shares;
            }
        }

        if (empty($lenderShares)) {
            // Fallback: equal distribution
            $perLender = round($remaining / $lenders->count(), 2);
            $lenderShares = $lenders->pluck('id')->mapWithKeys(fn ($id) => [$id => 1])->toArray();
        }

        $totalShares = array_sum($lenderShares);

        return DB::transaction(function () use ($loan, $remaining, $lenderShares, $totalShares) {
            $allocated = 0;
            $lenderIds = array_keys($lenderShares);
            $count     = count($lenderIds);

            foreach ($lenderIds as $i => $lenderId) {
                if ($i === $count - 1) {
                    // Last lender gets the remainder to avoid rounding issues
                    $amount = round($remaining - $allocated, 2);
                } else {
                    $proportion = $lenderShares[$lenderId] / $totalShares;
                    $amount     = round($remaining * $proportion, 2);
                }

                if ($amount <= 0) continue;

                LoanPairingModel::updateOrCreate(
                    ['loan_id' => $loan->id, 'lender_id' => $lenderId],
                    ['amount' => $amount]
                );
                $allocated += $amount;
            }

            $totalNow = (float) LoanPairingModel::where('loan_id', $loan->id)->sum('amount');
            if ($totalNow >= (float) $loan->amount) {
                $loan->update(['status' => 'active']);
            }

            return [
                'success' => true,
                'message' => $loan->borrower->name . ' auto-paired K' . number_format($allocated, 2) . ' across ' . $count . ' lender(s).',
            ];
        });
    }

    /* ── Toggle schedule view ──────────── */

    public function toggleSchedule()
    {
        $this->showSchedule = !$this->showSchedule;
    }

    /* ── Computed ───────────────────────── */

    public function getCirclesProperty()
    {
        return $this->scopedCircleQuery()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();
    }

    public function getMonthsProperty()
    {
        if (empty($this->circleId)) return collect();
        return Month::where('circle_id', $this->circleId)
            ->where('status', 'active')
            ->orderBy('month_number')
            ->get();
    }

    public function getApprovedLoansProperty()
    {
        if (empty($this->monthId)) return collect();

        return Loan::with('borrower')
            ->where('status', 'approved')
            ->where('month_id', $this->monthId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getMonthLoansProperty()
    {
        if (empty($this->monthId)) return collect();

        return Loan::with(['borrower', 'pairings.lender'])
            ->where('month_id', $this->monthId)
            ->whereIn('status', ['approved', 'active', 'completed'])
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function getSelectedLoanProperty()
    {
        if (empty($this->selectedLoanId)) return null;
        return Loan::with(['borrower', 'month', 'pairings.lender'])->find($this->selectedLoanId);
    }

    public function getLendersProperty()
    {
        if (empty($this->circleId) || empty($this->selectedLoanId)) return collect();

        $loan = Loan::find($this->selectedLoanId);
        if (!$loan) return collect();

        return Circle::findOrFail($this->circleId)
            ->members()
            ->where('users.id', '!=', $loan->borrower_id)
            ->orderBy('name')
            ->get();
    }

    public function getExistingPairingsProperty()
    {
        if (empty($this->selectedLoanId)) return collect();
        return LoanPairingModel::where('loan_id', $this->selectedLoanId)->get()->keyBy('lender_id');
    }

    public function getTotalPairedProperty()
    {
        return collect($this->pairings)
            ->filter(fn ($v) => is_numeric($v) && (float) $v > 0)
            ->sum(fn ($v) => (float) $v);
    }

    public function getScheduleProperty()
    {
        if (empty($this->monthId)) return collect();

        // All pairings for loans in this month
        return LoanPairingModel::with(['loan.borrower', 'lender'])
            ->whereHas('loan', fn ($q) => $q->where('month_id', $this->monthId))
            ->orderBy('loan_id')
            ->get()
            ->groupBy('loan_id');
    }

    public function render()
    {
        return view('livewire.village-banking.loans.loan-pairing', [
            'circles'          => $this->circles,
            'months'           => $this->months,
            'approvedLoans'    => $this->approvedLoans,
            'monthLoans'       => $this->monthLoans,
            'selectedLoan'     => $this->selectedLoan,
            'lendersList'      => $this->lenders,
            'existingPairings' => $this->existingPairings,
            'totalPaired'      => $this->totalPaired,
            'schedule'         => $this->schedule,
        ]);
    }
}
