<div>
    @push('custom-styles')
    <style>
        :root {
            --cc-navy:#1E3A5F; --cc-navy-light:#2B6B96; --cc-amber:#D97706; --cc-amber-light:#F59E0B;
            --cc-bg:#f4f6fa; --cc-card:#fff; --cc-border:#edf0f7; --cc-text:#1e293b;
            --cc-muted:#64748b; --cc-faint:#94a3b8; --cc-green:#16a34a; --cc-radius:16px;
        }
        .cc-page { background:var(--cc-bg); min-height:100vh; }

        /* Hero */
        .cc-hero {
            background:linear-gradient(135deg,var(--cc-navy) 0%,#234b78 50%,var(--cc-navy-light) 100%);
            padding:1.75rem 0 6rem; position:relative; overflow:hidden;
        }
        .cc-hero::before { content:''; position:absolute; width:600px; height:600px; top:-60%; right:-8%; background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
        .cc-hero-inner { position:relative; z-index:2; padding:0 1.5rem; }
        .cc-breadcrumb { display:flex; gap:.5rem; list-style:none; padding:0; margin:0 0 .75rem; font-size:.82rem; }
        .cc-breadcrumb a { color:rgba(255,255,255,.55); text-decoration:none; }
        .cc-breadcrumb a:hover { color:rgba(255,255,255,.85); }
        .cc-breadcrumb .active { color:var(--cc-amber-light); font-weight:600; }
        .cc-breadcrumb .sep { color:rgba(255,255,255,.25); }
        .cc-back { display:inline-flex; align-items:center; gap:.35rem; color:rgba(255,255,255,.65); font-size:.82rem; font-weight:600; text-decoration:none; margin-bottom:.6rem; }
        .cc-back:hover { color:#fff; text-decoration:none; }
        .cc-hero-title h1 { color:#fff; font-size:1.6rem; font-weight:800; margin:0; }
        .cc-hero-title h1 i { color:var(--cc-amber); margin-right:.5rem; }
        .cc-hero-sub { color:rgba(255,255,255,.55); font-size:.88rem; margin:.25rem 0 0; }

        /* Content */
        .cc-content { margin-top:-4rem; position:relative; z-index:10; padding:0 1.5rem 2rem; }

        /* Card */
        .cc-card {
            background:var(--cc-card); border-radius:var(--cc-radius); border:1px solid var(--cc-border);
            box-shadow:0 2px 12px rgba(0,0,0,.04); overflow:hidden;
        }
        .cc-card-header {
            padding:1rem 1.5rem; border-bottom:1px solid var(--cc-border);
            display:flex; align-items:center; gap:.4rem; font-size:.95rem; font-weight:700; color:var(--cc-text);
        }
        .cc-card-header i { color:var(--cc-amber); font-size:.8rem; }
        .cc-card-body { padding:1.5rem; }
        .cc-card-footer { padding:1rem 1.5rem; border-top:1px solid var(--cc-border); display:flex; justify-content:flex-end; gap:.75rem; }

        /* Form */
        .cc-label { font-size:.72rem; text-transform:uppercase; letter-spacing:.5px; font-weight:700; color:var(--cc-faint); margin-bottom:.35rem; }
        .cc-label .req { color:#ef4444; }
        .cc-input {
            width:100%; padding:.55rem .85rem; border:1px solid var(--cc-border); border-radius:10px;
            font-size:.88rem; background:#fafbfd; transition:all .2s;
        }
        .cc-input:focus { outline:none; border-color:var(--cc-amber); background:#fff; box-shadow:0 0 0 3px rgba(217,119,6,.08); }
        .cc-error { font-size:.72rem; color:#ef4444; margin-top:.25rem; font-weight:500; }

        /* Buttons */
        .cc-btn-cancel {
            padding:.55rem 1.25rem; border-radius:10px; font-size:.82rem; font-weight:600;
            background:#f1f5f9; color:var(--cc-text); border:1px solid var(--cc-border);
            text-decoration:none; display:inline-flex; align-items:center; gap:.3rem; transition:all .15s;
        }
        .cc-btn-cancel:hover { background:#e2e8f0; text-decoration:none; color:var(--cc-text); }
        .cc-btn-submit {
            padding:.55rem 1.25rem; border-radius:10px; font-size:.82rem; font-weight:700;
            background:var(--cc-amber); color:#fff; border:none; cursor:pointer;
            display:inline-flex; align-items:center; gap:.35rem; transition:all .2s;
        }
        .cc-btn-submit:hover { background:var(--cc-amber-light); transform:translateY(-1px); box-shadow:0 4px 12px rgba(217,119,6,.25); }
        .cc-btn-submit:disabled { opacity:.6; cursor:not-allowed; transform:none; box-shadow:none; }

        /* End date preview */
        .cc-enddate {
            display:flex; align-items:center; gap:.65rem; padding:.85rem 1rem;
            border-radius:12px; background:rgba(30,58,95,.04); border:1px solid rgba(30,58,95,.1);
        }
        .cc-enddate-icon {
            width:36px; height:36px; border-radius:10px; display:flex; align-items:center; justify-content:center;
            background:var(--cc-navy); color:#fff; font-size:.8rem; flex-shrink:0;
        }
        .cc-enddate-value { font-size:.92rem; font-weight:700; color:var(--cc-text); }
        .cc-enddate-sub { font-size:.72rem; color:var(--cc-faint); margin-top:.1rem; }

        /* Alert */
        .cc-alert-error {
            display:flex; align-items:center; gap:.5rem; padding:.65rem 1rem; border-radius:10px;
            font-size:.82rem; font-weight:600; background:rgba(239,68,68,.06); color:#dc2626; border:1px solid rgba(239,68,68,.15);
            margin-bottom:1.25rem;
        }
        .cc-flash-success {
            display:flex; align-items:center; gap:.5rem; padding:.65rem 1rem; border-radius:10px;
            font-size:.84rem; font-weight:600; background:rgba(22,163,74,.08); color:#166534; border:1px solid #bbf7d0; margin-bottom:1rem;
        }
        .cc-flash-success a { color:var(--cc-amber); font-weight:700; text-decoration:none; margin-left:.5rem; }
        .cc-flash-success a:hover { text-decoration:underline; }

        /* Sidebar info */
        .cc-info-list { list-style:none; padding:0; margin:0; }
        .cc-info-list li {
            display:flex; align-items:flex-start; gap:.65rem; padding:.6rem 0;
            border-bottom:1px solid #f5f7fa; font-size:.84rem; color:var(--cc-muted);
        }
        .cc-info-list li:last-child { border-bottom:none; }
        .cc-info-icon { width:24px; height:24px; border-radius:6px; display:flex; align-items:center; justify-content:center; font-size:.6rem; flex-shrink:0; background:rgba(22,163,74,.08); color:var(--cc-green); }

        /* Lifecycle */
        .cc-lifecycle { display:flex; align-items:center; gap:.5rem; flex-wrap:wrap; }
        .cc-lifecycle-step {
            padding:.35rem .85rem; border-radius:8px; font-size:.72rem; font-weight:700;
        }
        .cc-lifecycle-arrow { color:var(--cc-faint); font-size:.7rem; }

        @keyframes ccSlide { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
        .cc-animate { animation:ccSlide .3s ease; }
        @media(max-width:768px){ .cc-content{padding:0 .75rem 1.5rem;} }
    </style>
    @endpush

    @can('create-circles')
    {{-- License limit alert --}}
    @if ($circleLimitReached)
        <div class="container-fluid mt-3">
            <div class="alert alert-danger" style="border-radius:10px;font-size:0.9rem;border-left:4px solid #dc3545;">
                <i class="fas fa-ban mr-2"></i><strong>Circle Limit Reached:</strong> {{ $circleLimitMessage }}
            </div>
        </div>
    @endif
    <section class="content cc-page">
        {{-- Hero --}}
        <div class="cc-hero">
            <div class="cc-hero-inner container-fluid">
                <a href="{{ route('circles.index') }}" class="cc-back"><i class="fas fa-arrow-left"></i> Back to Circles</a>
                <ul class="cc-breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('circles.index') }}">Circles</a></li>
                    <li class="sep">/</li>
                    <li class="active">Create</li>
                </ul>
                <div class="cc-hero-title">
                    <h1><i class="fas fa-plus-circle"></i>Create Circle</h1>
                    <p class="cc-hero-sub">Set up a new village banking savings circle</p>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="cc-content container-fluid cc-animate">

            {{-- Success --}}
            @if ($successMessage)
                <div class="cc-flash-success">
                    <i class="fas fa-check-circle"></i> {{ $successMessage }}
                    <a href="{{ route('circles.index') }}">View Circles &rarr;</a>
                </div>
            @endif

            {{-- Error --}}
            @if (session()->has('error'))
                <div style="background:#fef2f2;color:#991b1b;border-left:4px solid #dc3545;padding:0.75rem 1rem;border-radius:8px;margin-bottom:1rem;">
                    <i class="fas fa-ban"></i> {{ session('error') }}
                </div>
            @endif

            <div class="row">
                {{-- Form Card --}}
                <div class="col-lg-7">
                    <div class="cc-card">
                        <div class="cc-card-header">
                            <i class="fas fa-circle-notch"></i> Circle Details
                        </div>
                        <form wire:submit.prevent="createCircle">
                            <div class="cc-card-body">

                                @if ($errors->any())
                                    <div class="cc-alert-error">
                                        <i class="fas fa-exclamation-circle"></i>
                                        Please fix the errors below before submitting.
                                    </div>
                                @endif

                                {{-- Village Bank --}}
                                <div style="margin-bottom:1.25rem;">
                                    <label class="cc-label">Village Bank <span class="req">*</span></label>
                                    <select wire:model.live="villageBankId" class="cc-input">
                                        <option value="">-- Select Village Bank --</option>
                                        @foreach ($this->villageBanks as $vb)
                                            <option value="{{ $vb->id }}">{{ $vb->name }} ({{ $vb->code }})</option>
                                        @endforeach
                                    </select>
                                    @error('villageBankId') <div class="cc-error">{{ $message }}</div> @enderror
                                </div>

                                {{-- Circle Name --}}
                                <div style="margin-bottom:1.25rem;">
                                    <label class="cc-label">Circle Name <span class="req">*</span></label>
                                    <input type="text" wire:model="name" class="cc-input" placeholder="e.g. Savings Circle 2026">
                                    @error('name') <div class="cc-error">{{ $message }}</div> @enderror
                                </div>

                                {{-- Duration & Start Date --}}
                                <div class="row" style="margin-bottom:1.25rem;">
                                    <div class="col-md-6">
                                        <label class="cc-label">Duration (Months) <span class="req">*</span></label>
                                        <input type="number" wire:model="durationMonths" class="cc-input" min="1" max="60">
                                        @error('durationMonths') <div class="cc-error">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="cc-label">Start Date <span class="req">*</span></label>
                                        <input type="date" wire:model="startDate" class="cc-input">
                                        @error('startDate') <div class="cc-error">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                {{-- Computed End Date --}}
                                @if ($endDate)
                                    <div style="margin-bottom:.5rem;">
                                        <label class="cc-label">Calculated End Date</label>
                                        <div class="cc-enddate">
                                            <div class="cc-enddate-icon"><i class="fas fa-calendar-check"></i></div>
                                            <div>
                                                <div class="cc-enddate-value">{{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</div>
                                                <div class="cc-enddate-sub">Auto-calculated from start date + duration</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>

                            <div class="cc-card-footer">
                                <a href="{{ route('circles.index') }}" class="cc-btn-cancel">Cancel</a>
                                <button type="submit" class="cc-btn-submit" wire:loading.attr="disabled" wire:target="createCircle" @if($circleLimitReached) disabled title="Circle limit reached" @endif>
                                    <span wire:loading.remove wire:target="createCircle"><i class="fas fa-plus-circle"></i> Create Circle</span>
                                    <span wire:loading wire:target="createCircle"><i class="fas fa-spinner fa-spin"></i> Creating...</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-lg-5">
                    <div class="cc-card" style="margin-bottom:1rem;">
                        <div class="cc-card-header">
                            <i class="fas fa-info-circle"></i> How It Works
                        </div>
                        <div class="cc-card-body" style="padding:1.25rem 1.5rem;">
                            <ul class="cc-info-list">
                                <li><div class="cc-info-icon"><i class="fas fa-check"></i></div> Circles start in <strong>Draft</strong> status</li>
                                <li><div class="cc-info-icon"><i class="fas fa-check"></i></div> Add members before activating the circle</li>
                                <li><div class="cc-info-icon"><i class="fas fa-check"></i></div> <strong>Activate</strong> to start the savings cycle</li>
                                <li><div class="cc-info-icon"><i class="fas fa-check"></i></div> Monthly periods are created for the duration</li>
                                <li><div class="cc-info-icon"><i class="fas fa-check"></i></div> End date is calculated automatically</li>
                                <li><div class="cc-info-icon"><i class="fas fa-check"></i></div> <strong>Complete</strong> when the cycle finishes</li>
                            </ul>
                        </div>
                    </div>

                    <div class="cc-card">
                        <div class="cc-card-header">
                            <i class="fas fa-route"></i> Circle Lifecycle
                        </div>
                        <div class="cc-card-body" style="padding:1.25rem 1.5rem;">
                            <div class="cc-lifecycle">
                                <span class="cc-lifecycle-step" style="background:#f1f5f9;color:#475569;">Draft</span>
                                <i class="fas fa-arrow-right cc-lifecycle-arrow"></i>
                                <span class="cc-lifecycle-step" style="background:rgba(37,99,235,.08);color:#1e40af;">Active</span>
                                <i class="fas fa-arrow-right cc-lifecycle-arrow"></i>
                                <span class="cc-lifecycle-step" style="background:rgba(22,163,74,.08);color:#166534;">Completed</span>
                            </div>
                            <p style="font-size:.78rem;color:var(--cc-faint);margin-top:.75rem;margin-bottom:0;">
                                Status can only move forward through the lifecycle.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
