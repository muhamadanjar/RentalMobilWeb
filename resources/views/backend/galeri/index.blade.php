@extends('layouts.admin.admin')

@section('breadcrumb')
    @parent
    <span class="trail"><i class="fa fa-angle-right"></i></span>
    <span class="trail">Halaman Galeri</span>
@stop

@section('content-admin')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Halaman Galeri</h3>
                    <div class="panel-toolbar text-right">
                        <div class="btn-group">
                            @if($type == 'media')
                            <a href="{{ route('backend.media.create', ['type' => $type]) }}" class="btn btn-primary btn-flat"> Tambah Media</a> 
                            @else
                            <a href="{{ route('backend.album.create', ['type' => $type]) }}" class="btn btn-primary btn-flat"> Tambah Album</a> 
                            @endif
                        </div>
                    </div>
                </div>
            <div class="panel-body">
                @include('backend.galeri.tab', ['active' => $type])
                <table class="table table-striped table-bordered table-hover" id="table_dom">
                    @if($type == 'album')
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Tipe Album</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        @foreach($album as $m)
                        <tr>
                            <td>{{ $m->name }}</td>
                            <td>{{ $m->type }}</td>
                            <td class="text-center">
                                <form class="form-delete" method="post" action="{{ route('backend.album.destroy', [$m->id]) }}">
                                    <div class="btn-group text-center">
                                        
                                        <a href="{{ route('backend.album.edit', [$m->id]) }}" class="btn btn-default btn-sm">Edit</a>
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="delete">
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>    
                                        
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Album</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        @foreach($media as $m)
                        <tr>
                            <td>{{ $m->filename }}</td>
                            <td>{{ $m->album->name }}</td>
                            <td class="text-center">
                                <form class="form-delete" method="post" action="{{ route('backend.media.destroy', [$m->id]) }}">
                                <div class="btn-group text-center">
                                        <a href="{{ route('backend.media.edit', [$m->id]) }}" class="btn btn-default btn-sm">Edit</a>
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>    
                                </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @endif
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