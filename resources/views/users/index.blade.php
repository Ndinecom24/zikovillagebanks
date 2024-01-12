@extends('layouts.main.master')

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
                                    <button class="btn btn-sm bg-gradient-gray float-left" style="margin: 1px"
                                            title="Delete"
                                            data-toggle="modal"
                                            data-target="#modal-delete{{$item->id}}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                        @endforeach

                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </section>



    @include('user-modals.user_delete')
@endsection
