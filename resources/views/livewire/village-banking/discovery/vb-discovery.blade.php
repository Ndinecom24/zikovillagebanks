<div>
    @push('custom-styles')
    <style>
        :root {
            --vd-navy:#1E3A5F; --vd-navy-light:#2B6B96; --vd-amber:#D97706; --vd-amber-light:#F59E0B;
            --vd-bg:#f4f6fa; --vd-card:#fff; --vd-border:#edf0f7; --vd-text:#1e293b;
            --vd-muted:#64748b; --vd-faint:#94a3b8; --vd-green:#16a34a; --vd-red:#dc2626; --vd-blue:#2563eb; --vd-radius:16px;
        }
        .vd-page { background:var(--vd-bg); min-height:100vh; }
        .vd-hero {
            background:linear-gradient(135deg,var(--vd-navy) 0%,#234b78 50%,var(--vd-navy-light) 100%);
            padding:2rem 0 5.5rem; position:relative; overflow:hidden;
        }
        .vd-hero::before { content:''; position:absolute; width:600px; height:600px; top:-55%; right:-6%; background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
        .vd-hero-inner { position:relative; z-index:2; padding:0 1.5rem; }
        .vd-hero-row { display:flex; align-items:flex-start; justify-content:space-between; flex-wrap:wrap; gap:1rem; }
        .vd-hero-title h1 { color:#fff; font-size:1.5rem; font-weight:800; margin:0; }
        .vd-hero-title h1 i { color:var(--vd-amber); margin-right:.5rem; }
        .vd-hero-sub { color:rgba(255,255,255,.55); font-size:.84rem; margin:.25rem 0 0; }
        .vd-content { margin-top:-4rem; position:relative; z-index:10; padding:0 1.5rem 2rem; }

        /* Search */
        .vd-search-wrap {
            background:var(--vd-card); border-radius:var(--vd-radius); border:1px solid var(--vd-border);
            box-shadow:0 2px 12px rgba(0,0,0,.04); padding:1rem 1.5rem; margin-bottom:1.25rem;
            display:flex; align-items:center; gap:1rem; flex-wrap:wrap;
        }
        .vd-search-input {
            flex:1; min-width:200px; padding:.6rem 1rem .6rem 2.5rem; border:2px solid var(--vd-border); border-radius:12px;
            font-size:.88rem; background:#fafbfd url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2394a3b8' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zm-5.242.656a5 5 0 1 1 0-10 5 5 0 0 1 0 10z'/%3E%3C/svg%3E") no-repeat .85rem center;
            transition:all .2s;
        }
        .vd-search-input:focus { outline:none; border-color:var(--vd-amber); background-color:#fff; box-shadow:0 0 0 3px rgba(217,119,6,.08); }

        /* Bank grid */
        .vd-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(320px,1fr)); gap:1rem; }

        /* Bank card */
        .vd-bank-card {
            background:var(--vd-card); border-radius:var(--vd-radius); border:1px solid var(--vd-border);
            box-shadow:0 2px 10px rgba(0,0,0,.04); overflow:hidden; transition:all .2s;
        }
        .vd-bank-card:hover { box-shadow:0 6px 20px rgba(0,0,0,.08); transform:translateY(-2px); }
        .vd-bank-header {
            padding:1.15rem 1.25rem; display:flex; align-items:center; gap:.75rem;
            border-bottom:1px solid var(--vd-border);
        }
        .vd-bank-icon {
            width:44px; height:44px; border-radius:12px; display:flex; align-items:center; justify-content:center;
            background:linear-gradient(135deg,var(--vd-navy),var(--vd-navy-light)); color:#fff;
            font-size:1.1rem; font-weight:800; flex-shrink:0;
        }
        .vd-bank-name { font-size:.92rem; font-weight:700; color:var(--vd-text); margin:0; }
        .vd-bank-code { font-size:.68rem; color:var(--vd-faint); font-weight:600; }
        .vd-bank-body { padding:1rem 1.25rem; }
        .vd-bank-desc { font-size:.82rem; color:var(--vd-muted); line-height:1.5; margin:0 0 .75rem; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
        .vd-bank-stats { display:flex; gap:1.25rem; margin-bottom:.75rem; }
        .vd-stat { text-align:center; }
        .vd-stat-val { font-size:1rem; font-weight:800; color:var(--vd-navy); }
        .vd-stat-label { font-size:.58rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--vd-faint); }
        .vd-bank-footer { padding:.75rem 1.25rem; border-top:1px solid var(--vd-border); display:flex; gap:.5rem; justify-content:flex-end; }
        .vd-btn {
            display:inline-flex; align-items:center; gap:.3rem; padding:.45rem 1rem; border-radius:10px;
            font-size:.78rem; font-weight:700; border:none; cursor:pointer; transition:all .2s; text-decoration:none;
        }
        .vd-btn-amber { background:linear-gradient(135deg,var(--vd-amber),var(--vd-amber-light)); color:#fff; }
        .vd-btn-amber:hover { transform:translateY(-1px); box-shadow:0 3px 10px rgba(217,119,6,.3); color:#fff; text-decoration:none; }
        .vd-btn-navy { background:linear-gradient(135deg,var(--vd-navy),var(--vd-navy-light)); color:#fff; }
        .vd-btn-navy:hover { transform:translateY(-1px); box-shadow:0 3px 10px rgba(30,58,95,.3); color:#fff; text-decoration:none; }
        .vd-btn-outline { background:transparent; border:2px solid var(--vd-border); color:var(--vd-text); }
        .vd-btn-outline:hover { border-color:var(--vd-navy); color:var(--vd-navy); }
        .vd-btn:disabled { opacity:.6; cursor:not-allowed; transform:none; box-shadow:none; }
        .vd-badge {
            display:inline-flex; align-items:center; gap:.25rem; padding:.2rem .6rem; border-radius:8px;
            font-size:.68rem; font-weight:700;
        }
        .vd-badge-green { background:rgba(22,163,74,.08); color:var(--vd-green); border:1px solid rgba(22,163,74,.15); }
        .vd-badge-amber { background:rgba(217,119,6,.08); color:#92400e; border:1px solid #fde68a; }
        .vd-badge-red { background:rgba(220,38,38,.08); color:var(--vd-red); border:1px solid rgba(220,38,38,.15); }

        /* Flash */
        .vd-flash { display:flex; align-items:center; gap:.5rem; padding:.7rem 1.15rem; border-radius:12px; font-size:.84rem; font-weight:600; margin-bottom:1rem; }
        .vd-flash-success { background:#f0fdf4; color:var(--vd-green); border:1px solid #bbf7d0; }
        .vd-flash-warning { background:#fffbeb; color:#92400e; border:1px solid #fde68a; }

        /* Empty */
        .vd-empty { text-align:center; padding:3rem 1rem; }
        .vd-empty i { font-size:2.5rem; opacity:.12; display:block; margin-bottom:.6rem; color:var(--vd-navy); }
        .vd-empty p { font-size:.88rem; color:var(--vd-muted); margin:0; }

        /* Modal overlay */
        .vd-overlay { position:fixed; inset:0; background:rgba(15,23,42,.45); backdrop-filter:blur(4px); z-index:1050; display:flex; align-items:center; justify-content:center; padding:1rem; }
        .vd-modal {
            background:#fff; border-radius:var(--vd-radius); width:95%; max-width:520px;
            box-shadow:0 20px 40px rgba(0,0,0,.12); animation:vdSlide .25s ease; overflow:hidden; max-height:90vh; overflow-y:auto;
        }
        .vd-modal-header {
            padding:1rem 1.5rem; background:linear-gradient(135deg,var(--vd-navy),var(--vd-navy-light));
            display:flex; align-items:center; justify-content:space-between; position:sticky; top:0; z-index:2;
        }
        .vd-modal-header h5 { color:#fff; font-size:.92rem; font-weight:700; margin:0; display:flex; align-items:center; gap:.4rem; }
        .vd-modal-close { background:none; border:none; color:rgba(255,255,255,.6); font-size:1.2rem; cursor:pointer; }
        .vd-modal-close:hover { color:#fff; }
        .vd-modal-body { padding:1.5rem; }
        .vd-modal-footer { padding:1rem 1.5rem; border-top:1px solid var(--vd-border); display:flex; justify-content:flex-end; gap:.65rem; }
        .vd-label { font-size:.72rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--vd-faint); margin-bottom:.35rem; display:block; }
        .vd-input {
            width:100%; padding:.5rem .75rem; border:1px solid var(--vd-border); border-radius:10px;
            font-size:.84rem; background:#fafbfd; transition:all .2s;
        }
        .vd-input:focus { outline:none; border-color:var(--vd-amber); background:#fff; box-shadow:0 0 0 3px rgba(217,119,6,.08); }
        .vd-hint { font-size:.7rem; color:var(--vd-faint); margin-top:.25rem; }
        .vd-btn-cancel { padding:.45rem 1.25rem; border-radius:10px; font-size:.82rem; font-weight:600; background:#f1f5f9; color:var(--vd-text); border:1px solid var(--vd-border); cursor:pointer; }
        .vd-btn-cancel:hover { background:#e2e8f0; }

        /* My requests card */
        .vd-req-card {
            display:flex; align-items:center; gap:.75rem; padding:.75rem 1rem; border-radius:12px;
            border:1px solid var(--vd-border); background:#fafbfd; margin-bottom:.5rem; flex-wrap:wrap;
        }
        .vd-req-info { flex:1; min-width:160px; }
        .vd-req-bank { font-weight:700; font-size:.85rem; color:var(--vd-text); }
        .vd-req-date { font-size:.7rem; color:var(--vd-faint); }
        .vd-req-guarantor-input {
            padding:.35rem .65rem; border:1px solid var(--vd-border); border-radius:8px;
            font-size:.78rem; width:140px; background:#fff;
        }
        .vd-req-guarantor-input:focus { outline:none; border-color:var(--vd-amber); }

        /* Detail info rows */
        .vd-detail-row { display:flex; justify-content:space-between; padding:.55rem 0; border-bottom:1px solid #f5f7fa; }
        .vd-detail-row:last-child { border-bottom:none; }
        .vd-detail-label { font-size:.78rem; color:var(--vd-muted); font-weight:600; }
        .vd-detail-val { font-size:.82rem; font-weight:700; color:var(--vd-text); }

        @keyframes vdSlide { from{opacity:0;transform:translateY(12px)} to{opacity:1;transform:translateY(0)} }
        @media(max-width:768px){
            .vd-content{padding:0 .75rem 1.5rem;}
            .vd-grid{grid-template-columns:1fr;}
        }
    </style>
    @endpush

    @can('discover-banks')
    <section class="content vd-page">
        {{-- Hero --}}
        <div class="vd-hero">
            <div class="vd-hero-inner container-fluid">
                <div class="vd-hero-row">
                    <div class="vd-hero-title">
                        <h1><i class="fas fa-search-dollar"></i>Discover Village Banks</h1>
                        <p class="vd-hero-sub">Search for village banks, view details and request to join</p>
                    </div>
                    <button wire:click="toggleMyRequests" class="vd-btn vd-btn-outline" style="color:#fff;border-color:rgba(255,255,255,.25);">
                        <i class="fas fa-{{ $showMyRequests ? 'times' : 'clipboard-list' }}"></i>
                        {{ $showMyRequests ? 'Hide My Requests' : 'My Requests' }}
                        @if ($myRequests->where('status', 'pending')->count() > 0)
                            <span style="background:var(--vd-amber);color:#fff;font-size:.6rem;padding:.1rem .4rem;border-radius:6px;margin-left:.2rem;">
                                {{ $myRequests->where('status', 'pending')->count() }}
                            </span>
                        @endif
                    </button>
                </div>
            </div>
        </div>

        <div class="vd-content container-fluid">
            {{-- Flash --}}
            @if (session()->has('message'))
                <div class="vd-flash vd-flash-success"><i class="fas fa-check-circle"></i> {{ session('message') }}</div>
            @endif
            @if (session()->has('warning'))
                <div class="vd-flash vd-flash-warning"><i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}</div>
            @endif

            {{-- My Requests (collapsible) --}}
            @if ($showMyRequests)
                <div style="background:var(--vd-card);border-radius:var(--vd-radius);border:1px solid var(--vd-border);box-shadow:0 2px 12px rgba(0,0,0,.04);padding:1.25rem 1.5rem;margin-bottom:1.25rem;">
                    <h3 style="font-size:.88rem;font-weight:700;color:var(--vd-text);margin:0 0 .75rem;display:flex;align-items:center;gap:.4rem;">
                        <i class="fas fa-clipboard-list" style="color:var(--vd-amber);font-size:.8rem;"></i> My Join Requests
                    </h3>
                    @forelse ($myRequests as $req)
                        <div class="vd-req-card">
                            <div class="vd-req-info">
                                <div class="vd-req-bank">{{ $req->villageBank->name ?? '—' }}</div>
                                <div class="vd-req-date">Submitted {{ $req->created_at->diffForHumans() }}</div>
                            </div>
                            <div>
                                @if ($req->status === 'pending')
                                    <span class="vd-badge vd-badge-amber"><i class="fas fa-clock" style="font-size:.55rem;"></i> Pending</span>
                                @elseif ($req->status === 'approved')
                                    <span class="vd-badge vd-badge-green"><i class="fas fa-check-circle" style="font-size:.55rem;"></i> Approved</span>
                                @else
                                    <span class="vd-badge vd-badge-red"><i class="fas fa-times-circle" style="font-size:.55rem;"></i> Rejected</span>
                                @endif
                            </div>
                            <div style="font-size:.78rem;color:var(--vd-muted);">
                                Guarantor:
                                @if ($req->guarantor)
                                    <strong>{{ $req->guarantor->name }}</strong>
                                @elseif ($req->guarantor_username)
                                    <em>{{ $req->guarantor_username }}</em>
                                @else
                                    <span style="color:var(--vd-faint);">None</span>
                                @endif
                            </div>
                            @if ($req->isPending() && empty($req->guarantor_id))
                                <form wire:submit.prevent="updateGuarantor({{ $req->id }}, $event.target.querySelector('input').value)" style="display:flex;gap:.35rem;align-items:center;">
                                    <input type="text" class="vd-req-guarantor-input" placeholder="Enter guarantor username" value="{{ $req->guarantor_username }}">
                                    <button type="submit" class="vd-btn vd-btn-amber" style="padding:.3rem .65rem;font-size:.7rem;">
                                        <i class="fas fa-save"></i>
                                    </button>
                                </form>
                            @endif
                            @if ($req->admin_remarks)
                                <div style="width:100%;font-size:.75rem;color:var(--vd-muted);margin-top:.25rem;padding-left:.25rem;">
                                    <i class="fas fa-comment-alt" style="color:var(--vd-amber);font-size:.6rem;margin-right:.2rem;"></i>
                                    Admin: {{ $req->admin_remarks }}
                                </div>
                            @endif
                        </div>
                    @empty
                        <div style="text-align:center;padding:1.5rem;color:var(--vd-faint);font-size:.84rem;">
                            <i class="fas fa-inbox" style="display:block;font-size:1.5rem;opacity:.2;margin-bottom:.5rem;"></i>
                            You haven't submitted any join requests yet.
                        </div>
                    @endforelse
                </div>
            @endif

            {{-- Search bar --}}
            <div class="vd-search-wrap">
                <input type="text" wire:model.debounce.300ms="search" class="vd-search-input"
                    placeholder="Search village banks by name, code, location…">
                <span style="font-size:.78rem;color:var(--vd-faint);font-weight:600;">
                    {{ $banks->count() }} bank(s) found
                </span>
            </div>

            {{-- Bank grid --}}
            @if ($banks->count() > 0)
                <div class="vd-grid">
                    @foreach ($banks as $bank)
                        @php
                            $initials = collect(explode(' ', $bank->name))->map(fn($w) => strtoupper(substr($w,0,1)))->take(2)->join('');
                        @endphp
                        <div class="vd-bank-card">
                            <div class="vd-bank-header">
                                <div class="vd-bank-icon">{{ $initials }}</div>
                                <div>
                                    <div class="vd-bank-name">{{ $bank->name }}</div>
                                    <div class="vd-bank-code">{{ $bank->code }}{{ $bank->address ? ' · ' . $bank->address : '' }}</div>
                                </div>
                            </div>
                            <div class="vd-bank-body">
                                @if ($bank->description)
                                    <p class="vd-bank-desc">{{ $bank->description }}</p>
                                @endif
                                <div class="vd-bank-stats">
                                    <div class="vd-stat">
                                        <div class="vd-stat-val">{{ $bank->members_count }}</div>
                                        <div class="vd-stat-label">Members</div>
                                    </div>
                                    <div class="vd-stat">
                                        <div class="vd-stat-val">{{ $bank->circles_count }}</div>
                                        <div class="vd-stat-label">Circles</div>
                                    </div>
                                </div>
                            </div>
                            <div class="vd-bank-footer">
                                <button wire:click="viewBank({{ $bank->id }})" class="vd-btn vd-btn-outline" style="font-size:.72rem;">
                                    <i class="fas fa-eye"></i> Details
                                </button>
                                @if ($bank->is_member)
                                    <span class="vd-badge vd-badge-green" style="font-size:.72rem;">
                                        <i class="fas fa-check-circle" style="font-size:.55rem;"></i> Member
                                    </span>
                                @elseif ($bank->has_pending)
                                    <span class="vd-badge vd-badge-amber" style="font-size:.72rem;">
                                        <i class="fas fa-clock" style="font-size:.55rem;"></i> Pending
                                    </span>
                                @else
                                    <button wire:click="openJoinModal({{ $bank->id }})" class="vd-btn vd-btn-amber">
                                        <i class="fas fa-sign-in-alt"></i> Request to Join
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="vd-empty">
                    <i class="fas fa-university"></i>
                    <p>No village banks found{{ !empty($search) ? ' matching "' . $search . '"' : '' }}.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- ===== DETAIL MODAL ===== --}}
    @if ($showDetailModal && $detailBank)
        <div class="vd-overlay" wire:click.self="closeDetail">
            <div class="vd-modal">
                <div class="vd-modal-header">
                    <h5><i class="fas fa-university"></i> {{ $detailBank->name }}</h5>
                    <button type="button" class="vd-modal-close" wire:click="closeDetail">&times;</button>
                </div>
                <div class="vd-modal-body">
                    <div class="vd-detail-row">
                        <span class="vd-detail-label">Code</span>
                        <span class="vd-detail-val">{{ $detailBank->code }}</span>
                    </div>
                    @if ($detailBank->address)
                        <div class="vd-detail-row">
                            <span class="vd-detail-label">Location</span>
                            <span class="vd-detail-val">{{ $detailBank->address }}</span>
                        </div>
                    @endif
                    @if ($detailBank->phone)
                        <div class="vd-detail-row">
                            <span class="vd-detail-label">Phone</span>
                            <span class="vd-detail-val">{{ $detailBank->phone }}</span>
                        </div>
                    @endif
                    @if ($detailBank->email)
                        <div class="vd-detail-row">
                            <span class="vd-detail-label">Email</span>
                            <span class="vd-detail-val">{{ $detailBank->email }}</span>
                        </div>
                    @endif
                    <div class="vd-detail-row">
                        <span class="vd-detail-label">Members</span>
                        <span class="vd-detail-val">{{ $detailBank->members_count }}</span>
                    </div>
                    <div class="vd-detail-row">
                        <span class="vd-detail-label">Circles</span>
                        <span class="vd-detail-val">{{ $detailBank->circles_count }}</span>
                    </div>
                    @if ($detailBank->configuration)
                        <div class="vd-detail-row">
                            <span class="vd-detail-label">Share Unit</span>
                            <span class="vd-detail-val">K{{ number_format($detailBank->configuration->share_unit_amount, 2) }}</span>
                        </div>
                        <div class="vd-detail-row">
                            <span class="vd-detail-label">Interest Rate</span>
                            <span class="vd-detail-val">{{ $detailBank->configuration->default_interest_rate }}%</span>
                        </div>
                        <div class="vd-detail-row">
                            <span class="vd-detail-label">Max Loan Multiplier</span>
                            <span class="vd-detail-val">{{ $detailBank->configuration->max_loan_multiplier }}x savings</span>
                        </div>
                    @endif
                    @if ($detailBank->description)
                        <div style="margin-top:1rem;padding:.85rem 1rem;background:#f7f9fc;border-radius:10px;font-size:.82rem;color:var(--vd-muted);line-height:1.6;">
                            {{ $detailBank->description }}
                        </div>
                    @endif
                </div>
                <div class="vd-modal-footer">
                    <button wire:click="closeDetail" class="vd-btn-cancel">Close</button>
                    <button wire:click="openJoinModal({{ $detailBank->id }})" class="vd-btn vd-btn-amber">
                        <i class="fas fa-sign-in-alt"></i> Request to Join
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- ===== JOIN REQUEST MODAL ===== --}}
    @if ($showJoinModal && $joinBank)
        <div class="vd-overlay" wire:click.self="closeJoinModal">
            <div class="vd-modal">
                <div class="vd-modal-header">
                    <h5><i class="fas fa-user-plus"></i> Join {{ $joinBank->name }}</h5>
                    <button type="button" class="vd-modal-close" wire:click="closeJoinModal">&times;</button>
                </div>
                <form wire:submit.prevent="submitJoinRequest">
                    <div class="vd-modal-body">
                        <p style="font-size:.84rem;color:var(--vd-muted);margin:0 0 1.25rem;line-height:1.6;">
                            Your request will be reviewed by the village bank admin.
                            You may optionally enter a guarantor's username — someone who is already a member of this bank.
                        </p>

                        <div style="margin-bottom:1.25rem;">
                            <label class="vd-label">Guarantor Username <span style="color:var(--vd-faint);font-weight:500;text-transform:none;">(optional)</span></label>
                            <input type="text" wire:model.defer="guarantorUsername" class="vd-input" placeholder="e.g. john.doe">
                            <div class="vd-hint">
                                <i class="fas fa-info-circle"></i>
                                If you know a current member, enter their username. You can also add this later, or the admin can assign one for you.
                            </div>
                            @error('guarantorUsername') <div style="font-size:.72rem;color:var(--vd-red);margin-top:.25rem;">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label class="vd-label">Message to Admin <span style="color:var(--vd-faint);font-weight:500;text-transform:none;">(optional)</span></label>
                            <textarea wire:model.defer="joinMessage" class="vd-input" rows="3" placeholder="Tell the admin why you'd like to join…" style="resize:vertical;"></textarea>
                            @error('joinMessage') <div style="font-size:.72rem;color:var(--vd-red);margin-top:.25rem;">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="vd-modal-footer">
                        <button type="button" wire:click="closeJoinModal" class="vd-btn-cancel">Cancel</button>
                        <button type="submit" class="vd-btn vd-btn-amber" wire:loading.attr="disabled" wire:target="submitJoinRequest">
                            <span wire:loading.remove wire:target="submitJoinRequest"><i class="fas fa-paper-plane"></i> Submit Request</span>
                            <span wire:loading wire:target="submitJoinRequest"><i class="fas fa-spinner fa-spin"></i> Submitting…</span>
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
