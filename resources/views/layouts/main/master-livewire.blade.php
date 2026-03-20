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
    <!-- ZESCO Component Styles (central) -->
    <link rel="stylesheet" href="{{ asset('css/zesco-components.css') }}">

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
