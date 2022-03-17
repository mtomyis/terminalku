<?php

   
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

     use Restserver\Libraries\REST_Controller;

class kirimlaporandokumentasi extends REST_Controller {


    public function __construct() {

       parent::__construct();

       $this->load->database();
       $this->load->library(array('template','form_validation', 'pdff', 'pdffgen'));
       $this->load->model(array('m_api', 'm_pekerjaan','m_sub_pekerjaan','m_item_pekerjaan'));

    }

    public function index_get($id = 0)

    {
    }

    public function index_post()

    {
        $idminggu = $this->post('idminggu');

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
            
        $this->pdffgen->load_view('content/pekerjaan/cetak_laporan_simanis_dokumentasi', $data);
        // $this->load->view('content/pekerjaan/cetak_laporan_simanis_dokumentasi', $data);

        $query = "SELECT pdfdokumentasi FROM new_minggu where id = '{$idminggu}'
        ";
        $daftar =  $this->db->query($query);
        if ($daftar->num_rows() > 0) {
            foreach ($daftar->result() as $row) {
                $path = './upload/laporan/';
                @unlink($path.$row->pdfdokumentasi);
            }
        }

        if ($this->db->query("UPDATE `new_minggu` SET `pdfdokumentasi`= '$namaPdf' WHERE id = $idminggu")) {
                $data = array (
                "status" => "Berhasil Membuat PDF"
                );
        }
        else{
                $data = array (
                "status" => "Gagal Membuat PDF"
                );
        }

        $this->response($data, REST_Controller::HTTP_OK);
    }

}