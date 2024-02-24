<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link
        rel="shortcut icon"
        type="image/jpg"
        href="{{ asset('assets/logo.jpg') }}"
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
