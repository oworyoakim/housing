@extends('layout')
@section('title', 'Where to Find Us')
@section('content')
    <h1 class="text-center">@yield('title')</h1>
{{--    <livewire:breadcrumb-section--}}
{{--        :currentPage="'Contacts'"--}}
{{--        :bgImage="'assets/img/bg/breadcrumb-02.jpg'"--}}
{{--    />--}}
    <livewire:contact-us />
    <!-- Map -->
    <section class="contact-map" id="contactMap">
    </section>
    <!-- Map End -->
    <livewire:contact-form />
@endsection
