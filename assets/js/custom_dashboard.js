
// ---- DASHBOARD AWAL ----

$('.btn-dashboard').click(function () {
    $(this).animateCss('rubberBand');
});

// Data folder yang belum kembali
function get_blm_kembali() {
    $('#panel_blm_kembali').html('');
    var url_blm_kembali = js_base_url+"logging/belum-kembali";
    $.get(url_blm_kembali,function (data) {

        var data_json = JSON.parse(data);
        $('#jml_blm_kembali').html(data_json.length);
        for(var i=0;i<data_json.length;i++){

            var data_dsn = JSON.parse(data_json[i].lecturer);
            var dosen = '' ;
            var koma = '';
            for(var d=0;d<data_dsn.length;d++){
                if(d!=0){
                    koma = "<br/>";
                }

                var ds = (data_dsn[d].length > 20) ? data_dsn[d].substring(0,20)+"__" : data_dsn[d];
                dosen = dosen+" "+koma+" "+ds;
            }


            $('#panel_blm_kembali').append('<div class="alert alert-warning">' +
                '<p style="text-align: right;font-size: 0.9em;">'+moment(data_json[i].scan_at).format('dddd, Do MMM YYYY h:mm:ss')+'</p>' +
                '<hr style="margin: 5px;"/><a href="javascript:void(0)" class="showBlmKembali" data-barcode="'+data_json[i].barcode+'">'+data_json[i].barcode+'</a> - '+data_json[i].group_kelas+' ' +
                // '<br/>'+dosen+'' +
                '</div>');

            // $('#panel_blm_kembali').append('<tr>' +
            //     '<td>'+data_json[i].barcode+'<br/>'+dosen+'<br/>'+moment(data_json[i].scan_at).format('dddd, Do MMM YYYY h:mm:ss')+'</td>' +
            //     '</tr>');
        }
    });
}

// Login Admin
$('.input-login').keypress(function (e) {
    if (e.which == 13) {
        var nik = $('#nik').val();
        var password = $('#password').val();

        // if(nik=='' || password==''){
        //   alert('NIK & Password tidak boleh kosong');
        // } else
        if(nik=='admin' && password=='admin'){
            var url_setsession = js_base_url+"set-session";
            var data_session = {"nik":nik,"password":password};
            $.post(url_setsession,{data_session:data_session},function () {
                window.location.href=js_base_url+"admin";
            });
        } else {
            $('.panel-login').animateCss('shake');
        }

    }
});

$('#btn_login').click(function () {
    var nik = $('#nik').val();
    var password = $('#password').val();
    if(nik=='admin' && password =='admin'){
        var url_setsession = js_base_url+"set-session";
        var data_session = {"nik":nik,"password":password};
        $.post(url_setsession,{data_session:data_session},function () {
            window.location.href=js_base_url+"admin";
        });
    } else {
        $('.panel-login').animateCss('shake');
    }
});

// $('#btn_scan_barcode').click(function () {
//     $('#modal_panel_scan').modal('show');
//     $('#modal_panel_scan').on('show.bs.modal', function (e) {
//         $('.modal .modal-dialog').attr('class', 'modal-dialog modal-sm jackInTheBox  animated');
//     })
//     $('#modal_panel_scan').on('hide.bs.modal', function (e) {
//         $('.modal .modal-dialog').attr('class', 'modal-dialog  modal-sm flipOutX  animated');
//     })
// });



