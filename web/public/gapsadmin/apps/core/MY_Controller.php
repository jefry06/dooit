<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	protected $data = array();

        function __construct($isPublic=false)
        {
        parent::__construct();
		$this->load->library('session');
    	        if (!$this->session->userdata('username') && strpos($_SERVER['REQUEST_URI'],'/api/')===false ){
		redirect('login');
	        }else{
	        $this->load->model('Usersmodel', 'user');
	        $user_id = $this->session->userdata('userid');
	        $parsedata['userpermission'] = $this->user->menu_permission($user_id);
	                if($this->session->userdata('type') == 2){
	                        if(count($parsedata['userpermission']) <= 0){
	                        redirect('userpermission');
	                        }
	                }
	        }
        }
}