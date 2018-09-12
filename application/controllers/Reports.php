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
        }else{

        }

        $this->load->view('template/adminlte',array_merge([
			'page_view' => 'pages/reports/pastdue',
			'page_tittle' => 'List of Past Dues',
			'page_webTittle' => 'List of Past Dues',
		],$page_vars));
    }


    function setPenalty($loadid = 0){
        $page_vars = array();
        
        $this->load->view('template/adminlte',array_merge([
			'page_view' => 'pages/reports/penaltydue',
			'page_tittle' => 'Setting a Penalty',
			'page_webTittle' => 'Setting a Penalty',
		],$page_vars));
    }

    function sendSMS(){
       // print_r($this->input->post());
       $loanAccount = $this->input->post('loanAccount');
       $loan = $this->Report_model->getLoanAccount($loanAccount);
       $paymentsBalance = $this->Loan_model->getSumOfpaymentByFilter($loan->client_id,$loan->loanTypeID, $loanAccount);
       //print_r($loan);
       $arrayToSend[] = [
        'mobileNumber' => $loan->HomeAddressContact,
        'name' => $loan->LastName.', '.$loan->FirstName,
        'textSms' => $loan->LastName.', '.$loan->FirstName.'. You are are warn to pay '.$loan->loanProduct_name.' loan account with the balance amount of Php'.number_format(round($paymentsBalance,4),2).' before due date to avoid penalty.'
    ];
    //print_r($arrayToSend);
    //echo json_encode(array('data' => array('toSendData' => $arrayToSend),'response' => 1));  
    echo json_encode(array('data' => array('toSendData' => $arrayToSend),'response' => 1));
    }

    function getWeekStartEnd(){
        $monday = strtotime("last monday");

        $monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
        
        $sunday = strtotime(date("Y-m-d",$monday)." +6 days");
        
        $this_week_sd = date("Y-m-d",$monday);
        
        $this_week_ed = date("Y-m-d",$sunday);
        
       // echo "Current week range from $this_week_sd to $this_week_ed ";
     return  array('start' => $this_week_sd, 'end' => $this_week_ed);
    }

    function getMonthStartEnd(){
        $now_date = date('Y-m-d');  

        // echo date("Y-m-d", strtotime("saturday -1 week"));die;
         $start = date("Y-m-01", strtotime($now_date));
         $end = date("Y-m-".date("t", strtotime($now_date))."", strtotime($now_date));

        return  array('start' => $start, 'end' => $end);
    }

}