<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	 public function __construct(){
		 parent::__construct();
		 $this->load->library('template');
		 if (!$this->hak->cek()){
			 $this->session->sess_destroy();
			 redirect(base_url());
			 exit();
		 }
    }
	public function index()
	{
		$data['title'] = 'Home';
		$this->template->display('content/home',$data);
		// $this->load->view('content/home');
	}
}
