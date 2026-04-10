<div>

@push('custom-styles')
<style>
/* ═══ Payment Config Manager (pc-*) ═══ */
.pc-alert{display:flex;align-items:center;gap:.5rem;padding:.65rem 1rem;border-radius:10px;font-size:.84rem;font-weight:600;margin-bottom:1rem;}
.pc-alert-success{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;}
.pc-code{font-family:monospace;font-size:.82rem;color:var(--nd-navy,#1E3A5F);background:#f1f5f9;padding:.15rem .4rem;border-radius:4px;}
.pc-actions{display:flex;align-items:center;gap:.35rem;}
.pc-act{width:28px;height:28px;border-radius:6px;border:1px solid #e5e7eb;background:#fff;display:inline-flex;align-items:center;justify-content:center;font-size:.72rem;cursor:pointer;transition:all .15s;}
.pc-act:hover{border-color:#cbd5e1;}
.pc-act-edit{color:var(--nd-navy,#1E3A5F);}
.pc-act-edit:hover{background:rgba(30,58,95,.08);}
.pc-act-delete{color:var(--nd-red,#dc2626);}
.pc-act-delete:hover{background:#fef2f2;border-color:#fecaca;}
.pc-info-box{display:flex;gap:.5rem;padding:.65rem .85rem;background:#eff6ff;border:1px solid #bfdbfe;border-radius:8px;font-size:.82rem;color:#1e40af;margin-top:1rem;}
.pc-modal-lg{max-width:720px;width:95%;}
.pc-modal-sm{max-width:380px;width:92%;}
.pc-grid{display:grid;gap:.85rem;}
.pc-grid-2{grid-template-columns:1fr 1fr;}
.pc-grid-3{grid-template-columns:1fr 1fr 1fr;}
@media(max-width:640px){.pc-grid-2,.pc-grid-3{grid-template-columns:1fr;}}
.pc-label{display:block;font-size:.76rem;font-weight:700;color:var(--nd-navy,#1E3A5F);text-transform:uppercase;letter-spacing:.4px;margin-bottom:.3rem;}
.pc-label .req{color:var(--nd-red,#dc2626);}
.pc-input{width:100%;padding:.5rem .75rem;border:1px solid #d1d5db;border-radius:8px;font-size:.86rem;background:#fff;transition:border-color .15s,box-shadow .15s;}
.pc-input:focus{outline:none;border-color:var(--nd-navy,#1E3A5F);box-shadow:0 0 0 3px rgba(30,58,95,.1);}
.pc-error{color:var(--nd-red,#dc2626);font-size:.74rem;margin-top:.2rem;}
.pc-switch{display:flex;align-items:center;gap:.45rem;font-size:.84rem;font-weight:600;color:var(--nd-text);cursor:pointer;}
.pc-switch input[type="checkbox"]{width:16px;height:16px;accent-color:var(--nd-navy,#1E3A5F);}
.pc-btn-save{padding:.45rem 1.1rem;border-radius:8px;border:none;font-size:.84rem;font-weight:600;cursor:pointer;background:linear-gradient(135deg,#1E3A5F,#2d5a8e);color:#fff;display:inline-flex;align-items:center;gap:.3rem;transition:opacity .15s;}
.pc-btn-save:hover{opacity:.9;}
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
                        <input type="text" wire:model.debounce.300ms="search" placeholder="Search methods...">
                    </div>
                    <select wire:model="perPage" class="nd-select" style="min-width:75px;">
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
        <div class="nd-overlay" wire:click.self="$set('showModal', false)">
            <div class="nd-modal pc-modal-lg">
                <div class="nd-modal-head">
                    <h5><i class="fas fa-{{ $editId ? 'edit' : 'plus-circle' }}"></i> {{ $editId ? 'Edit' : 'Add' }} Payment Method</h5>
                    <button class="nd-modal-close" wire:click="$set('showModal', false)">&times;</button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="nd-modal-body">
                        <div class="pc-grid pc-grid-2" style="margin-bottom:1rem;">
                            <div><label class="pc-label">Method Name <span class="req">*</span></label><input type="text" wire:model.defer="methodName" class="pc-input" placeholder="e.g. Mobile Money, Bank Transfer">@error('methodName')<div class="pc-error">{{ $message }}</div>@enderror</div>
                            <div><label class="pc-label">Provider</label><input type="text" wire:model.defer="provider" class="pc-input" placeholder="e.g. Airtel Money, Zanaco">@error('provider')<div class="pc-error">{{ $message }}</div>@enderror</div>
                        </div>
                        <div class="pc-grid pc-grid-2" style="margin-bottom:1rem;">
                            <div><label class="pc-label">Account Name</label><input type="text" wire:model.defer="accountName" class="pc-input" placeholder="e.g. Ndinecom Solutions Ltd">@error('accountName')<div class="pc-error">{{ $message }}</div>@enderror</div>
                            <div><label class="pc-label">Account Number</label><input type="text" wire:model.defer="accountNumber" class="pc-input" placeholder="e.g. 0012345678">@error('accountNumber')<div class="pc-error">{{ $message }}</div>@enderror</div>
                        </div>
                        <div class="pc-grid pc-grid-3" style="margin-bottom:1rem;">
                            <div><label class="pc-label">Branch</label><input type="text" wire:model.defer="branch" class="pc-input" placeholder="e.g. Cairo Road">@error('branch')<div class="pc-error">{{ $message }}</div>@enderror</div>
                            <div><label class="pc-label">Sort Order</label><input type="number" wire:model.defer="sortOrder" class="pc-input" min="0"></div>
                            <div style="display:flex;align-items:flex-end;padding-bottom:.5rem;"><label class="pc-switch"><input type="checkbox" wire:model.defer="isActive"> Active</label></div>
                        </div>
                        <div><label class="pc-label">Payment Instructions</label><textarea wire:model.defer="instructions" class="pc-input" rows="3" placeholder="Additional instructions for applicants..."></textarea>@error('instructions')<div class="pc-error">{{ $message }}</div>@enderror</div>
                    </div>
                    <div class="nd-modal-foot">
                        <button type="button" wire:click="$set('showModal', false)" class="nd-btn-cancel">Cancel</button>
                        <button type="submit" class="pc-btn-save"><i class="fas fa-save" style="margin-right:.3rem;"></i> {{ $editId ? 'Update' : 'Save' }}</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- Delete Modal --}}
    @if($confirmDeleteId)
        <div class="nd-overlay" wire:click.self="cancelDelete">
            <div class="nd-modal pc-modal-sm">
                <div class="nd-modal-head">
                    <h5><i class="fas fa-exclamation-triangle"></i> Delete Method</h5>
                    <button class="nd-modal-close" wire:click="cancelDelete">&times;</button>
                </div>
                <div class="nd-modal-body" style="text-align:center;">
                    <div style="width:56px;height:56px;border-radius:50%;background:#fef2f2;display:flex;align-items:center;justify-content:center;margin:0 auto .85rem;">
                        <i class="fas fa-trash" style="font-size:1.2rem;color:var(--nd-red);"></i>
                    </div>
                    <p style="font-weight:600;font-size:.95rem;color:var(--nd-text);margin:0 0 .35rem;">Delete this payment method?</p>
                    <p style="font-size:.82rem;color:var(--nd-muted);margin:0;">This action cannot be undone.</p>
                </div>
                <div class="nd-modal-foot">
                    <button wire:click="cancelDelete" class="nd-btn-cancel">Cancel</button>
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
