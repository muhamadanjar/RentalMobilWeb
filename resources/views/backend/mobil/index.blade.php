@extends('layouts.adminlte.main')
@section('content-admin')
    <div class="panel panel-default">
        <div class="panel-heading with-border">
            <h3 class="panel-title">Mobil</h3>
            <div class="panel-toolbar text-right">
                <div class="btn-group">
                    <a href="{{ route('backend.mobil.create') }}" class="btn btn-sm btn-primary"><span class="fa fa-plus"></span> Tambah</a>
                    
                </div>
            </div>
            
        </div>
            <!-- /.box-header -->
        <div class="panel-body">
        	<table class="display table" cellspacing="0" width="100%" id="table_dom">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nama</th>
                        <th>Merk</th>
                        <th>Type</th>
                        <th>Warna</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($mobil as $key => $p)
                    <tr>
                        <td>
                            <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-sm btn-default btn-flat dropdown-toggle" type="button">
                                <i class="caret"></i>&nbsp;
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('backend.mobil.edit',array($p->id,'edit')) }}"><i class="fa fa-edit"></i> Edit</a></li>
                                    <li data-form="#frmDelete-{{ $p->id }}" 
                                        data-title="Hapus Informasi" 
                                        data-message="Anda yakin menghapus informasi ini ?">
                                        <a href="#" class="formConfirm"><i class="fa fa-trash"></i> Hapus</a></li>
                                        <form 
                                            action="{{ route('backend.mobil.destroy',array($p->id)) }}" 
                                            method="post" 
                                            style="display:none" 
                                            id="frmDelete-{{ $p->id }}">
                                            {{ csrf_field() }}
                                            <input name="_method" type="hidden" value="DELETE">    
                                        </form>
                                </ul>
                            </div>
                        </td>
                        <td>{{ $p->no_plat }}</td>
                        <td><span class="badge badge-primary">{{ $p->merk }}</span></td>
                        <td>{{ $p->type }}</td>
                        <td>{{ $p->warna }}</td>
                        <td>{{ $p->harga }}</td>        
                    </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>

@endsection
@section('title','Mobil')
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