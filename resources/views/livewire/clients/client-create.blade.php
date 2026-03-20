<div>
    {{-- Do your work, then step back. --}}
    <div class="row">
        {{-- LEFT SIDEBAR — Folder Tree --}}
        <div class="col-lg-9 col-md-8">
            {{-- Folder Tree Card --}}
            <div class="card z-card">
                <div class="card-header d-flex align-items-center justify-content-between py-2">
                    <h3 class="mb-0" style="font-size: 0.9rem;"><i class="fas fa-sitemap mr-1"></i> Fill in details</h3>

                </div>
                <div class="card-body p-0" style="max-height: 450px; overflow-y: auto;">
                    <div class="dm-folder-tree">
                        {{-- Root --}}
                        <div wire:click="goToRoot" class="dm-tree-item ">
                            <div class="form-row mt-2">
                                <div class="form-group col-md-4">
                                    <label>Company Name</label>
                                    <input class="form-control" name="contract_type" required>


                                </div>
                                <div class="form-group col-md-4">
                                    <label>Phone #</label>
                                    <input type="text" class="form-control" name="customer_name" value="" readonly>

                                </div>
                                <div class="form-group col-md-4">
                                    <label>Email</label>
                                    <select class="form-control" name="agreement_type">
                                        <option>Domestic</option>
                                        <option>International</option>
                                        <option>Imports</option>
                                        <option>Exports</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Client Address</label>
                                    <textarea class="form-control" name="contract_period_description" rows="3"></textarea>
                                </div>


                            </div>
                            <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>County</label>
                                <input type="number" step="any" class="form-control" name="contracted_capacity">
                            </div>

                            <div class="form-group col-md-4">
                                <label>City</label>
                                <select class="form-control" name="industry_type" required>
                                    <option selected disabled hidden>--Select industry type--</option>

                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Province</label>
                                <input type="number" step="any" class="form-control" name="contracted_capacity">
                            </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>

            {{-- Categories Card --}}

        </div>

        {{-- RIGHT CONTENT — Documents --}}
        <div class="col-lg-3 col-md-4 mb-3">

            <div class="card z-card" style="position: relative;">
                <div  class="z-loading">
                    <div class="spinner-border text-success"><span class="sr-only">Loading...</span></div>
                </div>

                {{-- Header --}}
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap"
                     style="gap: 0.75rem;">
                    <div>
                        {{-- Breadcrumbs --}}
                        <div class="dm-breadcrumb mb-1">
                            <span wire:click="goToRoot" class="dm-breadcrumb-link"><i
                                    class="fas fa-home"></i> Root</span>

                        </div>
                        <h3 class="mb-0">
                            <i class="fas fa-folder-open mr-1"></i>

                        </h3>
                    </div>
                    <div class="d-flex" style="gap: 0.5rem;">

                    </div>
                </div>

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
