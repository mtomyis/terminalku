<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Terminal extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('form', 'url'));
		$this->load->model(array('m_terminal'));

		$this->load->library(array('template','form_validation', 'upload'));
		if (!$this->hak->cek()){
			$this->session->sess_destroy();
			redirect(base_url());
			exit();
		}
	}

	public function index(){
	  
		$data['title'] = 'Terminal';
		$data['terminal'] = $this->m_terminal->get_all();

		$this->template->display('content/terminal/index',$data);
    }

	public function add()
	{
		$data['title'] = 'Tambah terminal';
		$this->template->display('content/terminal/add',$data);
	}

	public function save()
	{
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
        		$data['lokasi'] = $this->input->post('lokasi');
                $data['gambar'] = $foto['file_name'];
                
        		$this->m_terminal->input_data($data);
            	$data['response'] = 'Berhasil menyimpan';
            }else {
              die("Gagal menyimpan");
            }
        }else {
            $dataa['nama'] = $this->input->post('nama');
    		$dataa['lokasi'] = $this->input->post('lokasi');
            $this->m_terminal->input_data($dataa);
            $data['response'] = 'Berhasil menyimpan';

        }
		redirect('terminal/index');
	}


	public function update()
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
        		$data['lokasi'] = $this->input->post('lokasi');
                $data['gambar'] = $foto['file_name'];
                
                @unlink($path.$this->input->post('filelama'));
                
                $this->m_terminal->update_data($data, $id);
            }else {
              die("Gagal menyimpan");
            }
        }else {
            $dataa['nama'] = $this->input->post('nama');
    		$dataa['lokasi'] = $this->input->post('lokasi');
    		
    		$this->m_terminal->update_data($dataa, $id);
        }
		redirect('terminal/index');
		
	}
	
	public function edit($id)
	{
		$data['title'] = "Edit Terminal";
		$data['terminal'] = $this->m_terminal->spesifik_Data($id);

		$this->template->display('content/terminal/edit',$data);

	}

	public function hapus($id)
	{
		$this->m_terminal->hapus_data($id);
		//$this->load->view('hama/delete');
		redirect('terminal/index', 'refresh');

	}

}
 ?>