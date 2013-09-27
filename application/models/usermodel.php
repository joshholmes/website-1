<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usermodel extends CI_Model {

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function create_user ($data)
	{
		// We'll encrypt their username to use it as a salt
		$salt = hash("sha384", $this->encrypt->encode( $data["username"] ));
		$pass = $data["password"];
		$salty_pass = $salt . $pass;
		
		// Hash the salty password using sha384 - returns 96 characters
		$hashed_pass = hash("sha384", $salty_pass);
		
		$data["password"] = $hashed_pass;
		$data["salt"] = $salt;

		$fb_user = $data['fb_user'];
		unset($data['fb_user']);
		
		$query = $this->db->insert('users', $data);
		
		if (!empty($fb_user))
		{
			$user_id = $this->db->insert_id();
			$this->db->insert("facebook_users", array("user_id" => $user_id, "facebook_id" => $fb_user));
		}
	}
	
	function addFacebookUser ($fb_user)
	{
		$this->db->where('email', $fb_user["email"]);
		$query = $this->db->get('users');
		
		if ($query->num_rows() > 0)
		{
			$user_id = $query->row()->id;
			$this->db->insert("facebook_users", array("user_id" => $user_id, "facebook_id" => $fb_user["id"]));
		}
	}
	
	function check_user_exists($username)
	{
		$this->db->where('username', $username);
		
		$query = $this->db->get('users');

		return ($query->num_rows() > 0) ? true : false;
	}
	
	function check_email_exists($email)
	{
		$this->db->where('email', $email);
		
		$query = $this->db->get('users');
		
		return ($query->num_rows() > 0) ? true : false;		
	}
	
	function check_admin($username)
	{
		$this->db->where('username', $username);
		
		$query = $this->db->get('users');
		
		foreach ($query->result() as $row)
		{
			$is_admin = $row->isadmin;
		}
		return $is_admin;
	}

	function facebookLogin ($fb_user)
	{
		$success = false;
		
		$this->db->where('facebook_id', $fb_user['id']);
		$query = $this->db->get('facebook_users');
		
		if($query->num_rows() > 0)
		{
			$this->db->where("id", $query->row()->user_id);
			$userQuery = $this->db->get('users');
			
			if($userQuery->num_rows() > 0)
			{
				foreach($userQuery->result() as $rows)
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
			
		}
		
		return $success;
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