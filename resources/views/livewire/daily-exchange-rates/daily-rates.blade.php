<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="container-fluid  ">
        <br>

        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Daily Exchange Rates</li>
                </ol>
            </div>
        </div>

        <div class="card card-body ">
            <div class="row-cols-l6-12 row-cols-sm-12   ">
                DAILY RATES
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
                            <button wire:click="syncDailyRate()" class="btn btn-success"
                                    title="This will get customer information from FMS and create local records ">
                                Sync Rates With FMS
                            </button>

                            <div wire:loading>
                                <div class="spinner-border text-success" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <span class="text-sm text-info">Loading...</span>
                            </div>


                            <table class="table table-bordered mt-5">
                                <tr>
                                    <th>No</th>
                                    <th>FROM CURRENCY</th>
                                    <th>TO CURRENCY</th>
                                    <th>CONVERSION DATE</th>
                                    <th>CONVERSION TYPE</th>
                                    <th>CONVERSION RATE</th>
                                    <th>CREATION DATE</th>

                                </tr>
                                <tbody>
                                @foreach ($rates as $rate)

                                    <tr>
                                        <td>{{$rate->id ?? ""}}</td>
                                        <td>{{$rate->from_currency ?? ""}}</td>
                                        <td>{{$rate->to_currency ?? ""}}</td>
                                        <td>{{$rate->conversion_date ?? ""}}</td>
                                        <td>{{$rate->conversion_type ?? ""}}</td>
                                        <td>{{number_format($rate->conversion_rate, 4)  ?? ""}}</td>
                                        <td>{{$rate->creation_date ?? ""}}</td>

                                    </tr>
                                @endforeach


                                </tbody>
                            </table>

                            <!-- Pagination -->
                            {{ $rates->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
