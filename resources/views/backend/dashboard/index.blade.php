@extends('layouts.adminlte.main')
@section('title','Dashboard')
@section('breadcrumb')

@endsection

@section('content-admin')
<?php 
    $_chartpesanan= json_decode($chartpesanan);
    
?>
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-car"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Mobil</span>
              <span class="info-box-number">{{$countmobil}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Driver</span>
              <span class="info-box-number">{{$countuser}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-wrench"></i>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <p class="text-center">
                    
                  </p>
                  <div class="box box-primary">
                    <div class="box-header">
                      <i class="ion ion-clipboard"></i>

                      <h3 class="box-title">Pemesanan</h3>

                      <div class="box-tools pull-right">
                        <ul class="pagination pagination-sm inline">
                          <li><a href="#">&laquo;</a></li>
                          <li><a href="#">1</a></li>
                          <li><a href="#">2</a></li>
                          <li><a href="#">3</a></li>
                          <li><a href="#">&raquo;</a></li>
                        </ul>
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
                      <ul class="todo-list">
                      @foreach($reguler as $k => $v)
                        <li>
                              <span class="handle">
                                <i class="fa fa-ellipsis-v"></i>
                                <i class="fa fa-ellipsis-v"></i>
                              </span>
                          
                              <input type="checkbox" value="">
                              <!-- todo text -->
                              <span class="text">
                              @if(isset($v->mobil)){{$v->mobil->name}} ({{$v->mobil->no_plat}})@endif -- ({{$v->customer->name}})
                                
                              </span>
                              <!-- Emphasis label -->
                              <small class="label label-info"><i class="fa fa-info"></i> {{$v->status}}</small>
                              <small class="label label-danger"><i class="fa fa-clock-o"></i> {{\Carbon\Carbon::parse($v->created_at)->diffForHumans()}}</small>
                              <!-- General tools such as edit or delete-->
                              <div class="tools">
                                <a href="{{ route('backend.transaksi.taskform',[$v->id]) }}"><i class="fa fa-edit"></i></a>
                                <i class="fa fa-trash-o"></i>
                              </div>
                        </li>
                      @endforeach
                      </ul>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix no-border">
                    </div>
                  </div>
                  <div class="chart">
                    
                    <div id="orderChart1" style="min-width: 310px; height: 300px; margin: 0 auto"></div>
                  </div>
                  
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  

                 
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Data Transaksi</h3>

                      <div class="box-tools pull-right">
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <ul class="products-list product-list-in-box">
                        @foreach($listtransaksi as $k => $v)
                        <li class="item">
                          <div class="product-img">
                            @if(isset($v->mobil))
                              <img src="{{$v->mobil->getPermalink()}}{{$v->mobil->foto}}" alt="Image">
                            @else
                            <img src="http://placehold.it/160" alt="Image">
                            @endif
                          </div>
                          <div class="product-info">
                            <a href="javascript:void(0)" class="product-title">
                              @if(isset($v->mobil)){{$v->mobil->name}} ({{$v->mobil->no_plat}})@endif
                              <span class="label label-warning pull-right">Rp. {{number_format($v->total_bayar)}}</span></a>
                              <span class="product-description">
                                  {{$v->origin }} <i class="fa fa-arrow-right"></i> {{$v->destination}}
                              </span>
                          </div>
                        </li>
                        @endforeach
                        
                      </ul>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer text-center">
                      <a href="{{ route('backend.transaksi.index')}}" class="uppercase">Lihat Semua Transaksi</a>
                    </div>
                    
                  </div>
                  
                  
                  <!--<div class="progress-group">
                    <span class="progress-text">Complete Purchase</span>
                    <span class="progress-number"><b>310</b>/400</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                    </div>
                  </div>
                  
                  <div class="progress-group">
                    <span class="progress-text">Visit Premium Page</span>
                    <span class="progress-number"><b>480</b>/800</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                    </div>
                  </div>
                  
                  <div class="progress-group">
                    <span class="progress-text">Send Inquiries</span>
                    <span class="progress-number"><b>250</b>/500</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
                    </div>
                  </div>-->
                  
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            
            <div class="box-footer">
              
            </div>
            
          </div>
          <
        </div>
        <!-- /.col -->
    </div>
    
@endsection

@section('script-end')
    @parent
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script>
      Highcharts.chart('orderChart', {
        chart: {
            type: 'column'
        },
        title: {
            text: '',
            style: {
                display: 'none'
            }
        },
        subtitle: {
            text: '',
            style: {
                display: 'none'
            }
        },
        
        xAxis: {
            categories: [
               
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} pesan</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: @if(isset($_chartpesanan->chart)){!! json_encode($_chartpesanan->chart,JSON_NUMERIC_CHECK) !!} @else [] @endif,
    });
    </script>
@endsection