<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');		
		$this->user_model->has_login();
		$this->load->model('control_model');				
		$this->load->model('ugroup_model');
	}
	
	function index()
	{
		// error_reporting(E_ALL);
		$c['page_title']	= "Controller List";

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
		$b['content']		= $this->load->view('controller/vlist',$c,TRUE);
	
		//load base view
		$this->load->view('vbase',$b);
	}

	public function json()
	{		
		$result=$this->control_model->get_();
		print_r( $result);
	}

	function add()
	{
		$CU      	 = $this->user_model->current_user();		
		$nama    	 = isset($CU->nama) ? $CU->nama : 'Guest';

		$this->validation();
		if ($this->form_validation->run() == FALSE)
		{
		
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
		$c['page_title']	= "New Controller";
		$c['EDIT'] 		= new stdClass();
		$c['ugroup'] 	= $this->ugroup_model->get_ugroup();


		$b['content']		= $this->load->view('controller/vform',$c,TRUE);
	
		//load base view
		$this->load->view('vbase',$b);			

		}else{
			if($_SERVER['REQUEST_METHOD']=='POST'){

				$data['controller']	= $this->input->post('control');
				$data['title']		= $this->input->post('title');
				$data['is_menu']	= ($this->input->post('aktif')=='on') ? '1':'0';
				$data['group_id']	= $this->input->post('group');
				$data['cssicon']	= $this->input->post('cssicon');


				($this->input->post('order')!='') ? $data['order']=$this->input->post('order') : '';

				if($this->control_model->insert_($data)){
					$this->session->set_userdata('message','Data telah tersimpan.');
					$this->session->set_userdata('message_type','success');					
				}
				else
				{
					$this->session->set_userdata('message','kesalahan, data tidak tersimpan.');
					$this->session->set_userdata('message_type','error');						
				}
				redirect(site_url('controller/index'));

			} else {
				redirect(site_url('controller/index'));
			}
		}

	}

	function edit($id='')
	{

		$CU      	 = $this->user_model->current_user();		
		$nama    	 = isset($CU->nama) ? $CU->nama : 'Guest';

		$id = $this->uri->segment(3);
		$this->validation();
		if ($this->form_validation->run() == FALSE)
		{
	
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
		$c['page_title']	= "Edit Controller";
		$c['EDIT'] = $this->control_model->get_by_id($id);
		$c['ugroup'] 	= $this->ugroup_model->get_ugroup();
		$b['content']		= $this->load->view('controller/vform',$c,TRUE);
	
		//load base view
		$this->load->view('vbase',$b);	

		}
		else
		{
			if($_SERVER['REQUEST_METHOD']=='POST'){
				$id	= $this->input->post('id');
				$data['controller']	= $this->input->post('control');
				$data['title']		= $this->input->post('title');
				$data['is_menu']	= ($this->input->post('aktif')=='on') ? '1':'0';
				$data['group_id']	= $this->input->post('group');
				$data['cssicon']	= $this->input->post('cssicon');
				
				($this->input->post('order')!='') ? $data['order']=$this->input->post('order') : '';

				if($this->control_model->update_($data,$id)){
					$this->session->set_userdata('message','Data telah tersimpan.');
					$this->session->set_userdata('message_type','success');					
				}
				else
				{
					$this->session->set_userdata('message','kesalahan, data tidak tersimpan.');
					$this->session->set_userdata('message_type','error');						
				}
				
				redirect(site_url('controller/index'));
			}
		}


	}

	function delete($id='')
	{

		if($this->control_model->delete_($id)){
			$this->session->set_userdata('message','Data telah dihapus.');
			$this->session->set_userdata('message_type','success');					
		}
		else
		{
			$this->session->set_userdata('message','Kesalahan, data tidak dihapus.');
			$this->session->set_userdata('message_type','error');						
		}

		redirect(site_url('controller/index'));		
	}

	function validation()
	{
		$this->form_validation->set_rules('control', 'Controller', 'trim|required');
		$this->form_validation->set_rules('title', 'Title', 'trim|required');		
		$this->form_validation->set_rules('is_show', '', '');
		$this->form_validation->set_rules('sort', 'Sort', 'integer');

		$this->form_validation->set_message('required', '%s harus diisi.');
		$this->form_validation->set_message('integer', '%s harus angka.');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */