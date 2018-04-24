@extends('layouts.adminlte.main')

@section('content-admin')
  <?php
    $id = '';
    $no_plat='';
    $merk='';
    $type='';
    $warna='';
    $harga='';
    $harga_perjam ='';
    $deposit='';
    
   
  ?>
<form role="form" method="post" action="{{ route('backend.mobil.driver')}}" enctype='multipart/form-data'>
  {{ csrf_field() }}
  <div class="row">
    <div class="col-md-12">
        <div class="box box-default color-palette-box">
            <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-tag"></i> Tambah Driver</h3>
            </div>
            <div class="box-body">
                <div class="col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                        <h3 class="panel-title"> Data Mobil</h3>
                        </div>
                        <div class="panel-body">
                            <input type="hidden" name="id" class="form-control" id="id" value="{{$id}}">
                            <div class="form-group">
                                <label for="no_plat">No Plat</label>
                                <input type="text" name="no_plat" class="form-control" id="no_plat" value="{{$no_plat}}">
                            </div>
                            <div class="form-group">
                                <label for="merk">Merk Mobil</label>
                                <select name="merk" class="select2 form-control" id="merk">
                                    <option value="--">----</option>

                                    @foreach($merkselect as $k => $v)
                                    <option value="{{$v->merk}}">{{$v->merk}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="type">Type Mobil</label>
                                
                                <select name="type" class="select2 form-control" id="type">
                                    <option value="--">----</option>

                                    @foreach($typeselect as $k => $v)
                                    <option value="{{$v->type}}">{{$v->type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="type">Warna Mobil</label>
                                <input type="text" name="warna" class="form-control" id="warna" value="{{$warna}}">
                            </div>
                            <div class="form-group">
                                <label for="type">Harga Mobil (per Kilo)</label>
                                <input type="text" name="harga" class="form-control" id="harga" value="{{$harga}}">
                            </div>
                            <div class="form-group">
                                <label for="type">Harga Mobil (per Jam)</label>
                                <input type="text" name="harga_perjam" class="form-control" id="harga_perjam" value="{{$harga_perjam}}">
                            </div>

                        </div>

                        <div class="panel-footer">
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                        <h3 class="panel-title"> Data Personal</h3>
                        </div>
                        <div class="panel-body">
                            
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control" placeholder="Full name" name="name">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control" placeholder="Username" name="username">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="email" class="form-control" placeholder="Email" name="email">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="password" class="form-control" placeholder="Password" name="password">
                                <span class="fa fa-lock form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation">
                                <span class="fa fa-lock form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control" placeholder="No Telp/Handphone" name="no_telp">
                                <span class="fa fa-mobile-phone form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control" placeholder="Alamat" name="alamat">
                                <span class="fa fa-home form-control-feedback"></span>
                            </div>

                        </div>

                        <div class="panel-footer">
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control" placeholder="Deposit" name="deposit">
                                <span class="fa fa-money form-control-feedback"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-flat">Simpan</button>
            </div>
        </div>
    </div>
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
        $('.select2').select2()
    });
</script>
@endsection
