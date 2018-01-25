@extends('layouts.full.full')
@section('style-head')
    @parent
    <!-- Application stylesheet : mandatory -->
    <link rel="stylesheet" href="{{ url('stylesheet/bootstrap.css')}}">
    <link rel="stylesheet" href="{{ url('stylesheet/layout.css')}}">
    <link rel="stylesheet" href="{{ url('stylesheet/uielement.css')}}">
    <!--/ Application stylesheet -->
@endsection
@section('content')
        <section id="main" role="main">
            <!-- START Template Container -->
            <section class="container">
                <!-- START row -->
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-4">
                        <!-- Brand -->
                        <div class="text-center" style="margin-bottom:40px;">
                            <span class="logo-figure-wide inverse"></span>
                            <span class="logo-text-wide inverse"></span>
                            <h5 class="semibold text-muted mt-5">Login.</h5>
                        </div>
                        <!--/ Brand -->

                        <!-- Social button -->
                        <!--<ul class="list-table">
                            <li><button type="button" class="btn btn-block btn-facebook">Connect with <i class="ico-facebook2 ml5"></i></button></li>
                            <li><button type="button" class="btn btn-block btn-twitter">Connect with <i class="ico-twitter2 ml5"></i></button></li>
                        </ul>-->
                        <!-- Social button -->

                        <hr><!-- horizontal line -->

                        <!-- Login form -->
                        <form class="panel" name="form-login" method="post" action="{{ route('gerbang.login') }}">
                            {{ csrf_field() }}
                            <div class="panel-body">
                                @include('layouts.elements.alert')
                                
                                <div class="form-group">
                                    <div class="form-stack has-icon pull-left">
                                        <input name="username" type="text" class="form-control input-lg" placeholder="Username / email" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your username / email" data-parsley-required>
                                        <i class="ico-user2 form-control-icon"></i>
                                    </div>
                                    <div class="form-stack has-icon pull-left">
                                        <input name="password" type="password" class="form-control input-lg" placeholder="Password" data-parsley-errors-container="#error-container" data-parsley-error-message="Please fill in your password" data-parsley-required>
                                        <i class="ico-lock2 form-control-icon"></i>
                                    </div>
                                </div>

                                <!-- Error container -->
                                <div id="error-container"class="mb15"></div>
                                <!--/ Error container -->

                                <!--<div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="checkbox custom-checkbox">  
                                                <input type="checkbox" name="remember" id="remember" value="1">  
                                                <label for="remember">&nbsp;&nbsp;Remember me</label>   
                                            </div>
                                        </div>
                                        <div class="col-xs-6 text-right">
                                            <a href="javascript:void(0);">Lost password?</a>
                                        </div>
                                    </div>
                                </div>-->
                                <div class="form-group nm">
                                    <button type="submit" class="btn btn-block btn-success"><span class="semibold">Sign In</span></button>
                                </div>
                            </div>
                        </form>
                        <!-- Login form -->

                        <hr><!-- horizontal line -->

                        <!--<p class="text-muted text-center">Don't have any account? <a class="semibold" href="page-register.html">Sign up to get started</a></p>-->
                    </div>
                </div>
                <!--/ END row -->
            </section>
            <!--/ END Template Container -->
        </section>
@endsection

@section('script-end')
    @parent
    <script type="text/javascript" src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>
    <script type="text/javascript" src="{{ url('assets/plugins/parsley/js/parsley.js')}}"></script>
    <!--<script type="text/javascript" src="{{ url('./javascript/backend/pages/login.js')}}"></script>-->
@endsection