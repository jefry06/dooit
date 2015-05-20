<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_model extends CI_Model
{
	function __construct(){
		parent::__construct();
		
		$this->tables = array(
					'company' 		=> 'company',
					'company_param' => 'company_param',
					'controller' 	=> 'controller',
					'order_delivery' => 'order_delivery',
					'order_detail' 	=> 'order_detail',
					'order_header' 	=> 'order_header',
					'order_history' => 'order_history',
					'slide' 		=> 'slide',
					'ugroup' 		=> 'ugroup',
					'user' 			=> 'user',
					'user_access' 	=> 'user_access',
					'user_group' 	=> 'user_group'
		);

		/* initialize table name for this class */
		$this->get_tables($this);
	}

	/**
	 * Define table name for universal model
	 */

	function get_tables($class)
	{
		if(count($this->tables)>0){
			foreach($this->tables as $key=>$t){
				$class->{$key} = $this->db->dbprefix($t);
			}
		}
	}

	/**
	 * Escaping several data in a time
	 *
	 */

	function escape_all($data)
	{
		if( ! is_array($data) ) return $this->db->escape_str($data);

		$tmp = array();
		if(count($data) > 0){
			foreach($data as $key => $val){
				$tmp[$key] = $this->db->escape_str($val);
			}
		}
		return $tmp;
	}


}