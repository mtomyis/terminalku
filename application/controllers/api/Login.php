<?php

   
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

     use Restserver\Libraries\REST_Controller;

class Login extends REST_Controller {


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
        $login = array(
            "email" => $this->post('email'),
            "password" => $this->post('password')
        );
        $cek = $this->m_api->cek($login); 
            if($cek == 1)
            {
                $x = $this->db->get_where("pengguna", $login)->row();

                $data = array (
                    "status" => "Berhasil",
                    "posisi" => $x->posisi,
                    "user" => $this->db->get_where("pengguna", $login)->row_array()
                );

                $this->response($data, REST_Controller::HTTP_OK);
            }

            else {
            $this->response(array('status' => 'Gagal Mendeteksi Pengguna', 502));
        }

    }

    	

}