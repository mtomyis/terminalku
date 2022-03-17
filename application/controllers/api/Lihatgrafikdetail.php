<?php

   
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

     use Restserver\Libraries\REST_Controller;

class Lihatgrafikdetail extends REST_Controller {


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
        
        
        $pelaksana_asli = 0;
        $pengawas_asli = 0;
        $perencana_asli = 0;
        $honorium_asli = 0;
        $perjalanan_dinas_asli =  0;
        $habis_pakai_asli =  0;
        
        $pelaksana =  0;
        $pengawas =  0;
        $perencana =  0;
        $honorium =  0;
        $perjalanan_dinas =  0;
        $habis_pakai =  0;

        $pembayaran =  "SELECT pelaksana, pengawas, perencana, honorium, perjalanan_dinas, habis_pakai FROM `pembayaran` WHERE proyek = '{$proyek}'";
        $query = $this->db->query($pembayaran);
        if ($query->num_rows() > 0) {
          foreach ($query->result() as $rowp) {
            $pelaksana =  $rowp->pelaksana;
            $pengawas =  $rowp->pengawas;
            $perencana =  $rowp->perencana;
            $honorium =  $rowp->honorium;
            $perjalanan_dinas =  $rowp->perjalanan_dinas;
            $habis_pakai =  $rowp->habis_pakai;
        }}
        
        $pembayaran =  "SELECT pelaksana, pengawas, perencana FROM `budgeting_kontruksi` WHERE proyek = '{$proyek}'";
        $query = $this->db->query($pembayaran);
        if ($query->num_rows() > 0) {
          foreach ($query->result() as $rowp) {
            $pelaksana_asli =  $rowp->pelaksana;
            $pengawas_asli =  $rowp->pengawas;
            $perencana_asli =  $rowp->perencana;
        }}
        
        $pembayaran =  "SELECT biaya_honorium, biaya_perjalanan, biaya_habis_pakai FROM `budgeting` WHERE proyek = '{$proyek}'";
        $query = $this->db->query($pembayaran);
        if ($query->num_rows() > 0) {
          foreach ($query->result() as $rowp) {
            $honorium_asli =  $rowp->biaya_honorium;
            $perjalanan_dinas_asli =  $rowp->biaya_perjalanan;
            $habis_pakai_asli =  $rowp->biaya_habis_pakai;
        }}
        
        
        $persen_pelaksana = number_format(($pelaksana/$pelaksana_asli)*100, 2);
        $persen_perencana = number_format(($perencana/$perencana_asli)*100, 2);
        $persen_pengawas = number_format(($pengawas/$pengawas_asli)*100, 2);
        $persen_honorium = number_format(($honorium/$honorium_asli)*100, 2);
        $persen_perjalanan = number_format(($perjalanan_dinas/$perjalanan_dinas_asli)*100, 2);
        $persen_habis = number_format(($habis_pakai/$habis_pakai_asli)*100, 2);
        
        $rp_pelaksana = "Rp. ".number_format($pelaksana, 2,',','.');
        $rp_perencana = "Rp. ".number_format($perencana, 2,',','.');
        $rp_pengawas = "Rp. ".number_format($pengawas, 2,',','.');
        $rp_honorium = "Rp. ".number_format($honorium, 2,',','.');
        $rp_perjalanan = "Rp. ".number_format($perjalanan_dinas, 2,',','.');
        $rp_habis = "Rp. ".number_format($habis_pakai, 2,',','.');
        
        $rp_kurang_pelaksana = "Rp. ".number_format(($pelaksana_asli-$pelaksana), 2,',','.');
        $rp_kurang_perencana = "Rp. ".number_format(($perencana_asli-$perencana), 2,',','.');
        $rp_kurang_pengawas = "Rp. ".number_format(($pengawas_asli-$pengawas), 2,',','.');
        $rp_kurang_honorium = "Rp. ".number_format(($honorium_asli-$honorium), 2,',','.');
        $rp_kurang_perjalanan = "Rp. ".number_format(($perjalanan_dinas_asli-$perjalanan_dinas), 2,',','.');
        $rp_kurang_habis = "Rp. ".number_format(($habis_pakai_asli-$habis_pakai), 2,',','.');
        
        $rp_asli_pelaksana = "Rp. ".number_format($pelaksana_asli, 2,',','.');
        $rp_asli_perencana = "Rp. ".number_format($perencana_asli, 2,',','.');
        $rp_asli_pengawas = "Rp. ".number_format($pengawas_asli, 2,',','.');
        $rp_asli_honorium = "Rp. ".number_format($honorium_asli, 2,',','.');
        $rp_asli_perjalanan = "Rp. ".number_format($perjalanan_dinas_asli, 2,',','.');
        $rp_asli_habis = "Rp. ".number_format($habis_pakai_asli, 2,',','.');

        $a[] =array(
            "persen_pelaksana"=>$persen_pelaksana,
            "persen_perencana"=>$persen_perencana,
            "persen_pengawas"=>$persen_pengawas,
            "persen_honorium"=>$persen_honorium,
            "persen_perjalanan"=> $persen_perjalanan,
            "persen_habis" => $persen_habis,
            "rp_pelaksana" => $rp_pelaksana,
            "rp_perencana" => $rp_perencana,
            "rp_pengawas"=> $rp_pengawas,
            "rp_honorium" => $rp_honorium,
            "rp_perjalanan" => $rp_perjalanan,
            "rp_habis"=> $rp_habis,
            "rp_asli_pelaksana" => $rp_asli_pelaksana,
            "rp_asli_perencana" => $rp_asli_perencana,
            "rp_asli_pengawas" => $rp_asli_pengawas,
            "rp_asli_honorium"=> $rp_asli_honorium,
            "rp_asli_perjalanan" => $rp_asli_perjalanan,
            "rp_asli_habis" => $rp_asli_habis,
            "rp_kurang_pelaksana" => $rp_kurang_pelaksana,
            "rp_kurang_perencana" => $rp_kurang_perencana,
            "rp_kurang_pengawas" => $rp_kurang_pengawas,
            "rp_kurang_honorium"=> $rp_kurang_honorium,
            "rp_kurang_perjalanan" => $rp_kurang_perjalanan,
            "rp_kurang_habis" => $rp_kurang_habis
            );
        
        if ($query) {
            $data = array (
            "status" => "Berhasil",
            "data_grafik_detail" =>  $a
            );
        }else{
            $data = array (
            "status" => "Gagal",
            "data_grafik_detail" =>  $a
            );
        }
        
            

        $this->response($data, REST_Controller::HTTP_OK);
    }

}