<div>
    <section class="content py-3 px-3">
        {{-- ===== Flash Message ===== --}}
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" style="border-radius: 10px; font-size: 0.85rem; border: none; background: linear-gradient(135deg, #ecfdf5, #d1fae5); color: #065f46;">
                <i class="fas fa-check-circle mr-1"></i> {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        {{-- ===== Page Header ===== --}}
        <div class="z-page-header mb-3">
            <div class="d-flex align-items-center justify-content-between flex-wrap">
                <div>
                    <h1><i class="fas fa-user-tie"></i> {{ $client->company_name }}</h1>
                    <p>Client profile, documents &amp; process tracking</p>
                </div>
                <div class="d-flex" style="gap: 0.5rem;">
                    <button wire:click="openAssignModal" class="btn btn-sm" style="background: rgba(255,255,255,0.25); color: #fff; border-radius: 8px; font-weight: 600; padding: 0.4rem 1rem; font-size: 0.82rem;">
                        <i class="fas fa-plus-circle mr-1"></i> Assign Process
                    </button>
                    <a href="{{ route('clients.index') }}" class="btn btn-sm" style="background: rgba(255,255,255,0.15); color: #fff; border-radius: 8px; font-weight: 600; padding: 0.4rem 1rem; font-size: 0.82rem;">
                        <i class="fas fa-arrow-left mr-1"></i> Back to Clients
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- ========== LEFT — Client Details ========== --}}
            <div class="col-lg-8 col-md-7">
                {{-- Company Information Card --}}
                <div class="card z-card mb-3">
                    <div class="card-header d-flex align-items-center justify-content-between py-2">
                        <div class="d-flex align-items-center" style="gap: 0.5rem;">
                            <div style="width: 32px; height: 32px; border-radius: 8px; background: linear-gradient(135deg, var(--z-green), var(--z-green-dark)); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 0.8rem;">
                                {{ strtoupper(substr($client->company_name, 0, 2)) }}
                            </div>
                            <h3 class="mb-0" style="font-size: 0.9rem; font-weight: 600;">Company Information</h3>
                        </div>
                        <span style="display: inline-flex; align-items: center; gap: 0.3rem; background: {{ $client->is_active == '1' ? '#ecfdf5' : '#fef2f2' }}; color: {{ $client->is_active == '1' ? '#059669' : '#dc2626' }}; font-size: 0.72rem; font-weight: 600; padding: 0.25rem 0.65rem; border-radius: 20px;">
                            <i class="fas fa-circle" style="font-size: 5px;"></i>
                            {{ $client->is_active == '1' ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div style="font-size: 0.7rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.2rem;">Company Name</div>
                                <div style="font-size: 0.9rem; font-weight: 600; color: #1a2332;">{{ $client->company_name ?? '—' }}</div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div style="font-size: 0.7rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.2rem;">TPIN</div>
                                <div><span class="z-badge">{{ $client->tpin ?? 'N/A' }}</span></div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div style="font-size: 0.7rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.2rem;">Phone</div>
                                <div style="font-size: 0.88rem; color: #374151;">
                                    <i class="fas fa-phone-alt mr-1" style="color: var(--z-green); font-size: 0.72rem;"></i>
                                    {{ $client->phone ?? '—' }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div style="font-size: 0.7rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.2rem;">Email</div>
                                <div style="font-size: 0.88rem; color: #374151;">
                                    <i class="fas fa-envelope mr-1" style="color: var(--z-orange); font-size: 0.72rem;"></i>
                                    {{ $client->email ?? '—' }}
                                </div>
                            </div>
                            <div class="col-md-8 mb-3">
                                <div style="font-size: 0.7rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.2rem;">Address</div>
                                <div style="font-size: 0.88rem; color: #374151;">
                                    <i class="fas fa-map-marker-alt mr-1" style="color: #e3342f; font-size: 0.72rem;"></i>
                                    {{ $client->address_line_1 ?? '—' }}
                                </div>
                            </div>
                        </div>
                        <div style="height: 1px; background: #f0f4f8; margin: 0.5rem 0 1rem;"></div>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <div style="font-size: 0.7rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.2rem;">Country</div>
                                <div style="font-size: 0.88rem; color: #374151;">
                                    <i class="fas fa-globe-africa mr-1" style="color: #3490dc; font-size: 0.72rem;"></i>
                                    {{ $client->country ?? '—' }}
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div style="font-size: 0.7rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.2rem;">City</div>
                                <div style="font-size: 0.88rem; color: #374151;">
                                    <i class="fas fa-city mr-1" style="color: #6574cd; font-size: 0.72rem;"></i>
                                    {{ $client->city ?? '—' }}
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div style="font-size: 0.7rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.2rem;">Province</div>
                                <div style="font-size: 0.88rem; color: #374151;">
                                    <i class="fas fa-map mr-1" style="color: #9561e2; font-size: 0.72rem;"></i>
                                    {{ $client->province ?? '—' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT CONTENT — Documents --}}
            <div class="col-lg-3 col-md-4 mb-3">
<div class="card">
    <div class="card-header">
        <a class="btn btn-success" href="{{route('quote.create', $client->id)}}">Generate Quotation</a>

    </div>
    <div class="card-body ">

    </div>
</div>
                <div class="card z-card" style="position: relative;">
                    <div class="card-header d-flex align-items-center justify-content-between py-2">
                        <div class="d-flex align-items-center" style="gap: 0.5rem;">
                            <div style="width: 28px; height: 28px; border-radius: 8px; background: linear-gradient(135deg, #3490dc, #2779bd); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-paperclip" style="color: #fff; font-size: 0.7rem;"></i>
                            </div>
                            <h3 class="mb-0" style="font-size: 0.9rem; font-weight: 600;">Documents
                                <span style="background: rgba(52,144,220,0.1); color: #3490dc; font-size: 0.68rem; font-weight: 700; padding: 0.1rem 0.45rem; border-radius: 10px; margin-left: 0.3rem;">{{ count($documents) }}</span>
                            </h3>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 0.75rem;">
                        @forelse($documents as $doc)
                            <div style="display: flex; align-items: center; gap: 0.65rem; padding: 0.6rem 0.75rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; margin-bottom: 0.5rem; transition: all 0.15s;"
                                 onmouseover="this.style.borderColor='var(--z-green)'; this.style.background='#fff';"
                                 onmouseout="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc';">
                                @php
                                    $ext = pathinfo($doc->name, PATHINFO_EXTENSION);
                                    $iconMap = [
                                        'pdf' => ['fas fa-file-pdf', '#e3342f'],
                                        'doc' => ['fas fa-file-word', '#3490dc'],
                                        'docx' => ['fas fa-file-word', '#3490dc'],
                                        'xls' => ['fas fa-file-excel', '#38c172'],
                                        'xlsx' => ['fas fa-file-excel', '#38c172'],
                                        'csv' => ['fas fa-file-csv', '#38c172'],
                                        'jpg' => ['fas fa-file-image', '#f6993f'],
                                        'jpeg' => ['fas fa-file-image', '#f6993f'],
                                        'png' => ['fas fa-file-image', '#f6993f'],
                                    ];
                                    $icon = $iconMap[strtolower($ext)] ?? ['fas fa-file', '#6b7280'];
                                @endphp
                                <div style="width: 32px; height: 32px; border-radius: 8px; background: {{ $icon[1] }}15; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="{{ $icon[0] }}" style="color: {{ $icon[1] }}; font-size: 0.85rem;"></i>
                                </div>
                                <div style="flex: 1; min-width: 0;">
                                    <div style="font-size: 0.8rem; font-weight: 600; color: #1a2332; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $doc->original_name ?? $doc->name }}">
                                        {{ $doc->type ?? 'Document' }}
                                    </div>
                                    <div style="font-size: 0.68rem; color: #94a3b8;">
                                        {{ strtoupper($ext) }} {{ $doc->size ? '· ' . $doc->size . ' MB' : '' }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4" style="color: #94a3b8;">
                                <i class="fas fa-folder-open fa-2x d-block mb-2"></i>
                                <span style="font-size: 0.82rem;">No documents uploaded yet.</span>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- ════════════════════════════════════════════════
             PROCESS TRACKING SECTION
             ════════════════════════════════════════════════ --}}
        <div class="row mt-2">
            <div class="col-12">
                <div class="card z-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-2">
                        <div class="d-flex align-items-center" style="gap: 0.5rem;">
                            <div style="width: 32px; height: 32px; border-radius: 8px; background: linear-gradient(135deg, #8b5cf6, #6d28d9); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-tasks" style="color: #fff; font-size: 0.75rem;"></i>
                            </div>
                            <h3 class="mb-0" style="font-size: 0.9rem; font-weight: 600;">Process Tracking
                                <span style="background: rgba(139,92,246,0.1); color: #8b5cf6; font-size: 0.68rem; font-weight: 700; padding: 0.1rem 0.45rem; border-radius: 10px; margin-left: 0.3rem;">{{ count($clientProcesses) }}</span>
                            </h3>
                        </div>
                        <button wire:click="openAssignModal" class="btn btn-sm" style="background: linear-gradient(135deg, var(--z-green), var(--z-green-dark)); color: #fff; border: none; border-radius: 8px; font-weight: 600; font-size: 0.78rem; padding: 0.35rem 0.9rem;">
                            <i class="fas fa-plus mr-1"></i> Assign Process
                        </button>
                    </div>
                    <div class="card-body" style="padding: 0;">
                        @if(count($clientProcesses) === 0)
                            {{-- Empty state --}}
                            <div class="text-center py-5" style="color: #94a3b8;">
                                <i class="fas fa-project-diagram fa-3x d-block mb-3" style="opacity: 0.3;"></i>
                                <p style="font-size: 0.9rem; font-weight: 600; color: #64748b;">No processes assigned yet</p>
                                <p style="font-size: 0.8rem;">Click "Assign Process" to start tracking this client through a workflow.</p>
                            </div>
                        @else
                            <div class="row no-gutters">
                                {{-- ── Process Tabs (left column) ── --}}
                                <div class="col-md-3" style="border-right: 1px solid #e2e8f0; background: #f8fafc;">
                                    <div style="padding: 0.5rem;">
                                        <div style="font-size: 0.68rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; padding: 0.5rem 0.75rem 0.3rem;">Assigned Processes</div>
                                        @foreach($clientProcesses as $cp)
                                            @php
                                                $cpTotal = $cp->taskProgress->count();
                                                $cpDone  = $cp->taskProgress->where('status', 'completed')->count();
                                                $cpPct   = $cpTotal > 0 ? (int) round(($cpDone / $cpTotal) * 100) : 0;
                                                $isActive = $activeClientProcessId == $cp->id;
                                                $statusColors = [
                                                    'in_progress' => ['#3b82f6', '#eff6ff'],
                                                    'completed'   => ['#10b981', '#ecfdf5'],
                                                    'not_started' => ['#f59e0b', '#fffbeb'],
                                                ];
                                                $sColor = $statusColors[$cp->status] ?? ['#6b7280', '#f3f4f6'];
                                            @endphp
                                            <div wire:click="selectProcess({{ $cp->id }})"
                                                 style="padding: 0.7rem 0.75rem; margin-bottom: 0.25rem; border-radius: 8px; cursor: pointer; border: 1.5px solid {{ $isActive ? 'var(--z-green)' : 'transparent' }}; background: {{ $isActive ? '#fff' : 'transparent' }}; transition: all 0.15s;"
                                                 onmouseover="if(!{{ $isActive ? 'true' : 'false' }})this.style.background='#fff'"
                                                 onmouseout="if(!{{ $isActive ? 'true' : 'false' }})this.style.background='transparent'">
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <div style="font-size: 0.8rem; font-weight: 600; color: #1a2332; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 140px;" title="{{ $cp->process->name }}">
                                                        {{ $cp->process->name }}
                                                    </div>
                                                    <span style="font-size: 0.62rem; font-weight: 700; color: {{ $sColor[0] }}; background: {{ $sColor[1] }}; padding: 0.1rem 0.4rem; border-radius: 10px; text-transform: capitalize; white-space: nowrap;">
                                                        {{ str_replace('_', ' ', $cp->status) }}
                                                    </span>
                                                </div>
                                                {{-- Mini progress bar --}}
                                                <div style="display: flex; align-items: center; gap: 0.4rem;">
                                                    <div style="flex: 1; height: 4px; border-radius: 4px; background: #e2e8f0; overflow: hidden;">
                                                        <div style="height: 100%; width: {{ $cpPct }}%; background: {{ $cpPct === 100 ? '#10b981' : 'var(--z-green)' }}; border-radius: 4px; transition: width 0.3s;"></div>
                                                    </div>
                                                    <span style="font-size: 0.65rem; font-weight: 700; color: #64748b;">{{ $cpPct }}%</span>
                                                </div>
                                                <div style="font-size: 0.65rem; color: #94a3b8; margin-top: 0.2rem;">{{ $cpDone }}/{{ $cpTotal }} tasks</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- ── Stage & Task detail (right column) ── --}}
                                <div class="col-md-9">
                                    @if($this->activeClientProcess)
                                        @php $acp = $this->activeClientProcess; @endphp
                                        {{-- Process header bar --}}
                                        <div style="padding: 0.75rem 1rem; border-bottom: 1px solid #e2e8f0; background: #fff;">
                                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                                <div>
                                                    <h5 class="mb-0" style="font-size: 1rem; font-weight: 700; color: #1a2332;">{{ $acp->process->name }}</h5>
                                                    @if($acp->process->description)
                                                        <p class="mb-0" style="font-size: 0.76rem; color: #64748b;">{{ $acp->process->description }}</p>
                                                    @endif
                                                </div>
                                                <div class="d-flex align-items-center" style="gap: 1rem;">
                                                    @if($acp->started_at)
                                                        <span style="font-size: 0.72rem; color: #64748b;">
                                                            <i class="fas fa-calendar-alt mr-1"></i> Started {{ \Carbon\Carbon::parse($acp->started_at)->format('d M Y') }}
                                                        </span>
                                                    @endif
                                                    @if($acp->status === 'completed')
                                                        <span style="display: inline-flex; align-items: center; gap: 0.3rem; background: #ecfdf5; color: #059669; font-size: 0.75rem; font-weight: 600; padding: 0.3rem 0.75rem; border-radius: 20px;">
                                                            <i class="fas fa-check-circle"></i> Completed
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- Overall progress --}}
                                            @php
                                                $oTotal = $acp->taskProgress->count();
                                                $oDone  = $acp->taskProgress->where('status', 'completed')->count();
                                                $oPct   = $oTotal > 0 ? (int) round(($oDone / $oTotal) * 100) : 0;
                                            @endphp
                                            <div class="d-flex align-items-center mt-2" style="gap: 0.5rem;">
                                                <div style="flex: 1; height: 8px; border-radius: 8px; background: #e2e8f0; overflow: hidden;">
                                                    <div style="height: 100%; width: {{ $oPct }}%; border-radius: 8px; transition: width 0.4s; background: {{ $oPct === 100 ? 'linear-gradient(135deg, #10b981, #059669)' : 'linear-gradient(135deg, var(--z-green), var(--z-green-dark))' }};"></div>
                                                </div>
                                                <span style="font-size: 0.78rem; font-weight: 700; color: {{ $oPct === 100 ? '#059669' : '#1a2332' }};">{{ $oPct }}%</span>
                                                <span style="font-size: 0.72rem; color: #94a3b8;">({{ $oDone }}/{{ $oTotal }})</span>
                                            </div>
                                        </div>

                                        {{-- Stage accordion --}}
                                        <div style="padding: 0.75rem 1rem; max-height: 500px; overflow-y: auto;">
                                            @foreach($this->stageProgress as $mp)
                                                @php $mod = $mp->stage; @endphp
                                                <div style="border: 1px solid #e2e8f0; border-radius: 10px; margin-bottom: 0.5rem; overflow: hidden; background: #fff;">
                                                    {{-- Stage header --}}
                                                    <div wire:click="toggleStage({{ $mod->id }})"
                                                         style="padding: 0.65rem 0.85rem; cursor: pointer; display: flex; align-items: center; justify-content: space-between; background: {{ $activeStageId == $mod->id ? '#f0fdf4' : '#fafbfc' }}; transition: background 0.15s;"
                                                         onmouseover="this.style.background='#f0fdf4'"
                                                         onmouseout="this.style.background='{{ $activeStageId == $mod->id ? '#f0fdf4' : '#fafbfc' }}'">
                                                        <div class="d-flex align-items-center" style="gap: 0.55rem;">
                                                            <div style="width: 28px; height: 28px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.68rem; color: #fff; background: {{ $mp->percent === 100 ? 'linear-gradient(135deg, #10b981, #059669)' : 'linear-gradient(135deg, #8b5cf6, #6d28d9)' }};">
                                                                @if($mp->percent === 100)
                                                                    <i class="fas fa-check"></i>
                                                                @else
                                                                    {{ $mod->order ?? $loop->iteration }}
                                                                @endif
                                                            </div>
                                                            <div>
                                                                <div style="font-size: 0.82rem; font-weight: 600; color: #1a2332;">{{ $mod->name }}</div>
                                                                <div style="font-size: 0.68rem; color: #94a3b8;">{{ $mp->completed }}/{{ $mp->total }} tasks completed</div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex align-items-center" style="gap: 0.6rem;">
                                                            {{-- Stage mini progress --}}
                                                            <div style="width: 60px; height: 4px; border-radius: 4px; background: #e2e8f0; overflow: hidden;">
                                                                <div style="height: 100%; width: {{ $mp->percent }}%; background: {{ $mp->percent === 100 ? '#10b981' : '#8b5cf6' }}; border-radius: 4px;"></div>
                                                            </div>
                                                            <span style="font-size: 0.72rem; font-weight: 700; color: #64748b;">{{ $mp->percent }}%</span>
                                                            <i class="fas fa-chevron-{{ $activeStageId == $mod->id ? 'up' : 'down' }}" style="font-size: 0.65rem; color: #94a3b8;"></i>
                                                        </div>
                                                    </div>

                                                    {{-- Tasks list (expanded) --}}
                                                    @if($activeStageId == $mod->id)
                                                        <div style="border-top: 1px solid #e2e8f0;">
                                                            @forelse($mp->tasks as $tp)
                                                                @php
                                                                    $task = $tp->task;
                                                                    $taskStatusConfig = [
                                                                        'pending'     => ['icon' => 'far fa-circle',       'color' => '#f59e0b', 'bg' => '#fffbeb',  'label' => 'Pending'],
                                                                        'in_progress' => ['icon' => 'fas fa-spinner',      'color' => '#3b82f6', 'bg' => '#eff6ff',  'label' => 'In Progress'],
                                                                        'completed'   => ['icon' => 'fas fa-check-circle', 'color' => '#10b981', 'bg' => '#ecfdf5',  'label' => 'Completed'],
                                                                        'skipped'     => ['icon' => 'fas fa-forward',      'color' => '#6b7280', 'bg' => '#f3f4f6',  'label' => 'Skipped'],
                                                                    ];
                                                                    $tsCfg = $taskStatusConfig[$tp->status] ?? $taskStatusConfig['pending'];
                                                                @endphp
                                                                <div style="padding: 0.65rem 0.85rem; border-bottom: 1px solid #f1f5f9; transition: background 0.1s;"
                                                                     onmouseover="this.style.background='#fafbfc'" onmouseout="this.style.background='#fff'">
                                                                    {{-- Row 1: Status icon + title + status badge + actions --}}
                                                                    <div style="display: flex; align-items: flex-start; gap: 0.65rem;">
                                                                        {{-- Status icon --}}
                                                                        <div style="padding-top: 0.2rem; flex-shrink: 0;">
                                                                            <i class="{{ $tsCfg['icon'] }}" style="color: {{ $tsCfg['color'] }}; font-size: 0.9rem;"></i>
                                                                        </div>
                                                                        {{-- Task info --}}
                                                                        <div style="flex: 1; min-width: 0;">
                                                                            <div class="d-flex align-items-center justify-content-between">
                                                                                <div style="font-size: 0.8rem; font-weight: 600; color: {{ $tp->status === 'completed' ? '#94a3b8' : '#1a2332' }}; {{ $tp->status === 'completed' ? 'text-decoration: line-through;' : '' }}">
                                                                                    {{ $task->title ?? 'Task #' . $tp->process_task_id }}
                                                                                </div>
                                                                                <div class="d-flex align-items-center" style="gap: 0.4rem;">
                                                                                    <span style="font-size: 0.62rem; font-weight: 600; color: {{ $tsCfg['color'] }}; background: {{ $tsCfg['bg'] }}; padding: 0.1rem 0.45rem; border-radius: 10px; white-space: nowrap;">
                                                                                        {{ $tsCfg['label'] }}
                                                                                    </span>
                                                                                    @if($task && $task->max_days)
                                                                                        <span style="font-size: 0.58rem; font-weight: 600; padding: 0.05rem 0.35rem; border-radius: 6px; display: inline-block; color: var(--z-orange-dark); background: #fff7ed;"><i class="fas fa-clock mr-1" style="font-size: 0.5rem;"></i>{{ $task->max_days_label }}</span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            @if($task && $task->description)
                                                                                <div style="font-size: 0.72rem; color: #64748b; margin-top: 0.15rem;">{{ Str::limit($task->description, 100) }}</div>
                                                                            @endif

                                                                            {{-- ── Assigned Offices & Users ── --}}
                                                                            @if($task && $task->offices && $task->offices->count() > 0)
                                                                                <div style="margin-top: 0.4rem; padding: 0.4rem 0.55rem; background: #f8fafc; border: 1px solid #f1f5f9; border-radius: 8px;">
                                                                                    <div style="font-size: 0.62rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 0.3rem;">
                                                                                        <i class="fas fa-building mr-1"></i>Responsible Offices & Personnel
                                                                                    </div>
                                                                                    @foreach($task->offices as $office)
                                                                                        <div style="margin-bottom: {{ !$loop->last ? '0.35rem' : '0' }};">
                                                                                            <div class="d-flex align-items-center" style="gap: 0.35rem; margin-bottom: 0.15rem;">
                                                                                                <div style="width: 18px; height: 18px; border-radius: 5px; background: linear-gradient(135deg, #6366f1, #4f46e5); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                                                                    <i class="fas fa-building" style="color: #fff; font-size: 0.45rem;"></i>
                                                                                                </div>
                                                                                                <span style="font-size: 0.72rem; font-weight: 600; color: #374151;">{{ $office->responsible_office }}</span>
                                                                                                @if($office->pivot && $office->pivot->status)
                                                                                                    @php
                                                                                                        $osPivot = $office->pivot->status ?? 'pending';
                                                                                                        $osPivotColor = match($osPivot) {
                                                                                                            'completed' => '#10b981',
                                                                                                            'acknowledged' => '#3b82f6',
                                                                                                            default => '#f59e0b',
                                                                                                        };
                                                                                                    @endphp
                                                                                                    <span style="font-size: 0.55rem; font-weight: 600; color: {{ $osPivotColor }}; background: {{ $osPivotColor }}15; padding: 0.05rem 0.3rem; border-radius: 6px;">{{ ucfirst($osPivot) }}</span>
                                                                                                @endif
                                                                                            </div>
                                                                                            {{-- Users in this office --}}
                                                                                            @if($office->users && $office->users->count() > 0)
                                                                                                <div style="display: flex; flex-wrap: wrap; gap: 0.3rem; padding-left: 1.4rem;">
                                                                                                    @foreach($office->users as $offUser)
                                                                                                        <div style="display: inline-flex; align-items: center; gap: 0.25rem; background: #fff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 0.1rem 0.45rem 0.1rem 0.15rem; font-size: 0.65rem;">
                                                                                                            <div style="width: 16px; height: 16px; border-radius: 50%; background: linear-gradient(135deg, var(--z-green), var(--z-green-dark)); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 0.4rem; font-weight: 700; flex-shrink: 0;">
                                                                                                                {{ strtoupper(substr($offUser->name ?? 'U', 0, 1)) }}
                                                                                                            </div>
                                                                                                            <span style="color: #374151; font-weight: 500;">{{ $offUser->name }}</span>
                                                                                                            @if($offUser->pivot && $offUser->pivot->role_in_office)
                                                                                                                <span style="color: #94a3b8; font-size: 0.58rem;">· {{ $offUser->pivot->role_in_office }}</span>
                                                                                                            @endif
                                                                                                        </div>
                                                                                                    @endforeach
                                                                                                </div>
                                                                                            @else
                                                                                                <div style="padding-left: 1.4rem; font-size: 0.65rem; color: #cbd5e1; font-style: italic;">No users assigned to this office</div>
                                                                                            @endif
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            @endif

                                                                            {{-- Task remarks input --}}
                                                                            @if($tp->status !== 'completed')
                                                                                <div class="mt-1">
                                                                                    <input type="text" wire:model.lazy="taskRemarks.{{ $tp->id }}" placeholder="Add remarks..."
                                                                                           style="width: 100%; font-size: 0.72rem; border: 1px solid #e2e8f0; border-radius: 6px; padding: 0.25rem 0.5rem; background: #f8fafc; outline: none; color: #374151;"
                                                                                           onfocus="this.style.borderColor='var(--z-green)'" onblur="this.style.borderColor='#e2e8f0'">
                                                                                </div>
                                                                            @elseif($tp->remarks)
                                                                                <div style="font-size: 0.68rem; color: #64748b; margin-top: 0.2rem; font-style: italic;">
                                                                                    <i class="fas fa-comment-dots mr-1" style="font-size: 0.6rem;"></i>{{ $tp->remarks }}
                                                                                </div>
                                                                            @endif
                                                                            @if($tp->status === 'completed' && $tp->completed_at)
                                                                                <div style="font-size: 0.62rem; color: #94a3b8; margin-top: 0.15rem;">
                                                                                    <i class="fas fa-check mr-1"></i>Completed {{ \Carbon\Carbon::parse($tp->completed_at)->format('d M Y H:i') }}
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                        {{-- Action buttons --}}
                                                                        <div class="d-flex flex-column" style="gap: 0.25rem; flex-shrink: 0; padding-top: 0.1rem;">
                                                                            {{-- View detail --}}
                                                                            <button wire:click="openTaskDetail({{ $tp->id }})" class="btn btn-sm" title="View Details"
                                                                                    style="width: 26px; height: 26px; padding: 0; border-radius: 6px; background: #f3f4f6; border: 1px solid #e2e8f0; color: #6b7280; display: flex; align-items: center; justify-content: center; font-size: 0.65rem;">
                                                                                <i class="fas fa-eye"></i>
                                                                            </button>
                                                                            @if($tp->status === 'pending')
                                                                                <button wire:click="updateTaskStatus({{ $tp->id }}, 'in_progress')" class="btn btn-sm" title="Start"
                                                                                        style="width: 26px; height: 26px; padding: 0; border-radius: 6px; background: #eff6ff; border: 1px solid #bfdbfe; color: #3b82f6; display: flex; align-items: center; justify-content: center; font-size: 0.65rem;">
                                                                                    <i class="fas fa-play"></i>
                                                                                </button>
                                                                                <button wire:click="updateTaskStatus({{ $tp->id }}, 'completed')" class="btn btn-sm" title="Complete"
                                                                                        style="width: 26px; height: 26px; padding: 0; border-radius: 6px; background: #ecfdf5; border: 1px solid #a7f3d0; color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 0.65rem;">
                                                                                    <i class="fas fa-check"></i>
                                                                                </button>
                                                                            @elseif($tp->status === 'in_progress')
                                                                                <button wire:click="updateTaskStatus({{ $tp->id }}, 'completed')" class="btn btn-sm" title="Complete"
                                                                                        style="width: 26px; height: 26px; padding: 0; border-radius: 6px; background: #ecfdf5; border: 1px solid #a7f3d0; color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 0.65rem;">
                                                                                    <i class="fas fa-check"></i>
                                                                                </button>
                                                                                <button wire:click="updateTaskStatus({{ $tp->id }}, 'pending')" class="btn btn-sm" title="Reset"
                                                                                        style="width: 26px; height: 26px; padding: 0; border-radius: 6px; background: #fffbeb; border: 1px solid #fde68a; color: #f59e0b; display: flex; align-items: center; justify-content: center; font-size: 0.65rem;">
                                                                                    <i class="fas fa-undo"></i>
                                                                                </button>
                                                                            @elseif($tp->status === 'completed')
                                                                                <button wire:click="updateTaskStatus({{ $tp->id }}, 'pending')" class="btn btn-sm" title="Reopen"
                                                                                        style="width: 26px; height: 26px; padding: 0; border-radius: 6px; background: #fffbeb; border: 1px solid #fde68a; color: #f59e0b; display: flex; align-items: center; justify-content: center; font-size: 0.65rem;">
                                                                                    <i class="fas fa-redo"></i>
                                                                                </button>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @empty
                                                                <div class="text-center py-3" style="color: #94a3b8; font-size: 0.8rem;">
                                                                    <i class="fas fa-inbox mr-1"></i> No tasks in this stage
                                                                </div>
                                                            @endforelse
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center py-5" style="color: #94a3b8;">
                                            <i class="fas fa-hand-pointer fa-2x d-block mb-2" style="opacity: 0.3;"></i>
                                            <span style="font-size: 0.82rem;">Select a process from the left to view details.</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════════════
         ASSIGN PROCESS MODAL
         ════════════════════════════════════════════════ --}}
    @if($showAssignModal)
        <div style="position: fixed; inset: 0; z-index: 1050; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.45);"
             wire:click.self="closeAssignModal">
            <div style="background: #fff; border-radius: 14px; width: 100%; max-width: 460px; box-shadow: 0 25px 60px rgba(0,0,0,0.25); animation: fadeIn 0.15s ease-out;">
                {{-- Modal header --}}
                <div style="padding: 1rem 1.25rem; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between;">
                    <div class="d-flex align-items-center" style="gap: 0.5rem;">
                        <div style="width: 32px; height: 32px; border-radius: 8px; background: linear-gradient(135deg, #8b5cf6, #6d28d9); display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-project-diagram" style="color: #fff; font-size: 0.75rem;"></i>
                        </div>
                        <h5 class="mb-0" style="font-size: 0.95rem; font-weight: 700; color: #1a2332;">Assign Process to Client</h5>
                    </div>
                    <button wire:click="closeAssignModal" style="background: none; border: none; font-size: 1.1rem; color: #94a3b8; cursor: pointer; padding: 0.2rem;">&times;</button>
                </div>
                {{-- Modal body --}}
                <div style="padding: 1.25rem;">
                    <p style="font-size: 0.82rem; color: #64748b; margin-bottom: 1rem;">
                        Select a process to assign to <strong>{{ $client->company_name }}</strong>. All stages and tasks from this process will be tracked.
                    </p>
                    @if(count($availableProcesses) === 0)
                        <div class="text-center py-3" style="background: #fafbfc; border-radius: 10px; border: 1px dashed #e2e8f0;">
                            <i class="fas fa-check-double" style="color: #10b981; font-size: 1.5rem;"></i>
                            <p class="mb-0 mt-2" style="font-size: 0.82rem; color: #64748b;">All available processes have been assigned.</p>
                        </div>
                    @else
                        <div class="form-group mb-3">
                            <label style="font-size: 0.75rem; font-weight: 600; color: #374151; margin-bottom: 0.3rem;">Select Process <span style="color: #e3342f;">*</span></label>
                            <select wire:model="selectedProcessId" class="form-control" style="font-size: 0.85rem; border-radius: 8px; border: 1.5px solid #e2e8f0; padding: 0.5rem 0.75rem;">
                                <option value="">— Choose a process —</option>
                                @foreach($availableProcesses as $proc)
                                    <option value="{{ $proc->id }}">{{ $proc->name }} ({{ $proc->stages->count() }} stages, {{ $proc->totalTaskCount() }} tasks)</option>
                                @endforeach
                            </select>
                            @error('selectedProcessId')
                                <span style="font-size: 0.72rem; color: #e3342f; margin-top: 0.25rem; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Process preview --}}
                        @if($selectedProcessId)
                            @php $previewProc = collect($availableProcesses)->firstWhere('id', (int)$selectedProcessId); @endphp
                            @if($previewProc)
                                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 0.75rem; margin-bottom: 1rem;">
                                    <div style="font-size: 0.75rem; font-weight: 700; color: #1a2332; margin-bottom: 0.3rem;">
                                        <i class="fas fa-sitemap mr-1" style="color: #8b5cf6;"></i> {{ $previewProc->name }}
                                    </div>
                                    @if($previewProc->description)
                                        <div style="font-size: 0.72rem; color: #64748b; margin-bottom: 0.4rem;">{{ $previewProc->description }}</div>
                                    @endif
                                    <div style="font-size: 0.7rem; color: #94a3b8;">
                                        <i class="fas fa-cubes mr-1"></i> {{ $previewProc->stages->count() }} stages &middot;
                                        <i class="fas fa-tasks ml-1 mr-1"></i> {{ $previewProc->totalTaskCount() }} tasks
                                    </div>
                                    {{-- Show offices involved --}}
                                    @php
                                        $previewOffices = collect();
                                        foreach($previewProc->stages as $pm) {
                                            foreach($pm->tasks as $pt) {
                                                foreach($pt->offices as $po) {
                                                    if(!$previewOffices->contains('id', $po->id)) {
                                                        $previewOffices->push($po);
                                                    }
                                                }
                                            }
                                        }
                                    @endphp
                                    @if($previewOffices->count() > 0)
                                        <div style="margin-top: 0.4rem; padding-top: 0.35rem; border-top: 1px solid #e2e8f0;">
                                            <div style="font-size: 0.62rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.2rem;">
                                                <i class="fas fa-building mr-1"></i>Offices Involved
                                            </div>
                                            <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
                                                @foreach($previewOffices as $po)
                                                    <span style="font-size: 0.65rem; background: #ede9fe; color: #6d28d9; padding: 0.1rem 0.4rem; border-radius: 8px; font-weight: 600;">{{ $po->responsible_office }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endif

                        <div class="d-flex justify-content-end" style="gap: 0.5rem;">
                            <button wire:click="closeAssignModal" class="btn btn-sm" style="background: #f3f4f6; color: #374151; border: none; border-radius: 8px; padding: 0.4rem 1rem; font-weight: 600; font-size: 0.82rem;">Cancel</button>
                            <button wire:click="assignProcess" class="btn btn-sm" style="background: linear-gradient(135deg, var(--z-green), var(--z-green-dark)); color: #fff; border: none; border-radius: 8px; padding: 0.4rem 1rem; font-weight: 600; font-size: 0.82rem;">
                                <i class="fas fa-check mr-1"></i> Assign Process
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif

    {{-- ════════════════════════════════════════════════
         TASK DETAIL MODAL
         ════════════════════════════════════════════════ --}}
    @if($showTaskDetail && $detailProgress)
        @php
            $dt = $detailProgress->processTask;
            $dtStatusMap = [
                'pending'     => ['icon' => 'far fa-circle',       'color' => '#f59e0b', 'bg' => '#fffbeb',  'label' => 'Pending'],
                'in_progress' => ['icon' => 'fas fa-spinner',      'color' => '#3b82f6', 'bg' => '#eff6ff',  'label' => 'In Progress'],
                'completed'   => ['icon' => 'fas fa-check-circle', 'color' => '#10b981', 'bg' => '#ecfdf5',  'label' => 'Completed'],
                'skipped'     => ['icon' => 'fas fa-forward',      'color' => '#6b7280', 'bg' => '#f3f4f6',  'label' => 'Skipped'],
            ];
            $dtCfg = $dtStatusMap[$detailProgress->status] ?? $dtStatusMap['pending'];
        @endphp
        <div style="position: fixed; inset: 0; z-index: 1050; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.45);"
             wire:click.self="closeTaskDetail">
            <div style="background: #fff; border-radius: 14px; width: 100%; max-width: 620px; max-height: 90vh; overflow-y: auto; box-shadow: 0 25px 60px rgba(0,0,0,0.25); animation: fadeIn 0.15s ease-out;">
                {{-- Modal header --}}
                <div style="padding: 1rem 1.25rem; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; background: #fff; z-index: 1; border-radius: 14px 14px 0 0;">
                    <div class="d-flex align-items-center" style="gap: 0.5rem;">
                        <div style="width: 32px; height: 32px; border-radius: 8px; background: linear-gradient(135deg, {{ $dtCfg['color'] }}, {{ $dtCfg['color'] }}cc); display: flex; align-items: center; justify-content: center;">
                            <i class="{{ $dtCfg['icon'] }}" style="color: #fff; font-size: 0.75rem;"></i>
                        </div>
                        <div>
                            <h5 class="mb-0" style="font-size: 0.95rem; font-weight: 700; color: #1a2332;">Task Details</h5>
                            <span style="font-size: 0.68rem; color: #64748b;">{{ $dt->stage->name ?? '' }} &bull; {{ $dt->stage->process->name ?? '' }}</span>
                        </div>
                    </div>
                    <button wire:click="closeTaskDetail" style="background: none; border: none; font-size: 1.1rem; color: #94a3b8; cursor: pointer; padding: 0.2rem;">&times;</button>
                </div>

                <div style="padding: 1.25rem;">
                    {{-- Task title & description --}}
                    <h4 style="font-weight: 700; color: #1a2332; margin: 0 0 0.3rem;">{{ $dt->title }}</h4>
                    @if($dt->description)
                        <p style="font-size: 0.82rem; color: #64748b; margin-bottom: 0.75rem;">{{ $dt->description }}</p>
                    @endif

                    {{-- Status / Priority / Due date row --}}
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div style="font-size: 0.65rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.2rem;">Tracking Status</div>
                            <span style="font-size: 0.75rem; font-weight: 600; color: {{ $dtCfg['color'] }}; background: {{ $dtCfg['bg'] }}; padding: 0.2rem 0.55rem; border-radius: 8px; display: inline-block;">
                                <i class="{{ $dtCfg['icon'] }} mr-1"></i>{{ $dtCfg['label'] }}
                            </span>
                        </div>
                        <div class="col-md-4">
                            <div style="font-size: 0.65rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.2rem;">Order / Step</div>
                            @if($dt)
                                <span class="z-badge-orange" style="font-size: 0.78rem;">Step {{ $dt->order_number }}</span>
                            @else
                                <span style="font-size: 0.78rem; color: #94a3b8;">—</span>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <div style="font-size: 0.65rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.2rem;">Max Duration</div>
                            @if($dt && $dt->max_days)
                                <span style="font-size: 0.78rem; font-weight: 600; color: var(--z-orange-dark);"><i class="fas fa-clock mr-1"></i>{{ $dt->max_days_label }}</span>
                            @else
                                <span style="font-size: 0.78rem; color: #94a3b8;">Not specified</span>
                            @endif
                        </div>
                    </div>

                    {{-- Completion info --}}
                    @if($detailProgress->status === 'completed')
                        <div style="background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 10px; padding: 0.65rem 0.85rem; margin-bottom: 0.75rem;">
                            <div class="d-flex align-items-center" style="gap: 0.5rem;">
                                <i class="fas fa-check-circle" style="color: #059669; font-size: 1rem;"></i>
                                <div>
                                    <div style="font-size: 0.78rem; font-weight: 600; color: #065f46;">
                                        Completed by {{ $detailProgress->completedByUser->name ?? 'Unknown' }}
                                    </div>
                                    @if($detailProgress->completed_at)
                                        <div style="font-size: 0.7rem; color: #047857;">{{ \Carbon\Carbon::parse($detailProgress->completed_at)->format('d M Y \a\t H:i') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Remarks --}}
                    @if($detailProgress->remarks)
                        <div style="background: #fffbeb; border: 1px solid #fde68a; border-radius: 10px; padding: 0.65rem 0.85rem; margin-bottom: 0.75rem;">
                            <div style="font-size: 0.65rem; font-weight: 700; color: #92400e; text-transform: uppercase; margin-bottom: 0.15rem;">
                                <i class="fas fa-comment-dots mr-1"></i>Remarks
                            </div>
                            <div style="font-size: 0.8rem; color: #78350f;">{{ $detailProgress->remarks }}</div>
                        </div>
                    @endif

                    {{-- ══ Assigned Offices & Personnel ══ --}}
                    <div style="margin-top: 0.5rem;">
                        <div style="font-size: 0.72rem; font-weight: 700; color: #1a2332; margin-bottom: 0.5rem; padding-bottom: 0.3rem; border-bottom: 2px solid #e2e8f0;">
                            <i class="fas fa-building mr-1" style="color: #6366f1;"></i> Responsible Offices & Personnel
                        </div>

                        @if($dt->offices && $dt->offices->count() > 0)
                            @foreach($dt->offices as $dtOff)
                                <div style="border: 1px solid #e2e8f0; border-radius: 10px; margin-bottom: 0.5rem; overflow: hidden;">
                                    {{-- Office header --}}
                                    <div style="padding: 0.55rem 0.75rem; background: #f8fafc; display: flex; align-items: center; justify-content: space-between;">
                                        <div class="d-flex align-items-center" style="gap: 0.4rem;">
                                            <div style="width: 26px; height: 26px; border-radius: 7px; background: linear-gradient(135deg, #6366f1, #4f46e5); display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-building" style="color: #fff; font-size: 0.55rem;"></i>
                                            </div>
                                            <span style="font-size: 0.82rem; font-weight: 600; color: #1a2332;">{{ $dtOff->responsible_office }}</span>
                                        </div>
                                        @php
                                            $dtOsStatus = $dtOff->pivot->status ?? 'pending';
                                            $dtOsColor = match($dtOsStatus) {
                                                'completed' => '#10b981',
                                                'acknowledged' => '#3b82f6',
                                                default => '#f59e0b',
                                            };
                                        @endphp
                                        <span style="font-size: 0.65rem; font-weight: 600; color: {{ $dtOsColor }}; background: {{ $dtOsColor }}15; padding: 0.1rem 0.4rem; border-radius: 8px;">{{ ucfirst($dtOsStatus) }}</span>
                                    </div>
                                    {{-- Users in this office --}}
                                    <div style="padding: 0.5rem 0.75rem;">
                                        @if($dtOff->users && $dtOff->users->count() > 0)
                                            <div style="font-size: 0.62rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 0.35rem;">
                                                <i class="fas fa-users mr-1"></i>Personnel ({{ $dtOff->users->count() }})
                                            </div>
                                            @foreach($dtOff->users as $dtUser)
                                                <div style="display: flex; align-items: center; gap: 0.5rem; padding: 0.35rem 0; {{ !$loop->last ? 'border-bottom: 1px solid #f1f5f9;' : '' }}">
                                                    <div style="width: 28px; height: 28px; border-radius: 50%; background: linear-gradient(135deg, var(--z-green), var(--z-green-dark)); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 0.55rem; font-weight: 700; flex-shrink: 0;">
                                                        {{ strtoupper(substr($dtUser->name ?? 'U', 0, 2)) }}
                                                    </div>
                                                    <div style="flex: 1; min-width: 0;">
                                                        <div style="font-size: 0.78rem; font-weight: 600; color: #1a2332;">{{ $dtUser->name }}</div>
                                                        <div style="font-size: 0.68rem; color: #94a3b8;">
                                                            {{ $dtUser->email ?? '' }}
                                                            @if($dtUser->pivot && $dtUser->pivot->role_in_office)
                                                                &bull; <span style="color: #6366f1; font-weight: 600;">{{ $dtUser->pivot->role_in_office }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div style="text-align: center; padding: 0.5rem; color: #cbd5e1; font-size: 0.75rem; font-style: italic;">
                                                <i class="fas fa-user-slash mr-1"></i> No users assigned to this office yet
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div style="text-align: center; padding: 1rem; background: #f8fafc; border-radius: 10px; border: 1px dashed #e2e8f0;">
                                <i class="fas fa-building" style="color: #cbd5e1; font-size: 1.5rem;"></i>
                                <p class="mb-0 mt-1" style="font-size: 0.8rem; color: #94a3b8;">No offices have been pre-assigned to this task.</p>
                                <p class="mb-0" style="font-size: 0.72rem; color: #cbd5e1;">Assign offices in the Task Manager to define responsibility.</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Modal footer --}}
                <div style="padding: 0.75rem 1.25rem; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; position: sticky; bottom: 0; background: #fff; border-radius: 0 0 14px 14px;">
                    <div class="d-flex" style="gap: 0.75rem;">
                        @if($detailProgress->comments && $detailProgress->comments->count() > 0)
                            <span style="font-size: 0.72rem; color: #64748b;"><i class="fas fa-comments mr-1" style="color: #f59e0b;"></i>{{ $detailProgress->comments->count() }} comment(s)</span>
                        @endif
                        @if($detailProgress->files && $detailProgress->files->count() > 0)
                            <span style="font-size: 0.72rem; color: #64748b;"><i class="fas fa-paperclip mr-1" style="color: #3b82f6;"></i>{{ $detailProgress->files->count() }} file(s)</span>
                        @endif
                    </div>
                    <div class="d-flex" style="gap: 0.5rem;">
                        <a href="{{ route('client-tasks.show', $detailProgress->id) }}" class="btn btn-sm" style="background: linear-gradient(135deg, var(--z-green), var(--z-green-dark)); color: #fff; border: none; border-radius: 8px; padding: 0.4rem 1rem; font-weight: 600; font-size: 0.82rem;">
                            <i class="fas fa-external-link-alt mr-1"></i> Full View
                        </a>
                        <button wire:click="closeTaskDetail" class="btn btn-sm" style="background: #f3f4f6; color: #374151; border: none; border-radius: 8px; padding: 0.4rem 1rem; font-weight: 600; font-size: 0.82rem;">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <style>
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</div>
