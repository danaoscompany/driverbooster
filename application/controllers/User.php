<?php

include "Util.php";

class User extends CI_Controller {
	
	public function get_garages() {
		$lat = doubleval($this->input->post('lat'));
		$lng = doubleval($this->input->post('lng'));
		$garages = $this->db->query("SELECT *, SQRT(POW(69.1 * (latitude - " . $lat . "), 2) + POW(69.1 * (" . $lng . " - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `garages` ORDER BY distance")->result_array();
		echo json_encode($garages);
	}
	
	public function get_oprekers() {
		$lat = doubleval($this->input->post('lat'));
		$lng = doubleval($this->input->post('lng'));
		$oprekers = $this->db->query("SELECT *, SQRT(POW(69.1 * (latitude - " . $lat . "), 2) + POW(69.1 * (" . $lng . " - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `oprekers` ORDER BY distance")->result_array();
		echo json_encode($oprekers);
	}
	
	public function get_garage_by_id() {
		$id = $this->input->post('id');
		echo json_encode($this->db->query("SELECT * FROM `garages` WHERE `id`=" . $id)->row_array());
	}
	
	public function get_opreker_by_id() {
		$id = $this->input->post('id');
		echo json_encode($this->db->query("SELECT * FROM `oprekers` WHERE `id`=" . $id)->row_array());
	}
	
	public function check_email_phone() {
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$userCount = $this->db->query("SELECT * FROM `users` WHERE `email`='" . $email . "'")->num_rows();
		if ($userCount > 0) {
			echo json_encode(array(
				'response_code' => -1
			));
			return;
		}
		$userCount = $this->db->query("SELECT * FROM `users` WHERE `phone`='" . $phone . "'")->num_rows();
		if ($userCount > 0) {
			echo json_encode(array(
				'response_code' => -2
			));
			return;
		}
		echo json_encode(array(
			'response_code' => 1
		));
	}
	
	public function login() {
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$users = $this->db->query("SELECT * FROM `users` WHERE `email`='" . $email . "' AND `password`='" . $password . "'")
			->result_array();
		if (sizeof($users) > 0) {
			$user = $users[0];
			$active = intval($user['active']);
			if ($active == 1) {
				$user['response_code'] = 1;
			} else {
				$user['response_code'] = -2;
			}
			echo json_encode($user);
		} else {
			echo json_encode(array(
				'response_code' => -1
			));
		}
	}
	
	public function signup() {
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$password = $this->input->post('password');
		$name = $this->input->post('name');
		$this->db->insert('users', array(
			'email' => $email,
			'phone' => $phone,
			'password' => $password,
			'name' => $name
		));
		echo json_encode(array(
			'response_code' => 1
		));
	}
	
	public function send_verification_email() {
		$email = $this->input->post('email');
		$code = $this->input->post('code');
		Util::send_email($email, "Kode verifikasi Anda: " . $code, "Masukkan 6-digit kode verifikasi berikut ke kotak yang tersedia: <b>" . $code . "</b>");
	}
	
	public function reset_password() {
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$this->db->query("UPDATE `users` SET `password`='" . $password . "' WHERE `email`='" . $email . "'");
	}
	
	public function get_nearby_users() {
		$lat = $this->input->post('lat');
		$lng = $this->input->post('lng');
		$users = $this->db->query("SELECT *, SQRT(POW(69.1 * (latitude - " . $lat . "), 2) + POW(69.1 * (" . $lng . " - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `users` HAVING distance < 50 ORDER BY distance")->result_array();
		echo json_encode($users);
	}
	
	public function update_location() {
		$id = $this->input->post('id');
		$lat = $this->input->post('lat');
		$lng = $this->input->post('lng');
		$this->db->query("UPDATE `users` SET `latitude`=" . $lat . ", `longitude`=" . $lng . " WHERE `id`=" . $id);
		echo "UPDATE `users` SET `latitude`=" . $lat . ", `longitude`=" . $lng . " WHERE `id`=" . $id;
	}
}
