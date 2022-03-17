<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pekerjaan_dephub extends CI_Controller {
	public function __construct(){
		parent::__construct();

		// load base_url
	    $this->load->helper('url');
 		$this->load->helper(array('form', 'url'));

	    // Load Model
	    $this->load->model('Main_model');
		$this->load->library(array('template','form_validation', 'pdff', 'pdffgen'));
		$this->load->model(array('m_api','m_pekerjaan','m_pekerjaan_dephub','m_sub_pekerjaan','m_item_pekerjaan'));
		if (!$this->hak->cek()){
			$this->session->sess_destroy();
			redirect(base_url());
			exit();
		}
    }

    public function new_aksi_upload()
    {
    	$data['title'] = 'Terminalku';

		$tanggalawal = $this->input->post('tanggalawal');
        $tanggalakhir = $this->input->post('tanggalakhir');

		if ($tanggalawal>$tanggalakhir) {
			echo "<script>alert('Tanggal awal tidak boleh lebih dari tanggal akhir');</script>";
		}else {
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
		                            $this->m_pekerjaan_dephub->insertRecord($userdata);
		                        }
		                        $skip ++;
		                    }
	            			$data['title'] = 'Upload berhasil';
	            			$data['response'] = 'successfully uploaded '.$filename;

	           				$this->m_pekerjaan_dephub->simpandetail();
						}else{ 
                        $data['title'] = 'Upload gagal'; 
						$data['response'] = 'failed save file into server'.$this->upload->display_errors(); 
						} 
			        }else{ 
                        $data['title'] = 'Upload gagal';
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

    function new_lihat_pekerjaan_mingguan()
	{
		$data['title'] = 'Proyek';

		$proyek = $this->input->post('proyek');
		$idminggu = $this->input->post('idminggu');

		$where = array(
			'proyek' => $proyek,
			'fk_id_minggu' => $idminggu
			);

		$cek = $this->m_pekerjaan->cek_laporan("new_bobot_uraian_kerja_dephub",$where)->num_rows();
		if($cek == 0){
			// dicek apakah data bobot uraian kerja dengan spesifikasi diatas sudah ada, jika nol maka insert data
	        $this->m_pekerjaan_dephub->simpanlaporan();
		}
		$data['idminggul'] = $idminggu;
		$data['proyek'] = $proyek;
		$iniminggu = $this->m_pekerjaan->mingguke($idminggu, $proyek);
		$data['minggu'] = $iniminggu->minggu;
		$data['datarencanaa'] = $this->m_pekerjaan->lihatbobotrencana($proyek);
        $data['datarealisasia'] = $this->m_pekerjaan->lihatbobotrealisasi($proyek);
        $data['dataminggua'] = $this->m_pekerjaan->lihatgrafikminggu($proyek);
		// $data['section0'] = $this->m_pekerjaan->section0($proyek);s

		// $this->template->display('content/pekerjaan/laporan_mingguan',$data);
		$this->template->display('content/pekerjaan/laporan_mingguan_ajax',$data);
	}

	function save_edit_ajax()
	{
		# code...
		$data['title'] = 'Proyek';

		$proyek = $this->input->post('dataproyek');
		$idminggu = $this->input->post('idminggu');
		$iduraian = $this->input->post('iduraian');
        $databobot = $this->input->post('databobot');
        $databobotasli = $this->input->post('bobotasli');
        $minggu = $this->input->post('datamingguke');

        // var_dump($databobot);
        // die();

        for($i=0;$i<sizeof($databobot);$i++)
	    {
	    	$bobotlalu = array();
	        $bobotsdminggu_ini = array();
            $bobot_persentasemingguini = array();
            $bobot_persentasesdminggu_ini = array();

	        // ambil data yang lalu
	        if ($minggu[$i] == "minggu ke- 1") {
            	$bobotlalu[$i] = 0;
	        } 
	        elseif ($minggu[$i] !== "minggu ke- 1"){
	            $idm[$i] = $idminggu[$i]-1;
	            $minggulalu[$i] =  "SELECT * FROM `new_bobot_uraian_kerja_dephub` WHERE fk_id_minggu = '$idm[$i]' AND fk_idnew_pekerjaan_dephub = '{$iduraian[$i]}' AND proyek = '{$proyek[$i]}'";
	            $query[$i] = $this->db->query($minggulalu[$i]);
	            if ($query[$i]->num_rows() > 0) {
	              foreach ($query[$i]->result() as $rowy[$i]) {
	                $bobotlalu[$i] = $rowy[$i]->persentase_akhir;
	              }
	          	}
	        }

	        // jumlahkan persentasenya
        	$bobotsdminggu_ini[$i] = $databobot[$i]+$bobotlalu[$i];
        	
        	if ($databobotasli[$i]=='0') {
                $bobot_persentasemingguini[$i] = 0;
                $bobot_persentasesdminggu_ini[$i] = 0;
            }else{
                $bobot_persentasemingguini[$i] = ($databobot[$i]/$databobotasli[$i])*100;
                $bobot_persentasesdminggu_ini[$i] = ($bobotsdminggu_ini[$i]/$databobotasli[$i])*100;
            }

	        $query[$i]="UPDATE `new_bobot_uraian_kerja_dephub` SET  `persentase_detail`= '{$databobot[$i]}', 
	        `persentase_akhir`= '{$bobotsdminggu_ini[$i]}', 
	        `bobot_persentase_detail`= '{$bobot_persentasemingguini[$i]}', 
	        `bobot_persentase_akhir`= '{$bobot_persentasesdminggu_ini[$i]}'
	        WHERE fk_idnew_pekerjaan_dephub = '{$iduraian[$i]}'
	        AND proyek = '{$proyek[$i]}'
	        AND fk_id_minggu = {$idminggu[$i]}";

	        $daftar2[$i] =  $this->db->query($query[$i]);

	    	}

	    $querya="SELECT SUM(persentase_akhir) as bobot_total, SUM(bobot_persentase_akhir) as bobot_persentase_total  FROM `new_bobot_uraian_kerja_dephub` WHERE fk_id_minggu = {$idminggu[0]} AND proyek = '{$proyek[0]}'";

        $daftar =  $this->db->query($querya)->row();

        //simpan ke mingguan total
        $databobot = $daftar->bobot_total;
        $databobot_persentase = $daftar->bobot_persentase_total;

        $querys="UPDATE `new_minggu_dephub` SET `persentase_total`= {$databobot}, `bobot_persentase_total`= {$databobot_persentase} WHERE id = {$idminggu[0]}";

        $daftar1 =  $this->db->query($querys);

		$data['idminggul'] = $idminggu[0];
		$data['proyek'] = $proyek[0];
		$iniminggu = $this->m_pekerjaan->mingguke($idminggu[0], $proyek[0]);
		$data['minggu'] = $iniminggu->minggu;

		$data['datarencanaa'] = $this->m_pekerjaan->lihatbobotrencana($proyek[0]);
        $data['datarealisasia'] = $this->m_pekerjaan->lihatbobotrealisasi($proyek[0]);
        $data['dataminggua'] = $this->m_pekerjaan->lihatgrafikminggu($proyek[0]);

		$this->template->display('content/pekerjaan/laporan_mingguan_ajax',$data);
	}

	function add_foto()
	{
		$content;
		$data['title'] = 'Proyek';
		$proyek = $this->input->post('proyek');
		$idminggu = $this->input->post('idminggu');

		$data['idminggul'] = $idminggu;
		$data['proyek'] = $proyek;
		$iniminggu = $this->m_pekerjaan->mingguke($idminggu, $proyek);
		$data['minggu'] = $iniminggu->minggu;

		$table_dokumentasi =  "SELECT * FROM `new_dokumentasi_dephub` WHERE fk_idminggu = '$idminggu' AND proyek = '{$proyek}'";
		$query = $this->db->query($table_dokumentasi);
        if ($query->num_rows() > 0) {
      		$data['tbl_dokumentasi'] = $this->m_pekerjaan_dephub->get_tbl_dokumentasi($idminggu,$proyek);
      		$content="content/pekerjaan/edit_laporan_dokumentasi";
      	}else{
      		$content="content/pekerjaan/laporan_dokumentasi";
      	}

		// nanti dicek apakah sudah ada id di minggu tsb pada table, kalo sudah maka edit

		$this->template->display($content,$data);
	}

	function upload_dokumentasi()
	{
		$config1['upload_path'] = './upload/dokumentasi';
        $config1['allowed_types'] = 'jpg|png|jpeg';
        $config1['max_size'] = '2048';  //2MB max
        $config1['max_width'] = '4480'; // pixel
        $config1['max_height'] = '4480'; // pixel
        $config1['file_name'] = $_FILES['fotopost1']['name'];

        $config2['upload_path'] = './upload/dokumentasi';
        $config2['allowed_types'] = 'jpg|png|jpeg';
        $config2['max_size'] = '2048';  //2MB max
        $config2['max_width'] = '4480'; // pixel
        $config2['max_height'] = '4480'; // pixel
        $config2['file_name'] = $_FILES['fotopost2']['name'];

        $config3['upload_path'] = './upload/dokumentasi';
        $config3['allowed_types'] = 'jpg|png|jpeg';
        $config3['max_size'] = '2048';  //2MB max
        $config3['max_width'] = '4480'; // pixel
        $config3['max_height'] = '4480'; // pixel
        $config3['file_name'] = $_FILES['fotopost3']['name'];

        $config4['upload_path'] = './upload/dokumentasi';
        $config4['allowed_types'] = 'jpg|png|jpeg';
        $config4['max_size'] = '2048';  //2MB max
        $config4['max_width'] = '4480'; // pixel
        $config4['max_height'] = '4480'; // pixel
        $config4['file_name'] = $_FILES['fotopost4']['name'];

        $config5['upload_path'] = './upload/dokumentasi';
        $config5['allowed_types'] = 'jpg|png|jpeg';
        $config5['max_size'] = '2048';  //2MB max
        $config5['max_width'] = '4480'; // pixel
        $config5['max_height'] = '4480'; // pixel
        $config5['file_name'] = $_FILES['fotopost5']['name'];

        $config6['upload_path'] = './upload/dokumentasi';
        $config6['allowed_types'] = 'jpg|png|jpeg';
        $config6['max_size'] = '2048';  //2MB max
        $config6['max_width'] = '4480'; // pixel
        $config6['max_height'] = '4480'; // pixel
        $config6['file_name'] = $_FILES['fotopost6']['name'];
        
        $this->upload->initialize($config1);
        $this->upload->do_upload('fotopost1');
		$foto1 = $this->upload->data();

        $this->upload->initialize($config2);
        $this->upload->do_upload('fotopost2');
		$foto2 = $this->upload->data();

        $this->upload->initialize($config3);
        $this->upload->do_upload('fotopost3');
		$foto3 = $this->upload->data();

        $this->upload->initialize($config4);
        $this->upload->do_upload('fotopost4');
		$foto4 = $this->upload->data();

        $this->upload->initialize($config5);
        $this->upload->do_upload('fotopost5');
		$foto5 = $this->upload->data();

        $this->upload->initialize($config6);
        $this->upload->do_upload('fotopost6');
		$foto6 = $this->upload->data();

        $data['keterangan1'] = $this->input->post('keterangan1');
        $data['keterangan2'] = $this->input->post('keterangan2');
        $data['keterangan3'] = $this->input->post('keterangan3');
        $data['keterangan4'] = $this->input->post('keterangan4');
        $data['keterangan5'] = $this->input->post('keterangan5');
        $data['keterangan6'] = $this->input->post('keterangan6');
		$data['proyek'] = $this->input->post('proyek');
		$data['fk_idminggu'] = $this->input->post('fk_idminggu');
        $data['foto1'] = $foto1['file_name'];
        $data['foto2'] = $foto2['file_name'];
        $data['foto3'] = $foto3['file_name'];
        $data['foto4'] = $foto4['file_name'];
        $data['foto5'] = $foto5['file_name'];
        $data['foto6'] = $foto6['file_name'];

		$this->m_pekerjaan_dephub->input_foto($data);
		$idminggu = $this->input->post('fk_idminggu');
		$proyek = $this->input->post('proyek');
		$data['idminggul'] = $idminggu;
		$data['proyek'] = $proyek;
		$iniminggu = $this->m_pekerjaan->mingguke($idminggu, $proyek);
		$data['minggu'] = $iniminggu->minggu;
		$this->template->display('content/pekerjaan/laporan_mingguan_ajax',$data);
	}

	function edit_upload_dokumentasi()
	{
		$id = $this->input->post('id');
	    $path = './upload/dokumentasi/';
	    $foto1;
	    $foto2;
	    $foto3;
	    $foto4;
	    $foto5;
	    $foto6;
	    
	    $config1['upload_path'] = './upload/dokumentasi';
        $config1['allowed_types'] = 'jpg|png|jpeg';
        $config1['max_size'] = '2048';  //2MB max
        $config1['max_width'] = '4480'; // pixel
        $config1['max_height'] = '4480'; // pixel
        $config1['file_name'] = $_FILES['fotopost1']['name'];

        $config2['upload_path'] = './upload/dokumentasi';
        $config2['allowed_types'] = 'jpg|png|jpeg';
        $config2['max_size'] = '2048';  //2MB max
        $config2['max_width'] = '4480'; // pixel
        $config2['max_height'] = '4480'; // pixel
        $config2['file_name'] = $_FILES['fotopost2']['name'];

        $config3['upload_path'] = './upload/dokumentasi';
        $config3['allowed_types'] = 'jpg|png|jpeg';
        $config3['max_size'] = '2048';  //2MB max
        $config3['max_width'] = '4480'; // pixel
        $config3['max_height'] = '4480'; // pixel
        $config3['file_name'] = $_FILES['fotopost3']['name'];

        $config4['upload_path'] = './upload/dokumentasi';
        $config4['allowed_types'] = 'jpg|png|jpeg';
        $config4['max_size'] = '2048';  //2MB max
        $config4['max_width'] = '4480'; // pixel
        $config4['max_height'] = '4480'; // pixel
        $config4['file_name'] = $_FILES['fotopost4']['name'];

        $config5['upload_path'] = './upload/dokumentasi';
        $config5['allowed_types'] = 'jpg|png|jpeg';
        $config5['max_size'] = '2048';  //2MB max
        $config5['max_width'] = '4480'; // pixel
        $config5['max_height'] = '4480'; // pixel
        $config5['file_name'] = $_FILES['fotopost5']['name'];

        $config6['upload_path'] = './upload/dokumentasi';
        $config6['allowed_types'] = 'jpg|png|jpeg';
        $config6['max_size'] = '2048';  //2MB max
        $config6['max_width'] = '4480'; // pixel
        $config6['max_height'] = '4480'; // pixel
        $config6['file_name'] = $_FILES['fotopost6']['name'];

        if (!empty($_FILES['fotopost1']['name'])) {
        	$this->upload->initialize($config1);
            if ($this->upload->do_upload('fotopost1') ) {
                $foto1 = $this->upload->data();
                $foto1 = $foto1['file_name'];
            }else{
              die("Gagal menyimpan foto ke 1");
            }
        }else {
            $foto1 = $this->input->post('filelama1');
        }

        if (!empty($_FILES['fotopost2']['name'])) {
        	$this->upload->initialize($config2);
            if ($this->upload->do_upload('fotopost2') ) {
                $foto2 = $this->upload->data();
                $foto2 = $foto2['file_name'];

            }else{
              die("Gagal menyimpan foto ke 2");
            }
        }else {
            $foto2 = $this->input->post('filelama2');
        }

        if (!empty($_FILES['fotopost3']['name'])) {
        	$this->upload->initialize($config3);
            if ($this->upload->do_upload('fotopost3') ) {
                $foto3 = $this->upload->data();
                $foto3 = $foto3['file_name'];
            }else{
              die("Gagal menyimpan foto ke 3");
            }
        }else {
            $foto3 = $this->input->post('filelama3');
        }

        if (!empty($_FILES['fotopost4']['name'])) {
        	$this->upload->initialize($config4);
            if ($this->upload->do_upload('fotopost4') ) {
                $foto4 = $this->upload->data();
                $foto4 = $foto4['file_name'];
            }else{
              die("Gagal menyimpan foto ke 4");
            }
        }else {
            $foto4 = $this->input->post('filelama4');
        }

        if (!empty($_FILES['fotopost5']['name'])) {
        	$this->upload->initialize($config5);
            if ($this->upload->do_upload('fotopost5') ) {
                $foto5 = $this->upload->data();
                $foto5 = $foto5['file_name'];
            }else{
              die("Gagal menyimpan foto ke 5");
            }
        }else {
            $foto5 = $this->input->post('filelama5');
        }

        if (!empty($_FILES['fotopost6']['name'])) {
        	$this->upload->initialize($config6);
            if ($this->upload->do_upload('fotopost6') ) {
                $foto6 = $this->upload->data();
                $foto6 = $foto6['file_name'];
            }else{
              die("Gagal menyimpan foto ke 6");
            }
        }else {
            $foto6 = $this->input->post('filelama6');
        }
    	$data['keterangan1'] = $this->input->post('keterangan1');
        $data['keterangan2'] = $this->input->post('keterangan2');
        $data['keterangan3'] = $this->input->post('keterangan3');
        $data['keterangan4'] = $this->input->post('keterangan4');
        $data['keterangan5'] = $this->input->post('keterangan5');
        $data['keterangan6'] = $this->input->post('keterangan6');
		$data['proyek'] = $this->input->post('proyek');
		$data['fk_idminggu'] = $this->input->post('fk_idminggu');
        $data['foto1'] = $foto1;
        $data['foto2'] = $foto2;
        $data['foto3'] = $foto3;
        $data['foto4'] = $foto4;
        $data['foto5'] = $foto5;
        $data['foto6'] = $foto6;

    	$this->m_pekerjaan_dephub->update_dokumentasi($data, $id);

		$idminggu = $this->input->post('fk_idminggu');
		$proyek = $this->input->post('proyek');
		$data['idminggul'] = $idminggu;
		$data['proyek'] = $proyek;
		$iniminggu = $this->m_pekerjaan->mingguke($idminggu, $proyek);
		$data['minggu'] = $iniminggu->minggu;
		$this->template->display('content/pekerjaan/laporan_mingguan_ajax',$data);
	}

	function keterangan_deviasi($id_minggu)
	{
        $data['title'] = 'Deviasi';
        $data['minggu'] = $this->m_pekerjaan->ket_deviasi($id_minggu);

        $this->template->display('content/pekerjaan/keterangan_deviasi',$data);
	}

    public function save_deviasi()
    {
        $idminggu = $this->input->post('id_minggu');
        
        $dataa['masalah'] = $this->input->post('masalah');
        $dataa['solusi'] = $this->input->post('solusi');
        $this->m_pekerjaan->update_deviasi($dataa, $idminggu);

        $statusku = "";
        $proyek = "";
        $apakah_sudah = "";
        $signatureFileName = "";

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
}