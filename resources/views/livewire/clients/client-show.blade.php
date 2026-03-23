<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
<div class="containerFluid">
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
                    <div class="card-body p-0" >
                        <div class="dm-tree-item ">
                            <div class="form-row mt-2">
                                <div class="form-group col-md-3">
                                    <label>Company Name</label>
                                    {{$client->company_name}}



                                </div>
                                <div class="form-group col-md-3">
                                    <label>TPIN #</label>
                                    {{$client->tpin}}


                                </div>
                                <div class="form-group col-md-3">
                                    <label>Phone #</label>
                                    {{$client->phone}}


                                </div>
                                <div class="form-group col-md-3">
                                    <label>Email</label>
                                    {{$client->email}}


                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Address</label>
                                    {{$client->address_line_1}}

                                </div>


                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>Country</label>
                                    {{$client->country}}

                                </div>

                                <div class="form-group col-md-3">
                                    <label>City</label>
                                    {{$client->city}}

                                </div>
                                <div class="form-group col-md-3">
                                    <label>Province</label>
                                    {{$client->province}}

                                </div>

                                <div class="form-group col-md-3">
                                    <label>Is client active</label>
                                    <span>   {{$client->country}}</span>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                {{-- Categories Card --}}

            </div>

            {{-- RIGHT CONTENT — Documents --}}
            <div class="col-lg-3 col-md-4 mb-3">
<div class="card">
    <div class="card-header">
        <a class="btn btn-success" href="{{route('quote.create', $client->id)}}">Generate Quotation</a>

    </div>
    <div class="card-body ">

    </div>
</div>
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

                                    <th style="min-width: 250px; cursor: pointer;">
                                        File Name
                                    </th>


                                </tr>
                                </thead>
                                <tbody>
                                @forelse($documents as $doc)
                                    <tr>
                                    <td>{{$doc->type}}</td>
{{--                                    <td>{{$doc->type}}</td>--}}
                                    </tr>
                                @empty
                                    <tr>No documents yet</tr>

                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
