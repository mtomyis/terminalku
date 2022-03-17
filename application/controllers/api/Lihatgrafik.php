<?php

   
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

     use Restserver\Libraries\REST_Controller;

class Lihatgrafik extends REST_Controller {


    public function __construct() {

      parent::__construct();

      $this->load->database();
       
      $this->load->model(array('m_api'));

    }

    public function index_get($id = 0)

    {
    }

    public function index_post()

    {

        $proyek = $this->post('proyek');

        $proses_pembayaran = 0;
        $total_pekerjaan = 0;
        $total_sub_pekerjaan = 0;
        $total_nilai_kontrak = 0;
        $pelaksana =  0;
        $pengawas =  0;
        $perencana =  0;
        $honorium =  0;
        $perjalanan_dinas =  0;
        $habis_pakai =  0;

        $pembayaran =  "SELECT SUM(pelaksana+pengawas+perencana+honorium+perjalanan_dinas+habis_pakai) as total_pembayaran, pelaksana, pengawas, perencana, honorium, perjalanan_dinas, habis_pakai FROM `pembayaran` WHERE proyek = '{$proyek}'";
        $query = $this->db->query($pembayaran);
        if ($query->num_rows() > 0) {
          foreach ($query->result() as $rowp) {
            $proses_pembayaran = $rowp->total_pembayaran;
            $pelaksana =  $rowp->pelaksana;
            $pengawas =  $rowp->pengawas;
            $perencana =  $rowp->perencana;
            $honorium =  $rowp->honorium;
            $perjalanan_dinas =  $rowp->perjalanan_dinas;
            $habis_pakai =  $rowp->habis_pakai;
        }}

        $pekerjaan =  "SELECT count(*) as total_pekerjaan FROM `new_pekerjaan` WHERE proyek='{$proyek}'";
        $query = $this->db->query($pekerjaan);
        if ($query->num_rows() > 0) {
          foreach ($query->result() as $rowa) {
            $total_pekerjaan = $rowa->total_pekerjaan;
        }}

        $sub_pekerjaan =  "SELECT pekerjaan FROM new_pekerjaan where proyek = '{$proyek}' GROUP BY pekerjaan ";
        $query = $this->db->query($sub_pekerjaan);
        if ($query->num_rows() > 0) {
            $total_sub_pekerjaan = $query->num_rows();
        }

        $nilai_kontrak =  "SELECT biaya_total FROM `budgeting` WHERE proyek ='{$proyek}'";
        $query = $this->db->query($nilai_kontrak);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rowk) {
                $total_nilai_kontrak = $rowk->biaya_total;
        }}

        $persentasi_proses_pembayaran = number_format(($proses_pembayaran/$total_nilai_kontrak)*100, 2);
        $total_nilai_kontrakq = "Rp. ".number_format($total_nilai_kontrak, 2,',','.');
        $total_proses_pembayaran = "Rp. ".number_format($proses_pembayaran, 2,',','.');
        
        $pelaksanaa = number_format(($pelaksana/$total_nilai_kontrak)*100, 2);
        $pengawasa = number_format(($pengawas/$total_nilai_kontrak)*100, 2);
        $perencanaa = number_format(($perencana/$total_nilai_kontrak)*100, 2);
        $honoriuma = number_format(($honorium/$total_nilai_kontrak)*100, 2);
        $perjalanan_dinasa = number_format(($perjalanan_dinas/$total_nilai_kontrak)*100, 2);
        $habis_pakaia = number_format(($habis_pakai/$total_nilai_kontrak)*100, 2);

        $a[] =array(
            "proses_pembayaran"=>$persentasi_proses_pembayaran,
            "total_pekerjaan"=>$total_pekerjaan,
            "total_sub_pekerjaan"=>$total_sub_pekerjaan,
            "total_nilai_kontrak"=>$total_nilai_kontrakq,
            "proses_pembayaran"=> $total_proses_pembayaran,
            "pelaksana" => $pelaksanaa,
            "pengawas" => $pengawasa,
            "perencana" => $perencanaa,
            "honorium"=> $honoriuma,
            "perjalanan_dinas" => $perjalanan_dinasa,
            "habis_pakai" => $habis_pakaia
            );

        // $query = $this->m_api->detailpekerjaan($proyek, $section, $idminggu, $pekerjaan);
        
        if ($query) {
            $data = array (
            "status" => "Berhasil",
            "data_grafik" =>  $a
            );
        }else{
            $data = array (
            "status" => "Gagal",
            "data_grafik" =>  $a
            );
        }
        
            

        $this->response($data, REST_Controller::HTTP_OK);
    }

}