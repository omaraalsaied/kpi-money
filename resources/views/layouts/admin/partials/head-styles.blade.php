<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>
        {{ __('site.app_name')}} @yield('title')
</title>

<!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('uploads/favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{asset('uploads/favicon.ico')}}" type="image/x-icon">
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>

<link href="{{ asset('assets/css/normalize.css') }}" rel="stylesheet">
<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<!-- Main CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('assets/vali/css/main.css')}}">
<!-- Font Awesome  -->
<link href="{{ asset('assets/css/all.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
<!-- Font Awesome RTL -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/4.1.5/css/flag-icons.min.css"
    integrity="sha512-UwbBNAFoECXUPeDhlKR3zzWU3j8ddKIQQsDOsKhXQGdiB5i3IHEXr9kXx82+gaHigbNKbTDp3VY/G6gZqva6ZQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@if(app()->getLocale()=='ar')
<!-- Bootstrap RTL -->
<link href="{{ asset('assets/css/font-awesome-rtl.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/bootstrap-rtl.min.css') }}" rel="stylesheet">
@else
<style>
    .app-sidebar__user-avatar {
        margin-right: 0px;
    }
</style>
@endif
<style>
    body,
    div,
    p,
    span,
    label,
    button,
    b,
    a,
    td,
    li,
    p,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: 'Noto Naskh Arabic', serif, 'Amiri-Bold' !important;
        line-height: 1.5;
    }

    .app-sidebar__user {
        display: flow-root !important;
        text-align: center !important;
    }

    .card {
        border-radius: 15px;
    }

    .app-sidebar__toggle,
    .fa {
        font-family: "FontAwesome" !important;
    }

    .far,
    .fab,
    .fas {
        font-family: "Font Awesome 5 Free" !important;
    }

    .modal-header {
        background-color: #009688;
    }

    #custom-tabs-two-tabContent,
    #custom-tabs-two-tab {
        margin-left: 2rem !important;
        margin-right: 2rem !important;
    }

    .modal-title,
    .modal-header .close {
        color: #ffffff;
    }

    .app-menu__label {
        text-align: start;
        margin-left: 15px;
    }

    .app-sidebar__user-name,
    .app-sidebar__user-designation,
    .form-group,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    label,
    .row,
    .col,
    .col-md-3,
    .col-md-6,
    .col-md-8,
    .col-md-9,
    .col-md-12 {
        text-align: start;
    }

    p {
        text-indent: 30px;
    }

    .card-header {
        padding: 1rem 1rem;
    }

    .card-title {
        margin-bottom: 3px;
    }
    table thead tr th{
        text-align: center;
    }
    .select2-container{
        width: 100% !important;
    }
</style>
@yield('styles')