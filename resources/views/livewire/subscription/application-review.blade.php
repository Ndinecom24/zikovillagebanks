<div>
    @push('custom-styles')
    <style>
        :root {
            --ar-navy:#1E3A5F;--ar-navy-light:#2B6B96;--ar-amber:#D97706;--ar-amber-light:#F59E0B;
            --ar-bg:#f4f6fa;--ar-card:#fff;--ar-border:#edf0f7;--ar-text:#1e293b;
            --ar-muted:#64748b;--ar-faint:#94a3b8;--ar-green:#16a34a;--ar-red:#dc2626;--ar-blue:#2563eb;
            --ar-radius:16px;
        }
        .ar-page{background:var(--ar-bg);min-height:100vh;}
        .ar-hero{background:linear-gradient(135deg,var(--ar-navy) 0%,#234b78 50%,var(--ar-navy-light) 100%);padding:1.75rem 0 6rem;position:relative;overflow:hidden;}
        .ar-hero::before{content:'';position:absolute;width:600px;height:600px;top:-60%;right:-8%;background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%);border-radius:50%;pointer-events:none;}
        .ar-hero-inner{position:relative;z-index:2;padding:0 1.5rem;}
        .ar-breadcrumb{display:flex;gap:.5rem;list-style:none;padding:0;margin:0 0 .75rem;font-size:.82rem;}
        .ar-breadcrumb a{color:rgba(255,255,255,.55);text-decoration:none;}
        .ar-breadcrumb a:hover{color:rgba(255,255,255,.85);}
        .ar-breadcrumb .active{color:var(--ar-amber-light);font-weight:600;}
        .ar-breadcrumb .sep{color:rgba(255,255,255,.25);}
        .ar-hero-title h1{color:#fff;font-size:1.6rem;font-weight:800;margin:0;}
        .ar-hero-title h1 i{color:var(--ar-amber);margin-right:.5rem;}
        .ar-hero-sub{color:rgba(255,255,255,.55);font-size:.88rem;margin:.25rem 0 0;}
        .ar-content{margin-top:-4rem;position:relative;z-index:10;padding:0 1.5rem 2rem;}
        .ar-card{background:var(--ar-card);border-radius:var(--ar-radius);border:1px solid var(--ar-border);box-shadow:0 2px 12px rgba(0,0,0,.04);overflow:hidden;}
        .ar-card-header{padding:1rem 1.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;border-bottom:1px solid var(--ar-border);}
        .ar-card-title{font-size:.95rem;font-weight:700;color:var(--ar-text);display:flex;align-items:center;gap:.4rem;margin:0;}
        .ar-card-title i{color:var(--ar-amber);font-size:.8rem;}
        .ar-toolbar{display:flex;align-items:center;flex-wrap:wrap;gap:.6rem;}
        .ar-search{position:relative;}
        .ar-search i{position:absolute;left:.75rem;top:50%;transform:translateY(-50%);font-size:.72rem;color:var(--ar-faint);}
        .ar-search input{padding:.45rem .75rem .45rem 2rem;border:1px solid var(--ar-border);border-radius:10px;font-size:.82rem;background:#fafbfd;width:220px;transition:border .2s;}
        .ar-search input:focus{outline:none;border-color:var(--ar-amber);background:#fff;box-shadow:0 0 0 3px rgba(217,119,6,.08);}
        .ar-select{padding:.45rem .75rem;border:1px solid var(--ar-border);border-radius:10px;font-size:.82rem;background:#fafbfd;cursor:pointer;}
        .ar-select:focus{outline:none;border-color:var(--ar-amber);}
        .ar-alert{padding:.7rem 1rem;border-radius:12px;font-size:.84rem;display:flex;align-items:center;gap:.5rem;margin-bottom:1rem;font-weight:600;}
        .ar-alert-success{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;}
        .ar-alert-error{background:#fef2f2;color:#991b1b;border:1px solid #fecaca;}
        .ar-table{width:100%;border-collapse:collapse;}
        .ar-table thead th{font-size:.62rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--ar-faint);padding:.7rem 1rem;border-bottom:1px solid var(--ar-border);background:#fafbfd;white-space:nowrap;}
        .ar-table tbody td{padding:.7rem 1rem;border-bottom:1px solid #f5f7fa;font-size:.84rem;vertical-align:middle;}
        .ar-table tbody tr:last-child td{border-bottom:none;}
        .ar-table tbody tr:hover{background:#fafbfd;}
        .ar-badge{display:inline-flex;align-items:center;gap:.25rem;padding:.2rem .55rem;border-radius:8px;font-size:.68rem;font-weight:700;}
        .ar-badge-plan{background:#eff6ff;color:#1e40af;border:1px solid #bfdbfe;}
        .ar-badge-pending{background:#fffbeb;color:#92400e;border:1px solid #fde68a;}
        .ar-badge-approved{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;}
        .ar-badge-rejected{background:#fef2f2;color:#991b1b;border:1px solid #fecaca;}
        .ar-code{font-family:monospace;font-size:.82rem;color:var(--ar-navy);background:#f1f5f9;padding:.15rem .4rem;border-radius:4px;}
        .ar-act{width:28px;height:28px;border-radius:6px;border:1px solid #e5e7eb;background:#fff;display:inline-flex;align-items:center;justify-content:center;font-size:.72rem;cursor:pointer;transition:all .15s;text-decoration:none;color:var(--ar-navy);}
        .ar-act:hover{background:rgba(30,58,95,.08);border-color:#cbd5e1;}
        .ar-footer{padding:.85rem 1.5rem;border-top:1px solid var(--ar-border);display:flex;align-items:center;justify-content:space-between;font-size:.78rem;color:var(--ar-muted);flex-wrap:wrap;gap:.5rem;}
        .ar-empty{padding:3rem 1rem;text-align:center;color:var(--ar-faint);}
        .ar-empty i{font-size:2.5rem;margin-bottom:.75rem;display:block;opacity:.4;}
        .ar-empty p{margin:0;font-size:.88rem;}
        .ar-detail-card{background:var(--ar-card);border-radius:var(--ar-radius);border:1px solid var(--ar-border);box-shadow:0 2px 12px rgba(0,0,0,.04);overflow:hidden;}
        .ar-detail-header{background:linear-gradient(135deg,var(--ar-navy),var(--ar-navy-light));padding:1rem 1.5rem;display:flex;align-items:center;justify-content:space-between;}
        .ar-detail-header h3{color:#fff;font-size:.95rem;font-weight:700;margin:0;display:flex;align-items:center;gap:.4rem;}
        .ar-detail-header h3 i{color:var(--ar-amber);}
        .ar-detail-back{background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);color:#fff;padding:.4rem .9rem;border-radius:8px;font-size:.78rem;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:.3rem;transition:all .2s;}
        .ar-detail-back:hover{background:rgba(255,255,255,.25);}
        .ar-detail-body{padding:1.5rem;}
        .ar-detail-grid{display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;}
        @media(max-width:768px){.ar-detail-grid{grid-template-columns:1fr;}}
        .ar-section-title{font-size:.78rem;font-weight:700;color:var(--ar-navy);display:flex;align-items:center;gap:.35rem;margin:0 0 .65rem;padding-bottom:.35rem;border-bottom:2px solid #f1f5f9;text-transform:uppercase;letter-spacing:.3px;}
        .ar-section-title i{color:var(--ar-amber);font-size:.7rem;}
        .ar-info-row{display:flex;gap:.5rem;padding:.4rem 0;font-size:.84rem;}
        .ar-info-label{font-weight:600;color:var(--ar-muted);min-width:95px;flex-shrink:0;font-size:.78rem;}
        .ar-info-value{color:var(--ar-text);word-break:break-word;}
        .ar-proof-section{margin-top:1.5rem;padding-top:1.25rem;border-top:2px solid #f1f5f9;}
        .ar-proof-frame{border:1px solid var(--ar-border);border-radius:12px;overflow:hidden;background:#f8fafc;}
        .ar-proof-frame iframe{width:100%;height:500px;border:none;display:block;}
        .ar-decision-section{margin-top:1.5rem;padding-top:1.25rem;border-top:2px solid #f1f5f9;}
        .ar-decision-box{display:flex;align-items:flex-start;gap:.75rem;padding:1rem;background:#fafbfd;border-radius:10px;border:1px solid var(--ar-border);}
        .ar-detail-footer{padding:1rem 1.5rem;border-top:2px solid #f1f5f9;display:flex;align-items:center;justify-content:flex-end;gap:.6rem;background:#fafbfd;}
        .ar-btn{padding:.5rem 1.2rem;border-radius:10px;border:none;font-size:.84rem;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:.35rem;transition:all .2s;}
        .ar-btn-approve{background:var(--ar-green);color:#fff;}
        .ar-btn-approve:hover{background:#15803d;transform:translateY(-1px);box-shadow:0 4px 12px rgba(22,163,74,.25);}
        .ar-btn-reject{background:var(--ar-red);color:#fff;}
        .ar-btn-reject:hover{background:#b91c1c;transform:translateY(-1px);box-shadow:0 4px 12px rgba(220,38,38,.25);}
        .ar-btn-cancel{background:#fff;color:var(--ar-text);border:1px solid var(--ar-border);}
        .ar-btn-cancel:hover{background:#f8fafc;border-color:#cbd5e1;}
        .ar-review-form{margin-top:1.25rem;padding:1.25rem;background:#fff;border-radius:12px;border:1px solid var(--ar-border);}
        .ar-review-header{font-size:.88rem;font-weight:700;margin-bottom:.75rem;display:flex;align-items:center;gap:.35rem;}
        .ar-review-header.approve{color:var(--ar-green);}
        .ar-review-header.reject{color:var(--ar-red);}
        .ar-label{display:block;font-size:.72rem;font-weight:700;color:var(--ar-navy);text-transform:uppercase;letter-spacing:.4px;margin-bottom:.3rem;}
        .ar-label .req{color:var(--ar-red);}
        .ar-input{width:100%;padding:.5rem .75rem;border:1px solid #d1d5db;border-radius:8px;font-size:.86rem;background:#fff;transition:border-color .15s,box-shadow .15s;}
        .ar-input:focus{outline:none;border-color:var(--ar-navy);box-shadow:0 0 0 3px rgba(30,58,95,.1);}
        .ar-field-error{color:var(--ar-red);font-size:.74rem;margin-top:.2rem;}
        .ar-info-box{display:flex;gap:.5rem;padding:.65rem .85rem;border-radius:8px;font-size:.82rem;margin-bottom:1rem;}
        .ar-info-box-blue{background:#eff6ff;border:1px solid #bfdbfe;color:#1e40af;}
        .ar-info-box-blue ul{margin:.35rem 0 0;padding-left:1.25rem;}
        .ar-info-box-blue li{font-size:.8rem;}
    </style>
    @endpush

    @can('review-applications')
        <section class="ar-page">
            <div class="ar-hero">
                <div class="ar-hero-inner">
                    <ul class="ar-breadcrumb">
                        <li><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="sep">/</li>
                        <li class="active">Bank Applications</li>
                    </ul>
                    <div class="ar-hero-title">
                        <h1><i class="fas fa-file-signature"></i>Bank Applications</h1>
                        <p class="ar-hero-sub">Review and approve village bank registration applications</p>
                    </div>
                </div>
            </div>

            <div class="ar-content">
                @if (session()->has('success'))
                    <div class="ar-alert ar-alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
                @endif
                @if (session()->has('error'))
                    <div class="ar-alert ar-alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
                @endif

                {{-- ═══ LIST VIEW (always in DOM, hidden when detail shows) ═══ --}}
                <div class="ar-card" style="{{ $showDetailModal ? 'display:none;' : '' }}">
                    <div class="ar-card-header">
                        <h3 class="ar-card-title"><i class="fas fa-list"></i> All Applications</h3>
                        <div class="ar-toolbar">
                            <select wire:model.live="statusFilter" class="ar-select" style="min-width:130px;">
                                <option value="">All Status</option>
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                            <div class="ar-search"><i class="fas fa-search"></i>
                                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search name, email, ref...">
                            </div>
                            <select wire:model.live="perPage" class="ar-select" style="min-width:75px;">
                                <option value="10">10</option>
                                <option value="25">25</option>
                            </select>
                        </div>
                    </div>
                    <div style="overflow-x:auto;">
                        <table class="ar-table">
                            <thead>
                                <tr>
                                    <th>Bank Name</th>
                                    <th>Contact Person</th>
                                    <th>Plan</th>
                                    <th>Payment Ref</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th style="width:65px;">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($applications as $app)
                                    <tr wire:key="app-{{ $app->id }}">
                                        <td>
                                            <div style="font-weight:700;">{{ $app->bank_name }}</div>
                                            <div style="font-size:.76rem;color:var(--ar-muted);">{{ $app->bank_email }}</div>
                                        </td>
                                        <td>
                                            <div style="font-size:.86rem;">{{ $app->contact_name }}</div>
                                            <div style="font-size:.76rem;color:var(--ar-muted);">{{ $app->contact_email }}</div>
                                        </td>
                                        <td>
                                            @if ($app->plan)
                                                <span class="ar-badge ar-badge-plan">{{ $app->plan->name }}</span>
                                            @else
                                                <span style="color:var(--ar-faint);">&mdash;</span>
                                            @endif
                                        </td>
                                        <td><span class="ar-code">{{ $app->payment_reference }}</span></td>
                                        <td>
                                            @if ($app->status === 'pending')
                                                <span class="ar-badge ar-badge-pending"><i class="fas fa-clock" style="font-size:.55rem;"></i> Pending</span>
                                            @elseif($app->status === 'approved')
                                                <span class="ar-badge ar-badge-approved"><i class="fas fa-check" style="font-size:.55rem;"></i> Approved</span>
                                            @else
                                                <span class="ar-badge ar-badge-rejected"><i class="fas fa-times" style="font-size:.55rem;"></i> Rejected</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div style="font-size:.8rem;color:var(--ar-muted);">{{ $app->created_at->format('d M Y') }}</div>
                                            <div style="font-size:.72rem;color:var(--ar-faint);">{{ $app->created_at->diffForHumans() }}</div>
                                        </td>
                                        <td>
                                            <button type="button" wire:click.prevent="viewDetail({{ $app->id }})" class="ar-act" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="ar-empty"><i class="fas fa-file-signature"></i><p>No applications found</p></div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($applications->hasPages())
                        <div class="ar-footer">
                            <span>Showing {{ $applications->firstItem() ?? 0 }} &ndash; {{ $applications->lastItem() ?? 0 }} of {{ $applications->total() }}</span>
                            {{ $applications->links() }}
                        </div>
                    @endif
                </div>

                {{-- ═══ DETAIL VIEW (added to DOM when showing) ═══ --}}
                @if ($showDetailModal && $detailApp)
                    <div class="ar-detail-card">
                        <div class="ar-detail-header">
                            <h3><i class="fas fa-eye"></i> Application Details</h3>
                            <button type="button" wire:click.prevent="closeDetailModal" class="ar-detail-back"><i class="fas fa-arrow-left"></i> Back to List</button>
                        </div>

                        <div class="ar-detail-body">
                            <div class="ar-detail-grid">
                                <div>
                                    <div class="ar-section-title"><i class="fas fa-building"></i> Bank Information</div>
                                    <div class="ar-info-row"><div class="ar-info-label">Name</div><div class="ar-info-value"><strong>{{ $detailApp->bank_name }}</strong></div></div>
                                    <div class="ar-info-row"><div class="ar-info-label">Code</div><div class="ar-info-value">{{ $detailApp->bank_code ?: '&mdash;' }}</div></div>
                                    <div class="ar-info-row"><div class="ar-info-label">Email</div><div class="ar-info-value">{{ $detailApp->bank_email }}</div></div>
                                    <div class="ar-info-row"><div class="ar-info-label">Phone</div><div class="ar-info-value">{{ $detailApp->bank_phone }}</div></div>
                                    <div class="ar-info-row"><div class="ar-info-label">Address</div><div class="ar-info-value">{{ $detailApp->bank_address ?: '&mdash;' }}</div></div>
                                    <div class="ar-info-row"><div class="ar-info-label">Description</div><div class="ar-info-value">{{ $detailApp->bank_description ?: '&mdash;' }}</div></div>
                                </div>
                                <div>
                                    <div class="ar-section-title"><i class="fas fa-user-tie"></i> Contact Person</div>
                                    <div class="ar-info-row"><div class="ar-info-label">Name</div><div class="ar-info-value"><strong>{{ $detailApp->contact_name }}</strong></div></div>
                                    <div class="ar-info-row"><div class="ar-info-label">Email</div><div class="ar-info-value">{{ $detailApp->contact_email }}</div></div>
                                    <div class="ar-info-row"><div class="ar-info-label">Phone</div><div class="ar-info-value">{{ $detailApp->contact_phone }}</div></div>
                                    <div class="ar-info-row"><div class="ar-info-label">Member No.</div><div class="ar-info-value">{{ $detailApp->contact_staff_no ?: '&mdash;' }}</div></div>

                                    <div class="ar-section-title" style="margin-top:1.25rem;"><i class="fas fa-credit-card"></i> Payment</div>
                                    <div class="ar-info-row"><div class="ar-info-label">Plan</div><div class="ar-info-value">{{ $detailApp->plan ? $detailApp->plan->name : '&mdash;' }}</div></div>
                                    <div class="ar-info-row"><div class="ar-info-label">Reference</div><div class="ar-info-value"><span class="ar-code">{{ $detailApp->payment_reference }}</span></div></div>
                                    <div class="ar-info-row"><div class="ar-info-label">Applied</div><div class="ar-info-value">{{ $detailApp->created_at->format('d M Y H:i') }}</div></div>
                                    <div class="ar-info-row"><div class="ar-info-label">Status</div><div class="ar-info-value">
                                        @if ($detailApp->status === 'pending')
                                            <span class="ar-badge ar-badge-pending"><i class="fas fa-clock" style="font-size:.55rem;"></i> Pending</span>
                                        @elseif ($detailApp->status === 'approved')
                                            <span class="ar-badge ar-badge-approved"><i class="fas fa-check" style="font-size:.55rem;"></i> Approved</span>
                                        @else
                                            <span class="ar-badge ar-badge-rejected"><i class="fas fa-times" style="font-size:.55rem;"></i> Rejected</span>
                                        @endif
                                    </div></div>
                                </div>
                            </div>

                            {{-- Proof File Preview --}}
                            @if ($detailApp->proof_file)
                                <div class="ar-proof-section" wire:ignore>
                                    <div class="ar-section-title"><i class="fas fa-file-alt"></i> Payment Proof</div>
                                    <div class="ar-proof-frame">
                                        <iframe src="{{ asset('storage/' . $detailApp->proof_file) }}" loading="lazy"></iframe>
                                    </div>
                                </div>
                            @endif

                            {{-- Past Review Decision --}}
                            @if ($detailApp->status !== 'pending')
                                <div class="ar-decision-section">
                                    <div class="ar-section-title"><i class="fas fa-gavel"></i> Review Decision</div>
                                    <div class="ar-decision-box">
                                        <span class="ar-badge {{ $detailApp->status === 'approved' ? 'ar-badge-approved' : 'ar-badge-rejected' }}" style="font-size:.78rem;flex-shrink:0;">
                                            {{ ucfirst($detailApp->status) }}
                                        </span>
                                        <div style="font-size:.84rem;">
                                            <div style="color:var(--ar-text);">{{ $detailApp->admin_remarks ?: '&mdash;' }}</div>
                                            <div style="color:var(--ar-faint);font-size:.76rem;margin-top:.2rem;">
                                                By {{ $detailApp->reviewer ? $detailApp->reviewer->name : '&mdash;' }}
                                                on {{ $detailApp->reviewed_at ? $detailApp->reviewed_at->format('d M Y H:i') : '&mdash;' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- Inline Review Form --}}
                            @if ($detailApp->status === 'pending' && $reviewAction)
                                <div class="ar-review-form">
                                    <div class="ar-review-header {{ $reviewAction === 'approve' ? 'approve' : 'reject' }}">
                                        <i class="fas fa-{{ $reviewAction === 'approve' ? 'check-circle' : 'times-circle' }}"></i>
                                        {{ $reviewAction === 'approve' ? 'Approve Application' : 'Reject Application' }}
                                    </div>
                                    @if ($reviewAction === 'approve')
                                        <div class="ar-info-box ar-info-box-blue">
                                            <i class="fas fa-info-circle" style="margin-top:.1rem;flex-shrink:0;"></i>
                                            <div>Approving will automatically:
                                                <ul><li>Create a village bank account</li><li>Create a user login for the contact person</li><li>Activate the subscription</li><li>Generate a license key</li></ul>
                                            </div>
                                        </div>
                                    @endif
                                    <div style="margin-bottom:.75rem;">
                                        <label class="ar-label">Admin Remarks @if ($reviewAction === 'reject') <span class="req">*</span> @endif</label>
                                        <textarea wire:model="adminRemarks" class="ar-input" rows="3" placeholder="{{ $reviewAction === 'approve' ? 'Optional notes...' : 'Please provide a reason for rejection...' }}"></textarea>
                                        @error('adminRemarks') <div class="ar-field-error">{{ $message }}</div> @enderror
                                    </div>
                                    <div style="display:flex;gap:.5rem;justify-content:flex-end;">
                                        <button type="button" wire:click.prevent="cancelReviewAction" class="ar-btn ar-btn-cancel">Cancel</button>
                                        <button type="button" wire:click.prevent="submitReview" class="ar-btn {{ $reviewAction === 'approve' ? 'ar-btn-approve' : 'ar-btn-reject' }}">
                                            <i class="fas fa-{{ $reviewAction === 'approve' ? 'check' : 'times' }}"></i>
                                            {{ $reviewAction === 'approve' ? 'Confirm Approve' : 'Confirm Reject' }}
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- Footer --}}
                        @if ($detailApp->status === 'pending' && !$reviewAction)
                            <div class="ar-detail-footer">
                                <button type="button" wire:click.prevent="closeDetailModal" class="ar-btn ar-btn-cancel"><i class="fas fa-arrow-left"></i> Back</button>
                                <button type="button" wire:click.prevent="startReview('approve')" class="ar-btn ar-btn-approve"><i class="fas fa-check-circle"></i> Approve</button>
                                <button type="button" wire:click.prevent="startReview('reject')" class="ar-btn ar-btn-reject"><i class="fas fa-times-circle"></i> Reject</button>
                            </div>
                        @elseif (!$reviewAction)
                            <div class="ar-detail-footer">
                                <button type="button" wire:click.prevent="closeDetailModal" class="ar-btn ar-btn-cancel"><i class="fas fa-arrow-left"></i> Back to List</button>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </section>
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
