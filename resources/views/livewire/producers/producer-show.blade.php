<style>
:root { --z-green: #14984f; --z-green-dark: #0d7a3e; --z-gold: #FFB223; --z-gold-dark: #e09a00; }

.ps-page-header {
    background: linear-gradient(135deg, #0d7a3e 0%, #14984f 60%, #00895A 100%);
    border-radius: 12px; padding: 1.5rem 2rem; margin-bottom: 1.5rem;
    color: #fff; position: relative; overflow: hidden;
}
.ps-page-header::before {
    content: ''; position: absolute; top: -40%; right: -10%;
    width: 300px; height: 300px;
    background: radial-gradient(ellipse, rgba(255,255,255,0.07) 0%, transparent 70%);
}
.ps-page-header h1 { font-size: 1.25rem; font-weight: 700; margin: 0; }
.ps-page-header .ref { font-size: 1rem; color: var(--z-gold); font-weight: 700; }
.ps-page-header p  { margin: 0.25rem 0 0; opacity: 0.85; font-size: 0.875rem; }

.ps-card { border-radius: 12px; border: 1px solid #e9ecef; overflow: hidden; margin-bottom: 1rem; }
.ps-card .card-header { background: #fff; border-bottom: 1px solid #e9ecef; padding: 0.85rem 1.25rem; }
.ps-card .card-header h4 { font-size: 0.95rem; font-weight: 700; color: #1a2332; margin: 0; }

.ps-section-title {
    font-size: 0.78rem; font-weight: 700; color: var(--z-green); text-transform: uppercase;
    letter-spacing: 0.05em; border-bottom: 2px solid #e2e8f0; padding-bottom: 0.35rem; margin-bottom: 1rem; margin-top: 0.5rem;
}

.ps-label { font-size: 0.72rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 0.1rem; }
.ps-value { font-size: 0.9rem; font-weight: 600; color: #1a2332; word-break: break-word; }
.ps-value-muted { font-size: 0.9rem; color: #94a3b8; }

.ps-stat {
    text-align: center; background: linear-gradient(135deg, #ecfdf5, #d1fae5);
    border-radius: 10px; padding: 0.85rem; border: 1px solid #a7f3d0;
}
.ps-stat-num { font-size: 1.25rem; font-weight: 800; color: var(--z-green); line-height: 1; }
.ps-stat-label { font-size: 0.68rem; color: #6b7280; font-weight: 600; margin-top: 0.15rem; }

.ps-input {
    padding: 0.45rem 0.7rem; border-radius: 8px;
    border: 1.5px solid #e2e8f0; font-size: 0.85rem; transition: border-color 0.2s;
}
.ps-input:focus { border-color: var(--z-green); box-shadow: 0 0 0 3px rgba(20,152,79,0.1); outline: none; }

.btn-zesco {
    background: linear-gradient(135deg, var(--z-gold), #f59e0b);
    color: #fff; border-radius: 8px; padding: 0.45rem 1rem;
    font-weight: 600; font-size: 0.82rem; border: none;
    transition: all 0.2s; display: inline-flex; align-items: center; gap: 0.35rem;
}
.btn-zesco:hover { background: linear-gradient(135deg, var(--z-gold-dark), #d97706); box-shadow: 0 4px 12px rgba(255,178,35,0.35); color: #fff; }
.btn-zesco-green {
    background: linear-gradient(135deg, var(--z-green), var(--z-green-dark));
    color: #fff; border-radius: 8px; padding: 0.45rem 1rem;
    font-weight: 600; font-size: 0.82rem; border: none; transition: all 0.2s;
}
.btn-zesco-green:hover { background: linear-gradient(135deg, #0d7a3e, #065f30); color: #fff; }

.ps-tech-badge {
    display: inline-flex; align-items: center; gap: 0.35rem;
    padding: 0.3rem 0.75rem; border-radius: 20px; font-size: 0.82rem; font-weight: 600;
}

.ps-file-card {
    background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px;
    padding: 0.75rem 1rem; display: flex; align-items: center; gap: 0.75rem;
    transition: border-color 0.2s; margin-bottom: 0.5rem;
}
.ps-file-card:hover { border-color: var(--z-green); }

.ps-loading {
    position: absolute; inset: 0; background: rgba(255,255,255,0.7);
    display: flex; align-items: center; justify-content: center;
    z-index: 10; border-radius: 12px;
}
</style>

<div>
    <!-- Page Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="ps-page-header">
                <div class="d-flex align-items-center justify-content-between flex-wrap" style="gap: 1rem;">
                    <div>
                        <h1>
                            <i class="fas fa-industry mr-2" style="color: var(--z-gold)"></i>
                            {{ $item->name_of_ipp ?? 'IPP Details' }}
                        </h1>
                        <p>
                            <span class="ref">{{ $item->system_ref }}</span>
                            &nbsp;|&nbsp; {{ $item->engagement_number ?? 'N/A' }} Technology
                        </p>
                    </div>
                    <div class="d-flex align-items-center" style="gap: 0.5rem;">
                        <a href="{{ route('independent-producer.index') }}" class="btn btn-sm" style="background: rgba(255,255,255,0.15); color: #fff; border-radius: 8px; font-size: 0.82rem;">
                            <i class="fas fa-arrow-left mr-1"></i> Back to List
                        </a>
                        @if(!$editing)
                            <button wire:click="startEditing" class="btn-zesco">
                                <i class="fas fa-pen"></i> Edit IPP
                            </button>
                        @endif
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

            @if($editing)
                {{-- ===== EDIT MODE ===== --}}
                <div class="card ps-card" style="position: relative;">
                    <div wire:loading.flex class="ps-loading">
                        <div class="spinner-border text-success"><span class="sr-only">Loading...</span></div>
                    </div>
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4><i class="fas fa-pen mr-2" style="color: var(--z-gold);"></i> Edit IPP Details</h4>
                        <div class="d-flex" style="gap: 0.5rem;">
                            <button wire:click="cancelEditing" class="btn btn-sm btn-light" style="border-radius: 8px; font-size: 0.82rem;">
                                <i class="fas fa-times mr-1"></i> Cancel
                            </button>
                            <button wire:click="saveProducer" class="btn-zesco-green">
                                <i class="fas fa-save mr-1"></i> Save Changes
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- Basic Info --}}
                        <div class="ps-section-title"><i class="fas fa-info-circle mr-1"></i> Basic Information</div>
                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label class="ps-label">Name of IPP <span class="text-danger">*</span></label>
                                <input type="text" wire:model.defer="name_of_ipp" class="form-control ps-input">
                                @error('name_of_ipp') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="ps-label">Invoiced Services</label>
                                <select wire:model.defer="invoiced_services" class="form-control ps-input">
                                    <option value="N/A">N/A</option>
                                    <option value="INVOICED">INVOICED</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="ps-label">Application Date</label>
                                <input type="date" wire:model.defer="date_of_application" class="form-control ps-input">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="ps-label">System Ref</label>
                                <input type="text" value="{{ $system_ref }}" class="form-control ps-input" readonly style="background: #f8fafc;">
                            </div>
                        </div>

                        {{-- Technology & Capacity --}}
                        <div class="ps-section-title"><i class="fas fa-microchip mr-1"></i> Technology & Capacity</div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="ps-label">Technology <span class="text-danger">*</span></label>
                                <select wire:model.defer="engagement_number" class="form-control ps-input">
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
                                <label class="ps-label">Size of Plant</label>
                                <div class="input-group">
                                    <input type="number" step="any" wire:model.defer="size_of_plant" class="form-control ps-input">
                                    <div class="input-group-append">
                                        <span class="input-group-text" style="font-size: 0.82rem;">MW</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="ps-label">Available Capacity</label>
                                <input type="text" wire:model.defer="available_capacity" class="form-control ps-input">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="ps-label">LCOE / Tariff</label>
                                <input type="text" wire:model.defer="ipp_tariff" class="form-control ps-input">
                            </div>
                        </div>

                        {{-- Location --}}
                        <div class="ps-section-title"><i class="fas fa-map-marker-alt mr-1"></i> Location & Connection</div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="ps-label">Province <span class="text-danger">*</span></label>
                                <select wire:model="province_id" class="form-control ps-input">
                                    <option value="">-- Select --</option>
                                    @foreach($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->province }}</option>
                                    @endforeach
                                </select>
                                @error('province_id') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="ps-label">District</label>
                                <select wire:model="district_id" class="form-control ps-input">
                                    <option value="">-- Select --</option>
                                    @foreach($districts as $d)
                                        <option value="{{ $d['id'] }}">{{ $d['district'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="ps-label">Connection Point</label>
                                <select wire:model="proposed_connection_point" class="form-control ps-input">
                                    <option value="">-- Select --</option>
                                    @foreach($connectionPoints as $cp)
                                        <option value="{{ $cp['substation'] }}">{{ $cp['substation'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="ps-label">Voltage Level</label>
                                <input type="text" wire:model="voltage_level" class="form-control ps-input" readonly style="background: #f8fafc;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="ps-label">Preferred Conn. Level</label>
                                <input type="text" wire:model.defer="preferred_connection_level" class="form-control ps-input">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="ps-label">Connection Date (Est.)</label>
                                <input type="date" wire:model.defer="date_of_connection" class="form-control ps-input">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="ps-label">Expiry Date</label>
                                <input type="date" wire:model.defer="expiry_connection_point" class="form-control ps-input">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="ps-label">Expected Commissioning</label>
                                <input type="date" wire:model.defer="expected_date_commissioning" class="form-control ps-input">
                            </div>
                        </div>

                        {{-- Status & Engagement --}}
                        <div class="ps-section-title"><i class="fas fa-chart-line mr-1"></i> Status & Engagement</div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="ps-label">Status of Engagement</label>
                                <select wire:model.defer="status_of_engagement" class="form-control ps-input">
                                    <option value="">-- Select --</option>
                                    @foreach($statuses as $s)
                                        <option value="{{ $s->status }}">{{ $s->status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="ps-label">Type of Venture</label>
                                <select wire:model.defer="type_of_venture" class="form-control ps-input">
                                    <option value="">-- Select --</option>
                                    @foreach($ventures as $v)
                                        <option value="{{ $v->id }}">{{ $v->venture_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="ps-label">Expected Commercial</label>
                                <input type="text" wire:model.defer="expected_commercial" class="form-control ps-input">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="ps-label">Comments / Updates</label>
                                <textarea wire:model.defer="updates_on_engagements" class="form-control ps-input" rows="2"></textarea>
                            </div>
                        </div>

                        {{-- Contact --}}
                        <div class="ps-section-title"><i class="fas fa-user-tie mr-1"></i> Contact Person</div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="ps-label">Name</label>
                                <input type="text" wire:model.defer="contact_person_name" class="form-control ps-input">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="ps-label">Email</label>
                                <input type="email" wire:model.defer="contact_person_email" class="form-control ps-input">
                                @error('contact_person_email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="ps-label">Phone</label>
                                <input type="text" wire:model.defer="contact_person_phone" class="form-control ps-input">
                            </div>
                        </div>

                        {{-- File Upload --}}
                        <div class="ps-section-title"><i class="fas fa-paperclip mr-1"></i> Upload New Files</div>
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <input type="file" wire:model="newFiles" multiple class="form-control ps-input">
                                <small class="text-muted">Attach additional contract documents</small>
                            </div>
                        </div>

                        {{-- Save Footer --}}
                        <div class="d-flex justify-content-end mt-3 pt-3" style="border-top: 1px solid #e9ecef; gap: 0.75rem;">
                            <button wire:click="cancelEditing" class="btn btn-light" style="border-radius: 8px;">Cancel</button>
                            <button wire:click="saveProducer" class="btn-zesco-green">
                                <i class="fas fa-save mr-1"></i> Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            @else
                {{-- ===== VIEW MODE ===== --}}
                <div class="row">
                    {{-- Left Column: IPP Details --}}
                    <div class="col-lg-7">
                        <div class="card ps-card" style="position: relative;">
                            <div wire:loading.flex class="ps-loading">
                                <div class="spinner-border text-success"><span class="sr-only">Loading...</span></div>
                            </div>

                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h4><i class="fas fa-bolt mr-2" style="color: var(--z-gold);"></i> IPP Details</h4>
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
                                <span class="ps-tech-badge" style="background: {{ $tc['bg'] }}; color: {{ $tc['color'] }}; border: 1px solid {{ $tc['border'] }};">
                                    <i class="fas {{ $tc['icon'] }}" style="font-size: 0.7rem;"></i>
                                    {{ $item->engagement_number ?? 'N/A' }}
                                </span>
                            </div>
                            <div class="card-body">
                                {{-- Quick Stats --}}
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <div class="ps-stat">
                                            <div class="ps-stat-num">{{ $item->size_of_plant ?? '—' }}</div>
                                            <div class="ps-stat-label">Plant Size (MW)</div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="ps-stat">
                                            <div class="ps-stat-num">{{ $item->available_capacity ?? '—' }}</div>
                                            <div class="ps-stat-label">Avail. Capacity</div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="ps-stat">
                                            <div class="ps-stat-num" style="font-size: 0.95rem;">{{ $item->voltage_level ?? '—' }}</div>
                                            <div class="ps-stat-label">Voltage Level</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Basic Information --}}
                                <div class="ps-section-title"><i class="fas fa-info-circle mr-1"></i> Basic Information</div>
                                <div class="row mb-2">
                                    <div class="col-md-6 mb-2">
                                        <div class="ps-label">Name of IPP</div>
                                        <div class="ps-value">{{ $item->name_of_ipp ?? '—' }}</div>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <div class="ps-label">Invoiced Services</div>
                                        <div class="ps-value">{{ $item->invoiced_services ?? '—' }}</div>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <div class="ps-label">Application Date</div>
                                        <div class="ps-value">{{ $item->date_of_application ? $item->date_of_application->format('M d, Y') : '—' }}</div>
                                    </div>
                                </div>

                                {{-- Location --}}
                                <div class="ps-section-title"><i class="fas fa-map-marker-alt mr-1"></i> Location & Connection</div>
                                <div class="row mb-2">
                                    <div class="col-md-4 mb-2">
                                        <div class="ps-label">Province</div>
                                        <div class="ps-value">{{ $item->province->province ?? '—' }}</div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="ps-label">District</div>
                                        <div class="ps-value">{{ $item->districts->district ?? '—' }}</div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="ps-label">Connection Point</div>
                                        <div class="ps-value">{{ $item->proposed_connection_point ?? '—' }}</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-3 mb-2">
                                        <div class="ps-label">Preferred Conn. Level</div>
                                        <div class="ps-value">{{ $item->preferred_connection_level ?? '—' }}</div>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <div class="ps-label">LCOE / Tariff</div>
                                        <div class="ps-value">{{ $item->ipp_tariff ?? '—' }}</div>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <div class="ps-label">Connection Date (Est.)</div>
                                        <div class="ps-value">{{ $item->date_of_connection ? $item->date_of_connection->format('M d, Y') : '—' }}</div>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <div class="ps-label">Expiry Date</div>
                                        <div class="ps-value">{{ $item->expiry_connection_point ?? '—' }}</div>
                                    </div>
                                </div>

                                {{-- Status & Engagement --}}
                                <div class="ps-section-title"><i class="fas fa-chart-line mr-1"></i> Status & Engagement</div>
                                <div class="row mb-2">
                                    <div class="col-md-4 mb-2">
                                        <div class="ps-label">Status of Engagement</div>
                                        <div class="ps-value">
                                            @if($item->status_of_engagement)
                                                <span style="display: inline-block; padding: 0.2rem 0.6rem; border-radius: 20px; font-size: 0.78rem; font-weight: 600; background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;">
                                                    {{ $item->status_of_engagement }}
                                                </span>
                                            @else
                                                <span class="ps-value-muted">—</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="ps-label">Type of Venture</div>
                                        <div class="ps-value">{{ $item->ventures->venture_type ?? '—' }}</div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="ps-label">Expected Commercial</div>
                                        <div class="ps-value">{{ $item->expected_commercial ?? '—' }}</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-12 mb-2">
                                        <div class="ps-label">Comments / Updates</div>
                                        <div class="ps-value" style="font-size: 0.85rem; font-weight: 400;">{{ $item->updates_on_engagements ?? '—' }}</div>
                                    </div>
                                </div>

                                {{-- Contact --}}
                                <div class="ps-section-title"><i class="fas fa-user-tie mr-1"></i> Contact Person</div>
                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <div class="ps-label">Name</div>
                                        <div class="ps-value">{{ $item->contact_person_name ?? '—' }}</div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="ps-label">Email</div>
                                        <div class="ps-value">
                                            @if($item->contact_person_email)
                                                <a href="mailto:{{ $item->contact_person_email }}" style="color: var(--z-green); text-decoration: none;">
                                                    <i class="fas fa-envelope mr-1" style="font-size: 0.75rem;"></i>{{ $item->contact_person_email }}
                                                </a>
                                            @else
                                                <span class="ps-value-muted">—</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="ps-label">Phone</div>
                                        <div class="ps-value">
                                            @if($item->contact_person_phone)
                                                <i class="fas fa-phone mr-1" style="font-size: 0.75rem; color: var(--z-green);"></i>{{ $item->contact_person_phone }}
                                            @else
                                                <span class="ps-value-muted">—</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- Metadata --}}
                                <div class="mt-3 pt-3" style="border-top: 1px solid #e9ecef;">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <small style="color: #94a3b8;"><i class="fas fa-clock mr-1"></i> Updated: {{ $item->date_of_update ?? '—' }}</small>
                                        </div>
                                        <div class="col-md-4">
                                            <small style="color: #94a3b8;"><i class="fas fa-user mr-1"></i> By: {{ $item->updated_by ?? '—' }}</small>
                                        </div>
                                        <div class="col-md-4">
                                            <small style="color: #94a3b8;"><i class="fas fa-calendar mr-1"></i> Created: {{ $item->created_at ? $item->created_at->format('M d, Y') : '—' }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: Contracts / Files --}}
                    <div class="col-lg-5">
                        <div class="card ps-card">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h4><i class="fas fa-file-contract mr-2" style="color: var(--z-gold);"></i> Contract Files</h4>
                                <span style="font-size: 0.78rem; color: #6b7280; font-weight: 600;">{{ count($contracts) }} file(s)</span>
                            </div>
                            <div class="card-body">
                                @if(count($contracts) > 0)
                                    @foreach($contracts as $file)
                                        <div class="ps-file-card">
                                            <div style="width: 40px; height: 40px; border-radius: 8px; background: linear-gradient(135deg, #ecfdf5, #d1fae5); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                @php
                                                    $extIcon = match(strtolower($file['ext'] ?? '')) {
                                                        'pdf' => 'fa-file-pdf text-danger',
                                                        'doc', 'docx' => 'fa-file-word text-primary',
                                                        'xls', 'xlsx' => 'fa-file-excel text-success',
                                                        'jpg', 'jpeg', 'png' => 'fa-file-image text-info',
                                                        default => 'fa-file text-secondary',
                                                    };
                                                @endphp
                                                <i class="fas {{ $extIcon }}"></i>
                                            </div>
                                            <div style="flex: 1; min-width: 0;">
                                                <div style="font-size: 0.82rem; font-weight: 600; color: #1a2332; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $file['name'] }}">
                                                    {{ $file['name'] }}
                                                </div>
                                                <div style="font-size: 0.72rem; color: #94a3b8;">
                                                    {{ $file['size'] }} MB &bull; {{ strtoupper($file['ext'] ?? 'N/A') }}
                                                </div>
                                            </div>
                                            <div class="d-flex" style="gap: 4px;">
                                                <a href="{{ asset('storage/contracts/' . $file['name']) }}" target="_blank" class="btn btn-sm btn-light" style="border-radius: 6px; font-size: 0.75rem;" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <button wire:click="deleteFile({{ $file['id'] }})" class="btn btn-sm btn-light" style="border-radius: 6px; font-size: 0.75rem; color: #dc2626;" title="Delete" onclick="return confirm('Delete this file?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center py-4" style="color: #94a3b8;">
                                        <i class="fas fa-folder-open fa-2x d-block mb-2"></i>
                                        <div>No contract files uploaded yet.</div>
                                        <button wire:click="startEditing" class="btn btn-sm btn-light mt-2" style="border-radius: 8px; font-size: 0.8rem;">
                                            <i class="fas fa-upload mr-1"></i> Upload Files
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
</div>
