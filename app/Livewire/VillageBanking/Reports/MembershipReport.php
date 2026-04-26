<?php

namespace App\Livewire\VillageBanking\Reports;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\Loan;
use App\Models\VillageBanking\Month;
use App\Models\VillageBanking\ShareDeclaration;
use App\Models\VillageBanking\InsuranceContribution;
use App\Models\User;
use App\Traits\HasVillageBankScope;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.main.master-livewire')]
class MembershipReport extends Component
{
    use HasVillageBankScope;

    public $circleId = '';
    public function getCirclesProperty()
    {
        return $this->scopedCircleQuery()->orderBy('name')->get();
    }

    /* ── Summary ── */
    public function getSummaryProperty()
    {
        $circleIds = $this->filteredCircleIds();

        $totalMembers = DB::table('circle_members')
            ->whereIn('circle_id', $circleIds)
            ->distinct('user_id')
            ->count('user_id');

        $totalCircles = Circle::whereIn('id', $circleIds)->count();
        $activeCircles = Circle::whereIn('id', $circleIds)->where('status', 'active')->count();
        $closedCircles = Circle::whereIn('id', $circleIds)->where('status', 'closed')->count();

        return compact('totalMembers', 'totalCircles', 'activeCircles', 'closedCircles');
    }

    /* ── Circles Detail ── */
    public function getCirclesDetailProperty()
    {
        $circleIds = $this->filteredCircleIds();

        return Circle::whereIn('id', $circleIds)
            ->withCount('circleMemberships')
            ->with(['villageBank', 'months'])
            ->orderByDesc('created_at')
            ->get()
            ->map(function ($circle) {
                $monthIds = $circle->months->pluck('id');
                $circle->total_contributions = ShareDeclaration::whereIn('month_id', $monthIds)->sum('amount');
                $circle->total_loans = Loan::whereIn('month_id', $monthIds)->count();
                return $circle;
            });
    }

    /* ── Members Detail with Activity ── */
    public function getMembersDetailProperty()
    {
        $circleIds = $this->filteredCircleIds();
        $monthIds = Month::whereIn('circle_id', $circleIds)->pluck('id');

        // Get member user IDs
        $memberIds = DB::table('circle_members')
            ->whereIn('circle_id', $circleIds)
            ->distinct()
            ->pluck('user_id');

        return User::whereIn('id', $memberIds)
            ->get()
            ->map(function ($user) use ($circleIds, $monthIds) {
                $user->circles_count = DB::table('circle_members')
                    ->where('user_id', $user->id)
                    ->whereIn('circle_id', $circleIds)
                    ->count();

                $user->total_contributions = ShareDeclaration::where('user_id', $user->id)
                    ->whereIn('month_id', $monthIds)
                    ->sum('amount');

                $user->total_loans = Loan::where('borrower_id', $user->id)
                    ->whereIn('month_id', $monthIds)
                    ->count();

                $user->total_insurance = InsuranceContribution::where('user_id', $user->id)
                    ->whereIn('month_id', $monthIds)
                    ->sum('amount');

                return $user;
            })
            ->sortByDesc('total_contributions')
            ->values();
    }

    /* ── Participation Rates ── */
    public function getParticipationProperty()
    {
        $circleIds = $this->filteredCircleIds();

        return Circle::whereIn('id', $circleIds)
            ->with('months')
            ->get()
            ->map(function ($circle) {
                $totalMembers = $circle->circleMemberships()->count();
                $monthIds = $circle->months->pluck('id');
                $activeContributors = ShareDeclaration::whereIn('month_id', $monthIds)
                    ->distinct('user_id')
                    ->count('user_id');
                $activeBorrowers = Loan::whereIn('month_id', $monthIds)
                    ->distinct('borrower_id')
                    ->count('borrower_id');

                return [
                    'circle' => $circle->name,
                    'totalMembers' => $totalMembers,
                    'activeContributors' => $activeContributors,
                    'activeBorrowers' => $activeBorrowers,
                    'contributionRate' => $totalMembers > 0 ? round(($activeContributors / $totalMembers) * 100, 1) : 0,
                    'borrowingRate' => $totalMembers > 0 ? round(($activeBorrowers / $totalMembers) * 100, 1) : 0,
                ];
            });
    }

    private function filteredCircleIds()
    {
        if ($this->circleId) return collect([$this->circleId]);
        return $this->scopedCircleIds();
    }

    public function render()
    {
        return view('livewire.village-banking.reports.membership-report', [
            'summary'         => $this->summary,
            'circlesDetail'   => $this->circlesDetail,
            'membersDetail'   => $this->membersDetail,
            'participation'   => $this->participation,
        ]);
    }
}
