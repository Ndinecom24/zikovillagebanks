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
                    <h1 class="m-0 text-dark">System User Form</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">System User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main page content -->
    <section class="content">


        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible">
                <p class="lead"> {{session()->get('message')}}</p>
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissible">
                <p class="lead"> {{session()->get('error')}}</p>
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


    <!-- Default box -->
        <div class="card">
            <form name="db2" action="{{route('user.store')}}" method="post">
                @csrf
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12  form-group ">
                            <label for="staff_no">EMPLOYEE STAFF NO: <span class="required">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="staff_no_search"
                                       onChange="myFunc(this.value)" name="staff_no" required maxlength="100" >

                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12  form-group ">
                            <label for="staff_name"> STAFF NAME: <span class="required">*</span></label>
                            <input type="text" class="form-control" id="staff_name_search" name="staff_name"
                                   required  readonly >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-4 col-sm-12  form-group ">
                            <label for="user_unit"> JOB TITLE : <span class="required">*</span></label>
                            <input type="text" class="form-control" id="job_title" name="job_title" readonly required >
                        </div>
                        <div class="col-lg-6 col-md-4 col-sm-12  form-group ">
                            <label for="user_unit"> USER-UNIT / DEPARTMENT : <span class="required">*</span></label>
                            <input type="text" class="form-control" id="user_unit" name="user_unit" readonly required >
                        </div>
                        <div class="col-lg-6 col-md-4 col-sm-12  form-group ">
                            <label for="directorate"> DIRECTORATE: <span class="required">*</span></label>
                            <input type="text" class="form-control" id="directorate" name="directorate" readonly required >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12  form-group ">
                            <label for="mobile_no">MOBILE NUMBER: <span class="required">*</span></label>
                            <input type="text" class="form-control" id="mobile_no" name="mobile_no" required
                                   maxlength="100"
                                   readonly>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12  form-group ">
                            <label for="staff_email"> STAFF EMAIL: <span class="required">*</span></label>
                            <input type="text" class="form-control" id="staff_email" name="staff_email"
                                   required   readonly >
                        </div>
                        <div class="col-4 form-group ">
                            <label for="user_type_id"> SYSTEM ROLE : <span class="required">*</span></label>
                            <select name="user_role_id" id="user_role_id" class="form-control" required >
                                <option value=""> --Choose Role-- </option>
                                {{--                                @foreach ($roles as $row)--}}
                                {{--                                    <option value="{{$row->id}}">{{$row->name}}</option>--}}
                                {{--                                @endforeach--}}
                            </select>
                        </div>
                    </div>

                    <div class="row">
{{--                        <div class="col-4 form-group mt-4">--}}
{{--                            <label for="location_id"> SERVICE DESK: <span class="required">*</span></label>--}}
{{--                            <select name="location_id" id="location_id" class="form-control" required>--}}
{{--                                <option  value=""  >-- Select User's Location --</option>--}}
{{--                                --}}{{--                                @foreach ($locations as $loc)--}}
{{--                                --}}{{--                                    <option value="{{$loc->id}}">{{$loc->name}}</option>--}}
{{--                                --}}{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="col-4 form-group mt-4">--}}
{{--                            <label for="user_type_id"> STATUS ID: <span class="required">*</span></label>--}}
{{--                            <select name="status_id" id="status_id" class="form-control" required >--}}
{{--                                --}}{{--                                @foreach ($statuses as $row)--}}
{{--                                --}}{{--                                    <option value="{{$row->id}}">{{$row->name}}</option>--}}
{{--                                --}}{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
                        <div class="col-4 form-group mt-4">
                            <label for="password"> PASSWORD: <span class="required">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" required
                                   placeholder="User's Default Password">
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div id="submit_button" class="col-12 text-center">
                            {{--                            @can(config('chilolezo.permissions.user_create'))--}}
                            <input class="btn btn-lg btn-success" type="submit" value="Submit"
                                   name="submit_form" class="form-control">
                            {{--                            @endcan--}}
                            <input class="btn btn-lg btn-secondary" type="reset" value="Back"
                                   name="reset_form" class="form-control">
                        </div>
                    </div>
                </div>
                <!-- /.card-footer-->
            </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection


@push('custom-scripts')

    <script>
        function myFunc(val) {
            const route = "{{ route('user.search') }}";
            $.ajax({
                type: 'POST',
                url: route,
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                data: {staff_no: val},
                dataType: 'json',
                encode: true
            })
                .done(function (data) {
                    console.log(data);

                    if (data['success'] === true) {

                        console.log(data);

                        $("#directorate").val(data.employee.directorate);
                        $("#user_unit").val(data.employee.functional_section);
                        $("#staff_name_search").val(data.employee.name);
                        $("#staff_email").val(data.employee.staff_email);
                        $("#mobile_no").val(data.employee.mobile_no);

                    } else if (data['success' === false]) {

                        $("#directorate").val('');
                        $("#user_unit").val('');
                        $("#staff_name_search").val('');
                        $("#staff_email").val('');
                    }

                });
        }
    </script>

@endpush
