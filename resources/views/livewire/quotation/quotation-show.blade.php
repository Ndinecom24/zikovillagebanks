<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}

    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h2 class="text-success fw-bold mb-0">
                <i class="fas fa-file-invoice-dollar me-2"></i> Create Quotation
            </h2>
        </div>
        <div class="col-md-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb float-end mb-0 bg-white px-3 py-2 rounded shadow-sm">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Quotation Create</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <!-- Contract Details -->
        <div class="col-md-4 col-sm-12">
            <div class="card shadow-sm border-0 rounded-lg mb-4">
                <div class="card-body">
                    <h6 class="text-uppercase text-green mb-3">Client Details</h6>

                    <div class="mb-2">
                        <small class="text-muted">Company Name</small>
                        <div class="text-orange">{{ $client->customer_name }}</div>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">Industry Type</small>
                        <div class="text-orange">{{ $client->industry->industry_type ?? 'N/A' }}</div>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">Contract No</small>
                        <div class="text-orange"></div>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted">Contract Period</small>
                        <div class="text-orange">yrs</div>
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
                        <button type="submit" class="btn btn-warning btn-rounded px-4 rounded-pill shadow-sm m-1">
                            <i class="fa fa-check-circle mr-1"></i> Edit

                        </button>

                        <a href="{{route('pdf.download',$quotation->uuid )}}" class="btn btn-warning btn-rounded px-4 rounded-pill shadow-sm m-1">
                            <i class="fa fa-download mr-1"></i> PDF

                        </a>
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
