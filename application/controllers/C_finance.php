<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_finance extends CI_Controller {

	function __construct() {
        parent::__construct();
        /* tarik library Cfpdf supaya aktif, bisa juga diletakkan di dalam fungsi
        yang menjalankan pembuatan file PDF, atau kalau nggak mau repot sering menarik
        librarynya masukkan saja ke dalam autoload */
        $this->load->library('cfpdf');
    }

	public function temp($content)
	{
		$data['content'] = $content;
		$this->load->view('template/template_dash',$data);
	}
	public function index()
	{
    $data['breadcrumbs'] = '';
		$content = $this->load->view('page/finance/finance',$data,true);
		$this->temp($content);
	}

  public function add_pr()
  {
    $data['breadcrumbs'] = '';
    $content = $this->load->view('page/finance/add_pr',$data,true);
		$this->temp($content);
  }
}
