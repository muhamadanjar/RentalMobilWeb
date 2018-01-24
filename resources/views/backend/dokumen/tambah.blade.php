@extends('layouts.admin.admin')

@section('content-admin')
  <?php
    $id = '';
    $judul_dokumen='';
    $tanggal='';
    $upload = '';
    $kategori = '';
    
    if (session('aksi') == 'edit') {
      $id = $dokumen->id;
      $judul_dokumen = $dokumen->judul_dokumen;
      $tanggal= $dokumen->tanggal;
      $upload = $dokumen->upload;
      $kategori = $dokumen->kategori;
    }
  ?>
<form role="form" method="post" action="{{ route('backend.dokumen.post')}}" enctype='multipart/form-data'>
  {{ csrf_field() }}
  <div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"> Dokumen</h3>
            </div>
            <div class="panel-body">
                <input type="hidden" name="id" class="form-control" id="id" value="{{$id}}">
                <div class="form-group">
                  <label for="judul_info">Judul Dokumen</label>
                  <input type="text" name="judul_dokumen" class="form-control" id="judul_info" value="{{$judul_dokumen}}">
                </div>
                <div class="form-group">
                  <label for="tanggal">Tanggal</label>
                  <input type="text" name="tanggal" class="form-control datepicker" id="tanggal" value="{{$tanggal}}">
                </div>
                <div class="form-group">
                  <label for="tanggal">Kategori</label>
                  <select name="kategori" class="form-control">
                    <option value="">-----------</option>
                    @foreach($dokumen->getKategori() as $key)
                    <option value="{{$key}}" @if($kategori == $key) selected @endif>{{$key}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="tanggal">File Upload</label>
                  <input type="file" name="upload" class="form-control" id="upload">
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

<script type="text/javascript" src="{{ url('js/sikko.js')}}"></script>
@endsection
