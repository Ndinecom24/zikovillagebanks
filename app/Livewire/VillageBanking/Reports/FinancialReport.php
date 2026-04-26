<?php

namespace App\Livewire\VillageBanking\Reports;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\Loan;
use App\Models\VillageBanking\Month;
use App\Models\VillageBanking\Repayment;
use App\Models\VillageBanking\Penalty;
use App\Models\VillageBanking\ShareDeclaration;
use App\Models\VillageBanking\InsuranceContribution;
use App\Models\VillageBanking\Transaction;
use App\Models\VillageBanking\Shareout;
use App\Traits\HasVillageBankScope;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.main.master-livewire')]
class FinancialReport extends Component
{
    use HasVillageBankScope;

    public $circleId = '';
    #[Url]
    public $dateFrom = '';
    #[Url]
    public $dateTo   = '';
    public function getCirclesProperty()
    {
        return $this->scopedCircleQuery()->orderBy('name')->get();
    }

    /* ── Summary KPIs ── */
    public function getSummaryProperty()
    {
        $monthIds = $this->filteredMonthIds();
        $loanIds  = Loan::whereIn('month_id', $monthIds)->pluck('id');

        return [
            'totalContributions' => ShareDeclaration::whereIn('month_id', $monthIds)
                ->when($this->dateFrom, fn($q) => $q->whereDate('created_at', '>=', $this->dateFrom))
                ->when($this->dateTo, fn($q) => $q->whereDate('created_at', '<=', $this->dateTo))
                ->sum('amount'),
            'totalInsurance'     => InsuranceContribution::whereIn('month_id', $monthIds)
                ->when($this->dateFrom, fn($q) => $q->whereDate('created_at', '>=', $this->dateFrom))
                ->when($this->dateTo, fn($q) => $q->whereDate('created_at', '<=', $this->dateTo))
                ->sum('amount'),
            'totalPenalties'     => Penalty::whereIn('loan_id', $loanIds)->sum('amount'),
            'totalLoanIssued'    => Loan::whereIn('month_id', $monthIds)->sum('amount'),
            'totalRepaid'        => Repayment::whereIn('loan_id', $loanIds)
                ->when($this->dateFrom, fn($q) => $q->whereDate('created_at', '>=', $this->dateFrom))
                ->when($this->dateTo, fn($q) => $q->whereDate('created_at', '<=', $this->dateTo))
                ->sum('amount_paid'),
            'totalOutstanding'   => Loan::whereIn('month_id', $monthIds)->whereIn('status', ['approved','active'])->sum('outstanding_balance'),
            'totalInterestEarned'=> Loan::whereIn('month_id', $monthIds)->selectRaw('SUM(total_payable - amount) as interest')->value('interest') ?? 0,
            'totalShareouts'     => Shareout::whereIn('circle_id', $this->filteredCircleIds())->sum('total_pool'),
        ];
    }

    /* ── Contributions By Month Detail ── */
    public function getContributionsByMonthProperty()
    {
        $monthIds = $this->filteredMonthIds();

        return ShareDeclaration::select('month_id', DB::raw('SUM(amount) as total'), DB::raw('COUNT(DISTINCT user_id) as members'), DB::raw('AVG(amount) as avg_amount'))
            ->whereIn('month_id', $monthIds)
            ->when($this->dateFrom, fn($q) => $q->whereDate('created_at', '>=', $this->dateFrom))
            ->when($this->dateTo, fn($q) => $q->whereDate('created_at', '<=', $this->dateTo))
            ->groupBy('month_id')
            ->with('month.circle')
            ->orderByDesc('month_id')
            ->get();
    }

    /* ── Top 10 Contributors ── */
    public function getTopContributorsProperty()
    {
        $monthIds = $this->filteredMonthIds();

        return ShareDeclaration::select('user_id', DB::raw('SUM(amount) as total'), DB::raw('COUNT(*) as contributions'))
            ->whereIn('month_id', $monthIds)
            ->when($this->dateFrom, fn($q) => $q->whereDate('created_at', '>=', $this->dateFrom))
            ->when($this->dateTo, fn($q) => $q->whereDate('created_at', '<=', $this->dateTo))
            ->groupBy('user_id')
            ->orderByDesc('total')
            ->limit(10)
            ->with('user')
            ->get();
    }

    /* ── Insurance by Circle ── */
    public function getInsuranceByCircleProperty()
    {
        $circleIds = $this->filteredCircleIds();

        return InsuranceContribution::select('months.circle_id', DB::raw('SUM(insurance_contributions.amount) as total'), DB::raw('COUNT(DISTINCT insurance_contributions.user_id) as members'))
            ->join('months', 'months.id', '=', 'insurance_contributions.month_id')
            ->whereIn('months.circle_id', $circleIds)
            ->when($this->dateFrom, fn($q) => $q->whereDate('insurance_contributions.created_at', '>=', $this->dateFrom))
            ->when($this->dateTo, fn($q) => $q->whereDate('insurance_contributions.created_at', '<=', $this->dateTo))
            ->groupBy('months.circle_id')
            ->get()
            ->map(function ($row) {
                $row->circle = Circle::find($row->circle_id);
                return $row;
            });
    }

    /* ── Fund Flow Summary (income vs outflow) ── */
    public function getFundFlowProperty()
    {
        $s = $this->summary;
        $inflow  = $s['totalContributions'] + $s['totalInsurance'] + $s['totalPenalties'] + $s['totalInterestEarned'];
        $outflow = $s['totalLoanIssued'] + $s['totalShareouts'];
        return ['inflow' => $inflow, 'outflow' => $outflow, 'net' => $inflow - $outflow];
    }

    /* ── Helpers ── */
    private function filteredCircleIds()
    {
        if ($this->circleId) return collect([$this->circleId]);
        return $this->scopedCircleIds();
    }

    private function filteredMonthIds()
    {
        return Month::when($this->circleId, fn($q) => $q->where('circle_id', $this->circleId))
            ->when(empty($this->circleId), fn($q) => $q->whereIn('circle_id', $this->scopedCircleIds()))
            ->pluck('id');
    }

    public function resetFilters()
    {
        $this->reset(['circleId', 'dateFrom', 'dateTo']);
    }

    public function render()
    {
        return view('livewire.village-banking.reports.financial-report', [
            'summary'            => $this->summary,
            'fundFlow'           => $this->fundFlow,
            'contributionsByMonth' => $this->contributionsByMonth,
            'topContributors'    => $this->topContributors,
            'insuranceByCircle'  => $this->insuranceByCircle,
        ]);
    }
}
