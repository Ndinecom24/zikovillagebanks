<div>
    @push('custom-styles')
    <style>
        :root {
            --cm-navy:#1E3A5F; --cm-navy-light:#2B6B96; --cm-amber:#D97706; --cm-amber-light:#F59E0B;
            --cm-bg:#f4f6fa; --cm-card:#fff; --cm-border:#edf0f7; --cm-text:#1e293b;
            --cm-muted:#64748b; --cm-faint:#94a3b8; --cm-green:#16a34a; --cm-red:#dc2626; --cm-blue:#2563eb; --cm-radius:16px;
        }
        .cm-page { background:var(--cm-bg); min-height:100vh; }

        /* Hero */
        .cm-hero {
            background:linear-gradient(135deg,var(--cm-navy) 0%,#234b78 50%,var(--cm-navy-light) 100%);
            padding:1.75rem 0 6rem; position:relative; overflow:hidden;
        }
        .cm-hero::before { content:''; position:absolute; width:600px; height:600px; top:-60%; right:-8%; background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
        .cm-hero-inner { position:relative; z-index:2; padding:0 1.5rem; }
        .cm-breadcrumb { display:flex; gap:.5rem; list-style:none; padding:0; margin:0 0 .75rem; font-size:.82rem; }
        .cm-breadcrumb a { color:rgba(255,255,255,.55); text-decoration:none; }
        .cm-breadcrumb a:hover { color:rgba(255,255,255,.85); }
        .cm-breadcrumb .active { color:var(--cm-amber-light); font-weight:600; }
        .cm-breadcrumb .sep { color:rgba(255,255,255,.25); }
        .cm-back { display:inline-flex; align-items:center; gap:.35rem; color:rgba(255,255,255,.65); font-size:.82rem; font-weight:600; text-decoration:none; margin-bottom:.6rem; }
        .cm-back:hover { color:#fff; text-decoration:none; }
        .cm-hero-title { display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:.75rem; }
        .cm-hero-title h1 { color:#fff; font-size:1.6rem; font-weight:800; margin:0; }
        .cm-hero-title h1 i { color:var(--cm-amber); margin-right:.5rem; }
        .cm-hero-sub { color:rgba(255,255,255,.55); font-size:.88rem; margin:.25rem 0 0; }

        /* Status badge in hero */
        .cm-hero-badge {
            display:inline-flex; align-items:center; gap:.25rem; padding:.25rem .75rem; border-radius:8px;
            font-size:.72rem; font-weight:700;
        }

        /* Content */
        .cm-content { margin-top:-4rem; position:relative; z-index:10; padding:0 1.5rem 2rem; }

        /* Info strip */
        .cm-info-strip {
            display:grid; grid-template-columns:repeat(auto-fit,minmax(140px,1fr)); gap:.75rem;
            background:var(--cm-card); border-radius:var(--cm-radius); border:1px solid var(--cm-border);
            box-shadow:0 2px 12px rgba(0,0,0,.04); padding:1rem 1.25rem; margin-bottom:1.25rem;
        }
        .cm-info-item { display:flex; align-items:center; gap:.65rem; }
        .cm-info-icon {
            width:36px; height:36px; border-radius:10px; display:flex; align-items:center; justify-content:center;
            font-size:.75rem; flex-shrink:0;
        }
        .cm-info-label { font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--cm-faint); }
        .cm-info-value { font-size:.88rem; font-weight:700; color:var(--cm-text); margin-top:.05rem; }

        /* Action buttons in info strip */
        .cm-status-actions { display:flex; gap:.5rem; flex-wrap:wrap; }
        .cm-btn-sm {
            padding:.4rem .85rem; border-radius:8px; font-size:.75rem; font-weight:700; border:1px solid;
            cursor:pointer; display:inline-flex; align-items:center; gap:.3rem; transition:all .15s; background:transparent;
        }
        .cm-btn-activate { border-color:var(--cm-blue); color:var(--cm-blue); }
        .cm-btn-activate:hover { background:var(--cm-blue); color:#fff; }
        .cm-btn-months { border-color:var(--cm-green); color:var(--cm-green); text-decoration:none; }
        .cm-btn-months:hover { background:var(--cm-green); color:#fff; text-decoration:none; }
        .cm-btn-complete { border-color:var(--cm-muted); color:var(--cm-muted); }
        .cm-btn-complete:hover { background:var(--cm-muted); color:#fff; }

        /* Card */
        .cm-card {
            background:var(--cm-card); border-radius:var(--cm-radius); border:1px solid var(--cm-border);
            box-shadow:0 2px 12px rgba(0,0,0,.04); overflow:hidden;
        }
        .cm-card-header {
            padding:1rem 1.5rem; border-bottom:1px solid var(--cm-border);
            display:flex; align-items:center; justify-content:space-between; gap:.5rem;
        }
        .cm-card-title { font-size:.95rem; font-weight:700; color:var(--cm-text); display:flex; align-items:center; gap:.4rem; }
        .cm-card-title i { color:var(--cm-amber); font-size:.8rem; }
        .cm-card-body { padding:1.25rem 1.5rem; }

        /* Search */
        .cm-search { position:relative; margin-bottom:.75rem; }
        .cm-search-label { font-size:.72rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--cm-faint); margin-bottom:.35rem; }
        .cm-search-wrap { position:relative; }
        .cm-search-wrap i { position:absolute; left:.75rem; top:50%; transform:translateY(-50%); font-size:.72rem; color:var(--cm-faint); }
        .cm-search-input {
            width:100%; padding:.5rem .75rem .5rem 2rem; border:1px solid var(--cm-border); border-radius:10px;
            font-size:.84rem; background:#fafbfd; transition:all .2s;
        }
        .cm-search-input:focus { outline:none; border-color:var(--cm-amber); background:#fff; box-shadow:0 0 0 3px rgba(217,119,6,.08); }

        /* Search results dropdown */
        .cm-search-results {
            position:absolute; z-index:50; width:100%; max-height:250px; overflow-y:auto;
            background:#fff; border:1px solid var(--cm-border); border-radius:0 0 12px 12px;
            box-shadow:0 8px 24px rgba(0,0,0,.08);
        }
        .cm-search-item {
            display:flex; align-items:center; gap:.65rem; padding:.6rem .85rem;
            border:none; background:none; width:100%; text-align:left; cursor:pointer;
            border-bottom:1px solid #f5f7fa; transition:background .15s;
        }
        .cm-search-item:last-child { border-bottom:none; }
        .cm-search-item:hover { background:rgba(217,119,6,.04); }
        .cm-search-empty { padding:.85rem; text-align:center; color:var(--cm-faint); font-size:.82rem; }
        .cm-search-hint { font-size:.72rem; color:var(--cm-faint); margin-top:.5rem; display:flex; align-items:center; gap:.3rem; }

        /* Avatar */
        .cm-avatar {
            width:32px; height:32px; border-radius:50%; display:flex; align-items:center; justify-content:center;
            font-weight:700; font-size:.65rem; flex-shrink:0;
            background:linear-gradient(135deg,var(--cm-navy),var(--cm-navy-light)); color:#fff;
        }
        .cm-avatar-lg { width:40px; height:40px; font-size:.75rem; }

        /* Table */
        .cm-table { width:100%; border-collapse:collapse; }
        .cm-table thead th {
            font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--cm-faint);
            padding:.7rem 1rem; border-bottom:1px solid var(--cm-border); background:#fafbfd; white-space:nowrap;
        }
        .cm-table tbody td { padding:.65rem 1rem; border-bottom:1px solid #f5f7fa; font-size:.84rem; vertical-align:middle; }
        .cm-table tbody tr:last-child td { border-bottom:none; }
        .cm-table tbody tr:hover { background:#fafbfd; }
        .cm-member-cell { display:flex; align-items:center; gap:.55rem; }
        .cm-member-name { font-weight:700; color:var(--cm-text); font-size:.86rem; }
        .cm-member-email { font-size:.72rem; color:var(--cm-faint); margin-top:.1rem; }

        /* Actions */
        .cm-act-delete {
            width:30px; height:30px; border-radius:8px; display:flex; align-items:center; justify-content:center;
            border:1px solid var(--cm-border); background:#fafbfd; color:var(--cm-muted); cursor:pointer;
            font-size:.7rem; transition:all .15s;
        }
        .cm-act-delete:hover { border-color:var(--cm-red); color:var(--cm-red); background:rgba(220,38,38,.05); }

        /* Footer */
        .cm-footer { padding:.85rem 1.5rem; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:.75rem; border-top:1px solid var(--cm-border); }
        .cm-footer-info { font-size:.78rem; color:var(--cm-faint); }

        /* Empty */
        .cm-empty { text-align:center; padding:2.5rem 1rem; }
        .cm-empty i { font-size:2.5rem; opacity:.12; display:block; margin-bottom:.75rem; color:var(--cm-navy); }
        .cm-empty p { font-size:.84rem; color:var(--cm-muted); margin:0; }

        /* Flash */
        .cm-flash {
            display:flex; align-items:center; gap:.5rem; padding:.65rem 1rem; border-radius:10px; font-size:.84rem; font-weight:600;
            margin-bottom:1rem;
        }
        .cm-flash-success { background:rgba(22,163,74,.08); color:#166534; border:1px solid #bbf7d0; }
        .cm-flash-warning { background:rgba(217,119,6,.08); color:#92400e; border:1px solid #fde68a; }

        /* Modal */
        .cm-overlay { position:fixed; inset:0; background:rgba(15,23,42,.45); backdrop-filter:blur(4px); z-index:1050; display:flex; align-items:center; justify-content:center; }
        .cm-modal {
            background:#fff; border-radius:var(--cm-radius); width:95%; max-width:420px;
            box-shadow:0 20px 40px rgba(0,0,0,.12); text-align:center; padding:2rem;
            animation:cmSlide .25s ease;
        }
        .cm-modal-icon {
            width:56px; height:56px; border-radius:50%; display:inline-flex; align-items:center; justify-content:center;
            margin-bottom:1rem; font-size:1.4rem;
        }
        .cm-modal h5 { font-weight:700; font-size:1rem; color:var(--cm-text); margin-bottom:.5rem; }
        .cm-modal p { color:var(--cm-muted); font-size:.88rem; margin-bottom:1.5rem; }
        .cm-modal-btns { display:flex; justify-content:center; gap:.65rem; }
        .cm-btn-cancel { padding:.45rem 1.25rem; border-radius:10px; font-size:.82rem; font-weight:600; background:#f1f5f9; color:var(--cm-text); border:1px solid var(--cm-border); cursor:pointer; transition:all .15s; }
        .cm-btn-cancel:hover { background:#e2e8f0; }
        .cm-btn-danger { padding:.45rem 1.25rem; border-radius:10px; font-size:.82rem; font-weight:700; background:var(--cm-red); color:#fff; border:none; cursor:pointer; transition:all .15s; }
        .cm-btn-danger:hover { background:#b91c1c; }
        .cm-btn-primary { padding:.45rem 1.25rem; border-radius:10px; font-size:.82rem; font-weight:700; background:var(--cm-blue); color:#fff; border:none; cursor:pointer; transition:all .15s; }
        .cm-btn-primary:hover { background:#1d4ed8; }
        .cm-btn-success { padding:.45rem 1.25rem; border-radius:10px; font-size:.82rem; font-weight:700; background:var(--cm-green); color:#fff; border:none; cursor:pointer; transition:all .15s; }
        .cm-btn-success:hover { background:#15803d; }

        /* Badge */
        .cm-badge { display:inline-flex; align-items:center; gap:.2rem; padding:.2rem .55rem; border-radius:8px; font-size:.68rem; font-weight:700; }
        .cm-badge-draft { background:#f1f5f9; color:#475569; border:1px solid #cbd5e1; }
        .cm-badge-active { background:rgba(37,99,235,.08); color:#1e40af; border:1px solid #bfdbfe; }
        .cm-badge-completed { background:rgba(22,163,74,.08); color:#166534; border:1px solid #bbf7d0; }

        @keyframes cmSlide { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
        .cm-animate { animation:cmSlide .3s ease; }
        @media(max-width:768px){ .cm-content{padding:0 .75rem 1.5rem;} }
    </style>
    @endpush

    @can('manage-circles')
    <section class="content cm-page">
        {{-- Hero --}}
        <div class="cm-hero">
            <div class="cm-hero-inner container-fluid">
                <a href="{{ route('circles.index') }}" class="cm-back"><i class="fas fa-arrow-left"></i> Back to Circles</a>
                <ul class="cm-breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('circles.index') }}">Circles</a></li>
                    <li class="sep">/</li>
                    <li class="active">{{ $circle->name }}</li>
                </ul>
                <div class="cm-hero-title">
                    <div>
                        <h1><i class="fas fa-users-cog"></i>{{ $circle->name }}</h1>
                        <p class="cm-hero-sub">Manage members and circle status</p>
                    </div>
                    @php
                        $heroColors = [
                            'draft'     => ['bg'=>'rgba(255,255,255,.12)','color'=>'#cbd5e1'],
                            'active'    => ['bg'=>'rgba(37,99,235,.2)','color'=>'#93c5fd'],
                            'completed' => ['bg'=>'rgba(34,197,94,.2)','color'=>'#86efac'],
                        ];
                        $hc = $heroColors[$circle->status] ?? ['bg'=>'rgba(255,255,255,.12)','color'=>'#cbd5e1'];
                    @endphp
                    <span class="cm-hero-badge" style="background:{{ $hc['bg'] }};color:{{ $hc['color'] }};">
                        {{ ucfirst($circle->status) }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="cm-content container-fluid cm-animate">

            {{-- Flash --}}
            @if (session()->has('message'))
                <div class="cm-flash cm-flash-success">
                    <i class="fas fa-check-circle"></i> {{ session('message') }}
                </div>
            @endif
            @if (session()->has('warning'))
                <div class="cm-flash cm-flash-warning">
                    <i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}
                </div>
            @endif

            {{-- Circle Info Strip --}}
            <div class="cm-info-strip">
                <div class="cm-info-item">
                    <div class="cm-info-icon" style="background:rgba(30,58,95,.08);color:var(--cm-navy);">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <div class="cm-info-label">Duration</div>
                        <div class="cm-info-value">{{ $circle->duration_months }} {{ Str::plural('month', $circle->duration_months) }}</div>
                    </div>
                </div>
                <div class="cm-info-item">
                    <div class="cm-info-icon" style="background:rgba(37,99,235,.08);color:var(--cm-blue);">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div>
                        <div class="cm-info-label">Start Date</div>
                        <div class="cm-info-value">{{ $circle->start_date->format('d M Y') }}</div>
                    </div>
                </div>
                <div class="cm-info-item">
                    <div class="cm-info-icon" style="background:rgba(22,163,74,.08);color:var(--cm-green);">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div>
                        <div class="cm-info-label">End Date</div>
                        <div class="cm-info-value">{{ $circle->end_date ? $circle->end_date->format('d M Y') : '--' }}</div>
                    </div>
                </div>
                <div class="cm-info-item">
                    <div class="cm-info-icon" style="background:rgba(217,119,6,.08);color:var(--cm-amber);">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <div class="cm-info-label">Members</div>
                        <div class="cm-info-value">{{ $circle->members_count }}</div>
                    </div>
                </div>
                <div class="cm-info-item">
                    <div class="cm-info-icon" style="background:rgba(100,116,139,.08);color:var(--cm-muted);">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <div class="cm-info-label">Created By</div>
                        <div class="cm-info-value">{{ $circle->creator->name ?? '--' }}</div>
                    </div>
                </div>
                <div class="cm-info-item">
                    <div class="cm-status-actions">
                        @if ($circle->status === 'draft')
                            <button wire:click="openStatusModal('active')" class="cm-btn-sm cm-btn-activate">
                                <i class="fas fa-play"></i> Activate
                            </button>
                        @elseif ($circle->status === 'active')
                            <a href="{{ route('months.index', $circle->id) }}" class="cm-btn-sm cm-btn-months">
                                <i class="fas fa-calendar-alt"></i> Months
                            </a>
                            <button wire:click="openStatusModal('completed')" class="cm-btn-sm cm-btn-complete">
                                <i class="fas fa-flag-checkered"></i> Complete
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                {{-- Add Member (only draft/active) --}}
                @if (in_array($circle->status, ['draft', 'active']))
                    <div class="col-lg-4">
                        <div class="cm-card" style="margin-bottom:1rem;">
                            <div class="cm-card-header">
                                <div class="cm-card-title"><i class="fas fa-user-plus"></i> Add Member</div>
                            </div>
                            <div class="cm-card-body">
                                <div class="cm-search">
                                    <div class="cm-search-label">Search Active Members</div>
                                    <div class="cm-search-wrap">
                                        <i class="fas fa-search"></i>
                                        <input type="text" wire:model.live.debounce.300ms="memberSearch" class="cm-search-input"
                                            placeholder="Type name, email or phone...">
                                    </div>

                                    @if ($showMemberResults && $this->memberResults->count() > 0)
                                        <div class="cm-search-results">
                                            @foreach ($this->memberResults as $mr)
                                                <button type="button" wire:click="addMember({{ $mr->id }})" class="cm-search-item">
                                                    @php
                                                        $rp = explode(' ', trim($mr->name));
                                                        $ri = strtoupper(substr($rp[0], 0, 1) . (isset($rp[1]) ? substr($rp[1], 0, 1) : ''));
                                                    @endphp
                                                    <div class="cm-avatar">{{ $ri }}</div>
                                                    <div>
                                                        <div style="font-weight:700;font-size:.84rem;color:var(--cm-text);">{{ $mr->name }}</div>
                                                        <div style="font-size:.72rem;color:var(--cm-faint);">{{ $mr->email }} &bull; {{ $mr->phone ?? 'No phone' }}</div>
                                                    </div>
                                                </button>
                                            @endforeach
                                        </div>
                                    @elseif ($showMemberResults && $this->memberResults->count() === 0)
                                        <div class="cm-search-results">
                                            <div class="cm-search-empty">
                                                <i class="fas fa-search mr-1"></i> No matching active members found
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="cm-search-hint">
                                    <i class="fas fa-info-circle"></i>
                                    Only active members not already in this circle are shown.
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Members Table --}}
                <div class="{{ in_array($circle->status, ['draft', 'active']) ? 'col-lg-8' : 'col-lg-12' }}">
                    <div class="cm-card">
                        <div class="cm-card-header">
                            <div class="cm-card-title">
                                <i class="fas fa-users"></i> Circle Members
                                <span class="cm-badge cm-badge-{{ $circle->status }}" style="margin-left:.35rem;">{{ $circle->members_count }}</span>
                            </div>
                        </div>
                        <div style="overflow-x:auto;">
                            <table class="cm-table">
                                <thead>
                                    <tr>
                                        <th>Member</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Joined</th>
                                        @if (in_array($circle->status, ['draft', 'active']))
                                            <th style="width:60px;">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($members as $m)
                                        <tr>
                                            <td>
                                                <div class="cm-member-cell">
                                                    @php
                                                        $parts = explode(' ', trim($m->name ?? ''));
                                                        $initials = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
                                                    @endphp
                                                    <div class="cm-avatar cm-avatar-lg">{{ $initials }}</div>
                                                    <div>
                                                        <div class="cm-member-name">{{ $m->name }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="color:var(--cm-muted);">{{ $m->email }}</td>
                                            <td style="color:var(--cm-muted);">{{ $m->phone ?? '--' }}</td>
                                            <td style="font-size:.78rem;color:var(--cm-faint);">
                                                {{ $m->pivot->joined_at ? \Carbon\Carbon::parse($m->pivot->joined_at)->format('d M Y') : '--' }}
                                            </td>
                                            @if (in_array($circle->status, ['draft', 'active']))
                                                <td>
                                                    <button wire:click="confirmRemove({{ $m->id }})" class="cm-act-delete" title="Remove">
                                                        <i class="fas fa-user-minus"></i>
                                                    </button>
                                                </td>
                                            @endif
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="{{ in_array($circle->status, ['draft', 'active']) ? 5 : 4 }}">
                                                <div class="cm-empty">
                                                    <i class="fas fa-users"></i>
                                                    <p>No members enrolled yet. Use the search on the left to add members.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if ($members->hasPages())
                            <div class="cm-footer">
                                <span class="cm-footer-info">
                                    Showing {{ $members->firstItem() ?? 0 }} - {{ $members->lastItem() ?? 0 }} of {{ $members->total() }}
                                </span>
                                {{ $members->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- ===== REMOVE MEMBER MODAL ===== --}}
    @if ($removeId)
        <div class="cm-overlay">
            <div class="cm-modal">
                <div class="cm-modal-icon" style="background:#fef2f2;color:var(--cm-red);">
                    <i class="fas fa-user-minus"></i>
                </div>
                <h5>Remove Member?</h5>
                <p>Remove <strong>{{ $removeName }}</strong> from <strong>{{ $circle->name }}</strong>?</p>
                <div class="cm-modal-btns">
                    <button wire:click="$set('removeId', null)" class="cm-btn-cancel">Cancel</button>
                    <button wire:click="removeMember" class="cm-btn-danger">
                        <i class="fas fa-user-minus mr-1"></i> Remove
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- ===== STATUS CHANGE MODAL ===== --}}
    @if ($showStatusModal)
        <div class="cm-overlay">
            <div class="cm-modal">
                @if ($targetStatus === 'active')
                    <div class="cm-modal-icon" style="background:rgba(37,99,235,.08);color:var(--cm-blue);">
                        <i class="fas fa-play-circle"></i>
                    </div>
                    <h5>Activate Circle?</h5>
                    <p>Activate <strong>{{ $circle->name }}</strong> with <strong>{{ $circle->members_count }}</strong> {{ Str::plural('member', $circle->members_count) }}? This will start the savings cycle.</p>
                    <div class="cm-modal-btns">
                        <button wire:click="$set('showStatusModal', false)" class="cm-btn-cancel">Cancel</button>
                        <button wire:click="changeStatus" class="cm-btn-primary">
                            <i class="fas fa-play mr-1"></i> Activate
                        </button>
                    </div>
                @else
                    <div class="cm-modal-icon" style="background:rgba(22,163,74,.08);color:var(--cm-green);">
                        <i class="fas fa-flag-checkered"></i>
                    </div>
                    <h5>Complete Circle?</h5>
                    <p>Mark <strong>{{ $circle->name }}</strong> as completed? No further transactions will be allowed.</p>
                    <div class="cm-modal-btns">
                        <button wire:click="$set('showStatusModal', false)" class="cm-btn-cancel">Cancel</button>
                        <button wire:click="changeStatus" class="cm-btn-success">
                            <i class="fas fa-check mr-1"></i> Complete
                        </button>
                    </div>
                @endif
            </div>
        </div>
    @endif
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
