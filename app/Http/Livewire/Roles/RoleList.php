<?php

namespace App\Http\Livewire\Roles;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class RoleList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $name;
    public $description;
    public $editId;
    public $editName;
    public $editDescription;
    public $deleteId;
    public $deleteName;

    // Show role
    public $showRole = null;
    public $showPermissions = [];

    // Permission assignment
    public $availablePermissions = [];
    public $selectedPermissions = [];

    protected $listeners = ['refreshRoles' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // ---------- CREATE ----------
    public function create()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'description' => 'nullable|string|max:500',
        ]);

        Role::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
        ]);

        $this->reset(['name', 'description']);
        $this->emit('closeModal', 'createRoleModal');
        session()->flash('message', 'Role created successfully.');
    }

    // ---------- EDIT ----------
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
            'name' => $this->editName,
            'slug' => Str::slug($this->editName),
            'description' => $this->editDescription,
        ]);

        $this->reset(['editId', 'editName', 'editDescription']);
        $this->emit('closeModal', 'editRoleModal');
        session()->flash('message', 'Role updated successfully.');
    }

    // ---------- DELETE ----------
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
        $this->emit('closeModal', 'deleteRoleModal');
        session()->flash('message', 'Role deleted successfully.');
    }

    // ---------- SHOW (with permissions) ----------
    public function showDetails($id)
    {
        $this->showRole = Role::with('permissions', 'users')->findOrFail($id);
        $this->showPermissions = $this->showRole->permissions->pluck('name')->toArray();
    }

    public function closeShow()
    {
        $this->showRole = null;
        $this->showPermissions = [];
    }

    // ---------- PERMISSION ASSIGNMENT ----------
    public function openPermissions($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $this->editId = $role->id;
        $this->editName = $role->name;
        $this->availablePermissions = Permission::orderBy('group')->orderBy('name')->get()->toArray();
        $this->selectedPermissions = $role->permissions->pluck('id')->toArray();
    }

    public function syncPermissions()
    {
        $role = Role::findOrFail($this->editId);
        $role->permissions()->sync($this->selectedPermissions);

        $this->reset(['editId', 'editName', 'availablePermissions', 'selectedPermissions']);
        $this->emit('closeModal', 'permissionsModal');
        session()->flash('message', 'Permissions updated successfully.');
    }

    // ---------- RENDER ----------
    public function render()
    {
        $roles = Role::withCount(['permissions', 'users'])
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.roles.role-list', compact('roles'));
    }
}
