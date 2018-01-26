@extends('layouts.full.full')
@section('body-class','hold-transition skin-yellow sidebar-mini')
@section('style-head')
<link rel="stylesheet" href="{{ asset('/plugins/bootstrap/dist/css/bootstrap.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css')}}">
<!-- Ionicons -->
<link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
<link rel="stylesheet" href="{{ url('dist/css/AdminLTE.min.css')}}">

<link rel="stylesheet" href="{{ url('dist/css/skins/_all-skins.min.css')}}">

 <!-- Google Font -->
 <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

@endsection
@section('content')
    @include('layouts.adminlte.header')
    @include('layouts.adminlte.sidebar-left')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                @yield('title')
            </h1>
            <ol class="breadcrumb">
                @yield('breadcrumb')
                
            </ol>
        </section>

        <section class="content">
            @include('layouts.elements.alert')
            @yield('content-admin')
        </section>
    
    </div>
    @include('layouts.elements.modal')
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2018 <a href="{{url('/')}}"> Studio</a>.</strong> All rights
        reserved.
    </footer>
@endsection

@section('script-end')
@parent
<script src="{{asset('/js/app.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/dist/js/demo.js')}}"></script>
@endsection