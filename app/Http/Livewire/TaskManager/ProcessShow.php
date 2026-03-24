<?php

namespace App\Http\Livewire\TaskManager;

use App\Models\Process;
use App\Models\ProcessStage;
use App\Models\ProcessTask;
use App\Models\ResponsibleOffices;
use Livewire\Component;
use Livewire\WithPagination;

class ProcessShow extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $processId;
    public $process;

    /* ── Stage CRUD ──────────────────── */
    public $showStageModal = false;
    public $editingStageId = null;
    public $stageName = '';
    public $stageDescription = '';
    public $stageOrder = 0;
    public $stageStatus = 'active';

    /* ── Task CRUD ────────────────────── */
    public $showTaskModal = false;
    public $editingTaskId = null;
    public $taskStageId = '';
    public $taskTitle = '';
    public $taskDescription = '';
    public $taskOrderNumber = 1;
    public $taskMaxDays = '';
    public $taskStatus = 'pending';
    public $taskOfficeIds = [];

    /* ── Task Detail ──────────────────── */
    public $showTaskDetail = false;
    public $detailTask = null;

    /* ── Delete ───────────────────────── */
    public $deleteType = null;
    public $deleteId = null;
    public $deleteName = '';

    /* ── Edit Process ─────────────────── */
    public $showEditProcess = false;
    public $editProcessName = '';
    public $editProcessDescription = '';
    public $editProcessStatus = 'active';

    /* ── Filters (for tasks) ──────────── */
    public $taskSearch = '';
    public $taskFilterStatus = '';
    public $taskFilterOffice = '';
    public $activeStageId = null;

    /* ── Lifecycle ────────────────────── */

    public function mount($id)
    {
        $this->processId = $id;
        $this->loadProcess();
    }

    private function loadProcess()
    {
        $this->process = Process::with(['stages.tasks.offices.users', 'creator'])->findOrFail($this->processId);
    }

    public function updatingTaskSearch()        { $this->resetPage(); }
    public function updatingTaskFilterStatus()  { $this->resetPage(); }
    public function updatingTaskFilterOffice()  { $this->resetPage(); }

    /* ══════════════════════════════════════
       EDIT PROCESS
       ══════════════════════════════════════ */

    public function openEditProcess()
    {
        $this->editProcessName        = $this->process->name;
        $this->editProcessDescription = $this->process->description;
        $this->editProcessStatus      = $this->process->status;
        $this->showEditProcess = true;
    }

    public function closeEditProcess()
    {
        $this->showEditProcess = false;
        $this->resetValidation();
    }

    public function saveProcessEdit()
    {
        $this->validate([
            'editProcessName'        => 'required|string|max:255',
            'editProcessDescription' => 'nullable|string|max:1000',
            'editProcessStatus'      => 'required|in:active,inactive',
        ]);

        $this->process->update([
            'name'        => $this->editProcessName,
            'description' => $this->editProcessDescription,
            'status'      => $this->editProcessStatus,
        ]);

        $this->closeEditProcess();
        $this->loadProcess();
        session()->flash('message', 'Process updated.');
    }

    /* ══════════════════════════════════════
       STAGE CRUD
       ══════════════════════════════════════ */

    public function openStageModal($id = null)
    {
        $this->resetValidation();
        $this->reset(['editingStageId', 'stageName', 'stageDescription', 'stageOrder', 'stageStatus']);
        $this->stageStatus = 'active';

        if ($id) {
            $stg = ProcessStage::findOrFail($id);
            $this->editingStageId   = $stg->id;
            $this->stageName        = $stg->name;
            $this->stageDescription = $stg->description;
            $this->stageOrder       = $stg->order;
            $this->stageStatus      = $stg->status;
        } else {
            $this->stageOrder = $this->process->stages()->count() + 1;
        }

        $this->showStageModal = true;
    }

    public function closeStageModal()
    {
        $this->showStageModal = false;
        $this->reset(['editingStageId', 'stageName', 'stageDescription', 'stageOrder', 'stageStatus']);
        $this->resetValidation();
    }

    public function saveStage()
    {
        $this->validate([
            'stageName'        => 'required|string|max:255',
            'stageDescription' => 'nullable|string|max:1000',
            'stageOrder'       => 'required|integer|min:0',
            'stageStatus'      => 'required|in:active,inactive',
        ]);

        ProcessStage::updateOrCreate(
            ['id' => $this->editingStageId],
            [
                'process_id'  => $this->processId,
                'name'        => $this->stageName,
                'description' => $this->stageDescription,
                'order'       => $this->stageOrder,
                'status'      => $this->stageStatus,
            ]
        );

        $msg = $this->editingStageId ? 'Stage updated.' : 'Stage created.';
        $this->closeStageModal();
        $this->loadProcess();
        session()->flash('message', $msg);
    }

    /* ══════════════════════════════════════
       TASK CRUD
       ══════════════════════════════════════ */

    public function openTaskModal($stageId = null, $taskId = null)
    {
        $this->resetValidation();
        $this->reset(['editingTaskId', 'taskTitle', 'taskDescription', 'taskOrderNumber', 'taskMaxDays', 'taskStatus', 'taskOfficeIds', 'taskStageId']);
        $this->taskStatus = 'pending';

        if ($taskId) {
            $task = ProcessTask::with('offices')->findOrFail($taskId);
            $this->editingTaskId    = $task->id;
            $this->taskStageId      = $task->stage_id;
            $this->taskTitle        = $task->title;
            $this->taskDescription  = $task->description;
            $this->taskOrderNumber  = $task->order_number;
            $this->taskMaxDays      = $task->max_days ?? '';
            $this->taskStatus       = $task->status;
            $this->taskOfficeIds    = $task->offices->pluck('id')->toArray();
        } elseif ($stageId) {
            $this->taskStageId     = $stageId;
            $this->taskOrderNumber = ProcessTask::where('stage_id', $stageId)->max('order_number') + 1;
        }

        $this->showTaskModal = true;
    }

    public function closeTaskModal()
    {
        $this->showTaskModal = false;
        $this->reset(['editingTaskId', 'taskTitle', 'taskDescription', 'taskOrderNumber', 'taskMaxDays', 'taskStatus', 'taskOfficeIds', 'taskStageId']);
        $this->resetValidation();
    }

    public function saveTask()
    {
        $this->validate([
            'taskStageId'     => 'required|exists:process_stages,id',
            'taskTitle'       => 'required|string|max:255',
            'taskDescription' => 'nullable|string|max:2000',
            'taskOrderNumber' => 'required|integer|min:1',
            'taskMaxDays'     => 'nullable|integer|min:1',
            'taskStatus'      => 'required|in:pending,in_progress,completed',
            'taskOfficeIds'   => 'nullable|array',
            'taskOfficeIds.*' => 'exists:responsible_offices,id',
        ]);

        $task = ProcessTask::updateOrCreate(
            ['id' => $this->editingTaskId],
            [
                'stage_id'     => $this->taskStageId,
                'order_number' => $this->taskOrderNumber,
                'title'        => $this->taskTitle,
                'description'  => $this->taskDescription,
                'max_days'     => $this->taskMaxDays ?: null,
                'status'       => $this->taskStatus,
                'created_by'   => $this->editingTaskId
                    ? ProcessTask::find($this->editingTaskId)->created_by
                    : auth()->id(),
            ]
        );

        // Sync office assignments
        $pivotData = [];
        foreach ($this->taskOfficeIds as $officeId) {
            $pivotData[$officeId] = [
                'assigned_at' => now(),
                'status'      => 'pending',
            ];
        }
        $task->offices()->sync($pivotData);

        $msg = $this->editingTaskId ? 'Task updated.' : 'Task created.';
        $this->closeTaskModal();
        $this->loadProcess();
        session()->flash('message', $msg);
    }

    /* ── Task Detail ──────────────────── */

    public function viewTask($taskId)
    {
        $this->detailTask = ProcessTask::with(['stage.process', 'offices.users', 'creator'])->findOrFail($taskId);
        $this->showTaskDetail = true;
    }

    public function closeTaskDetail()
    {
        $this->showTaskDetail = false;
        $this->detailTask     = null;
    }

    /* ── Update assignment status ─────── */

    public function updateAssignmentStatus($taskId, $officeId, $status)
    {
        $task = ProcessTask::findOrFail($taskId);
        $task->offices()->updateExistingPivot($officeId, ['status' => $status]);
        $this->loadProcess();

        if ($this->detailTask && $this->detailTask->id == $taskId) {
            $this->detailTask = ProcessTask::with(['stage.process', 'offices', 'creator'])->find($taskId);
        }

        session()->flash('message', 'Assignment status updated.');
    }

    /* ══════════════════════════════════════
       DELETE
       ══════════════════════════════════════ */

    public function confirmDelete($type, $id)
    {
        $this->deleteType = $type;
        $this->deleteId   = $id;

        if ($type === 'stage') {
            $this->deleteName = ProcessStage::findOrFail($id)->name;
        } elseif ($type === 'task') {
            $this->deleteName = ProcessTask::findOrFail($id)->title;
        }
    }

    public function executeDelete()
    {
        if ($this->deleteType === 'stage') {
            ProcessStage::findOrFail($this->deleteId)->delete();
        } elseif ($this->deleteType === 'task') {
            ProcessTask::findOrFail($this->deleteId)->delete();
        }

        $this->cancelDelete();
        $this->loadProcess();
        session()->flash('message', ucfirst($this->deleteType ?? 'Item') . ' deleted.');
    }

    public function cancelDelete()
    {
        $this->deleteType = null;
        $this->deleteId   = null;
        $this->deleteName = '';
    }

    /* ── Select active stage tab ──────── */

    public function selectStage($stageId)
    {
        $this->activeStageId = $stageId;
        $this->resetPage();
    }

    public function clearTaskFilters()
    {
        $this->taskSearch       = '';
        $this->taskFilterStatus = '';
        $this->taskFilterOffice = '';
        $this->resetPage();
    }

    /* ══════════════════════════════════════
       RENDER
       ══════════════════════════════════════ */

    public function render()
    {
        $this->loadProcess();

        $offices = ResponsibleOffices::orderBy('responsible_office')->get();

        // Build filtered tasks query
        $tasksQuery = ProcessTask::query()
            ->whereIn('stage_id', $this->process->stages->pluck('id'))
            ->when($this->activeStageId, fn($q) => $q->where('stage_id', $this->activeStageId))
            ->when($this->taskSearch, function ($q) {
                $q->where(function ($q2) {
                    $q2->where('title', 'LIKE', '%' . $this->taskSearch . '%')
                       ->orWhere('description', 'LIKE', '%' . $this->taskSearch . '%');
                });
            })
            ->when($this->taskFilterStatus, fn($q) => $q->where('status', $this->taskFilterStatus))
            ->when($this->taskFilterOffice, function ($q) {
                $q->whereHas('offices', fn($q2) => $q2->where('responsible_offices.id', $this->taskFilterOffice));
            })
            ->with(['stage', 'offices', 'creator'])
            ->orderBy('stage_id')
            ->orderBy('order_number');

        $tasks = $tasksQuery->paginate(15);

        // Stats for this process
        $allTaskIds = ProcessTask::whereIn('stage_id', $this->process->stages->pluck('id'));
        $stats = [
            'totalTasks'     => (clone $allTaskIds)->count(),
            'pendingTasks'   => (clone $allTaskIds)->where('status', 'pending')->count(),
            'inProgressTasks'=> (clone $allTaskIds)->where('status', 'in_progress')->count(),
            'completedTasks' => (clone $allTaskIds)->where('status', 'completed')->count(),
        ];

        return view('livewire.task-manager.process-show', [
            'tasks'   => $tasks,
            'offices' => $offices,
            'stats'   => $stats,
        ])->layout('layouts.main.master-livewire');
        
    }
}
