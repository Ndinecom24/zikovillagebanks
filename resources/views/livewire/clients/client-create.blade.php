<div>
    <section class="content py-3 px-3">
        {{-- ===== Page Header ===== --}}
        <div class="z-page-header mb-3">
            <div class="d-flex align-items-center justify-content-between flex-wrap">
                <div>
                    <h1><i class="fas fa-user-plus"></i> New Client</h1>
                    <p>Register a new client profile and upload documents</p>
                </div>
                <a href="{{ route('clients.index') }}" class="btn btn-sm" style="background: rgba(255,255,255,0.15); color: #fff; border-radius: 8px; font-weight: 600; padding: 0.4rem 1rem; font-size: 0.82rem;">
                    <i class="fas fa-arrow-left mr-1"></i> Back to Clients
                </a>
            </div>
        </div>

        {{-- ===== Flash Messages ===== --}}
        @if(session()->has('message'))
            <div class="z-alert-success alert alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-2"></i> {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert" style="border-radius: 10px; border-left: 4px solid #f6993f;">
                <i class="fas fa-exclamation-triangle mr-2" style="color: #f6993f;"></i> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger" style="border-radius: 10px; border-left: 4px solid #e3342f;">
                <i class="fas fa-times-circle mr-2"></i> <strong>Please fix the following errors:</strong>
                <ul class="mb-0 mt-1 pl-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form wire:submit.prevent="createClient" enctype="multipart/form-data">
            <div class="row">
                {{-- LEFT — Client Details --}}
                <div class="col-lg-8 col-md-7">
                    <div class="card z-card">
                        <div class="card-header d-flex align-items-center py-2" style="gap: 0.5rem;">
                            <div style="width: 28px; height: 28px; border-radius: 8px; background: linear-gradient(135deg, var(--z-green), var(--z-green-dark)); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-building" style="color: #fff; font-size: 0.7rem;"></i>
                            </div>
                            <h3 class="mb-0" style="font-size: 0.9rem; font-weight: 600;">Company Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label style="font-size: 0.8rem; font-weight: 600; color: #374151;">Company Name <span style="color: #e3342f;">*</span></label>
                                    <input class="form-control @error('company_name') is-invalid @enderror" wire:model="company_name" placeholder="Enter company name" required
                                           style="border-radius: 8px; border: 1.5px solid #e2e8f0; padding: 0.55rem 0.85rem; font-size: 0.85rem;">
                                    @error('company_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label style="font-size: 0.8rem; font-weight: 600; color: #374151;">TPIN # <span style="color: #e3342f;">*</span></label>
                                    <input type="number" class="form-control @error('tpin') is-invalid @enderror" wire:model="tpin" placeholder="e.g. 1234567890" required
                                           style="border-radius: 8px; border: 1.5px solid #e2e8f0; padding: 0.55rem 0.85rem; font-size: 0.85rem;">
                                    @error('tpin') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label style="font-size: 0.8rem; font-weight: 600; color: #374151;">Phone # <span style="color: #e3342f;">*</span></label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" wire:model="phone" placeholder="+260 9XX XXX XXX" required
                                           style="border-radius: 8px; border: 1.5px solid #e2e8f0; padding: 0.55rem 0.85rem; font-size: 0.85rem;">
                                    @error('phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label style="font-size: 0.8rem; font-weight: 600; color: #374151;">Email <span style="color: #e3342f;">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model="email" placeholder="company@example.com" required
                                           style="border-radius: 8px; border: 1.5px solid #e2e8f0; padding: 0.55rem 0.85rem; font-size: 0.85rem;">
                                    @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group col-md-8">
                                    <label style="font-size: 0.8rem; font-weight: 600; color: #374151;">Address</label>
                                    <textarea class="form-control" wire:model="address_line_1" rows="1" placeholder="Street address, P.O. Box..."
                                              style="border-radius: 8px; border: 1.5px solid #e2e8f0; padding: 0.55rem 0.85rem; font-size: 0.85rem;"></textarea>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label style="font-size: 0.8rem; font-weight: 600; color: #374151;">Country <span style="color: #e3342f;">*</span></label>
                                    <input type="text" class="form-control" wire:model="country" placeholder="e.g. Zambia" required
                                           style="border-radius: 8px; border: 1.5px solid #e2e8f0; padding: 0.55rem 0.85rem; font-size: 0.85rem;">
                                </div>
                                <div class="form-group col-md-4">
                                    <label style="font-size: 0.8rem; font-weight: 600; color: #374151;">City <span style="color: #e3342f;">*</span></label>
                                    <input type="text" class="form-control" wire:model="city" placeholder="e.g. Lusaka" required
                                           style="border-radius: 8px; border: 1.5px solid #e2e8f0; padding: 0.55rem 0.85rem; font-size: 0.85rem;">
                                </div>
                                <div class="form-group col-md-4">
                                    <label style="font-size: 0.8rem; font-weight: 600; color: #374151;">Province <span style="color: #e3342f;">*</span></label>
                                    <input type="text" class="form-control" wire:model="province" placeholder="e.g. Lusaka" required
                                           style="border-radius: 8px; border: 1.5px solid #e2e8f0; padding: 0.55rem 0.85rem; font-size: 0.85rem;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT — Status & Quick Actions --}}
                <div class="col-lg-4 col-md-5">
                    <div class="card z-card">
                        <div class="card-header d-flex align-items-center py-2" style="gap: 0.5rem;">
                            <div style="width: 28px; height: 28px; border-radius: 8px; background: linear-gradient(135deg, var(--z-orange), var(--z-orange-dark)); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-sliders-h" style="color: #fff; font-size: 0.7rem;"></i>
                            </div>
                            <h3 class="mb-0" style="font-size: 0.9rem; font-weight: 600;">Client Status</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label style="font-size: 0.8rem; font-weight: 600; color: #374151;">Is Client Active?</label>
                                <select class="form-control" wire:model="is_active"
                                        style="border-radius: 8px; border: 1.5px solid #e2e8f0; padding: 0.55rem 0.85rem; font-size: 0.85rem;">
                                    <option value="">-- Select --</option>
                                    <option value="1">Yes — Active</option>
                                    <option value="0">No — Inactive</option>
                                </select>
                            </div>

                            <div style="background: #f8fafc; border-radius: 10px; padding: 1rem; margin-top: 1rem;">
                                <div style="font-size: 0.75rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Required Fields</div>
                                <div style="font-size: 0.78rem; color: #374151; line-height: 1.8;">
                                    <div><i class="fas fa-check-circle mr-1" style="color: var(--z-green); font-size: 0.7rem;"></i> Company Name</div>
                                    <div><i class="fas fa-check-circle mr-1" style="color: var(--z-green); font-size: 0.7rem;"></i> TPIN Number</div>
                                    <div><i class="fas fa-check-circle mr-1" style="color: var(--z-green); font-size: 0.7rem;"></i> Phone & Email</div>
                                    <div><i class="fas fa-check-circle mr-1" style="color: var(--z-green); font-size: 0.7rem;"></i> Country, City & Province</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== Documents Section (Full Width) ===== --}}
            <div class="card z-card">
                <div class="card-header d-flex align-items-center justify-content-between py-2">
                    <div class="d-flex align-items-center" style="gap: 0.5rem;">
                        <div style="width: 28px; height: 28px; border-radius: 8px; background: linear-gradient(135deg, #3490dc, #2779bd); display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-paperclip" style="color: #fff; font-size: 0.7rem;"></i>
                        </div>
                        <h3 class="mb-0" style="font-size: 0.9rem; font-weight: 600;">Client Documents</h3>
                    </div>
                    <button type="button" class="btn btn-sm" wire:click="addRow"
                            style="background: rgba(56,193,114,0.1); color: var(--z-green-dark); border-radius: 6px; font-size: 0.78rem; font-weight: 600; padding: 0.3rem 0.7rem;">
                        <i class="fas fa-plus mr-1"></i> Add Document
                    </button>
                </div>
                <div class="card-body">
                    @foreach($documents as $index => $doc)
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 0.85rem 1rem; margin-bottom: 0.6rem; transition: all 0.15s;"
                             onmouseover="this.style.borderColor='var(--z-green)'" onmouseout="this.style.borderColor='#e2e8f0'">
                            <div class="form-row align-items-center">
                                <div class="form-group col-md-4 mb-0">
                                    <label style="font-size: 0.72rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.04em;">Document Type</label>
                                    <select class="form-control" wire:model="documents.{{ $index }}.filetype"
                                            style="border-radius: 8px; border: 1.5px solid #e2e8f0; padding: 0.45rem 0.75rem; font-size: 0.82rem;">
                                        <option value="">-- Select Type --</option>
                                        <option value="ZRA Tax Certificate">ZRA Tax Certificate</option>
                                        <option value="Pacra Company Certificate">PACRA Certificate</option>
                                        <option value="Feasibility Study Rights">Feasibility Study</option>
                                        <option value="Grid Connection Certificate">Grid Connection Certificate</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 mb-0">
                                    <label style="font-size: 0.72rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.04em;">Upload File</label>
                                    <input type="file" class="form-control" wire:model="documents.{{ $index }}.file"
                                           style="border-radius: 8px; border: 1.5px solid #e2e8f0; padding: 0.35rem 0.75rem; font-size: 0.82rem;">
                                </div>
                                <div class="form-group col-md-2 mb-0 d-flex align-items-end justify-content-end">
                                    @if(count($documents) > 1)
                                        <button type="button" wire:click="removeRow({{ $index }})"
                                                class="btn btn-sm"
                                                style="background: rgba(227,52,47,0.08); color: #dc2626; border-radius: 6px; font-size: 0.78rem; font-weight: 600; padding: 0.35rem 0.7rem;">
                                            <i class="fas fa-trash-alt mr-1"></i> Remove
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @if(empty($documents))
                        <div class="text-center py-3" style="color: #94a3b8;">
                            <i class="fas fa-file-upload fa-2x d-block mb-2"></i>
                            <span style="font-size: 0.85rem;">No documents added yet. Click "Add Document" to attach files.</span>
                        </div>
                    @endif
                </div>
            </div>

            {{-- ===== Submit ===== --}}
            <div class="text-center mb-4">
                <button type="submit"
                        class="btn px-5 py-2"
                        style="background: linear-gradient(135deg, var(--z-green), var(--z-green-dark)); color: #fff; border: none; border-radius: 10px; font-size: 0.92rem; font-weight: 600; box-shadow: 0 4px 12px rgba(56,193,114,0.35); transition: all 0.2s;"
                        onmouseover="this.style.boxShadow='0 6px 20px rgba(56,193,114,0.45)'; this.style.transform='translateY(-1px)';"
                        onmouseout="this.style.boxShadow='0 4px 12px rgba(56,193,114,0.35)'; this.style.transform='translateY(0)';">
                    <i class="fas fa-check-circle mr-1"></i> Create Client
                    <div wire:loading wire:target="createClient" class="spinner-border spinner-border-sm ml-2"></div>
                </button>
                <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary ml-2 px-4 py-2" style="border-radius: 10px; font-size: 0.92rem;">
                    Cancel
                </a>
            </div>
        </form>
    </section>
</div>



