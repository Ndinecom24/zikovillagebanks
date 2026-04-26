<div>
    @push('custom-styles')
    <style>
        :root {
            --sf-navy:#1E3A5F;--sf-navy-light:#2B6B96;--sf-amber:#D97706;--sf-amber-light:#F59E0B;
            --sf-bg:#f4f6fa;--sf-card:#fff;--sf-border:#edf0f7;--sf-text:#1e293b;
            --sf-muted:#64748b;--sf-faint:#94a3b8;--sf-green:#16a34a;--sf-red:#dc2626;--sf-blue:#2563eb;--sf-purple:#7c3aed;--sf-radius:16px;
        }
        .sf-page{background:var(--sf-bg);min-height:100vh;}

        /* ── Hero ─────────────────── */
        .sf-hero{background:linear-gradient(135deg,var(--sf-navy) 0%,#234b78 50%,var(--sf-navy-light) 100%);padding:1.75rem 0 6rem;position:relative;overflow:hidden;}
        .sf-hero::before{content:'';position:absolute;width:600px;height:600px;top:-60%;right:-8%;background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%);border-radius:50%;pointer-events:none;}
        .sf-hero-inner{position:relative;z-index:2;padding:0 1.5rem;}
        .sf-breadcrumb{display:flex;gap:.5rem;list-style:none;padding:0;margin:0 0 .75rem;font-size:.82rem;}
        .sf-breadcrumb a{color:rgba(255,255,255,.55);text-decoration:none;}
        .sf-breadcrumb a:hover{color:rgba(255,255,255,.85);}
        .sf-breadcrumb .active{color:var(--sf-amber-light);font-weight:600;}
        .sf-breadcrumb .sep{color:rgba(255,255,255,.25);}
        .sf-hero-row{display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:.75rem;}
        .sf-hero-title h1{color:#fff;font-size:1.6rem;font-weight:800;margin:0;}
        .sf-hero-title h1 i{color:var(--sf-amber);margin-right:.5rem;}
        .sf-hero-sub{color:rgba(255,255,255,.55);font-size:.88rem;margin:.25rem 0 0;}

        /* ── Content ──────────────── */
        .sf-content{margin-top:-4rem;position:relative;z-index:10;padding:0 1.5rem 2rem;}
        .sf-grid{display:grid;grid-template-columns:1fr 340px;gap:1.25rem;}
        @media(max-width:992px){.sf-grid{grid-template-columns:1fr;}}

        /* ── Card ─────────────────── */
        .sf-card{background:var(--sf-card);border-radius:var(--sf-radius);border:1px solid var(--sf-border);box-shadow:0 2px 12px rgba(0,0,0,.04);overflow:hidden;}
        .sf-card-header{padding:1rem 1.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.5rem;border-bottom:1px solid var(--sf-border);}
        .sf-card-title{font-size:.92rem;font-weight:700;color:var(--sf-text);display:flex;align-items:center;gap:.4rem;}
        .sf-card-title i{color:var(--sf-amber);font-size:.78rem;}
        .sf-card-body{padding:1.25rem 1.5rem;}

        /* ── Alerts ───────────────── */
        .sf-alert{padding:.7rem 1rem;border-radius:12px;font-size:.84rem;display:flex;align-items:center;gap:.5rem;margin-bottom:1rem;}
        .sf-alert-success{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;}
        .sf-alert-warning{background:#fffbeb;color:#92400e;border:1px solid #fde68a;}
        .sf-alert-info{background:#eff6ff;color:#1e40af;border:1px solid #bfdbfe;}

        /* ── Form ─────────────────── */
        .sf-label{display:block;font-size:.7rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--sf-faint);margin-bottom:.35rem;}
        .sf-select,.sf-input,.sf-textarea{width:100%;padding:.55rem .85rem;border:1px solid var(--sf-border);border-radius:10px;font-size:.85rem;background:#fafbfd;transition:border .2s;}
        .sf-select{cursor:pointer;-webkit-appearance:none;appearance:none;background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2394a3b8' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");background-repeat:no-repeat;background-position:right .65rem center;background-size:.65rem;padding-right:2rem;}
        .sf-select:focus,.sf-input:focus,.sf-textarea:focus{outline:none;border-color:var(--sf-amber);background-color:#fff;box-shadow:0 0 0 3px rgba(217,119,6,.08);}
        .sf-textarea{resize:vertical;min-height:60px;}
        .sf-form-grid{display:grid;grid-template-columns:1fr 1fr;gap:.85rem;}
        @media(max-width:768px){.sf-form-grid{grid-template-columns:1fr;}}
        .sf-form-full{grid-column:1/-1;}
        .sf-error{font-size:.72rem;color:var(--sf-red);margin-top:.25rem;}

        .sf-btn{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1.25rem;border-radius:10px;font-size:.82rem;font-weight:700;border:none;cursor:pointer;transition:all .2s;text-decoration:none;}
        .sf-btn-primary{background:var(--sf-amber);color:#fff;}
        .sf-btn-primary:hover{background:var(--sf-amber-light);transform:translateY(-1px);box-shadow:0 4px 14px rgba(217,119,6,.2);}
        .sf-btn-green{background:var(--sf-green);color:#fff;}
        .sf-btn-green:hover{background:#15803d;transform:translateY(-1px);box-shadow:0 4px 14px rgba(22,163,74,.2);}
        .sf-btn-outline{background:transparent;color:var(--sf-muted);border:1px solid var(--sf-border);}
        .sf-btn-outline:hover{background:#fafbfd;color:var(--sf-text);}
        .sf-btn-danger{background:var(--sf-red);color:#fff;}
        .sf-btn-danger:hover{background:#b91c1c;}
        .sf-btn-sm{padding:.35rem .75rem;font-size:.72rem;border-radius:8px;}

        /* ── Pool stats ───────────── */
        .sf-pool{display:grid;grid-template-columns:repeat(3,1fr);gap:.75rem;margin-bottom:1.25rem;}
        @media(max-width:768px){.sf-pool{grid-template-columns:1fr;}}
        .sf-pool-item{background:var(--sf-card);border-radius:var(--sf-radius);border:1px solid var(--sf-border);box-shadow:0 2px 12px rgba(0,0,0,.04);padding:1rem 1.1rem;display:flex;align-items:center;justify-content:space-between;transition:all .2s;}
        .sf-pool-item:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(0,0,0,.06);}
        .sf-pool-label{font-size:.6rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--sf-faint);}
        .sf-pool-value{font-size:1.35rem;font-weight:800;color:var(--sf-text);margin-top:.05rem;}
        .sf-pool-icon{width:42px;height:42px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:.95rem;flex-shrink:0;}

        /* ── Balance bar ──────────── */
        .sf-balance-bar{height:10px;border-radius:10px;background:var(--sf-border);overflow:hidden;margin-top:.35rem;}
        .sf-balance-fill{height:100%;border-radius:10px;transition:width .5s;}
        .sf-balance-used{background:var(--sf-amber);}
        .sf-balance-remaining{background:var(--sf-green);}

        /* ── Table ────────────────── */
        .sf-table{width:100%;border-collapse:collapse;}
        .sf-table thead th{font-size:.62rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--sf-faint);padding:.7rem 1rem;border-bottom:1px solid var(--sf-border);background:#fafbfd;white-space:nowrap;}
        .sf-table tbody td{padding:.7rem 1rem;border-bottom:1px solid #f5f7fa;font-size:.84rem;vertical-align:middle;}
        .sf-table tbody tr:last-child td{border-bottom:none;}
        .sf-table tbody tr:hover{background:#fafbfd;}
        .sf-table tfoot td{padding:.7rem 1rem;font-weight:800;background:#fafbfd;border-top:2px solid var(--sf-border);font-size:.84rem;}

        /* ── Badge ────────────────── */
        .sf-badge{padding:.2rem .55rem;border-radius:6px;font-size:.68rem;font-weight:700;display:inline-flex;align-items:center;gap:.2rem;}
        .sf-badge-shareout{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;}
        .sf-badge-donation{background:#eff6ff;color:#1e40af;border:1px solid #bfdbfe;}
        .sf-badge-payment{background:#fffbeb;color:#92400e;border:1px solid #fde68a;}
        .sf-badge-other{background:#f1f5f9;color:#475569;border:1px solid #e2e8f0;}
        .sf-status-active{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;}
        .sf-status-depleted{background:#fef2f2;color:#991b1b;border:1px solid #fecaca;}
        .sf-status-closed{background:#f1f5f9;color:#475569;border:1px solid #e2e8f0;}

        /* ── Sidebar ──────────────── */
        .sf-sidebar{display:flex;flex-direction:column;gap:1.25rem;}
        .sf-info-row{display:flex;justify-content:space-between;padding:.45rem 0;border-bottom:1px solid #f5f7fa;font-size:.82rem;}
        .sf-info-row:last-child{border-bottom:none;}
        .sf-info-label{color:var(--sf-faint);font-weight:600;}
        .sf-info-value{color:var(--sf-text);font-weight:700;}

        /* ── Empty ────────────────── */
        .sf-empty{text-align:center;padding:2.5rem 1rem;}
        .sf-empty i{font-size:2rem;opacity:.12;display:block;margin-bottom:.5rem;color:var(--sf-navy);}
        .sf-empty p{font-size:.84rem;color:var(--sf-muted);margin:0;}

        @keyframes sfSlide{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
        .sf-animate{animation:sfSlide .3s ease;}
        @media(max-width:768px){.sf-content{padding:0 .75rem 1.5rem;}}
    </style>
    @endpush

    @can('view-shareout')
    <div class="sf-page">
        {{-- ██ HERO ██ --}}
        <div class="sf-hero">
            <div class="sf-hero-inner">
                <ul class="sf-breadcrumb">
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('shareout.index') }}">Shareout</a></li>
                    <li class="sep">/</li>
                    <li class="active">Social Fund</li>
                </ul>
                <div class="sf-hero-row">
                    <div class="sf-hero-title">
                        <h1><i class="fas fa-hand-holding-heart"></i> Social Fund</h1>
                        <p class="sf-hero-sub">Manage excess money from insurance profits and penalties</p>
                    </div>
                    <a href="{{ route('shareout.index') }}" class="sf-btn sf-btn-outline" style="color:rgba(255,255,255,.7);border-color:rgba(255,255,255,.2);">
                        <i class="fas fa-arrow-left"></i> Back to Shareout
                    </a>
                </div>
            </div>
        </div>

        {{-- ██ CONTENT ██ --}}
        <div class="sf-content">
            {{-- Success message --}}
            @if ($successMessage)
                <div class="sf-alert sf-alert-success sf-animate">
                    <i class="fas fa-check-circle"></i> {{ $successMessage }}
                </div>
            @endif

            {{-- Fund selector --}}
            <div class="sf-card sf-animate" style="margin-bottom:1.25rem;">
                <div class="sf-card-body">
                    <div style="display:grid;grid-template-columns:1fr auto;gap:.85rem;align-items:end;">
                        <div>
                            <label class="sf-label">Select Social Fund</label>
                            <select wire:model.live="socialFundId" class="sf-select">
                                <option value="">— Choose a social fund —</option>
                                @foreach ($this->socialFunds as $sf)
                                    <option value="{{ $sf->id }}">
                                        {{ $sf->circle->name ?? 'Circle' }}
                                        ({{ $sf->circle->villageBank->name ?? '' }})
                                        — K{{ number_format($sf->total_fund, 2) }}
                                        @if($sf->status === 'depleted') [DEPLETED] @endif
                                        @if($sf->status === 'closed') [CLOSED] @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @if ($this->socialFunds->isEmpty())
                        <div class="sf-alert sf-alert-info" style="margin-top:.75rem;margin-bottom:0;">
                            <i class="fas fa-info-circle"></i>
                            No social funds found. Social funds are created automatically when a shareout is finalised for a village bank
                            whose configuration has "Insurance Profit to Members" turned off.
                        </div>
                    @endif
                </div>
            </div>

            @if ($fund)
                {{-- Fund summary cards --}}
                <div class="sf-pool sf-animate">
                    <div class="sf-pool-item">
                        <div>
                            <div class="sf-pool-label">Total Fund</div>
                            <div class="sf-pool-value" style="color:var(--sf-amber);">K{{ number_format($fund['total_fund'], 2) }}</div>
                        </div>
                        <div class="sf-pool-icon" style="background:rgba(217,119,6,.08);color:var(--sf-amber);"><i class="fas fa-coins"></i></div>
                    </div>
                    <div class="sf-pool-item">
                        <div>
                            <div class="sf-pool-label">Total Used</div>
                            <div class="sf-pool-value" style="color:var(--sf-red);">K{{ number_format($fund['total_used'], 2) }}</div>
                        </div>
                        <div class="sf-pool-icon" style="background:rgba(220,38,38,.08);color:var(--sf-red);"><i class="fas fa-receipt"></i></div>
                    </div>
                    <div class="sf-pool-item">
                        <div>
                            <div class="sf-pool-label">Remaining</div>
                            <div class="sf-pool-value" style="color:var(--sf-green);">K{{ number_format($fund['total_remaining'], 2) }}</div>
                        </div>
                        <div class="sf-pool-icon" style="background:rgba(22,163,74,.08);color:var(--sf-green);"><i class="fas fa-wallet"></i></div>
                    </div>
                </div>

                {{-- Balance progress bar --}}
                @php
                    $usedPct = $fund['total_fund'] > 0 ? round(($fund['total_used'] / $fund['total_fund']) * 100, 1) : 0;
                    $remainPct = 100 - $usedPct;
                @endphp
                <div class="sf-card sf-animate" style="margin-bottom:1.25rem;">
                    <div class="sf-card-body" style="padding:.85rem 1.25rem;">
                        <div style="display:flex;justify-content:space-between;font-size:.72rem;font-weight:700;margin-bottom:.35rem;">
                            <span style="color:var(--sf-amber);">Used: {{ $usedPct }}%</span>
                            <span style="color:var(--sf-green);">Remaining: {{ $remainPct }}%</span>
                        </div>
                        <div class="sf-balance-bar">
                            <div class="sf-balance-fill sf-balance-used" style="width:{{ $usedPct }}%;"></div>
                        </div>
                    </div>
                </div>

                <div class="sf-grid">
                    {{-- ██ LEFT — Main area ██ --}}
                    <div>
                        {{-- Add usage form --}}
                        @if ($showAddForm && $fund['status'] === 'active')
                            <div class="sf-card sf-animate" style="margin-bottom:1.25rem;border-left:4px solid var(--sf-amber);">
                                <div class="sf-card-header">
                                    <div class="sf-card-title">
                                        <i class="fas fa-plus-circle"></i>
                                        {{ $editingUsageId ? 'Edit Usage Record' : 'Record New Usage' }}
                                    </div>
                                    <button wire:click="cancelForm" class="sf-btn sf-btn-outline sf-btn-sm">
                                        <i class="fas fa-times"></i> Cancel
                                    </button>
                                </div>
                                <div class="sf-card-body">
                                    <div class="sf-form-grid">
                                        <div>
                                            <label class="sf-label">Usage Type</label>
                                            <select wire:model.live="usageType" class="sf-select">
                                                <option value="shareout">Share Out (distribute to members)</option>
                                                <option value="donation">Donation (give to person/cause)</option>
                                                <option value="payment">Payment (for items/services)</option>
                                                <option value="other">Other</option>
                                            </select>
                                            @error('usageType') <div class="sf-error">{{ $message }}</div> @enderror
                                        </div>
                                        <div>
                                            <label class="sf-label">Amount (K)</label>
                                            <input type="number" wire:model="usageAmount" class="sf-input" step="0.01" min="0.01" max="{{ $fund['total_remaining'] + ($editingUsageId ? collect($usages)->firstWhere('id', $editingUsageId)['amount'] ?? 0 : 0) }}" placeholder="0.00">
                                            @error('usageAmount') <div class="sf-error">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="sf-form-full">
                                            <label class="sf-label">Description</label>
                                            <input type="text" wire:model="usageDescription" class="sf-input" placeholder="Brief description of what the fund was used for">
                                            @error('usageDescription') <div class="sf-error">{{ $message }}</div> @enderror
                                        </div>
                                        <div>
                                            <label class="sf-label">Recipient / Payee</label>
                                            <input type="text" wire:model="usageRecipient" class="sf-input" placeholder="Name of person or organisation">
                                        </div>
                                        <div>
                                            <label class="sf-label">Date</label>
                                            <input type="date" wire:model="usageDate" class="sf-input">
                                            @error('usageDate') <div class="sf-error">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="sf-form-full">
                                            <label class="sf-label">Notes (optional)</label>
                                            <textarea wire:model="usageNotes" class="sf-textarea" rows="2" placeholder="Any additional details…"></textarea>
                                        </div>
                                    </div>
                                    <div style="display:flex;justify-content:flex-end;gap:.5rem;margin-top:1rem;">
                                        <button wire:click="cancelForm" class="sf-btn sf-btn-outline">Cancel</button>
                                        <button wire:click="saveUsage" class="sf-btn sf-btn-green" wire:loading.attr="disabled" wire:target="saveUsage">
                                            <span wire:loading.remove wire:target="saveUsage">
                                                <i class="fas fa-save"></i> {{ $editingUsageId ? 'Update' : 'Save' }} Usage
                                            </span>
                                            <span wire:loading wire:target="saveUsage"><i class="fas fa-spinner fa-spin"></i> Saving…</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Usage records table --}}
                        <div class="sf-card sf-animate">
                            <div class="sf-card-header">
                                <div class="sf-card-title"><i class="fas fa-list-alt"></i> Usage Records ({{ count($usages) }})</div>
                                @if (!$showAddForm && $fund['status'] === 'active' && $fund['total_remaining'] > 0)
                                    <button wire:click="openAddForm" class="sf-btn sf-btn-primary sf-btn-sm">
                                        <i class="fas fa-plus"></i> Record Usage
                                    </button>
                                @endif
                            </div>
                            <div style="overflow-x:auto;">
                                <table class="sf-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Description</th>
                                            <th>Recipient</th>
                                            <th>Amount</th>
                                            <th>Recorded By</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($usages as $i => $usage)
                                            <tr>
                                                <td style="color:var(--sf-faint);font-size:.78rem;">{{ $i + 1 }}</td>
                                                <td style="white-space:nowrap;">{{ \Carbon\Carbon::parse($usage['usage_date'])->format('d M Y') }}</td>
                                                <td>
                                                    @php
                                                        $typeClass = match($usage['type']) {
                                                            'shareout' => 'sf-badge-shareout',
                                                            'donation' => 'sf-badge-donation',
                                                            'payment'  => 'sf-badge-payment',
                                                            default    => 'sf-badge-other',
                                                        };
                                                        $typeLabel = match($usage['type']) {
                                                            'shareout' => 'Share Out',
                                                            'donation' => 'Donation',
                                                            'payment'  => 'Payment',
                                                            default    => 'Other',
                                                        };
                                                    @endphp
                                                    <span class="sf-badge {{ $typeClass }}">{{ $typeLabel }}</span>
                                                </td>
                                                <td>
                                                    <div style="font-weight:600;">{{ $usage['description'] }}</div>
                                                    @if (!empty($usage['notes']))
                                                        <div style="font-size:.72rem;color:var(--sf-faint);margin-top:.15rem;">{{ Str::limit($usage['notes'], 60) }}</div>
                                                    @endif
                                                </td>
                                                <td>{{ $usage['recipient'] ?? '—' }}</td>
                                                <td style="font-weight:800;color:var(--sf-red);white-space:nowrap;">K{{ number_format($usage['amount'], 2) }}</td>
                                                <td style="font-size:.78rem;color:var(--sf-muted);">{{ $usage['recorder']['name'] ?? 'System' }}</td>
                                                <td>
                                                    @if ($fund['status'] === 'active')
                                                        @if ($confirmingDeleteId === $usage['id'])
                                                            <div style="display:flex;gap:.3rem;">
                                                                <button wire:click="deleteUsage({{ $usage['id'] }})" class="sf-btn sf-btn-danger sf-btn-sm" title="Confirm delete">
                                                                    <i class="fas fa-check"></i>
                                                                </button>
                                                                <button wire:click="cancelDelete" class="sf-btn sf-btn-outline sf-btn-sm" title="Cancel">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                        @else
                                                            <div style="display:flex;gap:.3rem;">
                                                                <button wire:click="editUsage({{ $usage['id'] }})" class="sf-btn sf-btn-outline sf-btn-sm" title="Edit">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                                <button wire:click="confirmDelete({{ $usage['id'] }})" class="sf-btn sf-btn-outline sf-btn-sm" title="Delete" style="color:var(--sf-red);border-color:rgba(220,38,38,.2);">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8">
                                                    <div class="sf-empty">
                                                        <i class="fas fa-receipt"></i>
                                                        <p>No usage records yet. Click "Record Usage" to start tracking how the fund is used.</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    @if (count($usages))
                                        <tfoot>
                                            <tr>
                                                <td colspan="5" style="text-align:right;">TOTAL USED</td>
                                                <td style="color:var(--sf-red);">K{{ number_format(collect($usages)->sum('amount'), 2) }}</td>
                                                <td colspan="2"></td>
                                            </tr>
                                        </tfoot>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- ██ RIGHT — Sidebar ██ --}}
                    <div class="sf-sidebar">
                        {{-- Fund details --}}
                        <div class="sf-card">
                            <div class="sf-card-header">
                                <div class="sf-card-title"><i class="fas fa-info-circle"></i> Fund Details</div>
                            </div>
                            <div class="sf-card-body" style="padding:1rem 1.25rem;">
                                <div class="sf-info-row">
                                    <span class="sf-info-label">Village Bank</span>
                                    <span class="sf-info-value">{{ $bankName }}</span>
                                </div>
                                <div class="sf-info-row">
                                    <span class="sf-info-label">Circle</span>
                                    <span class="sf-info-value">{{ $circleName }}</span>
                                </div>
                                <div class="sf-info-row">
                                    <span class="sf-info-label">Insurance Profit</span>
                                    <span class="sf-info-value" style="color:var(--sf-green);">K{{ number_format($fund['total_insurance_profit'], 2) }}</span>
                                </div>
                                <div class="sf-info-row">
                                    <span class="sf-info-label">Penalties</span>
                                    <span class="sf-info-value" style="color:var(--sf-red);">K{{ number_format($fund['total_penalties'], 2) }}</span>
                                </div>
                                <div class="sf-info-row">
                                    <span class="sf-info-label">Total Fund</span>
                                    <span class="sf-info-value" style="color:var(--sf-amber);">K{{ number_format($fund['total_fund'], 2) }}</span>
                                </div>
                                <div class="sf-info-row">
                                    <span class="sf-info-label">Status</span>
                                    <span>
                                        @php
                                            $statusClass = match($fund['status']) {
                                                'active'   => 'sf-status-active',
                                                'depleted' => 'sf-status-depleted',
                                                'closed'   => 'sf-status-closed',
                                                default    => 'sf-status-closed',
                                            };
                                        @endphp
                                        <span class="sf-badge {{ $statusClass }}">{{ ucfirst($fund['status']) }}</span>
                                    </span>
                                </div>
                                <div class="sf-info-row">
                                    <span class="sf-info-label">Created</span>
                                    <span class="sf-info-value" style="font-size:.78rem;">{{ \Carbon\Carbon::parse($fund['created_at'])->format('d M Y, H:i') }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Fund breakdown --}}
                        <div class="sf-card">
                            <div class="sf-card-header">
                                <div class="sf-card-title"><i class="fas fa-chart-pie"></i> Fund Composition</div>
                            </div>
                            <div class="sf-card-body" style="padding:1rem 1.25rem;">
                                @php
                                    $insPct = $fund['total_fund'] > 0 ? round(($fund['total_insurance_profit'] / $fund['total_fund']) * 100, 1) : 0;
                                    $penPct = 100 - $insPct;
                                @endphp
                                <div style="display:flex;gap:1rem;margin-bottom:.75rem;">
                                    <div style="flex:1;text-align:center;">
                                        <div style="font-size:1.5rem;font-weight:800;color:var(--sf-green);">{{ $insPct }}%</div>
                                        <div style="font-size:.68rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--sf-faint);">Insurance Profit</div>
                                    </div>
                                    <div style="flex:1;text-align:center;">
                                        <div style="font-size:1.5rem;font-weight:800;color:var(--sf-red);">{{ $penPct }}%</div>
                                        <div style="font-size:.68rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--sf-faint);">Penalties</div>
                                    </div>
                                </div>
                                <div style="height:8px;border-radius:8px;overflow:hidden;display:flex;">
                                    <div style="width:{{ $insPct }}%;background:var(--sf-green);"></div>
                                    <div style="width:{{ $penPct }}%;background:var(--sf-red);"></div>
                                </div>
                            </div>
                        </div>

                        {{-- Usage by type --}}
                        @if (count($usages))
                            <div class="sf-card">
                                <div class="sf-card-header">
                                    <div class="sf-card-title"><i class="fas fa-tags"></i> Usage by Type</div>
                                </div>
                                <div class="sf-card-body" style="padding:1rem 1.25rem;">
                                    @php
                                        $byType = collect($usages)->groupBy('type');
                                        $typeConfig = [
                                            'shareout' => ['label' => 'Share Out', 'color' => 'var(--sf-green)', 'icon' => 'fas fa-hand-holding-usd'],
                                            'donation' => ['label' => 'Donations', 'color' => 'var(--sf-blue)', 'icon' => 'fas fa-heart'],
                                            'payment'  => ['label' => 'Payments', 'color' => 'var(--sf-amber)', 'icon' => 'fas fa-shopping-cart'],
                                            'other'    => ['label' => 'Other', 'color' => 'var(--sf-muted)', 'icon' => 'fas fa-ellipsis-h'],
                                        ];
                                    @endphp
                                    @foreach ($typeConfig as $type => $cfg)
                                        @if ($byType->has($type))
                                            @php $typeTotal = $byType[$type]->sum('amount'); @endphp
                                            <div style="display:flex;align-items:center;justify-content:space-between;padding:.4rem 0;border-bottom:1px solid #f5f7fa;">
                                                <div style="display:flex;align-items:center;gap:.5rem;">
                                                    <i class="{{ $cfg['icon'] }}" style="color:{{ $cfg['color'] }};font-size:.72rem;width:16px;text-align:center;"></i>
                                                    <span style="font-size:.82rem;font-weight:600;color:var(--sf-text);">{{ $cfg['label'] }}</span>
                                                    <span style="font-size:.68rem;color:var(--sf-faint);">({{ $byType[$type]->count() }})</span>
                                                </div>
                                                <span style="font-weight:700;font-size:.84rem;color:{{ $cfg['color'] }};">K{{ number_format($typeTotal, 2) }}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Fund actions --}}
                        <div class="sf-card">
                            <div class="sf-card-header">
                                <div class="sf-card-title"><i class="fas fa-cog"></i> Actions</div>
                            </div>
                            <div class="sf-card-body" style="padding:1rem 1.25rem;">
                                @if ($fund['status'] === 'active')
                                    <button wire:click="closeFund" class="sf-btn sf-btn-outline" style="width:100%;justify-content:center;"
                                            onclick="return confirm('Close this social fund? You can reopen it later.')">
                                        <i class="fas fa-lock"></i> Close Fund
                                    </button>
                                    <div style="font-size:.72rem;color:var(--sf-faint);margin-top:.5rem;text-align:center;">
                                        Closing prevents new usage records from being added.
                                    </div>
                                @elseif ($fund['status'] === 'closed')
                                    <button wire:click="reopenFund" class="sf-btn sf-btn-green" style="width:100%;justify-content:center;">
                                        <i class="fas fa-lock-open"></i> Reopen Fund
                                    </button>
                                @elseif ($fund['status'] === 'depleted')
                                    <div class="sf-alert sf-alert-warning" style="margin-bottom:0;">
                                        <i class="fas fa-info-circle"></i> This fund has been fully used.
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- How it works --}}
                        <div class="sf-card">
                            <div class="sf-card-header">
                                <div class="sf-card-title"><i class="fas fa-question-circle"></i> How Social Fund Works</div>
                            </div>
                            <div style="padding:1rem 1.25rem;counter-reset:sfstep;">
                                @php
                                    $steps = [
                                        'When a village bank does not give insurance profit to members, the profit is pooled into a social fund.',
                                        'Penalties accumulated during the circle are also added to the fund.',
                                        'Admins decide how to use the fund: share out, donations, payments, etc.',
                                        'Each usage is recorded with type, amount, recipient, and date.',
                                        'The fund balance updates automatically until fully used.',
                                    ];
                                @endphp
                                @foreach ($steps as $step)
                                    <div style="display:flex;gap:.65rem;padding:.4rem 0;counter-increment:sfstep;">
                                        <div style="width:24px;height:24px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.6rem;font-weight:800;flex-shrink:0;background:rgba(217,119,6,.08);color:var(--sf-amber);border:1px solid rgba(217,119,6,.15);">{{ $loop->iteration }}</div>
                                        <div style="font-size:.78rem;color:var(--sf-muted);line-height:1.5;padding-top:.1rem;">{{ $step }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @elseif ($socialFundId)
                <div class="sf-card">
                    <div class="sf-card-body">
                        <div class="sf-empty">
                            <i class="fas fa-search"></i>
                            <p>Social fund not found.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @else
        <div class="sf-card">
            <div class="sf-card-body">
                <div class="sf-alert sf-alert-warning" style="margin-bottom:0;">
                    <i class="fas fa-lock"></i> You do not have permission to view this page.
                </div>
            </div>
        </div>
    @endcan
</div>
