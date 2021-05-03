<?php

include "FCM.php";

class Test extends CI_Controller {
	
	public function fcm() {
		FCM::send_link_notification_to_topic("Tes judul", "Tes konten", "https://www.google.com", "driverbooster", array());
	}
}
