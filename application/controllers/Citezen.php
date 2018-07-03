<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Citezen extends MY_Controller {

    function __construct(){
        parent::__construct();
        
        if (!$this->session->userdata('my_auth')) {
			redirect('app/login');
		}
    }

    function list(){
        $page_vars = array();
       // $page_vars['sideBarVarClass'] = $this->router->fetch_class();
       // $page_vars['sideBarVarMethod'] = $this->router->fetch_method();
		$this->load->view('template/adminlte', [
			'page_view' => 'pages/citezen/list',
			'page_tittle' => 'LIST OF CITEZENS',
            'page_webTittle' => 'LIST OF CITEZENS',
            'variables' => $page_vars,
		]);
    }

    function create(){
        $page_vars = array();

        
		$this->load->view('template/adminlte', [
			'page_view' => 'pages/citezen/create',
			'page_tittle' => 'CREATING OF CITEZENS',
            'page_webTittle' => 'CREATING OF CITEZENS',
            'variables' => $page_vars
		]);
    }
}