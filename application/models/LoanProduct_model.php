<?php defined('BASEPATH') or die('No direct script access allowed');

class LoanProduct_model extends CI_Model {

    function getLonProduct(){
        $query = $this->db->select()
            ->get('loan_product');
        if($query->num_rows() > 0){
            return $query->result();
        }
    return array();
    }

    function getLoanProduct($prod_id = 0){
        $query = $this->db->select()
            ->where([
                'loan_productID' => $prod_id
            ])
            ->get('loan_product');
        if($query->num_rows() > 0){
            return $query->row();  
        }
      return array();
    }

}