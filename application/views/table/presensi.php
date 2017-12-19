<table id="table_log" class="table table-bordered" cellspacing="0" width="100%">
  <thead>
      <tr>
          <th colspan="3">Log</th>
      </tr>
  </thead>

  <tbody id="table_log_body">

  </tbody>
</table>


<script type="text/javascript">
  $(document).ready(function () {
    var url = '<?php echo base_url('data-barcode'); ?>';
    $.get(url,function functionName(data) {
      var data_json = JSON.parse(data);
      console.log(data_json);
      var ps = 100/15;
        // console.log(ps*15);
      var tr = $('#table_log_body');
      for(var i=0; i<data_json.length ; i++){



        tr.append('<tr><td style="width:10%;"><div id="br'+i+'"></div></td><td>'+data_json[i].lecturer+'</td><td style="text-align:center;width:10%;"><h1 style="margin:0px;">'+data_json[i].jml_kembali+'</h1>Pertemuan</td></tr>');

        genrate_barcode('br'+i,data_json[i].barcode);

        // tr.append('<tr><td>'+data_json[i].barcode+' <br/>'+
        // '<div class="progress"><div class="progress-bar '+cl+'" role="progressbar" aria-valuenow="'+presensi+'" aria-valuemin="0" aria-valuemax="100" style="width: '+presensi+'%;">'+data_json[i].jml_kembali+' pertemuan</div></div></td></tr>');

      }
    });
  });
</script>

<!-- <table class="table table-bordered">
  <tr>
    <td>
      <div class="pess">

      </div>

    </td>
  </tr>
</table> -->
