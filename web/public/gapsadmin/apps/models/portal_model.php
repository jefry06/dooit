<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Portal_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');
		$this->master_model->get_tables($this);
		$this->load->model('dataTables_model','dataTables');
	}

	function get_portal()
	{
		$query = $this->db->get($this->company);
		return $query->result_array();
	}

	function get_()
	{

		// variable initialization
		$search 		= "";
		$start 			= 0;
		$rows 			= 10;
		$iTotal 		= 0;
		$iFilteredTotal = 0;
		$_sql_where 	= array();
		$sql_where 		= '';
		$cols 			= array( "com_id","com_code","com_domain","com_name","com_ico","com_logo","com_img_header","com_img_footer","com_address","com_tlp","com_fax","com_email","com_url_wallet","com_url_commerce","com_tpl_path","com_asset_path","com_url_success","com_url_failed","create_at","modified_at" );
		$sort 			= "";
		
		// get search value (if any)
		if (isset($_GET['sSearch']) && $_GET['sSearch'] != "" ) {
			$search = $_GET['sSearch'];
		}

		// limit
		$start 		= $this->dataTables->get_start();
		$rows 		= $this->dataTables->get_rows();
		// sort
		$sort 		= $this->dataTables->get_sort($cols);		
		$sort_dir 	= $this->dataTables->get_sort_dir();		
		        
        //running query		
		$sql = " 	SELECT count(0) as iTotal
					FROM {$this->company} ";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		if( $search!='' ){
			$_sql_where[] = "
				(
					UCASE(com_domain) LIKE '%".strtoupper($this->db->escape_str($search))."%' OR
					UCASE(com_code) LIKE '%".strtoupper($this->db->escape_str($search))."%' OR
					UCASE(com_name) LIKE '%".strtoupper($this->db->escape_str($search))."%' OR
					UCASE(com_address) LIKE '%".strtoupper($this->db->escape_str($search))."%' OR
					UCASE(com_tlp) LIKE '%".strtoupper($this->db->escape_str($search))."%' OR
					UCASE(com_email) LIKE '%".strtoupper($this->db->escape_str($search))."%'									
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);	

		$sql = " 	SELECT *
					FROM {$this->company} 
					$sql_where
			";

		if($sort!='' && $sort_dir!='') $order = " ORDER BY $sort $sort_dir ";
		
		$query 	= $this->db->query($sql. $order. " LIMIT $start,$rows ");
		$data 	= $query->result();

		if( $search!='' ){
			$iFilteredTotal = count($query->result());
		}else{
			$iFilteredTotal = $iTotal;
		}
		
        /*
         * Output
         */
         $output = array(
             "sEcho" => $this->dataTables->get_echo(),
             "iTotalRecords" => $iTotal,
             "iTotalDisplayRecords" => $iFilteredTotal,
             "aaData" => $data
         );

		return json_encode($output);
	}	

	function insert_($data)
	{
		/*$data = $this->master_model->escape_all($data);*/
		$this->db->insert($this->company, $data);
		return $this->db->affected_rows();
	}

	function insert_get_id($data)
	{
		/*$data = $this->master_model->escape_all($data);*/
		$this->db->insert($this->company, $data);
		return $this->db->insert_id();
	}
	
	function update_($data,$id)
	{
		/*$id = $this->db->escape_str($id);*/
		/*$data = $this->master_model->escape_all($data);*/
		$this->db->where('com_id', $id);
		$this->db->update($this->company,$data);		
		return $this->db->affected_rows();
	}

	function delete_($id)
	{
		/*$id = $this->db->escape_str($id);*/
		$this->db->where('com_id', $id);
		$this->db->delete($this->company);
		return $this->db->affected_rows();
	}


	function get_by_id($id)
	{
		$this->db->select("*");
		$this->db->from($this->company);
		$this->db->where('com_id', $id);
		$rs = $this->db->get();
		return (OBJECT) $rs->row();
	}

	function get_by_name($comname)
	{
		$this->db->select("*");
		$this->db->from($this->company);
		$this->db->where('com_domain', $comname);
		$rs = $this->db->get();
		return (OBJECT) $rs->row();
	}		

	function insert_param_($data)
	{
		/*$data = $this->master_model->escape_all($data);*/
		$this->db->insert($this->company_param, $data);
		return $this->db->affected_rows();	
	}

	function delete_param_($id)
	{
		/*$id = $this->db->escape_str($id);*/
		$this->db->where('com_id', $id);
		$this->db->delete($this->company_param);
		return $this->db->affected_rows();
	}

	function get_param_by_id($id)
	{
		$this->db->select("*");
		$this->db->from($this->company_param);
		$this->db->where('com_id', $id);
		$rs = $this->db->get();
		$result=$rs->result_array();
		$res=array();
		foreach ($result as $key ) {
			# code...
			$res[$key['param']] = $key['values'];
		}
		return (OBJECT) $res;
	}
	
}