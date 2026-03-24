<?php

namespace App\Http\Livewire\Permissions;

use App\Models\Permission;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class PermissionList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $name;
    public $description;
    public $group;
    public $editId;
    public $editName;
    public $editDescription;
    public $editGroup;
    public $deleteId;
    public $deleteName;

    // Available groups for dropdown
    public $groups = [];

    public function mount()
    {
        $this->groups = config('chilolezo.permission_groups');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // ---------- CREATE ----------
    public function create()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
            'description' => 'nullable|string|max:500',
            'group' => 'nullable|string|max:255',
        ]);

        Permission::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
            'group' => $this->group,
        ]);

        $this->reset(['name', 'description', 'group']);
        $this->emit('closeModal', 'createPermissionModal');
        session()->flash('message', 'Permission created successfully.');
    }

    // ---------- EDIT ----------
    public function openEdit($id)
    {
        $perm = Permission::findOrFail($id);
        $this->editId = $perm->id;
        $this->editName = $perm->name;
        $this->editDescription = $perm->description;
        $this->editGroup = $perm->group;
    }

    public function update()
    {
        $this->validate([
            'editName' => 'required|string|max:255|unique:permissions,name,' . $this->editId,
            'editDescription' => 'nullable|string|max:500',
            'editGroup' => 'nullable|string|max:255',
        ]);

        $perm = Permission::findOrFail($this->editId);
        $perm->update([
            'name' => $this->editName,
            'slug' => Str::slug($this->editName),
            'description' => $this->editDescription,
            'group' => $this->editGroup,
        ]);

        $this->reset(['editId', 'editName', 'editDescription', 'editGroup']);
        $this->emit('closeModal', 'editPermissionModal');
        session()->flash('message', 'Permission updated successfully.');
    }

    // ---------- DELETE ----------
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
        $this->emit('closeModal', 'deletePermissionModal');
        session()->flash('message', 'Permission deleted successfully.');
    }

    // ---------- RENDER ----------
    public function render()
    {
        $permissions = Permission::withCount('roles')
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('group', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy('group')
            ->orderBy('name')
            ->paginate(15);

        return view('livewire.permissions.permission-list', compact('permissions'));
    }
}
