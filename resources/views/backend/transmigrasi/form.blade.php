@extends('layouts.admin.admin')
@section('title','Transmigrasi')
@section('content-admin')
<?php

if(session('aksi') == 'edit'){
	$id = $transmigrasi->id;
	$tahun = $transmigrasi->tahun;
    $jumlah_kk = $transmigrasi->jumlah_kk;
    $realisasi_kk = $transmigrasi->realisasi_kk;
	$realisasi_jiwa = $transmigrasi->realisasi_jiwa;
	$wilayah_asal = $transmigrasi->wilayah_asal;
	$wilayah_tujuan = $transmigrasi->wilayah_tujuan;
	$readonly = 'readonly';
	
	
}else{
    $id ='';
    $tahun = '';
    $jumlah_kk = '';
    $realisasi_kk = '';
	$realisasi_jiwa = '';
	$wilayah_asal = '';
	$wilayah_tujuan = '';
	$readonly = '';

}
?>

<form role="form" method="POST" enctype="multipart/form-data" action="{{ route('backend.transmigrasi.post') }}">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading with-border">
					<h6 class="panel-title"><i class="fa fa-building"></i> Tambah Data Transmigrasi</h6>
					<div class="panel-toolbar text-right">
                        <div class="btn-group pull-right">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fa fa-send  ico-save"></i> Simpan
                            </button>
                            <a href="{{ route('backend.agenda.index') }}" class=" btn btn-sm btn-primary">
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
						<label>Tahun</label>
						<input type="text" class="form-control" name="tahun" value="{{ $tahun }}">
						<div class="col-md-6"></div>
					</div>
                    <div class="form-group">
						<label>Jumlah KK</label>
						<input type="text" class="form-control" name="jumlah_kk" value="{{ $jumlah_kk }}">
						<div class="col-md-6"></div>
					</div>
                    <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="control-label"> Realisasi</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mb10">
                                    <input type="text" class="form-control" name="realisasi_jiwa" value="{{ $realisasi_jiwa }}" placeholder="Jiwa">        
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mb10">
                                    <input type="text" class="form-control" name="realisasi_kk" value="{{ $realisasi_kk }}" placeholder="KK">        
                                </div>
                            </div>
                        
					</div>

                    <div class="form-group">
						<div class="row">
                            <div class="col-sm-6">
                                <label class="control-label">Wilayah Asal</label>
                                <select name="wilayah_asal" class="form-control">
                                    <option value="0">-----------</option>
                                    @foreach($asal as $key => $v)
                                    <option value="{{$v->kode_prov}}" @if($wilayah_asal == $v->kode_prov) selected="selected" @endif >{{$v->nama_provinsi}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="control-label">Wilayah Tujuan</label>
                                <select name="wilayah_tujuan" class="form-control">
                                    <option value="">-----------</option>
                                    @foreach($tujuan as $key => $v)
                                    <option value="{{$v->kode_kab}}" @if($wilayah_tujuan == $v->kode_kab) selected="selected" @endif>{{$v->nama_kabupaten}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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
			<!--<div class="panel panel-default">
					<div class="panel-heading with-border">
						<h6 class="panel-title"><i class="fa fa-image"></i> Foto</h6>
					</div>
					<div class="panel-body">
						<div class="row">
							
						</div>
					</div>
			</div>-->
          	
        
        </div>
	</div>
	<div class="row">
        
   
    </div>
    
</form>
@endsection
@section('style-head')
@parent
<link rel="stylesheet" href="{{ url('assets/plugins/selectize/css/selectize.css')}}">
<link rel="stylesheet" href="{{ url('assets/plugins/jquery-ui/css/jquery-ui.css')}}">
<link rel="stylesheet" href="{{ url('assets/plugins/select2/css/select2.css')}}">
<link rel="stylesheet" href="{{ url('assets/plugins/touchspin/css/touchspin.css')}}">
@endsection
@section('script-end')
@parent
<script type="text/javascript" src="{{ url('assets/plugins/selectize/js/selectize.js')}}"></script>
<script type="text/javascript" src="{{ url('assets/plugins/jquery-ui/js/jquery-ui.js')}}"></script>
<script type="text/javascript" src="{{ url('assets/plugins/jquery-ui/js/addon/timepicker/jquery-ui-timepicker.js')}}"></script>
<script type="text/javascript" src="{{ url('assets/plugins/jquery-ui/js/jquery-ui-touch.js')}}"></script>
<script type="text/javascript" src="{{ url('assets/plugins/inputmask/js/inputmask.js')}}"></script>
<script type="text/javascript" src="{{ url('assets/plugins/select2/js/select2.js')}}"></script>
<script type="text/javascript" src="{{ url('assets/plugins/touchspin/js/jquery.bootstrap-touchspin.js')}}"></script>
<script type="text/javascript" src="{{ url('assets/javascript/backend/forms/element.js')}}"></script>

<script type="text/javascript" src="{{ url('assets/plugins/datatables/js/jquery.dataTables.js')}}"></script>
<script type="text/javascript" src="{{ url('assets/plugins/datatables/tabletools/js/dataTables.tableTools.js')}}"></script>
<script type="text/javascript" src="{{ url('assets/plugins/datatables/js/datatables-bs3.js')}}"></script>
<script type="text/javascript" src="{{ url('assets/plugins/tinymce/tinymce.min.js')}}"></script>

<script type="text/javascript" src="{{ url('js/sikko.js')}}"></script>
@endsection

