
<style>
    .alert {
        padding: 5px;
        margin-bottom: 10px;
    }
    .alert .alert-warning {
        font-family: 'Barlow Condensed', sans-serif;font-size: 1.3em;
    }

    #panel_blm_kembali {
        overflow: auto;max-height: 300px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-3">

            <div class="thumbnail flipInX  animated" style="padding:15px;text-align:center;">
                <button class="btn btn-primary btn-block btn-dashboard" id="btn_scan_barcode" data-toggle="modal" data-target="#modal_panel_scan" data-backdrop="static">
                    <strong><i class="fa fa-qrcode fa-left" aria-hidden="true"></i> Scan Barcode</strong>
                </button>

            </div>


            <div class="thumbnail" style="padding: 10px;">
                <h4>Folder Belum Kembali</h4>
                <div id="panel_blm_kembali"></div>
                <p style="margin: 0px;margin-top: 5px;">Jumlah : <strong><span id="jml_blm_kembali"></span></strong></p>
            </div>

            <div class="panel panel-default panel-login">
                <div class="panel-heading">
                    <strong>Staff Akademic Only</strong>
                </div>
                <div class="panel-body">


                    <div class="form-group">
                        <input type="text" id="nik" class="form-control input-login" placeholder="NIK...">
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" class="form-control input-login" placeholder="Password...">
                    </div>
                    <button id="btn_login" class="btn btn-default btn-block btn-dashboard" name="button"><b><i class="fa fa-sign-in fa-left" aria-hidden="true"></i> Login</b></button>
                </div>
            </div>



            <div class="thumbnail" style="padding:15px;">
                <div style="text-align:center;">
                    <span id="copyright">IT PU, We Made With <i class="fa fa-heart fa-right animated infinite pulse" style="color:red;" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-9">



            <div class="thumbnail" style="padding:10px;">
                <ul class="nav nav-tabs">
                    <li role="presentation" class="<?php if($this->uri->segment(2)=='' || $this->uri->segment(2)=='today'){ echo 'active';} ?>"><a href="<?php echo base_url('logging/today'); ?>">Today</a></li>
                    <li role="presentation" class="<?php if($this->uri->segment(2)=='all'){ echo 'active';} ?>"><a href="<?php echo base_url('logging/all'); ?>">All Log</a></li>
<!--                    <li role="presentation" class="--><?php //if($this->uri->segment(2)=='presensi'){ echo 'active';} ?><!--"><a href="--><?php //echo base_url('logging/presensi'); ?><!--">Presensi</a></li>-->
                </ul>
                <hr>

                <?php echo $table_presensi; ?>


            </div>

        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/js/custom_dashboard.js'); ?>"></script>

<script>
    $(document).ready(function () {
        get_blm_kembali();

        $('#modal_panel_scan').on('shown.bs.modal', function () {
            $('#input_code').focus();
        });
    });

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

<!-- Modal 1 -->
<div class="modal fade" id="modal_panel_scan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm jackInTheBox animated">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Barcode Scanner Panel</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" id="input_code" class="form-control" name="" value="">
                </div>
                <div style="text-align:center;padding-bottom:15px;">
                    <span id="scan_after" class="hide">Scan again after <strong id="code_countdown"></strong></span>
                </div>
                <div id="lecture"></div>
                <div id="alert"></div>

            </div>
            <div class="modal-footer">
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
