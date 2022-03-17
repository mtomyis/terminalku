<?php

   
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

     use Restserver\Libraries\REST_Controller;

class Bobotminggu extends REST_Controller {


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
        $idminggu = $this->post('idminggu');
        $minggu = $this->post('minggu');

        $totalminggulalu = 0;
        $totalmingguini = 0;
        $totalsdmingguini = 0;

        if ($minggu=="minggu ke- 1") {
            $totalminggulalu = 0;
        } elseif ($minggu!=="minggu ke- 1"){
            $idm = $idminggu-1;

            $minggulalulka =  "SELECT  SUM(bobot_akhir) as totalbobot FROM new_bobot_uraian_kerja JOIN new_pekerjaan ON new_pekerjaan.id = new_bobot_uraian_kerja.fk_id_new_pekerjaan WHERE new_bobot_uraian_kerja.fk_id_minggu = {$idm} AND new_pekerjaan.proyek = '{$proyek}'";
            $query = $this->db->query($minggulalulka);
            if ($query->num_rows() > 0) {
              foreach ($query->result() as $rowp) {
                $totalminggulalu = number_format($rowp->totalbobot, 3,',','.');
            }}
        }

        $mingguinia =  "SELECT  SUM(bobot_detail) as detailbobot FROM new_bobot_uraian_kerja JOIN new_pekerjaan ON new_pekerjaan.id = new_bobot_uraian_kerja.fk_id_new_pekerjaan WHERE new_bobot_uraian_kerja.fk_id_minggu = {$idminggu} AND new_pekerjaan.proyek = '{$proyek}'";
            $query = $this->db->query($mingguinia);
            if ($query->num_rows() > 0) {
              foreach ($query->result() as $rowa) {
                $totalmingguini = number_format($rowa->detailbobot, 3,',','.');
            }}

            $minggu_sdinia =  "SELECT SUM(bobot_detail) as bobotsdminggu FROM `new_bobot_uraian_kerja`JOIN new_pekerjaan ON new_pekerjaan.id = new_bobot_uraian_kerja.fk_id_new_pekerjaan WHERE fk_id_minggu <= {$idminggu} AND new_pekerjaan.proyek= '{$proyek}'";
            $query = $this->db->query($minggu_sdinia);
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $rowk) {
                    $totalsdmingguini = number_format($rowk->bobotsdminggu, 3,',','.');
              }}

        $a[] =array("minggu_lalu"=>$totalminggulalu,"minggu_ini"=>$totalmingguini, "sd_minggu_ini"=>$totalsdmingguini);

        // $query = $this->m_api->detailpekerjaan($proyek, $section, $idminggu, $pekerjaan);

            $data = array (
            "status" => "Berhasil",
            "data_total_bobot" =>  $a
            );

        $this->response($data, REST_Controller::HTTP_OK);
    }

}