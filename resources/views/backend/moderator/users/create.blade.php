@extends('layouts.adminlte.main')
@section('title','User')
@section('content-admin')
<?php
if(session('aksi') == 'edit'){
	$id = $users->id;
	$username = $users->username;
	$name = $users->name;
	$email = $users->email;
	$password = $users->password;
	$image = $users->foto;
	$readonly = 'readonly';
}else{
	$id ='';	
	$username = '';
	$name = '';
	$email = '';
    $password = '';
    $image = '';
	$readonly = '';

}
?>
    
        <form action="{{ route('backend.pengaturan.users.post')}}" method="post">
        {{ csrf_field()}}
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading with-border">
                            <h6 class="panel-title"><i class="fa fa-user"></i> Tambah User</h6>
                            <div class="panel-toolbar text-right">
                                <div class="btn-group pull-right">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fa fa-send ico-save"></i> Simpan
                                    </button>
                                    <a href="{{ route('backend.pengaturan.users') }}" class=" btn btn-sm btn-primary">
                                    <i class="fa fa-mail-reply ico-reply3"></i> Kembali</a>
                                </div>
                            </div>
                    </div>
                    <div class="panel-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        @if(session('aksi') =='edit')
                            <input type="hidden" name="id" value="{{ $id }}">
                        @endif
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" class="form-control" name="name" value="{{$name}}">
                        </div>
                        <div class="form-group">
                            <label for="name">Username</label>
                            <input type="text" id="name" class="form-control" name="username" value="{{$username}}" @if(session('aksi') =='edit') readonly @endif>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" class="form-control" name="email" value="{{$email}}">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" class="form-control" name="password" value="{{$password}}">
                        </div>
                        @if($status == 'edit')	
                            <input type="hidden" class="form-control" name="oldpassword" value="{{ $password }}">			
                        @endif
                        <div class="form-group">
                            <label for="">Group</label>
                            @foreach($role as $key => $group)
                            
                                <div class="checkbox">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="groups[]" value="{{ $group->id }}"  @if($users->isRole($group->name)) checked @endif/>
                                    {{ $group->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Proses</button>
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
                                        if (file_exists($users->getPath().'/'.$image)) {
                                        ?>
                                        <img src="{{ $users->getPermalink()}}/{{ $image }}" alt="{{$name}}" class="img-responsive imgfoto" width="100%">
                                        <?php  
                                        }else{
                                        ?>
                                        <img src="http://placehold.it/180" alt="{{$name}}" class="img-responsive imgfoto" width="100%">
                                        <?php  
                                        }
                                        ?>
                                    </div>
                                    <div class="input-group margin controlupload">
                                        <input type="text" class="form-control txtfoto" readonly="readonly" name="foto" value="{{ $image }}">
                                        <span class="input-group-btn">
                                            <input type="file" name="users_file" class="hidden file fileupload" data-url="{{ route('backend.pengaturan.users.postimage',['id'=>$id])}}" data-path="/images/uploads/users/">
                                            <button type="button" class="btn btn-info btn-flat formUpload">Foto!</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                </div>
            </div>
        </div>
        </form>

@endsection

@section('style-head')
@parent
<link rel="stylesheet" href="{{ url('/plugins/jquery-ui/css/jquery-ui.css')}}">
@endsection
@section('script-end')
@parent
<script type="text/javascript" src="{{ url('/plugins/jquery-ui/js/jquery-ui.js')}}"></script>
<script type="text/javascript" src="{{ url('/plugins/datatables/datatables.min.js')}}"></script>
<script type="text/javascript" src="{{ url('js/rm.js')}}"></script>
@endsection
