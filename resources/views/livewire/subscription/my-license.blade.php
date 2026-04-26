<div>

<div class="nd-page">
    {{-- ═══════ HERO ═══════ --}}
    <div class="nd-hero">
        <div class="nd-hero-inner">
            <ul class="nd-breadcrumb">
                <li><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="sep">/</li>
                <li class="active">My License</li>
            </ul>
            <div class="nd-hero-title">
                <h1><i class="fas fa-id-card"></i>My License</h1>
                <p class="nd-hero-sub">View your village bank's license, subscription details, and renew when needed</p>
            </div>
        </div>
    </div>

    {{-- ═══════ CONTENT ═══════ --}}
    <div class="nd-content">

        {{-- Flash messages --}}
        @if(session()->has('success'))
            <div class="ml-alert ml-alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if(session()->has('error'))
            <div class="ml-alert ml-alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
        @endif

        @if(!$bank)
            <div class="nd-card" style="text-align:center;padding:3rem;">
                <i class="fas fa-university" style="font-size:2.5rem;color:var(--nd-faint);margin-bottom:1rem;"></i>
                <p style="color:var(--nd-muted);font-size:1rem;">No village bank selected. Please select a village bank first.</p>
            </div>
        @else

            {{-- ── License Status Banner ── --}}
            @if($license && $license->isValid())
                @php $daysLeft = $license->daysRemaining(); @endphp
                @if($daysLeft <= 14)
                    <div class="ml-banner ml-banner-warning">
                        <div class="ml-banner-icon"><i class="fas fa-exclamation-triangle"></i></div>
                        <div class="ml-banner-text">
                            <strong>License Expiring Soon!</strong>
                            Your license expires in <strong>{{ $daysLeft }} day{{ $daysLeft != 1 ? 's' : '' }}</strong> on {{ $license->expires_at->format('d M Y') }}.
                            Please renew to avoid service interruption.
                        </div>
                        <button wire:click="openRenewal" class="ml-banner-btn"><i class="fas fa-redo"></i> Renew Now</button>
                    </div>
                @else
                    <div class="ml-banner ml-banner-active">
                        <div class="ml-banner-icon"><i class="fas fa-check-circle"></i></div>
                        <div class="ml-banner-text">
                            <strong>License Active</strong> — Valid until {{ $license->expires_at->format('d M Y') }}
                            ({{ $daysLeft }} day{{ $daysLeft != 1 ? 's' : '' }} remaining)
                        </div>
                    </div>
                @endif
            @elseif($license && $license->status === 'revoked')
                <div class="ml-banner ml-banner-danger">
                    <div class="ml-banner-icon"><i class="fas fa-ban"></i></div>
                    <div class="ml-banner-text">
                        <strong>License Revoked</strong> — Your license has been revoked.
                        @if($license->revoke_reason) Reason: {{ $license->revoke_reason }} @endif
                        Please contact the administrator.
                    </div>
                </div>
            @else
                <div class="ml-banner ml-banner-danger">
                    <div class="ml-banner-icon"><i class="fas fa-exclamation-circle"></i></div>
                    <div class="ml-banner-text">
                        <strong>License Expired</strong> — Your license has expired. Renew now to continue using the platform.
                    </div>
                    <button wire:click="openRenewal" class="ml-banner-btn ml-banner-btn-danger"><i class="fas fa-redo"></i> Renew Now</button>
                </div>
            @endif

            {{-- ── Row 1: License + Plan Cards ── --}}
            <div class="ml-grid ml-grid-2">
                {{-- License Card --}}
                <div class="nd-card ml-detail-card">
                    <div class="nd-card-header">
                        <h3><i class="fas fa-key"></i> License Details</h3>
                    </div>
                    <div class="ml-card-body">
                        @if($license)
                            <div class="ml-info-row">
                                <span class="ml-info-label">License Key</span>
                                <span class="ml-info-value"><code class="ml-code">{{ $license->license_key }}</code></span>
                            </div>
                            <div class="ml-info-row">
                                <span class="ml-info-label">Status</span>
                                <span class="ml-info-value">
                                    @if($license->status === 'active' && $license->isValid())
                                        <span class="nd-badge nd-badge-green"><i class="fas fa-check-circle"></i> Active</span>
                                    @elseif($license->status === 'expired' || ($license->status === 'active' && !$license->isValid()))
                                        <span class="nd-badge ml-badge-expired"><i class="fas fa-clock"></i> Expired</span>
                                    @elseif($license->status === 'revoked')
                                        <span class="nd-badge ml-badge-revoked"><i class="fas fa-ban"></i> Revoked</span>
                                    @endif
                                </span>
                            </div>
                            <div class="ml-info-row">
                                <span class="ml-info-label">Village Bank</span>
                                <span class="ml-info-value"><strong>{{ $bank->name }}</strong></span>
                            </div>
                            <div class="ml-info-row">
                                <span class="ml-info-label">Issued</span>
                                <span class="ml-info-value">{{ $license->issued_at ? $license->issued_at->format('d M Y') : '—' }}</span>
                            </div>
                            <div class="ml-info-row">
                                <span class="ml-info-label">Expires</span>
                                <span class="ml-info-value">
                                    {{ $license->expires_at ? $license->expires_at->format('d M Y') : '—' }}
                                    @if($license->isValid())
                                        <small style="color:var(--nd-green);margin-left:.5rem;">({{ $license->daysRemaining() }} days left)</small>
                                    @endif
                                </span>
                            </div>
                        @else
                            <div class="ml-empty-mini">
                                <i class="fas fa-key"></i>
                                <p>No license issued yet.</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Plan Card --}}
                <div class="nd-card ml-detail-card">
                    <div class="nd-card-header">
                        <h3><i class="fas fa-crown"></i> Current Plan</h3>
                    </div>
                    <div class="ml-card-body">
                        @if($plan)
                            <div class="ml-plan-highlight">
                                <div class="ml-plan-name">{{ $plan->name }}</div>
                                <div class="ml-plan-price">K{{ number_format($plan->price, 2) }} <small>{{ $plan->cycleName() }}</small></div>
                            </div>
                            <div class="ml-info-row">
                                <span class="ml-info-label">Billing Cycle</span>
                                <span class="ml-info-value" style="text-transform:capitalize;">{{ $plan->billing_cycle }}</span>
                            </div>
                            <div class="ml-info-row">
                                <span class="ml-info-label">Duration</span>
                                <span class="ml-info-value">{{ $plan->duration_days }} days</span>
                            </div>
                            <div class="ml-info-row">
                                <span class="ml-info-label">Max Members</span>
                                <span class="ml-info-value">{{ $plan->max_members ?? 'Unlimited' }}</span>
                            </div>
                            <div class="ml-info-row">
                                <span class="ml-info-label">Max Circles</span>
                                <span class="ml-info-value">{{ $plan->max_circles ?? 'Unlimited' }}</span>
                            </div>
                            @if($subscription)
                                <div class="ml-info-row">
                                    <span class="ml-info-label">Subscription Status</span>
                                    <span class="ml-info-value" style="text-transform:capitalize;">
                                        <span class="nd-badge {{ $subscription->status === 'active' ? 'nd-badge-green' : 'ml-badge-expired' }}">{{ $subscription->status }}</span>
                                    </span>
                                </div>
                            @endif
                        @else
                            <div class="ml-empty-mini">
                                <i class="fas fa-crown"></i>
                                <p>No plan assigned.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- ── Row 2: Usage & Features ── --}}
            <div class="ml-grid ml-grid-2">
                {{-- Usage Card --}}
                <div class="nd-card ml-detail-card">
                    <div class="nd-card-header">
                        <h3><i class="fas fa-chart-pie"></i> Usage</h3>
                    </div>
                    <div class="ml-card-body">
                        @if($usage)
                            {{-- Members usage --}}
                            <div class="ml-usage-item">
                                <div class="ml-usage-header">
                                    <span><i class="fas fa-users"></i> Members</span>
                                    <span class="ml-usage-count">{{ $usage['members']['current'] }} / {{ $usage['members']['max'] ?? '∞' }}</span>
                                </div>
                                @if($usage['members']['max'])
                                    @php $memberPct = min(100, round(($usage['members']['current'] / $usage['members']['max']) * 100)); @endphp
                                    <div class="ml-progress">
                                        <div class="ml-progress-bar {{ $memberPct >= 90 ? 'ml-progress-danger' : ($memberPct >= 70 ? 'ml-progress-warning' : 'ml-progress-ok') }}" style="width:{{ $memberPct }}%"></div>
                                    </div>
                                    <small class="ml-usage-hint">{{ $usage['members']['remaining'] ?? 0 }} slot{{ ($usage['members']['remaining'] ?? 0) != 1 ? 's' : '' }} remaining</small>
                                @else
                                    <small class="ml-usage-hint" style="color:var(--nd-green);">Unlimited members</small>
                                @endif
                            </div>

                            {{-- Circles usage --}}
                            <div class="ml-usage-item" style="margin-top:1.25rem;">
                                <div class="ml-usage-header">
                                    <span><i class="fas fa-circle-notch"></i> Circles</span>
                                    <span class="ml-usage-count">{{ $usage['circles']['current'] }} / {{ $usage['circles']['max'] ?? '∞' }}</span>
                                </div>
                                @if($usage['circles']['max'])
                                    @php $circlePct = min(100, round(($usage['circles']['current'] / $usage['circles']['max']) * 100)); @endphp
                                    <div class="ml-progress">
                                        <div class="ml-progress-bar {{ $circlePct >= 90 ? 'ml-progress-danger' : ($circlePct >= 70 ? 'ml-progress-warning' : 'ml-progress-ok') }}" style="width:{{ $circlePct }}%"></div>
                                    </div>
                                    <small class="ml-usage-hint">{{ $usage['circles']['remaining'] ?? 0 }} slot{{ ($usage['circles']['remaining'] ?? 0) != 1 ? 's' : '' }} remaining</small>
                                @else
                                    <small class="ml-usage-hint" style="color:var(--nd-green);">Unlimited circles</small>
                                @endif
                            </div>
                        @else
                            <div class="ml-empty-mini">
                                <i class="fas fa-chart-pie"></i>
                                <p>No usage data available.</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Features / What You Can Do --}}
                <div class="nd-card ml-detail-card">
                    <div class="nd-card-header">
                        <h3><i class="fas fa-star"></i> What's Included</h3>
                    </div>
                    <div class="ml-card-body">
                        @if($plan && !empty($features))
                            <ul class="ml-features">
                                @foreach($features as $feature)
                                    <li><i class="fas fa-check"></i> {{ $feature }}</li>
                                @endforeach
                            </ul>
                        @elseif($plan)
                            <ul class="ml-features">
                                <li><i class="fas fa-check"></i> Member management (up to {{ $plan->max_members ?? 'unlimited' }})</li>
                                <li><i class="fas fa-check"></i> Circle management (up to {{ $plan->max_circles ?? 'unlimited' }})</li>
                                <li><i class="fas fa-check"></i> Share declarations & tracking</li>
                                <li><i class="fas fa-check"></i> Loan management</li>
                                <li><i class="fas fa-check"></i> Payment recording</li>
                                <li><i class="fas fa-check"></i> Repayment tracking</li>
                                <li><i class="fas fa-check"></i> Shareout calculations</li>
                                <li><i class="fas fa-check"></i> Reports & exports</li>
                                <li><i class="fas fa-check"></i> Rules & bylaws</li>
                                <li><i class="fas fa-check"></i> Polls & voting</li>
                            </ul>
                        @else
                            <div class="ml-empty-mini">
                                <i class="fas fa-star"></i>
                                <p>No plan features available.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- ── Row 3: Payment History ── --}}
            <div class="nd-card ml-detail-card">
                <div class="nd-card-header">
                    <h3><i class="fas fa-receipt"></i> Payment History</h3>
                    <div class="nd-toolbar">
                        <button wire:click="openRenewal" class="ml-renew-btn">
                            <i class="fas fa-redo"></i> Renew / Make Payment
                        </button>
                    </div>
                </div>
                <div style="overflow-x:auto;">
                    <table class="nd-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Reference</th>
                                <th>Proof</th>
                                <th>Status</th>
                                <th>Admin Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($payments as $payment)
                                <tr>
                                    <td style="font-size:.84rem;">{{ $payment->created_at->format('d M Y H:i') }}</td>
                                    <td><strong>K{{ number_format($payment->amount, 2) }}</strong></td>
                                    <td><code class="ml-code-sm">{{ $payment->reference }}</code></td>
                                    <td>
                                        @if($payment->proof_file)
                                            <a href="{{ asset('storage/' . $payment->proof_file) }}" target="_blank" class="ml-proof-link">
                                                <i class="fas fa-file-download"></i> View
                                            </a>
                                        @else
                                            <span style="color:var(--nd-faint);">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($payment->status === 'pending')
                                            <span class="nd-badge ml-badge-pending"><i class="fas fa-clock"></i> Pending</span>
                                        @elseif($payment->status === 'confirmed')
                                            <span class="nd-badge nd-badge-green"><i class="fas fa-check"></i> Confirmed</span>
                                        @else
                                            <span class="nd-badge ml-badge-rejected"><i class="fas fa-times"></i> Rejected</span>
                                        @endif
                                    </td>
                                    <td style="font-size:.82rem;color:var(--nd-muted);max-width:200px;">
                                        {{ $payment->admin_remarks ?? '—' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="nd-empty"><i class="fas fa-receipt"></i><p>No payments recorded yet.</p></div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        @endif
    </div>
</div>

{{-- ═══════ RENEWAL MODAL ═══════ --}}
@if($showRenewalModal)
    <div class="nd-overlay" wire:click.self="$set('showRenewalModal', false)">
        <div class="nd-modal ml-modal-lg">
            <div class="nd-modal-head">
                <h5><i class="fas fa-redo"></i> Renew License</h5>
                <button class="nd-modal-close" wire:click="$set('showRenewalModal', false)">&times;</button>
            </div>
            <form wire:submit.prevent="submitRenewal">
                <div class="nd-modal-body">

                    {{-- Step 1: Payment Information --}}
                    @if($paymentMethods->count())
                        <div class="ml-section-label"><i class="fas fa-credit-card"></i> Payment Details — Please pay to:</div>
                        <div class="ml-payment-methods">
                            @foreach($paymentMethods as $pm)
                                <div class="ml-pm-card">
                                    <div class="ml-pm-name">{{ $pm->method_name }}@if($pm->provider) <small>({{ $pm->provider }})</small>@endif</div>
                                    @if($pm->account_name)
                                        <div class="ml-pm-row"><span>Account Name:</span> <strong>{{ $pm->account_name }}</strong></div>
                                    @endif
                                    @if($pm->account_number)
                                        <div class="ml-pm-row"><span>Account No:</span> <strong class="ml-code-sm">{{ $pm->account_number }}</strong></div>
                                    @endif
                                    @if($pm->branch)
                                        <div class="ml-pm-row"><span>Branch:</span> {{ $pm->branch }}</div>
                                    @endif
                                    @if($pm->instructions)
                                        <div class="ml-pm-instructions">{{ $pm->instructions }}</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- Plan Selection (optional change) --}}
                    @if($availablePlans->count())
                        <div class="ml-section-label" style="margin-top:1.25rem;"><i class="fas fa-crown"></i> Select Plan</div>
                        <div class="ml-plan-grid">
                            @foreach($availablePlans as $ap)
                                <label class="ml-plan-option {{ $selectedPlanId == $ap->id ? 'ml-plan-selected' : '' }}" wire:click="$set('selectedPlanId', {{ $ap->id }})">
                                    <input type="radio" wire:model.live="selectedPlanId" value="{{ $ap->id }}" style="display:none;">
                                    <div class="ml-plan-option-name">{{ $ap->name }}</div>
                                    <div class="ml-plan-option-price">K{{ number_format($ap->price, 2) }} <small>{{ $ap->cycleName() }}</small></div>
                                    <div class="ml-plan-option-details">
                                        {{ $ap->max_members ?? '∞' }} members · {{ $ap->max_circles ?? '∞' }} circles · {{ $ap->duration_days }} days
                                    </div>
                                    @if($ap->is_featured)
                                        <span class="ml-plan-featured"><i class="fas fa-star"></i> Popular</span>
                                    @endif
                                </label>
                            @endforeach
                        </div>
                    @endif

                    {{-- Step 2: Upload Proof --}}
                    <div class="ml-section-label" style="margin-top:1.25rem;"><i class="fas fa-upload"></i> Upload Proof of Payment</div>
                    <div style="margin-bottom:1rem;">
                        <label class="ml-label">Payment / Transaction Reference <span class="req">*</span></label>
                        <input type="text" wire:model="paymentReference" class="ml-input" placeholder="e.g. TXN-123456789">
                        @error('paymentReference') <div class="ml-error">{{ $message }}</div> @enderror
                    </div>
                    <div style="margin-bottom:1rem;">
                        <label class="ml-label">Proof of Payment <span class="req">*</span></label>
                        <input type="file" wire:model="proofFile" class="ml-input" accept=".jpg,.jpeg,.png,.pdf">
                        @error('proofFile') <div class="ml-error">{{ $message }}</div> @enderror
                        <small style="color:var(--nd-faint);">JPG, PNG, or PDF — max 10 MB</small>
                        <div wire:loading wire:target="proofFile" style="color:var(--nd-green);font-size:.82rem;margin-top:.3rem;">
                            <i class="fas fa-spinner fa-spin"></i> Uploading...
                        </div>
                    </div>

                </div>
                <div class="nd-modal-foot">
                    <button type="button" wire:click="$set('showRenewalModal', false)" class="nd-btn-cancel">Cancel</button>
                    <button type="submit" class="ml-btn-submit" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="submitRenewal"><i class="fas fa-paper-plane"></i> Submit Renewal Payment</span>
                        <span wire:loading wire:target="submitRenewal"><i class="fas fa-spinner fa-spin"></i> Submitting...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endif

