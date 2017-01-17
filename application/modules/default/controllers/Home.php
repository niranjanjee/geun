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
                $data['getcatName']='';
                $catArr=  $data["gems_categories"];
                //$data['catJson']=  json_encode($catArr);
                //echo "<pre>";print_r($catArr); exit;
                $html="var countries={";
                foreach($catArr as $k=>$v){ 
                    $html .='"'.$v['id'].'"'.":".'"'.$v['name'].'",';
                }   
                $html=  trim($html,',');
                $html .="}";

                $file = fopen("assets/front/js/gemstone.js","w");
                fwrite($file,$html);
                fclose($file);
	//echo "<pre>";print_r($data["json_cat"]); exit;	
		
		
		$data['gemstones'] = $this->search_model->get_gemstones(15, 0);//fetch all data
		//$data["pagination"] = $result['pagination'];
		$data["store_img_upload_path"] = $this->config->item('store_img_upload_path');
		$data["default_image"] = $this->config->item('default_image');
		$this->template->content->view('home/home_view', $data);
        $this->template->publish();
	}
        
        function GetProductByAjaxCid()
        {
            $post = $this->input->post(NULL, TRUE);
            //echo $post['cn'];
            if ($post['cn'] != '') {
                //$data['getcatName']=$this->search_model->categoryname_by_id($uri);
                $itemName = $this->search_model->get_gemstones_bycid($post['cn']);
                if(count($itemName)>0){
                    echo json_encode(array("result"=>"S","data"=>$itemName));die;
                }else{
                    echo json_encode(array("result"=>"F"));die;
                }
            }
        }
        function GetProductByAjaxSubCid()
        {
            $post = $this->input->post(NULL, TRUE);
            //echo $post['cn'];
            if ($post['cn'] != '') {
                //$data['getcatName']=$this->search_model->categoryname_by_id($uri);
                $getcid=$this->search_model->category_by_subcatname($post['cn']);
                $itemName = $this->search_model->get_gemstones_bycid($getcid);
                if(count($itemName)>0){
                    echo json_encode(array("result"=>"S","data"=>$itemName));die;
                }else{
                    echo json_encode(array("result"=>"F"));die;
                }
            }
        }
        
        function getproductbyscid()
        {
            $uri=$this->uri->segment("2");
            //echo $uri; exit;
            $post = $this->input->post(NULL, TRUE);
            $data = array();
            $data["gems_categories"] = $this->search_model->show_category();
            $getcid=$this->search_model->category_by_subcatname($uri);
            
            if ($getcid != '') {
                $data['getcatName']=$this->search_model->categoryname_by_id($getcid);
                $itemName = $this->search_model->get_gemstones_bycid($getcid);
                //echo "<pre>";print_r($itemName); exit;
                $data['gemstones'] = $itemName;
		//$data["pagination"] = $result['pagination'];
		$data["store_img_upload_path"] = $this->config->item('store_img_upload_path');
		$data["default_image"] = $this->config->item('default_image');
		$this->template->content->view('home/home_view', $data);
                $this->template->publish();
            }
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
