<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Pengguna extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
 		$this->load->helper(array('form', 'url'));
		$this->load->model(array('m_pengguna', 'm_pekerjaan'));

		$this->load->helper('url');
		$this->load->library(array('template','form_validation', 'pdffgen'));
		if (!$this->hak->cek()){
			$this->session->sess_destroy();
			redirect(base_url());
			exit();
		}
	}

	public function index(){
	  
		$data['title'] = 'Pengguna';
		$data['pengguna'] = $this->m_pengguna->get_all();

		$this->template->display('content/pengguna/index',$data);
    }

	public function add()
	{
		$data['title'] = 'Tambah pengguna';
		$data['proyek'] = $this->m_pengguna->get_proyek();
		$this->template->display('content/pengguna/add',$data);
	}

	public function save()
	{
        $config['upload_path'] = './upload/logo';
        $config['allowed_types'] = 'jpg|png|jpeg|gif';
        $config['max_size'] = '2048';  //2MB max
        $config['max_width'] = '4480'; // pixel
        $config['max_height'] = '4480'; // pixel
        $config['file_name'] = $_FILES['fotopost']['name'];
        
        $this->upload->initialize($config);
        
        if (!empty($_FILES['fotopost']['name'])) {
            if ( $this->upload->do_upload('fotopost') ) {
                $foto = $this->upload->data();
                $data['nama'] = $this->input->post('nama');
        		$data['nip'] = $this->input->post('nip');
        		$data['password'] = $this->input->post('password');
        		$data['email'] = $this->input->post('email');
        		$data['posisi'] = $this->input->post('posisi');
        		$data['pengawas'] = $this->input->post('pengawas');
                $data['logopengawas'] = $foto['file_name'];
                
        		$this->m_pengguna->input_data($data);
            }else {
              die("Gagal menyimpan");
            }
        }else {
            $dataa['nama'] = $this->input->post('nama');
    		$dataa['nip'] = $this->input->post('nip');
    		$dataa['password'] = $this->input->post('password');
    		$dataa['email'] = $this->input->post('email');
    		$dataa['posisi'] = $this->input->post('posisi');
    		$dataa['pengawas'] = $this->input->post('pengawas');
            $this->m_pengguna->input_data($dataa);
        }
		redirect('pengguna/add');
	}


	public function update()
	{
	    $id = $this->input->post('id');
	    $path = './upload/logo/';
	    
	    $config['upload_path'] = './upload/logo';
        $config['allowed_types'] = 'jpg|png|jpeg|gif';
        $config['max_size'] = '2048';  //2MB max
        $config['max_width'] = '4480'; // pixel
        $config['max_height'] = '4480'; // pixel
        $config['file_name'] = $_FILES['fotopost']['name'];
        
        $this->upload->initialize($config);
        
        if (!empty($_FILES['fotopost']['name'])) {
            if ( $this->upload->do_upload('fotopost') ) {
                $foto = $this->upload->data();
                $data['nama'] = $this->input->post('nama');
        		$data['nip'] = $this->input->post('nip');
        		$data['password'] = $this->input->post('password');
        		$data['email'] = $this->input->post('email');
        		$data['posisi'] = $this->input->post('posisi');
        		$data['pengawas'] = $this->input->post('pengawas');
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
    		$dataa['posisi'] = $this->input->post('posisi');
    		$dataa['pengawas'] = $this->input->post('pengawas');
    		
    		$this->m_pengguna->update_data($dataa, $id);
        }
		redirect('pengguna/index');
		
	}
	
	public function edit($id)
	{
		$data['title'] = "Edit Pengguna";
		$data['pengguna'] = $this->m_pengguna->spesifik_Data($id);
		$data['proyek'] = $this->m_pengguna->get_proyek();

		$this->template->display('content/pengguna/edit',$data);

	}

	public function hapus($id)
	{
		$this->m_pengguna->hapus_data($id);
		//$this->load->view('hama/delete');
		redirect('pengguna/index', 'refresh');

	}

	public function pdf($id)
	{
		$x = $this->m_pengguna->spesifik_Data($id);
		$proyek = $x->proyek;

		$data['proyek'] = $proyek;
		$data['title'] = 'Pekerjaan';
		$data['section0'] = $this->m_pekerjaan->section0($proyek);
	    $data['tandatangandireksi'] = $this->m_pekerjaan->tandatangandireksi($proyek);
	    $data['tandatanganpelaksana'] = $this->m_pekerjaan->tandatanganpelaksana($proyek);
		# code...
		$this->pdffgen->setPaper('A4', 'potrait');
		$namapdf = 'laporan_'.date('YmdHis').".pdf";
	    $this->pdffgen->filename = $namapdf;
		$this->pdffgen->load_view('content/pekerjaan/laporan', $data, $namapdf);

	    $this->m_pengguna->update_datapdf($namapdf, $id);

		// $pss = $x->posisi;
		// if ($pss=="Direksi / Pengawas") {
		// 	$this->pdffgen->load_view('content/pekerjaan/laporandireksi', $data);
		// }
		// else {
		// 	$this->pdffgen->load_view('content/pekerjaan/laporanpelaksana', $data);
		// }
		return redirect('pengguna/index', 'refresh');
	    // $this->pdffgen->setPaper('A4', 'potrait');
	    // $this->pdffgen->load_view('content/pekerjaan/laporan', $data);
		# code...

	}

}
 ?>