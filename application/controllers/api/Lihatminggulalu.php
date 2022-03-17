<?php

   
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

     use Restserver\Libraries\REST_Controller;

class Lihatminggulalu extends REST_Controller {


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
        $idkerja = $this->post('idkerja');
        $idminggu = $this->post('idminggu');
        // $proyek = $this->post('proyek');

        $query = $this->m_api->detailpekerjaanminggulalu($idkerja, $idminggu);
        // $query2 = $this->m_api->detailpekerjaan2($proyek, $section, $idminggu, $pekerjaan);

        if ($query) {
            $data = array (
            "status" => "Berhasil",
            "data_detailpekerjaanlalu" =>  $query
            // ,
            // "data_detailpekerjaan2" =>  $query2
            );
        }
        // else{
        //     $data = array (
        //     "status" => "Gagal",
        //     "data_detailpekerjaan" =>  $query,
        //     "data_detailpekerjaan2" =>  $query2

        //     );
        // }
            
        $this->response($data, REST_Controller::HTTP_OK);
    }

}

// if ($minggu=="minggu ke- 1") {
// 	echo "0";
// 	} elseif ($minggu!=="minggu ke- 1"){
// 		$idm = $idminggul-1;
// 		$minggulalu =  "SELECT * FROM `new_bobot_uraian_kerja` WHERE fk_id_minggu = '$idm' AND fk_id_new_pekerjaan = '$row->idkerja' AND proyek = '{$proyek}'";
// 		$query = $this->db->query($minggulalu);
// 		if ($query->num_rows() > 0) {
// 		foreach ($query->result() as $royw) {
// 		echo number_format($royw->volume_akhir,3,',','.');
// }}