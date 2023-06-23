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
{{--                            <th>JOB TITLE</th>--}}
{{--                            <th>USER UNIT</th>--}}
{{--                            <th>DIRECTORATE</th>--}}
{{--                            <th>MOBILE NUMBER</th>--}}
{{--                            <th>SYSTEM ROLE</th>--}}
                            <th>ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $item)
                            <tr>


                                <td>{{$item->staff_no}} </td>
                                <td class="text-orange">{{$item->name}}</td>
                                <td class="text-orange">{{$item->email}}</td>
{{--                                <td class="text-orange">{{$item->job_title}}</td>--}}
{{--                                <td class="text-orange">{{$item->user_unit}}</td>--}}
{{--                                <td class="text-orange">{{$item->directorate}}</td>--}}
{{--                                <td class="text-orange">{{$item->mobile_no}}</td>--}}
{{--                                <td class="text-orange">{{$item->user_role_id}}</td>--}}


                                <td>
                                    <a class="btn btn-sm bg-gradient-gray float-left " data-toggle="modal" data-target="#modal-user" style="margin: 1px">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <button class="btn btn-sm bg-gradient-gray float-left" style="margin: 1px"
                                            title="Edit"
                                            data-toggle="modal"
                                            data-sent_data="{&quot;id&quot;:5126,&quot;name&quot;:&quot;MATEMBO  LISIMBA&quot;,&quot;staff_no&quot;:&quot;C70006&quot;,&quot;email&quot;:&quot;MLISHIMBA@ZESCO.CO.ZM&quot;,&quot;avatar&quot;:null,&quot;phone&quot;:&quot;0&quot;,&quot;user_unit_id&quot;:&quot;872&quot;,&quot;user_directorate_id&quot;:&quot;984&quot;,&quot;user_division_id&quot;:&quot;84&quot;,&quot;user_region_id&quot;:null,&quot;location_id&quot;:&quot;223&quot;,&quot;pay_point_id&quot;:&quot;0&quot;,&quot;functional_unit_id&quot;:&quot;307&quot;,&quot;nrc&quot;:&quot;303847\/74\/1&quot;,&quot;contract_type&quot;:&quot;FIXED CONTRACT&quot;,&quot;con_st_code&quot;:&quot;ACT&quot;,&quot;con_wef_date&quot;:&quot;2022-01-31 00:00:00&quot;,&quot;con_wet_date&quot;:&quot;2024-12-30 00:00:00&quot;,&quot;positions_id&quot;:&quot;2311&quot;,&quot;profile_id&quot;:&quot;3&quot;,&quot;type_id&quot;:&quot;2&quot;,&quot;grade_id&quot;:&quot;142&quot;,&quot;total_login&quot;:&quot;2&quot;,&quot;total_forms&quot;:&quot;0&quot;,&quot;email_verified_at&quot;:null,&quot;created_at&quot;:&quot;2022-08-19T14:21:41.000000Z&quot;,&quot;updated_at&quot;:&quot;2022-10-20T08:03:47.000000Z&quot;,&quot;deleted_at&quot;:null,&quot;user_unit_code&quot;:&quot;C1901&quot;,&quot;password_changed&quot;:&quot;0&quot;,&quot;job_code&quot;:&quot;DIRECTOR - CORPORATE SUPPORT SERVICES&quot;,&quot;profile_job_code&quot;:&quot;DIRECTOR - CORPORATE SUPPORT SERVICES&quot;,&quot;profile_unit_code&quot;:&quot;C1901&quot;,&quot;unit_column&quot;:&quot;dr_unit&quot;,&quot;code_column&quot;:&quot;dr_code&quot;,&quot;station&quot;:null,&quot;affiliated_union&quot;:null,&quot;profile_id_delegated&quot;:null,&quot;extension&quot;:&quot;0&quot;,&quot;staff_no_alt&quot;:&quot;C70006&quot;,&quot;user_unit&quot;:{&quot;id&quot;:872,&quot;user_unit_id&quot;:&quot;873&quot;,&quot;user_unit_code&quot;:&quot;C1901&quot;,&quot;user_unit_description&quot;:&quot;CORPORATE SUPPORT SERVICES DIRECTORS OFFICE&quot;,&quot;user_unit_superior&quot;:&quot;C1900&quot;,&quot;user_unit_bc_code&quot;:&quot;15100&quot;,&quot;user_unit_cc_code&quot;:&quot;15111&quot;,&quot;user_unit_status&quot;:&quot;00&quot;,&quot;dr_code&quot;:&quot;DPAP-649&quot;,&quot;dr_unit&quot;:&quot;D3134&quot;,&quot;dm_code&quot;:&quot;PRJMAN&quot;,&quot;dm_unit&quot;:&quot;D3139&quot;,&quot;hod_code&quot;:&quot;MGRUTL&quot;,&quot;hod_unit&quot;:&quot;C1901&quot;,&quot;arm_code&quot;:&quot;0&quot;,&quot;arm_unit&quot;:&quot;0&quot;,&quot;bm_code&quot;:&quot;0&quot;,&quot;bm_unit&quot;:&quot;0&quot;,&quot;ca_code&quot;:&quot;MNACC&quot;,&quot;ca_unit&quot;:&quot;C1207&quot;,&quot;ma_code&quot;:&quot;MNACC&quot;,&quot;ma_unit&quot;:&quot;C1207&quot;,&quot;psa_code&quot;:&quot;ASSACC&quot;,&quot;psa_unit&quot;:&quot;C1207&quot;,&quot;hrm_code&quot;:&quot;MHC-397&quot;,&quot;hrm_unit&quot;:&quot;C1909&quot;,&quot;phro_code&quot;:&quot;MHC-397&quot;,&quot;phro_unit&quot;:&quot;C1909&quot;,&quot;shro_unit&quot;:&quot;0&quot;,&quot;shro_code&quot;:&quot;0&quot;,&quot;audit_code&quot;:&quot;SNRIA&quot;,&quot;audit_unit&quot;:&quot;C1106&quot;,&quot;expenditure_code&quot;:&quot;ASSACC&quot;,&quot;expenditure_unit&quot;:&quot;C1207&quot;,&quot;payroll_code&quot;:&quot;0&quot;,&quot;payroll_unit&quot;:&quot;0&quot;,&quot;security_code&quot;:&quot;SECINS&quot;,&quot;security_unit&quot;:&quot;D9718&quot;,&quot;transport_code&quot;:&quot;0&quot;,&quot;transport_unit&quot;:&quot;0&quot;,&quot;created_at&quot;:&quot;2021-04-05T08:51:44.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-03-09T06:29:16.000000Z&quot;,&quot;sheq_unit&quot;:&quot;0&quot;,&quot;sheq_code&quot;:&quot;0&quot;,&quot;org_id&quot;:&quot;211&quot;,&quot;directorate_id&quot;:&quot;984&quot;,&quot;directorate_name&quot;:&quot;CORPORATE SUPPORT SERVICES DIRECTORATE&quot;,&quot;division_id&quot;:&quot;121&quot;,&quot;division_name&quot;:&quot;CORPORATE SUPPORT SERVICES&quot;,&quot;updated_by_id&quot;:&quot;235&quot;,&quot;updated_by_name&quot;:&quot;SHUBART  NYIMBILI&quot;}}"
                                            data-target="#modal-edit">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm bg-gradient-gray float-left" style="margin: 1px"
                                            title="Delete"
                                            data-toggle="modal"
                                            data-target="#modal-delete5126">
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



    <!-- NEW MODAL-->
    <div class="modal fade" id="modal-user">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Add User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form start -->
                <form role="form-new" method="post" action="{{route('user.store')}}">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Man Number</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="staff_no" required
                                       placeholder="Staff Number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Full Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" required
                                       placeholder="Name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" required
                                       placeholder="Email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" required
                                       placeholder="Password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputExperience"
                                   class="col-sm-2 col-form-label">User Type</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="usertype" required>
                                    <option value="1">System Admin</option>
                                    <option value="2">Can View</option>
                                    <option value="2">Can Edit</option>
                                    {{--                                <option value="3">ordinary</option>--}}

                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-success">Submit
                            </button>

                        </div>
                    </div>
                </form>
            </div>
@endsection
