<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

    <div>
        {{-- Do your work, then step back. --}}
        <div class="row">
            {{-- LEFT SIDEBAR — Folder Tree --}}
            <div class="col-lg-9 col-md-8">
                {{-- Folder Tree Card --}}
                <div class="card z-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-2">
                        <h3 class="mb-0" style="font-size: 0.9rem;"><i class="fas fa-home mr-1"></i> Fill in Details</h3>

                    </div>
                    <div class="card-body p-0" style="max-height: 450px; overflow-y: auto;">

                    </div>
                </div>

                {{-- Categories Card --}}

            </div>

            {{-- RIGHT CONTENT — Documents --}}
            <div class="col-lg-3 col-md-4 mb-3">

                <div class="card z-card" style="position: relative;">


                    {{-- Header --}}

                    <div class="card-body">
                        {{-- Filters --}}
                        <div class="d-flex flex-wrap align-items-center mb-3" style="gap: 0.75rem;">
                            <div class="z-search" style="flex: 1; min-width: 200px; max-width: 320px;">
                                <i class="fas fa-search si"></i>
                                <input type="text" wire:model.debounce.300ms="search" placeholder="Search documents...">
                            </div>

                        </div>

                        {{-- Subfolders (if any) --}}

                        {{-- Documents Table --}}
                        <div class="z-section-title mb-2"><i class="fas fa-file-alt mr-1"></i> Documents</div>
                        <div class="table-responsive">
                            <table class="table z-table mb-0">
                                <thead>
                                <tr>
                                    <th style="width: 40px;">#</th>
                                    <th wire:click="sortBy('original_name')" style="min-width: 250px; cursor: pointer;">
                                        File Name
                                        <i class="fas fa-sort sort-icon"></i>
                                    </th>
                                    <th>Category</th>
                                    <th wire:click="sortBy('file_extension')" style="cursor: pointer;">
                                        Format
                                        <i class="fas fa-sort sort-icon "></i>
                                    </th>

                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <td colspan="8" class="text-center py-4" style="color: #94a3b8;">
                                        <i class="fas fa-folder-open fa-2x d-block mb-2"></i>
                                        No documents in this
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}

                        <div class="d-flex justify-content-center mt-3">

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
