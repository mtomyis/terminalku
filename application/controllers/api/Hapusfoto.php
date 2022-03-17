<?php

   
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

     use Restserver\Libraries\REST_Controller;

class Hapusfoto extends REST_Controller {


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

        $query = $this->m_api->hapusfoto($id);

        if ($query) {
            $data = array (
            "status" => "Berhasil Menghapus"
            );
        }else{
            $data = array (
            "status" => "Gagal Menghapus"
            );
        }

        $this->response($data, REST_Controller::HTTP_OK);
    }

}