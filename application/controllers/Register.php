<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}


	public function index()
	{
		$this->load->helper(array('form'));

		$data = $this->create_captcha();

		$this->load->view('register_view', $data);
	}

	function verify_register() {
		// echo "verify register";
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|is_unique[users.user_name]');	//|xss_clean|
		$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[users.user_email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]'); //callback_check_database
		$this->form_validation->set_rules('password-confirm', 'Password Confirm', 'trim|required|matches[password]');
		$this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|alpha_numeric|callback_check_captcha');

		if($this->form_validation->run() == FALSE)
		{
	     //Field validation failed.  User redirected to register page			
			$data = $this->create_captcha();
			$this->load->view('register_view', $data);
		}
		else
		{
	     //validation success, add the new user 
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$this->user_model->add_user($username, $email, $password);	// call the model to add a new user

			$this->session->set_flashdata('msg_popup', 'Your account has been created! Please try to login.');	
			// set flash data to display a pop up alert in login page			

			redirect('login');
		}

	}


	private function create_captcha() {
		$this->load->helper('captcha');
		$vals = array(	        
			'img_path'      => './assets/images/captcha/',
			'img_url'       => site_url('assets/images/captcha/'),
			'font_path'     => './assets/fonts/captcha.ttf',
			'img_width'     => '100',
			'img_height'    => 35,
			'expiration'    => 720,
			'word_length'   => 4,
			'font_size'     => 18,
			'img_id'        => 'Imageid',
			'pool'          => '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',

	        // White background and border, black text and red grid
			'colors'        => array(
				'background' => array(255, 255, 255),
				'border' => array(200, 200, 200),
				'text' => array(0, 0, 0),
				'grid' => array(200, 40, 40)
				)
			);


		$cap = create_captcha($vals);
		// echo $cap['image'];
		// echo $cap['word'];	
		$this->session->set_userdata('captcha', $cap['word']);	// store the captcha into user session
		return array('cap' => $cap['image']);
	}

	function check_captcha($cap) {
		if($cap == $this->session->userdata('captcha')){
			return true;
		}
		else {
			$this->form_validation->set_message('check_captcha', 'Invalid captcha');
			return false;
		}
		
	}

	function reload_captcha() {
		$data = $this->create_captcha();
		echo $data['cap'];
	}





	// function test() {
	// 	$this->session->set_flashdata('msg_popup', 'Your account has been created! Please try to login.');
	// 	redirect('login','refresh');
	// }

}

/* End of file Register.php */
/* Location: ./application/controllers/Register.php */