<div>

@can('manage-roles')
<div class="nd-page">
    {{-- â•â•â•â•â•â•â•â•â•â•â• HERO â•â•â•â•â•â•â•â•â•â•â• --}}
    <div class="nd-hero">
        <div class="nd-hero-inner">
            <ul class="nd-breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="sep">/</li>
                <li><a href="{{ route('roles.index') }}">Roles</a></li>
                <li class="sep">/</li>
                <li class="active">{{ $role->name }}</li>
            </ul>
            <div class="nd-hero-row">
                <div class="nd-hero-title">
                    <h1><i class="fas fa-user-shield"></i>{{ $role->name }}</h1>
                    <p class="nd-hero-sub">
                        <code>{{ $role->slug }}</code> &mdash; {{ $role->description ?? 'No description provided' }}
                    </p>
                </div>
                <a href="{{ route('roles.index') }}" class="nd-hero-btn nd-hero-btn-back">
                    <i class="fas fa-arrow-left"></i> Back to Roles
                </a>
            </div>

            <div class="nd-stat-row">
                <div class="nd-stat">
                    <div class="nd-stat-val">{{ $role->permissions->count() }}</div>
                    <div class="nd-stat-label">Permissions Assigned</div>
                </div>
                <div class="nd-stat">
                    <div class="nd-stat-val" style="color:#60a5fa;">{{ $role->users->count() }}</div>
                    <div class="nd-stat-label">Users with this Role</div>
                </div>
                <div class="nd-stat">
                    <div class="nd-stat-val" style="color:#fbbf24;">{{ $role->created_at->format('M d, Y') }}</div>
                    <div class="nd-stat-label">Created On</div>
                </div>
            </div>
        </div>
    </div>

    {{-- â•â•â•â•â•â•â•â•â•â•â• CONTENT â•â•â•â•â•â•â•â•â•â•â• --}}
    <div class="nd-content">
        {{-- Alerts --}}
        @if(session()->has('message'))
            <div class="rs-alert rs-alert-success">
                <i class="fas fa-check-circle"></i> {!! session('message') !!}
            </div>
        @endif
        @if(session()->has('error'))
            <div class="rs-alert rs-alert-error">
                <i class="fas fa-exclamation-circle"></i> {!! session('error') !!}
            </div>
        @endif

        {{-- Role Details Card --}}
        <div class="nd-card">
            <div class="nd-card-header">
                <h3><i class="fas fa-info-circle"></i> Role Details</h3>
            </div>
            <div class="rs-detail-grid">
                <div class="rs-detail-item">
                    <label>Role Name</label>
                    <p>{{ $role->name }}</p>
                </div>
                <div class="rs-detail-item">
                    <label>Slug</label>
                    <p style="font-family:'Courier New',monospace;color:var(--rs-cyan);">{{ $role->slug }}</p>
                </div>
                <div class="rs-detail-item">
                    <label>Description</label>
                    <p>{{ $role->description ?? 'No description' }}</p>
                </div>
                <div class="rs-detail-item">
                    <label>Created</label>
                    <p>{{ $role->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>

        {{-- Tabs --}}
        <div class="rs-tabs">
            <button class="rs-tab {{ $activeTab === 'permissions' ? 'active' : '' }}" wire:click="$set('activeTab', 'permissions')">
                <i class="fas fa-key"></i> Permissions
                <span class="rs-tab-badge rs-tab-badge-perm">{{ $role->permissions->count() }}</span>
            </button>
            <button class="rs-tab {{ $activeTab === 'users' ? 'active' : '' }}" wire:click="$set('activeTab', 'users')">
                <i class="fas fa-users"></i> Users
                <span class="rs-tab-badge rs-tab-badge-user">{{ $role->users->count() }}</span>
            </button>
        </div>

        {{-- â•â•â•â•â•â•â•â•â•â•â• PERMISSIONS TAB â•â•â•â•â•â•â•â•â•â•â• --}}
        @if($activeTab === 'permissions')
        <div class="rs-tab-content">
            <div class="nd-card-header" style="border-radius:0;">
                <h3><i class="fas fa-key"></i> Assigned Permissions</h3>
                <button class="nd-btn nd-btn-amber" wire:click="openPermModal">
                    <span wire:loading wire:target="openPermModal" class="spinner-border spinner-border-sm" role="status"></span>
                    <i wire:loading.remove wire:target="openPermModal" class="fas fa-plus"></i> Attach Permissions
                </button>
            </div>

            @php $grouped = $role->permissions->groupBy('group'); @endphp
            @forelse($grouped as $group => $perms)
                <div class="rs-perm-group">
                    <div class="rs-perm-group-head">
                        <i class="fas fa-folder-open"></i> {{ $group ?: 'General' }}
                        <span>({{ $perms->count() }})</span>
                    </div>
                    <div class="rs-perm-pills">
                        @foreach($perms as $perm)
                            <div class="rs-perm-pill">
                                <i class="fas fa-shield-alt" style="font-size:.62rem;"></i>
                                {{ $perm->name }}
                                @if($detachType === 'permission' && $detachId === $perm->id)
                                    <button wire:click="detachPermission" class="rs-btn-confirm-sm" style="padding:.15rem .4rem;font-size:.65rem;margin-left:.2rem;" title="Confirm remove">
                                        <span wire:loading wire:target="detachPermission" class="spinner-border spinner-border-sm" role="status" style="width:10px;height:10px;"></span>
                                        <i wire:loading.remove wire:target="detachPermission" class="fas fa-check"></i>
                                    </button>
                                    <button wire:click="cancelDetach" class="nd-btn-cancel-sm" style="padding:.15rem .4rem;font-size:.65rem;" title="Cancel">
                                        <i class="fas fa-times"></i>
                                    </button>
                                @else
                                    <button wire:click="confirmDetachPermission({{ $perm->id }}, '{{ addslashes($perm->name) }}')"
                                            class="rs-perm-pill-remove" title="Remove permission">
                                        <i class="fas fa-times-circle"></i>
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="nd-empty">
                    <i class="fas fa-key"></i>
                    <p style="margin:0 0 .5rem;">No permissions assigned to this role.</p>
                    <button class="nd-btn nd-btn-amber" wire:click="openPermModal">
                        <i class="fas fa-plus"></i> Attach Permissions
                    </button>
                </div>
            @endforelse
        </div>
        @endif

        {{-- â•â•â•â•â•â•â•â•â•â•â• USERS TAB â•â•â•â•â•â•â•â•â•â•â• --}}
        @if($activeTab === 'users')
        <div class="rs-tab-content">
            <div class="nd-card-header" style="border-radius:0;">
                <h3><i class="fas fa-users"></i> Users with this Role</h3>
                <button class="nd-btn nd-btn-amber" wire:click="openUserModal">
                    <span wire:loading wire:target="openUserModal" class="spinner-border spinner-border-sm" role="status"></span>
                    <i wire:loading.remove wire:target="openUserModal" class="fas fa-user-plus"></i> Assign Users
                </button>
            </div>

            <div style="overflow-x:auto;">
                <table class="nd-table">
                    <thead>
                        <tr>
                            <th style="width:40px;">#</th>
                            <th>User</th>
                            <th>Staff No</th>
                            <th>Email</th>
                            <th>Job Title</th>
                            <th style="text-align:center;width:120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($role->users as $idx => $u)
                            <tr>
                                <td style="color:var(--nd-faint);">{{ $idx + 1 }}</td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:.55rem;">
                                        <div class="nd-avatar">{{ strtoupper(substr($u->name, 0, 1)) }}</div>
                                        <div>
                                            <div style="font-weight:600;color:#111827;">{{ $u->name }}</div>
                                            @if($u->directorate)
                                                <div style="font-size:.72rem;color:var(--nd-faint);">{{ $u->directorate }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $u->username ?? 'â€”' }}</td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->job_title ?? 'â€”' }}</td>
                                <td style="text-align:center;">
                                    @if($detachType === 'user' && $detachId === $u->id)
                                        <button wire:click="detachUser" class="rs-btn-confirm-sm" title="Confirm remove">
                                            <span wire:loading wire:target="detachUser" class="spinner-border spinner-border-sm mr-1" role="status" style="width:12px;height:12px;"></span>
                                            <i wire:loading.remove wire:target="detachUser" class="fas fa-check mr-1"></i>Confirm
                                        </button>
                                        <button wire:click="cancelDetach" class="nd-btn-cancel-sm">
                                            Cancel
                                        </button>
                                    @else
                                        <button wire:click="confirmDetachUser({{ $u->id }}, '{{ addslashes($u->name) }}')"
                                                class="nd-btn-danger-sm" title="Remove from role">
                                            <i class="fas fa-user-minus mr-1"></i> Remove
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="nd-empty">
                                        <i class="fas fa-users"></i>
                                        <p style="margin:0 0 .5rem;">No users assigned to this role.</p>
                                        <button class="nd-btn nd-btn-amber" wire:click="openUserModal">
                                            <i class="fas fa-user-plus"></i> Assign Users
                                        </button>
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

    {{-- â•â•â•â•â•â•â•â•â•â•â• ATTACH PERMISSIONS MODAL â•â•â•â•â•â•â•â•â•â•â• --}}
    @if($showPermModal)
    <div class="nd-overlay" wire:click.self="closePermModal">
        <div class="nd-modal rs-modal-md">
            <div class="nd-modal-head">
                <h5><i class="fas fa-key"></i> Attach Permissions</h5>
                <button class="nd-modal-close" wire:click="closePermModal">&times;</button>
            </div>
            <div class="nd-modal-body">
                <div style="position:relative;">
                    <i class="fas fa-search" style="position:absolute;left:.75rem;top:50%;transform:translateY(-50%);color:var(--nd-faint);font-size:.78rem;"></i>
                    <input type="text" wire:model.debounce.300ms="permSearch"
                           class="rs-modal-search" placeholder="Search permissions by name or groupâ€¦">
                </div>

                <div class="rs-modal-list">
                    @php $groupedAvail = $availablePerms->groupBy('group'); @endphp
                    @forelse($groupedAvail as $group => $perms)
                        <div class="rs-modal-group-head">
                            <i class="fas fa-folder-open mr-1"></i> {{ $group ?: 'General' }}
                        </div>
                        @foreach($perms as $perm)
                            <label class="rs-modal-item {{ in_array($perm->id, $selectedPermIds) ? 'selected' : '' }}">
                                <input type="checkbox" value="{{ $perm->id }}" wire:model="selectedPermIds">
                                <div>
                                    <div class="rs-modal-item-name">{{ $perm->name }}</div>
                                    @if($perm->description)
                                        <div class="rs-modal-item-sub">{{ $perm->description }}</div>
                                    @endif
                                </div>
                            </label>
                        @endforeach
                    @empty
                        <div style="text-align:center;color:var(--nd-faint);padding:2rem;font-size:.82rem;">
                            @if($permSearch)
                                No matching permissions found.
                            @else
                                All permissions are already attached.
                            @endif
                        </div>
                    @endforelse
                </div>

                @if(count($selectedPermIds) > 0)
                    <div style="margin-top:.5rem;font-size:.78rem;color:#065f46;font-weight:600;">
                        <i class="fas fa-check-circle mr-1"></i> {{ count($selectedPermIds) }} selected
                    </div>
                @endif
            </div>
            <div class="nd-modal-foot">
                <button class="nd-btn nd-btn-outline" wire:click="closePermModal">Cancel</button>
                <button class="nd-btn nd-btn-amber" wire:click="attachPermissions" @if(empty($selectedPermIds)) disabled @endif>
                    <span wire:loading wire:target="attachPermissions" class="spinner-border spinner-border-sm" role="status"></span>
                    <i wire:loading.remove wire:target="attachPermissions" class="fas fa-link"></i> Attach Selected
                </button>
            </div>
        </div>
    </div>
    @endif

    {{-- â•â•â•â•â•â•â•â•â•â•â• ASSIGN USERS MODAL â•â•â•â•â•â•â•â•â•â•â• --}}
    @if($showUserModal)
    <div class="nd-overlay" wire:click.self="closeUserModal">
        <div class="nd-modal rs-modal-md">
            <div class="nd-modal-head">
                <h5><i class="fas fa-user-plus"></i> Assign Users to "{{ $role->name }}"</h5>
                <button class="nd-modal-close" wire:click="closeUserModal">&times;</button>
            </div>
            <div class="nd-modal-body">
                <div style="position:relative;">
                    <i class="fas fa-search" style="position:absolute;left:.75rem;top:50%;transform:translateY(-50%);color:var(--nd-faint);font-size:.78rem;"></i>
                    <input type="text" wire:model.debounce.300ms="userSearch"
                           class="rs-modal-search" placeholder="Search users by name, email, or staff noâ€¦">
                </div>

                <div class="rs-modal-list">
                    @forelse($availableUsers as $user)
                        <label class="rs-modal-item {{ in_array($user->id, $selectedUserIds) ? 'selected' : '' }}">
                            <input type="checkbox" value="{{ $user->id }}" wire:model="selectedUserIds">
                            <div class="nd-avatar" style="width:30px;height:30px;font-size:.65rem;">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                            <div style="flex:1;min-width:0;">
                                <div class="rs-modal-item-name">{{ $user->name }}</div>
                                <div class="rs-modal-item-sub">
                                    {{ $user->email }}
                                    @if($user->username) &middot; {{ $user->username }} @endif
                                    @if($user->job_title) &middot; {{ $user->job_title }} @endif
                                </div>
                            </div>
                        </label>
                    @empty
                        <div style="text-align:center;color:var(--nd-faint);padding:2rem;font-size:.82rem;">
                            @if($userSearch)
                                No matching users found.
                            @else
                                All users already have this role.
                            @endif
                        </div>
                    @endforelse
                </div>

                @if(count($selectedUserIds) > 0)
                    <div style="margin-top:.5rem;font-size:.78rem;color:#065f46;font-weight:600;">
                        <i class="fas fa-check-circle mr-1"></i> {{ count($selectedUserIds) }} user(s) selected
                    </div>
                @endif
            </div>
            <div class="nd-modal-foot">
                <button class="nd-btn nd-btn-outline" wire:click="closeUserModal">Cancel</button>
                <button class="nd-btn nd-btn-amber" wire:click="attachUsers" @if(empty($selectedUserIds)) disabled @endif>
                    <span wire:loading wire:target="attachUsers" class="spinner-border spinner-border-sm" role="status"></span>
                    <i wire:loading.remove wire:target="attachUsers" class="fas fa-user-check"></i> Assign Selected
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
@else
    @include('livewire.partials.unauthorized')
@endcan
</div>
