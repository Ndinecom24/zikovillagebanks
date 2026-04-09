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
use App\Models\VillageBanking\InsuranceContribution;
use App\Traits\HasVillageBankScope;

class ShareoutCalculator extends Component
{
    use HasVillageBankScope;
    /* ── Selection ────────── */
    public $circleId = '';

    /* ── Preview data ────── */
    public $totalContributions  = 0;
    public $totalInsurance      = 0;
    public $totalInterest       = 0;
    public $totalPenalties      = 0;
    public $totalLoansOutstanding = 0;
    public $totalPool           = 0;
    public $allocations         = [];
    public $previewed           = false;

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
        $this->reset('totalContributions', 'totalInsurance', 'totalInterest', 'totalPenalties', 'totalLoansOutstanding', 'totalPool', 'allocations', 'previewed', 'existingShareout', 'successMessage');

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

        // 1. Total share contributions
        $this->totalContributions = ShareDeclaration::whereIn('month_id', $monthIds)->sum('amount');

        // 2. Total insurance contributions
        $this->totalInsurance = InsuranceContribution::whereIn('month_id', $monthIds)->sum('amount');

        // 3. Total interest earned from loans (repayments - principal)
        $loanIds = Loan::whereIn('month_id', $monthIds)->pluck('id');
        $totalRepaid = Repayment::whereIn('loan_id', $loanIds)->sum('amount_paid');
        $totalLent   = Loan::whereIn('month_id', $monthIds)->sum('amount');
        $this->totalInterest = max(0, $totalRepaid - $totalLent);

        // 4. Total penalties collected
        $this->totalPenalties = Penalty::whereIn('loan_id', $loanIds)->sum('amount');

        // 5. Total outstanding loans (amounts not yet repaid)
        $this->totalLoansOutstanding = Loan::whereIn('month_id', $monthIds)
            ->where('outstanding_balance', '>', 0)
            ->sum('outstanding_balance');

        // 6. Total profit (interest + penalties)
        $totalProfit = $this->totalInterest + $this->totalPenalties;

        // Split profit proportionally between shares pool and insurance pool
        $combinedPool = $this->totalContributions + $this->totalInsurance;
        $sharesProfitPool    = $combinedPool > 0 ? $totalProfit * ($this->totalContributions / $combinedPool) : 0;
        $insuranceProfitPool = $combinedPool > 0 ? $totalProfit * ($this->totalInsurance / $combinedPool) : 0;

        // 7. Total pool
        $this->totalPool = $this->totalContributions + $this->totalInsurance + $totalProfit;

        // 8. Per-member allocations
        $this->allocations = [];
        $members = $circle->members;

        foreach ($members as $member) {
            // Member's share contributions
            $memberContribution = ShareDeclaration::where('user_id', $member->id)
                ->whereIn('month_id', $monthIds)
                ->sum('amount');

            // Member's insurance contributions
            $memberInsurance = InsuranceContribution::where('user_id', $member->id)
                ->whereIn('month_id', $monthIds)
                ->sum('amount');

            // Ratios
            $sharesRatio    = $this->totalContributions > 0 ? $memberContribution / $this->totalContributions : 0;
            $insuranceRatio = $this->totalInsurance > 0 ? $memberInsurance / $this->totalInsurance : 0;

            // Profit splits
            $sharesProfit    = round($sharesProfitPool * $sharesRatio, 2);
            $insuranceProfit = round($insuranceProfitPool * $insuranceRatio, 2);
            $totalProfitShare = $sharesProfit + $insuranceProfit;

            // Outstanding loan deduction for this member
            $loanDeduction = Loan::whereIn('month_id', $monthIds)
                ->where('borrower_id', $member->id)
                ->where('outstanding_balance', '>', 0)
                ->sum('outstanding_balance');

            // Net shareout = shares + insurance + profit - loans
            $netShareout = round($memberContribution + $memberInsurance + $totalProfitShare - $loanDeduction, 2);

            $this->allocations[] = [
                'user_id'            => $member->id,
                'name'               => $member->name,
                'email'              => $member->email,
                'contribution_total' => round($memberContribution, 2),
                'insurance_total'    => round($memberInsurance, 2),
                'shares_profit'      => $sharesProfit,
                'insurance_profit'   => $insuranceProfit,
                'loan_deduction'     => round($loanDeduction, 2),
                'profit_share'       => round($totalProfitShare, 2),
                'ratio'              => round($sharesRatio * 100, 2),
                'payout_amount'      => $netShareout,
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
            'circle_id'              => $this->circleId,
            'total_contributions'    => $this->totalContributions,
            'total_insurance'        => $this->totalInsurance,
            'total_interest'         => $this->totalInterest,
            'total_penalties'        => $this->totalPenalties,
            'total_loans_outstanding' => $this->totalLoansOutstanding,
            'total_pool'             => $this->totalPool,
        ]);

        foreach ($this->allocations as $alloc) {
            ShareoutAllocation::create([
                'shareout_id'        => $shareout->id,
                'user_id'            => $alloc['user_id'],
                'contribution_total' => $alloc['contribution_total'],
                'insurance_total'    => $alloc['insurance_total'],
                'shares_profit'      => $alloc['shares_profit'],
                'insurance_profit'   => $alloc['insurance_profit'],
                'loan_deduction'     => $alloc['loan_deduction'],
                'profit_share'       => $alloc['profit_share'],
                'payout_amount'      => $alloc['payout_amount'],
            ]);
        }

        // Mark circle as completed
        Circle::where('id', $this->circleId)->update(['status' => 'completed']);

        $this->successMessage = 'Shareout finalised successfully! K' . number_format($this->totalPool, 2) . ' distributed to ' . count($this->allocations) . ' members.';
        $this->reset('circleId', 'totalContributions', 'totalInsurance', 'totalInterest', 'totalPenalties', 'totalLoansOutstanding', 'totalPool', 'allocations', 'previewed', 'existingShareout');
    }

    public function render()
    {
        return view('livewire.village-banking.shareout.shareout-calculator')
            ->layout('layouts.main.master-livewire');
    }
}
