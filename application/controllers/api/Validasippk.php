<?php

   
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

     use Restserver\Libraries\REST_Controller;

class Validasippk extends REST_Controller {


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
        $proyek = $this->post('proyek');
        $idminggu = $this->post('idminggu');
        $ttd = $this->post('ttd');       

        $query = $this->m_api->validasi_ppk($proyek, $idminggu, $ttd);

        if ($query) {
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

            $namaPdf = "Laporan_mingguan_".$idminggu."_".date("Y_m_d_h_i_s_").time().".pdf";
            $this->pdffgen->setPaper('A4', 'landscape');
            $this->pdffgen->filename = $namaPdf;
            $this->pdffgen->load_view('content/pekerjaan/cetak_laporan_simanis', $data);

            $query = "SELECT pdf FROM new_minggu where id = '{$idminggu}'
                ";
            $daftar =  $this->db->query($query);
            if ($daftar->num_rows() > 0) {
                foreach ($daftar->result() as $row) {
                    $path = './upload/laporan/';
                    @unlink($path.$row->pdf);
                }
            }

            if ($this->db->query("UPDATE `new_minggu` SET `pdf`= '$namaPdf' WHERE id = $idminggu")) {
                
                $data = array (
                "status" => "Berhasil Mengirim Validasi"
                );
            }
            
        }else{
            $data = array (
            "status" => "Gagal Mengirim Validasi"
            );
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}