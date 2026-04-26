<div>
    @push('custom-styles')
    <style>
        :root {
            --dc-navy:#1E3A5F; --dc-navy-light:#2B6B96; --dc-amber:#D97706; --dc-amber-light:#F59E0B;
            --dc-bg:#f4f6fa; --dc-card:#fff; --dc-border:#edf0f7; --dc-text:#1e293b;
            --dc-muted:#64748b; --dc-faint:#94a3b8; --dc-green:#16a34a; --dc-red:#dc2626; --dc-radius:16px;
        }
        .dc-page { background:var(--dc-bg); min-height:100vh; }
        .dc-hero {
            background:linear-gradient(135deg,var(--dc-navy) 0%,#234b78 50%,var(--dc-navy-light) 100%);
            padding:1.75rem 0 5.5rem; position:relative; overflow:hidden;
        }
        .dc-hero::before { content:''; position:absolute; width:600px; height:600px; top:-55%; right:-8%; background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
        .dc-hero-inner { position:relative; z-index:2; padding:0 1.5rem; }
        .dc-breadcrumb { display:flex; gap:.5rem; list-style:none; padding:0; margin:0 0 .75rem; font-size:.82rem; }
        .dc-breadcrumb a { color:rgba(255,255,255,.55); text-decoration:none; }
        .dc-breadcrumb a:hover { color:rgba(255,255,255,.85); }
        .dc-breadcrumb .active { color:var(--dc-amber-light); font-weight:600; }
        .dc-breadcrumb .sep { color:rgba(255,255,255,.25); }
        .dc-hero-row { display:flex; align-items:flex-end; justify-content:space-between; flex-wrap:wrap; gap:1rem; }
        .dc-hero-title h1 { color:#fff; font-size:1.5rem; font-weight:800; margin:0; }
        .dc-hero-title h1 i { color:var(--dc-amber); margin-right:.5rem; }
        .dc-hero-sub { color:rgba(255,255,255,.5); font-size:.84rem; margin:.2rem 0 0; }
        .dc-search-wrap { position:relative; width:320px; max-width:100%; }
        .dc-search { width:100%; padding:.6rem 1rem .6rem 2.4rem; border:none; border-radius:12px; font-size:.88rem; background:rgba(255,255,255,.12); color:#fff; }
        .dc-search::placeholder { color:rgba(255,255,255,.4); }
        .dc-search:focus { outline:none; background:rgba(255,255,255,.2); }
        .dc-search-icon { position:absolute; left:.85rem; top:50%; transform:translateY(-50%); color:rgba(255,255,255,.35); font-size:.85rem; }
        .dc-content { margin-top:-3.5rem; position:relative; z-index:10; padding:0 1.5rem 2rem; }

        /* Bank card grid */
        .dc-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(300px,1fr)); gap:1.25rem; }
        .dc-bank-card {
            background:var(--dc-card); border-radius:var(--dc-radius); border:1px solid var(--dc-border);
            box-shadow:0 2px 12px rgba(0,0,0,.04); overflow:hidden; transition:all .2s;
        }
        .dc-bank-card:hover { box-shadow:0 6px 20px rgba(0,0,0,.08); transform:translateY(-2px); }
        .dc-bank-top { padding:1.15rem 1.25rem .85rem; display:flex; gap:.85rem; align-items:flex-start; }
        .dc-bank-logo {
            width:48px; height:48px; border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0;
            background:linear-gradient(135deg,var(--dc-navy),var(--dc-navy-light)); color:#fff; font-weight:800; font-size:1rem;
        }
        .dc-bank-logo img { width:100%; height:100%; object-fit:cover; border-radius:12px; }
        .dc-bank-name { font-size:.95rem; font-weight:700; color:var(--dc-text); margin:0; }
        .dc-bank-code { font-size:.68rem; font-weight:700; color:var(--dc-amber); text-transform:uppercase; letter-spacing:.5px; }
        .dc-bank-desc { font-size:.78rem; color:var(--dc-muted); margin:.35rem 0 0; line-height:1.5; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
        .dc-bank-stats { padding:.65rem 1.25rem; border-top:1px solid var(--dc-border); display:flex; gap:1.25rem; }
        .dc-stat { text-align:center; flex:1; }
        .dc-stat-val { font-size:1rem; font-weight:800; color:var(--dc-navy); }
        .dc-stat-lbl { font-size:.58rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--dc-faint); }
        .dc-bank-actions { padding:.65rem 1.25rem; border-top:1px solid var(--dc-border); display:flex; gap:.5rem; justify-content:flex-end; }
        .dc-btn {
            display:inline-flex; align-items:center; gap:.3rem; padding:.4rem .9rem; border-radius:10px;
            font-size:.78rem; font-weight:700; border:none; cursor:pointer; transition:all .15s; text-decoration:none;
        }
        .dc-btn-view { background:rgba(30,58,95,.06); color:var(--dc-navy); }
        .dc-btn-view:hover { background:rgba(30,58,95,.12); }
        .dc-btn-join { background:linear-gradient(135deg,var(--dc-amber),var(--dc-amber-light)); color:#fff; }
        .dc-btn-join:hover { transform:translateY(-1px); box-shadow:0 3px 10px rgba(217,119,6,.3); }
        .dc-btn-member { background:rgba(22,163,74,.06); color:var(--dc-green); cursor:default; }
        .dc-btn-pending { background:rgba(217,119,6,.06); color:#92400e; cursor:default; }
        .dc-btn-primary { background:linear-gradient(135deg,var(--dc-navy),var(--dc-navy-light)); color:#fff; }
        .dc-btn-primary:hover { transform:translateY(-1px); box-shadow:0 4px 12px rgba(30,58,95,.25); }
        .dc-btn-primary:disabled { opacity:.6; cursor:not-allowed; transform:none; }

        /* Requests section */
        .dc-card { background:var(--dc-card); border-radius:var(--dc-radius); border:1px solid var(--dc-border); box-shadow:0 2px 12px rgba(0,0,0,.04); overflow:hidden; margin-bottom:1.25rem; }
        .dc-card-head { padding:.85rem 1.25rem; border-bottom:1px solid var(--dc-border); display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:.5rem; }
        .dc-card-title { font-size:.9rem; font-weight:700; color:var(--dc-text); margin:0; display:flex; align-items:center; gap:.4rem; }
        .dc-card-title i { color:var(--dc-amber); font-size:.8rem; }
        .dc-card-body { padding:1rem 1.25rem; }
        .dc-req-row { display:flex; align-items:center; gap:1rem; padding:.65rem 0; border-bottom:1px solid #f5f7fa; flex-wrap:wrap; }
        .dc-req-row:last-child { border-bottom:none; }
        .dc-req-bank { font-weight:700; font-size:.88rem; color:var(--dc-text); }
        .dc-req-date { font-size:.72rem; color:var(--dc-faint); }
        .dc-badge {
            display:inline-flex; align-items:center; gap:.25rem; padding:.2rem .55rem; border-radius:6px;
            font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:800;
        }
        .dc-badge-pending { background:rgba(217,119,6,.08); color:#92400e; }
        .dc-badge-approved { background:rgba(22,163,74,.08); color:#166534; }
        .dc-badge-rejected { background:rgba(220,38,38,.08); color:#991b1b; }
        .dc-guarantor-tag { font-size:.72rem; color:var(--dc-muted); display:flex; align-items:center; gap:.25rem; }
        .dc-btn-sm { padding:.3rem .65rem; font-size:.7rem; border-radius:8px; font-weight:700; cursor:pointer; border:none; }

        /* Flash */
        .dc-flash { display:flex; align-items:center; gap:.5rem; padding:.65rem 1rem; border-radius:10px; font-size:.84rem; font-weight:600; margin-bottom:1rem; }
        .dc-flash-success { background:rgba(22,163,74,.08); color:#166534; border:1px solid #bbf7d0; }
        .dc-flash-warning { background:rgba(217,119,6,.08); color:#92400e; border:1px solid #fde68a; }

        /* Modal */
        .dc-overlay { position:fixed; inset:0; background:rgba(15,23,42,.45); backdrop-filter:blur(4px); z-index:1050; display:flex; align-items:center; justify-content:center; }
        .dc-modal { background:#fff; border-radius:var(--dc-radius); width:95%; max-width:500px; box-shadow:0 20px 40px rgba(0,0,0,.12); animation:dcSlide .25s ease; overflow:hidden; }
        .dc-modal-header { padding:1rem 1.5rem; background:linear-gradient(135deg,var(--dc-navy),var(--dc-navy-light)); display:flex; align-items:center; justify-content:space-between; }
        .dc-modal-header h5 { color:#fff; font-size:.92rem; font-weight:700; margin:0; display:flex; align-items:center; gap:.4rem; }
        .dc-modal-close { background:none; border:none; color:rgba(255,255,255,.6); font-size:1.2rem; cursor:pointer; }
        .dc-modal-close:hover { color:#fff; }
        .dc-modal-body { padding:1.5rem; }
        .dc-modal-footer { padding:1rem 1.5rem; border-top:1px solid var(--dc-border); display:flex; justify-content:flex-end; gap:.65rem; }
        .dc-label { font-size:.72rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--dc-faint); margin-bottom:.35rem; }
        .dc-input { width:100%; padding:.5rem .75rem; border:1px solid var(--dc-border); border-radius:10px; font-size:.84rem; background:#fafbfd; transition:all .2s; }
        .dc-input:focus { outline:none; border-color:var(--dc-amber); background:#fff; box-shadow:0 0 0 3px rgba(217,119,6,.08); }
        .dc-textarea { min-height:80px; resize:vertical; }
        .dc-hint { font-size:.68rem; color:var(--dc-faint); margin-top:.25rem; }
        .dc-btn-cancel { padding:.45rem 1.25rem; border-radius:10px; font-size:.82rem; font-weight:600; background:#f1f5f9; color:var(--dc-text); border:1px solid var(--dc-border); cursor:pointer; }
        .dc-btn-cancel:hover { background:#e2e8f0; }

        /* Detail modal extras */
        .dc-detail-section { margin-bottom:1.25rem; }
        .dc-detail-label { font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--dc-faint); margin-bottom:.25rem; }
        .dc-detail-val { font-size:.88rem; color:var(--dc-text); font-weight:600; }
        .dc-detail-grid { display:grid; grid-template-columns:1fr 1fr; gap:.75rem; }

        .dc-empty { text-align:center; padding:3rem 1rem; color:var(--dc-faint); }
        .dc-empty i { font-size:2.5rem; opacity:.12; display:block; margin-bottom:.6rem; }

        @keyframes dcSlide { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
        .dc-animate { animation:dcSlide .3s ease; }
        @media(max-width:768px){ .dc-content{padding:0 .75rem 1.5rem;} .dc-grid{grid-template-columns:1fr;} .dc-search-wrap{width:100%;} }
    </style>
    @endpush

    <section class="content dc-page">
        {{-- Hero --}}
        <div class="dc-hero">
            <div class="dc-hero-inner container-fluid">
                <ul class="dc-breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li class="active">Discover Village Banks</li>
                </ul>
                <div class="dc-hero-row">
                    <div class="dc-hero-title">
                        <h1><i class="fas fa-search-dollar"></i>Discover Village Banks</h1>
                        <p class="dc-hero-sub">Browse available village banks, view details, and request to join</p>
                    </div>
                    <div class="dc-search-wrap">
                        <i class="fas fa-search dc-search-icon"></i>
                        <input type="text" wire:model.live.debounce.350ms="search" class="dc-search" placeholder="Search by name, code, or location...">
                    </div>
                </div>
            </div>
        </div>

        <div class="dc-content container-fluid dc-animate">

            {{-- Flash --}}
            @if (session()->has('message'))
                <div class="dc-flash dc-flash-success"><i class="fas fa-check-circle"></i> {{ session('message') }}</div>
            @endif
            @if (session()->has('warning'))
                <div class="dc-flash dc-flash-warning"><i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}</div>
            @endif

            {{-- My Requests --}}
            @if ($myRequests->count() > 0)
                <div class="dc-card">
                    <div class="dc-card-head">
                        <h3 class="dc-card-title"><i class="fas fa-paper-plane"></i> My Membership Requests</h3>
                        <span style="font-size:.72rem;color:var(--dc-faint);font-weight:600;">{{ $myRequests->count() }} request(s)</span>
                    </div>
                    <div class="dc-card-body">
                        @foreach ($myRequests as $req)
                            <div class="dc-req-row">
                                <div style="flex:1;">
                                    <div class="dc-req-bank">{{ $req->villageBank->name ?? '—' }}</div>
                                    <div class="dc-req-date">Requested {{ $req->created_at->format('d M Y, H:i') }}</div>
                                </div>
                                <span class="dc-badge dc-badge-{{ $req->status }}">
                                    <i class="fas fa-{{ $req->status === 'pending' ? 'clock' : ($req->status === 'approved' ? 'check' : 'times') }}"></i>
                                    {{ ucfirst($req->status) }}
                                </span>
                                {{-- Guarantor info --}}
                                @if ($req->guarantor_id)
                                    <span class="dc-guarantor-tag">
                                        <i class="fas fa-user-shield"></i> {{ $req->guarantor->name ?? '—' }}
                                    </span>
                                @elseif ($req->guarantor_username)
                                    <span class="dc-guarantor-tag" style="color:var(--dc-amber);">
                                        <i class="fas fa-user-clock"></i> {{ $req->guarantor_username }} (unverified)
                                    </span>
                                @elseif ($req->status === 'approved')
                                    <button wire:click="openGuarantorModal({{ $req->id }})" class="dc-btn-sm dc-btn-join" style="font-size:.68rem;">
                                        <i class="fas fa-user-plus"></i> Add Guarantor
                                    </button>
                                @else
                                    <span class="dc-guarantor-tag"><i class="fas fa-user-times"></i> No guarantor</span>
                                @endif
                                @if ($req->admin_remarks)
                                    <span style="font-size:.72rem;color:var(--dc-muted);flex-basis:100%;margin-top:.25rem;">
                                        <i class="fas fa-comment-dots" style="color:var(--dc-amber);margin-right:.2rem;"></i> {{ $req->admin_remarks }}
                                    </span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Bank Grid --}}
            @if ($banks->count() > 0)
                <div class="dc-grid">
                    @foreach ($banks as $bank)
                        @php
                            $isMember  = in_array($bank->id, $memberBankIds);
                            $isPending = in_array($bank->id, $pendingBankIds);
                            $initials  = strtoupper(substr($bank->name, 0, 2));
                        @endphp
                        <div class="dc-bank-card">
                            <div class="dc-bank-top">
                                <div class="dc-bank-logo">
                                    @if ($bank->logo)
                                        <img src="{{ asset('storage/' . $bank->logo) }}" alt="{{ $bank->name }}">
                                    @else
                                        {{ $initials }}
                                    @endif
                                </div>
                                <div style="flex:1;min-width:0;">
                                    <div class="dc-bank-code">{{ $bank->code }}</div>
                                    <h4 class="dc-bank-name">{{ $bank->name }}</h4>
                                    @if ($bank->description)
                                        <p class="dc-bank-desc">{{ $bank->description }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="dc-bank-stats">
                                <div class="dc-stat">
                                    <div class="dc-stat-val">{{ $bank->members_count }}</div>
                                    <div class="dc-stat-lbl">Members</div>
                                </div>
                                <div class="dc-stat">
                                    <div class="dc-stat-val">{{ $bank->circles_count }}</div>
                                    <div class="dc-stat-lbl">Circles</div>
                                </div>
                                <div class="dc-stat">
                                    <div class="dc-stat-val">{{ $bank->address ? Str::limit($bank->address, 20) : '—' }}</div>
                                    <div class="dc-stat-lbl">Location</div>
                                </div>
                            </div>
                            <div class="dc-bank-actions">
                                <button wire:click="viewBank({{ $bank->id }})" class="dc-btn dc-btn-view">
                                    <i class="fas fa-eye"></i> Details
                                </button>
                                @if ($isMember)
                                    <span class="dc-btn dc-btn-member"><i class="fas fa-check-circle"></i> Member</span>
                                @elseif ($isPending)
                                    <span class="dc-btn dc-btn-pending"><i class="fas fa-clock"></i> Pending</span>
                                @else
                                    <button wire:click="openJoinModal({{ $bank->id }}, '{{ addslashes($bank->name) }}')" class="dc-btn dc-btn-join">
                                        <i class="fas fa-sign-in-alt"></i> Request to Join
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <div style="margin-top:1.25rem;">
                    {{ $banks->links() }}
                </div>
            @else
                <div class="dc-card">
                    <div class="dc-empty">
                        <i class="fas fa-university"></i>
                        <strong>No village banks found</strong>
                        <p style="font-size:.82rem;margin:.5rem 0 0;">{{ $search ? 'Try a different search term.' : 'No active village banks available at the moment.' }}</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- ===== JOIN REQUEST MODAL ===== --}}
    @if ($showJoinModal)
        <div class="dc-overlay" wire:click.self="$set('showJoinModal', false)">
            <div class="dc-modal">
                <div class="dc-modal-header">
                    <h5><i class="fas fa-sign-in-alt"></i> Request to Join</h5>
                    <button class="dc-modal-close" wire:click="$set('showJoinModal', false)">&times;</button>
                </div>
                <form wire:submit.prevent="submitJoinRequest">
                    <div class="dc-modal-body">
                        <p style="font-size:.85rem;color:var(--dc-muted);margin:0 0 1.25rem;">
                            You are requesting to join <strong style="color:var(--dc-navy);">{{ $joinBankName }}</strong>.
                            Your request will be reviewed by an administrator.
                        </p>

                        <div style="margin-bottom:1.15rem;">
                            <label class="dc-label">Guarantor Username <span style="color:var(--dc-faint);font-weight:500;text-transform:none;letter-spacing:0;">(optional)</span></label>
                            <input type="text" wire:model="joinGuarantor" class="dc-input" placeholder="e.g. john.doe">
                            <div class="dc-hint">
                                <i class="fas fa-info-circle"></i> Enter the username of an existing member who can vouch for you. You can also add this later.
                            </div>
                        </div>

                        <div>
                            <label class="dc-label">Message <span style="color:var(--dc-faint);font-weight:500;text-transform:none;letter-spacing:0;">(optional)</span></label>
                            <textarea wire:model="joinMessage" class="dc-input dc-textarea" placeholder="Tell the admin a bit about yourself or why you'd like to join..."></textarea>
                        </div>
                    </div>
                    <div class="dc-modal-footer">
                        <button type="button" wire:click="$set('showJoinModal', false)" class="dc-btn-cancel">Cancel</button>
                        <button type="submit" class="dc-btn dc-btn-primary" wire:loading.attr="disabled" wire:target="submitJoinRequest">
                            <span wire:loading.remove wire:target="submitJoinRequest"><i class="fas fa-paper-plane"></i> Submit Request</span>
                            <span wire:loading wire:target="submitJoinRequest"><i class="fas fa-spinner fa-spin"></i> Submitting...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- ===== BANK DETAIL MODAL ===== --}}
    @if ($showDetailModal && $detailBank)
        <div class="dc-overlay" wire:click.self="$set('showDetailModal', false)">
            <div class="dc-modal" style="max-width:540px;">
                <div class="dc-modal-header">
                    <h5><i class="fas fa-university"></i> {{ $detailBank->name }}</h5>
                    <button class="dc-modal-close" wire:click="$set('showDetailModal', false)">&times;</button>
                </div>
                <div class="dc-modal-body">
                    <div class="dc-detail-grid">
                        <div class="dc-detail-section">
                            <div class="dc-detail-label">Code</div>
                            <div class="dc-detail-val">{{ $detailBank->code }}</div>
                        </div>
                        <div class="dc-detail-section">
                            <div class="dc-detail-label">Status</div>
                            <div class="dc-detail-val" style="color:var(--dc-green);">{{ ucfirst($detailBank->status) }}</div>
                        </div>
                        <div class="dc-detail-section">
                            <div class="dc-detail-label">Members</div>
                            <div class="dc-detail-val">{{ $detailBank->members_count }}</div>
                        </div>
                        <div class="dc-detail-section">
                            <div class="dc-detail-label">Circles</div>
                            <div class="dc-detail-val">{{ $detailBank->circles_count }}</div>
                        </div>
                    </div>
                    @if ($detailBank->description)
                        <div class="dc-detail-section">
                            <div class="dc-detail-label">About</div>
                            <p style="font-size:.84rem;color:var(--dc-muted);margin:0;line-height:1.6;">{{ $detailBank->description }}</p>
                        </div>
                    @endif
                    @if ($detailBank->address)
                        <div class="dc-detail-section">
                            <div class="dc-detail-label">Location</div>
                            <div class="dc-detail-val">{{ $detailBank->address }}</div>
                        </div>
                    @endif
                    @if ($detailBank->phone || $detailBank->email)
                        <div class="dc-detail-grid">
                            @if ($detailBank->phone)
                                <div class="dc-detail-section">
                                    <div class="dc-detail-label">Phone</div>
                                    <div class="dc-detail-val">{{ $detailBank->phone }}</div>
                                </div>
                            @endif
                            @if ($detailBank->email)
                                <div class="dc-detail-section">
                                    <div class="dc-detail-label">Email</div>
                                    <div class="dc-detail-val" style="font-size:.8rem;">{{ $detailBank->email }}</div>
                                </div>
                            @endif
                        </div>
                    @endif
                    @if ($detailBank->configuration)
                        <div class="dc-detail-section" style="margin-top:.5rem;">
                            <div class="dc-detail-label">Savings & Loan Info</div>
                            <div class="dc-detail-grid" style="margin-top:.35rem;">
                                <div>
                                    <span style="font-size:.72rem;color:var(--dc-faint);">Share Unit</span><br>
                                    <strong style="font-size:.86rem;color:var(--dc-navy);">K{{ number_format($detailBank->configuration->share_unit_amount, 0) }}</strong>
                                </div>
                                <div>
                                    <span style="font-size:.72rem;color:var(--dc-faint);">Loan Multiplier</span><br>
                                    <strong style="font-size:.86rem;color:var(--dc-navy);">{{ $detailBank->configuration->max_loan_multiplier }}×</strong>
                                </div>
                                <div>
                                    <span style="font-size:.72rem;color:var(--dc-faint);">Interest Rate</span><br>
                                    <strong style="font-size:.86rem;color:var(--dc-navy);">{{ $detailBank->configuration->default_interest_rate }}%</strong>
                                </div>
                                <div>
                                    <span style="font-size:.72rem;color:var(--dc-faint);">Cycle Duration</span><br>
                                    <strong style="font-size:.86rem;color:var(--dc-navy);">{{ $detailBank->configuration->circle_duration_months }} months</strong>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="dc-modal-footer">
                    <button type="button" wire:click="$set('showDetailModal', false)" class="dc-btn-cancel">Close</button>
                    @php
                        $dm = in_array($detailBank->id, $memberBankIds ?? []);
                        $dp = in_array($detailBank->id, $pendingBankIds ?? []);
                    @endphp
                    @if ($dm)
                        <span class="dc-btn dc-btn-member"><i class="fas fa-check-circle"></i> Already a Member</span>
                    @elseif ($dp)
                        <span class="dc-btn dc-btn-pending"><i class="fas fa-clock"></i> Request Pending</span>
                    @else
                        <button wire:click="openJoinModal({{ $detailBank->id }}, '{{ addslashes($detailBank->name) }}')" class="dc-btn dc-btn-join">
                            <i class="fas fa-sign-in-alt"></i> Request to Join
                        </button>
                    @endif
                </div>
            </div>
        </div>
    @endif

    {{-- ===== GUARANTOR MODAL ===== --}}
    @if ($showGuarantorModal)
        <div class="dc-overlay" wire:click.self="$set('showGuarantorModal', false)">
            <div class="dc-modal" style="max-width:420px;">
                <div class="dc-modal-header">
                    <h5><i class="fas fa-user-shield"></i> Add Guarantor</h5>
                    <button class="dc-modal-close" wire:click="$set('showGuarantorModal', false)">&times;</button>
                </div>
                <form wire:submit.prevent="saveGuarantor">
                    <div class="dc-modal-body">
                        <p style="font-size:.84rem;color:var(--dc-muted);margin:0 0 1rem;">
                            Enter the username of an existing platform member who will guarantee your membership.
                        </p>
                        <div>
                            <label class="dc-label">Guarantor Username <span style="color:var(--dc-red);">*</span></label>
                            <input type="text" wire:model="guarantorUsername" class="dc-input" placeholder="e.g. john.doe" required>
                            @error('guarantorUsername') <div style="font-size:.72rem;color:var(--dc-red);margin-top:.25rem;">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="dc-modal-footer">
                        <button type="button" wire:click="$set('showGuarantorModal', false)" class="dc-btn-cancel">Cancel</button>
                        <button type="submit" class="dc-btn dc-btn-primary">
                            <i class="fas fa-save"></i> Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
