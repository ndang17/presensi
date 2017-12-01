<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_inventory extends CI_model {


  public function get_department()
  {
    $data = $this->db->query('SELECT * FROM invent.department');

    return $data->result_array();
  }

  public function search_nopr($no_pr)
  {
    $data = $this->db->query('SELECT * FROM invent.pr_form WHERE no_pr like "'.$no_pr.'" ');
    return $data->result_array();
  }

  public function get_pr()
  {
    $data = $this->db->query('SELECT * FROM invent.pr_form');
    return $data->result_array();
  }

  public function get_pr_item($id_pr_form)
  {
    $data = $this->db->query('SELECT * FROM invent.pr_item WHERE id_pr_form = "'.$id_pr_form.'" ');
    return $data->result_array();
  }

  public function del_pr_item($id_pr_form)
  {
    $this->db->where('id_pr_form', $id_pr_form);
    $this->db->delete('pr_item');
  }

}
