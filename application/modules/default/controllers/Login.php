<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	private $current_date_obj = null;
	
	public function __construct(){
		parent::__construct();
		
		$this->current_date_obj = new DateTime();
		$this->template->set_template('layout/layout');
		$this->load->helper('default/Default');	
		$this->load->model('default/login_model');		
	}
	
	
	public function index()
	{
	 
		$data = array(); 
		if(isset($this->session->user['id'])){
			redirect('/default/myaccount/dashboard');
		}else{
			if($this->input->post()){
				$this->form_validation->set_rules('email_login', 'Email', 'trim|required|xss_clean');
				$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
				if ($this->form_validation->run() == true)
				{
					$user = $this->login_model->check_login($this->input->post('email_login'), $this->input->post('password'));
					if($user){
						$user = array(
								'id' => $user->id,
								'name' => $user->name,
								'email' => $user->email,
								'status' => $user->status
								);
						$this->session->user = $user;
						redirect('/default/myaccount/dashboard');
					}
					else
					{
						$data['ofo_loginmsg'] = 'Invalid email or password!';	
					}
				}
				else
				{
					$data['ofo_loginmsg'] = 'Invalid email or password!';	
				}
			}
			$this->template->content->view('login/login_view', $data);
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
