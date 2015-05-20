<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sandbox extends CI_Controller {

	function __construct(){
		parent::__construct();
		ini_set('display_error', TRUE);
		error_reporting(E_ALL);
	}
	
	public function category_get_data()
	{
		$body =  file_get_contents('php://input');
		$string = '{companyCode:1001}';
		$data = json_decode($string);

		var_dump($data);
	}
	

}
