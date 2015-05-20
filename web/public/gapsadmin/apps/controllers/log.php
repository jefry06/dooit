<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class log extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('master_model');
		$this->load->model('user_model');
		
		$this->CU = $this->user_model->current_user();
	}

	function in()
	{

		// error_reporting(E_ALL);
		if(is_array($this->CU) AND count($this->CU)>0){
			redirect(site_url());
			die();
		}
		
		$this->form_validation->set_rules('username', 'Username', 'trim|required|callback_login_check');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_message('required','%s tidak boleh kosong.');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('login/vpage_login');
		}
		else
		{
			$redirect = $this->input->post('redirect');
			if( ! empty($redirect) ) redirect(base64_decode($redirect));
			else redirect(site_url());
		}
	}

	function out()
	{
		$this->user_model->logout();
	}

	function login_check()
	{
		if ( ! $this->user_model->do_login($this->input->post('username'),$this->input->post('password')))
		{
			$this->form_validation->set_message('login_check', 'Username dan password tidak cocok.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}