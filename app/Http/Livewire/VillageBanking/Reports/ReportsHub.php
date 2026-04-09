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
use App\Models\VillageBanking\Poll;
use App\Models\VillageBanking\PollVote;
use App\Models\VillageBanking\Rule;
use App\Models\VillageBanking\RuleAcknowledgement;
use App\Models\User;
use App\Traits\HasVillageBankScope;
use Illuminate\Support\Facades\DB;

class ReportsHub extends Component
{
    use HasVillageBankScope;

    /* ── Quick stats for the hub page ── */

    public function getQuickStatsProperty()
    {
        $circleIds = $this->scopedCircleIds();
        $monthIds  = $this->scopedMonthIds();
        $loanIds   = Loan::whereIn('month_id', $monthIds)->pluck('id');

        return [
            'totalCircles'       => Circle::whereIn('id', $circleIds)->count(),
            'activeCircles'      => Circle::whereIn('id', $circleIds)->where('status', 'active')->count(),
            'totalMembers'       => DB::table('circle_members')->whereIn('circle_id', $circleIds)->distinct('user_id')->count('user_id'),
            'totalContributions' => ShareDeclaration::whereIn('month_id', $monthIds)->sum('amount'),
            'totalLoans'         => Loan::whereIn('month_id', $monthIds)->count(),
            'totalLoanAmount'    => Loan::whereIn('month_id', $monthIds)->sum('amount'),
            'totalRepaid'        => Repayment::whereIn('loan_id', $loanIds)->sum('amount_paid'),
            'totalOutstanding'   => Loan::whereIn('month_id', $monthIds)->whereIn('status', ['approved', 'active'])->sum('outstanding_balance'),
            'totalPenalties'     => Penalty::whereIn('loan_id', $loanIds)->sum('amount'),
            'totalInsurance'     => InsuranceContribution::whereIn('month_id', $monthIds)->sum('amount'),
            'totalShareouts'     => Shareout::whereIn('circle_id', $circleIds)->count(),
            'totalPoolDistrib'   => Shareout::whereIn('circle_id', $circleIds)->sum('total_pool'),
            'totalTransactions'  => Transaction::whereIn('month_id', $monthIds)->count(),
            'activePolls'        => Poll::when($this->villageBankId, fn($q) => $q->where('village_bank_id', $this->villageBankId))->where('status', 'active')->count(),
            'totalRules'         => Rule::when($this->villageBankId, fn($q) => $q->where('village_bank_id', $this->villageBankId))->where('is_active', true)->count(),
        ];
    }

    public function render()
    {
        return view('livewire.village-banking.reports.reports-hub', [
            'stats' => $this->quickStats,
        ])->layout('layouts.main.master-livewire');
    }
}
