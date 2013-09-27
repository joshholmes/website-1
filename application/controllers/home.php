<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends BW_Controller
{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index ()
	{		
		if ($this->isLoggedIn())
			echo "<p>Hey <strong>" . $this->session->userdata('username') . "</strong>!</p>";

		echo "<p>home page!</p>";
	}
	
}