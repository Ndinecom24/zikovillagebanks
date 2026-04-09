<div>
    @push('custom-styles')
    <style>
        /* ══════════════════════════════════════════════════
         *  MEMBER SHOW v1 — Ndinecom Village Banking
         * ══════════════════════════════════════════════════ */
        :root {
            --ms-navy: #1E3A5F;
            --ms-navy-light: #2B6B96;
            --ms-amber: #D97706;
            --ms-amber-light: #F59E0B;
            --ms-bg: #f4f6fa;
            --ms-card: #ffffff;
            --ms-border: #edf0f7;
            --ms-text: #1e293b;
            --ms-muted: #64748b;
            --ms-faint: #94a3b8;
            --ms-green: #16a34a;
            --ms-red: #dc2626;
            --ms-blue: #2563eb;
            --ms-radius: 16px;
        }

        .ms-page { background: var(--ms-bg); min-height: 100vh; }

        /* ── Hero ── */
        .ms-hero {
            background: linear-gradient(135deg, var(--ms-navy) 0%, #234b78 50%, var(--ms-navy-light) 100%);
            padding: 1.75rem 0 6rem;
            position: relative; overflow: hidden;
        }
        .ms-hero::before {
            content: '';
            position: absolute; width: 600px; height: 600px;
            top: -60%; right: -8%;
            background: radial-gradient(circle, rgba(217,119,6,0.12) 0%, transparent 70%);
            border-radius: 50%; pointer-events: none;
        }
        .ms-hero-inner {
            position: relative; z-index: 2; padding: 0 1.5rem;
        }
        .ms-breadcrumb {
            display: flex; gap: 0.5rem; list-style: none; padding: 0; margin: 0;
            font-size: 0.82rem;
        }
        .ms-breadcrumb a { color: rgba(255,255,255,0.55); text-decoration: none; }
        .ms-breadcrumb a:hover { color: rgba(255,255,255,0.85); }
        .ms-breadcrumb .active { color: var(--ms-amber-light); font-weight: 600; }
        .ms-breadcrumb .sep { color: rgba(255,255,255,0.25); }

        /* ── Content ── */
        .ms-content {
            margin-top: -4.5rem;
            position: relative; z-index: 10;
            padding: 0 1.5rem 2rem;
        }

        /* ── Two Column Layout ── */
        .ms-grid {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 1.25rem;
            align-items: start;
        }
        @media (max-width: 992px) {
            .ms-grid { grid-template-columns: 1fr; }
        }

        /* ── Sidebar Card ── */
        .ms-sidebar {
            background: var(--ms-card);
            border-radius: var(--ms-radius);
            border: 1px solid var(--ms-border);
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
            overflow: hidden;
        }
        .ms-sidebar-header {
            background: linear-gradient(135deg, var(--ms-navy) 0%, var(--ms-navy-light) 100%);
            padding: 2rem 1.5rem;
            text-align: center;
        }
        .ms-avatar-lg {
            width: 90px; height: 90px; border-radius: 50%;
            display: inline-flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 1.7rem;
            background: rgba(255,255,255,0.15);
            color: #fff; letter-spacing: 1px;
            border: 3px solid rgba(255,255,255,0.2);
            margin-bottom: 0.85rem;
        }
        .ms-avatar-lg img {
            width: 90px; height: 90px; border-radius: 50%;
            object-fit: cover; border: 3px solid rgba(255,255,255,0.2);
        }
        .ms-sidebar-name {
            color: #fff; font-size: 1.15rem; font-weight: 800; margin: 0;
        }
        .ms-sidebar-email {
            color: rgba(255,255,255,0.55); font-size: 0.82rem; margin-top: 0.15rem;
        }
        .ms-sidebar-badge {
            display: inline-flex; align-items: center; gap: 0.25rem;
            padding: 0.2rem 0.65rem; border-radius: 8px;
            font-size: 0.7rem; font-weight: 700;
            margin-top: 0.5rem;
        }
        .ms-sidebar-body { padding: 1.25rem 1.5rem; }

        .ms-info-row {
            display: flex; align-items: flex-start; gap: 0.65rem;
            padding: 0.55rem 0;
            border-bottom: 1px solid #f5f7fa;
        }
        .ms-info-row:last-child { border-bottom: none; }
        .ms-info-icon {
            width: 32px; height: 32px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.7rem; flex-shrink: 0;
            background: #f8fafc; color: var(--ms-muted);
        }
        .ms-info-label {
            font-size: 0.62rem; text-transform: uppercase; letter-spacing: 0.5px;
            font-weight: 700; color: var(--ms-faint);
        }
        .ms-info-value {
            font-size: 0.88rem; font-weight: 600; color: var(--ms-text); margin-top: 0.05rem;
        }

        /* ── Quick Stats Row ── */
        .ms-quick-stats {
            display: grid; grid-template-columns: repeat(4, 1fr);
            gap: 0.75rem; margin-bottom: 1.25rem;
        }
        @media (max-width: 768px) { .ms-quick-stats { grid-template-columns: repeat(2, 1fr); } }
        .ms-qstat {
            background: var(--ms-card);
            border-radius: var(--ms-radius);
            border: 1px solid var(--ms-border);
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
            padding: 1rem 1.15rem;
            text-align: center;
        }
        .ms-qstat-num {
            font-size: 1.5rem; font-weight: 800; color: var(--ms-text); line-height: 1.2;
        }
        .ms-qstat-label {
            font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.5px;
            font-weight: 700; color: var(--ms-faint); margin-top: 0.1rem;
        }

        /* ── Right Panel ── */
        .ms-main {
            background: var(--ms-card);
            border-radius: var(--ms-radius);
            border: 1px solid var(--ms-border);
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
            overflow: hidden;
        }

        /* ── Tabs ── */
        .ms-tabs {
            display: flex; overflow-x: auto;
            border-bottom: 2px solid var(--ms-border);
            scrollbar-width: none;
        }
        .ms-tabs::-webkit-scrollbar { display: none; }
        .ms-tab {
            display: flex; align-items: center; gap: 0.35rem;
            padding: 0.85rem 1.15rem;
            font-size: 0.8rem; font-weight: 600;
            color: var(--ms-muted);
            border: none; background: none;
            cursor: pointer;
            border-bottom: 2px solid transparent;
            margin-bottom: -2px;
            white-space: nowrap;
            transition: all 0.15s;
        }
        .ms-tab:hover { color: var(--ms-text); background: #fafbfd; }
        .ms-tab.active {
            color: var(--ms-amber);
            border-bottom-color: var(--ms-amber);
        }
        .ms-tab i { font-size: 0.72rem; }

        /* ── Tab Content ── */
        .ms-tab-body { padding: 1.25rem 1.5rem; }

        .ms-section-title {
            font-size: 0.92rem; font-weight: 700; color: var(--ms-text);
            margin-bottom: 0.85rem; padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--ms-border);
        }

        /* ── Info Grid ── */
        .ms-detail-grid {
            display: grid; grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem 1.5rem;
        }
        @media (max-width: 576px) { .ms-detail-grid { grid-template-columns: 1fr; } }
        .ms-detail-item {}
        .ms-detail-label {
            font-size: 0.62rem; text-transform: uppercase; letter-spacing: 0.5px;
            font-weight: 700; color: var(--ms-faint);
        }
        .ms-detail-value {
            font-size: 0.88rem; font-weight: 600; color: var(--ms-text); margin-top: 0.05rem;
        }

        /* ── Sub-table ── */
        .ms-subtable {
            width: 100%; border-collapse: collapse;
        }
        .ms-subtable thead th {
            font-size: 0.62rem; text-transform: uppercase; letter-spacing: 0.5px;
            font-weight: 700; color: var(--ms-faint);
            padding: 0.6rem 0.75rem; border-bottom: 1px solid var(--ms-border);
            background: #fafbfd;
        }
        .ms-subtable tbody td {
            padding: 0.65rem 0.75rem; border-bottom: 1px solid #f5f7fa;
            font-size: 0.84rem; vertical-align: middle;
        }
        .ms-subtable tbody tr:last-child td { border-bottom: none; }
        .ms-subtable tbody tr:hover { background: #fafbfd; }

        /* ── Badge (reusable) ── */
        .ms-badge {
            display: inline-flex; align-items: center; gap: 0.2rem;
            padding: 0.15rem 0.55rem; border-radius: 8px;
            font-size: 0.68rem; font-weight: 700;
        }

        /* ── Empty state ── */
        .ms-empty-section {
            text-align: center; padding: 2rem 1rem; color: var(--ms-faint);
        }
        .ms-empty-section i { font-size: 2rem; opacity: 0.15; display: block; margin-bottom: 0.5rem; }
        .ms-empty-section p { font-size: 0.84rem; color: var(--ms-muted); margin: 0; }

        /* ── Back link ── */
        .ms-back {
            display: inline-flex; align-items: center; gap: 0.35rem;
            color: rgba(255,255,255,0.65); font-size: 0.82rem; font-weight: 600;
            text-decoration: none; margin-bottom: 0.6rem;
        }
        .ms-back:hover { color: #fff; text-decoration: none; }

        /* ── Guarantor card ── */
        .ms-guarantor-card {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.85rem 1rem; border-radius: 12px;
            background: #f8fafc; border: 1px solid var(--ms-border);
        }
        .ms-guarantor-avatar {
            width: 42px; height: 42px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 0.75rem;
            background: linear-gradient(135deg, var(--ms-navy), var(--ms-navy-light));
            color: #fff; flex-shrink: 0;
        }

        @keyframes msSlide {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .ms-animate { animation: msSlide 0.3s ease; }

        @media (max-width: 768px) {
            .ms-content { padding: 0 0.75rem 1.5rem; }
        }
    </style>
    @endpush

    @can('view-members')
    <section class="content ms-page">
        {{-- ═══════════ Hero ═══════════ --}}
        <div class="ms-hero">
            <div class="ms-hero-inner container-fluid">
                <a href="{{ route('members.index') }}" class="ms-back">
                    <i class="fas fa-arrow-left"></i> Back to Members
                </a>
                <ul class="ms-breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('members.index') }}">Members</a></li>
                    <li class="sep">/</li>
                    <li class="active">{{ $member->name }}</li>
                </ul>
            </div>
        </div>

        {{-- ═══════════ Content ═══════════ --}}
        <div class="ms-content container-fluid">

            <div class="ms-grid ms-animate">
                {{-- ═══════ Left Sidebar ═══════ --}}
                <div>
                    <div class="ms-sidebar">
                        <div class="ms-sidebar-header">
                            @php
                                $parts = explode(' ', trim($member->name ?? ''));
                                $initials = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
                                $avatarUrl = null;
                                if ($member->avatar && file_exists(storage_path('app/public/user_avatar/' . $member->avatar))) {
                                    $avatarUrl = asset('storage/user_avatar/' . $member->avatar);
                                }
                                $sc = [
                                    'active'    => ['bg' => 'rgba(34,197,94,0.15)', 'color' => '#86efac', 'label' => 'Active'],
                                    'pending'   => ['bg' => 'rgba(234,179,8,0.15)', 'color' => '#fde68a', 'label' => 'Pending'],
                                    'suspended' => ['bg' => 'rgba(239,68,68,0.15)', 'color' => '#fca5a5', 'label' => 'Suspended'],
                                ][$member->status] ?? ['bg' => 'rgba(255,255,255,0.1)', 'color' => 'rgba(255,255,255,0.7)', 'label' => ucfirst($member->status ?? 'Unknown')];
                            @endphp

                            <div class="ms-avatar-lg">
                                @if($avatarUrl)
                                    <img src="{{ $avatarUrl }}" alt="">
                                @else
                                    {{ $initials }}
                                @endif
                            </div>
                            <h2 class="ms-sidebar-name">{{ $member->name }}</h2>
                            <div class="ms-sidebar-email">{{ $member->email }}</div>
                            <div>
                                <span class="ms-sidebar-badge" style="background:{{ $sc['bg'] }};color:{{ $sc['color'] }};">
                                    <i class="fas fa-circle" style="font-size:0.35rem;"></i> {{ $sc['label'] }}
                                </span>
                            </div>
                        </div>
                        <div class="ms-sidebar-body">
                            @if($member->phone || $member->mobile_no)
                                <div class="ms-info-row">
                                    <div class="ms-info-icon"><i class="fas fa-phone"></i></div>
                                    <div>
                                        <div class="ms-info-label">Phone</div>
                                        <div class="ms-info-value">{{ $member->phone ?? $member->mobile_no }}</div>
                                    </div>
                                </div>
                            @endif
                            @if($member->gender)
                                <div class="ms-info-row">
                                    <div class="ms-info-icon"><i class="fas fa-venus-mars"></i></div>
                                    <div>
                                        <div class="ms-info-label">Gender</div>
                                        <div class="ms-info-value">{{ ucfirst($member->gender) }}</div>
                                    </div>
                                </div>
                            @endif
                            @if($member->date_of_birth)
                                <div class="ms-info-row">
                                    <div class="ms-info-icon"><i class="fas fa-birthday-cake"></i></div>
                                    <div>
                                        <div class="ms-info-label">Date of Birth</div>
                                        <div class="ms-info-value">{{ $member->date_of_birth->format('d M Y') }}</div>
                                    </div>
                                </div>
                            @endif
                            @if($member->national_id)
                                <div class="ms-info-row">
                                    <div class="ms-info-icon"><i class="fas fa-id-card"></i></div>
                                    <div>
                                        <div class="ms-info-label">National ID</div>
                                        <div class="ms-info-value">{{ $member->national_id }}</div>
                                    </div>
                                </div>
                            @endif
                            <div class="ms-info-row">
                                <div class="ms-info-icon"><i class="fas fa-calendar-alt"></i></div>
                                <div>
                                    <div class="ms-info-label">Member Since</div>
                                    <div class="ms-info-value">{{ $member->created_at->format('d M Y') }}</div>
                                </div>
                            </div>
                            @if($member->guarantor)
                                <div class="ms-info-row">
                                    <div class="ms-info-icon"><i class="fas fa-user-shield"></i></div>
                                    <div>
                                        <div class="ms-info-label">Guarantor</div>
                                        <div class="ms-info-value">{{ $member->guarantor->name }}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Quick Stats --}}
                    <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:0.75rem;margin-top:1rem;">
                        <div class="ms-qstat">
                            <div class="ms-qstat-num" style="color:var(--ms-blue);">{{ $totalCircles }}</div>
                            <div class="ms-qstat-label">Circles</div>
                        </div>
                        <div class="ms-qstat">
                            <div class="ms-qstat-num" style="color:var(--ms-amber);">{{ $activeLoans }}</div>
                            <div class="ms-qstat-label">Active Loans</div>
                        </div>
                        <div class="ms-qstat">
                            <div class="ms-qstat-num" style="color:var(--ms-green);">K{{ number_format($totalShares, 0) }}</div>
                            <div class="ms-qstat-label">Total Shares</div>
                        </div>
                        <div class="ms-qstat">
                            <div class="ms-qstat-num" style="color:var(--ms-navy);">{{ $villageBankCount }}</div>
                            <div class="ms-qstat-label">Banks</div>
                        </div>
                    </div>
                </div>

                {{-- ═══════ Right Content ═══════ --}}
                <div class="ms-main">
                    {{-- Tabs --}}
                    <div class="ms-tabs">
                        <button class="ms-tab {{ $activeTab === 'overview' ? 'active' : '' }}" wire:click="switchTab('overview')">
                            <i class="fas fa-user"></i> Overview
                        </button>
                        <button class="ms-tab {{ $activeTab === 'employment' ? 'active' : '' }}" wire:click="switchTab('employment')">
                            <i class="fas fa-briefcase"></i> Employment
                        </button>
                        <button class="ms-tab {{ $activeTab === 'address' ? 'active' : '' }}" wire:click="switchTab('address')">
                            <i class="fas fa-map-marker-alt"></i> Address & NOK
                        </button>
                        <button class="ms-tab {{ $activeTab === 'circles' ? 'active' : '' }}" wire:click="switchTab('circles')">
                            <i class="fas fa-circle-notch"></i> Circles
                        </button>
                        <button class="ms-tab {{ $activeTab === 'loans' ? 'active' : '' }}" wire:click="switchTab('loans')">
                            <i class="fas fa-hand-holding-usd"></i> Loans
                        </button>
                        <button class="ms-tab {{ $activeTab === 'payments' ? 'active' : '' }}" wire:click="switchTab('payments')">
                            <i class="fas fa-credit-card"></i> Payment Methods
                        </button>
                        <button class="ms-tab {{ $activeTab === 'banks' ? 'active' : '' }}" wire:click="switchTab('banks')">
                            <i class="fas fa-university"></i> Village Banks
                        </button>
                    </div>

                    {{-- ═══════ Tab: Overview ═══════ --}}
                    @if($activeTab === 'overview')
                        <div class="ms-tab-body ms-animate">
                            <h4 class="ms-section-title">Personal Information</h4>
                            <div class="ms-detail-grid">
                                <div class="ms-detail-item">
                                    <div class="ms-detail-label">Full Name</div>
                                    <div class="ms-detail-value">{{ $member->name }}</div>
                                </div>
                                <div class="ms-detail-item">
                                    <div class="ms-detail-label">Username</div>
                                    <div class="ms-detail-value">{{ $member->username ?? '—' }}</div>
                                </div>
                                <div class="ms-detail-item">
                                    <div class="ms-detail-label">Email</div>
                                    <div class="ms-detail-value">{{ $member->email }}</div>
                                </div>
                                <div class="ms-detail-item">
                                    <div class="ms-detail-label">Phone</div>
                                    <div class="ms-detail-value">{{ $member->phone ?? $member->mobile_no ?? '—' }}</div>
                                </div>
                                <div class="ms-detail-item">
                                    <div class="ms-detail-label">Gender</div>
                                    <div class="ms-detail-value">{{ $member->gender ? ucfirst($member->gender) : '—' }}</div>
                                </div>
                                <div class="ms-detail-item">
                                    <div class="ms-detail-label">Date of Birth</div>
                                    <div class="ms-detail-value">{{ $member->date_of_birth ? $member->date_of_birth->format('d M Y') : '—' }}</div>
                                </div>
                                <div class="ms-detail-item">
                                    <div class="ms-detail-label">National ID</div>
                                    <div class="ms-detail-value">{{ $member->national_id ?? '—' }}</div>
                                </div>
                                <div class="ms-detail-item">
                                    <div class="ms-detail-label">Status</div>
                                    <div class="ms-detail-value">
                                        @php
                                            $sBadge = [
                                                'active'    => ['bg' => '#f0fdf4', 'color' => '#166534', 'border' => '#bbf7d0'],
                                                'pending'   => ['bg' => '#fffbeb', 'color' => '#92400e', 'border' => '#fde68a'],
                                                'suspended' => ['bg' => '#fef2f2', 'color' => '#991b1b', 'border' => '#fecaca'],
                                            ][$member->status] ?? ['bg' => '#f3f4f6', 'color' => '#374151', 'border' => '#e5e7eb'];
                                        @endphp
                                        <span class="ms-badge" style="background:{{ $sBadge['bg'] }};color:{{ $sBadge['color'] }};border:1px solid {{ $sBadge['border'] }};">
                                            {{ ucfirst($member->status ?? 'Unknown') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            @if($member->guarantor)
                                <h4 class="ms-section-title" style="margin-top:1.5rem;">Guarantor</h4>
                                <div class="ms-guarantor-card">
                                    @php
                                        $gParts = explode(' ', trim($member->guarantor->name ?? ''));
                                        $gInitials = strtoupper(substr($gParts[0], 0, 1) . (isset($gParts[1]) ? substr($gParts[1], 0, 1) : ''));
                                    @endphp
                                    <div class="ms-guarantor-avatar">{{ $gInitials }}</div>
                                    <div>
                                        <div style="font-weight:700;font-size:0.88rem;color:var(--ms-text);">{{ $member->guarantor->name }}</div>
                                        <div style="font-size:0.78rem;color:var(--ms-faint);">{{ $member->guarantor->email }}</div>
                                    </div>
                                </div>
                            @endif

                            @if($guarantees->count())
                                <h4 class="ms-section-title" style="margin-top:1.5rem;">Guarantees ({{ $guarantees->count() }})</h4>
                                <div style="display:flex;flex-wrap:wrap;gap:0.65rem;">
                                    @foreach($guarantees as $g)
                                        @php
                                            $gp = explode(' ', trim($g->name ?? ''));
                                            $gi = strtoupper(substr($gp[0], 0, 1) . (isset($gp[1]) ? substr($gp[1], 0, 1) : ''));
                                        @endphp
                                        <div class="ms-guarantor-card" style="flex:1;min-width:200px;">
                                            <div class="ms-guarantor-avatar">{{ $gi }}</div>
                                            <div>
                                                <div style="font-weight:700;font-size:0.85rem;color:var(--ms-text);">{{ $g->name }}</div>
                                                <div style="font-size:0.75rem;color:var(--ms-faint);">{{ $g->phone ?? $g->mobile_no ?? $g->email }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- ═══════ Tab: Employment ═══════ --}}
                    @if($activeTab === 'employment')
                        <div class="ms-tab-body ms-animate">
                            <h4 class="ms-section-title">Employment Details</h4>
                            <div class="ms-detail-grid">
                                <div class="ms-detail-item">
                                    <div class="ms-detail-label">Employment Status</div>
                                    <div class="ms-detail-value">{{ $member->employment_status ? ucfirst($member->employment_status) : '—' }}</div>
                                </div>
                                <div class="ms-detail-item">
                                    <div class="ms-detail-label">Job Title</div>
                                    <div class="ms-detail-value">{{ $member->job_title ?? '—' }}</div>
                                </div>
                                <div class="ms-detail-item">
                                    <div class="ms-detail-label">Company / Employer</div>
                                    <div class="ms-detail-value">{{ $member->company_name ?? '—' }}</div>
                                </div>
                                <div class="ms-detail-item">
                                    <div class="ms-detail-label">Company Location</div>
                                    <div class="ms-detail-value">{{ $member->company_location ?? '—' }}</div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- ═══════ Tab: Address & NOK ═══════ --}}
                    @if($activeTab === 'address')
                        <div class="ms-tab-body ms-animate">
                            <h4 class="ms-section-title">Address</h4>
                            <div class="ms-detail-grid">
                                <div class="ms-detail-item">
                                    <div class="ms-detail-label">Country</div>
                                    <div class="ms-detail-value">{{ $member->country ?? '—' }}</div>
                                </div>
                                <div class="ms-detail-item">
                                    <div class="ms-detail-label">Province / State</div>
                                    <div class="ms-detail-value">{{ $member->province ?? '—' }}</div>
                                </div>
                                <div class="ms-detail-item">
                                    <div class="ms-detail-label">City / Town</div>
                                    <div class="ms-detail-value">{{ $member->city ?? '—' }}</div>
                                </div>
                                <div class="ms-detail-item">
                                    <div class="ms-detail-label">Home Address</div>
                                    <div class="ms-detail-value">{{ $member->home_address ?? '—' }}</div>
                                </div>
                            </div>

                            <h4 class="ms-section-title" style="margin-top:1.75rem;">Next of Kin</h4>
                            <div class="ms-detail-grid">
                                <div class="ms-detail-item">
                                    <div class="ms-detail-label">Name</div>
                                    <div class="ms-detail-value">{{ $member->nok_name ?? '—' }}</div>
                                </div>
                                <div class="ms-detail-item">
                                    <div class="ms-detail-label">Relationship</div>
                                    <div class="ms-detail-value">{{ $member->nok_relationship ?? '—' }}</div>
                                </div>
                                <div class="ms-detail-item">
                                    <div class="ms-detail-label">Contact</div>
                                    <div class="ms-detail-value">{{ $member->nok_contact ?? '—' }}</div>
                                </div>
                                <div class="ms-detail-item">
                                    <div class="ms-detail-label">Address</div>
                                    <div class="ms-detail-value">{{ $member->nok_address ?? '—' }}</div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- ═══════ Tab: Circles ═══════ --}}
                    @if($activeTab === 'circles')
                        <div class="ms-tab-body ms-animate">
                            <h4 class="ms-section-title">Circles ({{ $circles->count() }})</h4>
                            @if($circles->count())
                                <table class="ms-subtable">
                                    <thead>
                                        <tr>
                                            <th>Circle Name</th>
                                            <th>Joined</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($circles as $circle)
                                            <tr>
                                                <td style="font-weight:600;">{{ $circle->name }}</td>
                                                <td style="color:var(--ms-faint);font-size:0.8rem;">
                                                    {{ $circle->pivot->joined_at ? \Carbon\Carbon::parse($circle->pivot->joined_at)->format('d M Y') : '—' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="ms-empty-section">
                                    <i class="fas fa-circle-notch"></i>
                                    <p>Not a member of any circles yet.</p>
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- ═══════ Tab: Loans ═══════ --}}
                    @if($activeTab === 'loans')
                        <div class="ms-tab-body ms-animate">
                            <h4 class="ms-section-title">Loans ({{ $loans->count() }})</h4>
                            @if($loans->count())
                                <table class="ms-subtable">
                                    <thead>
                                        <tr>
                                            <th>Amount</th>
                                            <th>Interest</th>
                                            <th>Status</th>
                                            <th>Requested</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($loans as $loan)
                                            @php
                                                $ls = [
                                                    'active'    => ['bg' => '#f0fdf4', 'color' => '#166534', 'border' => '#bbf7d0'],
                                                    'pending'   => ['bg' => '#fffbeb', 'color' => '#92400e', 'border' => '#fde68a'],
                                                    'approved'  => ['bg' => '#eff6ff', 'color' => '#1e40af', 'border' => '#bfdbfe'],
                                                    'rejected'  => ['bg' => '#fef2f2', 'color' => '#991b1b', 'border' => '#fecaca'],
                                                    'repaid'    => ['bg' => '#f0fdf4', 'color' => '#166534', 'border' => '#bbf7d0'],
                                                ][$loan->status] ?? ['bg' => '#f3f4f6', 'color' => '#374151', 'border' => '#e5e7eb'];
                                            @endphp
                                            <tr>
                                                <td style="font-weight:700;">K{{ number_format($loan->amount ?? 0, 2) }}</td>
                                                <td>{{ $loan->interest_rate ?? 0 }}%</td>
                                                <td>
                                                    <span class="ms-badge" style="background:{{ $ls['bg'] }};color:{{ $ls['color'] }};border:1px solid {{ $ls['border'] }};">
                                                        {{ ucfirst($loan->status) }}
                                                    </span>
                                                </td>
                                                <td style="color:var(--ms-faint);font-size:0.8rem;">{{ $loan->created_at->format('d M Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="ms-empty-section">
                                    <i class="fas fa-hand-holding-usd"></i>
                                    <p>No loan records found.</p>
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- ═══════ Tab: Payment Methods ═══════ --}}
                    @if($activeTab === 'payments')
                        <div class="ms-tab-body ms-animate">
                            <h4 class="ms-section-title">Payment Methods ({{ $paymentMethods->count() }})</h4>
                            @if($paymentMethods->count())
                                <table class="ms-subtable">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Provider</th>
                                            <th>Account</th>
                                            <th>Primary</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($paymentMethods as $pm)
                                            <tr>
                                                <td>
                                                    <span class="ms-badge" style="background:#f0f9ff;color:#0369a1;border:1px solid #bae6fd;">
                                                        <i class="fas {{ $pm->type === 'bank' ? 'fa-university' : 'fa-mobile-alt' }}" style="font-size:0.6rem;"></i>
                                                        {{ ucfirst($pm->type) }}
                                                    </span>
                                                </td>
                                                <td style="font-weight:600;">{{ $pm->provider }}</td>
                                                <td style="font-family:monospace;font-size:0.82rem;">{{ $pm->account_number }}</td>
                                                <td>
                                                    @if($pm->is_primary)
                                                        <span class="ms-badge" style="background:#fffbeb;color:#92400e;border:1px solid #fde68a;">
                                                            <i class="fas fa-star" style="font-size:0.5rem;"></i> Primary
                                                        </span>
                                                    @else
                                                        <span style="color:#d1d5db;">&mdash;</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        $ps = $pm->status === 'active'
                                                            ? ['bg' => '#f0fdf4', 'color' => '#166534', 'border' => '#bbf7d0']
                                                            : ['bg' => '#fef2f2', 'color' => '#991b1b', 'border' => '#fecaca'];
                                                    @endphp
                                                    <span class="ms-badge" style="background:{{ $ps['bg'] }};color:{{ $ps['color'] }};border:1px solid {{ $ps['border'] }};">
                                                        {{ ucfirst($pm->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="ms-empty-section">
                                    <i class="fas fa-credit-card"></i>
                                    <p>No payment methods added.</p>
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- ═══════ Tab: Village Banks ═══════ --}}
                    @if($activeTab === 'banks')
                        <div class="ms-tab-body ms-animate">
                            <h4 class="ms-section-title">Village Banks ({{ $villageBanks->count() }})</h4>
                            @if($villageBanks->count())
                                <table class="ms-subtable">
                                    <thead>
                                        <tr>
                                            <th>Bank Name</th>
                                            <th>Role</th>
                                            <th>Joined</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($villageBanks as $vb)
                                            <tr>
                                                <td style="font-weight:600;">{{ $vb->name }}</td>
                                                <td>
                                                    @php
                                                        $roleBadge = $vb->pivot->role === 'admin'
                                                            ? ['bg' => '#fffbeb', 'color' => '#92400e', 'border' => '#fde68a']
                                                            : ['bg' => '#f0f9ff', 'color' => '#0369a1', 'border' => '#bae6fd'];
                                                    @endphp
                                                    <span class="ms-badge" style="background:{{ $roleBadge['bg'] }};color:{{ $roleBadge['color'] }};border:1px solid {{ $roleBadge['border'] }};">
                                                        {{ ucfirst($vb->pivot->role ?? 'member') }}
                                                    </span>
                                                </td>
                                                <td style="color:var(--ms-faint);font-size:0.8rem;">
                                                    {{ $vb->pivot->joined_at ? \Carbon\Carbon::parse($vb->pivot->joined_at)->format('d M Y') : '—' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="ms-empty-section">
                                    <i class="fas fa-university"></i>
                                    <p>Not a member of any village banks.</p>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
