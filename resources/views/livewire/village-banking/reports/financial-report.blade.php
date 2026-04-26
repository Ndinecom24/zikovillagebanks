<div>
    @push('custom-styles')
    <style>
        :root{--fr-navy:#1E3A5F;--fr-navy-light:#2B6B96;--fr-amber:#D97706;--fr-amber-light:#F59E0B;--fr-bg:#f4f6fa;--fr-card:#fff;--fr-border:#edf0f7;--fr-text:#1e293b;--fr-muted:#64748b;--fr-faint:#94a3b8;--fr-green:#16a34a;--fr-red:#dc2626;--fr-blue:#2563eb;--fr-purple:#7c3aed;--fr-cyan:#0891b2;--fr-radius:16px;}
        .fr-page{background:var(--fr-bg);min-height:100vh;}
        .fr-hero{background:linear-gradient(135deg,var(--fr-navy) 0%,#234b78 50%,var(--fr-navy-light) 100%);padding:1.75rem 0 6rem;position:relative;overflow:hidden;}
        .fr-hero::before{content:'';position:absolute;width:600px;height:600px;top:-60%;right:-8%;background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%);border-radius:50%;pointer-events:none;}
        .fr-hero-inner{position:relative;z-index:2;padding:0 1.5rem;}
        .fr-bc{display:flex;gap:.5rem;list-style:none;padding:0;margin:0 0 .75rem;font-size:.82rem;}
        .fr-bc a{color:rgba(255,255,255,.55);text-decoration:none;}.fr-bc a:hover{color:rgba(255,255,255,.85);}
        .fr-bc .active{color:var(--fr-amber-light);font-weight:600;}.fr-bc .sep{color:rgba(255,255,255,.25);}
        .fr-hero-row{display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:.75rem;}
        .fr-hero-title h1{color:#fff;font-size:1.6rem;font-weight:800;margin:0;}.fr-hero-title h1 i{color:var(--fr-amber);margin-right:.5rem;}
        .fr-hero-sub{color:rgba(255,255,255,.55);font-size:.88rem;margin:.25rem 0 0;}
        .fr-hero-btn{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1.25rem;border-radius:10px;font-size:.82rem;font-weight:700;text-decoration:none;transition:all .2s;border:none;cursor:pointer;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);color:rgba(255,255,255,.8);}
        .fr-hero-btn:hover{background:rgba(255,255,255,.15);color:#fff;text-decoration:none;}
        .fr-content{margin-top:-4rem;position:relative;z-index:10;padding:0 1.5rem 2rem;}

        /* Filters */
        .fr-filters{background:var(--fr-card);border-radius:var(--fr-radius);border:1px solid var(--fr-border);box-shadow:0 2px 12px rgba(0,0,0,.04);padding:1rem 1.5rem;margin-bottom:1.25rem;display:flex;align-items:end;gap:.75rem;flex-wrap:wrap;}
        .fr-label{display:block;font-size:.62rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--fr-faint);margin-bottom:.3rem;}
        .fr-select{padding:.45rem .75rem;border:1px solid var(--fr-border);border-radius:10px;font-size:.82rem;background:#fafbfd;cursor:pointer;min-width:150px;}
        .fr-select:focus{outline:none;border-color:var(--fr-amber);}
        .fr-date{padding:.45rem .75rem;border:1px solid var(--fr-border);border-radius:10px;font-size:.82rem;background:#fafbfd;}
        .fr-date:focus{outline:none;border-color:var(--fr-amber);}
        .fr-clear{padding:.42rem .75rem;border-radius:10px;font-size:.78rem;font-weight:600;background:#f1f5f9;border:1px solid var(--fr-border);color:var(--fr-muted);cursor:pointer;}
        .fr-clear:hover{background:#e2e8f0;}

        /* Stats */
        .fr-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.25rem;}
        @media(max-width:992px){.fr-stats{grid-template-columns:repeat(2,1fr);}}
        @media(max-width:576px){.fr-stats{grid-template-columns:1fr;}}
        .fr-stat{background:var(--fr-card);border-radius:var(--fr-radius);border:1px solid var(--fr-border);box-shadow:0 2px 12px rgba(0,0,0,.04);padding:1rem 1.25rem;display:flex;align-items:center;justify-content:space-between;transition:all .2s;}
        .fr-stat:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(0,0,0,.06);}
        .fr-stat-label{font-size:.6rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--fr-faint);}
        .fr-stat-val{font-size:1.35rem;font-weight:800;margin-top:.1rem;}
        .fr-stat-icon{width:42px;height:42px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:.95rem;flex-shrink:0;}

        /* Card */
        .fr-card{background:var(--fr-card);border-radius:var(--fr-radius);border:1px solid var(--fr-border);box-shadow:0 2px 12px rgba(0,0,0,.04);overflow:hidden;margin-bottom:1rem;}
        .fr-card-header{padding:1rem 1.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.5rem;border-bottom:1px solid var(--fr-border);}
        .fr-card-title{font-size:.95rem;font-weight:700;color:var(--fr-text);display:flex;align-items:center;gap:.4rem;}
        .fr-card-title i{color:var(--fr-amber);font-size:.8rem;}
        .fr-badge{display:inline-flex;align-items:center;gap:.25rem;padding:.2rem .55rem;border-radius:8px;font-size:.68rem;font-weight:700;}

        /* Table */
        .fr-table{width:100%;border-collapse:collapse;}
        .fr-table thead th{font-size:.6rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--fr-faint);padding:.65rem 1rem;border-bottom:1px solid var(--fr-border);background:#fafbfd;white-space:nowrap;}
        .fr-table tbody td{padding:.65rem 1rem;border-bottom:1px solid #f5f7fa;font-size:.84rem;vertical-align:middle;}
        .fr-table tbody tr:last-child td{border-bottom:none;}
        .fr-table tbody tr:hover{background:#fafbfd;}

        /* Fund Flow */
        .fr-flow{display:grid;grid-template-columns:1fr 1fr 1fr;gap:1rem;margin-bottom:1.25rem;}
        @media(max-width:768px){.fr-flow{grid-template-columns:1fr;}}
        .fr-flow-card{background:var(--fr-card);border-radius:var(--fr-radius);border:1px solid var(--fr-border);box-shadow:0 2px 12px rgba(0,0,0,.04);padding:1.25rem;text-align:center;}
        .fr-flow-label{font-size:.6rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--fr-faint);}
        .fr-flow-val{font-size:1.35rem;font-weight:900;margin:.25rem 0 .3rem;}
        .fr-flow-bar{height:6px;background:#edf0f7;border-radius:4px;overflow:hidden;}
        .fr-flow-fill{height:100%;border-radius:4px;}

        /* Rank */
        .fr-rank{width:24px;height:24px;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;font-size:.65rem;font-weight:800;}
        .fr-avatar{width:30px;height:30px;border-radius:10px;background:linear-gradient(135deg,var(--fr-navy),var(--fr-navy-light));display:flex;align-items:center;justify-content:center;font-size:.65rem;font-weight:800;color:#fff;flex-shrink:0;}

        /* Empty */
        .fr-empty{text-align:center;padding:2.5rem 1rem;}.fr-empty i{font-size:2rem;opacity:.12;display:block;margin-bottom:.5rem;color:var(--fr-navy);}.fr-empty p{font-size:.85rem;color:var(--fr-muted);margin:0;}

        @keyframes frSlide{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
        .fr-animate{animation:frSlide .3s ease;}
        @media(max-width:768px){.fr-content{padding:0 .75rem 1.5rem;}}
    </style>
    @endpush

    @can('view-reports')
    <section class="content fr-page">
        <div class="fr-hero">
            <div class="fr-hero-inner container-fluid">
                <ul class="fr-bc">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('reports.index') }}">Reports</a></li>
                    <li class="sep">/</li>
                    <li class="active">Financial Overview</li>
                </ul>
                <div class="fr-hero-row">
                    <div class="fr-hero-title">
                        <h1><i class="fas fa-wallet"></i>Financial Overview</h1>
                        <p class="fr-hero-sub">Comprehensive view of contributions, insurance, penalties, and fund performance</p>
                    </div>
                    <a href="{{ route('reports.index') }}" class="fr-hero-btn"><i class="fas fa-arrow-left"></i> All Reports</a>
                </div>
            </div>
        </div>

        <div class="fr-content container-fluid fr-animate">
            {{-- Filters --}}
            <div class="fr-filters">
                <div>
                    <label class="fr-label">Village Bank</label>
                    @include('partials.village-bank-selector')
                </div>
                <div>
                    <label class="fr-label">Circle</label>
                    <select wire:model.live="circleId" class="fr-select">
                        <option value="">All Circles</option>
                        @foreach ($this->circles as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="fr-label">From</label>
                    <input type="date" wire:model.blur="dateFrom" class="fr-date">
                </div>
                <div>
                    <label class="fr-label">To</label>
                    <input type="date" wire:model.blur="dateTo" class="fr-date">
                </div>
                <button wire:click="resetFilters" class="fr-clear"><i class="fas fa-times"></i> Clear</button>
            </div>

            {{-- Stats --}}
            <div class="fr-stats">
                <div class="fr-stat">
                    <div>
                        <div class="fr-stat-label">Total Contributions</div>
                        <div class="fr-stat-val" style="color:var(--fr-cyan);">K{{ number_format($summary['totalContributions'], 2) }}</div>
                    </div>
                    <div class="fr-stat-icon" style="background:rgba(8,145,178,.08);color:var(--fr-cyan);"><i class="fas fa-piggy-bank"></i></div>
                </div>
                <div class="fr-stat">
                    <div>
                        <div class="fr-stat-label">Insurance Collected</div>
                        <div class="fr-stat-val" style="color:var(--fr-purple);">K{{ number_format($summary['totalInsurance'], 2) }}</div>
                    </div>
                    <div class="fr-stat-icon" style="background:rgba(124,58,237,.08);color:var(--fr-purple);"><i class="fas fa-shield-alt"></i></div>
                </div>
                <div class="fr-stat">
                    <div>
                        <div class="fr-stat-label">Interest Earned</div>
                        <div class="fr-stat-val" style="color:var(--fr-green);">K{{ number_format($summary['totalInterestEarned'], 2) }}</div>
                    </div>
                    <div class="fr-stat-icon" style="background:rgba(22,163,74,.08);color:var(--fr-green);"><i class="fas fa-percentage"></i></div>
                </div>
                <div class="fr-stat">
                    <div>
                        <div class="fr-stat-label">Penalties Collected</div>
                        <div class="fr-stat-val" style="color:var(--fr-red);">K{{ number_format($summary['totalPenalties'], 2) }}</div>
                    </div>
                    <div class="fr-stat-icon" style="background:rgba(220,38,38,.08);color:var(--fr-red);"><i class="fas fa-exclamation-circle"></i></div>
                </div>
            </div>

            {{-- Fund Flow --}}
            @php
                $maxFlow = max($fundFlow['inflow'], $fundFlow['outflow'], 1);
            @endphp
            <div class="fr-flow">
                <div class="fr-flow-card">
                    <div class="fr-flow-label">Total Inflow</div>
                    <div class="fr-flow-val" style="color:var(--fr-green);">K{{ number_format($fundFlow['inflow'], 2) }}</div>
                    <div class="fr-flow-bar"><div class="fr-flow-fill" style="width:{{ round(($fundFlow['inflow'] / $maxFlow) * 100) }}%;background:var(--fr-green);"></div></div>
                    <small style="font-size:.7rem;color:var(--fr-faint);margin-top:.25rem;display:block;">Contributions + Insurance + Penalties + Interest</small>
                </div>
                <div class="fr-flow-card">
                    <div class="fr-flow-label">Total Outflow</div>
                    <div class="fr-flow-val" style="color:var(--fr-red);">K{{ number_format($fundFlow['outflow'], 2) }}</div>
                    <div class="fr-flow-bar"><div class="fr-flow-fill" style="width:{{ round(($fundFlow['outflow'] / $maxFlow) * 100) }}%;background:var(--fr-red);"></div></div>
                    <small style="font-size:.7rem;color:var(--fr-faint);margin-top:.25rem;display:block;">Loans Issued + Shareout Distributions</small>
                </div>
                <div class="fr-flow-card" style="background:linear-gradient(135deg,var(--fr-navy),var(--fr-navy-light));border:none;">
                    <div class="fr-flow-label" style="color:rgba(255,255,255,.5);">Net Position</div>
                    <div class="fr-flow-val" style="color:#fff;">K{{ number_format($fundFlow['net'], 2) }}</div>
                    <div class="fr-flow-bar" style="background:rgba(255,255,255,.15);"><div class="fr-flow-fill" style="width:{{ $fundFlow['inflow'] > 0 ? round(abs($fundFlow['net']) / $fundFlow['inflow'] * 100) : 0 }}%;background:var(--fr-amber);"></div></div>
                    <small style="font-size:.7rem;color:rgba(255,255,255,.4);margin-top:.25rem;display:block;">Inflow minus Outflow</small>
                </div>
            </div>

            <div class="row">
                {{-- Contributions by Month --}}
                <div class="col-lg-7">
                    <div class="fr-card">
                        <div class="fr-card-header">
                            <div class="fr-card-title"><i class="fas fa-calendar-alt"></i> Contributions by Month</div>
                            <span class="fr-badge" style="background:rgba(8,145,178,.06);color:var(--fr-cyan);border:1px solid rgba(8,145,178,.15);">{{ $contributionsByMonth->count() }} months</span>
                        </div>
                        <div style="overflow-x:auto;">
                            <table class="fr-table">
                                <thead><tr><th>Circle</th><th>Month</th><th>Members</th><th>Avg/Member</th><th style="text-align:right;">Total</th></tr></thead>
                                <tbody>
                                    @forelse ($contributionsByMonth as $row)
                                        <tr>
                                            <td style="font-weight:700;">{{ $row->month->circle->name ?? '--' }}</td>
                                            <td>Month {{ $row->month->month_number ?? '' }}</td>
                                            <td style="text-align:center;">{{ $row->members }}</td>
                                            <td style="color:var(--fr-muted);">K{{ number_format($row->avg_amount, 2) }}</td>
                                            <td style="text-align:right;font-weight:800;color:var(--fr-cyan);">K{{ number_format($row->total, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5"><div class="fr-empty"><i class="fas fa-piggy-bank"></i><p>No contributions found for the selected filters.</p></div></td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Insurance by Circle --}}
                    <div class="fr-card">
                        <div class="fr-card-header">
                            <div class="fr-card-title"><i class="fas fa-shield-alt"></i> Insurance by Circle</div>
                        </div>
                        <div style="overflow-x:auto;">
                            <table class="fr-table">
                                <thead><tr><th>Circle</th><th>Contributing Members</th><th style="text-align:right;">Total Collected</th></tr></thead>
                                <tbody>
                                    @forelse ($insuranceByCircle as $row)
                                        <tr>
                                            <td style="font-weight:700;">{{ $row->circle->name ?? '--' }}</td>
                                            <td style="text-align:center;">{{ $row->members }}</td>
                                            <td style="text-align:right;font-weight:800;color:var(--fr-purple);">K{{ number_format($row->total, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="3"><div class="fr-empty"><i class="fas fa-shield-alt"></i><p>No insurance data found.</p></div></td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Top Contributors --}}
                <div class="col-lg-5">
                    <div class="fr-card">
                        <div class="fr-card-header">
                            <div class="fr-card-title"><i class="fas fa-trophy"></i> Top 10 Contributors</div>
                        </div>
                        <div style="padding:1rem 1.5rem;">
                            @forelse ($topContributors as $i => $tc)
                                @php
                                    $rankColors = [0 => ['#fef3c7','#92400e'], 1 => ['#f1f5f9','#475569'], 2 => ['#fff7ed','#9a3412']];
                                    $rc = $rankColors[$i] ?? ['#f8fafc','var(--fr-faint)'];
                                @endphp
                                <div style="display:flex;align-items:center;gap:.65rem;padding:.55rem 0;{{ $i < count($topContributors) - 1 ? 'border-bottom:1px solid #f5f7fa;' : '' }}">
                                    <div class="fr-rank" style="background:{{ $rc[0] }};color:{{ $rc[1] }};">{{ $i + 1 }}</div>
                                    <div class="fr-avatar">{{ strtoupper(substr($tc->user->name ?? '?', 0, 1)) }}</div>
                                    <div style="flex:1;min-width:0;">
                                        <div style="font-size:.84rem;font-weight:700;color:var(--fr-text);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $tc->user->name ?? '--' }}</div>
                                        <div style="font-size:.72rem;color:var(--fr-faint);">{{ $tc->contributions }} contribution{{ $tc->contributions != 1 ? 's' : '' }}</div>
                                    </div>
                                    <div style="font-size:.88rem;font-weight:800;color:var(--fr-cyan);white-space:nowrap;">K{{ number_format($tc->total, 2) }}</div>
                                </div>
                            @empty
                                <div class="fr-empty"><i class="fas fa-trophy"></i><p>No contributor data.</p></div>
                            @endforelse
                        </div>
                    </div>

                    {{-- Quick Summary --}}
                    <div class="fr-card" style="background:linear-gradient(135deg,var(--fr-navy),var(--fr-navy-light));border:none;">
                        <div style="padding:1.25rem 1.5rem;">
                            <div style="font-size:.7rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:rgba(255,255,255,.4);margin-bottom:.75rem;">Loan Portfolio Snapshot</div>
                            <div style="display:grid;grid-template-columns:1fr 1fr;gap:.85rem;">
                                <div>
                                    <div style="font-size:.62rem;text-transform:uppercase;color:rgba(255,255,255,.35);font-weight:600;">Loans Issued</div>
                                    <div style="font-size:1.1rem;font-weight:800;color:#fff;">K{{ number_format($summary['totalLoanIssued'], 0) }}</div>
                                </div>
                                <div>
                                    <div style="font-size:.62rem;text-transform:uppercase;color:rgba(255,255,255,.35);font-weight:600;">Repaid</div>
                                    <div style="font-size:1.1rem;font-weight:800;color:var(--fr-green);">K{{ number_format($summary['totalRepaid'], 0) }}</div>
                                </div>
                                <div>
                                    <div style="font-size:.62rem;text-transform:uppercase;color:rgba(255,255,255,.35);font-weight:600;">Outstanding</div>
                                    <div style="font-size:1.1rem;font-weight:800;color:var(--fr-amber-light);">K{{ number_format($summary['totalOutstanding'], 0) }}</div>
                                </div>
                                <div>
                                    <div style="font-size:.62rem;text-transform:uppercase;color:rgba(255,255,255,.35);font-weight:600;">Shareouts</div>
                                    <div style="font-size:1.1rem;font-weight:800;color:#fff;">K{{ number_format($summary['totalShareouts'], 0) }}</div>
                                </div>
                            </div>
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
