<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cart extends MY_Controller {

	function __construct(){
		parent::__construct();
	}
	
	public function index()
	{
		$data['items'] = $this->session->get_session('cart');	
		$data['content_view'] = 'cart/v_index';
		$this->load->view('layout/home_layout', $data);
	}
	
	public function add_item(){				
		$item = new stdClass;
		$item->itemId = $this->input->post('itemId');
		$item->detailItemId = $this->input->post('detailItemId');
		//$item->pengiriman = $this->input->post('pengiriman');
		$item->ukuran = $this->input->post('ukuran');
		$item->warna = $this->input->post('warna');
		$item->nama = $this->input->post('nama');
		$item->path = $this->input->post('path');
		$item->harga = $this->input->post('harga');
		$item->jumlah = $this->input->post('jumlah');		
														
		$item_on_cart = $this->session->get_session('cart');	
			
		$items = array();
		if($item_on_cart){
			foreach ($item_on_cart as $i){
				array_push($items, $i);
			}
		}
		/*maximum 3 jenis item*/
		if(count($items) < 5){
			array_push($items, $item);
		}		
		$this->session->set_session('cart', $items);
						
		echo count($items);
	}
	
	public function remove_item(){	    		
		$itemId = $this->input->post('itemId');
		$item_on_cart = $this->session->get_session('cart');	
					
		$items = array();
		if($item_on_cart){
			foreach ($item_on_cart as $item){
			    if($item->itemId != $itemId){
				    array_push($items, $item);
			    }
			}
		}
		
		$this->session->set_session('cart', $items);
		
		
		echo count($items);
	}
	
	public function update_item(){	
	    $itemId = $this->input->post('itemId');
	    $quantity = $this->input->post('quantity');
	    $item_on_cart = $this->session->get_session('cart');
	    	
	    $items = array();
	    if($item_on_cart){
	        foreach ($item_on_cart as $item){
	            if($item->itemId == $itemId){
	                $item->jumlah = $quantity;
	            }
	            array_push($items, $item);
	        }
	    }
	
	    $this->session->set_session('cart', $items);
	
	
	    echo count($items);
	}	
	
	public function show_cart(){
		$this->session->get_all_session();
	}
}
