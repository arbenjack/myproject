<?php defined('BASEPATH') or die('No direct script access allowed');

class Common_model extends CI_Model{
	

	function insert($table = '', $data = array()){
		$insert = $this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	function update($table = '', $data = array(), $where = array()){
		return $this->db->update($table, $data, $where);
	}

}