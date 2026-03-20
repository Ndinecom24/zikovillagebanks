<div>
    <div class="container-fluid">
        <br>
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="text-green font-weight-bold mb-0">
                    <i class="fas fa-user-shield mr-2"></i>Roles Management
                </h2>
                <small class="text-muted">Manage user roles and their permissions</small>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Roles</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        {{-- Alerts --}}
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-1"></i> {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        @endif

        {{-- Show Role Details Panel --}}
        @if($showRole)
            <div class="card border-left-success shadow-sm mb-3">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 font-weight-bold"><i class="fas fa-eye mr-2 text-success"></i>Role: {{ $showRole->name }}</h5>
                    <button class="btn btn-sm btn-outline-secondary" wire:click="closeShow"><i class="fas fa-times"></i></button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p class="mb-1"><strong>Name:</strong></p>
                            <p>{{ $showRole->name }}</p>
                            <p class="mb-1"><strong>Slug:</strong></p>
                            <p><code>{{ $showRole->slug }}</code></p>
                            <p class="mb-1"><strong>Description:</strong></p>
                            <p>{{ $showRole->description ?? 'N/A' }}</p>
                            <p class="mb-1"><strong>Created:</strong></p>
                            <p>{{ $showRole->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-2"><strong>Permissions ({{ count($showPermissions) }}):</strong></p>
                            @forelse($showPermissions as $perm)
                                <span class="badge badge-success mr-1 mb-1" style="font-size: 0.8rem;">{{ $perm }}</span>
                            @empty
                                <span class="text-muted">No permissions assigned</span>
                            @endforelse
                        </div>
                        <div class="col-md-4">
                            <p class="mb-2"><strong>Users ({{ $showRole->users->count() }}):</strong></p>
                            @forelse($showRole->users as $user)
                                <span class="badge badge-info mr-1 mb-1" style="font-size: 0.8rem;">{{ $user->name }}</span>
                            @empty
                                <span class="text-muted">No users assigned</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Main Card --}}
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex align-items-center">
                    <button class="btn btn-sm btn-success mr-2" data-toggle="modal" data-target="#createRoleModal">
                        <i class="fas fa-plus mr-1"></i> New Role
                    </button>
                    <div class="input-group input-group-sm" style="width: 250px;">
                        <input type="text" class="form-control" placeholder="Search roles..." wire:model.debounce.300ms="search">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                        <tr>
                            <th style="width: 40px;">#</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th class="text-center">Permissions</th>
                            <th class="text-center">Users</th>
                            <th class="text-center" style="width: 220px;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($roles as $key => $role)
                            <tr>
                                <td>{{ $roles->firstItem() + $key }}</td>
                                <td><strong>{{ $role->name }}</strong></td>
                                <td><code>{{ $role->slug }}</code></td>
                                <td>{{ Str::limit($role->description, 50) ?? '-' }}</td>
                                <td class="text-center">
                                    <span class="badge badge-pill badge-success">{{ $role->permissions_count }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-pill badge-info">{{ $role->users_count }}</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('roles.show', $role->id) }}" class="btn btn-xs btn-outline-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button class="btn btn-xs btn-outline-warning" wire:click="openPermissions({{ $role->id }})" data-toggle="modal" data-target="#permissionsModal" title="Permissions">
                                        <i class="fas fa-key"></i>
                                    </button>
                                    <button class="btn btn-xs btn-outline-primary" wire:click="openEdit({{ $role->id }})" data-toggle="modal" data-target="#editRoleModal" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-xs btn-outline-danger" wire:click="confirmDelete({{ $role->id }})" data-toggle="modal" data-target="#deleteRoleModal" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                    No roles found. Create one to get started.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($roles->hasPages())
                <div class="card-footer bg-white">
                    {{ $roles->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- ==================== CREATE MODAL ==================== --}}
    <div class="modal fade" id="createRoleModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="fas fa-plus mr-1"></i> Create Role</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form wire:submit.prevent="create">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Role Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model.defer="name" placeholder="e.g. Admin, Editor, Viewer">
                            @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-0">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" wire:model.defer="description" rows="3" placeholder="Brief description of this role..."></textarea>
                            @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save mr-1"></i> Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ==================== EDIT MODAL ==================== --}}
    <div class="modal fade" id="editRoleModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-edit mr-1"></i> Edit Role</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form wire:submit.prevent="update">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Role Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('editName') is-invalid @enderror" wire:model.defer="editName">
                            @error('editName') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-0">
                            <label>Description</label>
                            <textarea class="form-control @error('editDescription') is-invalid @enderror" wire:model.defer="editDescription" rows="3"></textarea>
                            @error('editDescription') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ==================== DELETE MODAL ==================== --}}
    <div class="modal fade" id="deleteRoleModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"><i class="fas fa-exclamation-triangle mr-1"></i> Confirm Delete</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body text-center">
                    <p>Are you sure you want to delete the role:</p>
                    <h5 class="font-weight-bold text-danger">{{ $deleteName }}</h5>
                    <small class="text-muted">This will remove the role from all users and detach all permissions.</small>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="delete"><i class="fas fa-trash mr-1"></i> Delete</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ==================== PERMISSIONS MODAL ==================== --}}
    <div class="modal fade" id="permissionsModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title"><i class="fas fa-key mr-1"></i> Manage Permissions — {{ $editName }}</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body" style="max-height: 450px; overflow-y: auto;">
                    @php
                        $grouped = collect($availablePermissions)->groupBy('group');
                    @endphp
                    @forelse($grouped as $group => $perms)
                        <h6 class="font-weight-bold text-uppercase text-muted mt-3 mb-2">
                            <i class="fas fa-folder-open mr-1"></i> {{ $group ?: 'General' }}
                        </h6>
                        <div class="row">
                            @foreach($perms as $perm)
                                <div class="col-md-6 col-lg-4 mb-2">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input"
                                               id="perm_{{ $perm['id'] }}"
                                               value="{{ $perm['id'] }}"
                                               wire:model="selectedPermissions">
                                        <label class="custom-control-label" for="perm_{{ $perm['id'] }}">
                                            {{ $perm['name'] }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @empty
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-info-circle fa-2x mb-2 d-block"></i>
                            No permissions available. Create some permissions first.
                        </div>
                    @endforelse
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-warning" wire:click="syncPermissions">
                        <i class="fas fa-sync mr-1"></i> Save Permissions
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Close modals on Livewire event --}}
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('closeModal', function (modalId) {
                $('#' + modalId).modal('hide');
            });
        });
    </script>
</div>
