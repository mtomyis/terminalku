<?php

   
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

     use Restserver\Libraries\REST_Controller;

class Subpekerjaan extends REST_Controller {


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

        $query = $this->m_api->subpekerjaan($section, $proyek);

            $data = array (
            "status" => "Berhasil",
            "data_subpekerjaan" =>  $query
            );

        $this->response($data, REST_Controller::HTTP_OK);
    }

}