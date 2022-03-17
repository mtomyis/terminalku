<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coba extends CI_Controller {
	 public function __construct(){
		 parent::__construct();
		 // load base_url
	    $this->load->helper('url');
 		$this->load->helper(array('form', 'url'));

	    // Load Model
	    $this->load->model('Main_model');
		$this->load->library(array('template','form_validation', 'pdff', 'pdffgen'));
		$this->load->model(array('m_api','m_pekerjaan','m_sub_pekerjaan','m_item_pekerjaan'));
    }
	function cobapdf($idminggu)
	{
	    
// 		$proyek = "Pembangunan  Sarana Dan Prasarana Air Bersih Ikk Srono";
        // $idminggu = "75";
//         $ttd = "dff1f4fa6af63681fa2affc40945fd1c.png";

//         $query = $this->m_api->kirim_laporan($proyek, $idminggu, $ttd);

        $iniminggu = $this->m_api->mingguke($idminggu);
        
        $date=date_create($iniminggu->tgl_awal);
        $tglawal = date_format($date,"d F Y");
        
        $date=date_create($iniminggu->tgl_akhir);
        $tglakhir = date_format($date,"d F Y");
        
        $date=date_create($iniminggu->tanggal_laporan);
        $tanggallaporan = date_format($date,"d F Y");

        $data['idminggul'] = $idminggu;
        $data['periode'] = $tglawal." - ".$tglakhir;
        $data['proyek'] = $iniminggu->proyek;
        $data['minggu'] = $iniminggu->minggu;
        $data['tanggal_laporan'] = $tanggallaporan;
        $data['section0'] = $this->m_api->section0($iniminggu->proyek);
        $data['data_ppk'] = $this->m_api->datappk($iniminggu->proyek);
        $data['data_pengawas'] = $this->m_api->datapengawas($iniminggu->proyek);

        $data['ttd'] = $this->m_api->data_ttd($idminggu);

        $namaPdf = "Laporan_mingguan_".date("Y_m_d_h_i_s_").time().".pdf";

        $this->pdff->setPaper('A4', 'landscape');
	    $this->pdff->filename = $namaPdf;

        // $query = $this->m_api->kirim_laporan($proyek, $idminggu, $ttd);
	    
        $this->pdff->load_view('content/pekerjaan/cetak_laporan_simanis', $data);
	}
	
	function pdfdokumentasi($idminggu)
	{
        $iniminggu = $this->m_api->mingguke($idminggu);
        
        $pengguna = $this->m_api->detailpengguna($iniminggu->proyek);
        
        $detailproyek = $this->m_api->detailproyek($iniminggu->proyek);
        
        $date=date_create($iniminggu->tgl_awal);
        $tglawal = date_format($date,"d F Y");
        
        $date=date_create($iniminggu->tgl_akhir);
        $tglakhir = date_format($date,"d F Y");
        
        $data['periode'] = $tglawal." - ".$tglakhir;
        $data['proyek'] = $iniminggu->proyek;
        $data['minggu'] = $iniminggu->minggu;
        $data['lokasi'] = $detailproyek->lokasi;
        $data['anggaran'] = $detailproyek->thn_anggaran;
        $data['unitkerja'] = $detailproyek->unitkerja;
        $data['pengawas'] = $detailproyek->pengawas;
        $data['logo'] = $pengguna->logopengawas;
        $data['pengawas'] = $pengguna->pengawas;
        $data['section0'] = $this->m_api->section0dokumentasi($idminggu);
        $data['idminggu'] = $idminggu;
        
        $namaPdf = "Laporan_dokumentasi_mingguan_".date("Y_m_d_h_i_s_").time().".pdf";

        $this->pdffgen->setPaper('A4', 'portrait');
        // $this->pdff->setPaper('A4', 'landscape');
	    $this->pdffgen->filename = $namaPdf;
	    
        // $this->pdffgen->load_view('content/pekerjaan/cetak_laporan_simanis_dokumentasi', $data);
        $this->load->view('content/pekerjaan/cetak_laporan_simanis_dokumentasi', $data);
	}

    function grafik($id)
    {
        $iniminggu = $this->m_api->pekerjaandetail($id);

        $data['datarencanaa'] = $this->m_pekerjaan->lihatbobotrencana($iniminggu->proyek);
        $data['datarealisasia'] = $this->m_pekerjaan->lihatbobotrealisasi($iniminggu->proyek);
        $data['dataminggua'] = $this->m_pekerjaan->lihatgrafikminggu($iniminggu->proyek);

        $this->load->view('content/pekerjaan/cetak_grafik_simanis', $data);
        // $this->load->view('content/pekerjaan/mencobagrafik', $data);

    }
}
