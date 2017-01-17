<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_model extends CI_Model {

	public function __construct(){
		parent::__construct();		
	}
		
	public function get_categories()
	{
		$this->db->select("c.id, c.name");		
		$this->db->from("ofo_categories c");
		$this->db->where("c.status", "1");
		$this->db->order_by("c.name", "ASC");
		$query = $this->db->get();
		$rows = $query->result();		
		//echo $this->db->last_query();
		return $rows;
	}
	function lookup($keyword){
	
	
	
        $this->db->select('*')->from('ofo_categories');
        $this->db->like('name',$keyword,'after');
        $query = $this->db->get();    
          
        return $query->result();
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
			$this->db->select('*');
		    $this->db->from('ofo_sub_categories');
            $this->db->where('category_id',$row->id);
            $query1 = $this->db->get();
			$j =0;
			foreach($query1->result() as $row1)
			{
			   $infoArr[$i]['name1'] = $row1->name;
			}
			
			
			$i++;
			  
		}
		return $infoArr;
	}     
        /* Niranjan 05-Jan-2017 */
        public function get_gems_categories()
	{
		$this->db->select("c.id, c.name");		
		$this->db->from("gem_categories c");
		$this->db->where("c.status", "1");
        $this->db->where("c.parent_id", "0");
		$this->db->order_by("c.name", "ASC");
		$query = $this->db->get();
		$rows = $query->result();		
		//echo $this->db->last_query();
		return $rows;
	}
        
        public function get_gemstones_bycid($cid)
        {
            $sql =  "SELECT p.id, p.title, p.store_id, p.gemstone_price, p.status, cat.name AS cat_name, pg.name as image";
            $sql .= " FROM gem_products p
					INNER JOIN gem_stores AS s ON s.id = p.store_id AND s.status = 1	
					INNER JOIN ofo_categories AS cat ON cat.id = p.category_id AND cat.status = 1	
					LEFT JOIN gem_product_gallery AS pg ON p.id = pg.product_id AND pg.is_primary = 1
				WHERE p.status = 1 AND p.category_id='$cid'";
            
            //echo $sql; exit;
            $query = $this->db->query($sql);
		$rows = $query->result();	
		//echo $this->db->last_query();
		return $rows;
        }   
        
        function category_by_subcatname($subcname)
        {
            $sql="SELECT category_id FROM ofo_sub_categories WHERE name='$subcname'";
            return $query = $this->db->query($sql)->row()->category_id;
        }
        
        function categoryname_by_id($cid)
        {
            $sql="SELECT name FROM ofo_categories WHERE id='$cid'";
            return $query = $this->db->query($sql)->row()->name;
        }

        public function get_gemstones($limit = 1, $limitstart = '-1', $filters = array())
	{
		$sql = "";
		if($limitstart >= 0){
			$sql =  "SELECT p.id, p.title, p.store_id, p.gemstone_price, p.status, cat.name AS cat_name, pg.name as image";
		}else{
			$sql =  "SELECT COUNT(p.id) AS total_products";							
		}
		$sql .= " FROM gem_products p
					INNER JOIN gem_stores AS s ON s.id = p.store_id AND s.status = 1	
					INNER JOIN ofo_categories AS cat ON cat.id = p.category_id AND cat.status = 1	
					LEFT JOIN gem_product_gallery AS pg ON p.id = pg.product_id AND pg.is_primary = 1
				WHERE p.status = 1";
		if(count($filters) > 0)
		{
			if(isset($filters['keyword']) && $filters['keyword'] != ""){
				$sql .= " AND p.title LIKE '%".$filters['keyword']."%' OR cat.name LIKE '%".$filters['keyword']."%'";
			}
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
	
	public function get_best_seller_gemstones()
	{
		$sql =  "SELECT p.id, p.title, p.store_id, p.gemstone_price, p.status, cat.name AS cat_name, pg.name as image";		
		$sql .= " FROM gem_products p
					INNER JOIN gem_stores AS s ON s.id = p.store_id AND s.status = 1	
					INNER JOIN ofo_categories AS cat ON cat.id = p.category_id AND cat.status = 1	
					LEFT JOIN gem_product_gallery AS pg ON p.id = pg.product_id AND pg.is_primary = 1
					WHERE p.status = 1 AND p.is_best_seller = 1";			
		$sql .= " ORDER BY p.id DESC LIMIT 8";
		
		$query = $this->db->query($sql);
		$rows = $query->result();	
		//echo $this->db->last_query();
		return $rows;
	}
	
	public function get_other_gemstones()
	{
		$sql =  "SELECT p.id, p.title, p.store_id, p.gemstone_price, p.status, cat.name AS cat_name, pg.name as image";		
		$sql .= " FROM gem_products p
					INNER JOIN gem_stores AS s ON s.id = p.store_id AND s.status = 1	
					INNER JOIN ofo_categories AS cat ON cat.id = p.category_id AND cat.status = 1	
					LEFT JOIN gem_product_gallery AS pg ON p.id = pg.product_id AND pg.is_primary = 1
					WHERE p.status = 1 AND p.is_best_seller = 1";			
		$sql .= " ORDER BY p.id DESC LIMIT 8";
		
		$query = $this->db->query($sql);
		$rows = $query->result();	
		//echo $this->db->last_query();
		return $rows;
	}
	
	public function get_featured_stores()
	{
		$sql =  "SELECT s.id, s.logo, s.name, s.address, s.city, st.state_name, st.state_code, c.country_name";		
		$sql .= " FROM gem_stores AS s JOIN gem_country AS c ON c.id = s.country_id AND c.status = 1";
		$sql .= " JOIN gem_states AS st ON st.id = s.state_id AND st.status = 1";
		$sql .= " WHERE s.status = 1 AND s.is_featured = 1";		
		$sql .= " ORDER BY s.id DESC LIMIT 4";
		
		$query = $this->db->query($sql);
		$rows = $query->result();	
		//echo $this->db->last_query();
		return $rows;
	}
	
}
