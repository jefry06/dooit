<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaksi extends CI_Controller {

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
		$c['page_title'] 	="Transaksi";
		$b['content']	= $this->load->view('transaksi/vlist',$c,TRUE);

		//load base view
		$this->load->view('vbase',$b);
	}

	public function json()
	{		
		$result=$this->order_model->get_();
		print_r( $result);
	}	

	function detail($order_code="")
	{
		if($order_code!='')
		{
			$CU      	 		= $this->user_model->current_user();		
			$nama    	 		= isset($CU->nama) ? $CU->nama : 'Guest';

			// load header
			$h['CU']      		= $CU;
			$h['nama']    		= $nama;
			$b['header'] 		= $this->load->view('template/vheader',$h,TRUE);

			//load navigation
			$n['ACCESS_MENU']	= $this->user_model->get_user_menu($CU->uid,TRUE);						
			$b['navigation']	= $this->load->view('template/vnavigation',$n,TRUE);

			//load Content
			$c['CU']      		= $CU;
			$ORDER_HEADER	= (array) $this->order_model->get_by_id($order_code);
			$ORDER_DETAIL	= (array) $this->order_model->get_order_detail($order_code);
			$ORDER_DELIVERY = (array) $this->order_model->get_delivery_by_id($order_code);	
			//$ORDER_HISTORY	= (array) $this->order_model->get_history_by_id($order_code);	
			$c['DETAIL']	= (object) array_merge($ORDER_HEADER,array('detail' => $ORDER_DETAIL),$ORDER_DELIVERY);
			$c['nama']    		= $nama;
			$c['page_title'] 	=" Detail Transaksi";
			$b['content']	= $this->load->view('transaksi/vdetail',$c,TRUE);

			//load base view
			$this->load->view('vbase',$b);

		}
	}

	function kirim()
	{
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			//print_r($_POST);exit();
			$order_code = $this->input->post('order_code');
			$user_id = $this->input->post('user_id');
			$no_resi = $this->input->post('no_resi');
			$delivery_by =$this->input->post('delivery_by');
			$order=$this->order_model->get_by_id($order_code);
			if(count($order)>0)
			{

				//update header
				$header['order_status'] =1;
				$header['modified_at'] = date("Y-m-d H:i:s");
				$this->order_model->update_($header,$order_code);

				$CU      	 		= $this->user_model->current_user();		
				$nama    	 		= isset($CU->nama) ? $CU->nama : 'Guest';

				//insert history
				$history['user_id'] = $order->user_id;
				$history['order_code'] = $order_code;
				$history['history_date'] = date("Y-m-d H:i:s");
				$history['history_status'] = "Sukses";
				$history['history_desc'] = "Barang sudah dikirim via : ".$delivery_by." dengan Tracking No : ".$no_resi;
				$history['create_at'] = date("Y-m-d H:i:s");
				$history['user_act'] = $nama;
				$this->order_model->insert_history_($history);

				//update delivery tracking no
				$delivery['delivery_tracking_no'] = $no_resi;
				$this->order_model->update_delivery_($delivery,$order_code);

				//get Order
				$result1=$this->order_model->get_by_id($order_code);
				$result2=$this->order_model->get_detail_by_id($order_code);
				$result3=$this->order_model->get_delivery_by_id($order_code);
				$data = array_merge( (array) $result1, (array) $result3, array("detail"=> (array) $result2) );

				//email user;
				$delivery=$this->order_model->get_delivery_by_id($order_code);
				$to['to']=$delivery->delivery_email;
				$subject ="Status dari pesanan : ".$order_code;
				$message =$this->setmailtosendtrx($data);
				
				$this->sendemail($to,$subject,$message);
					$this->session->set_userdata('message','Data telah tersimpan.');
					$this->session->set_userdata('message_type','success');						
								
			}
		}
		redirect(site_url('transaksi/index'));
	}


	function batal($order_code="")
	{
		if($order_code!='')
		{
			$order=$this->order_model->get_by_id($order_code);
			if(count($order)>0)
			{			
				//update header
				$header['order_status'] =2;
				$header['modified_at'] = date("Y-m-d H:i:s");
				$this->order_model->update_($header,$order_code);

				$CU      	 		= $this->user_model->current_user();		
				$nama    	 		= isset($CU->nama) ? $CU->nama : 'Guest';

				//insert history
				$history['user_id'] = $order->user_id;
				$history['order_code'] = $order_code;
				$history['history_date'] = date("Y-m-d H:i:s");
				$history['history_status'] = "Gagal";
				$history['history_desc'] = "Order telah di batalkan";
				$history['create_at'] = date("Y-m-d H:i:s");
				$history['user_act'] = $nama;
				$this->order_model->insert_history_($history);

				//get Order
				$result1=$this->order_model->get_by_id($order_code);
				$result2=$this->order_model->get_detail_by_id($order_code);
				$result3=$this->order_model->get_delivery_by_id($order_code);
				$data = array_merge( (array) $result1, (array) $result3, array("detail"=> (array) $result2) );

				//email user;
				$delivery=$this->order_model->get_delivery_by_id($order_code);
				$to['to']=$delivery->delivery_email;
				$subject ="Status dari pesanan : ".$order_code;
				$message =$this->setmailtosendtrx($data,TRUE);
				
				$this->sendemail($to,$subject,$message);
					$this->session->set_userdata('message','Data telah tersimpan.');
					$this->session->set_userdata('message_type','success');						
				redirect(site_url('transaksi/index'));		
			}			
		}
	}


	function setmailtosendtrx($data,$batal=FALSE)
	{

		if($batal){
			$bodymail='
			    <tr>
			        <td colspan="3" style="text-align: center">
			            <h3>Order ship!</h3>
			            <span style="text-align: center;font-size: 12px;">
			            Hi there, your order has been cancel
						Please contact 08071119779 or info@gaps.co.id to track your order.  
						Thank you for using PlusCard.
			            </span><br><br>
			            <div style="text-align: center;margin: 20px auto;max-width:300px">
			                <table style="width: 100%;border: 1px solid #ccc;text-align:left!important;font-size: 12px">
			                    <tbody><tr>
			                        <td colspan="2" style="border-bottom: 1px solid #ccc;text-align: right;font-weight: bold;font-size: 14px">Order No: '.$data['order_code'].'</td>
			                    </tr>
			                    <tr>
			                        <td style="border-bottom: 1px solid #ccc">Items</td>
			                        <td style="border-bottom: 1px solid #ccc;border-left: 1px solid #ccc;text-align: center">Qty</td>
			                    </tr>';
		}else{
			$bodymail='
			    <tr>
			        <td colspan="3" style="text-align: center">
			            <h3>Order ship!</h3>
			            <span style="text-align: center;font-size: 12px;">
			            Hi there, your order has been ship using : <b>'.$data['delivery_by'].'</b> with Tracking No : <b>'.$data['delivery_tracking_no'].'</b>
						Please check delivery website to track your order.  
						Thank you for using PlusCard.
			            </span><br><br>
			            <div style="text-align: center;margin: 20px auto;max-width:300px">
			                <table style="width: 100%;border: 1px solid #ccc;text-align:left!important;font-size: 12px">
			                    <tbody><tr>
			                        <td colspan="2" style="border-bottom: 1px solid #ccc;text-align: right;font-weight: bold;font-size: 14px">Order No: '.$data['order_code'].'</td>
			                    </tr>
			                    <tr>
			                        <td style="border-bottom: 1px solid #ccc">Items</td>
			                        <td style="border-bottom: 1px solid #ccc;border-left: 1px solid #ccc;text-align: center">Qty</td>
			                    </tr>';			
		}

		$loop="";
		foreach ($data['detail'] as $key ) {
		$loop .='<tr>
		            <td style="border-bottom: 1px solid #ccc">'.$key['item_name'].'</td>
		            <td style="border-bottom: 1px solid #ccc;border-left: 1px solid #ccc;text-align: center">'.$key['item_qty'].'</td>
		        </tr>
		        <tr>';
		}

		$bodymail = $bodymail.$loop.'
	                </tbody></table>
	                <br>
	                <table style="text-align: left;font-size: 11px">
	                    <tbody><tr>
	                        <td style="border-bottom:1px solid #ccc;border-right:1px solid #ccc;min-width: 180px"><strong>Delivery Details :</strong></td>
	                        <td style="border-bottom:1px solid #ccc;"><strong>Note :</strong></td>
	                    </tr>
	                    <tr>
	                        <td style="border-right:1px solid #ccc;min-width: 180px">
	                            '.$data['delivery_nama'].'<br>
	                            '.$data['delivery_tlp'].'<br>
	                            '.$data['delivery_alamat'].'<br>
	                            RT/RW '.$data['delivery_rt'].'/'.$data['delivery_rw'].'<br>
	                            '.$data['delivery_kota'].'<br>
	                            '.$data['delivery_kodepos'].'<br>
	                            '.$data['delivery_by'].'<br>
	                            Tracking No : '.$data['delivery_tracking_no'].'<br>
	                        </td>
	                        <td>

	                        </td>
	                    </tr>
	                </tbody></table>
	                <span style="font-size: 10px">
	                For customer service please contact 08071119779 or info@gaps.co.id
	                </span>
	            </div>
	        
	        </td>
	    </tr>		';

    	return $bodymail;

	}

	function sendemail($to=array(),$subject="",$bodymail="")
	{
		$this->load->library('email');
		$config['protocol'] = $this->config->item('mail_protocol');
		if($this->config->item('mail_protocol')=='smtp'){
			$config['smtp_host'] = $this->config->item('mail_smtp_host');
			$config['smtp_user'] = $this->config->item('mail_smtp_user');
			$config['smtp_pass'] = $this->config->item('mail_smtp_pass');
			$config['smtp_port'] = $this->config->item('mail_smtp_port');					
		}

		if($this->config->item('mail_protocol')=='sendmail')
		{
			$config['mailpath'] = $this->config->item('mail_mailpath');					
		}
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = "html";
		$this->email->initialize($config);

		$this->email->from('no_reply@mcoinasia.com', 'Gaps System');
		if($to['to']!=''){
			$this->email->to($to['to']); 			
		}
		if(isset($to['cc'])){
			$this->email->cc($to['cc']); 
		}
		if(isset($to['bcc'])){
			$this->email->bcc($to['bcc']); 
		}
		$this->email->subject($subject);
		$message='
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>PLUS Card</title>
</head>
<body style="background: #e2e2e2;font-family: &#39;Open sans&#39;, sans-serif,arial, helvetica;color: #333;">
<table style="background: #fff;margin: 10px auto;padding: 10px;border: 1px solid #ccc;width: 90%">
    <tbody><tr>
        <td colspan="3" style="padding:0;margin:0;background:#003649;text-align:center;height: 120px;width: 100%">
            <img height="120px" src="http://'.$_SERVER['SERVER_NAME'].'/assets/mail/logo.jpg" alt="logo">
        </td>
    </tr>
';

$message .= $bodymail;

$message .='
</tbody></table>
<table style="background: #fff;margin: 10px auto;padding: 10px;border: 1px solid #ccc;width: 90%">
    <tbody><tr>
        <td colspan="3" style="text-align: center;padding: 10px 0">
            <span style="display: block;width: 240px;margin: 0 auto 10px auto;background: #00a4d7;line-height: 40px;color: #fff">
                <a href="http://'.$_SERVER['SERVER_NAME'].'" style="color: #fff;text-decoration: none">Go to PlusCard Website</a>
            </span>
            <span style="display: block;width: 240px;margin: 0 auto;background: #157593;line-height: 40px;color: #fff">
                <a href="http://'.$_SERVER['SERVER_NAME'].'/term_and_condition" style="color: #fff;text-decoration: none">View Terms and Condition</a>
            </span>
        </td>
    </tr>
</tbody></table>
<table style="background: #fff;margin: 10px auto;padding: 10px;border: 1px solid #ccc;width: 90%">
    <tbody><tr>
    </tr><tr style="text-align: center">
        <td valign="top" colspan="2">
            <a href="#">
                <img style="width: 120px" src="http://'.$_SERVER['SERVER_NAME'].'/assets/mail/pluscard.jpg" alt="..">
            </a>
        </td>
    </tr>
    <tr><td valign="top" style="font-size: 11px">
        PT. Mobile Coin Asia<br>
        Taman Gandaria Blok D-4<br>
        Jl. KH. M. Hadzami<br>
        Jakarta Selatan 12240<br>
    </td>
    <td valign="top" style="font-size: 11px;text-align: right">
        P / +62 21 722 8656<br>
        F / +62 21 727 89 280<br>
        E / info@gaps.co.id<br>
    </td>
    </tr>
    <tr style="font-size: 10px;text-align: center;">
        <td valign="top" colspan="2">
            <span style="line-height: 40px">
            ©2014 GAPS - PT Mobile Coin Asia
                </span>
        </td>
    </tr>
</tbody></table>
</body></html>';
		$this->email->message($message);	
		if($to['to']!=''){
			$this->email->send();		
			//echo $this->email->print_debugger();					
		}
	}	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */