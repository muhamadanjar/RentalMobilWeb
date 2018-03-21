@extends('layouts.adminlte.main')
@section('title','Transaksi')
@section('content-admin')
<?php

if(session('aksi') == 'edit'){
	$id = $sewa->id;
	$customer_id = $sewa->customer_id;
    $mobil_id = $sewa->mobil_id;
    $tgl_mulai = $sewa->tgl_mulai;
	$tgl_akhir = $sewa->tgl_akhir;
	$origin = $sewa->origin;
	$destination = $sewa->destination;
	$readonly = 'readonly';
    $total_bayar = $sewa->total_bayar;
    $status = $sewa->status;
	
}else{
    $id ='';
    $customer_id = '';
    $mobil_id = '';
	$tgl_mulai = '';
	$tgl_akhir = '';
    $origin = '';
    $destination = '';
    $readonly = '';
    $total_bayar='';
	$status = '';	
}
?>

<form role="form" method="POST" enctype="multipart/form-data" action="{{ route('backend.transaksi.post') }}">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading with-border">
					<h6 class="panel-title"><i class="fa fa-building"></i> Form Transaksi</h6>
					<div class="panel-toolbar text-right">
                        <div class="btn-group pull-right">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fa fa-send  ico-save"></i> Simpan
                            </button>
                            <a href="{{ route('backend.transaksi.index') }}" class=" btn btn-sm btn-primary">
                            <i class="fa fa-mail-reply ico-reply3"></i> Kembali</a>
                        </div>
                    </div>
				</div>
				<div class="panel-body">
					
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
						
						@if(session('aksi') =='edit')
						<input type="hidden" name="id" value="{{ $id }}">
						@endif
						
					<div class="form-group">
						<label>Tanggal Mulai</label>
						<input type="text" class="form-control" name="tgl_mulai" value="{{ $tgl_mulai }}">
						<div class="col-md-6"></div>
					</div>

                    <div class="form-group">
						<label>Tanggal Akhir</label>
						<input type="text" class="form-control" name="tgl_akhir" value="{{ $tgl_akhir }}">
						<div class="col-md-6"></div>
					</div>

					<div class="form-group">
						<label>Tempat Asal</label>
                        <input type="text" class="form-control" name="origin" value="{{$origin}}"></input>
						<div class="col-md-6"></div>
					</div>

                    <div class="form-group">
						<label>Tempat Tujuan</label>
						<input type="text" class="form-control" name="destination" value="{{ $destination }}">
						<div class="col-md-6"></div>
					</div>
					

                    <div class="form-group">
						<label>Total Bayar</label>
						<input type="text" class="form-control" name="total_bayar" value="{{ $total_bayar }}">
						<div class="col-md-6"></div>
					</div>

                    <div class="form-group">
						<label>Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="pending" @if($status == 'pending') selected @endif>Pending</option>
                            <option value="cancelled" @if($status == 'cancelled') selected @endif>Cancelled</option>
                            <option value="collected" @if($status == 'collected') selected @endif>Collected</option>
                            <option value="complete" @if($status == 'complete') selected @endif>Complete</option>
                        </select>
						<div class="col-md-6"></div>
					</div>
						
					<div class="form-group">
						<button type="submit" class="btn btn-primary">
							Simpan
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
        </div>
	</div>
	<div class="row">
        
    </div>
    
</form>
@endsection
@section('style-head')
@parent

@endsection
@section('script-end')
@parent


<script type="text/javascript" src="{{ url('js/sikko.js')}}"></script>
@endsection

