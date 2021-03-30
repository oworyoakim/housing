@extends('layout')
@section('title', 'Rooms')
@section('content')
{{--    <h1>@yield('title')</h1>--}}
{{--    <livewire:breadcrumb-section :currentPage="'Rooms'" />--}}
    <livewire:rooms-grid />
@endsection
