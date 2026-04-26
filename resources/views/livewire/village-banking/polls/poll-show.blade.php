<div>
    @push('custom-styles')
    <style>
        :root {
            --ps-navy:#1E3A5F;--ps-navy-light:#2B6B96;--ps-amber:#D97706;--ps-amber-light:#F59E0B;
            --ps-bg:#f4f6fa;--ps-card:#fff;--ps-border:#edf0f7;--ps-text:#1e293b;
            --ps-muted:#64748b;--ps-faint:#94a3b8;--ps-green:#16a34a;--ps-red:#dc2626;--ps-blue:#2563eb;--ps-purple:#7c3aed;--ps-radius:16px;
        }
        .ps-page{background:var(--ps-bg);min-height:100vh;}

        /* Hero */
        .ps-hero{background:linear-gradient(135deg,var(--ps-navy) 0%,#234b78 50%,var(--ps-navy-light) 100%);padding:1.75rem 0 6rem;position:relative;overflow:hidden;}
        .ps-hero::before{content:'';position:absolute;width:600px;height:600px;top:-60%;right:-8%;background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%);border-radius:50%;pointer-events:none;}
        .ps-hero-inner{position:relative;z-index:2;padding:0 1.5rem;}
        .ps-breadcrumb{display:flex;gap:.5rem;list-style:none;padding:0;margin:0 0 .75rem;font-size:.82rem;}
        .ps-breadcrumb a{color:rgba(255,255,255,.55);text-decoration:none;}
        .ps-breadcrumb a:hover{color:rgba(255,255,255,.85);}
        .ps-breadcrumb .active{color:var(--ps-amber-light);font-weight:600;}
        .ps-breadcrumb .sep{color:rgba(255,255,255,.25);}
        .ps-hero-row{display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:.75rem;}
        .ps-hero-title h1{color:#fff;font-size:1.4rem;font-weight:800;margin:0;line-height:1.4;}
        .ps-hero-title h1 i{color:var(--ps-amber);margin-right:.5rem;font-size:1.1rem;}
        .ps-hero-sub{color:rgba(255,255,255,.55);font-size:.85rem;margin:.35rem 0 0;display:flex;gap:.6rem;flex-wrap:wrap;}
        .ps-hero-badge{display:inline-flex;align-items:center;gap:.25rem;padding:.2rem .55rem;border-radius:8px;font-size:.72rem;font-weight:700;}
        .ps-hero-btn{display:inline-flex;align-items:center;gap:.4rem;padding:.55rem 1.25rem;border-radius:10px;font-size:.82rem;font-weight:700;text-decoration:none;transition:all .2s;border:none;cursor:pointer;}
        .ps-hero-btn-back{background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);color:rgba(255,255,255,.8);}
        .ps-hero-btn-back:hover{background:rgba(255,255,255,.15);color:#fff;text-decoration:none;}
        .ps-hero-btn-vote{background:var(--ps-amber);color:#fff;}
        .ps-hero-btn-vote:hover{background:var(--ps-amber-light);color:#fff;text-decoration:none;transform:translateY(-1px);}

        /* Content */
        .ps-content{margin-top:-4rem;position:relative;z-index:10;padding:0 1.5rem 2rem;}

        /* Stats Row */
        .ps-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.25rem;}
        @media(max-width:992px){.ps-stats{grid-template-columns:repeat(2,1fr);}}
        @media(max-width:576px){.ps-stats{grid-template-columns:1fr;}}
        .ps-stat{background:var(--ps-card);border-radius:var(--ps-radius);border:1px solid var(--ps-border);box-shadow:0 2px 12px rgba(0,0,0,.04);padding:1rem 1.25rem;display:flex;align-items:center;justify-content:space-between;transition:all .2s;}
        .ps-stat:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(0,0,0,.06);}
        .ps-stat-label{font-size:.62rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--ps-faint);}
        .ps-stat-value{font-size:1.4rem;font-weight:800;color:var(--ps-text);margin-top:.1rem;}
        .ps-stat-icon{width:40px;height:40px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:.9rem;flex-shrink:0;}

        /* Card */
        .ps-card{background:var(--ps-card);border-radius:var(--ps-radius);border:1px solid var(--ps-border);box-shadow:0 2px 12px rgba(0,0,0,.04);overflow:hidden;margin-bottom:1rem;}
        .ps-card-header{padding:1rem 1.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.5rem;border-bottom:1px solid var(--ps-border);}
        .ps-card-title{font-size:.95rem;font-weight:700;color:var(--ps-text);display:flex;align-items:center;gap:.4rem;}
        .ps-card-title i{color:var(--ps-amber);font-size:.8rem;}
        .ps-badge{display:inline-flex;align-items:center;gap:.25rem;padding:.2rem .55rem;border-radius:8px;font-size:.68rem;font-weight:700;}

        /* Results */
        .ps-result-item{padding:1rem 0;border-bottom:1px solid #f5f7fa;}
        .ps-result-item:last-child{border-bottom:none;}
        .ps-result-top{display:flex;justify-content:space-between;align-items:center;margin-bottom:.35rem;}
        .ps-result-label{font-size:.88rem;font-weight:700;color:var(--ps-text);display:flex;align-items:center;gap:.3rem;}
        .ps-result-pct{font-size:.95rem;font-weight:800;}
        .ps-result-track{height:12px;background:#edf0f7;border-radius:8px;overflow:hidden;}
        .ps-result-fill{height:100%;border-radius:8px;transition:width .5s ease;}
        .ps-result-meta{display:flex;align-items:center;justify-content:space-between;margin-top:.3rem;}
        .ps-result-votes{font-size:.76rem;color:var(--ps-faint);font-weight:600;}
        .ps-result-voters{display:flex;gap:.25rem;flex-wrap:wrap;}
        .ps-voter-chip{display:inline-flex;align-items:center;gap:.2rem;padding:.15rem .45rem;border-radius:6px;font-size:.66rem;font-weight:600;background:#f8fafc;border:1px solid var(--ps-border);color:var(--ps-muted);}

        /* Winner Banner */
        .ps-winner{display:flex;align-items:center;gap:.6rem;padding:.75rem 1rem;border-radius:12px;background:rgba(217,119,6,.04);border:1px solid rgba(217,119,6,.15);margin-bottom:1rem;}
        .ps-winner-icon{width:36px;height:36px;border-radius:10px;background:rgba(217,119,6,.08);display:flex;align-items:center;justify-content:center;color:var(--ps-amber);font-size:.85rem;}
        .ps-winner-text{font-size:.84rem;color:var(--ps-text);font-weight:600;}
        .ps-winner-text span{color:var(--ps-amber);font-weight:800;}

        /* Info Table */
        .ps-info-table{width:100%;font-size:.84rem;}
        .ps-info-table td{padding:.5rem 0;vertical-align:top;}
        .ps-info-table td:first-child{color:var(--ps-faint);width:35%;font-weight:600;}
        .ps-info-table td:last-child{font-weight:700;color:var(--ps-text);}

        /* Comments */
        .ps-comment{display:flex;gap:.65rem;margin-bottom:.85rem;}
        .ps-comment-avatar{width:32px;height:32px;border-radius:10px;background:linear-gradient(135deg,var(--ps-navy),var(--ps-navy-light));display:flex;align-items:center;justify-content:center;font-size:.65rem;font-weight:800;color:#fff;flex-shrink:0;}
        .ps-comment-body{flex:1;}
        .ps-comment-meta{display:flex;align-items:center;gap:.4rem;margin-bottom:.15rem;}
        .ps-comment-name{font-size:.82rem;font-weight:700;color:var(--ps-text);}
        .ps-comment-time{font-size:.72rem;color:var(--ps-faint);}
        .ps-comment-text{font-size:.84rem;color:var(--ps-muted);line-height:1.5;margin:0;}
        .ps-comment-input{display:flex;gap:.5rem;}
        .ps-comment-input input{flex:1;padding:.5rem .85rem;border:1px solid var(--ps-border);border-radius:10px;font-size:.84rem;background:#fafbfd;}
        .ps-comment-input input:focus{outline:none;border-color:var(--ps-amber);background:#fff;box-shadow:0 0 0 3px rgba(217,119,6,.08);}
        .ps-send-btn{width:38px;height:38px;border-radius:10px;display:flex;align-items:center;justify-content:center;background:var(--ps-green);color:#fff;border:none;cursor:pointer;font-size:.75rem;transition:all .15s;flex-shrink:0;}
        .ps-send-btn:hover{background:#15803d;transform:translateY(-1px);}

        /* Empty */
        .ps-empty{text-align:center;padding:2rem 1rem;color:var(--ps-faint);font-size:.85rem;}
        .ps-empty i{font-size:1.5rem;opacity:.3;display:block;margin-bottom:.5rem;}

        @keyframes psSlide{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
        .ps-animate{animation:psSlide .3s ease;}
        @media(max-width:768px){.ps-content{padding:0 .75rem 1.5rem;}}
    </style>
    @endpush

    @can('view-polls')
    @php
        $totalVotes = $poll->totalVotes();
        $totalVoters = $poll->totalVoters();
        $participationRate = $poll->participationRate();
        $maxVoteCount = $poll->options->max(fn($o) => $o->votes->count());
        $statusColors = [
            'draft'  => ['rgba(100,116,139,.08)','#475569','rgba(100,116,139,.2)'],
            'active' => ['rgba(22,163,74,.08)','#166534','rgba(22,163,74,.25)'],
            'closed' => ['rgba(220,38,38,.08)','#991b1b','rgba(220,38,38,.25)'],
        ];
        $sc = $statusColors[$poll->status] ?? $statusColors['draft'];
    @endphp

    <section class="content ps-page">
        {{-- ████ Hero ████ --}}
        <div class="ps-hero">
            <div class="ps-hero-inner container-fluid">
                <ul class="ps-breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li class="sep">/</li>
                    <li><a href="{{ route('polls.index') }}">Polls</a></li>
                    <li class="sep">/</li>
                    <li class="active">Poll Details</li>
                </ul>
                <div class="ps-hero-row">
                    <div class="ps-hero-title">
                        <h1><i class="fas fa-chart-bar"></i>{{ $poll->question }}</h1>
                        <div class="ps-hero-sub">
                            <span class="ps-hero-badge" style="background:{{ $sc[0] }};color:{{ $sc[1] }};border:1px solid {{ $sc[2] }};">
                                <i class="fas fa-circle" style="font-size:.3rem;"></i> {{ ucfirst($poll->status) }}
                            </span>
                            <span class="ps-hero-badge" style="background:rgba(255,255,255,.1);color:rgba(255,255,255,.7);border:1px solid rgba(255,255,255,.15);">
                                {{ ucfirst($poll->type) }} choice
                            </span>
                            @if ($poll->is_anonymous)
                                <span class="ps-hero-badge" style="background:rgba(217,119,6,.12);color:var(--ps-amber-light);border:1px solid rgba(217,119,6,.25);">
                                    <i class="fas fa-user-secret" style="font-size:.45rem;"></i> Anonymous
                                </span>
                            @endif
                        </div>
                    </div>
                    <div style="display:flex;gap:.5rem;flex-wrap:wrap;">
                        @if ($poll->status === 'active')
                            <a href="{{ route('polls.vote') }}?activePollId={{ $poll->id }}" class="ps-hero-btn ps-hero-btn-vote">
                                <i class="fas fa-vote-yea"></i> Cast Vote
                            </a>
                        @endif
                        <a href="{{ route('polls.index') }}" class="ps-hero-btn ps-hero-btn-back">
                            <i class="fas fa-arrow-left"></i> All Polls
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- ████ Content ████ --}}
        <div class="ps-content container-fluid ps-animate">

            {{-- Stats --}}
            <div class="ps-stats">
                <div class="ps-stat">
                    <div>
                        <div class="ps-stat-label">Total Votes</div>
                        <div class="ps-stat-value">{{ $totalVotes }}</div>
                    </div>
                    <div class="ps-stat-icon" style="background:rgba(30,58,95,.08);color:var(--ps-navy);"><i class="fas fa-check-square"></i></div>
                </div>
                <div class="ps-stat">
                    <div>
                        <div class="ps-stat-label">Unique Voters</div>
                        <div class="ps-stat-value" style="color:var(--ps-green);">{{ $totalVoters }}</div>
                    </div>
                    <div class="ps-stat-icon" style="background:rgba(22,163,74,.08);color:var(--ps-green);"><i class="fas fa-users"></i></div>
                </div>
                <div class="ps-stat">
                    <div>
                        <div class="ps-stat-label">Participation</div>
                        <div class="ps-stat-value" style="color:var(--ps-amber);">{{ $participationRate }}%</div>
                    </div>
                    <div class="ps-stat-icon" style="background:rgba(217,119,6,.08);color:var(--ps-amber);"><i class="fas fa-chart-line"></i></div>
                </div>
                <div class="ps-stat">
                    <div>
                        <div class="ps-stat-label">Options</div>
                        <div class="ps-stat-value" style="color:var(--ps-purple);">{{ $poll->options->count() }}</div>
                    </div>
                    <div class="ps-stat-icon" style="background:rgba(124,58,237,.08);color:var(--ps-purple);"><i class="fas fa-list-ul"></i></div>
                </div>
            </div>

            <div class="row">
                {{-- ═══ LEFT: Results ═══ --}}
                <div class="col-lg-8">

                    {{-- Winner Banner --}}
                    @if ($totalVotes > 0 && $maxVoteCount > 0)
                        @php $winner = $poll->options->sortByDesc(fn($o) => $o->votes->count())->first(); @endphp
                        <div class="ps-winner">
                            <div class="ps-winner-icon"><i class="fas fa-trophy"></i></div>
                            <div class="ps-winner-text">
                                Leading: <span>{{ $winner->label }}</span>
                                with {{ $winner->votes->count() }} vote{{ $winner->votes->count() !== 1 ? 's' : '' }}
                                ({{ $totalVotes > 0 ? round(($winner->votes->count() / $totalVotes) * 100, 1) : 0 }}%)
                            </div>
                        </div>
                    @endif

                    {{-- Results Card --}}
                    <div class="ps-card">
                        <div class="ps-card-header">
                            <div class="ps-card-title"><i class="fas fa-chart-bar"></i> Results Breakdown</div>
                            <span class="ps-badge" style="background:rgba(30,58,95,.06);color:var(--ps-navy);border:1px solid rgba(30,58,95,.15);">
                                {{ $totalVotes }} total vote{{ $totalVotes !== 1 ? 's' : '' }}
                            </span>
                        </div>
                        <div style="padding:1rem 1.5rem;">
                            @if ($totalVotes === 0)
                                <div class="ps-empty">
                                    <i class="fas fa-chart-pie"></i>
                                    No votes have been cast yet.
                                </div>
                            @else
                                @foreach ($poll->options->sortByDesc(fn($o) => $o->votes->count()) as $option)
                                    @php
                                        $count = $option->votes->count();
                                        $pct = round(($count / $totalVotes) * 100, 1);
                                        $isTop = $count === $maxVoteCount && $count > 0;
                                        $barColor = $isTop ? 'var(--ps-navy)' : 'var(--ps-faint)';
                                    @endphp
                                    <div class="ps-result-item">
                                        <div class="ps-result-top">
                                            <div class="ps-result-label">
                                                @if ($isTop)<i class="fas fa-trophy" style="color:var(--ps-amber);font-size:.7rem;"></i>@endif
                                                {{ $option->label }}
                                            </div>
                                            <span class="ps-result-pct" style="color:{{ $isTop ? 'var(--ps-navy)' : 'var(--ps-faint)' }};">{{ $pct }}%</span>
                                        </div>
                                        <div class="ps-result-track">
                                            <div class="ps-result-fill" style="width:{{ $pct }}%;background:{{ $barColor }};"></div>
                                        </div>
                                        <div class="ps-result-meta">
                                            <span class="ps-result-votes">{{ $count }} vote{{ $count !== 1 ? 's' : '' }}</span>
                                            @if (!$poll->is_anonymous && $count > 0)
                                                <div class="ps-result-voters">
                                                    @foreach ($option->votes->take(8) as $vote)
                                                        <span class="ps-voter-chip">
                                                            <i class="fas fa-user" style="font-size:.4rem;"></i>
                                                            {{ $vote->voter->name ?? 'Unknown' }}
                                                        </span>
                                                    @endforeach
                                                    @if ($option->votes->count() > 8)
                                                        <span class="ps-voter-chip">+{{ $option->votes->count() - 8 }} more</span>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    {{-- Discussion --}}
                    <div class="ps-card">
                        <div class="ps-card-header">
                            <div class="ps-card-title"><i class="fas fa-comments"></i> Discussion</div>
                            <span class="ps-badge" style="background:rgba(30,58,95,.06);color:var(--ps-navy);border:1px solid rgba(30,58,95,.15);">
                                {{ $poll->comments->count() }}
                            </span>
                        </div>
                        <div style="padding:1.25rem 1.5rem;">
                            @if ($poll->comments->count() > 0)
                                <div style="max-height:400px;overflow-y:auto;margin-bottom:1rem;">
                                    @foreach ($poll->comments->sortByDesc('created_at') as $comment)
                                        <div class="ps-comment">
                                            <div class="ps-comment-avatar">
                                                {{ strtoupper(substr($comment->user->name ?? '?', 0, 1)) }}
                                            </div>
                                            <div class="ps-comment-body">
                                                <div class="ps-comment-meta">
                                                    <span class="ps-comment-name">{{ $comment->user->name ?? 'Unknown' }}</span>
                                                    <span class="ps-comment-time">{{ $comment->created_at->diffForHumans() }}</span>
                                                </div>
                                                <p class="ps-comment-text">{{ $comment->body }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="ps-empty">
                                    <i class="fas fa-comment-slash"></i>
                                    No comments yet. Start the discussion below.
                                </div>
                            @endif

                            <form wire:submit.prevent="addComment" class="ps-comment-input">
                                <input type="text" wire:model="commentBody" placeholder="Add your comment...">
                                <button type="submit" class="ps-send-btn"><i class="fas fa-paper-plane"></i></button>
                            </form>
                            @error('commentBody') <small style="color:var(--ps-red);font-size:.76rem;">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </div>

                {{-- ═══ RIGHT: Info Sidebar ═══ --}}
                <div class="col-lg-4">

                    {{-- Poll Info --}}
                    <div class="ps-card">
                        <div class="ps-card-header">
                            <div class="ps-card-title"><i class="fas fa-info-circle"></i> Poll Information</div>
                        </div>
                        <div style="padding:1rem 1.5rem;">
                            <table class="ps-info-table">
                                <tr>
                                    <td>Village Bank</td>
                                    <td>{{ $poll->villageBank->name ?? '--' }}</td>
                                </tr>
                                <tr>
                                    <td>Created by</td>
                                    <td>{{ $poll->creator->name ?? 'Unknown' }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        <span class="ps-badge" style="background:{{ $sc[0] }};color:{{ $sc[1] }};border:1px solid {{ $sc[2] }};">
                                            <i class="fas fa-circle" style="font-size:.3rem;"></i> {{ ucfirst($poll->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Vote Type</td>
                                    <td>{{ ucfirst($poll->type) }} choice</td>
                                </tr>
                                @if ($poll->is_anonymous)
                                    <tr>
                                        <td>Anonymity</td>
                                        <td><i class="fas fa-user-secret" style="color:var(--ps-amber);margin-right:.2rem;"></i> Anonymous voting</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>Created</td>
                                    <td>{{ $poll->created_at->format('d M Y H:i') }}</td>
                                </tr>
                                @if ($poll->starts_at)
                                    <tr>
                                        <td>Started</td>
                                        <td>{{ $poll->starts_at->format('d M Y H:i') }}</td>
                                    </tr>
                                @endif
                                @if ($poll->ends_at)
                                    <tr>
                                        <td>Ends</td>
                                        <td>
                                            {{ $poll->ends_at->format('d M Y H:i') }}
                                            @if ($poll->ends_at->isFuture())
                                                <br><small style="color:var(--ps-green);">({{ $poll->ends_at->diffForHumans() }})</small>
                                            @else
                                                <br><small style="color:var(--ps-red);">(ended)</small>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>

                    {{-- Description --}}
                    @if ($poll->description)
                        <div class="ps-card">
                            <div class="ps-card-header">
                                <div class="ps-card-title"><i class="fas fa-align-left"></i> Description</div>
                            </div>
                            <div style="padding:1rem 1.5rem;">
                                <p style="font-size:.85rem;color:var(--ps-muted);line-height:1.6;margin:0;">{{ $poll->description }}</p>
                            </div>
                        </div>
                    @endif

                    {{-- Participation Gauge --}}
                    <div class="ps-card" style="background:linear-gradient(135deg,var(--ps-navy),var(--ps-navy-light));border:none;">
                        <div style="padding:1.5rem;text-align:center;">
                            <div style="font-size:.7rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:rgba(255,255,255,.5);margin-bottom:.5rem;">Participation Rate</div>
                            <div style="font-size:2.5rem;font-weight:900;color:#fff;">{{ $participationRate }}%</div>
                            <div style="height:8px;background:rgba(255,255,255,.15);border-radius:6px;overflow:hidden;margin:.75rem 0 .5rem;">
                                <div style="width:{{ min($participationRate, 100) }}%;height:100%;background:var(--ps-amber);border-radius:6px;transition:width .5s;"></div>
                            </div>
                            <div style="font-size:.78rem;color:rgba(255,255,255,.5);">{{ $totalVoters }} of {{ $poll->villageBank ? $poll->villageBank->members()->count() : '?' }} members voted</div>
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
