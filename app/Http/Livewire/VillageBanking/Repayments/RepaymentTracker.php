<?php

namespace App\Http\Livewire\VillageBanking\Repayments;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\Loan;
use App\Models\VillageBanking\Repayment;
use App\Models\VillageBanking\Penalty;
use App\Traits\HasVillageBankScope;

class RepaymentTracker extends Component
{
    use WithPagination, HasVillageBankScope;

    protected $paginationTheme = 'bootstrap';

    /* ── Filters ─────────── */
    public $search       = '';
    public $circleFilter = '';
    public $statusFilter = '';
    public $perPage      = 10;

    /* ── Modal ───────────── */
    public $detailLoan = null;

    protected $queryString = ['search', 'circleFilter', 'statusFilter'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCircleFilter()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    /* ── Computed: circles for filter ── */
    public function getCirclesProperty()
    {
        return $this->scopedCircleQuery()->orderBy('name')->get();
    }

    /* ── Stats (scoped) ─────────── */
    public function getActiveLoansCountProperty()
    {
        $monthIds = $this->scopedMonthIds();
        return Loan::whereIn('month_id', $monthIds)->whereIn('status', ['approved', 'active'])->count();
    }

    public function getTotalOutstandingProperty()
    {
        $monthIds = $this->scopedMonthIds();
        return Loan::whereIn('month_id', $monthIds)->whereIn('status', ['approved', 'active'])->sum('outstanding_balance');
    }

    public function getTotalRepaidProperty()
    {
        $monthIds = $this->scopedMonthIds();
        $loanIds  = Loan::whereIn('month_id', $monthIds)->pluck('id');
        return Repayment::whereIn('loan_id', $loanIds)->sum('amount_paid');
    }

    public function getTotalPenaltiesProperty()
    {
        $monthIds = $this->scopedMonthIds();
        $loanIds  = Loan::whereIn('month_id', $monthIds)->pluck('id');
        return Penalty::whereIn('loan_id', $loanIds)->sum('amount');
    }

    /* ── Detail modal ──── */
    public function viewDetails($loanId)
    {
        $this->detailLoan = Loan::with([
            'borrower',
            'month.circle',
            'repayments' => fn ($q) => $q->orderByDesc('created_at'),
            'penalties'  => fn ($q) => $q->orderByDesc('applied_at'),
        ])->find($loanId);
    }

    public function closeDetails()
    {
        $this->detailLoan = null;
    }

    public function render()
    {
        $monthIds = $this->scopedMonthIds();

        $loans = Loan::with(['borrower', 'month.circle', 'repayments'])
            ->whereIn('month_id', $monthIds)
            ->when($this->search, function ($q) {
                $q->whereHas('borrower', fn ($bq) => $bq->where('name', 'like', '%' . $this->search . '%'));
            })
            ->when($this->circleFilter, function ($q) {
                $q->whereHas('month', fn ($mq) => $mq->where('circle_id', $this->circleFilter));
            })
            ->when($this->statusFilter, fn ($q) => $q->where('status', $this->statusFilter))
            ->orderByDesc('created_at')
            ->paginate($this->perPage);

        return view('livewire.village-banking.repayments.repayment-tracker', [
            'loans' => $loans,
        ])->layout('layouts.main.master-livewire');
    }
}
