<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gemstone extends CI_Controller {

	private $current_date_obj = null;
	public function __construct(){
		parent::__construct();
		$this->current_date_obj = new DateTime();
		$this->template->set_template('layout/layout');	
		$this->load->model('default/store_model');
		$this->load->helper('default/Default');	
	}
	
	public function index()
	{
	   echo "dfdsf";  die;
	}
	public function item($pid)
	{
		$pid = (int) $this->uri->segment(3);
		if($pid <= 0 && !$this->store_model->is_product_exist($pid))
		{
			show_error("Bad Request", 400);
		}
		$data = array();
		
		$data["product"] = $this->store_model->get_product_byid($pid);
		if(count($data["product"]) == 0)
		{
			show_error("Bad Request", 400);
		}
		
		$data["default_image"] = $this->config->item('default_image');
		$this->template->content->view('product/item_view', $data);
        $this->template->publish();
	}

}
