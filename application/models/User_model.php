<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');


class User_model extends CI_Model {

	var $start = 0;
    var $limit = 10;
    var $page = 0;
	var $found_row = 0;

	function __construct() 
	{
		parent::__construct();        
    }	

    public function get_user($username, $password)
	{
		$query = $this->db->get_where('user', array('Username' => $username, 'Password' => $password));
		$result = $query->result();
		return $result;
	}

	public function get_user_by_id($id)
	{
		$query = $this->db->get_where('user', array('ID' => $id));
		$result = $query->result();
		return $result;
	}

	public function update_profile($id, $username, $password)
	{
		$param = array(
			'Username' => $username,
			'Password' => $password
			);
		$this->db->where('ID', $id);
		$this->db->update('user', $param); 
	}
}