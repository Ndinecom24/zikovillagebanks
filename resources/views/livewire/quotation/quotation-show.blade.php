<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="container-fluid">
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <h2 class="text-success fw-bold mb-0">
                    <i class="fas fa-file-invoice-dollar me-2"></i> Create Quotation
                </h2>
            </div>

        </div>
    </div>
    <div class="container-fluid">

        <div class="row">
            <!-- Contract Details -->
            <div class="col-md-4 col-sm-12">
                <div class="card shadow-sm border-0 rounded-lg mb-4">
                    <div class="card-body">
                        <h6 class="text-uppercase text-green mb-3">Client Details</h6>

                        <div class="mb-2">
                            <small class="text-muted">Company Name</small>
                            <div class="text-orange">{{ $client->company_name }}</div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Phone No.</small>
                            <div class="text-orange">{{ $client->phone ?? 'N/A' }}</div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Email</small>
                            <div class="text-orange">{{$client->email}}</div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Contract Period</small>
                            <div class="text-orange">{{$client->address_line_1}}</div>
                        </div>


                    </div>

                    <div class="card-footer bg-white border-0 text-center">

                    </div>
                </div>
            </div>

            <!-- Invoice Form -->
            <div class="col-lg-8 mb-3">
                <!-- Alerts -->
                @if ($message = Session::get('message'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm">
                        {{ $message }}
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger shadow-sm">
                        <strong>Whoops!</strong> Fix the errors below:
                        <ul class="mt-2 mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-light">
                        <h5 class="mb-0 text-green">Quotation Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label>Quotation Number</label>
                                <div class="d-flex align-items-center">
                                    {{$quotation->quotation_no}}

                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Quotation Date</label>
                                <div class="d-flex align-items-center">
                                    {{$quotation->quotation_date}}

                                </div>
                            </div>


                            {{-- Exchange Rate --}}
                            <div class="form-group col-md-6">
                                <label>Currency</label>
                                <div class="d-flex align-items-center">
                                    {{$quotation->currency}}


                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label>Exchange Rate</label>
                                <div class="d-flex align-items-center">
                                    {{$quotation->exchange_rate}}

                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Unit</label>
                                <div class="d-flex align-items-center">
                                    {{$quotation->unit_desc}}

                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <!-- Invoice Items -->
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-light">
                        <h5 class="mb-0 text-green">Quotation Items</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($quotations_items as $index => $item)

                                    <tr>
                                        <td></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <input type="text" class="form-control form-control-sm"
                                                       wire:model.lazy="items.{{ $index }}.description" required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <input type="number" class="form-control form-control-sm"
                                                       wire:model.lazy="items.{{ $index }}.quantity" step="any"
                                                       required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <input type="number" class="form-control form-control-sm"
                                                       wire:model.lazy="items.{{ $index }}.unit_price" step="any">
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex align-items-center">
                                                <input type="text" class="form-control form-control-sm" step="any"
                                                       value="{{ number_format($item['total'], 2) }}" readonly>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td><strong> VAT </strong></td>
                                    <td>{{$quotation->vat}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td> Total(ZMW)</td>
                                    <td>{{ number_format($quotation->quotation_final_kwacha, 2) }}</td>
                                </tr>
                                <tr class="font-weight-bold bg-light">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Grand Total</strong>
                                    </td>

                                    <td>{{ number_format($quotation->quotation_final, 2) }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Justification & File -->
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-light">
                        <h5 class="mb-0 text-green">Additional Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label>Full Description</label>
                                <div class="d-flex align-items-center">
                                    {{$quotation->full_justification}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Submit -->
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <button class="btn btn-warning btn-rounded px-4 rounded-pill shadow-sm m-1">
                            <i class="fa fa-check-circle mr-1"></i> Edit
                        </button>


                        <a type="submit" class="btn btn-warning btn-rounded px-4 rounded-pill shadow-sm m-1"
                           data-toggle="modal" data-target="#attachBank">
                            <i class="fa fa-check-circle mr-1"></i> Attach Bank

                        </a>
                        @if($quotation->bank_id !== null)
                            <a
                                href="{{route('pdf.download',$quotation->uuid )}}"
                                class="btn btn-info btn-rounded px-4 rounded-pill shadow-sm m-1">
                                <i class="fa fa-download mr-1"></i> PDF

                            </a>
                        @endif
                    </div>
                </div>


                @if (session()->has('submit_message'))
                    <div class="alert alert-success alert-dismissible fade show mt-3 shadow-sm">
                        {!! session()->get('submit_message') !!}
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade show" id="attachBank" style=" padding-right: 15px;" aria-modal="true"
         role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Bank Configurations</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- List of users with checkboxes -->
                    @foreach ($banks as $bank)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" wire:model="selectedBanks"
                                   value="{{ $bank->id }}"> <label class="form-check-label" for="bank_{{ $bank->id }}">
                                {{ $bank->account_name }} {{$bank->account_no}}({{ $bank->currency }})
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <button type="button" class="btn btn-primary" wire:click="attachBankDetails"
                            data-dismiss="modal">Attach
                        Selected
                    </button>
                    <div wire:loading class="spinner-border text-success " role="status">
                        <span class="sr-only">Loading...</span>
                    </div>

                </div>


            </div>
        </div>
    </div>

</div>
