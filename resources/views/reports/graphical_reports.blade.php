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
                           href="#">
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
                           href="# ">
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
                           href="# ">
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
                           href="# ">
                            <span><i class="fas fa-water"></i></span>
                        </a>
                        <div class="info-box-content">
                            <span class="info-box-text"> HYBRID TECHNOLOGY</span>
                            {{--                            <span class="info-box-number">{{number_format($applications->where('engagement_number','HYDRO')->count())}}</span>--}}
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-2">
                    <div class="info-box mb-3 bg-brown">
                        <a class="info-box-icon elevation-1"
                           href="#">
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
                           >
                            <span><i class="fas fa-charging-station"></i></span>
                        </a>
                        <div class="info-box-content">
                            <span class="info-box-text">WASTE TO ENERGY</span>
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
                    <div class="col-sm-2 border-right">
                        <a href="{{\Illuminate\Support\Facades\URL::signedRoute('graphical.reports',['type_of_venture'=> '1'])}} ">
                            <div class="description-block">
                                <h5 class="description-header"></h5>
                                <span class="description-text">INDEPENDENT POWER PRODUCERS</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-2 border-right">
                        <a href="{{\Illuminate\Support\Facades\URL::signedRoute('graphical.reports',['type_of_venture'=> '1'])}}">
                            <div class="description-block">
                                <h5 class="description-header"></h5>
                                <span class="description-text">CLASSIFIED</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-2 border-right">
                        <a href="{{\Illuminate\Support\Facades\URL::signedRoute('graphical.reports',['type_of_venture'=> '1'])}}">
                            <div class="description-block">
                                <h5 class="description-header"></h5>
                                <span class="description-text">UNCLASSIFIED DEVELOPERS</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-2 border-right">
                        <a href="{{\Illuminate\Support\Facades\URL::signedRoute('graphical.reports',['type_of_venture'=> '22'])}}">
                            <div class="description-block">
                                <h5 class="description-header"></h5>
                                <span class="description-text">ZESCO OWNED</span>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-2 border-right">
                        <a href="{{\Illuminate\Support\Facades\URL::signedRoute('graphical.reports',['type_of_venture'=> '23'])}}">
                            <div class="description-block">
                                <h5 class="description-header"></h5>
                                <span class="description-text">ZESCO JV</span>
                            </div>
                        </a>
                    </div>


                    <div class="col-sm-2 border-right">
                        <a href="{{\Illuminate\Support\Facades\URL::signedRoute('graphical.reports',['type_of_venture'=> '1'])}}">
                            <div class="description-block">
                                <h5 class="description-header"></h5>
                                <span class="description-text">ALL DEVELOPERS</span>
                            </div>
                        </a>
                    </div>


                </div>

            </div>

        </div>
        <div class="row">
            <div class="col-12">


            </div>


            <div class="col-md-4 col-lg-4 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        {{--                            <a class="btn btn-outline-success float-right"--}}
                        {{--                               href="{{route('home')}}">--}}
                        {{--                                <i class="fa fa-backward"></i> Back--}}
                        {{--                            </a>--}}
                        <table class="table table-hover table-bordered data-table nowrap">
                            <thead class="text-uppercase">
                            <tr>
                                <th>Technology</th>
                                <th>Count</th>
                                <th>MW</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ventures as $item)
                                <tr>
                                    <td class="text-left">{{$item->engagement_number}}</td>
                                    <td class="text-left">{{$item->total}}</td>
                                    <td class="text-left">{{$item->amount}}</td>



                                </tr>

                            @endforeach
                            </tbody>
                       <tfoot>
                       <tr>
                       <td><b></b></td>
                       <td><b></b></td>
                       <td><b> {{number_format(($ventures->sum('amount')), 2)}} MW</b></td>
                       </tr>
                       </tfoot>
                        </table>

                    </div>
                    <!-- /.card-header -->

                </div>
            </div>
            <!-- /.card -->


            <div class="col-md-8 col-lg-8 col-sm-12">
                {{--  QUOTATION FILES--}}
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-bold text-orange"></h4>

                        <div id="main" style="width: 1200px;height:400px;"></div>

                    </div>


                </div>

            </div>
        </div>



        <!-- /.row -->
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@push('custom-scripts')
    <script type="text/javascript">
        // Initialize the echarts instance based on the prepared dom
        var ventureType = @json($ventures)

        var chartDom = document.getElementById('main');
        var myChart = echarts.init(chartDom);
        var option;
        var chartData = ventureType.map(function (item) {
            return {
                name: item.engagement_number ,
                value: item.amount
            };
        });
        option = {
            title: {
                text: 'Pie Chart based on types of ventures',
                left: 'center'
            },
            tooltip: {
                trigger: 'item'
            },
            legend: {
                orient: 'vertical',
                left: 'left'
            },
            series: [
                {
                    name: 'Access From',
                    type: 'pie',
                    radius: '60%',
                    data:
                        chartData,
                    emphasis: {
                        itemStyle: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        };

        option && myChart.setOption(option);

    </script>

    {{--<script type="text/javascript">--}}
    {{--    // Initialize the echarts instance based on the prepared dom--}}
    {{--    // import {log} from "../../public/echarts/src/util/log";--}}


    {{--    var incidentTypeByStatus = @json($incidentType_by_status);--}}

{{--        // Access and process the data.--}}
{{--        var chartData = incidentTypeByStatus.map(function (item) {--}}
{{--            return {--}}
{{--                name: item.status_name + ' - ' + item.incident_type_name,--}}
{{--                value: item.total--}}
{{--            };--}}
{{--        });--}}

    {{--    var myChart = echarts.init(document.getElementById('main'));--}}

    {{--    // incidentTypeNames now contains an array of unique incident type names--}}
    {{--    // console.log(incidentTypeNames);--}}

    {{--    // Specify the configuration items and data for the chart--}}
    {{--    var option = {--}}
    {{--        title: {--}}
    {{--            text: 'Incidents by Status and Incident Type'--}}
    {{--        },--}}
    {{--        tooltip: {},--}}
    {{--        legend: {--}}
    {{--            data: ['Incidents']--}}
    {{--        },--}}
    {{--        xAxis: {--}}
    {{--            data: chartData.map(function (item) {--}}
    {{--                return item.name;--}}
    {{--            })--}}
    {{--        },--}}
    {{--        yAxis: {},--}}
    {{--        series: [--}}
    {{--            {--}}
    {{--                name: 'Incidents',--}}
    {{--                type: 'bar',--}}
    {{--                data: chartData.map(function (item) {--}}
    {{--                    return item.value;--}}
    {{--                }),--}}
    {{--            }--}}
    {{--        ]--}}
    {{--    };--}}

    {{--    // Display the chart using the configuration items and data just specified.--}}
    {{--    myChart.setOption(option);--}}

    {{--    // Function to handle resizing--}}
    {{--    function resizeChart() {--}}
    {{--        // Check if myChart is defined--}}
    {{--        if (myChart) {--}}
    {{--            // Resize the chart--}}
    {{--            myChart.resize();--}}
    {{--        }--}}
    {{--    }--}}

    {{--    // Call the resize function on window resize--}}
    {{--    window.addEventListener('resize', resizeChart);--}}
    {{--</script>--}}
@endpush
