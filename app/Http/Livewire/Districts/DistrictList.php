<?php

namespace App\Http\Livewire\Districts;

use App\Models\Districts;
use App\Models\Province;
use App\Models\ConnectionPoints;
use App\Models\IndependentProducer;
use Livewire\Component;
use Livewire\WithPagination;

class DistrictList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 15;
    public $sortField = 'district';
    public $sortDirection = 'asc';
    public $filterProvince = '';

    // Create
    public $showCreateModal = false;
    public $newDistrict = '';
    public $newProvinceId = '';

    // Inline edit
    public $editId = null;
    public $editDistrict = '';
    public $editProvinceId = '';

    // Delete
    public $deleteId = null;
    public $deleteName = '';

    // Show details
    public $showDetailModal = false;
    public $detailDistrict = null;
    public $detailSubstations = [];
    public $detailIppCount = 0;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 15],
        'filterProvince' => ['except' => ''],
    ];

    /* ── Lifecycle ──────────────────── */

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterProvince()
    {
        $this->resetPage();
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
        $this->newDistrict = '';
        $this->newProvinceId = '';
        $this->showCreateModal = true;
    }

    public function createDistrict()
    {
        $this->validate([
            'newDistrict' => 'required|string|max:255',
            'newProvinceId' => 'required|exists:provinces,id',
        ], [
            'newDistrict.required' => 'District name is required.',
            'newProvinceId.required' => 'Please select a province.',
        ]);

        Districts::create([
            'province_id' => $this->newProvinceId,
            'district' => strtoupper(trim($this->newDistrict)),
        ]);

        $this->showCreateModal = false;
        $this->newDistrict = '';
        $this->newProvinceId = '';
        session()->flash('message', 'District created successfully.');
    }

    /* ── Inline Edit ────────────────── */

    public function startEdit($id)
    {
        $d = Districts::findOrFail($id);
        $this->editId = $d->id;
        $this->editDistrict = $d->district;
        $this->editProvinceId = $d->province_id;
        $this->resetValidation();
    }

    public function saveEdit()
    {
        $this->validate([
            'editDistrict' => 'required|string|max:255',
            'editProvinceId' => 'required|exists:provinces,id',
        ], [
            'editDistrict.required' => 'District name is required.',
            'editProvinceId.required' => 'Please select a province.',
        ]);

        Districts::findOrFail($this->editId)->update([
            'district' => strtoupper(trim($this->editDistrict)),
            'province_id' => $this->editProvinceId,
        ]);

        $this->editId = null;
        $this->editDistrict = '';
        $this->editProvinceId = '';
        session()->flash('message', 'District updated successfully.');
    }

    public function cancelEdit()
    {
        $this->editId = null;
        $this->editDistrict = '';
        $this->editProvinceId = '';
        $this->resetValidation();
    }

    /* ── Show Details ───────────────── */

    public function showDetails($id)
    {
        $d = Districts::with(['province', 'connectionPoint'])->findOrFail($id);
        $this->detailDistrict = $d;
        $this->detailSubstations = $d->connectionPoint->toArray();
        $this->detailIppCount = IndependentProducer::where('district_id', $id)->count();
        $this->showDetailModal = true;
    }

    public function closeDetail()
    {
        $this->showDetailModal = false;
        $this->detailDistrict = null;
        $this->detailSubstations = [];
        $this->detailIppCount = 0;
    }

    /* ── Delete ─────────────────────── */

    public function confirmDelete($id)
    {
        $d = Districts::findOrFail($id);
        $this->deleteId = $d->id;
        $this->deleteName = $d->district;
    }

    public function deleteDistrict()
    {
        // Delete associated connection points first
        ConnectionPoints::where('district_id', $this->deleteId)->delete();
        Districts::findOrFail($this->deleteId)->delete();
        $this->deleteId = null;
        $this->deleteName = '';
        session()->flash('message', 'District and its substations deleted successfully.');
    }

    public function cancelDelete()
    {
        $this->deleteId = null;
        $this->deleteName = '';
    }

    /* ── Render ─────────────────────── */

    public function render()
    {
        $districts = Districts::with('province')
            ->withCount('connectionPoint')
            ->when($this->search, function ($q) {
                $q->where('district', 'LIKE', '%' . $this->search . '%');
            })
            ->when($this->filterProvince, function ($q) {
                $q->where('province_id', $this->filterProvince);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $provinces = Province::orderBy('province')->get();

        return view('livewire.districts.district-list', [
            'districts' => $districts,
            'provinces' => $provinces,
        ])->layout('layouts.main.master-livewire');
    }
}
