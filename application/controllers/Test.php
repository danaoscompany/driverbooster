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
    		$mail->Host = 'mail.redowl.web.id';
    		$mail->SMTPAuth = true;
    		$mail->Username = 'admin2@redowl.web.id';
    		$mail->Password = 'u6ZR!SHaf7Or';
    		$mail->SMTPSecure = 'ssl';
    		$mail->Port = 465;
    		$mail->setFrom('admin2@redowl.web.id', 'Driver Booster Admin');
    		$mail->addAddress('danaoscompany@gmail.com', 'Dana Prakoso');
    		$mail->addReplyTo('admin2@redowl.web.id', 'Driver Booster Admin');
    		$mail->isHTML(true);
    		$mail->Subject = 'Here is the subject';
    		$mail->Body = 'This is the HTML message body <b>in bold!</b>';
    		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    		$mail->send();
		} catch (Exception $e) {
    		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}
	
	public function native_mail() {
		mail("danaoscompany@gmail.com", "My subject", "Halo dunia");
	}
}
