<?php

namespace App\Http\Livewire\Statuses;

use App\Models\Status;
use Livewire\Component;
use Livewire\WithPagination;

class StatusList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 15;
    public $sortField = 'id';
    public $sortDirection = 'desc';

    // Create
    public $showCreateModal = false;
    public $newStatus = '';

    // Edit
    public $editId = null;
    public $editStatus = '';

    // Delete
    public $deleteId = null;
    public $deleteName = '';

    protected $listeners = ['refreshStatuses' => '$refresh'];

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
        $this->newStatus = '';
        $this->resetErrorBag();
        $this->showCreateModal = true;
    }

    public function createStatus()
    {
        $this->validate([
            'newStatus' => 'required|string|max:255|unique:statuses,status',
        ], [
            'newStatus.required' => 'The status name is required.',
            'newStatus.unique' => 'This status already exists.',
        ]);

        Status::create([
            'status' => strtoupper(trim($this->newStatus)),
        ]);

        $this->showCreateModal = false;
        $this->newStatus = '';
        session()->flash('message', 'Status created successfully.');
    }

    // ---------- EDIT (inline) ----------
    public function startEdit($id)
    {
        $status = Status::find($id);
        if ($status) {
            $this->editId = $id;
            $this->editStatus = $status->status;
            $this->resetErrorBag();
        }
    }

    public function cancelEdit()
    {
        $this->editId = null;
        $this->editStatus = '';
        $this->resetErrorBag();
    }

    public function saveEdit()
    {
        $this->validate([
            'editStatus' => 'required|string|max:255|unique:statuses,status,' . $this->editId,
        ], [
            'editStatus.required' => 'The status name is required.',
            'editStatus.unique' => 'This status already exists.',
        ]);

        $status = Status::find($this->editId);
        if ($status) {
            $status->update([
                'status' => strtoupper(trim($this->editStatus)),
            ]);
            session()->flash('message', 'Status updated successfully.');
        }

        $this->editId = null;
        $this->editStatus = '';
    }

    // ---------- DELETE ----------
    public function confirmDelete($id)
    {
        $status = Status::find($id);
        if ($status) {
            $this->deleteId = $id;
            $this->deleteName = $status->status;
        }
    }

    public function deleteStatus()
    {
        $status = Status::find($this->deleteId);
        if ($status) {
            $status->delete();
            session()->flash('message', 'Status deleted successfully.');
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
        $query = Status::query();

        if (!empty($this->search)) {
            $query->where('status', 'like', '%' . trim($this->search) . '%');
        }

        $query->orderBy($this->sortField, $this->sortDirection);

        $statuses = $query->paginate($this->perPage);

        return view('livewire.statuses.status-list', [
            'statuses' => $statuses,
        ])->layout('layouts.main.master-livewire');
    }
}
