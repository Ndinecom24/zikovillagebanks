<div>
    @php
        $task = $progress->processTask;
        $cp   = $progress->clientProcess;
        $client = $cp->client ?? null;
        $process = $cp->process ?? null;
        $stage   = $task->stage ?? null;

        $statusConfig = [
            'pending'     => ['icon' => 'far fa-circle',       'color' => '#f59e0b', 'bg' => '#fffbeb',  'label' => 'Pending',     'textColor' => '#92400e'],
            'in_progress' => ['icon' => 'fas fa-spinner',      'color' => '#3b82f6', 'bg' => '#eff6ff',  'label' => 'In Progress', 'textColor' => '#1e40af'],
            'completed'   => ['icon' => 'fas fa-check-circle', 'color' => '#10b981', 'bg' => '#ecfdf5',  'label' => 'Completed',   'textColor' => '#065f46'],
            'skipped'     => ['icon' => 'fas fa-forward',      'color' => '#6b7280', 'bg' => '#f3f4f6',  'label' => 'Skipped',     'textColor' => '#374151'],
        ];
        $sCfg = $statusConfig[$progress->status] ?? $statusConfig['pending'];
    @endphp

    {{-- ===== Page Header ===== --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="z-page-header">
                <div class="d-flex align-items-center justify-content-between flex-wrap" style="gap: 1rem;">
                    <div>
                        <h1 style="font-size: 1.3rem;">
                            <i class="fas fa-bolt mr-2" style="color: var(--z-gold);"></i>
                            {{ $task->title ?? 'Task' }}
                        </h1>
                        <p style="display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap; margin: 0;">
                            <span
                                style="display: inline-flex; align-items: center; gap: 0.3rem; background: {{ $sCfg['bg'] }}; color: {{ $sCfg['color'] }}; font-size: 0.75rem; font-weight: 600; padding: 0.2rem 0.6rem; border-radius: 20px;">
                                <i class="{{ $sCfg['icon'] }}"></i> {{ $sCfg['label'] }}
                            </span>
                            @if($client)
                                <span style="opacity: 0.7;">&bull;</span>
                                <span>{{ $client->company_name }}</span>
                            @endif
                            @if($process)
                                <span style="opacity: 0.7;">&bull;</span>
                                <span>{{ $process->name }}</span>
                            @endif
                            @if($stage)
                                <span style="opacity: 0.7;">&bull;</span>
                                <span>{{ $stage->name }}</span>
                            @endif
                        </p>
                    </div>
                    <div class="d-flex" style="gap: 0.5rem;">
                        <a href="{{ route('client-tasks.index') }}" class="btn btn-sm"
                           style="background: rgba(255,255,255,0.15); color: #fff; border-radius: 8px; font-weight: 600; padding: 0.4rem 1rem; font-size: 0.82rem;">
                            <i class="fas fa-arrow-left mr-1"></i> All Tasks
                        </a>

                        <a class="btn btn-sm"
                           style="background: rgba(255,255,255,0.15); color: #fff; border-radius: 8px; font-weight: 600; padding: 0.4rem 1rem; font-size: 0.82rem;"
                           data-toggle="modal" data-target="#createIppApplication">
                            <i class="fas fa-file mr-1"></i> Create Application
                        </a>
                        @if($client)
                            <a href="{{ route('clients.show', $client->id) }}" class="btn btn-sm"
                               style="background: rgba(255,255,255,0.15); color: #fff; border-radius: 8px; font-weight: 600; padding: 0.4rem 1rem; font-size: 0.82rem;">
                                <i class="fas fa-user-tie mr-1"></i> Client
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== Content ===== --}}
    <section class="content">
        <div class="container-fluid">

            {{-- Flash --}}
            @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show"
                     style="border-radius: 10px; font-size: 0.85rem; border: none; background: linear-gradient(135deg, #ecfdf5, #d1fae5); color: #065f46;">
                    <i class="fas fa-check-circle mr-1"></i> {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif

            <div class="row">
                {{-- ════════ LEFT: Task Details & Actions ════════ --}}
                <div class="col-lg-8">

                    {{-- Action Card --}}
                    <div class="card z-card mb-3">
                        <div class="card-header d-flex align-items-center justify-content-between py-2">
                            <div class="d-flex align-items-center" style="gap: 0.5rem;">
                                <div
                                    style="width: 32px; height: 32px; border-radius: 8px; background: linear-gradient(135deg, {{ $sCfg['color'] }}, {{ $sCfg['color'] }}bb); display: flex; align-items: center; justify-content: center;">
                                    <i class="{{ $sCfg['icon'] }}" style="color: #fff; font-size: 0.75rem;"></i>
                                </div>
                                <h3 class="mb-0" style="font-size: 0.9rem; font-weight: 600;">Task Action</h3>
                            </div>
                            <span
                                style="font-size: 0.72rem; font-weight: 600; color: {{ $sCfg['color'] }}; background: {{ $sCfg['bg'] }}; padding: 0.2rem 0.6rem; border-radius: 10px;">{{ $sCfg['label'] }}</span>
                        </div>
                        <div class="card-body">
                            {{-- Status update buttons --}}
                            <div
                                style="font-size: 0.68rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem;">
                                Change Status
                            </div>
                            <div class="d-flex flex-wrap" style="gap: 0.4rem; margin-bottom: 1rem;">
                                @if($progress->status !== 'pending')
                                    <button wire:click="resetToPending" class="btn btn-sm"
                                            style="background: #fffbeb; color: #92400e; border: 1.5px solid #fde68a; border-radius: 8px; font-weight: 600; font-size: 0.78rem; padding: 0.35rem 0.85rem;">
                                        <i class="far fa-circle mr-1"></i> Reset to Pending
                                    </button>
                                @endif
                                @if($progress->status !== 'in_progress')
                                    <button wire:click="markInProgress" class="btn btn-sm"
                                            style="background: #eff6ff; color: #1e40af; border: 1.5px solid #bfdbfe; border-radius: 8px; font-weight: 600; font-size: 0.78rem; padding: 0.35rem 0.85rem;">
                                        <i class="fas fa-play mr-1"></i> Mark In Progress
                                    </button>
                                @endif
                                @if($progress->status !== 'completed')
                                    <button wire:click="markComplete" class="btn btn-sm"
                                            style="background: #ecfdf5; color: #065f46; border: 1.5px solid #a7f3d0; border-radius: 8px; font-weight: 600; font-size: 0.78rem; padding: 0.35rem 0.85rem;">
                                        <i class="fas fa-check mr-1"></i> Mark Complete
                                    </button>
                                @endif
                                @if($progress->status !== 'skipped')
                                    <button wire:click="skipTask" class="btn btn-sm"
                                            style="background: #f3f4f6; color: #374151; border: 1.5px solid #d1d5db; border-radius: 8px; font-weight: 600; font-size: 0.78rem; padding: 0.35rem 0.85rem;">
                                        <i class="fas fa-forward mr-1"></i> Skip
                                    </button>
                                @endif
                            </div>

                            <div style="height: 1px; background: #e2e8f0; margin: 0.75rem 0;"></div>

                            {{-- Remarks --}}
                            <div
                                style="font-size: 0.68rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.35rem;">
                                <i class="fas fa-comment-dots mr-1"></i>Remarks / Notes
                            </div>
                            <div class="d-flex" style="gap: 0.5rem;">
                                <textarea wire:model.defer="newRemarks" rows="2" class="form-control"
                                          placeholder="Add remarks, observations, or notes about this task..."
                                          style="font-size: 0.82rem; border-radius: 8px; border: 1.5px solid #e2e8f0; resize: vertical;"></textarea>
                                <button wire:click="saveRemarks" class="btn btn-sm align-self-end"
                                        style="background: linear-gradient(135deg, var(--z-green), var(--z-green-dark)); color: #fff; border: none; border-radius: 8px; font-weight: 600; font-size: 0.78rem; padding: 0.4rem 0.85rem; white-space: nowrap;">
                                    <i class="fas fa-save mr-1"></i> Save
                                </button>
                            </div>

                            {{-- Completion info --}}
                            @if($progress->status === 'completed' && $progress->completedByUser)
                                <div
                                    style="margin-top: 0.75rem; background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 10px; padding: 0.6rem 0.85rem;">
                                    <div class="d-flex align-items-center" style="gap: 0.5rem;">
                                        <i class="fas fa-check-circle" style="color: #059669; font-size: 1rem;"></i>
                                        <div>
                                            <div style="font-size: 0.78rem; font-weight: 600; color: #065f46;">
                                                Completed by {{ $progress->completedByUser->name }}
                                            </div>
                                            @if($progress->completed_at)
                                                <div
                                                    style="font-size: 0.7rem; color: #047857;">{{ $progress->completed_at->format('d M Y \a\t H:i') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Task Description Card --}}
                    <div class="card z-card mb-3">
                        <div class="card-header py-2">
                            <h3 class="mb-0" style="font-size: 0.9rem; font-weight: 600;"><i
                                    class="fas fa-info-circle mr-1" style="color: #3b82f6;"></i> Task Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div
                                        style="font-size: 0.65rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.2rem;">
                                        Title
                                    </div>
                                    <div
                                        style="font-size: 0.95rem; font-weight: 700; color: #1a2332;">{{ $task->title }}</div>
                                </div>
                                @if($task->description)
                                    <div class="col-md-12 mb-3">
                                        <div
                                            style="font-size: 0.65rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.2rem;">
                                            Description
                                        </div>
                                        <div
                                            style="font-size: 0.82rem; color: #374151; line-height: 1.6;">{{ $task->description }}</div>
                                    </div>
                                @endif
                                <div class="col-md-4 mb-2">
                                    <div
                                        style="font-size: 0.65rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.2rem;">
                                        Order / Step
                                    </div>
                                    <span class="z-badge-orange"
                                          style="font-size: 0.78rem;">Step {{ $task->order_number }}</span>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <div
                                        style="font-size: 0.65rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.2rem;">
                                        Max Duration
                                    </div>
                                    @if($task->max_days)
                                        <span
                                            style="font-size: 0.82rem; font-weight: 600; color: var(--z-orange-dark);"><i
                                                class="fas fa-clock mr-1"></i>{{ $task->max_days_label }}</span>
                                    @else
                                        <span style="color: #94a3b8;">Not specified</span>
                                    @endif
                                </div>
                                <div class="col-md-4 mb-2">
                                    <div
                                        style="font-size: 0.65rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.2rem;">
                                        Created By
                                    </div>
                                    <div
                                        style="font-size: 0.82rem; color: #374151;">{{ $task->creator->name ?? '—' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Responsible Offices & Personnel --}}
                    <div class="card z-card mb-3">
                        <div class="card-header py-2">
                            <h3 class="mb-0" style="font-size: 0.9rem; font-weight: 600;"><i
                                    class="fas fa-building mr-1" style="color: #6366f1;"></i> Responsible Offices &
                                Personnel</h3>
                        </div>
                        <div class="card-body" style="padding: 0.75rem;">
                            @if($task->offices && $task->offices->count() > 0)
                                @foreach($task->offices as $office)
                                    <div
                                        style="border: 1px solid #e2e8f0; border-radius: 10px; margin-bottom: 0.5rem; overflow: hidden;">
                                        {{-- Office header --}}
                                        <div
                                            style="padding: 0.55rem 0.75rem; background: #f8fafc; display: flex; align-items: center; justify-content: space-between;">
                                            <div class="d-flex align-items-center" style="gap: 0.4rem;">
                                                <div
                                                    style="width: 28px; height: 28px; border-radius: 7px; background: linear-gradient(135deg, #6366f1, #4f46e5); display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-building"
                                                       style="color: #fff; font-size: 0.6rem;"></i>
                                                </div>
                                                <span
                                                    style="font-size: 0.85rem; font-weight: 600; color: #1a2332;">{{ $office->responsible_office }}</span>
                                            </div>
                                            @php
                                                $oStatus = $office->pivot->status ?? 'pending';
                                                $oColor  = match($oStatus) { 'completed' => '#10b981', 'acknowledged' => '#3b82f6', default => '#f59e0b' };
                                            @endphp
                                            <span
                                                style="font-size: 0.68rem; font-weight: 600; color: {{ $oColor }}; background: {{ $oColor }}15; padding: 0.1rem 0.45rem; border-radius: 8px;">{{ ucfirst($oStatus) }}</span>
                                        </div>
                                        {{-- Users --}}
                                        <div style="padding: 0.55rem 0.75rem;">
                                            @if($office->users && $office->users->count() > 0)
                                                <div
                                                    style="font-size: 0.62rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.35rem;">
                                                    <i class="fas fa-users mr-1"></i>Personnel
                                                    ({{ $office->users->count() }})
                                                </div>
                                                @foreach($office->users as $user)
                                                    <div
                                                        style="display: flex; align-items: center; gap: 0.5rem; padding: 0.4rem 0; {{ !$loop->last ? 'border-bottom: 1px solid #f1f5f9;' : '' }}">
                                                        <div
                                                            style="width: 30px; height: 30px; border-radius: 50%; background: linear-gradient(135deg, var(--z-green), var(--z-green-dark)); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 0.55rem; font-weight: 700; flex-shrink: 0;">
                                                            {{ strtoupper(substr($user->name ?? 'U', 0, 2)) }}
                                                        </div>
                                                        <div style="flex: 1;">
                                                            <div
                                                                style="font-size: 0.82rem; font-weight: 600; color: #1a2332;">{{ $user->name }}</div>
                                                            <div style="font-size: 0.7rem; color: #94a3b8;">
                                                                {{ $user->email ?? '' }}
                                                                @if($user->pivot && $user->pivot->role_in_office)
                                                                &bull; <span
                                                                    style="color: #6366f1; font-weight: 600;">{{ $user->pivot->role_in_office }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="text-center py-2"
                                                     style="color: #cbd5e1; font-size: 0.78rem; font-style: italic;">
                                                    <i class="fas fa-user-slash mr-1"></i> No users assigned to this
                                                    office
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-3"
                                     style="background: #f8fafc; border-radius: 10px; border: 1px dashed #e2e8f0; color: #94a3b8; font-size: 0.82rem;">
                                    <i class="fas fa-building d-block mb-1"
                                       style="font-size: 1.5rem; opacity: 0.3;"></i>
                                    No offices pre-assigned to this task.
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- ═══════ Comments ═══════ --}}
                    <div class="card z-card mb-3">
                        <div class="card-header d-flex align-items-center justify-content-between py-2">
                            <h3 class="mb-0" style="font-size: 0.9rem; font-weight: 600;">
                                <i class="fas fa-comments mr-1" style="color: #f59e0b;"></i> Comments
                                <span class="z-count">{{ $progress->comments->count() }}</span>
                            </h3>
                        </div>
                        <div class="card-body" style="padding: 0.75rem;">
                            {{-- Add comment form --}}
                            <div style="margin-bottom: 0.75rem;">
                                <div class="d-flex" style="gap: 0.5rem;">
                                    <div
                                        style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, var(--z-green), var(--z-green-dark)); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 0.55rem; font-weight: 700; flex-shrink: 0;">
                                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
                                    </div>
                                    <div style="flex: 1;">
                                        <textarea wire:model.defer="commentBody" rows="2" class="form-control"
                                                  placeholder="Write a comment..."
                                                  style="font-size: 0.82rem; border-radius: 8px; border: 1.5px solid #e2e8f0; resize: vertical;"></textarea>
                                        @error('commentBody') <span
                                            style="font-size: 0.7rem; color: #dc2626;">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-2">
                                    <button wire:click="addComment" class="btn btn-sm"
                                            style="background: linear-gradient(135deg, var(--z-green), var(--z-green-dark)); color: #fff; border: none; border-radius: 8px; font-weight: 600; font-size: 0.78rem; padding: 0.35rem 0.85rem;">
                                        <i class="fas fa-paper-plane mr-1"></i> Post Comment
                                    </button>
                                </div>
                            </div>

                            @if($progress->comments->count() > 0)
                                <div style="height: 1px; background: #e2e8f0; margin: 0.5rem 0 0.75rem;"></div>
                            @endif

                            {{-- Comment list --}}
                            <div style="max-height: 500px; overflow-y: auto;">
                                @forelse($progress->comments->sortByDesc('created_at') as $comment)
                                    <div
                                        style="display: flex; gap: 0.5rem; margin-bottom: 0.85rem; {{ !$loop->last ? 'padding-bottom: 0.85rem; border-bottom: 1px solid #f1f5f9;' : '' }}">
                                        <div
                                            style="width: 30px; height: 30px; border-radius: 50%; background: linear-gradient(135deg, #6366f1, #4f46e5); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 0.5rem; font-weight: 700; flex-shrink: 0;">
                                            {{ strtoupper(substr($comment->user->name ?? 'U', 0, 2)) }}
                                        </div>
                                        <div style="flex: 1; min-width: 0;">
                                            <div class="d-flex align-items-center justify-content-between"
                                                 style="gap: 0.5rem;">
                                                <div>
                                                    <span
                                                        style="font-size: 0.82rem; font-weight: 600; color: #1a2332;">{{ $comment->user->name ?? 'Unknown' }}</span>
                                                    <span
                                                        style="font-size: 0.68rem; color: #94a3b8; margin-left: 0.3rem;">{{ $comment->created_at->diffForHumans() }}</span>
                                                </div>
                                                @if($comment->user_id === auth()->id())
                                                    <div class="d-flex" style="gap: 0.25rem;">
                                                        <button wire:click="startEditComment({{ $comment->id }})"
                                                                class="btn btn-sm p-0"
                                                                style="color: #94a3b8; font-size: 0.7rem;" title="Edit">
                                                            <i class="fas fa-pen"></i>
                                                        </button>
                                                        <button wire:click="deleteComment({{ $comment->id }})"
                                                                class="btn btn-sm p-0"
                                                                style="color: #ef4444; font-size: 0.7rem;"
                                                                title="Delete"
                                                                onclick="return confirm('Delete this comment?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>

                                            @if($editingCommentId === $comment->id)
                                                <div style="margin-top: 0.3rem;">
                                                    <textarea wire:model.defer="editCommentBody" rows="2"
                                                              class="form-control"
                                                              style="font-size: 0.82rem; border-radius: 8px; border: 1.5px solid #e2e8f0; resize: vertical;"></textarea>
                                                    @error('editCommentBody') <span
                                                        style="font-size: 0.7rem; color: #dc2626;">{{ $message }}</span> @enderror
                                                    <div class="d-flex" style="gap: 0.3rem; margin-top: 0.3rem;">
                                                        <button wire:click="updateComment" class="btn btn-sm"
                                                                style="background: var(--z-green); color: #fff; border: none; border-radius: 6px; font-size: 0.72rem; font-weight: 600; padding: 0.25rem 0.6rem;">
                                                            <i class="fas fa-check mr-1"></i> Save
                                                        </button>
                                                        <button wire:click="cancelEditComment" class="btn btn-sm"
                                                                style="background: #f3f4f6; color: #374151; border: none; border-radius: 6px; font-size: 0.72rem; font-weight: 600; padding: 0.25rem 0.6rem;">
                                                            Cancel
                                                        </button>
                                                    </div>
                                                </div>
                                            @else
                                                <div
                                                    style="font-size: 0.82rem; color: #374151; line-height: 1.5; margin-top: 0.2rem; white-space: pre-line;">{{ $comment->body }}</div>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-3"
                                         style="color: #cbd5e1; font-size: 0.78rem; font-style: italic;">
                                        <i class="far fa-comment-dots d-block mb-1"
                                           style="font-size: 1.3rem; opacity: 0.4;"></i>
                                        No comments yet. Be the first to add one.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    {{-- ═══════ Files / Attachments ═══════ --}}
                    <div class="card z-card mb-3">
                        <div class="card-header d-flex align-items-center justify-content-between py-2">
                            <h3 class="mb-0" style="font-size: 0.9rem; font-weight: 600;">
                                <i class="fas fa-paperclip mr-1" style="color: #3b82f6;"></i> Attachments
                                <span class="z-count">{{ $progress->files->count() }}</span>
                            </h3>
                            <button wire:click="openUploadModal" class="btn btn-sm"
                                    style="background: linear-gradient(135deg, var(--z-green), var(--z-green-dark)); color: #fff; border: none; border-radius: 8px; font-weight: 600; font-size: 0.72rem; padding: 0.3rem 0.7rem;">
                                <i class="fas fa-upload mr-1"></i> Upload Files
                            </button>
                        </div>
                        <div class="card-body" style="padding: 0.75rem;">
                            @if($progress->files->count() > 0)
                                <div style="display: grid; gap: 0.5rem;">
                                    @foreach($progress->files->sortByDesc('created_at') as $taskFile)
                                        <div
                                            style="display: flex; align-items: center; gap: 0.6rem; padding: 0.55rem 0.65rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; transition: border-color 0.15s;"
                                            onmouseover="this.style.borderColor='#cbd5e1'"
                                            onmouseout="this.style.borderColor='#e2e8f0'">
                                            {{-- File icon --}}
                                            <div
                                                style="width: 36px; height: 36px; border-radius: 8px; background: #fff; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                <i class="{{ $taskFile->icon_class }}" style="font-size: 1rem;"></i>
                                            </div>
                                            {{-- File info --}}
                                            <div style="flex: 1; min-width: 0;">
                                                <div
                                                    style="font-size: 0.82rem; font-weight: 600; color: #1a2332; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
                                                    title="{{ $taskFile->original_name }}">
                                                    {{ $taskFile->original_name }}
                                                </div>
                                                <div style="font-size: 0.68rem; color: #94a3b8;">
                                                    {{ $taskFile->human_size }} &bull; {{ strtoupper($taskFile->ext) }}
                                                    &bull; by {{ $taskFile->uploader->name ?? '—' }}
                                                    &bull; {{ $taskFile->created_at->diffForHumans() }}
                                                </div>
                                                @if($taskFile->description)
                                                    <div
                                                        style="font-size: 0.72rem; color: #64748b; margin-top: 0.1rem;">{{ $taskFile->description }}</div>
                                                @endif
                                            </div>
                                            {{-- Actions --}}
                                            <div class="d-flex" style="gap: 0.2rem; flex-shrink: 0;">
                                                <button wire:click="downloadFile({{ $taskFile->id }})"
                                                        class="btn btn-sm p-0"
                                                        style="color: #3b82f6; font-size: 0.8rem; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; border-radius: 6px;"
                                                        title="Download" onmouseover="this.style.background='#eff6ff'"
                                                        onmouseout="this.style.background='transparent'">
                                                    <i class="fas fa-download"></i>
                                                </button>
                                                <button wire:click="deleteFile({{ $taskFile->id }})"
                                                        class="btn btn-sm p-0"
                                                        style="color: #ef4444; font-size: 0.8rem; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; border-radius: 6px;"
                                                        title="Delete" onclick="return confirm('Delete this file?')"
                                                        onmouseover="this.style.background='#fef2f2'"
                                                        onmouseout="this.style.background='transparent'">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-3"
                                     style="background: #f8fafc; border-radius: 10px; border: 1px dashed #e2e8f0; color: #94a3b8; font-size: 0.82rem;">
                                    <i class="fas fa-cloud-upload-alt d-block mb-1"
                                       style="font-size: 1.5rem; opacity: 0.3;"></i>
                                    No files attached yet.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- ════════ RIGHT: Context & Siblings ════════ --}}
                <div class="col-lg-4">

                    {{-- Client & Process Info --}}
                    <div class="card z-card mb-3">
                        <div class="card-header py-2">
                            <h3 class="mb-0" style="font-size: 0.9rem; font-weight: 600;"><i class="fas fa-sitemap mr-1"
                                                                                             style="color: #8b5cf6;"></i>
                                Context</h3>
                        </div>
                        <div class="card-body" style="padding: 0.75rem;">
                            {{-- Client --}}
                            @if($client)
                                <div
                                    style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 0.6rem 0.75rem; margin-bottom: 0.5rem;">
                                    <div
                                        style="font-size: 0.6rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.15rem;">
                                        Client
                                    </div>
                                    <div class="d-flex align-items-center" style="gap: 0.4rem;">
                                        <div
                                            style="width: 24px; height: 24px; border-radius: 6px; background: linear-gradient(135deg, var(--z-green), var(--z-green-dark)); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 0.5rem; font-weight: 700;">
                                            {{ strtoupper(substr($client->company_name, 0, 2)) }}
                                        </div>
                                        <a href="{{ route('clients.show', $client->id) }}"
                                           style="font-size: 0.82rem; font-weight: 600; color: #1a2332; text-decoration: none;"
                                           onmouseover="this.style.color='var(--z-green)'"
                                           onmouseout="this.style.color='#1a2332'">
                                            {{ $client->company_name }}
                                        </a>
                                    </div>
                                </div>
                            @endif

                            {{-- Process --}}
                            @if($process)
                                <div
                                    style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 0.6rem 0.75rem; margin-bottom: 0.5rem;">
                                    <div
                                        style="font-size: 0.6rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.15rem;">
                                        Process
                                    </div>
                                    <div
                                        style="font-size: 0.82rem; font-weight: 600; color: #1a2332;">{{ $process->name }}</div>
                                    @if($process->description)
                                        <div
                                            style="font-size: 0.7rem; color: #64748b; margin-top: 0.1rem;">{{ Str::limit($process->description, 60) }}</div>
                                    @endif
                                    {{-- Progress --}}
                                    @php $pp = $this->processProgress; @endphp
                                    <div class="d-flex align-items-center mt-2" style="gap: 0.4rem;">
                                        <div
                                            style="flex: 1; height: 6px; border-radius: 6px; background: #e2e8f0; overflow: hidden;">
                                            <div
                                                style="height: 100%; width: {{ $pp['percent'] }}%; background: {{ $pp['percent'] === 100 ? '#10b981' : 'var(--z-green)' }}; border-radius: 6px;"></div>
                                        </div>
                                        <span style="font-size: 0.7rem; font-weight: 700; color: #64748b;">{{ $pp['percent'] }}%</span>
                                    </div>
                                    <div
                                        style="font-size: 0.65rem; color: #94a3b8; margin-top: 0.1rem;">{{ $pp['done'] }}
                                        /{{ $pp['total'] }} tasks completed
                                    </div>
                                </div>
                            @endif

                            {{-- Stage --}}
                            @if($stage)
                                <div
                                    style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 0.6rem 0.75rem;">
                                    <div
                                        style="font-size: 0.6rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.15rem;">
                                        Stage
                                    </div>
                                    <div class="d-flex align-items-center" style="gap: 0.35rem;">
                                        <div
                                            style="width: 20px; height: 20px; border-radius: 6px; background: linear-gradient(135deg, #8b5cf6, #6d28d9); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 0.55rem; font-weight: 700;">
                                            {{ $stage->order ?? '?' }}
                                        </div>
                                        <span
                                            style="font-size: 0.82rem; font-weight: 600; color: #1a2332;">{{ $stage->name }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Sibling tasks in same stage --}}
                    <div class="card z-card mb-3">
                        <div class="card-header py-2">
                            <h3 class="mb-0" style="font-size: 0.9rem; font-weight: 600;">
                                <i class="fas fa-list-check mr-1" style="color: var(--z-green);"></i>
                                Stage Tasks
                                @if($stage)
                                    <span class="z-count">{{ $this->siblingTasks->count() }}</span>
                                @endif
                            </h3>
                        </div>
                        <div class="card-body p-0" style="max-height: 400px; overflow-y: auto;">
                            @forelse($this->siblingTasks as $sib)
                                @php
                                    $sibTask = $sib->processTask;
                                    $isCurrent = $sib->id === $progress->id;
                                    $sibCfg = $statusConfig[$sib->status] ?? $statusConfig['pending'];
                                @endphp
                                <a href="{{ route('client-tasks.show', $sib->id) }}"
                                   style="display: flex; align-items: center; gap: 0.5rem; padding: 0.55rem 0.85rem; border-bottom: 1px solid #f1f5f9; text-decoration: none; transition: background 0.1s; {{ $isCurrent ? 'background: #f0fdf4; border-left: 3px solid var(--z-green);' : '' }}"
                                   onmouseover="this.style.background='{{ $isCurrent ? '#f0fdf4' : '#fafbfc' }}'"
                                   onmouseout="this.style.background='{{ $isCurrent ? '#f0fdf4' : '#fff' }}'">
                                    <i class="{{ $sibCfg['icon'] }}"
                                       style="color: {{ $sibCfg['color'] }}; font-size: 0.8rem; flex-shrink: 0;"></i>
                                    <div style="flex: 1; min-width: 0;">
                                        <div
                                            style="font-size: 0.78rem; font-weight: {{ $isCurrent ? '700' : '500' }}; color: {{ $sib->status === 'completed' ? '#94a3b8' : '#1a2332' }}; {{ $sib->status === 'completed' ? 'text-decoration: line-through;' : '' }} white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                            {{ $sibTask->title ?? 'Task' }}
                                        </div>
                                    </div>
                                    <span
                                        style="font-size: 0.58rem; font-weight: 600; color: {{ $sibCfg['color'] }}; background: {{ $sibCfg['bg'] }}; padding: 0.05rem 0.35rem; border-radius: 8px; white-space: nowrap; flex-shrink: 0;">{{ $sibCfg['label'] }}</span>
                                </a>
                            @empty
                                <div class="text-center py-3" style="color: #94a3b8; font-size: 0.78rem;">No sibling
                                    tasks
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- Timestamps --}}
                    <div class="card z-card">
                        <div class="card-header py-2">
                            <h3 class="mb-0" style="font-size: 0.9rem; font-weight: 600;"><i class="fas fa-clock mr-1"
                                                                                             style="color: #94a3b8;"></i>
                                Timeline</h3>
                        </div>
                        <div class="card-body" style="padding: 0.75rem;">
                            <div style="font-size: 0.75rem;">
                                <div class="d-flex justify-content-between mb-1">
                                    <span style="color: #94a3b8;">Task Created</span>
                                    <span
                                        style="color: #374151; font-weight: 600;">{{ $progress->created_at ? $progress->created_at->format('d M Y H:i') : '—' }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span style="color: #94a3b8;">Last Updated</span>
                                    <span
                                        style="color: #374151; font-weight: 600;">{{ $progress->updated_at ? $progress->updated_at->format('d M Y H:i') : '—' }}</span>
                                </div>
                                @if($progress->completed_at)
                                    <div class="d-flex justify-content-between mb-1">
                                        <span style="color: #94a3b8;">Completed At</span>
                                        <span
                                            style="color: #059669; font-weight: 600;">{{ $progress->completed_at->format('d M Y H:i') }}</span>
                                    </div>
                                @endif
                                @if($cp && $cp->started_at)
                                    <div style="height: 1px; background: #f1f5f9; margin: 0.4rem 0;"></div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span style="color: #94a3b8;">Process Started</span>
                                        <span
                                            style="color: #374151; font-weight: 600;">{{ $cp->started_at->format('d M Y') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════ Upload Files Modal ═══════ --}}
    @if($showUploadModal)
        <div
            style="position: fixed; inset: 0; z-index: 1050; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.5); backdrop-filter: blur(3px);">
            <div
                style="background: #fff; border-radius: 14px; width: 95%; max-width: 520px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); overflow: hidden;">
                {{-- Header --}}
                <div
                    style="padding: 0.85rem 1.1rem; background: linear-gradient(135deg, #1a2332, #0f172a); color: #fff; display: flex; align-items: center; justify-content: space-between;">
                    <h5 style="margin: 0; font-size: 0.95rem; font-weight: 700;">
                        <i class="fas fa-cloud-upload-alt mr-2" style="color: var(--z-gold);"></i> Upload Files
                    </h5>
                    <button wire:click="closeUploadModal" class="btn btn-sm p-0"
                            style="color: rgba(255,255,255,0.7); font-size: 1.2rem; line-height: 1;">&times;
                    </button>
                </div>
                {{-- Body --}}
                <div style="padding: 1.1rem;">
                    <div style="margin-bottom: 0.85rem;">
                        <label
                            style="font-size: 0.72rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.03em; display: block; margin-bottom: 0.3rem;">
                            <i class="fas fa-file mr-1"></i> Select Files
                        </label>
                        <input type="file" wire:model="uploadFiles" multiple
                               style="font-size: 0.82rem; border: 1.5px dashed #cbd5e1; border-radius: 10px; padding: 0.5rem 0.75rem; width: 100%; background: #f8fafc;">
                        <div style="font-size: 0.68rem; color: #94a3b8; margin-top: 0.2rem;">Max 20 MB per file.
                            Multiple files allowed.
                        </div>
                        @error('uploadFiles') <span
                            style="font-size: 0.7rem; color: #dc2626;">{{ $message }}</span> @enderror
                        @error('uploadFiles.*') <span
                            style="font-size: 0.7rem; color: #dc2626;">{{ $message }}</span> @enderror
                    </div>

                    {{-- Upload progress --}}
                    <div wire:loading wire:target="uploadFiles" style="margin-bottom: 0.5rem;">
                        <div class="d-flex align-items-center" style="gap: 0.4rem; color: #3b82f6; font-size: 0.78rem;">
                            <i class="fas fa-spinner fa-spin"></i> Uploading...
                        </div>
                    </div>

                    <div style="margin-bottom: 0.85rem;">
                        <label
                            style="font-size: 0.72rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.03em; display: block; margin-bottom: 0.3rem;">
                            <i class="fas fa-align-left mr-1"></i> Description (optional)
                        </label>
                        <textarea wire:model.defer="fileDescription" rows="2" class="form-control"
                                  placeholder="Describe these files..."
                                  style="font-size: 0.82rem; border: 1.5px solid #e2e8f0; border-radius: 8px; resize: vertical;"></textarea>
                    </div>

                    {{-- Preview selected files --}}
                    @if($uploadFiles && count($uploadFiles) > 0)
                        <div
                            style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 0.5rem 0.65rem; margin-bottom: 0.85rem;">
                            <div
                                style="font-size: 0.68rem; font-weight: 700; color: #065f46; text-transform: uppercase; margin-bottom: 0.3rem;">{{ count($uploadFiles) }}
                                file(s) selected
                            </div>
                            @foreach($uploadFiles as $f)
                                <div style="font-size: 0.75rem; color: #374151; padding: 0.1rem 0;">
                                    <i class="fas fa-file mr-1"
                                       style="color: #94a3b8;"></i> {{ $f->getClientOriginalName() }}
                                    <span style="color: #94a3b8; margin-left: 0.3rem;">({{ number_format($f->getSize() / 1048576, 2) }} MB)</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                {{-- Footer --}}
                <div
                    style="padding: 0.75rem 1.1rem; background: #f8fafc; border-top: 1px solid #e2e8f0; display: flex; justify-content: flex-end; gap: 0.5rem;">
                    <button wire:click="closeUploadModal" class="btn btn-sm"
                            style="background: #f3f4f6; color: #374151; border: 1px solid #d1d5db; border-radius: 8px; font-weight: 600; font-size: 0.78rem; padding: 0.4rem 0.85rem;">
                        Cancel
                    </button>
                    <button wire:click="uploadTaskFiles" class="btn btn-sm"
                            style="background: linear-gradient(135deg, var(--z-green), var(--z-green-dark)); color: #fff; border: none; border-radius: 8px; font-weight: 600; font-size: 0.78rem; padding: 0.4rem 0.85rem;"
                            wire:loading.attr="disabled" wire:target="uploadTaskFiles">
                        <span wire:loading.remove wire:target="uploadTaskFiles"><i class="fas fa-upload mr-1"></i> Upload</span>
                        <span wire:loading wire:target="uploadTaskFiles"><i class="fas fa-spinner fa-spin mr-1"></i> Uploading...</span>
                    </button>
                </div>
            </div>
        </div>
    @endif


    <div class="modal fade" id="createIppApplication" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-lg"> <!-- ✅ LARGE MODAL -->
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-plus mr-1"></i> Technical Application Form
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <form wire:submit.prevent="createApplication">
                    <div class="modal-body">

                        <div class="row"> <!-- ✅ START ROW -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Project Name</label>
                                    <input type="text" class="form-control" wire:model.defer="project_name" required>
                                    <input type="hidden" class="form-control" wire:model="client_id" readonly>
                                </div>


                                <div class="form-group">
                                    <label>Province</label>
                                    <select class="form-control" wire:model="province_id" required>
                                        <option value="">--choose--</option>
                                        @foreach($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->province }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>Connection Point</label>
                                    <select class="form-control" wire:model="connection_point_id" required>
                                        <option value="">--choose--</option>
                                        @foreach($connection_points as $point)
                                            <option value="{{ $point->id }}">
                                                {{ $point->substation }} ({{ $point->voltage_level }})
                                            </option>
                                        @endforeach
                                    </select>

                                    <div wire:loading wire:target="district_id" class="mt-1">
                                        <div class="spinner-border spinner-border-sm text-success"></div>
                                        <small> Loading connection points...</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Proposed Generation Capacity Units</label>
                                    <select class="form-control"
                                            wire:model.defer="proposed_generation_capacity_units">
                                        <option>--choose--</option>
                                        <option value="MVA">MVA</option>
                                        <option value="MW">MW</option>
                                        <option value="kWh">kWh</option>

                                    </select>
                                </div>


                            </div>

                            <!-- RIGHT COLUMN -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Technology</label>
                                    <select class="form-control" wire:model.defer="technology_id" required>
                                        <option value="">--choose--</option>
                                        @foreach($technologies as $tech)
                                            <option value="{{ $tech->id }}">{{ $tech->technology_name }}</option>

                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>District</label>
                                    <select class="form-control" wire:model="district_id">
                                        <option value="">--choose--</option>
                                        @foreach($districts as $district)
                                            <option value="{{ $district->id }}">{{ $district->district }}</option>
                                        @endforeach
                                    </select>

                                    <!-- ✅ LOADER -->
                                    <div wire:loading wire:target="province_id" class="mt-1">
                                        <div class="spinner-border spinner-border-sm text-success"></div>
                                        <small> Loading districts...</small>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Proposed Generation Capacity</label>
                                    <input type="number" class="form-control"
                                           wire:model.defer="proposed_generation_capacity">
                                </div>
                            </div>

                        </div> <!-- ✅ END ROW -->
                        <div class="row">
                            <label>Comment</label>
                            <textarea class="form-control" cols="30" rows="2"
                                      wire:model.defer="application_comments"></textarea>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save mr-1"></i> Create
                        </button>
                        <div wire:loading wire:target="createApplication" class="mt-1">
                            <div class="spinner-border spinner-border-sm text-success"></div>
                            <small> Saving Application...</small>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
