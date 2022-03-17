<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
	    public function __construct(){
        parent::__construct();
        $this->load->library(array('form_validation'));
		$this->load->model(array('m_login'));
    }
	public function index()
	{
		$session = $this->session->userdata('logged_in_rtlh');
		if ($session == FALSE) {
			$data['title'] = "";
			$this->load->view('login',$data);
		} else {
			redirect('home');
		}
	}
	public function validasi() 
	{
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('login');
		} else {
			// $password = decrypt_url($this->input->post('password'));
			$data= array
			(
				'email' => $this->input->post('email'),
				// 'password' => $password,
				'password' => $this->input->post('password'),

			);
			$cek = $this->m_login->cek($data); 
			$menuju;
			if($cek == 1)
			{
				// $user = $this->input->post('email');
				$x = $this->m_login->ambil_user($data);	
				$newdata = array
				(
					'id' => $x->id,
					'nama' => $x->nama,
					'email'=>$x->email,
					'nip' =>$x->nip,
					'posisi' =>$x->posisi,
					'logopengawas' =>$x->logopengawas,
					'logged_in_rtlh'=> TRUE
				);
				if ($x->posisi=='KPA') {
					$menuju='kpa/home';
				}else{
					$menuju='home';
				}
				$this->session->set_userdata($newdata);	
				redirect($menuju);
			}
			else
			{
				 redirect('login');
			}
		}
	}
	public function logout() {
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . 'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-chace');
		$this->session->sess_destroy();
		redirect(base_url());
	}
	
	function cek_status()
	{

		echo json_encode($this->hak->cek());
	}
}