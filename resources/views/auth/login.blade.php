<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('/images/huem/LogoHUEM.ico') }}" type="image/ico" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login | {{ config('app.name', 'Laravel') }}</title>

    

    <!-- Styles -->
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>

    
<div class="container-fluid fondo-login" id="app">

    <div class="div-logo-scpns">
        <img src="{{ asset('images/huem/LogoHUEM.png') }}" class="img-logo" />
    </div>

    @csrf

    <div class="col-xs-10 col-xs-offset-1">
        <router-view></router-view>
    </div>

</div>



<!-- Scripts -->
<script src="{{ asset('js/login.js') }}"></script>

</body>
</html>
