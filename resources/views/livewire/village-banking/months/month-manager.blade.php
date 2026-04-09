<div>
    @push('custom-styles')
    <style>
        :root {
            --mm-navy:#1E3A5F; --mm-navy-light:#2B6B96; --mm-amber:#D97706; --mm-amber-light:#F59E0B;
            --mm-bg:#f4f6fa; --mm-card:#fff; --mm-border:#edf0f7; --mm-text:#1e293b;
            --mm-muted:#64748b; --mm-faint:#94a3b8; --mm-green:#16a34a; --mm-red:#dc2626;
            --mm-blue:#2563eb; --mm-radius:16px;
        }
        .mm-page { background:var(--mm-bg); min-height:100vh; }
        .mm-hero {
            background:linear-gradient(135deg,var(--mm-navy) 0%,#234b78 50%,var(--mm-navy-light) 100%);
            padding:1.75rem 0 5.5rem; position:relative; overflow:hidden;
        }
        .mm-hero::before { content:''; position:absolute; width:500px; height:500px; top:-55%; right:-6%; background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
        .mm-hero-inner { position:relative; z-index:2; padding:0 1.5rem; }
        .mm-breadcrumb { display:flex; gap:.5rem; list-style:none; padding:0; margin:0 0 .75rem; font-size:.82rem; flex-wrap:wrap; align-items:center; }
        .mm-breadcrumb a { color:rgba(255,255,255,.55); text-decoration:none; transition:color .15s; }
        .mm-breadcrumb a:hover { color:rgba(255,255,255,.85); }
        .mm-breadcrumb .active { color:var(--mm-amber-light); font-weight:600; }
        .mm-breadcrumb .sep { color:rgba(255,255,255,.25); }
        .mm-hero-row { display:flex; align-items:flex-start; justify-content:space-between; gap:1rem; flex-wrap:wrap; }
        .mm-hero-title h1 { color:#fff; font-size:1.4rem; font-weight:800; margin:0; }
        .mm-hero-title h1 i { color:var(--mm-amber); margin-right:.5rem; }
        .mm-hero-sub { color:rgba(255,255,255,.55); font-size:.84rem; margin:.2rem 0 0; }
        .mm-hero-actions { display:flex; gap:.5rem; flex-wrap:wrap; }
        .mm-btn-back {
            display:inline-flex; align-items:center; gap:.35rem; padding:.45rem 1rem; border-radius:10px;
            font-size:.78rem; font-weight:600; background:rgba(255,255,255,.1); color:rgba(255,255,255,.75);
            border:1px solid rgba(255,255,255,.15); cursor:pointer; transition:all .15s; text-decoration:none;
        }
        .mm-btn-back:hover { background:rgba(255,255,255,.18); color:#fff; text-decoration:none; }
        .mm-btn-gen {
            display:inline-flex; align-items:center; gap:.35rem; padding:.5rem 1.15rem; border-radius:10px;
            font-size:.78rem; font-weight:700; background:var(--mm-amber); color:#fff;
            border:none; cursor:pointer; transition:all .15s;
        }
        .mm-btn-gen:hover { background:#c2690a; }
        .mm-btn-add {
            display:inline-flex; align-items:center; gap:.35rem; padding:.5rem 1.15rem; border-radius:10px;
            font-size:.78rem; font-weight:700; background:var(--mm-green); color:#fff;
            border:none; cursor:pointer; transition:all .15s;
        }
        .mm-btn-add:hover { background:#15803d; }
        .mm-content { margin-top:-4rem; position:relative; z-index:10; padding:0 1.5rem 2rem; }

        /* Circle info strip */
        .mm-info-strip {
            background:var(--mm-card); border-radius:var(--mm-radius); border:1px solid var(--mm-border);
            padding:1rem 1.25rem; display:flex; align-items:center; gap:1rem; flex-wrap:wrap;
            box-shadow:0 2px 12px rgba(0,0,0,.04); margin-bottom:1rem;
        }
        .mm-info-icon {
            width:46px; height:46px; border-radius:50%; display:flex; align-items:center; justify-content:center;
            background:linear-gradient(135deg,var(--mm-navy),var(--mm-navy-light)); flex-shrink:0;
        }
        .mm-info-icon i { color:var(--mm-amber); font-size:1.15rem; }
        .mm-info-name { font-weight:700; font-size:.95rem; color:var(--mm-text); }
        .mm-info-meta { font-size:.72rem; color:var(--mm-faint); margin-top:.1rem; }
        .mm-info-badges { display:flex; gap:.4rem; flex-wrap:wrap; margin-left:auto; }
        .mm-badge {
            display:inline-flex; align-items:center; gap:.25rem; padding:.22rem .6rem; border-radius:8px;
            font-size:.65rem; font-weight:700; white-space:nowrap;
        }
        .mm-badge-status-draft { background:rgba(100,116,139,.08); color:#475569; border:1px solid #cbd5e1; }
        .mm-badge-status-active { background:rgba(37,99,235,.06); color:#1e40af; border:1px solid rgba(37,99,235,.18); }
        .mm-badge-status-completed { background:rgba(22,163,74,.06); color:#166534; border:1px solid rgba(22,163,74,.15); }
        .mm-badge-members { background:rgba(30,58,95,.05); color:var(--mm-navy); border:1px solid rgba(30,58,95,.12); }
        .mm-badge-months { background:rgba(217,119,6,.06); color:#92400e; border:1px solid #fde68a; }

        /* Flash */
        .mm-flash { display:flex; align-items:center; gap:.5rem; padding:.7rem 1.15rem; border-radius:12px; font-size:.84rem; font-weight:600; margin-bottom:1rem; }
        .mm-flash-success { background:#f0fdf4; color:var(--mm-green); border:1px solid #bbf7d0; }
        .mm-flash-warning { background:#fffbeb; color:#92400e; border:1px solid #fde68a; }

        /* Month card grid */
        .mm-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:.75rem; }
        .mm-month-card {
            background:var(--mm-card); border-radius:var(--mm-radius); border:1px solid var(--mm-border);
            box-shadow:0 2px 12px rgba(0,0,0,.04); overflow:hidden; transition:all .2s;
        }
        .mm-month-card:hover { box-shadow:0 6px 24px rgba(0,0,0,.08); transform:translateY(-2px); }
        .mm-month-card.is-active { border-color:var(--mm-blue); box-shadow:0 0 0 3px rgba(37,99,235,.08); }
        .mm-month-top {
            padding:.85rem 1rem .7rem; display:flex; align-items:center; justify-content:space-between;
            border-bottom:1px solid var(--mm-border);
        }
        .mm-month-num {
            width:36px; height:36px; border-radius:10px; display:flex; align-items:center; justify-content:center;
            font-weight:800; font-size:.85rem; color:#fff;
            background:linear-gradient(135deg,var(--mm-navy),var(--mm-navy-light));
        }
        .mm-month-card.is-active .mm-month-num { background:linear-gradient(135deg,var(--mm-blue),#3b82f6); }
        .mm-month-status { font-size:.62rem; font-weight:700; padding:.18rem .55rem; border-radius:6px; text-transform:uppercase; letter-spacing:.3px; }
        .mm-status-pending { background:rgba(217,119,6,.08); color:#92400e; border:1px solid #fde68a; }
        .mm-status-active { background:rgba(37,99,235,.08); color:var(--mm-blue); border:1px solid rgba(37,99,235,.2); }
        .mm-status-closed { background:rgba(100,116,139,.08); color:#475569; border:1px solid #cbd5e1; }
        .mm-month-body { padding:.85rem 1rem; }
        .mm-month-dates { font-size:.78rem; color:var(--mm-text); font-weight:600; margin-bottom:.5rem; }
        .mm-month-dates i { color:var(--mm-amber); font-size:.6rem; margin-right:.3rem; }
        .mm-month-meta { display:flex; gap:.65rem; }
        .mm-month-meta-item { font-size:.7rem; color:var(--mm-faint); display:flex; align-items:center; gap:.25rem; }
        .mm-month-meta-item i { font-size:.55rem; }
        .mm-month-actions {
            padding:.5rem 1rem .75rem; display:flex; gap:.4rem; border-top:1px solid #f8f9fc;
        }
        .mm-act {
            display:inline-flex; align-items:center; gap:.25rem; padding:.3rem .7rem; border-radius:8px;
            font-size:.68rem; font-weight:700; border:none; cursor:pointer; transition:all .15s; text-decoration:none;
        }
        .mm-act-phases { background:rgba(30,58,95,.06); color:var(--mm-navy); }
        .mm-act-phases:hover { background:var(--mm-navy); color:#fff; text-decoration:none; }
        .mm-act-activate { background:rgba(37,99,235,.08); color:var(--mm-blue); }
        .mm-act-activate:hover { background:var(--mm-blue); color:#fff; }
        .mm-act-close { background:rgba(100,116,139,.08); color:#475569; }
        .mm-act-close:hover { background:#475569; color:#fff; }
        .mm-act-delete { background:rgba(220,38,38,.06); color:var(--mm-red); }
        .mm-act-delete:hover { background:var(--mm-red); color:#fff; }

        /* Progress bar */
        .mm-progress-wrap { height:3px; background:rgba(30,58,95,.06); border-radius:3px; margin-top:.5rem; }
        .mm-progress-bar { height:100%; border-radius:3px; transition:width .3s; }

        /* Empty state */
        .mm-empty-card {
            background:var(--mm-card); border-radius:var(--mm-radius); border:1px solid var(--mm-border);
            text-align:center; padding:3.5rem 1rem; box-shadow:0 2px 12px rgba(0,0,0,.04);
        }
        .mm-empty-card i { font-size:2.5rem; opacity:.12; display:block; margin-bottom:.6rem; color:var(--mm-navy); }

        /* Modal overlay */
        .mm-overlay {
            position:fixed; inset:0; background:rgba(15,23,42,.45); backdrop-filter:blur(4px);
            z-index:1050; display:flex; align-items:center; justify-content:center; padding:1rem;
        }
        .mm-modal {
            background:#fff; border-radius:var(--mm-radius); width:95%; max-width:460px;
            box-shadow:0 20px 40px rgba(0,0,0,.12); animation:mmSlide .25s ease; overflow:hidden;
        }
        .mm-modal-header {
            padding:1rem 1.5rem; display:flex; align-items:center; justify-content:space-between;
        }
        .mm-modal-header.green { background:linear-gradient(135deg,var(--mm-green),#22c55e); }
        .mm-modal-header h5 { color:#fff; font-size:.92rem; font-weight:700; margin:0; display:flex; align-items:center; gap:.4rem; }
        .mm-modal-close { background:none; border:none; color:rgba(255,255,255,.6); font-size:1.2rem; cursor:pointer; }
        .mm-modal-close:hover { color:#fff; }
        .mm-modal-body { padding:1.5rem; }
        .mm-modal-footer {
            padding:1rem 1.5rem; border-top:1px solid var(--mm-border); display:flex; justify-content:flex-end; gap:.65rem;
        }
        .mm-label { font-size:.72rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--mm-faint); margin-bottom:.35rem; display:block; }
        .mm-input {
            width:100%; padding:.5rem .75rem; border:1px solid var(--mm-border); border-radius:10px;
            font-size:.84rem; background:#fafbfd; transition:all .2s;
        }
        .mm-input:focus { outline:none; border-color:var(--mm-amber); background:#fff; box-shadow:0 0 0 3px rgba(217,119,6,.08); }
        .mm-btn-cancel { padding:.45rem 1.25rem; border-radius:10px; font-size:.82rem; font-weight:600; background:#f1f5f9; color:var(--mm-text); border:1px solid var(--mm-border); cursor:pointer; }
        .mm-btn-cancel:hover { background:#e2e8f0; }
        .mm-btn-confirm {
            padding:.5rem 1.15rem; border-radius:10px; font-size:.82rem; font-weight:700; border:none; color:#fff; cursor:pointer;
            display:inline-flex; align-items:center; gap:.35rem;
        }
        .mm-btn-confirm.green { background:var(--mm-green); }
        .mm-btn-confirm.green:hover { background:#15803d; }
        .mm-btn-confirm.blue { background:var(--mm-blue); }
        .mm-btn-confirm.blue:hover { background:#1d4ed8; }
        .mm-btn-confirm.amber { background:var(--mm-amber); }
        .mm-btn-confirm.amber:hover { background:#c2690a; }
        .mm-btn-confirm.red { background:var(--mm-red); }
        .mm-btn-confirm.red:hover { background:#b91c1c; }
        .mm-btn-confirm.slate { background:#475569; }
        .mm-btn-confirm.slate:hover { background:#334155; }

        .mm-modal-icon {
            width:56px; height:56px; border-radius:50%; display:flex; align-items:center; justify-content:center;
            margin:0 auto 1rem;
        }
        .mm-modal-center { text-align:center; padding:2rem 1.5rem; }
        .mm-modal-center h5 { font-weight:700; color:var(--mm-text); margin:0 0 .4rem; font-size:1rem; }
        .mm-modal-center p { font-size:.84rem; color:var(--mm-muted); margin:0 0 1.5rem; line-height:1.55; }

        @keyframes mmSlide { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
        @media(max-width:768px){ .mm-content{padding:0 .75rem 1.5rem;} .mm-grid{grid-template-columns:1fr;} }
    </style>
    @endpush

    @can('manage-months')
    <section class="content mm-page">
        {{-- Hero --}}
        <div class="mm-hero">
            <div class="mm-hero-inner container-fluid">
                <ul class="mm-breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('circles.index') }}">Circles</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('circles.members', $circleId) }}">{{ $circle->name }}</a></li>
                    <li class="sep">/</li>
                    <li class="active">Months</li>
                </ul>
                <div class="mm-hero-row">
                    <div class="mm-hero-title">
                        <h1><i class="fas fa-calendar-alt"></i>{{ $circle->name }} — Months</h1>
                        <p class="mm-hero-sub">Manage monthly periods for this circle</p>
                    </div>
                    <div class="mm-hero-actions">
                        <a href="{{ route('circles.members', $circleId) }}" class="mm-btn-back">
                            <i class="fas fa-arrow-left"></i> Back to Circle
                        </a>
                        @if ($circle->status === 'active')
                            <button wire:click="openGenerateModal" class="mm-btn-gen">
                                <i class="fas fa-magic"></i> Auto-Generate
                            </button>
                            <button wire:click="openAddModal" class="mm-btn-add">
                                <i class="fas fa-plus"></i> Add Month
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="mm-content container-fluid">
            {{-- Flash --}}
            @if (session()->has('message'))
                <div class="mm-flash mm-flash-success"><i class="fas fa-check-circle"></i> {{ session('message') }}</div>
            @endif
            @if (session()->has('warning'))
                <div class="mm-flash mm-flash-warning"><i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}</div>
            @endif

            {{-- Circle info strip --}}
            <div class="mm-info-strip">
                <div class="mm-info-icon"><i class="fas fa-circle-notch"></i></div>
                <div style="flex:1;min-width:140px;">
                    <div class="mm-info-name">{{ $circle->name }}</div>
                    <div class="mm-info-meta">
                        {{ $circle->duration_months }} {{ Str::plural('month', $circle->duration_months) }}
                        &bull; {{ $circle->start_date->format('d M Y') }} — {{ $circle->end_date ? $circle->end_date->format('d M Y') : 'TBD' }}
                    </div>
                </div>
                <div class="mm-info-badges">
                    @php
                        $statusClass = [
                            'draft' => 'mm-badge-status-draft',
                            'active' => 'mm-badge-status-active',
                            'completed' => 'mm-badge-status-completed',
                        ][$circle->status] ?? 'mm-badge-status-draft';
                    @endphp
                    <span class="mm-badge {{ $statusClass }}">
                        <i class="fas fa-{{ $circle->status === 'active' ? 'bolt' : ($circle->status === 'completed' ? 'check-circle' : 'pencil-alt') }}" style="font-size:.5rem;"></i>
                        {{ ucfirst($circle->status) }}
                    </span>
                    <span class="mm-badge mm-badge-members">
                        <i class="fas fa-users" style="font-size:.5rem;"></i> {{ $circle->members_count }} members
                    </span>
                    <span class="mm-badge mm-badge-months">
                        <i class="fas fa-calendar" style="font-size:.5rem;"></i> {{ $months->count() }} / {{ $circle->duration_months }} months
                    </span>
                </div>
            </div>

            {{-- Month cards --}}
            @if ($months->count() > 0)
                <div class="mm-grid">
                    @foreach ($months as $m)
                        @php
                            $days = $m->start_date->diffInDays($m->end_date) + 1;
                            $now = now();
                            $isActive = $m->status === 'active';
                            $isCurrent = $isActive && $now->between($m->start_date, $m->end_date);
                            $elapsed = $isCurrent ? max(0, $m->start_date->diffInDays($now)) : ($m->status === 'closed' ? $days : 0);
                            $pct = $days > 0 ? min(100, round(($elapsed / $days) * 100)) : 0;
                            $barColor = $isActive ? 'var(--mm-blue)' : ($m->status === 'closed' ? '#94a3b8' : 'var(--mm-amber)');
                        @endphp
                        <div class="mm-month-card {{ $isActive ? 'is-active' : '' }}">
                            <div class="mm-month-top">
                                <div style="display:flex;align-items:center;gap:.6rem;">
                                    <div class="mm-month-num">{{ $m->month_number }}</div>
                                    <div>
                                        <div style="font-size:.82rem;font-weight:700;color:var(--mm-text);">Month {{ $m->month_number }}</div>
                                        @if ($isCurrent)
                                            <div style="font-size:.6rem;color:var(--mm-blue);font-weight:700;">
                                                <i class="fas fa-circle" style="font-size:.35rem;"></i> Current
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <span class="mm-month-status mm-status-{{ $m->status }}">{{ ucfirst($m->status) }}</span>
                            </div>
                            <div class="mm-month-body">
                                <div class="mm-month-dates">
                                    <i class="fas fa-calendar-day"></i>
                                    {{ $m->start_date->format('d M') }} — {{ $m->end_date->format('d M Y') }}
                                </div>
                                <div class="mm-month-meta">
                                    <div class="mm-month-meta-item">
                                        <i class="fas fa-clock"></i> {{ $days }} days
                                    </div>
                                    <div class="mm-month-meta-item">
                                        <i class="fas fa-layer-group"></i> {{ $m->phases_count }} {{ Str::plural('phase', $m->phases_count) }}
                                    </div>
                                </div>
                                <div class="mm-progress-wrap">
                                    <div class="mm-progress-bar" style="width:{{ $pct }}%;background:{{ $barColor }};"></div>
                                </div>
                            </div>
                            <div class="mm-month-actions">
                                <a href="{{ route('phases.index', $m->id) }}" class="mm-act mm-act-phases">
                                    <i class="fas fa-layer-group"></i> Phases
                                </a>
                                @if ($m->status === 'pending')
                                    <button wire:click="openStatusModal({{ $m->id }}, 'active')" class="mm-act mm-act-activate">
                                        <i class="fas fa-play"></i> Activate
                                    </button>
                                    <button wire:click="confirmDelete({{ $m->id }})" class="mm-act mm-act-delete" style="margin-left:auto;">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                @elseif ($m->status === 'active')
                                    <button wire:click="openStatusModal({{ $m->id }}, 'closed')" class="mm-act mm-act-close">
                                        <i class="fas fa-lock"></i> Close
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="mm-empty-card">
                    <i class="fas fa-calendar-alt"></i>
                    <p style="font-size:.88rem;color:var(--mm-muted);margin:0;">No months created yet.</p>
                    @if ($circle->status === 'active')
                        <p style="font-size:.78rem;color:var(--mm-faint);margin:.3rem 0 0;">
                            Use <strong>Auto-Generate</strong> to create all months or <strong>Add Month</strong> manually.
                        </p>
                    @endif
                </div>
            @endif
        </div>
    </section>

    {{-- ===== GENERATE MODAL ===== --}}
    @if ($showGenerateModal)
        <div class="mm-overlay" wire:click.self="$set('showGenerateModal', false)">
            <div class="mm-modal">
                <div class="mm-modal-center">
                    <div class="mm-modal-icon" style="background:rgba(37,99,235,.08);">
                        <i class="fas fa-magic" style="font-size:1.5rem;color:var(--mm-blue);"></i>
                    </div>
                    <h5>Auto-Generate Months?</h5>
                    <p>
                        This will create <strong>{{ $circle->duration_months }}</strong> monthly periods starting from
                        <strong>{{ $circle->start_date->format('d M Y') }}</strong>. Month 1 will be set to active.
                    </p>
                    <div style="display:flex;justify-content:center;gap:.65rem;">
                        <button wire:click="$set('showGenerateModal', false)" class="mm-btn-cancel">Cancel</button>
                        <button wire:click="generateMonths" class="mm-btn-confirm amber"
                            wire:loading.attr="disabled" wire:target="generateMonths">
                            <span wire:loading.remove wire:target="generateMonths"><i class="fas fa-magic"></i> Generate</span>
                            <span wire:loading wire:target="generateMonths"><i class="fas fa-spinner fa-spin"></i></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- ===== ADD MONTH MODAL ===== --}}
    @if ($showAddModal)
        <div class="mm-overlay" wire:click.self="$set('showAddModal', false)">
            <div class="mm-modal">
                <div class="mm-modal-header green">
                    <h5><i class="fas fa-plus"></i> Add Month</h5>
                    <button type="button" class="mm-modal-close" wire:click="$set('showAddModal', false)">&times;</button>
                </div>
                <form wire:submit.prevent="addMonth">
                    <div class="mm-modal-body">
                        <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:.75rem;">
                            <div>
                                <label class="mm-label">Month # <span style="color:var(--mm-red);">*</span></label>
                                <input type="number" wire:model.defer="monthNumber" class="mm-input" min="1">
                                @error('monthNumber') <small style="color:var(--mm-red);font-size:.72rem;">{{ $message }}</small> @enderror
                            </div>
                            <div>
                                <label class="mm-label">Start Date <span style="color:var(--mm-red);">*</span></label>
                                <input type="date" wire:model.defer="startDate" class="mm-input">
                                @error('startDate') <small style="color:var(--mm-red);font-size:.72rem;">{{ $message }}</small> @enderror
                            </div>
                            <div>
                                <label class="mm-label">End Date <span style="color:var(--mm-red);">*</span></label>
                                <input type="date" wire:model.defer="endDate" class="mm-input">
                                @error('endDate') <small style="color:var(--mm-red);font-size:.72rem;">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mm-modal-footer">
                        <button type="button" wire:click="$set('showAddModal', false)" class="mm-btn-cancel">Cancel</button>
                        <button type="submit" class="mm-btn-confirm green"
                            wire:loading.attr="disabled" wire:target="addMonth">
                            <span wire:loading.remove wire:target="addMonth"><i class="fas fa-plus"></i> Add Month</span>
                            <span wire:loading wire:target="addMonth"><i class="fas fa-spinner fa-spin"></i></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- ===== STATUS CHANGE MODAL ===== --}}
    @if ($showStatusModal)
        <div class="mm-overlay" wire:click.self="$set('showStatusModal', false)">
            <div class="mm-modal">
                <div class="mm-modal-center">
                    @if ($targetStatus === 'active')
                        <div class="mm-modal-icon" style="background:rgba(37,99,235,.08);">
                            <i class="fas fa-play-circle" style="font-size:1.5rem;color:var(--mm-blue);"></i>
                        </div>
                        <h5>Activate Month?</h5>
                        <p>Set this month to active? Members can then make share declarations, request loans, and submit payments.</p>
                    @else
                        <div class="mm-modal-icon" style="background:rgba(100,116,139,.08);">
                            <i class="fas fa-lock" style="font-size:1.5rem;color:#475569;"></i>
                        </div>
                        <h5>Close Month?</h5>
                        <p>Close this month? No further transactions will be allowed for this period.</p>
                    @endif
                    <div style="display:flex;justify-content:center;gap:.65rem;">
                        <button wire:click="$set('showStatusModal', false)" class="mm-btn-cancel">Cancel</button>
                        <button wire:click="changeMonthStatus" class="mm-btn-confirm {{ $targetStatus === 'active' ? 'blue' : 'slate' }}"
                            wire:loading.attr="disabled" wire:target="changeMonthStatus">
                            <span wire:loading.remove wire:target="changeMonthStatus">
                                <i class="fas fa-{{ $targetStatus === 'active' ? 'play' : 'lock' }}"></i>
                                {{ $targetStatus === 'active' ? 'Activate' : 'Close' }}
                            </span>
                            <span wire:loading wire:target="changeMonthStatus"><i class="fas fa-spinner fa-spin"></i></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- ===== DELETE MONTH MODAL ===== --}}
    @if ($deleteId)
        <div class="mm-overlay" wire:click.self="$set('deleteId', null)">
            <div class="mm-modal">
                <div class="mm-modal-center">
                    <div class="mm-modal-icon" style="background:rgba(220,38,38,.08);">
                        <i class="fas fa-exclamation-triangle" style="font-size:1.5rem;color:var(--mm-red);"></i>
                    </div>
                    <h5>Delete Month #{{ $deleteNumber }}?</h5>
                    <p>This will also remove all phases within this month. This action cannot be undone.</p>
                    <div style="display:flex;justify-content:center;gap:.65rem;">
                        <button wire:click="$set('deleteId', null)" class="mm-btn-cancel">Cancel</button>
                        <button wire:click="deleteMonth" class="mm-btn-confirm red"
                            wire:loading.attr="disabled" wire:target="deleteMonth">
                            <span wire:loading.remove wire:target="deleteMonth"><i class="fas fa-trash-alt"></i> Delete</span>
                            <span wire:loading wire:target="deleteMonth"><i class="fas fa-spinner fa-spin"></i></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
