<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Summons extends MY_Controller {

    function __construct(){
        parent::__construct();
        
        if (!$this->session->userdata('my_auth')) {
			redirect('app/login');
		}

	}

	function list(){

	}

	function create(){
		
	}
}