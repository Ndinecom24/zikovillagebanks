<div>
    @push('custom-styles')
    <style>
        :root {
            --pv-navy:#1E3A5F;--pv-navy-light:#2B6B96;--pv-amber:#D97706;--pv-amber-light:#F59E0B;
            --pv-bg:#f4f6fa;--pv-card:#fff;--pv-border:#edf0f7;--pv-text:#1e293b;
            --pv-muted:#64748b;--pv-faint:#94a3b8;--pv-green:#16a34a;--pv-red:#dc2626;--pv-blue:#2563eb;--pv-purple:#7c3aed;--pv-radius:16px;
        }
        .pv-page{background:var(--pv-bg);min-height:100vh;}

        /* Hero */
        .pv-hero{background:linear-gradient(135deg,var(--pv-navy) 0%,#234b78 50%,var(--pv-navy-light) 100%);padding:1.75rem 0 6rem;position:relative;overflow:hidden;}
        .pv-hero::before{content:'';position:absolute;width:600px;height:600px;top:-60%;right:-8%;background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%);border-radius:50%;pointer-events:none;}
        .pv-hero-inner{position:relative;z-index:2;padding:0 1.5rem;}
        .pv-breadcrumb{display:flex;gap:.5rem;list-style:none;padding:0;margin:0 0 .75rem;font-size:.82rem;}
        .pv-breadcrumb a{color:rgba(255,255,255,.55);text-decoration:none;}
        .pv-breadcrumb a:hover{color:rgba(255,255,255,.85);}
        .pv-breadcrumb .active{color:var(--pv-amber-light);font-weight:600;}
        .pv-breadcrumb .sep{color:rgba(255,255,255,.25);}
        .pv-hero-row{display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:.75rem;}
        .pv-hero-title h1{color:#fff;font-size:1.6rem;font-weight:800;margin:0;}
        .pv-hero-title h1 i{color:var(--pv-amber);margin-right:.5rem;}
        .pv-hero-sub{color:rgba(255,255,255,.55);font-size:.88rem;margin:.25rem 0 0;}
        .pv-hero-btn{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1.25rem;border-radius:10px;font-size:.82rem;font-weight:700;text-decoration:none;transition:all .2s;border:none;cursor:pointer;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);color:rgba(255,255,255,.8);}
        .pv-hero-btn:hover{background:rgba(255,255,255,.15);color:#fff;text-decoration:none;}

        /* Content */
        .pv-content{margin-top:-4rem;position:relative;z-index:10;padding:0 1.5rem 2rem;}

        /* Card */
        .pv-card{background:var(--pv-card);border-radius:var(--pv-radius);border:1px solid var(--pv-border);box-shadow:0 2px 12px rgba(0,0,0,.04);overflow:hidden;margin-bottom:1rem;}
        .pv-card-header{padding:1rem 1.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.5rem;border-bottom:1px solid var(--pv-border);}
        .pv-card-title{font-size:.95rem;font-weight:700;color:var(--pv-text);display:flex;align-items:center;gap:.4rem;}
        .pv-card-title i{color:var(--pv-amber);font-size:.8rem;}

        /* Alert */
        .pv-alert{padding:.7rem 1rem;border-radius:12px;font-size:.84rem;display:flex;align-items:center;gap:.5rem;margin-bottom:1rem;}
        .pv-alert-success{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;}
        .pv-alert-warning{background:#fffbeb;color:#92400e;border:1px solid #fde68a;}

        /* Selector */
        .pv-selector{display:grid;grid-template-columns:1fr 2fr auto;gap:1rem;align-items:end;}
        @media(max-width:768px){.pv-selector{grid-template-columns:1fr;}}
        .pv-label{display:block;font-size:.7rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--pv-faint);margin-bottom:.35rem;}
        .pv-input{width:100%;padding:.55rem .85rem;border:1px solid var(--pv-border);border-radius:10px;font-size:.85rem;background:#fafbfd;cursor:pointer;transition:border .2s;}
        .pv-input:focus{outline:none;border-color:var(--pv-amber);background:#fff;box-shadow:0 0 0 3px rgba(217,119,6,.08);}
        .pv-active-count{display:inline-flex;align-items:center;gap:.3rem;padding:.35rem .65rem;border-radius:10px;font-size:.78rem;font-weight:700;white-space:nowrap;}

        /* Badge */
        .pv-badge{display:inline-flex;align-items:center;gap:.25rem;padding:.2rem .55rem;border-radius:8px;font-size:.68rem;font-weight:700;}

        /* Voting Form */
        .pv-option-list{list-style:none;padding:0;margin:0;}
        .pv-option-item{display:flex;align-items:center;gap:.75rem;padding:.75rem 1rem;border-radius:12px;border:1.5px solid var(--pv-border);margin-bottom:.5rem;cursor:pointer;transition:all .2s;background:#fafbfd;}
        .pv-option-item:hover{border-color:var(--pv-navy);background:rgba(30,58,95,.02);}
        .pv-option-item.selected{border-color:var(--pv-navy);background:rgba(30,58,95,.04);box-shadow:0 0 0 3px rgba(30,58,95,.06);}
        .pv-option-item input[type="radio"],.pv-option-item input[type="checkbox"]{display:none;}
        .pv-option-indicator{width:20px;height:20px;border-radius:50%;border:2px solid var(--pv-faint);display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all .2s;}
        .pv-option-indicator.checkbox-type{border-radius:5px;}
        .pv-option-item.selected .pv-option-indicator{border-color:var(--pv-navy);background:var(--pv-navy);}
        .pv-option-item.selected .pv-option-indicator::after{content:'\f00c';font-family:"Font Awesome 5 Free";font-weight:900;color:#fff;font-size:.55rem;}
        .pv-option-label{font-size:.88rem;font-weight:600;color:var(--pv-text);flex:1;}

        /* Vote button */
        .pv-btn{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1.25rem;border-radius:10px;font-size:.82rem;font-weight:700;border:none;cursor:pointer;transition:all .2s;}
        .pv-btn-primary{background:var(--pv-navy);color:#fff;}
        .pv-btn-primary:hover{background:var(--pv-navy-light);transform:translateY(-1px);box-shadow:0 4px 12px rgba(30,58,95,.25);}
        .pv-voted-tag{display:inline-flex;align-items:center;gap:.3rem;font-size:.82rem;color:var(--pv-green);font-weight:600;margin-left:.5rem;}

        /* Deadline pill */
        .pv-deadline{display:flex;align-items:center;gap:.4rem;padding:.5rem .85rem;border-radius:10px;font-size:.82rem;color:var(--pv-muted);background:#f8fafc;border:1px solid var(--pv-border);margin-top:.75rem;}
        .pv-deadline i{font-size:.7rem;}

        /* Results */
        .pv-result-bar{margin-bottom:.75rem;}
        .pv-result-label{display:flex;justify-content:space-between;align-items:center;margin-bottom:.25rem;}
        .pv-result-label span:first-child{font-size:.84rem;font-weight:600;color:var(--pv-text);}
        .pv-result-label span:last-child{font-size:.82rem;font-weight:700;}
        .pv-result-track{height:10px;background:#edf0f7;border-radius:6px;overflow:hidden;}
        .pv-result-fill{height:100%;border-radius:6px;transition:width .4s ease;}
        .pv-result-votes{font-size:.72rem;color:var(--pv-faint);margin-top:.15rem;}
        .pv-result-summary{display:flex;justify-content:space-between;padding:.6rem 0;border-top:1px solid var(--pv-border);margin-top:.25rem;}
        .pv-result-summary span{font-size:.82rem;color:var(--pv-muted);display:flex;align-items:center;gap:.3rem;}

        /* Info Table */
        .pv-info-table{width:100%;font-size:.84rem;}
        .pv-info-table td{padding:.45rem 0;vertical-align:top;}
        .pv-info-table td:first-child{color:var(--pv-faint);width:35%;font-weight:600;}
        .pv-info-table td:last-child{font-weight:700;color:var(--pv-text);}

        /* Comments */
        .pv-comment{display:flex;gap:.65rem;margin-bottom:.85rem;}
        .pv-comment-avatar{width:30px;height:30px;border-radius:10px;background:linear-gradient(135deg,var(--pv-navy),var(--pv-navy-light));display:flex;align-items:center;justify-content:center;font-size:.65rem;font-weight:800;color:#fff;flex-shrink:0;}
        .pv-comment-body{flex:1;}
        .pv-comment-meta{display:flex;align-items:center;gap:.4rem;margin-bottom:.15rem;}
        .pv-comment-name{font-size:.82rem;font-weight:700;color:var(--pv-text);}
        .pv-comment-time{font-size:.72rem;color:var(--pv-faint);}
        .pv-comment-text{font-size:.84rem;color:var(--pv-muted);line-height:1.5;}
        .pv-comment-input{display:flex;gap:.5rem;}
        .pv-comment-input input{flex:1;padding:.5rem .85rem;border:1px solid var(--pv-border);border-radius:10px;font-size:.84rem;background:#fafbfd;}
        .pv-comment-input input:focus{outline:none;border-color:var(--pv-amber);background:#fff;box-shadow:0 0 0 3px rgba(217,119,6,.08);}
        .pv-send-btn{width:38px;height:38px;border-radius:10px;display:flex;align-items:center;justify-content:center;background:var(--pv-green);color:#fff;border:none;cursor:pointer;font-size:.75rem;transition:all .15s;flex-shrink:0;}
        .pv-send-btn:hover{background:#15803d;transform:translateY(-1px);}

        /* Empty */
        .pv-empty{text-align:center;padding:3rem 1rem;}
        .pv-empty i{font-size:2.5rem;opacity:.12;display:block;margin-bottom:.75rem;color:var(--pv-navy);}
        .pv-empty h5{font-size:.95rem;color:var(--pv-muted);font-weight:700;margin:.5rem 0 .25rem;}
        .pv-empty p{font-size:.85rem;color:var(--pv-faint);margin:0;}

        @keyframes pvSlide{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
        .pv-animate{animation:pvSlide .3s ease;}
        @media(max-width:768px){.pv-content{padding:0 .75rem 1.5rem;}}
    </style>
    @endpush

    @can('vote-polls')
    <section class="content pv-page">
        {{-- ████ Hero ████ --}}
        <div class="pv-hero">
            <div class="pv-hero-inner container-fluid">
                <ul class="pv-breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('polls.index') }}">Polls</a></li>
                    <li class="sep">/</li>
                    <li class="active">Vote</li>
                </ul>
                <div class="pv-hero-row">
                    <div class="pv-hero-title">
                        <h1><i class="fas fa-vote-yea"></i>Voting Portal</h1>
                        <p class="pv-hero-sub">Cast your vote on active polls and share your opinion</p>
                    </div>
                    <a href="{{ route('polls.index') }}" class="pv-hero-btn">
                        <i class="fas fa-cog"></i> Poll Management
                    </a>
                </div>
            </div>
        </div>

        {{-- ████ Content ████ --}}
        <div class="pv-content container-fluid pv-animate">

            @if (session()->has('warning'))
                <div class="pv-alert pv-alert-warning"><i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}</div>
            @endif
            @if ($successMessage)
                <div class="pv-alert pv-alert-success"><i class="fas fa-check-circle"></i> {{ $successMessage }}</div>
            @endif

            {{-- Selector --}}
            <div class="pv-card">
                <div style="padding:1rem 1.5rem;">
                    <div class="pv-selector">
                        <div>
                            <label class="pv-label"><i class="fas fa-university" style="color:var(--pv-amber);margin-right:.25rem;"></i> Village Bank</label>
                            <select wire:model="villageBankId" class="pv-input">
                                <option value="">All Village Banks</option>
                                @foreach ($this->villageBanks as $vb)
                                    <option value="{{ $vb->id }}">{{ $vb->name }} ({{ $vb->code }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="pv-label"><i class="fas fa-poll" style="color:var(--pv-green);margin-right:.25rem;"></i> Active Poll</label>
                            <select wire:model="activePollId" class="pv-input">
                                <option value="">-- Select a poll --</option>
                                @foreach ($activePolls as $ap)
                                    <option value="{{ $ap->id }}">
                                        {{ $ap->question }} @if ($ap->villageBank)({{ $ap->villageBank->code }})@endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div style="padding-bottom:.25rem;">
                            @if (count($activePolls) === 0)
                                <span class="pv-active-count" style="background:rgba(100,116,139,.06);color:var(--pv-faint);border:1px solid rgba(100,116,139,.15);">
                                    <i class="fas fa-info-circle"></i> No active polls
                                </span>
                            @else
                                <span class="pv-active-count" style="background:rgba(22,163,74,.06);color:var(--pv-green);border:1px solid rgba(22,163,74,.2);">
                                    <i class="fas fa-circle" style="font-size:.35rem;"></i> {{ count($activePolls) }} active
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if ($currentPoll)
                <div class="row">
                    {{-- ═══ LEFT: Voting + Discussion ═══ --}}
                    <div class="col-lg-7">

                        {{-- Question & Voting --}}
                        <div class="pv-card">
                            <div class="pv-card-header">
                                <div class="pv-card-title" style="font-size:1rem;">
                                    <i class="fas fa-question-circle"></i> {{ $currentPoll->question }}
                                </div>
                                <div style="display:flex;gap:.35rem;">
                                    <span class="pv-badge" style="background:rgba(30,58,95,.06);color:var(--pv-navy);border:1px solid rgba(30,58,95,.15);">
                                        {{ ucfirst($currentPoll->type) }} choice
                                    </span>
                                    @if ($currentPoll->is_anonymous)
                                        <span class="pv-badge" style="background:rgba(217,119,6,.06);color:var(--pv-amber);border:1px solid rgba(217,119,6,.15);">
                                            <i class="fas fa-user-secret" style="font-size:.45rem;"></i> Anonymous
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div style="padding:1.25rem 1.5rem;">
                                @if ($currentPoll->description)
                                    <p style="font-size:.88rem;color:var(--pv-muted);margin:0 0 1rem;line-height:1.5;">{{ $currentPoll->description }}</p>
                                @endif

                                @if ($currentPoll->isOpen())
                                    <form wire:submit.prevent="castVote">
                                        <ul class="pv-option-list">
                                            @if ($currentPoll->type === 'single')
                                                @foreach ($currentPoll->options as $option)
                                                    <li class="pv-option-item {{ $selectedOption == $option->id ? 'selected' : '' }}"
                                                        onclick="document.getElementById('pv_opt_{{ $option->id }}').click();">
                                                        <input type="radio" wire:model="selectedOption" value="{{ $option->id }}" id="pv_opt_{{ $option->id }}">
                                                        <div class="pv-option-indicator"></div>
                                                        <span class="pv-option-label">{{ $option->label }}</span>
                                                    </li>
                                                @endforeach
                                                @error('selectedOption') <small style="color:var(--pv-red);font-size:.78rem;">{{ $message }}</small> @enderror
                                            @else
                                                @foreach ($currentPoll->options as $option)
                                                    <li class="pv-option-item {{ in_array($option->id, $selectedOptions) ? 'selected' : '' }}"
                                                        onclick="document.getElementById('pv_opt_{{ $option->id }}').click();">
                                                        <input type="checkbox" wire:model="selectedOptions" value="{{ $option->id }}" id="pv_opt_{{ $option->id }}">
                                                        <div class="pv-option-indicator checkbox-type"></div>
                                                        <span class="pv-option-label">{{ $option->label }}</span>
                                                    </li>
                                                @endforeach
                                                @error('selectedOptions') <small style="color:var(--pv-red);font-size:.78rem;">{{ $message }}</small> @enderror
                                            @endif
                                        </ul>

                                        <div style="display:flex;align-items:center;margin-top:.75rem;">
                                            <button type="submit" class="pv-btn pv-btn-primary">
                                                <i class="fas fa-vote-yea"></i>
                                                {{ $currentPoll->hasVoted(Auth::id()) ? 'Change Vote' : 'Cast Vote' }}
                                            </button>
                                            @if ($currentPoll->hasVoted(Auth::id()))
                                                <span class="pv-voted-tag">
                                                    <i class="fas fa-check-circle"></i> You voted
                                                </span>
                                            @endif
                                        </div>
                                    </form>
                                @else
                                    <div class="pv-alert pv-alert-warning" style="margin-bottom:0;">
                                        <i class="fas fa-lock"></i> This poll is not currently open for voting.
                                    </div>
                                @endif

                                @if ($currentPoll->ends_at)
                                    <div class="pv-deadline">
                                        <i class="fas fa-clock"></i>
                                        @if ($currentPoll->ends_at->isFuture())
                                            Voting ends {{ $currentPoll->ends_at->diffForHumans() }} ({{ $currentPoll->ends_at->format('d M Y H:i') }})
                                        @else
                                            <span style="color:var(--pv-red);">Voting ended {{ $currentPoll->ends_at->format('d M Y H:i') }}</span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Discussion --}}
                        <div class="pv-card">
                            <div class="pv-card-header">
                                <div class="pv-card-title">
                                    <i class="fas fa-comments"></i> Discussion
                                </div>
                                <span class="pv-badge" style="background:rgba(30,58,95,.06);color:var(--pv-navy);border:1px solid rgba(30,58,95,.15);">
                                    {{ $currentPoll->comments->count() }}
                                </span>
                            </div>
                            <div style="padding:1.25rem 1.5rem;">
                                @if ($currentPoll->comments->count() > 0)
                                    <div style="max-height:310px;overflow-y:auto;margin-bottom:1rem;">
                                        @foreach ($currentPoll->comments as $comment)
                                            <div class="pv-comment">
                                                <div class="pv-comment-avatar">
                                                    {{ strtoupper(substr($comment->user->name ?? '?', 0, 1)) }}
                                                </div>
                                                <div class="pv-comment-body">
                                                    <div class="pv-comment-meta">
                                                        <span class="pv-comment-name">{{ $comment->user->name ?? 'Unknown' }}</span>
                                                        <span class="pv-comment-time">{{ $comment->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    <p class="pv-comment-text" style="margin:0;">{{ $comment->body }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p style="text-align:center;color:var(--pv-faint);font-size:.85rem;padding:.75rem 0;">
                                        <i class="fas fa-comment-slash" style="margin-right:.3rem;"></i> No comments yet. Be the first to share your thoughts.
                                    </p>
                                @endif

                                <form wire:submit.prevent="addComment" class="pv-comment-input">
                                    <input type="text" wire:model.defer="commentBody" placeholder="Share your thoughts...">
                                    <button type="submit" class="pv-send-btn"><i class="fas fa-paper-plane"></i></button>
                                </form>
                                @error('commentBody') <small style="color:var(--pv-red);font-size:.76rem;">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>

                    {{-- ═══ RIGHT: Results + Info ═══ --}}
                    <div class="col-lg-5">

                        {{-- Live Results --}}
                        <div class="pv-card">
                            <div class="pv-card-header">
                                <div class="pv-card-title"><i class="fas fa-chart-bar"></i> Live Results</div>
                            </div>
                            <div style="padding:1.25rem 1.5rem;">
                                @php $totalVotes = $currentPoll->totalVotes(); @endphp

                                @if ($totalVotes === 0)
                                    <div style="text-align:center;padding:1.5rem 0;">
                                        <i class="fas fa-chart-pie" style="font-size:1.5rem;color:var(--pv-border);"></i>
                                        <p style="font-size:.85rem;color:var(--pv-faint);margin:.5rem 0 0;">No votes yet</p>
                                    </div>
                                @else
                                    @foreach ($currentPoll->options as $option)
                                        @php
                                            $count = $option->votes->count();
                                            $pct = round(($count / $totalVotes) * 100, 1);
                                            $isTop = $count == $currentPoll->options->max(fn($o) => $o->votes->count()) && $count > 0;
                                        @endphp
                                        <div class="pv-result-bar">
                                            <div class="pv-result-label">
                                                <span>
                                                    @if ($isTop)<i class="fas fa-trophy" style="color:var(--pv-amber);font-size:.7rem;margin-right:.2rem;"></i>@endif
                                                    {{ $option->label }}
                                                </span>
                                                <span style="color:{{ $isTop ? 'var(--pv-navy)' : 'var(--pv-faint)' }};">{{ $pct }}%</span>
                                            </div>
                                            <div class="pv-result-track">
                                                <div class="pv-result-fill" style="width:{{ $pct }}%;background:{{ $isTop ? 'var(--pv-navy)' : 'var(--pv-faint)' }};"></div>
                                            </div>
                                            <div class="pv-result-votes">{{ $count }} vote{{ $count !== 1 ? 's' : '' }}</div>
                                        </div>
                                    @endforeach
                                @endif

                                <div class="pv-result-summary">
                                    <span><i class="fas fa-users"></i> {{ $currentPoll->totalVoters() }} voters</span>
                                    <span><i class="fas fa-chart-line"></i> {{ $currentPoll->participationRate() }}% participation</span>
                                </div>
                            </div>
                        </div>

                        {{-- Poll Info --}}
                        <div class="pv-card">
                            <div class="pv-card-header">
                                <div class="pv-card-title"><i class="fas fa-info-circle"></i> Poll Information</div>
                            </div>
                            <div style="padding:1rem 1.5rem;">
                                <table class="pv-info-table">
                                    <tr>
                                        <td>Village Bank</td>
                                        <td>{{ $currentPoll->villageBank->name ?? '--' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Created by</td>
                                        <td>{{ $currentPoll->creator->name ?? 'Unknown' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Vote Type</td>
                                        <td>{{ ucfirst($currentPoll->type) }} choice</td>
                                    </tr>
                                    @if ($currentPoll->starts_at)
                                        <tr>
                                            <td>Started</td>
                                            <td>{{ $currentPoll->starts_at->format('d M Y H:i') }}</td>
                                        </tr>
                                    @endif
                                    @if ($currentPoll->ends_at)
                                        <tr>
                                            <td>Ends</td>
                                            <td>{{ $currentPoll->ends_at->format('d M Y H:i') }}</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>

                        {{-- Quick Link --}}
                        <div class="pv-card" style="background:linear-gradient(135deg,var(--pv-navy),var(--pv-navy-light));border:none;">
                            <div style="padding:1.25rem 1.5rem;text-align:center;">
                                <a href="{{ route('polls.show', $currentPoll->id) }}" style="color:#fff;text-decoration:none;font-size:.85rem;font-weight:700;display:flex;align-items:center;justify-content:center;gap:.4rem;">
                                    <i class="fas fa-external-link-alt"></i> View Full Results & Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                {{-- Empty State --}}
                <div class="pv-card">
                    <div class="pv-empty">
                        <i class="fas fa-vote-yea"></i>
                        <h5>Select a Poll to Vote</h5>
                        <p>Choose an active poll from the dropdown above to cast your vote and view live results.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>
    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
