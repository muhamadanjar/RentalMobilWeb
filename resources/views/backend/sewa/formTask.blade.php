@extends('layouts.adminlte.main')
@section('title','Task')
@section('content-admin')
<?php

if(session('aksi') == 'edit'){
	$id = $task->id;
	$customer_id = $task->customer_id;
    $mobil_id = $task->mobil_id;
    $tgl_mulai = $task->tgl_mulai;
	$tgl_akhir = $task->tgl_akhir;
	$origin = $task->origin;
	$destination = $task->destination;
	$readonly = 'readonly';
	$total_bayar = $task->total_bayar;
	
    $status = $task->status;
	
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

<form role="form" method="POST" enctype="multipart/form-data" action="{{ route('backend.transaksi.posttask') }}">
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
						<input type="text" class="form-control" id="total_bayar" name="total_bayar" value="{{ $total_bayar }}">
						<div class="col-md-6"></div>
					</div>

                    <div class="form-group">
						<label>Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="pending" @if($status == 'pending') selected @endif>Pending</option>
							<option value="confirmed" @if($status == 'confirmed') selected @endif>Confirmed</option>
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
		<div class="panel panel-default">
				<div class="panel-heading with-border">
					<h6 class="panel-title"><i class="fa fa-building"></i> Form Mobil</h6>
					<div class="panel-toolbar text-right">
                        <div class="btn-group pull-right">
                            
                        </div>
                    </div>
				</div>
				<div class="panel-body">
					<input type="hidden" id="duration" name="duration" value="{{$sewaDetail->duration}}"/>
					<input type="hidden" id="distance" name="distance" value="{{$sewaDetail->distance}}"/>
					<input type="hidden" name="sewa_type" value="{{$sewaDetail->sewa_type}}"/>
						<div class="form-group">
                                <label for="mobil">Mobil</label>
                                <select name="mobil" class="select2 form-control" id="mobil">
                                    <option value="--">----</option>
									@foreach($mobil as $k => $v)
                                    	<option value="{{$v->id}}" @if($mobil_id == $v->id) selected="selected" @endif>{{$v->name}}</option>
                                    @endforeach
                                </select>
                        </div>

						<div class="form-group">
							<label for="driverName">Driver</label>
							<h5 class="driverName">--</h5>
						</div>
						<div class="form-group">
							<label for="noTelp">No Telp</label>
							<h5 class="noTelp">--</h5>
						</div>
						

						<div class="form-group">
							<label for="noPlat">No Plat</label>
							<h5 class="noPlat">--</h5>
						</div>

						<div class="form-group">
							<label for="tahunMobil">Tahun</label>
							<h5 class="tahunMobil">--</h5>
						</div>

						<div class="form-group">
							<label for="warnaMobil">Warna</label>
							<h5 class="warnaMobil">--</h5>
						</div>

						<img class="fotoDriver profile-user-img img-responsive img-circle" src="http://placehold.it/160" alt="User profile picture">
						
						
					<div class="form-group">
						
					</div>
				</div>
			</div>
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
<script src="{{ asset('plugins/select2/dist/js/select2.full.min.js')}}"></script>
<script type="text/javascript">
    $(function () {
        //Initialize Select2 Elements
		$('.select2').select2();
		loadData($('select#mobil').val());
		$('select#mobil').on('change',function(){
			loadData($(this).val());
		});
		function loadData(id) { 
			$.ajax({
				url:'/api/mobil/'+id+'/driverinfo',
				method: 'get'
			}).then(function(response){
				$('.warnaMobil').text(response.mobil.warna);
				$('.noPlat').text(response.mobil.no_plat);
				$('.tahunMobil').text(response.mobil.tahun);
				$('.driverName').text(response.name);
				$('.noTelp').text(response.officers.no_telp);
				$('.fotoDriver').attr('src',response.mobil.author.foto);
				var distanceInKM = Math.round($('#distance').val()* 0.001);
				$('#total_bayar').val(Math.round(distanceInKM * response.mobil.harga));
				
			});
		}
    });
</script>

@include('layouts.handlebar')
<script type="text/javascript" src="{{ url('js/rm.js')}}"></script>

@endsection

