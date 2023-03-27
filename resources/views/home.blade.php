@extends('layouts.main.master')


@push('custom-styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endpush


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark text-uppercase text-green ">INDEPENDENT POWER PRODUCERS MANAGEMENT SYSTEM</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">System</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <section class="content">

        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible">
                <p class="lead"> {!! session()->get('message') !!}</p>
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-info alert-dismissible">
                <p class="lead"> {!!  session()->get('error') !!}</p>
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
            <!-- Info boxes -->
            <div class="row">
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3 bg-info">
                        <a class="info-box-icon elevation-1"
                           href="">
                            <span><i class="fa fa-file"></i></span>
                        </a>
                        <div class="info-box-content">
                            <span class="info-box-text">INVOICED SERVICES</span>
                            <span class="info-box-number">00</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3 bg-success">
                        <a class="info-box-icon elevation-1"
                           href=" ">
                            <span><i class="fa fa-file"></i></span>
                        </a>
                        <div class="info-box-content">
                            <span class="info-box-text"> VOLTAGE LEVELS</span>
                            <span class="info-box-number">00</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3 bg-warning">
                        <a class="info-box-icon elevation-1"
                           href=" ">
                            <span><i class="fa fa-file"></i></span>
                        </a>
                        <div class="info-box-content">
                            <span class="info-box-text"> IPP'S</span>
                            <span class="info-box-number"> 00</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3 bg-danger">
                        <a class="info-box-icon elevation-1"
                           href=" ">
                            <span><i class="fa fa-file"></i></span>
                        </a>
                        <div class="info-box-content">
                            <span class="info-box-text"> TERMINATED CONTRACTS</span>
                            <span class="info-box-number">00</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>


                <!-- /.col -->

            </div>
                    <!-- /.info-box -->
                </div>


            <div class="row">
                <!-- Left col -->
                <div class="col-md-12">
                    <!-- TABLE: LATEST ORDERS -->
                    <div class="card">
                        <div class="card-header border-transparent  bg-gradient-orange " style="opacity: .9">
                            <h3 class="card-title">Needs your Attention</h3>  <span
                                class="badge badge-success right ml-2">22</span>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-2">

                            <div class="table-responsive mt-10 ">
                                <table id="example1" class="table ">
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>IPP'S</th>
                                        <th>Updated Dete</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>
                                                value one
                                            </td>
                                            <td>
                                                value one
                                            </td>
                                            <td>
                                                value one
                                            </td>
                                            <td>
                                                value one
                                            </td>
                                            <td>
                                                value one
                                            </td>

                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <a href="{{ route('independent-producer.create') }}"
                               class="btn btn-sm bg-gradient-green float-left">New IPP</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>.
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
@endsection


@push('custom-scripts')

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('dashboard/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{ asset('dashboard/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{ asset('dashboard/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{ asset('dashboard/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

    <!-- page script -->
    <script>
        $(function () {

            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>


@endpush
