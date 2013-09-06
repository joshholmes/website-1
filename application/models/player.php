<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Playermodel extends CI_Model {

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function create_player()
	{
		$pass = $this->input->post('password');
		
		// Encrypt the password using CI's encrypt class
		$encrypted_pass = $this->encrypt->encode($pass);
		
		// Hash the encrypted password using sha384 - returns 64 characters
		$hashed_pass = hash("sha384", $encrypted_pass);
		
		$data = array(
			'username' => $this->input->post('username'),
			'email' => $this->input->post('email'),
			'password' => $hashed_pass
		);
		//$query = $this->db->insert('players', $data);
		
		return $data;
	}
	
	function get_player_by_id($id)
	{
		
	}
	
	function update_player_by_id($id)
	{
		
	}
	
	function delete_player_by_id($id)
	{
		
	}

}