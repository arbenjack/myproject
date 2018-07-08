<?php defined('BASEPATH') or die('No direct script access allowed');

class Settings_model extends CI_Model {

	function getSettings($settings_id = 0){
		if($settings_id > 0){
			$query = $this->db->select()
				->where('setings_id', $settings_id)
				->get('settings');

			if($query->num_rows() > 0){
			return $query->row();
		}
		return array();
		}
	}
	function getAllsettings(){
		$query = $this->db->select()
				->get('settings');

			if($query->num_rows() > 0){
			return $query->result();
		}
		return array();
	}
}