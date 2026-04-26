<div>
    @push('custom-styles')
    <style>
        :root {
            --cl-navy:#1E3A5F; --cl-navy-light:#2B6B96; --cl-amber:#D97706; --cl-amber-light:#F59E0B;
            --cl-bg:#f4f6fa; --cl-card:#fff; --cl-border:#edf0f7; --cl-text:#1e293b;
            --cl-muted:#64748b; --cl-faint:#94a3b8; --cl-green:#16a34a; --cl-red:#dc2626; --cl-blue:#2563eb; --cl-radius:16px;
        }
        .cl-page { background:var(--cl-bg); min-height:100vh; }

        /* Hero */
        .cl-hero {
            background:linear-gradient(135deg,var(--cl-navy) 0%,#234b78 50%,var(--cl-navy-light) 100%);
            padding:1.75rem 0 6rem; position:relative; overflow:hidden;
        }
        .cl-hero::before { content:''; position:absolute; width:600px; height:600px; top:-60%; right:-8%; background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
        .cl-hero-inner { position:relative; z-index:2; padding:0 1.5rem; }
        .cl-breadcrumb { display:flex; gap:.5rem; list-style:none; padding:0; margin:0 0 .75rem; font-size:.82rem; }
        .cl-breadcrumb a { color:rgba(255,255,255,.55); text-decoration:none; }
        .cl-breadcrumb a:hover { color:rgba(255,255,255,.85); }
        .cl-breadcrumb .active { color:var(--cl-amber-light); font-weight:600; }
        .cl-breadcrumb .sep { color:rgba(255,255,255,.25); }
        .cl-hero-title { display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:.75rem; }
        .cl-hero-title h1 { color:#fff; font-size:1.6rem; font-weight:800; margin:0; }
        .cl-hero-title h1 i { color:var(--cl-amber); margin-right:.5rem; }
        .cl-hero-sub { color:rgba(255,255,255,.55); font-size:.88rem; margin:.25rem 0 0; }
        .cl-hero-btn {
            display:inline-flex; align-items:center; gap:.4rem; padding:.55rem 1.25rem; border-radius:10px;
            font-size:.82rem; font-weight:700; text-decoration:none; transition:all .2s;
            background:var(--cl-amber); color:#fff; border:none;
        }
        .cl-hero-btn:hover { background:var(--cl-amber-light); color:#fff; text-decoration:none; transform:translateY(-1px); box-shadow:0 4px 12px rgba(217,119,6,.25); }

        /* Content */
        .cl-content { margin-top:-4rem; position:relative; z-index:10; padding:0 1.5rem 2rem; }

        /* Stat cards */
        .cl-stats { display:grid; grid-template-columns:repeat(4,1fr); gap:1rem; margin-bottom:1.25rem; }
        @media(max-width:768px){ .cl-stats { grid-template-columns:repeat(2,1fr); } }
        .cl-stat {
            background:var(--cl-card); border-radius:var(--cl-radius); border:1px solid var(--cl-border);
            box-shadow:0 2px 12px rgba(0,0,0,.04); padding:1.1rem 1.25rem;
            display:flex; align-items:center; justify-content:space-between; transition:all .2s;
        }
        .cl-stat:hover { transform:translateY(-2px); box-shadow:0 6px 20px rgba(0,0,0,.06); }
        .cl-stat-label { font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--cl-faint); }
        .cl-stat-value { font-size:1.5rem; font-weight:800; color:var(--cl-text); margin-top:.1rem; }
        .cl-stat-icon {
            width:44px; height:44px; border-radius:12px; display:flex; align-items:center; justify-content:center;
            font-size:1rem; flex-shrink:0;
        }

        /* Table card */
        .cl-card {
            background:var(--cl-card); border-radius:var(--cl-radius); border:1px solid var(--cl-border);
            box-shadow:0 2px 12px rgba(0,0,0,.04); overflow:hidden;
        }
        .cl-card-header {
            padding:1rem 1.5rem; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:.75rem;
            border-bottom:1px solid var(--cl-border);
        }
        .cl-card-title { font-size:.95rem; font-weight:700; color:var(--cl-text); display:flex; align-items:center; gap:.4rem; }
        .cl-card-title i { color:var(--cl-amber); font-size:.8rem; }
        .cl-toolbar { display:flex; align-items:center; flex-wrap:wrap; gap:.6rem; }
        .cl-search {
            position:relative; display:flex; align-items:center;
        }
        .cl-search i { position:absolute; left:.75rem; font-size:.72rem; color:var(--cl-faint); }
        .cl-search input {
            padding:.45rem .75rem .45rem 2rem; border:1px solid var(--cl-border); border-radius:10px;
            font-size:.82rem; background:#fafbfd; width:200px; transition:border .2s;
        }
        .cl-search input:focus { outline:none; border-color:var(--cl-amber); background:#fff; box-shadow:0 0 0 3px rgba(217,119,6,.08); }
        .cl-select {
            padding:.45rem .75rem; border:1px solid var(--cl-border); border-radius:10px;
            font-size:.82rem; background:#fafbfd; cursor:pointer;
        }
        .cl-select:focus { outline:none; border-color:var(--cl-amber); }

        /* Table */
        .cl-table { width:100%; border-collapse:collapse; }
        .cl-table thead th {
            font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--cl-faint);
            padding:.7rem 1rem; border-bottom:1px solid var(--cl-border); background:#fafbfd; white-space:nowrap;
        }
        .cl-table thead th.sortable { cursor:pointer; user-select:none; }
        .cl-table thead th.sortable:hover { color:var(--cl-amber); }
        .cl-table tbody td { padding:.7rem 1rem; border-bottom:1px solid #f5f7fa; font-size:.84rem; vertical-align:middle; }
        .cl-table tbody tr:last-child td { border-bottom:none; }
        .cl-table tbody tr:hover { background:#fafbfd; }
        .cl-sort { font-size:.55rem; margin-left:.25rem; opacity:.4; }
        .cl-sort.active { opacity:1; color:var(--cl-amber); }

        /* Circle name cell */
        .cl-circle-cell { display:flex; align-items:center; gap:.65rem; }
        .cl-circle-icon {
            width:36px; height:36px; border-radius:10px; display:flex; align-items:center; justify-content:center;
            font-size:.75rem; flex-shrink:0;
            background:linear-gradient(135deg,var(--cl-navy),var(--cl-navy-light)); color:#fff;
        }
        .cl-circle-name { font-weight:700; color:var(--cl-text); font-size:.88rem; }
        .cl-circle-name a { color:var(--cl-text); text-decoration:none; }
        .cl-circle-name a:hover { color:var(--cl-amber); }
        .cl-circle-creator { font-size:.72rem; color:var(--cl-faint); margin-top:.1rem; }

        /* Badge */
        .cl-badge { display:inline-flex; align-items:center; gap:.2rem; padding:.2rem .55rem; border-radius:8px; font-size:.68rem; font-weight:700; white-space:nowrap; }
        .cl-badge-draft { background:#f1f5f9; color:#475569; border:1px solid #cbd5e1; }
        .cl-badge-active { background:rgba(37,99,235,.08); color:#1e40af; border:1px solid #bfdbfe; }
        .cl-badge-completed { background:rgba(22,163,74,.08); color:#166534; border:1px solid #bbf7d0; }
        .cl-badge-members { background:rgba(30,58,95,.06); color:var(--cl-navy); border:1px solid rgba(30,58,95,.15); }

        /* Actions */
        .cl-actions { display:flex; gap:4px; }
        .cl-act {
            width:30px; height:30px; border-radius:8px; display:flex; align-items:center; justify-content:center;
            border:1px solid var(--cl-border); background:#fafbfd; color:var(--cl-muted); cursor:pointer;
            font-size:.7rem; transition:all .15s; text-decoration:none;
        }
        .cl-act:hover { border-color:var(--cl-amber); color:var(--cl-amber); background:rgba(217,119,6,.05); }
        .cl-act-view:hover { border-color:var(--cl-blue); color:var(--cl-blue); background:rgba(37,99,235,.05); }
        .cl-act-members:hover { border-color:var(--cl-green); color:var(--cl-green); background:rgba(22,163,74,.05); }
        .cl-act-delete:hover { border-color:var(--cl-red); color:var(--cl-red); background:rgba(220,38,38,.05); }

        /* Footer */
        .cl-footer { padding:.85rem 1.5rem; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:.75rem; border-top:1px solid var(--cl-border); }
        .cl-footer-info { font-size:.78rem; color:var(--cl-faint); }

        /* Empty */
        .cl-empty { text-align:center; padding:3rem 1rem; }
        .cl-empty i { font-size:2.5rem; opacity:.12; display:block; margin-bottom:.75rem; color:var(--cl-navy); }
        .cl-empty p { font-size:.88rem; color:var(--cl-muted); margin:0; }
        .cl-empty a { color:var(--cl-amber); font-weight:600; text-decoration:none; }
        .cl-empty a:hover { text-decoration:underline; }

        /* Modal */
        .cl-overlay { position:fixed; inset:0; background:rgba(15,23,42,.45); backdrop-filter:blur(4px); z-index:1050; display:flex; align-items:center; justify-content:center; }
        .cl-modal {
            background:#fff; border-radius:var(--cl-radius); width:95%; max-width:420px;
            box-shadow:0 20px 40px rgba(0,0,0,.12); text-align:center; padding:2rem;
            animation:clSlide .25s ease;
        }
        .cl-modal-icon {
            width:56px; height:56px; border-radius:50%; display:inline-flex; align-items:center; justify-content:center;
            margin-bottom:1rem; font-size:1.4rem;
        }
        .cl-modal h5 { font-weight:700; font-size:1rem; color:var(--cl-text); margin-bottom:.5rem; }
        .cl-modal p { color:var(--cl-muted); font-size:.88rem; margin-bottom:1.5rem; }
        .cl-modal-btns { display:flex; justify-content:center; gap:.65rem; }
        .cl-btn-cancel { padding:.45rem 1.25rem; border-radius:10px; font-size:.82rem; font-weight:600; background:#f1f5f9; color:var(--cl-text); border:1px solid var(--cl-border); cursor:pointer; transition:all .15s; }
        .cl-btn-cancel:hover { background:#e2e8f0; }
        .cl-btn-danger { padding:.45rem 1.25rem; border-radius:10px; font-size:.82rem; font-weight:700; background:var(--cl-red); color:#fff; border:none; cursor:pointer; transition:all .15s; }
        .cl-btn-danger:hover { background:#b91c1c; }

        /* Flash */
        .cl-flash {
            display:flex; align-items:center; gap:.5rem; padding:.65rem 1rem; border-radius:10px; font-size:.84rem; font-weight:600;
            background:rgba(22,163,74,.08); color:#166534; border:1px solid #bbf7d0; margin-bottom:1rem;
        }

        @keyframes clSlide { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
        .cl-animate { animation:clSlide .3s ease; }
        @media(max-width:768px){ .cl-content{padding:0 .75rem 1.5rem;} .cl-search input{width:150px;} }
    </style>
    @endpush

    @can('view-circles')
    <section class="content cl-page">
        {{-- Hero --}}
        <div class="cl-hero">
            <div class="cl-hero-inner container-fluid">
                <ul class="cl-breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li class="active">Circles</li>
                </ul>
                <div class="cl-hero-title">
                    <div>
                        <h1><i class="fas fa-circle-notch"></i>Circles</h1>
                        <p class="cl-hero-sub">Manage village banking circles and savings cycles</p>
                    </div>
                    <a href="{{ route('circles.create') }}" class="cl-hero-btn">
                        <i class="fas fa-plus-circle"></i> Create Circle
                    </a>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="cl-content container-fluid cl-animate">

            {{-- Flash --}}
            @if (session()->has('message'))
                <div class="cl-flash">
                    <i class="fas fa-check-circle"></i> {{ session('message') }}
                </div>
            @endif

            {{-- Stat Cards --}}
            <div class="cl-stats">
                <div class="cl-stat">
                    <div>
                        <div class="cl-stat-label">Total Circles</div>
                        <div class="cl-stat-value">{{ $totalCircles }}</div>
                    </div>
                    <div class="cl-stat-icon" style="background:rgba(30,58,95,.08);color:var(--cl-navy);">
                        <i class="fas fa-circle-notch"></i>
                    </div>
                </div>
                <div class="cl-stat">
                    <div>
                        <div class="cl-stat-label">Draft</div>
                        <div class="cl-stat-value">{{ $draftCircles }}</div>
                    </div>
                    <div class="cl-stat-icon" style="background:#f1f5f9;color:#64748b;">
                        <i class="fas fa-pencil-alt"></i>
                    </div>
                </div>
                <div class="cl-stat">
                    <div>
                        <div class="cl-stat-label">Active</div>
                        <div class="cl-stat-value" style="color:var(--cl-blue);">{{ $activeCircles }}</div>
                    </div>
                    <div class="cl-stat-icon" style="background:rgba(37,99,235,.08);color:var(--cl-blue);">
                        <i class="fas fa-play-circle"></i>
                    </div>
                </div>
                <div class="cl-stat">
                    <div>
                        <div class="cl-stat-label">Completed</div>
                        <div class="cl-stat-value" style="color:var(--cl-green);">{{ $completedCircles }}</div>
                    </div>
                    <div class="cl-stat-icon" style="background:rgba(22,163,74,.08);color:var(--cl-green);">
                        <i class="fas fa-check-double"></i>
                    </div>
                </div>
            </div>

            {{-- Table Card --}}
            <div class="cl-card">
                <div class="cl-card-header">
                    <div class="cl-card-title"><i class="fas fa-list"></i> All Circles</div>
                    <div class="cl-toolbar">
                        @include('partials.village-bank-selector')
                        <select wire:model.live="statusFilter" class="cl-select">
                            <option value="">All Statuses</option>
                            <option value="draft">Draft</option>
                            <option value="active">Active</option>
                            <option value="completed">Completed</option>
                        </select>
                        <div class="cl-search">
                            <i class="fas fa-search"></i>
                            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search circles...">
                        </div>
                        <select wire:model.live="perPage" class="cl-select" style="width:70px;">
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>

                <div style="overflow-x:auto;">
                    <table class="cl-table">
                        <thead>
                            <tr>
                                <th class="sortable" wire:click="sortBy('name')">
                                    Circle
                                    <i class="fas fa-sort{{ $sortField === 'name' ? ($sortDirection === 'asc' ? '-up' : '-down') : '' }} cl-sort {{ $sortField === 'name' ? 'active' : '' }}"></i>
                                </th>
                                <th>Duration</th>
                                <th class="sortable" wire:click="sortBy('start_date')">
                                    Start
                                    <i class="fas fa-sort{{ $sortField === 'start_date' ? ($sortDirection === 'asc' ? '-up' : '-down') : '' }} cl-sort {{ $sortField === 'start_date' ? 'active' : '' }}"></i>
                                </th>
                                <th>End</th>
                                <th>Members</th>
                                <th class="sortable" wire:click="sortBy('status')">
                                    Status
                                    <i class="fas fa-sort{{ $sortField === 'status' ? ($sortDirection === 'asc' ? '-up' : '-down') : '' }} cl-sort {{ $sortField === 'status' ? 'active' : '' }}"></i>
                                </th>
                                <th style="width:120px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($circles as $c)
                                <tr>
                                    <td>
                                        <div class="cl-circle-cell">
                                            <div class="cl-circle-icon">
                                                <i class="fas fa-circle-notch"></i>
                                            </div>
                                            <div>
                                                <div class="cl-circle-name">
                                                    <a href="{{ route('circles.show', $c->id) }}">{{ $c->name }}</a>
                                                </div>
                                                <div class="cl-circle-creator">
                                                    <i class="fas fa-user" style="font-size:.55rem;margin-right:.2rem;"></i>{{ $c->creator->name ?? '--' }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span style="font-weight:600;">{{ $c->duration_months }}</span>
                                        <span style="color:var(--cl-faint);font-size:.75rem;">{{ Str::plural('mo', $c->duration_months) }}</span>
                                    </td>
                                    <td style="font-size:.82rem;">{{ $c->start_date->format('d M Y') }}</td>
                                    <td style="font-size:.82rem;color:var(--cl-muted);">{{ $c->end_date ? $c->end_date->format('d M Y') : '--' }}</td>
                                    <td>
                                        <span class="cl-badge cl-badge-members">
                                            <i class="fas fa-users" style="font-size:.55rem;"></i> {{ $c->members_count }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="cl-badge cl-badge-{{ $c->status }}">
                                            {{ ucfirst($c->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="cl-actions">
                                            <a href="{{ route('circles.show', $c->id) }}" class="cl-act cl-act-view" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('circles.members', $c->id) }}" class="cl-act cl-act-members" title="Manage Members">
                                                <i class="fas fa-users"></i>
                                            </a>
                                            @if ($c->status === 'draft')
                                                <button wire:click="confirmDelete({{ $c->id }})" class="cl-act cl-act-delete" title="Delete">
                                                    <span wire:loading wire:target="confirmDelete({{ $c->id }})" class="spinner-border spinner-border-sm" role="status" style="width:12px;height:12px;"></span>
                                                    <i wire:loading.remove wire:target="confirmDelete({{ $c->id }})" class="fas fa-trash-alt"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="cl-empty">
                                            <i class="fas fa-circle-notch"></i>
                                            <p>No circles found. <a href="{{ route('circles.create') }}">Create one</a></p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="cl-footer">
                    <span class="cl-footer-info">
                        Showing {{ $circles->firstItem() ?? 0 }} - {{ $circles->lastItem() ?? 0 }} of {{ $circles->total() }}
                    </span>
                    {{ $circles->links() }}
                </div>
            </div>

        </div>
    </section>

    {{-- ===== DELETE CONFIRMATION MODAL ===== --}}
    @if ($deleteId)
        <div class="cl-overlay">
            <div class="cl-modal">
                <div class="cl-modal-icon" style="background:#fef2f2;color:var(--cl-red);">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h5>Delete Circle?</h5>
                <p>Are you sure you want to delete <strong>{{ $deleteName }}</strong>? All associated data will be permanently removed.</p>
                <div class="cl-modal-btns">
                    <button wire:click="$set('deleteId', null)" class="cl-btn-cancel">Cancel</button>
                    <button wire:click="deleteCircle" class="cl-btn-danger">
                        <i class="fas fa-trash-alt mr-1"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    @endif
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
