<?php

include "FCM.php";

class Admin extends CI_Controller {
	
	public function login() {
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$admins = $this->db->query("SELECT * FROM `admins` WHERE `email`='" . $email . "' AND `password`='" . $password . "'")->result_array();
		if (sizeof($admins) > 0) {
			$admin = $admins[0];
			$admin['response_code'] = 1;
			echo json_encode($admin);
		} else {
			echo json_encode(array(
				'response_code' => -1
			));
		}
	}
	
	public function get_notifications() {
		$start = intval($this->input->post('start'));
		$length = intval($this->input->post('length'));
		echo json_encode($this->db->query("SELECT * FROM `notifications` ORDER BY `date` DESC LIMIT " . $start . "," . $length)->result_array());
	}
	
	public function add_notification() {
		$title = $this->input->post('title');
		$content = $this->input->post('content');
		$link = $this->input->post('link');
		$type = $this->input->post('type');
		$date = $this->input->post('date');
		if ($type == 'image') {
			$config = array(
				'upload_path' => './userdata/',
				'allowed_types' => "*",
				'overwrite' => TRUE
			);
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('file')) {
				$filePath = $this->upload->data()['file_name'];
				$imgURL = base_url() . "/userdata/" . $filePath;
				$this->db->insert('notifications', array(
					'title' => $title,
					'content' => $content,
					'image' => $filePath,
					'link' => $link,
					'type' => $type,
					'date' => $date
				));
				FCM::send_image_notification_to_topic($title, $content, $imgURL, 'driverbooster', array(
					'link' => $link,
					'type' => $type,
					'image' => $imgURL,
					'date' => $date
				));
			} else {
				echo json_encode($this->upload->display_errors());
			}
		} else {
			$this->db->insert('notifications', array(
				'title' => $title,
				'content' => $content,
				'link' => $link,
				'type' => $type,
				'date' => $date
			));
			if ($type == 'text') {
				FCM::send_notification_to_topic($title, $content, 'driverbooster', array(
					'link' => $link,
					'type' => $type,
					'date' => $date
				));
			} else if ($type == 'link') {
				FCM::send_link_notification_to_topic($title, $content, $link, 'driverbooster', array(
					'link' => $link,
					'type' => $type,
					'date' => $date
				));
			}
		}
	}
}
