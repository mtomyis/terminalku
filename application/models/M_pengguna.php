<?php 

class M_pengguna extends CI_Model
{
	
	function __construct()
	{
		$this->table='pengguna';

		parent::__construct();
		$this->db = $this->load->database('default', TRUE);
	}

	function get_all(){
		//fungsi ini sama dengan 'select *from tb_buku'
		return $this->db->query("SELECT * FROM `pengguna` ")->result();
	}

	public function get_proyek()
    {
        $query = " SELECT proyek FROM new_pekerjaan GROUP BY proyek
        ";
        $daftar =  $this->db->query($query)->result_array();

        return $daftar;
    }  

	function input_data($data){
		$this->db->insert($this->table, $data);
	}

	function spesifik_data($id){
		$query = $this->db->get_where($this->table, array('id' => $id));
		return $query->row();
	}

	function update_data($data, $id){
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
	}

	function update_datapdf($data, $id){
		return $this->db->query("UPDATE `pengguna` set pdf = '{$data}' WHERE id = '{$id}' ");
	}

	function hapus_data($id){
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}

}