<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends BW_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('blogpostmodel');
		$this->load->model('usermodel');
	}
	
	public function index ()
	{		
		echo "stuffs";	
	}

	public function post ($id = null)
	{
		if ($id == null)
			redirect("blog");
		
		$post = $this->blogpostmodel->getPostById($id);

		if ($post)
		{
			$post["author"] = $this->usermodel->getUser($post["author"]);
			$post["category"] = $this->blogpostmodel->getCategory($post["category"]);
			$post["date_created"] = new DateTime($post["date_created"]);
			$this->loadPage("blogpost", $post);
		}
		else
			show_404();

	}


}