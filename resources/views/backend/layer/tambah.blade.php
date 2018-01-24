@extends('layouts.admin.admin')

@section('content-admin')
  <?php
    $id = '';
    $namalayer='';
    $kodelayer='';
    $urllayer='';
    $aktif = '';
    $urutanlayer='';
    $tipelayer = '';
    $option_opacity = '';
    $option_visible = '';
    $option_style = '';
    $parent_id = '';
    if (session('aksi') == 'edit') {
      $id = $layer->id;
      $namalayer = $layer->namalayer;
      $kodelayer= $layer->kodelayer;
      $urllayer = $layer->urllayer;
      $aktif = $layer->aktif;
      $urutanlayer = $layer->urutanlayer;
      $tipelayer = $layer->tipelayer;
      $option_opacity = $layer->option_opacity;
      $option_visible = $layer->option_visible;
      $option_style = $layer->option_style;
      $parent_id = $layer->parent_id;
    }
  ?>
<form role="form" method="post" action="{{ route('backend.layer.post')}}" enctype='multipart/form-data'>
  {{ csrf_field() }}
  <div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"> Layer</h3>
            </div>
            <div class="panel-body">
                <input type="hidden" name="id" class="form-control" id="id" value="{{$id}}">
                <div class="form-group">
                  <label for="namalayer">Nama Layer/Group</label>
                  <input type="text" name="namalayer" class="form-control" id="namalayer" value="{{$namalayer}}">
                </div>
                <div class="form-group">
                  <label for="kodelayer">Kodelayer</label>
                  <input type="text" name="kodelayer" class="form-control" id="kodelayer" value="{{$kodelayer}}">
                </div>
                <div class="form-group">
                  <label for="urllayer">Url Layer</label>
                  <input type="text" name="urllayer" class="form-control" id="urllayer" value="{{$urllayer}}">
                </div>
                <div class="form-group">
                  <label for="aktif">Aktif</label>
                  <input type="checkbox" name="aktif" id="aktif" value="1" @if($aktif === true) checked @endif>
                </div>
                <div class="form-group">
                  <label for="urutanlayer">Urutan Layer</label>
                  <input type="text" name="urutanlayer" class="form-control" id="urutanlayer" value="{{$urutanlayer}}">
                </div>
                <div class="form-group">
                  <label for="tipelayer">Tipe Layer</label>
                  <select name="tipelayer" id="tipelayer" class="form-control">
                    <option value="ol" @if($tipelayer == 'ol') selected @endif>Ol</option>
                    <option value="olgroup" @if($tipelayer == 'olgroup') selected @endif>OL Group</option>
                    <option value="googlegroup" @if($tipelayer == 'googlegroup') selected @endif>Google Group</option>
                    <option value="googlegeojson" @if($tipelayer == 'googlegeojson') selected @endif>googlegeojson</option>
                    
                  </select>
                </div>
                <div class="form-group">
                  <label for="option_opacity">Opacity</label>
                  <input type="range" name="option_opacity" class="form-control" id="option_opacity" value="{{$option_opacity}}" min='0' max='1' step='0.01'>
                </div>

                <div class="form-group">
                  <label for="parent_id">Group</label>
                  <select name="parent_id" id="parent_id" class="form-control">
                    <option value="0">-------</option>
                    @foreach($groups as $k => $g)
                    <option value="{{$g->id}}" @if($parent_id == $g->id) selected @endif>{{$g->namalayer}}</option>
                    @endforeach
                  </select>
                  
                </div>

                <div class="form-group">
                  <label for="option_visible">option_visible</label>
                  <input type="checkbox" name="option_visible" id="option_visible" value="1" @if($option_visible === true) checked @endif>
                </div>

                <div class="form-group">
                  <label for="option_style">option_style</label>
                  <input type="text" class="form-control" name="option_style" id="option_style" value="{{$option_style}}">
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
