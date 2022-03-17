<?php

Class Model_select extends CI_Model
{

function __construct(){

parent::__construct();

}


function provinsi(){


// $this->db->order_by('proyek','ASC');
// $provinces= $this->db->get('new_pekerjaan');


// return $provinces->result_array();
 $query = "  SELECT proyek FROM new_pekerjaan GROUP BY proyek
        ";
        $daftar =  $this->db->query($query)->result_array();

        return $daftar;

}


function kabupaten($provId){

$kabupaten="<option value='0'>--pilih--</pilih>";

$this->db->order_by('id','ASC');
$kab= $this->db->get_where('new_minggu_dephub',array('proyek'=>$provId));

foreach ($kab->result_array() as $data ){
$kabupaten.= "<option value='$data[id]'>$data[minggu] ($data[tgl_awal] - $data[tgl_akhir])</option>";
}

return $kabupaten;

}

function kecamatan($kabId){
$kecamatan="<option value='0'>--pilih--</pilih>";

$this->db->order_by('id','ASC');
$kec= $this->db->get_where('new_pekerjaan_dephub',array('pekerjaan'=>$kabId));

foreach ($kec->result_array() as $data ){
$kecamatan.= "<option value='$data[uraian_subpekerjaan]'>$data[uraian_subpekerjaan]</option>";
}

return $kecamatan;
}

function kelurahan($kecId){

$kel= $this->db->get_where('daftar_harga',array('id_daftar_harga'=>$kecId));

foreach ($kel->result_array() as $data ){
$kelurahan.= "<option value='$data[harga]'>$data[harga]</option>";
}

return $kelurahan;
}

function mingguke($proyek){

$this->db->order_by('id','ASC');
$this->db->group_by('minggu');
$kel= $this->db->get_where('new_minggu_dephub',array('proyek'=>$proyek));

foreach ($kel->result_array() as $data ){
$mingguke.= "<option value='$data[minggu]'>$data[minggu]</option>";
}

return $mingguke;
}

}