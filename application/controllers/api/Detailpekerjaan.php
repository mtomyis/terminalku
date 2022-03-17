<?php

   
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

     use Restserver\Libraries\REST_Controller;

class Detailpekerjaan extends REST_Controller {


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
        $section = $this->post('section');
        $idminggu = $this->post('idminggu');
        $pekerjaan = $this->post('pekerjaan');
        
         $where = array(
            'proyek' => $proyek,
            'fk_id_minggu' => $idminggu
        );

        $cek = $this->m_api->cek_data("new_bobot_uraian_kerja",$where)->num_rows();
        if($cek == 0){
            // dicek apakah data bobot uraian kerja dengan spesifikasi diatas sudah ada, jika nol maka insert data
            $this->m_api->simpanlaporan($proyek, $idminggu);
        }


        $query = $this->m_api->detailpekerjaan($proyek, $section, $idminggu, $pekerjaan);
        // $query2 = $this->m_api->detailpekerjaan2($proyek, $section, $idminggu, $pekerjaan);

        if ($query) {
            $data = array (
            "status" => "Berhasil",
            "data_detailpekerjaan" =>  $query
            );
        }
        else{
            $data = array (
            "status" => "Gagal",
            "data_detailpekerjaan" =>  $query
            );
        }
            
        $this->response($data, REST_Controller::HTTP_OK);
    }

}