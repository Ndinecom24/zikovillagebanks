<?php

namespace App\Http\Livewire\TaskManager;

use App\Models\Process;
use App\Models\ProcessModule;
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

    /* ── Module CRUD ──────────────────── */
    public $showModuleModal = false;
    public $editingModuleId = null;
    public $moduleName = '';
    public $moduleDescription = '';
    public $moduleOrder = 0;
    public $moduleStatus = 'active';

    /* ── Task CRUD ────────────────────── */
    public $showTaskModal = false;
    public $editingTaskId = null;
    public $taskModuleId = '';
    public $taskTitle = '';
    public $taskDescription = '';
    public $taskPriority = 'medium';
    public $taskDueDate = '';
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
    public $taskFilterPriority = '';
    public $taskFilterOffice = '';
    public $activeModuleId = null;

    /* ── Lifecycle ────────────────────── */

    public function mount($id)
    {
        $this->processId = $id;
        $this->loadProcess();
    }

    private function loadProcess()
    {
        $this->process = Process::with(['modules.tasks.offices.users', 'creator'])->findOrFail($this->processId);
    }

    public function updatingTaskSearch()        { $this->resetPage(); }
    public function updatingTaskFilterStatus()  { $this->resetPage(); }
    public function updatingTaskFilterPriority(){ $this->resetPage(); }
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
       MODULE CRUD
       ══════════════════════════════════════ */

    public function openModuleModal($id = null)
    {
        $this->resetValidation();
        $this->reset(['editingModuleId', 'moduleName', 'moduleDescription', 'moduleOrder', 'moduleStatus']);
        $this->moduleStatus = 'active';

        if ($id) {
            $mod = ProcessModule::findOrFail($id);
            $this->editingModuleId   = $mod->id;
            $this->moduleName        = $mod->name;
            $this->moduleDescription = $mod->description;
            $this->moduleOrder       = $mod->order;
            $this->moduleStatus      = $mod->status;
        } else {
            $this->moduleOrder = $this->process->modules()->count() + 1;
        }

        $this->showModuleModal = true;
    }

    public function closeModuleModal()
    {
        $this->showModuleModal = false;
        $this->reset(['editingModuleId', 'moduleName', 'moduleDescription', 'moduleOrder', 'moduleStatus']);
        $this->resetValidation();
    }

    public function saveModule()
    {
        $this->validate([
            'moduleName'        => 'required|string|max:255',
            'moduleDescription' => 'nullable|string|max:1000',
            'moduleOrder'       => 'required|integer|min:0',
            'moduleStatus'      => 'required|in:active,inactive',
        ]);

        ProcessModule::updateOrCreate(
            ['id' => $this->editingModuleId],
            [
                'process_id'  => $this->processId,
                'name'        => $this->moduleName,
                'description' => $this->moduleDescription,
                'order'       => $this->moduleOrder,
                'status'      => $this->moduleStatus,
            ]
        );

        $msg = $this->editingModuleId ? 'Module updated.' : 'Module created.';
        $this->closeModuleModal();
        $this->loadProcess();
        session()->flash('message', $msg);
    }

    /* ══════════════════════════════════════
       TASK CRUD
       ══════════════════════════════════════ */

    public function openTaskModal($moduleId = null, $taskId = null)
    {
        $this->resetValidation();
        $this->reset(['editingTaskId', 'taskTitle', 'taskDescription', 'taskPriority', 'taskDueDate', 'taskStatus', 'taskOfficeIds', 'taskModuleId']);
        $this->taskPriority = 'medium';
        $this->taskStatus   = 'pending';

        if ($taskId) {
            $task = ProcessTask::with('offices')->findOrFail($taskId);
            $this->editingTaskId   = $task->id;
            $this->taskModuleId    = $task->module_id;
            $this->taskTitle       = $task->title;
            $this->taskDescription = $task->description;
            $this->taskPriority    = $task->priority;
            $this->taskDueDate     = $task->due_date ? $task->due_date->format('Y-m-d') : '';
            $this->taskStatus      = $task->status;
            $this->taskOfficeIds   = $task->offices->pluck('id')->toArray();
        } elseif ($moduleId) {
            $this->taskModuleId = $moduleId;
        }

        $this->showTaskModal = true;
    }

    public function closeTaskModal()
    {
        $this->showTaskModal = false;
        $this->reset(['editingTaskId', 'taskTitle', 'taskDescription', 'taskPriority', 'taskDueDate', 'taskStatus', 'taskOfficeIds', 'taskModuleId']);
        $this->resetValidation();
    }

    public function saveTask()
    {
        $this->validate([
            'taskModuleId'    => 'required|exists:process_modules,id',
            'taskTitle'       => 'required|string|max:255',
            'taskDescription' => 'nullable|string|max:2000',
            'taskPriority'    => 'required|in:low,medium,high',
            'taskDueDate'     => 'nullable|date',
            'taskStatus'      => 'required|in:pending,in_progress,completed',
            'taskOfficeIds'   => 'nullable|array',
            'taskOfficeIds.*' => 'exists:responsible_offices,id',
        ]);

        $task = ProcessTask::updateOrCreate(
            ['id' => $this->editingTaskId],
            [
                'module_id'   => $this->taskModuleId,
                'title'       => $this->taskTitle,
                'description' => $this->taskDescription,
                'priority'    => $this->taskPriority,
                'due_date'    => $this->taskDueDate ?: null,
                'status'      => $this->taskStatus,
                'created_by'  => $this->editingTaskId
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
        $this->detailTask = ProcessTask::with(['module.process', 'offices.users', 'creator'])->findOrFail($taskId);
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
            $this->detailTask = ProcessTask::with(['module.process', 'offices', 'creator'])->find($taskId);
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

        if ($type === 'module') {
            $this->deleteName = ProcessModule::findOrFail($id)->name;
        } elseif ($type === 'task') {
            $this->deleteName = ProcessTask::findOrFail($id)->title;
        }
    }

    public function executeDelete()
    {
        if ($this->deleteType === 'module') {
            ProcessModule::findOrFail($this->deleteId)->delete();
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

    /* ── Select active module tab ─────── */

    public function selectModule($moduleId)
    {
        $this->activeModuleId = $moduleId;
        $this->resetPage();
    }

    public function clearTaskFilters()
    {
        $this->taskSearch         = '';
        $this->taskFilterStatus   = '';
        $this->taskFilterPriority = '';
        $this->taskFilterOffice   = '';
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
            ->whereIn('module_id', $this->process->modules->pluck('id'))
            ->when($this->activeModuleId, fn($q) => $q->where('module_id', $this->activeModuleId))
            ->when($this->taskSearch, function ($q) {
                $q->where(function ($q2) {
                    $q2->where('title', 'LIKE', '%' . $this->taskSearch . '%')
                       ->orWhere('description', 'LIKE', '%' . $this->taskSearch . '%');
                });
            })
            ->when($this->taskFilterStatus, fn($q) => $q->where('status', $this->taskFilterStatus))
            ->when($this->taskFilterPriority, fn($q) => $q->where('priority', $this->taskFilterPriority))
            ->when($this->taskFilterOffice, function ($q) {
                $q->whereHas('offices', fn($q2) => $q2->where('responsible_offices.id', $this->taskFilterOffice));
            })
            ->with(['module', 'offices', 'creator'])
            ->orderBy('created_at', 'desc');

        $tasks = $tasksQuery->paginate(15);

        // Stats for this process
        $allTaskIds = ProcessTask::whereIn('module_id', $this->process->modules->pluck('id'));
        $stats = [
            'totalTasks'     => (clone $allTaskIds)->count(),
            'pendingTasks'   => (clone $allTaskIds)->where('status', 'pending')->count(),
            'inProgressTasks'=> (clone $allTaskIds)->where('status', 'in_progress')->count(),
            'completedTasks' => (clone $allTaskIds)->where('status', 'completed')->count(),
            'overdueTasks'   => (clone $allTaskIds)->where('due_date', '<', now())->where('status', '!=', 'completed')->count(),
        ];

        return view('livewire.task-manager.process-show', [
            'tasks'   => $tasks,
            'offices' => $offices,
            'stats'   => $stats,
        ])->layout('layouts.main.master-livewire');
        
    }
}
