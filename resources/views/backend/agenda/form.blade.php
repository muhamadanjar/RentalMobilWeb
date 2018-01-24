@extends('layouts.admin.admin')
@section('title','Agenda')
@section('content-admin')
<?php

if(session('aksi') == 'edit'){
	$id = $agenda->id;
	$judul_agenda = $agenda->judul_agenda;
    $isi_agenda = $agenda->isi_agenda;
    $tempat = $agenda->tempat;
	$start_at = $agenda->start_at;
	$end_at = $agenda->end_at;
	$kategori = $agenda->kategori;
	$readonly = 'readonly';
	$image = $agenda->image;
	
}else{
    $id ='';
    $judul_agenda = '';
    $isi_agenda = '';
    $tempat = '';
	$start_at = '';
	$end_at = '';
	$kategori = '';
	$readonly = '';
	$image = '';	
	
	
}
?>

<form role="form" method="POST" enctype="multipart/form-data" action="{{ route('backend.agenda.post') }}">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading with-border">
					<h6 class="panel-title"><i class="fa fa-building"></i> Tambah Agenda</h6>
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
						<label>Judul Agenda</label>
						<input type="text" class="form-control" name="judul_agenda" value="{{ $judul_agenda }}">
						<div class="col-md-6"></div>
					</div>

                    <div class="form-group">
						<label>Isi Agenda</label>
                        <textarea class="form-control tinymce_sikko" name="isi_agenda">{{$isi_agenda}}</textarea>
						<div class="col-md-6"></div>
					</div>

					<div class="form-group">
						<label>Tempat</label>
                        <input class="form-control" name="tempat" value="{{$tempat}}"></input>
						<div class="col-md-6"></div>
					</div>

                    <div class="form-group">
						<label>Tanggal Mulai</label>
						<input type="text" class="form-control start_at" name="start_at" value="{{ $start_at }}">
						<div class="col-md-6"></div>
					</div>
					{{$kategori}}
					<div class="form-group">
						<label for="tanggal">Kategori</label>
						<select name="kategori" class="form-control">
							<option value="">-----------</option>
							@foreach($kategoris->getKategori() as $key => $v)
							<option value="{{$v}}" @if($kategori == $v) selected @endif>{{$v}}</option>
							@endforeach
						</select>
					</div>

                    <div class="form-group">
						<label>Tanggal Berakhir</label>
						<input type="text" class="form-control end_at" name="end_at" value="{{ $end_at }}">
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
						<h6 class="panel-title"><i class="fa fa-image"></i> Foto</h6>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<div class="foto">
									<?php 
									if (file_exists(public_path('images/uploads/agenda').'/'.$image)) {
									?>
									<img src="{{ asset('/images/uploads/agenda/')}}/{{ $image }}" alt="{{$judul_agenda}}" class="img-responsive _foto" width="80%">
									<?php  
									}else{
									?>
									<img src="http://placehold.it/180" alt="{{$judul_agenda}}" class="img-responsive _foto" width="80%">
									<?php  
									}
									?>
								</div>
								<div class="input-group margin controlupload">
									<input type="text" class="form-control txtfoto" readonly="readonly" name="foto" value="{{ $image }}">
									<span class="input-group-btn">
										<input type="file" name="agenda_file" class="hidden file fileupload" data-url="{{ route('backend.posts.postimage')}}" data-path="/images/uploads/agenda/">
										<button type="button" class="btn btn-info btn-flat formUpload">Agenda!</button>
									</span>
								</div>
							</div>
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
<script type="text/javascript" src="{{ url('/javascript/backend/forms/element.js')}}"></script>

<script type="text/javascript" src="{{ url('assets/plugins/datatables/js/jquery.dataTables.js')}}"></script>
<script type="text/javascript" src="{{ url('assets/plugins/datatables/tabletools/js/dataTables.tableTools.js')}}"></script>
<script type="text/javascript" src="{{ url('assets/plugins/datatables/js/datatables-bs3.js')}}"></script>
<script type="text/javascript" src="{{ url('assets/plugins/tinymce/tinymce.min.js')}}"></script>

<script type="text/javascript" src="{{ url('js/sikko.js')}}"></script>
@endsection

