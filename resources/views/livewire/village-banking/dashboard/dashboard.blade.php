<div>
    @push('custom-styles')
    <style>
        /* ══════════════════════════════════════════════════
         *  DASHBOARD v2 — Ndinecom Village Banking
         * ══════════════════════════════════════════════════ */
        :root {
            --db-navy: #1E3A5F;
            --db-navy-light: #2B6B96;
            --db-amber: #D97706;
            --db-amber-light: #F59E0B;
            --db-bg: #f4f6fa;
            --db-card: #ffffff;
            --db-border: #edf0f7;
            --db-text: #1e293b;
            --db-muted: #64748b;
            --db-faint: #94a3b8;
            --db-green: #16a34a;
            --db-red: #dc2626;
            --db-blue: #2563eb;
            --db-purple: #7c3aed;
            --db-cyan: #0891b2;
            --db-orange: #ea580c;
            --db-radius: 16px;
        }

        .db-page { background: var(--db-bg); min-height: 100vh; }

        /* ── Hero ── */
        .db-hero {
            background: linear-gradient(135deg, var(--db-navy) 0%, #234b78 50%, var(--db-navy-light) 100%);
            padding: 1.75rem 0 5rem;
            position: relative; overflow: hidden;
        }
        .db-hero::before {
            content: '';
            position: absolute; width: 500px; height: 500px;
            top: -50%; right: -5%;
            background: radial-gradient(circle, rgba(217,119,6,0.12) 0%, transparent 70%);
            border-radius: 50%; pointer-events: none;
        }
        .db-hero::after {
            content: '';
            position: absolute; width: 300px; height: 300px;
            bottom: -40%; left: 5%;
            background: radial-gradient(circle, rgba(43,107,150,0.15) 0%, transparent 70%);
            border-radius: 50%; pointer-events: none;
        }
        .db-hero-inner {
            position: relative; z-index: 2;
            padding: 0 1.5rem;
        }
        .db-greeting {
            color: rgba(255,255,255,0.55); font-size: 0.82rem;
            font-weight: 500; margin: 0 0 0.15rem;
        }
        .db-greeting strong { color: #fff; font-weight: 700; }
        .db-hero-title {
            color: #fff; font-size: 1.4rem; font-weight: 800;
            margin: 0; line-height: 1.3;
        }
        .db-hero-sub {
            color: rgba(255,255,255,0.5); font-size: 0.8rem;
            margin: 0.25rem 0 0;
        }
        .db-hero-actions {
            display: flex; gap: 0.5rem; flex-wrap: wrap; margin-top: 0.75rem;
        }
        .db-hero-btn {
            display: inline-flex; align-items: center; gap: 0.35rem;
            padding: 0.4rem 1rem; border-radius: 10px;
            font-size: 0.78rem; font-weight: 600;
            border: none; cursor: pointer; text-decoration: none;
            transition: all 0.2s;
        }
        .db-hero-btn-amber {
            background: linear-gradient(135deg, var(--db-amber), var(--db-amber-light));
            color: #fff;
        }
        .db-hero-btn-amber:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(217,119,6,0.3); color: #fff; text-decoration: none; }
        .db-hero-btn-ghost {
            background: rgba(255,255,255,0.1); color: rgba(255,255,255,0.8);
            border: 1px solid rgba(255,255,255,0.15);
        }
        .db-hero-btn-ghost:hover { background: rgba(255,255,255,0.18); color: #fff; text-decoration: none; }

        /* ── Content Grid ── */
        .db-content {
            margin-top: -3.5rem;
            position: relative; z-index: 10;
            padding: 0 1.5rem 2rem;
        }

        /* ── Stat Cards Row ── */
        .db-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        @media (max-width: 1200px) { .db-stats { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 576px)  { .db-stats { grid-template-columns: 1fr; } }

        .db-stat {
            background: var(--db-card);
            border-radius: var(--db-radius);
            border: 1px solid var(--db-border);
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
            padding: 1.15rem 1.25rem;
            display: flex; align-items: center; justify-content: space-between;
            transition: all 0.2s;
            text-decoration: none;
            position: relative; overflow: hidden;
        }
        .db-stat:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            text-decoration: none;
        }
        .db-stat-icon {
            width: 50px; height: 50px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.15rem; flex-shrink: 0;
        }
        .db-stat-label {
            font-size: 0.68rem; text-transform: uppercase; letter-spacing: 0.5px;
            font-weight: 700; color: var(--db-faint); margin-bottom: 0.1rem;
        }
        .db-stat-value {
            font-size: 1.5rem; font-weight: 800; color: var(--db-text);
            line-height: 1.2;
        }
        .db-stat-sub {
            font-size: 0.72rem; font-weight: 600; margin-top: 0.1rem;
        }
        .db-stat-arrow {
            position: absolute; right: 12px; bottom: 8px;
            font-size: 0.65rem; color: var(--db-faint);
            opacity: 0; transition: opacity 0.2s;
        }
        .db-stat:hover .db-stat-arrow { opacity: 1; }

        /* ── Cards base ── */
        .db-card {
            background: var(--db-card);
            border-radius: var(--db-radius);
            border: 1px solid var(--db-border);
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
            overflow: hidden;
        }
        .db-card-head {
            padding: 0.85rem 1.25rem;
            display: flex; align-items: center; justify-content: space-between;
            border-bottom: 1px solid var(--db-border);
        }
        .db-card-title {
            font-size: 0.88rem; font-weight: 700; color: var(--db-text); margin: 0;
            display: flex; align-items: center; gap: 0.45rem;
        }
        .db-card-title i { font-size: 0.82rem; }
        .db-card-link {
            font-size: 0.75rem; font-weight: 600; color: var(--db-amber);
            text-decoration: none; display: flex; align-items: center; gap: 0.25rem;
        }
        .db-card-link:hover { color: #b45309; text-decoration: none; }
        .db-card-body { padding: 1.15rem 1.25rem; }

        /* ── Two-col layout ── */
        .db-grid { display: grid; grid-template-columns: 1fr 380px; gap: 1.5rem; }
        @media (max-width: 1100px) { .db-grid { grid-template-columns: 1fr; } }

        /* ── Finance Row ── */
        .db-finance-row {
            display: grid; grid-template-columns: repeat(4, 1fr);
            gap: 1rem; margin-bottom: 1.5rem;
        }
        @media (max-width: 992px) { .db-finance-row { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 576px) { .db-finance-row { grid-template-columns: 1fr; } }

        .db-finance {
            background: var(--db-card);
            border-radius: 14px;
            border: 1px solid var(--db-border);
            padding: 0.85rem 1rem;
            position: relative; overflow: hidden;
        }
        .db-finance::after {
            content: '';
            position: absolute; right: -10px; top: -10px;
            width: 50px; height: 50px;
            border-radius: 50%;
            opacity: 0.06;
        }
        .db-finance-lbl {
            font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.5px;
            font-weight: 700; color: var(--db-faint);
            display: flex; align-items: center; gap: 0.3rem;
        }
        .db-finance-val { font-size: 1.15rem; font-weight: 800; line-height: 1.3; }

        /* ── Alert Banner ── */
        .db-alert {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.75rem 1.25rem; border-radius: 14px;
            margin-bottom: 1.25rem; font-size: 0.84rem; font-weight: 600;
            background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
            border: 1px solid #fde68a; color: #92400e;
            animation: dbSlide 0.3s ease;
        }
        .db-alert a {
            color: var(--db-amber); font-weight: 700; text-decoration: underline;
        }
        .db-alert a:hover { color: #b45309; }

        /* ── Quick Actions Row ── */
        .db-actions {
            display: grid; grid-template-columns: repeat(6, 1fr);
            gap: 0.65rem; margin-bottom: 1.5rem;
        }
        @media (max-width: 992px)  { .db-actions { grid-template-columns: repeat(3, 1fr); } }
        @media (max-width: 576px)  { .db-actions { grid-template-columns: repeat(2, 1fr); } }

        .db-action {
            display: flex; flex-direction: column; align-items: center;
            gap: 0.4rem; padding: 0.85rem 0.5rem;
            border-radius: 14px; border: 1px solid var(--db-border);
            background: var(--db-card); text-decoration: none;
            transition: all 0.2s; cursor: pointer;
        }
        .db-action:hover {
            border-color: var(--db-amber);
            box-shadow: 0 3px 10px rgba(217,119,6,0.08);
            transform: translateY(-2px); text-decoration: none;
        }
        .db-action-icon {
            width: 42px; height: 42px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem;
        }
        .db-action span {
            font-size: 0.72rem; font-weight: 700; color: var(--db-text);
            text-align: center;
        }

        /* ── Table ── */
        .db-table {
            width: 100%; border-collapse: collapse;
            font-size: 0.84rem;
        }
        .db-table thead th {
            font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.5px;
            font-weight: 700; color: var(--db-faint);
            padding: 0.65rem 1rem; border-bottom: 1px solid var(--db-border);
            background: #fafbfd;
        }
        .db-table tbody td {
            padding: 0.65rem 1rem; border-bottom: 1px solid #f5f7fa;
            color: var(--db-text); vertical-align: middle;
        }
        .db-table tbody tr:last-child td { border-bottom: none; }
        .db-table tbody tr:hover { background: #fafbfd; }

        /* ── Badge ── */
        .db-badge {
            display: inline-flex; align-items: center; gap: 0.2rem;
            padding: 0.15rem 0.55rem; border-radius: 8px;
            font-size: 0.68rem; font-weight: 700;
        }

        /* ── My Overview Card ── */
        .db-me-header {
            background: linear-gradient(135deg, var(--db-navy), var(--db-navy-light));
            padding: 1.25rem;
        }
        .db-me-avatar {
            width: 48px; height: 48px; border-radius: 50%;
            background: rgba(255,255,255,0.12);
            border: 2px solid rgba(255,255,255,0.2);
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 700; font-size: 1.1rem;
            flex-shrink: 0;
        }
        .db-me-name { color: #fff; font-weight: 700; font-size: 0.95rem; margin: 0; }
        .db-me-email { color: rgba(255,255,255,0.55); font-size: 0.78rem; margin: 0; }

        .db-me-stats {
            display: grid; grid-template-columns: repeat(3, 1fr);
            border-bottom: 1px solid var(--db-border);
        }
        .db-me-stat {
            text-align: center; padding: 0.75rem 0.25rem;
            border-right: 1px solid var(--db-border);
        }
        .db-me-stat:last-child { border-right: none; }
        .db-me-stat-num {
            font-size: 1.1rem; font-weight: 800;
        }
        .db-me-stat-lbl {
            font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.5px;
            color: var(--db-faint); font-weight: 700;
        }

        /* ── Loan List Items ── */
        .db-loan-item {
            padding: 0.75rem 1.25rem;
            border-bottom: 1px solid #f5f7fa;
            transition: background 0.15s;
        }
        .db-loan-item:last-child { border-bottom: none; }
        .db-loan-item:hover { background: #fafbfd; }

        /* ── Payment items ── */
        .db-pay-item {
            display: flex; align-items: center; justify-content: space-between;
            padding: 0.65rem 1.25rem;
            border-bottom: 1px solid #f5f7fa;
        }
        .db-pay-item:last-child { border-bottom: none; }
        .db-pay-item:hover { background: #fafbfd; }

        /* ── System Stats ── */
        .db-sys-row {
            display: flex; justify-content: space-between; align-items: center;
            padding: 0.55rem 0;
            border-bottom: 1px solid #f5f7fa;
            font-size: 0.84rem;
        }
        .db-sys-row:last-child { border-bottom: none; }

        /* ── Progress ── */
        .db-progress {
            height: 6px; border-radius: 6px;
            background: #f1f5f9; overflow: hidden;
        }
        .db-progress-bar {
            height: 100%; border-radius: 6px;
            transition: width 0.6s ease;
        }

        /* ── Empty ── */
        .db-empty {
            text-align: center; padding: 2rem 1rem; color: var(--db-faint);
        }
        .db-empty i { font-size: 2rem; opacity: 0.2; display: block; margin-bottom: 0.4rem; }
        .db-empty strong { display: block; color: var(--db-muted); font-size: 0.88rem; }

        /* ── Circle Health Tiles ── */
        .db-ch-grid {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.75rem;
        }
        @media (max-width: 992px) { .db-ch-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 576px) { .db-ch-grid { grid-template-columns: 1fr; } }

        .db-ch-tile {
            padding: 0.85rem 1rem;
            border-radius: 12px; border: 1px solid var(--db-border);
            transition: all 0.2s;
        }
        .db-ch-tile:hover {
            border-color: var(--db-amber);
            box-shadow: 0 3px 10px rgba(217,119,6,0.06);
        }
        .db-ch-name {
            font-weight: 700; font-size: 0.88rem; color: var(--db-text);
            display: flex; align-items: center; gap: 0.35rem;
        }
        .db-ch-meta { font-size: 0.75rem; color: var(--db-muted); margin-top: 0.2rem; }

        /* ── Outstanding Alert ── */
        .db-outstanding {
            background: linear-gradient(135deg, #fef2f2, #fff1f2);
            border: 1px solid #fecaca;
            border-radius: 12px;
            padding: 0.85rem 1rem;
            text-align: center;
        }

        @keyframes dbSlide {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── Flash ── */
        .db-flash {
            display: flex; align-items: center; gap: 0.5rem;
            padding: 0.65rem 1.15rem; border-radius: 12px;
            font-size: 0.84rem; font-weight: 600;
            margin-bottom: 1rem; animation: dbSlide 0.3s ease;
            background: #f0fdf4; color: var(--db-green); border: 1px solid #bbf7d0;
        }
    </style>
    @endpush

    @can('view-dashboard')
    <section class="content db-page">
        {{-- ═══════════ Hero Banner ═══════════ --}}
        <div class="db-hero">
            <div class="db-hero-inner container-fluid">
                <div class="d-flex align-items-start justify-content-between flex-wrap" style="gap:1rem;">
                    <div>
                        <p class="db-greeting">
                            @php
                                $hour = now()->hour;
                                $greet = $hour < 12 ? 'Good morning' : ($hour < 17 ? 'Good afternoon' : 'Good evening');
                            @endphp
                            {{ $greet }}, <strong>{{ Auth::user()->name }}</strong>
                        </p>
                        <h1 class="db-hero-title">Village Banking Dashboard</h1>
                        <p class="db-hero-sub">
                            @if(session('current_village_bank_name'))
                                <i class="fas fa-university" style="font-size:0.7rem;"></i> {{ session('current_village_bank_name') }} &bull;
                            @endif
                            {{ now()->format('l, M d, Y') }}
                        </p>
                    </div>
                    <div class="db-hero-actions">
                        @include('partials.village-bank-selector')
                        <a href="{{ route('reports.index') }}" class="db-hero-btn db-hero-btn-ghost">
                            <i class="fas fa-chart-bar"></i> Reports
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════ Main Content ═══════════ --}}
        <div class="db-content container-fluid">

            {{-- Flash --}}
            @if(session()->has('message'))
                <div class="db-flash">
                    <i class="fas fa-check-circle"></i> {{ session('message') }}
                </div>
            @endif

            {{-- Pending actions alert --}}
            @if($pendingMembers > 0 || $pendingLoans > 0 || $pendingPayments > 0 || $pendingApplications > 0)
                <div class="db-alert">
                    <i class="fas fa-exclamation-triangle" style="font-size:1.1rem;flex-shrink:0;"></i>
                    <div>
                        <strong>Action needed:</strong>
                        @if($pendingApplications > 0)
                            <a href="{{ route('subscription.applications') }}">{{ $pendingApplications }} application(s)</a>
                        @endif
                        @if($pendingMembers > 0)
                            {{ $pendingApplications > 0 ? '&middot;' : '' }}
                            <a href="{{ route('members.approval') }}">{{ $pendingMembers }} member(s)</a>
                        @endif
                        @if($pendingLoans > 0)
                            {{ ($pendingApplications > 0 || $pendingMembers > 0) ? '&middot;' : '' }}
                            <a href="{{ route('loans.approval') }}">{{ $pendingLoans }} loan(s)</a>
                        @endif
                        @if($pendingPayments > 0)
                            {{ ($pendingApplications > 0 || $pendingMembers > 0 || $pendingLoans > 0) ? '&middot;' : '' }}
                            <a href="{{ route('payments.confirm') }}">{{ $pendingPayments }} payment(s)</a>
                        @endif
                        awaiting review.
                    </div>
                </div>
            @endif

            {{-- ═══════ ROW 1: Key Stat Cards ═══════ --}}
            <div class="db-stats">
                {{-- Active Circles --}}
                <a href="{{ route('circles.index') }}" class="db-stat">
                    <div>
                        <div class="db-stat-label">Active Circles</div>
                        <div class="db-stat-value">{{ $activeCircles }}</div>
                        <div class="db-stat-sub" style="color:var(--db-faint);">of {{ $totalCircles }} total</div>
                    </div>
                    <div class="db-stat-icon" style="background:#eff6ff;color:var(--db-blue);">
                        <i class="fas fa-circle-notch"></i>
                    </div>
                    <i class="fas fa-arrow-right db-stat-arrow"></i>
                </a>

                {{-- Total Members --}}
                <a href="{{ route('members.index') }}" class="db-stat">
                    <div>
                        <div class="db-stat-label">Members</div>
                        <div class="db-stat-value">{{ $totalMembers }}</div>
                        @if($pendingMembers > 0)
                            <div class="db-stat-sub" style="color:var(--db-amber);">{{ $pendingMembers }} pending</div>
                        @endif
                    </div>
                    <div class="db-stat-icon" style="background:#f0fdf4;color:var(--db-green);">
                        <i class="fas fa-users"></i>
                    </div>
                    <i class="fas fa-arrow-right db-stat-arrow"></i>
                </a>

                {{-- Active Loans --}}
                <a href="{{ route('loans.index') }}" class="db-stat">
                    <div>
                        <div class="db-stat-label">Active Loans</div>
                        <div class="db-stat-value">{{ $activeLoans }}</div>
                        @if($pendingLoans > 0)
                            <div class="db-stat-sub" style="color:var(--db-amber);">{{ $pendingLoans }} pending</div>
                        @else
                            <div class="db-stat-sub" style="color:var(--db-faint);">K{{ number_format($totalLoanAmount, 0) }} issued</div>
                        @endif
                    </div>
                    <div class="db-stat-icon" style="background:#fff7ed;color:var(--db-orange);">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <i class="fas fa-arrow-right db-stat-arrow"></i>
                </a>

                {{-- Shareouts --}}
                <a href="{{ route('shareout.index') }}" class="db-stat">
                    <div>
                        <div class="db-stat-label">Shareouts</div>
                        <div class="db-stat-value">{{ $shareoutsDone }}</div>
                        <div class="db-stat-sub" style="color:var(--db-faint);">K{{ number_format($totalDistributed, 0) }} distributed</div>
                    </div>
                    <div class="db-stat-icon" style="background:#fffbeb;color:var(--db-amber);">
                        <i class="fas fa-coins"></i>
                    </div>
                    <i class="fas fa-arrow-right db-stat-arrow"></i>
                </a>
            </div>

            {{-- ═══════ ROW 2: Financial Summary ═══════ --}}
            <div class="db-finance-row">
                <div class="db-finance">
                    <div class="db-finance-lbl"><i class="fas fa-piggy-bank" style="color:var(--db-cyan);"></i> Contributions</div>
                    <div class="db-finance-val" style="color:var(--db-cyan);">K{{ number_format($totalContributions, 2) }}</div>
                </div>
                <div class="db-finance">
                    <div class="db-finance-lbl"><i class="fas fa-check-double" style="color:var(--db-green);"></i> Total Repaid</div>
                    <div class="db-finance-val" style="color:var(--db-green);">K{{ number_format($totalRepaid, 2) }}</div>
                </div>
                <div class="db-finance">
                    <div class="db-finance-lbl"><i class="fas fa-exclamation-circle" style="color:var(--db-red);"></i> Outstanding</div>
                    <div class="db-finance-val" style="color:var(--db-red);">K{{ number_format($totalOutstanding, 2) }}</div>
                </div>
                <div class="db-finance">
                    <div class="db-finance-lbl"><i class="fas fa-shield-alt" style="color:var(--db-purple);"></i> Penalties + Insurance</div>
                    <div class="db-finance-val" style="color:var(--db-purple);">K{{ number_format($totalPenalties + $totalInsurance, 2) }}</div>
                </div>
            </div>

            {{-- ═══════ ROW 3: Quick Actions ═══════ --}}
            @php
                $actions = [
                    ['route' => 'circles.create',   'icon' => 'fas fa-plus-circle',        'label' => 'New Circle',     'color' => '#2563eb', 'bg' => '#eff6ff'],
                    ['route' => 'members.create',   'icon' => 'fas fa-user-plus',          'label' => 'Add Member',     'color' => '#16a34a', 'bg' => '#f0fdf4'],
                    ['route' => 'loans.request',    'icon' => 'fas fa-file-invoice-dollar', 'label' => 'Loan Request',   'color' => '#ea580c', 'bg' => '#fff7ed'],
                    ['route' => 'shares.declare',   'icon' => 'fas fa-coins',              'label' => 'Declare Shares', 'color' => '#0891b2', 'bg' => '#ecfeff'],
                    ['route' => 'payments.upload',  'icon' => 'fas fa-upload',             'label' => 'Upload Payment', 'color' => '#7c3aed', 'bg' => '#f5f3ff'],
                    ['route' => 'repayments.index', 'icon' => 'fas fa-money-bill-wave',    'label' => 'Repayment',      'color' => '#dc2626', 'bg' => '#fef2f2'],
                ];
            @endphp
            <div class="db-actions">
                @foreach($actions as $act)
                    <a href="{{ route($act['route']) }}" class="db-action">
                        <div class="db-action-icon" style="background:{{ $act['bg'] }};color:{{ $act['color'] }};">
                            <i class="{{ $act['icon'] }}"></i>
                        </div>
                        <span>{{ $act['label'] }}</span>
                    </a>
                @endforeach
            </div>

            {{-- ═══════ ROW 4: Two-Column Grid ═══════ --}}
            <div class="db-grid">

                {{-- ════ LEFT COLUMN ════ --}}
                <div>
                    {{-- Circle Health --}}
                    @if($circleHealth->count())
                        <div class="db-card" style="margin-bottom:1.25rem;">
                            <div class="db-card-head">
                                <h3 class="db-card-title">
                                    <i class="fas fa-heartbeat" style="color:var(--db-green);"></i> Active Circles
                                </h3>
                                <a href="{{ route('circles.index') }}" class="db-card-link">
                                    View all <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                            <div class="db-card-body">
                                <div class="db-ch-grid">
                                    @foreach($circleHealth as $ch)
                                        @php $activeMo = $ch->months->first(); @endphp
                                        <div class="db-ch-tile">
                                            <div class="db-ch-name">
                                                <i class="fas fa-circle" style="font-size:0.45rem;color:var(--db-green);"></i>
                                                {{ $ch->name }}
                                            </div>
                                            <div class="db-ch-meta">
                                                <i class="fas fa-users" style="font-size:0.6rem;"></i> {{ $ch->members_count }} members
                                                @if($activeMo)
                                                    &bull; Month {{ $activeMo->month_number }}
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Recent Loans Table --}}
                    <div class="db-card" style="margin-bottom:1.25rem;">
                        <div class="db-card-head">
                            <h3 class="db-card-title">
                                <i class="fas fa-file-invoice-dollar" style="color:var(--db-orange);"></i> Recent Loan Requests
                            </h3>
                            <a href="{{ route('loans.index') }}" class="db-card-link">
                                View all <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                        @if($recentLoans->count())
                            <table class="db-table">
                                <thead>
                                    <tr>
                                        <th>Borrower</th>
                                        <th>Circle</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentLoans as $rl)
                                        @php
                                            $sc = [
                                                'pending'   => ['bg' => '#fffbeb', 'color' => '#92400e', 'border' => '#fde68a'],
                                                'approved'  => ['bg' => '#eff6ff', 'color' => '#1e40af', 'border' => '#bfdbfe'],
                                                'active'    => ['bg' => '#f0fdf4', 'color' => '#166534', 'border' => '#bbf7d0'],
                                                'completed' => ['bg' => '#f3f4f6', 'color' => '#374151', 'border' => '#e5e7eb'],
                                                'rejected'  => ['bg' => '#fef2f2', 'color' => '#991b1b', 'border' => '#fecaca'],
                                            ][$rl->status] ?? ['bg' => '#f3f4f6', 'color' => '#374151', 'border' => '#e5e7eb'];
                                        @endphp
                                        <tr>
                                            <td><strong>{{ $rl->borrower->name ?? '--' }}</strong></td>
                                            <td style="color:var(--db-muted);">{{ $rl->month->circle->name ?? '--' }}</td>
                                            <td style="font-weight:700;">K{{ number_format($rl->amount, 2) }}</td>
                                            <td>
                                                <span class="db-badge" style="background:{{ $sc['bg'] }};color:{{ $sc['color'] }};border:1px solid {{ $sc['border'] }};">
                                                    {{ ucfirst($rl->status) }}
                                                </span>
                                            </td>
                                            <td style="color:var(--db-faint);font-size:0.78rem;">{{ $rl->created_at->format('d M') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="db-empty">
                                <i class="fas fa-file-invoice-dollar"></i>
                                <strong>No loan requests yet</strong>
                            </div>
                        @endif
                    </div>

                    {{-- System Stats --}}
                    <div class="db-card">
                        <div class="db-card-head">
                            <h3 class="db-card-title">
                                <i class="fas fa-tachometer-alt" style="color:var(--db-cyan);"></i> System Summary
                            </h3>
                        </div>
                        <div class="db-card-body" style="padding:0.75rem 1.25rem;">
                            <div class="db-sys-row">
                                <span style="color:var(--db-muted);">Total Loans Issued</span>
                                <strong>K{{ number_format($totalLoanAmount, 2) }}</strong>
                            </div>
                            <div class="db-sys-row">
                                <span style="color:var(--db-muted);">Confirmed Payments</span>
                                <strong style="color:var(--db-green);">K{{ number_format($confirmedPayments, 2) }}</strong>
                            </div>
                            <div class="db-sys-row">
                                <span style="color:var(--db-muted);">Total Penalties</span>
                                <strong style="color:var(--db-red);">K{{ number_format($totalPenalties, 2) }}</strong>
                            </div>
                            <div class="db-sys-row">
                                <span style="color:var(--db-muted);">Insurance Pool</span>
                                <strong style="color:#0d9488;">K{{ number_format($totalInsurance, 2) }}</strong>
                            </div>
                            <div class="db-sys-row">
                                <span style="color:var(--db-muted);">Distributed (Shareouts)</span>
                                <strong style="color:var(--db-amber);">K{{ number_format($totalDistributed, 2) }}</strong>
                            </div>
                            @php
                                $repayRate = $totalLoanAmount > 0 ? round(($totalRepaid / $totalLoanAmount) * 100) : 0;
                            @endphp
                            <div style="margin-top:0.75rem;">
                                <div class="d-flex justify-content-between" style="font-size:0.8rem;margin-bottom:0.3rem;">
                                    <span style="color:var(--db-muted);font-weight:600;">Repayment Rate</span>
                                    <strong style="color:{{ $repayRate >= 70 ? 'var(--db-green)' : ($repayRate >= 40 ? 'var(--db-amber)' : 'var(--db-red)') }};">{{ $repayRate }}%</strong>
                                </div>
                                <div class="db-progress">
                                    <div class="db-progress-bar" style="width:{{ $repayRate }}%;background:{{ $repayRate >= 70 ? 'var(--db-green)' : ($repayRate >= 40 ? 'var(--db-amber)' : 'var(--db-red)') }};"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ════ RIGHT COLUMN ════ --}}
                <div>
                    {{-- My Overview --}}
                    <div class="db-card" style="margin-bottom:1.25rem;">
                        <div class="db-me-header">
                            <div class="d-flex align-items-center" style="gap:0.85rem;">
                                @php
                                    $avatarUrl = null;
                                    $u = Auth::user();
                                    if ($u->avatar && file_exists(storage_path('app/public/user_avatar/' . $u->avatar))) {
                                        $avatarUrl = asset('storage/user_avatar/' . $u->avatar);
                                    }
                                @endphp
                                @if($avatarUrl)
                                    <img src="{{ $avatarUrl }}" alt="" style="width:48px;height:48px;border-radius:50%;object-fit:cover;border:2px solid rgba(255,255,255,0.2);">
                                @else
                                    <div class="db-me-avatar">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div>
                                    <h4 class="db-me-name">{{ Auth::user()->name }}</h4>
                                    <p class="db-me-email">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="db-me-stats">
                            <div class="db-me-stat">
                                <div class="db-me-stat-num" style="color:var(--db-blue);">{{ $myCircles->count() }}</div>
                                <div class="db-me-stat-lbl">Circles</div>
                            </div>
                            <div class="db-me-stat">
                                <div class="db-me-stat-num" style="color:var(--db-green);">K{{ number_format($myContributions, 0) }}</div>
                                <div class="db-me-stat-lbl">Contributed</div>
                            </div>
                            <div class="db-me-stat">
                                <div class="db-me-stat-num" style="color:var(--db-red);">{{ $myActiveLoans }}</div>
                                <div class="db-me-stat-lbl">Active Loans</div>
                            </div>
                        </div>
                        @if($myOutstanding > 0)
                            <div style="padding:0.85rem 1.25rem;">
                                <div class="db-outstanding">
                                    <div style="font-size:0.68rem;text-transform:uppercase;letter-spacing:0.5px;font-weight:700;color:var(--db-faint);margin-bottom:0.15rem;">My Outstanding Balance</div>
                                    <div style="font-size:1.3rem;font-weight:800;color:var(--db-red);">K{{ number_format($myOutstanding, 2) }}</div>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- My Loans --}}
                    @if($myLoans->count())
                        <div class="db-card" style="margin-bottom:1.25rem;">
                            <div class="db-card-head">
                                <h3 class="db-card-title">
                                    <i class="fas fa-file-alt" style="color:var(--db-navy);"></i> My Loans
                                </h3>
                            </div>
                            <div>
                                @foreach($myLoans as $ml)
                                    @php
                                        $sc = [
                                            'pending'   => ['bg' => '#fffbeb', 'color' => '#92400e', 'border' => '#fde68a'],
                                            'approved'  => ['bg' => '#eff6ff', 'color' => '#1e40af', 'border' => '#bfdbfe'],
                                            'active'    => ['bg' => '#f0fdf4', 'color' => '#166534', 'border' => '#bbf7d0'],
                                            'completed' => ['bg' => '#f3f4f6', 'color' => '#374151', 'border' => '#e5e7eb'],
                                            'rejected'  => ['bg' => '#fef2f2', 'color' => '#991b1b', 'border' => '#fecaca'],
                                        ][$ml->status] ?? ['bg' => '#f3f4f6', 'color' => '#374151', 'border' => '#e5e7eb'];
                                        $pct = $ml->total_payable > 0 ? min(100, round((($ml->total_payable - $ml->outstanding_balance) / $ml->total_payable) * 100)) : 0;
                                    @endphp
                                    <div class="db-loan-item">
                                        <div class="d-flex justify-content-between align-items-center" style="margin-bottom:0.25rem;">
                                            <strong style="font-size:0.85rem;">{{ $ml->month->circle->name ?? '--' }}</strong>
                                            <span class="db-badge" style="background:{{ $sc['bg'] }};color:{{ $sc['color'] }};border:1px solid {{ $sc['border'] }};">
                                                {{ ucfirst($ml->status) }}
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between" style="font-size:0.78rem;color:var(--db-muted);margin-bottom:0.3rem;">
                                            <span>K{{ number_format($ml->amount, 2) }}</span>
                                            <span style="font-weight:600;">{{ $pct }}% repaid</span>
                                        </div>
                                        <div class="db-progress">
                                            <div class="db-progress-bar" style="width:{{ $pct }}%;background:{{ $pct >= 70 ? 'var(--db-green)' : ($pct >= 30 ? 'var(--db-amber)' : 'var(--db-red)') }};"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Recent Payments --}}
                    <div class="db-card">
                        <div class="db-card-head">
                            <h3 class="db-card-title">
                                <i class="fas fa-exchange-alt" style="color:var(--db-purple);"></i> Recent Payments
                            </h3>
                            <a href="{{ route('payments.confirm') }}" class="db-card-link">
                                View all <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                        @if($recentPayments->count())
                            <div>
                                @foreach($recentPayments as $rp)
                                    @php
                                        $sc = [
                                            'pending'   => ['bg' => '#fffbeb', 'color' => '#92400e', 'border' => '#fde68a'],
                                            'confirmed' => ['bg' => '#f0fdf4', 'color' => '#166534', 'border' => '#bbf7d0'],
                                            'rejected'  => ['bg' => '#fef2f2', 'color' => '#991b1b', 'border' => '#fecaca'],
                                        ][$rp->status] ?? ['bg' => '#f3f4f6', 'color' => '#374151', 'border' => '#e5e7eb'];
                                    @endphp
                                    <div class="db-pay-item">
                                        <div>
                                            <strong style="font-size:0.84rem;">{{ $rp->sender->name ?? '--' }}</strong>
                                            <div style="font-size:0.72rem;color:var(--db-faint);">to {{ $rp->receiver->name ?? '--' }}</div>
                                        </div>
                                        <div style="text-align:right;">
                                            <div style="font-weight:700;font-size:0.88rem;">K{{ number_format($rp->amount, 2) }}</div>
                                            <span class="db-badge" style="background:{{ $sc['bg'] }};color:{{ $sc['color'] }};border:1px solid {{ $sc['border'] }};">
                                                {{ ucfirst($rp->status) }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="db-empty">
                                <i class="fas fa-exchange-alt"></i>
                                <strong>No payments yet</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div> {{-- end db-grid --}}

        </div> {{-- end db-content --}}
    </section>
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
