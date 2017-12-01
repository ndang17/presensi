<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_inventory extends CI_Controller {

	function __construct() {
        parent::__construct();
				// --- Models ---
				$this->load->model('m_inventory');

        $this->load->library('cfpdf');
    }

	public function temp($content)
	{
		$data['content'] = $content;
		$this->load->view('template/template_dash',$data);
	}

  public function sub_temp($content2)
  {
    $data['content2'] = $content2;
    $content = $this->load->view('page/inventory/nav_invent',$data,true);
    $this->temp($content);
  }

	public function index()
	{
		$content2 = $this->load->view('page/inventory/inventory','',true);
		$this->sub_temp($content2);
	}

  public function purchase_requisition()
  {
    $content2 = $this->load->view('page/inventory/purchase_requisition','',true);
		$this->sub_temp($content2);
  }


  public function create_pr()
  {
    $content2 = $this->load->view('page/inventory/create_pr','',true);
		$this->temp($content2);
  }




  public function form_af()
  {
    $this->load->view('page/inventory/form/form_af');
  }

  public function form_iom()
  {
    $this->load->view('page/inventory/form/form_iom');
  }

  public function form_berita_acara()
  {
    $this->load->view('page/inventory/form/form_berita_acara');
  }

  public function form_dokumen_pendukung()
  {
    $this->load->view('page/inventory/form/form_dokumen_pendukung');
  }

  public function form_daftar_barang_rusak()
  {
    $this->load->view('page/inventory/form/form_daftar_barang_rusak');
  }

  public function form_cs()
  {
    $this->load->view('page/inventory/form/form_cs');
  }


	public function data_ulang()
	{
		$content = $this->load->view('dataulang','',true);
		$this->temp($content);
	}

	public function json_dosen()
  {
    $data = $this->db->query("SELECT NIP, Nama FROM siak4.karyawan")->result_array();

    $arrayName = [];

    for($x=0;$x<count($data);$x++){
      $ar_p = $data[$x]['NIP']." - ".$data[$x]['Nama'];
      array_push($arrayName,$ar_p);
    }

    return print_r(json_encode($arrayName));
  }



}
