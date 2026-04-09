<?php

namespace App\Http\Livewire\VillageBanking\Repayments;

use Livewire\Component;
use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\Loan;
use App\Models\VillageBanking\Repayment;
use App\Models\VillageBanking\Penalty;
use App\Traits\HasVillageBankScope;

class RepaymentForm extends Component
{
    use HasVillageBankScope;
    /* ── Filters ─────────── */
    public $circleId = '';
    public $loanId   = '';

    /* ── Form fields ─────── */
    public $amount         = '';
    public $applyPenalty   = false;
    public $penaltyPercent = '';

    /* ── Computed helpers ── */
    public $selectedLoan   = null;

    /* ── Feedback ────────── */
    public $successMessage = '';

    protected function rules()
    {
        return [
            'circleId'       => 'required|exists:circles,id',
            'loanId'         => 'required|exists:loans,id',
            'amount'         => 'required|numeric|min:0.01|max:' . ($this->selectedLoan->outstanding_balance ?? 999999999),
            'applyPenalty'   => 'boolean',
            'penaltyPercent' => $this->applyPenalty ? 'required|numeric|min:0.01|max:100' : 'nullable',
        ];
    }

    /* ── Lifecycle ────────── */

    public function updatedCircleId()
    {
        $this->reset('loanId', 'selectedLoan', 'amount', 'applyPenalty', 'penaltyPercent', 'successMessage');
    }

    public function updatedLoanId($value)
    {
        $this->reset('amount', 'applyPenalty', 'penaltyPercent', 'successMessage');

        if ($value) {
            $this->selectedLoan = Loan::with(['borrower', 'month.circle', 'repayments', 'penalties'])
                ->find($value);
        } else {
            $this->selectedLoan = null;
        }
    }

    /* ── Computed collections ── */

    public function getCirclesProperty()
    {
        return $this->scopedCircleQuery()
            ->where('status', 'active')
            ->withCount('members')
            ->orderBy('name')
            ->get();
    }

    public function getLoansProperty()
    {
        if (empty($this->circleId)) {
            return collect();
        }

        return Loan::with('borrower')
            ->whereHas('month', fn ($q) => $q->where('circle_id', $this->circleId))
            ->whereIn('status', ['approved', 'active'])
            ->where('outstanding_balance', '>', 0)
            ->orderByDesc('created_at')
            ->get();
    }

    /* ── Submit ──────────── */

    public function submitRepayment()
    {
        // Refresh loan before validation
        if ($this->loanId) {
            $this->selectedLoan = Loan::with(['borrower', 'month.circle', 'repayments', 'penalties'])
                ->find($this->loanId);
        }

        $this->validate();

        $loan = $this->selectedLoan;

        // Calculate penalty
        $penaltyAmount = 0;
        if ($this->applyPenalty && $this->penaltyPercent > 0) {
            $penaltyAmount = round($loan->outstanding_balance * ($this->penaltyPercent / 100), 2);

            Penalty::create([
                'loan_id'    => $loan->id,
                'percentage' => $this->penaltyPercent,
                'amount'     => $penaltyAmount,
                'applied_at' => now(),
            ]);
        }

        // Remaining balance after repayment
        $remaining = round($loan->outstanding_balance - $this->amount, 2);

        // Create repayment record
        Repayment::create([
            'loan_id'           => $loan->id,
            'amount_paid'       => $this->amount,
            'remaining_balance' => max($remaining, 0),
            'penalty_applied'   => $penaltyAmount,
        ]);

        // Update loan
        $loan->outstanding_balance = max($remaining, 0);
        if ($loan->outstanding_balance <= 0) {
            $loan->status = 'completed';
        } else {
            $loan->status = 'active';
        }
        $loan->save();

        $this->successMessage = 'Repayment of K' . number_format($this->amount, 2)
            . ' recorded successfully. '
            . ($loan->outstanding_balance <= 0 ? 'Loan is now fully repaid!' : 'Remaining balance: K' . number_format($loan->outstanding_balance, 2));

        $this->reset('loanId', 'amount', 'applyPenalty', 'penaltyPercent', 'selectedLoan');
    }

    public function render()
    {
        return view('livewire.village-banking.repayments.repayment-form')
            ->layout('layouts.main.master-livewire');
    }
}
