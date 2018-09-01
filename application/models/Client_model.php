<?php defined('BASEPATH') or die('No direct script access allowed');

class Client_model extends CI_Model {

    function getListOfclients(){
        $query = $this->db->select()
               ->get('client');
        if($query->num_rows() > 0){
            return $query->result();
        }

        return array();
    }

   function getClientInfo($client_id = 0){
      
        if($client_id > 0){
            $query = $this->db->select()
                ->where([
                    'ClientID' => $client_id
                ])
                ->get('client');
            if($query->num_rows() > 0){
                return $query->row();
            }
            return array();
        }
    return array();
}

  function getChecklist($client_id = 0){
    if($client_id > 0){
        $query = $this->db->select()
            ->where([
                'client_id' => $client_id
            ])
            ->get('checklist');
        if($query->num_rows() > 0){
            return $query->row();
        }
        return array();
    }
return array();
  }


  function joiningTest($id){
      $query = $this->db->select()
        ->where('ClientID',$id)
        ->join('checklist as check','check.client_id = client.ClientID','LEFT')
        ->get('client');

     if($query->num_rows() > 0){
        return $query->row();  
     }
     return array();
  }

  function getClientLoanList($client_id = 0){
            $query = $this->db->select()
            ->where([
               //'loanStatus' => 'applied',
                //'isRelease' => 0
                'client_id' => $client_id
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

        function getClientLoanAccount($loanID = 0){
            $query = $this->db->select()
            ->where([
            //'loanStatus' => 'applied',
                //'isRelease' => 0
                'loan_accountID' => $loanID
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

        function getClientLoanAccountIfRelease($loanID = 0){
            $query = $this->db->select()
            ->where([
            //'loanStatus' => 'applied',
                'isRelease' => 1,
                'loan_accountID' => $loanID
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

  function getClientLoanTransactions($loanID = 0){
    $query = $this->db->select()
        ->where([
            'loanAcct_id' => $loanID,
            'isRelease' => 0
        ])
        //->join('loan_account as lact','lact.loan_accountID = loan_payment.loanAcct_id','LEFT')
        ->ORDER_BY('dateTransaction','ASC')
        ->get('loan_payment');
        if($query->num_rows() > 0){
            return $query->result();
        }
        return array();
  }

  function getClientSavings($client_id = 0){
    $query = $this->db->select('client_savings.*,loanprod.loanProduct_name ')
        ->where([
            'client_savings.client_id' => $client_id
        ])
        ->join('loan_account as loanAcct','loanAcct.loan_accountID = client_savings.loan_acountID','LEFT')
        ->join('loan_product as loanprod','loanprod.loan_productID = loanAcct.loanTypeID','LEFT')
        ->get('client_savings');
           // print_r($this->db->last_query());die;
        if($query->num_rows() > 0){
            return $query->result();
        }
    return array();
  }

  function getSumofSavings($client_id = 0){
    $query = $this->db->select("SUM(amount_cr - amount_dr) as totalBalance")
        ->where([
            'client_id' => $client_id
        ])->get('client_savings');
        if($query->num_rows()){
           return $query->row()->totalBalance;
        }
    return 0;
  }

}