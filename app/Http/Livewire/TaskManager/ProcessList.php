<?php

namespace App\Http\Livewire\TaskManager;

use App\Models\Process;
use Livewire\Component;
use Livewire\WithPagination;

class ProcessList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    /* ── Filters ──────────────────────── */
    public $search = '';
    public $filterStatus = '';
    public $perPage = 15;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    /* ── Create/Edit Modal ────────────── */
    public $showFormModal = false;
    public $editingId = null;
    public $formName = '';
    public $formDescription = '';
    public $formStatus = 'active';

    /* ── Delete ───────────────────────── */
    public $deleteId = null;
    public $deleteName = '';

    protected $queryString = [
        'search'       => ['except' => ''],
        'filterStatus' => ['except' => ''],
        'perPage'      => ['except' => 15],
    ];

    public function updatingSearch()       { $this->resetPage(); }
    public function updatingFilterStatus() { $this->resetPage(); }

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

    /* ── Create / Edit ────────────────── */

    public function openFormModal($id = null)
    {
        $this->resetValidation();
        $this->reset(['editingId', 'formName', 'formDescription', 'formStatus']);

        if ($id) {
            $process = Process::findOrFail($id);
            $this->editingId       = $process->id;
            $this->formName        = $process->name;
            $this->formDescription = $process->description;
            $this->formStatus      = $process->status;
        }

        $this->showFormModal = true;
    }

    public function closeFormModal()
    {
        $this->showFormModal = false;
        $this->reset(['editingId', 'formName', 'formDescription', 'formStatus']);
        $this->resetValidation();
    }

    public function saveProcess()
    {
        $this->validate([
            'formName'        => 'required|string|max:255',
            'formDescription' => 'nullable|string|max:1000',
            'formStatus'      => 'required|in:active,inactive',
        ]);

        Process::updateOrCreate(
            ['id' => $this->editingId],
            [
                'name'        => $this->formName,
                'description' => $this->formDescription,
                'status'      => $this->formStatus,
                'created_by'  => $this->editingId ? Process::find($this->editingId)->created_by : auth()->id(),
            ]
        );

        $msg = $this->editingId ? 'Process updated.' : 'Process created.';
        $this->closeFormModal();
        session()->flash('message', $msg);
    }

    /* ── Delete ───────────────────────── */

    public function confirmDelete($id)
    {
        $process = Process::findOrFail($id);
        $this->deleteId   = $process->id;
        $this->deleteName = $process->name;
    }

    public function deleteProcess()
    {
        Process::findOrFail($this->deleteId)->delete();
        $this->cancelDelete();
        session()->flash('message', 'Process deleted.');
    }

    public function cancelDelete()
    {
        $this->deleteId   = null;
        $this->deleteName = '';
    }

    /* ── Helpers ──────────────────────── */

    public function clearFilters()
    {
        $this->search       = '';
        $this->filterStatus = '';
        $this->resetPage();
    }

    /* ── Render ───────────────────────── */

    public function render()
    {
        $processes = Process::query()
            ->withCount('stages')
            ->when($this->search, function ($q) {
                $q->where(function ($q2) {
                    $q2->where('name', 'LIKE', '%' . $this->search . '%')
                       ->orWhere('description', 'LIKE', '%' . $this->search . '%');
                });
            })
            ->when($this->filterStatus, fn($q) => $q->where('status', $this->filterStatus))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        // Stats
        $totalProcesses  = Process::count();
        $activeProcesses = Process::where('status', 'active')->count();
        $totalStages     = \App\Models\ProcessStage::count();
        $totalTasks      = \App\Models\ProcessTask::count();

        return view('livewire.task-manager.process-list', [
            'processes'       => $processes,
            'totalProcesses'  => $totalProcesses,
            'activeProcesses' => $activeProcesses,
            'totalStages'     => $totalStages,
            'totalTasks'      => $totalTasks,
        ])->layout('layouts.main.master-livewire');
    }
}
