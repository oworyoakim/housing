<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> @yield('title')</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <meta name="base-url" content="{{ url('/') }}">
        <link rel="stylesheet" href="{{ mix('/admin/css/app.css') }}">
        @livewireStyles
    </head>
    <body class="hold-transition login-page">
        <div class="login-box auth-container">
            @yield('content')
        </div>
        <script src="{{mix('/admin/js/app.js')}}"></script>
        @livewireScripts
    </body>
</html>
