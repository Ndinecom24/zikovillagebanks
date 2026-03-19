<style>
:root {
    --z-green: #14984f;
    --z-green-dark: #0d7a3e;
    --z-gold: #FFB223;
    --z-gold-dark: #e09a00;
}

.vt-page-header {
    background: linear-gradient(135deg, #0d7a3e 0%, #14984f 60%, #00895A 100%);
    border-radius: 12px; padding: 1.5rem 2rem; margin-bottom: 1.5rem;
    color: #fff; position: relative; overflow: hidden;
}
.vt-page-header::before {
    content: ''; position: absolute; top: -40%; right: -10%;
    width: 300px; height: 300px;
    background: radial-gradient(ellipse, rgba(255,255,255,0.07) 0%, transparent 70%);
}
.vt-page-header h1 { font-size: 1.35rem; font-weight: 700; margin: 0; }
.vt-page-header p { margin: 0.25rem 0 0; opacity: 0.85; font-size: 0.875rem; }

.vt-card { border-radius: 12px; border: 1px solid #e9ecef; overflow: hidden; }
.vt-card .card-header { background: #fff; border-bottom: 1px solid #e9ecef; padding: 1rem 1.5rem; }
.vt-card .card-header h3 { font-size: 1rem; font-weight: 700; color: #1a2332; margin: 0; }

.vt-search { position: relative; max-width: 300px; }
.vt-search input {
    padding: 0.5rem 0.85rem 0.5rem 2.5rem; border-radius: 8px;
    border: 1.5px solid #e2e8f0; font-size: 0.85rem; width: 100%; transition: border-color 0.2s;
}
.vt-search input:focus { border-color: var(--z-green); box-shadow: 0 0 0 3px rgba(20,152,79,0.1); outline: none; }
.vt-search .si { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; pointer-events: none; }

.vt-table thead th {
    font-size: 0.78rem; font-weight: 700; color: #64748b;
    border-bottom: 2px solid #e2e8f0; cursor: pointer; user-select: none; white-space: nowrap;
}
.vt-table thead th:hover { color: var(--z-green); }
.vt-table tbody tr:hover { background: #f0fdf4; }
.sort-icon { font-size: 0.7rem; margin-left: 4px; opacity: 0.5; }
.sort-icon.active { opacity: 1; color: var(--z-green); }

.vt-action {
    display: inline-flex; align-items: center; justify-content: center;
    width: 32px; height: 32px; border-radius: 6px; border: none;
    transition: all 0.2s; cursor: pointer; font-size: 0.82rem;
}
.vt-action-edit { background: rgba(20,152,79,0.1); color: var(--z-green); }
.vt-action-edit:hover { background: var(--z-green); color: #fff; }
.vt-action-delete { background: rgba(220,38,38,0.1); color: #dc2626; }
.vt-action-delete:hover { background: #dc2626; color: #fff; }
.vt-action-save { background: rgba(20,152,79,0.1); color: var(--z-green); }
.vt-action-save:hover { background: var(--z-green); color: #fff; }
.vt-action-cancel { background: rgba(107,114,128,0.1); color: #6b7280; }
.vt-action-cancel:hover { background: #6b7280; color: #fff; }

.btn-zesco {
    background: linear-gradient(135deg, var(--z-gold), #f59e0b);
    color: #fff; border-radius: 8px; padding: 0.5rem 1.25rem;
    font-weight: 600; font-size: 0.85rem; border: none;
    transition: all 0.2s; display: inline-flex; align-items: center; gap: 0.35rem;
}
.btn-zesco:hover { background: linear-gradient(135deg, var(--z-gold-dark), #d97706); box-shadow: 0 4px 12px rgba(255,178,35,0.35); color: #fff; }
.btn-zesco-green {
    background: linear-gradient(135deg, var(--z-green), var(--z-green-dark));
    color: #fff; border-radius: 8px; padding: 0.5rem 1.25rem;
    font-weight: 600; font-size: 0.85rem; border: none; transition: all 0.2s;
}
.btn-zesco-green:hover { background: linear-gradient(135deg, #0d7a3e, #065f30); color: #fff; }

.vt-per-page {
    border-radius: 6px; border: 1.5px solid #e2e8f0;
    padding: 0.35rem 0.5rem; font-size: 0.825rem; color: #374151;
}
.vt-per-page:focus { border-color: var(--z-green); outline: none; }

.vt-loading {
    position: absolute; inset: 0; background: rgba(255,255,255,0.7);
    display: flex; align-items: center; justify-content: center;
    z-index: 10; border-radius: 12px;
}

.vt-modal .modal-content { border: none; border-radius: 16px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.15); }
.vt-modal .modal-header-green {
    background: linear-gradient(135deg, #004D2E 0%, #006B3F 60%, #00895A 100%);
    padding: 1.25rem 1.5rem; color: #fff; border: none;
}
.vt-modal .modal-header-green h5 { font-weight: 700; margin: 0; font-size: 1.05rem; }
.vt-modal .modal-header-green .close { color: #fff; opacity: 0.7; text-shadow: none; }

.vt-input {
    padding: 0.6rem 0.85rem; border-radius: 8px;
    border: 1.5px solid #e2e8f0; font-size: 0.875rem; transition: border-color 0.2s;
}
.vt-input:focus { border-color: var(--z-green); box-shadow: 0 0 0 3px rgba(20,152,79,0.1); outline: none; }

.vt-badge {
    display: inline-flex; align-items: center; gap: 0.35rem;
    background: #fffbeb; color: #92400e; padding: 0.3rem 0.75rem;
    border-radius: 20px; font-size: 0.82rem; font-weight: 600;
    border: 1px solid #fde68a;
}

.vt-edit-input {
    padding: 0.35rem 0.65rem; border-radius: 6px;
    border: 1.5px solid var(--z-green); font-size: 0.85rem;
    max-width: 300px;
}
.vt-edit-input:focus { box-shadow: 0 0 0 3px rgba(20,152,79,0.15); outline: none; }

.vt-count {
    background: linear-gradient(135deg, var(--z-green), var(--z-green-dark));
    color: #fff; font-size: 0.72rem; font-weight: 700;
    padding: 0.2rem 0.6rem; border-radius: 20px;
}
</style>

<div>
    <!-- Page Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="vt-page-header">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div>
                        <h1><i class="fas fa-handshake mr-2" style="color: var(--z-gold)"></i>Venture Management</h1>
                        <p>Manage venture types for Independent Power Producers</p>
                    </div>
                    <button wire:click="openCreateModal" class="btn-zesco">
                        <i class="fas fa-plus"></i> Add Venture
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <section class="content">
        <div class="container-fluid">

            {{-- Flash --}}
            @if(session()->has('message'))
                <div class="alert alert-success" style="border-radius: 10px; font-size: 0.9rem;">
                    <i class="fas fa-check-circle mr-1"></i> {{ session('message') }}
                </div>
            @endif

            {{-- Table Card --}}
            <div class="card vt-card" style="position: relative;">
                <div wire:loading.flex class="vt-loading">
                    <div class="spinner-border text-success"><span class="sr-only">Loading...</span></div>
                </div>

                <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="gap: 0.75rem;">
                    <h3>
                        <i class="fas fa-list mr-2" style="color: var(--z-green)"></i>All Ventures
                        <span class="vt-count ml-2">{{ $ventures->total() }}</span>
                    </h3>
                    <div class="d-flex align-items-center" style="gap: 0.75rem;">
                        <div class="vt-search">
                            <i class="fas fa-search si"></i>
                            <input type="text" wire:model.debounce.300ms="search" placeholder="Search ventures...">
                        </div>
                        <select wire:model="perPage" class="vt-per-page">
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover vt-table mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 60px;" wire:click="sortBy('id')">
                                        #
                                        @if($sortField === 'id')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} sort-icon active"></i>
                                        @else
                                            <i class="fas fa-sort sort-icon"></i>
                                        @endif
                                    </th>
                                    <th wire:click="sortBy('venture_type')">
                                        Venture Type
                                        @if($sortField === 'venture_type')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} sort-icon active"></i>
                                        @else
                                            <i class="fas fa-sort sort-icon"></i>
                                        @endif
                                    </th>
                                    <th style="width: 180px;">Created</th>
                                    <th style="width: 120px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($ventures as $item)
                                    <tr>
                                        <td style="color: #94a3b8; font-size: 0.82rem;">{{ $item->id }}</td>
                                        <td>
                                            @if($editId === $item->id)
                                                <div class="d-flex align-items-center" style="gap: 0.5rem;">
                                                    <input type="text" wire:model.defer="editVenture"
                                                           class="form-control vt-edit-input"
                                                           wire:keydown.enter="saveEdit"
                                                           wire:keydown.escape="cancelEdit">
                                                    @error('editVenture')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            @else
                                                <span class="vt-badge">
                                                    <i class="fas fa-handshake" style="font-size: 0.7rem; color: var(--z-gold);"></i>
                                                    {{ $item->venture_type }}
                                                </span>
                                            @endif
                                        </td>
                                        <td style="font-size: 0.82rem; color: #6b7280;">
                                            {{ $item->created_at ? $item->created_at->format('M d, Y') : 'N/A' }}
                                        </td>
                                        <td>
                                            <div class="d-flex" style="gap: 4px;">
                                                @if($editId === $item->id)
                                                    <button wire:click="saveEdit" class="vt-action vt-action-save" title="Save">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                    <button wire:click="cancelEdit" class="vt-action vt-action-cancel" title="Cancel">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                @else
                                                    <button wire:click="startEdit({{ $item->id }})" class="vt-action vt-action-edit" title="Edit">
                                                        <i class="fas fa-pen"></i>
                                                    </button>
                                                    <button wire:click="confirmDelete({{ $item->id }})" class="vt-action vt-action-delete" title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4" style="color: #94a3b8;">
                                            <i class="fas fa-handshake fa-2x mb-2 d-block"></i>
                                            @if(!empty($search))
                                                No ventures found matching "{{ $search }}".
                                                <a href="#" wire:click.prevent="$set('search', '')" style="color: var(--z-green);">Clear search</a>
                                            @else
                                                No ventures created yet.
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer bg-white border-top d-flex align-items-center justify-content-between flex-wrap" style="gap: 0.75rem;">
                    <span style="font-size: 0.82rem; color: #6b7280;">
                        Showing {{ $ventures->firstItem() ?? 0 }} - {{ $ventures->lastItem() ?? 0 }} of {{ $ventures->total() }}
                    </span>
                    {{ $ventures->links() }}
                </div>
            </div>
        </div>
    </section>

    {{-- ===== CREATE MODAL ===== --}}
    @if($showCreateModal)
    <div class="modal fade show vt-modal" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 480px;">
            <div class="modal-content">
                <div class="modal-header-green d-flex align-items-center justify-content-between">
                    <h5><i class="fas fa-plus-circle mr-2"></i> Add New Venture</h5>
                    <button type="button" class="close" wire:click="$set('showCreateModal', false)">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 1.5rem;">
                    <label style="font-size: 0.825rem; font-weight: 600; color: #1a2332; margin-bottom: 0.4rem; display: block;">
                        Venture Type <span class="text-danger">*</span>
                    </label>
                    <input type="text" wire:model.defer="newVenture" class="form-control vt-input"
                           placeholder="e.g. Joint Venture"
                           wire:keydown.enter="createVenture">
                    @error('newVenture')
                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                    @enderror
                </div>
                <div style="padding: 0 1.5rem 1.25rem; display: flex; gap: 0.75rem; justify-content: flex-end;">
                    <button wire:click="$set('showCreateModal', false)" class="btn btn-light" style="border-radius: 8px;">Cancel</button>
                    <button wire:click="createVenture" class="btn-zesco-green" wire:loading.attr="disabled">
                        <i class="fas fa-check-circle mr-1"></i> Create Venture
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ===== DELETE CONFIRMATION ===== --}}
    @if($deleteId)
    <div class="modal fade show vt-modal" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 420px;">
            <div class="modal-content">
                <div style="padding: 2rem; text-align: center;">
                    <div style="width: 56px; height: 56px; border-radius: 50%; background: #fef2f2; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                        <i class="fas fa-exclamation-triangle" style="font-size: 1.5rem; color: #dc2626;"></i>
                    </div>
                    <h5 style="font-weight: 700; margin-bottom: 0.5rem;">Delete Venture?</h5>
                    <p style="color: #6b7280; font-size: 0.9rem;">
                        Are you sure you want to delete <strong class="text-danger">{{ $deleteName }}</strong>?
                        This may affect IPPs using this venture type.
                    </p>
                    <div class="d-flex justify-content-center" style="gap: 0.75rem; margin-top: 1.5rem;">
                        <button wire:click="cancelDelete" class="btn btn-light px-4" style="border-radius: 8px;">Cancel</button>
                        <button wire:click="deleteVenture" class="btn btn-danger px-4" style="border-radius: 8px; font-weight: 600;">
                            <i class="fas fa-trash-alt mr-1"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
