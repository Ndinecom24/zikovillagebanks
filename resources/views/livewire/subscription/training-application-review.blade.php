<div>

@can('manage-training')
<div class="nd-page">
    {{-- â•â•â•â•â•â•â• HERO â•â•â•â•â•â•â• --}}
    <div class="nd-hero">
        <div class="nd-hero-inner">
            <ul class="nd-breadcrumb">
                <li><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="sep">/</li>
                <li><a href="{{ route('training.programs') }}">Training</a></li>
                <li class="sep">/</li>
                <li class="active">Applications</li>
            </ul>
            <div class="nd-hero-title">
                <h1><i class="fas fa-user-graduate"></i>Training Applications</h1>
                <p class="nd-hero-sub">Review and approve training program applications from village bank members</p>
            </div>
        </div>
    </div>

    {{-- â•â•â•â•â•â•â• CONTENT â•â•â•â•â•â•â• --}}
    <div class="nd-content">
        @if(session()->has('success'))
            <div class="ta-alert ta-alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif

        {{-- â”€â”€ Stat Cards â”€â”€ --}}
        <div class="ta-stats">
            <div class="nd-stat">
                <div class="nd-stat-val" style="color:var(--nd-navy);">{{ $stats['total'] }}</div>
                <div class="nd-stat-label">Total Applications</div>
            </div>
            <div class="nd-stat">
                <div class="nd-stat-val" style="color:var(--nd-amber);">{{ $stats['pending'] }}</div>
                <div class="nd-stat-label">Pending Review</div>
            </div>
            <div class="nd-stat">
                <div class="nd-stat-val" style="color:var(--nd-green);">{{ $stats['approved'] }}</div>
                <div class="nd-stat-label">Approved</div>
            </div>
            <div class="nd-stat">
                <div class="nd-stat-val" style="color:var(--nd-red);">{{ $stats['rejected'] }}</div>
                <div class="nd-stat-label">Rejected</div>
            </div>
        </div>

        {{-- â”€â”€ Applications Table â”€â”€ --}}
        <div class="nd-card">
            <div class="nd-card-header">
                <h3><i class="fas fa-clipboard-list"></i> Applications</h3>
                <div class="nd-toolbar">
                    <div class="nd-search">
                        <i class="fas fa-search"></i>
                        <input type="text" wire:model.debounce.300ms="search" placeholder="Search applicants, email, bank...">
                    </div>
                    <select wire:model="filterStatus" class="nd-select">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                    <select wire:model="filterProgram" class="nd-select" style="max-width:200px;">
                        <option value="">All Programs</option>
                        @foreach($programs as $p)
                            <option value="{{ $p->id }}">{{ Str::limit($p->title, 30) }}</option>
                        @endforeach
                    </select>
                    <select wire:model="perPage" class="nd-select" style="width:72px;">
                        <option value="15">15</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                    </select>
                </div>
            </div>

            <div style="overflow-x:auto;">
                <table class="nd-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Applicant</th>
                            <th>Program</th>
                            <th>Village Bank</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Applied</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applications as $app)
                            <tr class="{{ $app->status === 'pending' ? 'ta-pending' : '' }}">
                                <td style="color:var(--nd-faint);font-weight:600;">
                                    {{ $loop->iteration + ($applications->currentPage() - 1) * $applications->perPage() }}
                                </td>
                                <td>
                                    <strong>{{ $app->full_name }}</strong>
                                    <br><span style="font-size:.76rem;color:var(--nd-faint);">{{ $app->email }}</span>
                                    <br><span style="font-size:.72rem;color:var(--nd-faint);"><i class="fas fa-phone" style="margin-right:2px;font-size:.62rem;"></i>{{ $app->phone }}</span>
                                </td>
                                <td>
                                    @if($app->program)
                                        <span class="ta-badge-program" style="background:{{ $app->program->categoryColor() }};">
                                            {{ Str::limit($app->program->title, 25) }}
                                        </span>
                                    @else
                                        <span style="color:var(--nd-faint);">â€”</span>
                                    @endif
                                </td>
                                <td>
                                    @if($app->village_bank)
                                        <span style="font-size:.84rem;">{{ $app->village_bank }}</span>
                                    @else
                                        <span style="color:var(--nd-faint);">â€”</span>
                                    @endif
                                </td>
                                <td>
                                    @if($app->role_in_bank)
                                        <span style="font-size:.84rem;">{{ $app->role_in_bank }}</span>
                                    @else
                                        <span style="color:var(--nd-faint);">â€”</span>
                                    @endif
                                </td>
                                <td>
                                    @if($app->status === 'pending')
                                        <span class="nd-badge ta-badge-pending"><i class="fas fa-clock" style="margin-right:3px;font-size:.62rem;"></i>Pending</span>
                                    @elseif($app->status === 'approved')
                                        <span class="nd-badge ta-badge-approved"><i class="fas fa-check" style="margin-right:3px;font-size:.62rem;"></i>Approved</span>
                                    @else
                                        <span class="nd-badge ta-badge-rejected"><i class="fas fa-times" style="margin-right:3px;font-size:.62rem;"></i>Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    <span style="font-size:.84rem;">{{ $app->created_at->format('d M Y') }}</span>
                                </td>
                                <td>
                                    <div class="ta-actions" style="justify-content:flex-end;">
                                        <button wire:click="viewApplication({{ $app->id }})" class="ta-act ta-act-view" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @if($app->status === 'pending')
                                            <button wire:click="quickApprove({{ $app->id }})" class="ta-act ta-act-approve" title="Quick Approve">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button wire:click="quickReject({{ $app->id }})" class="ta-act ta-act-reject" title="Quick Reject">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="nd-empty">
                                        <i class="fas fa-inbox"></i>
                                        No training applications found matching your criteria.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($applications->hasPages())
                <div class="nd-footer">
                    <span>Showing {{ $applications->firstItem() }}â€“{{ $applications->lastItem() }} of {{ $applications->total() }}</span>
                    {{ $applications->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

{{-- â•â•â•â•â•â•â• DETAIL / ACTION MODAL â•â•â•â•â•â•â• --}}
@if($showDetailModal && $selectedApp)
    <div class="nd-overlay" wire:click.self="closeModal">
        <div class="nd-modal">
            <div class="nd-modal-head">
                <h5><i class="fas fa-user-graduate"></i> Application Details</h5>
                <button class="nd-modal-close" wire:click="closeModal">&times;</button>
            </div>
            <div class="nd-modal-body">
                {{-- Applicant Info --}}
                <div class="ta-section-title"><i class="fas fa-user"></i> Applicant Information</div>
                <div style="margin-bottom:.75rem;">
                    <div class="nd-info-row">
                        <div class="ta-info-label">Name</div>
                        <div class="nd-info-value"><strong>{{ $selectedApp->full_name }}</strong></div>
                    </div>
                    <div class="nd-info-row">
                        <div class="ta-info-label">Email</div>
                        <div class="nd-info-value">{{ $selectedApp->email }}</div>
                    </div>
                    <div class="nd-info-row">
                        <div class="ta-info-label">Phone</div>
                        <div class="nd-info-value">{{ $selectedApp->phone }}</div>
                    </div>
                    <div class="nd-info-row">
                        <div class="ta-info-label">Village Bank</div>
                        <div class="nd-info-value">{{ $selectedApp->village_bank ?? 'â€”' }}</div>
                    </div>
                    <div class="nd-info-row">
                        <div class="ta-info-label">Role</div>
                        <div class="nd-info-value">{{ $selectedApp->role_in_bank ?? 'â€”' }}</div>
                    </div>
                </div>

                {{-- Program Info --}}
                @if($selectedApp->program)
                    <div class="ta-section-title"><i class="fas fa-graduation-cap"></i> Program</div>
                    <div class="ta-program-card">
                        <strong>{{ $selectedApp->program->title }}</strong>
                        <br><span style="font-size:.8rem;color:var(--nd-muted);">
                            {{ $selectedApp->program->formattedFee() }}
                            @if($selectedApp->program->start_date)
                                &bull; {{ $selectedApp->program->start_date->format('d M Y') }}
                            @endif
                            @if($selectedApp->program->location)
                                &bull; {{ $selectedApp->program->location }}
                            @endif
                        </span>
                    </div>
                @endif

                {{-- Motivation --}}
                @if($selectedApp->motivation)
                    <div class="ta-section-title"><i class="fas fa-comment-dots"></i> Motivation</div>
                    <div class="ta-motivation">{{ $selectedApp->motivation }}</div>
                @endif

                {{-- Status --}}
                <div style="display:flex;align-items:center;gap:.5rem;margin-bottom:1rem;">
                    <span style="font-size:.82rem;color:var(--nd-muted);font-weight:600;">Status:</span>
                    @if($selectedApp->status === 'pending')
                        <span class="nd-badge ta-badge-pending">Pending</span>
                    @elseif($selectedApp->status === 'approved')
                        <span class="nd-badge ta-badge-approved">Approved</span>
                    @else
                        <span class="nd-badge ta-badge-rejected">Rejected</span>
                    @endif
                    @if($selectedApp->approved_at)
                        <span style="font-size:.76rem;color:var(--nd-faint);">Approved {{ $selectedApp->approved_at->diffForHumans() }}</span>
                    @endif
                </div>

                {{-- Admin Notes --}}
                <div class="ta-section-title"><i class="fas fa-sticky-note"></i> Admin Notes</div>
                <div style="margin-bottom:.75rem;">
                    <textarea wire:model.defer="adminNotes" class="ta-input" rows="2" placeholder="Add notes about this application..."></textarea>
                </div>
            </div>

            <div class="nd-modal-foot">
                @if($selectedApp->status === 'pending')
                    <button class="ta-btn-reject" wire:click="reject">
                        <i class="fas fa-times" style="margin-right:4px;"></i> Reject
                    </button>
                    <button class="ta-btn-approve" wire:click="approve">
                        <i class="fas fa-check" style="margin-right:4px;"></i> Approve
                    </button>
                @else
                    <button class="nd-btn-cancel" wire:click="closeModal">Close</button>
                @endif
            </div>
        </div>
    </div>
@endif
@else
    @include('livewire.partials.unauthorized')
@endcan
</div>
