<div>
    @push('custom-styles')
    <style>
        :root {
            --cs-navy:#1E3A5F; --cs-navy-light:#2B6B96; --cs-amber:#D97706; --cs-amber-light:#F59E0B;
            --cs-bg:#f4f6fa; --cs-card:#fff; --cs-border:#edf0f7; --cs-text:#1e293b;
            --cs-muted:#64748b; --cs-faint:#94a3b8; --cs-green:#16a34a; --cs-red:#dc2626; --cs-blue:#2563eb; --cs-radius:16px;
        }
        .cs-page { background:var(--cs-bg); min-height:100vh; }

        /* Hero */
        .cs-hero {
            background:linear-gradient(135deg,var(--cs-navy) 0%,#234b78 50%,var(--cs-navy-light) 100%);
            padding:1.75rem 0 6rem; position:relative; overflow:hidden;
        }
        .cs-hero::before { content:''; position:absolute; width:600px; height:600px; top:-60%; right:-8%; background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
        .cs-hero-inner { position:relative; z-index:2; padding:0 1.5rem; }
        .cs-breadcrumb { display:flex; gap:.5rem; list-style:none; padding:0; margin:0; font-size:.82rem; }
        .cs-breadcrumb a { color:rgba(255,255,255,.55); text-decoration:none; }
        .cs-breadcrumb a:hover { color:rgba(255,255,255,.85); }
        .cs-breadcrumb .active { color:var(--cs-amber-light); font-weight:600; }
        .cs-breadcrumb .sep { color:rgba(255,255,255,.25); }
        .cs-back { display:inline-flex; align-items:center; gap:.35rem; color:rgba(255,255,255,.65); font-size:.82rem; font-weight:600; text-decoration:none; margin-bottom:.6rem; }
        .cs-back:hover { color:#fff; text-decoration:none; }

        /* Content */
        .cs-content { margin-top:-4.5rem; position:relative; z-index:10; padding:0 1.5rem 2rem; }

        /* Grid */
        .cs-grid { display:grid; grid-template-columns:320px 1fr; gap:1.25rem; align-items:start; }
        @media(max-width:992px){ .cs-grid { grid-template-columns:1fr; } }

        /* Sidebar */
        .cs-sidebar { background:var(--cs-card); border-radius:var(--cs-radius); border:1px solid var(--cs-border); box-shadow:0 2px 12px rgba(0,0,0,.04); overflow:hidden; }
        .cs-sidebar-header {
            background:linear-gradient(135deg,var(--cs-navy) 0%,var(--cs-navy-light) 100%);
            padding:1.5rem; text-align:center;
        }
        .cs-circle-label { color:rgba(255,255,255,.5); font-size:.72rem; font-weight:600; letter-spacing:.5px; text-transform:uppercase; }
        .cs-circle-name { color:#fff; font-size:1.35rem; font-weight:800; margin:.25rem 0; line-height:1.2; }
        .cs-sidebar-badge {
            display:inline-flex; align-items:center; gap:.25rem; padding:.2rem .65rem; border-radius:8px;
            font-size:.7rem; font-weight:700;
        }
        .cs-sidebar-body { padding:1.25rem 1.5rem; }
        .cs-info-row { display:flex; align-items:flex-start; gap:.65rem; padding:.55rem 0; border-bottom:1px solid #f5f7fa; }
        .cs-info-row:last-child { border-bottom:none; }
        .cs-info-icon { width:32px; height:32px; border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:.7rem; flex-shrink:0; background:#f8fafc; color:var(--cs-muted); }
        .cs-info-label { font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--cs-faint); }
        .cs-info-value { font-size:.88rem; font-weight:600; color:var(--cs-text); margin-top:.05rem; }

        /* Progress cards */
        .cs-progress-cards { display:grid; grid-template-columns:1fr 1fr; gap:.75rem; margin-top:1rem; }
        .cs-pcard {
            background:var(--cs-card); border-radius:var(--cs-radius); border:1px solid var(--cs-border);
            box-shadow:0 2px 12px rgba(0,0,0,.04); padding:.85rem 1rem; text-align:center;
        }
        .cs-pcard-label { font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--cs-faint); }
        .cs-pcard-value { font-size:1.2rem; font-weight:800; margin:.15rem 0; }
        .cs-pcard-bar { height:6px; border-radius:6px; background:#e2e8f0; overflow:hidden; margin-top:.35rem; }
        .cs-pcard-fill { height:100%; border-radius:6px; transition:width .3s; }
        .cs-pcard-pct { font-size:.68rem; color:var(--cs-faint); font-weight:600; margin-top:.2rem; }

        /* Quick actions */
        .cs-quick-actions { display:flex; flex-direction:column; gap:.5rem; margin-top:1rem; }
        .cs-quick-btn {
            display:flex; align-items:center; gap:.5rem; padding:.55rem .85rem; border-radius:10px;
            font-size:.8rem; font-weight:600; text-decoration:none; transition:all .15s;
            border:1px solid var(--cs-border); background:#fafbfd; color:var(--cs-text);
        }
        .cs-quick-btn:hover { border-color:var(--cs-amber); color:var(--cs-amber); background:rgba(217,119,6,.04); text-decoration:none; }
        .cs-quick-btn i { width:20px; text-align:center; font-size:.72rem; color:var(--cs-muted); }

        /* Main */
        .cs-main { background:var(--cs-card); border-radius:var(--cs-radius); border:1px solid var(--cs-border); box-shadow:0 2px 12px rgba(0,0,0,.04); overflow:hidden; }

        /* Tabs */
        .cs-tabs { display:flex; overflow-x:auto; border-bottom:2px solid var(--cs-border); scrollbar-width:none; }
        .cs-tabs::-webkit-scrollbar { display:none; }
        .cs-tab {
            display:flex; align-items:center; gap:.35rem; padding:.85rem 1.15rem; font-size:.8rem; font-weight:600;
            color:var(--cs-muted); border:none; background:none; cursor:pointer;
            border-bottom:2px solid transparent; margin-bottom:-2px; white-space:nowrap; transition:all .15s;
        }
        .cs-tab:hover { color:var(--cs-text); background:#fafbfd; }
        .cs-tab.active { color:var(--cs-amber); border-bottom-color:var(--cs-amber); }
        .cs-tab i { font-size:.72rem; }
        .cs-tab-count { background:rgba(217,119,6,.08); color:var(--cs-amber); font-size:.62rem; font-weight:700; padding:.1rem .4rem; border-radius:6px; margin-left:.15rem; }

        /* Tab body */
        .cs-tab-body { padding:1.25rem 1.5rem; }
        .cs-section-title { font-size:.92rem; font-weight:700; color:var(--cs-text); margin-bottom:.85rem; padding-bottom:.5rem; border-bottom:1px solid var(--cs-border); }

        /* Detail grid */
        .cs-detail-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:.75rem 1.5rem; }
        @media(max-width:576px){ .cs-detail-grid { grid-template-columns:1fr; } }
        .cs-detail-label { font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--cs-faint); }
        .cs-detail-value { font-size:.88rem; font-weight:600; color:var(--cs-text); margin-top:.05rem; }

        /* Sub-table */
        .cs-subtable { width:100%; border-collapse:collapse; }
        .cs-subtable thead th {
            font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--cs-faint);
            padding:.6rem .75rem; border-bottom:1px solid var(--cs-border); background:#fafbfd;
        }
        .cs-subtable tbody td { padding:.65rem .75rem; border-bottom:1px solid #f5f7fa; font-size:.84rem; vertical-align:middle; }
        .cs-subtable tbody tr:last-child td { border-bottom:none; }
        .cs-subtable tbody tr:hover { background:#fafbfd; }

        /* Badge */
        .cs-badge { display:inline-flex; align-items:center; gap:.2rem; padding:.15rem .55rem; border-radius:8px; font-size:.68rem; font-weight:700; }
        .cs-badge-draft { background:#f1f5f9; color:#475569; border:1px solid #cbd5e1; }
        .cs-badge-active { background:rgba(37,99,235,.08); color:#1e40af; border:1px solid #bfdbfe; }
        .cs-badge-completed { background:rgba(22,163,74,.08); color:#166534; border:1px solid #bbf7d0; }
        .cs-badge-pending { background:rgba(234,179,8,.08); color:#92400e; border:1px solid #fde68a; }
        .cs-badge-approved { background:rgba(37,99,235,.08); color:#1e40af; border:1px solid #bfdbfe; }

        /* Avatar */
        .cs-avatar {
            width:32px; height:32px; border-radius:50%; display:flex; align-items:center; justify-content:center;
            font-weight:700; font-size:.65rem; flex-shrink:0;
            background:linear-gradient(135deg,var(--cs-navy),var(--cs-navy-light)); color:#fff;
        }
        .cs-member-cell { display:flex; align-items:center; gap:.5rem; }

        /* Empty */
        .cs-empty { text-align:center; padding:2rem 1rem; color:var(--cs-faint); }
        .cs-empty i { font-size:2rem; opacity:.15; display:block; margin-bottom:.5rem; }
        .cs-empty p { font-size:.84rem; color:var(--cs-muted); margin:0; }

        /* Lifecycle */
        .cs-lifecycle { display:flex; align-items:center; gap:.5rem; flex-wrap:wrap; margin-top:.75rem; }
        .cs-lifecycle-step {
            padding:.35rem .85rem; border-radius:8px; font-size:.72rem; font-weight:700;
            position:relative;
        }
        .cs-lifecycle-step.current { box-shadow:0 0 0 2px var(--cs-amber); }
        .cs-lifecycle-arrow { color:var(--cs-faint); font-size:.7rem; }

        /* Stats row */
        .cs-overview-stats { display:grid; grid-template-columns:repeat(auto-fit,minmax(130px,1fr)); gap:.75rem; margin-bottom:1.25rem; }
        .cs-ostat {
            padding:.85rem; border-radius:12px; border:1px solid var(--cs-border); background:#fafbfd; text-align:center;
        }
        .cs-ostat-value { font-size:1.15rem; font-weight:800; margin-bottom:.1rem; }
        .cs-ostat-label { font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--cs-faint); }

        @keyframes csSlide { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
        .cs-animate { animation:csSlide .3s ease; }
        @media(max-width:768px){ .cs-content{padding:0 .75rem 1.5rem;} }
    </style>
    @endpush

    @can('view-circles')
    <section class="content cs-page">
        {{-- Hero --}}
        <div class="cs-hero">
            <div class="cs-hero-inner container-fluid">
                <a href="{{ route('circles.index') }}" class="cs-back"><i class="fas fa-arrow-left"></i> Back to Circles</a>
                <ul class="cs-breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('circles.index') }}">Circles</a></li>
                    <li class="sep">/</li>
                    <li class="active">{{ $circle->name }}</li>
                </ul>
            </div>
        </div>

        {{-- Content --}}
        <div class="cs-content container-fluid">
            <div class="cs-grid cs-animate">
                {{-- Left Sidebar --}}
                <div>
                    <div class="cs-sidebar">
                        <div class="cs-sidebar-header">
                            <div class="cs-circle-label">Circle</div>
                            <div class="cs-circle-name">{{ $circle->name }}</div>
                            @php
                                $sc = [
                                    'draft'     => ['bg'=>'rgba(255,255,255,.12)','color'=>'#cbd5e1'],
                                    'active'    => ['bg'=>'rgba(37,99,235,.15)','color'=>'#93c5fd'],
                                    'completed' => ['bg'=>'rgba(34,197,94,.15)','color'=>'#86efac'],
                                ];
                                $scc = $sc[$circle->status] ?? ['bg'=>'rgba(255,255,255,.12)','color'=>'#cbd5e1'];
                            @endphp
                            <span class="cs-sidebar-badge" style="background:{{ $scc['bg'] }};color:{{ $scc['color'] }};">
                                {{ ucfirst($circle->status) }}
                            </span>
                        </div>

                        <div class="cs-sidebar-body">
                            <div class="cs-info-row">
                                <div class="cs-info-icon"><i class="fas fa-university"></i></div>
                                <div>
                                    <div class="cs-info-label">Village Bank</div>
                                    <div class="cs-info-value">{{ $circle->villageBank->name ?? '--' }}</div>
                                </div>
                            </div>
                            <div class="cs-info-row">
                                <div class="cs-info-icon"><i class="fas fa-clock"></i></div>
                                <div>
                                    <div class="cs-info-label">Duration</div>
                                    <div class="cs-info-value">{{ $circle->duration_months }} {{ Str::plural('month', $circle->duration_months) }}</div>
                                </div>
                            </div>
                            <div class="cs-info-row">
                                <div class="cs-info-icon"><i class="fas fa-calendar-alt"></i></div>
                                <div>
                                    <div class="cs-info-label">Start Date</div>
                                    <div class="cs-info-value">{{ $circle->start_date->format('d M Y') }}</div>
                                </div>
                            </div>
                            <div class="cs-info-row">
                                <div class="cs-info-icon"><i class="fas fa-calendar-check"></i></div>
                                <div>
                                    <div class="cs-info-label">End Date</div>
                                    <div class="cs-info-value">{{ $circle->end_date ? $circle->end_date->format('d M Y') : '--' }}</div>
                                </div>
                            </div>
                            <div class="cs-info-row">
                                <div class="cs-info-icon"><i class="fas fa-user"></i></div>
                                <div>
                                    <div class="cs-info-label">Created By</div>
                                    <div class="cs-info-value">{{ $circle->creator->name ?? '--' }}</div>
                                </div>
                            </div>
                            <div class="cs-info-row">
                                <div class="cs-info-icon"><i class="fas fa-calendar-plus"></i></div>
                                <div>
                                    <div class="cs-info-label">Created</div>
                                    <div class="cs-info-value">{{ $circle->created_at->format('d M Y') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Progress Cards --}}
                    <div class="cs-progress-cards">
                        <div class="cs-pcard">
                            <div class="cs-pcard-label">Duration</div>
                            <div class="cs-pcard-value" style="color:var(--cs-navy);">{{ round($durationProgress) }}%</div>
                            <div class="cs-pcard-bar">
                                <div class="cs-pcard-fill" style="width:{{ $durationProgress }}%;background:linear-gradient(90deg,var(--cs-navy),var(--cs-navy-light));"></div>
                            </div>
                            <div class="cs-pcard-pct">Time elapsed</div>
                        </div>
                        <div class="cs-pcard">
                            <div class="cs-pcard-label">Months</div>
                            <div class="cs-pcard-value" style="color:var(--cs-amber);">{{ $totalMonths }}/{{ $circle->duration_months }}</div>
                            <div class="cs-pcard-bar">
                                <div class="cs-pcard-fill" style="width:{{ $circle->duration_months > 0 ? min(100, ($totalMonths/$circle->duration_months)*100) : 0 }}%;background:linear-gradient(90deg,var(--cs-amber),var(--cs-amber-light));"></div>
                            </div>
                            <div class="cs-pcard-pct">Created</div>
                        </div>
                    </div>

                    {{-- Quick Actions --}}
                    <div class="cs-quick-actions">
                        <a href="{{ route('circles.members', $circle->id) }}" class="cs-quick-btn">
                            <i class="fas fa-users"></i> Manage Members
                        </a>
                        @if ($circle->status === 'active')
                            <a href="{{ route('months.index', $circle->id) }}" class="cs-quick-btn">
                                <i class="fas fa-calendar-alt"></i> View Monthly Cycles
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Main Content --}}
                <div class="cs-main">
                    {{-- Tabs --}}
                    <div class="cs-tabs">
                        <button wire:click="switchTab('overview')" class="cs-tab {{ $activeTab === 'overview' ? 'active' : '' }}">
                            <i class="fas fa-info-circle"></i> Overview
                        </button>
                        <button wire:click="switchTab('members')" class="cs-tab {{ $activeTab === 'members' ? 'active' : '' }}">
                            <i class="fas fa-users"></i> Members
                            <span class="cs-tab-count">{{ $totalMembers }}</span>
                        </button>
                        <button wire:click="switchTab('months')" class="cs-tab {{ $activeTab === 'months' ? 'active' : '' }}">
                            <i class="fas fa-calendar-alt"></i> Monthly Cycles
                            <span class="cs-tab-count">{{ $totalMonths }}</span>
                        </button>
                        <button wire:click="switchTab('loans')" class="cs-tab {{ $activeTab === 'loans' ? 'active' : '' }}">
                            <i class="fas fa-hand-holding-usd"></i> Loans
                            <span class="cs-tab-count">{{ $totalLoans }}</span>
                        </button>
                    </div>

                    {{-- Tab: Overview --}}
                    @if ($activeTab === 'overview')
                        <div class="cs-tab-body">
                            {{-- Stats --}}
                            <div class="cs-overview-stats">
                                <div class="cs-ostat">
                                    <div class="cs-ostat-value" style="color:var(--cs-navy);">{{ $totalMembers }}</div>
                                    <div class="cs-ostat-label">Members</div>
                                </div>
                                <div class="cs-ostat">
                                    <div class="cs-ostat-value" style="color:var(--cs-amber);">{{ $totalMonths }}</div>
                                    <div class="cs-ostat-label">Months</div>
                                </div>
                                <div class="cs-ostat">
                                    <div class="cs-ostat-value" style="color:var(--cs-blue);">{{ $totalLoans }}</div>
                                    <div class="cs-ostat-label">Total Loans</div>
                                </div>
                                <div class="cs-ostat">
                                    <div class="cs-ostat-value" style="color:var(--cs-green);">K{{ number_format($totalLoanAmount, 2) }}</div>
                                    <div class="cs-ostat-label">Loan Amount</div>
                                </div>
                            </div>

                            {{-- Circle Details --}}
                            <div class="cs-section-title">Circle Information</div>
                            <div class="cs-detail-grid" style="margin-bottom:1.5rem;">
                                <div>
                                    <div class="cs-detail-label">Circle Name</div>
                                    <div class="cs-detail-value">{{ $circle->name }}</div>
                                </div>
                                <div>
                                    <div class="cs-detail-label">Village Bank</div>
                                    <div class="cs-detail-value">{{ $circle->villageBank->name ?? '--' }}</div>
                                </div>
                                <div>
                                    <div class="cs-detail-label">Duration</div>
                                    <div class="cs-detail-value">{{ $circle->duration_months }} {{ Str::plural('month', $circle->duration_months) }}</div>
                                </div>
                                <div>
                                    <div class="cs-detail-label">Status</div>
                                    <div class="cs-detail-value">
                                        <span class="cs-badge cs-badge-{{ $circle->status }}">{{ ucfirst($circle->status) }}</span>
                                    </div>
                                </div>
                                <div>
                                    <div class="cs-detail-label">Start Date</div>
                                    <div class="cs-detail-value">{{ $circle->start_date->format('d M Y') }}</div>
                                </div>
                                <div>
                                    <div class="cs-detail-label">End Date</div>
                                    <div class="cs-detail-value">{{ $circle->end_date ? $circle->end_date->format('d M Y') : '--' }}</div>
                                </div>
                                <div>
                                    <div class="cs-detail-label">Created By</div>
                                    <div class="cs-detail-value">{{ $circle->creator->name ?? '--' }}</div>
                                </div>
                                <div>
                                    <div class="cs-detail-label">Created At</div>
                                    <div class="cs-detail-value">{{ $circle->created_at->format('d M Y, H:i') }}</div>
                                </div>
                            </div>

                            {{-- Lifecycle --}}
                            <div class="cs-section-title">Circle Lifecycle</div>
                            <div class="cs-lifecycle">
                                <span class="cs-lifecycle-step {{ $circle->status === 'draft' ? 'current' : '' }}" style="background:#f1f5f9;color:#475569;">
                                    <i class="fas fa-pencil-alt" style="font-size:.6rem;margin-right:.2rem;"></i> Draft
                                </span>
                                <i class="fas fa-arrow-right cs-lifecycle-arrow"></i>
                                <span class="cs-lifecycle-step {{ $circle->status === 'active' ? 'current' : '' }}" style="background:rgba(37,99,235,.08);color:#1e40af;">
                                    <i class="fas fa-play" style="font-size:.6rem;margin-right:.2rem;"></i> Active
                                </span>
                                <i class="fas fa-arrow-right cs-lifecycle-arrow"></i>
                                <span class="cs-lifecycle-step {{ $circle->status === 'completed' ? 'current' : '' }}" style="background:rgba(22,163,74,.08);color:#166534;">
                                    <i class="fas fa-check" style="font-size:.6rem;margin-right:.2rem;"></i> Completed
                                </span>
                            </div>

                            {{-- Loan Summary --}}
                            @if ($totalLoans > 0)
                                <div class="cs-section-title" style="margin-top:1.5rem;">Loan Summary</div>
                                <div class="cs-detail-grid">
                                    <div>
                                        <div class="cs-detail-label">Total Loans</div>
                                        <div class="cs-detail-value">{{ $totalLoans }}</div>
                                    </div>
                                    <div>
                                        <div class="cs-detail-label">Total Amount</div>
                                        <div class="cs-detail-value">K{{ number_format($totalLoanAmount, 2) }}</div>
                                    </div>
                                    <div>
                                        <div class="cs-detail-label">Active Loans</div>
                                        <div class="cs-detail-value" style="color:var(--cs-blue);">{{ $activeLoans }}</div>
                                    </div>
                                    <div>
                                        <div class="cs-detail-label">Completed Loans</div>
                                        <div class="cs-detail-value" style="color:var(--cs-green);">{{ $completedLoans }}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- Tab: Members --}}
                    @if ($activeTab === 'members')
                        <div class="cs-tab-body">
                            <div class="cs-section-title">Circle Members ({{ $totalMembers }})</div>
                            @if ($members->count() > 0)
                                <table class="cs-subtable">
                                    <thead>
                                        <tr>
                                            <th>Member</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Joined</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($members as $m)
                                            <tr>
                                                <td>
                                                    <div class="cs-member-cell">
                                                        @php
                                                            $parts = explode(' ', trim($m->name ?? ''));
                                                            $initials = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
                                                        @endphp
                                                        <div class="cs-avatar">{{ $initials }}</div>
                                                        <div>
                                                            <div style="font-weight:700;font-size:.86rem;">{{ $m->name }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="color:var(--cs-muted);">{{ $m->email }}</td>
                                                <td style="color:var(--cs-muted);">{{ $m->phone ?? '--' }}</td>
                                                <td style="font-size:.78rem;color:var(--cs-faint);">
                                                    {{ $m->pivot->joined_at ? \Carbon\Carbon::parse($m->pivot->joined_at)->format('d M Y') : '--' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="cs-empty">
                                    <i class="fas fa-users"></i>
                                    <p>No members enrolled in this circle yet.</p>
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- Tab: Monthly Cycles --}}
                    @if ($activeTab === 'months')
                        <div class="cs-tab-body">
                            <div class="cs-section-title">Monthly Cycles ({{ $totalMonths }})</div>
                            @if ($months->count() > 0)
                                <table class="cs-subtable">
                                    <thead>
                                        <tr>
                                            <th>Month</th>
                                            <th>Start</th>
                                            <th>End</th>
                                            <th>Status</th>
                                            <th>Loans</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($months as $month)
                                            <tr>
                                                <td style="font-weight:700;">{{ $month->name ?? 'Month #' . $month->id }}</td>
                                                <td style="font-size:.82rem;">{{ $month->start_date ? $month->start_date->format('d M Y') : '--' }}</td>
                                                <td style="font-size:.82rem;color:var(--cs-muted);">{{ $month->end_date ? $month->end_date->format('d M Y') : '--' }}</td>
                                                <td>
                                                    <span class="cs-badge cs-badge-{{ $month->status ?? 'draft' }}">
                                                        {{ ucfirst($month->status ?? 'draft') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span style="font-weight:600;">{{ $month->loans->count() }}</span>
                                                    <span style="font-size:.72rem;color:var(--cs-faint);">loans</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="cs-empty">
                                    <i class="fas fa-calendar-alt"></i>
                                    <p>No monthly cycles created yet. Activate the circle to begin.</p>
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- Tab: Loans --}}
                    @if ($activeTab === 'loans')
                        <div class="cs-tab-body">
                            <div class="cs-section-title">All Loans ({{ $totalLoans }})</div>
                            @if ($allLoans->count() > 0)
                                <table class="cs-subtable">
                                    <thead>
                                        <tr>
                                            <th>Borrower</th>
                                            <th>Month</th>
                                            <th>Amount</th>
                                            <th>Interest</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allLoans as $loan)
                                            <tr>
                                                <td>
                                                    <div class="cs-member-cell">
                                                        @php
                                                            $lp = explode(' ', trim($loan->borrower->name ?? ''));
                                                            $li = strtoupper(substr($lp[0], 0, 1) . (isset($lp[1]) ? substr($lp[1], 0, 1) : ''));
                                                        @endphp
                                                        <div class="cs-avatar">{{ $li }}</div>
                                                        <span style="font-weight:600;">{{ $loan->borrower->name ?? '--' }}</span>
                                                    </div>
                                                </td>
                                                <td style="font-size:.82rem;color:var(--cs-muted);">{{ $loan->month_name ?? '--' }}</td>
                                                <td style="font-weight:700;">K{{ number_format($loan->amount, 2) }}</td>
                                                <td style="color:var(--cs-muted);">{{ $loan->interest_rate ?? 0 }}%</td>
                                                <td>
                                                    @php
                                                        $loanStatus = $loan->status ?? 'pending';
                                                        $lsBadge = 'cs-badge-' . $loanStatus;
                                                    @endphp
                                                    <span class="cs-badge {{ $lsBadge }}">{{ ucfirst($loanStatus) }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="cs-empty">
                                    <i class="fas fa-hand-holding-usd"></i>
                                    <p>No loans have been issued in this circle yet.</p>
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
