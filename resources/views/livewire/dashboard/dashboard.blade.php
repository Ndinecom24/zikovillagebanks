
<!-- Bootstrap Icons for password modal -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<div>
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="dashboard-header">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div>
                        <h1><i class="fas fa-bolt mr-2" style="color: var(--zesco-gold)"></i>Renewable Energy Management System</h1>
                        <p>Welcome back, <span class="welcome-name">{{ Auth::user()->name }}</span> &mdash; here's your overview</p>
                    </div>
                    <div>
                        <a href="{{ route('independent-producer.index') }}" class="btn-new-ipp">
                            <i class="fas fa-plus mr-1"></i> New IPP
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">

            {{-- Flash Alerts --}}
            @if(session()->has('message'))
                <div class="alert alert-success dashboard-alert">
                    <i class="fas fa-check-circle"></i> {!! session()->get('message') !!}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-warning dashboard-alert">
                    <i class="fas fa-exclamation-triangle"></i> {!! session()->get('error') !!}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger dashboard-alert">
                    <i class="fas fa-times-circle"></i>
                    <ul class="mb-0 pl-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Technology Cards Grid --}}
            <div class="row">
                @php
                    $technologies = [
                        ['key' => 'SOLAR', 'label' => 'Solar', 'icon' => 'fas fa-sun', 'bg' => 'bg-solar'],
                        ['key' => 'WIND', 'label' => 'Wind', 'icon' => 'fas fa-wind', 'bg' => 'bg-wind'],
                        ['key' => 'GEOTHERMAL', 'label' => 'Geothermal', 'icon' => 'fas fa-industry', 'bg' => 'bg-geothermal'],
                        ['key' => 'HYBRID', 'label' => 'Hybrid', 'icon' => 'fas fa-water', 'bg' => 'bg-hybrid'],
                        ['key' => 'BIOMASS', 'label' => 'Biomass', 'icon' => 'fas fa-leaf', 'bg' => 'bg-biomass'],
                        ['key' => 'WASTE TO ENERGY', 'label' => 'Waste to Energy', 'icon' => 'fas fa-charging-station', 'bg' => 'bg-waste'],
                    ];
                @endphp
                @foreach($technologies as $tech)
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-2">
                        <div wire:click="filterByTechnology('{{ $tech['key'] }}')"
                             class="tech-card {{ $technologyFilter === $tech['key'] ? 'active' : '' }}">
                            <div class="tech-icon {{ $tech['bg'] }}"><i class="{{ $tech['icon'] }}"></i></div>
                            <div class="tech-info">
                                <div class="tech-label">{{ $tech['label'] }}</div>
                                <div class="tech-count">{{ number_format($technologyCounts[$tech['key']] ?? 0) }}</div>
                            </div>
                            <i class="fas fa-chevron-right tech-arrow"></i>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Summary Bar --}}
            <div class="summary-bar">
                <div class="summary-item">
                    <div class="summary-dot" style="background: var(--zesco-green)"></div>
                    <span class="summary-label">Total IPPs</span>
                    <span class="summary-value">{{ number_format($totalCount) }}</span>
                </div>
                <div class="summary-item">
                    <div class="summary-dot" style="background: var(--zesco-gold)"></div>
                    <span class="summary-label">Showing</span>
                    <span class="summary-value">{{ number_format($applications->total()) }}</span>
                </div>

                {{-- Active Filter Tag --}}
                @if(!empty($technologyFilter))
                    <div class="ml-auto">
                        <span class="filter-tag">
                            <i class="fas fa-filter"></i> {{ $technologyFilter }}
                            <span wire:click="clearFilter" class="remove-filter"><i class="fas fa-times"></i></span>
                        </span>
                    </div>
                @endif
            </div>

            {{-- IPP Data Table --}}
            <div class="card ipp-table-card" style="position: relative;">
                {{-- Livewire loading indicator --}}
                <div wire:loading.flex class="lw-loading-overlay">
                    <div class="spinner-border text-success" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

                <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="gap: 0.75rem;">
                    <h3 class="mb-0"><i class="fas fa-table mr-2" style="color: var(--zesco-green)"></i>Independent Power Producers</h3>
                    <div class="d-flex align-items-center" style="gap: 0.75rem;">
                        {{-- Search --}}
                        <div class="lw-search-box">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" wire:model.debounce.300ms="search" placeholder="Search IPPs...">
                        </div>
                        {{-- Per Page --}}
                        <select wire:model="perPage" class="per-page-select">
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover lw-table mb-0">
                            <thead>
                                <tr>
                                    <th wire:click="sortBy('system_ref')">
                                        Ref No
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
                                        Name Of IPP
                                        @if($sortField === 'name_of_ipp')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} sort-icon active"></i>
                                        @else
                                            <i class="fas fa-sort sort-icon"></i>
                                        @endif
                                    </th>
                                    <th>Type of Venture</th>
                                    <th wire:click="sortBy('size_of_plant')">
                                        Size of Plant [MW]
                                        @if($sortField === 'size_of_plant')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} sort-icon active"></i>
                                        @else
                                            <i class="fas fa-sort sort-icon"></i>
                                        @endif
                                    </th>
                                    <th>Province</th>
                                    <th>District</th>
                                    <th wire:click="sortBy('available_capacity')">
                                        Available Capacity
                                        @if($sortField === 'available_capacity')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} sort-icon active"></i>
                                        @else
                                            <i class="fas fa-sort sort-icon"></i>
                                        @endif
                                    </th>
                                    <th wire:click="sortBy('voltage_level')">
                                        Voltage Level
                                        @if($sortField === 'voltage_level')
                                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} sort-icon active"></i>
                                        @else
                                            <i class="fas fa-sort sort-icon"></i>
                                        @endif
                                    </th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($applications as $item)
                                    <tr>
                                        <td>{{ $item->system_ref ?? 'N/A' }}</td>
                                        <td>{{ $item->engagement_number ?? 'N/A' }}</td>
                                        <td><strong>{{ $item->name_of_ipp ?? 'N/A' }}</strong></td>
                                        <td>{{ $item->ventures->venture_type ?? 'N/A' }}</td>
                                        <td>{{ $item->size_of_plant ?? 'N/A' }} {{ $item->size_of_plant_unit ?? '' }}</td>
                                        <td>{{ $item->province->province ?? 'N/A' }}</td>
                                        <td>{{ $item->districts->district ?? 'N/A' }}</td>
                                        <td>{{ $item->available_capacity ?? 'N/A' }}</td>
                                        <td>{{ $item->voltage_level ?? 'N/A' }}</td>
                                        <td><span class="status-badge">{{ $item->status_of_engagement ?? 'N/A' }}</span></td>
                                        <td>
                                            <div class="input-group-prepend">
                                                <button type="button" class="action-btn dropdown-toggle" data-toggle="dropdown">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ route('independent-producer.show', $item->id) }}">
                                                        <i class="fas fa-eye mr-2 text-muted"></i> View
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('independent-producer.show', $item->id) }}">
                                                        <i class="fas fa-edit mr-2 text-muted"></i> Edit
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center py-4">
                                            <div style="color: #94a3b8;">
                                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                                @if(!empty($search) || !empty($technologyFilter))
                                                    No results found. <a href="#" wire:click.prevent="clearFilter" style="color: var(--zesco-green);">Clear filters</a>
                                                @else
                                                    No IPPs registered yet.
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Pagination & Footer --}}
                <div class="card-footer bg-white border-top d-flex align-items-center justify-content-between flex-wrap" style="border-radius: 0 0 12px 12px; gap: 0.75rem;">
                    <a href="{{ route('independent-producer.index') }}" class="btn-new-ipp">
                        <i class="fas fa-plus mr-1"></i> New IPP
                    </a>
                    <div>
                        {{ $applications->links() }}
                    </div>
                </div>
            </div>

        </div>
        <!--/. container-fluid -->

        {{-- Password Change Modal --}}
        @include('password-reset-modal.password_reset_modal')
    </section>
</div>

{{-- Password force-change modal trigger --}}
<script>
    document.addEventListener('livewire:load', function () {
        var showModal = @json($showPasswordModal);
        if (showModal) {
            $('#modal-change-password').modal({ backdrop: 'static', keyboard: false });
            $('#modal-change-password').modal('show');
        }
    });
</script>
