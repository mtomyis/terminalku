<?php

   
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

     use Restserver\Libraries\REST_Controller;

class Uploaddokumentasi extends REST_Controller {


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
        $image = base64_decode($this->input->post("poto"));

        $image_name = md5(uniqid(rand(), true));
        $filename = $image_name . '.' . 'jpg';

        // $image_name = time();
        // $filename = $image_name . '.' . 'png';
        //rename file name with random number
        $path = "./upload/dokumentasi/".$filename;
        //image uploading folder path
        $success = file_put_contents($path .$filename, $image);

        if ($success) {
            $data = array (
            "status" => $filename.$filename
            );
        }else{
            $data = array (
            "status" => "Gagal"
            );
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

}