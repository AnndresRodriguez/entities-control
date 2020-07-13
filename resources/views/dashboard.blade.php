@extends('layouts.master')

@section('scripts')
    <script src="{{ mix('js/app.js') }}" defer></script>
@endsection

@section('styles')
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
@endsection


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        
    <!-- CSRF -->
    @csrf
    
    <router-view></router-view> 

</div>

    
@endsection
