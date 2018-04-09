$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
});
$.fn.rowCount = function() {
    return $('tr', $(this).find('tbody')).length;
};

var permission;
var provinsi = $('select#provinsi');
var kabkota = $('select#kabkota');
var kecamatan = $('select#kecamatan');
var desa = $('select#desa');

$.extend({
    getValues: function(url) {
        var result = null;
        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            async: false,
            success: function(data) {
                result = data;
            }
        });
        return result;
    }
});

function getjson(url){
    var result = null;
    $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        async: false,
        success: function(data) {
            result = data;
        }
    });
     return result;
} 
function numeralsOnly(evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
    ((evt.which) ? evt.which : 0));
        if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode != 46)) {
            alert("Hanya Nomor yang bisa di input pada kolom ini.");
            console.log(evt);
            return false;
        }
    return true;
}
function lettersOnly(evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
        ((evt.which) ? evt.which : 0));
    if (charCode > 31 && (charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122)) {
        alert("hanya huruf saja.");
        return false;
    }
    return true;
}
function ynOnly(evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));
    if (charCode > 31 && charCode != 78 && charCode != 89 && charCode != 110 && charCode != 121) {
    alert("Masukan hanya \"Y\" atau \"N\".");

    return false;
    }
    return true;
}
function rangeNumber(evt) {

    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
    ((evt.which) ? evt.which : 0));
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            alert("Hanya Nomor yang bisa di input pada kolom ini.");
                $(this).val(0);
            return false;
        }
        var max = 100;
        var min = 0;
        if ($(this).val() > max){
             $(this).val(max);
        }else if($(this).val() < min){
             $(this).val(min);
        }
    return true;
}
function hasRole(name){
    permission = getjson('/api/checkpermission');
    var ret = null;
    for(i in permission){
        console.log(permission[i]);
        if (permission[i] == name) {
                return true;
        }
    }        
}
function base64image(resFile) {
    var reader = new FileReader();
    reader.readAsDataURL(resFile);
    reader.onloadend = function(evt) {
      return (evt.target.result);
    }
}
function loaddatawilayah(url,data=''){
    console.log('Load adata')
    return $.ajax({
        url: url,
        dataType: "json",
        beforeSend: function() {
            $('.loader').show();
            $("#loader-wrapper").show();
        },
    });
    
}
function loadProvinsi(){
    loaddatawilayah('/api/getprovinsi').then(function(data){
        var options = '<option value="0">Pilih Provinsi..</option>';
        for (var x = 0; x < data.length; x++) {
            var selected = (data[x]['kode_prov'] == $('#kode_prov').val()) ? "selected":"";
            options += '<option value="' + data[x]['kode_prov'] + '"'+ selected +'>' + data[x]['nama_provinsi'] + '</option>';
        }
        provinsi.html(options);
        $("#loader-wrapper").hide();
    });
}
function loadKabupaten(id){
    kabkota.html("<option value=''>Pilih Kota..</option>");
    loaddatawilayah('/api/getkabupaten/'+id).then(function(data){
        var options = '<option value="0">Pilih Kota..</option>';
        for (var x = 0; x < data.length; x++) {
            var selected = (data[x]['kode_kab'] == $('#kode_kab').val()) ? "selected":"";
            options += '<option value="' + data[x]['kode_kab'] + '"'+ selected +'>' + data[x]['nama_kabupaten'] + '</option>';    
        }
        kabkota.select2();
        kabkota.html(options);
        $("#loader-wrapper").hide();
    });
}
function loadKecamatan(id){
    kecamatan.html("<option value=''>Pilih Kecamatan..</option>");
    loaddatawilayah('/api/getkecamatan/'+id).then(function(data){
        var options = '<option value="0">Pilih Kecamatan..</option>';
        for (var x = 0; x < data.length; x++) {
            var selected = (data[x]['kode_kec'] == $('#kode_kec').val()) ? "selected":"";
            options += '<option value="' + data[x]['kode_kec'] + '" '+ selected +'>' + data[x]['nama_kecamatan'] + '</option>';    
        }
        kecamatan.select2();
        kecamatan.html(options);
        $("#loader-wrapper").hide();
    });
}
function loadDesa(id){
    desa.html("<option value=''>Pilih Desa/Kelurahan..</option>");
    loaddatawilayah('/api/getdesa/'+id).then(function(data){
        var options = '<option value="0">Pilih Desa..</option>';
        for (var x = 0; x < data.length; x++) {
            var selected = (data[x]['kode_kel'] == $('#kode_kel').val()) ? "selected":"";
            options += '<option value="' + data[x]['kode_kel'] + '" '+ selected +'>' + data[x]['nama_kelurahan'] + '</option>';    
        }
        desa.select2();
        desa.html(options);
        $("#loader-wrapper").hide();
    });
}
(function($, window, document){
    $("#loader-wrapper").hide();
}(jQuery, window, document));

