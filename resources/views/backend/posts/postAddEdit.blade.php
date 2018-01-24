@extends('layouts.admin.admin')
@section('title','Post')
@section('content-admin')
<?php

if(session('aksi') == 'edit'){
	$id = $post->id;
	$title = $post->title;
    $content = $post->content;
    $position = $post->position;
	$status = $post->status;
	$type = $post->type_post;
	$category_id = $post->category_id;
	$posttags = $post->tags;
	$image = $post->image;
}else{
    $id ='';
    $title = '';
    $content = '';
    $position = \Input::get('position');
    $status = '';
	$type = \Input::get('type');
	$category_id = '';
	$posttags = '';
	$image = '';
	
}
?>

<form role="form" method="POST" enctype="multipart/form-data" action="{{ route('backend.posts.post') }}">
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading with-border">
					<h6 class="panel-title"><i class="fa fa-building"></i> Tambah Halaman</h6>
					<div class="panel-toolbar text-right">
                        <div class="btn-group pull-right">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fa fa-send  ico-save"></i> Simpan
                            </button>
                            <a href="{{ route('backend.posts.index') }}" class=" btn btn-sm btn-primary">
                            <i class="fa fa-mail-reply ico-reply3"></i> Kembali</a>
                        </div>
                    </div>
				</div>
				<div class="panel-body">
					
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="position" value="{{ $position }}"/>
                    <input type="hidden" name="type_post" value="{{ $type }}"/>
						@if(session('aksi') =='edit')
						<input type="hidden" name="id" value="{{ $id }}">
						@endif
						
					<div class="form-group">
						<label>Judul</label>
						<input type="text" class="form-control" require="require" name="title" value="{{ $title }}">
						<div class="col-md-6"></div>
					</div>

                    <div class="form-group">
						<label>Isi</label>
                        <textarea class="form-control tinymce_post" name="content">{{$content}}</textarea>
						<div class="col-md-6"></div>
					</div>

					<div class="form-group">
						<label>Status</label>
                        <select  class="form-control" name="status">
                            @foreach($post->getPossibleStatus() as $key)
                            <option value="{{$key}}" @if($status == $key) selected @endif>{{$key}}</option>
                            @endforeach
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
					<h6 class="panel-title"><i class="fa fa-doc"></i></h6>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label>Kategori</label>
						<select class="form-control" require="require" id="category" name="category_id">
							<option value="0">Main</option>
							@foreach($categories as $k => $v)
								<option value="{{$v->id}}" @if($v->id == $category_id) selected @endif>{{$v->name}}</option>
                            @endforeach
						</select>
					</div>
					<div class="form-group">
                        <label class="control-label">Tag</label>
                        <select name="tags[]" id="tag" class="form-control" placeholder="Pilih Tag..." multiple="multiple">
                            <option value="">Pilih Tag...</option>
							@foreach($tags as $k => $v)
								<option value="{{$v->id}}" @if($post->hasTags($v->name)) selected  @endif>{{$v->name}}</option>
                            @endforeach
						</select>
                    </div>
						<div class="form-group">
							<div>
								<div class="foto">
									<?php 
									if (file_exists(public_path('images/uploads/post').'/'.$image)) {
									?>
									<img src="{{ asset('/images/uploads/post/')}}/{{ $image }}" alt="" class="img-responsive imgfoto" width="80%">
									<?php  
									}else{
									?>
									<img src="http://placehold.it/180" alt="" class="img-responsive imgfoto" width="80%">
									<?php  
									}
									?>
								</div>
								<div class="input-group margin controlupload">
									<input type="text" class="form-control txtfoto" readonly="readonly" name="foto" value="{{ $image }}">
									<span class="input-group-btn">
										<input type="file" name="post_file" class="hidden file fileupload" data-url="{{ route('backend.posts.postimage')}}" data-path="/images/uploads/post/">
										<button type="button" class="btn btn-info btn-flat formUpload">Feature Image!</button>
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

