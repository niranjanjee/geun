<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_controller {

	private $current_date_obj = null;
	public function __construct(){
		parent::__construct();
		if(!isset($this->session->adminuser['id'])){
			redirect('/admin');
			die;	
		}
		$this->current_date_obj = new DateTime();
		$this->template->set_template('layout/layout');
		$this->template->section = 'Admin management';	
		$this->load->helper('Admin');	
		$this->load->model('admin/users_model');		
	}
	
	public function index($page = 1)
	{
		$data = array();
		$filters = array();
		$filters['search'] = $data['search'] = html_escape(trim($this->input->get("search")));
		$filters['status'] = $data['status'] = html_escape(trim($this->input->get("status")));
		
		$total_users = $this->users_model->get_users(1, "-1", $filters);//Get count data
		$total_users = $total_users[0]->total_users;
		
		$pagination_admin = $this->config->item('pagination_admin');
		$pagination_admin['base_url'] = base_url().'admin/users/index';
		$pagination_admin['total_rows'] = $total_users;		
		$pagination_admin['per_page'] = 5;
		$pagination_admin['uri_segment'] = 4;
		
		$this->pagination->initialize($pagination_admin);
		
		$limitstart = '0';
		if(isset($page) && $page > 1){
			$limitstart = ($pagination_admin['per_page'] * $page) - $pagination_admin['per_page']; 
        }
		$users = $this->users_model->get_users($pagination_admin['per_page'], $limitstart, $filters);//fetch all data
		$data['users'] = $users;
        $data['pagination'] = $this->pagination->create_links();
		$this->template->content->view('users/users_view', $data);
        $this->template->publish();
	}
	
	public function changestatus($id, $status)
	{
		$data = array();
		$id = (int) $id;
		$status = (int) $status;
		if($status == 0)
		{
			$data['status'] = 1;
		}
		else if	($status == 1)
		{
			$data['status'] = 0;
		}	
		$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
		$result = $this->users_model->update_user_status($id, $data);
		if($result)
		{
			$this->session->set_flashdata("user_msg", "User's status has been changed successfully.");
			$this->session->set_flashdata("user_msg_class", "alert-success");
		}else{
			$this->session->set_flashdata("user_msg", "Some technical error occur.");
			$this->session->set_flashdata("user_msg_class", "alert-danger");
		}
		redirect('/admin/users');
	}
	
	public function deleteuser($id)
	{	
		$data = array();
		$data['status'] = 2;
		$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
		$result = $this->users_model->update_user_status($id, $data);
		if($result){
			$this->session->set_flashdata('user_msg', 'User has been deleted successfully.');
			$this->session->set_flashdata('user_msg_class', 'alert-success');
		}else{
			$this->session->set_flashdata('user_msg', 'Some technical error occur.');
			$this->session->set_flashdata('user_msg_class', 'alert-danger');
		}
		redirect('/admin/users');
	}
}
