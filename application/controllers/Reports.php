<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends MY_Controller {

	function __construct() {
		parent::__construct();

		if (!$this->session->userdata('my_auth')) {
			redirect('app/login');
        }
        
        $this->load->model('Report_model')
            ->model('Loan_model');
    }
    function pastdue(){
        $FosmsFlash = $this->session->flashdata('smsDataFlash');
		if(!empty($FosmsFlash)){
			$this->loadJS('custom/sensSMS.js',['data' => json_encode(array('toSendData' => $FosmsFlash))]);
        }else{}
        $this->loadJS('custom/reportpass.js');
        $page_vars = array();

        $this->form_validation->set_rules('dateType','Date Type','required')
        ->set_rules('dueType','Due Type','required');
        if($this->form_validation->run()){
            $dateType = $this->input->post('dateType');
            $dueType = $this->input->post('dueType');

            $now_date = date('Y-m-d');  
            $start = '';
            $end = '';//print_r($this->getWeekStartEnd());die;
            if($this->input->post('dateType') == 'week'){
                $start = $this->getWeekStartEnd()['start'];
                $end = $this->getWeekStartEnd()['end'];
            }else if($this->input->post('dateType') == 'month'){
                $start = $this->getMonthStartEnd()['start'];
                $end = $this->getMonthStartEnd()['end'];
            }
 
            $listDues = array();
            if($dueType == 2){
                $listDues = $this->Report_model->getPastdues(date(
                    "Y-m-t", strtotime($now_date)).' 23:59:59',
                    '',
                    ''
                );
            }else if($dueType == 1){
                $listDues = $this->Report_model->getPastdues(
                    '',
                    $start.' 00:00:01',
                    $end.' 23:59:59'
                );
            }
            $page_vars['dueList'] = $listDues;
        }else{ }
        $this->load->view('template/adminlte',array_merge([
			'page_view' => 'pages/reports/pastdue',
			'page_tittle' => 'List of Past Dues',
			'page_webTittle' => 'List of Past Dues',
		],$page_vars));
    }

    function setPenalty($loadid = 0){
        $page_vars = array();
        
        $loan = $this->Report_model->getLoanAccount($loadid);
        $page_vars['loanInfo'] = $loan;
        $page_vars['totalPayment'] = $this->Report_model->getTotalPayment($loan->client_id,$loan->loanTypeID,$loan->loan_accountID);
        $page_vars['totalPaid'] = $this->Report_model->getTotalPaid($loan->client_id,$loan->loanTypeID,$loan->loan_accountID);

        $this->load->view('template/adminlte',array_merge([
			'page_view' => 'pages/reports/penaltydue',
			'page_tittle' => 'Setting a Penalty',
			'page_webTittle' => 'Setting a Penalty',
		],$page_vars));
    }
    function doPenalty($loadid = 0){
        if($loadid > 0){
            $loan = $this->Report_model->getLoanAccount($loadid);
            $balance = $this->Report_model->getTotalPayment($loan->client_id,$loan->loanTypeID,$loan->loan_accountID);
            $date = new DateTime($loan->date_cutoff);
            $date->add(new DateInterval('P1M'));	
            $this->Common_model->insert('loan_payment',[
                    'client_id' => $loan->client_id,
                    'loanAcct_id' => $loan->loan_accountID,
                    'loanTypeID' => $loan->loanTypeID,
                    'isPenalty' => 1,
                    'isInterest' => 1,
                    'amount_dr' => ($balance * 3.75) / 100
            ]);
          
            $update = $this->Common_model->update('loan_account',[
                'date_cutoff' => $date->format('Y-m-d H:i:s')
            ],[
                'loan_accountID' => $loan->loan_accountID
            ]);
            
            $arrayToSend[] = [
                'mobileNumber' => $loan->HomeAddressContact,
                'textSms' => $loan->LastName.', '.$loan->FirstName.'. You have been penalize on your '.$loan->loanProduct_name.' loan with the amount of Php'.round((($balance * 3.75) / 100),2).' cause of unpaid due...'
            ];
            $arrayToSend[] = [
                'mobileNumber' => $loan->HomeAddressContact,
                'textSms' => 'Your currently total payment is now Php'. round($balance + (($balance * 3.75) / 100),2).' that have interest rate of 3.75% and will be due on '.$date->format('Y-m-d').'.'
            ];
            $this->session->set_flashdata('smsDataFlash', $arrayToSend);

            if($update){
              message('success', 'Succesfully Applied penalty of '.strtoupper($loan->LastName.' '.$loan->FirstName));
              redirect('reports/pastdue');
            }
        }else{
           //message('danger', 'failed to add Client.');
            //redirect('reports/setPenalty/'.$loadid);
        }
    }

    function sendSMS(){
       // print_r($this->input->post());
       $loanAccount = $this->input->post('loanAccount');
       $loan = $this->Report_model->getLoanAccount($loanAccount);
       $paymentsBalance = $this->Loan_model->getSumOfpaymentByFilter($loan->client_id,$loan->loanTypeID, $loanAccount);
       $arrayToSend[] = [
        'mobileNumber' => $loan->HomeAddressContact,
        'name' => $loan->LastName.', '.$loan->FirstName,
        'textSms' => $loan->LastName.', '.$loan->FirstName.'. You are warn to pay '.$loan->loanProduct_name.' loan account with the balance amount of Php'.number_format(round($paymentsBalance,4),2).' before '. date_format(date_create($loan->date_cutoff),'m/d/Y').' due date to avoid penalty.'
    ];
    echo json_encode(array('data' => array('toSendData' => $arrayToSend),'response' => 1));
    }

    function paymentreports(){
        $page_vars = array();
        $page_vars['totalPayment'] = 0;
        $page_vars['totalIncome'] = 0;
        $this->form_validation->set_rules('startdate','Start Date','required')
                    ->set_rules('enddate','End Date','required');
        if($this->form_validation->run()){
            //print_r(date_format(date_create($this->input->post('startdate')),'Y-m-d'));die;
            $listPayments = $this->Report_model->getPayments(array(
                'start' => date_format(date_create($this->input->post('startdate')),'Y-m-d'),
                'end' => date_format(date_create($this->input->post('enddate')),'Y-m-d')
                ));
            
            if(!empty($listPayments)){
                $intPercentAmount = 0;
                foreach($listPayments as $lp){
                    $page_vars['totalPayment'] += $lp->amount_cr;

                    $intPercentAmount = (($lp->loanAmount * $lp->intRate) /100);
                    $percent =  ((($lp->loanAmount * $lp->intRate) /100) * $lp->intRate) /100;
                    if($lp->isPenalty == 0 || $lp->isInterest == 0 || $lp->isRelease == 0){
                        $page_vars['totalIncome'] += (($lp->amount_cr * $lp->intRate) /100) - $percent;
                    }
                    if($lp->isPenalty == 1){
                        $page_vars['totalIncome'] = $page_vars['totalIncome'] + $lp->amount_dr;
                    }
                
                }
            }

           $page_vars['paymentList'] = $listPayments;
        }else{}
           // print_r( $page_vars['$paymentList']);die;
        $this->load->view('template/adminlte',array_merge([
			'page_view' => 'pages/reports/payment',
			'page_tittle' => 'List of Payments',
			'page_webTittle' => 'List of Payments',
		],$page_vars));
    }


    function cbusavings(){
        $page_vars = array();
        $page_vars['totalSavings'] = 0;
        $page_vars['totalWithdraw'] = 0;
         $this->form_validation->set_rules('startdate','Start Date','required')
                ->set_rules('enddate','End Date','required');
        if($this->form_validation->run()){
        $listCbu = $this->Report_model->getCbuList(array(
            'start' => date_format(date_create($this->input->post('startdate')),'Y-m-d'),
            'end' => date_format(date_create($this->input->post('enddate')),'Y-m-d')
            ));

        if(!empty($listCbu)){
            foreach($listCbu as $list){
                $page_vars['totalSavings'] += $list->amount_cr;
                $page_vars['totalWithdraw'] += $list->amount_dr;
            }
        }
       // print_r($listCbu);die;
        $page_vars['listCbu'] = $listCbu;
        }
        $this->load->view('template/adminlte',array_merge([
			'page_view' => 'pages/reports/cbuSavings',
			'page_tittle' => 'List of CBU Savings',
			'page_webTittle' => 'List of CBU Savings',
		],$page_vars));
    }

    function getWeekStartEnd(){
        $monday = strtotime("last monday");
        $monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
        $sunday = strtotime(date("Y-m-d",$monday)." +6 days");
        $this_week_sd = date("Y-m-d",$monday);
        $this_week_ed = date("Y-m-d",$sunday);
     return  array('start' => $this_week_sd, 'end' => $this_week_ed);
    }
    function getMonthStartEnd(){
        $now_date = date('Y-m-d');  
         $start = date("Y-m-01", strtotime($now_date));
         $end = date("Y-m-".date("t", strtotime($now_date))."", strtotime($now_date));
        return  array('start' => $start, 'end' => $end);
    }

}