<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="app-locale" content="{{ app()->getLocale() }}" />
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
    @include('admin.navbar')
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    @include('admin.sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @include('admin.page-header')
        </section>
        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('admin.footer')
</div>
<!-- ./wrapper -->
<!-- Application Script -->
<script src="{{mix('/admin/js/app.js')}}"></script>
@livewireScripts
</body>
</html>

