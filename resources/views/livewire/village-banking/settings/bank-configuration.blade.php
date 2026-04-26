<div>
    @push('custom-styles')
    <style>
        :root {
            --bc-navy:#1E3A5F; --bc-navy-light:#2B6B96; --bc-amber:#D97706; --bc-amber-light:#F59E0B;
            --bc-bg:#f4f6fa; --bc-card:#fff; --bc-border:#edf0f7; --bc-text:#1e293b;
            --bc-muted:#64748b; --bc-faint:#94a3b8; --bc-green:#16a34a; --bc-red:#dc2626; --bc-blue:#2563eb; --bc-radius:16px;
        }
        .bc-page { background:var(--bc-bg); min-height:100vh; }
        .bc-hero {
            background:linear-gradient(135deg,var(--bc-navy) 0%,#234b78 50%,var(--bc-navy-light) 100%);
            padding:1.75rem 0 5rem; position:relative; overflow:hidden;
        }
        .bc-hero::before { content:''; position:absolute; width:500px; height:500px; top:-50%; right:-5%; background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
        .bc-hero-inner { position:relative; z-index:2; padding:0 1.5rem; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:.75rem; }
        .bc-breadcrumb { display:flex; gap:.5rem; list-style:none; padding:0; margin:0; font-size:.82rem; }
        .bc-breadcrumb a { color:rgba(255,255,255,.55); text-decoration:none; }
        .bc-breadcrumb a:hover { color:rgba(255,255,255,.85); }
        .bc-breadcrumb .active { color:var(--bc-amber-light); font-weight:600; }
        .bc-breadcrumb .sep { color:rgba(255,255,255,.25); }
        .bc-hero-title { color:#fff; font-size:1.3rem; font-weight:800; margin:.3rem 0 0; }
        .bc-hero-sub { color:rgba(255,255,255,.5); font-size:.8rem; margin:.15rem 0 0; }
        .bc-bank-badge { display:inline-flex; align-items:center; gap:.4rem; background:rgba(255,255,255,.1); padding:.3rem .75rem; border-radius:8px; color:var(--bc-amber-light); font-size:.78rem; font-weight:700; backdrop-filter:blur(6px); }
        .bc-content { margin-top:-3.5rem; position:relative; z-index:10; padding:0 1.5rem 2rem; }
        .bc-grid { display:grid; grid-template-columns:1fr 1fr; gap:1.25rem; }
        @media(max-width:992px){ .bc-grid { grid-template-columns:1fr; } }
        .bc-card { background:var(--bc-card); border-radius:var(--bc-radius); border:1px solid var(--bc-border); box-shadow:0 2px 12px rgba(0,0,0,.04); overflow:hidden; }
        .bc-card-head { padding:.85rem 1.25rem; border-bottom:1px solid var(--bc-border); display:flex; align-items:center; gap:.45rem; }
        .bc-card-title { font-size:.9rem; font-weight:700; color:var(--bc-text); margin:0; display:flex; align-items:center; gap:.45rem; }
        .bc-card-title i { color:var(--bc-amber); font-size:.85rem; }
        .bc-card-body { padding:1.25rem 1.5rem; }
        .bc-label { font-size:.72rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--bc-faint); margin-bottom:.3rem; display:block; }
        .bc-input {
            width:100%; padding:.5rem .75rem; border:2px solid #e2e8f0; border-radius:10px;
            font-size:.88rem; color:var(--bc-text); transition:border-color .2s; background:#fff;
        }
        .bc-input:focus { border-color:var(--bc-amber); outline:none; }
        .bc-input:disabled { background:#f8fafc; cursor:not-allowed; }
        .bc-input-error { border-color:var(--bc-red) !important; }
        .bc-error { font-size:.75rem; color:var(--bc-red); margin-top:.2rem; font-weight:600; }
        .bc-row { display:grid; gap:1rem; margin-bottom:1rem; }
        .bc-row-2 { grid-template-columns:1fr 1fr; }
        .bc-row-3 { grid-template-columns:1fr 1fr 1fr; }
        @media(max-width:768px){ .bc-row-2,.bc-row-3 { grid-template-columns:1fr; } }
        .bc-hint { font-size:.72rem; color:var(--bc-muted); margin-top:.2rem; line-height:1.35; }
        .bc-toggle {
            position:relative; width:42px; height:22px; background:#e2e8f0; border-radius:11px; cursor:pointer;
            border:none; transition:background .2s; display:inline-block;
        }
        .bc-toggle.active { background:var(--bc-green); }
        .bc-toggle::after {
            content:''; position:absolute; top:2px; left:2px; width:18px; height:18px;
            background:#fff; border-radius:50%; transition:transform .2s; box-shadow:0 1px 3px rgba(0,0,0,.15);
        }
        .bc-toggle.active::after { transform:translateX(20px); }
        .bc-btn {
            display:inline-flex; align-items:center; gap:.35rem; padding:.5rem 1.2rem; border-radius:10px;
            font-size:.84rem; font-weight:600; border:none; cursor:pointer; transition:all .2s;
        }
        .bc-btn-primary { background:linear-gradient(135deg,var(--bc-navy),var(--bc-navy-light)); color:#fff; }
        .bc-btn-primary:hover { transform:translateY(-1px); box-shadow:0 4px 12px rgba(30,58,95,.3); }
        .bc-btn-primary:disabled { opacity:.6; cursor:not-allowed; transform:none; box-shadow:none; }
        .bc-btn-ghost { background:#f1f5f9; color:var(--bc-muted); text-decoration:none; }
        .bc-btn-ghost:hover { background:#e2e8f0; color:var(--bc-text); text-decoration:none; }
        .bc-btn-amber { background:linear-gradient(135deg,var(--bc-amber),var(--bc-amber-light)); color:#fff; }
        .bc-btn-amber:hover { transform:translateY(-1px); box-shadow:0 4px 12px rgba(217,119,6,.3); }
        .bc-btn-sm { padding:.35rem .7rem; font-size:.75rem; border-radius:8px; }
        .bc-btn-danger { background:#fef2f2; color:var(--bc-red); border:1px solid #fecaca; }
        .bc-btn-danger:hover { background:#fee2e2; }
        .bc-flash { display:flex; align-items:center; gap:.5rem; padding:.7rem 1.15rem; border-radius:12px; font-size:.84rem; font-weight:600; margin-bottom:1rem; }
        .bc-flash-success { background:#f0fdf4; color:var(--bc-green); border:1px solid #bbf7d0; }
        .bc-flash-warning { background:#fffbeb; color:#92400e; border:1px solid #fde68a; }
        .bc-preview-box {
            padding:.75rem 1rem; border-radius:12px; background:linear-gradient(135deg,#f0f9ff,#e0f2fe);
            border:1px solid #bae6fd; margin-top:.75rem;
        }
        .bc-preview-label { font-size:.65rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--bc-blue); }
        .bc-preview-value { font-size:1.1rem; font-weight:800; color:var(--bc-navy); margin:.1rem 0; }
        .bc-preview-hint { font-size:.68rem; color:var(--bc-muted); }
        .bc-section-icon {
            width:34px;height:34px;border-radius:10px;display:flex;align-items:center;justify-content:center;
            font-size:.85rem;flex-shrink:0;
        }
        .bc-icon-insurance { background:#fef3c7; color:#b45309; }
        .bc-icon-loan { background:#dbeafe; color:#1d4ed8; }
        .bc-icon-penalty { background:#fee2e2; color:#dc2626; }
        .bc-icon-circle { background:#e0e7ff; color:#4338ca; }
        .bc-icon-shares { background:#d1fae5; color:#047857; }
        .bc-shares-preview { background:#f0fdf4; border:1px solid #bbf7d0; border-radius:.5rem; padding:.75rem 1rem; margin-top:.75rem; }
        .bc-shares-preview-row { display:flex; justify-content:space-between; font-size:.82rem; margin:.15rem 0; }
        .bc-shares-preview-label { color:var(--bc-muted); }
        .bc-shares-preview-value { font-weight:600; color:#047857; }
        .bc-icon-account { background:#d1fae5; color:#059669; }
        .bc-icon-month { background:#fce7f3; color:#be185d; }

        /* ── Tabs ─────────────────────── */
        .bc-tabs { display:flex; gap:.5rem; margin-bottom:1.25rem; flex-wrap:wrap; }
        .bc-tab {
            display:inline-flex; align-items:center; gap:.35rem; padding:.5rem 1rem; border-radius:10px;
            font-size:.82rem; font-weight:600; cursor:pointer; transition:all .2s;
            border:2px solid transparent; background:#f1f5f9; color:var(--bc-muted); text-decoration:none;
        }
        .bc-tab:hover { background:#e2e8f0; color:var(--bc-text); text-decoration:none; }
        .bc-tab.active { background:var(--bc-navy); color:#fff; border-color:var(--bc-navy); }
        .bc-tab i { font-size:.7rem; }

        /* ── Month config table ────────── */
        .bc-month-table { width:100%; border-collapse:collapse; font-size:.8rem; }
        .bc-month-table th { text-align:center; padding:.45rem .35rem; font-size:.65rem; text-transform:uppercase; letter-spacing:.5px; color:var(--bc-faint); font-weight:700; border-bottom:2px solid var(--bc-border); }
        .bc-month-table th:first-child, .bc-month-table td:first-child { text-align:left; }
        .bc-month-table td { padding:.4rem .35rem; border-bottom:1px solid var(--bc-border); text-align:center; vertical-align:middle; }
        .bc-month-table tr:last-child td { border-bottom:none; }
        .bc-month-label-input { border:1px solid #e2e8f0; border-radius:6px; padding:.25rem .45rem; font-size:.78rem; width:100%; min-width:120px; }
        .bc-month-label-input:focus { border-color:var(--bc-amber); outline:none; }
        .bc-check { width:16px; height:16px; accent-color:var(--bc-navy); cursor:pointer; }
        .bc-shareout-badge { display:inline-flex; align-items:center; gap:.2rem; background:#fef3c7; color:#b45309; padding:.15rem .45rem; border-radius:6px; font-size:.65rem; font-weight:700; }

        /* ── Account cards ─────────────── */
        .bc-acct-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:1rem; }
        .bc-acct-card {
            border:1px solid var(--bc-border); border-radius:12px; padding:1rem; position:relative;
            transition:box-shadow .2s;
        }
        .bc-acct-card:hover { box-shadow:0 4px 16px rgba(0,0,0,.06); }
        .bc-acct-card.inactive { opacity:.55; }
        .bc-acct-type { display:inline-flex; align-items:center; gap:.25rem; font-size:.65rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; padding:.15rem .5rem; border-radius:6px; }
        .bc-acct-type.mobile { background:#ecfdf5; color:#059669; }
        .bc-acct-type.bank { background:#eff6ff; color:#2563eb; }
        .bc-acct-primary { position:absolute; top:.75rem; right:.75rem; background:#fef3c7; color:#b45309; font-size:.6rem; font-weight:700; padding:.15rem .45rem; border-radius:5px; text-transform:uppercase; letter-spacing:.5px; }
        .bc-acct-name { font-size:.9rem; font-weight:700; color:var(--bc-text); margin:.45rem 0 .15rem; }
        .bc-acct-detail { font-size:.78rem; color:var(--bc-muted); }
        .bc-acct-actions { display:flex; gap:.4rem; margin-top:.65rem; }

        /* ── Modal overlay ─────────────── */
        .bc-overlay {
            position:fixed; inset:0; z-index:1050; display:flex; align-items:center; justify-content:center;
            background:rgba(15,23,42,.45); backdrop-filter:blur(4px);
        }
        .bc-modal {
            background:#fff; border-radius:var(--bc-radius); width:100%; max-width:520px; max-height:90vh;
            overflow-y:auto; box-shadow:0 25px 60px rgba(0,0,0,.15); animation:bcSlide .25s ease;
        }
        .bc-modal-head { padding:.85rem 1.25rem; border-bottom:1px solid var(--bc-border); display:flex; justify-content:space-between; align-items:center; }
        .bc-modal-body { padding:1.25rem 1.5rem; }
        .bc-modal-foot { padding:.85rem 1.25rem; border-top:1px solid var(--bc-border); display:flex; justify-content:flex-end; gap:.65rem; }
        .bc-close { background:none; border:none; font-size:1.2rem; cursor:pointer; color:var(--bc-faint); }
        .bc-close:hover { color:var(--bc-text); }

        @keyframes bcSlide { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
        .bc-animate { animation:bcSlide .3s ease; }
        @media(max-width:768px){ .bc-content{padding:0 .75rem 1.5rem;} }
    </style>
    @endpush

    @can('manage-bank-config')
    <section class="content bc-page">
        {{-- Hero --}}
        <div class="bc-hero">
            <div class="bc-hero-inner container-fluid">
                <div>
                    <ul class="bc-breadcrumb">
                        <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                        <li class="sep">/</li>
                        <li class="active">Bank Configuration</li>
                    </ul>
                    <h1 class="bc-hero-title"><i class="fas fa-cogs" style="margin-right:.4rem;"></i> Village Bank Configuration</h1>
                    <p class="bc-hero-sub">Manage insurance, loans, circle months, accounts and penalty settings</p>
                </div>
                @if($bankName)
                    <div class="bc-bank-badge">
                        <i class="fas fa-university"></i> {{ $bankName }} ({{ $bankCode }})
                    </div>
                @endif
            </div>
        </div>

        <div class="bc-content container-fluid bc-animate">
            {{-- VB Selector --}}
            @if(count($this->villageBanks) > 1)
                <div style="margin-bottom:1rem;">
                    <select wire:model.live="villageBankId" class="bc-input" style="max-width:360px;">
                        <option value="">-- Select Village Bank --</option>
                        @foreach($this->villageBanks as $vb)
                            <option value="{{ $vb->id }}">{{ $vb->name }} ({{ $vb->code }})</option>
                        @endforeach
                    </select>
                </div>
            @endif

            {{-- Flash messages --}}
            @if($savedMessage)
                <div class="bc-flash bc-flash-success"><i class="fas fa-check-circle"></i> {{ $savedMessage }}</div>
            @endif
            @if(session()->has('warning'))
                <div class="bc-flash bc-flash-warning"><i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}</div>
            @endif
            @if($errors->any())
                <div class="bc-flash" style="background:#fef2f2;color:var(--bc-red);border:1px solid #fecaca;">
                    <i class="fas fa-exclamation-circle"></i> Please fix the errors below.
                </div>
            @endif

            @if($this->activeBankId())

            {{-- ═══ Tabs ═══ --}}
            <div class="bc-tabs">
                <a wire:click.prevent="setTab('general')" class="bc-tab {{ $activeTab === 'general' ? 'active' : '' }}">
                    <i class="fas fa-sliders-h"></i> General Settings
                </a>
                <a wire:click.prevent="setTab('months')" class="bc-tab {{ $activeTab === 'months' ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt"></i> Month Schedule
                </a>
                <a wire:click.prevent="setTab('accounts')" class="bc-tab {{ $activeTab === 'accounts' ? 'active' : '' }}">
                    <i class="fas fa-wallet"></i> Bank Accounts
                </a>
                <a wire:click.prevent="setTab('communications')" class="bc-tab {{ $activeTab === 'communications' ? 'active' : '' }}">
                    <i class="fas fa-comments"></i> Communications
                </a>
                <a wire:click.prevent="setTab('governance')" class="bc-tab {{ $activeTab === 'governance' ? 'active' : '' }}">
                    <i class="fas fa-gavel"></i> Governance
                </a>
            </div>

            {{-- ═══════════════════════════════════════
                 TAB 1: GENERAL SETTINGS
                 ═══════════════════════════════════════ --}}
            @if($activeTab === 'general')
            <form wire:submit.prevent="saveConfiguration">
                <div class="bc-grid">
                    {{-- ── LEFT COLUMN ── --}}
                    <div style="display:flex;flex-direction:column;gap:1.25rem;">

                        {{-- Circle Duration --}}
                        <div class="bc-card">
                            <div class="bc-card-head">
                                <div class="bc-section-icon bc-icon-circle"><i class="fas fa-sync-alt"></i></div>
                                <h3 class="bc-card-title">Circle Settings</h3>
                            </div>
                            <div class="bc-card-body">
                                <p style="font-size:.78rem;color:var(--bc-muted);margin:0 0 1rem;">
                                    Default number of months for new circles. When a circle is created, months are auto-generated from this value.
                                </p>
                                <div>
                                    <label class="bc-label">Circle Duration (months)</label>
                                    <input type="number" min="1" max="60"
                                           wire:model="circle_duration_months"
                                           class="bc-input @error('circle_duration_months') bc-input-error @enderror"
                                           placeholder="12" style="max-width:200px;">
                                    @error('circle_duration_months') <div class="bc-error">{{ $message }}</div> @enderror
                                    <div class="bc-hint">The month schedule tab lets you configure what happens in each month</div>
                                </div>
                            </div>
                        </div>

                        {{-- Shares Config --}}
                        <div class="bc-card">
                            <div class="bc-card-head">
                                <div class="bc-section-icon bc-icon-shares"><i class="fas fa-coins"></i></div>
                                <h3 class="bc-card-title">Shares Configuration</h3>
                            </div>
                            <div class="bc-card-body">
                                <p style="font-size:.78rem;color:var(--bc-muted);margin:0 0 1rem;">
                                    Share declarations must be in multiples of the unit amount. Set the minimum and maximum number of shares a member can buy per month.
                                </p>
                                <div>
                                    <label class="bc-label">Share Unit Amount (K)</label>
                                    <input type="number" step="1" min="1"
                                           wire:model="share_unit_amount"
                                           class="bc-input @error('share_unit_amount') bc-input-error @enderror"
                                           placeholder="200" style="max-width:200px;">
                                    @error('share_unit_amount') <div class="bc-error">{{ $message }}</div> @enderror
                                    <div class="bc-hint">1 share = K{{ number_format($share_unit_amount, 0) }}</div>
                                </div>
                                <div class="bc-row bc-row-2" style="margin-top:.75rem;">
                                    <div>
                                        <label class="bc-label">Min Shares / Month</label>
                                        <input type="number" min="1"
                                               wire:model="min_shares_per_month"
                                               class="bc-input @error('min_shares_per_month') bc-input-error @enderror"
                                               placeholder="1">
                                        @error('min_shares_per_month') <div class="bc-error">{{ $message }}</div> @enderror
                                    </div>
                                    <div>
                                        <label class="bc-label">Max Shares / Month</label>
                                        <input type="number" min="1"
                                               wire:model="max_shares_per_month"
                                               class="bc-input @error('max_shares_per_month') bc-input-error @enderror"
                                               placeholder="50">
                                        @error('max_shares_per_month') <div class="bc-error">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                <div class="bc-shares-preview">
                                    <div class="bc-shares-preview-row">
                                        <span class="bc-shares-preview-label">Minimum declaration</span>
                                        <span class="bc-shares-preview-value">K{{ number_format($share_unit_amount * $min_shares_per_month, 0) }}</span>
                                    </div>
                                    <div class="bc-shares-preview-row">
                                        <span class="bc-shares-preview-label">Maximum declaration</span>
                                        <span class="bc-shares-preview-value">K{{ number_format($share_unit_amount * $max_shares_per_month, 0) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Insurance Config --}}
                        <div class="bc-card">
                            <div class="bc-card-head">
                                <div class="bc-section-icon bc-icon-insurance"><i class="fas fa-shield-alt"></i></div>
                                <h3 class="bc-card-title">Insurance Configuration</h3>
                            </div>
                            <div class="bc-card-body">
                                <p style="font-size:.78rem;color:var(--bc-muted);margin:0 0 1rem;">
                                    Default insurance calculation applied when collecting share declarations.
                                </p>
                                <div class="bc-row bc-row-2">
                                    <div>
                                        <label class="bc-label">Insurance Type</label>
                                        <select wire:model.live="insurance_type" class="bc-input @error('insurance_type') bc-input-error @enderror">
                                            <option value="percentage">Percentage of Shares</option>
                                            <option value="fixed">Fixed Amount</option>
                                        </select>
                                        @error('insurance_type') <div class="bc-error">{{ $message }}</div> @enderror
                                        <div class="bc-hint">
                                            @if($insurance_type === 'percentage')
                                                Insurance = share amount &times; {{ $insurance_value }}%
                                            @else
                                                Fixed amount per member per month
                                            @endif
                                        </div>
                                    </div>
                                    <div>
                                        <label class="bc-label">{{ $insurance_type === 'percentage' ? 'Percentage (%)' : 'Amount (K)' }}</label>
                                        <input type="number" step="0.01" min="0"
                                               wire:model="insurance_value"
                                               class="bc-input @error('insurance_value') bc-input-error @enderror"
                                               placeholder="{{ $insurance_type === 'percentage' ? 'e.g. 10' : 'e.g. 500' }}">
                                        @error('insurance_value') <div class="bc-error">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                {{-- Insurance Profit to Members --}}
                                <div style="margin-top:1.25rem;display:flex;align-items:center;gap:.75rem;padding:1rem;background:#fafbfd;border-radius:12px;border:1px solid var(--bc-border);">
                                    <button type="button"
                                            class="bc-toggle {{ $insurance_profit_to_members ? 'active' : '' }}"
                                            wire:click="$toggle('insurance_profit_to_members')">
                                    </button>
                                    <div style="flex:1;">
                                        <div style="font-size:.84rem;font-weight:700;color:var(--bc-text);">Give Insurance Profit to Members</div>
                                        <div class="bc-hint" style="margin-top:0;">
                                            @if($insurance_profit_to_members)
                                                Insurance profit is included in each member's shareout payout.
                                            @else
                                                <span style="color:#b45309;font-weight:600;"><i class="fas fa-hand-holding-heart" style="margin-right:.2rem;"></i> Social Fund mode</span> —
                                                Insurance profit and penalties are pooled into a social fund instead of being distributed to members.
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Penalty Config --}}
                        <div class="bc-card">
                            <div class="bc-card-head">
                                <div class="bc-section-icon bc-icon-penalty"><i class="fas fa-exclamation-triangle"></i></div>
                                <h3 class="bc-card-title">Penalty Settings</h3>
                            </div>
                            <div class="bc-card-body">
                                <p style="font-size:.78rem;color:var(--bc-muted);margin:0 0 1rem;">
                                    Configure late repayment penalties and grace periods.
                                </p>
                                <div class="bc-row bc-row-2">
                                    <div>
                                        <label class="bc-label">Late Repayment Penalty (%)</label>
                                        <input type="number" step="0.01" min="0" max="100"
                                               wire:model="late_repayment_penalty_rate"
                                               class="bc-input @error('late_repayment_penalty_rate') bc-input-error @enderror"
                                               placeholder="5">
                                        @error('late_repayment_penalty_rate') <div class="bc-error">{{ $message }}</div> @enderror
                                        <div class="bc-hint">Penalty charged on outstanding balance for late payments</div>
                                    </div>
                                    <div>
                                        <label class="bc-label">Grace Period (days)</label>
                                        <input type="number" min="0" max="90"
                                               wire:model="grace_period_days"
                                               class="bc-input @error('grace_period_days') bc-input-error @enderror"
                                               placeholder="0">
                                        @error('grace_period_days') <div class="bc-error">{{ $message }}</div> @enderror
                                        <div class="bc-hint">Days after due date before penalty kicks in</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ── RIGHT COLUMN ── --}}
                    <div style="display:flex;flex-direction:column;gap:1.25rem;">

                        {{-- Loan Config --}}
                        <div class="bc-card">
                            <div class="bc-card-head">
                                <div class="bc-section-icon bc-icon-loan"><i class="fas fa-hand-holding-usd"></i></div>
                                <h3 class="bc-card-title">Loan Configuration</h3>
                            </div>
                            <div class="bc-card-body">
                                <p style="font-size:.78rem;color:var(--bc-muted);margin:0 0 1rem;">
                                    Members can borrow up to <strong>{{ $max_loan_multiplier }}&times;</strong> their total savings in a circle, limited by available monthly funds.
                                </p>

                                {{-- Multiplier --}}
                                <div class="bc-row" style="margin-bottom:1.25rem;">
                                    <div>
                                        <label class="bc-label">Maximum Borrowing Multiplier</label>
                                        <input type="number" min="1" max="20"
                                               wire:model="max_loan_multiplier"
                                               class="bc-input @error('max_loan_multiplier') bc-input-error @enderror"
                                               placeholder="3" style="max-width:200px;">
                                        @error('max_loan_multiplier') <div class="bc-error">{{ $message }}</div> @enderror
                                        <div class="bc-hint">Example: if set to {{ $max_loan_multiplier }}, a member with K10,000 savings can borrow up to K{{ number_format(10000 * max(1, (int)$max_loan_multiplier)) }}</div>
                                        <div class="bc-preview-box">
                                            <div class="bc-preview-label">Preview with K10,000 savings</div>
                                            <div class="bc-preview-value">K{{ number_format($this->exampleBorrowable, 2) }}</div>
                                            <div class="bc-preview-hint">Savings &times; {{ $max_loan_multiplier }} = max borrowable (still limited by available monthly funds)</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Interest Type --}}
                                <div class="bc-row bc-row-2" style="margin-bottom:1rem;">
                                    <div>
                                        <label class="bc-label">Interest Type</label>
                                        <select wire:model.live="interest_type" class="bc-input @error('interest_type') bc-input-error @enderror">
                                            <option value="flat">Flat Rate</option>
                                            <option value="reducing_balance">Reducing Balance</option>
                                        </select>
                                        @error('interest_type') <div class="bc-error">{{ $message }}</div> @enderror
                                        <div class="bc-hint">
                                            @if($interest_type === 'flat')
                                                Interest calculated once on the full loan amount
                                            @else
                                                Interest recalculated on remaining balance each period
                                            @endif
                                        </div>
                                    </div>
                                    <div>
                                        @if($interest_type === 'reducing_balance')
                                            <label class="bc-label">Reducing Balance Rate (%)</label>
                                            <input type="number" step="0.01" min="0" max="100"
                                                   wire:model="reducing_balance_rate"
                                                   class="bc-input @error('reducing_balance_rate') bc-input-error @enderror"
                                                   placeholder="e.g. 3.5">
                                            @error('reducing_balance_rate') <div class="bc-error">{{ $message }}</div> @enderror
                                            <div class="bc-hint">Monthly rate applied to outstanding balance</div>
                                        @else
                                            <label class="bc-label">Default Interest Rate (%)</label>
                                            <input type="number" step="0.01" min="0" max="100"
                                                   wire:model="default_interest_rate"
                                                   class="bc-input @error('default_interest_rate') bc-input-error @enderror"
                                                   placeholder="20">
                                            @error('default_interest_rate') <div class="bc-error">{{ $message }}</div> @enderror
                                            <div class="bc-hint">One-time flat interest on loan principal</div>
                                        @endif
                                    </div>
                                </div>

                                @if($interest_type === 'reducing_balance')
                                <div class="bc-row" style="margin-bottom:1rem;">
                                    <div>
                                        <label class="bc-label">Flat Rate Fallback (%)</label>
                                        <input type="number" step="0.01" min="0" max="100"
                                               wire:model="default_interest_rate"
                                               class="bc-input @error('default_interest_rate') bc-input-error @enderror"
                                               placeholder="20">
                                        @error('default_interest_rate') <div class="bc-error">{{ $message }}</div> @enderror
                                        <div class="bc-hint">Used for total payable preview; actual interest computed on reducing balance</div>
                                    </div>
                                </div>
                                @endif

                                {{-- Duration --}}
                                <div class="bc-row bc-row-2">
                                    <div>
                                        <label class="bc-label">Default Loan Duration (months)</label>
                                        <input type="number" min="1" max="12"
                                               wire:model="default_loan_duration"
                                               class="bc-input @error('default_loan_duration') bc-input-error @enderror"
                                               placeholder="1">
                                        @error('default_loan_duration') <div class="bc-error">{{ $message }}</div> @enderror
                                    </div>
                                    <div>&nbsp;</div>
                                </div>

                                {{-- Min / Max Loan --}}
                                <div class="bc-row bc-row-2" style="margin-top:1rem;">
                                    <div>
                                        <label class="bc-label">Minimum Loan Amount (K)</label>
                                        <input type="number" step="0.01" min="0"
                                               wire:model="min_loan_amount"
                                               class="bc-input @error('min_loan_amount') bc-input-error @enderror"
                                               placeholder="Leave blank for no minimum">
                                        @error('min_loan_amount') <div class="bc-error">{{ $message }}</div> @enderror
                                        <div class="bc-hint">Optional hard floor</div>
                                    </div>
                                    <div>
                                        <label class="bc-label">Maximum Loan Amount (K)</label>
                                        <input type="number" step="0.01" min="0"
                                               wire:model="max_loan_amount"
                                               class="bc-input @error('max_loan_amount') bc-input-error @enderror"
                                               placeholder="Leave blank for no cap">
                                        @error('max_loan_amount') <div class="bc-error">{{ $message }}</div> @enderror
                                        <div class="bc-hint">Optional hard ceiling regardless of savings</div>
                                    </div>
                                </div>

                                {{-- Multiple Loans --}}
                                <div style="margin-top:1.25rem;display:flex;align-items:center;gap:.75rem;">
                                    <button type="button"
                                            class="bc-toggle {{ $allow_multiple_active_loans ? 'active' : '' }}"
                                            wire:click="$toggle('allow_multiple_active_loans')">
                                    </button>
                                    <div>
                                        <div style="font-size:.84rem;font-weight:700;color:var(--bc-text);">Allow Multiple Active Loans</div>
                                        <div class="bc-hint" style="margin-top:0;">If disabled, a member cannot request a new loan while they have a pending or active one</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Save button --}}
                <div style="margin-top:1.25rem;display:flex;justify-content:flex-end;">
                    <button type="submit" class="bc-btn bc-btn-primary" wire:loading.attr="disabled" wire:target="saveConfiguration">
                        <span wire:loading.remove wire:target="saveConfiguration"><i class="fas fa-save"></i> Save General Settings</span>
                        <span wire:loading wire:target="saveConfiguration"><i class="fas fa-spinner fa-spin"></i> Saving...</span>
                    </button>
                </div>
            </form>
            @endif

            {{-- ═══════════════════════════════════════
                 TAB 2: MONTH SCHEDULE
                 ═══════════════════════════════════════ --}}
            @if($activeTab === 'months')
            <div class="bc-card">
                <div class="bc-card-head" style="justify-content:space-between;">
                    <div style="display:flex;align-items:center;gap:.45rem;">
                        <div class="bc-section-icon bc-icon-month"><i class="fas fa-calendar-alt"></i></div>
                        <h3 class="bc-card-title">Month Activity Schedule</h3>
                    </div>
                    <button type="button" class="bc-btn bc-btn-ghost bc-btn-sm" wire:click="regenerateMonthConfigs"
                            wire:loading.attr="disabled"
                            onclick="return confirm('This will regenerate all month configs with defaults. Continue?')">
                        <i class="fas fa-redo"></i> Reset to Defaults
                    </button>
                </div>
                <div class="bc-card-body" style="padding:.75rem 1rem;">
                    <p style="font-size:.78rem;color:var(--bc-muted);margin:0 0 .75rem;">
                        Configure which activities are allowed in each month of the circle. Typically the last month is for shareout, and the last two months have no new loan requests.
                        Currently set to <strong>{{ $circle_duration_months }} months</strong> per circle.
                    </p>

                    @if(count($monthConfigs) > 0)
                    <div style="overflow-x:auto;">
                        <table class="bc-month-table">
                            <thead>
                                <tr>
                                    <th style="width:40px;">#</th>
                                    <th style="text-align:left;min-width:140px;">Label</th>
                                    <th><i class="fas fa-coins" title="Share Declarations"></i> Shares</th>
                                    <th><i class="fas fa-shield-alt" title="Insurance"></i> Insurance</th>
                                    <th><i class="fas fa-hand-holding-usd" title="Loan Requests"></i> Borrow</th>
                                    <th><i class="fas fa-money-bill-wave" title="Loan Repayments"></i> Repay</th>
                                    <th><i class="fas fa-chart-pie" title="Shareout"></i> Shareout</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($monthConfigs as $idx => $mc)
                                <tr style="{{ $mc['is_shareout_month'] ? 'background:#fffbeb;' : '' }}">
                                    <td style="font-weight:700;color:var(--bc-navy);">{{ $mc['month_number'] }}</td>
                                    <td>
                                        <input type="text"
                                               wire:model="monthConfigs.{{ $idx }}.label"
                                               class="bc-month-label-input"
                                               placeholder="Month {{ $mc['month_number'] }}">
                                    </td>
                                    <td>
                                        <input type="checkbox"
                                               wire:model="monthConfigs.{{ $idx }}.allow_share_declarations"
                                               class="bc-check">
                                    </td>
                                    <td>
                                        <input type="checkbox"
                                               wire:model="monthConfigs.{{ $idx }}.allow_insurance_declarations"
                                               class="bc-check">
                                    </td>
                                    <td>
                                        <input type="checkbox"
                                               wire:model="monthConfigs.{{ $idx }}.allow_loan_requests"
                                               class="bc-check">
                                    </td>
                                    <td>
                                        <input type="checkbox"
                                               wire:model="monthConfigs.{{ $idx }}.allow_loan_repayments"
                                               class="bc-check">
                                    </td>
                                    <td>
                                        <input type="checkbox"
                                               wire:model="monthConfigs.{{ $idx }}.is_shareout_month"
                                               class="bc-check">
                                        @if($mc['is_shareout_month'])
                                            <div class="bc-shareout-badge" style="margin-top:.2rem;"><i class="fas fa-star" style="font-size:.5rem;"></i> Shareout</div>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div style="margin-top:1rem;display:flex;justify-content:flex-end;">
                        <button type="button" class="bc-btn bc-btn-primary" wire:click="saveMonthConfigs"
                                wire:loading.attr="disabled" wire:target="saveMonthConfigs">
                            <span wire:loading.remove wire:target="saveMonthConfigs"><i class="fas fa-save"></i> Save Month Schedule</span>
                            <span wire:loading wire:target="saveMonthConfigs"><i class="fas fa-spinner fa-spin"></i> Saving...</span>
                        </button>
                    </div>
                    @else
                        <div style="text-align:center;padding:2rem;color:var(--bc-faint);">
                            <i class="fas fa-calendar-times" style="font-size:2rem;margin-bottom:.5rem;"></i>
                            <p style="margin:0;">No month configurations yet. Click "Reset to Defaults" to generate them.</p>
                        </div>
                    @endif
                </div>
            </div>
            @endif

            {{-- ═══════════════════════════════════════
                 TAB 3: BANK ACCOUNTS
                 ═══════════════════════════════════════ --}}
            @if($activeTab === 'accounts')
            <div class="bc-card">
                <div class="bc-card-head" style="justify-content:space-between;">
                    <div style="display:flex;align-items:center;gap:.45rem;">
                        <div class="bc-section-icon bc-icon-account"><i class="fas fa-wallet"></i></div>
                        <h3 class="bc-card-title">Bank &amp; Mobile Money Accounts</h3>
                    </div>
                    <button type="button" class="bc-btn bc-btn-amber bc-btn-sm" wire:click="openAccountModal()">
                        <i class="fas fa-plus"></i> Add Account
                    </button>
                </div>
                <div class="bc-card-body">
                    <p style="font-size:.78rem;color:var(--bc-muted);margin:0 0 1rem;">
                        Accounts where the village bank receives deposits or makes withdrawals. Members will see these when uploading payment proofs.
                    </p>

                    @if(count($accounts) > 0)
                    <div class="bc-acct-grid">
                        @foreach($accounts as $idx => $acct)
                        <div class="bc-acct-card {{ $acct['is_active'] ? '' : 'inactive' }}">
                            @if($acct['is_primary'])
                                <div class="bc-acct-primary"><i class="fas fa-star"></i> Primary</div>
                            @endif
                            <div class="bc-acct-type {{ $acct['account_type'] === 'mobile_money' ? 'mobile' : 'bank' }}">
                                <i class="fas fa-{{ $acct['account_type'] === 'mobile_money' ? 'mobile-alt' : 'landmark' }}"></i>
                                {{ $acct['account_type'] === 'mobile_money' ? 'Mobile Money' : 'Bank Account' }}
                            </div>
                            <div class="bc-acct-name">{{ $acct['provider_name'] }}</div>
                            <div class="bc-acct-detail"><strong>Name:</strong> {{ $acct['account_name'] }}</div>
                            <div class="bc-acct-detail"><strong>Number:</strong> {{ $acct['account_number'] }}</div>
                            @if($acct['branch'])
                                <div class="bc-acct-detail"><strong>Branch:</strong> {{ $acct['branch'] }}</div>
                            @endif
                            @if(!$acct['is_active'])
                                <div style="margin-top:.35rem;">
                                    <span style="font-size:.7rem;color:var(--bc-red);font-weight:700;"><i class="fas fa-ban"></i> Inactive</span>
                                </div>
                            @endif
                            <div class="bc-acct-actions">
                                <button type="button" class="bc-btn bc-btn-ghost bc-btn-sm" wire:click="openAccountModal({{ $idx }})">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <button type="button" class="bc-btn bc-btn-ghost bc-btn-sm" wire:click="toggleAccountActive({{ $idx }})">
                                    <i class="fas fa-{{ $acct['is_active'] ? 'eye-slash' : 'eye' }}"></i>
                                    {{ $acct['is_active'] ? 'Disable' : 'Enable' }}
                                </button>
                                <button type="button" class="bc-btn bc-btn-danger bc-btn-sm"
                                        wire:click="deleteAccount({{ $idx }})"
                                        onclick="return confirm('Remove this account?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                        <div style="text-align:center;padding:2rem;color:var(--bc-faint);">
                            <i class="fas fa-wallet" style="font-size:2rem;margin-bottom:.5rem;"></i>
                            <p style="margin:0;">No accounts yet. Add a bank or mobile money account.</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- ── Account Modal ── --}}
            {{-- ═══════════════════════════════════════
                 TAB 4: COMMUNICATIONS
                 ═══════════════════════════════════════ --}}
            @if($activeTab === 'communications')
            <form wire:submit.prevent="saveConfiguration">
                <div class="bc-card">
                    <div class="bc-card-head">
                        <div style="display:flex;align-items:center;gap:.45rem;">
                            <div class="bc-section-icon" style="background:linear-gradient(135deg,#6366f1,#818cf8);"><i class="fas fa-comments"></i></div>
                            <h3 class="bc-card-title">Communication Channel</h3>
                        </div>
                    </div>
                    <div class="bc-card-body">
                        <p style="font-size:.78rem;color:var(--bc-muted);margin:0 0 1.25rem;">
                            Choose how this village bank communicates with its members. The selected channel(s) will be available when sending messages from the Communications module.
                        </p>

                        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:1rem;">
                            {{-- Email --}}
                            <label style="display:flex;align-items:flex-start;gap:.75rem;padding:1rem;border:2px solid {{ $communication_channel === 'email' ? 'var(--bc-navy)' : '#e2e8f0' }};border-radius:.5rem;cursor:pointer;background:{{ $communication_channel === 'email' ? '#f0f4ff' : '#fff' }};transition:all .2s;">
                                <input type="radio" wire:model.live="communication_channel" value="email" style="margin-top:.15rem;accent-color:var(--bc-navy);">
                                <div>
                                    <div style="font-weight:700;font-size:.85rem;color:var(--bc-text);display:flex;align-items:center;gap:.35rem;">
                                        <i class="fas fa-envelope" style="color:#6366f1;"></i> Email Only
                                    </div>
                                    <div style="font-size:.72rem;color:var(--bc-muted);margin-top:.25rem;">Send messages via email. Members need a valid email address.</div>
                                </div>
                            </label>

                            {{-- SMS --}}
                            <label style="display:flex;align-items:flex-start;gap:.75rem;padding:1rem;border:2px solid {{ $communication_channel === 'sms' ? 'var(--bc-navy)' : '#e2e8f0' }};border-radius:.5rem;cursor:pointer;background:{{ $communication_channel === 'sms' ? '#f0f4ff' : '#fff' }};transition:all .2s;">
                                <input type="radio" wire:model.live="communication_channel" value="sms" style="margin-top:.15rem;accent-color:var(--bc-navy);">
                                <div>
                                    <div style="font-weight:700;font-size:.85rem;color:var(--bc-text);display:flex;align-items:center;gap:.35rem;">
                                        <i class="fas fa-sms" style="color:#10b981;"></i> SMS Only
                                    </div>
                                    <div style="font-size:.72rem;color:var(--bc-muted);margin-top:.25rem;">Send messages via SMS (MTN gateway). Members need a mobile number.</div>
                                </div>
                            </label>

                            {{-- Both --}}
                            <label style="display:flex;align-items:flex-start;gap:.75rem;padding:1rem;border:2px solid {{ $communication_channel === 'both' ? 'var(--bc-navy)' : '#e2e8f0' }};border-radius:.5rem;cursor:pointer;background:{{ $communication_channel === 'both' ? '#f0f4ff' : '#fff' }};transition:all .2s;">
                                <input type="radio" wire:model.live="communication_channel" value="both" style="margin-top:.15rem;accent-color:var(--bc-navy);">
                                <div>
                                    <div style="font-weight:700;font-size:.85rem;color:var(--bc-text);display:flex;align-items:center;gap:.35rem;">
                                        <i class="fas fa-paper-plane" style="color:#f59e0b;"></i> Both
                                    </div>
                                    <div style="font-size:.72rem;color:var(--bc-muted);margin-top:.25rem;">Allow sending via email or SMS. The sender chooses the channel per message.</div>
                                </div>
                            </label>

                            {{-- None --}}
                            <label style="display:flex;align-items:flex-start;gap:.75rem;padding:1rem;border:2px solid {{ $communication_channel === 'none' ? 'var(--bc-navy)' : '#e2e8f0' }};border-radius:.5rem;cursor:pointer;background:{{ $communication_channel === 'none' ? '#fff5f5' : '#fff' }};transition:all .2s;">
                                <input type="radio" wire:model.live="communication_channel" value="none" style="margin-top:.15rem;accent-color:var(--bc-navy);">
                                <div>
                                    <div style="font-weight:700;font-size:.85rem;color:var(--bc-text);display:flex;align-items:center;gap:.35rem;">
                                        <i class="fas fa-ban" style="color:#ef4444;"></i> Disabled
                                    </div>
                                    <div style="font-size:.72rem;color:var(--bc-muted);margin-top:.25rem;">No communications. The messaging feature will be hidden for this bank.</div>
                                </div>
                            </label>
                        </div>

                        @error('communication_channel')
                            <div class="bc-error" style="margin-top:.75rem;">{{ $message }}</div>
                        @enderror

                        {{-- Current status info box --}}
                        <div style="margin-top:1.25rem;padding:.85rem 1rem;border-radius:.5rem;background:#f8fafc;border:1px solid #e2e8f0;">
                            <div style="font-size:.78rem;font-weight:700;color:var(--bc-text);margin-bottom:.35rem;">
                                <i class="fas fa-info-circle" style="color:var(--bc-navy);"></i> Current Status
                            </div>
                            <div style="font-size:.75rem;color:var(--bc-muted);">
                                @if($communication_channel === 'email')
                                    Members will receive communications via <strong>email</strong>. Ensure members have valid email addresses.
                                @elseif($communication_channel === 'sms')
                                    Members will receive communications via <strong>SMS</strong>. Ensure members have valid mobile numbers.
                                @elseif($communication_channel === 'both')
                                    Both <strong>email</strong> and <strong>SMS</strong> channels are available. The sender can choose per message.
                                @else
                                    Communications are <strong>disabled</strong> for this village bank. Members will not receive any messages.
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Save button --}}
                <div style="margin-top:1.25rem;display:flex;justify-content:flex-end;">
                    <button type="submit" class="bc-btn bc-btn-primary" wire:loading.attr="disabled" wire:target="saveConfiguration">
                        <span wire:loading.remove wire:target="saveConfiguration"><i class="fas fa-save"></i> Save Communication Settings</span>
                        <span wire:loading wire:target="saveConfiguration"><i class="fas fa-spinner fa-spin"></i> Saving...</span>
                    </button>
                </div>
            </form>
            @endif

            @if($showAccountModal)
            <div class="bc-overlay" wire:click.self="$set('showAccountModal', false)">
                <div class="bc-modal">
                    <div class="bc-modal-head">
                        <h3 class="bc-card-title">
                            <i class="fas fa-wallet"></i>
                            {{ $editAccountIndex !== null ? 'Edit Account' : 'Add Account' }}
                        </h3>
                        <button type="button" class="bc-close" wire:click="$set('showAccountModal', false)">&times;</button>
                    </div>
                    <div class="bc-modal-body">
                        <div class="bc-row bc-row-2">
                            <div>
                                <label class="bc-label">Account Type</label>
                                <select wire:model.live="accountForm.account_type" class="bc-input">
                                    <option value="mobile_money">Mobile Money</option>
                                    <option value="bank_account">Bank Account</option>
                                </select>
                            </div>
                            <div>
                                <label class="bc-label">Provider / Bank Name <span style="color:var(--bc-red);">*</span></label>
                                <input type="text" wire:model="accountForm.provider_name"
                                       class="bc-input @error('accountForm.provider_name') bc-input-error @enderror"
                                       placeholder="{{ $accountForm['account_type'] === 'mobile_money' ? 'e.g. Airtel Money, MTN MoMo' : 'e.g. FNB, Zanaco' }}">
                                @error('accountForm.provider_name') <div class="bc-error">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="bc-row bc-row-2">
                            <div>
                                <label class="bc-label">Account Name <span style="color:var(--bc-red);">*</span></label>
                                <input type="text" wire:model="accountForm.account_name"
                                       class="bc-input @error('accountForm.account_name') bc-input-error @enderror"
                                       placeholder="Name on the account">
                                @error('accountForm.account_name') <div class="bc-error">{{ $message }}</div> @enderror
                            </div>
                            <div>
                                <label class="bc-label">Account / Phone Number <span style="color:var(--bc-red);">*</span></label>
                                <input type="text" wire:model="accountForm.account_number"
                                       class="bc-input @error('accountForm.account_number') bc-input-error @enderror"
                                       placeholder="{{ $accountForm['account_type'] === 'mobile_money' ? 'e.g. 0977123456' : 'e.g. 0012345678' }}">
                                @error('accountForm.account_number') <div class="bc-error">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        @if($accountForm['account_type'] === 'bank_account')
                        <div class="bc-row">
                            <div>
                                <label class="bc-label">Branch</label>
                                <input type="text" wire:model="accountForm.branch"
                                       class="bc-input" placeholder="e.g. Cairo Road Branch">
                            </div>
                        </div>
                        @endif
                        <div style="display:flex;gap:1.5rem;margin-top:.5rem;">
                            <div style="display:flex;align-items:center;gap:.5rem;">
                                <input type="checkbox" wire:model="accountForm.is_primary" id="acct_primary" style="accent-color:var(--bc-amber);">
                                <label for="acct_primary" style="font-size:.82rem;font-weight:600;color:var(--bc-text);cursor:pointer;">Set as Primary</label>
                            </div>
                            <div style="display:flex;align-items:center;gap:.5rem;">
                                <input type="checkbox" wire:model="accountForm.is_active" id="acct_active" style="accent-color:var(--bc-green);">
                                <label for="acct_active" style="font-size:.82rem;font-weight:600;color:var(--bc-text);cursor:pointer;">Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="bc-modal-foot">
                        <button type="button" class="bc-btn bc-btn-ghost" wire:click="$set('showAccountModal', false)">Cancel</button>
                        <button type="button" class="bc-btn bc-btn-primary" wire:click="saveAccount"
                                wire:loading.attr="disabled" wire:target="saveAccount">
                            <span wire:loading.remove wire:target="saveAccount"><i class="fas fa-check"></i> {{ $editAccountIndex !== null ? 'Update' : 'Add' }} Account</span>
                            <span wire:loading wire:target="saveAccount"><i class="fas fa-spinner fa-spin"></i> Saving...</span>
                        </button>
                    </div>
                </div>
            </div>
            @endif
            @endif

            {{-- ═══════════════════════════════════════
                 TAB 5: GOVERNANCE
                 ═══════════════════════════════════════ --}}
            @if($activeTab === 'governance')
            <form wire:submit.prevent="saveConstitution">
                <div style="display:flex;flex-direction:column;gap:1.25rem;">

                    {{-- ── Enforcement Settings ── --}}
                    <div class="bc-card">
                        <div class="bc-card-head">
                            <div style="display:flex;align-items:center;gap:.45rem;">
                                <div class="bc-section-icon" style="background:linear-gradient(135deg,#7c3aed,#a78bfa);"><i class="fas fa-shield-alt"></i></div>
                                <h3 class="bc-card-title">Compliance & Enforcement</h3>
                            </div>
                        </div>
                        <div class="bc-card-body">
                            <p style="font-size:.78rem;color:var(--bc-muted);margin:0 0 1.25rem;line-height:1.5;">
                                Configure which compliance requirements must be met before members can request loans or make share declarations.
                                When enabled, members who haven't read and acknowledged the required documents will be blocked from performing these activities.
                            </p>

                            <div style="display:grid;gap:1rem;">
                                {{-- Require Rules --}}
                                <div style="display:flex;align-items:flex-start;gap:.85rem;padding:1rem;border:2px solid {{ $require_rules_before_activity ? 'var(--bc-navy)' : '#e2e8f0' }};border-radius:.5rem;background:{{ $require_rules_before_activity ? '#f0f4ff' : '#fff' }};transition:all .2s;">
                                    <button type="button"
                                        class="bc-toggle {{ $require_rules_before_activity ? 'active' : '' }}"
                                        wire:click="$toggle('require_rules_before_activity')"
                                        style="margin-top:.1rem;"></button>
                                    <div>
                                        <div style="font-weight:700;font-size:.88rem;color:var(--bc-text);display:flex;align-items:center;gap:.35rem;">
                                            <i class="fas fa-scroll" style="color:#d97706;"></i> Require Rules Acknowledgement
                                        </div>
                                        <div style="font-size:.75rem;color:var(--bc-muted);margin-top:.25rem;line-height:1.5;">
                                            Members must read and agree to <strong>all active village bank rules</strong> before they can request loans or make share declarations.
                                            Their acknowledgement status is tracked and visible in the member list.
                                        </div>
                                    </div>
                                </div>

                                {{-- Enable Constitution --}}
                                <div style="display:flex;align-items:flex-start;gap:.85rem;padding:1rem;border:2px solid {{ $constitution_enabled ? 'var(--bc-navy)' : '#e2e8f0' }};border-radius:.5rem;background:{{ $constitution_enabled ? '#f0f4ff' : '#fff' }};transition:all .2s;">
                                    <button type="button"
                                        class="bc-toggle {{ $constitution_enabled ? 'active' : '' }}"
                                        wire:click="$toggle('constitution_enabled')"
                                        style="margin-top:.1rem;"></button>
                                    <div>
                                        <div style="font-weight:700;font-size:.88rem;color:var(--bc-text);display:flex;align-items:center;gap:.35rem;">
                                            <i class="fas fa-file-contract" style="color:#7c3aed;"></i> Enable Constitution
                                        </div>
                                        <div style="font-size:.75rem;color:var(--bc-muted);margin-top:.25rem;line-height:1.5;">
                                            Upload or write a constitution (terms & conditions) for your village bank. This acts as a binding agreement all members must sign.
                                        </div>
                                    </div>
                                </div>

                                {{-- Require Constitution Before Activity --}}
                                @if($constitution_enabled)
                                <div style="display:flex;align-items:flex-start;gap:.85rem;padding:1rem;border:2px solid {{ $require_constitution_before_activity ? '#7c3aed' : '#e2e8f0' }};border-radius:.5rem;background:{{ $require_constitution_before_activity ? '#f5f3ff' : '#fff' }};transition:all .2s;margin-left:1.5rem;">
                                    <button type="button"
                                        class="bc-toggle {{ $require_constitution_before_activity ? 'active' : '' }}"
                                        wire:click="$toggle('require_constitution_before_activity')"
                                        style="margin-top:.1rem;"></button>
                                    <div>
                                        <div style="font-weight:700;font-size:.88rem;color:var(--bc-text);display:flex;align-items:center;gap:.35rem;">
                                            <i class="fas fa-lock" style="color:#ef4444;"></i> Enforce Constitution Before Activity
                                        </div>
                                        <div style="font-size:.75rem;color:var(--bc-muted);margin-top:.25rem;line-height:1.5;">
                                            Members <strong>must</strong> read and sign the constitution before requesting loans or making share declarations.
                                            If disabled, the constitution will still be available for members to read, but won't block activities.
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- ── Constitution Content ── --}}
                    @if($constitution_enabled)
                    <div class="bc-card">
                        <div class="bc-card-head">
                            <div style="display:flex;align-items:center;gap:.45rem;">
                                <div class="bc-section-icon" style="background:linear-gradient(135deg,#059669,#10b981);"><i class="fas fa-file-contract"></i></div>
                                <h3 class="bc-card-title">Constitution Document</h3>
                            </div>
                            @if($existing_constitution)
                                <div style="margin-left:auto;display:flex;align-items:center;gap:.5rem;">
                                    <span style="font-size:.72rem;color:var(--bc-muted);">
                                        Version {{ $existing_constitution->version }}
                                        &bull; {{ $existing_constitution->acknowledgementRate() }}% signed
                                        &bull; {{ $existing_constitution->pendingCount() }} pending
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="bc-card-body">
                            {{-- Title --}}
                            <div class="bc-row" style="margin-bottom:1rem;">
                                <div>
                                    <label class="bc-label">Constitution Title</label>
                                    <input type="text" wire:model="constitution_title"
                                           class="bc-input @error('constitution_title') bc-input-error @enderror"
                                           placeholder="e.g. Village Bank Constitution">
                                    @error('constitution_title') <div class="bc-error">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            {{-- Content Type Selector --}}
                            <div style="margin-bottom:1rem;">
                                <label class="bc-label">Content Type</label>
                                <div style="display:flex;gap:1rem;margin-top:.3rem;">
                                    <label style="display:flex;align-items:center;gap:.4rem;padding:.5rem 1rem;border:2px solid {{ $constitution_content_type === 'text' ? 'var(--bc-navy)' : '#e2e8f0' }};border-radius:8px;cursor:pointer;background:{{ $constitution_content_type === 'text' ? '#f0f4ff' : '#fff' }};font-size:.84rem;font-weight:600;transition:all .2s;">
                                        <input type="radio" wire:model.live="constitution_content_type" value="text" style="accent-color:var(--bc-navy);">
                                        <i class="fas fa-pen-fancy" style="color:#059669;"></i> Write Text
                                    </label>
                                    <label style="display:flex;align-items:center;gap:.4rem;padding:.5rem 1rem;border:2px solid {{ $constitution_content_type === 'file' ? 'var(--bc-navy)' : '#e2e8f0' }};border-radius:8px;cursor:pointer;background:{{ $constitution_content_type === 'file' ? '#f0f4ff' : '#fff' }};font-size:.84rem;font-weight:600;transition:all .2s;">
                                        <input type="radio" wire:model.live="constitution_content_type" value="file" style="accent-color:var(--bc-navy);">
                                        <i class="fas fa-file-pdf" style="color:#dc2626;"></i> Upload PDF
                                    </label>
                                </div>
                            </div>

                            {{-- Text Input --}}
                            @if($constitution_content_type === 'text')
                                <div>
                                    <label class="bc-label">Constitution Text</label>
                                    <textarea wire:model="constitution_body"
                                              class="bc-input @error('constitution_body') bc-input-error @enderror"
                                              rows="12"
                                              placeholder="Enter the full constitution / terms & conditions for your village bank..."
                                              style="resize:vertical;min-height:200px;font-size:.85rem;line-height:1.6;"></textarea>
                                    @error('constitution_body') <div class="bc-error">{{ $message }}</div> @enderror
                                    <div class="bc-hint">Write the full text of your village bank's constitution. Members will see this and must agree to it.</div>
                                </div>
                            @endif

                            {{-- File Upload --}}
                            @if($constitution_content_type === 'file')
                                <div>
                                    <label class="bc-label">Constitution PDF</label>
                                    @if($existing_constitution && $existing_constitution->file_path)
                                        <div style="display:flex;align-items:center;gap:.75rem;padding:.75rem 1rem;background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;margin-bottom:.75rem;">
                                            <i class="fas fa-file-pdf" style="font-size:1.5rem;color:#dc2626;"></i>
                                            <div style="flex:1;">
                                                <div style="font-size:.85rem;font-weight:600;color:var(--bc-text);">{{ $existing_constitution->file_name }}</div>
                                                <div style="font-size:.72rem;color:var(--bc-muted);">Current file &bull; Version {{ $existing_constitution->version }}</div>
                                            </div>
                                            <a href="{{ asset('storage/' . $existing_constitution->file_path) }}" target="_blank"
                                               style="font-size:.78rem;color:var(--bc-navy);font-weight:600;text-decoration:none;">
                                                <i class="fas fa-external-link-alt"></i> View
                                            </a>
                                        </div>
                                    @endif
                                    <input type="file" wire:model="constitution_file"
                                           class="bc-input @error('constitution_file') bc-input-error @enderror"
                                           accept=".pdf"
                                           style="padding:.45rem .75rem;">
                                    @error('constitution_file') <div class="bc-error">{{ $message }}</div> @enderror
                                    <div class="bc-hint">Upload a PDF file (max 10 MB). {{ $existing_constitution?->file_path ? 'Uploading a new file will replace the current one.' : '' }}</div>
                                    <div wire:loading wire:target="constitution_file" style="color:var(--bc-navy);font-size:.8rem;margin-top:.3rem;">
                                        <i class="fas fa-spinner fa-spin"></i> Uploading...
                                    </div>
                                </div>
                            @endif

                            {{-- Version bump notice --}}
                            @if($existing_constitution)
                                <div style="margin-top:1rem;padding:.75rem 1rem;background:#fffbeb;border:1px solid #fde68a;border-radius:8px;">
                                    <div style="font-size:.78rem;color:#92400e;font-weight:600;">
                                        <i class="fas fa-info-circle"></i> Version Notice
                                    </div>
                                    <div style="font-size:.75rem;color:#a16207;margin-top:.25rem;line-height:1.5;">
                                        If you change the constitution content, the version will be bumped from <strong>v{{ $existing_constitution->version }}</strong> to <strong>v{{ $existing_constitution->version + 1 }}</strong>.
                                        Members who previously signed will need to re-acknowledge the updated version.
                                    </div>
                                </div>
                            @endif

                            {{-- Delete constitution --}}
                            @if($existing_constitution)
                                <div style="margin-top:1rem;padding:.75rem 1rem;background:#fef2f2;border:1px solid #fecaca;border-radius:8px;display:flex;align-items:center;justify-content:space-between;">
                                    <div>
                                        <div style="font-size:.78rem;color:#991b1b;font-weight:600;"><i class="fas fa-trash-alt"></i> Remove Constitution</div>
                                        <div style="font-size:.72rem;color:#b91c1c;margin-top:.15rem;">This will delete the constitution and all acknowledgement records.</div>
                                    </div>
                                    <button type="button" wire:click="deleteConstitution"
                                            wire:confirm="Are you sure? This will permanently remove the constitution and all member signatures."
                                            class="bc-btn" style="background:#fee2e2;color:#dc2626;font-size:.78rem;">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    {{-- ── Compliance Status Summary ── --}}
                    <div class="bc-card">
                        <div class="bc-card-head">
                            <div style="display:flex;align-items:center;gap:.45rem;">
                                <div class="bc-section-icon" style="background:linear-gradient(135deg,#0369a1,#38bdf8);"><i class="fas fa-clipboard-check"></i></div>
                                <h3 class="bc-card-title">Current Enforcement Summary</h3>
                            </div>
                        </div>
                        <div class="bc-card-body">
                            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                                <div style="padding:.85rem;background:#f8fafc;border-radius:8px;border:1px solid #e2e8f0;">
                                    <div style="font-size:.72rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--bc-faint);">
                                        Rules Enforcement
                                    </div>
                                    <div style="font-size:1rem;font-weight:800;color:{{ $require_rules_before_activity ? 'var(--bc-green)' : 'var(--bc-faint)' }};margin-top:.25rem;">
                                        <i class="fas fa-{{ $require_rules_before_activity ? 'check-circle' : 'minus-circle' }}"></i>
                                        {{ $require_rules_before_activity ? 'Active' : 'Inactive' }}
                                    </div>
                                    <div style="font-size:.72rem;color:var(--bc-muted);margin-top:.2rem;">
                                        {{ $require_rules_before_activity ? 'Members must acknowledge all rules' : 'Rules are optional to read' }}
                                    </div>
                                </div>
                                <div style="padding:.85rem;background:#f8fafc;border-radius:8px;border:1px solid #e2e8f0;">
                                    <div style="font-size:.72rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--bc-faint);">
                                        Constitution Enforcement
                                    </div>
                                    <div style="font-size:1rem;font-weight:800;color:{{ ($constitution_enabled && $require_constitution_before_activity) ? 'var(--bc-green)' : 'var(--bc-faint)' }};margin-top:.25rem;">
                                        <i class="fas fa-{{ ($constitution_enabled && $require_constitution_before_activity) ? 'check-circle' : 'minus-circle' }}"></i>
                                        {{ ($constitution_enabled && $require_constitution_before_activity) ? 'Active' : ($constitution_enabled ? 'Optional' : 'Disabled') }}
                                    </div>
                                    <div style="font-size:.72rem;color:var(--bc-muted);margin-top:.2rem;">
                                        @if($constitution_enabled && $require_constitution_before_activity)
                                            Members must sign the constitution
                                        @elseif($constitution_enabled)
                                            Constitution available but not mandatory
                                        @else
                                            Constitution feature is disabled
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if($require_rules_before_activity || ($constitution_enabled && $require_constitution_before_activity))
                                <div style="margin-top:1rem;padding:.75rem 1rem;background:#f0fdf4;border:1px solid #bbf7d0;border-radius:8px;">
                                    <div style="font-size:.78rem;color:#166534;font-weight:600;">
                                        <i class="fas fa-shield-alt"></i> Active Restrictions
                                    </div>
                                    <div style="font-size:.75rem;color:#15803d;margin-top:.25rem;line-height:1.5;">
                                        Members who have not met the requirements above will be <strong>blocked</strong> from:
                                        <ul style="margin:.35rem 0 0 1.25rem;padding:0;">
                                            <li>Requesting loans</li>
                                            <li>Making share declarations</li>
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Save button --}}
                <div style="margin-top:1.25rem;display:flex;justify-content:flex-end;">
                    <button type="submit" class="bc-btn bc-btn-primary" wire:loading.attr="disabled" wire:target="saveConstitution">
                        <span wire:loading.remove wire:target="saveConstitution"><i class="fas fa-save"></i> Save Governance Settings</span>
                        <span wire:loading wire:target="saveConstitution"><i class="fas fa-spinner fa-spin"></i> Saving...</span>
                    </button>
                </div>
            </form>
            @endif

            @else
                <div class="bc-card">
                    <div class="bc-card-body" style="text-align:center;padding:3rem;">
                        <i class="fas fa-university" style="font-size:2.5rem;color:var(--bc-faint);margin-bottom:1rem;"></i>
                        <p style="font-size:.9rem;color:var(--bc-muted);margin:0;">Please select a village bank to manage its configuration.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
