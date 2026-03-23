<div>
    <div class="container-fluid">
        <br>
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="text-green font-weight-bold mb-0">
                    <i class="fas fa-building mr-2"></i>Office List
                </h2>
                <small class="text-muted">Manage responsible offices</small>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Offices</li>
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
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}
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
                    <button class="btn btn-sm btn-success mr-2" data-toggle="modal" data-target="#createOfficeModal">
                        <i class="fas fa-plus mr-1"></i> New Office
                    </button>
                    <div class="input-group input-group-sm" style="width: 260px;">
                        <input type="text" class="form-control" placeholder="Search offices..." wire:model.debounce.300ms="search">
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
                            <th style="width: 50px;">#</th>
                            <th>Office Name</th>
                            <th>Status</th>
                            <th class="text-center" style="width: 200px;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($offices as $key => $office)
                            <tr>
                                <td>{{ $offices->firstItem() + $key }}</td>
                                <td><strong>{{ $office->responsible_office }}</strong></td>
                                <td>
                                    @if(strtolower($office->office_status) === 'active')
                                        <span class="badge badge-success">{{ $office->office_status }}</span>
                                    @elseif(strtolower($office->office_status) === 'inactive')
                                        <span class="badge badge-secondary">{{ $office->office_status }}</span>
                                    @else
                                        <span class="badge badge-info">{{ $office->office_status ?? '-' }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('office.show', $office->id) }}" class="btn btn-xs btn-outline-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button class="btn btn-xs btn-outline-primary" wire:click="openEdit({{ $office->id }})" data-toggle="modal" data-target="#editOfficeModal" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-xs btn-outline-danger" wire:click="confirmDelete({{ $office->id }})" data-toggle="modal" data-target="#deleteOfficeModal" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                    No offices found. Create one to get started.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if($offices->hasPages())
                <div class="card-footer bg-white">
                    {{ $offices->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- ==================== CREATE MODAL ==================== --}}
    <div class="modal fade" id="createOfficeModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="fas fa-plus mr-1"></i> Create Office</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form wire:submit.prevent="create">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="createOfficeName">Office Name <span class="text-danger">*</span></label>
                            <input type="text" id="createOfficeName" class="form-control @error('officeName') is-invalid @enderror"
                                   wire:model.defer="officeName" placeholder="e.g. Finance, Legal, Engineering">
                            @error('officeName') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-0">
                            <label for="createOfficeStatus">Status <span class="text-danger">*</span></label>
                            <select id="createOfficeStatus" class="form-control @error('officeStatus') is-invalid @enderror" wire:model.defer="officeStatus">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                            @error('officeStatus') <span class="invalid-feedback">{{ $message }}</span> @enderror
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
    <div class="modal fade" id="editOfficeModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-edit mr-1"></i> Edit Office</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form wire:submit.prevent="update">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="editOfficeName">Office Name <span class="text-danger">*</span></label>
                            <input type="text" id="editOfficeName" class="form-control @error('editOfficeName') is-invalid @enderror"
                                   wire:model.defer="editOfficeName">
                            @error('editOfficeName') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-0">
                            <label for="editOfficeStatus">Status <span class="text-danger">*</span></label>
                            <select id="editOfficeStatus" class="form-control @error('editOfficeStatus') is-invalid @enderror" wire:model.defer="editOfficeStatus">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                            @error('editOfficeStatus') <span class="invalid-feedback">{{ $message }}</span> @enderror
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
    <div class="modal fade" id="deleteOfficeModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"><i class="fas fa-exclamation-triangle mr-1"></i> Confirm Delete</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body text-center">
                    <p>Are you sure you want to delete the office:</p>
                    <h5 class="font-weight-bold text-danger">{{ $deleteName }}</h5>
                    <small class="text-muted">This action uses soft-delete and can be reversed.</small>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" wire:click="delete">
                        <i class="fas fa-trash mr-1"></i> Delete
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
