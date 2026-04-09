<div>

@can('manage-roles')
<div class="nd-page">
    {{-- â•â•â•â•â•â•â•â•â•â•â• HERO â•â•â•â•â•â•â•â•â•â•â• --}}
    <div class="nd-hero">
        <div class="nd-hero-inner">
            <ul class="nd-breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="sep">/</li>
                <li class="active">Roles</li>
            </ul>
            <div class="nd-hero-row">
                <div class="nd-hero-title">
                    <h1><i class="fas fa-user-shield"></i>Roles Management</h1>
                    <p class="nd-hero-sub">Manage user roles and their permission assignments</p>
                </div>
                <button class="nd-hero-btn" wire:click="$set('showCreateModal', true)">
                    <i class="fas fa-plus"></i> New Role
                </button>
            </div>
        </div>
    </div>

    {{-- â•â•â•â•â•â•â•â•â•â•â• CONTENT â•â•â•â•â•â•â•â•â•â•â• --}}
    <div class="nd-content">
        {{-- Alerts --}}
        @if(session()->has('message'))
            <div class="rl-alert rl-alert-success">
                <i class="fas fa-check-circle"></i> {{ session('message') }}
            </div>
        @endif
        @if($errors->any())
            <div class="rl-alert rl-alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <div>@foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>
            </div>
        @endif

        {{-- Main Card --}}
        <div class="nd-card">
            <div class="nd-card-header">
                <h3><i class="fas fa-shield-alt"></i> All Roles</h3>
                <div class="nd-toolbar">
                    <div class="nd-search">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search roles..." wire:model.debounce.300ms="search">
                    </div>
                </div>
            </div>

            <div style="overflow-x:auto;">
                <table class="nd-table">
                    <thead>
                        <tr>
                            <th style="width:40px;">#</th>
                            <th>Role Name</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th style="text-align:center;">Permissions</th>
                            <th style="text-align:center;">Users</th>
                            <th style="text-align:center;width:160px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roles as $key => $role)
                            <tr>
                                <td style="color:var(--nd-faint);">{{ $roles->firstItem() + $key }}</td>
                                <td><strong>{{ $role->name }}</strong></td>
                                <td><span class="rl-slug">{{ $role->slug }}</span></td>
                                <td><span class="rl-desc">{{ $role->description ?? 'â€”' }}</span></td>
                                <td style="text-align:center;">
                                    <span class="nd-badge rl-badge-perm">{{ $role->permissions_count }}</span>
                                </td>
                                <td style="text-align:center;">
                                    <span class="nd-badge rl-badge-user">{{ $role->users_count }}</span>
                                </td>
                                <td>
                                    <div class="rl-actions" style="justify-content:center;">
                                        <a href="{{ route('roles.show', $role->id) }}" class="rl-act rl-act-view" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button class="rl-act rl-act-perm" wire:click="openPermissions({{ $role->id }})" title="Manage Permissions">
                                            <i class="fas fa-key"></i>
                                        </button>
                                        <button class="rl-act rl-act-edit" wire:click="openEdit({{ $role->id }})" title="Edit">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button class="rl-act rl-act-delete" wire:click="confirmDelete({{ $role->id }})" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="nd-empty">
                                        <i class="fas fa-user-shield"></i>
                                        <p style="margin:0;">No roles found. Create one to get started.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($roles->hasPages())
                <div class="nd-footer">
                    <span>Showing {{ $roles->firstItem() }}â€“{{ $roles->lastItem() }} of {{ $roles->total() }}</span>
                    {{ $roles->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- â•â•â•â•â•â•â•â•â•â•â• CREATE MODAL â•â•â•â•â•â•â•â•â•â•â• --}}
    @if($showCreateModal ?? false)
    <div class="nd-overlay" wire:click.self="$set('showCreateModal', false)">
        <div class="nd-modal rl-modal-md">
            <div class="nd-modal-head">
                <h5><i class="fas fa-plus"></i> Create Role</h5>
                <button class="nd-modal-close" wire:click="$set('showCreateModal', false)">&times;</button>
            </div>
            <form wire:submit.prevent="create">
                <div class="nd-modal-body">
                    <div class="rl-form-group">
                        <label class="rl-label">Role Name <span class="req">*</span></label>
                        <input type="text" class="rl-input @error('name') is-invalid @enderror"
                               wire:model.defer="name" placeholder="e.g. Admin, Editor, Viewer">
                        @error('name') <div class="rl-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="rl-form-group">
                        <label class="rl-label">Description</label>
                        <textarea class="rl-textarea @error('description') is-invalid @enderror"
                                  wire:model.defer="description" rows="3" placeholder="Brief description of this role..."></textarea>
                        @error('description') <div class="rl-error">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="nd-modal-foot">
                    <button type="button" class="nd-btn-cancel" wire:click="$set('showCreateModal', false)">Cancel</button>
                    <button type="submit" class="rl-btn-save"><i class="fas fa-save mr-1"></i> Create</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- â•â•â•â•â•â•â•â•â•â•â• EDIT MODAL â•â•â•â•â•â•â•â•â•â•â• --}}
    @if($editId)
    <div class="nd-overlay" wire:click.self="$set('editId', null)">
        <div class="nd-modal rl-modal-md">
            <div class="nd-modal-head">
                <h5><i class="fas fa-pen"></i> Edit Role</h5>
                <button class="nd-modal-close" wire:click="$set('editId', null)">&times;</button>
            </div>
            <form wire:submit.prevent="update">
                <div class="nd-modal-body">
                    <div class="rl-form-group">
                        <label class="rl-label">Role Name <span class="req">*</span></label>
                        <input type="text" class="rl-input @error('editName') is-invalid @enderror" wire:model.defer="editName">
                        @error('editName') <div class="rl-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="rl-form-group">
                        <label class="rl-label">Description</label>
                        <textarea class="rl-textarea @error('editDescription') is-invalid @enderror"
                                  wire:model.defer="editDescription" rows="3"></textarea>
                        @error('editDescription') <div class="rl-error">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="nd-modal-foot">
                    <button type="button" class="nd-btn-cancel" wire:click="$set('editId', null)">Cancel</button>
                    <button type="submit" class="rl-btn-save"><i class="fas fa-save mr-1"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- â•â•â•â•â•â•â•â•â•â•â• DELETE MODAL â•â•â•â•â•â•â•â•â•â•â• --}}
    @if($deleteId)
    <div class="nd-overlay" wire:click.self="$set('deleteId', null)">
        <div class="nd-modal rl-modal-sm">
            <div class="nd-modal-head nd-modal-head-danger">
                <h5><i class="fas fa-exclamation-triangle"></i> Confirm Delete</h5>
                <button class="nd-modal-close" wire:click="$set('deleteId', null)">&times;</button>
            </div>
            <div class="nd-modal-body" style="text-align:center;">
                <div style="width:56px;height:56px;border-radius:50%;background:#fef2f2;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                    <i class="fas fa-trash-alt" style="font-size:1.3rem;color:var(--nd-red);"></i>
                </div>
                <p style="margin:0 0 .35rem;color:var(--nd-text);">Are you sure you want to delete the role:</p>
                <p style="font-weight:800;color:var(--nd-red);font-size:1.05rem;margin:0 0 .5rem;">{{ $deleteName }}</p>
                <p style="font-size:.82rem;color:var(--nd-muted);margin:0;">This will remove the role from all users and detach all permissions.</p>
            </div>
            <div class="nd-modal-foot" style="justify-content:center;">
                <button class="nd-btn-cancel" wire:click="$set('deleteId', null)">Cancel</button>
                <button class="nd-btn-danger" wire:click="delete"><i class="fas fa-trash-alt mr-1"></i> Delete</button>
            </div>
        </div>
    </div>
    @endif

    {{-- â•â•â•â•â•â•â•â•â•â•â• PERMISSIONS MODAL â•â•â•â•â•â•â•â•â•â•â• --}}
    @if($permRoleId)
    <div class="nd-overlay" wire:click.self="$set('permRoleId', null)">
        <div class="nd-modal rl-modal-lg">
            <div class="nd-modal-head nd-modal-head-amber">
                <h5><i class="fas fa-key"></i> Manage Permissions â€” {{ $editName }}</h5>
                <button class="nd-modal-close" wire:click="$set('permRoleId', null)">&times;</button>
            </div>
            <div class="nd-modal-body" style="max-height:450px;overflow-y:auto;">
                @php $grouped = collect($availablePermissions)->groupBy('group'); @endphp
                @forelse($grouped as $group => $perms)
                    <div class="rl-perm-group-header">
                        <i class="fas fa-folder-open mr-1"></i> {{ $group ?: 'General' }}
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:0;">
                        @foreach($perms as $perm)
                            <label class="rl-perm-item {{ in_array($perm['id'], $selectedPermissions) ? 'selected' : '' }}">
                                <input type="checkbox" value="{{ $perm['id'] }}" wire:model="selectedPermissions"
                                       style="accent-color:var(--nd-amber);width:16px;height:16px;">
                                <span style="font-size:.82rem;font-weight:600;">{{ $perm['name'] }}</span>
                            </label>
                        @endforeach
                    </div>
                @empty
                    <div style="text-align:center;color:var(--nd-faint);padding:2rem;">
                        <i class="fas fa-info-circle" style="font-size:1.5rem;display:block;margin-bottom:.5rem;"></i>
                        No permissions available. Create some permissions first.
                    </div>
                @endforelse
            </div>
            <div class="nd-modal-foot">
                <span style="font-size:.78rem;color:var(--nd-muted);margin-right:auto;">
                    {{ count($selectedPermissions) }} permission(s) selected
                </span>
                <button class="nd-btn-cancel" wire:click="$set('permRoleId', null)">Cancel</button>
                <button class="rl-btn-save" wire:click="syncPermissions">
                    <i class="fas fa-sync mr-1"></i> Save Permissions
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
