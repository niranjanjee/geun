<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store_model extends CI_Model {

	public function __construct(){
		parent::__construct();		
	}
	
	/***********************************My Account Section***************************************/
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
	
	public function get_store($id, $fields = "s.*"){
		$this->db->select($fields);
		$this->db->from("gem_stores s");
		$this->db->where("s.id", $id);
		$this->db->where("s.status <>", "2");
		$this->db->order_by("s.id", "DESC");
		$this->db->limit(1);
		$query = $this->db->get();
		$row = $query->row();
		//echo $this->db->last_query();die;
		return $row;
	}
	
	public function is_valid_user_store($store_id, $user_id)
	{
		$this->db->select("COUNT(s.id) AS total");
		$this->db->from("gem_stores s");
		$this->db->where("s.id", $store_id);
		$this->db->where("s.user_id", $user_id);
		$this->db->order_by("s.id", "DESC");
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
	
	public function is_valid_user_store_product($store_id, $user_id, $pid)
	{
		$this->db->select("COUNT(p.id) AS total");
		$this->db->from("gem_products p");
		$this->db->join("gem_stores s", "p.store_id = s.id", "inner");
		$this->db->where("p.id", $pid);
		$this->db->where("s.id", $store_id);
		$this->db->where("s.user_id", $user_id);
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
	
	public function get_product($sid, $pid)
	{
		$sql =  "SELECT p.*, cat.name AS gemstone FROM gem_products p
				   INNER JOIN gem_stores AS s ON s.id = p.store_id AND s.status <> 2	
				   INNER JOIN ofo_categories AS cat ON cat.id = p.category_id AND cat.status = 1	
				   INNER JOIN gem_gemstone_species AS gs ON gs.id = p.gemspecies_id AND gs.status = 1					   	
				   WHERE 
				   p.id = ".$this->db->escape($pid)." AND 
				   p.store_id = ".$this->db->escape($sid)." AND 
				   p.status <> 2
				   ORDER BY p.id DESC";
		$query = $this->db->query($sql);
		$row = $query->row();		
		return $row;	
	}
	
	public function get_products($limit = 1, $limitstart = '-1', $filters = array())
	{
		$sql = "";
		if($limitstart >= 0){
			$sql =  "SELECT p.id, p.title, p.store_id, p.weight, p.height, p.width, p.length, p.status, pg.name AS file_name,
			        cat.name AS gemstone, gs.name AS gemstone_species";
		}else{
			$sql =  "SELECT COUNT(p.id) AS total_products";							
		}
		$sql .= " FROM gem_products p
					INNER JOIN gem_stores AS s ON s.id = p.store_id AND s.status <> 2	
					INNER JOIN ofo_categories AS cat ON cat.id = p.category_id AND cat.status = 1	
					INNER JOIN gem_gemstone_species AS gs ON gs.id = p.gemspecies_id AND gs.status = 1
					LEFT JOIN gem_product_gallery AS pg ON p.id = pg.product_id AND pg.is_primary = 1
				WHERE p.status <> 2 AND user_id = ".$this->db->escape($filters['loggedin_userid']);
		
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
	
	public function get_total_product_gallery($pid)
	{
		$this->db->select("COUNT(pg.id) AS total");
		$this->db->from("gem_product_gallery pg");
		$this->db->where("pg.product_id", $pid);
		$this->db->order_by("pg.id", "DESC");
		$this->db->limit(1);
		$query = $this->db->get();
		$row = $query->row();
		return $row->total;
	}
	
	public function save_product_gallery($data, $id = 0)
	{
		if($id > 0)
		{
			$this->db->where("id", $id);
			$this->db->update("gem_product_gallery", $data);
		}
		else
		{
			$this->db->insert("gem_product_gallery", $data);
			$id = $this->db->insert_id();
		}
		//echo $this->db->last_query();die;
		return $id;
	}
	
	
	public function update_product_gallery_bypid($data, $pid)
	{
		$this->db->where("product_id", $pid);
		$this->db->update("gem_product_gallery", $data);		
		return $pid;
	}
	
	public function delete_product_gallery($gid, $pid)
	{
		$this->db->where("id", $gid);
		$this->db->where("product_id", $pid);
		if($this->db->delete("gem_product_gallery"))
		{
			return true;
		}
		else
		{
			return false;
		}	
	} 
	
	public function get_product_gallery($pid, $is_primary = false)
	{
		$this->db->select("pg.*");
		$this->db->from("gem_product_gallery pg");
		$this->db->where("pg.product_id", $pid);
		if($is_primary)
		{
			$this->db->where("pg.is_primary", 1);
		}
		$this->db->order_by("pg.id", "DESC");
		$query = $this->db->get();
		$rows = $query->result();
		return $rows;
	}
	
	public function get_product_gallery_byid($gid, $pid = 0)
	{
		$this->db->select("pg.*");
		$this->db->from("gem_product_gallery pg");
		if($pid > 0)
		{
			$this->db->where("pg.product_id", $pid);		
		}
		$this->db->where("pg.id", $gid);		
		$this->db->order_by("pg.id", "DESC");
		$this->db->limit(1);
		$query = $this->db->get();
		
		$row = $query->row();
		return $row;
	}
	
	
	/***********************************End My Account Section***************************************/
	
	public function is_product_exist($pid)
	{
		$sql = "SELECT COUNT(p.id) AS total	FROM gem_products p		   	
				   WHERE 
				   p.id = ".$this->db->escape($pid);
		$query = $this->db->query($sql);
		$row = $query->row();
		if($row->total > 0){
			return true;
		}
		else	
		{
			return false;
		}
	}
	
	
	public function get_product_byid($pid)
	{
		$sql =  "SELECT p.*, s.name AS store_name, s.logo, s.payment_options, cat.name AS gemstone, 
				   gsh.name AS shape, ct.name AS cutting, 
				   tr.name AS treatment, cl.name AS clarity, 
				   ts.name AS transparency, gc.name AS certificate, 
				   of.name AS offer, cn.country_name, st.state_name
				   FROM gem_products p	
				   INNER JOIN gem_stores AS s ON s.id = p.store_id AND s.status = 1	
				   INNER JOIN ofo_categories AS cat ON cat.id = p.category_id AND cat.status = 1	
				   INNER JOIN gem_gemstone_species AS gs ON gs.id = p.gemspecies_id AND gs.status = 1					   	
				   LEFT JOIN gem_shapes AS gsh ON gsh.id = p.shape AND gsh.status = 1
				   LEFT JOIN gem_cuttings AS ct ON ct.id = p.cutting AND ct.status = 1
				   LEFT JOIN gem_treatments AS tr ON tr.id = p.treatment AND tr.status = 1
				   LEFT JOIN gem_clarities AS cl ON cl.id = p.clarity AND cl.status = 1
				   LEFT JOIN gem_transparency AS ts ON ts.id = p.transparency AND ts.status = 1
				   LEFT JOIN gem_certificates AS gc ON gc.id = p.certificate AND gc.status = 1
				   LEFT JOIN gem_offers AS of ON of.id = p.offer_id AND of.status = 1
				   LEFT JOIN gem_country AS cn ON cn.id = p.country_id AND cn.status = 1
				   LEFT JOIN gem_states AS st ON st.id = p.state_id AND st.status = 1
				   WHERE 
				   p.id = ".$this->db->escape($pid)."  AND
				   p.status = 1
				   ORDER BY p.id DESC LIMIT 1";
		$query = $this->db->query($sql);
		$row = $query->row();		
		return $row;	
	}
	
}
