<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cart extends MY_Controller {

	function __construct(){
		parent::__construct();
	}
	
	public function index()
	{
		$data['items'] = $this->session->userdata('cart');
		$data['content_view'] = 'cart/v_index';
		$this->load->view('layout/home_layout', $data);
	}
	
	public function add_item(){		
		$this->load->library('../controllers/login');
		
		$item = new stdClass;
		$item->itemId = $this->input->post('itemId');
		//$item->pengiriman = $this->input->post('pengiriman');
		$item->ukuran = $this->input->post('ukuran');
		$item->warna = $this->input->post('warna');
		$item->nama = $this->input->post('nama');
		$item->path = $this->input->post('path');
		$item->harga = $this->input->post('harga');
		$item->jumlah = $this->input->post('jumlah');		
														
		$item_on_cart = $this->session->userdata('cart');	
			
		$items = array();
		if($item_on_cart){
			foreach ($item_on_cart as $i){
				array_push($items, $i);
			}
		}
		array_push($items, $item);
		
		$this->login->update_session('cart', $items);
						
		echo count($items);
	}
	
	public function remove_item(){	    
		$this->load->library('../controllers/login');
		
		$itemId = $this->input->post('itemId');
		$item_on_cart = $this->session->userdata('cart');	
					
		$items = array();
		if($item_on_cart){
			foreach ($item_on_cart as $item){
			    if($item->itemId != $itemId){
				    array_push($items, $item);
			    }
			}
		}
		
		$this->login->update_session('cart', $items);
		
		
		echo count($items);
	}
	
	public function update_item(){
	    $this->load->library('../controllers/login');
	
	    $itemId = $this->input->post('itemId');
	    $quantity = $this->input->post('quantity');
	    $item_on_cart = $this->session->userdata('cart');
	    	
	    $items = array();
	    if($item_on_cart){
	        foreach ($item_on_cart as $item){
	            if($item->itemId == $itemId){
	                $item->jumlah = $quantity;
	            }
	            array_push($items, $item);
	        }
	    }
	
	    $this->login->update_session('cart', $items);
	
	
	    echo count($items);
	}	
	
	public function show_cart(){
		$this->load->library('../controllers/login');
		
		$item_on_cart = $this->session->userdata('login');	
			echo '<pre>';
		print_r($item_on_cart);die();
		$items = array();
		if($item_on_cart){
			foreach ($item_on_cart as $item){
				array_push($items, $item);
			}
		}
		array_push($items, $new_item);
		
		$this->login->update_session('cart', $items);
		
		
		echo count($items);
	}	
}
