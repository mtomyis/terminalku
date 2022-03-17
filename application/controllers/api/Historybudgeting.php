<?php

   
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

     use Restserver\Libraries\REST_Controller;

class Historybudgeting extends REST_Controller {


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
        
        $query = $this->m_api->lihat_historypembayaran($proyek);
        
        if ($query) {
            $data = array (
            "status" => "Berhasil",
            "data_history" =>  $query
            );
        }else{
            $data = array (
            "status" => "Gagal",
            "data_history" =>  $query
            );
        }
        
        $proyek = array(
            "proyek" => $this->post('proyek')
        );

        // $this->db->select('*');
        // $x= $this->db->get_where('pembayaran_history',$proyek)->result();

        // // if ($quer->num_rows() == 0) {
        // //     $this->response(array('status' => 'Gagal Mendeteksi Pengguna', 502));
        // // }
        // // else{
        //     $data = array (
        //     "status" => "Berhasil",
        //     "data_history" =>  $x
        //     );

        $this->response($data, REST_Controller::HTTP_OK);
        // }

    }	

}