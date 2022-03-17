<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Karyawan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(array('m_karyawan'));
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
		$this->template->display('content/karyawan/data',$data);
	}
	public function ajax_list()
    {
		$list = $this->m_karyawan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $d) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $d->nama;
			$row[] = $d->email;
			$row[] = $d->no_telpn;
			$row[] = $d->alamat;
			$row[] = '<div class="aksi">

						<a href="javascript:void(0)" title="Delete" onclick="delete_data('."'".$d->id_karyawan."'".')">

							<span class="nav-icon"><i class="delete-icon"></i></span>

						</a>

             			<a href="javascript:void(0)" onclick="edit('."'".$d->id_karyawan."'".')">

							<span class="nav-icon"><i class="edit-icon"></i></span>

						</a>

					  </div>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_karyawan->count_all(),
			"recordsFiltered" => $this->m_karyawan->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
    }
	function save()
	{
		$this->form_validation->set_rules('nama','nama','required');
		if($this->form_validation->run() != false)
		{
			$dt = array(
				'nama' => $this->input->post('nama',TRUE),
				'email' => $this->input->post('email',TRUE),
				'no_telpn' => $this->input->post('no_telpn',TRUE),
				'alamat' => $this->input->post('alamat',TRUE),
			);
			$this->m_karyawan->save($dt);
			echo json_encode(array("status"=>TRUE));
		}
		else
		{
			echo json_encode(array("status"=>FALSE));	
		}
	}
	
	function update($id)
	{
		$this->form_validation->set_rules('nama','nama','required');
		if($this->form_validation->run() != false)
		{
			$data = array(
				'nama' => $this->input->post('nama',TRUE),
				'email' => $this->input->post('email',TRUE),
				'no_telpn' => $this->input->post('no_telpn',TRUE),
				'alamat' => $this->input->post('alamat',TRUE),
			);
			$this->m_karyawan->update(array('id_karyawan' => $id), $data);
			echo json_encode(array("status"=>TRUE));
		}
		else
		{
			echo json_encode(array("status"=>FALSE));	
		}
	}

	function edit($id)
	{
		$data = $this->m_karyawan->edit($id);
		echo json_encode($data);

	}
	
	function delete()
	{
		$id = $this->input->post('id');
		$this->m_karyawan->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
}