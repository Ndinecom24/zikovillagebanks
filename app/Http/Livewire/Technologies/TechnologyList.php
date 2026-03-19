<?php

namespace App\Http\Livewire\Technologies;

use App\Models\Technology;
use App\Models\IndependentProducer;
use Livewire\Component;
use Livewire\WithPagination;

class TechnologyList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 15;
    public $sortField = 'id';
    public $sortDirection = 'desc';

    // Create
    public $showCreateModal = false;
    public $newTechnology = '';

    // Edit (inline)
    public $editId = null;
    public $editTechnology = '';

    // Delete
    public $deleteId = null;
    public $deleteName = '';

    // Show details
    public $showDetailModal = false;
    public $detailTechnology = null;
    public $detailIpps = [];

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
        $this->newTechnology = '';
        $this->showCreateModal = true;
    }

    public function createTechnology()
    {
        $this->validate([
            'newTechnology' => 'required|string|max:255|unique:technologies,technology_name',
        ], [
            'newTechnology.required' => 'Technology name is required.',
            'newTechnology.unique'   => 'This technology already exists.',
        ]);

        Technology::create([
            'technology_name' => strtoupper(trim($this->newTechnology)),
        ]);

        $this->showCreateModal = false;
        $this->newTechnology = '';
        session()->flash('message', 'Technology created successfully.');
    }

    /* ── Inline Edit ────────────────── */

    public function startEdit($id)
    {
        $tech = Technology::findOrFail($id);
        $this->editId = $tech->id;
        $this->editTechnology = $tech->technology_name;
        $this->showDetailModal = false;
        $this->detailTechnology = null;
        $this->detailIpps = [];
        $this->resetValidation();
    }

    public function saveEdit()
    {
        $this->validate([
            'editTechnology' => 'required|string|max:255|unique:technologies,technology_name,' . $this->editId,
        ], [
            'editTechnology.required' => 'Technology name is required.',
            'editTechnology.unique'   => 'This technology already exists.',
        ]);

        $tech = Technology::findOrFail($this->editId);
        $oldName = $tech->technology_name;
        $newName = strtoupper(trim($this->editTechnology));

        $tech->update(['technology_name' => $newName]);

        // Also update any IPPs that reference the old technology name
        if ($oldName !== $newName) {
            IndependentProducer::where('technology', $oldName)
                ->update(['technology' => $newName]);
        }

        $this->editId = null;
        $this->editTechnology = '';
        session()->flash('message', 'Technology updated successfully.');
    }

    public function cancelEdit()
    {
        $this->editId = null;
        $this->editTechnology = '';
        $this->resetValidation();
    }

    /* ── Show Details ───────────────── */

    public function showDetails($id)
    {
        $this->detailTechnology = Technology::findOrFail($id);
        $this->detailIpps = IndependentProducer::where('technology', $this->detailTechnology->technology_name)
            ->orderBy('id', 'desc')
            ->limit(20)
            ->get()
            ->toArray();
        $this->showDetailModal = true;
    }

    public function closeDetail()
    {
        $this->showDetailModal = false;
        $this->detailTechnology = null;
        $this->detailIpps = [];
    }

    /* ── Delete ─────────────────────── */

    public function confirmDelete($id)
    {
        $tech = Technology::findOrFail($id);
        $this->deleteId = $tech->id;
        $this->deleteName = $tech->technology_name;
    }

    public function deleteTechnology()
    {
        Technology::findOrFail($this->deleteId)->delete();
        $this->deleteId = null;
        $this->deleteName = '';
        session()->flash('message', 'Technology deleted successfully.');
    }

    public function cancelDelete()
    {
        $this->deleteId = null;
        $this->deleteName = '';
    }

    /* ── Render ─────────────────────── */

    public function render()
    {
        $technologies = Technology::query()
            ->when($this->search, function ($q) {
                $q->where('technology_name', 'LIKE', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.technologies.technology-list', [
            'technologies' => $technologies,
        ])->layout('layouts.main.master-livewire');
    }
}
