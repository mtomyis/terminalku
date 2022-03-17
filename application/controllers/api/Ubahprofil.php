<?php

   
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

     use Restserver\Libraries\REST_Controller;

class Ubahprofil extends REST_Controller {


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
        $id_user = $this->post('id');
        $email = $this->post('email');
        $nama = $this->post('nama');
        $nip = $this->post('nip');

        $id = array(
            "id" => $this->post('id')
        );

        $query = $this->m_api->ubahprofil($id_user, $email, $nama, $nip);
        
        $x = $this->db->get_where("pengguna", $id)->row();

        if ($query) {
            $data = array (
            "status" => "Berhasil Update",
            "posisi" => $x->posisi,
            "user" => $this->db->get_where("pengguna", $id)->row_array()
            );
        }else{
            $data = array (
            "status" => "Gagal Update",
            "posisi" => $x->posisi,
            "user" => $this->db->get_where("pengguna", $id)->row_array()
            );
        }

        $this->response($data, REST_Controller::HTTP_OK);
    }

}