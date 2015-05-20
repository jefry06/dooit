<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');

		// tabl
		$this->master_model->get_tables($this);
	}

	function get_user()
	{
		$page = $this->input->post('page') ? (int) $this->input->post('page') : 1;
		$rows = $this->input->post('rows') ? (int) $this->input->post('rows') : 20;
		$sort = $this->input->post('sort') ? $this->input->post('sort') : 'uid';
		$order = $this->input->post('order') ? $this->input->post('order') : 'asc';
		$offset = ($page-1)*$rows;

		$_sql_where = array();
		
		$keyword = $this->input->post('keyword') ? $this->input->post('keyword') : '';
		if( ! empty($keyword) ){
			$_sql_where[] = "
				(
					UCASE(username) LIKE '%".strtoupper($this->db->escape_str($keyword))."%' OR
					UCASE(nama) LIKE '%".strtoupper($this->db->escape_str($keyword))."%' OR
					UCASE(email) LIKE '%".strtoupper($this->db->escape_str($keyword))."%'
				)
			";
		}

		$sql_where = '';
		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);

		$sql = " 
				SELECT
				a.uid,
				a.username,
				a.nama,
				a.email,
				a.telpon,
				a.aktif				
				FROM
				{$this->user} a				
				{$sql_where} ";

		$query = $this->db->query($sql." ORDER BY $sort $order LIMIT $offset,$rows ");
		$ret['data'] = $query->result();
		return $ret;
	}

	function user_exists($str)
	{
		$str = $this->db->escape_str($str);
		$query = $this->db->query(" SELECT * FROM {$this->user} WHERE UCASE(username)=UCASE('$str') ");
		if($query->num_rows() > 0) return TRUE;
		else return FALSE;
	}

	function get_user_by_id($id)
	{
		/*$id = $this->db->escape_str($id);*/
		$query = $this->db->query(" SELECT uid,username,nama,email,telpon,aktif FROM {$this->user} WHERE uid='$id' ");
		return (OBJECT) $query->row();
	}

	function get_user_group($id)
	{
		/*$id = $this->db->escape_str($id);*/
		$query = $this->db->query(" SELECT * FROM {$this->user_group} WHERE uid='$id' ");
		return $query->result();
	}

	function insert_user($data)
	{
		/*$data = $this->master_model->escape_all($data);*/
		$this->db->insert($this->user, $data);
		return $this->db->affected_rows();
	}

	function update_user($data,$id)
	{
		/*$id = $this->db->escape_str($id);*/
		/*$data = $this->master_model->escape_all($data);*/
		$this->db->where('uid', $id);
		$this->db->update($this->user,$data);
		return $this->db->affected_rows();
	}

	function delete_user($id)
	{
		/*$id = $this->db->escape_str($id);*/
		$this->db->where('uid', $id);
		$this->db->delete($this->user);
		return $this->db->affected_rows();
	}

	function delete_user_group($id)
	{
		/*$id = $this->db->escape_str($id);*/
		$this->db->where('uid', $id);
		$this->db->delete($this->user_group);
		return $this->db->affected_rows();
	}

	function get_user_all()
	{
		$query = $this->db->query(" SELECT * FROM {$this->user} ORDER BY nama ASC ");
		return $query->result();
	}

	function get_user_select($init = array())
	{
		$tmp = array();
		if(is_array($init) AND count($init)>0) $tmp = $init;
		$res = $this->get_user_all();
		if(count($res)>0){
			foreach($res as $row){
				$tmp[$row->uid] = ucfirst($row->nama) . ' (' . $row->username . ')';
			}
		}
		return $tmp;
	}

	function get_user_controller($id='')
	{
		/*$id = $this->db->escape_str($id);*/
		$query = $this->db->query(" SELECT * FROM {$this->user_access} WHERE uid='$id' ");
		return $query->result();
	}

	function get_user_access($id)
	{
		$acc = array();
		/*$id = $this->db->escape_str($id);*/
		$sql=" SELECT a.uid, b.controller as access
				FROM
				{$this->user_access} a
				LEFT JOIN {$this->controller} b 
				ON a.controller_id = b.id 
				WHERE a.uid='$id' ";
		$query = $this->db->query($sql);
		$res = $query->result();
		if(count($res)>0){
			foreach($res as $row){
				$acc[$row->access] = $row->access;
			}
		}
		return $acc;
	}

	function get_user_menu($id, $ismenu=FALSE)
	{
		$acc = array();
		/*$id = $this->db->escape_str($id);*/

		$sql="
			SELECT
			a.uid,
			a.group_id,
			d.group_name,
			c.*
			FROM
			{$this->user_group} AS a
			LEFT JOIN {$this->controller} AS c ON a.group_id = c.group_id 
			LEFT JOIN {$this->ugroup} AS d ON a.group_id=d.id
			WHERE a.uid = {$id}
		";		

		if($ismenu)
		{
			$sql .=" AND c.is_menu=1 ORDER BY `order`,title";
		}

		$query = $this->db->query($sql);
		$res = $query->result();
		if(count($res)>0){
			foreach($res as $row){
				$acc[$row->group_id]['css'] =$row->cssicon;
				$acc[$row->group_id]['title']=$row->group_name;
				$acc[$row->group_id]['child'][$row->title] = $row->controller;
			}
		}		
		//print_r($acc);exit();
		return $acc;
	}

	function insert_user_access($data)
	{
		/*$data = $this->master_model->escape_all($data);*/
		$this->db->insert($this->user_access, $data);
		return $this->db->affected_rows();
	}

	function insert_user_group($data)
	{
		/*$data = $this->master_model->escape_all($data);*/
		$this->db->insert($this->user_group, $data);
		return $this->db->affected_rows();
	}

	function delete_user_access($id)
	{
		/*$id = $this->db->escape_str($id);*/
		$this->db->where('uid', $id);
		$this->db->delete($this->user_access);
		return $this->db->affected_rows();
	}

	function set_cb($field,$uid='')
	{
		if( $uid == '' ){
			$default = '';
		}else{
			$acc = $this->get_user_access($uid);
			if( isset($acc[$field]) ) $default = 'checked';
			else $default = '';
		}
		if($this->input->post()) $default = '';

		$access = $this->input->post('access');
		$ret = isset($access[$field]) ? 'checked' : $default;

		return $ret;
	}

	function do_login($u,$p)
	{
		$u = $this->db->escape_str($u);
		$p = $this->db->escape_str($p);
		$query = $this->db->query(" SELECT * FROM {$this->user} WHERE username='$u' AND password=md5('$p') AND aktif=1 ");
		if($query->num_rows()>0){
			$cu = $query->row();
			
			$data = array();
			$data['login_status'] = 1;
			$data['current_user'] = $cu->uid;
			$this->session->set_userdata($data);

			return true;
		}else{
			return false;
		}
	}

	function current_user()
	{
		if($username = $this->session->userdata('current_user'))
		{
			$CU = $this->get_user_by_id($username);
			return $CU;
		}
		else
		{
			return (object) array();
		}
	}

	function is_login()
	{
		if($this->session->userdata('login_status')==1) return TRUE;
		else return FALSE;
	}

	function has_login( $checkAccess = TRUE )
	{
		if($this->session->userdata('login_status')!=1)
		{
			$redirect = isset($_SERVER['REQUEST_URI']) ? base64_encode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) : '';
			$this->session->set_userdata('message','Anda harus login untuk masuk ke aplikasi. ');
			$this->session->set_userdata('message_type','error');
			//echo "masuk ke login status !=1";
			redirect(site_url('/log/in?redirect='.$redirect));
			die();
		}

		if( $checkAccess ) $this->has_access();
	}

	function has_access()
	{
		$default_controller = isset($this->router->routes['default_controller']) ? $this->router->routes['default_controller'] : 'dashboard';
		$default_method = 'index';

		$controller = $this->uri->segment(1, $default_controller);
		$action = $this->uri->segment(2, $default_method);

		$default_access = array(
			$default_controller => $default_controller,
			$default_controller.'/'.$default_method => $default_controller.'/'.$default_method,
			$controller.'/json'			=> $controller.'/json',
			//$controller.'/index'		=> $controller.'/index'
		);

		$CU 	= $this->current_user();
		$acc	= $this->get_user_access($CU->uid);
		$acc 	= array_merge($default_access, $acc);

		if( ! isset($acc[$controller.'/'.$action]) ){
			$this->session->set_userdata('message','Anda tidak diijinkan mengakses / melakukan aksi pada halaman yang anda tuju.<br><br>Silakan hubungi administrator.');
			$this->session->set_userdata('message_type','error');
			$ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : site_url();			
			redirect($ref);
			die();
		}
	}

	function logout()
	{
		$this->session->unset_userdata('login_status');
		$this->session->unset_userdata('current_user');
	
		$this->session->set_userdata('message','Anda telah keluar. ');
		$this->session->set_userdata('message_type','info');
		redirect(site_url('log/in'));
	}
}