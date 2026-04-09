<div>
    @push('custom-styles')
    <style>
        :root {
            --rh-navy:#1E3A5F;--rh-navy-light:#2B6B96;--rh-amber:#D97706;--rh-amber-light:#F59E0B;
            --rh-bg:#f4f6fa;--rh-card:#fff;--rh-border:#edf0f7;--rh-text:#1e293b;
            --rh-muted:#64748b;--rh-faint:#94a3b8;--rh-green:#16a34a;--rh-red:#dc2626;--rh-blue:#2563eb;--rh-purple:#7c3aed;--rh-cyan:#0891b2;--rh-radius:16px;
        }
        .rh-page{background:var(--rh-bg);min-height:100vh;}

        /* Hero */
        .rh-hero{background:linear-gradient(135deg,var(--rh-navy) 0%,#234b78 50%,var(--rh-navy-light) 100%);padding:1.75rem 0 7rem;position:relative;overflow:hidden;}
        .rh-hero::before{content:'';position:absolute;width:700px;height:700px;top:-60%;right:-10%;background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%);border-radius:50%;pointer-events:none;}
        .rh-hero-inner{position:relative;z-index:2;padding:0 1.5rem;}
        .rh-breadcrumb{display:flex;gap:.5rem;list-style:none;padding:0;margin:0 0 .75rem;font-size:.82rem;}
        .rh-breadcrumb a{color:rgba(255,255,255,.55);text-decoration:none;}
        .rh-breadcrumb a:hover{color:rgba(255,255,255,.85);}
        .rh-breadcrumb .active{color:var(--rh-amber-light);font-weight:600;}
        .rh-breadcrumb .sep{color:rgba(255,255,255,.25);}
        .rh-hero-row{display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:.75rem;}
        .rh-hero-title h1{color:#fff;font-size:1.6rem;font-weight:800;margin:0;}
        .rh-hero-title h1 i{color:var(--rh-amber);margin-right:.5rem;}
        .rh-hero-sub{color:rgba(255,255,255,.55);font-size:.88rem;margin:.25rem 0 0;}
        .rh-hero-filter{display:flex;gap:.5rem;align-items:end;}
        .rh-hero-select{padding:.5rem .85rem;border-radius:10px;font-size:.82rem;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);color:#fff;cursor:pointer;min-width:180px;}
        .rh-hero-select option{color:var(--rh-text);background:#fff;}
        .rh-hero-select:focus{outline:none;border-color:var(--rh-amber);}

        /* Content */
        .rh-content{margin-top:-4.5rem;position:relative;z-index:10;padding:0 1.5rem 2rem;}

        /* Summary strip */
        .rh-summary{display:grid;grid-template-columns:repeat(6,1fr);gap:.75rem;margin-bottom:1.5rem;}
        @media(max-width:1200px){.rh-summary{grid-template-columns:repeat(3,1fr);}}
        @media(max-width:768px){.rh-summary{grid-template-columns:repeat(2,1fr);}}
        @media(max-width:480px){.rh-summary{grid-template-columns:1fr;}}
        .rh-sum{background:var(--rh-card);border-radius:14px;border:1px solid var(--rh-border);box-shadow:0 2px 12px rgba(0,0,0,.04);padding:.85rem 1rem;transition:all .2s;}
        .rh-sum:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(0,0,0,.06);}
        .rh-sum-label{font-size:.58rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--rh-faint);}
        .rh-sum-val{font-size:1.35rem;font-weight:800;margin-top:.1rem;}

        /* Section */
        .rh-section-title{font-size:.72rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--rh-faint);margin:1.5rem 0 .75rem;display:flex;align-items:center;gap:.4rem;}
        .rh-section-title::after{content:'';flex:1;height:1px;background:var(--rh-border);}

        /* Report cards grid */
        .rh-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;}
        @media(max-width:992px){.rh-grid{grid-template-columns:repeat(2,1fr);}}
        @media(max-width:576px){.rh-grid{grid-template-columns:1fr;}}

        .rh-rcard{background:var(--rh-card);border-radius:var(--rh-radius);border:1px solid var(--rh-border);box-shadow:0 2px 12px rgba(0,0,0,.04);padding:1.5rem;display:flex;flex-direction:column;transition:all .25s;cursor:pointer;text-decoration:none;color:inherit;position:relative;overflow:hidden;}
        .rh-rcard:hover{transform:translateY(-3px);box-shadow:0 8px 30px rgba(0,0,0,.08);text-decoration:none;color:inherit;}
        .rh-rcard::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;border-radius:16px 16px 0 0;}
        .rh-rcard-icon{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;margin-bottom:.85rem;}
        .rh-rcard h3{font-size:1rem;font-weight:800;color:var(--rh-text);margin:0 0 .35rem;}
        .rh-rcard p{font-size:.82rem;color:var(--rh-muted);margin:0 0 .75rem;line-height:1.45;flex:1;}
        .rh-rcard-footer{display:flex;align-items:center;justify-content:space-between;}
        .rh-rcard-tags{display:flex;gap:.3rem;flex-wrap:wrap;}
        .rh-rcard-tag{padding:.15rem .45rem;border-radius:6px;font-size:.62rem;font-weight:700;background:#f8fafc;border:1px solid var(--rh-border);color:var(--rh-faint);text-transform:uppercase;letter-spacing:.3px;}
        .rh-rcard-arrow{width:28px;height:28px;border-radius:8px;background:#f8fafc;border:1px solid var(--rh-border);display:flex;align-items:center;justify-content:center;color:var(--rh-faint);font-size:.65rem;transition:all .2s;}
        .rh-rcard:hover .rh-rcard-arrow{background:var(--rh-navy);border-color:var(--rh-navy);color:#fff;}

        @keyframes rhSlide{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
        .rh-animate{animation:rhSlide .3s ease;}
        @media(max-width:768px){.rh-content{padding:0 .75rem 1.5rem;}}
    </style>
    @endpush

    @can('view-reports')
    <section class="content rh-page">
        {{-- ████ Hero ████ --}}
        <div class="rh-hero">
            <div class="rh-hero-inner container-fluid">
                <ul class="rh-breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li class="active">Reports & Analytics</li>
                </ul>
                <div class="rh-hero-row">
                    <div class="rh-hero-title">
                        <h1><i class="fas fa-chart-bar"></i>Reports & Analytics</h1>
                        <p class="rh-hero-sub">Comprehensive reports, insights and visual analytics across all village banking operations</p>
                    </div>
                    <div class="rh-hero-filter">
                        @include('partials.village-bank-selector')
                    </div>
                </div>
            </div>
        </div>

        {{-- ████ Content ████ --}}
        <div class="rh-content container-fluid rh-animate">

            {{-- Quick Summary Strip --}}
            <div class="rh-summary">
                <div class="rh-sum">
                    <div class="rh-sum-label">Members</div>
                    <div class="rh-sum-val" style="color:var(--rh-navy);">{{ number_format($stats['totalMembers']) }}</div>
                </div>
                <div class="rh-sum">
                    <div class="rh-sum-label">Circles</div>
                    <div class="rh-sum-val" style="color:var(--rh-blue);">{{ $stats['totalCircles'] }} <small style="font-size:.6rem;color:var(--rh-green);font-weight:600;">{{ $stats['activeCircles'] }} active</small></div>
                </div>
                <div class="rh-sum">
                    <div class="rh-sum-label">Contributions</div>
                    <div class="rh-sum-val" style="color:var(--rh-cyan);">K{{ number_format($stats['totalContributions'], 0) }}</div>
                </div>
                <div class="rh-sum">
                    <div class="rh-sum-label">Loans Issued</div>
                    <div class="rh-sum-val" style="color:var(--rh-amber);">K{{ number_format($stats['totalLoanAmount'], 0) }}</div>
                </div>
                <div class="rh-sum">
                    <div class="rh-sum-label">Outstanding</div>
                    <div class="rh-sum-val" style="color:var(--rh-red);">K{{ number_format($stats['totalOutstanding'], 0) }}</div>
                </div>
                <div class="rh-sum">
                    <div class="rh-sum-label">Distributed</div>
                    <div class="rh-sum-val" style="color:var(--rh-green);">K{{ number_format($stats['totalPoolDistrib'], 0) }}</div>
                </div>
            </div>

            {{-- ═══ CORE REPORTS ═══ --}}
            <div class="rh-section-title"><i class="fas fa-folder-open"></i> Core Reports</div>
            <div class="rh-grid">
                {{-- Financial Overview --}}
                <a href="{{ route('reports.financial') }}" class="rh-rcard" style="--rc:#0891b2;">
                    <div style="position:absolute;top:0;left:0;right:0;height:3px;background:var(--rc);"></div>
                    <div class="rh-rcard-icon" style="background:rgba(8,145,178,.08);color:var(--rc);"><i class="fas fa-wallet"></i></div>
                    <h3>Financial Overview</h3>
                    <p>Contributions, insurance, penalties, and overall fund performance with date range filtering.</p>
                    <div class="rh-rcard-footer">
                        <div class="rh-rcard-tags">
                            <span class="rh-rcard-tag">Contributions</span>
                            <span class="rh-rcard-tag">Insurance</span>
                            <span class="rh-rcard-tag">Penalties</span>
                        </div>
                        <div class="rh-rcard-arrow"><i class="fas fa-arrow-right"></i></div>
                    </div>
                </a>

                {{-- Membership --}}
                <a href="{{ route('reports.membership') }}" class="rh-rcard" style="--rc:#7c3aed;">
                    <div style="position:absolute;top:0;left:0;right:0;height:3px;background:var(--rc);"></div>
                    <div class="rh-rcard-icon" style="background:rgba(124,58,237,.08);color:var(--rc);"><i class="fas fa-users"></i></div>
                    <h3>Membership & Participation</h3>
                    <p>Member enrolment, circle participation, activity levels, and demographic breakdown.</p>
                    <div class="rh-rcard-footer">
                        <div class="rh-rcard-tags">
                            <span class="rh-rcard-tag">Members</span>
                            <span class="rh-rcard-tag">Circles</span>
                            <span class="rh-rcard-tag">Activity</span>
                        </div>
                        <div class="rh-rcard-arrow"><i class="fas fa-arrow-right"></i></div>
                    </div>
                </a>

                {{-- Loans --}}
                <a href="{{ route('reports.loans') }}" class="rh-rcard" style="--rc:#ea580c;">
                    <div style="position:absolute;top:0;left:0;right:0;height:3px;background:var(--rc);"></div>
                    <div class="rh-rcard-icon" style="background:rgba(234,88,12,.08);color:var(--rc);"><i class="fas fa-hand-holding-usd"></i></div>
                    <h3>Loans & Repayments</h3>
                    <p>Loan portfolio, repayment tracking, default risk analysis, and borrower performance.</p>
                    <div class="rh-rcard-footer">
                        <div class="rh-rcard-tags">
                            <span class="rh-rcard-tag">Loans</span>
                            <span class="rh-rcard-tag">Repayments</span>
                            <span class="rh-rcard-tag">Defaults</span>
                        </div>
                        <div class="rh-rcard-arrow"><i class="fas fa-arrow-right"></i></div>
                    </div>
                </a>

                {{-- Analytics --}}
                <a href="{{ route('reports.analytics') }}" class="rh-rcard" style="--rc:#2563eb;">
                    <div style="position:absolute;top:0;left:0;right:0;height:3px;background:var(--rc);"></div>
                    <div class="rh-rcard-icon" style="background:rgba(37,99,235,.08);color:var(--rc);"><i class="fas fa-chart-area"></i></div>
                    <h3>Visual Analytics & Charts</h3>
                    <p>Interactive charts showing trends over time — contributions, loans, repayments, and growth.</p>
                    <div class="rh-rcard-footer">
                        <div class="rh-rcard-tags">
                            <span class="rh-rcard-tag">Charts</span>
                            <span class="rh-rcard-tag">Trends</span>
                            <span class="rh-rcard-tag">Growth</span>
                        </div>
                        <div class="rh-rcard-arrow"><i class="fas fa-arrow-right"></i></div>
                    </div>
                </a>

                {{-- Old Dashboard (keep accessible) --}}
                <a href="{{ route('reports.dashboard') }}" class="rh-rcard" style="--rc:#1E3A5F;">
                    <div style="position:absolute;top:0;left:0;right:0;height:3px;background:var(--rc);"></div>
                    <div class="rh-rcard-icon" style="background:rgba(30,58,95,.08);color:var(--rc);"><i class="fas fa-tachometer-alt"></i></div>
                    <h3>Classic Dashboard</h3>
                    <p>Original tabbed overview with contributions, loans, payments, and shareout tables.</p>
                    <div class="rh-rcard-footer">
                        <div class="rh-rcard-tags">
                            <span class="rh-rcard-tag">Overview</span>
                            <span class="rh-rcard-tag">Tables</span>
                        </div>
                        <div class="rh-rcard-arrow"><i class="fas fa-arrow-right"></i></div>
                    </div>
                </a>

                {{-- Shareouts --}}
                <a href="{{ route('reports.dashboard') }}?status=shareouts" class="rh-rcard" style="--rc:#16a34a;">
                    <div style="position:absolute;top:0;left:0;right:0;height:3px;background:var(--rc);"></div>
                    <div class="rh-rcard-icon" style="background:rgba(22,163,74,.08);color:var(--rc);"><i class="fas fa-coins"></i></div>
                    <h3>Shareout Reports</h3>
                    <p>End-of-cycle distribution data, member payouts, pool breakdowns, and allocation details.</p>
                    <div class="rh-rcard-footer">
                        <div class="rh-rcard-tags">
                            <span class="rh-rcard-tag">Shareouts</span>
                            <span class="rh-rcard-tag">Allocations</span>
                        </div>
                        <div class="rh-rcard-arrow"><i class="fas fa-arrow-right"></i></div>
                    </div>
                </a>
            </div>

            {{-- ═══ GOVERNANCE & ENGAGEMENT ═══ --}}
            <div class="rh-section-title"><i class="fas fa-gavel"></i> Governance & Engagement</div>
            <div class="rh-grid">
                {{-- Polls --}}
                <a href="{{ route('polls.index') }}" class="rh-rcard" style="--rc:#D97706;">
                    <div style="position:absolute;top:0;left:0;right:0;height:3px;background:var(--rc);"></div>
                    <div class="rh-rcard-icon" style="background:rgba(217,119,6,.08);color:var(--rc);"><i class="fas fa-poll"></i></div>
                    <h3>Polls & Voting</h3>
                    <p>Poll results, voter turnout, participation rates, and decision tracking.</p>
                    <div class="rh-rcard-footer">
                        <div class="rh-rcard-tags">
                            <span class="rh-rcard-tag">{{ $stats['activePolls'] }} Active</span>
                            <span class="rh-rcard-tag">Polls</span>
                        </div>
                        <div class="rh-rcard-arrow"><i class="fas fa-arrow-right"></i></div>
                    </div>
                </a>

                {{-- Rules --}}
                <a href="{{ route('rules.manage') }}" class="rh-rcard" style="--rc:#475569;">
                    <div style="position:absolute;top:0;left:0;right:0;height:3px;background:var(--rc);"></div>
                    <div class="rh-rcard-icon" style="background:rgba(71,85,105,.08);color:var(--rc);"><i class="fas fa-gavel"></i></div>
                    <h3>Rules & Compliance</h3>
                    <p>Rule acknowledgement rates, compliance status, and bylaw tracking.</p>
                    <div class="rh-rcard-footer">
                        <div class="rh-rcard-tags">
                            <span class="rh-rcard-tag">{{ $stats['totalRules'] }} Rules</span>
                            <span class="rh-rcard-tag">Compliance</span>
                        </div>
                        <div class="rh-rcard-arrow"><i class="fas fa-arrow-right"></i></div>
                    </div>
                </a>

                {{-- Transactions --}}
                <a href="{{ route('reports.dashboard') }}?status=payments" class="rh-rcard" style="--rc:#0d9488;">
                    <div style="position:absolute;top:0;left:0;right:0;height:3px;background:var(--rc);"></div>
                    <div class="rh-rcard-icon" style="background:rgba(13,148,136,.08);color:var(--rc);"><i class="fas fa-exchange-alt"></i></div>
                    <h3>Transaction Audit</h3>
                    <p>Payment records, confirmation status, payment methods, and transaction history.</p>
                    <div class="rh-rcard-footer">
                        <div class="rh-rcard-tags">
                            <span class="rh-rcard-tag">{{ number_format($stats['totalTransactions']) }} Txns</span>
                            <span class="rh-rcard-tag">Audit</span>
                        </div>
                        <div class="rh-rcard-arrow"><i class="fas fa-arrow-right"></i></div>
                    </div>
                </a>
            </div>

        </div>
    </section>
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
