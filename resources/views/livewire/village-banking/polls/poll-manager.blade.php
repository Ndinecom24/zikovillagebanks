<div>
    @push('custom-styles')
    <style>
        :root {
            --pm-navy:#1E3A5F;--pm-navy-light:#2B6B96;--pm-amber:#D97706;--pm-amber-light:#F59E0B;
            --pm-bg:#f4f6fa;--pm-card:#fff;--pm-border:#edf0f7;--pm-text:#1e293b;
            --pm-muted:#64748b;--pm-faint:#94a3b8;--pm-green:#16a34a;--pm-red:#dc2626;--pm-blue:#2563eb;--pm-purple:#7c3aed;--pm-radius:16px;
        }
        .pm-page{background:var(--pm-bg);min-height:100vh;}

        /* Hero */
        .pm-hero{background:linear-gradient(135deg,var(--pm-navy) 0%,#234b78 50%,var(--pm-navy-light) 100%);padding:1.75rem 0 6rem;position:relative;overflow:hidden;}
        .pm-hero::before{content:'';position:absolute;width:600px;height:600px;top:-60%;right:-8%;background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%);border-radius:50%;pointer-events:none;}
        .pm-hero-inner{position:relative;z-index:2;padding:0 1.5rem;}
        .pm-breadcrumb{display:flex;gap:.5rem;list-style:none;padding:0;margin:0 0 .75rem;font-size:.82rem;}
        .pm-breadcrumb a{color:rgba(255,255,255,.55);text-decoration:none;}
        .pm-breadcrumb a:hover{color:rgba(255,255,255,.85);}
        .pm-breadcrumb .active{color:var(--pm-amber-light);font-weight:600;}
        .pm-breadcrumb .sep{color:rgba(255,255,255,.25);}
        .pm-hero-row{display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:.75rem;}
        .pm-hero-title h1{color:#fff;font-size:1.6rem;font-weight:800;margin:0;}
        .pm-hero-title h1 i{color:var(--pm-amber);margin-right:.5rem;}
        .pm-hero-sub{color:rgba(255,255,255,.55);font-size:.88rem;margin:.25rem 0 0;}
        .pm-hero-actions{display:flex;gap:.5rem;flex-wrap:wrap;}
        .pm-hero-btn{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1.25rem;border-radius:10px;font-size:.82rem;font-weight:700;text-decoration:none;transition:all .2s;border:none;cursor:pointer;}
        .pm-hero-btn-primary{background:var(--pm-amber);color:#fff;}
        .pm-hero-btn-primary:hover{background:var(--pm-amber-light);color:#fff;text-decoration:none;transform:translateY(-1px);box-shadow:0 4px 12px rgba(217,119,6,.25);}
        .pm-hero-btn-outline{background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);color:rgba(255,255,255,.8);}
        .pm-hero-btn-outline:hover{background:rgba(255,255,255,.15);color:#fff;text-decoration:none;}

        /* Content */
        .pm-content{margin-top:-4rem;position:relative;z-index:10;padding:0 1.5rem 2rem;}

        /* Stats */
        .pm-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:1.25rem;}
        @media(max-width:768px){.pm-stats{grid-template-columns:1fr;}}
        .pm-stat{background:var(--pm-card);border-radius:var(--pm-radius);border:1px solid var(--pm-border);box-shadow:0 2px 12px rgba(0,0,0,.04);padding:1.1rem 1.25rem;display:flex;align-items:center;justify-content:space-between;transition:all .2s;}
        .pm-stat:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(0,0,0,.06);}
        .pm-stat-label{font-size:.62rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--pm-faint);}
        .pm-stat-value{font-size:1.5rem;font-weight:800;color:var(--pm-text);margin-top:.1rem;}
        .pm-stat-icon{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1rem;flex-shrink:0;}

        /* Card */
        .pm-card{background:var(--pm-card);border-radius:var(--pm-radius);border:1px solid var(--pm-border);box-shadow:0 2px 12px rgba(0,0,0,.04);overflow:hidden;}
        .pm-card-header{padding:1rem 1.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;border-bottom:1px solid var(--pm-border);}
        .pm-card-title{font-size:.95rem;font-weight:700;color:var(--pm-text);display:flex;align-items:center;gap:.4rem;}
        .pm-card-title i{color:var(--pm-amber);font-size:.8rem;}
        .pm-toolbar{display:flex;align-items:center;flex-wrap:wrap;gap:.6rem;}
        .pm-search{position:relative;}
        .pm-search i{position:absolute;left:.75rem;top:50%;transform:translateY(-50%);font-size:.72rem;color:var(--pm-faint);}
        .pm-search input{padding:.45rem .75rem .45rem 2rem;border:1px solid var(--pm-border);border-radius:10px;font-size:.82rem;background:#fafbfd;width:200px;transition:border .2s;}
        .pm-search input:focus{outline:none;border-color:var(--pm-amber);background:#fff;box-shadow:0 0 0 3px rgba(217,119,6,.08);}
        .pm-select{padding:.45rem .75rem;border:1px solid var(--pm-border);border-radius:10px;font-size:.82rem;background:#fafbfd;cursor:pointer;}
        .pm-select:focus{outline:none;border-color:var(--pm-amber);}

        /* Alert */
        .pm-alert{padding:.7rem 1rem;border-radius:12px;font-size:.84rem;display:flex;align-items:center;gap:.5rem;margin-bottom:1rem;}
        .pm-alert-success{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;}
        .pm-alert-warning{background:#fffbeb;color:#92400e;border:1px solid #fde68a;}

        /* Table */
        .pm-table{width:100%;border-collapse:collapse;}
        .pm-table thead th{font-size:.62rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--pm-faint);padding:.7rem 1rem;border-bottom:1px solid var(--pm-border);background:#fafbfd;white-space:nowrap;}
        .pm-table tbody td{padding:.7rem 1rem;border-bottom:1px solid #f5f7fa;font-size:.84rem;vertical-align:middle;}
        .pm-table tbody tr:last-child td{border-bottom:none;}
        .pm-table tbody tr:hover{background:#fafbfd;}
        .pm-badge{display:inline-flex;align-items:center;gap:.25rem;padding:.2rem .55rem;border-radius:8px;font-size:.68rem;font-weight:700;}
        .pm-question-text{font-weight:700;color:var(--pm-text);font-size:.86rem;}
        .pm-question-desc{font-size:.72rem;color:var(--pm-faint);margin-top:.1rem;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden;}

        /* Actions */
        .pm-actions{display:flex;gap:.3rem;}
        .pm-act{width:28px;height:28px;border-radius:8px;display:flex;align-items:center;justify-content:center;border:1px solid var(--pm-border);background:#fafbfd;color:var(--pm-muted);cursor:pointer;font-size:.65rem;transition:all .15s;text-decoration:none;}
        .pm-act:hover{border-color:var(--pm-blue);color:var(--pm-blue);background:rgba(37,99,235,.04);}
        .pm-act-edit:hover{border-color:var(--pm-amber);color:var(--pm-amber);background:rgba(217,119,6,.04);}
        .pm-act-go:hover{border-color:var(--pm-green);color:var(--pm-green);background:rgba(22,163,74,.04);}
        .pm-act-stop:hover{border-color:#92400e;color:#92400e;background:rgba(217,119,6,.04);}
        .pm-act-del:hover{border-color:var(--pm-red);color:var(--pm-red);background:rgba(220,38,38,.04);}

        /* Footer */
        .pm-footer{padding:.85rem 1.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;border-top:1px solid var(--pm-border);}
        .pm-footer-info{font-size:.78rem;color:var(--pm-faint);}

        /* Empty */
        .pm-empty{text-align:center;padding:3rem 1rem;}
        .pm-empty i{font-size:2.5rem;opacity:.12;display:block;margin-bottom:.75rem;color:var(--pm-navy);}
        .pm-empty p{font-size:.88rem;color:var(--pm-muted);margin:0;}

        /* Modal */
        .pm-modal-overlay{position:fixed;inset:0;background:rgba(15,23,42,.45);z-index:1050;display:flex;align-items:center;justify-content:center;padding:1rem;backdrop-filter:blur(2px);}
        .pm-modal{background:var(--pm-card);border-radius:var(--pm-radius);width:100%;box-shadow:0 20px 60px rgba(0,0,0,.15);overflow:hidden;animation:pmModalIn .2s ease;}
        .pm-modal-lg{max-width:680px;}
        .pm-modal-sm{max-width:440px;}
        .pm-modal-header{padding:1rem 1.5rem;display:flex;align-items:center;justify-content:space-between;background:linear-gradient(135deg,var(--pm-navy),var(--pm-navy-light));color:#fff;}
        .pm-modal-header h5{margin:0;font-size:.95rem;font-weight:700;display:flex;align-items:center;gap:.4rem;}
        .pm-modal-header h5 i{color:var(--pm-amber);font-size:.8rem;}
        .pm-modal-close{background:none;border:none;color:rgba(255,255,255,.5);font-size:1.25rem;cursor:pointer;padding:0;line-height:1;}
        .pm-modal-close:hover{color:#fff;}
        .pm-modal-body{padding:1.5rem;}
        .pm-modal-footer{padding:.85rem 1.5rem;display:flex;align-items:center;justify-content:flex-end;gap:.5rem;border-top:1px solid var(--pm-border);}
        .pm-modal-header-danger{background:linear-gradient(135deg,#991b1b,#dc2626);}

        /* Form */
        .pm-label{display:block;font-size:.7rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--pm-faint);margin-bottom:.35rem;}
        .pm-input{width:100%;padding:.55rem .85rem;border:1px solid var(--pm-border);border-radius:10px;font-size:.85rem;background:#fafbfd;transition:border .2s;}
        .pm-input:focus{outline:none;border-color:var(--pm-amber);background:#fff;box-shadow:0 0 0 3px rgba(217,119,6,.08);}
        .pm-form-grid{display:grid;gap:.85rem;}
        .pm-form-row{display:grid;grid-template-columns:1fr 1fr;gap:.85rem;}
        .pm-form-row-3{display:grid;grid-template-columns:1fr 1fr 1fr;gap:.85rem;}
        @media(max-width:576px){.pm-form-row,.pm-form-row-3{grid-template-columns:1fr;}}
        .pm-btn{display:inline-flex;align-items:center;gap:.4rem;padding:.5rem 1.1rem;border-radius:10px;font-size:.82rem;font-weight:700;border:none;cursor:pointer;transition:all .2s;}
        .pm-btn-primary{background:var(--pm-amber);color:#fff;}
        .pm-btn-primary:hover{background:var(--pm-amber-light);transform:translateY(-1px);}
        .pm-btn-cancel{background:#f1f5f9;color:var(--pm-muted);}
        .pm-btn-cancel:hover{background:#e2e8f0;}
        .pm-btn-danger{background:var(--pm-red);color:#fff;}
        .pm-btn-danger:hover{background:#b91c1c;transform:translateY(-1px);}
        .pm-btn-outline-sm{padding:.3rem .65rem;border-radius:8px;font-size:.76rem;font-weight:600;background:#fafbfd;border:1px solid var(--pm-border);color:var(--pm-muted);cursor:pointer;transition:all .15s;}
        .pm-btn-outline-sm:hover{border-color:var(--pm-amber);color:var(--pm-amber);}
        .pm-btn-del-sm{padding:.3rem .5rem;border-radius:8px;font-size:.72rem;background:none;border:1px solid rgba(220,38,38,.15);color:var(--pm-red);cursor:pointer;}
        .pm-btn-del-sm:hover{background:rgba(220,38,38,.04);border-color:var(--pm-red);}

        /* Switch */
        .pm-switch{display:flex;align-items:center;gap:.5rem;cursor:pointer;}
        .pm-switch input{display:none;}
        .pm-switch-track{width:36px;height:20px;border-radius:20px;background:#cbd5e1;position:relative;transition:background .2s;}
        .pm-switch input:checked + .pm-switch-track{background:var(--pm-green);}
        .pm-switch-knob{width:16px;height:16px;border-radius:50%;background:#fff;position:absolute;top:2px;left:2px;transition:left .2s;box-shadow:0 1px 3px rgba(0,0,0,.15);}
        .pm-switch input:checked + .pm-switch-track .pm-switch-knob{left:18px;}
        .pm-switch-label{font-size:.82rem;color:var(--pm-muted);font-weight:600;}

        /* Option row */
        .pm-opt-row{display:flex;gap:.5rem;align-items:center;margin-bottom:.5rem;}
        .pm-opt-num{width:26px;height:34px;display:flex;align-items:center;justify-content:center;background:#fafbfd;border:1px solid var(--pm-border);border-radius:8px;font-size:.72rem;font-weight:700;color:var(--pm-faint);flex-shrink:0;}

        @keyframes pmModalIn{from{opacity:0;transform:scale(.95) translateY(10px)}to{opacity:1;transform:scale(1) translateY(0)}}
        @keyframes pmSlide{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
        .pm-animate{animation:pmSlide .3s ease;}
        @media(max-width:768px){.pm-content{padding:0 .75rem 1.5rem;}.pm-search input{width:150px;}}
    </style>
    @endpush

    @can('manage-polls')
    <section class="content pm-page">
        {{-- ████ Hero ████ --}}
        <div class="pm-hero">
            <div class="pm-hero-inner container-fluid">
                <ul class="pm-breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li class="active">Polls & Voting</li>
                </ul>
                <div class="pm-hero-row">
                    <div class="pm-hero-title">
                        <h1><i class="fas fa-poll"></i>Polls & Voting</h1>
                        <p class="pm-hero-sub">Create polls, gather member votes and make data-driven decisions</p>
                    </div>
                    <div class="pm-hero-actions">
                        <button wire:click="openCreate" class="pm-hero-btn pm-hero-btn-primary">
                            <i class="fas fa-plus-circle"></i> Create Poll
                        </button>
                        <a href="{{ route('polls.vote') }}" class="pm-hero-btn pm-hero-btn-outline">
                            <i class="fas fa-vote-yea"></i> Voting Portal
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- ████ Content ████ --}}
        <div class="pm-content container-fluid pm-animate">

            @if (session()->has('message'))
                <div class="pm-alert pm-alert-success"><i class="fas fa-check-circle"></i> {{ session('message') }}</div>
            @endif
            @if (session()->has('warning'))
                <div class="pm-alert pm-alert-warning"><i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}</div>
            @endif

            {{-- Stats --}}
            <div class="pm-stats">
                <div class="pm-stat">
                    <div>
                        <div class="pm-stat-label">Total Polls</div>
                        <div class="pm-stat-value">{{ $totalPolls }}</div>
                    </div>
                    <div class="pm-stat-icon" style="background:rgba(30,58,95,.08);color:var(--pm-navy);"><i class="fas fa-poll"></i></div>
                </div>
                <div class="pm-stat">
                    <div>
                        <div class="pm-stat-label">Active Polls</div>
                        <div class="pm-stat-value" style="color:var(--pm-green);">{{ $activePolls }}</div>
                    </div>
                    <div class="pm-stat-icon" style="background:rgba(22,163,74,.08);color:var(--pm-green);"><i class="fas fa-vote-yea"></i></div>
                </div>
                <div class="pm-stat">
                    <div>
                        <div class="pm-stat-label">Total Votes Cast</div>
                        <div class="pm-stat-value" style="color:var(--pm-purple);">{{ $totalVotes }}</div>
                    </div>
                    <div class="pm-stat-icon" style="background:rgba(124,58,237,.08);color:var(--pm-purple);"><i class="fas fa-check-square"></i></div>
                </div>
            </div>

            {{-- Table --}}
            <div class="pm-card">
                <div class="pm-card-header">
                    <div class="pm-card-title"><i class="fas fa-list-alt"></i> All Polls</div>
                    <div class="pm-toolbar">
                        @include('partials.village-bank-selector')
                        <select wire:model.live="statusFilter" class="pm-select">
                            <option value="">All Statuses</option>
                            <option value="draft">Draft</option>
                            <option value="active">Active</option>
                            <option value="closed">Closed</option>
                        </select>
                        <div class="pm-search">
                            <i class="fas fa-search"></i>
                            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search polls...">
                        </div>
                        <select wire:model.live="perPage" class="pm-select" style="width:70px;">
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                        </select>
                    </div>
                </div>

                <div style="overflow-x:auto;">
                    <table class="pm-table">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Village Bank</th>
                                <th>Type</th>
                                <th>Options</th>
                                <th>Votes</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th style="width:14%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($polls as $poll)
                                @php
                                    $sc = ['draft'=>['rgba(100,116,139,.06)','#475569','rgba(100,116,139,.15)'],'active'=>['rgba(22,163,74,.06)','#166534','rgba(22,163,74,.2)'],'closed'=>['rgba(220,38,38,.06)','#991b1b','rgba(220,38,38,.2)']][$poll->status] ?? ['rgba(100,116,139,.06)','#475569','rgba(100,116,139,.15)'];
                                @endphp
                                <tr>
                                    <td>
                                        <div class="pm-question-text">{{ Str::limit($poll->question, 50) }}</div>
                                        @if ($poll->description)
                                            <div class="pm-question-desc">{{ Str::limit($poll->description, 50) }}</div>
                                        @endif
                                        @if ($poll->is_anonymous)
                                            <span class="pm-badge" style="background:rgba(217,119,6,.06);color:var(--pm-amber);border:1px solid rgba(217,119,6,.15);margin-top:.2rem;">
                                                <i class="fas fa-user-secret" style="font-size:.45rem;"></i> Anonymous
                                            </span>
                                        @endif
                                    </td>
                                    <td style="font-size:.82rem;">{{ $poll->villageBank->name ?? '--' }}</td>
                                    <td>
                                        <span class="pm-badge" style="background:rgba(30,58,95,.06);color:var(--pm-navy);border:1px solid rgba(30,58,95,.15);">
                                            {{ ucfirst($poll->type) }}
                                        </span>
                                    </td>
                                    <td style="text-align:center;font-weight:700;">{{ $poll->options_count }}</td>
                                    <td style="text-align:center;font-weight:800;color:var(--pm-purple);">{{ $poll->votes_count }}</td>
                                    <td>
                                        <span class="pm-badge" style="background:{{ $sc[0] }};color:{{ $sc[1] }};border:1px solid {{ $sc[2] }};">
                                            <i class="fas fa-circle" style="font-size:.3rem;"></i> {{ ucfirst($poll->status) }}
                                        </span>
                                    </td>
                                    <td style="font-size:.78rem;color:var(--pm-faint);">{{ $poll->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="pm-actions">
                                            <a href="{{ route('polls.show', $poll->id) }}" class="pm-act" title="View Results">
                                                <i class="fas fa-chart-bar"></i>
                                            </a>
                                            @if ($poll->status === 'draft')
                                                <button wire:click="openEdit({{ $poll->id }})" class="pm-act pm-act-edit" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                                <button wire:click="activatePoll({{ $poll->id }})" class="pm-act pm-act-go" title="Activate">
                                                    <i class="fas fa-play"></i>
                                                </button>
                                            @endif
                                            @if ($poll->status === 'active')
                                                <button wire:click="closePoll({{ $poll->id }})" class="pm-act pm-act-stop" title="Close">
                                                    <i class="fas fa-stop"></i>
                                                </button>
                                            @endif
                                            <button wire:click="confirmDelete({{ $poll->id }})" class="pm-act pm-act-del" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <div class="pm-empty">
                                            <i class="fas fa-poll"></i>
                                            <p>No polls found. Click <strong>Create Poll</strong> to start gathering votes.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($polls->hasPages())
                    <div class="pm-footer">
                        <span class="pm-footer-info">Showing {{ $polls->firstItem() ?? 0 }} - {{ $polls->lastItem() ?? 0 }} of {{ $polls->total() }}</span>
                        {{ $polls->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- ═══════════════ CREATE / EDIT MODAL ═══════════════ --}}
    @if ($showFormModal)
        <div class="pm-modal-overlay" wire:click.self="$set('showFormModal', false)">
            <div class="pm-modal pm-modal-lg">
                <div class="pm-modal-header">
                    <h5><i class="fas fa-{{ $editingId ? 'edit' : 'plus-circle' }}"></i> {{ $editingId ? 'Edit Poll' : 'Create Poll' }}</h5>
                    <button wire:click="$set('showFormModal', false)" class="pm-modal-close">&times;</button>
                </div>
                <form wire:submit.prevent="savePoll">
                    <div class="pm-modal-body">
                        <div class="pm-form-grid">
                            <div class="pm-form-row-3">
                                <div>
                                    <label class="pm-label">Village Bank <span style="color:var(--pm-red);">*</span></label>
                                    <select wire:model.live="formBankId" class="pm-input" style="cursor:pointer;">
                                        <option value="">-- Select --</option>
                                        @foreach ($this->villageBanks as $vb)
                                            <option value="{{ $vb->id }}">{{ $vb->name }} ({{ $vb->code }})</option>
                                        @endforeach
                                    </select>
                                    @error('formBankId') <small style="color:var(--pm-red);font-size:.76rem;">{{ $message }}</small> @enderror
                                </div>
                                <div>
                                    <label class="pm-label">Vote Type</label>
                                    <select wire:model.live="pollType" class="pm-input" style="cursor:pointer;">
                                        <option value="single">Single Choice</option>
                                        <option value="multiple">Multiple Choice</option>
                                    </select>
                                </div>
                                <div style="display:flex;align-items:flex-end;padding-bottom:.35rem;">
                                    <label class="pm-switch">
                                        <input type="checkbox" wire:model="isAnonymous">
                                        <div class="pm-switch-track"><div class="pm-switch-knob"></div></div>
                                        <span class="pm-switch-label">Anonymous</span>
                                    </label>
                                </div>
                            </div>
                            <div>
                                <label class="pm-label">Question <span style="color:var(--pm-red);">*</span></label>
                                <input type="text" wire:model="question" class="pm-input" placeholder="e.g. Should we increase the interest rate to 25%?">
                                @error('question') <small style="color:var(--pm-red);font-size:.76rem;">{{ $message }}</small> @enderror
                            </div>
                            <div>
                                <label class="pm-label">Additional Context (optional)</label>
                                <textarea wire:model="description" class="pm-input" rows="2" placeholder="Provide more detail or background..." style="resize:vertical;"></textarea>
                            </div>
                            <div>
                                <label class="pm-label">Options <span style="color:var(--pm-red);">*</span></label>
                                @foreach ($options as $i => $opt)
                                    <div class="pm-opt-row">
                                        <div class="pm-opt-num">{{ $i + 1 }}</div>
                                        <input type="text" wire:model="options.{{ $i }}" class="pm-input" placeholder="Option {{ $i + 1 }}" style="flex:1;">
                                        @if (count($options) > 2)
                                            <button type="button" wire:click="removeOption({{ $i }})" class="pm-btn-del-sm"><i class="fas fa-times"></i></button>
                                        @endif
                                    </div>
                                @endforeach
                                @error('options.*') <small style="color:var(--pm-red);font-size:.76rem;">{{ $message }}</small> @enderror
                                @if (count($options) < 10)
                                    <button type="button" wire:click="addOption" class="pm-btn-outline-sm" style="margin-top:.25rem;">
                                        <i class="fas fa-plus"></i> Add Option
                                    </button>
                                @endif
                            </div>
                            <div class="pm-form-row">
                                <div>
                                    <label class="pm-label">Start Date / Time (optional)</label>
                                    <input type="datetime-local" wire:model="startsAt" class="pm-input">
                                </div>
                                <div>
                                    <label class="pm-label">End Date / Time (optional)</label>
                                    <input type="datetime-local" wire:model="endsAt" class="pm-input">
                                    @error('endsAt') <small style="color:var(--pm-red);font-size:.76rem;">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pm-modal-footer">
                        <button type="button" wire:click="$set('showFormModal', false)" class="pm-btn pm-btn-cancel">Cancel</button>
                        <button type="submit" class="pm-btn pm-btn-primary">
                            <i class="fas fa-save"></i> {{ $editingId ? 'Update Poll' : 'Save as Draft' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- ═══════════════ DELETE MODAL ═══════════════ --}}
    @if ($deleteId)
        <div class="pm-modal-overlay" wire:click.self="$set('deleteId', null)">
            <div class="pm-modal pm-modal-sm">
                <div class="pm-modal-header pm-modal-header-danger">
                    <h5><i class="fas fa-exclamation-triangle"></i> Delete Poll</h5>
                    <button wire:click="$set('deleteId', null)" class="pm-modal-close">&times;</button>
                </div>
                <div class="pm-modal-body">
                    <p style="font-size:.88rem;color:var(--pm-text);margin:0 0 .5rem;">Are you sure you want to delete this poll?</p>
                    <p style="font-style:italic;color:var(--pm-faint);font-size:.84rem;margin:0 0 .5rem;">"{{ $deleteQuestion }}"</p>
                    <p style="color:var(--pm-red);font-size:.8rem;margin:0;">All votes and comments will be permanently removed.</p>
                </div>
                <div class="pm-modal-footer">
                    <button wire:click="$set('deleteId', null)" class="pm-btn pm-btn-cancel">Cancel</button>
                    <button wire:click="deletePoll" class="pm-btn pm-btn-danger">
                        <i class="fas fa-trash-alt"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    @endif
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
