<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	function __construct()
	{
		parent::__construct();

	}

	public function index()
	{
		redirect(site_url());
	}

	function getcompany($companyName="")
	{
		$result=array();
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$data = json_decode(file_get_contents('php://input'), TRUE);
			//print_r($data);exit();
			
			if(isset($data['companyName']))
			{
				$comname=$data['companyName'];	
				//$comname=$_GET['companyName'];
				$this->load->model('portal_model');
				$result=$this->portal_model->get_by_name($comname);		
				
				if(isset($result->com_id))
				{
						$param =$this->portal_model->get_param_by_id($result->com_id);						
						$result = array_merge((array) $result, array('style'=> (array)$param) );
				}		
			}

		}else{
			redirect(site_url());
		}
		print_r(json_encode($result));
		return json_encode($result);

	}

	function submitpayment($data="")
	{
		$result = array("responseCode"=>"201","responseDescription"=>"insert gagal");
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$this->load->model('order_model');		
			$data = json_decode(file_get_contents('php://input'), TRUE);
			
			$header['order_code']= $data['order_code'];
			$header['user_id'] = $data['user_id'];
			$header['order_total'] = $data['order_total'];
			$header['order_date'] = $data['order_date'];
			$header['create_at'] = date("Y-m-d H:i:s");
			if($this->order_model->insert_($header))
			{
				$delivery['order_code'] =$data['order_code'];
				$delivery['user_id'] =$data['user_id'];
				$delivery['delivery_nama'] =$data['delivery_nama'];
				$delivery['delivery_email'] =$data['delivery_email'];
				$delivery['delivery_tlp'] =$data['delivery_tlp'];
				$delivery['delivery_tipe'] =$data['delivery_tipe'];
				$delivery['delivery_alamat'] =$data['delivery_alamat'];
				$delivery['delivery_kota'] =$data['delivery_kota'];
				$delivery['delivery_kodepos'] =$data['delivery_kodepos'];
				$delivery['delivery_rt'] =$data['delivery_rt'];
				$delivery['delivery_rw'] =$data['delivery_rw'];
				$delivery['delivery_by'] =$data['delivery_by'];
				$delivery['delivery_ket'] =$data['delivery_ket'];
				$delivery['create_at'] =date("Y-m-d H:i:s");
				$this->order_model->insert_delivery_($delivery);

				$history['user_id'] = $data['user_id'];
				$history['order_code'] = $data['order_code'];
				$history['history_date'] = $data['order_date'];
				$history['history_status'] = "Pending";
				$history['history_desc'] = "Transaksi dalam proses verifikasi";
				$history['create_at'] = date("Y-m-d H:i:s");
				$this->order_model->insert_history_($history);
				
				foreach ($data['detail'] as $key ) {
					# code...
					$detail['order_code'] = $data['order_code'];
					$detail['com_code']	= $key['com_code'];					
					$detail['item_id']	= $key['item_id'];
					$detail['item_name']	= $key['item_name'];
					$detail['item_price']	= $key['item_price'];
					$detail['item_desc']	= $key['item_desc'];
					$detail['item_img']	= $key['item_img'];
					$detail['item_size']	= $key['item_size'];										
					$detail['item_color']	= $key['item_color'];
					$detail['item_disc']	= $key['item_disc'];
					$detail['item_qty']	= $key['item_qty'];
					$detail['item_subtotal']	= $key['item_subtotal'];
					$detail['create_at']	= date("Y-m-d H:i:s");
					$this->order_model->insert_detail_($detail);
				}
				
				//sending mail to user;
				$to['to']=$data['delivery_email'];
				$subject ="Status pesanan : ".$data['order_code'];
				$message = $this->setmailtosendtrx($data);				
				$this->sendemail($to,$subject,$message);

				$result = array("responseCode"=>"200","responseDescription"=>"insert berhasil");
			}
			//print_r($header);exit();
		}
		
		print_r(json_encode($result));
		return json_encode($result);
	}

	function gethistory($userid="")
	{

		$result=array();
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$this->load->model('order_model');	
			$data = json_decode(file_get_contents('php://input'), TRUE);
			if(isset($data['user_id']))
			{

				$result=$this->order_model->get_history_by_id($data['user_id']);
			}
		}
		print_r(json_encode($result));
		return json_encode($result);

	}

	function getorderheader($userid="")
	{

		$result=array();
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$this->load->model('order_model');	
			$data = json_decode(file_get_contents('php://input'), TRUE);
			if(isset($data['user_id']))
			{

				$result=$this->order_model->get_by_userid($data['user_id']);
			}
		}
		print_r(json_encode($result));
		return json_encode($result);

	}

	function getdetailorder($ordercode="")
	{
		$result=array();
		if($_SERVER['REQUEST_METHOD']=='POST')
		{

			$this->load->model('order_model');	
			$data = json_decode(file_get_contents('php://input'), TRUE);			
			
			if(isset($data['order_code']))
			{

				$result1=$this->order_model->get_by_id($data['order_code']);
				$result2=$this->order_model->get_detail_by_id($data['order_code']);
				$result3=$this->order_model->get_delivery_by_id($data['order_code']);
				$result = array_merge( (array) $result1, (array) $result3, array("detail"=> (array) $result2) );
			}

		}
		print_r(json_encode($result));
		return json_encode($result);		
	}

	function setmailtosendtrx($data)
	{


		$bodymail='
		    <tr>
		        <td colspan="3" style="text-align: center">
		            <h3>Order placed!</h3>
		            <span style="text-align: center;font-size: 12px;">
		            Hi there, your order has been placed and
					we will ship it to you within 1-3 working
					days. Thank you for using PlusCard.
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