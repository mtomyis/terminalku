<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cetak {
	protected $ci;
	function __construct(){
		$this->ci = &get_instance();
		$this->ci->load->model(array('m_claim_reimbursement','m_reimbursement','m_user','m_pengajuan_kas'));
		$this->ci->load->library(array('libku','mypdf'));
	}
	function reimbursement($id){
		$isi = $this->ci->m_reimbursement->edit($id);
		$ttd_pemohon = $isi->ttd_pemohon;
		$ttd_admin = $isi->ttd_admin;
		$ttd_v1 = $isi->ttd_v1;
		$ttd_v2 = $isi->ttd_v2;
		$ttd_v3 = $isi->ttd_v3;
		$status = $isi->status;
		$alasan = $isi->alasan;
		$isi_status="";
		if($status == "6")
		{
			$isi_status = "Ditolak Oleh Project Manager";
		}
		else if($status == "7")
		{
			$isi_status = "Ditolak Oleh Verifikator I";
		}
		else if($status == "8")
		{
			$isi_status = "Ditolak Oleh Verifikator II";
		}
		else if($status == "9")
		{
			$isi_status = "Ditolak Oleh Verifikator III";
		}
		if(intval($status) > 5)
		{
			$img = base_url().'aset/img/ditolak.png';
		}
		else
		{
			$img = base_url().'aset/img/no_tanda_tangan.png';
		}
		
		if($ttd_pemohon == "" || $ttd_pemohon == null)
		{
			$ttd_pemohon = 'aset/img/no_tanda_tangan.png';
		}
		if($ttd_admin == "" || $ttd_admin == null)
		{
			$ttd_admin = 'aset/img/no_tanda_tangan.png';
		}
		if($ttd_v1 == "" || $ttd_v1 == null)
		{
			$ttd_v1 = 'aset/img/no_tanda_tangan.png';
		}
		if($ttd_v2 == "" || $ttd_v2 == null)
		{
			$ttd_v2 = 'aset/img/no_tanda_tangan.png';
		}
		if($ttd_v3 == "" || $ttd_v3 == null)
		{
			$ttd_v3 = 'aset/img/no_tanda_tangan.png';
		}
		$data = json_decode($isi->data);
		date_default_timezone_set('Asia/Jakarta');
		$this->ci->load->library(array('libku'));
		ob_start();
		$this->ci->fpdf = new MYPDF('L','cm','A4');
		$this->ci->fpdf->AliasNbPages();
		$this->ci->fpdf->SetTitle('CLAIM REIMBURSEMENT');
		$this->ci->fpdf->AddPage();
		$this->ci->fpdf->SetAutoPageBreak(true,1);
		$this->ci->fpdf->SetMargins(1,1);
		$this->ci->fpdf->Ln(1);
		// JUDUL FORM
		$this->ci->fpdf->setFont('Arial',"B",11);
		$this->ci->fpdf->Cell(0,0.7,'CLAIM REIMBURSEMENT',0,0,'C');
		$this->ci->fpdf->ln(1.5);
		$this->ci->fpdf->setFont('Arial','',11);
		$tgl = $isi->tanggal;
		$tgl = $this->ci->libku->tglindo(date("Y-m-d",strtotime($tgl)));
		$this->ci->fpdf->Cell(5,0,'No Pengajuan',0,0,'L');
		$this->ci->fpdf->Cell(0.3,0,':',0,0,'L');
		$this->ci->fpdf->imageUniformToFill($img,$this->ci->fpdf->GetX()+5,$this->ci->fpdf->GetY()+0.2,4,4,"C");
		$this->ci->fpdf->Cell(0,0,$isi->no_pengajuan,0,0,'L');
		$this->ci->fpdf->Ln(0.6);
		$this->ci->fpdf->Cell(5,0,'Tanggal',0,0,'L');
		$this->ci->fpdf->Cell(0.3,0,':',0,0,'L');
		$this->ci->fpdf->Cell(0,0,$tgl,0,0,'L');
		$this->ci->fpdf->Ln(0.6);
		$this->ci->fpdf->setFont('Arial','B',10);
		$this->ci->fpdf->SetDrawColor(142,142,142); 
		$this->ci->fpdf->Cell(1.5,1,'NO','BTL',0,'C');
		$this->ci->fpdf->Cell(4.5,1,'JENIS TRANSAKSI','BTL',0,'C');
		$this->ci->fpdf->Cell(5.5,1,"ATAS NAMA","BLT",0,'C');
		$this->ci->fpdf->Cell(12,1,"URAIAN","BLT",0,'C');
		$this->ci->fpdf->Cell(4,1,'JUMLAH','BLTR',0,'C');
		$this->ci->fpdf->Ln();
		$no=0;
		$grandTotal = 0;
		foreach($data as $key =>$d)
		{
			if($d->jenis_transaksi == "1")
			{
				$jenis = "Operasional Kantor";
			}else if($d->jenis_transaksi == "2")
			{
				$jenis = "Perjalanan Dinas";
			} else
			{
				$jenis = "Lain-Lain";
			}
			$no++;
			$this->ci->fpdf->setFont('Arial','',10);		
			$this->ci->fpdf->Cell(1.5,1,$no,'BL',0,'C');
			$this->ci->fpdf->Cell(4.5,1,$jenis,'BL',0,'L');
			$this->ci->fpdf->Cell(5.5,1,$d->atas_nama,"BL",0,'L');
			$this->ci->fpdf->Cell(12,1,$d->uraian,"BL",0,'L');
			$this->ci->fpdf->Cell(4,1,number_format($d->jumlah,0,',','.'),'BLR',0,'R');
			$this->ci->fpdf->Ln();
			$grandTotal += $d->jumlah;
		}
		$this->ci->fpdf->setFont('Arial','',10);
		$this->ci->fpdf->Cell(23.5,0.7,"TOTAL",'LB',0,'R');
		$this->ci->fpdf->Cell(4,0.7,number_format($grandTotal,'0',',','.'),'LBR',0,'R');
		$this->ci->fpdf->Ln();
		
		
		if(intval($status) < 6)
		{
			$this->ci->fpdf->Ln(0.3);
			$this->ci->fpdf->imageUniformToFill($ttd_pemohon,$this->ci->fpdf->GetX()+1,$this->ci->fpdf->GetY()+0.2,4,4,"C");
			$this->ci->fpdf->Cell(5.5,0.6,"Diajukan oleh,",0,0,'C');
			$this->ci->fpdf->imageUniformToFill($ttd_admin,$this->ci->fpdf->GetX()+0.5,$this->ci->fpdf->GetY()+0.2,4,4,"C");
			$this->ci->fpdf->Cell(5.5,0.6,"Diketahui oleh,",0,0,'C');
			$this->ci->fpdf->Cell(16.5,0.6,"Disetujui oleh,",0,0,'C');
			$this->ci->fpdf->Ln();
			$this->ci->fpdf->Cell(5.5,0.6,"Administrasi",0,0,'C');
			$this->ci->fpdf->Cell(5.5,0.6,"Project Manager",0,0,'C');
			$this->ci->fpdf->imageUniformToFill($ttd_v1,$this->ci->fpdf->GetX()+1,$this->ci->fpdf->GetY()-0.5,4,4,"C");
			$this->ci->fpdf->Cell(5.5,0.6,"Verifikator I,",0,0,'C');
			$this->ci->fpdf->imageUniformToFill($ttd_v2,$this->ci->fpdf->GetX()+0.8,$this->ci->fpdf->GetY()-0.5,4,4,"C");
			$this->ci->fpdf->Cell(5.5,0.6,"Verifikator II,",0,0,'C');
			$this->ci->fpdf->imageUniformToFill($ttd_v3,$this->ci->fpdf->GetX()+0.5,$this->ci->fpdf->GetY()-0.5,4,4,"C");
			$this->ci->fpdf->Cell(5.5,0.6,"Verifikator III,",0,0,'C');
			$this->ci->fpdf->Ln(2.5);
			$this->ci->fpdf->setFont('Arial',"BU",11);
			$this->ci->fpdf->Cell(5.5,0.6,strtoupper($isi->nama_pemohon),0,0,'C');
			$this->ci->fpdf->Cell(5.5,0.6,strtoupper($isi->nama_admin),0,0,'C');
			$this->ci->fpdf->Cell(5.5,0.6,strtoupper($isi->nama_v1),0,0,'C');
			$this->ci->fpdf->Cell(5.5,0.6,strtoupper($isi->nama_v2),0,0,'C');
			$this->ci->fpdf->Cell(5.5,0.6,strtoupper($isi->nama_v3),0,0,'C');
			$this->ci->fpdf->Ln();
		}
		else
		{
			$this->ci->fpdf->setFont('Arial','B',10);
			$this->ci->fpdf->Cell(10.8,0.7,$isi_status,'LB',0,'C');
			$this->ci->fpdf->setFont('Arial','',10);
			$this->ci->fpdf->Cell(16.7,0.7,' Alasan : '.$alasan,'LBR',0,'L');
			$this->ci->fpdf->Ln();
		}
		$this->ci->fpdf->Ln();
		
		
		
		ob_clean();//add this line 
		$code = date("HdmiYs");
		$berkas = $code.".pdf";
		$filename='upload/cetakan/'.$berkas;
		ob_clean();
		$this->ci->fpdf->Output($filename,"F");
		return $filename;
	}
	function order_material($id){
		$isi = $this->ci->m_po->edit($id);
		$ttd_pemohon = $isi->ttd_pemohon;
		$ttd_admin = $isi->ttd_admin;
		$ttd_v1 = $isi->ttd_v1;
		$ttd_v2 = $isi->ttd_v2;
		$ttd_v3 = $isi->ttd_v3;
		$status = $isi->status;
		$alasan = $isi->alasan;
		$isi_status="";
		if($status == "6")
		{
			$isi_status = "Ditolak Oleh Administrasi";
		}
		else if($status == "7")
		{
			$isi_status = "Ditolak Oleh Verifikator I";
		}
		else if($status == "8")
		{
			$isi_status = "Ditolak Oleh Verifikator II";
		}
		else if($status == "9")
		{
			$isi_status = "Ditolak Oleh Verifikator III";
		}
	
		
		
		if(intval($status) > 5)
		{
			$img = base_url().'aset/img/ditolak.png';
		}
		else
		{
			$img = base_url().'aset/img/no_tanda_tangan.png';
		}
		
		
		if($ttd_pemohon == "" || $ttd_pemohon == null)
		{
			$ttd_pemohon = base_url().'aset/img/no_tanda_tangan.png';
		}
		else
		{
			$ttd_pemohon = base_url().$ttd_pemohon;
		}
		if($ttd_admin == "" || $ttd_admin == null)
		{
			$ttd_admin = 'aset/img/no_tanda_tangan.png';
		}
		else
		{
			$ttd_admin = base_url().$ttd_admin;
		}
		if($ttd_v1 == "" || $ttd_v1 == null)
		{
			$ttd_v1 = base_url().'aset/img/no_tanda_tangan.png';
		}
		else
		{
			$ttd_v1 = base_url().$ttd_v1;
		}
		if($ttd_v2 == "" || $ttd_v2 == null)
		{
			$ttd_v2 = base_url().'aset/img/no_tanda_tangan.png';
		}
		else
		{
			$ttd_v2 = base_url().$ttd_v2;
		}
		if($ttd_v3 == "" || $ttd_v3 == null)
		{
			$ttd_v3 = base_url().'aset/img/no_tanda_tangan.png';
		}
		else
		{
			$ttd_v3 = base_url().$ttd_v3;
		}
		$data = json_decode($isi->data);
		$detail = array();
		$nama_pekerjaan ="";
		$tahun ="";
		$lokasi ="";
		$sumber_dana ="";
		$id_pekerjaan="";
		$result = array();
		foreach($data as $key =>$value)
		{
			   $id = $value->id_sub_pekerjaan;
				if(!isset($result[$id])) $result[$id] = array();
				$result[$id] = array(
					"id_sub_pekerjaan" => $value->id_sub_pekerjaan,
					"no_refrensi" => $value->no_refrensi,
					"id_pekerjaan" => $value->id_pekerjaan,
					"nama_pekerjaan"=>$value->nama_pekerjaan,
					"sub_pekerjaan"=>$value->nama_sub_pekerjaan,
					"tahun"=>$value->tahun_anggaran,
					"lokasi"=>$value->lokasi,
					"sumber_dana"=>$value->sumber_dana
				);
		}
		$item = array();
		foreach($data as $key =>$value)
		{
			   $id = $value->id_item_pekerjaan;
				if(!isset($item[$id])) $item[$id] = array();
				$item[$id] = array(
					"id_item_pekerjaan" => $value->id_item_pekerjaan,
					"id_sub_pekerjaan"=>$value->id_sub_pekerjaan,
					"item_pekerjaan"=>$value->nama_item_pekerjaan,
								  );
		}
		$x = json_encode($result);
		$sub = json_decode($x);
		$cetak = array();
		$xx = json_encode($item);
		$item_x = json_decode($xx);
		foreach($sub as $key => $p)
		{
			$u = array();
			$nama_pekerjaan = $p->nama_pekerjaan;
			$tahun = $p->tahun;
			$lokasi = $p->lokasi;
			$id_pekerjaan = $p->id_pekerjaan;
			$sumber_dana = $p->sumber_dana;
			$u['no_refrensi'] = $p->no_refrensi;
			$u['sub_pekerjaan']=$p->sub_pekerjaan;
			$ab = array();
			foreach($item_x as $i)
			{
				$y= array();
				if($i->id_sub_pekerjaan == $p->id_sub_pekerjaan)
				{
					$y['item_pekerjaan'] = $i->item_pekerjaan;
						$aa = array();
						foreach($data as $key =>$value)
						{
							$z = array();
							if($value->id_item_pekerjaan == $i->id_item_pekerjaan)
							{
									$z['nama_barang'] = $value->nama_barang;
									$z['jumlah'] = $value->jumlah;
									$z['satuan']=$value->satuan;
									$z['harga_satuan']=$value->harga;
									$z['nama_toko']=$value->nama_toko;
									$z['no_rekening']=$value->no_rekening;
							}
							$aa[]  = $z;
						}
					$y['isi']=$aa;
				}
				$ab[] = $y;
			}
			$u['item_pekerjaan']=$ab;
			$cetak[] = $u;
		}
		date_default_timezone_set('Asia/Jakarta');
		$this->ci->load->library(array('libku'));
		ob_start();
		$this->ci->fpdf = new MYPDF('L','cm','A4');
		$this->ci->fpdf->AliasNbPages();
		$this->ci->fpdf->SetTitle('PERMOHONAN PENGAJUAN KEBUTUHAN MATERIAL');
		$this->ci->fpdf->AddPage();
		$this->ci->fpdf->SetAutoPageBreak(true,1);
		$this->ci->fpdf->SetMargins(1,1);
		// JUDUL FORM
		$this->ci->fpdf->setFont('Arial',"B",11);
		$this->ci->fpdf->Cell(0,0.7,'PERMOHONAN PENGAJUAN KEBUTUHAN MATERIAL',0,0,'C');
		$this->ci->fpdf->ln(1.5);
		$this->ci->fpdf->setFont('Arial','',11);
		$this->ci->fpdf->Cell(5,0,'Pekerjaan',0,0,'L');
		$this->ci->fpdf->Cell(0.3,0,':',0,0,'L');
		$this->ci->fpdf->imageUniformToFill($img,$this->ci->fpdf->GetX()+5,$this->ci->fpdf->GetY()+0.2,4,4,"C");
		$this->ci->fpdf->Cell(0,0,$nama_pekerjaan,0,0,'L');
		$this->ci->fpdf->Ln(0.6);
		$this->ci->fpdf->Cell(5,0,'Lokasi',0,0,'L');
		$this->ci->fpdf->Cell(0.3,0,':',0,0,'L');
		$this->ci->fpdf->Cell(0,0,$tahun,0,0,'L');
		$this->ci->fpdf->Ln(0.6);
		$this->ci->fpdf->Cell(5,0,'Sumber Dana',0,0,'L');
		$this->ci->fpdf->Cell(0.3,0,':',0,0,'L');
		$this->ci->fpdf->Cell(0,0,$sumber_dana,0,0,'L');
		$this->ci->fpdf->Ln(0.6);
		$tgl = $isi->tanggal;
		$tgl = $this->ci->libku->tglindo(date("Y-m-d",strtotime($tgl)));
		$this->ci->fpdf->Cell(5,0,'No Pengajuan',0,0,'L');
		$this->ci->fpdf->Cell(0.3,0,':',0,0,'L');
		$this->ci->fpdf->Cell(0,0,$isi->no_pengajuan,0,0,'L');
		$this->ci->fpdf->Ln(0.6);
		$this->ci->fpdf->Cell(5,0,'Tanggal',0,0,'L');
		$this->ci->fpdf->Cell(0.3,0,':',0,0,'L');
		$this->ci->fpdf->Cell(0,0,$tgl,0,0,'L');
		$this->ci->fpdf->Ln(0.6);
		$this->ci->fpdf->setFont('Arial','B',10);
		$this->ci->fpdf->SetDrawColor(142,142,142); 
		$this->ci->fpdf->Cell(1.5,1,'NO','BTL',0,'C');
		$this->ci->fpdf->Cell(9.3,1,'URAIAN PEKERJAAN','BTL',0,'C');
		$this->ci->fpdf->Cell(2.2,1,"VOLUME","BLT",0,'C');
		$this->ci->fpdf->Cell(1.7,1,"SAT.","BLT",0,'C');
		$this->ci->fpdf->Cell(3.2,1,'SUPPLIER/TOKO','BLT',0,'C');
		$this->ci->fpdf->Cell(3.2,1,'NO REKENING','BLT',0,'C');
		$this->ci->fpdf->Cell(3.2,1,'HARGA SATUAN','BLTR',0,'C');
		$this->ci->fpdf->Cell(3.2,1,'JUMLAH','BLTR',0,'C');
		$this->ci->fpdf->Ln();
		$grandTotal = 0;
		foreach($cetak as $s)
		{
			if($s['sub_pekerjaan'] != NULL || $s['sub_pekerjaan'] != "")
			{
				$this->ci->fpdf->setFont('Arial','B',10);
				$this->ci->fpdf->Cell(1.5,0.7,$s['no_refrensi'],'LB',0,'C');
				$this->ci->fpdf->Cell(9.3,0.7,$s['sub_pekerjaan'],'BL',0,'L');
				$this->ci->fpdf->Cell(2.2,0.7,"","BL",0,'C');
				$this->ci->fpdf->Cell(1.7,0.7,"","LB",0,'C');
				$this->ci->fpdf->Cell(3.2,0.7,'','LB',0,'C');
				$this->ci->fpdf->Cell(3.2,0.7,'','LB',0,'C');
				$this->ci->fpdf->Cell(3.2,0.7,'','LB',0,'C');
				$this->ci->fpdf->Cell(3.2,0.7,'','LBR',0,'C');
				$this->ci->fpdf->Ln();
				$this->ci->fpdf->setFont('Arial','',10);
				foreach($s['item_pekerjaan'] as  $t)
				{
					if($t['item_pekerjaan'] != NULL || $t['item_pekerjaan'] != "")
					{ 
						$this->ci->fpdf->Cell(1.5,0.7,"",'LB',0,'C');
						$this->ci->fpdf->Cell(0.5,0.7,"",'LB',0,'C');
						$this->ci->fpdf->Cell(8.8,0.7,$t['item_pekerjaan'],'B',0,'L');
						$this->ci->fpdf->Cell(2.2,0.7,"","BL",0,'C');
						$this->ci->fpdf->Cell(1.7,0.7,"","LB",0,'C');
						$this->ci->fpdf->Cell(3.2,0.7,'','LB',0,'C');
						$this->ci->fpdf->Cell(3.2,0.7,'','LB',0,'C');
						$this->ci->fpdf->Cell(3.2,0.7,'','LB',0,'C');
						$this->ci->fpdf->Cell(3.2,0.7,'','LBR',0,'C');
						$this->ci->fpdf->Ln();
						foreach($t['isi'] as $i)
						{
							$total =floatval($i['jumlah']) * floatval($i['harga_satuan']);
							if($i['nama_barang'] != "" || $i['nama_barang'] != NULL)
							{
								$this->ci->fpdf->Cell(1.5,0.7,"",'LB',0,'C');
								$this->ci->fpdf->Cell(1,0.7,"",'LB',0,'C');
								$this->ci->fpdf->Cell(8.3,0.7,$i['nama_barang'],'B',0,'L');
								$this->ci->fpdf->Cell(2.2,0.7,number_format($i['jumlah'],'0',',','.'),"BL",0,'R');
								$this->ci->fpdf->Cell(1.7,0.7,$i['satuan'],"LB",0,'C');
								$this->ci->fpdf->Cell(3.2,0.7,$i['nama_toko'],'LB',0,'L');
								$this->ci->fpdf->Cell(3.2,0.7,$i['no_rekening'],'LB',0,'L');
								$this->ci->fpdf->Cell(3.2,0.7,number_format($i['harga_satuan'],'0',',','.'),'LB',0,'R');
								$this->ci->fpdf->Cell(3.2,0.7,number_format($total,'0',',','.'),'LBR',0,'R');
								$this->ci->fpdf->Ln();
								$grandTotal +=$total;
							}
						}
					}
				}
			}
		}
		
		
		
		$this->ci->fpdf->setFont('Arial','',10);
		$this->ci->fpdf->Cell(24.3,0.7,"TOTAL",'LB',0,'R');
		$this->ci->fpdf->Cell(3.2,0.7,number_format($grandTotal,'0',',','.'),'LBR',0,'R');
		$this->ci->fpdf->Ln();
		
		if(intval($status) < 6)
		{
			$this->ci->fpdf->Ln(0.3);
			$this->ci->fpdf->imageUniformToFill($ttd_pemohon,$this->ci->fpdf->GetX()+1,$this->ci->fpdf->GetY()+0.2,4,4,"C");
			$this->ci->fpdf->Cell(5.5,0.6,"Diajukan oleh,",0,0,'C');
			$this->ci->fpdf->imageUniformToFill($ttd_admin,$this->ci->fpdf->GetX()+0.5,$this->ci->fpdf->GetY()+0.2,4,4,"C");
			$this->ci->fpdf->Cell(5.5,0.6,"Diketahui oleh,",0,0,'C');
			$this->ci->fpdf->Cell(16.5,0.6,"Disetujui oleh,",0,0,'C');
			$this->ci->fpdf->Ln();
			$this->ci->fpdf->Cell(5.5,0.6,"Project Manager",0,0,'C');
			$this->ci->fpdf->Cell(5.5,0.6,"Adminstrasi",0,0,'C');
			$this->ci->fpdf->imageUniformToFill($ttd_v1,$this->ci->fpdf->GetX()+1,$this->ci->fpdf->GetY()-0.5,4,4,"C");
			$this->ci->fpdf->Cell(5.5,0.6,"Verifikator I,",0,0,'C');
			$this->ci->fpdf->imageUniformToFill($ttd_v2,$this->ci->fpdf->GetX()+0.8,$this->ci->fpdf->GetY()-0.5,4,4,"C");
			$this->ci->fpdf->Cell(5.5,0.6,"Verifikator II,",0,0,'C');
			$this->ci->fpdf->imageUniformToFill($ttd_v3,$this->ci->fpdf->GetX()+0.5,$this->ci->fpdf->GetY()-0.5,4,4,"C");
			$this->ci->fpdf->Cell(5.5,0.6,"Verifikator III,",0,0,'C');
			$this->ci->fpdf->Ln(2.5);
			$this->ci->fpdf->setFont('Arial',"BU",11);
			$this->ci->fpdf->Cell(5.5,0.6,strtoupper($isi->nama_pemohon),0,0,'C');
			$this->ci->fpdf->Cell(5.5,0.6,strtoupper($isi->nama_admin),0,0,'C');
			$this->ci->fpdf->Cell(5.5,0.6,strtoupper($isi->nama_v1),0,0,'C');
			$this->ci->fpdf->Cell(5.5,0.6,strtoupper($isi->nama_v2),0,0,'C');
			$this->ci->fpdf->Cell(5.5,0.6,strtoupper($isi->nama_v3),0,0,'C');
			$this->ci->fpdf->Ln();
		}
		else
		{
			$this->ci->fpdf->setFont('Arial','B',10);
			$this->ci->fpdf->Cell(10.8,0.7,$isi_status,'LB',0,'C');
			$this->ci->fpdf->setFont('Arial','',10);
			$this->ci->fpdf->Cell(16.7,0.7,' Alasan : '.$alasan,'LBR',0,'L');
			$this->ci->fpdf->Ln();
		}
		ob_clean();//add this line 
		$code = date("HdmiYs");
		$berkas = $code.".pdf";
		$filename='upload/cetakan/'.$berkas;
		ob_clean();
		$this->ci->fpdf->Output($filename,"F");
		return $filename;
	}
	function pengajuan_kas($id){
		$isi = $this->ci->m_pengajuan_kas->edit($id);
		$ttd_pemohon = $isi->ttd_pemohon;
		$ttd_v1 = $isi->ttd_v1;
		$ttd_v2 = $isi->ttd_v2;
		$ttd_v3 = $isi->ttd_v3;
		$status = $isi->status;
		$alasan = $isi->alasan;
		$isi_status="";

		if($status == "5")
		{
			$isi_status = "Ditolak Oleh Verifikator I";
		}
		else if($status == "6")
		{
			$isi_status = "Ditolak Oleh Verifikator II";
		}
		else if($status == "7")
		{
			$isi_status = "Ditolak Oleh Verifikator III";
		}
		if(intval($status) > 4)
		{
			$img = base_url().'aset/img/ditolak.png';
		}
		else
		{
			$img = base_url().'aset/img/no_tanda_tangan.png';
		}
		
		if($ttd_pemohon == "" || $ttd_pemohon == null)
		{
			$ttd_pemohon = 'aset/img/no_tanda_tangan.png';
		}
		if($ttd_v1 == "" || $ttd_v1 == null)
		{
			$ttd_v1 = 'aset/img/no_tanda_tangan.png';
		}
		if($ttd_v2 == "" || $ttd_v2 == null)
		{
			$ttd_v2 = 'aset/img/no_tanda_tangan.png';
		}
		if($ttd_v3 == "" || $ttd_v3 == null)
		{
			$ttd_v3 = 'aset/img/no_tanda_tangan.png';
		}
		date_default_timezone_set('Asia/Jakarta');
		$this->ci->load->library(array('libku'));
		ob_start();
		$this->ci->fpdf = new MYPDF('L','cm','A4');
		$this->ci->fpdf->AliasNbPages();
		$this->ci->fpdf->SetTitle('PENGAJUAN KAS');
		$this->ci->fpdf->AddPage();
		$this->ci->fpdf->SetAutoPageBreak(true,1);
		$this->ci->fpdf->SetMargins(1,1);
		$this->ci->fpdf->Ln(1);
		// JUDUL FORM
		$this->ci->fpdf->setFont('Arial',"B",11);
		$this->ci->fpdf->Cell(0,0.7,'PENGAJUAN KAS',0,0,'C');
		$this->ci->fpdf->ln(1.5);
		$this->ci->fpdf->setFont('Arial','',11);
		$tgl = $isi->tanggal;
		$tgl = $this->ci->libku->tglindo(date("Y-m-d",strtotime($tgl)));
		$this->ci->fpdf->Cell(5,0,'No Pengajuan',0,0,'L');
		$this->ci->fpdf->Cell(0.3,0,':',0,0,'L');
		$this->ci->fpdf->imageUniformToFill($img,$this->ci->fpdf->GetX()+5,$this->ci->fpdf->GetY()+0.2,4,4,"C");
		$this->ci->fpdf->Cell(0,0,$isi->no_pengajuan,0,0,'L');
		$this->ci->fpdf->Ln(0.6);
		$this->ci->fpdf->Cell(5,0,'Tanggal',0,0,'L');
		$this->ci->fpdf->Cell(0.3,0,':',0,0,'L');
		$this->ci->fpdf->Cell(0,0,$tgl,0,0,'L');
		$this->ci->fpdf->Ln(0.6);
		$this->ci->fpdf->setFont('Arial','B',10);
		$this->ci->fpdf->SetDrawColor(142,142,142); 
		$this->ci->fpdf->Cell(2,1,'NO','BTL',0,'C');
		$this->ci->fpdf->Cell(20,1,'URAIAN','BTL',0,'C');
		$this->ci->fpdf->Cell(5.5,1,"JUMLAH","BLTR",0,'C');
		$this->ci->fpdf->Ln();
		$no=0;
		$grandTotal = 0;
		foreach($data as $key =>$d)
		{
			$no++;
			$this->ci->fpdf->setFont('Arial','',10);		
			$this->ci->fpdf->Cell(2,1,$no,'BL',0,'C');
			$this->ci->fpdf->Cell(20,1,$d->uraian,"BL",0,'L');
			$this->ci->fpdf->Cell(5.5,1,number_format($d->jumlah,0,',','.'),'BLR',0,'R');
			$this->ci->fpdf->Ln();
			$grandTotal += $d->jumlah;
		}
		$this->ci->fpdf->setFont('Arial','',10);
		$this->ci->fpdf->Cell(22,0.7,"TOTAL",'LB',0,'R');
		$this->ci->fpdf->Cell(5.5,0.7,number_format($grandTotal,'0',',','.'),'LBR',0,'R');
		$this->ci->fpdf->Ln();
		
		
		if(intval($status) < 5)
		{
			$this->ci->fpdf->Ln(0.3);
			$this->ci->fpdf->imageUniformToFill($ttd_pemohon,$this->ci->fpdf->GetX()+1,$this->ci->fpdf->GetY()+0.2,4,4,"C");
			$this->ci->fpdf->Cell(6.875,0.6,"Diajukan oleh,",0,0,'C');
			$this->ci->fpdf->Cell(13.75,0.6,"Disetujui oleh,",0,0,'C');
			$this->ci->fpdf->Ln();
			$this->ci->fpdf->Cell(6.875,0.6,"Administrasi",0,0,'C');
			$this->ci->fpdf->imageUniformToFill($ttd_v1,$this->ci->fpdf->GetX()+1,$this->ci->fpdf->GetY()-0.5,4,4,"C");
			$this->ci->fpdf->Cell(6.875,0.6,"Verifikator I,",0,0,'C');
			$this->ci->fpdf->imageUniformToFill($ttd_v2,$this->ci->fpdf->GetX()+0.8,$this->ci->fpdf->GetY()-0.5,4,4,"C");
			$this->ci->fpdf->Cell(6.875,0.6,"Verifikator II,",0,0,'C');
			$this->ci->fpdf->imageUniformToFill($ttd_v3,$this->ci->fpdf->GetX()+0.5,$this->ci->fpdf->GetY()-0.5,4,4,"C");
			$this->ci->fpdf->Cell(6.875,0.6,"Verifikator III,",0,0,'C');
			$this->ci->fpdf->Ln(2.5);
			$this->ci->fpdf->setFont('Arial',"BU",11);
			$this->ci->fpdf->Cell(6.875,0.6,strtoupper($isi->nama_pemohon),0,0,'C');
			$this->ci->fpdf->Cell(6.875,0.6,strtoupper($isi->nama_v1),0,0,'C');
			$this->ci->fpdf->Cell(6.875,0.6,strtoupper($isi->nama_v2),0,0,'C');
			$this->ci->fpdf->Cell(6.875,0.6,strtoupper($isi->nama_v3),0,0,'C');
			$this->ci->fpdf->Ln();
		}
		else
		{
			$this->ci->fpdf->setFont('Arial','B',10);
			$this->ci->fpdf->Cell(10.8,0.7,$isi_status,'LB',0,'C');
			$this->ci->fpdf->setFont('Arial','',10);
			$this->ci->fpdf->Cell(16.7,0.7,' Alasan : '.$alasan,'LBR',0,'L');
			$this->ci->fpdf->Ln();
		}
		$this->ci->fpdf->Ln();
		
		
		
		ob_clean();//add this line 
		$code = date("HdmiYs");
		$berkas = $code.".pdf";
		$filename='upload/cetakan/'.$berkas;
		ob_clean();
		$this->ci->fpdf->Output($filename,"F");
		return $filename;
	}
	function rekap_order_material($tanggal_awal,$tanggal_akhir){
		$isi = $this->ci->m_po->rekap($tanggal_awal,$tanggal_akhir);
		date_default_timezone_set('Asia/Jakarta');
		$this->ci->load->library(array('libku'));
		ob_start();
		$this->ci->fpdf = new MYPDF('L','cm','A4');
		$this->ci->fpdf->AliasNbPages();
		$this->ci->fpdf->SetTitle('Rekapitulasi Order Material');
		$this->ci->fpdf->AddPage();
		$this->ci->fpdf->SetAutoPageBreak(true,1);
		$this->ci->fpdf->SetMargins(1.5,1.5);
		$this->ci->fpdf->Ln(1);
		// JUDUL FORM
		$this->ci->fpdf->setFont('Arial',"B",11);
		$this->ci->fpdf->Cell(0,0.7,'REKAPITULASI ORDER MATERIAL',0,0,'C');
		$this->ci->fpdf->ln();
		$this->ci->fpdf->setFont('Arial','',10);	
		$this->ci->fpdf->Cell(0,0.7,'Periode '.$this->ci->libku->tglindo($tanggal_awal).' s/d '.$this->ci->libku->tglindo($tanggal_akhir),0,0,'C');
		$this->ci->fpdf->ln();
		$this->ci->fpdf->Ln(0.6);
		$this->ci->fpdf->setFont('Arial','B',10);
		$this->ci->fpdf->SetDrawColor(142,142,142); 
		$this->ci->fpdf->Cell(2,1,'NO','BTL',0,'C');
		$this->ci->fpdf->Cell(5,1,'NO PENGAJUAN','BTL',0,'C');
		$this->ci->fpdf->Cell(4,1,'TANGGAL','BTL',0,'C');
		$this->ci->fpdf->Cell(12,1,'URAIAN','BTL',0,'C');
		$this->ci->fpdf->Cell(4,1,"JUMLAH","BLTR",0,'C');
		$this->ci->fpdf->Ln();
		$no=0;
		$grandTotal = 0;
		foreach($isi as $key)
		{
			$no++;
			$i=0;
			$sub = json_decode($key->data);
			$index = count($sub);
			$this->ci->fpdf->setFont('Arial','',10);		
			foreach($sub as $k => $d)
			{
				$i++;
				$jumlah = floatval($d->harga) * floatval($d->jumlah);
				$this->ci->fpdf->setFont('Arial','',10);	
				if($i == 1)
				{
					$this->ci->fpdf->Cell(2,intval($index),$no,'BL',0,'C');
					$this->ci->fpdf->Cell(5,intval($index),$key->no_pengajuan,"BL",0,'L');
					$this->ci->fpdf->Cell(4,intval($index),$this->ci->libku->tglindo($key->tanggal),"BL",0,'L');
					$this->ci->fpdf->Cell(12,1,$d->nama_barang,"BL",0,'L');
					$this->ci->fpdf->Cell(4,1,number_format($jumlah,0,',','.'),'BLR',0,'R');
					$this->ci->fpdf->Ln();
				}
				else
				{
					$this->ci->fpdf->Cell(11,0,'','',0,'C');
					$this->ci->fpdf->Cell(12,1,$d->nama_barang,"BL",0,'L');
					$this->ci->fpdf->Cell(4,1,number_format($jumlah,0,',','.'),'BLR',0,'R');
					$this->ci->fpdf->Ln();
				}
				
				
				$grandTotal += $jumlah;
			}
		}
		$this->ci->fpdf->setFont('Arial','',10);
		$this->ci->fpdf->Cell(23,1,"TOTAL",'LB',0,'R');
		$this->ci->fpdf->Cell(4,1,number_format($grandTotal,'0',',','.'),'LBR',0,'R');
		$this->ci->fpdf->Ln();
		
		ob_clean();//add this line 
		$code = date("HdmiYs");
		$berkas = $code.".pdf";
		$filename='upload/cetakan/'.$berkas;
		ob_clean();
		$this->ci->fpdf->Output($filename,"F");
		return base_url().$filename;
	}
	function rekap_reimbursement($tanggal_awal,$tanggal_akhir){
		$isi = $this->ci->m_reimbursement->rekap($tanggal_awal,$tanggal_akhir);
		date_default_timezone_set('Asia/Jakarta');
		$this->ci->load->library(array('libku'));
		ob_start();
		$this->ci->fpdf = new MYPDF('L','cm','A4');
		$this->ci->fpdf->AliasNbPages();
		$this->ci->fpdf->SetTitle('Rekapitulasi Reimbursement');
		$this->ci->fpdf->AddPage();
		$this->ci->fpdf->SetAutoPageBreak(true,1);
		$this->ci->fpdf->SetMargins(1.5,1.5);
		$this->ci->fpdf->Ln(1);
		// JUDUL FORM
		$this->ci->fpdf->setFont('Arial',"B",11);
		$this->ci->fpdf->Cell(0,0.7,'REKAPITULASI REIMBURSEMENT',0,0,'C');
		$this->ci->fpdf->ln();
		$this->ci->fpdf->setFont('Arial','',10);	
		$this->ci->fpdf->Cell(0,0.7,'Periode '.$this->ci->libku->tglindo($tanggal_awal).' s/d '.$this->ci->libku->tglindo($tanggal_akhir),0,0,'C');
		$this->ci->fpdf->ln();
		$this->ci->fpdf->Ln(0.6);
		$this->ci->fpdf->setFont('Arial','B',10);
		$this->ci->fpdf->SetDrawColor(142,142,142); 
		$this->ci->fpdf->Cell(2,1,'NO','BTL',0,'C');
		$this->ci->fpdf->Cell(5,1,'NO PENGAJUAN','BTL',0,'C');
		$this->ci->fpdf->Cell(4,1,'TANGGAL','BTL',0,'C');
		$this->ci->fpdf->Cell(12,1,'URAIAN','BTL',0,'C');
		$this->ci->fpdf->Cell(4,1,"JUMLAH","BLTR",0,'C');
		$this->ci->fpdf->Ln();
		$no=0;
		$grandTotal = 0;
		foreach($isi as $key)
		{
			$no++;
			$i=0;
			$sub = json_decode($key->data);
			$index = count($sub);
			$this->ci->fpdf->setFont('Arial','',10);		
			foreach($sub as $k => $d)
			{
				$i++;
				$jumlah = floatval($d->jumlah);
				$this->ci->fpdf->setFont('Arial','',10);	
				if($i == 1)
				{
					$this->ci->fpdf->Cell(2,intval($index),$no,'BL',0,'C');
					$this->ci->fpdf->Cell(5,intval($index),$key->no_pengajuan,"BL",0,'L');
					$this->ci->fpdf->Cell(4,intval($index),$this->ci->libku->tglindo($key->tanggal),"BL",0,'L');
					$this->ci->fpdf->Cell(12,1,$d->uraian,"BL",0,'L');
					$this->ci->fpdf->Cell(4,1,number_format($jumlah,0,',','.'),'BLR',0,'R');
					$this->ci->fpdf->Ln();
				}
				else
				{
					$this->ci->fpdf->Cell(11,0,$no,'',0,'C');
					$this->ci->fpdf->Cell(12,1,$d->uraian,"BL",0,'L');
					$this->ci->fpdf->Cell(4,1,number_format($jumlah,0,',','.'),'BLR',0,'R');
					$this->ci->fpdf->Ln();
				}
				$grandTotal += $jumlah;
			}
		}
		$this->ci->fpdf->setFont('Arial','',10);
		$this->ci->fpdf->Cell(23,1,"TOTAL",'LB',0,'R');
		$this->ci->fpdf->Cell(4,1,number_format($grandTotal,'0',',','.'),'LBR',0,'R');
		$this->ci->fpdf->Ln();
		
		ob_clean();//add this line 
		$code = date("HdmiYs");
		$berkas = $code.".pdf";
		$filename='upload/cetakan/'.$berkas;
		ob_clean();
		$this->ci->fpdf->Output($filename,"F");
		return base_url().$filename;
	}
}