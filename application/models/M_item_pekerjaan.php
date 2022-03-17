<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_item_pekerjaan extends CI_Model 
{	
	var $table = 'item_pekerjaan';
	var $id_key = "id_item_pekerjaan";
	var $id_key_where = "id_sub_pekerjaan";
    var $column_order = array('id_item_pekerjaan',null);
    var $column_search = array('nama_item_pekerjaan','no_refrensi_item_pekerjaan');
    var $order = array('id_item_pekerjaan' => 'DESC');
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	private function _get_datatables_query($id)
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
		$this->db->where($this->id_key_where,$id);
		$this->db->order_by('no_refrensi_item_pekerjaan','ASC');
    }
	 function get_datatables($id)
    {
        $this->_get_datatables_query($id);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered($id)
    {
        $this->_get_datatables_query($id);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all($id)
    {
        $this->db->from($this->table);
		$this->db->where($this->id_key_where,$id);
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
	public function delete_sub($id)
    {
        $this->db->where($this->id_key_where, $id);
        $this->db->delete($this->table);
    }
	public function delete($id)
    {
        $this->db->where("id_pekerjaan", $id);
        $this->db->delete($this->table);
    }
	public function get_all_id($id)
	{
		$this->db->where($this->id_key_where,$id);
		$this->db->order_by('nama_item_pekerjaan','ASC');
		return $this->db->get($this->table)->result();
	}
	
	private function _get_datatables_query_pekerjaan($id){
		$this->db->select('id_item_pekerjaan,nama_item_pekerjaan');
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
		$this->db->where($this->id_key_where,$id);
		$this->db->order_by('no_refrensi_item_pekerjaan','ASC');
    }
	function get_datatables_pekerjaan($limit,$ke,$id){
		$start = (intval($ke)-1) * intval($limit);
		$this->_get_datatables_query_pekerjaan($id);
        $this->db->limit(intval($limit), $start);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_pekerjaan($id){
        $this->_get_datatables_query_pekerjaan($id);
        $query = $this->db->get();
        return $query->num_rows();
    }
	
	function get_detail($id)
	{
		$this->db->from($this->table.' a');
		$this->db->join('sub_pekerjaan b','a.id_sub_pekerjaan = b.id_sub_pekerjaan');
		$this->db->join('pekerjaan c','a.id_pekerjaan = c.id_pekerjaan');
		$this->db->where($this->id_key,$id);
		return $this->db->get()->row();
	}
}
?>