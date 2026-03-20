
<div>
    <!-- Page Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="z-page-header">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div>
                        <h1><i class="fas fa-bolt mr-2" style="color: var(--z-gold)"></i>Connection Points (Substations)</h1>
                        <p>Manage substations, voltage levels and capacity data across the power grid</p>
                    </div>
                    <button wire:click="openCreateModal" class="btn-zesco">
                        <i class="fas fa-plus"></i> Add Connection Point
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <section class="content">
        <div class="container-fluid">

            @if(session()->has('message'))
                <div class="alert alert-success" style="border-radius: 10px; font-size: 0.9rem;">
                    <i class="fas fa-check-circle mr-1"></i> {{ session('message') }}
                </div>
            @endif

            <div class="card z-card">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="gap: 0.75rem;">
                    <h3>
                        <i class="fas fa-bolt mr-2" style="color: var(--z-green)"></i>All Connection Points
                        <span class="z-count ml-2">{{ $connectionPoints->total() }}</span>
                    </h3>
                    <div class="d-flex align-items-center flex-wrap" style="gap: 0.6rem;">
                        <select wire:model="filterProvince" class="z-filter-select">
                            <option value="">All Provinces</option>
                            @foreach($provinces as $prov)
                                <option value="{{ $prov->id }}">{{ $prov->province }}</option>
                            @endforeach
                        </select>
                        <select wire:model="filterDistrict" class="z-filter-select">
                            <option value="">All Districts</option>
                            @foreach($this->filteredDistricts as $dist)
                                <option value="{{ $dist->id }}">{{ $dist->district }}</option>
                            @endforeach
                        </select>
                        <div class="z-search">
                            <i class="fas fa-search si"></i>
                            <input type="text" wire:model.debounce.300ms="search" placeholder="Search substation...">
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
                                    <th style="width: 50px;" wire:click="sortBy('id')">
                                        #
                                        @if($sortField === 'id')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} sort-icon active"></i>
                                        @else
                                            <i class="fas fa-sort sort-icon"></i>
                                        @endif
                                    </th>
                                    <th wire:click="sortBy('substation')">
                                        Substation
                                        @if($sortField === 'substation')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} sort-icon active"></i>
                                        @else
                                            <i class="fas fa-sort sort-icon"></i>
                                        @endif
                                    </th>
                                    <th>District</th>
                                    <th>Province</th>
                                    <th wire:click="sortBy('voltage_level')">
                                        Voltage
                                        @if($sortField === 'voltage_level')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} sort-icon active"></i>
                                        @else
                                            <i class="fas fa-sort sort-icon"></i>
                                        @endif
                                    </th>
                                    <th>Firm Cap.</th>
                                    <th>Installed Cap.</th>
                                    <th style="width: 120px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($connectionPoints as $item)
                                    <tr>
                                        <td style="color: #94a3b8; font-size: 0.8rem;">{{ $item->id }}</td>
                                        <td>
                                            @if($editId === $item->id)
                                                <input type="text" wire:model.defer="editSubstation"
                                                       class="form-control z-edit-input"
                                                       wire:keydown.enter="saveEdit"
                                                       wire:keydown.escape="cancelEdit">
                                                @error('editSubstation')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            @else
                                                <span class="z-badge">
                                                    <i class="fas fa-plug" style="font-size: 0.65rem; color: var(--z-green);"></i>
                                                    {{ $item->substation }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($editId === $item->id)
                                                <select wire:model.defer="editDistrictId" class="z-edit-select">
                                                    @foreach(\App\Models\Districts::orderBy('district')->get() as $dist)
                                                        <option value="{{ $dist->id }}">{{ $dist->district }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <span class="z-badge-blue">
                                                    <i class="fas fa-building" style="font-size: 0.6rem;"></i>
                                                    {{ $item->districts->district ?? 'N/A' }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="z-badge">
                                                <i class="fas fa-map-marker-alt" style="font-size: 0.6rem;"></i>
                                                {{ $item->districts->province->province ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($editId === $item->id)
                                                <input type="text" wire:model.defer="editVoltageLevel" class="form-control z-edit-input" style="max-width:100px;">
                                            @else
                                                @if($item->voltage_level)
                                                    <span class="z-badge-purple">
                                                        <i class="fas fa-bolt" style="font-size: 0.6rem;"></i>
                                                        {{ $item->voltage_level }}
                                                    </span>
                                                @else
                                                    <span style="color: #94a3b8; font-size: 0.82rem;">-</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td style="font-size: 0.82rem; color: #374151;">
                                            @if($editId === $item->id)
                                                <input type="text" wire:model.defer="editFirmCapacity" class="form-control z-edit-input" style="max-width:100px;">
                                            @else
                                                {{ $item->firm_capacity ?? '-' }}
                                            @endif
                                        </td>
                                        <td style="font-size: 0.82rem; color: #374151;">
                                            @if($editId === $item->id)
                                                <input type="text" wire:model.defer="editInstalledCapacity" class="form-control z-edit-input" style="max-width:100px;">
                                            @else
                                                {{ $item->installed_capacity ?? '-' }}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex" style="gap: 3px;">
                                                @if($editId === $item->id)
                                                    <button wire:click="saveEdit" class="z-action z-action-save" title="Save">
                                                        <span wire:loading wire:target="saveEdit" class="spinner-border spinner-border-sm" role="status"></span>
                                                        <i wire:loading.remove wire:target="saveEdit" class="fas fa-check"></i>
                                                    </button>
                                                    <button wire:click="cancelEdit" class="z-action z-action-cancel" title="Cancel">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                @else
                                                    <button wire:click="showDetails({{ $item->id }})" class="z-action z-action-view" title="View Details">
                                                        <span wire:loading wire:target="showDetails({{ $item->id }})" class="spinner-border spinner-border-sm" role="status"></span>
                                                        <i wire:loading.remove wire:target="showDetails({{ $item->id }})" class="fas fa-eye"></i>
                                                    </button>
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
                                        <td colspan="8" class="text-center py-4" style="color: #94a3b8;">
                                            <i class="fas fa-plug fa-2x mb-2 d-block"></i>
                                            @if(!empty($search) || !empty($filterProvince) || !empty($filterDistrict))
                                                No connection points found matching your criteria.
                                                <a href="#" wire:click.prevent="$set('search', '');$set('filterProvince', '');$set('filterDistrict', '')" style="color: var(--z-green);">Clear filters</a>
                                            @else
                                                No connection points created yet.
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
                        Showing {{ $connectionPoints->firstItem() ?? 0 }} - {{ $connectionPoints->lastItem() ?? 0 }} of {{ $connectionPoints->total() }}
                    </span>
                    {{ $connectionPoints->links() }}
                </div>
            </div>
        </div>
    </section>

    {{-- ===== CREATE MODAL ===== --}}
    @if($showCreateModal)
    <div class="modal fade show z-modal" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header-zesco d-flex align-items-center justify-content-between">
                    <h5><i class="fas fa-plus-circle mr-2"></i> Add New Connection Point</h5>
                    <button type="button" class="close" wire:click="$set('showCreateModal', false)" style="color: #fff; opacity: 0.7;">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 1.5rem;">
                    <div class="row">
                        {{-- Province → District Cascade --}}
                        <div class="col-md-6 mb-3">
                            <label style="font-size: 0.825rem; font-weight: 600; color: #1a2332; margin-bottom: 0.4rem; display: block;">
                                Province <span class="text-danger">*</span>
                            </label>
                            <select wire:model="newProvinceId" class="form-control z-input">
                                <option value="">-- Select Province --</option>
                                @foreach($provinces as $prov)
                                    <option value="{{ $prov->id }}">{{ $prov->province }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label style="font-size: 0.825rem; font-weight: 600; color: #1a2332; margin-bottom: 0.4rem; display: block;">
                                District <span class="text-danger">*</span>
                            </label>
                            <select wire:model.defer="newDistrictId" class="form-control z-input" {{ !$newProvinceId ? 'disabled' : '' }}>
                                <option value="">-- Select District --</option>
                                @foreach($this->createDistricts as $dist)
                                    <option value="{{ $dist->id }}">{{ $dist->district }}</option>
                                @endforeach
                            </select>
                            @error('newDistrictId')
                                <small class="text-danger mt-1 d-block">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label style="font-size: 0.825rem; font-weight: 600; color: #1a2332; margin-bottom: 0.4rem; display: block;">
                                Substation Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" wire:model.defer="newSubstation" class="form-control z-input"
                                   placeholder="e.g. KITWE MAIN">
                            @error('newSubstation')
                                <small class="text-danger mt-1 d-block">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label style="font-size: 0.825rem; font-weight: 600; color: #1a2332; margin-bottom: 0.4rem; display: block;">
                                Voltage Level
                            </label>
                            <input type="text" wire:model.defer="newVoltageLevel" class="form-control z-input"
                                   placeholder="e.g. 330kV, 132kV">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label style="font-size: 0.825rem; font-weight: 600; color: #1a2332; margin-bottom: 0.4rem; display: block;">
                                Firm Capacity
                            </label>
                            <input type="text" wire:model.defer="newFirmCapacity" class="form-control z-input"
                                   placeholder="e.g. 120 MW">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label style="font-size: 0.825rem; font-weight: 600; color: #1a2332; margin-bottom: 0.4rem; display: block;">
                                Installed Capacity
                            </label>
                            <input type="text" wire:model.defer="newInstalledCapacity" class="form-control z-input"
                                   placeholder="e.g. 150 MW">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label style="font-size: 0.825rem; font-weight: 600; color: #1a2332; margin-bottom: 0.4rem; display: block;">
                                Substation Capacity
                            </label>
                            <input type="text" wire:model.defer="newSubstationCapacity" class="form-control z-input"
                                   placeholder="e.g. 200 MVA">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label style="font-size: 0.825rem; font-weight: 600; color: #1a2332; margin-bottom: 0.4rem; display: block;">
                                Layout
                            </label>
                            <input type="text" wire:model.defer="newLayout" class="form-control z-input"
                                   placeholder="Layout type">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label style="font-size: 0.825rem; font-weight: 600; color: #1a2332; margin-bottom: 0.4rem; display: block;">
                                Coordinates
                            </label>
                            <input type="text" wire:model.defer="newCoordinates" class="form-control z-input"
                                   placeholder="e.g. -12.804, 28.214">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label style="font-size: 0.825rem; font-weight: 600; color: #1a2332; margin-bottom: 0.4rem; display: block;">
                                Status
                            </label>
                            <select wire:model.defer="newStatusId" class="form-control z-input">
                                <option value="">-- Select --</option>
                                @foreach($statuses as $st)
                                    <option value="{{ $st->id }}">{{ $st->status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div style="padding: 0 1.5rem 1.25rem; display: flex; gap: 0.75rem; justify-content: flex-end;">
                    <button wire:click="$set('showCreateModal', false)" class="btn btn-light" style="border-radius: 8px;">Cancel</button>
                    <button wire:click="createConnectionPoint" class="btn-zesco-green" wire:loading.attr="disabled">
                        <i class="fas fa-check-circle mr-1"></i> Create Connection Point
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ===== DETAIL MODAL ===== --}}
    @if($showDetailModal && $detailPoint)
    <div class="modal fade show z-modal" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header-zesco d-flex align-items-center justify-content-between">
                    <h5><i class="fas fa-bolt mr-2"></i> {{ $detailPoint->substation }}</h5>
                    <button type="button" class="close" wire:click="closeDetail" style="color: #fff; opacity: 0.7;">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 1.5rem;">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="z-detail-label">Substation</div>
                            <div class="z-detail-value">{{ $detailPoint->substation }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="z-detail-label">District</div>
                            <div class="z-detail-value">
                                <i class="fas fa-building mr-1" style="color: var(--z-green); font-size: 0.82rem;"></i>
                                {{ $detailPoint->districts->district ?? 'N/A' }}
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="z-detail-label">Province</div>
                            <div class="z-detail-value">
                                <i class="fas fa-map-marker-alt mr-1" style="color: var(--z-green); font-size: 0.82rem;"></i>
                                {{ $detailPoint->districts->province->province ?? 'N/A' }}
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="z-detail-label">Voltage Level</div>
                            <div class="z-detail-value">
                                @if($detailPoint->voltage_level)
                                    <span class="z-badge-purple">
                                        <i class="fas fa-bolt"></i> {{ $detailPoint->voltage_level }}
                                    </span>
                                @else
                                    <span style="color: #94a3b8;">Not set</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="z-detail-label">Layout</div>
                            <div class="z-detail-value">{{ $detailPoint->layout ?? '-' }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="z-detail-label">Coordinates</div>
                            <div class="z-detail-value">{{ $detailPoint->coordinates ?? '-' }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="z-detail-label">Firm Capacity</div>
                            <div class="z-detail-value" style="font-size: 1rem;">{{ $detailPoint->firm_capacity ?? '-' }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="z-detail-label">Installed Capacity</div>
                            <div class="z-detail-value" style="font-size: 1rem;">{{ $detailPoint->installed_capacity ?? '-' }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="z-detail-label">Substation Capacity</div>
                            <div class="z-detail-value" style="font-size: 1rem;">{{ $detailPoint->substation_capacity ?? '-' }}</div>
                        </div>
                    </div>
                </div>
                <div style="padding: 0 1.5rem 1.25rem; display: flex; gap: 0.75rem; justify-content: flex-end;">
                    <button wire:click="closeDetail" class="btn btn-light" style="border-radius: 8px;">Close</button>
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
                    <h5 style="font-weight: 700; margin-bottom: 0.5rem;">Delete Connection Point?</h5>
                    <p style="color: #6b7280; font-size: 0.9rem;">
                        Are you sure you want to delete <strong class="text-danger">{{ $deleteName }}</strong>?
                        This action cannot be undone.
                    </p>
                    <div class="d-flex justify-content-center" style="gap: 0.75rem; margin-top: 1.5rem;">
                        <button wire:click="cancelDelete" class="btn btn-light px-4" style="border-radius: 8px;">Cancel</button>
                        <button wire:click="deleteConnectionPoint" class="btn btn-danger px-4" style="border-radius: 8px; font-weight: 600;">
                            <i class="fas fa-trash-alt mr-1"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>