{{-- ═══════ SCOPED STYLES ═══════ --}}
<style>
/* ── Alerts ── */
.ml-alert{padding:.75rem 1rem;border-radius:10px;font-size:.86rem;display:flex;align-items:center;gap:.5rem;margin-bottom:1rem;}
.ml-alert-success{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;}
.ml-alert-error{background:#fef2f2;color:#991b1b;border:1px solid #fecaca;}

/* ── Status Banner ── */
.ml-banner{display:flex;align-items:center;gap:1rem;padding:1rem 1.25rem;border-radius:12px;margin-bottom:1.25rem;}
.ml-banner-active{background:linear-gradient(135deg,#f0fdf4,#dcfce7);border:1px solid #86efac;}
.ml-banner-warning{background:linear-gradient(135deg,#fffbeb,#fef3c7);border:1px solid #fcd34d;}
.ml-banner-danger{background:linear-gradient(135deg,#fef2f2,#fee2e2);border:1px solid #fca5a5;}
.ml-banner-icon{width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.ml-banner-active .ml-banner-icon{background:#dcfce7;color:#16a34a;}
.ml-banner-warning .ml-banner-icon{background:#fef3c7;color:#d97706;}
.ml-banner-danger .ml-banner-icon{background:#fee2e2;color:#dc2626;}
.ml-banner-text{flex:1;font-size:.88rem;color:var(--nd-text,#1e293b);}
.ml-banner-btn{padding:.45rem 1.1rem;border-radius:8px;border:none;font-size:.82rem;font-weight:600;cursor:pointer;white-space:nowrap;background:#d97706;color:#fff;}
.ml-banner-btn:hover{background:#b45309;}
.ml-banner-btn-danger{background:#dc2626;}
.ml-banner-btn-danger:hover{background:#b91c1c;}

/* ── Grid ── */
.ml-grid{display:grid;gap:1.25rem;margin-bottom:1.25rem;}
.ml-grid-2{grid-template-columns:repeat(2,1fr);}
@media(max-width:768px){.ml-grid-2{grid-template-columns:1fr;}}

/* ── Detail Card ── */
.ml-detail-card{border-radius:12px;}
.ml-card-body{padding:1.25rem;}
.ml-info-row{display:flex;justify-content:space-between;align-items:center;padding:.55rem 0;border-bottom:1px solid #f1f5f9;}
.ml-info-row:last-child{border-bottom:none;}
.ml-info-label{font-size:.82rem;color:var(--nd-muted,#64748b);font-weight:500;}
.ml-info-value{font-size:.86rem;color:var(--nd-text,#1e293b);font-weight:600;text-align:right;}

/* ── Code / Badge ── */
.ml-code{background:#f1f5f9;padding:.2rem .55rem;border-radius:6px;font-family:monospace;font-size:.82rem;color:var(--nd-navy,#1E3A5F);letter-spacing:.5px;}
.ml-code-sm{background:#f1f5f9;padding:.15rem .4rem;border-radius:4px;font-family:monospace;font-size:.78rem;}
.ml-badge-expired{background:#fef3c7;color:#92400e;}
.ml-badge-revoked{background:#fee2e2;color:#991b1b;}
.ml-badge-pending{background:#fef3c7;color:#92400e;}
.ml-badge-rejected{background:#fee2e2;color:#991b1b;}

/* ── Plan Highlight ── */
.ml-plan-highlight{text-align:center;padding:1rem;background:linear-gradient(135deg,#1E3A5F,#2d5a8e);border-radius:10px;margin-bottom:1rem;color:#fff;}
.ml-plan-name{font-size:1.1rem;font-weight:700;margin-bottom:.25rem;}
.ml-plan-price{font-size:1.5rem;font-weight:800;}
.ml-plan-price small{font-size:.75rem;font-weight:400;opacity:.8;}

/* ── Usage ── */
.ml-usage-item{}
.ml-usage-header{display:flex;justify-content:space-between;align-items:center;font-size:.86rem;font-weight:600;margin-bottom:.4rem;color:var(--nd-text);}
.ml-usage-header i{margin-right:.35rem;color:var(--nd-accent,#D97706);}
.ml-usage-count{font-family:monospace;font-size:.82rem;}
.ml-progress{width:100%;height:8px;background:#f1f5f9;border-radius:4px;overflow:hidden;}
.ml-progress-bar{height:100%;border-radius:4px;transition:width .5s ease;}
.ml-progress-ok{background:linear-gradient(90deg,#22c55e,#16a34a);}
.ml-progress-warning{background:linear-gradient(90deg,#f59e0b,#d97706);}
.ml-progress-danger{background:linear-gradient(90deg,#ef4444,#dc2626);}
.ml-usage-hint{font-size:.76rem;color:var(--nd-faint,#94a3b8);margin-top:.25rem;display:block;}

/* ── Features ── */
.ml-features{list-style:none;padding:0;margin:0;}
.ml-features li{padding:.45rem 0;font-size:.84rem;color:var(--nd-text);border-bottom:1px solid #f8fafc;display:flex;align-items:center;gap:.5rem;}
.ml-features li:last-child{border-bottom:none;}
.ml-features li i{color:#16a34a;font-size:.7rem;flex-shrink:0;}

/* ── Proof Link ── */
.ml-proof-link{color:var(--nd-primary,#1E3A5F);font-size:.82rem;text-decoration:none;font-weight:600;}
.ml-proof-link:hover{text-decoration:underline;}

/* ── Renew Button ── */
.ml-renew-btn{padding:.42rem 1rem;border-radius:8px;border:none;font-size:.82rem;font-weight:600;cursor:pointer;background:var(--nd-accent,#D97706);color:#fff;display:flex;align-items:center;gap:.35rem;}
.ml-renew-btn:hover{background:#b45309;}

/* ── Modal ── */
.ml-modal-lg{max-width:640px;}
.ml-section-label{font-size:.86rem;font-weight:700;color:var(--nd-navy,#1E3A5F);margin-bottom:.75rem;display:flex;align-items:center;gap:.4rem;}
.ml-label{display:block;font-size:.82rem;font-weight:600;color:var(--nd-text);margin-bottom:.3rem;}
.ml-input{width:100%;padding:.5rem .75rem;border:1px solid #e2e8f0;border-radius:8px;font-size:.86rem;background:#fff;transition:border-color .2s;}
.ml-input:focus{outline:none;border-color:var(--nd-accent,#D97706);box-shadow:0 0 0 3px rgba(217,119,6,.1);}
.ml-error{color:#dc2626;font-size:.78rem;margin-top:.25rem;}
.req{color:#dc2626;}

/* ── Payment Methods in Modal ── */
.ml-payment-methods{display:grid;gap:.75rem;margin-bottom:.5rem;}
.ml-pm-card{background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:.85rem 1rem;}
.ml-pm-name{font-weight:700;font-size:.88rem;color:var(--nd-navy);margin-bottom:.35rem;}
.ml-pm-name small{font-weight:400;color:var(--nd-muted);}
.ml-pm-row{font-size:.82rem;color:var(--nd-text);margin-bottom:.15rem;}
.ml-pm-row span{color:var(--nd-muted);margin-right:.25rem;}
.ml-pm-instructions{font-size:.78rem;color:var(--nd-muted);margin-top:.35rem;font-style:italic;border-top:1px dashed #e2e8f0;padding-top:.35rem;}

/* ── Plan Selection Grid ── */
.ml-plan-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:.75rem;}
.ml-plan-option{position:relative;background:#fff;border:2px solid #e2e8f0;border-radius:10px;padding:.85rem;cursor:pointer;transition:all .2s;text-align:center;}
.ml-plan-option:hover{border-color:var(--nd-accent);box-shadow:0 2px 8px rgba(217,119,6,.1);}
.ml-plan-selected{border-color:var(--nd-accent,#D97706);background:#fffbeb;box-shadow:0 2px 8px rgba(217,119,6,.15);}
.ml-plan-option-name{font-weight:700;font-size:.86rem;color:var(--nd-navy);}
.ml-plan-option-price{font-size:1.1rem;font-weight:800;color:var(--nd-accent);margin:.2rem 0;}
.ml-plan-option-price small{font-size:.7rem;font-weight:400;color:var(--nd-muted);}
.ml-plan-option-details{font-size:.72rem;color:var(--nd-muted);}
.ml-plan-featured{position:absolute;top:-.5rem;right:-.3rem;background:var(--nd-accent);color:#fff;font-size:.6rem;padding:.15rem .45rem;border-radius:6px;font-weight:700;}

/* ── Submit Button ── */
.ml-btn-submit{padding:.5rem 1.25rem;border-radius:8px;border:none;font-size:.86rem;font-weight:600;cursor:pointer;background:var(--nd-accent,#D97706);color:#fff;display:flex;align-items:center;gap:.35rem;}
.ml-btn-submit:hover{background:#b45309;}

/* ── Empty mini ── */
.ml-empty-mini{text-align:center;padding:2rem 1rem;color:var(--nd-faint);}
.ml-empty-mini i{font-size:1.8rem;margin-bottom:.5rem;display:block;}
.ml-empty-mini p{font-size:.86rem;margin:0;}
</style>

</div>
