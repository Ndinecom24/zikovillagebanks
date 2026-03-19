@extends('layouts.main.master')


@push('custom-styles')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- Bootstrap Icons for password modal -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

   <style>
    :root {
    --zesco-green: #14984f;
    --zesco-green-dark: #2b9457;
    --zesco-green-light: #00895A;
    --zesco-gold: #FFB223;
    --zesco-gold-dark: #e09a00;
}

/* ===== Dashboard Header ===== */
.dashboard-header {
    background: linear-gradient(135deg, var(--zesco-green-dark) 0%, var(--zesco-green) 60%, var(--zesco-green-light) 100%);
    border-radius: 12px;
    padding: 1.75rem 2rem;
    margin-bottom: 1.5rem;
    color: #fff;
    position: relative;
    overflow: hidden;
}
.dashboard-header::before {
    content: '';
    position: absolute;
    top: -40%;
    right: -10%;
    width: 300px;
    height: 300px;
    background: radial-gradient(ellipse, rgba(255,255,255,0.07) 0%, transparent 70%);
}
.dashboard-header h1 {
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0;
}
.dashboard-header p {
    margin: 0.25rem 0 0;
    opacity: 0.85;
    font-size: 0.9rem;
}
.dashboard-header .welcome-name {
    color: var(--zesco-gold);
    font-weight: 700;
}

/* ===== Technology Cards ===== */
.tech-card {
    border-radius: 12px;
    padding: 1.25rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    background: #fff;
    border: 1px solid #e9ecef;
    transition: all 0.25s ease;
    text-decoration: none !important;
    color: inherit !important;
    margin-bottom: 1rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04);
}
.tech-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 28px rgba(0,0,0,0.12);
    border-color: transparent;
}
.tech-card .tech-icon {
    width: 52px;
    height: 52px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.35rem;
    flex-shrink: 0;
    color: #fff;
}
.tech-card .tech-info {
    flex: 1;
}
.tech-card .tech-label {
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.03em;
    color: #6c757d;
}
.tech-card .tech-count {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1a2332;
}
.tech-card .tech-arrow {
    color: #cbd5e1;
    transition: all 0.2s;
}
.tech-card:hover .tech-arrow {
    color: var(--zesco-gold);
    transform: translateX(4px);
}

