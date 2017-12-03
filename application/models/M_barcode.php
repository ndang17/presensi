<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_barcode extends CI_model {

  public function get_bacode()
  {
    $data = $this->db->query('SELECT * FROM db_presensi.barcode ORDER BY create_at DESC');
    return $data->result_array();
  }

}
