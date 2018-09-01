<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends MY_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata('my_auth')) {
			//redirect('app/login');
		}

		$this->load->model('Login');

	}

	public function index() {

	}

	public function login() {
		$page_vars = array();

		if ($this->session->userdata('my_auth')) {
			redirect('Dasboard');
		}

		$this->form_validation->set_rules('username', 'Username', 'required|trim')
			->set_rules('pwd', 'Password', 'required|trim');

		if ($this->form_validation->run()) {
			$username = $this->input->post('username');
			$pwd = $this->input->post('pwd');

			$check = $this->Login->authenticate($username, $pwd);

			if ($check) {
				redirect('Dasboard');
			} else {
				message('danger', 'Invalid username/password!');
			}

		}

		// Insert dummy account
		/*$this->db->insert('account_users',[
			'user_name' => 'admin',
			'user_pwd' => md5('A123456789')
		]);*/

		/* View */
		$page_vars['page_title'] = 'Login';
		$this->load->view('common/header', $page_vars);
		$this->load->view('pages/login');
		//$this->load->view('common/footer');
	}

	function logout() {
		$this->session->sess_destroy();
		redirect('app/login');
	}
}
