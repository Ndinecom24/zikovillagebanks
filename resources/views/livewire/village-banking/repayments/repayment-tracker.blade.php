<div>
    @push('custom-styles')
    <style>
        :root {
            --rt-navy:#1E3A5F; --rt-navy-light:#2B6B96; --rt-amber:#D97706; --rt-amber-light:#F59E0B;
            --rt-bg:#f4f6fa; --rt-card:#fff; --rt-border:#edf0f7; --rt-text:#1e293b;
            --rt-muted:#64748b; --rt-faint:#94a3b8; --rt-green:#16a34a; --rt-red:#dc2626; --rt-blue:#2563eb; --rt-purple:#7c3aed; --rt-radius:16px;
        }
        .rt-page{background:var(--rt-bg);min-height:100vh;}

        /* Hero */
        .rt-hero{background:linear-gradient(135deg,var(--rt-navy) 0%,#234b78 50%,var(--rt-navy-light) 100%);padding:1.75rem 0 6rem;position:relative;overflow:hidden;}
        .rt-hero::before{content:'';position:absolute;width:600px;height:600px;top:-60%;right:-8%;background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%);border-radius:50%;pointer-events:none;}
        .rt-hero-inner{position:relative;z-index:2;padding:0 1.5rem;}
        .rt-breadcrumb{display:flex;gap:.5rem;list-style:none;padding:0;margin:0 0 .75rem;font-size:.82rem;}
        .rt-breadcrumb a{color:rgba(255,255,255,.55);text-decoration:none;}
        .rt-breadcrumb a:hover{color:rgba(255,255,255,.85);}
        .rt-breadcrumb .active{color:var(--rt-amber-light);font-weight:600;}
        .rt-breadcrumb .sep{color:rgba(255,255,255,.25);}
        .rt-hero-row{display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:.75rem;}
        .rt-hero-title h1{color:#fff;font-size:1.6rem;font-weight:800;margin:0;}
        .rt-hero-title h1 i{color:var(--rt-amber);margin-right:.5rem;}
        .rt-hero-sub{color:rgba(255,255,255,.55);font-size:.88rem;margin:.25rem 0 0;}
        .rt-hero-btn{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1.25rem;border-radius:10px;font-size:.82rem;font-weight:700;text-decoration:none;transition:all .2s;background:var(--rt-amber);color:#fff;border:none;}
        .rt-hero-btn:hover{background:var(--rt-amber-light);color:#fff;text-decoration:none;transform:translateY(-1px);box-shadow:0 4px 12px rgba(217,119,6,.25);}

        /* Content */
        .rt-content{margin-top:-4rem;position:relative;z-index:10;padding:0 1.5rem 2rem;}

        /* Stats */
        .rt-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.25rem;}
        @media(max-width:768px){.rt-stats{grid-template-columns:repeat(2,1fr);}}
        .rt-stat{background:var(--rt-card);border-radius:var(--rt-radius);border:1px solid var(--rt-border);box-shadow:0 2px 12px rgba(0,0,0,.04);padding:1.1rem 1.25rem;display:flex;align-items:center;justify-content:space-between;transition:all .2s;}
        .rt-stat:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(0,0,0,.06);}
        .rt-stat-label{font-size:.62rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--rt-faint);}
        .rt-stat-value{font-size:1.5rem;font-weight:800;color:var(--rt-text);margin-top:.1rem;}
        .rt-stat-icon{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1rem;flex-shrink:0;}

        /* Card */
        .rt-card{background:var(--rt-card);border-radius:var(--rt-radius);border:1px solid var(--rt-border);box-shadow:0 2px 12px rgba(0,0,0,.04);overflow:hidden;}
        .rt-card-header{padding:1rem 1.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;border-bottom:1px solid var(--rt-border);}
        .rt-card-title{font-size:.95rem;font-weight:700;color:var(--rt-text);display:flex;align-items:center;gap:.4rem;}
        .rt-card-title i{color:var(--rt-amber);font-size:.8rem;}
        .rt-toolbar{display:flex;align-items:center;flex-wrap:wrap;gap:.6rem;}
        .rt-search{position:relative;}
        .rt-search i{position:absolute;left:.75rem;top:50%;transform:translateY(-50%);font-size:.72rem;color:var(--rt-faint);}
        .rt-search input{padding:.45rem .75rem .45rem 2rem;border:1px solid var(--rt-border);border-radius:10px;font-size:.82rem;background:#fafbfd;width:200px;transition:border .2s;}
        .rt-search input:focus{outline:none;border-color:var(--rt-amber);background:#fff;box-shadow:0 0 0 3px rgba(217,119,6,.08);}
        .rt-select{padding:.45rem .75rem;border:1px solid var(--rt-border);border-radius:10px;font-size:.82rem;background:#fafbfd;cursor:pointer;}
        .rt-select:focus{outline:none;border-color:var(--rt-amber);}

        /* Table */
        .rt-table{width:100%;border-collapse:collapse;}
        .rt-table thead th{font-size:.62rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--rt-faint);padding:.7rem 1rem;border-bottom:1px solid var(--rt-border);background:#fafbfd;white-space:nowrap;}
        .rt-table tbody td{padding:.7rem 1rem;border-bottom:1px solid #f5f7fa;font-size:.84rem;vertical-align:middle;}
        .rt-table tbody tr:last-child td{border-bottom:none;}
        .rt-table tbody tr:hover{background:#fafbfd;}

        /* Avatar */
        .rt-avatar{width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.65rem;flex-shrink:0;background:linear-gradient(135deg,var(--rt-navy),var(--rt-navy-light));color:#fff;}
        .rt-member-cell{display:flex;align-items:center;gap:.55rem;}
        .rt-member-name{font-weight:700;color:var(--rt-text);font-size:.86rem;}

        /* Badge */
        .rt-badge{display:inline-flex;align-items:center;padding:.2rem .55rem;border-radius:8px;font-size:.68rem;font-weight:700;}

        /* Progress */
        .rt-progress-wrap{display:flex;align-items:center;gap:.5rem;width:120px;}
        .rt-progress-bar{flex:1;height:6px;border-radius:6px;background:var(--rt-border);overflow:hidden;}
        .rt-progress-fill{height:100%;border-radius:6px;background:var(--rt-green);transition:width .3s;}
        .rt-progress-pct{font-size:.72rem;color:var(--rt-faint);min-width:28px;text-align:right;font-weight:700;}

        /* Action buttons */
        .rt-actions{display:flex;gap:.35rem;}
        .rt-act{width:30px;height:30px;border-radius:8px;display:flex;align-items:center;justify-content:center;border:1px solid var(--rt-border);background:#fafbfd;color:var(--rt-muted);cursor:pointer;font-size:.7rem;transition:all .15s;text-decoration:none;}
        .rt-act:hover{border-color:var(--rt-blue);color:var(--rt-blue);background:rgba(37,99,235,.05);}
        .rt-act-pay:hover{border-color:var(--rt-green);color:var(--rt-green);background:rgba(22,163,74,.05);}

        /* Footer */
        .rt-footer{padding:.85rem 1.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;border-top:1px solid var(--rt-border);}
        .rt-footer-info{font-size:.78rem;color:var(--rt-faint);}

        /* Empty */
        .rt-empty{text-align:center;padding:3rem 1rem;}
        .rt-empty i{font-size:2.5rem;opacity:.12;display:block;margin-bottom:.75rem;color:var(--rt-navy);}
        .rt-empty p{font-size:.88rem;color:var(--rt-muted);margin:0;}
        .rt-empty a{color:var(--rt-amber);font-weight:600;text-decoration:none;}
        .rt-empty a:hover{text-decoration:underline;}

        @keyframes rtSlide{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
        .rt-animate{animation:rtSlide .3s ease;}
        @media(max-width:768px){.rt-content{padding:0 .75rem 1.5rem;}.rt-search input{width:150px;}}
    </style>
    @endpush

    @can('view-repayments')
    <section class="content rt-page">
        {{-- Hero --}}
        <div class="rt-hero">
            <div class="rt-hero-inner container-fluid">
                <ul class="rt-breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li class="active">Repayment Tracker</li>
                </ul>
                <div class="rt-hero-row">
                    <div class="rt-hero-title">
                        <h1><i class="fas fa-chart-line"></i>Repayment Tracker</h1>
                        <p class="rt-hero-sub">Monitor loan repayment progress and outstanding balances</p>
                    </div>
                    <a href="{{ route('repayments.index') }}" class="rt-hero-btn">
                        <i class="fas fa-hand-holding-usd"></i> Record Repayment
                    </a>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="rt-content container-fluid rt-animate">

            {{-- Stats --}}
            <div class="rt-stats">
                <div class="rt-stat">
                    <div>
                        <div class="rt-stat-label">Active Loans</div>
                        <div class="rt-stat-value">{{ $this->activeLoansCount }}</div>
                    </div>
                    <div class="rt-stat-icon" style="background:rgba(217,119,6,.08);color:var(--rt-amber);"><i class="fas fa-file-invoice-dollar"></i></div>
                </div>
                <div class="rt-stat">
                    <div>
                        <div class="rt-stat-label">Total Outstanding</div>
                        <div class="rt-stat-value" style="color:var(--rt-red);">K{{ number_format($this->totalOutstanding, 2) }}</div>
                    </div>
                    <div class="rt-stat-icon" style="background:rgba(220,38,38,.08);color:var(--rt-red);"><i class="fas fa-exclamation-circle"></i></div>
                </div>
                <div class="rt-stat">
                    <div>
                        <div class="rt-stat-label">Total Repaid</div>
                        <div class="rt-stat-value" style="color:var(--rt-green);">K{{ number_format($this->totalRepaid, 2) }}</div>
                    </div>
                    <div class="rt-stat-icon" style="background:rgba(22,163,74,.08);color:var(--rt-green);"><i class="fas fa-check-double"></i></div>
                </div>
                <div class="rt-stat">
                    <div>
                        <div class="rt-stat-label">Total Penalties</div>
                        <div class="rt-stat-value" style="color:var(--rt-purple);">K{{ number_format($this->totalPenalties, 2) }}</div>
                    </div>
                    <div class="rt-stat-icon" style="background:rgba(124,58,237,.08);color:var(--rt-purple);"><i class="fas fa-gavel"></i></div>
                </div>
            </div>

            {{-- Table --}}
            <div class="rt-card">
                <div class="rt-card-header">
                    <div class="rt-card-title"><i class="fas fa-list-alt"></i> Loan Repayment Overview</div>
                    <div class="rt-toolbar">
                        @include('partials.village-bank-selector')
                        <select wire:model.live="circleFilter" class="rt-select">
                            <option value="">All Circles</option>
                            @foreach ($this->circles as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>
                        <select wire:model.live="statusFilter" class="rt-select">
                            <option value="">All Statuses</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="active">Active</option>
                            <option value="completed">Completed</option>
                        </select>
                        <div class="rt-search">
                            <i class="fas fa-search"></i>
                            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search borrower...">
                        </div>
                        <select wire:model.live="perPage" class="rt-select" style="width:70px;">
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>

                <div style="overflow-x:auto;">
                    <table class="rt-table">
                        <thead>
                            <tr>
                                <th>Borrower</th>
                                <th>Circle</th>
                                <th>Loan Amt</th>
                                <th>Payable</th>
                                <th>Outstanding</th>
                                <th>Progress</th>
                                <th>Status</th>
                                <th>Last Payment</th>
                                <th style="width:80px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($loans as $loan)
                                @php
                                    $repaidPct = $loan->total_payable > 0
                                        ? min(100, round((($loan->total_payable - $loan->outstanding_balance) / $loan->total_payable) * 100))
                                        : 0;
                                    $lastRp = $loan->repayments->sortByDesc('created_at')->first();
                                    $sc = ['pending'=>['#fffbeb','#92400e','#fde68a'],'approved'=>['#eff6ff','#1e40af','#bfdbfe'],'active'=>['#f0fdf4','#166534','#bbf7d0'],'completed'=>['#f3f4f6','#374151','#e5e7eb'],'rejected'=>['#fef2f2','#991b1b','#fecaca']][$loan->status] ?? ['#f3f4f6','#374151','#e5e7eb'];
                                @endphp
                                <tr>
                                    <td>
                                        <div class="rt-member-cell">
                                            @php
                                                $parts = explode(' ', trim($loan->borrower->name ?? ''));
                                                $initials = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
                                            @endphp
                                            <div class="rt-avatar">{{ $initials }}</div>
                                            <span class="rt-member-name">{{ $loan->borrower->name ?? '--' }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="rt-badge" style="background:rgba(30,58,95,.06);color:var(--rt-navy);border:1px solid rgba(30,58,95,.15);">
                                            {{ $loan->month->circle->name ?? '--' }}
                                        </span>
                                    </td>
                                    <td style="font-weight:700;">K{{ number_format($loan->amount, 2) }}</td>
                                    <td>K{{ number_format($loan->total_payable, 2) }}</td>
                                    <td style="font-weight:700;color:var(--rt-red);">K{{ number_format($loan->outstanding_balance, 2) }}</td>
                                    <td>
                                        <div class="rt-progress-wrap">
                                            <div class="rt-progress-bar"><div class="rt-progress-fill" style="width:{{ $repaidPct }}%;{{ $repaidPct >= 100 ? 'background:var(--rt-green);' : '' }}"></div></div>
                                            <span class="rt-progress-pct">{{ $repaidPct }}%</span>
                                        </div>
                                    </td>
                                    <td><span class="rt-badge" style="background:{{ $sc[0] }};color:{{ $sc[1] }};border:1px solid {{ $sc[2] }};">{{ ucfirst($loan->status) }}</span></td>
                                    <td style="font-size:.78rem;color:var(--rt-faint);">{{ $lastRp ? $lastRp->created_at->format('d M Y') : '--' }}</td>
                                    <td>
                                        <div class="rt-actions">
                                            <a href="{{ route('repayments.show', $loan->id) }}" class="rt-act" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">
                                        <div class="rt-empty">
                                            <i class="fas fa-file-invoice-dollar"></i>
                                            <p>No loans found. <a href="{{ route('repayments.index') }}">Record a repayment</a></p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="rt-footer">
                    <span class="rt-footer-info">Showing {{ $loans->firstItem() ?? 0 }} - {{ $loans->lastItem() ?? 0 }} of {{ $loans->total() }}</span>
                    {{ $loans->links() }}
                </div>
            </div>
        </div>
    </section>
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
