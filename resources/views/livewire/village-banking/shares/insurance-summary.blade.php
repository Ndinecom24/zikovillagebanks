<div>
    @push('custom-styles')
    <style>
        :root {
            --is-navy:#1E3A5F; --is-navy-light:#2B6B96; --is-amber:#D97706; --is-amber-light:#F59E0B;
            --is-bg:#f4f6fa; --is-card:#fff; --is-border:#edf0f7; --is-text:#1e293b;
            --is-muted:#64748b; --is-faint:#94a3b8; --is-green:#16a34a; --is-red:#dc2626; --is-blue:#2563eb; --is-radius:16px;
        }
        .is-page { background:var(--is-bg); min-height:100vh; }

        /* Hero */
        .is-hero {
            background:linear-gradient(135deg,#92400e 0%,var(--is-amber) 50%,var(--is-amber-light) 100%);
            padding:1.75rem 0 6rem; position:relative; overflow:hidden;
        }
        .is-hero::before { content:''; position:absolute; width:600px; height:600px; top:-60%; right:-8%; background:radial-gradient(circle,rgba(30,58,95,.12) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
        .is-hero-inner { position:relative; z-index:2; padding:0 1.5rem; }
        .is-breadcrumb { display:flex; gap:.5rem; list-style:none; padding:0; margin:0 0 .75rem; font-size:.82rem; }
        .is-breadcrumb a { color:rgba(255,255,255,.6); text-decoration:none; }
        .is-breadcrumb a:hover { color:rgba(255,255,255,.9); }
        .is-breadcrumb .active { color:#fff; font-weight:600; }
        .is-breadcrumb .sep { color:rgba(255,255,255,.3); }
        .is-hero-title { display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:.75rem; }
        .is-hero-title h1 { color:#fff; font-size:1.6rem; font-weight:800; margin:0; }
        .is-hero-title h1 i { color:var(--is-navy); margin-right:.5rem; }
        .is-hero-sub { color:rgba(255,255,255,.7); font-size:.88rem; margin:.25rem 0 0; }
        .is-hero-actions { display:flex; gap:.5rem; flex-wrap:wrap; }
        .is-hero-btn {
            display:inline-flex; align-items:center; gap:.4rem; padding:.55rem 1.25rem; border-radius:10px;
            font-size:.82rem; font-weight:700; text-decoration:none; transition:all .2s;
            background:var(--is-navy); color:#fff; border:none;
        }
        .is-hero-btn:hover { background:var(--is-navy-light); color:#fff; text-decoration:none; transform:translateY(-1px); box-shadow:0 4px 12px rgba(30,58,95,.3); }
        .is-hero-btn-outline {
            display:inline-flex; align-items:center; gap:.35rem; padding:.45rem 1rem; border-radius:10px;
            font-size:.78rem; font-weight:700; text-decoration:none; transition:all .2s;
            border:1px solid rgba(255,255,255,.3); color:rgba(255,255,255,.9);
        }
        .is-hero-btn-outline:hover { border-color:#fff; color:#fff; background:rgba(255,255,255,.1); text-decoration:none; }

        /* Content */
        .is-content { margin-top:-4rem; position:relative; z-index:10; padding:0 1.5rem 2rem; }

        /* Stat cards */
        .is-stats { display:grid; grid-template-columns:repeat(4,1fr); gap:1rem; margin-bottom:1.25rem; }
        @media(max-width:768px){ .is-stats { grid-template-columns:repeat(2,1fr); } }
        .is-stat {
            background:var(--is-card); border-radius:var(--is-radius); border:1px solid var(--is-border);
            box-shadow:0 2px 12px rgba(0,0,0,.04); padding:1.1rem 1.25rem;
            display:flex; align-items:center; justify-content:space-between; transition:all .2s;
        }
        .is-stat:hover { transform:translateY(-2px); box-shadow:0 6px 20px rgba(0,0,0,.06); }
        .is-stat-label { font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--is-faint); }
        .is-stat-value { font-size:1.5rem; font-weight:800; color:var(--is-text); margin-top:.1rem; }
        .is-stat-icon {
            width:44px; height:44px; border-radius:12px; display:flex; align-items:center; justify-content:center;
            font-size:1rem; flex-shrink:0;
        }

        /* Table card */
        .is-card {
            background:var(--is-card); border-radius:var(--is-radius); border:1px solid var(--is-border);
            box-shadow:0 2px 12px rgba(0,0,0,.04); overflow:hidden;
        }
        .is-card-header {
            padding:1rem 1.5rem; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:.75rem;
            border-bottom:1px solid var(--is-border);
        }
        .is-card-title { font-size:.95rem; font-weight:700; color:var(--is-text); display:flex; align-items:center; gap:.4rem; }
        .is-card-title i { color:var(--is-amber); font-size:.8rem; }
        .is-toolbar { display:flex; align-items:center; flex-wrap:wrap; gap:.6rem; }
        .is-search { position:relative; }
        .is-search i { position:absolute; left:.75rem; top:50%; transform:translateY(-50%); font-size:.72rem; color:var(--is-faint); }
        .is-search input {
            padding:.45rem .75rem .45rem 2rem; border:1px solid var(--is-border); border-radius:10px;
            font-size:.82rem; background:#fafbfd; width:200px; transition:border .2s;
        }
        .is-search input:focus { outline:none; border-color:var(--is-amber); background:#fff; box-shadow:0 0 0 3px rgba(217,119,6,.08); }
        .is-select {
            padding:.45rem .75rem; border:1px solid var(--is-border); border-radius:10px;
            font-size:.82rem; background:#fafbfd; cursor:pointer;
        }
        .is-select:focus { outline:none; border-color:var(--is-amber); }

        /* Table */
        .is-table { width:100%; border-collapse:collapse; }
        .is-table thead th {
            font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--is-faint);
            padding:.7rem 1rem; border-bottom:1px solid var(--is-border); background:#fafbfd; white-space:nowrap;
        }
        .is-table thead th.sortable { cursor:pointer; user-select:none; }
        .is-table thead th.sortable:hover { color:var(--is-amber); }
        .is-table tbody td { padding:.7rem 1rem; border-bottom:1px solid #f5f7fa; font-size:.84rem; vertical-align:middle; }
        .is-table tbody tr:last-child td { border-bottom:none; }
        .is-table tbody tr:hover { background:#fafbfd; }
        .is-sort { font-size:.55rem; margin-left:.25rem; opacity:.4; }
        .is-sort.active { opacity:1; color:var(--is-amber); }

        /* Avatar */
        .is-avatar {
            width:32px; height:32px; border-radius:50%; display:flex; align-items:center; justify-content:center;
            font-weight:700; font-size:.65rem; flex-shrink:0;
            background:linear-gradient(135deg,#92400e,var(--is-amber)); color:#fff;
        }
        .is-member-cell { display:flex; align-items:center; gap:.55rem; }
        .is-member-name { font-weight:700; color:var(--is-text); font-size:.86rem; }
        .is-member-email { font-size:.72rem; color:var(--is-faint); margin-top:.1rem; }

        /* Badge */
        .is-badge { display:inline-flex; align-items:center; gap:.2rem; padding:.2rem .55rem; border-radius:8px; font-size:.68rem; font-weight:700; white-space:nowrap; }
        .is-config-badge { display:inline-flex; align-items:center; gap:.25rem; padding:.15rem .5rem; border-radius:6px; font-size:.62rem; font-weight:700; background:rgba(217,119,6,.08); color:#92400e; border:1px solid #fde68a; }

        /* Footer */
        .is-footer { padding:.85rem 1.5rem; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:.75rem; border-top:1px solid var(--is-border); }
        .is-footer-info { font-size:.78rem; color:var(--is-faint); }

        /* Empty */
        .is-empty { text-align:center; padding:3rem 1rem; }
        .is-empty i { font-size:2.5rem; opacity:.12; display:block; margin-bottom:.75rem; color:var(--is-amber); }
        .is-empty p { font-size:.88rem; color:var(--is-muted); margin:0; }
        .is-empty a { color:var(--is-amber); font-weight:600; text-decoration:none; }
        .is-empty a:hover { text-decoration:underline; }

        @keyframes isSlide { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
        .is-animate { animation:isSlide .3s ease; }
        @media(max-width:768px){ .is-content{padding:0 .75rem 1.5rem;} .is-search input{width:150px;} }
    </style>
    @endpush

    @can('view-shares')
    <section class="content is-page">
        {{-- Hero --}}
        <div class="is-hero">
            <div class="is-hero-inner container-fluid">
                <ul class="is-breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('shares.index') }}">Shares</a></li>
                    <li class="sep">/</li>
                    <li class="active">Insurance Summary</li>
                </ul>
                <div class="is-hero-title">
                    <div>
                        <h1><i class="fas fa-shield-alt"></i>Insurance Summary</h1>
                        <p class="is-hero-sub">View and track insurance contributions across all circles and months</p>
                    </div>
                    <div class="is-hero-actions">
                        <a href="{{ route('shares.declare') }}" class="is-hero-btn">
                            <i class="fas fa-plus-circle"></i> Declare Insurance
                        </a>
                        <a href="{{ route('shares.index') }}" class="is-hero-btn-outline">
                            <i class="fas fa-coins"></i> Shares Summary
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="is-content container-fluid is-animate">

            {{-- Stat Cards --}}
            <div class="is-stats">
                <div class="is-stat">
                    <div>
                        <div class="is-stat-label">Total Contributions</div>
                        <div class="is-stat-value">{{ number_format($totalContributions) }}</div>
                    </div>
                    <div class="is-stat-icon" style="background:rgba(146,64,14,.08);color:#92400e;">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                </div>
                <div class="is-stat">
                    <div>
                        <div class="is-stat-label">Total Insurance</div>
                        <div class="is-stat-value" style="color:var(--is-amber);">K{{ number_format($totalAmount, 2) }}</div>
                    </div>
                    <div class="is-stat-icon" style="background:rgba(217,119,6,.08);color:var(--is-amber);">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                </div>
                <div class="is-stat">
                    <div>
                        <div class="is-stat-label">Average Amount</div>
                        <div class="is-stat-value" style="color:var(--is-green);">K{{ number_format($avgAmount, 2) }}</div>
                    </div>
                    <div class="is-stat-icon" style="background:rgba(22,163,74,.08);color:var(--is-green);">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
                <div class="is-stat">
                    <div>
                        <div class="is-stat-label">Unique Members</div>
                        <div class="is-stat-value" style="color:var(--is-navy);">{{ $uniqueMembers }}</div>
                    </div>
                    <div class="is-stat-icon" style="background:rgba(30,58,95,.08);color:var(--is-navy);">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>

            {{-- Table Card --}}
            <div class="is-card">
                <div class="is-card-header">
                    <div class="is-card-title"><i class="fas fa-list"></i> Insurance Contributions</div>
                    <div class="is-toolbar">
                        @include('partials.village-bank-selector')
                        <select wire:model="circleFilter" class="is-select">
                            <option value="">All Circles</option>
                            @foreach ($circles as $c)
                                <option value="{{ $c->id }}">
                                    {{ $c->name }}
                                    @if (isset($configs[$c->id]))
                                        ({{ $configs[$c->id]->type === 'fixed' ? 'K' . number_format($configs[$c->id]->value, 0) : $configs[$c->id]->value . '%' }})
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        <div class="is-search">
                            <i class="fas fa-search"></i>
                            <input type="text" wire:model.debounce.300ms="search" placeholder="Search members...">
                        </div>
                        <select wire:model="perPage" class="is-select" style="width:70px;">
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>

                <div style="overflow-x:auto;">
                    <table class="is-table">
                        <thead>
                            <tr>
                                <th class="sortable" wire:click="sortBy('user_id')">
                                    Member
                                    <i class="fas fa-sort{{ $sortField === 'user_id' ? ($sortDirection === 'asc' ? '-up' : '-down') : '' }} is-sort {{ $sortField === 'user_id' ? 'active' : '' }}"></i>
                                </th>
                                <th>Circle</th>
                                <th>Month</th>
                                <th>Config</th>
                                <th class="sortable" wire:click="sortBy('amount')">
                                    Amount
                                    <i class="fas fa-sort{{ $sortField === 'amount' ? ($sortDirection === 'asc' ? '-up' : '-down') : '' }} is-sort {{ $sortField === 'amount' ? 'active' : '' }}"></i>
                                </th>
                                <th class="sortable" wire:click="sortBy('created_at')">
                                    Date
                                    <i class="fas fa-sort{{ $sortField === 'created_at' ? ($sortDirection === 'asc' ? '-up' : '-down') : '' }} is-sort {{ $sortField === 'created_at' ? 'active' : '' }}"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($contributions as $c)
                                @php
                                    $circleId = $c->month->circle->id ?? null;
                                    $config = $circleId && isset($configs[$circleId]) ? $configs[$circleId] : null;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="is-member-cell">
                                            @php
                                                $parts = explode(' ', trim($c->user->name ?? ''));
                                                $initials = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
                                            @endphp
                                            <div class="is-avatar">{{ $initials }}</div>
                                            <div>
                                                <div class="is-member-name">{{ $c->user->name ?? '--' }}</div>
                                                <div class="is-member-email">{{ $c->user->email ?? '' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="is-badge" style="background:rgba(30,58,95,.06);color:var(--is-navy);border:1px solid rgba(30,58,95,.15);">
                                            {{ $c->month->circle->name ?? '--' }}
                                        </span>
                                    </td>
                                    <td style="font-size:.82rem;color:var(--is-muted);">
                                        Month {{ $c->month->month_number ?? '--' }}
                                    </td>
                                    <td>
                                        @if ($config)
                                            <span class="is-config-badge">
                                                @if ($config->type === 'fixed')
                                                    <i class="fas fa-lock" style="font-size:.5rem;"></i> K{{ number_format($config->value, 0) }} fixed
                                                @else
                                                    <i class="fas fa-percentage" style="font-size:.5rem;"></i> {{ $config->value }}%
                                                @endif
                                            </span>
                                        @else
                                            <span style="font-size:.72rem;color:var(--is-faint);">Manual</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span style="font-weight:700;color:var(--is-amber);">K{{ number_format($c->amount, 2) }}</span>
                                    </td>
                                    <td style="font-size:.78rem;color:var(--is-faint);">
                                        {{ $c->created_at->format('d M Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="is-empty">
                                            <i class="fas fa-shield-alt"></i>
                                            <p>No insurance contributions found. <a href="{{ route('shares.declare') }}">Declare insurance</a></p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="is-footer">
                    <span class="is-footer-info">
                        Showing {{ $contributions->firstItem() ?? 0 }} - {{ $contributions->lastItem() ?? 0 }} of {{ $contributions->total() }}
                    </span>
                    {{ $contributions->links() }}
                </div>
            </div>
        </div>
    </section>
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
