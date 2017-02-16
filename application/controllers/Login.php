<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		
	}

	public function index()	{
		$this->load->helper(array('form'));
		$this->load->view('login_view');
		
	}

	public function verify_login()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric');	//|xss_clean|
		$this->form_validation->set_rules('password', 'Password', 'trim|required|alpha_numeric|callback_check_database');

		if($this->form_validation->run() == FALSE)
		{
	     //Field validation failed.  User redirected to login page
			$this->load->view('login_view');
		}
		else
		{
			// God to admin page
			$username = $this->input->post('username');
			if($username == 'admin')
				redirect('admin/');

	     //Go to private area
			redirect('chat');
		}
		
	}

	function check_database($password)
	{
   		//Field validation succeeded.  Validate against database
		$username = $this->input->post('username');

   		//query the database through the model
		$result = $this->user_model->login($username, $password);

		if($result)
		{
			$sess_array = array();
			foreach($result as $row)
			{
				$sess_array = array(
					'id' => $row->id,
					'username' => $row->user_name,
					'email' => $row->user_email
					);
				$this->session->set_userdata('logged_in', $sess_array);
			}
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_database', 'Invalid username or password');
			return false;
		}
	}

	function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('login', 'refresh');
	}


}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */