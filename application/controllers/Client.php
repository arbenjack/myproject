<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("./vendor/dompdf/dompdf/autoload.inc.php");
use Dompdf\Dompdf;

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
				'BirthDate' => date_format(date_create($this->input->post('datebirth')),'Y-m-d'),
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
		$page_vars['LaonList'] = $this->Client_model->getClientLoanList($client_id);
		/*
		$allCLient = $this->Client_model->getListOfclients();
		$clients = array();
		$clients[] = '--Select--';
		if (!empty($allCLient)) {
			foreach ($allCLient as $value) {
				$clients[$value->ClientID] = $value->LastName.', '.$value->FirstName." ".$value->MiddleName;
			}
		}
		$page_vars['listClients'] = $clients;

		$this->form_validation->set_rules('client','Select Client','required');
			if($this->form_validation->run()){
				$page_vars['LaonList'] = $this->Client_model->getClientLoanList($this->input->post('client'));		
			}else{

			}
		//$page_vars['LaonList'] = $this->Client_model->getClientLoanList();
		*/
		$this->load->view('template/adminlte',array_merge([
			'page_view' => 'pages/client/client_loans',
			'page_tittle' => 'Client Loan List',
			'page_webTittle' => 'Client Loan List',
		],$page_vars));
	}

function update($id){
	//print_r($this->input->post());die();
$page_vars=array();
	$clientInfo = $this->Client_model->getClientInfo($id);
	//print_r($clientInfo);die();
	$page_vars['infoClient'] = $clientInfo;
	$this->form_validation->set_rules('fname','First Name','required')
			->set_rules('lname','Last Name','required')
			->set_rules('mname','Middle Name','required')
			->set_rules('datebirth','Birthdate','required')
			->set_rules('gender','Gender','required')
			->set_rules('phonenumber','Phone Number','required|numeric')
			->set_rules('address','Address','required');
			if($this->form_validation->run()){
	
				$update =	$this->Common_model->update('client',[
						'FirstName' => $this->input->post('fname'),
						'LastName' => $this->input->post('lname'),
						'MiddleName' => $this->input->post('mname'),
						'BirthDate' => date_format(date_create($this->input->post('datebirth')),'Y-m-d'),
						'Gender' => $this->input->post('gender'),
						'HomeAddressContact' => $this->input->post('phonenumber'),
						'HomeAddress1' => $this->input->post('address'),
				
				],[
					'ClientID' => $id
				]);
				if ($update) {
				message('success', 'Succesfully update ');
				redirect('client/update/'.$id);
			}else{
				message('danger', 'failed to update.');
				redirect('client/update/'.$id);
				}

			}else{

			}
 

		$this->load->view('template/adminlte',array_merge([
			'page_view' => 'pages/client/client_update',
			'page_tittle' => 'update of Client',
			'page_webTittle' => 'update of Client',
		],$page_vars));
	}

	function clientLoanTransaction($loan_id = 0){
		$page_vars = array();
		if($loan_id > 0){
			$page_vars['transList'] = $this->Client_model->getClientLoanTransactions($loan_id);
			$page_vars['loanAccountInfo'] = $this->Client_model->getClientLoanAccount($loan_id);
			
			$loanInfo = $this->Client_model->getClientLoanAccountIfRelease($loan_id);

			if(!empty($loanInfo)){
			$object = new stdClass();
			$object->amount_dr = $loanInfo->loanAmount;
			$object->amount_cr = 0;
			$object->dateTransaction = $loanInfo->dateRelease;
			$object->isRelease = 1;
			$object->isPenalty = 0;
			$object->isInterest = 0;
			$page_vars['transList'][] = $object;
			
			/*
			$object = new stdClass();
			$object->amount_dr = (($loanInfo->loanAmount * $loanInfo->intRate) /100);
			$object->amount_cr = 0;
			$object->dateTransaction = $loanInfo->dateRelease;
			$object->isRelease = 0;
			$object->isPenalty = 0;
			$object->isInterest = 1;
			$page_vars['transList'][] = $object;
			*/
		}
			/*
			$page_vars['transList'][] = new Object([
				'amount_dr' => $loanInfo->loanAmount,
				'amount_cr' => 0,
				'dateTransaction' => $loanInfo->dateRelease,
				'isRelease' => 1,
				'isPenalty' => 0
			]);	
			*/
			//print_r($page_vars['transList']);die;
			$this->load->view('template/adminlte',array_merge([
				'page_view' => 'pages/client/client_loan_trans',
				'page_tittle' => 'Client Loan Transaction',
				'page_webTittle' => 'Client Loan Transaction',
			],$page_vars));
		}
	}

	function clientCBUsavings($client_id = 0){
		$page_vars = array();
		if($client_id > 0){
			$savingsList = $this->Client_model->getClientSavings($client_id);
			$page_vars['savingsList'] = $savingsList;
			$page_vars['TotalBalance'] = $this->Client_model->getSumofSavings($client_id);
			//print_r($page_vars);die;
			$this->form_validation->set_rules('withdraw','Amount of Withdrawal','required|numeric');
			if($this->form_validation->run()){
				
				if($this->input->post('withdraw') > 0){
				  if($this->input->post('withdraw') <= $page_vars['TotalBalance']){
					$insert = $this->Common_model->insert('client_savings',[
						'client_id' => $client_id,
						'amount_dr' => $this->input->post('withdraw')
					]);
					if($insert){
					message('success', 'Succesfully withdraw.');
					redirect('client/clientCBUsavings/'.$client_id);	
					}
				 }else{
					message('danger', 'failed to withdraw, the amount of withdrawable balance is not enough.');
					redirect('client/clientCBUsavings/'.$client_id);
				 }
				}else{
					//client/clientCBUsavings/
				message('danger', 'failed to withdraw, zero value of withdrawal.');
				redirect('client/clientCBUsavings/'.$client_id);
				}
			}
			$this->load->view('template/adminlte',array_merge([
				'page_view' => 'pages/client/client_savingsCBU',
				'page_tittle' => 'Client CBU Savings',
				'page_webTittle' => 'Client CBU Savings',
			],$page_vars));
		}
	
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
	function textView(){
		$var = array();
		$var['clientDetails'] = "list of clients";
		$var['data'] = 'jfdafdsf';
		$this->load->view('pages/client/testview',$var);
	}

	function loadDomPDF(){
		 $this->generate($this->load->view('pages/forprint/loan_release'),'testPDF',TRUE,'letter','portrait');
	}
	function generate($html, $filename='', $stream=TRUE, $paper = 'A4', $orientation = "portrait")
	{
	  $dompdf = new DOMPDF();
	  $dompdf->load_html($html);
	  $dompdf->set_paper($paper, $orientation);
	  $dompdf->render();
	  if ($stream) {
		  $dompdf->stream($filename.".pdf", array("Attachment" => 0));
	  } else {
		  return $dompdf->output();
	  }
	}
}