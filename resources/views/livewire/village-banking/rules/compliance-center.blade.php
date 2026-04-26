<div>
    @push('custom-styles')
    <style>
        :root {
            --cc-navy:#1E3A5F; --cc-navy-light:#2B6B96; --cc-amber:#D97706; --cc-amber-light:#F59E0B;
            --cc-bg:#f4f6fa; --cc-card:#fff; --cc-border:#edf0f7; --cc-text:#1e293b;
            --cc-muted:#64748b; --cc-faint:#94a3b8; --cc-green:#16a34a; --cc-red:#dc2626; --cc-radius:16px;
        }
        .cc-page { background:var(--cc-bg); min-height:100vh; }
        .cc-hero {
            background:linear-gradient(135deg,var(--cc-navy) 0%,#234b78 50%,var(--cc-navy-light) 100%);
            padding:1.75rem 0 5rem; position:relative; overflow:hidden;
        }
        .cc-hero::before { content:''; position:absolute; width:500px; height:500px; top:-50%; right:-5%; background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%); border-radius:50%; pointer-events:none; }
        .cc-hero-inner { position:relative; z-index:2; padding:0 1.5rem; }
        .cc-hero-title { color:#fff; font-size:1.3rem; font-weight:800; margin:.3rem 0 0; }
        .cc-hero-sub { color:rgba(255,255,255,.5); font-size:.8rem; margin:.15rem 0 0; }
        .cc-content { margin-top:-3.5rem; position:relative; z-index:10; padding:0 1.5rem 2rem; }
        .cc-card { background:var(--cc-card); border-radius:var(--cc-radius); border:1px solid var(--cc-border); box-shadow:0 2px 12px rgba(0,0,0,.04); overflow:hidden; margin-bottom:1.25rem; }
        .cc-card-head { padding:.85rem 1.25rem; border-bottom:1px solid var(--cc-border); display:flex; align-items:center; gap:.45rem; }
        .cc-card-title { font-size:.9rem; font-weight:700; color:var(--cc-text); margin:0; display:flex; align-items:center; gap:.45rem; }
        .cc-card-title i { font-size:.85rem; }
        .cc-card-body { padding:1.25rem 1.5rem; }
        .cc-btn {
            display:inline-flex; align-items:center; gap:.35rem; padding:.5rem 1.2rem; border-radius:10px;
            font-size:.84rem; font-weight:600; border:none; cursor:pointer; transition:all .2s;
        }
        .cc-btn-primary { background:linear-gradient(135deg,var(--cc-navy),var(--cc-navy-light)); color:#fff; }
        .cc-btn-primary:hover { opacity:.9; }
        .cc-btn-success { background:linear-gradient(135deg,#059669,#10b981); color:#fff; }
        .cc-btn-success:hover { opacity:.9; }
        .cc-btn-ghost { background:#f1f5f9; color:var(--cc-text); }
        .cc-btn-ghost:hover { background:#e2e8f0; }
        .cc-btn:disabled { opacity:.5; cursor:not-allowed; }

        /* Status badge */
        .cc-status { display:inline-flex; align-items:center; gap:.3rem; padding:.25rem .65rem; border-radius:20px; font-size:.72rem; font-weight:700; }
        .cc-status-pass { background:#dcfce7; color:#166534; }
        .cc-status-fail { background:#fef2f2; color:#991b1b; }
        .cc-status-warn { background:#fffbeb; color:#92400e; }

        /* Progress bar */
        .cc-progress-track { background:#e2e8f0; border-radius:10px; height:8px; overflow:hidden; }
        .cc-progress-fill { height:100%; border-radius:10px; transition:width .5s ease; }

        /* Rule row */
        .cc-rule-row {
            display:flex; align-items:flex-start; gap:.85rem; padding:.85rem 1rem; border:1px solid #e2e8f0;
            border-radius:10px; margin-bottom:.65rem; transition:all .2s;
        }
        .cc-rule-row:hover { border-color:#cbd5e1; background:#fafbfc; }
        .cc-rule-row.acked { border-color:#bbf7d0; background:#f0fdf4; }
        .cc-rule-icon { width:32px; height:32px; min-width:32px; border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:.8rem; }
        .cc-rule-title { font-size:.88rem; font-weight:700; color:var(--cc-text); }
        .cc-rule-desc { font-size:.78rem; color:var(--cc-muted); margin-top:.2rem; line-height:1.5; }
        .cc-rule-cat { font-size:.68rem; font-weight:700; text-transform:uppercase; letter-spacing:.5px; color:var(--cc-faint); }
        .cc-rule-ack-btn { margin-left:auto; white-space:nowrap; }

        /* Compliance summary */
        .cc-summary-grid { display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:1rem; }
        .cc-summary-item { padding:1rem; background:#f8fafc; border-radius:10px; border:1px solid #e2e8f0; text-align:center; }
        .cc-summary-icon { width:44px; height:44px; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; font-size:1.1rem; margin-bottom:.5rem; }
        .cc-summary-val { font-size:1.4rem; font-weight:800; }
        .cc-summary-label { font-size:.72rem; color:var(--cc-muted); text-transform:uppercase; letter-spacing:.5px; font-weight:600; }

        /* Constitution modal */
        .cc-modal-overlay {
            position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,.6);
            z-index:1050; display:flex; align-items:center; justify-content:center; padding:1rem;
            backdrop-filter:blur(4px);
        }
        .cc-modal {
            background:#fff; border-radius:16px; max-width:800px; width:100%; max-height:85vh;
            display:flex; flex-direction:column; box-shadow:0 20px 60px rgba(0,0,0,.2);
        }
        .cc-modal-head {
            padding:1rem 1.5rem; border-bottom:1px solid #e2e8f0; display:flex; align-items:center; justify-content:space-between;
        }
        .cc-modal-body { padding:1.5rem; overflow-y:auto; flex:1; }
        .cc-modal-foot { padding:1rem 1.5rem; border-top:1px solid #e2e8f0; display:flex; justify-content:flex-end; gap:.5rem; }
        .cc-modal-close { background:none; border:none; font-size:1.3rem; color:var(--cc-faint); cursor:pointer; }
        .cc-modal-close:hover { color:var(--cc-text); }

        /* Constitution text body */
        .cc-constitution-body {
            font-size:.88rem; color:var(--cc-text); line-height:1.8; white-space:pre-wrap;
            max-height:50vh; overflow-y:auto; padding:1rem; background:#f8fafc; border-radius:10px; border:1px solid #e2e8f0;
        }

        /* Compliance banner */
        .cc-banner {
            padding:1rem 1.25rem; border-radius:12px; display:flex; align-items:center; gap:.85rem; margin-bottom:1.25rem;
        }
        .cc-banner-success { background:linear-gradient(135deg,#f0fdf4,#dcfce7); border:1px solid #86efac; }
        .cc-banner-warning { background:linear-gradient(135deg,#fffbeb,#fef3c7); border:1px solid #fde68a; }
        .cc-banner-danger  { background:linear-gradient(135deg,#fef2f2,#fee2e2); border:1px solid #fecaca; }
        .cc-banner-icon { width:40px; height:40px; min-width:40px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:1.1rem; }
    </style>
    @endpush

    @can('view-rules')
    <section class="cc-page">
        <div class="cc-hero">
            <div class="cc-hero-inner">
                <h1 class="cc-hero-title"><i class="fas fa-clipboard-check" style="color:var(--cc-amber-light);margin-right:.4rem;"></i> Compliance Center</h1>
                <p class="cc-hero-sub">Review and acknowledge village bank rules and constitution</p>
            </div>
        </div>

        <div class="cc-content" style="max-width:900px;margin-left:auto;margin-right:auto;">

            @include('livewire.partials.village-bank-selector')

            @if(session()->has('message'))
                <div style="background:#dcfce7;border:1px solid #86efac;border-radius:10px;padding:.75rem 1rem;margin-bottom:1rem;display:flex;align-items:center;gap:.5rem;font-size:.85rem;color:#166534;font-weight:600;">
                    <i class="fas fa-check-circle"></i> {{ session('message') }}
                </div>
            @endif

            @if($this->activeBankId())

                {{-- ── Compliance Status Banner ── --}}
                @if($isCompliant)
                    <div class="cc-banner cc-banner-success">
                        <div class="cc-banner-icon" style="background:#dcfce7;color:#16a34a;"><i class="fas fa-shield-alt"></i></div>
                        <div>
                            <div style="font-weight:700;font-size:.9rem;color:#166534;">You're Fully Compliant</div>
                            <div style="font-size:.78rem;color:#15803d;">You have met all requirements and can request loans and make share declarations.</div>
                        </div>
                    </div>
                @else
                    <div class="cc-banner cc-banner-danger">
                        <div class="cc-banner-icon" style="background:#fee2e2;color:#dc2626;"><i class="fas fa-exclamation-triangle"></i></div>
                        <div>
                            <div style="font-weight:700;font-size:.9rem;color:#991b1b;">Action Required</div>
                            <div style="font-size:.78rem;color:#b91c1c;">
                                You must complete the items below before you can request loans or make share declarations.
                            </div>
                            @if($membership)
                                <ul style="margin:.3rem 0 0 1rem;padding:0;font-size:.78rem;color:#b91c1c;">
                                    @foreach($membership->complianceGaps() as $gap)
                                        <li>{{ $gap }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- ── Summary Cards ── --}}
                <div class="cc-summary-grid">
                    {{-- Rules --}}
                    <div class="cc-summary-item">
                        <div class="cc-summary-icon" style="background:{{ $allRulesAcked ? '#dcfce7' : '#fef3c7' }};color:{{ $allRulesAcked ? '#16a34a' : '#d97706' }};">
                            <i class="fas fa-scroll"></i>
                        </div>
                        <div class="cc-summary-val" style="color:{{ $allRulesAcked ? 'var(--cc-green)' : 'var(--cc-amber)' }};">{{ $rulesProgress }}%</div>
                        <div class="cc-summary-label">Rules Acknowledged</div>
                        <span class="cc-status {{ $allRulesAcked ? 'cc-status-pass' : 'cc-status-warn' }}" style="margin-top:.4rem;">
                            <i class="fas fa-{{ $allRulesAcked ? 'check' : 'clock' }}"></i>
                            {{ $allRulesAcked ? 'Complete' : 'Pending' }}
                        </span>
                    </div>

                    {{-- Constitution --}}
                    @if($config && $config->constitution_enabled && $constitution)
                        <div class="cc-summary-item">
                            <div class="cc-summary-icon" style="background:{{ $constitutionAcked ? '#dcfce7' : '#fef2f2' }};color:{{ $constitutionAcked ? '#16a34a' : '#dc2626' }};">
                                <i class="fas fa-file-contract"></i>
                            </div>
                            <div class="cc-summary-val" style="color:{{ $constitutionAcked ? 'var(--cc-green)' : 'var(--cc-red)' }};">
                                {{ $constitutionAcked ? 'Signed' : 'Unsigned' }}
                            </div>
                            <div class="cc-summary-label">Constitution</div>
                            <span class="cc-status {{ $constitutionAcked ? 'cc-status-pass' : 'cc-status-fail' }}" style="margin-top:.4rem;">
                                <i class="fas fa-{{ $constitutionAcked ? 'check' : 'times' }}"></i>
                                {{ $constitutionAcked ? 'Signed v' . $constitution->version : 'Not Signed' }}
                            </span>
                        </div>
                    @endif

                    {{-- Overall --}}
                    <div class="cc-summary-item">
                        <div class="cc-summary-icon" style="background:{{ $isCompliant ? '#dcfce7' : '#fef2f2' }};color:{{ $isCompliant ? '#16a34a' : '#dc2626' }};">
                            <i class="fas fa-{{ $isCompliant ? 'check-circle' : 'ban' }}"></i>
                        </div>
                        <div class="cc-summary-val" style="color:{{ $isCompliant ? 'var(--cc-green)' : 'var(--cc-red)' }};">
                            {{ $isCompliant ? 'Active' : 'Restricted' }}
                        </div>
                        <div class="cc-summary-label">Activity Status</div>
                        <span class="cc-summary-label" style="margin-top:.2rem;font-size:.68rem;">
                            {{ $isCompliant ? 'Can request loans & declare shares' : 'Blocked until compliant' }}
                        </span>
                    </div>
                </div>

                {{-- ── Rules Section ── --}}
                @if($rules->count())
                    <div class="cc-card">
                        <div class="cc-card-head">
                            <h3 class="cc-card-title">
                                <i class="fas fa-scroll" style="color:var(--cc-amber);"></i> Village Bank Rules
                            </h3>
                            <div style="margin-left:auto;display:flex;align-items:center;gap:.5rem;">
                                <span style="font-size:.75rem;font-weight:600;color:{{ $allRulesAcked ? 'var(--cc-green)' : 'var(--cc-amber)' }};">
                                    {{ $rules->where('is_acknowledged', true)->count() }}/{{ $rules->count() }} acknowledged
                                </span>
                                @if(!$allRulesAcked)
                                    <button wire:click="acknowledgeAllRules" class="cc-btn cc-btn-success" style="font-size:.75rem;padding:.35rem .75rem;"
                                            wire:loading.attr="disabled" wire:target="acknowledgeAllRules">
                                        <span wire:loading.remove wire:target="acknowledgeAllRules"><i class="fas fa-check-double"></i> Acknowledge All</span>
                                        <span wire:loading wire:target="acknowledgeAllRules"><i class="fas fa-spinner fa-spin"></i></span>
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="cc-card-body">
                            {{-- Progress bar --}}
                            <div style="margin-bottom:1rem;">
                                <div style="display:flex;justify-content:space-between;margin-bottom:.3rem;">
                                    <span style="font-size:.72rem;font-weight:700;color:var(--cc-faint);">PROGRESS</span>
                                    <span style="font-size:.75rem;font-weight:700;color:{{ $rulesProgress >= 100 ? 'var(--cc-green)' : 'var(--cc-amber)' }};">{{ $rulesProgress }}%</span>
                                </div>
                                <div class="cc-progress-track">
                                    <div class="cc-progress-fill" style="width:{{ $rulesProgress }}%;background:{{ $rulesProgress >= 100 ? 'var(--cc-green)' : ($rulesProgress > 50 ? 'var(--cc-amber)' : 'var(--cc-red)') }};"></div>
                                </div>
                            </div>

                            {{-- Rule list --}}
                            @foreach($rules as $rule)
                                <div class="cc-rule-row {{ $rule->is_acknowledged ? 'acked' : '' }}">
                                    <div class="cc-rule-icon" style="background:{{ $rule->is_acknowledged ? '#dcfce7' : '#f1f5f9' }};color:{{ $rule->is_acknowledged ? '#16a34a' : '#94a3b8' }};">
                                        <i class="fas fa-{{ $rule->is_acknowledged ? 'check' : 'scroll' }}"></i>
                                    </div>
                                    <div style="flex:1;min-width:0;">
                                        <div class="cc-rule-cat">{{ \App\Models\VillageBanking\Rule::CATEGORIES[$rule->category] ?? $rule->category }}</div>
                                        <div class="cc-rule-title">{{ $rule->title }}</div>
                                        <div class="cc-rule-desc">{{ Str::limit($rule->description, 200) }}</div>
                                    </div>
                                    <div class="cc-rule-ack-btn">
                                        @if($rule->is_acknowledged)
                                            <span class="cc-status cc-status-pass"><i class="fas fa-check"></i> Acknowledged</span>
                                        @else
                                            <button wire:click="acknowledgeRule({{ $rule->id }})" class="cc-btn cc-btn-primary" style="font-size:.78rem;padding:.4rem .85rem;"
                                                    wire:loading.attr="disabled" wire:target="acknowledgeRule({{ $rule->id }})">
                                                <i class="fas fa-check"></i> I Agree
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="cc-card">
                        <div class="cc-card-body" style="text-align:center;padding:2rem;color:var(--cc-muted);">
                            <i class="fas fa-scroll" style="font-size:2rem;opacity:.3;margin-bottom:.5rem;display:block;"></i>
                            <p style="margin:0;font-size:.88rem;">No active rules defined for this village bank.</p>
                        </div>
                    </div>
                @endif

                {{-- ── Constitution Section ── --}}
                @if($config && $config->constitution_enabled && $constitution)
                    <div class="cc-card">
                        <div class="cc-card-head">
                            <h3 class="cc-card-title">
                                <i class="fas fa-file-contract" style="color:#7c3aed;"></i> {{ $constitution->title }}
                            </h3>
                            <div style="margin-left:auto;">
                                @if($constitutionAcked)
                                    <span class="cc-status cc-status-pass"><i class="fas fa-check-circle"></i> Signed (v{{ $constitution->version }})</span>
                                @else
                                    <span class="cc-status cc-status-fail"><i class="fas fa-times-circle"></i> Not Signed</span>
                                @endif
                            </div>
                        </div>
                        <div class="cc-card-body">
                            @if($config->require_constitution_before_activity && !$constitutionAcked)
                                <div class="cc-banner cc-banner-warning" style="margin-bottom:1rem;">
                                    <div class="cc-banner-icon" style="background:#fef3c7;color:#d97706;"><i class="fas fa-exclamation-triangle"></i></div>
                                    <div>
                                        <div style="font-weight:700;font-size:.85rem;color:#92400e;">Constitution Acknowledgement Required</div>
                                        <div style="font-size:.78rem;color:#a16207;">You must read and sign the constitution before you can request loans or make share declarations.</div>
                                    </div>
                                </div>
                            @endif

                            <div style="display:flex;align-items:center;gap:1rem;flex-wrap:wrap;">
                                <div style="flex:1;min-width:250px;">
                                    <div style="font-size:.85rem;color:var(--cc-text);line-height:1.6;">
                                        @if($constitution->isTextType())
                                            <p style="margin:0 0 .5rem;color:var(--cc-muted);font-size:.8rem;">
                                                This is the official constitution of your village bank. Please read it carefully and sign below.
                                            </p>
                                        @else
                                            <p style="margin:0 0 .5rem;color:var(--cc-muted);font-size:.8rem;">
                                                The constitution is available as a PDF document. Please download and read it carefully, then sign below.
                                            </p>
                                        @endif
                                    </div>
                                    <div style="font-size:.72rem;color:var(--cc-faint);margin-top:.35rem;">
                                        Version {{ $constitution->version }} &bull;
                                        Last updated {{ $constitution->updated_at->format('d M Y') }} &bull;
                                        {{ $constitution->acknowledgementRate() }}% of members signed
                                    </div>
                                </div>
                                <div style="display:flex;gap:.5rem;">
                                    @if($constitution->isTextType())
                                        <button wire:click="viewConstitution" class="cc-btn cc-btn-ghost">
                                            <i class="fas fa-eye"></i> Read Constitution
                                        </button>
                                    @else
                                        <a href="{{ asset('storage/' . $constitution->file_path) }}" target="_blank" class="cc-btn cc-btn-ghost" style="text-decoration:none;">
                                            <i class="fas fa-file-pdf"></i> Download PDF
                                        </a>
                                    @endif
                                    @if(!$constitutionAcked)
                                        @if($constitution->isTextType())
                                            {{-- Sign button is in the modal --}}
                                        @else
                                            <button wire:click="acknowledgeConstitution" class="cc-btn cc-btn-success"
                                                    wire:loading.attr="disabled" wire:target="acknowledgeConstitution">
                                                <span wire:loading.remove wire:target="acknowledgeConstitution"><i class="fas fa-signature"></i> I Agree & Sign</span>
                                                <span wire:loading wire:target="acknowledgeConstitution"><i class="fas fa-spinner fa-spin"></i></span>
                                            </button>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($config && !$config->constitution_enabled)
                    {{-- Constitution disabled - no section shown --}}
                @endif

            @else
                <div class="cc-card">
                    <div class="cc-card-body" style="text-align:center;padding:3rem;">
                        <i class="fas fa-university" style="font-size:2.5rem;color:var(--cc-faint);margin-bottom:1rem;"></i>
                        <p style="font-size:.9rem;color:var(--cc-muted);margin:0;">Please select a village bank to view your compliance status.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- ── Constitution Reading Modal ── --}}
    @if($showConstitutionModal && $constitution)
        <div class="cc-modal-overlay" wire:click.self="closeConstitution">
            <div class="cc-modal">
                <div class="cc-modal-head">
                    <h3 style="font-size:1rem;font-weight:700;color:var(--cc-text);margin:0;display:flex;align-items:center;gap:.4rem;">
                        <i class="fas fa-file-contract" style="color:#7c3aed;"></i> {{ $constitution->title }}
                    </h3>
                    <button class="cc-modal-close" wire:click="closeConstitution">&times;</button>
                </div>
                <div class="cc-modal-body">
                    <div style="font-size:.72rem;color:var(--cc-faint);margin-bottom:.75rem;">
                        Version {{ $constitution->version }} &bull; Last updated {{ $constitution->updated_at->format('d M Y, H:i') }}
                    </div>
                    <div class="cc-constitution-body">{!! nl2br(e($constitution->body)) !!}</div>
                </div>
                <div class="cc-modal-foot">
                    <button wire:click="closeConstitution" class="cc-btn cc-btn-ghost">Close</button>
                    @if(!$constitutionAcked)
                        <button wire:click="acknowledgeConstitution" class="cc-btn cc-btn-success"
                                wire:loading.attr="disabled" wire:target="acknowledgeConstitution">
                            <span wire:loading.remove wire:target="acknowledgeConstitution"><i class="fas fa-signature"></i> I Have Read & Agree</span>
                            <span wire:loading wire:target="acknowledgeConstitution"><i class="fas fa-spinner fa-spin"></i></span>
                        </button>
                    @else
                        <span class="cc-status cc-status-pass" style="padding:.5rem .85rem;font-size:.8rem;">
                            <i class="fas fa-check-circle"></i> Already Signed
                        </span>
                    @endif
                </div>
            </div>
        </div>
    @endif

    @else
        @include('livewire.partials.unauthorized')
    @endcan
</div>
