@extends('layouts.adminlte.main')

@section('breadcrumb')
    @parent
    <span class="trail"><i class="fa fa-angle-right"></i></span>
    <span class="trail">Profilku</span>
@stop

@section('content-admin')
    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">Profil {{ $user['name'] }}</h3></div>
        <div class="panel-body">
            <dl>
                <dt>Nama</dt>
                <dd>{{ $user['name'] }}</dd>
                <dt>Email</dt>
                <dd>{{ $user['email'] }}</dd>
            </dl>
        </div>
        <div class="panel-heading"><h3 class="panel-title">Ganti Password</h3></div>
        <div class="panel-body">
            <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('backend.me.update_password') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>    
                <div class="form-group">
					<label>Password Lama</label>
					<input type="text" class="form-control" name="password_current">
					<div class="col-md-6"></div>
				</div>
                <div class="form-group">
					<label>Password Baru</label>
					<input type="text" class="form-control" name="password">
					<div class="col-md-6"></div>
				</div>

                <div class="form-group">
					<label>Konfirmasi Password Baru</label>
					<input type="text" class="form-control" name="password_confirmation">
					<div class="col-md-6"></div>
				</div>
                <div class="form-group">
					<button type="submit" class="btn btn-primary">Ganti</button>
				</div>
            </form>
        </div>
    </div>
@stop