<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagemodel extends CI_Model
{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	public function createPage ($data)
	{
		$data['date_created'] = date('Y-m-d H:i:s');
		$this->db->insert("pages", $data);
	}
	
	public function getPage ($slug)
	{
		$this->db->where("slug", $slug);
		return $this->db->get("pages")->row_array();
	}
	
}