
<div>
    <!-- Page Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="z-page-header">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div>
                        <h1><i class="fas fa-city mr-2" style="color: var(--z-gold)"></i>District Management</h1>
                        <p>Manage districts and their connection point substations across all provinces</p>
                    </div>
                    <button wire:click="openCreateModal" class="btn-zesco">
                        <i class="fas fa-plus"></i> Add District
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

            <div class="card z-card" style="position: relative;">
                <div wire:loading.flex class="z-loading">
                    <div class="spinner-border text-success"><span class="sr-only">Loading...</span></div>
                </div>

                <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="gap: 0.75rem;">
                    <h3>
                        <i class="fas fa-city mr-2" style="color: var(--z-green)"></i>All Districts
                        <span class="z-count ml-2">{{ $districts->total() }}</span>
                    </h3>
                    <div class="d-flex align-items-center flex-wrap" style="gap: 0.75rem;">
                        <select wire:model="filterProvince" class="z-filter-select">
                            <option value="">All Provinces</option>
                            @foreach($provinces as $prov)
                                <option value="{{ $prov->id }}">{{ $prov->province }}</option>
                            @endforeach
                        </select>
                        <div class="z-search">
                            <i class="fas fa-search si"></i>
                            <input type="text" wire:model.debounce.300ms="search" placeholder="Search districts...">
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
                                    <th wire:click="sortBy('district')">
                                        District
                                        @if($sortField === 'district')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} sort-icon active"></i>
                                        @else
                                            <i class="fas fa-sort sort-icon"></i>
                                        @endif
                                    </th>
                                    <th>Province</th>
                                    <th style="width: 130px;">Substations</th>
                                    <th style="width: 160px;">Created</th>
                                    <th style="width: 150px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($districts as $item)
                                    <tr>
                                        <td style="color: #94a3b8; font-size: 0.82rem;">{{ $item->id }}</td>
                                        <td>
                                            @if($editId === $item->id)
                                                <div class="d-flex align-items-center flex-wrap" style="gap: 0.5rem;">
                                                    <input type="text" wire:model.defer="editDistrict"
                                                           class="form-control z-edit-input"
                                                           wire:keydown.enter="saveEdit"
                                                           wire:keydown.escape="cancelEdit">
                                                    @error('editDistrict')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            @else
                                                <span class="z-badge">
                                                    <i class="fas fa-building" style="font-size: 0.7rem; color: var(--z-green);"></i>
                                                    {{ $item->district }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($editId === $item->id)
                                                <select wire:model.defer="editProvinceId" class="z-edit-select">
                                                    <option value="">-- Province --</option>
                                                    @foreach($provinces as $prov)
                                                        <option value="{{ $prov->id }}">{{ $prov->province }}</option>
                                                    @endforeach
                                                </select>
                                                @error('editProvinceId')
                                                    <small class="text-danger d-block">{{ $message }}</small>
                                                @enderror
                                            @else
                                                <span class="z-badge-blue">
                                                    <i class="fas fa-map-marker-alt" style="font-size: 0.65rem;"></i>
                                                    {{ $item->province->province ?? 'N/A' }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="z-info-count">{{ $item->connection_point_count }} substations</span>
                                        </td>
                                        <td style="font-size: 0.82rem; color: #6b7280;">
                                            {{ $item->created_at ? $item->created_at->format('M d, Y') : 'N/A' }}
                                        </td>
                                        <td>
                                            <div class="d-flex" style="gap: 4px;">
                                                @if($editId === $item->id)
                                                    <button wire:click="saveEdit" class="z-action z-action-save" title="Save">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                    <button wire:click="cancelEdit" class="z-action z-action-cancel" title="Cancel">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                @else
                                                    <button wire:click="showDetails({{ $item->id }})" class="z-action z-action-view" title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button wire:click="startEdit({{ $item->id }})" class="z-action z-action-edit" title="Edit">
                                                        <i class="fas fa-pen"></i>
                                                    </button>
                                                    <button wire:click="confirmDelete({{ $item->id }})" class="z-action z-action-delete" title="Delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4" style="color: #94a3b8;">
                                            <i class="fas fa-city fa-2x mb-2 d-block"></i>
                                            @if(!empty($search) || !empty($filterProvince))
                                                No districts found matching your criteria.
                                                <a href="#" wire:click.prevent="$set('search', '');$set('filterProvince', '')" style="color: var(--z-green);">Clear filters</a>
                                            @else
                                                No districts created yet.
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
                        Showing {{ $districts->firstItem() ?? 0 }} - {{ $districts->lastItem() ?? 0 }} of {{ $districts->total() }}
                    </span>
                    {{ $districts->links() }}
                </div>
            </div>
        </div>
    </section>

    {{-- ===== CREATE MODAL ===== --}}
    @if($showCreateModal)
    <div class="modal fade show z-modal" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
            <div class="modal-content">
                <div class="modal-header-zesco d-flex align-items-center justify-content-between">
                    <h5><i class="fas fa-plus-circle mr-2"></i> Add New District</h5>
                    <button type="button" class="close" wire:click="$set('showCreateModal', false)" style="color: #fff; opacity: 0.7;">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 1.5rem;">
                    <div class="mb-3">
                        <label style="font-size: 0.825rem; font-weight: 600; color: #1a2332; margin-bottom: 0.4rem; display: block;">
                            Province <span class="text-danger">*</span>
                        </label>
                        <select wire:model.defer="newProvinceId" class="form-control z-input">
                            <option value="">-- Select Province --</option>
                            @foreach($provinces as $prov)
                                <option value="{{ $prov->id }}">{{ $prov->province }}</option>
                            @endforeach
                        </select>
                        @error('newProvinceId')
                            <small class="text-danger mt-1 d-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label style="font-size: 0.825rem; font-weight: 600; color: #1a2332; margin-bottom: 0.4rem; display: block;">
                            District Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" wire:model.defer="newDistrict" class="form-control z-input"
                               placeholder="e.g. Chingola, Kitwe..."
                               wire:keydown.enter="createDistrict">
                        @error('newDistrict')
                            <small class="text-danger mt-1 d-block">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div style="padding: 0 1.5rem 1.25rem; display: flex; gap: 0.75rem; justify-content: flex-end;">
                    <button wire:click="$set('showCreateModal', false)" class="btn btn-light" style="border-radius: 8px;">Cancel</button>
                    <button wire:click="createDistrict" class="btn-zesco-green" wire:loading.attr="disabled">
                        <i class="fas fa-check-circle mr-1"></i> Create District
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ===== DETAIL MODAL ===== --}}
    @if($showDetailModal && $detailDistrict)
    <div class="modal fade show z-modal" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header-zesco d-flex align-items-center justify-content-between">
                    <h5><i class="fas fa-city mr-2"></i> {{ $detailDistrict->district }}</h5>
                    <button type="button" class="close" wire:click="closeDetail" style="color: #fff; opacity: 0.7;">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 1.5rem;">
                    <div class="row mb-3">
                        <div class="col-md-4 mb-3">
                            <div class="z-detail-label">Province</div>
                            <div class="z-detail-value">
                                <i class="fas fa-map-marker-alt mr-1" style="color: var(--z-green);"></i>
                                {{ $detailDistrict->province->province ?? 'N/A' }}
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="z-detail-label">Substations</div>
                            <div class="z-detail-value">
                                <span class="z-info-count">{{ count($detailSubstations) }}</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="z-detail-label">IPPs</div>
                            <div class="z-detail-value">
                                <span style="font-size:0.72rem;font-weight:700;padding:0.15rem 0.5rem;border-radius:12px;background:#fffbeb;color:#92400e;border:1px solid #fde68a;">{{ $detailIppCount }}</span>
                            </div>
                        </div>
                    </div>

                    @if(count($detailSubstations) > 0)
                    <h6 style="font-weight: 700; font-size: 0.88rem; margin-bottom: 0.75rem; color: #1a2332;">
                        <i class="fas fa-bolt mr-1" style="color: var(--z-gold);"></i> Substations / Connection Points
                    </h6>
                    <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                        <table class="table z-mini-table mb-0">
                            <thead>
                                <tr>
                                    <th>Substation</th>
                                    <th>Voltage</th>
                                    <th>Firm Capacity</th>
                                    <th>Installed Cap.</th>
                                    <th>Substation Cap.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($detailSubstations as $sub)
                                    <tr>
                                        <td style="font-weight: 600;">{{ $sub['substation'] ?? 'N/A' }}</td>
                                        <td>{{ $sub['voltage_level'] ?? '-' }}</td>
                                        <td>{{ $sub['firm_capacity'] ?? '-' }}</td>
                                        <td>{{ $sub['installed_capacity'] ?? '-' }}</td>
                                        <td>{{ $sub['substation_capacity'] ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-3" style="color: #94a3b8;">
                        <i class="fas fa-plug fa-2x mb-2 d-block"></i>
                        No substations registered for this district.
                    </div>
                    @endif
                </div>
                <div style="padding: 0 1.5rem 1.25rem; display: flex; gap: 0.75rem; justify-content: flex-end;">
                    <button wire:click="closeDetail" class="btn btn-light" style="border-radius: 8px;">Close</button>
                    <a href="{{ route('province.show', [$detailDistrict->province_id, $detailDistrict->id]) }}" class="btn-zesco-green" style="text-decoration: none;">
                        <i class="fas fa-external-link-alt mr-1"></i> Open in Province View
                    </a>
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
                    <h5 style="font-weight: 700; margin-bottom: 0.5rem;">Delete District?</h5>
                    <p style="color: #6b7280; font-size: 0.9rem;">
                        Are you sure you want to delete <strong class="text-danger">{{ $deleteName }}</strong>?
                        This will also remove all its substations/connection points.
                    </p>
                    <div class="d-flex justify-content-center" style="gap: 0.75rem; margin-top: 1.5rem;">
                        <button wire:click="cancelDelete" class="btn btn-light px-4" style="border-radius: 8px;">Cancel</button>
                        <button wire:click="deleteDistrict" class="btn btn-danger px-4" style="border-radius: 8px; font-weight: 600;">
                            <i class="fas fa-trash-alt mr-1"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>