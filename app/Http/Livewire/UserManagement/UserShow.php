<?php

namespace App\Http\Livewire\UserManagement;

use App\Models\Role;
use App\Models\User;
use App\Rules\StrongPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserShow extends Component
{
    use WithFileUploads;

    public $userId;
    public $user;

    // Edit mode
    public $editing = false;
    public $editName;
    public $editEmail;
    public $editMobileNo;
    public $editJobTitle;
    public $editUserUnit;
    public $editDirectorate;

    // Avatar upload
    public $avatarUpload;

    // Password reset
    public $showPasswordReset = false;
    public $newPassword = '';
    public $newPasswordConfirmation = '';

    protected $listeners = ['refreshUser' => 'loadUser'];

    public function mount($id)
    {
        $this->userId = $id;
        $this->loadUser();
    }

    public function loadUser()
    {
        $this->user = User::findOrFail($this->userId);
        $this->fillEditFields();
    }

    public function fillEditFields()
    {
        $this->editName = $this->user->name;
        $this->editEmail = $this->user->email;
        $this->editMobileNo = $this->user->mobile_no;
        $this->editJobTitle = $this->user->job_title;
        $this->editUserUnit = $this->user->user_unit;
        $this->editDirectorate = $this->user->directorate;
    }

    // ---------- TOGGLE EDIT ----------
    public function toggleEdit()
    {
        $this->editing = !$this->editing;
        if ($this->editing) {
            $this->fillEditFields();
        }
        $this->resetErrorBag();
    }

    public function cancelEdit()
    {
        $this->editing = false;
        $this->fillEditFields();
        $this->resetErrorBag();
    }

    // ---------- SAVE PROFILE ----------
    public function saveProfile()
    {
        $this->validate([
            'editName' => 'required|string|max:255',
            'editEmail' => 'required|email|unique:users,email,' . $this->userId,
            'editMobileNo' => 'nullable|string|max:20',
            'editJobTitle' => 'nullable|string|max:255',
            'editUserUnit' => 'nullable|string|max:255',
            'editDirectorate' => 'nullable|string|max:255',
        ]);

        $this->user->update([
            'name' => $this->editName,
            'email' => $this->editEmail,
            'mobile_no' => $this->editMobileNo,
            'job_title' => $this->editJobTitle,
            'user_unit' => $this->editUserUnit,
            'directorate' => $this->editDirectorate,
        ]);

        $this->editing = false;
        $this->loadUser();
        session()->flash('message', 'Profile updated successfully.');
    }

    // ---------- AVATAR UPLOAD ----------
    public function updatedAvatarUpload()
    {
        $this->validate([
            'avatarUpload' => 'image|max:2048', // max 2MB
        ]);

        // Store the file
        $filename = 'user_' . $this->userId . '_' . time() . '.' . $this->avatarUpload->getClientOriginalExtension();
        $this->avatarUpload->storeAs('public/user_avatar', $filename);

        // Delete old avatar if exists
        if ($this->user->avatar && Storage::exists('public/user_avatar/' . $this->user->avatar)) {
            Storage::delete('public/user_avatar/' . $this->user->avatar);
        }

        $this->user->update(['avatar' => $filename]);
        $this->loadUser();
        $this->avatarUpload = null;
        session()->flash('message', 'Profile picture updated successfully.');
    }

    // ---------- PASSWORD RESET ----------
    public function togglePasswordReset()
    {
        $this->showPasswordReset = !$this->showPasswordReset;
        $this->newPassword = '';
        $this->newPasswordConfirmation = '';
        $this->resetErrorBag();
    }

    public function resetUserPassword()
    {
        $this->validate([
            'newPassword' => ['required', 'min:8', new StrongPassword],
            'newPasswordConfirmation' => 'required|same:newPassword',
        ], [
            'newPasswordConfirmation.same' => 'Passwords do not match.',
        ]);

        $this->user->update([
            'password' => Hash::make($this->newPassword),
            'password_changed' => config('constants.password_not_changed'),
        ]);

        $this->showPasswordReset = false;
        $this->newPassword = '';
        $this->newPasswordConfirmation = '';
        $this->loadUser();
        session()->flash('message', 'Password has been reset successfully. User will be prompted to change it on next login.');
    }

    public function getUserRolesProperty()
    {
        try {
            return $this->user->roles ?? collect();
        } catch (\Exception $e) {
            return collect();
        }
    }

    public function render()
    {
        return view('livewire.user-management.user-show', [
            'userRoles' => $this->userRoles,
        ])->layout('layouts.main.master-livewire');
    }
}
