@extends('layouts.main.master')
@section('content')
    <!-- Content Header (Page header) -->


    <div class="container-fluid">
        <br>
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="text-orange"><strong>{{$province->province}} PROVINCE</strong></h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('province.index')}}">Province</a></li>
                    <li class="breadcrumb-item active">Substations</li>
                </ol>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">

                @if ($message = Session::get('message'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <p>{{ $message }}</p>
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


            </div>
        </div>

        <div class="card card-body">
            <!-- /.card-header -->
            <div class="row-cols-l6-12 row-cols-sm-12   ">
                <a class="btn btn-sm bg-gradient-gray float-right" data-toggle="modal"
                   data-target="#modal-void" style="margin: 1px" title="Add Substation">
                    Add Substation
                </a>


            </div>
        </div>
    </div>



    <!-- Main content -->

    <div class="container-fluid">
        <div class="row mb-2 ">
            <div class="col-md-3 col-sm-12">
                <div class="card mt-lg-3">
                    <div class="card-body">
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered data-table nowrap">
                                <thead class="text-uppercase">
                                <tr>
                                    <th class="text-green">Districts</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($province->districts as $district)
                                    <tr>
                                        <td>
                                            <a href="{{route('province.show',['id'=> $province->id, 'district'=>$district->id])}}">{{$district->district}}</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                {{--                                        <tfoot>--}}
                                {{--                                        <tr>--}}
                                {{--                                            <td><b></b></td>--}}
                                {{--                                            <td><b></b></td>--}}
                                {{--                                            <td><b> {{number_format(($ventures->sum('amount')), 2)}} MW</b></td>--}}
                                {{--                                        </tr>--}}
                                {{--                                        </tfoot>--}}
                            </table>

                        </div>
                        <div class="card-footer">
                            <a class="btn btn-sm bg-gradient-orange" data-toggle="modal"
                               data-target="#modal-district">
                                Add District
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-9 col-sm-12 mt-lg-4">
                <div class="row mb-2">
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="card-header text-green">
                                        <h3 class="card-title"><b>SUBSTATIONS</b></h3>
                                    </div>
                                    <div class="card-body">

                                        <table class="table table-hover table-striped">
                                            <thead>
                                            <tr class="text-nowrap">
                                                <th>Substation</th>
                                                <th>Voltage</th>
                                                <th>Coordinates</th>
                                                <th>Layout</th>
                                                <th>Installed Capacity(MVA)</th>
                                                <th>Substation Capacity(MVA)</th>
                                                <th class="text-center">ACTION</th>
                                            </tr>
                                            </thead>
                                            <tbody id="connectionPoint">
                                            @foreach($my_connectionPoint as $item)
                                                <tr>
                                                    <td class="text-left">{{$item->substation}}</td>
                                                    <td class="text-left">{{$item->voltage_level}}</td>
                                                    <td class="text-left">{{$item->coordinates}}</td>
                                                    <td class="text-left">{{$item->layout}}</td>
                                                    <td class="text-left">{{$item->installed_capacity}}</td>
                                                    <td class="text-left">{{$item->substation_capacity}}</td>
                                                    <td class="text-center">
                                                        <a class="btn btn-sm bg-gradient-gray" data-toggle="modal"
                                                           data-target="#modal-edit-connection-point{{$item->id}}"
                                                           style="margin: 1px" title="Edit Substation Plan">
                                                            <i class="fa fa-pen"></i>
                                                        </a>
                                                        <a class="btn btn-sm bg-gradient-gray" style="margin: 1px"
                                                           data-toggle="modal"
                                                           data-target="#modal-reverse" title="Delete Payment Plan">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
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




    <!-- NEW MODAL-->
    <div class="modal fade" id="modal-district">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Add District</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form role="form-new" method="post" action="{{route('districts.store')}}">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group row">

                            <div class="col-sm-10">
                                <input type="hidden" class="form-control uppercase"
                                       name="province_id" readonly
                                       placeholder="Province Name" value="{{$province->id}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName"
                                   class="col-sm-2 col-form-label">District</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control uppercase"
                                       name="district" required
                                       placeholder="District Name">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-success">Submit
                            </button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- NEW MODAL-->
    <div class="modal fade" id="modal-void">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Add Substation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form role="form-new" method="post" action="{{route('node.store')}}">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group row">

                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" name="district_id"
                                       value="{{$my_district->id  ??''}}" readonly>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName"
                                   class="col-sm-2 col-form-label">Substation</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="substation"
                                       required
                                       placeholder="Payment Description">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Voltage
                                level</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="voltage_level"
                                       placeholder="Enter voltage level">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName"
                                   class="col-sm-2 col-form-label">Layout</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="layout"
                                       placeholder="Enter layout">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName"
                                   class="col-sm-2 col-form-label">Coordinates</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="coordinates"
                                       placeholder="Enter coordinates">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Installed
                                Capacity</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control"
                                       name="installed_capacity"
                                       placeholder="Enter installed capacity">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Substation
                                Capacity</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control"
                                       name="substation_capacity"
                                       placeholder="Enter Substation capacity">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Submit
                            </button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    @foreach($my_connectionPoint as $item)
    <div class="modal fade" id="modal-edit-connection-point{{$item->id}}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Add Substation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form method="post" action="{{route('substations.edit', $item->id)}}">
                    @csrf

                    <div class="modal-body">
{{--                        <div class="form-group row">--}}

{{--                            <div class="col-sm-10">--}}
{{--                                <input type="hidden" class="form-control" name="district_id"--}}
{{--                                       value="{{$my_district->id  ??''}}" readonly>--}}

{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="form-group row">
                            <label for="inputName"
                                   class="col-sm-2 col-form-label">Substation</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="substation"
                                       required value="{{$item->substation}}"
                                       placeholder="Payment Description">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Voltage
                                level</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="voltage_level"
                                       placeholder="Enter voltage level" value="{{$item->voltage_level}}">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="inputName"
                                   class="col-sm-2 col-form-label">Coordinates</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="coordinates"
                                       value="{{$item->coordinates}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName"
                                   class="col-sm-2 col-form-label">Layout</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="layout"
                                       value="{{$item->layout}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Installed
                                Capacity</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control"
                                       name="installed_capacity"
                                       value="{{$item->installed_capacity}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Substation
                                Capacity</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control"
                                       name="substation_capacity"
                                       value="{{$item->substation_capacity}}">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Submit
                            </button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach







@endsection
<script>
    const courses = [{
        "Name": "Communications",
        "Date": "22 April 2022",
        "Code": "CS368"
    },
        {
            "Name": "Programming",
            "Date": "22 April 2021",
            "Code": "CS368"
        },
        {
            "Name": "Networks",
            "Date": "22 April 2002",
            "Code": "CS368"
        }]
    const table = document.getElementsByName("tableBody");
    courses.map(course => {

        console.log(tableBody);
        // let row = table.insertRow();
        // let name = row.insertCell(0);
        // name.innerHTML = course.Name;
        // let date = row.insertCell(1);
        // date.innerHTML = course.Date;
        // let code = row.insertCell(2);
        // code.innerHTML = course.Code;
    });


</script>
