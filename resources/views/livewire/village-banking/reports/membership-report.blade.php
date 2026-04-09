<div>
    @push('custom-styles')
    <style>
        :root{--mr-navy:#1E3A5F;--mr-navy-light:#2B6B96;--mr-amber:#D97706;--mr-amber-light:#F59E0B;--mr-bg:#f4f6fa;--mr-card:#fff;--mr-border:#edf0f7;--mr-text:#1e293b;--mr-muted:#64748b;--mr-faint:#94a3b8;--mr-green:#16a34a;--mr-red:#dc2626;--mr-blue:#2563eb;--mr-purple:#7c3aed;--mr-cyan:#0891b2;--mr-radius:16px;}
        .mr-page{background:var(--mr-bg);min-height:100vh;}
        .mr-hero{background:linear-gradient(135deg,var(--mr-navy) 0%,#234b78 50%,var(--mr-navy-light) 100%);padding:1.75rem 0 6rem;position:relative;overflow:hidden;}
        .mr-hero::before{content:'';position:absolute;width:600px;height:600px;top:-60%;right:-8%;background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%);border-radius:50%;pointer-events:none;}
        .mr-hero-inner{position:relative;z-index:2;padding:0 1.5rem;}
        .mr-bc{display:flex;gap:.5rem;list-style:none;padding:0;margin:0 0 .75rem;font-size:.82rem;}.mr-bc a{color:rgba(255,255,255,.55);text-decoration:none;}.mr-bc a:hover{color:rgba(255,255,255,.85);}.mr-bc .active{color:var(--mr-amber-light);font-weight:600;}.mr-bc .sep{color:rgba(255,255,255,.25);}
        .mr-hero-row{display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:.75rem;}
        .mr-hero-title h1{color:#fff;font-size:1.6rem;font-weight:800;margin:0;}.mr-hero-title h1 i{color:var(--mr-amber);margin-right:.5rem;}
        .mr-hero-sub{color:rgba(255,255,255,.55);font-size:.88rem;margin:.25rem 0 0;}
        .mr-hero-btn{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1.25rem;border-radius:10px;font-size:.82rem;font-weight:700;text-decoration:none;transition:all .2s;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);color:rgba(255,255,255,.8);}.mr-hero-btn:hover{background:rgba(255,255,255,.15);color:#fff;text-decoration:none;}
        .mr-content{margin-top:-4rem;position:relative;z-index:10;padding:0 1.5rem 2rem;}
        .mr-filters{background:var(--mr-card);border-radius:var(--mr-radius);border:1px solid var(--mr-border);box-shadow:0 2px 12px rgba(0,0,0,.04);padding:1rem 1.5rem;margin-bottom:1.25rem;display:flex;align-items:end;gap:.75rem;flex-wrap:wrap;}
        .mr-label{display:block;font-size:.62rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--mr-faint);margin-bottom:.3rem;}
        .mr-select{padding:.45rem .75rem;border:1px solid var(--mr-border);border-radius:10px;font-size:.82rem;background:#fafbfd;cursor:pointer;min-width:150px;}.mr-select:focus{outline:none;border-color:var(--mr-amber);}

        .mr-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.25rem;}
        @media(max-width:992px){.mr-stats{grid-template-columns:repeat(2,1fr);}}@media(max-width:576px){.mr-stats{grid-template-columns:1fr;}}
        .mr-stat{background:var(--mr-card);border-radius:var(--mr-radius);border:1px solid var(--mr-border);box-shadow:0 2px 12px rgba(0,0,0,.04);padding:1rem 1.25rem;display:flex;align-items:center;justify-content:space-between;transition:all .2s;}.mr-stat:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(0,0,0,.06);}
        .mr-stat-label{font-size:.6rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--mr-faint);}
        .mr-stat-val{font-size:1.35rem;font-weight:800;margin-top:.1rem;}
        .mr-stat-icon{width:42px;height:42px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:.95rem;flex-shrink:0;}

        .mr-card{background:var(--mr-card);border-radius:var(--mr-radius);border:1px solid var(--mr-border);box-shadow:0 2px 12px rgba(0,0,0,.04);overflow:hidden;margin-bottom:1rem;}
        .mr-card-header{padding:1rem 1.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.5rem;border-bottom:1px solid var(--mr-border);}
        .mr-card-title{font-size:.95rem;font-weight:700;color:var(--mr-text);display:flex;align-items:center;gap:.4rem;}.mr-card-title i{color:var(--mr-amber);font-size:.8rem;}
        .mr-badge{display:inline-flex;align-items:center;gap:.25rem;padding:.2rem .55rem;border-radius:8px;font-size:.68rem;font-weight:700;}
        .mr-table{width:100%;border-collapse:collapse;}
        .mr-table thead th{font-size:.6rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--mr-faint);padding:.65rem 1rem;border-bottom:1px solid var(--mr-border);background:#fafbfd;white-space:nowrap;}
        .mr-table tbody td{padding:.65rem 1rem;border-bottom:1px solid #f5f7fa;font-size:.84rem;vertical-align:middle;}.mr-table tbody tr:last-child td{border-bottom:none;}.mr-table tbody tr:hover{background:#fafbfd;}
        .mr-avatar{width:30px;height:30px;border-radius:10px;background:linear-gradient(135deg,var(--mr-navy),var(--mr-navy-light));display:flex;align-items:center;justify-content:center;font-size:.65rem;font-weight:800;color:#fff;flex-shrink:0;}
        .mr-empty{text-align:center;padding:2.5rem 1rem;}.mr-empty i{font-size:2rem;opacity:.12;display:block;margin-bottom:.5rem;color:var(--mr-navy);}.mr-empty p{font-size:.85rem;color:var(--mr-muted);margin:0;}

        /* Participation bar */
        .mr-part-bar{display:flex;align-items:center;gap:.5rem;}.mr-part-track{flex:1;height:8px;background:#edf0f7;border-radius:4px;overflow:hidden;}.mr-part-fill{height:100%;border-radius:4px;}.mr-part-pct{font-size:.78rem;font-weight:800;width:40px;text-align:right;}

        @keyframes mrSlide{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}.mr-animate{animation:mrSlide .3s ease;}
        @media(max-width:768px){.mr-content{padding:0 .75rem 1.5rem;}}
    </style>
    @endpush

    @can('view-reports')
    <section class="content mr-page">
        <div class="mr-hero">
            <div class="mr-hero-inner container-fluid">
                <ul class="mr-bc">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('reports.index') }}">Reports</a></li>
                    <li class="sep">/</li>
                    <li class="active">Membership</li>
                </ul>
                <div class="mr-hero-row">
                    <div class="mr-hero-title">
                        <h1><i class="fas fa-users"></i>Membership & Participation</h1>
                        <p class="mr-hero-sub">Member enrolment, circle composition, and engagement analysis</p>
                    </div>
                    <a href="{{ route('reports.index') }}" class="mr-hero-btn"><i class="fas fa-arrow-left"></i> All Reports</a>
                </div>
            </div>
        </div>

        <div class="mr-content container-fluid mr-animate">
            <div class="mr-filters">
                <div><label class="mr-label">Village Bank</label>@include('partials.village-bank-selector')</div>
                <div>
                    <label class="mr-label">Circle</label>
                    <select wire:model="circleId" class="mr-select"><option value="">All Circles</option>@foreach ($this->circles as $c)<option value="{{ $c->id }}">{{ $c->name }}</option>@endforeach</select>
                </div>
            </div>

            {{-- Stats --}}
            <div class="mr-stats">
                <div class="mr-stat"><div><div class="mr-stat-label">Total Members</div><div class="mr-stat-val" style="color:var(--mr-purple);">{{ $summary['totalMembers'] }}</div></div><div class="mr-stat-icon" style="background:rgba(124,58,237,.08);color:var(--mr-purple);"><i class="fas fa-users"></i></div></div>
                <div class="mr-stat"><div><div class="mr-stat-label">Circles</div><div class="mr-stat-val" style="color:var(--mr-blue);">{{ $summary['totalCircles'] }}</div></div><div class="mr-stat-icon" style="background:rgba(37,99,235,.08);color:var(--mr-blue);"><i class="fas fa-circle-notch"></i></div></div>
                <div class="mr-stat"><div><div class="mr-stat-label">Active Circles</div><div class="mr-stat-val" style="color:var(--mr-green);">{{ $summary['activeCircles'] }}</div></div><div class="mr-stat-icon" style="background:rgba(22,163,74,.08);color:var(--mr-green);"><i class="fas fa-play-circle"></i></div></div>
                <div class="mr-stat"><div><div class="mr-stat-label">Closed Circles</div><div class="mr-stat-val" style="color:var(--mr-faint);">{{ $summary['closedCircles'] }}</div></div><div class="mr-stat-icon" style="background:rgba(148,163,184,.08);color:var(--mr-faint);"><i class="fas fa-check-circle"></i></div></div>
            </div>

            <div class="row">
                {{-- Circles Detail --}}
                <div class="col-lg-6">
                    <div class="mr-card">
                        <div class="mr-card-header">
                            <div class="mr-card-title"><i class="fas fa-circle-notch"></i> Circles Overview</div>
                            <span class="mr-badge" style="background:rgba(37,99,235,.06);color:var(--mr-blue);border:1px solid rgba(37,99,235,.15);">{{ $circlesDetail->count() }}</span>
                        </div>
                        <div style="overflow-x:auto;">
                            <table class="mr-table">
                                <thead><tr><th>Circle</th><th>Members</th><th>Months</th><th>Contributions</th><th>Loans</th><th>Status</th></tr></thead>
                                <tbody>
                                    @forelse ($circlesDetail as $c)
                                        @php $sc = ['active'=>['rgba(22,163,74,.06)','#166534','rgba(22,163,74,.2)'],'closed'=>['rgba(148,163,184,.06)','#475569','rgba(148,163,184,.2)'],'pending'=>['rgba(245,158,11,.06)','#92400e','rgba(245,158,11,.2)']][$c->status] ?? ['#f8fafc','#475569','#e2e8f0']; @endphp
                                        <tr>
                                            <td style="font-weight:700;">{{ $c->name }}</td>
                                            <td style="text-align:center;">{{ $c->circle_memberships_count }}</td>
                                            <td style="text-align:center;">{{ $c->months->count() }}</td>
                                            <td style="font-weight:700;color:var(--mr-cyan);">K{{ number_format($c->total_contributions, 0) }}</td>
                                            <td style="text-align:center;">{{ $c->total_loans }}</td>
                                            <td><span class="mr-badge" style="background:{{ $sc[0] }};color:{{ $sc[1] }};border:1px solid {{ $sc[2] }};"><i class="fas fa-circle" style="font-size:.3rem;"></i> {{ ucfirst($c->status) }}</span></td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="6"><div class="mr-empty"><i class="fas fa-circle-notch"></i><p>No circles found.</p></div></td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Participation Rates --}}
                <div class="col-lg-6">
                    <div class="mr-card">
                        <div class="mr-card-header">
                            <div class="mr-card-title"><i class="fas fa-chart-line"></i> Participation Rates</div>
                        </div>
                        <div style="padding:1rem 1.5rem;">
                            @forelse ($participation as $p)
                                <div style="margin-bottom:1rem;{{ !$loop->last ? 'padding-bottom:1rem;border-bottom:1px solid #f5f7fa;' : '' }}">
                                    <div style="font-size:.84rem;font-weight:700;color:var(--mr-text);margin-bottom:.4rem;">{{ $p['circle'] }} <span style="font-size:.72rem;color:var(--mr-faint);font-weight:500;">({{ $p['totalMembers'] }} members)</span></div>
                                    <div style="display:flex;gap:1.5rem;">
                                        <div style="flex:1;">
                                            <div style="font-size:.65rem;text-transform:uppercase;color:var(--mr-faint);font-weight:600;margin-bottom:.2rem;">Contributing</div>
                                            <div class="mr-part-bar">
                                                <div class="mr-part-track"><div class="mr-part-fill" style="width:{{ $p['contributionRate'] }}%;background:var(--mr-green);"></div></div>
                                                <div class="mr-part-pct" style="color:var(--mr-green);">{{ $p['contributionRate'] }}%</div>
                                            </div>
                                            <div style="font-size:.7rem;color:var(--mr-faint);margin-top:.1rem;">{{ $p['activeContributors'] }}/{{ $p['totalMembers'] }}</div>
                                        </div>
                                        <div style="flex:1;">
                                            <div style="font-size:.65rem;text-transform:uppercase;color:var(--mr-faint);font-weight:600;margin-bottom:.2rem;">Borrowing</div>
                                            <div class="mr-part-bar">
                                                <div class="mr-part-track"><div class="mr-part-fill" style="width:{{ $p['borrowingRate'] }}%;background:var(--mr-amber);"></div></div>
                                                <div class="mr-part-pct" style="color:var(--mr-amber);">{{ $p['borrowingRate'] }}%</div>
                                            </div>
                                            <div style="font-size:.7rem;color:var(--mr-faint);margin-top:.1rem;">{{ $p['activeBorrowers'] }}/{{ $p['totalMembers'] }}</div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="mr-empty"><i class="fas fa-chart-line"></i><p>No participation data.</p></div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            {{-- Full Member List --}}
            <div class="mr-card">
                <div class="mr-card-header">
                    <div class="mr-card-title"><i class="fas fa-list-alt"></i> Member Activity Summary</div>
                    <span class="mr-badge" style="background:rgba(124,58,237,.06);color:var(--mr-purple);border:1px solid rgba(124,58,237,.15);">{{ $membersDetail->count() }} members</span>
                </div>
                <div style="overflow-x:auto;">
                    <table class="mr-table">
                        <thead><tr><th>#</th><th>Member</th><th>Email</th><th>Circles</th><th>Contributions</th><th>Insurance</th><th>Loans</th></tr></thead>
                        <tbody>
                            @forelse ($membersDetail as $i => $m)
                                <tr>
                                    <td style="color:var(--mr-faint);font-size:.78rem;">{{ $i + 1 }}</td>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:.5rem;">
                                            <div class="mr-avatar">{{ strtoupper(substr($m->name ?? '?', 0, 1)) }}</div>
                                            <strong style="font-size:.84rem;">{{ $m->name ?? '--' }}</strong>
                                        </div>
                                    </td>
                                    <td style="font-size:.78rem;color:var(--mr-faint);">{{ $m->email ?? '--' }}</td>
                                    <td style="text-align:center;font-weight:700;">{{ $m->circles_count }}</td>
                                    <td style="font-weight:800;color:var(--mr-cyan);">K{{ number_format($m->total_contributions, 2) }}</td>
                                    <td style="color:var(--mr-purple);">K{{ number_format($m->total_insurance, 2) }}</td>
                                    <td style="text-align:center;">{{ $m->total_loans }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="7"><div class="mr-empty"><i class="fas fa-users"></i><p>No members found.</p></div></td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
