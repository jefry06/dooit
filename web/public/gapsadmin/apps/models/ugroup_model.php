<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ugroup_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');
		$this->master_model->get_tables($this);

	}

	function get_ugroup()
	{
		$query = $this->db->get('ugroup');
		return $query->result_array();
	}
}