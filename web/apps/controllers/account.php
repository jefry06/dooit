<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class account extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	}
	
	public function index()
	{
		$data['message'] = 'Informasi dibawah ini adalah data akun Anda yang sudah aktif. Jika Anda ingin memperbarui silahkan edit Form dibawah ini lalu tekan button Update. Terimakasih';
		$data['userData'] = $this->session->get_session('login');
		$data['company'] = $this->session->get_session('company');		
		$data['content_view'] = 'account/v_index';
		$this->load->view('layout/home_layout', $data);
	}
	
	public function update()
	{
		$this->validateForm();
		if ($this->form_validation->run() == FALSE){
			/* if you want to put additional flow */
			$data['message'] = 'Lengkapilah Form untuk mengganti Data';
		}else{
			$updateAccount = $this->updateAccount();
			$data['message'] = $updateAccount->responseDescription;
		}
	
		$data['content_view'] = 'account/v_index';
		$this->load->view('layout/home_layout', $data);
	}
	
	public function redeem()
	{						
		$data['message'] = 'Fasiltas dibawah ini diperlukan apabila Anda ingin menambah saldo Anda, dengan cara masukan kode baru dibelang Gift Card Anda, lalu tekan Reedem. Nilai yang tertera di gift card Anda akan otomatis masuk ke dalam saldo Anda. Terimakasih';
		$userData = $this->session->get_session('login');
		if($this->input->post('voucher') != NULL){
			$dataVoucher = array(
					'accountId' => $userData->loginData['accountId'],
					'code' => str_replace('-', '', $this->input->post('voucher')),
					'pin' => $userData->loginData['pin'],
				);	
			$redeem_voucher = $this->curl->simple_post($this->config->item('wallet_api') . 'redeem', json_encode($dataVoucher));
			$result = json_decode($redeem_voucher);
			$data['message'] = $result->responseDescription;
			if($result->responseCode == 200){
				$userData->amountNominal = $result->amountNominal;
				$this->session->set_session('login', $userData);
			}
		}
		$data['content_view'] = 'account/v_card';
		$this->load->view('layout/home_layout', $data);
	}
		
	private function validateForm()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('pin', 'PIN', 'required|numeric');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('handphone', 'No. HP', 'required|numeric');
	
		$this->form_validation->set_message('required', 'wajib diisi');
		$this->form_validation->set_message('numeric', 'harus angka');
		$this->form_validation->set_message('min_length', 'minimal 6 karakter angka/huruf');
		$this->form_validation->set_message('valid_email', 'harus alamat email yang valid');
		$this->form_validation->set_message('matches', 'harus sama dengan Pin');
	}
	
	private function updateAccount(){
		/* hit to api */
		$name = $this->input->post('nama');
		$pin = $this->input->post('pin');
		$email = $this->input->post('email');
		$phone = $this->input->post('handphone');
		$address = $this->input->post('alamat');
		$city = $this->input->post('city');
		$zipCode = $this->input->post('zip_code');
	
		$accountData = array(
				'accountId' => companyCode().$phone,
				'fullName' => $name,
				'phone' => $phone,
				'pin' => $pin,
				'address' => $address,
				'city' => $city,
				'zipCode' => $zipCode,
				'companyId' => companyCode(),
				'email' => $email				
		);
		$result = $this->curl->simple_post($this->config->item('wallet_api') . 'updateAccount', json_encode($accountData));
		return json_decode($result);
	}
}
