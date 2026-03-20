<div>
    <!-- Page Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="z-page-header">
                <div class="d-flex align-items-center justify-content-between flex-wrap" style="gap: 1rem;">
                    <div>
                        <h1><i class="fas fa-project-diagram mr-2" style="color: var(--z-gold)"></i>Task Management</h1>
                        <p>Manage processes, modules, tasks and office assignments</p>
                    </div>
                    <div>
                        <button wire:click="openFormModal()" class="btn-zesco">
                            <i class="fas fa-plus mr-1"></i> New Process
                        </button>
                    </div>
                </div>

                {{-- Summary Stats --}}
                <div class="row mt-3">
                    <div class="col-6 col-md-3">
                        <div style="background: rgba(255,255,255,0.12); border-radius: 8px; padding: 0.5rem 0.75rem;">
                            <div style="font-size: 1.15rem; font-weight: 800;">{{ $totalProcesses }}</div>
                            <div style="font-size: 0.72rem; opacity: 0.8;">Processes</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div style="background: rgba(255,255,255,0.12); border-radius: 8px; padding: 0.5rem 0.75rem;">
                            <div style="font-size: 1.15rem; font-weight: 800;">{{ $activeProcesses }}</div>
                            <div style="font-size: 0.72rem; opacity: 0.8;">Active</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div style="background: rgba(255,255,255,0.12); border-radius: 8px; padding: 0.5rem 0.75rem;">
                            <div style="font-size: 1.15rem; font-weight: 800;">{{ $totalModules }}</div>
                            <div style="font-size: 0.72rem; opacity: 0.8;">Modules</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div style="background: rgba(255,255,255,0.12); border-radius: 8px; padding: 0.5rem 0.75rem;">
                            <div style="font-size: 1.15rem; font-weight: 800;">{{ $totalTasks }}</div>
                            <div style="font-size: 0.72rem; opacity: 0.8;">Total Tasks</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <section class="content">
        <div class="container-fluid">

            {{-- Flash --}}
            @if(session()->has('message'))
                <div class="z-alert-success alert alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle mr-2"></i> {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif

            {{-- Filters --}}
            <div class="card z-card mb-3">
                <div class="card-body" style="padding: 0.75rem 1.25rem;">
                    <div class="d-flex flex-wrap align-items-center" style="gap: 0.75rem;">
                        <div class="z-search" style="flex: 1; min-width: 200px; max-width: 320px;">
                            <i class="fas fa-search si"></i>
                            <input type="text" wire:model.debounce.300ms="search" placeholder="Search processes...">
                        </div>
                        <select wire:model="filterStatus" class="form-control z-filter-select" style="max-width: 160px;">
                            <option value="">All Statuses</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <select wire:model="perPage" class="form-control z-per-page">
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                        @if($search || $filterStatus)
                            <button wire:click="clearFilters" class="btn btn-sm btn-outline-secondary" style="border-radius: 6px;">
                                <i class="fas fa-times mr-1"></i> Clear
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Process List --}}
            <div class="card z-card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="mb-0"><i class="fas fa-list mr-1"></i> Processes <span class="z-count">{{ $processes->total() }}</span></h3>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table z-table mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 40px;">#</th>
                                    <th wire:click="sortBy('name')" style="cursor: pointer; min-width: 200px;">
                                        Process Name
                                        <i class="fas fa-sort sort-icon {{ $sortField === 'name' ? 'active' : '' }}"></i>
                                    </th>
                                    <th>Description</th>
                                    <th style="width: 100px;">Modules</th>
                                    <th style="width: 100px;">Tasks</th>
                                    <th style="width: 120px;">Progress</th>
                                    <th wire:click="sortBy('status')" style="cursor: pointer; width: 100px;">
                                        Status
                                        <i class="fas fa-sort sort-icon {{ $sortField === 'status' ? 'active' : '' }}"></i>
                                    </th>
                                    <th wire:click="sortBy('created_at')" style="cursor: pointer; width: 110px;">
                                        Created
                                        <i class="fas fa-sort sort-icon {{ $sortField === 'created_at' ? 'active' : '' }}"></i>
                                    </th>
                                    <th style="width: 140px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($processes as $idx => $proc)
                                    @php
                                        $taskCount = $proc->totalTaskCount();
                                        $progress  = $proc->progress;
                                    @endphp
                                    <tr>
                                        <td style="color: #94a3b8;">{{ $processes->firstItem() + $idx }}</td>
                                        <td>
                                            <a href="{{ route('task-manager.show', $proc->id) }}" style="font-weight: 700; color: #1a2332; text-decoration: none;">
                                                {{ $proc->name }}
                                            </a>
                                        </td>
                                        <td style="font-size: 0.82rem; color: #6b7280;">{{ Str::limit($proc->description, 60) }}</td>
                                        <td class="text-center">
                                            <span class="z-badge">{{ $proc->modules_count }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="z-badge-blue">{{ $taskCount }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center" style="gap: 0.5rem;">
                                                <div class="progress" style="flex: 1; height: 6px; border-radius: 3px; background: #e2e8f0;">
                                                    <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%; background: var(--z-green); border-radius: 3px;"></div>
                                                </div>
                                                <span style="font-size: 0.72rem; font-weight: 600; color: #64748b; min-width: 30px;">{{ $progress }}%</span>
                                            </div>
                                        </td>
                                        <td>
                                            @if($proc->status === 'active')
                                                <span class="z-status z-status-active">Active</span>
                                            @else
                                                <span class="z-status z-status-inactive">Inactive</span>
                                            @endif
                                        </td>
                                        <td style="font-size: 0.78rem; color: #6b7280;">
                                            {{ $proc->created_at->format('M d, Y') }}
                                        </td>
                                        <td>
                                            <div class="d-flex" style="gap: 4px;">
                                                <a href="{{ route('task-manager.show', $proc->id) }}" class="z-action z-action-view" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <button wire:click="openFormModal({{ $proc->id }})" class="z-action z-action-edit" title="Edit">
                                                    <span wire:loading wire:target="openFormModal({{ $proc->id }})" class="spinner-border spinner-border-sm" role="status"></span>
                                                    <i wire:loading.remove wire:target="openFormModal({{ $proc->id }})" class="fas fa-pen"></i>
                                                </button>
                                                <button wire:click="confirmDelete({{ $proc->id }})" class="z-action z-action-delete" title="Delete">
                                                    <span wire:loading wire:target="confirmDelete({{ $proc->id }})" class="spinner-border spinner-border-sm" role="status"></span>
                                                    <i wire:loading.remove wire:target="confirmDelete({{ $proc->id }})" class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-4" style="color: #94a3b8;">
                                            <i class="fas fa-project-diagram fa-2x d-block mb-2"></i>
                                            No processes found. Create one to get started.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($processes->hasPages())
                        <div class="d-flex justify-content-center py-3">
                            {{ $processes->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- ===== CREATE/EDIT PROCESS MODAL ===== --}}
    @if($showFormModal)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog">
                <div class="modal-content z-modal">
                    <div class="modal-header modal-header-zesco">
                        <h5><i class="fas fa-project-diagram mr-2"></i> {{ $editingId ? 'Edit' : 'New' }} Process</h5>
                        <button wire:click="closeFormModal" type="button" class="close text-white"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="z-label">Process Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model.defer="formName" class="form-control z-input" placeholder="e.g. IPP Onboarding, Licence Renewal...">
                            @error('formName') <span class="text-danger" style="font-size: 0.78rem;">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="z-label">Description</label>
                            <textarea wire:model.defer="formDescription" class="form-control z-input" rows="3" placeholder="Brief description of this process..."></textarea>
                            @error('formDescription') <span class="text-danger" style="font-size: 0.78rem;">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="z-label">Status</label>
                            <select wire:model.defer="formStatus" class="form-control z-input">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid #e9ecef;">
                        <button wire:click="closeFormModal" class="btn btn-light" style="border-radius: 8px;">Cancel</button>
                        <button wire:click="saveProcess" class="btn-zesco-green">
                            <i class="fas fa-save mr-1"></i> {{ $editingId ? 'Update' : 'Create' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- ===== DELETE CONFIRMATION ===== --}}
    @if($deleteId)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-sm">
                <div class="modal-content z-modal">
                    <div class="modal-body text-center py-4">
                        <div class="z-delete-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h5 style="font-weight: 700; color: #1a2332; margin-bottom: 0.5rem;">Delete Process?</h5>
                        <p style="font-size: 0.85rem; color: #6b7280;">
                            Are you sure you want to delete<br>
                            <strong>"{{ Str::limit($deleteName, 40) }}"</strong>?<br>
                            <small class="text-danger">All modules and tasks inside will also be deleted.</small>
                        </p>
                        <div class="d-flex justify-content-center" style="gap: 0.75rem;">
                            <button wire:click="cancelDelete" class="btn btn-light" style="border-radius: 8px;">Cancel</button>
                            <button wire:click="deleteProcess" class="btn btn-danger" style="border-radius: 8px;">
                                <i class="fas fa-trash-alt mr-1"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
