<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('/images/huem/LogoHUEM.ico') }}" type="image/ico" />

    <!-- User Auth -->
    <meta name="user" content="{{ json_encode(Auth::user()->getAllData()) }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script>
        const USUARIO = <?php echo json_encode(Auth::user()->getAllData()) ?>;
    </script>  


    <!-- Scripts -->
    @yield('scripts')
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">


    <!-- Styles -->
    @yield('styles')
    
</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">

<div id="app" class="wrapper">

    <form id="logout-app" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>


    @include('dashboard.menu-top')


    <menu-left></menu-left>
    

    @yield('content')

    
    @include('dashboard.footer')

    
    <button-scroll-top-cero />

</div>

</body>
</html>
