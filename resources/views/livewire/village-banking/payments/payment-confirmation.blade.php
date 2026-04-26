<div>
    @can('confirm-payments')
    <!-- Page Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="z-page-header">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div>
                        <h1><i class="fas fa-clipboard-check mr-2" style="color: var(--z-gold)"></i>Payment Confirmations</h1>
                        <p>Review and confirm submitted payments</p>
                    </div>
                    <a href="{{ route('payments.upload') }}" class="btn-zesco">
                        <i class="fas fa-upload mr-1"></i> Upload Payment
                    </a>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            @if (session()->has('message'))
                <div class="alert alert-success" style="border-radius:10px;font-size:0.9rem;"><i class="fas fa-check-circle mr-1"></i> {{ session('message') }}</div>
            @endif
            @if (session()->has('warning'))
                <div class="alert alert-warning" style="border-radius:10px;font-size:0.9rem;"><i class="fas fa-exclamation-triangle mr-1"></i> {{ session('warning') }}</div>
            @endif

            {{-- Stat Cards --}}
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="card z-card" style="border-left:4px solid #f59e0b;">
                        <div class="card-body py-3 d-flex align-items-center justify-content-between">
                            <div><small class="text-muted">Pending</small><h3 class="mb-0 font-weight-bold">{{ $pendingCount }}</h3></div>
                            <div style="width:42px;height:42px;border-radius:50%;background:#fffbeb;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-clock" style="font-size:1.1rem;color:#f59e0b;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card z-card" style="border-left:4px solid #16a34a;">
                        <div class="card-body py-3 d-flex align-items-center justify-content-between">
                            <div><small class="text-muted">Confirmed</small><h3 class="mb-0 font-weight-bold">{{ $confirmedCount }}</h3></div>
                            <div style="width:42px;height:42px;border-radius:50%;background:#f0fdf4;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-check-double" style="font-size:1.1rem;color:#16a34a;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card z-card" style="border-left:4px solid #2563eb;">
                        <div class="card-body py-3 d-flex align-items-center justify-content-between">
                            <div><small class="text-muted">Total Confirmed</small><h3 class="mb-0 font-weight-bold">K{{ number_format($totalConfirmed, 2) }}</h3></div>
                            <div style="width:42px;height:42px;border-radius:50%;background:#eff6ff;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-coins" style="font-size:1.1rem;color:#2563eb;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Table --}}
            <div class="card z-card">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="gap:0.75rem;">
                    <h3><i class="fas fa-exchange-alt mr-2" style="color:var(--z-green)"></i>Transactions</h3>
                    <div class="d-flex align-items-center flex-wrap" style="gap:0.75rem;">
                        @include('partials.village-bank-selector')
                        <select wire:model.live="statusFilter" class="z-per-page">
                            <option value="">All Statuses</option>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="rejected">Rejected</option>
                        </select>
                        <div class="z-search"><i class="fas fa-search si"></i>
                            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search by name...">
                        </div>
                        <select wire:model.live="perPage" class="z-per-page">
                            <option value="10">10</option><option value="15">15</option><option value="25">25</option>
                        </select>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover z-table mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Sender</th>
                                    <th>Receiver</th>
                                    <th>Circle</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                    <th>Proof</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th style="width:100px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $t)
                                    <tr>
                                        <td style="font-size:0.85rem;color:#94a3b8;">#{{ $t->id }}</td>
                                        <td><strong>{{ $t->sender->name ?? '--' }}</strong></td>
                                        <td>{{ $t->receiver->name ?? '--' }}</td>
                                        <td style="font-size:0.88rem;">{{ $t->month->circle->name ?? '--' }}</td>
                                        <td style="font-weight:600;">K{{ number_format($t->amount, 2) }}</td>
                                        <td style="font-size:0.85rem;">{{ $t->paymentMethod->name ?? '--' }}</td>
                                        <td>
                                            @if ($t->proof_file)
                                                <a href="{{ asset('storage/' . $t->proof_file) }}" target="_blank" class="btn btn-sm btn-outline-primary" style="border-radius:6px;font-size:0.75rem;">
                                                    <i class="fas fa-file mr-1"></i> View
                                                </a>
                                            @else
                                                <span style="color:#d1d5db;font-size:0.8rem;">&mdash;</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $sc = ['pending'=>['#fffbeb','#92400e','#fde68a'],'confirmed'=>['#f0fdf4','#166534','#bbf7d0'],'rejected'=>['#fef2f2','#991b1b','#fecaca']][$t->status] ?? ['#f3f4f6','#374151','#e5e7eb'];
                                            @endphp
                                            <span class="badge" style="background:{{ $sc[0] }};color:{{ $sc[1] }};font-size:0.78rem;font-weight:600;border:1px solid {{ $sc[2] }};">{{ ucfirst($t->status) }}</span>
                                        </td>
                                        <td style="font-size:0.82rem;color:#6b7280;">{{ $t->created_at->format('d M Y') }}</td>
                                        <td>
                                            @if ($t->status === 'pending')
                                                <button wire:click="openReview({{ $t->id }})" class="btn btn-sm btn-outline-primary" style="border-radius:6px;font-size:0.8rem;">
                                                    <i class="fas fa-eye mr-1"></i> Review
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="10" class="text-center py-4" style="color:#94a3b8;"><i class="fas fa-exchange-alt fa-2x mb-2 d-block"></i>No transactions found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white border-top d-flex align-items-center justify-content-between flex-wrap" style="gap:0.75rem;">
                    <span style="font-size:0.82rem;color:#6b7280;">Showing {{ $transactions->firstItem() ?? 0 }} - {{ $transactions->lastItem() ?? 0 }} of {{ $transactions->total() }}</span>
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </section>

    {{-- Review Modal --}}
    @if ($reviewTxn)
        <div class="modal fade show z-modal" style="display:block;background:rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered" style="max-width:540px;">
                <div class="modal-content">
                    <div class="modal-header-zesco d-flex align-items-center justify-content-between">
                        <h5><i class="fas fa-receipt mr-2"></i> Review Payment #{{ $reviewTxn->id }}</h5>
                        <button type="button" class="close" wire:click="closeReview"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-sm mb-3" style="font-size:0.9rem;">
                            <tr><td class="text-muted" style="width:130px;">Sender</td><td><strong>{{ $reviewTxn->sender->name }}</strong></td></tr>
                            <tr><td class="text-muted">Receiver</td><td><strong>{{ $reviewTxn->receiver->name }}</strong></td></tr>
                            <tr><td class="text-muted">Circle</td><td>{{ $reviewTxn->month->circle->name ?? '--' }}</td></tr>
                            <tr><td class="text-muted">Month</td><td>Month {{ $reviewTxn->month->month_number ?? '' }}</td></tr>
                            <tr><td class="text-muted">Amount</td><td style="font-weight:700;color:#1e40af;">K{{ number_format($reviewTxn->amount, 2) }}</td></tr>
                            <tr><td class="text-muted">Method</td><td>{{ $reviewTxn->paymentMethod->name ?? '--' }} ({{ str_replace('_', ' ', $reviewTxn->paymentMethod->type ?? '') }})</td></tr>
                            <tr><td class="text-muted">Date</td><td>{{ $reviewTxn->created_at->format('d M Y, H:i') }}</td></tr>
                            <tr>
                                <td class="text-muted">Proof</td>
                                <td>
                                    @if ($reviewTxn->proof_file)
                                        <a href="{{ asset('storage/' . $reviewTxn->proof_file) }}" target="_blank" class="btn btn-sm btn-outline-primary" style="border-radius:6px;">
                                            <i class="fas fa-external-link-alt mr-1"></i> View Proof
                                        </a>
                                    @else
                                        <span class="text-muted">No proof uploaded</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button wire:click="reject" class="btn btn-danger px-4" style="border-radius:8px;font-weight:600;" wire:loading.attr="disabled" wire:target="reject">
                            <span wire:loading.remove wire:target="reject"><i class="fas fa-times-circle mr-1"></i> Reject</span>
                            <span wire:loading wire:target="reject"><i class="fas fa-spinner fa-spin mr-1"></i> Rejecting...</span>
                        </button>
                        <button wire:click="confirm" class="btn-zesco-green px-4" style="border-radius:8px;" wire:loading.attr="disabled" wire:target="confirm">
                            <span wire:loading.remove wire:target="confirm"><i class="fas fa-check-circle mr-1"></i> Confirm</span>
                            <span wire:loading wire:target="confirm"><i class="fas fa-spinner fa-spin mr-1"></i> Confirming...</span>
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
