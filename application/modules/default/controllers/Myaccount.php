<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myaccount extends CI_Controller {

	private $current_date_obj = null;
	public function __construct(){
		parent::__construct();
		if(!isset($this->session->user['id'])){
			redirect('/login');
			die;	
		}
		$this->current_date_obj = new DateTime();
		$this->template->set_template('layout/layout');
		$this->load->helper('default/Default');	
		
		//$this->load->model('default/Myaccount_model');		
	}
	
	public function index()
	{
		redirect('/default/myaccount/dashboard');
	}
	
	public function dashboard()
	{
		$data = array(); 
		$data['active_tabs'] = "dashboard";
		$this->template->content->view('myaccount/dashboard_view', $data);
        $this->template->publish();
	}
	
	public function mystore($id = 0)
	{
		$data = array(); 
		$this->load->model('default/store_model');
		if($id > 0 && !$this->store_model->is_valid_user_store($id, $this->session->user['id']))
		{
			show_error("Bad request", 400);
		}
		
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
			$payment_opt = $this->input->post('payment_opt');
			if($payment_opt != ""){
				$this->form_validation->set_rules('payment_opt[]', 'Payment Option', 'trim|is_natural|xss_clean');
			}
			
			if ($this->form_validation->run() == true)
			{
				$id = (int) $this->input->post('sid');
				$data['user_id'] = $this->session->user['id']; 
				$data['name'] = $this->input->post('name'); 
				$data['address'] = $this->input->post('address'); 
				$data['country_id'] = $this->input->post('country'); 
				$data['state_id'] = $this->input->post('state'); 
				$data['city'] = $this->input->post('city'); 
				$data['zipcode'] = $this->input->post('zipcode'); 
				$data['contact_no'] = $this->input->post('contact_no');
				$data['about_store'] = html_escape(strip_tags($this->input->post('about_store')));	
				$payment_opt = $this->input->post('payment_opt');				
				if(count($payment_opt) > 0)
				{
					$data['payment_options'] = "::".implode("::", $this->input->post('payment_opt'))."::";
				}
				if($id > 0)
				{				
					$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
				}
				else
				{
					$data['created_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
				}				
				
				$store_id = $this->store_model->save_store($data, $id);
				if($store_id > 0)
				{	
					
					$this->session->set_flashdata('mystore_msg', 'Your store has been saved successfully. We will contact very soon...');
					redirect('/default/myaccount/mystore/'.$store_id);
				}
				else
				{
					$this->session->set_flashdata('mystore_msg', 'Some technical problem occur...');
				}
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
				$data['about_store'] = html_escape(strip_tags($this->input->post('about_store')));	
				$data['payment_opt'] = $this->input->post('payment_opt');
				$data['states'] = get_table_record("gem_states", 0, "id, state_name", array("status" => "1", "country_id" => $data['country']), "state_name", "ASC");
			}
		}
		else
		{
			if($id > 0)
			{
				$data['sid'] = $id; 
				$data['store'] = $this->store_model->get_store($id);
				if($data['store']->payment_options != null){
					$data['payment_opt'] = explode("::", trim($data['store']->payment_options, "::"));
				}
				$data['states'] = get_table_record("gem_states", 0, "id, state_name", array("status" => "1", "country_id" => $data['store']->country_id), "state_name", "ASC");
			}
			else
			{
				$storeid = get_table_record("gem_stores", 0, "id", array("user_id" => $this->session->user['id']));
				if($id == 0 && count($storeid) > 0 && isset($storeid[0]->id))
				{
					redirect('/default/myaccount/mystore/'.$storeid[0]->id);
				}
			}
		}
		
		$data['countries'] = get_table_record("gem_country", 0, "id, country_name", array("status" => "1"), "country_name", "ASC");		
		$data['payment_options'] = get_table_record("gem_buying_options", 0, "id, name", array("status" => "1"), "name", "ASC");	
		
		$data['default_image'] = $this->config->item('default_image');
		$data['active_tabs'] = "mystore";
		$this->template->content->view('myaccount/mystore_view', $data);
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
				$this->load->model('default/store_model');
				
				//Get Extension
				$info = new SplFileInfo($_FILES["file_upload"]["name"]);
				$ext = $info->getExtension();
				
				$store = $this->store_model->get_store($sid, "s.name");			
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
                $config['max_size']             = 15120;
                $config['max_width']            = 1300;
                $config['max_height']           = 1300;
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
					$sid = $this->store_model->save_store($data, $sid);
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
	
	public function productimages($sid, $pid)
	{
		$this->load->model('default/store_model');
		$sid = (int) $sid;
		$pid = (int) $pid;
		//Check valid product that related to user's store
		if($sid <= 0 || $pid <= 0 || ($sid > 0 && $pid > 0 && !$this->store_model->is_valid_user_store_product($sid, $this->session->user['id'], $pid)))
		{
			show_error("Bad request", 400);
		}
		
		$data = array(); 
		$data['sid'] = $sid;
		$data['pid'] = $pid;
		$data['gallery'] = $this->store_model->get_product_gallery($pid);
		
		$data['default_image'] = $this->config->item('default_image');
		$data['active_tabs'] = "myproducts";
		$this->template->content->view('myaccount/productimages_view', $data);
        $this->template->publish();
	}
	
	public function uploadproductgallery()
	{
		
		$is_ajax = $this->input->post("ajax");
		if($is_ajax == 1)
		{
			$this->load->model('default/store_model');
			$sid = (int) $this->input->post("sid");
			$pid = (int) $this->input->post("pid");
			if($sid == 0 || $pid == 0 || ($sid > 0 && $pid > 0 && !$this->store_model->is_valid_user_store_product($sid, $this->session->user['id'], $pid)))
			{
				show_error("Bad Request", 400);
			}
			else
			{				
				$total_gallery = $this->store_model->get_total_product_gallery($pid);
				if($total_gallery == 6)
				{
					$return['total_gallery'] = $total_gallery;
					echo json_encode($return);
					die;
				}
				//Get Extension
				$info = new SplFileInfo($_FILES["fileupload"]["name"]);
				$ext = $info->getExtension();
				
				$store = $this->store_model->get_store($sid, "s.name");	
				$file_name = substr($store->name, 0, 6);
				
				$product = $this->store_model->get_product($sid, $pid);	
				$file_name .= $product->gemstone.$pid;
				$file_name = create_slug($file_name).".".$ext;	
				$upload_path = FCPATH.$this->config->item('store_img_upload_path').$sid;
				if(!is_dir($upload_path)) 
				{
					mkdir($upload_path, 0755);
				}
				$upload_path .= "/".$pid;
				if(!is_dir($upload_path))
				{
					mkdir($upload_path, 0755);
				}					
					
				
				//config to upload image
				$config['upload_path']          = $upload_path;
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 10120;
                //$config['max_width']            = 400;
                //$config['max_height']           = 400;
				$config['file_name']           = $file_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				if ( ! $this->upload->do_upload("fileupload"))
                {
					$error = array('error' => strip_tags($this->upload->display_errors()), 'status' => 'failed');
					echo json_encode($error);
                }
                else
                {
					$return = array('upload_data' => $this->upload->data());
					$data['product_id'] = $pid;
					$data['name'] = $return['upload_data']['file_name'];
					$data['type'] = $return['upload_data']['file_ext'];
					$data['size'] = $return['upload_data']['file_size'];
					$data['height'] = $return['upload_data']['image_height'];
					$data['width'] = $return['upload_data']['image_width'];
					$data['created_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
					$gid = $this->store_model->save_product_gallery($data);
					if($gid > 0)
					{
						$total_gallery = $this->store_model->get_total_product_gallery($pid);
						$return['total_gallery'] = $total_gallery;
						$return['status'] = 'success';
						$return['sid'] = $sid;
						$return['pid'] = $pid;
						$return['gid'] = $gid;
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
	
	public function setdefaultimage()
	{
		$is_ajax = $this->input->post("ajax");
		if($is_ajax == 1)
		{
			$this->load->model('default/store_model');
			$sid = (int) $this->input->post("sid");
			$pid = (int) $this->input->post("pid");
			$gid = (int) $this->input->post("gid");
			if($gid == 0 ||$sid == 0 || $pid == 0 || ($sid > 0 && $pid > 0 && !$this->store_model->is_valid_user_store_product($sid, $this->session->user['id'], $pid)))
			{
				show_error("Bad Request", 400);
			}
			else
			{	
				$data_primary = array();
				$data_primary['is_primary'] = 0;
				$data_primary['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
				$this->store_model->update_product_gallery_bypid($data_primary, $pid);//Set 0 other images before set image primary
				
				$data['is_primary'] = 1;
				$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
				$gid = $this->store_model->save_product_gallery($data, $gid);
				$return = array();
				if($gid > 0)
				{
					$return['status'] = 'success'; 
				}
				else
				{
					$return['status'] = 'failed'; 
				}
				echo json_encode($return);
			}
		}	
		else
		{
			show_error("Bad Request", 400);
		}
	}
	
	public function deleteimage()
	{
		$is_ajax = $this->input->post("ajax");
		if($is_ajax == 1)
		{
			$this->load->model('default/store_model');
			$sid = (int) $this->input->post("sid");
			$pid = (int) $this->input->post("pid");
			$gid = (int) $this->input->post("gid");
			if($gid == 0 ||$sid == 0 || $pid == 0 || ($sid > 0 && $pid > 0 && !$this->store_model->is_valid_user_store_product($sid, $this->session->user['id'], $pid)))
			{
				show_error("Bad Request", 400);
			}
			else
			{		
				$gallery = $this->store_model->get_product_gallery_byid($gid, $pid);
				$filepath = FCPATH.$this->config->item('store_img_upload_path').$sid."/".$pid."/".$gallery->name;
				$return = array();
				if(file_exists($filepath) && @unlink($filepath))
				{
					$is_deleted = $this->store_model->delete_product_gallery($gid, $pid);					
					if($is_deleted)
					{
						$total_gallery = $this->store_model->get_total_product_gallery($pid);
						$return['total_gallery'] = $total_gallery; 
						$return['status'] = 'success'; 
					}
					else
					{
						$return['status'] = 'failed'; 
					}
				}
				else
				{
					$return['status'] = 'failed'; 
				}	
				echo json_encode($return);
			}
		}	
		else
		{
			show_error("Bad Request", 400);
		}
	}
	
	public function myproducts($id = 0, $page = 1)
	{
		$data = array(); 
		$filters = array();
		$data['sid'] = $id = (int) $id;
		$this->load->model('default/store_model');
		if(($id == 0) || ($id > 0 && !$this->store_model->is_valid_user_store($id, $this->session->user['id'])))
		{
			show_error("Bad request", 400);
		}
		$filters['loggedin_userid'] = $this->session->user['id'];
		$total_products = $this->store_model->get_products(1, "-1", $filters);//Get count data
		$total_products = $total_products[0]->total_products;
		
		$pagination = $this->config->item('pagination');
		$pagination['base_url'] = base_url().'default/myaccount/myproducts/'.$data['sid'];
		$pagination['total_rows'] = $total_products;		
		$pagination['per_page'] = 10;
		$pagination['uri_segment'] = 5;
		
		$this->pagination->initialize($pagination);
		
		$limitstart = '0';
		if(isset($page) && $page > 1){
			$limitstart = ($pagination['per_page'] * $page) - $pagination['per_page']; 
        }
		$data['products'] = $this->store_model->get_products($pagination['per_page'], $limitstart, $filters);//fetch all data
        $data['pagination'] = $this->pagination->create_links();
		$data['default_image'] = $this->config->item('default_image');
		$data['active_tabs'] = "myproducts";
		$this->template->content->view('myaccount/myproducts_view', $data);
        $this->template->publish();
	}
	
	public function addproduct($sid = 0, $pid = 0)
	{
		$data = array(); 
		$sid = (int) $sid;
		$pid = (int) $pid;
		$this->load->model('default/store_model');
		//Check valid user's store.
		if(($sid == 0) || ($sid > 0 && !$this->store_model->is_valid_user_store($sid, $this->session->user['id'])))
		{
			show_error("Bad request", 400);
		}		
		
		//Check valid product that related to user's store
		if(($sid > 0 && $pid > 0 && !$this->store_model->is_valid_user_store_product($sid, $this->session->user['id'], $pid)))
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
			if($color != ""){
				$this->form_validation->set_rules('color[]', 'color', 'trim|required|is_natural|xss_clean');
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
				$data['is_negotiable'] = ($this->input->post('negotiable'))?$this->input->post('negotiable'):0;
				$data['certificate'] = ($this->input->post('certificate'))?$this->input->post('certificate'):null;
				$data['country_id'] = ($this->input->post('country'))?$this->input->post('country'):null;
				$data['state_id'] = ($this->input->post('state'))?$this->input->post('state'):null;
				$data['city'] = ($this->input->post('city'))?$this->input->post('city'):null;
				$description = $this->input->post('description');
				$data['description'] = ($description !="")?html_escape(strip_tags($this->input->post('description'))):null;	
				$data['status'] = 0;
				$pid = $this->input->post('pid');
				if($pid > 0)
				{				
					$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
				}
				else
				{
					$data['created_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
				}				
				
				$product_id = $this->store_model->save_product($data, $pid);
				if($product_id > 0)
				{	
					$this->session->set_flashdata('myproduct_msg', 'Your product has been saved successfully.');
					redirect('/default/myaccount/myproducts/'.$sid);
				}
				else
				{
					$this->session->set_flashdata('myproduct_msg', 'Some technical problem occur...');
				}
			}
			else
			{
				$data['sid'] = $sid; 
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
				$data['negotiable'] = $this->input->post('negotiable');
				$data['country'] = $this->input->post('country');
				$data['state'] = $this->input->post('state');
				$data['city'] = $this->input->post('city');
				$data['description'] = html_escape(strip_tags($this->input->post('description')));	
				$data['status'] = 0;
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
				$product = $this->store_model->get_product($sid, $pid);
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
					$data['negotiable'] = $product->is_negotiable;					
					$data['certificate'] = $product->certificate;
					$data['country'] = $product->country_id;
					$data['state'] = $product->state_id;
					$data['city'] = $product->city;
					$data['description'] = html_escape(strip_tags($product->description));	
					$data['status'] = 0;
					$data['states'] = get_table_record("gem_states", 0, "id, state_name", array("status" => "1", "country_id" => $product->country_id), "state_name", "ASC");
				}
				else{
					show_error("Bad Request", 400);
				}
			}
		}
		
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
		$data['negotiables'] = array("1" => "Yes", "2" => "No");
		$data['active_tabs'] = "myproducts";
		$this->template->content->view('myaccount/addproduct_view', $data);
        $this->template->publish();
	}
	
	public function check2caret($val)
	{
		if (preg_match('/^[0-9]{2}+$/', $val)) 
		{
			return true;
		} 
		else 
		{
			$this->form_validation->set_message('check2caret', 'The {field} field must has valid value');
			return false;
		}
	}
		
	public function myprofile()
	{
		$data = array(); 
		
		$this->load->model('default/login_model');
		if($this->input->post())
		{
			$this->form_validation->set_error_delimiters('<label class="error">', '</label>');	
			if($this->input->post('save_info')){
				if($this->input->post('contact_no')){
					$this->form_validation->set_rules('contact_no', 'Contact No', 'required|regex_match[/^(\+\d{1,3}[- ]?)?\d{10}$/]'); 
				}
				if($this->input->post('skypeid')){
					$this->form_validation->set_rules('skypeid', 'Skype ID', 'trim|max_length[100]|xss_clean');
				}
			}
			else if($this->input->post('change_passord'))
			{
				if($this->input->post('old_password')){
					$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|min_length[6]|xss_clean|callback_check_old_password');
					$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|min_length[6]|xss_clean');
					$this->form_validation->set_rules('confpassword', 'Confirm Password', 'trim|required|min_length[6]|matches[new_password]|xss_clean');
				}
			}else{
				show_error("Bad Request", 400);die;
			}
			$msg = 'Your profile has been saved successfully.';
			if ($this->form_validation->run() == true)
			{
				if($this->input->post('save_info')){
					$data['contact_no'] = $this->input->post('contact_no'); 
					$data['skypeid'] = $this->input->post('skypeid'); 					
				}
				if($this->input->post('change_passord'))
				{
					if($this->input->post('old_password'))
					{				
						$data['password'] = $this->input->post('new_password'); 	
						$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
						$data['updated_at'] = $this->current_date_obj->format('Y-m-d H:i:s');
						$msg = 'Password has been changed successfully.';
					}
				}	
				$userid = $this->login_model->save_user($data, $this->session->user['id']);
				if($userid > 0)
				{	
					$this->session->set_flashdata('myprofile_msg', $msg);
					redirect('/default/myaccount/myprofile');
				}
				else
				{
					$this->session->set_flashdata('myprofile_msg', 'Some technical problem occur...');
				}
			}
			else
			{
				$data['old_password'] = $this->input->post('old_password'); 	
				$data['contact_no'] = html_escape($this->input->post('contact_no'));
				$data['skypeid'] = html_escape($this->input->post('skypeid'));
			}
		}
		$data['user'] = $this->login_model->get_user($this->session->user['id']);
		$data['default_image'] = $this->config->item('default_image');
		$data['active_tabs'] = "myprofile";
		$this->template->content->view('myaccount/myprofile_view', $data);
        $this->template->publish();
	}
	
	public function check_old_password($password)
	{
		$user = $this->login_model->get_user($this->session->user['id']);
		if (password_verify($password, $user->password)) 
		{
			return true;
		} 
		else 
		{
			$this->form_validation->set_message('check_old_password', 'Old password does not match.');
			return false;
		}
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
	
	public function getmessage()
	{
		$is_ajax = $this->input->post("ajax");
		if($is_ajax == 1)
		{
			$this->load->model('default/message_model');
			$return = array();
			$mid = (int) $this->input->post("mid");
			$reciever_id = (int) $this->input->post("reciever");
			if($mid <= 0 || $reciever_id <= 0 || !$this->message_model->is_valid_reciever($mid, $reciever_id, $this->session->user['id']))
			{	
				$return['status'] = "failed";
				echo json_encode($return);
				die;
			}
			else
			{				
				$message = $this->message_model->get_message($mid, $reciever_id, $this->session->user['id']);
				if(count($message) == 1)
				{
					$return['status'] = "success";
					$return['message'] = $message->message;
					$return['sender'] = $message->sender;
					$return['date'] = get_date_format($message->created_at);
					echo json_encode($return);
				}
				else
				{
					$return['status'] = "failed";
					echo json_encode($return);
					die;
				}
			}
		}
		else	
		{
			show_error("Bad Request", 400);
		}
	}
	
	public function viewmessage()
	{
		$is_ajax = $this->input->post("ajax");
		if($is_ajax == 1)
		{
			$this->load->model('default/message_model');
			$return = array();
			$mid = (int) $this->input->post("mid");
			$reciever_id = (int) $this->input->post("reciever");
			$sender_id = $this->session->user['id'];
			$rel = (int) $this->input->post("rel");
			if($rel == 1)
			{
				$reciever_id = $this->session->user['id'];
				$sender_id = (int) $this->input->post("reciever");
			}

			if($mid <= 0 || $reciever_id <= 0 || !$this->message_model->is_valid_reciever($mid, $sender_id, $reciever_id))
			{	
				$return['status'] = "failed";
				echo json_encode($return);
				die;
			}
			else
			{				
				$message = $this->message_model->get_message($mid, $sender_id, $reciever_id);
				if(count($message) == 1)
				{
					$return['status'] = "success";
					$return['message'] = $message->message;
					$return['sender'] = $message->sender;
					$return['reply_text'] = $message->reply_text;
					$return['reply_date'] = get_date_format($message->updated_at);
					$return['send_date'] = get_date_format($message->created_at);
					echo json_encode($return);
				}
				else
				{
					$return['status'] = "failed";
					echo json_encode($return);
					die;
				}
			}
		}
		else	
		{
			show_error("Bad Request", 400);
		}
	}
	
	public function mymessages($page = 1)
	{
		$data = array(); 
		$filters = array();
		$this->load->model('default/message_model');
		
		$total_messages = $this->message_model->get_messages(1, "-1", $filters);//Get count data
		$total_messages = $total_messages[0]->total_messages;
		
		$pagination = $this->config->item('pagination');
		$pagination['base_url'] = base_url().'default/myaccount/mymessages';
		$pagination['total_rows'] = $total_messages;		
		$pagination['per_page'] = 40;
		$pagination['uri_segment'] = 4;
		
		$this->pagination->initialize($pagination);
		
		$limitstart = '0';
		if(isset($page) && $page > 1){
			$limitstart = ($pagination['per_page'] * $page) - $pagination['per_page']; 
        }
		$data['messages'] = $this->message_model->get_messages($pagination['per_page'], $limitstart, $filters);//fetch all data
        $data['pagination'] = $this->pagination->create_links();
		
		
		$data['active_tabs'] = "mymessages";
		$this->template->content->view('myaccount/mymessages_view', $data);
        $this->template->publish();
	}
	
	public function sendmessage()
	{
		$is_ajax = $this->input->post("ajax");
		if($is_ajax == 1)
		{
			$this->load->model('default/message_model');
			$return = array();
			$receiver_id = (int) $this->input->post("reciever");
			$mid = (int) $this->input->post("mid");
			$reply_text = strip_tags($this->input->post("message"));			
			if($receiver_id == 0 || $mid == 0 || !$this->message_model->is_valid_reciever($mid, $receiver_id, $this->session->user['id'], 0))
			{
				$return['status'] = "failed";
				echo json_encode($return);
				die;
			}
			else
			{
				$data = array();
				$data['reply_text'] = $reply_text;
				$data['is_replied'] = 1;
				$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
				
				$cond = array();
				$cond['id'] = $mid;
				$cond['sender_id'] = $receiver_id;
				$cond['receiver_id'] = $this->session->user['id'];
				
				$mid = $this->message_model->save_message($data, $cond);
				if($mid > 0)
				{
					$this->session->set_flashdata('mymessage_msg', 'You have replied successfully');
					$return['status'] = "success";
					echo json_encode($return);
					die;
				}
			}
		}
		else
		{
			show_error("Bad Request", 400);
		}
	}
	
	public function wishlist($page = 1)
	{
		$data = array(); 
		$filters = array();
		$this->load->model('default/message_model');
		
		$total_wishlist = $this->message_model->get_wishlists(1, "-1", $filters);//Get count data
		$total_wishlist = $total_wishlist[0]->total_wishlist;
		
		$pagination = $this->config->item('pagination');
		$pagination['base_url'] = base_url().'default/myaccount/wishlist';
		$pagination['total_rows'] = $total_wishlist;		
		$pagination['per_page'] = 40;
		$pagination['uri_segment'] = 4;
		
		$this->pagination->initialize($pagination);
		
		$limitstart = '0';
		if(isset($page) && $page > 1){
			$limitstart = ($pagination['per_page'] * $page) - $pagination['per_page']; 
        }
		$data['wishlists'] = $this->message_model->get_wishlists($pagination['per_page'], $limitstart, $filters);//fetch all data
        $data['pagination'] = $this->pagination->create_links();
		
		$data['default_image'] = $this->config->item('default_image');
		$data['active_tabs'] = "wishlist";
		$this->template->content->view('myaccount/mywishlist_view', $data);
        $this->template->publish();
	}
	
	public function removewishlist($wishid = 0, $product_id = 0)
	{
		$wishid = (int) $wishid;
		$product_id = (int) $product_id;
		$this->load->model('default/message_model');
		if($wishid <= 0 || $product_id <= 0 || !$this->message_model->is_valid_wishlist($this->session->user['id'], $wishid, $product_id))
		{
			show_error("Bad request", 400);
		}
		
		$data = array();
		$data['status'] = 0;
		$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
		
		$cond = array("id" => $wishid, "user_id" => $this->session->user['id'], "product_id" => $product_id);
		$wish_id = $this->message_model->save_wishlist($data, $cond);
		if($wish_id > 0)
		{
			$this->session->set_flashdata('mywish_msg', 'A gemstone has been removed from wishlist successfully.');
		}
		else
		{
			$this->session->set_flashdata('mywish_msg', 'Gemstone has no been removed from wishlist.');
		}
		redirect('/default/myaccount/wishlist');
	}
	
	public function productchstatus($status, $sid = 0, $pid = 0)
	{
		$sid = (int) $sid;
		$pid = (int) $pid;
		$this->load->model('default/store_model');
		//Check valid product that related to user's store
		if(($sid <= 0 && $pid <= 0 && !$this->store_model->is_valid_user_store_product($sid, $this->session->user['id'], $pid)))
		{
			show_error("Bad request", 400);
		}
		
		$data = array();
		$msg = "";
		if($status == 1)
		{
		    $data['status'] = 0;	
			$msg = "Product has been inactive now.";	
		}
		
		if($status == 0)
		{
			$data['status'] = 1;
			$msg = "Product has been active now.";
		}
		
		$data['updated_at'] = $this->current_date_obj->format("Y-m-d H:i:s");
		
		$product_id = $this->store_model->save_product($data, $pid);
		if($product_id > 0)
		{	
			$this->session->set_flashdata('myproduct_msg', $msg);
			redirect('/default/myaccount/myproducts/'.$sid);
		}
		else
		{
			$this->session->set_flashdata('myproduct_msg', 'Some technical problem occur...');
		}
		
		redirect('/default/myaccount/wishlist');
	}
	
}
