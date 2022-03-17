<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reimbursement extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(array('m_claim_reimbursement','m_reimbursement','m_user'));
		$this->load->library(array('template','image_lib','libku','mypdf','upload','image_lib','firebase','cetak','notifikasi'));
		if (!$this->hak->cek()){
			$this->session->sess_destroy();
			redirect(base_url());
			exit();
		}
		date_default_timezone_set('Asia/Jakarta');
    }
	public function index(){
		$data['title'] = 'Rekap Reimbursement';
		$this->template->display('content/transaksi/reimbursement',$data);
	}
	public function claim(){
		$data['title'] = 'Claim Reimbursement';
		$this->template->display('content/transaksi/claim_reimbursement',$data);
	}
	public function get_all_barang($id){
		$data = $this->m_daftar_harga->get_all_by_id($id);
		echo json_encode($data);
	}
	public function ajax_list(){
		$list = $this->m_reimbursement->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $d) {
			$no++;
			$status ="";
			switch ($d->status) {
				case "0":
				$status = "Belum Ditanda tangani";
					break;
				case "1":
					$status = "Menunggu Verifikasi Project Manager";
					break;
				case "2":
				$status = "Terverifikasi Project Manager";
					break;
				case "3":
				$status = "Terverifikasi Verifikator I";
					break;
				case "4":
				$status = "Terverifikasi Verifikator II";
					break;
				case "5":
				$status = "Disetujui";
					break;
				case "6":
				$status = "Ditolak Project Manager";
					break;
				case "7":
				$status = "Ditolak Verifikator I";
					break;
				case "8":
				$status = "Ditolak Verifikator II";
					break;
				case "9":
				$status = "Ditolak Verifikator III";
					break;
			}
			$row = array();
			$row[] = $no;
			$row[] = $d->no_pengajuan;
			$row[] = date("d/m/Y",strtotime($d->tanggal));
			$row[] = $status;
			$row[] = '<div class="aksi">
						<a href="'.base_url().'reimbursement/detail/'.$d->id_reimbursement.'" title="see">
							<span class="nav-icon"><i class="lihat_icon"></i></span>
						</a>
					  </div>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_reimbursement->count_all(),
			"recordsFiltered" => $this->m_reimbursement->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
    }
	public function ajax_list_rencana(){
		$list = $this->m_claim_reimbursement->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $d) {
			$no++;
			$jenis ="";
			if($d->jenis_transaksi == "1")
			{
				$jenis = "Operasional Kantor";
			}else if($d->jenis_transaksi == "2")
			{
				$jenis = "Perjalanan Dinas";
			} else
			{
				$jenis = "Lain-Lain";
			}
			if($d->bukti == "" || $d->bukti == NULL)
			{
				$bukti = "-";
			}
			else
			{
				$bukti = '<div class="aksi">
						<a href="javascript:void(0)" title="Delete" onclick="lihat_bukti('."'".$d->bukti."'".')">
							<span class="nav-icon"><i class="lihat_icon"></i></span>
						</a>
					  </div>';
			}
			$row = array();
			$row[] = $no;
			$row[] = $jenis;
			$row[] = $d->atas_nama;
			$row[] = $d->uraian;
			$row[] = number_format($d->jumlah,0,',','.');
			$row[] = $bukti;
			$row[] ='<div class="aksi">
						<a href="javascript:void(0)" title="Delete" onclick="delete_data('."'".$d->id_claim_reimbursement."'".')">
							<span class="nav-icon"><i class="delete-icon"></i></span>
						</a>
					  </div>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_claim_reimbursement->count_all(),
			"recordsFiltered" => $this->m_claim_reimbursement->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
    }
	function save_rencana(){
		$this->form_validation->set_rules('jenis_transaksi','jenis_transaksi','required');
		$this->form_validation->set_rules('atas_nama','atas_nama','required');
		$this->form_validation->set_rules('uraian','uraian','required');
		$this->form_validation->set_rules('jumlah','jumlah','required');
		if($this->form_validation->run() != false)
		{
				date_default_timezone_set('Asia/Jakarta');
				$date = date("Y-m-d");
				$time = date("H:i:s");
				$code = date("HdmiYs");
				$upload_conf = array
				(
					'upload_path'   => realpath('./upload/bukti/'),
					'allowed_types' => 'jpeg|jpg|png|pdf',
					'file_name'=> $code
				);
				$this->upload->initialize( $upload_conf );
				if (!$this->upload->do_upload())
				{
					$e = $this->upload->display_errors();
					$e1 = str_replace('<p>','',$e);
					$error = str_replace('</p>','',$e1);
					echo json_encode(array("status" =>FALSE, "error"=>$error));
				}
				else
				{	
					$upload_data = $this->upload->data();
					$data = array
					(
						'jenis_transaksi'=>$this->input->post('jenis_transaksi',TRUE),
						'atas_nama'=>$this->input->post('atas_nama',TRUE),
						'uraian'=>$this->input->post('uraian',TRUE),
						'jumlah'=>$this->libku->ribuansql($this->input->post('jumlah',TRUE)), 
						'bukti' => 'upload/bukti/'.$upload_data['file_name']
					);
					$this->m_claim_reimbursement->save($data);
					echo json_encode(array("status"=>TRUE,"error"=>""));
				}
			}
			else
			{
				echo json_encode(array("status"=>FALSE,"error"=>"Terjadi kesalahan jaringan. Jaringan lemot/terputus."));	
			}
	}
	function delete_rencana($id){
		$x = $this->m_claim_reimbursement->edit($id);
		if($x->bukti != NULL || $x->bukti != "")
		{
			unlink($x->bukti);
		}
		$this->m_claim_reimbursement->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	function kirim_pengajuan(){
		date_default_timezone_set('Asia/Jakarta');
		$code = date("Ymdhis");
		$tanggal = date ("Y-m-d H:i:s");
		$no_pengajuan = "REIM-".$code;
		$id_user = $this->session->userdata("id_user");
		$x = $this->m_claim_reimbursement->get_all();
		$y = json_encode($x);
		$data = array(
			'tanggal'=>$tanggal,
			'no_pengajuan'=>$no_pengajuan,
			'id_pemohon'=>$id_user,
			'data'=>$y
		);
		$id = $this->m_claim_reimbursement->save_po($data);
		$push= array(
			'id_reimbursement'=>$id,
			'no_pengajuan'=>$no_pengajuan,
			'tanggal'=>$tanggal,
			'status'=>"0"
		);
		$this->firebase->saveData($push,"reimbursement");
		$id_user = $this->session->userdata('id_user');
		$user = $this->m_user->edit($id_user);
		$body ="Anda telah melakukan Claim Reimbursement silahkan untuk menandatangani!";
		$title ="New Claim Reimbursement";
		$this->notifikasi->send($user->token,$body,$title);
	}
	function detail($id){
		$filename = $this->cetak->reimbursement($id);
		$data['filename'] = $filename;
		$data['title'] = 'Claim Reimbursement';
        $this->template->display('content/transaksi/detail_reim',$data);
	}
	
}