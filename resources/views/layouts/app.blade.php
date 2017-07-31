<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @yield('before-css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    @yield('after-css')
</head>
<body>
<div id="app">
    @include('layouts.partials.nav')

    <div class="container main-container">
        @yield('content')
    </div>

</div>

<!-- Scripts -->
@yield('before-js')
<script src="{{ asset('js/app.js') }}"></script>
@yield('after-js')
</body>
</html>
