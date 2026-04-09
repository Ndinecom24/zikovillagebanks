<?php

namespace App\Http\Livewire\VillageBanking\Reports;

use Livewire\Component;
use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\Loan;
use App\Models\VillageBanking\Month;
use App\Models\VillageBanking\Repayment;
use App\Models\VillageBanking\Penalty;
use App\Models\VillageBanking\ShareDeclaration;
use App\Models\VillageBanking\InsuranceContribution;
use App\Models\VillageBanking\Transaction;
use App\Models\VillageBanking\Shareout;
use App\Models\User;
use App\Traits\HasVillageBankScope;
use Illuminate\Support\Facades\DB;

class ReportsDashboard extends Component
{
    use HasVillageBankScope;
    /* ── Filters ─────────── */
    public $circleId  = '';
    public $dateFrom  = '';
    public $dateTo    = '';
    public $reportTab = 'overview'; // overview | contributions | loans | payments | shareouts

    public function updatedCircleId()
    {
        // filters changed — component re-renders automatically
    }

    /* ── Computed: circles for dropdown (scoped) ── */
    public function getCirclesProperty()
    {
        return $this->scopedCircleQuery()->orderBy('name')->get();
    }

    /* ═══════════════════════════════════════
     *  OVERVIEW TAB
     * ═══════════════════════════════════════ */

    public function getOverviewProperty()
    {
        $circleFilter = $this->circleId;
        $dateFrom     = $this->dateFrom ?: null;
        $dateTo       = $this->dateTo ?: null;

        // Scope circles by village bank first, then apply specific circle filter
        $baseCircleQuery = $this->scopedCircleQuery();

        // Month IDs scoped to village bank and optional circle filter
        $monthIds = Month::when($circleFilter, fn ($q) => $q->where('circle_id', $circleFilter))
            ->when(empty($circleFilter), fn ($q) => $q->whereIn('circle_id', (clone $baseCircleQuery)->pluck('id')))
            ->pluck('id');
        $loanIds  = Loan::whereIn('month_id', $monthIds)->pluck('id');

        return [
            'totalCircles'       => (clone $baseCircleQuery)->when($circleFilter, fn ($q) => $q->where('id', $circleFilter))->count(),
            'activeCircles'      => (clone $baseCircleQuery)->where('status', 'active')->when($circleFilter, fn ($q) => $q->where('id', $circleFilter))->count(),
            'totalMembers'       => DB::table('circle_members')
                                        ->when($circleFilter, fn ($q) => $q->where('circle_id', $circleFilter))
                                        ->distinct('user_id')->count('user_id'),
            'totalContributions' => ShareDeclaration::whereIn('month_id', $monthIds)
                                        ->when($dateFrom, fn ($q) => $q->whereDate('created_at', '>=', $dateFrom))
                                        ->when($dateTo, fn ($q) => $q->whereDate('created_at', '<=', $dateTo))
                                        ->sum('amount'),
            'totalLoans'         => Loan::whereIn('month_id', $monthIds)->count(),
            'totalLoanAmount'    => Loan::whereIn('month_id', $monthIds)->sum('amount'),
            'totalRepaid'        => Repayment::whereIn('loan_id', $loanIds)
                                        ->when($dateFrom, fn ($q) => $q->whereDate('created_at', '>=', $dateFrom))
                                        ->when($dateTo, fn ($q) => $q->whereDate('created_at', '<=', $dateTo))
                                        ->sum('amount_paid'),
            'totalOutstanding'   => Loan::whereIn('month_id', $monthIds)->whereIn('status', ['approved', 'active'])->sum('outstanding_balance'),
            'totalPenalties'     => Penalty::whereIn('loan_id', $loanIds)->sum('amount'),
            'totalInsurance'     => InsuranceContribution::whereIn('month_id', $monthIds)->sum('amount'),
            'totalShareouts'     => Shareout::whereIn('circle_id', (clone $baseCircleQuery)->pluck('id'))->when($circleFilter, fn ($q) => $q->where('circle_id', $circleFilter))->count(),
            'totalPoolDistrib'   => Shareout::whereIn('circle_id', (clone $baseCircleQuery)->pluck('id'))->when($circleFilter, fn ($q) => $q->where('circle_id', $circleFilter))->sum('total_pool'),
        ];
    }

    /* ═══════════════════════════════════════
     *  CONTRIBUTIONS TAB
     * ═══════════════════════════════════════ */

    public function getContributionsByMonthProperty()
    {
        $circleIds = $this->scopedCircleIds();
        $monthIds = Month::when($this->circleId, fn ($q) => $q->where('circle_id', $this->circleId))
            ->when(empty($this->circleId), fn ($q) => $q->whereIn('circle_id', $circleIds))
            ->pluck('id');

        return ShareDeclaration::select('month_id', DB::raw('SUM(amount) as total'), DB::raw('COUNT(DISTINCT user_id) as members'))
            ->whereIn('month_id', $monthIds)
            ->when($this->dateFrom, fn ($q) => $q->whereDate('created_at', '>=', $this->dateFrom))
            ->when($this->dateTo, fn ($q) => $q->whereDate('created_at', '<=', $this->dateTo))
            ->groupBy('month_id')
            ->with('month.circle')
            ->orderByDesc('month_id')
            ->get();
    }

