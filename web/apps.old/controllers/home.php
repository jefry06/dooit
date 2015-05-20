<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends MY_Controller {

	function __construct(){
		parent::__construct();
	}
	
	public function index()
	{
		$data['content_view'] = 'home/v_index';
		$this->load->view('layout/home_layout', $data);
	}
	
	/* for syarat dan ketentuan and privacy page*/

	public function term_and_condition(){
		$data['content_view'] = 'home/v_toc';
		$this->load->view('layout/home_layout', $data);		
	}

	public function privacy(){
		$data['content_view'] = 'home/v_privacy';
		$this->load->view('layout/home_layout', $data);		
	}
}
