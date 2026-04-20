<div>

@once
@push('custom-styles')
<style>
    /* ── License Manager (lm-*) ── */
    .lm-alert{padding:.65rem 1rem;border-radius:10px;font-size:.84rem;display:flex;align-items:center;gap:.5rem;margin-bottom:1rem;}
    .lm-alert-success{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;}
    .lm-stats{display:grid;grid-template-columns:repeat(auto-fill,minmax(190px,1fr));gap:.75rem;margin-bottom:1.25rem;}
    .lm-row-warn{background:#fffbeb !important;}
    .lm-code{font-family:monospace;font-size:.78rem;background:#f1f5f9;padding:.15rem .45rem;border-radius:6px;color:var(--nd-navy);font-weight:600;letter-spacing:.3px;}
    .lm-badge-plan{background:#eff6ff;color:#1e40af;border:1px solid #bfdbfe;}
    .lm-badge-expired{background:#fef3c7;color:#92400e;border:1px solid #fde68a;}
    .lm-badge-revoked{background:#fef2f2;color:#991b1b;border:1px solid #fecaca;}
    .lm-act{width:28px;height:28px;border-radius:7px;border:1px solid #e2e8f0;background:#fff;display:inline-flex;align-items:center;justify-content:center;cursor:pointer;font-size:.72rem;color:var(--nd-muted);transition:all .15s;}
    .lm-act:hover{background:#f8fafc;color:var(--nd-navy);border-color:#cbd5e1;}
    .lm-act-view{color:var(--nd-navy) !important;}
    .lm-act-view:hover{background:rgba(30,58,95,.08) !important;}
    .lm-act-activate{color:var(--nd-green) !important;}
    .lm-act-activate:hover{background:rgba(22,163,74,.08) !important;}
    .lm-warn-box{display:flex;gap:.55rem;padding:.75rem 1rem;background:#fef2f2;border:1px solid #fecaca;border-radius:10px;font-size:.82rem;color:#991b1b;margin-bottom:1rem;}
    .lm-label{display:block;font-size:.7rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--nd-faint);margin-bottom:.35rem;}
    .lm-input{width:100%;padding:.55rem .85rem;border:1px solid #e2e8f0;border-radius:10px;font-size:.85rem;background:#fafbfd;transition:border .2s;resize:vertical;}
    .lm-input:focus{outline:none;border-color:var(--nd-amber);background:#fff;box-shadow:0 0 0 3px rgba(217,119,6,.08);}
    .lm-error{font-size:.72rem;color:var(--nd-red);margin-top:.25rem;}
    .lm-btn-activate{padding:.42rem 1rem;border-radius:8px;border:none;font-size:.84rem;font-weight:600;cursor:pointer;background:#16a34a;color:#fff;display:inline-flex;align-items:center;gap:.3rem;transition:all .15s;}
    .lm-btn-activate:hover{background:#15803d;}
    .lm-modal-xl{max-width:780px;width:95%;}
    .lm-detail-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem;}
    @media(max-width:640px){.lm-detail-grid{grid-template-columns:1fr;}}
    .lm-detail-section{background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:1rem;}
    .lm-detail-heading{font-size:.84rem;font-weight:700;color:var(--nd-navy);margin:0 0 .65rem;display:flex;align-items:center;gap:.35rem;}
    .lm-detail-heading i{color:var(--nd-amber);font-size:.72rem;}
    .lm-detail-row{display:flex;justify-content:space-between;align-items:center;font-size:.82rem;padding:.3rem 0;border-bottom:1px solid #f1f5f9;}
    .lm-detail-row:last-child{border-bottom:none;}
    .lm-detail-row span:first-child{color:var(--nd-muted);font-weight:500;}
    .lm-info-box{display:flex;gap:.55rem;padding:.65rem .85rem;background:#eff6ff;border:1px solid #bfdbfe;border-radius:10px;font-size:.82rem;color:#1e40af;margin-bottom:1rem;}
</style>
@endpush
@endonce

@can('manage-licenses')
<div class="nd-page">
    <div class="nd-hero">
        <div class="nd-hero-inner">
            <ul class="nd-breadcrumb">
                <li><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="sep">/</li>
                <li class="active">License Management</li>
            </ul>
            <div class="nd-hero-title">
                <h1><i class="fas fa-key"></i>License Management</h1>
                <p class="nd-hero-sub">View, monitor and manage village bank licenses</p>
            </div>
        </div>
    </div>

    <div class="nd-content">
        @if(session()->has('success'))
            <div class="lm-alert lm-alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif

        {{-- Stats --}}
        <div class="lm-stats">
            <div class="nd-stat">
                <div class="nd-stat-icon" style="background:rgba(30,58,95,.08);color:var(--nd-navy);"><i class="fas fa-key"></i></div>
                <div><div class="nd-stat-label">Total Licenses</div><div class="nd-stat-val" style="color:var(--nd-navy);">{{ $stats['total'] }}</div></div>
            </div>
            <div class="nd-stat">
                <div class="nd-stat-icon" style="background:rgba(22,163,74,.08);color:var(--nd-green);"><i class="fas fa-check-circle"></i></div>
                <div><div class="nd-stat-label">Active</div><div class="nd-stat-val" style="color:var(--nd-green);">{{ $stats['active'] }}</div></div>
            </div>
            <div class="nd-stat">
                <div class="nd-stat-icon" style="background:rgba(217,119,6,.08);color:var(--nd-amber);"><i class="fas fa-exclamation-triangle"></i></div>
                <div><div class="nd-stat-label">Expiring Soon</div><div class="nd-stat-val" style="color:var(--nd-amber);">{{ $stats['expiring'] }}</div></div>
            </div>
            <div class="nd-stat">
                <div class="nd-stat-icon" style="background:rgba(220,38,38,.08);color:var(--nd-red);"><i class="fas fa-ban"></i></div>
                <div><div class="nd-stat-label">Revoked</div><div class="nd-stat-val" style="color:var(--nd-red);">{{ $stats['revoked'] }}</div></div>
            </div>
            <div class="nd-stat">
                <div class="nd-stat-icon" style="background:rgba(22,163,74,.06);color:var(--nd-green);"><i class="fas fa-coins"></i></div>
                <div><div class="nd-stat-label">Revenue (Total)</div><div class="nd-stat-val" style="color:var(--nd-green);">K{{ number_format($revenue['total'], 2) }}</div></div>
            </div>
            <div class="nd-stat">
                <div class="nd-stat-icon" style="background:rgba(217,119,6,.06);color:var(--nd-amber);"><i class="fas fa-hourglass-half"></i></div>
                <div><div class="nd-stat-label">Pending Payments</div><div class="nd-stat-val" style="color:var(--nd-amber);">K{{ number_format($revenue['pending'], 2) }}</div></div>
            </div>
        </div>

        {{-- Table --}}
        <div class="nd-card">
            <div class="nd-card-header">
                <h3><i class="fas fa-list"></i> All Licenses</h3>
                <div class="nd-toolbar">
                    <select wire:model="statusFilter" class="nd-select" style="min-width:130px;">
                        <option value="">All Status</option><option value="active">Active</option><option value="expired">Expired</option><option value="revoked">Revoked</option>
                    </select>
                    <div class="nd-search"><i class="fas fa-search"></i>
                        <input type="text" wire:model.debounce.300ms="search" placeholder="Search license key, bank...">
                    </div>
                    <select wire:model="perPage" class="nd-select" style="min-width:75px;">
                        <option value="10">10</option><option value="25">25</option>
                    </select>
                </div>
            </div>
            <div style="overflow-x:auto;">
                <table class="nd-table">
                    <thead>
                        <tr><th>License Key</th><th>Village Bank</th><th>Plan</th><th>Status</th><th>Issued</th><th>Expires</th><th>Remaining</th><th style="width:80px;">Actions</th></tr>
                    </thead>
                    <tbody>
                        @forelse($licenses as $license)
                            @php
                                $daysLeft = $license->daysRemaining();
                                $isExpiringSoon = $license->status === 'active' && $daysLeft !== null && $daysLeft <= 14 && $daysLeft > 0;
                            @endphp
                            <tr class="{{ $isExpiringSoon ? 'lm-row-warn' : '' }}">
                                <td><span class="lm-code">{{ $license->license_key }}</span></td>
                                <td>
                                    @if($license->villageBank)
                                        <strong style="font-size:.86rem;">{{ $license->villageBank->name }}</strong>
                                    @else
                                        <span style="color:var(--nd-faint);">â€”</span>
                                    @endif
                                </td>
                                <td>
                                    @if($license->subscription && $license->subscription->plan)
                                        <span class="nd-badge lm-badge-plan">{{ $license->subscription->plan->name }}</span>
                                    @else
                                        <span style="color:var(--nd-faint);">â€”</span>
                                    @endif
                                </td>
                                <td>
                                    @if($license->status === 'active')
                                        <span class="nd-badge nd-badge-green"><i class="fas fa-check-circle" style="font-size:.55rem;margin-right:.2rem;"></i>Active</span>
                                    @elseif($license->status === 'expired')
                                        <span class="nd-badge lm-badge-expired"><i class="fas fa-clock" style="font-size:.55rem;margin-right:.2rem;"></i>Expired</span>
                                    @else
                                        <span class="nd-badge lm-badge-revoked"><i class="fas fa-ban" style="font-size:.55rem;margin-right:.2rem;"></i>Revoked</span>
                                    @endif
                                </td>
                                <td style="font-size:.8rem;color:var(--nd-muted);">{{ $license->issued_at ? $license->issued_at->format('d M Y') : 'â€”' }}</td>
                                <td style="font-size:.8rem;color:var(--nd-muted);">{{ $license->expires_at ? $license->expires_at->format('d M Y') : 'â€”' }}</td>
                                <td>
                                    @if($license->status === 'active' && $daysLeft !== null)
                                        @if($daysLeft <= 0)
                                            <strong style="color:var(--nd-red);font-size:.82rem;">Expired</strong>
                                        @elseif($daysLeft <= 14)
                                            <strong style="color:var(--nd-amber);font-size:.82rem;">{{ $daysLeft }} days</strong>
                                        @else
                                            <span style="color:var(--nd-green);font-size:.82rem;font-weight:600;">{{ $daysLeft }} days</span>
                                        @endif
                                    @else
                                        <span style="color:var(--nd-faint);">â€”</span>
                                    @endif
                                </td>
                                <td>
                                    <div style="display:flex;gap:4px;align-items:center;">
                                        <button type="button" wire:click="viewDetail({{ $license->id }})" class="lm-act lm-act-view" title="View Details"><i class="fas fa-eye"></i></button>
                                        @if($license->status === 'active')
                                            <button type="button" wire:click="openRevoke({{ $license->id }})" class="lm-act" title="Revoke License"><i class="fas fa-ban"></i></button>
                                        @endif
                                        @if($license->status === 'expired' || $license->status === 'revoked')
                                            <button type="button" wire:click="openActivate({{ $license->id }})" class="lm-act lm-act-activate" title="Activate License"><i class="fas fa-check-circle"></i></button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8"><div class="nd-empty"><i class="fas fa-key"></i><p>No licenses found</p></div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($licenses->hasPages())
                <div class="nd-footer">
                    <span>Showing {{ $licenses->firstItem() ?? 0 }} â€“ {{ $licenses->lastItem() ?? 0 }} of {{ $licenses->total() }}</span>
                    {{ $licenses->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- Revoke Modal --}}
    @if($showRevokeModal)
        <div class="nd-overlay" wire:click.self="$set('showRevokeModal', false)">
            <div class="nd-modal">
                <div class="nd-modal-head">
                    <h5><i class="fas fa-ban"></i> Revoke License</h5>
                    <button class="nd-modal-close" wire:click="$set('showRevokeModal', false)">&times;</button>
                </div>
                <div class="nd-modal-body">
                    <div class="lm-warn-box">
                        <i class="fas fa-exclamation-triangle" style="margin-top:.1rem;"></i>
                        <div><strong>Warning:</strong> Revoking a license will immediately block access for the village bank. The associated subscription will also be cancelled.</div>
                    </div>
                    <div>
                        <label class="lm-label">Reason for Revocation <span class="req">*</span></label>
                        <textarea wire:model.defer="revokeReason" class="lm-input" rows="3" placeholder="Explain why this license is being revoked..."></textarea>
                        @error('revokeReason') <div class="lm-error">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="nd-modal-foot">
                    <button type="button" wire:click="$set('showRevokeModal', false)" class="nd-btn-cancel">Cancel</button>
                    <button type="button" wire:click="revokeLicense" class="nd-btn-danger"><i class="fas fa-ban" style="margin-right:.3rem;"></i> Revoke License</button>
                </div>
            </div>
        </div>
    @endif

    {{-- Detail / View License Modal --}}
    @if($showDetailModal && $detailLicense)
        <div class="nd-overlay" wire:click.self="closeDetail">
            <div class="nd-modal lm-modal-xl">
                <div class="nd-modal-head">
                    <h5><i class="fas fa-id-card"></i> License Details</h5>
                    <button class="nd-modal-close" wire:click="closeDetail">&times;</button>
                </div>
                <div class="nd-modal-body" style="max-height:70vh;overflow-y:auto;">

                    {{-- License + Plan Info --}}
                    <div class="lm-detail-grid">
                        <div class="lm-detail-section">
                            <h6 class="lm-detail-heading"><i class="fas fa-key"></i> License</h6>
                            <div class="lm-detail-row"><span>Key:</span> <code class="lm-code">{{ $detailLicense->license_key }}</code></div>
                            <div class="lm-detail-row"><span>Status:</span>
                                @if($detailLicense->status === 'active' && $detailLicense->isValid())
                                    <span class="nd-badge nd-badge-green">Active</span>
                                @elseif($detailLicense->status === 'expired')
                                    <span class="nd-badge lm-badge-expired">Expired</span>
                                @else
                                    <span class="nd-badge lm-badge-revoked">Revoked</span>
                                @endif
                            </div>
                            <div class="lm-detail-row"><span>Issued:</span> {{ $detailLicense->issued_at ? $detailLicense->issued_at->format('d M Y') : '—' }}</div>
                            <div class="lm-detail-row"><span>Expires:</span> {{ $detailLicense->expires_at ? $detailLicense->expires_at->format('d M Y') : '—' }}</div>
                            <div class="lm-detail-row"><span>Days Remaining:</span>
                                @if($detailLicense->isValid())
                                    <strong style="color:var(--nd-green);">{{ $detailLicense->daysRemaining() }} days</strong>
                                @else
                                    <strong style="color:var(--nd-red);">Expired</strong>
                                @endif
                            </div>
                            @if($detailLicense->revoke_reason)
                                <div class="lm-detail-row"><span>Revoke Reason:</span> <em style="color:var(--nd-red);">{{ $detailLicense->revoke_reason }}</em></div>
                            @endif
                        </div>

                        <div class="lm-detail-section">
                            <h6 class="lm-detail-heading"><i class="fas fa-university"></i> Village Bank</h6>
                            @if($detailLicense->villageBank)
                                <div class="lm-detail-row"><span>Name:</span> <strong>{{ $detailLicense->villageBank->name }}</strong></div>
                                <div class="lm-detail-row"><span>Code:</span> {{ $detailLicense->villageBank->code ?? '—' }}</div>
                                <div class="lm-detail-row"><span>Email:</span> {{ $detailLicense->villageBank->email ?? '—' }}</div>
                                <div class="lm-detail-row"><span>Phone:</span> {{ $detailLicense->villageBank->phone ?? '—' }}</div>
                                <div class="lm-detail-row"><span>Status:</span> <span style="text-transform:capitalize;">{{ $detailLicense->villageBank->status }}</span></div>
                            @else
                                <p style="color:var(--nd-faint);font-size:.84rem;">No village bank linked.</p>
                            @endif
                        </div>
                    </div>

                    {{-- Plan & Usage --}}
                    <div class="lm-detail-grid" style="margin-top:1rem;">
                        <div class="lm-detail-section">
                            <h6 class="lm-detail-heading"><i class="fas fa-crown"></i> Plan</h6>
                            @if($detailLicense->subscription && $detailLicense->subscription->plan)
                                @php $p = $detailLicense->subscription->plan; @endphp
                                <div class="lm-detail-row"><span>Plan:</span> <strong>{{ $p->name }}</strong></div>
                                <div class="lm-detail-row"><span>Price:</span> K{{ number_format($p->price, 2) }} {{ $p->cycleName() }}</div>
                                <div class="lm-detail-row"><span>Duration:</span> {{ $p->duration_days }} days</div>
                                <div class="lm-detail-row"><span>Max Members:</span> {{ $p->max_members ?? 'Unlimited' }}</div>
                                <div class="lm-detail-row"><span>Max Circles:</span> {{ $p->max_circles ?? 'Unlimited' }}</div>
                            @else
                                <p style="color:var(--nd-faint);font-size:.84rem;">No plan assigned.</p>
                            @endif
                        </div>

                        <div class="lm-detail-section">
                            <h6 class="lm-detail-heading"><i class="fas fa-chart-pie"></i> Usage</h6>
                            @if($detailUsage)
                                <div class="lm-detail-row"><span>Members:</span> {{ $detailUsage['members']['current'] }} / {{ $detailUsage['members']['max'] ?? '∞' }}</div>
                                <div class="lm-detail-row"><span>Circles:</span> {{ $detailUsage['circles']['current'] }} / {{ $detailUsage['circles']['max'] ?? '∞' }}</div>
                                <div class="lm-detail-row"><span>License Valid:</span>
                                    @if($detailUsage['has_license'])
                                        <span style="color:var(--nd-green);"><i class="fas fa-check"></i> Yes</span>
                                    @else
                                        <span style="color:var(--nd-red);"><i class="fas fa-times"></i> No</span>
                                    @endif
                                </div>
                            @else
                                <p style="color:var(--nd-faint);font-size:.84rem;">No usage data.</p>
                            @endif
                        </div>
                    </div>

                    {{-- Payment History --}}
                    @if(count($detailPayments) > 0)
                        <div style="margin-top:1.25rem;">
                            <h6 class="lm-detail-heading"><i class="fas fa-receipt"></i> Payment History</h6>
                            <div style="overflow-x:auto;">
                                <table class="nd-table" style="font-size:.82rem;">
                                    <thead>
                                        <tr><th>Date</th><th>Amount</th><th>Reference</th><th>Proof</th><th>Status</th><th>Paid By</th><th>Reviewed By</th><th>Remarks</th></tr>
                                    </thead>
                                    <tbody>
                                        @foreach($detailPayments as $dp)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($dp['created_at'])->format('d M Y') }}</td>
                                                <td><strong>K{{ number_format($dp['amount'], 2) }}</strong></td>
                                                <td><code style="font-size:.78rem;">{{ $dp['reference'] }}</code></td>
                                                <td>
                                                    @if($dp['proof_file'])
                                                        <a href="{{ asset('storage/' . $dp['proof_file']) }}" target="_blank" style="color:var(--nd-primary);font-size:.8rem;"><i class="fas fa-file-download"></i> View</a>
                                                    @else —
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($dp['status'] === 'pending')
                                                        <span class="nd-badge" style="background:#fef3c7;color:#92400e;">Pending</span>
                                                    @elseif($dp['status'] === 'confirmed')
                                                        <span class="nd-badge nd-badge-green">Confirmed</span>
                                                    @else
                                                        <span class="nd-badge" style="background:#fee2e2;color:#991b1b;">Rejected</span>
                                                    @endif
                                                </td>
                                                <td>{{ $dp['payer']['name'] ?? '—' }}</td>
                                                <td>{{ $dp['reviewer']['name'] ?? '—' }}</td>
                                                <td style="max-width:150px;">{{ $dp['admin_remarks'] ?? '—' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="nd-modal-foot">
                    @if($detailLicense->status !== 'active')
                        <button type="button" wire:click="activateFromDetail" class="lm-btn-activate"><i class="fas fa-check-circle"></i> Activate</button>
                    @endif
                    @if($detailLicense->status === 'active')
                        <button type="button" wire:click="revokeFromDetail" class="nd-btn-danger"><i class="fas fa-ban"></i> Revoke</button>
                    @endif
                    <button type="button" wire:click="closeDetail" class="nd-btn-cancel">Close</button>
                </div>
            </div>
        </div>
    @endif

    {{-- Activate License Modal --}}
    @if($showActivateModal)
        <div class="nd-overlay" wire:click.self="$set('showActivateModal', false)">
            <div class="nd-modal">
                <div class="nd-modal-head" style="background:linear-gradient(135deg,#166534,#16a34a);color:#fff;">
                    <h5><i class="fas fa-check-circle"></i> Activate License</h5>
                    <button class="nd-modal-close" wire:click="$set('showActivateModal', false)" style="color:#fff;">&times;</button>
                </div>
                <div class="nd-modal-body">
                    <div class="lm-info-box">
                        <i class="fas fa-info-circle" style="margin-top:2px;color:#2563eb;"></i>
                        <span>This will activate (or reactivate) the license and its subscription for the specified number of days starting from today.</span>
                    </div>
                    <div style="margin-top:1rem;">
                        <label class="lm-label">Duration (days) <span class="req">*</span></label>
                        <input type="number" wire:model.defer="activateDays" class="lm-input" min="1" max="3650" placeholder="e.g. 365">
                        @error('activateDays') <div class="lm-error">{{ $message }}</div> @enderror
                        <small style="color:var(--nd-faint);font-size:.76rem;">The license will be valid from today until {{ now()->addDays($activateDays ?? 365)->format('d M Y') }}</small>
                    </div>
                </div>
                <div class="nd-modal-foot">
                    <button type="button" wire:click="$set('showActivateModal', false)" class="nd-btn-cancel">Cancel</button>
                    <button type="button" wire:click="activateLicense" class="lm-btn-activate"><i class="fas fa-check-circle" style="margin-right:.3rem;"></i> Activate License</button>
                </div>
            </div>
        </div>
    @endif
</div>
@else
    @include('livewire.partials.unauthorized')
@endcan

</div>
