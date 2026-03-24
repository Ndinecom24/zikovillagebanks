
<div>
    <!-- Page Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="z-page-header">
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
            <div class="card z-card mb-3">
                <div class="card-body" style="padding: 0.75rem 1.25rem;">
                    <div class="row align-items-center" style="gap: 0.5rem 0;">
                        <div class="col-md-3">
                            <div class="z-search">
                                <i class="fas fa-search si"></i>
                                <input type="text" wire:model.debounce.300ms="search" placeholder="Search IPPs...">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <select wire:model="filterStatus" class="form-control z-filter-select">
                                <option value="">All Statuses</option>
                                @foreach($statuses as $s)
                                    <option value="{{ $s->status }}">{{ $s->status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select wire:model="filterProvince" class="form-control z-filter-select">
                                <option value="">All Provinces</option>
                                @foreach($provinces as $p)
                                    <option value="{{ $p->id }}">{{ $p->province }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select wire:model="filterTechnology" class="form-control z-filter-select">
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
                            <select wire:model="perPage" class="form-control z-per-page">
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
            <div class="card z-card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3>
                        <i class="fas fa-bolt mr-2" style="color: var(--z-gold)"></i>Power Agreements
                        <span class="z-count ml-2">{{ $producers->total() }}</span>
                    </h3>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover z-table mb-0">
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
                                            <span class="z-badge" style="background: {{ $tc['bg'] }}; color: {{ $tc['color'] }}; border: 1px solid {{ $tc['border'] }};">
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
                                                <span class="z-badge" style="background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;">
                                                    {{ Str::limit($item->status_of_engagement, 20) }}
                                                </span>
                                            @else
                                                <span style="color: #94a3b8;">—</span>
                                            @endif
                                        </td>
                                        <td style="color: #6b7280;">{{ Str::limit($item->contact_person_name, 18) ?? '—' }}</td>
                                        <td>
                                            <div class="d-flex" style="gap: 4px;">
                                                <a href="{{ route('independent-producer.show', $item->id) }}" class="z-action z-action-view" title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <button wire:click="confirmDelete({{ $item->id }})" class="z-action z-action-delete" title="Delete">
                                                    <span wire:loading wire:target="confirmDelete({{ $item->id }})" class="spinner-border spinner-border-sm" role="status"></span>
                                                    <i wire:loading.remove wire:target="confirmDelete({{ $item->id }})" class="fas fa-trash-alt"></i>
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
    <div class="modal fade show z-modal" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl" style="max-width: 900px;">
            <div class="modal-content">
                <div class="modal-header-zesco d-flex align-items-center justify-content-between">
                    <h5><i class="fas fa-plus-circle mr-2"></i> Register New IPP</h5>
                    <button type="button" class="close" wire:click="$set('showCreateModal', false)">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 1.5rem; max-height: 70vh; overflow-y: auto;">

                    {{-- Basic Info --}}
                    <div class="z-section-title"><i class="fas fa-info-circle mr-1"></i> Basic Information</div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="small font-weight-bold">Name of IPP <span class="text-danger">*</span></label>
                            <input type="text" wire:model.defer="name_of_ipp" class="form-control z-input" placeholder="Company / Project Name">
                            @error('name_of_ipp') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="small font-weight-bold">Invoiced Services</label>
                            <select wire:model.defer="invoiced_services" class="form-control z-input">
                                <option value="N/A">N/A</option>
                                <option value="INVOICED">INVOICED</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="small font-weight-bold">Application Date</label>
                            <input type="date" wire:model.defer="date_of_application" class="form-control z-input">
                        </div>
                    </div>

                    {{-- Technology --}}
                    <div class="z-section-title mt-2"><i class="fas fa-microchip mr-1"></i> Technology & Capacity</div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="small font-weight-bold">Technology <span class="text-danger">*</span></label>
                            <select wire:model.defer="engagement_number" class="form-control z-input">
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
                                <input type="number" step="any" wire:model.defer="size_of_plant" class="form-control z-input" placeholder="0.00">
                                <div class="input-group-append">
                                    <span class="input-group-text" style="border-radius: 0 8px 8px 0; font-size: 0.82rem;">MW</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="small font-weight-bold">Total Avail. Capacity</label>
                            <input type="number" step="any" wire:model.lazy="total_available_capacity" class="form-control z-input" placeholder="0.00">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="small font-weight-bold">Avail. Capacity</label>
                            <input type="text" wire:model="available_capacity" class="form-control z-input" readonly style="background: #f8fafc;">
                        </div>
                    </div>

                    {{-- Location --}}
                    <div class="z-section-title mt-2"><i class="fas fa-map-marker-alt mr-1"></i> Location & Connection</div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="small font-weight-bold">Province <span class="text-danger">*</span></label>
                            <select wire:model="province_id" class="form-control z-input">
                                <option value="">-- Select Province --</option>
                                @foreach($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->province }}</option>
                                @endforeach
                            </select>
                            @error('province_id') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small font-weight-bold">District</label>
                            <select wire:model="district_id" class="form-control z-input">
                                <option value="">-- Select District --</option>
                                @foreach($districts as $d)
                                    <option value="{{ $d['id'] }}">{{ $d['district'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small font-weight-bold">Proposed Connection Point</label>
                            <select wire:model="proposed_connection_point" class="form-control z-input">
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
                            <input type="text" wire:model="voltage_level" class="form-control z-input" readonly style="background: #f8fafc;">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="small font-weight-bold">LCOE / Tariff</label>
                            <input type="text" wire:model.defer="ipp_tariff" class="form-control z-input" placeholder="e.g. $0.06/kWh">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="small font-weight-bold">Preferred Connection Level</label>
                            <input type="text" wire:model.defer="preferred_connection_level" class="form-control z-input">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="small font-weight-bold">Committed Capacity</label>
                            <input type="number" step="any" wire:model.lazy="committed_capacity" class="form-control z-input" placeholder="0.00">
                        </div>
                    </div>

                    {{-- Dates & Status --}}
                    <div class="z-section-title mt-2"><i class="fas fa-calendar-alt mr-1"></i> Dates & Status</div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="small font-weight-bold">Connection Date (Est.)</label>
                            <input type="date" wire:model.defer="date_of_connection" class="form-control z-input">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="small font-weight-bold">Expiry Date</label>
                            <input type="date" wire:model.defer="expiry_connection_point" class="form-control z-input">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="small font-weight-bold">Status of Engagement</label>
                            <select wire:model.defer="status_of_engagement" class="form-control z-input">
                                <option value="">-- Select Status --</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status->status }}">{{ $status->status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="small font-weight-bold">Type of Venture</label>
                            <select wire:model.defer="type_of_venture" class="form-control z-input">
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
                            <textarea wire:model.defer="updates_on_engagements" class="form-control z-input" rows="2" placeholder="Any comments on engagement..."></textarea>
                        </div>
                    </div>

                    {{-- Contact --}}
                    <div class="z-section-title mt-2"><i class="fas fa-user-tie mr-1"></i> Contact Person</div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="small font-weight-bold">Name</label>
                            <input type="text" wire:model.defer="contact_person_name" class="form-control z-input" placeholder="Full name">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small font-weight-bold">Email</label>
                            <input type="email" wire:model.defer="contact_person_email" class="form-control z-input" placeholder="email@example.com">
                            @error('contact_person_email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small font-weight-bold">Phone</label>
                            <input type="text" wire:model.defer="contact_person_phone" class="form-control z-input" placeholder="+260...">
                        </div>
                    </div>

                    {{-- File Upload --}}
                    <div class="z-section-title mt-2"><i class="fas fa-paperclip mr-1"></i> Attachments</div>
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <input type="file" wire:model="doc_files" multiple class="form-control z-input">
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
    <div class="modal fade show z-modal" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
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