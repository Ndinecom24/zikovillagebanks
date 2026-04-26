<div>

@can('manage-roles')
<div class="nd-page">
    {{-- â•â•â•â•â•â•â•â•â•â•â• HERO â•â•â•â•â•â•â•â•â•â•â• --}}
    <div class="nd-hero">
        <div class="nd-hero-inner">
            <ul class="nd-breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="sep">/</li>
                <li><a href="{{ route('roles.index') }}">Access Control</a></li>
                <li class="sep">/</li>
                <li class="active">Permissions</li>
            </ul>
            <div class="nd-hero-row">
                <div class="nd-hero-title">
                    <h1><i class="fas fa-key"></i>Permissions Management</h1>
                    <p class="nd-hero-sub">Create and manage system permissions for role-based access control</p>
                </div>
                <button class="nd-hero-btn" wire:click="$set('showCreateModal', true)">
                    <i class="fas fa-plus"></i> New Permission
                </button>
            </div>
        </div>
    </div>

    {{-- â•â•â•â•â•â•â•â•â•â•â• CONTENT â•â•â•â•â•â•â•â•â•â•â• --}}
    <div class="nd-content">
        {{-- Alerts --}}
        @if(session()->has('message'))
            <div class="pm-alert pm-alert-success">
                <i class="fas fa-check-circle"></i> {{ session('message') }}
            </div>
        @endif
        @if($errors->any())
            <div class="pm-alert pm-alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <div>
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Main Card --}}
        <div class="nd-card">
            <div class="nd-card-header">
                <h3><i class="fas fa-list-ul"></i> All Permissions</h3>
                <div class="nd-toolbar">
                    <div class="nd-search">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search permissions..." wire:model.live.debounce.300ms="search">
                    </div>
                </div>
            </div>

            <div style="overflow-x:auto;">
                <table class="nd-table">
                    <thead>
                        <tr>
                            <th style="width:40px;">#</th>
                            <th>Permission Name</th>
                            <th>Slug</th>
                            <th>Group</th>
                            <th>Description</th>
                            <th style="text-align:center;">Used by Roles</th>
                            <th style="text-align:center;width:100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permissions as $key => $perm)
                            <tr>
                                <td style="color:var(--nd-faint);">{{ $permissions->firstItem() + $key }}</td>
                                <td><strong>{{ $perm->name }}</strong></td>
                                <td><span class="pm-slug">{{ $perm->slug }}</span></td>
                                <td>
                                    @if($perm->group)
                                        <span class="nd-badge pm-badge-group">{{ $perm->group }}</span>
                                    @else
                                        <span style="color:var(--nd-faint);">â€”</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="pm-desc">{{ $perm->description ?? 'â€”' }}</span>
                                </td>
                                <td style="text-align:center;">
                                    <span class="nd-badge pm-badge-count">{{ $perm->roles_count }}</span>
                                </td>
                                <td>
                                    <div class="pm-actions" style="justify-content:center;">
                                        <button class="pm-act pm-act-edit" wire:click="openEdit({{ $perm->id }})" title="Edit">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button class="pm-act pm-act-delete" wire:click="confirmDelete({{ $perm->id }})" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="nd-empty">
                                        <i class="fas fa-key"></i>
                                        <p style="margin:0;">No permissions found. Create one to get started.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($permissions->hasPages())
                <div class="nd-footer">
                    <span>Showing {{ $permissions->firstItem() }}â€“{{ $permissions->lastItem() }} of {{ $permissions->total() }}</span>
                    {{ $permissions->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- â•â•â•â•â•â•â•â•â•â•â• CREATE MODAL â•â•â•â•â•â•â•â•â•â•â• --}}
    @if($showCreateModal ?? false)
    <div class="nd-overlay" wire:click.self="$set('showCreateModal', false)">
        <div class="nd-modal pm-modal-md">
            <div class="nd-modal-head">
                <h5><i class="fas fa-plus"></i> Create Permission</h5>
                <button class="nd-modal-close" wire:click="$set('showCreateModal', false)">&times;</button>
            </div>
            <form wire:submit.prevent="create">
                <div class="nd-modal-body">
                    <div class="pm-form-group">
                        <label class="pm-label">Permission Name <span class="req">*</span></label>
                        <input type="text" class="pm-input @error('name') is-invalid @enderror"
                               wire:model="name" placeholder="e.g. create-ipp, edit-user, view-reports">
                        @error('name') <div class="pm-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="pm-form-group">
                        <label class="pm-label">Group</label>
                        <select class="nd-select @error('group') is-invalid @enderror" wire:model.live="group">
                            <option value="">Select a group...</option>
                            @foreach($groups as $g)
                                <option value="{{ $g }}">{{ $g }}</option>
                            @endforeach
                        </select>
                        @error('group') <div class="pm-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="pm-form-group">
                        <label class="pm-label">Description</label>
                        <textarea class="pm-textarea @error('description') is-invalid @enderror"
                                  wire:model="description" rows="2" placeholder="What does this permission allow?"></textarea>
                        @error('description') <div class="pm-error">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="nd-modal-foot">
                    <button type="button" class="nd-btn-cancel" wire:click="$set('showCreateModal', false)">Cancel</button>
                    <button type="submit" class="pm-btn-save"><i class="fas fa-save mr-1"></i> Create</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- â•â•â•â•â•â•â•â•â•â•â• EDIT MODAL â•â•â•â•â•â•â•â•â•â•â• --}}
    @if($editId)
    <div class="nd-overlay" wire:click.self="$set('editId', null)">
        <div class="nd-modal pm-modal-md">
            <div class="nd-modal-head">
                <h5><i class="fas fa-pen"></i> Edit Permission</h5>
                <button class="nd-modal-close" wire:click="$set('editId', null)">&times;</button>
            </div>
            <form wire:submit.prevent="update">
                <div class="nd-modal-body">
                    <div class="pm-form-group">
                        <label class="pm-label">Permission Name <span class="req">*</span></label>
                        <input type="text" class="pm-input @error('editName') is-invalid @enderror" wire:model="editName">
                        @error('editName') <div class="pm-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="pm-form-group">
                        <label class="pm-label">Group</label>
                        <select class="nd-select @error('editGroup') is-invalid @enderror" wire:model.live="editGroup">
                            <option value="">Select a group...</option>
                            @foreach($groups as $g)
                                <option value="{{ $g }}">{{ $g }}</option>
                            @endforeach
                        </select>
                        @error('editGroup') <div class="pm-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="pm-form-group">
                        <label class="pm-label">Description</label>
                        <textarea class="pm-textarea @error('editDescription') is-invalid @enderror"
                                  wire:model="editDescription" rows="2"></textarea>
                        @error('editDescription') <div class="pm-error">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="nd-modal-foot">
                    <button type="button" class="nd-btn-cancel" wire:click="$set('editId', null)">Cancel</button>
                    <button type="submit" class="pm-btn-save"><i class="fas fa-save mr-1"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- â•â•â•â•â•â•â•â•â•â•â• DELETE MODAL â•â•â•â•â•â•â•â•â•â•â• --}}
    @if($deleteId)
    <div class="nd-overlay" wire:click.self="$set('deleteId', null)">
        <div class="nd-modal pm-modal-sm">
            <div class="nd-modal-head nd-modal-head-danger">
                <h5><i class="fas fa-exclamation-triangle"></i> Confirm Delete</h5>
                <button class="nd-modal-close" wire:click="$set('deleteId', null)">&times;</button>
            </div>
            <div class="nd-modal-body" style="text-align:center;">
                <div style="width:56px;height:56px;border-radius:50%;background:#fef2f2;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                    <i class="fas fa-trash-alt" style="font-size:1.3rem;color:var(--nd-red);"></i>
                </div>
                <p style="margin:0 0 .35rem;color:var(--nd-text);">Are you sure you want to delete:</p>
                <p style="font-weight:800;color:var(--nd-red);font-size:1.05rem;margin:0 0 .5rem;">{{ $deleteName }}</p>
                <p style="font-size:.82rem;color:var(--nd-muted);margin:0;">This will remove it from all roles.</p>
            </div>
            <div class="nd-modal-foot" style="justify-content:center;">
                <button class="nd-btn-cancel" wire:click="$set('deleteId', null)">Cancel</button>
                <button class="nd-btn-danger" wire:click="delete"><i class="fas fa-trash-alt mr-1"></i> Delete</button>
            </div>
        </div>
    </div>
    @endif
</div>
@else
    @include('livewire.partials.unauthorized')
@endcan
</div>
