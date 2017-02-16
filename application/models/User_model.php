<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	function login($username, $password){
		$this -> db -> select('id, user_name, user_email, user_password');
		$this -> db -> from('users');
		$this -> db -> where('user_name', $username);
		$this -> db -> where('user_password', MD5($password));
		$this -> db -> limit(1);

		$query = $this -> db -> get();

		if($query -> num_rows() == 1)
		{
	   	 //login success
			return $query->result();
		}
		else
		{
			return false;
		}
	}



	function add_user($username, $email, $password) {

		$data = array(
			'user_name' => $username,
			'user_email' => $email,
			'user_password' => md5($password)
			);

		$this->db->insert('users', $data);

		//echo "Affected rows: " . $this->db->affected_rows();
	}

	function get_user_avatar_num($username) {
		$this -> db -> select('avatar_num');
		$this -> db -> from('users');
		$this -> db -> where('user_name', $username);
		$this -> db -> limit(1);
		$query = $this -> db -> get();		

		// if user avatar not found use default = 1
		if($query -> num_rows() == 0)
			return 1;
		else
			return $query->row()->avatar_num;

	}

	function change_user_avatar_num($username, $num) {
		$data = array('avatar_num' => $num);

		$this->db->where('user_name', $username);
		$this->db->update('users', $data);
		echo $this->db->last_query();
	}
}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */