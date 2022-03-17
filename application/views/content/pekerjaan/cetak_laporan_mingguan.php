<style type="text/css">
	h3 {text-align: center; margin-top: -5px;}
	p {text-align: left; font-size: 10pt;}
  table {
  border-collapse: collapse;
  }

  table, td, th {
    border: 1px solid black; font-size: 7pt;
}
</style>

<div style="page-break-inside: avoid;">

<h3>Laporan Pekerjaan</h3>

<br>
	
<table style="border: 0; border-spacing: 0; border: 0px solid #CCC;">
  <tr>
    <td style="border: none;">
      <strong>Pekerjaan</strong>
    </td>
    <td style="border: none;">
      :
    </td>
    <td style="border: none;">
      <?php echo $tandatangandireksi->proyek ?>
    </td>
  </tr>
  <tr>
    <td style="border: none;">
      <strong>Lokasi</strong>
    </td>
    <td style="border: none;">
      :
    </td>
    <td style="border: none;">
      <?php echo $tandatangandireksi->lokasi ?>
    </td>
  </tr>
  <tr>
    <td style="border: none;">
      <strong>periode</strong>
    </td>
    <td style="border: none;">
      :
    </td>
    <td style="border: none;">
      <?php echo $tandatangandireksi->tanggalawal ?> - <?php echo $tandatangandireksi->tanggalakhir ?>
    </td>
  </tr>
  <tr>
    <td style="border: none;">
      <strong>Pelaksana</strong>
    </td>
    <td style="border: none;">
      :
    </td>
    <td style="border: none;">
      <?php echo $tandatangandireksi->pelaksana ?>
    </td>
  </tr>
  <tr>
    <td style="border: none;">
      <strong>Pengawas</strong>
    </td>
    <td style="border: none;">
      :
    </td>
    <td style="border: none;">
      PT. Concept Design Architect
    </td>
  </tr>
