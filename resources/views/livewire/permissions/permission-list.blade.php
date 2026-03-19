<div>
    <div class="container-fluid">
        <br>
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="text-green font-weight-bold mb-0">
                    <i class="fas fa-key mr-2"></i>Permissions Management
                </h2>
                <small class="text-muted">Create and manage system permissions</small>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Permissions</li>
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

        {{-- Main Card --}}
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex align-items-center">
                    <button class="btn btn-sm btn-success mr-2" data-toggle="modal" data-target="#createPermissionModal">
                        <i class="fas fa-plus mr-1"></i> New Permission
                    </button>
                    <div class="input-group input-group-sm" style="width: 250px;">
                        <input type="text" class="form-control" placeholder="Search permissions..." wire:model.debounce.300ms="search">
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
                            <th>Group</th>
                            <th>Description</th>
                            <th class="text-center">Used by Roles</th>
                            <th class="text-center" style="width: 140px;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($permissions as $key => $perm)
                            <tr>
                                <td>{{ $permissions->firstItem() + $key }}</td>
                                <td><strong>{{ $perm->name }}</strong></td>
                                <td><code>{{ $perm->slug }}</code></td>
                                <td>
                                    @if($perm->group)
                                        <span class="badge badge-pill badge-light border">{{ $perm->group }}</span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>{{ Str::limit($perm->description, 40) ?? '-' }}</td>
                                <td class="text-center">
                                    <span class="badge badge-pill badge-info">{{ $perm->roles_count }}</span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-xs btn-outline-primary" wire:click="openEdit({{ $perm->id }})" data-toggle="modal" data-target="#editPermissionModal" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-xs btn-outline-danger" wire:click="confirmDelete({{ $perm->id }})" data-toggle="modal" data-target="#deletePermissionModal" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                    No permissions found. Create one to get started.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($permissions->hasPages())
                <div class="card-footer bg-white">
                    {{ $permissions->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- ==================== CREATE MODAL ==================== --}}
    <div class="modal fade" id="createPermissionModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="fas fa-plus mr-1"></i> Create Permission</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form wire:submit.prevent="create">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Permission Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   wire:model.defer="name" placeholder="e.g. create-ipp, edit-user, view-reports">
                            @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Group</label>
                            <select class="form-control @error('group') is-invalid @enderror" wire:model.defer="group">
                                <option value="">Select a group...</option>
                                @foreach($groups as $g)
                                    <option value="{{ $g }}">{{ $g }}</option>
                                @endforeach
                            </select>
                            @error('group') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-0">
                            <label>Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      wire:model.defer="description" rows="2" placeholder="What does this permission allow?"></textarea>
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
    <div class="modal fade" id="editPermissionModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-edit mr-1"></i> Edit Permission</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form wire:submit.prevent="update">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Permission Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('editName') is-invalid @enderror" wire:model.defer="editName">
                            @error('editName') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label>Group</label>
                            <select class="form-control @error('editGroup') is-invalid @enderror" wire:model.defer="editGroup">
                                <option value="">Select a group...</option>
                                @foreach($groups as $g)
                                    <option value="{{ $g }}">{{ $g }}</option>
                                @endforeach
                            </select>
                            @error('editGroup') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-0">
                            <label>Description</label>
                            <textarea class="form-control @error('editDescription') is-invalid @enderror" wire:model.defer="editDescription" rows="2"></textarea>
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
    <div class="modal fade" id="deletePermissionModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"><i class="fas fa-exclamation-triangle mr-1"></i> Confirm Delete</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body text-center">
                    <p>Are you sure you want to delete:</p>
                    <h5 class="font-weight-bold text-danger">{{ $deleteName }}</h5>
                    <small class="text-muted">This will remove it from all roles.</small>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="delete"><i class="fas fa-trash mr-1"></i> Delete</button>
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
