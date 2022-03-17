<?php

   
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

     use Restserver\Libraries\REST_Controller;

class Kirimuangupdate extends REST_Controller {


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
        $proyek = $this->post('id');
        $kategori = $this->post('kategori');
        $uang = $this->post('uang');
        $rincian = $this->post('rincian');
        $surat = $this->post('surat');
        
        // ini nanti diganti post,tgl saja
        // $tanggal = $this->post('tanggal');
        $tanggal = date("Y-m-d");
        
        $uang_asli = "";
        $uang_now = "";
        $lebih = "";
        
        if($kategori == "pelaksana"){
            $pro = "SELECT pelaksana FROM `budgeting_kontruksi` WHERE proyek = '$proyek' ";
            $sanaa =  $this->db->query($pro);
            if ($sanaa->num_rows() > 0) {
                foreach ($sanaa->result() as $row) {
                    $uang_asli = $row->pelaksana;
                    
                    $pro = "SELECT pelaksana FROM `pembayaran` WHERE proyek = '$proyek' ";
                    $sanaa =  $this->db->query($pro);
                    if ($sanaa->num_rows() > 0) {
                        foreach ($sanaa->result() as $row) {
                            $uang_now = $row->pelaksana + $uang;
                            
                            if($uang_now > $uang_asli){
                                $lebih = "sudah";
                            }else{
                                $lebih = "belum";
                            }
                    }}
            }}
        }
        elseif($kategori == "pengawas"){
            $pro = "SELECT pengawas FROM `budgeting_kontruksi` WHERE proyek = '$proyek' ";
            $sanaa =  $this->db->query($pro);
            if ($sanaa->num_rows() > 0) {
                foreach ($sanaa->result() as $row) {
                    $uang_asli = $row->pengawas;
                    
                    $pro = "SELECT pengawas FROM `pembayaran` WHERE proyek = '$proyek' ";
                    $sanaa =  $this->db->query($pro);
                    if ($sanaa->num_rows() > 0) {
                        foreach ($sanaa->result() as $row) {
                            $uang_now = $row->pengawas + $uang;
                            
                            if($uang_now > $uang_asli){
                                $lebih = "sudah";
                            }else{
                                $lebih = "belum";
                            }
                    }}
            }}
        }
        elseif($kategori == "perencana"){
            $pro = "SELECT perencana FROM `budgeting_kontruksi` WHERE proyek = '$proyek' ";
            $sanaa =  $this->db->query($pro);
            if ($sanaa->num_rows() > 0) {
                foreach ($sanaa->result() as $row) {
                    $uang_asli = $row->perencana;
                    
                    $pro = "SELECT perencana FROM `pembayaran` WHERE proyek = '$proyek' ";
                    $sanaa =  $this->db->query($pro);
                    if ($sanaa->num_rows() > 0) {
                        foreach ($sanaa->result() as $row) {
                            $uang_now = $row->perencana + $uang;
                            
                            if($uang_now > $uang_asli){
                                $lebih = "sudah";
                            }else{
                                $lebih = "belum";
                            }
                    }}
            }}
        }
        elseif($kategori == "honorium"){
            $pro = "SELECT biaya_honorium FROM `budgeting` WHERE proyek = '$proyek' ";
            $sanaa =  $this->db->query($pro);
            if ($sanaa->num_rows() > 0) {
                foreach ($sanaa->result() as $row) {
                    $uang_asli = $row->biaya_honorium;
                    
                    $pro = "SELECT honorium FROM `pembayaran` WHERE proyek = '$proyek' ";
                    $sanaa =  $this->db->query($pro);
                    if ($sanaa->num_rows() > 0) {
                        foreach ($sanaa->result() as $row) {
                            $uang_now = $row->honorium + $uang;
                            
                            if($uang_now > $uang_asli){
                                $lebih = "sudah";
                            }else{
                                $lebih = "belum";
                            }
                    }}
            }}
        }
        elseif($kategori == "perjalanan_dinas"){
            $pro = "SELECT biaya_perjalanan FROM `budgeting` WHERE proyek = '$proyek' ";
            $sanaa =  $this->db->query($pro);
            if ($sanaa->num_rows() > 0) {
                foreach ($sanaa->result() as $row) {
                    $uang_asli = $row->biaya_perjalanan;
                    
                    $pro = "SELECT perjalanan_dinas FROM `pembayaran` WHERE proyek = '$proyek' ";
                    $sanaa =  $this->db->query($pro);
                    if ($sanaa->num_rows() > 0) {
                        foreach ($sanaa->result() as $row) {
                            $uang_now = $row->perjalanan_dinas + $uang;
                            
                            if($uang_now > $uang_asli){
                                $lebih = "sudah";
                            }else{
                                $lebih = "belum";
                            }
                    }}
            }}
        }
        elseif($kategori == "habis_pakai"){
            $pro = "SELECT biaya_habis_pakai FROM `budgeting` WHERE proyek = '$proyek' ";
            $sanaa =  $this->db->query($pro);
            if ($sanaa->num_rows() > 0) {
                foreach ($sanaa->result() as $row) {
                    $uang_asli = $row->biaya_habis_pakai;
                    
                    $pro = "SELECT habis_pakai FROM `pembayaran` WHERE proyek = '$proyek' ";
                    $sanaa =  $this->db->query($pro);
                    if ($sanaa->num_rows() > 0) {
                        foreach ($sanaa->result() as $row) {
                            $uang_now = $row->habis_pakai + $uang;
                            
                            if($uang_now > $uang_asli){
                                $lebih = "sudah";
                            }else{
                                $lebih = "belum";
                            }
                    }}
            }}
        }
        
        if($lebih == "belum"){
            $sanaa = $this->m_api->kirim_uang($proyek, $kategori, $uang, $rincian, $surat, $tanggal);
            if ($sanaa) {
                $data = array (
                "status" => "Berhasil"
            );
            }else{
                $data = array (
                "status" => "Gagal menyimpan"
                );
            }
        }elseif($lebih == "sudah"){
            $data = array (
            "status" => "Gagal, Nilai melebihi batas budget"
            );
        }else{
            $data = array (
            "status" => "Gagal"
            );
        }
        
        $this->response($data, REST_Controller::HTTP_OK);
    }

}