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
		$FosmsFlash = $this->session->flashdata('smsDataFlash');
		if(!empty($FosmsFlash)){
			$this->loadJS('custom/sensSMS.js',['data' => json_encode(array('toSendData' => $FosmsFlash))]);
		}else{}

		$page_vars['pendingList'] = $this->Loan_model->getLoanAppList();
		
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
			//print_r($isHave);die;
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

				$clientInfo = $this->Client_model->getClientInfo($this->input->post('client'));
				$loanProd = $this->LoanProduct_model->getLoanProduct($this->input->post('loanproduct'));
				$arrayToSend[] = [
					'mobileNumber' => $clientInfo->HomeAddressContact,
					'textSms' => $clientInfo->LastName.', '.$clientInfo->FirstName.'. You are successfully applied '.$loanProd->loanProduct_name.' loan application with the duration of '.$termNumber.'months and the amount of Php'.number_format(round($this->input->post('amount'),4),2).', Thank you.'
				];
				
				$this->session->set_flashdata('smsDataFlash', $arrayToSend);

				message('success', 'Succesfully apply loan.');
				redirect('loan/loanApplication');
				/*
				if($insert){
					message('success', 'Succesfully apply loan.');
					redirect('loan/loanApplication');
				}else{
					message('danger', 'failed to apply loan.');
					redirect('loan/loanApplication');
				}
				*/
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
    
	function cancelApplicationLoan($loan_id = 0){
		if($loan_id > 0){
			$update = $this->Common_model->update('loan_account',[
				'loanStatus' => 'canceled'
			],[
				'loan_accountID' => $loan_id
			]);
			if($update){
				message('success', 'Succesfully Canceled loan application.');
				redirect('loan/loanApplication');
			}else{
			message('danger', 'Error to cancel loan application.');
			redirect('loan/loanApplication');
		   }
		}
	}

	function loanRelease(){
		/** for sms flash sending */
		$FosmsFlash = $this->session->flashdata('smsDataFlash');
		if(!empty($FosmsFlash)){
			$this->loadJS('custom/sensSMS.js',['data' => json_encode(array('toSendData' => $FosmsFlash))]);
		}else{}

		$page_vars = array();
		$allLoanProduct = $this->LoanProduct_model->getLonProduct();
		$product = array();
		$product[0] = '--Select--';
		if(!empty($allLoanProduct)){
			foreach($allLoanProduct as $prod){
				$product[$prod->loan_productID] = $prod->loanProduct_name;
			}
		}
		$page_vars['listProduct'] = $product;

		$allCLient = $this->Client_model->getListOfclients();
		$clients = array();
		$clients[0] = '--Select--';
		if (!empty($allCLient)) {
			foreach ($allCLient as $value) {
				$clients[$value->ClientID] = $value->LastName.', '.$value->FirstName." ".$value->MiddleName;
			}
		}
		$page_vars['listClients'] = $clients;

		$this->form_validation->set_rules('paymentTerm','Payment Term','required');
		$page_vars['releaseList'] = array();
		if($this->form_validation->run()){
			    $term = $this->input->post('paymentTerm');
				$termNumber = 0; 
				if($term == '1'){ $termNumber = 3; }
				else if($term == '2') {$termNumber = 6;  }
				else if($term == '3') { $termNumber = 9;  }
				else{ $termNumber = 12;  } 
			
		$release =$this->Loan_model->getLoanForRelease($this->input->post('client'),$this->input->post('loanproduct'),$termNumber);
		$page_vars['releaseList'] = $release;
		}
		$this->load->view('template/adminlte',array_merge([
			'page_view' => 'pages/loan/loan_release',
			'page_tittle' => 'Loan Release',
			'page_webTittle' => 'Loan Release',
		],$page_vars));
	}

	function createLoanRelease(){
	// print_r($this->input->post('releases'));die;
		if(!empty($this->input->post('releases'))){
			$releasePost = $this->input->post('releases');
			
			$ListLoanAcct = $this->Loan_model->getAllLoanReleases($releasePost);

			$arrayToSend = [];
			foreach($ListLoanAcct as $list){
				//$list->termNumber;
				
				$date = new DateTime();
				$date->add(new DateInterval('P'.$list->termNumber.'M'));				
				$update = $this->Common_model->update('loan_account',[
					'loanStatus' => 'release',
					'isRelease' => 1,
					'dateRelease' => date('Y-m-d H:i:s'),
					'date_cutoff' => $date->format('Y-m-d H:i:s'),
				],[
					'loan_accountID' => $list->loan_accountID
				]);

				$clientInfo = $this->Client_model->getClientInfo($list->client_id);
				$loanProd = $this->LoanProduct_model->getLoanProduct($list->loanTypeID);
				$arrayToSend[] = [
					'mobileNumber' => $clientInfo->HomeAddressContact,
					'textSms' => $clientInfo->LastName.', '.$clientInfo->FirstName.'. You are successfully released '.$loanProd->loanProduct_name.' loan with the duration of '.$list->termNumber.'months and the amount of Php'.number_format(round($list->loanAmount,4),2).', Your cuttoff date is on '.$date->format('Y/m/d').' please pay before the deadline date to avoid increase of interest, Thank you.'
				];
			}

			$this->session->set_flashdata('smsDataFlash', $arrayToSend);

			if(!empty($update)){
				message('success', 'Succesfully create releases.');
				redirect('loan/loanRelease');
			}
		}else{
			message('danger', 'failed to create releases.');
			redirect('loan/loanRelease');
		}
	}

}


				/** for sms */
				/*
				$this->load->library('Smslib');
				$clientInfo = $this->Client_model->getClientInfo($this->input->post('client'));
				$loanProd = $this->LoanProduct_model->getLoanProduct($this->input->post('loanproduct'));
				$arrayToSend[0] = [
					'mobileNumber' => $clientInfo->HomeAddressContact,
					'textSms' => $clientInfo->LastName.', '.$clientInfo->FirstName.'. You are successfully applied '.$loanProd->loanProduct_name.' loan application with the duration of '.$termNumber.'months and the amount of Php'.round($this->input->post('amount'),4).', Thank you.'
				];
				$this->smslib->testSend($arrayToSend);
				*/