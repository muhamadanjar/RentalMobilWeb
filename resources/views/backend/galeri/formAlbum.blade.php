@extends('layouts.admin.admin')
@section('title','Album')
@section('content-admin')
<?php
    $name = '';
	$album_id = '';
	$type = '';
	$keterangan = '';
	$image = '';
	$actived = '';
	$id='';
	if(session('aksi') == 'edit'){
		$id= $edit->id;
		$name = $edit->name;
		$album_id = $edit->album_id;
		$type = $edit->type;
		$keterangan = $edit->keterangan;
		$image = $edit->image;
		$actived = $edit->actived;
	}
?>

<form role="form" method="POST" enctype="multipart/form-data" action="{{ route($route) }}">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading with-border">
					<h6 class="panel-title"><i class="fa fa-building"></i> Tambah Album</h6>
					<div class="panel-toolbar text-right">
                        <div class="btn-group pull-right">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fa fa-send  ico-save"></i> Simpan
                            </button>
                            <a href="{{ route('backend.album.index') }}" class=" btn btn-sm btn-primary">
                            <i class="fa fa-mail-reply ico-reply3"></i> Kembali</a>
                        </div>
                    </div>
				</div>
				<div class="panel-body">
					
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="id" value="{{$id}}">
                    <div class="form-group">
						<label>Nama Album</label>
                            <input type="text" name="name" class="form-control" value="{{$name}}">
                    </div>
					<div class="form-group">
						<label>Type Album</label>
                        <select  class="form-control" name="type">
						
							@foreach($album->getAlbumType() as $key)
                            <option value="{{$key}}" @if($type == $key) selected @endif>{{$key}}</option>
                            @endforeach
                        </select>

                    </div>
					<div class="form-group">
						<label>Keterangan</label>
                        <textarea class="form-control tinymce_post" name="keterangan">{{$keterangan}}</textarea>
						
					</div>
					<div class="form-group">
                        <label class="control-label">Gambar</label>
						<div class="foto">
									<?php 
									if (file_exists(public_path('images/uploads/gallery').'/'.$image)) {
									?>
									<img src="{{ asset('/images/uploads/gallery/')}}/{{ $image }}" alt="" class="img-responsive imgfoto" width="80%">
									<?php  
									}else{
									?>
									<img src="http://placehold.it/180" alt="" class="img-responsive imgfoto" width="80%">
									<?php  
									}
									?>
						</div>
                        <div class="input-group controlupload">
								<input type="text" class="form-control txtfoto" readonly="readonly" name="image" value="{{ $image }}">
                                <span class="input-group-btn">
									<input type="file" name="file" class="hidden file fileupload" data-url="{{ route('backend.media.postimage')}}" data-path="/images/uploads/gallery/">
									<button type="button" class="btn btn-info btn-flat formUpload">Browse Image!</button>
                                </span>
                        </div>
                        
                    </div>
					<div class="form-group">
                    	<label class="checkbox-inline">
                            <input type="checkbox" name="actived" value="1" @if($actived == 1) checked @endif> Aktif
                        </label>
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
					<h6 class="panel-title"><i class="fa fa-doc"></i></h6>
				</div>
				<div class="panel-body">
					
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
<script>
	// tagging // ================================
        $('#selectize-tagging').selectize({
            delimiter: ',',
            persist: false,
            create: function (input) {
                return {
                    value: input,
                    text: input
                };
            }
		});	
	// multiple select // ================================
    $('#tag').selectize({
        maxItems: 3
    });
</script>
@endsection

