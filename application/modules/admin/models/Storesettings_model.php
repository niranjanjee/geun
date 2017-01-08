<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Storesettings_model extends CI_Model {

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
	
	public function show_category()
	{
	    $this->db->select('*');
		$this->db->from('ofo_categories');
        $this->db->where('status', 1 );
        $query = $this->db->get();
		$i=0; $infoArr = array();
		foreach($query->result() as $row)
		{
			$infoArr[$i]['id'] = $row->id;
			$infoArr[$i]['name'] = $row->name;
			$i++;
		}
		return $infoArr;
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
	
	public function get_subcategories($limit = 1, $limitstart = '-1', $filters = array())
	{
		if($limitstart >= 0){
			$this->db->select("gs.*");
			$this->db->select("C.id as CID,C.name as name1");
		}else{
			$this->db->select("COUNT(gs.id) AS total_subcat");
		}
		$this->db->from("ofo_sub_categories gs");
		 $this->db->join('ofo_categories C', 'gs.category_id = C.id', 'left'); 
		
		$this->db->where("gs.status <>", "2");	
		if(isset($filters['search']) && $filters['search'] != "")
		{
			$this->db->where("(gs.name LIKE ".$this->db->escape("%".$filters['search']."%").")");
		}
	
		if(isset($filters['status']) && $filters['status'] !== ""){
			$this->db->where("gs.status", $filters['status']);
		}
		$this->db->order_by("gs.id", "DESC");
		if($limitstart >= 0){
			$this->db->limit($limit, $limitstart);
		}
		$query = $this->db->get();
		$rows = $query->result();		
		//echo $this->db->last_query();  die;
		return $rows;
	}
	
	public function delete_subcategory($id, $data)
	{
		$this->db->where("id", $id);
		if($this->db->update("gem_gemstone_species", $data)){
			return true;
		}else{
			return false;
		}
	}
	
	public function save_subcategory($data, $id = 0){
		if($id > 0){
			$this->db->where("id", $id);
			$this->db->update("ofo_sub_categories", $data);
		}else{
			$this->db->insert("ofo_sub_categories", $data);
			$id = $this->db->insert_id();
		}
		return $id;
	}
	
	public function get_subcategory($id){
		$this->db->select("gs.*");		
		$this->db->from("gem_gemstone_species gs");
		$this->db->where("gs.id", $id);	
		$this->db->where("gs.status <>", "2");	
		$this->db->order_by("gs.id", "DESC");
		$query = $this->db->get();
		$row = $query->row();		
		return $row;
	}
	
	
}
