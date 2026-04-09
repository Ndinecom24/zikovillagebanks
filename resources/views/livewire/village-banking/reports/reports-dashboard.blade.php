<div>
    @can('view-reports')
    <!-- Page Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="z-page-header">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div>
                        <h1><i class="fas fa-chart-bar mr-2" style="color: var(--z-gold)"></i>Reports</h1>
                        <p>Village Banking analytics and reporting</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            {{-- Filters --}}
            <div class="card z-card mb-3">
                <div class="card-body py-3">
                    <div class="row align-items-end" style="gap-y:0.5rem;">
                        <div class="col-md-3">
                            <label class="z-label mb-1">Village Bank</label>
                            <select wire:model="villageBankId" class="form-control z-input">
                                <option value="">All Village Banks</option>
                                @foreach ($this->villageBanks as $vb)
                                    <option value="{{ $vb->id }}">{{ $vb->name }} ({{ $vb->code }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="z-label mb-1">Circle</label>
                            <select wire:model="circleId" class="form-control z-input">
                                <option value="">All Circles</option>
                                @foreach ($this->circles as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="z-label mb-1">From</label>
                            <input type="date" wire:model.lazy="dateFrom" class="form-control z-input">
                        </div>
                        <div class="col-md-2">
                            <label class="z-label mb-1">To</label>
                            <input type="date" wire:model.lazy="dateTo" class="form-control z-input">
                        </div>
                        <div class="col-md-1 d-flex align-items-end" style="gap:0.5rem;">
                            <button wire:click="$set('dateFrom', '')" class="btn btn-sm btn-outline-secondary" style="border-radius:6px;" title="Clear dates">
                                <i class="fas fa-times mr-1"></i> Clear
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabs --}}
            <ul class="nav nav-pills mb-3" style="gap:0.5rem;">
                @foreach (['overview' => 'Overview', 'contributions' => 'Contributions', 'loans' => 'Loans', 'payments' => 'Payments', 'shareouts' => 'Shareouts'] as $key => $label)
                    <li class="nav-item">
                        <a href="#" wire:click.prevent="$set('reportTab', '{{ $key }}')"
                           class="nav-link {{ $reportTab === $key ? 'active' : '' }}"
                           style="border-radius:8px;font-size:0.88rem;font-weight:600;{{ $reportTab === $key ? 'background:var(--z-green);border-color:var(--z-green);' : '' }}">
                            {{ $label }}
                        </a>
                    </li>
                @endforeach
            </ul>

            {{-- ═══════════════════ OVERVIEW TAB ═══════════════════ --}}
            @if ($reportTab === 'overview')
                @php $ov = $this->overview; @endphp

                {{-- Row 1: Circles & Members --}}
                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="card z-card" style="border-left:4px solid #2563eb;">
                            <div class="card-body py-3 d-flex align-items-center justify-content-between">
                                <div><small class="text-muted">Total Circles</small><h3 class="mb-0 font-weight-bold">{{ $ov['totalCircles'] }}</h3></div>
                                <div style="width:42px;height:42px;border-radius:50%;background:#eff6ff;display:flex;align-items:center;justify-content:center;">
                                    <i class="fas fa-circle-notch" style="font-size:1.1rem;color:#2563eb;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card z-card" style="border-left:4px solid #16a34a;">
                            <div class="card-body py-3 d-flex align-items-center justify-content-between">
                                <div><small class="text-muted">Active Circles</small><h3 class="mb-0 font-weight-bold">{{ $ov['activeCircles'] }}</h3></div>
                                <div style="width:42px;height:42px;border-radius:50%;background:#f0fdf4;display:flex;align-items:center;justify-content:center;">
                                    <i class="fas fa-play-circle" style="font-size:1.1rem;color:#16a34a;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card z-card" style="border-left:4px solid #7c3aed;">
                            <div class="card-body py-3 d-flex align-items-center justify-content-between">
                                <div><small class="text-muted">Total Members</small><h3 class="mb-0 font-weight-bold">{{ $ov['totalMembers'] }}</h3></div>
                                <div style="width:42px;height:42px;border-radius:50%;background:#f5f3ff;display:flex;align-items:center;justify-content:center;">
                                    <i class="fas fa-users" style="font-size:1.1rem;color:#7c3aed;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card z-card" style="border-left:4px solid var(--z-gold);">
                            <div class="card-body py-3 d-flex align-items-center justify-content-between">
                                <div><small class="text-muted">Shareouts Done</small><h3 class="mb-0 font-weight-bold">{{ $ov['totalShareouts'] }}</h3></div>
                                <div style="width:42px;height:42px;border-radius:50%;background:#fffbeb;display:flex;align-items:center;justify-content:center;">
                                    <i class="fas fa-coins" style="font-size:1.1rem;color:var(--z-gold);"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Row 2: Financial --}}
                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="card z-card" style="border-left:4px solid #0891b2;">
                            <div class="card-body py-3">
                                <small class="text-muted">Total Contributions</small>
                                <h3 class="mb-0 font-weight-bold" style="color:#0891b2;">K{{ number_format($ov['totalContributions'], 2) }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card z-card" style="border-left:4px solid #ea580c;">
                            <div class="card-body py-3">
                                <small class="text-muted">Total Loans Issued</small>
                                <h3 class="mb-0 font-weight-bold" style="color:#ea580c;">K{{ number_format($ov['totalLoanAmount'], 2) }}</h3>
                                <small class="text-muted">{{ $ov['totalLoans'] }} loans</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card z-card" style="border-left:4px solid #16a34a;">
                            <div class="card-body py-3">
                                <small class="text-muted">Total Repaid</small>
                                <h3 class="mb-0 font-weight-bold" style="color:#16a34a;">K{{ number_format($ov['totalRepaid'], 2) }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card z-card" style="border-left:4px solid #dc2626;">
                            <div class="card-body py-3">
                                <small class="text-muted">Outstanding Balance</small>
                                <h3 class="mb-0 font-weight-bold" style="color:#dc2626;">K{{ number_format($ov['totalOutstanding'], 2) }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Row 3 --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="card z-card" style="border-left:4px solid #7c3aed;">
                            <div class="card-body py-3">
                                <small class="text-muted">Penalties Collected</small>
                                <h3 class="mb-0 font-weight-bold" style="color:#7c3aed;">K{{ number_format($ov['totalPenalties'], 2) }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card z-card" style="border-left:4px solid #0d9488;">
                            <div class="card-body py-3">
                                <small class="text-muted">Insurance Collected</small>
                                <h3 class="mb-0 font-weight-bold" style="color:#0d9488;">K{{ number_format($ov['totalInsurance'], 2) }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card z-card" style="border-left:4px solid var(--z-gold);">
                            <div class="card-body py-3">
                                <small class="text-muted">Total Distributed (Shareouts)</small>
                                <h3 class="mb-0 font-weight-bold" style="color:var(--z-gold);">K{{ number_format($ov['totalPoolDistrib'], 2) }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- ═══════════════════ CONTRIBUTIONS TAB ═══════════════════ --}}
            @if ($reportTab === 'contributions')
                <div class="row">
                    <div class="col-lg-7">
                        <div class="card z-card">
                            <div class="card-header">
                                <h3><i class="fas fa-piggy-bank mr-2" style="color:var(--z-green)"></i>Contributions by Month</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover z-table mb-0">
                                        <thead>
                                            <tr><th>Circle</th><th>Month</th><th>Members</th><th>Total</th></tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($this->contributionsByMonth as $row)
                                                <tr>
                                                    <td>{{ $row->month->circle->name ?? '--' }}</td>
                                                    <td>Month {{ $row->month->month_number ?? '' }}</td>
                                                    <td>{{ $row->members }}</td>
                                                    <td style="font-weight:700;color:#1e40af;">K{{ number_format($row->total, 2) }}</td>
                                                </tr>
                                            @empty
                                                <tr><td colspan="4" class="text-center py-4" style="color:#94a3b8;"><i class="fas fa-piggy-bank fa-2x mb-2 d-block"></i>No contributions found.</td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card z-card">
                            <div class="card-header">
                                <h3><i class="fas fa-trophy mr-2" style="color:var(--z-gold)"></i>Top 10 Contributors</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-sm z-table mb-0">
                                        <thead><tr><th>#</th><th>Member</th><th>Total</th></tr></thead>
                                        <tbody>
                                            @forelse ($this->topContributors as $i => $tc)
                                                <tr>
                                                    <td style="color:#94a3b8;">{{ $i + 1 }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center" style="gap:0.5rem;">
                                                            <div class="z-avatar-sm z-avatar-initials">{{ strtoupper(substr($tc->user->name ?? '?', 0, 1)) }}</div>
                                                            <strong>{{ $tc->user->name ?? '--' }}</strong>
                                                        </div>
                                                    </td>
                                                    <td style="font-weight:700;color:#1e40af;">K{{ number_format($tc->total, 2) }}</td>
                                                </tr>
                                            @empty
                                                <tr><td colspan="3" class="text-center py-3" style="color:#94a3b8;">No data.</td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- ═══════════════════ LOANS TAB ═══════════════════ --}}
            @if ($reportTab === 'loans')
                @php $ls = $this->loansByStatus; @endphp
                <div class="row mb-3">
                    @foreach (['pending' => ['#f59e0b','#fffbeb','fas fa-clock'], 'approved' => ['#2563eb','#eff6ff','fas fa-thumbs-up'], 'active' => ['#16a34a','#f0fdf4','fas fa-bolt'], 'completed' => ['#6b7280','#f3f4f6','fas fa-check-circle'], 'rejected' => ['#dc2626','#fef2f2','fas fa-times-circle']] as $st => $cfg)
                        @php $d = $ls[$st] ?? null; @endphp
                        <div class="col">
                            <div class="card z-card" style="border-left:4px solid {{ $cfg[0] }};">
                                <div class="card-body py-3 d-flex align-items-center justify-content-between">
                                    <div>
                                        <small class="text-muted text-capitalize">{{ $st }}</small>
                                        <h4 class="mb-0 font-weight-bold">{{ $d->count ?? 0 }}</h4>
                                        <small style="color:{{ $cfg[0] }};font-weight:600;">K{{ number_format($d->total ?? 0, 2) }}</small>
                                    </div>
                                    <div style="width:38px;height:38px;border-radius:50%;background:{{ $cfg[1] }};display:flex;align-items:center;justify-content:center;">
                                        <i class="{{ $cfg[2] }}" style="color:{{ $cfg[0] }};"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="card z-card">
                    <div class="card-header">
                        <h3><i class="fas fa-user-tie mr-2" style="color:var(--z-green)"></i>Top 10 Borrowers</h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover z-table mb-0">
                                <thead>
                                    <tr><th>#</th><th>Borrower</th><th>Loans</th><th>Total Borrowed</th><th>Outstanding</th></tr>
                                </thead>
                                <tbody>
                                    @forelse ($this->topBorrowers as $i => $tb)
                                        <tr>
                                            <td style="color:#94a3b8;">{{ $i + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center" style="gap:0.5rem;">
                                                    <div class="z-avatar-sm z-avatar-initials">{{ strtoupper(substr($tb->borrower->name ?? '?', 0, 1)) }}</div>
                                                    <strong>{{ $tb->borrower->name ?? '--' }}</strong>
                                                </div>
                                            </td>
                                            <td>{{ $tb->loan_count }}</td>
                                            <td style="font-weight:600;">K{{ number_format($tb->total_amount, 2) }}</td>
                                            <td style="color:#dc2626;font-weight:600;">K{{ number_format($tb->outstanding, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5" class="text-center py-4" style="color:#94a3b8;">No loan data.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            {{-- ═══════════════════ PAYMENTS TAB ═══════════════════ --}}
            @if ($reportTab === 'payments')
                @php $ps = $this->paymentsByStatus; @endphp
                <div class="row mb-3">
                    @foreach (['pending' => ['#f59e0b','#fffbeb','fas fa-clock'], 'confirmed' => ['#16a34a','#f0fdf4','fas fa-check-double'], 'rejected' => ['#dc2626','#fef2f2','fas fa-times-circle']] as $st => $cfg)
                        @php $d = $ps[$st] ?? null; @endphp
                        <div class="col-md-4">
                            <div class="card z-card" style="border-left:4px solid {{ $cfg[0] }};">
                                <div class="card-body py-3 d-flex align-items-center justify-content-between">
                                    <div>
                                        <small class="text-muted text-capitalize">{{ $st }}</small>
                                        <h4 class="mb-0 font-weight-bold">{{ $d->count ?? 0 }}</h4>
                                        <small style="color:{{ $cfg[0] }};font-weight:600;">K{{ number_format($d->total ?? 0, 2) }}</small>
                                    </div>
                                    <div style="width:42px;height:42px;border-radius:50%;background:{{ $cfg[1] }};display:flex;align-items:center;justify-content:center;">
                                        <i class="{{ $cfg[2] }}" style="color:{{ $cfg[0] }};"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="card z-card">
                    <div class="card-header">
                        <h3><i class="fas fa-exchange-alt mr-2" style="color:var(--z-green)"></i>Recent Transactions (Last 15)</h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover z-table mb-0">
                                <thead>
                                    <tr><th>ID</th><th>Sender</th><th>Receiver</th><th>Amount</th><th>Method</th><th>Status</th><th>Date</th></tr>
                                </thead>
                                <tbody>
                                    @forelse ($this->recentTransactions as $t)
                                        @php
                                            $sc = ['pending'=>['#fffbeb','#92400e','#fde68a'],'confirmed'=>['#f0fdf4','#166534','#bbf7d0'],'rejected'=>['#fef2f2','#991b1b','#fecaca']][$t->status] ?? ['#f3f4f6','#374151','#e5e7eb'];
                                        @endphp
                                        <tr>
                                            <td style="color:#94a3b8;font-size:0.85rem;">#{{ $t->id }}</td>
                                            <td><strong>{{ $t->sender->name ?? '--' }}</strong></td>
                                            <td>{{ $t->receiver->name ?? '--' }}</td>
                                            <td style="font-weight:600;">K{{ number_format($t->amount, 2) }}</td>
                                            <td style="font-size:0.85rem;">{{ $t->paymentMethod->name ?? '--' }}</td>
                                            <td><span class="badge" style="background:{{ $sc[0] }};color:{{ $sc[1] }};border:1px solid {{ $sc[2] }};font-size:0.78rem;font-weight:600;">{{ ucfirst($t->status) }}</span></td>
                                            <td style="font-size:0.82rem;color:#6b7280;">{{ $t->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="7" class="text-center py-4" style="color:#94a3b8;"><i class="fas fa-exchange-alt fa-2x mb-2 d-block"></i>No transactions found.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            {{-- ═══════════════════ SHAREOUTS TAB ═══════════════════ --}}
            @if ($reportTab === 'shareouts')
                <div class="card z-card">
                    <div class="card-header">
                        <h3><i class="fas fa-coins mr-2" style="color:var(--z-gold)"></i>Shareout History</h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover z-table mb-0">
                                <thead>
                                    <tr><th>ID</th><th>Circle</th><th>Contributions</th><th>Interest</th><th>Penalties</th><th>Total Pool</th><th>Members</th><th>Date</th></tr>
                                </thead>
                                <tbody>
                                    @forelse ($this->shareoutList as $so)
                                        <tr>
                                            <td style="color:#94a3b8;font-size:0.85rem;">#{{ $so->id }}</td>
                                            <td><strong>{{ $so->circle->name ?? '--' }}</strong></td>
                                            <td>K{{ number_format($so->total_contributions, 2) }}</td>
                                            <td style="color:#16a34a;font-weight:600;">K{{ number_format($so->total_interest, 2) }}</td>
                                            <td style="color:#dc2626;">K{{ number_format($so->total_penalties, 2) }}</td>
                                            <td style="font-weight:700;color:#1e40af;">K{{ number_format($so->total_pool, 2) }}</td>
                                            <td>{{ $so->allocations->count() }}</td>
                                            <td style="font-size:0.82rem;color:#6b7280;">{{ $so->created_at->format('d M Y') }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="8" class="text-center py-4" style="color:#94a3b8;"><i class="fas fa-coins fa-2x mb-2 d-block"></i>No shareouts found.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
