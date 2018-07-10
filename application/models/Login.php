<?php defined('BASEPATH') or die('No direct script access allowed');

class Login extends CI_Model {

	function authenticate($username, $pwd) {
		if ($username != '' && $pwd != '') {
			$check = $this->db->select()->where([
				'username' => $username,
				'password' => md5($pwd),
				'is_deleted' => 0,
			])->get('users');

			if ($check->num_rows() > 0) {
				$row = $check->row();
				// Set sessions
				$this->session->set_userdata('my_auth', [
					'user_id' => $row->user_id,
					'username' => $row->username,
					'token' => md5($row->username),
				]);

				return true;
			} else {
				return false;
			}

		}
	}

}