@extends('layouts.adminlte.main')
@section('content-admin')
    <div class="panel panel-default">
        <div class="panel-heading with-border">
            <h3 class="panel-title">Permissions</h3>
            <div class="panel-toolbar text-right">
                <div class="btn-group">
                    <?php if(\Gate::check('access.permission')){ ?>
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
                        <th>Permission</th>
                        <th></th>

                    </tr>
                </thead>
                
                <tbody>
                    @foreach($permissions as $key => $p)
                    <tr>
                        <td></td>
                        <td>{{ $p->name }}</td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>

@endsection

@section('style-head')
@parent
<link rel="stylesheet" href="{{ url('/plugins/datatables/datatables.min.css')}}">
<link rel="stylesheet" href="{{ url('/plugins/datatables/css/tabletools.css')}}">
@endsection
@section('script-end')
@parent
<script src="{{ url('/plugins/datatables/datatables.min.js')}}"></script>

<script src="{{ asset('/js/rm.js') }}"></script>
@endsection