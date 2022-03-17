<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Kirim_email {
	protected $ci;
	function __construct(){
		$this->ci = &get_instance();
	}
	
	function sendAttach($email,$file,$subject){
		$this->ci->load->library('email');
        $config['protocol']    = 'mail';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'syalam.utamabwi@gmail.com';
        $config['smtp_pass']    = '010230031988mayang';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html';
        $config['validation'] = TRUE;
		$this->ci->email->initialize($config);
		$mail = trim($email);
        $from_email = "syalam.utamabwi@gmail.com"; 
        $to_email = $email;  
        $this->ci->email->from($from_email, 'PT. SYALAM UTAMA SEJAHTERA'); 
		$this->ci->email->to($to_email);
		$this->ci->email->subject($subject); 
		$this->ci->email->message("");
        $this->ci->email->attach($file);
		if($this->ci->email->send()) 
        echo json_encode(array('status'=>TRUE));
        else 
        echo json_encode(array('status'=>FALSE));
	}
	
}