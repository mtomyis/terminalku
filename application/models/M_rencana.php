<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_rencana extends CI_Model 
{	
	var $table = 'rencana_po';
	var $id_key = "a.id_rencana_po";
    var $column_order = array('a.id_rencana_po',null);
    var $column_search = array('e.nama_toko','f.nama_barang');
    var $order = array('a.id_rencana_po' => 'DESC');
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	private function _get_datatables_query()
    {
		$this->db->from($this->table.' a');
		$this->db->join('item_pekerjaan b','a.id_item_pekerjaan = b.id_item_pekerjaan');
		$this->db->join('pekerjaan c','c.id_pekerjaan = b.id_pekerjaan');
		$this->db->join('sub_pekerjaan d','d.id_sub_pekerjaan = b.id_sub_pekerjaan');
		$this->db->join('toko e','e.id_toko = a.id_toko');
		$this->db->join('daftar_harga f','f.id_daftar_harga = a.id_barang');
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
		$this->db->order_by($this->id_key,"DESC");
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
		$this->db->from($this->table.' a');
		$this->db->join('item_pekerjaan b','a.id_item_pekerjaan = b.id_item_pekerjaan');
		$this->db->join('pekerjaan c','c.id_pekerjaan = b.id_pekerjaan');
		$this->db->join('sub_pekerjaan d','d.id_sub_pekerjaan = b.id_sub_pekerjaan');
		$this->db->join('toko e','e.id_toko = a.id_toko');
		$this->db->join('daftar_harga f','f.id_daftar_harga = a.id_barang');
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
        $this->db->where("id_rencana_po", $id);
        $this->db->delete($this->table);
    }
	
	public function get_all()
	{
		$this->db->from($this->table.' a');
		$this->db->join('item_pekerjaan b','a.id_item_pekerjaan = b.id_item_pekerjaan');
		$this->db->join('pekerjaan c','c.id_pekerjaan = b.id_pekerjaan');
		$this->db->join('sub_pekerjaan d','d.id_sub_pekerjaan = b.id_sub_pekerjaan');
		$this->db->join('toko e','e.id_toko = a.id_toko');
		$this->db->join('daftar_harga f','f.id_daftar_harga = a.id_barang');
		$this->db->order_by('d.no_refrensi','ASC');
		$this->db->order_by('f.nama_barang','ASC');
		return $this->db->get()->result();
	}
	
	public function save_po($data)
	{
		$this->db->insert("purchase_order",$data);
		$insertId = $this->db->insert_id();
		$this->db->empty_table($this->table);
   		return  $insertId;
	}
	
}
?>