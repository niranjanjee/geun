<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	private $current_date_obj = null;
	public function __construct(){
		parent::__construct();
		$this->current_date_obj = new DateTime();
		$this->template->set_template('layout/layout');	
		$this->load->model('default/search_model');
	}
	
	public function search()
	{
			echo "Hello";  die;
	}
	
	public function index()
	{
		$data = array();
        $data["gems_categories"] = $this->search_model->show_category();
		
		
		
		$data['gemstones'] = $this->search_model->get_gemstones(15, 0);//fetch all data
		//$data["pagination"] = $result['pagination'];
		$data["store_img_upload_path"] = $this->config->item('store_img_upload_path');
		$data["default_image"] = $this->config->item('default_image');
		$this->template->content->view('home/home_view', $data);
        $this->template->publish();
	}
	
	//Not in user this function
	private function get_products()
	{		
		$return = array();
		$total_products = $this->search_model->get_gemstones(1, "-1");//Get count data
		$total_products = $total_products[0]->total_products;
		
		$pagination = $this->config->item('pagination');
		$pagination['base_url'] = base_url().'default/myaccount/myproducts';
		$pagination['total_rows'] = $total_products;		
		$pagination['per_page'] = 15;
		$pagination['uri_segment'] = 3;
		
		$this->pagination->initialize($pagination);
		
		$limitstart = '0';
		if(isset($page) && $page > 1){
			$limitstart = ($pagination['per_page'] * $page) - $pagination['per_page']; 
        }
		$return['gemstones'] = $this->search_model->get_gemstones($pagination['per_page'], $limitstart);//fetch all data
        $return['pagination'] = $this->pagination->create_links();
		return $return;
	}
}
