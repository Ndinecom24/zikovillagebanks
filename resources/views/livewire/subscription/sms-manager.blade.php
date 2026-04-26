<div>

@once
@push('custom-styles')
<style>
    /* ── SMS Manager (sm-*) ── */
    .sm-alert{padding:.65rem 1rem;border-radius:10px;font-size:.84rem;display:flex;align-items:center;gap:.5rem;margin-bottom:1rem;}
    .sm-alert-success{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;}
    .sm-alert-error{background:#fef2f2;color:#991b1b;border:1px solid #fecaca;}
    .sm-stats{display:grid;grid-template-columns:repeat(auto-fill,minmax(170px,1fr));gap:.75rem;margin-bottom:1.25rem;}
    .sm-code{font-family:monospace;font-size:.76rem;background:#f1f5f9;padding:.12rem .4rem;border-radius:5px;color:var(--nd-navy);font-weight:600;letter-spacing:.3px;}
    .sm-act{width:28px;height:28px;border-radius:7px;border:1px solid #e2e8f0;background:#fff;display:inline-flex;align-items:center;justify-content:center;cursor:pointer;font-size:.72rem;color:var(--nd-muted);transition:all .15s;}
    .sm-act:hover{background:#f8fafc;color:var(--nd-navy);border-color:#cbd5e1;}
    .sm-act-view{color:var(--nd-navy) !important;}
    .sm-act-view:hover{background:rgba(30,58,95,.08) !important;}
    .sm-act-retry{color:var(--nd-amber) !important;}
    .sm-act-retry:hover{background:rgba(217,119,6,.08) !important;}
    .sm-badge-sent{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;}
    .sm-badge-failed{background:#fef2f2;color:#991b1b;border:1px solid #fecaca;}
    .sm-badge-pending{background:#fef3c7;color:#92400e;border:1px solid #fde68a;}
    .sm-label{display:block;font-size:.7rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--nd-faint);margin-bottom:.35rem;}
    .sm-input{width:100%;padding:.55rem .85rem;border:1px solid #e2e8f0;border-radius:10px;font-size:.85rem;background:#fafbfd;transition:border .2s;resize:vertical;}
    .sm-input:focus{outline:none;border-color:var(--nd-amber);background:#fff;box-shadow:0 0 0 3px rgba(217,119,6,.08);}
    .sm-error{font-size:.72rem;color:var(--nd-red);margin-top:.25rem;}
    .sm-textarea{min-height:90px;}
    .sm-btn-send{padding:.42rem 1rem;border-radius:8px;border:none;font-size:.84rem;font-weight:600;cursor:pointer;background:var(--nd-navy);color:#fff;display:inline-flex;align-items:center;gap:.3rem;transition:all .15s;}
    .sm-btn-send:hover{opacity:.9;}
    .sm-btn-bulk{background:#16a34a;color:#fff;}
    .sm-btn-bulk:hover{background:#15803d;}
    .sm-info-box{display:flex;gap:.55rem;padding:.65rem .85rem;background:#eff6ff;border:1px solid #bfdbfe;border-radius:10px;font-size:.82rem;color:#1e40af;margin-bottom:1rem;}
    .sm-detail-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem;}
    @media(max-width:640px){.sm-detail-grid{grid-template-columns:1fr;}}
    .sm-detail-section{background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:1rem;}
    .sm-detail-heading{font-size:.84rem;font-weight:700;color:var(--nd-navy);margin:0 0 .65rem;display:flex;align-items:center;gap:.35rem;}
    .sm-detail-heading i{color:var(--nd-amber);font-size:.72rem;}
    .sm-detail-row{display:flex;justify-content:space-between;align-items:flex-start;font-size:.82rem;padding:.3rem 0;border-bottom:1px solid #f1f5f9;}
    .sm-detail-row:last-child{border-bottom:none;}
    .sm-detail-row span:first-child{color:var(--nd-muted);font-weight:500;min-width:110px;}
    .sm-msg-preview{max-width:250px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-size:.82rem;}
    .sm-msg-full{background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;padding:.75rem;font-size:.84rem;white-space:pre-wrap;word-break:break-word;margin-top:.5rem;}
    .sm-char-count{font-size:.72rem;color:var(--nd-faint);text-align:right;margin-top:.2rem;}
    .sm-radio-group{display:flex;gap:.75rem;flex-wrap:wrap;}
    .sm-radio-group label{display:flex;align-items:center;gap:.3rem;font-size:.84rem;cursor:pointer;}
</style>
@endpush
@endonce

@can('manage-sms')
<div class="nd-page">
    <div class="nd-hero">
        <div class="nd-hero-inner">
            <ul class="nd-breadcrumb">
                <li><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="sep">/</li>
                <li class="active">SMS Management</li>
            </ul>
            <div class="nd-hero-title">
                <h1><i class="fas fa-sms"></i> SMS Management</h1>
                <p class="nd-hero-sub">Send and monitor SMS messages via MTN SMS Gateway</p>
            </div>
        </div>
    </div>

    <div class="nd-content">
        @if(session()->has('success'))
            <div class="sm-alert sm-alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if(session()->has('error'))
            <div class="sm-alert sm-alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
        @endif

        {{-- Stats --}}
        <div class="sm-stats">
            <div class="nd-stat">
                <div class="nd-stat-icon" style="background:rgba(30,58,95,.08);color:var(--nd-navy);"><i class="fas fa-envelope"></i></div>
                <div><div class="nd-stat-label">Total SMS</div><div class="nd-stat-val" style="color:var(--nd-navy);">{{ $stats['total'] }}</div></div>
            </div>
            <div class="nd-stat">
                <div class="nd-stat-icon" style="background:rgba(22,163,74,.08);color:var(--nd-green);"><i class="fas fa-check-circle"></i></div>
                <div><div class="nd-stat-label">Sent</div><div class="nd-stat-val" style="color:var(--nd-green);">{{ $stats['sent'] }}</div></div>
            </div>
            <div class="nd-stat">
                <div class="nd-stat-icon" style="background:rgba(220,38,38,.08);color:var(--nd-red);"><i class="fas fa-times-circle"></i></div>
                <div><div class="nd-stat-label">Failed</div><div class="nd-stat-val" style="color:var(--nd-red);">{{ $stats['failed'] }}</div></div>
            </div>
            <div class="nd-stat">
                <div class="nd-stat-icon" style="background:rgba(217,119,6,.08);color:var(--nd-amber);"><i class="fas fa-calendar-day"></i></div>
                <div><div class="nd-stat-label">Today</div><div class="nd-stat-val" style="color:var(--nd-amber);">{{ $stats['today'] }}</div></div>
            </div>
            <div class="nd-stat">
                <div class="nd-stat-icon" style="background:rgba(37,99,235,.08);color:#2563eb;"><i class="fas fa-calendar-alt"></i></div>
                <div><div class="nd-stat-label">This Month</div><div class="nd-stat-val" style="color:#2563eb;">{{ $stats['this_month'] }}</div></div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div style="display:flex;gap:.5rem;margin-bottom:1rem;flex-wrap:wrap;">
            <button type="button" wire:click="openCompose" class="sm-btn-send"><i class="fas fa-paper-plane"></i> Send SMS</button>
            <button type="button" wire:click="openBulk" class="sm-btn-send sm-btn-bulk"><i class="fas fa-users"></i> Bulk SMS</button>
        </div>

        {{-- SMS Log Table --}}
        <div class="nd-card">
            <div class="nd-card-header">
                <h3><i class="fas fa-list"></i> SMS Log</h3>
                <div class="nd-toolbar">
                    <select wire:model.live="statusFilter" class="nd-select" style="min-width:120px;">
                        <option value="">All Status</option>
                        <option value="sent">Sent</option>
                        <option value="failed">Failed</option>
                        <option value="pending">Pending</option>
                    </select>
                    <div class="nd-search"><i class="fas fa-search"></i>
                        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search number, message...">
                    </div>
                    <select wire:model.live="perPage" class="nd-select" style="min-width:75px;">
                        <option value="15">15</option><option value="25">25</option><option value="50">50</option>
                    </select>
                </div>
            </div>
            <div style="overflow-x:auto;">
                <table class="nd-table">
                    <thead>
                        <tr>
                            <th>Recipient</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Transaction ID</th>
                            <th>Sent By</th>
                            <th>Sent At</th>
                            <th style="width:70px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                            <tr>
                                <td><span class="sm-code">{{ $log->recipient }}</span></td>
                                <td><div class="sm-msg-preview" title="{{ $log->message }}">{{ $log->message }}</div></td>
                                <td>
                                    @if($log->status === 'sent')
                                        <span class="nd-badge sm-badge-sent"><i class="fas fa-check-circle" style="font-size:.55rem;margin-right:.2rem;"></i>Sent</span>
                                    @elseif($log->status === 'failed')
                                        <span class="nd-badge sm-badge-failed"><i class="fas fa-times-circle" style="font-size:.55rem;margin-right:.2rem;"></i>Failed</span>
                                    @else
                                        <span class="nd-badge sm-badge-pending"><i class="fas fa-clock" style="font-size:.55rem;margin-right:.2rem;"></i>Pending</span>
                                    @endif
                                </td>
                                <td>
                                    @if($log->transaction_id)
                                        <span class="sm-code" style="font-size:.72rem;">{{ Str::limit($log->transaction_id, 20) }}</span>
                                    @else
                                        <span style="color:var(--nd-faint);">—</span>
                                    @endif
                                </td>
                                <td style="font-size:.82rem;">{{ $log->sender->name ?? '—' }}</td>
                                <td style="font-size:.8rem;color:var(--nd-muted);">{{ $log->sent_at ? $log->sent_at->format('d M Y H:i') : '—' }}</td>
                                <td>
                                    <div style="display:flex;gap:4px;align-items:center;">
                                        <button type="button" wire:click="viewDetail({{ $log->id }})" class="sm-act sm-act-view" title="View Details"><i class="fas fa-eye"></i></button>
                                        @if($log->status === 'failed')
                                            <button type="button" wire:click="retrySms({{ $log->id }})" class="sm-act sm-act-retry" title="Retry"><i class="fas fa-redo"></i></button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7"><div class="nd-empty"><i class="fas fa-sms"></i><p>No SMS logs found</p></div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($logs->hasPages())
                <div class="nd-footer">
                    <span>Showing {{ $logs->firstItem() ?? 0 }} — {{ $logs->lastItem() ?? 0 }} of {{ $logs->total() }}</span>
                    {{ $logs->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- ═══════════════════════════════════════
         Compose Single SMS Modal
     ═══════════════════════════════════════ --}}
    @if($showComposeModal)
        <div class="nd-overlay" wire:click.self="closeCompose">
            <div class="nd-modal">
                <div class="nd-modal-head" style="background:linear-gradient(135deg,#1e3a5f,#2563eb);color:#fff;">
                    <h5><i class="fas fa-paper-plane"></i> Send SMS</h5>
                    <button class="nd-modal-close" wire:click="closeCompose" style="color:#fff;">&times;</button>
                </div>
                <div class="nd-modal-body">
                    <div class="sm-info-box">
                        <i class="fas fa-info-circle" style="margin-top:2px;color:#2563eb;"></i>
                        <span>Messages are sent via the MTN SMS Gateway. Enter a Zambian mobile number (e.g. 0977123456 or 260977123456).</span>
                    </div>

                    <div style="margin-bottom:1rem;">
                        <label class="sm-label">Recipient Number <span class="req">*</span></label>
                        <input type="text" wire:model="composeRecipient" class="sm-input" placeholder="e.g. 0977123456">
                        @error('composeRecipient') <div class="sm-error">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label class="sm-label">Message <span class="req">*</span></label>
                        <textarea wire:model="composeMessage" class="sm-input sm-textarea" rows="4" placeholder="Type your message here..." maxlength="640"></textarea>
                        @error('composeMessage') <div class="sm-error">{{ $message }}</div> @enderror
                        <div class="sm-char-count">{{ strlen($composeMessage) }} / 640 characters</div>
                    </div>
                </div>
                <div class="nd-modal-foot">
                    <button type="button" wire:click="closeCompose" class="nd-btn-cancel">Cancel</button>
                    <button type="button" wire:click="sendSingle" class="sm-btn-send" wire:loading.attr="disabled" wire:target="sendSingle">
                        <span wire:loading.remove wire:target="sendSingle"><i class="fas fa-paper-plane" style="margin-right:.3rem;"></i> Send</span>
                        <span wire:loading wire:target="sendSingle"><i class="fas fa-spinner fa-spin" style="margin-right:.3rem;"></i> Sending...</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- ═══════════════════════════════════════
         Bulk SMS Modal
     ═══════════════════════════════════════ --}}
    @if($showBulkModal)
        <div class="nd-overlay" wire:click.self="closeBulk">
            <div class="nd-modal" style="max-width:600px;">
                <div class="nd-modal-head" style="background:linear-gradient(135deg,#166534,#16a34a);color:#fff;">
                    <h5><i class="fas fa-users"></i> Bulk SMS</h5>
                    <button class="nd-modal-close" wire:click="closeBulk" style="color:#fff;">&times;</button>
                </div>
                <div class="nd-modal-body">
                    <div class="sm-info-box">
                        <i class="fas fa-info-circle" style="margin-top:2px;color:#2563eb;"></i>
                        <span>Send the same message to multiple recipients. Messages are batched in groups of 25 for optimal delivery.</span>
                    </div>

                    {{-- Target selector --}}
                    <div style="margin-bottom:1rem;">
                        <label class="sm-label">Recipients <span class="req">*</span></label>
                        <div class="sm-radio-group">
                            <label><input type="radio" wire:model.live="bulkTarget" value="all"> All users</label>
                            <label><input type="radio" wire:model.live="bulkTarget" value="bank"> Village bank members</label>
                            <label><input type="radio" wire:model.live="bulkTarget" value="custom"> Custom numbers</label>
                        </div>
                        @error('bulkTarget') <div class="sm-error">{{ $message }}</div> @enderror
                    </div>

                    {{-- Village bank selector --}}
                    @if($bulkTarget === 'bank')
                        <div style="margin-bottom:1rem;">
                            <label class="sm-label">Village Bank <span class="req">*</span></label>
                            <select wire:model="bulkBankId" class="sm-input">
                                <option value="">— Select a village bank —</option>
                                @foreach($villageBanks as $bId => $bName)
                                    <option value="{{ $bId }}">{{ $bName }}</option>
                                @endforeach
                            </select>
                            @error('bulkBankId') <div class="sm-error">{{ $message }}</div> @enderror
                        </div>
                    @endif

                    {{-- Custom numbers --}}
                    @if($bulkTarget === 'custom')
                        <div style="margin-bottom:1rem;">
                            <label class="sm-label">Phone Numbers <span class="req">*</span></label>
                            <textarea wire:model="bulkCustomNumbers" class="sm-input sm-textarea" rows="4" placeholder="Enter numbers separated by commas or newlines&#10;e.g. 0977123456, 0966789012"></textarea>
                            @error('bulkCustomNumbers') <div class="sm-error">{{ $message }}</div> @enderror
                            <small style="color:var(--nd-faint);font-size:.74rem;">Separate numbers with commas, semicolons, or new lines</small>
                        </div>
                    @endif

                    <div>
                        <label class="sm-label">Message <span class="req">*</span></label>
                        <textarea wire:model="bulkMessage" class="sm-input sm-textarea" rows="4" placeholder="Type your message here..." maxlength="640"></textarea>
                        @error('bulkMessage') <div class="sm-error">{{ $message }}</div> @enderror
                        <div class="sm-char-count">{{ strlen($bulkMessage) }} / 640 characters</div>
                    </div>
                </div>
                <div class="nd-modal-foot">
                    <button type="button" wire:click="closeBulk" class="nd-btn-cancel">Cancel</button>
                    <button type="button" wire:click="sendBulk" class="sm-btn-send sm-btn-bulk" wire:loading.attr="disabled" wire:target="sendBulk">
                        <span wire:loading.remove wire:target="sendBulk"><i class="fas fa-paper-plane" style="margin-right:.3rem;"></i> Send Bulk</span>
                        <span wire:loading wire:target="sendBulk"><i class="fas fa-spinner fa-spin" style="margin-right:.3rem;"></i> Sending...</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- ═══════════════════════════════════════
         SMS Detail Modal
     ═══════════════════════════════════════ --}}
    @if($showDetailModal && $detailLog)
        <div class="nd-overlay" wire:click.self="closeDetail">
            <div class="nd-modal" style="max-width:620px;">
                <div class="nd-modal-head">
                    <h5><i class="fas fa-envelope-open-text"></i> SMS Details</h5>
                    <button class="nd-modal-close" wire:click="closeDetail">&times;</button>
                </div>
                <div class="nd-modal-body" style="max-height:65vh;overflow-y:auto;">
                    <div class="sm-detail-grid">
                        <div class="sm-detail-section">
                            <h6 class="sm-detail-heading"><i class="fas fa-paper-plane"></i> Delivery</h6>
                            <div class="sm-detail-row"><span>Recipient:</span> <code class="sm-code">{{ $detailLog->recipient }}</code></div>
                            <div class="sm-detail-row"><span>Status:</span>
                                @if($detailLog->status === 'sent')
                                    <span class="nd-badge sm-badge-sent">Sent</span>
                                @elseif($detailLog->status === 'failed')
                                    <span class="nd-badge sm-badge-failed">Failed</span>
                                @else
                                    <span class="nd-badge sm-badge-pending">Pending</span>
                                @endif
                            </div>
                            <div class="sm-detail-row"><span>Sender:</span> {{ $detailLog->sender_address ?? '—' }}</div>
                            <div class="sm-detail-row"><span>Service Code:</span> {{ $detailLog->service_code ?? '—' }}</div>
                            <div class="sm-detail-row"><span>Sent At:</span> {{ $detailLog->sent_at ? $detailLog->sent_at->format('d M Y H:i:s') : '—' }}</div>
                        </div>

                        <div class="sm-detail-section">
                            <h6 class="sm-detail-heading"><i class="fas fa-server"></i> API Response</h6>
                            <div class="sm-detail-row"><span>Transaction ID:</span> <code class="sm-code" style="font-size:.7rem;">{{ $detailLog->transaction_id ?? '—' }}</code></div>
                            <div class="sm-detail-row"><span>Correlation ID:</span> <code class="sm-code" style="font-size:.7rem;">{{ Str::limit($detailLog->correlation_id, 24) ?? '—' }}</code></div>
                            <div class="sm-detail-row"><span>Status Code:</span> {{ $detailLog->status_code ?? '—' }}</div>
                            <div class="sm-detail-row"><span>Status Message:</span> <span style="font-size:.78rem;">{{ $detailLog->status_message ?? '—' }}</span></div>
                            <div class="sm-detail-row"><span>Sent By:</span> {{ $detailLog->sender->name ?? '—' }}</div>
                        </div>
                    </div>

                    {{-- Full message --}}
                    <div style="margin-top:1rem;">
                        <h6 class="sm-detail-heading"><i class="fas fa-comment-dots"></i> Message Content</h6>
                        <div class="sm-msg-full">{{ $detailLog->message }}</div>
                    </div>
                </div>
                <div class="nd-modal-foot">
                    @if($detailLog->status === 'failed')
                        <button type="button" wire:click="retrySms({{ $detailLog->id }})" class="sm-btn-send" style="background:var(--nd-amber);">
                            <i class="fas fa-redo" style="margin-right:.3rem;"></i> Retry
                        </button>
                    @endif
                    <button type="button" wire:click="closeDetail" class="nd-btn-cancel">Close</button>
                </div>
            </div>
        </div>
    @endif
</div>
@else
    @include('livewire.partials.unauthorized')
@endcan

</div>
