<div class="thumbnail" style="padding:10px;">
  <table id="table_log" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Log</th>
            <th style="width:5%;">Action</th>
        </tr>
    </thead>
    <!-- <tfoot>
      <tr>
          <th>Log</th>
      </tr>
    </tfoot> -->
    <tbody id="table_log_body">

    </tbody>
  </table>


  <script type="text/javascript">
    $(document).ready(function () {
      load_table_logging();
    });

    function load_table_logging() {
      var url_log = "<?php echo base_url('logging'); ?>";
      $.get(url_log,function (data) {
        var data_json = JSON.parse(data);
        var tr = $('#table_log_body');
        tr.html('');

        for(var i=0;i<data_json.length;i++){
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
          "<td><a href='javascript:void(0)' class='showBlmKembali' data-barcode='"+data_json[i].barcode+"' >"+data_json[i].barcode+"</a> -"+data_json[i].group_kelas+" "+
          "<div style='float:right;'>"+
          "<span style='padding-right:5px;'>"+moment(data_json[i].scan_at).format('dddd, Do MMM YYYY h:mm:ss')+ "</span>"+status_folder+"</div>"+
          "<br/>"+dosen+"</td><td style='text-align:center;'><button class='btn btn-danger btn-sm' disabled><span class='glyphicon glyphicon-trash'></span></button></td>"+
                    "</tr>");

                    // console.log();
        }

        $('#table_log').DataTable({
            "ordering": false
        });

      });
    }
  </script>

</div>
