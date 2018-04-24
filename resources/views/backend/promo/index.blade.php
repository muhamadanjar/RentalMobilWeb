@extends('layouts.adminlte.main')
@section('content-admin')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Promo</h3>
            <div class="box-tools text-right">
                <div class="btn-group">
                    <a href="{{ route('backend.promo.create') }}" class="btn btn-sm btn-primary"><span class="fa fa-plus"></span> Tambah</a>
                    
                </div>
            </div>
            
        </div>
            <!-- /.box-header -->
        <div class="box-body">
        	<table class="display table" cellspacing="0" width="100%" id="table_promo">
                <thead>
                    <tr>
                        <th></th>
                        <th>Kode</th>
                        <th>Promo</th>
                        <th>Dari</th>
                        <th>Sampai</th>
                    </tr>
                </thead>
                
                <tbody>
                    
                </tbody>
                
            </table>
        </div>
    </div>

@endsection
@section('title','Promo')
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