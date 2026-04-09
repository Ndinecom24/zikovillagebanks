<div>
    @push('custom-styles')
    <style>
        /* ══════════════════════════════════════════════════
         *  LOAN LIST v2 — Ndinecom Village Banking
         * ══════════════════════════════════════════════════ */
        :root {
            --ll-navy: #1E3A5F;
            --ll-navy-light: #2B6B96;
            --ll-amber: #D97706;
            --ll-amber-light: #F59E0B;
            --ll-bg: #f4f6fa;
            --ll-card: #ffffff;
            --ll-border: #edf0f7;
            --ll-text: #1e293b;
            --ll-muted: #64748b;
            --ll-faint: #94a3b8;
            --ll-green: #16a34a;
            --ll-red: #dc2626;
            --ll-blue: #2563eb;
            --ll-radius: 16px;
        }
        .ll-page { background: var(--ll-bg); min-height: 100vh; }

        /* Hero */
        .ll-hero {
            background: linear-gradient(135deg, var(--ll-navy) 0%, #234b78 50%, var(--ll-navy-light) 100%);
            padding: 1.75rem 0 5rem; position: relative; overflow: hidden;
        }
        .ll-hero::before {
            content:''; position:absolute; width:500px; height:500px; top:-50%; right:-5%;
            background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%);
            border-radius:50%; pointer-events:none;
        }
        .ll-hero-inner { position:relative; z-index:2; padding:0 1.5rem; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:.75rem; }
        .ll-breadcrumb { display:flex; gap:.5rem; list-style:none; padding:0; margin:0; font-size:.82rem; }
        .ll-breadcrumb a { color:rgba(255,255,255,.55); text-decoration:none; }
        .ll-breadcrumb a:hover { color:rgba(255,255,255,.85); }
        .ll-breadcrumb .active { color:var(--ll-amber-light); font-weight:600; }
        .ll-breadcrumb .sep { color:rgba(255,255,255,.25); }
        .ll-hero-title { color:#fff; font-size:1.3rem; font-weight:800; margin:.3rem 0 0; }
        .ll-hero-sub { color:rgba(255,255,255,.5); font-size:.8rem; margin:.15rem 0 0; }
        .ll-hero-actions { display:flex; gap:.5rem; flex-wrap:wrap; }
        .ll-hero-btn {
            display:inline-flex; align-items:center; gap:.35rem; padding:.45rem 1.1rem; border-radius:10px;
            font-size:.82rem; font-weight:600; border:none; cursor:pointer; text-decoration:none; transition:all .2s;
        }
        .ll-hero-btn:hover { transform:translateY(-1px); text-decoration:none; }
        .ll-btn-amber { background:linear-gradient(135deg,var(--ll-amber),var(--ll-amber-light)); color:#fff; }
        .ll-btn-amber:hover { box-shadow:0 4px 12px rgba(217,119,6,.3); color:#fff; }
        .ll-btn-outline { background:rgba(255,255,255,.1); color:#fff; border:1px solid rgba(255,255,255,.2); }
        .ll-btn-outline:hover { background:rgba(255,255,255,.18); color:#fff; }

        /* Content */
        .ll-content { margin-top:-3.5rem; position:relative; z-index:10; padding:0 1.5rem 2rem; }

        /* Stats */
        .ll-stats { display:grid; grid-template-columns:repeat(4,1fr); gap:1rem; margin-bottom:1.25rem; }
        @media(max-width:992px){ .ll-stats{ grid-template-columns:repeat(2,1fr); } }
        @media(max-width:576px){ .ll-stats{ grid-template-columns:1fr; } }
        .ll-stat {
            background:var(--ll-card); border-radius:var(--ll-radius); border:1px solid var(--ll-border);
            box-shadow:0 2px 12px rgba(0,0,0,.04); padding:1rem 1.25rem;
            display:flex; align-items:center; justify-content:space-between;
        }
        .ll-stat-label { font-size:.65rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--ll-faint); }
        .ll-stat-value { font-size:1.5rem; font-weight:800; color:var(--ll-text); line-height:1.2; }
        .ll-stat-icon { width:48px; height:48px; border-radius:14px; display:flex; align-items:center; justify-content:center; font-size:1.1rem; flex-shrink:0; }

        /* Card */
        .ll-card { background:var(--ll-card); border-radius:var(--ll-radius); border:1px solid var(--ll-border); box-shadow:0 2px 12px rgba(0,0,0,.04); overflow:hidden; }
        .ll-card-head { padding:.85rem 1.25rem; display:flex; align-items:center; justify-content:space-between; border-bottom:1px solid var(--ll-border); flex-wrap:wrap; gap:.75rem; }
        .ll-card-title { font-size:.9rem; font-weight:700; color:var(--ll-text); margin:0; display:flex; align-items:center; gap:.45rem; }
        .ll-card-title i { color:var(--ll-amber); font-size:.85rem; }

        /* Toolbar */
        .ll-toolbar { display:flex; align-items:center; gap:.65rem; flex-wrap:wrap; }
        .ll-search { position:relative; }
        .ll-search i { position:absolute; left:10px; top:50%; transform:translateY(-50%); font-size:.75rem; color:var(--ll-faint); }
        .ll-search input { padding:.4rem .8rem .4rem 2rem; border:2px solid #e2e8f0; border-radius:10px; font-size:.82rem; width:220px; color:var(--ll-text); transition:border-color .2s; }
        .ll-search input:focus { border-color:var(--ll-amber); outline:none; }
        .ll-select { padding:.4rem .8rem; border:2px solid #e2e8f0; border-radius:10px; font-size:.82rem; color:var(--ll-text); cursor:pointer; background:#fff; }
        .ll-select:focus { border-color:var(--ll-amber); outline:none; }

        /* Table */
        .ll-table { width:100%; border-collapse:collapse; }
        .ll-table thead th {
            font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--ll-faint);
            padding:.7rem 1rem; border-bottom:1px solid var(--ll-border); background:#fafbfd;
        }
        .ll-table thead th.sortable { cursor:pointer; user-select:none; }
        .ll-table thead th.sortable:hover { color:var(--ll-navy); }
        .ll-table tbody td { padding:.7rem 1rem; border-bottom:1px solid #f5f7fa; vertical-align:middle; font-size:.85rem; }
        .ll-table tbody tr { transition:background .15s; }
        .ll-table tbody tr:hover { background:#fafbfd; }
        .ll-table tbody tr:last-child td { border-bottom:none; }

        /* Badge */
        .ll-badge { display:inline-flex; align-items:center; gap:.2rem; padding:.15rem .55rem; border-radius:8px; font-size:.68rem; font-weight:700; }
        .ll-sort { font-size:.55rem; margin-left:3px; opacity:.4; }
        .ll-sort.active { opacity:1; color:var(--ll-amber); }

        /* Actions */
        .ll-action {
            width:30px; height:30px; border-radius:8px; border:1px solid #e2e8f0; background:#fff;
            display:inline-flex; align-items:center; justify-content:center; cursor:pointer;
            font-size:.72rem; color:var(--ll-muted); transition:all .15s; text-decoration:none;
        }
        .ll-action:hover { background:#f8fafc; color:var(--ll-navy); border-color:#cbd5e1; text-decoration:none; }
        .ll-action.view:hover { color:var(--ll-blue); border-color:#bfdbfe; }

        /* Row link */
        .ll-row-link { color:var(--ll-text); font-weight:700; text-decoration:none; }
        .ll-row-link:hover { color:var(--ll-amber); text-decoration:none; }

        /* Pagination */
        .ll-pagination { padding:.75rem 1.25rem; display:flex; align-items:center; justify-content:space-between; border-top:1px solid var(--ll-border); flex-wrap:wrap; gap:.5rem; }
        .ll-pagination-info { font-size:.78rem; color:var(--ll-faint); font-weight:600; }

        /* Empty */
        .ll-empty { text-align:center; padding:3rem 1rem; color:var(--ll-faint); }
        .ll-empty i { font-size:2.5rem; opacity:.15; display:block; margin-bottom:.6rem; }
        .ll-empty strong { display:block; color:var(--ll-muted); font-size:.92rem; margin-bottom:.2rem; }

        /* Flash */
        .ll-flash { display:flex; align-items:center; gap:.5rem; padding:.7rem 1.15rem; border-radius:12px; font-size:.84rem; font-weight:600; margin-bottom:1rem; animation:llSlide .3s ease; }
        .ll-flash-success { background:#f0fdf4; color:var(--ll-green); border:1px solid #bbf7d0; }

        @keyframes llSlide { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
        @media(max-width:768px){ .ll-content{padding:0 .75rem 1.5rem;} .ll-search input{width:160px;} }
    </style>
    @endpush

    @can('view-loans')
    <section class="content ll-page">
        {{-- Hero --}}
        <div class="ll-hero">
            <div class="ll-hero-inner container-fluid">
                <div>
                    <ul class="ll-breadcrumb">
                        <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                        <li class="sep">/</li>
                        <li class="active">Loans</li>
                    </ul>
                    <h1 class="ll-hero-title">Loans</h1>
                    <p class="ll-hero-sub">View and manage all village bank loans</p>
                </div>
                <div class="ll-hero-actions">
                    <a href="{{ route('loans.request') }}" class="ll-hero-btn ll-btn-amber">
                        <i class="fas fa-plus-circle"></i> Request Loan
                    </a>
                    <a href="{{ route('loans.approval') }}" class="ll-hero-btn ll-btn-outline">
                        <i class="fas fa-clipboard-check"></i> Approvals
                    </a>
                    <a href="{{ route('loans.pairing') }}" class="ll-hero-btn ll-btn-outline">
                        <i class="fas fa-link"></i> Pairing
                    </a>
                </div>
            </div>
        </div>

        <div class="ll-content container-fluid">
            @if(session()->has('message'))
                <div class="ll-flash ll-flash-success"><i class="fas fa-check-circle"></i> {{ session('message') }}</div>
            @endif

            {{-- Stats --}}
            <div class="ll-stats">
                <div class="ll-stat">
                    <div>
                        <div class="ll-stat-label">Total Loans</div>
                        <div class="ll-stat-value">{{ $totalLoans }}</div>
                    </div>
                    <div class="ll-stat-icon" style="background:#f0fdf4;color:var(--ll-green);"><i class="fas fa-file-invoice-dollar"></i></div>
                </div>
                <div class="ll-stat">
                    <div>
                        <div class="ll-stat-label">Pending</div>
                        <div class="ll-stat-value">{{ $pendingLoans }}</div>
                    </div>
                    <div class="ll-stat-icon" style="background:#fffbeb;color:var(--ll-amber);"><i class="fas fa-clock"></i></div>
                </div>
                <div class="ll-stat">
                    <div>
                        <div class="ll-stat-label">Active</div>
                        <div class="ll-stat-value">{{ $activeLoans }}</div>
                    </div>
                    <div class="ll-stat-icon" style="background:#eff6ff;color:var(--ll-blue);"><i class="fas fa-play-circle"></i></div>
                </div>
                <div class="ll-stat">
                    <div>
                        <div class="ll-stat-label">Total Disbursed</div>
                        <div class="ll-stat-value" style="font-size:1.25rem;">K{{ number_format($totalDisbursed, 2) }}</div>
                    </div>
                    <div class="ll-stat-icon" style="background:#f0fdf4;color:var(--ll-green);"><i class="fas fa-coins"></i></div>
                </div>
            </div>

            {{-- Table Card --}}
            <div class="ll-card">
                <div class="ll-card-head">
                    <h3 class="ll-card-title"><i class="fas fa-list-ul"></i> All Loans</h3>
                    <div class="ll-toolbar">
                        <select wire:model="statusFilter" class="ll-select">
                            <option value="">All Statuses</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="active">Active</option>
                            <option value="completed">Completed</option>
                            <option value="rejected">Rejected</option>
                        </select>
                        <div class="ll-search">
                            <i class="fas fa-search"></i>
                            <input type="text" wire:model.debounce.300ms="search" placeholder="Search loans...">
                        </div>
                        <select wire:model="perPage" class="ll-select" style="width:70px;">
                            <option value="10">10</option><option value="15">15</option><option value="25">25</option><option value="50">50</option>
                        </select>
                    </div>
                </div>

                @if($loans->count())
                    <div style="overflow-x:auto;">
                        <table class="ll-table">
                            <thead>
                                <tr>
                                    <th class="sortable" wire:click="sortBy('id')">
                                        ID @if($sortField==='id')<i class="fas fa-sort-{{ $sortDirection==='asc'?'up':'down' }} ll-sort active"></i>@else<i class="fas fa-sort ll-sort"></i>@endif
                                    </th>
                                    <th>Borrower</th>
                                    <th>Circle</th>
                                    <th>Month</th>
                                    <th class="sortable" wire:click="sortBy('amount')">
                                        Amount @if($sortField==='amount')<i class="fas fa-sort-{{ $sortDirection==='asc'?'up':'down' }} ll-sort active"></i>@else<i class="fas fa-sort ll-sort"></i>@endif
                                    </th>
                                    <th>Rate</th>
                                    <th>Payable</th>
                                    <th>Balance</th>
                                    <th>Lenders</th>
                                    <th class="sortable" wire:click="sortBy('status')">
                                        Status @if($sortField==='status')<i class="fas fa-sort-{{ $sortDirection==='asc'?'up':'down' }} ll-sort active"></i>@else<i class="fas fa-sort ll-sort"></i>@endif
                                    </th>
                                    <th class="sortable" wire:click="sortBy('created_at')">
                                        Date @if($sortField==='created_at')<i class="fas fa-sort-{{ $sortDirection==='asc'?'up':'down' }} ll-sort active"></i>@else<i class="fas fa-sort ll-sort"></i>@endif
                                    </th>
                                    <th style="width:60px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($loans as $l)
                                    @php
                                        $sc = [
                                            'pending'   => ['bg'=>'#fffbeb','color'=>'#92400e','border'=>'#fde68a'],
                                            'approved'  => ['bg'=>'#eff6ff','color'=>'#1e40af','border'=>'#bfdbfe'],
                                            'active'    => ['bg'=>'#ecfdf5','color'=>'#065f46','border'=>'#a7f3d0'],
                                            'completed' => ['bg'=>'#f0fdf4','color'=>'#166534','border'=>'#bbf7d0'],
                                            'rejected'  => ['bg'=>'#fef2f2','color'=>'#991b1b','border'=>'#fecaca'],
                                        ][$l->status] ?? ['bg'=>'#f3f4f6','color'=>'#374151','border'=>'#e5e7eb'];
                                    @endphp
                                    <tr>
                                        <td style="color:var(--ll-faint);font-size:.82rem;">#{{ $l->id }}</td>
                                        <td>
                                            <a href="{{ route('loans.show', $l->id) }}" class="ll-row-link">{{ $l->borrower->name ?? '--' }}</a>
                                        </td>
                                        <td style="font-size:.84rem;">{{ $l->month->circle->name ?? '--' }}</td>
                                        <td>
                                            <span class="ll-badge" style="background:#f1f5f9;color:#475569;border:1px solid #e2e8f0;">
                                                M{{ $l->month->month_number ?? '' }}
                                            </span>
                                        </td>
                                        <td style="font-weight:700;">K{{ number_format($l->amount, 2) }}</td>
                                        <td>{{ $l->interest_rate }}%</td>
                                        <td style="color:#1e40af;font-weight:600;">K{{ number_format($l->total_payable, 2) }}</td>
                                        <td style="color:var(--ll-red);font-weight:600;">K{{ number_format($l->outstanding_balance, 2) }}</td>
                                        <td>
                                            <span class="ll-badge" style="background:#f3f4f6;color:#374151;border:1px solid #e5e7eb;">
                                                <i class="fas fa-users" style="font-size:.5rem;"></i> {{ $l->pairings_count }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="ll-badge" style="background:{{ $sc['bg'] }};color:{{ $sc['color'] }};border:1px solid {{ $sc['border'] }};">
                                                {{ ucfirst($l->status) }}
                                            </span>
                                        </td>
                                        <td style="font-size:.78rem;color:var(--ll-faint);">{{ $l->created_at->format('d M Y') }}</td>
                                        <td>
                                            <a href="{{ route('loans.show', $l->id) }}" class="ll-action view" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="ll-pagination">
                        <span class="ll-pagination-info">Showing {{ $loans->firstItem() ?? 0 }}–{{ $loans->lastItem() ?? 0 }} of {{ $loans->total() }}</span>
                        {{ $loans->links() }}
                    </div>
                @else
                    <div class="ll-empty">
                        <i class="fas fa-hand-holding-usd"></i>
                        <strong>No loans found</strong>
                        <span style="font-size:.82rem;">Try adjusting your search or filters.</span>
                    </div>
                @endif
            </div>
        </div>
    </section>
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
