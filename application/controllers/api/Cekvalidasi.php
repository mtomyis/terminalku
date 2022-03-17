<?php

   
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

     use Restserver\Libraries\REST_Controller;

class Cekvalidasi extends REST_Controller {


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
        $proyek = $this->input->post('proyek');
        $idminggu = $this->input->post('idminggu');
        $id = $this->post('id');
        $user = array(
            "id" => $id
        );

        $xif = $this->db->get_where("pengguna", $user)->num_rows();
        $x = $this->db->get_where("pengguna", $user)->row();

        switch ($x->posisi) {
            case "PPK":
                $posisinya = "fk_id_ppk";
                $status = "status_ppk";
            break;
            case "KPA":
                $posisinya = "fk_id_kpa";
                $status = "status_kpa";
            break;

            case "PPSPM":
                $posisinya = "fk_id_ppspm";
                $status = "status_ppspm";

            break;
            case "KASUBDIT":
                $posisinya = "fk_id_kasubdit";
                $status = "status_kasubdit";
            break;
            default:
        }

        $query = $this->m_api->cek_validasi_laporan($status, $proyek, $idminggu);

        if ($query) {
            $data = array (
            "status" => "Laporan tervalidasi",
            "notif" =>  $query
            );
        }else{
            $data = array (
            "status" => "Gagal Validasi",
            "notif" =>  $query
            );
        }

        $this->response($data, REST_Controller::HTTP_OK);
    }

}