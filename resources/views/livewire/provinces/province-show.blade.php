
<div>
    <!-- Page Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="z-page-header">
                <div class="d-flex align-items-center justify-content-between flex-wrap" style="gap: 1rem;">
                    <div>
                        <h1>
                            <i class="fas fa-map-marked-alt mr-2" style="color: var(--z-gold)"></i>
                            {{ $province->province }} Province
                        </h1>
                        <p>Manage districts and substations for {{ $province->province }}</p>
                    </div>
                    <a href="{{ route('province.index') }}" class="btn btn-outline-light" style="border-radius: 8px; font-size: 0.85rem; font-weight: 600;">
                        <i class="fas fa-arrow-left mr-1"></i> Back to Provinces
                    </a>
                </div>
            </div>

            {{-- Stats row --}}
            <div class="row mb-3" style="gap-y: 0.75rem;">
                <div class="col-md-4 col-sm-6 mb-2">
                    <div class="z-stat-card">
                        <div class="stat-value">{{ $province->districts->count() }}</div>
                        <div class="stat-label"><i class="fas fa-city mr-1"></i> Districts</div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-2">
                    <div class="z-stat-card z-stat-blue">
                        @php $totalSubs = $province->districts->sum(fn($d) => $d->connectionPoint->count()); @endphp
                        <div class="stat-value">{{ $totalSubs }}</div>
                        <div class="stat-label"><i class="fas fa-bolt mr-1"></i> Substations</div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 mb-2">
                    <div class="z-stat-card z-stat-gold">
                        <div class="stat-value">{{ $ippCount }}</div>
                        <div class="stat-label"><i class="fas fa-industry mr-1"></i> IPPs</div>
                    </div>
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

            <div class="row">
                {{-- ===== LEFT SIDEBAR — Districts ===== --}}
                <div class="col-lg-3 col-md-4 mb-3">
                    <div class="card z-card z-sidebar" style="position: relative;">
                        <div wire:loading.flex wire:target="selectDistrict,createDistrict,saveEditDistrict,deleteDistrict" class="z-loading">
                            <div class="spinner-border spinner-border-sm text-success"><span class="sr-only">Loading...</span></div>
                        </div>

                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h3 style="font-size: 0.88rem;">
                                <i class="fas fa-city mr-1" style="color: var(--z-green);"></i> Districts
                            </h3>
                            <button wire:click="openDistrictModal" class="btn-zesco" style="padding: 0.3rem 0.65rem; font-size: 0.75rem;">
                                <i class="fas fa-plus"></i> Add
                            </button>
                        </div>

                        <div class="card-body p-0">
                            <ul class="z-sidebar-list">
                                @forelse($province->districts as $dist)
                                    @if($editDistrictId === $dist->id)
                                        <li class="z-sidebar-edit">
                                            <input type="text" wire:model.defer="editDistrictName"
                                                   wire:keydown.enter="saveEditDistrict"
                                                   wire:keydown.escape="cancelEditDistrict">
                                            <div class="z-sidebar-actions">
                                                <button wire:click="saveEditDistrict" class="z-sidebar-btn z-sbtn-save" title="Save">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                <button wire:click="cancelEditDistrict" class="z-sidebar-btn z-sbtn-cancel" title="Cancel">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </li>
                                    @else
                                        <li class="z-sidebar-item {{ $selectedDistrictId == $dist->id ? 'active' : '' }}"
                                            wire:click="selectDistrict({{ $dist->id }})">
                                            <span style="flex: 1; margin-right: 0.5rem;">
                                                <i class="fas fa-map-pin mr-1" style="font-size: 0.7rem; opacity: 0.5;"></i>
                                                {{ $dist->district }}
                                            </span>
                                            <span class="z-info-count mr-1">{{ $dist->connectionPoint->count() }}</span>
                                            <div class="z-sidebar-actions" onclick="event.stopPropagation()">
                                                <button wire:click.stop="startEditDistrict({{ $dist->id }})" class="z-sidebar-btn z-sbtn-edit" title="Edit">
                                                    <i class="fas fa-pen"></i>
                                                </button>
                                                <button wire:click.stop="confirmDeleteDistrict({{ $dist->id }})" class="z-sidebar-btn z-sbtn-del" title="Delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </li>
                                    @endif
                                @empty
                                    <li class="text-center py-4" style="color: #94a3b8; font-size: 0.85rem;">
                                        <i class="fas fa-city d-block mb-2" style="font-size: 1.5rem;"></i>
                                        No districts yet. Add one to get started.
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- ===== RIGHT PANEL — Substations ===== --}}
                <div class="col-lg-9 col-md-8">
                    <div class="card z-card">
                        @if($selectedDistrictId && $selectedDistrict)
                            <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="gap: 0.5rem;">
                                <h3>
                                    <i class="fas fa-bolt mr-2" style="color: var(--z-gold);"></i>
                                    Substations in <span style="color: var(--z-green);">{{ $selectedDistrict->district }}</span>
                                    <span style="background: var(--z-green); color: #fff; font-size: 0.72rem; font-weight: 700;
                                                  padding: 0.15rem 0.55rem; border-radius: 20px; margin-left: 0.5rem;">
                                        {{ $connectionPoints->count() }}
                                    </span>
                                </h3>
                                <button wire:click="openSubstationModal" class="btn-zesco">
                                    <i class="fas fa-plus"></i> Add Substation
                                </button>
                            </div>

                            <div class="card-body p-0">
                                @if($connectionPoints->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover z-table mb-0">
                                            <thead>
                                                <tr>
                                                    <th style="width: 40px;">#</th>
                                                    <th>Substation</th>
                                                    <th>Voltage Level</th>
                                                    <th>Coordinates</th>
                                                    <th>Layout</th>
                                                    <th>Installed Cap.</th>
                                                    <th>Substation Cap.</th>
                                                    <th style="width: 100px;">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($connectionPoints as $idx => $cp)
                                                    @if($editSubId === $cp->id)
                                                        <tr style="background: #f0fdf4;">
                                                            <td style="color: #94a3b8; font-size: 0.82rem;">{{ $idx + 1 }}</td>
                                                            <td class="z-edit-cell">
                                                                <input type="text" wire:model.defer="editSubstation" placeholder="Substation name">
                                                                @error('editSubstation') <small class="text-danger">{{ $message }}</small> @enderror
                                                            </td>
                                                            <td class="z-edit-cell"><input type="text" wire:model.defer="editVoltage" placeholder="e.g. 330kV"></td>
                                                            <td class="z-edit-cell"><input type="text" wire:model.defer="editCoordinates" placeholder="Coordinates"></td>
                                                            <td class="z-edit-cell"><input type="text" wire:model.defer="editLayout" placeholder="Layout"></td>
                                                            <td class="z-edit-cell"><input type="text" wire:model.defer="editInstalledCapacity" placeholder="MW"></td>
                                                            <td class="z-edit-cell"><input type="text" wire:model.defer="editSubstationCapacity" placeholder="MW"></td>
                                                            <td>
                                                                <div class="d-flex" style="gap: 3px;">
                                                                    <button wire:click="saveEditSubstation" class="z-action z-action-save" title="Save">
                                                                        <span wire:loading wire:target="saveEditSubstation" class="spinner-border spinner-border-sm" role="status"></span>
                                                                        <i wire:loading.remove wire:target="saveEditSubstation" class="fas fa-check"></i>
                                                                    </button>
                                                                    <button wire:click="cancelEditSubstation" class="z-action z-action-cancel" title="Cancel">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <td style="color: #94a3b8; font-size: 0.82rem;">{{ $idx + 1 }}</td>
                                                            <td>
                                                                <span style="font-weight: 600; color: #1a2332;">{{ $cp->substation ?? '—' }}</span>
                                                            </td>
                                                            <td>
                                                                @if($cp->voltage_level)
                                                                    <span style="background: #eff6ff; color: #1d4ed8; padding: 0.2rem 0.55rem;
                                                                                  border-radius: 6px; font-size: 0.8rem; font-weight: 600;">
                                                                        {{ $cp->voltage_level }}
                                                                    </span>
                                                                @else
                                                                    <span style="color: #94a3b8;">—</span>
                                                                @endif
                                                            </td>
                                                            <td style="font-size: 0.82rem; color: #6b7280;">{{ $cp->coordinates ?? '—' }}</td>
                                                            <td style="font-size: 0.82rem; color: #6b7280;">{{ $cp->layout ?? '—' }}</td>
                                                            <td style="font-size: 0.82rem; color: #6b7280;">{{ $cp->installed_capacity ?? '—' }}</td>
                                                            <td style="font-size: 0.82rem; color: #6b7280;">{{ $cp->substation_capacity ?? '—' }}</td>
                                                            <td>
                                                                <div class="d-flex" style="gap: 3px;">
                                                                    <button wire:click="startEditSubstation({{ $cp->id }})" class="z-action z-action-edit" title="Edit">
                                                                        <span wire:loading wire:target="startEditSubstation({{ $cp->id }})" class="spinner-border spinner-border-sm" role="status"></span>
                                                                        <i wire:loading.remove wire:target="startEditSubstation({{ $cp->id }})" class="fas fa-pen"></i>
                                                                    </button>
                                                                    <button wire:click="confirmDeleteSubstation({{ $cp->id }})" class="z-action z-action-delete" title="Delete">
                                                                        <span wire:loading wire:target="confirmDeleteSubstation({{ $cp->id }})" class="spinner-border spinner-border-sm" role="status"></span>
                                                                        <i wire:loading.remove wire:target="confirmDeleteSubstation({{ $cp->id }})" class="fas fa-trash-alt"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="z-empty-state">
                                        <i class="fas fa-bolt d-block"></i>
                                        <p class="mb-1" style="font-weight: 600;">No substations yet</p>
                                        <p style="font-size: 0.82rem;">Click "Add Substation" to add a connection point for {{ $selectedDistrict->district }}.</p>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="z-empty-state" style="padding: 4rem;">
                                <i class="fas fa-hand-pointer d-block" style="font-size: 2.5rem;"></i>
                                <p class="mt-2" style="font-weight: 600; font-size: 1rem;">Select a District</p>
                                <p style="font-size: 0.85rem;">Choose a district from the left panel to view and manage its substations.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== ADD DISTRICT MODAL ===== --}}
    @if($showDistrictModal)
    <div class="modal fade show z-modal" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 460px;">
            <div class="modal-content">
                <div class="modal-header-zesco d-flex align-items-center justify-content-between">
                    <h5><i class="fas fa-plus-circle mr-2"></i> Add District</h5>
                    <button type="button" class="close" wire:click="$set('showDistrictModal', false)" style="color: #fff; opacity: 0.7;">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 1.5rem;">
                    <label style="font-size: 0.825rem; font-weight: 600; color: #1a2332; margin-bottom: 0.4rem; display: block;">
                        District Name <span class="text-danger">*</span>
                    </label>
                    <input type="text" wire:model.defer="districtName" class="form-control z-input"
                           placeholder="e.g. Kafue, Chongwe..."
                           wire:keydown.enter="createDistrict">
                    @error('districtName')
                        <small class="text-danger mt-1 d-block">{{ $message }}</small>
                    @enderror
                </div>
                <div style="padding: 0 1.5rem 1.25rem; display: flex; gap: 0.75rem; justify-content: flex-end;">
                    <button wire:click="$set('showDistrictModal', false)" class="btn btn-light" style="border-radius: 8px;">Cancel</button>
                    <button wire:click="createDistrict" class="btn-zesco-green" wire:loading.attr="disabled">
                        <i class="fas fa-check-circle mr-1"></i> Add District
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ===== ADD SUBSTATION MODAL ===== --}}
    @if($showSubstationModal)
    <div class="modal fade show z-modal" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 580px;">
            <div class="modal-content">
                <div class="modal-header-zesco d-flex align-items-center justify-content-between">
                    <h5><i class="fas fa-bolt mr-2"></i> Add Substation</h5>
                    <button type="button" class="close" wire:click="$set('showSubstationModal', false)" style="color: #fff; opacity: 0.7;">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 1.5rem;">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label style="font-size: 0.825rem; font-weight: 600; color: #1a2332; margin-bottom: 0.4rem; display: block;">
                                Substation Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" wire:model.defer="substation" class="form-control z-input" placeholder="Substation name">
                            @error('substation') <small class="text-danger mt-1 d-block">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label style="font-size: 0.825rem; font-weight: 600; color: #1a2332; margin-bottom: 0.4rem; display: block;">
                                Voltage Level
                            </label>
                            <input type="text" wire:model.defer="voltage_level" class="form-control z-input" placeholder="e.g. 330kV">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label style="font-size: 0.825rem; font-weight: 600; color: #1a2332; margin-bottom: 0.4rem; display: block;">
                                Coordinates
                            </label>
                            <input type="text" wire:model.defer="coordinates" class="form-control z-input" placeholder="Lat, Lng">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label style="font-size: 0.825rem; font-weight: 600; color: #1a2332; margin-bottom: 0.4rem; display: block;">
                                Layout
                            </label>
                            <input type="text" wire:model.defer="layout" class="form-control z-input" placeholder="Layout info">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label style="font-size: 0.825rem; font-weight: 600; color: #1a2332; margin-bottom: 0.4rem; display: block;">
                                Installed Capacity
                            </label>
                            <input type="text" wire:model.defer="installed_capacity" class="form-control z-input" placeholder="MW">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label style="font-size: 0.825rem; font-weight: 600; color: #1a2332; margin-bottom: 0.4rem; display: block;">
                                Substation Capacity
                            </label>
                            <input type="text" wire:model.defer="substation_capacity" class="form-control z-input" placeholder="MW">
                        </div>
                    </div>
                </div>
                <div style="padding: 0 1.5rem 1.25rem; display: flex; gap: 0.75rem; justify-content: flex-end;">
                    <button wire:click="$set('showSubstationModal', false)" class="btn btn-light" style="border-radius: 8px;">Cancel</button>
                    <button wire:click="createSubstation" class="btn-zesco-green" wire:loading.attr="disabled">
                        <i class="fas fa-check-circle mr-1"></i> Add Substation
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ===== DELETE DISTRICT CONFIRMATION ===== --}}
    @if($deleteDistrictId)
    <div class="modal fade show z-modal" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 420px;">
            <div class="modal-content">
                <div style="padding: 2rem; text-align: center;">
                    <div style="width: 56px; height: 56px; border-radius: 50%; background: #fef2f2; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                        <i class="fas fa-exclamation-triangle" style="font-size: 1.5rem; color: #dc2626;"></i>
                    </div>
                    <h5 style="font-weight: 700; margin-bottom: 0.5rem;">Delete District?</h5>
                    <p style="color: #6b7280; font-size: 0.9rem;">
                        Are you sure you want to delete <strong class="text-danger">{{ $deleteDistrictName }}</strong>?
                        All substations in this district will also be removed.
                    </p>
                    <div class="d-flex justify-content-center" style="gap: 0.75rem; margin-top: 1.5rem;">
                        <button wire:click="cancelDeleteDistrict" class="btn btn-light px-4" style="border-radius: 8px;">Cancel</button>
                        <button wire:click="deleteDistrict" class="btn btn-danger px-4" style="border-radius: 8px; font-weight: 600;">
                            <i class="fas fa-trash-alt mr-1"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ===== DELETE SUBSTATION CONFIRMATION ===== --}}
    @if($deleteSubId)
    <div class="modal fade show z-modal" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 420px;">
            <div class="modal-content">
                <div style="padding: 2rem; text-align: center;">
                    <div style="width: 56px; height: 56px; border-radius: 50%; background: #fef2f2; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                        <i class="fas fa-exclamation-triangle" style="font-size: 1.5rem; color: #dc2626;"></i>
                    </div>
                    <h5 style="font-weight: 700; margin-bottom: 0.5rem;">Delete Substation?</h5>
                    <p style="color: #6b7280; font-size: 0.9rem;">
                        Are you sure you want to delete <strong class="text-danger">{{ $deleteSubName }}</strong>?
                        This action cannot be undone.
                    </p>
                    <div class="d-flex justify-content-center" style="gap: 0.75rem; margin-top: 1.5rem;">
                        <button wire:click="cancelDeleteSubstation" class="btn btn-light px-4" style="border-radius: 8px;">Cancel</button>
                        <button wire:click="deleteSubstation" class="btn btn-danger px-4" style="border-radius: 8px; font-weight: 600;">
                            <i class="fas fa-trash-alt mr-1"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>