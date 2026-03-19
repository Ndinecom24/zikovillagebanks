<style>
:root { --z-green: #14984f; --z-green-dark: #0d7a3e; --z-gold: #FFB223; --z-gold-dark: #e09a00; }

.ip-page-header {
    background: linear-gradient(135deg, #0d7a3e 0%, #14984f 60%, #00895A 100%);
    border-radius: 12px; padding: 1.5rem 2rem; margin-bottom: 1.5rem;
    color: #fff; position: relative; overflow: hidden;
}
.ip-page-header::before {
    content: ''; position: absolute; top: -40%; right: -10%;
    width: 300px; height: 300px;
    background: radial-gradient(ellipse, rgba(255,255,255,0.07) 0%, transparent 70%);
}
.ip-page-header h1 { font-size: 1.35rem; font-weight: 700; margin: 0; }
.ip-page-header p  { margin: 0.25rem 0 0; opacity: 0.85; font-size: 0.875rem; }

.ip-card { border-radius: 12px; border: 1px solid #e9ecef; overflow: hidden; }
.ip-card .card-header { background: #fff; border-bottom: 1px solid #e9ecef; padding: 1rem 1.5rem; }
.ip-card .card-header h3 { font-size: 1rem; font-weight: 700; color: #1a2332; margin: 0; }

.ip-search { position: relative; }
.ip-search input {
    padding: 0.5rem 0.85rem 0.5rem 2.5rem; border-radius: 8px;
    border: 1.5px solid #e2e8f0; font-size: 0.85rem; width: 100%; transition: border-color 0.2s;
}
.ip-search input:focus { border-color: var(--z-green); box-shadow: 0 0 0 3px rgba(20,152,79,0.1); outline: none; }
.ip-search .si { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; pointer-events: none; }

.ip-table thead th {
    font-size: 0.72rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.03em;
    border-bottom: 2px solid #e2e8f0; cursor: pointer; user-select: none; white-space: nowrap;
}
.ip-table thead th:hover { color: var(--z-green); }
.ip-table tbody tr { transition: background 0.15s; }
.ip-table tbody tr:hover { background: #f0fdf4; }
.ip-table td { font-size: 0.82rem; vertical-align: middle; }
.sort-icon { font-size: 0.7rem; margin-left: 4px; opacity: 0.5; }
.sort-icon.active { opacity: 1; color: var(--z-green); }

.ip-action {
    display: inline-flex; align-items: center; justify-content: center;
    width: 30px; height: 30px; border-radius: 6px; border: none;
    transition: all 0.2s; cursor: pointer; font-size: 0.78rem;
}
.ip-action-view   { background: rgba(59,130,246,0.1); color: #3b82f6; }
.ip-action-view:hover { background: #3b82f6; color: #fff; }
.ip-action-delete { background: rgba(220,38,38,0.1); color: #dc2626; }
.ip-action-delete:hover { background: #dc2626; color: #fff; }

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

.ip-per-page, .ip-filter {
    border-radius: 6px; border: 1.5px solid #e2e8f0;
    padding: 0.35rem 0.5rem; font-size: 0.825rem; color: #374151;
}
.ip-per-page:focus, .ip-filter:focus { border-color: var(--z-green); outline: none; }

.ip-loading {
    position: absolute; inset: 0; background: rgba(255,255,255,0.7);
    display: flex; align-items: center; justify-content: center;
    z-index: 10; border-radius: 12px;
}

.ip-count {
    background: linear-gradient(135deg, var(--z-green), var(--z-green-dark));
    color: #fff; font-size: 0.72rem; font-weight: 700;
    padding: 0.2rem 0.6rem; border-radius: 20px;
}

.ip-status-badge {
    display: inline-block; padding: 0.2rem 0.6rem; border-radius: 20px;
    font-size: 0.72rem; font-weight: 600; white-space: nowrap;
}

.ip-modal .modal-content { border: none; border-radius: 16px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.15); }
.ip-modal .modal-header-green {
    background: linear-gradient(135deg, #004D2E 0%, #006B3F 60%, #00895A 100%);
    padding: 1.25rem 1.5rem; color: #fff; border: none;
}
.ip-modal .modal-header-green h5 { font-weight: 700; margin: 0; font-size: 1.05rem; }
.ip-modal .modal-header-green .close { color: #fff; opacity: 0.7; text-shadow: none; }

.ip-input {
    padding: 0.5rem 0.75rem; border-radius: 8px;
    border: 1.5px solid #e2e8f0; font-size: 0.85rem; transition: border-color 0.2s;
}
.ip-input:focus { border-color: var(--z-green); box-shadow: 0 0 0 3px rgba(20,152,79,0.1); outline: none; }

.ip-section-title {
    font-size: 0.8rem; font-weight: 700; color: var(--z-green); text-transform: uppercase;
    letter-spacing: 0.05em; border-bottom: 2px solid #e2e8f0; padding-bottom: 0.4rem; margin-bottom: 1rem;
}

.ip-stat-card {
    background: linear-gradient(135deg, #ecfdf5, #d1fae5);
    border-radius: 10px; padding: 1rem; border: 1px solid #a7f3d0; text-align: center;
}
.ip-stat-num { font-size: 1.5rem; font-weight: 800; color: var(--z-green); line-height: 1; }
.ip-stat-label { font-size: 0.72rem; color: #6b7280; font-weight: 600; margin-top: 0.2rem; }
</style>

<div>
    <!-- Page Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="ip-page-header">
                <div class="d-flex align-items-center justify-content-between flex-wrap" style="gap: 1rem;">
                    <div>
                        <h1><i class="fas fa-industry mr-2" style="color: var(--z-gold)"></i>Independent Power Producers</h1>
                        <p>Manage IPP registrations, applications and power agreements</p>
                    </div>
                    <div class="d-flex align-items-center" style="gap: 0.75rem;">
                        <button wire:click="openCreateModal" class="btn-zesco">
                            <i class="fas fa-plus"></i> Register New IPP
                        </button>
                    </div>
                </div>

                {{-- Summary Stats --}}
                <div class="row mt-3">
                    @php
                        $total = $producers->total();
                    @endphp
                    <div class="col-6 col-md-3">
                        <div style="background: rgba(255,255,255,0.12); border-radius: 8px; padding: 0.5rem 0.75rem;">
                            <div style="font-size: 1.15rem; font-weight: 800;">{{ $total }}</div>
                            <div style="font-size: 0.72rem; opacity: 0.8;">Total IPPs</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div style="background: rgba(255,255,255,0.12); border-radius: 8px; padding: 0.5rem 0.75rem;">
                            <div style="font-size: 1.15rem; font-weight: 800;">{{ \App\Models\IndependentProducer::sum('size_of_plant') ?? 0 }} MW</div>
                            <div style="font-size: 0.72rem; opacity: 0.8;">Total Capacity</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div style="background: rgba(255,255,255,0.12); border-radius: 8px; padding: 0.5rem 0.75rem;">
                            <div style="font-size: 1.15rem; font-weight: 800;">{{ count($provinces) }}</div>
                            <div style="font-size: 0.72rem; opacity: 0.8;">Provinces</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div style="background: rgba(255,255,255,0.12); border-radius: 8px; padding: 0.5rem 0.75rem;">
                            <div style="font-size: 1.15rem; font-weight: 800;">{{ count($technologies) }}</div>
                            <div style="font-size: 0.72rem; opacity: 0.8;">Technologies</div>
                        </div>
                    </div>
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

            {{-- Filters Row --}}
            <div class="card ip-card mb-3">
                <div class="card-body" style="padding: 0.75rem 1.25rem;">
                    <div class="row align-items-center" style="gap: 0.5rem 0;">
                        <div class="col-md-3">
                            <div class="ip-search">
                                <i class="fas fa-search si"></i>
                                <input type="text" wire:model.debounce.300ms="search" placeholder="Search IPPs...">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <select wire:model="filterStatus" class="form-control ip-filter">
                                <option value="">All Statuses</option>
                                @foreach($statuses as $s)
                                    <option value="{{ $s->status }}">{{ $s->status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select wire:model="filterProvince" class="form-control ip-filter">
                                <option value="">All Provinces</option>
                                @foreach($provinces as $p)
                                    <option value="{{ $p->id }}">{{ $p->province }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select wire:model="filterTechnology" class="form-control ip-filter">
                                <option value="">All Technologies</option>
                                <option value="SOLAR">Solar</option>
                                <option value="WIND">Wind</option>
                                <option value="GEOTHERMAL">Geothermal</option>
                                <option value="HYBRID">Hybrid</option>
                                <option value="HYDROGEN">Hydrogen</option>
                                <option value="BIOMASS">Biomass</option>
                                <option value="WASTE TO ENERGY">Waste to Energy</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <select wire:model="perPage" class="form-control ip-per-page">
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                        <div class="col-md-2 text-right">
                            @if($search || $filterStatus || $filterProvince || $filterTechnology)
                                <button wire:click="$set('search', '');$set('filterStatus', '');$set('filterProvince', '');$set('filterTechnology', '')" class="btn btn-sm btn-light" style="border-radius: 6px; font-size: 0.8rem;">
                                    <i class="fas fa-times mr-1"></i> Clear Filters
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Table Card --}}
            <div class="card ip-card" style="position: relative;">
                <div wire:loading.flex class="ip-loading">
                    <div class="spinner-border text-success"><span class="sr-only">Loading...</span></div>
                </div>

                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3>
                        <i class="fas fa-bolt mr-2" style="color: var(--z-gold)"></i>Power Agreements
                        <span class="ip-count ml-2">{{ $producers->total() }}</span>
                    </h3>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover ip-table mb-0">
                            <thead>
                                <tr>
                                    <th wire:click="sortBy('system_ref')">
                                        Ref #
                                        @if($sortField === 'system_ref')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} sort-icon active"></i>
                                        @else
                                            <i class="fas fa-sort sort-icon"></i>
                                        @endif
                                    </th>
                                    <th wire:click="sortBy('engagement_number')">
                                        Technology
                                        @if($sortField === 'engagement_number')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} sort-icon active"></i>
                                        @else
                                            <i class="fas fa-sort sort-icon"></i>
                                        @endif
                                    </th>
                                    <th wire:click="sortBy('name_of_ipp')">
                                        Name of IPP
                                        @if($sortField === 'name_of_ipp')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} sort-icon active"></i>
                                        @else
                                            <i class="fas fa-sort sort-icon"></i>
                                        @endif
                                    </th>
                                    <th>Application</th>
                                    <th wire:click="sortBy('size_of_plant')">
                                        Size (MW)
                                        @if($sortField === 'size_of_plant')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} sort-icon active"></i>
                                        @else
                                            <i class="fas fa-sort sort-icon"></i>
                                        @endif
                                    </th>
                                    <th>Province</th>
                                    <th>Status</th>
                                    <th>Contact</th>
                                    <th style="width: 90px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($producers as $item)
                                    <tr>
                                        <td>
                                            <span style="font-weight: 600; color: var(--z-gold-dark);">{{ $item->system_ref ?? '—' }}</span>
                                        </td>
                                        <td>
                                            @php
                                                $techColors = [
                                                    'SOLAR' => ['bg' => '#fffbeb', 'color' => '#92400e', 'border' => '#fde68a', 'icon' => 'fa-sun'],
                                                    'WIND' => ['bg' => '#eff6ff', 'color' => '#1e40af', 'border' => '#bfdbfe', 'icon' => 'fa-wind'],
                                                    'GEOTHERMAL' => ['bg' => '#fef2f2', 'color' => '#991b1b', 'border' => '#fecaca', 'icon' => 'fa-fire'],
                                                    'HYBRID' => ['bg' => '#f5f3ff', 'color' => '#5b21b6', 'border' => '#ddd6fe', 'icon' => 'fa-random'],
                                                    'HYDROGEN' => ['bg' => '#ecfdf5', 'color' => '#065f46', 'border' => '#a7f3d0', 'icon' => 'fa-atom'],
                                                    'BIOMASS' => ['bg' => '#f0fdf4', 'color' => '#166534', 'border' => '#bbf7d0', 'icon' => 'fa-leaf'],
                                                    'WASTE TO ENERGY' => ['bg' => '#fefce8', 'color' => '#854d0e', 'border' => '#fef08a', 'icon' => 'fa-recycle'],
                                                ];
                                                $tc = $techColors[$item->engagement_number] ?? ['bg' => '#f8fafc', 'color' => '#475569', 'border' => '#e2e8f0', 'icon' => 'fa-bolt'];
                                            @endphp
                                            <span class="ip-status-badge" style="background: {{ $tc['bg'] }}; color: {{ $tc['color'] }}; border: 1px solid {{ $tc['border'] }};">
                                                <i class="fas {{ $tc['icon'] }} mr-1" style="font-size: 0.65rem;"></i>{{ $item->engagement_number ?? '—' }}
                                            </span>
                                        </td>
                                        <td style="font-weight: 600; color: #1a2332; max-width: 180px;">
                                            {{ Str::limit($item->name_of_ipp, 30) ?? '—' }}
                                        </td>
                                        <td style="color: #6b7280;">
                                            {{ $item->date_of_application ? $item->date_of_application->format('M d, Y') : '—' }}
                                        </td>
                                        <td>
                                            <span style="font-weight: 700; color: #1a2332;">{{ $item->size_of_plant ?? '—' }}</span>
                                            <span style="font-size: 0.7rem; color: #94a3b8;">{{ $item->size_of_plant_unit }}</span>
                                        </td>
                                        <td style="color: #6b7280;">{{ $item->province->province ?? '—' }}</td>
                                        <td>
                                            @if($item->status_of_engagement)
                                                <span class="ip-status-badge" style="background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;">
                                                    {{ Str::limit($item->status_of_engagement, 20) }}
                                                </span>
                                            @else
                                                <span style="color: #94a3b8;">—</span>
                                            @endif
                                        </td>
                                        <td style="color: #6b7280;">{{ Str::limit($item->contact_person_name, 18) ?? '—' }}</td>
                                        <td>
                                            <div class="d-flex" style="gap: 4px;">
                                                <a href="{{ route('independent-producer.show', $item->id) }}" class="ip-action ip-action-view" title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <button wire:click="confirmDelete({{ $item->id }})" class="ip-action ip-action-delete" title="Delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-5" style="color: #94a3b8;">
                                            <i class="fas fa-industry fa-2x mb-2 d-block"></i>
                                            @if(!empty($search) || !empty($filterStatus) || !empty($filterProvince) || !empty($filterTechnology))
                                                No IPPs found matching your filters.
                                                <a href="#" wire:click.prevent="$set('search', '')" style="color: var(--z-green);">Clear search</a>
                                            @else
                                                No Independent Power Producers registered yet.
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
                        Showing {{ $producers->firstItem() ?? 0 }} - {{ $producers->lastItem() ?? 0 }} of {{ $producers->total() }}
                    </span>
                    {{ $producers->links() }}
                </div>
            </div>
        </div>
    </section>

    {{-- ===== CREATE MODAL ===== --}}
    @if($showCreateModal)
    <div class="modal fade show ip-modal" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl" style="max-width: 900px;">
            <div class="modal-content">
                <div class="modal-header-green d-flex align-items-center justify-content-between">
                    <h5><i class="fas fa-plus-circle mr-2"></i> Register New IPP</h5>
                    <button type="button" class="close" wire:click="$set('showCreateModal', false)">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 1.5rem; max-height: 70vh; overflow-y: auto;">

                    {{-- Basic Info --}}
                    <div class="ip-section-title"><i class="fas fa-info-circle mr-1"></i> Basic Information</div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="small font-weight-bold">Name of IPP <span class="text-danger">*</span></label>
                            <input type="text" wire:model.defer="name_of_ipp" class="form-control ip-input" placeholder="Company / Project Name">
                            @error('name_of_ipp') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="small font-weight-bold">Invoiced Services</label>
                            <select wire:model.defer="invoiced_services" class="form-control ip-input">
                                <option value="N/A">N/A</option>
                                <option value="INVOICED">INVOICED</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="small font-weight-bold">Application Date</label>
                            <input type="date" wire:model.defer="date_of_application" class="form-control ip-input">
                        </div>
                    </div>

                    {{-- Technology --}}
                    <div class="ip-section-title mt-2"><i class="fas fa-microchip mr-1"></i> Technology & Capacity</div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="small font-weight-bold">Technology <span class="text-danger">*</span></label>
                            <select wire:model.defer="engagement_number" class="form-control ip-input">
                                <option value="">-- Select --</option>
                                <option value="SOLAR">Solar</option>
                                <option value="WIND">Wind</option>
                                <option value="GEOTHERMAL">Geothermal</option>
                                <option value="HYBRID">Hybrid</option>
                                <option value="HYDROGEN">Hydrogen</option>
                                <option value="BIOMASS">Biomass</option>
                                <option value="WASTE TO ENERGY">Waste to Energy</option>
                            </select>
                            @error('engagement_number') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="small font-weight-bold">Size of Plant</label>
                            <div class="input-group">
                                <input type="number" step="any" wire:model.defer="size_of_plant" class="form-control ip-input" placeholder="0.00">
                                <div class="input-group-append">
                                    <span class="input-group-text" style="border-radius: 0 8px 8px 0; font-size: 0.82rem;">MW</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="small font-weight-bold">Total Avail. Capacity</label>
                            <input type="number" step="any" wire:model.lazy="total_available_capacity" class="form-control ip-input" placeholder="0.00">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="small font-weight-bold">Avail. Capacity</label>
                            <input type="text" wire:model="available_capacity" class="form-control ip-input" readonly style="background: #f8fafc;">
                        </div>
                    </div>

                    {{-- Location --}}
                    <div class="ip-section-title mt-2"><i class="fas fa-map-marker-alt mr-1"></i> Location & Connection</div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="small font-weight-bold">Province <span class="text-danger">*</span></label>
                            <select wire:model="province_id" class="form-control ip-input">
                                <option value="">-- Select Province --</option>
                                @foreach($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->province }}</option>
                                @endforeach
                            </select>
                            @error('province_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small font-weight-bold">District</label>
                            <select wire:model="district_id" class="form-control ip-input">
                                <option value="">-- Select District --</option>
                                @foreach($districts as $d)
                                    <option value="{{ $d['id'] }}">{{ $d['district'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small font-weight-bold">Proposed Connection Point</label>
                            <select wire:model="proposed_connection_point" class="form-control ip-input">
                                <option value="">-- Select --</option>
                                @foreach($connectionPoints as $cp)
                                    <option value="{{ $cp['substation'] }}">{{ $cp['substation'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="small font-weight-bold">Voltage Level</label>
                            <input type="text" wire:model="voltage_level" class="form-control ip-input" readonly style="background: #f8fafc;">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="small font-weight-bold">LCOE / Tariff</label>
                            <input type="text" wire:model.defer="ipp_tariff" class="form-control ip-input" placeholder="e.g. $0.06/kWh">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="small font-weight-bold">Preferred Connection Level</label>
                            <input type="text" wire:model.defer="preferred_connection_level" class="form-control ip-input">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="small font-weight-bold">Committed Capacity</label>
                            <input type="number" step="any" wire:model.lazy="committed_capacity" class="form-control ip-input" placeholder="0.00">
                        </div>
                    </div>

                    {{-- Dates & Status --}}
                    <div class="ip-section-title mt-2"><i class="fas fa-calendar-alt mr-1"></i> Dates & Status</div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="small font-weight-bold">Connection Date (Est.)</label>
                            <input type="date" wire:model.defer="date_of_connection" class="form-control ip-input">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="small font-weight-bold">Expiry Date</label>
                            <input type="date" wire:model.defer="expiry_connection_point" class="form-control ip-input">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="small font-weight-bold">Status of Engagement</label>
                            <select wire:model.defer="status_of_engagement" class="form-control ip-input">
                                <option value="">-- Select Status --</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->status }}">{{ $status->status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="small font-weight-bold">Type of Venture</label>
                            <select wire:model.defer="type_of_venture" class="form-control ip-input">
                                <option value="">-- Select Venture --</option>
                                @foreach($ventures as $venture)
                                    <option value="{{ $venture->id }}">{{ $venture->venture_type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="small font-weight-bold">Comments / Updates</label>
                            <textarea wire:model.defer="updates_on_engagements" class="form-control ip-input" rows="2" placeholder="Any comments on engagement..."></textarea>
                        </div>
                    </div>

                    {{-- Contact --}}
                    <div class="ip-section-title mt-2"><i class="fas fa-user-tie mr-1"></i> Contact Person</div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="small font-weight-bold">Name</label>
                            <input type="text" wire:model.defer="contact_person_name" class="form-control ip-input" placeholder="Full name">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small font-weight-bold">Email</label>
                            <input type="email" wire:model.defer="contact_person_email" class="form-control ip-input" placeholder="email@example.com">
                            @error('contact_person_email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small font-weight-bold">Phone</label>
                            <input type="text" wire:model.defer="contact_person_phone" class="form-control ip-input" placeholder="+260...">
                        </div>
                    </div>

                    {{-- File Upload --}}
                    <div class="ip-section-title mt-2"><i class="fas fa-paperclip mr-1"></i> Attachments</div>
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <input type="file" wire:model="doc_files" multiple class="form-control ip-input">
                            <small class="text-muted">Upload contract documents (optional, multiple files supported)</small>
                        </div>
                    </div>

                </div>
                <div style="padding: 0.75rem 1.5rem 1.25rem; display: flex; gap: 0.75rem; justify-content: flex-end; border-top: 1px solid #e9ecef;">
                    <button wire:click="$set('showCreateModal', false)" class="btn btn-light" style="border-radius: 8px;">Cancel</button>
                    <button wire:click="createProducer" class="btn-zesco-green" wire:loading.attr="disabled">
                        <i class="fas fa-check-circle mr-1"></i> Register IPP
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ===== DELETE CONFIRMATION ===== --}}
    @if($deleteId)
    <div class="modal fade show ip-modal" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 420px;">
            <div class="modal-content">
                <div style="padding: 2rem; text-align: center;">
                    <div style="width: 56px; height: 56px; border-radius: 50%; background: #fef2f2; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                        <i class="fas fa-exclamation-triangle" style="font-size: 1.5rem; color: #dc2626;"></i>
                    </div>
                    <h5 style="font-weight: 700; margin-bottom: 0.5rem;">Delete IPP?</h5>
                    <p style="color: #6b7280; font-size: 0.9rem;">
                        Are you sure you want to delete <strong class="text-danger">{{ $deleteName }}</strong>?
                        This action uses soft-delete and can be reversed.
                    </p>
                    <div class="d-flex justify-content-center" style="gap: 0.75rem; margin-top: 1.5rem;">
                        <button wire:click="cancelDelete" class="btn btn-light px-4" style="border-radius: 8px;">Cancel</button>
                        <button wire:click="deleteProducer" class="btn btn-danger px-4" style="border-radius: 8px; font-weight: 600;">
                            <i class="fas fa-trash-alt mr-1"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
