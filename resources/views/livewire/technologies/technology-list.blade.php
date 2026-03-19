<style>
:root {
    --z-green: #14984f;
    --z-green-dark: #0d7a3e;
    --z-gold: #FFB223;
    --z-gold-dark: #e09a00;
}

/* ── Page Header ──────────────────────────── */
.tc-page-header {
    background: linear-gradient(135deg, #0d7a3e 0%, #14984f 60%, #00895A 100%);
    border-radius: 12px; padding: 1.5rem 2rem; margin-bottom: 1.5rem;
    color: #fff; position: relative; overflow: hidden;
}
.tc-page-header::before {
    content: ''; position: absolute; top: -40%; right: -10%;
    width: 300px; height: 300px;
    background: radial-gradient(ellipse, rgba(255,255,255,0.07) 0%, transparent 70%);
}
.tc-page-header h1 { font-size: 1.35rem; font-weight: 700; margin: 0; }
.tc-page-header p  { margin: 0.25rem 0 0; opacity: 0.85; font-size: 0.875rem; }

/* ── Cards ────────────────────────────────── */
.tc-card { border-radius: 12px; border: 1px solid #e9ecef; overflow: hidden; }
.tc-card .card-header { background: #fff; border-bottom: 1px solid #e9ecef; padding: 1rem 1.5rem; }
.tc-card .card-header h3 { font-size: 1rem; font-weight: 700; color: #1a2332; margin: 0; }

/* ── Search ───────────────────────────────── */
.tc-search { position: relative; max-width: 300px; }
.tc-search input {
    padding: 0.5rem 0.85rem 0.5rem 2.5rem; border-radius: 8px;
    border: 1.5px solid #e2e8f0; font-size: 0.85rem; width: 100%; transition: border-color 0.2s;
}
.tc-search input:focus { border-color: var(--z-green); box-shadow: 0 0 0 3px rgba(20,152,79,0.1); outline: none; }
.tc-search .si { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; pointer-events: none; }

/* ── Table ────────────────────────────────── */
.tc-table thead th {
    font-size: 0.78rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.03em;
    border-bottom: 2px solid #e2e8f0; cursor: pointer; user-select: none; white-space: nowrap;
}
.tc-table thead th:hover { color: var(--z-green); }
.tc-table tbody tr { transition: background 0.15s; }
.tc-table tbody tr:hover { background: #f0fdf4; }
.sort-icon { font-size: 0.7rem; margin-left: 4px; opacity: 0.5; }
.sort-icon.active { opacity: 1; color: var(--z-green); }

/* ── Action Buttons ───────────────────────── */
.tc-action {
    display: inline-flex; align-items: center; justify-content: center;
    width: 32px; height: 32px; border-radius: 6px; border: none;
    transition: all 0.2s; cursor: pointer; font-size: 0.82rem;
}
.tc-action-view   { background: rgba(59,130,246,0.1); color: #3b82f6; }
.tc-action-view:hover { background: #3b82f6; color: #fff; }
.tc-action-edit   { background: rgba(20,152,79,0.1); color: var(--z-green); }
.tc-action-edit:hover { background: var(--z-green); color: #fff; }
.tc-action-delete { background: rgba(220,38,38,0.1); color: #dc2626; }
.tc-action-delete:hover { background: #dc2626; color: #fff; }
.tc-action-save   { background: rgba(20,152,79,0.1); color: var(--z-green); }
.tc-action-save:hover { background: var(--z-green); color: #fff; }
.tc-action-cancel { background: rgba(107,114,128,0.1); color: #6b7280; }
.tc-action-cancel:hover { background: #6b7280; color: #fff; }

/* ── Buttons ──────────────────────────────── */
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

/* ── Controls ─────────────────────────────── */
.tc-per-page {
    border-radius: 6px; border: 1.5px solid #e2e8f0;
    padding: 0.35rem 0.5rem; font-size: 0.825rem; color: #374151;
}
.tc-per-page:focus { border-color: var(--z-green); outline: none; }

/* ── Loading ──────────────────────────────── */
.tc-loading {
    position: absolute; inset: 0; background: rgba(255,255,255,0.7);
    display: flex; align-items: center; justify-content: center;
    z-index: 10; border-radius: 12px;
}

/* ── Modals ───────────────────────────────── */
.tc-modal .modal-content { border: none; border-radius: 16px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.15); }
.tc-modal .modal-header-green {
    background: linear-gradient(135deg, #004D2E 0%, #006B3F 60%, #00895A 100%);
    padding: 1.25rem 1.5rem; color: #fff; border: none;
}
.tc-modal .modal-header-green h5 { font-weight: 700; margin: 0; font-size: 1.05rem; }
.tc-modal .modal-header-green .close { color: #fff; opacity: 0.7; text-shadow: none; }

/* ── Form Inputs ──────────────────────────── */
.tc-input {
    padding: 0.6rem 0.85rem; border-radius: 8px;
    border: 1.5px solid #e2e8f0; font-size: 0.875rem; transition: border-color 0.2s;
}
.tc-input:focus { border-color: var(--z-green); box-shadow: 0 0 0 3px rgba(20,152,79,0.1); outline: none; }

/* ── Badge / Tag ──────────────────────────── */
.tc-badge {
    display: inline-flex; align-items: center; gap: 0.35rem;
    background: #ecfdf5; color: #065f46; padding: 0.3rem 0.75rem;
    border-radius: 20px; font-size: 0.82rem; font-weight: 600;
    border: 1px solid #a7f3d0;
}

.tc-edit-input {
    padding: 0.35rem 0.65rem; border-radius: 6px;
    border: 1.5px solid var(--z-green); font-size: 0.85rem;
    max-width: 300px;
}
.tc-edit-input:focus { box-shadow: 0 0 0 3px rgba(20,152,79,0.15); outline: none; }

.tc-count {
    background: linear-gradient(135deg, var(--z-green), var(--z-green-dark));
    color: #fff; font-size: 0.72rem; font-weight: 700;
    padding: 0.2rem 0.6rem; border-radius: 20px;
}

/* ── Detail Modal ─────────────────────────── */
.tc-detail-label {
    font-size: 0.75rem; font-weight: 700; color: #64748b;
    text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.15rem;
}
.tc-detail-value { font-size: 0.95rem; font-weight: 600; color: #1a2332; }
.tc-detail-card {
    background: #f8fafc; border-radius: 10px; padding: 1rem 1.25rem;
    border: 1px solid #e2e8f0;
}
.tc-ipp-chip {
    display: inline-flex; align-items: center; gap: 0.35rem;
    background: #fff; border: 1px solid #e2e8f0; border-radius: 8px;
    padding: 0.35rem 0.75rem; font-size: 0.8rem; color: #374151;
    transition: border-color 0.2s;
}
.tc-ipp-chip:hover { border-color: var(--z-green); }
.tc-stat-box {
    text-align: center; background: linear-gradient(135deg, #ecfdf5, #d1fae5);
    border-radius: 10px; padding: 1rem; border: 1px solid #a7f3d0;
}
.tc-stat-num { font-size: 1.5rem; font-weight: 800; color: var(--z-green); line-height: 1; }
.tc-stat-label { font-size: 0.72rem; color: #6b7280; font-weight: 600; margin-top: 0.25rem; }
</style>

<div>
    <!-- Page Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="tc-page-header">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div>
                        <h1><i class="fas fa-microchip mr-2" style="color: var(--z-gold)"></i>Technology Management</h1>
                        <p>Manage energy generation technologies for Independent Power Producers</p>
                    </div>
                    <button wire:click="openCreateModal" class="btn-zesco">
                        <i class="fas fa-plus"></i> Add Technology
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
            <div class="card tc-card" style="position: relative;">
                <div wire:loading.flex class="tc-loading">
                    <div class="spinner-border text-success"><span class="sr-only">Loading...</span></div>
                </div>

                <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="gap: 0.75rem;">
                    <h3>
                        <i class="fas fa-list mr-2" style="color: var(--z-green)"></i>All Technologies
                        <span class="tc-count ml-2">{{ $technologies->total() }}</span>
                    </h3>
                    <div class="d-flex align-items-center" style="gap: 0.75rem;">
                        <div class="tc-search">
                            <i class="fas fa-search si"></i>
                            <input type="text" wire:model.debounce.300ms="search" placeholder="Search technologies...">
                        </div>
                        <select wire:model="perPage" class="tc-per-page">
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover tc-table mb-0">
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
                                    <th wire:click="sortBy('technology_name')">
                                        Technology Name
                                        @if($sortField === 'technology_name')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} sort-icon active"></i>
                                        @else
                                            <i class="fas fa-sort sort-icon"></i>
                                        @endif
                                    </th>
                                    <th style="width: 120px;">IPPs Using</th>
                                    <th style="width: 180px;">Created</th>
                                    <th style="width: 150px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($technologies as $item)
                                    <tr>
                                        <td style="color: #94a3b8; font-size: 0.82rem;">{{ $item->id }}</td>
                                        <td>
                                            @if($editId === $item->id)
                                                <div class="d-flex align-items-center" style="gap: 0.5rem;">
                                                    <input type="text" wire:model.defer="editTechnology"
                                                           class="form-control tc-edit-input"
                                                           wire:keydown.enter="saveEdit"
                                                           wire:keydown.escape="cancelEdit">
                                                    @error('editTechnology')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            @else
                                                <span class="tc-badge">
                                                    <i class="fas fa-microchip" style="font-size: 0.7rem; color: var(--z-green);"></i>
                                                    {{ $item->technology_name }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $ippCount = \App\Models\IndependentProducer::where('technology', $item->technology_name)->count();
                                            @endphp
                                            <span style="font-size: 0.82rem; font-weight: 600; color: {{ $ippCount > 0 ? 'var(--z-green)' : '#94a3b8' }};">
                                                {{ $ippCount }}
                                            </span>
                                        </td>
                                        <td style="font-size: 0.82rem; color: #6b7280;">
                                            {{ $item->created_at ? $item->created_at->format('M d, Y') : 'N/A' }}
                                        </td>
                                        <td>
                                            <div class="d-flex" style="gap: 4px;">
                                                @if($editId === $item->id)
                                                    <button wire:click="saveEdit" class="tc-action tc-action-save" title="Save">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                    <button wire:click="cancelEdit" class="tc-action tc-action-cancel" title="Cancel">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                @else
                                                    <button wire:click="showDetails({{ $item->id }})" class="tc-action tc-action-view" title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button wire:click="startEdit({{ $item->id }})" class="tc-action tc-action-edit" title="Edit">
                                                        <i class="fas fa-pen"></i>
                                                    </button>
                                                    <button wire:click="confirmDelete({{ $item->id }})" class="tc-action tc-action-delete" title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4" style="color: #94a3b8;">
                                            <i class="fas fa-microchip fa-2x mb-2 d-block"></i>
                                            @if(!empty($search))
                                                No technologies found matching "{{ $search }}".
                                                <a href="#" wire:click.prevent="$set('search', '')" style="color: var(--z-green);">Clear search</a>
                                            @else
                                                No technologies created yet.
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
                        Showing {{ $technologies->firstItem() ?? 0 }} - {{ $technologies->lastItem() ?? 0 }} of {{ $technologies->total() }}
                    </span>
                    {{ $technologies->links() }}
                </div>
            </div>
        </div>
    </section>

    {{-- ===== CREATE MODAL ===== --}}
    @if($showCreateModal)
    <div class="modal fade show tc-modal" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header-green d-flex align-items-center justify-content-between">
                    <h5><i class="fas fa-plus-circle mr-2"></i> Add New Technology</h5>
                    <button type="button" class="close" wire:click="$set('showCreateModal', false)">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 1.5rem;">
                    <label style="font-size: 0.825rem; font-weight: 600; color: #1a2332; margin-bottom: 0.4rem; display: block;">
                        Technology Name <span class="text-danger">*</span>
                    </label>
                    <input type="text" wire:model.defer="newTechnology" class="form-control tc-input"
                           placeholder="e.g. Solar PV, Wind Turbine, Hydro..."
                           wire:keydown.enter="createTechnology">
                    @error('newTechnology')
                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                    @enderror
                    <div class="mt-3" style="padding: 0.75rem; background: #f0f9ff; border-radius: 8px; border: 1px solid #bae6fd;">
                        <small style="color: #0369a1;"><i class="fas fa-info-circle mr-1"></i> Technology names are stored in uppercase and must be unique.</small>
                    </div>
                </div>
                <div style="padding: 0 1.5rem 1.25rem; display: flex; gap: 0.75rem; justify-content: flex-end;">
                    <button wire:click="$set('showCreateModal', false)" class="btn btn-light" style="border-radius: 8px;">Cancel</button>
                    <button wire:click="createTechnology" class="btn-zesco-green" wire:loading.attr="disabled">
                        <i class="fas fa-check-circle mr-1"></i> Create Technology
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ===== DETAIL MODAL ===== --}}
    @if($showDetailModal && $detailTechnology)
    <div class="modal fade show tc-modal" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
            <div class="modal-content">
                <div class="modal-header-green d-flex align-items-center justify-content-between">
                    <h5><i class="fas fa-microchip mr-2"></i> Technology Details</h5>
                    <button type="button" class="close" wire:click="closeDetail">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 1.5rem;">
                    {{-- Overview --}}
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="tc-stat-box">
                                <div class="tc-stat-num">{{ $detailTechnology->id }}</div>
                                <div class="tc-stat-label">ID</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="tc-stat-box">
                                <div class="tc-stat-num">{{ count($detailIpps) }}</div>
                                <div class="tc-stat-label">IPPs Using</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="tc-stat-box">
                                <div class="tc-stat-num">
                                    {{ $detailTechnology->created_at ? $detailTechnology->created_at->diffForHumans(null, true) : '—' }}
                                </div>
                                <div class="tc-stat-label">Age</div>
                            </div>
                        </div>
                    </div>

                    {{-- Info Card --}}
                    <div class="tc-detail-card mb-3">
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <div class="tc-detail-label">Technology Name</div>
                                <div class="tc-detail-value">
                                    <span class="tc-badge">
                                        <i class="fas fa-microchip" style="font-size: 0.7rem; color: var(--z-green);"></i>
                                        {{ $detailTechnology->technology_name }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="tc-detail-label">Created At</div>
                                <div class="tc-detail-value" style="font-size: 0.88rem;">
                                    {{ $detailTechnology->created_at ? $detailTechnology->created_at->format('M d, Y \a\t H:i') : 'N/A' }}
                                </div>
                            </div>
                        </div>
                        @if($detailTechnology->updated_at && $detailTechnology->updated_at != $detailTechnology->created_at)
                        <div class="mt-2">
                            <div class="tc-detail-label">Last Updated</div>
                            <div class="tc-detail-value" style="font-size: 0.88rem;">
                                {{ $detailTechnology->updated_at->format('M d, Y \a\t H:i') }}
                            </div>
                        </div>
                        @endif
                    </div>

                    {{-- Related IPPs --}}
                    @if(count($detailIpps) > 0)
                    <div>
                        <h6 style="font-weight: 700; font-size: 0.88rem; color: #1a2332; margin-bottom: 0.5rem;">
                            <i class="fas fa-industry mr-1" style="color: var(--z-gold);"></i> Associated IPPs
                        </h6>
                        <div class="d-flex flex-wrap" style="gap: 0.5rem;">
                            @foreach($detailIpps as $ipp)
                                <span class="tc-ipp-chip">
                                    <i class="fas fa-bolt" style="color: var(--z-gold); font-size: 0.7rem;"></i>
                                    {{ $ipp['project_name'] ?? $ipp['company_name'] ?? ('IPP #' . $ipp['id']) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <div class="text-center py-3" style="color: #94a3b8;">
                        <i class="fas fa-unlink d-block mb-1"></i>
                        <small>No IPPs currently use this technology.</small>
                    </div>
                    @endif
                </div>
                <div style="padding: 0 1.5rem 1.25rem; display: flex; gap: 0.75rem; justify-content: flex-end;">
                    <button wire:click="closeDetail" class="btn btn-light" style="border-radius: 8px;">Close</button>
                    <button wire:click="startEdit({{ $detailTechnology->id }})" class="btn-zesco-green">
                        <i class="fas fa-pen mr-1"></i> Edit Technology
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ===== DELETE CONFIRMATION ===== --}}
    @if($deleteId)
    <div class="modal fade show tc-modal" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 420px;">
            <div class="modal-content">
                <div style="padding: 2rem; text-align: center;">
                    <div style="width: 56px; height: 56px; border-radius: 50%; background: #fef2f2; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                        <i class="fas fa-exclamation-triangle" style="font-size: 1.5rem; color: #dc2626;"></i>
                    </div>
                    <h5 style="font-weight: 700; margin-bottom: 0.5rem;">Delete Technology?</h5>
                    <p style="color: #6b7280; font-size: 0.9rem;">
                        Are you sure you want to delete <strong class="text-danger">{{ $deleteName }}</strong>?
                        This may affect IPPs using this technology type.
                    </p>
                    @php
                        $affectedCount = \App\Models\IndependentProducer::where('technology', $deleteName)->count();
                    @endphp
                    @if($affectedCount > 0)
                    <div style="padding: 0.65rem; background: #fffbeb; border: 1px solid #fde68a; border-radius: 8px; margin-bottom: 0.5rem;">
                        <small style="color: #92400e;">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            <strong>{{ $affectedCount }}</strong> IPP(s) currently reference this technology.
                        </small>
                    </div>
                    @endif
                    <div class="d-flex justify-content-center" style="gap: 0.75rem; margin-top: 1.5rem;">
                        <button wire:click="cancelDelete" class="btn btn-light px-4" style="border-radius: 8px;">Cancel</button>
                        <button wire:click="deleteTechnology" class="btn btn-danger px-4" style="border-radius: 8px; font-weight: 600;">
                            <i class="fas fa-trash-alt mr-1"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
