<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Game extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('playermodel');
	}
	
	public function index()
	{
		if($this->session->userdata('user_name'))
		{
			$this->game();
		}
		else
		{
			$data['title'] = 'Registration';
			$this->load->view('register', $data);
		}
	}
	
	public function game()
	{
		$data['title'] = 'Game';
		$this->load->view('game', $data);
	}
	
	public function register()
	{
	}
	
	public function login()
	{
		$email = $this->input->post('email');
		$pass = $this->input->post('password');
		
		// Encrypt the password using CI's encrypt class
		$encrypted_pass = $this->encrypt->encode($pass);
		
		// Hash the encrypted password using sha384 - returns 64 characters
		$hashed_pass = hash("sha384", $encrypted_pass);
		
		$result = $this->playermodel->login($email, $pass);
		if($result) $this->welcome();
		else $this->index();
	}
	
	public function thank()
	{
		$this->load-view('thank');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */