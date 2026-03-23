<div>
    <section class="content py-3 px-3">
        {{-- ===== Page Header ===== --}}
        <div class="z-page-header mb-3">
            <h1><i class="fas fa-archive"></i> Document Management</h1>
            <p>Organize documents in folders, assign categories, and link to clients</p>
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
                    <div class="stat-icon"><i class="fas fa-file-alt"></i></div>
                    <div>
                        <div class="stat-value">{{ number_format($stats['totalDocuments']) }}</div>
                        <div class="stat-label">Total Documents</div>
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
                    <div class="stat-icon"><i class="fas fa-folder"></i></div>
                    <div>
                        <div class="stat-value">{{ $stats['totalFolders'] }}</div>
                        <div class="stat-label">Folders</div>
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

        {{-- ===== Main Layout: Sidebar + Content ===== --}}
        <div class="row">
            {{-- LEFT SIDEBAR — Folder Tree --}}
            <div class="col-lg-3 col-md-4 mb-3">
                {{-- Folder Tree Card --}}
                <div class="card z-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-2">
                        <h3 class="mb-0" style="font-size: 0.9rem;"><i class="fas fa-sitemap mr-1"></i> Folders</h3>
                        <button wire:click="openCreateFolderModal" class="btn-zesco" style="font-size: 0.72rem; padding: 4px 10px;">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="card-body p-0" style="max-height: 450px; overflow-y: auto;">
                        <div class="dm-folder-tree">
                            {{-- Root --}}
                            <div wire:click="goToRoot" class="dm-tree-item {{ is_null($currentFolderId) ? 'dm-tree-active' : '' }}">
                                <i class="fas fa-home mr-1"></i> All Documents
                            </div>
                            @foreach($folderTree as $folder)
                                @include('livewire.documents._folder-tree-item', ['folder' => $folder, 'level' => 0])
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Categories Card --}}
                <div class="card z-card mt-3">
                    <div class="card-header d-flex align-items-center justify-content-between py-2">
                        <h3 class="mb-0" style="font-size: 0.9rem;"><i class="fas fa-tags mr-1"></i> Categories</h3>
                        <button wire:click="openCategoryModal()" class="btn-zesco" style="font-size: 0.72rem; padding: 4px 10px;">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="card-body p-0" style="max-height: 300px; overflow-y: auto;">
                        @forelse($allCategories as $cat)
                            <div class="dm-category-item d-flex align-items-center justify-content-between">
                                <div>
                                    <span style="font-weight: 600; font-size: 0.82rem; color: #1a2332;">{{ $cat->name }}</span>
                                    <span class="z-count ml-1">{{ $cat->documents_count ?? $cat->documents()->count() }}</span>
                                    @if($cat->description)
                                        <div style="font-size: 0.7rem; color: #94a3b8;">{{ Str::limit($cat->description, 40) }}</div>
                                    @endif
                                </div>
                                <div class="d-flex" style="gap: 2px;">
                                    <button wire:click="openCategoryModal({{ $cat->id }})" class="z-action z-action-edit" title="Edit" style="width: 24px; height: 24px; font-size: 0.65rem;">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button wire:click="deleteCategory({{ $cat->id }})" class="z-action z-action-delete" title="Delete" style="width: 24px; height: 24px; font-size: 0.65rem;"
                                            onclick="return confirm('Delete this category?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="p-3 text-center" style="color: #94a3b8; font-size: 0.8rem;">
                                <i class="fas fa-tags d-block mb-1"></i> No categories yet
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- RIGHT CONTENT — Documents --}}
            <div class="col-lg-9 col-md-8">
                <div class="card z-card">
                    {{-- Header --}}
                    <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="gap: 0.75rem;">
                        <div>
                            {{-- Breadcrumbs --}}
                            <div class="dm-breadcrumb mb-1">
                                <span wire:click="goToRoot" class="dm-breadcrumb-link"><i class="fas fa-home"></i> Root</span>
                                @foreach($breadcrumbs as $crumb)
                                    <span class="dm-breadcrumb-sep">/</span>
                                    <span wire:click="openFolder({{ $crumb['id'] }})" class="dm-breadcrumb-link">{{ $crumb['name'] }}</span>
                                @endforeach
                            </div>
                            <h3 class="mb-0">
                                <i class="fas fa-folder-open mr-1"></i>
                                {{ $currentFolderId ? (collect($breadcrumbs)->last()['name'] ?? 'Folder') : 'All Documents' }}
                                <span class="z-count">{{ $documents->total() }}</span>
                            </h3>
                        </div>
                        <div class="d-flex" style="gap: 0.5rem;">
                            <button wire:click="openCreateFolderModal" class="btn-zesco-outline" style="font-size: 0.8rem;">
                                <i class="fas fa-folder-plus mr-1"></i> New Folder
                            </button>
                            <button wire:click="openUploadModal" class="btn-zesco">
                                <i class="fas fa-cloud-upload-alt mr-1"></i> Upload
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        {{-- Filters --}}
                        <div class="d-flex flex-wrap align-items-center mb-3" style="gap: 0.75rem;">
                            <div class="z-search" style="flex: 1; min-width: 200px; max-width: 320px;">
                                <i class="fas fa-search si"></i>
                                <input type="text" wire:model.debounce.300ms="search" placeholder="Search documents...">
                            </div>
                            <select wire:model="filterCategory" class="form-control z-filter-select" style="max-width: 180px;">
                                <option value="">All Categories</option>
                                @foreach($allCategories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            <select wire:model="filterClient" class="form-control z-filter-select" style="max-width: 200px;">
                                <option value="">All Clients</option>
                                @foreach($clients as $c)
                                    <option value="{{ $c['id'] }}">{{ Str::limit($c['name_of_ipp'], 30) }}</option>
                                @endforeach
                            </select>
                            <select wire:model="perPage" class="form-control z-per-page">
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                            @if($search || $filterCategory || $filterClient)
                                <button wire:click="clearFilters" class="btn btn-sm btn-outline-secondary" style="border-radius: 6px;">
                                    <i class="fas fa-times mr-1"></i> Clear
                                </button>
                            @endif
                        </div>

                        {{-- Subfolders (if any) --}}
                        @if($subfolders->count() > 0)
                            <div class="mb-3">
                                <div class="z-section-title mb-2"><i class="fas fa-folder mr-1"></i> Folders</div>
                                <div class="dm-folder-grid">
                                    @foreach($subfolders as $sf)
                                        <div class="dm-folder-card">
                                            <div class="dm-folder-card-body" wire:click="openFolder({{ $sf->id }})">
                                                <div class="dm-folder-icon"><i class="fas fa-folder"></i></div>
                                                <div class="dm-folder-name" title="{{ $sf->name }}">{{ Str::limit($sf->name, 20) }}</div>
                                                <div class="dm-folder-meta">
                                                    {{ $sf->documents()->count() }} file(s)
                                                    @if($sf->children()->count() > 0)
                                                        &bull; {{ $sf->children()->count() }} subfolder(s)
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="dm-folder-actions">
                                                <button wire:click="openRenameFolderModal({{ $sf->id }})" class="z-action z-action-edit" title="Rename" style="width: 26px; height: 26px; font-size: 0.7rem;">
                                                    <span wire:loading wire:target="openRenameFolderModal({{ $sf->id }})" class="spinner-border spinner-border-sm" role="status" style="width: 0.6rem; height: 0.6rem;"></span>
                                                    <i wire:loading.remove wire:target="openRenameFolderModal({{ $sf->id }})" class="fas fa-pen"></i>
                                                </button>
                                                <button wire:click="confirmDeleteFolder({{ $sf->id }})" class="z-action z-action-delete" title="Delete Folder" style="width: 26px; height: 26px; font-size: 0.7rem;">
                                                    <span wire:loading wire:target="confirmDeleteFolder({{ $sf->id }})" class="spinner-border spinner-border-sm" role="status" style="width: 0.6rem; height: 0.6rem;"></span>
                                                    <i wire:loading.remove wire:target="confirmDeleteFolder({{ $sf->id }})" class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Documents Table --}}
                        <div class="z-section-title mb-2"><i class="fas fa-file-alt mr-1"></i> Documents</div>
                        <div class="table-responsive">
                            <table class="table z-table mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 40px;">#</th>
                                        <th wire:click="sortBy('original_name')" style="min-width: 250px; cursor: pointer;">
                                            File Name
                                            <i class="fas fa-sort sort-icon {{ $sortField === 'original_name' ? 'active' : '' }}"></i>
                                        </th>
                                        <th>Category</th>
                                        <th wire:click="sortBy('file_extension')" style="cursor: pointer;">
                                            Format
                                            <i class="fas fa-sort sort-icon {{ $sortField === 'file_extension' ? 'active' : '' }}"></i>
                                        </th>
                                        <th wire:click="sortBy('file_size')" style="cursor: pointer;">
                                            Size
                                            <i class="fas fa-sort sort-icon {{ $sortField === 'file_size' ? 'active' : '' }}"></i>
                                        </th>
                                        <th>Client</th>
                                        <th wire:click="sortBy('created_at')" style="cursor: pointer;">
                                            Uploaded
                                            <i class="fas fa-sort sort-icon {{ $sortField === 'created_at' ? 'active' : '' }}"></i>
                                        </th>
                                        <th style="width: 130px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($documents as $idx => $doc)
                                        <tr>
                                            <td style="color: #94a3b8;">{{ $documents->firstItem() + $idx }}</td>
                                            <td>
                                                <div class="d-flex align-items-center" style="gap: 0.6rem;">
                                                    <div style="width: 36px; height: 36px; border-radius: 8px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                        <i class="{{ $doc->icon_class }}"></i>
                                                    </div>
                                                    <div style="min-width: 0;">
                                                        <div style="font-weight: 600; color: #1a2332; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 220px;" title="{{ $doc->display_name }}">
                                                            {{ $doc->display_name }}
                                                        </div>
                                                        @if($doc->description)
                                                            <div style="font-size: 0.72rem; color: #94a3b8; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 220px;">
                                                                {{ $doc->description }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($doc->category)
                                                    <span class="z-badge">{{ $doc->category->name }}</span>
                                                @else
                                                    <span style="font-size: 0.8rem; color: #94a3b8;">—</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="z-badge-purple" style="font-size: 0.72rem;">{{ strtoupper($doc->file_extension ?? '—') }}</span>
                                            </td>
                                            <td style="font-size: 0.82rem; color: #6b7280;">{{ $doc->human_size }}</td>
                                            <td>
                                                @if($doc->client)
                                                    <a href="{{ route('independent-producer.show', $doc->client->id) }}" style="font-size: 0.8rem; color: var(--z-green); text-decoration: none; font-weight: 600;" title="{{ $doc->client->name_of_ipp }}">
                                                        {{ Str::limit($doc->client->name_of_ipp ?? $doc->client->system_ref, 18) }}
                                                    </a>
                                                @else
                                                    <span style="font-size: 0.8rem; color: #94a3b8;">General</span>
                                                @endif
                                            </td>
                                            <td style="font-size: 0.78rem; color: #6b7280;">
                                                {{ $doc->created_at ? $doc->created_at->format('M d, Y') : '—' }}
                                                @if($doc->uploader)
                                                    <div style="font-size: 0.7rem; color: #94a3b8;">by {{ $doc->uploader->name }}</div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex" style="gap: 4px;">
                                                    <button wire:click="viewDocument({{ $doc->id }})" class="z-action z-action-view" title="Details">
                                                        <span wire:loading wire:target="viewDocument({{ $doc->id }})" class="spinner-border spinner-border-sm" role="status"></span>
                                                        <i wire:loading.remove wire:target="viewDocument({{ $doc->id }})" class="fas fa-eye"></i>
                                                    </button>
                                                    <a href="{{ $doc->download_url }}" target="_blank" class="z-action z-action-edit" title="Download" style="text-decoration: none;">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                    <button wire:click="confirmDeleteDocument({{ $doc->id }})" class="z-action z-action-delete" title="Delete">
                                                        <span wire:loading wire:target="confirmDeleteDocument({{ $doc->id }})" class="spinner-border spinner-border-sm" role="status"></span>
                                                        <i wire:loading.remove wire:target="confirmDeleteDocument({{ $doc->id }})" class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4" style="color: #94a3b8;">
                                                <i class="fas fa-folder-open fa-2x d-block mb-2"></i>
                                                No documents in this {{ $currentFolderId ? 'folder' : 'location' }}.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        @if($documents->hasPages())
                            <div class="d-flex justify-content-center mt-3">
                                {{ $documents->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== CREATE FOLDER MODAL ===== --}}
    @if($showFolderModal)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog">
                <div class="modal-content z-modal">
                    <div class="modal-header modal-header-zesco">
                        <h5><i class="fas fa-folder-plus mr-2"></i> {{ $editingFolderId ? 'Edit' : 'New' }} Folder</h5>
                        <button wire:click="closeFolderModal" type="button" class="close text-white"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="z-label">Folder Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model.defer="folderName" class="form-control z-input" placeholder="Enter folder name...">
                            @error('folderName') <span class="text-danger" style="font-size: 0.78rem;">{{ $message }}</span> @enderror
                        </div>
                        @if($currentFolderId)
                            <div class="form-group mb-3">
                                <label class="z-label">Parent Folder</label>
                                <input type="text" class="form-control z-input" value="{{ collect($breadcrumbs)->last()['name'] ?? 'Root' }}" disabled>
                                <small class="text-muted">This folder will be created inside the current folder.</small>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid #e9ecef;">
                        <button wire:click="closeFolderModal" class="btn btn-light" style="border-radius: 8px;">Cancel</button>
                        <button wire:click="saveFolder" class="btn-zesco-green">
                            <i class="fas fa-save mr-1"></i> {{ $editingFolderId ? 'Update' : 'Create' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- ===== RENAME FOLDER MODAL ===== --}}
    @if($showRenameModal)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog">
                <div class="modal-content z-modal">
                    <div class="modal-header modal-header-zesco">
                        <h5><i class="fas fa-pen mr-2"></i> Rename Folder</h5>
                        <button wire:click="closeRenameModal" type="button" class="close text-white"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="z-label">Folder Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model.defer="renameFolderName" class="form-control z-input" placeholder="Enter folder name...">
                            @error('renameFolderName') <span class="text-danger" style="font-size: 0.78rem;">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid #e9ecef;">
                        <button wire:click="closeRenameModal" class="btn btn-light" style="border-radius: 8px;">Cancel</button>
                        <button wire:click="renameFolder" class="btn-zesco-green">
                            <i class="fas fa-save mr-1"></i> Rename
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- ===== CATEGORY MODAL ===== --}}
    @if($showCategoryModal)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog">
                <div class="modal-content z-modal">
                    <div class="modal-header modal-header-gold">
                        <h5><i class="fas fa-tag mr-2"></i> {{ $editingCategoryId ? 'Edit' : 'New' }} Category</h5>
                        <button wire:click="closeCategoryModal" type="button" class="close text-white"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="z-label">Category Name <span class="text-danger">*</span></label>
                            <input type="text" wire:model.defer="categoryName" class="form-control z-input" placeholder="e.g. Contracts, Invoices, Reports...">
                            @error('categoryName') <span class="text-danger" style="font-size: 0.78rem;">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="z-label">Description <small class="text-muted">(optional)</small></label>
                            <textarea wire:model.defer="categoryDescription" class="form-control z-input" rows="2" placeholder="Brief description..."></textarea>
                            @error('categoryDescription') <span class="text-danger" style="font-size: 0.78rem;">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid #e9ecef;">
                        <button wire:click="closeCategoryModal" class="btn btn-light" style="border-radius: 8px;">Cancel</button>
                        <button wire:click="saveCategory" class="btn-zesco-green">
                            <i class="fas fa-save mr-1"></i> {{ $editingCategoryId ? 'Update' : 'Create' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- ===== UPLOAD MODAL ===== --}}
    @if($showUploadModal)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-lg">
                <div class="modal-content z-modal">
                    <div class="modal-header modal-header-zesco">
                        <h5><i class="fas fa-cloud-upload-alt mr-2"></i> Upload Documents</h5>
                        <button wire:click="closeUploadModal" type="button" class="close text-white"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        {{-- Upload to folder indicator --}}
                        @if($currentFolderId)
                            <div class="alert alert-info py-2 px-3 mb-3" style="border-radius: 8px; font-size: 0.82rem;">
                                <i class="fas fa-folder mr-1"></i> Uploading to: <strong>{{ collect($breadcrumbs)->pluck('name')->implode(' / ') }}</strong>
                            </div>
                        @endif

                        {{-- Category --}}
                        <div class="form-group mb-3">
                            <label class="z-label">Category <small class="text-muted">(optional)</small></label>
                            <select wire:model="uploadCategoryId" class="form-control z-input">
                                <option value="">-- No Category --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat['id'] }}">{{ $cat['name'] }}</option>
                                @endforeach
                            </select>
                            @error('uploadCategoryId') <span class="text-danger" style="font-size: 0.78rem;">{{ $message }}</span> @enderror
                        </div>

                        {{-- Client / IPP --}}
                        <div class="form-group mb-3">
                            <label class="z-label">Link to Client / IPP <small class="text-muted">(optional)</small></label>
                            <select wire:model="uploadClientId" class="form-control z-input">
                                <option value="">-- General Document --</option>
                                @foreach($clients as $c)
                                    <option value="{{ $c['id'] }}">{{ $c['system_ref'] }} — {{ $c['name_of_ipp'] }}</option>
                                @endforeach
                            </select>
                            @error('uploadClientId') <span class="text-danger" style="font-size: 0.78rem;">{{ $message }}</span> @enderror
                        </div>

                        {{-- File Input --}}
                        <div class="form-group mb-3">
                            <label class="z-label">Select Files <span class="text-danger">*</span></label>
                            <div style="border: 2px dashed #e2e8f0; border-radius: 12px; padding: 2rem; text-align: center; transition: border-color 0.2s; background: #fafbfc;">
                                <input type="file" wire:model="uploadFiles" multiple class="form-control-file" id="docFileInput" style="display: none;">
                                <label for="docFileInput" style="cursor: pointer; margin: 0;">
                                    <i class="fas fa-cloud-upload-alt fa-2x mb-2" style="color: var(--z-gold);"></i>
                                    <div style="font-weight: 600; color: #1a2332;">Click to select files</div>
                                    <div style="font-size: 0.78rem; color: #94a3b8;">Max 20MB per file. PDF, DOC, XLS, images, etc.</div>
                                </label>
                            </div>
                            @error('uploadFiles') <span class="text-danger" style="font-size: 0.78rem;">{{ $message }}</span> @enderror
                            @error('uploadFiles.*') <span class="text-danger" style="font-size: 0.78rem;">{{ $message }}</span> @enderror

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

    {{-- ===== DOCUMENT DETAIL MODAL ===== --}}
    @if($showDetailModal && $detailDocument)
        <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-lg">
                <div class="modal-content z-modal">
                    <div class="modal-header modal-header-zesco">
                        <h5><i class="fas fa-file-alt mr-2"></i> Document Details</h5>
                        <button wire:click="closeDetailModal" type="button" class="close text-white"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            {{-- File Icon & Name --}}
                            <div class="col-md-12 mb-3">
                                <div class="d-flex align-items-center" style="gap: 1rem;">
                                    <div style="width: 56px; height: 56px; border-radius: 12px; background: #f1f5f9; display: flex; align-items: center; justify-content: center;">
                                        <i class="{{ $detailDocument->icon_class }}" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <div>
                                        <h5 style="font-weight: 700; color: #1a2332; margin: 0;">{{ $detailDocument->display_name }}</h5>
                                        <div style="font-size: 0.82rem; color: #6b7280;">
                                            {{ strtoupper($detailDocument->file_extension) }} &bull; {{ $detailDocument->human_size }}
                                            @if($detailDocument->mime_type)
                                                &bull; {{ $detailDocument->mime_type }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Preview for images and PDFs --}}
                            @if($detailDocument->is_previewable)
                                <div class="col-md-12 mb-3">
                                    <div class="z-detail-label">Preview</div>
                                    <div style="border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden; max-height: 400px;">
                                        @if(in_array(strtolower($detailDocument->file_extension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']))
                                            <img src="{{ $detailDocument->download_url }}" alt="{{ $detailDocument->display_name }}" style="max-width: 100%; height: auto;">
                                        @elseif(strtolower($detailDocument->file_extension) === 'PDF')
                                            <iframe src="{{ $detailDocument->download_url }}" style="width: 100%; height: 400px; border: none;"></iframe>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            {{-- Details Grid --}}
                            <div class="col-md-6 mb-2">
                                <div class="z-detail-label">Category</div>
                                <div class="z-detail-value">
                                    @if($detailDocument->category)
                                        <span class="z-badge">{{ $detailDocument->category->name }}</span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="z-detail-label">Folder</div>
                                <div class="z-detail-value">
                                    @if($detailDocument->folder)
                                        <i class="fas fa-folder mr-1" style="color: var(--z-gold);"></i>{{ $detailDocument->folder->name }}
                                    @else
                                        <span class="text-muted">Root</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="z-detail-label">Linked Client / IPP</div>
                                <div class="z-detail-value">
                                    @if($detailDocument->client)
                                        <a href="{{ route('independent-producer.show', $detailDocument->client->id) }}" style="color: var(--z-green); font-weight: 600;">
                                            {{ $detailDocument->client->name_of_ipp ?? $detailDocument->client->system_ref }}
                                        </a>
                                    @else
                                        <span class="text-muted">General document</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="z-detail-label">Storage Path</div>
                                <div class="z-detail-value" style="font-size: 0.78rem; font-family: monospace; word-break: break-all;">{{ $detailDocument->file_path }}</div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="z-detail-label">File Exists</div>
                                <div class="z-detail-value">
                                    @if($detailDocument->fileExists())
                                        <span style="color: var(--z-green); font-weight: 600;"><i class="fas fa-check-circle mr-1"></i> Yes</span>
                                    @else
                                        <span style="color: #e53e3e; font-weight: 600;"><i class="fas fa-exclamation-triangle mr-1"></i> Missing</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="z-detail-label">Uploaded By</div>
                                <div class="z-detail-value">{{ $detailDocument->uploader->name ?? '—' }}</div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="z-detail-label">Upload Date</div>
                                <div class="z-detail-value">{{ $detailDocument->created_at ? $detailDocument->created_at->format('M d, Y H:i') : '—' }}</div>
                            </div>
                            @if($detailDocument->description)
                                <div class="col-md-12 mb-2">
                                    <div class="z-detail-label">Description</div>
                                    <div class="z-detail-value">{{ $detailDocument->description }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid #e9ecef;">
                        <button wire:click="closeDetailModal" class="btn btn-light" style="border-radius: 8px;">Close</button>
                        <a href="{{ $detailDocument->download_url }}" target="_blank" class="btn-zesco" style="text-decoration: none;">
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
                        <h5 style="font-weight: 700; color: #1a2332; margin-bottom: 0.5rem;">
                            Delete {{ $deleteType === 'folder' ? 'Folder' : 'Document' }}?
                        </h5>
                        <p style="font-size: 0.85rem; color: #6b7280;">
                            Are you sure you want to delete<br>
                            <strong>"{{ Str::limit($deleteName, 40) }}"</strong>?<br>
                            @if($deleteType === 'folder')
                                <small class="text-danger">All files and subfolders inside will also be deleted.</small>
                            @else
                                <small class="text-danger">This will also remove the physical file.</small>
                            @endif
                        </p>
                        <div class="d-flex justify-content-center" style="gap: 0.75rem;">
                            <button wire:click="cancelDelete" class="btn btn-light" style="border-radius: 8px;">Cancel</button>
                            <button wire:click="executeDelete" class="btn btn-danger" style="border-radius: 8px;">
                                <i class="fas fa-trash-alt mr-1"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
