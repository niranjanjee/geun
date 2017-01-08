<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

	public function __construct(){
		parent::__construct();		
	}
	
	public function get_categories($limit = 1, $limitstart = '-1', $filters = array())
	{
		if($limitstart >= 0){
			$this->db->select("c.*");
		}else{
			$this->db->select("COUNT(c.id) AS total_cat");
		}
		$this->db->from("ofo_categories c");
		$this->db->where("c.status <>", "2");	
		if(isset($filters['search']) && $filters['search'] != ""){
			$this->db->where("(c.name LIKE ".$this->db->escape("%".$filters['search']."%").")");
		}
		
		if(isset($filters['status']) && $filters['status'] !== ""){
			$this->db->where("c.status", $filters['status']);
		}
		$this->db->order_by("c.id", "DESC");
		if($limitstart >= 0){
			$this->db->limit($limit, $limitstart);
		}
		$query = $this->db->get();
		$rows = $query->result();		
		//echo $this->db->last_query();
		return $rows;
	}
		
	public function get_category($id){
		$this->db->select("c.*");		
		$this->db->from("ofo_categories c");
		$this->db->where("c.id", $id);	
		$this->db->where("c.status <>", "2");	
		$this->db->order_by("c.id", "DESC");
		$query = $this->db->get();
		$row = $query->row();		
		return $row;
	}
	
	public function save_category($data, $id = 0){
		if($id > 0){
			$this->db->where("id", $id);
			$this->db->update("ofo_categories", $data);
		}else{
			$this->db->insert("ofo_categories", $data);
			$id = $this->db->insert_id();
		}
		return $id;
	}
	
	public function delete_category($id, $data)
	{
		$this->db->where("id", $id);
		if($this->db->update("ofo_categories", $data)){
			return true;
		}else{
			return false;
		}
	}
}
