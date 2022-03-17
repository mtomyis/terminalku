<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Andro extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->library(array('form_validation','upload','libku','mypdf','cetak','notifikasi','kirim_email'));
		$this->load->model(array('m_po','m_user','m_reimbursement','m_pengajuan_kas'));
		$this->load->helper(array('url','file','security'));
    }
	
	function ttd_po_pm(){
		date_default_timezone_set('Asia/Jakarta');
		$code = date("dmYHis");
		$upload_conf = array
		(
			'upload_path'   => realpath('./upload/tanda_tangan/'),
			'allowed_types' => 'gif|jpg|png|jpeg',
			'file_name'=> $code
        );
		$this->upload->initialize( $upload_conf );
        if ( !$this->upload->do_upload('tanda_tangan'))
		{
			$e = $this->upload->display_errors();
			$response['status'] = "2";
			$response['pesan'] = "Upss...!. Terjadi Kesalahan Penyimpanan Mohon ulangi lagi. Error : $e";
			$response['tanda_tangan'] = "";
			echo json_encode($response);
		}
		
        else
        {	
			$upload_data = $this->upload->data();
			$id = $this->input->post('id_purchase_order',TRUE);
			$hak = $this->input->post('hak',TRUE);
			$nama = $this->input->post('nama',TRUE);
			$verifikator = $this->input->post('verifikator',TRUE);
			$no_pengajuan = $this->input->post('no_pengajuan',TRUE);
			$tanggal = $this->input->post('tanggal',TRUE);
			if($hak == "5")
			{
				$data = array
				(
					'ttd_pemohon' => 'upload/tanda_tangan/'.$upload_data['file_name'],
					'status'=>'1'
				);
					$this->m_po->update(array('id_purchase_order' => $id), $data);
				$user = $this->m_user->get_all_verifikasi_kode("2");
				$title = 'Pengajuan Order Material Baru';
				$body = "Nomor : ".$no_pengajuan." Tanggal : ".$tanggal;
			}
			else if($hak == "2")
			{
				$data = array
				(
					'ttd_admin' => 'upload/tanda_tangan/'.$upload_data['file_name'],
					'status'=>'2',
					'nama_admin'=>$nama
				);
				$this->m_po->update(array('id_purchase_order' => $id), $data);
				$title = 'Pengajuan Order Material Baru';
				$body = "Nomor : ".$no_pengajuan." Tanggal : ".$tanggal;
				$user = $this->m_user->get_all_v("1");
			}
			else if($hak == "1")
			{
				if($verifikator =="1")
				{
					$data = array
					(
						'ttd_v1' => 'upload/tanda_tangan/'.$upload_data['file_name'],
						'status'=>'3',
						'nama_v1'=>$nama
					);
					$this->m_po->update(array('id_purchase_order' => $id), $data);
					$user = $this->m_user->get_all_v("2");
					$title = 'Pengajuan Order Material Baru';
					$body = "Nomor : ".$no_pengajuan." Tanggal : ".$tanggal;
				}
				else if($verifikator == "2")
				{
					$data = array
					(
						'ttd_v2' => 'upload/tanda_tangan/'.$upload_data['file_name'],
						'status'=>'4',
						'nama_v2'=>$nama
					);
					$this->m_po->update(array('id_purchase_order' => $id), $data);
					$title = 'Pengajuan Order Material Baru';
					$body = "Nomor : ".$no_pengajuan." Tanggal : ".$tanggal;
					$user = $this->m_user->get_all_v("3");
				}
				else if($verifikator == "3")
				{
					$data = array
					(
						'ttd_v3' => 'upload/tanda_tangan/'.$upload_data['file_name'],
						'status'=>'5',
						'nama_v3'=>$nama
					);
					$this->m_po->update(array('id_purchase_order' => $id), $data);
					$title = 'Pengajuan Order Anda Diterima';
					$body = "Nomor : ".$no_pengajuan." Tanggal : ".$tanggal;
					$user = $this->m_user->get_all_verifikasi_kode("5");
					$email = $this->m_user->get_all_email_v();
					$pdf = $this->input->post('pdf',TRUE);
					$subject = "Approved Direksi Order Material";
					foreach($email as $m)
					{
						$this->kirim_email->sendAttach($m->email,base_url().$this->cetak->order_material($id),$subject);
					}
					
				}
			}
			$response['status'] = "1";
			echo json_encode($response);
			
			foreach($user as $u)
			{
				$token = $u->token;
				if($token != NULL)
				{
					$this->notifikasi->send($token,$body,$title);
				}
			}
		}
	}
	
	function ttd_reimbursement_pm(){
		date_default_timezone_set('Asia/Jakarta');
		$code = date("dmYHis");
		$upload_conf = array
		(
			'upload_path'   => realpath('./upload/tanda_tangan/'),
			'allowed_types' => 'gif|jpg|png|jpeg',
			'file_name'=> $code
        );
		$this->upload->initialize( $upload_conf );
        if ( !$this->upload->do_upload('tanda_tangan'))
		{
			$e = $this->upload->display_errors();
			$response['status'] = "2";
			$response['pesan'] = "Upss...!. Terjadi Kesalahan Penyimpanan Mohon ulangi lagi. Error : $e";
			$response['tanda_tangan'] = "";
			echo json_encode($response);
		}
		
        else
        {	
			$upload_data = $this->upload->data();
			$id = $this->input->post('id_reimbursement',TRUE);
			$hak = $this->input->post('hak',TRUE);
			$nama = $this->input->post('nama',TRUE);
			$verifikator = $this->input->post('verifikator',TRUE);
			$no_pengajuan = $this->input->post('no_pengajuan',TRUE);
			$tanggal = $this->input->post('tanggal',TRUE);
			if($hak == "2")
			{
				$data = array
				(
					'ttd_pemohon' => 'upload/tanda_tangan/'.$upload_data['file_name'],
					'status'=>'1',
					'nama_pemohon'=>$nama
				);
				$this->m_reimbursement->update(array('id_reimbursement' => $id), $data);
				$user = $this->m_user->get_all_verifikasi_pm();
				$title = 'New Claim Reimbursement';
				$body = "Nomor : ".$no_pengajuan." Tanggal : ".$tanggal;
			}
			else if($hak == "5")
			{
				$data = array
				(
					'ttd_admin' => 'upload/tanda_tangan/'.$upload_data['file_name'],
					'status'=>'2',
					'nama_admin'=>$nama
				);
				$this->m_reimbursement->update(array('id_reimbursement' => $id), $data);
				$title = 'New Claim Reimbursement';
				$body = "Nomor : ".$no_pengajuan." Tanggal : ".$tanggal;
				$user = $this->m_user->get_all_v("1");
			}
			else if($hak == "1")
			{
				if($verifikator =="1")
				{
					$data = array
					(
						'ttd_v1' => 'upload/tanda_tangan/'.$upload_data['file_name'],
						'status'=>'3',
						'nama_v1'=>$nama
					);
					$this->m_reimbursement->update(array('id_reimbursement' => $id), $data);
					$user = $this->m_user->get_all_v("2");
					$title = 'New Claim Reimbursement';
					$body = "Nomor : ".$no_pengajuan." Tanggal : ".$tanggal;
				}
				else if($verifikator == "2")
				{
					$data = array
					(
						'ttd_v2' => 'upload/tanda_tangan/'.$upload_data['file_name'],
						'status'=>'4',
						'nama_v2'=>$nama
					);
					$this->m_reimbursement->update(array('id_reimbursement' => $id), $data);
					$title = 'New Claim Reimbursement';
					$body = "Nomor : ".$no_pengajuan." Tanggal : ".$tanggal;
					$user = $this->m_user->get_all_v("3");
				}
				else if($verifikator == "3")
				{
					$data = array
					(
						'ttd_v3' => 'upload/tanda_tangan/'.$upload_data['file_name'],
						'status'=>'5',
						'nama_v3'=>$nama
					);
					$this->m_reimbursement->update(array('id_reimbursement' => $id), $data);
					$title = 'Claim Reimbursement Disetujui';
					$body = "Claim Reimbursement anda telah terverifikasi";
					$user = $this->m_user->get_all_verifikasi_kode("5");
					$email = $this->m_user->get_all_email_v();
					$pdf = $this->input->post('pdf',TRUE);
					$subject = "Approved Direksi Claim Reimbursement";
					foreach($email as $m)
					{
						$this->kirim_email->sendAttach($m->email,base_url().$this->cetak->reimbursement($id),$subject);
					}
				}
			}
			
			$response['status'] = "1";
			echo json_encode($response);
			
			foreach($user as $u)
			{
				$token = $u->token;
				if($token != NULL)
				{
					$this->notifikasi->send($token,$body,$title);
				}
			}
		}
	}
	
	function ttd_kas_pm(){
		date_default_timezone_set('Asia/Jakarta');
		$code = date("dmYHis");
		$upload_conf = array
		(
			'upload_path'   => realpath('./upload/tanda_tangan/'),
			'allowed_types' => 'gif|jpg|png|jpeg',
			'file_name'=> $code
        );
		$this->upload->initialize( $upload_conf );
        if ( !$this->upload->do_upload('tanda_tangan'))
		{
			$e = $this->upload->display_errors();
			$response['status'] = "2";
			$response['pesan'] = "Upss...!. Terjadi Kesalahan Penyimpanan Mohon ulangi lagi. Error : $e";
			$response['tanda_tangan'] = "";
			echo json_encode($response);
		}
		
        else
        {	
			$upload_data = $this->upload->data();
			$id = $this->input->post('id_pengajuan_kas',TRUE);
			$hak = $this->input->post('hak',TRUE);
			$nama = $this->input->post('nama',TRUE);
			$verifikator = $this->input->post('verifikator',TRUE);
			$no_pengajuan = $this->input->post('no_pengajuan',TRUE);
			$tanggal = $this->input->post('tanggal',TRUE);
			if($hak == "2")
			{
				$data = array
				(
					'ttd_pemohon' => 'upload/tanda_tangan/'.$upload_data['file_name'],
					'status'=>'1'
				);
				$this->m_pengajuan_kas->update(array('id_pengajuan_kas' => $id), $data);
				$user = $this->m_user->get_all_v("1");
				$title = 'Pengajuan Kas Baru';
				$body = "Nomor : ".$no_pengajuan." Tanggal : ".$tanggal;
				
			}
			else if($hak == "1")
			{
				if($verifikator =="1")
				{
					$data = array
					(
						'ttd_v1' => 'upload/tanda_tangan/'.$upload_data['file_name'],
						'status'=>'2',
						'nama_v1'=>$nama
					);
					$this->m_pengajuan_kas->update(array('id_pengajuan_kas' => $id), $data);
					$user = $this->m_user->get_all_v("2");
					$title = 'Pengajuan Kas Baru';
					$body = "Nomor : ".$no_pengajuan." Tanggal : ".$tanggal;
				}
				else if($verifikator == "2")
				{
					$data = array
					(
						'ttd_v2' => 'upload/tanda_tangan/'.$upload_data['file_name'],
						'status'=>'3',
						'nama_v2'=>$nama
					);
					$this->m_pengajuan_kas->update(array('id_pengajuan_kas' => $id), $data);
					$title = 'Pengajuan Kas Baru';
					$body = "Nomor : ".$no_pengajuan." Tanggal : ".$tanggal;
					$user = $this->m_user->get_all_v("3");
				}
				else if($verifikator == "3")
				{
					$data = array
					(
						'ttd_v3' => 'upload/tanda_tangan/'.$upload_data['file_name'],
						'status'=>'4',
						'nama_v3'=>$nama
					);
					$this->m_pengajuan_kas->update(array('id_pengajuan_kas' => $id), $data);
					$title = 'Pengajuan Kas Disetujui';
					$body = "Pengajuan kas anda telah terverifikasi";
					$user = $this->m_user->get_all_verifikasi_kode("2");
					$email = $this->m_user->get_all_email_v();
					$pdf = $this->input->post('pdf',TRUE);
					$subject = "Approved Direksi Pengajuan Kas";
					foreach($email as $m)
					{
						$this->kirim_email->sendAttach($m->email,base_url().$this->cetak->pengajuan_kas($id),$subject);
					}
					
					
				}
			}
			
			$response['status'] = "1";
			echo json_encode($response);
			foreach($user as $u)
			{
				$token = $u->token;
				if($token != NULL)
				{
					$this->notifikasi->send($token,$body,$title);
				}
			}
		}
	}
	
}