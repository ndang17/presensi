<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_admin extends My_Controller {

	function __construct() {
        parent::__construct();
				$this->load->model('M_barcode');
    }


	public function admin_temp($content_admin)
	{
		$data_page['page'] = 123;
		$data_page['content_admin'] = $content_admin;
		$content = $this->load->view('admin/admin_temp',$data_page,true);
		parent::temp($content);
	}

	public function index()
	{
		$data_page['page'] = 123;
		$content_admin = $this->load->view('admin/presensi',$data_page,true);
		$this->admin_temp($content_admin);
	}

	public function create_barcode()
	{
		$data_page['page'] = 123;
		$content_admin = $this->load->view('admin/dashboard',$data_page,true);
		$this->admin_temp($content_admin);
	}

	public function management_barcode()
	{
		$data_page['barcode'] = $this->M_barcode->get_bacode();
		$content_admin = $this->load->view('admin/management_barcode',$data_page,true);
		$this->admin_temp($content_admin);
	}

	public function tes($value='')
	{
		$data_page['page'] = 123;
		$content = $this->load->view('admin/tes',$data_page,true);
		parent::temp($content);
	}


	// Database Relation
	public function insert_barcode()
	{
		$ar_data = $this->input->post('arr_data_barcode');
		print_r($ar_data);
		for($i=0;$i<count($ar_data);$i++){
			$this->db->insert('barcode', $ar_data[$i]);
		}
	}

}
