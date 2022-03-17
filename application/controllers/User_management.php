<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_management extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(array('m_user'));
		if (!$this->hak->cek()){
			$this->session->sess_destroy();
			redirect(base_url());
			exit();
		}
		date_default_timezone_set('Asia/Jakarta');
    }
	public function index()
	{
		$data['title'] = 'User Management';
		$this->template->display('content/systems/user',$data);
	}
	public function ajax_list()
    {
		$list = $this->m_user->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $d) {
			$no++;
			$hak = $d->hak;
			if($hak == "1")
			{
				$hak = "Direksi";
			}
			elseif($hak == "2")
			{
				$hak ="Administrasi";
			}
			elseif($hak =="3")
			{
				$hak ="Konsultan";
			}
			elseif($hak == "4")
			{
				$hak ="Owner";
			}
			elseif($hak == "5")
			{
				$hak = "Project Manager";
			}
			$row = array();
			$row[] = $no;
			$row[] = $d->nama;
			$row[] = $d->email;
			$row[] = $hak;
			$row[] = '<div class="aksi">
						<a href="javascript:void(0)" title="Delete" onclick="delete_data('."'".encrypt_url($d->id_user)."'".')">
							<span class="nav-icon"><i class="delete-icon"></i></span>
						</a>
					  </div>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_user->count_all(),
			"recordsFiltered" => $this->m_user->count_filtered(),
			"data" => $data,
			"x"=>$this->firebase->getAllUser2()
		);
		echo json_encode($output);
    }
	function save()
	{
		$this->form_validation->set_rules('nama','nama','required');
		$this->form_validation->set_rules('email','email','required');
		$this->form_validation->set_rules('password','password','required');
		$this->form_validation->set_rules('hak','hak','required');
		if($this->form_validation->run() != false)
		{
			
			$push= array(
				'email' => $this->input->post('email',TRUE),
				'password' => $this->input->post('password',TRUE),
				'displayName' => $this->input->post('nama',TRUE),
			);
			
			$idU = "";
			if($this->firebase->createUser($push))
			{
				$x = $this->firebase->cek_user($this->input->post('email',TRUE));
				$iU = $x->uid;
			}
			$email = $this->input->post('email',TRUE);
			$data = array(
					'email' => $email,
					'password' => encrypt_url($this->input->post('password',TRUE)),
					'hak' => $this->input->post('hak',TRUE),
					'nama' => $this->input->post('nama',TRUE),
					'id_firebase'=>$idU
			);
			$this->m_user->save($data);
			echo json_encode(array("status"=>TRUE));
		}
		else
		{
			echo json_encode(array("status"=>FALSE));	
		}
	}
	function cek_user()
	{
		$x = $this->m_user->cek_user($this->input->post('email'));
		if($x > 0)
		{
			$status= FALSE;
		}
		else
		{
			$status = TRUE;
		}
		echo json_encode(array('status'=>$status));
	}
	function delete()
	{
		$id = decrypt_url($this->input->post('id'));
		$x = $this->m_user->edit($id);
		
	
		
		
		if($x->profil != NULL || $x->profil != "")
		{
		  unlink($x->profil) ;
		}
		$this->m_user->delete_by_id($id);
			$this->firebase->deleteUser(decrypt_url($x->id_firebase));
		echo json_encode(array("status" => TRUE));
	}
}