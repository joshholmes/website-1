<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Game extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('usermodel');
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
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */