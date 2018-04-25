@extends('layouts.adminlte.main')

@section('breadcrumb')
    @parent
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
    </ol>
@endsection

@section('content-admin')

    
    <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('backend.setting.store') }}">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                    <div class="panel-heading">
                        <h3 class="panel-title">Setting</h3>
                    </div>
                    
                    <div class="panel-body">
                            <div class="form-group">
                                <h5 class="semibold text-primary nm">Umum.</h5>
                                <p class="text-muted nm">Pengaturan Umum</p>
                                
                            </div>
                            <div class="form-group">
                                <label>Meta Title</label>
                                <input class="form-control" name="title" value="{{ array_get($setting, 'title', '') }}"></input>
                            </div>
                            <div class="form-group">
                                <label>Meta Deskripsi</label>
                                <input class="form-control" name="deskripsi" value="{{ array_get($setting, 'deskripsi', '') }}"></input>
                            </div>
                            <div class="form-group">
                                <label>Meta Author</label>
                                <input class="form-control" name="author" value="{{ array_get($setting, 'author', '') }}"></input>
                            </div>

                            <div class="form-group">
                                <label>Google Map Api</label>
                                <input class="form-control" name="google_map" value="{{ array_get($setting, 'google_map', '') }}"></input>
                            </div>

                            <div class="form-group">
                                <h5 class="semibold text-primary nm">Footer.</h5>
                                <p class="text-muted nm">Pengaturan Umum</p>
                                
                            </div>
                            <div class="form-group">
                                <label>Pane Left</label>
                                <input class="form-control" name="footer_left_pane" value="{{ array_get($setting, 'footer_left_pane', '') }}"></input>
                            </div>

                            <div class="form-group">
                                <label>Center Pane</label>
                                <input class="form-control" name="footer_center_pane" value="{{ array_get($setting, 'footer_center_pane', '') }}"></input>
                            </div>

                            <div class="form-group">
                                <label>Right Pane</label>
                                <input class="form-control" name="footer_right_pane" value="{{ array_get($setting, 'footer_right_pane', '') }}"></input>
                            </div>

                            <div class="form-group">
                                <h5 class="semibold text-primary nm">Lainnya.</h5>
                                <p class="text-muted nm">Pengaturan Lainnya</p>
                                
                            </div>
                            <div class="form-group">
                                <label>Base URL</label>
                                <input class="form-control" name="base_url" value="{{ array_get($setting, 'base_url', '') }}"></input>
                            </div>

                            <div class="form-group">
                                <label>Facebook</label>
                                <input class="form-control" name="facebook_url" value="{{ array_get($setting, 'facebook_url', '') }}"></input>
                            </div>

                            <div class="form-group">
                                <label>Twitter</label>
                                <input class="form-control" name="twitter_url" value="{{ array_get($setting, 'twitter_url', '') }}"></input>
                            </div>

                        
                        <div class="form-group">
                            <button class="btn btn-primary" >Simpan</button>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">---</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label>Tentang Kami</label>
                            <textarea rows="4" class="form-control tinymce_post" name="about_us">
                                {{ array_get($setting, 'about_us', '') }}
                            </textarea>
                        </div>

                        <div class="form-group">
                            <label>Alamat Kami</label>
                            <textarea rows="4" class="form-control tinymce_200" name="our_address">
                                {{ array_get($setting, 'our_address', '') }}
                            </textarea>
                        </div>

                        <div class="form-group">
                            <label>Email Kami</label>
                            <textarea rows="4" class="form-control tinymce_200" name="our_email">
                                {{ array_get($setting, 'our_email', '') }}
                            </textarea>
                        </div>

                        <div class="form-group">
                            <label>Telepon Kami</label>
                            <input type="text" class="form-control" name="our_phone" value="{{ array_get($setting, 'our_phone', '') }}">
                        </div>

                        <div class="form-group">
                            <label>Support Kami</label>
                            <textarea rows="4" class="form-control tinymce_200" name="our_support">
                                {{ array_get($setting, 'our_support', '') }}
                            </textarea>
                        </div>    
                    </div>
                    
                </div>
            </div>
        </div>
    </form>
@endsection
@section('style-head')
@parent
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
<script type="text/javascript" src="{{ url('assets/plugins/tinymce/tinymce.min.js')}}"></script>
<script type="text/javascript" src="{{ url('js/sikko.js')}}"></script>
@endsection
