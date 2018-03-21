@extends('layouts.adminlte.main')
@section('content-admin')
    <div class="row">
    <div class="col-md-12">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-exchange"></i>Data Transaksi</h3>
            <div class="box-tools pull-right">
                <div class="btn-group">
                   
                </div>
            </div>
            
        </div>
        <div class="box-body">
            <form id="table_reservation_search_form">
                <div class="row">
                    <div class="col-md-6">
                        <label for="tgl_mulai">Tgl Mulai</label>
                        <input type="text" class="form-control" id="tgl_mulai" name="tgl_mulai" placeholder="Tanggal Mulai">
                    </div>
                    <div class="col-md-6">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="pending">Pending</option>
                            <option value="canceled">Canceled</option>
                            <option value="collected">Collected</option>
                            <option value="complete">Complete</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Proses</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        
                    </div>
                </div>
                
            </form>
        	<table id="table_reservation" class="display table table-responsive table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="3%"></th>
                        <th>Asal</th>
                        <th>Tujuan</th>
                        <th>Biaya</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    </div>
    </div>

@endsection
@section('style-head')
@parent
<link rel="stylesheet" href="{{ url('/plugins/datatables/datatables.min.css')}}">
<link rel="stylesheet" href="{{ url('assets/plugins/datatables/css/tabletools.css')}}">
@endsection

@section('script-end')
@parent

<script type="text/javascript" src="{{ url('/plugins/datatables/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{ url('/plugins/bootbox/js/bootbox.js') }}"></script>
<script type="text/javascript" src="{{ url('js/rm.js')}}"></script>
@endsection