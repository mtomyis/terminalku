<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Daftar_harga extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(array('m_daftar_harga','m_toko'));
		if (!$this->hak->cek()){
			$this->session->sess_destroy();
			redirect(base_url());
			exit();
		}
    }
	public function index()
	{
		$data['title'] = 'Daftar Harga';
		$data['toko'] = $this->m_toko->get_all();
		$this->template->display('content/daftar_harga/add',$data);
	}
	public function ajax_list()
    {
		$list = $this->m_daftar_harga->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $d) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $d->nama_toko;
			$row[] = $d->nama_barang;
			$row[] = $d->merk;
			$row[] = $d->satuan;
			$row[] = number_format($d->harga,0,',','.');
			$row[] = '<div class="aksi">
						<a href="javascript:void(0)" title="Delete" onclick="delete_data('."'".$d->id_daftar_harga."'".')">
							<span class="nav-icon"><i class="delete-icon"></i></span>
						</a>
             			<a href="javascript:void(0)" onclick="edit('."'".$d->id_daftar_harga."'".')">
							<span class="nav-icon"><i class="edit-icon"></i></span>
						</a>
					  </div>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_daftar_harga->count_all(),
			"recordsFiltered" => $this->m_daftar_harga->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
    }
	function save()
	{
		$this->form_validation->set_rules('nama_barang','nama_barang','required');
		$this->form_validation->set_rules('satuan','satuan','required');
		$this->form_validation->set_rules('harga','harga','required');
		if($this->form_validation->run() != false)
		{
			$data = array
			(
				'nama_barang'=>$this->input->post('nama_barang',TRUE),
				'merk'=>$this->input->post('merk',TRUE),
				'id_toko'=>$this->input->post('id_toko',TRUE),
				'satuan'=>$this->input->post('satuan',TRUE),
				'harga'=>$this->libku->ribuansql($this->input->post('harga',TRUE))
			);
			$this->m_daftar_harga->save($data);
			echo json_encode(array("status"=>TRUE));
		}
		else
		{
			echo json_encode(array("status"=>FALSE));	
		}
	}
	function update($id)
	{
		$this->form_validation->set_rules('nama_barang','nama_barang','required');
		$this->form_validation->set_rules('satuan','satuan','required');
		$this->form_validation->set_rules('harga','harga','required');
		if($this->form_validation->run() != false)
		{
			$data = array
			(
				'nama_barang'=>$this->input->post('nama_barang',TRUE),
				'merk'=>$this->input->post('merk',TRUE),
				'id_toko'=>$this->input->post('id_toko',TRUE),
				'satuan'=>$this->input->post('satuan',TRUE),
				'harga'=>$this->libku->ribuansql($this->input->post('harga',TRUE))
			);
			$this->m_daftar_harga->update(array('id_daftar_harga' => $id), $data);
			echo json_encode(array("status"=>TRUE));
		}
		else
		{
			echo json_encode(array("status"=>FALSE));	
		}
	}
	function edit($id)
	{
		$data = $this->m_daftar_harga->edit($id);
		echo json_encode($data);
	}
	function delete($id)
	{
		$this->m_daftar_harga->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
}