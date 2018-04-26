@extends('layouts.adminlte.main')
@section('content-admin')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Mobil</h3>
            <div class="box-tools text-right">
                <div class="btn-group">
                    
                    
                </div>
            </div>
            
        </div>
            <!-- /.box-header -->
        <div class="box-body">
        	<table class="display table" cellspacing="0" width="100%" id="table_mobil">
                <thead>
                    <tr>
                        <th></th>
                        <th>Mobil</th>
                        <th>No Plat</th>
                        <th>Merk</th>
                        <th>Type</th>
                        <th>Warna</th>
                        <th>Harga (per Km)</th>
                        <th>Harga (per Jam)</th>
                    </tr>
                </thead>
                
                <tbody>
                    
                </tbody>
                
            </table>
        </div>
    </div>

@endsection
@section('title','Mobil')
@section('style-head')
@parent
<link rel="stylesheet" href="{{ url('/plugins/datatables/datatables.min.css')}}">

@endsection
@section('script-end')
@parent

<script type="text/javascript" src="{{ url('/plugins/jquery-ui/js/jquery-ui.js')}}"></script>

<script type="text/javascript" src="{{ url('/plugins/datatables/datatables.min.js')}}"></script>

@include('layouts.handlebar')
<script src="{{ asset('/js/rm.js') }}"></script>


@endsection