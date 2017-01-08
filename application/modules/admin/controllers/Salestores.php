<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salestores extends CI_controller {

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
		$this->load->model('admin/salestores_model');		
	}
	
	public function index($page = 1)
	{
		$data = array();
		$filters = array();
		$filters['search'] = $data['search'] = html_escape(trim($this->input->get("search")));
		$filters['status'] = $data['status'] = html_escape(trim($this->input->get("status")));
		
		$total_sale_stores = $this->salestores_model->get_salestores(1, "-1", $filters);//Get count data
		$total_sale_stores = $total_sale_stores[0]->total_sale_stores;
		
		$pagination_admin = $this->config->item('pagination_admin');
		$pagination_admin['base_url'] = base_url().'admin/salestores/index';
		$pagination_admin['total_rows'] = $total_sale_stores;		
		$pagination_admin['per_page'] = 50;
		$pagination_admin['uri_segment'] = 4;
		
		$this->pagination->initialize($pagination_admin);
		
		$limitstart = '0';
		if(isset($page) && $page > 1){
			$limitstart = ($pagination_admin['per_page'] * $page) - $pagination_admin['per_page']; 
        }

		$data['salestores'] = $this->salestores_model->get_salestores($pagination_admin['per_page'], $limitstart, $filters);//fetch all data
        $data['pagination'] = $this->pagination->create_links();
		$this->template->content->view('salestores/salestore_view', $data);
        $this->template->publish();
	}
	
	public function edit($sid = 0)
	{
		$sid = (int) $sid;		
		$data = array();
		
		if($this->input->post())
		{
			$this->form_validation->set_error_delimiters('<label class="error">', '</label>');	
			$this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[150]|xss_clean');
			$this->form_validation->set_rules('address', 'Address', 'trim|required|max_length[150]|xss_clean');
			$this->form_validation->set_rules('country', 'Country', 'trim|required|is_natural|xss_clean');
			$this->form_validation->set_rules('state', 'State', 'trim|required|is_natural|xss_clean');
			$this->form_validation->set_rules('city', 'City', 'trim|required|max_length[50]|xss_clean');
			$this->form_validation->set_rules('zipcode', 'Zipcode', 'trim|required|max_length[10]|xss_clean');
			$this->form_validation->set_rules('contact_no', 'Contact No', 'trim|required|min_length[10]|max_length[20]|is_natural|xss_clean');			
			
			if ($this->form_validation->run() == true)
			{
				$id = (int) $this->input->post('sid');
				$data['name'] = $this->input->post('name'); 
				$data['address'] = $this->input->post('address'); 
				$data['country_id'] = $this->input->post('country'); 
				$data['state_id'] = $this->input->post('state'); 
				$data['city'] = $this->input->post('city'); 
				$data['zipcode'] = $this->input->post('zipcode'); 
				$data['contact_no'] = $this->input->post('contact_no');
				$data['status'] = $this->input->post('status'); 
				$data['about_store'] = html_escape(strip_tags($this->input->post('about_store')));	
				if($id > 0)
				{				
					$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
				}
				else
				{
					$data['created_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
				}				
				
				$store_id = $this->salestores_model->save_store($data, $id);
				if($store_id > 0)
				{	
					$this->session->set_flashdata('saveadminsale_msg', 'User has been saved successfully.');
					$this->session->set_flashdata('saveadminsale_class', 'alert-success');
				}
				else
				{
					$this->session->set_flashdata('saveadminsale_msg', 'Some technical error occur.');
					$this->session->set_flashdata('saveadminsale_class', 'alert-danger');
				}
				redirect('/admin/salestores');
			}
			else
			{
				$data['sid'] = $id; 
				$data['name'] = $this->input->post('name'); 
				$data['address'] = $this->input->post('address'); 
				$data['country'] = $this->input->post('country'); 
				$data['state'] = $this->input->post('state'); 
				$data['city'] = $this->input->post('city'); 
				$data['zipcode'] = $this->input->post('zipcode'); 
				$data['contact_no'] = $this->input->post('contact_no'); 
				$data['status'] = $this->input->post('status'); 
				$data['about_store'] = html_escape(strip_tags($this->input->post('about_store')));	
				$data['states'] = get_table_record("gem_states", 0, "id, state_name", array("status" => "1"), "state_name", "ASC");
			}
		}
		else
		{
			if($sid == 0)
			{
				show_error("Bad Request", 400);
			}
			$data['sid'] = $sid;
			$data['store'] = $this->salestores_model->get_salestore($sid);
			$data['status'] = $data['store']->status;
			$data['states'] = get_table_record("gem_states", 0, "id, state_name", array("status" => "1"), "state_name", "ASC");
		}
		
		$data['countries'] = get_table_record("gem_country", 0, "id, country_name", array("status" => "1"), "country_name", "ASC");		
		
		$data['default_image'] = $this->config->item('default_image');	
		
		$this->template->content->view('salestores/editsalestore_view', $data);
        $this->template->publish();
	}
	
	public function uploadfile()
	{
		$is_ajax = $this->input->post("ajax");
		if($is_ajax == 1)
		{
			$sid = (int) $this->input->post("sid");
			if($sid == 0)
			{
				show_error("Bad Request", 400);
			}
			else
			{				
				//Get Extension
				$info = new SplFileInfo($_FILES["file_upload"]["name"]);
				$ext = $info->getExtension();
				
				$store = $this->salestores_model->get_salestore($sid);			
				$file_name = create_slug($store->name."-".$sid).".".$ext;				
				
				$upload_path = FCPATH.$this->config->item('store_img_upload_path').$sid;
				if(!is_dir($upload_path)) 
				{
					mkdir($upload_path, 0755);
				}
				
				//config to upload image
				$config['overwrite']          = true;
				$config['upload_path']          = $upload_path;
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 5120;
                $config['max_width']            = 300;
                $config['max_height']           = 300;
				$config['file_name']           = $file_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				if ( ! $this->upload->do_upload("file_upload"))
                {
					$error = array('error' => strip_tags($this->upload->display_errors()), 'status' => 'failed');
					echo json_encode($error);
                }
                else
                {
					$return = array('upload_data' => $this->upload->data());
					$data['logo'] = $return['upload_data']['file_name'];;
					$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
					$sid = $this->salestores_model->save_store($data, $sid);
					if($sid > 0)
					{
						$return['status'] = 'success';
						$return['sid'] = $sid;
						echo json_encode($return);
					}
					else
					{
						$return['status'] = 'failed1';
						echo json_encode($return);
					}					
                }
			}
		}
		else
		{
			show_error("Bad Request", 400);
		}
	}
	
	
	public function delsalestore($id = 0)
	{	
		if($id == 0)
		{
			show_error("Bad Request", 400);
		}
		$data = array();
		$data['status'] = 2;
		$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
		$result = $this->salestores_model->save_store($data, $id);
		if($result){
			$this->session->set_flashdata('saveadminsale_msg', 'Sale store has been deleted successfully.');
			$this->session->set_flashdata('saveadminsale_class', 'alert-success');
		}else{
			$this->session->set_flashdata('saveadminsale_msg', 'Some technical error occur.');
			$this->session->set_flashdata('saveadminsale_class', 'alert-danger');
		}
		redirect('/admin/salestores');
	}
	
	public function getstates()
	{
		$is_ajax = $this->input->post("ajax");
		if($is_ajax == 1){
			$return = array();
			$country_id = $this->input->post("country");
			$criteria = array("status" => "1", "country_id" => $country_id);
			$return['states'] = get_table_record("gem_states", 0, "id, state_name", $criteria, "state_name", "ASC");			
			echo json_encode($return);
		}
		else	
		{
			show_error("Bad Request", 400);
		}
	}
	
	public function viewproduct($id = 0, $page = 1)
	{
		$data = array(); 
		$filters = array();
		$data['sid'] = $id = (int) $id;
		if($id == 0)
		{
			show_error("Bad Request", 400);
		}
		$filters['sid'] = $data['sid'];
		$data['store_name'] = get_table_record("gem_stores", $data['sid'], "name", array(), "name", "ASC");	
		$total_products = $this->salestores_model->get_products(1, "-1", $filters);//Get count data
		$total_products = $total_products[0]->total_products;
		
		$pagination_admin = $this->config->item('pagination_admin');
		$pagination_admin['base_url'] = base_url().'admin/salestores/viewproduct/'.$data['sid'];
		$pagination_admin['total_rows'] = $total_products;		
		$pagination_admin['per_page'] = 10;
		$pagination_admin['uri_segment'] = 5;
		
		$this->pagination->initialize($pagination_admin);
		
		$limitstart = '0';
		if(isset($page) && $page > 1){
			$limitstart = ($pagination_admin['per_page'] * $page) - $pagination_admin['per_page']; 
        }
		$data['products'] = $this->salestores_model->get_products($pagination_admin['per_page'], $limitstart, $filters);//fetch all data
        $data['pagination'] = $this->pagination->create_links();
		
		$this->template->content->view('salestores/products_view', $data);
        $this->template->publish();
	}
	
	public function delproduct($sid = 0, $id = 0)
	{	
		if($sid == 0 && $id == 0)
		{
			show_error("Bad Request", 400);
		}
		$data = array();
		$data['status'] = 2;
		$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
		$result = $this->salestores_model->save_product($data, $id);
		if($result){
			$this->session->set_flashdata('saveadminproduct_msg', 'Product has been deleted successfully.');
			$this->session->set_flashdata('saveadminproduct_class', 'alert-success');
		}else{
			$this->session->set_flashdata('saveadminproduct_msg', 'Some technical error occur.');
			$this->session->set_flashdata('saveadminproduct_class', 'alert-danger');
		}
		redirect('/admin/salestores/viewproduct/'.$sid);
	}
	
	public function productedit($sid = 0, $pid = 0)
	{
		$data = array(); 
		$sid = (int) $sid;
		$pid = (int) $pid;
		//Check valid store and product.
		if($sid <= 0 || $pid <= 0 || ($sid > 0 && $pid > 0 && !$this->salestores_model->is_valid_store_product($sid, $pid)))
		{
			show_error("Bad request", 400);
		}		
		
		if($this->input->post())
		{
			$this->form_validation->set_error_delimiters('<label class="error">', '</label>');	
			$this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
			$this->form_validation->set_rules('gemstone_category', 'Gemstone', 'trim|required|is_natural|xss_clean');
			$this->form_validation->set_rules('gemstone_specie', 'Gemstone Species', 'trim|required|is_natural|xss_clean');	
			$this->form_validation->set_rules('gemstone_price', 'Price', 'trim|required|numeric|xss_clean');				
			$this->form_validation->set_rules('carat_weight1', 'Caret', 'trim|required|max_length[5]}is_natural|xss_clean');
			$stone_ID = $this->input->post('stone_ID');
			if($stone_ID != "")
			{
				$this->form_validation->set_rules('stone_ID', 'stone ID', 'trim|max_length[30]|xss_clean');
			}	
			$this->form_validation->set_rules('height', 'Height', 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('width', 'Width', 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('length', 'Length', 'trim|required|numeric|xss_clean');
			$color = $this->input->post('color');
			if($color != "")
			{
				$this->form_validation->set_rules('color[]', 'color', 'trim|is_natural|xss_clean');
			}	
			$shape = $this->input->post('shape');
			if($shape != "")
			{
				$this->form_validation->set_rules('shape', 'Shape', 'trim|is_natural|xss_clean');
			}
			$cutting = $this->input->post('cutting');
			if($cutting != "")
			{
				$this->form_validation->set_rules('cutting', 'Cutting', 'trim|is_natural|xss_clean');
			}
			$clarity = $this->input->post('clarity');
			if($clarity != "")
			{
				$this->form_validation->set_rules('clarity', 'Clarity', 'trim|is_natural|xss_clean');
			}
			$transparency = $this->input->post('transparency');
			if($transparency != "")
			{
				$this->form_validation->set_rules('transparency', 'Transparency', 'trim|is_natural|xss_clean');
			}
			$geo_origin = $this->input->post('geo_origin');
			if($geo_origin != "")
			{
				$this->form_validation->set_rules('geo_origin', 'Geographical Origin', 'trim|xss_clean');
			}
			$treatment = $this->input->post('treatment');
			if($treatment != "")
			{
				$this->form_validation->set_rules('treatment', 'Treatments', 'trim|is_natural|xss_clean');
			}
			$certificate = $this->input->post('certificate');
			if($certificate != "")
			{
				$this->form_validation->set_rules('certificate', 'Certificates', 'trim|is_natural|xss_clean');
			}
			$offer = $this->input->post('offer');
			if($offer != "")
			{
				$this->form_validation->set_rules('offer', 'Special Offer', 'trim|is_natural|xss_clean');
			}
			$country = $this->input->post('country');
			if($country != "")
			{
				$this->form_validation->set_rules('country', 'Country', 'trim|is_natural|xss_clean');
			}
			$state = $this->input->post('state');
			if($state != "")
			{
				$this->form_validation->set_rules('state', 'State', 'trim|is_natural|xss_clean');
			}
			$city = $this->input->post('city');
			if($city != "")
			{
				$this->form_validation->set_rules('city', 'City', 'trim|xss_clean');
			}
			$description = $this->input->post('description');
			if($description != "")
			{
				$this->form_validation->set_rules('description', 'Description', 'trim|max_length[500]|xss_clean');
			}
						
			if ($this->form_validation->run() == true)
			{
				$data['store_id'] = $sid;				 
				$data['title'] = $this->input->post('title'); 
				$data['category_id'] = $this->input->post('gemstone_category'); 
				$data['gemspecies_id'] = $this->input->post('gemstone_specie'); 
				$data['gemstone_price'] = $this->input->post('gemstone_price'); 
				$data['weight'] = $this->input->post('carat_weight1'); 
				$data['stone_ID'] = ($this->input->post('stone_ID'))?$this->input->post('stone_ID'):null; 
				$data['height'] = $this->input->post('height'); 
				$data['width'] = $this->input->post('width'); 
				$data['length'] = $this->input->post('length'); 
				$color = $this->input->post('color');
				if(count($color) > 0)
				{
					$data['color'] = "::".implode("::", $this->input->post('color'))."::";
				}
				$data['shape'] = ($this->input->post('shape'))?$this->input->post('shape'):null;
				$data['cutting'] = ($this->input->post('cutting'))?$this->input->post('cutting'):null;
				$data['clarity'] = ($this->input->post('clarity'))?$this->input->post('clarity'):null;
				$data['transparency'] = ($this->input->post('transparency'))?$this->input->post('transparency'):null;
				$data['geo_origin'] = ($this->input->post('geo_origin'))?$this->input->post('geo_origin'):null;
				$data['offer_id'] = ($this->input->post('offer'))?$this->input->post('offer'):null;
				$data['treatment'] = ($this->input->post('treatment'))?$this->input->post('treatment'):null;
				$data['certificate'] = ($this->input->post('certificate'))?$this->input->post('certificate'):null;
				$data['country_id'] = ($this->input->post('country'))?$this->input->post('country'):null;
				$data['state_id'] = ($this->input->post('state'))?$this->input->post('state'):null;
				$data['city'] = ($this->input->post('city'))?$this->input->post('city'):null;
				$data['status'] = $this->input->post('status'); 
				$description = $this->input->post('description');
				$data['description'] = ($description !="")?html_escape(strip_tags($this->input->post('description'))):null;	
				$pid = $this->input->post('pid');
				$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");				
				
				$product_id = $this->salestores_model->save_product($data, $pid);
				if($product_id > 0){
					$this->session->set_flashdata('saveadminproduct_msg', 'Product has been saved successfully.');
					$this->session->set_flashdata('saveadminproduct_class', 'alert-success');
				}else{
					$this->session->set_flashdata('saveadminproduct_msg', 'Some technical error occur.');
					$this->session->set_flashdata('saveadminproduct_class', 'alert-danger');
				}
				redirect('/admin/salestores/viewproduct/'.$sid);
			}
			else
			{
				$data['sid'] = (int) $this->input->post('sid');; 
				$data['title'] = $this->input->post('title'); 
				$data['gemstone_category'] = $this->input->post('gemstone_category'); 
				$data['gemstone_specie'] = $this->input->post('gemstone_specie'); 
				$data['gemstone_price'] = $this->input->post('gemstone_price'); 
				$data['carat_weight1'] = $this->input->post('carat_weight1'); 
				$data['stone_ID'] = $this->input->post('stone_ID'); 
				$data['height'] = $this->input->post('height'); 
				$data['width'] = $this->input->post('width'); 
				$data['length'] = $this->input->post('length'); 
				$data['color'] = $this->input->post('color');
				$data['shape'] = $this->input->post('shape');
				$data['cutting'] = $this->input->post('cutting');
				$data['clarity'] = $this->input->post('clarity');
				$data['transparency'] = $this->input->post('transparency');
				$data['geo_origin'] = $this->input->post('geo_origin');
				$data['offer'] = $this->input->post('offer');
				$data['treatment'] = $this->input->post('treatment');
				$data['certificate'] = $this->input->post('certificate');
				$data['country'] = $this->input->post('country');
				$data['state'] = $this->input->post('state');
				$data['city'] = $this->input->post('city');
				$data['description'] = html_escape(strip_tags($this->input->post('description')));	
				$data['status'] = $this->input->post('status');;
				$data['pid'] = (int) $this->input->post('pid');
				$data['states'] = get_table_record("gem_states", 0, "id, state_name", array("status" => "1", "country_id" => $data['country']), "state_name", "ASC");
			}
		}
		else
		{
			$data['pid'] = $pid;
			$data['sid'] = $sid;
			if($pid > 0)
			{
				$product = $this->salestores_model->get_product($sid, $pid);
				if(count($product) > 0)
				{
					$pcolors = explode("::", trim($product->color, "::"));
					$data['sid'] = $product->store_id;
					$data['title'] = $product->title; 
					$data['gemstone_category'] = $product->category_id; 
					$data['gemstone_specie'] = $product->gemspecies_id; 
					$data['gemstone_price'] = $product->gemstone_price; 
					$data['carat_weight1'] = $product->weight; 
					$data['stone_ID'] = $product->stone_ID; 
					$data['height'] = $product->height; 
					$data['width'] = $product->width; 
					$data['length'] = $product->length; 
					$data['color'] = $pcolors;
					$data['shape'] = $product->shape;
					$data['cutting'] = $product->cutting;
					$data['clarity'] = $product->clarity;
					$data['transparency'] = $product->transparency;
					$data['geo_origin'] = $product->geo_origin;
					$data['offer'] = $product->offer_id;
					$data['treatment'] = $product->treatment;
					$data['certificate'] = $product->certificate;
					$data['country'] = $product->country_id;
					$data['state'] = $product->state_id;
					$data['city'] = $product->city;
					$data['description'] = html_escape(strip_tags($product->description));	
					$data['status'] = $product->status;
					$data['states'] = get_table_record("gem_states", 0, "id, state_name", array("status" => "1", "country_id" => $data['country']), "state_name", "ASC");
				}
				else{
					show_error("Bad Request", 400);
				}
			}
		}
		
		$data['store_name'] = get_table_record("gem_stores", $sid, "name", array(), "name", "ASC");//Get category
		$data['gemstone_categories'] = get_table_record("ofo_categories", 0, "id, name", array("status" => "1"), "name", "ASC");//Get category
		$data['gemstone_species'] = get_table_record("gem_gemstone_species", 0, "id, name", array("status" => "1"), "name", "ASC");//Get gemstone species
		$data['shapes'] = get_table_record("gem_shapes", 0, "id, name", array("status" => "1"), "name", "ASC");
		$data['cuttings'] = get_table_record("gem_cuttings", 0, "id, name", array("status" => "1"), "name", "ASC");
		$data['colors'] = get_table_record("gem_colors", 0, "*", array("status" => "1"), "name", "ASC");
		$data['clarities'] = get_table_record("gem_clarities", 0, "id, name", array("status" => "1"), "name", "ASC");
		$data['transparencies'] = get_table_record("gem_transparency", 0, "id, name", array("status" => "1"), "name", "ASC");
		$data['treatments'] = get_table_record("gem_treatments", 0, "id, name", array("status" => "1"), "name", "ASC");
		$data['certificates'] = get_table_record("gem_certificates", 0, "id, name", array("status" => "1"), "name", "ASC");
		$data['offers'] = get_table_record("gem_offers", 0, "id, name", array("status" => "1"), "name", "ASC");
		$data['countries'] = get_table_record("gem_country", 0, "id, country_name", array("status" => "1"), "country_name", "ASC");		
		
		$this->template->content->view('salestores/productedit_view', $data);
        $this->template->publish();
	}
	
}
