<div>
    @push('custom-styles')
    <style>
        :root {
            --ss-navy:#1E3A5F; --ss-navy-light:#2B6B96; --ss-amber:#D97706; --ss-amber-light:#F59E0B;
            --ss-bg:#f4f6fa; --ss-card:#fff; --ss-border:#edf0f7; --ss-text:#1e293b;
            --ss-muted:#64748b; --ss-faint:#94a3b8; --ss-green:#16a34a; --ss-red:#dc2626; --ss-blue:#2563eb; --ss-radius:16px;
        }
        .ss-page { background:var(--ss-bg); min-height:100vh; }

        /* Hero */
        .ss-hero {
            background:linear-gradient(135deg,var(--ss-navy) 0%,#234b78 50%,var(--ss-navy-light) 100%);
            padding:1.75rem 0 6rem; position:relative; overflow:hidden;
        }
        .ss-hero::before { content:''; position:absolute; width:600px; height:600px; top:-60%; right:-8%; background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
        .ss-hero-inner { position:relative; z-index:2; padding:0 1.5rem; }
        .ss-breadcrumb { display:flex; gap:.5rem; list-style:none; padding:0; margin:0; font-size:.82rem; }
        .ss-breadcrumb a { color:rgba(255,255,255,.55); text-decoration:none; }
        .ss-breadcrumb a:hover { color:rgba(255,255,255,.85); }
        .ss-breadcrumb .active { color:var(--ss-amber-light); font-weight:600; }
        .ss-breadcrumb .sep { color:rgba(255,255,255,.25); }
        .ss-back { display:inline-flex; align-items:center; gap:.35rem; color:rgba(255,255,255,.65); font-size:.82rem; font-weight:600; text-decoration:none; margin-bottom:.6rem; }
        .ss-back:hover { color:#fff; text-decoration:none; }

        /* Content */
        .ss-content { margin-top:-4.5rem; position:relative; z-index:10; padding:0 1.5rem 2rem; }

        /* Grid */
        .ss-grid { display:grid; grid-template-columns:320px 1fr; gap:1.25rem; align-items:start; }
        @media(max-width:992px){ .ss-grid { grid-template-columns:1fr; } }

        /* Sidebar */
        .ss-sidebar { background:var(--ss-card); border-radius:var(--ss-radius); border:1px solid var(--ss-border); box-shadow:0 2px 12px rgba(0,0,0,.04); overflow:hidden; }
        .ss-sidebar-header {
            background:linear-gradient(135deg,var(--ss-navy) 0%,var(--ss-navy-light) 100%);
            padding:1.5rem; text-align:center;
        }
        .ss-share-label { color:rgba(255,255,255,.5); font-size:.72rem; font-weight:600; letter-spacing:.5px; text-transform:uppercase; }
        .ss-share-amount { color:#fff; font-size:1.8rem; font-weight:800; margin:.25rem 0; }
        .ss-sidebar-badge {
            display:inline-flex; align-items:center; gap:.25rem; padding:.2rem .65rem; border-radius:8px;
            font-size:.7rem; font-weight:700;
        }
        .ss-sidebar-body { padding:1.25rem 1.5rem; }
        .ss-info-row { display:flex; align-items:flex-start; gap:.65rem; padding:.55rem 0; border-bottom:1px solid #f5f7fa; }
        .ss-info-row:last-child { border-bottom:none; }
        .ss-info-icon { width:32px; height:32px; border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:.7rem; flex-shrink:0; background:#f8fafc; color:var(--ss-muted); }
        .ss-info-label { font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--ss-faint); }
        .ss-info-value { font-size:.88rem; font-weight:600; color:var(--ss-text); margin-top:.05rem; }

        /* Progress cards */
        .ss-progress-cards { display:grid; grid-template-columns:1fr 1fr; gap:.75rem; margin-top:1rem; }
        .ss-pcard {
            background:var(--ss-card); border-radius:var(--ss-radius); border:1px solid var(--ss-border);
            box-shadow:0 2px 12px rgba(0,0,0,.04); padding:.85rem 1rem; text-align:center;
        }
        .ss-pcard-label { font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--ss-faint); }
        .ss-pcard-value { font-size:1.2rem; font-weight:800; margin:.15rem 0; }

        /* Main */
        .ss-main { background:var(--ss-card); border-radius:var(--ss-radius); border:1px solid var(--ss-border); box-shadow:0 2px 12px rgba(0,0,0,.04); overflow:hidden; }

        /* Tabs */
        .ss-tabs { display:flex; overflow-x:auto; border-bottom:2px solid var(--ss-border); scrollbar-width:none; }
        .ss-tabs::-webkit-scrollbar { display:none; }
        .ss-tab {
            display:flex; align-items:center; gap:.35rem; padding:.85rem 1.15rem; font-size:.8rem; font-weight:600;
            color:var(--ss-muted); border:none; background:none; cursor:pointer;
            border-bottom:2px solid transparent; margin-bottom:-2px; white-space:nowrap; transition:all .15s;
        }
        .ss-tab:hover { color:var(--ss-text); background:#fafbfd; }
        .ss-tab.active { color:var(--ss-amber); border-bottom-color:var(--ss-amber); }
        .ss-tab i { font-size:.72rem; }
        .ss-tab-count { background:rgba(217,119,6,.08); color:var(--ss-amber); font-size:.62rem; font-weight:700; padding:.1rem .4rem; border-radius:6px; margin-left:.15rem; }

        /* Tab body */
        .ss-tab-body { padding:1.25rem 1.5rem; }
        .ss-section-title { font-size:.92rem; font-weight:700; color:var(--ss-text); margin-bottom:.85rem; padding-bottom:.5rem; border-bottom:1px solid var(--ss-border); }

        /* Detail grid */
        .ss-detail-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:.75rem 1.5rem; }
        @media(max-width:576px){ .ss-detail-grid { grid-template-columns:1fr; } }
        .ss-detail-label { font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--ss-faint); }
        .ss-detail-value { font-size:.88rem; font-weight:600; color:var(--ss-text); margin-top:.05rem; }

        /* Sub-table */
        .ss-subtable { width:100%; border-collapse:collapse; }
        .ss-subtable thead th {
            font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--ss-faint);
            padding:.6rem .75rem; border-bottom:1px solid var(--ss-border); background:#fafbfd;
        }
        .ss-subtable tbody td { padding:.65rem .75rem; border-bottom:1px solid #f5f7fa; font-size:.84rem; vertical-align:middle; }
        .ss-subtable tbody tr:last-child td { border-bottom:none; }
        .ss-subtable tbody tr:hover { background:#fafbfd; }

        /* Badge */
        .ss-badge { display:inline-flex; align-items:center; gap:.2rem; padding:.15rem .55rem; border-radius:8px; font-size:.68rem; font-weight:700; }

        /* Avatar */
        .ss-avatar {
            width:32px; height:32px; border-radius:50%; display:flex; align-items:center; justify-content:center;
            font-weight:700; font-size:.65rem; flex-shrink:0;
            background:linear-gradient(135deg,var(--ss-navy),var(--ss-navy-light)); color:#fff;
        }
        .ss-avatar-lg { width:48px; height:48px; font-size:.9rem; }
        .ss-member-cell { display:flex; align-items:center; gap:.5rem; }

        /* Member card */
        .ss-member-card {
            display:flex; align-items:center; gap:.75rem; padding:.85rem 1rem;
            border-radius:12px; background:#f8fafc; border:1px solid var(--ss-border);
        }

        /* Stats row */
        .ss-overview-stats { display:grid; grid-template-columns:repeat(auto-fit,minmax(130px,1fr)); gap:.75rem; margin-bottom:1.25rem; }
        .ss-ostat {
            padding:.85rem; border-radius:12px; border:1px solid var(--ss-border); background:#fafbfd; text-align:center;
        }
        .ss-ostat-value { font-size:1.15rem; font-weight:800; margin-bottom:.1rem; }
        .ss-ostat-label { font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--ss-faint); }

        /* Empty */
        .ss-empty { text-align:center; padding:2rem 1rem; color:var(--ss-faint); }
        .ss-empty i { font-size:2rem; opacity:.15; display:block; margin-bottom:.5rem; }
        .ss-empty p { font-size:.84rem; color:var(--ss-muted); margin:0; }

        /* Highlight row */
        .ss-highlight { background:rgba(217,119,6,.04) !important; }

        @keyframes ssSlide { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
        .ss-animate { animation:ssSlide .3s ease; }
        @media(max-width:768px){ .ss-content{padding:0 .75rem 1.5rem;} }
    </style>
    @endpush

    @can('view-shares')
    <section class="content ss-page">
        {{-- Hero --}}
        <div class="ss-hero">
            <div class="ss-hero-inner container-fluid">
                <a href="{{ route('shares.index') }}" class="ss-back"><i class="fas fa-arrow-left"></i> Back to Shares</a>
                <ul class="ss-breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('shares.index') }}">Shares</a></li>
                    <li class="sep">/</li>
                    <li class="active">Declaration #{{ $declaration->id }}</li>
                </ul>
            </div>
        </div>

        {{-- Content --}}
        <div class="ss-content container-fluid">
            <div class="ss-grid ss-animate">
                {{-- Left Sidebar --}}
                <div>
                    <div class="ss-sidebar">
                        <div class="ss-sidebar-header">
                            <div class="ss-share-label">Share Declaration</div>
                            <div class="ss-share-amount">K{{ number_format($declaration->amount, 2) }}</div>
                            <span class="ss-sidebar-badge" style="background:rgba(22,163,74,.15);color:#86efac;">
                                <i class="fas fa-coins" style="font-size:.55rem;"></i> Declared
                            </span>
                        </div>

                        <div class="ss-sidebar-body">
                            {{-- Member --}}
                            <div class="ss-member-card" style="margin-bottom:.85rem;">
                                @php
                                    $parts = explode(' ', trim($declaration->user->name ?? ''));
                                    $initials = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
                                @endphp
                                <div class="ss-avatar ss-avatar-lg">{{ $initials }}</div>
                                <div>
                                    <div style="font-weight:700;font-size:.92rem;color:var(--ss-text);">{{ $declaration->user->name }}</div>
                                    <div style="font-size:.72rem;color:var(--ss-faint);">{{ $declaration->user->email }}</div>
                                </div>
                            </div>

                            <div class="ss-info-row">
                                <div class="ss-info-icon"><i class="fas fa-circle-notch"></i></div>
                                <div>
                                    <div class="ss-info-label">Circle</div>
                                    <div class="ss-info-value">{{ $declaration->month->circle->name ?? '--' }}</div>
                                </div>
                            </div>
                            <div class="ss-info-row">
                                <div class="ss-info-icon"><i class="fas fa-university"></i></div>
                                <div>
                                    <div class="ss-info-label">Village Bank</div>
                                    <div class="ss-info-value">{{ $declaration->month->circle->villageBank->name ?? '--' }}</div>
                                </div>
                            </div>
                            <div class="ss-info-row">
                                <div class="ss-info-icon"><i class="fas fa-calendar-alt"></i></div>
                                <div>
                                    <div class="ss-info-label">Month</div>
                                    <div class="ss-info-value">
                                        Month {{ $declaration->month->month_number ?? '--' }}
                                        <span style="font-size:.72rem;color:var(--ss-faint);font-weight:400;">
                                            ({{ $declaration->month->start_date ? $declaration->month->start_date->format('d M') : '' }}
                                            - {{ $declaration->month->end_date ? $declaration->month->end_date->format('d M') : '' }})
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @if ($insuranceContribution)
                                <div class="ss-info-row">
                                    <div class="ss-info-icon" style="background:rgba(217,119,6,.08);color:var(--ss-amber);"><i class="fas fa-shield-alt"></i></div>
                                    <div>
                                        <div class="ss-info-label">Insurance</div>
                                        <div class="ss-info-value" style="color:var(--ss-amber);">K{{ number_format($insuranceContribution->amount, 2) }}</div>
                                    </div>
                                </div>
                            @endif
                            <div class="ss-info-row">
                                <div class="ss-info-icon"><i class="fas fa-calendar-plus"></i></div>
                                <div>
                                    <div class="ss-info-label">Declared On</div>
                                    <div class="ss-info-value">{{ $declaration->created_at->format('d M Y, H:i') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Stats Cards --}}
                    <div class="ss-progress-cards">
                        <div class="ss-pcard">
                            <div class="ss-pcard-label">Rank</div>
                            <div class="ss-pcard-value" style="color:var(--ss-amber);">#{{ $memberShareRank }}</div>
                        </div>
                        <div class="ss-pcard">
                            <div class="ss-pcard-label">Declarations</div>
                            <div class="ss-pcard-value" style="color:var(--ss-navy);">{{ $memberDeclarationsCount }}</div>
                        </div>
                    </div>
                </div>

                {{-- Main Content --}}
                <div class="ss-main">
                    {{-- Tabs --}}
                    <div class="ss-tabs">
                        <button wire:click="switchTab('overview')" class="ss-tab {{ $activeTab === 'overview' ? 'active' : '' }}">
                            <i class="fas fa-info-circle"></i> Overview
                        </button>
                        <button wire:click="switchTab('history')" class="ss-tab {{ $activeTab === 'history' ? 'active' : '' }}">
                            <i class="fas fa-history"></i> Member History
                            <span class="ss-tab-count">{{ $memberDeclarationsCount }}</span>
                        </button>
                        <button wire:click="switchTab('month')" class="ss-tab {{ $activeTab === 'month' ? 'active' : '' }}">
                            <i class="fas fa-calendar-alt"></i> Month Summary
                            <span class="ss-tab-count">{{ $circleDeclarationsCount }}</span>
                        </button>
                    </div>

                    {{-- Tab: Overview --}}
                    @if ($activeTab === 'overview')
                        <div class="ss-tab-body">
                            {{-- Stats --}}
                            <div class="ss-overview-stats">
                                <div class="ss-ostat">
                                    <div class="ss-ostat-value" style="color:var(--ss-green);">K{{ number_format($declaration->amount, 2) }}</div>
                                    <div class="ss-ostat-label">This Share</div>
                                </div>
                                <div class="ss-ostat">
                                    <div class="ss-ostat-value" style="color:var(--ss-amber);">
                                        K{{ $insuranceContribution ? number_format($insuranceContribution->amount, 2) : '0.00' }}
                                    </div>
                                    <div class="ss-ostat-label">Insurance</div>
                                </div>
                                <div class="ss-ostat">
                                    <div class="ss-ostat-value" style="color:var(--ss-navy);">
                                        K{{ number_format($declaration->amount + ($insuranceContribution ? $insuranceContribution->amount : 0), 2) }}
                                    </div>
                                    <div class="ss-ostat-label">Total Contribution</div>
                                </div>
                                <div class="ss-ostat">
                                    <div class="ss-ostat-value" style="color:var(--ss-blue);">K{{ number_format($memberTotalShares, 2) }}</div>
                                    <div class="ss-ostat-label">All-Time Shares</div>
                                </div>
                            </div>

                            {{-- Declaration Details --}}
                            <div class="ss-section-title">Declaration Details</div>
                            <div class="ss-detail-grid" style="margin-bottom:1.5rem;">
                                <div>
                                    <div class="ss-detail-label">Member</div>
                                    <div class="ss-detail-value">{{ $declaration->user->name }}</div>
                                </div>
                                <div>
                                    <div class="ss-detail-label">Email</div>
                                    <div class="ss-detail-value">{{ $declaration->user->email }}</div>
                                </div>
                                <div>
                                    <div class="ss-detail-label">Circle</div>
                                    <div class="ss-detail-value">{{ $declaration->month->circle->name ?? '--' }}</div>
                                </div>
                                <div>
                                    <div class="ss-detail-label">Village Bank</div>
                                    <div class="ss-detail-value">{{ $declaration->month->circle->villageBank->name ?? '--' }}</div>
                                </div>
                                <div>
                                    <div class="ss-detail-label">Month</div>
                                    <div class="ss-detail-value">Month {{ $declaration->month->month_number ?? '--' }}</div>
                                </div>
                                <div>
                                    <div class="ss-detail-label">Month Period</div>
                                    <div class="ss-detail-value">
                                        {{ $declaration->month->start_date ? $declaration->month->start_date->format('d M Y') : '--' }}
                                        - {{ $declaration->month->end_date ? $declaration->month->end_date->format('d M Y') : '--' }}
                                    </div>
                                </div>
                                <div>
                                    <div class="ss-detail-label">Share Amount</div>
                                    <div class="ss-detail-value" style="color:var(--ss-green);">K{{ number_format($declaration->amount, 2) }}</div>
                                </div>
                                <div>
                                    <div class="ss-detail-label">Insurance</div>
                                    <div class="ss-detail-value" style="color:var(--ss-amber);">
                                        @if ($insuranceContribution)
                                            K{{ number_format($insuranceContribution->amount, 2) }}
                                            @if ($insuranceConfig)
                                                <span style="font-size:.72rem;color:var(--ss-faint);">
                                                    ({{ $insuranceConfig->type === 'fixed' ? 'fixed' : $insuranceConfig->value . '%' }})
                                                </span>
                                            @endif
                                        @else
                                            --
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <div class="ss-detail-label">Declared On</div>
                                    <div class="ss-detail-value">{{ $declaration->created_at->format('d M Y, H:i') }}</div>
                                </div>
                                <div>
                                    <div class="ss-detail-label">Last Updated</div>
                                    <div class="ss-detail-value">{{ $declaration->updated_at->format('d M Y, H:i') }}</div>
                                </div>
                            </div>

                            {{-- Month Context --}}
                            <div class="ss-section-title">Month Context</div>
                            <div class="ss-detail-grid">
                                <div>
                                    <div class="ss-detail-label">Total Declarations</div>
                                    <div class="ss-detail-value">{{ $circleDeclarationsCount }}</div>
                                </div>
                                <div>
                                    <div class="ss-detail-label">Month Total Shares</div>
                                    <div class="ss-detail-value">K{{ number_format($circleTotalShares, 2) }}</div>
                                </div>
                                <div>
                                    <div class="ss-detail-label">Average Share</div>
                                    <div class="ss-detail-value">K{{ $circleDeclarationsCount > 0 ? number_format($circleTotalShares / $circleDeclarationsCount, 2) : '0.00' }}</div>
                                </div>
                                <div>
                                    <div class="ss-detail-label">Member's Rank</div>
                                    <div class="ss-detail-value">#{{ $memberShareRank }} of {{ $circleDeclarationsCount }}</div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Tab: Member History --}}
                    @if ($activeTab === 'history')
                        <div class="ss-tab-body">
                            <div class="ss-section-title">{{ $declaration->user->name }}'s Share History in {{ $declaration->month->circle->name ?? 'Circle' }}</div>
                            @if ($memberHistory->count() > 0)
                                <table class="ss-subtable">
                                    <thead>
                                        <tr>
                                            <th>Month</th>
                                            <th>Period</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($memberHistory as $h)
                                            <tr class="{{ $h->id === $declaration->id ? 'ss-highlight' : '' }}">
                                                <td style="font-weight:700;">Month {{ $h->month->month_number ?? '--' }}</td>
                                                <td style="font-size:.82rem;color:var(--ss-muted);">
                                                    {{ $h->month->start_date ? $h->month->start_date->format('d M') : '' }}
                                                    - {{ $h->month->end_date ? $h->month->end_date->format('d M Y') : '' }}
                                                </td>
                                                <td>
                                                    <span style="font-weight:700;color:var(--ss-green);">K{{ number_format($h->amount, 2) }}</span>
                                                    @if ($h->id === $declaration->id)
                                                        <span class="ss-badge" style="background:rgba(217,119,6,.08);color:var(--ss-amber);border:1px solid rgba(217,119,6,.2);margin-left:.3rem;">Current</span>
                                                    @endif
                                                </td>
                                                <td style="font-size:.78rem;color:var(--ss-faint);">{{ $h->created_at->format('d M Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr style="background:#fafbfd;">
                                            <td colspan="2" style="text-align:right;font-weight:700;font-size:.84rem;padding:.65rem .75rem;border-top:2px solid var(--ss-border);">Total:</td>
                                            <td colspan="2" style="font-weight:800;color:var(--ss-green);font-size:.92rem;padding:.65rem .75rem;border-top:2px solid var(--ss-border);">
                                                K{{ number_format($memberTotalShares, 2) }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            @else
                                <div class="ss-empty">
                                    <i class="fas fa-history"></i>
                                    <p>No other declarations found for this member.</p>
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- Tab: Month Summary --}}
                    @if ($activeTab === 'month')
                        <div class="ss-tab-body">
                            <div class="ss-section-title">
                                Month {{ $declaration->month->month_number ?? '--' }} - All Declarations ({{ $circleDeclarationsCount }})
                            </div>
                            @if ($monthDeclarations->count() > 0)
                                <table class="ss-subtable">
                                    <thead>
                                        <tr>
                                            <th style="width:40px;">#</th>
                                            <th>Member</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($monthDeclarations as $idx => $md)
                                            <tr class="{{ $md->id === $declaration->id ? 'ss-highlight' : '' }}">
                                                <td style="font-size:.78rem;color:var(--ss-faint);font-weight:700;">{{ $idx + 1 }}</td>
                                                <td>
                                                    <div class="ss-member-cell">
                                                        @php
                                                            $mp = explode(' ', trim($md->user->name ?? ''));
                                                            $mi = strtoupper(substr($mp[0], 0, 1) . (isset($mp[1]) ? substr($mp[1], 0, 1) : ''));
                                                        @endphp
                                                        <div class="ss-avatar">{{ $mi }}</div>
                                                        <div>
                                                            <span style="font-weight:700;font-size:.84rem;">{{ $md->user->name ?? '--' }}</span>
                                                            @if ($md->id === $declaration->id)
                                                                <span class="ss-badge" style="background:rgba(217,119,6,.08);color:var(--ss-amber);border:1px solid rgba(217,119,6,.2);margin-left:.3rem;font-size:.6rem;">You</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><span style="font-weight:700;color:var(--ss-green);">K{{ number_format($md->amount, 2) }}</span></td>
                                                <td style="font-size:.78rem;color:var(--ss-faint);">{{ $md->created_at->format('d M Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr style="background:#fafbfd;">
                                            <td colspan="2" style="text-align:right;font-weight:700;font-size:.84rem;padding:.65rem .75rem;border-top:2px solid var(--ss-border);">Total:</td>
                                            <td colspan="2" style="font-weight:800;color:var(--ss-green);font-size:.92rem;padding:.65rem .75rem;border-top:2px solid var(--ss-border);">
                                                K{{ number_format($circleTotalShares, 2) }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            @else
                                <div class="ss-empty">
                                    <i class="fas fa-calendar-alt"></i>
                                    <p>No declarations for this month yet.</p>
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
