<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usermodel extends CI_Model {

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function create_user()
	{
		// We'll encrypt their username to use it as a salt
		$salt = hash("sha384", $this->encrypt->encode($this->input->post('username')));
		$pass = $this->input->post('password');
		$salty_pass = $salt . $pass;
		
		// Hash the salty password using sha384 - returns 96 characters
		$hashed_pass = hash("sha384", $salty_pass);
		
		$data = array(
			'firstname' => $this->input->post('firstname'),
			'lastname' => $this->input->post('lastname'),
			'username' => $this->input->post('username'),
			'salt' => $salt,
			'password' => $hashed_pass,
			'email' => $this->input->post('email')
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
		$salt = '';
		
		// Get user associated with this email
		$this->db->where('email', $email);
		$query = $this->db->get('users');

		// Did we get one?		
		if($query->num_rows() > 0)
		{
			// Let's grab the user's information
			foreach($query->result() as $rows)
			{
				// Let's grab the user's salt
				$salt = $rows->salt;
			}
		}

		// Set up the salted password
		$salty_pass = $salt . $pass;
		
		// Hash the salty password
		$hashed_pass = hash("sha384", $salty_pass);
		
		// Check the user's password
		$this->db->where('email', $email);
		$this->db->where('password', $hashed_pass);
		$query = $this->db->get('users');

		// Any results?
		if($query->num_rows() > 0)
		{
			foreach($query->result() as $rows)
			{
				// Let's store the information in the session
				$newdata = array(
					'user_id' => $rows->id,
					'username' => $rows->username,
					'firstname' => $rows->firstname,
					'lastname' => $rows->lastname,
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