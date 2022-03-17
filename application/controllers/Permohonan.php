<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permohonan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(array('m_permohonan','m_pekerjaan','m_sub_pekerjaan','m_item_pekerjaan','m_daftar_harga'));
		if (!$this->hak->cek()){
			$this->session->sess_destroy();
			redirect(base_url());
			exit();
		}
		date_default_timezone_set('Asia/Jakarta');
    }
	public function index()
	{
		$data['pekerjaan'] = $this->m_pekerjaan->get_all();
		$data['barang'] = $this->m_daftar_harga->get_all();
		$data['title'] = 'Permohonan';
		$this->template->display('content/transaksi/permohonan',$data);
	}
	public function ajax_list()
    {
		$list = $this->m_permohonan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $d) {
			$no++;
			$row = array();
			
			$s1 = $d->status_verifikator_1;
			$s2 = $d->status_verifikator_2;
			$s3 = $d->status_verifikator_3;
			if($s1 == "0" || $s2 == "0" || $s3 == "0")
			{
				$status = "Menunggu";
			}
			else if($s1 == "1" && $s2 == "1" && $s3 == "1")
			{
				$status = "Disetujui";
			}
			else
			{
				$status = "Ditolak";
			}
			
			$row[] = $no;
			$row[] = $this->libku->tglfromsql($d->tanggal_permohonan);
			$row[] = $d->uraian;
			$row[] = $d->nama_barang_permohonan;
			$row[] = $d->satuan_barang;
			$row[] = number_format($d->harga_satuan,0,',','.');
			$row[] = number_format($d->quantity,0,',','.');
			$row[] = number_format($d->jumlah,0,',','.');
			$row[] = $status;
			$row[] = '<div class="aksi">
						<a href="javascript:void(0)" title="Delete" onclick="delete_data('."'".$d->id_permohonan."'".')">
							<span class="nav-icon"><i class="delete-icon"></i></span>
						</a>
					  </div>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_permohonan->count_all(),
			"recordsFiltered" => $this->m_permohonan->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
    }
	
	function save()
	{
		$jenis = $this->input->post('jenis_transaksi',TRUE);
		if($jenis == "1")
		{
			$this->form_validation->set_rules('id_item_pekerjaan','id_item_pekerjaan','required');
			$this->form_validation->set_rules('uraian','uraian','required');
			$this->form_validation->set_rules('quantity','quantity','required');
			$this->form_validation->set_rules('jumlah','jumlah','required');
			$this->form_validation->set_rules('id_barang','id_barang','required');
			if($this->form_validation->run() != false)
			{
				$pemohon = $this->session->userdata("id_user");
				$date = date("Y-m-d");
				$barang = $this->m_daftar_harga->edit($this->input->post('id_barang',TRUE));
				$data = array
				(
					'tanggal_permohonan' =>$date,
					'id_item_pekerjaan'=>$this->input->post('id_item_pekerjaan',TRUE),
					'uraian'=>$this->input->post('uraian',TRUE),
					'nama_barang_permohonan'=>$this->input->post('nama_barang_permohonan',TRUE),
					'harga_satuan'=>$barang->harga,
					'quantity'=>$this->libku->ribuansql($this->input->post('quantity',TRUE)),
					'jumlah'=>$this->libku->ribuansql($this->input->post('jumlah',TRUE)),
					'satuan_barang'=>$barang->satuan,   
					'pemohon'=>$pemohon,
					'jenis_transaksi'=>$jenis
				);
				
				
				$this->firebase->savePermohonan($data);
				echo json_encode(array("status"=>TRUE));

			}
			else
			{
				echo json_encode(array("status"=>FALSE));	
			}
		}
		else
		{
			$this->form_validation->set_rules('uraian','uraian','required');
			$this->form_validation->set_rules('jumlah','jumlah','required');
			if($this->form_validation->run() != false)
			{
				$pemohon = $this->session->userdata("id_user");
				$date = date("Y-m-d");
				$barang = $this->m_daftar_harga->edit($this->input->post('id_barang',TRUE));
				$data = array
				(
					'tanggal_permohonan' =>$date,
					'id_item_pekerjaan'=>$this->input->post('id_item_pekerjaan',TRUE),
					'uraian'=>$this->input->post('uraian',TRUE),
					'nama_barang_permohonan'=>$this->input->post('nama_barang_permohonan',TRUE),
					'harga_satuan'=>$barang->harga,
					'quantity'=>$this->libku->ribuansql($this->input->post('quantity',TRUE)),
					'jumlah'=>$this->libku->ribuansql($this->input->post('jumlah',TRUE)),
					'satuan_barang'=>$barang->satuan,
					'pemohon'=>$pemohon,
					'jenis_transaksi'=>$jenis
				);
				
				$this->m_permohonan->save($data);
				echo json_encode(array("status"=>TRUE));

			}
			else
			{
				echo json_encode(array("status"=>FALSE));	
			}
		}
	}


	function delete($id)
	{
		$this->m_permohonan->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	
	function get_harga_barang($id)
	{
		$harga = $this->m_daftar_harga->edit($id);
		echo json_encode($harga);
	}
}
