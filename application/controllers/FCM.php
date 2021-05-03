<?php

class FCM {

	public static function send_notification_to_topic($title, $body, $topic, $data) {
		$url = 'https://fcm.googleapis.com/fcm/send';
	    $fields = array(
            'to' => '/topics/' . $topic,
            'notification' => array(
            	'title' => $title,
            	'body' => $body
            )
    	);
    	if (sizeof($data) > 0) {
    		$fields['data'] = $data;
    	}
    	$fields = json_encode($fields);
    	$headers = array (
            'Authorization: key=' . "AAAAA4mkYqQ:APA91bEYdJjZtRtG2fC_eXfNnJJHmO_UGYOdM36lR0yOjMeg9ZYqD81wvQnEBQy68yjsoIRv97aPYqgEtRVgunGblzo6_buDSDqpn38DQ1xCmxGdZ675EaEy5S4x0ueku8Yijd-pU_rO",
            'Content-Type: application/json'
    	);
    	$ch = curl_init ();
    	curl_setopt ( $ch, CURLOPT_URL, $url );
    	curl_setopt ( $ch, CURLOPT_POST, true );
    	curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
    	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
    	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
	    $result = curl_exec ( $ch );
	    curl_close ( $ch );
	}

	public static function send_link_notification_to_topic($title, $body, $link, $topic, $data) {
		$url = 'https://fcm.googleapis.com/fcm/send';
	    $fields = array(
            'to' => '/topics/' . $topic,
            'notification' => array(
            	'title' => $title,
            	'body' => $body,
            	'link' => $link
            )
    	);
    	if (sizeof($data) > 0) {
    		$fields['data'] = $data;
    	}
    	$fields = json_encode($fields);
    	$headers = array (
            'Authorization: key=' . "AAAAA4mkYqQ:APA91bEYdJjZtRtG2fC_eXfNnJJHmO_UGYOdM36lR0yOjMeg9ZYqD81wvQnEBQy68yjsoIRv97aPYqgEtRVgunGblzo6_buDSDqpn38DQ1xCmxGdZ675EaEy5S4x0ueku8Yijd-pU_rO",
            'Content-Type: application/json'
    	);
    	$ch = curl_init ();
    	curl_setopt ( $ch, CURLOPT_URL, $url );
    	curl_setopt ( $ch, CURLOPT_POST, true );
    	curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
    	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
    	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
	    $result = curl_exec ( $ch );
	    curl_close ( $ch );
	}

	public static function send_image_notification_to_topic($title, $body, $image, $topic, $data) {
		$url = 'https://fcm.googleapis.com/fcm/send';
	    $fields = array(
            'to' => '/topics/' . $topic,
            'notification' => array(
            	'title' => $title,
            	'body' => $body,
            	'image' => $image
            )
    	);
    	if (sizeof($data) > 0) {
    		$fields['data'] = $data;
    	}
    	$fields = json_encode($fields);
    	$headers = array (
            'Authorization: key=' . "AAAAA4mkYqQ:APA91bEYdJjZtRtG2fC_eXfNnJJHmO_UGYOdM36lR0yOjMeg9ZYqD81wvQnEBQy68yjsoIRv97aPYqgEtRVgunGblzo6_buDSDqpn38DQ1xCmxGdZ675EaEy5S4x0ueku8Yijd-pU_rO",
            'Content-Type: application/json'
    	);
    	$ch = curl_init ();
    	curl_setopt ( $ch, CURLOPT_URL, $url );
    	curl_setopt ( $ch, CURLOPT_POST, true );
    	curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
    	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
    	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
	    $result = curl_exec ( $ch );
	    curl_close ( $ch );
	}
}
