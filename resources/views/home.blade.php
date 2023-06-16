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
                    <h1 class="m-0 text-dark text-uppercase text-green ">RENEWABLE ENERGY MANAGEMENT SYSTEM</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
{{--                        <li class="breadcrumb-item active">System</li>--}}
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
                <div class="col-12 col-sm-6 col-md-2">
                    <div class="info-box mb-3 bg-gray">
                        <a class="info-box-icon elevation-1"
                           href="">
                            <span><i class="fa fa-file"></i></span>
                        </a>
                        <div class="info-box-content">
                            <span class="info-box-text">SOLAR TECHNOLOGY</span>
                            <span class="info-box-number">{{number_format($applications->where('engagement_number','SOLAR')->count())}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <div class="col-12 col-sm-6 col-md-2">
                    <div class="info-box mb-3 bg-gray">
                        <a class="info-box-icon elevation-1"
                           href=" ">
                            <span><i class="fa fa-file"></i></span>
                        </a>
                        <div class="info-box-content">
                            <span class="info-box-text"> WIND TECHNOLOGY</span>
                            <span class="info-box-number">{{number_format($applications->where('engagement_number','WIND')->count())}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-2">
                    <div class="info-box mb-3 bg-gray">
                        <a class="info-box-icon elevation-1"
                           href=" ">
                            <span><i class="fa fa-file"></i></span>
                        </a>
                        <div class="info-box-content">
                            <span class="info-box-text">GEOTHERMAL TECHNOLOGY</span>
                            <span class="info-box-number"> {{number_format($applications->where('engagement_number','GEOTHERMAL')->count())}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-2">
                    <div class="info-box mb-3 bg-gray">
                        <a class="info-box-icon elevation-1"
                           href=" ">
                            <span><i class="fa fa-file"></i></span>
                        </a>
                        <div class="info-box-content">
                            <span class="info-box-text"> HYDRO TECHNOLOGY</span>
                            <span class="info-box-number">{{number_format($applications->where('engagement_number','HYDRO')->count())}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-2">
                    <div class="info-box mb-3 bg-gray">
                        <a class="info-box-icon elevation-1"
                           href=" ">
                            <span><i class="fa fa-file"></i></span>
                        </a>
                        <div class="info-box-content">
                            <span class="info-box-text"> BIOMASS TECHNOLOGY</span>
                            <span class="info-box-number">{{number_format($applications->where('engagement_number','BIOMASS')->count())}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <div class="col-12 col-sm-6 col-md-2">
                    <div class="info-box mb-3 bg-gray">
                        <a class="info-box-icon elevation-1"
                           href=" ">
                            <span><i class="fa fa-file"></i></span>
                        </a>
                        <div class="info-box-content">
                            <span class="info-box-text">WASTE OF ENERGY</span>
                            <span class="info-box-number">{{number_format($applications->where('engagement_number','WASTE OF ENERGY')->count())}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>


                <!-- /.col -->

            </div>
                </div>


            <div class="row">
                <!-- Left col -->
                <div class="col-md-12">
                    <!-- TABLE: LATEST ORDERS -->
                    <div class="card">
                        <div class="card-header border-transparent  bg-gradient-orange " style="opacity: .9">
                            <h3 class="card-title"></h3>  </span>
{{--                                class="badge badge-success right ml-2">22</span>--}}

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
                                        <th>Ref No</th>
                                        <th>Technology</th>
                                        <th>Name Of IPP</th>
                                        <th>Name Of Project</th>
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
                                            <td class="text-left">{{$item->system_ref}}</td>
                                            <td class="text-left">{{$item->engagement_number}}</td>
                                            <td class="text-left">{{$item->name_of_ipp}}</td>
                                            <td class="text-left">{{$item->type_of_venture}}</td>
                                            <td class="text-left">{{$item->date_of_application}}</td>
                                            <td class="text-left">{{$item->size_of_plant}}{{$item->size_of_plant_unit}}</td>
                                            <td class="text-left">{{$item->province->province}}</td>
                                            <td class="text-left">{{$item->districts->district}}
                                            <td class="text-left">{{$item->available_capacity}}</td>
                                            <td class="text-left">{{$item->voltage_level}}</td>
                                            <td class="text-left">{{$item->expiry_connection_point}}</td>
                                            <td class="text-left">{{$item->status_of_engagement}}</td>
                                            <td class="text-left">{{$item->contact_person_name}}</td>


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
       <!--/. container-fluid -->
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
