<?php defined('BASEPATH') or die('No direct script access allowed');

class Loan_model extends CI_Model {

    function getLoanAppList(){
        $query = $this->db->select()
            ->where([
                'loanStatus' => 'applied',
                'isRelease' => 0
            ])
            ->join('client as cl','cl.ClientID = loan_account.client_id','LEFT')
            ->join('loan_product as laonp','laonp.loan_productID = loan_account.loanTypeID','LEFT')
            ->get('loan_account');
       // print_r($this->db->last_query());die;
        if($query->num_rows() > 0){
            return $query->result();
        }
       return array();
    }

    function getIfAlreadyApplied($loanType_ID = 0, $client_id = 0,$status = '', $isPaid = 0, $isRelease = 0){
        $query = $this->db->select()
            ->where('loanTypeID' , $loanType_ID)
            ->where('client_id	' , $client_id)
            ->where('isPaid' , $isPaid)
            ->where_in('loanStatus',array($status,'release'))
            //->where('loanStatus', $status)
            //->or_where('loanStatus', 'release')
         /*
                //'loanStatus' => $status,
                'isPaid' => $isPaid,
                //'isRelease' => $isRelease
         */
            ->get('loan_account');
        if($query->num_rows() > 0){
            return $query->result();
        }
    return array();
    }

    function getLoanForRelease($client_id = 0, $loanProd = 0, $loanTerm = 0){
        $whereArgs = array();
        if($client_id > 0)
        $whereArgs['client_id'] = $client_id;

        if($loanProd > 0)
        $whereArgs['loanTypeID'] = $loanProd;

        if($loanTerm > 0)
        $whereArgs['termNumber'] = $loanTerm;

        $query = $this->db->select()
        ->where(array_merge([
            'loanStatus' => 'applied',
            'isRelease' => 0
        ],$whereArgs))
        ->join('client as cl','cl.ClientID = loan_account.client_id','LEFT')
        ->join('loan_product as laonp','laonp.loan_productID = loan_account.loanTypeID','LEFT')
        ->get('loan_account');
        
           if($query->num_rows() > 0){
                 return $query->result();
           }
         return array();
    }
    
    function getAllLoanReleases($whereArray  = array()){
        $query = $this->db->select()
            ->where_in('loan_accountID',$whereArray)
            ->get('loan_account');
        if($query->num_rows() > 0){
            return $query->result();
        }
        return array();
    }

    //** PAYMENT */
    function getLoanForPayment($client_id = 0, $loanProd = 0, $loanTerm = 0){
        $whereArgs = array();
        if($client_id > 0)
        $whereArgs['client_id'] = $client_id;

        if($loanProd > 0)
        $whereArgs['loanTypeID'] = $loanProd;

        if($loanTerm > 0)
        $whereArgs['termNumber'] = $loanTerm;

        $query = $this->db->select()
        ->where(array_merge([
            'loanStatus' => 'release',
            'isRelease' => 1
        ],$whereArgs))
        ->join('client as cl','cl.ClientID = loan_account.client_id','LEFT')
        ->join('loan_product as laonp','laonp.loan_productID = loan_account.loanTypeID','LEFT')
        ->get('loan_account');
        
           if($query->num_rows() > 0){
                 return $query->result();
           }
         return array();
    }

    function getSumOfpaymentByFilter($client_id = 0, $loanTypeID = 0, $loan_accountID = 0){
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
}