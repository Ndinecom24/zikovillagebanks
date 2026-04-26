<div>
    @push('custom-styles')
    <style>
        :root {
            --pm-navy:#1E3A5F; --pm-navy-light:#2B6B96; --pm-amber:#D97706; --pm-amber-light:#F59E0B;
            --pm-bg:#f4f6fa; --pm-card:#fff; --pm-border:#edf0f7; --pm-text:#1e293b;
            --pm-muted:#64748b; --pm-faint:#94a3b8; --pm-green:#16a34a; --pm-red:#dc2626;
            --pm-blue:#2563eb; --pm-radius:16px;
        }
        .pm-page { background:var(--pm-bg); min-height:100vh; }
        .pm-hero {
            background:linear-gradient(135deg,var(--pm-navy) 0%,#234b78 50%,var(--pm-navy-light) 100%);
            padding:1.75rem 0 5.5rem; position:relative; overflow:hidden;
        }
        .pm-hero::before { content:''; position:absolute; width:500px; height:500px; top:-55%; right:-6%; background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
        .pm-hero-inner { position:relative; z-index:2; padding:0 1.5rem; }
        .pm-breadcrumb { display:flex; gap:.5rem; list-style:none; padding:0; margin:0 0 .75rem; font-size:.82rem; flex-wrap:wrap; align-items:center; }
        .pm-breadcrumb a { color:rgba(255,255,255,.55); text-decoration:none; transition:color .15s; }
        .pm-breadcrumb a:hover { color:rgba(255,255,255,.85); }
        .pm-breadcrumb .active { color:var(--pm-amber-light); font-weight:600; }
        .pm-breadcrumb .sep { color:rgba(255,255,255,.25); }
        .pm-hero-row { display:flex; align-items:flex-start; justify-content:space-between; gap:1rem; flex-wrap:wrap; }
        .pm-hero-title h1 { color:#fff; font-size:1.4rem; font-weight:800; margin:0; }
        .pm-hero-title h1 i { color:var(--pm-amber); margin-right:.5rem; }
        .pm-hero-sub { color:rgba(255,255,255,.55); font-size:.84rem; margin:.2rem 0 0; }
        .pm-hero-actions { display:flex; gap:.5rem; flex-wrap:wrap; }
        .pm-btn-back {
            display:inline-flex; align-items:center; gap:.35rem; padding:.45rem 1rem; border-radius:10px;
            font-size:.78rem; font-weight:600; background:rgba(255,255,255,.1); color:rgba(255,255,255,.75);
            border:1px solid rgba(255,255,255,.15); cursor:pointer; transition:all .15s; text-decoration:none;
        }
        .pm-btn-back:hover { background:rgba(255,255,255,.18); color:#fff; text-decoration:none; }
        .pm-btn-gen {
            display:inline-flex; align-items:center; gap:.35rem; padding:.5rem 1.15rem; border-radius:10px;
            font-size:.78rem; font-weight:700; background:var(--pm-amber); color:#fff;
            border:none; cursor:pointer; transition:all .15s;
        }
        .pm-btn-gen:hover { background:#c2690a; }
        .pm-btn-add {
            display:inline-flex; align-items:center; gap:.35rem; padding:.5rem 1.15rem; border-radius:10px;
            font-size:.78rem; font-weight:700; background:var(--pm-green); color:#fff;
            border:none; cursor:pointer; transition:all .15s;
        }
        .pm-btn-add:hover { background:#15803d; }
        .pm-content { margin-top:-4rem; position:relative; z-index:10; padding:0 1.5rem 2rem; }

        /* Flash */
        .pm-flash { display:flex; align-items:center; gap:.5rem; padding:.7rem 1.15rem; border-radius:12px; font-size:.84rem; font-weight:600; margin-bottom:1rem; }
        .pm-flash-success { background:#f0fdf4; color:var(--pm-green); border:1px solid #bbf7d0; }
        .pm-flash-warning { background:#fffbeb; color:#92400e; border:1px solid #fde68a; }

        /* Month info strip */
        .pm-info-strip {
            background:var(--pm-card); border-radius:var(--pm-radius); border:1px solid var(--pm-border);
            padding:1rem 1.25rem; display:flex; align-items:center; gap:1rem; flex-wrap:wrap;
            box-shadow:0 2px 12px rgba(0,0,0,.04); margin-bottom:1rem;
        }
        .pm-info-icon {
            width:46px; height:46px; border-radius:50%; display:flex; align-items:center; justify-content:center;
            background:linear-gradient(135deg,var(--pm-amber),var(--pm-amber-light)); flex-shrink:0;
        }
        .pm-info-icon i { color:#fff; font-size:1.15rem; }
        .pm-info-name { font-weight:700; font-size:.95rem; color:var(--pm-text); }
        .pm-info-meta { font-size:.72rem; color:var(--pm-faint); margin-top:.1rem; }
        .pm-badge {
            display:inline-flex; align-items:center; gap:.25rem; padding:.22rem .6rem; border-radius:8px;
            font-size:.65rem; font-weight:700; white-space:nowrap;
        }
        .pm-badge-pending { background:rgba(217,119,6,.08); color:#92400e; border:1px solid #fde68a; }
        .pm-badge-active { background:rgba(37,99,235,.06); color:#1e40af; border:1px solid rgba(37,99,235,.18); }
        .pm-badge-closed { background:rgba(100,116,139,.08); color:#475569; border:1px solid #cbd5e1; }

        /* Phase timeline */
        .pm-timeline { position:relative; padding-left:2rem; }
        .pm-timeline::before {
            content:''; position:absolute; left:.85rem; top:0; bottom:0; width:2px;
            background:linear-gradient(180deg,var(--pm-border) 0%,var(--pm-navy) 50%,var(--pm-border) 100%);
        }
        .pm-phase-item { position:relative; margin-bottom:.75rem; }
        .pm-phase-dot {
            position:absolute; left:-2rem; top:1.1rem; width:14px; height:14px; border-radius:50%;
            border:2px solid var(--pm-border); background:var(--pm-card); z-index:2;
            display:flex; align-items:center; justify-content:center;
        }
        .pm-phase-dot.pending { border-color:var(--pm-amber); }
        .pm-phase-dot.active { border-color:var(--pm-blue); background:var(--pm-blue); box-shadow:0 0 0 4px rgba(37,99,235,.12); }
        .pm-phase-dot.active::after { content:''; width:5px; height:5px; border-radius:50%; background:#fff; }
        .pm-phase-dot.completed { border-color:var(--pm-green); background:var(--pm-green); }
        .pm-phase-dot.completed::after { content:'\f00c'; font-family:'Font Awesome 5 Free'; font-weight:900; font-size:.4rem; color:#fff; }

        .pm-phase-card {
            background:var(--pm-card); border-radius:var(--pm-radius); border:1px solid var(--pm-border);
            box-shadow:0 2px 12px rgba(0,0,0,.04); overflow:hidden; transition:all .2s;
        }
        .pm-phase-card:hover { box-shadow:0 6px 20px rgba(0,0,0,.07); }
        .pm-phase-card.is-active { border-color:var(--pm-blue); box-shadow:0 0 0 3px rgba(37,99,235,.08); }
        .pm-phase-card.is-completed { opacity:.85; }
        .pm-phase-row {
            padding:.85rem 1.15rem; display:flex; align-items:center; gap:.75rem; flex-wrap:wrap;
        }
        .pm-phase-num {
            width:32px; height:32px; border-radius:8px; display:flex; align-items:center; justify-content:center;
            font-weight:800; font-size:.72rem; color:#fff; flex-shrink:0;
            background:linear-gradient(135deg,var(--pm-navy),var(--pm-navy-light));
        }
        .pm-phase-card.is-active .pm-phase-num { background:linear-gradient(135deg,var(--pm-blue),#3b82f6); }
        .pm-phase-card.is-completed .pm-phase-num { background:linear-gradient(135deg,var(--pm-green),#22c55e); }
        .pm-phase-name { font-weight:700; font-size:.88rem; color:var(--pm-text); }
        .pm-phase-dates { font-size:.72rem; color:var(--pm-faint); margin-top:.1rem; }
        .pm-phase-dates i { font-size:.55rem; color:var(--pm-amber); margin-right:.2rem; }
        .pm-phase-status { font-size:.62rem; font-weight:700; padding:.18rem .55rem; border-radius:6px; text-transform:uppercase; letter-spacing:.3px; }
        .pm-st-pending { background:rgba(217,119,6,.08); color:#92400e; border:1px solid #fde68a; }
        .pm-st-active { background:rgba(37,99,235,.08); color:var(--pm-blue); border:1px solid rgba(37,99,235,.2); }
        .pm-st-completed { background:rgba(22,163,74,.06); color:var(--pm-green); border:1px solid rgba(22,163,74,.15); }
        .pm-phase-actions { display:flex; gap:.4rem; margin-left:auto; }
        .pm-act {
            display:inline-flex; align-items:center; gap:.25rem; padding:.3rem .7rem; border-radius:8px;
            font-size:.68rem; font-weight:700; border:none; cursor:pointer; transition:all .15s;
        }
        .pm-act-activate { background:rgba(37,99,235,.08); color:var(--pm-blue); }
        .pm-act-activate:hover { background:var(--pm-blue); color:#fff; }
        .pm-act-complete { background:rgba(22,163,74,.08); color:var(--pm-green); }
        .pm-act-complete:hover { background:var(--pm-green); color:#fff; }
        .pm-act-edit { background:rgba(100,116,139,.06); color:var(--pm-muted); }
        .pm-act-edit:hover { background:var(--pm-muted); color:#fff; }
        .pm-act-delete { background:rgba(220,38,38,.06); color:var(--pm-red); }
        .pm-act-delete:hover { background:var(--pm-red); color:#fff; }
        .pm-act-done { font-size:.72rem; color:var(--pm-green); font-weight:600; display:flex; align-items:center; gap:.25rem; }

        /* Duration chip & progress */
        .pm-dur { font-size:.68rem; color:var(--pm-faint); font-weight:600; white-space:nowrap; }
        .pm-phase-progress { height:3px; background:rgba(30,58,95,.06); border-radius:3px; margin-top:.35rem; flex:1; min-width:60px; }
        .pm-phase-progress-bar { height:100%; border-radius:3px; }

        /* Empty */
        .pm-empty-card {
            background:var(--pm-card); border-radius:var(--pm-radius); border:1px solid var(--pm-border);
            text-align:center; padding:3.5rem 1rem; box-shadow:0 2px 12px rgba(0,0,0,.04);
        }
        .pm-empty-card i { font-size:2.5rem; opacity:.12; display:block; margin-bottom:.6rem; color:var(--pm-navy); }

        /* Modal */
        .pm-overlay {
            position:fixed; inset:0; background:rgba(15,23,42,.45); backdrop-filter:blur(4px);
            z-index:1050; display:flex; align-items:center; justify-content:center; padding:1rem;
        }
        .pm-modal {
            background:#fff; border-radius:var(--pm-radius); width:95%; max-width:480px;
            box-shadow:0 20px 40px rgba(0,0,0,.12); animation:pmSlide .25s ease; overflow:hidden;
        }
        .pm-modal-header {
            padding:1rem 1.5rem; display:flex; align-items:center; justify-content:space-between;
        }
        .pm-modal-header.green { background:linear-gradient(135deg,var(--pm-green),#22c55e); }
        .pm-modal-header.navy { background:linear-gradient(135deg,var(--pm-navy),var(--pm-navy-light)); }
        .pm-modal-header h5 { color:#fff; font-size:.92rem; font-weight:700; margin:0; display:flex; align-items:center; gap:.4rem; }
        .pm-modal-close { background:none; border:none; color:rgba(255,255,255,.6); font-size:1.2rem; cursor:pointer; }
        .pm-modal-close:hover { color:#fff; }
        .pm-modal-body { padding:1.5rem; }
        .pm-modal-footer {
            padding:1rem 1.5rem; border-top:1px solid var(--pm-border); display:flex; justify-content:flex-end; gap:.65rem;
        }
        .pm-label { font-size:.72rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--pm-faint); margin-bottom:.35rem; display:block; }
        .pm-input {
            width:100%; padding:.5rem .75rem; border:1px solid var(--pm-border); border-radius:10px;
            font-size:.84rem; background:#fafbfd; transition:all .2s;
        }
        .pm-input:focus { outline:none; border-color:var(--pm-amber); background:#fff; box-shadow:0 0 0 3px rgba(217,119,6,.08); }
        .pm-btn-cancel { padding:.45rem 1.25rem; border-radius:10px; font-size:.82rem; font-weight:600; background:#f1f5f9; color:var(--pm-text); border:1px solid var(--pm-border); cursor:pointer; }
        .pm-btn-cancel:hover { background:#e2e8f0; }
        .pm-btn-confirm {
            padding:.5rem 1.15rem; border-radius:10px; font-size:.82rem; font-weight:700; border:none; color:#fff; cursor:pointer;
            display:inline-flex; align-items:center; gap:.35rem;
        }
        .pm-btn-confirm.green { background:var(--pm-green); }
        .pm-btn-confirm.green:hover { background:#15803d; }
        .pm-btn-confirm.blue { background:var(--pm-blue); }
        .pm-btn-confirm.blue:hover { background:#1d4ed8; }
        .pm-btn-confirm.red { background:var(--pm-red); }
        .pm-btn-confirm.red:hover { background:#b91c1c; }

        .pm-modal-icon {
            width:56px; height:56px; border-radius:50%; display:flex; align-items:center; justify-content:center;
            margin:0 auto 1rem;
        }
        .pm-modal-center { text-align:center; padding:2rem 1.5rem; }
        .pm-modal-center h5 { font-weight:700; color:var(--pm-text); margin:0 0 .4rem; font-size:1rem; }
        .pm-modal-center p { font-size:.84rem; color:var(--pm-muted); margin:0 0 1.5rem; line-height:1.55; }

        @keyframes pmSlide { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
        @media(max-width:768px){ .pm-content{padding:0 .75rem 1.5rem;} .pm-timeline{padding-left:1.5rem;} .pm-phase-dot{left:-1.5rem;} }
    </style>
    @endpush

    @can('manage-months')
    <section class="content pm-page">
        {{-- Hero --}}
        <div class="pm-hero">
            <div class="pm-hero-inner container-fluid">
                <ul class="pm-breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('circles.index') }}">Circles</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('circles.members', $month->circle_id) }}">{{ $month->circle->name }}</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('months.index', $month->circle_id) }}">Months</a></li>
                    <li class="sep">/</li>
                    <li class="active">Month {{ $month->month_number }} Phases</li>
                </ul>
                <div class="pm-hero-row">
                    <div class="pm-hero-title">
                        <h1><i class="fas fa-layer-group"></i>Month {{ $month->month_number }} — Phases</h1>
                        <p class="pm-hero-sub">Manage phases within this monthly period</p>
                    </div>
                    <div class="pm-hero-actions">
                        <a href="{{ route('months.index', $month->circle_id) }}" class="pm-btn-back">
                            <i class="fas fa-arrow-left"></i> Back to Months
                        </a>
                        <button wire:click="generateDefaults" class="pm-btn-gen">
                            <i class="fas fa-magic"></i> Generate Defaults
                        </button>
                        <button wire:click="openCreate" class="pm-btn-add">
                            <i class="fas fa-plus"></i> Add Phase
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="pm-content container-fluid">
            {{-- Flash --}}
            @if (session()->has('message'))
                <div class="pm-flash pm-flash-success"><i class="fas fa-check-circle"></i> {{ session('message') }}</div>
            @endif
            @if (session()->has('warning'))
                <div class="pm-flash pm-flash-warning"><i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}</div>
            @endif

            {{-- Month info strip --}}
            <div class="pm-info-strip">
                <div class="pm-info-icon"><i class="fas fa-calendar-day"></i></div>
                <div style="flex:1;min-width:140px;">
                    <div class="pm-info-name">{{ $month->circle->name }} — Month {{ $month->month_number }}</div>
                    <div class="pm-info-meta">
                        {{ $month->start_date->format('d M Y') }} — {{ $month->end_date->format('d M Y') }}
                        &bull; {{ $month->start_date->diffInDays($month->end_date) + 1 }} days
                    </div>
                </div>
                @php
                    $mStatusClass = [
                        'pending' => 'pm-badge-pending',
                        'active' => 'pm-badge-active',
                        'closed' => 'pm-badge-closed',
                    ][$month->status] ?? 'pm-badge-pending';
                @endphp
                <span class="pm-badge {{ $mStatusClass }}">
                    <i class="fas fa-{{ $month->status === 'active' ? 'bolt' : ($month->status === 'closed' ? 'lock' : 'clock') }}" style="font-size:.5rem;"></i>
                    {{ ucfirst($month->status) }}
                </span>
            </div>

            {{-- Phases timeline --}}
            @if ($phases->count() > 0)
                <div class="pm-timeline">
                    @foreach ($phases as $idx => $p)
                        @php
                            $pDays = \Carbon\Carbon::parse($p->start_date)->diffInDays(\Carbon\Carbon::parse($p->end_date)) + 1;
                            $pNow = now();
                            $pIsActive = $p->status === 'active';
                            $pIsCurrent = $pIsActive && $pNow->between(\Carbon\Carbon::parse($p->start_date), \Carbon\Carbon::parse($p->end_date));
                            $pElapsed = $pIsCurrent ? max(0, \Carbon\Carbon::parse($p->start_date)->diffInDays($pNow)) : ($p->status === 'completed' ? $pDays : 0);
                            $pPct = $pDays > 0 ? min(100, round(($pElapsed / $pDays) * 100)) : 0;
                            $pBarColor = $pIsActive ? 'var(--pm-blue)' : ($p->status === 'completed' ? 'var(--pm-green)' : 'var(--pm-amber)');
                            $cardClass = $pIsActive ? 'is-active' : ($p->status === 'completed' ? 'is-completed' : '');
                        @endphp
                        <div class="pm-phase-item">
                            <div class="pm-phase-dot {{ $p->status }}"></div>
                            <div class="pm-phase-card {{ $cardClass }}">
                                <div class="pm-phase-row">
                                    <div class="pm-phase-num">{{ $idx + 1 }}</div>
                                    <div style="flex:1;min-width:120px;">
                                        <div class="pm-phase-name">{{ $p->name }}</div>
                                        <div class="pm-phase-dates">
                                            <i class="fas fa-clock"></i>
                                            {{ \Carbon\Carbon::parse($p->start_date)->format('d M, H:i') }}
                                            &rarr;
                                            {{ \Carbon\Carbon::parse($p->end_date)->format('d M, H:i') }}
                                        </div>
                                    </div>
                                    <div style="display:flex;flex-direction:column;align-items:flex-end;gap:.3rem;min-width:80px;">
                                        <span class="pm-phase-status pm-st-{{ $p->status }}">{{ ucfirst($p->status) }}</span>
                                        <span class="pm-dur"><i class="fas fa-hourglass-half" style="font-size:.5rem;margin-right:.15rem;"></i>{{ $pDays }} days</span>
                                    </div>
                                    <div class="pm-phase-actions">
                                        @if ($p->status === 'pending')
                                            <button wire:click="openStatusModal({{ $p->id }}, 'active')" class="pm-act pm-act-activate" title="Activate">
                                                <i class="fas fa-play"></i> Activate
                                            </button>
                                            <button wire:click="openEdit({{ $p->id }})" class="pm-act pm-act-edit" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button wire:click="confirmDelete({{ $p->id }})" class="pm-act pm-act-delete" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @elseif ($p->status === 'active')
                                            <button wire:click="openStatusModal({{ $p->id }}, 'completed')" class="pm-act pm-act-complete" title="Complete">
                                                <i class="fas fa-check"></i> Complete
                                            </button>
                                        @else
                                            <span class="pm-act-done"><i class="fas fa-check-circle"></i> Done</span>
                                        @endif
                                    </div>
                                </div>
                                @if ($pIsActive || $p->status === 'completed')
                                    <div style="padding:0 1.15rem .65rem;">
                                        <div class="pm-phase-progress">
                                            <div class="pm-phase-progress-bar" style="width:{{ $pPct }}%;background:{{ $pBarColor }};"></div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="pm-empty-card">
                    <i class="fas fa-layer-group"></i>
                    <p style="font-size:.88rem;color:var(--pm-muted);margin:0;">No phases created yet.</p>
                    <p style="font-size:.78rem;color:var(--pm-faint);margin:.3rem 0 0;">
                        Use <strong>Generate Defaults</strong> for a quick setup or <strong>Add Phase</strong> manually.
                    </p>
                </div>
            @endif
        </div>
    </section>

    {{-- ===== CREATE/EDIT PHASE MODAL ===== --}}
    @if ($showFormModal)
        <div class="pm-overlay" wire:click.self="$set('showFormModal', false)">
            <div class="pm-modal">
                <div class="pm-modal-header {{ $editingId ? 'navy' : 'green' }}">
                    <h5><i class="fas fa-{{ $editingId ? 'edit' : 'plus' }}"></i> {{ $editingId ? 'Edit' : 'Add' }} Phase</h5>
                    <button type="button" class="pm-modal-close" wire:click="$set('showFormModal', false)">&times;</button>
                </div>
                <form wire:submit.prevent="savePhase">
                    <div class="pm-modal-body">
                        <div style="margin-bottom:1.25rem;">
                            <label class="pm-label">Phase Name <span style="color:var(--pm-red);">*</span></label>
                            <input type="text" wire:model="phaseName" class="pm-input" placeholder="e.g. Share Collection">
                            @error('phaseName') <small style="color:var(--pm-red);font-size:.72rem;">{{ $message }}</small> @enderror
                        </div>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem;">
                            <div>
                                <label class="pm-label">Start Date &amp; Time <span style="color:var(--pm-red);">*</span></label>
                                <input type="datetime-local" wire:model="phaseStartDate" class="pm-input">
                                @error('phaseStartDate') <small style="color:var(--pm-red);font-size:.72rem;">{{ $message }}</small> @enderror
                            </div>
                            <div>
                                <label class="pm-label">End Date &amp; Time <span style="color:var(--pm-red);">*</span></label>
                                <input type="datetime-local" wire:model="phaseEndDate" class="pm-input">
                                @error('phaseEndDate') <small style="color:var(--pm-red);font-size:.72rem;">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="pm-modal-footer">
                        <button type="button" wire:click="$set('showFormModal', false)" class="pm-btn-cancel">Cancel</button>
                        <button type="submit" class="pm-btn-confirm green"
                            wire:loading.attr="disabled" wire:target="savePhase">
                            <span wire:loading.remove wire:target="savePhase">
                                <i class="fas fa-{{ $editingId ? 'check' : 'plus' }}"></i>
                                {{ $editingId ? 'Update' : 'Create' }} Phase
                            </span>
                            <span wire:loading wire:target="savePhase"><i class="fas fa-spinner fa-spin"></i></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- ===== STATUS CHANGE MODAL ===== --}}
    @if ($showStatusModal)
        <div class="pm-overlay" wire:click.self="$set('showStatusModal', false)">
            <div class="pm-modal">
                <div class="pm-modal-center">
                    @if ($targetStatus === 'active')
                        <div class="pm-modal-icon" style="background:rgba(37,99,235,.08);">
                            <i class="fas fa-play-circle" style="font-size:1.5rem;color:var(--pm-blue);"></i>
                        </div>
                        <h5>Activate Phase?</h5>
                        <p>This phase will become the current active phase for this month.</p>
                    @else
                        <div class="pm-modal-icon" style="background:rgba(22,163,74,.08);">
                            <i class="fas fa-check-circle" style="font-size:1.5rem;color:var(--pm-green);"></i>
                        </div>
                        <h5>Complete Phase?</h5>
                        <p>Mark this phase as completed? It cannot be reverted.</p>
                    @endif
                    <div style="display:flex;justify-content:center;gap:.65rem;">
                        <button wire:click="$set('showStatusModal', false)" class="pm-btn-cancel">Cancel</button>
                        <button wire:click="changePhaseStatus" class="pm-btn-confirm {{ $targetStatus === 'active' ? 'blue' : 'green' }}"
                            wire:loading.attr="disabled" wire:target="changePhaseStatus">
                            <span wire:loading.remove wire:target="changePhaseStatus">
                                <i class="fas fa-{{ $targetStatus === 'active' ? 'play' : 'check' }}"></i>
                                {{ $targetStatus === 'active' ? 'Activate' : 'Complete' }}
                            </span>
                            <span wire:loading wire:target="changePhaseStatus"><i class="fas fa-spinner fa-spin"></i></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- ===== DELETE PHASE MODAL ===== --}}
    @if ($deleteId)
        <div class="pm-overlay" wire:click.self="$set('deleteId', null)">
            <div class="pm-modal">
                <div class="pm-modal-center">
                    <div class="pm-modal-icon" style="background:rgba(220,38,38,.08);">
                        <i class="fas fa-exclamation-triangle" style="font-size:1.5rem;color:var(--pm-red);"></i>
                    </div>
                    <h5>Delete Phase?</h5>
                    <p>Delete <strong>{{ $deleteLabel }}</strong>? This cannot be undone.</p>
                    <div style="display:flex;justify-content:center;gap:.65rem;">
                        <button wire:click="$set('deleteId', null)" class="pm-btn-cancel">Cancel</button>
                        <button wire:click="deletePhase" class="pm-btn-confirm red"
                            wire:loading.attr="disabled" wire:target="deletePhase">
                            <span wire:loading.remove wire:target="deletePhase"><i class="fas fa-trash-alt"></i> Delete</span>
                            <span wire:loading wire:target="deletePhase"><i class="fas fa-spinner fa-spin"></i></span>
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
