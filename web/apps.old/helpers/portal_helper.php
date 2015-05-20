<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('companyCode'))
{
	function companyCode()
	{
		$CI =& get_instance();		
		$company = $CI->session->userdata('company');	
		
		return $company['companyCode'];
	}
	
}
