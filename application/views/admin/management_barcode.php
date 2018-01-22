<div class="thumbnail" style="padding:15px;">
    <table id="data_barcode" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
        <tr>
<!--            <th style="width:1%; text-align:center;">No</th>-->
            <th style="width:20%; text-align:center;">Barcode</th>
            <th style="text-align:center;">Lecturer</th>
            <th style="width:20%;text-align:center;">Create At</th>
            <th style="width:15%; text-align:center;">Action</th>
        </tr>
        </thead>
        <!-- <tfoot>
          <tr>
            <th>No</th>
            <th>Barcode</th>
            <th>Lecturer</th>
            <th>Action</th>
          </tr>
        </tfoot> -->
        <tbody>
        <?php $no=1; foreach($barcode as $item) { ?>
            <tr id="row<?php echo $no; ?>">
<!--                <td style="text-align:center;width: 1%;">--><?php //echo $no; ?><!--</td>-->
                <td style="width: 10%;">
                    <div id="bc<?php echo $no; ?>"></div>
                    <script>
                        $('#bc<?php echo $no; ?>').barcode("<?php echo $item['barcode']; ?>", "code128",{barWidth:1, barHeight:30,showHRI:true,output:"svg"});
                        // $(document).ready(function () {
                        //
                        // })
                    </script>
<!--                    <a href="javascript:void(0);" class="barcode" data-code="--><?php //echo $item['barcode']; ?><!--">--><?php //echo $item['barcode']; ?><!--</a>-->
                </td>
                <td>
                    <?php
                    $item_dosen = json_decode($item['lecturer']);
                    $dsn = '';
                    $koma = '';
                    for($i=0;$i<count($item_dosen);$i++){

                        if($i!=0){
                            $koma ='<br/>';
                        }
                        $dsn = $dsn.''.$koma.''.$item_dosen[$i];
                    }

                    $item_mk = json_decode($item['matakuliah']);
                    $mk = '';
                    $koma = '';
                    for($i=0;$i<count($item_mk);$i++){
                        if($i!=0){
                            $koma ='<br/>';
                        }
                        $mk = $mk.''.$koma.''.$item_mk[$i];
                    }

                    echo $dsn;

                    echo '<hr style="margin-top:5px;margin-bottom:5px;border-top:1px solid #4CAF50;" />';

                    echo $mk;

                    echo '<hr style="margin-top:5px;margin-bottom:5px;border-top:1px solid #4CAF50;" />';

                    echo "<b>".$item['group_kelas']."</b>";

                    ?>
                </td>
                <td style="text-align:right;"><?php echo date("d F Y", strtotime($item['create_at'])); ?></td>
                <td style="text-align:center;">
                    <!-- <button class="btn btn-warning btn-sm"><i class="fa fa-print" aria-hidden="true"></i></button> -->
<!--                    <button class="btn btn-success btn-sm disabled"><i class="fa fa-pencil" aria-hidden="true"></i></button>-->
                    <button class="btn btn-warning btn-sm" onclick="print('#row<?php echo $no; ?>')"><i class="fa fa-print" aria-hidden="true"></i></button>
                    <button class="btn btn-danger btn-sm btn-delete" row-id="row<?php echo $no; ?>" data-barcode="<?php echo $item['barcode']; ?>" data-dsn="<?php echo $dsn; ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </td>
            </tr>
        <?php $no++; } ?>

        </tbody>
    </table>

</div>



<!-- Modal -->
<div class="modal fade" id="modal_barcode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm jackInTheBox animated" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body" style="text-align:center;">
                <!--          <center>-->
                <!--            <div id="genrate_code"></div>-->
                <!--          </center>-->
            </div>
            <div class="modal-footer" style="text-align:center;">
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        window.table = $('#data_barcode').DataTable();
    } );

    // $('.barcode').click(function () {
    //     var code = $(this).attr('data-code');
    //
    //     $('#modal_barcode .modal-title').text('Barcode');
    //     $('#modal_barcode .modal-body').html('<center><div id="genrate_code"></div></center>');
    //     $('#modal_barcode .modal-footer').html('<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary btn-sm" onclick="print(\'#modal_barcode\')"><i class="fa fa-print fa-left" aria-hidden="true"></i> Print</button>');
    //     $("#genrate_code").barcode(code, "code128",{barWidth:1, barHeight:30,showHRI:true,output:"svg"});
    //     $('#modal_barcode').modal('show');
    // });

    $(document).on('click','.btn-delete',function () {
        $('#modal_barcode .modal-title').text('Delete');
        var barcode = $(this).attr('data-barcode');
        var dsn = $(this).attr('data-dsn');

        var row = $(this).attr('row-id');
        $('#modal_barcode .modal-body').html('<b>'+barcode+'</b><br/>'+dsn+'<br/>' +
            '<div class="checkbox" style="color: red;">' +
            '<label><input id="del_all" type="checkbox" disabled checked> Delete all log' +
            '</label>' +
            '</div>');
        $('#modal_barcode .modal-footer').html('<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">No</button>' +
                                                 '<button type="button" id="btn_yes" row-id="'+row+'" data-barcode="'+barcode+'" class="btn btn-danger btn-sm" data-dismiss="modal">Yes</button>');
        $('#modal_barcode').modal('show');
    });

    $(document).on('click','#btn_yes',function () {
        var row = $(this).attr('row-id');
        var barcode = $(this).attr('data-barcode');
        // console.log(row);
        var delete_log = 1;
        // if ($('input#del_all').is(':checked')) {
        //     delete_log = 1;
        // } else {
        //     delete_log = 0;
        // }

        var url = js_base_url+"delete-barcode";

        $.post(url,{barcode : barcode, delete_log:delete_log},function () {
            $('#'+row).animateCss('hinge',function () {
                // $('#'+row).remove();
                table.row('#'+row).remove()
                    .draw();
            });
        });


    });
</script>
