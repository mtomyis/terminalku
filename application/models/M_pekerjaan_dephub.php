<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_pekerjaan_dephub extends CI_Model 
{	
	function __construct()
	{
        $this->load->library('upload');
		parent::__construct();
        $this->tabledokumentasi='new_dokumentasi_dephub';

        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
	}

    function insertRecord($record){
                    
        $proyek = $this->input->post('proyek');

        if(count($record) > 0){
                
            $sql = "insert into new_pekerjaan_dephub (proyek, uraian_subpekerjaan, nilai, bobot) values (?, ?, ?, ?)";
            $this->db->query($sql,array(
                    $proyek,
                    "uraian_subpekerjaan" => trim($record[0]),
                    "nilai" => trim($record[1]),
                    "bobot" => trim($record[2])
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
        // $lokasi = $this->input->post('lokasi');
        $terminal = $this->input->post('terminal');
        $pelaksana = $this->input->post('pelaksana');
        $tanggalawal = $this->input->post('tanggalawal');
        $tanggalakhir = $this->input->post('tanggalakhir');
        $unitkerja = $this->input->post('unitkerja');
        
        # code...
        $data = array
            (
                'proyek'=>$proyek,
                // 'lokasi'=>$lokasi,
                'fk_id_terminal'=>$terminal,
                'pelaksana'=>$pelaksana,
                'tanggalawal'=>$tanggalawal,
                'tanggalakhir'=>$tanggalakhir,
                'unitkerja'=>$unitkerja
            );
            $this->db->insert('new_pekerjaan_detail',$data);

        $sql ="SELECT SUM(nilai) as uang FROM new_pekerjaan_dephub where proyek = '{$proyek}'";
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
            $this->db->insert('new_minggu_dephub', $datas);
             // var_dump($tanggal);
           }  
         
           // increment untuk counter looping
           $i++;
        }
        while ($tanggal != $date2);
        // this simpan proyek sama data diatas
    }

    public function simpanlaporan()
    {
        $proyek = $this->input->post('proyek');
        $idminggu = $this->input->post('idminggu');

        $query = "insert into `new_bobot_uraian_kerja_dephub` (proyek, fk_id_minggu, fk_idnew_pekerjaan_dephub)
            SELECT new_pekerjaan_dephub.proyek, new_minggu_dephub.id, new_pekerjaan_dephub.id from `new_pekerjaan_dephub` JOIN new_minggu_dephub on new_pekerjaan_dephub.proyek = new_minggu_dephub.proyek WHERE new_pekerjaan_dephub.proyek = '{$proyek}' AND new_minggu_dephub.id = {$idminggu}
        ";
        $daftar2 =  $this->db->query($query);

        return $daftar2;
    }

    public function input_foto($data)
    {
        $this->db->insert($this->tabledokumentasi, $data);
    }

    public function get_tbl_dokumentasi($idminggu,$proyek)
    {
        $table_dokumentasi =  "SELECT * FROM `new_dokumentasi_dephub` WHERE fk_idminggu = '$idminggu' AND proyek = '{$proyek}'";
        $query = $this->db->query($table_dokumentasi);
        return $query->row();
    }

    public function update_dokumentasi($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update($this->tabledokumentasi, $data);
    }
}