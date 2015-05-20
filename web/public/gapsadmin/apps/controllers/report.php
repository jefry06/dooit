<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('user_model');
		$this->user_model->has_login();
		$this->load->model('order_model');

	}
	
	public function index()
	{

		$CU      	 		= $this->user_model->current_user();		
		$nama    	 		= isset($CU->nama) ? $CU->nama : 'Guest';

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$start = mysql_real_escape_string($this->input->post('date_start'));
			$end = mysql_real_escape_string($this->input->post('date_end'));
			$status = mysql_real_escape_string($this->input->post('status'));

			$ORDER= $this->order_model->get_report($start,$end,$status);
			//print_r($ORDER);exit();
			if(!empty($ORDER)) {
				//load our new PHPExcel library
				$this->load->library('excel');

				$this->excel->getProperties()->setCreator("GAPS CMS");
				$this->excel->getProperties()->setLastModifiedBy("GAPS CMS");
				$this->excel->getProperties()->setTitle("GAPS Report".date('Y-m-d'));
				$this->excel->getProperties()->setSubject("GAPS Report".date('Y-m-d'));
				$this->excel->getProperties()->setDescription("GAPS Report Generate at ".date('Y-m-d'));

				$styleArray = array(
				  'borders' => array(
				    'allborders' => array(
				      'style' => PHPExcel_Style_Border::BORDER_THIN
				    )
				  )
				);

				// =================== Sheet 1 Order ==============================			
				$WS1 = $this->excel->createSheet(0);
				$WS1->setCellValue('A1', 'order_date')
		            ->setCellValue('B1', 'order_code')	            
		            ->setCellValue('C1', 'user_id')
		            ->setCellValue('D1', 'order_status')		            
		            ->setCellValue('E1', 'item_id')
					->setCellValue('F1', 'item_name')
					->setCellValue('G1', 'item_price')
					->setCellValue('H1', 'item_desc')
					->setCellValue('I1', 'item_size')
					->setCellValue('J1', 'item_color')
					->setCellValue('K1', 'item_disc')
					->setCellValue('L1', 'item_qty')
					->setCellValue('M1', 'item_subtotal');

	            $s=0;
			for ($i=0; $i <count($ORDER) ; $i++) { 
				# code..
				$s=$i+2;
				if($ORDER[$i]['order_status']=='0'){
					$stat="Pending";
				}elseif ($ORDER[$i]['order_status']=='1') {
					$stat="Sukses";
				}else{
					$stat="Gagal";
				}
				$WS1->setCellValue('A'.$s, $ORDER[$i]['order_date'])
		            ->setCellValue('B'.$s, $ORDER[$i]['order_code'])
		            ->setCellValue('C'.$s, $ORDER[$i]['user_id'])
		            ->setCellValue('D'.$s, $stat)
					->setCellValue('E'.$s, $ORDER[$i]['item_id'])
					->setCellValue('F'.$s, $ORDER[$i]['item_name'])
					->setCellValue('G'.$s, $ORDER[$i]['item_price'])
					->setCellValue('H'.$s, $ORDER[$i]['item_desc'])
					->setCellValue('I'.$s, $ORDER[$i]['item_size'])										
					->setCellValue('J'.$s, $ORDER[$i]['item_color'])
					->setCellValue('K'.$s, $ORDER[$i]['item_disc'])
					->setCellValue('L'.$s, $ORDER[$i]['item_qty'])
					->setCellValue('M'.$s, $ORDER[$i]['item_subtotal']);		        
			}

			$WS1->getStyle('A1:M'.$s)->applyFromArray($styleArray);
			$WS1->getStyle('B1:B'.$s)->getNumberFormat()->setFormatCode("###0");	
			$WS1->getStyle('C1:C'.$s)->getNumberFormat()->setFormatCode("###0");			
			$WS1->getStyle('G1:G'.$s)->getNumberFormat()->setFormatCode("###0");
			$WS1->getStyle('M1:M'.$s)->getNumberFormat()->setFormatCode("###0");
			$WS1->getColumnDimension("A:M")->setAutoSize(true);
			//$WS1->getColumnDimension('A1:Y'.$s)->setAutoSize(true);			   
			$WS1->setTitle('Product Order');
			//===================== END OF ORDER ==============================

			ob_end_clean();
		
			$filename='GAPS_report_'.date('Y-m-d').'.xls'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache
			 
			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');

			}
		}else{
			// load header
			$h['CU']      		= $CU;
			$h['nama']    		= $nama;
			$b['header'] 		= $this->load->view('template/vheader',$h,TRUE);

			//load navigation
			$n['ACCESS_MENU']	= $this->user_model->get_user_menu($CU->uid,TRUE);						
			$b['navigation']	= $this->load->view('template/vnavigation',$n,TRUE);

			//load Content
			$c['CU']      		= $CU;
			$c['nama']    		= $nama;
			$c['page_title'] 	="Report";
			$b['content']	= $this->load->view('report/vform',$c,TRUE);

			//load base view
			$this->load->view('vbase',$b);			
		}

	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */