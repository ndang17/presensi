<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct() {
        parent::__construct();
        /* tarik library Cfpdf supaya aktif, bisa juga diletakkan di dalam fungsi
        yang menjalankan pembuatan file PDF, atau kalau nggak mau repot sering menarik
        librarynya masukkan saja ke dalam autoload */
        $this->load->library('cfpdf');
    }


	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function tes($value='')
	{
		$data_ttd = array(
			'header' => array('Requested by,','Approved by,','Checked by,','Acknowledged by,'),
			'name' => array('Nandang Mulyadi','Dony Ok','Parmin S','Toton Y G'),
			'as' => array('IT Manager','Kabag','PHR','Rektor')
		);

		print_r($data_ttd);
	}

	public function buatpdf_af($pdf)
		{
				// $pdf = new FPDF();
				$pdf->AddPage('P','A4');

				$url_logo = base_url('assets/logo.png');
				$pdf->Image($url_logo,10,10,-600);

				$h_h = 4;
				$h_c = 3.3;
				$h_ttd = 15;
				$f_budget = $h_c *2;

				$f_h = 8;
				$f_c = 7;

				// $pdf->SetFont('Arial','I',7);
				// $pdf -> SetXY(250,5);
				// $pdf->Cell(85, 5, "FM-UAP/PUR-02.01", 0, 1, 'R');

				$pdf->SetFont('Arial','B',$f_h);
				$pdf->Cell(0, $h_c, "YAYASAN PENDIDIKAN AGUNG PODOMORO", 0, 1, 'R');
				$pdf->Cell(0, $h_c, "APPROVAL FORM", 0, 1, 'R');
				// mencetak 10 baris kalimat dalam variable "teks".

				// $pdf->ln();
				$pdf->ln();
				$pdf->SetFont('Arial','',$f_c);
				$pdf->Cell(30, $h_c, "No", 0, 0, 'L');
				$pdf->Cell(0, $h_c, ": 02/AF-IT/YPAP/X/2017", 0, 1, 'L');

				$pdf->Cell(30, $h_c, "Project", 0, 0, 'L');
				$pdf->Cell(0, $h_c, ": YAYASAN PENDIDIKAN AGUNG PODOMORO", 0, 1, 'L');

				$pdf->Cell(30, $h_c, "Department", 0, 0, 'L');
				$pdf->Cell(0, $h_c, ": IT", 0, 1, 'L');

				$pdf->Cell(30, $h_c, "Date", 0, 0, 'L');
				$pdf->setFillColor(240,248,255);
				$pdf->Cell(27, $h_c, ": 12 September 2017", 0, 1, 'L',true);

				$pdf->Cell(30, $h_c, "Pos Budget", 0, 0, 'L');
				$pdf->Cell(0, $h_c, ": Komputer Supplies & Internet", 0, 1, 'L');


				$header_1 = array('Item','Remark','Quantity','Unit Rate (Rp)','Amount (Rp)');
				$w_1 = array(40,65,15,35,35);

				$pdf->SetFont('Arial','B',$f_h);
				// $pdf -> SetY(60);
				for($i=0;$i<count($header_1);$i++){
					$pdf->setFillColor(192,192,192);
					$pdf->Cell($w_1[$i],$h_h,$header_1[$i],1,0,'C',true);
				}
				$pdf->Ln();

				// ---------- DATA ------------
				$data_pr = array(
					0 => array('01/PR-IT/YPAP/IX/2017','Service Proyektor','1','Rp 300,000','Rp 300,000'),
					1 => array('','','','',''),
					2 => array('','','','',''),
					3 => array('','','','',''),
					4 => array('','','','',''),
					5 => array('','','','',''),
					6 => array('','','','',''),
					7 => array('','','','','')
					);
				// $ex = array(1,'Maintenance Program PABX Panasonic','Maintenance Program PABX Panasonic','','','1','Rp. 300,000','Rp. 300,000');
				$pdf->SetFont('Arial','',$f_c);
				foreach($data_pr as $row){
					$pdf->Cell($w_1[0],$h_c,$row[0],1,0,'L');
					$pdf->Cell($w_1[1],$h_c,$row[1],1,0,'L');
					$pdf->Cell($w_1[2],$h_c,$row[2],1,0,'C');
					$pdf->Cell($w_1[3],$h_c,$row[3],1,0,'R');
					$pdf->Cell($w_1[4],$h_c,$row[4],1,1,'R');
				}

				//40,65,15,35,35
				$pdf->Cell(105,$h_c,'',0,0,'R');
				$pdf->Cell(50,$h_c,'Total',1,0,'C');
				$pdf->Cell(35,$h_c,'Rp 3,000,000',1,1,'R');

				$pdf->Cell(105,$h_c,'',0,0,'R');
				$pdf->Cell(50,$h_c,'PPN 10%',1,0,'C');
				$pdf->Cell(35,$h_c,'Rp 3,000,000',1,1,'R');

				$pdf->Cell(105,$h_c,'',0,0,'R');
				$pdf->Cell(50,$h_c,'Total Amount',1,0,'C',true);
				$pdf->Cell(35,$h_c,'Rp 3,000,000',1,1,'R',true);


				$pdf->ln();
				$pdf->SetFont('Arial','B',$f_h);
				$pdf->Cell(0,$h_h,'Finance Budget Vs Actual',1,1,'C',true);

				$pdf->SetFont('Arial','B',$f_c);
				$pdf->Cell(50,$h_h,'Budget 2017 (Rp.)',1,0,'C',true);
				$pdf->Cell(90,$h_h,'Month : September 2017 ',1,0,'L',true);
				$pdf->Cell(50,$h_h,'Requisition',1,1,'C',true);


				$pdf->SetFont('Arial','B',$f_h);
				$pdf->setFillColor(240,248,255);
				$pdf->Cell(50,$f_budget,'1,000,000,000',1,0,'R',true);

				$pdf->setFillColor(192,192,192);
				$pdf->SetFont('Arial','B',7);
				$pdf->Cell(40,$h_c,'Actual YTD (Rp.)',1,0,'C',true);
				$pdf->Cell(50,$h_c,'Balance YTD (Rp.)',1,0,'C',true);
				$pdf->Cell(25,$h_c,'Amount (Rp.)',1,0,'C',true);
				$pdf->Cell(25,$h_c,'Balance (Rp.)',1,1,'C',true);

				$pdf->Cell(50,$h_c,'',0,0,'C');
				$pdf->Cell(40,$h_c,'',1,0,'C',true);

				$pdf->setFillColor(240,248,255);
				$pdf->Cell(50,$h_c,'',1,0,'C',true);
				$pdf->Cell(25,$h_c,'',1,0,'C',true);
				$pdf->Cell(25,$h_c,'',1,1,'C');

				for ($i=0; $i < 41 ; $i++) {
					$pdf->Cell(50,$h_c,'',1,0,'C');
					$pdf->Cell(40,$h_c,'',1,0,'C');

					$pdf->Cell(50,$h_c,'',1,0,'C');
					$pdf->Cell(25,$h_c,'',1,0,'C');
					$pdf->Cell(25,$h_c,'',1,1,'C');
				}

				// 3 TTD
				$pdf->Cell(50,$h_c,'',1,0,'C',true);
				$pdf->Cell(90,$h_c,'',1,0,'C',true);
				$pdf->Cell(50,$h_c,'',1,1,'C',true);

				$pdf->Cell(50,$h_ttd,'',0,0,'C');
				$pdf->Cell(90,$h_ttd,'',0,0,'C');
				$pdf->Cell(50,$h_ttd,'',0,1,'C');

				$pdf->Cell(50,$h_c,'IT Manager',0,0,'C');
				$pdf->Cell(90,$h_c,'Johannes P S',0,0,'C');
				$pdf->Cell(50,$h_c,'Lily',0,1,'C');

				$pdf->Cell(50,$h_c,'(IT Manager)',0,0,'C');
				$pdf->Cell(90,$h_c,'(Johannes P S)',0,0,'C');
				$pdf->Cell(50,$h_c,'(Lily)',0,1,'C');

				$pdf->Rect(10,230,50,25);
				$pdf->Rect(60,230,90,25);
				$pdf->Rect(150,230,50,25);

				$pdf->ln();
				$pdf->Cell(0,$h_c,'Note',0,1,'L');
				$pdf->Rect(10,258,190,20);







				// $pdf->Output();
		}



	function buatpdf_pr($pdf)
    {
        // $pdf = new FPDF();
        $pdf->AddPage('L','Legal');

				$url_logo = base_url('assets/logo.png');
				$pdf->Image($url_logo,10,10,-300);

				$pdf->SetFont('Arial','I',7);
				$pdf -> SetXY(250,5);
				$pdf->Cell(85, 5, "FM-UAP/PUR-02.01", 0, 1, 'R');

				$pdf->SetFont('Arial','B',12);

        // mencetak 10 baris kalimat dalam variable "teks".


				$pdf -> SetXY(250,10);
				$pdf->Cell(0, 5, "PURCHASE REQUISITION (PR)", 0, 1, 'L');

				$pdf->SetFont('Arial','',9);
				$pdf -> SetXY(250,15);
				$pdf->Cell(15, 5, 'No', 0, 0, 'L');
				$pdf->Cell(70, 5, ': 01/PR-IT/YPAP/IX/2017', 0, 1, 'L');
				$pdf -> SetXY(250,20);
				$pdf->Cell(15, 5, 'Date', 0, 0, 'L');
				$pdf->Cell(70, 5, ': 12-Sep-2017', 0, 1, 'L');


				$pdf->Ln();
				$pdf -> SetY(30);
				$pdf->Cell(150, 5, 'Notes from Finance :', 0, 0, 'L');
				$pdf->Cell(25, 5, '', 0, 0, 'L');
				$pdf->Cell(40, 15, 'Event/others :', 0, 0, 'L');
				$pdf->Cell(110, 15, '', 0, 1, 'L');
				$pdf->Rect(10,30,150,25);

				$pdf -> SetX(185);
				$pdf->Cell(40, 1, 'Department :', 0, 0, 'L');
				$pdf->Cell(110, 1, '', 0, 1, 'L');
				$pdf->Rect(185,30,150,25);


				// ---------- HEADER ------------
				$header = array('No','Description','Specification (size, color, etc)','Exp Code','Date Needed','Quantity','Price Estimated','Total Amount');
				$w_header = array(8,85,90,17,35,20,35,35);

				$pdf->SetFont('Arial','B',9);
				$pdf -> SetY(60);
				for($i=0;$i<count($header);$i++){
					$pdf->Cell($w_header[$i],10,$header[$i],1,0,'C');
				}
				$pdf->Ln();

				// ---------- DATA ------------
				$data_pr = array(
					0 => array(1,'Maintenance Program PABX Panasonic','Maintenance Program PABX Panasonic','','','1','Rp. 300,000','Rp. 300,000'),
					1 => array('','','','','','','',''),
					2 => array('','','','','','','',''),
					3 => array('','','','','','','',''),
					4 => array('','','','','','','',''),
					5 => array('','','','','','','',''),
					6 => array('','','','','','','',''),
					7 => array('','','','','','','','')
					);
				// $ex = array(1,'Maintenance Program PABX Panasonic','Maintenance Program PABX Panasonic','','','1','Rp. 300,000','Rp. 300,000');
				$pdf->SetFont('Arial','',9);
				$w = $w_header;
				$pdf -> SetY(70);
				foreach($data_pr as $row){
					$pdf->Cell($w[0],6,$row[0],1,0,'C');
					$pdf->Cell($w[1],6,$row[1],1,0,'L');
					$pdf->Cell($w[2],6,$row[2],1,0,'L');
					$pdf->Cell($w[3],6,$row[3],1,0,'C');
					$pdf->Cell($w[4],6,$row[4],1,0,'C');
					$pdf->Cell($w[5],6,$row[5],1,0,'C');
					$pdf->Cell($w[6],6,$row[6],1,0,'R');
					$pdf->Cell($w[7],6,$row[7],1,1,'R');
				}


				$pdf->Cell(183, 6, '', 0, 0, 'C');
				$pdf->Cell(107, 6, 'Total', 1, 0, 'C');
				$pdf->Cell(35, 6, '', 1, 1, 'L');

				$pdf->Cell(183, 6, '', 0, 0, 'C');
				$pdf->setFillColor(192,192,192);
				$pdf->Cell(107, 6, 'ppn 10%', 1, 0, 'C',true);
				$pdf->Cell(35, 6, '', 1, 1, 'L');

				$pdf->Cell(183, 6, '', 0, 0, 'C');
				$pdf->Cell(107, 6, 'Total setelah ppn', 1, 0, 'C');
				$pdf->Cell(35, 6, '', 1, 1, 'L');



				$pdf->Ln();
				$pdf->Cell(150, 6, 'Notes :', 0, 0, 'L');
				$pdf->Rect(10,142,150,25);

				// JIKA 4 TTD
				// $pdf->Cell(35, 5, '', 0, 0, 'C');
				// $pdf->Cell(35, 5, '', 1, 0, 'C');
				// $pdf->Cell(35, 5, '', 1, 0, 'C');
				// $pdf->Cell(35, 5, '', 1, 0, 'C');
				// $pdf->Cell(35, 5, '', 1, 1, 'C');

				// JIKA 3 TTD
				$data_ttd = array(
					'header' => array('Requested by,','Approved by,','Checked by,'),
					'name' => array('Nandang Mulyadi','Dony Ok','Parmin S'),
					'as' => array('IT Manager','Kabag','PHR')
				);
				$ttd = count($data_ttd['header']);
				$n_data = 0;
				for($x=0;$x<=$ttd;$x++){
					$ln = ($x==$ttd) ? 1 : 0;

					if($x==0){
						$w = (5-$ttd)*35;
							$pdf->Cell($w, 5, '', 0, $ln, 'C');
					} else {
						$pdf->Cell(35, 5, ''.$data_ttd['header'][$n_data], 1, $ln, 'C');
						$n_data += 1;

					}

					// $pdf->Cell(35, 5, ',', 1, 0, 'C');
					// $pdf->Cell(35, 5, ',', 1, 1, 'C');
				}

				for($x=0;$x<=$ttd;$x++){
					$ln = ($x==$ttd) ? 1 : 0;

					if($x==0){
						$w = 185 + ((4-$ttd) * 35);
						$pdf->Cell($w, 5, '', 0, 0, 'C');
					} else {
							$pdf->Cell(35, 20, '', 0, $ln, 'C');
					}

				}

				$n_data = 0;
				for($x=0;$x<=$ttd;$x++){
					$ln = ($x==$ttd) ? 1 : 0;
					if($x==0){
						$w = 185 + ((4-$ttd) * 35);
						$pdf->Cell($w, 5, '', 0, 0, 'C');
					} else {
							$pdf->Cell(35, 5, ''.$data_ttd['name'][$n_data], 0, $ln, 'C');
							$n_data += 1;
					}
				}

				$as=0;
				if($as==1){
					$n_data = 0;
					for($x=0;$x<=$ttd;$x++){
						$ln = ($x==$ttd) ? 1 : 0;
						if($x==0){
							$w = 185 + ((4-$ttd) * 35);
							$pdf->Cell($w, 5, '', 0, 0, 'C');
						} else {
								$pdf->Cell(35, 5, '( '.$data_ttd['as'][$n_data].' )', 0, $ln, 'C');
								$n_data += 1;
						}
					}
				}


				$w=195 + ((4-$ttd)*35);
				for($x=1;$x<=$ttd;$x++){
					$pdf->Rect($w,142,35,35);
					$w += 35;
				}

				for($x=0;$x<=$ttd;$x++){
					$ln = ($x==$ttd) ? 1 : 0;
					if($x==0){
						$w = 185 + ((4-$ttd) * 35);
						$pdf->Cell($w, 5, '', 0, 0, 'C');
					} else {
							$pdf->Cell(35, 5, 'Date : ', 1, $ln, 'L');
					}
				}


        // $pdf->Output();
    }

		public function test($value='')
		{
			$pdf = new FPDF();
			$this->buatpdf_pr($pdf);
			$this->buatpdf_af($pdf);
			$pdf->Output();
		}





}
