<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_presensi extends My_Controller {

	function __construct() {
        parent::__construct();
    }



	public function index()
	{
		$content = $this->load->view('presensi','',true);
		parent::temp($content);
		// $this->load->view('presensi');
	}


}
