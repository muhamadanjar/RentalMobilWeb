@extends('layouts.adminlte.main')

@section('content-admin')
<div class="row">
    
        <div class="col-md-6">
          
            <div class="box box-info">
                <div class="box-header with-border">
                <h3 class="box-title">Laporan</h3>
                </div>
                <form class="form-horizontal" method="post" action="{{ route('backend.laporan.proses')}}">
                    {{csrf_field()}}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="jenislaporan" class="col-sm-2 control-label">Jenis Laporan</label>

                            <div class="col-sm-10">
                                <select class="form-control" id="jenislaporan" name="jenislaporan">
                                    <option>----</option>
                                    <option value='rental'>Rental</option>
                                    <option value='reguler'>Reguler</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="daritgl" class="col-sm-2 control-label">Dari Tanggal</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="daritgl" name="daritgl" placeholder="Dari Tgl">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sampaitgl" class="col-sm-2 control-label">Sampai Tanggal</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="sampaitgl" name="sampaitgl" placeholder="Sampai Tgl">
                            </div>
                        </div>
                    </div>
                
                    <div class="box-footer">
                        <button type="submit" class="btn btn-default">Batal</button>
                        <button type="submit" class="btn btn-info pull-right">Proses</button>
                    </div>
                
                </form>
          </div>
         
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Bordered Table</h3>
                </div>
                <div class="box-body">
                    @if(isset($data))
                    <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Dari</th>
                                <th>Tujuan</th>
                                <th>Customer</th>
                            </tr>
                        <tbody>
                        @foreach($data as $k => $v)
                            <tr>
                                <td>{{$v->no_transaksi}}</td>
                                <td>{{$v->origin}}</td>
                                <td>{{$v->destination}}</td>
                                <td></td>
                            </tr>
                        @endforeach
                        
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Table</h3>
                </div>
                <div class="box-body">
                    @if(isset($data))
                    <table class="table table-bordered">
                            <tr>
                                <th>#</th>
                                <th>Dari</th>
                                <th>Tujuan</th>
                                <th>Customer</th>
                            </tr>
                        <tbody>
                        @foreach($data as $k => $v)
                            <tr>
                                <td>{{$v->no_transaksi}}</td>
                                <td>{{$v->origin}}</td>
                                <td>{{$v->destination}}</td>
                                <td></td>
                            </tr>
                        @endforeach
                        
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
</div>
@endsection


@section('script-end')
@parent

    <script type="text/javascript">
        $(function () {

            //Date picker
            $('#daritgl').datepicker({
                autoclose: true
            });
            $('#sampaitgl').datepicker({
                autoclose: true
            })
        });
    </script>

@endsection