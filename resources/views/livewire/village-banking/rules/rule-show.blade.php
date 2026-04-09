<div>
    @push('custom-styles')
    <style>
        :root {
            --rd-navy:#1E3A5F;--rd-navy-light:#2B6B96;--rd-amber:#D97706;--rd-amber-light:#F59E0B;
            --rd-bg:#f4f6fa;--rd-card:#fff;--rd-border:#edf0f7;--rd-text:#1e293b;
            --rd-muted:#64748b;--rd-faint:#94a3b8;--rd-green:#16a34a;--rd-red:#dc2626;--rd-blue:#2563eb;--rd-purple:#7c3aed;--rd-radius:16px;
        }
        .rd-page{background:var(--rd-bg);min-height:100vh;}

        /* Hero */
        .rd-hero{background:linear-gradient(135deg,var(--rd-navy) 0%,#234b78 50%,var(--rd-navy-light) 100%);padding:1.75rem 0 6rem;position:relative;overflow:hidden;}
        .rd-hero::before{content:'';position:absolute;width:600px;height:600px;top:-60%;right:-8%;background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%);border-radius:50%;pointer-events:none;}
        .rd-hero-inner{position:relative;z-index:2;padding:0 1.5rem;}
        .rd-breadcrumb{display:flex;gap:.5rem;list-style:none;padding:0;margin:0 0 .75rem;font-size:.82rem;}
        .rd-breadcrumb a{color:rgba(255,255,255,.55);text-decoration:none;}
        .rd-breadcrumb a:hover{color:rgba(255,255,255,.85);}
        .rd-breadcrumb .active{color:var(--rd-amber-light);font-weight:600;}
        .rd-breadcrumb .sep{color:rgba(255,255,255,.25);}
        .rd-hero-row{display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:.75rem;}
        .rd-hero-title h1{color:#fff;font-size:1.5rem;font-weight:800;margin:0;}
        .rd-hero-title h1 i{color:var(--rd-amber);margin-right:.5rem;}
        .rd-hero-sub{color:rgba(255,255,255,.55);font-size:.85rem;margin:.25rem 0 0;}
        .rd-hero-actions{display:flex;gap:.5rem;flex-wrap:wrap;}
        .rd-hero-btn{display:inline-flex;align-items:center;gap:.4rem;padding:.5rem 1.1rem;border-radius:10px;font-size:.82rem;font-weight:700;text-decoration:none;transition:all .2s;border:none;cursor:pointer;}
        .rd-hero-btn-primary{background:var(--rd-amber);color:#fff;}
        .rd-hero-btn-primary:hover{background:var(--rd-amber-light);color:#fff;text-decoration:none;transform:translateY(-1px);box-shadow:0 4px 12px rgba(217,119,6,.25);}
        .rd-hero-btn-outline{background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);color:rgba(255,255,255,.8);}
        .rd-hero-btn-outline:hover{background:rgba(255,255,255,.15);color:#fff;text-decoration:none;}

        /* Content */
        .rd-content{margin-top:-4rem;position:relative;z-index:10;padding:0 1.5rem 2rem;}
        .rd-grid{display:grid;grid-template-columns:1fr 340px;gap:1.25rem;}
        @media(max-width:992px){.rd-grid{grid-template-columns:1fr;}}

        /* Card */
        .rd-card{background:var(--rd-card);border-radius:var(--rd-radius);border:1px solid var(--rd-border);box-shadow:0 2px 12px rgba(0,0,0,.04);overflow:hidden;}
        .rd-card-header{padding:1rem 1.25rem;display:flex;align-items:center;justify-content:space-between;gap:.5rem;border-bottom:1px solid var(--rd-border);}
        .rd-card-title{font-size:.88rem;font-weight:700;color:var(--rd-text);display:flex;align-items:center;gap:.4rem;}
        .rd-card-title i{color:var(--rd-amber);font-size:.75rem;}
        .rd-card-body{padding:1.25rem 1.5rem;}

        /* Alert */
        .rd-alert{padding:.7rem 1rem;border-radius:12px;font-size:.84rem;display:flex;align-items:center;gap:.5rem;margin-bottom:1rem;background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;}

        /* Badge */
        .rd-badge{display:inline-flex;align-items:center;gap:.25rem;padding:.25rem .65rem;border-radius:8px;font-size:.7rem;font-weight:700;}

        /* Category colors */
        .rd-cat-general{background:rgba(100,116,139,.06);color:#475569;border:1px solid rgba(100,116,139,.15);}
        .rd-cat-loans{background:rgba(37,99,235,.06);color:#1e40af;border:1px solid rgba(37,99,235,.15);}
        .rd-cat-shares{background:rgba(22,163,74,.06);color:#166534;border:1px solid rgba(22,163,74,.15);}
        .rd-cat-penalties{background:rgba(220,38,38,.06);color:#991b1b;border:1px solid rgba(220,38,38,.15);}
        .rd-cat-membership{background:rgba(124,58,237,.06);color:#5b21b6;border:1px solid rgba(124,58,237,.15);}
        .rd-cat-meetings{background:rgba(217,119,6,.06);color:#92400e;border:1px solid rgba(217,119,6,.15);}

        /* Main */
        .rd-main{display:flex;flex-direction:column;gap:1.25rem;}

        /* Rule body */
        .rd-rule-body{font-size:.92rem;line-height:1.8;color:var(--rd-text);white-space:pre-wrap;}

        /* Sidebar */
        .rd-sidebar{display:flex;flex-direction:column;gap:1.25rem;}

        /* Info rows */
        .rd-info{padding:.75rem 1.25rem;}
        .rd-info-row{display:flex;align-items:center;justify-content:space-between;padding:.55rem 0;border-bottom:1px solid #f8f9fb;}
        .rd-info-row:last-child{border-bottom:none;}
        .rd-info-label{font-size:.76rem;color:var(--rd-faint);display:flex;align-items:center;gap:.35rem;}
        .rd-info-label i{font-size:.6rem;width:14px;text-align:center;color:var(--rd-navy);}
        .rd-info-value{font-size:.82rem;font-weight:700;color:var(--rd-text);}

        /* Progress card */
        .rd-progress-card{padding:1.25rem;}
        .rd-progress-info{display:flex;justify-content:space-between;align-items:center;margin-bottom:.5rem;}
        .rd-progress-label{font-size:.75rem;color:var(--rd-faint);font-weight:600;}
        .rd-progress-pct{font-size:1.1rem;font-weight:800;color:var(--rd-green);}
        .rd-progress-bar{width:100%;height:10px;background:var(--rd-border);border-radius:10px;overflow:hidden;}
        .rd-progress-fill{height:100%;border-radius:10px;background:linear-gradient(90deg,var(--rd-green),#22c55e);transition:width .4s;}

        /* Ack list */
        .rd-ack-list{padding:.5rem 1.25rem 1rem;}
        .rd-ack-item{display:flex;align-items:center;justify-content:space-between;padding:.5rem 0;border-bottom:1px solid #f8f9fb;}
        .rd-ack-item:last-child{border-bottom:none;}
        .rd-ack-member{display:flex;align-items:center;gap:.5rem;}
        .rd-avatar{width:30px;height:30px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.58rem;flex-shrink:0;background:linear-gradient(135deg,var(--rd-navy),var(--rd-navy-light));color:#fff;}
        .rd-ack-name{font-weight:700;font-size:.82rem;color:var(--rd-text);}
        .rd-ack-date{font-size:.7rem;color:var(--rd-faint);}

        /* Acknowledge button */
        .rd-ack-btn{display:flex;align-items:center;justify-content:center;gap:.4rem;padding:.65rem 1.25rem;border-radius:10px;font-size:.85rem;font-weight:700;border:none;cursor:pointer;transition:all .2s;width:100%;background:var(--rd-green);color:#fff;}
        .rd-ack-btn:hover{background:#15803d;transform:translateY(-1px);box-shadow:0 4px 14px rgba(22,163,74,.2);}
        .rd-acked-status{display:flex;align-items:center;justify-content:center;gap:.35rem;padding:.65rem;border-radius:10px;font-size:.85rem;font-weight:700;background:rgba(22,163,74,.06);color:var(--rd-green);border:1px solid rgba(22,163,74,.15);}

        /* Empty */
        .rd-empty{text-align:center;padding:2rem 1rem;}
        .rd-empty i{font-size:1.5rem;opacity:.12;display:block;margin-bottom:.5rem;color:var(--rd-navy);}
        .rd-empty p{font-size:.82rem;color:var(--rd-muted);margin:0;}

        @keyframes rdSlide{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
        .rd-animate{animation:rdSlide .3s ease;}
        @media(max-width:768px){.rd-content{padding:0 .75rem 1.5rem;}}
    </style>
    @endpush

    @can('view-rules')
    @php
        $catLabels = \App\Models\VillageBanking\Rule::CATEGORIES;
        $catClass  = 'rd-cat-' . $rule->category;
        $rate      = $this->ackRate;
        $isAcked   = $this->isAcked;
    @endphp

    <section class="content rd-page">
        {{-- ████ Hero ████ --}}
        <div class="rd-hero">
            <div class="rd-hero-inner container-fluid">
                <ul class="rd-breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('rules.manage') }}">Rules</a></li>
                    <li class="sep">/</li>
                    <li class="active">{{ Str::limit($rule->title, 30) }}</li>
                </ul>
                <div class="rd-hero-row">
                    <div class="rd-hero-title">
                        <h1><i class="fas fa-book-open"></i>{{ $rule->title }}</h1>
                        <p class="rd-hero-sub">{{ $catLabels[$rule->category] ?? ucfirst($rule->category) }} &mdash; {{ $rule->villageBank->name ?? '--' }}</p>
                    </div>
                    <div class="rd-hero-actions">
                        @if (!$isAcked)
                            <button wire:click="acknowledge" class="rd-hero-btn rd-hero-btn-primary">
                                <i class="fas fa-handshake"></i> Acknowledge
                            </button>
                        @endif
                        <a href="{{ route('rules.manage') }}" class="rd-hero-btn rd-hero-btn-outline">
                            <i class="fas fa-arrow-left"></i> Back to Rules
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- ████ Content ████ --}}
        <div class="rd-content container-fluid rd-animate">

            @if (session()->has('message'))
                <div class="rd-alert"><i class="fas fa-check-circle"></i> {{ session('message') }}</div>
            @endif

            <div class="rd-grid">
                {{-- ██ LEFT — Main ██ --}}
                <div class="rd-main">
                    {{-- Status badges --}}
                    <div style="display:flex;gap:.5rem;flex-wrap:wrap;">
                        <span class="rd-badge {{ $catClass }}">
                            <i class="fas fa-tag" style="font-size:.45rem;"></i> {{ $catLabels[$rule->category] ?? ucfirst($rule->category) }}
                        </span>
                        @if ($rule->is_active)
                            <span class="rd-badge" style="background:rgba(22,163,74,.06);color:var(--rd-green);border:1px solid rgba(22,163,74,.2);">
                                <i class="fas fa-circle" style="font-size:.3rem;"></i> Active
                            </span>
                        @else
                            <span class="rd-badge" style="background:rgba(220,38,38,.06);color:var(--rd-red);border:1px solid rgba(220,38,38,.2);">
                                <i class="fas fa-circle" style="font-size:.3rem;"></i> Inactive
                            </span>
                        @endif
                        <span class="rd-badge" style="background:rgba(30,58,95,.06);color:var(--rd-navy);border:1px solid rgba(30,58,95,.15);">
                            <i class="fas fa-university" style="font-size:.45rem;"></i> {{ $rule->villageBank->name ?? '--' }}
                        </span>
                        <span class="rd-badge" style="background:rgba(217,119,6,.06);color:var(--rd-amber);border:1px solid rgba(217,119,6,.15);">
                            <i class="fas fa-sort-numeric-down" style="font-size:.45rem;"></i> Order #{{ $rule->sort_order }}
                        </span>
                    </div>

                    {{-- Rule text --}}
                    <div class="rd-card">
                        <div class="rd-card-header">
                            <div class="rd-card-title"><i class="fas fa-file-alt"></i> Rule Description</div>
                        </div>
                        <div class="rd-card-body">
                            <div class="rd-rule-body">{!! nl2br(e($rule->description)) !!}</div>
                        </div>
                    </div>

                    {{-- Acknowledgement list --}}
                    <div class="rd-card">
                        <div class="rd-card-header">
                            <div class="rd-card-title"><i class="fas fa-check-double"></i> Acknowledged By ({{ $rule->acknowledgements->count() }})</div>
                        </div>
                        @if ($rule->acknowledgements->count())
                            <div class="rd-ack-list">
                                @foreach ($rule->acknowledgements->sortByDesc('acknowledged_at') as $ack)
                                    @php
                                        $parts = explode(' ', trim($ack->user->name ?? ''));
                                        $ini   = strtoupper(substr($parts[0],0,1) . (isset($parts[1]) ? substr($parts[1],0,1) : ''));
                                    @endphp
                                    <div class="rd-ack-item">
                                        <div class="rd-ack-member">
                                            <div class="rd-avatar">{{ $ini }}</div>
                                            <span class="rd-ack-name">{{ $ack->user->name ?? 'Unknown' }}</span>
                                        </div>
                                        <span class="rd-ack-date">{{ $ack->acknowledged_at ? $ack->acknowledged_at->format('d M Y, H:i') : '--' }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="rd-empty">
                                <i class="fas fa-handshake"></i>
                                <p>No members have acknowledged this rule yet</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- ██ RIGHT — Sidebar ██ --}}
                <div class="rd-sidebar">
                    {{-- Acknowledgement progress --}}
                    <div class="rd-card">
                        <div class="rd-card-header"><div class="rd-card-title"><i class="fas fa-tasks"></i> Acknowledgement Progress</div></div>
                        <div class="rd-progress-card">
                            <div class="rd-progress-info">
                                <span class="rd-progress-label">Members acknowledged</span>
                                <span class="rd-progress-pct" style="{{ $rate < 50 ? 'color:var(--rd-red);' : ($rate < 100 ? 'color:var(--rd-amber);' : '') }}">{{ $rate }}%</span>
                            </div>
                            <div class="rd-progress-bar">
                                <div class="rd-progress-fill" style="width:{{ $rate }}%;{{ $rate < 50 ? 'background:linear-gradient(90deg,var(--rd-red),#ef4444);' : ($rate < 100 ? 'background:linear-gradient(90deg,var(--rd-amber),var(--rd-amber-light));' : '') }}"></div>
                            </div>
                            <div style="display:flex;justify-content:space-between;margin-top:.4rem;">
                                <span style="font-size:.7rem;color:var(--rd-faint);">{{ $rule->acknowledgements->count() }} acknowledged</span>
                            </div>
                        </div>
                    </div>

                    {{-- Your status --}}
                    <div class="rd-card">
                        <div class="rd-card-header"><div class="rd-card-title"><i class="fas fa-user-check"></i> Your Status</div></div>
                        <div style="padding:1rem 1.25rem;">
                            @if ($isAcked)
                                <div class="rd-acked-status">
                                    <i class="fas fa-check-double"></i> You have acknowledged this rule
                                </div>
                            @else
                                <button wire:click="acknowledge" class="rd-ack-btn">
                                    <i class="fas fa-handshake"></i> Acknowledge This Rule
                                </button>
                            @endif
                        </div>
                    </div>

                    {{-- Rule info --}}
                    <div class="rd-card">
                        <div class="rd-card-header"><div class="rd-card-title"><i class="fas fa-info-circle"></i> Rule Details</div></div>
                        <div class="rd-info">
                            <div class="rd-info-row">
                                <span class="rd-info-label"><i class="fas fa-hashtag"></i> Rule ID</span>
                                <span class="rd-info-value">#{{ $rule->id }}</span>
                            </div>
                            <div class="rd-info-row">
                                <span class="rd-info-label"><i class="fas fa-university"></i> Village Bank</span>
                                <span class="rd-info-value">{{ $rule->villageBank->name ?? '--' }}</span>
                            </div>
                            <div class="rd-info-row">
                                <span class="rd-info-label"><i class="fas fa-tag"></i> Category</span>
                                <span class="rd-info-value">{{ $catLabels[$rule->category] ?? ucfirst($rule->category) }}</span>
                            </div>
                            <div class="rd-info-row">
                                <span class="rd-info-label"><i class="fas fa-sort-numeric-down"></i> Sort Order</span>
                                <span class="rd-info-value">{{ $rule->sort_order }}</span>
                            </div>
                            <div class="rd-info-row">
                                <span class="rd-info-label"><i class="fas fa-user"></i> Created By</span>
                                <span class="rd-info-value">{{ $rule->creator->name ?? 'Unknown' }}</span>
                            </div>
                            <div class="rd-info-row">
                                <span class="rd-info-label"><i class="fas fa-calendar-alt"></i> Created</span>
                                <span class="rd-info-value">{{ $rule->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="rd-info-row">
                                <span class="rd-info-label"><i class="fas fa-edit"></i> Last Updated</span>
                                <span class="rd-info-value">{{ $rule->updated_at->format('d M Y') }}</span>
                            </div>
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
