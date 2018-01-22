
<link href="<?php echo base_url('assets/select2/select2.min.css'); ?>" rel="stylesheet" />
<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" /> -->
<script src="<?php echo base_url('assets/select2/select2.min.js'); ?>"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> -->
<style media="screen">
    .list-group-item {
        font-weight: bold;
    }
</style>
<?php
$menu_active = $this->uri->segment(2);
?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="thumbnail" style="text-align:center;padding:15px;">
                <img src="<?php echo base_url('images/avatar.png') ?>" class="img-circle" style="width:100px;border:3px solid #023e87bf;" alt="">
                <h2 style="font-family: 'Barlow Condensed', sans-serif;">Mimin Akademik</h2>
            </div>
            <div class="">
                <div class="list-group">
                    <a href="<?php echo base_url('admin'); ?>" class="list-group-item <?php if($menu_active==''){echo 'active';} ?>"><i class="fa fa-bar-chart fa-left" aria-hidden="true"></i> Presensi</a>
                    <a href="<?php echo base_url('admin/create-barcode'); ?>" class="list-group-item <?php if($menu_active=='create-barcode'){echo 'active';} ?>"><i class="fa fa-qrcode fa-left" aria-hidden="true"></i> Create Barcode</a>
                    <a href="<?php echo base_url('admin/barcode'); ?>" class="list-group-item <?php if($menu_active=='barcode'){echo 'active';} ?>"><i class="fa fa-database fa-left" aria-hidden="true"></i> Management Barcode</a>

                </div>
                <div class="thumbnail" style="text-align: center;padding: 15px;">
                    <p>Download Report</p>

                    <div class="form-group">
                        <input type="text" name="daterange" class="form-control" />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-warning btn-block btn-dashboard" id="check"><i class="fa fa-search fa-left" aria-hidden="true"></i> Check</button>
                    </div>

                    <script>
                        // Report
                        var maxdate = moment().format('l');
                        $(function() {
                            $('input[name="daterange"]').daterangepicker({
                                "maxDate": maxdate
                            });
                        });

                        $('#check').click(function () {
                            $(this).animateCss('rubberBand');
                            var daterange = $('input[name="daterange"]').val();
                            var xsp = daterange.split(' - ');
                            var start_date = change_format_data(xsp[0]);
                            var end_date = change_format_data(xsp[1]);

                            var tr =  $('#data_cetak');
                            tr.html('');

                            // console.log(moment(start_date).format('MMMM Do YYYY, h:mm:ss a')+' '+end_date);
                            var url_log = js_base_url+"logging";
                            $.get(url_log,function (data) {
                                var data_json = JSON.parse(data);
                                console.log(data_json);
                                for(var i=0;i<data_json.length;i++){
                                    // console.log(moment(data_json[i].scan_at).isBetween(start_date, end_date, null, '[]'));
                                    var th = data_json[i].scan_at.split(' ')[0];
                                    // console.log(moment(th).isBetween(start_date, end_date, null, '[]'));
                                    if(moment(th).isBetween(start_date, end_date, null, '[]')){
                                        console.log(data_json[i].scan_at);
                                        var status_folder = '<span class="label label-info label-info-custom" style="text-align:center;">KEMBALI</span>';
                                        if(parseInt(data_json[i].status)==0){
                                            status_folder = '<span class="label label-warning label-warning-custom" style="text-align:center;">AMBIL</span>';
                                        }
                                        // console.log(data_json[i].status);

                                        var data_dsn = JSON.parse(data_json[i].lecturer);
                                        var dosen = '' ;
                                        var koma = '';
                                        for(var d=0;d<data_dsn.length;d++){
                                            if(d!=0){
                                                koma = ",";
                                            }
                                            dosen = dosen+""+koma+" "+data_dsn[d];
                                        }

                                        tr.append("<tr>"+
                                            "<td><span style='color:blue;'>"+data_json[i].barcode+"</span>"+
                                            "<div style='float:right;'>"+
                                            "<span style='padding-right:5px;'>"+moment(data_json[i].scan_at).format('dddd, Do MMM YYYY h:mm:ss')+ "</span>"+status_folder+"</div>"+
                                            "<br/>"+dosen+"</td>"+
                                            "</tr>");

                                        // console.log();
                                    }

                                }
                                $('#modal_panel_report').modal('show');

                            });
                            // console.log(change_format_data(xsp[0]));
                            // console.log(moment(change_format_data(xsp[0])).format("YYYY"));

                        });

                        function change_format_data(str) {
                            var plan = str.split('/');
                            var result = plan[2]+'-'+plan[1]+'-'+plan[0];
                            return result;
                        }

                        $(document).on('click','.btn-cetak-report',function () {
                            $(this).animateCss('rubberBand');
                            print('#table_report');
                        });
                    </script>
                </div>
                <div class="thumbnail">
                    <!-- <a href="#" class="list-group-item log-out"><i class="fa fa-sign-out fa-left" aria-hidden="true"></i> Log Me Out</a> -->
                    <a type="button" href="<?php echo base_url('log-out'); ?>" class="btn btn-danger btn-block" name="button"><i class="fa fa-sign-out fa-left" aria-hidden="true"></i> Log Me Out</a>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <?php echo $content_admin; ?>
        </div>
    </div>
</div>


<!-- Modal 1 -->
<div class="modal fade" id="modal_panel_report" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg jackInTheBox animated">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Report</h4>
            </div>
            <div class="modal-body">
                <div style="text-align: right;">
                    <button type="button" class="btn btn-success btn-sm btn-cetak-report"><i class="fa fa-print fa-left" aria-hidden="true"></i> Print</button>
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="margin-left: 5px;">Close</button>
                </div>
                <table class="table table-striped" id="table_report">
                    <thead>
                    <tr>
                        <th>Log</th>
                    </tr>
                    </thead>
                    <tbody id="data_cetak">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-sm btn-cetak-report"><i class="fa fa-print fa-left" aria-hidden="true"></i> Print</button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Detail Barcode -->
<div class="modal fade" id="modalDetailLog" role="dialog">
    <div class="modal-dialog jackInTheBox animated" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!--                <button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
    $(document).on('click','.showBlmKembali',function () {

        var code = $(this).attr('data-barcode');
        var url = '<?php echo base_url('logging/detail-belum-kembali'); ?>';
        $.post(url,{code : code},function (html) {

            $('#modalDetailLog .modal-title').html('Detail barcode '+code);
            $('#modalDetailLog .modal-body').html(html);
            $('#modalDetailLog').modal('show');
        });

    });
</script>
