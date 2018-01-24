@extends('layouts.admin.admin')
@section('content-admin')
    <div class="panel panel-default">
        <div class="panel-heading with-border">
            <h3 class="panel-title">DAFTAR UPLOAD DOKUMEN</h3>
            <div class="panel-toolbar text-right">
                <div class="btn-group">
                    <?php if(\Gate::check('create.dokumen')){ ?>
                    <a href="{{ route('backend.dokumen.tambah') }}" class="btn btn-sm btn-primary"><span class="fa fa-plus"></span> Tambah</a>
                    <?php } ?>
                </div>
            </div>
            
        </div>
            <!-- /.box-header -->
        <div class="panel-body">
        	<table class="display table" cellspacing="0" width="100%" id="table_dom">
                <thead>
                    <tr>
                        <th></th>
                        <th>Judul Dokumen</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($dokumen as $key => $p)
                    <tr>
                        <td>
                            <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-sm btn-default btn-flat dropdown-toggle" type="button">
                                <i class="caret"></i>&nbsp;
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('backend.dokumen.edit',array($p->id,'edit')) }}"><i class="fa fa-edit"></i> Edit</a></li>
                                    <li data-form="#frmDelete-{{ $p->id }}" 
                                        data-title="Hapus Informasi" 
                                        data-message="Anda yakin menghapus informasi ini ?">
                                        <a href="#" class="formConfirm"><i class="fa fa-trash"></i> Hapus</a></li>
                                        <form 
                                            action="{{ route('backend.dokumen.delete',array($p->id)) }}" 
                                            method="post" 
                                            style="display:none" 
                                            id="frmDelete-{{ $p->id }}">
                                            {{ csrf_field() }}
                                            <input name="_method" type="hidden" value="DELETE">    
                                        </form>
                                    <li><a href="{{ route('backend.dokumen.download',array($p->id)) }}"><i class="fa fa-download"></i> Download</a></li>                                            
                                </ul>
                            </div>
                        </td>
                        <td>{{ $p->judul_dokumen }}</td>
                        <td>{{ $p->kategori }}</td>
                        <td>{{ date('M d, Y', strtotime($p->tanggal)) }}</td>        
                    </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>

@endsection

@section('style-head')
@parent
<link rel="stylesheet" href="{{ url('assets/plugins/datatables/css/datatables.css')}}">
<link rel="stylesheet" href="{{ url('assets/plugins/datatables/css/tabletools.css')}}">
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
<script type="text/javascript" src="{{ url('js/sikko.js')}}"></script>

@endsection