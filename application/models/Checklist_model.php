<?php defined('BASEPATH') or die('No direct script access allowed');

class Checklist_model extends CI_Model {

    function getIfClientCheckAllList($client_id = 0){
        $query = $this->db->select()
            ->where([
                'client_id' => $client_id,
                'colateral' => 1,
                'seminar' => 1,
                'ci' => 1,
                'co_maker' => 1
            ])
            ->get('checklist');
     
        if($query->num_rows() > 0){
            return $query->result();
        }
         return array();
    }

}