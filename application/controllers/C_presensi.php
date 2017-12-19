<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_presensi extends My_Controller {

	function __construct() {
        parent::__construct();
				$this->load->model('M_barcode');
				date_default_timezone_set("Asia/Jakarta");

    }


	public function home_presensi($table_presensi)
	{
		$data['table_presensi'] = $table_presensi;
		$content = $this->load->view('presensi',$data,true);
		parent::temp($content);
	}

	public function index()
	{
		$today = date("Y-m-d");
		$data['today'] = $this->M_barcode->log_today($today);
		$table_presensi = $this->load->view('table/today',$data,true);
		$this->home_presensi($table_presensi);
	}

	public function table_all_logging()
	{
		$table_presensi = $this->load->view('table/all_log','',true);
		$this->home_presensi($table_presensi);
	}

	public function presensi()
	{
		$table_presensi = $this->load->view('table/presensi','',true);
		$this->home_presensi($table_presensi);
	}


	//-----------------------------------------------------------------------

	public function insert_log()
	{
		// Cek status trakhir
		$barcode = $this->input->post('post_arr');
		print_r($barcode);

		$barcode['scan_at'] = date("Y-m-d H:i:s");

		print_r($barcode);

		$this->db->insert('logging',$barcode);

		// $data_barcode = $this->M_barcode->get_bacode_log();
		// $data_insert = array(
		// 	'' => ,
		// );
	}

	public function cek_status($barcode)
	{
		$data = $this->M_barcode->get_bacode_log($barcode);
		print_r(json_encode($data));
	}

	public function cek_lecturer($barcode)
	{
		$data = $this->M_barcode->get_lecturer_barcode($barcode);
		print_r(json_encode($data));
	}

	public function logging()
	{
		$data = $this->M_barcode->get_log();
		$data_json = json_encode($data);
		print_r($data_json);
	}

	public function get_user_log()
	{
		$barcode = $this->input->get('barcode');
		$data = $this->M_barcode->get_user_log($barcode);
		$data_json = json_encode($data);
		print_r($data_json);
	}

	public function get_barcode()
	{
		$data = $this->M_barcode->get_all_bacode('ASC');

		for($i=0;$i<count($data);$i++){
			$sum = $this->M_barcode->get_sum_kembali($data[$i]['barcode']);
			$data[$i]['jml_kembali'] = $sum[0]['jml'];

		}

		$data_json = json_encode($data);
		print_r($data_json);

	}


	public function get_all_ambil(){

	    // Mendapatkan semua barcode
        $data = $this->M_barcode->get_all_bacode('ASC');

        $arr_date=array();

        // Cek barcode mana yang status trakhirnya ambil / 0
        $no=0;
        for($i=0;$i<count($data);$i++){
            $barcode = explode(".",$data[$i]['barcode'])[0];
            $data_status = $this->M_barcode->get_bacode_log($barcode);
            $data[$i]['status_folder'] = (count($data_status)>0) ? $data_status[0]['status']: '-';


            if(count($data_status)>0 && $data_status[0]['status']==0){

                array_push($arr_date,$data_status[0]['scan_at']);

                $result[$no] = $data[$i];
                $result[$no]['scan_at'] = $data_status[0]['scan_at'];
                $no = $no + 1;
            }
        }
        function date_sort($a, $b) {
            return strtotime($a) - strtotime($b);
        }

//        print_r($data_json);
//        print_r($arr_date);
        usort($arr_date, "date_sort");
//        print_r($arr_date);

        $no2=0;
        $res=[];
        for($r=0;$r<count($arr_date);$r++){
            for($r2=0;$r2<count($result);$r2++){
                if($arr_date[$r]==$result[$r2]['scan_at']){
                    $res[$no2] = $result[$r2];
                    $no2 = $no2 + 1;
                }
            }
        }
        $data_json = json_encode($res);
        print_r($data_json);
    }




	public function set_session()
	{
		$data_session = $this->input->post('data_session');
		// print_r($data_session);
		$this->session->set_userdata($data_session);
	}

	public function log_out()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}




}
