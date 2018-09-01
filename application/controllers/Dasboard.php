<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasboard extends MY_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata('my_auth')) {
			redirect('app/login');
		}

	}

	public function index() {
		$page_vars = array();
		
		$this->load->view('template/adminlte',array_merge([
			'page_view' => 'pages/dashboard',
			'page_tittle' => 'DASHBOARD',
			'page_webTittle' => 'DASBOARD',
		],$page_vars));
	}
}
