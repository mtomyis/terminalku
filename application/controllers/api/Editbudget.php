<?php

   
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

     use Restserver\Libraries\REST_Controller;

class Editbudget extends REST_Controller {


    public function __construct() {

       parent::__construct();

       $this->load->database();
       $this->load->model(array('m_api'));

    //   $this->load->model(array('m_api','m_pekerjaan'));

    }

    public function index_get($id = 0)

    {
    }

    public function index_post()

    {
        $id = $this->post('id');
        $tgl = $this->post('tgl');
        $kepada = $this->post('kepada');
        $rincian = $this->post('rincian');
        $nilai = $this->post('nilai');
        $surat = $this->post('surat');
        
//         $id = $this->post('id');
// 		$data['tanggal'] = $this->post('tgl');
// 		$data['kategori'] = $this->post('kepada');
// 		$data['rincian'] = $this->post('rincian');
// 		$data['nilai'] = $this->post('nilai');
// 		$data['surat'] = $this->post('surat');

// 		$this->m_pekerjaan->new_new_update_history_budget($data, $id)

        $query = $this->m_api->ubahbudget($id, $tgl, $kepada, $rincian, $nilai, $surat);

        if ($query) {
            $data = array (
            "status" => "Berhasil Update"
            );
        }else{
            $data = array (
            "status" => "Gagal Update"
            );
        }

        $this->response($data, REST_Controller::HTTP_OK);
    }

}