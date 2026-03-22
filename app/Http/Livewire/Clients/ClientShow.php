<?php

namespace App\Http\Livewire\Clients;

use App\Models\ClientDetails;
use App\Models\ClientProcess;
use App\Models\ClientTaskProgress;
use App\Models\FileUploads;
use App\Models\Process;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ClientShow extends Component
{
    public $clientId;
    public $client;
    public $documents = [];

    /* ── Process assignment ────────────── */
    public $availableProcesses = [];
    public $selectedProcessId = '';
    public $showAssignModal = false;

    /* ── Active tracking state ────────── */
    public $clientProcesses = [];
    public $activeClientProcessId = null;
    public $activeModuleId = null;
    public $taskRemarks = [];

    /* ── Task detail view ─────────────── */
    public $showTaskDetail = false;
    public $detailProgress = null;

    public function mount($id)
    {
        $this->clientId = $id;
        $this->client = ClientDetails::findOrFail($id);
        $this->documents = FileUploads::where('model_id', $id)->get();
        $this->loadClientProcesses();
        $this->loadAvailableProcesses();

        // Auto-select the first active process
        $firstActive = collect($this->clientProcesses)->first();
        if ($firstActive) {
            $this->activeClientProcessId = $firstActive->id;
        }
    }

    private function loadClientProcesses()
    {
        $this->clientProcesses = ClientProcess::where('client_id', $this->clientId)
            ->with(['process.modules.tasks.offices.users', 'taskProgress'])
            ->orderByDesc('created_at')
            ->get();
    }

    private function loadAvailableProcesses()
    {
        $assignedIds = ClientProcess::where('client_id', $this->clientId)
            ->pluck('process_id')
            ->toArray();

        $this->availableProcesses = Process::where('status', 'active')
            ->whereNotIn('id', $assignedIds)
            ->with('modules.tasks.offices')
            ->get();
    }

    /* ══════════════════════════════════════
       ASSIGN PROCESS TO CLIENT
       ══════════════════════════════════════ */

    public function openAssignModal()
    {
        $this->loadAvailableProcesses();
        $this->selectedProcessId = '';
        $this->showAssignModal = true;
    }

    public function closeAssignModal()
    {
        $this->showAssignModal = false;
        $this->selectedProcessId = '';
    }

    public function assignProcess()
    {
        $this->validate([
            'selectedProcessId' => 'required|exists:processes,id',
        ]);

        $process = Process::with('modules.tasks')->findOrFail($this->selectedProcessId);

        // Create the client-process link
        $clientProcess = ClientProcess::create([
            'client_id'  => $this->clientId,
            'process_id' => $process->id,
            'status'     => 'in_progress',
            'started_at' => now(),
            'started_by' => Auth::id(),
        ]);

        // Generate task progress rows for every task in this process
        foreach ($process->modules as $module) {
            foreach ($module->tasks as $task) {
                ClientTaskProgress::create([
                    'client_process_id' => $clientProcess->id,
                    'process_task_id'   => $task->id,
                    'status'            => 'pending',
                ]);
            }
        }

        $this->activeClientProcessId = $clientProcess->id;
        $this->loadClientProcesses();
        $this->loadAvailableProcesses();
        $this->closeAssignModal();

        session()->flash('message', "Process \"{$process->name}\" assigned to client successfully.");
    }

    /* ══════════════════════════════════════
       TRACK TASK PROGRESS
       ══════════════════════════════════════ */

    public function selectProcess($clientProcessId)
    {
        $this->activeClientProcessId = $clientProcessId;
        $this->activeModuleId = null;
    }

    public function toggleModule($moduleId)
    {
        $this->activeModuleId = ($this->activeModuleId == $moduleId) ? null : $moduleId;
    }

    public function updateTaskStatus($progressId, $newStatus)
    {
        $progress = ClientTaskProgress::findOrFail($progressId);

        $data = ['status' => $newStatus];

        if ($newStatus === 'completed') {
            $data['completed_by'] = Auth::id();
            $data['completed_at'] = now();
        } elseif ($newStatus === 'pending') {
            $data['completed_by'] = null;
            $data['completed_at'] = null;
        }

        // Save remarks if provided
        if (isset($this->taskRemarks[$progressId]) && !empty($this->taskRemarks[$progressId])) {
            $data['remarks'] = $this->taskRemarks[$progressId];
        }

        $progress->update($data);

        // Check if all tasks in this client-process are completed
        $clientProcess = $progress->clientProcess;
        $allCompleted = $clientProcess->taskProgress()->where('status', '!=', 'completed')->count() === 0;
        $totalTasks   = $clientProcess->taskProgress()->count();

        if ($allCompleted && $totalTasks > 0) {
            $clientProcess->update([
                'status'       => 'completed',
                'completed_at' => now(),
            ]);
        } else {
            // If re-opening a task on a completed process, set back to in_progress
            if ($clientProcess->status === 'completed') {
                $clientProcess->update([
                    'status'       => 'in_progress',
                    'completed_at' => null,
                ]);
            }
        }

        $this->loadClientProcesses();
    }

    public function saveRemarks($progressId)
    {
        $progress = ClientTaskProgress::findOrFail($progressId);
        $remarkText = $this->taskRemarks[$progressId] ?? '';
        $progress->update(['remarks' => $remarkText]);

        $this->loadClientProcesses();
        session()->flash('message', 'Remarks saved.');
    }

    public function openTaskDetail($progressId)
    {
        $this->detailProgress = ClientTaskProgress::with(['processTask.module', 'processTask.offices.users', 'completedByUser', 'comments.user', 'files.uploader'])
            ->findOrFail($progressId);
        $this->showTaskDetail = true;
    }

    public function closeTaskDetail()
    {
        $this->showTaskDetail = false;
        $this->detailProgress = null;
    }

    /* ══════════════════════════════════════
       COMPUTED HELPERS
       ══════════════════════════════════════ */

    public function getActiveClientProcessProperty()
    {
        if (!$this->activeClientProcessId) return null;
        return collect($this->clientProcesses)->firstWhere('id', $this->activeClientProcessId);
    }

    public function getModuleProgressProperty()
    {
        $cp = $this->activeClientProcess;
        if (!$cp) return collect();

        $modules = $cp->process->modules;

        return $modules->map(function ($module) use ($cp) {
            $taskIds   = $module->tasks->pluck('id');
            $progress  = $cp->taskProgress->whereIn('process_task_id', $taskIds);
            $total     = $progress->count();
            $completed = $progress->where('status', 'completed')->count();
            $inProg    = $progress->where('status', 'in_progress')->count();

            return (object) [
                'module'      => $module,
                'total'       => $total,
                'completed'   => $completed,
                'in_progress' => $inProg,
                'percent'     => $total > 0 ? (int) round(($completed / $total) * 100) : 0,
                'tasks'       => $progress->map(function ($tp) use ($module) {
                    $tp->task = $module->tasks->firstWhere('id', $tp->process_task_id);
                    return $tp;
                }),
            ];
        });
    }

    public function render()
    {
        return view('livewire.clients.client-show');
    }
}
