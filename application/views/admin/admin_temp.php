
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
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
      <div class="">
        <div class="list-group">
          <a href="<?php echo base_url('admin'); ?>" class="list-group-item <?php if($menu_active==''){echo 'active';} ?>"><i class="fa fa-bar-chart fa-left" aria-hidden="true"></i> Presensi</a>
          <a href="<?php echo base_url('admin/create-barcode'); ?>" class="list-group-item <?php if($menu_active=='create-barcode'){echo 'active';} ?>"><i class="fa fa-qrcode fa-left" aria-hidden="true"></i> Create Barcode</a>
          <a href="<?php echo base_url('admin/barcode'); ?>" class="list-group-item <?php if($menu_active=='barcode'){echo 'active';} ?>"><i class="fa fa-database fa-left" aria-hidden="true"></i> Management Barcode</a>

        </div>
        <div class="thumbnail">
          <!-- <a href="#" class="list-group-item log-out"><i class="fa fa-sign-out fa-left" aria-hidden="true"></i> Log Me Out</a> -->
          <button type="button" class="btn btn-danger btn-block" name="button"><i class="fa fa-sign-out fa-left" aria-hidden="true"></i> Log Me Out</button>
        </div>
      </div>
    </div>
    <div class="col-md-9">
      <?php echo $content_admin; ?>
    </div>
  </div>
</div>

<script type="text/javascript">
function print(element) {
  $(''+element).printThis({

    // shows debug info
    debug: false,

    // import page CSS
    importCSS: true,

    // import styles
    importStyle: false,

    // print outer container
    printContainer: true,

    // additonal CSS file
    loadCSS: "",

    // page title
    pageTitle: "Barcode",

    // remove inline styles
    removeInline: false,

    // print delay in ms
    printDelay: 333,

    // header
    header: null,

    // footer
    footer: null,

    // preserve input/form values
    formValues: true,

    // preserve the base tag (if available)
    base: false,

    // copy canvas elements (experimental)
    canvas: false,

    // html doctype
    doctypeString: '<!DOCTYPE html>',

    // remove script tags before appending
    removeScripts: false,

    // // copy classes from the html & body tag
    copyTagClasses: false

    });
}
</script>
