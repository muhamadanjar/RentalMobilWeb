@extends('layouts.admin.admin')
@section('title','Transmigrasi')
@section('content-admin')
<?php

if(session('aksi') == 'edit'){
	$id = $pyb->id;
	$tahun = $pyb->tahun;
    $status_pekerjaan = $pyb->status_pekerjaan;
    $jumlah = $pyb->jumlah;
	
	$readonly = 'readonly';
	
}else{
    $id ='';
    $tahun = '';
    $status_pekerjaan = '';
    $jumlah = '';
	$readonly = '';

}
?>

<form role="form" method="POST" enctype="multipart/form-data" action="{{ route('backend.tenagakerja.pyb.post') }}">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading with-border">
					<h6 class="panel-title"><i class="fa fa-building"></i> Tambah/Ubah Data PYB</h6>
					<div class="panel-toolbar text-right">
                        <div class="btn-group pull-right">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fa fa-send  ico-save"></i> Simpan
                            </button>
                            <a href="{{ route('backend.tenagakerja.pyb.index') }}" class="btn btn-sm btn-primary">
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
						<label>Status Pekerjaan</label>
						<input type="text" class="form-control" name="status_pekerjaan" value="{{ $status_pekerjaan }}">
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
                                    <input type="text" class="form-control" name="tahun" value="{{ $tahun }}" placeholder="Tahun">        
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mb10">
                                    <input type="text" class="form-control" name="jumlah" value="{{ $jumlah }}" placeholder="Jumlah">        
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
			<div class="panel panel-default">
					<div class="panel-heading with-border">
						<h6 class="panel-title"><i class="fa fa-image"></i> Foto</h6>
					</div>
					<div class="panel-body">
						<div class="row">
							
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

