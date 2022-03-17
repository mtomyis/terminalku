<?php

   
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

     use Restserver\Libraries\REST_Controller;

class Lihatfoto extends REST_Controller {


    public function __construct() {

       parent::__construct();

       $this->load->database();
       $this->load->library(array('template','form_validation', 'pdff', 'pdffgen'));
       $this->load->model(array('m_api', 'm_pekerjaan','m_sub_pekerjaan','m_item_pekerjaan'));

    }

    public function index_get($id = 0)

    {
    }

    public function index_post()

    {
        $subpekerjaan = $this->post('subpekerjaan');
        $section = $this->post('section');
        $idminggu = $this->post('idminggu');
        
        $query = $this->m_api->lihatdokumentasi($subpekerjaan, $section, $idminggu);
        
        if($query){
            $data = array (
            "status" => "Berhasil",
            "datafoto" => $query
            );
        }else{
            $data = array (
            "status" => "Gagal"
            );
        }

        $this->response($data, REST_Controller::HTTP_OK);
    }

}