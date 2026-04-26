<div>
    @push('custom-styles')
    <style>
        :root {
            --sd-navy:#1E3A5F; --sd-navy-light:#2B6B96; --sd-amber:#D97706; --sd-amber-light:#F59E0B;
            --sd-bg:#f4f6fa; --sd-card:#fff; --sd-border:#edf0f7; --sd-text:#1e293b;
            --sd-muted:#64748b; --sd-faint:#94a3b8; --sd-green:#16a34a; --sd-red:#dc2626; --sd-blue:#2563eb; --sd-radius:16px;
        }
        .sd-page { background:var(--sd-bg); min-height:100vh; }

        /* Hero */
        .sd-hero {
            background:linear-gradient(135deg,var(--sd-navy) 0%,#234b78 50%,var(--sd-navy-light) 100%);
            padding:1.75rem 0 6rem; position:relative; overflow:hidden;
        }
        .sd-hero::before { content:''; position:absolute; width:600px; height:600px; top:-60%; right:-8%; background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
        .sd-hero-inner { position:relative; z-index:2; padding:0 1.5rem; }
        .sd-breadcrumb { display:flex; gap:.5rem; list-style:none; padding:0; margin:0 0 .75rem; font-size:.82rem; }
        .sd-breadcrumb a { color:rgba(255,255,255,.55); text-decoration:none; }
        .sd-breadcrumb a:hover { color:rgba(255,255,255,.85); }
        .sd-breadcrumb .active { color:var(--sd-amber-light); font-weight:600; }
        .sd-breadcrumb .sep { color:rgba(255,255,255,.25); }
        .sd-back { display:inline-flex; align-items:center; gap:.35rem; color:rgba(255,255,255,.65); font-size:.82rem; font-weight:600; text-decoration:none; margin-bottom:.6rem; }
        .sd-back:hover { color:#fff; text-decoration:none; }
        .sd-hero-row { display:flex; align-items:flex-start; justify-content:space-between; flex-wrap:wrap; gap:.75rem; }
        .sd-hero-title h1 { color:#fff; font-size:1.6rem; font-weight:800; margin:0; }
        .sd-hero-title h1 i { color:var(--sd-amber); margin-right:.5rem; }
        .sd-hero-sub { color:rgba(255,255,255,.55); font-size:.88rem; margin:.25rem 0 0; }
        .sd-hero-links { display:flex; gap:.5rem; flex-wrap:wrap; }
        .sd-hero-link {
            display:inline-flex; align-items:center; gap:.35rem; padding:.45rem 1rem; border-radius:10px;
            font-size:.78rem; font-weight:700; text-decoration:none; transition:all .2s;
            border:1px solid rgba(255,255,255,.2); color:rgba(255,255,255,.8);
        }
        .sd-hero-link:hover { border-color:var(--sd-amber); color:#fff; background:rgba(217,119,6,.15); text-decoration:none; }

        /* Content */
        .sd-content { margin-top:-4rem; position:relative; z-index:10; padding:0 1.5rem 2rem; }

        /* Selection strip */
        .sd-filter-strip {
            display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:1rem;
            background:var(--sd-card); border-radius:var(--sd-radius); border:1px solid var(--sd-border);
            box-shadow:0 2px 12px rgba(0,0,0,.04); padding:1.25rem 1.5rem; margin-bottom:1.25rem;
        }
        .sd-filter-label {
            font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--sd-faint);
            margin-bottom:.35rem; display:flex; align-items:center; gap:.3rem;
        }
        .sd-filter-label i { color:var(--sd-amber); font-size:.6rem; }
        .sd-input {
            width:100%; padding:.5rem .75rem; border:1px solid var(--sd-border); border-radius:10px;
            font-size:.84rem; background:#fafbfd; transition:all .2s;
        }
        .sd-input:focus { outline:none; border-color:var(--sd-amber); background:#fff; box-shadow:0 0 0 3px rgba(217,119,6,.08); }
        .sd-input:disabled { opacity:.5; cursor:not-allowed; }

        /* Insurance badge */
        .sd-insurance-badge {
            display:inline-flex; align-items:center; gap:.3rem; padding:.3rem .75rem; border-radius:8px;
            font-size:.78rem; font-weight:700; background:rgba(217,119,6,.08); color:#92400e; border:1px solid #fde68a;
        }
        .sd-btn-config {
            width:28px; height:28px; border-radius:8px; display:flex; align-items:center; justify-content:center;
            border:1px solid var(--sd-border); background:#fafbfd; color:var(--sd-muted); cursor:pointer;
            font-size:.65rem; transition:all .15s;
        }
        .sd-btn-config:hover { border-color:var(--sd-amber); color:var(--sd-amber); background:rgba(217,119,6,.04); }

        /* Card */
        .sd-card {
            background:var(--sd-card); border-radius:var(--sd-radius); border:1px solid var(--sd-border);
            box-shadow:0 2px 12px rgba(0,0,0,.04); overflow:hidden;
        }
        .sd-card-header {
            padding:1rem 1.5rem; border-bottom:1px solid var(--sd-border);
            display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:.5rem;
        }
        .sd-card-title { font-size:.95rem; font-weight:700; color:var(--sd-text); display:flex; align-items:center; gap:.4rem; }
        .sd-card-title i { color:var(--sd-amber); font-size:.8rem; }
        .sd-card-body { padding:1.25rem 1.5rem; }
        .sd-card-footer { padding:1rem 1.5rem; border-top:1px solid var(--sd-border); display:flex; justify-content:flex-end; gap:.75rem; }

        /* Summary strip */
        .sd-summary-badges { display:flex; align-items:center; gap:.65rem; flex-wrap:wrap; }
        .sd-summary-badge {
            display:inline-flex; align-items:center; gap:.3rem; padding:.35rem .75rem; border-radius:10px;
            font-size:.78rem; font-weight:700;
        }

        /* Buttons */
        .sd-btn-primary {
            padding:.5rem 1.15rem; border-radius:10px; font-size:.82rem; font-weight:700;
            background:var(--sd-amber); color:#fff; border:none; cursor:pointer;
            display:inline-flex; align-items:center; gap:.35rem; transition:all .2s;
        }
        .sd-btn-primary:hover { background:var(--sd-amber-light); transform:translateY(-1px); box-shadow:0 4px 12px rgba(217,119,6,.25); }
        .sd-btn-primary:disabled { opacity:.6; cursor:not-allowed; transform:none; box-shadow:none; }
        .sd-btn-outline {
            padding:.4rem .85rem; border-radius:8px; font-size:.75rem; font-weight:700; border:1px solid;
            cursor:pointer; display:inline-flex; align-items:center; gap:.3rem; transition:all .15s; background:transparent;
        }

        /* Table */
        .sd-table { width:100%; border-collapse:collapse; }
        .sd-table thead th {
            font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--sd-faint);
            padding:.7rem 1rem; border-bottom:1px solid var(--sd-border); background:#fafbfd; white-space:nowrap;
        }
        /* Column group headers */
        .sd-col-group {
            font-size:.58rem; text-transform:uppercase; letter-spacing:.6px; font-weight:800;
            padding:.45rem 1rem; text-align:center;
        }
        .sd-col-group-shares { background:rgba(30,58,95,.04); color:var(--sd-navy); border-bottom:2px solid rgba(30,58,95,.12); }
        .sd-col-group-insurance { background:rgba(217,119,6,.04); color:#92400e; border-bottom:2px solid rgba(217,119,6,.15); }
        .sd-col-group-repay { background:rgba(37,99,235,.04); color:#1e40af; border-bottom:2px solid rgba(37,99,235,.12); }
        .sd-col-group-total { background:rgba(22,163,74,.04); color:#166534; border-bottom:2px solid rgba(22,163,74,.12); }
        .sd-table tbody td { padding:.65rem 1rem; border-bottom:1px solid #f5f7fa; font-size:.84rem; vertical-align:middle; }
        .sd-table tbody tr:last-child td { border-bottom:none; }
        .sd-table tbody tr:hover { background:rgba(30,58,95,.015); }
        .sd-table tfoot td {
            padding:.85rem 1rem; font-weight:700; font-size:.88rem;
            background:#fafbfd; border-top:2px solid var(--sd-border);
        }
        .sd-amount-input {
            width:100%; padding:.45rem .65rem; border:1px solid var(--sd-border); border-radius:8px;
            font-size:.84rem; text-align:right; background:#fafbfd; transition:all .2s;
        }
        .sd-amount-input:focus { outline:none; border-color:var(--sd-amber); background:#fff; box-shadow:0 0 0 3px rgba(217,119,6,.08); }
        .sd-amount-input.sd-input-error { border-color:var(--sd-red); background:#fef2f2; }
        .sd-share-error { font-size:.68rem; color:var(--sd-red); margin-top:.2rem; font-weight:600; }
        .sd-share-hint { font-size:.62rem; color:var(--sd-faint); margin-top:.15rem; }
        .sd-amount-input-ins {
            width:100%; padding:.45rem .65rem; border:1px solid var(--sd-border); border-radius:8px;
            font-size:.84rem; text-align:right; background:#fffbf5; transition:all .2s;
        }
        .sd-amount-input-ins:focus { outline:none; border-color:#92400e; background:#fff; box-shadow:0 0 0 3px rgba(217,119,6,.1); }
        .sd-amount-input-rep {
            width:100%; padding:.45rem .65rem; border:1px solid var(--sd-border); border-radius:8px;
            font-size:.84rem; text-align:right; background:#f0f4ff; transition:all .2s;
        }
        .sd-amount-input-rep:focus { outline:none; border-color:var(--sd-blue); background:#fff; box-shadow:0 0 0 3px rgba(37,99,235,.1); }
        .sd-amount-input-rep.sd-input-error { border-color:var(--sd-red); background:#fef2f2; }
        .sd-balance-badge {
            display:inline-flex; align-items:center; gap:.25rem; padding:.2rem .5rem; border-radius:6px;
            font-size:.72rem; font-weight:700;
        }
        .sd-balance-has { background:rgba(220,38,38,.06); color:var(--sd-red); border:1px solid rgba(220,38,38,.15); }
        .sd-balance-clear { background:rgba(22,163,74,.06); color:var(--sd-green); border:1px solid rgba(22,163,74,.15); }
        .sd-loan-hint { font-size:.6rem; color:var(--sd-faint); margin-top:.15rem; line-height:1.3; }

        /* Avatar */
        .sd-avatar {
            width:32px; height:32px; border-radius:50%; display:flex; align-items:center; justify-content:center;
            font-weight:700; font-size:.65rem; flex-shrink:0;
            background:linear-gradient(135deg,var(--sd-navy),var(--sd-navy-light)); color:#fff;
        }
        .sd-member-cell { display:flex; align-items:center; gap:.55rem; }
        .sd-member-name { font-weight:700; color:var(--sd-text); font-size:.84rem; }
        .sd-member-email { font-size:.68rem; color:var(--sd-faint); margin-top:.05rem; }

        /* Flash */
        .sd-flash {
            display:flex; align-items:center; gap:.5rem; padding:.65rem 1rem; border-radius:10px; font-size:.84rem; font-weight:600;
            margin-bottom:1rem;
        }
        .sd-flash-success { background:rgba(22,163,74,.08); color:#166534; border:1px solid #bbf7d0; }
        .sd-flash-warning { background:rgba(217,119,6,.08); color:#92400e; border:1px solid #fde68a; }

        /* Empty */
        .sd-empty { text-align:center; padding:3rem 1rem; }
        .sd-empty i { font-size:2.5rem; opacity:.12; display:block; margin-bottom:.75rem; color:var(--sd-navy); }
        .sd-empty p { font-size:.88rem; color:var(--sd-muted); margin:0; }

        /* Modal */
        .sd-overlay { position:fixed; inset:0; background:rgba(15,23,42,.45); backdrop-filter:blur(4px); z-index:1050; display:flex; align-items:center; justify-content:center; }
        .sd-modal {
            background:#fff; border-radius:var(--sd-radius); width:95%; max-width:460px;
            box-shadow:0 20px 40px rgba(0,0,0,.12); animation:sdSlide .25s ease; overflow:hidden;
        }
        .sd-modal-header {
            padding:1rem 1.5rem; background:linear-gradient(135deg,var(--sd-navy),var(--sd-navy-light));
            display:flex; align-items:center; justify-content:space-between;
        }
        .sd-modal-header h5 { color:#fff; font-size:.92rem; font-weight:700; margin:0; display:flex; align-items:center; gap:.4rem; }
        .sd-modal-close { background:none; border:none; color:rgba(255,255,255,.6); font-size:1.2rem; cursor:pointer; }
        .sd-modal-close:hover { color:#fff; }
        .sd-modal-body { padding:1.5rem; }
        .sd-modal-footer { padding:1rem 1.5rem; border-top:1px solid var(--sd-border); display:flex; justify-content:flex-end; gap:.65rem; }
        .sd-label { font-size:.72rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--sd-faint); margin-bottom:.35rem; }
        .sd-label .req { color:#ef4444; }
        .sd-error { font-size:.72rem; color:#ef4444; margin-top:.25rem; font-weight:500; }
        .sd-hint { font-size:.72rem; color:var(--sd-faint); margin-top:.25rem; }
        .sd-btn-cancel { padding:.45rem 1.25rem; border-radius:10px; font-size:.82rem; font-weight:600; background:#f1f5f9; color:var(--sd-text); border:1px solid var(--sd-border); cursor:pointer; transition:all .15s; }
        .sd-btn-cancel:hover { background:#e2e8f0; }

        @keyframes sdSlide { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
        .sd-animate { animation:sdSlide .3s ease; }
        @media(max-width:768px){ .sd-content{padding:0 .75rem 1.5rem;} .sd-filter-strip{grid-template-columns:1fr;} }
    </style>
    @endpush

    @can('declare-shares')
    <section class="content sd-page">
        {{-- Hero --}}
        <div class="sd-hero">
            <div class="sd-hero-inner container-fluid">
                <a href="{{ route('shares.index') }}" class="sd-back"><i class="fas fa-arrow-left"></i> Back to Shares</a>
                <ul class="sd-breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('shares.index') }}">Shares</a></li>
                    <li class="sep">/</li>
                    <li class="active">Declare</li>
                </ul>
                <div class="sd-hero-row">
                    <div class="sd-hero-title">
                        <h1><i class="fas fa-file-invoice-dollar"></i>Declarations</h1>
                        <p class="sd-hero-sub">Declare monthly shares, insurance contributions &amp; loan repayments for circle members</p>
                    </div>
                    <div class="sd-hero-links">
                        <a href="{{ route('shares.index') }}" class="sd-hero-link">
                            <i class="fas fa-coins"></i> Shares Summary
                        </a>
                        <a href="{{ route('insurance.index') }}" class="sd-hero-link">
                            <i class="fas fa-shield-alt"></i> Insurance Summary
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="sd-content container-fluid sd-animate">

            {{-- Flash --}}
            @if (session()->has('message'))
                <div class="sd-flash sd-flash-success">
                    <i class="fas fa-check-circle"></i> {{ session('message') }}
                </div>
            @endif
            @if (session()->has('warning'))
                <div class="sd-flash sd-flash-warning">
                    <i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}
                </div>
            @endif

            {{-- Selection Strip --}}
            <div class="sd-filter-strip">
                <div class="sd-filter-group">
                    <div class="sd-filter-label"><i class="fas fa-university"></i> Village Bank</div>
                    <select wire:model.live="villageBankId" class="sd-input">
                        <option value="">All Village Banks</option>
                        @foreach ($this->villageBanks as $vb)
                            <option value="{{ $vb->id }}">{{ $vb->name }} ({{ $vb->code }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="sd-filter-group">
                    <div class="sd-filter-label"><i class="fas fa-circle-notch"></i> Circle</div>
                    <select wire:model.live="circleId" class="sd-input">
                        <option value="">-- Select Circle --</option>
                        @foreach ($circles as $c)
                            <option value="{{ $c->id }}">{{ $c->name }} ({{ $c->members_count }} members)</option>
                        @endforeach
                    </select>
                </div>
                <div class="sd-filter-group">
                    <div class="sd-filter-label"><i class="fas fa-calendar-alt"></i> Active Month</div>
                    <select wire:model.live="monthId" class="sd-input" {{ empty($circleId) ? 'disabled' : '' }}>
                        <option value="">-- Select Month --</option>
                        @foreach ($months as $mo)
                            <option value="{{ $mo->id }}">Month {{ $mo->month_number }} ({{ $mo->start_date->format('d M') }} - {{ $mo->end_date->format('d M') }})</option>
                        @endforeach
                    </select>
                    @if (!empty($circleId) && $months->count() === 0)
                        <div class="sd-hint" style="color:var(--sd-amber);"><i class="fas fa-info-circle"></i> No active months in this circle.</div>
                    @endif
                </div>
                <div class="sd-filter-group">
                    <div class="sd-filter-label"><i class="fas fa-shield-alt"></i> Insurance Config</div>
                    @if (!empty($insuranceType))
                        <div style="display:flex;align-items:center;gap:.5rem;">
                            <span class="sd-insurance-badge">
                                {{ $insuranceType === 'fixed' ? 'K' . number_format($insuranceValue, 2) . ' fixed' : $insuranceValue . '% of shares' }}
                            </span>
                            @if (!empty($circleId))
                                <button wire:click="openInsuranceModal" class="sd-btn-config" title="Edit Config">
                                    <i class="fas fa-edit"></i>
                                </button>
                            @endif
                        </div>
                    @elseif (!empty($circleId))
                        <button wire:click="openInsuranceModal" class="sd-btn-outline" style="border-color:var(--sd-amber);color:var(--sd-amber);">
                            <i class="fas fa-plus"></i> Configure
                        </button>
                    @else
                        <span style="font-size:.82rem;color:var(--sd-faint);">Select a circle first</span>
                    @endif
                </div>
                @if (!empty($circleId))
                <div class="sd-filter-group">
                    <div class="sd-filter-label"><i class="fas fa-coins"></i> Share Unit</div>
                    <div style="display:flex;align-items:center;gap:.5rem;flex-wrap:wrap;">
                        <span class="sd-insurance-badge" style="background:rgba(4,120,87,.08);color:#047857;border-color:#a7f3d0;">
                            1 share = K{{ number_format($shareUnitAmount, 0) }}
                        </span>
                        <span style="font-size:.7rem;color:var(--sd-faint);">Min K{{ number_format($minShareAmount, 0) }} · Max K{{ number_format($maxShareAmount, 0) }}</span>
                    </div>
                </div>
                @endif
            </div>

            {{-- ===== UNIFIED DECLARATIONS TABLE ===== --}}
            @if (!empty($circleId) && !empty($monthId) && $membersList->count() > 0)
                <div class="sd-card">
                    <div class="sd-card-header">
                        <div class="sd-card-title"><i class="fas fa-table"></i> Member Declarations</div>
                        <div class="sd-summary-badges">
                            <span class="sd-summary-badge" style="background:rgba(30,58,95,.06);color:var(--sd-navy);border:1px solid rgba(30,58,95,.15);">
                                <i class="fas fa-coins" style="font-size:.6rem;"></i> Shares: K{{ number_format($totalShares, 2) }}
                            </span>
                            <span class="sd-summary-badge" style="background:rgba(217,119,6,.06);color:#92400e;border:1px solid #fde68a;">
                                <i class="fas fa-shield-alt" style="font-size:.6rem;"></i> Insurance: K{{ number_format($totalInsurance, 2) }}
                            </span>
                            <span class="sd-summary-badge" style="background:rgba(37,99,235,.06);color:#1e40af;border:1px solid rgba(37,99,235,.2);">
                                <i class="fas fa-hand-holding-usd" style="font-size:.6rem;"></i> Repayments: K{{ number_format($totalRepayments, 2) }}
                            </span>
                            <span class="sd-summary-badge" style="background:rgba(22,163,74,.06);color:#166534;border:1px solid #bbf7d0;">
                                <i class="fas fa-calculator" style="font-size:.6rem;"></i> Grand Total: K{{ number_format($totalShares + $totalInsurance + $totalRepayments, 2) }}
                            </span>
                            <button wire:click="saveAllDeclarations" class="sd-btn-primary" wire:loading.attr="disabled" wire:target="saveAllDeclarations">
                                <span wire:loading.remove wire:target="saveAllDeclarations"><i class="fas fa-save"></i> Save All</span>
                                <span wire:loading wire:target="saveAllDeclarations"><i class="fas fa-spinner fa-spin"></i> Saving...</span>
                            </button>
                        </div>
                    </div>

                    <div style="overflow-x:auto;">
                        <table class="sd-table">
                            <thead>
                                {{-- Column group headers --}}
                                <tr>
                                    <th rowspan="2" style="width:40px;vertical-align:bottom;border-bottom:1px solid var(--sd-border);">#</th>
                                    <th rowspan="2" style="vertical-align:bottom;border-bottom:1px solid var(--sd-border);">Member</th>
                                    <th class="sd-col-group sd-col-group-shares" colspan="1">
                                        <i class="fas fa-coins"></i> Shares
                                    </th>
                                    <th class="sd-col-group sd-col-group-insurance" colspan="1">
                                        <i class="fas fa-shield-alt"></i> Insurance
                                    </th>
                                    <th class="sd-col-group sd-col-group-repay" colspan="2">
                                        <i class="fas fa-hand-holding-usd"></i> Loan Repayment
                                    </th>
                                    <th class="sd-col-group sd-col-group-total" colspan="1">
                                        <i class="fas fa-calculator"></i> Total
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width:180px;">
                                        Amount (K)
                                        <span style="font-weight:400;color:var(--sd-faint);font-size:.55rem;display:block;text-transform:none;letter-spacing:0;">
                                            Multiples of K{{ number_format($shareUnitAmount, 0) }}
                                        </span>
                                    </th>
                                    <th style="width:180px;">
                                        Amount (K)
                                        @if (!empty($insuranceType))
                                            <span style="font-weight:400;color:var(--sd-faint);font-size:.55rem;display:block;text-transform:none;letter-spacing:0;">
                                                {{ $insuranceType === 'fixed' ? 'K' . number_format($insuranceValue, 2) . ' fixed' : $insuranceValue . '% of shares' }} · editable
                                            </span>
                                        @endif
                                    </th>
                                    <th style="width:120px;">Balance (K)</th>
                                    <th style="width:160px;">
                                        Repay (K)
                                        <span style="font-weight:400;color:var(--sd-faint);font-size:.55rem;display:block;text-transform:none;letter-spacing:0;">
                                            Clears oldest loan first
                                        </span>
                                    </th>
                                    <th style="width:120px;">Amount (K)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($membersList as $idx => $m)
                                    @php
                                        $shareVal = $shares[$m->id] ?? 0;
                                        $insVal   = $insuranceAmounts[$m->id] ?? 0;
                                        $repVal   = $repaymentAmounts[$m->id] ?? 0;
                                        $shareNum = is_numeric($shareVal) && (float)$shareVal > 0 ? (float)$shareVal : 0;
                                        $insNum   = is_numeric($insVal) && (float)$insVal > 0 ? (float)$insVal : 0;
                                        $repNum   = is_numeric($repVal) && (float)$repVal > 0 ? (float)$repVal : 0;
                                        $rowTotal = $shareNum + $insNum + $repNum;
                                        $balInfo  = $loanBalances[$m->id] ?? ['total' => 0, 'loans' => []];
                                        $balTotal = (float)($balInfo['total'] ?? 0);
                                        $loanCount = count($balInfo['loans'] ?? []);
                                    @endphp
                                    <tr>
                                        <td style="font-size:.78rem;color:var(--sd-faint);">{{ $idx + 1 }}</td>
                                        <td>
                                            <div class="sd-member-cell">
                                                @php
                                                    $parts = explode(' ', trim($m->name ?? ''));
                                                    $initials = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
                                                @endphp
                                                <div class="sd-avatar">{{ $initials }}</div>
                                                <div>
                                                    <div class="sd-member-name">{{ $m->name }}</div>
                                                    <div class="sd-member-email">{{ $m->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="number" step="{{ $shareUnitAmount }}" min="0" max="{{ $maxShareAmount }}"
                                                wire:model.blur="shares.{{ $m->id }}"
                                                class="sd-amount-input {{ isset($shareErrors[$m->id]) ? 'sd-input-error' : '' }}" placeholder="0.00">
                                            @if (isset($shareErrors[$m->id]))
                                                <div class="sd-share-error"><i class="fas fa-exclamation-circle"></i> {{ $shareErrors[$m->id] }}</div>
                                            @endif
                                        </td>
                                        <td>
                                            <input type="number" step="0.01" min="0"
                                                wire:model.blur="insuranceAmounts.{{ $m->id }}"
                                                class="sd-amount-input-ins" placeholder="0.00">
                                        </td>
                                        <td>
                                            @if ($balTotal > 0)
                                                <span class="sd-balance-badge sd-balance-has">
                                                    <i class="fas fa-exclamation-circle" style="font-size:.55rem;"></i>
                                                    K{{ number_format($balTotal, 2) }}
                                                </span>
                                                @if ($loanCount > 1)
                                                    <div class="sd-loan-hint">{{ $loanCount }} active loans</div>
                                                @endif
                                            @else
                                                <span class="sd-balance-badge sd-balance-clear">
                                                    <i class="fas fa-check-circle" style="font-size:.55rem;"></i> Clear
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($balTotal > 0)
                                                <input type="number" step="0.01" min="0" max="{{ $balTotal }}"
                                                    wire:model.blur="repaymentAmounts.{{ $m->id }}"
                                                    class="sd-amount-input-rep {{ isset($repaymentErrors[$m->id]) ? 'sd-input-error' : '' }}" placeholder="0.00">
                                                @if (isset($repaymentErrors[$m->id]))
                                                    <div class="sd-share-error"><i class="fas fa-exclamation-circle"></i> {{ $repaymentErrors[$m->id] }}</div>
                                                @endif
                                            @else
                                                <span style="font-size:.78rem;color:var(--sd-faint);">—</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span style="font-weight:800;color:{{ $rowTotal > 0 ? 'var(--sd-green)' : 'var(--sd-faint)' }};font-size:.88rem;">
                                                {{ $rowTotal > 0 ? 'K' . number_format($rowTotal, 2) : '—' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" style="text-align:right;color:var(--sd-text);font-size:.82rem;">Totals:</td>
                                    <td style="text-align:right;color:var(--sd-navy);font-weight:800;">K{{ number_format($totalShares, 2) }}</td>
                                    <td style="text-align:right;color:#92400e;font-weight:800;">K{{ number_format($totalInsurance, 2) }}</td>
                                    <td></td>
                                    <td style="text-align:right;color:#1e40af;font-weight:800;">K{{ number_format($totalRepayments, 2) }}</td>
                                    <td style="color:var(--sd-green);font-weight:800;font-size:.95rem;">K{{ number_format($totalShares + $totalInsurance + $totalRepayments, 2) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="sd-card-footer">
                        <button wire:click="saveAllDeclarations" class="sd-btn-primary" wire:loading.attr="disabled" wire:target="saveAllDeclarations">
                            <span wire:loading.remove wire:target="saveAllDeclarations"><i class="fas fa-save"></i> Save All Declarations</span>
                            <span wire:loading wire:target="saveAllDeclarations"><i class="fas fa-spinner fa-spin"></i> Saving...</span>
                        </button>
                    </div>
                </div>

            @elseif (!empty($circleId) && !empty($monthId) && $membersList->count() === 0)
                <div class="sd-card">
                    <div class="sd-card-body">
                        <div class="sd-empty">
                            <i class="fas fa-users"></i>
                            <p>No members in this circle. Add members first.</p>
                        </div>
                    </div>
                </div>
            @elseif (empty($circleId))
                <div class="sd-card">
                    <div class="sd-card-body">
                        <div class="sd-empty">
                            <i class="fas fa-hand-pointer"></i>
                            <p>Select a circle and month above to start declaring shares and insurance.</p>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>

    {{-- ===== INSURANCE CONFIG MODAL ===== --}}
    @if ($showInsuranceModal)
        <div class="sd-overlay">
            <div class="sd-modal">
                <div class="sd-modal-header">
                    <h5><i class="fas fa-shield-alt"></i> Insurance Configuration</h5>
                    <button type="button" class="sd-modal-close" wire:click="$set('showInsuranceModal', false)">&times;</button>
                </div>
                <form wire:submit.prevent="saveInsuranceConfig">
                    <div class="sd-modal-body">
                        <p style="font-size:.84rem;color:var(--sd-muted);margin-bottom:1.25rem;">
                            Configure how insurance contributions are calculated for each member's share declaration.
                            Insurance amounts are auto-filled but can be manually adjusted per member.
                        </p>
                        <div style="margin-bottom:1.25rem;">
                            <label class="sd-label">Type <span class="req">*</span></label>
                            <select wire:model.live="configType" class="sd-input">
                                <option value="fixed">Fixed Amount</option>
                                <option value="percentage">Percentage of Shares</option>
                            </select>
                            @error('configType') <div class="sd-error">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <label class="sd-label">
                                {{ $configType === 'fixed' ? 'Amount (K)' : 'Percentage (%)' }}
                                <span class="req">*</span>
                            </label>
                            <input type="number" step="0.01" min="0" wire:model="configValue"
                                class="sd-input" placeholder="{{ $configType === 'fixed' ? '0.00' : '0' }}">
                            @error('configValue') <div class="sd-error">{{ $message }}</div> @enderror
                            <div class="sd-hint">
                                @if ($configType === 'fixed')
                                    Each member pays this fixed amount per month. You can still adjust individual amounts.
                                @else
                                    Calculated as a percentage of each member's share amount. Amounts are editable.
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="sd-modal-footer">
                        <button type="button" wire:click="$set('showInsuranceModal', false)" class="sd-btn-cancel">Cancel</button>
                        <button type="submit" class="sd-btn-primary" wire:loading.attr="disabled" wire:target="saveInsuranceConfig">
                            <span wire:loading.remove wire:target="saveInsuranceConfig"><i class="fas fa-save"></i> Save Config</span>
                            <span wire:loading wire:target="saveInsuranceConfig"><i class="fas fa-spinner fa-spin"></i> Saving...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
