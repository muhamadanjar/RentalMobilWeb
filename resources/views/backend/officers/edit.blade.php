@extends('layouts.admin.admin')

@section('content-admin')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <h2 class="page-title">Edit SDM</h2>
                {{ BootForm::open()->put()->action(route('backend.officers.update', [$officer->id])) }}
                <form method="post" action="{{ route('backend.officers.update') }}">
                    <input type="hidden" name="_method" value="PUT"/>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="name" value="{{$officer->name}}">
                    </div>
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="text" class="form-control" name="nip" value="{{$officer->nip}}">
                    </div>
                    <div class="form-group">
                        <label>Pangkat</label>
                        {{$officer->pangkat->getKey()}}
                        <select class="form-control" name="pangkat_id">
                        @foreach($pangkatLookup as $key => $v)
                            <option value="{{$v}}">{{$v}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        {{$officer->jabatan->getKey()}}
                        <select class="form-control" name="jabatan_id">
                        @foreach($jabatanLookup as $key => $v)
                            <option value="{{$v}}">{{$v}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
                
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Manajemen Akun</div>
                    <div class="panel-body">
                        @if($officer->user)
                            <p>Petugas yang bersangkutan lupa password? Klik tombol dibawah ini untuk reset password.</p>
                            <a href="{{ route('backend.user.reset_password', ['id' => $officer['id']]) }}" class="btn btn-info btn-reset-password">Reset Password</a>
                            <hr/>
                            <p>Dengan mengklik tombol dibawah ini, maka petugas yang bersangkutan tidak lagi bisa login ke aplikasi. Informasi lainnya tetap akan disimpan di sistem.</p>
                            {{ Form::delete(route('backend.user.destroy', [$officer['id']]), 'Hapus Akun', ['class' => 'form-delete'], ['class' => 'btn btn-danger']) }}
                        @else
                            <p>Petugas ini belum memiliki akun untuk login ke aplikasi.</p>
                            <a href="{{ route('backend.user.create', ['officer_id' => $officer['id']]) }}" class="btn btn-info">Buat Akun</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script-end')
    @parent
    <script>
        $(function(){
            $(document).on('click', '.btn-reset-password', function(e){
                e.preventDefault();
                var btn = $(e.currentTarget);

                btn.button('loading');
                $.ajax({
                    url: btn.attr('href'),
                    type: 'get',
                    dataType: 'json'
                }).done(function(response){
                    bootbox.alert("Password baru: " + response.password);
                }).fail(function(){
                    alert('Oops, tidak bisa melakukan perubahan password saati ini. Coba lagi beberapa saat atau hubungi admin.');
                }).always(function(){
                    btn.button('reset');
                });
            });
        });
    </script>
@stop