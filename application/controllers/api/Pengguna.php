<?php

   
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

     use Restserver\Libraries\REST_Controller;

class Pengguna extends REST_Controller {


    public function __construct() {

       parent::__construct();

       $this->load->database();

    }

	public function index_get($id = 0)

	{

        if(!empty($id)){

            $data = $this->db->get_where("pengguna", ['id' => $id])->row_array();

        }else{

            $data = $this->db->get("pengguna")->result();

        }

        $this->response($data, REST_Controller::HTTP_OK);

	}

    public function index_post()

    {

        $input = $this->input->post();

        $this->db->insert('pengguna',$input);

        $this->response(['Item created successfully.'], REST_Controller::HTTP_OK);

    } 

    public function index_put($id)

    {

        $input = $this->put();

        $this->db->update('pengguna', $input, array('id'=>$id));

        $this->response(['Item updated successfully.'], REST_Controller::HTTP_OK);

    }

    public function index_delete($id)

    {

        $this->db->delete('pengguna', array('id'=>$id));
        $this->response(['Item deleted successfully.'], REST_Controller::HTTP_OK);

    }

    	

}