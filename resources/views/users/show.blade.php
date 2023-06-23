@extends('layouts.main.master')


@push('custom-styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{ asset('dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endpush


@section('content')



    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        {{--                            @can(config('chilolezo.permissions.users-access'))--}}
                        <li class="breadcrumb-item"><a href="">Users</a></li>
                        {{--                            @endcan--}}
                        <li class="breadcrumb-item active">User Details</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="container-fluid">
            {{--                @if(session()->has('message'))--}}
            {{--                    <div class="row">--}}
            {{--                        <div class="col-12">--}}
            {{--                            <div class="alert alert-success alert-block">--}}
            {{--                                <button type="button" class="close" data-dismiss="alert">×</button>--}}
            {{--                                <p>{{session()->get('message')}}</p>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                @endif--}}
            {{--                @if(session()->has('error'))--}}
            {{--                    <div class="row">--}}
            {{--                        <div class="col-12">--}}
            {{--                            <div class="alert alert-danger alert-block">--}}
            {{--                                <button type="button" class="close" data-dismiss="alert">×</button>--}}
            {{--                                <p>{{session()->get('error')}}</p>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                @endif--}}
            {{--                @if(session()->has('info'))--}}
            {{--                    <div class="row">--}}
            {{--                        <div class="col-12">--}}
            {{--                            <div class="alert alert-danger alert-block">--}}
            {{--                                <button type="button" class="close" data-dismiss="alert">×</button>--}}
            {{--                                <p>{{ $info }}</p>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                @endif--}}
            {{--                @if ($errors->any())--}}
            {{--                    <div class="row">--}}
            {{--                        <div class="col-12">--}}
            {{--                            <div class="alert alert-danger">--}}
            {{--                                <strong>Yangu!</strong> There were some problems with your input.<br><br>--}}
            {{--                                <ul>--}}
            {{--                                    @foreach ($errors->all() as $error)--}}
            {{--                                        <li>{{ $error }}</li>--}}
            {{--                                    @endforeach--}}
            {{--                                </ul>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                @endif--}}


            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title"></h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <b> Name :</b>  <br>
                                                <b> Email :</b>  <br>
                                                <b> Phone :</b>  <br>
                                                <b> Status :</b>  <br>
                                                <b> Division :</b>  <br>
                                                <b> Directorate :</b>  <br>
                                                <b> Logins :</b>  <br>
                                                <b> Last Login :</b>  <br>
                                                <b> Created At : </b>  <br>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6 text-center">
                                    <img class="img-profile rounded-circle" width="25%"
                                         src="{{asset('img/avatar.png')}}">
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    {{--                                        @can(config('chilolezo.permissions.users-destroy'))--}}
                                    {{--                                            @if( auth()->user()->id != $user->id)--}}
                                    <a class="btn btn-outline-danger align-self-end"
                                       data-toggle="modal"
                                       data-sent_data=""
                                       data-target="#modal-delete">Delete</a>
                                    {{--                                            @endif--}}
                                    {{--                                        @endcan--}}
                                    {{--                                        @can(config('chilolezo.permissions.users-edit'))--}}
                                    <a class="btn btn-outline-warning align-self-end"
                                       data-toggle="modal"
                                       data-sent_data=""
                                       data-target="#modal-edit">Edit</a>
                                    {{--                                        @endcan--}}
                                    {{--                                        @can(config('chilolezo.permissions.users-password-reset'))--}}
                                    <a class="btn btn-outline-info align-self-end"
                                       data-toggle="modal"
                                       data-sent_data=""
                                       data-target="#modal-password-change">Password Change</a>
                                    {{--                                        @endcan--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
{{--                <div class="col-sm-12 col-lg-6">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-header d-flex justify-content-between">--}}
{{--                            <div class="header-title">--}}
{{--                                <h4 class="card-title">Attached Meeting Groups</h4>--}}
{{--                            </div>--}}
{{--                            <div class="card-header-toolbar">--}}
{{--                                --}}{{--                                    @can( config('chilolezo.permissions.directory-user-attach') )--}}
{{--                                <a class="btn btn-sm btn-outline-success float-end float-right" href="#"--}}
{{--                                   data-toggle="modal"--}}
{{--                                   title="To add a meeting group to this user"--}}
{{--                                   data-sent_data=""--}}
{{--                                   data-target="#modal-groups">Attach Meeting Group</a>--}}
{{--                                --}}{{--                                    @endcan--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="card-body">--}}
{{--                            <table class="table">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th scope="col">#</th>--}}
{{--                                    <th scope="col">Name</th>--}}
{{--                                    <th scope="col">Company</th>--}}
{{--                                    <th scope="col">Action</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                --}}{{--                                    @foreach($user->directories as $key=>$directory)--}}
{{--                                <tr>--}}
{{--                                    --}}{{--                                            <th scope="row">{{++$key}}</th>--}}
{{--                                    <td></td>--}}
{{--                                    <td></td>--}}
{{--                                    <td>--}}
{{--                                        <div class="row">--}}
{{--                                            --}}{{--                                                    @can( config('chilolezo.permissions.directory-show') )--}}
{{--                                            <a title="view this meeting group"--}}
{{--                                               class="btn btn-outline-success align-self-end m-1"--}}
{{--                                               href=""--}}
{{--                                            ><i class="fa fa-eye"></i></a>--}}
{{--                                            --}}{{--                                                    @endcan--}}
{{--                                            --}}{{--                                                    @can( config('chilolezo.permissions.directory-user-remove') )--}}
{{--                                            <a title="remove this meeting group from user"--}}
{{--                                               class="btn btn-outline-danger align-self-end m-1"--}}
{{--                                               data-toggle="modal"--}}
{{--                                               data-sent_data=""--}}
{{--                                               data-target="#modal-group-detach"><i class="fa fa-trash"></i></a>--}}
{{--                                            --}}{{--                                                    @endcan--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                                --}}{{--                                    @endforeach--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Attached Roles</h4>
                            </div>
                            <div class="card-header-toolbar">
                                {{--                                    @can( config('chilolezo.permissions.roles-attach') )--}}
                                <a class="btn btn-sm btn-outline-success float-end float-right" href="#"
                                   data-toggle="modal"
                                   data-sent_data=""
                                   data-target="#modal-roles">Attach Roles</a>
                                {{--                                    @endcan--}}
                            </div>
                        </div>
                        <div class="card-body">


                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--                                    @foreach($user->roles as $key=>$role)--}}
                                <tr>
                                    <th scope="row"></th>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        {{--                                                @can(config('chilolezo.permissions.roles-access'))--}}
                                        <a class="btn btn-outline-success align-self-end"
                                           href=""
                                        >View</a>
                                        {{--                                                @endcan--}}
                                        {{--                                                @can(config('chilolezo.permissions.roles-detach'))--}}
                                        <a class="btn btn-outline-danger align-self-end"
                                           data-toggle="modal"
                                           data-sent_data=""
                                           data-target="#modal-role-detach">Detach</a>
                                        {{--                                                @endcan--}}
                                    </td>
                                </tr>
                                {{--                                    @endforeach--}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>



    <!-- PASSWORD CHANGE MODAL-->
    <div class="modal fade" id="modal-password-change">
        <div class="modal-dialog modal-small">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Password Reset</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form role="form" method="post" action="">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <input hidden class="form-control" id="pc_id" name="id"
                                       placeholder="Enter Id" required>

                                <div class="form-group">
                                    <label for="otp">New OTP</label>
                                    <input type="text" class="form-control" id="otp" name="otp"
                                           placeholder="Enter One Time Password" required>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        {{--                        @can(config('chilolezo.permissions.users-password-reset'))--}}
                        <button type="submit" class="btn btn-warning">Reset</button>
                        {{--                        @endcan--}}
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /. PASSWORD CHANGE  modal -->



    <!-- DELETE MODAL-->
    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog modal-small">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Delete User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form user="form" method="post" action="">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="text-center">
                                    <h5>Are you sure you want to remove this user from this the system ?</h5>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">User Name</label>
                                    <input readonly type="text" class="form-control" id="delete_name" name="name"
                                           placeholder="Enter Status name" required>
                                    <input hidden class="form-control" id="delete_id" name="id"
                                           placeholder="Enter Status name" required>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        {{--                        @can(config('chilolezo.permissions.users-destroy'))--}}
                        <button type="submit" class="btn btn-danger">Remove</button>
                        {{--                        @endcan--}}
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.DELETE modal -->

    <!-- EDIT  MODAL-->
    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Update User Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form role="form" method="post" action="">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <input hidden class="form-control" id="e_id" name="id"
                                       placeholder="Enter Id" required>
                                <div class="form-group">
                                    <label for="e_name">Name</label>
                                    <input type="text" class="form-control" id="e_name" name="e_name"
                                           placeholder="Enter Name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fam_surname">Email</label>
                                    <input type="text" class="form-control" id="e_email" name="e_email"
                                           placeholder="Enter Email" required>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fam_surname">Phone</label>
                                    <input type="text" class="form-control" id="e_phone" name="e_phone"
                                           value="" placeholder="Enter Phone" required>
                                </div>
                            </div>

                            {{--                            @if( (Auth::user()->hasRole( config('chilolezo.roles.developer') ) ) ||--}}
                            {{--                                     (Auth::user()->hasRole( config('chilolezo.roles.system-admin') ) ))--}}

                            {{--                                @if( (Auth::user()->id != $user->id ) )--}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fam_other_name">Status</label>
                                    <select class="form-control" id="e_status" name="e_status">
                                        <option></option>
                                        {{--                                                @foreach(config('app.status') as $state)--}}
                                        <option></option>
                                        {{--                                                @endforeach--}}
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fam_other_name">User Type</label>
                                    <select class="form-control" id="c_status" name="user_type">
                                        <option></option>
                                        {{--                                                @foreach(config('app.type') as $type)--}}
                                        {{--                                                    @if($type == config('app.type.zadmin'))--}}
                                        {{--                                                        @if( Auth::user()->hasRole( config('chilolezo.roles.developer') ) )--}}
                                        <option></option>
                                        {{--                                                        @endif--}}
                                        {{--                                                    @else--}}
                                        <option></option>
                                        {{--                                                    @endif--}}
                                        {{--                                                @endforeach--}}
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fam_other_name">Company Name</label>
                                    <select class="form-control" id="company_id_edit" name="e_company">
                                        <option value=""></option>
                                        {{--                                                @foreach($companies as $company)--}}
                                        <option value=""></option>
                                        {{--                                                @endforeach--}}
                                    </select>
                                </div>
                            </div>

                            {{--                                @endif--}}

                            {{--                            @endif--}}
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /. EDIT  modal -->


    <!-- CREATE  MODAL-->
    <div class="modal fade" id="modal-create">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Attach Permissions to user</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                {{--                <form user="form" method="post" action="{{route('users.attach.permissions', $user ) }}">--}}
                <form>
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--                                @foreach($permissions as $permission)--}}
                                {{--                                    <tr>--}}
                                {{--                                        <td><input type="checkbox" id="permission_id[]" name="permission_id[]"--}}
                                {{--                                                   value="{{$permission->id}}"></td>--}}
                                {{--                                        <td>{{$permission->name}}</td>--}}
                                {{--                                        <td>{{$permission->slug}}</td>--}}
                                {{--                                    </tr>--}}
                                {{--                                @endforeach--}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Attach</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /. EDIT  modal -->


    <!-- DIRECTORY ATTACH  MODAL-->
    <div class="modal fade" id="modal-groups">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Attach Meeting Groups</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form role="form" method="post" action="">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <input hidden class="form-control" id="attach_id" name="id" value=""
                                       placeholder="Enter Id" required>
                            </div>

                            {{--                            @can(config('chilolezo.permissions.directory-user-attach'))--}}

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fam_other_name">Meeting Groups </label>
                                    <select class="form-control" id="directory_id" name="directory_id">
                                        <option value="">--CHOOSE--</option>
                                        {{--                                            @foreach($all_directories->whereNotIn('id', $user->directories->pluck('id')->toArray() ) as $directory)--}}
                                        <option value=""></option>
                                        {{--                                            @endforeach--}}
                                    </select>
                                </div>
                            </div>
                            {{--                            @endcan--}}

                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        {{--                        @can(config('chilolezo.permissions.directory-user-attach'))--}}
                        <button type="submit" class="btn btn-warning">Attach</button>
                        {{--                        @endcan--}}
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- DIRECTORY ATTACH  MODAL-->


    <!-- DIRECTORY DETACH-->
    <div class="modal fade" id="modal-group-detach">
        <div class="modal-dialog modal-small">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Detach Item</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form user="form" method="post" action="">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="text-center">
                                    <h5>Are you sure you want to remove this meeting group from this user?</h5>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Meeting Group Name</label>
                                    <input readonly type="text" class="form-control" id="delete_name_d" name="name_d"
                                           placeholder="Enter Status name" required>
                                    <input hidden class="form-control" id="delete_id_d" name="directory_id_d"
                                           placeholder="Enter Meeting Group name" required>

                                    <input hidden class="form-control" id="user_id_d" name="user_id_d"
                                           value="" required>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        {{--                        @can( config('chilolezo.permissions.directory-user-remove') )--}}
                        <button type="submit" class="btn btn-danger">Remove</button>
                        {{--                        @endcan--}}
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- DIRECTORY DETACH-->



    <!-- ROLE ATTACH  MODAL-->
    <div class="modal fade" id="modal-roles">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Attach User Role</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form role="form" method="post" action="">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <input hidden class="form-control" id="attach_id" name="id" value=""
                                       placeholder="Enter Id" required>
                            </div>

                            {{--                            @can(config('chilolezo.permissions.roles-attach'))--}}

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fam_other_name">Roles </label>
                                    <select class="form-control" id="role_id" name="role_id">
                                        <option value="">--CHOOSE--</option>
                                        {{--                                            @foreach($all_roles->whereNotIn('id', $user->roles->pluck('id')->toArray() ) as $role)--}}
                                        {{--                                                @if($role->slug == config('chilolezo.roles.developer'))--}}
                                        {{--                                                    @if( Auth::user()->hasRole( config('chilolezo.roles.developer') ) )--}}
                                        <option value=""></option>
                                        {{--                                                    @endif--}}
                                        {{--                                                @else--}}
                                        <option value=""></option>
                                        {{--                                                @endif--}}
                                        {{--                                            @endforeach--}}
                                    </select>
                                </div>
                            </div>
                            {{--                            @endcan--}}

                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        {{--                        @can(config('chilolezo.permissions.roles-attach'))--}}
                        <button type="submit" class="btn btn-warning">Attach</button>
                        {{--                        @endcan--}}
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- ROLE ATTACH  MODAL-->



    <!-- ROLES DETACH-->
    <div class="modal fade" id="modal-role-detach">
        <div class="modal-dialog modal-small">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Detach Item</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form user="form" method="post" action="">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-12">
                                <div class="text-center">
                                    <h5>Are you sure you want to remove this user role from this user?</h5>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">User Role Name</label>
                                    <input readonly type="text" class="form-control" id="delete_name_r" name="name_r"
                                           placeholder="Enter Status name" required>
                                    <input hidden class="form-control" id="delete_id_r" name="role_id_r"
                                           placeholder="Enter Status name" required>

                                    <input hidden class="form-control" id="user_id_r" name="user_id_r"
                                           value="" required>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        {{--                        @can( config('chilolezo.permissions.roles-detach') )--}}
                        <button type="submit" class="btn btn-danger">Remove</button>
                        {{--                        @endcan--}}
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- ROLES DETACH-->

@endsection

@push('custom-script')
    <script>
        $('#modal-group-detach').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient = button.data('sent_data'); // Extract info from data-* attributes

            $('#delete_name_d').val(recipient.name);
            $('#delete_id_d').val(recipient.id);
        });
    </script>
    <script>
        $('#modal-role-detach').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient = button.data('sent_data'); // Extract info from data-* attributes

            $('#delete_name_r').val(recipient.name);
            $('#delete_id_r').val(recipient.id);
        });
    </script>
    <script>
        $('#modal-delete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient = button.data('sent_data'); // Extract info from data-* attributes

            $('#delete_name').val(recipient.name);
            $('#delete_id').val(recipient.id);
        });
    </script>

    <script>
        $('#modal-password-change').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient = button.data('sent_data'); // Extract info from data-* attributes

// $('#pc_name').val(recipient.firstname +' '+ recipient.lastname);
            $('#pc_id').val(recipient.id);
        });
    </script>

    <script>
        $('#modal-edit').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient = button.data('sent_data'); // Extract info from data-* attributes

            $('#e_name').val(recipient.name);
            $('#e_email').val(recipient.email);
            $('#e_id').val(recipient.id);
        });
    </script>
@endpush










