<?php

   
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

     use Restserver\Libraries\REST_Controller;

class Simpandatavolume extends REST_Controller {


    public function __construct() {

       parent::__construct();

       $this->load->database();
       
       $this->load->model(array('m_api','m_pekerjaan'));

    }

    public function index_get($id = 0)

    {
    }

    public function index_post()

    {
        // $iduraian = $this->input->post('iduraian');
        // $volume = $this->input->post('datavolume');
        // $volumeasli = $this->input->post('datavolumeasli');
        // $bobotasli = $this->input->post('databobotasli');
        // $keterangan = $this->input->post('dataketerangan');
        // $idminggu = $this->input->post('idminggu');
        // $proyek = $this->input->post('dataproyek');
        // $minggu = $this->input->post('datamingguke');

        // $volumelalu=0;
        // $bobotsdminggu_ini=0;
        // $bobotminggu_ini=0;
        // $volumesdminggu_ini=0;
        $maka = 0;
        // $databobot =0;
        // $datavolume =0;

        // if ($minggu=="minggu ke- 1") {
        //     $volumelalu = 0;
        // } 
        // elseif ($minggu!=="minggu ke- 1"){
        //     $idm = $idminggu-1;
        //     $minggulalu =  "SELECT * FROM `new_bobot_uraian_kerja` WHERE fk_id_minggu = '$idm' AND fk_id_new_pekerjaan = '{$iduraian}' AND proyek = '{$proyek}'";
        //     $query = $this->db->query($minggulalu);
        //     if ($query->num_rows() > 0) {
        //       foreach ($query->result() as $rowy) {
        //         $volumelalu = $rowy->volume_akhir;
        //       }}
        // }

        // $volumesdminggu_ini = $volume+$volumelalu;

        // if ($volumesdminggu_ini > $volumeasli) {
        //     $maka = 0;
        // }
        // elseif ($volumesdminggu_ini <= $volumeasli){

        // $bobotminggu_ini = ($volume/$volumeasli)*$bobotasli;
        // $bobotsdminggu_ini = ($volumesdminggu_ini/$volumeasli)*$bobotasli;

        // $query="UPDATE `new_bobot_uraian_kerja` SET  `volume_detail`= '{$volume}',  `bobot_detail`= '{$bobotminggu_ini}' ,`keterangan`= '{$keterangan}', `volume_akhir`= '{$volumesdminggu_ini}',  `bobot_akhir`= '{$bobotsdminggu_ini}' WHERE fk_id_new_pekerjaan = '{$iduraian}' AND proyek = '{$proyek}' AND fk_id_minggu = {$idminggu}";

        // $daftar2 =  $this->db->query($query);
        
        // if($daftar2){
        //     $quer =  "SELECT SUM(volume_akhir) as volume_total, SUM(bobot_akhir) as bobot_total FROM `new_bobot_uraian_kerja` WHERE fk_id_minggu = $idminggu AND proyek = '{$proyek}'";
        //     $query = $this->db->query($quer);
        //     if ($query->num_rows() > 0) {
        //         foreach ($query->result() as $row) {
        //             $databobot = $row->bobot_total;
        //             $datavolume = $row->volume_total;
        //         }
        //     }
    
        //     $querys="UPDATE new_minggu SET volume_total = $datavolume, bobot_total = $databobot WHERE id = {$idminggu}";
    
        //     $daftar1 =  $this->db->query($querys);
        //     if($daftar1){
        //         $maka = 1;
        //     }else{
        //         $maka = 0;
        //     }
        // }
        // else{
        //     $maka = 0;
        // }

        // }
        
        $iduraian = $this->input->post('iduraian');
        $volume = $this->input->post('datavolume');
        $volumeasli = $this->input->post('datavolumeasli');
        $bobotasli = $this->input->post('databobotasli');
        $keterangan = $this->input->post('dataketerangan');
        $idminggu = $this->input->post('idminggu');
        $proyek = $this->input->post('dataproyek');
        $minggu = $this->input->post('datamingguke');
        
        // $iduraian = "730";
        // $volume = "1";
        // $volumeasli = "286.5";
        // $bobotasli = "1.6262";
        // $keterangan = "";
        // $idminggu = "75";
        // $proyek = "Pembangunan  Sarana Dan Prasarana Air Bersih Ikk Srono";
        // $minggu = "minggu ke- 3";

        $volumelalu=0;
        $bobotsdminggu_ini=0;
        $bobotminggu_ini=0;
        $volumesdminggu_ini=0;

        if ($minggu=="minggu ke- 1") {
            $volumelalu = 0;
        }
        elseif ($minggu!=="minggu ke- 1"){
            $idm = $idminggu-1;
            $minggulalu =  "SELECT * FROM `new_bobot_uraian_kerja` WHERE fk_id_minggu = '$idm' AND fk_id_new_pekerjaan = '{$iduraian}' AND proyek = '{$proyek}'";
            $query = $this->db->query($minggulalu);
            if ($query->num_rows() > 0) {
              foreach ($query->result() as $rowy) {
                $volumelalu = $rowy->volume_akhir;
              }}
        }

        $volumesdminggu_ini = $volume+$volumelalu;

        // jika volume melebihi volume asli, maka gagal meyimpan
        if ($volumesdminggu_ini > $volumeasli) {
            $maka = 0;
        }
        elseif ($volumesdminggu_ini <= $volumeasli){

        $bobotminggu_ini = ($volume/$volumeasli)*$bobotasli;
        $bobotsdminggu_ini = ($volumesdminggu_ini/$volumeasli)*$bobotasli;

        $query="UPDATE `new_bobot_uraian_kerja` SET  `volume_detail`= '{$volume}',  `bobot_detail`= '{$bobotminggu_ini}' ,`keterangan`= '{$keterangan}', `volume_akhir`= '{$volumesdminggu_ini}',  `bobot_akhir`= '{$bobotsdminggu_ini}' WHERE fk_id_new_pekerjaan = '{$iduraian}' AND fk_id_minggu = {$idminggu}";

        // $query="UPDATE `new_bobot_uraian_kerja` SET  `volume_detail`= '3',  `bobot_detail`= '0.017028272251309' ,`keterangan`= '{$keterangan}', `volume_akhir`= '272',  `bobot_akhir`= '1.5438966841187' WHERE fk_id_new_pekerjaan = '730' AND fk_id_minggu = 75";

        $daftar2 =  $this->db->query($query);

        // __________________________________________simpan ke uraian detail
        $querya="SELECT SUM(volume_akhir) as volume_total, SUM(bobot_akhir) as bobot_total FROM `new_bobot_uraian_kerja` WHERE fk_id_minggu = {$idminggu}";

        $daftar =  $this->db->query($querya)->row();

        // // __________________________________________simpan ke mingguan total
        $databobot = $daftar->bobot_total;
        $datavolume = $daftar->volume_total;

        $querys="UPDATE `new_minggu` SET `volume_total`= {$datavolume},`bobot_total`= {$databobot} WHERE id = {$idminggu}";

        $daftar1 =  $this->db->query($querys);
        $maka = 1;
        
        if ($maka == 1) {
            $data = array (
            "status" => "Berhasil Tersimpan"
            );
        }else{
            $data = array (
            "status" => "Gagal Menyimpan"
            );
        }
        $this->response($data, REST_Controller::HTTP_OK);
        
        }

        

        
    }

}