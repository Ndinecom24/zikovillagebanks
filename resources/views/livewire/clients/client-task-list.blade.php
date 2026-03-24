<div>
    {{-- ===== Page Header ===== --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="z-page-header">
                <div class="d-flex align-items-center justify-content-between flex-wrap" style="gap: 1rem;">
                    <div>
                        <h1><i class="fas fa-clipboard-list mr-2" style="color: var(--z-gold);"></i> Task Action Centre</h1>
                        <p>View, filter and action all client tasks across every process</p>
                    </div>
                </div>

                {{-- Stats row --}}
                <div class="row mt-3">
                    <div class="col-6 col-md-3">
                        <div style="background: rgba(255,255,255,0.12); border-radius: 8px; padding: 0.5rem 0.75rem;">
                            <div style="font-size: 1.15rem; font-weight: 800;">{{ $this->stats['total'] }}</div>
                            <div style="font-size: 0.72rem; opacity: 0.8;">Total Tasks</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div style="background: rgba(255,255,255,0.12); border-radius: 8px; padding: 0.5rem 0.75rem;">
                            <div style="font-size: 1.15rem; font-weight: 800; color: #fbbf24;">{{ $this->stats['pending'] }}</div>
                            <div style="font-size: 0.72rem; opacity: 0.8;">Pending</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div style="background: rgba(255,255,255,0.12); border-radius: 8px; padding: 0.5rem 0.75rem;">
                            <div style="font-size: 1.15rem; font-weight: 800; color: #60a5fa;">{{ $this->stats['in_progress'] }}</div>
                            <div style="font-size: 0.72rem; opacity: 0.8;">In Progress</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div style="background: rgba(255,255,255,0.12); border-radius: 8px; padding: 0.5rem 0.75rem;">
                            <div style="font-size: 1.15rem; font-weight: 800; color: #34d399;">{{ $this->stats['completed'] }}</div>
                            <div style="font-size: 0.72rem; opacity: 0.8;">Completed</div>
                        </div>
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
                <div class="alert alert-success alert-dismissible fade show" style="border-radius: 10px; font-size: 0.85rem; border: none; background: linear-gradient(135deg, #ecfdf5, #d1fae5); color: #065f46;">
                    <i class="fas fa-check-circle mr-1"></i> {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif

            <div class="card z-card">
                <div class="card-header d-flex align-items-center justify-content-between py-2">
                    <h3 class="mb-0" style="font-size: 0.95rem;">
                        <i class="fas fa-tasks mr-1"></i> All Client Tasks
                        <span class="z-count">{{ $tasks->total() }}</span>
                    </h3>
                    <div class="d-flex align-items-center" style="gap: 0.5rem;">
                        <select wire:model="perPage" class="form-control form-control-sm" style="width: 70px; border-radius: 6px; font-size: 0.78rem;">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>

                <div class="card-body">
                    {{-- ── Filters row ── --}}
                    <div class="d-flex flex-wrap align-items-end mb-3" style="gap: 0.6rem;">
                        {{-- Search --}}
                        <div style="flex: 1; min-width: 200px; max-width: 280px;">
                            <label style="font-size: 0.65rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.15rem; display: block;">Search</label>
                            <div class="z-search" style="width: 100%;">
                                <i class="fas fa-search si"></i>
                                <input type="text" wire:model.debounce.300ms="search" placeholder="Task title or client...">
                            </div>
                        </div>

                        {{-- Status --}}
                        <div style="min-width: 130px;">
                            <label style="font-size: 0.65rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.15rem; display: block;">Status</label>
                            <select wire:model="filterStatus" class="form-control z-filter-select">
                                <option value="">All Statuses</option>
                                <option value="pending">Pending</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                                <option value="skipped">Skipped</option>
                            </select>
                        </div>

                        {{-- Client --}}
                        <div style="min-width: 160px;">
                            <label style="font-size: 0.65rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.15rem; display: block;">Client</label>
                            <select wire:model="filterClient" class="form-control z-filter-select">
                                <option value="">All Clients</option>
                                @foreach($this->clients as $c)
                                    <option value="{{ $c->id }}">{{ Str::limit($c->company_name, 28) }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Process --}}
                        <div style="min-width: 160px;">
                            <label style="font-size: 0.65rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.15rem; display: block;">Process</label>
                            <select wire:model="filterProcess" class="form-control z-filter-select">
                                <option value="">All Processes</option>
                                @foreach($this->processes as $p)
                                    <option value="{{ $p->id }}">{{ Str::limit($p->name, 25) }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Stage --}}
                        <div style="min-width: 140px;">
                            <label style="font-size: 0.65rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.15rem; display: block;">Stage</label>
                            <select wire:model="filterStage" class="form-control z-filter-select">
                                <option value="">All Stages</option>
                                @foreach($this->stages as $m)
                                    <option value="{{ $m->id }}">{{ Str::limit($m->name, 22) }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Office --}}
                        <div style="min-width: 150px;">
                            <label style="font-size: 0.65rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 0.15rem; display: block;">Office</label>
                            <select wire:model="filterOffice" class="form-control z-filter-select">
                                <option value="">All Offices</option>
                                @foreach($this->offices as $o)
                                    <option value="{{ $o->id }}">{{ Str::limit($o->responsible_office, 22) }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Clear --}}
                        @if($search || $filterStatus || $filterClient || $filterProcess || $filterStage || $filterOffice)
                            <div style="padding-bottom: 2px;">
                                <button wire:click="clearFilters" class="btn btn-sm btn-outline-secondary" style="border-radius: 6px; font-size: 0.78rem;">
                                    <i class="fas fa-times mr-1"></i> Clear
                                </button>
                            </div>
                        @endif
                    </div>

                    {{-- ── Tasks Table ── --}}
                    <div class="table-responsive">
                        <table class="table z-table mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 36px;">#</th>
                                    <th style="min-width: 200px;">Task</th>
                                    <th style="min-width: 130px;">Client</th>
                                    <th>Process / Stage</th>
                                    <th style="width: 50px;">Order</th>
                                    <th style="width: 90px;">Max Days</th>
                                    <th style="width: 105px;">Status</th>
                                    <th>Offices</th>
                                    <th style="width: 100px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tasks as $idx => $tp)
                                    @php
                                        $task = $tp->processTask;
                                        $cp   = $tp->clientProcess;
                                        $statusConfig = [
                                            'pending'     => ['color' => '#f59e0b', 'bg' => '#fffbeb',  'label' => 'Pending'],
                                            'in_progress' => ['color' => '#3b82f6', 'bg' => '#eff6ff',  'label' => 'In Progress'],
                                            'completed'   => ['color' => '#10b981', 'bg' => '#ecfdf5',  'label' => 'Completed'],
                                            'skipped'     => ['color' => '#6b7280', 'bg' => '#f3f4f6',  'label' => 'Skipped'],
                                        ];
                                        $sCfg = $statusConfig[$tp->status] ?? $statusConfig['pending'];
                                    @endphp
                                    <tr>
                                        <td style="color: #94a3b8; font-size: 0.78rem;">{{ $tasks->firstItem() + $idx }}</td>
                                        <td>
                                            <div style="font-weight: 600; color: {{ $tp->status === 'completed' ? '#94a3b8' : '#1a2332' }}; font-size: 0.82rem; {{ $tp->status === 'completed' ? 'text-decoration: line-through;' : '' }}">
                                                {{ $task->title ?? '—' }}
                                            </div>
                                            @if($task && $task->description)
                                                <div style="font-size: 0.7rem; color: #94a3b8;">{{ Str::limit($task->description, 50) }}</div>
                                            @endif
                                            @if($tp->remarks)
                                                <div style="font-size: 0.65rem; color: #78350f; background: #fffbeb; padding: 0.1rem 0.35rem; border-radius: 4px; margin-top: 0.15rem; display: inline-block;">
                                                    <i class="fas fa-comment-dots mr-1" style="font-size: 0.55rem;"></i>{{ Str::limit($tp->remarks, 40) }}
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if($cp && $cp->client)
                                                <div class="d-flex align-items-center" style="gap: 0.35rem;">
                                                    <div style="width: 22px; height: 22px; border-radius: 6px; background: linear-gradient(135deg, var(--z-green), var(--z-green-dark)); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 0.5rem; font-weight: 700; flex-shrink: 0;">
                                                        {{ strtoupper(substr($cp->client->company_name, 0, 2)) }}
                                                    </div>
                                                    <a href="{{ route('clients.show', $cp->client->id) }}" style="font-size: 0.78rem; font-weight: 600; color: #1a2332; text-decoration: none;"
                                                       onmouseover="this.style.color='var(--z-green)'" onmouseout="this.style.color='#1a2332'">
                                                        {{ Str::limit($cp->client->company_name, 20) }}
                                                    </a>
                                                </div>
                                            @else
                                                <span style="color: #94a3b8;">—</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($cp && $cp->process)
                                                <div style="font-size: 0.72rem; font-weight: 600; color: #374151;">{{ Str::limit($cp->process->name, 20) }}</div>
                                            @endif
                                            @if($task && $task->stage)
                                                <span class="z-badge" style="font-size: 0.62rem;">{{ Str::limit($task->stage->name, 18) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($task)
                                                <span class="z-badge-orange" style="font-size: 0.72rem; padding: 0.1rem 0.4rem;">{{ $task->order_number }}</span>
                                            @else
                                                <span style="color: #94a3b8;">—</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($task && $task->max_days)
                                                <span style="font-size: 0.78rem; font-weight: 600; color: var(--z-orange-dark);"><i class="fas fa-clock mr-1" style="font-size: 0.65rem;"></i>{{ $task->max_days_label }}</span>
                                            @else
                                                <span style="color: #94a3b8;">—</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span style="font-size: 0.72rem; font-weight: 600; color: {{ $sCfg['color'] }}; background: {{ $sCfg['bg'] }}; padding: 0.15rem 0.5rem; border-radius: 10px; display: inline-block;">
                                                {{ $sCfg['label'] }}
                                            </span>
                                            @if($tp->status === 'completed' && $tp->completed_at)
                                                <div style="font-size: 0.6rem; color: #94a3b8; margin-top: 0.1rem;">{{ $tp->completed_at->format('d M Y') }}</div>
                                            @endif
                                        </td>
                                        <td>
                                            @if($task && $task->offices->count() > 0)
                                                @foreach($task->offices->take(2) as $off)
                                                    <span class="z-badge" style="font-size: 0.6rem; margin-bottom: 2px; display: inline-block;">{{ Str::limit($off->responsible_office, 14) }}</span>
                                                @endforeach
                                                @if($task->offices->count() > 2)
                                                    <span style="font-size: 0.6rem; color: #94a3b8;">+{{ $task->offices->count() - 2 }}</span>
                                                @endif
                                            @else
                                                <span style="font-size: 0.72rem; color: #cbd5e1;">—</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex" style="gap: 4px;">
                                                <a href="{{ route('client-tasks.show', $tp->id) }}" class="z-action z-action-view" title="View / Action">
                                                    <i class="fas fa-external-link-alt"></i>
                                                </a>
                                                @if($tp->status !== 'completed')
                                                    <a href="{{ route('client-tasks.show', $tp->id) }}" class="z-action z-action-edit" title="Action Task">
                                                        <i class="fas fa-bolt"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4" style="color: #94a3b8;">
                                            <i class="fas fa-clipboard-list fa-2x d-block mb-2" style="opacity: 0.3;"></i>
                                            @if($search || $filterStatus || $filterClient || $filterProcess || $filterStage || $filterOffice)
                                                No tasks match your filters. Try adjusting or <a href="#" wire:click.prevent="clearFilters" style="color: var(--z-green);">clearing them</a>.
                                            @else
                                                No client tasks found. Assign a process to a client to begin tracking.
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
    </section>
</div>
