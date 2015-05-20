<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pin extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
	}
	
	public function index()
	{
		$data['message'] = 'Fasilitas dibawah ini diperlukan apabila Anda menginginkan untuk mengganti PIN Lama dangan yang baru. Pastikan PIN Mudah diingat untuk mempermudah transaksi Anda. Terimakasih';
		$data['userData'] = $this->session->get_session('login');
		$data['company'] = $this->session->get_session('company');		
		$data['content_view'] = 'pin/v_index';
		$this->load->view('layout/home_layout', $data);
	}

	public function update()
	{
		$this->validateForm();		
		if ($this->form_validation->run() == FALSE){
			/* if you want to put additional flow */
			$data['message'] = 'Lengkapilah Form untuk mengganti PIN';
		}else{
			$updatePin = $this->updatePin();
			$data['message'] = $updatePin->responseDescription;
		}
		
		$data['content_view'] = 'pin/v_index';
		$this->load->view('layout/home_layout', $data);
	}	
	
	private function validateForm()
	{
		$this->form_validation->set_rules('handphone', 'No. HP', 'required|numeric');
		$this->form_validation->set_rules('pin_lama', 'Pin Baru', 'required|min_length[6]|numeric');
		$this->form_validation->set_rules('pin_baru', 'Pin Lama', 'required|min_length[6]|numeric');
		$this->form_validation->set_rules('pin_baru_konf', 'Konfirmasi Pin', 'required|matches[pin_baru]');
	
		$this->form_validation->set_message('required', 'wajib diisi');
		$this->form_validation->set_message('numeric', 'harus angka');
		$this->form_validation->set_message('min_length', 'minimal 6 karakter angka/huruf');
		$this->form_validation->set_message('valid_email', 'harus alamat email yang valid');
		$this->form_validation->set_message('matches', 'harus sama dengan Pin');
	}	
	
	private function updatePin(){
		/* hit to api */
		$phone = $this->input->post('handphone');
		$lastPin = $this->input->post('pin_baru');
		$newPin = $this->input->post('pin_lama');
		
		$pinData = array(
				'accountId' => companyCode().$phone,
				'lastPin' => md5($lastPin),
				'newPin' => $newPin,
		);
		$result = $this->curl->simple_post($this->config->item('wallet_api') . 'updatePin', json_encode($pinData));
		return json_decode($result);		
	}
}
