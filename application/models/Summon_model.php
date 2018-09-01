<?php defined('BASEPATH') or die('No direct script access allowed');

class Summon_model extends CI_Model {
        function getsummonData($summon_id = 0){
        $query = $this->db->select('
            summons.*, 
            complinant.first_name as c_fname,
            complinant.last_name as c_lname,
            complinant.mid_name as c_mname,
            respondent.first_name as r_fname,
            respondent.last_name as r_lname,
            respondent.mid_name as r_mname')
            ->where('summon_id',$summon_id )
            ->join('citizens as complinant','complinant.citizen_id = summons.complainance_id','LEFT')
            ->join('citizens as respondent','respondent.citizen_id = summons.respondent_id','LEFT')
            ->get('summons');

        if($query->num_rows() > 0){
            return $query->row();
        }
        return array();
    }
	function summonList(){
		$query = $this->db->select('
			summons.*, 
			complinant.first_name as c_fname,
			complinant.last_name as c_lname,
			complinant.mid_name as c_mname,
			respondent.first_name as r_fname,
			respondent.last_name as r_lname,
			respondent.mid_name as r_mname')
			->join('citizens as complinant','complinant.citizen_id = summons.complainance_id','LEFT')
			->join('citizens as respondent','respondent.citizen_id = summons.respondent_id','LEFT')
			->get('summons');

		if($query->num_rows() > 0){
			return $query->result();
		}
		return array();
	}
	  function allposts_count()
    {   
        $query = $this
                ->db
                ->where('is_deleted',0)
                ->get('citizens');
    
        return $query->num_rows();  

    }

       function allposts($limit,$start,$col,$dir)
    {   
       $query = $this
                ->db
                ->select('summons.*, 
			complinant.first_name as c_fname,
			complinant.last_name as c_lname,
			complinant.mid_name as c_mname,
			respondent.first_name as r_fname,
			respondent.last_name as r_lname,
			respondent.mid_name as r_mname')
                ->limit($limit,$start)
                ->order_by($col,$dir)
			->join('citizens as complinant','complinant.citizen_id = summons.complainance_id','LEFT')
			->join('citizens as respondent','respondent.citizen_id = summons.respondent_id','LEFT')
			->get('summons');
        
        if($query->num_rows()>0)
        {
            return $query->result(); 
        }
        else
        {
            return array();
        }
        
    }

    function posts_search($limit,$start,$search,$col,$dir)
    {
        $query = $this
                ->db
                ->select('summons.*, 
			complinant.first_name as c_fname,
			complinant.last_name as c_lname,
			complinant.mid_name as c_mname,
			respondent.first_name as r_fname,
			respondent.last_name as r_lname,
			respondent.mid_name as r_mname')
                ->like('summon_id',$search)
                ->or_like('summon_date',$search)
                ->or_like('brgycasenum',$search)
                ->or_like('details',$search)
                ->limit($limit,$start)
                ->order_by($col,$dir)
			->join('citizens as complinant','complinant.citizen_id = summons.complainance_id','LEFT')
			->join('citizens as respondent','respondent.citizen_id = summons.respondent_id','LEFT')
			->get('summons');
        
       
        if($query->num_rows()>0)
        {
            return $query->result();  
        }
        else
        {
            return null;
        }
    }

        function posts_search_count($search)
    {
        $query = $this
                ->db
                ->like('summon_id',$search)
                ->or_like('summon_date',$search)
                ->or_like('brgycasenum',$search)
                ->or_like('details',$search)
			->join('citizens as complinant','complinant.citizen_id = summons.complainance_id','LEFT')
			->join('citizens as respondent','respondent.citizen_id = summons.respondent_id','LEFT')
			->get('summons');
    
        return $query->num_rows();
    } 
}