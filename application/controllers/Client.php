<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends MY_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata('my_auth')) {
			redirect('app/login');
		}

		$this->load->model('Client_model');
    }
    
    function index(){
       // echo ":asdasds";
    }
    function listClient(){
		$page_vars = array();
		$this->loadJS('custom/clients.js');

		$page_vars['listClients'] = $this->Client_model->getListOfclients();
		
		$this->load->view('template/adminlte',array_merge([
			'page_view' => 'pages/client/clientlist',
			'page_tittle' => 'List of Clients',
			'page_webTittle' => 'List of Clients',
		],$page_vars));
	}
	
	function create(){
		$page_vars = array();
		
		$this->form_validation->set_rules('fname','First Name','required')
			->set_rules('lname','Last Name','required')
			->set_rules('mname','Middle Name','required')
			->set_rules('datebirth','Birthdate','required')
			->set_rules('gender','Gender','required')
			->set_rules('phonenumber','Phone Number','required|numeric')
			->set_rules('address','Address','required');
		if ($this->form_validation->run()) {
			$insert_add = $this->Common_model->insert('client', [
				'FirstName' => $this->input->post('fname'),
				'LastName' => $this->input->post('lname'),
				'MiddleName' => $this->input->post('mname'),
				'BirthDate' => $this->input->post('datebirth'),
				'Gender' => $this->input->post('gender'),
				'HomeAddress1' => $this->input->post('address'),
				'HomeAddressContact' => $this->input->post('phonenumber')
			]);
			if ($insert_add) {
				message('success', 'Succesfully added Client.');
				redirect('client/create');
			}else{
				message('danger', 'failed to add Client.');
				redirect('client/create');
				}
		}else{
			
		}

		$this->load->view('template/adminlte',array_merge([
			'page_view' => 'pages/client/create',
			'page_tittle' => 'Create of Client',
			'page_webTittle' => 'Create of Client',
		],$page_vars));
	}

	
	function createCheclist($client_id = 0){
		//echo ''.$this->input->post('seminar') == null? 0 : 1;
		if($client_id > 0){
		$page_vars = array();
			
		$page_vars['clientDetails'] = $this->Client_model->getClientInfo($client_id);
		$checklist = $this->Client_model->getChecklist($client_id);
	
		if(empty($checklist)){
			$this->Common_model->insert('checklist',[
				'client_id' => $client_id,
				'colateral' => $this->input->post('collateral') == null? 0 : 1,
				'seminar' => $this->input->post('seminar') == null? 0 : 1,
				'ci' => $this->input->post('ci') == null? 0 : 1,
				'co_maker' => $this->input->post('comaker') == null? 0 : 1
			]);
		}else{
			if($this->input->post('isUpdate') == 'updating'){
				$update =	$this->Common_model->update('checklist',[
					'colateral' => $this->input->post('collateral') == null? 0 : 1,
					'seminar' => $this->input->post('seminar') == null? 0 : 1,
					'ci' => $this->input->post('ci') == null? 0 : 1,
					'co_maker' => $this->input->post('comaker') == null? 0 : 1
				],[
					'client_id' => $client_id
				]);
			
				if($update){
					message('success', 'Succesfully update checklist.');
					redirect('client/createCheclist/'.$client_id);
				}
			}		
		}
		$page_vars['checklist'] = $this->Client_model->getChecklist($client_id);
		$this->load->view('template/adminlte',array_merge([
			'page_view' => 'pages/client/checklist',
			'page_tittle' => 'Create Client Checklist',
			'page_webTittle' => 'Create Client Checklist',
		],$page_vars));
		}
	}

	function clientLoan($client_id = 0){
		$page_vars = array();

		$this->load->view('template/adminlte',array_merge([
			'page_view' => 'pages/client/client_loans',
			'page_tittle' => 'Client Loan List',
			'page_webTittle' => 'Client Loan List',
		],$page_vars));
	}


	function forTestJoin(){
		// tambok ka nga gwapo...
		$day = "tue";
		$dayQuery = "MWF";
		if($day == "thu" || $day == "tue"){
			$dayQuery = "TTH";
		}else{
			$dayQuery = "MWF";
		}
		$query = "";
		$result = $this->Client_model->joiningTest(7);
		print_r($result);die;
	}

}