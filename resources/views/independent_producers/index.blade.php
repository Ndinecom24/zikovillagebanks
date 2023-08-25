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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">IPP's</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->

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

                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-3">
                                        <form method='post' action="">
                                            @csrf
                                            <div class="input-group">
                                                {{--                                                                                                        <input wire:model.debounce.500ms="searchTerm"--}}
                                                <input name="searchTerm"
                                                       type="search"
                                                       class="form-control"
                                                       placeholder="Search contracts">
                                                <div class="input-group-btn">
                                                    <button type="submit" class="btn btn-outline-primary">
                                                        <i class="fa fa-search"></i>
                                                        Search
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                                <div class="row float-right">

                                    <a class="btn btn-outline-success ml-5"
                                       href="{{ route('independent-producer.create') }}">
                                                            <span class="btn-label">
                                                                <i class="fa fa-plus"></i>
                                                            </span> Add
                                    </a>

{{--                                    <a class="btn btn-outline-success float-right"--}}
{{--                                       href="{{route('contract-indexation.import')}}">--}}
{{--                                                            <span class="btn-label">--}}
{{--                                                                <i class="fa fa-file-excel"></i>--}}
{{--                                                            </span> Excel Import--}}
{{--                                    </a>--}}

                                </div>


                            </div>


                            <!-- /.card-body -->

                        </div>
                        <!-- /.card -->
                        {{--                    </div>--}}
                        {{--                </div>--}}

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><b>Power Agreements</b></h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover table-striped">
                                    <thead>
                                    <tr class="text-nowrap">
                                        <th>Ref No</th>
                                        <th>Technology</th>
                                        <th>Name Of IPP</th>
                                        <th>Date of Application</th>
                                        <th>Size of plant [MW]</th>
                                        <th>Province (Location)</th>
                                        <th>District (Location)</th>
                                        <th>Available Capacity</th>
                                        <th>Voltage Level</th>
                                        <th>Expiry Date</th>
                                        <th>Status of Engagement</th>
                                        <th>Contact Person (Name)</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($applications as $item)
                                        <tr>
                                            <td class="text-left">{{$item->system_ref ?? '--No Value--'}}</td>
                                            <td class="text-left">{{$item->engagement_number ?? '--No Value--'}}</td>
                                            <td class="text-left">{{$item->name_of_ipp ??'--No Value--'}}</td>
                                            <td class="text-left">{{$item->date_of_application ??'--No Value--'}}</td>
                                            <td class="text-left">{{$item->size_of_plant}}{{$item->size_of_plant_unit}}</td>
                                            <td class="text-left">{{$item->province->province ??'--No Value--'}}</td>
                                            <td class="text-left">{{$item->districts->district ??'--No Value--'}}
                                            <td class="text-left">{{$item->available_capacity ??'--No Value--'}}</td>
                                            <td class="text-left">{{$item->voltage_level ??'--No Value--'}}</td>
                                            <td class="text-left">{{$item->expiry_connection_point ??'--No Value--'}}</td>
                                            <td class="text-left">{{$item->status_of_engagement ??'--No Value--'}}</td>
                                            <td class="text-left">{{$item->contact_person_name ??'--No Value--'}}</td>


                                            <td class="text-left">
                                                <div class="input-group-prepend">
                                                    <button type="button"
                                                            class="btn btn-outline-success dropdown-toggle"
                                                            data-toggle="dropdown">
                                                        Action <span class="caret"></span>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                           href="{{ route('independent-producer.show',$item) }}">
                                                            View
                                                        </a>
                                                        {{--                                                                                                        <a class="dropdown-item"--}}
                                                        {{--                                                                                                           href="{{ route('contract-indexation.destroy',$item->id) }}">--}}
                                                        {{--                                                                                                            Delete--}}
                                                        {{--                                                                                                        </a>--}}

                                                        <a class="dropdown-item"
                                                           href="{{ route('independent-producer.edit',$item->id) }}">Edit
                                                        </a>
                                                        {{--                                                @if(Auth::user()->user_access_level_id == 0||Auth::user()->user_access_level_id == 1 || Auth::user()->user_access_level_id == 2)--}}
                                                        {{--                                                    <a class="dropdown-item"--}}
                                                        {{--                                                       href="{{ route('contract.ict.edit',$item->id) }}">Edit--}}
                                                        {{--                                                        Contract--}}
                                                        {{--                                                    </a>--}}
                                                        {{--                                                @endif--}}

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        {{--                                            <td colspan="6" class="text-center text-red"><strong>No data--}}
                                        {{--                                                    found</strong>--}}
                                        {{--                                            </td>--}}
                                    </tr>

                                    </tbody>
                                </table>

                                {{--                                <div style="padding: 20px">--}}
                                {{--                                    {!! $contracts->links() !!}--}}
                                {{--                                </div>--}}

                            </div>
                            <!-- /.card-body -->
                        {{--                        </div>--}}
                        <!-- /.card -->
                        </div>
                    </div>

        <!-- /.content -->
    </div>

@endsection
