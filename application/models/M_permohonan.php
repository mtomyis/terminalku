<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_permohonan extends CI_Model 
{	
	var $table = 'permohonan';
	var $id_key = "id_permohonan";
    var $column_order = array('id_permohonan',null);
    var $column_search = array('a.tanggal_permohonan');
    var $order = array('id_permohonan' => 'DESC');
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	private function _get_datatables_query()
    {
		$this->db->from($this->table.' a');
		$this->db->join('item_pekerjaan b','a.id_item_pekerjaan = b.id_item_pekerjaan');
		$this->db->join('sub_pekerjaan c','b.id_sub_pekerjaan = c.id_sub_pekerjaan');
		$this->db->join('pekerjaan d','d.id_pekerjaan = b.id_pekerjaan');
		$this->db->join('user e','a.pemohon = e.id_user');
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
		$hak = $this->session->userdata('hak');
		$id_user= $this->session->userdata('id_user');
		if($hak != "1")
		{
			$this->db->where('a.pemohon',$id_user);
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
		$this->db->order_by('nama_barang','ASC');
		return $this->db->get($this->table)->result();
	}
	
	function save_tanda_tangan($data)
	{
		$this->db->insert('ttd_permohonan',$data);
	}
}
?>