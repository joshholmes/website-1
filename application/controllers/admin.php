<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('usermodel');
	}
	
	public function index()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/admin');
		$this->load->view('admin/footer');
	}
}