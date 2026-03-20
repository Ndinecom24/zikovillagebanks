
<div>
    <!-- Page Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="z-page-header">
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
                <div class="card z-card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4><i class="fas fa-pen mr-2" style="color: var(--z-gold);"></i> Edit IPP Details</h4>
                        <div class="d-flex" style="gap: 0.5rem;">
                            <button wire:click="cancelEditing" class="btn btn-sm btn-light" style="border-radius: 8px; font-size: 0.82rem;">
                                <i class="fas fa-times mr-1"></i> Cancel
                            </button>
                            <button wire:click="saveProducer" class="btn-zesco-green">
                                <span wire:loading wire:target="saveProducer" class="spinner-border spinner-border-sm mr-1" role="status"></span>
                                <i wire:loading.remove wire:target="saveProducer" class="fas fa-save mr-1"></i> Save Changes
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- Basic Info --}}
                        <div class="z-section-title"><i class="fas fa-info-circle mr-1"></i> Basic Information</div>
                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label class="z-label">Name of IPP <span class="text-danger">*</span></label>
                                <input type="text" wire:model.defer="name_of_ipp" class="form-control z-input">
                                @error('name_of_ipp') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="z-label">Invoiced Services</label>
                                <select wire:model.defer="invoiced_services" class="form-control z-input">
                                    <option value="N/A">N/A</option>
                                    <option value="INVOICED">INVOICED</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="z-label">Application Date</label>
                                <input type="date" wire:model.defer="date_of_application" class="form-control z-input">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label class="z-label">System Ref</label>
                                <input type="text" value="{{ $system_ref }}" class="form-control z-input" readonly style="background: #f8fafc;">
                            </div>
                        </div>

                        {{-- Technology & Capacity --}}
                        <div class="z-section-title"><i class="fas fa-microchip mr-1"></i> Technology & Capacity</div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="z-label">Technology <span class="text-danger">*</span></label>
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
                                <label class="z-label">Size of Plant</label>
                                <div class="input-group">
                                    <input type="number" step="any" wire:model.defer="size_of_plant" class="form-control z-input">
                                    <div class="input-group-append">
                                        <span class="input-group-text" style="font-size: 0.82rem;">MW</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="z-label">Available Capacity</label>
                                <input type="text" wire:model.defer="available_capacity" class="form-control z-input">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="z-label">LCOE / Tariff</label>
                                <input type="text" wire:model.defer="ipp_tariff" class="form-control z-input">
                            </div>
                        </div>

                        {{-- Location --}}
                        <div class="z-section-title"><i class="fas fa-map-marker-alt mr-1"></i> Location & Connection</div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="z-label">Province <span class="text-danger">*</span></label>
                                <select wire:model="province_id" class="form-control z-input">
                                    <option value="">-- Select --</option>
                                    @foreach($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->province }}</option>
                                    @endforeach
                                </select>
                                @error('province_id') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="z-label">District</label>
                                <select wire:model="district_id" class="form-control z-input">
                                    <option value="">-- Select --</option>
                                    @foreach($districts as $d)
                                        <option value="{{ $d['id'] }}">{{ $d['district'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="z-label">Connection Point</label>
                                <select wire:model="proposed_connection_point" class="form-control z-input">
                                    <option value="">-- Select --</option>
                                    @foreach($connectionPoints as $cp)
                                        <option value="{{ $cp['substation'] }}">{{ $cp['substation'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="z-label">Voltage Level</label>
                                <input type="text" wire:model="voltage_level" class="form-control z-input" readonly style="background: #f8fafc;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="z-label">Preferred Conn. Level</label>
                                <input type="text" wire:model.defer="preferred_connection_level" class="form-control z-input">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="z-label">Connection Date (Est.)</label>
                                <input type="date" wire:model.defer="date_of_connection" class="form-control z-input">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="z-label">Expiry Date</label>
                                <input type="date" wire:model.defer="expiry_connection_point" class="form-control z-input">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="z-label">Expected Commissioning</label>
                                <input type="date" wire:model.defer="expected_date_commissioning" class="form-control z-input">
                            </div>
                        </div>

                        {{-- Status & Engagement --}}
                        <div class="z-section-title"><i class="fas fa-chart-line mr-1"></i> Status & Engagement</div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="z-label">Status of Engagement</label>
                                <select wire:model.defer="status_of_engagement" class="form-control z-input">
                                    <option value="">-- Select --</option>
                                    @foreach($statuses as $s)
                                        <option value="{{ $s->status }}">{{ $s->status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="z-label">Type of Venture</label>
                                <select wire:model.defer="type_of_venture" class="form-control z-input">
                                    <option value="">-- Select --</option>
                                    @foreach($ventures as $v)
                                        <option value="{{ $v->id }}">{{ $v->venture_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="z-label">Expected Commercial</label>
                                <input type="text" wire:model.defer="expected_commercial" class="form-control z-input">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="z-label">Comments / Updates</label>
                                <textarea wire:model.defer="updates_on_engagements" class="form-control z-input" rows="2"></textarea>
                            </div>
                        </div>

                        {{-- Contact --}}
                        <div class="z-section-title"><i class="fas fa-user-tie mr-1"></i> Contact Person</div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="z-label">Name</label>
                                <input type="text" wire:model.defer="contact_person_name" class="form-control z-input">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="z-label">Email</label>
                                <input type="email" wire:model.defer="contact_person_email" class="form-control z-input">
                                @error('contact_person_email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="z-label">Phone</label>
                                <input type="text" wire:model.defer="contact_person_phone" class="form-control z-input">
                            </div>
                        </div>

                        {{-- File Upload --}}
                        <div class="z-section-title"><i class="fas fa-paperclip mr-1"></i> Upload New Files</div>
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <input type="file" wire:model="newFiles" multiple class="form-control z-input">
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
                        <div class="card z-card">
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
                                <span class="z-tech-badge" style="background: {{ $tc['bg'] }}; color: {{ $tc['color'] }}; border: 1px solid {{ $tc['border'] }};">
                                    <i class="fas {{ $tc['icon'] }}" style="font-size: 0.7rem;"></i>
                                    {{ $item->engagement_number ?? 'N/A' }}
                                </span>
                            </div>
                            <div class="card-body">
                                {{-- Quick Stats --}}
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <div class="z-stat-card">
                                            <div class="z-stat-num">{{ $item->size_of_plant ?? '—' }}</div>
                                            <div class="z-stat-label-sm">Plant Size (MW)</div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="z-stat-card">
                                            <div class="z-stat-num">{{ $item->available_capacity ?? '—' }}</div>
                                            <div class="z-stat-label-sm">Avail. Capacity</div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="z-stat-card">
                                            <div class="z-stat-num" style="font-size: 0.95rem;">{{ $item->voltage_level ?? '—' }}</div>
                                            <div class="z-stat-label-sm">Voltage Level</div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Basic Information --}}
                                <div class="z-section-title"><i class="fas fa-info-circle mr-1"></i> Basic Information</div>
                                <div class="row mb-2">
                                    <div class="col-md-6 mb-2">
                                        <div class="z-label">Name of IPP</div>
                                        <div class="z-detail-value">{{ $item->name_of_ipp ?? '—' }}</div>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <div class="z-label">Invoiced Services</div>
                                        <div class="z-detail-value">{{ $item->invoiced_services ?? '—' }}</div>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <div class="z-label">Application Date</div>
                                        <div class="z-detail-value">{{ $item->date_of_application ? $item->date_of_application->format('M d, Y') : '—' }}</div>
                                    </div>
                                </div>

                                {{-- Location --}}
                                <div class="z-section-title"><i class="fas fa-map-marker-alt mr-1"></i> Location & Connection</div>
                                <div class="row mb-2">
                                    <div class="col-md-4 mb-2">
                                        <div class="z-label">Province</div>
                                        <div class="z-detail-value">{{ $item->province->province ?? '—' }}</div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="z-label">District</div>
                                        <div class="z-detail-value">{{ $item->districts->district ?? '—' }}</div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="z-label">Connection Point</div>
                                        <div class="z-detail-value">{{ $item->proposed_connection_point ?? '—' }}</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-3 mb-2">
                                        <div class="z-label">Preferred Conn. Level</div>
                                        <div class="z-detail-value">{{ $item->preferred_connection_level ?? '—' }}</div>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <div class="z-label">LCOE / Tariff</div>
                                        <div class="z-detail-value">{{ $item->ipp_tariff ?? '—' }}</div>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <div class="z-label">Connection Date (Est.)</div>
                                        <div class="z-detail-value">{{ $item->date_of_connection ? $item->date_of_connection->format('M d, Y') : '—' }}</div>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <div class="z-label">Expiry Date</div>
                                        <div class="z-detail-value">{{ $item->expiry_connection_point ?? '—' }}</div>
                                    </div>
                                </div>

                                {{-- Status & Engagement --}}
                                <div class="z-section-title"><i class="fas fa-chart-line mr-1"></i> Status & Engagement</div>
                                <div class="row mb-2">
                                    <div class="col-md-4 mb-2">
                                        <div class="z-label">Status of Engagement</div>
                                        <div class="z-detail-value">
                                            @if($item->status_of_engagement)
                                                <span style="display: inline-block; padding: 0.2rem 0.6rem; border-radius: 20px; font-size: 0.78rem; font-weight: 600; background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;">
                                                    {{ $item->status_of_engagement }}
                                                </span>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="z-label">Type of Venture</div>
                                        <div class="z-detail-value">{{ $item->ventures->venture_type ?? '—' }}</div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="z-label">Expected Commercial</div>
                                        <div class="z-detail-value">{{ $item->expected_commercial ?? '—' }}</div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-12 mb-2">
                                        <div class="z-label">Comments / Updates</div>
                                        <div class="z-detail-value" style="font-size: 0.85rem; font-weight: 400;">{{ $item->updates_on_engagements ?? '—' }}</div>
                                    </div>
                                </div>

                                {{-- Contact --}}
                                <div class="z-section-title"><i class="fas fa-user-tie mr-1"></i> Contact Person</div>
                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <div class="z-label">Name</div>
                                        <div class="z-detail-value">{{ $item->contact_person_name ?? '—' }}</div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="z-label">Email</div>
                                        <div class="z-detail-value">
                                            @if($item->contact_person_email)
                                                <a href="mailto:{{ $item->contact_person_email }}" style="color: var(--z-green); text-decoration: none;">
                                                    <i class="fas fa-envelope mr-1" style="font-size: 0.75rem;"></i>{{ $item->contact_person_email }}
                                                </a>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="z-label">Phone</div>
                                        <div class="z-detail-value">
                                            @if($item->contact_person_phone)
                                                <i class="fas fa-phone mr-1" style="font-size: 0.75rem; color: var(--z-green);"></i>{{ $item->contact_person_phone }}
                                            @else
                                                <span class="text-muted">—</span>
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
                        <div class="card z-card">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h4><i class="fas fa-file-contract mr-2" style="color: var(--z-gold);"></i> Contract Files</h4>
                                <span style="font-size: 0.78rem; color: #6b7280; font-weight: 600;">{{ count($contracts) }} file(s)</span>
                            </div>
                            <div class="card-body">
                                @if(count($contracts) > 0)
                                    @foreach($contracts as $file)
                                        <div class="z-file-card">
                                            <div style="width: 40px; height: 40px; border-radius: 8px; background: linear-gradient(135deg, #ecfdf5, #d1fae5); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                <i class="fas {{ $file->icon_class }}"></i>
                                            </div>
                                            <div style="flex: 1; min-width: 0;">
                                                <div style="font-size: 0.82rem; font-weight: 600; color: #1a2332; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $file->display_name }}">
                                                    {{ $file->display_name }}
                                                </div>
                                                <div style="font-size: 0.72rem; color: #94a3b8;">
                                                    {{ $file->human_size }} &bull; {{ strtoupper($file->ext ?? 'N/A') }}
                                                    @if($file->uploader)
                                                        &bull; {{ $file->uploader->name }}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="d-flex" style="gap: 4px;">
                                                <a href="{{ $file->download_url }}" target="_blank" class="z-action z-action-view" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <button wire:click="deleteFile({{ $file->id }})" class="z-action z-action-delete" title="Delete" onclick="return confirm('Delete this file?')">
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