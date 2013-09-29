<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BW_Controller extends CI_Controller
{

	public function __construct($adminOnly = false)
	{
		parent::__construct();
		if ($adminOnly && !$this->session->userdata('isAdmin'))
			$this->showAdminError();
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

	protected function showAdminError ()
	{
		show_error("Only admins can access this page." , 403);		
	}

}