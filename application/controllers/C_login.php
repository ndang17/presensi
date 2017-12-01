<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_login extends CI_Controller {

	function __construct() {
        parent::__construct();
    }


  public function temp($content)
  {
    $data['content'] = $content;
    $this->load->view('template/template_blank',$data);
  }
	public function index()
	{
		$data ['captcha'] = $this->generateRandomString();
		$content = $this->load->view('login/login_1',$data,true);
    $this->temp($content);
	}

	function generateRandomString($length = 7) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}

}
