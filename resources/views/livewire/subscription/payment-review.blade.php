<div>
@push('custom-styles')
<style>
/* ═══ Payment Review (pr-*) ═══ */
.pr-alert{display:flex;align-items:center;gap:.5rem;padding:.65rem 1rem;border-radius:10px;font-size:.84rem;font-weight:600;margin-bottom:1rem;}
.pr-alert-success{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;}
.pr-alert-error{background:#fef2f2;color:#991b1b;border:1px solid #fecaca;}
.pr-badge-plan{background:#eff6ff;color:#1e40af;border:1px solid #bfdbfe;font-size:.72rem;padding:.12rem .4rem;border-radius:5px;}
.pr-amount{font-weight:700;color:var(--nd-green,#16a34a);font-size:.9rem;}
.pr-code{font-family:monospace;font-size:.82rem;color:var(--nd-navy,#1E3A5F);background:#f1f5f9;padding:.15rem .4rem;border-radius:4px;}
.pr-badge-pending{background:#fffbeb;color:#92400e;border:1px solid #fde68a;}
.pr-badge-confirmed{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;}
.pr-badge-rejected{background:#fef2f2;color:#991b1b;border:1px solid #fecaca;}
.pr-actions{display:flex;align-items:center;gap:.35rem;}
.pr-act{width:28px;height:28px;border-radius:6px;border:1px solid #e5e7eb;background:#fff;display:inline-flex;align-items:center;justify-content:center;font-size:.72rem;cursor:pointer;transition:all .15s;text-decoration:none;}
.pr-act:hover{border-color:#cbd5e1;}
.pr-act-view{color:var(--nd-navy,#1E3A5F);}
.pr-act-view:hover{background:rgba(30,58,95,.08);}
.pr-act-confirm{color:var(--nd-green,#16a34a);}
.pr-act-confirm:hover{background:#f0fdf4;border-color:#bbf7d0;}
.pr-act-reject{color:var(--nd-red,#dc2626);}
.pr-act-reject:hover{background:#fef2f2;border-color:#fecaca;}
.pr-reviewer{font-size:.72rem;color:var(--nd-faint,#94a3b8);margin-top:.3rem;}
.pr-info-box{display:flex;gap:.5rem;padding:.65rem .85rem;border-radius:8px;font-size:.82rem;margin-bottom:1rem;}
.pr-info-box-blue{background:#eff6ff;border:1px solid #bfdbfe;color:#1e40af;}
.pr-info-box-amber{background:#fffbeb;border:1px solid #fde68a;color:#92400e;}
.pr-label{display:block;font-size:.76rem;font-weight:700;color:var(--nd-navy,#1E3A5F);text-transform:uppercase;letter-spacing:.4px;margin-bottom:.3rem;}
.pr-label .req{color:var(--nd-red,#dc2626);}
.pr-input{width:100%;padding:.5rem .75rem;border:1px solid #d1d5db;border-radius:8px;font-size:.86rem;background:#fff;transition:border-color .15s,box-shadow .15s;}
.pr-input:focus{outline:none;border-color:var(--nd-navy,#1E3A5F);box-shadow:0 0 0 3px rgba(30,58,95,.1);}
.pr-error{color:var(--nd-red,#dc2626);font-size:.74rem;margin-top:.2rem;}
.pr-btn-confirm{padding:.45rem 1.1rem;border-radius:8px;border:none;font-size:.84rem;font-weight:600;cursor:pointer;background:#16a34a;color:#fff;display:inline-flex;align-items:center;gap:.3rem;transition:opacity .15s;}
.pr-btn-confirm:hover{opacity:.9;}
.pr-btn-reject{padding:.45rem 1.1rem;border-radius:8px;border:none;font-size:.84rem;font-weight:600;cursor:pointer;background:var(--nd-red,#dc2626);color:#fff;display:inline-flex;align-items:center;gap:.3rem;transition:opacity .15s;}
.pr-btn-reject:hover{opacity:.9;}
</style>
@endpush
@can('manage-subscriptions')
<div class="nd-page">
    {{-- â•â•â•â•â•â•â• HERO â•â•â•â•â•â•â• --}}
    <div class="nd-hero">
        <div class="nd-hero-inner">
            <ul class="nd-breadcrumb">
                <li><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="sep">/</li>
                <li class="active">Payment Review</li>
            </ul>
            <div class="nd-hero-title">
                <h1><i class="fas fa-money-check-alt"></i>Payment Review</h1>
                <p class="nd-hero-sub">Confirm or reject subscription payment proofs submitted by village banks</p>
            </div>
        </div>
    </div>

    {{-- â•â•â•â•â•â•â• CONTENT â•â•â•â•â•â•â• --}}
    <div class="nd-content">
        @if(session()->has('success'))
            <div class="pr-alert pr-alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if(session()->has('error'))
            <div class="pr-alert pr-alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
        @endif

        {{-- â”€â”€ Payments Table Card â”€â”€ --}}
        <div class="nd-card">
            <div class="nd-card-header">
                <h3><i class="fas fa-receipt"></i> Payments</h3>
                <div class="nd-toolbar">
                    <div class="nd-search">
                        <i class="fas fa-search"></i>
                        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search reference, bank, payer...">
                    </div>
                    <select wire:model.live="statusFilter" class="nd-select">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="rejected">Rejected</option>
                    </select>
                    <select wire:model.live="perPage" class="nd-select" style="width:72px;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                </div>
            </div>

            <div style="overflow-x:auto;">
                <table class="nd-table">
                    <thead>
                        <tr>
                            <th>Village Bank</th>
                            <th>Paid By</th>
                            <th>Amount</th>
                            <th>Reference</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $payment)
                            <tr>
                                <td>
                                    @if($payment->subscription && $payment->subscription->villageBank)
                                        <strong>{{ $payment->subscription->villageBank->name }}</strong>
                                        @if($payment->subscription->plan)
                                            <br><span class="nd-badge pr-badge-plan">{{ $payment->subscription->plan->name }}</span>
                                        @endif
                                    @else
                                        <span style="color:var(--nd-faint);">â€”</span>
                                    @endif
                                </td>
                                <td>
                                    @if($payment->payer)
                                        <strong>{{ $payment->payer->name }}</strong>
                                    @else
                                        <span style="color:var(--nd-faint);">â€”</span>
                                    @endif
                                </td>
                                <td><span class="pr-amount">K{{ number_format($payment->amount, 2) }}</span></td>
                                <td><span class="pr-code">{{ $payment->reference }}</span></td>
                                <td>
                                    @if($payment->status === 'pending')
                                        <span class="nd-badge pr-badge-pending"><i class="fas fa-clock" style="margin-right:3px;font-size:.62rem;"></i>Pending</span>
                                    @elseif($payment->status === 'confirmed')
                                        <span class="nd-badge pr-badge-confirmed"><i class="fas fa-check" style="margin-right:3px;font-size:.62rem;"></i>Confirmed</span>
                                    @else
                                        <span class="nd-badge pr-badge-rejected"><i class="fas fa-times" style="margin-right:3px;font-size:.62rem;"></i>Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    <span style="font-size:.84rem;">{{ $payment->created_at->format('d M Y') }}</span>
                                    <br><span style="font-size:.72rem;color:var(--nd-faint);">{{ $payment->created_at->diffForHumans() }}</span>
                                </td>
                                <td>
                                    <div class="pr-actions" style="justify-content:flex-end;">
                                        @if($payment->proof_file)
                                            <a href="{{ asset('storage/' . $payment->proof_file) }}" target="_blank" class="pr-act pr-act-view" title="View Proof">
                                                <i class="fas fa-file-download"></i>
                                            </a>
                                        @endif
                                        @if($payment->status === 'pending')
                                            <button wire:click="openReview({{ $payment->id }}, 'confirm')" class="pr-act pr-act-confirm" title="Confirm Payment">
                                                <i class="fas fa-check-circle"></i>
                                            </button>
                                            <button wire:click="openReview({{ $payment->id }}, 'reject')" class="pr-act pr-act-reject" title="Reject Payment">
                                                <i class="fas fa-times-circle"></i>
                                            </button>
                                        @endif
                                    </div>
                                    @if($payment->reviewer)
                                        <div class="pr-reviewer">
                                            <i class="fas fa-user-check" style="margin-right:2px;"></i> {{ $payment->reviewer->name }}
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="nd-empty">
                                        <i class="fas fa-inbox"></i>
                                        No payments found matching your criteria.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($payments->hasPages())
                <div class="nd-footer">
                    <span>Showing {{ $payments->firstItem() }}â€“{{ $payments->lastItem() }} of {{ $payments->total() }}</span>
                    {{ $payments->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

{{-- â•â•â•â•â•â•â• REVIEW MODAL â•â•â•â•â•â•â• --}}
@if($showReviewModal)
    <div class="nd-overlay" wire:click.self="$set('showReviewModal', false)">
        <div class="nd-modal">
            <div class="nd-modal-head {{ $reviewAction === 'confirm' ? 'nd-modal-head-green' : 'nd-modal-head-red' }}">
                <h5>
                    <i class="fas fa-{{ $reviewAction === 'confirm' ? 'check-circle' : 'times-circle' }}"></i>
                    {{ $reviewAction === 'confirm' ? 'Confirm Payment' : 'Reject Payment' }}
                </h5>
                <button class="nd-modal-close" wire:click="$set('showReviewModal', false)">&times;</button>
            </div>
            <div class="nd-modal-body">
                @if($reviewAction === 'confirm')
                    <div class="pr-info-box pr-info-box-blue">
                        <i class="fas fa-info-circle" style="margin-top:2px;"></i>
                        <span>Confirming this payment will <strong>activate or extend</strong> the subscription and license automatically.</span>
                    </div>
                @else
                    <div class="pr-info-box pr-info-box-amber">
                        <i class="fas fa-exclamation-triangle" style="margin-top:2px;"></i>
                        <span>Please provide a reason for rejecting this payment. The applicant will be notified.</span>
                    </div>
                @endif

                <div style="margin-bottom:1rem;">
                    <label class="pr-label">
                        Admin Remarks
                        @if($reviewAction === 'reject') <span class="req">*</span> @endif
                    </label>
                    <textarea wire:model="adminRemarks" class="pr-input" rows="3"
                        placeholder="{{ $reviewAction === 'confirm' ? 'Optional notes about this confirmation...' : 'Reason for rejection (required)...' }}"></textarea>
                    @error('adminRemarks') <div class="pr-error">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="nd-modal-foot">
                <button class="nd-btn-cancel" wire:click="$set('showReviewModal', false)">Cancel</button>
                <button wire:click="submitReview" class="{{ $reviewAction === 'confirm' ? 'pr-btn-confirm' : 'pr-btn-reject' }}">
                    <i class="fas fa-{{ $reviewAction === 'confirm' ? 'check' : 'times' }}" style="margin-right:4px;"></i>
                    {{ $reviewAction === 'confirm' ? 'Confirm Payment' : 'Reject Payment' }}
                </button>
            </div>
        </div>
    </div>
@endif
@else
    @include('livewire.partials.unauthorized')
@endcan
</div>
