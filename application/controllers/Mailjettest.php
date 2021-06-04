<?php

require 'vendor/autoload.php';
use \Mailjet\Resources;
  
class MailjetTest extends CI_Controller {
	
	public function test() {
		$mj = new \Mailjet\Client('7c211e22bab158d8bfa7d2df5510cd06','f9465e0934115f2ad4fc483da2dc6e1e',true,['version' => 'v3.1']);
  		$body = [
    		'Messages' => [
      			[
        			'From' => [
          				'Email' => "danaoscompany@gmail.com",
          				'Name' => "Dana Prakoso"
        			],
        			'To' => [
          				[
            				'Email' => "danaoscompany@gmail.com",
            				'Name' => "Dana Prakoso"
          				]
        			],
        			'Subject' => "Greetings from Mailjet.",
        			'TextPart' => "My first Mailjet email",
        			'HTMLPart' => "<h3>Dear passenger 1, welcome to <a href='https://www.mailjet.com/'>Mailjet</a>!</h3><br />May the delivery force be with you!",
        			'CustomID' => "AppGettingStartedTest"
      			]
    		]
  		];
  		$response = $mj->post(Resources::$Email, ['body' => $body]);
	}
}
