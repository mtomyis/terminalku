<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pekerjaan extends CI_Controller {
	public function __construct(){
		parent::__construct();

		// load base_url
	    $this->load->helper('url');
 		$this->load->helper(array('form', 'url'));

	    // Load Model
	    $this->load->model('Main_model');
		$this->load->library(array('template','form_validation', 'pdff', 'pdffgen'));
		$this->load->model(array('m_api','m_pekerjaan','m_sub_pekerjaan','m_item_pekerjaan'));
		if (!$this->hak->cek()){
			$this->session->sess_destroy();
			redirect(base_url());
			exit();
		}
    }
	// function add()
	// {
	// 	$data['title'] = 'Add Pekerjaan';
	// 	$this->template->display('content/pekerjaan/add_pekerjaan',$data);
	// }

	// new
	
	function cobapdf()
	{
		$proyek = "Pembangunan  Sarana Dan Prasarana Air Bersih Ikk Srono";
        $idminggu = "73";
        $ttd = "dff1f4fa6af63681fa2affc40945fd1c.png";

        $query = $this->m_api->kirim_laporan($proyek, $idminggu, $ttd);

        $data['idminggul'] = $idminggu;
        $data['proyek'] = $proyek;
        $iniminggu = $this->m_api->mingguke($idminggu, $proyek);
        $data['minggu'] = $iniminggu->minggu;
        $data['section0'] = $this->m_api->section0($proyek);
        $data['data_ppk'] = $this->m_api->datappk($proyek);
        $data['data_pengawas'] = $this->m_api->datapengawas($proyek);

        $data['ttd'] = $this->m_api->data_ttd($idminggu);

        $namaPdf = "Laporan_mingguan_".date("Y_m_d_h_i_s_").time().".pdf";

        $this->pdff->setPaper('A4', 'landscape');
	    $this->pdff->filename = $namaPdf;

        $query = $this->m_api->kirim_laporan($proyek, $idminggu, $ttd);
	    
        $this->pdff->load_view('content/pekerjaan/cetak_laporan_simanis', $data);
	}
	
	function printpdf()
	{
	    $proyek = $this->input->post('proyek');
	    $idminggu = $this->input->post('idminggu_uraian');

	    $data['idminggul'] = $idminggu;
		$data['proyek'] = $proyek;
		$iniminggu = $this->m_pekerjaan->mingguke($idminggu, $proyek);
		$data['minggu'] = $iniminggu->minggu;
	    $data['section0'] = $this->m_pekerjaan->section0($proyek);
	    $data['tandatangandireksi'] = $this->m_pekerjaan->tandatangandireksi($proyek);
	    $data['tandatanganpelaksana'] = $this->m_pekerjaan->tandatanganpelaksana($proyek);

		# code...
		$this->pdff->setPaper('A4', 'landscape');
	    $this->pdff->filename = "laporan.pdf";
	    $this->pdff->load_view('content/pekerjaan/cetak_laporan_mingguan', $data);

	    // $this->pdffgen->setPaper('A4', 'potrait');
	    // $this->pdffgen->load_view('content/pekerjaan/laporan', $data);
	}

	function add()
	{
		$data['title'] = 'Tambah Pekerjaan';
		$data['terminal'] =  $this->m_pekerjaan->new_new_get_terminal();
		
		$this->template->display('content/pekerjaan/new_add_pekerjaan',$data);
	}
	function new_aksi_upload()
	{
	    $data['title'] = 'SI Manis';

		$tanggalawal = $this->input->post('tanggalawal');
        $tanggalakhir = $this->input->post('tanggalakhir');

		if ($tanggalawal>$tanggalakhir) {
			# code...
			echo "<script>alert('Tanggal awal tidak boleh lebih dari tanggal akhir');</script>";
		}
		else {
    		if($this->input->post('upload') != NULL ){ 
        		$data = array(); 
        			if(!empty($_FILES['file']['name'])){ 
			          // Set preference 
			          $config['upload_path'] = './upload/pekerjaan/'; 
			          $config['allowed_types'] = 'csv'; 
			          $config['max_size'] = '10000'; // max_size in kb 
			          $config['file_name'] = $_FILES['file']['name']; 

			          // Load upload library 
			          $this->load->library('upload',$config); 
			          $this->upload->initialize($config);
   
						// File upload
						if($this->upload->do_upload('file')){ 
				            // Get data about the file
				            $uploadData = $this->upload->data(); 
				            $filename = $uploadData['file_name'];
				            // $filename = "aku.csv"; 
				            // Reading file
		                    $file = fopen("./upload/pekerjaan/".$filename,"r");
		                    $i = 0;

		                    $importData_arr = array();
		                       
		                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
		                        $num = count($filedata);

		                        for ($c=0; $c < $num; $c++) {
		                            $importData_arr[$i][] = $filedata[$c];
		                        }
		                        $i++;
		                    }
                    		fclose($file);

                    		$skip = 0;

		                    // insert import data
		                    foreach($importData_arr as $userdata){
		                        if($skip != 0){
		                            $this->m_pekerjaan->insertRecord($userdata);
		                        }
		                        $skip ++;
		                    }
	            			$data['response'] = 'successfully uploaded '.$filename;

	           				$this->m_pekerjaan->simpandetail();
						}else{ 
						$data['response'] = 'failed save file into server'.$this->upload->display_errors(); 
						} 
			        }else{ 
			          $data['response'] = 'file bermasalah'; 
			        } 
		        // load view 
				$this->template->display('content/pekerjaan/new_add_pekerjaan',$data);
			}else{
			// load view 
			$this->template->display('content/pekerjaan/new_add_pekerjaan');
			}
	    }
		 
	}
	
	function new_new_edit_csv($id, $id_addendum)
	{
		$proyek = $this->m_pekerjaan->new_new_get_detail_by_id($id)->proyek;
		$data['data'] = $proyek;
		$data['id'] = $id;

		$data['title'] = 'Upload';
		$data['id_add'] = $id_addendum;

		$data['datahistory'] = $this->m_pekerjaan->new_new_get_detail_history_by_nama($proyek);
		$this->template->display('content/pekerjaan/new_new_edit_csv',$data);
	}

	//popopopo belum diedit  blas
	function new_new_simpan_edit_csv()
	{
		$data['title'] = 'SI Manis';
		$proyek = $this->input->post('proyek');
		$idproyek = $this->input->post('id');
		$id_add = $this->input->post('id_add');
		
		if($this->input->post('simpanedit') != NULL ){ 
    		$data = array(); 
    			if(!empty($_FILES['file']['name'])){ 
		          // Set preference 
		          $config['upload_path'] = './upload/pekerjaan/'; 
		          $config['allowed_types'] = 'csv'; 
		          $config['max_size'] = '10000'; // max_size in kb 
		          $config['file_name'] = $_FILES['file']['name']; 

		          // Load upload library 
		          $this->load->library('upload',$config); 
		          $this->upload->initialize($config);

					// File upload
					if($this->upload->do_upload('file')){ 
			            // Get data about the file
			            $uploadData = $this->upload->data(); 
			            $filename = $uploadData['file_name'];
			            // $filename = "aku.csv"; 
			            // Reading file
	                    $file = fopen("./upload/pekerjaan/".$filename,"r");
	                    $i = 0;

	                    $importData_arr = array();
	                       
	                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
	                        $num = count($filedata);

	                        for ($c=0; $c < $num; $c++) {
	                            $importData_arr[$i][] = $filedata[$c];
	                        }
	                        $i++;
	                    }
                		fclose($file);

                		$skip = 0;
        				// hapus dulu di new pekerjaan kemudian insert
                		$query = "  DELETE FROM new_pekerjaan where proyek = '{$proyek}'
			            ";
			            $daftar2 =  $this->db->query($query);

	                    // insert import data
	                    foreach($importData_arr as $userdata){
	                        if($skip != 0){
	                            $this->m_pekerjaan->insertRecord_editcsv($userdata);
	                        }
	                        $skip ++;
	                    }
           				$this->m_pekerjaan->simpandetail_editcsv();

	                    $data['data'] = $proyek;
						$data['id'] = $idproyek;
						$data['id_add'] = $id_add;
						$data['datahistory'] = $this->m_pekerjaan->new_new_get_detail_history_by_nama($proyek);
            			$data['response'] = 'successfully uploaded '.$filename;

					}else{ 
					$data['data'] = $proyek;
					$data['id_add'] = $id_add;
					$data['datahistory'] = $this->m_pekerjaan->new_new_get_detail_history_by_nama($proyek);
					$data['id'] = $idproyek;
					$data['response'] = 'failed save file into server'.$this->upload->display_errors(); 
					} 
		        }else{ 
		        	$data['data'] = $proyek;
		        	$data['id'] = $idproyek;
					$data['id_add'] = $id_add;
					$data['datahistory'] = $this->m_pekerjaan->new_new_get_detail_history_by_nama($proyek);
		        	$data['response'] = 'file bermasalah'; 
		        } 
	        // load view 
			$this->template->display('content/pekerjaan/new_new_edit_csv',$data);
		}else{
		// $data['response'] = 'Belum Memilih file';
		// load view 
		$this->template->display('content/pekerjaan/new_new_edit_csv', $data);
		}
	}

	function new_new_editcsv_pilihminggu($id, $id_add)
	{
		# code...
		$data['title'] = 'Pilih Proyek';
		$data['id_add'] = $id_add;

		$data['proyek'] = $this->m_pekerjaan->new_new_get_detail_by_id($id)->proyek;

		$this->template->display('content/pekerjaan/new_new_editcsv_pilihminggu',$data);
	}

	function new_lihat_pekerjaan_mingguan_editcsv()
	{
		//edit pilih minggu
		$data['title'] = 'Proyek';

		$proyek = $this->input->post('proyek');
		$idminggu = $this->input->post('idminggu');
		$id_add = $this->input->post('id_add');

	    $this->m_pekerjaan->hapusbobot_uraian_daninsert($proyek, $idminggu);
    	$data['idminggul'] = $idminggu;
		$data['proyek'] = $proyek;
		$data['id_add'] = $id_add;
		$iniminggu = $this->m_pekerjaan->mingguke($idminggu, $proyek);
		$data['minggu'] = $iniminggu->minggu;
		$data['section0'] = $this->m_pekerjaan->section0($proyek);

		$this->template->display('content/pekerjaan/laporan_mingguan_addendum',$data);
	}

	function new_new_add_history_addendum($idpro, $idminggu_penyesuaian, $id_add)
	{
		$proyek = $this->m_pekerjaan->new_new_get_detail_by_id($idpro)->proyek;

		$iniminggu_penyesuaian = $this->m_pekerjaan->mingguke($idminggu_penyesuaian, $proyek);
		$idminggu_matang = $idminggu_penyesuaian+1;
		$iniminggu_matang = $this->m_pekerjaan->mingguke($idminggu_matang, $proyek);

	    $datas = array
        (
            'proyek'=>$proyek,
            'surat_addendum'=>$id_add,
            'minggu_penyesuaian'=>$iniminggu_penyesuaian->minggu,
            'minggu_matang'=>$iniminggu_matang->minggu
        );
        $this->db->insert('new_history_addendum', $datas);

        //edit request addendum
        // $dataa = array(
        // 'status' => '2',
        // 'tanggal_selesai' => NOW(),
        // );
        // $this->db->where('id', $id_add);
        // $this->db->update('new_request_addendum', $dataa);

        $query = "UPDATE new_request_addendum set status = 2, `tanggal_selesai`= NOW() where id = {$id_add}
		";
		$daftar =  $this->db->query($query);

		redirect('Pekerjaan/new_new_edit_csv/'.$idpro.'/'.$id_add);
		// $this->template->display('content/pekerjaan/new_new_edit_csv/'.$idpro);
	}
	
	
	
	function new_pilih_proyek()
	{
		# code...
		$data['title'] = 'Pilih Proyek';
		$data['proyek'] = $this->m_pekerjaan->new_new_get_proyek_order();
		// $data['pekerjaan'] = $this->m_pekerjaan->get_proyek_order();

		$this->template->display('content/pekerjaan/new_pilih_proyek',$data);
	}

	function new_new_pilih_proyek_pengawas()
	{
		$user = array(
            "id" => $this->session->userdata('id')
        );

        $xif = $this->db->get_where("pengguna", $user)->num_rows();
        $x = $this->db->get_where("pengguna", $user)->row();

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

	    $data['title'] = "Pilih Proyek";
        $data['proyek'] = $this->db->get_where("new_pekerjaan_detail", $user_apa)->result_array();
		
		$this->template->display('content/pekerjaan/new_pilih_proyek',$data);
	}
	
	function new_new_pilih_proyek_ppk($fk_id_terminal)
	{
		$user = array(
            "id" => $this->session->userdata('id')
        );

        $xif = $this->db->get_where("pengguna", $user)->num_rows();
        $x = $this->db->get_where("pengguna", $user)->row();

        switch ($x->posisi) {
       //  	case "Admin":
	      //       $posisinya = "fk_id_pengawas";
	    		// $status = "status_pengawas";
	      //   break;
        	case "Pengawas":
	            $posisinya = "fk_id_pengawas";
	    		$status = "status_pengawas";
	        break;
	        case "PPK":
	            $posisinya = "fk_id_ppk";
	    		$status = "status_ppk";
	        break;
	        case "KPA":
	            $posisinya = "fk_id_kpa";
	    		$status = "status_kpa";
	        break;

	        case "PPSPM":
	            $posisinya = "fk_id_ppspm";
	    		$status = "status_ppspm";

	        break;
	        case "KASUBDIT":
	            $posisinya = "fk_id_kasubdit";
	    		$status = "status_kasubdit";
	        break;
	        default:
        }

	    $iduser = $x->id;

	    $data['title'] = "Pilih Minggu";
		$data['data'] = $this->m_pekerjaan->new_new_get_proyek_request_ppk($status, $posisinya, $iduser, $fk_id_terminal);
		
		$this->template->display('content/pekerjaan/new_new_pilih_proyek',$data);
	}

	function new_new_kirim_minggu_ttddulu($idminggu)
	{
		// $proyek = $this->input->post('proyek');
        // $idminggu = $this->input->post('idminggu_uraian');

	    // $data['proyek'] = $proyek;
	    $data['idminggu'] = $idminggu;

		$this->template->display('content/pekerjaan/new_ttd_laporan_pengawas',$data);

		// $this->m_pekerjaan->new_new_kirim_laporan($proyek, $idminggu);

		// echo $proyek;
		// redirect('Pekerjaan/new_new_pilih_proyek_pengawas');
	}

	function new_new_kirim_minggu_pengawas()
	{
		$statusku = "";
		$proyek = "";
        $apakah_sudah = "";
        $signatureFileName = "";

        $idminggu = $this->input->post('idminggu');

        if(isset($_POST['signaturesubmit'])){ 
		    $signature = $_POST['signature'];
		    $signatureFileName = uniqid().'.png';
		    $signature = str_replace('data:image/png;base64,', '', $signature);
		    $signature = str_replace(' ', '+', $signature);
		    $data = base64_decode($signature);
		    $file = './upload/ttd/'.$signatureFileName;
		    file_put_contents($file, $data);
		}
        
        $ttd = $signatureFileName;
        
        $prok = "SELECT proyek FROM `new_minggu_dephub` WHERE id = '$idminggu' ";
        $sanaak =  $this->db->query($prok);
        if ($sanaak->num_rows() > 0) {
            foreach ($sanaak->result() as $row) {
                $proyek = $row->proyek;
        }}

        $pro = "SELECT status_pengawas FROM `new_minggu_dephub` WHERE id = '$idminggu' ";
        $sanaa =  $this->db->query($pro);
        if ($sanaa->num_rows() > 0) {
            foreach ($sanaa->result() as $row) {
                $statusku = $row->status_pengawas;
        }}
        
        if($statusku == 3){
            $query = $this->m_api->kirim_laporan_revisi($proyek, $idminggu, $ttd);
            if($query){
               $apakah_sudah = "sudah";
            }else{
                $apakah_sudah = "belum terinput";
            }
        }else{
            $query = $this->m_api->kirim_laporan($proyek, $idminggu, $ttd);
            if($query){
                $apakah_sudah = "belum";
            }else{
                $apakah_sudah = "belum terinput";
            }
        }

        if ($apakah_sudah == "belum") {
            $data = array (
            "status" => "Berhasil Terkirim"
            );
        }elseif($apakah_sudah == "belum terinput"){
            $data = array (
            "status" => "Gagal Mengirim"
            );
        }elseif($apakah_sudah == "sudah"){
            $data = array (
            "status" => "Berhasil mengirim revisi"
            );
        }

		// $this->m_pekerjaan->new_new_kirim_laporan($proyek, $idminggu);
        
	    // $data['proyek'] = $proyek;
	    // $data['idminggu'] = $idminggu;

	    // disini buat file pdfnya juga
	    $iniminggu = $this->m_api->mingguke($idminggu);
        
        $pengguna = $this->m_api->detailpengguna($iniminggu->proyek);
        
        $detailproyek = $this->m_api->detailproyek($iniminggu->proyek);
        
        $date=date_create($iniminggu->tgl_awal);
        $tglawal = date_format($date,"d F Y");
        
        $date=date_create($iniminggu->tgl_akhir);
        $tglakhir = date_format($date,"d F Y");

        $data['periode'] = $tglawal." - ".$tglakhir;
        $data['proyek'] = $iniminggu->proyek;
        $data['minggu'] = $iniminggu->minggu;
        $data['lokasi'] = $detailproyek->lokasi;
        $data['anggaran'] = $detailproyek->thn_anggaran;
        $data['fk_id_terminal'] = $detailproyek->fk_id_terminal;
        $data['unitkerja'] = $detailproyek->unitkerja;
        $data['pengawas'] = $detailproyek->pengawas;
        $data['logo'] = $pengguna->logopengawas;
        $data['pengawas'] = $pengguna->pengawas;
        // $data['section0'] = $this->m_api->section0dokumentasi($idminggu);
        $data['idminggu'] = $idminggu;
        
        $namaPdf = "Laporan_dokumentasi_mingguan_".date("Y_m_d_h_i_s_").time().".pdf";

        $this->pdffgen->setPaper('A4', 'portrait');
        // $this->pdff->setPaper('A4', 'landscape');
        $this->pdffgen->filename = $namaPdf;
            
        $this->pdffgen->load_view('content/pekerjaan/cetak_laporan_simanis_dokumentasi', $data);
        // $this->load->view('content/pekerjaan/cetak_laporan_simanis_dokumentasi', $data);

        $query = "SELECT pdfdokumentasi FROM new_minggu_dephub where id = '{$idminggu}'
        ";
        $daftar =  $this->db->query($query);
        if ($daftar->num_rows() > 0) {
            foreach ($daftar->result() as $row) {
                $path = './upload/laporan/';
                @unlink($path.$row->pdfdokumentasi);
            }
        }

        $this->db->query("UPDATE `new_minggu_dephub` SET `pdfdokumentasi`= '$namaPdf' WHERE id = $idminggu");
        // buat file pdf selesai


		$this->template->display('content/pekerjaan/new_ttd_laporan_pengawas_hasilnya',$data);
	}

	function kirim_laporan_mingguan($idminggu)
	{
		$statusku = "";
		$proyek = "";
        $apakah_sudah = "";
        $signatureFileName = "";

        // $idminggu = $this->input->post('idminggu');

  //       if(isset($_POST['signaturesubmit'])){ 
		//     $signature = $_POST['signature'];
		//     $signatureFileName = uniqid().'.png';
		//     $signature = str_replace('data:image/png;base64,', '', $signature);
		//     $signature = str_replace(' ', '+', $signature);
		//     $data = base64_decode($signature);
		//     $file = './upload/ttd/'.$signatureFileName;
		//     file_put_contents($file, $data);
		// }
        
        // $ttd = $signatureFileName;
        
        $prok = "SELECT proyek FROM `new_minggu_dephub` WHERE id = '$idminggu' ";
        $sanaak =  $this->db->query($prok);
        if ($sanaak->num_rows() > 0) {
            foreach ($sanaak->result() as $row) {
                $proyek = $row->proyek;
        }}

        $pro = "SELECT status_pengawas FROM `new_minggu_dephub` WHERE id = '$idminggu' ";
        $sanaa =  $this->db->query($pro);
        if ($sanaa->num_rows() > 0) {
            foreach ($sanaa->result() as $row) {
                $statusku = $row->status_pengawas;
        }}
        
        if($statusku == 3){
            $query = $this->m_api->kirim_laporan_revisi($proyek, $idminggu);
            if($query){
               $apakah_sudah = "sudah";
            }else{
                $apakah_sudah = "belum terinput";
            }
        }else{
            $query = $this->m_api->kirim_laporan($proyek, $idminggu);
            if($query){
                $apakah_sudah = "belum";
            }else{
                $apakah_sudah = "belum terinput";
            }
        }

        if ($apakah_sudah == "belum") {
            $data = array (
            "status" => "Berhasil Terkirim"
            );
        }elseif($apakah_sudah == "belum terinput"){
            $data = array (
            "status" => "Gagal Mengirim"
            );
        }elseif($apakah_sudah == "sudah"){
            $data = array (
            "status" => "Berhasil mengirim revisi"
            );
        }

		// $this->m_pekerjaan->new_new_kirim_laporan($proyek, $idminggu);
        
	    // $data['proyek'] = $proyek;
	    // $data['idminggu'] = $idminggu;

	    // disini buat file pdfnya juga
	    $iniminggu = $this->m_api->mingguke($idminggu);
        
        $pengguna = $this->m_api->detailpengguna($iniminggu->proyek);
        
        $detailproyek = $this->m_api->detailproyek($iniminggu->proyek);
        
        $date=date_create($iniminggu->tgl_awal);
        $tglawal = date_format($date,"d F Y");
        
        $date=date_create($iniminggu->tgl_akhir);
        $tglakhir = date_format($date,"d F Y");

        $data['periode'] = $tglawal." - ".$tglakhir;
        $data['proyek'] = $iniminggu->proyek;
        $data['minggu'] = $iniminggu->minggu;
        $data['lokasi'] = $detailproyek->lokasi;
        $data['anggaran'] = $detailproyek->thn_anggaran;
        $data['fk_id_terminal'] = $detailproyek->fk_id_terminal;
        $data['unitkerja'] = $detailproyek->unitkerja;
        $data['pengawas'] = $detailproyek->pengawas;
        $data['logo'] = $pengguna->logopengawas;
        $data['pengawas'] = $pengguna->pengawas;
        // $data['section0'] = $this->m_api->section0dokumentasi($idminggu);
        $data['idminggu'] = $idminggu;
        $data['title'] = "Berhasil";

        
        $namaPdf = "Laporan_dokumentasi_mingguan_".date("Y_m_d_h_i_s_").time().".pdf";

        $this->pdffgen->setPaper('A4', 'portrait');
        // $this->pdff->setPaper('A4', 'landscape');
        $this->pdffgen->filename = $namaPdf;
            
        $this->pdffgen->load_view('content/pekerjaan/cetak_laporan_simanis_dokumentasi', $data);
        // $this->load->view('content/pekerjaan/cetak_laporan_simanis_dokumentasi', $data);

        $query = "SELECT pdfdokumentasi FROM new_minggu_dephub where id = '{$idminggu}'
        ";
        $daftar =  $this->db->query($query);
        if ($daftar->num_rows() > 0) {
            foreach ($daftar->result() as $row) {
                $path = './upload/laporan/';
                @unlink($path.$row->pdfdokumentasi);
            }
        }

        $this->db->query("UPDATE `new_minggu_dephub` SET `pdfdokumentasi`= '$namaPdf' WHERE id = $idminggu");
        // buat file pdf selesai


		$this->template->display('content/pekerjaan/new_ttd_laporan_pengawas_hasilnya',$data);
	}

	function new_new_lihat_validasi_minggu()
	{
		$data['title'] = 'Lihat Proyek';

		$proyek = $this->input->post('proyek');
        $idminggu = $this->input->post('idminggu');

        $data['idminggul'] = $idminggu;
		$data['proyek'] = $proyek;
		$iniminggu = $this->m_pekerjaan->mingguke($idminggu, $proyek);
		$data['minggu'] = $iniminggu->minggu;
		$data['pdfdokumentasi'] = $iniminggu->pdfdokumentasi;

		// $iniminggu = $this->m_api->pekerjaandetail($idminggu);

        $data['datarencanaa'] = $this->m_pekerjaan->lihatbobotrencana($proyek);
        $data['datarealisasia'] = $this->m_pekerjaan->lihatbobotrealisasi($proyek);
        $data['dataminggua'] = $this->m_pekerjaan->lihatgrafikminggu($proyek);

		$this->template->display('content/pekerjaan/laporan_mingguan', $data);

  //       $this->m_pekerjaan->new_new_kirim_laporan($proyek, $idminggu);
		// redirect('Pekerjaan/new_new_pilih_proyek_pengawas');
	}

	function new_new_validasi_minggu()
	{
		$proyek = $this->input->post('proyek');
        $idminggu = $this->input->post('idminggu');

		$this->m_pekerjaan->new_new_validasi_laporan($proyek, $idminggu);

		// echo $proyek;
		redirect('Pekerjaan/new_new_pilih_proyek');
	}

	function new_new_cek_validasi_minggu()
	{
		$user = array(
            "id" => $this->session->userdata('id')
        );

        $xif = $this->db->get_where("pengguna", $user)->num_rows();
        $x = $this->db->get_where("pengguna", $user)->row();

        switch ($x->posisi) {
	        case "PPK":
	    		$status = "status_ppk";
	        break;
	        case "KPA":
	    		$status = "status_kpa";
	        break;

	        case "PPSPM":
	    		$status = "status_ppspm";

	        break;
	        case "KASUBDIT":
	    		$status = "status_kasubdit";
	        break;
	        default:
        }

        $proyek = $this->input->post('proyek');
        $idminggu = $this->input->post('idminggu');

		$this->m_pekerjaan->new_new_cek_validasi_laporan($status, $proyek, $idminggu);

		$data['idminggul'] = $idminggu;
		$data['proyek'] = $proyek;
		$iniminggu = $this->m_pekerjaan->mingguke($idminggu, $proyek);
		$data['minggu'] = $iniminggu->minggu;
		$data['section0'] = $this->m_pekerjaan->section0($proyek);

		// $this->m_pekerjaan->new_new_validasi_laporan($proyek, $idminggu);

		$this->template->display('content/pekerjaan/laporan_mingguan',$data);

	}

	function new_new_pilih_proyek()
	{
		$user = array(
            "id" => $this->session->userdata('id')
        );

        $xif = $this->db->get_where("pengguna", $user)->num_rows();
        $x = $this->db->get_where("pengguna", $user)->row();

        switch ($x->posisi) {
       //  	case "Admin":
	      //       $posisinya = "fk_id_pengawas";
	    		// $status = "status_pengawas";
	      //   break;
        	case "Pengawas":
	            $posisinya = "fk_id_pengawas";
	    		$status = "status_pengawas";
	        break;
	        case "PPK":
	            $posisinya = "fk_id_ppk";
	    		$status = "status_ppk";
	        break;
	        case "KPA":
	            $posisinya = "fk_id_kpa";
	    		$status = "status_kpa";
	        break;

	        case "PPSPM":
	            $posisinya = "fk_id_ppspm";
	    		$status = "status_ppspm";

	        break;
	        case "KASUBDIT":
	            $posisinya = "fk_id_kasubdit";
	    		$status = "status_kasubdit";
	        break;
	        default:
        }

		// $user_apa = array(
	 //        $posisinya => $x->id
	 //    );
	    $iduser = $x->id;

	    $data['title'] = "Pilih Proyek";
		$data['data'] = $this->m_pekerjaan->new_new_get_proyek_request($status, $posisinya, $iduser);
		
		$this->template->display('content/pekerjaan/new_new_pilih_proyek',$data);
	}

	function new_new_pilih_addendum($id_ppk)
	{
		$data['title'] = 'Addendum';
		$data['data'] = $this->m_pekerjaan->new_new_get_addendum($id_ppk);

		$this->template->display('content/pekerjaan/new_new_addendum_pekerjaan',$data);
	}

	function new_new_kelola_pekerjaan()
	{
		$data['title'] = 'Kelola pekerjaan';
		$data['data'] = $this->m_pekerjaan->new_new_get_detail();

		$this->template->display('content/pekerjaan/new_new_detail_pekerjaan',$data);
	}
	function new_new_add_kelola_pekerjaan($id)
	{
		$data['title'] = 'Detail';
		$data['data'] = $this->m_pekerjaan->new_new_get_detail_by_id($id);

		$this->template->display('content/pekerjaan/new_new_add_detail_pekerjaan',$data);
	}
	function new_new_add_kelola_pekerjaan_bobotperminggu($id)
	{
		$proyek ="";

		$data['title'] = 'Bobot Setiap Minggu';

		$pro = "SELECT proyek FROM `new_pekerjaan_detail` WHERE id = '$id' ";
        $sanaa =  $this->db->query($pro);
        if ($sanaa->num_rows() > 0) {
            foreach ($sanaa->result() as $row) {
                $proyek = $row->proyek;
        }}
		
		$data['data'] = $this->m_pekerjaan->new_new_get_detail_minggu($proyek);

		$this->template->display('content/pekerjaan/new_new_add_kelola_pekerjaan_bobotperminggu',$data);
	}
	function bobotperminggu()
	{
		# code...
		$data['title'] = 'Bobot Setiap Minggu';

		$proyek = $this->input->post('dataproyek');

		if( null !== $this->input->post('databobotacuan') ) {
	    	$this->m_pekerjaan->simpandatabobotacuan();
	    }
		$data['data'] = $this->m_pekerjaan->new_new_get_detail_minggu($proyek);

		$this->template->display('content/pekerjaan/new_new_add_kelola_pekerjaan_bobotperminggu',$data);
	}

	function new_new_edit_kelola_pekerjaan($id)
	{
		$data['title'] = 'Edit';
		$data['data'] = $this->m_pekerjaan->new_new_get_detail_by_id($id);
		$data['pengawas'] =  $this->m_pekerjaan->new_new_get_pengawas();
		$data['ppk'] =  $this->m_pekerjaan->new_new_get_ppk();
		$data['kpa'] =  $this->m_pekerjaan->new_new_get_kpa();
		$data['ppspm'] =  $this->m_pekerjaan->new_new_get_ppspm();
		$data['kasubdit'] =  $this->m_pekerjaan->new_new_get_kasubdit();
		$data['terminal'] =  $this->m_pekerjaan->new_new_get_terminal();


		$this->template->display('content/pekerjaan/new_new_edit_detail_pekerjaan',$data);
	}
	function new_new_update_kelola_pekerjaan()
	{
		$id = $this->input->post('id');
		$data['lokasi`'] = $this->input->post('lokasi');
		$data['provinsi'] = $this->input->post('provinsi');
		$data['thn_anggaran'] = $this->input->post('thn');
		$data['fk_id_pengawas'] = $this->input->post('pengawas');
		$data['fk_id_ppk'] = $this->input->post('ppk');
		$data['fk_id_kpa'] = $this->input->post('kpa');
		// $data['fk_id_ppspm'] = $this->input->post('ppspm');
		// $data['fk_id_kasubdit'] = $this->input->post('kasubdit');
		$data['fk_id_terminal'] = $this->input->post('terminal');

		$data['pelaksana'] = $this->input->post('pelaksana');
		$data['unitkerja'] = $this->input->post('unitkerja');

		$this->m_pekerjaan->new_new_update_detail($data, $id);
		
		redirect('pekerjaan/new_new_kelola_pekerjaan');
	}
	
	function new_new_hapus_kelola_pekerjaan()
	{
		$proyek = $this->input->post('proyek');

		$this->m_pekerjaan->kosongkan($proyek);

		// $this->m_pengguna->hapus_data($namaproyek);
		//$this->load->view('hama/delete');
		redirect('pekerjaan/new_new_kelola_pekerjaan', 'refresh');
	}


	function new_lihat_pekerjaan_mingguan()
	{
		$data['title'] = 'Proyek';

		$proyek = $this->input->post('proyek');
		$idminggu = $this->input->post('idminggu');

		$where = array(
			'proyek' => $proyek,
			'fk_id_minggu' => $idminggu
			);

		$cek = $this->m_pekerjaan->cek_laporan("new_bobot_uraian_kerja",$where)->num_rows();
		if($cek == 0){
			// dicek apakah data bobot uraian kerja dengan spesifikasi diatas sudah ada, jika nol maka insert data
	        $this->m_pekerjaan->simpanlaporan();
		}
		$data['idminggul'] = $idminggu;
		$data['proyek'] = $proyek;
		$iniminggu = $this->m_pekerjaan->mingguke($idminggu, $proyek);
		$data['minggu'] = $iniminggu->minggu;

		$data['datarencanaa'] = $this->m_pekerjaan->lihatbobotrencana($proyek);
        $data['datarealisasia'] = $this->m_pekerjaan->lihatbobotrealisasi($proyek);
        $data['dataminggua'] = $this->m_pekerjaan->lihatgrafikminggu($proyek);

		// $this->template->display('content/pekerjaan/laporan_mingguan',$data);
		$this->template->display('content/pekerjaan/laporan_mingguan_ajax',$data);

	}

	function new_new_kelola_budget()
	{
		// insert kode di tambah ke table budgeting
		$data['title'] = 'Kelola budgeting';
		$data['data'] = $this->m_pekerjaan->new_new_get_budgeting();

		$this->template->display('content/pekerjaan/new_new_budgeting',$data);
	}
	function new_new_kelola_addendum()
	{
		// insert kode di tambah ke table budgeting
		$data['title'] = 'Kelola Addendum';
		$data['data'] = $this->m_pekerjaan->new_new_get_request_addendum();

		$this->template->display('content/pekerjaan/new_new_kelola_addendum',$data);
	}

	function new_new_buat_addendum()
	{
		# code...
		$data['title'] = 'Buat Addendum';
		$data['proyek'] = $this->m_pekerjaan->new_new_get_proyek_order_ppk();
		// $data['pekerjaan'] = $this->m_pekerjaan->get_proyek_order();

		$this->template->display('content/pekerjaan/new_new_buat_addendum',$data);
	}
	function new_save_addendum()
	{
		$surat='';
		$excel='';

        if (!empty($_FILES['surat']['name'])) {

        	$config['upload_path'] = './upload/bukti';
	        $config['allowed_types'] = 'pdf';
	        $config['max_size'] = '10000';  //2MB max
	        $config['file_name'] = $_FILES['surat']['name'];
		    
		    $this->load->library('upload',$config); 
	        $this->upload->initialize($config);
            if ( $this->upload->do_upload('surat')) {
                $filesurat = $this->upload->data();
            	$surat = $filesurat['file_name'];
                
		        if (!empty($_FILES['excel']['name'])) {
		        	$configexcel['upload_path'] = './upload/bukti';
			        $configexcel['allowed_types'] = 'pdf';
			        $configexcel['max_size'] = '10000';  //2MB max
			        $configexcel['file_name'] = $_FILES['excel']['name'];
		          	
		          	$this->load->library('upload',$configexcel); 
			        $this->upload->initialize($configexcel);
			        if ($this->upload->do_upload('excel')) {
			        	$fileexcel = $this->upload->data();
            			$excel = $fileexcel['file_name'];

            			$data = array(
				            'proyek' => $this->input->post('proyek'),
				            'fk_id_ppk' => $this->session->userdata('id'),
				            'surat' =>$surat,
				            'xls' => $excel,
				            'status' => '1'
				        );
				        $this->db->insert('new_request_addendum',$data);
			        }else{
              			die("Gagal menyimpan excel");
			        }
		        }else{
        			die("File excel belum terinput");
		        }
            }else {
              die("Gagal menyimpan addendum");
            }
        }else{
        	die("File surat belum terinput");
        }

		redirect('pekerjaan/new_new_pilih_addendum/'.$this->session->userdata('id'));
	}

	function new_new_kelola_budget_history($id)
	{
		// insert kode di tambah ke table budgeting
		$data['title'] = 'Kelola history budgeting';
		$data['data'] = $this->m_pekerjaan->new_new_get_budgeting_history($id);
		$proyek = $this->m_pekerjaan->new_new_get_budgeting_history_proyek($id);
		$data['proyek'] = $proyek->proyek;

		// grafik ppk
		$proyek = $proyek->proyek;
        
        $pelaksana_asli = 0;
        $pengawas_asli = 0;
        $perencana_asli = 0;
        $honorium_asli = 0;
        $perjalanan_dinas_asli =  0;
        $habis_pakai_asli =  0;
        
        $pelaksana =  0;
        $pengawas =  0;
        $perencana =  0;
        $honorium =  0;
        $perjalanan_dinas =  0;
        $habis_pakai =  0;

        $pembayaran =  "SELECT pelaksana, pengawas, perencana, honorium, perjalanan_dinas, habis_pakai FROM `pembayaran` WHERE proyek = '{$proyek}'";
        $query = $this->db->query($pembayaran);
        if ($query->num_rows() > 0) {
          foreach ($query->result() as $rowp) {
            $pelaksana =  $rowp->pelaksana;
            $pengawas =  $rowp->pengawas;
            $perencana =  $rowp->perencana;
            $honorium =  $rowp->honorium;
            $perjalanan_dinas =  $rowp->perjalanan_dinas;
            $habis_pakai =  $rowp->habis_pakai;
        }}
        
        $pembayaran =  "SELECT pelaksana, pengawas, perencana FROM `budgeting_kontruksi` WHERE proyek = '{$proyek}'";
        $query = $this->db->query($pembayaran);
        if ($query->num_rows() > 0) {
          foreach ($query->result() as $rowp) {
            $pelaksana_asli =  $rowp->pelaksana;
            $pengawas_asli =  $rowp->pengawas;
            $perencana_asli =  $rowp->perencana;
        }}
        
        $pembayaran =  "SELECT biaya_honorium, biaya_perjalanan, biaya_habis_pakai FROM `budgeting` WHERE proyek = '{$proyek}'";
        $query = $this->db->query($pembayaran);
        if ($query->num_rows() > 0) {
          foreach ($query->result() as $rowp) {
            $honorium_asli =  $rowp->biaya_honorium;
            $perjalanan_dinas_asli =  $rowp->biaya_perjalanan;
            $habis_pakai_asli =  $rowp->biaya_habis_pakai;
        }}
        
        
        $persen_pelaksana = number_format(($pelaksana/$pelaksana_asli)*100, 2);
        // $persen_perencana = number_format(($perencana/$perencana_asli)*100, 2);
        // $persen_pengawas = number_format(($pengawas/$pengawas_asli)*100, 2);
        // $persen_honorium = number_format(($honorium/$honorium_asli)*100, 2);
        // $persen_perjalanan = number_format(($perjalanan_dinas/$perjalanan_dinas_asli)*100, 2);
        // $persen_habis = number_format(($habis_pakai/$habis_pakai_asli)*100, 2);
        
        $rp_pelaksana = "Rp. ".number_format($pelaksana, 2,',','.');
        // $rp_perencana = "Rp. ".number_format($perencana, 2,',','.');
        // $rp_pengawas = "Rp. ".number_format($pengawas, 2,',','.');
        // $rp_honorium = "Rp. ".number_format($honorium, 2,',','.');
        // $rp_perjalanan = "Rp. ".number_format($perjalanan_dinas, 2,',','.');
        // $rp_habis = "Rp. ".number_format($habis_pakai, 2,',','.');
        
        $rp_kurang_pelaksana = "Rp. ".number_format(($pelaksana_asli-$pelaksana), 2,',','.');
        // $rp_kurang_perencana = "Rp. ".number_format(($perencana_asli-$perencana), 2,',','.');
        // $rp_kurang_pengawas = "Rp. ".number_format(($pengawas_asli-$pengawas), 2,',','.');
        // $rp_kurang_honorium = "Rp. ".number_format(($honorium_asli-$honorium), 2,',','.');
        // $rp_kurang_perjalanan = "Rp. ".number_format(($perjalanan_dinas_asli-$perjalanan_dinas), 2,',','.');
        // $rp_kurang_habis = "Rp. ".number_format(($habis_pakai_asli-$habis_pakai), 2,',','.');
        
        $rp_asli_pelaksana = "Rp. ".number_format($pelaksana_asli, 2,',','.');
        // $rp_asli_perencana = "Rp. ".number_format($perencana_asli, 2,',','.');
        // $rp_asli_pengawas = "Rp. ".number_format($pengawas_asli, 2,',','.');
        // $rp_asli_honorium = "Rp. ".number_format($honorium_asli, 2,',','.');
        // $rp_asli_perjalanan = "Rp. ".number_format($perjalanan_dinas_asli, 2,',','.');
        // $rp_asli_habis = "Rp. ".number_format($habis_pakai_asli, 2,',','.');

        // $persen_kekurangan = (100 - ($persen_pelaksana+$persen_perencana+$persen_pengawas+$persen_honorium+$persen_perjalanan+$persen_habis));
        // $rp_total = "Rp. ".number_format(($pelaksana+$perencana+$pengawas+$honorium+$perjalanan_dinas+$habis_pakai), 2,',','.');
        // $rp_asli_total = "Rp. ".number_format(($pelaksana_asli+$perencana_asli+$pengawas_asli+$honorium_asli+$perjalanan_dinas_asli+$habis_pakai_asli), 2,',','.');
        // $rp_kurang_total = "Rp. ".number_format(( ($pelaksana_asli-$pelaksana)+($perencana_asli-$perencana)+($pengawas_asli-$pengawas)+($honorium_asli-$honorium)+($perjalanan_dinas_asli-$perjalanan_dinas)+($habis_pakai_asli-$habis_pakai)), 2,',','.');

        $persen_kekurangan = (100 - $persen_pelaksana);
        $rp_total = "Rp. ".number_format($pelaksana, 2,',','.');
        $rp_asli_total = "Rp. ".number_format($pelaksana_asli, 2,',','.');
        $rp_kurang_total = "Rp. ".number_format( ($pelaksana_asli-$pelaksana), 2,',','.');

		$data['persen_pelaksana'] = $persen_pelaksana;
		// $data['persen_perencana']= $persen_perencana;
  //       $data['persen_pengawas']= $persen_pengawas;
  //       $data['persen_honorium']= $persen_honorium;
  //       $data['persen_perjalanan']=  $persen_perjalanan;
  //       $data['persen_habis'] = $persen_habis;
        $data['persen_kekurangan'] = $persen_kekurangan;

        $data['rp_pelaksana'] = $rp_pelaksana;
  //       $data['rp_perencana'] = $rp_perencana;
  //       $data['rp_pengawas']=  $rp_pengawas;
  //       $data['rp_honorium'] = $rp_honorium;
  //       $data['rp_perjalanan'] = $rp_perjalanan;
  //       $data['rp_habis']=  $rp_habis;
        $data['rp_total']=  $rp_total;

        $data['rp_asli_pelaksana'] = $rp_asli_pelaksana;
        // $data['rp_asli_perencana'] = $rp_asli_perencana;
        // $data['rp_asli_pengawas'] = $rp_asli_pengawas;
        // $data['rp_asli_honorium']=  $rp_asli_honorium;
        // $data['rp_asli_perjalanan'] = $rp_asli_perjalanan;
        // $data['rp_asli_habis'] = $rp_asli_habis;
        $data['rp_asli_total'] = $rp_asli_total;

        $data['rp_kurang_pelaksana'] = $rp_kurang_pelaksana;
        // $data['rp_kurang_perencana'] = $rp_kurang_perencana;
        // $data['rp_kurang_pengawas'] = $rp_kurang_pengawas;
        // $data['rp_kurang_honorium']=  $rp_kurang_honorium;
        // $data['rp_kurang_perjalanan'] = $rp_kurang_perjalanan;
        // $data['rp_kurang_habis'] = $rp_kurang_habis;
        $data['rp_kurang_total'] = $rp_kurang_total;

		$this->template->display('content/pekerjaan/new_new_budgeting_history',$data);
	}
	function new_new_edit_kelola_budget($id)
	{
		$data['title'] = 'Edit';
		$data['data'] = $this->m_pekerjaan->new_new_get_detail_budget_by_id($id);

		$this->template->display('content/pekerjaan/new_new_edit_detail_budgeting',$data);
	}

	function new_new_kelola_budget_kontruksi($id)
	{
		$data['title'] = 'Edit';
        $data['error'] = '';
		$data['data'] = $this->m_pekerjaan->new_new_get_detail_budget_kontruksi_by_id($id);

		$this->template->display('content/pekerjaan/new_new_edit_detail_budgeting_kontruksi',$data);
	}

	function new_new_edit_kelola_history_budget($id)
	{
		$data['title'] = 'Edit';
        $data['error'] = '';
		$data['data'] = $this->m_pekerjaan->new_new_get_detail_history_budget_kontruksi_by_id($id);

		$this->template->display('content/pekerjaan/new_new_edit_detail_history_budgeting_kontruksi',$data);
	}
	
	function new_new_lihat_history_budget_surat($surat)
	{
		$data['title'] = 'Surat';
        $data['data'] = $surat;
        
        $url = base_url('upload/surat/'.$surat);

        redirect('https://docs.google.com/gview?embedded=true&url='.$url);

// 		$this->load->view('content/pekerjaan/new_new_lihat_history_budget_surat' ,$data);
	}

	function new_new_hapus_budget_history($fk_id, $id)
	{
        $this->m_pekerjaan->new_new_update_history_budget_delete($id);

		redirect('pekerjaan/new_new_kelola_budget_history/'.$fk_id);

	}

	function new_new_update_kelola_budget()
	{
		$id = $this->input->post('id');
		$data['biaya_total'] = $this->input->post('biaya_total');
		$data['biaya_kontruksi'] = $this->input->post('biaya_kontruksi');
		$id_fk = $this->input->post('fk_id_kontruksi');
		$datapelaksana['pelaksana'] = $this->input->post('biaya_kontruksi');
		
		$this->m_pekerjaan->new_new_update_budget_kontruksi($datapelaksana, $id_fk);

		// $data['biaya_honorium'] = $this->input->post('biaya_honorium');
		// $data['biaya_perjalanan'] = $this->input->post('biaya_perjalanan');
		// $data['biaya_habis_pakai'] = $this->input->post('biaya_habis_pakai');

		$this->m_pekerjaan->new_new_update_budget($data, $id);
		
		redirect('pekerjaan/new_new_kelola_budget');
	}

	function new_new_update_kelola_history_budget()
	{
		$id = $this->input->post('id');
		$fk_id = $this->input->post('fk_id');

		$data['tanggal'] = $this->input->post('tanggal');
		$data['kategori'] = $this->input->post('kategori');
		$data['rincian'] = $this->input->post('rincian');
		$data['nilai'] = $this->input->post('nilai');
		$data['surat'] = $this->input->post('surat');

		$this->m_pekerjaan->new_new_update_history_budget($data, $id);
		
		redirect('pekerjaan/new_new_kelola_budget_history/'.$fk_id);
	}

	function new_new_update_kelola_budget_kontruksi()
	{
		$id = $this->input->post('id');

		$sum = $this->input->post('sum');
        $biaya_kontruksi = $this->input->post('biaya_kontruksi');

        if ($sum != $biaya_kontruksi) {
        	$data['error'] = "Budget total tidak sesuai dengan budget biaya kontruksi, harap masukkan data lagi.";
            echo "<script> alert('Budget total tidak sesuai dengan budget biaya kontruksi, harap masukkan data lagi');</script>";
            redirect('pekerjaan/new_new_kelola_budget_kontruksi/'.$id);
        }
        else{
        	$data['perencana'] = $this->input->post('perencana');
			$data['pengawas'] = $this->input->post('pengawas');
			$data['pelaksana'] = $this->input->post('pelaksana');

			$this->m_pekerjaan->new_new_update_budget_kontruksi($data, $id);
			redirect('pekerjaan/new_new_kelola_budget');
        }
		
	}

	function mencobatom()
	{
		# code...
		$data['title'] = 'Proyek';

		$proyek = $this->input->post('dataproyek');
		$idminggu = $this->input->post('idminggu');
		// $iduraian = $this->input->post('iduraian');
  //       $volume = $this->input->post('datavolume');
  //       $volumeasli = $this->input->post('datavolumeasli');
  //       $bobotasli = $this->input->post('databobotasli');
  //       $keterangan = $this->input->post('dataketerangan');
  //       $idminggu = $this->input->post('idminggu');
  //       $proyek = $this->input->post('dataproyek');
  //       $minggu = $this->input->post('datamingguke');

		$data['idminggul'] = $idminggu;
		$data['proyek'] = $proyek;
		$data['section0'] = $this->m_pekerjaan->section0($proyek);
		$data['proyek'] = $proyek;
		$iniminggu = $this->m_pekerjaan->mingguke($idminggu, $proyek);
		$data['minggu'] = $iniminggu->minggu;

		if( null !== $this->input->post('datavolume') ) {
	    	$this->m_pekerjaan->simpandataku();
	    // echo "<script>alert('id uraian');</script>".$iduraian;
	    // echo "<script>alert('volume');</script>".$volume;
	    // echo "<script>alert('volume asli');</script>".$volumeasli;
	    // echo "<script>alert('bobot asli');</script>".$bobotasli;
	    // echo "<script>alert('keterangan');</script>".$keterangan;
	    // echo "<script>alert('idminggu');</script>".$idminggu;
	    // echo "<script>alert('proyek');</script>".$proyek;
	    // echo "<script>alert('minggu');</script>".$minggu;

	    }
		$this->template->display('content/pekerjaan/laporan_mingguan',$data);
	    // echo "<script>alert('gagal');</script>";
	}

	function new_new_history_edit_csv($id)
	{
		$proyek = $this->m_pekerjaan->new_new_get_detail_by_id($id)->proyek;
		$data['data'] = $proyek;
		$data['id'] = $id;

		$data['title'] = 'History Addendum';

		$data['datahistory'] = $this->m_pekerjaan->new_new_get_detail_history_by_nama($proyek);

		$this->template->display('content/pekerjaan/new_new_history_edit_csv',$data);
	}
	

	function save_edit_csv()
	{
		$data['title'] = 'Proyek';
		$id_add = $this->input->post('id_add');

		$proyek = $this->input->post('dataproyek');
		$idminggu = $this->input->post('idminggu');
		$iduraian = $this->input->post('iduraian');
        $volume = $this->input->post('datavolume');
        $volumeasli = $this->input->post('datavolumeasli');
        $bobotasli = $this->input->post('databobotasli');
        // $keterangan = $this->input->post('dataketerangan');
        $minggu = $this->input->post('datamingguke');

        for($i=0;$i<sizeof($volume);$i++)
	    {
	    	$volumelalu = array();
	        $bobotsdminggu_ini = array();
	        $bobotminggu_ini = array();
	        $volumesdminggu_ini = array();

        	$volumesdminggu_ini[$i] = $volume[$i];

        	// if ($volumesdminggu_ini[$i] > $volumeasli[$i]) {
            	// terdapat data yang lebih silahkan cek
	        // }
	        // elseif ($volumesdminggu_ini[$i] <= $volumeasli[$i]){

	        $bobotminggu_ini[$i] = ($volume[$i]/$volumeasli[$i])*$bobotasli[$i];
	        $bobotsdminggu_ini[$i] = ($volumesdminggu_ini[$i]/$volumeasli[$i])*$bobotasli[$i];

	        $query[$i]="UPDATE `new_bobot_uraian_kerja` SET  `volume_detail`= '{$volume[$i]}',  `bobot_detail`= '{$bobotminggu_ini[$i]}' , `volume_akhir`= '{$volumesdminggu_ini[$i]}',  `bobot_akhir`= '{$bobotsdminggu_ini[$i]}' WHERE fk_id_new_pekerjaan = '{$iduraian[$i]}' AND proyek = '{$proyek[$i]}' AND fk_id_minggu = {$idminggu[$i]}";

	        $daftar2[$i] =  $this->db->query($query[$i]);

	    	}
	    // }

	    $querya="SELECT SUM(volume_akhir) as volume_total, SUM(bobot_akhir) as bobot_total FROM `new_bobot_uraian_kerja` WHERE fk_id_minggu = {$idminggu[0]} AND proyek = '{$proyek[0]}'";

        $daftar =  $this->db->query($querya)->row();

        // // __________________________________________simpan ke mingguan total
        $databobot = $daftar->bobot_total;
        $datavolume = $daftar->volume_total;

        $querys="UPDATE `new_minggu` SET `volume_total`= {$datavolume},`bobot_total`= {$databobot} WHERE id = {$idminggu[0]}";

        $daftar1 =  $this->db->query($querys);

		$data['idminggul'] = $idminggu[0];
		$data['proyek'] = $proyek[0];

		$data['id_add'] = $id_add;

		$data['section0'] = $this->m_pekerjaan->section0($proyek[0]);
		$data['proyek'] = $proyek[0];
		$iniminggu = $this->m_pekerjaan->mingguke($idminggu[0], $proyek[0]);
		$data['minggu'] = $iniminggu->minggu;
		# code...
		// $data['title'] = 'Proyek';

		// $proyek = $this->input->post('dataproyek');
		// $idminggu = $this->input->post('idminggu');

		// if( null !== $this->input->post('datavolume') ) {
	 //    	$this->m_pekerjaan->simpandataku_edit_csv();
	 //    }

		// $data['idminggul'] = $idminggu;
		// $data['proyek'] = $proyek;
		// $data['section0'] = $this->m_pekerjaan->section0($proyek);
		// $data['proyek'] = $proyek;
		// $iniminggu = $this->m_pekerjaan->mingguke($idminggu, $proyek);
		// $data['minggu'] = $iniminggu->minggu;

		$this->template->display('content/pekerjaan/laporan_mingguan_addendum',$data);
	    // echo "<script>alert('gagal');</script>";
	}

	// mencoba ajax simpan smeuan
	function save_edit_ajax()
	{
		# code...
		$data['title'] = 'Proyek';

		$proyek = $this->input->post('dataproyek');
		$idminggu = $this->input->post('idminggu');
		$iduraian = $this->input->post('iduraian');
        $volume = $this->input->post('datavolume');
        $volumeasli = $this->input->post('datavolumeasli');
        $bobotasli = $this->input->post('databobotasli');
        // $keterangan = $this->input->post('dataketerangan');
        $minggu = $this->input->post('datamingguke');

        $volumelalu = array();
	        $bobotsdminggu_ini = array();
	        $bobotminggu_ini = array();
	        $volumesdminggu_ini = array();

	        if ($minggu[0] == "minggu ke- 1") {
            	$volumelalu[0] = 0;
	        } 
	        elseif ($minggu[0] !== "minggu ke- 1"){
	            $idm[0] = $idminggu[0]-1;
	            $minggulalu[0] =  "SELECT * FROM `new_bobot_uraian_kerja` WHERE fk_id_minggu = '$idm[0]' AND fk_id_new_pekerjaan = '{$iduraian[0]}' AND proyek = '{$proyek[0]}'";
	            $query[0] = $this->db->query($minggulalu[0]);
	            if ($query[0]->num_rows() > 0) {
	              foreach ($query[0]->result() as $rowy[0]) {
	                $volumelalu[0] = $rowy[0]->volume_akhir;
	              }
	          	}
	        }

        	$volumesdminggu_ini[0] = $volume[0]+$volumelalu[0];

        	// if ($volumesdminggu_ini[0] > $volumeasli[0]) {
            	// terdapat data yang lebih silahkan cek
	        // }
	        // elseif ($volumesdminggu_ini[0] <= $volumeasli[0]){

	        $bobotminggu_ini[0] = ($volume[0]/$volumeasli[0])*$bobotasli[0];
	        $bobotsdminggu_ini[0] = ($volumesdminggu_ini[0]/$volumeasli[0])*$bobotasli[0];

	        $query[0]="UPDATE `new_bobot_uraian_kerja` SET  `volume_detail`= '{$volume[0]}',  `bobot_detail`= '{$bobotminggu_ini[0]}' , `volume_akhir`= '{$volumesdminggu_ini[0]}',  `bobot_akhir`= '{$bobotsdminggu_ini[0]}' WHERE fk_id_new_pekerjaan = '{$iduraian[0]}' AND proyek = '{$proyek[0]}' AND fk_id_minggu = {$idminggu[0]}";

	        $daftar2[$i] =  $this->db->query($query[$i]);

     //    for($i=0;$i<sizeof($volume);$i++)
	    // {
	    	// $volumelalu = array();
	     //    $bobotsdminggu_ini = array();
	     //    $bobotminggu_ini = array();
	     //    $volumesdminggu_ini = array();

	     //    if ($minggu[$i] == "minggu ke- 1") {
      //       	$volumelalu[$i] = 0;
	     //    } 
	     //    elseif ($minggu[$i] !== "minggu ke- 1"){
	     //        $idm[$i] = $idminggu[$i]-1;
	     //        $minggulalu[$i] =  "SELECT * FROM `new_bobot_uraian_kerja` WHERE fk_id_minggu = '$idm[$i]' AND fk_id_new_pekerjaan = '{$iduraian[$i]}' AND proyek = '{$proyek[$i]}'";
	     //        $query[$i] = $this->db->query($minggulalu[$i]);
	     //        if ($query[$i]->num_rows() > 0) {
	     //          foreach ($query[$i]->result() as $rowy[$i]) {
	     //            $volumelalu[$i] = $rowy[$i]->volume_akhir;
	     //          }
	     //      	}
	     //    }

      //   	$volumesdminggu_ini[$i] = $volume[$i]+$volumelalu[$i];

        	// if ($volumesdminggu_ini[$i] > $volumeasli[$i]) {
            	// terdapat data yang lebih silahkan cek
	        // }
	        // elseif ($volumesdminggu_ini[$i] <= $volumeasli[$i]){

	        // $bobotminggu_ini[$i] = ($volume[$i]/$volumeasli[$i])*$bobotasli[$i];
	        // $bobotsdminggu_ini[$i] = ($volumesdminggu_ini[$i]/$volumeasli[$i])*$bobotasli[$i];

	        // $query[$i]="UPDATE `new_bobot_uraian_kerja` SET  `volume_detail`= '{$volume[$i]}',  `bobot_detail`= '{$bobotminggu_ini[$i]}' , `volume_akhir`= '{$volumesdminggu_ini[$i]}',  `bobot_akhir`= '{$bobotsdminggu_ini[$i]}' WHERE fk_id_new_pekerjaan = '{$iduraian[$i]}' AND proyek = '{$proyek[$i]}' AND fk_id_minggu = {$idminggu[$i]}";

	        // $daftar2[$i] =  $this->db->query($query[$i]);

	    	// }
	    // }

	    $querya="SELECT SUM(volume_akhir) as volume_total, SUM(bobot_akhir) as bobot_total FROM `new_bobot_uraian_kerja` WHERE fk_id_minggu = {$idminggu[0]} AND proyek = '{$proyek[0]}'";

        $daftar =  $this->db->query($querya)->row();

        // // __________________________________________simpan ke mingguan total
        $databobot = $daftar->bobot_total;
        $datavolume = $daftar->volume_total;

        $querys="UPDATE `new_minggu` SET `volume_total`= {$datavolume},`bobot_total`= {$databobot} WHERE id = {$idminggu[0]}";

        $daftar1 =  $this->db->query($querys);

		$data['idminggul'] = $idminggu[0];
		$data['proyek'] = $proyek[0];
		$iniminggu = $this->m_pekerjaan->mingguke($idminggu[0], $proyek[0]);
		$data['minggu'] = $iniminggu->minggu;

		$data['datarencanaa'] = $this->m_pekerjaan->lihatbobotrencana($proyek);
        $data['datarealisasia'] = $this->m_pekerjaan->lihatbobotrealisasi($proyek);
        $data['dataminggua'] = $this->m_pekerjaan->lihatgrafikminggu($proyek);

		$this->template->display('content/pekerjaan/laporan_mingguan_ajax',$data);
	}

	function save_edit_ajaxku()
	{
		# code...
		$data['title'] = 'Proyek';

		$proyek = $this->input->post('dataproyek');
		$idminggu = $this->input->post('idminggu');
		$iduraian = $this->input->post('iduraian');
        $volume = $this->input->post('datavolume');
        $volumeasli = $this->input->post('datavolumeasli');
        $bobotasli = $this->input->post('databobotasli');
        // $keterangan = $this->input->post('dataketerangan');
        $minggu = $this->input->post('datamingguke');

        for($i=0;$i<sizeof($volume);$i++)
	    {
	    	$volumelalu = array();
	        $bobotsdminggu_ini = array();
	        $bobotminggu_ini = array();
	        $volumesdminggu_ini = array();

	        if ($minggu[$i] == "minggu ke- 1") {
            	$volumelalu[$i] = 0;
	        } 
	        elseif ($minggu[$i] !== "minggu ke- 1"){
	            $idm[$i] = $idminggu[$i]-1;
	            $minggulalu[$i] =  "SELECT * FROM `new_bobot_uraian_kerja` WHERE fk_id_minggu = '$idm[$i]' AND fk_id_new_pekerjaan = '{$iduraian[$i]}' AND proyek = '{$proyek[$i]}'";
	            $query[$i] = $this->db->query($minggulalu[$i]);
	            if ($query[$i]->num_rows() > 0) {
	              foreach ($query[$i]->result() as $rowy[$i]) {
	                $volumelalu[$i] = $rowy[$i]->volume_akhir;
	              }
	          	}
	        }

        	$volumesdminggu_ini[$i] = $volume[$i]+$volumelalu[$i];

        	// if ($volumesdminggu_ini[$i] > $volumeasli[$i]) {
            	// terdapat data yang lebih silahkan cek
	        // }
	        // elseif ($volumesdminggu_ini[$i] <= $volumeasli[$i]){

	        $bobotminggu_ini[$i] = ($volume[$i]/$volumeasli[$i])*$bobotasli[$i];
	        $bobotsdminggu_ini[$i] = ($volumesdminggu_ini[$i]/$volumeasli[$i])*$bobotasli[$i];

	        $query[$i]="UPDATE `new_bobot_uraian_kerja` SET  `volume_detail`= '{$volume[$i]}',  `bobot_detail`= '{$bobotminggu_ini[$i]}' , `volume_akhir`= '{$volumesdminggu_ini[$i]}',  `bobot_akhir`= '{$bobotsdminggu_ini[$i]}' WHERE fk_id_new_pekerjaan = '{$iduraian[$i]}' AND proyek = '{$proyek[$i]}' AND fk_id_minggu = {$idminggu[$i]}";

	        $daftar2[$i] =  $this->db->query($query[$i]);

	    	}
	    // }

	    $querya="SELECT SUM(volume_akhir) as volume_total, SUM(bobot_akhir) as bobot_total FROM `new_bobot_uraian_kerja` WHERE fk_id_minggu = {$idminggu[0]} AND proyek = '{$proyek[0]}'";

        $daftar =  $this->db->query($querya)->row();

        // // __________________________________________simpan ke mingguan total
        $databobot = $daftar->bobot_total;
        $datavolume = $daftar->volume_total;

        $querys="UPDATE `new_minggu` SET `volume_total`= {$datavolume},`bobot_total`= {$databobot} WHERE id = {$idminggu[0]}";

        $daftar1 =  $this->db->query($querys);

		$data['idminggul'] = $idminggu[0];
		$data['proyek'] = $proyek[0];
		$data['section0'] = $this->m_pekerjaan->section0($proyek[0]);
		$data['proyek'] = $proyek[0];
		$iniminggu = $this->m_pekerjaan->mingguke($idminggu[0], $proyek[0]);
		$data['minggu'] = $iniminggu->minggu;
	}
	// mencoba ajax simpan

	function new_lihat_pekerjaan()
	{
        $proyek = $this->input->post('proyek');

		$data['proyek'] = $proyek;
		$data['title'] = 'Lihat Pekerjaan';

		$data['section0'] = $this->m_pekerjaan->section0($proyek);

		$this->template->display('content/pekerjaan/new_lihat_pekerjaan',$data);
	}
	function new_kosongkan()
	{
		# code...
        $proyek = $this->input->post('proyek');
        $idminggu = $this->input->post('idminggu_uraian');


		// $this->m_pekerjaan->kosongkan($proyek);
		// $this->m_pekerjaan->kosongkanjuga($proyek);
		// $this->m_pekerjaan->kosongkanminggu($proyek);
		// $this->m_pekerjaan->kosongkanlaporan($proyek);

		$this->m_pekerjaan->kosongkansaja($proyek, $idminggu);


		// echo $proyek;
		redirect('Pekerjaan/new_pilih_proyek');
	}
	// akhirnew

	function sub_pekerjaan()
	{
		$data['pekerjaan'] = $this->m_pekerjaan->get_all();
		$data['title'] = 'Sub Pekerjaan';
		$this->template->display('content/pekerjaan/sub_pekerjaan',$data);
	}
	function item_pekerjaan()
	{
		$data['pekerjaan'] = $this->m_pekerjaan->get_all();
		$data['title'] = 'Item Pekerjaan';
		$this->template->display('content/pekerjaan/item_pekerjaan',$data);
	}
	public function ajax_list()
    {
		$list = $this->m_pekerjaan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $d) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $d->nama_pekerjaan;
			$row[] = $d->tahun_anggaran;
			$row[] = $d->sumber_dana;
			$row[] = $d->lokasi;
			$row[] = '<div class="aksi">
						<a href="javascript:void(0)" title="Delete" onclick="delete_data('."'".$d->id_pekerjaan."'".')">
							<span class="nav-icon"><i class="delete-icon"></i></span>
						</a>
             			<a href="javascript:void(0)" onclick="edit('."'".$d->id_pekerjaan."'".')">
							<span class="nav-icon"><i class="edit-icon"></i></span>
						</a>
					  </div>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_pekerjaan->count_all(),
			"recordsFiltered" => $this->m_pekerjaan->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
    }
	public function ajax_list_sub($id)
    {
		$list = $this->m_sub_pekerjaan->get_datatables($id);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $d) {
			$no++;
			$row = array();
			$row[] = $d->no_refrensi;
			$row[] = $d->nama_sub_pekerjaan;
			$row[] = '<div class="aksi">
						<a href="javascript:void(0)" title="Delete" onclick="delete_data('."'".$d->id_sub_pekerjaan."'".')">
							<span class="nav-icon"><i class="delete-icon"></i></span>
						</a>
             			<a href="javascript:void(0)" onclick="edit('."'".$d->id_sub_pekerjaan."'".')">
							<span class="nav-icon"><i class="edit-icon"></i></span>
						</a>
					  </div>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_sub_pekerjaan->count_all($id),
			"recordsFiltered" => $this->m_sub_pekerjaan->count_filtered($id),
			"data" => $data,
		);
		echo json_encode($output);
    }
	public function ajax_list_item($id)
    {
		$list = $this->m_item_pekerjaan->get_datatables($id);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $d) {
			$no++;
			$row = array();
			$row[] = $d->no_refrensi_item_pekerjaan;
			$row[] = $d->nama_item_pekerjaan;
			$row[] = $d->satuan;
			$row[] = '<div class="aksi">
						<a href="javascript:void(0)" title="Delete" onclick="delete_data('."'".$d->id_item_pekerjaan."'".')">
							<span class="nav-icon"><i class="delete-icon"></i></span>
						</a>
             			<a href="javascript:void(0)" onclick="edit('."'".$d->id_item_pekerjaan."'".')">
							<span class="nav-icon"><i class="edit-icon"></i></span>
						</a>
					  </div>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_item_pekerjaan->count_all($id),
			"recordsFiltered" => $this->m_item_pekerjaan->count_filtered($id),
			"data" => $data,
		);
		echo json_encode($output);
    }
	function save()
	{
		$this->form_validation->set_rules('nama_pekerjaan','nama_pekerjaan','required');
		$this->form_validation->set_rules('tahun_anggaran','tahun_anggaran','required');
		$this->form_validation->set_rules('lokasi','lokasi','required');
		if($this->form_validation->run() != false)
		{
			$data = array
			(
				'nama_pekerjaan'=>$this->input->post('nama_pekerjaan',TRUE),
				'tahun_anggaran'=>$this->input->post('tahun_anggaran',TRUE),
				'lokasi'=>$this->input->post('lokasi',TRUE),
				'sumber_dana'=>$this->input->post('sumber_dana',TRUE)
			);
			$this->m_pekerjaan->save($data);
			echo json_encode(array("status"=>TRUE));
		}
		else
		{
			echo json_encode(array("status"=>FALSE));	
		}
	}
	function update($id)
	{
		$this->form_validation->set_rules('nama_pekerjaan','nama_pekerjaan','required');
		$this->form_validation->set_rules('tahun_anggaran','tahun_anggaran','required');
		$this->form_validation->set_rules('lokasi','lokasi','required');
		if($this->form_validation->run() != false)
		{
			$data = array
			(
				'nama_pekerjaan'=>$this->input->post('nama_pekerjaan',TRUE),
				'tahun_anggaran'=>$this->input->post('tahun_anggaran',TRUE),
				'lokasi'=>$this->input->post('lokasi',TRUE),
				'sumber_dana'=>$this->input->post('sumber_dana',TRUE)
			);
			$this->m_pekerjaan->update(array('id_pekerjaan' => $id), $data);
			echo json_encode(array("status"=>TRUE));
		}
		else
		{
			echo json_encode(array("status"=>FALSE));	
		}
	}
	function edit($id)
	{
		$data = $this->m_pekerjaan->edit($id);
		echo json_encode($data);
	}
	function delete($id)
	{
		$this->m_pekerjaan->delete_by_id($id);
		$this->m_sub_pekerjaan->delete($id);
		$this->m_item_pekerjaan->delete($id);
		echo json_encode(array("status" => TRUE));
	}
	function save_sub()
	{
		$this->form_validation->set_rules('id_pekerjaan','id_pekerjaan','required');
		$this->form_validation->set_rules('no_refrensi','no_refrensi','required');
		$this->form_validation->set_rules('nama_sub_pekerjaan','nama_sub_pekerjaan','required');
		if($this->form_validation->run() != false)
		{
			$data = array
			(
				'id_pekerjaan'=>$this->input->post('id_pekerjaan',TRUE),
				'no_refrensi'=>$this->input->post('no_refrensi',TRUE),
				'nama_sub_pekerjaan'=>$this->input->post('nama_sub_pekerjaan',TRUE)
			);
			$this->m_sub_pekerjaan->save($data);
			echo json_encode(array("status"=>TRUE));
		}
		else
		{
			echo json_encode(array("status"=>FALSE));	
		}
	}
	function update_sub($id)
	{
		$this->form_validation->set_rules('id_pekerjaan','id_pekerjaan','required');
		$this->form_validation->set_rules('no_refrensi','no_refrensi','required');
		$this->form_validation->set_rules('nama_sub_pekerjaan','nama_sub_pekerjaan','required');
		if($this->form_validation->run() != false)
		{
			$data = array
			(
				'id_pekerjaan'=>$this->input->post('id_pekerjaan',TRUE),
				'no_refrensi'=>$this->input->post('no_refrensi',TRUE),
				'nama_sub_pekerjaan'=>$this->input->post('nama_sub_pekerjaan',TRUE)
			);
			$this->m_sub_pekerjaan->update(array('id_sub_pekerjaan' => $id), $data);
			echo json_encode(array("status"=>TRUE));
		}
		else
		{
			echo json_encode(array("status"=>FALSE));	
		}
	}
	function edit_sub($id)
	{
		$data = $this->m_sub_pekerjaan->edit($id);
		echo json_encode($data);
	}
	function delete_sub($id)
	{
		$data = $this->m_sub_pekerjaan->delete_by_id($id);
		$this->m_item_pekerjaan->delete_sub($id);
		echo json_encode(array("status" => TRUE));
	}
	function save_item()
	{
		$this->form_validation->set_rules('id_pekerjaan','id_pekerjaan','required');
		$this->form_validation->set_rules('id_sub_pekerjaan','id_sub_pekerjaan','required');
		$this->form_validation->set_rules('nama_item_pekerjaan','nama_item_pekerjaan','required');
		if($this->form_validation->run() != false)
		{
			$data = array
			(
				'id_pekerjaan'=>$this->input->post('id_pekerjaan',TRUE),
				'id_sub_pekerjaan'=>$this->input->post('id_sub_pekerjaan',TRUE),
				'no_refrensi_item_pekerjaan'=>$this->input->post('no_refrensi_item_pekerjaan',TRUE),
				'nama_item_pekerjaan'=>$this->input->post('nama_item_pekerjaan',TRUE),
				'satuan'=>$this->input->post('satuan',TRUE)
			);
			$this->m_item_pekerjaan->save($data);
			echo json_encode(array("status"=>TRUE));
		}
		else
		{
			echo json_encode(array("status"=>FALSE));	
		}
	}
	function update_item($id)
	{
		$this->form_validation->set_rules('id_pekerjaan','id_pekerjaan','required');
		$this->form_validation->set_rules('id_sub_pekerjaan','id_sub_pekerjaan','required');
		$this->form_validation->set_rules('nama_item_pekerjaan','nama_item_pekerjaan','required');
		if($this->form_validation->run() != false)
		{
			$data = array
			(
				'id_pekerjaan'=>$this->input->post('id_pekerjaan',TRUE),
				'id_sub_pekerjaan'=>$this->input->post('id_sub_pekerjaan',TRUE),
				'no_refrensi_item_pekerjaan'=>$this->input->post('no_refrensi_item_pekerjaan',TRUE),
				'nama_item_pekerjaan'=>$this->input->post('nama_item_pekerjaan',TRUE),
				'satuan'=>$this->input->post('satuan',TRUE)
			);
			$this->m_item_pekerjaan->update(array('id_item_pekerjaan' => $id), $data);
			echo json_encode(array("status"=>TRUE));
		}
		else
		{
			echo json_encode(array("status"=>FALSE));	
		}
	}
	function edit_item($id)
	{
		$data = $this->m_item_pekerjaan->edit($id);
		echo json_encode($data);
	}
	function delete_item($id)
	{
		$data = $this->m_item_pekerjaan->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	function get_all_sub($id)
	{
		$data = $this->m_sub_pekerjaan->get_all_id($id);
		echo json_encode($data);
	}
	function get_all_item($id)
	{
		$data = $this->m_item_pekerjaan->get_all_id($id);
		echo json_encode($data);
	}
}