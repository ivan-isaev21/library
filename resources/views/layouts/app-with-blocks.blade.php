<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('page_stylesheets')
</head>

<body>
    @include('layouts.parts.header')

    <main role="main" style="min-height: 88vh;">
        @yield('content')
    </main>

    @include("layouts.parts.footer")

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
        const base_url = "{{config('app.url')}}";
    </script>    
    @yield('page_scripts')
</body>

</html>
