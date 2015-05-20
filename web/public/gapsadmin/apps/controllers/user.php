<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');		
		$this->user_model->has_login();
		$this->load->model('ugroup_model');
		$this->load->model('control_model');
	}
	
	function index()
	{
		// error_reporting(E_ALL);
		$c['page_title']	= "User List";

		$CU      	 		= $this->user_model->current_user();		
		$nama    	 		= isset($CU->nama) ? $CU->nama : 'Guest';

		// load header
		$h['CU']      		= $CU;
		$h['nama']    		= $nama;
		$b['header'] 		= $this->load->view('template/vheader',$h,TRUE);

		//load navigation
		$n['ACCESS_MENU']	= $this->user_model->get_user_menu($CU->uid,TRUE);						
		$b['navigation']	= $this->load->view('template/vnavigation',$n,TRUE);

		//load Content
		$c['CU']      		= $CU;
		$c['nama']    		= $nama;
		$b['content']	= $this->load->view('user/vlist',$c,TRUE);

		//load base view
		$this->load->view('vbase',$b);

	}

	public function json()
	{		
		$result=$this->user_model->get_user();
		print_r( json_encode($result));
	}

	function add()
	{
		$CU      	 = $this->user_model->current_user();		
		$nama    	 = isset($CU->nama) ? $CU->nama : 'Guest';

		$this->validation();
		if ($this->form_validation->run() == FALSE)
		{
			$c['page_title']	= "New user";

			$CU      	 		= $this->user_model->current_user();		
			$nama    	 		= isset($CU->nama) ? $CU->nama : 'Guest';

			// load header
			$h['CU']      		= $CU;
			$h['nama']    		= $nama;
			$b['header'] 		= $this->load->view('template/vheader',$h,TRUE);

			//load navigation
			$n['ACCESS_MENU']	= $this->user_model->get_user_menu($CU->uid,TRUE);						
			$b['navigation']	= $this->load->view('template/vnavigation',$n,TRUE);

			//load Content
			$c['CU']      		= $CU;
			$c['nama']    		= $nama;
			$c['EDIT'] 		= new stdClass();
			$c['USER_GROUP']	= "";
			$c['USER_CONTROL']	= "";
			$c['ugroup'] 	= $this->ugroup_model->get_ugroup();
			//$c['controller'] =  $this->control_model->get_control();
			$b['content']	= $this->load->view('user/vform',$c,TRUE);

			//print_r($O['controller']);exit();
			$this->load->view('vbase',$b);

		}else{
			if($_SERVER['REQUEST_METHOD']=='POST'){
				//print_r($_POST);exit();
				$data['username']	= $this->input->post('username');
				$data['password']	= md5($this->input->post('password'));
				$data['nama']		= $this->input->post('nama');
				$data['email']		= $this->input->post('email');
				$data['telpon']		= $this->input->post('telpon');
				$data['aktif']		= $this->input->post('aktif');
				//$data['group_id']	= $this->input->post('group_id');
				//$access				= $this->input->post('access');
				$group 				= $this->input->post('group_id');

				if($this->user_model->insert_user($data)){
					// $UID = $this->db->insert_id();

					// if($group AND is_array($group)){
					// 	foreach($group as $group){
					// 		$d = array();
					// 		$d['uid'] = $UID;
					// 		$d['group_id'] = $group;							
					// 		$this->user_model->insert_user_group($d);
					// 	}
					// }

					// if($access AND is_array($access)){
					// 	foreach($access as $key){
					// 		$d = array();
					// 		$d['uid'] = $UID;
					// 		$d['controller_id'] = $key;							
					// 		$this->user_model->insert_user_access($d);
					// 	}
					// }													
					$this->session->set_userdata('message','Data telah tersimpan.');
					$this->session->set_userdata('message_type','success');					
				}
				else
				{
					$this->session->set_userdata('message','kesalahan, data tidak tersimpan.');
					$this->session->set_userdata('message_type','error');						
				}			
			}
			redirect(site_url('user/index'));
		}
	}

	function edit($id='')
	{

		$CU      	 = $this->user_model->current_user();		
		$nama    	 = isset($CU->nama) ? $CU->nama : 'Guest';

		$id = $this->uri->segment(3);

		$this->validation("EDIT");
		if ($this->form_validation->run() == FALSE)
		{
		
			$c['page_title']	= "Edit user";
			$CU      	 		= $this->user_model->current_user();		
			$nama    	 		= isset($CU->nama) ? $CU->nama : 'Guest';

			// load header
			$h['CU']      		= $CU;
			$h['nama']    		= $nama;
			$b['header'] 		= $this->load->view('template/vheader',$h,TRUE);

			//load navigation
			$n['ACCESS_MENU']	= $this->user_model->get_user_menu($CU->uid,TRUE);						
			$b['navigation']	= $this->load->view('template/vnavigation',$n,TRUE);

			//load Content
			$c['CU']      		= $CU;
			$c['nama']    		= $nama;
			$c['EDIT'] 			= $this->user_model->get_user_by_id($id);
			$c['USER_GROUP']	= $this->user_model->get_user_group($id);
			//$O['USER_CONTROL']	= $this->user_model->get_user_controller($id);
			$c['ugroup'] 	= $this->ugroup_model->get_ugroup();
			//$c['controller'] =  $this->control_model->get_control();
			$b['content']	= $this->load->view('user/vform',$c,TRUE);

			//print_r($O['controller']);exit();
			$this->load->view('vbase',$b);		
		}
		else
		{
			if($_SERVER['REQUEST_METHOD']=='POST'){
				$id	= $this->input->post('uid');	
				$data 				= array();		
				$data['username']	= $this->input->post('username');
				$data['password']	= md5($this->input->post('password'));
				$data['nama']		= $this->input->post('nama');
				$data['email']		= $this->input->post('email');
				$data['telpon']		= $this->input->post('telpon');
				$data['aktif']		= $this->input->post('aktif');
				//$access				= $this->input->post('access');
				$group				= $this->input->post('group_id');

				$this->user_model->update_user($data,$id);			
				$this->user_model->delete_user_group($id);
				//$this->user_model->delete_user_access($id);

				if($group AND is_array($group)){
					foreach($group as $group){
						$d = array();
						$d['uid'] = $id;
						$d['group_id'] = $group;							
						$this->user_model->insert_user_group($d);
					}
				}
				// if($access AND is_array($access)){
				// 	foreach($access as $key){
				// 		$d = array();
				// 		$d['uid'] = $id;
				// 		$d['controller_id'] = $key;							
				// 		$this->user_model->insert_user_access($d);
				// 	}
				// }	

				$this->session->set_userdata('message','Data telah tersimpan.');
				$this->session->set_userdata('message_type','success');									
				redirect(site_url('user/index'));
			}
		}


	}

	function delete($id='')
	{
		$id = $this->uri->segment(3);
		if($this->user_model->delete_user($id)){
			$this->user_model->delete_user_group($id);			
			$this->user_model->delete_user_access($id);	
			$this->session->set_userdata('message','Data telah dihapus.');
			$this->session->set_userdata('message_type','success');					
		}
		else
		{
			$this->session->set_userdata('message','Kesalahan, data tidak dihapus.');
			$this->session->set_userdata('message_type','error');						
		}

		redirect(site_url('user/index'));		
	}

	function access($id="")
	{
		$CU      	 = $this->user_model->current_user();		
		$nama    	 = isset($CU->nama) ? $CU->nama : 'Guest';

		$id = $this->uri->segment(3);

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$id	= 	$this->input->post('uid');	
			$access				= $this->input->post('access');
			$this->user_model->delete_user_access($id);

			if($access AND is_array($access)){
				foreach($access as $key){
					$d = array();
					$d['uid'] = $id;
					$d['controller_id'] = $key;							
					$this->user_model->insert_user_access($d);
				}
			}	

			$this->session->set_userdata('message','Data telah tersimpan.');
			$this->session->set_userdata('message_type','success');									
			redirect(site_url('user/index'));
		}else{

			$c['page_title']	= "User Access";
			$CU      	 		= $this->user_model->current_user();		
			$nama    	 		= isset($CU->nama) ? $CU->nama : 'Guest';

			// load header
			$h['CU']      		= $CU;
			$h['nama']    		= $nama;
			$b['header'] 		= $this->load->view('template/vheader',$h,TRUE);

			//load navigation
			$n['ACCESS_MENU']	= $this->user_model->get_user_menu($CU->uid,TRUE);						
			$b['navigation']	= $this->load->view('template/vnavigation',$n,TRUE);

			//load Content
			$c['CU']      		= $CU;
			$c['nama']    		= $nama;
			$c['USER_CONTROL']	= $this->user_model->get_user_controller($id);
			$c['controller'] =  $this->control_model->get_control();
			$c['ugroup'] 	= $this->ugroup_model->get_ugroup();
			$c['EDIT'] 			= $this->user_model->get_user_by_id($id);
			$b['content']	= $this->load->view('user/vaccess',$c,TRUE);

			//print_r($O['controller']);exit();
			$this->load->view('vbase',$b);	

		}	
	}

	function validation($mode='ADD')
	{
		$callback_cek_username = '|callback_cek_username';
		if($mode=='EDIT'){
			$callback_cek_username = '';
		}
		$this->form_validation->set_rules('username', 'Username', 'trim|required'.$callback_cek_username);
		$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[passconf]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('telpon', '', '');
		
		$this->form_validation->set_rules('aktif', 'Aktif', 'trim|required');

		$this->form_validation->set_message('required', '%s harus diisi.');
		$this->form_validation->set_message('matches', 'Password dan Confirm password harus sama.');
		$this->form_validation->set_message('valid_email', 'Penulisan email belum benar. Contoh : username@domain.com');
		
	}


	function cek_username($str)
	{
		if( $this->user_model->user_exists($str) )
		{
			$this->form_validation->set_message('cek_username', 'Username sudah digunakan, silakan gunakan username yang lain');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */