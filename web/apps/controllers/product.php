<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class product extends MY_Controller {

	function __construct(){
		parent::__construct();
	}
	
	public function index()
	{
	
		$data['content_view'] = 'product/v_detail';
		$this->load->view('layout/home_layout', $data);
	}
	
	public function category($groupId)
	{
		$productList = NULL;
		foreach($this->session->get_session('productCategory') as $cat){
			if($cat->categoryId == $groupId){
				$productList = $cat->listProductGroup;
			}
		}		
		$data['productList'] = $productList;
		$data['content_view'] = 'product/v_product_category_list';
		$this->load->view('layout/home_layout', $data);
	}
	
	public function group($groupId)
	{
		$api = $this->curl->simple_post($this->config->item('ecommerce_api') . 'product/getDataProductItemByGroup', json_encode(array('companyCode' => companyCode(), 'productGroupId' => $groupId)));
		$productList = json_decode($api);
		$data['productList'] = $productList;
		$data['content_view'] = 'product/v_product_list';
		$this->load->view('layout/home_layout', $data);
	}	
	
	public function detail($itemId)
	{
		$api = $this->curl->simple_post($this->config->item('ecommerce_api') . 'product/getDataDetailItemProduct', json_encode(array('companyCode' => companyCode(), 'itemId' => $itemId)));
		$productDetail = json_decode($api);		
		$this->session->set_session('productDetail', $productDetail);
		$data['itemId']		=$itemId;
		$data['productDetail'] = $productDetail;
		$data['content_view'] = 'product/v_detail';
		$this->load->view('layout/home_layout', $data);
	}	
	

	public function get_size(){ 
		$warna = $this->input->post('warna');
		$productDetail = $this->session->get_session('productDetail');
		
		$product_size = array();
		foreach($productDetail->listDetailProduct as $detail){
			//if(strtoupper($detail->warna) == strtoupper($warna)){
				array_push($product_size, array(
									'detailItemId' => $detail->detailItemId, 
									'size' => $detail->size
								)
							);
			//}
		}
		echo json_encode($product_size);
	}
	
	public function get_quantity(){
		$size = $this->input->post('size');
		$warna = $this->input->post('warna');
		
		$productDetail = $this->session->get_session('productDetail');
	
		$product_quantity = array();
		foreach($productDetail->listDetailProduct as $detail){
			//if(strtoupper($detail->warna) == strtoupper($warna) && strtoupper($detail->size) == strtoupper($size)){
					array_push($product_quantity, array(
						'detailItemId' => $detail->detailItemId,
						'quantity' => $detail->unit
					)
				);
			//}
		}
		echo json_encode($product_quantity);
	}	

	public function search()
	{
		$keyword = $this->input->post('keyword');
		$api = $this->curl->simple_post($this->config->item('ecommerce_api') . 'product/getDataProductItemBySearch', json_encode(array('companyCode' => companyCode(), 'search' => $keyword)));
		$productList = json_decode($api);
		$data['productList'] = $productList;
		$data['content_view'] = 'product/v_product_list';
		$this->load->view('layout/home_layout', $data);
	}	
	
	public function sort_by($priorityId)
	{
		$api = $this->curl->simple_post($this->config->item('ecommerce_api') . 'product/getDataProductPriority', json_encode(array('companyCode' => companyCode(), 'priorityId' => $priorityId)));
		$productList = json_decode($api);
		$data['productList'] = $productList;
		$data['content_view'] = 'product/v_product_list';
		$this->load->view('layout/home_layout', $data);
	}			
}
