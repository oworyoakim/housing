<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="app-locale" content="{{ app()->getLocale() }}"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="base-url" content="{{ url('/') }}">
    <!-- Application CSS -->
    <link href="{{mix('/admin/css/app.css')}}" rel="stylesheet">
    @livewireStyles
    <title>{{ trans('panel.site_title') }} | @yield('title')</title>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
@include('manager.navbar')
<!-- /.navbar -->
    <!-- Main Sidebar Container -->
@include('manager.sidebar')
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="mt-0">
                    @yield('content')
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 0.0.1
        </div>
        <strong>Copyright &copy; {{date('Y')}} <a href="{{route('home')}}">{{trans('panel.site_title')}}</a>.</strong>
        All rights
        reserved.
    </footer>
</div>
<!-- Application Script -->
<script src="{{mix('/admin/js/app.js')}}"></script>
@livewireScripts
<script>
    $(document).ready(function (){

    });
</script>
<script>
    @if(session()->has('error'))
    toastr.error("{{session()->get('error')}}");
    @endif
    @if(session()->has('success'))
    toastr.success("{{session()->get('success')}}");
    @endif
    @if(session()->has('warning'))
    toastr.warning("{{session()->get('warning')}}");
    @endif
    @if(session()->has('info'))
    toastr.info("{{session()->get('info')}}");
    @endif
</script>
</body>
</html>

