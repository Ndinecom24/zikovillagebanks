<div>
@once
@push('custom-styles')
<style>
    :root {
        --vs-navy:#1E3A5F;--vs-navy-light:#2B6B96;--vs-amber:#D97706;--vs-amber-light:#F59E0B;
        --vs-bg:#f4f6fa;--vs-card:#fff;--vs-border:#edf0f7;--vs-text:#1e293b;
        --vs-muted:#64748b;--vs-faint:#94a3b8;--vs-green:#16a34a;--vs-red:#dc2626;--vs-blue:#2563eb;--vs-purple:#7c3aed;--vs-cyan:#0891b2;--vs-orange:#ea580c;--vs-radius:16px;
    }
    .vs-page{background:var(--vs-bg);min-height:100vh;}

    /* ─── Hero ─── */
    .vs-hero{background:linear-gradient(135deg,var(--vs-navy) 0%,#234b78 50%,var(--vs-navy-light) 100%);padding:1.75rem 0 7rem;position:relative;overflow:hidden;}
    .vs-hero::before{content:'';position:absolute;width:700px;height:700px;top:-60%;right:-10%;background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%);border-radius:50%;pointer-events:none;}
    .vs-hero::after{content:'';position:absolute;width:400px;height:400px;bottom:-40%;left:-5%;background:radial-gradient(circle,rgba(43,107,150,.15) 0%,transparent 70%);border-radius:50%;pointer-events:none;}
    .vs-hero-inner{position:relative;z-index:2;padding:0 1.5rem;}
    .vs-breadcrumb{display:flex;gap:.5rem;list-style:none;padding:0;margin:0 0 .75rem;font-size:.82rem;}
    .vs-breadcrumb a{color:rgba(255,255,255,.55);text-decoration:none;}
    .vs-breadcrumb a:hover{color:rgba(255,255,255,.85);}
    .vs-breadcrumb .active{color:var(--vs-amber-light);font-weight:600;}
    .vs-breadcrumb .sep{color:rgba(255,255,255,.25);}
    .vs-hero-row{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;}
    .vs-hero-left{display:flex;align-items:center;gap:1rem;}
    .vs-hero-logo{width:52px;height:52px;border-radius:14px;object-fit:cover;border:2px solid rgba(255,255,255,.2);}
    .vs-hero-avatar{width:52px;height:52px;border-radius:14px;background:rgba(255,255,255,.12);border:2px solid rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.3rem;font-weight:800;}
    .vs-hero-title h1{color:#fff;font-size:1.6rem;font-weight:800;margin:0;}
    .vs-hero-meta{display:flex;align-items:center;gap:.75rem;margin-top:.3rem;flex-wrap:wrap;}
    .vs-hero-tag{padding:.15rem .5rem;border-radius:6px;font-size:.72rem;font-weight:600;}
    .vs-hero-tag-code{background:rgba(255,255,255,.12);color:rgba(255,255,255,.8);font-family:monospace;}
    .vs-hero-tag-active{background:rgba(22,163,74,.2);color:#86efac;}
    .vs-hero-tag-inactive{background:rgba(220,38,38,.2);color:#fca5a5;}
    .vs-hero-date{font-size:.78rem;color:rgba(255,255,255,.4);}
    .vs-hero-actions{display:flex;gap:.5rem;}
    .vs-hero-btn{padding:.5rem 1.1rem;border-radius:10px;font-size:.82rem;font-weight:600;border:1px solid rgba(255,255,255,.2);cursor:pointer;display:inline-flex;align-items:center;gap:.35rem;transition:all .2s;background:rgba(255,255,255,.08);color:#fff;text-decoration:none;}
    .vs-hero-btn:hover{background:rgba(255,255,255,.15);color:#fff;text-decoration:none;}
    .vs-hero-btn-amber{background:var(--vs-amber);border-color:var(--vs-amber);}
    .vs-hero-btn-amber:hover{background:var(--vs-amber-light);border-color:var(--vs-amber-light);}

    /* ─── Content ─── */
    .vs-content{margin-top:-4.5rem;position:relative;z-index:10;padding:0 1.5rem 2rem;}

    /* ─── Tabs ─── */
    .vs-tabs{display:flex;gap:.35rem;margin-bottom:1.25rem;background:var(--vs-card);border-radius:14px;border:1px solid var(--vs-border);padding:.35rem;box-shadow:0 2px 12px rgba(0,0,0,.04);flex-wrap:wrap;}
    .vs-tab{padding:.5rem 1.1rem;border-radius:10px;font-size:.82rem;font-weight:600;color:var(--vs-muted);cursor:pointer;transition:all .2s;border:none;background:none;display:flex;align-items:center;gap:.35rem;white-space:nowrap;}
    .vs-tab:hover{background:#f8fafc;color:var(--vs-text);}
    .vs-tab.active{background:var(--vs-navy);color:#fff;box-shadow:0 2px 8px rgba(30,58,95,.2);}
    .vs-tab.active i{color:var(--vs-amber-light);}
    .vs-tab i{font-size:.72rem;}

    /* ─── Stats grid ─── */
    .vs-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:.85rem;margin-bottom:1.25rem;}
    @media(max-width:992px){.vs-stats{grid-template-columns:repeat(2,1fr);}}
    @media(max-width:576px){.vs-stats{grid-template-columns:1fr;}}
    .vs-stat{background:var(--vs-card);border-radius:14px;border:1px solid var(--vs-border);box-shadow:0 2px 12px rgba(0,0,0,.04);padding:.85rem 1rem;transition:all .2s;}
    .vs-stat:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(0,0,0,.06);}
    .vs-stat-label{font-size:.58rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--vs-faint);}
    .vs-stat-val{font-size:1.35rem;font-weight:800;margin-top:.05rem;}
    .vs-stat-sub{font-size:.72rem;margin-top:.1rem;}

    /* ─── Card ─── */
    .vs-card{background:var(--vs-card);border-radius:var(--vs-radius);border:1px solid var(--vs-border);box-shadow:0 2px 12px rgba(0,0,0,.04);overflow:hidden;margin-bottom:1.25rem;}
    .vs-card-header{padding:1rem 1.25rem;border-bottom:1px solid var(--vs-border);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.5rem;}
    .vs-card-header h3{font-size:1rem;font-weight:800;color:var(--vs-text);margin:0;display:flex;align-items:center;gap:.5rem;}
    .vs-card-header h3 i{color:var(--vs-amber);font-size:.9rem;}
    .vs-card-body{padding:1.25rem;}
    .vs-card-footer{padding:.75rem 1.25rem;border-top:1px solid var(--vs-border);}

    /* ─── Table ─── */
    .vs-table{width:100%;border-collapse:separate;border-spacing:0;font-size:.86rem;}
    .vs-table thead th{background:#f8fafc;padding:.6rem 1rem;font-size:.68rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--vs-faint);border-bottom:1px solid var(--vs-border);white-space:nowrap;}
    .vs-table tbody td{padding:.65rem 1rem;border-bottom:1px solid var(--vs-border);vertical-align:middle;color:var(--vs-text);}
    .vs-table tbody tr:last-child td{border-bottom:none;}
    .vs-table tbody tr{transition:background .15s;}
    .vs-table tbody tr:hover{background:#fafbfd;}

    /* ─── Avatar ─── */
    .vs-avatar{width:34px;height:34px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.72rem;flex-shrink:0;background:linear-gradient(135deg,var(--vs-navy),var(--vs-navy-light));color:#fff;}

    /* ─── Badges ─── */
    .vs-badge{padding:.18rem .5rem;border-radius:8px;font-size:.68rem;font-weight:700;text-transform:uppercase;letter-spacing:.3px;}
    .vs-badge-active{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;}
    .vs-badge-inactive{background:#fef2f2;color:#991b1b;border:1px solid #fecaca;}
    .vs-badge-admin{background:#eff6ff;color:#1e40af;border:1px solid #bfdbfe;}
    .vs-badge-member{background:#f3f4f6;color:#374151;border:1px solid #e5e7eb;}
    .vs-badge-draft{background:#fffbeb;color:#92400e;border:1px solid #fde68a;}
    .vs-badge-completed{background:#f3f4f6;color:#374151;border:1px solid #e5e7eb;}

    /* ─── Actions ─── */
    .vs-act{width:30px;height:30px;border-radius:8px;border:1px solid var(--vs-border);background:var(--vs-card);display:inline-flex;align-items:center;justify-content:center;cursor:pointer;transition:all .2s;color:var(--vs-muted);font-size:.7rem;}
    .vs-act:hover{border-color:var(--vs-amber);color:var(--vs-amber);background:#fffbeb;}
    .vs-act-promote{color:var(--vs-blue);}
    .vs-act-promote:hover{background:#eff6ff;border-color:var(--vs-blue);color:var(--vs-blue);}
    .vs-act-demote{color:var(--vs-muted);}
    .vs-act-demote:hover{background:#f3f4f6;border-color:var(--vs-muted);}
    .vs-act-remove{color:var(--vs-red);}
    .vs-act-remove:hover{background:#fef2f2;border-color:var(--vs-red);color:var(--vs-red);}

    /* ─── Add member button ─── */
    .vs-btn-add{padding:.42rem .95rem;border-radius:10px;border:none;background:var(--vs-amber);color:#fff;font-size:.8rem;font-weight:700;cursor:pointer;transition:all .2s;display:inline-flex;align-items:center;gap:.35rem;}
    .vs-btn-add:hover{background:var(--vs-amber-light);transform:translateY(-1px);}

    /* ─── Info table ─── */
    .vs-info-row{display:flex;border-bottom:1px solid var(--vs-border);font-size:.86rem;}
    .vs-info-row:last-child{border-bottom:none;}
    .vs-info-label{width:130px;padding:.55rem 0;color:var(--vs-faint);font-weight:600;flex-shrink:0;}
    .vs-info-value{padding:.55rem 0;color:var(--vs-text);font-weight:500;}

    /* ─── Financial list ─── */
    .vs-fin-item{display:flex;align-items:center;justify-content:space-between;padding:.65rem 0;border-bottom:1px solid var(--vs-border);font-size:.88rem;}
    .vs-fin-item:last-child{border-bottom:none;}
    .vs-fin-label{color:var(--vs-muted);}
    .vs-fin-val{font-weight:700;}

    /* ─── Metric tiles ─── */
    .vs-metrics{display:grid;grid-template-columns:repeat(3,1fr);gap:.75rem;margin-top:1rem;}
    .vs-metric{padding:.85rem;border-radius:12px;text-align:center;}
    .vs-metric-val{font-size:1.15rem;font-weight:800;}
    .vs-metric-label{font-size:.72rem;color:var(--vs-muted);margin-top:.15rem;}

    /* ─── Progress ─── */
    .vs-progress{height:8px;background:#f1f5f9;border-radius:8px;overflow:hidden;}
    .vs-progress-bar{height:100%;border-radius:8px;transition:width .4s;}

    /* ─── Empty ─── */
    .vs-empty{padding:2.5rem 1rem;text-align:center;color:var(--vs-faint);}
    .vs-empty i{font-size:2rem;margin-bottom:.5rem;display:block;color:var(--vs-border);}
    .vs-empty p{margin:0;font-size:.85rem;}

    /* ─── Two-column grid (responsive) ─── */
    .vs-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;}
    @media(max-width:768px){.vs-grid-2{grid-template-columns:1fr;}}

    /* ─── Alert ─── */
    .vs-alert{padding:.65rem 1rem;border-radius:12px;font-size:.85rem;display:flex;align-items:center;gap:.5rem;margin-bottom:1rem;}
    .vs-alert-success{background:#f0fdf4;border:1px solid #bbf7d0;color:#166534;}

    /* ─── Modal ─── */
    .vs-overlay{position:fixed;inset:0;background:rgba(15,23,42,.45);backdrop-filter:blur(4px);z-index:1050;display:flex;align-items:center;justify-content:center;padding:1rem;}
    .vs-modal{background:var(--vs-card);border-radius:var(--vs-radius);box-shadow:0 25px 50px rgba(0,0,0,.15);width:100%;overflow:hidden;animation:vsSlide .2s ease-out;}
    @keyframes vsSlide{from{opacity:0;transform:translateY(20px);}to{opacity:1;transform:translateY(0);}}
    .vs-modal-sm{max-width:440px;}
    .vs-modal-md{max-width:520px;}
    .vs-modal-head{background:linear-gradient(135deg,var(--vs-navy),var(--vs-navy-light));padding:1rem 1.25rem;display:flex;align-items:center;justify-content:space-between;}
    .vs-modal-head h5{color:#fff;font-size:.95rem;font-weight:700;margin:0;display:flex;align-items:center;gap:.4rem;}
    .vs-modal-head h5 i{color:var(--vs-amber);}
    .vs-modal-close{background:none;border:none;color:rgba(255,255,255,.6);font-size:1.2rem;cursor:pointer;padding:0;line-height:1;}
    .vs-modal-close:hover{color:#fff;}
    .vs-modal-body{padding:1.25rem;}
    .vs-modal-foot{padding:.85rem 1.25rem;border-top:1px solid var(--vs-border);display:flex;justify-content:flex-end;gap:.5rem;}

    /* ─── Form elements in modal ─── */
    .vs-label{display:block;font-size:.75rem;font-weight:700;color:var(--vs-muted);text-transform:uppercase;letter-spacing:.4px;margin-bottom:.35rem;}
    .vs-input{width:100%;padding:.5rem .85rem;border:1px solid var(--vs-border);border-radius:10px;font-size:.84rem;color:var(--vs-text);background:var(--vs-card);transition:all .2s;}
    .vs-input:focus{outline:none;border-color:var(--vs-amber);box-shadow:0 0 0 3px rgba(217,119,6,.1);}
    .vs-btn-cancel{padding:.45rem 1rem;border-radius:10px;border:1px solid var(--vs-border);background:var(--vs-card);font-size:.82rem;font-weight:600;cursor:pointer;color:var(--vs-muted);transition:all .2s;}
    .vs-btn-cancel:hover{background:#f8fafc;border-color:var(--vs-muted);}
    .vs-btn-primary{padding:.45rem 1rem;border-radius:10px;border:none;background:var(--vs-amber);color:#fff;font-size:.82rem;font-weight:700;cursor:pointer;transition:all .2s;}
    .vs-btn-primary:hover{background:var(--vs-amber-light);}
    .vs-btn-primary:disabled{opacity:.5;cursor:not-allowed;}
    .vs-btn-danger{padding:.45rem 1rem;border-radius:10px;border:none;background:var(--vs-red);color:#fff;font-size:.82rem;font-weight:700;cursor:pointer;transition:all .2s;}
    .vs-btn-danger:hover{background:#b91c1c;}

    /* ─── User list in add member modal ─── */
    .vs-user-list{max-height:200px;overflow-y:auto;border:1px solid var(--vs-border);border-radius:10px;margin-bottom:1rem;}
    .vs-user-item{padding:.5rem .75rem;display:flex;align-items:center;justify-content:space-between;cursor:pointer;transition:background .15s;border-bottom:1px solid var(--vs-border);}
    .vs-user-item:last-child{border-bottom:none;}
    .vs-user-item:hover{background:#fafbfd;}
    .vs-user-item.selected{background:var(--vs-navy);color:#fff;}
    .vs-user-item.selected .vs-user-email{color:rgba(255,255,255,.6);}
    .vs-user-name{font-weight:700;font-size:.84rem;}
    .vs-user-email{font-size:.76rem;color:var(--vs-muted);}
</style>
@endpush
@endonce

@can('view-village-banks')
<div class="vs-page">
    {{-- ═══ Hero ═══ --}}
    <div class="vs-hero">
        <div class="vs-hero-inner">
            <ul class="vs-breadcrumb">
                <li><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="sep">/</li>
                <li><a href="{{ route('village-banks.index') }}">Village Banks</a></li>
                <li class="sep">/</li>
                <li class="active">{{ $bank->name }}</li>
            </ul>
            <div class="vs-hero-row">
                <div class="vs-hero-left">
                    @if ($bank->logo)
                        <img src="{{ asset('storage/' . $bank->logo) }}" alt="" class="vs-hero-logo">
                    @else
                        <div class="vs-hero-avatar">{{ strtoupper(substr($bank->name, 0, 1)) }}</div>
                    @endif
                    <div>
                        <div class="vs-hero-title">
                            <h1>{{ $bank->name }}</h1>
                        </div>
                        <div class="vs-hero-meta">
                            <span class="vs-hero-tag vs-hero-tag-code">{{ $bank->code }}</span>
                            <span class="vs-hero-tag {{ $bank->status === 'active' ? 'vs-hero-tag-active' : 'vs-hero-tag-inactive' }}">{{ ucfirst($bank->status) }}</span>
                            <span class="vs-hero-date"><i class="fas fa-calendar-alt" style="margin-right:.25rem;"></i>Created {{ $bank->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
                <div class="vs-hero-actions">
                    <a href="{{ route('village-banks.create', ['edit' => $bank->id]) }}" class="vs-hero-btn vs-hero-btn-amber">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('village-banks.index') }}" class="vs-hero-btn">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══ Content ═══ --}}
    <div class="vs-content">

        @if (session()->has('message'))
            <div class="vs-alert vs-alert-success">
                <i class="fas fa-check-circle"></i> {{ session('message') }}
            </div>
        @endif

        {{-- Tabs --}}
        <div class="vs-tabs">
            @foreach (['overview' => ['fas fa-th-large', 'Overview'], 'members' => ['fas fa-users', 'Members'], 'circles' => ['fas fa-circle-notch', 'Circles'], 'finance' => ['fas fa-chart-bar', 'Financials'], 'settings' => ['fas fa-cogs', 'Settings']] as $key => [$icon, $label])
                <button type="button" wire:click="$set('activeTab', '{{ $key }}')" class="vs-tab {{ $activeTab === $key ? 'active' : '' }}">
                    <i class="{{ $icon }}"></i> {{ $label }}
                </button>
            @endforeach
        </div>

        {{-- ════════════════════════════════════════════════════
             OVERVIEW TAB
             ════════════════════════════════════════════════════ --}}
        @if ($activeTab === 'overview')
            @php $s = $this->stats; @endphp

            {{-- Row 1: Core stats --}}
            <div class="vs-stats">
                <div class="vs-stat">
                    <div class="vs-stat-label">Total Circles</div>
                    <div class="vs-stat-val" style="color:var(--vs-blue);">{{ $s['totalCircles'] }}</div>
                    <div class="vs-stat-sub" style="color:var(--vs-green);">{{ $s['activeCircles'] }} active</div>
                </div>
                <div class="vs-stat">
                    <div class="vs-stat-label">Total Members</div>
                    <div class="vs-stat-val" style="color:var(--vs-purple);">{{ $s['totalMembers'] }}</div>
                    <div class="vs-stat-sub" style="color:var(--vs-amber);">{{ $s['adminCount'] }} admins</div>
                </div>
                <div class="vs-stat">
                    <div class="vs-stat-label">Contributions</div>
                    <div class="vs-stat-val" style="color:var(--vs-cyan);">K{{ number_format($s['totalContributions'], 2) }}</div>
                </div>
                <div class="vs-stat">
                    <div class="vs-stat-label">Distributed</div>
                    <div class="vs-stat-val" style="color:var(--vs-amber);">K{{ number_format($s['totalDistributed'], 2) }}</div>
                    <div class="vs-stat-sub" style="color:var(--vs-muted);">{{ $s['totalShareouts'] }} shareouts</div>
                </div>
            </div>

            {{-- Row 2: Loan stats --}}
            <div class="vs-stats">
                <div class="vs-stat">
                    <div class="vs-stat-label">Total Loans</div>
                    <div class="vs-stat-val" style="color:var(--vs-orange);">{{ $s['totalLoans'] }}</div>
                    <div class="vs-stat-sub" style="color:var(--vs-orange);">K{{ number_format($s['totalLoanAmount'], 2) }}</div>
                </div>
                <div class="vs-stat">
                    <div class="vs-stat-label">Total Repaid</div>
                    <div class="vs-stat-val" style="color:var(--vs-green);">K{{ number_format($s['totalRepaid'], 2) }}</div>
                </div>
                <div class="vs-stat">
                    <div class="vs-stat-label">Outstanding</div>
                    <div class="vs-stat-val" style="color:var(--vs-red);">K{{ number_format($s['totalOutstanding'], 2) }}</div>
                </div>
                <div class="vs-stat">
                    <div class="vs-stat-label">Penalties</div>
                    <div class="vs-stat-val" style="color:var(--vs-purple);">K{{ number_format($s['totalPenalties'], 2) }}</div>
                </div>
            </div>

            {{-- Bank information --}}
            <div class="vs-grid-2">
                <div class="vs-card" style="margin-bottom:0;">
                    <div class="vs-card-header"><h3><i class="fas fa-id-card"></i> Bank Information</h3></div>
                    <div class="vs-card-body">
                        <div class="vs-info-row"><div class="vs-info-label">Name</div><div class="vs-info-value"><strong>{{ $bank->name }}</strong></div></div>
                        <div class="vs-info-row"><div class="vs-info-label">Code</div><div class="vs-info-value"><span style="background:#f1f5f9;color:var(--vs-navy);padding:.1rem .45rem;border-radius:6px;font-size:.82rem;font-weight:700;font-family:monospace;">{{ $bank->code }}</span></div></div>
                        <div class="vs-info-row">
                            <div class="vs-info-label">Status</div>
                            <div class="vs-info-value">
                                <span class="vs-badge {{ $bank->status === 'active' ? 'vs-badge-active' : 'vs-badge-inactive' }}">{{ ucfirst($bank->status) }}</span>
                            </div>
                        </div>
                        <div class="vs-info-row"><div class="vs-info-label">Created By</div><div class="vs-info-value">{{ $bank->creator->name ?? '—' }}</div></div>
                    </div>
                </div>

                <div class="vs-card" style="margin-bottom:0;">
                    <div class="vs-card-header"><h3><i class="fas fa-address-book"></i> Contact Details</h3></div>
                    <div class="vs-card-body">
                        <div class="vs-info-row"><div class="vs-info-label">Email</div><div class="vs-info-value">{{ $bank->email ?? '—' }}</div></div>
                        <div class="vs-info-row"><div class="vs-info-label">Phone</div><div class="vs-info-value">{{ $bank->phone ?? '—' }}</div></div>
                        <div class="vs-info-row"><div class="vs-info-label">Address</div><div class="vs-info-value">{{ $bank->address ?? '—' }}</div></div>
                        <div class="vs-info-row"><div class="vs-info-label">Description</div><div class="vs-info-value">{{ $bank->description ?? '—' }}</div></div>
                    </div>
                </div>
            </div>

            {{-- Subscription & License --}}
            <div class="vs-grid-2" style="margin-top:1.25rem;">
                <div class="vs-card" style="margin-bottom:0;">
                    <div class="vs-card-header"><h3><i class="fas fa-file-contract"></i> Subscription</h3></div>
                    <div class="vs-card-body">
                        @if ($subscription)
                            <div class="vs-info-row">
                                <div class="vs-info-label">Status</div>
                                <div class="vs-info-value"><span class="vs-badge vs-badge-active">Active</span></div>
                            </div>
                            <div class="vs-info-row">
                                <div class="vs-info-label">Plan</div>
                                <div class="vs-info-value">{{ ucfirst($subscription->plan ?? '—') }}</div>
                            </div>
                            <div class="vs-info-row">
                                <div class="vs-info-label">Started</div>
                                <div class="vs-info-value">{{ optional($subscription->created_at)->format('d M Y') ?? '—' }}</div>
                            </div>
                        @else
                            <div class="vs-empty" style="padding:1.5rem 1rem;">
                                <i class="fas fa-file-contract"></i>
                                <p>No active subscription</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="vs-card" style="margin-bottom:0;">
                    <div class="vs-card-header"><h3><i class="fas fa-key"></i> License</h3></div>
                    <div class="vs-card-body">
                        @if ($license)
                            <div class="vs-info-row">
                                <div class="vs-info-label">Status</div>
                                <div class="vs-info-value"><span class="vs-badge vs-badge-active">Active</span></div>
                            </div>
                            <div class="vs-info-row">
                                <div class="vs-info-label">Key</div>
                                <div class="vs-info-value"><span style="background:#f1f5f9;color:var(--vs-navy);padding:.1rem .45rem;border-radius:6px;font-size:.78rem;font-weight:700;font-family:monospace;">{{ Str::limit($license->license_key, 20) }}</span></div>
                            </div>
                            <div class="vs-info-row">
                                <div class="vs-info-label">Expires</div>
                                <div class="vs-info-value">
                                    {{ $license->expires_at->format('d M Y') }}
                                    @if ($license->expires_at->diffInDays(now()) <= 30)
                                        <span class="vs-badge vs-badge-draft" style="margin-left:.35rem;">{{ $license->expires_at->diffForHumans() }}</span>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="vs-empty" style="padding:1.5rem 1rem;">
                                <i class="fas fa-key"></i>
                                <p>No active license</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        {{-- ════════════════════════════════════════════════════
             MEMBERS TAB
             ════════════════════════════════════════════════════ --}}
        @if ($activeTab === 'members')
            <div class="vs-card">
                <div class="vs-card-header">
                    <h3><i class="fas fa-users"></i> Members ({{ $members->total() }})</h3>
                    <button type="button" wire:click="openAddMember" class="vs-btn-add">
                        <i class="fas fa-user-plus"></i> Add Member
                    </button>
                </div>
                <div style="overflow-x:auto;">
                    <table class="vs-table">
                        <thead>
                            <tr>
                                <th>Member</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Joined</th>
                                <th style="width:120px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($members as $m)
                                <tr wire:key="member-{{ $m->id }}">
                                    <td>
                                        <div style="display:flex;align-items:center;gap:.55rem;">
                                            <div class="vs-avatar">{{ strtoupper(substr($m->name, 0, 1)) }}</div>
                                            <strong style="font-size:.86rem;">{{ $m->name }}</strong>
                                        </div>
                                    </td>
                                    <td style="font-size:.82rem;color:var(--vs-muted);">{{ $m->email }}</td>
                                    <td>
                                        <span class="vs-badge {{ $m->pivot->role === 'admin' ? 'vs-badge-admin' : 'vs-badge-member' }}">
                                            {{ ucfirst($m->pivot->role) }}
                                        </span>
                                    </td>
                                    <td style="font-size:.8rem;color:var(--vs-muted);">
                                        {{ $m->pivot->joined_at ? \Carbon\Carbon::parse($m->pivot->joined_at)->format('d M Y') : '—' }}
                                    </td>
                                    <td>
                                        <div style="display:flex;gap:.3rem;">
                                            @if ($m->pivot->role === 'member')
                                                <button type="button" wire:click="changeRole({{ $m->id }}, 'admin')" class="vs-act vs-act-promote" title="Promote to Admin">
                                                    <i class="fas fa-arrow-up"></i>
                                                </button>
                                            @else
                                                <button type="button" wire:click="changeRole({{ $m->id }}, 'member')" class="vs-act vs-act-demote" title="Demote to Member">
                                                    <i class="fas fa-arrow-down"></i>
                                                </button>
                                            @endif
                                            <button type="button" wire:click="confirmRemoveMember({{ $m->id }})" class="vs-act vs-act-remove" title="Remove">
                                                <i class="fas fa-user-minus"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="vs-empty">
                                            <i class="fas fa-users"></i>
                                            <p>No members yet</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($members->hasPages())
                    <div class="vs-card-footer">{{ $members->links() }}</div>
                @endif
            </div>
        @endif

        {{-- ════════════════════════════════════════════════════
             CIRCLES TAB
             ════════════════════════════════════════════════════ --}}
        @if ($activeTab === 'circles')
            <div class="vs-card">
                <div class="vs-card-header">
                    <h3><i class="fas fa-circle-notch"></i> Circles ({{ $circles->count() }})</h3>
                    @can('create-circles')
                        <a href="{{ route('circles.create') }}" class="vs-btn-add" style="text-decoration:none;">
                            <i class="fas fa-plus"></i> Create Circle
                        </a>
                    @endcan
                </div>
                <div style="overflow-x:auto;">
                    <table class="vs-table">
                        <thead>
                            <tr>
                                <th>Circle</th>
                                <th>Members</th>
                                <th>Duration</th>
                                <th>Start Date</th>
                                <th>Status</th>
                                <th>Created By</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($circles as $c)
                                @php
                                    $badgeClass = ['active' => 'vs-badge-active', 'draft' => 'vs-badge-draft', 'completed' => 'vs-badge-completed'][$c->status] ?? 'vs-badge-inactive';
                                @endphp
                                <tr wire:key="circle-{{ $c->id }}">
                                    <td><strong style="font-size:.86rem;">{{ $c->name }}</strong></td>
                                    <td>
                                        <span style="display:inline-flex;align-items:center;gap:.25rem;background:rgba(124,58,237,.08);color:var(--vs-purple);padding:.15rem .45rem;border-radius:6px;font-size:.76rem;font-weight:700;">
                                            <i class="fas fa-users" style="font-size:.58rem;"></i> {{ $c->members_count }}
                                        </span>
                                    </td>
                                    <td style="font-size:.84rem;">{{ $c->duration_months }} months</td>
                                    <td style="font-size:.82rem;color:var(--vs-muted);">{{ $c->start_date->format('d M Y') }}</td>
                                    <td><span class="vs-badge {{ $badgeClass }}">{{ ucfirst($c->status) }}</span></td>
                                    <td style="font-size:.82rem;color:var(--vs-muted);">{{ $c->creator->name ?? '—' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="vs-empty">
                                            <i class="fas fa-circle-notch"></i>
                                            <p>No circles yet</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        {{-- ════════════════════════════════════════════════════
             FINANCE TAB
             ════════════════════════════════════════════════════ --}}
        @if ($activeTab === 'finance')
            @php $s = $this->stats; @endphp

            <div class="vs-grid-2">
                {{-- Financial Summary --}}
                <div class="vs-card" style="margin-bottom:0;">
                    <div class="vs-card-header"><h3><i class="fas fa-chart-pie"></i> Financial Summary</h3></div>
                    <div class="vs-card-body">
                        <div class="vs-fin-item">
                            <span class="vs-fin-label">Total Contributions</span>
                            <span class="vs-fin-val" style="color:var(--vs-cyan);">K{{ number_format($s['totalContributions'], 2) }}</span>
                        </div>
                        <div class="vs-fin-item">
                            <span class="vs-fin-label">Total Loans Issued</span>
                            <span class="vs-fin-val" style="color:var(--vs-orange);">K{{ number_format($s['totalLoanAmount'], 2) }}</span>
                        </div>
                        <div class="vs-fin-item">
                            <span class="vs-fin-label">Total Repaid</span>
                            <span class="vs-fin-val" style="color:var(--vs-green);">K{{ number_format($s['totalRepaid'], 2) }}</span>
                        </div>
                        <div class="vs-fin-item">
                            <span class="vs-fin-label">Outstanding Balance</span>
                            <span class="vs-fin-val" style="color:var(--vs-red);">K{{ number_format($s['totalOutstanding'], 2) }}</span>
                        </div>
                        <div class="vs-fin-item">
                            <span class="vs-fin-label">Penalties Collected</span>
                            <span class="vs-fin-val" style="color:var(--vs-purple);">K{{ number_format($s['totalPenalties'], 2) }}</span>
                        </div>
                        <div class="vs-fin-item">
                            <span class="vs-fin-label">Distributed (Shareouts)</span>
                            <span class="vs-fin-val" style="color:var(--vs-amber);">K{{ number_format($s['totalDistributed'], 2) }}</span>
                        </div>
                    </div>
                </div>

                {{-- Key Metrics --}}
                <div class="vs-card" style="margin-bottom:0;">
                    <div class="vs-card-header"><h3><i class="fas fa-tachometer-alt"></i> Key Metrics</h3></div>
                    <div class="vs-card-body">
                        @php
                            $repayRate = $s['totalLoanAmount'] > 0 ? round(($s['totalRepaid'] / $s['totalLoanAmount']) * 100) : 0;
                        @endphp
                        <div style="margin-bottom:1.25rem;">
                            <div style="display:flex;justify-content:space-between;margin-bottom:.4rem;font-size:.84rem;">
                                <span style="color:var(--vs-muted);">Loan Repayment Rate</span>
                                <strong style="color:var(--vs-text);">{{ $repayRate }}%</strong>
                            </div>
                            <div class="vs-progress">
                                <div class="vs-progress-bar" style="width:{{ $repayRate }}%;background:linear-gradient(90deg,var(--vs-green),#4ade80);"></div>
                            </div>
                        </div>

                        <div class="vs-metrics">
                            <div class="vs-metric" style="background:rgba(37,99,235,.06);">
                                <div class="vs-metric-val" style="color:var(--vs-blue);">{{ $s['totalCircles'] }}</div>
                                <div class="vs-metric-label">Circles</div>
                            </div>
                            <div class="vs-metric" style="background:rgba(22,163,74,.06);">
                                <div class="vs-metric-val" style="color:var(--vs-green);">{{ $s['totalLoans'] }}</div>
                                <div class="vs-metric-label">Loans</div>
                            </div>
                            <div class="vs-metric" style="background:rgba(217,119,6,.06);">
                                <div class="vs-metric-val" style="color:var(--vs-amber);">{{ $s['totalShareouts'] }}</div>
                                <div class="vs-metric-label">Shareouts</div>
                            </div>
                        </div>

                        {{-- Quick Links --}}
                        <div style="display:flex;flex-wrap:wrap;gap:.5rem;margin-top:1rem;">
                            @can('view-loans')
                                <a href="{{ route('loans.index') }}" class="vs-hero-btn" style="background:rgba(37,99,235,.08);border-color:rgba(37,99,235,.15);color:var(--vs-blue);font-size:.78rem;padding:.4rem .85rem;">
                                    <i class="fas fa-hand-holding-usd"></i> All Loans
                                </a>
                            @endcan
                            <a href="{{ route('shareout.index') }}" class="vs-hero-btn" style="background:rgba(217,119,6,.08);border-color:rgba(217,119,6,.15);color:var(--vs-amber);font-size:.78rem;padding:.4rem .85rem;">
                                <i class="fas fa-calculator"></i> Shareout Calculator
                            </a>
                            @canany(['view-shares', 'declare-shares'])
                                <a href="{{ route('shares.declare') }}" class="vs-hero-btn" style="background:rgba(124,58,237,.08);border-color:rgba(124,58,237,.15);color:var(--vs-purple);font-size:.78rem;padding:.4rem .85rem;">
                                    <i class="fas fa-coins"></i> Shares &amp; Insurance
                                </a>
                            @endcanany
                        </div>
                    </div>
                </div>
            </div>
        @endif


        {{-- ════════════════════════════════════════════════════
             SETTINGS TAB
             ════════════════════════════════════════════════════ --}}
        @if ($activeTab === 'settings')
            @php $cfg = $config; @endphp

            @can('manage-bank-config')
                <div style="margin-bottom:1rem;display:flex;justify-content:flex-end;">
                    <a href="{{ route('settings.bank-config') }}" class="vs-hero-btn vs-hero-btn-amber" style="text-decoration:none;">
                        <i class="fas fa-edit"></i> Edit Configuration
                    </a>
                </div>
            @endcan

            <div class="vs-grid-2">
                {{-- Shares & Insurance --}}
                <div class="vs-card" style="margin-bottom:0;">
                    <div class="vs-card-header"><h3><i class="fas fa-coins"></i> Shares &amp; Insurance</h3></div>
                    <div class="vs-card-body">
                        <div class="vs-info-row">
                            <div class="vs-info-label">Share Unit</div>
                            <div class="vs-info-value"><strong>K{{ number_format($cfg->share_unit_amount, 2) }}</strong></div>
                        </div>
                        <div class="vs-info-row">
                            <div class="vs-info-label">Min Shares/Mo</div>
                            <div class="vs-info-value">{{ $cfg->min_shares_per_month }}</div>
                        </div>
                        <div class="vs-info-row">
                            <div class="vs-info-label">Max Shares/Mo</div>
                            <div class="vs-info-value">{{ $cfg->max_shares_per_month }}</div>
                        </div>
                        <div class="vs-info-row">
                            <div class="vs-info-label">Insurance Type</div>
                            <div class="vs-info-value"><span class="vs-badge vs-badge-member">{{ ucfirst($cfg->insurance_type) }}</span></div>
                        </div>
                        <div class="vs-info-row">
                            <div class="vs-info-label">Insurance Value</div>
                            <div class="vs-info-value">K{{ number_format($cfg->insurance_value, 2) }}</div>
                        </div>
                        <div class="vs-info-row">
                            <div class="vs-info-label">Profit to Members</div>
                            <div class="vs-info-value">
                                @if ($cfg->insurance_profit_to_members)
                                    <span class="vs-badge vs-badge-active">Yes</span>
                                @else
                                    <span class="vs-badge vs-badge-inactive">No</span>
                                @endif
                            </div>
                        </div>
                        <div class="vs-info-row">
                            <div class="vs-info-label">Circle Duration</div>
                            <div class="vs-info-value">{{ $cfg->circle_duration_months }} months</div>
                        </div>
                    </div>
                </div>

                {{-- Loan Settings --}}
                <div class="vs-card" style="margin-bottom:0;">
                    <div class="vs-card-header"><h3><i class="fas fa-hand-holding-usd"></i> Loan Settings</h3></div>
                    <div class="vs-card-body">
                        <div class="vs-info-row">
                            <div class="vs-info-label">Loan Multiplier</div>
                            <div class="vs-info-value"><strong>{{ $cfg->max_loan_multiplier }}x</strong> shares</div>
                        </div>
                        <div class="vs-info-row">
                            <div class="vs-info-label">Interest Rate</div>
                            <div class="vs-info-value">{{ number_format($cfg->default_interest_rate, 1) }}%</div>
                        </div>
                        <div class="vs-info-row">
                            <div class="vs-info-label">Interest Type</div>
                            <div class="vs-info-value"><span class="vs-badge vs-badge-member">{{ ucfirst($cfg->interest_type) }}</span></div>
                        </div>
                        @if ($cfg->interest_type === 'reducing')
                            <div class="vs-info-row">
                                <div class="vs-info-label">Reducing Rate</div>
                                <div class="vs-info-value">{{ number_format($cfg->reducing_balance_rate, 1) }}%</div>
                            </div>
                        @endif
                        <div class="vs-info-row">
                            <div class="vs-info-label">Loan Duration</div>
                            <div class="vs-info-value">{{ $cfg->default_loan_duration }} month{{ $cfg->default_loan_duration > 1 ? 's' : '' }}</div>
                        </div>
                        <div class="vs-info-row">
                            <div class="vs-info-label">Multiple Loans</div>
                            <div class="vs-info-value">
                                @if ($cfg->allow_multiple_active_loans)
                                    <span class="vs-badge vs-badge-active">Allowed</span>
                                @else
                                    <span class="vs-badge vs-badge-inactive">Not Allowed</span>
                                @endif
                            </div>
                        </div>
                        @if ($cfg->min_loan_amount)
                            <div class="vs-info-row">
                                <div class="vs-info-label">Min Loan</div>
                                <div class="vs-info-value">K{{ number_format($cfg->min_loan_amount, 2) }}</div>
                            </div>
                        @endif
                        @if ($cfg->max_loan_amount)
                            <div class="vs-info-row">
                                <div class="vs-info-label">Max Loan</div>
                                <div class="vs-info-value">K{{ number_format($cfg->max_loan_amount, 2) }}</div>
                            </div>
                        @endif
                        <div class="vs-info-row">
                            <div class="vs-info-label">Late Penalty</div>
                            <div class="vs-info-value">{{ number_format($cfg->late_repayment_penalty_rate, 1) }}%</div>
                        </div>
                        <div class="vs-info-row">
                            <div class="vs-info-label">Grace Period</div>
                            <div class="vs-info-value">{{ $cfg->grace_period_days }} day{{ $cfg->grace_period_days !== 1 ? 's' : '' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        @endif



    </div>

    {{-- ═══ Add Member Modal ═══ --}}
    @if ($showAddMember)
        <div class="vs-overlay" wire:click.self="closeAddMember">
            <div class="vs-modal vs-modal-md">
                <div class="vs-modal-head">
                    <h5><i class="fas fa-user-plus"></i> Add Member to {{ $bank->name }}</h5>
                    <button type="button" class="vs-modal-close" wire:click="closeAddMember">&times;</button>
                </div>
                <div class="vs-modal-body">
                    <div style="margin-bottom:1rem;">
                        <label class="vs-label">Search User</label>
                        <input type="text" wire:model.live.debounce.300ms="memberSearch" class="vs-input" placeholder="Type name, email or staff number...">
                    </div>

                    @if ($this->searchUsers->count())
                        <div class="vs-user-list">
                            @foreach ($this->searchUsers as $u)
                                <div wire:click="$set('selectedUserId', {{ $u->id }})"
                                     class="vs-user-item {{ $selectedUserId == $u->id ? 'selected' : '' }}">
                                    <div style="display:flex;align-items:center;gap:.5rem;">
                                        <div class="vs-avatar" style="width:30px;height:30px;font-size:.64rem;">{{ strtoupper(substr($u->name, 0, 1)) }}</div>
                                        <div>
                                            <div class="vs-user-name">{{ $u->name }}</div>
                                            <div class="vs-user-email">{{ $u->email }}</div>
                                        </div>
                                    </div>
                                    @if ($selectedUserId == $u->id)
                                        <i class="fas fa-check-circle" style="color:var(--vs-amber-light);"></i>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @elseif (strlen($memberSearch) >= 2)
                        <p style="text-align:center;color:var(--vs-faint);font-size:.82rem;padding:.75rem 0;">No users found.</p>
                    @endif

                    <div style="margin-bottom:.5rem;">
                        <label class="vs-label">Role</label>
                        <select wire:model.live="memberRole" class="vs-input">
                            <option value="member">Member</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    @error('selectedUserId') <div style="font-size:.76rem;color:var(--vs-red);margin-top:.25rem;">{{ $message }}</div> @enderror
                </div>
                <div class="vs-modal-foot">
                    <button type="button" wire:click="closeAddMember" class="vs-btn-cancel">Cancel</button>
                    <button type="button" wire:click="addMember" class="vs-btn-primary" wire:loading.attr="disabled" wire:target="addMember" {{ !$selectedUserId ? 'disabled' : '' }}>
                        <span wire:loading.remove wire:target="addMember"><i class="fas fa-user-plus" style="margin-right:.3rem;"></i> Add Member</span>
                        <span wire:loading wire:target="addMember"><i class="fas fa-spinner fa-spin" style="margin-right:.3rem;"></i> Adding...</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- ═══ Remove Member Modal ═══ --}}
    @if ($removeMemberId)
        <div class="vs-overlay" wire:click.self="$set('removeMemberId', null)">
            <div class="vs-modal vs-modal-sm">
                <div class="vs-modal-head">
                    <h5><i class="fas fa-user-minus"></i> Remove Member</h5>
                    <button type="button" class="vs-modal-close" wire:click="$set('removeMemberId', null)">&times;</button>
                </div>
                <div class="vs-modal-body" style="text-align:center;">
                    <div style="width:56px;height:56px;border-radius:50%;background:#fef2f2;display:flex;align-items:center;justify-content:center;margin:0 auto .85rem;">
                        <i class="fas fa-user-minus" style="font-size:1.2rem;color:var(--vs-red);"></i>
                    </div>
                    <p style="margin:0 0 .35rem;font-weight:600;font-size:.95rem;color:var(--vs-text);">Remove "{{ $removeMemberName }}"?</p>
                    <p style="font-size:.82rem;color:var(--vs-muted);margin:0;">This member will be removed from {{ $bank->name }}.</p>
                </div>
                <div class="vs-modal-foot">
                    <button type="button" wire:click="$set('removeMemberId', null)" class="vs-btn-cancel">Cancel</button>
                    <button type="button" wire:click="removeMember" class="vs-btn-danger"><i class="fas fa-user-minus" style="margin-right:.3rem;"></i> Remove</button>
                </div>
            </div>
        </div>
    @endif
</div>
@else
    @include('livewire.partials.unauthorized')
@endcan
</div>
