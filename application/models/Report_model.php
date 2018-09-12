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
        //print_r($this->db->last_query());
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
}