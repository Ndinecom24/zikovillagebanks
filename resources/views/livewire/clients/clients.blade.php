<div>
    <section class="content py-3 px-3">
        {{-- ===== Page Header ===== --}}
        <div class="z-page-header mb-3">
            <h1><i class="fas fa-user-tie"></i> Client Management</h1>
            <p>Manage and monitor your client profiles and documents</p>
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
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <div>
                        <div class="stat-value">{{ $clientList->count() }}</div>
                        <div class="stat-label">Total Clients</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-2">
                <div class="z-stat-card z-stat-gold">
                    <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                    <div>
                        <div class="stat-value">{{ $clientList->where('is_active', '1')->count() }}</div>
                        <div class="stat-label">Active Clients</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-2">
                <div class="z-stat-card z-stat-blue">
                    <div class="stat-icon"><i class="fas fa-globe-africa"></i></div>
                    <div>
                        <div class="stat-value">{{ $clientList->pluck('country')->unique()->count() }}</div>
                        <div class="stat-label">Countries</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-2">
                <div class="z-stat-card z-stat-purple">
                    <div class="stat-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <div class="stat-value">{{ $clientList->pluck('province')->unique()->count() }}</div>
                        <div class="stat-label">Provinces</div>
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
                <h3 class="mb-0"><i class="fas fa-list mr-1"></i> All Clients
                    <span class="z-count">{{ $clientList->count() }}</span>
                </h3>
                <a href="{{ route('clients.create') }}" class="btn-zesco">
                    <i class="fas fa-plus mr-1"></i> New Client
                </a>
            </div>

            <div class="card-body">
                {{-- Filters --}}
                <div class="d-flex flex-wrap align-items-center mb-3" style="gap: 0.75rem;">
                    <div class="z-search" style="flex: 1; min-width: 200px; max-width: 320px;">
                        <i class="fas fa-search si"></i>
                        <input type="text" wire:model.debounce.300ms="search" placeholder="Search clients...">
                    </div>
                    <select wire:model="perPage" class="form-control z-per-page">
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                </div>

                {{-- Table --}}
                <div class="table-responsive">
                    <table class="table z-table mb-0">
                        <thead>
                        <tr>
                            <th style="width: 40px;">#</th>
                            <th style="min-width: 220px;">Company Name</th>
                            <th>TPIN</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Country</th>
                            <th>Province</th>
                            <th style="width: 90px;">Status</th>
                            <th style="width: 100px;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($clientList as $index => $item)
                            <tr>
                                <td style="font-size: 0.78rem; color: #94a3b8;">{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center" style="gap: 0.6rem;">
                                        <div style="width: 32px; height: 32px; border-radius: 8px; background: linear-gradient(135deg, var(--z-green), var(--z-green-dark)); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 0.75rem; flex-shrink: 0;">
                                            {{ strtoupper(substr($item->company_name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <div style="font-weight: 600; color: #1a2332; font-size: 0.85rem;">{{ $item->company_name }}</div>
                                            <div style="font-size: 0.72rem; color: #94a3b8;">{{ $item->city ?? '' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="z-badge">{{ $item->tpin ?? 'N/A' }}</span>
                                </td>
                                <td style="font-size: 0.82rem; color: #374151;">{{ $item->email ?? '—' }}</td>
                                <td style="font-size: 0.82rem; color: #374151;">{{ $item->phone ?? '—' }}</td>
                                <td style="font-size: 0.82rem; color: #6b7280;">{{ $item->country ?? '—' }}</td>
                                <td style="font-size: 0.82rem; color: #6b7280;">{{ $item->province ?? '—' }}</td>
                                <td>
                                    @if($item->is_active == '1')
                                        <span style="display: inline-flex; align-items: center; gap: 0.3rem; background: #ecfdf5; color: #059669; font-size: 0.72rem; font-weight: 600; padding: 0.2rem 0.55rem; border-radius: 20px;">
                                            <i class="fas fa-circle" style="font-size: 5px;"></i> Active
                                        </span>
                                    @else
                                        <span style="display: inline-flex; align-items: center; gap: 0.3rem; background: #fef2f2; color: #dc2626; font-size: 0.72rem; font-weight: 600; padding: 0.2rem 0.55rem; border-radius: 20px;">
                                            <i class="fas fa-circle" style="font-size: 5px;"></i> Inactive
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('clients.show', $item->id) }}"
                                       class="btn btn-sm"
                                       style="background: rgba(56,193,114,0.1); color: var(--z-green-dark); border-radius: 6px; font-size: 0.78rem; font-weight: 600; padding: 0.3rem 0.7rem; transition: all 0.15s;"
                                       onmouseover="this.style.background='var(--z-green)'; this.style.color='#fff';"
                                       onmouseout="this.style.background='rgba(56,193,114,0.1)'; this.style.color='var(--z-green-dark)';">
                                        <i class="fas fa-eye mr-1"></i> View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4" style="color: #94a3b8;">
                                    <i class="fas fa-users fa-2x d-block mb-2"></i>
                                    No clients found.
                                    <a href="{{ route('clients.create') }}" style="color: var(--z-green); font-weight: 600;">Add your first client</a>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
