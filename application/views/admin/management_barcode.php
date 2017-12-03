<div class="thumbnail" style="padding:15px;">
  <table id="data_barcode" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th style="width:1%; text-align:center;">No</th>
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
        <tr>
          <td style="text-align:center;"><?php echo $no++; ?></td>
          <td><a href="javascript:void(0);" class="barcode" data-code="<?php echo $item['barcode']; ?>"><?php echo $item['barcode']; ?></a></td>
          <td>
            <?php
              $item_dosen = json_decode($item['lecturer']);
              for($i=0;$i<count($item_dosen);$i++){
                if($i!=0){
                  echo ", ";
                }
                echo $item_dosen[$i];
              }

            ?>
          </td>
          <td style="text-align:right;"><?php echo date("d F Y", strtotime($item['create_at'])); ?></td>
          <td style="text-align:center;">
            <!-- <button class="btn btn-warning btn-sm"><i class="fa fa-print" aria-hidden="true"></i></button> -->
            <button class="btn btn-success btn-sm disabled"><i class="fa fa-pencil" aria-hidden="true"></i></button>
            <button class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
          </td>
        </tr>
      <?php  } ?>

    </tbody>
  </table>

</div>



<!-- Modal -->
<div class="modal fade" id="modal_barcode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Barcode</h4>
      </div>
      <div class="modal-body" style="text-align:center;">
          <center>
            <div id="genrate_code"></div>
          </center>
      </div>
      <div class="modal-footer" style="text-align:center;">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-sm" onclick="print('#modal_barcode')"><i class="fa fa-print fa-left" aria-hidden="true"></i> Print</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
      $('#data_barcode').DataTable();
    } );

    $('.barcode').click(function () {
      var code = $(this).attr('data-code');
       $("#genrate_code").barcode(code, "code128",{barWidth:1, barHeight:30,showHRI:true,output:"svg"});
      $('#modal_barcode').modal('show');
    });
</script>
