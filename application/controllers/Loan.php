<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loan extends MY_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata('my_auth')) {
			redirect('app/login');
		}

        $this->load->model('Client_model');
    }

    function loanApplication(){
        $page_vars = array();
		//$this->loadJS('custom/clients.js');

		$page_vars['listClients'] = $this->Client_model->getListOfclients();
        
       
		$this->load->view('template/adminlte',array_merge([
			'page_view' => 'pages/loan/loan_application',
			'page_tittle' => 'List of Applications',
			'page_webTittle' => 'List of Applications',
		],$page_vars));
    }
    

}