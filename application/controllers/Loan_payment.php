<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loan_payment extends MY_Controller {

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

    function viewloanPayment(){
        $page_vars = array();
        	/** for sms flash sending */
		$FosmsFlash = $this->session->flashdata('smsDataFlash');
		if(!empty($FosmsFlash)){
			$this->loadJS('custom/sensSMS.js',['data' => json_encode(array('toSendData' => $FosmsFlash))]);
        }else{}
            
        $this->loadJS('custom/loan_payment.js');

        $allCLient = $this->Client_model->getListOfclients();
        $clients = array();
        $clients[] = "--SELECT--";
		if (!empty($allCLient)) {
			foreach ($allCLient as $value) {
				$clients[$value->ClientID] = $value->LastName.', '.$value->FirstName." ".$value->MiddleName;
			}
		}
		$page_vars['listClients'] = $clients;

        $allLoanProduct = $this->LoanProduct_model->getLonProduct();
        $product = array();
        $product[] = "--SELECT--";
		if(!empty($allLoanProduct)){
			foreach($allLoanProduct as $prod){
				$product[$prod->loan_productID] = $prod->loanProduct_name;
			}
		}
		$page_vars['listProduct'] = $product;
       
        $this->form_validation->set_rules('paymentTerm','Payment Term','required');
		$page_vars['paymentList'] = array();
		if($this->form_validation->run()){
			    $term = $this->input->post('paymentTerm');
				$termNumber = 0; 
				if($term == '1'){ $termNumber = 3; }
				else if($term == '2') {$termNumber = 6;  }
				else if($term == '3') { $termNumber = 9;  }
				else{ $termNumber = 12;  } 
			
		$paymentList = $this->Loan_model->getLoanForPayment($this->input->post('client'),$this->input->post('loanproduct'),$termNumber);
        if(!empty($paymentList)){
            foreach($paymentList as $pl){
              $payments = $this->Loan_model->getSumOfpaymentByFilter($pl->ClientID, $pl->loanTypeID, $pl->loan_accountID);
              // $pl->paymentDue = ($pl->loanAmount - $payments);
              $pl->paymentDue = $payments;
            }
        }
        $page_vars['paymentList'] = $paymentList;
        }
       
        $this->load->view('template/adminlte',array_merge([
			'page_view' => 'pages/loan/loan_payment',
			'page_tittle' => 'Create Payment',
			'page_webTittle' => 'Create Payment',
		],$page_vars));
    }

    function submitPayments(){
       //print_r($this->input->post());
       if(!empty($this->input->post('loanAmount'))){
           $loanAmount = $this->input->post('loanAmount');
            foreach($loanAmount as $key => $lamt){
                if($this->input->post('collection')[$key] != null){
                   // echo $this->input->post('collection')[$key].' ';
                  $inserted = $this->Common_model->insert('loan_payment',[
                    'client_id' => $this->input->post('clientId')[$key],
                    'loanAcct_id' => $key,
                    'loanTypeID' => $this->input->post('loanAcctType')[$key],
                    'amount_dr' => 0,
                    'amount_cr' => $this->input->post('collection')[$key]
                   ]);
                }

                $clientInfo = $this->Client_model->getClientInfo($this->input->post('clientId')[$key]);
                $loanProd = $this->LoanProduct_model->getLoanProduct($this->input->post('loanAcctType')[$key]);
                $paymentsBalance = $this->Loan_model->getSumOfpaymentByFilter($this->input->post('clientId')[$key],$this->input->post('loanAcctType')[$key], $key);
				$arrayToSend[] = [
					'mobileNumber' => $clientInfo->HomeAddressContact,
					'textSms' => $clientInfo->LastName.', '.$clientInfo->FirstName.'. You are successfully pay on '.$loanProd->loanProduct_name.' loan with the amount of Php'.number_format(round($this->input->post('collection')[$key],4),2).', you only have Php'.number_format(round($paymentsBalance,4),2).' Balance left to pay, Thank you.'
				];
            }

            $this->session->set_flashdata('smsDataFlash', $arrayToSend);

            if(!empty($inserted)){
                message('success', 'Succesfully created payments.');
                redirect('Loan_payment/viewloanPayment');
            }else{
                message('danger', 'Failed created payments.');
                redirect('Loan_payment/viewloanPayment');
            }
       }else{
          message('danger', 'Failed created payments.');
          redirect('Loan_payment/viewloanPayment');
       }
    }
}

