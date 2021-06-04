<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" style="height: auto">
<head>
    <meta charset="utf-8">
    <meta name="app-locale" content="{{ app()->getLocale() }}"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="base-url" content="{{ url('/') }}">
    <!-- Application CSS -->
    <link href="{{mix('/manager/css/app.css')}}" rel="stylesheet">
    <title>{{ trans('panel.site_title') }}</title>
</head>
<body class="hold-transition sidebar-mini" style="height: auto;">
<div id="manager-app"></div>
<!-- Theme -->
<script src="{{mix('/manager/js/theme.js')}}"></script>
<!-- Vendor Scripts -->
<script src="{{mix('/js/manifest.js')}}"></script>
<script src="{{mix('/js/vendor.js')}}"></script>
<!-- Application Script -->
<script src="{{mix('/manager/js/app.js')}}"></script>
</body>
</html>

