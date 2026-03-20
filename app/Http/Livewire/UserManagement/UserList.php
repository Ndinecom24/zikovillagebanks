<?php

namespace App\Http\Livewire\UserManagement;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 15;
    public $sortField = 'id';
    public $sortDirection = 'desc';

    // Create user modal
    public $showCreateModal = false;
    public $staffNo = '';
    public $staffName = '';
    public $staffEmail = '';
    public $jobTitle = '';
    public $userUnit = '';
    public $directorate = '';
    public $mobileNo = '';
    public $password = '';
    public $staffSearching = false;
    public $staffFound = false;

    // Delete
    public $deleteId;
    public $deleteName;

    protected $listeners = ['refreshUsers' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    // ---------- STAFF LOOKUP ----------
    public function lookupStaff()
    {
        $this->staffSearching = true;
        $this->staffFound = false;

        try {
            $employee = \App\Models\Employee\PHCMSEmployee::on('oracle_isd')
                ->where('con_per_no', $this->staffNo)
                ->first();

            if ($employee) {
                $this->staffName = $employee->name ?? '';
                $this->staffEmail = $employee->staff_email ?? '';
                $this->jobTitle = $employee->job_title ?? '';
                $this->userUnit = $employee->functional_section ?? '';
                $this->directorate = $employee->directorate ?? '';
                $this->mobileNo = $employee->mobile_no ?? '';
                $this->staffFound = true;
            } else {
                $this->addError('staffNo', 'Employee not found. You can enter details manually.');
            }
        } catch (\Exception $e) {
            $this->addError('staffNo', 'Could not connect to HR system. Enter details manually.');
        }

        $this->staffSearching = false;
    }

    // ---------- CREATE USER ----------
    public function openCreateModal()
    {
        $this->resetCreateForm();
        $this->showCreateModal = true;
    }

    public function resetCreateForm()
    {
        $this->staffNo = '';
        $this->staffName = '';
        $this->staffEmail = '';
        $this->jobTitle = '';
        $this->userUnit = '';
        $this->directorate = '';
        $this->mobileNo = '';
        $this->password = '';
        $this->staffFound = false;
        $this->staffSearching = false;
        $this->resetErrorBag();
    }

    public function createUser()
    {
        $this->validate([
            'staffNo' => 'required|string|max:100',
            'staffName' => 'required|string|max:255',
            'staffEmail' => 'required|email|unique:users,email',
            'password' => ['required', new \App\Rules\StrongPassword],
        ]);

        User::create([
            'name' => $this->staffName,
            'staff_no' => $this->staffNo,
            'email' => $this->staffEmail,
            'job_title' => $this->jobTitle,
            'user_unit' => $this->userUnit,
            'directorate' => $this->directorate,
            'mobile_no' => $this->mobileNo,
            'password' => Hash::make($this->password),
            'password_changed' => config('constants.password_not_changed'),
            'total_login' => 0,
            'uuid' => \Illuminate\Support\Str::uuid()->toString(),
        ]);

        $this->showCreateModal = false;
        $this->resetCreateForm();
        session()->flash('message', 'User created successfully.');
    }

    // ---------- DELETE ----------
    public function confirmDelete($id)
    {
        $user = User::find($id);
        if ($user) {
            $this->deleteId = $id;
            $this->deleteName = $user->name;
        }
    }

    public function deleteUser()
    {
        $user = User::find($this->deleteId);
        if ($user) {
            $user->delete();
            session()->flash('message', 'User deleted successfully.');
        }
        $this->deleteId = null;
        $this->deleteName = null;
    }

    public function render()
    {
        $query = User::withCount(['offices', 'roles']);

        if (!empty($this->search)) {
            $term = '%' . trim($this->search) . '%';
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', $term)
                  ->orWhere('staff_no', 'like', $term)
                  ->orWhere('email', 'like', $term)
                  ->orWhere('directorate', 'like', $term)
                  ->orWhere('job_title', 'like', $term);
            });
        }

        $query->orderBy($this->sortField, $this->sortDirection);

        $users = $query->paginate($this->perPage);

        return view('livewire.user-management.user-list', [
            'users' => $users,
        ])->layout('layouts.main.master-livewire');
    }
}
