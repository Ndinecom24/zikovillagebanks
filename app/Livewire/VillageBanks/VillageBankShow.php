<?php

namespace App\Livewire\VillageBanks;

use App\Models\User;
use App\Models\VillageBanking\Circle;
use App\Models\VillageBanking\Loan;
use App\Models\VillageBanking\Month;
use App\Models\VillageBanking\Repayment;
use App\Models\VillageBanking\Penalty;
use App\Models\VillageBanking\ShareDeclaration;
use App\Models\VillageBanking\Shareout;
use App\Models\VillageBanking\Transaction;
use App\Models\VillageBanking\VillageBank;
use App\Models\VillageBanking\VillageBankConfiguration;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.main.master-livewire')]
class VillageBankShow extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $bankId;
    public $bank;
    public $activeTab = 'overview'; // overview | members | circles | finance

    /* ── Member management ── */
    public $showAddMember  = false;
    public $memberSearch   = '';
    public $memberRole     = 'member';
    public $selectedUserId = '';

    /* ── Remove member ── */
    public $removeMemberId;
    public $removeMemberName;

    public function mount($bankId)
    {
        $this->bankId = $bankId;
        $this->bank   = VillageBank::with('creator')->findOrFail($bankId);
    }

    /* ── Member management ── */

    public function openAddMember()
    {
        $this->showAddMember = true;
        $this->reset(['memberSearch', 'selectedUserId', 'memberRole']);
    }

    public function closeAddMember()
    {
        $this->showAddMember = false;
    }

    public function getSearchUsersProperty()
    {
        if (strlen($this->memberSearch) < 2) {
            return collect();
        }

        $existingIds = DB::table('village_bank_members')
            ->where('village_bank_id', $this->bankId)
            ->pluck('user_id');

        return User::where('status', 'active')
            ->whereNotIn('id', $existingIds)
            ->where(function ($q) {
                $term = '%' . trim($this->memberSearch) . '%';
                $q->where('name', 'like', $term)
                  ->orWhere('email', 'like', $term)
                  ->orWhere('username', 'like', $term);
            })
            ->limit(10)
            ->get();
    }

    public function addMember()
    {
        $this->validate([
            'selectedUserId' => 'required|exists:users,id',
            'memberRole'     => 'required|in:admin,member',
        ]);

        $bank = VillageBank::findOrFail($this->bankId);

        // Prevent duplicate
        if ($bank->members()->where('user_id', $this->selectedUserId)->exists()) {
            $this->addError('selectedUserId', 'User is already a member of this bank.');
            return;
        }

        $bank->members()->attach($this->selectedUserId, [
            'role'      => $this->memberRole,
            'joined_at' => now(),
        ]);

        session()->flash('message', 'Member added successfully.');
        $this->closeAddMember();
    }

    public function confirmRemoveMember($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $this->removeMemberId   = $userId;
            $this->removeMemberName = $user->name;
        }
    }

    public function removeMember()
    {
        $bank = VillageBank::findOrFail($this->bankId);
        $bank->members()->detach($this->removeMemberId);
        session()->flash('message', 'Member removed successfully.');
        $this->reset(['removeMemberId', 'removeMemberName']);
    }

    public function changeRole($userId, $newRole)
    {
        DB::table('village_bank_members')
            ->where('village_bank_id', $this->bankId)
            ->where('user_id', $userId)
            ->update(['role' => $newRole]);

        session()->flash('message', 'Member role updated.');
    }

    /* ── Computed stats (scoped to this bank) ── */

    public function getStatsProperty()
    {
        $circleIds = Circle::where('village_bank_id', $this->bankId)->pluck('id');
        $monthIds  = Month::whereIn('circle_id', $circleIds)->pluck('id');
        $loanIds   = Loan::whereIn('month_id', $monthIds)->pluck('id');

        return [
            'totalCircles'       => $circleIds->count(),
            'activeCircles'      => Circle::where('village_bank_id', $this->bankId)->where('status', 'active')->count(),
            'totalMembers'       => DB::table('village_bank_members')->where('village_bank_id', $this->bankId)->count(),
            'adminCount'         => DB::table('village_bank_members')->where('village_bank_id', $this->bankId)->where('role', 'admin')->count(),
            'totalContributions' => ShareDeclaration::whereIn('month_id', $monthIds)->sum('amount'),
            'totalLoans'         => Loan::whereIn('month_id', $monthIds)->count(),
            'totalLoanAmount'    => Loan::whereIn('month_id', $monthIds)->sum('amount'),
            'totalRepaid'        => Repayment::whereIn('loan_id', $loanIds)->sum('amount_paid'),
            'totalOutstanding'   => Loan::whereIn('month_id', $monthIds)->whereIn('status', ['approved', 'active'])->sum('outstanding_balance'),
            'totalPenalties'     => Penalty::whereIn('loan_id', $loanIds)->sum('amount'),
            'totalShareouts'     => Shareout::whereIn('circle_id', $circleIds)->count(),
            'totalDistributed'   => Shareout::whereIn('circle_id', $circleIds)->sum('total_pool'),
        ];
    }

    public function render()
    {
        $this->bank = VillageBank::with('creator')->findOrFail($this->bankId);

        $members = $this->bank->members()
            ->orderByRaw("CASE WHEN village_bank_members.role = 'admin' THEN 0 ELSE 1 END")
            ->paginate(15);

        $circles = Circle::where('village_bank_id', $this->bankId)
            ->withCount('members')
            ->with('creator')
            ->orderByDesc('created_at')
            ->get();

        // Load configuration for settings tab
        $config = VillageBankConfiguration::forBank($this->bankId);

        // Load subscription & license for overview tab
        $subscription = $this->bank->activeSubscription;
        $license = $this->bank->activeLicense;

        return view('livewire.village-banks.village-bank-show', [
            'members'      => $members,
            'circles'      => $circles,
            'config'        => $config,
            'subscription' => $subscription,
            'license'      => $license,
        ]);
    }
}