</table>
<br>


	<div class="">
         <?php
         $sumbobot=0;
          // untuk deifini jumlah bobot
            ?>

          <div class="">
            <div class="">
              <div class="">
                <div>
                	<table nobr="true" style="border-spacing: 0; border: 0; border:0px;">
                		<tr>
                			<td style="border: none;">
                <table id="example1" style="font-size: 7pt; width: 100%;">
                  <thead>
                  <tr>
                    <th style="text-align: center;" rowspan="3">No</th>
                    <th rowspan="3" style="width: 240px; text-align: center;">Uraian pekerjaan</th>
                    <th style="text-align: center;" rowspan="3">Sat</th>
                    <th style="text-align: center;" colspan="4">Nilai Kontrak / Penyesuaian Lap.</th>
                    <th style="text-align: center;" colspan="6">Realisasi Mingguan</th>
                    <th style="text-align: center; width: 50px;" rowspan="3">Bobot Individual</th>
                    <th style="text-align: center; width: 30px;" rowspan="3">Keterangan</th>
                  </tr>
                  <tr>
                    <th style="text-align: center; width: 60px;" rowspan="2">Volume</th>
                    <th style="text-align: center; width: 90px;" rowspan="2">Harga Sat</th>
                    <th style="text-align: center; width: 100px;" rowspan="2">Nilai</th>
                    <th style="text-align: center; width: 50px;" rowspan="2">Bobot</th>
                    <th style="text-align: center; width: 30px;" colspan="2">s/d Minggu Lalu</th>
                    <th style="text-align: center; width: 30px;" colspan="2">Minggu ini</th>
                    <th style="text-align: center; width: 10px;" colspan="2">s/d Minggu ini</th>
                  </tr>
                  <tr>
                      <th style="text-align: center; width: 50px;">Volume</th>
                      <th style="text-align: center; width: 50px;">Bobot</th>
                      <th style="text-align: center; width: 50px;">Volume</th>
                      <th style="text-align: center; width: 50px;">Bobot</th>
                      <th style="text-align: center; width: 50px;">Volume</th>
                      <th style="text-align: center; width: 50px;">Bobot</th>
                  </tr>
                  <?php 
                  foreach ($section0 as $i) : 
                    $section = $i['section'];
                    // ini untuk perulangan section dimana sati section memiliki banyak pekerjaan

                    $sql ="SELECT id , `pekerjaan` FROM `new_pekerjaan` WHERE section = '$section' GROUP by pekerjaan ORDER BY id ASC";
                    $query = $this->db->query($sql);
                    if ($query->num_rows() > 0) {
                      foreach ($query->result() as $row) {
                        // ini untuk perulangan pekerjaan dengan where kondisi session yang sedang berjalan, misal session 0 meiliki 1 atau 2 pekerjaan
                        ?>
                  </thead>
                  <tbody>
                  <tr>
                    <td colspan="15" style="text-align:left;"><?php echo $section; ?> > <strong><?php echo $row->pekerjaan; ?></td>
                  </tr>

                  <?php 
                  // untuk mendapatkan Uraian pekerjaan dengan kondisi where hasil perulangan pekerjaan diatas
                  $n = 1;
                  $sql ="SELECT new_pekerjaan.id as idkerja, new_pekerjaan.uraian_pekerjaan, new_pekerjaan.section,
                   new_pekerjaan.pekerjaan, new_pekerjaan.satuan, new_pekerjaan.volume, new_pekerjaan.harga_satuan, 
                   new_pekerjaan.nilai, new_pekerjaan.bobot, new_pekerjaan.proyek , new_bobot_uraian_kerja.id as uraianid,
                   new_bobot_uraian_kerja.proyek, new_bobot_uraian_kerja.fk_id_minggu,
                   new_bobot_uraian_kerja.fk_id_new_pekerjaan, new_bobot_uraian_kerja.volume_detail,
                   new_bobot_uraian_kerja.bobot_detail, new_bobot_uraian_kerja.keterangan,
                   new_bobot_uraian_kerja.volume_akhir, new_bobot_uraian_kerja.bobot_akhir FROM new_pekerjaan JOIN new_bobot_uraian_kerja ON new_pekerjaan.id = new_bobot_uraian_kerja.fk_id_new_pekerjaan WHERE new_pekerjaan.pekerjaan = '$row->pekerjaan' AND new_pekerjaan.section = '$section' AND new_pekerjaan.proyek = '$proyek' AND fk_id_minggu = {$idminggul} ORDER BY new_pekerjaan.id ASC";
                  $query = $this->db->query($sql);
                  if ($query->num_rows() > 0) {
                    foreach ($query->result() as $row) {
                  ?>

                  <tr>
                    <td style="text-align: center; vertical-align: middle;"><?= $n; ?></td>
                    <td style="padding: 4px; text-align: left; vertical-align: middle;"><?= $row->uraian_pekerjaan; ?></td>
                    <td style="text-align: center; vertical-align: middle; padding: 4px"><?= $row->satuan; ?></td>
                    <td style="text-align: right; vertical-align: middle; padding: 4px"><?= number_format($row->volume,3,',','.'); ?></td>
                    <td style="text-align: right; vertical-align: middle; padding: 4px">
                      <div style="float:left;">Rp. </div>
                        <div style="float:right;"><?= number_format($row->harga_satuan, 2,',','.'); ?>
                        </div>
                      </td>
                    <td style="text-align: right; vertical-align: middle; padding: 4px">
                    	<div style="float: right;"><?= number_format($row->nilai, 2,',','.'); ?> </div>
        				<div style="float: left; margin-left: -12px;">Rp.</div>
                    </td>
                    <td style="text-align: right; vertical-align: middle; padding: 4px;"><?= number_format($row->bobot, 3,',','.'); ?></td>


                    <td style="text-align: right; vertical-align: middle;">

                      <?php if ($minggu=="minggu ke- 1") {
                        echo "0";
                      } elseif ($minggu!=="minggu ke- 1"){
                        $idm = $idminggul-1;
                        $minggulalu =  "SELECT * FROM `new_bobot_uraian_kerja` WHERE fk_id_minggu = '$idm' AND fk_id_new_pekerjaan = '$row->idkerja' AND proyek = '{$proyek}'";
                        $query = $this->db->query($minggulalu);
                        if ($query->num_rows() > 0) {
                          foreach ($query->result() as $royw) {
                            echo number_format($royw->volume_akhir,3,',','.');
                          }}
                      }
                      ?>
                    </td><!-- volume minggu lalu if minggu ke-1 maka kosong-->
                    <td style="text-align: right; vertical-align: middle; padding: 4px">
                      <?php
                      // $bobota=0;
                       if ($minggu=="minggu ke- 1") {
                        echo "0";
                      } elseif ($minggu!=="minggu ke- 1"){
                        $idm = $idminggul-1;
                        // echo $row->idkerja;
                        $minggulalul =  "SELECT * FROM `new_bobot_uraian_kerja` WHERE fk_id_minggu = $idm AND fk_id_new_pekerjaan = $row->idkerja AND proyek = '{$proyek}'";
                        $query = $this->db->query($minggulalul);
                        if ($query->num_rows() > 0) {
                          foreach ($query->result() as $rowy) {
                            echo number_format($rowy->bobot_akhir, 3,',','.');
                            // $bobota+=$rowy->bobot_akhir;
                          }}
                          // echo $bobota;
                      }
                      ?>
                    </td><!-- bobot minggu lalu -->
                    <td style="text-align: right; vertical-align: middle; padding: 4px"><!-- volume minggu ini -->
                      <?php echo number_format($row->volume_detail,3,',','.'); ?>
                    </td>

                    <td style="text-align: right; vertical-align: middle; padding: 4px"><!-- bobot minggu ini -->
                      <?= number_format($row->bobot_detail,3,',','.'); ?>
                    </td>

                    <td style="text-align: right; vertical-align: middle; padding: 4px">
                      <!-- <?php

                          // $idm = $idminggul-1;
                          // echo $row->idkerja;
                          $minggulalulka =  "SELECT SUM(volume_akhir) as volumesdminggu, SUM(bobot_akhir) as bobotsdminggu FROM `new_bobot_uraian_kerja`JOIN new_pekerjaan ON new_pekerjaan.id = new_bobot_uraian_kerja.fk_id_new_pekerjaan WHERE fk_id_new_pekerjaan = {$row->idkerja} AND fk_id_minggu <= {$idminggul} AND new_pekerjaan.proyek= '{$proyek}' AND new_pekerjaan.section = '{$section}' AND new_pekerjaan.pekerjaan = '{$row->pekerjaan}'";
                          $query = $this->db->query($minggulalulka);
                          if ($query->num_rows() > 0) {
                            foreach ($query->result() as $rowp) {
                              echo number_format($rowp->volumesdminggu, 3,',','.');
                            }}
                        
                      ?> -->
                        <?php

                          // $idm = $idminggul-1;
                          // echo $row->idkerja;
                          $minggulalulka =  "SELECT volume_akhir as volumesdminggu FROM `new_bobot_uraian_kerja`JOIN new_pekerjaan ON new_pekerjaan.id = new_bobot_uraian_kerja.fk_id_new_pekerjaan WHERE fk_id_new_pekerjaan = {$row->idkerja} AND fk_id_minggu = {$idminggul} AND new_pekerjaan.proyek= '{$proyek}' AND new_pekerjaan.section = '{$section}' AND new_pekerjaan.pekerjaan = '{$row->pekerjaan}'";
                          $query = $this->db->query($minggulalulka);
                          if ($query->num_rows() > 0) {
                            foreach ($query->result() as $rowp) {
                              echo number_format($rowp->volumesdminggu, 3,',','.');
                            }}
                        
                      ?>
                      
                    </td><!-- s/d volume minggu ini -->
                    <td style="text-align: right; vertical-align: middle; padding: 4px">
                      <!-- <?php
                      $bobotakhir = 0;
                          // $idm = $idminggul-1;
                          // echo $row->idkerja;
                          $minggulalulka =  "SELECT SUM(volume_akhir) as volumesdminggu, SUM(bobot_akhir) as bobotsdminggu FROM `new_bobot_uraian_kerja`JOIN new_pekerjaan ON new_pekerjaan.id = new_bobot_uraian_kerja.fk_id_new_pekerjaan WHERE fk_id_new_pekerjaan = {$row->idkerja} AND fk_id_minggu <= {$idminggul} AND new_pekerjaan.proyek= '{$proyek}' AND new_pekerjaan.section = '{$section}' AND new_pekerjaan.pekerjaan = '{$row->pekerjaan}'";
                          $query = $this->db->query($minggulalulka);
                          if ($query->num_rows() > 0) {
                            foreach ($query->result() as $rowp) {
                              echo number_format($rowp->bobotsdminggu, 3,',','.');
                              $bobotakhir = $rowp->bobotsdminggu;
                            }}
                      ?> -->
                      <?php
                      $bobotakhir=0;
                          // $idm = $idminggul-1;
                          // echo $row->idkerja;
                          $minggulalulka =  "SELECT bobot_akhir as bobotsdminggu FROM `new_bobot_uraian_kerja`JOIN new_pekerjaan ON new_pekerjaan.id = new_bobot_uraian_kerja.fk_id_new_pekerjaan WHERE fk_id_new_pekerjaan = {$row->idkerja} AND fk_id_minggu = {$idminggul} AND new_pekerjaan.proyek= '{$proyek}' AND new_pekerjaan.section = '{$section}' AND new_pekerjaan.pekerjaan = '{$row->pekerjaan}'";
                          $query = $this->db->query($minggulalulka);
                          if ($query->num_rows() > 0) {
                            foreach ($query->result() as $rowp) {
                              echo number_format($rowp->bobotsdminggu, 3,',','.');
                              $bobotakhir = $rowp->bobotsdminggu;
                            }}
                      ?>
                      <!-- <?= number_format($row->bobot_akhir,3,',','.'); ?> -->
                    </td><!-- s/d bobot minggu ini -->
                    <td style="text-align: right; vertical-align: middle; padding: 4px">
                      <?php
                       // $bobotakhir = $bobotakhir;
                      // echo $bobotakhir;
                       $bobotasli = $row->bobot;
                       $bobotindividu = ($bobotakhir/$bobotasli)*100;
                       echo round(number_format($bobotindividu))."%";
                       // echo number_format($bobotindividu,3,',','.')."%";
                       ?>
                    </td><!-- keterangan -->
                    <td style="text-align: right; vertical-align: middle; padding: 4px">
                       <?= $row->keterangan; ?>
                  </td>
                  </tr>

                  <?php $n++; } } ?>
                  <!-- ini akhir perulangan where kondisi pekerjaan -->

                  <tr>
                  <?php 
                  $sql ="SELECT pekerjaan, SUM(nilai) as totalnilai, SUM(bobot) as totalbobot FROM `new_pekerjaan` WHERE pekerjaan = '$row->pekerjaan' AND section = '$section' AND proyek = '$proyek'";
                  $query = $this->db->query($sql);
                  if ($query->num_rows() > 0) {
                    foreach ($query->result() as $row) {
                   ?>
                    <td colspan="5" style="text-align: right; padding: 4px; vertical-align: middle;">Sub total</td>
                    <th style="text-align: right; vertical-align: middle; padding: 4px">
                      <div style="float:left;">Rp. </div>
                      <div style="float:right;"><?php echo number_format($row->totalnilai, 2,',','.'); ?> </div>
                    </th>
                    <th style="text-align: right; vertical-align: middle; padding: 4px"> <?php echo number_format($row->totalbobot,3,',','.'); ?></th>
                  <?php } } ?>

                  <th> </th>
                  <th style="text-align: right; vertical-align: middle; padding: 4px">
                    <?php
                       if ($minggu=="minggu ke- 1") {
                        echo "0";
                      } elseif ($minggu!=="minggu ke- 1"){
                        $idm = $idminggul-1;
                        // echo $row->idkerja;
                        $minggulalulk =  "SELECT  SUM(bobot_akhir) as totalbobot FROM new_bobot_uraian_kerja JOIN new_pekerjaan ON new_pekerjaan.id = new_bobot_uraian_kerja.fk_id_new_pekerjaan WHERE new_bobot_uraian_kerja.fk_id_minggu = {$idm} AND new_pekerjaan.proyek = '{$proyek}' AND new_pekerjaan.section = '{$section}' AND new_pekerjaan.pekerjaan = '{$row->pekerjaan}'";
                        $query = $this->db->query($minggulalulk);
                        if ($query->num_rows() > 0) {
                          foreach ($query->result() as $rowp) {
                            echo number_format($rowp->totalbobot, 3,',','.');
                          }}
                      }
                      ?>
                  </th>
                  <th></th>
                  <th style="text-align: right; vertical-align: middle; padding: 4px">
                    <?php
                        $mingguini =  "SELECT SUM(bobot_detail) as detailbobot FROM new_bobot_uraian_kerja JOIN new_pekerjaan ON new_pekerjaan.id = new_bobot_uraian_kerja.fk_id_new_pekerjaan WHERE new_bobot_uraian_kerja.fk_id_minggu = {$idminggul} AND new_pekerjaan.proyek = '{$proyek}' AND new_pekerjaan.section = '{$section}' AND new_pekerjaan.pekerjaan = '{$row->pekerjaan}'";
                        $query = $this->db->query($mingguini);
                        if ($query->num_rows() > 0) {
                          foreach ($query->result() as $rowp) {
                            echo number_format($rowp->detailbobot, 3,',','.');
                          }}
                      
                      ?>
                  </th>
                  <th></th>
                  <th style="text-align: right; vertical-align: middle; padding: 4px">
                    <?php
                      $idm = $idminggul-1;
                      // echo $row->idkerja;
                      $minggu_sdini =  "SELECT SUM(bobot_detail) as bobotsdminggu FROM `new_bobot_uraian_kerja`JOIN new_pekerjaan ON new_pekerjaan.id = new_bobot_uraian_kerja.fk_id_new_pekerjaan WHERE fk_id_minggu <= {$idminggul} AND new_pekerjaan.proyek= '{$proyek}' AND new_pekerjaan.section = '{$section}' AND new_pekerjaan.pekerjaan = '{$row->pekerjaan}'";
                      $query = $this->db->query($minggu_sdini);
                      if ($query->num_rows() > 0) {
                        foreach ($query->result() as $rowp) {
                          echo number_format($rowp->bobotsdminggu, 3,',','.');
                        $bobotakhir = $rowp->bobotsdminggu;
                      }}
                      ?>
                  </th>
                  <th></th>
                  <th></th>
                </tr>
                  <!-- ini untuk mendapatkan nilai bobot dari kondisi where pekerjaan -->
                  </tbody>
                  <tfoot>
                  </tfoot>
          <?php } } ?>
          <!-- ini akhir perulangan lihat pekerjaan darikondisi where section -->

          <?php endforeach; ?>
          <!-- ini akhir perulangan lihat section -->

                <tr>
                  <td colspan="5" style="color: white;"><br></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>

                <tr>
                  <?php 
                  $sql ="SELECT pekerjaan, SUM(nilai) as totalnilai, SUM(bobot) as totalbobot FROM `new_pekerjaan` WHERE proyek = '$proyek'";
                  $query = $this->db->query($sql);
                  if ($query->num_rows() > 0) {
                    foreach ($query->result() as $row) {
                   ?>
                    <td colspan="5" style=" text-align: right; padding: 4px; vertical-align: text-top;"><strong>JUMLAH</strong></td>
                    <th style=" text-align: right; padding: 4px; vertical-align: text-top;">
                      <div style="float:left;">Rp. </div>
                      <div style="float:right;"><?php echo number_format($row->totalnilai, 2,',','.'); ?> </div>
                    </th>

                    <!-- <th style=" text-align: right; vertical-align: text-top; padding: 4px"> <?php echo number_format(round($row->totalbobot),3,',','.'); ?></th> -->

                    <th style="text-align: right; vertical-align: middle; padding: 4px"> <?php echo number_format($row->totalbobot,3,',','.'); ?></th>
                  <?php } } ?>

                  <th style=""></th>
                  <th style=" text-align: right; vertical-align: text-top; padding: 4px">
                    <?php
                       if ($minggu=="minggu ke- 1") {
                        echo "0";
                      } elseif ($minggu!=="minggu ke- 1"){
                        $idm = $idminggul-1;
                        // echo $row->idkerja;
                        $minggulalulka =  "SELECT  SUM(bobot_akhir) as totalbobot FROM new_bobot_uraian_kerja JOIN new_pekerjaan ON new_pekerjaan.id = new_bobot_uraian_kerja.fk_id_new_pekerjaan WHERE new_bobot_uraian_kerja.fk_id_minggu = {$idm} AND new_pekerjaan.proyek = '{$proyek}'";
                        $query = $this->db->query($minggulalulka);
                        if ($query->num_rows() > 0) {
                          foreach ($query->result() as $rowp) {
                            echo number_format($rowp->totalbobot, 3,',','.');
                          }}
                      }
                      ?>
                  </th>
                  <th style=""></th>
                  <th style="text-align: right; vertical-align: text-top; padding: 4px">
                    <?php
                        $mingguinia =  "SELECT  SUM(bobot_detail) as detailbobot FROM new_bobot_uraian_kerja JOIN new_pekerjaan ON new_pekerjaan.id = new_bobot_uraian_kerja.fk_id_new_pekerjaan WHERE new_bobot_uraian_kerja.fk_id_minggu = {$idminggul} AND new_pekerjaan.proyek = '{$proyek}'";
                        $query = $this->db->query($mingguinia);
                        if ($query->num_rows() > 0) {
                          foreach ($query->result() as $rowa) {
                            echo number_format($rowa->detailbobot, 3,',','.');
                          }}
                      
                      ?>
                  </th>
                  <th style=""></th>
                  <th style=" text-align: right; vertical-align: text-top; padding: 4px">
                    <?php
                      $idm = $idminggul-1;
                      // echo $row->idkerja;
                      $minggu_sdinia =  "SELECT SUM(bobot_detail) as bobotsdminggu FROM `new_bobot_uraian_kerja`JOIN new_pekerjaan ON new_pekerjaan.id = new_bobot_uraian_kerja.fk_id_new_pekerjaan WHERE fk_id_minggu <= {$idminggul} AND new_pekerjaan.proyek= '{$proyek}'";
                      $query = $this->db->query($minggu_sdinia);
                      if ($query->num_rows() > 0) {
                        foreach ($query->result() as $rowk) {
                          echo number_format($rowk->bobotsdminggu, 3,',','.');
                      }}
                      ?>
                  </th>
                  <th style=""></th>
                  <th style=""></th>
                </tr>
                
                <tr>
                  <?php 
                  $ppn=0;
                  $sql ="SELECT pekerjaan, SUM(nilai) as totalnilai, SUM(bobot) as totalbobot FROM `new_pekerjaan` WHERE proyek = '$proyek'";
                  $query = $this->db->query($sql);
                  if ($query->num_rows() > 0) {
                    foreach ($query->result() as $row) {
                    	$ppn = $row->totalnilai*0.1;
                   ?>
                    <td colspan="5" style=" text-align: right; padding: 4px; vertical-align: text-top;"><strong>PPN 10%</strong></td>
                    <th style=" text-align: right; padding: 4px; vertical-align: text-top;">
                      <div style="float:left;">Rp. </div>
                      <div style="float:right;"><?php echo number_format($ppn, 2,',','.'); ?> </div>
                    </th>

                    <th style=" text-align: right; vertical-align: text-top; padding: 4px"></th>

                     <!-- <th style="text-align: right; vertical-align: middle; padding: 4px"> <?php echo number_format($row->totalbobot,3,',','.'); ?></th> -->
                  <?php } } ?> 

                  <th style=""></th>
                  <th style=" text-align: right; vertical-align: text-top; padding: 4px">
                  </th>
                  <th style=""></th>
                  <th style="text-align: right; vertical-align: text-top; padding: 4px">
                  </th>
                  <th style=""></th>
                  <th style=" text-align: right; vertical-align: text-top; padding: 4px">
                  </th>
                  <th style=""></th>
                  <th style=""></th>
                </tr>
                <?php 
                  $pln=0; ?>
               <!--  <tr>
                  <?php 
                  $pln =0;
                  $sql ="SELECT pekerjaan, SUM(nilai) as totalnilai, SUM(bobot) as totalbobot FROM `new_pekerjaan` WHERE proyek = '$proyek'";
                  $query = $this->db->query($sql);
                  if ($query->num_rows() > 0) {
                    foreach ($query->result() as $row) {
                   ?>
                    <td colspan="5" style=" text-align: right; padding: 4px; vertical-align: text-top;"><strong>Biaya Penyambungan Daya Listrik PLN 240 KVA (reimburse)</strong></td>
                    <th style=" text-align: right; padding: 4px; vertical-align: text-top;">
                      <div style="float:left;">Rp. </div>
                      <?php $pln = 0; ?>
                      <div style="float:right;"><?php echo number_format($pln, 2,',','.'); ?> </div>
                    </th>

                    <th style=" text-align: right; vertical-align: text-top; padding: 4px"></th>

                     <th style="text-align: right; vertical-align: middle; padding: 4px"> <?php echo number_format($row->totalbobot,3,',','.'); ?></th>

                  <?php } } ?> 
                  <th style=""></th>
                  <th style=" text-align: right; vertical-align: text-top; padding: 4px">
                  </th>
                  <th style=""></th>
                  <th style="text-align: right; vertical-align: text-top; padding: 4px">
                  </th>
                  <th style=""></th>
                  <th style=" text-align: right; vertical-align: text-top; padding: 4px">
                  </th>
                  <th style=""></th>
                  <th style=""></th>
                </tr> -->
                <tr>
                  <?php 
                  $jml=0;
                  $sql ="SELECT pekerjaan, SUM(nilai) as totalnilai, SUM(bobot) as totalbobot FROM `new_pekerjaan` WHERE proyek = '$proyek'";
                  $query = $this->db->query($sql);
                  if ($query->num_rows() > 0) {
                    foreach ($query->result() as $row) {
                   ?>
                    <td colspan="5" style=" text-align: right; padding: 4px; vertical-align: text-top;"><strong>JUMLAH TOTAL</strong></td>
                    <th style=" text-align: right; padding: 4px; vertical-align: text-top;">
                      <div style="float:left;">Rp. </div>
                      <?php $jml = $ppn+$row->totalnilai+$pln; ?>
                      <div style="float:right;"><?php echo number_format($jml, 2,',','.'); ?> </div>
                    </th>

                    <th style=" text-align: right; vertical-align: text-top; padding: 4px"></th>

                    <!-- <th style="text-align: right; vertical-align: middle; padding: 4px"> <?php echo number_format($row->totalbobot,3,',','.'); ?></th> -->
                  <?php } } ?>

                  <th style=""></th>
                  <th style=" text-align: right; vertical-align: text-top; padding: 4px">
                  </th>
                  <th style=""></th>
                  <th style="text-align: right; vertical-align: text-top; padding: 4px">
                  </th>
                  <th style=""></th>
                  <th style=" text-align: right; vertical-align: text-top; padding: 4px">
                  </th>
                  <th style=""></th>
                  <th style=""></th>
                </tr>
                <tr>
                  <?php 
                  $bulat;
                  $sql ="SELECT pekerjaan, SUM(nilai) as totalnilai, SUM(bobot) as totalbobot FROM `new_pekerjaan` WHERE proyek = '$proyek'";
                  $query = $this->db->query($sql);
                  if ($query->num_rows() > 0) {
                    foreach ($query->result() as $row) {
                   ?>
                    <td colspan="5" style=" text-align: right; padding: 4px; vertical-align: text-top;"><strong>DIBULATKAN</strong></td>
                    <th style=" text-align: right; padding: 4px; vertical-align: text-top;">
                      <div style="float:left;">Rp. </div>
                      <?php $bulat=($jml/1000)*1000 ?>
                      <div style="float:right;"><?php echo number_format($bulat, 2,',','.'); ?> </div>
                    </th>

                    <th style=" text-align: right; vertical-align: text-top; padding: 4px"></th>

                    <!-- <th style="text-align: right; vertical-align: middle; padding: 4px"> <?php echo number_format($row->totalbobot,3,',','.'); ?></th>-->
                  <?php } } ?> 

                  <th style=""></th>
                  <th style=" text-align: right; vertical-align: text-top; padding: 4px">
                  </th>
                  <th style=""></th>
                  <th style="text-align: right; vertical-align: text-top; padding: 4px">
                  </th>
                  <th style=""></th>
                  <th style=" text-align: right; vertical-align: text-top; padding: 4px">
                  </th>
                  <th style=""></th>
                  <th style=""></th>
                </tr>
                
                </table>
                			</td>
                		</tr>
                	</table>
              </div>
              </div>
            <!-- /.card-body -->
            <!-- ini akhir perulangan pekerjaan -->
          </div>
            <!-- /.info-box -->
          </div>

		<br><br>
		<table style="width: 100% border: 0; border-spacing: 0; border: 0px solid #CCC;">
		  <tr>
		    <td style="border: none; text-align: center;">
		      Mengetahui<br>
		      Pelaksana<br>
		      <br>
		      <br>
		      <br>
		      <?php echo $tandatanganpelaksana->nama ?><br>
		      Nip. <?php echo $tandatanganpelaksana->nip; ?>
		    </td>

		    <td style="border: none; text-align: center;">
		      Mengetahui<br>
		      Pengawas<br>
		      <br>
		      <br>
		      <br>
		      <?php echo $tandatangandireksi->nama ?><br>
		      Nip. <?php echo $tandatangandireksi->nip; ?>
		    </td>
		  </tr>
		</table>

</div>
