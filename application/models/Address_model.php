<?php defined('BASEPATH') or die('No direct script access allowed');

class Address_model extends CI_Model {

	function getprovince(){
		$query = $this->db->select('*')
			->get('refprovince');
			
		if($query->num_rows() > 0)
			return $query->result();

		return array();
	}

	function getCityMuni($prov_code = 0){
		$query = $this->db->select('*')
			->where('provCode',$prov_code)
			->get('refcitymun');

		if($query->num_rows() > 0)
			return $query->result();

		return array();	
	}

	function getBarangay($city_code = 0){
		$query = $this->db->select('*')
			->where('citymunCode',$city_code)
			->get('refbrgy');

		if($query->num_rows() > 0)
			return $query->result();

		return array();	
	}
}