<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('master_model');
		$this->master_model->get_tables($this);
		$this->load->model('dataTables_model','dataTables');
	}

	function get_order_header()
	{
		$query = $this->db->get($this->order_header);
		return $query->result_array();
	}

	function get_order_detail($orderCode)
	{
		$this->db->select("*");
		$this->db->from($this->order_detail);
		$this->db->where('order_code', $orderCode);
		$rs = $this->db->get();
		return $rs->result_array();

	}

	function get_order_delivery($orderCode)
	{
		$this->db->select("*");
		$this->db->from($this->order_delivery);
		$this->db->where('order_code', $orderCode);
		$rs = $this->db->get();
		return (object) $rs->row();

	}

	function get_order_history($orderCode)
	{
		$this->db->select("*");
		$this->db->from($this->order_history);
		$this->db->where('order_code', $orderCode);
		$rs = $this->db->get();
		return $rs->result_array();

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
		$cols 			= array( 'order_code','user_id','order_total','order_status','order_date','create_at','modified_at');
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
					FROM {$this->order_header} ";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		if( $search!='' ){
			$_sql_where[] = "
				(
					UCASE(order_code) LIKE '%".strtoupper($this->db->escape_str($search))."%' OR
					UCASE(user_id) LIKE '%".strtoupper($this->db->escape_str($search))."%' OR
					UCASE(order_date) LIKE '%".strtoupper($this->db->escape_str($search))."%'								
				)
			";
		}

		$_sql_where[] =" order_status=0 ";

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);	

		$sql = " 	SELECT *
					FROM {$this->order_header} 
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

	function get_all()
	{

		// variable initialization
		$search 		= "";
		$start 			= 0;
		$rows 			= 10;
		$iTotal 		= 0;
		$iFilteredTotal = 0;
		$_sql_where 	= array();
		$sql_where 		= '';
		$cols 			= array( 'order_code','user_id','order_total','order_status','order_date','create_at','modified_at');
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
					FROM {$this->order_header} ";

		$q = $this->db->query($sql);
		$iTotal = $q->row('iTotal');

		if( $search!='' ){
			$_sql_where[] = "
				(
					UCASE(order_code) LIKE '%".strtoupper($this->db->escape_str($search))."%' OR
					UCASE(user_id) LIKE '%".strtoupper($this->db->escape_str($search))."%' OR
					UCASE(order_date) LIKE '%".strtoupper($this->db->escape_str($search))."%'								
				)
			";
		}

		if(count($_sql_where)>0) $sql_where = " WHERE ".implode(' AND ',$_sql_where);	

		$sql = " 	SELECT *
					FROM {$this->order_header} 
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
		$this->db->insert($this->order_header, $data);
		return $this->db->affected_rows();
	}

	function insert_detail_($data)
	{
		/*$data = $this->master_model->escape_all($data);*/
		$this->db->insert($this->order_detail, $data);
		return $this->db->affected_rows();
	}

	function insert_delivery_($data)
	{
		/*$data = $this->master_model->escape_all($data);*/
		$this->db->insert($this->order_delivery, $data);
		return $this->db->affected_rows();
	}

	function insert_history_($data)
	{
		/*$data = $this->master_model->escape_all($data);*/
		$this->db->insert($this->order_history, $data);
		return $this->db->affected_rows();
	}

	function insert_get_id($data)
	{
		/*$data = $this->master_model->escape_all($data);*/
		$this->db->insert($this->order_header, $data);
		return $this->db->insert_id();
	}

	function insert_detail_get_id($data)
	{
		/*$data = $this->master_model->escape_all($data);*/
		$this->db->insert($this->order_detail, $data);
		return $this->db->insert_id();
	}

	function insert_delivery_get_id($data)
	{
		/*$data = $this->master_model->escape_all($data);*/
		$this->db->insert($this->order_delivery, $data);
		return $this->db->insert_id();
	}

	function update_($data,$id)
	{
		/*$id = $this->db->escape_str($id);*/
		/*$data = $this->master_model->escape_all($data);*/
		$this->db->where('order_code', $id);
		$this->db->update($this->order_header,$data);		
		return $this->db->affected_rows();
	}

	function update_detail_($data,$id)
	{
		/*$id = $this->db->escape_str($id);*/
		/*$data = $this->master_model->escape_all($data);*/
		$this->db->where('detail_id', $id);
		$this->db->update($this->order_detail,$data);		
		return $this->db->affected_rows();
	}

	function update_delivery_($data,$id)
	{
		/*$id = $this->db->escape_str($id);*/
		/*$data = $this->master_model->escape_all($data);*/
		$this->db->where('order_code', $id);
		$this->db->update($this->order_delivery,$data);		
		return $this->db->affected_rows();
	}

	function delete_($id)
	{
		/*$id = $this->db->escape_str($id);*/
		$this->db->where('order_code', $id);
		$this->db->delete($this->order_header);
		return $this->db->affected_rows();
	}

	function delete_detail_($id)
	{
		/*$id = $this->db->escape_str($id);*/
		$this->db->where('detail_id', $id);
		$this->db->delete($this->order_detail);
		return $this->db->affected_rows();
	}

	function delete_delivery_($id)
	{
		/*$id = $this->db->escape_str($id);*/
		$this->db->where('delivery_id', $id);
		$this->db->delete($this->order_delivery);
		return $this->db->affected_rows();
	}

	function get_by_id($id)
	{
		$this->db->select("*");
		$this->db->from($this->order_header);
		$this->db->where('order_code', $id);
		$rs = $this->db->get();
		return (OBJECT) $rs->row();
	}	

	function get_by_userid($id)
	{
		$this->db->select("*");
		$this->db->from($this->order_header);
		$this->db->where('user_id', $id);
		$rs = $this->db->get();
		return $rs->result_array();
	}	

	function get_detail_by_id($id)
	{
		$this->db->select("*");
		$this->db->from($this->order_detail);
		$this->db->where('order_code', $id);
		$rs = $this->db->get();
		return (OBJECT) $rs->result_array();
	}		

	function get_delivery_by_id($id)
	{
		$this->db->select("*");
		$this->db->from($this->order_delivery);
		$this->db->where('order_code', $id);
		$rs = $this->db->get();
		return (OBJECT) $rs->row();
	}	

	function get_history_($id)
	{
		$this->db->select("*");
		$this->db->from($this->order_history);
		$this->db->where('order_code', $id);
		$this->db->order_by("history_date", "desc"); 
		$rs = $this->db->get();		
		return (OBJECT) $rs->result_array();
	}

	function get_history_by_id($id)
	{
		$this->db->select("*");
		$this->db->from($this->order_history);
		$this->db->where('user_id', $id);
		$this->db->order_by("history_date", "desc"); 
		$rs = $this->db->get();
		return (OBJECT) $rs->result_array();
	}

	function get_transaksi_by_id($id)
	{
		$sql="select order_code,user_id,order_total,order_date, (CASE order_status WHEN 0 THEN 'Pending' WHEN 1 THEN 'Sukses' ELSE 'Dibatalkan' END ) as order_status from order_header where user_id='".$id."' ORDER BY order_date desc; ";
		$rs = $this->db->query($sql);
		return (OBJECT) $rs->result_array();
	}


	function get_report($start="",$end="",$status="0"){
		$sql="
				SELECT
				oh.order_code,
				oh.user_id,
				oh.order_date,
				oh.order_status,
				od.com_code,
				od.item_id,
				od.item_name,
				od.item_price,
				od.item_desc,
				od.item_img,
				od.item_size,
				od.item_color,
				od.item_disc,
				od.item_qty,
				od.item_subtotal
				FROM
				order_header AS oh
				LEFT JOIN order_detail AS od ON oh.order_code = od.order_code
				WHERE
				DATE_FORMAT(oh.order_date,'%Y-%m-%d') BETWEEN '".$start."' AND '".$end."' ";
				if($status!="") {
					$sql .=" AND oh.order_status = '".$status."' ";
				}

				$sql .=" order by oh.order_date asc";

		$rs = $this->db->query($sql);
		return $rs->result_array();		
	}

}