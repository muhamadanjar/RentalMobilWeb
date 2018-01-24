@extends('layouts.admin.dashboard')
@section('title','Dashboard')
@section('breadcrumb')

@endsection

@section('content-dashboard')
<?php 
    $_statistik = json_decode($chartstatistik);
?>
        <section id="main" role="main">
                <div class="row">
                    <!-- START Left Side -->
                    <div class="col-md-9">
                        <!-- Top Stats -->
                        <div class="row">
                            <div class="col-sm-4">
                                <!-- START Statistic Widget -->
                                <div class="table-layout animation delay animating fadeInDown">
                                    <div class="col-xs-4 panel bgcolor-info text-center">
                                        <div class="ico-users3 fsize24"></div>
                                    </div>
                                    <div class="col-xs-8 panel">
                                        <div class="panel-body text-center">
                                            <h4 class="semibold nm">{{ $countuser }}</h4>
                                            <p class="semibold text-muted mb0 mt5 ellipsis">USERS</p>
                                        </div>
                                    </div>
                                </div>
                                <!--/ END Statistic Widget -->
                            </div>
                            <div class="col-sm-4">
                                <!-- START Statistic Widget -->
                                <div class="table-layout animation delay animating fadeInUp">
                                    <div class="col-xs-4 panel bgcolor-teal text-center">
                                        <div class="ico-newspaper fsize24"></div>
                                    </div>
                                    <div class="col-xs-8 panel">
                                        <div class="panel-body text-center">
                                            <h4 class="semibold nm">{{ $countpost}}</h4>
                                            <p class="semibold text-muted mb0 mt5 ellipsis">BERITA</p>
                                        </div>
                                    </div>
                                </div>
                                <!--/ END Statistic Widget -->
                            </div>
                            <div class="col-sm-4">
                                <!-- START Statistic Widget -->
                                <div class="table-layout animation delay animating fadeInDown">
                                    <div class="col-xs-4 panel bgcolor-primary text-center">
                                        <div class="ico-calendar fsize24"></div>
                                    </div>
                                    <div class="col-xs-8 panel">
                                        <div class="panel-body text-center">
                                            <h4 class="semibold nm">{{$countagenda}}</h4>
                                            <p class="semibold text-muted mb0 mt5 ellipsis">AGENDA</p>
                                        </div>
                                    </div>
                                </div>
                                <!--/ END Statistic Widget -->
                            </div>
                        </div>
                        <!--/ Top Stats -->
                        
                        <!-- Website States -->
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- START panel -->
                                <div class="panel mt10">
                                    <!-- panel-toolbar -->
                                    <div class="panel-heading pt10">
                                        <div class="panel-toolbar">
                                            <h5 class="semibold nm ellipsis">Statistik Pengunjung</h5>
                                        </div>
                                        <div class="panel-toolbar text-right">
                                            <!--<div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-default">Duration</button>
                                                <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li class="dropdown-header">Select duration :</li>
                                                    <li><a href="#">Year</a></li>
                                                    <li><a href="#">Month</a></li>
                                                    <li><a href="#">Week</a></li>
                                                    <li><a href="#">Day</a></li>
                                                </ul>
                                            </div>-->
                                        </div>
                                    </div>
                                    <!--/ panel-toolbar -->
                                    <!-- panel-body -->
                                    <div class="panel-body pt0">
                                        <div id="statistik" style="min-width: 310px; max-width: 800px; height: 300px; margin: 0 auto"></div>

                                    </div>
                                    <!--/ panel-body -->
                                    <!-- panel-footer -->
                                    
                                    <!--<div class="panel-footer hidden-xs">
                                        <ul class="nav nav-section nav-justified">
                                            <li>
                                                <div class="section">
                                                    <h4 class="bold text-default mt0 mb5" data-toggle="counterup">24,548</h4>
                                                    <p class="nm text-muted">
                                                        <span class="semibold">Visits</span>
                                                        <span class="text-muted mr5 ml5">•</span>
                                                        <span class="text-danger"><i class="ico-arrow-down4"></i> 32%</span>
                                                    </p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="section">
                                                    <h4 class="bold text-default mt0 mb5" data-toggle="counterup">175,132</h4>
                                                    <p class="nm text-muted">
                                                        <span class="semibold">Page Views</span>
                                                        <span class="text-muted mr5 ml5">•</span>
                                                        <span class="text-success"><i class="ico-arrow-up4"></i> 15%</span>
                                                    </p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="section">
                                                    <h4 class="bold text-default mt0 mb5"><span data-toggle="counterup">89.96</span>%</h4>
                                                    <p class="nm text-muted">
                                                        <span class="semibold">Bounce Rate</span>
                                                        <span class="text-muted mr5 ml5">•</span>
                                                        <span class="text-success"><i class="ico-arrow-up4"></i> 3%</span>
                                                    </p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>-->
                                    <!--/ panel-footer -->
                                </div>
                                <!--/ END panel -->
                            </div>
                        </div>
                        <!--/ Website States -->

                        <!-- Data Transmigrasi -->
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- START panel -->
                                <div class="panel panel-default">
                                    <!-- panel heading/header -->
                                    <div class="panel-heading">
                                        <h3 class="panel-title ellipsis"><i class="ico-chrome mr5"></i>Data Transmigrasi</h3>
                                        <!-- panel toolbar -->
                                        <div class="panel-toolbar text-right">
                                            <!-- option -->
                                            <div class="option">
                                                <button class="btn up" data-toggle="panelcollapse"><i class="arrow"></i></button>
                                                <button class="btn" data-toggle="panelremove" data-parent=".col-md-12"><i class="remove"></i></button>
                                            </div>
                                            <!--/ option -->
                                        </div>
                                        <!--/ panel toolbar -->
                                    </div>
                                    <!--/ panel heading/header -->
                                    <!-- panel body with collapse capabale -->
                                    <div class="table-responsive panel-collapse pull out">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Asal</th>
                                                    <th>Tujuan</th>
                                                    <th>Target Tahun</th>
                                                    <th>Target KK</th>
                                                    <th>Realisasi KK</th>
                                                    <th>Realisasi Jiwa</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($transdata as $key => $v)
                                                <tr>
                                                    <td><span class="semibold text-accent">{{$v->nama_provinsi}}</span></td>
                                                    <td><span class="semibold text-accent">{{$v->wt_name}}</span></td>
                                                    <td>{{$v->JmlTahun}}</td>
                                                    <td>{{$v->JmlKK}}</td>
                                                    <td>{{$v->ReaKK}}</td>
                                                    <td>{{$v->ReaJiwa}}</td>

                                                </tr>
                                                @endforeach
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--/ panel body with collapse capabale -->
                                </div>
                                <!--/ END panel -->
                            </div>
                        </div>
                        <!-- Data Transmigrasi -->
                        
                    </div>
                    <!--/ END Left Side -->

                    <!-- START Right Side -->
                    <!--
                    <div class="col-md-3">
                        <div class="panel panel-minimal">
                            <div class="panel-heading"><h5 class="panel-title"><i class="ico-health mr5"></i>Latest Activity</h5></div>
                        
                            
                            <ul class="media-list media-list-feed nm">
                                <li class="media">
                                    <div class="media-object pull-left">
                                        <i class="ico-pencil bgcolor-success"></i>
                                    </div>
                                    <div class="media-body">
                                        <p class="media-heading">EDIT EXISTING PAGE</p>
                                        <p class="media-text"><span class="text-primary semibold">Service Page</span> has been edited by Tamara Moon.</p>
                                        <p class="media-meta">Just Now</p>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-object pull-left">
                                        <i class="ico-file-plus bgcolor-success"></i>
                                    </div>
                                    <div class="media-body">
                                        <p class="media-heading">CREATE A NEW PAGE</p>
                                        <p class="media-text"><span class="text-primary semibold">Service Page</span> has been created by Tamara Moon.</p>
                                        <p class="media-meta">2 Hour Ago</p>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-object pull-left">
                                        <i class="ico-upload22 bgcolor-success"></i>
                                    </div>
                                    <div class="media-body">
                                        <p class="media-heading">UPLOAD CONTENT</p>
                                        <p class="media-text">Tamara Moon has uploaded 8 new item to the directory</p>
                                        <p class="media-meta">3 Hour Ago</p>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-object pull-left">
                                        <img src="../image/avatar/avatar6.jpg" class="media-object img-circle" alt="">
                                    </div>
                                    <div class="media-body">
                                        <p class="media-heading">NEW MESSAGE</p>
                                        <p class="media-text">Arthur Abbott send you a message</p>
                                        <p class="media-meta">3 Hour Ago</p>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-object pull-left">
                                        <i class="ico-upload22 bgcolor-success"></i>
                                    </div>
                                    <div class="media-body">
                                        <p class="media-heading">UPLOAD CONTENT</p>
                                        <p class="media-text">Tamara Moon has uploaded 3 new item to the directory</p>
                                        <p class="media-meta">7 Hour Ago</p>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-object pull-left">
                                        <i class="ico-link5 bgcolor-success"></i>
                                    </div>
                                    <div class="media-body">
                                        <p class="media-heading">NEW UPDATE AVAILABLE</p>
                                        <p class="media-text">3 new update is available to download</p>
                                        <p class="media-meta">Yesterday</p>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="media-object pull-left">
                                        <i class="ico-loop4"></i>
                                    </div>
                                    <div class="media-body">
                                        <a href="javascript:void(0);" class="media-heading text-primary">Load more feed</a>
                                    </div>
                                </li>
                            </ul>
                            
                        </div>
                    </div>
                    -->
                </div>
                <!-- Data Transmigrasi Daerah -->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- START panel -->
                                <div class="panel panel-default">
                                    <!-- panel heading/header -->
                                    <div class="panel-heading">
                                        <h3 class="panel-title ellipsis"><i class="ico-exchange mr5"></i>Data Transmigrasi Daerah</h3>
                                        <!-- panel toolbar -->
                                        <div class="panel-toolbar text-right">
                                            <!-- option -->
                                            <div class="option">
                                                <button class="btn up" data-toggle="panelcollapse"><i class="arrow"></i></button>
                                                <button class="btn" data-toggle="panelremove" data-parent=".col-md-12"><i class="remove"></i></button>
                                            </div>
                                            <!--/ option -->
                                        </div>
                                        <!--/ panel toolbar -->
                                    </div>
                                    <!--/ panel heading/header -->
                                    <!-- panel body with collapse capabale -->
                                    <div class="table-responsive panel-collapse pull out">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    
                                                    <th rowspan='2'>Asal/Tujuan</th>
                                                    <th colspan="4" class="text-center">Banten</th>
                                                    <th colspan="4" class="text-center">DKI</th>
                                                    <th colspan="4" class="text-center">Jabar</th>
                                                </tr>
                                                <tr>
                                                    <th>Target Tahun</th>
                                                    <th>Target KK</th>
                                                    <th>Realisasi KK</th>
                                                    <th>Realisasi Jiwa</th>

                                                    <th>Target Tahun</th>
                                                    <th>Target KK</th>
                                                    <th>Realisasi KK</th>
                                                    <th>Realisasi Jiwa</th>

                                                    <th>Target Tahun</th>
                                                    <th>Target KK</th>
                                                    <th>Realisasi KK</th>
                                                    <th>Realisasi Jiwa</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($transdatadaerah as $key => $v)
                                                <tr>
                                                    
                                                    <td><span class="semibold text-accent">{{$v->nama_kabupaten}}</span></td>
                                                    <td>{{number_format($v->BantenJmlTahun,2,",",".")}}</td>
                                                    <td>{{number_format($v->BantenJmlKK,2,",",".")}}</td>
                                                    <td>{{number_format($v->BantenReaKK,2,",",".")}}</td>
                                                    <td>{{number_format($v->BantenReaJiwa,2,",",".")}}</td>

                                                    <td>{{number_format($v->DKIJmlTahun,2,",",".")}}</td>
                                                    <td>{{number_format($v->DKIJmlKK,2,",",".")}}</td>
                                                    <td>{{number_format($v->DKIReaKK,2,",",".")}}</td>
                                                    <td>{{number_format($v->DKIReaJiwa,2,",",".")}}</td>

                                                    <td>{{number_format($v->JabarJmlTahun,2,",",".")}}</td>
                                                    <td>{{number_format($v->JabarJmlKK,2,",",".")}}</td>
                                                    <td>{{number_format($v->JabarReaKK,2,",",".")}}</td>
                                                    <td>{{number_format($v->JabarReaJiwa,2,",",".")}}</td>
                                                        
                                                    
                                                </tr>
                                                @endforeach
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--/ panel body with collapse capabale -->
                                </div>
                                <!--/ END panel -->
                            </div>
                        </div>
                <!-- Data Transmigrasi Daerah -->
        </section>
