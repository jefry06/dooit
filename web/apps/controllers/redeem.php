<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class redeem extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	}
	
	public function index()
	{
		$data['voucher'] = array(
					'code' => $this->input->post('codepluscard')
				);	
		$data['content_view'] = 'redeem/v_index';
		$this->load->view('layout/login_layout', $data);
	}
		
	public function process()
	{		
		$this->validateForm();
		
		$codeVoucher = $this->input->post('novoucher');	
		if($codeVoucher == NULL){
			redirect(base_url(), 'refresh');
		}
								
		if ($this->form_validation->run() == FALSE){
			$data['voucher'] = array(
					'code' => $codeVoucher
			);			
			$data['content_view'] = 'redeem/v_index';
		}else{
			$data['data'] = array(
						'email' => $this->input->post('email'),
						'phone' => $this->input->post('phone'),
						'pin' => $this->input->post('pin')
					);
			$data['process'] = $this->createNewAccount();			
			$data['content_view'] = 'redeem/v_success';
		}		

		$this->load->view('layout/login_layout', $data);
	}	
	
	private function validateForm()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('phone', 'No. Handphone', 'required|numeric');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('pin', 'Pin', 'required|min_length[6]');
		$this->form_validation->set_rules('pin2', 'Konfirmasi Pin', 'required|matches[pin]');

		$this->form_validation->set_message('required', 'wajib diisi');
		$this->form_validation->set_message('numeric', 'harus angka');
		$this->form_validation->set_message('min_length', 'minimal 6 karakter angka/huruf');
		$this->form_validation->set_message('valid_email', 'harus alamat email yang valid');
		$this->form_validation->set_message('matches', 'harus sama dengan Pin');
	}	
	
	private function createNewAccount()
	{
		/* hit to api */
		$codeVoucher = $this->input->post('novoucher');
		$nama = $this->input->post('nama');
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$pin = $this->input->post('pin');
		$pin2 = $this->input->post('pin2');
		
		$address = $this->input->post('address');
		$city = $this->input->post('city');
		$zipCode = $this->input->post('zip_code');

		$companyId = substr($codeVoucher, 0, 4); //asumsi
		$accountData = array(
				'accountId' => $companyId.$phone,
				'fullName' => $nama,
				'noHp' => $phone,
				'pin' => $pin,
				'address' => $address,
				'city' => $city,
				'zipCode' => $zipCode,
				'companyId' => $companyId,
				'email' => $email,
				'codeVoucher' => $codeVoucher
		);	
		$newAccount = $this->curl->simple_post($this->config->item('wallet_api') . 'createAccount', json_encode($accountData));
		return json_decode($newAccount);
	}
}
