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

}