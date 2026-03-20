
<div>
    <!-- Page Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="z-page-header">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div>
                        <h1><i class="fas fa-chart-bar mr-2" style="color: var(--z-gold)"></i>Reports & Analytics</h1>
                        <p>Comprehensive overview of Independent Power Producers data, charts and statistics</p>
                    </div>
                    <div class="d-flex" style="gap: 0.5rem;">
                        @if($filterTechnology || $filterProvince || $filterStatus || $filterVenture || $search)
                            <button wire:click="clearFilters" class="btn-zesco-outline" style="color: #fff; border-color: rgba(255,255,255,0.4);">
                                <i class="fas fa-times"></i> Clear Filters
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

            <!-- Tab Navigation -->
            <div class="z-tabs">
                <button wire:click="setTab('overview')" class="z-tab {{ $activeTab === 'overview' ? 'active' : '' }}">
                    <i class="fas fa-th-large"></i> Overview
                </button>
                <button wire:click="setTab('table')" class="z-tab {{ $activeTab === 'table' ? 'active' : '' }}">
                    <i class="fas fa-table"></i> Data Table
                </button>
                <button wire:click="setTab('charts')" class="z-tab {{ $activeTab === 'charts' ? 'active' : '' }}">
                    <i class="fas fa-chart-pie"></i> Charts & Graphs
                </button>
            </div>

            {{-- ═══════════════════════════════════════════
                TAB 1: OVERVIEW
            ═══════════════════════════════════════════ --}}
            @if($activeTab === 'overview')

                <!-- Summary Stats -->
                <div class="row mb-4">
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="z-stat-card z-stat-green">
                            <i class="fas fa-industry stat-icon"></i>
                            <div class="stat-value">{{ number_format($stats['totalCount']) }}</div>
                            <div class="stat-label">Total IPPs</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="z-stat-card z-stat-gold">
                            <i class="fas fa-bolt stat-icon"></i>
                            <div class="stat-value">{{ number_format($stats['totalCapacity'], 1) }}</div>
                            <div class="stat-label">Total Capacity (MW)</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="z-stat-card z-stat-blue">
                            <i class="fas fa-map-marked-alt stat-icon"></i>
                            <div class="stat-value">{{ $stats['byProvince']->count() }}</div>
                            <div class="stat-label">Provinces Covered</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="z-stat-card z-stat-purple">
                            <i class="fas fa-solar-panel stat-icon"></i>
                            <div class="stat-value">{{ $stats['byTechnology']->count() }}</div>
                            <div class="stat-label">Technology Types</div>
                        </div>
                    </div>
                </div>

                <!-- Technology Breakdown -->
                <div class="z-section-title"><i class="fas fa-solar-panel"></i> By Technology</div>
                <div class="row mb-4">
                    @php
                        $techIcons = [
                            'SOLAR' => ['fas fa-sun', '#f59e0b', '#fffbeb'],
                            'WIND' => ['fas fa-wind', '#3b82f6', '#eff6ff'],
                            'GEOTHERMAL' => ['fas fa-fire', '#ef4444', '#fef2f2'],
                            'HYDRO' => ['fas fa-water', '#06b6d4', '#ecfeff'],
                            'HYBRID' => ['fas fa-sync-alt', '#8b5cf6', '#f5f3ff'],
                            'BIOMASS' => ['fas fa-leaf', '#22c55e', '#f0fdf4'],
                            'WASTE OF ENERGY' => ['fas fa-recycle', '#6b7280', '#f9fafb'],
                        ];
                    @endphp
                    @foreach($stats['byTechnology'] as $tech)
                        @php
                            $icon = $techIcons[$tech->engagement_number] ?? ['fas fa-bolt', '#14984f', '#ecfdf5'];
                        @endphp
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                            <div class="z-tech-chip w-100 {{ $filterTechnology === $tech->engagement_number ? 'active' : '' }}"
                                 wire:click="$set('filterTechnology', '{{ $filterTechnology === $tech->engagement_number ? '' : $tech->engagement_number }}')"
                                 style="cursor: pointer;">
                                <div class="chip-icon" style="background: {{ $icon[2] }}; color: {{ $icon[1] }};">
                                    <i class="{{ $icon[0] }}"></i>
                                </div>
                                <div style="flex: 1;">
                                    <div style="font-size: 0.82rem; font-weight: 700;">{{ $tech->engagement_number ?? 'N/A' }}</div>
                                    <div style="font-size: 0.72rem; color: #6b7280;">{{ number_format($tech->total_mw ?? 0, 1) }} MW</div>
                                </div>
                                <span class="chip-count">{{ $tech->total }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Breakdown Tables Row -->
                <div class="row">
                    <!-- By Province -->
                    <div class="col-lg-6 mb-4">
                        <div class="card z-card">
                            <div class="card-header">
                                <h3><i class="fas fa-map-marked-alt mr-2" style="color: var(--z-green);"></i> By Province</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
                                    <table class="table z-break-table">
                                        <thead>
                                            <tr>
                                                <th>Province</th>
                                                <th class="text-center">IPPs</th>
                                                <th class="text-right">Total MW</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($stats['byProvince'] as $prov)
                                                <tr>
                                                    <td>
                                                        <span class="z-badge-province">
                                                            <i class="fas fa-map-marker-alt" style="font-size: 0.65rem;"></i>
                                                            {{ $prov->province_name }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center" style="font-weight: 700;">{{ $prov->total }}</td>
                                                    <td class="text-right"><span class="z-mw">{{ number_format($prov->total_mw ?? 0, 1) }}</span></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr style="border-top: 2px solid #e2e8f0;">
                                                <td style="font-weight: 700;">Total</td>
                                                <td class="text-center" style="font-weight: 700;">{{ $stats['byProvince']->sum('total') }}</td>
                                                <td class="text-right"><span class="z-mw">{{ number_format($stats['byProvince']->sum('total_mw'), 1) }}</span></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- By Venture Type -->
                    <div class="col-lg-6 mb-4">
                        <div class="card z-card">
                            <div class="card-header">
                                <h3><i class="fas fa-handshake mr-2" style="color: var(--z-gold);"></i> By Venture Type</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive" style="max-height: 350px; overflow-y: auto;">
                                    <table class="table z-break-table">
                                        <thead>
                                            <tr>
                                                <th>Venture</th>
                                                <th class="text-center">IPPs</th>
                                                <th class="text-right">Total MW</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($stats['byVenture'] as $vent)
                                                <tr>
                                                    <td>
                                                        <span class="z-badge-venture">
                                                            <i class="fas fa-handshake" style="font-size: 0.6rem;"></i>
                                                            {{ $vent->venture_name }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center" style="font-weight: 700;">{{ $vent->total }}</td>
                                                    <td class="text-right"><span class="z-mw">{{ number_format($vent->total_mw ?? 0, 1) }}</span></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr style="border-top: 2px solid #e2e8f0;">
                                                <td style="font-weight: 700;">Total</td>
                                                <td class="text-center" style="font-weight: 700;">{{ $stats['byVenture']->sum('total') }}</td>
                                                <td class="text-right"><span class="z-mw">{{ number_format($stats['byVenture']->sum('total_mw'), 1) }}</span></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Breakdown -->
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card z-card">
                            <div class="card-header">
                                <h3><i class="fas fa-tasks mr-2" style="color: var(--z-green);"></i> By Engagement Status</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table z-break-table">
                                        <thead>
                                            <tr>
                                                <th>Status</th>
                                                <th class="text-center">IPPs</th>
                                                <th class="text-right">Total MW</th>
                                                <th style="width: 40%;">Distribution</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $maxStatus = $stats['byStatus']->max('total') ?: 1; @endphp
                                            @foreach($stats['byStatus'] as $st)
                                                <tr>
                                                    <td>
                                                        <span class="z-badge-status">
                                                            <i class="fas fa-circle" style="font-size: 0.45rem;"></i>
                                                            {{ $st->status_of_engagement ?? 'N/A' }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center" style="font-weight: 700;">{{ $st->total }}</td>
                                                    <td class="text-right"><span class="z-mw">{{ number_format($st->total_mw ?? 0, 1) }}</span></td>
                                                    <td>
                                                        <div style="background: #f1f5f9; border-radius: 6px; height: 22px; overflow: hidden;">
                                                            <div style="background: linear-gradient(135deg, var(--z-green), #22c55e); height: 100%; border-radius: 6px; width: {{ ($st->total / $maxStatus) * 100 }}%; transition: width 0.4s;"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endif

            {{-- ═══════════════════════════════════════════
                TAB 2: DATA TABLE
            ═══════════════════════════════════════════ --}}
            @if($activeTab === 'table')

                <div class="card z-card" style="position: relative;">
                    <div wire:loading.flex class="z-loading">
                        <div class="spinner-border text-success"><span class="sr-only">Loading...</span></div>
                    </div>

                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between flex-wrap" style="gap: 0.75rem;">
                            <h3>
                                <i class="fas fa-table mr-2" style="color: var(--z-green)"></i>IPP Data
                                <span class="z-count ml-2">{{ $producers->total() }}</span>
                            </h3>
                        </div>
                        <div class="d-flex align-items-center flex-wrap mt-3" style="gap: 0.6rem;">
                            <select wire:model="filterTechnology" class="z-filter-select">
                                <option value="">All Technologies</option>
                                @foreach($technologies as $tech)
                                    <option value="{{ $tech }}">{{ $tech }}</option>
                                @endforeach
                            </select>
                            <select wire:model="filterProvince" class="z-filter-select">
                                <option value="">All Provinces</option>
                                @foreach($provinces as $prov)
                                    <option value="{{ $prov->id }}">{{ $prov->province }}</option>
                                @endforeach
                            </select>
                            <select wire:model="filterVenture" class="z-filter-select">
                                <option value="">All Ventures</option>
                                @foreach($ventures as $vent)
                                    <option value="{{ $vent->id }}">{{ $vent->venture_type }}</option>
                                @endforeach
                            </select>
                            <div class="z-search">
                                <i class="fas fa-search si"></i>
                                <input type="text" wire:model.debounce.300ms="search" placeholder="Search IPP name, ref...">
                            </div>
                            <select wire:model="perPage" class="z-per-page">
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                            @if($filterTechnology || $filterProvince || $filterStatus || $filterVenture || $search)
                                <button wire:click="clearFilters" class="btn-zesco-outline" style="padding: 0.45rem 0.75rem; font-size: 0.8rem;">
                                    <i class="fas fa-times"></i> Clear
                                </button>
                            @endif
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover z-table mb-0">
                                <thead>
                                    <tr>
                                        <th wire:click="sortBy('system_ref')">
                                            Ref
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
                                            IPP Name
                                            @if($sortField === 'name_of_ipp')
                                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} sort-icon active"></i>
                                            @else
                                                <i class="fas fa-sort sort-icon"></i>
                                            @endif
                                        </th>
                                        <th>Venture</th>
                                        <th wire:click="sortBy('size_of_plant')">
                                            Size (MW)
                                            @if($sortField === 'size_of_plant')
                                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} sort-icon active"></i>
                                            @else
                                                <i class="fas fa-sort sort-icon"></i>
                                            @endif
                                        </th>
                                        <th>Province</th>
                                        <th>District</th>
                                        <th>Available Cap.</th>
                                        <th>Status</th>
                                        <th>Contact</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($producers as $item)
                                        <tr>
                                            <td style="font-weight: 600; color: #374151;">{{ $item->system_ref ?? '-' }}</td>
                                            <td>
                                                <span class="z-badge-tech">
                                                    <i class="fas fa-bolt" style="font-size: 0.6rem;"></i>
                                                    {{ $item->engagement_number ?? '-' }}
                                                </span>
                                            </td>
                                            <td style="font-weight: 600; max-width: 180px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                {{ $item->name_of_ipp ?? '-' }}
                                            </td>
                                            <td>
                                                @if($item->ventures)
                                                    <span class="z-badge-venture">{{ $item->ventures->venture_type }}</span>
                                                @else
                                                    <span style="color: #94a3b8;">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="z-mw">{{ $item->size_of_plant ?? '-' }}</span>
                                                <span style="font-size: 0.7rem; color: #6b7280;">{{ $item->size_of_plant_unit }}</span>
                                            </td>
                                            <td>
                                                <span class="z-badge-province">
                                                    <i class="fas fa-map-marker-alt" style="font-size: 0.55rem;"></i>
                                                    {{ $item->province->province ?? '-' }}
                                                </span>
                                            </td>
                                            <td style="font-size: 0.8rem; color: #374151;">{{ $item->districts->district ?? '-' }}</td>
                                            <td style="font-size: 0.8rem;">{{ $item->available_capacity ?? '-' }}</td>
                                            <td>
                                                @if($item->status_of_engagement)
                                                    <span class="z-badge-status">
                                                        <i class="fas fa-circle" style="font-size: 0.35rem;"></i>
                                                        {{ $item->status_of_engagement }}
                                                    </span>
                                                @else
                                                    <span style="color: #94a3b8;">-</span>
                                                @endif
                                            </td>
                                            <td style="font-size: 0.78rem; color: #6b7280; max-width: 130px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                                {{ $item->contact_person_name ?? '-' }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center py-4" style="color: #94a3b8;">
                                                <i class="fas fa-search fa-2x mb-2 d-block"></i>
                                                No IPPs found matching your filters.
                                                <a href="#" wire:click.prevent="clearFilters" style="color: var(--z-green);">Clear filters</a>
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
                            @if($filterTechnology || $filterProvince || $filterVenture || $search)
                                (filtered)
                            @endif
                        </span>
                        {{ $producers->links() }}
                    </div>
                </div>

            @endif

            {{-- ═══════════════════════════════════════════
                TAB 3: CHARTS & GRAPHS
            ═══════════════════════════════════════════ --}}
            @if($activeTab === 'charts')

                <!-- Chart Filters -->
                <div class="card z-card mb-4">
                    <div class="card-body" style="padding: 1rem 1.5rem;">
                        <div class="d-flex align-items-center flex-wrap" style="gap: 0.75rem;">
                            <span style="font-size: 0.82rem; font-weight: 700; color: #1a2332;">
                                <i class="fas fa-filter mr-1" style="color: var(--z-green);"></i> Filter Charts:
                            </span>
                            <select wire:model="filterTechnology" class="z-filter-select">
                                <option value="">All Technologies</option>
                                @foreach($technologies as $tech)
                                    <option value="{{ $tech }}">{{ $tech }}</option>
                                @endforeach
                            </select>
                            <select wire:model="filterVenture" class="z-filter-select">
                                <option value="">All Ventures</option>
                                @foreach($ventures as $vent)
                                    <option value="{{ $vent->id }}">{{ $vent->venture_type }}</option>
                                @endforeach
                            </select>
                            @if($filterTechnology || $filterVenture)
                                <button wire:click="clearFilters" class="btn-zesco-outline" style="padding: 0.4rem 0.75rem; font-size: 0.8rem;">
                                    <i class="fas fa-times"></i> Clear
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Technology Capacity Pie Chart -->
                    <div class="col-lg-6 mb-4">
                        <div class="card z-card">
                            <div class="card-header">
                                <h3><i class="fas fa-chart-pie mr-2" style="color: var(--z-gold);"></i> Capacity by Technology (MW)</h3>
                            </div>
                            <div class="card-body">
                                <div id="techPieChart" class="z-chart-container"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Venture Type Pie Chart -->
                    <div class="col-lg-6 mb-4">
                        <div class="card z-card">
                            <div class="card-header">
                                <h3><i class="fas fa-chart-pie mr-2" style="color: var(--z-green);"></i> IPPs by Venture Type</h3>
                            </div>
                            <div class="card-body">
                                <div id="venturePieChart" class="z-chart-container"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Province Bar Chart -->
                    <div class="col-lg-6 mb-4">
                        <div class="card z-card">
                            <div class="card-header">
                                <h3><i class="fas fa-chart-bar mr-2" style="color: #3b82f6;"></i> IPPs by Province</h3>
                            </div>
                            <div class="card-body">
                                <div id="provinceBarChart" class="z-chart-container"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Status Bar Chart -->
                    <div class="col-lg-6 mb-4">
                        <div class="card z-card">
                            <div class="card-header">
                                <h3><i class="fas fa-chart-bar mr-2" style="color: #8b5cf6;"></i> IPPs by Engagement Status</h3>
                            </div>
                            <div class="card-body">
                                <div id="statusBarChart" class="z-chart-container"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Province Capacity Bar -->
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card z-card">
                            <div class="card-header">
                                <h3><i class="fas fa-bolt mr-2" style="color: var(--z-gold);"></i> Total Capacity by Province (MW)</h3>
                            </div>
                            <div class="card-body">
                                <div id="provinceCapacityChart" class="z-chart-container" style="height: 320px;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <script src="{{ asset('echarts/dist/echarts.js') }}"></script>
                <script>
                    document.addEventListener('livewire:load', function () {
                        renderCharts();
                    });

                    // Re-render charts after Livewire updates
                    document.addEventListener('livewire:update', function () {
                        setTimeout(renderCharts, 100);
                    });

                    function renderCharts() {
                        var techPieData = @json($chartData['techPie']);
                        var venturePieData = @json($chartData['venturePie']);
                        var provinceBarData = @json($chartData['provinceBar']);
                        var statusBarData = @json($chartData['statusBar']);

                        var zescoColors = ['#14984f', '#FFB223', '#3b82f6', '#8b5cf6', '#ef4444', '#06b6d4', '#f97316', '#22c55e', '#ec4899', '#6366f1'];

                        // ── Technology Capacity Pie ──
                        var techEl = document.getElementById('techPieChart');
                        if (techEl) {
                            var techChart = echarts.init(techEl);
                            techChart.setOption({
                                color: zescoColors,
                                tooltip: { trigger: 'item', formatter: '{b}: {c} MW ({d}%)' },
                                legend: { orient: 'vertical', left: 'left', top: 'center', textStyle: { fontSize: 12 } },
                                series: [{
                                    type: 'pie', radius: ['35%', '65%'], center: ['60%', '50%'],
                                    label: { formatter: '{b}\n{c} MW', fontSize: 11 },
                                    emphasis: { itemStyle: { shadowBlur: 10, shadowOffsetX: 0, shadowColor: 'rgba(0,0,0,0.3)' } },
                                    data: techPieData
                                }]
                            });
                            window.addEventListener('resize', function () { techChart.resize(); });
                        }

                        // ── Venture Pie ──
                        var ventureEl = document.getElementById('venturePieChart');
                        if (ventureEl) {
                            var ventureChart = echarts.init(ventureEl);
                            ventureChart.setOption({
                                color: zescoColors.slice().reverse(),
                                tooltip: { trigger: 'item', formatter: '{b}: {c} IPPs ({d}%)' },
                                legend: { orient: 'vertical', left: 'left', top: 'center', textStyle: { fontSize: 12 } },
                                series: [{
                                    type: 'pie', radius: ['35%', '65%'], center: ['60%', '50%'],
                                    label: { formatter: '{b}\n{c}', fontSize: 11 },
                                    emphasis: { itemStyle: { shadowBlur: 10, shadowOffsetX: 0, shadowColor: 'rgba(0,0,0,0.3)' } },
                                    data: venturePieData
                                }]
                            });
                            window.addEventListener('resize', function () { ventureChart.resize(); });
                        }

                        // ── Province Bar ──
                        var provEl = document.getElementById('provinceBarChart');
                        if (provEl) {
                            var provChart = echarts.init(provEl);
                            provChart.setOption({
                                color: ['#14984f'],
                                tooltip: { trigger: 'axis', axisPointer: { type: 'shadow' } },
                                grid: { left: '3%', right: '4%', bottom: '3%', containLabel: true },
                                xAxis: { type: 'category', data: provinceBarData.map(function(i){ return i.name; }), axisLabel: { rotate: 30, fontSize: 11 } },
                                yAxis: { type: 'value', name: 'Count' },
                                series: [{
                                    type: 'bar', barWidth: '50%',
                                    data: provinceBarData.map(function(i){ return i.count; }),
                                    itemStyle: { borderRadius: [6, 6, 0, 0] }
                                }]
                            });
                            window.addEventListener('resize', function () { provChart.resize(); });
                        }

                        // ── Status Bar ──
                        var statusEl = document.getElementById('statusBarChart');
                        if (statusEl) {
                            var statusChart = echarts.init(statusEl);
                            statusChart.setOption({
                                color: ['#8b5cf6'],
                                tooltip: { trigger: 'axis', axisPointer: { type: 'shadow' } },
                                grid: { left: '3%', right: '4%', bottom: '3%', containLabel: true },
                                xAxis: { type: 'value', name: 'Count' },
                                yAxis: { type: 'category', data: statusBarData.map(function(i){ return i.name || 'N/A'; }), axisLabel: { fontSize: 11 } },
                                series: [{
                                    type: 'bar', barWidth: '60%',
                                    data: statusBarData.map(function(i){ return i.count; }),
                                    itemStyle: { borderRadius: [0, 6, 6, 0] }
                                }]
                            });
                            window.addEventListener('resize', function () { statusChart.resize(); });
                        }

                        // ── Province Capacity Bar ──
                        var provCapEl = document.getElementById('provinceCapacityChart');
                        if (provCapEl) {
                            var provCapChart = echarts.init(provCapEl);
                            provCapChart.setOption({
                                color: ['#FFB223'],
                                tooltip: { trigger: 'axis', axisPointer: { type: 'shadow' }, formatter: function(params) { return params[0].name + ': ' + (params[0].value || 0).toFixed(1) + ' MW'; } },
                                grid: { left: '3%', right: '4%', bottom: '3%', containLabel: true },
                                xAxis: { type: 'category', data: provinceBarData.map(function(i){ return i.name; }), axisLabel: { rotate: 30, fontSize: 11 } },
                                yAxis: { type: 'value', name: 'MW' },
                                series: [{
                                    type: 'bar', barWidth: '50%',
                                    data: provinceBarData.map(function(i){ return i.total_mw; }),
                                    itemStyle: { borderRadius: [6, 6, 0, 0] }
                                }]
                            });
                            window.addEventListener('resize', function () { provCapChart.resize(); });
                        }
                    }
                </script>

            @endif

        </div>
    </section>
</div>