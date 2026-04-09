<?php

namespace App\Http\Livewire\VillageBanking\Shareout;

use Livewire\Component;
use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\Shareout;
use App\Models\VillageBanking\ShareoutAllocation;
use App\Models\VillageBanking\ShareDeclaration;
use App\Models\VillageBanking\Loan;
use App\Models\VillageBanking\Penalty;
use App\Models\VillageBanking\Repayment;
use App\Traits\HasVillageBankScope;

class ShareoutCalculator extends Component
{
    use HasVillageBankScope;
    /* ── Selection ────────── */
    public $circleId = '';

    /* ── Preview data ────── */
    public $totalContributions = 0;
    public $totalInterest      = 0;
    public $totalPenalties     = 0;
    public $totalPool          = 0;
    public $allocations        = [];
    public $previewed          = false;

    /* ── Existing shareout ── */
    public $existingShareout   = null;

    /* ── Feedback ─────────── */
    public $successMessage = '';

    /* ── Computed: circles ── */
    public function getCirclesProperty()
    {
        return $this->scopedCircleQuery()
            ->withCount('members')
            ->orderBy('name')
            ->get();
    }

    /* ── Computed: past shareouts (scoped) ── */
    public function getShareoutsProperty()
    {
        $circleIds = $this->scopedCircleIds();

        return Shareout::with(['circle', 'allocations.user'])
            ->whereIn('circle_id', $circleIds)
            ->orderByDesc('created_at')
            ->get();
    }

    /* ── Lifecycle ────────── */

    public function updatedCircleId()
    {
        $this->reset('totalContributions', 'totalInterest', 'totalPenalties', 'totalPool', 'allocations', 'previewed', 'existingShareout', 'successMessage');

        if ($this->circleId) {
            $this->existingShareout = Shareout::where('circle_id', $this->circleId)->first();
        }
    }

    /* ── Preview calculation ── */

    public function preview()
    {
        $this->validate([
            'circleId' => 'required|exists:circles,id',
        ]);

        $circle = Circle::with(['members', 'months'])->findOrFail($this->circleId);
        $monthIds = $circle->months->pluck('id');

        // 1. Total contributions (share declarations across all months of this circle)
        $this->totalContributions = ShareDeclaration::whereIn('month_id', $monthIds)->sum('amount');

        // 2. Total interest earned from loans in this circle
        $loanIds = Loan::whereIn('month_id', $monthIds)->pluck('id');
        $totalRepaid = Repayment::whereIn('loan_id', $loanIds)->sum('amount_paid');
        $totalLent   = Loan::whereIn('month_id', $monthIds)->sum('amount');
        $this->totalInterest = max(0, $totalRepaid - $totalLent);

        // 3. Total penalties collected
        $this->totalPenalties = Penalty::whereIn('loan_id', $loanIds)->sum('amount');

        // 4. Total pool
        $this->totalPool = $this->totalContributions + $this->totalInterest + $this->totalPenalties;

        // 5. Per-member allocations (proportional to each member's total share contributions)
        $this->allocations = [];
        $members = $circle->members;

        foreach ($members as $member) {
            $memberContribution = ShareDeclaration::where('user_id', $member->id)
                ->whereIn('month_id', $monthIds)
                ->sum('amount');

            $contributionRatio = $this->totalContributions > 0
                ? $memberContribution / $this->totalContributions
                : 0;

            $profitShare  = round(($this->totalInterest + $this->totalPenalties) * $contributionRatio, 2);
            $payoutAmount = round($memberContribution + $profitShare, 2);

            $this->allocations[] = [
                'user_id'            => $member->id,
                'name'               => $member->name,
                'email'              => $member->email,
                'contribution_total' => round($memberContribution, 2),
                'ratio'              => round($contributionRatio * 100, 2),
                'profit_share'       => $profitShare,
                'payout_amount'      => $payoutAmount,
            ];
        }

        // Sort by payout descending
        usort($this->allocations, fn ($a, $b) => $b['payout_amount'] <=> $a['payout_amount']);

        $this->previewed = true;
    }

    /* ── Finalise shareout ── */

    public function finalise()
    {
        if (!$this->previewed || empty($this->allocations)) {
            return;
        }

        // Prevent duplicate shareout
        if (Shareout::where('circle_id', $this->circleId)->exists()) {
            session()->flash('warning', 'A shareout already exists for this circle.');
            return;
        }

        $shareout = Shareout::create([
            'circle_id'          => $this->circleId,
            'total_contributions' => $this->totalContributions,
            'total_interest'     => $this->totalInterest,
            'total_penalties'    => $this->totalPenalties,
            'total_pool'         => $this->totalPool,
        ]);

        foreach ($this->allocations as $alloc) {
            ShareoutAllocation::create([
                'shareout_id'        => $shareout->id,
                'user_id'            => $alloc['user_id'],
                'contribution_total' => $alloc['contribution_total'],
                'profit_share'       => $alloc['profit_share'],
                'payout_amount'      => $alloc['payout_amount'],
            ]);
        }

        // Mark circle as completed
        Circle::where('id', $this->circleId)->update(['status' => 'completed']);

        $this->successMessage = 'Shareout finalised successfully! K' . number_format($this->totalPool, 2) . ' distributed to ' . count($this->allocations) . ' members.';
        $this->reset('circleId', 'totalContributions', 'totalInterest', 'totalPenalties', 'totalPool', 'allocations', 'previewed', 'existingShareout');
    }

    public function render()
    {
        return view('livewire.village-banking.shareout.shareout-calculator')
            ->layout('layouts.main.master-livewire');
    }
}
