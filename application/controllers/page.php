<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends BW_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pagemodel');
	}
	
	public function index ()
	{		
		$slug = $this->uri->segment(1);
		$page = $this->pagemodel->getPage($slug);

		if ($page)
		{
			if ($page["adminOnly"] && !$this->session->userdata('isAdmin'))
				$this->showAdminError();
			else
				$this->loadPage("genericPage", $page);
		}
		else
			show_404();
	}

}