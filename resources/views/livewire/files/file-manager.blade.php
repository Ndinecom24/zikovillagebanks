<div>
    <section class="content py-3 px-3">
        {{-- ===== Page Header ===== --}}
        <div class="z-page-header mb-3">
            <h1><i class="fas fa-folder-open"></i> File Manager</h1>
            <p>Manage all uploaded documents across the system</p>
        </div>

        {{-- ===== Flash Message ===== --}}
        @if(session()->has('message'))
            <div class="z-alert-success alert alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-2"></i> {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            </div>
        @endif

        {{-- ===== Stat Cards ===== --}}
        <div class="row mb-3">
            <div class="col-lg-3 col-md-6 mb-2">
                <div class="z-stat-card z-stat-green">
                    <div class="stat-icon"><i class="fas fa-file"></i></div>
                    <div>
                        <div class="stat-value">{{ number_format($stats['totalFiles']) }}</div>
                        <div class="stat-label">Total Files</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-2">
                <div class="z-stat-card z-stat-gold">
                    <div class="stat-icon"><i class="fas fa-database"></i></div>
                    <div>
                        <div class="stat-value">{{ number_format($stats['totalSizeMB'], 1) }} MB</div>
                        <div class="stat-label">Total Storage</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-2">
                <div class="z-stat-card z-stat-blue">
                    <div class="stat-icon"><i class="fas fa-tags"></i></div>
                    <div>
                        <div class="stat-value">{{ $stats['uniqueTypes'] }}</div>
                        <div class="stat-label">File Categories</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-2">
                <div class="z-stat-card z-stat-purple">
                    <div class="stat-icon"><i class="fas fa-clock"></i></div>
                    <div>
                        <div class="stat-value">{{ $stats['recentUploads'] }}</div>
                        <div class="stat-label">Last 7 Days</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== Main Card ===== --}}
        <div class="card z-card">
            <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="gap: 0.75rem;">
                <h3 class="mb-0"><i class="fas fa-list mr-1"></i> All Files
                    <span class="z-count">{{ $files->total() }}</span>
                </h3>
                <button wire:click="openUploadModal" class="btn-zesco">
                    <i class="fas fa-cloud-upload-alt mr-1"></i> Upload Files
                </button>
            </div>

            <div class="card-body">
                {{-- Filters --}}
                <div class="d-flex flex-wrap align-items-center mb-3" style="gap: 0.75rem;">
                    <div class="z-search" style="flex: 1; min-width: 200px; max-width: 320px;">
                        <i class="fas fa-search si"></i>
                        <input type="text" wire:model.debounce.300ms="search" placeholder="Search files...">
                    </div>
                    <select wire:model="filterType" class="form-control z-filter-select" style="max-width: 180px;">
                        <option value="">All Types</option>
                        @foreach($fileTypes as $type)
                            <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                    <select wire:model="filterExt" class="form-control z-filter-select" style="max-width: 150px;">
                        <option value="">All Formats</option>
                        @foreach($fileExtensions as $ext)
                            <option value="{{ $ext }}">{{ strtoupper($ext) }}</option>
                        @endforeach
                    </select>
                    <select wire:model="perPage" class="form-control z-per-page">
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    @if($search || $filterType || $filterExt)
                        <button wire:click="clearFilters" class="btn btn-sm btn-outline-secondary" style="border-radius: 6px;">
                            <i class="fas fa-times mr-1"></i> Clear
                        </button>
                    @endif
                </div>

                {{-- Table --}}
                <div class="table-responsive">
                    <table class="table z-table mb-0">
                        <thead>
                            <tr>
                                <th style="width: 40px;">#</th>
                                <th wire:click="sortBy('name')" style="min-width: 280px;">
                                    File Name
                                    <i class="fas fa-sort sort-icon {{ $sortField === 'name' ? 'active' : '' }}"></i>
                                </th>
                                <th wire:click="sortBy('type')">
                                    Type
                                    <i class="fas fa-sort sort-icon {{ $sortField === 'type' ? 'active' : '' }}"></i>
                                </th>
                                <th wire:click="sortBy('ext')">
                                    Format
                                    <i class="fas fa-sort sort-icon {{ $sortField === 'ext' ? 'active' : '' }}"></i>
                                </th>
                                <th wire:click="sortBy('size')">
                                    Size
                                    <i class="fas fa-sort sort-icon {{ $sortField === 'size' ? 'active' : '' }}"></i>
                                </th>
                                <th>IPP</th>
                                <th wire:click="sortBy('created_at')">
                                    Uploaded
                                    <i class="fas fa-sort sort-icon {{ $sortField === 'created_at' ? 'active' : '' }}"></i>
                                </th>
                                <th style="width: 130px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($files as $idx => $file)
                                <tr>
                                    <td style="color: #94a3b8;">{{ $files->firstItem() + $idx }}</td>
                                    <td>
                                        <div class="d-flex align-items-center" style="gap: 0.6rem;">
                                            <div style="width: 36px; height: 36px; border-radius: 8px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                <i class="fas {{ $file->icon_class }}"></i>
                                            </div>
                                            <div style="min-width: 0;">
                                                <div style="font-weight: 600; color: #1a2332; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 250px;" title="{{ $file->display_name }}">
                                                    {{ $file->display_name }}
                                                </div>
                                                @if($file->description)
                                                    <div style="font-size: 0.72rem; color: #94a3b8; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 250px;">
                                                        {{ $file->description }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="z-badge">{{ ucfirst($file->type ?? 'N/A') }}</span>
                                    </td>
                                    <td>
                                        <span class="z-badge-purple" style="font-size: 0.72rem;">{{ strtoupper($file->ext ?? '—') }}</span>
                                    </td>
                                    <td style="font-size: 0.82rem; color: #6b7280;">{{ $file->human_size }}</td>
                                    <td>
                                        @php
                                            $ipp = \App\Models\IndependentProducer::find($file->model_id);
                                        @endphp
                                        @if($ipp)
                                            <a href="{{ route('independent-producer.show', $ipp->id) }}" style="font-size: 0.8rem; color: var(--z-green); text-decoration: none; font-weight: 600;" title="{{ $ipp->name_of_ipp }}">
                                                {{ Str::limit($ipp->name_of_ipp ?? $ipp->system_ref, 20) }}
                                            </a>
                                        @else
                                            <span style="font-size: 0.8rem; color: #94a3b8;">—</span>
                                        @endif
                                    </td>
                                    <td style="font-size: 0.78rem; color: #6b7280;">
                                        {{ $file->created_at ? $file->created_at->format('M d, Y') : '—' }}
                                        @if($file->uploader)
                                            <div style="font-size: 0.7rem; color: #94a3b8;">by {{ $file->uploader->name }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex" style="gap: 4px;">
                                            <button wire:click="viewFile({{ $file->id }})" class="z-action z-action-view" title="Details">
                                                <span wire:loading wire:target="viewFile({{ $file->id }})" class="spinner-border spinner-border-sm" role="status"></span>
                                                <i wire:loading.remove wire:target="viewFile({{ $file->id }})" class="fas fa-eye"></i>
                                            </button>
                                            <a href="{{ $file->download_url }}" target="_blank" class="z-action z-action-edit" title="Download" style="text-decoration: none;">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            <button wire:click="confirmDelete({{ $file->id }})" class="z-action z-action-delete" title="Delete">
                                                <span wire:loading wire:target="confirmDelete({{ $file->id }})" class="spinner-border spinner-border-sm" role="status"></span>
                                                <i wire:loading.remove wire:target="confirmDelete({{ $file->id }})" class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4" style="color: #94a3b8;">
                                        <i class="fas fa-folder-open fa-2x d-block mb-2"></i>
                                        No files found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($files->hasPages())
                    <div class="d-flex justify-content-center mt-3">
                        {{ $files->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- ===== UPLOAD MODAL ===== --}}
    @if($showUploadModal)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-lg">
                <div class="modal-content z-modal">
                    <div class="modal-header modal-header-zesco">
                        <h5><i class="fas fa-cloud-upload-alt mr-2"></i> Upload Files</h5>
                        <button wire:click="closeUploadModal" type="button" class="close text-white"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        {{-- IPP Selection --}}
                        <div class="form-group mb-3">
                            <label class="z-label">Attach to IPP <span class="text-danger">*</span></label>
                            <select wire:model="uploadModelId" class="form-control z-input">
                                <option value="">-- Select an IPP --</option>
                                @foreach($producers as $p)
                                    <option value="{{ $p['id'] }}">{{ $p['system_ref'] }} — {{ $p['name_of_ipp'] }}</option>
                                @endforeach
                            </select>
                            @error('uploadModelId') <span class="text-danger" style="font-size: 0.78rem;">{{ $message }}</span> @enderror
                        </div>

                        {{-- File Type --}}
                        <div class="form-group mb-3">
                            <label class="z-label">Document Category <span class="text-danger">*</span></label>
                            <select wire:model="uploadType" class="form-control z-input">
                                <option value="contracts">Contracts</option>
                                <option value="proposals">Proposals</option>
                                <option value="permits">Permits & Licenses</option>
                                <option value="correspondence">Correspondence</option>
                                <option value="technical">Technical Documents</option>
                                <option value="financial">Financial Documents</option>
                                <option value="environmental">Environmental Reports</option>
                                <option value="other">Other</option>
                            </select>
                            @error('uploadType') <span class="text-danger" style="font-size: 0.78rem;">{{ $message }}</span> @enderror
                        </div>

                        {{-- File Input --}}
                        <div class="form-group mb-3">
                            <label class="z-label">Select Files <span class="text-danger">*</span></label>
                            <div style="border: 2px dashed #e2e8f0; border-radius: 12px; padding: 2rem; text-align: center; transition: border-color 0.2s; background: #fafbfc;">
                                <input type="file" wire:model="uploadFiles" multiple class="form-control-file" id="fileInput" style="display: none;">
                                <label for="fileInput" style="cursor: pointer; margin: 0;">
                                    <i class="fas fa-cloud-upload-alt fa-2x mb-2" style="color: var(--z-gold);"></i>
                                    <div style="font-weight: 600; color: #1a2332;">Click to select files</div>
                                    <div style="font-size: 0.78rem; color: #94a3b8;">Max 20MB per file. PDF, DOC, XLS, images, etc.</div>
                                </label>
                            </div>
                            @error('uploadFiles') <span class="text-danger" style="font-size: 0.78rem;">{{ $message }}</span> @enderror
                            @error('uploadFiles.*') <span class="text-danger" style="font-size: 0.78rem;">{{ $message }}</span> @enderror

                            {{-- Preview selected files --}}
                            @if(!empty($uploadFiles))
                                <div class="mt-2">
                                    <small class="text-muted">{{ count($uploadFiles) }} file(s) selected:</small>
                                    <div class="mt-1" style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                                        @foreach($uploadFiles as $idx => $f)
                                            <span class="z-badge" style="font-size: 0.72rem;">
                                                <i class="fas fa-file mr-1"></i>
                                                {{ $f->getClientOriginalName() }}
                                                <small class="ml-1">({{ number_format($f->getSize() / 1048576, 1) }}MB)</small>
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- Description --}}
                        <div class="form-group mb-3">
                            <label class="z-label">Description <small class="text-muted">(optional)</small></label>
                            <textarea wire:model.defer="uploadDescription" class="form-control z-input" rows="2" placeholder="Brief description of these files..."></textarea>
                        </div>

                        {{-- Upload progress --}}
                        <div wire:loading wire:target="uploadFiles" class="mb-2">
                            <div class="progress" style="height: 4px; border-radius: 2px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%; background: var(--z-gold);"></div>
                            </div>
                            <small class="text-muted">Processing files...</small>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid #e9ecef;">
                        <button wire:click="closeUploadModal" class="btn btn-light" style="border-radius: 8px;">Cancel</button>
                        <button wire:click="uploadNewFiles" class="btn-zesco-green" wire:loading.attr="disabled" wire:target="uploadNewFiles">
                            <span wire:loading.remove wire:target="uploadNewFiles"><i class="fas fa-upload mr-1"></i> Upload</span>
                            <span wire:loading wire:target="uploadNewFiles"><i class="fas fa-spinner fa-spin mr-1"></i> Uploading...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- ===== DETAIL MODAL ===== --}}
    @if($showDetailModal && $detailFile)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-lg">
                <div class="modal-content z-modal">
                    <div class="modal-header modal-header-zesco">
                        <h5><i class="fas fa-file-alt mr-2"></i> File Details</h5>
                        <button wire:click="closeDetailModal" type="button" class="close text-white"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            {{-- File Icon & Name --}}
                            <div class="col-md-12 mb-3">
                                <div class="d-flex align-items-center" style="gap: 1rem;">
                                    <div style="width: 56px; height: 56px; border-radius: 12px; background: #f1f5f9; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas {{ $detailFile->icon_class }}" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <div>
                                        <h5 style="font-weight: 700; color: #1a2332; margin: 0;">{{ $detailFile->display_name }}</h5>
                                        <div style="font-size: 0.82rem; color: #6b7280;">
                                            {{ strtoupper($detailFile->ext) }} &bull; {{ $detailFile->human_size }}
                                            @if($detailFile->mime_type)
                                                &bull; {{ $detailFile->mime_type }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Details Grid --}}
                            <div class="col-md-6 mb-2">
                                <div class="z-detail-label">Document Category</div>
                                <div class="z-detail-value"><span class="z-badge">{{ ucfirst($detailFile->type ?? 'N/A') }}</span></div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="z-detail-label">UUID</div>
                                <div class="z-detail-value" style="font-size: 0.78rem; font-family: monospace;">{{ $detailFile->uuid }}</div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="z-detail-label">Associated IPP</div>
                                <div class="z-detail-value">
                                    @php $ipp = \App\Models\IndependentProducer::find($detailFile->model_id); @endphp
                                    @if($ipp)
                                        <a href="{{ route('independent-producer.show', $ipp->id) }}" style="color: var(--z-green); font-weight: 600;">
                                            {{ $ipp->name_of_ipp ?? $ipp->system_ref }}
                                        </a>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="z-detail-label">Reference Code</div>
                                <div class="z-detail-value">{{ $detailFile->model_code ?: $detailFile->modal_code ?: '—' }}</div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="z-detail-label">Storage Path</div>
                                <div class="z-detail-value" style="font-size: 0.78rem; font-family: monospace; word-break: break-all;">{{ $detailFile->path }}</div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="z-detail-label">File Exists</div>
                                <div class="z-detail-value">
                                    @if($detailFile->fileExists())
                                        <span style="color: var(--z-green); font-weight: 600;"><i class="fas fa-check-circle mr-1"></i> Yes</span>
                                    @else
                                        <span style="color: var(--z-red); font-weight: 600;"><i class="fas fa-exclamation-triangle mr-1"></i> Missing</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="z-detail-label">Uploaded By</div>
                                <div class="z-detail-value">{{ $detailFile->uploader->name ?? '—' }}</div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="z-detail-label">Upload Date</div>
                                <div class="z-detail-value">{{ $detailFile->created_at ? $detailFile->created_at->format('M d, Y H:i') : '—' }}</div>
                            </div>
                            @if($detailFile->description)
                                <div class="col-md-12 mb-2">
                                    <div class="z-detail-label">Description</div>
                                    <div class="z-detail-value">{{ $detailFile->description }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid #e9ecef;">
                        <button wire:click="closeDetailModal" class="btn btn-light" style="border-radius: 8px;">Close</button>
                        <a href="{{ $detailFile->download_url }}" target="_blank" class="btn-zesco" style="text-decoration: none;">
                            <i class="fas fa-download mr-1"></i> Open / Download
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- ===== DELETE CONFIRMATION ===== --}}
    @if($deleteId)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-sm">
                <div class="modal-content z-modal">
                    <div class="modal-body text-center py-4">
                        <div class="z-delete-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h5 style="font-weight: 700; color: #1a2332; margin-bottom: 0.5rem;">Delete File?</h5>
                        <p style="font-size: 0.85rem; color: #6b7280;">
                            Are you sure you want to delete<br>
                            <strong>"{{ Str::limit($deleteName, 40) }}"</strong>?<br>
                            <small class="text-danger">This will also remove the physical file.</small>
                        </p>
                        <div class="d-flex justify-content-center" style="gap: 0.75rem;">
                            <button wire:click="cancelDelete" class="btn btn-light" style="border-radius: 8px;">Cancel</button>
                            <button wire:click="deleteFile" class="btn btn-danger" style="border-radius: 8px;">
                                <i class="fas fa-trash-alt mr-1"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
