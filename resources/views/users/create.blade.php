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
                    <div class="card card-success card-outline">
                        <form>
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <a href="#">
                                        <img class="profile-user-img img-fluid img-circle"
                                             src="" alt="Image not found"
                                             title="Click Here to Edit Image"
                                             data-toggle="modal"
                                             data-target="#modal-edit-profile">
                                    </a>
                                </div>

                                <h3 class="profile-username text-center"></h3>

                                {{--                            <input class="text-muted text-center form-control" name="staff_no">--}}
                                <select class="form-control text-center"
                                        id="sel_man_no"
                                        name="staff_no"
                                        data-parsley-required="true"
                                        data-parsley-required-message="You must select man number">
                                </select>
                                <div style="text-align:center;">
                                    <label for="man number">Man Number</label>
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
                                <h3 class="text-uppercase text-orange"><b>User Details</b></h3>

                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">

                                <div class="active tab-pane" id="activity">
                                    <!-- Post -->
                                    <div class="post">

                                        <!-- /.user-block -->
                                        <div class="row">
                                            <div class="col-6">

                                                <div class="form-group row">
                                                    <label for="Directorate" class="col-sm-2 col-form-label"><b>Name</b></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="name" id=""
                                                               class="form-control" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="Directorate" class="col-sm-2 col-form-label"><b>NRC</b></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="directorate" id=""
                                                               name="nrc" class="form-control" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="Directorate"
                                                           class="col-sm-2 col-form-label"><b>Phone</b></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" id="" name="phone_no"
                                                               class="form-control" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="Directorate" class="col-sm-2 col-form-label"><b>Extension</b></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="extension" id=""
                                                               class="form-control">
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label for="Directorate"
                                                           class="col-sm-2 col-form-label"><b>Email</b></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="staff_email" id=""
                                                               class="form-control" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="Directorate" class="col-sm-2 col-form-label"><b>Directorate</b></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="directorate" id=""
                                                               class="form-control" readonly>
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label for="Directorate"
                                                           class="col-sm-2 col-form-label"><b>Location</b></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="location" id=""
                                                               class="form-control" readonly>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="col-6">


                                                <div class="form-group row">
                                                    <label for="Directorate"
                                                           class="col-sm-2 col-form-label"><b>Division</b></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="division" id=""
                                                               class="form-control" readonly>
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label for="Directorate"
                                                           class="col-sm-2 col-form-label"><b>Station</b></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="directorate" id=""
                                                               class="form-control" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="Directorate" class="col-sm-2 col-form-label"><b>Business
                                                            Unit</b></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="directorate" id=""
                                                               class="form-control" readonly>
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label for="Directorate" class="col-sm-2 col-form-label"><b>Cost
                                                            Center</b></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="directorate" id=""
                                                               class="form-control" readonly>
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label for="Directorate"
                                                           class="col-sm-2 col-form-label"><b>Usertype</b></label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control">
                                                            <option>MANAGING DIRECTOR</option>
                                                            <option>DIRECTOR</option>
                                                            <option>HEAD RENEWABLE ENERGY</option>
                                                            <option>CHIEF ENGINEER</option>
                                                            <option>EDITOR</option>
                                                            <option>VIEWER</option>

                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-outline-success">Submit
                                            </button>

                                        </div>
                                    </div>
                                    <!-- /.post -->
                                </div>
                                <!-- /.tab-pane -->

                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                </form>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@push('custom-scripts')
    <script>


        $(function () {
            $(".btn-success").click(function(){
                var lsthmtl = $(".clone").html();
                $(".increment").after(lsthmtl);
            });
            $("body").on("click",".btn-danger",function(){
                $(this).parents(".hdtuto").remove();
            });
        });


        // add row
        $("#addRow").click(function () {
            var html = '';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
            html += '<input type="file" name="filenames[]" class="form-control">';
            html += '<div class="input-group-append">';
            html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
            html += '</div>';
            html += '</div>';

            $('#newRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function () {

            $("#sel_man_no").select2({
                theme: 'bootstrap4',
                placeholder: 'Select Man No',
                allowClear: true,

                ajax: {
                    url: "{{route('getManNumbers')}}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term || "",// search term
                            page: params.page || 1
                        };
                    },
                    complete: function (response) {
                        console.log(response);

                        $('#sel_man_no').on('change', function (e) {

                            if (e.handled !== true) {

                                e.handled = true;

                                if (this.value != null || this.value != "") {

                                    $("#loading_email").show();
                                    $("#email").fadeOut();

                                    $.ajax({
                                            url: "{{route('getEmployee')}}",
                                            data: {
                                                man_no: this.value,

                                            },
                                            success: function (response) {
                                                console.log(response)

                                                $('#name').val(response.employee.name);
                                                $('#sex').val(response.employee.sex);
                                                $('#job_title').val(response.employee.job_title);
                                                $('#grade').val(response.employee.grade);
                                                $('#directorate').val(response.employee.directorate);
                                                $('#functional_section').val(response.employee.functional_section);
                                                $('#station').val(response.employee.station);
                                                $('#location').val(response.employee.location);
                                                $('#email').val(response.employee.staff_email);

                                                $("#loading_email").hide();
                                                $("#email").fadeIn();
                                            }
                                        }
                                    );
                                }

                            }

                        });
                    }

                },
                cache: true,
            });

        });


    </script>
@endpush
