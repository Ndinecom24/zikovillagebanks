<?php

namespace App\Http\Livewire\VillageBanking\Reports;

use Livewire\Component;
use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\Loan;
use App\Models\VillageBanking\Month;
use App\Models\VillageBanking\Repayment;
use App\Models\VillageBanking\Penalty;
use App\Traits\HasVillageBankScope;
use Illuminate\Support\Facades\DB;

class LoansReport extends Component
{
    use HasVillageBankScope;

    public $circleId  = '';
    public $dateFrom  = '';
    public $dateTo    = '';
    public $statusFilter = '';

    protected $queryString = [
        'circleId'      => ['except' => '', 'as' => 'circle'],
        'villageBankId' => ['except' => '', 'as' => 'bank'],
        'dateFrom'      => ['except' => '', 'as' => 'from'],
        'dateTo'        => ['except' => '', 'as' => 'to'],
        'statusFilter'  => ['except' => '', 'as' => 'status'],
    ];

    public function getCirclesProperty()
    {
        return $this->scopedCircleQuery()->orderBy('name')->get();
    }

    /* ── Portfolio Summary ── */
    public function getPortfolioProperty()
    {
        $monthIds = $this->filteredMonthIds();
        $loanIds  = Loan::whereIn('month_id', $monthIds)->pluck('id');

        $totalIssued    = Loan::whereIn('month_id', $monthIds)->sum('amount');
        $totalPayable   = Loan::whereIn('month_id', $monthIds)->sum('total_payable');
        $totalRepaid    = Repayment::whereIn('loan_id', $loanIds)->sum('amount_paid');
        $totalOutstanding = Loan::whereIn('month_id', $monthIds)->whereIn('status', ['approved','active'])->sum('outstanding_balance');
        $totalPenalties = Penalty::whereIn('loan_id', $loanIds)->sum('amount');
        $totalLoans     = Loan::whereIn('month_id', $monthIds)->count();
        $activeLoans    = Loan::whereIn('month_id', $monthIds)->where('status', 'active')->count();
        $completedLoans = Loan::whereIn('month_id', $monthIds)->where('status', 'completed')->count();
        $rejectedLoans  = Loan::whereIn('month_id', $monthIds)->where('status', 'rejected')->count();
        $interestEarned = $totalPayable - $totalIssued;
        $repaymentRate  = $totalPayable > 0 ? round(($totalRepaid / $totalPayable) * 100, 1) : 0;

        return compact(
            'totalIssued','totalPayable','totalRepaid','totalOutstanding','totalPenalties',
            'totalLoans','activeLoans','completedLoans','rejectedLoans','interestEarned','repaymentRate'
        );
    }

    /* ── Loans by Status Breakdown ── */
    public function getLoansByStatusProperty()
    {
        $monthIds = $this->filteredMonthIds();

        return Loan::select('status', DB::raw('COUNT(*) as count'), DB::raw('SUM(amount) as total'), DB::raw('SUM(outstanding_balance) as outstanding'))
            ->whereIn('month_id', $monthIds)
            ->groupBy('status')
            ->get()
            ->keyBy('status');
    }

    /* ── Detailed Loan List ── */
    public function getLoansListProperty()
    {
        $monthIds = $this->filteredMonthIds();

        return Loan::with(['borrower', 'month.circle'])
            ->whereIn('month_id', $monthIds)
            ->when($this->statusFilter, fn($q) => $q->where('status', $this->statusFilter))
            ->when($this->dateFrom, fn($q) => $q->whereDate('created_at', '>=', $this->dateFrom))
            ->when($this->dateTo, fn($q) => $q->whereDate('created_at', '<=', $this->dateTo))
            ->withCount('repayments')
            ->orderByDesc('created_at')
            ->limit(50)
            ->get();
    }

    /* ── Top Borrowers ── */
    public function getTopBorrowersProperty()
    {
        $monthIds = $this->filteredMonthIds();

        return Loan::select('borrower_id', DB::raw('COUNT(*) as loan_count'), DB::raw('SUM(amount) as total_amount'), DB::raw('SUM(outstanding_balance) as outstanding'))
            ->whereIn('month_id', $monthIds)
            ->groupBy('borrower_id')
            ->orderByDesc('total_amount')
            ->limit(10)
            ->with('borrower')
            ->get();
    }

    /* ── Repayment Performance by Borrower ── */
    public function getRepaymentPerformanceProperty()
    {
        $monthIds = $this->filteredMonthIds();

        return Loan::with('borrower')
            ->whereIn('month_id', $monthIds)
            ->whereIn('status', ['active', 'completed'])
            ->get()
            ->groupBy('borrower_id')
            ->map(function ($loans) {
                $borrower = $loans->first()->borrower;
                $totalPayable = $loans->sum('total_payable');
                $outstanding  = $loans->sum('outstanding_balance');
                $repaid       = $totalPayable - $outstanding;
                $rate         = $totalPayable > 0 ? round(($repaid / $totalPayable) * 100, 1) : 0;

                return [
                    'name'        => $borrower->name ?? 'Unknown',
                    'loans'       => $loans->count(),
                    'totalPayable'=> $totalPayable,
                    'repaid'      => $repaid,
                    'outstanding' => $outstanding,
                    'rate'        => $rate,
                ];
            })
            ->sortByDesc('rate')
            ->values()
            ->take(15);
    }

    /* ── Helpers ── */
    private function filteredMonthIds()
    {
        return Month::when($this->circleId, fn($q) => $q->where('circle_id', $this->circleId))
            ->when(empty($this->circleId), fn($q) => $q->whereIn('circle_id', $this->scopedCircleIds()))
            ->pluck('id');
    }

    public function resetFilters()
    {
        $this->reset(['circleId', 'dateFrom', 'dateTo', 'statusFilter']);
    }

    public function render()
    {
        return view('livewire.village-banking.reports.loans-report', [
            'portfolio'      => $this->portfolio,
            'loansByStatus'  => $this->loansByStatus,
            'loansList'      => $this->loansList,
            'topBorrowers'   => $this->topBorrowers,
            'repaymentPerf'  => $this->repaymentPerformance,
        ])->layout('layouts.main.master-livewire');
    }
}
