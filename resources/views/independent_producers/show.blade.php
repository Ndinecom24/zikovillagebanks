@extends('layouts.main.master')

@section('content')


        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Independent Power Producers</h1>
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
                    <div class="col-12">

                        @if ($message = Session::get('message'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                    </div>


                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <a class="btn btn-outline-success float-right"
                                   href="{{route('home')}}">
                                    <i class="fa fa-backward"></i> Back
                                </a>
                                <h4 class="title">IPP DETAILS</h4>

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


                                <div class="card-body">
                                    <form id="form" action="#"
                                          enctype="multipart/form-data"
                                          method="POST"
                                    >
                                        @csrf


                                        <div class="row">

                                            <div class="col-md-6">

                                                <p><b>REFERENCE NUMBER:</b> <span class="text-orange"> {{$item->system_ref}}</span></p>

                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label for="sel_suppliers">Invoiced Services</label>
                                                    <input type="text" class="form-control"
                                                           id="invoiced_services"
                                                           name="invoiced_services"
                                                           value="{{$item->invoiced_services}}" readonly>

                                                </div>

                                            </div>

                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label for="contract_number">Technology</label>
                                                    <input type="text" class="form-control"
                                                           id="technology"
                                                           name="technology" value="{{$item->engagement_number}}" readonly>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">


                                                    <div class="form-group">
                                                        <label for="sel_suppliers">Name of IPP</label>
                                                        <input type="text" step="any" class="form-control"
                                                               id="capacity1"
                                                               name="name_of_ipp" value="{{$item->name_of_ipp}}" readonly>
                                                    </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <label for="sel_suppliers">Application Date</label>

                                                    <input type="text" step="any" class="form-control"
                                                           id="capacity1"
                                                           name="date_of_application"
                                                           value="{{$item->date_of_application}}" readonly>
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
                                                           name="size_of_plant" type="text" step="any"
                                                           value="{{$item->size_of_plant}}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <label for="sel_suppliers">Unit Measure</label>

                                                    <input class="form-control"
                                                    style="color: black;resize: none;"
                                                    id="contract_period"
                                                    name="size_of_plant" type="text" step="any"
                                                    value="{{$item->size_of_plant_unit}}" readonly>



                                                </div>
                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <label for="sel_suppliers">Unit Measure</label>

                                                    <select type="text" class="form-control"
                                                            id="contract_period_unit"
                                                            name="size_of_plant_unit" readonly>
                                                        <option>{{$item->size_of_plant}}</option>


                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="contract_currency_id">Province</label>
                                                    <input type="text" class="form-control"
                                                           id="province"
                                                           name="province" value="{{$item->province->province}}" readonly>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="effective date">District</label>
                                                    <input type="text" class="form-control"
                                                           id="district"
                                                           name="district" value="{{$item->districts->district}}" readonly>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="contract_currency_id">Proposed Connection
                                                        Point</label>
                                                    <textarea class="form-control" name="proposed_connection_point"
                                                              id="proposed_connection_point"
                                                              cols="30"
                                                              rows="3" readonly>{{$item->proposed_connection_point}}</textarea>

                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="contract_start_date">Available Capacity</label>
                                                    <input type="text"
                                                           class="form-control" step="any"
                                                           id="available_capacity"
                                                           name="available_capacity"
                                                           value="{{$item->available_capacity}}" readonly>

                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="contract_currency_id">Voltage Level</label>
                                                    <input type="text" step="any" class="form-control"
                                                           name="voltage_level"
                                                           id="voltage_level" value="{{$item->voltage_level}}" readonly>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="contract_end_date">Date of Connection(
                                                        Estimated)</label>
                                                    <input type="text"
                                                           class="form-control"
                                                           id="date_of_connection"
                                                           name="date_of_connection"
                                                           value="{{$item->date_of_connection}}"
                                                           data-parsley-required="true"
                                                           readonly>

                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="contract_start_date">Expiry Date of Connection Point
                                                        Commitment</label>
                                                    <input type="text"
                                                           class="form-control"
                                                           id="expiry_connection_point"
                                                           name="expiry_connection_point"
                                                           value="{{$item->expiry_connection_point}}"
                                                           data-parsley-required="true"
                                                           readonly>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="contract_end_date">Status Of Engagement</label>
                                                    <input type="text" step="any"
                                                           class="form-control"
                                                           id="status_of_engagement"
                                                           name="status_of_engagement"
                                                           value="{{$item->status_of_engagement}}" readonly>

                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="contract_start_date">Updates with New Engagement</label>
                                                    <input type="text" step="any"
                                                           class="form-control"
                                                           id="updates_on_engagements"
                                                           name="updates_on_engagements"
                                                           value="{{$item->updates_on_engagements}}"
                                                           data-parsley-required="true" readonly>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="contract_end_date">Date of Update</label>
                                                    <input type="text"
                                                           class="form-control"
                                                           id="date_of_update"
                                                           name="date_of_update" value="{{$item->date_of_update}}"
                                                           readonly>

                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="contract_comment">Updated By
                                                        Date</label>
                                                    <input class="form-control" type="text"
                                                           id="updated_by"
                                                           name="updated_by" value="{{$item->updated_by}}" readonly>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="contract_comment">Contact Person Name</label>
                                                    <input type="text" step="any" class="form-control"
                                                           id="contact_person_name"
                                                           name="contact_person_name"
                                                           value="{{$item->contact_person_name}}" readonly>

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="contract_type">Contact Email
                                                    </label>
                                                    <input type="text" name="contact_person_email"
                                                           id="contact_person_email"
                                                           class="form-control"
                                                           value="{{$item->contact_person_email}}" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="status">Contact Number</label>
                                                    <input type="text" step="any" name="contact_person_phone"
                                                           id="contact_person_phone"
                                                           class="form-control" value="{{$item->contact_person_phone}}" readonly>

                                                </div>
                                            </div>

                                        </div>

{{--                                        <div class="modal-footer">--}}
{{--                                            <button type="submit" class="btn btn-outline-success">Update--}}
{{--                                            </button>--}}

{{--                                        </div>--}}

                                        <!-- /.card-body -->
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>


                    <div class="col-md-6 col-lg-6 col-sm-12">
                        {{--  QUOTATION FILES--}}
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-bold text-orange">Contract Files</h4>

                                <a class="float-right" href="#" data-toggle="modal" data-sent_data=""
                                   data-target="#modal-add-quotation">Add File</a>

                            </div>
                            <div class="card-body" style="width:100%;  ">
                                <div class="row">

                                    @foreach($contracts as $item)
                                        <div class="col-lg-12 col-sm-12 mb-3">
                                            <iframe id="" src="{{asset('storage/contracts/'.$item->name)}}"
                                                    style="width:100%; height: 1000px " title="{{$item->name}}"></iframe>
                                            <span> </span>
                                            <span> | </span>
                                            <a href="{{asset('storage/contracts/'.$item->name)}}"
                                               target="_blank">View</a>
                                            <span> | </span>
                                            <a href="#" data-toggle="modal" data-sent_data=""
                                               data-target="#modal-change">Edit</a>
                                            @endforeach
                                    </div>

                                </div>
                            </div>

                        </div>


                    </div>
                </div>

                </form>

                <div class="row">
                    <div class="col-12">
                        <div class="card card-solid">
                            <div class="card-header bg-gradient-orange">
                                <h4 class="card-title"> ASSIGNMENT APPROVALS</h4>
                            </div>
                            <div class="card-body">
                                <nav class="w-1000">
                                    <div class="nav nav-tabs" id="product-tab" role="tablist">

                                        <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab"
                                           href="#product-desc" role="tab" aria-controls="product-desc"
                                           aria-selected="true">Current </a>
                                        <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab"
                                           href="#product-comments" role="tab" aria-controls="product-comments"
                                           aria-selected="false">History</a>
                                    </div>
                                </nav>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="tab-content p-3" id="nav-tabContent">
                                            <div class="tab-pane fade active show" id="product-desc" role="tabpanel"
                                                 aria-labelledby="product-desc-tab">


                                                <div class="row">
                                                    <div class="col-lg-10 col-sm-12">
                                                        <div class="row">
                                                            <div class="col-lg-1 col-sm-12">
                                                                <label class="form-control-label">Reason</label>
                                                            </div>
                                                            <div class="col-lg-11 col-sm-12 mb-2">
                                                        <textarea class="form-control" rows="5" name="reason"
                                                                  required></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-sm-12 text-left ">
                                                        <div id="divSubmit_show">
                                                            <button id="btnSubmit_approve" type="submit" name="approval"
                                                                    class="btn btn-outline-success mr-2 p-2  "
                                                                    value='Approved'>APPROVE
                                                            </button>
                                                            <button id="btnSubmit_reject" type="submit" name="approval"
                                                                    class="btn btn-outline-danger ml-2 p-2  "
                                                                    value='Rejected'>REJECT
                                                            </button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="tab-pane fade" id="product-comments" role="tabpanel"
                                             aria-labelledby="product-comments-tab">
                                            <div class="tab-pane fade active show" id="product-desc" role="tabpanel"
                                                 aria-labelledby="product-desc-tab">
                                                <div class="table-responsive mt-10 ">

                                                    <div class="table-responsive mt-10 ">
                                                        <table id="example11" class="table ">
                                                            <thead>
                                                            <tr>
                                                                <th>User Name</th>
                                                                <th>User Staff-No</th>
                                                                <th>Status From</th>
                                                                <th>Status To</th>
                                                                <th>Action</th>
                                                                <th>Comment</th>
                                                                <th>Updated By</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            {{--                                                                @foreach($assignment->approvals as $approval)--}}
                                                            <tr>


                                                                <td>
                                                                    {{--                                                                            {{$device->device_type->name}}--}}
                                                                </td>
                                                                <td>
                                                                    {{--                                                                    <span class="badge badge-{{$approval->statusFrom->html ?? 'dark'}}">--}}
                                                                    {{--                                                                        {{$approval->statusFrom->name ?? '--'}} </span>--}}
                                                                </td>
                                                                <td>
                                                                    {{--                                                                     <span class="badge badge-{{$approval->statusTo->html ?? 'dark'}}">--}}
                                                                    {{--                                                                        {{$approval->statusTo->name ?? '--'}} </span>--}}
                                                                </td>
                                                                <td>
                                                                    {{--                                                                            {{$approval->action ?? '--'}}--}}
                                                                </td>
                                                                <td>
                                                                    {{--                                                                            {{$approval->comment ?? '--'}}--}}
                                                                </td>
                                                                <td>
                                                                    {{--                                                                            {{$approval->Employee->name ?? '--'}}--}}
                                                                </td>
                                                                <td>
                                                                    {{--                                                                            {{$approval->Employee->staff_no ?? '--'}}--}}
                                                                </td>
                                                            </tr>
                                                            {{--                                                                @endforeach--}}
                                                            </tbody>
                                                        </table>

                                                    </div>


                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->



@endsection
