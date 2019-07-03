<?php
defined('BASEPATH') OR exit('No direct access allowed');

class Users_model extends CI_Model
{
	public function save($userdata)
	{
		$this->load->database();
		$this->db->insert('users',$userdata);
		return $this->db->insert_id();
	}
}