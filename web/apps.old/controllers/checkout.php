<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class checkout extends MY_Controller {

	function __construct(){
		parent::__construct();
	}
	
	public function index()
	{	
	    $items_on_cart = $this->session->userdata('cart');
	    $total_transaksi = 0;
	    $total_quantity = 0;
	    foreach ($items_on_cart as $item){
	       $total_transaksi += ($item->harga * $item->jumlah);
	       $total_quantity += $item->jumlah;
	    }
	    
	    $data['transaksi'] = array(
	        'path' => $items_on_cart[0]->path,
	        'nama' => $items_on_cart[0]->nama,
	        'total_transaksi' => $total_transaksi,
	        'total_quantity' => $total_quantity
	    );
	    
		$data['content_view'] = 'checkout/v_index';
		$this->load->view('layout/home_layout', $data);
	}
	
	public function process()
	{	   
	    /* get all transaction */
	    $items_on_cart = $this->session->userdata('cart');
	    $total_transaksi = 0;
	    $total_quantity = 0;
	    $detailTransaction = array();
	    foreach ($items_on_cart as $item){
	        $total_transaksi += ($item->harga * $item->jumlah);
	        $total_quantity += $item->jumlah;
	        array_push($detailTransaction, array(
	           'detailItemId' => $item->itemId,
	           'unit' => $item->jumlah
	        ));
	    }
	    
	    /* do inquiry */
	    $userData = $this->session->userdata('login');
	    $dataInquiry = array(
	        'accountId' => $userData->loginData['accountId'],
	        'amountNominal' => $total_transaksi
	    );	    
	    $inqueryTrxJson = $this->curl->simple_post($this->config->item('wallet_api') . 'cek', json_encode($dataInquiry));
	    $inqueryTrx = json_decode($inqueryTrxJson);
	    /* if inquiry success, continue to payment */
	    if($inqueryTrx->responseCode == 200){
	        $trxCode= $this->getTransactionCode($userData->loginData['accountId']);
	        $dataPayment = array(
	            'accountId' => $userData->loginData['accountId'],
	            'amount' => $total_transaksi,
	            'transCode' => $trxCode,
	            'pin' => md5($this->input->post('pin_submit')), //$userData->loginData['pin'],
	            'detailTransaction' => $detailTransaction
	        );	        
	        $pay_transaction_json = $this->curl->simple_post($this->config->item('wallet_api') . 'pay', json_encode($dataPayment));
			$pay_transaction = json_decode($pay_transaction_json);
	        $data['message'] = $pay_transaction->responseDescription;
	        if($pay_transaction->responseCode == 200){
	            /* get parameter */
	            $dataPengiriman = array(
	                'nama' => $this->input->post('nama'),
	                'email' => $this->input->post('email'),
	                'handphone' => $this->input->post('handphone'),
	                'type_alamat' => $this->input->post('type_alamat'),
	                'alamat' => $this->input->post('alamat'),
	                'rt' => $this->input->post('rt'),
	                'rw' => $this->input->post('rw'),
	                'kota' => $this->input->post('kota'),
	                'kodepos' => $this->input->post('kodepos'),
	                'keterangan' => $this->input->post('keterangan'),
	                'pengiriman' => $this->input->post('pengiriman')
	            );
	            /* construct data then post to cms */
	            $detailTransactionToCms = array();
	            foreach ($items_on_cart as $item){
	               $detail = array(
	                   'com_code' => companyCode(),
	                   'item_id' => $item->itemId,
	                   'item_name' => $item->nama,
	                   'item_price' => $item->harga,
	                   'item_img' => $item->path,
	                   'item_size' => $item->ukuran,
	                   'item_color' => $item->warna,
	                   'item_desc' => null,
	                   'item_disc' => 0,
	                   'item_qty' => $item->jumlah,
	                   'item_subtotal' => ($item->jumlah*$item->harga)
	               );  
	               array_push($detailTransactionToCms, $detail);
	            }
	            
	            $dataCMS = array(
	                'order_code' => $trxCode,
	                'user_id' => $userData->loginData['accountId'],
	                'order_total' => $total_transaksi,
	                'order_date' => date('Y-m-d H:i:s'),
	                'delivery_nama' => $dataPengiriman['nama'],
	                'delivery_email' => $dataPengiriman['email'],
	                'delivery_tlp' => $dataPengiriman['handphone'],
	                'delivery_tipe' => $dataPengiriman['type_alamat'],
	                'delivery_alamat' => $dataPengiriman['alamat'],
					'delivery_kota' => $dataPengiriman['kota'],
	                'delivery_kodepos' => $dataPengiriman['kodepos'],
	                'delivery_rt' => $dataPengiriman['rt'],
	                'delivery_rw' => $dataPengiriman['rw'],
	                'delivery_ket' => $dataPengiriman['keterangan'],
	                'delivery_by' => $dataPengiriman['pengiriman'],
	                'detail' => $detailTransactionToCms
	            );
				/* post to cms */
	            $pay_transaction = $this->curl->simple_post($this->config->item('cms_api') . 'submitpayment', json_encode($dataCMS));

				/* update nominal session */
				$this->updateNominalSession();
                $data['transaction'] = $dataCMS;
                $data['totalTransaction'] = $total_transaksi;
                $data['totalQuantity'] = $total_quantity;	            
	            $data['content_view'] = 'checkout/v_success';
	        }else{	            
				$data['message'] = $pay_transaction->responseDescription;
	            $data['content_view'] = 'checkout/v_failed';
	        }
	        
	    }else{
	        $data['message'] = $inqueryTrx->responseDescription;
	        $data['content_view'] = 'checkout/v_failed';
	    }
	    		
		$this->load->view('layout/home_layout', $data);
	}	
	
	public function validatePin(){
		$pin = $this->input->post('pin');
		$userData = $this->session->userdata('login');

		if(md5($pin) == $userData->loginData['pin']){
			$result = 'valid';
			$code = 200;
		}else{
			$result = 'invalid';
			$code = 403;
		}

		header($result, true, $code);
		echo $result;
	}

	private function getTransactionCode($accountId){
	    $time = date('yHmids');
        $stan = substr($accountId, 0, 4).substr($accountId, -4, 4).$time;	    
	    return substr($stan, 0, 19);
	}

	private function updateNominalSession(){
		$this->load->library('../controllers/login');
		
		$userData = $this->session->userdata('login');
		$accountId = $userData->loginData['accountId'];

		$user_data_json = $this->curl->simple_post($this->config->item('wallet_api') . 'dataAccount', json_encode(array('accountId' => $accountId)));

		$newUserData = json_decode($user_data_json);
		$userData->amountNominal = $newUserData->amountNominal;

		$this->session->set_userdata($userData);
		$this->login->update_session('login', $userData);

		/* remove session cart */
		$this->login->update_session('cart', array());

	}

}
