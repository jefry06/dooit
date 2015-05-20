<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {

	function __construct(){
		parent::__construct();				
		/* get company code based on subdomain name */
		$companyName = $_SERVER['SERVER_NAME'];
		$cms_api = $this->curl->simple_post($this->config->item('cms_api') . 'getCompany', json_encode(array('companyName' => $companyName)));
		$response = json_decode($cms_api);
		$companyCode = $response->com_code;

		$companyData = array(
					'companyName' => $companyName,
					'companyCode' => $companyCode,					
					'companyAsset' => array(
						'header' => $response->com_asset_url.'/img/'.$response->com_img_header,
						'logo' => $response->com_asset_url.'/img/'.$response->com_logo,
						'footer' => $response->com_asset_url.'/'.$response->com_img_footer,
						'name' => $response->com_name
					),					
					'companyParam' => (array)$response				
				);
		$this->session->set_session('company', $companyData);	
	}
	
	public function index()
	{
		if($this->session->get_session('login')){
			redirect(base_url('home'), 'refresh');
		}				
		$data['content_view'] = 'login/v_index';
		$this->load->view('layout/login_layout', $data);
	}
	
	public function forgot_password(){
		$handphone = $this->input->post('handphone');
		$email = $this->input->post('email');
		
		$pinData = array(
					'accountId' => companyCode().$handphone,
					'noHp' => $handphone,
					'email' => $email
				);
		$process = $this->curl->simple_post($this->config->item('wallet_api') . 'forgetPin', json_encode($pinData));
		
		header('Content-type: application/json');
		echo $process;
		exit();
	}
	
	public function authenticate(){			
		$handphone_number = companyCode() . $this->input->post('nohp');
		$pin = $this->input->post('pin');
		
		if($handphone_number == "" || $pin == ""){
			$this->show_response(400, 'Login Gagal! No. Handphone atau PIN kosong.');
		}
		
		$loginData = array(
					"accountId" => $handphone_number,
					"pin" => md5($pin)
				);
		/* hit to api */
		$process = $this->curl->simple_post($this->config->item('wallet_api') . 'login', json_encode($loginData));
		if($process){		
			$result = json_decode($process);	
			if($result->responseCode == 200){
				$this->curl->clear();
				/* get user data account from api */				
				$user_data = $this->curl->simple_post($this->config->item('wallet_api') . 'dataAccount', json_encode(array('accountId' => $handphone_number)));
				$user_data_object = json_decode($user_data);
				$user_data_object->loginData = $loginData;	
				$this->session->set_session('cart', NULL);
				/* set user session */				
				$this->session->set_session('login', $user_data_object);
				$this->show_response(200, $result->responseDescription);													
			}else{
				$this->show_response(400, $result->responseDescription);
			}
		}else{
			$this->show_response(400, 'Koneksi ke server gagal.');
		}
		
	}
	
	public function logout(){
		@session_destroy();
		redirect(base_url(), 'refresh');
	}
	
	public function show_response($rc = 200, $message = array()){
		$response = array(
					'responseCode' => $rc,
					'description' => $message
				);

		header('Content-type: application/json');

		echo json_encode($response);
		exit();
	}
	
	public function update_session($session_name, $session_data){
		$this->session->set_userdata(array($session_name =>  $session_data));
	}	

	public function show_assets(){
		asset_header();
	}
}
