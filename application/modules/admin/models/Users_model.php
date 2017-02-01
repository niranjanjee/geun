<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

	public function __construct(){
		parent::__construct();		
	}
	
	public function get_users($limit = 1, $limitstart = '-1', $filters = array())
	{
		if($limitstart >= 0){
			$this->db->select("u.*");
		}else{
			$this->db->select("COUNT(u.id) AS total_users");
		}
		$this->db->from("ofo_users u");
		$this->db->where("u.status <>", "2");	
		if(isset($filters['search']) && $filters['search'] != ""){
			$this->db->where("(u.name LIKE ".$this->db->escape("%".$filters['search']."%")." 
			OR u.email LIKE ".$this->db->escape("%".$filters['search']."%").")
			OR u.contact_no LIKE ".$this->db->escape("%".$filters['search']."%"));
		}
		
		if(isset($filters['status']) && $filters['status'] !== ""){
			$this->db->where("u.status", $filters['status']);
		}
		$this->db->order_by("u.id", "DESC");
		if($limitstart >= 0){
			$this->db->limit($limit, $limitstart);
		}
		$query = $this->db->get();
		$rows = $query->result();		
		//echo $this->db->last_query();
		return $rows;
	}
		
	public function get_user($id){
		$this->db->select("u.*");		
		$this->db->from("ofo_users u");
		$this->db->where("u.id", $id);	
		$this->db->where("u.status <>", "2");	
		$this->db->order_by("u.id", "DESC");
		$query = $this->db->get();
		$row = $query->row();		
		return $row;
	}
	
	public function update_user_status($id, $data)
	{
		$this->db->where("id", $id);
		if($this->db->update("ofo_users", $data))
		{
			return true;
		}else{
			return false;
		}
	}
}
