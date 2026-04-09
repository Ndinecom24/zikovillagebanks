<div>
    @push('custom-styles')
    <style>
        :root{--lr-navy:#1E3A5F;--lr-navy-light:#2B6B96;--lr-amber:#D97706;--lr-amber-light:#F59E0B;--lr-bg:#f4f6fa;--lr-card:#fff;--lr-border:#edf0f7;--lr-text:#1e293b;--lr-muted:#64748b;--lr-faint:#94a3b8;--lr-green:#16a34a;--lr-red:#dc2626;--lr-blue:#2563eb;--lr-purple:#7c3aed;--lr-cyan:#0891b2;--lr-orange:#ea580c;--lr-radius:16px;}
        .lr-page{background:var(--lr-bg);min-height:100vh;}
        .lr-hero{background:linear-gradient(135deg,var(--lr-navy) 0%,#234b78 50%,var(--lr-navy-light) 100%);padding:1.75rem 0 6rem;position:relative;overflow:hidden;}
        .lr-hero::before{content:'';position:absolute;width:600px;height:600px;top:-60%;right:-8%;background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%);border-radius:50%;pointer-events:none;}
        .lr-hero-inner{position:relative;z-index:2;padding:0 1.5rem;}
        .lr-bc{display:flex;gap:.5rem;list-style:none;padding:0;margin:0 0 .75rem;font-size:.82rem;}.lr-bc a{color:rgba(255,255,255,.55);text-decoration:none;}.lr-bc a:hover{color:rgba(255,255,255,.85);}.lr-bc .active{color:var(--lr-amber-light);font-weight:600;}.lr-bc .sep{color:rgba(255,255,255,.25);}
        .lr-hero-row{display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:.75rem;}
        .lr-hero-title h1{color:#fff;font-size:1.6rem;font-weight:800;margin:0;}.lr-hero-title h1 i{color:var(--lr-amber);margin-right:.5rem;}
        .lr-hero-sub{color:rgba(255,255,255,.55);font-size:.88rem;margin:.25rem 0 0;}
        .lr-hero-btn{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1.25rem;border-radius:10px;font-size:.82rem;font-weight:700;text-decoration:none;transition:all .2s;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);color:rgba(255,255,255,.8);}.lr-hero-btn:hover{background:rgba(255,255,255,.15);color:#fff;text-decoration:none;}
        .lr-content{margin-top:-4rem;position:relative;z-index:10;padding:0 1.5rem 2rem;}
        .lr-filters{background:var(--lr-card);border-radius:var(--lr-radius);border:1px solid var(--lr-border);box-shadow:0 2px 12px rgba(0,0,0,.04);padding:1rem 1.5rem;margin-bottom:1.25rem;display:flex;align-items:end;gap:.75rem;flex-wrap:wrap;}
        .lr-label{display:block;font-size:.62rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--lr-faint);margin-bottom:.3rem;}
        .lr-select{padding:.45rem .75rem;border:1px solid var(--lr-border);border-radius:10px;font-size:.82rem;background:#fafbfd;cursor:pointer;min-width:130px;}.lr-select:focus{outline:none;border-color:var(--lr-amber);}
        .lr-date{padding:.45rem .75rem;border:1px solid var(--lr-border);border-radius:10px;font-size:.82rem;background:#fafbfd;}.lr-date:focus{outline:none;border-color:var(--lr-amber);}
        .lr-clear{padding:.42rem .75rem;border-radius:10px;font-size:.78rem;font-weight:600;background:#f1f5f9;border:1px solid var(--lr-border);color:var(--lr-muted);cursor:pointer;}.lr-clear:hover{background:#e2e8f0;}

        .lr-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.25rem;}
        @media(max-width:992px){.lr-stats{grid-template-columns:repeat(2,1fr);}}@media(max-width:576px){.lr-stats{grid-template-columns:1fr;}}
        .lr-stat{background:var(--lr-card);border-radius:var(--lr-radius);border:1px solid var(--lr-border);box-shadow:0 2px 12px rgba(0,0,0,.04);padding:1rem 1.25rem;display:flex;align-items:center;justify-content:space-between;transition:all .2s;}.lr-stat:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(0,0,0,.06);}
        .lr-stat-label{font-size:.6rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--lr-faint);}
        .lr-stat-val{font-size:1.3rem;font-weight:800;margin-top:.1rem;}
        .lr-stat-sub{font-size:.7rem;color:var(--lr-faint);font-weight:600;margin-top:.1rem;}
        .lr-stat-icon{width:42px;height:42px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:.95rem;flex-shrink:0;}

        .lr-card{background:var(--lr-card);border-radius:var(--lr-radius);border:1px solid var(--lr-border);box-shadow:0 2px 12px rgba(0,0,0,.04);overflow:hidden;margin-bottom:1rem;}
        .lr-card-header{padding:1rem 1.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.5rem;border-bottom:1px solid var(--lr-border);}
        .lr-card-title{font-size:.95rem;font-weight:700;color:var(--lr-text);display:flex;align-items:center;gap:.4rem;}.lr-card-title i{color:var(--lr-amber);font-size:.8rem;}
        .lr-badge{display:inline-flex;align-items:center;gap:.25rem;padding:.2rem .55rem;border-radius:8px;font-size:.68rem;font-weight:700;}
        .lr-table{width:100%;border-collapse:collapse;}
        .lr-table thead th{font-size:.6rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--lr-faint);padding:.65rem 1rem;border-bottom:1px solid var(--lr-border);background:#fafbfd;white-space:nowrap;}
        .lr-table tbody td{padding:.6rem 1rem;border-bottom:1px solid #f5f7fa;font-size:.82rem;vertical-align:middle;}.lr-table tbody tr:last-child td{border-bottom:none;}.lr-table tbody tr:hover{background:#fafbfd;}
        .lr-avatar{width:30px;height:30px;border-radius:10px;background:linear-gradient(135deg,var(--lr-navy),var(--lr-navy-light));display:flex;align-items:center;justify-content:center;font-size:.65rem;font-weight:800;color:#fff;flex-shrink:0;}
        .lr-rank{width:24px;height:24px;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;font-size:.65rem;font-weight:800;}
        .lr-empty{text-align:center;padding:2.5rem 1rem;}.lr-empty i{font-size:2rem;opacity:.12;display:block;margin-bottom:.5rem;color:var(--lr-navy);}.lr-empty p{font-size:.85rem;color:var(--lr-muted);margin:0;}

        /* Status cards */
        .lr-status-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:.75rem;margin-bottom:1.25rem;}
        @media(max-width:992px){.lr-status-grid{grid-template-columns:repeat(3,1fr);}}@media(max-width:576px){.lr-status-grid{grid-template-columns:1fr;}}
        .lr-sc{background:var(--lr-card);border-radius:14px;border:1px solid var(--lr-border);box-shadow:0 2px 8px rgba(0,0,0,.03);padding:.85rem 1rem;display:flex;align-items:center;gap:.65rem;}
        .lr-sc-icon{width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:.8rem;flex-shrink:0;}
        .lr-sc-label{font-size:.62rem;text-transform:uppercase;font-weight:700;color:var(--lr-faint);}
        .lr-sc-val{font-size:1.1rem;font-weight:800;}
        .lr-sc-amt{font-size:.72rem;font-weight:600;}

        /* Perf bar */
        .lr-perf{display:flex;align-items:center;gap:.5rem;}.lr-perf-track{flex:1;height:8px;background:#edf0f7;border-radius:4px;overflow:hidden;}.lr-perf-fill{height:100%;border-radius:4px;}.lr-perf-pct{font-size:.78rem;font-weight:800;width:45px;text-align:right;}

        /* Repayment gauge */
        .lr-gauge{text-align:center;padding:1.5rem;}
        .lr-gauge-val{font-size:2.5rem;font-weight:900;}
        .lr-gauge-bar{height:10px;background:#edf0f7;border-radius:6px;overflow:hidden;margin:.5rem 0;}.lr-gauge-fill{height:100%;border-radius:6px;}

        @keyframes lrSlide{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}.lr-animate{animation:lrSlide .3s ease;}
        @media(max-width:768px){.lr-content{padding:0 .75rem 1.5rem;}}
    </style>
    @endpush

    @can('view-reports')
    <section class="content lr-page">
        <div class="lr-hero">
            <div class="lr-hero-inner container-fluid">
                <ul class="lr-bc">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('reports.index') }}">Reports</a></li>
                    <li class="sep">/</li>
                    <li class="active">Loans & Repayments</li>
                </ul>
                <div class="lr-hero-row">
                    <div class="lr-hero-title">
                        <h1><i class="fas fa-hand-holding-usd"></i>Loans & Repayments</h1>
                        <p class="lr-hero-sub">Loan portfolio analysis, repayment tracking, and borrower performance</p>
                    </div>
                    <a href="{{ route('reports.index') }}" class="lr-hero-btn"><i class="fas fa-arrow-left"></i> All Reports</a>
                </div>
            </div>
        </div>

        <div class="lr-content container-fluid lr-animate">
            <div class="lr-filters">
                <div><label class="lr-label">Village Bank</label>@include('partials.village-bank-selector')</div>
                <div><label class="lr-label">Circle</label><select wire:model="circleId" class="lr-select"><option value="">All Circles</option>@foreach($this->circles as $c)<option value="{{ $c->id }}">{{ $c->name }}</option>@endforeach</select></div>
                <div><label class="lr-label">Status</label><select wire:model="statusFilter" class="lr-select"><option value="">All Statuses</option><option value="pending">Pending</option><option value="approved">Approved</option><option value="active">Active</option><option value="completed">Completed</option><option value="rejected">Rejected</option></select></div>
                <div><label class="lr-label">From</label><input type="date" wire:model.lazy="dateFrom" class="lr-date"></div>
                <div><label class="lr-label">To</label><input type="date" wire:model.lazy="dateTo" class="lr-date"></div>
                <button wire:click="resetFilters" class="lr-clear"><i class="fas fa-times"></i> Clear</button>
            </div>

            {{-- Portfolio Stats --}}
            <div class="lr-stats">
                <div class="lr-stat"><div><div class="lr-stat-label">Loans Issued</div><div class="lr-stat-val" style="color:var(--lr-orange);">K{{ number_format($portfolio['totalIssued'], 2) }}</div><div class="lr-stat-sub">{{ $portfolio['totalLoans'] }} loans</div></div><div class="lr-stat-icon" style="background:rgba(234,88,12,.08);color:var(--lr-orange);"><i class="fas fa-hand-holding-usd"></i></div></div>
                <div class="lr-stat"><div><div class="lr-stat-label">Total Repaid</div><div class="lr-stat-val" style="color:var(--lr-green);">K{{ number_format($portfolio['totalRepaid'], 2) }}</div></div><div class="lr-stat-icon" style="background:rgba(22,163,74,.08);color:var(--lr-green);"><i class="fas fa-check-double"></i></div></div>
                <div class="lr-stat"><div><div class="lr-stat-label">Outstanding</div><div class="lr-stat-val" style="color:var(--lr-red);">K{{ number_format($portfolio['totalOutstanding'], 2) }}</div></div><div class="lr-stat-icon" style="background:rgba(220,38,38,.08);color:var(--lr-red);"><i class="fas fa-exclamation-triangle"></i></div></div>
                <div class="lr-stat"><div><div class="lr-stat-label">Interest Earned</div><div class="lr-stat-val" style="color:var(--lr-cyan);">K{{ number_format($portfolio['interestEarned'], 2) }}</div><div class="lr-stat-sub">{{ $portfolio['repaymentRate'] }}% repaid</div></div><div class="lr-stat-icon" style="background:rgba(8,145,178,.08);color:var(--lr-cyan);"><i class="fas fa-percentage"></i></div></div>
            </div>

            {{-- Status Cards --}}
            @php
                $statusCfg = [
                    'pending'   => ['#f59e0b','rgba(245,158,11,.08)','fas fa-clock'],
                    'approved'  => ['#2563eb','rgba(37,99,235,.08)','fas fa-thumbs-up'],
                    'active'    => ['#16a34a','rgba(22,163,74,.08)','fas fa-bolt'],
                    'completed' => ['#6b7280','rgba(107,114,128,.08)','fas fa-check-circle'],
                    'rejected'  => ['#dc2626','rgba(220,38,38,.08)','fas fa-times-circle'],
                ];
            @endphp
            <div class="lr-status-grid">
                @foreach ($statusCfg as $st => $cfg)
                    @php $d = $loansByStatus[$st] ?? null; @endphp
                    <div class="lr-sc">
                        <div class="lr-sc-icon" style="background:{{ $cfg[1] }};color:{{ $cfg[0] }};"><i class="{{ $cfg[2] }}"></i></div>
                        <div>
                            <div class="lr-sc-label">{{ ucfirst($st) }}</div>
                            <div class="lr-sc-val" style="color:{{ $cfg[0] }};">{{ $d->count ?? 0 }}</div>
                            <div class="lr-sc-amt" style="color:{{ $cfg[0] }};">K{{ number_format($d->total ?? 0, 0) }}</div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                {{-- Left: Loan List --}}
                <div class="col-lg-8">
                    <div class="lr-card">
                        <div class="lr-card-header">
                            <div class="lr-card-title"><i class="fas fa-list-alt"></i> Loan Details</div>
                            <span class="lr-badge" style="background:rgba(234,88,12,.06);color:var(--lr-orange);border:1px solid rgba(234,88,12,.15);">{{ $loansList->count() }} shown (max 50)</span>
                        </div>
                        <div style="overflow-x:auto;">
                            <table class="lr-table">
                                <thead><tr><th>Borrower</th><th>Circle</th><th>Amount</th><th>Payable</th><th>Outstanding</th><th>Repayments</th><th>Status</th><th>Date</th></tr></thead>
                                <tbody>
                                    @forelse ($loansList as $loan)
                                        @php $sc = ['pending'=>['rgba(245,158,11,.06)','#92400e','rgba(245,158,11,.2)'],'approved'=>['rgba(37,99,235,.06)','#1e40af','rgba(37,99,235,.2)'],'active'=>['rgba(22,163,74,.06)','#166534','rgba(22,163,74,.2)'],'completed'=>['rgba(107,114,128,.06)','#374151','rgba(107,114,128,.2)'],'rejected'=>['rgba(220,38,38,.06)','#991b1b','rgba(220,38,38,.2)']][$loan->status] ?? ['#f8fafc','#475569','#e2e8f0']; @endphp
                                        <tr>
                                            <td>
                                                <div style="display:flex;align-items:center;gap:.4rem;">
                                                    <div class="lr-avatar">{{ strtoupper(substr($loan->borrower->name ?? '?', 0, 1)) }}</div>
                                                    <strong style="font-size:.82rem;">{{ Str::limit($loan->borrower->name ?? '--', 18) }}</strong>
                                                </div>
                                            </td>
                                            <td style="font-size:.78rem;color:var(--lr-faint);">{{ $loan->month->circle->name ?? '--' }}</td>
                                            <td style="font-weight:700;">K{{ number_format($loan->amount, 2) }}</td>
                                            <td style="color:var(--lr-muted);">K{{ number_format($loan->total_payable, 2) }}</td>
                                            <td style="font-weight:700;color:{{ $loan->outstanding_balance > 0 ? 'var(--lr-red)' : 'var(--lr-green)' }};">K{{ number_format($loan->outstanding_balance, 2) }}</td>
                                            <td style="text-align:center;">{{ $loan->repayments_count }}</td>
                                            <td><span class="lr-badge" style="background:{{ $sc[0] }};color:{{ $sc[1] }};border:1px solid {{ $sc[2] }};"><i class="fas fa-circle" style="font-size:.25rem;"></i> {{ ucfirst($loan->status) }}</span></td>
                                            <td style="font-size:.76rem;color:var(--lr-faint);">{{ $loan->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="8"><div class="lr-empty"><i class="fas fa-hand-holding-usd"></i><p>No loans found for the selected filters.</p></div></td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Right: Sidebar --}}
                <div class="col-lg-4">
                    {{-- Repayment Gauge --}}
                    <div class="lr-card" style="background:linear-gradient(135deg,var(--lr-navy),var(--lr-navy-light));border:none;">
                        <div class="lr-gauge">
                            <div style="font-size:.65rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:rgba(255,255,255,.4);">Repayment Rate</div>
                            <div class="lr-gauge-val" style="color:#fff;">{{ $portfolio['repaymentRate'] }}%</div>
                            <div class="lr-gauge-bar" style="background:rgba(255,255,255,.15);"><div class="lr-gauge-fill" style="width:{{ min($portfolio['repaymentRate'], 100) }}%;background:var(--lr-amber);"></div></div>
                            <div style="display:flex;justify-content:space-between;font-size:.72rem;color:rgba(255,255,255,.4);margin-top:.3rem;">
                                <span>K{{ number_format($portfolio['totalRepaid'], 0) }} repaid</span>
                                <span>K{{ number_format($portfolio['totalPayable'], 0) }} payable</span>
                            </div>
                        </div>
                    </div>

                    {{-- Top Borrowers --}}
                    <div class="lr-card">
                        <div class="lr-card-header">
                            <div class="lr-card-title"><i class="fas fa-trophy"></i> Top Borrowers</div>
                        </div>
                        <div style="padding:1rem 1.5rem;">
                            @forelse ($topBorrowers as $i => $tb)
                                @php $rc = [0=>['#fef3c7','#92400e'],1=>['#f1f5f9','#475569'],2=>['#fff7ed','#9a3412']][$i] ?? ['#f8fafc','var(--lr-faint)']; @endphp
                                <div style="display:flex;align-items:center;gap:.55rem;padding:.45rem 0;{{ $i < count($topBorrowers) - 1 ? 'border-bottom:1px solid #f5f7fa;' : '' }}">
                                    <div class="lr-rank" style="background:{{ $rc[0] }};color:{{ $rc[1] }};">{{ $i + 1 }}</div>
                                    <div class="lr-avatar">{{ strtoupper(substr($tb->borrower->name ?? '?', 0, 1)) }}</div>
                                    <div style="flex:1;min-width:0;">
                                        <div style="font-size:.82rem;font-weight:700;color:var(--lr-text);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $tb->borrower->name ?? '--' }}</div>
                                        <div style="font-size:.68rem;color:var(--lr-faint);">{{ $tb->loan_count }} loan{{ $tb->loan_count != 1 ? 's' : '' }}</div>
                                    </div>
                                    <div style="text-align:right;">
                                        <div style="font-size:.82rem;font-weight:800;color:var(--lr-orange);">K{{ number_format($tb->total_amount, 0) }}</div>
                                        @if ($tb->outstanding > 0)
                                            <div style="font-size:.68rem;color:var(--lr-red);">K{{ number_format($tb->outstanding, 0) }} owed</div>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="lr-empty"><i class="fas fa-user-tie"></i><p>No borrower data.</p></div>
                            @endforelse
                        </div>
                    </div>

                    {{-- Penalties Summary --}}
                    <div class="lr-card">
                        <div style="padding:1rem 1.5rem;display:flex;align-items:center;justify-content:space-between;">
                            <div>
                                <div style="font-size:.62rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--lr-faint);">Total Penalties</div>
                                <div style="font-size:1.2rem;font-weight:800;color:var(--lr-red);">K{{ number_format($portfolio['totalPenalties'], 2) }}</div>
                            </div>
                            <div class="lr-stat-icon" style="background:rgba(220,38,38,.08);color:var(--lr-red);"><i class="fas fa-gavel"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Repayment Performance --}}
            <div class="lr-card">
                <div class="lr-card-header">
                    <div class="lr-card-title"><i class="fas fa-chart-line"></i> Repayment Performance by Borrower</div>
                </div>
                <div style="padding:1rem 1.5rem;">
                    @forelse ($repaymentPerf as $p)
                        <div style="display:flex;align-items:center;gap:.75rem;padding:.55rem 0;{{ !$loop->last ? 'border-bottom:1px solid #f5f7fa;' : '' }}">
                            <div style="width:130px;font-size:.82rem;font-weight:700;color:var(--lr-text);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $p['name'] }}</div>
                            <div style="font-size:.72rem;color:var(--lr-faint);width:50px;">{{ $p['loans'] }} loan{{ $p['loans'] != 1 ? 's' : '' }}</div>
                            <div class="lr-perf" style="flex:1;">
                                <div class="lr-perf-track">
                                    <div class="lr-perf-fill" style="width:{{ min($p['rate'], 100) }}%;background:{{ $p['rate'] >= 80 ? 'var(--lr-green)' : ($p['rate'] >= 50 ? 'var(--lr-amber)' : 'var(--lr-red)') }};"></div>
                                </div>
                                <div class="lr-perf-pct" style="color:{{ $p['rate'] >= 80 ? 'var(--lr-green)' : ($p['rate'] >= 50 ? 'var(--lr-amber)' : 'var(--lr-red)') }};">{{ $p['rate'] }}%</div>
                            </div>
                            <div style="font-size:.78rem;color:var(--lr-muted);width:90px;text-align:right;">K{{ number_format($p['outstanding'], 0) }} owed</div>
                        </div>
                    @empty
                        <div class="lr-empty"><i class="fas fa-chart-line"></i><p>No repayment performance data.</p></div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
