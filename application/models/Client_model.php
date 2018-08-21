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

}