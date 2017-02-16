<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();		
		$this->load->model('chat_model');
		$this->load->model('user_model');

		//If no session, redirect to login page
		$session_data = $this->session->userdata('logged_in');
		if(!$session_data || $session_data['username'] != 'admin')
			redirect('login', 'refresh');
	}

	public function index()
	{
		echo "admin page";
		redirect('admin/msg_mgmt');
	}

	public function dashboard()
	{
		echo "this is dashboard";
		$this->load->view('admin_dashboard_view');
	}

	public function msg_mgmt()
	{		
		$this->load->view('admin_test_view');
	}

	public function delete($msg_id) {
		echo $msg_id;
		if ($msg_id != NULL)		
			$this->chat_model->delete_msg($msg_id);
	}

	// Delete specific msg data with msg_id
	public function delete_msg() {	
		$msg_id = $this->input->post('msg_id', true);
		echo $msg_id;
		echo "post success!!";
		if($msg_id != NULL){
			$this->chat_model->delete_msg($msg_id);
		}			
		else
			echo "ERROR: msg_id is NULL";
	}

	public function modify_msg() {
		$msg_id = $this->input->post('msg_id', true);
		$msg_content = $this->input->post('msg_content', true);
		if($msg_id != NULL && $msg_content != NULL)
			$this->chat_model->modify_msg($msg_id, $msg_content);
		echo $msg_id;
		echo $msg_content;

	}




}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */