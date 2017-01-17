<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {
	
	function __construct(){
            parent::__construct();
            $this->load->model('default/search_model');
	}

        
}
