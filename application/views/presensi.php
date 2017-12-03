
    <div class="container">
      <div class="row">
          <div class="col-md-3">

            <div class="thumbnail" style="padding:15px;text-align:center;">
                <button class="btn btn-primary btn-block launch-modal" data-toggle="modal" data-target="#myModal1" data-backdrop="static">
                  <strong><i class="fa fa-qrcode fa-left" aria-hidden="true"></i> Scan Barcode</strong>
                </button>

            </div>
            <div class="panel panel-default panel-login">
              <div class="panel-heading">
                <strong>Staff Akademic Only</strong>
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="NIK...">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" placeholder="Password...">
                </div>
                <button id="btn_login" class="btn btn-default btn-block" name="button"><b><i class="fa fa-sign-in fa-left" aria-hidden="true"></i> Login</b></button>
              </div>

              <script type="text/javascript">
                $('#btn_login').click(function () {
                  $('.panel-login').animateCss('shake');
                });
              </script>

            </div>
            <div class="thumbnail" style="padding:15px;">
              <div style="text-align:center;">
                <span id="copyright">IT PU, We Made With <i class="fa fa-heart fa-right animated infinite pulse" style="color:red;" aria-hidden="true"></i></span>
              </div>
            </div>
          </div>
          <div class="col-md-9">



            <div class="thumbnail" style="padding:10px;">
              <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
            </tr>
        </tbody>
    </table>
            </div>

          </div>
      </div>
    </div>

<script type="text/javascript">
    $(document).ready(function() {
      $('#example').DataTable();
    } );
</script>

<!-- Modal 1 -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Barcode Scanner Panel</h4>
      </div>
      <div class="modal-body">
        <input type="text" id="input_code" class="form-control" name="" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
