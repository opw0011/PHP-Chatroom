<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		
	}

	public function index()
	{
		
	}

	function change_avatar() {
		$num = $this->input->post('avatar_num', TRUE);
		$username = $this->input->post('username', TRUE);
		$this->user_model->change_user_avatar_num($username, $num);
	}

}

/* End of file Config.php */
/* Location: ./application/controllers/Config.php */