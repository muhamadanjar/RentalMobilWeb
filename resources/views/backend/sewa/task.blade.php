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
            <form id="table_task_search_form">
                <div class="row">
                    <div class="col-md-6">
                        <label for="tgl_mulai"></label>
                        <input type="text" class="form-control" id="sq" name="sq" placeholder="Cari">
                    </div>
                    <div class="col-md-6">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="cancelled">Cancelled</option>
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
        	<table id="table_task" class="display table table-responsive table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="3%"></th>
                        <th>Asal</th>
                        <th>Tujuan</th>
                        <th>Status</th>
                        <th>Sewa Type</th>
                        <th>Waktu Penjemputan</th>
                        <th>Tanggal Pemesanan</th>
                        <th>Tanggal Update</th>
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
@endsection

@section('script-end')
@parent

<script type="text/javascript" src="{{ url('/plugins/datatables/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{ url('/plugins/bootbox/js/bootbox.js') }}"></script>
@include('layouts.handlebar')
<script type="text/javascript" src="{{ url('js/rm.js')}}"></script>

@endsection