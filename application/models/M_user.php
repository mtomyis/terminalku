<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_user extends CI_Model 
{	
	var $table = 'user';
	var $id_key = "id_user";
    var $column_order = array('id_user',null);
    var $column_search = array('nama,email');
    var $order = array('id_user' => 'DESC');
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
            if($_POST['search']['value'])
            {
                if($i===0)
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if(isset($_POST['order']))
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
		$this->db->where('hak !=','0');
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
		return $this->db->insert_id();
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
	public function delete_all()
    {
        $this->db->empty_table($this->table);
    }
	public function detail($id)
    {
        $this->db->where($this->id_key, $id);
        return $this->db->get($this->table)->row();
    }
	function get_all()
	{
		$this->db->order_by('nama','ASC');
		return $this->db->get($this->table)->result();
	}
	function cek_user($user)
	{
		$this->db->where('email',$user);
		return $this->db->get($this->table)->num_rows();
	}
	
	function get_all_verifikasi_komisaris()
	{
		$this->db->where("hak","1");
		return $this->db->get('user')->result();
	}
	
	function get_all_verifikasi_admin()
	{
		$this->db->where("hak","2");
		return $this->db->get('user')->result();
	}
	
	function get_all_verifikasi_pm()
	{
		$this->db->where("hak","5");
		return $this->db->get('user')->result();
	}
	
	function get_all_verifikasi_kode($kode)
	{
		$this->db->where("hak",$kode);
		return $this->db->get('user')->result();
	}
	
	function get_all_v($ver)
	{
		$this->db->where("hak","1");
		$this->db->where("verifikator",$ver);
		return $this->db->get('user')->result();
	}
	
	function get_all_email_v()
	{
		$this->db->where('hak','1');
		return $this->db->get('user')->result();
	}
	
}
?>