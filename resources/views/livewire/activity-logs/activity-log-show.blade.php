<div>

@can('view-activity-logs')
<div class="nd-page">
    {{-- â•â•â•â•â•â•â•â•â•â•â• HERO â•â•â•â•â•â•â•â•â•â•â• --}}
    <div class="nd-hero">
        <div class="nd-hero-inner">
            <ul class="nd-breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="sep">/</li>
                <li><a href="{{ route('activity-logs.index') }}">Activity Logs</a></li>
                <li class="sep">/</li>
                <li class="active">Log #{{ $log->id }}</li>
            </ul>
            <div class="nd-hero-row">
                <div class="nd-hero-title">
                    <h1><i class="fas fa-file-alt"></i>Activity Log Detail</h1>
                    <p class="nd-hero-sub">{{ $log->description }}</p>
                </div>
                <a href="{{ route('activity-logs.index') }}" class="nd-btn nd-btn-ghost">
                    <i class="fas fa-arrow-left"></i> Back to Logs
                </a>
            </div>
        </div>
    </div>

    {{-- â•â•â•â•â•â•â•â•â•â•â• CONTENT â•â•â•â•â•â•â•â•â•â•â• --}}
    <div class="nd-content">

        {{-- Main Details Card --}}
        <div class="nd-card">
            <div class="nd-card-head">
                <h3><i class="fas fa-info-circle"></i> Event Details</h3>
                <span style="font-size:.75rem;color:var(--nd-muted);font-weight:600;">ID #{{ $log->id }}</span>
            </div>
            <div class="nd-card-body">
                <div class="ls-grid">
                    <div class="ls-detail">
                        <label>Event</label>
                        <p>
                            @php $evClass = match($log->event){ 'login' => 'nd-badge-gray', 'logout' => 'ls-badge-logout', 'created' => 'ls-badge-created', 'updated' => 'ls-badge-updated', 'deleted' => 'ls-badge-deleted', default => 'ls-badge-system' }; @endphp
                            <span class="nd-badge {{ $evClass }}">{{ $log->event }}</span>
                        </p>
                    </div>
                    <div class="ls-detail">
                        <label>Type</label>
                        <p>
                            @php $typeClass = match($log->log_type){ 'auth' => 'ls-badge-auth', 'model' => 'ls-badge-model', default => 'ls-badge-system' }; @endphp
                            <span class="nd-badge {{ $typeClass }}">
                                <i class="fas fa-{{ $log->log_type === 'auth' ? 'sign-in-alt' : ($log->log_type === 'model' ? 'database' : 'cog') }}" style="font-size:.55rem;"></i>
                                {{ $log->log_type }}
                            </span>
                        </p>
                    </div>
                    <div class="ls-detail">
                        <label>Date & Time</label>
                        <p>{{ $log->created_at->format('d M Y, H:i:s') }}</p>
                        <span style="font-size:.72rem;color:var(--nd-faint);">{{ $log->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="ls-detail">
                        <label>User</label>
                        <p>
                            @if($log->user_name)
                                <span style="display:inline-flex;align-items:center;gap:.4rem;">
                                    <span class="nd-avatar">{{ strtoupper(substr($log->user_name, 0, 1)) }}</span>
                                    {{ $log->user_name }}
                                </span>
                                @if($log->user_id)
                                    <a href="{{ route('users.show', $log->user_id) }}" style="font-size:.72rem;color:var(--ls-blue);margin-left:.35rem;">
                                        <i class="fas fa-external-link-alt"></i> View
                                    </a>
                                @endif
                            @else
                                System
                            @endif
                        </p>
                    </div>
                    <div class="ls-detail ls-detail-full">
                        <label>Description</label>
                        <p>{{ $log->description }}</p>
                    </div>
                    @if($log->subject_type)
                        <div class="ls-detail">
                            <label>Subject Model</label>
                            <p style="font-family:'Courier New',monospace;font-size:.84rem;">{{ class_basename($log->subject_type) }}</p>
                        </div>
                        <div class="ls-detail">
                            <label>Subject ID</label>
                            <p>#{{ $log->subject_id }}</p>
                        </div>
                    @endif
                    <div class="ls-detail">
                        <label>IP Address</label>
                        <p style="font-family:'Courier New',monospace;font-size:.84rem;">{{ $log->ip_address ?? 'N/A' }}</p>
                    </div>
                    <div class="ls-detail ls-detail-full">
                        <label>User Agent</label>
                        <p class="ls-ua">{{ $log->user_agent ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Properties / Changes Card --}}
        @if($log->properties)
            @php $props = $log->properties; @endphp

            {{-- Updated event: show diff --}}
            @if(isset($props['old']) && isset($props['new']))
                <div class="nd-card">
                    <div class="nd-card-head">
                        <h3><i class="fas fa-exchange-alt"></i> Changes Made</h3>
                        <span style="font-size:.75rem;color:var(--nd-muted);font-weight:600;">{{ count($props['new']) }} field(s) changed</span>
                    </div>
                    <div class="nd-card-body" style="padding:.85rem;">
                        <table class="ls-diff-table">
                            <thead>
                                <tr>
                                    <th style="width:25%;">Field</th>
                                    <th style="width:37%;">Old Value</th>
                                    <th style="width:37%;">New Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($props['new'] as $field => $newVal)
                                    <tr>
                                        <td style="font-weight:700;">{{ $field }}</td>
                                        <td><span class="ls-diff-old">{{ Str::limit($props['old'][$field] ?? 'â€”', 120) }}</span></td>
                                        <td><span class="ls-diff-new">{{ Str::limit($newVal, 120) }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            {{-- Created/deleted event: show attributes --}}
            @if(isset($props['attributes']))
                <div class="nd-card">
                    <div class="nd-card-head">
                        <h3><i class="fas fa-list"></i> {{ $log->event === 'deleted' ? 'Deleted' : 'Created' }} Attributes</h3>
                        <span style="font-size:.75rem;color:var(--nd-muted);font-weight:600;">{{ count($props['attributes']) }} field(s)</span>
                    </div>
                    <div class="nd-card-body" style="padding:.85rem;">
                        <table class="ls-diff-table">
                            <thead>
                                <tr>
                                    <th style="width:30%;">Field</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($props['attributes'] as $field => $val)
                                    <tr>
                                        <td style="font-weight:700;">{{ $field }}</td>
                                        <td>{{ is_array($val) ? json_encode($val) : Str::limit((string) $val, 150) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            {{-- Raw JSON (if props exist but don't match known patterns) --}}
            @if(!isset($props['old']) && !isset($props['new']) && !isset($props['attributes']))
                <div class="nd-card">
                    <div class="nd-card-head">
                        <h3><i class="fas fa-code"></i> Properties</h3>
                    </div>
                    <div class="nd-card-body">
                        <pre style="background:#f8fafc;border:1px solid var(--nd-border);border-radius:10px;padding:.85rem;font-size:.78rem;color:var(--nd-text);overflow-x:auto;margin:0;">{{ json_encode($props, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                    </div>
                </div>
            @endif
        @endif

    </div>
</div>
@else
    @include('livewire.partials.unauthorized')
@endcan
</div>
