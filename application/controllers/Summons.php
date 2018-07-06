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
		  $page_vars = array();

        $this->load->view('template/adminlte',array_merge([
           'page_view' => 'pages/summons/list',
            'page_tittle' => 'LIST OF SUMMONS',
            'page_webTittle' => 'LIST OF SUMMONS',
             ], $page_vars ));

	}

	function create(){
	    $page_vars = array();

        $this->load->view('template/adminlte',array_merge([
           'page_view' => 'pages/summons/list',
            'page_tittle' => 'CREATE A SUMMON',
            'page_webTittle' => 'CREATE A SUMMON',
             ], $page_vars ));
	}

	function summontFormat(){
		$page_vars = array();

		$this->load->view('pages/summons/summonFormat',$page_vars);
	}

 function generate(){
  	$page_vars = array();
		$this->load->library('Pdfgenerator');
		$this->pdfgenerator->generate(
			$this->load->view('pages/summons/summonFormat',$page_vars, true),
			'qwcew',
			TRUE,
			'A4',
			'portrait'	);
  }

}