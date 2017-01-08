<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	private $current_date_obj = null;
	public function __construct(){
		parent::__construct();
		$this->current_date_obj = new DateTime();
		$this->template->set_template('layout/layout');	
		$this->load->model('default/search_model');
		$this->load->helper('default/Default');	
	}
	
	
	public function index1()
	{
		$data = array();
		$searchdata = $this->input->get();
		$searchdata = array_map('trim', $searchdata);
		
		$data['gemstones'] = $this->search_model->get_gemstones(15, 0, $searchdata);//fetch all data
		$data["store_img_upload_path"] = $this->config->item('store_img_upload_path');
		$data["default_image"] = $this->config->item('default_image');
		$data['searchdata'] = $searchdata;
		$this->template->content->view('product/search_view', $data);
        $this->template->publish();
	}
	public function index()
	{
	    $searchdata = $_GET["keyword"]; 
		$data = array();
		$data['searchdata'] = $this->search_model->get_data($searchdata);//fetch all data
        $this->template->publish();
	}
	

}
