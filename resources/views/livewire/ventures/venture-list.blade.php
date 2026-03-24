
<div>
    <!-- Page Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="z-page-header">
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
            <div class="card z-card">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="gap: 0.75rem;">
                    <h3>
                        <i class="fas fa-list mr-2" style="color: var(--z-green)"></i>All Ventures
                        <span class="z-count ml-2">{{ $ventures->total() }}</span>
                    </h3>
                    <div class="d-flex align-items-center" style="gap: 0.75rem;">
                        <div class="z-search">
                            <i class="fas fa-search si"></i>
                            <input type="text" wire:model.debounce.300ms="search" placeholder="Search ventures...">
                        </div>
                        <select wire:model="perPage" class="z-per-page">
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover z-table mb-0">
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
                                                           class="form-control z-edit-input"
                                                           wire:keydown.enter="saveEdit"
                                                           wire:keydown.escape="cancelEdit">
                                                    @error('editVenture')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            @else
                                                <span class="z-badge">
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
                                                    <button wire:click="saveEdit" class="z-action z-action-save" title="Save">
                                                        <span wire:loading wire:target="saveEdit" class="spinner-border spinner-border-sm" role="status"></span>
                                                        <i wire:loading.remove wire:target="saveEdit" class="fas fa-check"></i>
                                                    </button>
                                                    <button wire:click="cancelEdit" class="z-action z-action-cancel" title="Cancel">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                @else
                                                    <button wire:click="startEdit({{ $item->id }})" class="z-action z-action-edit" title="Edit">
                                                        <span wire:loading wire:target="startEdit({{ $item->id }})" class="spinner-border spinner-border-sm" role="status"></span>
                                                        <i wire:loading.remove wire:target="startEdit({{ $item->id }})" class="fas fa-pen"></i>
                                                    </button>
                                                    <button wire:click="confirmDelete({{ $item->id }})" class="z-action z-action-delete" title="Delete">
                                                        <span wire:loading wire:target="confirmDelete({{ $item->id }})" class="spinner-border spinner-border-sm" role="status"></span>
                                                        <i wire:loading.remove wire:target="confirmDelete({{ $item->id }})" class="fas fa-trash-alt"></i>
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
    <div class="modal fade show z-modal" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 480px;">
            <div class="modal-content">
                <div class="modal-header-zesco d-flex align-items-center justify-content-between">
                    <h5><i class="fas fa-plus-circle mr-2"></i> Add New Venture</h5>
                    <button type="button" class="close" wire:click="$set('showCreateModal', false)">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 1.5rem;">
                    <label style="font-size: 0.825rem; font-weight: 600; color: #1a2332; margin-bottom: 0.4rem; display: block;">
                        Venture Type <span class="text-danger">*</span>
                    </label>
                    <input type="text" wire:model.defer="newVenture" class="form-control z-input"
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
    <div class="modal fade show z-modal" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
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