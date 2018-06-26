<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasboard extends MY_Controller {

	public function index() {

		$this->load->view('template/adminlte', []);
	}
}
