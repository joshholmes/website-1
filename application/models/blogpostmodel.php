<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blogpostmodel extends CI_Model
{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function createPost ($data)
	{
		$data['date_created'] = date('Y-m-d H:i:s');
		$this->db->insert("pages", $data);
	}
	
	public function getPostById ($id)
	{
		$this->db->where("id", $id);
		return $this->db->get("blog_posts")->row_array();
	}

	public function getRecent ($count = 10)
	{
		$this->db->where("is_published", 1);
		$this->db->order_by("date_published", "desc");
		return $this->db->get("blog_posts", $count)->result_array();
	}
	
	public function getCategory ($id)
	{
		$this->db->where("id", $id);
		return $this->db->get("blog_categories")->row();
	}

}