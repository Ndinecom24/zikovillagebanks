<?php

namespace App\Livewire\VillageBanking\Dashboard;

use App\Models\Subscription\BankApplication;
use App\Models\User;
use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\Loan;
use App\Models\VillageBanking\Repayment;
use App\Models\VillageBanking\Penalty;
use App\Models\VillageBanking\ShareDeclaration;
use App\Models\VillageBanking\InsuranceContribution;
use App\Models\VillageBanking\Transaction;
use App\Models\VillageBanking\Shareout;
use App\Models\VillageBanking\Month;
use App\Traits\HasVillageBankScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.main.master-livewire')]
class Dashboard extends Component
{
    use HasVillageBankScope;
    public $showPasswordModal = false;

    public function mount()
    {
        $pwdNotChanged = config('constants.password_not_changed');
        $user = Auth::user();

        if ($pwdNotChanged !== null && (int) $pwdNotChanged === (int) $user->password_changed) {
            $this->showPasswordModal = true;
        }
    }

    public function render()
    {
        $user = Auth::user();

        /* ══════════════════════════════
         *  SYSTEM-WIDE STATS (scoped by village bank)
         * ══════════════════════════════ */
        $circleIds = $this->scopedCircleIds();
        $monthIds  = Month::whereIn('circle_id', $circleIds)->pluck('id');
        $loanIds   = Loan::whereIn('month_id', $monthIds)->pluck('id');

        $activeCircles    = $this->scopedCircleQuery()->where('status', 'active')->count();
        $totalCircles     = $this->scopedCircleQuery()->count();
        $totalMembers     = DB::table('circle_members')
                                ->whereIn('circle_id', $circleIds)
                                ->distinct('user_id')->count('user_id');
        $pendingMembers   = User::where('status', 'pending')->count();
        $activeLoans      = Loan::whereIn('month_id', $monthIds)->whereIn('status', ['approved', 'active'])->count();
        $pendingLoans     = Loan::whereIn('month_id', $monthIds)->where('status', 'pending')->count();

        $totalContributions = ShareDeclaration::whereIn('month_id', $monthIds)->sum('amount');
        $totalLoanAmount    = Loan::whereIn('month_id', $monthIds)->sum('amount');
        $totalRepaid        = Repayment::whereIn('loan_id', $loanIds)->sum('amount_paid');
        $totalOutstanding   = Loan::whereIn('month_id', $monthIds)->whereIn('status', ['approved', 'active'])->sum('outstanding_balance');
        $totalPenalties     = Penalty::whereIn('loan_id', $loanIds)->sum('amount');
        $totalInsurance     = InsuranceContribution::whereIn('month_id', $monthIds)->sum('amount');

        $pendingPayments    = Transaction::whereIn('month_id', $monthIds)->where('status', 'pending')->count();
        $confirmedPayments  = Transaction::whereIn('month_id', $monthIds)->where('status', 'confirmed')->sum('amount');

        $shareoutsDone      = Shareout::whereIn('circle_id', $circleIds)->count();
        $totalDistributed   = Shareout::whereIn('circle_id', $circleIds)->sum('total_pool');

        /* ══════════════════════════════
         *  PENDING APPLICATIONS (super admin only)
         * ══════════════════════════════ */
        $pendingApplications = 0;
        if ($user->isSuperAdmin()) {
            $pendingApplications = BankApplication::where('status', 'pending')->count();
        }

        /* ══════════════════════════════
         *  MY STATS (logged-in user)
         * ══════════════════════════════ */
        /* ══════════════════════════════
         *  MY STATS (logged-in user, scoped)
         * ══════════════════════════════ */
        $myCircles = $user->circles()
            ->where('status', 'active')
            ->when(!empty($this->villageBankId), fn ($q) => $q->where('village_bank_id', $this->villageBankId))
            ->get();
        $myCircleIds = $myCircles->pluck('id');
        $myMonthIds  = Month::whereIn('circle_id', $myCircleIds)->pluck('id');

        $myContributions   = ShareDeclaration::where('user_id', $user->id)
            ->whereIn('month_id', $myMonthIds)->sum('amount');
        $myActiveLoans     = Loan::where('borrower_id', $user->id)
            ->whereIn('month_id', $myMonthIds)
            ->whereIn('status', ['approved', 'active'])->count();
        $myOutstanding     = Loan::where('borrower_id', $user->id)
            ->whereIn('month_id', $myMonthIds)
            ->whereIn('status', ['approved', 'active'])->sum('outstanding_balance');
        $myLoans           = Loan::where('borrower_id', $user->id)
            ->whereIn('month_id', $myMonthIds)
            ->with('month.circle')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        /* ══════════════════════════════
         *  RECENT ACTIVITY
         * ══════════════════════════════ */
        /* ══════════════════════════════
         *  RECENT ACTIVITY (scoped)
         * ══════════════════════════════ */
        $recentLoans = Loan::with('borrower', 'month.circle')
            ->whereIn('month_id', $monthIds)
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        $recentPayments = Transaction::with('sender', 'receiver')
            ->whereIn('month_id', $monthIds)
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        /* ══════════════════════════════
         *  CIRCLE HEALTH
         * ══════════════════════════════ */
        /* ══════════════════════════════
         *  CIRCLE HEALTH (scoped)
         * ══════════════════════════════ */
        $circleHealth = $this->scopedCircleQuery()
            ->where('status', 'active')
            ->withCount('members')
            ->with(['months' => fn ($q) => $q->where('status', 'active')])
            ->orderBy('name')
            ->limit(6)
            ->get();

        return view('livewire.village-banking.dashboard.dashboard', compact(
            'activeCircles', 'totalCircles', 'totalMembers', 'pendingMembers',
            'activeLoans', 'pendingLoans',
            'totalContributions', 'totalLoanAmount', 'totalRepaid', 'totalOutstanding',
            'totalPenalties', 'totalInsurance',
            'pendingPayments', 'confirmedPayments',
            'shareoutsDone', 'totalDistributed',
            'pendingApplications',
            'myCircles', 'myContributions', 'myActiveLoans', 'myOutstanding', 'myLoans',
            'recentLoans', 'recentPayments',
            'circleHealth',
        ));
    }
}
