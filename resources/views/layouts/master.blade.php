<!DOCTYPE html>
<html lang="en">
<head>
    @php
        $generalSetting = get_general_settings();
        $siteLogo = '';
        $siteficon = '';
        $siteTitle = '';
        if (!empty($generalSetting)) {
            if (isset($generalSetting['gs_ficon'])) {
                $siteLogo = $generalSetting['gs_adminlogo'];
                $siteLogo = $siteLogo ? $siteLogo : '';
                $siteficon = $generalSetting['gs_ficon'];
                $siteficon = $siteficon ? $siteficon : '';
                $siteTitle = $generalSetting['gs_sitetitle'];
                $siteTitle = $siteTitle ? $siteTitle : '';
            }
        }
    @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | {{ $siteTitle }}</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset($siteficon) }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <style>
        .drophere {
            margin: 10px 0px;
        }
        .draghere {
            /* padding: 20px; */
        }
        .ui-draggable-dragging {
            background: rgb(113, 113, 113);
        }
        .hoverClass {
            border: 2px solid red;
            background: black;
        }
        .dropbox {
            border: 1px dashed rgb(153, 153, 153);
            display: flex;
            padding: 50px;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            background-repeat: no-repeat;
        }
    </style>
    <script>
        var APP_URL = "{{ env('APP_URL') }}"
    </script>
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <!-- Start Pages CSS -->
    <link rel="stylesheet" href="{{ asset('backend-admin/pages-script/pages.css') }}">
    <script src="{{ asset('backend-admin/custom-seo/custom-seo.js') }}"></script>
    <script src="{{ asset('backend-admin/pages-script/nestable-jquery.js') }}"></script>
    <script src="{{ asset('backend-admin/pages-script/pages.js') }}"></script>
    <script src="{{ asset('backend-admin/custom-admin.js') }}"></script>
    <script src="{{ asset('backend-admin/filemanager.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <!-- End Pages CSS -->
</head>
<body class="layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        @if (isset($siteLogo))
            <div class="preloader flex-column justify-content-center align-items-center" style="background-color: #fff;">
                <img class="animation__shake" src="{{ asset($siteLogo) }}"
                    alt="{{ $siteTitle }}" height="60" width="250">
            </div>
        @else
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__shake" src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
                    height="60" width="60">
            </div>
        @endif
        <!-- Topbar -->
        @include('common.header')
        <!-- End of Topbar -->
        <!-- Sidebar -->
        @include('common.sidebar')
        <!-- End of Sidebar -->
        <!-- Begin Page Content -->
        @yield('content')
        <!-- /.container-fluid -->
        <!-- Footer -->
        @include('common.footer')
        <!-- End of Footer -->
    </div>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <!--        <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
        <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>-->
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    {{-- <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script> --}}
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    @if (Request::path() == 'admin')
        <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
    @endif
    <style>
        label.error {
            display: flex;
            width: 100%;
            position: relative;
            color: red;
        }
    </style>
</body>
</html>