@extends('layouts.adminlte.main')
@section('title','Dashboard')
@section('breadcrumb')

@endsection

@section('content-admin')
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-car"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Mobil</span>
              <span class="info-box-number">760</span>
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
              <span class="info-box-text">Anggota</span>
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
              <h3 class="box-title">Rekaptulasi Laporan Bulanan</h3>

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
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <p class="text-center">
                    <strong>Pemesanan: 1 Jan, 2014 - 30 Jul, 2014</strong>
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <div id="orderChart" style="min-width: 310px; height: 300px; margin: 0 auto"></div>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <p class="text-center">
                    <strong>Data Transaksi</strong>
                  </p>

                 
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Data Transaksi</h3>

                      <div class="box-tools pull-right">
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <ul class="products-list product-list-in-box">
                        <li class="item">
                          <div class="product-img">
                            <img src="dist/img/default-50x50.gif" alt="Product Image">
                          </div>
                          <div class="product-info">
                            <a href="javascript:void(0)" class="product-title">
                              <span class="label label-warning pull-right">Rp. 401.800</span></a>
                              <span class="product-description">
                                  Transaksi 1
                              </span>
                          </div>
                        </li>
                        
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
            <!-- ./box-body -->
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                    <h5 class="description-header">$35,210.43</h5>
                    <span class="description-text">Total Pendapatan</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                    <h5 class="description-header">$10,390.90</h5>
                    <span class="description-text">Total Biaya</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                    <h5 class="description-header">$24,813.53</h5>
                    <span class="description-text">TOTAL Keuntungan</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
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
                '2014',
                '2015',
                '2016',
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
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
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
        series: [{
            name: 'Mobil',
            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
        }, {
            name: 'Bus',
            data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

        }]
    });
    </script>
@endsection