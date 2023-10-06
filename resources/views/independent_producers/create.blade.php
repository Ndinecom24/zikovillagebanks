@extends('layouts.main.master')

@section('content')

    {{--    <div class="content-wrapper">--}}
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Independent Power Producers Registration</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        {{--                            <li class="breadcrumb-item active">Simple Tables</li>--}}
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-8">

                    @if (!empty($message))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    @if ($message = Session::get('message'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <p>{{ $message }}</p>
                        </div>
                    @endif


                    <div class="card">
                        <div class="card-header">

                            <a class="btn btn-outline-success float-right"
                               href="{{route('home')}}">
                                <i class="fa fa-backward"></i> Back
                            </a>
                            <h4 class="title">Create IPP</h4>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form id="form" action="{{ route('independent-producer.store') }}"
                                  enctype="multipart/form-data"
                                  method="POST"
                                  data-parsley-validate="">
                                @csrf

                                <div class="card-body">

                                    <div class="row">

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="sel_suppliers">Invoiced Services</label>
                                                <select name="invoiced_services" id="" class="form-control" type="text">
                                                    <option>N/A</option>
                                                    <option>INVOICED</option>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="contract_number">Technology</label>
                                                <select class="form-control"
                                                        id="type"
                                                        name="engagement_number"
                                                        type="text">
                                                    <option value="SOLAR">SOLAR</option>
                                                    <option value="WIND">WIND</option>
                                                    <option value="GEOTHERMAL">GEOTHERMAL</option>
                                                    <option value="HYBRID">HYBRID</option>
                                                    <option value="HYDROGEN">HYDROGEN</option>
                                                    <option value="BIOMASS">BIOMASS</option>
                                                    <option value="WASTE TO ENERGY">WASTE TO ENERGY</option>
                                                </select>
                                            </div>

                                        </div>


                                        {{--                                            <div class="col-md-4">--}}

                                        {{--                                                <div class="form-group">--}}
                                        {{--                                                    <label for="sel_suppliers">Engagement</label>--}}
                                        {{--                                                    <select class="form-control"--}}
                                        {{--                                                            id="type"--}}
                                        {{--                                                            name="engagement_number"--}}
                                        {{--                                                            type="text">--}}
                                        {{--                                                            <option value="SOL">SOLAR</option>--}}
                                        {{--                                                            <option value="WIN">WIND</option>--}}
                                        {{--                                                            <option value="GEO">GEOTHERMAL</option>--}}
                                        {{--                                                            <option value="HYD">HYDRO</option>--}}
                                        {{--                                                            <option value="BIO">BIOMASS</option>--}}
                                        {{--                                                            <option value="WAS">WASTE OF ENERGY</option>--}}
                                        {{--                                                    </select>--}}

                                        {{--                                                </div>--}}

                                        {{--                                            </div>--}}
                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="sel_suppliers">Name of IPP</label>
                                                <input type="text" s class="form-control"
                                                       id="capacity1"
                                                       name="name_of_ipp">
                                            </div>

                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label for="sel_suppliers">Application Date</label>

                                                <input type="date" step="any" class="form-control"
                                                       id="capacity1"
                                                       name="date_of_application">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="contract_description">Size of plant</label>
                                                <input class="form-control"
                                                       style="color: black;resize: none;"
                                                       id="contract_period"
                                                       name="size_of_plant" type="number" step="any">
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label for="sel_suppliers">Unit Measure</label>

                                                <input type="text" class="form-control"
                                                        id="contract_period_unit"
                                                        name="size_of_plant_unit" value="MW" readonly>





                                            </div>
                                        </div>


                                    </div>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="contract_currency_id">Province</label>
                                                <select type="text" class="form-control"
                                                        id="sel"
                                                        name="province_id" onchange="togglefunction(event)">
                                                    <option selected disabled hidden>Select Province</option>
                                                    @foreach($provinces as $province)
                                                        <option value="{{$province->id}}">{{$province->province}}</option>
                                                    @endforeach
                                                </select>


                                            </div>
                                        </div>


                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <label for="effective date">District</label>
                                                <select type="text" class="form-control"
                                                        id="district"
                                                        name="district_id" onchange="choice1(this)">
                                                    <option>-- select District --</option>
                                                </select>
                                            </div>

                                        </div>


                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="contract_currency_id">Proposed Connection Point</label>
                                                <select class="form-control" name="proposed_connection_point"
                                                        id="proposed_connection_point"
                                                        onchange="connectionPointsOnchange(this)">
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="contract_start_date">Total Available Capacity</label>
                                                <input type="number"
                                                       class="form-control" step="any"
                                                       id="total_available_capacity"
                                                       name="total_available_capacity">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="contract_currency_id">Committed Capacity</label>
                                                <input type="number" step="any" class="form-control"
                                                       name="committed_capacity"
                                                       id="committed_capacity">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="contract_start_date">Available Capacity</label>
                                                <input type="text"
                                                       class="form-control" step="any"
                                                       id="available_capacity" name="available_capacity" readonly>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="contract_currency_id">Voltage Level</label>
                                                <input type="text" class="form-control"
                                                       name="voltage_level"
                                                       id="voltage_level" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="status">LCOE</label>
                                                <input type="text" name="ipp_tariff"
                                                       id="ipp_tariff"
                                                       class="form-control">

                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="status">Preferred Connection Level</label>
                                                <input type="text" name="preferred_connection_level"
                                                       id="preferred_connection_level"
                                                       class="form-control">

                                            </div>
                                        </div>

                                    </div>



                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="contract_end_date">Date of Connection
                                                    Point(Estimated)</label>
                                                <input type="date"
                                                       class="form-control"
                                                       id="date_of_connection"
                                                       name="date_of_connection"

                                                       data-parsley-required="true"
                                                />
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="contract_start_date">Expiry Date of Connection Point
                                                    Commitment</label>
                                                <input type="date"
                                                       class="form-control"
                                                       id="expiry_connection_point"
                                                       name="expiry_connection_point"

                                                       data-parsley-required="true"
                                                />
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="contract_end_date">Status Of Engagement</label>
                                                <select type="text"
                                                        class="form-control"
                                                        id="status_of_engagement"
                                                        name="status_of_engagement">

                                                    <option selected disabled hidden>Select Status</option>
                                                    @foreach($statuses as $status)
                                                        <option>{{$status->status}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="contract_start_date">Comments</label>
                                                <textarea type="text" step="any"
                                                          class="form-control"
                                                          id="updates_on_engagements"
                                                          name="updates_on_engagements"

                                                          data-parsley-required="true" cols="30" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="contract_end_date">Date of Update</label>
                                                <input type="text"
                                                       class="form-control"
                                                       id="date_of_update"
                                                       name="date_of_update" value="{{date('Y-m-d H:i:s')}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="contract_comment">Updated By</label>
                                                <input class="form-control" type="text"
                                                       id="updated_by"
                                                       name="updated_by" value="{{$user = auth()->user()->name}}"
                                                       readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="contract_comment">Type Of Venture</label>
                                                <select name="type_of_venture" class="form-control">
                                                    <option selected disabled hidden>--Select Venture--</option>
                                                    @foreach($ventures as $venture)
                                                        <option value="{{$venture->id}}">{{$venture->venture_type}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="contract_comment">Contact Person Name</label>
                                                <input type="text" step="any" class="form-control"
                                                       id="contact_person_name"
                                                       name="contact_person_name">


                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="contract_type">Contact Email
                                                </label>
                                                <input type="text" name="contact_person_email" id="contact_person_email"
                                                       class="form-control">

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="status">Contact Number</label>
                                                <input type="number" step="any" name="contact_person_phone"
                                                       id="contact_person_phone"
                                                       class="form-control">

                                            </div>
                                        </div>
                                    </div>



                                    <br>
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 mb-4">
                                            <div class="row">
                                                <div class="col-lg-2 col-sm-4 ">
                                                    <label class="form-control-label">Attach File (optional)</label>
                                                </div>
                                                <div class="col-lg-6 col-sm-4">
                                                    <div class="input-group">
                                                        <input type="file" class="form-control" multiple
                                                               name="doc_type[]" id="receipt"
                                                               title="Upload Contract Files (Optional)">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    {{--                                        <div class="row">--}}
                                    {{--                                            <div class="col-md-12">--}}
                                    {{--                                                <div id="inputFormRow">--}}
                                    {{--                                                    <div class="input-group mb-3">--}}
                                    {{--                                                        <input type="file" name="filenames[]"--}}
                                    {{--                                                               class="form-control m-input">--}}
                                    {{--                                                        <div class="input-group-append">--}}
                                    {{--                                                            <button id="removeRow" type="button" class="btn btn-danger">--}}
                                    {{--                                                                Remove--}}
                                    {{--                                                            </button>--}}
                                    {{--                                                        </div>--}}
                                    {{--                                                    </div>--}}
                                    {{--                                                </div>--}}

                                    {{--                                                <div id="newRow"></div>--}}
                                    {{--                                                <button id="addRow" type="button" class="btn btn-info">Add File</button>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}

                                    {{--                                    </div>--}}

                                    <div class="modal-footer">

                                        <a href="{{ route('independent-producer.index') }}"
                                           class="btn btn-outline-secondary">Cancel</a>
                                        <button type="submit" class="btn btn-outline-success">Submit
                                        </button>

                                    </div>
                            </form>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


@endsection
@push('custom-scripts')
    <script>
        window.provinces = {!! json_encode($provinces->toArray() ) !!};
        let connection_points = [];


        $(document).ready(function () {

            var total_available_capacity = document.getElementById('total_available_capacity').value;
            var committed_capacity = document.getElementById('committed_capacity').value;

            console.log(total_available_capacity)
            console.log(committed_capacity)

            // console.log("test");

            $('#total_available_capacity').keyup(function () {

                var total_available_capacity = document.getElementById('total_available_capacity').value;
                var committed_capacity = document.getElementById('committed_capacity').value;

                $('#available_capacity').val((parseFloat(total_available_capacity) - parseFloat(committed_capacity)))

            });

            $('#committed_capacity').keyup(function () {

                var total_available_capacity = document.getElementById('total_available_capacity').value;
                var committed_capacity = document.getElementById('committed_capacity').value;

                $('#available_capacity').val((parseFloat(total_available_capacity) - parseFloat(committed_capacity)))

            });
        });


        // function (e) {
        //
        //     var district = select.options[select.selectedIndex].getAttribute('data-amount');
        //     // var months=select.options[select.selectedIndex].getAttribute('data-months');
        // }

        function connectionPointsOnchange(e) {

          const voltage =    e.selectedOptions[0].getAttribute('data-voltage')
            $('[name=voltage_level]').val(voltage);

        }

        function choice1(e) {

            const selected_value = e.value;

            let selectedPoints = connection_points.filter(function (connection_point) {
                return parseInt(connection_point.district_id) === parseInt(selected_value);
            });

            if (selectedPoints.length === 0) {
                return
            }

            let options = " <option selected disabled=\"true\"  value=\"\">-- Select Connection Point --</option>";

            $.each(selectedPoints[0].points, function (index1, point) {
                options += "<option data-voltage='" + point.voltage_level + "'  value='" + point.substation + "'  > " + point.substation + " </option> ";

                /* if(district.hasOwnProperty('connection_point')){
                     connection_points.push({'district_id':district.id , 'points': district.connection_point});
                 }*/
            });


            $("#proposed_connection_point").html(options);

        }

        function togglefunction(e) {

            const selected_value = e.target.value;

            let selectedProvince = window.provinces.filter(function (province) {
                return parseInt(province.id) === parseInt(selected_value);
            });

            if (selectedProvince.length === 0) {
                return
            }

            let districtOptions = " <option selected disabled=\"true\"  value=\"\">-- Select District --</option>";

            $.each(selectedProvince[0].districts, function (index1, district) {
                districtOptions += "<option   value='" + district.id + "'  > " + district.district + " </option> ";

                if (district.hasOwnProperty('connection_point')) {
                    connection_points.push({'district_id': district.id, 'points': district.connection_point});
                }
            });


            $("#district").html(districtOptions);

        }

    </script>
@endpush
