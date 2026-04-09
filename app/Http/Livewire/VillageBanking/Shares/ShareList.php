<?php

namespace App\Http\Livewire\VillageBanking\Shares;

use App\Models\VillageBanking\ShareDeclaration as ShareDeclarationModel;
use App\Traits\HasVillageBankScope;
use Livewire\Component;
use Livewire\WithPagination;

class ShareList extends Component
{
    use WithPagination, HasVillageBankScope;

    public $search = '';
    public $circleFilter = '';
    public $monthFilter = '';
    public $perPage = 15;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $queryString = ['search', 'circleFilter', 'monthFilter', 'villageBankId'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCircleFilter()
    {
        $this->resetPage();
    }

    public function updatingMonthFilter()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $query = ShareDeclarationModel::with(['user', 'month.circle'])
            ->whereHas('month.circle', function ($q) {
                // Scope to village bank
                if (!empty($this->villageBankId)) {
                    $q->where('village_bank_id', $this->villageBankId);
                }
                // Circle filter
                if (!empty($this->circleFilter)) {
                    $q->where('id', $this->circleFilter);
                }
            });

        // Month filter
        if (!empty($this->monthFilter)) {
            $query->where('month_id', $this->monthFilter);
        }

        // Search by member name or email
        if (!empty($this->search)) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        $query->orderBy($this->sortField, $this->sortDirection);

        $declarations = $query->paginate($this->perPage);

        // Stats
        $statsQuery = ShareDeclarationModel::whereHas('month.circle', function ($q) {
            if (!empty($this->villageBankId)) {
                $q->where('village_bank_id', $this->villageBankId);
            }
        });

        $totalDeclarations = $statsQuery->count();
        $totalShareAmount  = (clone $statsQuery)->sum('amount');
        $avgShareAmount    = $totalDeclarations > 0 ? $totalShareAmount / $totalDeclarations : 0;
        $uniqueMembers     = (clone $statsQuery)->distinct('user_id')->count('user_id');

        // Get circles for filter dropdown
        $circles = $this->scopedCircleQuery()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('livewire.village-banking.shares.share-list', [
            'declarations'      => $declarations,
            'totalDeclarations' => $totalDeclarations,
            'totalShareAmount'  => $totalShareAmount,
            'avgShareAmount'    => $avgShareAmount,
            'uniqueMembers'     => $uniqueMembers,
            'circles'           => $circles,
        ])->layout('layouts.main.master-livewire');
    }
}
