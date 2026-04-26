<?php

namespace App\Livewire\VillageBanking\Loans;

use App\Models\VillageBanking\Loan;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.main.master-livewire')]
class LoanShow extends Component
{
    public $loanId;
    public $loan;

    // Stats
    public $totalPaired = 0;
    public $totalRepaid = 0;
    public $outstandingBalance = 0;
    public $repaymentProgress = 0;
    public $pairingProgress = 0;

    // Tab
    public $activeTab = 'overview';

    public function mount($loanId)
    {
        $this->loanId = $loanId;

        $this->loan = Loan::with([
            'borrower',
            'month.circle',
            'approvals.approver',
            'pairings.lender',
            'repayments',
            'penalties',
        ])->findOrFail($loanId);

        $this->totalPaired       = $this->loan->pairings->sum('amount');
        $this->totalRepaid       = $this->loan->repayments->sum('amount');
        $this->outstandingBalance = (float) $this->loan->outstanding_balance;

        $totalPayable = (float) $this->loan->total_payable;
        $this->repaymentProgress = $totalPayable > 0 ? min(100, ($this->totalRepaid / $totalPayable) * 100) : 0;

        $loanAmount = (float) $this->loan->amount;
        $this->pairingProgress = $loanAmount > 0 ? min(100, ($this->totalPaired / $loanAmount) * 100) : 0;
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.village-banking.loans.loan-show', [
            'pairings'   => $this->loan->pairings,
            'repayments' => $this->loan->repayments,
            'approvals'  => $this->loan->approvals,
            'penalties'  => $this->loan->penalties,
        ]);
    }
}
