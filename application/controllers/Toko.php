<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toko extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(array('m_toko'));
		if (!$this->hak->cek()){
			$this->session->sess_destroy();
			redirect(base_url());
			exit();
		}
		date_default_timezone_set('Asia/Jakarta');
    }
	public function index()
	{
		$data['title'] = 'Rekanan/Toko';
		$this->template->display('content/daftar_harga/rekanan',$data);
	}
	public function ajax_list()
    {
		$list = $this->m_toko->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $d) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $d->nama_toko;
			$row[] = $d->alamat;
			$row[] = $d->no_telp;
			$row[] = $d->no_rekening;
			$row[] = $d->nama_bank;
			$row[] = '<div class="aksi">
						<a href="javascript:void(0)" title="Delete" onclick="delete_data('."'".$d->id_toko."'".')">
							<span class="nav-icon"><i class="delete-icon"></i></span>
						</a>
             			<a href="javascript:void(0)" onclick="edit('."'".$d->id_toko."'".')">
							<span class="nav-icon"><i class="edit-icon"></i></span>
						</a>
					  </div>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_toko->count_all(),
			"recordsFiltered" => $this->m_toko->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
    }
	function save()
	{
		$this->form_validation->set_rules('nama_toko','nama_toko','required');
		if($this->form_validation->run() != false)
		{
			$data = array
			(
				'nama_toko'=>$this->input->post('nama_toko',TRUE),
				'alamat'=>$this->input->post('alamat',TRUE),
				'no_telp'=>$this->input->post('no_telp',TRUE),
				'no_rekening'=>$this->input->post('no_rekening',TRUE),
				'nama_bank'=>$this->input->post('nama_bank',TRUE),
			);
			$this->m_toko->save($data);
			echo json_encode(array("status"=>TRUE));
		}
		else
		{
			echo json_encode(array("status"=>FALSE));	
		}
	}
	function update($id)
	{
		$this->form_validation->set_rules('nama_toko','nama_toko','required');
		if($this->form_validation->run() != false)
		{
			$data = array
			(
				'nama_toko'=>$this->input->post('nama_toko',TRUE),
				'alamat'=>$this->input->post('alamat',TRUE),
				'no_telp'=>$this->input->post('no_telp',TRUE),
				'no_rekening'=>$this->input->post('no_rekening',TRUE),
				'nama_bank'=>$this->input->post('nama_bank',TRUE),
			);
			$this->m_toko->update(array('id_toko' => $id), $data);
			echo json_encode(array("status"=>TRUE));
		}
		else
		{
			echo json_encode(array("status"=>FALSE));	
		}
	}
	function edit($id)
	{
		$data = $this->m_toko->edit($id);
		echo json_encode($data);
	}
	function delete($id)
	{
		$this->m_toko->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
}
