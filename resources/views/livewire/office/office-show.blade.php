<div>
    <!-- Page Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="z-page-header">
                <div class="d-flex align-items-center justify-content-between flex-wrap" style="gap: 1rem;">
                    <div>
                        <h1>
                            <i class="fas fa-building mr-2" style="color: var(--z-gold)"></i>
                            {{ $office->responsible_office }}
                        </h1>
                        <p>
                            @if($office->office_status)
                                <span class="z-status z-status-active" style="font-size: 0.72rem;">Active</span>
                            @else
                                <span class="z-status z-status-inactive" style="font-size: 0.72rem;">Inactive</span>
                            @endif
                            &nbsp; Office Details &amp; User Assignments
                        </p>
                    </div>
                    <div class="d-flex align-items-center" style="gap: 0.5rem;">
                        <a href="{{ route('office.index') }}" class="btn btn-sm" style="background: rgba(255,255,255,0.15); color: #fff; border-radius: 8px; font-size: 0.82rem;">
                            <i class="fas fa-arrow-left mr-1"></i> Back to Offices
                        </a>
                    </div>
                </div>

                {{-- Stats --}}
                <div class="row mt-3">
                    <div class="col-6 col-md-2">
                        <div style="background: rgba(255,255,255,0.12); border-radius: 8px; padding: 0.5rem 0.75rem;">
                            <div style="font-size: 1.15rem; font-weight: 800;">{{ $office->users_count ?? $office->users->count() }}</div>
                            <div style="font-size: 0.72rem; opacity: 0.8;">Total Members</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <div style="background: rgba(255,255,255,0.12); border-radius: 8px; padding: 0.5rem 0.75rem;">
                            <div style="font-size: 1.15rem; font-weight: 800; color: #fbbf24;">
                                {{ $office->users()->wherePivot('role_in_office', 'manager')->count() }}
                            </div>
                            <div style="font-size: 0.72rem; opacity: 0.8;">Managers</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <div style="background: rgba(255,255,255,0.12); border-radius: 8px; padding: 0.5rem 0.75rem;">
                            <div style="font-size: 1.15rem; font-weight: 800; color: #60a5fa;">
                                {{ $office->users()->wherePivot('role_in_office', 'lead')->count() }}
                            </div>
                            <div style="font-size: 0.72rem; opacity: 0.8;">Leads</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <div style="background: rgba(255,255,255,0.12); border-radius: 8px; padding: 0.5rem 0.75rem;">
                            <div style="font-size: 1.15rem; font-weight: 800; color: #34d399;">
                                {{ $office->users()->wherePivot('role_in_office', 'member')->count() }}
                            </div>
                            <div style="font-size: 0.72rem; opacity: 0.8;">Members</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <div style="background: rgba(255,255,255,0.12); border-radius: 8px; padding: 0.5rem 0.75rem;">
                            <div style="font-size: 1.15rem; font-weight: 800; color: #f59e0b;">{{ $tasks->where('status', 'pending')->count() }}</div>
                            <div style="font-size: 0.72rem; opacity: 0.8;">Pending Tasks</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-2">
                        <div style="background: rgba(255,255,255,0.12); border-radius: 8px; padding: 0.5rem 0.75rem;">
                            <div style="font-size: 1.15rem; font-weight: 800; color: #3b82f6;">{{ $tasks->where('status', 'in_progress')->count() }}</div>
                            <div style="font-size: 0.72rem; opacity: 0.8;">In Progress</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">

            {{-- Flash Messages --}}
            @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 8px;">
                    <i class="fas fa-check-circle mr-1"></i> {!! session('message') !!}
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 8px;">
                    <i class="fas fa-exclamation-circle mr-1"></i> {!! session('error') !!}
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            @endif

            {{-- Toolbar --}}
            <div class="card z-card">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center justify-content-between flex-wrap" style="gap: 0.75rem;">
                        <div class="d-flex align-items-center" style="gap: 0.5rem; flex: 1; min-width: 200px;">
                            <div class="position-relative" style="flex: 1; max-width: 360px;">
                                <i class="fas fa-search"
                                   style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: #9ca3af; font-size: 0.82rem;"></i>
                                <input type="text" wire:model.debounce.300ms="search"
                                       placeholder="Search users by name, email, staff no, job title…"
                                       class="form-control form-control-sm"
                                       style="padding-left: 32px; border-radius: 8px; font-size: 0.82rem; border-color: #e5e7eb;">
                            </div>
                        </div>
                        <button wire:click="openAttachModal" class="btn btn-sm z-btn-primary">
                            <span wire:loading wire:target="openAttachModal" class="spinner-border spinner-border-sm mr-1" role="status"></span>
                            <i wire:loading.remove wire:target="openAttachModal" class="fas fa-user-plus mr-1"></i> Add User
                        </button>
                    </div>
                </div>
            </div>

            {{-- Users Table --}}
            <div class="card z-card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="font-size: 0.85rem;">
                            <thead style="background: #f8fafc;">
                                <tr>
                                    <th style="padding: 0.65rem 1rem; font-weight: 700; color: #374151; border-bottom: 2px solid #e5e7eb;">#</th>
                                    <th style="padding: 0.65rem 1rem; font-weight: 700; color: #374151; border-bottom: 2px solid #e5e7eb;">Name</th>
                                    <th style="padding: 0.65rem 1rem; font-weight: 700; color: #374151; border-bottom: 2px solid #e5e7eb;">Staff No</th>
                                    <th style="padding: 0.65rem 1rem; font-weight: 700; color: #374151; border-bottom: 2px solid #e5e7eb;">Email</th>
                                    <th style="padding: 0.65rem 1rem; font-weight: 700; color: #374151; border-bottom: 2px solid #e5e7eb;">Job Title</th>
                                    <th style="padding: 0.65rem 1rem; font-weight: 700; color: #374151; border-bottom: 2px solid #e5e7eb;">Role in Office</th>
                                    <th style="padding: 0.65rem 1rem; font-weight: 700; color: #374151; border-bottom: 2px solid #e5e7eb; text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $idx => $u)
                                    <tr>
                                        <td style="padding: 0.6rem 1rem; vertical-align: middle;">{{ $users->firstItem() + $idx }}</td>
                                        <td style="padding: 0.6rem 1rem; vertical-align: middle;">
                                            <div class="d-flex align-items-center" style="gap: 0.5rem;">
                                                <div class="ou-avatar">
                                                    {{ strtoupper(substr($u->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <div style="font-weight: 600; color: #111827;">{{ $u->name }}</div>
                                                    @if($u->directorate)
                                                        <div style="font-size: 0.75rem; color: #6b7280;">{{ $u->directorate }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding: 0.6rem 1rem; vertical-align: middle; color: #374151;">{{ $u->staff_no }}</td>
                                        <td style="padding: 0.6rem 1rem; vertical-align: middle; color: #374151;">{{ $u->email }}</td>
                                        <td style="padding: 0.6rem 1rem; vertical-align: middle; color: #374151;">{{ $u->job_title ?? '—' }}</td>
                                        <td style="padding: 0.6rem 1rem; vertical-align: middle;">
                                            @php $role = $u->pivot->role_in_office ?? 'member'; @endphp
                                            @if($role === 'manager')
                                                <span class="ou-role-badge ou-role-manager">
                                                    <i class="fas fa-crown mr-1"></i>Manager
                                                </span>
                                            @elseif($role === 'lead')
                                                <span class="ou-role-badge ou-role-lead">
                                                    <i class="fas fa-star mr-1"></i>Lead
                                                </span>
                                            @else
                                                <span class="ou-role-badge ou-role-member">
                                                    <i class="fas fa-user mr-1"></i>Member
                                                </span>
                                            @endif
                                        </td>
                                        <td style="padding: 0.6rem 1rem; vertical-align: middle; text-align: center;">
                                            <div class="d-flex align-items-center justify-content-center" style="gap: 0.35rem;">
                                                <button wire:click="openEditRole({{ $u->id }})"
                                                        class="btn btn-sm" title="Change role"
                                                        style="background: #eff6ff; color: #2563eb; border-radius: 6px; font-size: 0.78rem; padding: 0.25rem 0.55rem;">
                                                    <span wire:loading wire:target="openEditRole({{ $u->id }})" class="spinner-border spinner-border-sm" role="status"></span>
                                                    <i wire:loading.remove wire:target="openEditRole({{ $u->id }})" class="fas fa-user-tag"></i>
                                                </button>
                                                @if($confirmDetachId === $u->id)
                                                    <button wire:click="detachUser"
                                                            class="btn btn-sm btn-danger"
                                                            style="border-radius: 6px; font-size: 0.78rem; padding: 0.25rem 0.55rem;">
                                                        <span wire:loading wire:target="detachUser" class="spinner-border spinner-border-sm mr-1" role="status"></span>
                                                        <i wire:loading.remove wire:target="detachUser" class="fas fa-check mr-1"></i>Confirm
                                                    </button>
                                                    <button wire:click="cancelDetach"
                                                            class="btn btn-sm"
                                                            style="background: #f3f4f6; color: #6b7280; border-radius: 6px; font-size: 0.78rem; padding: 0.25rem 0.55rem;">
                                                        Cancel
                                                    </button>
                                                @else
                                                    <button wire:click="confirmDetach({{ $u->id }}, '{{ addslashes($u->name) }}')"
                                                            class="btn btn-sm" title="Remove from office"
                                                            style="background: #fef2f2; color: #dc2626; border-radius: 6px; font-size: 0.78rem; padding: 0.25rem 0.55rem;">
                                                        <span wire:loading wire:target="confirmDetach({{ $u->id }}, '{{ addslashes($u->name) }}')" class="spinner-border spinner-border-sm" role="status"></span>
                                                        <i wire:loading.remove wire:target="confirmDetach({{ $u->id }}, '{{ addslashes($u->name) }}')" class="fas fa-user-minus"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="fas fa-users" style="font-size: 2rem; opacity: 0.3;"></i>
                                            <p class="mt-2 mb-0">No users assigned to this office yet.</p>
                                            <button wire:click="openAttachModal" class="btn btn-sm z-btn-primary mt-2">
                                                <i class="fas fa-user-plus mr-1"></i> Add First User
                                            </button>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($users->hasPages())
                        <div class="px-3 py-2" style="border-top: 1px solid #e5e7eb;">
                            {{ $users->links() }}
                        </div>
                    @endif
                </div>
            </div>

            {{-- ══════════════════════════════════ --}}
            {{-- ASSIGNED TASKS                     --}}
            {{-- ══════════════════════════════════ --}}
            <div class="card z-card mt-3">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="gap: 0.5rem;">
                    <h3 class="mb-0" style="font-size: 1rem; font-weight: 700; color: #111827;">
                        <i class="fas fa-tasks mr-2" style="color: var(--z-gold)"></i>Assigned Tasks
                        <span class="z-count ml-1">{{ $tasks->count() }}</span>
                    </h3>
                    <div class="d-flex align-items-center" style="gap: 0.5rem;">
                        <select wire:model="taskFilterStatus" class="form-control form-control-sm"
                                style="border-radius: 8px; border-color: #d1d5db; font-size: 0.82rem; min-width: 140px;">
                            <option value="">Pending & In Progress</option>
                            <option value="pending">Pending Only</option>
                            <option value="in_progress">In Progress Only</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="font-size: 0.85rem;">
                            <thead style="background: #f8fafc;">
                                <tr>
                                    <th style="padding: 0.65rem 1rem; font-weight: 700; color: #374151; border-bottom: 2px solid #e5e7eb;">#</th>
                                    <th style="padding: 0.65rem 1rem; font-weight: 700; color: #374151; border-bottom: 2px solid #e5e7eb;">Task</th>
                                    <th style="padding: 0.65rem 1rem; font-weight: 700; color: #374151; border-bottom: 2px solid #e5e7eb;">Process / Module</th>
                                    <th style="padding: 0.65rem 1rem; font-weight: 700; color: #374151; border-bottom: 2px solid #e5e7eb;">Priority</th>
                                    <th style="padding: 0.65rem 1rem; font-weight: 700; color: #374151; border-bottom: 2px solid #e5e7eb;">Status</th>
                                    <th style="padding: 0.65rem 1rem; font-weight: 700; color: #374151; border-bottom: 2px solid #e5e7eb;">Due Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tasks as $idx => $task)
                                    <tr>
                                        <td style="padding: 0.6rem 1rem; vertical-align: middle; color: #94a3b8;">{{ $idx + 1 }}</td>
                                        <td style="padding: 0.6rem 1rem; vertical-align: middle;">
                                            <div style="font-weight: 600; color: #1a2332;">{{ $task->title }}</div>
                                            @if($task->description)
                                                <div style="font-size: 0.72rem; color: #94a3b8;">{{ Str::limit($task->description, 60) }}</div>
                                            @endif
                                        </td>
                                        <td style="padding: 0.6rem 1rem; vertical-align: middle;">
                                            @if($task->module && $task->module->process)
                                                <div style="font-size: 0.78rem; font-weight: 600; color: #374151;">{{ $task->module->process->name }}</div>
                                                <div style="font-size: 0.72rem; color: #6b7280;">{{ $task->module->name }}</div>
                                            @else
                                                <span style="color: #94a3b8;">—</span>
                                            @endif
                                        </td>
                                        <td style="padding: 0.6rem 1rem; vertical-align: middle;">
                                            <span class="tm-priority-badge" style="background: {{ $task->priority_color }}20; color: {{ $task->priority_color }}; border: 1px solid {{ $task->priority_color }}40;">
                                                {{ ucfirst($task->priority) }}
                                            </span>
                                        </td>
                                        <td style="padding: 0.6rem 1rem; vertical-align: middle;">
                                            <span class="tm-status-badge" style="background: {{ $task->status_color }}20; color: {{ $task->status_color }}; border: 1px solid {{ $task->status_color }}40;">
                                                {{ str_replace('_', ' ', ucfirst($task->status)) }}
                                            </span>
                                        </td>
                                        <td style="padding: 0.6rem 1rem; vertical-align: middle; font-size: 0.82rem;">
                                            @if($task->due_date)
                                                <span class="{{ $task->is_overdue ? 'text-danger font-weight-bold' : 'text-muted' }}">
                                                    {{ $task->due_date->format('M d, Y') }}
                                                </span>
                                                @if($task->is_overdue)
                                                    <div style="font-size: 0.65rem; color: #dc2626;"><i class="fas fa-exclamation-circle"></i> Overdue</div>
                                                @endif
                                            @else
                                                <span style="color: #94a3b8;">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            <i class="fas fa-clipboard-check" style="font-size: 2rem; opacity: 0.3;"></i>
                                            <p class="mt-2 mb-0">
                                                @if($taskFilterStatus === 'completed')
                                                    No completed tasks for this office.
                                                @else
                                                    No pending tasks assigned to this office.
                                                @endif
                                            </p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════ --}}
    {{-- ATTACH USER MODAL                  --}}
    {{-- ══════════════════════════════════ --}}
    @if($showAttachModal)
        <div class="ou-modal-backdrop" wire:click.self="closeAttachModal">
            <div class="ou-modal" style="max-width: 540px;">
                <div class="ou-modal-header">
                    <h5><i class="fas fa-user-plus mr-2"></i>Add User to Office</h5>
                    <button wire:click="closeAttachModal" class="ou-modal-close">&times;</button>
                </div>
                <div class="ou-modal-body">
                    {{-- Search available users --}}
                    <div class="form-group">
                        <label style="font-weight: 600; font-size: 0.82rem; color: #374151;">Search User</label>
                        <input type="text" wire:model.debounce.300ms="userSearch"
                               class="form-control form-control-sm"
                               placeholder="Type name, email or staff no…"
                               style="border-radius: 8px; border-color: #d1d5db;">
                    </div>

                    {{-- User list --}}
                    <div style="max-height: 240px; overflow-y: auto; border: 1px solid #e5e7eb; border-radius: 8px; margin-bottom: 1rem;">
                        @forelse($availableUsers as $au)
                            <label class="ou-user-option {{ $selectedUserId == $au->id ? 'ou-user-option-selected' : '' }}"
                                   wire:click="$set('selectedUserId', {{ $au->id }})">
                                <div class="d-flex align-items-center" style="gap: 0.5rem;">
                                    <div class="ou-avatar-sm">{{ strtoupper(substr($au->name, 0, 1)) }}</div>
                                    <div>
                                        <div style="font-weight: 600; font-size: 0.82rem; color: #111827;">{{ $au->name }}</div>
                                        <div style="font-size: 0.72rem; color: #6b7280;">
                                            {{ $au->staff_no }} &middot; {{ $au->email }}
                                            @if($au->job_title) &middot; {{ $au->job_title }} @endif
                                        </div>
                                    </div>
                                </div>
                                @if($selectedUserId == $au->id)
                                    <i class="fas fa-check-circle" style="color: var(--z-green); font-size: 1.1rem;"></i>
                                @endif
                            </label>
                        @empty
                            <div class="text-center text-muted py-3" style="font-size: 0.82rem;">
                                @if($userSearch)
                                    No matching users found.
                                @else
                                    Type to search for users.
                                @endif
                            </div>
                        @endforelse
                    </div>

                    {{-- Role --}}
                    <div class="form-group">
                        <label style="font-weight: 600; font-size: 0.82rem; color: #374151;">Role in Office</label>
                        <select wire:model="selectedRole" class="form-control form-control-sm"
                                style="border-radius: 8px; border-color: #d1d5db;">
                            <option value="member">Member</option>
                            <option value="lead">Lead</option>
                            <option value="manager">Manager</option>
                        </select>
                    </div>
                </div>
                <div class="ou-modal-footer">
                    <button wire:click="closeAttachModal" class="btn btn-sm" style="background: #f3f4f6; color: #374151; border-radius: 8px; padding: 0.4rem 1rem;">
                        Cancel
                    </button>
                    <button wire:click="attachUser" class="btn btn-sm z-btn-primary"
                            @if(!$selectedUserId) disabled @endif>
                        <i class="fas fa-user-plus mr-1"></i> Add to Office
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- ══════════════════════════════════ --}}
    {{-- EDIT ROLE MODAL                    --}}
    {{-- ══════════════════════════════════ --}}
    @if($showEditRoleModal)
        <div class="ou-modal-backdrop" wire:click.self="closeEditRoleModal">
            <div class="ou-modal" style="max-width: 420px;">
                <div class="ou-modal-header">
                    <h5><i class="fas fa-user-tag mr-2"></i>Change Role</h5>
                    <button wire:click="closeEditRoleModal" class="ou-modal-close">&times;</button>
                </div>
                <div class="ou-modal-body">
                    <p style="font-size: 0.85rem; color: #374151;">
                        Update role for <strong>{{ $editUserName }}</strong>
                    </p>
                    <div class="form-group">
                        <label style="font-weight: 600; font-size: 0.82rem; color: #374151;">Role in Office</label>
                        <select wire:model="editRole" class="form-control form-control-sm"
                                style="border-radius: 8px; border-color: #d1d5db;">
                            <option value="member">Member</option>
                            <option value="lead">Lead</option>
                            <option value="manager">Manager</option>
                        </select>
                    </div>
                </div>
                <div class="ou-modal-footer">
                    <button wire:click="closeEditRoleModal" class="btn btn-sm" style="background: #f3f4f6; color: #374151; border-radius: 8px; padding: 0.4rem 1rem;">
                        Cancel
                    </button>
                    <button wire:click="updateRole" class="btn btn-sm z-btn-primary">
                        <i class="fas fa-save mr-1"></i> Save
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