    public function getTopContributorsProperty()
    {
        $circleIds = $this->scopedCircleIds();
        $monthIds = Month::when($this->circleId, fn ($q) => $q->where('circle_id', $this->circleId))
            ->when(empty($this->circleId), fn ($q) => $q->whereIn('circle_id', $circleIds))
            ->pluck('id');

        return ShareDeclaration::select('user_id', DB::raw('SUM(amount) as total'))
            ->whereIn('month_id', $monthIds)
            ->when($this->dateFrom, fn ($q) => $q->whereDate('created_at', '>=', $this->dateFrom))
            ->when($this->dateTo, fn ($q) => $q->whereDate('created_at', '<=', $this->dateTo))
            ->groupBy('user_id')
            ->orderByDesc('total')
            ->limit(10)
            ->with('user')
            ->get();
    }

    /* ═══════════════════════════════════════
     *  LOANS TAB
     * ═══════════════════════════════════════ */

    public function getLoansByStatusProperty()
    {
        $circleIds = $this->scopedCircleIds();
        $monthIds = Month::when($this->circleId, fn ($q) => $q->where('circle_id', $this->circleId))
            ->when(empty($this->circleId), fn ($q) => $q->whereIn('circle_id', $circleIds))
            ->pluck('id');

        return Loan::select('status', DB::raw('COUNT(*) as count'), DB::raw('SUM(amount) as total'))
            ->whereIn('month_id', $monthIds)
            ->groupBy('status')
            ->get()
            ->keyBy('status');
    }

    public function getTopBorrowersProperty()
    {
        $circleIds = $this->scopedCircleIds();
        $monthIds = Month::when($this->circleId, fn ($q) => $q->where('circle_id', $this->circleId))
            ->when(empty($this->circleId), fn ($q) => $q->whereIn('circle_id', $circleIds))
            ->pluck('id');

        return Loan::select('borrower_id', DB::raw('COUNT(*) as loan_count'), DB::raw('SUM(amount) as total_amount'), DB::raw('SUM(outstanding_balance) as outstanding'))
            ->whereIn('month_id', $monthIds)
            ->groupBy('borrower_id')
            ->orderByDesc('total_amount')
            ->limit(10)
            ->with('borrower')
            ->get();
    }

    /* ═══════════════════════════════════════
     *  PAYMENTS TAB
     * ═══════════════════════════════════════ */

    public function getPaymentsByStatusProperty()
    {
        $circleIds = $this->scopedCircleIds();

        return Transaction::select('status', DB::raw('COUNT(*) as count'), DB::raw('SUM(amount) as total'))
            ->when($this->circleId, function ($q) {
                $monthIds = Month::where('circle_id', $this->circleId)->pluck('id');
                $q->whereIn('month_id', $monthIds);
            })
            ->when(empty($this->circleId), function ($q) use ($circleIds) {
                $monthIds = Month::whereIn('circle_id', $circleIds)->pluck('id');
                $q->whereIn('month_id', $monthIds);
            })
            ->when($this->dateFrom, fn ($q) => $q->whereDate('created_at', '>=', $this->dateFrom))
            ->when($this->dateTo, fn ($q) => $q->whereDate('created_at', '<=', $this->dateTo))
            ->groupBy('status')
            ->get()
            ->keyBy('status');
    }

    public function getRecentTransactionsProperty()
    {
        $circleIds = $this->scopedCircleIds();

        return Transaction::with(['sender', 'receiver', 'paymentMethod'])
            ->when($this->circleId, function ($q) {
                $monthIds = Month::where('circle_id', $this->circleId)->pluck('id');
                $q->whereIn('month_id', $monthIds);
            })
            ->when(empty($this->circleId), function ($q) use ($circleIds) {
                $monthIds = Month::whereIn('circle_id', $circleIds)->pluck('id');
                $q->whereIn('month_id', $monthIds);
            })
            ->when($this->dateFrom, fn ($q) => $q->whereDate('created_at', '>=', $this->dateFrom))
            ->when($this->dateTo, fn ($q) => $q->whereDate('created_at', '<=', $this->dateTo))
            ->orderByDesc('created_at')
            ->limit(15)
            ->get();
    }

    /* ═══════════════════════════════════════
     *  SHAREOUTS TAB
     * ═══════════════════════════════════════ */

    public function getShareoutListProperty()
    {
        $circleIds = $this->scopedCircleIds();

        return Shareout::with(['circle', 'allocations'])
            ->whereIn('circle_id', $circleIds)
            ->when($this->circleId, fn ($q) => $q->where('circle_id', $this->circleId))
            ->orderByDesc('created_at')
            ->get();
    }

    public function render()
    {
        return view('livewire.village-banking.reports.reports-dashboard')
            ->layout('layouts.main.master-livewire');
    }
}
