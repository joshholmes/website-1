<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('usermodel');
	}
	
	public function index()
	{
		if($this->usermodel->check_admin($this->session->userdata('username')))
		{
			$data['admin'] = true;
			$this->load->view('header', $data);
			$this->load->view('admin/admin', $data);
			$this->load->view('footer', $data);			
		} else
		{
			$data['admin'] = false;
			$this->load->view('header', $data);
			$this->load->view('home', $data);
			$this->load->view('footer', $data);
		}
	}
}