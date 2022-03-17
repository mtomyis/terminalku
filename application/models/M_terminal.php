<?php 

class M_terminal extends CI_Model
{
	
	function __construct()
	{
		$this->table='terminal';

		parent::__construct();
		$this->db = $this->load->database('default', TRUE);
	}

	function get_all(){
		//fungsi ini sama dengan 'select *from tb_buku'
		return $this->db->query("SELECT * FROM `terminal` ")->result();
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

	function hapus_data($id){
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}

}