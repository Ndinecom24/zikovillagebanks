<?php

namespace App\Http\Livewire\Provinces;

use App\Models\Province;
use App\Models\IndependentProducer;
use Livewire\Component;
use Livewire\WithPagination;

class ProvinceList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 15;
    public $sortField = 'id';
    public $sortDirection = 'asc';

    // Create
    public $showCreateModal = false;
    public $newProvince = '';

    // Inline edit
    public $editId = null;
    public $editProvince = '';

    // Delete
    public $deleteId = null;
    public $deleteName = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 15],
    ];

    /* ── Lifecycle ──────────────────── */

    public function updatingSearch()
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
        $this->newProvince = '';
        $this->showCreateModal = true;
    }

    public function createProvince()
    {
        $this->validate([
            'newProvince' => 'required|string|max:255|unique:provinces,province',
        ], [
            'newProvince.required' => 'Province name is required.',
            'newProvince.unique'   => 'This province already exists.',
        ]);

        Province::create([
            'province' => strtoupper(trim($this->newProvince)),
        ]);

        $this->showCreateModal = false;
        $this->newProvince = '';
        session()->flash('message', 'Province created successfully.');
    }

    /* ── Inline Edit ────────────────── */

    public function startEdit($id)
    {
        $prov = Province::findOrFail($id);
        $this->editId = $prov->id;
        $this->editProvince = $prov->province;
        $this->resetValidation();
    }

    public function saveEdit()
    {
        $this->validate([
            'editProvince' => 'required|string|max:255|unique:provinces,province,' . $this->editId,
        ], [
            'editProvince.required' => 'Province name is required.',
            'editProvince.unique'   => 'This province already exists.',
        ]);

        Province::findOrFail($this->editId)->update([
            'province' => strtoupper(trim($this->editProvince)),
        ]);

        $this->editId = null;
        $this->editProvince = '';
        session()->flash('message', 'Province updated successfully.');
    }

    public function cancelEdit()
    {
        $this->editId = null;
        $this->editProvince = '';
        $this->resetValidation();
    }

    /* ── Delete ─────────────────────── */

    public function confirmDelete($id)
    {
        $prov = Province::findOrFail($id);
        $this->deleteId = $prov->id;
        $this->deleteName = $prov->province;
    }

    public function deleteProvince()
    {
        Province::findOrFail($this->deleteId)->delete();
        $this->deleteId = null;
        $this->deleteName = '';
        session()->flash('message', 'Province deleted successfully.');
    }

    public function cancelDelete()
    {
        $this->deleteId = null;
        $this->deleteName = '';
    }

    /* ── Render ─────────────────────── */

    public function render()
    {
        $provinces = Province::withCount('districts')
            ->when($this->search, function ($q) {
                $q->where('province', 'LIKE', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.provinces.province-list', [
            'provinces' => $provinces,
        ])->layout('layouts.main.master-livewire');
    }
}
