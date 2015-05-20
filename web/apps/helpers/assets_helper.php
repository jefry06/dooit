<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('login_assets'))
{
	function login_assets($uri = '')
	{
		$CI =& get_instance();
		return $CI->config->item('login_asset_url');
	}
}

if ( ! function_exists('home_assets'))
{
	function home_assets($uri = '')
	{
		$CI =& get_instance();
		return $CI->config->item('home_asset_url');
	}
}

if ( ! function_exists('asset_header'))
{
	function asset_header()
	{
		$CI =& get_instance();
		$company = $CI->session->get_session('company');
		echo $company['companyAsset']['header'];
	}
}

if ( ! function_exists('asset_logo'))
{
	function asset_logo()
	{
		$CI =& get_instance();
		$company = $CI->session->get_session('company');
		echo $company['companyAsset']['logo'];
	}
}

if ( ! function_exists('asset_footer'))
{
	function asset_footer()
	{
		$CI =& get_instance();
		$company = $CI->session->get_session('company');
		echo $company['companyAsset']['footer'];
	}
}

if ( ! function_exists('asset_name'))
{
	function asset_name()
	{
		$CI =& get_instance();
		$company = $CI->session->get_session('company');
		echo strtoupper($company['companyAsset']['name']);
	}
}


