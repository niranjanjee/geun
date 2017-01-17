<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Storesettings extends CI_controller {

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
		$this->load->model('admin/storesettings_model');		
	}
	
	public function category($page = 1)
	{
		$data = array();
		$filters = array();
		$filters['search'] = $data['search'] = html_escape(trim($this->input->get("search")));
		$filters['status'] = $data['status'] = html_escape(trim($this->input->get("status")));
		
		$total_cat = $this->storesettings_model->get_categories(1, "-1", $filters);//Get count data
		$total_cat = $total_cat[0]->total_cat;
		
		$pagination_admin = $this->config->item('pagination_admin');
		$pagination_admin['base_url'] = base_url().'admin/storesettings/category';
		$pagination_admin['total_rows'] = $total_cat;		
		$pagination_admin['per_page'] = 50;
		$pagination_admin['uri_segment'] = 4;
		
		$this->pagination->initialize($pagination_admin);
		
		$limitstart = '0';
		if(isset($page) && $page > 1){
			$limitstart = ($pagination_admin['per_page'] * $page) - $pagination_admin['per_page']; 
        }
		$categories = $this->storesettings_model->get_categories($pagination_admin['per_page'], $limitstart, $filters);//fetch all data
		$data['categories'] = $categories;
        $data['pagination'] = $this->pagination->create_links();
		$this->template->content->view('storesettings/category_view', $data);
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
				$catid = $this->storesettings_model->save_category($data, $id);
				if($catid > 0){
					$this->session->set_flashdata('saveadmincat_msg', 'Category has been saved successfully.');
					$this->session->set_flashdata('saveadmincat_class', 'alert-success');
				}else{
					$this->session->set_flashdata('saveadmincat_msg', 'Some technical error occur.');
					$this->session->set_flashdata('saveadmincat_class', 'alert-danger');
				}
				redirect('/admin/storesettings/category');
			}
			else
			{
				$data['name'] = $this->input->post('name');	
				$data['status'] = $this->input->post('status');	
				$data['catid'] = $id;	
			}
		}else{

			if($id > 0){
				$data['category'] = $this->storesettings_model->get_category($id);
				$data['status'] = $data['category']->status;
			}
		}
		$this->template->content->view('storesettings/addcategory_view', $data);
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
		$id = (int) $id;
		if($id <= 0)
		{
			show_error("bad Request", 400);
		}
		$data = array();
		$data['status'] = 2;
		$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
		$result = $this->storesettings_model->delete_category($id, $data);
		if($result){
			$this->session->set_flashdata('saveadmincat_msg', 'Category has been deleted successfully.');
			$this->session->set_flashdata('saveadmincat_class', 'alert-success');
		}else{
			$this->session->set_flashdata('saveadmincat_msg', 'Some technical error occur.');
			$this->session->set_flashdata('saveadmincat_class', 'alert-danger');
		}
		redirect('/admin/storesettings/category');
	}
	
	/**************************************SUBCATEGORY**********************************/
	public function subcategory()
	{
		$data = array();
		$filters = array();
		$filters['search'] = $data['search'] = html_escape(trim($this->input->get("search")));
		$filters['status'] = $data['status'] = html_escape(trim($this->input->get("status")));
		
		$total_subcat = $this->storesettings_model->get_subcategories(1, "-1", $filters);//Get count data
		$total_subcat = $total_subcat[0]->total_subcat;
		
		$pagination_admin = $this->config->item('pagination_admin');
		$pagination_admin['base_url'] = base_url().'admin/storesettings/subcategory';
		$pagination_admin['total_rows'] = $total_subcat;		
		$pagination_admin['per_page'] = 50;
		$pagination_admin['uri_segment'] = 4;
		
		$this->pagination->initialize($pagination_admin);
		
		$limitstart = '0';
		if(isset($page) && $page > 1){
			$limitstart = ($pagination_admin['per_page'] * $page) - $pagination_admin['per_page']; 
        }
		$categories = $this->storesettings_model->get_subcategories($pagination_admin['per_page'], $limitstart, $filters);//fetch all data
		
		
		$data['subcategories'] = $categories;
        $data['pagination'] = $this->pagination->create_links();
		
		$this->template->content->view('storesettings/subcategory_view', $data);
        $this->template->publish();
	}
	
	
	public function deletesubcat($id)
	{	
		 $id = (int) $id; 
		if($id <= 0)
		{
			show_error("bad Request", 400);
		}
		$data = array();
		$data['status'] = 2;
		$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
		$result = $this->storesettings_model->delete_subcategory($id, $data);
		if($result){
			$this->session->set_flashdata('saveadmincat_msg', 'Subcategory has been deleted successfully.');
			$this->session->set_flashdata('saveadmincat_class', 'alert-success');
		}else{
			$this->session->set_flashdata('saveadmincat_msg', 'Some technical error occur.');
			$this->session->set_flashdata('saveadmincat_class', 'alert-danger');
		}
		redirect('/admin/storesettings/subcategory');
	}
	
	public function addsubcategory($id = 0)
	{
		$data = array();
		if($this->input->post()){
			$id = (int) $this->input->post('scatid');
			$this->form_validation->set_error_delimiters('<label class="error">', '</label>');	
			$this->form_validation->set_rules('name', 'Name', 'trim|required|callback_is_unique_subcat|xss_clean');
			$this->form_validation->set_rules('category', 'Category', 'required');
			$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
			if ($this->form_validation->run() == true)
			{
				$data['name'] = $this->input->post('name');
				$data['category_id'] = $this->input->post('category');
				$data['status'] = $this->input->post('status');	
				
			
				
				
				if($id > 0)
				{
					$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
					$subcatid = $this->storesettings_model->save_subcategory($data, $id);
				}
				else
				{
					$data['created_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
				}
				$subcatid = $this->storesettings_model->save_subcategory($data, $id);
				if($subcatid > 0){
					$this->session->set_flashdata('saveadmincat_msg', 'Subcategory has been saved successfully.');
					$this->session->set_flashdata('saveadmincat_class', 'alert-success');
				}else{
					$this->session->set_flashdata('saveadmincat_msg', 'Some technical error occur.');
					$this->session->set_flashdata('saveadmincat_class', 'alert-danger');
				}
				redirect('/admin/storesettings/subcategory');
			}
			else
			{
				$data['name'] = $this->input->post('name');	
				$data['status'] = $this->input->post('status');	
				$data['subcatid'] = $id;	
			}
		}else{
			if($id > 0)
			{
				$this->data['subcategory'] = $this->storesettings_model->get_subcategory($id);
				$this->data['status'] = $this->data['subcategory']->status;
			}
		}
		$this->data['category'] = $this->storesettings_model->show_category();
		
	
		
		$this->template->content->view('storesettings/addsubcategory_view', $this->data);
        $this->template->publish();
	}
	
	public function is_unique_subcat($value)
	{	
		$id = (int) $this->input->post('subcatid');
		$result = is_unique_value("gem_gemstone_species", array("name" => trim($value)), $id);
		if(!$result)
		{
			$this->form_validation->set_message('is_unique_subcat', 'This {field} already exists.');
			return false;
		}
		else
		{
			return true;
		}
	}
	/**************************************END SUBCATEGORY******************************/
	
	/**************************************SHAPES**********************************/
	public function shapes()
	{
		$data = array();
		$filters = array();
		$filters['search'] = $data['search'] = html_escape(trim($this->input->get("search")));
		$filters['status'] = $data['status'] = html_escape(trim($this->input->get("status")));
		
		$total_s = get_table_pagination("gem_shapes", "s", 1, "-1", $filters);//Get count data
		$total_s = $total_s[0]->total_s;
		
		$pagination_admin = $this->config->item('pagination_admin');
		$pagination_admin['base_url'] = base_url().'admin/storesettings/shapes';
		$pagination_admin['total_rows'] = $total_s;		
		$pagination_admin['per_page'] = 50;
		$pagination_admin['uri_segment'] = 4;
		
		$this->pagination->initialize($pagination_admin);
		
		$limitstart = '0';
		if(isset($page) && $page > 1){
			$limitstart = ($pagination_admin['per_page'] * $page) - $pagination_admin['per_page']; 
        }
		$data['shapes'] = get_table_pagination("gem_shapes", "s", $pagination_admin['per_page'], $limitstart, $filters);//fetch all data
        $data['pagination'] = $this->pagination->create_links();
		
		$this->template->content->view('storesettings/shapes_view', $data);
        $this->template->publish();
	}
	
	
	public function deleteshape($id)
	{	
		$id = (int) $id;
		if($id <= 0)
		{
			show_error("bad Request", 400);
		}
		$data = array();
		$data['status'] = 2;
		$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
		$result = delete_record("gem_shapes", $id, $data);
		if($result){
			$this->session->set_flashdata('saveshapes_msg', 'Shape has been deleted successfully.');
			$this->session->set_flashdata('saveshapes_class', 'alert-success');
		}else{
			$this->session->set_flashdata('saveshapes_msg', 'Some technical error occur.');
			$this->session->set_flashdata('saveshapes_class', 'alert-danger');
		}
		redirect('/admin/storesettings/shapes');
	}
	
	public function addshape($id = 0)
	{
		$data = array();
		if($this->input->post()){
			$id = (int) $this->input->post('shapeid');
			$this->form_validation->set_error_delimiters('<label class="error">', '</label>');	
			$this->form_validation->set_rules('name', 'Name', 'trim|required|callback_is_unique_shape|xss_clean');
			$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
			
			if ($this->form_validation->run() == true)
			{
				$cond = array();
				$data['name'] = $this->input->post('name');
				$data['status'] = $this->input->post('status');	
				if($id > 0)
				{
					$cond["id"] = $id;
					$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
				}
				else
				{
					$data['created_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
				}
				$shapeid = save_record("gem_shapes", $data, $cond);
				if($shapeid > 0){
					$this->session->set_flashdata('saveshapes_msg', 'Shape has been saved successfully.');
					$this->session->set_flashdata('saveshapes_class', 'alert-success');
				}else{
					$this->session->set_flashdata('saveshapes_msg', 'Some technical error occur.');
					$this->session->set_flashdata('saveshapes_class', 'alert-danger');
				}
				redirect('/admin/storesettings/shapes');
			}
			else
			{
				$data['name'] = $this->input->post('name');	
				$data['status'] = $this->input->post('status');	
				$data['shapeid'] = $id;	
			}
		}else{
			if($id > 0){
				$data['shape'] = get_table_record("gem_shapes", $id);
				$data['status'] = $data['shape']->status;
			}
		}
		$this->template->content->view('storesettings/addshape_view', $data);
        $this->template->publish();
	}
	
	public function is_unique_shape($value)
	{	
		$id = (int) $this->input->post('shapeid');
		$result = is_unique_value("gem_shapes", array("name" => trim($value)), $id);
		if(!$result)
		{
			$this->form_validation->set_message('is_unique_shape', 'This {field} already exists.');
			return false;
		}
		else
		{
			return true;
		}
	}
	/**************************************END SHAPES******************************/
	
	/**************************************CUTTING**********************************/
	public function cuttings()
	{
		$data = array();
		$filters = array();
		$filters['search'] = $data['search'] = html_escape(trim($this->input->get("search")));
		$filters['status'] = $data['status'] = html_escape(trim($this->input->get("status")));
		
		$total_c = get_table_pagination("gem_cuttings", "c", 1, "-1", $filters);//Get count data
		$total_c = $total_c[0]->total_c;
		
		$pagination_admin = $this->config->item('pagination_admin');
		$pagination_admin['base_url'] = base_url().'admin/storesettings/cuttings';
		$pagination_admin['total_rows'] = $total_c;		
		$pagination_admin['per_page'] = 50;
		$pagination_admin['uri_segment'] = 4;
		
		$this->pagination->initialize($pagination_admin);
		
		$limitstart = '0';
		if(isset($page) && $page > 1){
			$limitstart = ($pagination_admin['per_page'] * $page) - $pagination_admin['per_page']; 
        }
		$data['cuttings'] = get_table_pagination("gem_cuttings", "c", $pagination_admin['per_page'], $limitstart, $filters);//fetch all data
        $data['pagination'] = $this->pagination->create_links();
		
		$this->template->content->view('storesettings/cuttings_view', $data);
        $this->template->publish();
	}
	
	
	public function deletecutting($id)
	{	
		$id = (int) $id;
		if($id <= 0)
		{
			show_error("bad Request", 400);
		}
		$data = array();
		$data['status'] = 2;
		$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
		$result = delete_record("gem_cuttings", $id, $data);
		if($result){
			$this->session->set_flashdata('savecuttings_msg', 'Cutting has been deleted successfully.');
			$this->session->set_flashdata('savecuttings_class', 'alert-success');
		}else{
			$this->session->set_flashdata('savecuttings_msg', 'Some technical error occur.');
			$this->session->set_flashdata('savecuttings_class', 'alert-danger');
		}
		redirect('/admin/storesettings/cuttings');
	}
	
	public function addcutting($id = 0)
	{
		$data = array();
		if($this->input->post()){
			$id = (int) $this->input->post('cuttingid');
			$this->form_validation->set_error_delimiters('<label class="error">', '</label>');	
			$this->form_validation->set_rules('name', 'Name', 'trim|required|callback_is_unique_cutting|xss_clean');
			$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
			
			if ($this->form_validation->run() == true)
			{
				$cond = array();
				$data['name'] = $this->input->post('name');
				$data['status'] = $this->input->post('status');	
				if($id > 0)
				{
					$cond["id"] = $id;
					$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
				}
				else
				{
					$data['created_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
				}
				$shapeid = save_record("gem_cuttings", $data, $cond);
				if($shapeid > 0){
					$this->session->set_flashdata('saveshapes_msg', 'Cutting has been saved successfully.');
					$this->session->set_flashdata('saveshapes_class', 'alert-success');
				}else{
					$this->session->set_flashdata('saveshapes_msg', 'Some technical error occur.');
					$this->session->set_flashdata('saveshapes_class', 'alert-danger');
				}
				redirect('/admin/storesettings/cuttings');
			}
			else
			{
				$data['name'] = $this->input->post('name');	
				$data['status'] = $this->input->post('status');	
				$data['cuttingid'] = $id;	
			}
		}else{
			if($id > 0){
				$data['cutting'] = get_table_record("gem_cuttings", $id);
				$data['status'] = $data['cutting']->status;
			}
		}
		$this->template->content->view('storesettings/addcutting_view', $data);
        $this->template->publish();
	}
	
	public function is_unique_cutting($value)
	{	
		$id = (int) $this->input->post('cuttingid');
		$result = is_unique_value("gem_cuttings", array("name" => trim($value)), $id);
		if(!$result)
		{
			$this->form_validation->set_message('is_unique_cutting', 'This {field} already exists.');
			return false;
		}
		else
		{
			return true;
		}
	}
	/**************************************END CUTTING******************************/
	
	/**************************************clarities**********************************/
	public function clarities()
	{
		$data = array();
		$filters = array();
		$filters['search'] = $data['search'] = html_escape(trim($this->input->get("search")));
		$filters['status'] = $data['status'] = html_escape(trim($this->input->get("status")));
		
		$total_c = get_table_pagination("gem_clarities", "c", 1, "-1", $filters);//Get count data
		$total_c = $total_c[0]->total_c;
		
		$pagination_admin = $this->config->item('pagination_admin');
		$pagination_admin['base_url'] = base_url().'admin/storesettings/clarities';
		$pagination_admin['total_rows'] = $total_c;		
		$pagination_admin['per_page'] = 50;
		$pagination_admin['uri_segment'] = 4;
		
		$this->pagination->initialize($pagination_admin);
		
		$limitstart = '0';
		if(isset($page) && $page > 1){
			$limitstart = ($pagination_admin['per_page'] * $page) - $pagination_admin['per_page']; 
        }
		$data['clarities'] = get_table_pagination("gem_clarities", "c", $pagination_admin['per_page'], $limitstart, $filters);//fetch all data
        $data['pagination'] = $this->pagination->create_links();
		
		$this->template->content->view('storesettings/clarities_view', $data);
        $this->template->publish();
	}
	
	
	public function deleteclarity($id)
	{	
		$id = (int) $id;
		if($id <= 0)
		{
			show_error("bad Request", 400);
		}
		$data = array();
		$data['status'] = 2;
		$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
		$result = delete_record("gem_clarities", $id, $data);
		if($result){
			$this->session->set_flashdata('saveclarity_msg', 'Clarity has been deleted successfully.');
			$this->session->set_flashdata('saveclarity_class', 'alert-success');
		}else{
			$this->session->set_flashdata('saveclarity_msg', 'Some technical error occur.');
			$this->session->set_flashdata('saveclarity_class', 'alert-danger');
		}
		redirect('/admin/storesettings/clarities');
	}
	
	public function addclarity($id = 0)
	{
		$data = array();
		if($this->input->post()){
			$id = (int) $this->input->post('clarityid');
			$this->form_validation->set_error_delimiters('<label class="error">', '</label>');	
			$this->form_validation->set_rules('name', 'Name', 'trim|required|callback_is_unique_clarity|xss_clean');
			$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
			
			if ($this->form_validation->run() == true)
			{
				$cond = array();
				$data['name'] = $this->input->post('name');
				$data['status'] = $this->input->post('status');	
				if($id > 0)
				{
					$cond["id"] = $id;
					$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
				}
				else
				{
					$data['created_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
				}
				$shapeid = save_record("gem_clarities", $data, $cond);
				if($shapeid > 0){
					$this->session->set_flashdata('saveclarity_msg', 'Clarity has been saved successfully.');
					$this->session->set_flashdata('saveclarity_class', 'alert-success');
				}else{
					$this->session->set_flashdata('saveclarity_msg', 'Some technical error occur.');
					$this->session->set_flashdata('saveclarity_class', 'alert-danger');
				}
				redirect('/admin/storesettings/clarities');
			}
			else
			{
				$data['name'] = $this->input->post('name');	
				$data['status'] = $this->input->post('status');	
				$data['clarityid'] = $id;	
			}
		}else{
			if($id > 0){
				$data['clarity'] = get_table_record("gem_clarities", $id);
				$data['status'] = $data['clarity']->status;
			}
		}
		$this->template->content->view('storesettings/addclarity_view', $data);
        $this->template->publish();
	}
	
	public function is_unique_clarity($value)
	{	
		$id = (int) $this->input->post('clarityid');
		$result = is_unique_value("gem_clarities", array("name" => trim($value)), $id);
		if(!$result)
		{
			$this->form_validation->set_message('is_unique_clarity', 'This {field} already exists.');
			return false;
		}
		else
		{
			return true;
		}
	}
	/**************************************END clarities******************************/
	
	/**************************************transparency**********************************/
	public function transparency()
	{
		$data = array();
		$filters = array();
		$filters['search'] = $data['search'] = html_escape(trim($this->input->get("search")));
		$filters['status'] = $data['status'] = html_escape(trim($this->input->get("status")));
		
		$total_t = get_table_pagination("gem_transparency", "t", 1, "-1", $filters);//Get count data
		$total_t = $total_t[0]->total_t;
		
		$pagination_admin = $this->config->item('pagination_admin');
		$pagination_admin['base_url'] = base_url().'admin/storesettings/transparency';
		$pagination_admin['total_rows'] = $total_t;		
		$pagination_admin['per_page'] = 50;
		$pagination_admin['uri_segment'] = 4;
		
		$this->pagination->initialize($pagination_admin);
		
		$limitstart = '0';
		if(isset($page) && $page > 1){
			$limitstart = ($pagination_admin['per_page'] * $page) - $pagination_admin['per_page']; 
        }
		$data['transparency'] = get_table_pagination("gem_transparency", "t", $pagination_admin['per_page'], $limitstart, $filters);//fetch all data
        $data['pagination'] = $this->pagination->create_links();
		
		$this->template->content->view('storesettings/transparency_view', $data);
        $this->template->publish();
	}
	
	
	public function deletetransparency($id)
	{	
		$id = (int) $id;
		if($id <= 0)
		{
			show_error("bad Request", 400);
		}
		$data = array();
		$data['status'] = 2;
		$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
		$result = delete_record("gem_transparency", $id, $data);
		if($result){
			$this->session->set_flashdata('savetransparency_msg', 'Transparency has been deleted successfully.');
			$this->session->set_flashdata('savetransparency_class', 'alert-success');
		}else{
			$this->session->set_flashdata('savetransparency_msg', 'Some technical error occur.');
			$this->session->set_flashdata('savetransparency_class', 'alert-danger');
		}
		redirect('/admin/storesettings/transparency');
	}
	
	public function addtransparency($id = 0)
	{
		$data = array();
		if($this->input->post()){
			$id = (int) $this->input->post('transparencyid');
			$this->form_validation->set_error_delimiters('<label class="error">', '</label>');	
			$this->form_validation->set_rules('name', 'Name', 'trim|required|callback_is_unique_clarity|xss_clean');
			$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
			
			if ($this->form_validation->run() == true)
			{
				$cond = array();
				$data['name'] = $this->input->post('name');
				$data['status'] = $this->input->post('status');	
				if($id > 0)
				{
					$cond["id"] = $id;
					$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
				}
				else
				{
					$data['created_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
				}
				$shapeid = save_record("gem_transparency", $data, $cond);
				if($shapeid > 0){
					$this->session->set_flashdata('savetransparency_msg', 'Transparency has been saved successfully.');
					$this->session->set_flashdata('savetransparency_class', 'alert-success');
				}else{
					$this->session->set_flashdata('savetransparency_msg', 'Some technical error occur.');
					$this->session->set_flashdata('savetransparency_class', 'alert-danger');
				}
				redirect('/admin/storesettings/transparency');
			}
			else
			{
				$data['name'] = $this->input->post('name');	
				$data['status'] = $this->input->post('status');	
				$data['transparencyid'] = $id;	
			}
		}else{
			if($id > 0){
				$data['transparency'] = get_table_record("gem_transparency", $id);
				$data['status'] = $data['transparency']->status;
			}
		}
		$this->template->content->view('storesettings/addtransparency_view', $data);
        $this->template->publish();
	}
	
	public function is_unique_transparency($value)
	{	
		$id = (int) $this->input->post('transparencyid');
		$result = is_unique_value("gem_transparency", array("name" => trim($value)), $id);
		if(!$result)
		{
			$this->form_validation->set_message('is_unique_transparency', 'This {field} already exists.');
			return false;
		}
		else
		{
			return true;
		}
	}
	/**************************************END transparency******************************/
	
	/**************************************treatments**********************************/
	public function treatments()
	{
		$data = array();
		$filters = array();
		$filters['search'] = $data['search'] = html_escape(trim($this->input->get("search")));
		$filters['status'] = $data['status'] = html_escape(trim($this->input->get("status")));
		
		$total_t = get_table_pagination("gem_treatments", "t", 1, "-1", $filters);//Get count data
		$total_t = $total_t[0]->total_t;
		
		$pagination_admin = $this->config->item('pagination_admin');
		$pagination_admin['base_url'] = base_url().'admin/storesettings/treatments';
		$pagination_admin['total_rows'] = $total_t;		
		$pagination_admin['per_page'] = 50;
		$pagination_admin['uri_segment'] = 4;
		
		$this->pagination->initialize($pagination_admin);
		
		$limitstart = '0';
		if(isset($page) && $page > 1){
			$limitstart = ($pagination_admin['per_page'] * $page) - $pagination_admin['per_page']; 
        }
		$data['treatments'] = get_table_pagination("gem_treatments", "t", $pagination_admin['per_page'], $limitstart, $filters);//fetch all data
        $data['pagination'] = $this->pagination->create_links();
		
		$this->template->content->view('storesettings/treatments_view', $data);
        $this->template->publish();
	}
	
	
	public function deletetreatment($id)
	{	
		$id = (int) $id;
		if($id <= 0)
		{
			show_error("bad Request", 400);
		}
		$data = array();
		$data['status'] = 2;
		$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
		$result = delete_record("gem_treatments", $id, $data);
		if($result){
			$this->session->set_flashdata('savetreatment_msg', 'Treatment has been deleted successfully.');
			$this->session->set_flashdata('savetreatment_class', 'alert-success');
		}else{
			$this->session->set_flashdata('savetreatment_msg', 'Some technical error occur.');
			$this->session->set_flashdata('savetreatment_class', 'alert-danger');
		}
		redirect('/admin/storesettings/treatments');
	}
	
	public function addtreatment($id = 0)
	{
		$data = array();
		if($this->input->post()){
			$id = (int) $this->input->post('treatmentid');
			$this->form_validation->set_error_delimiters('<label class="error">', '</label>');	
			$this->form_validation->set_rules('name', 'Name', 'trim|required|callback_is_unique_clarity|xss_clean');
			$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
			
			if ($this->form_validation->run() == true)
			{
				$cond = array();
				$data['name'] = $this->input->post('name');
				$data['status'] = $this->input->post('status');	
				if($id > 0)
				{
					$cond["id"] = $id;
					$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
				}
				else
				{
					$data['created_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
				}
				$shapeid = save_record("gem_treatments", $data, $cond);
				if($shapeid > 0){
					$this->session->set_flashdata('savetreatment_msg', 'Treatment has been saved successfully.');
					$this->session->set_flashdata('savetreatment_class', 'alert-success');
				}else{
					$this->session->set_flashdata('savetreatment_msg', 'Some technical error occur.');
					$this->session->set_flashdata('savetreatment_class', 'alert-danger');
				}
				redirect('/admin/storesettings/treatments');
			}
			else
			{
				$data['name'] = $this->input->post('name');	
				$data['status'] = $this->input->post('status');	
				$data['treatmentid'] = $id;	
			}
		}else{
			if($id > 0){
				$data['treatment'] = get_table_record("gem_treatments", $id);
				$data['status'] = $data['treatment']->status;
			}
		}
		$this->template->content->view('storesettings/addtreatment_view', $data);
        $this->template->publish();
	}
	
	public function is_unique_treatment($value)
	{	
		$id = (int) $this->input->post('treatmentid');
		$result = is_unique_value("gem_treatments", array("name" => trim($value)), $id);
		if(!$result)
		{
			$this->form_validation->set_message('is_unique_treatment', 'This {field} already exists.');
			return false;
		}
		else
		{
			return true;
		}
	}
	/**************************************END treatments******************************/
	
	/**************************************certificates**********************************/
	public function certificates()
	{
		$data = array();
		$filters = array();
		$filters['search'] = $data['search'] = html_escape(trim($this->input->get("search")));
		$filters['status'] = $data['status'] = html_escape(trim($this->input->get("status")));
		
		$total_c = get_table_pagination("gem_certificates", "c", 1, "-1", $filters);//Get count data
		$total_c = $total_c[0]->total_c;
		
		$pagination_admin = $this->config->item('pagination_admin');
		$pagination_admin['base_url'] = base_url().'admin/storesettings/certificates';
		$pagination_admin['total_rows'] = $total_c;		
		$pagination_admin['per_page'] = 50;
		$pagination_admin['uri_segment'] = 4;
		
		$this->pagination->initialize($pagination_admin);
		
		$limitstart = '0';
		if(isset($page) && $page > 1){
			$limitstart = ($pagination_admin['per_page'] * $page) - $pagination_admin['per_page']; 
        }
		$data['certificates'] = get_table_pagination("gem_certificates", "c", $pagination_admin['per_page'], $limitstart, $filters);//fetch all data
        $data['pagination'] = $this->pagination->create_links();
		
		$this->template->content->view('storesettings/certificates_view', $data);
        $this->template->publish();
	}
	
	
	public function deletecertificate($id)
	{	
		$id = (int) $id;
		if($id <= 0)
		{
			show_error("bad Request", 400);
		}
		$data = array();
		$data['status'] = 2;
		$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
		$result = delete_record("gem_certificates", $id, $data);
		if($result){
			$this->session->set_flashdata('savecertificates_msg', 'Certificate has been deleted successfully.');
			$this->session->set_flashdata('savecertificates_class', 'alert-success');
		}else{
			$this->session->set_flashdata('savecertificates_msg', 'Some technical error occur.');
			$this->session->set_flashdata('savecertificates_class', 'alert-danger');
		}
		redirect('/admin/storesettings/certificates');
	}
	
	public function addcertificate($id = 0)
	{
		$data = array();
		if($this->input->post()){
			$id = (int) $this->input->post('certificateid');
			$this->form_validation->set_error_delimiters('<label class="error">', '</label>');	
			$this->form_validation->set_rules('name', 'Name', 'trim|required|callback_is_unique_clarity|xss_clean');
			$this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
			$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
			
			if ($this->form_validation->run() == true)
			{
				$cond = array();
				$data['name'] = $this->input->post('name');
				$data['description'] = $this->input->post('description');
				$data['status'] = $this->input->post('status');	
				if($id > 0)
				{
					$cond["id"] = $id;
					$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
				}
				else
				{
					$data['created_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
				}
				$shapeid = save_record("gem_certificates", $data, $cond);
				if($shapeid > 0){
					$this->session->set_flashdata('savecertificates_msg', 'Certificate has been saved successfully.');
					$this->session->set_flashdata('savecertificates_class', 'alert-success');
				}else{
					$this->session->set_flashdata('savecertificates_msg', 'Some technical error occur.');
					$this->session->set_flashdata('savecertificates_class', 'alert-danger');
				}
				redirect('/admin/storesettings/certificates');
			}
			else
			{
				$data['name'] = $this->input->post('name');	
				$data['status'] = $this->input->post('status');	
				$data['treatmentid'] = $id;	
			}
		}else{
			if($id > 0){
				$data['certificate'] = get_table_record("gem_certificates", $id);
				$data['status'] = $data['certificate']->status;
			}
		}
		$this->template->content->view('storesettings/addcertificate_view', $data);
        $this->template->publish();
	}
	
	public function is_unique_certificate($value)
	{	
		$id = (int) $this->input->post('certificateid');
		$result = is_unique_value("gem_certificates", array("name" => trim($value)), $id);
		if(!$result)
		{
			$this->form_validation->set_message('is_unique_certificate', 'This {field} already exists.');
			return false;
		}
		else
		{
			return true;
		}
	}
	/**************************************END certificates******************************/
	
	/**************************************specialoffers**********************************/
	public function specialoffers()
	{
		$data = array();
		$filters = array();
		$filters['search'] = $data['search'] = html_escape(trim($this->input->get("search")));
		$filters['status'] = $data['status'] = html_escape(trim($this->input->get("status")));
		
		$total_c = get_table_pagination("gem_offers", "c", 1, "-1", $filters);//Get count data
		$total_c = $total_c[0]->total_c;
		
		$pagination_admin = $this->config->item('pagination_admin');
		$pagination_admin['base_url'] = base_url().'admin/storesettings/specialoffers';
		$pagination_admin['total_rows'] = $total_c;		
		$pagination_admin['per_page'] = 50;
		$pagination_admin['uri_segment'] = 4;
		
		$this->pagination->initialize($pagination_admin);
		
		$limitstart = '0';
		if(isset($page) && $page > 1){
			$limitstart = ($pagination_admin['per_page'] * $page) - $pagination_admin['per_page']; 
        }
		$data['offers'] = get_table_pagination("gem_offers", "c", $pagination_admin['per_page'], $limitstart, $filters);//fetch all data
        $data['pagination'] = $this->pagination->create_links();
		
		$this->template->content->view('storesettings/offers_view', $data);
        $this->template->publish();
	}
	
	
	public function deleteoffer($id)
	{	
		$id = (int) $id;
		if($id <= 0)
		{
			show_error("bad Request", 400);
		}
		$data = array();
		$data['status'] = 2;
		$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
		$result = delete_record("gem_offers", $id, $data);
		if($result){
			$this->session->set_flashdata('saveoffer_msg', 'Offer has been deleted successfully.');
			$this->session->set_flashdata('saveoffer_class', 'alert-success');
		}else{
			$this->session->set_flashdata('saveoffer_msg', 'Some technical error occur.');
			$this->session->set_flashdata('saveoffer_class', 'alert-danger');
		}
		redirect('/admin/storesettings/specialoffers');
	}
	
	public function addoffer($id = 0)
	{
		$data = array();
		if($this->input->post()){
			$id = (int) $this->input->post('offerid');
			$this->form_validation->set_error_delimiters('<label class="error">', '</label>');	
			$this->form_validation->set_rules('name', 'Name', 'trim|required|callback_is_unique_clarity|xss_clean');
			$this->form_validation->set_rules('description', 'Description', 'trim|xss_clean');
			$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
			
			if ($this->form_validation->run() == true)
			{
				$cond = array();
				$data['name'] = $this->input->post('name');
				$data['description'] = $this->input->post('description');
				$data['status'] = $this->input->post('status');	
				if($id > 0)
				{
					$cond["id"] = $id;
					$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
				}
				else
				{
					$data['created_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
				}
				$shapeid = save_record("gem_offers", $data, $cond);
				if($shapeid > 0){
					$this->session->set_flashdata('saveoffer_msg', 'Offer has been saved successfully.');
					$this->session->set_flashdata('saveoffer_class', 'alert-success');
				}else{
					$this->session->set_flashdata('saveoffer_msg', 'Some technical error occur.');
					$this->session->set_flashdata('saveoffer_class', 'alert-danger');
				}
				redirect('/admin/storesettings/specialoffers');
			}
			else
			{
				$data['name'] = $this->input->post('name');	
				$data['status'] = $this->input->post('status');	
				$data['treatmentid'] = $id;	
			}
		}else{
			if($id > 0){
				$data['offer'] = get_table_record("gem_offers", $id);
				$data['status'] = $data['offer']->status;
			}
		}
		$this->template->content->view('storesettings/addoffer_view', $data);
        $this->template->publish();
	}
	
	public function is_unique_offer($value)
	{	
		$id = (int) $this->input->post('offerid');
		$result = is_unique_value("gem_offers", array("name" => trim($value)), $id);
		if(!$result)
		{
			$this->form_validation->set_message('is_unique_offer', 'This {field} already exists.');
			return false;
		}
		else
		{
			return true;
		}
	}
	/**************************************END specialoffers******************************/
}
