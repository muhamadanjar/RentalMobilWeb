@extends('layouts.admin.admin')

@section('content-admin')
    <div class="container-fluid">
        <h2 class="page-title">Tambah SDM</h2>
        <form method="post" action="{{ route('backend.officers.store') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <div class="form-group">
				<label>Nama</label>
				<input type="text" class="form-control" name="name">
			</div>
            <div class="form-group">
				<label>NIP</label>
				<input type="text" class="form-control" name="nip">
			</div>
            <div class="form-group">
				<label>Pangkat</label>
                <select class="form-control" name="pangkat_id">
                @foreach($pangkatLookup as $key => $v)
                    <option value="{{$v}}">{{$v}}</option>
                @endforeach
                </select>
			</div>

            <div class="form-group">
				<label>Jabatan</label>
                <select class="form-control" name="jabatan_id">
                @foreach($jabatanLookup as $key => $v)
                    <option value="{{$v}}">{{$v}}</option>
                @endforeach
                
                </select>
			</div>
            <div class="form-group">
				<label>Role</label>
                <select class="form-control" name="role">
                
                @foreach($roles as $key => $v)
                    <option value="{{$v}}">{{$v}}</option>
                @endforeach
                </select>
			</div>
            <div class="form-group">
				<button class="btn btn-default">Simpan</button>
			</div>
        </form>
    </div>
@stop
