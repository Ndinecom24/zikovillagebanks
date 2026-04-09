<div>

@can('review-applications')
<div class="nd-page">
    <div class="nd-hero">
        <div class="nd-hero-inner">
            <ul class="nd-breadcrumb">
                <li><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="sep">/</li>
                <li class="active">Bank Applications</li>
            </ul>
            <div class="nd-hero-title">
                <h1><i class="fas fa-file-signature"></i>Bank Applications</h1>
                <p class="nd-hero-sub">Review and approve village bank registration applications</p>
            </div>
        </div>
    </div>

    <div class="nd-content">
        @if(session()->has('success'))
            <div class="ar-alert ar-alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if(session()->has('error'))
            <div class="ar-alert ar-alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
        @endif

        <div class="nd-card">
            <div class="nd-card-header">
                <h3><i class="fas fa-list"></i> All Applications</h3>
                <div class="nd-toolbar">
                    <select wire:model="statusFilter" class="nd-select" style="min-width:130px;">
                        <option value="">All Status</option><option value="pending">Pending</option><option value="approved">Approved</option><option value="rejected">Rejected</option>
                    </select>
                    <div class="nd-search"><i class="fas fa-search"></i>
                        <input type="text" wire:model.debounce.300ms="search" placeholder="Search name, email, ref...">
                    </div>
                    <select wire:model="perPage" class="nd-select" style="min-width:75px;">
                        <option value="10">10</option><option value="25">25</option>
                    </select>
                </div>
            </div>
            <div style="overflow-x:auto;">
                <table class="nd-table">
                    <thead>
                        <tr><th>Bank Name</th><th>Contact Person</th><th>Plan</th><th>Payment Ref</th><th>Status</th><th>Date</th><th style="width:160px;">Actions</th></tr>
                    </thead>
                    <tbody>
                        @forelse($applications as $app)
                            <tr>
                                <td>
                                    <div style="font-weight:700;">{{ $app->bank_name }}</div>
                                    <div style="font-size:.76rem;color:var(--nd-muted);">{{ $app->bank_email }}</div>
                                </td>
                                <td>
                                    <div style="font-size:.86rem;">{{ $app->contact_name }}</div>
                                    <div style="font-size:.76rem;color:var(--nd-muted);">{{ $app->contact_email }}</div>
                                </td>
                                <td>
                                    @if($app->plan)
                                        <span class="nd-badge ar-badge-plan">{{ $app->plan->name }}</span>
                                    @else <span style="color:var(--nd-faint);">â€”</span>
                                    @endif
                                </td>
                                <td><span class="ar-code">{{ $app->payment_reference }}</span></td>
                                <td>
                                    @if($app->status === 'pending')
                                        <span class="nd-badge ar-badge-pending"><i class="fas fa-clock" style="font-size:.55rem;margin-right:.2rem;"></i>Pending</span>
                                    @elseif($app->status === 'approved')
                                        <span class="nd-badge ar-badge-approved"><i class="fas fa-check" style="font-size:.55rem;margin-right:.2rem;"></i>Approved</span>
                                    @else
                                        <span class="nd-badge ar-badge-rejected"><i class="fas fa-times" style="font-size:.55rem;margin-right:.2rem;"></i>Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    <div style="font-size:.8rem;color:var(--nd-muted);">{{ $app->created_at->format('d M Y') }}</div>
                                    <div style="font-size:.72rem;color:var(--nd-faint);">{{ $app->created_at->diffForHumans() }}</div>
                                </td>
                                <td>
                                    <div class="ar-actions">
                                        <button wire:click="viewDetail({{ $app->id }})" class="ar-act ar-act-view" title="View Details"><i class="fas fa-eye"></i></button>
                                        @if($app->status === 'pending')
                                            <button wire:click="openReview({{ $app->id }}, 'approve')" class="ar-act ar-act-approve" title="Approve"><i class="fas fa-check-circle"></i></button>
                                            <button wire:click="openReview({{ $app->id }}, 'reject')" class="ar-act ar-act-reject" title="Reject"><i class="fas fa-times-circle"></i></button>
                                        @endif
                                        @if($app->proof_file)
                                            <a href="{{ asset('storage/' . $app->proof_file) }}" target="_blank" class="ar-act ar-act-file" title="View Proof"><i class="fas fa-file-download"></i></a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7"><div class="nd-empty"><i class="fas fa-file-signature"></i><p>No applications found</p></div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($applications->hasPages())
                <div class="nd-footer">
                    <span>Showing {{ $applications->firstItem() ?? 0 }} â€“ {{ $applications->lastItem() ?? 0 }} of {{ $applications->total() }}</span>
                    {{ $applications->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- Detail Modal --}}
    @if($showDetailModal && $detailApp)
        <div class="nd-overlay" wire:click.self="$set('showDetailModal', false)">
            <div class="nd-modal ar-modal-lg">
                <div class="nd-modal-head">
                    <h5><i class="fas fa-eye"></i> Application Details</h5>
                    <button class="nd-modal-close" wire:click="$set('showDetailModal', false)">&times;</button>
                </div>
                <div class="nd-modal-body">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;">
                        <div>
                            <div class="ar-section-title"><i class="fas fa-building"></i> Bank Information</div>
                            <div class="nd-info-row"><div class="ar-info-label">Name</div><div class="nd-info-value"><strong>{{ $detailApp->bank_name }}</strong></div></div>
                            <div class="nd-info-row"><div class="ar-info-label">Code</div><div class="nd-info-value">{{ $detailApp->bank_code ?: 'â€”' }}</div></div>
                            <div class="nd-info-row"><div class="ar-info-label">Email</div><div class="nd-info-value">{{ $detailApp->bank_email }}</div></div>
                            <div class="nd-info-row"><div class="ar-info-label">Phone</div><div class="nd-info-value">{{ $detailApp->bank_phone }}</div></div>
                            <div class="nd-info-row"><div class="ar-info-label">Address</div><div class="nd-info-value">{{ $detailApp->bank_address ?: 'â€”' }}</div></div>
                            <div class="nd-info-row"><div class="ar-info-label">Description</div><div class="nd-info-value">{{ $detailApp->bank_description ?: 'â€”' }}</div></div>
                        </div>
                        <div>
                            <div class="ar-section-title"><i class="fas fa-user-tie"></i> Contact Person</div>
                            <div class="nd-info-row"><div class="ar-info-label">Name</div><div class="nd-info-value"><strong>{{ $detailApp->contact_name }}</strong></div></div>
                            <div class="nd-info-row"><div class="ar-info-label">Email</div><div class="nd-info-value">{{ $detailApp->contact_email }}</div></div>
                            <div class="nd-info-row"><div class="ar-info-label">Phone</div><div class="nd-info-value">{{ $detailApp->contact_phone }}</div></div>
                            <div class="nd-info-row"><div class="ar-info-label">Username</div><div class="nd-info-value">{{ $detailApp->contact_staff_no ?: 'â€”' }}</div></div>

                            <div class="ar-section-title" style="margin-top:1.25rem;"><i class="fas fa-credit-card"></i> Payment</div>
                            <div class="nd-info-row"><div class="ar-info-label">Plan</div><div class="nd-info-value">{{ $detailApp->plan ? $detailApp->plan->name : 'â€”' }}</div></div>
                            <div class="nd-info-row"><div class="ar-info-label">Reference</div><div class="nd-info-value"><span class="ar-code">{{ $detailApp->payment_reference }}</span></div></div>
                            <div class="nd-info-row">
                                <div class="ar-info-label">Proof</div>
                                <div class="nd-info-value">
                                    @if($detailApp->proof_file)
                                        <a href="{{ asset('storage/' . $detailApp->proof_file) }}" target="_blank" style="color:var(--ar-blue);font-size:.82rem;text-decoration:none;font-weight:600;">
                                            <i class="fas fa-download" style="margin-right:.2rem;"></i>View File
                                        </a>
                                    @else â€”
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($detailApp->status !== 'pending')
                        <div style="margin-top:1.25rem;padding-top:1rem;border-top:1px solid var(--nd-border);">
                            <div class="ar-section-title"><i class="fas fa-gavel"></i> Review Decision</div>
                            <div style="display:flex;align-items:flex-start;gap:.75rem;">
                                <span class="nd-badge {{ $detailApp->status === 'approved' ? 'ar-badge-approved' : 'ar-badge-rejected' }}" style="font-size:.78rem;">
                                    {{ ucfirst($detailApp->status) }}
                                </span>
                                <div style="font-size:.84rem;">
                                    <div style="color:var(--nd-text);">{{ $detailApp->admin_remarks ?: 'â€”' }}</div>
                                    <div style="color:var(--nd-faint);font-size:.76rem;margin-top:.2rem;">
                                        By {{ $detailApp->reviewer ? $detailApp->reviewer->name : 'â€”' }}
                                        on {{ $detailApp->reviewed_at ? $detailApp->reviewed_at->format('d M Y H:i') : 'â€”' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="nd-modal-foot">
                    <button wire:click="$set('showDetailModal', false)" class="nd-btn-cancel">Close</button>
                    @if($detailApp->status === 'pending')
                        <button wire:click="openReview({{ $detailApp->id }}, 'approve')" class="ar-btn-approve"><i class="fas fa-check" style="margin-right:.3rem;"></i>Approve</button>
                        <button wire:click="openReview({{ $detailApp->id }}, 'reject')" class="ar-btn-reject"><i class="fas fa-times" style="margin-right:.3rem;"></i>Reject</button>
                    @endif
                </div>
            </div>
        </div>
    @endif

    {{-- Review Modal --}}
    @if($showReviewModal)
        <div class="nd-overlay" wire:click.self="$set('showReviewModal', false)">
            <div class="nd-modal ar-modal-md">
                <div class="nd-modal-head {{ $reviewAction === 'approve' ? 'nd-modal-head-green' : 'nd-modal-head-red' }}">
                    <h5><i class="fas fa-{{ $reviewAction === 'approve' ? 'check-circle' : 'times-circle' }}"></i> {{ $reviewAction === 'approve' ? 'Approve Application' : 'Reject Application' }}</h5>
                    <button class="nd-modal-close" wire:click="$set('showReviewModal', false)">&times;</button>
                </div>
                <div class="nd-modal-body">
                    @if($reviewAction === 'approve')
                        <div class="ar-info-box ar-info-box-blue">
                            <i class="fas fa-info-circle" style="margin-top:.1rem;flex-shrink:0;"></i>
                            <div>Approving will automatically:
                                <ul style="margin:.35rem 0 0;padding-left:1.25rem;"><li>Create a village bank account</li><li>Create a user login for the contact person</li><li>Activate the subscription</li><li>Generate a license key</li></ul>
                            </div>
                        </div>
                    @endif
                    <div>
                        <label class="ar-label">Admin Remarks @if($reviewAction === 'reject')<span class="req">*</span>@endif</label>
                        <textarea wire:model.defer="adminRemarks" class="ar-input" rows="3" placeholder="{{ $reviewAction === 'approve' ? 'Optional notes...' : 'Please provide a reason for rejection...' }}"></textarea>
                        @error('adminRemarks') <div class="ar-error">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="nd-modal-foot">
                    <button wire:click="$set('showReviewModal', false)" class="nd-btn-cancel">Cancel</button>
                    <button wire:click="submitReview" class="{{ $reviewAction === 'approve' ? 'ar-btn-approve' : 'ar-btn-reject' }}">
                        <i class="fas fa-{{ $reviewAction === 'approve' ? 'check' : 'times' }}" style="margin-right:.3rem;"></i>
                        {{ $reviewAction === 'approve' ? 'Approve & Create' : 'Reject Application' }}
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
@else
    @include('livewire.partials.unauthorized')
@endcan
</div>
