<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Android extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->library(array('form_validation','upload','libku','Mypdf','cetak','notifikasi','firebase'));
		$this->load->model(array('m_login','m_pekerjaan','m_sub_pekerjaan','m_item_pekerjaan','m_daftar_harga','m_toko','m_permohonan','m_user','m_permohonan_budgeting','m_karyawan','m_po','m_reimbursement','m_pengajuan_kas'));
		$this->load->helper(array('url','file','security'));
    }
	public function get_hak() {
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode(array("status" => FALSE));
		} else 
		
		{
			$password = decrypt_url($this->input->post('password'));
			$data= array
			(
				'email' => $this->input->post('email'),
				'password' => $password,
			);
			$cek = $this->m_login->cek($data); 
			if($cek == 1)
			{
				$user = $this->input->post('email');
				$x = $this->m_login->ambil_user($user);
				$hak = $x->hak;
				$id = $x->id_user;
				$isi = array(
					'token' =>$this->input->post('token')
				);
				$this->m_user->update(array('id_user' => $id), $isi);
				$data['status']= TRUE;
				$data['hak']=$hak;
				$data['id_user']=$x->id_user;
				$data['verifikator'] = $x->verifikator;
				echo json_encode($data);
			}
			echo json_encode(array("status" => FALSE));
		}
	}
	public function update_token() {
		$this->form_validation->set_rules('id_user', 'id_user', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			echo json_encode(array("status" => FALSE));
		}else
		{
			$isi = array(
				'token' =>$this->input->post('token')
			);
			$this->m_user->update(array('id_user' => $this->input->post('id_user')), $isi);
			echo json_encode(array("status" =>TRUE));
		}
	}
	function get_pdf_po(){
		$id = $this->input->post("id",TRUE);
		$filename = $this->cetak->order_material($id);
		$data['filename'] = base_url().$filename;
        echo json_encode($data);
	}
	function get_pdf_reimbursement(){
		$id = $this->input->post('id',TRUE);
		$filename = $this->cetak->reimbursement($id);
		$data['filename'] = base_url().$filename;
        echo json_encode($data);
	}
	function get_pdf_kas(){
		$id = $this->input->post('id',TRUE);
		$filename = $this->cetak->pengajuan_kas($id);
		$data['filename'] = base_url().$filename;
        echo json_encode($data);
	}
	function tolak_order_material(){
		$id = $this->input->post('id',TRUE);
		$hak = $this->input->post('hak',TRUE);
		$status = $this->input->post('status',TRUE);
		$alasan = $this->input->post('alasan',TRUE);
		
		if($hak == "5")
		{
			$this->m_po->delete_by_id($id);
			$data['status']= "1";
			echo json_encode($data);
		}
		else
		{
			$data = array(
				'status'=>$status,
				'alasan'=>$alasan
			);
			$this->m_po->update(array('id_purchase_order' => $id), $data);
			$data['status']= "1";
			echo json_encode($data);
			$title = 'Order Material Ditolak';
			$body = $alasan;
			$user = $this->m_user->get_all_verifikasi_kode("5");
			foreach($user as $u)
			{
				$token = $u->token;
				$this->notifikasi->send($token,$body,$title);
			}
		}
	}
	function tolak_reimbursement(){
		$id = $this->input->post('id',TRUE);
		$hak = $this->input->post('hak',TRUE);
		$status = $this->input->post('status',TRUE);
		$alasan = $this->input->post('alasan',TRUE);
		
		if($hak == "2")
		{
			$this->m_reimbursement->delete_by_id($id);
			$data['status']= "1";
			echo json_encode($data);
		}
		else
		{
			$data = array(
				'status'=>$status,
				'alasan'=>$alasan
			);
			$this->m_po->update(array('id_purchase_order' => $id), $data);
			$data['status']= "1";
			echo json_encode($data);
			$title = 'Claim Reimbursement Ditolak';
			$body = $alasan;
			$user = $this->m_user->get_all_verifikasi_kode("2");
			foreach($user as $u)
			{
				$token = $u->token;
				$this->notifikasi->send($token,$body,$title);
			}
		}
	}
	function tolak_kas(){
		$id = $this->input->post('id',TRUE);
		$hak = $this->input->post('hak',TRUE);
		$status = $this->input->post('status',TRUE);
		$alasan = $this->input->post('alasan',TRUE);
		
		if($hak == "2")
		{
			$this->m_pengajuan_kas->delete_by_id($id);
			$data['status']= "1";
			echo json_encode($data);
		}
		else
		{
			$data = array(
				'status'=>$status,
				'alasan'=>$alasan
			);
			$this->m_pengajuan_kas->update(array('id_pengajuan_kas' => $id), $data);
			$data['status']= "1";
			echo json_encode($data);
			$title = 'Pengajuan Kas Ditolak';
			$body = $alasan;
			$user = $this->m_user->get_all_verifikasi_kode("2");
			foreach($user as $u)
			{
				$token = $u->token;
				$this->notifikasi->send($token,$body,$title);
			}
		}
	}
	function ganti_nama(){
		$nama = $this->input->post('nama',TRUE);
		$uid = $this->input->post('uid',TRUE);
		$id_user = $this->input->post('id_user',TRUE);
		$data = array(
			'nama'=>$nama
		);
		$this->m_user->update(array('id_user'=>$id_user),$data);
		$this->firebase->ganti_nama($nama,$uid);
	}
	function ganti_email(){
		$email = $this->input->post('email',TRUE);
		if($this->cek_user($email))
		{
			$uid = $this->input->post('uid',TRUE);
			$id_user = $this->input->post('id_user',TRUE);
			$data = array(
				'email'=>$email
			);
			$this->m_user->update(array('id_user'=>$id_user),$data);
			$this->firebase->ganti_email($uid,$email);
			$data['status']= "1";
			echo json_encode($data);
		}
		else
		{
			$data['status']= "2";
			echo json_encode($data);
		}
	}
	function ganti_password(){
		$password = $this->input->post('password',TRUE);
		$uid = $this->input->post('uid',TRUE);
		$id_user = $this->input->post('id_user',TRUE);
		$data = array(
			'password'=>encrypt_url($password)
		);
		$this->m_user->update(array('id_user'=>$id_user),$data);
		$this->firebase->ganti_password($uid,$password);
	}
	function cek_user($email){
		$x = $this->m_user->cek_user($email);
		if($x > 0)
		{
			$status= FALSE;
		}
		else
		{
			$status = TRUE;
		}
		return $status;
	}
	function rekap_order_material(){
		$this->form_validation->set_rules('tanggal_awal','tanggal_awal','required');
		$this->form_validation->set_rules('tanggal_akhir','tanggal_akhir','required');
		if($this->form_validation->run() != false)
		{
			$tanggal_awal = $this->libku->tgl_mysql($this->input->post('tanggal_awal',TRUE));
			$tanggal_akhir = $this->libku->tgl_mysql($this->input->post('tanggal_akhir',TRUE));
			$data['filename'] = $this->cetak->rekap_order_material($tanggal_awal,$tanggal_akhir);
			$data['status'] = "2";
			echo json_encode($data);
		}
		else
		{
			$data['filename'] = "";
			$data['status'] = "2";
			echo json_encode($data);
		}
	}
	function rekap_reimbursement(){
		$this->form_validation->set_rules('tanggal_awal','tanggal_awal','required');
		$this->form_validation->set_rules('tanggal_akhir','tanggal_akhir','required');
		if($this->form_validation->run() != false)
		{
			$tanggal_awal = $this->libku->tgl_mysql($this->input->post('tanggal_awal',TRUE));
			$tanggal_akhir = $this->libku->tgl_mysql($this->input->post('tanggal_akhir',TRUE));
			$data['filename'] = $this->cetak->rekap_reimbursement($tanggal_awal,$tanggal_akhir);
			$data['status'] = "2";
			echo json_encode($data);
		}
		else
		{
			$data['filename'] = "";
			$data['status'] = "2";
			echo json_encode($data);
		}
	}
}