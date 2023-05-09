@extends('layouts.main.master')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">

        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible">
                <p class="lead"> {{ session()->get('message') }}</p>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible">
                <p class="lead"> {{ session()->get('error') }}</p>
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


        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <a href="#">
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{ asset('storage/user_avatar/' . $user->avatar) }}" alt="Image not found"
                                         onerror="this.src='{{ asset('dashboard/dist/img/avatar.png') }}';"
                                         title="Click Here to Edit Image"
                                         data-toggle="modal"
                                         data-target="#modal-edit-profile" @endif>
                                </a>
                            </div>

                            <h3 class="profile-username text-center"></h3>

                            <input class="text-muted text-center" name="staff_no">

                            <p class="text-muted text-center">}</p>

                            <ul class="list-group list-group-unbordered mb-3">

                                <li class="list-group-item">
                                    <b>Man Number</b> <a class="float-right"></a>
                                </li>
                                <li class="list-group-item">
                                    <b>NRC</b> <a class="float-right"></a>
                                </li>

                                <li class="list-group-item">
                                    <b>Phone</b> <a class="float-right"></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Extension</b> <a class="float-right"></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right"></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Status</b> <a class="float-right"></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Total Application Forms</b> <a class="float-right"></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Total Logins</b> <a class="float-right"></a>
                                </li>
                            </ul>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- SEARCH FORM -->
                                    <div class="modal-header">
                                        <label>FIND USER</label>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-inline ml-3" method="post"
                                              action="">
                                            @csrf
                                            <div class="input-group input-group-sm">
                                                <input class="form-control form-control-navbar" type="search"
                                                       name="search" placeholder="Enter Man Number/Name"
                                                       aria-label="Enter Search Term">
                                                <div class="input-group-append">
                                                    <button class="btn btn-navbar" type="submit">
                                                        <i class="fas fa-search"> Search User</i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- PROFILE FORM -->
                                    <form role="form-new" method="post"
                                          action="">
                                        @csrf
                                        <div class="modal-header">
                                            <label>PROFILE ASSIGNMENT</label>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Select E-Form</label>
                                                        <select class="form-control select2" id="eform_select"
                                                                name="eform_id" required style="width: 100%;">
                                                            <option value="" selected>Select E-Form</option>

                                                            <option value="">
                                                            </option>

                                                        </select>
                                                    </div>
                                                    <!-- /.form-group -->
                                                </div>
                                                <div class="col-6 ">
                                                    <div class="form-group">
                                                        <label>Select User Profile</label>
                                                        <select class="form-control select2" id="profile_select"
                                                                name="profile" required style="width: 100%;">
                                                            <option value="" selected>Assign Profile</option>
                                                        </select>
                                                    </div>
                                                    <!-- /.form-group -->
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <select class="form-control " id="user_select"
                                                                name="user_id"
                                                                readonly required>
                                                            <option value="">
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <!-- /.form-group -->
                                                </div>
                                                <div class="col-6">

                                                    <button type="submit" class="btn btn-primary">Submit
                                                    </button>

                                                    <button disabled type="submit" class="btn btn-primary">
                                                        Submit
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity"
                                                        data-toggle="tab">Details</a>
                                </li>

                                <li class="nav-item"><a class="nav-link" href="#settings"
                                                        data-toggle="tab">Settings</a>
                                </li>

                                <li class="nav-item"><a class="nav-link " href="#units" data-toggle="tab">My
                                        User-Units</a>

                                <li class="nav-item"><a class="nav-link " href="#workflow" data-toggle="tab">My
                                        Work-flow</a>

                                <li class="nav-item"><a class="nav-link" href="#pass_reset" data-toggle="tab">Password
                                        Reset</a>
                                </li>

                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">

                                <div class="active tab-pane" id="activity">
                                    <!-- Post -->
                                    <div class="post">
                                        <div class="user-block">
                                            <span class="username"> <a href="#">Company</a> </span>
                                        </div>
                                        <!-- /.user-block -->
                                        <div class="row">
                                            <div class="col-6">
                                                <p class="text-muted">
                                                    <b>Directorate:</b>
                                                </p>
                                                <p class="text-muted">
                                                    <b>PayPoint:</b>
                                                </p>
                                                <p class="text-muted"><b>Location:</b>
                                                </p>
                                                <p class="text-muted"><b>Division:</b>
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <p class="text-muted"><b>User
                                                        Unit:</b>

                                                    <a href="" class="text-dark"
                                                       onclick="">
                                                    </a>
                                                <form id="search-form12"
                                                      action=""
                                                      method="post" class="d-none">
                                                    @csrf
                                                </form>


                                                </p>
                                                <p class="text-muted "><b class=" text-orange">User Unit
                                                        Code:</b>  </p>
                                                <p class="text-muted"><b>Business
                                                        Unit:</b>
                                                </p>
                                                <p class="text-muted"><b>Cost
                                                        Center:</b>  </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.post -->
                                    <!-- Post -->
                                    <div class="post">
                                        <div class="user-block">
                                            <span class="username"> <a href="#">Position and Profiles</a> </span>
                                        </div>
                                        <div class="row">

                                            <div class="col-6">
                                                <p class="text-muted"><b>Contract
                                                        Type:</b>  </p>
                                                <p class="text-muted"><b>Grade:</b>
                                                </p>
                                                <p class="text-muted">
                                                    <b>Category:</b>
                                                </p>
                                                <p class="text-muted"><b>User
                                                        Position:</b>  </p>
                                                <p class="text-muted "><b class="text-orange ">Job
                                                        Code:</b>  </p>
                                            </div>

                                            <div class="col-6">
                                                <p class="text-muted"><b>Acting Period
                                                        :</b>

                                                </p>
                                                <p class="text-muted"><b>Acting Grade:</b>

                                                </p>
                                                <p class="text-muted">
                                                    <b>Acting Category:</b>

                                                </p>
                                                <p class="text-muted"><b>
                                                        Acting
                                                        Position:</b>
                                                </p>
                                            </div>

                                        </div>

                                    </div>
                                    <!-- /.post -->
                                    <!-- Post -->
                                    <div class="post">
                                        <div class="user-block">
                                            <span class="username"> <a href="#">PROFILES</a> </span>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <form role="form-remove" method="post"
                                                      action="">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input hidden value=""
                                                               class="form-control select2" id="owner_id"
                                                               name="owner_id"
                                                               required style="width: 100%;">
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="text-green">ACTIVE PROFILES</label>
                                                            <table class="table m-0">
                                                                {{--                                    @endif --}}
                                                                <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th>Code</th>
                                                                    <th>Name</th>
                                                                    <th>Description</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="profiles">


                                                                <tr>
                                                                    <td>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="checkbox"
                                                                                   value=''
                                                                                   id="remove_profiles[]"
                                                                                   name="remove_profiles[]">
                                                                        </div>
                                                                    </td>
                                                                    <td> </td>
                                                                    <td>  </td>
                                                                    <td>  </td>
                                                                    <td><a
                                                                            href="">Sync</a>
                                                                    </td>
                                                                <tr>

                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <button type="submit" class="btn btn-sm btn-warning">
                                                            Remove
                                                        </button>

                                                    </div>
                                                </form>
                                            </div>

                                            <div class="col-6">
                                                <form role="form-remove-delegate" method="post"
                                                      action="">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input hidden value=""
                                                               class="form-control select2" id="owner_id"
                                                               name="owner_id"
                                                               required style="width: 100%;">
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="text-green">DELEGATED PROFILES</label>
                                                            <table class="table m-0">
                                                                {{--                                    @endif --}}
                                                                <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th>Code</th>
                                                                    <th>Name</th>
                                                                    <th>Status</th>
                                                                    <th>Owner</th>
                                                                    <th>Delegating</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="profiles">

                                                                <tr>
                                                                    <td>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="checkbox"
                                                                                   value=''
                                                                                   id="delegated_profiles[]"
                                                                                   name="delegated_profiles[]">
                                                                        </div>
                                                                    </td>
                                                                    <td>  </td>
                                                                    <td>  </td>
                                                                    <td>  </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                <tr>

                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <button type="submit" class="btn btn-sm btn-warning">
                                                            Remove
                                                        </button>

                                                    </div>
                                                </form>
                                            </div>

                                            <div class="col-lg-12 col-sm-12">
                                                <hr>
                                                <label>Delegate Profiles</label>
                                                <div>
                                                    <a class="btn btn-sm bg-gradient-gray float-left "
                                                       style="margin: 1px"
                                                       title="Edit" data-toggle="modal"
                                                       data-target="#modal-profile-delegate">
                                                        Delegate
                                                    </a>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <!-- /.post -->
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="settings">
                                    <form class="form-horizontal" method="post"
                                          action="">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="name" required
                                                       placeholder="Name" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" name="email" required
                                                       placeholder="Email" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Extension</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="phone" required
                                                       placeholder="extension" value="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputjob_code" class="col-sm-2 col-form-label">Job Code</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="job_code"
                                                       placeholder="job_code" value="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputExperience" class="col-sm-2 col-form-label">User
                                                Type</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="user_type_id" required>
                                                    <option value=" ">

                                                    </option>


                                                    <option value=""
                                                    </option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label text-orange ">
                                                User Unit
                                            </label>
                                            <div class="col-sm-10">
                                                <select id="user_unit_new" class="form-control user_unit_new"
                                                        name="user_unit_new">
                                                    <option value=" ">



                                                    </option>
                                                    {{--Auth::user()->type_id == config('constants.user_types.developer')--}}

                                                    <option value="">

                                                    </option>

                                                </select>

                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Man No</label>
                                            <div class="col-sm-10">
                                                <input disabled type="text" class="form-control" name="staff_no"
                                                       required placeholder="Staff No" value="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputExperience" class="col-sm-2 col-form-label">User
                                                Division</label>
                                            <div class="col-sm-10">
                                                <select disabled class="form-control" id="division_select"
                                                        name="user_division_id">
                                                    <option value="">
                                                    </option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group row">

                                            <div class="offset-sm-2 col-sm-4">
                                                <button type="submit" class="btn btn-danger">Update</button>
                                            </div>
                                            <div class="offset-sm-5 col-sm-1" style="align-content: end">
                                                <a href=""
                                                   class="btn btn-default"> Sync <i class="fas fa-sync"></i> </a>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="units">
                                    <!-- Post -->
                                    <div class="post">
                                        {{--                                        <div class="user-block"> --}}
                                        {{--                                            <span class="username"> <a href="#">My Units</a> </span> --}}
                                        {{--                                        </div> --}}
                                        <div class="row">
                                            <div class="col-6">
                                                <form role="form-units" method="post"
                                                      action="">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input hidden value=""
                                                               class="form-control select2" id="owner_id"
                                                               name="owner_id"
                                                               required style="width: 100%;">
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="text-green">ACTIVE UNITS</label>
                                                            <table class="table m-0">
                                                                {{--                                    @endif --}}
                                                                <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th>Name</th>
                                                                    <th>Code</th>
                                                                    <th>BU</th>
                                                                    <th>CC</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="units">


                                                                <tr>
                                                                    <td>
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="checkbox"
                                                                                   value=''
                                                                                   id="transfer_units[]"
                                                                                   name="transfer_units[]">
                                                                        </div>
                                                                    </td>
                                                                    <td>  </td>
                                                                    <td>  </td>
                                                                    <td> </td>
                                                                    <td>  </td>
                                                                <tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-6">
                                                <form role="form-assign_units" method="post"
                                                      action="">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input hidden value=""
                                                               class="form-control select2" id="owner_id"
                                                               name="owner_id"
                                                               required style="width: 100%;">
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label class="text-orange">ASSIGN UNITS</label>
                                                            <div class="col-12">
                                                                <input class="form-control" id="myInput"
                                                                       type="text" placeholder="Search..">
                                                            </div>
                                                        </div>
                                                        <table class="table table-striped">
                                                            <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Code</th>
                                                                <th>Name</th>
                                                                <th>BU</th>
                                                                <th>CC</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="myTable">

                                                            <tr>
                                                                <td>
                                                                    <div class="form-group clearfix">
                                                                        <div class="icheck-warning d-inline">
                                                                            <input type="checkbox"
                                                                                   value=""
                                                                                   id="units[]" name="units[]">

                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><span for="accounts"> <span
                                                                            class="text-gray"></span>
                                                                                </span>
                                                                </td>
                                                                <td><span for="accounts"> <span
                                                                            class="text-gray"></span>
                                                                                </span>
                                                                </td>
                                                                <td><span for="accounts"> <span
                                                                            class="text-gray"></span>
                                                                                </span>
                                                                </td>
                                                                <td><span for="accounts"> <span
                                                                            class="text-gray"></span>
                                                                                </span>
                                                                </td>
                                                            </tr>

                                                            </tbody>
                                                        </table>


                                                        <button type="submit" class="btn btn-sm btn-info">
                                                            Assign
                                                        </button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.post -->
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="workflow">
                                    <!-- Post -->
                                    <div class="post">

                                        <div class="row">
                                            <div class="col-2">
                                                <button class="btn btn-sm btn-outline-success  mb-3"
                                                        onclick="" required
                                                        style="width: 100%;">Search
                                                </button>

                                            </div>
                                            <div class="col-6">
                                                <div id="loader_c_2" style="display: none;">
                                                    <img src=" {{ asset('dashboard/dist/gif/Eclipse_loading.gif') }} "
                                                         width="100px" height="100px">
                                                </div>

                                            </div>

                                            <div class="col-2">
                                                <label>Sync Workflow for : </label>
                                                <a href=""
                                                   onclick="e">
                                                </a>
                                                <form id="search-form123"
                                                      action=""
                                                      method="post" class="d-none">
                                                    @csrf
                                                </form>
                                            </div>

                                            <div class="col-12">
                                                <div id="table_body_div">


                                                    <br> <label class="text-green">Director Approval</label>
                                                    <hr>
                                                    <div id="directors_div">
                                                    </div>


                                                    <br> <label class="text-green">Snr Manager Approval</label>
                                                    <hr>
                                                    <div id="divisional_div">
                                                    </div>


                                                    <br> <label class="text-green">Chief Accountant Approval</label>
                                                    <hr>
                                                    <div id="ca_div">
                                                    </div>


                                                    <br> <label class="text-green">HRM Approval</label>
                                                    <hr>
                                                    <div id="hrm_div">
                                                    </div>


                                                    <br> <label class="text-green">HOD Approval</label>
                                                    <hr>
                                                    <div id="hod_div">
                                                    </div>


                                                    <br> <label class="text-green">Audit Approval</label>
                                                    <hr>
                                                    <div id="audit_div">
                                                    </div>


                                                    <br> <label class="text-green">Expenditure Approval</label>
                                                    <hr>
                                                    <div id="expenditure_div">
                                                    </div>

                                                    <br> <label class="text-green">Management Accountants
                                                        Approval</label>
                                                    <hr>
                                                    <div id="ma_div">
                                                    </div>

                                                    <br> <label class="text-green">Security Approval</label>
                                                    <hr>
                                                    <div id="security_div">
                                                    </div>

                                                    <br> <label class="text-green">Sheq Approval</label>
                                                    <hr>
                                                    <div id="sheq_div">
                                                    </div>

                                                    <br> <label class="text-green">Transport Approval</label>
                                                    <hr>
                                                    <div id="transport_div">
                                                    </div>

                                                    <br> <label class="text-green">Payroll Approval</label>
                                                    <hr>
                                                    <div id="payroll_div">
                                                    </div>

                                                    <br> <label class="text-green">PSA Approval</label>
                                                    <hr>
                                                    <div id="psa_div">
                                                    </div>

                                                    <br> <label class="text-green">PHRO Approval</label>
                                                    <hr>
                                                    <div id="phro_div">
                                                    </div>

                                                    <br> <label class="text-green">Area Manager Approval</label>
                                                    <hr>
                                                    <div id="arm_div">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.post -->
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="pass_reset">
                                    <div>
                                        <!-- form start -->
                                        <form method="POST" action="">
                                            @csrf
                                            <div class="p-4">

                                                <div class="form-group row">
                                                    <label for="password"
                                                           class="col-md-4 col-form-label text-md-right">{{ __('OTP') }}</label>
                                                    <div class="col-md-6">
                                                        <input id="password" type="otp"
                                                               class="form-control @error('otp') is-invalid @enderror"
                                                               name="otp" value="{{ old('otp') }}" required
                                                               autocomplete="otp" autofocus>
                                                        @error('otp')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-0">
                                                    <div class="col-md-8 offset-md-4">
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('Change Password') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
