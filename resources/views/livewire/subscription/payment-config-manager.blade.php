<div>

@push('custom-styles')
<style>
/* ═══ Payment Config Manager (pc-*) ═══ */
:root {
    --pc-navy:#1E3A5F; --pc-navy-light:#2B6B96; --pc-amber:#D97706; --pc-amber-light:#F59E0B;
    --pc-text:#1e293b; --pc-muted:#64748b; --pc-faint:#94a3b8; --pc-green:#16a34a; --pc-red:#dc2626;
    --pc-border:#edf0f7; --pc-radius:16px;
}

/* ── Table styles ── */
.pc-alert{display:flex;align-items:center;gap:.5rem;padding:.65rem 1rem;border-radius:10px;font-size:.84rem;font-weight:600;margin-bottom:1rem;}
.pc-alert-success{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;}
.pc-code{font-family:monospace;font-size:.82rem;color:var(--pc-navy);background:#f1f5f9;padding:.15rem .4rem;border-radius:4px;}
.pc-actions{display:flex;align-items:center;gap:.35rem;}
.pc-act{width:28px;height:28px;border-radius:6px;border:1px solid #e5e7eb;background:#fff;display:inline-flex;align-items:center;justify-content:center;font-size:.72rem;cursor:pointer;transition:all .15s;}
.pc-act:hover{border-color:#cbd5e1;}
.pc-act-edit{color:var(--pc-navy);}
.pc-act-edit:hover{background:rgba(30,58,95,.08);}
.pc-act-delete{color:var(--pc-red);}
.pc-act-delete:hover{background:#fef2f2;border-color:#fecaca;}
.pc-info-box{display:flex;gap:.5rem;padding:.65rem .85rem;background:#eff6ff;border:1px solid #bfdbfe;border-radius:8px;font-size:.82rem;color:#1e40af;margin-top:1rem;}

/* ── Modal Overlay ── */
.pc-overlay{position:fixed;inset:0;z-index:1050;display:flex;align-items:center;justify-content:center;background:rgba(15,23,42,.45);backdrop-filter:blur(4px);}
.pc-modal{background:#fff;border-radius:var(--pc-radius);width:100%;max-width:560px;max-height:90vh;overflow-y:auto;box-shadow:0 25px 60px rgba(0,0,0,.15);animation:pcSlide .25s ease;}
.pc-modal-sm{max-width:380px;}
.pc-modal-head{padding:.85rem 1.25rem;border-bottom:1px solid var(--pc-border);display:flex;justify-content:space-between;align-items:center;}
.pc-modal-head h3{font-size:.9rem;font-weight:700;color:var(--pc-text);margin:0;display:flex;align-items:center;gap:.45rem;}
.pc-modal-head h3 i{color:var(--pc-amber);font-size:.85rem;}
.pc-modal-body{padding:1.25rem 1.5rem;}
.pc-modal-foot{padding:.85rem 1.25rem;border-top:1px solid var(--pc-border);display:flex;justify-content:flex-end;gap:.65rem;}
.pc-close{background:none;border:none;font-size:1.2rem;cursor:pointer;color:var(--pc-faint);}
.pc-close:hover{color:var(--pc-text);}
@keyframes pcSlide{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}

/* ── Form elements ── */
.pc-label{font-size:.72rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--pc-faint);margin-bottom:.3rem;display:block;}
.pc-label .req{color:var(--pc-red);}
.pc-input{width:100%;padding:.5rem .75rem;border:2px solid #e2e8f0;border-radius:10px;font-size:.88rem;color:var(--pc-text);transition:border-color .2s;background:#fff;}
.pc-input:focus{border-color:var(--pc-amber);outline:none;}
.pc-input::placeholder{color:#94a3b8;font-size:.82rem;}
.pc-error{font-size:.75rem;color:var(--pc-red);margin-top:.2rem;font-weight:600;}
.pc-row{display:grid;gap:1rem;margin-bottom:1rem;}
.pc-row-2{grid-template-columns:1fr 1fr;}
.pc-row-3{grid-template-columns:1fr 1fr 1fr;}
@media(max-width:768px){.pc-row-2,.pc-row-3{grid-template-columns:1fr;}}

/* ── Type selector cards ── */
.pc-type-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:.65rem;margin-bottom:1.15rem;}
.pc-type-card{display:flex;flex-direction:column;align-items:center;gap:.35rem;padding:.85rem .5rem;border:2px solid #e2e8f0;border-radius:12px;cursor:pointer;transition:all .2s;background:#fff;text-align:center;position:relative;}
.pc-type-card:hover{border-color:#cbd5e1;background:#f8fafc;}
.pc-type-card.active{border-color:var(--pc-navy);background:#f0f4ff;box-shadow:0 0 0 3px rgba(30,58,95,.08);}
.pc-type-card.active .pc-type-check{opacity:1;}
.pc-type-icon{width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1rem;}
.pc-type-icon.mobile{background:#ecfdf5;color:#059669;}
.pc-type-icon.bank{background:#eff6ff;color:#2563eb;}
.pc-type-icon.other{background:#fef3c7;color:#b45309;}
.pc-type-name{font-size:.78rem;font-weight:700;color:var(--pc-text);}
.pc-type-hint{font-size:.62rem;color:var(--pc-faint);line-height:1.25;}
.pc-type-check{position:absolute;top:.5rem;right:.5rem;width:18px;height:18px;border-radius:50%;background:var(--pc-navy);color:#fff;display:flex;align-items:center;justify-content:center;font-size:.55rem;opacity:0;transition:opacity .2s;}
@media(max-width:540px){.pc-type-grid{grid-template-columns:1fr;}}

/* ── Section blocks ── */
.pc-section{padding:.85rem 1rem;border-radius:12px;margin-bottom:1rem;border:1px solid;}
.pc-section-green{background:#f0fdf4;border-color:#bbf7d0;}
.pc-section-blue{background:#f0f7ff;border-color:#bfdbfe;}
.pc-section-amber{background:#fffbeb;border-color:#fde68a;}
.pc-section-head{display:flex;align-items:center;gap:.4rem;margin-bottom:.75rem;font-size:.74rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;}
.pc-section-green .pc-section-head{color:#166534;}
.pc-section-blue .pc-section-head{color:#1e40af;}
.pc-section-amber .pc-section-head{color:#92400e;}
.pc-section-head i{font-size:.65rem;}

/* ── Toggle ── */
.pc-toggles{display:flex;gap:1.5rem;margin-top:.25rem;flex-wrap:wrap;}
.pc-toggle-item{display:flex;align-items:center;gap:.5rem;cursor:pointer;user-select:none;}
.pc-toggle-track{width:40px;height:22px;border-radius:11px;background:#e2e8f0;position:relative;transition:background .2s;flex-shrink:0;}
.pc-toggle-track.on{background:var(--pc-green);}
.pc-toggle-knob{width:18px;height:18px;border-radius:50%;background:#fff;position:absolute;top:2px;left:2px;transition:transform .2s;box-shadow:0 1px 3px rgba(0,0,0,.15);}
.pc-toggle-track.on .pc-toggle-knob{transform:translateX(18px);}
.pc-toggle-label{font-size:.82rem;font-weight:600;color:var(--pc-text);}

/* ── Buttons ── */
.pc-btn{display:inline-flex;align-items:center;gap:.35rem;padding:.5rem 1.2rem;border-radius:10px;font-size:.84rem;font-weight:600;border:none;cursor:pointer;transition:all .2s;}
.pc-btn-primary{background:linear-gradient(135deg,var(--pc-navy),var(--pc-navy-light));color:#fff;}
.pc-btn-primary:hover{transform:translateY(-1px);box-shadow:0 4px 12px rgba(30,58,95,.3);}
.pc-btn-primary:disabled{opacity:.6;cursor:not-allowed;transform:none;box-shadow:none;}
.pc-btn-ghost{background:#f1f5f9;color:var(--pc-muted);}
.pc-btn-ghost:hover{background:#e2e8f0;color:var(--pc-text);}
.pc-btn-danger{background:#fef2f2;color:var(--pc-red);border:1px solid #fecaca;}
.pc-btn-danger:hover{background:#fee2e2;}
</style>
@endpush

@can('manage-subscriptions')
<div class="nd-page">
    <div class="nd-hero">
        <div class="nd-hero-inner">
            <ul class="nd-breadcrumb">
                <li><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="sep">/</li>
                <li class="active">Payment Configuration</li>
            </ul>
            <div class="nd-hero-row">
                <div class="nd-hero-title">
                    <h1><i class="fas fa-credit-card"></i>Payment Configuration</h1>
                    <p class="nd-hero-sub">Set up payment methods & account details shown to applicants</p>
                </div>
                <button wire:click="openCreate" class="nd-hero-btn"><i class="fas fa-plus"></i> Add Payment Method</button>
            </div>
        </div>
    </div>

    <div class="nd-content">
        @if(session()->has('success'))
            <div class="pc-alert pc-alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif

        <div class="nd-card">
            <div class="nd-card-header">
                <h3><i class="fas fa-list"></i> Payment Methods</h3>
                <div class="nd-toolbar">
                    <div class="nd-search"><i class="fas fa-search"></i>
                        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search methods...">
                    </div>
                    <select wire:model.live="perPage" class="nd-select" style="min-width:75px;">
                        <option value="10">10</option><option value="25">25</option>
                    </select>
                </div>
            </div>
            <div style="overflow-x:auto;">
                <table class="nd-table">
                    <thead>
                        <tr><th>Method</th><th>Provider</th><th>Account Name</th><th>Account No.</th><th>Branch</th><th>Status</th><th>Order</th><th style="width:100px;">Actions</th></tr>
                    </thead>
                    <tbody>
                        @forelse($configs as $config)
                            <tr>
                                <td><strong>{{ $config->method_name }}</strong></td>
                                <td style="font-size:.84rem;color:var(--nd-muted);">{{ $config->provider ?? 'â€”' }}</td>
                                <td style="font-size:.84rem;">{{ $config->account_name ?? 'â€”' }}</td>
                                <td>
                                    @if($config->account_number)
                                        <span class="pc-code">{{ $config->account_number }}</span>
                                    @else â€”
                                    @endif
                                </td>
                                <td style="font-size:.84rem;color:var(--nd-muted);">{{ $config->branch ?? 'â€”' }}</td>
                                <td>
                                    <span class="nd-badge {{ $config->is_active ? 'nd-badge-green' : 'nd-badge-red' }}" wire:click="toggleActive({{ $config->id }})" title="Click to toggle">
                                        {{ $config->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td style="text-align:center;font-size:.82rem;color:var(--nd-faint);">{{ $config->sort_order }}</td>
                                <td>
                                    <div class="pc-actions">
                                        <button wire:click="openEdit({{ $config->id }})" class="pc-act pc-act-edit" title="Edit"><i class="fas fa-edit"></i></button>
                                        <button wire:click="confirmDelete({{ $config->id }})" class="pc-act pc-act-delete" title="Delete"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8"><div class="nd-empty"><i class="fas fa-credit-card"></i><p>No payment methods configured yet</p></div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($configs->hasPages())
                <div class="nd-footer">{{ $configs->links() }}</div>
            @endif
        </div>

        @if($configs->count())
            <div class="pc-info-box">
                <i class="fas fa-info-circle" style="margin-top:.1rem;flex-shrink:0;"></i>
                <div><strong>How it works:</strong> Active payment methods are displayed to applicants on the landing page when they open the application form. They will see the account details and instructions so they can make payment before submitting proof.</div>
            </div>
        @endif
    </div>

    {{-- Create / Edit Modal --}}
    @if($showModal)
        <div class="pc-overlay" wire:click.self="$set('showModal', false)">
            <div class="pc-modal">
                <div class="pc-modal-head">
                    <h3>
                        <i class="fas fa-credit-card"></i>
                        {{ $editId ? 'Edit Payment Method' : 'Add Payment Method' }}
                    </h3>
                    <button type="button" class="pc-close" wire:click="$set('showModal', false)">&times;</button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="pc-modal-body">

                        {{-- ── Payment Type Selector ── --}}
                        <div class="pc-type-grid">
                            <label class="pc-type-card {{ $methodName === 'Mobile Money' ? 'active' : '' }}" wire:click="$set('methodName', 'Mobile Money')">
                                <div class="pc-type-check"><i class="fas fa-check"></i></div>
                                <div class="pc-type-icon mobile"><i class="fas fa-mobile-alt"></i></div>
                                <div class="pc-type-name">Mobile Money</div>
                                <div class="pc-type-hint">Airtel, MTN, Zamtel</div>
                            </label>
                            <label class="pc-type-card {{ $methodName === 'Bank Transfer' ? 'active' : '' }}" wire:click="$set('methodName', 'Bank Transfer')">
                                <div class="pc-type-check"><i class="fas fa-check"></i></div>
                                <div class="pc-type-icon bank"><i class="fas fa-landmark"></i></div>
                                <div class="pc-type-name">Bank Transfer</div>
                                <div class="pc-type-hint">Zanaco, FNB, Stanbic</div>
                            </label>
                            <label class="pc-type-card {{ !in_array($methodName, ['Mobile Money', 'Bank Transfer', '']) ? 'active' : '' }}" wire:click="$set('methodName', '')">
                                <div class="pc-type-check"><i class="fas fa-check"></i></div>
                                <div class="pc-type-icon other"><i class="fas fa-ellipsis-h"></i></div>
                                <div class="pc-type-name">Other</div>
                                <div class="pc-type-hint">Cash, cheque, etc.</div>
                            </label>
                        </div>

                        @if(!in_array($methodName, ['Mobile Money', 'Bank Transfer']))
                        <div class="pc-row" style="margin-bottom:1rem;">
                            <div>
                                <label class="pc-label">Method Name <span class="req">*</span></label>
                                <input type="text" wire:model="methodName" class="pc-input" placeholder="e.g. Cash Payment, Cheque">
                                @error('methodName')<div class="pc-error">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        @else
                            @error('methodName')<div class="pc-error" style="margin-bottom:.75rem;">{{ $message }}</div>@enderror
                        @endif

                        {{-- ── Account Details Section ── --}}
                        <div class="pc-section {{ $methodName === 'Mobile Money' ? 'pc-section-green' : 'pc-section-blue' }}">
                            <div class="pc-section-head">
                                <i class="fas fa-{{ $methodName === 'Mobile Money' ? 'mobile-alt' : 'wallet' }}"></i>
                                Account Details
                            </div>
                            <div class="pc-row pc-row-2">
                                <div>
                                    <label class="pc-label">Provider / Bank Name <span class="req">*</span></label>
                                    <input type="text" wire:model="provider" class="pc-input"
                                           placeholder="{{ $methodName === 'Mobile Money' ? 'e.g. Airtel Money, MTN MoMo' : 'e.g. FNB, Zanaco' }}">
                                    @error('provider')<div class="pc-error">{{ $message }}</div>@enderror
                                </div>
                                <div>
                                    <label class="pc-label">Account Name</label>
                                    <input type="text" wire:model="accountName" class="pc-input"
                                           placeholder="e.g. Ndinecom Solutions Ltd">
                                    @error('accountName')<div class="pc-error">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="pc-row {{ $methodName === 'Bank Transfer' ? 'pc-row-2' : '' }}">
                                <div>
                                    <label class="pc-label">Account / Phone Number</label>
                                    <input type="text" wire:model="accountNumber" class="pc-input"
                                           placeholder="{{ $methodName === 'Mobile Money' ? 'e.g. 0977 123 456' : 'e.g. 0012345678' }}">
                                    @error('accountNumber')<div class="pc-error">{{ $message }}</div>@enderror
                                </div>
                                @if($methodName === 'Bank Transfer')
                                <div>
                                    <label class="pc-label">Branch</label>
                                    <input type="text" wire:model="branch" class="pc-input" placeholder="e.g. Cairo Road Branch">
                                    @error('branch')<div class="pc-error">{{ $message }}</div>@enderror
                                </div>
                                @endif
                            </div>
                        </div>

                        {{-- ── Instructions Section ── --}}
                        <div class="pc-section pc-section-amber">
                            <div class="pc-section-head"><i class="fas fa-info-circle"></i> Payment Instructions</div>
                            <textarea wire:model="instructions" class="pc-input" rows="3"
                                      placeholder="Additional instructions shown to applicants, e.g. 'Send to number 0977... and use your bank name as reference'"></textarea>
                            @error('instructions')<div class="pc-error">{{ $message }}</div>@enderror
                        </div>

                        {{-- ── Settings Row ── --}}
                        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;">
                            <div class="pc-toggles">
                                <label class="pc-toggle-item" wire:click.prevent="$set('isActive', {{ $isActive ? 'false' : 'true' }})">
                                    <div class="pc-toggle-track {{ $isActive ? 'on' : '' }}">
                                        <div class="pc-toggle-knob"></div>
                                    </div>
                                    <span class="pc-toggle-label">{{ $isActive ? 'Active' : 'Inactive' }}</span>
                                </label>
                            </div>
                            <div style="display:flex;align-items:center;gap:.5rem;">
                                <label class="pc-label" style="margin:0;white-space:nowrap;">Sort Order</label>
                                <input type="number" wire:model="sortOrder" class="pc-input" min="0" style="width:70px;text-align:center;">
                            </div>
                        </div>
                    </div>
                    <div class="pc-modal-foot">
                        <button type="button" class="pc-btn pc-btn-ghost" wire:click="$set('showModal', false)">Cancel</button>
                        <button type="submit" class="pc-btn pc-btn-primary" wire:loading.attr="disabled" wire:target="save">
                            <span wire:loading.remove wire:target="save"><i class="fas fa-check"></i> {{ $editId ? 'Update' : 'Add' }} Method</span>
                            <span wire:loading wire:target="save"><i class="fas fa-spinner fa-spin"></i> Saving...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- Delete Modal --}}
    @if($confirmDeleteId)
        <div class="pc-overlay" wire:click.self="cancelDelete">
            <div class="pc-modal pc-modal-sm">
                <div class="pc-modal-head">
                    <h3><i class="fas fa-exclamation-triangle" style="color:var(--pc-red);"></i> Delete Method</h3>
                    <button type="button" class="pc-close" wire:click="cancelDelete">&times;</button>
                </div>
                <div class="pc-modal-body" style="text-align:center;">
                    <div style="width:56px;height:56px;border-radius:50%;background:#fef2f2;display:flex;align-items:center;justify-content:center;margin:0 auto .85rem;">
                        <i class="fas fa-trash" style="font-size:1.2rem;color:var(--pc-red);"></i>
                    </div>
                    <p style="font-weight:600;font-size:.95rem;color:var(--pc-text);margin:0 0 .35rem;">Delete this payment method?</p>
                    <p style="font-size:.82rem;color:var(--pc-muted);margin:0;">This action cannot be undone.</p>
                </div>
                <div class="pc-modal-foot">
                    <button type="button" class="pc-btn pc-btn-ghost" wire:click="cancelDelete">Cancel</button>
                    <button type="button" class="pc-btn pc-btn-danger" wire:click="delete">
                        <i class="fas fa-trash" style="margin-right:.3rem;"></i> Delete
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
