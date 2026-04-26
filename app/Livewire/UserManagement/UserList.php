<?php

namespace App\Livewire\UserManagement;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\WithPagination;

#[Layout('layouts.main.master-livewire')]
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

    #[On('refreshUsers')]
    public function refreshUsers(): void
    {
        // Livewire re-renders automatically when a listener is triggered
    }

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
            $employee = \App\Models\Employee\PHCMSEmployee::
                where('con_per_no', $this->staffNo)
                ->whereNull('alt_per_no')
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
        $rules = [
            'staffName'  => 'required|string|max:255',
            'staffEmail' => [
                'required',
                'email',
                Rule::unique('users', 'email')->whereNull('deleted_at'),
            ],
            'password' => ['required', new \App\Rules\StrongPassword],
        ];

        // Only validate username uniqueness when one is provided
        if (!empty($this->staffNo)) {
            $rules['staffNo'] = [
                'string',
                'max:50',
                Rule::unique('users', 'username')->whereNull('deleted_at'),
            ];
        }

        $this->validate($rules, [
            'staffName.required'  => 'Full name is required.',
            'staffEmail.required' => 'Email address is required.',
            'staffEmail.email'    => 'Please enter a valid email address.',
            'staffEmail.unique'   => 'A user with this email already exists.',
            'staffNo.unique'      => 'A user with this staff number already exists.',
            'password.required'   => 'A default password is required.',
        ]);

        try {
            User::create([
                'name'             => $this->staffName,
                'username'         => $this->staffNo ?: null,
                'email'            => $this->staffEmail,
                'job_title'        => $this->jobTitle ?: null,
                'user_unit'        => $this->userUnit ?: null,
                'directorate'      => $this->directorate ?: null,
                'mobile_no'        => $this->mobileNo ?: null,
                'password'         => Hash::make($this->password),
                'password_changed' => config('constants.password_not_changed', 0),
                'total_login'      => 0,
                'uuid'             => \Illuminate\Support\Str::uuid()->toString(),
            ]);

            $this->showCreateModal = false;
            $this->resetCreateForm();
            session()->flash('message', 'User created successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                $this->addError('staffEmail', 'A user with this email or staff number already exists.');
            } else {
                $this->addError('staffEmail', 'Database error: unable to create user. Please try again.');
            }
        } catch (\Exception $e) {
            $this->addError('staffEmail', 'Failed to create user. Please try again or contact support.');
        }
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
        $query = User::withCount(['roles']);

        if (!empty($this->search)) {
            $term = '%' . trim($this->search) . '%';
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', $term)
                  ->orWhere('username', 'like', $term)
                  ->orWhere('email', 'like', $term)
                  ->orWhere('directorate', 'like', $term)
                  ->orWhere('job_title', 'like', $term);
            });
        }

        $query->orderBy($this->sortField, $this->sortDirection);

        $users = $query->paginate($this->perPage);

        return view('livewire.user-management.user-list', [
            'users' => $users,
        ]);
    }
}