/* ===== Icon Gradients ===== */
.bg-solar { background: linear-gradient(135deg, #FFB223, #d97706); } /* orange */
.bg-wind { background: linear-gradient(135deg, #10b981, #059669); }
.bg-geothermal { background: linear-gradient(135deg, #ef4444, #dc2626); }
.bg-hybrid { background: linear-gradient(135deg, #3b82f6, #2563eb); }
.bg-biomass { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
.bg-waste { background: linear-gradient(135deg, #6b7280, #4b5563); }

/* ===== Summary Bar ===== */
.summary-bar {
    background: #fff;
    border-radius: 12px;
    padding: 1rem 1.5rem;
    display: flex;
    gap: 2rem;
    margin-bottom: 1.5rem;
    border: 1px solid #e9ecef;
    flex-wrap: wrap;
}
.summary-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.summary-item .summary-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: var(--zesco-gold);
}
.summary-item .summary-label {
    font-size: 0.8rem;
    color: #6c757d;
}
.summary-item .summary-value {
    font-weight: 700;
    color: #1a2332;
}

/* ===== IPP Table Card ===== */
.ipp-table-card {
    border-radius: 12px;
    border: 1px solid #e9ecef;
    overflow: hidden;
}
.ipp-table-card .card-header {
    background: #fff;
    border-bottom: 1px solid #e9ecef;
    padding: 1rem 1.5rem;
}
.ipp-table-card .card-header h3 {
    font-size: 1.05rem;
    font-weight: 700;
    color: #1a2332;
}

/* ===== BUTTON (ZESCO ORANGE CTA) ===== */
.btn-new-ipp {
    background: linear-gradient(135deg, var(--zesco-gold), #f59e0b);
    color: #fff;
    border-radius: 8px;
    padding: 0.5rem 1.25rem;
    font-weight: 600;
    font-size: 0.85rem;
    transition: all 0.2s;
}
.btn-new-ipp:hover {
    background: linear-gradient(135deg, var(--zesco-gold-dark), #d97706);
    box-shadow: 0 4px 12px rgba(255,178,35,0.35);
    transform: translateY(-1px);
}

/* ===== ACTION BUTTON ===== */
.action-btn {
    border: 1.5px solid var(--zesco-green);
    color: var(--zesco-green);
}
.action-btn:hover {
    background: var(--zesco-green);
    color: #fff;
}

/* ===== TABLE ===== */
#example1 thead th {
    font-size: 0.78rem;
    font-weight: 700;
    color: #64748b;
    border-bottom: 2px solid #e2e8f0;
}
#example1 tbody tr:hover {
    background: #fff7ed; /* subtle orange hover */
}

/* ===== STATUS BADGE ===== */
.status-badge {
    background: rgba(255,178,35,0.15);
    color: #b45309;
}

/* ===== ALERTS ===== */
.dashboard-alert {
    border-radius: 10px;
    padding: 0.875rem 1.25rem;
    font-size: 0.9rem;
}
   </style>
@endpush


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            {{-- Dashboard Hero Header --}}
            <div class="dashboard-header">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <div>
                        <h1><i class="fas fa-bolt mr-2" style="color: var(--zesco-gold)"></i>Renewable Energy Management System</h1>
                        <p>Welcome back, <span class="welcome-name">{{ Auth::user()->name }}</span> &mdash; here's your overview</p>
                    </div>
                    <div>
                        <a href="{{ route('independent-producer.index') }}" class="btn-new-ipp">
                            <i class="fas fa-plus mr-1"></i> New IPP
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            {{-- Alerts --}}
            @if(session()->has('message'))
                <div class="alert alert-success dashboard-alert">
                    <i class="fas fa-check-circle"></i> {!! session()->get('message') !!}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-warning dashboard-alert">
                    <i class="fas fa-exclamation-triangle"></i> {!! session()->get('error') !!}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger dashboard-alert">
                    <i class="fas fa-times-circle"></i>
                    <ul class="mb-0 pl-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Technology Cards Grid --}}
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-4 col-xl-2">
                    <a href="{{ \Illuminate\Support\Facades\URL::signedRoute('home',['engagement_number'=> 'SOLAR']) }}" class="tech-card">
                        <div class="tech-icon bg-solar"><i class="fas fa-sun"></i></div>
                        <div class="tech-info">
                            <div class="tech-label">Solar</div>
                            <div class="tech-count">{{ number_format($applications_counts->where('engagement_number','SOLAR')->count()) }}</div>
                        </div>
                        <i class="fas fa-chevron-right tech-arrow"></i>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 col-xl-2">
                    <a href="{{ \Illuminate\Support\Facades\URL::signedRoute('home',['engagement_number'=> 'WIND']) }}" class="tech-card">
                        <div class="tech-icon bg-wind"><i class="fas fa-wind"></i></div>
                        <div class="tech-info">
                            <div class="tech-label">Wind</div>
                            <div class="tech-count">{{ number_format($applications_counts->where('engagement_number','WIND')->count()) }}</div>
                        </div>
                        <i class="fas fa-chevron-right tech-arrow"></i>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 col-xl-2">
                    <a href="{{ \Illuminate\Support\Facades\URL::signedRoute('home',['engagement_number'=> 'GEOTHERMAL']) }}" class="tech-card">
                        <div class="tech-icon bg-geothermal"><i class="fas fa-industry"></i></div>
                        <div class="tech-info">
                            <div class="tech-label">Geothermal</div>
                            <div class="tech-count">{{ number_format($applications_counts->where('engagement_number','GEOTHERMAL')->count()) }}</div>
                        </div>
                        <i class="fas fa-chevron-right tech-arrow"></i>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 col-xl-2">
                    <a href="{{ \Illuminate\Support\Facades\URL::signedRoute('home',['engagement_number'=> 'HYBRID']) }}" class="tech-card">
                        <div class="tech-icon bg-hybrid"><i class="fas fa-water"></i></div>
                        <div class="tech-info">
                            <div class="tech-label">Hybrid</div>
                            <div class="tech-count">{{ number_format($applications_counts->where('engagement_number','HYBRID')->count()) }}</div>
                        </div>
                        <i class="fas fa-chevron-right tech-arrow"></i>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 col-xl-2">
                    <a href="{{ \Illuminate\Support\Facades\URL::signedRoute('home',['engagement_number'=> 'BIOMASS']) }}" class="tech-card">
                        <div class="tech-icon bg-biomass"><i class="fas fa-leaf"></i></div>
                        <div class="tech-info">
                            <div class="tech-label">Biomass</div>
                            <div class="tech-count">{{ number_format($applications_counts->where('engagement_number','BIOMASS')->count()) }}</div>
                        </div>
                        <i class="fas fa-chevron-right tech-arrow"></i>
                    </a>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 col-xl-2">
                    <a href="{{ \Illuminate\Support\Facades\URL::signedRoute('home',['engagement_number'=> 'WASTE TO ENERGY']) }}" class="tech-card">
                        <div class="tech-icon bg-waste"><i class="fas fa-charging-station"></i></div>
                        <div class="tech-info">
                            <div class="tech-label">Waste to Energy</div>
                            <div class="tech-count">{{ number_format($applications_counts->where('engagement_number','WASTE TO ENERGY')->count()) }}</div>
                        </div>
                        <i class="fas fa-chevron-right tech-arrow"></i>
                    </a>
                </div>
            </div>

            {{-- Summary Bar --}}
            <div class="summary-bar">
                <div class="summary-item">
                    <div class="summary-dot" style="background: var(--zesco-green)"></div>
                    <span class="summary-label">Total IPPs</span>
                    <span class="summary-value">{{ number_format($applications_counts->count()) }}</span>
                </div>
                <div class="summary-item">
                    <div class="summary-dot" style="background: var(--zesco-gold)"></div>
                    <span class="summary-label">Showing</span>
                    <span class="summary-value">{{ number_format($applications->count()) }}</span>
                </div>
            </div>

            {{-- IPP Data Table --}}
            <div class="card ipp-table-card">
                <div class="card-header">
                    <h3><i class="fas fa-table mr-2" style="color: var(--zesco-green)"></i>Independent Power Producers</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Ref No</th>
                                <th>Technology</th>
                                <th>Name Of IPP</th>
                                <th>Type of Venture</th>
                                <th>Size of Plant [MW]</th>
                                <th>Province</th>
                                <th>District</th>
                                <th>Available Capacity</th>
                                <th>Voltage Level</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($applications as $item)
                                <tr>
                                    <td>{{ $item->system_ref ?? 'N/A' }}</td>
                                    <td>{{ $item->engagement_number ?? 'N/A' }}</td>
                                    <td><strong>{{ $item->name_of_ipp ?? 'N/A' }}</strong></td>
                                    <td>{{ $item->ventures->venture_type ?? 'N/A' }}</td>
                                    <td>{{ $item->size_of_plant ?? 'N/A' }} {{ $item->size_of_plant_unit ?? '' }}</td>
                                    <td>{{ $item->province->province ?? 'N/A' }}</td>
                                    <td>{{ $item->districts->district ?? 'N/A' }}</td>
                                    <td>{{ $item->available_capacity ?? 'N/A' }}</td>
                                    <td>{{ $item->voltage_level ?? 'N/A' }}</td>
                                    <td><span class="status-badge">{{ $item->status_of_engagement ?? 'N/A' }}</span></td>
                                    <td>
                                        <div class="input-group-prepend">
                                            <button type="button" class="action-btn dropdown-toggle" data-toggle="dropdown">
                                                Action
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{ route('independent-producer.show', $item->id) }}">
                                                    <i class="fas fa-eye mr-2 text-muted"></i> View
                                                </a>
                                                <a class="dropdown-item" href="{{ route('independent-producer.show', $item->id) }}">
                                                    <i class="fas fa-edit mr-2 text-muted"></i> Edit
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white border-top" style="border-radius: 0 0 12px 12px;">
                    <a href="{{ route('independent-producer.index') }}" class="btn-new-ipp">
                        <i class="fas fa-plus mr-1"></i> New IPP
                    </a>
                </div>
            </div>

        </div>
        <!--/. container-fluid -->

        @include('password-reset-modal.password_reset_modal')
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
        });

        // Force password change modal on page load
        window.onload = function () {
            var pwd_change = {!! json_encode(config('constants.password_not_changed')) !!};
            var user_pwd_change = {!! json_encode(\Auth::user()->password_changed) !!};
            var user_pwd_ezesco = {!! json_encode(\Auth::user()->password) !!};

            if (Number(pwd_change) == Number(user_pwd_change)) {
                $('#modal-change-password').modal({backdrop: 'static', keyboard: false});
                $('#modal-change-password').modal('show');
            } else if (user_pwd_ezesco == "$2y$10$IEb9UtrGydjucN3uD4VWZ.us5bKNTNxmwUVgpwHWGm.ids9j6q/IC") {
                $('#modal-change-password').modal({backdrop: 'static', keyboard: false});
                $('#modal-change-password').modal('show');
            }
        }
    </script>

@endpush
