@extends('layouts.main.master')


{{--@push('custom-styles')--}}
{{--    <!-- DataTables -->--}}
{{--    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">--}}
{{--@endpush--}}


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark text-uppercase text-green ">REPORTS</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('reports.index')}}">Reports</a></li>
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
                    <div class="info-box mb-3 bg-yellow">
                        <a class="info-box-icon elevation-1"
                           href="{{\Illuminate\Support\Facades\URL::signedRoute('reports.index',['engagement_number'=> 'SOLAR'])}}">
                            <span><i class="fas fa-sun"></i></span>
                        </a>
                        <div class="info-box-content">
                            <span class="info-box-text">SOLAR TECHNOLOGY</span>
{{--                            <span class="info-box-number">{{number_format($applications->where('engagement_number','SOLAR')->count())}}</span>--}}
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <div class="col-12 col-sm-6 col-md-2">
                    <div class="info-box mb-3 bg-green">
                        <a class="info-box-icon elevation-1"
                           href="{{\Illuminate\Support\Facades\URL::signedRoute('reports.index',['engagement_number'=> 'WIND'])}} ">
                            <span><i class="fas fa-wind"></i></span>
                        </a>
                        <div class="info-box-content">
                            <span class="info-box-text"> WIND TECHNOLOGY</span>
{{--                            <span class="info-box-number">{{number_format($applications->where('engagement_number','WIND')->count())}}</span>--}}
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-2">
                    <div class="info-box mb-3 bg-red">
                        <a class="info-box-icon elevation-1"
                           href="{{\Illuminate\Support\Facades\URL::signedRoute('reports.index',['engagement_number'=> 'GEOTHERMAL'])}} ">
                            <span><i class="fas fa-industry"></i></span>
                        </a>
                        <div class="info-box-content">
                            <span class="info-box-text ">GEOTHERMAL TECHNOLOGY</span>
{{--                            <span class="info-box-number"> {{number_format($applications->where('engagement_number','GEOTHERMAL')->count())}}</span>--}}
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-2">
                    <div class="info-box mb-3 bg-blue">
                        <a class="info-box-icon elevation-1"
                           href="{{\Illuminate\Support\Facades\URL::signedRoute('reports.index',['engagement_number'=> 'HYDRO'])}} ">
                            <span><i class="fas fa-water"></i></span>
                        </a>
                        <div class="info-box-content">
                            <span class="info-box-text"> HYDRO TECHNOLOGY</span>
{{--                            <span class="info-box-number">{{number_format($applications->where('engagement_number','HYDRO')->count())}}</span>--}}
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-2">
                    <div class="info-box mb-3 bg-brown">
                        <a class="info-box-icon elevation-1"
                           href="{{\Illuminate\Support\Facades\URL::signedRoute('reports.index',['engagement_number'=> 'BIOMASS'])}} ">
                            <span><i class="fas fa-leaf"></i></span>
                        </a>
                        <div class="info-box-content">
                            <span class="info-box-text"> BIOMASS TECHNOLOGY</span>
{{--                            <span class="info-box-number">{{number_format($applications->where('engagement_number','BIOMASS')->count())}}</span>--}}
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <div class="col-12 col-sm-6 col-md-2">
                    <div class="info-box mb-3 bg-gray">
                        <a class="info-box-icon elevation-1"
                           href="{{\Illuminate\Support\Facades\URL::signedRoute('reports.index',['engagement_number'=> 'WASTE OF ENERGY'])}} ">
                            <span><i class="fas fa-charging-station"></i></span>
                        </a>
                        <div class="info-box-content">
                            <span class="info-box-text">WASTE OF ENERGY</span>
{{--                            <span class="info-box-number">{{number_format($applications->where('engagement_number','WASTE OF ENERGY')->count())}}</span>--}}
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>


                <!-- /.col -->

            </div>
            <!-- /.info-box -->
        </div>


        <div class="card">

            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 border-right">
                        <a   href="">
                            <div class="description-block">
                                <h5 class="description-header"> </h5>
                                <span class="description-text">CLASSIFIED</span>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-6 border-right">
                        <a   href="">
                            <div class="description-block">
                                <h5 class="description-header"> </h5>
                                <span class="description-text">UNCLASSIFED</span>
                            </div>
                        </a>
                    </div>


                </div>

            </div>

        </div>
            <div class="row">
                <div class="col-12">


                </div>


                <div class="col-md-6 col-lg-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
{{--                            <a class="btn btn-outline-success float-right"--}}
{{--                               href="{{route('home')}}">--}}
{{--                                <i class="fa fa-backward"></i> Back--}}
                            </a>
                            <table class="table table-hover table-bordered data-table nowrap">
                                <thead class="text-uppercase">
                                <tr>
                                    <th>Technology</th>
                                    <th>MW</th>



                                </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td class="text-left"></td>
                                        <td class="text-left"></td>

                                    </tr>

                                </tbody>
                            </table>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">




                            <div class="card-body">
                                <!-- /.card-body -->
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /.card -->



                <div class="col-md-6 col-lg-6 col-sm-12">
                    {{--  QUOTATION FILES--}}
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-bold text-orange"></h4>



                        </div>


                    </div>

                </div>
            </div>



        </div>
            <!-- /.row -->
            <!--/. container-fluid -->
    </section>
    <!-- /.content -->
@endsection
