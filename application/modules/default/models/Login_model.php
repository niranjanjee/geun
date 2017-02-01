<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function __construct(){
		parent::__construct();		
	}
		public function check_user($username)
	{
		$this->db->select("*");
		$this->db->from("ofo_users");
		$this->db->where("email", $username);
		$query = $this->db->get();
		$row = $query->row();
		if(count($row) > 0)
		{
			return "S";
		}
		else
		{
			return "F";
		}
	}
		public function getID($email)
	{
		$this->db->select("u.*");		
		$this->db->from("ofo_users u");
		$this->db->where("u.email", $email);	
		$query = $this->db->get();
		$row = $query->row();		
		return $row;
	}
	public function changepassword($npass,$userID)
	{
    	$hash = password_hash($npass, PASSWORD_DEFAULT); 
		$data = array();
		    $data = array(
                "password" => $hash
            );
		$this->db->where('id', $userID);
        if($this->db->update('ofo_users', $data))
		{
		    return true;
		}
		else
		{
		    return false;
		}
	}
	public function check_login($email, $password)
	{
		$this->db->select("u.*");
		$this->db->from("ofo_users u");
		$this->db->where("u.email", $email);
		$this->db->where("u.status", 1);
		$this->db->order_by("u.id", "DESC");
		$this->db->limit(1);
		$query = $this->db->get();
		$row = $query->row();
		//echo $this->db->last_query();
		if(count($row) > 0)
		{
			//$hash = password_hash($row->password, PASSWORD_DEFAULT);
			if (password_verify($password, $row->password)) 
			{
				return $row;
			} 
			else 
			{
				return false;
			}
		}else{
			return false;
		}
	}
	
	public function save_user($data, $id = 0)
	{
		if($id > 0)
		{
			$this->db->where("id", $id);
			$this->db->update("ofo_users", $data);
		}
		else
		{
			$this->db->insert("ofo_users", $data);
			$id = $this->db->insert_id();
		}
		return $id;
	}
	
	public function get_user($id, $status = 1, $token = null){
		$this->db->select("u.*");
		$this->db->from("ofo_users u");
		$this->db->where("u.id", $id);
		if($token != null)
		{
			$this->db->where("u.token", $token);
		}
		$this->db->where("u.status", $status);
		$this->db->order_by("u.id", "DESC");
		$this->db->limit(1);
		$query = $this->db->get();
		$row = $query->row();
		return $row;
	}
}
