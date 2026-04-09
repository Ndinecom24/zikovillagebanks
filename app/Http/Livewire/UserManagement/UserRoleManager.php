<?php

namespace App\Http\Livewire\UserManagement;

use App\Models\RoleBasedAccess\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserRoleManager extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    // Role assignment
    public $editUserId;
    public $editUserName;
    public $availableRoles = [];
    public $selectedRoles = [];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // ---------- OPEN ROLE ASSIGNMENT ----------
    public function openRoles($userId)
    {
        $user = User::with('roles')->findOrFail($userId);
        $this->editUserId = $user->id;
        $this->editUserName = $user->name;
        $this->availableRoles = Role::orderBy('name')->get()->toArray();
        $this->selectedRoles = $user->roles->pluck('id')->toArray();
    }

    public function syncRoles()
    {
        $user = User::findOrFail($this->editUserId);
        $user->roles()->sync($this->selectedRoles);

        $this->reset(['editUserId', 'editUserName', 'availableRoles', 'selectedRoles']);
        $this->emit('closeModal', 'userRolesModal');
        session()->flash('message', 'User roles updated successfully.');
    }

    // ---------- QUICK REMOVE ROLE ----------
    public function removeRoleFromUser($userId, $roleId)
    {
        $user = User::findOrFail($userId);
        $user->roles()->detach($roleId);
        session()->flash('message', 'Role removed from user.');
    }

    // ---------- RENDER ----------
    public function render()
    {
        $users = User::with('roles')
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('username', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name')
            ->paginate(15);

        return view('livewire.user-management.user-role-manager', compact('users'))
            ->layout('layouts.main.master-livewire');
    }
}
