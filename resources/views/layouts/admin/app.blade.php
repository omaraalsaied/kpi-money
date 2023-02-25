<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
    @include('layouts.admin.partials.head-styles')
</head>
<body class="app sidebar-mini">
    @include('layouts.admin.partials.header')
    @include('layouts.admin.partials.sidebar')

    <main class="app-content">
        @yield('content')
    </main>{{--
    @include('sweetalert::alert') --}}
    @include('layouts.admin.partials.footer-scripts')
</body>
</html>
