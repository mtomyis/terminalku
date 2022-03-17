<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Notifikasi {
	protected $ci;
	function __construct(){
		$this->ci = &get_instance();
	}
	
	function send($token,$body,$title){
		$response = array();
     	$msg = array
          (
			'body' 	=>$body,
			'title'	=> $title,
			"sound"=>"ring.mp3"
          );
		$fields = array
		(
			'to'		=>  $token,
			'notification'	=> $msg
		);
		$headers = array
		(
			'Authorization: key=AAAAV3E3Bew:APA91bGgzW2stFgiT9GL4XF48KNJVIWgMUbNKDVLlIxF6UUbX-bmH7dcboqwZi90MpINBUdGA6z6ypswD9RbuSFstS3H7lk9H-e88caG75RPbdKEUjLZCFHwvrNSzRGQ17ElX2rshmlU',
			'Content-Type: application/json'
		);	
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
		echo $result;
	}
	
}