<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cms extends CI_Controller {

	function __construct(){
		parent::__construct();
	
	}
	
	public function company()
	{
		$this->show_response(200, array('companyCode' => '1002'));
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
}
