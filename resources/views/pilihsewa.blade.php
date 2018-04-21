@extends('layouts.full.full')
@section('body-class','hold-transition skin-yellow sidebar-mini fixed')
@section('style-head')
<link rel="stylesheet" href="{{ asset('/plugins/bootstrap/dist/css/bootstrap.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('/plugins/font-awesome/css/font-awesome.min.css')}}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{ asset('/plugins/Ionicons/css/ionicons.min.css')}}">
<link rel="stylesheet" href="{{ url('assets/adminlte/dist/css/AdminLTE.min.css')}}">

<link rel="stylesheet" href="{{ url('assets/adminlte/dist/css/skins/_all-skins.min.css')}}">

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
@endsection
@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Pilih Menu</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    
                        <div class="box box-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-purple-active">
                                <h3 class="widget-user-username">Rental Mobil</h3>
                                
                            </div>
                            <div class="widget-user-image">
                                
                                <i class="fa fa-car fa-4x"></i>
                            </div>
                            <div class="box-footer">
                                <a href="{{ route('rentalmobil') }}" class="btn btn-flat btn-block btn-primary" href="#">Pilih </a>
                            
                            </div>
                        </div>
                    
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-orange-active">
                                <h3 class="widget-user-username">Reguler</h3>
                                
                            </div>
                            <div class="widget-user-image">
                                <!--<img class="img-circle" src="../dist/img/user1-128x128.jpg" alt="User Avatar">-->
                                <i class="fa fa-taxi fa-4x"></i>
                            </div>
                            <div class="box-footer">
                                <a href="{{ route('rentalmobil') }}" class="btn btn-flat btn-block btn-primary" href="#">Pilih </a>
                                
                            </div>
                        </div>
                    <!-- /.widget-user -->
                </div>
                
                
            </div>
        </div>
    
    </div>
  
@endsection

@section('script-end')
@parent
<script src="{{ asset('/js/app.js') }}"></script>
<script type="text/javascript" src="{{ url('/plugins/jquery-ui/js/jquery-ui.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/adminlte/dist/js/adminlte.min.js')}}"></script>
@endsection