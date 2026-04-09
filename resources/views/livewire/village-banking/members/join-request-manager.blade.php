<div>
    @push('custom-styles')
    <style>
        :root {
            --jr-navy:#1E3A5F; --jr-navy-light:#2B6B96; --jr-amber:#D97706; --jr-amber-light:#F59E0B;
            --jr-bg:#f4f6fa; --jr-card:#fff; --jr-border:#edf0f7; --jr-text:#1e293b;
            --jr-muted:#64748b; --jr-faint:#94a3b8; --jr-green:#16a34a; --jr-red:#dc2626; --jr-radius:16px;
        }
        .jr-page { background:var(--jr-bg); min-height:100vh; }
        .jr-hero {
            background:linear-gradient(135deg,var(--jr-navy) 0%,#234b78 50%,var(--jr-navy-light) 100%);
            padding:1.75rem 0 5.5rem; position:relative; overflow:hidden;
        }
        .jr-hero::before { content:''; position:absolute; width:500px; height:500px; top:-55%; right:-6%; background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
        .jr-hero-inner { position:relative; z-index:2; padding:0 1.5rem; }
        .jr-breadcrumb { display:flex; gap:.5rem; list-style:none; padding:0; margin:0 0 .75rem; font-size:.82rem; }
        .jr-breadcrumb a { color:rgba(255,255,255,.55); text-decoration:none; }
        .jr-breadcrumb a:hover { color:rgba(255,255,255,.85); }
        .jr-breadcrumb .active { color:var(--jr-amber-light); font-weight:600; }
        .jr-breadcrumb .sep { color:rgba(255,255,255,.25); }
        .jr-hero-title h1 { color:#fff; font-size:1.4rem; font-weight:800; margin:0; }
        .jr-hero-title h1 i { color:var(--jr-amber); margin-right:.5rem; }
        .jr-hero-sub { color:rgba(255,255,255,.55); font-size:.84rem; margin:.2rem 0 0; }
        .jr-content { margin-top:-4rem; position:relative; z-index:10; padding:0 1.5rem 2rem; }

        /* Tabs */
        .jr-tabs { display:flex; gap:.5rem; margin-bottom:1.25rem; flex-wrap:wrap; }
        .jr-tab {
            padding:.5rem 1.15rem; border-radius:12px; font-size:.82rem; font-weight:700;
            cursor:pointer; transition:all .2s; border:2px solid var(--jr-border); background:var(--jr-card); color:var(--jr-muted);
            display:inline-flex; align-items:center; gap:.35rem;
        }
        .jr-tab:hover { border-color:var(--jr-amber); color:var(--jr-text); }
        .jr-tab.active { border-color:var(--jr-navy); background:rgba(30,58,95,.06); color:var(--jr-navy); }
        .jr-tab-count {
            font-size:.6rem; font-weight:800; padding:.1rem .4rem; border-radius:6px;
            background:rgba(30,58,95,.08); color:var(--jr-navy);
        }
        .jr-tab.active .jr-tab-count { background:var(--jr-amber); color:#fff; }

        /* Card */
        .jr-card { background:var(--jr-card); border-radius:var(--jr-radius); border:1px solid var(--jr-border); box-shadow:0 2px 12px rgba(0,0,0,.04); overflow:hidden; margin-bottom:.75rem; }
        .jr-card-row {
            padding:1rem 1.25rem; display:flex; align-items:center; gap:.75rem; flex-wrap:wrap;
            border-bottom:1px solid #f5f7fa; transition:background .15s; cursor:pointer;
        }
        .jr-card-row:hover { background:#fafbfd; }
        .jr-card-row:last-child { border-bottom:none; }

        /* Avatar */
        .jr-avatar {
            width:40px; height:40px; border-radius:50%; display:flex; align-items:center; justify-content:center;
            font-weight:700; font-size:.7rem; flex-shrink:0;
            background:linear-gradient(135deg,var(--jr-navy),var(--jr-navy-light)); color:#fff;
        }
        .jr-name { font-weight:700; font-size:.88rem; color:var(--jr-text); }
        .jr-email { font-size:.72rem; color:var(--jr-faint); }
        .jr-bank-name { font-size:.72rem; color:var(--jr-muted); font-weight:600; }
        .jr-date { font-size:.68rem; color:var(--jr-faint); }

        .jr-badge { display:inline-flex; align-items:center; gap:.2rem; padding:.2rem .55rem; border-radius:8px; font-size:.65rem; font-weight:700; }
        .jr-badge-pending { background:rgba(217,119,6,.08); color:#92400e; border:1px solid #fde68a; }
        .jr-badge-approved { background:rgba(22,163,74,.08); color:var(--jr-green); border:1px solid rgba(22,163,74,.15); }
        .jr-badge-rejected { background:rgba(220,38,38,.08); color:var(--jr-red); border:1px solid rgba(220,38,38,.15); }

        /* Detail expand */
        .jr-detail {
            padding:.75rem 1.25rem 1rem; background:#fafbfd; border-bottom:1px solid var(--jr-border);
            animation:jrSlide .2s ease;
        }
        .jr-detail-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(160px,1fr)); gap:.65rem; }
        .jr-detail-label { font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--jr-faint); }
        .jr-detail-val { font-size:.82rem; font-weight:600; color:var(--jr-text); }

        /* Action buttons */
        .jr-actions { display:flex; gap:.5rem; margin-left:auto; }
        .jr-btn {
            display:inline-flex; align-items:center; gap:.3rem; padding:.4rem .85rem; border-radius:10px;
            font-size:.75rem; font-weight:700; border:none; cursor:pointer; transition:all .15s;
        }
        .jr-btn-approve { background:rgba(22,163,74,.1); color:var(--jr-green); }
        .jr-btn-approve:hover { background:var(--jr-green); color:#fff; }
        .jr-btn-reject { background:rgba(220,38,38,.08); color:var(--jr-red); }
        .jr-btn-reject:hover { background:var(--jr-red); color:#fff; }

        /* Flash */
        .jr-flash { display:flex; align-items:center; gap:.5rem; padding:.7rem 1.15rem; border-radius:12px; font-size:.84rem; font-weight:600; margin-bottom:1rem; }
        .jr-flash-success { background:#f0fdf4; color:var(--jr-green); border:1px solid #bbf7d0; }

        /* Empty */
        .jr-empty { text-align:center; padding:3rem 1rem; }
        .jr-empty i { font-size:2.5rem; opacity:.12; display:block; margin-bottom:.6rem; color:var(--jr-navy); }

        /* Modal */
        .jr-overlay { position:fixed; inset:0; background:rgba(15,23,42,.45); backdrop-filter:blur(4px); z-index:1050; display:flex; align-items:center; justify-content:center; padding:1rem; }
        .jr-modal {
            background:#fff; border-radius:var(--jr-radius); width:95%; max-width:480px;
            box-shadow:0 20px 40px rgba(0,0,0,.12); animation:jrSlide .25s ease; overflow:hidden;
        }
        .jr-modal-header {
            padding:1rem 1.5rem; display:flex; align-items:center; justify-content:space-between;
        }
        .jr-modal-header.approve { background:linear-gradient(135deg,#16a34a,#22c55e); }
        .jr-modal-header.reject { background:linear-gradient(135deg,#dc2626,#ef4444); }
        .jr-modal-header h5 { color:#fff; font-size:.92rem; font-weight:700; margin:0; display:flex; align-items:center; gap:.4rem; }
        .jr-modal-close { background:none; border:none; color:rgba(255,255,255,.6); font-size:1.2rem; cursor:pointer; }
        .jr-modal-close:hover { color:#fff; }
        .jr-modal-body { padding:1.5rem; }
        .jr-modal-footer { padding:1rem 1.5rem; border-top:1px solid var(--jr-border); display:flex; justify-content:flex-end; gap:.65rem; }
        .jr-label { font-size:.72rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--jr-faint); margin-bottom:.35rem; display:block; }
        .jr-input {
            width:100%; padding:.5rem .75rem; border:1px solid var(--jr-border); border-radius:10px;
            font-size:.84rem; background:#fafbfd; transition:all .2s;
        }
        .jr-input:focus { outline:none; border-color:var(--jr-amber); background:#fff; box-shadow:0 0 0 3px rgba(217,119,6,.08); }
        .jr-hint { font-size:.7rem; color:var(--jr-faint); margin-top:.25rem; }
        .jr-btn-cancel { padding:.45rem 1.25rem; border-radius:10px; font-size:.82rem; font-weight:600; background:#f1f5f9; color:var(--jr-text); border:1px solid var(--jr-border); cursor:pointer; }
        .jr-btn-cancel:hover { background:#e2e8f0; }
        .jr-btn-confirm {
            padding:.5rem 1.15rem; border-radius:10px; font-size:.82rem; font-weight:700; border:none; color:#fff; cursor:pointer;
            display:inline-flex; align-items:center; gap:.35rem;
        }
        .jr-btn-confirm.approve { background:var(--jr-green); }
        .jr-btn-confirm.approve:hover { background:#15803d; }
        .jr-btn-confirm.reject { background:var(--jr-red); }
        .jr-btn-confirm.reject:hover { background:#b91c1c; }

        @keyframes jrSlide { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
        @media(max-width:768px){ .jr-content{padding:0 .75rem 1.5rem;} }
    </style>
    @endpush

    @can('manage-join-requests')
    <section class="content jr-page">
        {{-- Hero --}}
        <div class="jr-hero">
            <div class="jr-hero-inner container-fluid">
                <ul class="jr-breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('members.index') }}">Members</a></li>
                    <li class="sep">/</li>
                    <li class="active">Join Requests</li>
                </ul>
                <div class="jr-hero-title">
                    <h1><i class="fas fa-user-plus"></i>Join Requests</h1>
                    <p class="jr-hero-sub">Review &amp; approve requests from people wanting to join the village bank</p>
                </div>
            </div>
        </div>

        <div class="jr-content container-fluid">
            @if (session()->has('message'))
                <div class="jr-flash jr-flash-success"><i class="fas fa-check-circle"></i> {{ session('message') }}</div>
            @endif
            @if (session()->has('error'))
                <div class="jr-flash" style="background:#fef2f2;color:#991b1b;border-left:4px solid #dc3545;padding:0.75rem 1rem;border-radius:8px;margin-bottom:1rem;">
                    <i class="fas fa-ban"></i> {{ session('error') }}
                </div>
            @endif

            {{-- Status tabs --}}
            <div class="jr-tabs">
                <button class="jr-tab {{ $statusFilter === 'pending' ? 'active' : '' }}"
                    wire:click="$set('statusFilter', 'pending')">
                    <i class="fas fa-clock"></i> Pending
                    <span class="jr-tab-count">{{ $counts['pending'] }}</span>
                </button>
                <button class="jr-tab {{ $statusFilter === 'approved' ? 'active' : '' }}"
                    wire:click="$set('statusFilter', 'approved')">
                    <i class="fas fa-check-circle"></i> Approved
                    <span class="jr-tab-count">{{ $counts['approved'] }}</span>
                </button>
                <button class="jr-tab {{ $statusFilter === 'rejected' ? 'active' : '' }}"
                    wire:click="$set('statusFilter', 'rejected')">
                    <i class="fas fa-times-circle"></i> Rejected
                    <span class="jr-tab-count">{{ $counts['rejected'] }}</span>
                </button>
            </div>

            {{-- Requests list --}}
            @if ($requests->count() > 0)
                <div class="jr-card">
                    @foreach ($requests as $req)
                        @php
                            $parts = explode(' ', trim($req->user->name ?? ''));
                            $initials = strtoupper(substr($parts[0],0,1) . (isset($parts[1]) ? substr($parts[1],0,1) : ''));
                        @endphp
                        <div class="jr-card-row" wire:click="toggleDetail({{ $req->id }})">
                            <div class="jr-avatar">{{ $initials }}</div>
                            <div style="flex:1;min-width:140px;">
                                <div class="jr-name">{{ $req->user->name }}</div>
                                <div class="jr-email">{{ $req->user->email }}</div>
                            </div>
                            <div style="min-width:110px;">
                                <div class="jr-bank-name"><i class="fas fa-university" style="font-size:.6rem;color:var(--jr-amber);margin-right:.2rem;"></i> {{ $req->villageBank->name ?? '—' }}</div>
                                <div class="jr-date">{{ $req->created_at->format('d M Y, H:i') }}</div>
                            </div>
                            <div>
                                @if ($req->guarantor)
                                    <span style="font-size:.72rem;color:var(--jr-muted);">
                                        <i class="fas fa-shield-alt" style="color:var(--jr-green);font-size:.6rem;"></i>
                                        {{ $req->guarantor->name }}
                                    </span>
                                @elseif ($req->guarantor_username)
                                    <span style="font-size:.72rem;color:var(--jr-amber);">
                                        <i class="fas fa-shield-alt" style="font-size:.6rem;"></i>
                                        {{ $req->guarantor_username }} <em style="font-size:.6rem;">(unverified)</em>
                                    </span>
                                @else
                                    <span style="font-size:.72rem;color:var(--jr-faint);">
                                        <i class="fas fa-shield-alt" style="font-size:.6rem;"></i> No guarantor
                                    </span>
                                @endif
                            </div>
                            @if ($statusFilter === 'pending')
                                <div class="jr-actions" onclick="event.stopPropagation();">
                                    <button wire:click="openAction({{ $req->id }}, 'approve')" class="jr-btn jr-btn-approve">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                    <button wire:click="openAction({{ $req->id }}, 'reject')" class="jr-btn jr-btn-reject">
                                        <i class="fas fa-times"></i> Reject
                                    </button>
                                </div>
                            @else
                                <span class="jr-badge {{ $req->status === 'approved' ? 'jr-badge-approved' : 'jr-badge-rejected' }}">
                                    <i class="fas fa-{{ $req->status === 'approved' ? 'check-circle' : 'times-circle' }}" style="font-size:.5rem;"></i>
                                    {{ ucfirst($req->status) }}
                                </span>
                            @endif
                        </div>

                        {{-- Expandable detail --}}
                        @if ($showDetailId === $req->id)
                            <div class="jr-detail">
                                <div class="jr-detail-grid">
                                    <div>
                                        <div class="jr-detail-label">Phone</div>
                                        <div class="jr-detail-val">{{ $req->user->mobile_no ?? $req->user->phone ?? '—' }}</div>
                                    </div>
                                    <div>
                                        <div class="jr-detail-label">Username</div>
                                        <div class="jr-detail-val">{{ $req->user->username ?? '—' }}</div>
                                    </div>
                                    <div>
                                        <div class="jr-detail-label">National ID</div>
                                        <div class="jr-detail-val">{{ $req->user->national_id ?? '—' }}</div>
                                    </div>
                                    <div>
                                        <div class="jr-detail-label">Guarantor</div>
                                        <div class="jr-detail-val">
                                            @if ($req->guarantor)
                                                {{ $req->guarantor->name }} ({{ $req->guarantor_username }})
                                            @elseif ($req->guarantor_username)
                                                {{ $req->guarantor_username }} <em style="font-size:.7rem;color:var(--jr-red);">not found</em>
                                            @else
                                                <span style="color:var(--jr-faint);">Not set</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div>
                                        <div class="jr-detail-label">Message</div>
                                        <div class="jr-detail-val">{{ $req->message ?? '—' }}</div>
                                    </div>
                                    @if ($req->reviewer)
                                        <div>
                                            <div class="jr-detail-label">Reviewed By</div>
                                            <div class="jr-detail-val">{{ $req->reviewer->name }} · {{ $req->reviewed_at?->format('d M Y H:i') }}</div>
                                        </div>
                                    @endif
                                    @if ($req->admin_remarks)
                                        <div style="grid-column:1/-1;">
                                            <div class="jr-detail-label">Admin Remarks</div>
                                            <div class="jr-detail-val">{{ $req->admin_remarks }}</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @else
                <div class="jr-card">
                    <div class="jr-empty">
                        <i class="fas fa-inbox"></i>
                        <p style="font-size:.88rem;color:var(--jr-muted);">No {{ $statusFilter }} join requests.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- ===== ACTION MODAL ===== --}}
    @if ($showActionModal)
        @php $isApprove = $actionType === 'approve'; @endphp
        <div class="jr-overlay" wire:click.self="closeAction">
            <div class="jr-modal">
                <div class="jr-modal-header {{ $isApprove ? 'approve' : 'reject' }}">
                    <h5>
                        <i class="fas fa-{{ $isApprove ? 'check-circle' : 'times-circle' }}"></i>
                        {{ $isApprove ? 'Approve Request' : 'Reject Request' }}
                    </h5>
                    <button type="button" class="jr-modal-close" wire:click="closeAction">&times;</button>
                </div>
                <form wire:submit.prevent="processAction">
                    <div class="jr-modal-body">
                        @if ($isApprove)
                            <p style="font-size:.84rem;color:var(--jr-muted);margin:0 0 1.25rem;">
                                Approving will add this person as a member of the village bank.
                                You may assign or update their guarantor below.
                            </p>
                            <div style="margin-bottom:1.25rem;">
                                <label class="jr-label">Guarantor Username</label>
                                <input type="text" wire:model.defer="assignGuarantor" class="jr-input" placeholder="e.g. jane.smith">
                                <div class="jr-hint"><i class="fas fa-info-circle"></i> Enter the username of an existing member to serve as guarantor.</div>
                            </div>
                        @else
                            <p style="font-size:.84rem;color:var(--jr-muted);margin:0 0 1.25rem;">
                                This will reject the join request. You can optionally provide a reason.
                            </p>
                        @endif
                        <div>
                            <label class="jr-label">Admin Remarks <span style="color:var(--jr-faint);font-weight:500;text-transform:none;">(optional)</span></label>
                            <textarea wire:model.defer="adminRemarks" class="jr-input" rows="3" placeholder="{{ $isApprove ? 'Welcome note or instructions…' : 'Reason for rejection…' }}" style="resize:vertical;"></textarea>
                        </div>
                    </div>
                    <div class="jr-modal-footer">
                        <button type="button" wire:click="closeAction" class="jr-btn-cancel">Cancel</button>
                        <button type="submit" class="jr-btn-confirm {{ $isApprove ? 'approve' : 'reject' }}"
                            wire:loading.attr="disabled" wire:target="processAction">
                            <span wire:loading.remove wire:target="processAction">
                                <i class="fas fa-{{ $isApprove ? 'check' : 'times' }}"></i>
                                {{ $isApprove ? 'Approve & Add Member' : 'Reject Request' }}
                            </span>
                            <span wire:loading wire:target="processAction"><i class="fas fa-spinner fa-spin"></i></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
