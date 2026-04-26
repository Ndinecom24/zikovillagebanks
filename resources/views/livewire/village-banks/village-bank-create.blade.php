<div>
@push('custom-styles')
<style>
    :root {
        --vc-navy:#1E3A5F;--vc-navy-light:#2B6B96;--vc-amber:#D97706;--vc-amber-light:#F59E0B;
        --vc-bg:#f4f6fa;--vc-card:#fff;--vc-border:#edf0f7;--vc-text:#1e293b;
        --vc-muted:#64748b;--vc-faint:#94a3b8;--vc-green:#16a34a;--vc-red:#dc2626;--vc-radius:16px;
    }
    .vc-page{background:var(--vc-bg);min-height:100vh;}

    /* ─── Hero ─── */
    .vc-hero{background:linear-gradient(135deg,var(--vc-navy) 0%,#234b78 50%,var(--vc-navy-light) 100%);padding:1.75rem 0 7rem;position:relative;overflow:hidden;}
    .vc-hero::before{content:'';position:absolute;width:700px;height:700px;top:-60%;right:-10%;background:radial-gradient(circle,rgba(217,119,6,.12) 0%,transparent 70%);border-radius:50%;pointer-events:none;}
    .vc-hero::after{content:'';position:absolute;width:400px;height:400px;bottom:-40%;left:-5%;background:radial-gradient(circle,rgba(43,107,150,.15) 0%,transparent 70%);border-radius:50%;pointer-events:none;}
    .vc-hero-inner{position:relative;z-index:2;padding:0 1.5rem;}
    .vc-breadcrumb{display:flex;gap:.5rem;list-style:none;padding:0;margin:0 0 .75rem;font-size:.82rem;}
    .vc-breadcrumb a{color:rgba(255,255,255,.55);text-decoration:none;}
    .vc-breadcrumb a:hover{color:rgba(255,255,255,.85);}
    .vc-breadcrumb .active{color:var(--vc-amber-light);font-weight:600;}
    .vc-breadcrumb .sep{color:rgba(255,255,255,.25);}
    .vc-hero-row{display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:.75rem;}
    .vc-hero-title h1{color:#fff;font-size:1.6rem;font-weight:800;margin:0;}
    .vc-hero-title h1 i{color:var(--vc-amber);margin-right:.5rem;}
    .vc-hero-sub{color:rgba(255,255,255,.55);font-size:.88rem;margin:.25rem 0 0;}
    .vc-hero-btn{padding:.55rem 1.25rem;border-radius:10px;font-size:.84rem;font-weight:700;border:1px solid rgba(255,255,255,.2);cursor:pointer;display:inline-flex;align-items:center;gap:.4rem;transition:all .2s;background:rgba(255,255,255,.08);color:#fff;text-decoration:none;}
    .vc-hero-btn:hover{background:rgba(255,255,255,.15);color:#fff;text-decoration:none;}

    /* ─── Content ─── */
    .vc-content{margin-top:-4.5rem;position:relative;z-index:10;padding:0 1.5rem 2rem;}

    /* ─── Card ─── */
    .vc-card{background:var(--vc-card);border-radius:var(--vc-radius);border:1px solid var(--vc-border);box-shadow:0 2px 12px rgba(0,0,0,.04);overflow:hidden;}
    .vc-card-header{padding:1rem 1.25rem;border-bottom:1px solid var(--vc-border);display:flex;align-items:center;gap:.5rem;}
    .vc-card-header h3{font-size:1rem;font-weight:800;color:var(--vc-text);margin:0;display:flex;align-items:center;gap:.5rem;}
    .vc-card-header h3 i{color:var(--vc-amber);font-size:.9rem;}
    .vc-card-body{padding:1.5rem 1.25rem;}
    .vc-card-footer{padding:.85rem 1.25rem;border-top:1px solid var(--vc-border);display:flex;justify-content:flex-end;gap:.65rem;}

    /* ─── Form ─── */
    .vc-label{display:block;font-size:.75rem;font-weight:700;color:var(--vc-muted);text-transform:uppercase;letter-spacing:.4px;margin-bottom:.35rem;}
    .vc-label .req{color:var(--vc-red);font-weight:800;}
    .vc-input{width:100%;padding:.55rem .85rem;border:1px solid var(--vc-border);border-radius:10px;font-size:.86rem;color:var(--vc-text);background:var(--vc-card);transition:all .2s;}
    .vc-input:focus{outline:none;border-color:var(--vc-amber);box-shadow:0 0 0 3px rgba(217,119,6,.1);}
    .vc-input::placeholder{color:var(--vc-faint);}
    .vc-error{font-size:.76rem;color:var(--vc-red);margin-top:.25rem;}
    .vc-row{display:grid;gap:1rem;margin-bottom:1.15rem;}
    .vc-row-2{grid-template-columns:1fr 1fr;}
    .vc-row-8-4{grid-template-columns:2fr 1fr;}
    @media(max-width:768px){.vc-row-2,.vc-row-8-4{grid-template-columns:1fr;}}
    .vc-field{margin-bottom:0;}
    .vc-file-zone{border:2px dashed var(--vc-border);border-radius:12px;padding:1.25rem;text-align:center;transition:all .2s;cursor:pointer;background:#fafbfd;}
    .vc-file-zone:hover{border-color:var(--vc-amber);background:#fffbeb;}
    .vc-file-zone input[type="file"]{opacity:0;width:100%;height:100%;position:absolute;inset:0;cursor:pointer;}
    .vc-file-icon{width:42px;height:42px;border-radius:50%;background:rgba(217,119,6,.08);display:flex;align-items:center;justify-content:center;margin:0 auto .5rem;color:var(--vc-amber);font-size:1rem;}

    /* ─── Buttons ─── */
    .vc-btn-save{padding:.55rem 1.35rem;border-radius:10px;border:none;background:var(--vc-amber);color:#fff;font-size:.84rem;font-weight:700;cursor:pointer;transition:all .2s;display:inline-flex;align-items:center;gap:.4rem;}
    .vc-btn-save:hover{background:var(--vc-amber-light);transform:translateY(-1px);}
    .vc-btn-save:disabled{opacity:.6;cursor:not-allowed;transform:none;}
    .vc-btn-reset{padding:.55rem 1.15rem;border-radius:10px;border:1px solid var(--vc-border);background:var(--vc-card);font-size:.84rem;font-weight:600;cursor:pointer;color:var(--vc-muted);transition:all .2s;}
    .vc-btn-reset:hover{background:#f8fafc;border-color:var(--vc-muted);}

    /* ─── Alert ─── */
    .vc-alert{padding:.65rem 1rem;border-radius:12px;font-size:.85rem;display:flex;align-items:center;gap:.5rem;margin-bottom:1rem;}
    .vc-alert-success{background:#f0fdf4;border:1px solid #bbf7d0;color:#166534;}
    .vc-alert-error{background:#fef2f2;border:1px solid #fecaca;color:#991b1b;}

    /* ─── Info panel ─── */
    .vc-info-item{display:flex;align-items:flex-start;gap:.65rem;padding:.55rem 0;border-bottom:1px solid var(--vc-border);font-size:.84rem;color:var(--vc-muted);}
    .vc-info-item:last-child{border-bottom:none;}
    .vc-info-icon{width:22px;height:22px;border-radius:6px;background:rgba(22,163,74,.08);color:var(--vc-green);display:flex;align-items:center;justify-content:center;font-size:.6rem;flex-shrink:0;margin-top:.1rem;}

    /* ─── Upload preview ─── */
    .vc-upload-loading{display:flex;align-items:center;gap:.4rem;font-size:.8rem;color:var(--vc-muted);margin-top:.5rem;}
</style>
@endpush

@can('manage-village-banks')
<div class="vc-page">
    {{-- ═══ Hero ═══ --}}
    <div class="vc-hero">
        <div class="vc-hero-inner">
            <ul class="vc-breadcrumb">
                <li><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="sep">/</li>
                <li><a href="{{ route('village-banks.index') }}">Village Banks</a></li>
                <li class="sep">/</li>
                <li class="active">{{ $editId ? 'Edit' : 'Create' }}</li>
            </ul>
            <div class="vc-hero-row">
                <div class="vc-hero-title">
                    <h1><i class="fas fa-{{ $editId ? 'edit' : 'plus-circle' }}"></i>{{ $editId ? 'Edit' : 'Create' }} Village Bank</h1>
                    <p class="vc-hero-sub">{{ $editId ? 'Update village bank details and settings' : 'Register a new village banking organisation' }}</p>
                </div>
                <a href="{{ route('village-banks.index') }}" class="vc-hero-btn">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>

    {{-- ═══ Content ═══ --}}
    <div class="vc-content">

        @if ($successMessage)
            <div class="vc-alert vc-alert-success">
                <i class="fas fa-check-circle"></i> {{ $successMessage }}
            </div>
        @endif

        <div style="display:grid;grid-template-columns:1fr 380px;gap:1.25rem;align-items:start;">
            {{-- Main Form --}}
            <div class="vc-card">
                <div class="vc-card-header">
                    <h3><i class="fas fa-building"></i> Bank Details</h3>
                </div>
                <form wire:submit.prevent="save">
                    <div class="vc-card-body">
                        @if ($errors->any())
                            <div class="vc-alert vc-alert-error">
                                <i class="fas fa-exclamation-circle"></i> Please fix the errors below.
                            </div>
                        @endif

                        {{-- Name & Code --}}
                        <div class="vc-row vc-row-8-4">
                            <div class="vc-field">
                                <label class="vc-label">Bank Name <span class="req">*</span></label>
                                <input type="text" wire:model="name" class="vc-input" placeholder="e.g. Kafue Road Village Bank">
                                @error('name') <div class="vc-error">{{ $message }}</div> @enderror
                            </div>
                            <div class="vc-field">
                                <label class="vc-label">Code <span class="req">*</span></label>
                                <input type="text" wire:model="code" class="vc-input" placeholder="e.g. KRVB" maxlength="20" style="text-transform:uppercase;">
                                @error('code') <div class="vc-error">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        {{-- Description --}}
                        <div style="margin-bottom:1.15rem;">
                            <label class="vc-label">Description</label>
                            <textarea wire:model="description" class="vc-input" rows="3" placeholder="Brief description of the village bank..."></textarea>
                            @error('description') <div class="vc-error">{{ $message }}</div> @enderror
                        </div>

                        {{-- Contact --}}
                        <div class="vc-row vc-row-2">
                            <div class="vc-field">
                                <label class="vc-label">Email</label>
                                <input type="email" wire:model="email" class="vc-input" placeholder="bank@example.com">
                                @error('email') <div class="vc-error">{{ $message }}</div> @enderror
                            </div>
                            <div class="vc-field">
                                <label class="vc-label">Phone</label>
                                <input type="text" wire:model="phone" class="vc-input" placeholder="+260 97X XXX XXX">
                                @error('phone') <div class="vc-error">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        {{-- Address --}}
                        <div style="margin-bottom:1.15rem;">
                            <label class="vc-label">Address</label>
                            <input type="text" wire:model="address" class="vc-input" placeholder="Physical address">
                            @error('address') <div class="vc-error">{{ $message }}</div> @enderror
                        </div>

                        {{-- Logo --}}
                        <div>
                            <label class="vc-label">Logo <span style="font-weight:400;text-transform:none;letter-spacing:0;color:var(--vc-faint);">(optional, max 2 MB)</span></label>
                            <div class="vc-file-zone" style="position:relative;">
                                <input type="file" wire:model="logo" accept="image/*">
                                <div class="vc-file-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                <div style="font-size:.82rem;color:var(--vc-muted);">Click or drag to upload logo</div>
                                <div style="font-size:.72rem;color:var(--vc-faint);margin-top:.2rem;">PNG, JPG, SVG up to 2 MB</div>
                            </div>
                            @error('logo') <div class="vc-error">{{ $message }}</div> @enderror
                            <div wire:loading wire:target="logo" class="vc-upload-loading">
                                <i class="fas fa-spinner fa-spin"></i> Uploading...
                            </div>
                        </div>
                    </div>

                    <div class="vc-card-footer">
                        @if (!$editId)
                            <button type="button" wire:click="resetForm" class="vc-btn-reset">
                                <i class="fas fa-redo" style="margin-right:.3rem;font-size:.72rem;"></i> Reset
                            </button>
                        @endif
                        <button type="submit" class="vc-btn-save" wire:loading.attr="disabled" wire:target="save">
                            <span wire:loading.remove wire:target="save"><i class="fas fa-save"></i> {{ $editId ? 'Update' : 'Create' }} Bank</span>
                            <span wire:loading wire:target="save"><i class="fas fa-spinner fa-spin"></i> Saving...</span>
                        </button>
                    </div>
                </form>
            </div>

            {{-- Sidebar --}}
            <div style="display:flex;flex-direction:column;gap:1.25rem;">
                <div class="vc-card">
                    <div class="vc-card-header">
                        <h3><i class="fas fa-info-circle"></i> About Village Banks</h3>
                    </div>
                    <div class="vc-card-body" style="padding:1rem 1.25rem;">
                        <div class="vc-info-item"><div class="vc-info-icon"><i class="fas fa-check"></i></div><span>Each village bank is an independent organisation</span></div>
                        <div class="vc-info-item"><div class="vc-info-icon"><i class="fas fa-check"></i></div><span>Banks have their own circles, members & rules</span></div>
                        <div class="vc-info-item"><div class="vc-info-icon"><i class="fas fa-check"></i></div><span>Members can belong to multiple banks</span></div>
                        <div class="vc-info-item"><div class="vc-info-icon"><i class="fas fa-check"></i></div><span>Admins manage their bank's operations</span></div>
                        <div class="vc-info-item"><div class="vc-info-icon"><i class="fas fa-check"></i></div><span>Each bank has separate financial reports</span></div>
                        <div class="vc-info-item"><div class="vc-info-icon"><i class="fas fa-check"></i></div><span>Code must be unique (used as identifier)</span></div>
                    </div>
                </div>

                {{-- Quick tips --}}
                <div class="vc-card">
                    <div class="vc-card-header">
                        <h3><i class="fas fa-lightbulb"></i> Tips</h3>
                    </div>
                    <div class="vc-card-body" style="padding:1rem 1.25rem;font-size:.82rem;color:var(--vc-muted);line-height:1.65;">
                        <p style="margin:0 0 .65rem;"><strong style="color:var(--vc-text);">Bank Code</strong> — Use a short, memorable abbreviation. This cannot be changed easily once members start joining.</p>
                        <p style="margin:0 0 .65rem;"><strong style="color:var(--vc-text);">Logo</strong> — Square images (1:1 ratio) work best. The logo appears on reports and member dashboards.</p>
                        <p style="margin:0;"><strong style="color:var(--vc-text);">After creation</strong> — You'll be automatically added as the bank's first admin. You can invite more members from the bank's detail page.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
    @include('livewire.partials.unauthorized')
@endcan
</div>
