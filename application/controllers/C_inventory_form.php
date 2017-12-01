<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_inventory_form extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('m_inventory');
    }

    //---------- PR ------------
    public function form_pr()
    {
  		$data['department'] = $this->m_inventory->get_department();
      $this->load->view('page/inventory/form/form_pr',$data);
    }

  	public function insert_pr()
  	{

  		$date = new DateTime();
      $date_now = $date->format('Y-m-d');
  		$datetime_now = $date->format('Y-m-d H:i:s');

      $is_new = $this->input->post('is_new');
  		$no_pr = $this->input->post('no_pr');
  		$event = $this->input->post('event_');
  		$id_department = $this->input->post('department');
  		$amount = $this->input->post('hitung_pr');
  		$ppn = $amount * 10 / 100;
  		$amount_after_tax = $amount + $ppn;

  		$item_pr = json_decode($this->input->post('item_pr'));

      $data_pr = $this->m_inventory->search_nopr($no_pr);

      // baru
      if($is_new==1){
        if(count($data_pr)>0){
          $id_pr_form = $data_pr[0]['id_pr_form'];
          $data_item_pr = $this->m_inventory->get_pr_item($id_pr_form);

          $ex_d = explode(' ',$data_pr[0]['create_at']);
          $data_create_at = trim($ex_d[0]);
          if($data_create_at!=$date_now){
              // No PR Sudah Digunakan
              print_r('Nomor PR Sudah Digunakan');
          } else {

            // Update item
            if(count($item_pr)!=count($data_item_pr)){

              $this->m_inventory->del_pr_item($id_pr_form);

              for($i=0 ; $i<count($item_pr);$i++){
                $item_pr[$i] = (array) $item_pr[$i];
                $item_pr[$i]['id_pr_form'] = $id_pr_form;
                $ex = explode('/',$item_pr[$i]['date_needed']);
                $item_pr[$i]['date_needed'] = $ex[2].'-' .$ex[1].'-'.$ex[0];
                $this->db->insert('pr_item',$item_pr[$i]);
         		   }
             print_r('Update Item, baru Print');
            }
            // Print
            else {
              print_r('Langsung Print');
            }

          }

        } else {

          $data_all_pr = $this->m_inventory->get_pr();
          $id_pr_form = 1 + count($data_all_pr);

          // Insert Data PR Baru dengan No PR baru
          $data_insert_pr_form = array(
     			 'no_pr' => $no_pr,
     			 'event' => $event,
     			 'id_department' => $id_department,
     			 'amount' => $amount,
     			 'ppn' => $ppn,
     			 'amount_after_tax' => $amount_after_tax,
     			 'create_by' => 'Nandang',
     			 'create_at' => $datetime_now,
     			 'status' => 0
     		 );

     		 $this->db->insert('pr_form',$data_insert_pr_form);

         for($i=0 ; $i<count($item_pr);$i++){
           $item_pr[$i] = (array) $item_pr[$i];
           $item_pr[$i]['id_pr_form'] = $id_pr_form;
           $ex = explode('/',$item_pr[$i]['date_needed']);
           $item_pr[$i]['date_needed'] = $ex[2].'-' .$ex[1].'-'.$ex[0];
           $this->db->insert('pr_item',$item_pr[$i]);
          }

          print_r('Insert Item, baru Print');
        }

      }


  		// $arrayName = array(
  		// 	'no_pr' => '',
  		// 	'event_' => $this->input->post('event_'),
  		// 	'department' => $this->input->post('department'),
  		// 	'item' => $this->input->post('item_pr')
  		//  );





  		print_r($data_insert_pr_form);
  		 print_r($item_pr);
  			// $this->input->post('no_pr');
  			// $this->input->post('event_');
  			// $this->input->post('department');
  			// $this->input->post('item_pr');
  	}

  	//-----------------------------
}
