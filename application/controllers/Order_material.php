<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_material extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$this->load->database();
		$this->load->helper(array('url'));

		$this->load->model(array('m_pekerjaan','m_sub_pekerjaan','m_item_pekerjaan','m_daftar_harga','m_toko','m_rencana','m_po','m_user'));
		$this->load->library(array('template','image_lib','libku','mypdf','firebase','cetak','notifikasi'));
		if (!$this->hak->cek()){
			$this->session->sess_destroy();
			redirect(base_url());
			exit();
		}
		date_default_timezone_set('Asia/Jakarta');
    }

    //baru
    public function new_rencana(){
		$data['pekerjaan'] = $this->m_pekerjaan->get_proyek_order();
		$data['toko'] = $this->m_toko->get_all();
		$data['title'] = 'Permohonan';
		$this->template->display('content/transaksi/rencana',$data);
	}
	public function new_select_ambil_data()
	{
		# code...
		$modul=$this->input->post('modul', TRUE);
		$id=$this->input->post('id', TRUE);

		if($modul=="proyek"){
		echo $this->m_pekerjaan->new_get_pekerjaan($id)->result();
		}
		else if($modul=="pekerjaan"){
		echo $this->m_pekerjaan->new_get_uraian($id)->result();

		}
	}
    //akhir baru

	public function index(){
		$data['pekerjaan'] = $this->m_pekerjaan->get_all();
		$data['barang'] = $this->m_daftar_harga->get_all();
		$data['title'] = 'Rekap Order Material';
		$this->template->display('content/transaksi/order_material',$data);
	}
	public function rencana(){
		$data['pekerjaan'] = $this->m_pekerjaan->get_all();
		$data['toko'] = $this->m_toko->get_all();
		$data['title'] = 'Permohonan';
		$this->template->display('content/transaksi/rencana',$data);
	}
	public function get_all_barang($id){
		$data = $this->m_daftar_harga->get_all_by_id($id);
		echo json_encode($data);
	}
	public function ajax_list(){
		$list = $this->m_po->get_datatables();
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
					$status = "Menunggu Verifikasi Administrasi";
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
			$row[] = $d->tanggal;
			$row[] = $status;
			$row[] = '<div class="aksi">
						<a href="'.base_url().'order_material/detail/'.$d->id_purchase_order.'" title="see">
							<span class="nav-icon"><i class="lihat_icon"></i></span>
						</a>
					  </div>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_po->count_all(),
			"recordsFiltered" => $this->m_po->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
    }
	public function ajax_list_rencana(){
		$list = $this->m_rencana->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $d) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $d->nama_toko;
			$row[] = $d->nama_barang;
			$row[] = number_format($d->jumlah,0,',','.');
			$row[] ='<div class="aksi">
						<a href="javascript:void(0)" title="Delete" onclick="delete_data('."'".$d->id_rencana_po."'".')">
							<span class="nav-icon"><i class="delete-icon"></i></span>
						</a>
             			<a href="javascript:void(0)" onclick="edit('."'".$d->id_rencana_po."'".')">
							<span class="nav-icon"><i class="edit-icon"></i></span>
						</a>
					  </div>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_rencana->count_all(),
			"recordsFiltered" => $this->m_rencana->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
    }
	function save_rencana(){
		$this->form_validation->set_rules('proyek','proyek','required');
		$this->form_validation->set_rules('pekerjaan','pekerjaan','required');
		$this->form_validation->set_rules('uraian_pekerjaan','uraian_pekerjaan','required');

		$this->form_validation->set_rules('id_toko','id_toko','required');
		$this->form_validation->set_rules('jumlah','jumlah','required');
		$this->form_validation->set_rules('id_barang','id_barang','required');
		if($this->form_validation->run() != false)
		{
			$id_user = $this->session->userdata("id_user");
			$date = date("Y-m-d");
			$barang = $this->m_daftar_harga->edit($this->input->post('id_barang',TRUE));
			$data = array
			(
				'id_item_pekerjaan'=>$this->input->post('uraian_pekerjaan',TRUE),
				'id_sub_pekerjaan'=>$this->input->post('pekerjaan',TRUE),
				'proyek'=>$this->input->post('proyek',TRUE),
				'id_toko'=>$this->input->post('id_toko',TRUE),
				'id_barang'=>$this->input->post('id_barang',TRUE),
				'jumlah'=>$this->libku->ribuansql($this->input->post('jumlah',TRUE)),  
				'id_user'=>$id_user,
			);
			$this->m_rencana->save($data);
			echo json_encode(array("status"=>TRUE));
		}
		else
		{
			echo json_encode(array("status"=>FALSE));	
		}
	}
	function update_rencana($id){
	
		$this->form_validation->set_rules('id_item_pekerjaan','id_item_pekerjaan','required');
		$this->form_validation->set_rules('id_toko','id_toko','required');
		$this->form_validation->set_rules('jumlah','jumlah','required');
		$this->form_validation->set_rules('id_barang','id_barang','required');
		if($this->form_validation->run() != false)
		{
			$id_user = $this->session->userdata("id_user");
			$date = date("Y-m-d");
			$barang = $this->m_daftar_harga->edit($this->input->post('id_barang',TRUE));
			$data = array
			(
				'id_sub_pekerjaan'=>$this->input->post('id_sub_pekerjaan',TRUE),
				'id_item_pekerjaan'=>$this->input->post('id_item_pekerjaan',TRUE),
				'id_toko'=>$this->input->post('id_toko',TRUE),
				'id_barang'=>$this->input->post('id_barang',TRUE),
				'jumlah'=>$this->libku->ribuansql($this->input->post('jumlah',TRUE)),  
				'id_user'=>$id_user,
			);
				$this->m_rencana->update(array('id_rencana_po' => $id), $data);
			echo json_encode(array("status"=>TRUE));
		}
		else
		{
			echo json_encode(array("status"=>FALSE));	
		}
	}
	function edit_rencana($id){
		$data = $this->m_rencana->edit($id);
		echo json_encode($data);
	}
	function delete_rencana($id){
		$this->m_rencana->delete_by_id($id);
		echo json_encode(array("status" => TRUE)); 
	}
	function get_harga_barang($id){
		$harga = $this->m_daftar_harga->edit($id);
		echo json_encode($harga);
	}
	function kirim_pengajuan(){
		//ini nanti langsung ke android
		date_default_timezone_set('Asia/Jakarta');
		$code = date("Ymdhis");
		$tanggal = date ("Y-m-d H:i:s");
		$no_pengajuan = "ODMTR-".$code;
		$id_user = $this->session->userdata("id_user");
		$nama_pemohon = $this->session->userdata("nama");
		$x = $this->m_rencana->get_all();
		$y = json_encode($x);
		$data = array(
			'tanggal'=>$tanggal,
			'no_pengajuan'=>$no_pengajuan,
			'id_pemohon'=>$id_user,
			'nama_pemohon'=>$nama_pemohon,
			'data'=>$y
		);
		// $id = $this->m_rencana->save_po($data);
		$this->m_rencana->save_po($data);

		
		// $push= array(
		// 	'id_purchase_order'=>$id,
		// 	'no_pengajuan'=>$no_pengajuan,
		// 	'tanggal'=>$tanggal,
		// 	'status'=>"0"
		// );
		// $this->firebase->saveData($push,"purchase_order");
		// $id_user = $this->session->userdata('id_user');
		// $user = $this->m_user->edit($id_user);
		// $body ="Anda telah melakukan order material silahkan untuk menandatangani!";
		// $title ="New Order Material";
		// $this->notifikasi->send($user->token,$body,$title);
	}
	function detail($id){
		$filename = $this->cetak->order_material($id);
		$data['filename'] = $filename;
		$data['title'] = 'Permohonan Pengajuan Kebutuhan Material';
        $this->template->display('content/transaksi/detail',$data);
	}
}
