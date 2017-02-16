<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat_model extends CI_Model {
	function add_new_msg($name, $email, $msg) {		

		//echo $name . $email. $msg;

		$data = array(
			'user_name' => $name,
			'user_email' => $email,
			'msg' => $msg
			);

		$this->db->insert('chat', $data);

		//echo "Affected rows: " . $this->db->affected_rows();
	}

	function get_all_msg() {
		$this->db->select('*');
		$this->db->from('chat');
		$this->db->order_by('time');	// the newer messages in the buttom
		//var_dump($query);
		$query = $this->db->get();
		return $query->result();
	}

	function get_msg($offset, $limit) {
		// (SQL) LIMIT $offset, $limit == [OFFSET $offset, LIMIT $limit]

		//default = no limit ,i.e. show all msg, same as get_all_msg()
		
		// $this->db->select('*');
		// $this->db->from('chat');
		// $this->db->order_by('time');
		// $this->db->limit($limit,$offset);	// = limit $offset,$limit in SQL
		// $query = $this->db->get();

		
		// //$sub_query = $this->db->last_query();
		// $sub_query =  $this->db->get_compiled_select();


		// //$this->db->order_by('id');	// get the newer msg to the buttom

		// $this->db->select('*');
		// $this->db->from('chat');
		// $this->db->where('id IN ($sub_query)', NULL, FALSE);
		$query = $this->db->query("
			select chat.id, chat.user_name,chat.msg, date_format(chat.time, '%T, %d %b') AS time, chat.user_email, users.avatar_num from chat inner join users on chat.user_name = users.user_name
			where chat.id IN 
			(select * from 
				(select chat.id from chat order by time desc limit ?,?) as q)", array(intval($offset),intval($limit)));


		// $query = $this->db->query("
		// 	select * from chat 
		// 	where id IN 
		// 	(select * from 
		// 		(select id from chat order by time desc limit ?,?) as q)", array(intval($offset),intval($limit)));


		//echo $this->db->last_query();

		return $query;

	}

	function get_num_all_msg() {
		// return total number of messages store in the db
		$query = $this->db->get('chat');
		return $query->num_rows();
	}

	function delete_msg($msg_id) {

		$this->db->where('id', $msg_id);
		$this->db->delete('chat'); 		
		//echo $this->db->last_query();
		echo "Affected rows: " . $this->db->affected_rows();
	}

	function modify_msg($msg_id, $msg_content){
		$data = array('msg' => $msg_content);
		$this->db->where('id', $msg_id);
		$this->db->update('chat', $data); 		

	}

	

}

/* End of file Chat_model.php */
/* Location: ./application/models/Chat_model.php */