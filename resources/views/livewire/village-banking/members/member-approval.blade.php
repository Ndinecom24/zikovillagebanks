<div>
    @can('approve-members')
    <!-- Page Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="z-page-header">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div>
                        <h1><i class="fas fa-user-check mr-2" style="color: var(--z-gold)"></i>Member Approvals</h1>
                        <p>Review and approve pending member registrations</p>
                    </div>
                    <a href="{{ route('members.index') }}" class="btn btn-light" style="border-radius: 8px;">
                        <i class="fas fa-arrow-left mr-1"></i> Back to Members
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <section class="content">
        <div class="container-fluid">

            {{-- Flash --}}
            @if (session()->has('message'))
                <div class="alert alert-success" style="border-radius: 10px; font-size: 0.9rem;">
                    <i class="fas fa-check-circle mr-1"></i> {{ session('message') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger" style="border-radius: 10px; font-size: 0.9rem; border-left: 4px solid #dc3545;">
                    <i class="fas fa-ban mr-1"></i> {{ session('error') }}
                </div>
            @endif
            @if (session()->has('warning'))
                <div class="alert alert-warning" style="border-radius: 10px; font-size: 0.9rem;">
                    <i class="fas fa-exclamation-triangle mr-1"></i> {{ session('warning') }}
                </div>
            @endif

            {{-- Pending count badge --}}
            <div class="mb-3">
                <span class="badge px-3 py-2" style="background:#fffbeb; color:#92400e; font-size:0.9rem; font-weight:600; border:1px solid #fde68a; border-radius:8px;">
                    <i class="fas fa-clock mr-1"></i> {{ $pendingCount }} pending {{ Str::plural('registration', $pendingCount) }}
                </span>
            </div>

            {{-- Table Card --}}
            <div class="card z-card">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="gap: 0.75rem;">
                    <h3><i class="fas fa-clipboard-check mr-2" style="color: var(--z-green)"></i>Pending Members</h3>
                    <div class="d-flex align-items-center" style="gap: 0.75rem;">
                        <div class="z-search">
                            <i class="fas fa-search si"></i>
                            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search pending members...">
                        </div>
                        <select wire:model.live="perPage" class="z-per-page">
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                        </select>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover z-table mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 50px;"></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Guarantor</th>
                                    <th>Registered</th>
                                    <th style="width: 140px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendingMembers as $m)
                                    <tr>
                                        <td>
                                            @php
                                                $parts = explode(' ', trim($m->name ?? ''));
                                                $initials = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
                                            @endphp
                                            <div class="z-avatar-sm z-avatar-initials">{{ $initials }}</div>
                                        </td>
                                        <td><strong>{{ $m->name }}</strong></td>
                                        <td>{{ $m->email }}</td>
                                        <td>{{ $m->phone ?? '--' }}</td>
                                        <td>
                                            @if ($m->guarantor)
                                                <span style="font-size:0.88rem;">
                                                    <i class="fas fa-handshake mr-1" style="color:var(--z-gold);font-size:0.75rem;"></i>
                                                    {{ $m->guarantor->name }}
                                                </span>
                                            @else
                                                <span style="color:#d1d5db;font-size:0.8rem;">&mdash;</span>
                                            @endif
                                        </td>
                                        <td style="font-size:0.85rem;color:#6b7280;">{{ $m->created_at->format('d M Y') }}</td>
                                        <td>
                                            <div class="d-flex" style="gap: 4px;">
                                                <button wire:click="openReview({{ $m->id }})" class="btn btn-sm btn-outline-primary" style="border-radius:6px; font-size:0.8rem;">
                                                    <i class="fas fa-eye mr-1"></i> Review
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5" style="color: #94a3b8;">
                                            <i class="fas fa-check-circle fa-2x mb-2 d-block" style="color:#a7f3d0;"></i>
                                            No pending registrations. All caught up!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if ($pendingMembers->hasPages())
                    <div class="card-footer bg-white border-top d-flex align-items-center justify-content-between flex-wrap" style="gap: 0.75rem;">
                        <span style="font-size: 0.82rem; color: #6b7280;">
                            Showing {{ $pendingMembers->firstItem() ?? 0 }} - {{ $pendingMembers->lastItem() ?? 0 }} of {{ $pendingMembers->total() }}
                        </span>
                        {{ $pendingMembers->links() }}
                    </div>
                @endif
            </div>

        </div>
    </section>

    {{-- ===== REVIEW MODAL ===== --}}
    @if ($reviewUser)
        <div class="modal fade show z-modal" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 540px;">
                <div class="modal-content">
                    <div class="modal-header-zesco d-flex align-items-center justify-content-between">
                        <h5><i class="fas fa-user-check mr-2"></i> Review Registration</h5>
                        <button type="button" class="close" wire:click="closeReview">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- Member info --}}
                        <div class="d-flex align-items-center mb-3" style="gap:0.75rem;">
                            @php
                                $rp = explode(' ', trim($reviewUser->name ?? ''));
                                $ri = strtoupper(substr($rp[0], 0, 1) . (isset($rp[1]) ? substr($rp[1], 0, 1) : ''));
                            @endphp
                            <div class="z-avatar-sm z-avatar-initials" style="width:48px;height:48px;font-size:1rem;">{{ $ri }}</div>
                            <div>
                                <h5 class="mb-0" style="font-weight:700;">{{ $reviewUser->name }}</h5>
                                <small class="text-muted">Registered {{ $reviewUser->created_at->format('d M Y, H:i') }}</small>
                            </div>
                        </div>

                        <table class="table table-sm mb-0" style="font-size:0.9rem;">
                            <tr>
                                <td class="text-muted" style="width:120px;">Email</td>
                                <td><strong>{{ $reviewUser->email }}</strong></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Phone</td>
                                <td><strong>{{ $reviewUser->phone ?? '--' }}</strong></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Guarantor</td>
                                <td>
                                    @if ($reviewUser->guarantor)
                                        <strong>
                                            <i class="fas fa-handshake mr-1" style="color:var(--z-gold);font-size:0.75rem;"></i>
                                            {{ $reviewUser->guarantor->name }}
                                        </strong>
                                        <br><small class="text-muted">{{ $reviewUser->guarantor->email }} &bull; {{ $reviewUser->guarantor->phone ?? 'No phone' }}</small>
                                    @else
                                        <span class="text-danger"><i class="fas fa-exclamation-triangle mr-1"></i> No guarantor assigned</span>
                                    @endif
                                </td>
                            </tr>
                        </table>

                        <hr style="border-color:#e5e7eb;">

                        {{-- Remarks (required for rejection) --}}
                        <div class="mb-2">
                            <label class="z-label">Remarks <small class="text-muted">(required for rejection)</small></label>
                            <textarea wire:model="remarks" class="form-control z-input" rows="3" placeholder="Add any notes or reasons..."></textarea>
                            @error('remarks') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button wire:click="reject" class="btn btn-danger px-4" style="border-radius:8px; font-weight:600;"
                            wire:loading.attr="disabled" wire:target="reject">
                            <span wire:loading.remove wire:target="reject"><i class="fas fa-times-circle mr-1"></i> Reject</span>
                            <span wire:loading wire:target="reject"><i class="fas fa-spinner fa-spin mr-1"></i> Rejecting...</span>
                        </button>
                        <button wire:click="approve" class="btn-zesco-green px-4" style="border-radius:8px;"
                            wire:loading.attr="disabled" wire:target="approve">
                            <span wire:loading.remove wire:target="approve"><i class="fas fa-check-circle mr-1"></i> Approve</span>
                            <span wire:loading wire:target="approve"><i class="fas fa-spinner fa-spin mr-1"></i> Approving...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
