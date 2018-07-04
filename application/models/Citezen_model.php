<?php defined('BASEPATH') or die('No direct script access allowed');

class Citezen_model extends CI_Model {

	function CitezenList(){
		$query = $this->db->select('citizens.*, citAdd.*, prov.provDesc as provinceName, citMun.citymunDesc as cityMunName, brgy.brgyDesc as brgyName')
			->where('is_deleted',0)
			->join('citezend_address as citAdd','citizens.citizen_id = citAdd.citezen_id','LEFT')
			->join('refprovince as prov','prov.provCode = citAdd.province','LEFT')
			->join('refcitymun as citMun','citMun.citymunCode = citAdd.city','LEFT')
			->join('refbrgy as brgy','brgy.brgyCode = citAdd.brgy','LEFT')
			->get('citizens');

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
                ->select('citizens.*, citAdd.*, prov.provDesc as provinceName, citMun.citymunDesc as cityMunName, brgy.brgyDesc as brgyName')
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->where('is_deleted',0)
               ->join('citezend_address as citAdd','citizens.citizen_id = citAdd.citezen_id','LEFT')
			   ->join('refprovince as prov','prov.provCode = citAdd.province','LEFT')
			   ->join('refcitymun as citMun','citMun.citymunCode = citAdd.city','LEFT')
			   ->join('refbrgy as brgy','brgy.brgyCode = citAdd.brgy','LEFT')
                ->get('citizens');
        
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
                ->select('citizens.*, citAdd.*, prov.provDesc as provinceName, citMun.citymunDesc as cityMunName, brgy.brgyDesc as brgyName')
                ->like('citizen_id',$search)
                ->or_like('first_name',$search)
                ->limit($limit,$start)
                ->order_by($col,$dir)
                ->where('is_deleted',0)
                ->join('citezend_address as citAdd','citizens.citizen_id = citAdd.citezen_id','LEFT')
			   ->join('refprovince as prov','prov.provCode = citAdd.province','LEFT')
			   ->join('refcitymun as citMun','citMun.citymunCode = citAdd.city','LEFT')
			   ->join('refbrgy as brgy','brgy.brgyCode = citAdd.brgy','LEFT')
                ->get('citizens');
        
       
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
                ->like('citizen_id',$search)
                ->or_like('first_name',$search)
                ->join('citezend_address as citAdd','citizens.citizen_id = citAdd.citezen_id','LEFT')
			   ->join('refprovince as prov','prov.provCode = citAdd.province','LEFT')
			   ->join('refcitymun as citMun','citMun.citymunCode = citAdd.city','LEFT')
			   ->join('refbrgy as brgy','brgy.brgyCode = citAdd.brgy','LEFT')
                ->get('citizens');
    
        return $query->num_rows();
    } 

}