@extends('layouts.admin.admin')

@section('breadcrumb')
    @parent
    <span class="trail"><i class="fa fa-angle-right"></i></span>
    <span class="trail">Tenaga Kerja</span>
@stop

@section('content-admin')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Tenaga Kerja</h3>
                    <div class="panel-toolbar text-right">
                        <div class="btn-group">
                            <a href="{{ route('backend.tenagakerja.pyb.create') }}" class="btn btn-primary btn-sm btn-flat"> Tambah</a> 
                        </div>
                    </div>
                </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover" id="table_dom">
                    <thead>
                        <tr>
                            <th>Status Pekerjaan</th>
                            <th>Tahun</th>
                            <th>Jumlah</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($pyb as $migrasi)
                    <tr>
                        <td>{{ $migrasi->status_pekerjaan }}</td>
                        <td>{{ $migrasi->tahun }}</td>
                        <td><span class="badge">{{ $migrasi->jumlah }}</span></td>
                        <td class="text-center">
                            <form class="form-delete" method="post" action="{{ route('backend.tenagakerja.pyb.destroy', [$migrasi->id]) }}">
                            <input name="_method" type="hidden" value="DELETE">
                            {{ csrf_field()}}
                            <div class="btn-group text-center">
                                <a href="{{ route('backend.tenagakerja.pyb.edit', [$migrasi->id]) }}" class="btn btn-default btn-sm">Edit</a>
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>    
                            </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            
            </div>
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
