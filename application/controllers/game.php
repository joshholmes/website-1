<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Game extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('usermodel');
	}
	
	public function index()
	{
		if($this->usermodel->check_admin($this->session->userdata('username')))
		{
			$data['admin_header'] = false;
			$this->load->view('header', $data);
			$this->load->view('game/game', $data);
			$this->load->view('footer', $data);			
		} else
		{
			$data['admin_header'] = false;
			$this->load->view('header', $data);
			$this->load->view('home', $data);
			$this->load->view('footer', $data);
		}
	}
}