<?php

namespace App\Http\Livewire\Ventures;

use App\Models\Venture;
use Livewire\Component;
use Livewire\WithPagination;

class VentureList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 15;
    public $sortField = 'id';
    public $sortDirection = 'desc';

    // Create
    public $showCreateModal = false;
    public $newVenture = '';

    // Edit (inline)
    public $editId = null;
    public $editVenture = '';

    // Delete
    public $deleteId = null;
    public $deleteName = '';

    protected $listeners = ['refreshVentures' => '$refresh'];

    public function updatingSearch()
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

    // ---------- CREATE ----------
    public function openCreateModal()
    {
        $this->newVenture = '';
        $this->resetErrorBag();
        $this->showCreateModal = true;
    }

    public function createVenture()
    {
        $this->validate([
            'newVenture' => 'required|string|max:255|unique:ventures,venture_type',
        ], [
            'newVenture.required' => 'The venture type is required.',
            'newVenture.unique' => 'This venture type already exists.',
        ]);

        Venture::create([
            'venture_type' => trim($this->newVenture),
        ]);

        $this->showCreateModal = false;
        $this->newVenture = '';
        session()->flash('message', 'Venture created successfully.');
    }

    // ---------- EDIT ----------
    public function startEdit($id)
    {
        $venture = Venture::find($id);
        if ($venture) {
            $this->editId = $id;
            $this->editVenture = $venture->venture_type;
            $this->resetErrorBag();
        }
    }

    public function cancelEdit()
    {
        $this->editId = null;
        $this->editVenture = '';
        $this->resetErrorBag();
    }

    public function saveEdit()
    {
        $this->validate([
            'editVenture' => 'required|string|max:255|unique:ventures,venture_type,' . $this->editId,
        ], [
            'editVenture.required' => 'The venture type is required.',
            'editVenture.unique' => 'This venture type already exists.',
        ]);

        $venture = Venture::find($this->editId);
        if ($venture) {
            $venture->update([
                'venture_type' => trim($this->editVenture),
            ]);
            session()->flash('message', 'Venture updated successfully.');
        }

        $this->editId = null;
        $this->editVenture = '';
    }

    // ---------- DELETE ----------
    public function confirmDelete($id)
    {
        $venture = Venture::find($id);
        if ($venture) {
            $this->deleteId = $id;
            $this->deleteName = $venture->venture_type;
        }
    }

    public function deleteVenture()
    {
        $venture = Venture::find($this->deleteId);
        if ($venture) {
            $venture->delete();
            session()->flash('message', 'Venture deleted successfully.');
        }
        $this->deleteId = null;
        $this->deleteName = '';
    }

    public function cancelDelete()
    {
        $this->deleteId = null;
        $this->deleteName = '';
    }

    public function render()
    {
        $query = Venture::query();

        if (!empty($this->search)) {
            $query->where('venture_type', 'like', '%' . trim($this->search) . '%');
        }

        $query->orderBy($this->sortField, $this->sortDirection);

        $ventures = $query->paginate($this->perPage);

        return view('livewire.ventures.venture-list', [
            'ventures' => $ventures,
        ])->layout('layouts.main.master-livewire');
    }
}
