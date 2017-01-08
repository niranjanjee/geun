<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_controller {

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
		$this->load->model('admin/category_model');		
	}
	
	public function index($page = 1)
	{
		$data = array();
		$filters = array();
		$filters['search'] = $data['search'] = html_escape(trim($this->input->get("search")));
		$filters['status'] = $data['status'] = html_escape(trim($this->input->get("status")));
		
		$total_cat = $this->category_model->get_categories(1, "-1", $filters);//Get count data
		$total_cat = $total_cat[0]->total_cat;
		
		$pagination_admin = $this->config->item('pagination_admin');
		$pagination_admin['base_url'] = base_url().'admin/category/index';
		$pagination_admin['total_rows'] = $total_cat;		
		$pagination_admin['per_page'] = 50;
		$pagination_admin['uri_segment'] = 4;
		
		$this->pagination->initialize($pagination_admin);
		
		$limitstart = '0';
		if(isset($page) && $page > 1){
			$limitstart = ($pagination_admin['per_page'] * $page) - $pagination_admin['per_page']; 
        }
		$categories = $this->category_model->get_categories($pagination_admin['per_page'], $limitstart, $filters);//fetch all data
		$data['categories'] = $categories;
        $data['pagination'] = $this->pagination->create_links();
		$this->template->content->view('category/category_view', $data);
        $this->template->publish();
	}
	
	public function addcategory($id = 0)
	{
		$data = array();
		if($this->input->post()){
			$id = (int) $this->input->post('catid');
			$this->form_validation->set_error_delimiters('<label class="error">', '</label>');	
			$this->form_validation->set_rules('name', 'Name', 'trim|required|callback_is_unique_cat|xss_clean');
			$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
			
			if ($this->form_validation->run() == true)
			{
				$data['name'] = $this->input->post('name');
				$data['status'] = $this->input->post('status');	
				if($id > 0)
				{
					$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
				}
				else
				{
					$data['created_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
				}
				$catid = $this->category_model->save_category($data, $id);
				if($catid > 0){
					$this->session->set_flashdata('saveadmincat_msg', 'Category has been saved successfully.');
					$this->session->set_flashdata('saveadmincat_class', 'alert-success');
				}else{
					$this->session->set_flashdata('saveadmincat_msg', 'Some technical error occur.');
					$this->session->set_flashdata('saveadmincat_class', 'alert-danger');
				}
				redirect('/admin/category');
			}
			else
			{
				$data['name'] = $this->input->post('name');	
				$data['status'] = $this->input->post('status');	
				$data['catid'] = $id;	
			}
		}else{
			if($id > 0){
				$data['category'] = $this->category_model->get_category($id);
				$data['status'] = $data['category']->status;
			}
		}
		$this->template->content->view('category/addcategory_view', $data);
        $this->template->publish();
	}
	
	public function is_unique_cat($value)
	{	
		$id = (int) $this->input->post('catid');
		$result = is_unique_value("ofo_categories", array("name" => trim($value)), $id);
		if(!$result)
		{
			$this->form_validation->set_message('is_unique_cat', 'This {field} already exists.');
			return false;
		}
		else
		{
			return true;
		}
	}
	
	public function deletecat($id)
	{	
		$data = array();
		$data['status'] = 2;
		$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
		$result = $this->category_model->delete_category($id, $data);
		if($result){
			$this->session->set_flashdata('saveadmincat_msg', 'Category has been deleted successfully.');
			$this->session->set_flashdata('saveadmincat_class', 'alert-success');
		}else{
			$this->session->set_flashdata('saveadmincat_msg', 'Some technical error occur.');
			$this->session->set_flashdata('saveadmincat_class', 'alert-danger');
		}
		redirect('/admin/category');
	}
	
}
