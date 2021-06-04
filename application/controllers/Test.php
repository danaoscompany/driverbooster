<?php

include "FCM.php";
require 'mailer/Exception.php';
require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Test extends CI_Controller {
	
	public function fcm() {
		FCM::send_link_notification_to_topic("Tes judul", "Tes konten", "https://www.google.com", "driverbooster", array());
	}
	
	public function email() {
		$mail = new PHPMailer(true);
		try {
    		$mail->SMTPDebug = 2;
    		$mail->isSMTP();
    		$mail->Host = 'smtp-relay.sendinblue.com';
    		$mail->SMTPAuth = true;
    		$mail->Username = 'oprekmaniacom@gmail.com';
    		$mail->Password = 'YR34KmgwFQVxavNt';
    		$mail->SMTPSecure = 'tls';
    		$mail->Port = 587;
    		$mail->setFrom('oprekmaniacom@gmail.com', 'Driver Booster Admin');
    		$mail->addAddress('danaoscompany@gmail.com', 'Driver Booster User');
    		$mail->addReplyTo('oprekmaniacom@gmail.com', 'Driver Booster Admin');
    		$mail->isHTML(true);
    		$mail->Subject = 'This is subject';
    		$mail->Body = 'This is body';
    		$mail->send();
		} catch (Exception $e) {
    		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}
	
	public function native_mail() {
		mail("danaoscompany@gmail.com", "My subject", "Halo dunia");
	}
}
