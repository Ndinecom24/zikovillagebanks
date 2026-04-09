<?php

namespace App\Http\Livewire\RoleBasedAccess\Roles;

use App\Models\RoleBasedAccess\Permission;
use App\Models\RoleBasedAccess\Role;
use App\Models\User;
use Livewire\Component;

class RoleShow extends Component
{
    public $roleId;
    public $role;
    public $activeTab = 'permissions';

    // Permission modal
    public $showPermModal = false;
    public $permSearch = '';
    public $availablePerms;
    public $selectedPermIds = [];

    // User assignment modal
    public $showUserModal = false;
    public $userSearch = '';
    public $availableUsers;
    public $selectedUserIds = [];

    // Detach confirmation
    public $detachType;
    public $detachId;
    public $detachName;

    public function mount($id)
    {
        $this->roleId = $id;
        $this->availablePerms = collect();
        $this->availableUsers = collect();
        $this->loadRole();
    }

    public function loadRole()
    {
        $this->role = Role::with(['permissions', 'users'])->findOrFail($this->roleId);
    }

    /* ── PERMISSIONS ───────────────────── */

    public function openPermModal()
    {
        $existingIds = $this->role->permissions->pluck('id')->toArray();
        $query = Permission::whereNotIn('id', $existingIds)->orderBy('group')->orderBy('name');

        if (!empty($this->permSearch)) {
            $query->where('name', 'like', '%' . $this->permSearch . '%');
        }

        $this->availablePerms = $query->get();
        $this->selectedPermIds = [];
        $this->showPermModal = true;
    }

    public function updatedPermSearch()
    {
        if ($this->showPermModal) {
            $existingIds = $this->role->permissions->pluck('id')->toArray();
            $query = Permission::whereNotIn('id', $existingIds)->orderBy('group')->orderBy('name');

            if (!empty($this->permSearch)) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->permSearch . '%')
                      ->orWhere('group', 'like', '%' . $this->permSearch . '%');
                });
            }
            $this->availablePerms = $query->get();
        }
    }

    public function closePermModal()
    {
        $this->showPermModal = false;
        $this->permSearch = '';
        $this->selectedPermIds = [];
    }

    public function attachPermissions()
    {
        if (!empty($this->selectedPermIds)) {
            $this->role->permissions()->syncWithoutDetaching($this->selectedPermIds);
        }
        $this->closePermModal();
        $this->loadRole();
        session()->flash('message', 'Permissions attached successfully.');
    }

    public function confirmDetachPermission($permId, $permName)
    {
        $this->detachType = 'permission';
        $this->detachId = $permId;
        $this->detachName = $permName;
    }

    public function detachPermission()
    {
        $this->role->permissions()->detach($this->detachId);
        $this->cancelDetach();
        $this->loadRole();
        session()->flash('message', 'Permission removed.');
    }

    /* ── USERS ──────────────────────────── */

    public function openUserModal()
    {
        $existingIds = $this->role->users->pluck('id')->toArray();
        $query = User::whereNotIn('id', $existingIds)->orderBy('name');

        if (!empty($this->userSearch)) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->userSearch . '%')
                  ->orWhere('email', 'like', '%' . $this->userSearch . '%')
                  ->orWhere('username', 'like', '%' . $this->userSearch . '%');
            });
        }

        $this->availableUsers = $query->limit(50)->get();
        $this->selectedUserIds = [];
        $this->showUserModal = true;
    }

    public function updatedUserSearch()
    {
        if ($this->showUserModal) {
            $existingIds = $this->role->users->pluck('id')->toArray();
            $query = User::whereNotIn('id', $existingIds)->orderBy('name');

            if (!empty($this->userSearch)) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->userSearch . '%')
                      ->orWhere('email', 'like', '%' . $this->userSearch . '%')
                      ->orWhere('username', 'like', '%' . $this->userSearch . '%');
                });
            }

            $this->availableUsers = $query->limit(50)->get();
        }
    }

    public function closeUserModal()
    {
        $this->showUserModal = false;
        $this->userSearch = '';
        $this->selectedUserIds = [];
    }

    public function attachUsers()
    {
        if (!empty($this->selectedUserIds)) {
            $this->role->users()->syncWithoutDetaching($this->selectedUserIds);
        }
        $this->closeUserModal();
        $this->loadRole();
        session()->flash('message', 'Users assigned to role successfully.');
    }

    public function confirmDetachUser($userId, $userName)
    {
        $this->detachType = 'user';
        $this->detachId = $userId;
        $this->detachName = $userName;
    }

    public function detachUser()
    {
        $this->role->users()->detach($this->detachId);
        $this->cancelDetach();
        $this->loadRole();
        session()->flash('message', 'User removed from role.');
    }

    /* ── SHARED ─────────────────────────── */

    public function cancelDetach()
    {
        $this->detachType = null;
        $this->detachId = null;
        $this->detachName = null;
    }

    /* ── RENDER ─────────────────────────── */

    public function render()
    {
        return view('livewire.role-based-access.roles.role-show')
            ->layout('layouts.main.master-livewire');
    }
}
