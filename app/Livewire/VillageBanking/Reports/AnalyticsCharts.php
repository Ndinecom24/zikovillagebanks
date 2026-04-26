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
use App\Models\VillageBanking\Shareout;
use App\Traits\HasVillageBankScope;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.main.master-livewire')]
class AnalyticsCharts extends Component
{
    use HasVillageBankScope;

    public $circleId = '';
    public function getCirclesProperty()
    {
        return $this->scopedCircleQuery()->orderBy('name')->get();
    }

    /* ── Contributions over time (per month) ── */
    public function getContributionTrendProperty()
    {
        $circleIds = $this->filteredCircleIds();

        return Month::select('months.id', 'months.month_number', 'months.circle_id', 'circles.name as circle_name')
            ->join('circles', 'circles.id', '=', 'months.circle_id')
            ->whereIn('months.circle_id', $circleIds)
            ->orderBy('months.circle_id')
            ->orderBy('months.month_number')
            ->get()
            ->map(function ($month) {
                $total = ShareDeclaration::where('month_id', $month->id)->sum('amount');
                $members = ShareDeclaration::where('month_id', $month->id)->distinct('user_id')->count('user_id');
                return [
                    'label'   => $month->circle_name . ' M' . $month->month_number,
                    'total'   => (float) $total,
                    'members' => $members,
                ];
            });
    }

    /* ── Loan issuance over time ── */
    public function getLoanTrendProperty()
    {
        $circleIds = $this->filteredCircleIds();

        return Month::select('months.id', 'months.month_number', 'months.circle_id', 'circles.name as circle_name')
            ->join('circles', 'circles.id', '=', 'months.circle_id')
            ->whereIn('months.circle_id', $circleIds)
            ->orderBy('months.circle_id')
            ->orderBy('months.month_number')
            ->get()
            ->map(function ($month) {
                $issued = Loan::where('month_id', $month->id)->sum('amount');
                $count  = Loan::where('month_id', $month->id)->count();
                return [
                    'label'  => $month->circle_name . ' M' . $month->month_number,
                    'issued' => (float) $issued,
                    'count'  => $count,
                ];
            });
    }

    /* ── Loan status pie chart data ── */
    public function getLoanStatusDistProperty()
    {
        $monthIds = $this->filteredMonthIds();

        return Loan::select('status', DB::raw('COUNT(*) as count'))
            ->whereIn('month_id', $monthIds)
            ->groupBy('status')
            ->get()
            ->map(fn($r) => ['status' => ucfirst($r->status), 'count' => $r->count]);
    }

    /* ── Contributions vs Loans vs Insurance comparison ── */
    public function getFundComparisonProperty()
    {
        $circleIds = $this->filteredCircleIds();

        return Circle::whereIn('id', $circleIds)
            ->with('months')
            ->get()
            ->map(function ($circle) {
                $monthIds = $circle->months->pluck('id');
                return [
                    'circle'        => $circle->name,
                    'contributions' => (float) ShareDeclaration::whereIn('month_id', $monthIds)->sum('amount'),
                    'loans'         => (float) Loan::whereIn('month_id', $monthIds)->sum('amount'),
                    'insurance'     => (float) InsuranceContribution::whereIn('month_id', $monthIds)->sum('amount'),
                ];
            });
    }

    /* ── Repayments vs Outstanding ── */
    public function getRepaymentVsOutstandingProperty()
    {
        $circleIds = $this->filteredCircleIds();

        return Circle::whereIn('id', $circleIds)
            ->with('months')
            ->get()
            ->map(function ($circle) {
                $monthIds = $circle->months->pluck('id');
                $loanIds = Loan::whereIn('month_id', $monthIds)->pluck('id');
                return [
                    'circle'      => $circle->name,
                    'repaid'      => (float) Repayment::whereIn('loan_id', $loanIds)->sum('amount_paid'),
                    'outstanding' => (float) Loan::whereIn('month_id', $monthIds)->whereIn('status', ['approved','active'])->sum('outstanding_balance'),
                ];
            });
    }

    /* ── Growth: cumulative members joining per circle ── */
    public function getMemberGrowthProperty()
    {
        $circleIds = $this->filteredCircleIds();

        return DB::table('circle_members')
            ->select('circle_id', DB::raw('COUNT(DISTINCT user_id) as members'))
            ->whereIn('circle_id', $circleIds)
            ->groupBy('circle_id')
            ->get()
            ->map(function ($row) {
                $circle = Circle::find($row->circle_id);
                return [
                    'circle'  => $circle->name ?? 'Unknown',
                    'members' => $row->members,
                ];
            });
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

    public function render()
    {
        return view('livewire.village-banking.reports.analytics-charts', [
            'contributionTrend' => $this->contributionTrend,
            'loanTrend'         => $this->loanTrend,
            'loanStatusDist'    => $this->loanStatusDist,
            'fundComparison'    => $this->fundComparison,
            'repaymentVsOutstanding' => $this->repaymentVsOutstanding,
            'memberGrowth'      => $this->memberGrowth,
        ]);
    }
}
