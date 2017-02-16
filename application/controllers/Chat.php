<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

	function __construct() {
		parent::__construct();
		//echo "<p>constructor is called</p>";
		$this->load->model('chat_model');
		$this->load->model('user_model');
	}

	function index() {
		//echo "<p>index</p>";
		//If no session, redirect to login page
		if(! $this->session->userdata('logged_in'))
			redirect('login', 'refresh');


	    // store username and email into session
		$session_data = $this->session->userdata('logged_in');
		$data['username'] = $session_data['username'];
		$data['email'] = $session_data['email'];

		$data['avatar_num'] = $this->user_model->get_user_avatar_num($session_data['username']);

		// pass the number of messages in the database
		$data['num_all_msg'] = $this->chat_model->get_num_all_msg();


		// generate smileys
		$this->load->helper('smiley');
	    $this->load->library('table');

	    $image_array = get_clickable_smileys(site_url('assets/images/smileys'), 'input_msg');

	    $col_array = $this->table->make_columns($image_array, 8);
	    $data['smiley_table'] = $this->table->generate($col_array);



		$this->load->view('chat_view', $data);
		//echo "Hello".$data['username'].$data['email'] ;

	}

	function post_msg() {	
		// $name = $this->input->post('name', TRUE);
		// $email = $this->input->post('email', TRUE);
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$name= $session_data['username'];
			$email= $session_data['email'];
			$msg = $this->input->post('msg', TRUE);
			$msg = $this->security->xss_clean($msg); // prevent XSS

			$this->chat_model->add_new_msg($name, $email, $msg);          
			//redirect('chat');
		}
		else
		{
     	//If no session, redirect to login page
			redirect('login', 'refresh');
		}

	}


	function show_msg($offset = null, $num = 10) {
		// note: offset, the first record is offset 0
		$chat_msg = $this->chat_model->get_msg($offset, $num);
		$data['all_msg'] = $chat_msg->result();

		//$last_chat_msg_id = (int) $this->session->userdata('last_chat_msg_id');

		//store the last chat msg id
		//row start from 0
		// if ($chat_msg->num_rows() > 0) {
		// 	$last_chat_msg_id = $chat_msg->row($chat_msg->num_rows() - 1)->id;
		// 	$this->session->set_userdata('last_chat_msg_id', $last_chat_msg_id);
		// }

		
		$this->load->view('msg_view', $data);
	}

	function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('login', 'refresh');
	}

	function test() {
		$result = $this->chat_model->get_all_msg();
		$this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($result));
	}

	function smileys(){
		// generate smileys
		$this->load->helper('smiley');
	    $this->load->library('table');

	    $image_array = get_clickable_smileys(site_url('assets/images/smileys'), 'input_msg');

	    $col_array = $this->table->make_columns($image_array, 10);
	    $data['smiley_table'] = $this->table->generate($col_array);

		$this->load->view('smileys_view', $data);
	}

	function avatars($username) {
		$this->load->model('user_model');
		return $this->user_model->get_user_avatar_num($username) ;
	}

}

/* End of file Chat.php */
/* Location: ./application/controllers/Chat.php */