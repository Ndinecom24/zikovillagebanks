<div>
    @push('custom-styles')
    <style>
        /* ══════════════════════════════════════════════════
         *  FORCED LOAN — Page-Specific Styles Only
         *  Common styles in /css/ndinecom-admin.css (nd-*)
         * ══════════════════════════════════════════════════ */

        .fl-pool-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 0.75rem;
            margin-bottom: 1.25rem;
        }
        .fl-pool-card {
            background: #f8fafc;
            border: 1px solid var(--nd-border);
            border-radius: 12px;
            padding: 0.85rem 1rem;
            text-align: center;
        }
        .fl-pool-card.highlight {
            background: linear-gradient(135deg, #fffbeb, #fef3c7);
            border-color: var(--nd-amber);
        }
        .fl-pool-card.danger {
            background: #fef2f2;
            border-color: #fecaca;
        }
        .fl-pool-label {
            font-size: 0.62rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 700;
            color: var(--nd-faint);
            margin-bottom: 0.15rem;
        }
        .fl-pool-value {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--nd-text);
        }
        .fl-pool-card.highlight .fl-pool-value { color: #b45309; }
        .fl-pool-card.danger .fl-pool-value { color: var(--nd-red); }

        /* Allocation table */
        .fl-alloc-row {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid var(--nd-border);
            transition: background 0.12s;
        }
        .fl-alloc-row:last-child { border-bottom: none; }
        .fl-alloc-row:hover { background: #fafbfd; }
        .fl-alloc-row.excluded { opacity: 0.45; }

        .fl-member-info {
            flex: 1;
            min-width: 0;
        }
        .fl-member-name {
            font-weight: 700;
            font-size: 0.88rem;
            color: var(--nd-text);
        }
        .fl-member-meta {
            font-size: 0.72rem;
            color: var(--nd-muted);
            margin-top: 1px;
        }

        .fl-amount-input {
            width: 140px;
            padding: 0.4rem 0.65rem;
            border: 1px solid var(--nd-border);
            border-radius: 10px;
            font-size: 0.88rem;
            font-weight: 700;
            text-align: right;
            color: var(--nd-text);
            background: var(--nd-card);
            transition: all 0.2s;
        }
        .fl-amount-input:focus {
            outline: none;
            border-color: var(--nd-amber);
            box-shadow: 0 0 0 3px rgba(217,119,6,0.08);
        }
        .fl-amount-input:disabled {
            background: #f1f5f9;
            color: var(--nd-faint);
            cursor: not-allowed;
        }

        .fl-toggle {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: var(--nd-amber);
            flex-shrink: 0;
        }

        /* Summary bar */
        .fl-summary {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
            padding: 0.85rem 1.25rem;
            background: linear-gradient(135deg, #fefce8, #fffbeb);
            border: 1px solid #fde68a;
            border-radius: 12px;
            margin-top: 1rem;
        }
        .fl-summary-stat {
            text-align: center;
        }
        .fl-summary-stat-val {
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--nd-navy);
        }
        .fl-summary-stat-lbl {
            font-size: 0.62rem;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            font-weight: 700;
            color: var(--nd-faint);
        }

        /* Ineligible list */
        .fl-inelig {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.5rem 0.85rem;
            background: #fef2f2;
            border-radius: 10px;
            margin-bottom: 0.45rem;
            font-size: 0.82rem;
        }
        .fl-inelig-name {
            font-weight: 700;
            color: var(--nd-text);
        }
        .fl-inelig-reason {
            color: var(--nd-red);
            font-size: 0.75rem;
        }

        /* Confirm overlay */
        .fl-confirm-summary {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
            margin: 1rem 0;
        }
        .fl-confirm-item {
            background: #f8fafc;
            border: 1px solid var(--nd-border);
            border-radius: 10px;
            padding: 0.75rem;
            text-align: center;
        }
        .fl-confirm-item-val {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--nd-navy);
        }
        .fl-confirm-item-lbl {
            font-size: 0.65rem;
            text-transform: uppercase;
            color: var(--nd-faint);
            font-weight: 700;
        }

        /* How-it-works steps */
        .fl-steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 0.75rem;
            margin-top: 0.75rem;
        }
        .fl-step {
            display: flex;
            align-items: flex-start;
            gap: 0.65rem;
            padding: 0.75rem;
            background: #f8fafc;
            border: 1px solid var(--nd-border);
            border-radius: 10px;
        }
        .fl-step-num {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--nd-navy), var(--nd-navy-light));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 0.72rem;
            flex-shrink: 0;
        }
        .fl-step-title {
            font-weight: 700;
            font-size: 0.82rem;
            color: var(--nd-text);
        }
        .fl-step-desc {
            font-size: 0.73rem;
            color: var(--nd-muted);
            margin-top: 1px;
        }

        @media (max-width: 768px) {
            .fl-pool-grid { grid-template-columns: repeat(2, 1fr); }
            .fl-alloc-row { flex-wrap: wrap; }
            .fl-amount-input { width: 100%; }
        }
    </style>
    @endpush

    @can('force-loans')
    <section class="content nd-page">
        {{-- ═══════════ Hero ═══════════ --}}
        <div class="nd-hero">
            <div class="nd-hero-inner container-fluid">
                <div class="nd-hero-row">
                    <div class="nd-hero-title">
                        <ul class="nd-breadcrumb">
                            <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                            <li class="sep">/</li>
                            <li><a href="{{ route('loans.index') }}">Loans</a></li>
                            <li class="sep">/</li>
                            <li class="active">Forced Loan</li>
                        </ul>
                        <h1><i class="fas fa-bolt"></i> Forced Loan Distribution</h1>
                        <p class="nd-hero-sub">Distribute unborrowed funds proportionally to eligible members</p>
                    </div>
                    <div class="d-none d-md-flex" style="gap:0.5rem;">
                        <a href="{{ route('loans.index') }}" class="nd-btn nd-btn-ghost" style="border-color:rgba(255,255,255,0.2);color:rgba(255,255,255,0.8);">
                            <i class="fas fa-arrow-left"></i> All Loans
                        </a>
                        <a href="{{ route('loans.request') }}" class="nd-btn nd-btn-amber">
                            <i class="fas fa-plus"></i> Normal Request
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════ Content ═══════════ --}}
        <div class="nd-content">
            {{-- Flash --}}
            @if(session()->has('message'))
                <div class="nd-flash nd-flash-success" style="margin-bottom:1rem;">
                    <i class="fas fa-check-circle"></i> {{ session('message') }}
                </div>
            @endif
            @if(session()->has('warning'))
                <div class="nd-flash nd-flash-error" style="margin-bottom:1rem;">
                    <i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}
                </div>
            @endif

            {{-- Step 1: Select Circle & Month --}}
            <div class="nd-card">
                <div class="nd-card-head">
                    <h3><i class="fas fa-filter"></i> Select Circle & Month</h3>
                </div>
                <div class="nd-card-body">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                        <div class="nd-field">
                            <label>Circle</label>
                            <select wire:model.live="circleId" class="nd-select" style="width:100%;padding:0.5rem 0.8rem;border-radius:10px;">
                                <option value="">— Select Circle —</option>
                                @foreach($circles as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }} ({{ $c->members_count }} members)</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="nd-field">
                            <label>Month</label>
                            <select wire:model.live="monthId" class="nd-select" style="width:100%;padding:0.5rem 0.8rem;border-radius:10px;" {{ empty($circleId) ? 'disabled' : '' }}>
                                <option value="">— Select Month —</option>
                                @foreach($months as $m)
                                    <option value="{{ $m->id }}">
                                        {{ $m->label ?? 'Month ' . $m->month_number }}
                                        ({{ \Carbon\Carbon::parse($m->start_date)->format('M d') }} – {{ \Carbon\Carbon::parse($m->end_date)->format('M d') }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            @if($simulation)
                @php
                    $pool = $simulation['pool_summary'];
                @endphp

                {{-- Step 2: Pool Summary --}}
                <div class="nd-card" style="margin-top:1.25rem;">
                    <div class="nd-card-head">
                        <h3><i class="fas fa-chart-pie"></i> Monthly Fund Pool</h3>
                        <button wire:click="runSimulation" class="nd-btn nd-btn-ghost" style="padding:0.3rem 0.8rem;font-size:0.75rem;">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                    </div>
                    <div class="nd-card-body">
                        <div class="fl-pool-grid">
                            <div class="fl-pool-card">
                                <div class="fl-pool-label">Monthly Shares</div>
                                <div class="fl-pool-value">K{{ number_format($pool['month_shares'], 2) }}</div>
                            </div>
                            <div class="fl-pool-card">
                                <div class="fl-pool-label">Insurance</div>
                                <div class="fl-pool-value">K{{ number_format($pool['month_insurance'], 2) }}</div>
                            </div>
                            <div class="fl-pool-card">
                                <div class="fl-pool-label">Repayments In</div>
                                <div class="fl-pool-value">K{{ number_format($pool['month_repay'], 2) }}</div>
                            </div>
                            <div class="fl-pool-card" style="border-color:var(--nd-navy);">
                                <div class="fl-pool-label">Total Inflow</div>
                                <div class="fl-pool-value" style="color:var(--nd-navy);">K{{ number_format($pool['total_inflow'], 2) }}</div>
                            </div>
                            <div class="fl-pool-card {{ $pool['total_borrowed'] > 0 ? '' : 'danger' }}">
                                <div class="fl-pool-label">Already Borrowed</div>
                                <div class="fl-pool-value" style="color:{{ $pool['total_borrowed'] > 0 ? 'var(--nd-green)' : 'var(--nd-red)' }};">K{{ number_format($pool['total_borrowed'], 2) }}</div>
                            </div>
                            <div class="fl-pool-card highlight">
                                <div class="fl-pool-label"><i class="fas fa-bolt" style="color:var(--nd-amber);"></i> Unborrowed</div>
                                <div class="fl-pool-value">K{{ number_format($pool['unborrowed'], 2) }}</div>
                            </div>
                        </div>

                        @if($pool['unborrowed'] <= 0)
                            <div class="nd-empty" style="padding:1.5rem;">
                                <i class="fas fa-check-double"></i>
                                <strong>All funds are borrowed!</strong>
                                <p>There are no unborrowed funds to distribute. No forced loans needed.</p>
                            </div>
                        @endif
                    </div>
                </div>

                @if($pool['unborrowed'] > 0)
                    {{-- Step 3: Allocation Table --}}
                    <div class="nd-card" style="margin-top:1.25rem;">
                        <div class="nd-card-head">
                            <h3><i class="fas fa-users"></i> Forced Loan Allocations</h3>
                            <div style="display:flex;align-items:center;gap:0.75rem;">
                                <span style="font-size:0.75rem;color:var(--nd-muted);font-weight:600;">
                                    {{ $simulation['eligible_count'] }} eligible &bull;
                                    {{ $simulation['ineligible_count'] }} ineligible
                                </span>
                            </div>
                        </div>
                        <div class="nd-card-body" style="padding:0;">
                            @if(!empty($simulation['allocations']))
                                {{-- Header --}}
                                <div style="display:flex;align-items:center;gap:0.85rem;padding:0.55rem 1rem;background:#f8fafc;border-bottom:1px solid var(--nd-border);font-size:0.64rem;text-transform:uppercase;letter-spacing:0.5px;font-weight:700;color:var(--nd-faint);">
                                    <div style="width:18px;"></div>
                                    <div class="nd-avatar" style="visibility:hidden;"></div>
                                    <div style="flex:1;">Member</div>
                                    <div style="width:100px;text-align:right;">Month Share</div>
                                    <div style="width:100px;text-align:right;">Total Savings</div>
                                    <div style="width:100px;text-align:right;">Max Eligible</div>
                                    <div style="width:140px;text-align:right;">Forced Loan</div>
                                </div>

                                @foreach($simulation['allocations'] as $idx => $alloc)
                                    @php
                                        $mId      = $alloc['member_id'];
                                        $mName    = $alloc['member_name'];
                                        $mEmail   = $alloc['member_email'];
                                        $excluded = !empty($excludeMembers[$mId]);
                                        $parts    = explode(' ', trim($mName));
                                        $initials = strtoupper(substr($parts[0],0,1) . (isset($parts[1]) ? substr($parts[1],0,1) : ''));
                                    @endphp
                                    <div class="fl-alloc-row {{ $excluded ? 'excluded' : '' }}">
                                        <input type="checkbox"
                                               class="fl-toggle"
                                               wire:model="excludeMembers.{{ $mId }}"
                                               title="{{ $excluded ? 'Include member' : 'Exclude member' }}"
                                               style="accent-color:{{ $excluded ? 'var(--nd-red)' : 'var(--nd-amber)' }};"
                                        >

                                        <div class="nd-avatar">{{ $initials }}</div>

                                        <div class="fl-member-info">
                                            <div class="fl-member-name">{{ $mName }}</div>
                                            <div class="fl-member-meta">
                                                {{ $mEmail }}
                                            </div>
                                        </div>

                                        <div style="width:100px;text-align:right;font-weight:600;font-size:0.85rem;color:var(--nd-muted);">
                                            K{{ number_format($alloc['month_share'], 2) }}
                                        </div>

                                        <div style="width:100px;text-align:right;font-weight:600;font-size:0.85rem;color:var(--nd-muted);">
                                            K{{ number_format($alloc['total_savings'], 2) }}
                                        </div>

                                        <div style="width:100px;text-align:right;font-weight:600;font-size:0.85rem;color:var(--nd-navy);">
                                            K{{ number_format($alloc['savings_limit'], 2) }}
                                        </div>

                                        <div style="width:140px;text-align:right;">
                                            <input type="number"
                                                   class="fl-amount-input"
                                                   wire:model.blur="amounts.{{ $mId }}"
                                                   step="0.01"
                                                   min="0"
                                                   max="{{ $alloc['savings_limit'] }}"
                                                   {{ $excluded ? 'disabled' : '' }}
                                            >
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="nd-empty" style="padding:2rem;">
                                    <i class="fas fa-user-slash"></i>
                                    <strong>No Eligible Members</strong>
                                    <p>All members either have existing loans or no savings.</p>
                                </div>
                            @endif
                        </div>

                        @if(!empty($simulation['allocations']))
                            {{-- Summary Bar --}}
                            <div style="padding:0 1.25rem 1.25rem;">
                                <div class="fl-summary">
                                    <div class="fl-summary-stat">
                                        <div class="fl-summary-stat-val">{{ $includedCount }}</div>
                                        <div class="fl-summary-stat-lbl">Members</div>
                                    </div>
                                    <div class="fl-summary-stat">
                                        <div class="fl-summary-stat-val">K{{ number_format($totalAllocated, 2) }}</div>
                                        <div class="fl-summary-stat-lbl">Total Allocated</div>
                                    </div>
                                    <div class="fl-summary-stat">
                                        <div class="fl-summary-stat-val">K{{ number_format($pool['unborrowed'] - $totalAllocated, 2) }}</div>
                                        <div class="fl-summary-stat-lbl">Remaining</div>
                                    </div>
                                    <div class="fl-summary-stat">
                                        <div class="fl-summary-stat-val">{{ $simulation['interest_rate'] }}%</div>
                                        <div class="fl-summary-stat-lbl">Interest Rate</div>
                                    </div>
                                    <div>
                                        <button wire:click="confirmGenerate" class="nd-btn nd-btn-amber">
                                            <i class="fas fa-bolt"></i> Generate Forced Loans
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Ineligible Members --}}
                    @if(!empty($simulation['ineligible']))
                        <div class="nd-card" style="margin-top:1.25rem;">
                            <div class="nd-card-head">
                                <h3><i class="fas fa-user-lock"></i> Ineligible Members</h3>
                                <span style="font-size:0.75rem;color:var(--nd-faint);font-weight:600;">{{ count($simulation['ineligible']) }} member(s)</span>
                            </div>
                            <div class="nd-card-body">
                                @foreach($simulation['ineligible'] as $ie)
                                    <div class="fl-inelig">
                                        <i class="fas fa-ban" style="color:var(--nd-red);font-size:0.75rem;"></i>
                                        <span class="fl-inelig-name">{{ $ie['member_name'] }}</span>
                                        <span class="fl-inelig-reason">— {{ $ie['reason'] }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif

                {{-- How it Works --}}
                <div class="nd-card" style="margin-top:1.25rem;">
                    <div class="nd-card-head">
                        <h3><i class="fas fa-question-circle"></i> How Forced Loans Work</h3>
                    </div>
                    <div class="nd-card-body">
                        <div class="fl-steps">
                            <div class="fl-step">
                                <div class="fl-step-num">1</div>
                                <div>
                                    <div class="fl-step-title">Calculate Pool</div>
                                    <div class="fl-step-desc">Total shares + insurance + repayments minus already-borrowed = unborrowed funds.</div>
                                </div>
                            </div>
                            <div class="fl-step">
                                <div class="fl-step-num">2</div>
                                <div>
                                    <div class="fl-step-title">Proportional Split</div>
                                    <div class="fl-step-desc">Unborrowed funds are split based on each member's share declaration that month.</div>
                                </div>
                            </div>
                            <div class="fl-step">
                                <div class="fl-step-num">3</div>
                                <div>
                                    <div class="fl-step-title">Cap at Limit</div>
                                    <div class="fl-step-desc">Each member's allocation is capped at their savings × multiplier (max eligible amount).</div>
                                </div>
                            </div>
                            <div class="fl-step">
                                <div class="fl-step-num">4</div>
                                <div>
                                    <div class="fl-step-title">Generate & Pair</div>
                                    <div class="fl-step-desc">Loans are created, auto-approved, and auto-paired with lenders from the circle.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif(!empty($circleId) && !empty($monthId))
                {{-- Loading --}}
                <div class="nd-card" style="margin-top:1.25rem;">
                    <div class="nd-card-body" style="text-align:center;padding:3rem;">
                        <div class="nd-spinner" style="margin:0 auto 0.75rem;"></div>
                        <p style="color:var(--nd-muted);font-size:0.88rem;">Analysing fund pool…</p>
                    </div>
                </div>
            @elseif(empty($circleId))
                {{-- Empty state --}}
                <div class="nd-card" style="margin-top:1.25rem;">
                    <div class="nd-card-body">
                        <div class="nd-empty">
                            <i class="fas fa-bolt"></i>
                            <strong>Select a circle and month to begin</strong>
                            <p>The forced loan tool will analyse the monthly fund pool and calculate proportional allocations.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- ═══════════ Confirmation Modal ═══════════ --}}
    @if($showConfirm)
        <div class="nd-overlay" wire:click.self="cancelConfirm">
            <div class="nd-modal" style="max-width:520px;">
                <div class="nd-modal-head">
                    <h5><i class="fas fa-bolt"></i> Confirm Forced Loan Generation</h5>
                    <button wire:click="cancelConfirm" class="nd-modal-close"><i class="fas fa-times"></i></button>
                </div>
                <div class="nd-modal-body">
                    <div style="text-align:center;margin-bottom:0.75rem;">
                        <div style="width:56px;height:56px;border-radius:50%;background:linear-gradient(135deg,#fef3c7,#fde68a);display:inline-flex;align-items:center;justify-content:center;margin-bottom:0.5rem;">
                            <i class="fas fa-bolt" style="font-size:1.3rem;color:#b45309;"></i>
                        </div>
                        <h4 style="font-weight:800;color:var(--nd-text);margin:0;">Generate Forced Loans?</h4>
                        <p style="font-size:0.85rem;color:var(--nd-muted);margin:0.25rem 0 0;">
                            This will create <strong>{{ $includedCount }}</strong> loan record(s), auto-approve, and auto-pair them.
                        </p>
                    </div>

                    <div class="fl-confirm-summary">
                        <div class="fl-confirm-item">
                            <div class="fl-confirm-item-val">{{ $includedCount }}</div>
                            <div class="fl-confirm-item-lbl">Loans</div>
                        </div>
                        <div class="fl-confirm-item">
                            <div class="fl-confirm-item-val">K{{ number_format($totalAllocated, 2) }}</div>
                            <div class="fl-confirm-item-lbl">Total Amount</div>
                        </div>
                        <div class="fl-confirm-item">
                            <div class="fl-confirm-item-val">{{ $simulation['interest_rate'] ?? 0 }}%</div>
                            <div class="fl-confirm-item-lbl">Interest</div>
                        </div>
                        <div class="fl-confirm-item">
                            <div class="fl-confirm-item-val">{{ $simulation['duration'] ?? 1 }} mo</div>
                            <div class="fl-confirm-item-lbl">Duration</div>
                        </div>
                    </div>

                    <div style="background:#fffbeb;border:1px solid #fde68a;border-radius:10px;padding:0.65rem 0.85rem;font-size:0.78rem;color:#92400e;display:flex;align-items:flex-start;gap:0.5rem;">
                        <i class="fas fa-exclamation-triangle" style="margin-top:0.15rem;flex-shrink:0;"></i>
                        <span>Forced loans are <strong>immediately approved and active</strong>. Members will see them in their loan list and must repay with the configured interest rate.</span>
                    </div>

                    <div style="display:flex;gap:0.5rem;margin-top:1.25rem;">
                        <button wire:click="generateForcedLoans" class="nd-btn nd-btn-amber" style="flex:1;justify-content:center;">
                            <i class="fas fa-bolt"></i> Yes, Generate Loans
                        </button>
                        <button wire:click="cancelConfirm" class="nd-btn nd-btn-ghost">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Loading overlay --}}
    <div wire:loading.flex wire:target="runSimulation,generateForcedLoans" class="nd-loading">
        <div style="background:#fff;padding:0.85rem 1.75rem;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,0.1);display:flex;align-items:center;gap:0.65rem;">
            <div class="nd-spinner"></div>
            <span style="font-weight:600;color:var(--nd-text);font-size:0.85rem;">Processing…</span>
        </div>
    </div>
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
