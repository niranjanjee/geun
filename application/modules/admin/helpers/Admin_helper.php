<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if ( ! function_exists('is_unique_value'))
{
	function is_unique_value($table_name, $criteria, $id = 0)
	{
		$ci=& get_instance();
        $ci->load->database(); 
		
		$ci->db->select("COUNT(id) AS total");		
		$ci->db->from($table_name);
		if($id > 0){
			$ci->db->where($table_name.".id <>", $id);	
		}	
		$ci->db->where($criteria);	
		$ci->db->order_by($table_name.".id", "DESC");
		$query = $ci->db->get();
		$row = $query->row();		
		//echo $ci->db->last_query();
		if($row->total > 0){
			return false;
		}else{
			return true;
		}
	}
}

// A general function to manage with pagination
if ( ! function_exists('get_table_pagination'))
{
	function get_table_pagination($table_name, $alias, $limit = 1, $limitstart = '-1', $filters = array())
	{
		$ci=& get_instance();
        $ci->load->database(); 
		
		if($limitstart >= 0){
			$ci->db->select($alias.".*");
		}else{
			$ci->db->select("COUNT(".$alias.".id) AS total_".$alias);
		}
		$ci->db->from($table_name." ".$alias);
		$ci->db->where($alias.".status <>", "2");	
		if(isset($filters['search']) && $filters['search'] != ""){
			$ci->db->where("(".$alias.".name LIKE ".$ci->db->escape("%".$filters['search']."%").")");
		}

		if(isset($filters['status']) && $filters['status'] !== ""){
			$ci->db->where($alias.".status", $filters['status']);
		}
		$ci->db->order_by($alias.".id", "DESC");
		if($limitstart >= 0){
			$ci->db->limit($limit, $limitstart);
		}
		$query = $ci->db->get();
		$rows = $query->result();		
		//echo $ci->db->last_query();
		return $rows;
	}
}	

if ( ! function_exists('delete_record'))
{
	function delete_record($table_name, $id, $data)
	{
		$ci=& get_instance();
        $ci->load->database(); 
		
		$ci->db->where("id", $id);
		if($ci->db->update($table_name, $data)){
			return true;
		}else{
			return false;
		}
	}
}

if ( ! function_exists('save_record'))
{
	function save_record($table_name, $data, $cond = array()){
		$ci=& get_instance();
        $ci->load->database(); 
		
		if(count($cond) > 0){
			$ci->db->where($cond);
			if($ci->db->update($table_name, $data))
			{
				return true;
			}
		}else{
			$ci->db->insert($table_name, $data);
			$id = $ci->db->insert_id();
			return $id;	
		}		
	}
}

if ( ! function_exists('get_table_record'))
{
	function get_table_record($table_name, $id = 0, $fields = "*", $criteria = array(), $order_by_field = "id", $order_by = "DESC")
	{
		$ci=& get_instance();
        $ci->load->database(); 
		
		$ci->db->select($fields);				
		$ci->db->from($table_name);
		if($id > 0)
		{
			$ci->db->where("id", $id);	
		}	
		if(count($criteria) > 0){
			$ci->db->where($criteria);	
		}
		$ci->db->order_by($order_by_field, $order_by);
		$query = $ci->db->get();
		//echo $ci->db->last_query();
		if($id > 0)
		{
			return $query->row();		
		}
		else
		{
			return $query->result();		
		}
	}
}

if ( ! function_exists('create_slug'))
{
	function create_slug($string)
	{	
		$CI =& get_instance();
		$CI->load->helper(array('text', 'string'));
		
		$string = strtolower(url_title(convert_accented_characters($string), '-'));
		return reduce_multiples($string, '-', TRUE);
	}
}