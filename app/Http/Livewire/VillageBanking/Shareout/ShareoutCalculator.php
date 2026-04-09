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
use App\Models\VillageBanking\VillageBankConfiguration;
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
    public $compoundRate        = 5;
    public $allocations         = [];
    public $previewed           = false;

    /* ── Existing shareout ── */
    public $existingShareout   = null;

    /* ── Feedback ─────────── */
    public $successMessage = '';

    /* ── Member Detail Modal ── */
    public $showMemberModal    = false;
    public $memberDetail       = null;
    public $memberInvestments  = [];
    public $memberInsurance    = [];
    public $memberLoans        = [];

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
        $this->reset('totalContributions', 'totalInsurance', 'totalInterest', 'totalPenalties', 'totalLoansOutstanding', 'totalPool', 'compoundRate', 'allocations', 'previewed', 'existingShareout', 'successMessage');

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

        $circle = Circle::with(['members', 'months', 'villageBank'])->findOrFail($this->circleId);
        $months = $circle->months->sortBy('month_number');
        $monthIds = $months->pluck('id');
        $totalMonths = $months->count();

        // ── Determine compound rate from village bank configuration ──
        $config = VillageBankConfiguration::forBank($circle->village_bank_id);
        $monthlyRate = $config->reducing_balance_rate > 0
            ? $config->reducing_balance_rate / 100
            : 0.05; // default 5% per month
        $this->compoundRate = round($monthlyRate * 100, 2);
        $maxLoanMultiplier = $config->max_loan_multiplier ?? 3;

        // Month-number lookup: month_id → month_number
        $monthNumberMap = $months->pluck('month_number', 'id');

        // 1. Original totals
        $this->totalContributions = ShareDeclaration::whereIn('month_id', $monthIds)->sum('amount');
        $this->totalInsurance = InsuranceContribution::whereIn('month_id', $monthIds)->sum('amount');

        // 2. Penalties
        $loanIds = Loan::whereIn('month_id', $monthIds)->pluck('id');
        $this->totalPenalties = Penalty::whereIn('loan_id', $loanIds)->sum('amount');

        // 3. Per-member compound calculations
        $this->allocations = [];
        $members = $circle->members;

        foreach ($members as $member) {
            // ── Share declarations: compound each deposit from its month ──
            $shareDecls = ShareDeclaration::where('user_id', $member->id)
                ->whereIn('month_id', $monthIds)->get();

            $memberContribution = 0;
            $investmentCompounded = 0;

            foreach ($shareDecls as $decl) {
                $monthNum = $monthNumberMap[$decl->month_id] ?? 1;
                $monthsRemaining = max(0, $totalMonths - $monthNum);
                $compounded = $decl->amount * pow(1 + $monthlyRate, $monthsRemaining);
                $memberContribution += $decl->amount;
                $investmentCompounded += $compounded;
            }

            // ── Insurance contributions: compound each deposit ──
            $insDecls = InsuranceContribution::where('user_id', $member->id)
                ->whereIn('month_id', $monthIds)->get();

            $memberInsurance = 0;
            $insuranceCompounded = 0;

            foreach ($insDecls as $decl) {
                $monthNum = $monthNumberMap[$decl->month_id] ?? 1;
                $monthsRemaining = max(0, $totalMonths - $monthNum);
                $compounded = $decl->amount * pow(1 + $monthlyRate, $monthsRemaining);
                $memberInsurance += $decl->amount;
                $insuranceCompounded += $compounded;
            }

            // ── Profit = compounded value − original deposits ──
            $sharesProfit = round($investmentCompounded - $memberContribution, 2);
            $insuranceProfit = round($insuranceCompounded - $memberInsurance, 2);

            // ── Penalty share (proportional to contribution) ──
            $penaltyShare = $this->totalContributions > 0
                ? round($this->totalPenalties * ($memberContribution / $this->totalContributions), 2)
                : 0;

            // ── Outstanding loans ──
            $loanDeduction = Loan::whereIn('month_id', $monthIds)
                ->where('borrower_id', $member->id)
                ->where('outstanding_balance', '>', 0)
                ->sum('outstanding_balance');

            // ── Credit limit = investment × multiplier ──
            $creditLimit = round($memberContribution * $maxLoanMultiplier, 2);

            // ── Net shareout ──
            $grossShareout = round($investmentCompounded + $insuranceCompounded + $penaltyShare, 2);
            $netShareout = round($grossShareout - $loanDeduction, 2);
            $action = $netShareout >= 0 ? 'Receiving' : 'Pay back';

            $this->allocations[] = [
                'user_id'               => $member->id,
                'name'                  => $member->name,
                'email'                 => $member->email ?? '',
                'contribution_total'    => round($memberContribution, 2),
                'investment_compounded' => round($investmentCompounded, 2),
                'insurance_total'       => round($memberInsurance, 2),
                'insurance_compounded'  => round($insuranceCompounded, 2),
                'shares_profit'         => $sharesProfit,
                'insurance_profit'      => $insuranceProfit,
                'penalty_share'         => $penaltyShare,
                'loan_deduction'        => round($loanDeduction, 2),
                'credit_limit'          => $creditLimit,
                'profit_share'          => round($sharesProfit + $insuranceProfit + $penaltyShare, 2),
                'payout_amount'         => $netShareout,
                'action'                => $action,
            ];
        }

        // 4. Compute totals from allocations
        $this->totalInterest = round(
            array_sum(array_column($this->allocations, 'shares_profit'))
            + array_sum(array_column($this->allocations, 'insurance_profit')), 2
        );
        $this->totalLoansOutstanding = round(
            array_sum(array_column($this->allocations, 'loan_deduction')), 2
        );
        $this->totalPool = round(
            array_sum(array_column($this->allocations, 'investment_compounded'))
            + array_sum(array_column($this->allocations, 'insurance_compounded'))
            + $this->totalPenalties, 2
        );

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
            'compound_rate'          => $this->compoundRate,
        ]);

        foreach ($this->allocations as $alloc) {
            ShareoutAllocation::create([
                'shareout_id'           => $shareout->id,
                'user_id'               => $alloc['user_id'],
                'contribution_total'    => $alloc['contribution_total'],
                'investment_compounded' => $alloc['investment_compounded'],
                'insurance_total'       => $alloc['insurance_total'],
                'insurance_compounded'  => $alloc['insurance_compounded'],
                'shares_profit'         => $alloc['shares_profit'],
                'insurance_profit'      => $alloc['insurance_profit'],
                'loan_deduction'        => $alloc['loan_deduction'],
                'credit_limit'          => $alloc['credit_limit'],
                'profit_share'          => $alloc['profit_share'],
                'payout_amount'         => $alloc['payout_amount'],
                'action'                => $alloc['action'],
            ]);
        }

        // Mark circle as completed
        Circle::where('id', $this->circleId)->update(['status' => 'completed']);

        $this->successMessage = 'Shareout finalised successfully! K' . number_format($this->totalPool, 2) . ' distributed to ' . count($this->allocations) . ' members.';
        $this->reset('circleId', 'totalContributions', 'totalInsurance', 'totalInterest', 'totalPenalties', 'totalLoansOutstanding', 'totalPool', 'compoundRate', 'allocations', 'previewed', 'existingShareout');
    }

    /* ── View member detail (preview modal) ── */

    public function viewMember($userId)
    {
        // Find the allocation for this member
        $alloc = collect($this->allocations)->firstWhere('user_id', $userId);
        if (!$alloc) return;

        $this->memberDetail = $alloc;

        $circle      = Circle::with('months')->findOrFail($this->circleId);
        $months      = $circle->months->sortBy('month_number');
        $totalMonths = $months->count();
        $rate        = $this->compoundRate / 100;
        $monthIds    = $months->pluck('id');
        $monthNumMap = $months->pluck('month_number', 'id');
        $monthLabels = $months->pluck('label', 'id')->map(fn($l, $id) => $l ?? "Month {$monthNumMap[$id]}");

        // Investment growth
        $shareDecls = ShareDeclaration::where('user_id', $userId)
            ->whereIn('month_id', $monthIds)->get();

        $this->memberInvestments = [];
        foreach ($shareDecls as $decl) {
            $monthNum = $monthNumMap[$decl->month_id] ?? 1;
            $monthsActive = max(0, $totalMonths - $monthNum);
            $finalValue = round($decl->amount * pow(1 + $rate, $monthsActive), 2);
            $this->memberInvestments[] = [
                'month_label'     => $monthLabels[$decl->month_id] ?? "Month {$monthNum}",
                'original_amount' => round($decl->amount, 2),
                'months_active'   => $monthsActive,
                'final_value'     => $finalValue,
                'profit'          => round($finalValue - $decl->amount, 2),
            ];
        }

        // Insurance growth
        $insDecls = InsuranceContribution::where('user_id', $userId)
            ->whereIn('month_id', $monthIds)->get();

        $this->memberInsurance = [];
        foreach ($insDecls as $decl) {
            $monthNum = $monthNumMap[$decl->month_id] ?? 1;
            $monthsActive = max(0, $totalMonths - $monthNum);
            $finalValue = round($decl->amount * pow(1 + $rate, $monthsActive), 2);
            $this->memberInsurance[] = [
                'month_label'     => $monthLabels[$decl->month_id] ?? "Month {$monthNum}",
                'original_amount' => round($decl->amount, 2),
                'months_active'   => $monthsActive,
                'final_value'     => $finalValue,
                'profit'          => round($finalValue - $decl->amount, 2),
            ];
        }

        // Loan history
        $loans = Loan::where('borrower_id', $userId)
            ->whereIn('month_id', $monthIds)
            ->with(['month', 'repayments'])
            ->orderBy('created_at')->get();

        $this->memberLoans = [];
        foreach ($loans as $loan) {
            $this->memberLoans[] = [
                'month_label'   => $loan->month->label ?? "Month {$loan->month->month_number}",
                'amount'        => round($loan->amount, 2),
                'interest_rate' => $loan->interest_rate,
                'total_payable' => round($loan->total_payable, 2),
                'repaid'        => round($loan->repayments->sum('amount_paid'), 2),
                'outstanding'   => round($loan->outstanding_balance, 2),
            ];
        }

        $this->showMemberModal = true;
    }

    public function closeMemberModal()
    {
        $this->showMemberModal = false;
        $this->memberDetail = null;
        $this->memberInvestments = [];
        $this->memberInsurance = [];
        $this->memberLoans = [];
    }

    public function render()
    {
        return view('livewire.village-banking.shareout.shareout-calculator')
            ->layout('layouts.main.master-livewire');
    }
}
