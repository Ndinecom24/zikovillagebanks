<div>
    @push('custom-styles')
    <style>
        /* ══════════════════════════════════════════════════
         *  MEMBER LIST v2 — Ndinecom Village Banking
         * ══════════════════════════════════════════════════ */
        :root {
            --ml-navy: #1E3A5F;
            --ml-navy-light: #2B6B96;
            --ml-amber: #D97706;
            --ml-amber-light: #F59E0B;
            --ml-bg: #f4f6fa;
            --ml-card: #ffffff;
            --ml-border: #edf0f7;
            --ml-text: #1e293b;
            --ml-muted: #64748b;
            --ml-faint: #94a3b8;
            --ml-green: #16a34a;
            --ml-red: #dc2626;
            --ml-blue: #2563eb;
            --ml-radius: 16px;
        }

        .ml-page { background: var(--ml-bg); min-height: 100vh; }

        /* ── Hero ── */
        .ml-hero {
            background: linear-gradient(135deg, var(--ml-navy) 0%, #234b78 50%, var(--ml-navy-light) 100%);
            padding: 1.75rem 0 5rem;
            position: relative; overflow: hidden;
        }
        .ml-hero::before {
            content: '';
            position: absolute; width: 500px; height: 500px;
            top: -50%; right: -5%;
            background: radial-gradient(circle, rgba(217,119,6,0.12) 0%, transparent 70%);
            border-radius: 50%; pointer-events: none;
        }
        .ml-hero-inner {
            position: relative; z-index: 2; padding: 0 1.5rem;
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 0.75rem;
        }
        .ml-breadcrumb {
            display: flex; gap: 0.5rem; list-style: none; padding: 0; margin: 0;
            font-size: 0.82rem;
        }
        .ml-breadcrumb a { color: rgba(255,255,255,0.55); text-decoration: none; }
        .ml-breadcrumb a:hover { color: rgba(255,255,255,0.85); }
        .ml-breadcrumb .active { color: var(--ml-amber-light); font-weight: 600; }
        .ml-breadcrumb .sep { color: rgba(255,255,255,0.25); }
        .ml-hero-title { color: #fff; font-size: 1.3rem; font-weight: 800; margin: 0.3rem 0 0; }
        .ml-hero-sub { color: rgba(255,255,255,0.5); font-size: 0.8rem; margin: 0.15rem 0 0; }
        .ml-hero-btn {
            display: inline-flex; align-items: center; gap: 0.35rem;
            padding: 0.45rem 1.1rem; border-radius: 10px;
            font-size: 0.82rem; font-weight: 600;
            border: none; cursor: pointer; text-decoration: none;
            transition: all 0.2s;
            background: linear-gradient(135deg, var(--ml-amber), var(--ml-amber-light));
            color: #fff;
        }
        .ml-hero-btn:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(217,119,6,0.3); color: #fff; text-decoration: none; }

        /* ── Content ── */
        .ml-content {
            margin-top: -3.5rem;
            position: relative; z-index: 10;
            padding: 0 1.5rem 2rem;
        }

        /* ── Stats ── */
        .ml-stats {
            display: grid; grid-template-columns: repeat(3, 1fr);
            gap: 1rem; margin-bottom: 1.25rem;
        }
        @media (max-width: 768px) { .ml-stats { grid-template-columns: 1fr; } }

        .ml-stat {
            background: var(--ml-card);
            border-radius: var(--ml-radius);
            border: 1px solid var(--ml-border);
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
            padding: 1rem 1.25rem;
            display: flex; align-items: center; justify-content: space-between;
        }
        .ml-stat-label {
            font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.5px;
            font-weight: 700; color: var(--ml-faint);
        }
        .ml-stat-value {
            font-size: 1.6rem; font-weight: 800; color: var(--ml-text); line-height: 1.2;
        }
        .ml-stat-icon {
            width: 48px; height: 48px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; flex-shrink: 0;
        }

        /* ── Card ── */
        .ml-card {
            background: var(--ml-card);
            border-radius: var(--ml-radius);
            border: 1px solid var(--ml-border);
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
            overflow: hidden;
        }
        .ml-card-head {
            padding: 0.85rem 1.25rem;
            display: flex; align-items: center; justify-content: space-between;
            border-bottom: 1px solid var(--ml-border);
            flex-wrap: wrap; gap: 0.75rem;
        }
        .ml-card-title {
            font-size: 0.9rem; font-weight: 700; color: var(--ml-text); margin: 0;
            display: flex; align-items: center; gap: 0.45rem;
        }
        .ml-card-title i { color: var(--ml-amber); font-size: 0.85rem; }

        /* ── Toolbar ── */
        .ml-toolbar {
            display: flex; align-items: center; gap: 0.65rem; flex-wrap: wrap;
        }
        .ml-search {
            position: relative;
        }
        .ml-search i {
            position: absolute; left: 10px; top: 50%; transform: translateY(-50%);
            font-size: 0.75rem; color: var(--ml-faint);
        }
        .ml-search input {
            padding: 0.4rem 0.8rem 0.4rem 2rem;
            border: 2px solid #e2e8f0; border-radius: 10px;
            font-size: 0.82rem; width: 220px; color: var(--ml-text);
            transition: border-color 0.2s;
        }
        .ml-search input:focus { border-color: var(--ml-amber); outline: none; }
        .ml-select {
            padding: 0.4rem 0.8rem; border: 2px solid #e2e8f0;
            border-radius: 10px; font-size: 0.82rem; color: var(--ml-text);
            cursor: pointer; background: #fff;
        }
        .ml-select:focus { border-color: var(--ml-amber); outline: none; }

        /* ── Table ── */
        .ml-table {
            width: 100%; border-collapse: collapse;
        }
        .ml-table thead th {
            font-size: 0.62rem; text-transform: uppercase; letter-spacing: 0.5px;
            font-weight: 700; color: var(--ml-faint);
            padding: 0.7rem 1rem; border-bottom: 1px solid var(--ml-border);
            background: #fafbfd; cursor: default;
        }
        .ml-table thead th.sortable { cursor: pointer; user-select: none; }
        .ml-table thead th.sortable:hover { color: var(--ml-navy); }
        .ml-table tbody td {
            padding: 0.7rem 1rem; border-bottom: 1px solid #f5f7fa;
            vertical-align: middle; font-size: 0.85rem;
        }
        .ml-table tbody tr { transition: background 0.15s; }
        .ml-table tbody tr:hover { background: #fafbfd; }
        .ml-table tbody tr:last-child td { border-bottom: none; }

        /* ── Avatar ── */
        .ml-avatar {
            width: 38px; height: 38px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 0.75rem; flex-shrink: 0;
            background: linear-gradient(135deg, var(--ml-navy), var(--ml-navy-light));
            color: #fff; letter-spacing: 0.5px;
        }
        .ml-avatar img {
            width: 38px; height: 38px; border-radius: 50%;
            object-fit: cover; border: 2px solid var(--ml-border);
        }

        /* ── Badge ── */
        .ml-badge {
            display: inline-flex; align-items: center; gap: 0.2rem;
            padding: 0.15rem 0.55rem; border-radius: 8px;
            font-size: 0.68rem; font-weight: 700;
        }

        /* ── Member row clickable ── */
        .ml-row-link {
            color: var(--ml-text); font-weight: 700;
            text-decoration: none; display: flex; align-items: center; gap: 0.65rem;
        }
        .ml-row-link:hover { color: var(--ml-amber); text-decoration: none; }
        .ml-member-email {
            font-size: 0.75rem; color: var(--ml-faint); font-weight: 400;
        }

        /* ── Actions ── */
        .ml-action {
            width: 30px; height: 30px; border-radius: 8px;
            border: 1px solid #e2e8f0; background: #fff;
            display: inline-flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: 0.72rem; color: var(--ml-muted);
            transition: all 0.15s;
        }
        .ml-action:hover { background: #f8fafc; color: var(--ml-navy); border-color: #cbd5e1; }
        .ml-action.view:hover { color: var(--ml-blue); border-color: #bfdbfe; }
        .ml-action.danger:hover { color: var(--ml-red); border-color: #fecaca; background: #fef2f2; }

        /* ── Pagination ── */
        .ml-pagination {
            padding: 0.75rem 1.25rem;
            display: flex; align-items: center; justify-content: space-between;
            border-top: 1px solid var(--ml-border); flex-wrap: wrap; gap: 0.5rem;
        }
        .ml-pagination-info { font-size: 0.78rem; color: var(--ml-faint); font-weight: 600; }

        /* ── Empty ── */
        .ml-empty {
            text-align: center; padding: 3rem 1rem; color: var(--ml-faint);
        }
        .ml-empty i { font-size: 2.5rem; opacity: 0.15; display: block; margin-bottom: 0.6rem; }
        .ml-empty strong { display: block; color: var(--ml-muted); font-size: 0.92rem; margin-bottom: 0.2rem; }

        /* ── Flash ── */
        .ml-flash {
            display: flex; align-items: center; gap: 0.5rem;
            padding: 0.7rem 1.15rem; border-radius: 12px;
            font-size: 0.84rem; font-weight: 600;
            margin-bottom: 1rem; animation: mlSlide 0.3s ease;
            background: #f0fdf4; color: var(--ml-green); border: 1px solid #bbf7d0;
        }

        /* ── Delete Modal ── */
        .ml-modal-bg {
            position: fixed; inset: 0; z-index: 9999;
            background: rgba(15,26,46,0.7); backdrop-filter: blur(4px);
            display: flex; align-items: center; justify-content: center;
            padding: 1.5rem;
        }
        .ml-modal {
            background: #fff; border-radius: 20px;
            max-width: 400px; width: 100%;
            box-shadow: 0 25px 60px rgba(0,0,0,0.2);
            animation: mlSlide 0.25s ease;
            text-align: center; padding: 2rem;
        }
        .ml-modal-icon {
            width: 60px; height: 60px; border-radius: 50%;
            display: inline-flex; align-items: center; justify-content: center;
            margin-bottom: 1rem;
        }
        .ml-btn {
            display: inline-flex; align-items: center; gap: 0.35rem;
            padding: 0.45rem 1.1rem; border-radius: 10px;
            font-size: 0.82rem; font-weight: 600;
            border: none; cursor: pointer; transition: all 0.2s;
        }
        .ml-btn-ghost { background: #f1f5f9; color: var(--ml-muted); }
        .ml-btn-ghost:hover { background: #e2e8f0; color: var(--ml-text); }
        .ml-btn-danger { background: var(--ml-red); color: #fff; }
        .ml-btn-danger:hover { background: #b91c1c; }

        /* ── Sort Icon ── */
        .ml-sort { font-size: 0.55rem; margin-left: 3px; opacity: 0.4; }
        .ml-sort.active { opacity: 1; color: var(--ml-amber); }

        @keyframes mlSlide {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .ml-content { padding: 0 0.75rem 1.5rem; }
            .ml-search input { width: 160px; }
        }
    </style>
    @endpush

    @can('view-members')
    <section class="content ml-page">
        {{-- ═══════════ Hero ═══════════ --}}
        <div class="ml-hero">
            <div class="ml-hero-inner container-fluid">
                <div>
                    <ul class="ml-breadcrumb">
                        <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                        <li class="sep">/</li>
                        <li class="active">Members</li>
                    </ul>
                    <h1 class="ml-hero-title">Members</h1>
                    <p class="ml-hero-sub">View and manage village bank members</p>
                </div>
                <a href="{{ route('members.create') }}" class="ml-hero-btn">
                    <i class="fas fa-user-plus"></i> Register Member
                </a>
            </div>
        </div>

        {{-- ═══════════ Content ═══════════ --}}
        <div class="ml-content container-fluid">

            {{-- Flash --}}
            @if(session()->has('message'))
                <div class="ml-flash">
                    <i class="fas fa-check-circle"></i> {{ session('message') }}
                </div>
            @endif

            {{-- ═══════ Stats ═══════ --}}
            <div class="ml-stats">
                <div class="ml-stat">
                    <div>
                        <div class="ml-stat-label">Total Members</div>
                        <div class="ml-stat-value">{{ $totalMembers }}</div>
                    </div>
                    <div class="ml-stat-icon" style="background:#f0fdf4;color:var(--ml-green);">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="ml-stat">
                    <div>
                        <div class="ml-stat-label">Active</div>
                        <div class="ml-stat-value">{{ $activeMembers }}</div>
                    </div>
                    <div class="ml-stat-icon" style="background:#eff6ff;color:var(--ml-blue);">
                        <i class="fas fa-user-check"></i>
                    </div>
                </div>
                <div class="ml-stat">
                    <div>
                        <div class="ml-stat-label">Pending Approval</div>
                        <div class="ml-stat-value">{{ $pendingMembers }}</div>
                    </div>
                    <div class="ml-stat-icon" style="background:#fffbeb;color:var(--ml-amber);">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>

            {{-- ═══════ Table Card ═══════ --}}
            <div class="ml-card">
                <div class="ml-card-head">
                    <h3 class="ml-card-title"><i class="fas fa-list-ul"></i> All Members</h3>
                    <div class="ml-toolbar">
                        <select wire:model.live="statusFilter" class="ml-select">
                            <option value="">All Statuses</option>
                            <option value="active">Active</option>
                            <option value="pending">Pending</option>
                            <option value="suspended">Suspended</option>
                        </select>
                        <div class="ml-search">
                            <i class="fas fa-search"></i>
                            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search members...">
                        </div>
                        <select wire:model.live="perPage" class="ml-select" style="width:70px;">
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>

                @if($members->count())
                    <div style="overflow-x:auto;">
                        <table class="ml-table">
                            <thead>
                                <tr>
                                    <th class="sortable" wire:click="sortBy('name')" colspan="2">
                                        Member
                                        @if($sortField === 'name')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-sort active"></i>
                                        @else
                                            <i class="fas fa-sort ml-sort"></i>
                                        @endif
                                    </th>
                                    <th>Phone</th>
                                    <th>Guarantor</th>
                                    <th>Circles</th>
                                    <th class="sortable" wire:click="sortBy('status')">
                                        Status
                                        @if($sortField === 'status')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-sort active"></i>
                                        @else
                                            <i class="fas fa-sort ml-sort"></i>
                                        @endif
                                    </th>
                                    <th class="sortable" wire:click="sortBy('created_at')">
                                        Joined
                                        @if($sortField === 'created_at')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-sort active"></i>
                                        @else
                                            <i class="fas fa-sort ml-sort"></i>
                                        @endif
                                    </th>
                                    <th style="width:100px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($members as $m)
                                    @php
                                        $parts = explode(' ', trim($m->name ?? ''));
                                        $initials = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
                                        $avatarUrl = null;
                                        if ($m->avatar && file_exists(storage_path('app/public/user_avatar/' . $m->avatar))) {
                                            $avatarUrl = asset('storage/user_avatar/' . $m->avatar);
                                        }
                                        $sc = [
                                            'active'    => ['bg' => '#f0fdf4', 'color' => '#166534', 'border' => '#bbf7d0'],
                                            'pending'   => ['bg' => '#fffbeb', 'color' => '#92400e', 'border' => '#fde68a'],
                                            'suspended' => ['bg' => '#fef2f2', 'color' => '#991b1b', 'border' => '#fecaca'],
                                        ][$m->status] ?? ['bg' => '#f3f4f6', 'color' => '#374151', 'border' => '#e5e7eb'];
                                    @endphp
                                    <tr>
                                        <td>
                                            @if($avatarUrl)
                                                <div class="ml-avatar"><img src="{{ $avatarUrl }}" alt=""></div>
                                            @else
                                                <div class="ml-avatar">{{ $initials }}</div>
                                            @endif
                                        </td>
                                        <td style="padding-left:0;">
                                            <a href="{{ route('members.show', $m->id) }}" class="ml-row-link" style="flex-direction:column;align-items:flex-start;gap:0;">
                                                <span>{{ $m->name }}</span>
                                                <span class="ml-member-email">{{ $m->email }}</span>
                                            </a>
                                        </td>
                                        <td style="color:var(--ml-muted);">{{ $m->phone ?? $m->mobile_no ?? '--' }}</td>
                                        <td style="font-size:0.82rem;">{{ $m->guarantor->name ?? '--' }}</td>
                                        <td>
                                            @if($m->circles_count > 0)
                                                <span class="ml-badge" style="background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;">
                                                    <i class="fas fa-circle-notch" style="font-size:0.5rem;"></i> {{ $m->circles_count }}
                                                </span>
                                            @else
                                                <span style="color:#d1d5db;">&mdash;</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="ml-badge" style="background:{{ $sc['bg'] }};color:{{ $sc['color'] }};border:1px solid {{ $sc['border'] }};">
                                                {{ ucfirst($m->status) }}
                                            </span>
                                        </td>
                                        <td style="font-size:0.78rem;color:var(--ml-faint);">{{ $m->created_at->format('d M Y') }}</td>
                                        <td>
                                            <div style="display:flex;gap:4px;">
                                                <a href="{{ route('members.show', $m->id) }}" class="ml-action view" title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <button wire:click="confirmDelete({{ $m->id }})" class="ml-action danger" title="Delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="ml-pagination">
                        <span class="ml-pagination-info">
                            Showing {{ $members->firstItem() ?? 0 }}–{{ $members->lastItem() ?? 0 }} of {{ $members->total() }}
                        </span>
                        {{ $members->links() }}
                    </div>
                @else
                    <div class="ml-empty">
                        <i class="fas fa-users"></i>
                        <strong>No members found</strong>
                        <span style="font-size:0.82rem;">Try adjusting your search or filters.</span>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- ═══════════ Delete Modal ═══════════ --}}
    @if($deleteId)
        <div class="ml-modal-bg">
            <div class="ml-modal">
                <div class="ml-modal-icon" style="background:#fef2f2;">
                    <i class="fas fa-exclamation-triangle" style="font-size:1.5rem;color:var(--ml-red);"></i>
                </div>
                <h5 style="font-weight:700;margin-bottom:0.5rem;">Delete Member?</h5>
                <p style="color:var(--ml-muted);font-size:0.88rem;">
                    Are you sure you want to delete <strong>{{ $deleteName }}</strong>? This action cannot be undone.
                </p>
                <div style="display:flex;justify-content:center;gap:0.65rem;margin-top:1.25rem;">
                    <button wire:click="$set('deleteId', null)" class="ml-btn ml-btn-ghost">Cancel</button>
                    <button wire:click="deleteMember" class="ml-btn ml-btn-danger">
                        <i class="fas fa-trash-alt"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    @endif
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