@endsection

@section('script-end')
        <script type="text/javascript" src="{{ url('assets/plugins/selectize/js/selectize.js')}}"></script>
        <script type="text/javascript" src="{{ url('assets/plugins/highcharts/highcharts.js')}}"></script>
        <script type="text/javascript" src="{{ url('assets/plugins/flot/js/jquery.flot.js')}}"></script>
        <script type="text/javascript" src="{{ url('assets/plugins/flot/js/jquery.flot.resize.js')}}"></script>
        <script type="text/javascript" src="{{ url('assets/plugins/flot/js/jquery.flot.categories.js')}}"></script>
        <script type="text/javascript" src="{{ url('assets/plugins/flot/js/jquery.flot.time.js')}}"></script>
        <script type="text/javascript" src="{{ url('assets/plugins/flot/js/jquery.flot.tooltip.js')}}"></script>
        <script type="text/javascript" src="{{ url('assets/plugins/flot/js/jquery.flot.spline.js')}}"></script>
        <script type="text/javascript" src="{{ url('/javascript/backend/pages/dashboard-v1.js')}}"></script>
        <script>
            var chart = Highcharts.chart('statistik', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: null
                },
                subtitle: {
                    text: null
                },
                xAxis: {
                    categories: {!!json_encode($_statistik->category)!!},
                    type: 'datetime',
                },
                yAxis: {
                    title: {
                        text: 'Stasistik Per Bulan'
                    },
                    labels: {
                        formatter: function () {
                            return this.value / 1000 + 'k';
                        }
                    }
                },
                tooltip: {
                    //pointFormat: '{series.name} produced <b>{point.y:,.0f}</b><br/>warheads in {point.x}'
                    headerFormat: 'Statistik: {point.x:.1f} km<br>',
                    pointFormat: '{point.y} m a. s. l.',
                    shared: true
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true
                        },
                        enableMouseTracking: false
                    }
                },
                series: {!! json_encode($_statistik->chart,JSON_NUMERIC_CHECK) !!},
                legend: {
                    enabled: false
                },
                credits:{
                    enabled:false
                },
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                align: 'center',
                                verticalAlign: 'bottom',
                                layout: 'horizontal'
                            },
                            yAxis: {
                                labels: {
                                    align: 'left',
                                    x: 0,
                                    y: -5
                                },
                                title: {
                                    text: null
                                }
                            },
                            subtitle: {
                                text: null
                            },
                            credits: {
                                enabled: false
                            }
                        }
                    }]
                }
            });

            $('#small').click(function () {
                chart.setSize(400, 300);
            });

            $('#large').click(function () {
                chart.setSize(600, 300);
            });
    
        </script>
@endsection