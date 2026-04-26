<div>

@can('view-users')
<div class="nd-page">
    {{-- â•â•â•â•â•â•â•â•â•â•â• HERO â•â•â•â•â•â•â•â•â•â•â• --}}
    <div class="nd-hero">
        <div class="nd-hero-inner">
            <ul class="nd-breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="sep">/</li>
                <li class="active">User Management</li>
            </ul>
            <div class="nd-hero-row">
                <div class="nd-hero-title">
                    <h1><i class="fas fa-users"></i>User Management</h1>
                    <p class="nd-hero-sub">Manage system users, accounts and access control</p>
                </div>
                <button wire:click="openCreateModal" class="nd-btn nd-btn-amber">
                    <i class="fas fa-user-plus"></i> Add User
                </button>
            </div>

            <div class="nd-stat-row">
                <div class="nd-stat">
                    <div class="nd-stat-val">{{ $users->total() }}</div>
                    <div class="nd-stat-label">Total Users</div>
                </div>
                <div class="nd-stat">
                    <div class="nd-stat-val" style="color:#60a5fa;">{{ $users->count() }}</div>
                    <div class="nd-stat-label">On This Page</div>
                </div>
                <div class="nd-stat">
                    <div class="nd-stat-val" style="color:#34d399;">{{ $users->where('roles_count', '>', 0)->count() }}</div>
                    <div class="nd-stat-label">With Roles</div>
                </div>
                <div class="nd-stat">
                    <div class="nd-stat-val" style="color:#fbbf24;">{{ $perPage }}</div>
                    <div class="nd-stat-label">Per Page</div>
                </div>
            </div>
        </div>
    </div>

    {{-- â•â•â•â•â•â•â•â•â•â•â• CONTENT â•â•â•â•â•â•â•â•â•â•â• --}}
    <div class="nd-content">

        {{-- Flash --}}
        @if(session()->has('message'))
            <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;padding:.65rem 1rem;margin-bottom:1rem;display:flex;align-items:center;gap:.5rem;font-size:.85rem;color:#166534;">
                <i class="fas fa-check-circle"></i> {{ session('message') }}
            </div>
        @endif

        <div class="nd-card">
            <div class="nd-card-header">
                <h3><i class="fas fa-list"></i> All Users</h3>
                <div class="nd-toolbar">
                    <div class="nd-search">
                        <i class="fas fa-search"></i>
                        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search users...">
                    </div>
                    <select wire:model.live="perPage" class="nd-select">
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                </div>
            </div>

            <div style="overflow-x:auto;">
                <table class="nd-table">
                    <thead>
                        <tr>
                            <th style="width:46px;cursor:default;"></th>
                            <th wire:click="sortBy('username')">
                                Username
                                <i class="fas fa-sort{{ $sortField === 'username' ? ($sortDirection === 'asc' ? '-up' : '-down') : '' }} nd-sort {{ $sortField === 'username' ? 'active' : '' }}"></i>
                            </th>
                            <th wire:click="sortBy('name')">
                                Name
                                <i class="fas fa-sort{{ $sortField === 'name' ? ($sortDirection === 'asc' ? '-up' : '-down') : '' }} nd-sort {{ $sortField === 'name' ? 'active' : '' }}"></i>
                            </th>
                            <th wire:click="sortBy('email')">
                                Email
                                <i class="fas fa-sort{{ $sortField === 'email' ? ($sortDirection === 'asc' ? '-up' : '-down') : '' }} nd-sort {{ $sortField === 'email' ? 'active' : '' }}"></i>
                            </th>
                            <th wire:click="sortBy('job_title')">
                                Job Title
                                <i class="fas fa-sort{{ $sortField === 'job_title' ? ($sortDirection === 'asc' ? '-up' : '-down') : '' }} nd-sort {{ $sortField === 'job_title' ? 'active' : '' }}"></i>
                            </th>
                            <th wire:click="sortBy('total_login')">
                                Logins
                                <i class="fas fa-sort{{ $sortField === 'total_login' ? ($sortDirection === 'asc' ? '-up' : '-down') : '' }} nd-sort {{ $sortField === 'total_login' ? 'active' : '' }}"></i>
                            </th>
                            <th>Roles</th>
                            <th style="width:90px;cursor:default;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $u)
                            <tr>
                                <td>
                                    @if($u->avatar && file_exists(storage_path('app/public/user_avatar/' . $u->avatar)))
                                        <img src="{{ asset('storage/user_avatar/' . $u->avatar) }}" class="nd-avatar" alt="{{ $u->name }}">
                                    @else
                                        @php
                                            $parts = explode(' ', trim($u->name ?? ''));
                                            $initials = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
                                        @endphp
                                        <div class="nd-avatar-init">{{ $initials }}</div>
                                    @endif
                                </td>
                                <td style="font-family:'Courier New',monospace;font-size:.8rem;color:var(--nd-faint);">{{ $u->username ?? 'â€”' }}</td>
                                <td><strong>{{ $u->name ?? 'â€”' }}</strong></td>
                                <td style="font-size:.82rem;">{{ $u->email ?? 'â€”' }}</td>
                                <td style="font-size:.82rem;color:var(--nd-muted);">{{ $u->job_title ?? 'â€”' }}</td>
                                <td>
                                    <span class="nd-badge nd-badge-gray">
                                        <i class="fas fa-sign-in-alt" style="font-size:.55rem;"></i>
                                        {{ $u->total_login ?? 0 }}
                                    </span>
                                </td>
                                <td>
                                    @if($u->roles_count > 0)
                                        <span class="nd-badge nd-badge-amber">
                                            <i class="fas fa-shield-alt" style="font-size:.55rem;"></i>
                                            {{ $u->roles_count }}
                                        </span>
                                    @else
                                        <span style="color:#d1d5db;font-size:.8rem;">â€”</span>
                                    @endif
                                </td>
                                <td>
                                    <div style="display:flex;gap:4px;">
                                        <a href="{{ route('users.show', $u->id) }}" class="nd-action" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button wire:click="confirmDelete({{ $u->id }})" class="nd-action nd-action-danger" title="Delete">
                                            <span wire:loading wire:target="confirmDelete({{ $u->id }})" class="spinner-border spinner-border-sm" role="status" style="width:12px;height:12px;"></span>
                                            <i wire:loading.remove wire:target="confirmDelete({{ $u->id }})" class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="nd-empty">
                                        <i class="fas fa-users"></i>
                                        <p style="margin:0;">No users found.
                                            @if($search)
                                                Try a different search term.
                                            @endif
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
                <div class="nd-footer">
                    <span>Showing {{ $users->firstItem() ?? 0 }}â€“{{ $users->lastItem() ?? 0 }} of {{ $users->total() }}</span>
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- â•â•â•â•â•â•â•â•â•â•â• CREATE USER MODAL â•â•â•â•â•â•â•â•â•â•â• --}}
    @if($showCreateModal)
    <div class="nd-overlay" wire:click.self="$set('showCreateModal', false)">
        <div class="nd-modal" style="max-width:700px;">
            <div class="nd-modal-head">
                <h5><i class="fas fa-user-plus"></i> Add New User</h5>
                <button class="nd-modal-close" wire:click="$set('showCreateModal', false)">&times;</button>
            </div>
            <form wire:submit.prevent="createUser">
                <div class="nd-modal-body">
                    @if($errors->any())
                        <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:10px;padding:.5rem .75rem;margin-bottom:.85rem;font-size:.82rem;color:var(--nd-red);">
                            <i class="fas fa-exclamation-circle mr-1"></i> Please fix the errors below.
                        </div>
                    @endif

                    {{-- Staff lookup --}}
                    <div style="display:grid;grid-template-columns:5fr 7fr;gap:.75rem;">
                        <div class="nd-field">
                            <label>Employee Staff No</label>
                            <div style="display:flex;gap:.5rem;">
                                <input type="text" wire:model="staffNo" placeholder="e.g. 12345" style="flex:1;">
                                <button type="button" wire:click.prevent="lookupStaff" class="nd-btn nd-btn-navy" style="padding:.4rem .75rem;white-space:nowrap;" wire:loading.attr="disabled">
                                    <i class="fas fa-search"></i> Lookup
                                </button>
                            </div>
                            @error('staffNo') <div class="err">{{ $message }}</div> @enderror
                        </div>
                        <div class="nd-field">
                            <label>Full Name <span class="req">*</span></label>
                            <input type="text" wire:model="staffName" placeholder="Full name" {{ $staffFound ? 'readonly' : '' }}>
                            @error('staffName') <div class="err">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem;">
                        <div class="nd-field">
                            <label>Job Title</label>
                            <input type="text" wire:model="jobTitle" {{ $staffFound ? 'readonly' : '' }}>
                        </div>
                        <div class="nd-field">
                            <label>Department / Unit</label>
                            <input type="text" wire:model="userUnit" {{ $staffFound ? 'readonly' : '' }}>
                        </div>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:.75rem;">
                        <div class="nd-field">
                            <label>Directorate</label>
                            <input type="text" wire:model="directorate" {{ $staffFound ? 'readonly' : '' }}>
                        </div>
                        <div class="nd-field">
                            <label>Mobile No</label>
                            <input type="text" wire:model="mobileNo" {{ $staffFound ? 'readonly' : '' }}>
                        </div>
                        <div class="nd-field">
                            <label>Email <span class="req">*</span></label>
                            <input type="email" wire:model="staffEmail" placeholder="email@example.com" {{ $staffFound ? 'readonly' : '' }}>
                            @error('staffEmail') <div class="err">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem;">
                        <div class="nd-field">
                            <label>Default Password <span class="req">*</span></label>
                            <input type="password" wire:model="password" placeholder="Strong password">
                            @error('password') <div class="err">{{ $message }}</div> @enderror
                            <div style="font-size:.7rem;color:var(--nd-faint);margin-top:.2rem;">Min 8 chars, upper + lower + number + special</div>
                        </div>
                    </div>
                </div>
                <div class="nd-modal-footer">
                    <button type="button" wire:click="$set('showCreateModal', false)" class="nd-btn nd-btn-light">Cancel</button>
                    <button type="submit" class="nd-btn nd-btn-amber" wire:loading.attr="disabled" wire:target="createUser">
                        <span wire:loading.remove wire:target="createUser"><i class="fas fa-check-circle"></i> Create User</span>
                        <span wire:loading wire:target="createUser"><i class="fas fa-spinner fa-spin"></i> Creating...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- â•â•â•â•â•â•â•â•â•â•â• DELETE CONFIRMATION â•â•â•â•â•â•â•â•â•â•â• --}}
    @if($deleteId)
    <div class="nd-overlay" wire:click.self="$set('deleteId', null)">
        <div class="nd-modal" style="max-width:420px;">
            <div style="padding:2rem;text-align:center;">
                <div class="nd-delete-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h5 style="font-weight:700;margin-bottom:.5rem;color:var(--nd-text);">Delete User?</h5>
                <p style="color:var(--nd-muted);font-size:.9rem;">
                    Are you sure you want to delete <strong>{{ $deleteName }}</strong>? This action cannot be undone.
                </p>
                <div style="display:flex;justify-content:center;gap:.75rem;margin-top:1.5rem;">
                    <button wire:click="$set('deleteId', null)" class="nd-btn nd-btn-light" style="padding:.45rem 1.25rem;">Cancel</button>
                    <button wire:click="deleteUser" class="nd-btn nd-btn-danger" style="padding:.45rem 1.25rem;">
                        <i class="fas fa-trash-alt"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@else
    @include('livewire.partials.unauthorized')
@endcan
</div>
