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
	   $keyword = $_GET['term']; 
        $data['response'] = 'false'; //Set default response
        $query = $this->search_model->lookup($keyword); //Search DB
        if( ! empty($query) )
        {
            $data['response'] = 'true'; //Set response
            $data['message'] = array(); //Create array
            foreach( $query as $row )
            {
                $data['message'][] = array( 
                                        'id'=>$row->id,
                                        'value' => $row->name,
                                        ''
                                     );  //Add a row to array
            }
        }
        if('IS_AJAX')
        {
            echo json_encode($data); //echo json string if ajax request
              
        }
        else
        {
            $this->load->view('autocomplete/index',$data); //Load html view of search results
        }
	}
	


}
