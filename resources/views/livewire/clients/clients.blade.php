<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <section class="content py-3 px-3">
        {{-- ===== Page Header ===== --}}
        <div class="z-page-header mb-3">
            <h1><i class="fas fa-folder-open"></i> Client Management</h1>
            <p>Manage client profiles</p>
        </div>

        {{-- ===== Flash Message ===== --}}
        @if(session()->has('message'))
            <div class="z-alert-success alert alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-2"></i> {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        @endif

        {{-- ===== Stat Cards ===== --}}
        <div class="row mb-3">
            <div class="col-lg-3 col-md-6 mb-2">
                <div class="z-stat-card z-stat-green">
                    <div class="stat-icon"><i class="fas fa-file"></i></div>
                    <div>
                        <div class="stat-value"></div>
                        <div class="stat-label">Total Clients</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-2">
                <div class="z-stat-card z-stat-gold">
                    <div class="stat-icon"><i class="fas fa-database"></i></div>
                    <div>
                        <div class="stat-value"> MB</div>
                        <div class="stat-label">Clients at NDA Stage</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-2">
                <div class="z-stat-card z-stat-blue">
                    <div class="stat-icon"><i class="fas fa-tags"></i></div>
                    <div>
                        <div class="stat-value"></div>
                        <div class="stat-label">Clients at GIS Stage</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-2">
                <div class="z-stat-card z-stat-purple">
                    <div class="stat-icon"><i class="fas fa-clock"></i></div>
                    <div>
                        <div class="stat-value"></div>
                        <div class="stat-label">Clients at GCA Stage</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== Main Card ===== --}}
        <div class="card z-card" style="position: relative;">
            <div wire:loading.flex class="z-loading">
                <div class="spinner-border text-success"><span class="sr-only">Loading...</span></div>
            </div>

            <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="gap: 0.75rem;">
                <h3 class="mb-0"><i class="fas fa-list mr-1"></i> All Files
                    <span class="z-count"></span>
                </h3>
                <a href="{{route('clients.create')}}" class="btn-zesco">
                    <i class="fas fa-cloud-upload-alt mr-1"></i> Add
                </a>
            </div>

            <div class="card-body">
                {{-- Filters --}}
                <div class="d-flex flex-wrap align-items-center mb-3" style="gap: 0.75rem;">
                    <div class="z-search" style="flex: 1; min-width: 200px; max-width: 320px;">
                        <i class="fas fa-search si"></i>
                        <input type="text" wire:model.debounce.300ms="search" placeholder="Search files...">
                    </div>
                    <select wire:model="filterType" class="form-control z-filter-select" style="max-width: 180px;">
                        <option value="">All Types</option>
{{--                        @foreach($fileTypes as $type)--}}
{{--                            <option value="{{ $type }}">{{ ucfirst($type) }}</option>--}}
{{--                        @endforeach--}}
                    </select>
                    <select wire:model="filterExt" class="form-control z-filter-select" style="max-width: 150px;">
                        <option value="">All Formats</option>
{{--                        @foreach($fileExtensions as $ext)--}}
{{--                            <option value="{{ $ext }}">{{ strtoupper($ext) }}</option>--}}
{{--                        @endforeach--}}
                    </select>
                    <select wire:model="perPage" class="form-control z-per-page">
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
{{--                    @if($search || $filterType || $filterExt)--}}
{{--                        <button wire:click="clearFilters" class="btn btn-sm btn-outline-secondary" style="border-radius: 6px;">--}}
{{--                            <i class="fas fa-times mr-1"></i> Clear--}}
{{--                        </button>--}}
{{--                    @endif--}}
                </div>

                {{-- Table --}}
                <div class="table-responsive">
                    <table class="table z-table mb-0">
                        <thead>
                        <tr>

                            <th  style="min-width: 280px;">
                                Company Name
                                <i class="fas fa-sort sort-icon {{ $sortField === 'name' ? 'active' : '' }}"></i>
                            </th>
                            <th >
                                TPIN
                                <i class="fas fa-sort sort-icon {{ $sortField === 'type' ? 'active' : '' }}"></i>
                            </th>
                            <th>
                                Email
                                <i class="fas fa-sort sort-icon {{ $sortField === 'ext' ? 'active' : '' }}"></i>
                            </th>
                            <th >
                                Address
                                <i class="fas fa-sort sort-icon {{ $sortField === 'size' ? 'active' : '' }}"></i>
                            </th>
                            <th>Country</th>
                            <th >
                                Status
                                <i class="fas fa-sort sort-icon {{ $sortField === 'created_at' ? 'active' : '' }}"></i>
                            </th>
                            <th style="width: 130px;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($clientList as $item)
                            <tr>
                                <td>
                                    {{$item->company_name}}

                                </td>
                                <td>
                                    <span class="z-badge">{{ $item->tpin }}</span>
                                </td>
                                <td>
                                    {{ $item->email }}
                                </td>
                                <td style="font-size: 0.82rem; color: #6b7280;">{{ $item->address_line_1 }}</td>
                                <td>
                                    {{ $item->country }}
                                </td>
                                <td style="font-size: 0.78rem; color: #6b7280;">
                                    {{ $item->is_active }}
                                </td>

                                <td style="font-size: 0.78rem; color: #6b7280;">
                                   <a class="btn btn-info" href="{{route('clients.show', $item->id)}}">view</a>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4" style="color: #94a3b8;">
                                    <i class="fas fa-folder-open fa-2x d-block mb-2"></i>
                                    No Clients found.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
{{--                @if($files->hasPages())--}}
{{--                    <div class="d-flex justify-content-center mt-3">--}}
{{--                        {{ $files->links() }}--}}
{{--                    </div>--}}
{{--                @endif--}}
            </div>
        </div>
    </section>
</div>
