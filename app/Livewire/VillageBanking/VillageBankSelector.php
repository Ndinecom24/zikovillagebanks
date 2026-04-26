<?php

namespace App\Livewire\VillageBanking;

use App\Models\VillageBanking\VillageBank;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

/**
 * Shows a modal for users to select which Village Bank to work in.
 * Auto-selects if user only belongs to one bank.
 * Persists choice in session('current_village_bank_id').
 */
class VillageBankSelector extends Component
{
    public $showModal = false;
    public $selectedBankId = null;
    public $currentBankName = '';
    public $bankCount = 0;
    public function mount()
    {
        $user = Auth::user();
        if (!$user) return;

        // Super-admin bypass — they see all banks
        if ($user->user_role_id == 1) {
            $this->currentBankName = session('current_village_bank_name', 'All Banks');
            $this->selectedBankId = session('current_village_bank_id');
            $this->bankCount = VillageBank::where('status', 'active')->count();
            return;
        }

        $userBanks = $user->villageBanks()->where('status', 'active')->get();
        $this->bankCount = $userBanks->count();

        $sessionBankId = session('current_village_bank_id');

        if ($this->bankCount === 0) {
            // User belongs to no bank
            $this->currentBankName = 'No Bank';
            return;
        }

        if ($this->bankCount === 1) {
            // Auto-select the only bank
            $bank = $userBanks->first();
            $this->selectBank($bank->id, false);
            return;
        }

        // Multiple banks
        if ($sessionBankId && $userBanks->contains('id', $sessionBankId)) {
            $bank = $userBanks->firstWhere('id', $sessionBankId);
            $this->selectedBankId = $bank->id;
            $this->currentBankName = $bank->name;
        } else {
            // No selection yet — force modal
            $this->showModal = true;
        }
    }

    #[On('openBankSelector')]
    public function openModal()
    {
        $this->showModal = true;
    }

    #[On('refreshBankSelector')]
    public function refreshBankSelector(): void
    {
        // Livewire re-renders automatically when a listener is triggered
    }

    public function selectBank($bankId, $showFlash = true)
    {
        $user = Auth::user();
        $bank = null;

        if ($user->user_role_id == 1) {
            // Super-admin can pick any bank
            $bank = VillageBank::find($bankId);
        } else {
            // Regular user — verify membership
            $bank = $user->villageBanks()->where('village_banks.id', $bankId)->first();
        }

        if (!$bank) {
            session()->flash('error', 'You do not belong to that village bank.');
            return;
        }

        session([
            'current_village_bank_id'   => $bank->id,
            'current_village_bank_name' => $bank->name,
        ]);

        $this->selectedBankId = $bank->id;
        $this->currentBankName = $bank->name;
        $this->showModal = false;

        if ($showFlash) {
            session()->flash('bank_switched', "Switched to {$bank->name}");
        }

        return redirect(request()->header('Referer', route('home')));
    }

    public function render()
    {
        $user = Auth::user();
        $banks = collect();

        if ($user) {
            if ($user->user_role_id == 1) {
                $banks = VillageBank::where('status', 'active')->orderBy('name')->get();
            } else {
                $banks = $user->villageBanks()->where('status', 'active')->orderBy('name')->get();
            }
        }

        return view('livewire.village-banking.village-bank-selector', [
            'banks' => $banks,
        ]);
    }
}
