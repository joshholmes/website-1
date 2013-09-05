<?php

class Playermodel extends CI_Model {
	
	var $name = '';
	
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function create_player($name)
	{
		$this->name = $name;
		$query = $this->db->insert('players', $this);
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