<div>
    @push('custom-styles')
    <style>
        :root {
            --md-navy:#1E3A5F;--md-navy-light:#2B6B96;--md-amber:#D97706;--md-amber-light:#F59E0B;
            --md-bg:#f4f6fa;--md-card:#fff;--md-border:#edf0f7;--md-text:#1e293b;
            --md-muted:#64748b;--md-faint:#94a3b8;--md-green:#16a34a;--md-red:#dc2626;--md-blue:#2563eb;--md-purple:#7c3aed;--md-radius:16px;
        }
        .md-page{background:var(--md-bg);min-height:100vh;}

        /* ── Hero ─────────────────── */
        .md-hero{background:linear-gradient(135deg,var(--md-navy) 0%,#234b78 50%,var(--md-navy-light) 100%);padding:1.75rem 0 6rem;position:relative;overflow:hidden;}
        .md-hero::before{content:'';position:absolute;width:600px;height:600px;top:-60%;right:-8%;background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%);border-radius:50%;pointer-events:none;}
        .md-hero-inner{position:relative;z-index:2;padding:0 1.5rem;}
        .md-breadcrumb{display:flex;gap:.5rem;list-style:none;padding:0;margin:0 0 .75rem;font-size:.82rem;}
        .md-breadcrumb a{color:rgba(255,255,255,.55);text-decoration:none;}
        .md-breadcrumb a:hover{color:rgba(255,255,255,.85);}
        .md-breadcrumb .active{color:var(--md-amber-light);font-weight:600;}
        .md-breadcrumb .sep{color:rgba(255,255,255,.25);}
        .md-hero-row{display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:.75rem;}
        .md-hero-title h1{color:#fff;font-size:1.5rem;font-weight:800;margin:0;}
        .md-hero-title h1 i{color:var(--md-amber);margin-right:.5rem;}
        .md-hero-sub{color:rgba(255,255,255,.55);font-size:.85rem;margin:.25rem 0 0;}
        .md-hero-actions{display:flex;gap:.5rem;flex-wrap:wrap;}
        .md-hero-btn{display:inline-flex;align-items:center;gap:.4rem;padding:.5rem 1.1rem;border-radius:10px;font-size:.82rem;font-weight:700;text-decoration:none;transition:all .2s;border:none;cursor:pointer;}
        .md-hero-btn-outline{background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);color:rgba(255,255,255,.8);}
        .md-hero-btn-outline:hover{background:rgba(255,255,255,.15);color:#fff;text-decoration:none;}

        /* ── Content ──────────────── */
        .md-content{margin-top:-4rem;position:relative;z-index:10;padding:0 1.5rem 2rem;}
        .md-grid{display:grid;grid-template-columns:320px 1fr;gap:1.25rem;}
        @media(max-width:992px){.md-grid{grid-template-columns:1fr;}}

        /* ── Card ─────────────────── */
        .md-card{background:var(--md-card);border-radius:var(--md-radius);border:1px solid var(--md-border);box-shadow:0 2px 12px rgba(0,0,0,.04);overflow:hidden;margin-bottom:1.25rem;}
        .md-card:last-child{margin-bottom:0;}
        .md-card-header{padding:1rem 1.25rem;display:flex;align-items:center;justify-content:space-between;gap:.5rem;border-bottom:1px solid var(--md-border);}
        .md-card-title{font-size:.88rem;font-weight:700;color:var(--md-text);display:flex;align-items:center;gap:.4rem;}
        .md-card-title i{color:var(--md-amber);font-size:.75rem;}
        .md-card-body{padding:1.25rem;}

        /* ── Sidebar ──────────────── */
        .md-sidebar{display:flex;flex-direction:column;gap:1.25rem;}
        .md-profile{text-align:center;padding:1.75rem 1.25rem;}
        .md-profile-avatar{width:72px;height:72px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.5rem;font-weight:800;margin:0 auto .75rem;background:linear-gradient(135deg,var(--md-navy),var(--md-navy-light));color:#fff;box-shadow:0 4px 14px rgba(30,58,95,.2);}
        .md-profile h3{font-size:1.05rem;font-weight:800;color:var(--md-text);margin:0 0 .15rem;}
        .md-profile p{color:var(--md-faint);font-size:.78rem;margin:0 0 .75rem;}
        .md-badge{display:inline-flex;align-items:center;gap:.3rem;padding:.25rem .65rem;border-radius:8px;font-size:.7rem;font-weight:700;}

        .md-info{padding:.75rem 1.25rem;}
        .md-info-row{display:flex;align-items:center;justify-content:space-between;padding:.55rem 0;border-bottom:1px solid #f8f9fb;}
        .md-info-row:last-child{border-bottom:none;}
        .md-info-label{font-size:.76rem;color:var(--md-faint);display:flex;align-items:center;gap:.35rem;}
        .md-info-label i{font-size:.6rem;width:14px;text-align:center;color:var(--md-navy);}
        .md-info-value{font-size:.82rem;font-weight:700;color:var(--md-text);}

        /* ── Summary stats ────────── */
        .md-summary{display:grid;grid-template-columns:repeat(4,1fr);gap:.75rem;margin-bottom:1.25rem;}
        @media(max-width:768px){.md-summary{grid-template-columns:repeat(2,1fr);}}
        .md-stat{background:var(--md-card);border-radius:var(--md-radius);border:1px solid var(--md-border);box-shadow:0 2px 12px rgba(0,0,0,.04);padding:1rem 1.1rem;display:flex;align-items:center;justify-content:space-between;transition:all .2s;}
        .md-stat:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(0,0,0,.06);}
        .md-stat-label{font-size:.58rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--md-faint);}
        .md-stat-value{font-size:1.2rem;font-weight:800;color:var(--md-text);margin-top:.1rem;}
        .md-stat-icon{width:42px;height:42px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:.95rem;flex-shrink:0;}

        /* ── Table ────────────────── */
        .md-table{width:100%;border-collapse:collapse;}
        .md-table thead th{font-size:.62rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--md-faint);padding:.7rem 1rem;border-bottom:1px solid var(--md-border);background:#fafbfd;white-space:nowrap;}
        .md-table tbody td{padding:.7rem 1rem;border-bottom:1px solid #f5f7fa;font-size:.84rem;vertical-align:middle;}
        .md-table tbody tr:last-child td{border-bottom:none;}
        .md-table tbody tr:hover{background:#fafbfd;}
        .md-table tfoot td{padding:.7rem 1rem;font-weight:800;background:#fafbfd;border-top:2px solid var(--md-border);font-size:.84rem;}

        /* ── Waterfall ────────────── */
        .md-waterfall{padding:1.25rem;}
        .md-wf-row{display:flex;align-items:center;justify-content:space-between;padding:.6rem 0;border-bottom:1px solid #f5f7fa;}
        .md-wf-row:last-child{border-bottom:none;}
        .md-wf-label{font-size:.84rem;color:var(--md-text);display:flex;align-items:center;gap:.4rem;}
        .md-wf-label i{font-size:.6rem;width:16px;text-align:center;}
        .md-wf-value{font-size:.92rem;font-weight:800;}
        .md-wf-divider{border-top:2px dashed var(--md-border);margin:.5rem 0;padding-top:.5rem;}
        .md-wf-total{border-top:3px solid var(--md-text);margin-top:.5rem;padding-top:.75rem;}

        .md-main{display:flex;flex-direction:column;gap:0;}
        @keyframes mdSlide{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
        .md-animate{animation:mdSlide .3s ease;}
        @media(max-width:768px){.md-content{padding:0 .75rem 1.5rem;}.md-summary{grid-template-columns:1fr 1fr;}}
    </style>
    @endpush

    @can('view-shareout')
    @php
        $member   = $allocation->user;
        $circle   = $shareout->circle;
        $bank     = $circle->villageBank ?? null;
        $parts    = explode(' ', trim($member->name ?? ''));
        $initials = strtoupper(substr($parts[0],0,1) . (isset($parts[1]) ? substr($parts[1],0,1) : ''));
        $isReceiving = ($allocation->action ?? 'Receiving') === 'Receiving' || $allocation->payout_amount >= 0;

        $grossShareout = ($allocation->investment_compounded ?? ($allocation->contribution_total + $allocation->shares_profit))
                       + ($allocation->insurance_compounded ?? ($allocation->insurance_total + $allocation->insurance_profit));
    @endphp

    <section class="content md-page">
        {{-- ████ Hero ████ --}}
        <div class="md-hero">
            <div class="md-hero-inner container-fluid">
                <ul class="md-breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('shareout.index') }}">Shareout</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('shareout.show', $shareout->id) }}">{{ $circle->name ?? 'Details' }}</a></li>
                    <li class="sep">/</li>
                    <li class="active">{{ $member->name ?? '--' }}</li>
                </ul>
                <div class="md-hero-row">
                    <div class="md-hero-title">
                        <h1><i class="fas fa-user-circle"></i>Member Shareout Detail</h1>
                        <p class="md-hero-sub">{{ $member->name ?? '--' }} &mdash; {{ $circle->name ?? '--' }} &mdash; Compound rate {{ $shareout->compound_rate ?? 5 }}% / month</p>
                    </div>
                    <div class="md-hero-actions">
                        <a href="{{ route('shareout.show', $shareout->id) }}" class="md-hero-btn md-hero-btn-outline">
                            <i class="fas fa-arrow-left"></i> Back to Shareout
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- ████ Content ████ --}}
        <div class="md-content container-fluid md-animate">
            <div class="md-grid">

                {{-- ██ LEFT — Sidebar ██ --}}
                <div class="md-sidebar">

                    {{-- Member profile --}}
                    <div class="md-card" style="margin-bottom:0;">
                        <div class="md-profile">
                            <div class="md-profile-avatar">{{ $initials }}</div>
                            <h3>{{ $member->name ?? '--' }}</h3>
                            <p>{{ $member->email ?? '--' }}</p>
                            @if($isReceiving)
                                <span class="md-badge" style="background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;">
                                    <i class="fas fa-arrow-down" style="font-size:.4rem;"></i> Receiving
                                </span>
                            @else
                                <span class="md-badge" style="background:#fef2f2;color:#991b1b;border:1px solid #fecaca;">
                                    <i class="fas fa-arrow-up" style="font-size:.4rem;"></i> Pay Back
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Net Shareout Waterfall --}}
                    <div class="md-card" style="margin-bottom:0;">
                        <div class="md-card-header">
                            <div class="md-card-title"><i class="fas fa-stream"></i> Net Shareout Breakdown</div>
                        </div>
                        <div class="md-waterfall">
                            <div class="md-wf-row">
                                <span class="md-wf-label"><i class="fas fa-circle" style="color:var(--md-blue);"></i> Investment (original)</span>
                                <span class="md-wf-value" style="color:var(--md-blue);">K{{ number_format($allocation->contribution_total, 2) }}</span>
                            </div>
                            <div class="md-wf-row">
                                <span class="md-wf-label"><i class="fas fa-plus-circle" style="color:var(--md-green);"></i> Investment Profit</span>
                                <span class="md-wf-value" style="color:var(--md-green);">+K{{ number_format($allocation->shares_profit, 2) }}</span>
                            </div>
                            <div class="md-wf-row">
                                <span class="md-wf-label"><i class="fas fa-circle" style="color:var(--md-purple);"></i> Insurance (original)</span>
                                <span class="md-wf-value" style="color:var(--md-purple);">K{{ number_format($allocation->insurance_total, 2) }}</span>
                            </div>
                            <div class="md-wf-row">
                                <span class="md-wf-label"><i class="fas fa-plus-circle" style="color:var(--md-green);"></i> Insurance Return</span>
                                <span class="md-wf-value" style="color:var(--md-green);">+K{{ number_format($allocation->insurance_profit, 2) }}</span>
                            </div>
                            <div class="md-wf-row md-wf-divider">
                                <span class="md-wf-label" style="font-weight:700;"><i class="fas fa-equals" style="color:var(--md-amber);"></i> Gross Shareout</span>
                                <span class="md-wf-value" style="color:var(--md-amber);">K{{ number_format($grossShareout, 2) }}</span>
                            </div>
                            @if($allocation->loan_deduction > 0)
                            <div class="md-wf-row">
                                <span class="md-wf-label"><i class="fas fa-minus-circle" style="color:var(--md-red);"></i> Outstanding Loans</span>
                                <span class="md-wf-value" style="color:var(--md-red);">&minus;K{{ number_format($allocation->loan_deduction, 2) }}</span>
                            </div>
                            @endif
                            <div class="md-wf-row md-wf-total">
                                <span class="md-wf-label" style="font-weight:800;font-size:.92rem;"><i class="fas fa-wallet" style="color:{{ $isReceiving ? 'var(--md-green)' : 'var(--md-red)' }};"></i> Net Shareout</span>
                                <span class="md-wf-value" style="font-size:1.15rem;color:{{ $isReceiving ? 'var(--md-green)' : 'var(--md-red)' }};">K{{ number_format($allocation->payout_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Details card --}}
                    <div class="md-card" style="margin-bottom:0;">
                        <div class="md-card-header"><div class="md-card-title"><i class="fas fa-info-circle"></i> Details</div></div>
                        <div class="md-info">
                            <div class="md-info-row">
                                <span class="md-info-label"><i class="fas fa-circle-notch"></i> Circle</span>
                                <span class="md-info-value">{{ $circle->name ?? '--' }}</span>
                            </div>
                            @if($bank)
                            <div class="md-info-row">
                                <span class="md-info-label"><i class="fas fa-university"></i> Village Bank</span>
                                <span class="md-info-value">{{ $bank->name }}</span>
                            </div>
                            @endif
                            <div class="md-info-row">
                                <span class="md-info-label"><i class="fas fa-percentage"></i> Compound Rate</span>
                                <span class="md-info-value">{{ $shareout->compound_rate ?? 5 }}% / month</span>
                            </div>
                            <div class="md-info-row">
                                <span class="md-info-label"><i class="fas fa-calendar"></i> Finalised</span>
                                <span class="md-info-value">{{ $shareout->created_at->format('d M Y') }}</span>
                            </div>
                            @if(($allocation->credit_limit ?? 0) > 0)
                            <div class="md-info-row">
                                <span class="md-info-label"><i class="fas fa-credit-card"></i> Credit Limit</span>
                                <span class="md-info-value">K{{ number_format($allocation->credit_limit, 2) }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- ██ RIGHT — Main ██ --}}
                <div class="md-main">

                    {{-- Summary Stats --}}
                    <div class="md-summary">
                        <div class="md-stat">
                            <div>
                                <div class="md-stat-label">Investment (compounded)</div>
                                <div class="md-stat-value" style="color:var(--md-blue);">K{{ number_format($allocation->investment_compounded ?? ($allocation->contribution_total + $allocation->shares_profit), 2) }}</div>
                            </div>
                            <div class="md-stat-icon" style="background:rgba(37,99,235,.08);color:var(--md-blue);"><i class="fas fa-piggy-bank"></i></div>
                        </div>
                        <div class="md-stat">
                            <div>
                                <div class="md-stat-label">Insurance (compounded)</div>
                                <div class="md-stat-value" style="color:var(--md-purple);">K{{ number_format($allocation->insurance_compounded ?? ($allocation->insurance_total + $allocation->insurance_profit), 2) }}</div>
                            </div>
                            <div class="md-stat-icon" style="background:rgba(124,58,237,.08);color:var(--md-purple);"><i class="fas fa-shield-alt"></i></div>
                        </div>
                        <div class="md-stat">
                            <div>
                                <div class="md-stat-label">Outstanding Loan</div>
                                <div class="md-stat-value" style="color:var(--md-red);">K{{ number_format($allocation->loan_deduction, 2) }}</div>
                            </div>
                            <div class="md-stat-icon" style="background:rgba(220,38,38,.08);color:var(--md-red);"><i class="fas fa-hand-holding-usd"></i></div>
                        </div>
                        <div class="md-stat">
                            <div>
                                <div class="md-stat-label">Net Shareout</div>
                                <div class="md-stat-value" style="color:{{ $isReceiving ? 'var(--md-green)' : 'var(--md-red)' }};">K{{ number_format($allocation->payout_amount, 2) }}</div>
                            </div>
                            <div class="md-stat-icon" style="background:{{ $isReceiving ? 'rgba(22,163,74,.08)' : 'rgba(220,38,38,.08)' }};color:{{ $isReceiving ? 'var(--md-green)' : 'var(--md-red)' }};"><i class="fas {{ $isReceiving ? 'fa-arrow-down' : 'fa-arrow-up' }}"></i></div>
                        </div>
                    </div>

                    {{-- Investment Growth Table --}}
                    <div class="md-card">
                        <div class="md-card-header">
                            <div class="md-card-title"><i class="fas fa-chart-line"></i> Investment Growth ({{ $shareout->compound_rate ?? 5 }}% / month compound)</div>
                        </div>
                        <div style="overflow-x:auto;">
                            <table class="md-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Month Deposited</th>
                                        <th>Amount Deposited</th>
                                        <th>Months Compounding</th>
                                        <th>Final Value</th>
                                        <th>Profit Earned</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($investmentGrowth as $i => $row)
                                        <tr>
                                            <td style="color:var(--md-faint);font-size:.78rem;">{{ $i + 1 }}</td>
                                            <td style="font-weight:600;">{{ $row['month_label'] }}</td>
                                            <td>K{{ number_format($row['original_amount'], 2) }}</td>
                                            <td style="color:var(--md-muted);">{{ $row['months_active'] }} months</td>
                                            <td style="font-weight:700;color:var(--md-blue);">K{{ number_format($row['final_value'], 2) }}</td>
                                            <td style="font-weight:700;color:var(--md-green);">+K{{ number_format($row['profit'], 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="6" style="text-align:center;color:var(--md-faint);padding:1.5rem;"><i class="fas fa-piggy-bank" style="opacity:.15;font-size:1.2rem;display:block;margin-bottom:.25rem;"></i>No investment contributions found</td></tr>
                                    @endforelse
                                </tbody>
                                @if(count($investmentGrowth))
                                <tfoot>
                                    <tr>
                                        <td colspan="2" style="text-align:right;">TOTALS</td>
                                        <td>K{{ number_format(array_sum(array_column($investmentGrowth, 'original_amount')), 2) }}</td>
                                        <td></td>
                                        <td style="color:var(--md-blue);">K{{ number_format(array_sum(array_column($investmentGrowth, 'final_value')), 2) }}</td>
                                        <td style="color:var(--md-green);">+K{{ number_format(array_sum(array_column($investmentGrowth, 'profit')), 2) }}</td>
                                    </tr>
                                </tfoot>
                                @endif
                            </table>
                        </div>
                    </div>

                    {{-- Insurance Growth Table --}}
                    <div class="md-card">
                        <div class="md-card-header">
                            <div class="md-card-title"><i class="fas fa-shield-alt"></i> Insurance Growth ({{ $shareout->compound_rate ?? 5 }}% / month compound)</div>
                        </div>
                        <div style="overflow-x:auto;">
                            <table class="md-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Month Deposited</th>
                                        <th>Amount Deposited</th>
                                        <th>Months Compounding</th>
                                        <th>Final Value</th>
                                        <th>Return Earned</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($insuranceGrowth as $i => $row)
                                        <tr>
                                            <td style="color:var(--md-faint);font-size:.78rem;">{{ $i + 1 }}</td>
                                            <td style="font-weight:600;">{{ $row['month_label'] }}</td>
                                            <td>K{{ number_format($row['original_amount'], 2) }}</td>
                                            <td style="color:var(--md-muted);">{{ $row['months_active'] }} months</td>
                                            <td style="font-weight:700;color:var(--md-purple);">K{{ number_format($row['final_value'], 2) }}</td>
                                            <td style="font-weight:700;color:var(--md-green);">+K{{ number_format($row['profit'], 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="6" style="text-align:center;color:var(--md-faint);padding:1.5rem;"><i class="fas fa-shield-alt" style="opacity:.15;font-size:1.2rem;display:block;margin-bottom:.25rem;"></i>No insurance contributions found</td></tr>
                                    @endforelse
                                </tbody>
                                @if(count($insuranceGrowth))
                                <tfoot>
                                    <tr>
                                        <td colspan="2" style="text-align:right;">TOTALS</td>
                                        <td>K{{ number_format(array_sum(array_column($insuranceGrowth, 'original_amount')), 2) }}</td>
                                        <td></td>
                                        <td style="color:var(--md-purple);">K{{ number_format(array_sum(array_column($insuranceGrowth, 'final_value')), 2) }}</td>
                                        <td style="color:var(--md-green);">+K{{ number_format(array_sum(array_column($insuranceGrowth, 'profit')), 2) }}</td>
                                    </tr>
                                </tfoot>
                                @endif
                            </table>
                        </div>
                    </div>

                    {{-- Loan History --}}
                    <div class="md-card" style="margin-bottom:0;">
                        <div class="md-card-header">
                            <div class="md-card-title"><i class="fas fa-hand-holding-usd"></i> Loan History</div>
                        </div>
                        <div style="overflow-x:auto;">
                            <table class="md-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Month</th>
                                        <th>Loan Amount</th>
                                        <th>Interest Rate</th>
                                        <th>Total Payable</th>
                                        <th>Repaid</th>
                                        <th>Outstanding</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($loanHistory as $i => $loan)
                                        <tr>
                                            <td style="color:var(--md-faint);font-size:.78rem;">{{ $i + 1 }}</td>
                                            <td style="font-weight:600;">{{ $loan['month_label'] }}</td>
                                            <td>K{{ number_format($loan['amount'], 2) }}</td>
                                            <td style="color:var(--md-muted);">{{ $loan['interest_rate'] }}%</td>
                                            <td style="font-weight:700;">K{{ number_format($loan['total_payable'], 2) }}</td>
                                            <td style="color:var(--md-green);font-weight:700;">K{{ number_format($loan['repaid'], 2) }}</td>
                                            <td style="color:{{ $loan['outstanding'] > 0 ? 'var(--md-red)' : 'var(--md-green)' }};font-weight:700;">K{{ number_format($loan['outstanding'], 2) }}</td>
                                            <td>
                                                @if($loan['outstanding'] <= 0)
                                                    <span class="md-badge" style="background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;">Paid</span>
                                                @else
                                                    <span class="md-badge" style="background:#fef2f2;color:#991b1b;border:1px solid #fecaca;">Active</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="8" style="text-align:center;color:var(--md-faint);padding:1.5rem;"><i class="fas fa-hand-holding-usd" style="opacity:.15;font-size:1.2rem;display:block;margin-bottom:.25rem;"></i>No loans recorded for this member</td></tr>
                                    @endforelse
                                </tbody>
                                @if(count($loanHistory))
                                <tfoot>
                                    <tr>
                                        <td colspan="2" style="text-align:right;">TOTALS</td>
                                        <td>K{{ number_format(array_sum(array_column($loanHistory, 'amount')), 2) }}</td>
                                        <td></td>
                                        <td>K{{ number_format(array_sum(array_column($loanHistory, 'total_payable')), 2) }}</td>
                                        <td style="color:var(--md-green);">K{{ number_format(array_sum(array_column($loanHistory, 'repaid')), 2) }}</td>
                                        <td style="color:var(--md-red);">K{{ number_format(array_sum(array_column($loanHistory, 'outstanding')), 2) }}</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                                @endif
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
