<?php defined('BASEPATH') or die('No direct script access allowed');

class Login extends CI_Model {

	function authenticate($username, $pwd) {
		if ($username != '' && $pwd != '') {
			$check = $this->db->select()->where([
				'user_name' => $username,
				'user_pwd' => md5($pwd),
				'x' => 0,
			])->get('user');

			if ($check->num_rows() > 0) {
				$row = $check->row();
				// Set sessions
				$this->session->set_userdata('my_auth', [
					'user_id' => $row->user_id,
					'user_name' => $row->user_name,
					'token' => md5($row->user_name),
				]);

				return true;
			} else {
				return false;
			}

		}
	}

}