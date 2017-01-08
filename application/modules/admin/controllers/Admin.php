<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_controller {

	public function __construct()
	{
		parent::__construct();		
	}
	
	
	public function index()
	{
		if(isset($this->session->adminuser['id'])){
			redirect('/admin/dashboard');
		}else{
			$this->template->set_template('layout/layout_login');
			$this->load->model('admin/login_model');
			$data = array();
			if($this->input->post())
			{
				$this->form_validation->set_rules('username', 'Username', 'trim|required');
				$this->form_validation->set_rules('password', 'Password', 'required');
				if ($this->form_validation->run() == true)
				{
					//Success						
					$adminuser = $this->login_model->check_login($this->input->post('username'), $this->input->post('password'));
					if($adminuser){
						$adminuser = array(
								'id' => $adminuser->id,
								'name' => $adminuser->name,
								'email' => $adminuser->email,
								'status' => $adminuser->status,
								'username' => $adminuser->username
								);
						$this->session->adminuser = $adminuser;
						redirect('/admin/dashboard');
					}
					else
					{
						$data['loginmsg'] = 'Invalid username or password!';	
					}
				}
				else	
				{
					//failure
					$data['loginmsg'] = 'Invalid username or password!';
				}
				
			}		
			$this->template->content->view('login/login_view', $data);
			$this->template->publish();
		}
	}
	
	public function forgetpassword()
	{
		if(!isset($this->session->adminuser['id'])){		
			$this->template->set_template('layout/layout_login');
			$this->template->content->view('login/forgetpassword_view', array('title' => 'Hello, world!'));
			//$this->load->view('welcome_message');

			$this->template->publish();
		}else{
			redirect('/admin/dashboard');
		}
	}
	
	public function dashboard()
	{
		if(isset($this->session->adminuser['id'])){
			$this->template->set_template('layout/layout');
			$this->template->content->view('dashboard/dashboard_view', array('title' => 'Hello, world!'));
			
			$this->template->publish();
		}else{
			redirect('/admin');
		}
	}
	
	public function logout()
	{			
		unset($this->session->adminuser);
		$this->session->sess_destroy();
		redirect('/admin');
	}
	
	
}
