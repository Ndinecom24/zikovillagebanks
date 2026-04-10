<div>

@push('custom-styles')
<style>
    /* ═══════════════════════════════════════════════════════
     *  USER SHOW — Page-Specific Styles
     *  Common styles (hero, cards, buttons, modals,
     *  flash, forms, info-grid, empty, loading)
     *  are in /css/ndinecom-admin.css (nd-* prefix).
     * ═══════════════════════════════════════════════════════ */

    /* ── Hero: User Row ── */
    .us-hero-user {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    /* ── Hero: Avatar ── */
    .us-hero-avatar {
        position: relative;
        width: 72px;
        height: 72px;
        flex-shrink: 0;
    }
    .us-hero-avatar img {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid rgba(255,255,255,0.25);
    }
    .us-hero-avatar-init {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: rgba(255,255,255,0.12);
        border: 3px solid rgba(255,255,255,0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: 800;
        color: #fff;
        letter-spacing: 1px;
    }
    .us-hero-avatar label {
        position: absolute;
        bottom: -2px;
        right: -2px;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: var(--nd-amber);
        border: 2px solid var(--nd-navy);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #fff;
        font-size: 0.65rem;
        transition: transform 0.2s, background 0.2s;
        margin: 0;
    }
    .us-hero-avatar label:hover {
        background: #b45309;
        transform: scale(1.12);
    }

    /* ── Hero: Name & Meta ── */
    .us-hero-name {
        color: #fff;
        font-size: 1.5rem;
        font-weight: 800;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .us-hero-name i {
        color: var(--nd-amber);
        font-size: 1.1rem;
    }
    .us-hero-meta {
        color: rgba(255,255,255,0.55);
        font-size: 0.85rem;
        margin: 0.2rem 0 0;
    }
    .us-hero-meta code {
        background: rgba(255,255,255,0.12);
        color: var(--nd-amber-light);
        padding: 0.1rem 0.5rem;
        border-radius: 6px;
        font-size: 0.78rem;
        font-weight: 600;
    }

    /* ── Hero: Action Buttons ── */
    .us-hero-actions {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    .us-hero-actions .nd-btn-ghost {
        color: rgba(255,255,255,0.8);
        border-color: rgba(255,255,255,0.2);
    }
    .us-hero-actions .nd-btn-ghost:hover {
        border-color: rgba(255,255,255,0.5);
        color: #fff;
        background: rgba(255,255,255,0.1);
    }

    /* ── Tabs ── */
    .us-tabs {
        display: flex;
        gap: 0;
        background: var(--nd-card);
        border-radius: var(--nd-radius) var(--nd-radius) 0 0;
        border: 1px solid var(--nd-border);
        border-bottom: none;
        overflow: hidden;
    }
    .us-tab {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.85rem 1.35rem;
        font-size: 0.82rem;
        font-weight: 700;
        color: var(--nd-muted);
        background: transparent;
        border: none;
        border-bottom: 3px solid transparent;
        cursor: pointer;
        transition: all 0.2s;
        position: relative;
    }
    .us-tab:hover {
        color: var(--nd-text);
        background: #f8fafc;
    }
    .us-tab.active {
        color: var(--nd-amber);
        border-bottom-color: var(--nd-amber);
        background: #fff;
    }
    .us-tab i {
        font-size: 0.78rem;
    }
    .us-tab-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 20px;
        height: 20px;
        padding: 0 0.4rem;
        border-radius: 10px;
        background: rgba(30,58,95,0.08);
        color: var(--nd-navy);
        font-size: 0.68rem;
        font-weight: 800;
    }
    .us-tab.active .us-tab-count {
        background: rgba(217,119,6,0.12);
        color: var(--nd-amber);
    }

    /* ── Info Table (Profile / Account) ── */
    .us-info-table {
        width: 100%;
        border-collapse: collapse;
    }
    .us-info-table tbody tr {
        transition: background 0.15s;
    }
    .us-info-table tbody tr:hover {
        background: #fafbfd;
    }
    .us-info-table td {
        padding: 0.75rem 1.25rem;
        border-bottom: 1px solid var(--nd-border);
        font-size: 0.85rem;
        vertical-align: middle;
    }
    .us-info-table tbody tr:last-child td {
        border-bottom: none;
    }
    .us-info-label {
        width: 180px;
        font-size: 0.78rem;
        font-weight: 700;
        color: var(--nd-faint);
        text-transform: uppercase;
        letter-spacing: 0.3px;
        white-space: nowrap;
    }

    /* ── Role Badges ── */
    .us-role-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.22rem 0.65rem;
        border-radius: 8px;
        font-size: 0.72rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s;
        margin-right: 0.3rem;
        margin-bottom: 0.3rem;
    }
    .us-role-badge-direct {
        background: rgba(30,58,95,0.06);
        color: var(--nd-navy);
        border: 1px solid rgba(30,58,95,0.15);
    }
    .us-role-badge-direct:hover {
        background: rgba(30,58,95,0.12);
        border-color: rgba(30,58,95,0.3);
        color: var(--nd-navy);
        text-decoration: none;
        transform: translateY(-1px);
    }

    /* ── Password Reset Section ── */
    .us-pwd-section {
        border-top: 1px solid var(--nd-border);
        padding: 1.25rem;
        background: #fffbeb;
    }
    .us-pwd-warn {
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 10px;
        padding: 0.6rem 1rem;
        font-size: 0.82rem;
        color: var(--nd-red);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    /* ── Password Requirements Grid ── */
    .pwd-req {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.25rem 0.75rem;
        margin-top: 0.5rem;
    }
    .pwd-req span {
        font-size: 0.72rem;
        color: var(--nd-faint);
        display: flex;
        align-items: center;
        gap: 0.3rem;
        transition: color 0.2s;
    }
    .pwd-req span i {
        font-size: 0.6rem;
    }
    .pwd-req span.met {
        color: var(--nd-green);
    }

    /* ── Activity Log Table ── */
    .us-log-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 0.84rem;
    }
    .us-log-table thead th {
        background: #f8fafc;
        padding: 0.65rem 1rem;
        font-size: 0.64rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 700;
        color: var(--nd-faint);
        border-bottom: 1px solid var(--nd-border);
        white-space: nowrap;
    }
    .us-log-table tbody td {
        padding: 0.65rem 1rem;
        border-bottom: 1px solid var(--nd-border);
        vertical-align: middle;
        color: var(--nd-text);
    }
    .us-log-table tbody tr:last-child td {
        border-bottom: none;
    }
    .us-log-table tbody tr {
        transition: background 0.15s;
    }
    .us-log-table tbody tr:hover {
        background: #fafbfd;
    }

    /* ── Log Badges ── */
    .us-log-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.2rem;
        padding: 0.18rem 0.55rem;
        border-radius: 8px;
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    /* Type badges */
    .us-log-auth {
        background: rgba(37,99,235,0.08);
        color: var(--nd-blue);
        border: 1px solid rgba(37,99,235,0.2);
    }
    .us-log-model {
        background: rgba(124,58,237,0.08);
        color: var(--nd-purple);
        border: 1px solid rgba(124,58,237,0.2);
    }
    .us-log-system {
        background: #f3f4f6;
        color: var(--nd-muted);
        border: 1px solid #e5e7eb;
    }
    /* Event badges */
    .us-log-login {
        background: rgba(22,163,74,0.08);
        color: var(--nd-green);
        border: 1px solid rgba(22,163,74,0.2);
    }
    .us-log-logout {
        background: rgba(8,145,178,0.08);
        color: var(--nd-cyan);
        border: 1px solid rgba(8,145,178,0.2);
    }
    .us-log-created {
        background: rgba(37,99,235,0.08);
        color: var(--nd-blue);
        border: 1px solid rgba(37,99,235,0.2);
    }
    .us-log-updated {
        background: #fef3c7;
        color: #92400e;
        border: 1px solid #fde68a;
    }
    .us-log-deleted {
        background: #fef2f2;
        color: var(--nd-red);
        border: 1px solid #fecaca;
    }

    /* ── Responsive ── */
    @media (max-width: 768px) {
        .us-hero-user {
            flex-direction: column;
            text-align: center;
        }
        .us-hero-actions {
            justify-content: center;
        }
        .us-hero-name {
            font-size: 1.2rem;
            justify-content: center;
        }
        .us-tabs {
            overflow-x: auto;
        }
        .us-tab {
            padding: 0.75rem 1rem;
            font-size: 0.78rem;
            white-space: nowrap;
        }
        .us-info-label {
            width: 140px;
        }
        .us-log-table {
            font-size: 0.78rem;
        }
        .us-log-table thead th,
        .us-log-table tbody td {
            padding: 0.5rem 0.65rem;
        }
    }
</style>
@endpush

@can('view-users')
<div class="nd-page">
    {{-- â•â•â•â•â•â•â•â•â•â•â• HERO â•â•â•â•â•â•â•â•â•â•â• --}}
    <div class="nd-hero">
        <div class="nd-hero-inner">
            <ul class="nd-breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="sep">/</li>
                <li><a href="{{ route('users.index') }}">Users</a></li>
                <li class="sep">/</li>
                <li class="active">{{ $user->name }}</li>
            </ul>
            <div class="nd-hero-row">
                <div class="us-hero-user">
                    <div class="us-hero-avatar">
                        @if($user->avatar && file_exists(storage_path('app/public/user_avatar/' . $user->avatar)))
                            <img src="{{ asset('storage/user_avatar/' . $user->avatar) }}" alt="{{ $user->name }}">
                        @else
                            @php
                                $parts = explode(' ', trim($user->name));
                                $initials = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
                            @endphp
                            <div class="us-hero-avatar-init">{{ $initials }}</div>
                        @endif
                        <label for="avatarUploadInput" title="Change photo">
                            <i class="fas fa-camera"></i>
                            <input type="file" wire:model="avatarUpload" accept="image/*" id="avatarUploadInput" style="display:none;">
                        </label>
                    </div>
                    <div>
                        <h1 class="us-hero-name"><i class="fas fa-user"></i>{{ $user->name }}</h1>
                        <p class="us-hero-meta">
                            <code>{{ $user->username ?? 'N/A' }}</code>
                            &nbsp;{{ $user->job_title ?? 'No job title' }} &bull; {{ $user->directorate ?? 'No directorate' }}
                        </p>
                    </div>
                </div>
                <div class="us-hero-actions">
                    @if(!$editing)
                        <button wire:click="toggleEdit" class="nd-btn nd-btn-ghost">
                            <span wire:loading wire:target="toggleEdit" class="spinner-border spinner-border-sm" role="status" style="width:14px;height:14px;"></span>
                            <i wire:loading.remove wire:target="toggleEdit" class="fas fa-edit"></i> Edit Profile
                        </button>
                    @endif
                    <button wire:click="togglePasswordReset" class="nd-btn nd-btn-ghost">
                        <i class="fas fa-key"></i> Reset Password
                    </button>
                    <a href="{{ route('users.index') }}" class="nd-btn nd-btn-ghost">
                        <i class="fas fa-arrow-left"></i> Back to Users
                    </a>
                </div>
            </div>

            <div class="nd-stat-row">
                <div class="nd-stat">
                    <div class="nd-stat-val">{{ $userRoles->count() }}</div>
                    <div class="nd-stat-label">Roles Assigned</div>
                </div>
                <div class="nd-stat">
                    <div class="nd-stat-val" style="color:#fbbf24;">{{ $user->total_login ?? 0 }}</div>
                    <div class="nd-stat-label">Total Logins</div>
                </div>
                <div class="nd-stat">
                    <div class="nd-stat-val" style="color:#34d399;">
                        @if($user->password_changed == config('constants.password_changed'))
                            <i class="fas fa-check-circle" style="font-size:1rem;"></i>
                        @else
                            <i class="fas fa-times-circle" style="font-size:1rem;color:#f87171;"></i>
                        @endif
                    </div>
                    <div class="nd-stat-label">Password Status</div>
                </div>
                <div class="nd-stat">
                    <div class="nd-stat-val" style="color:#60a5fa;">{{ $user->created_at ? $user->created_at->diffForHumans(null, true) : 'N/A' }}</div>
                    <div class="nd-stat-label">Member Since</div>
                </div>
            </div>
        </div>
    </div>

    {{-- â•â•â•â•â•â•â•â•â•â•â• CONTENT â•â•â•â•â•â•â•â•â•â•â• --}}
    <div class="nd-content">

        {{-- Flash --}}
        @if(session()->has('message'))
            <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;padding:.65rem 1rem;margin-bottom:1rem;display:flex;align-items:center;gap:.5rem;font-size:.85rem;color:#166534;">
                <i class="fas fa-check-circle"></i> {!! session('message') !!}
            </div>
        @endif
        @error('avatarUpload')
            <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:12px;padding:.65rem 1rem;margin-bottom:1rem;font-size:.85rem;color:var(--nd-red);">
                <i class="fas fa-exclamation-circle"></i> {{ $message }}
            </div>
        @enderror
        <div wire:loading wire:target="avatarUpload">
            <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:12px;padding:.65rem 1rem;margin-bottom:1rem;font-size:.85rem;color:#1e40af;">
                <i class="fas fa-spinner fa-spin"></i> Uploading profile picture...
            </div>
        </div>

        {{-- â•â•â•â•â•â•â•â•â•â•â• TABS â•â•â•â•â•â•â•â•â•â•â• --}}
        <div class="us-tabs">
            <button wire:click="switchTab('profile')" class="us-tab {{ $activeTab === 'profile' ? 'active' : '' }}">
                <i class="fas fa-id-card"></i> Profile
            </button>
            <button wire:click="switchTab('roles')" class="us-tab {{ $activeTab === 'roles' ? 'active' : '' }}">
                <i class="fas fa-shield-alt"></i> Roles
                <span class="us-tab-count">{{ $userRoles->count() }}</span>
            </button>
            <button wire:click="switchTab('activity')" class="us-tab {{ $activeTab === 'activity' ? 'active' : '' }}">
                <i class="fas fa-history"></i> Activity Logs
            </button>
        </div>

        {{-- â•â•â•â•â•â•â• TAB: Profile â•â•â•â•â•â•â• --}}
        @if($activeTab === 'profile')
            <div class="nd-card" style="border-top-left-radius:0;border-top-right-radius:0;">
                <div class="nd-card-head">
                    <h3><i class="fas fa-id-card"></i> {{ $editing ? 'Edit Profile' : 'Personal Information' }}</h3>
                    @if(!$editing)
                        <button wire:click="toggleEdit" class="nd-btn nd-btn-light" style="padding:.3rem .75rem;font-size:.78rem;">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                    @endif
                </div>
                <div class="nd-card-body" style="padding:0;">
                    @if($editing)
                        <div style="padding:1.25rem;">
                            <div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem;">
                                <div class="nd-field">
                                    <label>Full Name <span class="req">*</span></label>
                                    <input type="text" wire:model.defer="editName">
                                    @error('editName') <div class="err">{{ $message }}</div> @enderror
                                </div>
                                <div class="nd-field">
                                    <label>Email <span class="req">*</span></label>
                                    <input type="email" wire:model.defer="editEmail">
                                    @error('editEmail') <div class="err">{{ $message }}</div> @enderror
                                </div>
                                <div class="nd-field">
                                    <label>Mobile No</label>
                                    <input type="text" wire:model.defer="editMobileNo">
                                    @error('editMobileNo') <div class="err">{{ $message }}</div> @enderror
                                </div>
                                <div class="nd-field">
                                    <label>Job Title</label>
                                    <input type="text" wire:model.defer="editJobTitle">
                                </div>
                                <div class="nd-field">
                                    <label>Department / Unit</label>
                                    <input type="text" wire:model.defer="editUserUnit">
                                </div>
                                <div class="nd-field">
                                    <label>Directorate</label>
                                    <input type="text" wire:model.defer="editDirectorate">
                                </div>
                            </div>
                            <div style="display:flex;gap:.5rem;margin-top:.5rem;">
                                <button wire:click="saveProfile" class="nd-btn nd-btn-amber" wire:loading.attr="disabled">
                                    <span wire:loading wire:target="saveProfile" class="spinner-border spinner-border-sm" role="status" style="width:14px;height:14px;"></span>
                                    <i wire:loading.remove wire:target="saveProfile" class="fas fa-check"></i> Save Changes
                                </button>
                                <button wire:click="cancelEdit" class="nd-btn nd-btn-light">Cancel</button>
                            </div>
                        </div>
                    @else
                        <table class="us-info-table">
                            <tbody>
                                @php
                                    $fields = [
                                        ['Full Name', $user->name, 'fas fa-user'],
                                        ['Username', $user->username, 'fas fa-at'],
                                        ['Email', $user->email, 'fas fa-envelope'],
                                        ['Mobile No', $user->mobile_no, 'fas fa-phone-alt'],
                                        ['Job Title', $user->job_title, 'fas fa-briefcase'],
                                        ['Dept / Unit', $user->user_unit, 'fas fa-building'],
                                        ['Directorate', $user->directorate, 'fas fa-sitemap'],
                                    ];
                                @endphp
                                @foreach($fields as $f)
                                    <tr>
                                        <td class="us-info-label"><i class="{{ $f[2] }}" style="font-size:.7rem;color:var(--nd-amber);margin-right:.4rem;"></i> {{ $f[0] }}</td>
                                        <td class="nd-info-val">{{ $f[1] ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

            {{-- Account Info --}}
            <div class="nd-card">
                <div class="nd-card-head">
                    <h3><i class="fas fa-info-circle"></i> Account Information</h3>
                </div>
                <div class="nd-card-body" style="padding:0;">
                    <table class="us-info-table">
                        <tbody>
                            <tr>
                                <td class="us-info-label">User ID</td>
                                <td class="nd-info-val">#{{ $user->id }}</td>
                            </tr>
                            <tr>
                                <td class="us-info-label">Total Logins</td>
                                <td class="nd-info-val">
                                    <span style="background:#f3f4f6;padding:.15rem .5rem;border-radius:6px;font-weight:700;font-size:.82rem;">{{ $user->total_login ?? 0 }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="us-info-label">Password Status</td>
                                <td class="nd-info-val">
                                    @if($user->password_changed == config('constants.password_changed'))
                                        <span style="color:var(--nd-green);font-weight:600;font-size:.82rem;">
                                            <i class="fas fa-check-circle"></i> Changed
                                        </span>
                                    @else
                                        <span style="color:var(--nd-red);font-weight:600;font-size:.82rem;">
                                            <i class="fas fa-exclamation-circle"></i> Not Changed
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="us-info-label">Created</td>
                                <td class="nd-info-val">{{ $user->created_at ? $user->created_at->format('M d, Y') : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="us-info-label">Last Updated</td>
                                <td class="nd-info-val">{{ $user->updated_at ? $user->updated_at->diffForHumans() : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td class="us-info-label">Roles</td>
                                <td class="nd-info-val">
                                    @forelse($userRoles as $role)
                                        <a href="{{ route('roles.show', $role->id) }}" class="us-role-badge us-role-badge-direct">
                                            <i class="fas fa-shield-alt" style="font-size:.6rem;"></i> {{ $role->name }}
                                        </a>
                                    @empty
                                        <span style="color:#d1d5db;font-size:.82rem;">â€”</span>
                                    @endforelse
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    {{-- Password Reset --}}
                    @if($showPasswordReset)
                        <div class="us-pwd-section">
                            <h6 style="font-size:.88rem;font-weight:700;color:#92400e;margin:0 0 .65rem;">
                                <i class="fas fa-key mr-1" style="color:var(--nd-red);"></i> Reset Password
                            </h6>
                            <div class="us-pwd-warn">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                Resetting for <strong>{{ $user->name }}</strong>. They must change it on next login.
                            </div>
                            <div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem;">
                                <div class="nd-field">
                                    <label>New Password <span class="req">*</span></label>
                                    <input type="password" wire:model="newPassword" placeholder="Enter new password" id="resetPwd">
                                    @error('newPassword') <div class="err">{{ $message }}</div> @enderror
                                    <div class="pwd-req" id="pwdReqGrid">
                                        <span id="rr-length"><i class="bi bi-circle"></i> Min 8 chars</span>
                                        <span id="rr-upper"><i class="bi bi-circle"></i> Uppercase</span>
                                        <span id="rr-lower"><i class="bi bi-circle"></i> Lowercase</span>
                                        <span id="rr-number"><i class="bi bi-circle"></i> Number</span>
                                        <span id="rr-special"><i class="bi bi-circle"></i> Special char</span>
                                        <span id="rr-match"><i class="bi bi-circle"></i> Match</span>
                                    </div>
                                </div>
                                <div class="nd-field">
                                    <label>Confirm Password <span class="req">*</span></label>
                                    <input type="password" wire:model="newPasswordConfirmation" placeholder="Confirm password" id="resetPwdConfirm">
                                    @error('newPasswordConfirmation') <div class="err">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div style="display:flex;gap:.5rem;">
                                <button wire:click="resetUserPassword" class="nd-btn nd-btn-danger" style="border:1px solid #fecaca;" wire:loading.attr="disabled">
                                    <span wire:loading wire:target="resetUserPassword" class="spinner-border spinner-border-sm" role="status" style="width:14px;height:14px;"></span>
                                    <i wire:loading.remove wire:target="resetUserPassword" class="fas fa-key"></i> Reset
                                </button>
                                <button wire:click="togglePasswordReset" class="nd-btn nd-btn-light">Cancel</button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        {{-- â•â•â•â•â•â•â• TAB: Roles â•â•â•â•â•â•â• --}}
        @if($activeTab === 'roles')
            <div class="nd-card" style="border-top-left-radius:0;border-top-right-radius:0;">
                <div class="nd-card-head">
                    <h3><i class="fas fa-shield-alt"></i> Assigned Roles</h3>
                    <a href="{{ route('user-roles.index') }}" class="nd-btn nd-btn-navy" style="padding:.3rem .75rem;font-size:.78rem;">
                        <i class="fas fa-cog"></i> Manage Roles
                    </a>
                </div>
                <div class="nd-card-body">
                    @forelse($userRoles as $role)
                        <a href="{{ route('roles.show', $role->id) }}" class="us-role-badge us-role-badge-direct" style="margin-bottom:.4rem;">
                            <i class="fas fa-shield-alt" style="font-size:.6rem;"></i> {{ $role->name }}
                        </a>
                    @empty
                        <div class="nd-empty">
                            <i class="fas fa-shield-alt"></i>
                            <p style="margin:0;font-size:.85rem;">No roles assigned to this user.</p>
                            <a href="{{ route('user-roles.index') }}" class="nd-btn nd-btn-amber" style="margin-top:.75rem;">
                                <i class="fas fa-user-tag"></i> Manage User Roles
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        @endif

        {{-- â•â•â•â•â•â•â• TAB: Activity Logs â•â•â•â•â•â•â• --}}
        @if($activeTab === 'activity')
            <div class="nd-card" style="border-top-left-radius:0;border-top-right-radius:0;">
                <div class="nd-card-head">
                    <h3><i class="fas fa-history"></i> Activity Log</h3>
                    <div style="display:flex;align-items:center;gap:.5rem;">
                        <span style="font-size:.75rem;color:var(--nd-muted);font-weight:600;">Last 50 entries</span>
                        <a href="{{ route('activity-logs.index', ['search' => $user->name]) }}" class="nd-btn nd-btn-navy" style="padding:.3rem .75rem;font-size:.78rem;">
                            <i class="fas fa-external-link-alt"></i> View All
                        </a>
                    </div>
                </div>
                <div style="overflow-x:auto;">
                    <table class="us-log-table">
                        <thead>
                            <tr>
                                <th>When</th>
                                <th>Type</th>
                                <th>Event</th>
                                <th>Description</th>
                                <th>Subject</th>
                                <th>IP Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($activityLogs as $log)
                                <tr>
                                    <td style="white-space:nowrap;">
                                        <div style="font-weight:600;font-size:.8rem;">{{ $log->created_at->format('d M Y') }}</div>
                                        <div style="font-size:.7rem;color:var(--nd-faint);">{{ $log->created_at->format('H:i:s') }} &middot; {{ $log->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td>
                                        @php $tc = match($log->log_type){ 'auth' => 'us-log-auth', 'model' => 'us-log-model', default => 'us-log-system' }; @endphp
                                        <span class="us-log-badge {{ $tc }}">
                                            <i class="fas fa-{{ $log->log_type === 'auth' ? 'sign-in-alt' : ($log->log_type === 'model' ? 'database' : 'cog') }}" style="font-size:.5rem;margin-right:.2rem;"></i>
                                            {{ $log->log_type }}
                                        </span>
                                    </td>
                                    <td>
                                        @php $ec = match($log->event){ 'login' => 'us-log-login', 'logout' => 'us-log-logout', 'created' => 'us-log-created', 'updated' => 'us-log-updated', 'deleted' => 'us-log-deleted', default => 'us-log-system' }; @endphp
                                        <span class="us-log-badge {{ $ec }}">{{ $log->event }}</span>
                                    </td>
                                    <td style="font-size:.82rem;">{{ Str::limit($log->description, 60) }}</td>
                                    <td>
                                        @if($log->subject_type)
                                            <span style="font-size:.72rem;color:var(--nd-faint);font-family:'Courier New',monospace;">{{ class_basename($log->subject_type) }} #{{ $log->subject_id }}</span>
                                        @else
                                            <span style="color:var(--nd-faint);">â€”</span>
                                        @endif
                                    </td>
                                    <td style="font-size:.76rem;color:var(--nd-faint);font-family:'Courier New',monospace;">{{ $log->ip_address ?? 'â€”' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="nd-empty">
                                            <i class="fas fa-history"></i>
                                            <p style="margin:0;">No activity logged for this user yet.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

    </div>
</div>

@push('custom-scripts')
<script>
document.addEventListener('livewire:load', function() {
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
                if (checks[key]) { el.classList.add('met'); el.querySelector('i').className = 'bi bi-check-circle-fill'; }
                else { el.classList.remove('met'); el.querySelector('i').className = 'bi bi-circle'; }
            }
        }
    }
    Livewire.hook('message.processed', function() {
        var pwd = document.getElementById('resetPwd');
        var confirm = document.getElementById('resetPwdConfirm');
        if (pwd) { pwd.removeEventListener('input', checkReqs); pwd.addEventListener('input', checkReqs); }
        if (confirm) { confirm.removeEventListener('input', checkReqs); confirm.addEventListener('input', checkReqs); }
    });
});
</script>
@endpush
@else
    @include('livewire.partials.unauthorized')
@endcan
</div>
