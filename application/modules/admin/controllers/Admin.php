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
	
	public function forgetpassword($id = 0)
	{
		if(!isset($this->session->adminuser['id']))
		{	
		    $data = array();
		   if($this->input->post())
		   {
		   		 $this->form_validation->set_rules('email', 'Email', 'required');
				 if ($this->form_validation->run() == true)
				{
				    $email = $this->input->post('email');
					$this->load->model('admin/login_model');
			        $adminuser = $this->login_model->check_user($email);
					if($adminuser =='S')
			        {
						 $data['rndurl'] = md5( sha1( time() + rand(0, time()) ) );
						 $data['email'] = $email;
						 $userID = $this->login_model->getID($email);
						 $data['userid']= $userID->id; 
						  $ses="admin@gemstone.com";
                        $body = $this->load->view('email-format/reset-password', $data, true);  
						$headers = "From: ".$ses."\r\n";
						$headers .= "CC:umeshsamal3@gmail.com\r\n";
						$headers .= "BCC:umeshsamal070@gmail.com\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
						$header .="Dear";
						$header .="To initiate the password reset process for your Gemstone Account.";
						$header .="click the link below:";
						$message = $body;
						$to=$email;
						$subject="Forget Password";
						$set=mail($to,$subject,$message,$headers);  
					}
					else
					{
						$data['loginmsg'] = 'Email Not Found';	
					}
				}
				 
		   }
		
				$this->template->set_template('layout/layout_login');
			     $this->template->content->view('login/forgetpassword_view',$data);

			$this->template->publish();
		}
		else
		{
			redirect('/admin/dashboard');
		}
	} 
	public function createpassword($id1=NULL)
	{
	
	if(!isset($this->session->adminuser['id']))
	{		
		   $data = array();
		  
			
		   if($this->input->post())
		   {
		   
		//echo $id1; die;
		   		 $this->form_validation->set_rules('npassword', 'New password', 'required');
				 $this->form_validation->set_rules('cpassword', 'Confirm password', 'required');
				 if ($this->form_validation->run() == true)
				{
				    $npass = $this->input->post('npassword');
					$cpass = $this->input->post('cpassword');
					if($npass == $cpass)
					{
						
						$this->load->model('admin/login_model');
						$changepassword = $this->login_model->changepassword($npass,$id1);
							redirect('/admin');
					}
					else
					{
						$data['loginmsg'] = 'Confirm Password not match';	
					}
	
	             }
		   }
			$this->template->set_template('layout/layout_login');
			$this->template->content->view('login/createpassword_view',$data);
		

			$this->template->publish();
		}
		else{
			redirect('/admin/dashboard');
		}
	}
	
	public function dashboard()
	{
		if(isset($this->session->adminuser['id']))
		{
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