(function($, window, document){
    $('.formConfirm').on('click', function(e) {
        e.preventDefault();
        if($(this).hasClass('disabled')) return;
        var el = $(this).parent();
        var title = el.attr('data-title');
        var msg = el.attr('data-message');
        var dataForm = el.attr('data-form');
        
        $('#formConfirm')
        .find('#frm_body').html('<h6>'+msg+'</h6>')
        .end().find('#frm_title').html(title)
        .end().modal('show');
        
        $('#formConfirm').find('#frm_submit').attr('data-form', dataForm);
    });

    $('#formConfirm').on('click', '#frm_submit', function(e) {
        var id = $(this).attr('data-form');
        //console.log(id);
        $(id).submit();
    });

    
}(jQuery, window, document));
//Jam Online
(function($, window, document){
    if( $( '.rt-clock' ).length > 0 ){
        var monthNames = [ 'Januari', 'Pebruari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember' ];
        var dayNames= [ 'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu' ];

        var newDate = new Date();

        newDate.setDate(newDate.getDate());

        var date = dayNames[ newDate.getDay() ] + ', ' + newDate.getDate() + ' ' + monthNames[ newDate.getMonth() ] + ' ' + newDate.getFullYear();

        $( '.rt-clock .date' ).html( date );

        setInterval(
            function() {
                var seconds = new Date().getSeconds();
                $(".rt-clock .seconds").html(( seconds < 10 ? "0" : "" ) + seconds);
            },1000 );

        setInterval(
            function() {
                var minutes = new Date().getMinutes();
                $(".rt-clock .minutes").html(( minutes < 10 ? "0" : "" ) + minutes);
            },1000);

        setInterval(
            function() {
                var hours = new Date().getHours();
                $(".rt-clock .hours").html(( hours < 10 ? "0" : "" ) + hours);
            }, 1000);
    }
}(jQuery, window, document));
//Upload
(function($, window, document){
    var hasChanged = false;
    $(window).bind('beforeunload', function(){
      if(hasChanged){
        return "You have unsaved changes";
        hasChanged = false;
      } 
    });
    $('input[type=text]').change(function(){
        hasChanged = true;
    });
   
    $('.formUpload').on('click', function(e) {
        var file_input = $(this).closest('span').find('.file');
        if (file_input.length > 0) {
            file_input.trigger('click');
        }
    });
    $('.fileupload:file').change(function(){
        var fileinput = $(this);
        var fileinput_url = fileinput.attr('data-url');
        var fileinput_path = fileinput.attr('data-path');
        var file = this.files[0];
        name = file.name;
        size = file.size;
        type = file.type;
    
        if(file.name.length < 1) {
        }else if(file.size > 209715200) {
            alert("File Terlalu Besar, Maksimal 200 Mb");
        }else if(file.type != 'image/png' && file.type != 'image/jpg' && file.type != 'image/gif' && file.type != 'image/jpeg' && file.type != 'application/pdf' && file.type != 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
            alert("File tidak diijinkan untuk di upload");
            $(this).val('');
        }else { 
            var formData = new FormData($('*formId*')[0]);
            formData.append("_token", window.Laravel.csrfToken);
            console.log(window.Laravel.csrfToken);
            if(!!file.type.match(/.*/)){
                formData.append("images", file);
            }  
            
            $.ajax({
                url: fileinput_url/*"/kuesioner/bangunan/upload"*/,
                type: "POST",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                dataType:'json',
                beforeSend: function(){
                    $("#loader-wrapper").show();
                },
                complete: function(){   
                    $("#loader-wrapper").hide();
                },
                success: function(data){
                    if($('.txtfoto').length > 0) {
                        fileinput.closest('div.controlupload').find('.txtfoto')
                            .css({"color": "peru", "border": "2px solid blue"}).val(data.filename);
                        fileinput.parent().parent().parent().find('img.imgfoto').attr('src',fileinput_path+data.filename);
                    }
                },
                error: errorHandler = function() {
                    alert("Something went wrong!");
                },
            });
        }
    });
}(jQuery, window, document));
//Table
(function($, window, document){
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        //pagingType: 'full_numbers',
        //dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            "decimal":        "",
            "emptyTable":     "Tidak ada data",
            "info":           "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "infoEmpty":      "Menampilkan 0 sampai 0 dari 0 data",
            "infoFiltered":   "(dari _MAX_ total data)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "Data _MENU_ ",
            "loadingRecords": "Tunggu Sebentar...",
            "processing":     "Proses...",
            "search":         "Cari:",
            "zeroRecords":    "Tidak ada data yang dicari..",
            "paginate": {
                "first":      "<<",
                "last":       ">>",
                "next":       "",
                "previous":   ""
            },
            "aria": {
                "sortAscending":  ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            }
        
        }
    });
    var table_dom = $('#table_dom').DataTable();
    var table_user = $('#table_user').DataTable();
    var table_role = $('#table_role').DataTable({});
    var table_mobil = $('#table_mobil').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/backend/mobil/getdata',
        columns: [
            {
                //"className":      'details-control',
                "orderable":      false,
                "searchable":      false,
                "data":           null,
                "defaultContent":   
                    '<div class="input-group margin">' +
                        '<div class="input-group-btn">' +
                            '<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">' +
                            '<span class="fa fa-caret-down ico-caret-down"></span></button>' +
                            '<ul class="dropdown-menu">' +
                                '<li><a class="edit">Edit</a></li>' +
                                '<li data-title="Hapus Mobil" data-message="Hapus Mobil ??"><a class="hapus">Hapus</a></li>' +
                            '</ul>' +
                        '</div>' +
                    '</div>' 
                ,
            },
            {data: 'no_plat', name: 'no_plat'},
            {data: 'merk', name: 'merk'},
            {data: 'type', name: 'type'},
            {data: 'warna', name: 'warna'},
            {data: 'harga', name: 'harga'},
            
        ],
    });
    $('#table_mobil tbody').on('click', 'a',function(e) {
        var data =  table_mobil.row($(this).parents('tr')).data();
        var id = data.id;
        
        if ($(this).hasClass('edit')) {
            document.location ='/backend/mobil/'+id+'/edit';
        }else if ($(this).hasClass('lihat')) {
            document.location ='/backend/mobil/'+id+'/lihat';
        }else if($(this).hasClass('hapus')){
            e.preventDefault();
            var el = $(this).parent();
            var title = el.attr('data-title');
            var msg = el.attr('data-message');
            var dataForm = el.attr('data-form');
            
            var newForm = jQuery('<form>', {
                'action': '/backend/mobil/'+id,
                'target': '_top',
                'method' : 'post',
            }).append(jQuery('<input>', {
                'name': '_method',
                'value': 'DELETE',
                'type': 'hidden'
            })).append($('<input />',{
                'name': '_token',
                'value': $('meta[name="_token"]').attr('content'),
                'type': 'hidden'
            }));

            $('#formConfirm')
            .find('#frm_body').html('<h6>'+msg+'</h6>').append(newForm)
            .end().find('#frm_title').html(title)
            .end().modal('show');
            
            $('#formConfirm').find('#frm_submit').attr('data-form', dataForm);

            $('#formConfirm').on('click', '#frm_submit', function(e) {
                //var id = $(this).attr('data-form');
                //console.log(newForm);
                newForm.submit();
                //$(id).submit();
            });
        }else if($(this).hasClass('editmap')){
            e.preventDefault();
            var el = $(this).parent();
            var title = el.attr('data-title');
            var msg = el.attr('data-message');
            var dataForm = el.attr('data-form');
           
            var newForm = jQuery('<form>', {
                'action': '/kuesioner/bangunan/'+id+'/peta',
                'target': '_top',
                'method' : 'post',
            }).append(jQuery('<input>', {
                'name': '_method',
                'value': 'GET',
                'type': 'hidden'
            })).append($('<input />',{
                'name': '_token',
                'value': $('meta[name="_token"]').attr('content'),
                'type': 'hidden'
            }));

            $('#formConfirm')
            .find('#frm_body').html('<h6>'+msg+'</h6>').append(newForm)
            .end().find('#frm_title').html(title)
            .end().modal('show');
            $('#formConfirm').find('#frm_submit').attr('data-form', dataForm);
            $('#formConfirm').on('click', '#frm_submit', function(e) {
                newForm.submit();
            });
        }
        table_agenda.draw();
    });

    var table_reservation = $('#table_reservation').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url:'/api/reservation',
            data: function (d) {
                d.tgl_mulai = $('input[name=tgl_mulai]').val();
                d.status = $('select[name=status]').val();
                d.sq = $('input[name=sq]').val();
            }
        },
        columns: [
            {data: 'rownum',name:'rank', orderable: false, searchable: false},
            {data: 'origin'},
            {data: 'destination'},
            {data: 'total_bayar'},
            {data: 'status'},
            {data: 'no_plat'},
            {data: 'warna'},
            {data: 'merk'},
            {data: 'tgl_mulai', name: 'tgl_mulai'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action',name:'action', orderable: false, searchable: false},
        ]
    });
    $('#table_reservation_search_form').on('submit', function(e) {
        table_reservation.draw();
        e.preventDefault();
    });
    
}(jQuery, window, document));
//Form
(function($, window, document){
    $('.datepicker').datepicker({
        autoclose: true,
        format:'yyyy-mm-dd',
        startDate:'-3d'
    });
    if($('.start_at').length > 0){
        $('.start_at').datetimepicker({
            //defaultDate: new Date(),
            
            dateFormat: "yy-mm-dd",
            timeFormat: "HH:mm",
            
        });
    }

    if($('.end_at').length > 0){
        $('.end_at').datetimepicker({
            //defaultDate: new Date(),
            dateFormat: "yy-mm-dd",
            timeFormat: "HH:mm",
        });
    }
    
    
    $('input.numberonly').bind('keypress', function(e) {
        return numeralsOnly(e);
    });
    $('input.letteronly').bind('keypress', function(e) {
        return lettersOnly(e);
    });
    var checkall = 'th.check-all';
    $(checkall).on('change', function() {
        var $this = $(this),
            index= $this.index() + 1,
            checkbox = $this.find('input[type="checkbox"]'),
            table = $this.parents('table');
        // Make sure to affect only the correct checkbox column
        table.find('tbody > tr > td:nth-child('+index+') input[type="checkbox"]')
          .prop('checked', checkbox[0].checked);
    });
    
    loadProvinsi();
    
    if($('#kode_prov').val() !=null){
        loadKabupaten($('#kode_prov').val());
    }
    provinsi.on('change', function (){
        loadKabupaten($(this).val());
    });
    if($('#kode_kab').val() !=null){
        loadKecamatan($('#kode_kab').val());
    }
    kabkota.on('change', function (){
        loadKecamatan($(this).val());
    });
    if($('#kode_kec').val() !=null){
        loadDesa($('#kode_kec').val());
    }
    kecamatan.on('change', function (){
        loadDesa($(this).val());
    });
    
    $('#checkmap').click(function(){
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            $('input[name=latitude]').val(position.coords.latitude);
            $('input[name=longitude]').val(position.coords.longitude);
          }, function() {
            
          });
        } else {
          // Browser doesn't support Geolocation
          alert('Browser anda tidak mendukung Geolocation');
         
        }        
    });

    if ($(".tinymce_sikko").length > 0) {
        tinymce.init({
            selector: ".tinymce_sikko",
            theme: "modern",
            //skin: "light",
            //width: 600,
            //height: 200,    
            /*plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking spellchecker",
                "table contextmenu directionality emoticons paste textcolor responsivefilemanager code "
            ],*/
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount media nonbreaking spellchecker",
                "table contextmenu directionality emoticons paste textcolor responsivefilemanager code "
            ],
            relative_urls: false,
            browser_spellcheck : true ,
            filemanager_title:"Responsive Filemanager",
            external_filemanager_path:"http://"+window.location.hostname+":"+window.location.port+"/filemanager/",
            external_plugins: { "filemanager" : "../../../filemanager/plugin.min.js"},
            codemirror: {
                indentOnInit: true, // Whether or not to indent code on init. 
                path: 'CodeMirror'
            },  
            image_advtab: true,
            toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
            toolbar2: "| responsivefilemanager | image | media | link unlink anchor | print preview code  | youtube | qrcode | flickr | picasa | easyColorPicker"
        });    
    }
    if ($(".tinymce_post").length > 0) {
        tinymce.init({
            selector: ".tinymce_post",
            theme: "modern",
            //skin: "light",
            //width: 600,
            menubar:false,
            statusbar: false,
            verify_html : false,
            //force_br_newlines : false,
            //force_p_newlines : false,
            forced_root_block : '',
            table_default_attributes: {
                class: 'table table-bordered'
            },
            height: 300,    
            /*plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking spellchecker",
                "table contextmenu directionality emoticons paste textcolor responsivefilemanager code "
            ],*/
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount media nonbreaking spellchecker",
                "table contextmenu directionality emoticons paste textcolor responsivefilemanager code "
            ],
            relative_urls: false,
            browser_spellcheck : true ,
            filemanager_title:"Responsive Filemanager",
            external_filemanager_path:"http://"+window.location.hostname+":"+window.location.port+"/filemanager/",
            external_plugins: { "filemanager" : "../../../filemanager/plugin.min.js"},
            codemirror: {
                indentOnInit: true, // Whether or not to indent code on init. 
                path: 'CodeMirror'
            },  
            image_advtab: true,
            toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect table | image code",
            //toolbar2: "| responsivefilemanager | image | media | link unlink anchor | print preview code  | youtube | qrcode | flickr | picasa | easyColorPicker"
        });    
    }
    if ($(".tinymce_200").length > 0) {
        tinymce.init({
            selector: ".tinymce_200",
            theme: "modern",
            //skin: "light",
            //width: 600,
            menubar:false,
            statusbar: true,
            table_default_attributes: {
                class: 'table table-bordered'
            },
            height: 200,    
            /*plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking spellchecker",
                "table contextmenu directionality emoticons paste textcolor responsivefilemanager code "
            ],*/
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount media nonbreaking spellchecker",
                "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
            ],
            relative_urls: false,
            browser_spellcheck : true ,
            filemanager_title:"Responsive Filemanager",
            external_filemanager_path:"http://"+window.location.hostname+":"+window.location.port+"/filemanager/",
            external_plugins: { "filemanager" : "../../../filemanager/plugin.min.js"},
            codemirror: {
                indentOnInit: true, // Whether or not to indent code on init. 
                path: 'CodeMirror'
            },  
            image_advtab: true,
            toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect table | image code",
            //toolbar: "| responsivefilemanager | image | media | link unlink anchor | print preview code  | youtube | qrcode | flickr | picasa | easyColorPicker"
            forced_root_block : "", 
            force_br_newlines : true,
            force_p_newlines : false,
        });    
    }

    
}(jQuery, window, document));

