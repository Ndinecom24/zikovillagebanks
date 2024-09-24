@extends('layouts.main.master')
@push('custom-styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{ asset('dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endpush

@section('content')



    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">System Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible">
            <p class="lead"> {{session()->get('error')}}</p>
        </div>
    @endif
    <!-- Main page content -->
    <section class="content">


        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <a class="btn btn-sm bg-gradient-orange float-left" href="{{route('user.create')}}">
                    Add Users
                </a>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fas fa-minus"></i></button>


                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>STAFF NO</th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>DIRECTORATE</th>
                            <th>JOB TITLE</th>
                            <th>TOTAL LOGINS</th>
                            <th>ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $item)
                            <tr>


                                <td>{{$item->staff_no ?? '--'}} </td>
                                <td class="text-orange">{{$item->name ?? '--'}}</td>
                                <td class="text-orange">{{$item->email ?? '--'}}</td>
                                <td class="text-orange">{{$item->directorate ?? '--'}}</td>
                                <td class="text-orange">{{$item->job_title ?? '--'}}</td>
                                <td class="text-orange">{{$item->total_login ?? '--'}}</td>
                                <td>
                                    <a class="btn btn-sm bg-gradient-gray float-left " data-toggle="modal"
                                       data-target="#modal-user" style="margin: 1px">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <button class="btn btn-sm bg-gradient-gray float-left" style="margin: 1px"
                                            title="Edit"
                                            data-toggle="modal"
                                            data-sent_data=""
                                            data-target="#modal-edit">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <a class="btn btn-sm bg-gradient-danger" data-toggle="modal"
                                       data-target="#modal-deactivate">
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

    </section>

    <!-- NEW MODAL-->
    <div class="modal fade" id="modal-deactivate">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Deactivate User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form role="form-new" method="post" action="">
                    @csrf

                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="inputName">ARE YOU SURE YOU WANT TO DEACTIVATE THIS USER?</label>
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

@endsection
