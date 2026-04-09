<div>
    @push('custom-styles')
    <style>
        :root {
            --sl-navy:#1E3A5F; --sl-navy-light:#2B6B96; --sl-amber:#D97706; --sl-amber-light:#F59E0B;
            --sl-bg:#f4f6fa; --sl-card:#fff; --sl-border:#edf0f7; --sl-text:#1e293b;
            --sl-muted:#64748b; --sl-faint:#94a3b8; --sl-green:#16a34a; --sl-red:#dc2626; --sl-blue:#2563eb; --sl-radius:16px;
        }
        .sl-page { background:var(--sl-bg); min-height:100vh; }

        /* Hero */
        .sl-hero {
            background:linear-gradient(135deg,var(--sl-navy) 0%,#234b78 50%,var(--sl-navy-light) 100%);
            padding:1.75rem 0 6rem; position:relative; overflow:hidden;
        }
        .sl-hero::before { content:''; position:absolute; width:600px; height:600px; top:-60%; right:-8%; background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
        .sl-hero-inner { position:relative; z-index:2; padding:0 1.5rem; }
        .sl-breadcrumb { display:flex; gap:.5rem; list-style:none; padding:0; margin:0 0 .75rem; font-size:.82rem; }
        .sl-breadcrumb a { color:rgba(255,255,255,.55); text-decoration:none; }
        .sl-breadcrumb a:hover { color:rgba(255,255,255,.85); }
        .sl-breadcrumb .active { color:var(--sl-amber-light); font-weight:600; }
        .sl-breadcrumb .sep { color:rgba(255,255,255,.25); }
        .sl-hero-title { display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:.75rem; }
        .sl-hero-title h1 { color:#fff; font-size:1.6rem; font-weight:800; margin:0; }
        .sl-hero-title h1 i { color:var(--sl-amber); margin-right:.5rem; }
        .sl-hero-sub { color:rgba(255,255,255,.55); font-size:.88rem; margin:.25rem 0 0; }
        .sl-hero-btn {
            display:inline-flex; align-items:center; gap:.4rem; padding:.55rem 1.25rem; border-radius:10px;
            font-size:.82rem; font-weight:700; text-decoration:none; transition:all .2s;
            background:var(--sl-amber); color:#fff; border:none;
        }
        .sl-hero-btn:hover { background:var(--sl-amber-light); color:#fff; text-decoration:none; transform:translateY(-1px); box-shadow:0 4px 12px rgba(217,119,6,.25); }

        /* Content */
        .sl-content { margin-top:-4rem; position:relative; z-index:10; padding:0 1.5rem 2rem; }

        /* Stat cards */
        .sl-stats { display:grid; grid-template-columns:repeat(4,1fr); gap:1rem; margin-bottom:1.25rem; }
        @media(max-width:768px){ .sl-stats { grid-template-columns:repeat(2,1fr); } }
        .sl-stat {
            background:var(--sl-card); border-radius:var(--sl-radius); border:1px solid var(--sl-border);
            box-shadow:0 2px 12px rgba(0,0,0,.04); padding:1.1rem 1.25rem;
            display:flex; align-items:center; justify-content:space-between; transition:all .2s;
        }
        .sl-stat:hover { transform:translateY(-2px); box-shadow:0 6px 20px rgba(0,0,0,.06); }
        .sl-stat-label { font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--sl-faint); }
        .sl-stat-value { font-size:1.5rem; font-weight:800; color:var(--sl-text); margin-top:.1rem; }
        .sl-stat-icon {
            width:44px; height:44px; border-radius:12px; display:flex; align-items:center; justify-content:center;
            font-size:1rem; flex-shrink:0;
        }

        /* Table card */
        .sl-card {
            background:var(--sl-card); border-radius:var(--sl-radius); border:1px solid var(--sl-border);
            box-shadow:0 2px 12px rgba(0,0,0,.04); overflow:hidden;
        }
        .sl-card-header {
            padding:1rem 1.5rem; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:.75rem;
            border-bottom:1px solid var(--sl-border);
        }
        .sl-card-title { font-size:.95rem; font-weight:700; color:var(--sl-text); display:flex; align-items:center; gap:.4rem; }
        .sl-card-title i { color:var(--sl-amber); font-size:.8rem; }
        .sl-toolbar { display:flex; align-items:center; flex-wrap:wrap; gap:.6rem; }
        .sl-search { position:relative; }
        .sl-search i { position:absolute; left:.75rem; top:50%; transform:translateY(-50%); font-size:.72rem; color:var(--sl-faint); }
        .sl-search input {
            padding:.45rem .75rem .45rem 2rem; border:1px solid var(--sl-border); border-radius:10px;
            font-size:.82rem; background:#fafbfd; width:200px; transition:border .2s;
        }
        .sl-search input:focus { outline:none; border-color:var(--sl-amber); background:#fff; box-shadow:0 0 0 3px rgba(217,119,6,.08); }
        .sl-select {
            padding:.45rem .75rem; border:1px solid var(--sl-border); border-radius:10px;
            font-size:.82rem; background:#fafbfd; cursor:pointer;
        }
        .sl-select:focus { outline:none; border-color:var(--sl-amber); }

        /* Table */
        .sl-table { width:100%; border-collapse:collapse; }
        .sl-table thead th {
            font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--sl-faint);
            padding:.7rem 1rem; border-bottom:1px solid var(--sl-border); background:#fafbfd; white-space:nowrap;
        }
        .sl-table thead th.sortable { cursor:pointer; user-select:none; }
        .sl-table thead th.sortable:hover { color:var(--sl-amber); }
        .sl-table tbody td { padding:.7rem 1rem; border-bottom:1px solid #f5f7fa; font-size:.84rem; vertical-align:middle; }
        .sl-table tbody tr:last-child td { border-bottom:none; }
        .sl-table tbody tr:hover { background:#fafbfd; }
        .sl-sort { font-size:.55rem; margin-left:.25rem; opacity:.4; }
        .sl-sort.active { opacity:1; color:var(--sl-amber); }

        /* Avatar */
        .sl-avatar {
            width:32px; height:32px; border-radius:50%; display:flex; align-items:center; justify-content:center;
            font-weight:700; font-size:.65rem; flex-shrink:0;
            background:linear-gradient(135deg,var(--sl-navy),var(--sl-navy-light)); color:#fff;
        }
        .sl-member-cell { display:flex; align-items:center; gap:.55rem; }
        .sl-member-name { font-weight:700; color:var(--sl-text); font-size:.86rem; }
        .sl-member-email { font-size:.72rem; color:var(--sl-faint); margin-top:.1rem; }

        /* Badge */
        .sl-badge { display:inline-flex; align-items:center; gap:.2rem; padding:.2rem .55rem; border-radius:8px; font-size:.68rem; font-weight:700; white-space:nowrap; }

        /* Actions */
        .sl-act {
            width:30px; height:30px; border-radius:8px; display:flex; align-items:center; justify-content:center;
            border:1px solid var(--sl-border); background:#fafbfd; color:var(--sl-muted); cursor:pointer;
            font-size:.7rem; transition:all .15s; text-decoration:none;
        }
        .sl-act:hover { border-color:var(--sl-blue); color:var(--sl-blue); background:rgba(37,99,235,.05); }

        /* Footer */
        .sl-footer { padding:.85rem 1.5rem; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:.75rem; border-top:1px solid var(--sl-border); }
        .sl-footer-info { font-size:.78rem; color:var(--sl-faint); }

        /* Empty */
        .sl-empty { text-align:center; padding:3rem 1rem; }
        .sl-empty i { font-size:2.5rem; opacity:.12; display:block; margin-bottom:.75rem; color:var(--sl-navy); }
        .sl-empty p { font-size:.88rem; color:var(--sl-muted); margin:0; }
        .sl-empty a { color:var(--sl-amber); font-weight:600; text-decoration:none; }
        .sl-empty a:hover { text-decoration:underline; }

        /* Flash */
        .sl-flash {
            display:flex; align-items:center; gap:.5rem; padding:.65rem 1rem; border-radius:10px; font-size:.84rem; font-weight:600;
            background:rgba(22,163,74,.08); color:#166534; border:1px solid #bbf7d0; margin-bottom:1rem;
        }

        @keyframes slSlide { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
        .sl-animate { animation:slSlide .3s ease; }
        @media(max-width:768px){ .sl-content{padding:0 .75rem 1.5rem;} .sl-search input{width:150px;} }
    </style>
    @endpush

    @can('view-shares')
    <section class="content sl-page">
        {{-- Hero --}}
        <div class="sl-hero">
            <div class="sl-hero-inner container-fluid">
                <ul class="sl-breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li class="active">Shares</li>
                </ul>
                <div class="sl-hero-title">
                    <div>
                        <h1><i class="fas fa-coins"></i>Shares Summary</h1>
                        <p class="sl-hero-sub">View and track member share contributions across circles</p>
                    </div>
                    <div style="display:flex;gap:.5rem;flex-wrap:wrap;">
                        <a href="{{ route('shares.declare') }}" class="sl-hero-btn">
                            <i class="fas fa-plus-circle"></i> Declare Shares
                        </a>
                        <a href="{{ route('insurance.index') }}" class="sl-hero-btn" style="background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);">
                            <i class="fas fa-shield-alt"></i> Insurance Summary
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="sl-content container-fluid sl-animate">

            {{-- Stat Cards --}}
            <div class="sl-stats">
                <div class="sl-stat">
                    <div>
                        <div class="sl-stat-label">Total Declarations</div>
                        <div class="sl-stat-value">{{ number_format($totalDeclarations) }}</div>
                    </div>
                    <div class="sl-stat-icon" style="background:rgba(30,58,95,.08);color:var(--sl-navy);">
                        <i class="fas fa-coins"></i>
                    </div>
                </div>
                <div class="sl-stat">
                    <div>
                        <div class="sl-stat-label">Total Shares</div>
                        <div class="sl-stat-value" style="color:var(--sl-green);">K{{ number_format($totalShareAmount, 2) }}</div>
                    </div>
                    <div class="sl-stat-icon" style="background:rgba(22,163,74,.08);color:var(--sl-green);">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                </div>
                <div class="sl-stat">
                    <div>
                        <div class="sl-stat-label">Average Share</div>
                        <div class="sl-stat-value" style="color:var(--sl-amber);">K{{ number_format($avgShareAmount, 2) }}</div>
                    </div>
                    <div class="sl-stat-icon" style="background:rgba(217,119,6,.08);color:var(--sl-amber);">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
                <div class="sl-stat">
                    <div>
                        <div class="sl-stat-label">Unique Members</div>
                        <div class="sl-stat-value" style="color:var(--sl-blue);">{{ $uniqueMembers }}</div>
                    </div>
                    <div class="sl-stat-icon" style="background:rgba(37,99,235,.08);color:var(--sl-blue);">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>

            {{-- Table Card --}}
            <div class="sl-card">
                <div class="sl-card-header">
                    <div class="sl-card-title"><i class="fas fa-list"></i> All Share Declarations</div>
                    <div class="sl-toolbar">
                        @include('partials.village-bank-selector')
                        <select wire:model="circleFilter" class="sl-select">
                            <option value="">All Circles</option>
                            @foreach ($circles as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                        <div class="sl-search">
                            <i class="fas fa-search"></i>
                            <input type="text" wire:model.debounce.300ms="search" placeholder="Search members...">
                        </div>
                        <select wire:model="perPage" class="sl-select" style="width:70px;">
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>

                <div style="overflow-x:auto;">
                    <table class="sl-table">
                        <thead>
                            <tr>
                                <th class="sortable" wire:click="sortBy('user_id')">
                                    Member
                                    <i class="fas fa-sort{{ $sortField === 'user_id' ? ($sortDirection === 'asc' ? '-up' : '-down') : '' }} sl-sort {{ $sortField === 'user_id' ? 'active' : '' }}"></i>
                                </th>
                                <th>Circle</th>
                                <th>Month</th>
                                <th class="sortable" wire:click="sortBy('amount')">
                                    Amount
                                    <i class="fas fa-sort{{ $sortField === 'amount' ? ($sortDirection === 'asc' ? '-up' : '-down') : '' }} sl-sort {{ $sortField === 'amount' ? 'active' : '' }}"></i>
                                </th>
                                <th class="sortable" wire:click="sortBy('created_at')">
                                    Date
                                    <i class="fas fa-sort{{ $sortField === 'created_at' ? ($sortDirection === 'asc' ? '-up' : '-down') : '' }} sl-sort {{ $sortField === 'created_at' ? 'active' : '' }}"></i>
                                </th>
                                <th style="width:60px;">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($declarations as $d)
                                <tr>
                                    <td>
                                        <div class="sl-member-cell">
                                            @php
                                                $parts = explode(' ', trim($d->user->name ?? ''));
                                                $initials = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
                                            @endphp
                                            <div class="sl-avatar">{{ $initials }}</div>
                                            <div>
                                                <div class="sl-member-name">{{ $d->user->name ?? '--' }}</div>
                                                <div class="sl-member-email">{{ $d->user->email ?? '' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="sl-badge" style="background:rgba(30,58,95,.06);color:var(--sl-navy);border:1px solid rgba(30,58,95,.15);">
                                            {{ $d->month->circle->name ?? '--' }}
                                        </span>
                                    </td>
                                    <td style="font-size:.82rem;color:var(--sl-muted);">
                                        Month {{ $d->month->month_number ?? '--' }}
                                    </td>
                                    <td>
                                        <span style="font-weight:700;color:var(--sl-green);">K{{ number_format($d->amount, 2) }}</span>
                                    </td>
                                    <td style="font-size:.78rem;color:var(--sl-faint);">
                                        {{ $d->created_at->format('d M Y') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('shares.show', $d->id) }}" class="sl-act" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="sl-empty">
                                            <i class="fas fa-coins"></i>
                                            <p>No share declarations found. <a href="{{ route('shares.declare') }}">Declare shares</a></p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="sl-footer">
                    <span class="sl-footer-info">
                        Showing {{ $declarations->firstItem() ?? 0 }} - {{ $declarations->lastItem() ?? 0 }} of {{ $declarations->total() }}
                    </span>
                    {{ $declarations->links() }}
                </div>
            </div>
        </div>
    </section>
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
