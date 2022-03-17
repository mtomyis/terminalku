<?php

   
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

     use Restserver\Libraries\REST_Controller;

class Kirimuang extends REST_Controller {


    public function __construct() {

       parent::__construct();

       $this->load->database();
       $this->load->library('upload');
       
       $this->load->model(array('m_api'));

    }

    public function index_get($id = 0)

    {
    }

    public function index_post()

    {
        $hasil = 0;

        // $proyek = $this->post('id');
        // $kategori = $this->post('kategori');
        // $uang = $this->post('uang');
        // $rincian = $this->post('rincian');

        // $proyek = "0";
        // $kategori = "0";
        // $uang = "0";
        // $rincian = "0";

        $config['upload_path'] = './upload/surat';
        $config['allowed_types'] = 'pdf';

        $new_name = date("Y_m_d_h_i_s_").time().".pdf";
        $config['file_name'] = $new_name;

        // $config['file_name'] = $_FILES['file']['name'];

        $this->upload->initialize($config);

        if (!empty($_FILES['file']['name'])) {
            if ($this->upload->do_upload('file') ) {
                $foto = $this->upload->data();
                // $surat = $foto['file_name'];
                // $query = $this->m_api->kirim_uang($proyek, $kategori, $uang, $rincian, $new_name);
                $hasil = 1;
            }else {
                $hasil = 0;
            }
        }else {
            $hasil = 0;
        }

        if ($hasil = 1) {
            $data = array (
            "status" => $new_name
            );
        }else{
            $data = array (
            "status" => "Gagal"
            );
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}