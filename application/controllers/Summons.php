<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Summons extends MY_Controller {

    function __construct(){
        parent::__construct();
        
        if (!$this->session->userdata('my_auth')) {
			redirect('app/login');
		}
		$this->load->model('Citezen_model');
	}

	function list(){
		  $page_vars = array();
		  $this->loadJS('custom/summon.js');

        $this->load->view('template/adminlte',array_merge([
           'page_view' => 'pages/summons/list',
            'page_tittle' => 'LIST OF SUMMONS',
            'page_webTittle' => 'LIST OF SUMMONS',
             ], $page_vars ));

	}

	function create(){
	    $page_vars = array();

	    $allCitezens = $this->Citezen_model->getAllcitizensDropDown();
	    $allCitezens1 = array();
	    if(!empty($allCitezens)){
	    	foreach ($allCitezens as $value) {
	    		$allCitezens1[$value->citizen_id] = $value->first_name.' '.$value->last_name;
	    	}
	    }
	       $page_vars['allCitezens'] = $allCitezens1;

	     $this->form_validation
	          ->set_rules('complainant', 'Complainant', 'required|differs[repondent]')
              ->set_rules('repondent', 'Respondent', 'required|differs[complainant]')
              ->set_rules('caseNumber', 'Barangay Case Number#', 'required')
              ->set_rules('details','Details','required')
              ->set_rules('summonday', 'Summon Date', 'required')
              ->set_rules('summontime', 'Summon Time', 'required');
             if ($this->form_validation->run()) {
             	$insert = $this->Common_model->insert('summons',[
             			'complainance_id' => $this->input->post('complainant'),
             			'respondent_id' => $this->input->post('repondent'),
             			'brgycasenum' => $this->input->post('caseNumber'),
             			'details' => $this->input->post('details'),
             			'summon_date' => $this->input->post('summonday').' '.$this->input->post('summontime'),
             		]);
             	 if($insert){
             	 message('success','Succesfully created summon form.');
                  redirect('summons/create');
           		 }else{
            	 message('danger','failed created summon form.');
                redirect('summons/create');
            	}
             }else{

             }
	 
        $this->load->view('template/adminlte',array_merge([
           'page_view' => 'pages/summons/create',
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