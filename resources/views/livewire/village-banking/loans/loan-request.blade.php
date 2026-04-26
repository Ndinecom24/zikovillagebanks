<div>
    @push('custom-styles')
    <style>
        :root {
            --lr-navy:#1E3A5F; --lr-navy-light:#2B6B96; --lr-amber:#D97706; --lr-amber-light:#F59E0B;
            --lr-bg:#f4f6fa; --lr-card:#fff; --lr-border:#edf0f7; --lr-text:#1e293b;
            --lr-muted:#64748b; --lr-faint:#94a3b8; --lr-green:#16a34a; --lr-red:#dc2626; --lr-blue:#2563eb; --lr-radius:16px;
        }
        .lr-page { background:var(--lr-bg); min-height:100vh; }
        .lr-hero {
            background:linear-gradient(135deg,var(--lr-navy) 0%,#234b78 50%,var(--lr-navy-light) 100%);
            padding:1.75rem 0 5rem; position:relative; overflow:hidden;
        }
        .lr-hero::before { content:''; position:absolute; width:500px; height:500px; top:-50%; right:-5%; background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
        .lr-hero-inner { position:relative; z-index:2; padding:0 1.5rem; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:.75rem; }
        .lr-breadcrumb { display:flex; gap:.5rem; list-style:none; padding:0; margin:0; font-size:.82rem; }
        .lr-breadcrumb a { color:rgba(255,255,255,.55); text-decoration:none; }
        .lr-breadcrumb a:hover { color:rgba(255,255,255,.85); }
        .lr-breadcrumb .active { color:var(--lr-amber-light); font-weight:600; }
        .lr-breadcrumb .sep { color:rgba(255,255,255,.25); }
        .lr-hero-title { color:#fff; font-size:1.3rem; font-weight:800; margin:.3rem 0 0; }
        .lr-hero-sub { color:rgba(255,255,255,.5); font-size:.8rem; margin:.15rem 0 0; }
        .lr-back { display:inline-flex; align-items:center; gap:.35rem; color:rgba(255,255,255,.65); font-size:.82rem; font-weight:600; text-decoration:none; }
        .lr-back:hover { color:#fff; text-decoration:none; }
        .lr-content { margin-top:-3.5rem; position:relative; z-index:10; padding:0 1.5rem 2rem; }
        .lr-card { background:var(--lr-card); border-radius:var(--lr-radius); border:1px solid var(--lr-border); box-shadow:0 2px 12px rgba(0,0,0,.04); overflow:hidden; }
        .lr-card-head { padding:.85rem 1.25rem; border-bottom:1px solid var(--lr-border); display:flex; align-items:center; gap:.45rem; }
        .lr-card-title { font-size:.9rem; font-weight:700; color:var(--lr-text); margin:0; display:flex; align-items:center; gap:.45rem; }
        .lr-card-title i { color:var(--lr-amber); font-size:.85rem; }
        .lr-card-body { padding:1.25rem 1.5rem; }
        .lr-label { font-size:.72rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--lr-faint); margin-bottom:.3rem; display:block; }
        .lr-input {
            width:100%; padding:.5rem .75rem; border:2px solid #e2e8f0; border-radius:10px;
            font-size:.88rem; color:var(--lr-text); transition:border-color .2s; background:#fff;
        }
        .lr-input:focus { border-color:var(--lr-amber); outline:none; }
        .lr-input:disabled { background:#f8fafc; cursor:not-allowed; }
        .lr-input-error { border-color:var(--lr-red) !important; }
        .lr-error { font-size:.75rem; color:var(--lr-red); margin-top:.2rem; font-weight:600; }
        .lr-row { display:grid; gap:1rem; margin-bottom:1rem; }
        .lr-row-2 { grid-template-columns:1fr 1fr; }
        .lr-row-3 { grid-template-columns:1fr 1fr 1fr; }
        @media(max-width:768px){ .lr-row-2,.lr-row-3 { grid-template-columns:1fr; } }
        .lr-preview {
            padding:1rem 1.25rem; border-radius:14px; background:#f0fdf4; border:1px solid #bbf7d0;
            display:flex; align-items:center; justify-content:space-between; margin-bottom:1rem;
        }
        .lr-preview-label { font-size:.65rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--lr-faint); }
        .lr-preview-value { font-size:1.2rem; font-weight:800; color:#065f46; }
        .lr-preview-interest .lr-preview-value { color:#92400e; font-size:1rem; }
        .lr-footer { padding:.85rem 1.25rem; border-top:1px solid var(--lr-border); display:flex; justify-content:flex-end; gap:.65rem; }
        .lr-btn {
            display:inline-flex; align-items:center; gap:.35rem; padding:.5rem 1.2rem; border-radius:10px;
            font-size:.84rem; font-weight:600; border:none; cursor:pointer; transition:all .2s;
        }
        .lr-btn-ghost { background:#f1f5f9; color:var(--lr-muted); text-decoration:none; }
        .lr-btn-ghost:hover { background:#e2e8f0; color:var(--lr-text); text-decoration:none; }
        .lr-btn-primary { background:linear-gradient(135deg,var(--lr-navy),var(--lr-navy-light)); color:#fff; }
        .lr-btn-primary:hover { transform:translateY(-1px); box-shadow:0 4px 12px rgba(30,58,95,.3); }
        .lr-btn-primary:disabled { opacity:.6; cursor:not-allowed; transform:none; box-shadow:none; }
        .lr-flash { display:flex; align-items:center; gap:.5rem; padding:.7rem 1.15rem; border-radius:12px; font-size:.84rem; font-weight:600; margin-bottom:1rem; }
        .lr-flash-success { background:#f0fdf4; color:var(--lr-green); border:1px solid #bbf7d0; }
        .lr-flash-warning { background:#fffbeb; color:#92400e; border:1px solid #fde68a; }
        .lr-flash-danger { background:#fef2f2; color:var(--lr-red); border:1px solid #fecaca; }
        .lr-steps { padding:1rem 1.25rem; }
        .lr-step { display:flex; align-items:flex-start; gap:.75rem; padding:.5rem 0; }
        .lr-step-num {
            width:28px; height:28px; border-radius:50%; background:var(--lr-navy); color:#fff;
            display:flex; align-items:center; justify-content:center; font-size:.7rem; font-weight:700; flex-shrink:0;
        }
        .lr-step-text { font-size:.84rem; color:var(--lr-muted); line-height:1.5; padding-top:.3rem; }
        @keyframes lrSlide { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
        .lr-animate { animation:lrSlide .3s ease; }
        .lr-elig-stat {
            padding:.65rem .75rem; border-radius:10px; background:#f8fafc; border:1px solid var(--lr-border);
        }
        .lr-elig-stat-label { font-size:.65rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--lr-faint); }
        .lr-elig-stat-value { font-size:1rem; font-weight:800; color:var(--lr-navy); margin:.1rem 0; }
        .lr-elig-stat-hint { font-size:.68rem; color:var(--lr-muted); }
        @media(max-width:768px){ .lr-content{padding:0 .75rem 1.5rem;} }
    </style>
    @endpush

    @can('request-loans')
    <section class="content lr-page">
        <div class="lr-hero">
            <div class="lr-hero-inner container-fluid">
                <div>
                    <ul class="lr-breadcrumb">
                        <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                        <li class="sep">/</li>
                        <li><a href="{{ route('loans.index') }}">Loans</a></li>
                        <li class="sep">/</li>
                        <li class="active">Request Loan</li>
                    </ul>
                    <h1 class="lr-hero-title">Request Loan</h1>
                    <p class="lr-hero-sub">Submit a new loan request for a circle member</p>
                </div>
                <a href="{{ route('loans.index') }}" class="lr-back"><i class="fas fa-arrow-left"></i> Back to Loans</a>
            </div>
        </div>

        <div class="lr-content container-fluid lr-animate">
            @if ($successMessage)
                <div class="lr-flash lr-flash-success">
                    <i class="fas fa-check-circle"></i> {{ $successMessage }}
                    <a href="{{ route('loans.index') }}" style="margin-left:.5rem;font-weight:700;color:#065f46;">View Loans &rarr;</a>
                </div>
            @endif
            @if (session()->has('warning'))
                <div class="lr-flash lr-flash-warning"><i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}</div>
            @endif

            <div style="display:grid;grid-template-columns:1fr 340px;gap:1.25rem;align-items:start;">
                {{-- Form --}}
                <div class="lr-card">
                    <div class="lr-card-head">
                        <h3 class="lr-card-title"><i class="fas fa-file-invoice-dollar"></i> Loan Details</h3>
                    </div>
                    <form wire:submit.prevent="submitRequest">
                        <div class="lr-card-body">
                            @if ($errors->any())
                                <div class="lr-flash lr-flash-danger" style="margin-bottom:1rem;">
                                    <i class="fas fa-exclamation-circle"></i> Please fix the errors below.
                                </div>
                            @endif

                            {{-- Village Bank --}}
                            <div class="lr-row" style="margin-bottom:1rem;">
                                <div>
                                    <label class="lr-label">Village Bank</label>
                                    <select wire:model.live="villageBankId" class="lr-input">
                                        <option value="">All Village Banks</option>
                                        @foreach ($this->villageBanks as $vb)
                                            <option value="{{ $vb->id }}">{{ $vb->name }} ({{ $vb->code }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Circle & Month --}}
                            <div class="lr-row lr-row-2">
                                <div>
                                    <label class="lr-label">Circle <span style="color:var(--lr-red);">*</span></label>
                                    <select wire:model.live="circleId" class="lr-input @error('circleId') lr-input-error @enderror">
                                        <option value="">-- Select Circle --</option>
                                        @foreach ($circles as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }} ({{ $c->members_count }} members)</option>
                                        @endforeach
                                    </select>
                                    @error('circleId') <div class="lr-error">{{ $message }}</div> @enderror
                                </div>
                                <div>
                                    <label class="lr-label">Active Month <span style="color:var(--lr-red);">*</span></label>
                                    <select wire:model.live="monthId" class="lr-input @error('monthId') lr-input-error @enderror" {{ empty($circleId) ? 'disabled' : '' }}>
                                        <option value="">-- Select Month --</option>
                                        @foreach ($months as $mo)
                                            <option value="{{ $mo->id }}">Month {{ $mo->month_number }} ({{ $mo->start_date->format('d M') }} - {{ $mo->end_date->format('d M') }})</option>
                                        @endforeach
                                    </select>
                                    @error('monthId') <div class="lr-error">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            {{-- Borrower --}}
                            <div class="lr-row" style="margin-bottom:1rem;">
                                <div>
                                    <label class="lr-label">Borrower <span style="color:var(--lr-red);">*</span></label>
                                    <select wire:model.live="borrowerId" class="lr-input @error('borrowerId') lr-input-error @enderror" {{ empty($circleId) ? 'disabled' : '' }}>
                                        <option value="">-- Select Member --</option>
                                        @foreach ($membersList as $m)
                                            <option value="{{ $m->id }}">{{ $m->name }} ({{ $m->email }})</option>
                                        @endforeach
                                    </select>
                                    @error('borrowerId') <div class="lr-error">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            {{-- Amount, Rate, Duration --}}
                            <div class="lr-row lr-row-3">
                                <div>
                                    <label class="lr-label">Amount (K) <span style="color:var(--lr-red);">*</span></label>
                                    <input type="number" step="0.01" min="1" wire:model="amount" class="lr-input @error('amount') lr-input-error @enderror" placeholder="0.00">
                                    @error('amount') <div class="lr-error">{{ $message }}</div> @enderror
                                </div>
                                <div>
                                    <label class="lr-label">Interest Rate (%)</label>
                                    <input type="number" step="0.01" min="0" max="100" wire:model="interestRate" class="lr-input" readonly style="background:#f8fafc;cursor:default;">
                                    <div style="font-size:.68rem;color:var(--lr-faint);margin-top:.2rem;">Set in bank configuration</div>
                                </div>
                                <div>
                                    <label class="lr-label">Duration (months) <span style="color:var(--lr-red);">*</span></label>
                                    <input type="number" min="1" max="12" wire:model="duration" class="lr-input @error('duration') lr-input-error @enderror">
                                    @error('duration') <div class="lr-error">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            {{-- Total payable preview --}}
                            @if ($totalPayable > 0)
                                <div class="lr-preview">
                                    <div>
                                        <div class="lr-preview-label">Total Payable</div>
                                        <div class="lr-preview-value">K{{ number_format($totalPayable, 2) }}</div>
                                    </div>
                                    <div class="lr-preview-interest" style="text-align:right;">
                                        <div class="lr-preview-label">Interest</div>
                                        <div class="lr-preview-value">K{{ number_format($totalPayable - (float)$amount, 2) }}</div>
                                    </div>
                                </div>
                            @endif

                            {{-- Eligibility panel --}}
                            @if ($eligibility)
                                <div class="lr-eligibility" style="margin-bottom:1rem;">
                                    @if (!empty($eligibility['errors']))
                                        <div class="lr-flash lr-flash-danger" style="flex-direction:column;align-items:flex-start;gap:.35rem;">
                                            <div style="display:flex;align-items:center;gap:.4rem;"><i class="fas fa-ban"></i> <strong>Loan Not Eligible</strong></div>
                                            @foreach($eligibility['errors'] as $err)
                                                <div style="font-size:.78rem;padding-left:1.2rem;">• {{ $err }}</div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="lr-flash lr-flash-success" style="flex-direction:column;align-items:flex-start;gap:.35rem;">
                                            <div style="display:flex;align-items:center;gap:.4rem;"><i class="fas fa-check-circle"></i> <strong>Eligible — Max Borrowable: K{{ number_format($eligibility['max_borrowable'], 2) }}</strong></div>
                                        </div>
                                    @endif

                                    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:.75rem;margin-top:.75rem;">
                                        <div class="lr-elig-stat">
                                            <div class="lr-elig-stat-label">Member Savings</div>
                                            <div class="lr-elig-stat-value">K{{ number_format($eligibility['total_member_savings'], 2) }}</div>
                                            <div class="lr-elig-stat-hint">Shares + Insurance in circle</div>
                                        </div>
                                        <div class="lr-elig-stat">
                                            <div class="lr-elig-stat-label">Multiplier</div>
                                            <div class="lr-elig-stat-value">{{ $eligibility['multiplier'] }}×</div>
                                            <div class="lr-elig-stat-hint">Savings × {{ $eligibility['multiplier'] }} = K{{ number_format($eligibility['savings_limit'], 2) }}</div>
                                        </div>
                                        <div class="lr-elig-stat">
                                            <div class="lr-elig-stat-label">Available Funds</div>
                                            <div class="lr-elig-stat-value">K{{ number_format($eligibility['available_funds'], 2) }}</div>
                                            <div class="lr-elig-stat-hint">Pool this month after loans</div>
                                        </div>
                                        <div class="lr-elig-stat">
                                            <div class="lr-elig-stat-label">Month Inflow</div>
                                            <div class="lr-elig-stat-value">K{{ number_format($eligibility['month_inflow'], 2) }}</div>
                                            <div class="lr-elig-stat-hint">Shares + Ins + Repayments</div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="lr-footer">
                            <a href="{{ route('loans.index') }}" class="lr-btn lr-btn-ghost">Cancel</a>
                            <button type="submit" class="lr-btn lr-btn-primary" wire:loading.attr="disabled" wire:target="submitRequest">
                                <span wire:loading.remove wire:target="submitRequest"><i class="fas fa-paper-plane"></i> Submit Request</span>
                                <span wire:loading wire:target="submitRequest"><i class="fas fa-spinner fa-spin"></i> Submitting...</span>
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Sidebar — Process --}}
                <div class="lr-card">
                    <div class="lr-card-head">
                        <h3 class="lr-card-title"><i class="fas fa-info-circle"></i> Loan Process</h3>
                    </div>
                    <div class="lr-steps">
                        <div class="lr-step"><div class="lr-step-num">1</div><div class="lr-step-text">Submit loan request with amount, rate & duration</div></div>
                        <div class="lr-step"><div class="lr-step-num">2</div><div class="lr-step-text">Admin reviews and approves or rejects</div></div>
                        <div class="lr-step"><div class="lr-step-num">3</div><div class="lr-step-text">Approved loans are paired with lenders</div></div>
                        <div class="lr-step"><div class="lr-step-num">4</div><div class="lr-step-text">Loan becomes active when fully paired</div></div>
                        <div class="lr-step"><div class="lr-step-num">5</div><div class="lr-step-text">Borrower repays principal + interest</div></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
