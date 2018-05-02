@extends('layouts.adminlte.main')

@section('content-admin')
  <?php
    
    $id = '';
    $kode_promo ='';
    $name = '';
    
    $image='';
    $tgl_mulai='';
    $tgl_akhir='';
    if(session('aksi') == 'edit'){
        $id = $promo->id;
        $kode_promo =$promo->kode_promo;
        $name = $promo->name;
        
        $image=$promo->foto;
        $tgl_mulai=$promo->tgl_mulai;
        $tgl_akhir=$promo->tgl_akhir;
    }
  ?>
<form role="form" method="post" action="{{ route('backend.promo.post')}}" enctype='multipart/form-data'>
  {{ csrf_field() }}
  <div class="row">
    <div class="col-md-12">
        <div class="box box-default color-palette-box">
            <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-tag"></i> Promo</h3>
            </div>
            <div class="box-body">
                <div class="col-md-8">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                        <h3 class="panel-title"> Data Promo</h3>
                        </div>
                        <div class="panel-body">
                            <input type="hidden" name="id" class="form-control" id="id" value="{{$id}}">
                            <div class="form-group">
                                <label for="kode_promo">Kode Promo</label>
                                <input type="text" name="kode_promo" class="form-control" id="kode_promo" value="{{$kode_promo}}">
                            </div>
                            <div class="form-group">
                                <label for="kode_promo">Promo</label>
                                <input type="text" name="promo" class="form-control" id="promo" value="{{$name}}">
                            </div>
                            <div class="form-group">
                                <label for="kode_promo">Dari</label>
                                <input type="text" name="tgl_mulai" class="form-control" id="tgl_mulai" value="{{$tgl_mulai}}">
                            </div>
                            <div class="form-group">
                                <label for="kode_promo">Sampai</label>
                                <input type="text" name="tgl_akhir" class="form-control" id="tgl_akhir" value="{{$tgl_akhir}}">
                            </div>
                            <div class="form-group">
                                <label for="kode_promo">Deskripsi</label>
                                <textarea name="description" id="description" class="form-control"></textarea>
                            </div>
                            

                        </div>

                        <div class="panel-footer">
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"> Gambar </h3>
                        </div>
                        <div class="panel-body">
                        
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="foto">
                                        <?php 
                                        if (file_exists($path.'/'.$image)) {
                                        ?>
                                        <img src="{{ $permanentlink }}/{{ $image }}" alt="{{$name}}" class="img-responsive imgfoto" width="100%">
                                        <?php  
                                        }else{
                                        ?>
                                        <img src="http://placehold.it/240" alt="{{$name}}" class="img-responsive imgfoto" width="100%">
                                        <?php  
                                        }
                                        ?>
                                    </div>
                                    <div class="input-group margin controlupload">
                                        <input type="text" class="form-control txtfoto" readonly="readonly" name="foto" value="{{ $image }}">
                                        <span class="input-group-btn">
                                            <input type="file" name="users_file" class="hidden file fileupload" 
                                            data-url="{{ route('backend.promo.upload')}}" 
                                            data-path="{{ asset('/images/uploads/promo/')}}">
                                            <button type="button" class="btn btn-info btn-flat formUpload">Foto!</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="panel-footer">
                            
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
<script type="text/javascript" src="{{ url('/plugins/jquery-ui/js/jquery-ui.js')}}"></script>
<script type="text/javascript" src="{{ url('/plugins/datatables/datatables.min.js')}}"></script>
<script type="text/javascript">
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2();
        //Date picker
        $('#tgl_mulai').datepicker({
            autoclose: true
        });
        $('#tgl_akhir').datepicker({
            autoclose: true
        });
    });
</script>
<script type="text/javascript" src="{{ url('js/rm.js')}}"></script>
@endsection
