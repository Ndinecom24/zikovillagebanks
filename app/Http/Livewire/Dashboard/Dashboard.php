<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\IndependentProducer;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $technologyFilter = '';
    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $perPage = 15;
    public $showPasswordModal = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'technologyFilter' => ['except' => '', 'as' => 'engagement_number'],
    ];

    public function mount()
    {
        // Check if password change is required
        $pwdNotChanged = config('constants.password_not_changed');
        $user = Auth::user();

        if ($pwdNotChanged !== null && (int) $pwdNotChanged === (int) $user->password_changed) {
            $this->showPasswordModal = true;
        } elseif ($user->password === '$2y$10$IEb9UtrGydjucN3uD4VWZ.us5bKNTNxmwUVgpwHWGm.ids9j6q/IC') {
            $this->showPasswordModal = true;
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingTechnologyFilter()
    {
        $this->resetPage();
    }

    public function filterByTechnology($tech)
    {
        if ($this->technologyFilter === $tech) {
            $this->technologyFilter = '';
        } else {
            $this->technologyFilter = $tech;
        }
        $this->resetPage();
    }

    public function clearFilter()
    {
        $this->technologyFilter = '';
        $this->search = '';
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

    public function getTechnologyCountsProperty()
    {
        $counts = IndependentProducer::selectRaw('engagement_number, COUNT(*) as total')
            ->groupBy('engagement_number')
            ->pluck('total', 'engagement_number')
            ->toArray();

        return $counts;
    }

    public function getTotalCountProperty()
    {
        return IndependentProducer::count();
    }

    public function render()
    {
        $query = IndependentProducer::query();

        // Apply technology filter
        if (!empty($this->technologyFilter)) {
            $query->where('engagement_number', '=', trim($this->technologyFilter));
        }

        // Apply search across multiple columns
        if (!empty($this->search)) {
            $searchTerm = '%' . trim($this->search) . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('system_ref', 'like', $searchTerm)
                  ->orWhere('name_of_ipp', 'like', $searchTerm)
                  ->orWhere('engagement_number', 'like', $searchTerm)
                  ->orWhere('status_of_engagement', 'like', $searchTerm)
                  ->orWhere('size_of_plant', 'like', $searchTerm)
                  ->orWhere('voltage_level', 'like', $searchTerm)
                  ->orWhere('available_capacity', 'like', $searchTerm);
            });
        }

        // Apply sorting
        $query->orderBy($this->sortField, $this->sortDirection);

        $applications = $query->paginate($this->perPage);

        return view('livewire.dashboard.dashboard', [
            'applications' => $applications,
            'technologyCounts' => $this->technologyCounts,
            'totalCount' => $this->totalCount,
        ])->layout('layouts.main.master-livewire');
    }
}
