<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Kpa extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('form', 'url'));
		$this->load->model(array('m_api', 'm_pengguna', 'm_pekerjaan', 'm_terminal'));
		$this->load->library(array('template'));
		if (!$this->hak->cek()){
			$this->session->sess_destroy();
			redirect(base_url());
			exit();
		}
	}

    public function home(){
        $data['title'] = 'Dashboard';

        // SELECT new_pekerjaan_detail.proyek as proyek, budgeting.biaya_total, terminal.nama FROM `new_pekerjaan_detail` JOIN terminal ON new_pekerjaan_detail.fk_id_terminal = terminal.id JOIN budgeting ON budgeting.proyek = new_pekerjaan_detail.proyek

        

        // $data['budgeting'] = $query;

        $this->template->display('content/kpa/home', $data);
    }

	public function pilih_terminal(){
        $data['title'] = 'Pilih Terminal';
        $data['terminal'] = $this->m_terminal->get_all();

        $this->template->display('content/kpa/pilih_terminal',$data);
    }
    
    public function pilih_terminal_ppk(){
        $data['title'] = 'Pilih Terminal';
        $data['terminal'] = $this->m_terminal->get_all();

        $this->template->display('content/kpa/pilih_terminal_ppk',$data);
    }

    public function index($fk_id_terminal)
    {
        $data['title'] = 'Beranda';
        // ambil nama proyek dulu
        $proyek = $this->m_pekerjaan->ambilnamaproyek($fk_id_terminal);
        $data['proyek'] = $proyek->proyek;

        // ambil id minggu
        $dataminggu = $this->m_pekerjaan->ambilminggu($proyek->proyek);
        $data['idminggul'] = $dataminggu->id;
        $data['minggu'] = $dataminggu->minggu;
        $data['pdfdokumentasi'] = $dataminggu->pdfdokumentasi;

        $data['datarencanaa'] = $this->m_pekerjaan->lihatbobotrencana($proyek->proyek);
        $data['datarealisasia'] = $this->m_pekerjaan->lihatbobotrealisasi($proyek->proyek);
        $data['dataminggua'] = $this->m_pekerjaan->lihatgrafikminggu($proyek->proyek);

        $pelaksana_asli = 0;
        $pelaksana =  0;

        $pembayaran =  "SELECT pelaksana, pengawas, perencana, honorium, perjalanan_dinas, habis_pakai FROM `pembayaran` WHERE proyek = '{$proyek->proyek}'";
        $query = $this->db->query($pembayaran);
        if ($query->num_rows() > 0) {
          foreach ($query->result() as $rowp) {
            $pelaksana =  $rowp->pelaksana;
        }}
        
        $pembayaran =  "SELECT pelaksana, pengawas, perencana FROM `budgeting_kontruksi` WHERE proyek = '{$proyek->proyek}'";
        $query = $this->db->query($pembayaran);
        if ($query->num_rows() > 0) {
          foreach ($query->result() as $rowp) {
            $pelaksana_asli =  $rowp->pelaksana;
        }}

        $persen_pelaksana = number_format(($pelaksana/$pelaksana_asli)*100, 2);
        $rp_pelaksana = "Rp. ".number_format($pelaksana, 2,',','.');
        $rp_kurang_pelaksana = "Rp. ".number_format(($pelaksana_asli-$pelaksana), 2,',','.');
        $rp_asli_pelaksana = "Rp. ".number_format($pelaksana_asli, 2,',','.');

        $persen_kekurangan = (100 - $persen_pelaksana);
        $rp_total = "Rp. ".number_format($pelaksana, 2,',','.');
        $rp_asli_total = "Rp. ".number_format($pelaksana_asli, 2,',','.');
        $rp_kurang_total = "Rp. ".number_format( ($pelaksana_asli-$pelaksana), 2,',','.');

        $data['persen_pelaksana'] = $persen_pelaksana;
        $data['persen_kekurangan'] = $persen_kekurangan;
        $data['rp_pelaksana'] = $rp_pelaksana;
        $data['rp_total']=  $rp_total;
        $data['rp_asli_pelaksana'] = $rp_asli_pelaksana;
        $data['rp_asli_total'] = $rp_asli_total;
        $data['rp_kurang_pelaksana'] = $rp_kurang_pelaksana;
        $data['rp_kurang_total'] = $rp_kurang_total;

        $this->template->display('content/kpa/laporan_kpa',$data);
    }

    public function profil($id){

        $data['title'] = "Edit Pengguna";
        $data['pengguna'] = $this->m_pengguna->spesifik_Data($id);

        $this->template->display('content/kpa/profil', $data);
    }

    public function update_profil()
    {
        $id = $this->input->post('id');
        $path = './upload/logo/';
        
        $config['upload_path'] = './upload/logo';
        $config['allowed_types'] = 'jpg|png|jpeg|gif';
        // $config['max_size'] = '2048';  //2MB max
        // $config['max_width'] = '4480'; // pixel
        // $config['max_height'] = '4480'; // pixel
        $config['file_name'] = $_FILES['fotopost']['name'];
        
        $this->upload->initialize($config);
        
        if (!empty($_FILES['fotopost']['name'])) {
            if ( $this->upload->do_upload('fotopost') ) {
                $foto = $this->upload->data();
                $data['nama'] = $this->input->post('nama');
                $data['nip'] = $this->input->post('nip');
                $data['password'] = $this->input->post('password');
                $data['email'] = $this->input->post('email');
                $data['logopengawas'] = $foto['file_name'];
                
                @unlink($path.$this->input->post('filelama'));
                
                $this->m_pengguna->update_data($data, $id);
            }else {
              die("Gagal menyimpan");
            }
        }else {
            $dataa['nama'] = $this->input->post('nama');
            $dataa['nip'] = $this->input->post('nip');
            $dataa['password'] = $this->input->post('password');
            $dataa['email'] = $this->input->post('email');
            
            $this->m_pengguna->update_data($dataa, $id);
        }
        redirect('kpa/home');
    }

}
 ?>