<div>
    @push('custom-styles')
    <style>
        :root {
            --ls-navy:#1E3A5F; --ls-navy-light:#2B6B96; --ls-amber:#D97706; --ls-amber-light:#F59E0B;
            --ls-bg:#f4f6fa; --ls-card:#fff; --ls-border:#edf0f7; --ls-text:#1e293b;
            --ls-muted:#64748b; --ls-faint:#94a3b8; --ls-green:#16a34a; --ls-red:#dc2626; --ls-blue:#2563eb; --ls-radius:16px;
        }
        .ls-page { background:var(--ls-bg); min-height:100vh; }

        /* Hero */
        .ls-hero {
            background:linear-gradient(135deg,var(--ls-navy) 0%,#234b78 50%,var(--ls-navy-light) 100%);
            padding:1.75rem 0 6rem; position:relative; overflow:hidden;
        }
        .ls-hero::before { content:''; position:absolute; width:600px; height:600px; top:-60%; right:-8%; background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
        .ls-hero-inner { position:relative; z-index:2; padding:0 1.5rem; }
        .ls-breadcrumb { display:flex; gap:.5rem; list-style:none; padding:0; margin:0; font-size:.82rem; }
        .ls-breadcrumb a { color:rgba(255,255,255,.55); text-decoration:none; }
        .ls-breadcrumb a:hover { color:rgba(255,255,255,.85); }
        .ls-breadcrumb .active { color:var(--ls-amber-light); font-weight:600; }
        .ls-breadcrumb .sep { color:rgba(255,255,255,.25); }
        .ls-back { display:inline-flex; align-items:center; gap:.35rem; color:rgba(255,255,255,.65); font-size:.82rem; font-weight:600; text-decoration:none; margin-bottom:.6rem; }
        .ls-back:hover { color:#fff; text-decoration:none; }

        /* Content */
        .ls-content { margin-top:-4.5rem; position:relative; z-index:10; padding:0 1.5rem 2rem; }

        /* Grid */
        .ls-grid { display:grid; grid-template-columns:320px 1fr; gap:1.25rem; align-items:start; }
        @media(max-width:992px){ .ls-grid { grid-template-columns:1fr; } }

        /* Sidebar */
        .ls-sidebar { background:var(--ls-card); border-radius:var(--ls-radius); border:1px solid var(--ls-border); box-shadow:0 2px 12px rgba(0,0,0,.04); overflow:hidden; }
        .ls-sidebar-header {
            background:linear-gradient(135deg,var(--ls-navy) 0%,var(--ls-navy-light) 100%);
            padding:1.5rem; text-align:center;
        }
        .ls-loan-id { color:rgba(255,255,255,.5); font-size:.78rem; font-weight:600; letter-spacing:.5px; }
        .ls-loan-amount { color:#fff; font-size:1.8rem; font-weight:800; margin:.25rem 0; }
        .ls-sidebar-badge {
            display:inline-flex; align-items:center; gap:.25rem; padding:.2rem .65rem; border-radius:8px;
            font-size:.7rem; font-weight:700;
        }
        .ls-sidebar-body { padding:1.25rem 1.5rem; }
        .ls-info-row { display:flex; align-items:flex-start; gap:.65rem; padding:.55rem 0; border-bottom:1px solid #f5f7fa; }
        .ls-info-row:last-child { border-bottom:none; }
        .ls-info-icon { width:32px; height:32px; border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:.7rem; flex-shrink:0; background:#f8fafc; color:var(--ls-muted); }
        .ls-info-label { font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--ls-faint); }
        .ls-info-value { font-size:.88rem; font-weight:600; color:var(--ls-text); margin-top:.05rem; }

        /* Progress cards */
        .ls-progress-cards { display:grid; grid-template-columns:1fr 1fr; gap:.75rem; margin-top:1rem; }
        .ls-pcard {
            background:var(--ls-card); border-radius:var(--ls-radius); border:1px solid var(--ls-border);
            box-shadow:0 2px 12px rgba(0,0,0,.04); padding:.85rem 1rem; text-align:center;
        }
        .ls-pcard-label { font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--ls-faint); }
        .ls-pcard-value { font-size:1.2rem; font-weight:800; margin:.15rem 0; }
        .ls-pcard-bar { height:6px; border-radius:6px; background:#e2e8f0; overflow:hidden; margin-top:.35rem; }
        .ls-pcard-fill { height:100%; border-radius:6px; transition:width .3s; }
        .ls-pcard-pct { font-size:.68rem; color:var(--ls-faint); font-weight:600; margin-top:.2rem; }

        /* Main */
        .ls-main { background:var(--ls-card); border-radius:var(--ls-radius); border:1px solid var(--ls-border); box-shadow:0 2px 12px rgba(0,0,0,.04); overflow:hidden; }

        /* Tabs */
        .ls-tabs { display:flex; overflow-x:auto; border-bottom:2px solid var(--ls-border); scrollbar-width:none; }
        .ls-tabs::-webkit-scrollbar { display:none; }
        .ls-tab {
            display:flex; align-items:center; gap:.35rem; padding:.85rem 1.15rem; font-size:.8rem; font-weight:600;
            color:var(--ls-muted); border:none; background:none; cursor:pointer;
            border-bottom:2px solid transparent; margin-bottom:-2px; white-space:nowrap; transition:all .15s;
        }
        .ls-tab:hover { color:var(--ls-text); background:#fafbfd; }
        .ls-tab.active { color:var(--ls-amber); border-bottom-color:var(--ls-amber); }
        .ls-tab i { font-size:.72rem; }

        /* Tab body */
        .ls-tab-body { padding:1.25rem 1.5rem; }
        .ls-section-title { font-size:.92rem; font-weight:700; color:var(--ls-text); margin-bottom:.85rem; padding-bottom:.5rem; border-bottom:1px solid var(--ls-border); }

        /* Detail grid */
        .ls-detail-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:.75rem 1.5rem; }
        @media(max-width:576px){ .ls-detail-grid { grid-template-columns:1fr; } }
        .ls-detail-label { font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--ls-faint); }
        .ls-detail-value { font-size:.88rem; font-weight:600; color:var(--ls-text); margin-top:.05rem; }

        /* Sub-table */
        .ls-subtable { width:100%; border-collapse:collapse; }
        .ls-subtable thead th {
            font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--ls-faint);
            padding:.6rem .75rem; border-bottom:1px solid var(--ls-border); background:#fafbfd;
        }
        .ls-subtable tbody td { padding:.65rem .75rem; border-bottom:1px solid #f5f7fa; font-size:.84rem; vertical-align:middle; }
        .ls-subtable tbody tr:last-child td { border-bottom:none; }
        .ls-subtable tbody tr:hover { background:#fafbfd; }

        /* Badge */
        .ls-badge { display:inline-flex; align-items:center; gap:.2rem; padding:.15rem .55rem; border-radius:8px; font-size:.68rem; font-weight:700; }

        /* Avatar */
        .ls-avatar {
            width:32px; height:32px; border-radius:50%; display:flex; align-items:center; justify-content:center;
            font-weight:700; font-size:.65rem; flex-shrink:0;
            background:linear-gradient(135deg,var(--ls-navy),var(--ls-navy-light)); color:#fff;
        }

        /* Empty */
        .ls-empty { text-align:center; padding:2rem 1rem; color:var(--ls-faint); }
        .ls-empty i { font-size:2rem; opacity:.15; display:block; margin-bottom:.5rem; }
        .ls-empty p { font-size:.84rem; color:var(--ls-muted); margin:0; }

        /* Borrower card */
        .ls-borrower-card {
            display:flex; align-items:center; gap:.75rem; padding:.85rem 1rem;
            border-radius:12px; background:#f8fafc; border:1px solid var(--ls-border);
        }
        .ls-borrower-avatar {
            width:48px; height:48px; border-radius:50%; display:flex; align-items:center; justify-content:center;
            font-weight:800; font-size:.9rem;
            background:linear-gradient(135deg,var(--ls-navy),var(--ls-navy-light)); color:#fff; flex-shrink:0;
        }

        @keyframes lsSlide { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
        .ls-animate { animation:lsSlide .3s ease; }
        @media(max-width:768px){ .ls-content{padding:0 .75rem 1.5rem;} }
    </style>
    @endpush

    @can('view-loans')
    <section class="content ls-page">
        {{-- Hero --}}
        <div class="ls-hero">
            <div class="ls-hero-inner container-fluid">
                <a href="{{ route('loans.index') }}" class="ls-back"><i class="fas fa-arrow-left"></i> Back to Loans</a>
                <ul class="ls-breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('loans.index') }}">Loans</a></li>
                    <li class="sep">/</li>
                    <li class="active">Loan #{{ $loan->id }}</li>
                </ul>
            </div>
        </div>

        {{-- Content --}}
        <div class="ls-content container-fluid">
            <div class="ls-grid ls-animate">
                {{-- Left Sidebar --}}
                <div>
                    <div class="ls-sidebar">
                        <div class="ls-sidebar-header">
                            <div class="ls-loan-id">LOAN #{{ $loan->id }}</div>
                            <div class="ls-loan-amount">K{{ number_format($loan->amount, 2) }}</div>
                            @php
                                $sc = [
                                    'pending'   => ['bg'=>'rgba(234,179,8,.15)','color'=>'#fde68a'],
                                    'approved'  => ['bg'=>'rgba(37,99,235,.15)','color'=>'#93c5fd'],
                                    'active'    => ['bg'=>'rgba(34,197,94,.15)','color'=>'#86efac'],
                                    'completed' => ['bg'=>'rgba(22,163,74,.15)','color'=>'#86efac'],
                                    'rejected'  => ['bg'=>'rgba(239,68,68,.15)','color'=>'#fca5a5'],
                                ][$loan->status] ?? ['bg'=>'rgba(255,255,255,.1)','color'=>'rgba(255,255,255,.7)'];
                            @endphp
                            <span class="ls-sidebar-badge" style="background:{{ $sc['bg'] }};color:{{ $sc['color'] }};">
                                <i class="fas fa-circle" style="font-size:.35rem;"></i> {{ ucfirst($loan->status) }}
                            </span>
                        </div>
                        <div class="ls-sidebar-body">
                            <div class="ls-info-row">
                                <div class="ls-info-icon"><i class="fas fa-percentage"></i></div>
                                <div><div class="ls-info-label">Interest Rate</div><div class="ls-info-value">{{ $loan->interest_rate }}%</div></div>
                            </div>
                            <div class="ls-info-row">
                                <div class="ls-info-icon"><i class="fas fa-calculator"></i></div>
                                <div><div class="ls-info-label">Total Payable</div><div class="ls-info-value" style="color:#1e40af;">K{{ number_format($loan->total_payable, 2) }}</div></div>
                            </div>
                            <div class="ls-info-row">
                                <div class="ls-info-icon"><i class="fas fa-balance-scale"></i></div>
                                <div><div class="ls-info-label">Outstanding Balance</div><div class="ls-info-value" style="color:var(--ls-red);">K{{ number_format($outstandingBalance, 2) }}</div></div>
                            </div>
                            <div class="ls-info-row">
                                <div class="ls-info-icon"><i class="fas fa-clock"></i></div>
                                <div><div class="ls-info-label">Duration</div><div class="ls-info-value">{{ $loan->duration }} {{ Str::plural('month', $loan->duration) }}</div></div>
                            </div>
                            <div class="ls-info-row">
                                <div class="ls-info-icon"><i class="fas fa-circle-notch"></i></div>
                                <div><div class="ls-info-label">Circle</div><div class="ls-info-value">{{ $loan->month->circle->name ?? '--' }}</div></div>
                            </div>
                            <div class="ls-info-row">
                                <div class="ls-info-icon"><i class="fas fa-calendar-alt"></i></div>
                                <div><div class="ls-info-label">Month</div><div class="ls-info-value">Month {{ $loan->month->month_number ?? '' }}</div></div>
                            </div>
                            <div class="ls-info-row">
                                <div class="ls-info-icon"><i class="fas fa-calendar-plus"></i></div>
                                <div><div class="ls-info-label">Requested</div><div class="ls-info-value">{{ $loan->created_at->format('d M Y, H:i') }}</div></div>
                            </div>
                        </div>
                    </div>

                    {{-- Progress cards --}}
                    <div class="ls-progress-cards">
                        <div class="ls-pcard">
                            <div class="ls-pcard-label">Repayment</div>
                            <div class="ls-pcard-value" style="color:{{ $repaymentProgress >= 100 ? 'var(--ls-green)' : 'var(--ls-blue)' }};">
                                K{{ number_format($totalRepaid, 0) }}
                            </div>
                            <div class="ls-pcard-bar">
                                <div class="ls-pcard-fill" style="width:{{ $repaymentProgress }}%;background:{{ $repaymentProgress >= 100 ? 'var(--ls-green)' : 'var(--ls-blue)' }};"></div>
                            </div>
                            <div class="ls-pcard-pct">{{ number_format($repaymentProgress, 0) }}% repaid</div>
                        </div>
                        <div class="ls-pcard">
                            <div class="ls-pcard-label">Pairing</div>
                            <div class="ls-pcard-value" style="color:{{ $pairingProgress >= 100 ? 'var(--ls-green)' : 'var(--ls-amber)' }};">
                                K{{ number_format($totalPaired, 0) }}
                            </div>
                            <div class="ls-pcard-bar">
                                <div class="ls-pcard-fill" style="width:{{ $pairingProgress }}%;background:{{ $pairingProgress >= 100 ? 'var(--ls-green)' : 'var(--ls-amber)' }};"></div>
                            </div>
                            <div class="ls-pcard-pct">{{ number_format($pairingProgress, 0) }}% paired</div>
                        </div>
                    </div>
                </div>

                {{-- Right Content --}}
                <div class="ls-main">
                    <div class="ls-tabs">
                        <button class="ls-tab {{ $activeTab==='overview'?'active':'' }}" wire:click="switchTab('overview')"><i class="fas fa-info-circle"></i> Overview</button>
                        <button class="ls-tab {{ $activeTab==='pairings'?'active':'' }}" wire:click="switchTab('pairings')"><i class="fas fa-link"></i> Pairings</button>
                        <button class="ls-tab {{ $activeTab==='repayments'?'active':'' }}" wire:click="switchTab('repayments')"><i class="fas fa-money-bill-wave"></i> Repayments</button>
                        <button class="ls-tab {{ $activeTab==='approvals'?'active':'' }}" wire:click="switchTab('approvals')"><i class="fas fa-clipboard-check"></i> Approvals</button>
                        <button class="ls-tab {{ $activeTab==='penalties'?'active':'' }}" wire:click="switchTab('penalties')"><i class="fas fa-exclamation-triangle"></i> Penalties</button>
                    </div>

                    {{-- Overview --}}
                    @if($activeTab === 'overview')
                        <div class="ls-tab-body ls-animate">
                            <h4 class="ls-section-title">Borrower</h4>
                            @if($loan->borrower)
                                @php
                                    $bp = explode(' ', trim($loan->borrower->name ?? ''));
                                    $bi = strtoupper(substr($bp[0], 0, 1) . (isset($bp[1]) ? substr($bp[1], 0, 1) : ''));
                                @endphp
                                <div class="ls-borrower-card">
                                    <div class="ls-borrower-avatar">{{ $bi }}</div>
                                    <div>
                                        <div style="font-weight:700;font-size:.92rem;color:var(--ls-text);">{{ $loan->borrower->name }}</div>
                                        <div style="font-size:.78rem;color:var(--ls-faint);">{{ $loan->borrower->email }}</div>
                                        @if($loan->borrower->phone ?? $loan->borrower->mobile_no)
                                            <div style="font-size:.78rem;color:var(--ls-faint);">{{ $loan->borrower->phone ?? $loan->borrower->mobile_no }}</div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <h4 class="ls-section-title" style="margin-top:1.5rem;">Loan Summary</h4>
                            <div class="ls-detail-grid">
                                <div><div class="ls-detail-label">Loan Amount</div><div class="ls-detail-value" style="font-size:1.05rem;">K{{ number_format($loan->amount, 2) }}</div></div>
                                <div><div class="ls-detail-label">Interest Rate</div><div class="ls-detail-value">{{ $loan->interest_rate }}%</div></div>
                                <div><div class="ls-detail-label">Total Payable</div><div class="ls-detail-value" style="color:#1e40af;">K{{ number_format($loan->total_payable, 2) }}</div></div>
                                <div><div class="ls-detail-label">Outstanding Balance</div><div class="ls-detail-value" style="color:var(--ls-red);">K{{ number_format($outstandingBalance, 2) }}</div></div>
                                <div><div class="ls-detail-label">Duration</div><div class="ls-detail-value">{{ $loan->duration }} {{ Str::plural('month', $loan->duration) }}</div></div>
                                <div>
                                    <div class="ls-detail-label">Status</div>
                                    <div class="ls-detail-value">
                                        @php
                                            $sb = [
                                                'pending'=>['bg'=>'#fffbeb','color'=>'#92400e','border'=>'#fde68a'],
                                                'approved'=>['bg'=>'#eff6ff','color'=>'#1e40af','border'=>'#bfdbfe'],
                                                'active'=>['bg'=>'#ecfdf5','color'=>'#065f46','border'=>'#a7f3d0'],
                                                'completed'=>['bg'=>'#f0fdf4','color'=>'#166534','border'=>'#bbf7d0'],
                                                'rejected'=>['bg'=>'#fef2f2','color'=>'#991b1b','border'=>'#fecaca'],
                                            ][$loan->status] ?? ['bg'=>'#f3f4f6','color'=>'#374151','border'=>'#e5e7eb'];
                                        @endphp
                                        <span class="ls-badge" style="background:{{ $sb['bg'] }};color:{{ $sb['color'] }};border:1px solid {{ $sb['border'] }};">{{ ucfirst($loan->status) }}</span>
                                    </div>
                                </div>
                                <div><div class="ls-detail-label">Circle</div><div class="ls-detail-value">{{ $loan->month->circle->name ?? '--' }}</div></div>
                                <div><div class="ls-detail-label">Month</div><div class="ls-detail-value">Month {{ $loan->month->month_number ?? '' }}</div></div>
                            </div>

                            <h4 class="ls-section-title" style="margin-top:1.5rem;">Financial Breakdown</h4>
                            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:.75rem;">
                                <div style="padding:.85rem;border-radius:12px;background:#f0fdf4;border:1px solid #bbf7d0;text-align:center;">
                                    <div style="font-size:.62rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--ls-faint);">Interest Amount</div>
                                    <div style="font-size:1.1rem;font-weight:800;color:#065f46;">K{{ number_format((float)$loan->total_payable - (float)$loan->amount, 2) }}</div>
                                </div>
                                <div style="padding:.85rem;border-radius:12px;background:#eff6ff;border:1px solid #bfdbfe;text-align:center;">
                                    <div style="font-size:.62rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--ls-faint);">Total Repaid</div>
                                    <div style="font-size:1.1rem;font-weight:800;color:#1e40af;">K{{ number_format($totalRepaid, 2) }}</div>
                                </div>
                                <div style="padding:.85rem;border-radius:12px;background:#fef2f2;border:1px solid #fecaca;text-align:center;">
                                    <div style="font-size:.62rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--ls-faint);">Still Owed</div>
                                    <div style="font-size:1.1rem;font-weight:800;color:var(--ls-red);">K{{ number_format($outstandingBalance, 2) }}</div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Pairings --}}
                    @if($activeTab === 'pairings')
                        <div class="ls-tab-body ls-animate">
                            <h4 class="ls-section-title">Lender Pairings ({{ $pairings->count() }})</h4>
                            @if($pairings->count())
                                <table class="ls-subtable">
                                    <thead>
                                        <tr>
                                            <th>Lender</th>
                                            <th>Amount</th>
                                            <th>Share</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pairings as $p)
                                            @php
                                                $pp = explode(' ', trim($p->lender->name ?? ''));
                                                $pi = strtoupper(substr($pp[0], 0, 1) . (isset($pp[1]) ? substr($pp[1], 0, 1) : ''));
                                                $share = (float)$loan->amount > 0 ? (($p->amount / (float)$loan->amount)*100) : 0;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <div style="display:flex;align-items:center;gap:.55rem;">
                                                        <div class="ls-avatar">{{ $pi }}</div>
                                                        <div>
                                                            <div style="font-weight:700;">{{ $p->lender->name }}</div>
                                                            <div style="font-size:.75rem;color:var(--ls-faint);">{{ $p->lender->email }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="font-weight:700;">K{{ number_format($p->amount, 2) }}</td>
                                                <td>
                                                    <span class="ls-badge" style="background:#eff6ff;color:#1e40af;border:1px solid #bfdbfe;">
                                                        {{ number_format($share, 1) }}%
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div style="margin-top:1rem;padding:.75rem 1rem;border-radius:12px;background:#f8fafc;border:1px solid var(--ls-border);display:flex;justify-content:space-between;align-items:center;">
                                    <span style="font-size:.82rem;font-weight:700;color:var(--ls-muted);">Total Paired</span>
                                    <span style="font-size:1rem;font-weight:800;color:{{ $pairingProgress >= 100 ? 'var(--ls-green)' : 'var(--ls-amber)' }};">
                                        K{{ number_format($totalPaired, 2) }} / K{{ number_format($loan->amount, 2) }}
                                    </span>
                                </div>
                            @else
                                <div class="ls-empty"><i class="fas fa-link"></i><p>No lender pairings yet.</p></div>
                            @endif
                        </div>
                    @endif

                    {{-- Repayments --}}
                    @if($activeTab === 'repayments')
                        <div class="ls-tab-body ls-animate">
                            <h4 class="ls-section-title">Repayments ({{ $repayments->count() }})</h4>
                            @if($repayments->count())
                                <table class="ls-subtable">
                                    <thead>
                                        <tr>
                                            <th>Amount</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($repayments as $r)
                                            <tr>
                                                <td style="font-weight:700;color:var(--ls-green);">K{{ number_format($r->amount, 2) }}</td>
                                                <td style="font-size:.82rem;color:var(--ls-faint);">{{ $r->created_at->format('d M Y, H:i') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div style="margin-top:1rem;padding:.75rem 1rem;border-radius:12px;background:#f0fdf4;border:1px solid #bbf7d0;display:flex;justify-content:space-between;align-items:center;">
                                    <span style="font-size:.82rem;font-weight:700;color:#065f46;">Total Repaid</span>
                                    <span style="font-size:1rem;font-weight:800;color:var(--ls-green);">
                                        K{{ number_format($totalRepaid, 2) }} / K{{ number_format($loan->total_payable, 2) }}
                                    </span>
                                </div>
                            @else
                                <div class="ls-empty"><i class="fas fa-money-bill-wave"></i><p>No repayments recorded yet.</p></div>
                            @endif
                        </div>
                    @endif

                    {{-- Approvals --}}
                    @if($activeTab === 'approvals')
                        <div class="ls-tab-body ls-animate">
                            <h4 class="ls-section-title">Approval History ({{ $approvals->count() }})</h4>
                            @if($approvals->count())
                                <table class="ls-subtable">
                                    <thead>
                                        <tr>
                                            <th>Approver</th>
                                            <th>Decision</th>
                                            <th>Remarks</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($approvals as $a)
                                            @php
                                                $as = $a->status === 'approved'
                                                    ? ['bg'=>'#f0fdf4','color'=>'#166534','border'=>'#bbf7d0']
                                                    : ['bg'=>'#fef2f2','color'=>'#991b1b','border'=>'#fecaca'];
                                            @endphp
                                            <tr>
                                                <td style="font-weight:600;">{{ $a->approver->name ?? '--' }}</td>
                                                <td>
                                                    <span class="ls-badge" style="background:{{ $as['bg'] }};color:{{ $as['color'] }};border:1px solid {{ $as['border'] }};">
                                                        {{ ucfirst($a->status) }}
                                                    </span>
                                                </td>
                                                <td style="font-size:.82rem;color:var(--ls-muted);">{{ $a->remarks ?? '—' }}</td>
                                                <td style="font-size:.82rem;color:var(--ls-faint);">{{ $a->created_at->format('d M Y, H:i') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="ls-empty"><i class="fas fa-clipboard-check"></i><p>No approval records yet.</p></div>
                            @endif
                        </div>
                    @endif

                    {{-- Penalties --}}
                    @if($activeTab === 'penalties')
                        <div class="ls-tab-body ls-animate">
                            <h4 class="ls-section-title">Penalties ({{ $penalties->count() }})</h4>
                            @if($penalties->count())
                                <table class="ls-subtable">
                                    <thead>
                                        <tr>
                                            <th>Amount</th>
                                            <th>Reason</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($penalties as $pen)
                                            <tr>
                                                <td style="font-weight:700;color:var(--ls-red);">K{{ number_format($pen->amount, 2) }}</td>
                                                <td style="font-size:.82rem;color:var(--ls-muted);">{{ $pen->reason ?? '—' }}</td>
                                                <td style="font-size:.82rem;color:var(--ls-faint);">{{ $pen->created_at->format('d M Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="ls-empty"><i class="fas fa-exclamation-triangle"></i><p>No penalties recorded.</p></div>
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
