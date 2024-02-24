<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="Azlansaja">
    <meta name="description" content="Website Finance Sekolah Online By Azlansaja To YSPDI ROBBANI">
    <meta name="keywords" content="aplikasi online, aplikasi finance, finance online, aplikasi finance online, finance sekolah online, aplikasi finance sekolah" inertia="keywords">
    <meta name="robots" content="index,follow" inertia="robots">
    <meta name="distribution" content="global" inertia="distribution">
    <meta name="rating" content="general" inertia="rating">
    <link type="text/plain" rel="author" href="{{ asset('credits.txt') }}" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-title" content="Finance Sekolah Online">
    <meta name="application-name" content="Aplikasi Finance Sekolah Online">
    <title>@yield('title') | Finance Sekolah Online</title>
    <link
        rel="shortcut icon"
        type="image/png"
        href="{{ asset('assets/logo.png') }}"
        />

    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
    @yield('css')

</head>
<body>
@yield('content')
<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
@yield('js')
</body>
</html>
