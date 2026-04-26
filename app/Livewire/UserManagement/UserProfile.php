<?php

namespace App\Livewire\UserManagement;

use App\Models\User;
use App\Models\UserPaymentMethod;
use App\Models\VillageBanking\VillageBank;
use App\Rules\StrongPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

/**
 * Self-service profile page for the currently authenticated user.
 * Allows viewing/editing personal info, changing avatar & password,
 * and viewing village-bank memberships.
 */
#[Layout('layouts.main.master-livewire')]
class UserProfile extends Component
{
    use WithFileUploads;

    /* ── Profile Fields ───────────────────── */
    public $name;
    public $email;
    public $username;
    public $phone;
    public $mobileNo;

    // Employment
    public $employmentStatus;
    public $jobTitle;
    public $companyName;
    public $companyLocation;

    // Identity
    public $dateOfBirth;
    public $gender;
    public $nationalId;

    // Address
    public $country;
    public $province;
    public $city;
    public $homeAddress;

    // Next of Kin
    public $nokName;
    public $nokRelationship;
    public $nokContact;
    public $nokAddress;

    /* ── UI State ─────────────────────────── */
    public $editing = false;
    public $activeTab = 'overview';
    public $showPasswordModal = false;

    /* ── Avatar ───────────────────────────── */
    public $avatarUpload;
    public $avatarPreview = null;

    /* ── Document Uploads ─────────────────── */
    public $nrcUpload;
    public $nrcPreview = null;
    public $passportUpload;
    public $passportPreview = null;
    public $nrcPhotoUrl = null;
    public $passportPhotoUrl = null;

    /* ── Change Password ──────────────────── */
    public $currentPassword = '';
    public $newPassword = '';
    public $newPasswordConfirmation = '';

    /* ── Payment Methods ──────────────────── */
    public $showPaymentModal = false;
    public $editingPaymentId = null;
    public $pmType = 'bank';           // 'bank' or 'mobile_money'
    public $pmLabel = '';
    // Bank fields
    public $pmBankName = '';
    public $pmAccountName = '';
    public $pmAccountNumber = '';
    public $pmBranchName = '';
    public $pmSwiftCode = '';
    // Mobile money fields
    public $pmProvider = '';
    public $pmMobileNumber = '';
    public $pmRegisteredName = '';
    // Common
    public $pmCurrency = 'ZMW';
    public $pmIsPrimary = false;

    /* ── Computed cache ───────────────────── */
    public $memberSince;
    public $totalLogins;
    public $userRoleName;
    public $avatarUrl;
    /* ══════════════════════════════════════
     *  LIFECYCLE
     * ══════════════════════════════════════ */

    public function mount()
    {
        $this->loadProfile();
    }

    #[On('refreshProfile')]
    public function onRefreshProfile(): void
    {
        // Livewire re-renders automatically when a listener is triggered
    }

    #[On('refreshPaymentMethods')]
    public function onRefreshPaymentMethods(): void
    {
        // Livewire re-renders automatically when a listener is triggered
    }

    public function loadProfile()
    {
        $user = Auth::user();

        $this->name        = $user->name;
        $this->email       = $user->email;
        $this->username    = $user->username ?? '';
        $this->phone       = $user->phone ?? '';
        $this->mobileNo    = $user->mobile_no ?? '';

        // Employment
        $this->employmentStatus = $user->employment_status ?? '';
        $this->jobTitle         = $user->job_title ?? '';
        $this->companyName      = $user->company_name ?? '';
        $this->companyLocation  = $user->company_location ?? '';

        // Identity
        $this->dateOfBirth = $user->date_of_birth ? $user->date_of_birth->format('Y-m-d') : '';
        $this->gender      = $user->gender ?? '';
        $this->nationalId  = $user->national_id ?? '';

        // Address
        $this->country     = $user->country ?? '';
        $this->province    = $user->province ?? '';
        $this->city        = $user->city ?? '';
        $this->homeAddress = $user->home_address ?? '';

        // Next of Kin
        $this->nokName         = $user->nok_name ?? '';
        $this->nokRelationship = $user->nok_relationship ?? '';
        $this->nokContact      = $user->nok_contact ?? '';
        $this->nokAddress      = $user->nok_address ?? '';

        $this->memberSince = $user->created_at ? $user->created_at->format('M d, Y') : 'N/A';
        $this->totalLogins = $user->total_login ?? 0;
        $this->userRoleName = $this->resolveRoleName($user);
        $this->avatarUrl   = $this->resolveAvatarUrl($user);
        $this->nrcPhotoUrl = $this->resolveDocumentUrl($user->nrc_photo);
        $this->passportPhotoUrl = $this->resolveDocumentUrl($user->passport_photo);
    }

