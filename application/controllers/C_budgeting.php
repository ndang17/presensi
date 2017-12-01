<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_budgeting extends CI_Controller {

	function __construct() {
        parent::__construct();
    }

	public function temp($content)
	{
		$data['content'] = $content;
		$this->load->view('template/template_dash',$data);
	}
	public function index()
	{
		$content = $this->load->view('page/budget/budget','',true);
		$this->temp($content);
	}
}
