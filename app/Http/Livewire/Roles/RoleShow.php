<?php

namespace App\Http\Livewire\Roles;

use App\Models\Permission;
use App\Models\ResponsibleOffices;
use App\Models\Role;
use Livewire\Component;

class RoleShow extends Component
{
    public $roleId;
    public $role;

    /* ── Tabs ─────────────────────────── */
    public $activeTab = 'permissions'; // permissions | offices | users

    /* ── Permission attach ────────────── */
    public $showPermModal = false;
    public $permSearch = '';
    public $selectedPermIds = [];

    /* ── Office attach ────────────────── */
    public $showOfficeModal = false;
    public $officeSearch = '';
    public $selectedOfficeIds = [];

    /* ── Detach confirm ───────────────── */
    public $detachType = null;   // 'permission' | 'office'
    public $detachId = null;
    public $detachName = '';

    /* ── Lifecycle ────────────────────── */

    public function mount($id)
    {
        $this->roleId = $id;
        $this->loadRole();
    }

    private function loadRole()
    {
        $this->role = Role::with(['permissions' => function ($q) {
            $q->orderBy('group')->orderBy('name');
        }, 'offices', 'users'])->findOrFail($this->roleId);
    }

    /* ══════════════════════════════════════
       PERMISSIONS
    ══════════════════════════════════════ */

    public function openPermModal()
    {
        $this->permSearch = '';
        $this->selectedPermIds = [];
        $this->showPermModal = true;
    }

    public function closePermModal()
    {
        $this->showPermModal = false;
    }

    public function attachPermissions()
    {
        if (empty($this->selectedPermIds)) {
            session()->flash('error', 'Please select at least one permission.');
            return;
        }

        $existing = $this->role->permissions()->pluck('permissions.id')->toArray();
        $toAttach = array_diff($this->selectedPermIds, $existing);

        if (!empty($toAttach)) {
            $this->role->permissions()->attach($toAttach);
        }

        $this->loadRole();
        $this->showPermModal = false;
        session()->flash('message', count($toAttach) . ' permission(s) attached successfully.');
    }

    public function confirmDetachPermission($id, $name)
    {
        $this->detachType = 'permission';
        $this->detachId   = $id;
        $this->detachName = $name;
    }

    public function detachPermission()
    {
        if ($this->detachId && $this->detachType === 'permission') {
            $this->role->permissions()->detach($this->detachId);
            $this->loadRole();
            $this->resetDetach();
            session()->flash('message', 'Permission detached.');
        }
    }

    /* ══════════════════════════════════════
       OFFICES
    ══════════════════════════════════════ */

    public function openOfficeModal()
    {
        $this->officeSearch = '';
        $this->selectedOfficeIds = [];
        $this->showOfficeModal = true;
    }

    public function closeOfficeModal()
    {
        $this->showOfficeModal = false;
    }

    public function attachOffices()
    {
        if (empty($this->selectedOfficeIds)) {
            session()->flash('error', 'Please select at least one office.');
            return;
        }

        $existing = $this->role->offices()->pluck('responsible_offices.id')->toArray();
        $toAttach = array_diff($this->selectedOfficeIds, $existing);

        if (!empty($toAttach)) {
            $this->role->offices()->attach($toAttach);
        }

        $this->loadRole();
        $this->showOfficeModal = false;
        session()->flash('message', count($toAttach) . ' office(s) attached successfully.');
    }

    public function confirmDetachOffice($id, $name)
    {
        $this->detachType = 'office';
        $this->detachId   = $id;
        $this->detachName = $name;
    }

    public function detachOffice()
    {
        if ($this->detachId && $this->detachType === 'office') {
            $this->role->offices()->detach($this->detachId);
            $this->loadRole();
            $this->resetDetach();
            session()->flash('message', 'Office detached.');
        }
    }

    /* ══════════════════════════════════════
       SHARED
    ══════════════════════════════════════ */

    public function cancelDetach()
    {
        $this->resetDetach();
    }

    private function resetDetach()
    {
        $this->detachType = null;
        $this->detachId   = null;
        $this->detachName = '';
    }

    /* ══════════════════════════════════════
       RENDER
    ══════════════════════════════════════ */

    public function render()
    {
        // Available permissions not yet on this role
        $existingPermIds = $this->role->permissions->pluck('id')->toArray();
        $availablePerms = Permission::whereNotIn('id', $existingPermIds)
            ->when($this->permSearch, function ($q) {
                $q->where(function ($sub) {
                    $sub->where('name', 'like', '%' . $this->permSearch . '%')
                        ->orWhere('group', 'like', '%' . $this->permSearch . '%');
                });
            })
            ->orderBy('group')->orderBy('name')
            ->get();

        // Available offices not yet on this role
        $existingOfficeIds = $this->role->offices->pluck('id')->toArray();
        $availableOffices = ResponsibleOffices::whereNotIn('id', $existingOfficeIds)
            ->when($this->officeSearch, function ($q) {
                $q->where('responsible_office', 'like', '%' . $this->officeSearch . '%');
            })
            ->orderBy('responsible_office')
            ->get();

        return view('livewire.roles.role-show', [
            'availablePerms'   => $availablePerms,
            'availableOffices' => $availableOffices,
        ])->layout('layouts.main.master-livewire');
    }
}
