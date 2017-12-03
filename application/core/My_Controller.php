<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Controller extends CI_Controller {

	function __construct() {
        parent::__construct();
    }


  public function temp($content)
  {
  	$data['content'] = $content;
  	$this->load->view('template',$data);
  }




}
