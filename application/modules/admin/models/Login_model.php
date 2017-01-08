<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function __construct(){
		parent::__construct();		
	}
	
	public function check_login($username, $password){
		$this->db->select("au.*");
		$this->db->from("admin_users au");
		$this->db->where("au.username", $username);
		$this->db->where("au.status", 1);
		$this->db->order_by("au.id", "DESC");
		$this->db->limit(1);
		$query = $this->db->get();
		$row = $query->row();
		if(count($row) > 0){
			if (password_verify($password, $row->password)) {
				return $row;
			} else {
				return false;
			}
		}else{
			return false;
		}
	}
}
