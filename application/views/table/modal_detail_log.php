

<?php

//print_r($log);

foreach ($log as $item) { ?>
<table class="table table-bordered table-striped">
    <tr>
        <td style="width: 10%;">Code</td>
        <td><?php echo $item['barcode']; ?></td>
    </tr>
    <tr>
        <td>Lecturers</td>
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

            echo $dsn;

            ?>
        </td>
    </tr>
    <tr>
        <td>Matakuliah</td>
        <td>
            <?php

            $item_mk = json_decode($item['matakuliah']);
            $mk = '';
            $koma = '';
            for($i=0;$i<count($item_mk);$i++){
                if($i!=0){
                    $koma ='<br/>';
                }
                $mk = $mk.''.$koma.''.$item_mk[$i];
            }

            echo $mk;
            ?>
        </td>
    </tr>
    <tr>
        <td>Group</td>
        <td><?php echo $item['group_kelas']; ?></td>
    </tr>
    <tr>
        <td>Status</td>
        <td>
            <?php
                if($item['status']==0){
                    echo '<span style="color:red;">Folder Belum Kembali</span>';
                } else {
                    echo '<span style="color:green;"> Folder Sudah Kembali</span>';
                }
            ?>
        </td>
    </tr>
    <tr>
        <td>Last Scan</td>
        <td>
            <span style="color: blue;" id="sc"></span>
        </td>

        <script>
            var sc = moment("<?php echo $item['scan_at']; ?>").format('dddd, Do MMM YYYY h:mm:ss');
            $('#sc').html(sc);
        </script>
    </tr>
</table>

<?php } ?>
