<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_api extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	function cek($login){
		return $this->db->get_where('pengguna',$login)->num_rows();
	}
	function posisi($login)
	{
		return $this->db->get_where('pengguna',$login)->row();	
	}
	function pekerjaan($user_apa)
	{
		$a= array();
        $q = $this->db->get_where("new_pekerjaan_detail", $user_apa);

        foreach ($q->result() as $row) {

        	$proyeku = $row->proyek;
        	$id = $row->id;

        	$qu =  "SELECT SUM(persentase_detail) as bobotsdminggu, tanggalakhir FROM `new_bobot_uraian_kerja_dephub`JOIN new_pekerjaan_dephub ON new_pekerjaan_dephub.id = new_bobot_uraian_kerja_dephub.fk_idnew_pekerjaan_dephub join new_pekerjaan_detail on  new_pekerjaan_detail.proyek = new_pekerjaan_dephub.proyek WHERE new_pekerjaan_dephub.proyek= '{$proyeku}'";
			$query = $this->db->query($qu);
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $rowk) {

					$tgl = $rowk->tanggalakhir;
					$tanggal_akhir = new DateTime($tgl);
					$tanggal_now = new DateTime(); 
					$perbedaan = $tanggal_akhir->diff($tanggal_now);
					$tersisa = $perbedaan->days;
					$id_proyek =$id;

					$a[] =array("proyek"=>$proyeku,"total_bobot"=>number_format($rowk->bobotsdminggu, 1,',','.'), "tersisa"=>$tersisa,"idproyek"=>$id_proyek);
				}
			}
        }
        return $a;
	}

	function section($proyek) 
    {
        $query = "  SELECT section FROM new_pekerjaan where proyek = '{$proyek}' GROUP BY section";
        $daftar =  $this->db->query($query)->result();

        return $daftar;
    }

    function detailpekerjaanminggulalu($idkerja, $idminggu)
    {
        $volume_minggulalu =0;
        $minggu =0;

        $qyeri =  "SELECT minggu FROM `new_minggu` WHERE id = {$idminggu}";
        $query = $this->db->query($qyeri);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $rowk) {
                $minggu = $rowk->minggu;
            }
        }
        if ($minggu=="minggu ke- 1") {

            $kembali[] =array(
                "id" => 0,
                "proyek" => 0,
                "fk_id_minggu" => 0,
                "fk_id_new_pekerjaan" => 0,
                "volume_detail" => 0,
                "bobot_detail" => 0,
                "keterangan" => 0,
                "volume_akhir" => 0,
                "bobot_akhir" => 0
            );
        } elseif ($minggu!=="minggu ke- 1"){
            $idm = $idminggu-1;
            $quer =  "SELECT * FROM `new_bobot_uraian_kerja` WHERE fk_id_minggu = '$idm' AND fk_id_new_pekerjaan = '$idkerja'";
                $kembali = $this->db->query($quer)->result();
        }

        return $kembali;
    }

    // function detailpekerjaan2($proyek, $section, $idminggu, $pekerjaan)
    // {
    //     $volume_minggulalu =0;
    //     $minggu =0;

    //     $qyeri =  "SELECT minggu FROM `new_minggu` WHERE id = {$idminggu}";
    //     $query = $this->db->query($qyeri);
    //     if ($query->num_rows() > 0) {
    //         foreach ($query->result() as $rowk) {
    //             $minggu = $rowk->minggu;
    //         }
    //     }

    //     if ($minggu=="minggu ke- 1") {

    //         $kembali[] =array(
    //             "idkerja"=> 0,
    //             "uraian_pekerjaan"=> 0,
    //             "section"=> 0,
    //             "pekerjaan"=> 0,
    //             "satuan"=> 0,
    //             "volume"=> 0,
    //             "harga_satuan"=> 0,
    //             "nilai"=> 0,
    //             "bobot"=> 0,
    //             "proyek"=> 0,
    //             "uraianid"=> 0,
    //             "fk_id_minggu"=> 0,
    //             "fk_id_new_pekerjaan"=> 0,
    //             "volume_detail"=> 0,
    //             "bobot_detail"=> 0,
    //             "keterangan"=> 0,
    //             "volume_akhir"=> 0,
    //             "bobot_akhir"=> 0,
    //             "bobot_individu"=> 0
    //         );
    //     } elseif ($minggu!=="minggu ke- 1"){
    //         $idminggu = $idminggu-1;

    //         $sql ="SELECT new_pekerjaan.id as idkerja, new_pekerjaan.uraian_pekerjaan, new_pekerjaan.section,
    //             new_pekerjaan.pekerjaan, new_pekerjaan.satuan, new_pekerjaan.volume, new_pekerjaan.harga_satuan, 
    //             new_pekerjaan.nilai, new_pekerjaan.bobot, new_pekerjaan.proyek , new_bobot_uraian_kerja.id as uraianid,
    //             new_bobot_uraian_kerja.proyek, new_bobot_uraian_kerja.fk_id_minggu,
    //             new_bobot_uraian_kerja.fk_id_new_pekerjaan, new_bobot_uraian_kerja.volume_detail,
    //             new_bobot_uraian_kerja.bobot_detail, new_bobot_uraian_kerja.keterangan,
    //             new_bobot_uraian_kerja.volume_akhir, new_bobot_uraian_kerja.bobot_akhir, ROUND((new_bobot_uraian_kerja.bobot_akhir/new_pekerjaan.bobot)*100) as bobot_individu FROM new_pekerjaan 
    //             JOIN new_bobot_uraian_kerja ON new_pekerjaan.id = new_bobot_uraian_kerja.fk_id_new_pekerjaan 
    //             WHERE new_pekerjaan.pekerjaan = '$pekerjaan' AND new_pekerjaan.section = '$section' 
    //             AND new_pekerjaan.proyek = '$proyek' AND fk_id_minggu = {$idminggu} ORDER BY new_pekerjaan.id ASC";

    //             $kembali = $query = $this->db->query($sql)->result();
    //     }
    //     return $kembali;
    	
    // }

    function detailpekerjaan($proyek, $section, $idminggu, $pekerjaan)
    {
        $sql ="SELECT new_pekerjaan.id as idkerja, new_pekerjaan.uraian_pekerjaan, new_pekerjaan.section,
                new_pekerjaan.pekerjaan, new_pekerjaan.satuan, new_pekerjaan.volume, new_pekerjaan.harga_satuan, 
                new_pekerjaan.nilai, new_pekerjaan.bobot, new_pekerjaan.proyek , new_bobot_uraian_kerja.id as uraianid,
                new_bobot_uraian_kerja.proyek, new_bobot_uraian_kerja.fk_id_minggu,
                new_bobot_uraian_kerja.fk_id_new_pekerjaan, new_bobot_uraian_kerja.volume_detail,
                new_bobot_uraian_kerja.bobot_detail, new_bobot_uraian_kerja.keterangan,
                new_bobot_uraian_kerja.volume_akhir, new_bobot_uraian_kerja.bobot_akhir, ROUND((new_bobot_uraian_kerja.bobot_akhir/new_pekerjaan.bobot)*100) as bobot_individu, new_bobot_uraian_kerja.dokumentasi FROM new_pekerjaan 
                JOIN new_bobot_uraian_kerja ON new_pekerjaan.id = new_bobot_uraian_kerja.fk_id_new_pekerjaan 
                WHERE new_pekerjaan.pekerjaan = '$pekerjaan' AND new_pekerjaan.section = '$section' 
                AND new_pekerjaan.proyek = '$proyek' AND fk_id_minggu = {$idminggu} ORDER BY new_pekerjaan.id ASC";

        return $query = $this->db->query($sql)->result();
    }

    function subpekerjaan($section, $proyek)
    {
        $sql ="SELECT `pekerjaan` FROM `new_pekerjaan` WHERE section = '$section' and proyek = '$proyek' GROUP by pekerjaan ORDER BY id ASC";
    	return $query = $this->db->query($sql)->result();
    }

    public function kirim_laporan($proyek, $idminggu)
	{
		$query = "  UPDATE new_minggu_dephub set status_pengawas = 2, status_ppk = 1, status_kpa = 1, `tanggal_laporan`= NOW() where proyek = '{$proyek}' and id = {$idminggu}
		";
		$daftar =  $this->db->query($query);
		return $daftar;
	}
	
	public function kirim_laporan_revisi($proyek, $idminggu)
	{
	    $ttdpeng= "";

        $pro = "SELECT ttd_pengawas FROM `new_minggu_dephub` WHERE id = '$idminggu' ";
        $sanaa =  $this->db->query($pro);
          if ($sanaa->num_rows() > 0) {
            foreach ($sanaa->result() as $row) {
                $ttdpeng = $row->ttd_pengawas;
            }
        }
        //hapus yg lama
        $path = './upload/ttd/';
        @unlink($path.$ttdpeng);
	    
		$query = "  UPDATE new_minggu set status_pengawas = 2, status_ppk = 4, `tanggal_laporan`= NOW() where proyek = '{$proyek}' and id = {$idminggu}
		";
		$daftar =  $this->db->query($query);
		return $daftar;
	}
	
	public function tolak_laporan($alasan, $idminggu)
	{
		$query = "  UPDATE new_minggu set status_pengawas = 3, status_ppk = 3, alasan = '{$alasan}' where id = {$idminggu}
		";
		$daftar =  $this->db->query($query);
		return $daftar;
	} 

    public function kirim_laporan_pdf($idminggu, $namaPdf)
    {
        $nama_pdf= "";

        $pro = "SELECT pdf FROM `new_minggu_dephub` WHERE id = '$idminggu' ";
        $sanaa =  $this->db->query($pro);
          if ($sanaa->num_rows() > 0) {
            foreach ($sanaa->result() as $row) {
                $nama_pdf = $row->pdf;
            }
        }

        $path = './upload/laporan/';
        @unlink($path.$nama_pdf);

        $query = "UPDATE new_minggu set pdf = '{$namaPdf}' where id = {$idminggu}
        ";
        $daftar =  $this->db->query($query);
        return $daftar;
    }

    public function ubahpassword($id_user, $password)
    {
        $query = "UPDATE pengguna set password = '{$password}' where id = {$id_user}
        ";
        $daftar =  $this->db->query($query);
        return $daftar;
    }

    public function ubahprofil($id_user, $email, $nama, $nip)
    {
        $query = "UPDATE `pengguna` SET `nama`= '{$nama}',`email`='{$email}',`nip`='{$nip}' WHERE id = {$id_user}
        ";
        $daftar =  $this->db->query($query);

        return $daftar;
    }
    
    public function ubahprofilpengawas($id_user, $email, $nama, $jabatan)
    {
        $query = "UPDATE `pengguna` SET `nama`= '{$nama}',`email`='{$email}',`jabatan`='{$jabatan}' WHERE id = {$id_user}
        ";
        $daftar =  $this->db->query($query);

        return $daftar;
    }

    public function ubahbudget($id, $tgl, $kepada, $rincian, $nilai, $surat)
    {
        $uang_pelaksana = "";
        $uang_perencana = "";
        $uang_pengawas = "";
        $uang_perjalanan_dinas = "";
        $uang_honorium = "";
        $uang_habis_pakai = "";
        $proy= "";
        
        $nama_pdf= "";
        // $proyek= "Pembangunan  Sarana Dan Prasarana Air Bersih Ikk Srono";
        
        $prom = "SELECT proyek FROM `pembayaran_history` WHERE id = '$id' ";
        $sanaak =  $this->db->query($prom);
          if ($sanaak->num_rows() > 0) {
            foreach ($sanaak->result() as $row) {
                // $proy = $row->proyek;
                $proy = "Pembangunan  Sarana Dan Prasarana Air Bersih Ikk Srono";
            }
        }
        
        $pro = "SELECT surat FROM `pembayaran_history` WHERE id = '$id' ";
        $sanaa =  $this->db->query($pro);
          if ($sanaa->num_rows() > 0) {
            foreach ($sanaa->result() as $row) {
                $nama_pdf = $row->surat;
                // $proyek = "Pembangunan  Sarana Dan Prasarana Air Bersih Ikk Srono";
            }
        }
        
        $query = "UPDATE `pembayaran_history` SET `kategori`= '{$kepada}',`rincian`= '{$rincian}',`nilai`= '{$nilai}',`surat`='{$surat}',`tanggal`='{$tgl}', `tanggal_perubahan`= NOW() WHERE id = {$id}
        ";
        $daftar =  $this->db->query($query);
        
        $pelak = "SELECT sum(nilai) as uang FROM `pembayaran_history` WHERE proyek = '{$proy}' and kategori = 'pelaksana' ";
        $sana =  $this->db->query($pelak);
          if ($sana->num_rows() > 0) {
            foreach ($sana->result() as $row) {
                $uang_pelaksana = $row->uang;
            }
        }
        $peren = "SELECT sum(nilai) as uang FROM `pembayaran_history` WHERE proyek = '{$proy}' and kategori = 'perencana' ";
        $cana =  $this->db->query($peren);
          if ($cana->num_rows() > 0) {
            foreach ($cana->result() as $row) {
                $uang_perencana = $row->uang;
            }
        }
        $penga = "SELECT sum(nilai) as uang FROM `pembayaran_history` WHERE proyek = '{$proy}' and kategori = 'pengawas' ";
        $was =  $this->db->query($penga);
          if ($was->num_rows() > 0) {
            foreach ($was->result() as $row) {
                $uang_pengawas = $row->uang;
            }
        }
        $honor = "SELECT sum(nilai) as uang FROM `pembayaran_history` WHERE proyek = '{$proy}' and kategori = 'honorium' ";
        $rium =  $this->db->query($honor);
          if ($rium->num_rows() > 0) {
            foreach ($rium->result() as $row) {
                $uang_honorium = $row->uang;
            }
        }
        $perjalanan = "SELECT sum(nilai) as uang FROM `pembayaran_history` WHERE proyek = '{$proy}' and kategori = 'perjalanan_dinas' ";
        $dinas =  $this->db->query($perjalanan);
          if ($dinas->num_rows() > 0) {
            foreach ($dinas->result() as $row) {
                $uang_perjalanan_dinas = $row->uang;
            }
        }
        $habis = "SELECT sum(nilai) as uang FROM `pembayaran_history` WHERE proyek = '{$proy}' and kategori = 'habis_pakai' ";
        $pakai =  $this->db->query($habis);
          if ($pakai->num_rows() > 0) {
            foreach ($pakai->result() as $row) {
                $uang_habis_pakai = $row->uang;
            }
        }

        $query = "UPDATE `pembayaran` SET pelaksana = '$uang_pelaksana', pengawas = '$uang_pengawas', perencana = '$uang_perencana', honorium = '$uang_honorium', perjalanan_dinas = '$uang_perjalanan_dinas', habis_pakai = '$uang_habis_pakai' WHERE `pembayaran`.`proyek` = '$proy'
        ";
        $daftar4 =  $this->db->query($query);
        
        $path = './upload/surat/';
        @unlink($path.$nama_pdf);
        
        return $daftar4;
    }

    public function kirim_uang($proyek, $kategori, $uang, $rincian, $surat, $tanggal)
    {
        $fk_kontruksi=0;
        $sumuang=0;

        $query = "SELECT fk_id_kontruksi FROM `budgeting` WHERE proyek = '{$proyek}'
        ";
        $daftar =  $this->db->query($query);
          if ($daftar->num_rows() > 0) {
            foreach ($daftar->result() as $row) {
                $fk_kontruksi = $row->fk_id_kontruksi;
            }
        }
        $query2 = "INSERT INTO `pembayaran_history`(`fk_id_kontruksi_history`, `proyek`, `kategori`, `rincian`, `nilai`, `surat`, `tanggal`, `tanggal_perubahan`) VALUES ('{$fk_kontruksi}', '{$proyek}', '{$kategori}', '{$rincian}','{$uang}', '{$surat}', '{$tanggal}', NOW() )
        ";
        $daftar2 =  $this->db->query($query2);

        $query3 = "SELECT sum(nilai) as uang FROM `pembayaran_history` WHERE proyek = '{$proyek}' and kategori = '{$kategori}'";
        $daftar3 =  $this->db->query($query3);
          if ($daftar3->num_rows() > 0) {
            foreach ($daftar3->result() as $row) {
                $sumuang = $row->uang;
            }
        }

        $query = "UPDATE `pembayaran` SET `{$kategori}` = '$sumuang' WHERE `pembayaran`.`proyek` = '$proyek'
        ";
        $daftar4 =  $this->db->query($query);
        return $daftar4;
    }
    
    public function lihat_minggu($proyek)
    {
        $query = "SELECT id,minggu,tgl_awal,tgl_akhir,status_pengawas as status, alasan from new_minggu WHERE ( proyek = '{$proyek}' and status_pengawas = '0') OR ( proyek = '{$proyek}' and status_pengawas = '3')
        ";
        $daftar =  $this->db->query($query)->result();

        return $daftar;
    }

    public function lihatpdf($id)
    {
        $query = "SELECT pdf from new_minggu WHERE id = $id
        ";
        $daftar =  $this->db->query($query)->row();

        return $daftar;
    }

    public function lihatpdfdokumentasi($id)
    {
        $query = "SELECT pdfdokumentasi from new_minggu WHERE id = $id
        ";
        $daftar =  $this->db->query($query)->row();

        return $daftar;
    }

	public function lihat_laporan($status, $fk, $idfk)
    {
        $query = "SELECT new_minggu.id as id_minggu, new_minggu.minggu as minggu, new_pekerjaan_detail.proyek as nama_proyek, new_minggu.tgl_awal as tgl_pertama, new_minggu.tgl_akhir as tgl_kedua, ROUND(new_minggu.bobot_total, 3) as total_bobot
        ,new_minggu.{$status} as status, new_minggu.alasan FROM `new_minggu` JOIN new_pekerjaan_detail ON new_pekerjaan_detail.proyek = new_minggu.proyek WHERE ( new_minggu.{$status} = 1 AND new_pekerjaan_detail.{$fk}= {$idfk} ) 
        OR ( new_minggu.{$status} = 3 AND new_pekerjaan_detail.{$fk}= {$idfk} ) OR ( new_minggu.{$status} = 4 AND new_pekerjaan_detail.{$fk}= {$idfk} )
        ";
        $daftar =  $this->db->query($query)->result();

        return $daftar;
    }
    
    public function lihat_historypembayaran($proyek)
    {
        $query = "SELECT * FROM `pembayaran_history` WHERE proyek = '{$proyek}' ORDER BY `pembayaran_history`.`tanggal_perubahan` DESC
        ";
        $daftar =  $this->db->query($query)->result();

        return $daftar;
    }
    
    public function lihatprofil($id)
    {
        $query = "SELECT id,nama,email,nip,password,posisi,profil,jabatan FROM `pengguna` WHERE id = '{$id}'
        ";
        $daftar =  $this->db->query($query)->row();

        return $daftar;
    }

    public function cek_laporan($status, $posisinya, $id)
    {
    	$sql1 = "SELECT new_pekerjaan_detail.proyek, new_minggu.minggu FROM new_pekerjaan_detail join new_minggu on new_pekerjaan_detail.proyek = new_minggu.proyek WHERE new_pekerjaan_detail.{$posisinya} = '{$id}' AND new_minggu.{$status} = 1";

        $query1 = $this->db->query($sql1);
        if ($query1->num_rows() > 0) {
            $status = $query1->num_rows();
        }elseif ($query1->num_rows() == 0) {
            $status = 0;
        }

        return $status;
    }

    public function cek_history_laporan_minggu($status, $posisinya, $id)
    {
        $sql1 = "SELECT new_minggu.id, new_pekerjaan_detail.proyek, new_minggu.minggu, new_minggu.tgl_awal, new_minggu.tgl_akhir, ROUND(new_minggu.bobot_total, 3) as bobot_total, new_minggu.volume_total, new_minggu.pdf FROM new_pekerjaan_detail join new_minggu on new_pekerjaan_detail.proyek = new_minggu.proyek WHERE new_pekerjaan_detail.{$posisinya} = '{$id}' AND new_minggu.{$status} = 2";

        $query1 = $this->db->query($sql1);

        return $query1->result();
    }

    public function validasi_ppk($proyek, $idminggu, $ttd)
     {
        $query = "  UPDATE new_minggu set ttd_ppk = '$ttd', status_ppk = 2, status_kpa = 1, status_ppspm = 1, status_kasubdit = 1 
        where proyek = '{$proyek}' and id = {$idminggu}
        ";
        $daftar =  $this->db->query($query);

        return $daftar;

     }

    public function cek_validasi_laporan($status, $proyek, $idminggu)
     {
        $query = "  UPDATE new_minggu set {$status} = 2 where proyek = '{$proyek}' and id = {$idminggu}
        ";
        $daftar =  $this->db->query($query);
        return $daftar;
     }

    // public function ambil_uang($proyek)
    // {
    //     $query = "SELECT sum(pelaksana+pengawas+perencana+honorium+perjalanan_dinas+habis_pakai) as total_pembayaran FROM `pembayaran` WHERE proyek = '{$proyek}'
    //     ";
    //     $daftar =  $this->db->query($query)->result();

    //     $query2 = "SELECT Count(*) FROM new_pekerjaan WHERE proyek ='{$proyek}'
    //     ";
    //     $daftar2 =  $this->db->query($query2)->result();
        
    //     return $daftar;
    // }

    //buat pdf awal
    public function mingguke($mingguke)
    {
        $query = "SELECT *FROM `new_minggu_dephub` WHERE id = {$mingguke}
        ";
        $daftar =  $this->db->query($query)->row();

        return $daftar;
    }
    
    public function pekerjaandetail($id)
    {
        $query = "SELECT *FROM `new_pekerjaan_detail` WHERE id = {$id}
        ";
        $daftar =  $this->db->query($query)->row();

        return $daftar;
    }
    
    public function section0($proyek) 
    // pilihannya ada 2 ini dan yang bawah ini
    {
        # code...
        // $proyek = $this->input->post('proyek');

        $query = "  SELECT section FROM new_pekerjaan where proyek = '{$proyek}' GROUP BY section
        ";
        $daftar =  $this->db->query($query)->result_array();

        return $daftar;
    }
    public function section0dokumentasi($idminggu) 
    // pilihannya ada 2 ini dan yang bawah ini
    {
        # code...
        // $proyek = $this->input->post('proyek');

        $query = "  SELECT section FROM dokumentasi where idminggu = '{$idminggu}' GROUP BY section
        ";
        $daftar =  $this->db->query($query)->result_array();

        return $daftar;
    }
    public function datappk($proyek) 
    // pilihannya ada 2 ini dan yang bawah ini
    {
        $query = "SELECT * FROM `new_pekerjaan_detail` LEFT JOIN pengguna ON pengguna.id  = new_pekerjaan_detail.fk_id_ppk WHERE new_pekerjaan_detail.proyek ='{$proyek}'
        ";
        $daftar =  $this->db->query($query)->row();

        return $daftar;
    }

    public function datapengawas($proyek) 
    // pilihannya ada 2 ini dan yang bawah ini
    {
        $query = "SELECT * FROM `new_pekerjaan_detail` LEFT JOIN pengguna ON pengguna.id  = new_pekerjaan_detail.fk_id_pengawas WHERE new_pekerjaan_detail.proyek ='{$proyek}'
        ";
        $daftar =  $this->db->query($query)->row();

        return $daftar;
    }

    public function data_ttd($id_minggu) 
    // pilihannya ada 2 ini dan yang bawah ini
    {
        $query = "SELECT * FROM `new_minggu`WHERE id ='{$id_minggu}'
        ";
        $daftar =  $this->db->query($query)->row();
        return $daftar;
    }

    //buat pdf akhir
    
    //dokumentasi awal
    public function simpandokumentasi($subpekerjaan, $section, $idminggu, $foto, $tgl, $proyek){
        $query = "INSERT INTO `dokumentasi`(`foto`, `section`, `subpekerjaan`, `idminggu`, `tanggal`, `proyek`) VALUES ('{$foto}', '{$section}', '{$subpekerjaan}', '{$idminggu}', '{$tgl}', '{$proyek}')
        ";
		$daftar =  $this->db->query($query);
		return $daftar;
    }
    public function detailproyek($proyek){
        $query = "SELECT *FROM `new_pekerjaan_detail` WHERE proyek = '{$proyek}'
        ";
        $daftar =  $this->db->query($query)->row();

        return $daftar;
    }
    public function detailpengguna($proyek){
        $query = "SELECT fk_id_pengawas FROM `new_pekerjaan_detail` WHERE proyek = '{$proyek}'
        ";
        $daftar =  $this->db->query($query);

        if ($daftar->num_rows() > 0) {
            foreach ($daftar->result() as $row) {
                $query = "SELECT pengawas, logopengawas FROM `pengguna` WHERE id = '{$row->fk_id_pengawas}' ";
                $daftar =  $this->db->query($query)->row();
            }
        }
        return $daftar;
    }
    
    public function lihatdokumentasi($subpekerjaan, $section, $idminggu) 
    {
        $query = "SELECT * FROM dokumentasi where idminggu = '{$idminggu}' and `subpekerjaan` = '{$subpekerjaan}' and `section` = '{$section}'
        ";
        $daftar =  $this->db->query($query)->result_array();

        return $daftar;
    }
    
    public function ubahfoto($id, $foto) 
    {
        $query = "SELECT * FROM dokumentasi where idfoto = '{$id}'
        ";
        $daftar =  $this->db->query($query);
        if ($daftar->num_rows() > 0) {
            foreach ($daftar->result() as $row) {
                $path = './upload/dokumentasi/';
                @unlink($path.$row->foto);
                
                $queryq = "UPDATE `dokumentasi` SET `foto`= '{$foto}' WHERE `idfoto` = '{$id}'";
                $daftarq =  $this->db->query($queryq);
                return $daftarq;
            }
        }
    }
    
    public function hapusfoto($id) 
    {
        $query = "SELECT * FROM dokumentasi where idfoto = '{$id}'
        ";
        $daftar =  $this->db->query($query);
        if ($daftar->num_rows() > 0) {
            foreach ($daftar->result() as $row) {
                $path = './upload/dokumentasi/';
                @unlink($path.$row->foto);
                $queryq = "DELETE FROM `dokumentasi` WHERE `idfoto` = '{$id}'";
                $daftarq =  $this->db->query($queryq);
                return $daftarq;
            }
        }
    }
    //dokumentasi akhir
    
    public function cek_data($table,$where)
    {
        return $this->db->get_where($table,$where);
    }
    public function simpanlaporan($proyek, $idminggu)
    {
        $query = "insert into `new_bobot_uraian_kerja` (proyek, fk_id_minggu, fk_id_new_pekerjaan)
            SELECT new_pekerjaan.proyek, new_minggu.id, new_pekerjaan.id from `new_pekerjaan` JOIN new_minggu on new_pekerjaan.proyek = new_minggu.proyek WHERE new_pekerjaan.proyek = '{$proyek}' AND new_minggu.id = {$idminggu}
        ";
        $daftar2 =  $this->db->query($query);

        return $daftar2;
    }
    
    public function simpanprofil($namafoto, $id)
	{
	    $nama_foto= "";

        $pro = "SELECT profil FROM `pengguna` WHERE id = '$id' ";
        $sanaa =  $this->db->query($pro);
          if ($sanaa->num_rows() > 0) {
            foreach ($sanaa->result() as $row) {
                $nama_foto = $row->profil;
            }
        }

        $path = './upload/profil/';
        @unlink($path.$nama_foto);
	    
		$query = "  UPDATE pengguna set profil = '{$namafoto}' where id = '{$id}'
		";
		$daftar =  $this->db->query($query);
		return $daftar;
	}
    

}