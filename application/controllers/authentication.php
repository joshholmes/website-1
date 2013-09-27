<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends BW_Controller
{

	public function __construct ()
	{
		parent::__construct();
		$this->data = array();

		$this->load->model('usermodel');
		
		parse_str( $_SERVER['QUERY_STRING'], $_REQUEST );
        
        $this->setupFacebookAuth();
		$this->setupTwitterAuth();
	}
	
	private function setupFacebookAuth ()
	{
		$CI = & get_instance();
		$CI->config->load("facebook",TRUE);
		$config = $CI->config->item('facebook');
		$this->load->library('Facebook', $config);
		
		$this->data["fb_url"] = $this->facebook->getLoginUrl(array('scope'=>'email'));
	}
	
	private function setupTwitterAuth ()
	{
		
	}

	public function validate_user ()
	{
		$username = $this->input->post('username');
		$is_valid = (preg_match('/^[A-Za-z]{1}[A-Za-z0-9]{5,31}$/', $username) == 1)  && !$this->usermodel->check_user_exists($username);
		
		echo $is_valid;
	}

	public function validate_email ()
	{
		$this->load->helper('email');
		$email = $this->input->post('email');
		$is_valid = valid_email( $email ) && !$this->usermodel->check_email_exists($email);
		
		echo $is_valid;
	}
	
	public function logout ()
	{
		$newdata = array(
			'user_id' => '',
			'username' => '',
			'email' => '',
			'logged_in' => false
		);
		
		$this->session->unset_userdata($newdata);
		$this->session->sess_destroy();
		
		redirect("/");
	}
	
	public function login ()
	{
		if ($this->isLoggedIn())
			redirect("/");
		
		$data = $this->data;
		
		if ($_SERVER['REQUEST_METHOD'] === 'POST')
			$data = array_merge($data, $this->processLogin());
		else
			$data = array_merge($data, $this->checkFacebook());

		if ($data["fb_auth"])
		{
				$data["success"] = $this->usermodel->facebookLogin($data["fb_user"]);
		}

		if ($this->input->is_ajax_request())
		{
			if (isset($data["success"]) && $data["success"])
				echo "success";
			else
				echo "error";
		}
		else
		{
			if (isset($data["success"]) && $data["success"])
				redirect("/");
			else
				$this->loadPage("login", $data);
		}
	}
	
	private function processLogin ()
	{
		$data = $this->data;

		$email = $this->input->post('signin_email');
		$pass = $this->input->post('signin_password');
		
		$data["success"] = $this->usermodel->login($email, $pass);
		
		return $data;
	}
	
	public function signup ()
	{
		if ($this->isLoggedIn())
			redirect("/");

		$data = $this->data;
		$data['fb_auth'] = false;

		if ($_SERVER['REQUEST_METHOD'] === 'POST')
			$data = array_merge($data, $this->processSignUp());
		else
			$data = array_merge($data, $this->checkFacebook());

		// check if user already has account with same email as facebook
		if ($data["fb_auth"] && $this->usermodel->check_email_exists( $data['fb_user']['email'] ))
		{
			// simply add facebook user to existing account
			$data["success"] = true;
			$this->usermodel->addFacebookUser( $data["fb_user"] );
		}
		
		// if signup was successful, log user in
		if (isset($data["success"]) && $data["success"])
		{
			if ($data["fb_auth"])
				$this->usermodel->facebookLogin($data["fb_user"]);
			else
				$this->usermodel->login($data["user"]["email"], $data["user"]["password"]);
		}
		
		// return data to user/redirect/etc
		if ($this->input->is_ajax_request())
		{
			if (isset($data["success"]) && $data["success"])
				echo "success";
			else
				echo "error";
		}
		else
		{
			if (isset($data["success"]) && $data["success"])
				redirect("/");
			else
				$this->loadPage("signup", $data);
		}
	}
	
	private function processSignUp ()
	{
		$data = $this->data;
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('fb_user', 'Facebook User', 'trim||xss_clean');
		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required||xss_clean');
		$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required||xss_clean');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|max_length[18]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[32]');
		$this->form_validation->set_rules('con_password','Confirm Password', 'trim|required|matches[password]');
		
		if($this->form_validation->run() == FALSE)
		{
			$data["success"] = false;
		}
		else
		{
			$data["user"] = array(
				'fb_user' => $this->input->post('fb_user'),
				'firstname' => $this->input->post('firstname'),
				'lastname' => $this->input->post('lastname'),
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'email' => $this->input->post('email'),
				'isadmin' => 0
			);
			
			$this->usermodel->create_user($data["user"]);
			$data["success"] = true;
		}

		return $data;
	}
	
	// check to see if current page has facebook access token
	private function checkFacebook ()
	{
		$data = array();

		$data['fb_auth'] = $this->facebook->getUser() != 0;
		
		if ($data['fb_auth'])
		{
			$data['fb_user'] = $this->facebook->api('/me');
		}

		return $data;
	}
	
	private function facebookAutoSignup ()
	{
		
	}
	
}