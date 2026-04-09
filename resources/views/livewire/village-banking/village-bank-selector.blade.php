<div>
    {{-- ===== Bank Selection Modal (Full-screen overlay) ===== --}}
    @if($showModal)
        <div style="position:fixed;inset:0;z-index:9999;background:rgba(15,26,46,0.85);backdrop-filter:blur(6px);display:flex;align-items:center;justify-content:center;padding:1.5rem;">
            <div style="background:#fff;border-radius:20px;max-width:560px;width:100%;box-shadow:0 25px 60px rgba(0,0,0,0.3);overflow:hidden;animation:ndBankSlideIn 0.3s ease;">
                {{-- Header --}}
                <div style="background:linear-gradient(135deg,#1E3A5F 0%,#2B6B96 100%);padding:1.75rem 2rem;color:#fff;text-align:center;">
                    <div style="width:56px;height:56px;border-radius:16px;background:rgba(255,255,255,0.15);display:inline-flex;align-items:center;justify-content:center;margin-bottom:0.75rem;">
                        <i class="fas fa-university" style="font-size:1.5rem;"></i>
                    </div>
                    <h3 style="margin:0;font-size:1.3rem;font-weight:700;">Select Your Village Bank</h3>
                    <p style="margin:0.5rem 0 0;font-size:0.88rem;opacity:0.8;">Choose the village bank you want to work in</p>
                </div>

                {{-- Bank List --}}
                <div style="padding:1.5rem 2rem;max-height:400px;overflow-y:auto;">
                    @if($banks->count())
                        <div style="display:flex;flex-direction:column;gap:0.75rem;">
                            @foreach($banks as $bank)
                                <button wire:click="selectBank({{ $bank->id }})"
                                    style="display:flex;align-items:center;gap:1rem;padding:1rem 1.25rem;border-radius:12px;border:2px solid {{ $selectedBankId == $bank->id ? '#D97706' : '#e2e8f0' }};background:{{ $selectedBankId == $bank->id ? '#fffbeb' : '#fff' }};cursor:pointer;transition:all 0.2s;text-align:left;width:100%;"
                                    onmouseover="this.style.borderColor='#D97706';this.style.boxShadow='0 4px 12px rgba(217,119,6,0.12)'"
                                    onmouseout="this.style.borderColor='{{ $selectedBankId == $bank->id ? '#D97706' : '#e2e8f0' }}';this.style.boxShadow='none'">
                                    <div style="width:44px;height:44px;border-radius:12px;background:linear-gradient(135deg,#1E3A5F,#2B6B96);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                        @if($bank->logo)
                                            <img src="{{ asset('storage/' . $bank->logo) }}" alt="" style="width:100%;height:100%;object-fit:cover;border-radius:12px;">
                                        @else
                                            <i class="fas fa-university" style="color:#fff;font-size:1.1rem;"></i>
                                        @endif
                                    </div>
                                    <div style="flex:1;overflow:hidden;">
                                        <div style="font-weight:700;font-size:0.95rem;color:#1e293b;">{{ $bank->name }}</div>
                                        <div style="font-size:0.8rem;color:#64748b;display:flex;align-items:center;gap:0.75rem;margin-top:2px;">
                                            @if($bank->code)
                                                <span><i class="fas fa-tag" style="font-size:0.65rem;"></i> {{ $bank->code }}</span>
                                            @endif
                                            <span><i class="fas fa-users" style="font-size:0.65rem;"></i> {{ $bank->members()->count() }} members</span>
                                            @if($bank->pivot && $bank->pivot->role === 'admin')
                                                <span style="background:#dcfce7;color:#16a34a;padding:1px 8px;border-radius:10px;font-size:0.7rem;font-weight:600;">Admin</span>
                                            @endif
                                        </div>
                                    </div>
                                    @if($selectedBankId == $bank->id)
                                        <i class="fas fa-check-circle" style="color:#D97706;font-size:1.2rem;"></i>
                                    @else
                                        <i class="fas fa-chevron-right" style="color:#cbd5e1;font-size:0.9rem;"></i>
                                    @endif
                                </button>
                            @endforeach
                        </div>
                    @else
                        <div style="text-align:center;padding:2rem 1rem;color:#64748b;">
                            <i class="fas fa-exclamation-circle" style="font-size:2.5rem;margin-bottom:1rem;display:block;opacity:0.4;"></i>
                            <p style="font-weight:600;margin-bottom:0.25rem;">No Village Banks Found</p>
                            <p style="font-size:0.85rem;">You are not assigned to any village bank yet. Contact your administrator.</p>
                        </div>
                    @endif
                </div>

                {{-- Footer hint --}}
                @if($banks->count() > 1)
                    <div style="padding:0.75rem 2rem 1.25rem;text-align:center;">
                        <small style="color:#94a3b8;font-size:0.8rem;">
                            <i class="fas fa-info-circle"></i> You can switch banks anytime from the top navigation bar
                        </small>
                    </div>
                @endif
            </div>
        </div>

        <style>
            @keyframes ndBankSlideIn {
                from { opacity: 0; transform: translateY(20px) scale(0.97); }
                to   { opacity: 1; transform: translateY(0) scale(1); }
            }
        </style>
    @endif
</div>
