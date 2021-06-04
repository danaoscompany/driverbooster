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
    		$mail->SMTPDebug = 2;
    		$mail->isSMTP();
    		$mail->Host = 'smtp-relay.sendinblue.com';
    		$mail->SMTPAuth = true;
    		$mail->Username = 'oprekmaniacom@gmail.com';
    		$mail->Password = 'YR34KmgwFQVxavNt';
    		$mail->SMTPSecure = 'tls';
    		$mail->Port = 587;
    		$mail->setFrom('oprekmaniacom@gmail.com', 'Driver Booster Admin');
    		$mail->addAddress($to, 'Driver Booster User');
    		$mail->addReplyTo('oprekmaniacom@gmail.com', 'Driver Booster Admin');
    		$mail->isHTML(true);
    		$mail->Subject = $subject;
    		$mail->Body = $body;
    		$mail->send();
		} catch (Exception $e) {
    		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}
}
