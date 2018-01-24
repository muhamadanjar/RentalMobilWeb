@extends('layouts.admin.admin')
@section('content-admin')
    <div class="row">
    <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading ">
            <h3 class="panel-title"><i class="fa fa-building"></i>Data Agenda</h3>
            <div class="panel-toolbar text-right">
                <div class="btn-group">
                    <?php //if(\Gate::check('create.global')){ ?>
                        <a href="{{ route('backend.agenda.tambah') }}" class="btn btn-primary btn-flat btn-sm"><span class="fa fa-plus"></span> Tambah</a>
                    <?php //} ?>
                </div>
            </div>
            
        </div>
        <div class="panel-body">
        	<table id="table_agenda" class="display table table-responsive table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="3%"></th>
                        <th>Agenda</th>
                        <th>Tempat</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    </div>
    </div>

@endsection
@section('title','Agenda')
@section('breadcrumb')
<ol class="breadcrumb breadcrumb-transparent nm">
    <li class="active"><a href="javascript:void(0);">Agenda</a></li>
</ol>
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