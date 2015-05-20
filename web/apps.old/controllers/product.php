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
		foreach($this->session->userdata('productCategory') as $cat){
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

		$data['productDetail'] = $productDetail;
		$data['content_view'] = 'product/v_detail';
		$this->load->view('layout/home_layout', $data);
	}	
	

	public function get_size($warna){ 
		$productDetail = $this->session->userdata('product_detail');
		$product_size = array();
		array_push($product_size, 'Pilih');
		foreach($productDetail->listDetailProduct as $detail){
			if(strtoupper($detail->warna) == strtoupper($warna)){
				array_push($product_size, array(
									'detailItemId' => $detail->detailItemId, 
									'size' => $detail->size
								)
							);
			}
		}
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
