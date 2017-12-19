<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_barcode extends CI_model {

  public function get_all_bacode($order_by)
  {
    $data = $this->db->query('SELECT * FROM db_presensi.barcode ORDER BY id_barcode '.$order_by);
    return $data->result_array();
  }

  public function get_dosen()
  {
    $data = $this->db->query('SELECT nip, nama FROM siak4.dosen');
    return $data->result_array();
  }

  public function get_bacode_log($barcode)
  {
    $data = $this->db->query('SELECT lg.* FROM db_presensi.logging lg
                            WHERE lg.barcode = "'.$barcode.'.PU"
                                  ORDER BY lg.id_logging DESC LIMIT 1');
    return $data->result_array();
  }

  public function get_lecturer_barcode($barcode)
  {
    $data = $this->db->query('SELECT bc.* FROM db_presensi.barcode bc
                                  WHERE bc.barcode = "'.$barcode.'.PU"
                                   LIMIT 1');
    return $data->result_array();
  }

  public function get_log()
  {
    $data = $this->db->query('SELECT lg.*,bc.lecturer FROM db_presensi.logging lg
                            JOIN db_presensi.barcode bc
                              ON (lg.barcode = bc.barcode)
                              ORDER BY lg.id_logging DESC');
    return $data->result_array();
  }

  public function log_today($date)
  {
    $data = $this->db->query("SELECT lg.*,bc.lecturer FROM db_presensi.logging lg
                            JOIN db_presensi.barcode bc
                            ON (lg.barcode = bc.barcode)
                              WHERE DATE(lg.scan_at) = '".$date."'
                              ORDER BY lg.id_logging DESC");
    return $data->result_array();
  }

  public function get_user_log($barcode)
  {
    $data = $this->db->query('SELECT lg.*,bc.lecturer FROM db_presensi.logging lg
                            JOIN db_presensi.barcode bc
                              ON (lg.barcode = bc.barcode)
                              WHERE lg.barcode = "'.$barcode.'"
                              ORDER BY lg.id_logging DESC LIMIT 1');
    return $data->result_array();
  }

  public function get_sum_kembali($barcode)
  {
    $data = $this->db->query('SELECT count(*) AS jml FROM db_presensi.logging WHERE barcode="'.$barcode.'" AND status = 1 ');

    return $data->result_array();
  }

}
