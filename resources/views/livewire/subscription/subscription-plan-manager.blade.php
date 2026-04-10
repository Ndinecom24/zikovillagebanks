<div>

@push('custom-styles')
<style>
/* ═══ Subscription Plan Manager (sp-*) ═══ */
.sp-alert{display:flex;align-items:center;gap:.5rem;padding:.65rem 1rem;border-radius:10px;font-size:.84rem;font-weight:600;margin-bottom:1rem;}
.sp-alert-success{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;}
.sp-alert-error{background:#fef2f2;color:#991b1b;border:1px solid #fecaca;}
.sp-badge-featured{background:#fffbeb;color:#b45309;border:1px solid #fde68a;font-size:.72rem;padding:.15rem .45rem;border-radius:6px;}
.sp-badge-cycle{background:#eff6ff;color:#1e40af;border:1px solid #bfdbfe;font-size:.72rem;padding:.15rem .45rem;border-radius:6px;}
.sp-actions{display:flex;align-items:center;gap:.35rem;}
.sp-act{width:28px;height:28px;border-radius:6px;border:1px solid #e5e7eb;background:#fff;display:inline-flex;align-items:center;justify-content:center;font-size:.72rem;cursor:pointer;transition:all .15s;}
.sp-act:hover{border-color:#cbd5e1;}
.sp-act-edit{color:var(--nd-navy,#1E3A5F);}
.sp-act-edit:hover{background:rgba(30,58,95,.08);}
.sp-act-delete{color:var(--nd-red,#dc2626);}
.sp-act-delete:hover{background:#fef2f2;border-color:#fecaca;}
.sp-modal-lg{max-width:720px;width:95%;}
.sp-modal-sm{max-width:380px;width:92%;}
.sp-grid{display:grid;gap:.85rem;}
.sp-grid-2{grid-template-columns:1fr 1fr;}
.sp-grid-3{grid-template-columns:1fr 1fr 1fr;}
@media(max-width:640px){.sp-grid-2,.sp-grid-3{grid-template-columns:1fr;}}
.sp-label{display:block;font-size:.76rem;font-weight:700;color:var(--nd-navy,#1E3A5F);text-transform:uppercase;letter-spacing:.4px;margin-bottom:.3rem;}
.sp-label .req{color:var(--nd-red,#dc2626);}
.sp-input{width:100%;padding:.5rem .75rem;border:1px solid #d1d5db;border-radius:8px;font-size:.86rem;background:#fff;transition:border-color .15s,box-shadow .15s;}
.sp-input:focus{outline:none;border-color:var(--nd-navy,#1E3A5F);box-shadow:0 0 0 3px rgba(30,58,95,.1);}
.sp-error{color:var(--nd-red,#dc2626);font-size:.74rem;margin-top:.2rem;}
.sp-switch{display:flex;align-items:center;gap:.45rem;font-size:.84rem;font-weight:600;color:var(--nd-text);cursor:pointer;}
.sp-switch input[type="checkbox"]{width:16px;height:16px;accent-color:var(--nd-navy,#1E3A5F);}
.sp-btn-save{padding:.45rem 1.1rem;border-radius:8px;border:none;font-size:.84rem;font-weight:600;cursor:pointer;background:linear-gradient(135deg,#1E3A5F,#2d5a8e);color:#fff;display:inline-flex;align-items:center;gap:.3rem;transition:opacity .15s;}
.sp-btn-save:hover{opacity:.9;}
</style>
@endpush

@can('manage-subscriptions')
<div class="nd-page">
    <div class="nd-hero">
        <div class="nd-hero-inner">
            <ul class="nd-breadcrumb">
                <li><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="sep">/</li>
                <li class="active">Subscription Plans</li>
            </ul>
            <div class="nd-hero-row">
                <div class="nd-hero-title">
                    <h1><i class="fas fa-tags"></i>Subscription Plans</h1>
                    <p class="nd-hero-sub">Manage pricing plans for village bank subscriptions</p>
                </div>
                <button wire:click="openCreate" class="nd-hero-btn"><i class="fas fa-plus"></i> New Plan</button>
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
                <h3><i class="fas fa-list"></i> All Plans</h3>
                <div class="nd-toolbar">
                    <div class="nd-search"><i class="fas fa-search"></i>
                        <input type="text" wire:model.debounce.300ms="search" placeholder="Search plans...">
                    </div>
                    <select wire:model="perPage" class="nd-select" style="min-width:75px;">
                        <option value="10">10</option><option value="25">25</option><option value="50">50</option>
                    </select>
                </div>
            </div>
            <div style="overflow-x:auto;">
                <table class="nd-table">
                    <thead>
                        <tr>
                            <th>#</th><th>Plan</th><th>Price</th><th>Billing</th><th>Duration</th><th>Limits</th><th>Status</th><th style="width:120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($plans as $plan)
                            <tr>
                                <td style="font-size:.78rem;color:var(--nd-faint);">{{ $plan->sort_order }}</td>
                                <td>
                                    <div style="font-weight:700;">{{ $plan->name }}
                                        @if($plan->is_featured) <span class="nd-badge sp-badge-featured" style="margin-left:.3rem;">Featured</span> @endif
                                    </div>
                                    <div style="font-size:.74rem;color:var(--nd-faint);font-family:monospace;">{{ $plan->slug }}</div>
                                </td>
                                <td><strong style="color:var(--nd-green);">{{ $plan->formattedPrice() }}</strong></td>
                                <td><span class="nd-badge sp-badge-cycle">{{ ucfirst($plan->billing_cycle) }}</span></td>
                                <td style="font-size:.84rem;">{{ $plan->duration_days }} days</td>
                                <td style="font-size:.8rem;color:var(--nd-muted);">
                                    <div><i class="fas fa-circle-notch" style="font-size:.6rem;margin-right:.2rem;color:var(--nd-faint);"></i>{{ $plan->max_circles ?? 'âˆž' }} circles</div>
                                    <div style="margin-top:.15rem;"><i class="fas fa-users" style="font-size:.6rem;margin-right:.2rem;color:var(--nd-faint);"></i>{{ $plan->max_members ?? 'âˆž' }} members</div>
                                </td>
                                <td>
                                    <button wire:click="toggleActive({{ $plan->id }})" class="nd-badge {{ $plan->is_active ? 'nd-badge-green' : 'nd-badge-red' }}" style="cursor:pointer;border:1px solid {{ $plan->is_active ? '#bbf7d0' : '#e5e7eb' }};">
                                        {{ $plan->is_active ? 'Active' : 'Inactive' }}
                                    </button>
                                </td>
                                <td>
                                    <div class="sp-actions">
                                        <button wire:click="openEdit({{ $plan->id }})" class="sp-act sp-act-edit" title="Edit"><i class="fas fa-edit"></i></button>
                                        <button wire:click="confirmDelete({{ $plan->id }})" class="sp-act sp-act-delete" title="Delete"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8"><div class="nd-empty"><i class="fas fa-tags"></i><p>No subscription plans found</p></div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($plans->hasPages())
                <div class="nd-footer">
                    <span>Showing {{ $plans->firstItem() ?? 0 }} â€“ {{ $plans->lastItem() ?? 0 }} of {{ $plans->total() }}</span>
                    {{ $plans->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- Create / Edit Modal --}}
    @if($showModal)
        <div class="nd-overlay" wire:click.self="$set('showModal', false)">
            <div class="nd-modal sp-modal-lg">
                <div class="nd-modal-head">
                    <h5><i class="fas fa-{{ $editId ? 'edit' : 'plus-circle' }}"></i> {{ $editId ? 'Edit Plan' : 'Create Plan' }}</h5>
                    <button class="nd-modal-close" wire:click="$set('showModal', false)">&times;</button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="nd-modal-body">
                        <div class="sp-grid sp-grid-2" style="margin-bottom:1rem;">
                            <div><label class="sp-label">Plan Name <span class="req">*</span></label><input type="text" wire:model.defer="name" class="sp-input">@error('name')<div class="sp-error">{{ $message }}</div>@enderror</div>
                            <div><label class="sp-label">Slug <span class="req">*</span></label><input type="text" wire:model.defer="slug" class="sp-input">@error('slug')<div class="sp-error">{{ $message }}</div>@enderror</div>
                        </div>
                        <div style="margin-bottom:1rem;"><label class="sp-label">Description</label><textarea wire:model.defer="description" class="sp-input" rows="2"></textarea></div>
                        <div class="sp-grid sp-grid-3" style="margin-bottom:1rem;">
                            <div><label class="sp-label">Price (K) <span class="req">*</span></label><input type="number" wire:model.defer="price" class="sp-input" step="0.01" min="0">@error('price')<div class="sp-error">{{ $message }}</div>@enderror</div>
                            <div><label class="sp-label">Billing Cycle <span class="req">*</span></label><select wire:model.defer="billingCycle" class="sp-input"><option value="monthly">Monthly</option><option value="quarterly">Quarterly</option><option value="yearly">Yearly</option></select>@error('billingCycle')<div class="sp-error">{{ $message }}</div>@enderror</div>
                            <div><label class="sp-label">Duration (Days) <span class="req">*</span></label><input type="number" wire:model.defer="durationDays" class="sp-input" min="1">@error('durationDays')<div class="sp-error">{{ $message }}</div>@enderror</div>
                        </div>
                        <div class="sp-grid sp-grid-3" style="margin-bottom:1rem;">
                            <div><label class="sp-label">Max Circles</label><input type="number" wire:model.defer="maxCircles" class="sp-input" min="1" placeholder="âˆž"></div>
                            <div><label class="sp-label">Max Members</label><input type="number" wire:model.defer="maxMembers" class="sp-input" min="1" placeholder="âˆž"></div>
                            <div><label class="sp-label">Sort Order</label><input type="number" wire:model.defer="sortOrder" class="sp-input" min="0"></div>
                        </div>
                        <div style="margin-bottom:1rem;"><label class="sp-label">Features <span style="font-weight:400;text-transform:none;letter-spacing:0;color:var(--nd-faint);">(one per line)</span></label><textarea wire:model.defer="featuresText" class="sp-input" rows="3" placeholder="Loan tracking&#10;SMS notifications&#10;Email reports"></textarea></div>
                        <div class="sp-grid sp-grid-2">
                            <label class="sp-switch"><input type="checkbox" wire:model.defer="isActive"> Active</label>
                            <label class="sp-switch"><input type="checkbox" wire:model.defer="isFeatured"> Featured (highlighted on landing)</label>
                        </div>
                    </div>
                    <div class="nd-modal-foot">
                        <button type="button" wire:click="$set('showModal', false)" class="nd-btn-cancel">Cancel</button>
                        <button type="submit" class="sp-btn-save"><i class="fas fa-save" style="margin-right:.3rem;"></i> {{ $editId ? 'Update' : 'Create' }} Plan</button>
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
                    <h5><i class="fas fa-exclamation-triangle"></i> Delete Plan</h5>
                    <button class="nd-modal-close" wire:click="$set('confirmDeleteId', null)">&times;</button>
                </div>
                <div class="nd-modal-body" style="text-align:center;">
                    <div style="width:56px;height:56px;border-radius:50%;background:#fef2f2;display:flex;align-items:center;justify-content:center;margin:0 auto .85rem;">
                        <i class="fas fa-trash" style="font-size:1.2rem;color:var(--nd-red);"></i>
                    </div>
                    <p style="font-weight:600;font-size:.95rem;color:var(--nd-text);margin:0 0 .35rem;">Delete this plan?</p>
                    <p style="font-size:.82rem;color:var(--nd-muted);margin:0;">Plans with existing subscriptions cannot be deleted.</p>
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
