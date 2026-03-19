{{-- Inline Styles --}}
<style>
:root {
    --zesco-green: #14984f;
    --zesco-green-dark: #2b9457;
    --zesco-green-light: #00895A;
    --zesco-gold: #FFB223;
    --zesco-gold-dark: #e09a00;
}

/* ===== Dashboard Header ===== */
.dashboard-header {
    background: linear-gradient(135deg, var(--zesco-green-dark) 0%, var(--zesco-green) 60%, var(--zesco-green-light) 100%);
    border-radius: 12px;
    padding: 1.75rem 2rem;
    margin-bottom: 1.5rem;
    color: #fff;
    position: relative;
    overflow: hidden;
}
.dashboard-header::before {
    content: '';
    position: absolute;
    top: -40%;
    right: -10%;
    width: 300px;
    height: 300px;
    background: radial-gradient(ellipse, rgba(255,255,255,0.07) 0%, transparent 70%);
}
.dashboard-header h1 {
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0;
}
.dashboard-header p {
    margin: 0.25rem 0 0;
    opacity: 0.85;
    font-size: 0.9rem;
}
.dashboard-header .welcome-name {
    color: var(--zesco-gold);
    font-weight: 700;
}

/* ===== Technology Cards ===== */
.tech-card {
    border-radius: 12px;
    padding: 1.25rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    background: #fff;
    border: 1px solid #e9ecef;
    transition: all 0.25s ease;
    text-decoration: none !important;
    color: inherit !important;
    margin-bottom: 1rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    cursor: pointer;
    user-select: none;
}
.tech-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 28px rgba(0,0,0,0.12);
    border-color: transparent;
}
.tech-card.active {
    border-color: var(--zesco-green);
    box-shadow: 0 4px 16px rgba(20,152,79,0.2);
    background: #f0fdf4;
}
.tech-card .tech-icon {
    width: 52px;
    height: 52px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.35rem;
    flex-shrink: 0;
    color: #fff;
}
.tech-card .tech-info {
    flex: 1;
}
.tech-card .tech-label {
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.03em;
    color: #6c757d;
}
.tech-card .tech-count {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a2332;
}
.tech-card .tech-arrow {
    color: #cbd5e1;
    transition: all 0.2s;
}
.tech-card:hover .tech-arrow {
    color: var(--zesco-gold);
    transform: translateX(4px);
}

