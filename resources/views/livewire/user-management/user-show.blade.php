
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<div>
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <a href="{{ route('user.index') }}" class="z-back mb-2 d-inline-block">
                <i class="fas fa-arrow-left"></i> Back to Users
            </a>

            {{-- Flash --}}
            @if(session()->has('message'))
                <div class="alert alert-success" style="border-radius: 10px; font-size: 0.9rem;">
                    <i class="fas fa-check-circle mr-1"></i> {{ session('message') }}
                </div>
            @endif

            {{-- Profile Header --}}
            <div class="z-profile-header">
                <div class="z-profile-header-bg">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 style="font-weight: 700; margin: 0; font-size: 1.1rem;">
                                <i class="fas fa-user mr-1" style="color: var(--z-gold);"></i> User Profile
                            </h4>
                            <p style="margin: 0.25rem 0 0; opacity: 0.8; font-size: 0.85rem;">
                                Staff No: {{ $user->staff_no ?? 'N/A' }}
                            </p>
                        </div>
                        <div class="d-flex" style="gap: 0.5rem;">
                            @if(!$editing)
                                <button wire:click="toggleEdit" class="btn-zesco">
                                    <i class="fas fa-edit"></i> Edit Profile
                                </button>
                            @endif
                            <button wire:click="togglePasswordReset" class="btn-zesco-outline" style="border-color: rgba(255,255,255,0.4); color: #fff;">
                                <i class="fas fa-key"></i> Reset Password
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Avatar + Name bar --}}
                <div style="position: relative;">
                    <div class="z-profile-avatar-wrap">
                        <img src="{{ asset('storage/user_avatar/' . ($user->avatar ?? '')) }}"
                             class="z-profile-avatar"
                             onerror="this.src='{{ asset('dashboard/dist/img/avatar.png') }}';">
                        <label class="z-profile-avatar-upload" title="Change photo">
                            <i class="fas fa-camera"></i>
                            <input type="file" wire:model="avatarUpload" accept="image/*">
                        </label>
                    </div>
                    <div class="z-profile-info-bar">
                        <h3 class="z-profile-name">{{ $user->name }}</h3>
                        <div class="z-profile-meta">
                            {{ $user->job_title ?? 'No job title' }} &bull; {{ $user->directorate ?? 'No directorate' }}
                            @foreach($userRoles as $role)
                                <span class="z-role-badge ml-2"><i class="fas fa-shield-alt"></i> {{ $role->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            {{-- Avatar upload progress --}}
            <div wire:loading wire:target="avatarUpload" class="mb-2">
                <div class="alert alert-info" style="border-radius: 10px; font-size: 0.85rem;">
                    <i class="fas fa-spinner fa-spin mr-1"></i> Uploading profile picture...
                </div>
            </div>
            @error('avatarUpload')
                <div class="alert alert-danger" style="border-radius: 10px; font-size: 0.85rem;">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                {{-- Left Column: Details --}}
                <div class="col-lg-8">

                    {{-- ===== VIEW MODE ===== --}}
                    @if(!$editing)
                    <div class="z-card">
                        <div class="z-card-title">
                            <i class="fas fa-id-card" style="color: var(--z-green);"></i> Personal Information
                        </div>
                        <div class="z-card-body">
                            <div class="z-detail-row">
                                <div class="z-detail-label">Full Name</div>
                                <div class="z-detail-value">{{ $user->name ?? 'N/A' }}</div>
                            </div>
                            <div class="z-detail-row">
                                <div class="z-detail-label">Staff No</div>
                                <div class="z-detail-value">{{ $user->staff_no ?? 'N/A' }}</div>
                            </div>
                            <div class="z-detail-row">
                                <div class="z-detail-label">Email</div>
                                <div class="z-detail-value">{{ $user->email ?? 'N/A' }}</div>
                            </div>
                            <div class="z-detail-row">
                                <div class="z-detail-label">Mobile No</div>
                                <div class="z-detail-value">{{ $user->mobile_no ?? 'N/A' }}</div>
                            </div>
                            <div class="z-detail-row">
                                <div class="z-detail-label">Job Title</div>
                                <div class="z-detail-value">{{ $user->job_title ?? 'N/A' }}</div>
                            </div>
                            <div class="z-detail-row">
                                <div class="z-detail-label">Department / Unit</div>
                                <div class="z-detail-value">{{ $user->user_unit ?? 'N/A' }}</div>
                            </div>
                            <div class="z-detail-row">
                                <div class="z-detail-label">Directorate</div>
                                <div class="z-detail-value">{{ $user->directorate ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- ===== EDIT MODE ===== --}}
                    @if($editing)
                    <div class="z-card">
                        <div class="z-card-title">
                            <i class="fas fa-edit" style="color: var(--z-gold);"></i> Edit Profile
                        </div>
                        <div class="z-card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="z-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" wire:model.defer="editName" class="form-control z-input">
                                    @error('editName') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="z-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" wire:model.defer="editEmail" class="form-control z-input">
                                    @error('editEmail') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="z-label">Mobile No</label>
                                    <input type="text" wire:model.defer="editMobileNo" class="form-control z-input">
                                    @error('editMobileNo') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="z-label">Job Title</label>
                                    <input type="text" wire:model.defer="editJobTitle" class="form-control z-input">
                                </div>
                                <div class="col-md-4">
                                    <label class="z-label">Department / Unit</label>
                                    <input type="text" wire:model.defer="editUserUnit" class="form-control z-input">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="z-label">Directorate</label>
                                    <input type="text" wire:model.defer="editDirectorate" class="form-control z-input">
                                </div>
                            </div>
                            <div class="d-flex" style="gap: 0.5rem; margin-top: 1rem;">
                                <button wire:click="saveProfile" class="btn-zesco-green" wire:loading.attr="disabled">
                                    <i class="fas fa-check mr-1"></i> Save Changes
                                </button>
                                <button wire:click="cancelEdit" class="btn btn-light" style="border-radius: 8px;">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- ===== PASSWORD RESET ===== --}}
                    @if($showPasswordReset)
                    <div class="z-card">
                        <div class="z-card-title">
                            <i class="fas fa-key" style="color: #dc2626;"></i> Reset User Password
                        </div>
                        <div class="z-card-body">
                            <div class="z-pwd-section">
                                <p style="font-size: 0.85rem; color: #92400e; margin: 0 0 1rem;">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    This will reset the password for <strong>{{ $user->name }}</strong>. The user will be required to change their password on next login.
                                </p>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="z-label">New Password <span class="text-danger">*</span></label>
                                        <input type="password" wire:model="newPassword" class="form-control z-input" placeholder="Enter new password" id="resetPwd">
                                        @error('newPassword') <small class="text-danger">{{ $message }}</small> @enderror

                                        {{-- Live requirements --}}
                                        <div class="pwd-req mt-2" id="pwdReqGrid">
                                            <span id="rr-length"><i class="bi bi-circle"></i> Min 8 chars</span>
                                            <span id="rr-upper"><i class="bi bi-circle"></i> Uppercase</span>
                                            <span id="rr-lower"><i class="bi bi-circle"></i> Lowercase</span>
                                            <span id="rr-number"><i class="bi bi-circle"></i> Number</span>
                                            <span id="rr-special"><i class="bi bi-circle"></i> Special char</span>
                                            <span id="rr-match"><i class="bi bi-circle"></i> Passwords match</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="z-label">Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password" wire:model="newPasswordConfirmation" class="form-control z-input" placeholder="Confirm password" id="resetPwdConfirm">
                                        @error('newPasswordConfirmation') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>
                                </div>

                                <div class="d-flex" style="gap: 0.5rem;">
                                    <button wire:click="resetUserPassword" class="btn btn-danger" style="border-radius: 8px; font-weight: 600;" wire:loading.attr="disabled">
                                        <i class="fas fa-key mr-1"></i> Reset Password
                                    </button>
                                    <button wire:click="togglePasswordReset" class="btn btn-light" style="border-radius: 8px;">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Right Column: Quick Info --}}
                <div class="col-lg-4">
                    {{-- Account Info --}}
                    <div class="z-card">
                        <div class="z-card-title">
                            <i class="fas fa-info-circle" style="color: var(--z-green);"></i> Account Info
                        </div>
                        <div class="z-card-body">
                            <div class="z-detail-row">
                                <div class="z-detail-label">User ID</div>
                                <div class="z-detail-value">#{{ $user->id }}</div>
                            </div>
                            <div class="z-detail-row">
                                <div class="z-detail-label">Total Logins</div>
                                <div class="z-detail-value">
                                    <span class="badge badge-light" style="font-size: 0.85rem;">{{ $user->total_login ?? 0 }}</span>
                                </div>
                            </div>
                            <div class="z-detail-row">
                                <div class="z-detail-label">Password Status</div>
                                <div class="z-detail-value">
                                    @if($user->password_changed == config('constants.password_changed'))
                                        <span style="color: #16a34a; font-weight: 600; font-size: 0.82rem;">
                                            <i class="fas fa-check-circle"></i> Changed
                                        </span>
                                    @else
                                        <span style="color: #dc2626; font-weight: 600; font-size: 0.82rem;">
                                            <i class="fas fa-exclamation-circle"></i> Not Changed
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="z-detail-row">
                                <div class="z-detail-label">Created</div>
                                <div class="z-detail-value">{{ $user->created_at ? $user->created_at->format('M d, Y') : 'N/A' }}</div>
                            </div>
                            <div class="z-detail-row">
                                <div class="z-detail-label">Last Updated</div>
                                <div class="z-detail-value">{{ $user->updated_at ? $user->updated_at->diffForHumans() : 'N/A' }}</div>
                            </div>
                        </div>
                    </div>

                    {{-- Roles --}}
                    <div class="z-card">
                        <div class="z-card-title">
                            <i class="fas fa-shield-alt" style="color: var(--z-gold);"></i> Assigned Roles
                        </div>
                        <div class="z-card-body">
                            @forelse($userRoles as $role)
                                <div class="d-flex align-items-center justify-content-between mb-2" style="padding: 0.5rem 0; border-bottom: 1px solid #f3f4f6;">
                                    <div>
                                        <span class="z-role-badge"><i class="fas fa-shield-alt"></i> {{ $role->name }}</span>
                                    </div>
                                    <small style="color: #94a3b8;">{{ $role->description ?? '' }}</small>
                                </div>
                            @empty
                                <div class="text-center py-3" style="color: #94a3b8; font-size: 0.85rem;">
                                    <i class="fas fa-shield-alt d-block mb-1" style="font-size: 1.5rem;"></i>
                                    No roles assigned
                                </div>
                            @endforelse
                            <div class="mt-2">
                                <a href="{{ route('user-roles.index') }}" class="btn-zesco-outline" style="font-size: 0.78rem; padding: 0.3rem 0.75rem;">
                                    <i class="fas fa-cog"></i> Manage Roles
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Quick Actions --}}
                    <div class="z-card">
                        <div class="z-card-title">
                            <i class="fas fa-bolt" style="color: var(--z-gold);"></i> Quick Actions
                        </div>
                        <div class="z-card-body">
                            <div class="d-flex flex-column" style="gap: 0.5rem;">
                                <button wire:click="toggleEdit" class="btn-zesco-outline" style="width: 100%; justify-content: center;">
                                    <i class="fas fa-edit"></i> {{ $editing ? 'Cancel Edit' : 'Edit Profile' }}
                                </button>
                                <button wire:click="togglePasswordReset" class="btn-zesco-outline" style="width: 100%; justify-content: center;">
                                    <i class="fas fa-key"></i> {{ $showPasswordReset ? 'Cancel Reset' : 'Reset Password' }}
                                </button>
                                <a href="{{ route('user.index') }}" class="btn btn-light text-center" style="border-radius: 8px; font-weight: 600; font-size: 0.82rem;">
                                    <i class="fas fa-arrow-left mr-1"></i> Back to List
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- Password requirements live checking --}}
<script>
document.addEventListener('livewire:load', function () {
    function checkReqs() {
        var pwd = document.getElementById('resetPwd');
        var confirm = document.getElementById('resetPwdConfirm');
        if (!pwd || !confirm) return;

        var p = pwd.value, c = confirm.value;
        var checks = {
            'rr-length': p.length >= 8,
            'rr-upper': /[A-Z]/.test(p),
            'rr-lower': /[a-z]/.test(p),
            'rr-number': /[0-9]/.test(p),
            'rr-special': /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?`~]/.test(p),
            'rr-match': p.length > 0 && p === c
        };
        for (var key in checks) {
            var el = document.getElementById(key);
            if (el) {
                if (checks[key]) {
                    el.classList.add('met');
                    el.querySelector('i').className = 'bi bi-check-circle-fill';
                } else {
                    el.classList.remove('met');
                    el.querySelector('i').className = 'bi bi-circle';
                }
            }
        }
    }
    // Attach after Livewire updates
    Livewire.hook('message.processed', function () {
        var pwd = document.getElementById('resetPwd');
        var confirm = document.getElementById('resetPwdConfirm');
        if (pwd) {
            pwd.removeEventListener('input', checkReqs);
            pwd.addEventListener('input', checkReqs);
        }
        if (confirm) {
            confirm.removeEventListener('input', checkReqs);
            confirm.addEventListener('input', checkReqs);
        }
    });
});
</script>