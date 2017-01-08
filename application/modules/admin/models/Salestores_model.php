<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salestores_model extends CI_Model {

	public function __construct(){
		parent::__construct();		
	}
	
	public function get_salestores($limit = 1, $limitstart = '-1', $filters = array())
	{
		if($limitstart >= 0){
			$this->db->select("s.*, u.name AS uname, u.email");
		}else{
			$this->db->select("COUNT(s.id) AS total_sale_stores");
		}
		$this->db->from("gem_stores s");
		$this->db->join("ofo_users u", "u.id = s.user_id", "inner");
		$this->db->where("s.status <>", "2");	
		if(isset($filters['search']) && $filters['search'] != ""){
			$this->db->where("(s.name LIKE ".$this->db->escape("%".$filters['search']."%").")");
		}
		
		if(isset($filters['status']) && $filters['status'] !== ""){
			$this->db->where("s.status", $filters['status']);
		}
		$this->db->order_by("s.id", "DESC");
		if($limitstart >= 0){
			$this->db->limit($limit, $limitstart);
		}
		$query = $this->db->get();
		$rows = $query->result();		
		//echo $this->db->last_query();
		return $rows;
	}
	
	public function get_salestore($sid)
	{
		$this->db->select("s.*, u.name AS uname, u.email");
		$this->db->from("gem_stores s");
		$this->db->join("ofo_users u", "u.id = s.user_id AND s.status <> 2", "inner");
		$this->db->where("s.status <>", "2");	
		$this->db->where("s.id", $sid);	
		$this->db->order_by("s.id", "DESC");
		$query = $this->db->get();
		$rows = $query->row();		
		//echo $this->db->last_query();
		return $rows;
	}
		
	public function save_store($data, $id = 0)
	{
		if($id > 0)
		{
			$this->db->where("id", $id);
			$this->db->update("gem_stores", $data);
		}
		else
		{
			$this->db->insert("gem_stores", $data);
			$id = $this->db->insert_id();
		}
		//echo $this->db->last_query();die;
		return $id;
	}
	
	public function get_products($limit = 1, $limitstart = '-1', $filters = array())
	{
		$sql = "";
		if($limitstart >= 0){
			$sql =  "SELECT p.id, p.title, p.store_id, p.weight, p.height, p.width, p.length, p.status, 
			        cat.name AS gemstone, gs.name AS gemstone_species";
		}else{
			$sql =  "SELECT COUNT(p.id) AS total_products";							
		}
		$sql .= " FROM gem_products p
					INNER JOIN gem_stores AS s ON s.id = p.store_id AND s.status <> 2	
					INNER JOIN ofo_categories AS cat ON cat.id = p.category_id AND cat.status <> 2	
					INNER JOIN gem_gemstone_species AS gs ON gs.id = p.gemspecies_id AND gs.status <> 2	
					LEFT JOIN gem_product_gallery AS pg ON p.id = pg.product_id AND pg.is_primary = 1
				WHERE p.status <> 2 AND p.store_id = ".$this->db->escape($filters['sid']);
		
			if(isset($filters['search']) && $filters['search'] != ""){
				$sql .= " AND (cat.name LIKE ".$this->db->escape("%".$filters['search']."%")." 
				OR p.weight LIKE ".$this->db->escape("%".$filters['search']."%")."
				OR gs.name LIKE ".$this->db->escape("%".$filters['search']."%").")";
			}	
			
			$sql .= " ORDER BY p.id DESC ";
			if($limitstart >= 0){
				$sql .= " LIMIT ".$limitstart.", ".$limit;
			}
		$query = $this->db->query($sql);
		$rows = $query->result();	
		//echo $this->db->last_query();
		return $rows;
	}
	
	public function save_product($data, $id = 0)
	{
		if($id > 0)
		{
			$this->db->where("id", $id);
			$this->db->update("gem_products", $data);
		}
		else
		{
			$this->db->insert("gem_products", $data);
			$id = $this->db->insert_id();
		}
		//echo $this->db->last_query();die;
		return $id;
	}
	
	public function is_valid_store_product($store_id, $pid)
	{
		$this->db->select("COUNT(p.id) AS total");
		$this->db->from("gem_products p");
		$this->db->join("gem_stores s", "p.store_id = s.id", "inner");
		$this->db->where("p.id", $pid);
		$this->db->where("s.id", $store_id);
		$this->db->order_by("p.id", "DESC");
		$this->db->limit(1);
		$query = $this->db->get();
		$row = $query->row();
		if($row->total > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function get_product($sid, $pid)
	{
		$sql =  "SELECT p.*, cat.name AS gemstone FROM gem_products p
				   INNER JOIN gem_stores AS s ON s.id = p.store_id AND s.status <> 2	
				   INNER JOIN ofo_categories AS cat ON cat.id = p.category_id AND cat.status <> 2	
				   INNER JOIN gem_gemstone_species AS gs ON gs.id = p.gemspecies_id AND gs.status <> 2	
				   WHERE 
				   p.id = ".$this->db->escape($pid)." AND 
				   p.store_id = ".$this->db->escape($sid)." AND 
				   p.status <> 2
				   ORDER BY p.id DESC";
		$query = $this->db->query($sql);
		$row = $query->row();		
		return $row;	
	}
}
