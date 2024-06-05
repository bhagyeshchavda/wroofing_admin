<!DOCTYPE html>
<html lang="en">
    @php 
        $generalSetting = get_general_settings();
        $siteLogo       = '';
        $siteficon      = '';
        $siteTitle      = '';
        if(!empty($generalSetting)){
            if(isset($generalSetting['gs_ficon'])){
                $siteficon       = $generalSetting['gs_ficon'];
                $siteficon       = $siteficon ? $siteficon : '';
                $siteTitle       = $generalSetting['gs_sitetitle'];
                $siteTitle       = $siteTitle ? $siteTitle : '';
            }
        }
        @endphp
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title') - {{$siteTitle}}</title>
        <!-- Favicon -->
        <link rel="icon" href="{{ asset($siteficon) }}">
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
        <!-- jQuery -->
        <script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
    </head>
    <body class="hold-transition login-page">
        <!-- Begin Page Content -->
	@yield('content')
	<!-- /.container-fluid -->
        <!-- Bootstrap 4 -->
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    </body>
</html>