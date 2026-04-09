<?php

namespace App\Http\Livewire\VillageBanking\Shareout;

use Livewire\Component;
use App\Models\VillageBanking\Shareout;
use App\Models\VillageBanking\ShareoutAllocation;
use App\Models\VillageBanking\ShareDeclaration;
use App\Models\VillageBanking\InsuranceContribution;
use App\Models\VillageBanking\Loan;

class ShareoutMemberDetail extends Component
{
    public Shareout $shareout;
    public ShareoutAllocation $allocation;
    public $investmentGrowth = [];
    public $insuranceGrowth  = [];
    public $loanHistory      = [];

    public function mount($shareoutId, $allocationId)
    {
        $this->shareout = Shareout::with([
            'circle.villageBank',
            'circle.months',
        ])->findOrFail($shareoutId);

        $this->allocation = ShareoutAllocation::with('user')
            ->where('shareout_id', $shareoutId)
            ->findOrFail($allocationId);

        $this->buildInvestmentGrowth();
        $this->buildInsuranceGrowth();
        $this->buildLoanHistory();
    }

    /* ── Investment compound growth per deposit ── */

    private function buildInvestmentGrowth()
    {
        $circle     = $this->shareout->circle;
        $months     = $circle->months->sortBy('month_number');
        $totalMonths = $months->count();
        $rate       = ($this->shareout->compound_rate ?? 5) / 100;
        $userId     = $this->allocation->user_id;
        $monthIds   = $months->pluck('id');

        $declarations = ShareDeclaration::where('user_id', $userId)
            ->whereIn('month_id', $monthIds)
            ->get()
            ->groupBy('month_id');

        $this->investmentGrowth = [];

        foreach ($months as $month) {
            $monthDecls = $declarations[$month->id] ?? collect();
            foreach ($monthDecls as $decl) {
                $monthsActive = max(0, $totalMonths - $month->month_number);
                $finalValue   = round($decl->amount * pow(1 + $rate, $monthsActive), 2);
                $profit       = round($finalValue - $decl->amount, 2);

                $this->investmentGrowth[] = [
                    'month_number'    => $month->month_number,
                    'month_label'     => $month->label ?? "Month {$month->month_number}",
                    'original_amount' => round($decl->amount, 2),
                    'months_active'   => $monthsActive,
                    'final_value'     => $finalValue,
                    'profit'          => $profit,
                ];
            }
        }
    }

    /* ── Insurance compound growth per deposit ── */

    private function buildInsuranceGrowth()
    {
        $circle     = $this->shareout->circle;
        $months     = $circle->months->sortBy('month_number');
        $totalMonths = $months->count();
        $rate       = ($this->shareout->compound_rate ?? 5) / 100;
        $userId     = $this->allocation->user_id;
        $monthIds   = $months->pluck('id');

        $contributions = InsuranceContribution::where('user_id', $userId)
            ->whereIn('month_id', $monthIds)
            ->get()
            ->groupBy('month_id');

        $this->insuranceGrowth = [];

        foreach ($months as $month) {
            $monthContribs = $contributions[$month->id] ?? collect();
            foreach ($monthContribs as $contrib) {
                $monthsActive = max(0, $totalMonths - $month->month_number);
                $finalValue   = round($contrib->amount * pow(1 + $rate, $monthsActive), 2);
                $profit       = round($finalValue - $contrib->amount, 2);

                $this->insuranceGrowth[] = [
                    'month_number'    => $month->month_number,
                    'month_label'     => $month->label ?? "Month {$month->month_number}",
                    'original_amount' => round($contrib->amount, 2),
                    'months_active'   => $monthsActive,
                    'final_value'     => $finalValue,
                    'profit'          => $profit,
                ];
            }
        }
    }

    /* ── Loan history for this member in this circle ── */

    private function buildLoanHistory()
    {
        $circle   = $this->shareout->circle;
        $monthIds = $circle->months->pluck('id');
        $userId   = $this->allocation->user_id;

        $loans = Loan::where('borrower_id', $userId)
            ->whereIn('month_id', $monthIds)
            ->with(['month', 'repayments'])
            ->orderBy('created_at')
            ->get();

        $this->loanHistory = [];

        foreach ($loans as $loan) {
            $repaid = $loan->repayments->sum('amount_paid');

            $this->loanHistory[] = [
                'month_label'   => $loan->month->label ?? "Month {$loan->month->month_number}",
                'amount'        => round($loan->amount, 2),
                'interest_rate' => $loan->interest_rate,
                'total_payable' => round($loan->total_payable, 2),
                'repaid'        => round($repaid, 2),
                'outstanding'   => round($loan->outstanding_balance, 2),
            ];
        }
    }

    public function render()
    {
        return view('livewire.village-banking.shareout.shareout-member-detail')
            ->layout('layouts.main.master-livewire');
    }
}
