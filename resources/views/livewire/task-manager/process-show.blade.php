<div>
    <!-- Page Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="z-page-header">
                <div class="d-flex align-items-center justify-content-between flex-wrap" style="gap: 1rem;">
                    <div>
                        <h1>
                            <i class="fas fa-project-diagram mr-2" style="color: var(--z-gold)"></i>
                            {{ $process->name }}
                        </h1>
                        <p>
                            @if($process->status === 'active')
                                <span class="z-status z-status-active" style="font-size: 0.72rem;">Active</span>
                            @else
                                <span class="z-status z-status-inactive" style="font-size: 0.72rem;">Inactive</span>
                            @endif
                            &nbsp;{{ $process->description ?? 'No description' }}
                        </p>
                    </div>
                    <div class="d-flex align-items-center" style="gap: 0.5rem;">
                        <a href="{{ route('task-manager.index') }}" class="btn btn-sm" style="background: rgba(255,255,255,0.15); color: #fff; border-radius: 8px; font-size: 0.82rem;">
                            <i class="fas fa-arrow-left mr-1"></i> Back to Processes
                        </a>
                        <button wire:click="openEditProcess" class="btn btn-sm" style="background: rgba(255,255,255,0.15); color: #fff; border-radius: 8px; font-size: 0.82rem;">
                            <i class="fas fa-pen mr-1"></i> Edit Process
                        </button>
                    </div>
                </div>

                {{-- Stats --}}
                <div class="row mt-3">
                    <div class="col-6 col-md-2">
                        <div style="background: rgba(255,255,255,0.12); border-radius: 8px; padding: 0.5rem 0.75rem;">
                            <div style="font-size: 1.15rem; font-weight: 800;">{{ $process->modules->count() }}</div>
                            <div style="font-size: 0.72rem; opacity: 0.8;">Modules</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <div style="background: rgba(255,255,255,0.12); border-radius: 8px; padding: 0.5rem 0.75rem;">
                            <div style="font-size: 1.15rem; font-weight: 800;">{{ $stats['totalTasks'] }}</div>
                            <div style="font-size: 0.72rem; opacity: 0.8;">Total Tasks</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <div style="background: rgba(255,255,255,0.12); border-radius: 8px; padding: 0.5rem 0.75rem;">
                            <div style="font-size: 1.15rem; font-weight: 800; color: #fbbf24;">{{ $stats['pendingTasks'] }}</div>
                            <div style="font-size: 0.72rem; opacity: 0.8;">Pending</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <div style="background: rgba(255,255,255,0.12); border-radius: 8px; padding: 0.5rem 0.75rem;">
                            <div style="font-size: 1.15rem; font-weight: 800; color: #60a5fa;">{{ $stats['inProgressTasks'] }}</div>
                            <div style="font-size: 0.72rem; opacity: 0.8;">In Progress</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <div style="background: rgba(255,255,255,0.12); border-radius: 8px; padding: 0.5rem 0.75rem;">
                            <div style="font-size: 1.15rem; font-weight: 800; color: #34d399;">{{ $stats['completedTasks'] }}</div>
                            <div style="font-size: 0.72rem; opacity: 0.8;">Completed</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <div style="background: rgba(255,255,255,0.12); border-radius: 8px; padding: 0.5rem 0.75rem;">
                            <div style="font-size: 1.15rem; font-weight: 800; color: #f87171;">{{ $stats['overdueTasks'] }}</div>
                            <div style="font-size: 0.72rem; opacity: 0.8;">Overdue</div>
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

            <div class="row">
                {{-- LEFT: Modules Panel --}}
                <div class="col-lg-4 mb-3">
                    <div class="card z-card">
                        <div class="card-header d-flex align-items-center justify-content-between py-2">
                            <h3 class="mb-0" style="font-size: 0.95rem;"><i class="fas fa-cubes mr-1"></i> Modules <span class="z-count">{{ $process->modules->count() }}</span></h3>
                            <button wire:click="openModuleModal()" class="btn-zesco" style="font-size: 0.75rem; padding: 4px 12px;">
                                <i class="fas fa-plus mr-1"></i> Add
                            </button>
                        </div>
                        <div class="card-body p-0" style="max-height: 600px; overflow-y: auto;">
                            {{-- "All Tasks" tab --}}
                            <div wire:click="selectModule(null)" class="tm-module-item {{ is_null($activeModuleId) ? 'tm-module-active' : '' }}">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <i class="fas fa-layer-group mr-1" style="color: var(--z-gold);"></i>
                                        <span style="font-weight: 600;">All Tasks</span>
                                    </div>
                                    <span class="z-count">{{ $stats['totalTasks'] }}</span>
                                </div>
                            </div>

                            @forelse($process->modules as $mod)
                                <div class="tm-module-item {{ $activeModuleId == $mod->id ? 'tm-module-active' : '' }}">
                                    <div wire:click="selectModule({{ $mod->id }})" style="cursor: pointer;">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div style="min-width: 0; flex: 1;">
                                                <div class="d-flex align-items-center" style="gap: 0.4rem;">
                                                    <span class="tm-module-order">{{ $mod->order }}</span>
                                                    <span style="font-weight: 600; font-size: 0.85rem; color: #1a2332;">{{ Str::limit($mod->name, 28) }}</span>
                                                </div>
                                                @if($mod->description)
                                                    <div style="font-size: 0.7rem; color: #94a3b8; margin-top: 2px;">{{ Str::limit($mod->description, 50) }}</div>
                                                @endif
                                            </div>
                                            <div class="text-right">
                                                <span class="z-count">{{ $mod->tasks->count() }}</span>
                                                @if($mod->status === 'inactive')
                                                    <div><span class="z-status z-status-inactive" style="font-size: 0.6rem;">Inactive</span></div>
                                                @endif
                                            </div>
                                        </div>
                                        {{-- Progress bar --}}
                                        @php $modProgress = $mod->progress; @endphp
                                        <div class="progress mt-2" style="height: 4px; border-radius: 2px; background: #e2e8f0;">
                                            <div class="progress-bar" style="width: {{ $modProgress }}%; background: var(--z-green); border-radius: 2px;"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-2" style="gap: 4px;">
                                        <button wire:click="openTaskModal({{ $mod->id }})" class="btn btn-sm btn-outline-success" style="border-radius: 6px; font-size: 0.68rem; padding: 2px 8px;" title="Add Task">
                                            <i class="fas fa-plus mr-1"></i> Task
                                        </button>
                                        <button wire:click="openModuleModal({{ $mod->id }})" class="z-action z-action-edit" title="Edit Module" style="width: 24px; height: 24px; font-size: 0.65rem;">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button wire:click="confirmDelete('module', {{ $mod->id }})" class="z-action z-action-delete" title="Delete Module" style="width: 24px; height: 24px; font-size: 0.65rem;">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <div class="p-4 text-center" style="color: #94a3b8;">
                                    <i class="fas fa-cubes fa-2x d-block mb-2"></i>
                                    No modules yet. Add one to get started.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- RIGHT: Tasks Panel --}}
                <div class="col-lg-8">
                    <div class="card z-card" style="position: relative;">
                        <div wire:loading.flex class="z-loading">
                            <div class="spinner-border text-success"><span class="sr-only">Loading...</span></div>
                        </div>

                        <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="gap: 0.5rem;">
                            <h3 class="mb-0">
                                <i class="fas fa-tasks mr-1"></i>
                                {{ $activeModuleId ? ($process->modules->firstWhere('id', $activeModuleId)->name ?? 'Module') . ' — Tasks' : 'All Tasks' }}
                                <span class="z-count">{{ $tasks->total() }}</span>
                            </h3>
                            @if($process->modules->count() > 0)
                                <button wire:click="openTaskModal({{ $activeModuleId }})" class="btn-zesco" style="font-size: 0.8rem;">
                                    <i class="fas fa-plus mr-1"></i> New Task
                                </button>
                            @endif
                        </div>

                        <div class="card-body">
                            {{-- Task Filters --}}
                            <div class="d-flex flex-wrap align-items-center mb-3" style="gap: 0.75rem;">
                                <div class="z-search" style="flex: 1; min-width: 180px; max-width: 280px;">
                                    <i class="fas fa-search si"></i>
                                    <input type="text" wire:model.debounce.300ms="taskSearch" placeholder="Search tasks...">
                                </div>
                                <select wire:model="taskFilterStatus" class="form-control z-filter-select" style="max-width: 150px;">
                                    <option value="">All Statuses</option>
                                    <option value="pending">Pending</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="completed">Completed</option>
                                </select>
                                <select wire:model="taskFilterPriority" class="form-control z-filter-select" style="max-width: 140px;">
                                    <option value="">All Priorities</option>
                                    <option value="high">High</option>
                                    <option value="medium">Medium</option>
                                    <option value="low">Low</option>
                                </select>
                                <select wire:model="taskFilterOffice" class="form-control z-filter-select" style="max-width: 180px;">
                                    <option value="">All Offices</option>
                                    @foreach($offices as $off)
                                        <option value="{{ $off->id }}">{{ Str::limit($off->responsible_office, 25) }}</option>
                                    @endforeach
                                </select>
                                @if($taskSearch || $taskFilterStatus || $taskFilterPriority || $taskFilterOffice)
                                    <button wire:click="clearTaskFilters" class="btn btn-sm btn-outline-secondary" style="border-radius: 6px;">
                                        <i class="fas fa-times mr-1"></i> Clear
                                    </button>
                                @endif
                            </div>

                            {{-- Tasks Table --}}
                            <div class="table-responsive">
                                <table class="table z-table mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 36px;">#</th>
                                            <th style="min-width: 200px;">Task</th>
                                            <th>Module</th>
                                            <th style="width: 80px;">Priority</th>
                                            <th style="width: 100px;">Status</th>
                                            <th style="width: 100px;">Due Date</th>
                                            <th>Offices</th>
                                            <th style="width: 120px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($tasks as $idx => $task)
                                            <tr>
                                                <td style="color: #94a3b8;">{{ $tasks->firstItem() + $idx }}</td>
                                                <td>
                                                    <div style="font-weight: 600; color: #1a2332;">{{ $task->title }}</div>
                                                    @if($task->description)
                                                        <div style="font-size: 0.72rem; color: #94a3b8;">{{ Str::limit($task->description, 50) }}</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="z-badge" style="font-size: 0.72rem;">{{ Str::limit($task->module->name ?? '—', 18) }}</span>
                                                </td>
                                                <td>
                                                    <span class="tm-priority-badge" style="background: {{ $task->priority_color }}20; color: {{ $task->priority_color }}; border: 1px solid {{ $task->priority_color }}40;">
                                                        {{ ucfirst($task->priority) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="tm-status-badge" style="background: {{ $task->status_color }}20; color: {{ $task->status_color }}; border: 1px solid {{ $task->status_color }}40;">
                                                        {{ str_replace('_', ' ', ucfirst($task->status)) }}
                                                    </span>
                                                </td>
                                                <td style="font-size: 0.78rem; color: #6b7280;">
                                                    @if($task->due_date)
                                                        <span class="{{ $task->is_overdue ? 'text-danger font-weight-bold' : '' }}">
                                                            {{ $task->due_date->format('M d, Y') }}
                                                        </span>
                                                        @if($task->is_overdue)
                                                            <div style="font-size: 0.65rem; color: #dc2626;"><i class="fas fa-exclamation-circle"></i> Overdue</div>
                                                        @endif
                                                    @else
                                                        <span style="color: #94a3b8;">—</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($task->offices->count() > 0)
                                                        @foreach($task->offices->take(2) as $off)
                                                            <span class="z-badge" style="font-size: 0.65rem; margin-bottom: 2px;">{{ Str::limit($off->responsible_office, 15) }}</span>
                                                        @endforeach
                                                        @if($task->offices->count() > 2)
                                                            <span style="font-size: 0.65rem; color: #94a3b8;">+{{ $task->offices->count() - 2 }} more</span>
                                                        @endif
                                                    @else
                                                        <span style="font-size: 0.75rem; color: #94a3b8;">Unassigned</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex" style="gap: 4px;">
                                                        <button wire:click="viewTask({{ $task->id }})" class="z-action z-action-view" title="View Details">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button wire:click="openTaskModal(null, {{ $task->id }})" class="z-action z-action-edit" title="Edit">
                                                            <i class="fas fa-pen"></i>
                                                        </button>
                                                        <button wire:click="confirmDelete('task', {{ $task->id }})" class="z-action z-action-delete" title="Delete">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-4" style="color: #94a3b8;">
                                                    <i class="fas fa-tasks fa-2x d-block mb-2"></i>
                                                    @if($process->modules->count() === 0)
                                                        Create a module first, then add tasks.
                                                    @else
                                                        No tasks found. Click "New Task" to create one.
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            @if($tasks->hasPages())
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $tasks->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== EDIT PROCESS MODAL ===== --}}
    @if($showEditProcess)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog">
                <div class="modal-content z-modal">
                    <div class="modal-header modal-header-zesco">
                        <h5><i class="fas fa-pen mr-2"></i> Edit Process</h5>
                        <button wire:click="closeEditProcess" type="button" class="close text-white"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="z-label">Process Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model.defer="editProcessName" class="form-control z-input">
                            @error('editProcessName') <span class="text-danger" style="font-size: 0.78rem;">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="z-label">Description</label>
                            <textarea wire:model.defer="editProcessDescription" class="form-control z-input" rows="3"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label class="z-label">Status</label>
                            <select wire:model.defer="editProcessStatus" class="form-control z-input">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid #e9ecef;">
                        <button wire:click="closeEditProcess" class="btn btn-light" style="border-radius: 8px;">Cancel</button>
                        <button wire:click="saveProcessEdit" class="btn-zesco-green">
                            <i class="fas fa-save mr-1"></i> Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- ===== MODULE MODAL ===== --}}
    @if($showModuleModal)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog">
                <div class="modal-content z-modal">
                    <div class="modal-header modal-header-gold">
                        <h5><i class="fas fa-cube mr-2"></i> {{ $editingModuleId ? 'Edit' : 'New' }} Module</h5>
                        <button wire:click="closeModuleModal" type="button" class="close text-white"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="z-label">Module Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model.defer="moduleName" class="form-control z-input" placeholder="e.g. Application Review, Due Diligence...">
                            @error('moduleName') <span class="text-danger" style="font-size: 0.78rem;">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="z-label">Description</label>
                            <textarea wire:model.defer="moduleDescription" class="form-control z-input" rows="2" placeholder="Brief description..."></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="z-label">Order <span class="text-danger">*</span></label>
                                    <input type="number" wire:model.defer="moduleOrder" class="form-control z-input" min="0">
                                    @error('moduleOrder') <span class="text-danger" style="font-size: 0.78rem;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="z-label">Status</label>
                                    <select wire:model.defer="moduleStatus" class="form-control z-input">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid #e9ecef;">
                        <button wire:click="closeModuleModal" class="btn btn-light" style="border-radius: 8px;">Cancel</button>
                        <button wire:click="saveModule" class="btn-zesco-green">
                            <i class="fas fa-save mr-1"></i> {{ $editingModuleId ? 'Update' : 'Create' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- ===== TASK MODAL ===== --}}
    @if($showTaskModal)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-lg">
                <div class="modal-content z-modal">
                    <div class="modal-header modal-header-zesco">
                        <h5><i class="fas fa-tasks mr-2"></i> {{ $editingTaskId ? 'Edit' : 'New' }} Task</h5>
                        <button wire:click="closeTaskModal" type="button" class="close text-white"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="z-label">Task Title <span class="text-danger">*</span></label>
                                <input type="text" wire:model.defer="taskTitle" class="form-control z-input" placeholder="e.g. Review application documents...">
                                @error('taskTitle') <span class="text-danger" style="font-size: 0.78rem;">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="z-label">Module <span class="text-danger">*</span></label>
                                <select wire:model.defer="taskModuleId" class="form-control z-input">
                                    <option value="">-- Select Module --</option>
                                    @foreach($process->modules as $mod)
                                        <option value="{{ $mod->id }}">{{ $mod->order }}. {{ $mod->name }}</option>
                                    @endforeach
                                </select>
                                @error('taskModuleId') <span class="text-danger" style="font-size: 0.78rem;">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="z-label">Description</label>
                            <textarea wire:model.defer="taskDescription" class="form-control z-input" rows="3" placeholder="Describe what needs to be done..."></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="z-label">Priority</label>
                                <select wire:model.defer="taskPriority" class="form-control z-input">
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="z-label">Due Date</label>
                                <input type="date" wire:model.defer="taskDueDate" class="form-control z-input">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="z-label">Status</label>
                                <select wire:model.defer="taskStatus" class="form-control z-input">
                                    <option value="pending">Pending</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>
                        </div>

                        {{-- Office Assignment (multi-select) --}}
                        <div class="z-section-title"><i class="fas fa-building mr-1"></i> Assign to Offices</div>
                        <div class="form-group mb-3">
                            <label class="z-label">Select Offices <small class="text-muted">(hold Ctrl to select multiple)</small></label>
                            <select wire:model.defer="taskOfficeIds" class="form-control z-input" multiple style="min-height: 120px;">
                                @foreach($offices as $off)
                                    <option value="{{ $off->id }}">{{ $off->responsible_office }}</option>
                                @endforeach
                            </select>
                            @error('taskOfficeIds') <span class="text-danger" style="font-size: 0.78rem;">{{ $message }}</span> @enderror
                            @if(count($taskOfficeIds) > 0)
                                <div class="mt-2" style="display: flex; flex-wrap: wrap; gap: 0.4rem;">
                                    @foreach($offices->whereIn('id', $taskOfficeIds) as $selOff)
                                        <span class="z-badge" style="font-size: 0.72rem;"><i class="fas fa-building mr-1"></i> {{ $selOff->responsible_office }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid #e9ecef;">
                        <button wire:click="closeTaskModal" class="btn btn-light" style="border-radius: 8px;">Cancel</button>
                        <button wire:click="saveTask" class="btn-zesco-green">
                            <i class="fas fa-save mr-1"></i> {{ $editingTaskId ? 'Update' : 'Create' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- ===== TASK DETAIL MODAL ===== --}}
    @if($showTaskDetail && $detailTask)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-lg">
                <div class="modal-content z-modal">
                    <div class="modal-header modal-header-zesco">
                        <h5><i class="fas fa-clipboard-check mr-2"></i> Task Details</h5>
                        <button wire:click="closeTaskDetail" type="button" class="close text-white"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <h4 style="font-weight: 700; color: #1a2332; margin: 0;">{{ $detailTask->title }}</h4>
                                <div style="font-size: 0.82rem; color: #6b7280; margin-top: 0.25rem;">
                                    Module: <strong>{{ $detailTask->module->name ?? '—' }}</strong>
                                    &bull; Process: <strong>{{ $detailTask->module->process->name ?? '—' }}</strong>
                                </div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <div class="z-detail-label">Priority</div>
                                <div class="z-detail-value">
                                    <span class="tm-priority-badge" style="background: {{ $detailTask->priority_color }}20; color: {{ $detailTask->priority_color }}; border: 1px solid {{ $detailTask->priority_color }}40;">
                                        {{ ucfirst($detailTask->priority) }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="z-detail-label">Status</div>
                                <div class="z-detail-value">
                                    <span class="tm-status-badge" style="background: {{ $detailTask->status_color }}20; color: {{ $detailTask->status_color }}; border: 1px solid {{ $detailTask->status_color }}40;">
                                        {{ str_replace('_', ' ', ucfirst($detailTask->status)) }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="z-detail-label">Due Date</div>
                                <div class="z-detail-value">
                                    @if($detailTask->due_date)
                                        <span class="{{ $detailTask->is_overdue ? 'text-danger font-weight-bold' : '' }}">
                                            {{ $detailTask->due_date->format('M d, Y') }}
                                        </span>
                                        @if($detailTask->is_overdue)
                                            <span class="text-danger ml-1" style="font-size: 0.72rem;"><i class="fas fa-exclamation-circle"></i> Overdue</span>
                                        @endif
                                    @else
                                        <span class="text-muted">No due date</span>
                                    @endif
                                </div>
                            </div>

                            @if($detailTask->description)
                                <div class="col-md-12 mb-2">
                                    <div class="z-detail-label">Description</div>
                                    <div class="z-detail-value">{{ $detailTask->description }}</div>
                                </div>
                            @endif

                            <div class="col-md-6 mb-2">
                                <div class="z-detail-label">Created By</div>
                                <div class="z-detail-value">{{ $detailTask->creator->name ?? '—' }}</div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="z-detail-label">Created At</div>
                                <div class="z-detail-value">{{ $detailTask->created_at->format('M d, Y H:i') }}</div>
                            </div>

                            {{-- Assigned Offices --}}
                            <div class="col-md-12 mt-2">
                                <div class="z-section-title"><i class="fas fa-building mr-1"></i> Assigned Offices</div>
                                @if($detailTask->offices->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table z-table mb-0" style="font-size: 0.82rem;">
                                            <thead>
                                                <tr>
                                                    <th>Office</th>
                                                    <th style="width: 140px;">Assignment Status</th>
                                                    <th style="width: 120px;">Assigned At</th>
                                                    <th style="width: 160px;">Change Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($detailTask->offices as $off)
                                                    <tr>
                                                        <td style="font-weight: 600;">{{ $off->responsible_office }}</td>
                                                        <td>
                                                            @php $pivotStatus = $off->pivot->status ?? 'pending'; @endphp
                                                            <span class="tm-status-badge" style="font-size: 0.7rem;
                                                                background: {{ $pivotStatus === 'completed' ? '#10b981' : ($pivotStatus === 'acknowledged' ? '#3b82f6' : '#f59e0b') }}20;
                                                                color: {{ $pivotStatus === 'completed' ? '#10b981' : ($pivotStatus === 'acknowledged' ? '#3b82f6' : '#f59e0b') }};
                                                                border: 1px solid {{ $pivotStatus === 'completed' ? '#10b981' : ($pivotStatus === 'acknowledged' ? '#3b82f6' : '#f59e0b') }}40;">
                                                                {{ ucfirst($pivotStatus) }}
                                                            </span>
                                                        </td>
                                                        <td style="font-size: 0.75rem; color: #6b7280;">
                                                            {{ $off->pivot->assigned_at ? \Carbon\Carbon::parse($off->pivot->assigned_at)->format('M d, Y') : '—' }}
                                                        </td>
                                                        <td>
                                                            <select wire:change="updateAssignmentStatus({{ $detailTask->id }}, {{ $off->id }}, $event.target.value)"
                                                                    class="form-control form-control-sm z-input" style="font-size: 0.75rem; padding: 2px 6px; height: auto;">
                                                                <option value="pending" {{ $pivotStatus === 'pending' ? 'selected' : '' }}>Pending</option>
                                                                <option value="acknowledged" {{ $pivotStatus === 'acknowledged' ? 'selected' : '' }}>Acknowledged</option>
                                                                <option value="completed" {{ $pivotStatus === 'completed' ? 'selected' : '' }}>Completed</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center py-3" style="color: #94a3b8; font-size: 0.85rem;">
                                        <i class="fas fa-building d-block mb-1"></i> No offices assigned to this task.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid #e9ecef;">
                        <button wire:click="closeTaskDetail" class="btn btn-light" style="border-radius: 8px;">Close</button>
                        <button wire:click="openTaskModal(null, {{ $detailTask->id }})" class="btn-zesco">
                            <i class="fas fa-pen mr-1"></i> Edit Task
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
                        <h5 style="font-weight: 700; color: #1a2332; margin-bottom: 0.5rem;">
                            Delete {{ ucfirst($deleteType ?? 'Item') }}?
                        </h5>
                        <p style="font-size: 0.85rem; color: #6b7280;">
                            Are you sure you want to delete<br>
                            <strong>"{{ Str::limit($deleteName, 40) }}"</strong>?<br>
                            @if($deleteType === 'module')
                                <small class="text-danger">All tasks inside this module will also be deleted.</small>
                            @else
                                <small class="text-danger">This action cannot be undone.</small>
                            @endif
                        </p>
                        <div class="d-flex justify-content-center" style="gap: 0.75rem;">
                            <button wire:click="cancelDelete" class="btn btn-light" style="border-radius: 8px;">Cancel</button>
                            <button wire:click="executeDelete" class="btn btn-danger" style="border-radius: 8px;">
                                <i class="fas fa-trash-alt mr-1"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
