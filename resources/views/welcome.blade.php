<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('/plugins/bootstrap/dist/css/bootstrap.min.css')}}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('/plugins/font-awesome/css/font-awesome.min.css')}}">
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('/plugins/select2/dist/css/select2.min.css')}}">
        <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="{{ asset('/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
        <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="{{ asset('/plugins/jquery-ui/css/jquery-ui.css')}}">
        
        <link type="text/css" rel="stylesheet" href="{{ asset('/plugins/bootstrapvalidator/css/bootstrapValidator.min.css')}}"/>
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        <style>
            /* Form wizard */
            .stepy-step {
            padding: 0 20px;
            }
            .stepy-header {
            list-style: none;
            padding: 0;
            margin: 0;
            display: table;
            width: 100%;
            table-layout: fixed;
            }
            .stepy-header li {
            cursor: pointer;
            display: table-cell;
            vertical-align: top;
            width: auto;
            padding: 20px 0;
            text-align: center;
            position: relative;
            }
            .stepy-header li:after,
            .stepy-header li:before {
            content: '';
            display: block;
            position: absolute;
            top: 43px;
            width: 50%;
            height: 2px;
            background-color: #64c5b1;
            z-index: 9;
            }
            .stepy-header li:before {
            left: 0;
            }
            .stepy-header li:after {
            right: 0 !important;
            }
            .stepy-header li:first-child:before,
            .stepy-header li:last-child:after {
            content: none;
            }
            .stepy-header li span {
            display: block;
            margin-top: 10px;
            color: #999;
            font-weight: 600;
            }
            .stepy-header li div {
            background-color: #64c5b1;
            font-size: 0;
            position: relative;
            color: #ffffff;
            margin-left: auto;
            margin-right: auto;
            width: 48px;
            height: 48px;
            border: 2px solid #64c5b1;
            z-index: 10;
            line-height: 44px;
            text-align: center;
            border-radius: 50%;
            }
            .stepy-header li div:after {
            font-family: "Material Design Icons";
            -webkit-font-smoothing: antialiased;
            line-height: 44px;
            -webkit-transition: all 0.15s ease-in-out;
            -moz-osx-font-smoothing: grayscale;
            content: "\F12D";
            display: inline-block;
            font-size: 24px;
            -o-transition: all 0.15s ease-in-out;
            transition: all 0.15s ease-in-out;
            }
            .stepy-header li.stepy-active:after,
            .stepy-header li.stepy-active ~ li:after,
            .stepy-header li.stepy-active ~ li:before {
            background-color: #e2e2e2;
            }
            .stepy-header li.stepy-active ~ li div {
            border-color: #e2e2e2;
            background-color: #ffffff;
            color: #797979;
            font-size: 18px;
            font-weight: 600;
            }
            .stepy-header li.stepy-active ~ li div:after {
            content: none;
            }
            .stepy-header li.stepy-active div {
            cursor: auto;
            border-color: #64c5b1;
            background-color: #ffffff;
            color: #64c5b1;
            }
            .stepy-header li.stepy-active div:after {
            content: "\F64F";
            }
            .stepy-header li.stepy-active span {
            color: #64c5b1;
            }
            @media (max-width: 769px) {
            .stepy-header {
                margin-bottom: 20px;
            }
            .stepy-header li {
                display: block;
                float: left;
                width: 50%;
                padding-bottom: 0;
            }
            .stepy-header li:first-child:before,
            .stepy-header li:last-child:after {
                content: '';
            }
            .stepy-header li.stepy-active:last-child:after {
                background-color: #64c5b1;
            }
            }
            @media (max-width: 480px) {
            .stepy-header li {
                width: 100%;
            }
            .stepy-header li.stepy-active:after {
                background-color: #64c5b1;
            }
            }
            .stepy-navigator {
            text-align: right;
            margin-bottom: 0;
            margin-top: 20px;
            }
        </style>
    </head>
    <body>
        
        <div class="flex-center position-ref full-height">
            <div class="col-md-12">
            @if(Auth::check())
                <!-- left side start -->
                <div class="col-md-3 left-sidebar hidden-xs hidden-sm" style="position:fixed; left:10px">
                    
                </div>
                <!-- left side end -->

                <!-- center content start -->
                <div class="col-md-offset-3 col-md-6 col-sm-12 col-xs-12 center-con">
                    
                    <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                    <h4 class="m-t-0 header-title"><b>Rental Mobil</b></h4>
                                    <p class="text-muted m-b-30 font-13">
                                        
                                    </p>

                                    <form id="default-wizard">
                                        <fieldset title="1">
                                            <legend>Pesanan</legend>

                                            <div class="row m-t-20">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="pickup">Pick-up Date/Time</label>
                                                        <input type="text" class="form-control" id="pickup" placeholder="">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="return">Return Date/Time</label>
                                                        <input type="text" class="form-control" id="return" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="locpickup">Pick-up location</label>
                                                        <input type="text" class="form-control" id="locpickup" placeholder="">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="locreturn">Return location</label>
                                                        <input type="email" class="form-control" id="emailaddress" placeholder="">
                                                    </div>
                                                </div>
                                            </div>

                                        </fieldset>

                                        <fieldset title="2">
                                            <legend>Mobil</legend>

                                            <div class="row m-t-20">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="phonenumber">Pick Up Location:</label>
                                                        <address>
                                                        Lokasi 1
                                                        </address>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="address">Return Location</label>
                                                        <address>
                                                        Lokasi 2
                                                        </address>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="address">Harga</label>
                                                        <p>Harga</p>
                                                    </div>

                                                </div>
                                                <div class="col-sm-6">
                                                    
                                                    <div class="form-group">
                                                        <label for="car">Mobil</label>
                                                        <select class="form-control select2" id="car">
                                                            @foreach($mobil as $k => $v)
                                                            <option value="{{$v->id}}">{{$v->merk}} {{$v->type}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>

                                        <fieldset title="3">
                                            <legend>Cek Detail</legend>

                                            <div class="row m-t-20">
                                                <div class="col-sm-12">

                                                    <div class="text-center">
                                                        <i class="img-intro icon-checkmark-circle"></i>
                                                    </div>
                                                    <h3 class="head text-center">thanks for staying tuned! <span style="color:#f48260;">♥</span> Bootstrap</h3>
                                                    <p class="narrow text-center">
                                                        Lorem ipsum dolor sit amet, his ea mollis fabellas principes. Quo mazim facilis tincidunt ut, utinam saperet facilisi an vim.
                                                    </p>
                                                </div>
                                                
                                            </div>
                                        </fieldset>

                                        <button type="submit" class="btn btn-primary stepy-finish">Submit</button>
                                    </form>

                                </div>
                            </div>
                    </div>
                </div>
                <!-- center content end -->

                <!-- right side start -->
                <div class="col-md-3 right-sidebar hidden-sm hidden-xs" style="position:fixed; right:10px">
                    <h3 align="center">Right Sidebar</h3>
                </div>
              <!-- right side end -->
              @else
              <h1 align="center">Please login</h1>
            @endif
            </div>
        </div>
    </body>
    <script type="text/javascript" src="{{ url('/js/app.js')}}"></script>
    <script type="text/javascript" src="{{ url('/plugins/jquery.stepy/jquery.stepy.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('/plugins/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- bootstrap datepicker -->
    <script type="text/javascript" src="{{ asset('/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <!-- Jquery UI -->
    <script type="text/javascript" src="{{ asset('/plugins/jquery-ui/js/jquery-ui.js')}}"></script>
    <script type="text/javascript" src="{{ asset('plugins/bootstrapvalidator/js/bootstrapValidator.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();

            //Date picker
            $('#pickup').datepicker({
                autoclose: true
            });
            $('#return').datepicker({
                autoclose: true
            })
        });
    </script>
    <script>
        $(function() {
            // Override defaults
            $.fn.stepy.defaults.legend = false;
            $.fn.stepy.defaults.transition = 'fade';
            $.fn.stepy.defaults.duration = 200;
            $.fn.stepy.defaults.backLabel = '<i class="fa fa-long-arrow-left"></i> Back';
            $.fn.stepy.defaults.nextLabel = 'Next <i class="fa fa-long-arrow-right"></i>';


            $('#default-wizard').stepy();

            // Clickable titles
            $("#wizard-clickable").stepy({
                titleClick: true
            });

            // Stepy callbacks
            $("#wizard-callbacks").stepy({
                next: function(index) {
                    alert('Going to step: ' + index);
                },
                back: function(index) {
                    alert('Returning to step: ' + index);
                },
                finish: function() {
                    alert('Submit canceled.');
                    return false;
                }
            });

            // Apply "Back" and "Next" button styling
            $('.stepy-navigator').find('.button-next').addClass('btn btn-primary waves-effect waves-light');
            $('.stepy-step').find('.button-back').addClass('btn btn-default waves-effect pull-left');

            $("#default-wizard").bootstrapValidator({
                fields: {
                    pickup: {
                        validators: {
                            notEmpty: {
                                message: 'The Pickup name is required'
                            }
                        },
                        required: true,
                        minlength: 3
                    },
                    return: {
                        validators: {
                            notEmpty: {
                                message: 'The Return is required'
                            }
                        }
                    },
                    locpickup: {
                        validators: {
                            notEmpty: {
                                message: 'locpickup is required'
                            },
                           
                        }
                    },
                    lockreturn: {
                        validators: {
                            notEmpty: {
                                message: 'lockreturn is required'
                            },
                        }
                    },
                    car: {
                        validators: {
                            notEmpty: {
                                message: 'The car is required '
                            }
                        }
                    },
                    
                }
            });
        });
    </script>
</html>
