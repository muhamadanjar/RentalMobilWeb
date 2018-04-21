<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <title>Front Page</title>
        <!-- Bootstrap -->
        <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('bootstrap/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/front.css') }}" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="{{ asset('assets/js/libs/jquery-1.10.2.min.js') }}"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.2/moment.min.js"></script>
        <script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap-datetimepicker.js') }}"></script>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css"/>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
        <script type="text/javascript">
            $(function() {
                $.get("{{ route('home') }}").done(function(data) {
                    $('#home').html(data);
                });
                $('a[title]').tooltip();
                var url = "<?php echo URL::to('/'); ?>";
                $('.nav li').not('.active').addClass('disabled');
                $('.nav li').not('.active').find('a').removeAttr("data-toggle");
                $('#myTab a[href="#home"]').on('show.bs.tab', function(e) {
                    var page = e.target.hash.slice(1);
                    console.log(page);
                    $.get(url + '/' + page).done(function(data) {
                        $('#' + page).html(data);
                    });
                });
            });
        </script>
    </head>
    <body>
        <section style="background:#efefe9;">
            <div class="container">
                <div class="row">
                    <div class="board">
                        <div class="board-inner">
                            <ul class="nav nav-tabs" id="myTab">
                                <div class="liner"></div>
                                <li class="active">
                                    <a href="#home" data-toggle="tab" title="When & Where">
                                        <span class="round-tabs one">
                                            <i class="glyphicon glyphicon-map-marker"></i>
                                        </span> 
                                    </a></li>

                                <li><a href="#choosecar" data-toggle="tab" title="Choose Car">
                                        <span class="round-tabs two">
                                            <i class="fa fa-car"></i>
                                        </span> 
                                    </a>
                                </li>
                                <li><a href="#extra" data-toggle="tab" title="Choose Extra">
                                        <span class="round-tabs three">
                                            <i class="glyphicon glyphicon-gift"></i>
                                        </span> </a>
                                </li>

                                <li><a href="#customer" data-toggle="tab" title="Checkout">
                                        <span class="round-tabs four">
                                            <i class="fa fa-usd"></i>
                                        </span> 
                                    </a>
                                </li>
                                <li>
                                    <a href="#complete" data-toggle="tab" title="Completed">
                                        <span class="round-tabs five">
                                            <i class="glyphicon glyphicon-ok"></i>
                                        </span> </a>
                                </li>

                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="home">

                            </div>
                            <div class="tab-pane fade" id="choosecar">
                            </div>
                            <div class="tab-pane fade" id="extra">
                            </div>
                            <div class="tab-pane fade" id="customer">
                            </div>
                            <div class="tab-pane fade" id="complete">
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </body>

</html>