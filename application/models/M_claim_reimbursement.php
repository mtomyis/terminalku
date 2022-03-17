<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_claim_reimbursement extends CI_Model 
{	
	var $table = 'claim_reimbursement';
	var $id_key = "id_claim_reimbursement";
    var $column_order = array('id_claim_reimbursement',null);
    var $column_search = array('atas_nama','uraian');
    var $order = array('id_claim_reimbursement' => 'DESC');
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
		$this->db->from($this->table);
		$this->db->where($this->id_key,$id);
		return $this->db->get()->row();
	}
	public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
	public function delete_by_id($id)
    {
        $this->db->where("id_claim_reimbursement", $id);
        $this->db->delete($this->table);
    }
	
	public function get_all()
	{
		$this->db->from($this->table);
		$this->db->order_by($this->id_key,"DESC");
		return $this->db->get()->result();
	}
	
	public function save_po($data)
	{
		$this->db->insert("reimbursement",$data);
		$insertId = $this->db->insert_id();
		$this->db->empty_table($this->table);
   		return  $insertId;
	}
	
}
?>