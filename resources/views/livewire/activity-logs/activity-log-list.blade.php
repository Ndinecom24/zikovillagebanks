<div>

@can('view-activity-logs')
<div class="nd-page">
    {{-- â•â•â•â•â•â•â•â•â•â•â• HERO â•â•â•â•â•â•â•â•â•â•â• --}}
    <div class="nd-hero">
        <div class="nd-hero-inner">
            <ul class="nd-breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="sep">/</li>
                <li class="active">Activity Logs</li>
            </ul>
            <div class="nd-hero-row">
                <div class="nd-hero-title">
                    <h1><i class="fas fa-history"></i>Activity Logs</h1>
                    <p class="nd-hero-sub">Track all system activity, user actions, and model changes</p>
                </div>
            </div>

            <div class="nd-stat-row">
                <div class="nd-stat">
                    <div class="nd-stat-val">{{ number_format($stats['total']) }}</div>
                    <div class="nd-stat-label">Total Log Entries</div>
                </div>
                <div class="nd-stat">
                    <div class="nd-stat-val" style="color:#60a5fa;">{{ number_format($stats['today']) }}</div>
                    <div class="nd-stat-label">Today's Activity</div>
                </div>
                <div class="nd-stat">
                    <div class="nd-stat-val" style="color:#34d399;">{{ number_format($stats['logins']) }}</div>
                    <div class="nd-stat-label">Logins Today</div>
                </div>
                <div class="nd-stat">
                    <div class="nd-stat-val" style="color:#fbbf24;">{{ number_format($stats['changes']) }}</div>
                    <div class="nd-stat-label">Data Changes Today</div>
                </div>
            </div>
        </div>
    </div>

    {{-- â•â•â•â•â•â•â•â•â•â•â• CONTENT â•â•â•â•â•â•â•â•â•â•â• --}}
    <div class="nd-content">
        <div class="nd-card">
            <div class="nd-card-header">
                <h3><i class="fas fa-stream"></i> Activity Stream</h3>
                <div class="nd-toolbar">
                    <div class="nd-search">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search logs..." wire:model.live.debounce.300ms="search">
                    </div>
                    <select class="nd-select" wire:model.live="filterType">
                        <option value="">All Types</option>
                        <option value="auth">Auth</option>
                        <option value="model">Model</option>
                        <option value="system">System</option>
                    </select>
                    <select class="nd-select" wire:model.live="filterEvent">
                        <option value="">All Events</option>
                        <option value="login">Login</option>
                        <option value="logout">Logout</option>
                        <option value="created">Created</option>
                        <option value="updated">Updated</option>
                        <option value="deleted">Deleted</option>
                    </select>
                    <input type="date" class="al-input-date" wire:model="filterDateFrom" title="From date">
                    <input type="date" class="al-input-date" wire:model="filterDateTo" title="To date">
                    @if($search || $filterType || $filterEvent || $filterDateFrom || $filterDateTo)
                        <button class="al-btn-clear" wire:click="clearFilters" title="Clear all filters">
                            <i class="fas fa-times mr-1"></i> Clear
                        </button>
                    @endif
                </div>
            </div>

            <div style="overflow-x:auto;">
                <table class="nd-table">
                    <thead>
                        <tr>
                            <th style="width:40px;">#</th>
                            <th>When</th>
                            <th>User</th>
                            <th>Type</th>
                            <th>Event</th>
                            <th>Description</th>
                            <th>Subject</th>
                            <th>IP Address</th>
                            <th style="text-align:center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $key => $log)
                            <tr style="cursor:pointer;" onclick="window.location='{{ route('activity-logs.show', $log->id) }}'">
                                <td style="color:var(--nd-faint);">{{ $logs->firstItem() + $key }}</td>
                                <td style="white-space:nowrap;">
                                    <div style="font-weight:600;">{{ $log->created_at->format('d M Y') }}</div>
                                    <div class="al-time-ago">{{ $log->created_at->format('H:i:s') }} &middot; {{ $log->created_at->diffForHumans() }}</div>
                                </td>
                                <td>
                                    @if($log->user_name)
                                        <div style="display:flex;align-items:center;gap:.4rem;">
                                            <div class="nd-avatar">{{ strtoupper(substr($log->user_name, 0, 1)) }}</div>
                                            <span style="font-weight:600;font-size:.82rem;">{{ $log->user_name }}</span>
                                        </div>
                                    @else
                                        <span style="color:var(--nd-faint);font-size:.82rem;">System</span>
                                    @endif
                                </td>
                                <td>
                                    @php $typeClass = match($log->log_type){ 'auth' => 'al-badge-auth', 'model' => 'al-badge-model', default => 'al-badge-system' }; @endphp
                                    <span class="nd-badge {{ $typeClass }}">
                                        <i class="fas fa-{{ $log->log_type === 'auth' ? 'sign-in-alt' : ($log->log_type === 'model' ? 'database' : 'cog') }}" style="font-size:.55rem;"></i>
                                        {{ $log->log_type }}
                                    </span>
                                </td>
                                <td>
                                    @php $evClass = match($log->event){ 'login' => 'nd-badge-gray', 'logout' => 'al-badge-logout', 'created' => 'al-badge-created', 'updated' => 'al-badge-updated', 'deleted' => 'al-badge-deleted', default => 'al-badge-system' }; @endphp
                                    <span class="nd-badge {{ $evClass }}">{{ $log->event }}</span>
                                </td>
                                <td>
                                    <span class="al-desc-text">{{ Str::limit($log->description, 50) }}</span>
                                </td>
                                <td>
                                    @if($log->subject_type)
                                        <span class="al-model-name">{{ class_basename($log->subject_type) }} #{{ $log->subject_id }}</span>
                                    @else
                                        <span style="color:var(--nd-faint);">â€”</span>
                                    @endif
                                </td>
                                <td style="font-size:.78rem;color:var(--nd-faint);font-family:'Courier New',monospace;">{{ $log->ip_address ?? 'â€”' }}</td>
                                <td style="text-align:center;">
                                    <a href="{{ route('activity-logs.show', $log->id) }}" class="nd-badge al-badge-model" style="text-decoration:none;" onclick="event.stopPropagation();">
                                        <i class="fas fa-eye" style="font-size:.6rem;"></i> View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">
                                    <div class="nd-empty">
                                        <i class="fas fa-history"></i>
                                        <p style="margin:0;">No activity logs found.
                                            @if($search || $filterType || $filterEvent)
                                                Try adjusting your filters.
                                            @else
                                                Activity will appear here as users interact with the system.
                                            @endif
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($logs->hasPages())
                <div class="nd-footer">
                    <span>Showing {{ $logs->firstItem() }}â€“{{ $logs->lastItem() }} of {{ $logs->total() }}</span>
                    {{ $logs->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- â•â•â•â•â•â•â•â•â•â•â• DETAIL MODAL â•â•â•â•â•â•â•â•â•â•â• --}}
    @if($showDetail && $detailLog)
    <div class="nd-overlay" wire:click.self="closeDetail">
        <div class="nd-modal">
            <div class="nd-modal-head">
                <h5><i class="fas fa-info-circle"></i> Activity Detail</h5>
                <button class="nd-modal-close" wire:click="closeDetail">&times;</button>
            </div>
            <div class="nd-modal-body">
                <div class="al-detail-grid">
                    <div class="al-detail-item">
                        <label>Event</label>
                        <p>
                            @php $evClass2 = match($detailLog->event){ 'login' => 'nd-badge-gray', 'logout' => 'al-badge-logout', 'created' => 'al-badge-created', 'updated' => 'al-badge-updated', 'deleted' => 'al-badge-deleted', default => 'al-badge-system' }; @endphp
                            <span class="nd-badge {{ $evClass2 }}" style="font-size:.72rem;">{{ $detailLog->event }}</span>
                            <span class="nd-badge {{ $detailLog->log_type === 'auth' ? 'al-badge-auth' : 'al-badge-model' }}" style="font-size:.72rem;">{{ $detailLog->log_type }}</span>
                        </p>
                    </div>
                    <div class="al-detail-item">
                        <label>Date & Time</label>
                        <p>{{ $detailLog->created_at->format('d M Y, H:i:s') }}</p>
                    </div>
                    <div class="al-detail-item">
                        <label>User</label>
                        <p>
                            @if($detailLog->user_name)
                                <span style="display:inline-flex;align-items:center;gap:.35rem;">
                                    <span class="nd-avatar" style="width:24px;height:24px;font-size:.58rem;">{{ strtoupper(substr($detailLog->user_name, 0, 1)) }}</span>
                                    {{ $detailLog->user_name }}
                                </span>
                            @else
                                System
                            @endif
                        </p>
                    </div>
                    <div class="al-detail-item">
                        <label>IP Address</label>
                        <p style="font-family:'Courier New',monospace;font-size:.82rem;">{{ $detailLog->ip_address ?? 'N/A' }}</p>
                    </div>
                    <div class="al-detail-item al-detail-full">
                        <label>Description</label>
                        <p>{{ $detailLog->description }}</p>
                    </div>
                    @if($detailLog->subject_type)
                    <div class="al-detail-item">
                        <label>Subject Model</label>
                        <p class="al-model-name" style="font-size:.82rem;">{{ class_basename($detailLog->subject_type) }}</p>
                    </div>
                    <div class="al-detail-item">
                        <label>Subject ID</label>
                        <p>#{{ $detailLog->subject_id }}</p>
                    </div>
                    @endif
                    <div class="al-detail-item al-detail-full">
                        <label>User Agent</label>
                        <p style="font-size:.76rem;color:var(--nd-muted);word-break:break-all;">{{ Str::limit($detailLog->user_agent, 150) ?? 'N/A' }}</p>
                    </div>
                </div>

                {{-- Properties / Changes --}}
                @if($detailLog->properties)
                    @php $props = $detailLog->properties; @endphp

                    {{-- Updated event: show diff --}}
                    @if(isset($props['old']) && isset($props['new']))
                        <div class="al-props-box">
                            <div class="al-props-title"><i class="fas fa-exchange-alt mr-1"></i> Changes Made</div>
                            <table class="al-diff-table">
                                <thead>
                                    <tr>
                                        <th>Field</th>
                                        <th>Old Value</th>
                                        <th>New Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($props['new'] as $field => $newVal)
                                        <tr>
                                            <td style="font-weight:600;">{{ $field }}</td>
                                            <td><span class="al-diff-old">{{ Str::limit($props['old'][$field] ?? 'â€”', 80) }}</span></td>
                                            <td><span class="al-diff-new">{{ Str::limit($newVal, 80) }}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    {{-- Created/deleted event: show attributes --}}
                    @if(isset($props['attributes']))
                        <div class="al-props-box">
                            <div class="al-props-title"><i class="fas fa-list mr-1"></i> {{ $detailLog->event === 'deleted' ? 'Deleted' : 'Created' }} Attributes</div>
                            <table class="al-diff-table">
                                <thead>
                                    <tr>
                                        <th>Field</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($props['attributes'] as $field => $val)
                                        <tr>
                                            <td style="font-weight:600;">{{ $field }}</td>
                                            <td>{{ is_array($val) ? json_encode($val) : Str::limit((string) $val, 100) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
    @endif
</div>
@else
    @include('livewire.partials.unauthorized')
@endcan
</div>
