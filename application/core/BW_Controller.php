<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BW_Controller extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();	
	}

	protected function loadPage ($pageName, $data)
	{
		$this->load->view('header', $data);
		$this->load->view($pageName, $data);
		$this->load->view('footer', $data);
	}
	
	protected function isLoggedIn ()
	{
		return $this->session->userdata('username') !== FALSE;
	}

}