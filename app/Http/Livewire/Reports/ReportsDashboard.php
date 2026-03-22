<?php

namespace App\Http\Livewire\Reports;

use App\Models\IndependentProducer;
use App\Models\Province;
use App\Models\Status;
use App\Models\Technology;
use App\Models\Venture;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ReportsDashboard extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    /* ── Filters ──────────────────────── */
    public $filterTechnology = '';
    public $filterProvince = '';
    public $filterStatus = '';
    public $filterVenture = '';
    public $search = '';
    public $perPage = 15;
    public $sortField = 'system_ref';
    public $sortDirection = 'asc';

    /* ── Active tab ───────────────────── */
    public $activeTab = 'overview'; // overview | table | charts

    protected $queryString = [
        'activeTab' => ['except' => 'overview'],
        'filterTechnology' => ['except' => ''],
        'filterProvince' => ['except' => ''],
        'filterStatus' => ['except' => ''],
        'filterVenture' => ['except' => ''],
        'search' => ['except' => ''],
        'perPage' => ['except' => 15],
    ];

    /* ── Lifecycle ────────────────────── */

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterTechnology()
    {
        $this->resetPage();
    }

    public function updatingFilterProvince()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function updatingFilterVenture()
    {
        $this->resetPage();
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function clearFilters()
    {
        $this->filterTechnology = '';
        $this->filterProvince = '';
        $this->filterStatus = '';
        $this->filterVenture = '';
        $this->search = '';
        $this->resetPage();
    }

    /* ── Sorting ──────────────────────── */

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    /* ── Computed Data ────────────────── */

    private function baseQuery()
    {
        return IndependentProducer::query()
            ->when($this->filterTechnology, fn($q) => $q->where('engagement_number', $this->filterTechnology))
            ->when($this->filterProvince, fn($q) => $q->where('province_id', $this->filterProvince))
            ->when($this->filterStatus, fn($q) => $q->where('status_of_engagement', $this->filterStatus))
            ->when($this->filterVenture, fn($q) => $q->where('type_of_venture', $this->filterVenture))
            ->when($this->search, fn($q) => $q->where(function ($q2) {
                $q2->where('name_of_ipp', 'LIKE', '%' . $this->search . '%')
                   ->orWhere('system_ref', 'LIKE', '%' . $this->search . '%')
                   ->orWhere('contact_person_name', 'LIKE', '%' . $this->search . '%');
            }));
    }

    private function getOverviewStats()
    {
        $all = IndependentProducer::query();

        $totalCount = $all->count();
        $totalCapacity = (float) $all->sum(DB::raw("TO_NUMBER(size_of_plant DEFAULT 0 ON CONVERSION ERROR)"));

        // Technology breakdown
        $byTechnology = IndependentProducer::select(
                'engagement_number',
                DB::raw('count(*) as total'),
                DB::raw('sum(TO_NUMBER(size_of_plant DEFAULT 0 ON CONVERSION ERROR)) as total_mw')
            )
            ->groupBy('engagement_number')
            ->orderByDesc('total')
            ->get();

        // Province breakdown
        $byProvince = IndependentProducer::select(
                'province_id',
                DB::raw('count(*) as total'),
                DB::raw('sum(TO_NUMBER(size_of_plant DEFAULT 0 ON CONVERSION ERROR)) as total_mw')
            )
            ->groupBy('province_id')
            ->orderByDesc('total')
            ->get()
            ->map(function ($item) {
                $item->province_name = Province::find($item->province_id)->province ?? 'Unknown';
                return $item;
            });

        // Venture breakdown
        $byVenture = IndependentProducer::select(
                'type_of_venture',
                DB::raw('count(*) as total'),
                DB::raw('sum(TO_NUMBER(size_of_plant DEFAULT 0 ON CONVERSION ERROR)) as total_mw')
            )
            ->groupBy('type_of_venture')
            ->orderByDesc('total')
            ->get()
            ->map(function ($item) {
                $item->venture_name = $item->type_of_venture ?? 'Unknown';
                return $item;
            });

        // Status breakdown
        $byStatus = IndependentProducer::select(
                'status_of_engagement',
                DB::raw('count(*) as total'),
                DB::raw('sum(TO_NUMBER(size_of_plant DEFAULT 0 ON CONVERSION ERROR)) as total_mw')
            )
            ->groupBy('status_of_engagement')
            ->orderByDesc('total')
            ->get();

        return compact('totalCount', 'totalCapacity', 'byTechnology', 'byProvince', 'byVenture', 'byStatus');
    }

    private function getChartData()
    {
        // Technology pie chart
        $techPie = IndependentProducer::select(
                'engagement_number as name',
                DB::raw('sum(TO_NUMBER(size_of_plant DEFAULT 0 ON CONVERSION ERROR)) as value')
            )
            ->when($this->filterVenture, fn($q) => $q->where('type_of_venture', $this->filterVenture))
            ->groupBy('engagement_number')
            ->get()
            ->toArray();

        // Province bar chart
        $provinceBar = IndependentProducer::select(
                'province_id',
                DB::raw('count(*) as count'),
                DB::raw('sum(TO_NUMBER(size_of_plant DEFAULT 0 ON CONVERSION ERROR)) as total_mw')
            )
            ->when($this->filterVenture, fn($q) => $q->where('type_of_venture', $this->filterVenture))
            ->when($this->filterTechnology, fn($q) => $q->where('engagement_number', $this->filterTechnology))
            ->groupBy('province_id')
            ->get()
            ->map(function ($item) {
                $item->name = Province::find($item->province_id)->province ?? 'Unknown';
                return $item;
            })
            ->toArray();

        // Venture breakdown for pie
        $venturePie = IndependentProducer::select(
                'type_of_venture',
                DB::raw('count(*) as value')
            )
            ->when($this->filterTechnology, fn($q) => $q->where('engagement_number', $this->filterTechnology))
            ->groupBy('type_of_venture')
            ->get()
            ->map(function ($item) {
                $item->name = $item->type_of_venture ?? 'Unknown';
                return $item;
            })
            ->toArray();

        // Status bar chart
        $statusBar = IndependentProducer::select(
                'status_of_engagement as name',
                DB::raw('count(*) as count'),
                DB::raw('sum(TO_NUMBER(size_of_plant DEFAULT 0 ON CONVERSION ERROR)) as total_mw')
            )
            ->when($this->filterVenture, fn($q) => $q->where('type_of_venture', $this->filterVenture))
            ->when($this->filterTechnology, fn($q) => $q->where('engagement_number', $this->filterTechnology))
            ->groupBy('status_of_engagement')
            ->get()
            ->toArray();

        return compact('techPie', 'provinceBar', 'venturePie', 'statusBar');
    }

    /* ── Render ───────────────────────── */

    public function render()
    {
        $producers = $this->baseQuery()
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $stats = $this->getOverviewStats();
        $chartData = $this->getChartData();

        $provinces = Province::orderBy('province')->get();
        $ventures = Venture::orderBy('venture_type')->get();
        $technologies = IndependentProducer::select('engagement_number')
            ->distinct()
            ->whereNotNull('engagement_number')
            ->orderBy('engagement_number')
            ->pluck('engagement_number');

        return view('livewire.reports.reports-dashboard', [
            'producers' => $producers,
            'stats' => $stats,
            'chartData' => $chartData,
            'provinces' => $provinces,
            'ventures' => $ventures,
            'technologies' => $technologies,
        ])->layout('layouts.main.master-livewire');
    }
}
