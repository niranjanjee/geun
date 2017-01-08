<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message_model extends CI_Model {

	public function __construct(){
		parent::__construct();		
	}
	
	
	public function save_message($data, $cond = array())
	{
		if(count($cond) > 0)
		{
			$this->db->where($cond);
			$this->db->update("gem_messages", $data);
			$id = $cond['id'];
		}
		else
		{
			$this->db->insert("gem_messages", $data);
			$id = $this->db->insert_id();
		}
		//echo $this->db->last_query();die;
		return $id;
	}
		
	public function get_message($mid, $sender_id, $receiver_id)
	{
		$sql = "SELECT m.*, s.name AS sender, r.name AS reciever FROM gem_messages m 
				INNER JOIN ofo_users AS s ON s.id = m.sender_id AND s.status = 1	
				INNER JOIN ofo_users AS r ON r.id = m.receiver_id AND r.status = 1	
				WHERE m.status = 1 AND ";
		$sql .= "m.id = ".$this->db->escape($mid)." AND 
			   m.sender_id = ".$this->db->escape($sender_id)." AND 
			   m.receiver_id = ".$this->db->escape($receiver_id)." 
			   ORDER BY m.id DESC";
		
		//echo $sql;
		$query = $this->db->query($sql);
		$row = $query->row();		
		return $row;	
	}
	
	public function get_messages($limit = 1, $limitstart = '-1', $filters = array())
	{
		$sql = "";
		if($limitstart >= 0){
			$sql =  "SELECT m.*, s.name AS sender, r.name AS reciever";
		}else{
			$sql =  "SELECT COUNT(m.id) AS total_messages";							
		}
		$sql .= " FROM gem_messages m
					INNER JOIN ofo_users AS s ON s.id = m.sender_id AND s.status = 1	
					INNER JOIN ofo_users AS r ON r.id = m.receiver_id AND r.status = 1	
				WHERE m.status = 1 AND (m.receiver_id = ".$this->db->escape($this->session->user['id'])." OR m.sender_id = ".$this->db->escape($this->session->user['id']).")";
		
			/*if(isset($filters['search']) && $filters['search'] != ""){
				$sql .= " AND (m.created_at <= ".$this->db->escape("%".$filters['search']."%")." 
				OR p.weight LIKE ".$this->db->escape("%".$filters['search']."%")."
				OR gs.name LIKE ".$this->db->escape("%".$filters['search']."%").")";
			}*/	
			
			$sql .= " ORDER BY m.id DESC ";
			if($limitstart >= 0){
				$sql .= " LIMIT ".$limitstart.", ".$limit;
			}
		$query = $this->db->query($sql);
		$rows = $query->result();	
		//echo $this->db->last_query();
		return $rows;
	}
	
	public function is_valid_reciever($mid, $sender_id, $receiver_id)
	{
		$this->db->select("COUNT(m.id) AS total");
		$this->db->from("gem_messages m");
		$this->db->where("m.id", $mid);
		$this->db->where("m.sender_id", $sender_id);
		$this->db->where("m.receiver_id",$receiver_id);
		
		$this->db->where("m.status", 1);
		$this->db->order_by("m.id", "DESC");
		$this->db->limit(1);
		$query = $this->db->get();
		$row = $query->row();
		//echo $this->db->last_query();
		if($row->total > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function get_total_messages($pid)
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
	
	
	public function get_wishlists($limit = 1, $limitstart = '-1', $filters = array())
	{
		$sql = "";
		if($limitstart >= 0){
			$sql =  "SELECT w.*, s.id AS store_id, cat.name AS product_name, p.gemstone_price, p.height, p.width, p.length, pg.name AS file_name, gs.name AS gemstone_species";
		}else{
			$sql =  "SELECT COUNT(w.id) AS total_wishlist";							
		}
		$sql .= " FROM gem_whishlist w
					INNER JOIN gem_products AS p ON p.id = w.product_id AND p.status <> 2
					INNER JOIN gem_stores AS s ON s.id = p.store_id AND s.status <> 2
					INNER JOIN ofo_categories AS cat ON cat.id = p.category_id AND cat.status <> 2
					INNER JOIN gem_gemstone_species AS gs ON gs.id = p.gemspecies_id AND gs.status <> 2
					INNER JOIN ofo_users AS u ON u.id = w.user_id AND u.status = 1	
					LEFT JOIN gem_product_gallery AS pg ON pg.product_id = p.id AND is_primary = 1
				WHERE w.status = 1";
		
			/*if(isset($filters['search']) && $filters['search'] != ""){
				$sql .= " AND (m.created_at <= ".$this->db->escape("%".$filters['search']."%")." 
				OR p.weight LIKE ".$this->db->escape("%".$filters['search']."%")."
				OR gs.name LIKE ".$this->db->escape("%".$filters['search']."%").")";
			}*/	
			
			$sql .= " ORDER BY w.id DESC ";
			if($limitstart >= 0){
				$sql .= " LIMIT ".$limitstart.", ".$limit;
			}
		$query = $this->db->query($sql);
		$rows = $query->result();	
		//echo $this->db->last_query();
		return $rows;
	}
	
	public function is_valid_wishlist($user_id, $wishid, $product_id)
	{
		$this->db->select("COUNT(w.id) AS total");
		$this->db->from("gem_whishlist w");
		$this->db->where("w.id", $wishid);
		$this->db->where("w.user_id", $user_id);
		$this->db->where("w.product_id",$product_id);
		
		$this->db->where("w.status", 1);
		$this->db->order_by("w.id", "DESC");
		$this->db->limit(1);
		$query = $this->db->get();
		$row = $query->row();
		//echo $this->db->last_query();
		if($row->total > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function save_wishlist($data, $cond = array())
	{
		if(count($cond) > 0)
		{
			$this->db->where($cond);
			$this->db->update("gem_whishlist", $data);
			$id = $cond['id'];
		}
		else
		{
			$this->db->insert("gem_whishlist", $data);
			$id = $this->db->insert_id();
		}
		//echo $this->db->last_query();die;
		return $id;
	}

}
