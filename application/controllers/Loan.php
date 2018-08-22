<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loan extends MY_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata('my_auth')) {
			redirect('app/login');
		}

		$this->load->model('Client_model')
			->model('Loan_model')
			->model('LoanProduct_model')
			->model('Checklist_model');
    }

    function loanApplication(){
        $page_vars = array();
		//$this->loadJS('custom/clients.js');
		//$page_vars['listClients'] = $this->Client_model->getListOfclients();
        $page_vars['pendingList'] = $this->Loan_model->getLoanAppList();
		//print_r($page_vars['pendingList']);die;
		$allCLient = $this->Client_model->getListOfclients();
		$clients = array();
		if (!empty($allCLient)) {
			foreach ($allCLient as $value) {
				$clients[$value->ClientID] = $value->LastName.', '.$value->FirstName." ".$value->MiddleName;
			}
		}
		$page_vars['listClients'] = $clients;
		
		$allLoanProduct = $this->LoanProduct_model->getLonProduct();
		$product = array();
		if(!empty($allLoanProduct)){
			foreach($allLoanProduct as $prod){
				$product[$prod->loan_productID] = $prod->loanProduct_name;
			}
		}
		$page_vars['listProduct'] = $product;

		$this->form_validation->set_rules('amount','Amount','required|numeric')
				->set_rules('client','Client','required')
				->set_rules('loanproduct','LOan Product','required');
		if($this->form_validation->run()){

			/** this query is for getting loan if existed on client */
			$isHave = $this->Loan_model->getIfAlreadyApplied(
				$this->input->post('loanproduct'),
				$this->input->post('client'),
				'applied',
				0,
				0
			);
			/** this is for getting checklist of client */
			//print_r($isHave);die;
			$isChecklist = $this->Checklist_model->getIfClientCheckAllList($this->input->post('client'));
			
			if(empty($isChecklist)){
				message('danger', 'client did not met checklist.');
				redirect('loan/loanApplication');
			}
		   if(empty($isHave)){
				$term = $this->input->post('paymentTerm');
				$intPrcnt = 0;
				$termNumber = 0; 
				if($term == '1'){ $intPrcnt = 3.75;$termNumber = 3; }
				else if($term == '2') { $intPrcnt = 7.5;$termNumber = 6;  }
				else if($term == '3') { $intPrcnt =  11.25;$termNumber = 9;  }
				else{ $intPrcnt = 15;$termNumber = 12;  } 

				$insert = $this->Common_model->insert('loan_account',[
				'loanTypeID' => $this->input->post('loanproduct'),
				'client_id' => $this->input->post('client'),
				'loanAmount' => $this->input->post('amount'),
				'intRate' => $intPrcnt,
				'termNumber' => $termNumber,
				'loanStatus' => 'applied'
				]);
				if($insert){
					message('success', 'Succesfully apply loan.');
					redirect('loan/loanApplication');
				}else{
					message('danger', 'failed to apply loan.');
					redirect('loan/loanApplication');
				}
		   }else{
			message('danger', 'already applied application for loan.');
			redirect('loan/loanApplication');
		   }
		
		}else{

		}
		$this->load->view('template/adminlte',array_merge([
			'page_view' => 'pages/loan/loan_application',
			'page_tittle' => 'List of Applications',
			'page_webTittle' => 'List of Applications',
		],$page_vars));
    }
    

	function loanRelease(){
		$page_vars = array();

		$this->load->view('template/adminlte',array_merge([
			'page_view' => 'pages/loan/loan_release',
			'page_tittle' => 'Loan Release',
			'page_webTittle' => 'Loan Release',
		],$page_vars));
	}

}