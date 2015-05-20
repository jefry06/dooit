<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');
		$this->master_model->get_tables($this);
		$this->load->model('dataTables_model','dataTables');
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
		$cols 			= array( "controller", "title", "group_name","is_menu" );
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
					FROM {$this->controller} a INNER JOIN {$this->ugroup} b ON a.group_id = b.id 
				";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		if( $search!='' ){
			$_sql_where[] = "
				(
					UCASE(controller) LIKE '%".strtoupper($this->db->escape_str($search))."%'
					OR 
					UCASE(title) LIKE '%".strtoupper($this->db->escape_str($search))."%'
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);	

		$sql = " 	SELECT a.*,b.group_name
					FROM {$this->controller} a INNER JOIN {$this->ugroup} b ON a.group_id = b.id 
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

	function get_control()
	{
		$sql = " SELECT * FROM {$this->controller} ";
		$query 	= $this->db->query($sql);		
		$rs =$query->result();
		return $rs;
	}

	function insert_($data)
	{
		/*$data = $this->master_model->escape_all($data);*/
		$this->db->insert($this->controller, $data);
		return $this->db->affected_rows();
	}

	function update_($data,$id)
	{
		/*$id = $this->db->escape_str($id);*/
		/*$data = $this->master_model->escape_all($data);*/
		$this->db->where('id', $id);
		$this->db->update($this->controller,$data);		
		return $this->db->affected_rows();
	}

	function delete_($id)
	{
		/*$id = $this->db->escape_str($id);*/
		$this->db->where('id', $id);
		$this->db->delete($this->controller);
		return $this->db->affected_rows();
	}


	function get_by_id($id)
	{
		$this->db->select("*");
		$this->db->from('controller');
		$this->db->where('id', $id);
		$rs = $this->db->get();
		return (OBJECT) $rs->row();
	}

}