// Barcode Scan
$(document).on('keyup',function () {

    var code = $('#input_code').val();
    var input_code = code.split('.');

    if(input_code[1]=='PU'){

        // Cek Data di table barcode
        var url_lecturer = js_base_url+"cek-lecturer/"+input_code[0];
        $.get(url_lecturer,function (data_jeson) {
            var data = JSON.parse(data_jeson);

            // Dosen Ada
            if(data.length>0){
                var name = JSON.parse(data[0].lecturer);
                // Menampilkan nama dosen
                $('#lecture').html('<div class="thumbnail"><ul style="list-style: none;" id="lec"></ul></div>')
                var ul = $('#lec');
                for(var i=0;i<name.length;i++){
                    ul.append("<li>"+name[i]+"</li>");
                }

                // Cek Apakah Pengambilan atau Pengembalian
                var url_cek = js_base_url+"cek-status/"+input_code[0];
                $.get(url_cek, function (data_json_status) {
                    var data_status = JSON.parse(data_json_status);

                    var status = 0;
                    if(data_status.length>0){
                        status = (data_status[0].status == 0) ? 1 : 0;
                        if(data_status[0].status == 0) {
                            // Pengembalian

                            $('#alert').html('<div class="alert alert-info" role="alert" style="padding:5px;text-align:center; "><strong>PENGEMBALIAN FOLDER</strong></div>');
                        } else {
                            $('#alert').html('<div class="alert alert-warning" role="alert" style="padding:5px;text-align:center; "><strong>PENGAMBILAN FOLDER</strong></div>');
                        }
                    }

                    else {
                        $('#alert').html('<div class="alert alert-warning" role="alert" style="padding:5px;text-align:center; "><strong>PENGAMBILAN FOLDER</strong></div>');
                    }

                    var url_post = js_base_url+"insert-log";
                    var post_arr =
                        {
                            'barcode' :  code,
                            'status' :  status
                            // 'scan_at' : moment().format('YYYY-MM-DD HH:MM:SS')
                        };

                    $.post(url_post,{post_arr:post_arr}).done(function () {
                        // load_table_logging();
                        var url_user_log = js_base_url+"user-log";
                        $.get(url_user_log,{barcode : code}, function (data) {
                            var data_json_get = JSON.parse(data);
                            var i = 0;
                            var tr = $('#new_row');
                            // Add New Row
                            var status_folder = '<span class="label label-info label-info-custom" style="text-align:center;">KEMBALI</span>';
                            if(parseInt(data_json_get[i].status)==0){
                                status_folder = '<span class="label label-warning label-warning-custom" style="text-align:center;">AMBIL</span>';
                            }
                            // console.log(data_json[i].status);

                            var data_dsn = JSON.parse(data_json_get[i].lecturer);
                            var dosen = '' ;
                            var koma = '';
                            for(var d=0;d<data_dsn.length;d++){
                                if(d!=0){
                                    koma = ",";
                                }
                                dosen = dosen+""+koma+" "+data_dsn[d];
                            }

                            tr.prepend("<tr class='new_row' style='background-color:#dcfddc;'>"+
                                "<td><span style='color:blue;'>"+data_json_get[i].barcode+"</span> "+
                                "<div style='float:right;'>"+
                                "<span style='padding-right:5px;'>"+moment(data_json_get[i].scan_at).format('dddd, Do MMM YYYY h:mm:ss')+"</span>"+status_folder+"</div>"+
                                "<br/>"+dosen+"</td>"+
                                "</tr>");

                            get_blm_kembali();

                            setTimeout(function () {
                                $('.new_row').css("background-color","#fff");
                            },1000);
                        });
                    });


                });


            }
            // Tidak Terdaftar
            else {
                $('#lecture').html('');
                $('#alert').html('<div class="alert alert-danger" role="alert" style="padding:5px;text-align:center; "><strong>BARCODE BELUM TERDAFTAR</strong></div>');
            }


        });

        $('#code_countdown').countdowntimer({
            seconds : 1
        });

        $('#input_code').val('');
        $('#input_code').attr('disabled',true);
        // $('#scan_after').removeClass('hide');

        setTimeout( function()
        {
            // $('#alert').html('');
            // $('#lecture').html('');
            $('#input_code').attr('disabled',false);
            $('#input_code').focus();
            // $('#scan_after').addClass('hide');
        }, 1000);

        setTimeout(function () {
            $('#alert').html('');
            $('#lecture').html('');
        },20000)

    }
});
