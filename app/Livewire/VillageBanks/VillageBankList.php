<?php

namespace App\Livewire\VillageBanks;

use App\Models\VillageBanking\VillageBank;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

#[Layout('layouts.main.master-livewire')]
class VillageBankList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    #[Url]
    public $search       = '';
    #[Url]
    public $statusFilter = '';
    public $perPage      = 15;

    // Delete
    public $deleteId;
    public $deleteName;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $bank = VillageBank::find($id);
        if ($bank) {
            $this->deleteId   = $id;
            $this->deleteName = $bank->name;
        }
    }

    public function deleteBank()
    {
        $bank = VillageBank::find($this->deleteId);
        if ($bank) {
            $bank->delete();
            session()->flash('message', 'Village Bank "' . $bank->name . '" deleted successfully.');
        }
        $this->reset(['deleteId', 'deleteName']);
    }

    public function toggleStatus($id)
    {
        $bank = VillageBank::find($id);
        if ($bank) {
            $bank->status = $bank->status === 'active' ? 'inactive' : 'active';
            $bank->save();
            session()->flash('message', 'Village Bank "' . $bank->name . '" is now ' . $bank->status . '.');
        }
    }

    public function render()
    {
        $query = VillageBank::with('creator')
            ->withCount(['members', 'circles']);

        if (!empty($this->statusFilter)) {
            $query->where('status', $this->statusFilter);
        }

        if (!empty($this->search)) {
            $term = '%' . trim($this->search) . '%';
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', $term)
                  ->orWhere('code', 'like', $term)
                  ->orWhere('email', 'like', $term);
            });
        }

        $banks = $query->orderByDesc('created_at')->paginate($this->perPage);

        // Stats
        $totalBanks  = VillageBank::count();
        $activeBanks = VillageBank::where('status', 'active')->count();
        $totalBankMembers = \Illuminate\Support\Facades\DB::table('village_bank_members')->distinct('user_id')->count('user_id');
        $totalBankCircles = \App\Models\VillageBanking\Circle::whereNotNull('village_bank_id')->count();

        return view('livewire.village-banks.village-bank-list', compact(
            'banks', 'totalBanks', 'activeBanks', 'totalBankMembers', 'totalBankCircles',
        ));
    }
}
