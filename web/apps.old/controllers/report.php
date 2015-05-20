<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class report extends MY_Controller {

	function __construct(){
		parent::__construct();
	}
	
	public function index()
	{
	    $userData = $this->session->userdata('login');	    
	    $transaction_api = $this->curl->simple_post($this->config->item('cms_api') . 'getorderheader', json_encode(array('user_id' => $userData->loginData['accountId'])));
	    $data['transactions'] = json_decode($transaction_api);
		$data['content_view'] = 'report/v_index';
		$this->load->view('layout/home_layout', $data);
	}
	
	public function detail($order_code)
	{
	    $userData = $this->session->userdata('login');
	    $transaction_detail_api = $this->curl->simple_post($this->config->item('cms_api') . 'getdetailorder', json_encode(array('order_code' => $order_code)));
	    $data['transaction'] = json_decode($transaction_detail_api);
	    $data['content_view'] = 'report/v_detail';
	    $this->load->view('layout/home_layout', $data);
	}
}
