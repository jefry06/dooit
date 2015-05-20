<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "setting" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/setting.html
|
*/
$config['roots_dir']    		=  '/mainSite/gaps/';   

$config['doc_root']				= ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$config['doc_root']				.= "://".$_SERVER['HTTP_HOST'];
$config['doc_root']				.= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

$config['host_']				= ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https:" : "http:").'//'.$_SERVER['HTTP_HOST']."/";

$config['image_dir']            = $config['roots_dir'] . 'img/';
$config['files_dir']            = $config['roots_dir'] . 'files/';
$config['asset_path']            = $config['roots_dir'] . 'assets/';

$config['images_data']			= $config['doc_root'] . 'images-data/';
$config['files_data']           = $config['doc_root'] . 'files-data/';

$config['template_uri']			= $config['doc_root'] .'assets/';
$config['images_uri']			= $config['doc_root'] .'assets/img/';
$config['asset_uri']           = $config['doc_root'] .'assets/';
$config['app_cache']           = $config['doc_root'] .'cache/';

$config['mail_protocol']           = "sendmail";
$config['mail_mailpath']           = "/usr/sbin/sendmail";
$config['mail_smtp_host']          = "";
$config['mail_smtp_user']          = "";
$config['mail_smtp_pass']          = "";
$config['mail_smtp_port']          = "25";

/* End of file setting.php */
/* Location: ./application/config/setting.php */