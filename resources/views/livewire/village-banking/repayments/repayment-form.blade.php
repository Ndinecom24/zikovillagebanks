<div>
    @push('custom-styles')
    <style>
        :root {
            --rf-navy:#1E3A5F; --rf-navy-light:#2B6B96; --rf-amber:#D97706; --rf-amber-light:#F59E0B;
            --rf-bg:#f4f6fa; --rf-card:#fff; --rf-border:#edf0f7; --rf-text:#1e293b;
            --rf-muted:#64748b; --rf-faint:#94a3b8; --rf-green:#16a34a; --rf-red:#dc2626; --rf-blue:#2563eb; --rf-radius:16px;
        }
        .rf-page{background:var(--rf-bg);min-height:100vh;}

        /* Hero */
        .rf-hero{background:linear-gradient(135deg,var(--rf-navy) 0%,#234b78 50%,var(--rf-navy-light) 100%);padding:1.75rem 0 6rem;position:relative;overflow:hidden;}
        .rf-hero::before{content:'';position:absolute;width:600px;height:600px;top:-60%;right:-8%;background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%);border-radius:50%;pointer-events:none;}
        .rf-hero-inner{position:relative;z-index:2;padding:0 1.5rem;}
        .rf-breadcrumb{display:flex;gap:.5rem;list-style:none;padding:0;margin:0 0 .75rem;font-size:.82rem;}
        .rf-breadcrumb a{color:rgba(255,255,255,.55);text-decoration:none;}
        .rf-breadcrumb a:hover{color:rgba(255,255,255,.85);}
        .rf-breadcrumb .active{color:var(--rf-amber-light);font-weight:600;}
        .rf-breadcrumb .sep{color:rgba(255,255,255,.25);}
        .rf-hero-row{display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:.75rem;}
        .rf-hero-title h1{color:#fff;font-size:1.6rem;font-weight:800;margin:0;}
        .rf-hero-title h1 i{color:var(--rf-amber);margin-right:.5rem;}
        .rf-hero-sub{color:rgba(255,255,255,.55);font-size:.88rem;margin:.25rem 0 0;}
        .rf-hero-link{display:inline-flex;align-items:center;gap:.35rem;padding:.45rem 1rem;border-radius:10px;font-size:.78rem;font-weight:700;text-decoration:none;transition:all .2s;border:1px solid rgba(255,255,255,.2);color:rgba(255,255,255,.8);}
        .rf-hero-link:hover{border-color:var(--rf-amber);color:#fff;background:rgba(217,119,6,.15);text-decoration:none;}

        /* Content */
        .rf-content{margin-top:-4rem;position:relative;z-index:10;padding:0 1.5rem 2rem;}

        /* Card */
        .rf-card{background:var(--rf-card);border-radius:var(--rf-radius);border:1px solid var(--rf-border);box-shadow:0 2px 12px rgba(0,0,0,.04);overflow:hidden;}
        .rf-card-header{padding:1rem 1.5rem;border-bottom:1px solid var(--rf-border);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.5rem;}
        .rf-card-title{font-size:.95rem;font-weight:700;color:var(--rf-text);display:flex;align-items:center;gap:.4rem;}
        .rf-card-title i{color:var(--rf-amber);font-size:.8rem;}
        .rf-card-body{padding:1.25rem 1.5rem;}
        .rf-card-footer{padding:1rem 1.5rem;border-top:1px solid var(--rf-border);display:flex;justify-content:flex-end;gap:.75rem;}

        /* Form */
        .rf-label{font-size:.72rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--rf-faint);margin-bottom:.35rem;display:flex;align-items:center;gap:.3rem;}
        .rf-label i{color:var(--rf-amber);font-size:.6rem;}
        .rf-label .req{color:#ef4444;}
        .rf-input{width:100%;padding:.5rem .75rem;border:1px solid var(--rf-border);border-radius:10px;font-size:.84rem;background:#fafbfd;transition:all .2s;}
        .rf-input:focus{outline:none;border-color:var(--rf-amber);background:#fff;box-shadow:0 0 0 3px rgba(217,119,6,.08);}
        .rf-input:disabled{opacity:.5;cursor:not-allowed;}
        .rf-error{font-size:.72rem;color:#ef4444;margin-top:.25rem;font-weight:500;}
        .rf-row{display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem;}
        @media(max-width:768px){.rf-row{grid-template-columns:1fr;}}

        /* Loan info card */
        .rf-loan-info{background:#fafbfd;border:1px solid var(--rf-border);border-radius:12px;padding:1rem 1.25rem;margin:1rem 0;}
        .rf-loan-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:.75rem;}
        .rf-loan-name{font-weight:800;font-size:.92rem;color:var(--rf-text);}
        .rf-loan-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:.75rem;}
        @media(max-width:576px){.rf-loan-grid{grid-template-columns:repeat(2,1fr);}}
        .rf-loan-item-label{font-size:.6rem;text-transform:uppercase;letter-spacing:.5px;color:var(--rf-faint);font-weight:700;}
        .rf-loan-item-value{font-size:.92rem;font-weight:800;color:var(--rf-text);margin-top:.1rem;}
        .rf-progress-bar{height:6px;border-radius:6px;background:var(--rf-border);overflow:hidden;margin-top:.5rem;}
        .rf-progress-fill{height:100%;border-radius:6px;background:var(--rf-green);transition:width .3s;}
        .rf-progress-row{display:flex;align-items:center;justify-content:space-between;font-size:.72rem;color:var(--rf-faint);margin-top:.25rem;}

        /* Penalty box */
        .rf-penalty-box{background:#fffbeb;border:1px solid #fde68a;border-radius:12px;padding:1rem 1.25rem;margin:1rem 0;}
        .rf-penalty-label{font-weight:700;color:#92400e;font-size:.84rem;display:flex;align-items:center;gap:.4rem;cursor:pointer;}
        .rf-penalty-calc{font-size:.84rem;font-weight:700;color:#92400e;margin-top:.5rem;display:flex;align-items:center;gap:.3rem;}

        /* Badge */
        .rf-badge{display:inline-flex;align-items:center;padding:.2rem .55rem;border-radius:8px;font-size:.68rem;font-weight:700;}

        /* Button */
        .rf-btn-primary{padding:.55rem 1.25rem;border-radius:10px;font-size:.84rem;font-weight:700;background:var(--rf-amber);color:#fff;border:none;cursor:pointer;display:inline-flex;align-items:center;gap:.35rem;transition:all .2s;}
        .rf-btn-primary:hover{background:var(--rf-amber-light);transform:translateY(-1px);box-shadow:0 4px 12px rgba(217,119,6,.25);}
        .rf-btn-primary:disabled{opacity:.6;cursor:not-allowed;transform:none;box-shadow:none;}

        /* History table */
        .rf-table{width:100%;border-collapse:collapse;}
        .rf-table thead th{font-size:.62rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--rf-faint);padding:.65rem 1rem;border-bottom:1px solid var(--rf-border);background:#fafbfd;white-space:nowrap;}
        .rf-table tbody td{padding:.6rem 1rem;border-bottom:1px solid #f5f7fa;font-size:.84rem;vertical-align:middle;}
        .rf-table tbody tr:last-child td{border-bottom:none;}
        .rf-table tbody tr:hover{background:#fafbfd;}

        /* Empty */
        .rf-empty{text-align:center;padding:2.5rem 1rem;}
        .rf-empty i{font-size:2rem;opacity:.12;display:block;margin-bottom:.5rem;color:var(--rf-navy);}
        .rf-empty p{font-size:.84rem;color:var(--rf-muted);margin:0;}

        /* Flash */
        .rf-flash{display:flex;align-items:center;gap:.5rem;padding:.65rem 1rem;border-radius:10px;font-size:.84rem;font-weight:600;margin-bottom:1rem;}
        .rf-flash-success{background:rgba(141, 163, 149, 0.556);color:#166534;border:1px solid #bbf7d0;}
        .rf-flash-warning{background:rgba(217, 119, 6, 0.556);color:#92400e;border:1px solid #fde68a;}
        .rf-flash-error{background:rgba(220,38,38,0.556);color:#991b1b;border:1px solid #fecaca;}

        /* How-it-works */
        .rf-steps{list-style:none;padding:0;margin:0;}
        .rf-steps li{display:flex;align-items:flex-start;gap:.65rem;padding:.5rem 0;font-size:.84rem;color:var(--rf-text);}
        .rf-steps li .rf-step-dot{flex-shrink:0;width:24px;height:24px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.6rem;font-weight:800;color:#fff;background:var(--rf-green);}

        @keyframes rfSlide{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
        .rf-animate{animation:rfSlide .3s ease;}
        @media(max-width:768px){.rf-content{padding:0 .75rem 1.5rem;}}
    </style>
    @endpush

    @can('view-repayments')
    <section class="content rf-page">
        {{-- Hero --}}
        <div class="rf-hero">
            <div class="rf-hero-inner container-fluid">
                <ul class="rf-breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('repayments.tracker') }}">Repayments</a></li>
                    <li class="sep">/</li>
                    <li class="active">Record</li>
                </ul>
                <div class="rf-hero-row">
                    <div class="rf-hero-title">
                        <h1><i class="fas fa-hand-holding-usd"></i>Record Repayment</h1>
                        <p class="rf-hero-sub">Log a loan repayment and optionally apply a late-payment penalty</p>
                    </div>
                    <a href="{{ route('repayments.tracker') }}" class="rf-hero-link">
                        <i class="fas fa-chart-line"></i> Repayment Tracker
                    </a>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="rf-content container-fluid rf-animate">

            @if ($successMessage)
                <div class="rf-flash rf-flash-success"><i class="fas fa-check-circle"></i> {{ $successMessage }}</div>
            @endif
            @if ($errors->any())
                <div class="rf-flash rf-flash-error"><i class="fas fa-exclamation-circle"></i> Please fix the errors below.</div>
            @endif

            <div class="row">
                {{-- LEFT: Form --}}
                <div class="col-lg-7">
                    <div class="rf-card">
                        <div class="rf-card-header">
                            <div class="rf-card-title"><i class="fas fa-money-check-alt"></i> Repayment Details</div>
                        </div>
                        <form wire:submit.prevent="submitRepayment">
                            <div class="rf-card-body">

                                {{-- Filters --}}
                                <div style="margin-bottom:1rem;">
                                    <div class="rf-label"><i class="fas fa-university"></i> Village Bank</div>
                                    <select wire:model.live="villageBankId" class="rf-input">
                                        <option value="">All Village Banks</option>
                                        @foreach ($this->villageBanks as $vb)
                                            <option value="{{ $vb->id }}">{{ $vb->name }} ({{ $vb->code }})</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="rf-row">
                                    <div>
                                        <div class="rf-label"><i class="fas fa-circle-notch"></i> Circle <span class="req">*</span></div>
                                        <select wire:model.live="circleId" class="rf-input">
                                            <option value="">-- Select Circle --</option>
                                            @foreach ($this->circles as $c)
                                                <option value="{{ $c->id }}">{{ $c->name }} ({{ $c->members_count }})</option>
                                            @endforeach
                                        </select>
                                        @error('circleId') <div class="rf-error">{{ $message }}</div> @enderror
                                    </div>
                                    <div>
                                        <div class="rf-label"><i class="fas fa-file-invoice-dollar"></i> Loan <span class="req">*</span></div>
                                        <select wire:model.live="loanId" class="rf-input" {{ empty($circleId) ? 'disabled' : '' }}>
                                            <option value="">-- Select Loan --</option>
                                            @foreach ($this->loans as $ln)
                                                <option value="{{ $ln->id }}">
                                                    {{ $ln->borrower->name }} — K{{ number_format($ln->outstanding_balance, 2) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('loanId') <div class="rf-error">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                {{-- Loan summary --}}
                                @if ($selectedLoan)
                                    <div class="rf-loan-info">
                                        <div class="rf-loan-header">
                                            <span class="rf-loan-name">{{ $selectedLoan->borrower->name }}</span>
                                            @php
                                                $sc = ['pending'=>['#fffbeb','#92400e','#fde68a'],'approved'=>['#eff6ff','#1e40af','#bfdbfe'],'active'=>['#f0fdf4','#166534','#bbf7d0'],'completed'=>['#f3f4f6','#374151','#e5e7eb'],'rejected'=>['#fef2f2','#991b1b','#fecaca']][$selectedLoan->status] ?? ['#f3f4f6','#374151','#e5e7eb'];
                                            @endphp
                                            <span class="rf-badge" style="background:{{ $sc[0] }};color:{{ $sc[1] }};border:1px solid {{ $sc[2] }};">{{ ucfirst($selectedLoan->status) }}</span>
                                        </div>
                                        <div class="rf-loan-grid">
                                            <div>
                                                <div class="rf-loan-item-label">Loan Amount</div>
                                                <div class="rf-loan-item-value">K{{ number_format($selectedLoan->amount, 2) }}</div>
                                            </div>
                                            <div>
                                                <div class="rf-loan-item-label">Total Payable</div>
                                                <div class="rf-loan-item-value">K{{ number_format($selectedLoan->total_payable, 2) }}</div>
                                            </div>
                                            <div>
                                                <div class="rf-loan-item-label">Outstanding</div>
                                                <div class="rf-loan-item-value" style="color:var(--rf-red);">K{{ number_format($selectedLoan->outstanding_balance, 2) }}</div>
                                            </div>
                                            <div>
                                                <div class="rf-loan-item-label">Interest</div>
                                                <div class="rf-loan-item-value">{{ $selectedLoan->interest_rate }}%</div>
                                            </div>
                                            <div>
                                                <div class="rf-loan-item-label">Duration</div>
                                                <div class="rf-loan-item-value">{{ $selectedLoan->duration }} mo</div>
                                            </div>
                                            <div>
                                                <div class="rf-loan-item-label">Repayments</div>
                                                <div class="rf-loan-item-value">{{ $selectedLoan->repayments->count() }}</div>
                                            </div>
                                        </div>
                                        @php
                                            $repaidPct = $selectedLoan->total_payable > 0
                                                ? min(100, round((($selectedLoan->total_payable - $selectedLoan->outstanding_balance) / $selectedLoan->total_payable) * 100))
                                                : 0;
                                        @endphp
                                        <div class="rf-progress-bar"><div class="rf-progress-fill" style="width:{{ $repaidPct }}%;"></div></div>
                                        <div class="rf-progress-row"><span>Repaid</span><span style="font-weight:700;">{{ $repaidPct }}%</span></div>
                                    </div>
                                @endif

                                {{-- Amount --}}
                                <div class="rf-row">
                                    <div>
                                        <div class="rf-label"><i class="fas fa-money-bill-wave"></i> Amount (K) <span class="req">*</span></div>
                                        <input type="number" step="0.01" min="0.01"
                                               max="{{ $selectedLoan->outstanding_balance ?? '' }}"
                                               wire:model="amount" class="rf-input" placeholder="0.00"
                                               {{ !$selectedLoan ? 'disabled' : '' }}>
                                        @error('amount') <div class="rf-error">{{ $message }}</div> @enderror
                                    </div>
                                    <div style="display:flex;align-items:flex-end;padding-bottom:.35rem;">
                                        @if ($selectedLoan)
                                            <span style="font-size:.78rem;color:var(--rf-faint);"><i class="fas fa-info-circle"></i> Max: K{{ number_format($selectedLoan->outstanding_balance, 2) }}</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Penalty --}}
                                <div class="rf-penalty-box">
                                    <label class="rf-penalty-label" for="penaltyCheck" style="margin-bottom:{{ $applyPenalty ? '.75rem' : '0' }};">
                                        <input type="checkbox" id="penaltyCheck" wire:model="applyPenalty" {{ !$selectedLoan ? 'disabled' : '' }} style="accent-color:#92400e;">
                                        <i class="fas fa-exclamation-triangle"></i> Apply Late-Payment Penalty
                                    </label>
                                    @if ($applyPenalty)
                                        <div class="rf-row" style="margin-bottom:0;">
                                            <div>
                                                <div class="rf-label" style="color:#92400e;">Penalty % <span class="req">*</span></div>
                                                <input type="number" step="0.01" min="0.01" max="100" wire:model.blur="penaltyPercent" class="rf-input" placeholder="e.g. 5" style="border-color:#fde68a;background:#fffef5;">
                                                @error('penaltyPercent') <div class="rf-error">{{ $message }}</div> @enderror
                                            </div>
                                            <div style="display:flex;align-items:flex-end;padding-bottom:.35rem;">
                                                @if ($penaltyPercent && $selectedLoan)
                                                    @php $penCalc = round($selectedLoan->outstanding_balance * ($penaltyPercent / 100), 2); @endphp
                                                    <div class="rf-penalty-calc"><i class="fas fa-calculator"></i> Penalty: K{{ number_format($penCalc, 2) }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="rf-card-footer">
                                <button type="submit" class="rf-btn-primary" wire:loading.attr="disabled" wire:target="submitRepayment" {{ !$selectedLoan ? 'disabled' : '' }}>
                                    <span wire:loading.remove wire:target="submitRepayment"><i class="fas fa-check-circle"></i> Record Repayment</span>
                                    <span wire:loading wire:target="submitRepayment"><i class="fas fa-spinner fa-spin"></i> Processing...</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- RIGHT: History / Help --}}
                <div class="col-lg-5">
                    @if ($selectedLoan && $selectedLoan->repayments->count())
                        <div class="rf-card" style="margin-bottom:1rem;">
                            <div class="rf-card-header">
                                <div class="rf-card-title"><i class="fas fa-history"></i> Repayment History</div>
                            </div>
                            <div style="overflow-x:auto;">
                                <table class="rf-table">
                                    <thead>
                                        <tr><th>#</th><th>Amount</th><th>Penalty</th><th>Balance</th><th>Date</th></tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($selectedLoan->repayments->sortByDesc('created_at') as $rp)
                                            <tr>
                                                <td style="color:var(--rf-faint);font-size:.78rem;">{{ $loop->iteration }}</td>
                                                <td style="font-weight:700;">K{{ number_format($rp->amount_paid, 2) }}</td>
                                                <td>
                                                    @if ($rp->penalty_applied > 0)
                                                        <span style="color:var(--rf-red);font-weight:700;">K{{ number_format($rp->penalty_applied, 2) }}</span>
                                                    @else
                                                        <span style="color:#d1d5db;">&mdash;</span>
                                                    @endif
                                                </td>
                                                <td>K{{ number_format($rp->remaining_balance, 2) }}</td>
                                                <td style="font-size:.78rem;color:var(--rf-faint);">{{ $rp->created_at->format('d M Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @elseif ($selectedLoan)
                        <div class="rf-card" style="margin-bottom:1rem;">
                            <div class="rf-card-body">
                                <div class="rf-empty"><i class="fas fa-history"></i><p>No repayments recorded yet for this loan.</p></div>
                            </div>
                        </div>
                    @else
                        <div class="rf-card" style="margin-bottom:1rem;">
                            <div class="rf-card-header"><div class="rf-card-title"><i class="fas fa-lightbulb"></i> How It Works</div></div>
                            <div class="rf-card-body">
                                <ul class="rf-steps">
                                    <li><span class="rf-step-dot">1</span> Select a circle and pick the outstanding loan</li>
                                    <li><span class="rf-step-dot">2</span> Review loan details and outstanding balance</li>
                                    <li><span class="rf-step-dot">3</span> Enter the repayment amount</li>
                                    <li><span class="rf-step-dot">4</span> Optionally apply a late-payment penalty</li>
                                    <li><span class="rf-step-dot">5</span> Loan status auto-updates to <strong>Completed</strong> when fully repaid</li>
                                </ul>
                            </div>
                        </div>
                    @endif

                    @if ($selectedLoan && $selectedLoan->penalties->count())
                        <div class="rf-card">
                            <div class="rf-card-header"><div class="rf-card-title" style="color:var(--rf-red);"><i class="fas fa-gavel" style="color:var(--rf-red);"></i> Penalties Applied</div></div>
                            <div style="overflow-x:auto;">
                                <table class="rf-table">
                                    <thead><tr><th>%</th><th>Amount</th><th>Date</th></tr></thead>
                                    <tbody>
                                        @foreach ($selectedLoan->penalties->sortByDesc('applied_at') as $pen)
                                            <tr>
                                                <td>{{ $pen->percentage }}%</td>
                                                <td style="color:var(--rf-red);font-weight:700;">K{{ number_format($pen->amount, 2) }}</td>
                                                <td style="font-size:.78rem;color:var(--rf-faint);">{{ $pen->applied_at->format('d M Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
