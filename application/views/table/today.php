
<div style="text-align: right;margin-bottom: 10px;"><button id="cetak_today" class="btn btn-success btn-sm btn-dashboard" <?php if(count($today)<=0){echo 'disabled';} ?> ><i class="fa fa-print fa-left" aria-hidden="true"></i> Print</button></div>
<script>
    $('#cetak_today').click(function () {
        print('#table_today');
    });
</script>
<table id="table_today" class="table table-hover">
  <!-- <thead>
    <tr>
      <th style="text-align:center;">Log</th>
    </tr>
  </thead> -->
  <tbody id="new_row">

  </tbody>
  <tbody>
    <?php
    $no = 1;
     foreach ($today as $item) { ?>
      <tr>
        <td>
          <a href="javascript:void(0)" class="showBlmKembali" data-barcode="<?php echo $item['barcode']; ?>"><?php echo $item['barcode']; ?></a> - <?php echo $item['group_kelas']; ?>
          <div style="float:right;">
            <span id="sc<?php echo $no; ?>" style="padding-right:5px;">
              <script type="text/javascript">
                // format_date
                var sc = moment("<?php echo $item['scan_at']; ?>").format('dddd, Do MMM YYYY h:mm:ss');
                $('#sc<?php echo $no; ?>').html(sc);
              </script>
              <?php

              // $date=date_create("".$item['scan_at']);
                //echo date("d F Y H:m:s", strtotime($item['scan_at']));
              ?>
            </span>
          <?php

            if($item['status']!=0){
              echo '<span class="label label-info label-info-custom" style="text-align:center;">KEMBALI</span>';
            } else {
              echo '<span class="label label-warning label-warning-custom" style="text-align:center;">AMBIL</span>';
            }
           ?>
           </div>
           <br>
           <?php
            $data_dosen = json_decode($item['lecturer']);
            $data_mk = json_decode($item['matakuliah']);
            for($i=0;$i<count($data_dosen);$i++){
              if($i!=0){
                echo ", ";
              }
              echo $data_dosen[$i];
            }
//           echo '<hr style="margin-top:5px;margin-bottom:5px;border-top:0.5px solid #4CAF50;" />';
            echo '<div class="well" style="padding: 5px;">';
            for($i=0;$i<count($data_mk);$i++){
                if($i!=0){
                    echo ", ";
                }
                echo $data_mk[$i];
            }

            echo '</div>';

            ?>
        </td>
      </tr>
    <?php $no++; } ?>

  </tbody>
</table>
