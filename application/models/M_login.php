<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_login extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	function cek($data){
		return $this->db->get_where('pengguna',$data)->num_rows();
	}
	function cek_id($id_user,$username){
		$this->db->where('nama!=',$id_user);
		$this->db->where('email',$username);
		return $this->db->get('user')->num_rows();
	}
	function ambil_user($data)
	{
		return $this->db->get_where('pengguna',$data)->row();

		// $this->db->where('email',$user);
		// $this->db->where('email',$user);
		// return $this->db->get('pengguna')->row();
	}
	function ambil_mail($mail)
	{
		$this->db->where('email',$mail);
		return $this->db->get('user')->row();
	}
	function tampil()
	{
		return $this->db->get('user')->result();
	}
	function save($data)
	{
		$this->db->insert('user',$data);
	}
	function update($id_user,$data)
	{
		$this->db->where('id_user',$id_user);
		$this->db->update('user',$data);
	}
	function delete($id_user)
	{
		$this->db->where('id_user',$id_user);
		$this->db->delete('user');
	}
	function edit($id_user)
	{
	$this->db->where('id_user',$id_user);
		return $this->db->get('user')->row();
	}
		function edit_2($id_user)
	{
	$this->db->where('nama',$id_user);
		return $this->db->get('user')->row();
	}
	function update_2($id_user,$data)
	{
		$this->db->where('nama',$id_user);
		$this->db->update('user',$data);
	}
	
	function get_hak($id_firebase)
	{
		$this->db->select('hak,id_user');
		$this->db->where('id_firebase',$id_firebase);
		return $this->db->get('user')->row();
	}
}
/* Location: ./application/model/Administrator_model.php */