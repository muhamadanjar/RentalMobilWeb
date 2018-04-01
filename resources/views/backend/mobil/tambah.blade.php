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
    
    if (session('aksi') == 'edit') {
      $id = $mobil->id;
      $no_plat= $mobil->no_plat;
      $merk= $mobil->merk;
      $type = $mobil->type;
      $warna = $mobil->warna;
      $harga = $mobil->harga;
      $harga_perjam = $mobil->harga_perjam;
      
    }
  ?>
<form role="form" method="post" action="{{ route('backend.mobil.post')}}" enctype='multipart/form-data'>
  {{ csrf_field() }}
  <div class="row">
    <div class="col-md-12">
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
                  <label for="type">Harga Mobil</label>
                  <input type="text" name="harga" class="form-control" id="harga" value="{{$harga}}">
                </div>
                <div class="form-group">
                  <label for="type">Harga Mobil</label>
                  <input type="text" name="harga_perjam" class="form-control" id="harga_perjam" value="{{$harga_perjam}}">
                </div>

            </div>

            <div class="panel-footer">
                <button type="submit" class="btn btn-primary btn-flat">Simpan</button>
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
