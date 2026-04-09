<div>
    @push('custom-styles')
    <style>
        :root {
            --lp-navy:#1E3A5F; --lp-navy-light:#2B6B96; --lp-amber:#D97706; --lp-amber-light:#F59E0B;
            --lp-bg:#f4f6fa; --lp-card:#fff; --lp-border:#edf0f7; --lp-text:#1e293b;
            --lp-muted:#64748b; --lp-faint:#94a3b8; --lp-green:#16a34a; --lp-red:#dc2626; --lp-blue:#2563eb; --lp-radius:16px;
        }
        .lp-page { background:var(--lp-bg); min-height:100vh; }
        .lp-hero {
            background:linear-gradient(135deg,var(--lp-navy) 0%,#234b78 50%,var(--lp-navy-light) 100%);
            padding:1.75rem 0 5.5rem; position:relative; overflow:hidden;
        }
        .lp-hero::before { content:''; position:absolute; width:500px; height:500px; top:-50%; right:-5%; background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
        .lp-hero-inner { position:relative; z-index:2; padding:0 1.5rem; }
        .lp-breadcrumb { display:flex; gap:.5rem; list-style:none; padding:0; margin:0 0 .75rem; font-size:.82rem; }
        .lp-breadcrumb a { color:rgba(255,255,255,.55); text-decoration:none; }
        .lp-breadcrumb a:hover { color:rgba(255,255,255,.85); }
        .lp-breadcrumb .active { color:var(--lp-amber-light); font-weight:600; }
        .lp-breadcrumb .sep { color:rgba(255,255,255,.25); }
        .lp-hero-row { display:flex; align-items:flex-start; justify-content:space-between; flex-wrap:wrap; gap:.75rem; }
        .lp-hero-title h1 { color:#fff; font-size:1.4rem; font-weight:800; margin:0; }
        .lp-hero-title h1 i { color:var(--lp-amber); margin-right:.5rem; }
        .lp-hero-sub { color:rgba(255,255,255,.5); font-size:.84rem; margin:.2rem 0 0; }
        .lp-back { display:inline-flex; align-items:center; gap:.35rem; color:rgba(255,255,255,.65); font-size:.82rem; font-weight:600; text-decoration:none; margin-bottom:.5rem; }
        .lp-back:hover { color:#fff; text-decoration:none; }
        .lp-content { margin-top:-4rem; position:relative; z-index:10; padding:0 1.5rem 2rem; }
        .lp-card { background:var(--lp-card); border-radius:var(--lp-radius); border:1px solid var(--lp-border); box-shadow:0 2px 12px rgba(0,0,0,.04); overflow:hidden; margin-bottom:1.25rem; }
        .lp-card-head { padding:.85rem 1.25rem; border-bottom:1px solid var(--lp-border); display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:.75rem; }
        .lp-card-title { font-size:.9rem; font-weight:700; color:var(--lp-text); margin:0; display:flex; align-items:center; gap:.45rem; }
        .lp-card-title i { color:var(--lp-amber); font-size:.85rem; }
        .lp-card-body { padding:1.25rem 1.5rem; }
        .lp-label { font-size:.72rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--lp-faint); margin-bottom:.3rem; display:block; }
        .lp-input {
            width:100%; padding:.5rem .75rem; border:2px solid #e2e8f0; border-radius:10px;
            font-size:.88rem; color:var(--lp-text); transition:border-color .2s; background:#fff;
        }
        .lp-input:focus { border-color:var(--lp-amber); outline:none; }
        .lp-input:disabled { background:#f8fafc; cursor:not-allowed; }

        /* Filter row */
        .lp-filter-strip {
            display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:1rem;
            background:var(--lp-card); border-radius:var(--lp-radius); border:1px solid var(--lp-border);
            box-shadow:0 2px 12px rgba(0,0,0,.04); padding:1.25rem 1.5rem; margin-bottom:1.25rem;
        }
        .lp-filter-label {
            font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--lp-faint);
            margin-bottom:.35rem; display:flex; align-items:center; gap:.3rem;
        }
        .lp-filter-label i { color:var(--lp-amber); font-size:.6rem; }

        /* Mode toggle */
        .lp-mode-row { display:flex; gap:.75rem; flex-wrap:wrap; align-items:center; }
        .lp-mode-btn {
            display:inline-flex; align-items:center; gap:.4rem; padding:.55rem 1.15rem; border-radius:12px;
            font-size:.82rem; font-weight:700; cursor:pointer; transition:all .2s;
            border:2px solid var(--lp-border); background:#fff; color:var(--lp-muted);
        }
        .lp-mode-btn:hover { border-color:var(--lp-amber); color:var(--lp-text); }
        .lp-mode-btn.active { border-color:var(--lp-navy); background:rgba(30,58,95,.06); color:var(--lp-navy); box-shadow:0 2px 8px rgba(30,58,95,.08); }
        .lp-mode-btn i { font-size:.75rem; }
        .lp-mode-btn.active i { color:var(--lp-amber); }
        .lp-mode-desc { font-size:.72rem; color:var(--lp-faint); font-weight:500; }

        /* Summary row */
        .lp-summary { display:grid; grid-template-columns:repeat(auto-fit,minmax(130px,1fr)); gap:.75rem; margin-bottom:.5rem; }
        .lp-sum-item { text-align:center; }
        .lp-sum-label { font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--lp-faint); }
        .lp-sum-value { font-size:1.1rem; font-weight:800; color:var(--lp-text); }

        /* Progress */
        .lp-progress-wrap { margin-top:.75rem; }
        .lp-progress-bar { height:8px; border-radius:8px; background:#e2e8f0; overflow:hidden; }
        .lp-progress-fill { height:100%; border-radius:8px; transition:width .3s; }
        .lp-progress-text { font-size:.72rem; color:var(--lp-faint); font-weight:600; margin-top:.25rem; }

        /* Lender table */
        .lp-table { width:100%; border-collapse:collapse; }
        .lp-table thead th {
            font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--lp-faint);
            padding:.7rem 1rem; border-bottom:1px solid var(--lp-border); background:#fafbfd;
        }
        .lp-table tbody td { padding:.7rem 1rem; border-bottom:1px solid #f5f7fa; vertical-align:middle; font-size:.85rem; }
        .lp-table tbody tr { transition:background .15s; }
        .lp-table tbody tr:hover { background:#fafbfd; }
        .lp-table tbody tr:last-child td { border-bottom:none; }
        .lp-table tfoot td { padding:.7rem 1rem; background:#fafbfd; font-weight:700; font-size:.9rem; }
        .lp-avatar {
            width:32px; height:32px; border-radius:50%; display:flex; align-items:center; justify-content:center;
            font-weight:700; font-size:.65rem; flex-shrink:0;
            background:linear-gradient(135deg,var(--lp-navy),var(--lp-navy-light)); color:#fff;
        }
        .lp-footer { padding:.85rem 1.25rem; border-top:1px solid var(--lp-border); display:flex; justify-content:flex-end; gap:.65rem; flex-wrap:wrap; }
        .lp-btn {
            display:inline-flex; align-items:center; gap:.35rem; padding:.5rem 1.2rem; border-radius:10px;
            font-size:.84rem; font-weight:600; border:none; cursor:pointer; transition:all .2s;
        }
        .lp-btn-primary { background:linear-gradient(135deg,var(--lp-navy),var(--lp-navy-light)); color:#fff; }
        .lp-btn-primary:hover { transform:translateY(-1px); box-shadow:0 4px 12px rgba(30,58,95,.3); }
        .lp-btn-primary:disabled { opacity:.6; cursor:not-allowed; transform:none; }
        .lp-btn-amber { background:linear-gradient(135deg,var(--lp-amber),var(--lp-amber-light)); color:#fff; }
        .lp-btn-amber:hover { transform:translateY(-1px); box-shadow:0 4px 12px rgba(217,119,6,.3); }
        .lp-btn-amber:disabled { opacity:.6; cursor:not-allowed; transform:none; }
        .lp-btn-outline {
            background:transparent; border:2px solid var(--lp-border); color:var(--lp-text); font-weight:700;
        }
        .lp-btn-outline:hover { border-color:var(--lp-navy); color:var(--lp-navy); background:rgba(30,58,95,.03); }

        .lp-empty { text-align:center; padding:3rem 1rem; color:var(--lp-faint); }
        .lp-empty i { font-size:2.5rem; opacity:.15; display:block; margin-bottom:.6rem; }
        .lp-flash { display:flex; align-items:center; gap:.5rem; padding:.7rem 1.15rem; border-radius:12px; font-size:.84rem; font-weight:600; margin-bottom:1rem; }
        .lp-flash-success { background:#f0fdf4; color:var(--lp-green); border:1px solid #bbf7d0; }
        .lp-flash-warning { background:#fffbeb; color:#92400e; border:1px solid #fde68a; }

        /* Action buttons row */
        .lp-actions { display:flex; gap:.65rem; flex-wrap:wrap; align-items:center; }

        /* Loan queue mini-cards */
        .lp-loan-queue { display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:.75rem; }
        .lp-loan-card {
            display:flex; align-items:center; gap:.75rem; padding:.75rem 1rem; border-radius:12px;
            border:1px solid var(--lp-border); background:#fafbfd; transition:all .15s; cursor:default;
        }
        .lp-loan-card:hover { border-color:var(--lp-amber); background:#fffcf5; }
        .lp-loan-name { font-weight:700; font-size:.84rem; color:var(--lp-text); }
        .lp-loan-amt { font-weight:800; font-size:.88rem; color:var(--lp-navy); }
        .lp-loan-status {
            font-size:.58rem; text-transform:uppercase; letter-spacing:.5px; font-weight:800; padding:.15rem .45rem;
            border-radius:6px; display:inline-block;
        }

        /* Schedule table */
        .lp-schedule-group { margin-bottom:1rem; }
        .lp-schedule-header {
            display:flex; align-items:center; gap:.55rem; padding:.55rem .85rem; background:rgba(30,58,95,.03);
            border-radius:10px 10px 0 0; border:1px solid var(--lp-border); border-bottom:none;
        }
        .lp-schedule-borrower { font-weight:700; font-size:.85rem; color:var(--lp-text); }
        .lp-schedule-amt { font-weight:800; font-size:.82rem; color:var(--lp-navy); margin-left:auto; }
        .lp-schedule-tbl { width:100%; border-collapse:collapse; border:1px solid var(--lp-border); border-top:none; border-radius:0 0 10px 10px; overflow:hidden; }
        .lp-schedule-tbl th { font-size:.6rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--lp-faint); padding:.5rem .85rem; background:#fafbfd; border-bottom:1px solid var(--lp-border); }
        .lp-schedule-tbl td { padding:.5rem .85rem; font-size:.82rem; border-bottom:1px solid #f5f7fa; }
        .lp-schedule-tbl tr:last-child td { border-bottom:none; }
        .lp-schedule-direction { display:inline-flex; align-items:center; gap:.25rem; font-size:.7rem; font-weight:700; color:var(--lp-amber); }

        @keyframes lpSlide { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
        .lp-animate { animation:lpSlide .3s ease; }
        @media(max-width:768px){ .lp-content{padding:0 .75rem 1.5rem;} }
    </style>
    @endpush

    @can('pair-loans')
    <section class="content lp-page">
        <div class="lp-hero">
            <div class="lp-hero-inner container-fluid">
                <a href="{{ route('loans.index') }}" class="lp-back"><i class="fas fa-arrow-left"></i> Back to Loans</a>
                <ul class="lp-breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('loans.index') }}">Loans</a></li>
                    <li class="sep">/</li>
                    <li class="active">Pairing</li>
                </ul>
                <div class="lp-hero-row">
                    <div class="lp-hero-title">
                        <h1><i class="fas fa-link"></i>Loan Pairing</h1>
                        <p class="lp-hero-sub">Pair approved loans with lenders — auto or manual, peer-to-peer or via central account</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="lp-content container-fluid lp-animate">
            @if (session()->has('message'))
                <div class="lp-flash lp-flash-success"><i class="fas fa-check-circle"></i> {{ session('message') }}</div>
            @endif
            @if (session()->has('warning'))
                <div class="lp-flash lp-flash-warning"><i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}</div>
            @endif

            {{-- ===== SELECTION STRIP ===== --}}
            <div class="lp-filter-strip">
                <div>
                    <div class="lp-filter-label"><i class="fas fa-university"></i> Village Bank</div>
                    <select wire:model="villageBankId" class="lp-input">
                        <option value="">All Village Banks</option>
                        @foreach ($this->villageBanks as $vb)
                            <option value="{{ $vb->id }}">{{ $vb->name }} ({{ $vb->code }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <div class="lp-filter-label"><i class="fas fa-circle-notch"></i> Circle</div>
                    <select wire:model="circleId" class="lp-input">
                        <option value="">-- Select Circle --</option>
                        @foreach ($circles as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <div class="lp-filter-label"><i class="fas fa-calendar-alt"></i> Active Month</div>
                    <select wire:model="monthId" class="lp-input" {{ empty($circleId) ? 'disabled' : '' }}>
                        <option value="">-- Select Month --</option>
                        @foreach ($months as $mo)
                            <option value="{{ $mo->id }}">Month {{ $mo->month_number }} ({{ $mo->start_date->format('d M') }} – {{ $mo->end_date->format('d M') }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <div class="lp-filter-label"><i class="fas fa-route"></i> Pairing Mode</div>
                    <div class="lp-mode-row">
                        <button type="button" class="lp-mode-btn {{ $pairingMode === 'peer' ? 'active' : '' }}" wire:click="$set('pairingMode', 'peer')">
                            <i class="fas fa-exchange-alt"></i> Peer-to-Peer
                        </button>
                        <button type="button" class="lp-mode-btn {{ $pairingMode === 'central' ? 'active' : '' }}" wire:click="$set('pairingMode', 'central')">
                            <i class="fas fa-building"></i> Central
                        </button>
                    </div>
                    <div class="lp-mode-desc" style="margin-top:.35rem;">
                        @if ($pairingMode === 'peer')
                            <i class="fas fa-info-circle"></i> Lenders send directly to each borrower (proportional by shares)
                        @else
                            <i class="fas fa-info-circle"></i> All funds go through the Village Bank account (central location)
                        @endif
                    </div>
                </div>
            </div>

            @if (!empty($monthId))
                {{-- ===== APPROVED LOANS QUEUE ===== --}}
                <div class="lp-card">
                    <div class="lp-card-head">
                        <h3 class="lp-card-title"><i class="fas fa-clock"></i> Approved Loans Awaiting Pairing</h3>
                        <div class="lp-actions">
                            @if ($approvedLoans->count() > 0)
                                <button wire:click="autoPairAllLoans" class="lp-btn lp-btn-amber"
                                    wire:loading.attr="disabled" wire:target="autoPairAllLoans"
                                    title="Auto-pair all approved loans at once">
                                    <span wire:loading.remove wire:target="autoPairAllLoans">
                                        <i class="fas fa-magic"></i> Auto-Pair All ({{ $approvedLoans->count() }})
                                    </span>
                                    <span wire:loading wire:target="autoPairAllLoans"><i class="fas fa-spinner fa-spin"></i> Pairing...</span>
                                </button>
                            @endif
                            <button wire:click="toggleSchedule" class="lp-btn lp-btn-outline" title="View pairing schedule">
                                <i class="fas fa-{{ $showSchedule ? 'times' : 'calendar-check' }}"></i>
                                {{ $showSchedule ? 'Hide Schedule' : 'View Schedule' }}
                            </button>
                        </div>
                    </div>
                    <div class="lp-card-body">
                        @if ($approvedLoans->count() > 0)
                            <div class="lp-loan-queue">
                                @foreach ($approvedLoans as $al)
                                    @php
                                        $parts = explode(' ', trim($al->borrower->name ?? ''));
                                        $initials = strtoupper(substr($parts[0],0,1) . (isset($parts[1]) ? substr($parts[1],0,1) : ''));
                                    @endphp
                                    <div class="lp-loan-card" wire:click="$set('selectedLoanId', '{{ $al->id }}')" style="cursor:pointer;{{ $selectedLoanId == $al->id ? 'border-color:var(--lp-amber);background:#fffcf5;' : '' }}">
                                        <div class="lp-avatar">{{ $initials }}</div>
                                        <div style="flex:1;">
                                            <div class="lp-loan-name">{{ $al->borrower->name }}</div>
                                            <div class="lp-loan-amt">K{{ number_format($al->amount, 2) }}</div>
                                        </div>
                                        <span class="lp-loan-status" style="background:rgba(217,119,6,.1);color:#92400e;">
                                            Approved
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div style="text-align:center;padding:1.5rem;color:var(--lp-faint);font-size:.85rem;">
                                <i class="fas fa-check-circle" style="color:var(--lp-green);margin-right:.3rem;"></i>
                                All loans for this month have been paired.
                            </div>
                        @endif
                    </div>
                </div>

                {{-- ===== SELECTED LOAN DETAIL + MANUAL PAIRING ===== --}}
                @if ($selectedLoan)
                    <div class="lp-card">
                        <div class="lp-card-head">
                            <h3 class="lp-card-title"><i class="fas fa-user-tag"></i> {{ $selectedLoan->borrower->name }} — K{{ number_format($selectedLoan->amount, 2) }}</h3>
                            <div class="lp-actions">
                                <button wire:click="autoPairSelected" class="lp-btn lp-btn-amber"
                                    wire:loading.attr="disabled" wire:target="autoPairSelected">
                                    <span wire:loading.remove wire:target="autoPairSelected">
                                        <i class="fas fa-magic"></i> Auto-Pair This Loan
                                    </span>
                                    <span wire:loading wire:target="autoPairSelected"><i class="fas fa-spinner fa-spin"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="lp-card-body">
                            {{-- Summary --}}
                            <div class="lp-summary">
                                <div class="lp-sum-item">
                                    <div class="lp-sum-label">Borrower</div>
                                    <div class="lp-sum-value" style="font-size:.92rem;">{{ $selectedLoan->borrower->name }}</div>
                                </div>
                                <div class="lp-sum-item">
                                    <div class="lp-sum-label">Loan Amount</div>
                                    <div class="lp-sum-value" style="color:#1e40af;">K{{ number_format($selectedLoan->amount, 2) }}</div>
                                </div>
                                <div class="lp-sum-item">
                                    <div class="lp-sum-label">Interest Rate</div>
                                    <div class="lp-sum-value">{{ $selectedLoan->interest_rate }}%</div>
                                </div>
                                <div class="lp-sum-item">
                                    <div class="lp-sum-label">Total Paired</div>
                                    <div class="lp-sum-value" style="color:{{ $totalPaired >= (float)$selectedLoan->amount ? 'var(--lp-green)' : 'var(--lp-red)' }};">
                                        K{{ number_format($totalPaired, 2) }}
                                    </div>
                                </div>
                                <div class="lp-sum-item">
                                    <div class="lp-sum-label">Remaining</div>
                                    @php $remaining = max(0, (float)$selectedLoan->amount - $totalPaired); @endphp
                                    <div class="lp-sum-value" style="color:{{ $remaining > 0 ? 'var(--lp-red)' : 'var(--lp-green)' }};">
                                        {{ $remaining > 0 ? 'K' . number_format($remaining, 2) : 'Fully Paired' }}
                                    </div>
                                </div>
                            </div>
                            @php $pctPaired = (float)$selectedLoan->amount > 0 ? min(100, ($totalPaired / (float)$selectedLoan->amount) * 100) : 0; @endphp
                            <div class="lp-progress-wrap">
                                <div class="lp-progress-bar">
                                    <div class="lp-progress-fill" style="width:{{ $pctPaired }}%;background:{{ $pctPaired >= 100 ? 'var(--lp-green)' : 'var(--lp-blue)' }};"></div>
                                </div>
                                <div class="lp-progress-text">{{ number_format($pctPaired, 0) }}% paired</div>
                            </div>
                        </div>

                        {{-- Lender allocation table --}}
                        @if ($pairingMode === 'peer')
                            <div class="lp-card-head" style="border-top:1px solid var(--lp-border);">
                                <h3 class="lp-card-title"><i class="fas fa-users"></i> Lender Allocations (Manual)</h3>
                            </div>
                            @if($lendersList->count())
                                <div style="overflow-x:auto;">
                                    <table class="lp-table">
                                        <thead>
                                            <tr>
                                                <th style="width:40px;">#</th>
                                                <th>Lender</th>
                                                <th>Email</th>
                                                <th style="width:200px;">Amount to Lend (K)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($lendersList as $idx => $lender)
                                                @php
                                                    $parts = explode(' ', trim($lender->name ?? ''));
                                                    $initials = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
                                                @endphp
                                                <tr>
                                                    <td style="font-size:.82rem;color:var(--lp-faint);">{{ $idx + 1 }}</td>
                                                    <td>
                                                        <div style="display:flex;align-items:center;gap:.55rem;">
                                                            <div class="lp-avatar">{{ $initials }}</div>
                                                            <span style="font-weight:700;">{{ $lender->name }}</span>
                                                        </div>
                                                    </td>
                                                    <td style="font-size:.84rem;color:var(--lp-muted);">{{ $lender->email }}</td>
                                                    <td>
                                                        <input type="number" step="0.01" min="0"
                                                            wire:model.lazy="pairings.{{ $lender->id }}"
                                                            class="lp-input" placeholder="0.00"
                                                            style="text-align:right;">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3" style="text-align:right;">Total Paired:</td>
                                                <td style="text-align:right;color:{{ $totalPaired >= (float)$selectedLoan->amount ? 'var(--lp-green)' : 'var(--lp-red)' }};">
                                                    K{{ number_format($totalPaired, 2) }}
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="lp-footer">
                                    <button wire:click="savePairings" class="lp-btn lp-btn-primary" wire:loading.attr="disabled" wire:target="savePairings">
                                        <span wire:loading.remove wire:target="savePairings"><i class="fas fa-save"></i> Save Pairings</span>
                                        <span wire:loading wire:target="savePairings"><i class="fas fa-spinner fa-spin"></i> Saving...</span>
                                    </button>
                                </div>
                            @else
                                <div class="lp-empty">
                                    <i class="fas fa-users"></i>
                                    <strong>No eligible lenders</strong>
                                    <span style="font-size:.82rem;">No circle members available for pairing.</span>
                                </div>
                            @endif
                        @else
                            {{-- Central mode info --}}
                            <div class="lp-card-body" style="border-top:1px solid var(--lp-border);text-align:center;padding:2rem 1.5rem;">
                                <i class="fas fa-building" style="font-size:2rem;color:var(--lp-navy);opacity:.2;display:block;margin-bottom:.6rem;"></i>
                                <p style="font-size:.88rem;color:var(--lp-muted);margin:0 0 .5rem;">
                                    In <strong>Central</strong> mode, the full loan amount will be assigned to the Village Bank central account.<br>
                                    Members contribute to the pool and the bank disburses centrally.
                                </p>
                                <p style="font-size:.78rem;color:var(--lp-faint);margin:0;">
                                    Click <strong>"Auto-Pair This Loan"</strong> above to assign it to the central account.
                                </p>
                            </div>
                        @endif
                    </div>
                @endif

                {{-- ===== PAIRING SCHEDULE ===== --}}
                @if ($showSchedule)
                    <div class="lp-card">
                        <div class="lp-card-head">
                            <h3 class="lp-card-title"><i class="fas fa-calendar-check"></i> Pairing Schedule — Month</h3>
                            <span style="font-size:.72rem;font-weight:700;color:var(--lp-faint);">
                                {{ $monthLoans->count() }} loan(s) · {{ $schedule->flatten(1)->count() }} pairing(s)
                            </span>
                        </div>
                        <div class="lp-card-body">
                            @if ($schedule->count() > 0)
                                @foreach ($schedule as $loanId => $pairingGroup)
                                    @php
                                        $sLoan = $pairingGroup->first()->loan;
                                        $sBorrower = $sLoan->borrower;
                                        $bParts = explode(' ', trim($sBorrower->name ?? ''));
                                        $bInitials = strtoupper(substr($bParts[0],0,1) . (isset($bParts[1]) ? substr($bParts[1],0,1) : ''));
                                        $loanTotal = $pairingGroup->sum('amount');
                                        $isFullyPaired = $loanTotal >= (float) $sLoan->amount;
                                    @endphp
                                    <div class="lp-schedule-group">
                                        <div class="lp-schedule-header">
                                            <div class="lp-avatar" style="width:28px;height:28px;font-size:.58rem;">{{ $bInitials }}</div>
                                            <span class="lp-schedule-borrower">{{ $sBorrower->name }}</span>
                                            <span class="lp-loan-status" style="background:{{ $isFullyPaired ? 'rgba(22,163,74,.1)' : 'rgba(220,38,38,.08)' }};color:{{ $isFullyPaired ? 'var(--lp-green)' : 'var(--lp-red)' }};font-size:.55rem;">
                                                {{ $isFullyPaired ? 'Fully Paired' : 'Partial' }}
                                            </span>
                                            <span class="lp-schedule-amt">K{{ number_format($sLoan->amount, 2) }}</span>
                                        </div>
                                        <table class="lp-schedule-tbl">
                                            <thead>
                                                <tr>
                                                    <th style="width:30px;">#</th>
                                                    <th>Lender</th>
                                                    <th>Direction</th>
                                                    <th style="text-align:right;">Amount (K)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pairingGroup as $pi => $pairing)
                                                    <tr>
                                                        <td style="font-size:.78rem;color:var(--lp-faint);">{{ $pi + 1 }}</td>
                                                        <td style="font-weight:600;">{{ $pairing->lender->name ?? 'Central Account' }}</td>
                                                        <td>
                                                            <span class="lp-schedule-direction">
                                                                <i class="fas fa-arrow-right"></i>
                                                                sends to {{ $sBorrower->name }}
                                                            </span>
                                                        </td>
                                                        <td style="text-align:right;font-weight:800;color:var(--lp-navy);">
                                                            K{{ number_format($pairing->amount, 2) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endforeach
                            @else
                                <div class="lp-empty" style="padding:2rem;">
                                    <i class="fas fa-calendar-times"></i>
                                    <strong>No pairings yet</strong>
                                    <span style="font-size:.82rem;">Auto-pair or manually pair loans above to generate the schedule.</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

            @elseif (empty($circleId))
                <div class="lp-card">
                    <div class="lp-empty">
                        <i class="fas fa-hand-pointer"></i>
                        <strong>Select a circle and month</strong>
                        <span style="font-size:.82rem;">Choose a circle and active month above to manage loan pairings.</span>
                    </div>
                </div>
            @elseif (empty($monthId))
                <div class="lp-card">
                    <div class="lp-empty">
                        <i class="fas fa-calendar-alt"></i>
                        <strong>Select a month</strong>
                        <span style="font-size:.82rem;">Choose an active month to view and pair loans.</span>
                    </div>
                </div>
            @endif
        </div>
    </section>
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
