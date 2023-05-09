@extends('layouts.main.master')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


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
                    {{--                        @if (count($errors) > 0)--}}
                    {{--                            <div class="alert alert-danger">--}}
                    {{--                                <strong>Whoops!</strong> There were some problems with your input.--}}
                    {{--                                <ul>--}}
                    {{--                                    @foreach ($errors->all() as $error)--}}
                    {{--                                        <li>{{ $error }}</li>--}}
                    {{--                                    @endforeach--}}
                    {{--                                </ul>--}}
                    {{--                            </div>--}}
                    {{--                        @endif--}}

                    <div class="card">

                        <div class="card-body">

                            <a class="btn btn-outline-success float-right" href="{{ route('users.create') }}">
                                    <span class="btn-label">
                                        <i class="fa fa-plus"></i>
                                    </span> Add
                            </a>

                        </div>
                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->

                    <div class="card">
                    {{--                            <div class="card-header">--}}
                    {{--                                <h3 class="card-title"></h3>--}}
                    {{--                            </div>--}}
                    <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-hover table-bordered data-table nowrap">
                                <thead class="text-uppercase">
                                <tr>

                                    <th>NAME</th>
                                    <th>MAN NO</th>
                                    <th>NRC</th>
                                    {{--                                        <th nowrap="true">DOB</th>--}}
                                    <th>GENDER</th>
                                    <th>EMAIL</th>
                                    <th>MOBILE NUMBER</th>
                                    <th>JOB TITLE</th>
                                    <th>DIRECTORATE</th>
                                    <th>LOCATION</th>
                                    <th>STATION</th>
                                    <th>FUNCTIONAL SECTION</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>

@endsection
@push('custom-scripts')
    <script type="text/javascript">

        $(function () {

            var table = $('.data-table').DataTable({
                dom: 'lBfrtip',
                scrollX: true,
                processing: false,
                serverSide: true,
                searching: true,
                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10 rows', '25 rows', '50 rows', 'Show all']
                ],
                order: [[0, 'desc']],
                buttons: [
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    },
                    {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    },

                ],
                ajax: "{{ route('getEmployees') }}",
                columns: [
                    {data: 'status'},
                    {data: 'name'},
                    {data: 'man_no'},
                    {data: 'nrc', searchable: false},
                    // {data: 'dob', searchable: false},
                    {data: 'sex', searchable: false},
                    {data: 'email', searchable: false},
                    {data: 'mobile_no', searchable: false},
                    {data: 'job_title', searchable: false},
                    // {data: 'grade', searchable: false},
                    {data: 'directorate', searchable: false},
                    {data: 'location', searchable: false},
                    {data: 'station', searchable: false},
                    {data: 'functional_section', searchable: false},

                    // {data: 'bu_code', searchable: false},
                    // {data: 'cc_code', searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
            });

        });

    </script>
@endpush
