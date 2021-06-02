<?php

class User extends CI_Controller {
	
	public function get_garages() {
		$lat = doubleval($this->input->post('lat'));
		$lng = doubleval($this->input->post('lng'));
		$garages = $this->db->query("SELECT *, SQRT(POW(69.1 * (latitude - " . $lat . "), 2) + POW(69.1 * (" . $lng . " - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `garages` HAVING distance < 50 ORDER BY distance")->result_array();
		echo json_encode($garages);
	}
	
	public function get_oprekers() {
		$lat = doubleval($this->input->post('lat'));
		$lng = doubleval($this->input->post('lng'));
		$oprekers = $this->db->query("SELECT *, SQRT(POW(69.1 * (latitude - " . $lat . "), 2) + POW(69.1 * (" . $lng . " - longitude) * COS(latitude / 57.3), 2)) AS distance FROM `oprekers` HAVING distance < 50 ORDER BY distance")->result_array();
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
}
