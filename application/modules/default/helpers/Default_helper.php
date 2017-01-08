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

if ( ! function_exists('send_mail'))
{
	function send_mail($to, $subject, $message, $cc = '', $bcc = '')
	{
		$ci =& get_instance();
		$ci->load->library('email');
		
		$ci->email->from($ci->config->item('from_email'), $ci->config->item('from_name'));
		$ci->email->to($to);
		$ci->email->subject($subject);
		$ci->email->message($message);
		if($cc != ""){
			$this->email->cc($cc);
		}
		if($bcc != ""){
			$this->email->bcc($bcc);
		}		
		$ci->email->set_mailtype('html');
		$ci->email->send();
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

if ( ! function_exists('get_date_format'))
{
	function get_date_format($date = null, $format = "m-d-Y")
	{	
		$current_date_obj = new DateTime($date);
		return $current_date_obj->format($format);
	}
}

if ( ! function_exists('set_total_viewed'))
{
	function set_total_viewed($pid)
	{
		$ci=& get_instance();
        $ci->load->database(); 
		
		$product = get_table_record("gem_products", $pid, "total_viewed");
		$total_viewed = $product->total_viewed + 1;
		$ci->db->where("id", $pid);
		$ci->db->update("gem_products", array("total_viewed" => $total_viewed));	
	}
}






