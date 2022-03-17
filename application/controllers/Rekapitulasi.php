<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekapitulasi extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(array('m_po','m_reimbursement'));
		$this->load->library(array('template','libku','cetak'));
		if (!$this->hak->cek()){
			$this->session->sess_destroy();
			redirect(base_url());
			exit();
		}
		date_default_timezone_set('Asia/Jakarta');
    }

	public function order_material(){
		$data['title'] = 'Rekap Order Material';
		$this->template->display('content/transaksi/rekap_order_material',$data);
	}
	
	
	public function reimbursement(){
		$data['title'] = 'Reimbursement';
		$this->template->display('content/transaksi/rekap_reimbursement',$data);
	}
	function get_data_po()
	{
		$this->form_validation->set_rules('tanggal_awal','tanggal_awal','required');
		$this->form_validation->set_rules('tanggal_akhir','tanggal_akhir','required');
		if($this->form_validation->run() != false)
		{
			$tanggal_awal = $this->libku->tgl_mysql($this->input->post('tanggal_awal',TRUE));
			$tanggal_akhir = $this->libku->tgl_mysql($this->input->post('tanggal_akhir',TRUE));
			$data['isi'] = $this->cetak->rekap_order_material($tanggal_awal,$tanggal_akhir);
			$data['status'] = TRUE;
			echo json_encode($data);
		}
	}
	
	function get_data_reimbursement()
	{
		$this->form_validation->set_rules('tanggal_awal','tanggal_awal','required');
		$this->form_validation->set_rules('tanggal_akhir','tanggal_akhir','required');
		if($this->form_validation->run() != false)
		{
			$tanggal_awal = $this->libku->tgl_mysql($this->input->post('tanggal_awal',TRUE));
			$tanggal_akhir = $this->libku->tgl_mysql($this->input->post('tanggal_akhir',TRUE));
			$data['isi'] = $this->cetak->rekap_reimbursement($tanggal_awal,$tanggal_akhir);
			$data['status'] = TRUE;
			echo json_encode($data);
		}
	}
}
