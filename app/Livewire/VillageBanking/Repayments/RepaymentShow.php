<?php

namespace App\Livewire\VillageBanking\Repayments;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\VillageBanking\Loan;

#[Layout('layouts.main.master-livewire')]
class RepaymentShow extends Component
{
    public Loan $loan;

    public function mount($loanId)
    {
        $this->loan = Loan::with([
            'borrower',
            'month.circle.villageBank',
            'repayments' => fn ($q) => $q->orderByDesc('created_at'),
            'penalties'  => fn ($q) => $q->orderByDesc('applied_at'),
        ])->findOrFail($loanId);
    }

    /* ── Computed helpers ──────────── */

    public function getRepaidAmountProperty()
    {
        return $this->loan->repayments->sum('amount_paid');
    }

    public function getRepaidPercentProperty()
    {
        if ($this->loan->total_payable <= 0) return 0;
        return min(100, round(($this->repaidAmount / $this->loan->total_payable) * 100));
    }

    public function getTotalPenaltiesProperty()
    {
        return $this->loan->penalties->sum('amount');
    }

    public function render()
    {
        return view('livewire.village-banking.repayments.repayment-show');
    }
}
