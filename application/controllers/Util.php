<?php

require 'mailer/Exception.php';
require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Util {
	
	public static function send_email($to, $subject, $body) {
		$mail = new PHPMailer(true);
		try {
    		$mail->SMTPDebug = 0;
    		$mail->isSMTP();
    		$mail->Host = 'mail.redowl.web.id';
    		$mail->SMTPAuth = true;
    		$mail->Username = 'admin2@redowl.web.id';
    		$mail->Password = 'u6ZR!SHaf7Or';
    		$mail->SMTPSecure = 'ssl';
    		$mail->Port = 465;
    		$mail->setFrom('admin2@redowl.web.id', 'Driver Booster Admin');
    		$mail->addAddress($to, 'Driver Booster User');
    		$mail->addReplyTo('admin2@redowl.web.id', 'Driver Booster Admin');
    		$mail->isHTML(true);
    		$mail->Subject = $subject;
    		$mail->Body = $body;
    		$mail->send();
		} catch (Exception $e) {
    		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}
}
