<?php defined('BASEPATH') or die('No direct script access allowed');

class Report_model extends CI_Model {

    function getPastdues($dateCutoff = '',$start = '',$end = ''){

            $this->db->select('*');
            $this->db->from('loan_account');
            $this->db->where(array(
                'loanStatus' => 'release',
                'isRelease' => 1
                  ));
                  
            if($dateCutoff != '')
            $this->db->where('date_cutoff','>',$dateCutoff);   
            
            if($start != '' && $end != ''){
                $this->db->where('date_cutoff >=',$start);
                $this->db->where('date_cutoff <=',$end);     
            }

            $this->db->join('client as cl','cl.ClientID = loan_account.client_id','LEFT');
            $this->db->join('loan_product as laonp','laonp.loan_productID = loan_account.loanTypeID','LEFT');
            $query = $this->db->get();
      // print_r($this->db->last_query());
        if($query->num_rows() > 0){
            return $query->result();
        }
        return array();
    }

    function getLoanAccount($loanAccountID = 0){
        $query = $this->db->select()
            ->where([
                'loan_accountID' => $loanAccountID
            ])
            ->join('client as cl','cl.ClientID = loan_account.client_id','LEFT')
            ->join('loan_product as laonp','laonp.loan_productID = loan_account.loanTypeID','LEFT')
            ->get('loan_account');
       // print_r($this->db->last_query());die;
        if($query->num_rows() > 0){
            return $query->row();
        }
       return array();
    }

   function getTotalPayment($client_id = 0, $loanTypeID = 0, $loan_accountID = 0){
    $query = $this->db->select("SUM(amount_dr - amount_cr) as sumPayments")
        ->where([
            'client_id' => $client_id,
            'loanTypeID' => $loanTypeID,
            'loanAcct_id' => $loan_accountID,
            //'isRelease' => 0
        ])
        ->get('loan_payment');
    if($query->num_rows() > 0){
        return $query->row()->sumPayments == null? 0:$query->row()->sumPayments;
        }
   return 0;
    }

    function getTotalPaid($client_id = 0, $loanTypeID = 0, $loan_accountID = 0){
        $query = $this->db->select("SUM(amount_cr) as sumPaid")
            ->where([
                'client_id' => $client_id,
                'loanTypeID' => $loanTypeID,
                'loanAcct_id' => $loan_accountID,
                //'isRelease' => 0
            ])
            ->get('loan_payment');
        if($query->num_rows() > 0){
            return $query->row()->sumPaid == null? 0:$query->row()->sumPaid;
            }
       return 0;
        }

   function getPayments($array = array()){
        $query = $this->db->select('cl.*, laonp.*, loan_payment.*, loanAc.intRate, loanAc.loanAmount')
            ->where([
                'loan_payment.dateTransaction >=' => $array['start'].' 00:00:01',
                'loan_payment.dateTransaction <=' => $array['end'].' 23:59:59',
                'loan_payment.isRelease' => 0,
                //'loan_payment.isPenalty' => 0,
                //'loan_payment.isInterest' => 0
            ])
            ->join('client as cl','cl.ClientID = loan_payment.client_id','LEFT')
            ->join('loan_product as laonp','laonp.loan_productID = loan_payment.loanTypeID','LEFT')
            ->join('loan_account as loanAc','loanAc.loan_accountID = loan_payment.loanAcct_id','LEFT')
            ->get('loan_payment');

        if($query->num_rows() > 0){
            return $query->result();
        }
        return array();
   }

   function getCbuList($array = array()){
       $query = $this->db->select('cl.*, client_savings.*, loanAc.loan_accountID, laonp.loanProduct_name')
       ->where([
        'client_savings.dateCreated >=' => $array['start'].' 00:00:01',
        'client_savings.dateCreated <=' => $array['end'].' 23:59:59',
        ])
        ->join('client as cl','cl.ClientID = client_savings.client_id','LEFT')
        ->join('loan_account as loanAc','loanAc.loan_accountID = client_savings.loan_acountID','LEFT')
        ->join('loan_product as laonp','laonp.loan_productID = loanAc.loanTypeID','LEFT')
        ->get('client_savings');

        if($query->num_rows() > 0){
            return $query->result();
        }
        return array();

   }

}