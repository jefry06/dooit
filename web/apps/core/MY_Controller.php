<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	function __construct(){
		parent::__construct();	
		if(!$this->session->get_session('login')){
			redirect(base_url(), 'refresh');
		}
		
		$api = $this->curl->simple_post($this->config->item('ecommerce_api') . 'category/getData', json_encode(array('companyCode' => companyCode())));
		$productCategory = json_decode($api);
		$this->session->set_session('productCategory', $productCategory);
		
		$priorityId = '0'; //all
		$latest = $this->curl->simple_post($this->config->item('ecommerce_api') . 'product/getDataProductPriority', json_encode(array('companyCode' => companyCode(), 'priorityId' => $priorityId)));
		$latestProduct = json_decode($latest);
		$this->session->set_session('latestProduct', $latestProduct);
		
	}	
}
