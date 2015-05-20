<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('user_model');
		$this->user_model->has_login();

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
		$b['content']	= $this->load->view('dashboard/vcontent',$c,TRUE);

		//load base view
		$this->load->view('vbase',$b);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */