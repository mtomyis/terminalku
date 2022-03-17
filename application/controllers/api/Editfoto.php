<?php

   
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

     use Restserver\Libraries\REST_Controller;

class Editfoto extends REST_Controller {


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
        $foto = $this->post('foto');

        $query = $this->m_api->ubahfoto($id, $foto);

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