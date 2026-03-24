<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="container-fluid  ">
        <br>

        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Quotations</li>
                </ol>
            </div>
        </div>

        <div class="card card-body ">
            <div class="row-cols-l6-12 row-cols-sm-12   ">
                QUOTATIONS
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-12">
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <p class="lead"> {!! session()->get('message') !!}</p>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <p class="lead"> {!! session()->get('error') !!}</p>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        <div class="row mb-2 ">
            <div class="col-md-12 col-sm-12">
                <div class="card mt-lg-4">
                    <div class="card-body">

                        <div>
                            <table class="table table-bordered mt-5">
                                <tr>
                                    <th>No</th>
                                    <th>Quotation Number</th>
                                    <th>Client(IPP)</th>
                                    <th>Quotation Date</th>
                                    <th>Currency</th>
                                    <th>Exchange Rate</th>
                                    <th>Quotation Final</th>
                                    <th></th>
                                </tr>
                                <tbody>
                                @forelse($quotes as $item)
                                    <tr>
                                        <td>{{$item->id ?? ""}}</td>
                                        <td>{{$item->quotation_no ?? ""}}</td>
                                        <td>{{$item->clients->company_name ?? ""}}</td>
                                        <td>{{$item->quotation_date ?? ""}}</td>
                                        <td>{{$item->currency ?? ""}}</td>
                                        <td>{{$item->exchange_rate ?? ""}}</td>
                                        <td>{{$item->quotation_final ?? ""}}</td>
                                        <td><a href="{{route('quote.show', $item->uuid)}}" class="btn btn-info">view</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4" style="color: #94a3b8;">
                                            <i class="fas fa-clipboard-list fa-2x d-block mb-2" style="opacity: 0.3;"></i>

                                            No banks found.

                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>

                            <!-- Pagination -->
                            {{$quotes->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
