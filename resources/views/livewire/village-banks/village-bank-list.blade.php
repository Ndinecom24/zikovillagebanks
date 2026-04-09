<div>
@push('custom-styles')
<style>
    :root {
        --vl-navy:#1E3A5F;--vl-navy-light:#2B6B96;--vl-amber:#D97706;--vl-amber-light:#F59E0B;
        --vl-bg:#f4f6fa;--vl-card:#fff;--vl-border:#edf0f7;--vl-text:#1e293b;
        --vl-muted:#64748b;--vl-faint:#94a3b8;--vl-green:#16a34a;--vl-red:#dc2626;--vl-blue:#2563eb;--vl-purple:#7c3aed;--vl-cyan:#0891b2;--vl-radius:16px;
    }
    .vl-page{background:var(--vl-bg);min-height:100vh;}

    /* ─── Hero ─── */
    .vl-hero{background:linear-gradient(135deg,var(--vl-navy) 0%,#234b78 50%,var(--vl-navy-light) 100%);padding:1.75rem 0 7rem;position:relative;overflow:hidden;}
    .vl-hero::before{content:'';position:absolute;width:700px;height:700px;top:-60%;right:-10%;background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%);border-radius:50%;pointer-events:none;}
    .vl-hero::after{content:'';position:absolute;width:400px;height:400px;bottom:-40%;left:-5%;background:radial-gradient(circle,rgba(43,107,150,.15) 0%,transparent 70%);border-radius:50%;pointer-events:none;}
    .vl-hero-inner{position:relative;z-index:2;padding:0 1.5rem;}
    .vl-breadcrumb{display:flex;gap:.5rem;list-style:none;padding:0;margin:0 0 .75rem;font-size:.82rem;}
    .vl-breadcrumb a{color:rgba(255,255,255,.55);text-decoration:none;}
    .vl-breadcrumb a:hover{color:rgba(255,255,255,.85);}
    .vl-breadcrumb .active{color:var(--vl-amber-light);font-weight:600;}
    .vl-breadcrumb .sep{color:rgba(255,255,255,.25);}
    .vl-hero-row{display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:.75rem;}
    .vl-hero-title h1{color:#fff;font-size:1.6rem;font-weight:800;margin:0;}
    .vl-hero-title h1 i{color:var(--vl-amber);margin-right:.5rem;}
    .vl-hero-sub{color:rgba(255,255,255,.55);font-size:.88rem;margin:.25rem 0 0;}
    .vl-hero-btn{padding:.55rem 1.25rem;border-radius:10px;font-size:.84rem;font-weight:700;border:none;cursor:pointer;display:inline-flex;align-items:center;gap:.4rem;transition:all .2s;background:var(--vl-amber);color:#fff;text-decoration:none;}
    .vl-hero-btn:hover{background:var(--vl-amber-light);color:#fff;text-decoration:none;transform:translateY(-1px);}

    /* ─── Content ─── */
    .vl-content{margin-top:-4.5rem;position:relative;z-index:10;padding:0 1.5rem 2rem;}

    /* ─── Stat strip ─── */
    .vl-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:.85rem;margin-bottom:1.5rem;}
    @media(max-width:992px){.vl-stats{grid-template-columns:repeat(2,1fr);}}
    @media(max-width:576px){.vl-stats{grid-template-columns:1fr;}}
    .vl-stat{background:var(--vl-card);border-radius:14px;border:1px solid var(--vl-border);box-shadow:0 2px 12px rgba(0,0,0,.04);padding:1rem 1.15rem;display:flex;align-items:center;gap:1rem;transition:all .2s;}
    .vl-stat:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(0,0,0,.06);}
    .vl-stat-icon{width:46px;height:46px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;flex-shrink:0;}
    .vl-stat-label{font-size:.62rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--vl-faint);}
    .vl-stat-val{font-size:1.4rem;font-weight:800;margin-top:.05rem;}

    /* ─── Card ─── */
    .vl-card{background:var(--vl-card);border-radius:var(--vl-radius);border:1px solid var(--vl-border);box-shadow:0 2px 12px rgba(0,0,0,.04);overflow:hidden;}
    .vl-card-header{padding:1rem 1.25rem;border-bottom:1px solid var(--vl-border);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;}
    .vl-card-header h3{font-size:1rem;font-weight:800;color:var(--vl-text);margin:0;display:flex;align-items:center;gap:.5rem;}
    .vl-card-header h3 i{color:var(--vl-amber);font-size:.9rem;}

    /* ─── Toolbar ─── */
    .vl-toolbar{display:flex;align-items:center;gap:.65rem;flex-wrap:wrap;}
    .vl-select{padding:.42rem .75rem;border-radius:10px;border:1px solid var(--vl-border);font-size:.82rem;color:var(--vl-text);background:var(--vl-card);cursor:pointer;min-width:130px;}
    .vl-select:focus{outline:none;border-color:var(--vl-amber);box-shadow:0 0 0 3px rgba(217,119,6,.1);}
    .vl-search{position:relative;min-width:220px;}
    .vl-search input{width:100%;padding:.42rem .75rem .42rem 2.1rem;border:1px solid var(--vl-border);border-radius:10px;font-size:.82rem;background:var(--vl-card);color:var(--vl-text);}
    .vl-search input:focus{outline:none;border-color:var(--vl-amber);box-shadow:0 0 0 3px rgba(217,119,6,.1);}
    .vl-search i{position:absolute;left:.75rem;top:50%;transform:translateY(-50%);color:var(--vl-faint);font-size:.78rem;}

    /* ─── Table ─── */
    .vl-table{width:100%;border-collapse:separate;border-spacing:0;font-size:.86rem;}
    .vl-table thead th{background:#f8fafc;padding:.65rem 1rem;font-size:.68rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--vl-faint);border-bottom:1px solid var(--vl-border);white-space:nowrap;}
    .vl-table tbody td{padding:.7rem 1rem;border-bottom:1px solid var(--vl-border);vertical-align:middle;color:var(--vl-text);}
    .vl-table tbody tr:last-child td{border-bottom:none;}
    .vl-table tbody tr{transition:background .15s;}
    .vl-table tbody tr:hover{background:#fafbfd;}
    .vl-avatar{width:38px;height:38px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.78rem;flex-shrink:0;}
    .vl-bank-name{font-weight:700;font-size:.88rem;color:var(--vl-text);}
    .vl-bank-desc{font-size:.76rem;color:var(--vl-muted);max-width:220px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-top:.1rem;}
    .vl-code{background:#f1f5f9;color:var(--vl-navy);padding:.15rem .5rem;border-radius:6px;font-size:.78rem;font-weight:700;font-family:monospace;}
    .vl-count{padding:.2rem .55rem;border-radius:8px;font-size:.76rem;font-weight:700;display:inline-flex;align-items:center;gap:.3rem;}
    .vl-date{font-size:.78rem;color:var(--vl-muted);}

    /* ─── Badge ─── */
    .vl-badge{padding:.2rem .55rem;border-radius:8px;font-size:.68rem;font-weight:700;text-transform:uppercase;letter-spacing:.3px;}
    .vl-badge-active{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;}
    .vl-badge-inactive{background:#fef2f2;color:#991b1b;border:1px solid #fecaca;}

    /* ─── Actions ─── */
    .vl-actions{display:flex;gap:.35rem;}
    .vl-act{width:32px;height:32px;border-radius:8px;border:1px solid var(--vl-border);background:var(--vl-card);display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .2s;color:var(--vl-muted);font-size:.72rem;}
    .vl-act:hover{border-color:var(--vl-amber);color:var(--vl-amber);background:#fffbeb;}
    .vl-act-view{color:var(--vl-navy);}
    .vl-act-view:hover{background:#eff6ff;border-color:var(--vl-navy);color:var(--vl-navy);}
    .vl-act-edit{color:var(--vl-blue);}
    .vl-act-edit:hover{background:#eff6ff;border-color:var(--vl-blue);color:var(--vl-blue);}
    .vl-act-toggle{color:var(--vl-amber);}
    .vl-act-toggle:hover{background:#fffbeb;border-color:var(--vl-amber);color:var(--vl-amber);}
    .vl-act-delete{color:var(--vl-red);}
    .vl-act-delete:hover{background:#fef2f2;border-color:var(--vl-red);color:var(--vl-red);}

    /* ─── Footer ─── */
    .vl-footer{padding:.75rem 1.25rem;border-top:1px solid var(--vl-border);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.5rem;font-size:.82rem;color:var(--vl-muted);}

    /* ─── Empty ─── */
    .vl-empty{padding:3rem 1rem;text-align:center;color:var(--vl-faint);}
    .vl-empty i{font-size:2.2rem;margin-bottom:.6rem;display:block;color:var(--vl-border);}
    .vl-empty p{margin:0;font-size:.88rem;}

    /* ─── Alert ─── */
    .vl-alert{padding:.65rem 1rem;border-radius:12px;font-size:.85rem;display:flex;align-items:center;gap:.5rem;margin-bottom:1rem;}
    .vl-alert-success{background:#f0fdf4;border:1px solid #bbf7d0;color:#166534;}

    /* ─── Modal ─── */
    .vl-overlay{position:fixed;inset:0;background:rgba(15,23,42,.45);backdrop-filter:blur(4px);z-index:1050;display:flex;align-items:center;justify-content:center;padding:1rem;}
    .vl-modal{background:var(--vl-card);border-radius:var(--vl-radius);box-shadow:0 25px 50px rgba(0,0,0,.15);width:100%;max-width:440px;overflow:hidden;animation:vlSlide .2s ease-out;}
    @keyframes vlSlide{from{opacity:0;transform:translateY(20px);}to{opacity:1;transform:translateY(0);}}
    .vl-modal-head{background:linear-gradient(135deg,var(--vl-navy),var(--vl-navy-light));padding:1rem 1.25rem;display:flex;align-items:center;justify-content:space-between;}
    .vl-modal-head h5{color:#fff;font-size:.95rem;font-weight:700;margin:0;display:flex;align-items:center;gap:.4rem;}
    .vl-modal-head h5 i{color:var(--vl-amber);}
    .vl-modal-close{background:none;border:none;color:rgba(255,255,255,.6);font-size:1.2rem;cursor:pointer;padding:0;line-height:1;}
    .vl-modal-close:hover{color:#fff;}
    .vl-modal-body{padding:1.5rem 1.25rem;}
    .vl-modal-foot{padding:.85rem 1.25rem;border-top:1px solid var(--vl-border);display:flex;justify-content:flex-end;gap:.5rem;}
    .vl-btn-cancel{padding:.45rem 1rem;border-radius:10px;border:1px solid var(--vl-border);background:var(--vl-card);font-size:.82rem;font-weight:600;cursor:pointer;color:var(--vl-muted);transition:all .2s;}
    .vl-btn-cancel:hover{background:#f8fafc;border-color:var(--vl-muted);}
    .vl-btn-danger{padding:.45rem 1rem;border-radius:10px;border:none;background:var(--vl-red);color:#fff;font-size:.82rem;font-weight:700;cursor:pointer;transition:all .2s;}
    .vl-btn-danger:hover{background:#b91c1c;}
</style>
@endpush

@can('view-village-banks')
<div class="vl-page">
    {{-- ═══ Hero ═══ --}}
    <div class="vl-hero">
        <div class="vl-hero-inner">
            <ul class="vl-breadcrumb">
                <li><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="sep">/</li>
                <li class="active">Village Banks</li>
            </ul>
            <div class="vl-hero-row">
                <div class="vl-hero-title">
                    <h1><i class="fas fa-university"></i>Village Banks</h1>
                    <p class="vl-hero-sub">Manage all village banking organisations</p>
                </div>
                <a href="{{ route('village-banks.create') }}" class="vl-hero-btn">
                    <i class="fas fa-plus"></i> New Village Bank
                </a>
            </div>
        </div>
    </div>

    {{-- ═══ Content ═══ --}}
    <div class="vl-content">

        @if (session()->has('message'))
            <div class="vl-alert vl-alert-success">
                <i class="fas fa-check-circle"></i> {{ session('message') }}
            </div>
        @endif

        {{-- Stat Cards --}}
        <div class="vl-stats">
            <div class="vl-stat">
                <div class="vl-stat-icon" style="background:rgba(30,58,95,.08);color:var(--vl-navy);">
                    <i class="fas fa-university"></i>
                </div>
                <div>
                    <div class="vl-stat-label">Total Banks</div>
                    <div class="vl-stat-val" style="color:var(--vl-navy);">{{ $totalBanks }}</div>
                </div>
            </div>
            <div class="vl-stat">
                <div class="vl-stat-icon" style="background:rgba(22,163,74,.08);color:var(--vl-green);">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <div class="vl-stat-label">Active</div>
                    <div class="vl-stat-val" style="color:var(--vl-green);">{{ $activeBanks }}</div>
                </div>
            </div>
            <div class="vl-stat">
                <div class="vl-stat-icon" style="background:rgba(124,58,237,.08);color:var(--vl-purple);">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <div class="vl-stat-label">Total Members</div>
                    <div class="vl-stat-val" style="color:var(--vl-purple);">{{ $totalBankMembers }}</div>
                </div>
            </div>
            <div class="vl-stat">
                <div class="vl-stat-icon" style="background:rgba(217,119,6,.08);color:var(--vl-amber);">
                    <i class="fas fa-circle-notch"></i>
                </div>
                <div>
                    <div class="vl-stat-label">Total Circles</div>
                    <div class="vl-stat-val" style="color:var(--vl-amber);">{{ $totalBankCircles }}</div>
                </div>
            </div>
        </div>

        {{-- Table Card --}}
        <div class="vl-card">
            <div class="vl-card-header">
                <h3><i class="fas fa-list"></i> All Village Banks</h3>
                <div class="vl-toolbar">
                    <select wire:model="statusFilter" class="vl-select">
                        <option value="">All Statuses</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    <div class="vl-search">
                        <i class="fas fa-search"></i>
                        <input type="text" wire:model.debounce.300ms="search" placeholder="Search banks...">
                    </div>
                    <select wire:model="perPage" class="vl-select" style="min-width:75px;">
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                    </select>
                </div>
            </div>
            <div style="overflow-x:auto;">
                <table class="vl-table">
                    <thead>
                        <tr>
                            <th>Bank</th>
                            <th>Code</th>
                            <th>Members</th>
                            <th>Circles</th>
                            <th>Contact</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th style="width:160px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($banks as $bank)
                            <tr>
                                <td>
                                    <div style="display:flex;align-items:center;gap:.6rem;">
                                        @if ($bank->logo)
                                            <img src="{{ asset('storage/' . $bank->logo) }}" alt=""
                                                 style="width:38px;height:38px;border-radius:10px;object-fit:cover;">
                                        @else
                                            <div class="vl-avatar" style="background:linear-gradient(135deg,var(--vl-navy),var(--vl-navy-light));color:#fff;">
                                                {{ strtoupper(substr($bank->name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <div class="vl-bank-name">{{ $bank->name }}</div>
                                            @if ($bank->description)
                                                <div class="vl-bank-desc">{{ $bank->description }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td><span class="vl-code">{{ $bank->code }}</span></td>
                                <td>
                                    <span class="vl-count" style="background:rgba(124,58,237,.08);color:var(--vl-purple);">
                                        <i class="fas fa-users" style="font-size:.6rem;"></i> {{ $bank->members_count }}
                                    </span>
                                </td>
                                <td>
                                    <span class="vl-count" style="background:rgba(217,119,6,.08);color:var(--vl-amber);">
                                        <i class="fas fa-circle-notch" style="font-size:.6rem;"></i> {{ $bank->circles_count }}
                                    </span>
                                </td>
                                <td>
                                    @if ($bank->email || $bank->phone)
                                        @if ($bank->email)
                                            <div style="font-size:.78rem;color:var(--vl-muted);"><i class="fas fa-envelope" style="font-size:.6rem;margin-right:.25rem;color:var(--vl-faint);"></i>{{ $bank->email }}</div>
                                        @endif
                                        @if ($bank->phone)
                                            <div style="font-size:.78rem;color:var(--vl-muted);margin-top:.1rem;"><i class="fas fa-phone" style="font-size:.6rem;margin-right:.25rem;color:var(--vl-faint);"></i>{{ $bank->phone }}</div>
                                        @endif
                                    @else
                                        <span style="color:var(--vl-faint);">&mdash;</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="vl-badge {{ $bank->status === 'active' ? 'vl-badge-active' : 'vl-badge-inactive' }}">
                                        {{ ucfirst($bank->status) }}
                                    </span>
                                </td>
                                <td class="vl-date">{{ $bank->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="vl-actions">
                                        <a href="{{ route('village-banks.show', $bank->id) }}" class="vl-act vl-act-view" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('village-banks.create', ['edit' => $bank->id]) }}" class="vl-act vl-act-edit" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button wire:click="toggleStatus({{ $bank->id }})" class="vl-act vl-act-toggle" title="Toggle Status">
                                            <i class="fas fa-power-off"></i>
                                        </button>
                                        <button wire:click="confirmDelete({{ $bank->id }})" class="vl-act vl-act-delete" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="vl-empty">
                                        <i class="fas fa-university"></i>
                                        <p>No village banks found</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($banks->hasPages())
                <div class="vl-footer">
                    <span>Showing {{ $banks->firstItem() ?? 0 }} – {{ $banks->lastItem() ?? 0 }} of {{ $banks->total() }}</span>
                    {{ $banks->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- ═══ Delete Modal ═══ --}}
    @if ($deleteId)
        <div class="vl-overlay" wire:click.self="$set('deleteId', null)">
            <div class="vl-modal">
                <div class="vl-modal-head">
                    <h5><i class="fas fa-exclamation-triangle"></i> Delete Village Bank</h5>
                    <button class="vl-modal-close" wire:click="$set('deleteId', null)">&times;</button>
                </div>
                <div class="vl-modal-body" style="text-align:center;">
                    <div style="width:56px;height:56px;border-radius:50%;background:#fef2f2;display:flex;align-items:center;justify-content:center;margin:0 auto .85rem;">
                        <i class="fas fa-trash" style="font-size:1.2rem;color:var(--vl-red);"></i>
                    </div>
                    <p style="margin:0 0 .35rem;font-weight:600;font-size:.95rem;color:var(--vl-text);">Delete "{{ $deleteName }}"?</p>
                    <p style="font-size:.82rem;color:var(--vl-red);margin:0;">This will permanently delete all circles, loans, and data within this bank.</p>
                </div>
                <div class="vl-modal-foot">
                    <button wire:click="$set('deleteId', null)" class="vl-btn-cancel">Cancel</button>
                    <button wire:click="deleteBank" class="vl-btn-danger"><i class="fas fa-trash" style="margin-right:.3rem;"></i> Delete Bank</button>
                </div>
            </div>
        </div>
    @endif
</div>
@else
    @include('livewire.partials.unauthorized')
@endcan
</div>
