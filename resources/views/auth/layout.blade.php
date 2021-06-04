<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta content='width=device-width, initial-scale=1.0' name='viewport'/>
    <title>{{ trans('panel.site_title') }} | @yield('title')</title>
    <meta name="app-locale" content="{{ app()->getLocale() }}">
    <!-- Font Awesome Css -->
    <link rel="stylesheet" href="{{ asset('/assets/css/all.min.css') }}">
    <!-- Bootstrap version 4.4.1 -->
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap-4.4.1.min.css') }}"/>
    <!-- animate css -->
    <link rel="stylesheet" href="{{ asset('/assets/css/animate.css') }}">
    <!-- magnific popup versison 1.1.0 -->
    <link rel="stylesheet" href="{{ asset('/assets/css/magnific-popup-1.1.0.css') }}">
    <!-- Nice Select  -->
    <link rel="stylesheet" href="{{ asset('/assets/css/nice-select-1.0.css') }}">
    <!-- meanmenu version 2.0.7 -->
    <link rel="stylesheet" href="{{ asset('/assets/css/meanmenu-2.0.7.min.css') }}">
    <!-- Slick Version 1.9.0 -->
    <link rel="stylesheet" href="{{ asset('/assets/css/slick-1.9.0.css') }}"/>
    <!-- datetimepicker -->
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap-datepicker.css') }}"/>
    <!-- jQuery Ui for price range slide -->
    <link rel="stylesheet" href="{{ asset('/assets/css/jquery-ui.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('/assets/css/toastr.min.css') }}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}"/>
    <!-- Responsive Css -->
    <link rel="stylesheet" href="{{ asset('/assets/css/responsive.css') }}"/>
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>

<body>
<!-- preloader -->
<div class="loader" id="preLoader">
    <span></span>
    <span></span>
    <span></span>
</div>
<!-- Main Wrap start -->
<main>
    <section class="auth-form gird-view section-bg section-padding">
        <div class="container mt-30">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    @include('auth.header')
                    <div class="sidebar-wrap">
                        <div class="widget fillter-widget">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- modernizr version 3.6.0 -->
<script src="{{asset('/assets/js/modernizr-3.6.0.min.js')}}"></script>
<!-- jQuery Version 1.12.4 -->
<script src="{{asset('/assets/js/jquery-1.12.4.min.js')}}"></script>
<!-- Proper Version 1.16.0-->
<script src="{{asset('/assets/js/popper.min-1.16.0.js')}}"></script>
<!-- Bootstrap Version 4.4.1 -->
<script src="{{asset('/assets/js/bootstrap-4.4.1.min.js')}}"></script>
<!-- Slick Version 1.9.0 -->
<script src="{{asset('/assets/js/slick.min-1.9.0.js')}}"></script>
<!-- isotope version 3.0.6 -->
<script src="{{asset('/assets/js/isotope.pkgd-3.0.6.min.js')}}"></script>
<!-- MeanMenu version 2.0.7-->
<script src="{{asset('/assets/js/meanmenu-2.0.7.min.js')}}"></script>
<!-- Nice select js version 1.0 -->
<script src="{{asset('/assets/js/jquery.nice-select-1.0.min.js')}}"></script>
<!-- wow js version 1.1.3-->
<script src="{{asset('/assets/js/wow-1.1.3.min.js')}}"></script>
<!-- magnific popup version 1.1.0 -->
<script src="{{asset('/assets/js/magnific-popup-1.1.0.min.js')}}"></script>
<!-- jQuery inview  -->
<script src="{{asset('/assets/js/jquery.inview.min.js')}}"></script>
<!-- Waypoints js version 2.0.3 -->
<script src="{{asset('/assets/js/waypoints-2.0.3.min.js')}}"></script>
<!-- counterup js version 1.0 -->
<script src="{{asset('/assets/js/jquery.counterup-1.0.min.js')}}"></script>
<!-- bootstrap datepicker -->
<script src="{{asset('/assets/js/bootstrap-datepicker.js')}}"></script>
<!-- jQuery Ui for price range slide -->
<script src="{{asset('/assets/js/jquery-ui.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('/assets/js/toastr.min.js')}}"></script>
<!-- Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=no-api-key"></script>
<!-- Main JS file -->
<script src="{{asset('/assets/js/main.js')}}"></script>
<!--  App JS   -->
<script src="{{mix('/js/app.js')}}" type="text/javascript"></script>
@livewireScripts
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