/* ===== Icon Gradients ===== */
.bg-solar { background: linear-gradient(135deg, #FFB223, #d97706); }
.bg-wind { background: linear-gradient(135deg, #10b981, #059669); }
.bg-geothermal { background: linear-gradient(135deg, #ef4444, #dc2626); }
.bg-hybrid { background: linear-gradient(135deg, #3b82f6, #2563eb); }
.bg-biomass { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
.bg-waste { background: linear-gradient(135deg, #6b7280, #4b5563); }

/* ===== Summary Bar ===== */
.summary-bar {
    background: #fff;
    border-radius: 12px;
    padding: 1rem 1.5rem;
    display: flex;
    gap: 2rem;
    margin-bottom: 1.5rem;
    border: 1px solid #e9ecef;
    flex-wrap: wrap;
    align-items: center;
}
.summary-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.summary-item .summary-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: var(--zesco-gold);
}
.summary-item .summary-label {
    font-size: 0.8rem;
    color: #6c757d;
}
.summary-item .summary-value {
    font-weight: 700;
    color: #1a2332;
}

/* ===== IPP Table Card ===== */
.ipp-table-card {
    border-radius: 12px;
    border: 1px solid #e9ecef;
    overflow: hidden;
}
.ipp-table-card .card-header {
    background: #fff;
    border-bottom: 1px solid #e9ecef;
    padding: 1rem 1.5rem;
}
.ipp-table-card .card-header h3 {
    font-size: 1.05rem;
    font-weight: 700;
    color: #1a2332;
}

/* ===== BUTTON (ZESCO ORANGE CTA) ===== */
.btn-new-ipp {
    background: linear-gradient(135deg, var(--zesco-gold), #f59e0b);
    color: #fff;
    border-radius: 8px;
    padding: 0.5rem 1.25rem;
    font-weight: 600;
    font-size: 0.85rem;
    transition: all 0.2s;
    border: none;
    display: inline-block;
    text-decoration: none !important;
}
.btn-new-ipp:hover {
    background: linear-gradient(135deg, var(--zesco-gold-dark), #d97706);
    box-shadow: 0 4px 12px rgba(255,178,35,0.35);
    transform: translateY(-1px);
    color: #fff;
}

/* ===== ACTION BUTTON ===== */
.action-btn {
    border: 1.5px solid var(--zesco-green);
    color: var(--zesco-green);
    background: transparent;
    border-radius: 6px;
    padding: 0.25rem 0.75rem;
    font-size: 0.82rem;
    font-weight: 600;
    transition: all 0.2s;
}
.action-btn:hover {
    background: var(--zesco-green);
    color: #fff;
}

/* ===== TABLE ===== */
.lw-table thead th {
    font-size: 0.78rem;
    font-weight: 700;
    color: #64748b;
    border-bottom: 2px solid #e2e8f0;
    cursor: pointer;
    user-select: none;
    white-space: nowrap;
}
.lw-table thead th:hover {
    color: var(--zesco-green);
}
.lw-table tbody tr:hover {
    background: #fff7ed;
}

/* ===== STATUS BADGE ===== */
.status-badge {
    background: rgba(255,178,35,0.15);
    color: #b45309;
    padding: 0.2rem 0.6rem;
    border-radius: 6px;
    font-size: 0.8rem;
    font-weight: 600;
    display: inline-block;
}

/* ===== ALERTS ===== */
.dashboard-alert {
    border-radius: 10px;
    padding: 0.875rem 1.25rem;
    font-size: 0.9rem;
}

/* ===== SEARCH BOX ===== */
.lw-search-box {
    position: relative;
    max-width: 320px;
}
.lw-search-box input {
    padding: 0.55rem 0.85rem 0.55rem 2.5rem;
    border-radius: 8px;
    border: 1.5px solid #e2e8f0;
    font-size: 0.875rem;
    transition: border-color 0.2s;
    width: 100%;
}
.lw-search-box input:focus {
    border-color: var(--zesco-green);
    box-shadow: 0 0 0 3px rgba(20,152,79,0.1);
    outline: none;
}
.lw-search-box .search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    pointer-events: none;
}

/* ===== SORT ICON ===== */
.sort-icon {
    font-size: 0.7rem;
    margin-left: 4px;
    opacity: 0.5;
}
.sort-icon.active {
    opacity: 1;
    color: var(--zesco-green);
}

/* ===== FILTER TAG ===== */
.filter-tag {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    background: #ecfdf5;
    border: 1px solid #a7f3d0;
    color: #065f46;
    padding: 0.3rem 0.75rem;
    border-radius: 20px;
    font-size: 0.825rem;
    font-weight: 600;
}
.filter-tag .remove-filter {
    cursor: pointer;
    opacity: 0.6;
    transition: opacity 0.2s;
}
.filter-tag .remove-filter:hover {
    opacity: 1;
}

/* ===== PER PAGE SELECT ===== */
.per-page-select {
    border-radius: 6px;
    border: 1.5px solid #e2e8f0;
    padding: 0.35rem 0.5rem;
    font-size: 0.825rem;
    color: #374151;
}
.per-page-select:focus {
    border-color: var(--zesco-green);
    outline: none;
}

/* ===== LOADING OVERLAY ===== */
.lw-loading-overlay {
    position: absolute;
    inset: 0;
    background: rgba(255,255,255,0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
    border-radius: 12px;
}
</style>

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
                        <a href="{{ route('independent-producer.create') }}" class="btn-new-ipp">
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
                                                    <a class="dropdown-item" href="{{ route('independent-producer.show', $item) }}">
                                                        <i class="fas fa-eye mr-2 text-muted"></i> View
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('independent-producer.edit', $item->id) }}">
                                                        <i class="fas fa-edit mr-2 text-muted"></i> Edit
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item text-danger" href="{{ route('independent-producer.destroy', $item->id) }}">
                                                        <i class="fas fa-trash-alt mr-2"></i> Delete
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
                    <a href="{{ route('independent-producer.create') }}" class="btn-new-ipp">
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
