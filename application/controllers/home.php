<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('usermodel');
	}
	
	public function index()
	{
		if($this->session->userdata('user_name'))
		{
			$this->welcome();
		}
		else
		{
			$data['title'] = 'Registration';
			$this->load->view('header', $data);
			$this->load->view('registration', $data);
			$this->load->view('footer', $data);
		}
	}
	
	public function welcome()
	{
		$data['title'] = 'Index';
		$this->load->view('header', $data);
		$this->load->view('home', $data);
		$this->load->view('footer', $data);
	}
	
	public function login()
	{
		$email = $this->input->post('email');
		$pass = $this->input->post('password');
				
		$result = $this->usermodel->login($email, $pass);
		if($result) $this->welcome();
		else $this->index();
	}
	
	public function thank()
	{
		$data['title'] = 'Thank you!';
		$this->load->view('header', $data);
		$this->load->view('thank', $data);
		$this->load->view('footer', $data);
	}
	
	public function registration()
	{
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required||xss_clean');
		$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required||xss_clean');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|max_length[18]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[32]');
		$this->form_validation->set_rules('con_password','Confirm Password', 'trim|required|matches[password]');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			$this->usermodel->create_user();
			$this->thank();
		}
	}

	public function validate_user()
	{
		$username = $this->input->post('username');
		$result = $this->usermodel->check_user_exists($username);
		
		echo $result;
	}

	public function validate_email()
	{
		$username = $this->input->post('email');
		$result = $this->usermodel->check_email_exists($email);
		
		echo $result;
	}
	
	public function logout()
	{
		$newdata = array(
		'user_id' => '',
		'username' => '',
		'email' => '',
		'logged_in' => false
		);
		
		$this->session->unset_userdata($newdata);
		$this->session->sess_destroy();
		$this->index();
	}
}