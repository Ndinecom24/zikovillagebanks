<div>

    <div class="container-fluid">
        @if(session()->has('message'))
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <p>{{session()->get('message')}}</p>
                    </div>
                </div>
            </div>
        @endif
        @if(session()->has('error'))
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <p>{{session()->get('error')}}</p>
                    </div>
                </div>
            </div>
        @endif
        @if(session()->has('info'))
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <p>{{ $info }}</p>
                    </div>
                </div>
            </div>
        @endif
        @if ($errors->any())
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger">
                        <strong></strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif





        {{-- Do your work, then step back. --}}
        <div class="row">
            {{-- LEFT SIDEBAR — Folder Tree --}}
            <div class="col-lg-9 col-md-8">
                {{-- Folder Tree Card --}}
                <div class="card z-card">
                    <div class="card-header d-flex align-items-center justify-content-between py-2">
                        <h3 class="mb-0" style="font-size: 0.9rem;"><i class="fas fa-sitemap mr-1"></i> Fill in details
                        </h3>

                    </div>
                    <div class="card-body p-0">
                        <form wire:submit.prevent="createClient" enctype="multipart/form-data">
                            <div class="dm-folder-tree">
                                {{-- Root --}}
                                <div class="dm-tree-item ">
                                    <div class="form-row mt-2">
                                        <div class="form-group col-md-3">
                                            <label>Company Name</label>
                                            <input class="form-control" wire:model="company_name" required>


                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>TPIN #</label>
                                            <input type="number" class="form-control" wire:model="tpin" required>

                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Phone #</label>
                                            <input type="text" class="form-control" wire:model="phone" required>

                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Email</label>
                                            <input type="email" class="form-control" wire:model="email" required>

                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>Address</label>
                                            <textarea class="form-control" wire:model="address_line_1"
                                                      rows="2"></textarea>
                                        </div>


                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label>Country</label>
                                            <input type="text" class="form-control" wire:model="country" required>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>City</label>
                                            <input type="text" class="form-control" wire:model="city" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Province</label>
                                            <input type="text" step="any" class="form-control" wire:model="province"
                                                   required>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>Is client active</label>
                                            <select class="form-control"
                                                    wire:model="documents.{{ $index }}.filetype">
                                                <option value="">-- Select --</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>

                                            </select>
                                        </div>

                                    </div>
                                    <hr>

                                    <h5><strong>Client Documents</strong></h5>

                                    @foreach($documents as $index => $doc)
                                        <div class="document-row mb-3">
                                            <div class="form-row">

                                                <div class="form-group col-md-4">
                                                    <label>Document Name</label>
                                                    <select class="form-control"
                                                            wire:model="documents.{{ $index }}.filetype">
                                                        <option value="">-- Select --</option>
                                                        <option value="ZRA Tax Certificate">ZRA Tax Certificate</option>
                                                        <option value="Pacra Company Certificate">Pacra Company
                                                            Certificate
                                                        </option>
                                                        <option value="Feasibility Study Rights">Feasibility Study
                                                            Rights
                                                        </option>
                                                        <option value="Grid Connection Certificate">Grid Connection
                                                            Certificate
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Upload File</label>
                                                    <input type="file" class="form-control"
                                                           wire:model="documents.{{ $index }}.file">
                                                </div>

                                                <div class="form-group col-md-2 d-flex align-items-end">
                                                    <button type="button"
                                                            class="btn btn-danger"
                                                            wire:click="removeRow({{ $index }})">
                                                        Remove
                                                    </button>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach

                                    <button type="button" class="btn btn-info" wire:click="addRow">
                                        Add File
                                    </button>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="card-body text-center">
                                    <button type="submit"
                                            class="btn btn-success btn-rounded px-4 rounded-pill shadow-sm m-1">
                                        <i class="fa fa-check-circle mr-1"></i> Submit
                                        <div wire:loading wire:target="createClient"
                                             class="spinner-border spinner-border-sm ml-2"></div>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Categories Card --}}

        </div>

        {{-- RIGHT CONTENT — Documents --}}
        {{--        <div class="col-lg-3 col-md-4 mb-3">--}}

        {{--          --}}
        {{--        </div>--}}
    </div>
</div>



