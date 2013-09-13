<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('usermodel');
	}
	
	public function index()
	{
		$data['admin'] = true;
		$this->load->view('header', $data);
		$this->load->view('admin/admin', $data);
		$this->load->view('footer', $data);
	}
}