<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminusers_model extends CI_Model {

	public function __construct(){
		parent::__construct();		
	}
	
	public function get_admin_users($limitstart = '-1', $limit = 1, $filters = array())
	{
		if($limitstart >= 0){
			$this->db->select("au.*");
		}else{
			$this->db->select("COUNT(au.id) AS total_admin_users");
		}
		$this->db->from("admin_users au");
		$this->db->where("au.status <>", "2");	
		$this->db->order_by("au.id", "DESC");
		if($limitstart >= 0){
			$this->db->limit($limitstart, $limit);
		}
		$query = $this->db->get();
		$rows = $query->result();		
		return $rows;
	}
	
	public function save_admin_user($data, $id = 0)
	{
		if($id > 0){
			$this->db->where("id", $id);
			$this->db->update("admin_users", $data);
		}else{
			$this->db->insert("admin_users", $data);
			$id = $this->db->insert_id();
		}
		return $id;
	}
	
	public function get_admin_user($id){
		$this->db->select("au.*");		
		$this->db->from("admin_users au");
		$this->db->where("au.id", $id);	
		$this->db->where("au.status <>", "2");	
		$this->db->order_by("au.id", "DESC");
		$query = $this->db->get();
		$row = $query->row();		
		return $row;
	}
	
	public function is_unique_value($table_name, $criteria, $id = 0)
	{
	    $this->db->select("COUNT(id) AS total");		
		$this->db->from($table_name);
		if($id > 0){
			$this->db->where($table_name.".id <>", $id);	
		}	
		$this->db->where($criteria);	
		$this->db->order_by($table_name.".id", "DESC");
		$query = $this->db->get();
		$row = $query->row();		
		//echo $this->db->last_query();
		if($row->total > 0){
		    return false;
		}else{
			return true;
		}
    }
	
	public function delete_admin_user($id, $data)
	{
		$this->db->where("id", $id);
		if($this->db->update("admin_users", $data)){
			return true;
		}else{
			return false;
		}
	}
}
