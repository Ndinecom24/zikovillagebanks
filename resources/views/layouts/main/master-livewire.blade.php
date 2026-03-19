<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Renewable Energy Management System</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dashboard/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{ asset('dashboard/plugins/sweetalert2/sweetalert2.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  {{-- Inline Styles --}}
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
    cursor: pointer;
    user-select: none;
}
.tech-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 28px rgba(0,0,0,0.12);
    border-color: transparent;
}
.tech-card.active {
    border-color: var(--zesco-green);
    box-shadow: 0 4px 16px rgba(20,152,79,0.2);
    background: #f0fdf4;
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
.bg-solar { background: linear-gradient(135deg, #FFB223, #d97706); }
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
    align-items: center;
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
    border: none;
    display: inline-block;
    text-decoration: none !important;
}
.btn-new-ipp:hover {
    background: linear-gradient(135deg, var(--zesco-gold-dark), #d97706);
    box-shadow: 0 4px 12px rgba(255,178,35,0.35);
    transform: translateY(-1px);
    color: #fff;
}

/* ===== ACTION BUTTON ===== */
.action-btn {
    border: 1.5px solid var(--zesco-green);
    color: var(--zesco-green);
    background: transparent;
    border-radius: 6px;
    padding: 0.25rem 0.75rem;
    font-size: 0.82rem;
    font-weight: 600;
    transition: all 0.2s;
}
.action-btn:hover {
    background: var(--zesco-green);
    color: #fff;
}

/* ===== TABLE ===== */
.lw-table thead th {
    font-size: 0.78rem;
    font-weight: 700;
    color: #64748b;
    border-bottom: 2px solid #e2e8f0;
    cursor: pointer;
    user-select: none;
    white-space: nowrap;
}
.lw-table thead th:hover {
    color: var(--zesco-green);
}
.lw-table tbody tr:hover {
    background: #fff7ed;
}

/* ===== STATUS BADGE ===== */
.status-badge {
    background: rgba(255,178,35,0.15);
    color: #b45309;
    padding: 0.2rem 0.6rem;
    border-radius: 6px;
    font-size: 0.8rem;
    font-weight: 600;
    display: inline-block;
}

/* ===== ALERTS ===== */
.dashboard-alert {
    border-radius: 10px;
    padding: 0.875rem 1.25rem;
    font-size: 0.9rem;
}

/* ===== SEARCH BOX ===== */
.lw-search-box {
    position: relative;
    max-width: 320px;
}
.lw-search-box input {
    padding: 0.55rem 0.85rem 0.55rem 2.5rem;
    border-radius: 8px;
    border: 1.5px solid #e2e8f0;
    font-size: 0.875rem;
    transition: border-color 0.2s;
    width: 100%;
}
.lw-search-box input:focus {
    border-color: var(--zesco-green);
    box-shadow: 0 0 0 3px rgba(20,152,79,0.1);
    outline: none;
}
.lw-search-box .search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    pointer-events: none;
}

/* ===== SORT ICON ===== */
.sort-icon {
    font-size: 0.7rem;
    margin-left: 4px;
    opacity: 0.5;
}
.sort-icon.active {
    opacity: 1;
    color: var(--zesco-green);
}

/* ===== FILTER TAG ===== */
.filter-tag {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    background: #ecfdf5;
    border: 1px solid #a7f3d0;
    color: #065f46;
    padding: 0.3rem 0.75rem;
    border-radius: 20px;
    font-size: 0.825rem;
    font-weight: 600;
}
.filter-tag .remove-filter {
    cursor: pointer;
    opacity: 0.6;
    transition: opacity 0.2s;
}
.filter-tag .remove-filter:hover {
    opacity: 1;
}

/* ===== PER PAGE SELECT ===== */
.per-page-select {
    border-radius: 6px;
    border: 1.5px solid #e2e8f0;
    padding: 0.35rem 0.5rem;
    font-size: 0.825rem;
    color: #374151;
}
.per-page-select:focus {
    border-color: var(--zesco-green);
    outline: none;
}

/* ===== LOADING OVERLAY ===== */
.lw-loading-overlay {
    position: absolute;
    inset: 0;
    background: rgba(255,255,255,0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
    border-radius: 12px;
}
</style>


<style>
.timeline-container {
    position: relative;
    border-left: 3px solid #dee2e6;
}

.timeline-step {
    padding-left: 2.5rem;
    position: relative;
}

.timeline-icon {
    position: absolute;
    left: -1.5rem;
    top: 0;
    width: 2.5rem;
    height: 2.5rem;
    line-height: 2.5rem;
    border-radius: 50%;
    text-align: center;
    font-weight: bold;
    font-size: 1rem;
    box-shadow: 0 0 0 4px white;
    z-index: 1;
}

.timeline-arrow {
    position: absolute;
    left: -0.6rem;
    top: 3.5rem;
    height: 10px;
    width: 5px;
    background: #c99a44;
    z-index: 0;
}.timeline-arrow::after {
    content: "";
    position: absolute;
    left: -0.25rem;
    top: 100%; /* places it at the bottom of the line */
    border-width: 7px;
    border-style: solid;
    border-color: #c99a44 transparent transparent transparent;
}

.timeline-content {
    margin-left: 2.5rem;
}
</style>


    @include('layouts.main.zesco-layout-styles')
    @stack('custom-styles')
    @livewireStyles
</head>
<body class="hold-transition sidebar-dark-secondary sidebar-mini sidebar-collapse layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <!-- Navbar -->
@include('layouts.main.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
@include('layouts.main.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        {{$slot}}
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    @include('layouts.main.footer')

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('dashboard/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{ asset('dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dashboard/dist/js/adminlte.js')}}"></script>
<script src="{{ asset('dashboard/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>

<!-- PAGE PLUGINS -->
<script>
    // Table Util
    window.Table = {
        addRow: function (tableSelector, rowCount, skipBottom) {
            rowCount = rowCount || 1;
            skipBottom = skipBottom || 0;
            let tableLastRow = tableSelector.find('tr[data-parent]').eq((skipBottom + 1) * -1);
            console.log(tableLastRow);

            if (!tableLastRow.get(0)) {
                return null;
            }
            let rowText = tableLastRow.get(0).outerHTML;
            let rows = [];
            for (let a = 0; a < rowCount; a++) {
                rows.push(rowText);
            }
            tableLastRow.after(rows.join(','));
            return tableSelector.find('tbody tr').eq((skipBottom + 1) * -1);
        },
        deleteRow: function (tableRow, skipBottom) {
            let hasDeleted = false;
            skipBottom = skipBottom || 0;
            if (!!tableRow && !!tableRow.find('input,select')) {
                tableRow.find('input,select').val('');
            }
            let rowParent = $(tableRow).parent();
            if (rowParent.children().length > (1 + skipBottom)) {
                $(tableRow).remove();
                hasDeleted = true;
            }
            return hasDeleted;
        },
        clearRows: function (tableSelector, skipBottom) {
            skipBottom = skipBottom || 0;
            let rowCount = tableSelector.find('tbody tr').length;
            tableSelector.find('tbody tr').slice(1, (rowCount - skipBottom)).remove();
            if (!!tableSelector && !!tableSelector.find('tbody tr').find('input,select')) {
                tableSelector.find('tbody tr').find('input,select').val('');
            }
            return tableSelector.find('tbody tr').eq((skipBottom + 1) * -1);
        },

        addRequiredAttClass: function (tableElement) {
            //":disabled,:hidden"
            // make all field mandatory
            $(tableElement).find("tbody").children().map(function (index, row) {
                $(row).find('input[name], select[name]').each(function (i, item) {
                    let val = item.value.replace(/,/g, '');
                    $(item).addClass('required');
                    $(item).attr('required', true);
                });
            });

            return false;
        },

        removeRequiredAttClass: function (tableId, tableElement) {
            tableElement.find("tbody").children().map(function (index, row) {
                $(row).find('input[name], select[name]').each(function (i, item) {
                    let val = item.value.replace(/,/g, '');
                    $(item).removeClass('required error');
                    $(item).closest('label.error').remove();
                    $(item).removeAttr('required');
                });
            });

            return false;
        }
    };

</script>
@stack('custom-scripts')
@livewireScripts
</body>
</html>
