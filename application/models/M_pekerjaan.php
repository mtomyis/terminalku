<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_pekerjaan extends CI_Model 
{	
	var $table = 'pekerjaan';
	var $id_key = "id_pekerjaan";

    var $namaproyek = "proyek";
    var $tablebaru = "new_pekerjaan";

    var $column_order = array('id_pekerjaan',null);
    var $column_search = array('nama_pekerjaan','lokasi');
    var $order = array('id_pekerjaan' => 'DESC');
	function __construct()
	{
        $this->load->library('upload');
		parent::__construct();
		$this->load->database();
	}

    //new
    public function section0($proyek) 
    // pilihannya ada 2 ini dan yang bawah ini
    {
        # code...
        // $proyek = $this->input->post('proyek');

        $query = "  SELECT section FROM new_pekerjaan_dephub where proyek = '{$proyek}' GROUP BY section ORDER BY id
        ";
        $daftar =  $this->db->query($query)->result_array();

        return $daftar;
    }
    public function tandatangandireksi($proyek) 
    // pilihannya ada 2 ini dan yang bawah ini
    {
        # code...
        // $proyek = $this->input->post('proyek');
        $direksi = "Direksi / Pengawas";
        $query = " SELECT pengguna.nama, pengguna.nip, pengguna.posisi, pengguna.proyek, new_pekerjaan_detail.lokasi, new_pekerjaan_detail.pelaksana, new_pekerjaan_detail.tanggalawal, new_pekerjaan_detail.tanggalakhir FROM pengguna join new_pekerjaan_detail ON new_pekerjaan_detail.proyek = pengguna.proyek WHERE pengguna.proyek = '{$proyek}' AND pengguna.posisi = '{$direksi}'
        ";
        $daftar =  $this->db->query($query)->row();

        return $daftar;
    }
    public function tandatanganpelaksana($proyek) 
    // pilihannya ada 2 ini dan yang bawah ini
    {
        # code...
        // $proyek = $this->input->post('proyek');
        $direksi = "Manajer Proyek / Pelaksana";
        $query = " SELECT pengguna.nama, pengguna.nip, pengguna.posisi, pengguna.proyek, new_pekerjaan_detail.lokasi, new_pekerjaan_detail.pelaksana, new_pekerjaan_detail.tanggalawal, new_pekerjaan_detail.tanggalakhir FROM pengguna join new_pekerjaan_detail ON new_pekerjaan_detail.proyek = pengguna.proyek WHERE pengguna.proyek = '{$proyek}' AND pengguna.posisi = '{$direksi}'
        ";
        $daftar =  $this->db->query($query)->row();

        return $daftar;
    }
    

    

    public function kosongkanjuga($proyek)
    {
        # code...
        $query = "  DELETE FROM new_pekerjaan_detail where proyek = '{$proyek}'
        ";
        $daftar2 =  $this->db->query($query);

        return $daftar2;
    }

    public function kosongkansaja($proyek,$idminggu)
    {
        # code...
        $query = "  DELETE FROM new_bobot_uraian_kerja where proyek = '{$proyek}' and fk_id_minggu = {$idminggu}
        ";
        $daftar2 =  $this->db->query($query);

        return $daftar2;
    }

    public function kosongkan($proyek)
    {
        # code...
        // $this->db->where($this->namaproyek, $proyek);
        // $this->db->delete($this->tablebaru);
        // $proyek = $this->input->post('proyek');

        $query = "  DELETE FROM new_pekerjaan_detail where proyek = '{$proyek}'
        ";
        $daftar =  $this->db->query($query);

        $query = "  DELETE FROM new_pekerjaan_dephub where proyek = '{$proyek}'
        ";
        $daftar2 =  $this->db->query($query);

        $query = "  DELETE FROM new_minggu_dephub where proyek = '{$proyek}'
        ";
        $daftar2 =  $this->db->query($query);

        $query = "  DELETE FROM new_bobot_uraian_kerja_dephub where proyek = '{$proyek}'
        ";
        $daftar2 =  $this->db->query($query);


        $query = "  DELETE FROM pembayaran where proyek = '{$proyek}'
        ";
        $daftar =  $this->db->query($query);

        $query = "  DELETE FROM budgeting where proyek = '{$proyek}'
        ";
        $daftar =  $this->db->query($query);

        $query = "  DELETE FROM budgeting_kontruksi where proyek = '{$proyek}'
        ";
        $daftar =  $this->db->query($query);
        
        $query = "  DELETE FROM pembayaran_history where proyek = '{$proyek}'
        ";
        $daftar =  $this->db->query($query);
        
        $query = "  DELETE FROM new_dokumentasi_dephub where proyek = '{$proyek}'
        ";
        $daftar =  $this->db->query($query);

        return $daftar;
    }

    function insertRecord($record){
                    
        $proyek = $this->input->post('proyek');

        if(count($record) > 0){
            
            // Check user
            // $this->db->select('*');
            // $this->db->where('uraian_pekerjaan', $record[0]);
            // $q = $this->db->get('new_pekerjaan');
            // $response = $q->result_array();
            
            // Insert record
            // if(count($response) == 0){
            //     $newuser = array(
            //         "uraian_pekerjaan" => trim($record[0]),
            //         "section" => trim($record[1]),
            //         "pekerjaan" => trim($record[2]),
            //         "satuan" => trim($record[3]),
            //         "volume" => trim($record[4]),
            //         "harga_satuan" => trim($record[5]),
            //         "nilai" => trim($record[6]),
            //         "bobot" => trim($record[7]),
            //         $proyek
            //     );

            //     $this->db->insert('pekerjaan', $newuser);
            // }

            // if(count($response) == 0){
                
            $sql = "insert into new_pekerjaan (uraian_pekerjaan, section, pekerjaan, satuan, volume, harga_satuan, nilai, bobot, proyek) values (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $this->db->query($sql,array(
                    "uraian_pekerjaan" => trim($record[0]),
                    "section" => trim($record[1]),
                    "pekerjaan" => trim($record[2]),
                    "satuan" => trim($record[3]),
                    "volume" => trim($record[4]),
                    "harga_satuan" => trim($record[5]),
                    "nilai" => trim($record[6]),
                    "bobot" => trim($record[7]),
                    $proyek
                ));
            // }
            
        }
    }

    public function simpandetail()
    {
        $tgl1;
        $bln1;
        $thn1;
        $date2;
        $date1;
        $uang;
        $bulat=0;
        $total_bulat=0;

        $proyek = $this->input->post('proyek');
        $lokasi = $this->input->post('lokasi');
        $pelaksana = $this->input->post('pelaksana');
        $tanggalawal = $this->input->post('tanggalawal');
        $tanggalakhir = $this->input->post('tanggalakhir');
        $unitkerja = $this->input->post('unitkerja');
        
        # code...
        $data = array
            (
                'proyek'=>$proyek,
                'lokasi'=>$lokasi,
                'pelaksana'=>$pelaksana,
                'tanggalawal'=>$tanggalawal,
                'tanggalakhir'=>$tanggalakhir,
                'unitkerja'=>$unitkerja
            );
            $this->db->insert('new_pekerjaan_detail',$data);

        $sql ="SELECT SUM(nilai) as uang FROM new_pekerjaan where proyek = '{$proyek}'";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
              foreach ($query->result() as $row) {                
                $uang = $row->uang*1.1;

                $ambilnilai = (round($uang -1));
                $ambilnilaiatas = substr($ambilnilai,0, -3);
                $ambilnilaibawah = substr($ambilnilai, -3);

                if ($ambilnilaibawah <= 999){
                  $nilaiasli = $ambilnilaiatas."000";
                  $uang = $nilaiasli;
                }
                }
            }

        $fk_id_kontruksi = date("Y.m.d.H.i.s");

        $data2 = array(
            'proyek' => $proyek,
            'biaya_kontruksi' => $uang,
            'biaya_total' =>$uang,
            'fk_id_kontruksi' => $fk_id_kontruksi
        );
        $this->db->insert('budgeting',$data2);

        $data3 = array(
            'proyek' => $proyek,
            'id_kontruksi' =>  $fk_id_kontruksi,
            'pelaksana' => $uang
        );
        $this->db->insert('budgeting_kontruksi',$data3);

        $data4 = array(
            'proyek' => $proyek
        );
        $this->db->insert('pembayaran',$data4);

        // belum sppn 10%

            // jika sudah tersimpan maka

        $sql ="SELECT YEAR(tanggalawal) as thn FROM new_pekerjaan_detail where proyek = '{$proyek}';";
        $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                $thn1 = $row->thn;
        }
        }
        $sql ="SELECT MONTH(tanggalawal) as bln FROM new_pekerjaan_detail where proyek = '{$proyek}';";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
              foreach ($query->result() as $row) {
              $bln1 = $row->bln;
        }
        }
        $sql ="SELECT DAY(tanggalawal) as tgl FROM new_pekerjaan_detail where proyek = '{$proyek}';";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
              foreach ($query->result() as $row) {
              $tgl1 = $row->tgl;
        }
        }
        $sql ="SELECT date_format(tanggalawal, '%d-%m-%Y') as tglawal FROM new_pekerjaan_detail where proyek = '{$proyek}';";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
              foreach ($query->result() as $row) {
              $date1 = $row->tglawal;
        }
        }
        $sql ="SELECT date_format(tanggalakhir, '%d-%m-%Y') as tglakhir FROM new_pekerjaan_detail where proyek = '{$proyek}';";
            $query = $this->db->query($sql);
            if ($query->num_rows() > 0) {
              foreach ($query->result() as $row) {
              $date2 = $row->tglakhir;
        }
        }

        $i = 0;
         
        // counter untuk jumlah hari minggu
        $sum = 0;
         
        do
        {
           //jika failed again nanti ganti uabh disini jika udah 7 hari
           // mengenerate tanggal berikutnya
           $tanggal = date("d-m-Y", mktime(0, 0, 0, $bln1, $tgl1+$i, $thn1));
           // cek jika harinya minggu, maka counter $sum bertambah satu, lalu tampilkan tanggalnya
           if (date("w", mktime(0, 0, 0, $bln1, $tgl1+$i, $thn1)) == 0)
           {
            $sum++;
            $minggus = "minggu ke- ".$sum; //ini disimpan
            $tanggals = $tanggal; //ini disimpan

            $tanggall = strtotime($tanggal); 
            $tanggal_akhirs = date('Y-m-d', $tanggall);

            $tanggalll = strtotime("-6 day", $tanggall);
            $tanggal_awals = date('Y-m-d', $tanggalll); //ini disimpan

            $datas = array
            (
                'proyek'=>$proyek,
                'minggu'=>$minggus,
                'tgl_awal'=>$tanggal_awals,
                'tgl_akhir'=>$tanggal_akhirs
            );
            $this->db->insert('new_minggu', $datas);
             // var_dump($tanggal);
           }  
         
           // increment untuk counter looping
           $i++;
        }
        while ($tanggal != $date2);
        // this simpan proyek sama data diatas
    }

    function insertRecord_editcsv($record){

        $proyek = $this->input->post('proyek');

        
        if(count($record) > 0){

            

            $sql = "insert into new_pekerjaan (uraian_pekerjaan, section, pekerjaan, satuan, volume, harga_satuan, nilai, bobot, proyek) values (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $this->db->query($sql,array(
                "uraian_pekerjaan" => trim($record[0]),
                "section" => trim($record[1]),
                "pekerjaan" => trim($record[2]),
                "satuan" => trim($record[3]),
                "volume" => trim($record[4]),
                "harga_satuan" => trim($record[5]),
                "nilai" => trim($record[6]),
                "bobot" => trim($record[7]),
                $proyek
            ));            
        }        
    }


    public function simpandetail_editcsv()
    {
    // insert ganti update
    // new_bobot_uraian_kerja cekdulu kemudian update atau hapus
    //budgeting updatepelaksana, ubah biaya kontruksi, ubah biaya total
        $uang;
        $uangkontruksi;

        $bulat=0;
        $total_bulat=0;

        $proyek = $this->input->post('proyek');

        $sql ="SELECT SUM(nilai) as uang FROM new_pekerjaan where proyek = '{$proyek}'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {                
        $uang = $row->uang*1.1;

        $ambilnilai = (round($uang -1));
        $ambilnilaiatas = substr($ambilnilai,0, -3);
        $ambilnilaibawah = substr($ambilnilai, -3);

            if ($ambilnilaibawah <= 999){
            $nilaiasli = $ambilnilaiatas."000";
            $uang = $nilaiasli;
            }
        }
        }

        // update pelaksana dulu
        $dataa = array(
        'pelaksana' => $uang
        );
        $this->db->where('proyek', $proyek);
        $this->db->update('budgeting_kontruksi', $dataa);

        //jumlahkan biaya kontruksi dan update
        $sql ="SELECT perencana+pengawas+pelaksana as biaya_kontruksi FROM `budgeting_kontruksi` where proyek = '$proyek'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $uangkontruksi = $row->biaya_kontruksi;

                //update biaya kontruksi budgetting
                $dataa = array(
                'biaya_kontruksi' => $uangkontruksi
                );
                $this->db->where('proyek', $proyek);
                $this->db->update('budgeting', $dataa);
            }
        }    

        //jumlahkan biaya total
        $sql ="SELECT biaya_kontruksi+biaya_honorium+biaya_perjalanan+biaya_habis_pakai as biaya_total FROM `budgeting` where proyek = '$proyek'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {

                //update biaya total budgetting
                $dataa = array(
                'biaya_total' => $row->biaya_total
                );
                $this->db->where('proyek', $proyek);
                $this->db->update('budgeting', $dataa);
            }
        }
        
        // insert history edit csv dan adendum, arahkan ke minggu 7 misal
        // $datas = array
        // (
        //     'proyek'=>$proyek,
        //     'minggu'=>$minggus,
        //     'tgl_awal'=>$tanggal_awals,
        //     'tgl_akhir'=>$tanggal_akhirs
        // );
        // $this->db->insert('new_minggu', $datas);

    }

    public function cek_laporan($table,$where)
    {
        return $this->db->get_where($table,$where);
    }

    public function hapusbobot_uraian_daninsert($proyek, $idminggu)
    {
        // hapus semua di bobot uraian
        $query = "  DELETE FROM new_bobot_uraian_kerja where proyek = '{$proyek}'
        ";
        $daftar2 =  $this->db->query($query);

        // insert yang ke 7
        $query2 = "insert into `new_bobot_uraian_kerja` (proyek, fk_id_minggu, fk_id_new_pekerjaan)
            SELECT new_pekerjaan.proyek, new_minggu.id, new_pekerjaan.id from `new_pekerjaan` JOIN new_minggu on new_pekerjaan.proyek = new_minggu.proyek WHERE new_pekerjaan.proyek = '{$proyek}' AND new_minggu.id = {$idminggu}
        ";
        $daftar =  $this->db->query($query2);
    }

    public function simpanlaporan()
    {
        $proyek = $this->input->post('proyek');
        $idminggu = $this->input->post('idminggu');

        $query = "insert into `new_bobot_uraian_kerja` (proyek, fk_id_minggu, fk_id_new_pekerjaan)
            SELECT new_pekerjaan.proyek, new_minggu.id, new_pekerjaan.id from `new_pekerjaan` JOIN new_minggu on new_pekerjaan.proyek = new_minggu.proyek WHERE new_pekerjaan.proyek = '{$proyek}' AND new_minggu.id = {$idminggu}
        ";
        $daftar2 =  $this->db->query($query);

        return $daftar2;
    }

    public function simpandatabobotacuan()
    {
        $idminggu = $this->input->post('idminggu');
        $datamingguke = $this->input->post('datamingguke');
        $databobotacuan = $this->input->post('databobotacuan');

        $bobotacuan = 0;
        $bobotkomulatif = 0;

        if ($datamingguke == "minggu ke- 1") {
            $bobotkomulatif = $databobotacuan;
            $bobotacuan = $databobotacuan;
            // update datanya
        }else{
            $idm = $idminggu-1;
            $sql = "SELECT * FROM new_minggu_dephub where id = $idm";
            $query =  $this->db->query($sql);
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $rowy) {
                    $bobotkomulatif = $rowy->bobot_persentase_total_acuan_komulatif+$databobotacuan;
                    $bobotacuan = $databobotacuan;
                    // update datanya
                }
            }
        }

        $querysql="UPDATE `new_minggu_dephub` SET  `bobot_persentase_total_acuan`= '{$bobotacuan}',  `bobot_persentase_total_acuan_komulatif`= '{$bobotkomulatif}' WHERE id = $idminggu";
        $jos =  $this->db->query($querysql);
    }

    

    public function simpandataku()
    {
        $iduraian = $this->input->post('iduraian');
        $volume = $this->input->post('datavolume');
        $volumeasli = $this->input->post('datavolumeasli');
        $bobotasli = $this->input->post('databobotasli');
        $keterangan = $this->input->post('dataketerangan');
        $idminggu = $this->input->post('idminggu');
        $proyek = $this->input->post('dataproyek');
        $minggu = $this->input->post('datamingguke');

        $volumelalu=0;
        $bobotsdminggu_ini=0;
        $bobotminggu_ini=0;
        $volumesdminggu_ini=0;


        if ($minggu=="minggu ke- 1") {
            $volumelalu = 0;
        } 
        elseif ($minggu!=="minggu ke- 1"){
            $idm = $idminggu-1;
            $minggulalu =  "SELECT * FROM `new_bobot_uraian_kerja` WHERE fk_id_minggu = '$idm' AND fk_id_new_pekerjaan = '{$iduraian}' AND proyek = '{$proyek}'";
            $query = $this->db->query($minggulalu);
            if ($query->num_rows() > 0) {
              foreach ($query->result() as $rowy) {
                $volumelalu = $rowy->volume_akhir;
              }}
        }

        $volumesdminggu_ini = $volume+$volumelalu;

        // jika volume melebihi volume asli, maka gagal meyimpan
        if ($volumesdminggu_ini > $volumeasli) {
            echo "<script> alert('Data volume berlebih, harap masukkan data lagi');</script>";
        }
        elseif ($volumesdminggu_ini <= $volumeasli){

        $bobotminggu_ini = ($volume/$volumeasli)*$bobotasli;
        $bobotsdminggu_ini = ($volumesdminggu_ini/$volumeasli)*$bobotasli;
        // $iduraian = 190;
        // $volume = 8;
        // $bobot = 9;
        // $keterangan = "sdff";
        // $idminggu = 49;

        // $query="UPDATE `new_bobot_uraian_kerja` SET  `volume_detail`= '{$volume}', `keterangan`= '{$keterangan}', WHERE id = '{$iduraian}'";

        $query="UPDATE `new_bobot_uraian_kerja` SET  `volume_detail`= '{$volume}',  `bobot_detail`= '{$bobotminggu_ini}' ,`keterangan`= '{$keterangan}', `volume_akhir`= '{$volumesdminggu_ini}',  `bobot_akhir`= '{$bobotsdminggu_ini}' WHERE fk_id_new_pekerjaan = '{$iduraian}' AND proyek = '{$proyek}' AND fk_id_minggu = {$idminggu}";

        $daftar2 =  $this->db->query($query);

        // __________________________________________simpan ke uraian detail
        $querya="SELECT SUM(volume_akhir) as volume_total, SUM(bobot_akhir) as bobot_total FROM `new_bobot_uraian_kerja` WHERE fk_id_minggu = {$idminggu} AND proyek = '{$proyek}'";

        $daftar =  $this->db->query($querya)->row();

        // // __________________________________________simpan ke mingguan total
        $databobot = $daftar->bobot_total;
        $datavolume = $daftar->volume_total;

        $querys="UPDATE `new_minggu` SET `volume_total`= {$datavolume},`bobot_total`= {$databobot} WHERE id = {$idminggu}";

        $daftar1 =  $this->db->query($querys);

        }
    }

    public function simpandataku_edit_csv()
    {
        $iduraian = $this->input->post('iduraian');
        $volume = $this->input->post('datavolume');
        $volumeasli = $this->input->post('datavolumeasli');
        $bobotasli = $this->input->post('databobotasli');
        $keterangan = $this->input->post('dataketerangan');
        $idminggu = $this->input->post('idminggu');
        $proyek = $this->input->post('dataproyek');
        $minggu = $this->input->post('datamingguke');

        $volumelalu=0;
        $bobotsdminggu_ini=0;
        $bobotminggu_ini=0;
        $volumesdminggu_ini=0;

        $volumesdminggu_ini = $volume;

        if ($volumesdminggu_ini > $volumeasli) {
            echo "<script> alert('Data volume berlebih, harap masukkan data lagi');</script>";
        }
        elseif ($volumesdminggu_ini <= $volumeasli){

        $bobotminggu_ini = ($volume/$volumeasli)*$bobotasli;
        $bobotsdminggu_ini = ($volumesdminggu_ini/$volumeasli)*$bobotasli;

        $query="UPDATE `new_bobot_uraian_kerja` SET  `volume_detail`= '{$volume}',  `bobot_detail`= '{$bobotminggu_ini}' ,`keterangan`= '{$keterangan}', `volume_akhir`= '{$volumesdminggu_ini}',  `bobot_akhir`= '{$bobotsdminggu_ini}' WHERE fk_id_new_pekerjaan = '{$iduraian}' AND proyek = '{$proyek}' AND fk_id_minggu = {$idminggu}";

        $daftar2 =  $this->db->query($query);

        // __________________________________________simpan ke uraian detail
        $querya="SELECT SUM(volume_akhir) as volume_total, SUM(bobot_akhir) as bobot_total FROM `new_bobot_uraian_kerja` WHERE fk_id_minggu = {$idminggu} AND proyek = '{$proyek}'";

        $daftar =  $this->db->query($querya)->row();

        // __________________________________________simpan ke mingguan total
        $databobot = $daftar->bobot_total;
        $datavolume = $daftar->volume_total;

        $querys="UPDATE `new_minggu` SET `volume_total`= {$datavolume},`bobot_total`= {$databobot} WHERE id = {$idminggu}";

        $daftar1 =  $this->db->query($querys);

        }
    }

    public function mingguke($mingguke, $proyek)
    {
        $query = "  SELECT * FROM `new_minggu_dephub` WHERE id = {$mingguke} AND proyek= '{$proyek}'
        ";
        $daftar =  $this->db->query($query)->row();

        return $daftar;
    }

    public function ket_deviasi($idminggu)
    {
        $query = "  SELECT * FROM `new_minggu_dephub` WHERE id = {$idminggu}
        ";
        $daftar =  $this->db->query($query)->row();

        return $daftar;
    }

    public function get_proyek()
    {
        $query = "  SELECT proyek FROM new_pekerjaan GROUP BY proyek
        ";
        $daftar =  $this->db->query($query)->result();

        return $daftar;
    }

    public function new_new_get_proyek_order()
    {
        $query = "  SELECT proyek FROM new_pekerjaan_dephub GROUP BY proyek
        ";
        $daftar =  $this->db->query($query)->result_array();

        return $daftar;
    }

    public function new_new_get_proyek_order_ppk()
    {
        $id_ppk = $this->session->userdata('id');
        $query = "SELECT * FROM `new_pekerjaan_detail` WHERE fk_id_ppk = {$id_ppk}
        ";
        $daftar =  $this->db->query($query)->result_array();

        return $daftar;
    }

    public function new_new_get_addendum($id_ppk)
    {
        $query = "SELECT new_request_addendum.id as id_add, new_request_addendum.proyek as proyekadd, new_request_addendum.fk_id_ppk as ppk, new_pekerjaan_detail.id as idproyek, `surat`, `xls`, `status`, `tanggal_request`, `tanggal_selesai` FROM `new_request_addendum` join new_pekerjaan_detail on new_pekerjaan_detail.proyek = new_request_addendum.proyek where new_request_addendum.fk_id_ppk = {$id_ppk} ORDER BY tanggal_request DESC
        ";
        $daftar =  $this->db->query($query)->result();

        return $daftar;
    }

    public function new_new_get_detail()
    {
        $query = "  SELECT*FROM new_pekerjaan_detail
        ";
        $daftar =  $this->db->query($query)->result();

        return $daftar;
    }

    public function new_new_get_budgeting()
    {
        $query = "  SELECT*FROM budgeting
        ";
        $daftar =  $this->db->query($query)->result();

        return $daftar;
    }

    public function new_new_get_request_addendum()
    {
        $query = "SELECT new_request_addendum.id as id_add, new_request_addendum.proyek as proyekadd, new_request_addendum.fk_id_ppk as ppk, new_pekerjaan_detail.id as idproyek, `surat`, `xls`, `status`, `tanggal_request`, `tanggal_selesai` FROM `new_request_addendum` join new_pekerjaan_detail on new_pekerjaan_detail.proyek = new_request_addendum.proyek ORDER BY tanggal_request DESC
        ";
        $daftar =  $this->db->query($query)->result();

        return $daftar;
    }

    public function new_new_get_budgeting_history($id)
    {
        $query = "  SELECT*FROM pembayaran_history where fk_id_kontruksi_history = '{$id}'
        ";
        $daftar =  $this->db->query($query)->result();

        return $daftar;
    }
    public function new_new_get_budgeting_history_proyek($id)
    {
        $query = "SELECT proyek FROM budgeting where fk_id_kontruksi = '{$id}'
        ";
        $daftar =  $this->db->query($query)->row();

        return $daftar;
    }

    public function new_new_get_detail_by_id($id)
    {
        $query = "  SELECT*FROM new_pekerjaan_detail where id= {$id}
        ";
        $daftar =  $this->db->query($query)->row();

        return $daftar;
    }

    public function new_new_get_detail_minggu($proyek)
    {
        $query = "  SELECT*FROM new_minggu_dephub where proyek = '$proyek'
        ";
        $daftar =  $this->db->query($query)->result();

        return $daftar;
    }

    public function new_new_get_detail_budget_by_id($id)
    {
        $query = "  SELECT*FROM budgeting where id_budgeting= {$id}
        ";
        $daftar =  $this->db->query($query)->row();

        return $daftar;
    }

    public function new_new_get_detail_budget_kontruksi_by_id($id)
    {
        $query = "  SELECT*FROM budgeting_kontruksi join budgeting on budgeting.fk_id_kontruksi = budgeting_kontruksi.id_kontruksi where id_kontruksi= '{$id}'
        ";
        $daftar =  $this->db->query($query)->row();

        return $daftar;
    }

    public function new_new_get_detail_history_budget_kontruksi_by_id($id)
    {
        $query = "SELECT pembayaran_history.id, pembayaran_history.proyek, pembayaran_history.tanggal, pembayaran_history.kategori, pembayaran_history.rincian, pembayaran_history.nilai, pembayaran_history.surat, pembayaran_history.fk_id_kontruksi_history FROM budgeting_kontruksi join budgeting on budgeting.fk_id_kontruksi = budgeting_kontruksi.id_kontruksi join pembayaran on pembayaran.proyek = budgeting_kontruksi.proyek join pembayaran_history on pembayaran_history.proyek = pembayaran.proyek where pembayaran_history.id = {$id}
        ";
        $daftar =  $this->db->query($query)->row();

        return $daftar;
    }

    public function new_new_get_pengawas()
    {
        $query = "  SELECT * FROM `pengguna`  WHERE posisi = 'Pengawas'
        ";
        $daftar =  $this->db->query($query)->result();

        return $daftar;
    }
    public function new_new_get_ppk()
    {
        $query = "  SELECT * FROM `pengguna`  WHERE posisi = 'PPK'
        ";
        $daftar =  $this->db->query($query)->result();

        return $daftar;
    }
    public function new_new_get_kpa()
    {
        $query = "  SELECT * FROM `pengguna`  WHERE posisi = 'KPA'
        ";
        $daftar =  $this->db->query($query)->result();

        return $daftar;
    }
    public function new_new_get_ppspm()
    {
        $query = "  SELECT * FROM `pengguna`  WHERE posisi = 'PPSPM'
        ";
        $daftar =  $this->db->query($query)->result();

        return $daftar;
    }
    public function new_new_get_kasubdit()
    {
        $query = "  SELECT * FROM `pengguna`  WHERE posisi = 'KASUBDIT'
        ";
        $daftar =  $this->db->query($query)->result();

        return $daftar;
    }
    public function new_new_get_terminal()
    {
        $query = "  SELECT * FROM `terminal`
        ";
        $daftar =  $this->db->query($query)->result();

        return $daftar;
    }

    public function new_new_update_detail($data, $id){
        $this->db->where('id', $id);
        $this->db->update('new_pekerjaan_detail', $data);
    }

    public function new_new_update_budget($data, $id){
        $this->db->where('id_budgeting', $id);
        $this->db->update('budgeting', $data);
    }

    public function new_new_update_history_budget($data, $id){
        $uang_pelaksana = "";
        $uang_perencana = "";
        $uang_pengawas = "";
        $uang_perjalanan_dinas = "";
        $uang_honorium = "";
        $uang_habis_pakai = "";

        $this->db->where('id', $id);
        $this->db->update('pembayaran_history', $data);

        // $kategori = $this->input->post('kategori');
        $proyek = $this->input->post('proyek');

        $pelak = "SELECT sum(nilai) as uang FROM `pembayaran_history` WHERE proyek = '{$proyek}' and kategori = 'pelaksana' ";
        $sana =  $this->db->query($pelak);
          if ($sana->num_rows() > 0) {
            foreach ($sana->result() as $row) {
                $uang_pelaksana = $row->uang;
                if($uang_pelaksana === null){
                    $uang_pelaksana = "0";
                }
            }
        }
        $peren = "SELECT sum(nilai) as uang FROM `pembayaran_history` WHERE proyek = '{$proyek}' and kategori = 'perencana' ";
        $cana =  $this->db->query($peren);
          if ($cana->num_rows() > 0) {
            foreach ($cana->result() as $row) {
                $uang_perencana = $row->uang;
                if($uang_perencana === null){
                    $uang_perencana = "0";
                }
            }
        }
        $penga = "SELECT sum(nilai) as uang FROM `pembayaran_history` WHERE proyek = '{$proyek}' and kategori = 'pengawas' ";
        $was =  $this->db->query($penga);
          if ($was->num_rows() > 0) {
            foreach ($was->result() as $row) {
                $uang_pengawas = $row->uang;
                if($uang_pengawas === null){
                    $uang_pengawas = "0";
                }
            }
        }
        $honor = "SELECT sum(nilai) as uang FROM `pembayaran_history` WHERE proyek = '{$proyek}' and kategori = 'honorium' ";
        $rium =  $this->db->query($honor);
          if ($rium->num_rows() > 0) {
            foreach ($rium->result() as $row) {
                $uang_honorium = $row->uang;
                if($uang_honorium === null){
                    $uang_honorium = "0";
                }
            }
        }
        $perjalanan = "SELECT sum(nilai) as uang FROM `pembayaran_history` WHERE proyek = '{$proyek}' and kategori = 'perjalanan_dinas' ";
        $dinas =  $this->db->query($perjalanan);
          if ($dinas->num_rows() > 0) {
            foreach ($dinas->result() as $row) {
                $uang_perjalanan_dinas = $row->uang;
                if($uang_perjalanan_dinas === null){
                    $uang_perjalanan_dinas = "0";
                }
            }
        }
        $habis = "SELECT sum(nilai) as uang FROM `pembayaran_history` WHERE proyek = '{$proyek}' and kategori = 'habis_pakai' ";
        $pakai =  $this->db->query($habis);
          if ($pakai->num_rows() > 0) {
            foreach ($pakai->result() as $row) {
                $uang_habis_pakai = $row->uang;
                if($uang_habis_pakai === null){
                    $uang_habis_pakai = "0";
                }
            }
        }

        $query = "UPDATE `pembayaran` SET pelaksana = '$uang_pelaksana', pengawas = '$uang_pengawas', perencana = '$uang_perencana', honorium = '$uang_honorium', perjalanan_dinas = '$uang_perjalanan_dinas', habis_pakai = '$uang_habis_pakai' WHERE `pembayaran`.`proyek` = '$proyek'
        ";
        $daftar4 =  $this->db->query($query);
    }

    public function new_new_update_history_budget_delete($id){
        $uang_pelaksana = "";
        $uang_perencana = "";
        $uang_pengawas = "";
        $uang_perjalanan_dinas = "";
        $uang_honorium = "";
        $uang_habis_pakai = "";
        $proyek = "";
        $nama_pdf= "";

        $pro = "SELECT proyek, surat FROM `pembayaran_history` WHERE id = '$id' ";
        $sanaa =  $this->db->query($pro);
          if ($sanaa->num_rows() > 0) {
            foreach ($sanaa->result() as $row) {
                $proyek = $row->proyek;
                $nama_pdf = $row->surat;
            }
        }

        $this->db->where("id", $id);
        $this->db->delete("pembayaran_history");

        $path = './upload/surat/';
        @unlink($path.$nama_pdf);
        // $nama_pdf = "56d7f30a93b3cca87a0326b28970b1e3.pdf";
        // @unlink("./upload/surat/".$nama_pdf);


        $pelak = "SELECT sum(nilai) as uang FROM `pembayaran_history` WHERE proyek = '{$proyek}' and kategori = 'pelaksana' ";
        $sana =  $this->db->query($pelak);
          if ($sana->num_rows() > 0) {
            foreach ($sana->result() as $row) {
                $uang_pelaksana = $row->uang;
            }
        }
        $peren = "SELECT sum(nilai) as uang FROM `pembayaran_history` WHERE proyek = '{$proyek}' and kategori = 'perencana' ";
        $cana =  $this->db->query($peren);
          if ($cana->num_rows() > 0) {
            foreach ($cana->result() as $row) {
                $uang_perencana = $row->uang;
            }
        }
        $penga = "SELECT sum(nilai) as uang FROM `pembayaran_history` WHERE proyek = '{$proyek}' and kategori = 'pengawas' ";
        $was =  $this->db->query($penga);
          if ($was->num_rows() > 0) {
            foreach ($was->result() as $row) {
                $uang_pengawas = $row->uang;
            }
        }
        $honor = "SELECT sum(nilai) as uang FROM `pembayaran_history` WHERE proyek = '{$proyek}' and kategori = 'honorium' ";
        $rium =  $this->db->query($honor);
          if ($rium->num_rows() > 0) {
            foreach ($rium->result() as $row) {
                $uang_honorium = $row->uang;
            }
        }
        $perjalanan = "SELECT sum(nilai) as uang FROM `pembayaran_history` WHERE proyek = '{$proyek}' and kategori = 'perjalanan_dinas' ";
        $dinas =  $this->db->query($perjalanan);
          if ($dinas->num_rows() > 0) {
            foreach ($dinas->result() as $row) {
                $uang_perjalanan_dinas = $row->uang;
            }
        }
        $habis = "SELECT sum(nilai) as uang FROM `pembayaran_history` WHERE proyek = '{$proyek}' and kategori = 'habis_pakai' ";
        $pakai =  $this->db->query($habis);
          if ($pakai->num_rows() > 0) {
            foreach ($pakai->result() as $row) {
                $uang_habis_pakai = $row->uang;
            }
        }

        $query = "UPDATE `pembayaran` SET pelaksana = '$uang_pelaksana', pengawas = '$uang_pengawas', perencana = '$uang_perencana', honorium = '$uang_honorium', perjalanan_dinas = '$uang_perjalanan_dinas', habis_pakai = '$uang_habis_pakai' WHERE `pembayaran`.`proyek` = '$proyek'
        ";
        $daftar4 =  $this->db->query($query);
    }

    public function new_new_update_budget_kontruksi($data, $id){
        $this->db->where('id_kontruksi', $id);
        $this->db->update('budgeting_kontruksi', $data);
    }

    public function new_new_get_proyek_request($status, $fk, $idfk)
    {
        $query = "SELECT new_minggu_dephub.id as id_minggu, new_minggu_dephub.minggu as minggu, new_pekerjaan_detail.proyek as nama_proyek, new_minggu_dephub.tgl_awal as tgl_pertama, new_minggu_dephub.tgl_akhir as tgl_kedua, new_minggu_dephub.persentase_total as total_bobot,new_minggu_dephub.{$status} as status FROM `new_minggu_dephub` JOIN new_pekerjaan_detail ON new_pekerjaan_detail.proyek = new_minggu_dephub.proyek WHERE new_minggu_dephub.{$status} = 1 OR new_minggu_dephub.{$status} = 2 AND new_pekerjaan_detail.{$fk}= {$idfk}
        ";
        $daftar =  $this->db->query($query)->result();

        return $daftar;
    }
    
    public function new_new_get_proyek_request_ppk($status, $fk, $idfk, $fk_id_terminal)
    {
        $query = "SELECT new_minggu_dephub.id as id_minggu, new_minggu_dephub.minggu as minggu, new_pekerjaan_detail.proyek as nama_proyek, new_minggu_dephub.tgl_awal as tgl_pertama, new_minggu_dephub.tgl_akhir as tgl_kedua, new_minggu_dephub.persentase_total as total_bobot,new_minggu_dephub.{$status} as status FROM `new_minggu_dephub` JOIN new_pekerjaan_detail ON new_pekerjaan_detail.proyek = new_minggu_dephub.proyek WHERE new_minggu_dephub.{$status} = 1 AND new_pekerjaan_detail.{$fk}= {$idfk} AND new_pekerjaan_detail.fk_id_terminal = {$fk_id_terminal}
        ";
        $daftar =  $this->db->query($query)->result();

        return $daftar;
    }

    public function new_new_kirim_laporan($proyek, $idminggu)
     {
        $query = "  UPDATE new_minggu_dephub set status_ppk = 1 where proyek = '{$proyek}' and id = {$idminggu}
        ";
        $daftar =  $this->db->query($query);

        return $daftar;
     } 

     public function new_new_validasi_laporan($proyek, $idminggu)
     {
        $query = "  UPDATE new_minggu_dephub set status_ppk = 2, status_kpa = 1, status_ppspm = 1, status_kasubdit = 1 
        where proyek = '{$proyek}' and id = {$idminggu}
        ";
        $daftar =  $this->db->query($query);

        return $daftar;

     }

     public function new_new_cek_validasi_laporan($status, $proyek, $idminggu)
     {
        $query = "  UPDATE new_minggu_dephub set {$status} = 2 where proyek = '{$proyek}' and id = {$idminggu}
        ";
        $daftar =  $this->db->query($query);

        return $daftar;

     }
    
    public function new_get_pekerjaan($id)
    {
        # code...
        $pekerjaan="<option value='0'>--pilih--</option>";

        $this->db->order_by('id','ASC');
        $pek= $this->db->get_where('new_pekerjaan',array('proyek'=>$id));

        foreach ($pek->result_array() as $data ){
        $pekerjaan.= "<option value='$data[pekerjaan]'>$data[pekerjaan]</option>";
        }

        return $pekerjaan;
    }
    public function new_get_uraian($id)
    {
        # code...
        $pekerjaan="<option value='0'>--pilih--</option>";

        $this->db->order_by('id','ASC');
        $pek= $this->db->get_where('new_pekerjaan',array('pekerjaan'=>$id));

        foreach ($pek->result_array() as $data ){
        $pekerjaan.= "<option value='$data[uraian_pekerjaan]'>$data[uraian_pekerjaan]</option>";
        }

        return $pekerjaan;
    }
    //new akhir


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
        if(isset($_POST['order']))
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
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
		$this->db->order_by('nama_pekerjaan','ASC');
		return $this->db->get($this->table)->result();
	}
	
	
	private function _get_datatables_query_pekerjaan(){
		$this->db->select('id_pekerjaan,nama_pekerjaan');
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
		$this->db->order_by('nama_pekerjaan','ASC');
    }
	function get_datatables_pekerjaan($limit,$ke){
		$start = (intval($ke)-1) * intval($limit);
		$this->_get_datatables_query_pekerjaan();
        $this->db->limit(intval($limit), $start);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_pekerjaan(){
        $this->_get_datatables_query_pekerjaan();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function lihatbobotrencana($proyek) 
    {
        $query = "  SELECT bobot_persentase_total_acuan_komulatif as persentase_total_acuan_komulatif FROM new_minggu_dephub where proyek = '{$proyek}'
        ";
        $daftar =  $this->db->query($query)->result_array();

        return $daftar;
    }

    public function lihatbobotrealisasi($proyek) 
    {
        $query = "  SELECT persentase_total as persentase_total FROM new_minggu_dephub where proyek = '{$proyek}'
        ";
        $daftar =  $this->db->query($query)->result_array();

        return $daftar;
    }

    public function lihatgrafikminggu($proyek) 
    {
        $query = "  SELECT minggu FROM new_minggu_dephub where proyek = '{$proyek}'
        ";
        $daftar =  $this->db->query($query)->result_array();

        return $daftar;
    }

    public function new_new_get_detail_history_by_nama($proyek)
    {
        $query = "SELECT * FROM `new_history_addendum` where proyek = '{$proyek}'
        ";
        $daftar =  $this->db->query($query)->result();

        return $daftar;
    }

    public function ambilnamaproyek($fk_id)
    {
        $query = "  SELECT * FROM `new_pekerjaan_detail` WHERE fk_id_terminal = {$fk_id}";
        $daftar =  $this->db->query($query)->row();

        return $daftar;
    }

    public function ambilminggu($nama_proyek)
    {
        $query = "SELECT * FROM `new_minggu_dephub` WHERE proyek = '{$nama_proyek}' AND status_pengawas = 2 ORDER BY id DESC LIMIT 1";
        $daftar =  $this->db->query($query)->row();

        return $daftar;
    }

    function update_deviasi($data, $id){
        $this->db->where('id', $id);
        $this->db->update('new_minggu_dephub', $data);
    }
}
?>