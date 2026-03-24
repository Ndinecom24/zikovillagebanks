<?php

namespace App\Http\Livewire\Clients;

use App\Models\ClientTaskComment;
use App\Models\ClientTaskFile;
use App\Models\ClientTaskProgress;
use App\Models\ConnectionPoints;
use App\Models\Districts;
use App\Models\Province;
use App\Models\TechnicalApplications;
use App\Models\Technology;
use App\Models\Venture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class ClientTaskAction extends Component
{
    use WithFileUploads;

    public $progressId;
    public $progress;
    public $newStatus;
    public $newRemarks;

    /* ── Comments ───────────────────────── */
    public $commentBody = '';
    public $editingCommentId = null;
    public $editCommentBody = '';

    /* ── File Uploads ───────────────────── */
    public $uploadFiles = [];
    public $fileDescription = '';
    public $showUploadModal = false;
    public $ventures, $technologies, $provinces;
    public $province_id;
    public $district_id;
    public $connection_point_id;
    public $installed_capacity, $client_id;

    public $districts = [];
    public $connection_points = [];
    public $project_name, $technology_id, $proposed_generation_capacity, $proposed_generation_capacity_units, $application_comments;

    /* ── Lifecycle ──────────────────────── */
    protected $rules = [
        'project_name' => 'required',
        'province_id' => 'required|numeric',
        'connection_point_id' => 'required|numeric',
        'technology_id' => 'required|numeric',
        'district_id' => 'required|numeric',

    ];
    public function mount($id)
    {
        $this->progressId = $id;
        $this->loadProgress();
        $this->newStatus  = $this->progress->status;
        $this->newRemarks = $this->progress->remarks ?? '';
        // ✅ SET CLIENT ID HERE
        $this->client_id = optional($this->progress->clientProcess->client)->id;
        $this->ventures = Venture::all();
        $this->technologies = Technology::all();
        $this->provinces = Province::all();

        // start empty (important)
        $this->districts = [];
        $this->connection_points = [];
    }


    public function updatedProvinceId($value)
    {
        $this->districts = Districts::where('province_id', $value)->get();

        // reset dependent fields
        $this->district_id = null;
        $this->connection_point_id = null;
        $this->connection_points = [];
        $this->installed_capacity = null;
    }

    public function updatedDistrictId($value)
    {
        $this->connection_points = ConnectionPoints::where('district_id', $value)->get();

        // reset dependent fields
        $this->connection_point_id = null;
        $this->installed_capacity = null;
    }

    public function updatedConnectionPointId($value)
    {
        $point = ConnectionPoints::find($value);

        if ($point) {
            // choose which capacity you want
            $this->installed_capacity = $point->installed_capacity;
            // OR:
            // $this->available_capacity = $point->substation_capacity;
        }
    }

    private function loadProgress()
    {
        $this->progress = ClientTaskProgress::with([
            'clientProcess.client',
            'clientProcess.process',
            'clientProcess.taskProgress',
            'processTask.stage.process',
            'processTask.offices.users',
            'processTask.creator',
            'completedByUser',
            'comments.user',
            'files.uploader',
        ])->findOrFail($this->progressId);
    }

    /* ── Actions ────────────────────────── */

    public function updateStatus($status)
    {
        $data = ['status' => $status];

        if ($status === 'completed') {
            $data['completed_by'] = Auth::id();
            $data['completed_at'] = now();
        } elseif (in_array($status, ['pending', 'in_progress'])) {
            $data['completed_by'] = null;
            $data['completed_at'] = null;
        }

        $this->progress->update($data);
        $this->syncParentProcessStatus();
        $this->loadProgress();
        $this->newStatus = $this->progress->status;

        session()->flash('message', 'Task status updated to "' . str_replace('_', ' ', ucfirst($status)) . '".');
    }

    public function saveRemarks()
    {
        $this->progress->update(['remarks' => $this->newRemarks]);
        $this->loadProgress();

        session()->flash('message', 'Remarks saved successfully.');
    }

    public function markComplete()
    {
        $this->updateStatus('completed');
    }

    public function markInProgress()
    {
        $this->updateStatus('in_progress');
    }

    public function resetToPending()
    {
        $this->updateStatus('pending');
    }

    public function skipTask()
    {
        $this->updateStatus('skipped');
    }

    /* ── Comments ───────────────────────── */

    public function addComment()
    {
        $this->validate(['commentBody' => 'required|min:2']);

        ClientTaskComment::create([
            'client_task_progress_id' => $this->progressId,
            'user_id'                 => Auth::id(),
            'body'                    => $this->commentBody,
        ]);

        $this->commentBody = '';
        $this->loadProgress();

        session()->flash('message', 'Comment added.');
    }

    public function startEditComment($commentId)
    {
        $comment = ClientTaskComment::findOrFail($commentId);
        $this->editingCommentId = $commentId;
        $this->editCommentBody  = $comment->body;
    }

    public function cancelEditComment()
    {
        $this->editingCommentId = null;
        $this->editCommentBody  = '';
    }

    public function updateComment()
    {
        $this->validate(['editCommentBody' => 'required|min:2']);

        $comment = ClientTaskComment::findOrFail($this->editingCommentId);
        $comment->update(['body' => $this->editCommentBody]);

        $this->editingCommentId = null;
        $this->editCommentBody  = '';
        $this->loadProgress();

        session()->flash('message', 'Comment updated.');
    }

    public function deleteComment($commentId)
    {
        ClientTaskComment::where('id', $commentId)->delete();
        $this->loadProgress();

        session()->flash('message', 'Comment deleted.');
    }

    /* ── File Uploads ───────────────────── */

    public function openUploadModal()
    {
        $this->reset(['uploadFiles', 'fileDescription']);
        $this->resetValidation();
        $this->showUploadModal = true;
    }

    public function closeUploadModal()
    {
        $this->showUploadModal = false;
        $this->reset(['uploadFiles', 'fileDescription']);
        $this->resetValidation();
    }

    public function uploadTaskFiles()
    {
        $this->validate([
            'uploadFiles'   => 'required|array|min:1',
            'uploadFiles.*' => 'file|max:20480', // 20 MB per file
        ]);

        $count = 0;

        foreach ($this->uploadFiles as $file) {
            $originalName = $file->getClientOriginalName();
            $safeBase     = preg_replace("/[^a-zA-Z0-9_\-]/", "_", pathinfo($originalName, PATHINFO_FILENAME));
            $extension    = $file->getClientOriginalExtension();
            $storedName   = $safeBase . '_' . time() . '_' . Str::random(4) . '.' . $extension;
            $sizeMb       = number_format($file->getSize() / 1048576, 2);
            $path         = $file->storeAs('public/client-task-files', $storedName);

            ClientTaskFile::create([
                'client_task_progress_id' => $this->progressId,
                'uploaded_by'             => Auth::id(),
                'original_name'           => $originalName,
                'stored_name'             => $storedName,
                'path'                    => $path,
                'ext'                     => strtolower($extension),
                'mime_type'               => $file->getMimeType(),
                'size_mb'                 => $sizeMb,
                'description'             => $this->fileDescription,
            ]);
            $count++;
        }

        $this->closeUploadModal();
        $this->loadProgress();

        session()->flash('message', $count . ' file(s) uploaded successfully.');
    }

    public function deleteFile($fileId)
    {
        $file = ClientTaskFile::findOrFail($fileId);

        // Remove from disk
        if (Storage::exists($file->path)) {
            Storage::delete($file->path);
        }

        $file->delete();
        $this->loadProgress();

        session()->flash('message', 'File deleted.');
    }

    public function downloadFile($fileId)
    {
        $file = ClientTaskFile::findOrFail($fileId);
        return Storage::download($file->path, $file->original_name);
    }

    /* ── Helpers ────────────────────────── */

    private function syncParentProcessStatus()
    {
        $clientProcess = $this->progress->clientProcess;
        $allCompleted  = $clientProcess->taskProgress()->where('status', '!=', 'completed')->count() === 0;
        $totalTasks    = $clientProcess->taskProgress()->count();

        if ($allCompleted && $totalTasks > 0) {
            $clientProcess->update([
                'status'       => 'completed',
                'completed_at' => now(),
            ]);
        } else {
            if ($clientProcess->status === 'completed') {
                $clientProcess->update([
                    'status'       => 'in_progress',
                    'completed_at' => null,
                ]);
            }
        }
    }

    /* ── Computed: sibling tasks in same stage ── */
    public function getSiblingTasksProperty()
    {
        $task = $this->progress->processTask;
        if (!$task || !$task->stage_id) return collect();

        $stageTaskIds = \App\Models\ProcessTask::where('stage_id', $task->stage_id)->pluck('id');

        return ClientTaskProgress::where('client_process_id', $this->progress->client_process_id)
            ->whereIn('process_task_id', $stageTaskIds)
            ->with('processTask')
            ->get();
    }

    /* ── Computed: overall process progress ── */
    public function getProcessProgressProperty()
    {
        $cp    = $this->progress->clientProcess;
        $total = $cp->taskProgress->count();
        $done  = $cp->taskProgress->where('status', 'completed')->count();

        return [
            'total'   => $total,
            'done'    => $done,
            'percent' => $total > 0 ? (int) round(($done / $total) * 100) : 0,
        ];
    }

    public function render()
    {
        return view('livewire.clients.client-task-action');
    }

    public function createApplication()
    {
        // Validate form data
        $this->validate();
        DB::beginTransaction();
        // Generate a new invoice number format for the billing month
        try {

            $user = Auth::user();

            TechnicalApplications::create([
                'project_name' => $this->project_name,
                'client_id' => $this->client_id,
                'province_id' => $this->province_id,
                'connection_point_id' => $this->connection_point_id,
                'technology_id' => $this->technology_id,
                'district_id' => $this->district_id,
                'proposed_generation_capacity' => $this->proposed_generation_capacity,
                'proposed_generation_capacity_units' => $this->proposed_generation_capacity_units,
                'application_comments' => $this->application_comments,
                'created_by' => $user->name,
                'created_by_staff_no' => $user->staff_no,
            ]);
            DB::commit();
            // Redirect to invoice display page with a success message
            return redirect()->back()->with('message', 'GIS Application Saved successfully');
        } catch (\Exception $e) {

            DB::rollBack();

            session()->flash('error', $e->getMessage());
        }
    }
}
