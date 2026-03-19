<style>
:root {
    --z-green: #14984f;
    --z-green-dark: #0d7a3e;
    --z-gold: #FFB223;
    --z-gold-dark: #e09a00;
}

/* Page header */
.um-page-header {
    background: linear-gradient(135deg, #0d7a3e 0%, #14984f 60%, #00895A 100%);
    border-radius: 12px;
    padding: 1.5rem 2rem;
    margin-bottom: 1.5rem;
    color: #fff;
    position: relative;
    overflow: hidden;
}
.um-page-header::before {
    content: '';
    position: absolute;
    top: -40%;
    right: -10%;
    width: 300px;
    height: 300px;
    background: radial-gradient(ellipse, rgba(255,255,255,0.07) 0%, transparent 70%);
}
.um-page-header h1 { font-size: 1.35rem; font-weight: 700; margin: 0; }
.um-page-header p { margin: 0.25rem 0 0; opacity: 0.85; font-size: 0.875rem; }

/* Table card */
.um-card { border-radius: 12px; border: 1px solid #e9ecef; overflow: hidden; }
.um-card .card-header { background: #fff; border-bottom: 1px solid #e9ecef; padding: 1rem 1.5rem; }
.um-card .card-header h3 { font-size: 1rem; font-weight: 700; color: #1a2332; margin: 0; }

/* Search box */
.um-search { position: relative; max-width: 300px; }
.um-search input {
    padding: 0.5rem 0.85rem 0.5rem 2.5rem;
    border-radius: 8px;
    border: 1.5px solid #e2e8f0;
    font-size: 0.85rem;
    width: 100%;
    transition: border-color 0.2s;
}
.um-search input:focus { border-color: var(--z-green); box-shadow: 0 0 0 3px rgba(20,152,79,0.1); outline: none; }
.um-search .si { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; pointer-events: none; }

/* Table */
.um-table thead th {
    font-size: 0.78rem; font-weight: 700; color: #64748b;
    border-bottom: 2px solid #e2e8f0; cursor: pointer; user-select: none; white-space: nowrap;
}
.um-table thead th:hover { color: var(--z-green); }
.um-table tbody tr:hover { background: #f0fdf4; }
.sort-icon { font-size: 0.7rem; margin-left: 4px; opacity: 0.5; }
.sort-icon.active { opacity: 1; color: var(--z-green); }

/* Avatar in table */
.um-avatar-sm {
    width: 34px; height: 34px; border-radius: 8px; object-fit: cover;
    border: 2px solid #e5e7eb;
}

/* Action buttons */
.um-action {
    display: inline-flex; align-items: center; justify-content: center;
    width: 32px; height: 32px; border-radius: 6px; border: none;
    transition: all 0.2s; cursor: pointer; font-size: 0.82rem;
}
.um-action-view { background: rgba(20,152,79,0.1); color: var(--z-green); }
.um-action-view:hover { background: var(--z-green); color: #fff; }
.um-action-delete { background: rgba(220,38,38,0.1); color: #dc2626; }
.um-action-delete:hover { background: #dc2626; color: #fff; }

/* Per-page select */
.um-per-page {
    border-radius: 6px; border: 1.5px solid #e2e8f0;
    padding: 0.35rem 0.5rem; font-size: 0.825rem; color: #374151;
}
.um-per-page:focus { border-color: var(--z-green); outline: none; }

/* CTA button */
.btn-zesco {
    background: linear-gradient(135deg, var(--z-gold), #f59e0b);
    color: #fff; border-radius: 8px; padding: 0.5rem 1.25rem;
    font-weight: 600; font-size: 0.85rem; border: none;
    transition: all 0.2s; display: inline-flex; align-items: center; gap: 0.35rem;
}
.btn-zesco:hover { background: linear-gradient(135deg, var(--z-gold-dark), #d97706); box-shadow: 0 4px 12px rgba(255,178,35,0.35); color: #fff; }
.btn-zesco-green {
    background: linear-gradient(135deg, var(--z-green), var(--z-green-dark));
    color: #fff; border-radius: 8px; padding: 0.5rem 1.25rem;
    font-weight: 600; font-size: 0.85rem; border: none; transition: all 0.2s;
}
.btn-zesco-green:hover { background: linear-gradient(135deg, #0d7a3e, #065f30); color: #fff; }

/* Status pill */
.um-status { padding: 0.2rem 0.6rem; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
.um-status-active { background: #ecfdf5; color: #065f46; }
.um-status-inactive { background: #fef2f2; color: #991b1b; }

/* Loading overlay */
.um-loading {
    position: absolute; inset: 0; background: rgba(255,255,255,0.7);
    display: flex; align-items: center; justify-content: center;
    z-index: 10; border-radius: 12px;
}

/* Modal modern */
.um-modal .modal-content { border: none; border-radius: 16px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.15); }
.um-modal .modal-header-green {
    background: linear-gradient(135deg, #004D2E 0%, #006B3F 60%, #00895A 100%);
    padding: 1.5rem 1.75rem; color: #fff; border: none;
}
.um-modal .modal-header-green h5 { font-weight: 700; margin: 0; font-size: 1.15rem; }
.um-modal .modal-header-green .close { color: #fff; opacity: 0.7; text-shadow: none; }
.um-modal .modal-body { padding: 1.5rem 1.75rem; }
.um-modal .modal-footer { padding: 0.75rem 1.75rem 1.25rem; border: none; }

/* Form inputs inside modal */
.um-input {
    padding: 0.6rem 0.85rem; border-radius: 8px;
    border: 1.5px solid #e2e8f0; font-size: 0.875rem; transition: border-color 0.2s;
}
.um-input:focus { border-color: var(--z-green); box-shadow: 0 0 0 3px rgba(20,152,79,0.1); outline: none; }
.um-label { font-size: 0.825rem; font-weight: 600; color: #1a2332; margin-bottom: 0.3rem; }
</style>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<div>
    <!-- Page Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="um-page-header">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div>
                        <h1><i class="fas fa-users mr-2" style="color: var(--z-gold)"></i>User Management</h1>
                        <p>Manage system users, accounts and access</p>
                    </div>
                    <button wire:click="openCreateModal" class="btn-zesco">
                        <i class="fas fa-user-plus"></i> Add User
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <section class="content">
        <div class="container-fluid">

            {{-- Flash --}}
            @if(session()->has('message'))
                <div class="alert alert-success" style="border-radius: 10px; font-size: 0.9rem;">
                    <i class="fas fa-check-circle mr-1"></i> {{ session('message') }}
                </div>
            @endif

            {{-- Table Card --}}
            <div class="card um-card" style="position: relative;">
                <div wire:loading.flex class="um-loading">
                    <div class="spinner-border text-success"><span class="sr-only">Loading...</span></div>
                </div>

                <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="gap: 0.75rem;">
                    <h3><i class="fas fa-list mr-2" style="color: var(--z-green)"></i>All Users</h3>
                    <div class="d-flex align-items-center" style="gap: 0.75rem;">
                        <div class="um-search">
                            <i class="fas fa-search si"></i>
                            <input type="text" wire:model.debounce.300ms="search" placeholder="Search users...">
                        </div>
                        <select wire:model="perPage" class="um-per-page">
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover um-table mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 50px;"></th>
                                    <th wire:click="sortBy('staff_no')">
                                        Staff No
                                        @if($sortField === 'staff_no')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} sort-icon active"></i>
                                        @else
                                            <i class="fas fa-sort sort-icon"></i>
                                        @endif
                                    </th>
                                    <th wire:click="sortBy('name')">
                                        Name
                                        @if($sortField === 'name')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} sort-icon active"></i>
                                        @else
                                            <i class="fas fa-sort sort-icon"></i>
                                        @endif
                                    </th>
                                    <th wire:click="sortBy('email')">
                                        Email
                                        @if($sortField === 'email')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} sort-icon active"></i>
                                        @else
                                            <i class="fas fa-sort sort-icon"></i>
                                        @endif
                                    </th>
                                    <th wire:click="sortBy('directorate')">
                                        Directorate
                                        @if($sortField === 'directorate')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} sort-icon active"></i>
                                        @else
                                            <i class="fas fa-sort sort-icon"></i>
                                        @endif
                                    </th>
                                    <th wire:click="sortBy('job_title')">
                                        Job Title
                                        @if($sortField === 'job_title')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} sort-icon active"></i>
                                        @else
                                            <i class="fas fa-sort sort-icon"></i>
                                        @endif
                                    </th>
                                    <th wire:click="sortBy('total_login')">
                                        Logins
                                        @if($sortField === 'total_login')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} sort-icon active"></i>
                                        @else
                                            <i class="fas fa-sort sort-icon"></i>
                                        @endif
                                    </th>
                                    <th style="width: 100px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $u)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('storage/user_avatar/' . ($u->avatar ?? '')) }}"
                                                 class="um-avatar-sm"
                                                 onerror="this.src='{{ asset('dashboard/dist/img/avatar.png') }}';">
                                        </td>
                                        <td>{{ $u->staff_no ?? '--' }}</td>
                                        <td><strong>{{ $u->name ?? '--' }}</strong></td>
                                        <td>{{ $u->email ?? '--' }}</td>
                                        <td>{{ $u->directorate ?? '--' }}</td>
                                        <td>{{ $u->job_title ?? '--' }}</td>
                                        <td>
                                            <span class="badge badge-light" style="font-size: 0.8rem;">{{ $u->total_login ?? 0 }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex" style="gap: 4px;">
                                                <a href="{{ route('user.show', $u->id) }}" class="um-action um-action-view" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <button wire:click="confirmDelete({{ $u->id }})" class="um-action um-action-delete" title="Delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4" style="color: #94a3b8;">
                                            <i class="fas fa-users fa-2x mb-2 d-block"></i>
                                            No users found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer bg-white border-top d-flex align-items-center justify-content-between flex-wrap" style="gap: 0.75rem;">
                    <span style="font-size: 0.82rem; color: #6b7280;">
                        Showing {{ $users->firstItem() ?? 0 }} - {{ $users->lastItem() ?? 0 }} of {{ $users->total() }}
                    </span>
                    {{ $users->links() }}
                </div>
            </div>

        </div>
    </section>

    {{-- ===== CREATE USER MODAL ===== --}}
    @if($showCreateModal)
    <div class="modal fade show um-modal" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header-green d-flex align-items-center justify-content-between">
                    <h5><i class="fas fa-user-plus mr-2"></i> Add New User</h5>
                    <button type="button" class="close" wire:click="$set('showCreateModal', false)">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- Staff search --}}
                    <div class="row mb-3">
                        <div class="col-md-5">
                            <label class="um-label">Employee Staff No</label>
                            <div class="input-group">
                                <input type="text" wire:model.defer="staffNo" class="form-control um-input" placeholder="e.g. 12345">
                                <div class="input-group-append">
                                    <button wire:click="lookupStaff" class="btn btn-zesco-green" type="button" wire:loading.attr="disabled">
                                        <i class="fas fa-search"></i> Lookup
                                    </button>
                                </div>
                            </div>
                            @error('staffNo') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-7">
                            <label class="um-label">Staff Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model.defer="staffName" class="form-control um-input" placeholder="Full name"
                                   {{ $staffFound ? 'readonly' : '' }}>
                            @error('staffName') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="um-label">Job Title</label>
                            <input type="text" wire:model.defer="jobTitle" class="form-control um-input" {{ $staffFound ? 'readonly' : '' }}>
                        </div>
                        <div class="col-md-6">
                            <label class="um-label">Department / Unit</label>
                            <input type="text" wire:model.defer="userUnit" class="form-control um-input" {{ $staffFound ? 'readonly' : '' }}>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="um-label">Directorate</label>
                            <input type="text" wire:model.defer="directorate" class="form-control um-input" {{ $staffFound ? 'readonly' : '' }}>
                        </div>
                        <div class="col-md-4">
                            <label class="um-label">Mobile No</label>
                            <input type="text" wire:model.defer="mobileNo" class="form-control um-input" {{ $staffFound ? 'readonly' : '' }}>
                        </div>
                        <div class="col-md-4">
                            <label class="um-label">Email <span class="text-danger">*</span></label>
                            <input type="email" wire:model.defer="staffEmail" class="form-control um-input" placeholder="email@zesco.co.zm"
                                   {{ $staffFound ? 'readonly' : '' }}>
                            @error('staffEmail') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="um-label">Default Password <span class="text-danger">*</span></label>
                            <input type="password" wire:model.defer="password" class="form-control um-input" placeholder="Strong password">
                            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                            <small class="text-muted">Min 8 chars, upper + lower + number + special</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="$set('showCreateModal', false)" class="btn btn-light" style="border-radius: 8px;">Cancel</button>
                    <button wire:click="createUser" class="btn-zesco-green" wire:loading.attr="disabled">
                        <i class="fas fa-check-circle mr-1"></i> Create User
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ===== DELETE CONFIRMATION MODAL ===== --}}
    @if($deleteId)
    <div class="modal fade show um-modal" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
            <div class="modal-content">
                <div style="padding: 2rem; text-align: center;">
                    <div style="width: 56px; height: 56px; border-radius: 50%; background: #fef2f2; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                        <i class="fas fa-exclamation-triangle" style="font-size: 1.5rem; color: #dc2626;"></i>
                    </div>
                    <h5 style="font-weight: 700; margin-bottom: 0.5rem;">Delete User?</h5>
                    <p style="color: #6b7280; font-size: 0.9rem;">Are you sure you want to delete <strong>{{ $deleteName }}</strong>? This action cannot be undone.</p>
                    <div class="d-flex justify-content-center" style="gap: 0.75rem; margin-top: 1.5rem;">
                        <button wire:click="$set('deleteId', null)" class="btn btn-light px-4" style="border-radius: 8px;">Cancel</button>
                        <button wire:click="deleteUser" class="btn btn-danger px-4" style="border-radius: 8px; font-weight: 600;">
                            <i class="fas fa-trash-alt mr-1"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
