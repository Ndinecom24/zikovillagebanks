<div>
    @push('custom-styles')
    <style>
        :root {
            --rm-navy:#1E3A5F;--rm-navy-light:#2B6B96;--rm-amber:#D97706;--rm-amber-light:#F59E0B;
            --rm-bg:#f4f6fa;--rm-card:#fff;--rm-border:#edf0f7;--rm-text:#1e293b;
            --rm-muted:#64748b;--rm-faint:#94a3b8;--rm-green:#16a34a;--rm-red:#dc2626;--rm-blue:#2563eb;--rm-purple:#7c3aed;--rm-radius:16px;
        }
        .rm-page{background:var(--rm-bg);min-height:100vh;}

        /* Hero */
        .rm-hero{background:linear-gradient(135deg,var(--rm-navy) 0%,#234b78 50%,var(--rm-navy-light) 100%);padding:1.75rem 0 6rem;position:relative;overflow:hidden;}
        .rm-hero::before{content:'';position:absolute;width:600px;height:600px;top:-60%;right:-8%;background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%);border-radius:50%;pointer-events:none;}
        .rm-hero-inner{position:relative;z-index:2;padding:0 1.5rem;}
        .rm-breadcrumb{display:flex;gap:.5rem;list-style:none;padding:0;margin:0 0 .75rem;font-size:.82rem;}
        .rm-breadcrumb a{color:rgba(255,255,255,.55);text-decoration:none;}
        .rm-breadcrumb a:hover{color:rgba(255,255,255,.85);}
        .rm-breadcrumb .active{color:var(--rm-amber-light);font-weight:600;}
        .rm-breadcrumb .sep{color:rgba(255,255,255,.25);}
        .rm-hero-row{display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:.75rem;}
        .rm-hero-title h1{color:#fff;font-size:1.6rem;font-weight:800;margin:0;}
        .rm-hero-title h1 i{color:var(--rm-amber);margin-right:.5rem;}
        .rm-hero-sub{color:rgba(255,255,255,.55);font-size:.88rem;margin:.25rem 0 0;}
        .rm-hero-btn{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1.25rem;border-radius:10px;font-size:.82rem;font-weight:700;text-decoration:none;transition:all .2s;background:var(--rm-amber);color:#fff;border:none;cursor:pointer;}
        .rm-hero-btn:hover{background:var(--rm-amber-light);color:#fff;text-decoration:none;transform:translateY(-1px);box-shadow:0 4px 12px rgba(217,119,6,.25);}

        /* Content */
        .rm-content{margin-top:-4rem;position:relative;z-index:10;padding:0 1.5rem 2rem;}

        /* Stats */
        .rm-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.25rem;}
        @media(max-width:768px){.rm-stats{grid-template-columns:repeat(2,1fr);}}
        .rm-stat{background:var(--rm-card);border-radius:var(--rm-radius);border:1px solid var(--rm-border);box-shadow:0 2px 12px rgba(0,0,0,.04);padding:1.1rem 1.25rem;display:flex;align-items:center;justify-content:space-between;transition:all .2s;}
        .rm-stat:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(0,0,0,.06);}
        .rm-stat-label{font-size:.62rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--rm-faint);}
        .rm-stat-value{font-size:1.5rem;font-weight:800;color:var(--rm-text);margin-top:.1rem;}
        .rm-stat-icon{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1rem;flex-shrink:0;}

        /* Card */
        .rm-card{background:var(--rm-card);border-radius:var(--rm-radius);border:1px solid var(--rm-border);box-shadow:0 2px 12px rgba(0,0,0,.04);overflow:hidden;}
        .rm-card-header{padding:1rem 1.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;border-bottom:1px solid var(--rm-border);}
        .rm-card-title{font-size:.95rem;font-weight:700;color:var(--rm-text);display:flex;align-items:center;gap:.4rem;}
        .rm-card-title i{color:var(--rm-amber);font-size:.8rem;}
        .rm-toolbar{display:flex;align-items:center;flex-wrap:wrap;gap:.6rem;}
        .rm-search{position:relative;}
        .rm-search i{position:absolute;left:.75rem;top:50%;transform:translateY(-50%);font-size:.72rem;color:var(--rm-faint);}
        .rm-search input{padding:.45rem .75rem .45rem 2rem;border:1px solid var(--rm-border);border-radius:10px;font-size:.82rem;background:#fafbfd;width:200px;transition:border .2s;}
        .rm-search input:focus{outline:none;border-color:var(--rm-amber);background:#fff;box-shadow:0 0 0 3px rgba(217,119,6,.08);}
        .rm-select{padding:.45rem .75rem;border:1px solid var(--rm-border);border-radius:10px;font-size:.82rem;background:#fafbfd;cursor:pointer;}
        .rm-select:focus{outline:none;border-color:var(--rm-amber);}

        /* Alert */
        .rm-alert{padding:.7rem 1rem;border-radius:12px;font-size:.84rem;display:flex;align-items:center;gap:.5rem;margin-bottom:1rem;background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;}

        /* Table */
        .rm-table{width:100%;border-collapse:collapse;}
        .rm-table thead th{font-size:.62rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--rm-faint);padding:.7rem 1rem;border-bottom:1px solid var(--rm-border);background:#fafbfd;white-space:nowrap;}
        .rm-table tbody td{padding:.7rem 1rem;border-bottom:1px solid #f5f7fa;font-size:.84rem;vertical-align:middle;}
        .rm-table tbody tr:last-child td{border-bottom:none;}
        .rm-table tbody tr:hover{background:#fafbfd;}

        /* Badge */
        .rm-badge{display:inline-flex;align-items:center;gap:.25rem;padding:.2rem .55rem;border-radius:8px;font-size:.68rem;font-weight:700;}

        /* Category colors */
        .rm-cat-general{background:rgba(100,116,139,.06);color:#475569;border:1px solid rgba(100,116,139,.15);}
        .rm-cat-loans{background:rgba(37,99,235,.06);color:#1e40af;border:1px solid rgba(37,99,235,.15);}
        .rm-cat-shares{background:rgba(22,163,74,.06);color:#166534;border:1px solid rgba(22,163,74,.15);}
        .rm-cat-penalties{background:rgba(220,38,38,.06);color:#991b1b;border:1px solid rgba(220,38,38,.15);}
        .rm-cat-membership{background:rgba(124,58,237,.06);color:#5b21b6;border:1px solid rgba(124,58,237,.15);}
        .rm-cat-meetings{background:rgba(217,119,6,.06);color:#92400e;border:1px solid rgba(217,119,6,.15);}

        /* Progress */
        .rm-progress-wrap{display:flex;align-items:center;gap:.4rem;}
        .rm-progress-bar{flex:1;height:6px;border-radius:6px;background:var(--rm-border);overflow:hidden;min-width:50px;}
        .rm-progress-fill{height:100%;border-radius:6px;background:var(--rm-green);transition:width .3s;}
        .rm-progress-pct{font-size:.7rem;color:var(--rm-faint);font-weight:700;min-width:22px;}

        /* Actions */
        .rm-actions{display:flex;gap:.3rem;}
        .rm-act{width:28px;height:28px;border-radius:8px;display:flex;align-items:center;justify-content:center;border:1px solid var(--rm-border);background:#fafbfd;color:var(--rm-muted);cursor:pointer;font-size:.65rem;transition:all .15s;text-decoration:none;}
        .rm-act:hover{border-color:var(--rm-blue);color:var(--rm-blue);background:rgba(37,99,235,.04);}
        .rm-act-edit:hover{border-color:var(--rm-amber);color:var(--rm-amber);background:rgba(217,119,6,.04);}
        .rm-act-toggle:hover{border-color:var(--rm-purple);color:var(--rm-purple);background:rgba(124,58,237,.04);}
        .rm-act-ack{border-color:rgba(22,163,74,.2);color:var(--rm-green);background:rgba(22,163,74,.04);}
        .rm-act-ack:hover{background:rgba(22,163,74,.08);border-color:var(--rm-green);}
        .rm-act-acked{border-color:rgba(22,163,74,.2);color:var(--rm-green);background:rgba(22,163,74,.06);cursor:default;}
        .rm-act-del:hover{border-color:var(--rm-red);color:var(--rm-red);background:rgba(220,38,38,.04);}

        /* Title cell */
        .rm-rule-title{font-weight:700;color:var(--rm-text);font-size:.86rem;}
        .rm-rule-desc{font-size:.72rem;color:var(--rm-faint);margin-top:.1rem;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden;}

        /* Footer */
        .rm-footer{padding:.85rem 1.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;border-top:1px solid var(--rm-border);}
        .rm-footer-info{font-size:.78rem;color:var(--rm-faint);}

        /* Empty */
        .rm-empty{text-align:center;padding:3rem 1rem;}
        .rm-empty i{font-size:2.5rem;opacity:.12;display:block;margin-bottom:.75rem;color:var(--rm-navy);}
        .rm-empty p{font-size:.88rem;color:var(--rm-muted);margin:0;}

        /* Modal overlay */
        .rm-modal-overlay{position:fixed;inset:0;background:rgba(15,23,42,.45);z-index:1050;display:flex;align-items:center;justify-content:center;padding:1rem;backdrop-filter:blur(2px);}
        .rm-modal{background:var(--rm-card);border-radius:var(--rm-radius);width:100%;box-shadow:0 20px 60px rgba(0,0,0,.15);overflow:hidden;animation:rmModalIn .2s ease;}
        .rm-modal-lg{max-width:680px;}
        .rm-modal-sm{max-width:440px;}
        .rm-modal-header{padding:1rem 1.5rem;display:flex;align-items:center;justify-content:space-between;background:linear-gradient(135deg,var(--rm-navy),var(--rm-navy-light));color:#fff;}
        .rm-modal-header h5{margin:0;font-size:.95rem;font-weight:700;display:flex;align-items:center;gap:.4rem;}
        .rm-modal-header h5 i{color:var(--rm-amber);font-size:.8rem;}
        .rm-modal-close{background:none;border:none;color:rgba(255,255,255,.5);font-size:1.25rem;cursor:pointer;padding:0;line-height:1;}
        .rm-modal-close:hover{color:#fff;}
        .rm-modal-body{padding:1.5rem;}
        .rm-modal-footer{padding:.85rem 1.5rem;display:flex;align-items:center;justify-content:flex-end;gap:.5rem;border-top:1px solid var(--rm-border);}
        .rm-modal-header-danger{background:linear-gradient(135deg,#991b1b,#dc2626);}

        /* Form */
        .rm-label{display:block;font-size:.7rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--rm-faint);margin-bottom:.35rem;}
        .rm-input{width:100%;padding:.55rem .85rem;border:1px solid var(--rm-border);border-radius:10px;font-size:.85rem;background:#fafbfd;transition:border .2s;}
        .rm-input:focus{outline:none;border-color:var(--rm-amber);background:#fff;box-shadow:0 0 0 3px rgba(217,119,6,.08);}
        .rm-form-grid{display:grid;gap:.85rem;}
        .rm-form-row{display:grid;grid-template-columns:1fr 1fr;gap:.85rem;}
        @media(max-width:576px){.rm-form-row{grid-template-columns:1fr;}}
        .rm-form-row-3{display:grid;grid-template-columns:1fr 1fr 1fr;gap:.85rem;}
        @media(max-width:576px){.rm-form-row-3{grid-template-columns:1fr;}}
        .rm-btn{display:inline-flex;align-items:center;gap:.4rem;padding:.5rem 1.1rem;border-radius:10px;font-size:.82rem;font-weight:700;border:none;cursor:pointer;transition:all .2s;}
        .rm-btn-primary{background:var(--rm-amber);color:#fff;}
        .rm-btn-primary:hover{background:var(--rm-amber-light);transform:translateY(-1px);}
        .rm-btn-cancel{background:#f1f5f9;color:var(--rm-muted);}
        .rm-btn-cancel:hover{background:#e2e8f0;}
        .rm-btn-danger{background:var(--rm-red);color:#fff;}
        .rm-btn-danger:hover{background:#b91c1c;transform:translateY(-1px);}
        .rm-btn-green{background:var(--rm-green);color:#fff;}
        .rm-btn-green:hover{background:#15803d;transform:translateY(-1px);}

        /* Switch */
        .rm-switch{display:flex;align-items:center;gap:.5rem;cursor:pointer;}
        .rm-switch input{display:none;}
        .rm-switch-track{width:36px;height:20px;border-radius:20px;background:#cbd5e1;position:relative;transition:background .2s;}
        .rm-switch input:checked + .rm-switch-track{background:var(--rm-green);}
        .rm-switch-knob{width:16px;height:16px;border-radius:50%;background:#fff;position:absolute;top:2px;left:2px;transition:left .2s;box-shadow:0 1px 3px rgba(0,0,0,.15);}
        .rm-switch input:checked + .rm-switch-track .rm-switch-knob{left:18px;}
        .rm-switch-label{font-size:.82rem;color:var(--rm-muted);font-weight:600;}

        @keyframes rmModalIn{from{opacity:0;transform:scale(.95) translateY(10px)}to{opacity:1;transform:scale(1) translateY(0)}}
        @keyframes rmSlide{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
        .rm-animate{animation:rmSlide .3s ease;}
        @media(max-width:768px){.rm-content{padding:0 .75rem 1.5rem;}.rm-search input{width:150px;}}
    </style>
    @endpush

    @can('view-rules')
    <section class="content rm-page">
        {{-- ████ Hero ████ --}}
        <div class="rm-hero">
            <div class="rm-hero-inner container-fluid">
                <ul class="rm-breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li class="active">Rules & Bylaws</li>
                </ul>
                <div class="rm-hero-row">
                    <div class="rm-hero-title">
                        <h1><i class="fas fa-book"></i>Rules & Bylaws</h1>
                        <p class="rm-hero-sub">Manage village bank rules, policies and member acknowledgements</p>
                    </div>
                    <button wire:click="openCreate" class="rm-hero-btn">
                        <i class="fas fa-plus-circle"></i> Create Rule
                    </button>
                </div>
            </div>
        </div>

        {{-- ████ Content ████ --}}
        <div class="rm-content container-fluid rm-animate">

            {{-- Flash --}}
            @if (session()->has('message'))
                <div class="rm-alert"><i class="fas fa-check-circle"></i> {{ session('message') }}</div>
            @endif

            {{-- Stats --}}
            <div class="rm-stats">
                <div class="rm-stat">
                    <div>
                        <div class="rm-stat-label">Total Rules</div>
                        <div class="rm-stat-value">{{ $totalRules }}</div>
                    </div>
                    <div class="rm-stat-icon" style="background:rgba(30,58,95,.08);color:var(--rm-navy);"><i class="fas fa-book"></i></div>
                </div>
                <div class="rm-stat">
                    <div>
                        <div class="rm-stat-label">Active Rules</div>
                        <div class="rm-stat-value" style="color:var(--rm-green);">{{ $activeRules }}</div>
                    </div>
                    <div class="rm-stat-icon" style="background:rgba(22,163,74,.08);color:var(--rm-green);"><i class="fas fa-check-circle"></i></div>
                </div>
                <div class="rm-stat">
                    <div>
                        <div class="rm-stat-label">Inactive Rules</div>
                        <div class="rm-stat-value" style="color:var(--rm-red);">{{ $totalRules - $activeRules }}</div>
                    </div>
                    <div class="rm-stat-icon" style="background:rgba(220,38,38,.08);color:var(--rm-red);"><i class="fas fa-ban"></i></div>
                </div>
                <div class="rm-stat">
                    <div>
                        <div class="rm-stat-label">Categories</div>
                        <div class="rm-stat-value">{{ count($categories) }}</div>
                    </div>
                    <div class="rm-stat-icon" style="background:rgba(217,119,6,.08);color:var(--rm-amber);"><i class="fas fa-tags"></i></div>
                </div>
            </div>

            {{-- Table --}}
            <div class="rm-card">
                <div class="rm-card-header">
                    <div class="rm-card-title"><i class="fas fa-list-alt"></i> All Rules</div>
                    <div class="rm-toolbar">
                        @include('partials.village-bank-selector')
                        <select wire:model.live="categoryFilter" class="rm-select">
                            <option value="">All Categories</option>
                            @foreach ($categories as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        <div class="rm-search">
                            <i class="fas fa-search"></i>
                            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search rules...">
                        </div>
                        <select wire:model.live="perPage" class="rm-select" style="width:70px;">
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>

                <div style="overflow-x:auto;">
                    <table class="rm-table">
                        <thead>
                            <tr>
                                <th style="width:4%;">#</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Village Bank</th>
                                <th>Status</th>
                                <th>Acknowledged</th>
                                <th>Created</th>
                                <th style="width:14%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rules as $rule)
                                @php
                                    $catClass = 'rm-cat-' . $rule->category;
                                    $rate = $rule->acknowledgementRate();
                                @endphp
                                <tr>
                                    <td style="font-weight:700;color:var(--rm-faint);font-size:.78rem;">{{ $rule->sort_order }}</td>
                                    <td>
                                        <div class="rm-rule-title">{{ $rule->title }}</div>
                                        <div class="rm-rule-desc">{{ Str::limit($rule->description, 70) }}</div>
                                    </td>
                                    <td>
                                        <span class="rm-badge {{ $catClass }}">
                                            {{ $categories[$rule->category] ?? ucfirst($rule->category) }}
                                        </span>
                                    </td>
                                    <td style="font-size:.82rem;">{{ $rule->villageBank->name ?? '--' }}</td>
                                    <td>
                                        @if ($rule->is_active)
                                            <span class="rm-badge" style="background:rgba(22,163,74,.06);color:var(--rm-green);border:1px solid rgba(22,163,74,.2);">
                                                <i class="fas fa-circle" style="font-size:.3rem;"></i> Active
                                            </span>
                                        @else
                                            <span class="rm-badge" style="background:rgba(220,38,38,.06);color:var(--rm-red);border:1px solid rgba(220,38,38,.2);">
                                                <i class="fas fa-circle" style="font-size:.3rem;"></i> Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="rm-progress-wrap">
                                            <div class="rm-progress-bar"><div class="rm-progress-fill" style="width:{{ $rate }}%;"></div></div>
                                            <span class="rm-progress-pct">{{ $rule->acknowledgements_count }}</span>
                                        </div>
                                    </td>
                                    <td style="font-size:.78rem;color:var(--rm-faint);">{{ $rule->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="rm-actions">
                                            <a href="{{ route('rules.show', $rule->id) }}" class="rm-act" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button wire:click="openEdit({{ $rule->id }})" class="rm-act rm-act-edit" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <button wire:click="toggleActive({{ $rule->id }})" class="rm-act rm-act-toggle" title="{{ $rule->is_active ? 'Deactivate' : 'Activate' }}">
                                                <i class="fas fa-{{ $rule->is_active ? 'ban' : 'check' }}"></i>
                                            </button>
                                            @if (!$rule->isAcknowledgedBy(Auth::id()))
                                                <button wire:click="acknowledge({{ $rule->id }})" class="rm-act rm-act-ack" title="Acknowledge">
                                                    <i class="fas fa-handshake"></i>
                                                </button>
                                            @else
                                                <span class="rm-act rm-act-acked" title="Acknowledged">
                                                    <i class="fas fa-check-double"></i>
                                                </span>
                                            @endif
                                            <button wire:click="confirmDelete({{ $rule->id }})" class="rm-act rm-act-del" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <div class="rm-empty">
                                            <i class="fas fa-book-open"></i>
                                            <p>No rules found. Click <strong>Create Rule</strong> to add your first one.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($rules->hasPages())
                    <div class="rm-footer">
                        <span class="rm-footer-info">Showing {{ $rules->firstItem() ?? 0 }} - {{ $rules->lastItem() ?? 0 }} of {{ $rules->total() }}</span>
                        {{ $rules->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- ═══════════════ CREATE / EDIT MODAL ═══════════════ --}}
    @if ($showFormModal)
        <div class="rm-modal-overlay" wire:click.self="$set('showFormModal', false)">
            <div class="rm-modal rm-modal-lg">
                <div class="rm-modal-header">
                    <h5><i class="fas fa-{{ $editingId ? 'edit' : 'plus-circle' }}"></i> {{ $editingId ? 'Edit Rule' : 'Create Rule' }}</h5>
                    <button wire:click="$set('showFormModal', false)" class="rm-modal-close">&times;</button>
                </div>
                <form wire:submit.prevent="saveRule">
                    <div class="rm-modal-body">
                        <div class="rm-form-grid">
                            <div class="rm-form-row-3">
                                <div>
                                    <label class="rm-label">Village Bank <span style="color:var(--rm-red);">*</span></label>
                                    <select wire:model.live="formBankId" class="rm-input" style="cursor:pointer;">
                                        <option value="">-- Select --</option>
                                        @foreach ($this->villageBanks as $vb)
                                            <option value="{{ $vb->id }}">{{ $vb->name }} ({{ $vb->code }})</option>
                                        @endforeach
                                    </select>
                                    @error('formBankId') <small style="color:var(--rm-red);font-size:.76rem;">{{ $message }}</small> @enderror
                                </div>
                                <div>
                                    <label class="rm-label">Category</label>
                                    <select wire:model.live="category" class="rm-input" style="cursor:pointer;">
                                        @foreach ($categories as $key => $label)
                                            <option value="{{ $key }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="rm-label">Sort Order</label>
                                    <input type="number" wire:model="sortOrder" class="rm-input" min="0">
                                </div>
                            </div>
                            <div>
                                <label class="rm-label">Rule Title <span style="color:var(--rm-red);">*</span></label>
                                <input type="text" wire:model="title" class="rm-input" placeholder="e.g. Late Payment Penalty">
                                @error('title') <small style="color:var(--rm-red);font-size:.76rem;">{{ $message }}</small> @enderror
                            </div>
                            <div>
                                <label class="rm-label">Description / Full Rule Text <span style="color:var(--rm-red);">*</span></label>
                                <textarea wire:model="description" class="rm-input" rows="5" placeholder="Describe the rule in detail..." style="resize:vertical;"></textarea>
                                @error('description') <small style="color:var(--rm-red);font-size:.76rem;">{{ $message }}</small> @enderror
                            </div>
                            <label class="rm-switch">
                                <input type="checkbox" wire:model="isActive">
                                <div class="rm-switch-track"><div class="rm-switch-knob"></div></div>
                                <span class="rm-switch-label">Active</span>
                            </label>
                        </div>
                    </div>
                    <div class="rm-modal-footer">
                        <button type="button" wire:click="$set('showFormModal', false)" class="rm-btn rm-btn-cancel">Cancel</button>
                        <button type="submit" class="rm-btn rm-btn-primary">
                            <i class="fas fa-save"></i> {{ $editingId ? 'Update Rule' : 'Save Rule' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- ═══════════════ DELETE MODAL ═══════════════ --}}
    @if ($deleteId)
        <div class="rm-modal-overlay" wire:click.self="$set('deleteId', null)">
            <div class="rm-modal rm-modal-sm">
                <div class="rm-modal-header rm-modal-header-danger">
                    <h5><i class="fas fa-exclamation-triangle"></i> Delete Rule</h5>
                    <button wire:click="$set('deleteId', null)" class="rm-modal-close">&times;</button>
                </div>
                <div class="rm-modal-body">
                    <p style="font-size:.88rem;color:var(--rm-text);margin:0;">
                        Are you sure you want to delete <strong>{{ $deleteTitle }}</strong>?<br>
                        <span style="color:var(--rm-faint);font-size:.8rem;">This will also remove all acknowledgements.</span>
                    </p>
                </div>
                <div class="rm-modal-footer">
                    <button wire:click="$set('deleteId', null)" class="rm-btn rm-btn-cancel">Cancel</button>
                    <button wire:click="deleteRule" class="rm-btn rm-btn-danger">
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
