<?php

namespace App\Http\Livewire\ConnectionPoints;

use App\Models\ConnectionPoints;
use App\Models\Districts;
use App\Models\Province;
use App\Models\Status;
use Livewire\Component;
use Livewire\WithPagination;

class ConnectionPointList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 15;
    public $sortField = 'substation';
    public $sortDirection = 'asc';
    public $filterProvince = '';
    public $filterDistrict = '';

    // Create
    public $showCreateModal = false;
    public $newSubstation = '';
    public $newVoltageLevel = '';
    public $newLayout = '';
    public $newFirmCapacity = '';
    public $newInstalledCapacity = '';
    public $newSubstationCapacity = '';
    public $newCoordinates = '';
    public $newStatusId = '';
    public $newDistrictId = '';
    public $newProvinceId = '';

    // Inline edit
    public $editId = null;
    public $editSubstation = '';
    public $editVoltageLevel = '';
    public $editLayout = '';
    public $editFirmCapacity = '';
    public $editInstalledCapacity = '';
    public $editSubstationCapacity = '';
    public $editCoordinates = '';
    public $editStatusId = '';
    public $editDistrictId = '';

    // Delete
    public $deleteId = null;
    public $deleteName = '';

    // Show details
    public $showDetailModal = false;
    public $detailPoint = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 15],
        'filterProvince' => ['except' => ''],
        'filterDistrict' => ['except' => ''],
    ];

    /* ── Lifecycle ──────────────────── */

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterProvince()
    {
        $this->filterDistrict = '';
        $this->resetPage();
    }

    public function updatingFilterDistrict()
    {
        $this->resetPage();
    }

    public function updatedNewProvinceId()
    {
        $this->newDistrictId = '';
    }

    /* ── Sorting ────────────────────── */

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    /* ── Create ─────────────────────── */

    public function openCreateModal()
    {
        $this->resetValidation();
        $this->newSubstation = '';
        $this->newVoltageLevel = '';
        $this->newLayout = '';
        $this->newFirmCapacity = '';
        $this->newInstalledCapacity = '';
        $this->newSubstationCapacity = '';
        $this->newCoordinates = '';
        $this->newStatusId = '';
        $this->newDistrictId = '';
        $this->newProvinceId = '';
        $this->showCreateModal = true;
    }

    public function createConnectionPoint()
    {
        $this->validate([
            'newSubstation' => 'required|string|max:255',
            'newDistrictId' => 'required|exists:districts,id',
        ], [
            'newSubstation.required' => 'Substation name is required.',
            'newDistrictId.required' => 'Please select a district.',
        ]);

        ConnectionPoints::create([
            'district_id' => $this->newDistrictId,
            'substation' => strtoupper(trim($this->newSubstation)),
            'voltage_level' => $this->newVoltageLevel ?: null,
            'layout' => $this->newLayout ?: null,
            'firm_capacity' => $this->newFirmCapacity ?: null,
            'installed_capacity' => $this->newInstalledCapacity ?: null,
            'substation_capacity' => $this->newSubstationCapacity ?: null,
            'coordinates' => $this->newCoordinates ?: null,
            'status_id' => $this->newStatusId ?: null,
        ]);

        $this->showCreateModal = false;
        session()->flash('message', 'Connection point created successfully.');
    }

    /* ── Inline Edit ────────────────── */

    public function startEdit($id)
    {
        $cp = ConnectionPoints::findOrFail($id);
        $this->editId = $cp->id;
        $this->editSubstation = $cp->substation;
        $this->editVoltageLevel = $cp->voltage_level;
        $this->editLayout = $cp->layout;
        $this->editFirmCapacity = $cp->firm_capacity;
        $this->editInstalledCapacity = $cp->installed_capacity;
        $this->editSubstationCapacity = $cp->substation_capacity;
        $this->editCoordinates = $cp->coordinates;
        $this->editStatusId = $cp->status_id;
        $this->editDistrictId = $cp->district_id;
        $this->resetValidation();
    }

    public function saveEdit()
    {
        $this->validate([
            'editSubstation' => 'required|string|max:255',
            'editDistrictId' => 'required|exists:districts,id',
        ], [
            'editSubstation.required' => 'Substation name is required.',
            'editDistrictId.required' => 'Please select a district.',
        ]);

        ConnectionPoints::findOrFail($this->editId)->update([
            'substation' => strtoupper(trim($this->editSubstation)),
            'district_id' => $this->editDistrictId,
            'voltage_level' => $this->editVoltageLevel ?: null,
            'layout' => $this->editLayout ?: null,
            'firm_capacity' => $this->editFirmCapacity ?: null,
            'installed_capacity' => $this->editInstalledCapacity ?: null,
            'substation_capacity' => $this->editSubstationCapacity ?: null,
            'coordinates' => $this->editCoordinates ?: null,
            'status_id' => $this->editStatusId ?: null,
        ]);

        $this->editId = null;
        session()->flash('message', 'Connection point updated successfully.');
    }

    public function cancelEdit()
    {
        $this->editId = null;
        $this->resetValidation();
    }

    /* ── Show Details ───────────────── */

    public function showDetails($id)
    {
        $this->detailPoint = ConnectionPoints::with(['districts.province'])->findOrFail($id);
        $this->showDetailModal = true;
    }

    public function closeDetail()
    {
        $this->showDetailModal = false;
        $this->detailPoint = null;
    }

    /* ── Delete ─────────────────────── */

    public function confirmDelete($id)
    {
        $cp = ConnectionPoints::findOrFail($id);
        $this->deleteId = $cp->id;
        $this->deleteName = $cp->substation;
    }

    public function deleteConnectionPoint()
    {
        ConnectionPoints::findOrFail($this->deleteId)->delete();
        $this->deleteId = null;
        $this->deleteName = '';
        session()->flash('message', 'Connection point deleted successfully.');
    }

    public function cancelDelete()
    {
        $this->deleteId = null;
        $this->deleteName = '';
    }

    /* ── Helper: get districts for filter or create form ── */

    public function getFilteredDistrictsProperty()
    {
        if ($this->filterProvince) {
            return Districts::where('province_id', $this->filterProvince)->orderBy('district')->get();
        }
        return Districts::orderBy('district')->get();
    }

    public function getCreateDistrictsProperty()
    {
        if ($this->newProvinceId) {
            return Districts::where('province_id', $this->newProvinceId)->orderBy('district')->get();
        }
        return collect();
    }

    /* ── Render ─────────────────────── */

    public function render()
    {
        $connectionPoints = ConnectionPoints::with(['districts.province'])
            ->when($this->search, function ($q) {
                $q->where('substation', 'LIKE', '%' . $this->search . '%');
            })
            ->when($this->filterDistrict, function ($q) {
                $q->where('district_id', $this->filterDistrict);
            })
            ->when($this->filterProvince && !$this->filterDistrict, function ($q) {
                $districtIds = Districts::where('province_id', $this->filterProvince)->pluck('id');
                $q->whereIn('district_id', $districtIds);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $provinces = Province::orderBy('province')->get();
        $statuses = Status::orderBy('status')->get();

        return view('livewire.connection-points.connection-point-list', [
            'connectionPoints' => $connectionPoints,
            'provinces' => $provinces,
            'statuses' => $statuses,
        ])->layout('layouts.main.master-livewire');
    }
}
