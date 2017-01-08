<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminusers extends CI_controller {

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

		$this->load->model('admin/adminusers_model');		
	}
	
	
	public function index($page = 1)
	{
		$data = array();
		$admin_users = $this->adminusers_model->get_admin_users();//Get count data
		$total_admin_users = $admin_users[0]->total_admin_users;
		
		$pagination_admin = $this->config->item('pagination_admin');
		$pagination_admin['base_url'] = base_url().'admin/adminusers';
		$pagination_admin['total_rows'] = $total_admin_users;
		$pagination_admin['per_page'] = $limit = 20;
		$this->pagination->initialize($pagination_admin);
		$limitstart = '0';
		if(isset($page) && $page > 1){
			$limitstart = ($limit * $page) - $limit; 
        }
		$admin_users = $this->adminusers_model->get_admin_users($limitstart, $limit, array());//fetch all data
		$data['admin_users'] = $admin_users;
        $data['pagination'] = $this->pagination->create_links();
		$this->template->content->view('adminusers/adminusers_view', $data);
        $this->template->publish();
	}
	
	public function adduser($id = 0)
	{
		$data = array();
		if($this->input->post()){
			$id = (int) $this->input->post('adminid');
			$this->form_validation->set_error_delimiters('<label class="error">', '</label>');	
			$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules('contact', 'Contact No.', 'trim|required|min_length[10]|is_natural|xss_clean');
			$this->form_validation->set_rules('username', 'Username', 'trim|required|callback_is_unique_username|xss_clean');
			if($id == 0)
			{
				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|xss_clean');
				$this->form_validation->set_rules('confpassword', 'Confirm Password', 'trim|required|min_length[5]|matches[password]|xss_clean');
			}
			
			if ($this->form_validation->run() == true)
			{
				$data['name'] = $this->input->post('name');
				$data['email'] = $this->input->post('email');
				$data['contact'] = $this->input->post('contact');
				$data['username'] = $this->input->post('username');
				$password = $this->input->post('password'); 			
				$data['status'] = $this->input->post('status');
				if($id > 0)
				{
					$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
					$data['updated_by'] = $this->session->adminuser['id'];
					if($password != "")
					{
						$data['password'] = password_hash($password, PASSWORD_DEFAULT);
					}
				}
				else
				{
					$data['password'] = password_hash($password, PASSWORD_DEFAULT);
					$data['create_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
					$data['created_by'] = $this->session->adminuser['id'];
				}
				$adminid = $this->adminusers_model->save_admin_user($data, $id);
				if($adminid > 0){
					$this->session->set_flashdata('saveadminuser_msg', 'User has been saved successfully.');
					$this->session->set_flashdata('saveadminuser_class', 'alert-success');
				}else{
					$this->session->set_flashdata('saveadminuser_msg', 'Some technical error occur.');
					$this->session->set_flashdata('saveadminuser_class', 'alert-danger');
				}
				redirect('/admin/adminusers');
			}
			else
			{
				$data['name'] = $this->input->post('name');
				$data['email'] = $this->input->post('email');
				$data['contact'] = $this->input->post('contact');
				$data['username'] = $this->input->post('username');		
				$data['status'] = $this->input->post('status');	
				$data['adminid'] = $id;	
			}
		}else{
			if($id > 0){
				$data['adminuser'] = $this->adminusers_model->get_admin_user($id);
				$data['status'] = $data['adminuser']->status;
			}
		}
		$this->template->content->view('adminusers/adduser_view', $data);
        $this->template->publish();
	}
	
	public function is_unique_username($value)
	{	
		$id = (int) $this->input->post('adminid');
		$result = $this->adminusers_model->is_unique_value("admin_users", array("username" => $value), $id);
		if(!$result)
		{
			$this->form_validation->set_message('is_unique_username', 'This {field} already exists.');
			return false;
		}
		else
		{
			return true;
		}
	}
	
	public function deleteuser($id)
	{	
		$data = array();
		$data['status'] = 2;
		$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
		$data['updated_by'] = $this->session->adminuser['id'];
		$result = $this->adminusers_model->delete_admin_user($id, $data);
		if($result){
			$this->session->set_flashdata('saveadminuser_msg', 'User has been deleted successfully.');
			$this->session->set_flashdata('saveadminuser_class', 'alert-success');
		}else{
			$this->session->set_flashdata('saveadminuser_msg', 'Some technical error occur.');
			$this->session->set_flashdata('saveadminuser_class', 'alert-danger');
		}
		redirect('/admin/adminusers');
	}
	
}
