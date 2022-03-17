<?php

   
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

     use Restserver\Libraries\REST_Controller;

class Kirimlaporan extends REST_Controller {


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
        $statusku = "";
        $apakah_sudah = "";
        
        $proyek = $this->post('proyek');
        $idminggu = $this->post('idminggu');
        $ttd = $this->post('ttd');
        
        $pro = "SELECT status_pengawas FROM `new_minggu` WHERE id = '$idminggu' ";
        $sanaa =  $this->db->query($pro);
        if ($sanaa->num_rows() > 0) {
            foreach ($sanaa->result() as $row) {
                $statusku = $row->status_pengawas;
        }}
        
        if($statusku == 3){
            $query = $this->m_api->kirim_laporan_revisi($proyek, $idminggu, $ttd);
            if($query){
               $apakah_sudah = "sudah";
            }else{
                $apakah_sudah = "belum terinput";
            }
        }else{
            $query = $this->m_api->kirim_laporan($proyek, $idminggu, $ttd);
            if($query){
                $apakah_sudah = "belum";
                            
            }else{
                $apakah_sudah = "belum terinput";
            }
        }

        if ($apakah_sudah == "belum") {

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

            // ini dihapus dulu yg dulu 51detik ada efek nyabiar tidak bosen
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

                // $iniminggu = $this->m_api->mingguke($idminggu);
                // $pengguna = $this->m_api->detailpengguna($iniminggu->proyek);
                // $detailproyek = $this->m_api->detailproyek($iniminggu->proyek);

                // $date=date_create($iniminggu->tgl_awal);
                // $tglawal = date_format($date,"d F Y");
                
                // $date=date_create($iniminggu->tgl_akhir);
                // $tglakhir = date_format($date,"d F Y");
                
                // $data['periode'] = $tglawal." - ".$tglakhir;
                // $data['proyek'] = $iniminggu->proyek;
                // $data['minggu'] = $iniminggu->minggu;
                // $data['lokasi'] = $detailproyek->lokasi;
                // $data['anggaran'] = $detailproyek->thn_anggaran;
                // $data['unitkerja'] = $detailproyek->unitkerja;
                // $data['pengawas'] = $detailproyek->pengawas;
                // $data['logo'] = $pengguna->logopengawas;
                // $data['pengawas'] = $pengguna->pengawas;
                // $data['section0'] = $this->m_api->section0dokumentasi($iniminggu->proyek);
                // $data['idminggu'] = $idminggu;
                
                // $namaPdf = "Laporan_dokumentasi_mingguan_".date("Y_m_d_h_i_s_").time().".pdf";
                // $this->pdffgen->setPaper('A4', 'portrait');
                // $this->pdffgen->filename = $namaPdf;
                // $this->pdffgen->load_view('content/pekerjaan/cetak_laporan_simanis_dokumentasi', $data);

                // $query = "SELECT pdfdokumentasi FROM new_minggu where id = '{$idminggu}'
                // ";
                // $daftar =  $this->db->query($query);
                // if ($daftar->num_rows() > 0) {
                //     foreach ($daftar->result() as $row) {
                //         $path = './upload/laporan/';
                //         @unlink($path.$row->pdfdokumentasi);
                //     }
                // }
                // if ($this->db->query("UPDATE `new_minggu` SET `pdfdokumentasi`= '$namaPdfdokumentasi' WHERE id = '$idminggu'")) {
                    $dataku = array (
                    "status" => "Berhasil Terkirim"
                );
                // }else{
                //     $data = array (
                //     "status" => "Gagal Menyimpan PDF Dokumentasi"
                //     ); 
                // }
            }
            else{
                $data = array (
                "status" => "Gagal Menyimpan PDF"
                );
            }
            
        }elseif($apakah_sudah == "belum terinput"){
            $data = array (
            "status" => "Gagal Mengirim"
            );
        }elseif($apakah_sudah == "sudah"){

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

            $this->db->query("UPDATE `new_minggu` SET `pdf`= '$namaPdf' WHERE id = $idminggu");

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
                "status" => "Berhasil mengirim revisi"
                );
            }
            else{
                $data = array (
                "status" => "Gagal mengirim revisi"
                );
            }
        }

                $this->response($dataku, REST_Controller::HTTP_OK);

        
    }

}