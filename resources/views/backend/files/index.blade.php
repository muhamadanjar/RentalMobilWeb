@extends('layouts.admin.admin')

@section('breadcrumb')
    @parent
    <span class="trail"><i class="fa fa-angle-right"></i></span>
    <span class="trail">File Manager</span>
@stop

@section('content-admin')
    <div class="panel panel-default">
        <div class="panel-heading">
            @foreach($paths as $url => $label)
                <h3 class="panel-title"><a href="{{ $url }}">{{ $label }}</a>
                <i class="fa fa-angle-right"></i></h3>
            @endforeach
        </div>
        <table class="table table-bordered">
            <tr>
                <td colspan="4">
                    <form action="{{ route('backend.files.store') }}" enctype="multipart/form-data" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="path" value="{{$path}}">
                        <input type="file" name="file" style="display:inline">
                        <button type="submit" class="btn btn-default">Upload</button>
                    </form>
                </td>
            </tr>
            @foreach($items as $item)
                <tr>
                    <td>
                        @if($item['is_file'])
                            @if($item['is_image'])
                                <i class="fa fa-file-image-o"></i>
                            @elseif($item['is_video'])
                                <i class="fa fa-file-video-o"></i>
                            @else
                                <i class="fa fa-file-o"></i>
                            @endif
                                {{ $item['name'] }}
                        @else
                            <i class="fa fa-folder-o"></i>
                            <a href="{{ $item['permalink'] }}">{{ $item['name'] }}</a>
                        @endif
                    </td>
                    <td>
                        @if($item['is_directory'])
                            <small class="badge">{{ $item['file_count'] }} files</small>
                        @else
                            <small class="text-muted">{{ $item['extension'] }}</small>
                        @endif
                    </td>
                    <td>
                        {{ $item['size_for_human'] }}
                    </td>
                    <td width="100px">
                        @if($item['is_file'])
                            <form method="post" class="form-delete" action="{{ route('backend.files.destroy', [$item['id']]) }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-xs btn-link4 btn-danger btn-delete" type="submit"><i class="ion-backspace-outline"></i> Hapus</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@stop

