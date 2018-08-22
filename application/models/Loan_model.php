<?php defined('BASEPATH') or die('No direct script access allowed');

class Loan_model extends CI_Model {

    function getLoanAppList(){
        $query = $this->db->select()
            ->where([
                'loanStatus' => 'applied'
            ])
            ->join('client as cl','cl.ClientID = loan_account.client_id','LEFT')
            ->join('loan_product as laonp','laonp.loan_productID = loan_account.loanTypeID','LEFT')
            ->get('loan_account');
     //   print_r($this->db->last_query());die;
        if($query->num_rows() > 0){
            return $query->result();
        }
       return array();
    }

    function getIfAlreadyApplied($loanType_ID = 0, $client_id = 0,$status = '', $isPaid = 0, $isRelease = 0){
        $query = $this->db->select()
            ->where([
                'loanTypeID' => $loanType_ID,
                'client_id	' => $client_id,
                'loanStatus' => $status,
                'isPaid' => $isPaid,
                'isRelease' => $isRelease
            ])
            ->get('loan_account');
        if($query->num_rows() > 0){
            return $query->result();
        }
    return array();
    }

}