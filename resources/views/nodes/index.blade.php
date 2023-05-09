@extends('layouts.main.master')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Provinces</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">Provinces</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
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
            </div>

            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-3">
                            <form method='post' action="">
                                @csrf
                                <div class="input-group">
{{--                                                                    <input wire:model.debounce.500ms="searchTerm"--}}
{{--                                                                                    <input name="searchTerm"--}}
{{--                                                                                           type="search"--}}
{{--                                                                                           class="form-control m-1"--}}
{{--                                                                                           placeholder="Search contracts">--}}
                                    <div class="input-group-btn">
{{--                                                                                            <button type="submit" class="btn btn-outline-primary m-1">--}}
{{--                                                                                                <i class="fa fa-search"></i>--}}
{{--                                                                                                Search--}}
{{--                                                                                            </button>--}}
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <button class="btn btn-sm bg-gradient-orange float-right" data-toggle="modal"
                            data-target="#modal-create">
                        Add Province
                    </button>


                    <!-- /.card-body -->

                </div>
                <!-- /.card -->
            </div>


            <div class="col-md-12">
                <div class="card">


                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover table-striped">
                            <thead>

                            <tr class="text-nowrap">

                                <th>ID</th>
                                <th>Province</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($province as $item)
                                <tr>
                                    <td >{{$item->id}}</td>
                                    <td >{{$item->province}}</td>

                                    <td >
                                        <a class="btn btn-sm bg-gradient-gray" style="margin: 1px" href="{{route('province.show', $item)}}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="btn btn-sm bg-gradient-gray"  data-toggle="modal" data-target="" style="margin: 1px" title="Edit gym">
                                            <i class="fa fa-pen"></i>
                                        </a>

                                    </td>
                                </tr>

                            @endforeach
                            </tbody>

                            <tfoot>
{{--                            <tr>--}}
{{--                                <td colspan="11"> <span>No data available </span></td>--}}
{{--                            </tr>--}}
                            </tfoot>

                        </table>

                                                        <div style="padding: 20px">
{{--                                                            {!! $province->links() !!}--}}
                                                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.card -->


        <!-- /.content -->

            <!-- NEW MODAL-->
            <div class="modal fade" id="modal-create">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-center">Add Province</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- form start -->
                        <form role="form-new" method="post" action="{{route('province.store')}}">
                            @csrf

                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Province</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control uppercase" name="province" required
                                               placeholder="Province Name">
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
