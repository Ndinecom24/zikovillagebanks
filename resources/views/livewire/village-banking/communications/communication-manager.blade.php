<div>

@once
@push('custom-styles')
<style>
    /* ── Communications Manager (cm-*) ── */
    .cm-alert{padding:.65rem 1rem;border-radius:10px;font-size:.84rem;display:flex;align-items:center;gap:.5rem;margin-bottom:1rem;}
    .cm-alert-success{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;}
    .cm-alert-error{background:#fef2f2;color:#991b1b;border:1px solid #fecaca;}
    .cm-alert-warning{background:#fffbeb;color:#92400e;border:1px solid #fde68a;}
    .cm-stats{display:grid;grid-template-columns:repeat(auto-fill,minmax(170px,1fr));gap:.75rem;margin-bottom:1.25rem;}
    .cm-label{display:block;font-size:.7rem;text-transform:uppercase;letter-spacing:.5px;font-weight:700;color:var(--nd-faint);margin-bottom:.35rem;}
    .cm-input{width:100%;padding:.55rem .85rem;border:1px solid #e2e8f0;border-radius:10px;font-size:.85rem;background:#fafbfd;transition:border .2s;resize:vertical;}
    .cm-input:focus{outline:none;border-color:var(--nd-amber);background:#fff;box-shadow:0 0 0 3px rgba(217,119,6,.08);}
    .cm-error{font-size:.72rem;color:var(--nd-red);margin-top:.25rem;}
    .cm-textarea{min-height:100px;}
    .cm-act{width:28px;height:28px;border-radius:7px;border:1px solid #e2e8f0;background:#fff;display:inline-flex;align-items:center;justify-content:center;cursor:pointer;font-size:.72rem;color:var(--nd-muted);transition:all .15s;}
    .cm-act:hover{background:#f8fafc;color:var(--nd-navy);border-color:#cbd5e1;}
    .cm-badge-email{background:#eff6ff;color:#1e40af;border:1px solid #bfdbfe;}
    .cm-badge-sms{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;}
    .cm-badge-sent{background:#f0fdf4;color:#166534;border:1px solid #bbf7d0;}
    .cm-badge-failed{background:#fef2f2;color:#991b1b;border:1px solid #fecaca;}
    .cm-badge-sending{background:#fef3c7;color:#92400e;border:1px solid #fde68a;}
    .cm-msg-preview{max-width:280px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-size:.82rem;}
    .cm-msg-full{background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;padding:.75rem;font-size:.84rem;white-space:pre-wrap;word-break:break-word;margin-top:.5rem;}
    .cm-btn-compose{padding:.42rem 1rem;border-radius:8px;border:none;font-size:.84rem;font-weight:600;cursor:pointer;background:var(--nd-navy);color:#fff;display:inline-flex;align-items:center;gap:.3rem;transition:all .15s;}
    .cm-btn-compose:hover{opacity:.9;}
    .cm-info-box{display:flex;gap:.55rem;padding:.65rem .85rem;background:#eff6ff;border:1px solid #bfdbfe;border-radius:10px;font-size:.82rem;color:#1e40af;margin-bottom:1rem;}
    .cm-channel-tabs{display:flex;gap:.5rem;margin-bottom:1rem;}
    .cm-channel-tab{padding:.4rem .9rem;border-radius:8px;border:2px solid #e2e8f0;background:#fff;font-size:.82rem;font-weight:600;cursor:pointer;transition:all .15s;display:inline-flex;align-items:center;gap:.3rem;}
    .cm-channel-tab:hover{border-color:#cbd5e1;}
    .cm-channel-tab.active-email{border-color:#2563eb;background:#eff6ff;color:#1e40af;}
    .cm-channel-tab.active-sms{border-color:#16a34a;background:#f0fdf4;color:#166534;}
    .cm-channel-tab.disabled{opacity:.4;cursor:not-allowed;}
    .cm-member-list{max-height:200px;overflow-y:auto;border:1px solid #e2e8f0;border-radius:10px;padding:.5rem;}
    .cm-member-item{display:flex;align-items:center;gap:.5rem;padding:.35rem .5rem;border-radius:6px;font-size:.82rem;cursor:pointer;transition:background .1s;}
    .cm-member-item:hover{background:#f8fafc;}
    .cm-member-item input[type="checkbox"]{accent-color:var(--nd-navy);width:15px;height:15px;}
    .cm-member-name{font-weight:600;color:var(--nd-navy);}
    .cm-member-contact{font-size:.75rem;color:var(--nd-faint);}
    .cm-char-count{font-size:.72rem;color:var(--nd-faint);text-align:right;margin-top:.2rem;}
    .cm-detail-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem;}
    @media(max-width:640px){.cm-detail-grid{grid-template-columns:1fr;}}
    .cm-detail-section{background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:1rem;}
    .cm-detail-heading{font-size:.84rem;font-weight:700;color:var(--nd-navy);margin:0 0 .65rem;display:flex;align-items:center;gap:.35rem;}
    .cm-detail-heading i{color:var(--nd-amber);font-size:.72rem;}
    .cm-detail-row{display:flex;justify-content:space-between;align-items:flex-start;font-size:.82rem;padding:.3rem 0;border-bottom:1px solid #f1f5f9;}
    .cm-detail-row:last-child{border-bottom:none;}
    .cm-detail-row span:first-child{color:var(--nd-muted);font-weight:500;min-width:100px;}
    .cm-disabled-banner{display:flex;align-items:center;gap:.6rem;padding:1rem 1.25rem;background:#fef3c7;border:1px solid #fde68a;border-radius:12px;font-size:.84rem;color:#92400e;margin-bottom:1rem;}
</style>
@endpush
@endonce

@can('manage-communications')
<div class="nd-page">
    <div class="nd-hero">
        <div class="nd-hero-inner">
            <ul class="nd-breadcrumb">
                <li><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="sep">/</li>
                <li class="active">Communications</li>
            </ul>
            <div class="nd-hero-title">
                <h1><i class="fas fa-comments"></i> Communications</h1>
                <p class="nd-hero-sub">Send emails and SMS to village bank members</p>
            </div>
        </div>
    </div>

    <div class="nd-content">

        {{-- VB Selector --}}
        @if(count($this->villageBanks) > 1)
            <div style="margin-bottom:1rem;">
                <select wire:model.live="villageBankId" class="cm-input" style="max-width:360px;">
                    <option value="">— Select Village Bank —</option>
                    @foreach($this->villageBanks as $vb)
                        <option value="{{ $vb->id }}">{{ $vb->name }} ({{ $vb->code }})</option>
                    @endforeach
                </select>
            </div>
        @endif

        {{-- Flash messages --}}
        @if(session()->has('success'))
            <div class="cm-alert cm-alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if(session()->has('error'))
            <div class="cm-alert cm-alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
        @endif
        @if(session()->has('warning'))
            <div class="cm-alert cm-alert-warning"><i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}</div>
        @endif

        @if($this->activeBankId())

        {{-- Channel status banner --}}
        @if(empty($allowedChannels))
            <div class="cm-disabled-banner">
                <i class="fas fa-exclamation-triangle" style="font-size:1.1rem;"></i>
                <div>
                    <strong>Communications disabled</strong> — No communication channels are enabled for this village bank.
                    Go to <a href="{{ route('settings.bank-config') }}" style="color:#92400e;font-weight:700;text-decoration:underline;">Bank Configuration → Communications</a> to enable email or SMS.
                </div>
            </div>
        @endif

        {{-- Stats --}}
        <div class="cm-stats">
            <div class="nd-stat">
                <div class="nd-stat-icon" style="background:rgba(30,58,95,.08);color:var(--nd-navy);"><i class="fas fa-comments"></i></div>
                <div><div class="nd-stat-label">Total Sent</div><div class="nd-stat-val" style="color:var(--nd-navy);">{{ $statsData['total'] }}</div></div>
            </div>
            <div class="nd-stat">
                <div class="nd-stat-icon" style="background:rgba(37,99,235,.08);color:#2563eb;"><i class="fas fa-envelope"></i></div>
                <div><div class="nd-stat-label">Emails</div><div class="nd-stat-val" style="color:#2563eb;">{{ $statsData['emails'] }}</div></div>
            </div>
            <div class="nd-stat">
                <div class="nd-stat-icon" style="background:rgba(22,163,74,.08);color:var(--nd-green);"><i class="fas fa-sms"></i></div>
                <div><div class="nd-stat-label">SMS</div><div class="nd-stat-val" style="color:var(--nd-green);">{{ $statsData['sms'] }}</div></div>
            </div>
            <div class="nd-stat">
                <div class="nd-stat-icon" style="background:rgba(217,119,6,.08);color:var(--nd-amber);"><i class="fas fa-calendar-alt"></i></div>
                <div><div class="nd-stat-label">This Month</div><div class="nd-stat-val" style="color:var(--nd-amber);">{{ $statsData['this_month'] }}</div></div>
            </div>
        </div>

        {{-- Compose button --}}
        @if(!empty($allowedChannels))
        <div style="margin-bottom:1rem;">
            <button type="button" wire:click="openCompose" class="cm-btn-compose"><i class="fas fa-pen"></i> Compose Message</button>
        </div>
        @endif

        {{-- Communications Log --}}
        <div class="nd-card">
            <div class="nd-card-header">
                <h3><i class="fas fa-history"></i> Message History</h3>
                <div class="nd-toolbar">
                    <select wire:model.live="channelFilter" class="nd-select" style="min-width:120px;">
                        <option value="">All Channels</option>
                        <option value="email">Email</option>
                        <option value="sms">SMS</option>
                    </select>
                    <div class="nd-search"><i class="fas fa-search"></i>
                        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search subject, message...">
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
                            <th>Channel</th>
                            <th>Subject / Message</th>
                            <th>Recipients</th>
                            <th>Sent / Failed</th>
                            <th>Status</th>
                            <th>Sent By</th>
                            <th>Date</th>
                            <th style="width:50px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($communications as $comm)
                            <tr>
                                <td>
                                    @if($comm->channel === 'email')
                                        <span class="nd-badge cm-badge-email"><i class="fas fa-envelope" style="font-size:.55rem;margin-right:.2rem;"></i>Email</span>
                                    @else
                                        <span class="nd-badge cm-badge-sms"><i class="fas fa-sms" style="font-size:.55rem;margin-right:.2rem;"></i>SMS</span>
                                    @endif
                                </td>
                                <td>
                                    @if($comm->subject)
                                        <strong style="font-size:.82rem;">{{ Str::limit($comm->subject, 35) }}</strong><br>
                                    @endif
                                    <div class="cm-msg-preview">{{ $comm->message }}</div>
                                </td>
                                <td style="font-size:.82rem;">
                                    <span style="font-weight:600;">{{ $comm->total_recipients }}</span>
                                    <span style="color:var(--nd-faint);">{{ $comm->recipient_type === 'all' ? '(all)' : '(selected)' }}</span>
                                </td>
                                <td style="font-size:.82rem;">
                                    <span style="color:var(--nd-green);font-weight:600;">{{ $comm->sent_count }}</span>
                                    @if($comm->failed_count > 0)
                                        / <span style="color:var(--nd-red);font-weight:600;">{{ $comm->failed_count }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($comm->status === 'sent' && $comm->failed_count === 0)
                                        <span class="nd-badge cm-badge-sent"><i class="fas fa-check-circle" style="font-size:.55rem;margin-right:.15rem;"></i>Sent</span>
                                    @elseif($comm->status === 'sent' && $comm->failed_count > 0)
                                        <span class="nd-badge cm-badge-sending"><i class="fas fa-exclamation-triangle" style="font-size:.55rem;margin-right:.15rem;"></i>Partial</span>
                                    @elseif($comm->status === 'sending')
                                        <span class="nd-badge cm-badge-sending"><i class="fas fa-spinner fa-spin" style="font-size:.55rem;margin-right:.15rem;"></i>Sending</span>
                                    @else
                                        <span class="nd-badge cm-badge-failed"><i class="fas fa-times-circle" style="font-size:.55rem;margin-right:.15rem;"></i>Failed</span>
                                    @endif
                                </td>
                                <td style="font-size:.82rem;">{{ $comm->sender->name ?? '—' }}</td>
                                <td style="font-size:.8rem;color:var(--nd-muted);">{{ $comm->sent_at ? $comm->sent_at->format('d M Y H:i') : '—' }}</td>
                                <td>
                                    <button type="button" wire:click="viewDetail({{ $comm->id }})" class="cm-act" title="View Details"><i class="fas fa-eye"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8"><div class="nd-empty"><i class="fas fa-comments"></i><p>No communications sent yet</p></div></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($communications->hasPages())
                <div class="nd-footer">
                    <span>Showing {{ $communications->firstItem() ?? 0 }} — {{ $communications->lastItem() ?? 0 }} of {{ $communications->total() }}</span>
                    {{ $communications->links() }}
                </div>
            @endif
        </div>

        @else
            <div class="nd-card">
                <div style="text-align:center;padding:3rem;">
                    <i class="fas fa-university" style="font-size:2.5rem;color:var(--nd-faint);margin-bottom:1rem;"></i>
                    <p style="font-size:.9rem;color:var(--nd-muted);margin:0;">Please select a village bank to manage communications.</p>
                </div>
            </div>
        @endif
    </div>

    {{-- ═══════════════════════════════════════
         Compose Message Modal
     ═══════════════════════════════════════ --}}
    @if($showComposeModal)
        <div class="nd-overlay" wire:click.self="closeCompose">
            <div class="nd-modal" style="max-width:680px;width:95%;">
                <div class="nd-modal-head" style="background:linear-gradient(135deg,#1e3a5f,#2563eb);color:#fff;">
                    <h5><i class="fas fa-pen"></i> Compose Message</h5>
                    <button class="nd-modal-close" wire:click="closeCompose" style="color:#fff;">&times;</button>
                </div>
                <div class="nd-modal-body" style="max-height:70vh;overflow-y:auto;">

                    {{-- Channel selector --}}
                    <div style="margin-bottom:1rem;">
                        <label class="cm-label">Communication Channel</label>
                        <div class="cm-channel-tabs">
                            @if(in_array('email', $allowedChannels))
                                <button type="button"
                                    wire:click="$set('composeChannel', 'email')"
                                    class="cm-channel-tab {{ $composeChannel === 'email' ? 'active-email' : '' }}">
                                    <i class="fas fa-envelope"></i> Email
                                </button>
                            @else
                                <span class="cm-channel-tab disabled"><i class="fas fa-envelope"></i> Email (disabled)</span>
                            @endif

                            @if(in_array('sms', $allowedChannels))
                                <button type="button"
                                    wire:click="$set('composeChannel', 'sms')"
                                    class="cm-channel-tab {{ $composeChannel === 'sms' ? 'active-sms' : '' }}">
                                    <i class="fas fa-sms"></i> SMS
                                </button>
                            @else
                                <span class="cm-channel-tab disabled"><i class="fas fa-sms"></i> SMS (disabled)</span>
                            @endif
                        </div>
                    </div>

                    {{-- Email subject --}}
                    @if($composeChannel === 'email')
                    <div style="margin-bottom:1rem;">
                        <label class="cm-label">Subject <span class="req">*</span></label>
                        <input type="text" wire:model="composeSubject" class="cm-input" placeholder="Enter email subject...">
                        @error('composeSubject') <div class="cm-error">{{ $message }}</div> @enderror
                    </div>
                    @endif

                    {{-- Message body --}}
                    <div style="margin-bottom:1rem;">
                        <label class="cm-label">Message <span class="req">*</span></label>
                        <textarea wire:model="composeMessage" class="cm-input cm-textarea" rows="5"
                            placeholder="{{ $composeChannel === 'sms' ? 'Type your SMS (max 160 chars for single part)...' : 'Type your message...' }}"
                            maxlength="{{ $composeChannel === 'sms' ? '640' : '2000' }}"></textarea>
                        @error('composeMessage') <div class="cm-error">{{ $message }}</div> @enderror
                        <div class="cm-char-count">
                            {{ strlen($composeMessage) }} / {{ $composeChannel === 'sms' ? '640' : '2000' }} characters
                            @if($composeChannel === 'sms' && strlen($composeMessage) > 160)
                                <span style="color:var(--nd-amber);margin-left:.5rem;">({{ ceil(strlen($composeMessage) / 153) }} parts)</span>
                            @endif
                        </div>
                    </div>

                    {{-- Recipients --}}
                    <div style="margin-bottom:1rem;">
                        <label class="cm-label">Recipients</label>
                        <div style="display:flex;gap:.75rem;margin-bottom:.5rem;">
                            <label style="display:flex;align-items:center;gap:.3rem;font-size:.84rem;cursor:pointer;">
                                <input type="radio" wire:model.live="composeRecipientType" value="all"> All members
                            </label>
                            <label style="display:flex;align-items:center;gap:.3rem;font-size:.84rem;cursor:pointer;">
                                <input type="radio" wire:model.live="composeRecipientType" value="selected"> Select members
                            </label>
                        </div>

                        @if($composeRecipientType === 'selected')
                            <div class="cm-member-list">
                                @forelse($members as $member)
                                    <label class="cm-member-item">
                                        <input type="checkbox" wire:model="composeSelectedMembers" value="{{ $member->id }}">
                                        <div>
                                            <span class="cm-member-name">{{ $member->name }}</span>
                                            <span class="cm-member-contact">
                                                @if($composeChannel === 'email')
                                                    {{ $member->email ?? 'No email' }}
                                                @else
                                                    {{ $member->mobile_no ?? 'No phone' }}
                                                @endif
                                            </span>
                                        </div>
                                    </label>
                                @empty
                                    <p style="color:var(--nd-faint);font-size:.82rem;text-align:center;padding:.5rem;">No members found.</p>
                                @endforelse
                            </div>
                            @error('composeSelectedMembers') <div class="cm-error">{{ $message }}</div> @enderror
                            @if(count($composeSelectedMembers) > 0)
                                <div style="font-size:.75rem;color:var(--nd-muted);margin-top:.3rem;">
                                    {{ count($composeSelectedMembers) }} member(s) selected
                                </div>
                            @endif
                        @else
                            <div class="cm-info-box" style="margin-top:.35rem;">
                                <i class="fas fa-users" style="color:#2563eb;"></i>
                                <span>Message will be sent to <strong>all members</strong> of this village bank who have a valid {{ $composeChannel === 'email' ? 'email address' : 'phone number' }}.</span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="nd-modal-foot">
                    <button type="button" wire:click="closeCompose" class="nd-btn-cancel">Cancel</button>
                    <button type="button" wire:click="sendMessage" class="cm-btn-compose" wire:loading.attr="disabled" wire:target="sendMessage">
                        <span wire:loading.remove wire:target="sendMessage">
                            <i class="fas fa-{{ $composeChannel === 'email' ? 'paper-plane' : 'sms' }}" style="margin-right:.3rem;"></i>
                            Send {{ ucfirst($composeChannel) }}
                        </span>
                        <span wire:loading wire:target="sendMessage"><i class="fas fa-spinner fa-spin" style="margin-right:.3rem;"></i> Sending...</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- ═══════════════════════════════════════
         Detail Modal
     ═══════════════════════════════════════ --}}
    @if($showDetailModal && $detailComm)
        <div class="nd-overlay" wire:click.self="closeDetail">
            <div class="nd-modal" style="max-width:650px;width:95%;">
                <div class="nd-modal-head">
                    <h5><i class="fas fa-envelope-open-text"></i> Communication Details</h5>
                    <button class="nd-modal-close" wire:click="closeDetail">&times;</button>
                </div>
                <div class="nd-modal-body" style="max-height:65vh;overflow-y:auto;">
                    <div class="cm-detail-grid">
                        <div class="cm-detail-section">
                            <h6 class="cm-detail-heading"><i class="fas fa-info-circle"></i> Details</h6>
                            <div class="cm-detail-row"><span>Channel:</span>
                                @if($detailComm->channel === 'email')
                                    <span class="nd-badge cm-badge-email">Email</span>
                                @else
                                    <span class="nd-badge cm-badge-sms">SMS</span>
                                @endif
                            </div>
                            @if($detailComm->subject)
                                <div class="cm-detail-row"><span>Subject:</span> <strong>{{ $detailComm->subject }}</strong></div>
                            @endif
                            <div class="cm-detail-row"><span>Village Bank:</span> {{ $detailComm->villageBank->name ?? '—' }}</div>
                            <div class="cm-detail-row"><span>Sent By:</span> {{ $detailComm->sender->name ?? '—' }}</div>
                            <div class="cm-detail-row"><span>Date:</span> {{ $detailComm->sent_at ? $detailComm->sent_at->format('d M Y H:i:s') : '—' }}</div>
                        </div>

                        <div class="cm-detail-section">
                            <h6 class="cm-detail-heading"><i class="fas fa-chart-bar"></i> Delivery</h6>
                            <div class="cm-detail-row"><span>Recipients:</span>
                                <strong>{{ $detailComm->total_recipients }}</strong>
                                <span style="color:var(--nd-faint);">({{ $detailComm->recipient_type }})</span>
                            </div>
                            <div class="cm-detail-row"><span>Sent:</span> <strong style="color:var(--nd-green);">{{ $detailComm->sent_count }}</strong></div>
                            <div class="cm-detail-row"><span>Failed:</span>
                                <strong style="color:{{ $detailComm->failed_count > 0 ? 'var(--nd-red)' : 'var(--nd-green)' }};">{{ $detailComm->failed_count }}</strong>
                            </div>
                            <div class="cm-detail-row"><span>Status:</span>
                                @if($detailComm->status === 'sent' && $detailComm->failed_count === 0)
                                    <span class="nd-badge cm-badge-sent">Sent</span>
                                @elseif($detailComm->status === 'sent')
                                    <span class="nd-badge cm-badge-sending">Partial</span>
                                @else
                                    <span class="nd-badge cm-badge-failed">Failed</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div style="margin-top:1rem;">
                        <h6 class="cm-detail-heading"><i class="fas fa-comment-dots"></i> Message Content</h6>
                        <div class="cm-msg-full">{{ $detailComm->message }}</div>
                    </div>
                </div>
                <div class="nd-modal-foot">
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
