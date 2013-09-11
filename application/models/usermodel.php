<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usermodel extends CI_Model {

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function create_user()
	{
		$pass = $this->input->post('password');
		
		// Hash the encrypted password using sha384 - returns 64 characters
		$hashed_pass = hash("sha384", $pass);
		
		$data = array(
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'password' => $hashed_pass
		);
		$query = $this->db->insert('users', $data);
		
		return $data;
	}
	
	function get_user($id)
	{
		$this->db->where('id', $id);
		
		$query = $this->db->get('users');
		return $query;
	}
	
	function login($email, $pass)
	{
		$success = false;
		
		$this->db->where('email', $email);
		$this->db->where('password', $pass);
		
		$query = $this->db->get('users');
		
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $rows)
			{
				$newdata = array(
					'user_id' => $rows->id,
					'username' => $rows->username,
					'email' => $rows->email,
					'logged_in' => true
				);
			}
			$this->session->set_userdata($newdata);
			$success = true;
		}

		return $success;
	}
}