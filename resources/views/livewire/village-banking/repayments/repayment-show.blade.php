<div>
    @push('custom-styles')
    <style>
        :root {
            --rs-navy:#1E3A5F;--rs-navy-light:#2B6B96;--rs-amber:#D97706;--rs-amber-light:#F59E0B;
            --rs-bg:#f4f6fa;--rs-card:#fff;--rs-border:#edf0f7;--rs-text:#1e293b;
            --rs-muted:#64748b;--rs-faint:#94a3b8;--rs-green:#16a34a;--rs-red:#dc2626;--rs-blue:#2563eb;--rs-purple:#7c3aed;--rs-radius:16px;
        }
        .rs-page{background:var(--rs-bg);min-height:100vh;}

        /* Hero */
        .rs-hero{background:linear-gradient(135deg,var(--rs-navy) 0%,#234b78 50%,var(--rs-navy-light) 100%);padding:1.75rem 0 6rem;position:relative;overflow:hidden;}
        .rs-hero::before{content:'';position:absolute;width:600px;height:600px;top:-60%;right:-8%;background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%);border-radius:50%;pointer-events:none;}
        .rs-hero-inner{position:relative;z-index:2;padding:0 1.5rem;}
        .rs-breadcrumb{display:flex;gap:.5rem;list-style:none;padding:0;margin:0 0 .75rem;font-size:.82rem;}
        .rs-breadcrumb a{color:rgba(255,255,255,.55);text-decoration:none;}
        .rs-breadcrumb a:hover{color:rgba(255,255,255,.85);}
        .rs-breadcrumb .active{color:var(--rs-amber-light);font-weight:600;}
        .rs-breadcrumb .sep{color:rgba(255,255,255,.25);}
        .rs-hero-row{display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:.75rem;}
        .rs-hero-title h1{color:#fff;font-size:1.5rem;font-weight:800;margin:0;}
        .rs-hero-title h1 i{color:var(--rs-amber);margin-right:.5rem;}
        .rs-hero-sub{color:rgba(255,255,255,.55);font-size:.85rem;margin:.25rem 0 0;}
        .rs-hero-actions{display:flex;gap:.5rem;flex-wrap:wrap;}
        .rs-hero-btn{display:inline-flex;align-items:center;gap:.4rem;padding:.5rem 1.1rem;border-radius:10px;font-size:.82rem;font-weight:700;text-decoration:none;transition:all .2s;border:none;cursor:pointer;}
        .rs-hero-btn-primary{background:var(--rs-amber);color:#fff;}
        .rs-hero-btn-primary:hover{background:var(--rs-amber-light);color:#fff;text-decoration:none;transform:translateY(-1px);box-shadow:0 4px 12px rgba(217,119,6,.25);}
        .rs-hero-btn-outline{background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);color:rgba(255,255,255,.8);}
        .rs-hero-btn-outline:hover{background:rgba(255,255,255,.15);color:#fff;text-decoration:none;}

        /* Content */
        .rs-content{margin-top:-4rem;position:relative;z-index:10;padding:0 1.5rem 2rem;}
        .rs-grid{display:grid;grid-template-columns:340px 1fr;gap:1.25rem;}
        @media(max-width:992px){.rs-grid{grid-template-columns:1fr;}}

        /* Sidebar */
        .rs-sidebar{display:flex;flex-direction:column;gap:1.25rem;}
        .rs-card{background:var(--rs-card);border-radius:var(--rs-radius);border:1px solid var(--rs-border);box-shadow:0 2px 12px rgba(0,0,0,.04);overflow:hidden;}
        .rs-card-header{padding:1rem 1.25rem;display:flex;align-items:center;gap:.5rem;border-bottom:1px solid var(--rs-border);}
        .rs-card-title{font-size:.88rem;font-weight:700;color:var(--rs-text);}
        .rs-card-title i{color:var(--rs-amber);font-size:.75rem;}

        /* Profile card */
        .rs-profile{text-align:center;padding:1.75rem 1.25rem;}
        .rs-avatar{width:60px;height:60px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:1.1rem;margin:0 auto .75rem;background:linear-gradient(135deg,var(--rs-navy),var(--rs-navy-light));color:#fff;box-shadow:0 4px 12px rgba(30,58,95,.18);}
        .rs-profile h3{font-size:1.05rem;font-weight:800;color:var(--rs-text);margin:0 0 .15rem;}
        .rs-profile p{color:var(--rs-faint);font-size:.78rem;margin:0 0 1rem;}
        .rs-badge{display:inline-flex;align-items:center;gap:.3rem;padding:.25rem .65rem;border-radius:8px;font-size:.7rem;font-weight:700;}
        .rs-progress-card{padding:1.25rem;}
        .rs-progress-info{display:flex;justify-content:space-between;align-items:center;margin-bottom:.5rem;}
        .rs-progress-label{font-size:.75rem;color:var(--rs-faint);font-weight:600;}
        .rs-progress-pct{font-size:1.1rem;font-weight:800;color:var(--rs-green);}
        .rs-progress-bar{width:100%;height:10px;background:var(--rs-border);border-radius:10px;overflow:hidden;}
        .rs-progress-fill{height:100%;border-radius:10px;background:linear-gradient(90deg,var(--rs-green),#22c55e);transition:width .4s;}
        .rs-progress-amounts{display:flex;justify-content:space-between;margin-top:.4rem;}
        .rs-progress-amounts span{font-size:.68rem;color:var(--rs-faint);}
        .rs-progress-amounts strong{color:var(--rs-text);}

        /* Info list */
        .rs-info{padding:.75rem 1.25rem;}
        .rs-info-row{display:flex;align-items:center;justify-content:space-between;padding:.55rem 0;border-bottom:1px solid #f8f9fb;}
        .rs-info-row:last-child{border-bottom:none;}
        .rs-info-label{font-size:.76rem;color:var(--rs-faint);display:flex;align-items:center;gap:.35rem;}
        .rs-info-label i{font-size:.6rem;width:14px;text-align:center;color:var(--rs-navy);}
        .rs-info-value{font-size:.82rem;font-weight:700;color:var(--rs-text);}

        /* Main area */
        .rs-main{display:flex;flex-direction:column;gap:1.25rem;}

        /* Summary stats */
        .rs-summary{display:grid;grid-template-columns:repeat(4,1fr);gap:.75rem;}
        @media(max-width:768px){.rs-summary{grid-template-columns:repeat(2,1fr);}}
        .rs-stat{background:var(--rs-card);border-radius:var(--rs-radius);border:1px solid var(--rs-border);box-shadow:0 2px 12px rgba(0,0,0,.04);padding:1rem 1.1rem;}
        .rs-stat-label{font-size:.58rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--rs-faint);}
        .rs-stat-value{font-size:1.3rem;font-weight:800;color:var(--rs-text);margin-top:.1rem;}

        /* Table card */
        .rs-table{width:100%;border-collapse:collapse;}
        .rs-table thead th{font-size:.62rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--rs-faint);padding:.7rem 1rem;border-bottom:1px solid var(--rs-border);background:#fafbfd;white-space:nowrap;}
        .rs-table tbody td{padding:.7rem 1rem;border-bottom:1px solid #f5f7fa;font-size:.84rem;vertical-align:middle;}
        .rs-table tbody tr:last-child td{border-bottom:none;}
        .rs-table tbody tr:hover{background:#fafbfd;}

        /* Timeline */
        .rs-timeline{padding:1rem 1.25rem;}
        .rs-tl-item{display:flex;gap:.75rem;padding-bottom:1.25rem;position:relative;}
        .rs-tl-item:last-child{padding-bottom:0;}
        .rs-tl-item::before{content:'';position:absolute;left:15px;top:28px;bottom:0;width:2px;background:var(--rs-border);}
        .rs-tl-item:last-child::before{display:none;}
        .rs-tl-dot{width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.65rem;flex-shrink:0;z-index:2;}
        .rs-tl-body{flex:1;}
        .rs-tl-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:.15rem;}
        .rs-tl-title{font-size:.82rem;font-weight:700;color:var(--rs-text);}
        .rs-tl-date{font-size:.68rem;color:var(--rs-faint);}
        .rs-tl-desc{font-size:.76rem;color:var(--rs-muted);}

        /* Empty */
        .rs-empty{text-align:center;padding:2.5rem 1rem;}
        .rs-empty i{font-size:2rem;opacity:.12;display:block;margin-bottom:.5rem;color:var(--rs-navy);}
        .rs-empty p{font-size:.82rem;color:var(--rs-muted);margin:0;}

        @keyframes rsSlide{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
        .rs-animate{animation:rsSlide .3s ease;}
        @media(max-width:768px){.rs-content{padding:0 .75rem 1.5rem;}.rs-summary{grid-template-columns:1fr 1fr;}}
    </style>
    @endpush

    @can('view-repayments')
    @php
        $loan      = $loan;
        $borrower  = $loan->borrower;
        $circle    = $loan->month->circle ?? null;
        $bank      = $circle->villageBank ?? null;
        $repayments = $loan->repayments;
        $penalties  = $loan->penalties;
        $repaid    = $this->repaidAmount;
        $pct       = $this->repaidPercent;
        $totalPen  = $this->totalPenalties;

        $parts    = explode(' ', trim($borrower->name ?? ''));
        $initials = strtoupper(substr($parts[0],0,1) . (isset($parts[1]) ? substr($parts[1],0,1) : ''));

        $sc = ['pending'=>['#fffbeb','#92400e','#fde68a'],'approved'=>['#eff6ff','#1e40af','#bfdbfe'],'active'=>['#f0fdf4','#166534','#bbf7d0'],'completed'=>['#f3f4f6','#374151','#e5e7eb'],'rejected'=>['#fef2f2','#991b1b','#fecaca']][$loan->status] ?? ['#f3f4f6','#374151','#e5e7eb'];
    @endphp

    <section class="content rs-page">
        {{-- Hero --}}
        <div class="rs-hero">
            <div class="rs-hero-inner container-fluid">
                <ul class="rs-breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('repayments.tracker') }}">Tracker</a></li>
                    <li class="sep">/</li>
                    <li class="active">{{ $borrower->name ?? 'Loan' }} #{{ $loan->id }}</li>
                </ul>
                <div class="rs-hero-row">
                    <div class="rs-hero-title">
                        <h1><i class="fas fa-receipt"></i>Loan Repayment Details</h1>
                        <p class="rs-hero-sub">{{ $borrower->name ?? '--' }} &mdash; {{ $circle->name ?? '--' }}</p>
                    </div>
                    <div class="rs-hero-actions">
                        <a href="{{ route('repayments.index') }}" class="rs-hero-btn rs-hero-btn-primary">
                            <i class="fas fa-hand-holding-usd"></i> Record Payment
                        </a>
                        <a href="{{ route('repayments.tracker') }}" class="rs-hero-btn rs-hero-btn-outline">
                            <i class="fas fa-arrow-left"></i> Back to Tracker
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="rs-content container-fluid rs-animate">
            <div class="rs-grid">

                {{-- ██ LEFT SIDEBAR ██ --}}
                <div class="rs-sidebar">

                    {{-- Borrower profile --}}
                    <div class="rs-card">
                        <div class="rs-profile">
                            <div class="rs-avatar">{{ $initials }}</div>
                            <h3>{{ $borrower->name ?? '--' }}</h3>
                            <p>{{ $borrower->email ?? '--' }}</p>
                            <span class="rs-badge" style="background:{{ $sc[0] }};color:{{ $sc[1] }};border:1px solid {{ $sc[2] }};">
                                <i class="fas fa-circle" style="font-size:.35rem;"></i> {{ ucfirst($loan->status) }}
                            </span>
                        </div>
                    </div>

                    {{-- Repayment progress --}}
                    <div class="rs-card">
                        <div class="rs-card-header"><div class="rs-card-title"><i class="fas fa-tasks"></i> Repayment Progress</div></div>
                        <div class="rs-progress-card">
                            <div class="rs-progress-info">
                                <span class="rs-progress-label">Overall completion</span>
                                <span class="rs-progress-pct" style="{{ $pct < 50 ? 'color:var(--rs-red);' : ($pct < 100 ? 'color:var(--rs-amber);' : '') }}">{{ $pct }}%</span>
                            </div>
                            <div class="rs-progress-bar">
                                <div class="rs-progress-fill" style="width:{{ $pct }}%;{{ $pct < 50 ? 'background:linear-gradient(90deg,var(--rs-red),#ef4444);' : ($pct < 100 ? 'background:linear-gradient(90deg,var(--rs-amber),var(--rs-amber-light));' : '') }}"></div>
                            </div>
                            <div class="rs-progress-amounts">
                                <span><strong>K{{ number_format($repaid, 2) }}</strong> repaid</span>
                                <span><strong>K{{ number_format($loan->total_payable, 2) }}</strong> total</span>
                            </div>
                        </div>
                    </div>

                    {{-- Loan details --}}
                    <div class="rs-card">
                        <div class="rs-card-header"><div class="rs-card-title"><i class="fas fa-info-circle"></i> Loan Details</div></div>
                        <div class="rs-info">
                            <div class="rs-info-row">
                                <span class="rs-info-label"><i class="fas fa-hashtag"></i> Loan ID</span>
                                <span class="rs-info-value">#{{ $loan->id }}</span>
                            </div>
                            <div class="rs-info-row">
                                <span class="rs-info-label"><i class="fas fa-coins"></i> Principal</span>
                                <span class="rs-info-value">K{{ number_format($loan->amount, 2) }}</span>
                            </div>
                            <div class="rs-info-row">
                                <span class="rs-info-label"><i class="fas fa-percent"></i> Interest Rate</span>
                                <span class="rs-info-value">{{ $loan->interest_rate }}%</span>
                            </div>
                            <div class="rs-info-row">
                                <span class="rs-info-label"><i class="fas fa-calculator"></i> Total Payable</span>
                                <span class="rs-info-value">K{{ number_format($loan->total_payable, 2) }}</span>
                            </div>
                            <div class="rs-info-row">
                                <span class="rs-info-label"><i class="fas fa-exclamation-triangle"></i> Outstanding</span>
                                <span class="rs-info-value" style="color:var(--rs-red);">K{{ number_format($loan->outstanding_balance, 2) }}</span>
                            </div>
                            <div class="rs-info-row">
                                <span class="rs-info-label"><i class="fas fa-clock"></i> Duration</span>
                                <span class="rs-info-value">{{ $loan->duration }} month{{ $loan->duration != 1 ? 's' : '' }}</span>
                            </div>
                            <div class="rs-info-row">
                                <span class="rs-info-label"><i class="fas fa-users"></i> Circle</span>
                                <span class="rs-info-value">{{ $circle->name ?? '--' }}</span>
                            </div>
                            @if($bank)
                            <div class="rs-info-row">
                                <span class="rs-info-label"><i class="fas fa-university"></i> Village Bank</span>
                                <span class="rs-info-value">{{ $bank->name }}</span>
                            </div>
                            @endif
                            <div class="rs-info-row">
                                <span class="rs-info-label"><i class="fas fa-calendar-alt"></i> Created</span>
                                <span class="rs-info-value">{{ $loan->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ██ MAIN AREA ██ --}}
                <div class="rs-main">

                    {{-- Summary stats --}}
                    <div class="rs-summary">
                        <div class="rs-stat">
                            <div class="rs-stat-label">Total Repaid</div>
                            <div class="rs-stat-value" style="color:var(--rs-green);">K{{ number_format($repaid, 2) }}</div>
                        </div>
                        <div class="rs-stat">
                            <div class="rs-stat-label">Outstanding</div>
                            <div class="rs-stat-value" style="color:var(--rs-red);">K{{ number_format($loan->outstanding_balance, 2) }}</div>
                        </div>
                        <div class="rs-stat">
                            <div class="rs-stat-label">Payments Made</div>
                            <div class="rs-stat-value">{{ $repayments->count() }}</div>
                        </div>
                        <div class="rs-stat">
                            <div class="rs-stat-label">Penalties</div>
                            <div class="rs-stat-value" style="color:var(--rs-purple);">K{{ number_format($totalPen, 2) }}</div>
                        </div>
                    </div>

                    {{-- Repayment history table --}}
                    <div class="rs-card">
                        <div class="rs-card-header"><div class="rs-card-title"><i class="fas fa-history"></i> Repayment History</div></div>
                        @if($repayments->count())
                            <div style="overflow-x:auto;">
                                <table class="rs-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Amount Paid</th>
                                            <th>Remaining</th>
                                            <th>Penalty</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($repayments as $idx => $rp)
                                            <tr>
                                                <td style="font-weight:700;color:var(--rs-faint);">{{ $idx + 1 }}</td>
                                                <td>{{ $rp->created_at->format('d M Y, H:i') }}</td>
                                                <td style="font-weight:700;color:var(--rs-green);">K{{ number_format($rp->amount_paid, 2) }}</td>
                                                <td>K{{ number_format($rp->remaining_balance, 2) }}</td>
                                                <td>
                                                    @if($rp->penalty_applied > 0)
                                                        <span class="rs-badge" style="background:rgba(124,58,237,.08);color:var(--rs-purple);border:1px solid rgba(124,58,237,.2);">
                                                            K{{ number_format($rp->penalty_applied, 2) }}
                                                        </span>
                                                    @else
                                                        <span style="color:var(--rs-faint);font-size:.78rem;">None</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="rs-empty">
                                <i class="fas fa-receipt"></i>
                                <p>No repayments recorded yet</p>
                            </div>
                        @endif
                    </div>

                    {{-- Penalty history --}}
                    <div class="rs-card">
                        <div class="rs-card-header"><div class="rs-card-title"><i class="fas fa-gavel"></i> Penalty History</div></div>
                        @if($penalties->count())
                            <div style="overflow-x:auto;">
                                <table class="rs-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date Applied</th>
                                            <th>Percentage</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($penalties as $idx => $pen)
                                            <tr>
                                                <td style="font-weight:700;color:var(--rs-faint);">{{ $idx + 1 }}</td>
                                                <td>{{ $pen->applied_at ? $pen->applied_at->format('d M Y, H:i') : '--' }}</td>
                                                <td>
                                                    <span class="rs-badge" style="background:rgba(217,119,6,.08);color:var(--rs-amber);border:1px solid rgba(217,119,6,.2);">
                                                        {{ $pen->percentage }}%
                                                    </span>
                                                </td>
                                                <td style="font-weight:700;color:var(--rs-purple);">K{{ number_format($pen->amount, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="rs-empty">
                                <i class="fas fa-gavel"></i>
                                <p>No penalties applied to this loan</p>
                            </div>
                        @endif
                    </div>

                    {{-- Activity timeline --}}
                    <div class="rs-card">
                        <div class="rs-card-header"><div class="rs-card-title"><i class="fas fa-stream"></i> Activity Timeline</div></div>
                        @php
                            $events = collect();
                            // Loan created
                            $events->push((object)['type'=>'loan','date'=>$loan->created_at,'title'=>'Loan Created','desc'=>'Loan of K'.number_format($loan->amount,2).' issued']);
                            // Repayments
                            foreach($repayments as $rp){
                                $events->push((object)['type'=>'repayment','date'=>$rp->created_at,'title'=>'Repayment','desc'=>'K'.number_format($rp->amount_paid,2).' paid — K'.number_format($rp->remaining_balance,2).' remaining']);
                            }
                            // Penalties
                            foreach($penalties as $pen){
                                $events->push((object)['type'=>'penalty','date'=>$pen->applied_at ?? $pen->created_at,'title'=>'Penalty Applied','desc'=>$pen->percentage.'% — K'.number_format($pen->amount,2)]);
                            }
                            $events = $events->sortByDesc('date');
                        @endphp

                        @if($events->count())
                            <div class="rs-timeline">
                                @foreach($events as $ev)
                                    @php
                                        $icon = ['loan'=>'fas fa-file-invoice-dollar','repayment'=>'fas fa-hand-holding-usd','penalty'=>'fas fa-exclamation-triangle'][$ev->type] ?? 'fas fa-circle';
                                        $bg   = ['loan'=>'rgba(30,58,95,.08)','repayment'=>'rgba(22,163,74,.08)','penalty'=>'rgba(124,58,237,.08)'][$ev->type] ?? 'rgba(148,163,184,.08)';
                                        $clr  = ['loan'=>'var(--rs-navy)','repayment'=>'var(--rs-green)','penalty'=>'var(--rs-purple)'][$ev->type] ?? 'var(--rs-faint)';
                                    @endphp
                                    <div class="rs-tl-item">
                                        <div class="rs-tl-dot" style="background:{{ $bg }};color:{{ $clr }};"><i class="{{ $icon }}"></i></div>
                                        <div class="rs-tl-body">
                                            <div class="rs-tl-header">
                                                <span class="rs-tl-title">{{ $ev->title }}</span>
                                                <span class="rs-tl-date">{{ $ev->date ? $ev->date->format('d M Y, H:i') : '--' }}</span>
                                            </div>
                                            <p class="rs-tl-desc">{{ $ev->desc }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="rs-empty">
                                <i class="fas fa-stream"></i>
                                <p>No activity yet</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
