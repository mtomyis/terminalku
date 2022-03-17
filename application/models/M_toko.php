<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_toko extends CI_Model 
{	
	var $table = 'toko';
	var $id_key = "id_toko";
    var $column_order = array('id_toko',null);
    var $column_search = array('nama_toko');
    var $order = array('id_toko' => 'DESC');
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	private function _get_datatables_query()
    {
		$this->db->from($this->table);
        $i = 0;
       foreach ($this->column_search as $item)
       {
           if($_POST['cari'])
           {
               if($i===0)
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['cari']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['cari']);
                }
                if(count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
    }
	 function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
	public function save($data)
	{
		$this->db->insert($this->table,$data);
	}
	public function edit($id)
	{
		$this->db->where($this->id_key,$id);
		return $this->db->get($this->table)->row();
	}
	public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
	public function delete_by_id($id)
    {
        $this->db->where($this->id_key, $id);
        $this->db->delete($this->table);
    }
	
	public function get_all()
	{
		$this->db->order_by('nama_toko','ASC');
		return $this->db->get($this->table)->result();
	}
	

	
	private function _get_datatables_query_pekerjaan(){
		$this->db->select('id_toko,nama_toko');
		$this->db->from($this->table);
		$i = 0;
       	foreach ($this->column_search as $item)
       	{
           if($_POST['cari'])
           {
               if($i===0)
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['cari']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['cari']);
                }
                if(count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
		$this->db->order_by('nama_toko','ASC');
    }
	function get_datatables_pekerjaan($limit,$ke){
		$start = (intval($ke)-1) * intval($limit);
		$this->_get_datatables_query_pekerjaan();
        $this->db->limit(intval($limit), $start);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_pekerjaan(){
        $this->_get_datatables_query_pekerjaan();
        $query = $this->db->get();
        return $query->num_rows();
    }
	
}
?>