<?php

namespace App\Http\Livewire\RoleBasedAccess\Roles;

use App\Models\RoleBasedAccess\Permission;
use App\Models\RoleBasedAccess\Role;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class RoleList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    // Create
    public $name = '';
    public $description = '';

    // Edit
    public $editId;
    public $editName = '';
    public $editDescription = '';

    // Show
    public $showRole;
    public $showPermissions = [];

    // Delete
    public $deleteId;
    public $deleteName;

    // Modal control
    public $showCreateModal = false;

    // Permission assignment
    public $permRoleId;
    public $availablePermissions = [];
    public $selectedPermissions = [];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    /* ── CREATE ────────────────────────────── */

    public function create()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'description' => 'nullable|string|max:500',
        ]);

        Role::create([
            'name'        => $this->name,
            'slug'        => Str::slug($this->name),
            'description' => $this->description,
        ]);

        $this->reset(['name', 'description']);
        $this->showCreateModal = false;
        session()->flash('message', 'Role created successfully.');
    }

    /* ── EDIT ──────────────────────────────── */

    public function openEdit($id)
    {
        $role = Role::findOrFail($id);
        $this->editId = $role->id;
        $this->editName = $role->name;
        $this->editDescription = $role->description;
    }

    public function update()
    {
        $this->validate([
            'editName' => 'required|string|max:255|unique:roles,name,' . $this->editId,
            'editDescription' => 'nullable|string|max:500',
        ]);

        $role = Role::findOrFail($this->editId);
        $role->update([
            'name'        => $this->editName,
            'slug'        => Str::slug($this->editName),
            'description' => $this->editDescription,
        ]);

        $this->reset(['editId', 'editName', 'editDescription']);
        session()->flash('message', 'Role updated successfully.');
    }

    /* ── SHOW ──────────────────────────────── */

    public function showDetails($id)
    {
        $role = Role::with(['permissions', 'users'])->findOrFail($id);
        $this->showRole = $role;
        $this->showPermissions = $role->permissions->pluck('name')->toArray();
    }

    public function closeShow()
    {
        $this->showRole = null;
        $this->showPermissions = [];
    }

    /* ── DELETE ─────────────────────────────── */

    public function confirmDelete($id)
    {
        $role = Role::findOrFail($id);
        $this->deleteId = $role->id;
        $this->deleteName = $role->name;
    }

    public function delete()
    {
        $role = Role::findOrFail($this->deleteId);
        $role->permissions()->detach();
        $role->users()->detach();
        $role->delete();

        $this->reset(['deleteId', 'deleteName']);
        session()->flash('message', 'Role deleted successfully.');
    }

    /* ── PERMISSIONS SYNC ──────────────────── */

    public function openPermissions($roleId)
    {
        $role = Role::with('permissions')->findOrFail($roleId);
        $this->permRoleId = $role->id;
        $this->selectedPermissions = $role->permissions->pluck('id')->toArray();
        $this->availablePermissions = Permission::orderBy('group')->orderBy('name')
            ->get(['id', 'name', 'group'])
            ->toArray();
    }

    public function syncPermissions()
    {
        $role = Role::findOrFail($this->permRoleId);
        $role->permissions()->sync($this->selectedPermissions);

        $this->reset(['permRoleId', 'availablePermissions', 'selectedPermissions']);
        session()->flash('message', 'Permissions updated successfully.');
    }

    /* ── RENDER ─────────────────────────────── */

    public function render()
    {
        $roles = Role::withCount(['permissions', 'users'])
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name')
            ->paginate(15);

        return view('livewire.role-based-access.roles.role-list', [
            'roles' => $roles,
        ])->layout('layouts.main.master-livewire');
    }
}
