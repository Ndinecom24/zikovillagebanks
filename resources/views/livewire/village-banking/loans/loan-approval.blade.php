<div>
    @push('custom-styles')
    <style>
        :root {
            --la-navy:#1E3A5F; --la-navy-light:#2B6B96; --la-amber:#D97706; --la-amber-light:#F59E0B;
            --la-bg:#f4f6fa; --la-card:#fff; --la-border:#edf0f7; --la-text:#1e293b;
            --la-muted:#64748b; --la-faint:#94a3b8; --la-green:#16a34a; --la-red:#dc2626; --la-blue:#2563eb; --la-radius:16px;
        }
        .la-page { background:var(--la-bg); min-height:100vh; }
        .la-hero {
            background:linear-gradient(135deg,var(--la-navy) 0%,#234b78 50%,var(--la-navy-light) 100%);
            padding:1.75rem 0 5rem; position:relative; overflow:hidden;
        }
        .la-hero::before { content:''; position:absolute; width:500px; height:500px; top:-50%; right:-5%; background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
        .la-hero-inner { position:relative; z-index:2; padding:0 1.5rem; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:.75rem; }
        .la-breadcrumb { display:flex; gap:.5rem; list-style:none; padding:0; margin:0; font-size:.82rem; }
        .la-breadcrumb a { color:rgba(255,255,255,.55); text-decoration:none; }
        .la-breadcrumb a:hover { color:rgba(255,255,255,.85); }
        .la-breadcrumb .active { color:var(--la-amber-light); font-weight:600; }
        .la-breadcrumb .sep { color:rgba(255,255,255,.25); }
        .la-hero-title { color:#fff; font-size:1.3rem; font-weight:800; margin:.3rem 0 0; }
        .la-hero-sub { color:rgba(255,255,255,.5); font-size:.8rem; margin:.15rem 0 0; }
        .la-back { display:inline-flex; align-items:center; gap:.35rem; color:rgba(255,255,255,.65); font-size:.82rem; font-weight:600; text-decoration:none; }
        .la-back:hover { color:#fff; text-decoration:none; }
        .la-content { margin-top:-3.5rem; position:relative; z-index:10; padding:0 1.5rem 2rem; }
        .la-card { background:var(--la-card); border-radius:var(--la-radius); border:1px solid var(--la-border); box-shadow:0 2px 12px rgba(0,0,0,.04); overflow:hidden; }
        .la-card-head { padding:.85rem 1.25rem; border-bottom:1px solid var(--la-border); display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:.75rem; }
        .la-card-title { font-size:.9rem; font-weight:700; color:var(--la-text); margin:0; display:flex; align-items:center; gap:.45rem; }
        .la-card-title i { color:var(--la-amber); font-size:.85rem; }
        .la-toolbar { display:flex; align-items:center; gap:.65rem; flex-wrap:wrap; }
        .la-search { position:relative; }
        .la-search i { position:absolute; left:10px; top:50%; transform:translateY(-50%); font-size:.75rem; color:var(--la-faint); }
        .la-search input { padding:.4rem .8rem .4rem 2rem; border:2px solid #e2e8f0; border-radius:10px; font-size:.82rem; width:220px; color:var(--la-text); transition:border-color .2s; }
        .la-search input:focus { border-color:var(--la-amber); outline:none; }
        .la-badge-count {
            display:inline-flex; align-items:center; gap:.35rem; padding:.35rem .85rem; border-radius:10px;
            font-size:.84rem; font-weight:700; background:#fffbeb; color:#92400e; border:1px solid #fde68a; margin-bottom:1rem;
        }
        .la-table { width:100%; border-collapse:collapse; }
        .la-table thead th {
            font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--la-faint);
            padding:.7rem 1rem; border-bottom:1px solid var(--la-border); background:#fafbfd;
        }
        .la-table tbody td { padding:.7rem 1rem; border-bottom:1px solid #f5f7fa; vertical-align:middle; font-size:.85rem; }
        .la-table tbody tr { transition:background .15s; }
        .la-table tbody tr:hover { background:#fafbfd; }
        .la-table tbody tr:last-child td { border-bottom:none; }
        .la-badge { display:inline-flex; align-items:center; gap:.2rem; padding:.15rem .55rem; border-radius:8px; font-size:.68rem; font-weight:700; }
        .la-action {
            display:inline-flex; align-items:center; gap:.3rem; padding:.35rem .85rem; border-radius:8px;
            font-size:.78rem; font-weight:600; border:none; cursor:pointer; transition:all .15s;
            background:var(--la-navy); color:#fff;
        }
        .la-action:hover { background:var(--la-navy-light); }
        .la-empty { text-align:center; padding:3rem 1rem; color:var(--la-faint); }
        .la-empty i { font-size:2.5rem; opacity:.15; display:block; margin-bottom:.6rem; }
        .la-empty strong { display:block; color:var(--la-muted); font-size:.92rem; margin-bottom:.2rem; }
        .la-pagination { padding:.75rem 1.25rem; display:flex; align-items:center; justify-content:space-between; border-top:1px solid var(--la-border); flex-wrap:wrap; gap:.5rem; }
        .la-pagination-info { font-size:.78rem; color:var(--la-faint); font-weight:600; }
        .la-flash { display:flex; align-items:center; gap:.5rem; padding:.7rem 1.15rem; border-radius:12px; font-size:.84rem; font-weight:600; margin-bottom:1rem; }
        .la-flash-success { background:#f0fdf4; color:var(--la-green); border:1px solid #bbf7d0; }
        .la-flash-warning { background:#fffbeb; color:#92400e; border:1px solid #fde68a; }

        /* Review Modal */
        .la-modal-bg { position:fixed; inset:0; z-index:9999; background:rgba(15,26,46,.7); backdrop-filter:blur(4px); display:flex; align-items:center; justify-content:center; padding:1.5rem; }
        .la-modal { background:#fff; border-radius:20px; max-width:520px; width:100%; box-shadow:0 25px 60px rgba(0,0,0,.2); animation:laSlide .25s ease; overflow:hidden; }
        .la-modal-head { background:linear-gradient(135deg,var(--la-navy),var(--la-navy-light)); padding:1rem 1.5rem; display:flex; align-items:center; justify-content:space-between; }
        .la-modal-head h5 { color:#fff; font-size:.95rem; font-weight:700; margin:0; display:flex; align-items:center; gap:.4rem; }
        .la-modal-close { background:none; border:none; color:rgba(255,255,255,.6); font-size:1.2rem; cursor:pointer; }
        .la-modal-close:hover { color:#fff; }
        .la-modal-body { padding:1.25rem 1.5rem; }
        .la-detail-grid { display:grid; grid-template-columns:1fr 1fr; gap:.65rem .5rem; }
        .la-detail-label { font-size:.62rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--la-faint); }
        .la-detail-value { font-size:.88rem; font-weight:600; color:var(--la-text); }
        .la-textarea {
            width:100%; padding:.5rem .75rem; border:2px solid #e2e8f0; border-radius:10px;
            font-size:.85rem; color:var(--la-text); resize:vertical; min-height:70px;
        }
        .la-textarea:focus { border-color:var(--la-amber); outline:none; }
        .la-modal-footer { padding:.85rem 1.5rem; border-top:1px solid var(--la-border); display:flex; justify-content:space-between; }
        .la-btn {
            display:inline-flex; align-items:center; gap:.35rem; padding:.5rem 1.2rem; border-radius:10px;
            font-size:.84rem; font-weight:600; border:none; cursor:pointer; transition:all .2s;
        }
        .la-btn-reject { background:var(--la-red); color:#fff; }
        .la-btn-reject:hover { background:#b91c1c; }
        .la-btn-approve { background:var(--la-green); color:#fff; }
        .la-btn-approve:hover { background:#15803d; }
        .la-btn:disabled { opacity:.6; cursor:not-allowed; }
        .la-label { font-size:.72rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--la-faint); margin-bottom:.3rem; display:block; }

        @keyframes laSlide { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
        @media(max-width:768px){ .la-content{padding:0 .75rem 1.5rem;} .la-search input{width:160px;} .la-detail-grid{grid-template-columns:1fr;} }
    </style>
    @endpush

    @can('approve-loans')
    <section class="content la-page">
        <div class="la-hero">
            <div class="la-hero-inner container-fluid">
                <div>
                    <ul class="la-breadcrumb">
                        <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                        <li class="sep">/</li>
                        <li><a href="{{ route('loans.index') }}">Loans</a></li>
                        <li class="sep">/</li>
                        <li class="active">Approvals</li>
                    </ul>
                    <h1 class="la-hero-title">Loan Approvals</h1>
                    <p class="la-hero-sub">Review and approve pending loan requests</p>
                </div>
                <a href="{{ route('loans.index') }}" class="la-back"><i class="fas fa-arrow-left"></i> Back to Loans</a>
            </div>
        </div>

        <div class="la-content container-fluid">
            @if (session()->has('message'))
                <div class="la-flash la-flash-success"><i class="fas fa-check-circle"></i> {{ session('message') }}</div>
            @endif
            @if (session()->has('warning'))
                <div class="la-flash la-flash-warning"><i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}</div>
            @endif

            <div class="la-badge-count"><i class="fas fa-clock"></i> {{ $pendingCount }} pending {{ Str::plural('loan', $pendingCount) }}</div>

            <div class="la-card">
                <div class="la-card-head">
                    <h3 class="la-card-title"><i class="fas fa-hourglass-half"></i> Pending Loans</h3>
                    <div class="la-toolbar">
                        <div class="la-search">
                            <i class="fas fa-search"></i>
                            <input type="text" wire:model.debounce.300ms="search" placeholder="Search by borrower...">
                        </div>
                    </div>
                </div>

                @if($pendingLoans->count())
                    <div style="overflow-x:auto;">
                        <table class="la-table">
                            <thead>
                                <tr>
                                    <th>Borrower</th>
                                    <th>Circle</th>
                                    <th>Month</th>
                                    <th>Amount</th>
                                    <th>Rate</th>
                                    <th>Payable</th>
                                    <th>Duration</th>
                                    <th>Requested</th>
                                    <th style="width:100px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingLoans as $l)
                                    <tr>
                                        <td style="font-weight:700;">{{ $l->borrower->name ?? '--' }}</td>
                                        <td style="font-size:.84rem;">{{ $l->month->circle->name ?? '--' }}</td>
                                        <td>
                                            <span class="la-badge" style="background:#f1f5f9;color:#475569;border:1px solid #e2e8f0;">
                                                M{{ $l->month->month_number ?? '' }}
                                            </span>
                                        </td>
                                        <td style="font-weight:700;">K{{ number_format($l->amount, 2) }}</td>
                                        <td>{{ $l->interest_rate }}%</td>
                                        <td style="color:#1e40af;font-weight:600;">K{{ number_format($l->total_payable, 2) }}</td>
                                        <td>{{ $l->duration }} {{ Str::plural('month', $l->duration) }}</td>
                                        <td style="font-size:.78rem;color:var(--la-faint);">{{ $l->created_at->format('d M Y') }}</td>
                                        <td>
                                            <button wire:click="openReview({{ $l->id }})" class="la-action">
                                                <i class="fas fa-eye"></i> Review
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if ($pendingLoans->hasPages())
                        <div class="la-pagination">
                            <span class="la-pagination-info">Showing {{ $pendingLoans->firstItem() ?? 0 }}–{{ $pendingLoans->lastItem() ?? 0 }} of {{ $pendingLoans->total() }}</span>
                            {{ $pendingLoans->links() }}
                        </div>
                    @endif
                @else
                    <div class="la-empty">
                        <i class="fas fa-check-circle" style="color:#a7f3d0;opacity:1;"></i>
                        <strong>All caught up!</strong>
                        <span style="font-size:.82rem;">No pending loan requests.</span>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Review Modal --}}
    @if ($reviewLoan)
        <div class="la-modal-bg">
            <div class="la-modal">
                <div class="la-modal-head">
                    <h5><i class="fas fa-file-invoice-dollar"></i> Review Loan #{{ $reviewLoan->id }}</h5>
                    <button wire:click="closeReview" class="la-modal-close">&times;</button>
                </div>
                <div class="la-modal-body">
                    <div class="la-detail-grid" style="margin-bottom:1rem;">
                        <div><div class="la-detail-label">Borrower</div><div class="la-detail-value">{{ $reviewLoan->borrower->name }}</div></div>
                        <div><div class="la-detail-label">Circle</div><div class="la-detail-value">{{ $reviewLoan->month->circle->name ?? '--' }}</div></div>
                        <div><div class="la-detail-label">Month</div><div class="la-detail-value">Month {{ $reviewLoan->month->month_number ?? '' }}</div></div>
                        <div><div class="la-detail-label">Duration</div><div class="la-detail-value">{{ $reviewLoan->duration }} {{ Str::plural('month', $reviewLoan->duration) }}</div></div>
                        <div><div class="la-detail-label">Amount</div><div class="la-detail-value" style="font-size:1.05rem;">K{{ number_format($reviewLoan->amount, 2) }}</div></div>
                        <div><div class="la-detail-label">Interest Rate</div><div class="la-detail-value">{{ $reviewLoan->interest_rate }}%</div></div>
                        <div><div class="la-detail-label">Total Payable</div><div class="la-detail-value" style="color:#1e40af;font-size:1.05rem;">K{{ number_format($reviewLoan->total_payable, 2) }}</div></div>
                        <div><div class="la-detail-label">Requested</div><div class="la-detail-value">{{ $reviewLoan->created_at->format('d M Y, H:i') }}</div></div>
                    </div>

                    <div style="border-top:1px solid var(--la-border);padding-top:1rem;">
                        <label class="la-label">Remarks <span style="font-size:.65rem;color:var(--la-faint);text-transform:none;letter-spacing:0;">(required for rejection)</span></label>
                        <textarea wire:model.defer="remarks" class="la-textarea" placeholder="Add notes..."></textarea>
                        @error('remarks') <div style="font-size:.75rem;color:var(--la-red);margin-top:.2rem;font-weight:600;">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="la-modal-footer">
                    <button wire:click="reject" class="la-btn la-btn-reject" wire:loading.attr="disabled" wire:target="reject">
                        <span wire:loading.remove wire:target="reject"><i class="fas fa-times-circle"></i> Reject</span>
                        <span wire:loading wire:target="reject"><i class="fas fa-spinner fa-spin"></i> Rejecting...</span>
                    </button>
                    <button wire:click="approve" class="la-btn la-btn-approve" wire:loading.attr="disabled" wire:target="approve">
                        <span wire:loading.remove wire:target="approve"><i class="fas fa-check-circle"></i> Approve</span>
                        <span wire:loading wire:target="approve"><i class="fas fa-spinner fa-spin"></i> Approving...</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
