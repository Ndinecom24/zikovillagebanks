<?php

namespace App\Http\Livewire\VillageBanking\Members;

use App\Models\User;
use Livewire\Component;

class MemberShow extends Component
{
    public $memberId;

    // Member data
    public $member;

    // Stats
    public $totalCircles = 0;
    public $activeLoans = 0;
    public $totalShares = 0;
    public $villageBankCount = 0;

    // Tab
    public $activeTab = 'overview';

    public function mount($memberId)
    {
        $this->memberId = $memberId;

        $this->member = User::with([
            'guarantor',
            'guarantees',
            'circles',
            'loans',
            'shareDeclarations',
            'villageBanks',
            'paymentMethods',
            'roles',
        ])->withCount('circles')->findOrFail($memberId);

        $this->totalCircles    = $this->member->circles->count();
        $this->activeLoans     = $this->member->loans->where('status', 'active')->count();
        $this->totalShares     = $this->member->shareDeclarations->sum('amount');
        $this->villageBankCount = $this->member->villageBanks->count();
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        $circles        = $this->member->circles;
        $loans          = $this->member->loans;
        $villageBanks   = $this->member->villageBanks;
        $paymentMethods = $this->member->paymentMethods;
        $guarantees     = $this->member->guarantees;

        return view('livewire.village-banking.members.member-show', compact(
            'circles',
            'loans',
            'villageBanks',
            'paymentMethods',
            'guarantees',
        ))->layout('layouts.main.master-livewire');
    }
}
