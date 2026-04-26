<div>
    @push('custom-styles')
    <style>
        :root {
            --sc-navy:#1E3A5F;--sc-navy-light:#2B6B96;--sc-amber:#D97706;--sc-amber-light:#F59E0B;
            --sc-bg:#f4f6fa;--sc-card:#fff;--sc-border:#edf0f7;--sc-text:#1e293b;
            --sc-muted:#64748b;--sc-faint:#94a3b8;--sc-green:#16a34a;--sc-red:#dc2626;--sc-blue:#2563eb;--sc-purple:#7c3aed;--sc-radius:16px;
        }
        .sc-page{background:var(--sc-bg);min-height:100vh;}

        /* ── Hero ─────────────────── */
        .sc-hero{background:linear-gradient(135deg,var(--sc-navy) 0%,#234b78 50%,var(--sc-navy-light) 100%);padding:1.75rem 0 6rem;position:relative;overflow:hidden;}
        .sc-hero::before{content:'';position:absolute;width:600px;height:600px;top:-60%;right:-8%;background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%);border-radius:50%;pointer-events:none;}
        .sc-hero-inner{position:relative;z-index:2;padding:0 1.5rem;}
        .sc-breadcrumb{display:flex;gap:.5rem;list-style:none;padding:0;margin:0 0 .75rem;font-size:.82rem;}
        .sc-breadcrumb a{color:rgba(255,255,255,.55);text-decoration:none;}
        .sc-breadcrumb a:hover{color:rgba(255,255,255,.85);}
        .sc-breadcrumb .active{color:var(--sc-amber-light);font-weight:600;}
        .sc-breadcrumb .sep{color:rgba(255,255,255,.25);}
        .sc-hero-row{display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:.75rem;}
        .sc-hero-title h1{color:#fff;font-size:1.6rem;font-weight:800;margin:0;}
        .sc-hero-title h1 i{color:var(--sc-amber);margin-right:.5rem;}
        .sc-hero-sub{color:rgba(255,255,255,.55);font-size:.88rem;margin:.25rem 0 0;}

        /* ── Content ──────────────── */
        .sc-content{margin-top:-4rem;position:relative;z-index:10;padding:0 1.5rem 2rem;}
        .sc-grid{display:grid;grid-template-columns:1fr 360px;gap:1.25rem;}
        @media(max-width:992px){.sc-grid{grid-template-columns:1fr;}}

        /* ── Card ─────────────────── */
        .sc-card{background:var(--sc-card);border-radius:var(--sc-radius);border:1px solid var(--sc-border);box-shadow:0 2px 12px rgba(0,0,0,.04);overflow:hidden;}
        .sc-card-header{padding:1rem 1.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.5rem;border-bottom:1px solid var(--sc-border);}
        .sc-card-title{font-size:.92rem;font-weight:700;color:var(--sc-text);display:flex;align-items:center;gap:.4rem;}
        .sc-card-title i{color:var(--sc-amber);font-size:.78rem;}
        .sc-card-body{padding:1.25rem 1.5rem;}

        /* ── Alerts ───────────────── */
        .sc-alert{padding:.7rem 1rem;border-radius:12px;font-size:.84rem;display:flex;align-items:center;gap:.5rem;margin-bottom:1rem;}
        .sc-alert-success{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;}
        .sc-alert-warning{background:#fffbeb;color:#92400e;border:1px solid #fde68a;}
        .sc-alert-info{background:#eff6ff;color:#1e40af;border:1px solid #bfdbfe;}

        /* ── Form ─────────────────── */
        .sc-label{display:block;font-size:.7rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--sc-faint);margin-bottom:.35rem;}
        .sc-select{width:100%;padding:.55rem .85rem;border:1px solid var(--sc-border);border-radius:10px;font-size:.85rem;background:#fafbfd;transition:border .2s;cursor:pointer;-webkit-appearance:none;appearance:none;background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2394a3b8' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");background-repeat:no-repeat;background-position:right .65rem center;background-size:.65rem;padding-right:2rem;}
        .sc-select:focus{outline:none;border-color:var(--sc-amber);background-color:#fff;box-shadow:0 0 0 3px rgba(217,119,6,.08);}
        .sc-form-row{display:grid;grid-template-columns:1fr 1fr auto;gap:.85rem;align-items:end;}
        @media(max-width:768px){.sc-form-row{grid-template-columns:1fr;}}
        .sc-btn{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1.25rem;border-radius:10px;font-size:.82rem;font-weight:700;border:none;cursor:pointer;transition:all .2s;text-decoration:none;}
        .sc-btn-primary{background:var(--sc-amber);color:#fff;}
        .sc-btn-primary:hover{background:var(--sc-amber-light);transform:translateY(-1px);box-shadow:0 4px 14px rgba(217,119,6,.2);}
        .sc-btn-primary:disabled{opacity:.5;cursor:not-allowed;transform:none;box-shadow:none;}
        .sc-btn-green{background:var(--sc-green);color:#fff;}
        .sc-btn-green:hover{background:#15803d;transform:translateY(-1px);box-shadow:0 4px 14px rgba(22,163,74,.2);}

        /* ── Pool stats ───────────── */
        .sc-pool{display:grid;grid-template-columns:repeat(4,1fr);gap:.75rem;margin-bottom:1.25rem;}
        @media(max-width:768px){.sc-pool{grid-template-columns:repeat(2,1fr);}}
        .sc-pool-item{background:var(--sc-card);border-radius:var(--sc-radius);border:1px solid var(--sc-border);box-shadow:0 2px 12px rgba(0,0,0,.04);padding:1rem 1.1rem;display:flex;align-items:center;justify-content:space-between;transition:all .2s;}
        .sc-pool-item:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(0,0,0,.06);}
        .sc-pool-label{font-size:.6rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--sc-faint);}
        .sc-pool-value{font-size:1.35rem;font-weight:800;color:var(--sc-text);margin-top:.05rem;}
        .sc-pool-icon{width:42px;height:42px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:.95rem;flex-shrink:0;}

        /* ── Table ────────────────── */
        .sc-table{width:100%;border-collapse:collapse;}
        .sc-table thead th{font-size:.62rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--sc-faint);padding:.7rem 1rem;border-bottom:1px solid var(--sc-border);background:#fafbfd;white-space:nowrap;}
        .sc-table tbody td{padding:.7rem 1rem;border-bottom:1px solid #f5f7fa;font-size:.84rem;vertical-align:middle;}
        .sc-table tbody tr:last-child td{border-bottom:none;}
        .sc-table tbody tr:hover{background:#fafbfd;}
        .sc-table tfoot td{padding:.7rem 1rem;font-weight:800;background:#fafbfd;border-top:2px solid var(--sc-border);font-size:.84rem;}

        /* ── Avatar ───────────────── */
        .sc-avatar{width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.65rem;flex-shrink:0;background:linear-gradient(135deg,var(--sc-navy),var(--sc-navy-light));color:#fff;}
        .sc-member{display:flex;align-items:center;gap:.55rem;}
        .sc-member-name{font-weight:700;color:var(--sc-text);font-size:.84rem;}
        .sc-member-email{font-size:.7rem;color:var(--sc-faint);}

        /* ── Progress ─────────────── */
        .sc-progress-wrap{display:flex;align-items:center;gap:.4rem;}
        .sc-progress-bar{flex:1;height:5px;border-radius:5px;background:var(--sc-border);overflow:hidden;max-width:60px;}
        .sc-progress-fill{height:100%;border-radius:5px;background:var(--sc-green);transition:width .3s;}
        .sc-progress-pct{font-size:.72rem;color:var(--sc-faint);font-weight:700;}

        /* ── Sidebar ──────────────── */
        .sc-sidebar{display:flex;flex-direction:column;gap:1.25rem;}

        /* How-it-works */
        .sc-steps{padding:1rem 1.25rem;counter-reset:step;}
        .sc-step{display:flex;gap:.65rem;padding:.5rem 0;counter-increment:step;}
        .sc-step-num{width:26px;height:26px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.62rem;font-weight:800;flex-shrink:0;background:rgba(217,119,6,.08);color:var(--sc-amber);border:1px solid rgba(217,119,6,.15);}
        .sc-step-num::before{content:counter(step);}
        .sc-step-text{font-size:.82rem;color:var(--sc-muted);line-height:1.5;padding-top:.15rem;}

        /* Past shareout list */
        .sc-so-item{display:flex;align-items:center;justify-content:space-between;padding:.7rem 1.25rem;border-bottom:1px solid #f5f7fa;text-decoration:none;color:inherit;transition:background .15s;cursor:pointer;}
        .sc-so-item:last-child{border-bottom:none;}
        .sc-so-item:hover{background:#fafbfd;text-decoration:none;color:inherit;}
        .sc-so-circle{font-weight:700;font-size:.86rem;color:var(--sc-text);}
        .sc-so-meta{font-size:.72rem;color:var(--sc-faint);}
        .sc-so-pool{font-weight:800;font-size:.88rem;color:var(--sc-blue);}
        .sc-so-arrow{color:var(--sc-faint);font-size:.65rem;margin-left:.5rem;}

        /* ── Empty ────────────────── */
        .sc-empty{text-align:center;padding:2.5rem 1rem;}
        .sc-empty i{font-size:2rem;opacity:.12;display:block;margin-bottom:.5rem;color:var(--sc-navy);}
        .sc-empty p{font-size:.84rem;color:var(--sc-muted);margin:0;}

        @keyframes scSlide{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
        .sc-animate{animation:scSlide .3s ease;}
        @media(max-width:768px){.sc-content{padding:0 .75rem 1.5rem;}}
    </style>
    @endpush

    @can('view-shareout')
    <section class="content sc-page">
        {{-- ████ Hero ████ --}}
        <div class="sc-hero">
            <div class="sc-hero-inner container-fluid">
                <ul class="sc-breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li class="active">Shareout</li>
                </ul>
                <div class="sc-hero-row">
                    <div class="sc-hero-title">
                        <h1><i class="fas fa-coins"></i>Shareout Calculator</h1>
                        <p class="sc-hero-sub">Calculate and distribute the end-of-cycle pool to members</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ████ Content ████ --}}
        <div class="sc-content container-fluid sc-animate">

            {{-- Alerts --}}
            @if ($successMessage)
                <div class="sc-alert sc-alert-success"><i class="fas fa-check-circle"></i> {{ $successMessage }}</div>
            @endif
            @if (session()->has('warning'))
                <div class="sc-alert sc-alert-warning"><i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}</div>
            @endif

            <div class="sc-grid">
                {{-- ██ LEFT — Calculator ██ --}}
                <div>
                    {{-- Circle selector card --}}
                    <div class="sc-card" style="margin-bottom:1.25rem;">
                        <div class="sc-card-header">
                            <div class="sc-card-title"><i class="fas fa-calculator"></i> Calculate Shareout</div>
                        </div>
                        <div class="sc-card-body">
                            <div class="sc-form-row">
                                <div>
                                    <label class="sc-label">Village Bank</label>
                                    @include('partials.village-bank-selector')
                                </div>
                                <div>
                                    <label class="sc-label">Circle <span style="color:var(--sc-red);">*</span></label>
                                    <select wire:model.live="circleId" class="sc-select">
                                        <option value="">-- Select Circle --</option>
                                        @foreach ($this->circles as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }} ({{ $c->members_count }} members)</option>
                                        @endforeach
                                    </select>
                                    @error('circleId') <small style="color:var(--sc-red);font-size:.76rem;">{{ $message }}</small> @enderror
                                </div>
                                <div>
                                    @if ($existingShareout)
                                        <div class="sc-alert sc-alert-info" style="margin-bottom:0;white-space:nowrap;">
                                            <i class="fas fa-info-circle"></i> Already finalised — K{{ number_format($existingShareout->total_pool, 2) }}
                                        </div>
                                    @elseif ($circleId)
                                        <button wire:click="preview" class="sc-btn sc-btn-primary" wire:loading.attr="disabled" wire:target="preview">
                                            <span wire:loading.remove wire:target="preview"><i class="fas fa-search-dollar"></i> Preview</span>
                                            <span wire:loading wire:target="preview"><i class="fas fa-spinner fa-spin"></i> Calculating…</span>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Preview results --}}
                    @if ($previewed)
                        {{-- Pool breakdown --}}
                        <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:.75rem;">
                            <span style="background:rgba(217,119,6,.08);color:var(--sc-amber);padding:.3rem .65rem;border-radius:8px;font-size:.72rem;font-weight:700;border:1px solid rgba(217,119,6,.15);">
                                <i class="fas fa-percentage" style="margin-right:.25rem;"></i> {{ $compoundRate }}% / month compound interest
                            </span>
                        </div>
                        <div class="sc-pool" style="grid-template-columns:repeat(3,1fr);">
                            <div class="sc-pool-item">
                                <div>
                                    <div class="sc-pool-label">Total Shares</div>
                                    <div class="sc-pool-value" style="color:var(--sc-blue);">K{{ number_format($totalContributions, 2) }}</div>
                                </div>
                                <div class="sc-pool-icon" style="background:rgba(37,99,235,.08);color:var(--sc-blue);"><i class="fas fa-piggy-bank"></i></div>
                            </div>
                            <div class="sc-pool-item">
                                <div>
                                    <div class="sc-pool-label">Total Insurance</div>
                                    <div class="sc-pool-value" style="color:var(--sc-purple);">K{{ number_format($totalInsurance, 2) }}</div>
                                </div>
                                <div class="sc-pool-icon" style="background:rgba(124,58,237,.08);color:var(--sc-purple);"><i class="fas fa-shield-alt"></i></div>
                            </div>
                            <div class="sc-pool-item">
                                <div>
                                    <div class="sc-pool-label">Interest Earned</div>
                                    <div class="sc-pool-value" style="color:var(--sc-green);">K{{ number_format($totalInterest, 2) }}</div>
                                </div>
                                <div class="sc-pool-icon" style="background:rgba(22,163,74,.08);color:var(--sc-green);"><i class="fas fa-percentage"></i></div>
                            </div>
                            <div class="sc-pool-item">
                                <div>
                                    <div class="sc-pool-label">Penalties</div>
                                    <div class="sc-pool-value" style="color:var(--sc-red);">K{{ number_format($totalPenalties, 2) }}</div>
                                </div>
                                <div class="sc-pool-icon" style="background:rgba(220,38,38,.08);color:var(--sc-red);"><i class="fas fa-gavel"></i></div>
                            </div>
                            <div class="sc-pool-item">
                                <div>
                                    <div class="sc-pool-label">Loans Outstanding</div>
                                    <div class="sc-pool-value" style="color:var(--sc-red);">K{{ number_format($totalLoansOutstanding, 2) }}</div>
                                </div>
                                <div class="sc-pool-icon" style="background:rgba(220,38,38,.08);color:var(--sc-red);"><i class="fas fa-hand-holding-usd"></i></div>
                            </div>
                            <div class="sc-pool-item">
                                <div>
                                    <div class="sc-pool-label">Total Pool</div>
                                    <div class="sc-pool-value" style="color:var(--sc-amber);">K{{ number_format($totalPool, 2) }}</div>
                                </div>
                                <div class="sc-pool-icon" style="background:rgba(217,119,6,.08);color:var(--sc-amber);"><i class="fas fa-coins"></i></div>
                            </div>
                        </div>

                        {{-- Social fund notice --}}
                        @if (!$insuranceProfitToMembers && $socialFundTotal > 0)
                            <div class="sc-card sc-animate" style="margin-bottom:1.25rem;border-left:4px solid var(--sc-amber);">
                                <div class="sc-card-body" style="padding:.85rem 1.25rem;">
                                    <div style="display:flex;align-items:center;gap:.65rem;flex-wrap:wrap;">
                                        <div style="width:38px;height:38px;border-radius:10px;display:flex;align-items:center;justify-content:center;background:rgba(217,119,6,.08);color:var(--sc-amber);font-size:.9rem;flex-shrink:0;">
                                            <i class="fas fa-hand-holding-heart"></i>
                                        </div>
                                        <div style="flex:1;min-width:200px;">
                                            <div style="font-size:.72rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--sc-faint);">Social Fund Created</div>
                                            <div style="font-size:1.15rem;font-weight:800;color:var(--sc-amber);">K{{ number_format($socialFundTotal, 2) }}</div>
                                        </div>
                                        <div style="display:flex;gap:1.25rem;flex-wrap:wrap;">
                                            <div>
                                                <div style="font-size:.62rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--sc-faint);">Insurance Profit</div>
                                                <div style="font-weight:700;color:var(--sc-green);font-size:.88rem;">K{{ number_format($socialFundInsurance, 2) }}</div>
                                            </div>
                                            <div>
                                                <div style="font-size:.62rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--sc-faint);">Penalties</div>
                                                <div style="font-weight:700;color:var(--sc-red);font-size:.88rem;">K{{ number_format($socialFundPenalties, 2) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin-top:.65rem;font-size:.78rem;color:var(--sc-muted);">
                                        <i class="fas fa-info-circle" style="margin-right:.25rem;"></i>
                                        Insurance profit is not distributed to members. It is pooled with penalties into a social fund.
                                        After finalising, manage the fund from <strong>Social Fund</strong> page.
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Allocations table --}}
                        <div class="sc-card">
                            <div class="sc-card-header">
                                <div class="sc-card-title"><i class="fas fa-users"></i> Member Allocations ({{ count($allocations) }})</div>
                                @if (!$existingShareout)
                                    <button wire:click="finalise" class="sc-btn sc-btn-green" wire:loading.attr="disabled" wire:target="finalise"
                                            onclick="return confirm('Are you sure? This action cannot be undone.')">
                                        <span wire:loading.remove wire:target="finalise"><i class="fas fa-check-double"></i> Finalise Shareout</span>
                                        <span wire:loading wire:target="finalise"><i class="fas fa-spinner fa-spin"></i> Finalising…</span>
                                    </button>
                                @endif
                            </div>
                            <div style="overflow-x:auto;">
                                <table class="sc-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Member</th>
                                            <th>Total Shares</th>
                                            <th>Insurance</th>
                                            <th>Shares Profit</th>
                                            <th>Insurance Profit</th>
                                            <th>Loans</th>
                                            <th>Net Shareout</th>
                                            <th>Action</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($allocations as $i => $alloc)
                                            @php
                                                $parts = explode(' ', trim($alloc['name']));
                                                $initials = strtoupper(substr($parts[0],0,1) . (isset($parts[1]) ? substr($parts[1],0,1) : ''));
                                            @endphp
                                            <tr>
                                                <td style="color:var(--sc-faint);font-size:.78rem;">{{ $i + 1 }}</td>
                                                <td>
                                                    <div class="sc-member">
                                                        <div class="sc-avatar">{{ $initials }}</div>
                                                        <div>
                                                            <div class="sc-member-name">{{ $alloc['name'] }}</div>
                                                            <div class="sc-member-email">{{ $alloc['email'] }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="font-weight:700;">K{{ number_format($alloc['contribution_total'], 2) }}</td>
                                                <td style="font-weight:700;color:var(--sc-purple);">K{{ number_format($alloc['insurance_total'], 2) }}</td>
                                                <td style="color:var(--sc-green);font-weight:700;">K{{ number_format($alloc['shares_profit'], 2) }}</td>
                                                <td style="color:var(--sc-green);font-weight:700;">K{{ number_format($alloc['insurance_profit'], 2) }}</td>
                                                <td style="color:var(--sc-red);font-weight:700;">
                                                    @if($alloc['loan_deduction'] > 0)
                                                        -K{{ number_format($alloc['loan_deduction'], 2) }}
                                                    @else
                                                        K0.00
                                                    @endif
                                                </td>
                                                <td style="color:var(--sc-blue);font-weight:800;">K{{ number_format($alloc['payout_amount'], 2) }}</td>
                                                <td>
                                                    @if($alloc['action'] === 'Receiving')
                                                        <span style="background:#f0fdf4;color:#166534;padding:.2rem .5rem;border-radius:6px;font-size:.68rem;font-weight:700;border:1px solid #bbf7d0;">Receiving</span>
                                                    @else
                                                        <span style="background:#fef2f2;color:#991b1b;padding:.2rem .5rem;border-radius:6px;font-size:.68rem;font-weight:700;border:1px solid #fecaca;">Pay back</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button wire:click="viewMember({{ $alloc['user_id'] }})" style="display:inline-flex;align-items:center;gap:.25rem;padding:.25rem .6rem;border-radius:6px;font-size:.68rem;font-weight:700;color:var(--sc-navy);background:rgba(30,58,95,.06);border:1px solid rgba(30,58,95,.1);cursor:pointer;transition:all .15s;" onmouseover="this.style.background='rgba(30,58,95,.12)'" onmouseout="this.style.background='rgba(30,58,95,.06)'">
                                                        <i class="fas fa-eye"></i> View
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9">
                                                    <div class="sc-empty">
                                                        <i class="fas fa-users"></i>
                                                        <p>No members found in this circle</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    @if (count($allocations))
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" style="text-align:right;">TOTALS</td>
                                                <td>K{{ number_format(array_sum(array_column($allocations, 'contribution_total')), 2) }}</td>
                                                <td style="color:var(--sc-purple);">K{{ number_format(array_sum(array_column($allocations, 'insurance_total')), 2) }}</td>
                                                <td style="color:var(--sc-green);">K{{ number_format(array_sum(array_column($allocations, 'shares_profit')), 2) }}</td>
                                                <td style="color:var(--sc-green);">K{{ number_format(array_sum(array_column($allocations, 'insurance_profit')), 2) }}</td>
                                                <td style="color:var(--sc-red);">-K{{ number_format(array_sum(array_column($allocations, 'loan_deduction')), 2) }}</td>
                                                <td style="color:var(--sc-blue);">K{{ number_format(array_sum(array_column($allocations, 'payout_amount')), 2) }}</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    @endif
                                </table>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- ██ RIGHT — Sidebar ██ --}}
                <div class="sc-sidebar">
                    {{-- How it works --}}
                    <div class="sc-card">
                        <div class="sc-card-header"><div class="sc-card-title"><i class="fas fa-lightbulb"></i> How Shareout Works</div></div>
                        <div class="sc-steps">
                            <div class="sc-step"><div class="sc-step-num"></div><div class="sc-step-text">Select a circle to calculate shareout for</div></div>
                            <div class="sc-step"><div class="sc-step-num"></div><div class="sc-step-text">Each deposit compounds monthly at the configured rate</div></div>
                            <div class="sc-step"><div class="sc-step-num"></div><div class="sc-step-text">Earlier deposits earn more (longer compounding period)</div></div>
                            <div class="sc-step"><div class="sc-step-num"></div><div class="sc-step-text">Penalties are added and distributed proportionally</div></div>
                            <div class="sc-step"><div class="sc-step-num"></div><div class="sc-step-text">Outstanding loans are deducted from gross shareout</div></div>
                            <div class="sc-step"><div class="sc-step-num"></div><div class="sc-step-text">Once finalised, the circle is marked <strong>Completed</strong></div></div>
                        </div>
                    </div>

                    {{-- Past shareouts --}}
                    <div class="sc-card">
                        <div class="sc-card-header"><div class="sc-card-title"><i class="fas fa-history"></i> Past Shareouts</div></div>
                        @if ($this->shareouts->count())
                            <div>
                                @foreach ($this->shareouts as $so)
                                    <a href="{{ route('shareout.show', $so->id) }}" class="sc-so-item">
                                        <div>
                                            <div class="sc-so-circle">{{ $so->circle->name ?? '--' }}</div>
                                            <div class="sc-so-meta">{{ $so->created_at->format('d M Y') }} &middot; {{ $so->allocations->count() }} members</div>
                                        </div>
                                        <div style="display:flex;align-items:center;">
                                            <span class="sc-so-pool">K{{ number_format($so->total_pool, 2) }}</span>
                                            <i class="fas fa-chevron-right sc-so-arrow"></i>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="sc-empty">
                                <i class="fas fa-coins"></i>
                                <p>No shareouts recorded yet</p>
                            </div>
                        @endif
                    </div>

                    {{-- Pool formula --}}
                    <div class="sc-card">
                        <div class="sc-card-header"><div class="sc-card-title"><i class="fas fa-chart-pie"></i> Pool Formula</div></div>
                        <div class="sc-card-body" style="font-size:.82rem;color:var(--sc-muted);line-height:1.7;">
                            <div style="background:#fafbfd;border-radius:10px;padding:.85rem 1rem;border:1px solid var(--sc-border);font-family:monospace;font-size:.78rem;color:var(--sc-text);">
                                <strong>Pool</strong> = Shares + Insurance + Interest + Penalties<br>
                                <strong>Net Shareout<sub>i</sub></strong> = Shares<sub>i</sub> + Insurance<sub>i</sub> + ShareProfit<sub>i</sub> + InsProfit<sub>i</sub> &minus; Loans<sub>i</sub><br>
                                <strong>ShareProfit<sub>i</sub></strong> = SharesProfitPool × (Shares<sub>i</sub> / TotalShares)<br>
                                <strong>InsProfit<sub>i</sub></strong> = InsProfitPool × (Insurance<sub>i</sub> / TotalInsurance)
                            </div>
                            <p style="margin-top:.75rem;">Each member receives their shares + insurance contributions, plus proportional profit from each pool, minus any outstanding loan balances.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ████ MEMBER DETAIL MODAL ████ --}}
    @if($showMemberModal && $memberDetail)
    <div style="position:fixed;inset:0;z-index:9999;display:flex;align-items:center;justify-content:center;">
        {{-- Backdrop --}}
        <div wire:click="closeMemberModal" style="position:absolute;inset:0;background:rgba(0,0,0,.45);backdrop-filter:blur(2px);"></div>

        {{-- Modal --}}
        <div style="position:relative;width:95%;max-width:920px;max-height:90vh;overflow-y:auto;background:#fff;border-radius:var(--sc-radius);box-shadow:0 25px 60px rgba(0,0,0,.2);animation:scSlide .25s ease;">

            {{-- Header --}}
            <div style="position:sticky;top:0;z-index:2;background:linear-gradient(135deg,var(--sc-navy) 0%,var(--sc-navy-light) 100%);padding:1.25rem 1.5rem;display:flex;align-items:center;justify-content:space-between;border-radius:var(--sc-radius) var(--sc-radius) 0 0;">
                <div>
                    @php
                        $md = $memberDetail;
                        $mdParts = explode(' ', trim($md['name']));
                        $mdInitials = strtoupper(substr($mdParts[0],0,1) . (isset($mdParts[1]) ? substr($mdParts[1],0,1) : ''));
                        $mdReceiving = ($md['action'] ?? 'Receiving') === 'Receiving';
                    @endphp
                    <div style="display:flex;align-items:center;gap:.75rem;">
                        <div style="width:42px;height:42px;border-radius:50%;background:rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:.75rem;color:#fff;">{{ $mdInitials }}</div>
                        <div>
                            <div style="color:#fff;font-weight:800;font-size:1rem;">{{ $md['name'] }}</div>
                            <div style="color:rgba(255,255,255,.55);font-size:.78rem;">{{ $md['email'] ?? '' }} &middot; {{ $compoundRate }}% / month compound</div>
                        </div>
                    </div>
                </div>
                <button wire:click="closeMemberModal" style="background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.2);color:#fff;width:32px;height:32px;border-radius:8px;cursor:pointer;font-size:.8rem;display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            {{-- Summary row --}}
            <div style="display:grid;grid-template-columns:repeat(5,1fr);gap:.5rem;padding:1rem 1.5rem;background:#fafbfd;border-bottom:1px solid var(--sc-border);">
                <div style="text-align:center;">
                    <div style="font-size:.55rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--sc-faint);">Investment</div>
                    <div style="font-size:1rem;font-weight:800;color:var(--sc-blue);">K{{ number_format($md['investment_compounded'], 2) }}</div>
                </div>
                <div style="text-align:center;">
                    <div style="font-size:.55rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--sc-faint);">Insurance</div>
                    <div style="font-size:1rem;font-weight:800;color:var(--sc-purple);">K{{ number_format($md['insurance_compounded'], 2) }}</div>
                </div>
                <div style="text-align:center;">
                    <div style="font-size:.55rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--sc-faint);">Loans Owed</div>
                    <div style="font-size:1rem;font-weight:800;color:var(--sc-red);">K{{ number_format($md['loan_deduction'], 2) }}</div>
                </div>
                <div style="text-align:center;">
                    <div style="font-size:.55rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--sc-faint);">Net Shareout</div>
                    <div style="font-size:1rem;font-weight:800;color:{{ $mdReceiving ? 'var(--sc-green)' : 'var(--sc-red)' }};">K{{ number_format($md['payout_amount'], 2) }}</div>
                </div>
                <div style="text-align:center;">
                    <div style="font-size:.55rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--sc-faint);">Action</div>
                    <div style="margin-top:.15rem;">
                        @if($mdReceiving)
                            <span style="background:#f0fdf4;color:#166534;padding:.2rem .6rem;border-radius:6px;font-size:.72rem;font-weight:700;border:1px solid #bbf7d0;">Receiving</span>
                        @else
                            <span style="background:#fef2f2;color:#991b1b;padding:.2rem .6rem;border-radius:6px;font-size:.72rem;font-weight:700;border:1px solid #fecaca;">Pay back</span>
                        @endif
                    </div>
                </div>
            </div>

            <div style="padding:1.25rem 1.5rem;">

                {{-- Waterfall breakdown --}}
                <div style="background:#fafbfd;border:1px solid var(--sc-border);border-radius:12px;padding:1rem 1.25rem;margin-bottom:1.25rem;">
                    <div style="font-size:.72rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--sc-faint);margin-bottom:.65rem;"><i class="fas fa-stream" style="color:var(--sc-amber);margin-right:.3rem;"></i> NET SHAREOUT WATERFALL</div>
                    @php
                        $wfRows = [
                            ['Investment (original)', $md['contribution_total'], 'var(--sc-blue)', ''],
                            ['Investment Profit', $md['shares_profit'], 'var(--sc-green)', '+'],
                            ['Insurance (original)', $md['insurance_total'], 'var(--sc-purple)', ''],
                            ['Insurance Return', $md['insurance_profit'], 'var(--sc-green)', '+'],
                        ];
                        $gross = $md['investment_compounded'] + $md['insurance_compounded'];
                    @endphp
                    @foreach($wfRows as $wf)
                        <div style="display:flex;justify-content:space-between;padding:.35rem 0;border-bottom:1px solid #eef1f6;">
                            <span style="font-size:.82rem;color:var(--sc-text);">{{ $wf[0] }}</span>
                            <span style="font-size:.82rem;font-weight:700;color:{{ $wf[2] }};">{{ $wf[3] }}K{{ number_format($wf[1], 2) }}</span>
                        </div>
                    @endforeach
                    <div style="display:flex;justify-content:space-between;padding:.45rem 0;border-top:2px dashed var(--sc-border);margin-top:.3rem;">
                        <span style="font-size:.84rem;font-weight:700;color:var(--sc-text);">Gross Shareout</span>
                        <span style="font-size:.92rem;font-weight:800;color:var(--sc-amber);">K{{ number_format($gross, 2) }}</span>
                    </div>
                    @if($md['loan_deduction'] > 0)
                    <div style="display:flex;justify-content:space-between;padding:.35rem 0;">
                        <span style="font-size:.82rem;color:var(--sc-text);">Outstanding Loans</span>
                        <span style="font-size:.82rem;font-weight:700;color:var(--sc-red);">&minus;K{{ number_format($md['loan_deduction'], 2) }}</span>
                    </div>
                    @endif
                    <div style="display:flex;justify-content:space-between;padding:.55rem 0;border-top:3px solid var(--sc-text);margin-top:.3rem;">
                        <span style="font-size:.9rem;font-weight:800;color:var(--sc-text);">Net Shareout</span>
                        <span style="font-size:1.05rem;font-weight:800;color:{{ $mdReceiving ? 'var(--sc-green)' : 'var(--sc-red)' }};">K{{ number_format($md['payout_amount'], 2) }}</span>
                    </div>
                </div>

                {{-- Investment Growth --}}
                @if(count($memberInvestments))
                <div style="margin-bottom:1.25rem;">
                    <div style="font-size:.72rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--sc-faint);margin-bottom:.5rem;"><i class="fas fa-chart-line" style="color:var(--sc-blue);margin-right:.3rem;"></i> INVESTMENT GROWTH ({{ $compoundRate }}% / month)</div>
                    <table class="sc-table" style="font-size:.8rem;">
                        <thead><tr><th>#</th><th>Month</th><th>Deposited</th><th>Months</th><th>Final Value</th><th>Profit</th></tr></thead>
                        <tbody>
                            @foreach($memberInvestments as $i => $inv)
                            <tr>
                                <td style="color:var(--sc-faint);">{{ $i+1 }}</td>
                                <td style="font-weight:600;">{{ $inv['month_label'] }}</td>
                                <td>K{{ number_format($inv['original_amount'], 2) }}</td>
                                <td style="color:var(--sc-muted);">{{ $inv['months_active'] }}</td>
                                <td style="font-weight:700;color:var(--sc-blue);">K{{ number_format($inv['final_value'], 2) }}</td>
                                <td style="font-weight:700;color:var(--sc-green);">+K{{ number_format($inv['profit'], 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot><tr>
                            <td colspan="2" style="text-align:right;">TOTAL</td>
                            <td>K{{ number_format(array_sum(array_column($memberInvestments, 'original_amount')), 2) }}</td>
                            <td></td>
                            <td style="color:var(--sc-blue);">K{{ number_format(array_sum(array_column($memberInvestments, 'final_value')), 2) }}</td>
                            <td style="color:var(--sc-green);">+K{{ number_format(array_sum(array_column($memberInvestments, 'profit')), 2) }}</td>
                        </tr></tfoot>
                    </table>
                </div>
                @endif

                {{-- Insurance Growth --}}
                @if(count($memberInsurance))
                <div style="margin-bottom:1.25rem;">
                    <div style="font-size:.72rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--sc-faint);margin-bottom:.5rem;"><i class="fas fa-shield-alt" style="color:var(--sc-purple);margin-right:.3rem;"></i> INSURANCE GROWTH ({{ $compoundRate }}% / month)</div>
                    <table class="sc-table" style="font-size:.8rem;">
                        <thead><tr><th>#</th><th>Month</th><th>Deposited</th><th>Months</th><th>Final Value</th><th>Return</th></tr></thead>
                        <tbody>
                            @foreach($memberInsurance as $i => $ins)
                            <tr>
                                <td style="color:var(--sc-faint);">{{ $i+1 }}</td>
                                <td style="font-weight:600;">{{ $ins['month_label'] }}</td>
                                <td>K{{ number_format($ins['original_amount'], 2) }}</td>
                                <td style="color:var(--sc-muted);">{{ $ins['months_active'] }}</td>
                                <td style="font-weight:700;color:var(--sc-purple);">K{{ number_format($ins['final_value'], 2) }}</td>
                                <td style="font-weight:700;color:var(--sc-green);">+K{{ number_format($ins['profit'], 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot><tr>
                            <td colspan="2" style="text-align:right;">TOTAL</td>
                            <td>K{{ number_format(array_sum(array_column($memberInsurance, 'original_amount')), 2) }}</td>
                            <td></td>
                            <td style="color:var(--sc-purple);">K{{ number_format(array_sum(array_column($memberInsurance, 'final_value')), 2) }}</td>
                            <td style="color:var(--sc-green);">+K{{ number_format(array_sum(array_column($memberInsurance, 'profit')), 2) }}</td>
                        </tr></tfoot>
                    </table>
                </div>
                @endif

                {{-- Loan History --}}
                @if(count($memberLoans))
                <div>
                    <div style="font-size:.72rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--sc-faint);margin-bottom:.5rem;"><i class="fas fa-hand-holding-usd" style="color:var(--sc-red);margin-right:.3rem;"></i> LOAN HISTORY</div>
                    <table class="sc-table" style="font-size:.8rem;">
                        <thead><tr><th>#</th><th>Month</th><th>Amount</th><th>Rate</th><th>Total Payable</th><th>Repaid</th><th>Outstanding</th></tr></thead>
                        <tbody>
                            @foreach($memberLoans as $i => $loan)
                            <tr>
                                <td style="color:var(--sc-faint);">{{ $i+1 }}</td>
                                <td style="font-weight:600;">{{ $loan['month_label'] }}</td>
                                <td>K{{ number_format($loan['amount'], 2) }}</td>
                                <td style="color:var(--sc-muted);">{{ $loan['interest_rate'] }}%</td>
                                <td style="font-weight:700;">K{{ number_format($loan['total_payable'], 2) }}</td>
                                <td style="font-weight:700;color:var(--sc-green);">K{{ number_format($loan['repaid'], 2) }}</td>
                                <td style="font-weight:700;color:{{ $loan['outstanding'] > 0 ? 'var(--sc-red)' : 'var(--sc-green)' }};">K{{ number_format($loan['outstanding'], 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot><tr>
                            <td colspan="2" style="text-align:right;">TOTAL</td>
                            <td>K{{ number_format(array_sum(array_column($memberLoans, 'amount')), 2) }}</td>
                            <td></td>
                            <td>K{{ number_format(array_sum(array_column($memberLoans, 'total_payable')), 2) }}</td>
                            <td style="color:var(--sc-green);">K{{ number_format(array_sum(array_column($memberLoans, 'repaid')), 2) }}</td>
                            <td style="color:var(--sc-red);">K{{ number_format(array_sum(array_column($memberLoans, 'outstanding')), 2) }}</td>
                        </tr></tfoot>
                    </table>
                </div>
                @endif

                @if(!count($memberInvestments) && !count($memberInsurance) && !count($memberLoans))
                <div style="text-align:center;padding:2rem;color:var(--sc-muted);">
                    <i class="fas fa-info-circle" style="font-size:1.5rem;opacity:.15;display:block;margin-bottom:.5rem;"></i>
                    <p style="font-size:.84rem;">No detailed transaction records found for this member.</p>
                </div>
                @endif
            </div>

        </div>
    </div>
    @endif

    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
