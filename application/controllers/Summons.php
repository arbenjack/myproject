<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Summons extends MY_Controller {

    function __construct(){
        parent::__construct();
        
        if (!$this->session->userdata('my_auth')) {
			redirect('app/login');
		}
		$this->load->model('Citezen_model')
				->model('Summon_model');
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
	 function getListSummons(){
	 	        $columns = array( 
                            0 =>'summon_id',
                            1 =>'summon_date',
                            2 =>'brgycasenum',
                            3 =>'details',
                        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        $totalData = $this->Summon_model->allposts_count();
        $totalFiltered = $totalData; 

         if(empty($this->input->post('search')['value']))
        {            
            $list = $this->Summon_model->allposts($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value']; 

            $list =  $this->Summon_model->posts_search($limit,$start,$search,$order,$dir);

            $totalFiltered = $this->Summon_model->posts_search_count($search);
        }
     
        $data = array();
        if(!empty($list))
        foreach ($list as $l) {
                $nestedData['id'] = $l->summon_id;
                $nestedData['comp_name'] = $l->c_fname.' '.$l->c_lname.', '.$l->c_mname;
                $nestedData['resp_name'] = $l->r_fname.' '.$l->r_lname.', '.$l->r_mname;
                $nestedData['brycasenumber'] = $l->brgycasenum;
                $nestedData['details'] = $l->details;
                $nestedData['datetime'] =  $l->summon_date;
                $nestedData['button'] = '<a type="button" id="generateBtn" class="btn btn-primary generateBtn">GENERATE</a> <button type="button" class="btn btn-warning">EDIT</button>';
               // $nestedData['button'] = '<a type="button" target="_blank" href="'.base_url().'summons/summontFormat" class="btn btn-primary">GENERATE</a> <button type="button" class="btn btn-warning">EDIT</button>';
                $data[] = $nestedData;

        }

            $json_data = array(
                    "draw"            => intval($this->input->post('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
            
        echo json_encode($json_data); 
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

		return $this->load->view('pages/summons/summonFormat',$page_vars);
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