    /* ══════════════════════════════════════
     *  TAB SWITCHING
     * ══════════════════════════════════════ */

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    /* ══════════════════════════════════════
     *  PROFILE EDITING
     * ══════════════════════════════════════ */

    public function startEditing()
    {
        $this->editing = true;
        $this->resetErrorBag();
    }

    public function cancelEditing()
    {
        $this->editing = false;
        $this->loadProfile();
        $this->resetErrorBag();
    }

    public function saveProfile()
    {
        $user = Auth::user();

        $this->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email,' . $user->id,
            'username'         => 'nullable|string|max:100|unique:users,username,' . $user->id,
            'phone'            => 'nullable|string|max:20',
            'mobileNo'         => 'nullable|string|max:20',
            // Employment
            'employmentStatus' => 'nullable|in:employed,self_employed,unemployed,student,retired',
            'jobTitle'         => 'nullable|string|max:255',
            'companyName'      => 'nullable|string|max:255',
            'companyLocation'  => 'nullable|string|max:255',
            // Identity
            'dateOfBirth'      => 'nullable|date|before:today',
            'gender'           => 'nullable|in:male,female,other',
            'nationalId'       => 'nullable|string|max:50',
            // Address
            'country'          => 'nullable|string|max:100',
            'province'         => 'nullable|string|max:100',
            'city'             => 'nullable|string|max:100',
            'homeAddress'      => 'nullable|string|max:500',
            // Next of Kin
            'nokName'          => 'nullable|string|max:255',
            'nokRelationship'  => 'nullable|string|max:100',
            'nokContact'       => 'nullable|string|max:50',
            'nokAddress'       => 'nullable|string|max:500',
        ]);

        $user->update([
            'name'              => $this->name,
            'email'             => $this->email,
            'username'          => $this->username ?: null,
            'phone'             => $this->phone ?: null,
            'mobile_no'         => $this->mobileNo ?: null,
            // Employment
            'employment_status' => $this->employmentStatus ?: null,
            'job_title'         => $this->jobTitle ?: null,
            'company_name'      => $this->companyName ?: null,
            'company_location'  => $this->companyLocation ?: null,
            // Identity
            'date_of_birth'     => $this->dateOfBirth ?: null,
            'gender'            => $this->gender ?: null,
            'national_id'       => $this->nationalId ?: null,
            // Address
            'country'           => $this->country ?: null,
            'province'          => $this->province ?: null,
            'city'              => $this->city ?: null,
            'home_address'      => $this->homeAddress ?: null,
            // Next of Kin
            'nok_name'          => $this->nokName ?: null,
            'nok_relationship'  => $this->nokRelationship ?: null,
            'nok_contact'       => $this->nokContact ?: null,
            'nok_address'       => $this->nokAddress ?: null,
        ]);

        $this->editing = false;
        $this->loadProfile();
        session()->flash('profile_success', 'Profile updated successfully.');
    }

    /* ══════════════════════════════════════
     *  AVATAR UPLOAD
     * ══════════════════════════════════════ */

    public function updatedAvatarUpload()
    {
        $this->validate([
            'avatarUpload' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $this->avatarPreview = $this->avatarUpload->temporaryUrl();
    }

    public function saveAvatar()
    {
        $this->validate([
            'avatarUpload' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = Auth::user();

        $filename = 'user_' . $user->id . '_' . time() . '.' . $this->avatarUpload->getClientOriginalExtension();
        $this->avatarUpload->storeAs('public/user_avatar', $filename);

        // Delete old avatar
        if ($user->avatar && Storage::exists('public/user_avatar/' . $user->avatar)) {
            Storage::delete('public/user_avatar/' . $user->avatar);
        }

        $user->update(['avatar' => $filename]);

        $this->avatarUpload = null;
        $this->avatarPreview = null;
        $this->loadProfile();
        session()->flash('profile_success', 'Profile picture updated successfully.');
    }

    public function cancelAvatarUpload()
    {
        $this->avatarUpload = null;
        $this->avatarPreview = null;
    }

    public function removeAvatar()
    {
        $user = Auth::user();

        if ($user->avatar && Storage::exists('public/user_avatar/' . $user->avatar)) {
            Storage::delete('public/user_avatar/' . $user->avatar);
        }

        $user->update(['avatar' => null]);
        $this->loadProfile();
        session()->flash('profile_success', 'Profile picture removed.');
    }

    /* ══════════════════════════════════════
     *  DOCUMENT UPLOADS (NRC & Passport Photo)
     * ══════════════════════════════════════ */

    public function updatedNrcUpload()
    {
        $this->validate([
            'nrcUpload' => 'image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);
        $this->nrcPreview = $this->nrcUpload->temporaryUrl();
    }

    public function saveNrcPhoto()
    {
        $this->validate([
            'nrcUpload' => 'required|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $user = Auth::user();
        $filename = 'nrc_' . $user->id . '_' . time() . '.' . $this->nrcUpload->getClientOriginalExtension();
        $this->nrcUpload->storeAs('public/user_documents', $filename);

        // Delete old NRC photo
        if ($user->nrc_photo && Storage::exists('public/user_documents/' . $user->nrc_photo)) {
            Storage::delete('public/user_documents/' . $user->nrc_photo);
        }

        $user->update(['nrc_photo' => $filename]);
        $this->nrcUpload = null;
        $this->nrcPreview = null;
        $this->loadProfile();
        session()->flash('profile_success', 'NRC photo uploaded successfully.');
    }

    public function cancelNrcUpload()
    {
        $this->nrcUpload = null;
        $this->nrcPreview = null;
    }

    public function removeNrcPhoto()
    {
        $user = Auth::user();
        if ($user->nrc_photo && Storage::exists('public/user_documents/' . $user->nrc_photo)) {
            Storage::delete('public/user_documents/' . $user->nrc_photo);
        }
        $user->update(['nrc_photo' => null]);
        $this->loadProfile();
        session()->flash('profile_success', 'NRC photo removed.');
    }

    public function updatedPassportUpload()
    {
        $this->validate([
            'passportUpload' => 'image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);
        $this->passportPreview = $this->passportUpload->temporaryUrl();
    }

    public function savePassportPhoto()
    {
        $this->validate([
            'passportUpload' => 'required|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $user = Auth::user();
        $filename = 'passport_' . $user->id . '_' . time() . '.' . $this->passportUpload->getClientOriginalExtension();
        $this->passportUpload->storeAs('public/user_documents', $filename);

        // Delete old passport photo
        if ($user->passport_photo && Storage::exists('public/user_documents/' . $user->passport_photo)) {
            Storage::delete('public/user_documents/' . $user->passport_photo);
        }

        $user->update(['passport_photo' => $filename]);
        $this->passportUpload = null;
        $this->passportPreview = null;
        $this->loadProfile();
        session()->flash('profile_success', 'Passport photo uploaded successfully.');
    }

    public function cancelPassportUpload()
    {
        $this->passportUpload = null;
        $this->passportPreview = null;
    }

    public function removePassportPhoto()
    {
        $user = Auth::user();
        if ($user->passport_photo && Storage::exists('public/user_documents/' . $user->passport_photo)) {
            Storage::delete('public/user_documents/' . $user->passport_photo);
        }
        $user->update(['passport_photo' => null]);
        $this->loadProfile();
        session()->flash('profile_success', 'Passport photo removed.');
    }

    /* ══════════════════════════════════════
     *  PAYMENT METHODS
     * ══════════════════════════════════════ */

    public function openPaymentModal($id = null)
    {
        $this->resetPaymentForm();

        if ($id) {
            $pm = UserPaymentMethod::where('id', $id)
                ->where('user_id', Auth::id())
                ->first();

            if ($pm) {
                $this->editingPaymentId = $pm->id;
                $this->pmType           = $pm->type;
                $this->pmLabel          = $pm->label ?? '';
                $this->pmBankName       = $pm->bank_name ?? '';
                $this->pmAccountName    = $pm->account_name ?? '';
                $this->pmAccountNumber  = $pm->account_number ?? '';
                $this->pmBranchName     = $pm->branch_name ?? '';
                $this->pmSwiftCode      = $pm->swift_code ?? '';
                $this->pmProvider       = $pm->provider ?? '';
                $this->pmMobileNumber   = $pm->mobile_number ?? '';
                $this->pmRegisteredName = $pm->registered_name ?? '';
                $this->pmCurrency       = $pm->currency ?? 'ZMW';
                $this->pmIsPrimary      = (bool) $pm->is_primary;
            }
        }

        $this->showPaymentModal = true;
        $this->resetErrorBag();
    }

    public function closePaymentModal()
    {
        $this->showPaymentModal = false;
        $this->resetPaymentForm();
        $this->resetErrorBag();
    }

    public function savePaymentMethod()
    {
        $rules = [
            'pmType'     => 'required|in:bank,mobile_money',
            'pmLabel'    => 'nullable|string|max:100',
            'pmCurrency' => 'required|string|max:10',
        ];

        if ($this->pmType === 'bank') {
            $rules['pmBankName']      = 'required|string|max:150';
            $rules['pmAccountName']   = 'required|string|max:150';
            $rules['pmAccountNumber'] = 'required|string|max:50';
            $rules['pmBranchName']    = 'nullable|string|max:150';
            $rules['pmSwiftCode']     = 'nullable|string|max:20';
        } else {
            $rules['pmProvider']       = 'required|string|max:100';
            $rules['pmMobileNumber']   = 'required|string|max:30';
            $rules['pmRegisteredName'] = 'required|string|max:150';
        }

        $this->validate($rules, [
            'pmBankName.required'      => 'Bank name is required.',
            'pmAccountName.required'   => 'Account name is required.',
            'pmAccountNumber.required' => 'Account number is required.',
            'pmProvider.required'      => 'Provider is required.',
            'pmMobileNumber.required'  => 'Mobile number is required.',
            'pmRegisteredName.required' => 'Registered name is required.',
        ]);

        $userId = Auth::id();

        // If setting as primary, un-primary all others first
        if ($this->pmIsPrimary) {
            UserPaymentMethod::where('user_id', $userId)
                ->where('is_primary', true)
                ->update(['is_primary' => false]);
        }

        // If this is the user's first payment method, auto-set as primary
        $existingCount = UserPaymentMethod::where('user_id', $userId)->count();
        if ($existingCount === 0 && !$this->editingPaymentId) {
            $this->pmIsPrimary = true;
        }

        $data = [
            'user_id'         => $userId,
            'type'            => $this->pmType,
            'label'           => $this->pmLabel ?: null,
            'bank_name'       => $this->pmType === 'bank' ? ($this->pmBankName ?: null) : null,
            'account_name'    => $this->pmType === 'bank' ? ($this->pmAccountName ?: null) : null,
            'account_number'  => $this->pmType === 'bank' ? ($this->pmAccountNumber ?: null) : null,
            'branch_name'     => $this->pmType === 'bank' ? ($this->pmBranchName ?: null) : null,
            'swift_code'      => $this->pmType === 'bank' ? ($this->pmSwiftCode ?: null) : null,
            'provider'        => $this->pmType === 'mobile_money' ? ($this->pmProvider ?: null) : null,
            'mobile_number'   => $this->pmType === 'mobile_money' ? ($this->pmMobileNumber ?: null) : null,
            'registered_name' => $this->pmType === 'mobile_money' ? ($this->pmRegisteredName ?: null) : null,
            'is_primary'      => $this->pmIsPrimary,
            'currency'        => $this->pmCurrency,
            'status'          => 'active',
        ];

        if ($this->editingPaymentId) {
            UserPaymentMethod::where('id', $this->editingPaymentId)
                ->where('user_id', $userId)
                ->update($data);
            $msg = 'Payment method updated.';
        } else {
            UserPaymentMethod::create($data);
            $msg = 'Payment method added.';
        }

        $this->closePaymentModal();
        session()->flash('profile_success', $msg);
    }

    public function setPrimaryPayment($id)
    {
        $userId = Auth::id();

        // Un-primary all
        UserPaymentMethod::where('user_id', $userId)
            ->where('is_primary', true)
            ->update(['is_primary' => false]);

        // Set this one
        UserPaymentMethod::where('id', $id)
            ->where('user_id', $userId)
            ->update(['is_primary' => true]);

        session()->flash('profile_success', 'Primary payment method updated.');
    }

    public function togglePaymentStatus($id)
    {
        $pm = UserPaymentMethod::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if ($pm) {
            $pm->update([
                'status' => $pm->status === 'active' ? 'inactive' : 'active',
            ]);
            session()->flash('profile_success', 'Payment method ' . ($pm->status === 'active' ? 'activated' : 'deactivated') . '.');
        }
    }

    public function deletePaymentMethod($id)
    {
        $pm = UserPaymentMethod::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if ($pm) {
            $wasPrimary = $pm->is_primary;
            $pm->delete();

            // If deleted the primary, promote the next one
            if ($wasPrimary) {
                $next = UserPaymentMethod::where('user_id', Auth::id())
                    ->where('status', 'active')
                    ->first();
                if ($next) {
                    $next->update(['is_primary' => true]);
                }
            }

            session()->flash('profile_success', 'Payment method removed.');
        }
    }

    private function resetPaymentForm()
    {
        $this->editingPaymentId = null;
        $this->pmType           = 'bank';
        $this->pmLabel          = '';
        $this->pmBankName       = '';
        $this->pmAccountName    = '';
        $this->pmAccountNumber  = '';
        $this->pmBranchName     = '';
        $this->pmSwiftCode      = '';
        $this->pmProvider       = '';
        $this->pmMobileNumber   = '';
        $this->pmRegisteredName = '';
        $this->pmCurrency       = 'ZMW';
        $this->pmIsPrimary      = false;
    }

    /* ══════════════════════════════════════
     *  CHANGE PASSWORD
     * ══════════════════════════════════════ */

    public function openPasswordModal()
    {
        $this->showPasswordModal = true;
        $this->currentPassword = '';
        $this->newPassword = '';
        $this->newPasswordConfirmation = '';
        $this->resetErrorBag();
    }

    public function closePasswordModal()
    {
        $this->showPasswordModal = false;
        $this->currentPassword = '';
        $this->newPassword = '';
        $this->newPasswordConfirmation = '';
        $this->resetErrorBag();
    }

    public function changePassword()
    {
        $this->validate([
            'currentPassword'          => 'required',
            'newPassword'              => ['required', 'min:8', 'different:currentPassword'],
            'newPasswordConfirmation'  => 'required|same:newPassword',
        ], [
            'newPassword.different'             => 'New password must be different from current password.',
            'newPasswordConfirmation.same'      => 'Password confirmation does not match.',
        ]);

        $user = Auth::user();

        if (!Hash::check($this->currentPassword, $user->password)) {
            $this->addError('currentPassword', 'Current password is incorrect.');
            return;
        }

        $user->update([
            'password'         => Hash::make($this->newPassword),
            'password_changed' => now(),
        ]);

        $this->closePasswordModal();
        session()->flash('profile_success', 'Password changed successfully.');
    }

    /* ══════════════════════════════════════
     *  HELPERS
     * ══════════════════════════════════════ */

    private function resolveRoleName($user)
    {
        if ($user->user_role_id == 1) {
            return 'Super Administrator';
        }

        // Try to load from roles relationship
        if (method_exists($user, 'roles') && $user->roles->isNotEmpty()) {
            return $user->roles->first()->name ?? 'Member';
        }

        // Check village bank role
        $bankRole = $user->villageBanks()
            ->where('status', 'active')
            ->first();

        if ($bankRole && $bankRole->pivot) {
            return ucfirst($bankRole->pivot->role) . ' Member';
        }

        return 'Member';
    }

    private function resolveAvatarUrl($user)
    {
        if ($user->avatar && file_exists(storage_path('app/public/user_avatar/' . $user->avatar))) {
            return asset('storage/user_avatar/' . $user->avatar);
        }

        return asset('img/default-avatar.svg');
    }

    private function resolveDocumentUrl($filename)
    {
        if ($filename && file_exists(storage_path('app/public/user_documents/' . $filename))) {
            return asset('storage/user_documents/' . $filename);
        }

        return null;
    }

    /* ══════════════════════════════════════
     *  RENDER
     * ══════════════════════════════════════ */

    public function render()
    {
        $user = Auth::user();

        // Village bank memberships
        $villageBanks = $user->villageBanks()
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        // Recent activity stats
        $stats = [
            'circles'  => $user->circles()->count(),
            'loans'    => $user->loans()->count(),
            'banks'    => $villageBanks->count(),
        ];

        // Payment methods
        $paymentMethods = $user->paymentMethods()
            ->orderByDesc('is_primary')
            ->orderBy('type')
            ->get();

        return view('livewire.user-management.user-profile', [
            'villageBanks'   => $villageBanks,
            'stats'          => $stats,
            'paymentMethods' => $paymentMethods,
        ]);
    }
}
