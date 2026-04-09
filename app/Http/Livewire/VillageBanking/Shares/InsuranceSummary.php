<?php

namespace App\Http\Livewire\VillageBanking\Shares;

use App\Models\VillageBanking\InsuranceContribution;
use App\Models\VillageBanking\InsuranceConfig;
use App\Traits\HasVillageBankScope;
use Livewire\Component;
use Livewire\WithPagination;

class InsuranceSummary extends Component
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
        $query = InsuranceContribution::with(['user', 'month.circle'])
            ->whereHas('month.circle', function ($q) {
                if (!empty($this->villageBankId)) {
                    $q->where('village_bank_id', $this->villageBankId);
                }
                if (!empty($this->circleFilter)) {
                    $q->where('id', $this->circleFilter);
                }
            });

        if (!empty($this->monthFilter)) {
            $query->where('month_id', $this->monthFilter);
        }

        if (!empty($this->search)) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        $query->orderBy($this->sortField, $this->sortDirection);

        $contributions = $query->paginate($this->perPage);

        // Stats
        $statsQuery = InsuranceContribution::whereHas('month.circle', function ($q) {
            if (!empty($this->villageBankId)) {
                $q->where('village_bank_id', $this->villageBankId);
            }
        });

        $totalContributions = $statsQuery->count();
        $totalAmount         = (clone $statsQuery)->sum('amount');
        $avgAmount           = $totalContributions > 0 ? $totalAmount / $totalContributions : 0;
        $uniqueMembers       = (clone $statsQuery)->distinct('user_id')->count('user_id');

        // Circles with active insurance configs
        $circles = $this->scopedCircleQuery()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        // Insurance configs for context
        $configs = InsuranceConfig::whereIn('circle_id', $circles->pluck('id'))->get()->keyBy('circle_id');

        return view('livewire.village-banking.shares.insurance-summary', [
            'contributions'      => $contributions,
            'totalContributions' => $totalContributions,
            'totalAmount'        => $totalAmount,
            'avgAmount'          => $avgAmount,
            'uniqueMembers'      => $uniqueMembers,
            'circles'            => $circles,
            'configs'            => $configs,
        ])->layout('layouts.main.master-livewire');
    }
}
