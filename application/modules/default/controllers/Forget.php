<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forget extends CI_Controller {

	private $current_date_obj = null;
	
	public function __construct(){
		parent::__construct();
		
		$this->current_date_obj = new DateTime();
		$this->template->set_template('layout/layout');
		$this->load->helper('default/Default');	
		$this->load->model('default/login_model');		
	}
	public function createpassword($ID1=NULL)
	{
		   if(!isset($this->session->adminuser['id']))
		   {		
		 		  $data = array();
		   if($this->input->post())
		   {
		   		 $this->form_validation->set_rules('npass', 'New password', 'required');
				 $this->form_validation->set_rules('cpass', 'Confirm password', 'required');
				 if ($this->form_validation->run() == true)
				{
				    $npass = $this->input->post('npass');
					$cpass = $this->input->post('cpass');
					if($npass == $cpass)
					{
					
					    	$this->load->model('default/login_model');  
						    $changepassword = $this->login_model->changepassword($npass,$ID1);
							redirect('login');
					}
					else
					{
						$data['loginmsg'] = 'Confirm Password not match';	
					}
	
	             }
		   }
	  $this->template->content->view('login/createpassword_view', $data);
		   $this->template->publish();
		}
		else{
			redirect('/admin/dashboard');
		}
		  
	}
	
	public function index()
	{
		$data = array(); 
		if(isset($this->session->user['id']))
		{
			redirect('/default/myaccount/dashboard');
		}
		else
		{
			if($this->input->post())
			{
				$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
				if ($this->form_validation->run() == true)
				{
					$user = $this->login_model->check_login($this->input->post('email_login'), $this->input->post('password'));
					
				    $email = $this->input->post('email');
					$this->load->model('default/login_model');
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
					echo	$message = $body; die;
						$to=$email;
						$subject="Forget Password";
						$set=mail($to,$subject,$message,$headers);  
						$data['msg'] ="";
						
						
					}
					else
					{
						$data['loginmsg'] = 'Email Not Found';	
					}
					
				
				}
				else
				{
					$data['ofo_loginmsg'] = 'Invalid email or password!';	
				}
			}
			$this->template->content->view('login/forget_view', $data);
			$this->template->publish();
		}
		
	}
	

	
	public function register()
	{
		$data = array(); 
		
		if(isset($this->session->user['id']))
		{
			redirect('/default/myaccount/dashboard');
		}
		else
		{
			if($this->input->post())
			{
				$this->form_validation->set_error_delimiters('<label class="error">', '</label>');	
				$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean|callback_is_unique_email');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|xss_clean');
				$this->form_validation->set_rules('confpassword', 'Confirm Password', 'trim|required|min_length[6]|matches[password]|xss_clean');
				if ($this->form_validation->run() == true)
				{
					$data['name'] = $this->input->post('name');
					$data['email'] = $this->input->post('email');
					$data['password'] = $this->input->post('password'); 	
					$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
					$data['token'] = md5($data['email'].time().$this->config->item('email_token'));
					$data['created_at'] = $this->current_date_obj->format('Y-m-d H:i:s');
					$userid = $this->login_model->save_user($data);
					if($userid > 0){
						//Send Comfirmation E-mail						
						$link = base_url().'default/login/activate/'.$userid.'/'.$data['token'];
						$html_body = '<table><tr><td>Hi,</td></tr>
										<tr><td>&nbsp;</td></tr>
										<tr><td>Please activate your account by clicking below link.</td></tr>
										<tr><td>&nbsp;</td></tr>
										<tr><td>'.$link.'</td></tr>
										<tr><td>&nbsp;</td></tr>
										<tr><td>Thanks<br>oforornament Team</td></tr>
									</table>'; 
						send_mail($data['email'], 'Confirmation Email - '.$this->config->item('from_name'), $html_body);						
						redirect('/default/login/confirmemail/'.$userid.'/'.md5($userid));
					}
				}
				else
				{
					$data['name'] = html_escape($this->input->post('name'));
					$data['email'] = html_escape($this->input->post('email'));
				}
			}
		}	
		$this->template->content->view('login/register_view', $data);
        $this->template->publish();
	}
	public function is_unique_email($value)
	{	
		$result = is_unique_value("ofo_users", array("email" => $value));
		if(!$result)
		{
			$this->form_validation->set_message('is_unique_email', 'This {field} already exists.');
			return false;
		}
		else
		{
			return true;
		}
	}
	
	public function logout()
	{
		unset($this->session->user);
		$this->session->sess_destroy();
		redirect('/login');
	}
	
	public function confirmemail($userid, $token, $is_resend = false)
	{
		$data = array(); 
		$userid = (int) $userid;
		if(md5($userid) == $token)
		{
			$this->template->content->view('login/confirmemail_view', $data);
			$this->template->publish();
		}
		else
		{
			redirect('/');
		}
	}
	
	public function activate($userid, $token)
	{	
		$userid = (int) $userid;
		$user = $this->login_model->get_user($userid, 0, $token);
		
		if(count($user) > 0)
		{	
			$data = array();
			$data['status'] = 1;
			$data['updated_at'] = $this->current_date_obj->format('Y-m-d H:i:s');
			$userid = $this->login_model->save_user($data, $userid);
			if($userid > 0)
			{
				$this->session->set_flashdata('user_msg', 'Your account has been activated successfully. Please login!');
			}
			else
			{
				$this->session->set_flashdata('user_msg', 'Your account is not activated. Please try again or contact us.');
			}
		}
		else
		{
			$this->session->set_flashdata('user_msg', 'Your account does not exist or already register. If you have any problem please contact us.');
		}
		redirect('/login');
	}
	
}
