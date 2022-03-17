<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model {

    function insertRecord($record){
                    
        $proyek = $this->input->post('proyek');

        if(count($record) > 0){
            
            // Check user
            $this->db->select('*');
            $this->db->where('uraian_pekerjaan', $record[0]);
            $q = $this->db->get('new_pekerjaan');
            $response = $q->result_array();
            
            // Insert record
            // if(count($response) == 0){
            //     $newuser = array(
            //         "uraian_pekerjaan" => trim($record[0]),
            //         "section" => trim($record[1]),
            //         "pekerjaan" => trim($record[2]),
            //         "satuan" => trim($record[3]),
            //         "volume" => trim($record[4]),
            //         "harga_satuan" => trim($record[5]),
            //         "nilai" => trim($record[6]),
            //         "bobot" => trim($record[7]),
            //         $proyek
            //     );

            //     $this->db->insert('pekerjaan', $newuser);
            // }

            if(count($response) == 0){
                
            $sql = "insert into new_pekerjaan (uraian_pekerjaan, section, pekerjaan, satuan, volume, harga_satuan, nilai, bobot, proyek) values (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $this->db->query($sql,array(
                    "uraian_pekerjaan" => trim($record[0]),
                    "section" => trim($record[1]),
                    "pekerjaan" => trim($record[2]),
                    "satuan" => trim($record[3]),
                    "volume" => trim($record[4]),
                    "harga_satuan" => trim($record[5]),
                    "nilai" => trim($record[6]),
                    "bobot" => trim($record[7]),
                    $proyek
                ));
            }
        }
        
    }

}