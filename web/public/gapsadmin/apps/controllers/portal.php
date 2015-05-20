<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Portal extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->model('user_model');
		$this->user_model->has_login();
		$this->load->model('portal_model');

	}
	
	public function index()
	{

		// error_reporting(E_ALL);
		$c['page_title']	= "Portal List";

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
		$b['content']		= $this->load->view('portal/vlist',$c,TRUE);
	
		//load base view
		$this->load->view('vbase',$b);
	}

	public function json()
	{		
		$result=$this->portal_model->get_();
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
			$c['page_title']	= "New Portal";
			$c['EDIT'] 			= new stdClass();
			$b['content']		= $this->load->view('portal/vform',$c,TRUE);
		
			//load base view
			$this->load->view('vbase',$b);			

		}else{
			if($_SERVER['REQUEST_METHOD']=='POST'){				
				$data['com_code']	= $this->input->post('com_code');
				$data['com_name']	= $this->input->post('com_name');
				$data['com_domain']	= $this->input->post('com_domain');
				$data['com_tpl_path']	= $this->input->post('com_tpl_path');
				$data['com_asset_path']	= $this->input->post('com_asset_path');
				$data['com_asset_url']	= $this->input->post('com_asset_url');
				$data['com_url_wallet']	= $this->input->post('com_url_wallet');				
				$data['com_url_commerce']	= $this->input->post('com_url_commerce');
				$data['com_url_success']	= $this->input->post('com_url_success');
				$data['com_url_failed']	= $this->input->post('com_url_failed');
				$data['com_address']	= $this->input->post('com_address');
				$data['com_tlp']	= $this->input->post('com_tlp');
				$data['com_fax']	= $this->input->post('com_fax');
				$data['com_email']	= $this->input->post('com_email');
				$data['create_at']	= date("Y-m-d H:i:s");
				$assets_path =$this->input->post('com_asset_path');

				if($_FILES['com_ico']['name']!='')
				{				
	    			$temp                   = explode(".", $_FILES['com_ico']["name"]);
	    			$extension              = end($temp);
	    			$com_ico				= NewGuid();    								
				    $data['com_ico']		= $com_ico.".".$extension;  
				}

				if($_FILES['com_logo']['name']!='')
				{				
	    			$temp                   = explode(".", $_FILES['com_logo']["name"]);
	    			$extension              = end($temp);
	    			$com_logo				= NewGuid();    								
				    $data['com_logo']		= $com_logo.".".$extension;  
				}
				
				if($_FILES['com_img_header']['name']!='')
				{				
	    			$temp                   = explode(".", $_FILES['com_img_header']["name"]);
	    			$extension              = end($temp);
	    			$com_img_header			= NewGuid();    								
				    $data['com_img_header']		= $com_img_header.".".$extension;  
				}

				if($_FILES['com_img_footer']['name']!='')
				{				
	    			$temp                   = explode(".", $_FILES['com_img_footer']["name"]);
	    			$extension              = end($temp);
	    			$com_img_footer			= NewGuid();    								
				    $data['com_img_footer']		= $com_img_footer.".".$extension;  
				}
												
				$idp=$this->portal_model->insert_get_id($data);

				if($this->input->post('loginbox')!='')
				{
					$comp['com_id']=$idp;
					$comp['param'] ="loginbox";
					$comp['values'] =$this->input->post('loginbox');
					$this->portal_model->insert_param_($comp);
				}

				if($this->input->post('loginbox2')!='')
				{
					$comp['com_id']=$idp;
					$comp['param'] ="bg222";
					$comp['values'] =$this->input->post('loginbox2');
					$this->portal_model->insert_param_($comp);					
				}				
				
				if($this->input->post('navigationbg')!='') 
				{
					$comp['com_id']=$idp;
					$comp['param'] ="navigation";
					$comp['values'] =$this->input->post('navigationbg');
					$this->portal_model->insert_param_($comp);
				}

				if($this->input->post('navigationbg2')!='')
				{
					$comp['com_id']=$idp;
					$comp['param'] ="headernav";
					$comp['values'] =$this->input->post('navigationbg2');
					$this->portal_model->insert_param_($comp);

				}

				if($this->input->post('navigationbg1')!='')
				{
					$comp['com_id']=$idp;
					$comp['param'] ="profile";
					$comp['values'] =$this->input->post('navigationbg1');
					$this->portal_model->insert_param_($comp);
				}


				if($_FILES['img_slide1']['name']!='')
				{				
	    			$temp                   = explode(".", $_FILES['img_slide1']["name"]);
	    			$extension              = end($temp);
	    			$img_slide1			= NewGuid();    								
				    $img_slide1	= $img_slide1.".".$extension;  
					$comp['com_id']=$idp;
					$comp['param'] ="slide1";
					$comp['values'] =$img_slide1;
					$this->portal_model->insert_param_($comp);				    
				}

				if($_FILES['img_slide2']['name']!='')
				{				
	    			$temp                   = explode(".", $_FILES['img_slide2']["name"]);
	    			$extension              = end($temp);
	    			$img_slide2			= NewGuid();    								
				    $img_slide2	= $img_slide2.".".$extension;  
					$comp['com_id']=$idp;
					$comp['param'] ="slide2";
					$comp['values'] =$img_slide2;
					$this->portal_model->insert_param_($comp);				    
				}

				if($_FILES['img_slide3']['name']!='')
				{				
	    			$temp                   = explode(".", $_FILES['img_slide3']["name"]);
	    			$extension              = end($temp);
	    			$img_slide3			= NewGuid();    								
				    $img_slide3		= $img_slide3.".".$extension;  
					$comp['com_id']=$idp;
					$comp['param'] ="slide3";
					$comp['values'] =$img_slide3;
					$this->portal_model->insert_param_($comp);				    
				}


				if($idp!=''){

					if($data['com_ico']!='')
					{						
						$img_name 		= "com_ico";						
						$dest 			= $assets_path."/img/";
						$upload 		= FILES_upload_resize($img_name,$dest,$com_ico);
					}

					if($data['com_logo']!='')
					{						
						$img_name 		= "com_logo";						
						$dest 			= $assets_path."/img/";
						$upload 		= FILES_upload_resize($img_name,$dest,$com_logo);
					}

					if($data['com_img_header']!='')
					{						
						$img_name 		= "com_img_header";						
						$dest 			= $assets_path."/img/";
						$upload 		= FILES_upload_resize($img_name,$dest,$com_img_header);
					}

					if($data['com_img_footer']!='')
					{						
						$img_name 		= "com_img_footer";						
						$dest 			= $assets_path."/img/";
						$upload 		= FILES_upload_resize($img_name,$dest,$com_img_footer);
					}

					if($img_slide1!='')
					{						
						$img_name 		= "img_slide1";						
						$dest 			= $assets_path."/img/";
						$upload 		= FILES_upload_resize($img_name,$dest,$img_slide1);

					}

					if($img_slide2!='')
					{						
						$img_name 		= "img_slide2";						
						$dest 			= $assets_path."/img/";
						$upload 		= FILES_upload_resize($img_name,$dest,$img_slide2);
					}

					if($img_slide3!='')
					{						
						$img_name 		= "img_slide3";						
						$dest 			= $assets_path."/img/";
						$upload 		= FILES_upload_resize($img_name,$dest,$img_slide3);
					}
																														
					$this->session->set_userdata('message','Data telah tersimpan.');
					$this->session->set_userdata('message_type','success');					
				}
				else
				{
					$this->session->set_userdata('message','kesalahan, data tidak tersimpan.');
					$this->session->set_userdata('message_type','error');						
				}
				redirect(site_url('portal/index'));

			} else {
				redirect(site_url('portal/index'));
			}
		}

	}

	function edit($com_id)
	{
		$CU      	 = $this->user_model->current_user();		
		$nama    	 = isset($CU->nama) ? $CU->nama : 'Guest';
		
		$com_id = $this->uri->segment(3);
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
			$c['page_title']	= "New Portal";
			$c['EDIT'] 			= $this->portal_model->get_by_id($com_id);
			$c['PARAM'] 		= $this->portal_model->get_param_by_id($com_id);

			$b['content']		= $this->load->view('portal/vform',$c,TRUE);
			//print_r($c['PARAM']);exit();
			
			//load base view
			$this->load->view('vbase',$b);			

		}else{
			if($_SERVER['REQUEST_METHOD']=='POST'){
				$com_id	= $this->input->post('com_id');

				$data['com_code']	= $this->input->post('com_code');
				$data['com_name']	= $this->input->post('com_name');
				$data['com_domain']	= $this->input->post('com_domain');
				$data['com_tpl_path']	= $this->input->post('com_tpl_path');
				$data['com_asset_path']	= $this->input->post('com_asset_path');
				$data['com_asset_url']	= $this->input->post('com_asset_url');
				$data['com_url_wallet']	= $this->input->post('com_url_wallet');				
				$data['com_url_commerce']	= $this->input->post('com_url_commerce');
				$data['com_url_success']	= $this->input->post('com_url_success');
				$data['com_url_failed']	= $this->input->post('com_url_failed');
				$data['com_address']	= $this->input->post('com_address');
				$data['com_tlp']	= $this->input->post('com_tlp');
				$data['com_fax']	= $this->input->post('com_fax');
				$data['com_email']	= $this->input->post('com_email');
				$data['modified_at']	= date("Y-m-d H:i:s");
				$assets_path =$this->input->post('com_asset_path');
				if($_FILES['com_ico']['name']!='')
				{				
	    			$temp                   = explode(".", $_FILES['com_ico']["name"]);
	    			$extension              = end($temp);
	    			$com_ico				= NewGuid();    								
				    $data['com_ico']		= $com_ico.".".$extension;  
				}

				if($_FILES['com_logo']['name']!='')
				{				
	    			$temp                   = explode(".", $_FILES['com_logo']["name"]);
	    			$extension              = end($temp);
	    			$com_logo				= NewGuid();    								
				    $data['com_logo']		= $com_logo.".".$extension;  
				}
				
				if($_FILES['com_img_header']['name']!='')
				{				
	    			$temp                   = explode(".", $_FILES['com_img_header']["name"]);
	    			$extension              = end($temp);
	    			$com_img_header			= NewGuid();    								
				    $data['com_img_header']		= $com_img_header.".".$extension;  
				}

				if($_FILES['com_img_footer']['name']!='')
				{				
	    			$temp                   = explode(".", $_FILES['com_img_footer']["name"]);
	    			$extension              = end($temp);
	    			$com_img_footer			= NewGuid();    								
				    $data['com_img_footer']		= $com_img_footer.".".$extension;  
				}
				
				if($this->portal_model->update_($data,$com_id))
				{

					$this->portal_model->delete_param_($com_id);

					if($this->input->post('loginbox')!='')
					{
						$comp['com_id']=$com_id;
						$comp['param'] ="loginbox";
						$comp['values'] =$this->input->post('loginbox');
						$this->portal_model->insert_param_($comp);
					}

					if($this->input->post('loginbox2')!='')
					{
						$comp['com_id']=$com_id;
						$comp['param'] ="bg222";
						$comp['values'] =$this->input->post('loginbox2');
						$this->portal_model->insert_param_($comp);					
					}				
					
					if($this->input->post('navigationbg')!='') 
					{
						$comp['com_id']=$com_id;
						$comp['param'] ="navigation";
						$comp['values'] =$this->input->post('navigationbg');
						$this->portal_model->insert_param_($comp);
					}

					if($this->input->post('navigationbg2')!='')
					{
						$comp['com_id']=$com_id;
						$comp['param'] ="headernav";
						$comp['values'] =$this->input->post('navigationbg2');
						$this->portal_model->insert_param_($comp);

					}

					if($_FILES['img_slide1']['name']!='')
					{				
		    			$temp                   = explode(".", $_FILES['img_slide1']["name"]);
		    			$extension              = end($temp);
		    			$img_slide1			= NewGuid();    								
					    $img_slide1	= $img_slide1.".".$extension;  
						$comp['com_id']=$com_id;
						$comp['param'] ="slide1";
						$comp['values'] =$img_slide1;
						$this->portal_model->insert_param_($comp);				    
					}

					if($_FILES['img_slide2']['name']!='')
					{				
		    			$temp                   = explode(".", $_FILES['img_slide2']["name"]);
		    			$extension              = end($temp);
		    			$img_slide2			= NewGuid();    								
					    $img_slide2	= $img_slide2.".".$extension;  
						$comp['com_id']=$com_id;
						$comp['param'] ="slide2";
						$comp['values'] =$img_slide2;
						$this->portal_model->insert_param_($comp);				    
					}

					if($_FILES['img_slide3']['name']!='')
					{				
		    			$temp                   = explode(".", $_FILES['img_slide3']["name"]);
		    			$extension              = end($temp);
		    			$img_slide3			= NewGuid();    								
					    $img_slide3		= $img_slide3.".".$extension;  
						$comp['com_id']=$com_id;
						$comp['param'] ="slide3";
						$comp['values'] =$img_slide3;
						$this->portal_model->insert_param_($comp);				    
					}

					if($this->input->post('navigationbg1')!='')
					{
						$comp['com_id']=$com_id;
						$comp['param'] ="profile";
						$comp['values'] =$this->input->post('navigationbg1');
						$this->portal_model->insert_param_($comp);
					}

					if($data['com_ico']!='')
					{						
						$img_name 		= "com_ico";						
						$dest 			= $assets_path."/img/";
						$upload 		= FILES_upload_resize($img_name,$dest,$com_ico);
					}

					if($data['com_logo']!='')
					{						
						$img_name 		= "com_logo";						
						$dest 			= $assets_path."/img/";
						$upload 		= FILES_upload_resize($img_name,$dest,$com_logo);
					}

					if($data['com_img_header']!='')
					{						
						$img_name 		= "com_img_header";						
						$dest 			= $assets_path."/img/";
						$upload 		= FILES_upload_resize($img_name,$dest,$com_img_header);
					}

					if($data['com_img_footer']!='')
					{						
						$img_name 		= "com_img_footer";						
						$dest 			= $assets_path."/img/";
						$upload 		= FILES_upload_resize($img_name,$dest,$com_img_footer);
					}

					if($img_slide1!='')
					{						
						$img_name 		= "img_slide1";						
						$dest 			= $assets_path."/img/";
						$upload 		= FILES_upload_resize($img_name,$dest,$img_slide1);

					}

					if($img_slide2!='')
					{						
						$img_name 		= "img_slide2";						
						$dest 			= $assets_path."/img/";
						$upload 		= FILES_upload_resize($img_name,$dest,$img_slide2);
					}

					if($img_slide3!='')
					{						
						$img_name 		= "img_slide3";						
						$dest 			= $assets_path."/img/";
						$upload 		= FILES_upload_resize($img_name,$dest,$img_slide3);
					}

					$this->session->set_userdata('message','Data telah tersimpan.');
					$this->session->set_userdata('message_type','success');					
				}
				else
				{
					$this->session->set_userdata('message','kesalahan, data tidak tersimpan.');
					$this->session->set_userdata('message_type','error');						
				}
				redirect(site_url('portal/index'));

			} else {
				redirect(site_url('portal/index'));
			}
		}

	}

	function delete($id='')
	{

		if($this->portal_model->delete_($id)){
			$this->session->set_userdata('message','Data telah dihapus.');
			$this->session->set_userdata('message_type','success');					
		}
		else
		{
			$this->session->set_userdata('message','Kesalahan, data tidak dihapus.');
			$this->session->set_userdata('message_type','error');						
		}

		redirect(site_url('portal/index'));		
	}

	function validation()
	{
		$this->form_validation->set_rules('com_code', 'Company Code', 'trim|required');

		$this->form_validation->set_message('required', '%s harus diisi.');
		$this->form_validation->set_message('integer', '%s harus angka.');
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */