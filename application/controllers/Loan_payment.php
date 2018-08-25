<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loan_payment extends MY_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata('my_auth')) {
			redirect('app/login');
		}

		$this->load->model('Client_model');
    }
    
    function viewloanPayment(){
        $page_vars = array();

        $this->load->view('template/adminlte',array_merge([
			'page_view' => 'pages/loan/loan_payment',
			'page_tittle' => 'Create Payment',
			'page_webTittle' => 'Create Payment',
		],$page_vars));
    }

}