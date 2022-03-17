<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Keuangan extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
 		$this->load->helper(array('form', 'url'));
		$this->load->model(array('m_api', 'm_pengguna', 'm_pekerjaan'));
		$this->load->library(array('template'));
		if (!$this->hak->cek()){
			$this->session->sess_destroy();
			redirect(base_url());
			exit();
		}
	}

	public function pilih_proyek(){

		$user = array(

            "id" => $this->session->userdata('id')
        );

        $xif = $this->db->get_where("pengguna", $user)->num_rows();
        $x = $this->db->get_where("pengguna", $user)->row();

        if ($xif > 0) {
            switch ($x->posisi) {
	            case "Pelaksana":
	                $posisinya = "fk_id_pelaksana";
	            break;
	            case "Pengawas":
	                $posisinya = "fk_id_pengawas";
	            break;
	            case "PPK":
	                $posisinya = "fk_id_ppk";
	            break;
	            case "KPA":
	                $posisinya = "fk_id_kpa";
	            break;
	            case "PPSPM":
	                $posisinya = "fk_id_ppspm";
	            break;
	            case "KASUBDIT":
	                $posisinya = "fk_id_kasubdit";
	            break;
	            default:
            }

            $user_apa = array(
                $posisinya => $x->id
            );

            $quer = $this->m_api->pekerjaan($user_apa);

        }
	  
		$data['title'] = 'Keuangan';
		$data['data'] = $quer;

		$this->template->display('content/keuangan/pilih_proyek',$data);
    }

	public function add()
	{
		$data['title'] = 'Keuangan';
		$data['proyek'] = $this->input->post('proyek');

		$this->template->display('content/keuangan/add',$data);
	}

	public function save()
	{
        $config['upload_path'] = './upload/surat';
        $config['allowed_types'] = 'pdf';
        
        $surat = date("Y_m_d_h_i_s_").time().".pdf";
        $config['file_name'] = $surat;

        $proyek = $this->input->post('proyek');
        // $kategori = $this->input->post('kategori');
        $kategori = 'pelaksana';

        // dd($kategori);
        $uang = $this->input->post('uang');
        $rincian = $this->input->post('rincian');
        $tanggal = $this->input->post('tanggal');
        
        $uang_asli = "";
        $uang_now = "";
        $lebih = "";
        
        if($kategori == "pelaksana"){
            $pro = "SELECT pelaksana FROM `budgeting_kontruksi` WHERE proyek = '$proyek' ";
            $sanaa =  $this->db->query($pro);
            if ($sanaa->num_rows() > 0) {
                foreach ($sanaa->result() as $row) {
                    $uang_asli = $row->pelaksana;
                    
                    $pro = "SELECT pelaksana FROM `pembayaran` WHERE proyek = '$proyek' ";
                    $sanaa =  $this->db->query($pro);
                    if ($sanaa->num_rows() > 0) {
                        foreach ($sanaa->result() as $row) {
                            $uang_now = $row->pelaksana + $uang;
                            
                            if($uang_now > $uang_asli){
                                $lebih = "sudah";
                            }else{
                                $lebih = "belum";
                            }
                    }}
            }}
        }
        elseif($kategori == "pengawas"){
            $pro = "SELECT pengawas FROM `budgeting_kontruksi` WHERE proyek = '$proyek' ";
            $sanaa =  $this->db->query($pro);
            if ($sanaa->num_rows() > 0) {
                foreach ($sanaa->result() as $row) {
                    $uang_asli = $row->pengawas;
                    
                    $pro = "SELECT pengawas FROM `pembayaran` WHERE proyek = '$proyek' ";
                    $sanaa =  $this->db->query($pro);
                    if ($sanaa->num_rows() > 0) {
                        foreach ($sanaa->result() as $row) {
                            $uang_now = $row->pengawas + $uang;
                            
                            if($uang_now > $uang_asli){
                                $lebih = "sudah";
                            }else{
                                $lebih = "belum";
                            }
                    }}
            }}
        }
        elseif($kategori == "perencana"){
            $pro = "SELECT perencana FROM `budgeting_kontruksi` WHERE proyek = '$proyek' ";
            $sanaa =  $this->db->query($pro);
            if ($sanaa->num_rows() > 0) {
                foreach ($sanaa->result() as $row) {
                    $uang_asli = $row->perencana;
                    
                    $pro = "SELECT perencana FROM `pembayaran` WHERE proyek = '$proyek' ";
                    $sanaa =  $this->db->query($pro);
                    if ($sanaa->num_rows() > 0) {
                        foreach ($sanaa->result() as $row) {
                            $uang_now = $row->perencana + $uang;
                            
                            if($uang_now > $uang_asli){
                                $lebih = "sudah";
                            }else{
                                $lebih = "belum";
                            }
                    }}
            }}
        }
        elseif($kategori == "honorium"){
            $pro = "SELECT biaya_honorium FROM `budgeting` WHERE proyek = '$proyek' ";
            $sanaa =  $this->db->query($pro);
            if ($sanaa->num_rows() > 0) {
                foreach ($sanaa->result() as $row) {
                    $uang_asli = $row->biaya_honorium;
                    
                    $pro = "SELECT honorium FROM `pembayaran` WHERE proyek = '$proyek' ";
                    $sanaa =  $this->db->query($pro);
                    if ($sanaa->num_rows() > 0) {
                        foreach ($sanaa->result() as $row) {
                            $uang_now = $row->honorium + $uang;
                            
                            if($uang_now > $uang_asli){
                                $lebih = "sudah";
                            }else{
                                $lebih = "belum";
                            }
                    }}
            }}
        }
        elseif($kategori == "perjalanan_dinas"){
            $pro = "SELECT biaya_perjalanan FROM `budgeting` WHERE proyek = '$proyek' ";
            $sanaa =  $this->db->query($pro);
            if ($sanaa->num_rows() > 0) {
                foreach ($sanaa->result() as $row) {
                    $uang_asli = $row->biaya_perjalanan;
                    
                    $pro = "SELECT perjalanan_dinas FROM `pembayaran` WHERE proyek = '$proyek' ";
                    $sanaa =  $this->db->query($pro);
                    if ($sanaa->num_rows() > 0) {
                        foreach ($sanaa->result() as $row) {
                            $uang_now = $row->perjalanan_dinas + $uang;
                            
                            if($uang_now > $uang_asli){
                                $lebih = "sudah";
                            }else{
                                $lebih = "belum";
                            }
                    }}
            }}
        }
        elseif($kategori == "habis_pakai"){
            $pro = "SELECT biaya_habis_pakai FROM `budgeting` WHERE proyek = '$proyek' ";
            $sanaa =  $this->db->query($pro);
            if ($sanaa->num_rows() > 0) {
                foreach ($sanaa->result() as $row) {
                    $uang_asli = $row->biaya_habis_pakai;
                    
                    $pro = "SELECT habis_pakai FROM `pembayaran` WHERE proyek = '$proyek' ";
                    $sanaa =  $this->db->query($pro);
                    if ($sanaa->num_rows() > 0) {
                        foreach ($sanaa->result() as $row) {
                            $uang_now = $row->habis_pakai + $uang;
                            
                            if($uang_now > $uang_asli){
                                $lebih = "sudah";
                            }else{
                                $lebih = "belum";
                            }
                    }}
            }}
        }
        
        if($lebih == "belum"){
        	$this->upload->initialize($config);
			$this->upload->do_upload('surat');
            $this->upload->data();

            $sanaa = $this->m_api->kirim_uang($proyek, $kategori, $uang, $rincian, $surat, $tanggal);
            if ($sanaa) {
				$data['response'] = 'Berhasil tersimpan';
				$data['proyek'] = $this->input->post('proyek');
            }else{
                $data['response'] = 'Data gagal menyimpan. '.$this->upload->display_errors();
				$data['proyek'] = $this->input->post('proyek');
            }
        }elseif($lebih == "sudah"){
            $data['response'] = 'Gagal, Nilai melebihi batas budget. '.$this->upload->display_errors();
			$data['proyek'] = $this->input->post('proyek');
        }else{
        	$data['response'] = 'Gagal menyimpan. '.$this->upload->display_errors();
			$data['proyek'] = $this->input->post('proyek');
        }
        
        $this->template->display('content/keuangan/add',$data);
	}


	function update()
	{
		$id = $this->input->post('id');
		$fk_id = $this->input->post('fk_id');

		$config['upload_path'] = './upload/surat';
        $config['allowed_types'] = 'pdf';
        
        $surat = date("Y_m_d_h_i_s_").time().".pdf";
        $config['file_name'] = $surat;

        $proyek = $this->input->post('proyek');
        $kategori = $this->input->post('kategori');
        $uang = $this->input->post('nilai');
        $rincian = $this->input->post('rincian');
        $tanggal = $this->input->post('tanggal');
		$surat_old = $this->input->post('surat');
        
        $uang_asli = "";
        $uang_now = "";
        $lebih = "";
        
        if($kategori == "pelaksana"){
            $pro = "SELECT pelaksana FROM `budgeting_kontruksi` WHERE proyek = '$proyek' ";
            $sanaa =  $this->db->query($pro);
            if ($sanaa->num_rows() > 0) {
                foreach ($sanaa->result() as $row) {
                    $uang_asli = $row->pelaksana;
                    
                    $pro = "SELECT pelaksana FROM `pembayaran` WHERE proyek = '$proyek' ";
                    $sanaa =  $this->db->query($pro);
                    if ($sanaa->num_rows() > 0) {
                        foreach ($sanaa->result() as $row) {
                            $uang_now = $row->pelaksana + $uang;
                            
                            if($uang_now > $uang_asli){
                                $lebih = "sudah";
                            }else{
                                $lebih = "belum";
                            }
                    }}
            }}
        }
        elseif($kategori == "pengawas"){
            $pro = "SELECT pengawas FROM `budgeting_kontruksi` WHERE proyek = '$proyek' ";
            $sanaa =  $this->db->query($pro);
            if ($sanaa->num_rows() > 0) {
                foreach ($sanaa->result() as $row) {
                    $uang_asli = $row->pengawas;
                    
                    $pro = "SELECT pengawas FROM `pembayaran` WHERE proyek = '$proyek' ";
                    $sanaa =  $this->db->query($pro);
                    if ($sanaa->num_rows() > 0) {
                        foreach ($sanaa->result() as $row) {
                            $uang_now = $row->pengawas + $uang;
                            
                            if($uang_now > $uang_asli){
                                $lebih = "sudah";
                            }else{
                                $lebih = "belum";
                            }
                    }}
            }}
        }
        elseif($kategori == "perencana"){
            $pro = "SELECT perencana FROM `budgeting_kontruksi` WHERE proyek = '$proyek' ";
            $sanaa =  $this->db->query($pro);
            if ($sanaa->num_rows() > 0) {
                foreach ($sanaa->result() as $row) {
                    $uang_asli = $row->perencana;
                    
                    $pro = "SELECT perencana FROM `pembayaran` WHERE proyek = '$proyek' ";
                    $sanaa =  $this->db->query($pro);
                    if ($sanaa->num_rows() > 0) {
                        foreach ($sanaa->result() as $row) {
                            $uang_now = $row->perencana + $uang;
                            
                            if($uang_now > $uang_asli){
                                $lebih = "sudah";
                            }else{
                                $lebih = "belum";
                            }
                    }}
            }}
        }
        elseif($kategori == "honorium"){
            $pro = "SELECT biaya_honorium FROM `budgeting` WHERE proyek = '$proyek' ";
            $sanaa =  $this->db->query($pro);
            if ($sanaa->num_rows() > 0) {
                foreach ($sanaa->result() as $row) {
                    $uang_asli = $row->biaya_honorium;
                    
                    $pro = "SELECT honorium FROM `pembayaran` WHERE proyek = '$proyek' ";
                    $sanaa =  $this->db->query($pro);
                    if ($sanaa->num_rows() > 0) {
                        foreach ($sanaa->result() as $row) {
                            $uang_now = $row->honorium + $uang;
                            
                            if($uang_now > $uang_asli){
                                $lebih = "sudah";
                            }else{
                                $lebih = "belum";
                            }
                    }}
            }}
        }
        elseif($kategori == "perjalanan_dinas"){
            $pro = "SELECT biaya_perjalanan FROM `budgeting` WHERE proyek = '$proyek' ";
            $sanaa =  $this->db->query($pro);
            if ($sanaa->num_rows() > 0) {
                foreach ($sanaa->result() as $row) {
                    $uang_asli = $row->biaya_perjalanan;
                    
                    $pro = "SELECT perjalanan_dinas FROM `pembayaran` WHERE proyek = '$proyek' ";
                    $sanaa =  $this->db->query($pro);
                    if ($sanaa->num_rows() > 0) {
                        foreach ($sanaa->result() as $row) {
                            $uang_now = $row->perjalanan_dinas + $uang;
                            
                            if($uang_now > $uang_asli){
                                $lebih = "sudah";
                            }else{
                                $lebih = "belum";
                            }
                    }}
            }}
        }
        elseif($kategori == "habis_pakai"){
            $pro = "SELECT biaya_habis_pakai FROM `budgeting` WHERE proyek = '$proyek' ";
            $sanaa =  $this->db->query($pro);
            if ($sanaa->num_rows() > 0) {
                foreach ($sanaa->result() as $row) {
                    $uang_asli = $row->biaya_habis_pakai;
                    
                    $pro = "SELECT habis_pakai FROM `pembayaran` WHERE proyek = '$proyek' ";
                    $sanaa =  $this->db->query($pro);
                    if ($sanaa->num_rows() > 0) {
                        foreach ($sanaa->result() as $row) {
                            $uang_now = $row->habis_pakai + $uang;
                            
                            if($uang_now > $uang_asli){
                                $lebih = "sudah";
                            }else{
                                $lebih = "belum";
                            }
                    }}
            }}
        }
        
        if($lebih == "belum"){

			$this->upload->initialize($config);
	        
	        if (!empty($_FILES['filesurat']['name'])) {
	            if ($this->upload->do_upload('filesurat') ) {
	                $this->upload->data();
	                $data['tanggal'] = $this->input->post('tanggal');
					$data['kategori'] = $this->input->post('kategori');
					$data['rincian'] = $this->input->post('rincian');
					$data['nilai'] = $this->input->post('nilai');
					$data['surat'] = $surat;

	                @unlink($path.$this->input->post('surat'));
            		$sanaa = $this->m_pekerjaan->new_new_update_history_budget($data, $id);	  

            		$data['response'] = 'Berhasil tersimpan';
					$data['proyek'] = $this->input->post('proyek');             
	            }else {
	              die("Gagal menyimpan");
	            }
	        }else {
	            $data['tanggal'] = $this->input->post('tanggal');
				$data['kategori'] = $this->input->post('kategori');
				$data['rincian'] = $this->input->post('rincian');
				$data['nilai'] = $this->input->post('nilai');
				$data['surat'] = $this->input->post('surat');
            	$sanaa = $this->m_pekerjaan->new_new_update_history_budget($data, $id);

            	$data['response'] = 'Berhasil tersimpan';
				$data['proyek'] = $this->input->post('proyek');
	        }

        }elseif($lebih == "sudah"){
            $data['response'] = 'Gagal, Nilai melebihi batas budget. '.$this->upload->display_errors();
			$data['proyek'] = $this->input->post('proyek');
        }else{
        	$data['response'] = 'Gagal menyimpan. '.$this->upload->display_errors();
			$data['proyek'] = $this->input->post('proyek');
        }

        $data['title'] = 'Edit';
        $data['error'] = '';
		$data['data'] = $this->m_pekerjaan->new_new_get_detail_history_budget_kontruksi_by_id($id);

		$this->template->display('content/pekerjaan/new_new_edit_detail_history_budgeting_kontruksi',$data);

	}

}
 ?>