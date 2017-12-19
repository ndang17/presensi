
<div class="thumbnail" style="padding:15px;">

  <table id="table_create_barcode" class="table table-bordered">
    <thead>
      <tr style="background:#eaeaea;">
        <th style="width:25%;text-align:center;">Barcode</th>
        <th style="text-align:center;">Lecturer</th>
        <th style="text-align:center;width:1%;">Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td >
          <div style="text-align:center;">
            <div id="barcode1">
            </div>
          </div>
        </td>
        <td>
          <input type="hidden" class="hide" id="input_barcode1">
          <select id="lecturer1" class="input-lecturer" name="states[]" multiple="multiple" style="width:100%">
        </select>
          <!-- <select id="dosen1" data-placeholder="Choose a lecturer..." class="" multiple style="max-width:300px;" tabindex="4">
          </select> -->
        </td>
        <td></td>
      </tr>
    </tbody>
    <tbody id="next_data">
    </tbody>
  </table>

  <div style="text-align:right;">
    <a href="<?php echo base_url('admin/create-barcode'); ?>" id="btn_refresh" class="btn btn-warning" name="button"><i class="fa fa-refresh fa-left" aria-hidden="true"></i> Refresh Page</a>
    <button type="button" class="btn btn-info" id="btn_add" name="button"><i class="fa fa-plus-square fa-left" aria-hidden="true"></i> Add</button>
    <!-- <button type="button" class="btn btn-success" id="save_data" name="button"><i class="fa fa-save fa-left" aria-hidden="true"></i> Save</button> -->
    <button type="button" class="btn btn-success" id="save_print" name="button"><i class="fa fa-print fa-left" aria-hidden="true"></i> Save & Print</button>
    <button type="button" class="btn btn-success hide" id="print" name="button"><i class="fa fa-print fa-left" aria-hidden="true"></i> Print</button>
  </div>

</div>



<script type="text/javascript">
  var no_element = 1;
  var arr_element = [1];

//   var data_dosen = [
//     {
//      "nik": "111",
//      "name": "Finsen"
//    },
//    {
//      "nik": "222",
//      "name": "Amir"
//    },{
//     "nik": "333",
//     "name": "Guru"
//   },
//   {
//     "nik": "444",
//     "name": "Waskito"
//   },{
//    "nik": "555",
//    "name": "Ade F"
//  },
//  {
//    "nik": "666",
//    "name": "Woyo"
//  },{
//   "nik": "777",
//   "name": "Gandi"
// },
// {
//   "nik": "888",
//   "name": "Asfar"
// }
// ];

$(document).ready(function () {


    var code = moment().unix()+'.PU';
    $('#input_barcode1').val(code);
    genrate_barcode('barcode1',code);
    $('#lecturer1').select2();
    load_data_lecturer('lecturer1');

    // console.log(moment().format('YYYY-MM-DD HH:MM:SS'));


});

  $('#btn_add').click(function () {
    no_element = no_element+1;
    $('#next_data').append('<tr id="tr'+no_element+'"><td><div style="text-align:center;"><div id="barcode'+no_element+'"></div></div></td><td><input type="hidden" class="hide" id="input_barcode'+no_element+'"/><select id="lecturer'+no_element+'" class="input-lecturer" name="states[]" multiple="multiple" style="width:100%"></td><td style="text-align:center;"><button class="btn btn-danger btn-delete" data-id="'+no_element+'"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td></tr>');
    $('#tr'+no_element).animateCss('zoomInDown');
    var code = moment().unix()+'.PU';
    $('#input_barcode'+no_element).val(code);
    genrate_barcode('barcode'+no_element,code);
    arr_element.push(no_element);

    $('#lecturer'+no_element).select2();
    load_data_lecturer('lecturer'+no_element);

  });

  $(document).on('click','.btn-delete',function() {
    var element_delete = $(this).attr('data-id');
      $('#tr'+element_delete).animateCss('hinge',function () {
      $('#tr'+element_delete).remove();
      var index_del = arr_element.indexOf(parseInt(element_delete));
      // console.log(index_del);
      arr_element.splice(index_del,1);
      // console.log(arr_element);
    });

  });

  function load_data_lecturer(id) {
    var select_id = $('#'+id);
    var url_get = "<?php echo base_url('get-dosen'); ?>";
    $.get( url_get, function( data ) {
        var data_dosen = JSON.parse(data);
        // console.log(data_dosen);
        for(var i=0;i<data_dosen.length;i++){
          select_id.append('<option value="'+data_dosen[i]['nip']+' - '+data_dosen[i]['nama']+'">'+data_dosen[i]['nama']+'</option>');
        }
      });

    select_id.addClass('chosen-select');
  }

  $('#save_print').click(function () {
    button_create(true);
    save();
  });

  $('#print').click(function () {
    print('#table_create_barcode');
  });

  function save() {
    // console.log(arr_element);
    var arr_barcode = [];
    var arr_lecturer = [];
    var arr = [];

    var proses = 1;

    for(var i=0;i<arr_element.length;i++){
      var lecturer = $('#lecturer'+arr_element[i]).val();

      if(lecturer!=null){
        var data = {
          'barcode' : $('#input_barcode'+arr_element[i]).val(),
          'lecturer' : JSON.stringify(lecturer),
          'create_at' : moment().format('YYYY-MM-DD')
        }
        arr.push(data);
      } else {
        proses = 0;
      }

    }

    if(proses!=0){
      var url = "<?php echo base_url('admin/insert-barcode'); ?>";
     $.post(url,{ arr_data_barcode: arr })
     .done(function () {
       setTimeout( function() {
         print('#table_create_barcode');
         $('#save_print').addClass('hide');
         $('#print').removeClass('hide');
         $('#btn_refresh').attr('disabled',false);
         alert('Tersimpan');
       }, 3000);

     });
   } else {
     setTimeout( function() {
       button_create(false);
       alert('Data Harus Diisi Semua');
     }, 3000);
   }

    // console.log(arr_lecturer);
    // console.log(JSON.stringify(arr));
  }

  function button_create(value) {
    $('.btn-delete').attr('disabled',value);
    $('.input-lecturer').attr('disabled',value);
    $('#btn_refresh').attr('disabled',value);
    $('#btn_add').attr('disabled',value);
    $('#save_print').attr('disabled',value);
    if(value==true){
      $('#save_print').html('<i class="fa fa-circle-o-notch fa-spin fa-fw" style="margin-right:5px;"></i> Loading...');
    } else {
      $('#save_print').html('<i class="fa fa-print fa-left" aria-hidden="true"></i> Save & Print');
    }

  }





</script>
