@extends('layouts.main.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Substations</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">Substations</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <div class="container-fluid">

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

            <div class="col-md-3">
                <div class="row">
                    <div class="col-12">
                        <div class="card">


                            <div class="card-body">

                                <h5 class="m-0 text-dark text-uppercase text-green ">Province</h5>
                                <BR>
                                <h6><b>{{$province->province}}</b></h6> <p></p>


                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>


                </div>

            </div>
            <div class="col-md-9">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-3">
                                <form method='post' action="">
                                    @csrf
                                    <div class="input-group">

                                    </div>
                                </form>
                            </div>
                        </div>


                        <button class="btn btn-sm bg-gradient-orange float-right" data-toggle="modal"
                                data-target="#modal-district">
                            Add District
                        </button>

                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->
                </div>
                <div class="card">


                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr class="text-nowrap">
                                <th>District</th>
                                <th>Demand Substation</th>
                                <th>Voltage</th>
                                <th>System</th>
                                <th>Layout</th>
                                <th>Installed Capacity(MVA)</th>

                                <th>Substation Capacity(MVA)</th>
                                <th>Status</th>
                                <th class="text-center">ACTION</th>

                            </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td class="text-left"></td>
                                    <td class="text-left"></td>
                                    <td class="text-left"></td>
                                    <td class="text-left"></td>
                                    <td class="text-left"></td>
                                    <td class="text-left"></td>
                                    <td class="text-left"></td>
                                    <td class="text-left"></td>
                                    <td class="text-center">

                                        <a class="btn btn-sm bg-gradient-gray"  data-toggle="modal" data-target="#modal-void" style="margin: 1px" title="Add Substation">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <a class="btn btn-sm bg-gradient-gray"  data-toggle="modal" data-target="" style="margin: 1px" title="Edit Payment Plan">
                                            <i class="fa fa-pen"></i>
                                        </a>

                                        <a class="btn btn-sm bg-gradient-gray" style="margin: 1px"
                                           data-toggle="modal"
                                           data-target="#modal-reverse" titel="Delete Payment Plan">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>


                            </tbody>



                        </table>

                        <div style="padding: 20px">
                            {{--                                    {!! $applications->links() !!}--}}
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>

            </div>


            <!-- /.card -->
        </div>

        <!-- /.content -->
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
                            <label for="inputName" class="col-sm-2 col-form-label">Province</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control uppercase" name="province" readonly
                                       placeholder="Province Name" value="">
                            </div>
                        </div>
                            <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">District</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control uppercase" name="district" required
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
                <form role="form-new" method="post" action="">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">District </label>
                            <div class="col-sm-10">
                                <select type="text" class="form-control" name="district_id" readonly>
                                    <option selected  value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Substation</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="substation" required
                                       placeholder="Payment Description">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Voltage level</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="voltage_level"
                                       placeholder="Enter voltage level">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Layout</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="layout"
                                       placeholder="Enter layout">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Installed Capacity</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="installed_capacity"
                                       placeholder="Enter installed capacity">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Substation Capacity</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="substation_capacity"
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

@endsection
