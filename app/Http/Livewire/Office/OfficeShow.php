<?php

namespace App\Http\Livewire\Office;

use App\Models\ResponsibleOffices;
use App\Models\ProcessTask;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class OfficeShow extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $officeId;
    public $office;

    /* ── User search / attach ─────────── */
    public $showAttachModal = false;
    public $userSearch = '';
    public $selectedUserId = '';
    public $selectedRole = 'member';

    /* ── Edit role ────────────────────── */
    public $showEditRoleModal = false;
    public $editUserId = null;
    public $editUserName = '';
    public $editRole = '';

    /* ── Detach confirm ───────────────── */
    public $confirmDetachId = null;
    public $confirmDetachName = '';

    /* ── Filters ──────────────────────── */
    public $search = '';
    public $taskFilterStatus = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'taskFilterStatus' => ['except' => ''],
    ];

    /* ── Lifecycle ────────────────────── */

    public function mount($id)
    {
        $this->officeId = $id;
        $this->loadOffice();
    }

    private function loadOffice()
    {
        $this->office = ResponsibleOffices::withCount('users')->findOrFail($this->officeId);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    /* ══════════════════════════════════════
       ATTACH USER
    ══════════════════════════════════════ */

    public function openAttachModal()
    {
        $this->reset(['userSearch', 'selectedUserId', 'selectedRole']);
        $this->selectedRole = 'member';
        $this->showAttachModal = true;
    }

    public function closeAttachModal()
    {
        $this->showAttachModal = false;
    }

    public function attachUser()
    {
        $this->validate([
            'selectedUserId' => 'required|exists:users,id',
            'selectedRole'   => 'required|in:manager,member,lead',
        ]);

        // Check if already attached
        if ($this->office->users()->where('users.id', $this->selectedUserId)->exists()) {
            session()->flash('error', 'This user is already assigned to this office.');
            return;
        }

        $this->office->users()->attach($this->selectedUserId, [
            'role_in_office' => $this->selectedRole,
        ]);

        $this->loadOffice();
        $this->showAttachModal = false;
        session()->flash('message', 'User added to office successfully.');
    }

    /* ══════════════════════════════════════
       EDIT USER ROLE
    ══════════════════════════════════════ */

    public function openEditRole($userId)
    {
        $user = $this->office->users()->where('users.id', $userId)->first();
        if ($user) {
            $this->editUserId   = $userId;
            $this->editUserName = $user->name;
            $this->editRole     = $user->pivot->role_in_office ?? 'member';
            $this->showEditRoleModal = true;
        }
    }

    public function closeEditRoleModal()
    {
        $this->showEditRoleModal = false;
    }

    public function updateRole()
    {
        $this->validate([
            'editRole' => 'required|in:manager,member,lead',
        ]);

        $this->office->users()->updateExistingPivot($this->editUserId, [
            'role_in_office' => $this->editRole,
        ]);

        $this->loadOffice();
        $this->showEditRoleModal = false;
        session()->flash('message', 'User role updated successfully.');
    }

    /* ══════════════════════════════════════
       DETACH USER
    ══════════════════════════════════════ */

    public function confirmDetach($userId, $name)
    {
        $this->confirmDetachId   = $userId;
        $this->confirmDetachName = $name;
    }

    public function cancelDetach()
    {
        $this->confirmDetachId   = null;
        $this->confirmDetachName = '';
    }

    public function detachUser()
    {
        if ($this->confirmDetachId) {
            $this->office->users()->detach($this->confirmDetachId);
            $this->loadOffice();
            $this->confirmDetachId = null;
            $this->confirmDetachName = '';
            session()->flash('message', 'User removed from office.');
        }
    }

    /* ══════════════════════════════════════
       RENDER
    ══════════════════════════════════════ */

    public function render()
    {
        // Paginated list of users attached to this office
        $users = $this->office->users()
            ->when($this->search, function ($q) {
                $q->where(function ($sub) {
                    $sub->where('users.name', 'like', '%' . $this->search . '%')
                        ->orWhere('users.email', 'like', '%' . $this->search . '%')
                        ->orWhere('users.staff_no', 'like', '%' . $this->search . '%')
                        ->orWhere('users.job_title', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('users.name')
            ->paginate(15);

        // Users available to attach (not already in this office)
        $existingIds = $this->office->users()->pluck('users.id')->toArray();
        $availableUsers = User::whereNotIn('id', $existingIds)
            ->when($this->userSearch, function ($q) {
                $q->where(function ($sub) {
                    $sub->where('name', 'like', '%' . $this->userSearch . '%')
                        ->orWhere('email', 'like', '%' . $this->userSearch . '%')
                        ->orWhere('staff_no', 'like', '%' . $this->userSearch . '%');
                });
            })
            ->orderBy('name')
            ->limit(50)
            ->get();

        // Tasks assigned to this office (pending & in-progress by default)
        $tasks = ProcessTask::whereHas('offices', function ($q) {
                $q->where('responsible_offices.id', $this->officeId);
            })
            ->when($this->taskFilterStatus, function ($q) {
                $q->where('status', $this->taskFilterStatus);
            }, function ($q) {
                // Default: show pending and in_progress only
                $q->whereIn('status', ['pending', 'in_progress']);
            })
            ->with(['module.process', 'offices'])
            ->orderByRaw("CASE WHEN status = 'in_progress' THEN 0 WHEN status = 'pending' THEN 1 ELSE 2 END")
            ->orderBy('due_date')
            ->get();

        return view('livewire.office.office-show', [
            'users'          => $users,
            'availableUsers' => $availableUsers,
            'tasks'          => $tasks,
        ])->layout('layouts.main.master-livewire');
    }
}
