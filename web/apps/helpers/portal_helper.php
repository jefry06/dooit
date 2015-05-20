<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('companyCode'))
{
	function companyCode()
	{
		$CI =& get_instance();		
		$company = $CI->session->get_session('company');	
		
		return $company['companyCode'];
	}
	
}
