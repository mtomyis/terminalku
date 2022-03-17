<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kas extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(array('m_pengajuan_kas','m_kas','m_user'));
		$this->load->library(array('template','image_lib','libku','mypdf','upload','image_lib','notifikasi','cetak'));
		if (!$this->hak->cek()){
			$this->session->sess_destroy();
			redirect(base_url());
			exit();
		}
		date_default_timezone_set('Asia/Jakarta');
    }
	public function index()
	{
		$data['title'] = 'Kas';
		$this->template->display('content/transaksi/kas',$data);
	}
	
	public function pengajuan()
	{
		$data['title'] = 'Pengajuan Kas';
		$this->template->display('content/transaksi/pengajuan_kas',$data);
	}
	
	public function get_all_barang($id)
	{
		$data = $this->m_daftar_harga->get_all_by_id($id);
		echo json_encode($data);
	}
	
	
	
	public function ajax_list()
    {
		$list = $this->m_reimbursement->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $d) {
			$no++;
			$status ="";
			switch ($d->status) {
				case "0":
				$status = "Dalam Proses Verifikasi";
					break;
				case "1":
					$status = "Terverifikasi Admin";
					break;
				case "2":
				$status = "Terverifikasi Verifikator I";
					break;
				case "3":
				$status = "Terverifikasi Verifikator II";
					break;
				case "4":
				$status = "Disetujui";
					break;
				case "5":
				$status = "Ditolak Admin";
					break;
				case "6":
				$status = "Ditolak";
					break;
		
			}
			$row = array();
			$row[] = $no;
			$row[] = $d->no_pengajuan;
			$row[] = $d->tanggal;
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
	
	public function ajax_list_pengajuan()
    {
		$list = $this->m_pengajuan_kas->get_datatables();
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
					$status = "Menunggu Verifikator I";
					break;
				case "2":
				$status = "Terverifikasi Verifikator I";
					break;
				case "3":
				$status = "Terverifikasi Verifikator II";
					break;
				case "4":
				$status = "Disetujui";
					break;
				case "5":
				$status = "Ditolak Verifikator I";
					break;
				case "6":
				$status = "Ditolak Verifikator II";
					break;
				case "7":
				$status = "Ditolak Verifikator III";
					break;
			}
			$row = array();
			$row[] = $no;
			$row[] = $d->no_pengajuan;
			$row[] = date("d/m/Y",strtotime($d->tanggal));
			$row[] = $d->uraian;
			$row[] = number_format($d->jumlah,0,',','.');
			$row[] = $status;
			$row[] = '<div class="aksi">
						<a href="'.base_url().'kas/detail/'.$d->id_pengajuan_kas.'" title="see">
							<span class="nav-icon"><i class="lihat_icon"></i></span>
						</a>
					  </div>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_pengajuan_kas->count_all(),
			"recordsFiltered" => $this->m_pengajuan_kas->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
    }
	
	function save_pengajuan()
	{
		date_default_timezone_set('Asia/Jakarta');
		$this->form_validation->set_rules('uraian','uraian','required');
		$this->form_validation->set_rules('jumlah','jumlah','required');
		if($this->form_validation->run() != false)
		{
			$tanggal = date ("Y-m-d H:i:s");
			$code = date ("YmdHis");
			$no_pengajuan = "PKAS-".$code;
			$data = array
			(
				'tanggal'=>$tanggal,
				'no_pengajuan'=>$no_pengajuan,
				'uraian'=>$this->input->post('uraian',TRUE),
				'jumlah'=>$this->libku->ribuansql($this->input->post('jumlah',TRUE)),
				'nama_pemohon'=>$this->session->userdata('nama')
			);
			$id = $this->m_pengajuan_kas->save($data);
			$push= array(
				'id_pengajuan_kas'=>$id,
				'no_pengajuan'=>$no_pengajuan,
				'tanggal'=>$tanggal,
				'status'=>"0"
			);
			$this->firebase->saveData($push,"pengajuan_kas");
			$id_user = $this->session->userdata('id_user');
			$user = $this->m_user->edit($id_user);
			$body ="Anda mengajukan kas sebesar : Rp. ".$this->input->post('jumlah');
			$title ="Pengajuan Kas";
			$this->notifikasi->send($user->token,$body,$title);
		}
		else
		{
			echo json_encode(array("status"=>FALSE));	
		}
	}
	
	

	function detail($id){
		$filename = $this->cetak->pengajuan_kas($id);
		$data['filename'] = $filename;
		$data['title'] = 'Pengajuan Kas';
        $this->template->display('content/transaksi/detail_kas',$data);
	}
}
