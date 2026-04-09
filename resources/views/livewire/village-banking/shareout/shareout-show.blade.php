<div>
    @push('custom-styles')
    <style>
        :root {
            --ss-navy:#1E3A5F;--ss-navy-light:#2B6B96;--ss-amber:#D97706;--ss-amber-light:#F59E0B;
            --ss-bg:#f4f6fa;--ss-card:#fff;--ss-border:#edf0f7;--ss-text:#1e293b;
            --ss-muted:#64748b;--ss-faint:#94a3b8;--ss-green:#16a34a;--ss-red:#dc2626;--ss-blue:#2563eb;--ss-purple:#7c3aed;--ss-radius:16px;
        }
        .ss-page{background:var(--ss-bg);min-height:100vh;}

        /* ── Hero ─────────────────── */
        .ss-hero{background:linear-gradient(135deg,var(--ss-navy) 0%,#234b78 50%,var(--ss-navy-light) 100%);padding:1.75rem 0 6rem;position:relative;overflow:hidden;}
        .ss-hero::before{content:'';position:absolute;width:600px;height:600px;top:-60%;right:-8%;background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%);border-radius:50%;pointer-events:none;}
        .ss-hero-inner{position:relative;z-index:2;padding:0 1.5rem;}
        .ss-breadcrumb{display:flex;gap:.5rem;list-style:none;padding:0;margin:0 0 .75rem;font-size:.82rem;}
        .ss-breadcrumb a{color:rgba(255,255,255,.55);text-decoration:none;}
        .ss-breadcrumb a:hover{color:rgba(255,255,255,.85);}
        .ss-breadcrumb .active{color:var(--ss-amber-light);font-weight:600;}
        .ss-breadcrumb .sep{color:rgba(255,255,255,.25);}
        .ss-hero-row{display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:.75rem;}
        .ss-hero-title h1{color:#fff;font-size:1.5rem;font-weight:800;margin:0;}
        .ss-hero-title h1 i{color:var(--ss-amber);margin-right:.5rem;}
        .ss-hero-sub{color:rgba(255,255,255,.55);font-size:.85rem;margin:.25rem 0 0;}
        .ss-hero-actions{display:flex;gap:.5rem;flex-wrap:wrap;}
        .ss-hero-btn{display:inline-flex;align-items:center;gap:.4rem;padding:.5rem 1.1rem;border-radius:10px;font-size:.82rem;font-weight:700;text-decoration:none;transition:all .2s;border:none;cursor:pointer;}
        .ss-hero-btn-outline{background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);color:rgba(255,255,255,.8);}
        .ss-hero-btn-outline:hover{background:rgba(255,255,255,.15);color:#fff;text-decoration:none;}

        /* ── Content ──────────────── */
        .ss-content{margin-top:-4rem;position:relative;z-index:10;padding:0 1.5rem 2rem;}
        .ss-grid{display:grid;grid-template-columns:340px 1fr;gap:1.25rem;}
        @media(max-width:992px){.ss-grid{grid-template-columns:1fr;}}

        /* ── Card ─────────────────── */
        .ss-card{background:var(--ss-card);border-radius:var(--ss-radius);border:1px solid var(--ss-border);box-shadow:0 2px 12px rgba(0,0,0,.04);overflow:hidden;}
        .ss-card-header{padding:1rem 1.25rem;display:flex;align-items:center;justify-content:space-between;gap:.5rem;border-bottom:1px solid var(--ss-border);}
        .ss-card-title{font-size:.88rem;font-weight:700;color:var(--ss-text);display:flex;align-items:center;gap:.4rem;}
        .ss-card-title i{color:var(--ss-amber);font-size:.75rem;}
        .ss-card-body{padding:1.25rem;}

        /* ── Sidebar ──────────────── */
        .ss-sidebar{display:flex;flex-direction:column;gap:1.25rem;}

        /* Circle profile card */
        .ss-profile{text-align:center;padding:1.75rem 1.25rem;}
        .ss-profile-icon{width:64px;height:64px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.4rem;margin:0 auto .75rem;background:linear-gradient(135deg,var(--ss-amber),var(--ss-amber-light));color:#fff;box-shadow:0 4px 14px rgba(217,119,6,.2);}
        .ss-profile h3{font-size:1.05rem;font-weight:800;color:var(--ss-text);margin:0 0 .15rem;}
        .ss-profile p{color:var(--ss-faint);font-size:.78rem;margin:0 0 .75rem;}
        .ss-badge{display:inline-flex;align-items:center;gap:.3rem;padding:.25rem .65rem;border-radius:8px;font-size:.7rem;font-weight:700;}

        /* Info rows */
        .ss-info{padding:.75rem 1.25rem;}
        .ss-info-row{display:flex;align-items:center;justify-content:space-between;padding:.55rem 0;border-bottom:1px solid #f8f9fb;}
        .ss-info-row:last-child{border-bottom:none;}
        .ss-info-label{font-size:.76rem;color:var(--ss-faint);display:flex;align-items:center;gap:.35rem;}
        .ss-info-label i{font-size:.6rem;width:14px;text-align:center;color:var(--ss-navy);}
        .ss-info-value{font-size:.82rem;font-weight:700;color:var(--ss-text);}

        /* Pool breakdown sidebar card */
        .ss-pool-breakdown{padding:1rem 1.25rem;}
        .ss-pool-row{display:flex;align-items:center;justify-content:space-between;padding:.5rem 0;border-bottom:1px solid #f8f9fb;}
        .ss-pool-row:last-child{border-bottom:none;}
        .ss-pool-label{font-size:.78rem;color:var(--ss-muted);display:flex;align-items:center;gap:.35rem;}
        .ss-pool-label i{font-size:.55rem;width:14px;text-align:center;}
        .ss-pool-val{font-size:.88rem;font-weight:800;}
        .ss-pool-bar{width:100%;height:8px;border-radius:8px;background:var(--ss-border);overflow:hidden;margin-top:.75rem;}
        .ss-pool-bar-seg{height:100%;float:left;transition:width .4s;}

        /* ── Main area ────────────── */
        .ss-main{display:flex;flex-direction:column;gap:1.25rem;}

        /* Summary stats */
        .ss-summary{display:grid;grid-template-columns:repeat(4,1fr);gap:.75rem;}
        @media(max-width:768px){.ss-summary{grid-template-columns:repeat(2,1fr);}}
        .ss-stat{background:var(--ss-card);border-radius:var(--ss-radius);border:1px solid var(--ss-border);box-shadow:0 2px 12px rgba(0,0,0,.04);padding:1rem 1.1rem;display:flex;align-items:center;justify-content:space-between;transition:all .2s;}
        .ss-stat:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(0,0,0,.06);}
        .ss-stat-label{font-size:.58rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--ss-faint);}
        .ss-stat-value{font-size:1.3rem;font-weight:800;color:var(--ss-text);margin-top:.1rem;}
        .ss-stat-icon{width:42px;height:42px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:.95rem;flex-shrink:0;}

        /* Table */
        .ss-table{width:100%;border-collapse:collapse;}
        .ss-table thead th{font-size:.62rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--ss-faint);padding:.7rem 1rem;border-bottom:1px solid var(--ss-border);background:#fafbfd;white-space:nowrap;}
        .ss-table tbody td{padding:.7rem 1rem;border-bottom:1px solid #f5f7fa;font-size:.84rem;vertical-align:middle;}
        .ss-table tbody tr:last-child td{border-bottom:none;}
        .ss-table tbody tr:hover{background:#fafbfd;}
        .ss-table tfoot td{padding:.7rem 1rem;font-weight:800;background:#fafbfd;border-top:2px solid var(--ss-border);font-size:.84rem;}

        /* Avatar */
        .ss-avatar{width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.65rem;flex-shrink:0;background:linear-gradient(135deg,var(--ss-navy),var(--ss-navy-light));color:#fff;}
        .ss-member{display:flex;align-items:center;gap:.55rem;}
        .ss-member-name{font-weight:700;color:var(--ss-text);font-size:.84rem;}
        .ss-member-email{font-size:.7rem;color:var(--ss-faint);}

        /* Progress */
        .ss-progress-wrap{display:flex;align-items:center;gap:.4rem;}
        .ss-progress-bar{flex:1;height:5px;border-radius:5px;background:var(--ss-border);overflow:hidden;max-width:60px;}
        .ss-progress-fill{height:100%;border-radius:5px;background:var(--ss-green);transition:width .3s;}
        .ss-progress-pct{font-size:.72rem;color:var(--ss-faint);font-weight:700;}

        /* Rank badge */
        .ss-rank{width:24px;height:24px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.6rem;font-weight:800;}

        /* Distribution chart visual */
        .ss-dist-chart{padding:1rem 1.25rem;}
        .ss-dist-row{display:flex;align-items:center;gap:.65rem;margin-bottom:.6rem;}
        .ss-dist-row:last-child{margin-bottom:0;}
        .ss-dist-name{font-size:.76rem;font-weight:600;color:var(--ss-text);width:100px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;flex-shrink:0;}
        .ss-dist-bar-track{flex:1;height:18px;background:var(--ss-border);border-radius:8px;overflow:hidden;position:relative;}
        .ss-dist-bar-fill{height:100%;border-radius:8px;transition:width .4s;display:flex;align-items:center;justify-content:flex-end;padding-right:.4rem;}
        .ss-dist-bar-label{font-size:.6rem;font-weight:700;color:#fff;text-shadow:0 1px 2px rgba(0,0,0,.3);}
        .ss-dist-amount{font-size:.76rem;font-weight:800;color:var(--ss-blue);min-width:85px;text-align:right;flex-shrink:0;}

        .ss-view-link{display:inline-flex;align-items:center;gap:.25rem;padding:.25rem .6rem;border-radius:6px;font-size:.68rem;font-weight:700;text-decoration:none;color:var(--ss-navy);background:rgba(30,58,95,.06);border:1px solid rgba(30,58,95,.1);transition:all .15s;}
        .ss-view-link:hover{background:rgba(30,58,95,.12);color:var(--ss-navy);text-decoration:none;transform:translateY(-1px);}

        @keyframes ssSlide{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
        .ss-animate{animation:ssSlide .3s ease;}
        @media(max-width:768px){.ss-content{padding:0 .75rem 1.5rem;}.ss-summary{grid-template-columns:1fr 1fr;}}
    </style>
    @endpush

    @can('view-shareout')
    @php
        $shareout    = $shareout;
        $circle      = $shareout->circle;
        $bank        = $circle->villageBank ?? null;
        $allocations = $shareout->allocations->sortByDesc('payout_amount');
        $totalMemb   = $this->totalMembers;
        $avgPayout   = $this->avgPayout;
        $highPayout  = $this->highestPayout;
        $lowPayout   = $this->lowestPayout;

        // Pool split percentages for bar chart
        $poolBase = $shareout->total_contributions + $shareout->total_insurance + $shareout->total_interest + $shareout->total_penalties;
        $sPct = $poolBase > 0 ? round(($shareout->total_contributions / $poolBase) * 100) : 0;
        $nPct = $poolBase > 0 ? round(($shareout->total_insurance / $poolBase) * 100) : 0;
        $iPct = $poolBase > 0 ? round(($shareout->total_interest / $poolBase) * 100) : 0;
        $pPct = max(0, 100 - $sPct - $nPct - $iPct);
    @endphp

    <section class="content ss-page">
        {{-- ████ Hero ████ --}}
        <div class="ss-hero">
            <div class="ss-hero-inner container-fluid">
                <ul class="ss-breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('shareout.index') }}">Shareout</a></li>
                    <li class="sep">/</li>
                    <li class="active">{{ $circle->name ?? 'Details' }}</li>
                </ul>
                <div class="ss-hero-row">
                    <div class="ss-hero-title">
                        <h1><i class="fas fa-coins"></i>Shareout Details</h1>
                        <p class="ss-hero-sub">{{ $circle->name ?? '--' }} &mdash; Finalised {{ $shareout->created_at->format('d M Y') }}</p>
                    </div>
                    <div class="ss-hero-actions">
                        <a href="{{ route('shareout.index') }}" class="ss-hero-btn ss-hero-btn-outline">
                            <i class="fas fa-arrow-left"></i> Back to Calculator
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- ████ Content ████ --}}
        <div class="ss-content container-fluid ss-animate">
            <div class="ss-grid">

                {{-- ██ LEFT — Sidebar ██ --}}
                <div class="ss-sidebar">

                    {{-- Circle profile --}}
                    <div class="ss-card">
                        <div class="ss-profile">
                            <div class="ss-profile-icon"><i class="fas fa-coins"></i></div>
                            <h3>{{ $circle->name ?? '--' }}</h3>
                            <p>{{ $bank->name ?? 'Village Bank' }}</p>
                            <span class="ss-badge" style="background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;">
                                <i class="fas fa-check-circle" style="font-size:.4rem;"></i> Completed
                            </span>
                        </div>
                    </div>

                    {{-- Pool breakdown --}}
                    <div class="ss-card">
                        <div class="ss-card-header"><div class="ss-card-title"><i class="fas fa-chart-pie"></i> Pool Breakdown</div></div>
                        <div class="ss-pool-breakdown">
                            <div class="ss-pool-row">
                                <span class="ss-pool-label"><i class="fas fa-circle" style="color:var(--ss-blue);"></i> Total Shares</span>
                                <span class="ss-pool-val" style="color:var(--ss-blue);">K{{ number_format($shareout->total_contributions, 2) }}</span>
                            </div>
                            <div class="ss-pool-row">
                                <span class="ss-pool-label"><i class="fas fa-circle" style="color:var(--ss-purple);"></i> Insurance</span>
                                <span class="ss-pool-val" style="color:var(--ss-purple);">K{{ number_format($shareout->total_insurance ?? 0, 2) }}</span>
                            </div>
                            <div class="ss-pool-row">
                                <span class="ss-pool-label"><i class="fas fa-circle" style="color:var(--ss-green);"></i> Interest</span>
                                <span class="ss-pool-val" style="color:var(--ss-green);">K{{ number_format($shareout->total_interest, 2) }}</span>
                            </div>
                            <div class="ss-pool-row">
                                <span class="ss-pool-label"><i class="fas fa-circle" style="color:var(--ss-red);"></i> Penalties</span>
                                <span class="ss-pool-val" style="color:var(--ss-red);">K{{ number_format($shareout->total_penalties, 2) }}</span>
                            </div>
                            <div class="ss-pool-row">
                                <span class="ss-pool-label"><i class="fas fa-circle" style="color:var(--ss-red);"></i> Loans Outstanding</span>
                                <span class="ss-pool-val" style="color:var(--ss-red);">-K{{ number_format($shareout->total_loans_outstanding ?? 0, 2) }}</span>
                            </div>
                            <div class="ss-pool-row" style="border-top:2px solid var(--ss-border);margin-top:.25rem;padding-top:.65rem;">
                                <span class="ss-pool-label" style="font-weight:800;color:var(--ss-text);"><i class="fas fa-coins" style="color:var(--ss-amber);"></i> Total Pool</span>
                                <span class="ss-pool-val" style="color:var(--ss-amber);font-size:1rem;">K{{ number_format($shareout->total_pool, 2) }}</span>
                            </div>
                            {{-- Stacked bar --}}
                            <div class="ss-pool-bar">
                                <div class="ss-pool-bar-seg" style="width:{{ $sPct }}%;background:var(--ss-blue);border-radius:8px 0 0 8px;"></div>
                                <div class="ss-pool-bar-seg" style="width:{{ $nPct }}%;background:var(--ss-purple);"></div>
                                <div class="ss-pool-bar-seg" style="width:{{ $iPct }}%;background:var(--ss-green);"></div>
                                <div class="ss-pool-bar-seg" style="width:{{ $pPct }}%;background:var(--ss-red);border-radius:0 8px 8px 0;"></div>
                            </div>
                            <div style="display:flex;justify-content:space-between;margin-top:.35rem;">
                                <span style="font-size:.6rem;color:var(--ss-blue);font-weight:700;">Shares {{ $sPct }}%</span>
                                <span style="font-size:.6rem;color:var(--ss-purple);font-weight:700;">Ins {{ $nPct }}%</span>
                                <span style="font-size:.6rem;color:var(--ss-green);font-weight:700;">Int {{ $iPct }}%</span>
                                <span style="font-size:.6rem;color:var(--ss-red);font-weight:700;">Pen {{ $pPct }}%</span>
                            </div>
                        </div>
                    </div>

                    {{-- Shareout info --}}
                    <div class="ss-card">
                        <div class="ss-card-header"><div class="ss-card-title"><i class="fas fa-info-circle"></i> Shareout Info</div></div>
                        <div class="ss-info">
                            <div class="ss-info-row">
                                <span class="ss-info-label"><i class="fas fa-hashtag"></i> Shareout ID</span>
                                <span class="ss-info-value">#{{ $shareout->id }}</span>
                            </div>
                            <div class="ss-info-row">
                                <span class="ss-info-label"><i class="fas fa-users"></i> Members</span>
                                <span class="ss-info-value">{{ $totalMemb }}</span>
                            </div>
                            <div class="ss-info-row">
                                <span class="ss-info-label"><i class="fas fa-calendar-check"></i> Finalised</span>
                                <span class="ss-info-value">{{ $shareout->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="ss-info-row">
                                <span class="ss-info-label"><i class="fas fa-clock"></i> Time</span>
                                <span class="ss-info-value">{{ $shareout->created_at->format('H:i') }}</span>
                            </div>
                            <div class="ss-info-row">
                                <span class="ss-info-label"><i class="fas fa-percentage"></i> Compound Rate</span>
                                <span class="ss-info-value">{{ $shareout->compound_rate ?? 5 }}% / month</span>
                            </div>
                            @if($bank)
                            <div class="ss-info-row">
                                <span class="ss-info-label"><i class="fas fa-university"></i> Village Bank</span>
                                <span class="ss-info-value">{{ $bank->name }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- ██ RIGHT — Main ██ --}}
                <div class="ss-main">

                    {{-- Summary stats --}}
                    <div class="ss-summary">
                        <div class="ss-stat">
                            <div>
                                <div class="ss-stat-label">Total Pool</div>
                                <div class="ss-stat-value" style="color:var(--ss-amber);">K{{ number_format($shareout->total_pool, 2) }}</div>
                            </div>
                            <div class="ss-stat-icon" style="background:rgba(217,119,6,.08);color:var(--ss-amber);"><i class="fas fa-coins"></i></div>
                        </div>
                        <div class="ss-stat">
                            <div>
                                <div class="ss-stat-label">Avg Payout</div>
                                <div class="ss-stat-value" style="color:var(--ss-blue);">K{{ number_format($avgPayout, 2) }}</div>
                            </div>
                            <div class="ss-stat-icon" style="background:rgba(37,99,235,.08);color:var(--ss-blue);"><i class="fas fa-balance-scale"></i></div>
                        </div>
                        <div class="ss-stat">
                            <div>
                                <div class="ss-stat-label">Highest Payout</div>
                                <div class="ss-stat-value" style="color:var(--ss-green);">K{{ number_format($highPayout, 2) }}</div>
                            </div>
                            <div class="ss-stat-icon" style="background:rgba(22,163,74,.08);color:var(--ss-green);"><i class="fas fa-arrow-up"></i></div>
                        </div>
                        <div class="ss-stat">
                            <div>
                                <div class="ss-stat-label">Lowest Payout</div>
                                <div class="ss-stat-value" style="color:var(--ss-red);">K{{ number_format($lowPayout, 2) }}</div>
                            </div>
                            <div class="ss-stat-icon" style="background:rgba(220,38,38,.08);color:var(--ss-red);"><i class="fas fa-arrow-down"></i></div>
                        </div>
                    </div>

                    {{-- Distribution chart --}}
                    <div class="ss-card">
                        <div class="ss-card-header"><div class="ss-card-title"><i class="fas fa-chart-bar"></i> Payout Distribution</div></div>
                        <div class="ss-dist-chart">
                            @foreach($allocations as $alloc)
                                @php
                                    $barPct = $highPayout > 0 ? round(($alloc->payout_amount / $highPayout) * 100) : 0;
                                    $ratio  = $shareout->total_contributions > 0 ? round(($alloc->contribution_total / $shareout->total_contributions) * 100, 1) : 0;
                                @endphp
                                <div class="ss-dist-row">
                                    <span class="ss-dist-name">{{ $alloc->user->name ?? '--' }}</span>
                                    <div class="ss-dist-bar-track">
                                        <div class="ss-dist-bar-fill" style="width:{{ $barPct }}%;background:linear-gradient(90deg,var(--ss-navy),var(--ss-navy-light));">
                                            @if($barPct > 15)<span class="ss-dist-bar-label">{{ $ratio }}%</span>@endif
                                        </div>
                                    </div>
                                    <span class="ss-dist-amount">K{{ number_format($alloc->payout_amount, 2) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Allocations table --}}
                    <div class="ss-card">
                        <div class="ss-card-header">
                            <div class="ss-card-title"><i class="fas fa-list-ol"></i> Full Allocations ({{ $totalMemb }})</div>
                        </div>
                        <div style="overflow-x:auto;">
                            <table class="ss-table">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Member</th>
                                        <th>Total Shares</th>
                                        <th>Insurance</th>
                                        <th>Shares Profit</th>
                                        <th>Insurance Profit</th>
                                        <th>Loans</th>
                                        <th>Net Shareout</th>
                                        <th>Action</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allocations as $alloc)
                                        @php
                                            $parts = explode(' ', trim($alloc->user->name ?? ''));
                                            $initials = strtoupper(substr($parts[0],0,1) . (isset($parts[1]) ? substr($parts[1],0,1) : ''));
                                            $rankColor = $loop->iteration <= 3
                                                ? ['background:rgba(217,119,6,.08);color:var(--ss-amber);border:1px solid rgba(217,119,6,.2);','background:rgba(148,163,184,.08);color:var(--ss-faint);border:1px solid rgba(148,163,184,.2);','background:rgba(180,83,9,.08);color:#b45309;border:1px solid rgba(180,83,9,.2);'][$loop->iteration - 1]
                                                : 'background:var(--ss-border);color:var(--ss-faint);';
                                        @endphp
                                        <tr>
                                            <td><div class="ss-rank" style="{{ $rankColor }}">{{ $loop->iteration }}</div></td>
                                            <td>
                                                <div class="ss-member">
                                                    <div class="ss-avatar">{{ $initials }}</div>
                                                    <div>
                                                        <div class="ss-member-name">{{ $alloc->user->name ?? '--' }}</div>
                                                        <div class="ss-member-email">{{ $alloc->user->email ?? '--' }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="font-weight:700;">K{{ number_format($alloc->contribution_total, 2) }}</td>
                                            <td style="font-weight:700;color:var(--ss-purple);">K{{ number_format($alloc->insurance_total ?? 0, 2) }}</td>
                                            <td style="color:var(--ss-green);font-weight:700;">K{{ number_format($alloc->shares_profit ?? 0, 2) }}</td>
                                            <td style="color:var(--ss-green);font-weight:700;">K{{ number_format($alloc->insurance_profit ?? 0, 2) }}</td>
                                            <td style="color:var(--ss-red);font-weight:700;">
                                                @if(($alloc->loan_deduction ?? 0) > 0)
                                                    -K{{ number_format($alloc->loan_deduction, 2) }}
                                                @else
                                                    K0.00
                                                @endif
                                            </td>
                                            <td style="color:var(--ss-blue);font-weight:800;">K{{ number_format($alloc->payout_amount, 2) }}</td>
                                            <td>
                                                @if(($alloc->action ?? 'Receiving') === 'Receiving' || $alloc->payout_amount >= 0)
                                                    <span style="background:#f0fdf4;color:#166534;padding:.2rem .5rem;border-radius:6px;font-size:.68rem;font-weight:700;border:1px solid #bbf7d0;">Receiving</span>
                                                @else
                                                    <span style="background:#fef2f2;color:#991b1b;padding:.2rem .5rem;border-radius:6px;font-size:.68rem;font-weight:700;border:1px solid #fecaca;">Pay back</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('shareout.member', ['shareoutId' => $shareout->id, 'allocationId' => $alloc->id]) }}" class="ss-view-link">
                                                    <i class="fas fa-external-link-alt"></i> Details
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2" style="text-align:right;">TOTALS</td>
                                        <td>K{{ number_format($allocations->sum('contribution_total'), 2) }}</td>
                                        <td style="color:var(--ss-purple);">K{{ number_format($allocations->sum('insurance_total'), 2) }}</td>
                                        <td style="color:var(--ss-green);">K{{ number_format($allocations->sum('shares_profit'), 2) }}</td>
                                        <td style="color:var(--ss-green);">K{{ number_format($allocations->sum('insurance_profit'), 2) }}</td>
                                        <td style="color:var(--ss-red);">-K{{ number_format($allocations->sum('loan_deduction'), 2) }}</td>
                                        <td style="color:var(--ss-blue);">K{{ number_format($allocations->sum('payout_amount'), 2) }}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
