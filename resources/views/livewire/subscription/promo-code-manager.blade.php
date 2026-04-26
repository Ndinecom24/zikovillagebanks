<div>

@push('custom-styles')
<style>
/* ═══ Promo Code Manager — Redesign (pc-*) ═══ */
:root {
    --pc-navy:#1E3A5F; --pc-navy-light:#2B6B96; --pc-amber:#D97706; --pc-amber-light:#F59E0B;
    --pc-text:#1e293b; --pc-muted:#64748b; --pc-faint:#94a3b8; --pc-green:#16a34a; --pc-red:#dc2626;
    --pc-border:#edf0f7; --pc-radius:16px;
}
.pc-stats{display:grid;grid-template-columns:repeat(auto-fill,minmax(170px,1fr));gap:.75rem;margin-bottom:1.25rem;}
.pc-stat{background:#fff;border:1px solid var(--pc-border);border-radius:12px;padding:.75rem 1rem;display:flex;align-items:center;gap:.65rem;transition:box-shadow .2s;}
.pc-stat:hover{box-shadow:0 4px 16px rgba(0,0,0,.05);}
.pc-stat-icon{width:38px;height:38px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:.9rem;flex-shrink:0;}
.pc-stat-label{font-size:.68rem;text-transform:uppercase;letter-spacing:.4px;font-weight:600;color:var(--pc-faint);}
.pc-stat-val{font-size:1.15rem;font-weight:800;}
.pc-alert{display:flex;align-items:center;gap:.5rem;padding:.65rem 1rem;border-radius:10px;font-size:.84rem;font-weight:600;margin-bottom:1rem;}
.pc-alert-success{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;}
.pc-alert-error{background:#fef2f2;color:#991b1b;border:1px solid #fecaca;}
.pc-toolbar{display:flex;align-items:center;gap:.55rem;flex-wrap:wrap;margin-bottom:1rem;}
.pc-search{position:relative;flex:1;min-width:200px;max-width:320px;}
.pc-search i{position:absolute;left:.65rem;top:50%;transform:translateY(-50%);font-size:.72rem;color:var(--pc-faint);}
.pc-search input{width:100%;padding:.5rem .75rem .5rem 2rem;border:2px solid #e2e8f0;border-radius:10px;font-size:.84rem;background:#fff;transition:border-color .2s;}
.pc-search input:focus{outline:none;border-color:var(--pc-amber);}
.pc-filter{padding:.5rem .75rem;border:2px solid #e2e8f0;border-radius:10px;font-size:.82rem;background:#fff;color:var(--pc-text);cursor:pointer;transition:border-color .2s;}
.pc-filter:focus{outline:none;border-color:var(--pc-amber);}
.pc-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(330px,1fr));gap:1rem;}
.pc-card{background:#fff;border:1px solid var(--pc-border);border-radius:var(--pc-radius);position:relative;overflow:hidden;transition:box-shadow .2s,transform .15s;}
.pc-card:hover{box-shadow:0 8px 24px rgba(0,0,0,.06);transform:translateY(-2px);}
.pc-card.inactive{opacity:.55;}
.pc-card-ribbon{position:absolute;top:0;left:0;right:0;height:4px;}
.pc-card-ribbon.pct{background:linear-gradient(90deg,#3b82f6,#818cf8);}
.pc-card-ribbon.fixed{background:linear-gradient(90deg,#10b981,#34d399);}
.pc-card-top{padding:1rem 1.15rem .65rem;display:flex;justify-content:space-between;align-items:flex-start;gap:.5rem;}
.pc-card-code{font-family:'Courier New',monospace;font-size:1rem;font-weight:800;letter-spacing:1px;color:var(--pc-navy);}
.pc-card-desc{font-size:.72rem;color:var(--pc-faint);margin-top:.15rem;line-height:1.3;}
.pc-card-body{padding:0 1.15rem .85rem;}
.pc-card-discount{display:inline-flex;align-items:center;gap:.35rem;padding:.35rem .75rem;border-radius:8px;font-size:.88rem;font-weight:800;margin-bottom:.65rem;}
.pc-card-discount.pct{background:#eff6ff;color:#1e40af;border:1px solid #bfdbfe;}
.pc-card-discount.fixed{background:#ecfdf5;color:#059669;border:1px solid #a7f3d0;}
.pc-card-meta{display:grid;grid-template-columns:1fr 1fr;gap:.35rem .75rem;}
.pc-card-meta-item{font-size:.74rem;color:var(--pc-muted);display:flex;align-items:center;gap:.3rem;}
.pc-card-meta-item i{font-size:.6rem;color:var(--pc-faint);width:14px;text-align:center;}
.pc-card-meta-item strong{color:var(--pc-text);font-weight:700;}
.pc-card-plan{display:inline-flex;align-items:center;gap:.25rem;background:#f5f3ff;color:#6d28d9;border:1px solid #ddd6fe;font-size:.68rem;padding:.1rem .4rem;border-radius:5px;font-weight:600;}
.pc-card-foot{padding:.6rem 1.15rem;border-top:1px solid var(--pc-border);display:flex;justify-content:space-between;align-items:center;background:#fafbfd;}
.pc-card-actions{display:flex;gap:.35rem;}
.pc-card-act{width:30px;height:30px;border-radius:8px;border:1px solid #e2e8f0;background:#fff;display:inline-flex;align-items:center;justify-content:center;font-size:.72rem;cursor:pointer;transition:all .15s;}
.pc-card-act:hover{border-color:#cbd5e1;}
.pc-card-act-edit{color:var(--pc-navy);}.pc-card-act-edit:hover{background:rgba(30,58,95,.08);}
.pc-card-act-delete{color:var(--pc-red);}.pc-card-act-delete:hover{background:#fef2f2;border-color:#fecaca;}
.pc-card-time{font-size:.7rem;color:var(--pc-faint);display:flex;align-items:center;gap:.25rem;}
.pc-card-time i{font-size:.55rem;}
.pc-badge{display:inline-flex;align-items:center;gap:.25rem;padding:.2rem .55rem;border-radius:6px;font-size:.7rem;font-weight:700;cursor:pointer;transition:all .15s;border:1px solid;}
.pc-badge-active{background:#f0fdf4;color:#16a34a;border-color:#bbf7d0;}.pc-badge-active:hover{background:#dcfce7;}
.pc-badge-inactive{background:#f8fafc;color:#94a3b8;border-color:#e2e8f0;}.pc-badge-inactive:hover{background:#f1f5f9;}
.pc-usage-wrap{margin-top:.5rem;}
.pc-usage-text{font-size:.68rem;color:var(--pc-faint);display:flex;justify-content:space-between;margin-bottom:.2rem;}
.pc-usage-bar{height:4px;background:#e2e8f0;border-radius:2px;overflow:hidden;}
.pc-usage-fill{height:100%;border-radius:2px;transition:width .3s;}
.pc-usage-fill.low{background:var(--pc-green);}.pc-usage-fill.mid{background:var(--pc-amber);}.pc-usage-fill.high{background:var(--pc-red);}
.pc-overlay{position:fixed;inset:0;z-index:1050;display:flex;align-items:center;justify-content:center;background:rgba(15,23,42,.45);backdrop-filter:blur(4px);}
.pc-modal{background:#fff;border-radius:var(--pc-radius);width:100%;max-width:560px;max-height:90vh;overflow-y:auto;box-shadow:0 25px 60px rgba(0,0,0,.15);animation:pcSlide .25s ease;}
.pc-modal-sm{max-width:380px;}
.pc-modal-xl{max-width:780px;}
.pc-modal-head{padding:.85rem 1.25rem;border-bottom:1px solid var(--pc-border);display:flex;justify-content:space-between;align-items:center;}
.pc-modal-head h3{font-size:.9rem;font-weight:700;color:var(--pc-text);margin:0;display:flex;align-items:center;gap:.45rem;}
.pc-modal-head h3 i{color:var(--pc-amber);font-size:.85rem;}
.pc-modal-body{padding:1.25rem 1.5rem;}
.pc-modal-foot{padding:.85rem 1.25rem;border-top:1px solid var(--pc-border);display:flex;justify-content:flex-end;gap:.65rem;}
.pc-close{background:none;border:none;font-size:1.2rem;cursor:pointer;color:var(--pc-faint);}.pc-close:hover{color:var(--pc-text);}
@keyframes pcSlide{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
.pc-label{font-size:.72rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--pc-faint);margin-bottom:.3rem;display:block;}
.pc-label .req{color:var(--pc-red);}
.pc-finput{width:100%;padding:.5rem .75rem;border:2px solid #e2e8f0;border-radius:10px;font-size:.88rem;color:var(--pc-text);transition:border-color .2s;background:#fff;}
.pc-finput:focus{border-color:var(--pc-amber);outline:none;}
.pc-finput::placeholder{color:#94a3b8;font-size:.82rem;}
.pc-ferror{font-size:.75rem;color:var(--pc-red);margin-top:.2rem;font-weight:600;}
.pc-row{display:grid;gap:1rem;margin-bottom:1rem;}
.pc-row-2{grid-template-columns:1fr 1fr;}.pc-row-3{grid-template-columns:1fr 1fr 1fr;}
@media(max-width:768px){.pc-row-2,.pc-row-3{grid-template-columns:1fr;}}
.pc-code-wrap{display:flex;align-items:stretch;gap:0;}
.pc-code-input{flex:1;padding:.6rem .85rem;border:2px solid #e2e8f0;border-radius:10px 0 0 10px;font-size:1rem;font-family:'Courier New',monospace;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--pc-navy);background:#f8fafc;transition:border-color .2s,box-shadow .2s;}
.pc-code-input:focus{outline:none;border-color:var(--pc-navy);box-shadow:0 0 0 3px rgba(30,58,95,.1);background:#fff;}
.pc-code-input::placeholder{letter-spacing:0;font-weight:400;color:#94a3b8;font-size:.85rem;}
.pc-gen-btn{display:inline-flex;align-items:center;gap:.4rem;padding:.6rem 1rem;border:2px solid #e2e8f0;border-left:none;border-radius:0 10px 10px 0;background:linear-gradient(135deg,#f1f5f9,#e2e8f0);cursor:pointer;font-size:.78rem;font-weight:700;color:var(--pc-navy);transition:all .2s;white-space:nowrap;}
.pc-gen-btn:hover{background:linear-gradient(135deg,#e2e8f0,#cbd5e1);border-color:#cbd5e1;}
.pc-gen-btn i{font-size:.72rem;}
.pc-section{padding:1rem 1.1rem;border-radius:12px;margin-bottom:1rem;border:1px solid;position:relative;}
.pc-section-blue{background:#f0f7ff;border-color:#bfdbfe;}
.pc-section-amber{background:#fffbeb;border-color:#fde68a;}
.pc-section-violet{background:#f5f3ff;border-color:#ddd6fe;}
.pc-section-slate{background:#f8fafc;border-color:#e2e8f0;}
.pc-section-head{display:flex;align-items:center;gap:.45rem;margin-bottom:.85rem;font-size:.78rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;}
.pc-section-blue .pc-section-head{color:#1e40af;}
.pc-section-amber .pc-section-head{color:#92400e;}
.pc-section-violet .pc-section-head{color:#6d28d9;}
.pc-section-slate .pc-section-head{color:#475569;}
.pc-section-head i{font-size:.68rem;}
.pc-type-grid{display:grid;grid-template-columns:1fr 1fr;gap:.65rem;}
.pc-type-card{display:flex;align-items:center;gap:.65rem;padding:.7rem .85rem;border:2px solid #e2e8f0;border-radius:10px;cursor:pointer;transition:all .2s;background:#fff;position:relative;}
.pc-type-card:hover{border-color:#cbd5e1;background:#f8fafc;}
.pc-type-card.selected{border-color:var(--pc-navy);background:#f0f4ff;box-shadow:0 0 0 3px rgba(30,58,95,.08);}
.pc-type-card.selected .pc-type-check{opacity:1;}
.pc-type-icon{width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.9rem;flex-shrink:0;}
.pc-type-icon-pct{background:#eff6ff;color:#1e40af;}.pc-type-icon-fixed{background:#f0fdf4;color:#166534;}
.pc-type-label{font-size:.82rem;font-weight:700;color:var(--pc-text);}
.pc-type-desc{font-size:.68rem;color:var(--pc-faint);margin-top:.1rem;}
.pc-type-card input[type="radio"]{display:none;}
.pc-type-check{position:absolute;top:.5rem;right:.5rem;width:18px;height:18px;border-radius:50%;background:var(--pc-navy);color:#fff;display:flex;align-items:center;justify-content:center;font-size:.55rem;opacity:0;transition:opacity .2s;}
.pc-date-group{display:grid;grid-template-columns:1fr auto 1fr;gap:.5rem;align-items:end;}
.pc-date-sep{display:flex;align-items:center;justify-content:center;height:38px;font-size:.72rem;color:var(--pc-faint);font-weight:600;}
@media(max-width:540px){.pc-date-group{grid-template-columns:1fr;}.pc-date-sep{display:none;}}
.pc-preview{display:flex;align-items:center;gap:1rem;padding:.75rem 1rem;background:linear-gradient(135deg,#1E3A5F 0%,#2d5a8e 100%);border-radius:10px;color:#fff;margin-bottom:1rem;}
.pc-preview-icon{width:42px;height:42px;border-radius:10px;background:rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;font-size:1.1rem;flex-shrink:0;}
.pc-preview-code{font-family:'Courier New',monospace;font-size:1.05rem;font-weight:700;letter-spacing:1.5px;}
.pc-preview-detail{font-size:.72rem;opacity:.75;margin-top:.15rem;}
.pc-toggle{display:flex;align-items:center;gap:.55rem;cursor:pointer;user-select:none;}
.pc-toggle-track{width:40px;height:22px;border-radius:11px;background:#cbd5e1;position:relative;transition:background .2s;flex-shrink:0;}
.pc-toggle-track.on{background:#10b981;}
.pc-toggle-knob{width:18px;height:18px;border-radius:50%;background:#fff;position:absolute;top:2px;left:2px;transition:transform .2s;box-shadow:0 1px 3px rgba(0,0,0,.15);}
.pc-toggle-track.on .pc-toggle-knob{transform:translateX(18px);}
.pc-toggle-text{font-size:.82rem;font-weight:600;color:var(--pc-text);}
.pc-toggle-text.active{color:#059669;}.pc-toggle-text.inactive{color:#94a3b8;}
.pc-btn{display:inline-flex;align-items:center;gap:.35rem;padding:.5rem 1.2rem;border-radius:10px;font-size:.84rem;font-weight:600;border:none;cursor:pointer;transition:all .2s;}
.pc-btn-primary{background:linear-gradient(135deg,var(--pc-navy),var(--pc-navy-light));color:#fff;}
.pc-btn-primary:hover{transform:translateY(-1px);box-shadow:0 4px 12px rgba(30,58,95,.3);}
.pc-btn-primary:disabled{opacity:.6;cursor:not-allowed;transform:none;box-shadow:none;}
.pc-btn-ghost{background:#f1f5f9;color:var(--pc-muted);}.pc-btn-ghost:hover{background:#e2e8f0;color:var(--pc-text);}
.pc-btn-danger{background:#fef2f2;color:var(--pc-red);border:1px solid #fecaca;}.pc-btn-danger:hover{background:#fee2e2;}
.pc-empty{text-align:center;padding:3rem 1.5rem;color:var(--pc-faint);}
.pc-empty i{font-size:2.5rem;margin-bottom:.65rem;display:block;}
.pc-empty p{margin:.25rem 0 0;font-size:.88rem;}
.pc-pager{display:flex;align-items:center;justify-content:space-between;margin-top:1rem;font-size:.78rem;color:var(--pc-muted);}
@media(max-width:640px){.pc-type-grid{grid-template-columns:1fr;}.pc-grid{grid-template-columns:1fr;}}
</style>
@endpush

@can('manage-subscriptions')
<div class="nd-page">
    <div class="nd-hero">
        <div class="nd-hero-inner">
            <ul class="nd-breadcrumb">
                <li><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="sep">/</li>
                <li><a href="{{ route('subscription.plans') }}">Plans</a></li>
                <li class="sep">/</li>
                <li class="active">Promo Codes</li>
            </ul>
            <div class="nd-hero-row">
                <div class="nd-hero-title">
                    <h1><i class="fas fa-ticket-alt"></i> Promo Codes</h1>
                    <p class="nd-hero-sub">Create and manage promotional codes for village bank subscriptions</p>
                </div>
                <button wire:click="openCreate" class="nd-hero-btn"><i class="fas fa-plus"></i> New Promo Code</button>
            </div>
        </div>
    </div>

    <div class="nd-content">
        @if(session()->has('success'))
            <div class="sp-alert sp-alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if(session()->has('error'))
            <div class="sp-alert sp-alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
        @endif

        <div class="nd-card">
            <div class="nd-card-header">
                <h3><i class="fas fa-list"></i> All Promo Codes</h3>
                <div class="nd-toolbar">
                    <div class="nd-search"><i class="fas fa-search"></i>
                        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search codes...">
                    </div>
                    <select wire:model.live="filterStatus" class="nd-select" style="min-width:95px;">
                        <option value="">All</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    <select wire:model.live="perPage" class="nd-select" style="min-width:75px;">
                        <option value="10">10</option><option value="25">25</option><option value="50">50</option>
                    </select>
                </div>
            </div>
            <div style="">
                <table class="nd-table">
                    <thead>
                        <tr>
                            <th>Code</th><th>Discount</th><th>Plan</th><th>Usage</th><th>Validity</th><th>Status</th><th style="width:100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($promos as $promo)
                            <tr>
                                <td>
                                    <span class="pc-code">{{ $promo->code }}</span>
                                    @if($promo->description)
                                        <div style="font-size:.72rem;color:var(--nd-faint);margin-top:.15rem;">{{ Str::limit($promo->description, 40) }}</div>
                                    @endif
                                </td>
                                <td>
                                    <span class="nd-badge {{ $promo->type === 'percentage' ? 'pc-badge-pct' : 'pc-badge-fixed' }}">
                                        {{ $promo->discountLabel() }}
                                    </span>
                                    @if($promo->min_plan_price > 0)
                                        <div style="font-size:.68rem;color:var(--nd-faint);margin-top:.15rem;">Min: K{{ number_format($promo->min_plan_price, 0) }}</div>
                                    @endif
                                </td>
                                <td>
                                    @if($promo->plan)
                                        <span class="nd-badge pc-badge-plan">{{ $promo->plan->name }}</span>
                                    @else
                                        <span style="font-size:.78rem;color:var(--nd-faint);">All plans</span>
                                    @endif
                                </td>
                                <td class="pc-usage">
                                    <strong>{{ $promo->times_used }}</strong>
                                    / {{ $promo->max_uses ?? '∞' }}
                                    <div style="margin-top:.1rem;">{{ $promo->max_uses_per_bank }}/bank</div>
                                </td>
                                <td class="pc-dates">
                                    @if($promo->starts_at)
                                        <div>From: {{ $promo->starts_at->format('d M Y') }}</div>
                                    @endif
                                    @if($promo->expires_at)
                                        <div>Until: {{ $promo->expires_at->format('d M Y') }}</div>
                                        <div style="color:var(--nd-navy);font-weight:600;">{{ $promo->timeRemaining() }}</div>
                                    @else
                                        <div>No expiry</div>
                                    @endif
                                </td>
                                <td>
                                    <button wire:click="toggleActive({{ $promo->id }})" class="nd-badge {{ $promo->is_active ? 'nd-badge-green' : 'nd-badge-red' }}" style="cursor:pointer;border:1px solid {{ $promo->is_active ? '#bbf7d0' : '#e5e7eb' }};">
                                        {{ $promo->is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                </td>
                                <td>
                                    <div class="sp-actions">
                                        <button wire:click="openEdit({{ $promo->id }})" class="sp-act sp-act-edit" title="Edit"><i class="fas fa-edit"></i></button>
                                        <button wire:click="confirmDelete({{ $promo->id }})" class="sp-act sp-act-delete" title="Delete"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7"><div class="nd-empty"><i class="fas fa-ticket-alt"></i><p>No promo codes found</p></div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($promos->hasPages())
                <div class="nd-footer">
                    <span>Showing {{ $promos->firstItem() ?? 0 }} – {{ $promos->lastItem() ?? 0 }} of {{ $promos->total() }}</span>
                    {{ $promos->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- Create / Edit Modal --}}
    @if($showModal)
        <div class="pc-overlay" wire:click.self="$set('showModal', false)">
            <div class="pc-modal pc-modal-xl">
                <div class="pc-modal-head">
                    <h3><i class="fas fa-{{ $editId ? 'edit' : 'plus-circle' }}"></i> {{ $editId ? 'Edit Promo Code' : 'Create Promo Code' }}</h3>
                    <button class="pc-close" wire:click="$set('showModal', false)">&times;</button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="pc-modal-body">

                        {{-- Live Preview Banner --}}
                        <div class="pc-preview">
                            <div class="pc-preview-icon"><i class="fas fa-ticket-alt"></i></div>
                            <div>
                                <div class="pc-preview-code">{{ $code ?: 'PROMO-CODE' }}</div>
                                <div class="pc-preview-detail">
                                    @if($value)
                                        {{ $type === 'percentage' ? $value . '% off' : 'K' . number_format((float)$value, 2) . ' off' }}
                                    @else
                                        Set discount details below
                                    @endif
                                    @if($planId && isset($plans))
                                        &middot; {{ optional($plans->firstWhere('id', $planId))->name ?? 'Specific plan' }}
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- ── Section 1: Code & Description ── --}}
                        <div class="pc-section pc-section-slate">
                            <div class="pc-section-head"><i class="fas fa-fingerprint"></i> Code Identity</div>
                            <div>
                                <label class="sp-label">Promo Code <span class="req">*</span></label>
                                <div class="pc-code-wrap">
                                    <input type="text" wire:model.live="code" class="pc-code-input" placeholder="e.g. WELCOME2026">
                                    <button type="button" wire:click="generateCode" class="pc-gen-btn" title="Generate random code">
                                        <i class="fas fa-dice"></i> Generate
                                    </button>
                                </div>
                                @error('code')<div class="sp-error">{{ $message }}</div>@enderror
                            </div>
                            <div style="margin-top:.75rem;">
                                <label class="sp-label">Description</label>
                                <input type="text" wire:model="description" class="sp-input" placeholder="e.g. Independence Day special – 20% off yearly plans">
                            </div>
                        </div>

                        {{-- ── Section 2: Discount Type ── --}}
                        <div class="pc-section pc-section-blue">
                            <div class="pc-section-head"><i class="fas fa-percent"></i> Discount</div>
                            <div class="pc-type-grid" style="margin-bottom:.85rem;">
                                <label class="pc-type-card {{ $type === 'percentage' ? 'selected' : '' }}">
                                    <input type="radio" wire:model.live="type" value="percentage">
                                    <div class="pc-type-icon pc-type-icon-pct"><i class="fas fa-percent"></i></div>
                                    <div>
                                        <div class="pc-type-label">Percentage</div>
                                        <div class="pc-type-desc">Discount by % of plan price</div>
                                    </div>
                                </label>
                                <label class="pc-type-card {{ $type === 'fixed' ? 'selected' : '' }}">
                                    <input type="radio" wire:model.live="type" value="fixed">
                                    <div class="pc-type-icon pc-type-icon-fixed"><i class="fas fa-coins"></i></div>
                                    <div>
                                        <div class="pc-type-label">Fixed Amount</div>
                                        <div class="pc-type-desc">Flat Kwacha amount off</div>
                                    </div>
                                </label>
                            </div>
                            <div class="sp-grid sp-grid-2">
                                <div>
                                    <label class="sp-label">Discount Value {{ $type === 'percentage' ? '(%)' : '(K)' }} <span class="req">*</span></label>
                                    <input type="number" wire:model.live="value" class="sp-input" step="0.01" min="0.01" {{ $type === 'percentage' ? 'max=100' : '' }}
                                           placeholder="{{ $type === 'percentage' ? 'e.g. 25' : 'e.g. 500' }}">
                                    @error('value')<div class="sp-error">{{ $message }}</div>@enderror
                                </div>
                                <div>
                                    <label class="sp-label">Min Plan Price (K)</label>
                                    <input type="number" wire:model="minPlanPrice" class="sp-input" step="0.01" min="0" placeholder="0 = no minimum">
                                </div>
                            </div>
                        </div>

                        {{-- ── Section 3: Plan & Usage Limits ── --}}
                        <div class="pc-section pc-section-violet">
                            <div class="pc-section-head"><i class="fas fa-sliders-h"></i> Scope & Limits</div>
                            <div class="sp-grid sp-grid-3">
                                <div>
                                    <label class="sp-label">Restrict to Plan</label>
                                    <select wire:model="planId" class="sp-input">
                                        <option value="">All Plans</option>
                                        @foreach($plans as $plan)
                                            <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="sp-label">Max Total Uses</label>
                                    <input type="number" wire:model="maxUses" class="sp-input" min="1" placeholder="∞ unlimited">
                                </div>
                                <div>
                                    <label class="sp-label">Max Uses / Bank <span class="req">*</span></label>
                                    <input type="number" wire:model="maxUsesPerBank" class="sp-input" min="1">
                                    @error('maxUsesPerBank')<div class="sp-error">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        {{-- ── Section 4: Validity Period ── --}}
                        <div class="pc-section pc-section-amber">
                            <div class="pc-section-head"><i class="fas fa-calendar-alt"></i> Validity Period</div>
                            <div class="pc-date-group">
                                <div>
                                    <label class="sp-label"><i class="fas fa-play" style="font-size:.55rem;margin-right:.25rem;color:#10b981;"></i> Starts At</label>
                                    <input type="datetime-local" wire:model="startsAt" class="sp-input">
                                    @error('startsAt')<div class="sp-error">{{ $message }}</div>@enderror
                                </div>
                                <div class="pc-date-sep"><i class="fas fa-arrow-right"></i></div>
                                <div>
                                    <label class="sp-label"><i class="fas fa-stop" style="font-size:.55rem;margin-right:.25rem;color:#ef4444;"></i> Expires At</label>
                                    <input type="datetime-local" wire:model="expiresAt" class="sp-input">
                                    @error('expiresAt')<div class="sp-error">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div style="font-size:.7rem;color:#92400e;margin-top:.5rem;"><i class="fas fa-info-circle" style="margin-right:.2rem;"></i> Leave empty for no start/end restriction.</div>
                        </div>

                        {{-- ── Status Toggle ── --}}
                        <label class="pc-toggle" wire:click.prevent="$set('isActive', !{{ $isActive ? 'true' : 'false' }})">
                            <div class="pc-toggle-track {{ $isActive ? 'on' : '' }}">
                                <div class="pc-toggle-knob"></div>
                            </div>
                            <span class="pc-toggle-text {{ $isActive ? 'active' : 'inactive' }}">
                                {{ $isActive ? 'Active – code can be redeemed' : 'Inactive – code is disabled' }}
                            </span>
                        </label>
                    </div>
                    <div class="pc-modal-foot">
                        <button type="button" wire:click="$set('showModal', false)" class="pc-btn pc-btn-ghost">Cancel</button>
                        <button type="submit" class="pc-btn pc-btn-primary" wire:loading.attr="disabled" wire:target="save">
                            <span wire:loading.remove wire:target="save"><i class="fas fa-save" style="margin-right:.3rem;"></i> {{ $editId ? 'Update' : 'Create' }} Promo Code</span>
                            <span wire:loading wire:target="save"><i class="fas fa-spinner fa-spin" style="margin-right:.3rem;"></i> Saving...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- Delete Modal --}}
    @if($confirmDeleteId)
        <div class="nd-overlay" wire:click.self="$set('confirmDeleteId', null)">
            <div class="nd-modal sp-modal-sm">
                <div class="nd-modal-head">
                    <h5><i class="fas fa-exclamation-triangle"></i> Delete Promo Code</h5>
                    <button class="nd-modal-close" wire:click="$set('confirmDeleteId', null)">&times;</button>
                </div>
                <div class="nd-modal-body" style="text-align:center;">
                    <div style="width:56px;height:56px;border-radius:50%;background:#fef2f2;display:flex;align-items:center;justify-content:center;margin:0 auto .85rem;">
                        <i class="fas fa-trash" style="font-size:1.2rem;color:var(--nd-red);"></i>
                    </div>
                    <p style="font-weight:600;font-size:.95rem;color:var(--nd-text);margin:0 0 .35rem;">Delete this promo code?</p>
                    <p style="font-size:.82rem;color:var(--nd-muted);margin:0;">Promo codes that have been used cannot be deleted.</p>
                </div>
                <div class="nd-modal-foot">
                    <button wire:click="$set('confirmDeleteId', null)" class="nd-btn-cancel">Cancel</button>
                    <button wire:click="delete" class="nd-btn-danger"><i class="fas fa-trash" style="margin-right:.3rem;"></i> Delete</button>
                </div>
            </div>
        </div>
    @endif
</div>
@else
    @include('livewire.partials.unauthorized')
@endcan
</div>
