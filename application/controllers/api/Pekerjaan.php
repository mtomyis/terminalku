<?php

   
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

     use Restserver\Libraries\REST_Controller;

class Pekerjaan extends REST_Controller {


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
        $user = array(
            "id" => $this->post('id')
        );

        $xif = $this->db->get_where("pengguna", $user)->num_rows();
        $x = $this->db->get_where("pengguna", $user)->row();

        if ($xif == 0) {
            $this->response(array('status' => 'Gagal Mendeteksi Pengguna', 502));
        }
        elseif ($xif > 0) {
            switch ($x->posisi) {
            case "Pelaksana":
                $posisinya = "fk_id_pelaksana";
            break;
            case "Pengawas":
                $posisinya = "fk_id_pengawas";
            break;
            case "PPK":
                $posisinya = "fk_id_ppk";
            break;
            case "KPA":
                $posisinya = "fk_id_kpa";
            break;
            case "PPSPM":
                $posisinya = "fk_id_ppspm";
            break;
            case "KASUBDIT":
                $posisinya = "fk_id_kasubdit";
            break;
            default:
            }

            $user_apa = array(
                $posisinya => $x->id
            );

            $quer = $this->m_api->pekerjaan($user_apa);

                $data = array (
                "status" => "Berhasil",
                "data_proyek" =>  $quer
                );

            $this->response($data, REST_Controller::HTTP_OK);
        }

    }

}