<?php

namespace App\Http\Livewire\RoleBasedAccess\Permissions;

use App\Models\RoleBasedAccess\Permission;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class PermissionList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    // Create
    public $name = '';
    public $group = '';
    public $description = '';

    // Edit
    public $editId;
    public $editName = '';
    public $editGroup = '';
    public $editDescription = '';

    // Delete
    public $deleteId;
    public $deleteName;

    // Modal control
    public $showCreateModal = false;

    // Groups
    public $groups = [];

    public function mount()
    {
        $this->groups = config('chilolezo.permission_groups', []);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    /* ── CREATE ────────────────────────────── */

    public function create()
    {
        $this->validate([
            'name'        => 'required|string|max:255|unique:permissions,name',
            'group'       => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        Permission::create([
            'name'        => $this->name,
            'slug'        => Str::slug($this->name),
            'group'       => $this->group,
            'description' => $this->description,
        ]);

        $this->reset(['name', 'group', 'description']);
        $this->showCreateModal = false;
        session()->flash('message', 'Permission created successfully.');
    }

    /* ── EDIT ──────────────────────────────── */

    public function openEdit($id)
    {
        $perm = Permission::findOrFail($id);
        $this->editId = $perm->id;
        $this->editName = $perm->name;
        $this->editGroup = $perm->group;
        $this->editDescription = $perm->description;
    }

    public function update()
    {
        $this->validate([
            'editName'        => 'required|string|max:255|unique:permissions,name,' . $this->editId,
            'editGroup'       => 'nullable|string|max:255',
            'editDescription' => 'nullable|string|max:500',
        ]);

        $perm = Permission::findOrFail($this->editId);
        $perm->update([
            'name'        => $this->editName,
            'slug'        => Str::slug($this->editName),
            'group'       => $this->editGroup,
            'description' => $this->editDescription,
        ]);

        $this->reset(['editId', 'editName', 'editGroup', 'editDescription']);
        session()->flash('message', 'Permission updated successfully.');
    }

    /* ── DELETE ─────────────────────────────── */

    public function confirmDelete($id)
    {
        $perm = Permission::findOrFail($id);
        $this->deleteId = $perm->id;
        $this->deleteName = $perm->name;
    }

    public function delete()
    {
        $perm = Permission::findOrFail($this->deleteId);
        $perm->roles()->detach();
        $perm->delete();

        $this->reset(['deleteId', 'deleteName']);
        session()->flash('message', 'Permission deleted successfully.');
    }

    /* ── RENDER ─────────────────────────────── */

    public function render()
    {
        $permissions = Permission::withCount('roles')
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('group', 'like', '%' . $this->search . '%');
            })
            ->orderBy('group')
            ->orderBy('name')
            ->paginate(15);

        return view('livewire.role-based-access.permissions.permission-list', [
            'permissions' => $permissions,
        ])->layout('layouts.main.master-livewire');
    }
}
