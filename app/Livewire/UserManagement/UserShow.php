<?php

namespace App\Livewire\UserManagement;

use App\Models\ActivityLog;
use App\Models\RoleBasedAccess\Role;
use App\Models\User;
use App\Rules\StrongPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Illuminate\Support\Collection;

#[Layout('layouts.main.master-livewire')]
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
    public $editCompanyName;
    public $editCompanyLocation;

    // Avatar upload
    public $avatarUpload;

    // Password reset
    public $showPasswordReset = false;
    public $newPassword = '';
    public $newPasswordConfirmation = '';

    // Tabs
    public $activeTab = 'profile';
    protected $rules = [];

    /**
     * Re-load the user model on every subsequent Livewire request
     * so public properties that depend on it are always fresh.
     */
    public function hydrate()
    {
        if ($this->userId) {
            $this->user = User::with(['roles'])->findOrFail($this->userId);
        }
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        $this->loadUser();
    }

    public function mount($id)
    {
        $this->userId = $id;
        $this->loadUser();
    }

    #[On('refreshUser')]
    public function loadUser()
    {
        $this->user = User::with(['roles'])->findOrFail($this->userId);
        $this->fillEditFields();
    }

    public function fillEditFields()
    {
        $this->editName = $this->user->name;
        $this->editEmail = $this->user->email;
        $this->editMobileNo = $this->user->mobile_no;
        $this->editJobTitle = $this->user->job_title;
        $this->editCompanyName = $this->user->company_name;
        $this->editCompanyLocation = $this->user->company_location;
    }

    // ---------- TOGGLE EDIT ----------
    public function toggleEdit()
    {
        $this->editing = !$this->editing;
        if ($this->editing) {
            $this->loadUser();
        }
        $this->resetErrorBag();
    }

    public function cancelEdit()
    {
        if (!$this->editing) return;
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
            'editCompanyName' => 'nullable|string|max:255',
            'editCompanyLocation' => 'nullable|string|max:255',
        ]);

        $this->user->update([
            'name' => $this->editName,
            'email' => $this->editEmail,
            'mobile_no' => $this->editMobileNo,
            'job_title' => $this->editJobTitle,
            'company_name' => $this->editCompanyName,
            'company_location' => $this->editCompanyLocation,
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
        if (!$this->showPasswordReset) {
            // Opening
            $this->showPasswordReset = true;
        } else {
            // Closing
            $this->showPasswordReset = false;
        }
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
        // Always load activity logs — all tabs are always present in the DOM
        // (CSS display toggle) to prevent Livewire v2 morphdom fingerprint errors.
        $activityLogs = ActivityLog::where('user_id', $this->userId)
            ->orderByDesc('created_at')
            ->take(50)
            ->get();

        return view('livewire.user-management.user-show', [
            'userRoles'    => $this->userRoles,
            'activityLogs' => $activityLogs,
        ]);
    }
}