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
    $password = '';
    $no_telp = '';
    $alamat = '';
    $driverName = '';
    $nip = '';
    
    if (session('aksi') == 'edit') {
      $id = $mobil->id;
      $no_plat= $mobil->no_plat;
      $merk= $mobil->merk;
      $type = $mobil->type;
      $warna = $mobil->warna;
      $harga = $mobil->harga;
      $harga_perjam = $mobil->harga_perjam;

      $driverName = $officers->name;
      $nip = $officers->nip;
      $password = $officers->password;
      $no_telp = $officers->no_telp;
      $alamat = $officers->alamat;
      $deposit=$officers->deposit;
    }
  ?>
<form role="form" method="post" action="{{ route('backend.mobil.post')}}" enctype='multipart/form-data'>
  {{ csrf_field() }}
  <div class="row">
    <div class="col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"> Mobil</h3>
            </div>
            <div class="panel-body">
                <input type="hidden" name="id" class="form-control" id="id" value="{{$id}}">
                <div class="form-group">
                  <label for="no_plat">No Plat</label>
                  <input type="text" name="no_plat" class="form-control" id="no_plat" value="{{$no_plat}}">
                </div>
                <div class="form-group">
                  <label for="merk">Merk Mobil</label>
                  <input type="text" name="merk" class="form-control" id="merk" value="{{$merk}}">
                </div>
                <div class="form-group">
                  <label for="type">Type Mobil</label>
                  <input type="text" name="type" class="form-control" id="type" value="{{$type}}">
                </div>
                <div class="form-group">
                  <label for="type">Warna Mobil</label>
                  <input type="text" name="warna" class="form-control" id="warna" value="{{$warna}}">
                </div>
                <div class="form-group">
                  <label for="type">Harga Mobil (per Km)</label>
                  <input type="text" name="harga" class="form-control" id="harga" value="{{$harga}}">
                </div>
                <div class="form-group">
                  <label for="type">Harga Mobil (per Jam)</label>
                  <input type="text" name="harga_perjam" class="form-control" id="harga_perjam" value="{{$harga_perjam}}">
                </div>

            </div>

            <div class="panel-footer">
                <button type="submit" class="btn btn-primary btn-flat">Simpan</button>
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
                                <input type="text" class="form-control" placeholder="Full name" name="name" value="{{$driverName}}">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control" placeholder="No KTP" name="nip" value="{{$nip}}">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
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
                                <input type="text" class="form-control" placeholder="No Telp/Handphone" name="no_telp" value="{{$no_telp}}">
                                <span class="fa fa-mobile-phone form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control" placeholder="Alamat" name="alamat" value="{{$alamat}}">
                                <span class="fa fa-home form-control-feedback"></span>
                            </div>

                            <div class="form-group has-feedback">
                                <b>Saldo:</b>{{$deposit}}
                                <input type="hidden" class="form-control" placeholder="Deposit" name="deposit_temp" value="{{$deposit}}">
                            </div>

                        </div>

                        <div class="panel-footer">
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control" placeholder="Deposit" name="deposit" value="0">
                                <span class="fa fa-money form-control-feedback"></span>
                            </div>
                        </div>
                    </div>
    </div>
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
<script>
    $('input[name="urutanlayer"]').TouchSpin({
            verticalbuttons: true
    });
</script>
        
<script type="text/javascript" src="{{ url('js/sikko.js')}}"></script>
@endsection
