<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-9" style="margin-top: 10px;">
            <h5 class="m-0 text-dark">Addendum Laporan Pekerjaan</h5>
          </div><!-- /.col -->
          <!-- /.col -->
          <div class="col-sm-1" style="margin-top: 10px;">
               <?php
               $idpro=0;
               $sql ="SELECT id FROM `new_pekerjaan_detail` WHERE proyek = '$proyek'";
                    $query = $this->db->query($sql);
                    if ($query->num_rows() > 0) {
                      foreach ($query->result() as $row) {
                        $idpro = $row->id;
                      }
                    }
                ?>
<a class="btn btn-primary" style="margin-right: 20px;" href="<?php echo base_url('pekerjaan/new_new_add_history_addendum/'.$idpro.'/'.$idminggul.'/'.$id_add) ?>">Selesai</a>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <section class="content">

      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
         <?php
         $sumbobot=0;
          // untuk deifini jumlah bobot
            ?>

          <div class="col-12 col-sm-12 col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                <table id="example1" class="table-bordered" style="font-size: 7pt; width: 100%">
                  <thead>
                  <tr>
                    <th style="text-align: center;" rowspan="3">No</th>
                    <th rowspan="3" style="width: 300px; text-align: center;">Uraian pekerjaan</th>
                    <th style="text-align: center;" rowspan="3">Sat</th>
                    <th style="text-align: center;" colspan="4">Nilai Kontrak / Penyesuaian Lap.</th>
                    <th style="text-align: center;" colspan="2">Realisasi Mingguan Terakhir</th>
                    <th style="text-align: center; width: 50px;" rowspan="3">Bobot Individual</th>
                    <th style="text-align: center; width: 30px;" rowspan="3">Keterangan</th>
                    <th style="text-align: center; width: 10px;" rowspan="3">Aksi</th>
                  </tr>
                  <tr>
                    <th style="text-align: center; width: 60px;" rowspan="2">Volume</th>
                    <th style="text-align: center; width: 90px;" rowspan="2">Harga Sat</th>
                    <th style="text-align: center; width: 100px;" rowspan="2">Nilai</th>
                    <th style="text-align: center; width: 50px;" rowspan="2">Bobot</th>
                    <th style="text-align: center; width: 10px;" colspan="2">s/d Minggu ini</th>
                  </tr>
                  <tr>
                      <th style="text-align: center; width: 50px;">Volume</th>
                      <th style="text-align: center; width: 50px;">Bobot</th>
                  </tr>
                  <?php 
                  foreach ($section0 as $i) : 
                    $section = $i['section'];
                    // ini untuk perulangan section dimana sati section memiliki banyak pekerjaan

                    $sql ="SELECT id , `pekerjaan` FROM `new_pekerjaan` WHERE section = '$section' and proyek = '$proyek' GROUP by pekerjaan ORDER BY id ASC";
                    $query = $this->db->query($sql);
                    if ($query->num_rows() > 0) {
                      foreach ($query->result() as $row) {
                        // ini untuk perulangan pekerjaan dengan where kondisi session yang sedang berjalan, misal session 0 meiliki 1 atau 2 pekerjaan
                        ?>
                  </thead>
                  <tbody>
                  <tr>
                    <td colspan="12" style="text-align:left;"><?php echo $section; ?> -> <strong><?php echo $row->pekerjaan; ?></td>
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
                        <div style="float:left;">Rp. </div>
                        <div style="float:right;"><?= number_format($row->nilai, 2,',','.'); ?></div>
                    </td>
                    <td style="text-align: right; vertical-align: middle; padding: 4px;"><?= number_format($row->bobot, 3,',','.'); ?></td>

                    <td style="text-align: right; vertical-align: middle; padding: 4px">
                      <form action="<?php echo base_url('pekerjaan/save_edit_csv') ?>" method="post">
                      <input type="hidden" class="form-control form-control-sm" value="<?= $id_add ?>" name="id_add" readonly="readonly" required>
                      <input type="hidden" id="iddataproyek" name="dataproyek[]" value="<?php echo $proyek; ?>">
                      <input type="hidden" id="mingg" name="datamingguke[]" value="<?php echo $minggu; ?>">
                      <input type="hidden" id="iduraian" name="iduraian[]" value="<?php echo $row->idkerja; ?>">
                      <input type="hidden" id="idminggu" name="idminggu[]" value="<?php echo $idminggul; ?>">
                      <input type="hidden" id="databobotasli" name="databobotasli[]" value="<?php echo $row->bobot; ?>">
                      <input type="hidden" id="datavolumeasli" name="datavolumeasli[]" value="<?php echo $row->volume; ?>">
                      <?php

                          $minggulalulka =  "SELECT volume_akhir as volumesdminggu FROM `new_bobot_uraian_kerja`JOIN new_pekerjaan ON new_pekerjaan.id = new_bobot_uraian_kerja.fk_id_new_pekerjaan WHERE fk_id_new_pekerjaan = {$row->idkerja} AND fk_id_minggu = {$idminggul} AND new_pekerjaan.proyek= '{$proyek}' AND new_pekerjaan.section = '{$section}' AND new_pekerjaan.pekerjaan = '{$row->pekerjaan}'";
                          $query = $this->db->query($minggulalulka);
                          if ($query->num_rows() > 0) {
                            foreach ($query->result() as $rowp) { ?>

                              <input style=" border:none; width:100%; ;height:100%; text-align: center;" type=number step=0.001 name="datavolume[]" placeholder="<?php echo $rowp->volumesdminggu; ?>" value="<?php echo $rowp->volumesdminggu; ?>">

                      <?php } } ?>
                      
                    </td><!-- s/d volume minggu ini -->
                    <td style="text-align: right; vertical-align: middle; padding: 4px">
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
                            }
                          }
                      ?>
                    </td><!-- s/d bobot minggu ini -->
                    <td style="text-align: right; vertical-align: middle; padding: 4px">
                      <?php
                       // $bobotakhir = $bobotakhir;
                      // echo $bobotakhir;
                      $bobotasli = $row->bobot;
                      if($bobotasli == 0){
                          echo "100 %";
                      }else{
                          $bobotindividu = ($bobotakhir/$bobotasli)*100;
                          echo round(number_format($bobotindividu))."%";
                      }
                       ?>
                    </td><!-- keterangan -->
                    <td style="text-align: right; vertical-align: middle; padding: 4px">
                      <!-- <input style=" border:none; width:100%; ;height:100%; text-align: center;" type="text" name="dataketerangan" value="<?= $row->keterangan; ?>"> -->
                  </td>
                    
                    <td style="text-align: right; vertical-align: middle; padding: 4px">
                      <!-- <button type="submit">Save</button> -->
                    <!-- </form> -->

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
                    <td colspan="5" style="text-align: right; padding: 4px;">Sub total</td>
                    <th>
                      <div style="float:left;">Rp. </div>
                      <div style="float:right;"><?php echo number_format($row->totalnilai, 2,',','.'); ?> </div>
                    </th>
                    <th style="text-align: right; vertical-align: middle; padding: 4px"> <?php echo number_format($row->totalbobot,3,',','.'); ?></th>
                  <?php } } ?>

                  <th></th>
                  <th style="text-align: right; vertical-align: middle; padding: 4px">
                    <?php
                      $idm = $idminggul-1;
                      // echo $row->idkerja;
                      $minggu_sdini =  "SELECT SUM(bobot_akhir) as bobotsdminggu FROM `new_bobot_uraian_kerja`JOIN new_pekerjaan ON new_pekerjaan.id = new_bobot_uraian_kerja.fk_id_new_pekerjaan WHERE fk_id_minggu = {$idminggul} AND new_pekerjaan.proyek= '{$proyek}' AND new_pekerjaan.section = '{$section}' AND new_pekerjaan.pekerjaan = '{$row->pekerjaan}'";
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
                  <th>
                    <button type="submit">Save</button>
                    </form>
                  </th>

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
                </tr>

                <tr>
                  <?php 
                  $sql ="SELECT pekerjaan, SUM(nilai) as totalnilai, SUM(bobot) as totalbobot FROM `new_pekerjaan` WHERE proyek = '$proyek'";
                  $query = $this->db->query($sql);
                  if ($query->num_rows() > 0) {
                    foreach ($query->result() as $row) {
                   ?>
                    <td colspan="5" style="text-align: right; padding: 4px; vertical-align: middle;"><strong>JUMLAH</strong></td>
                    <th style="text-align: right; padding: 4px; vertical-align: middle;">
                      <div style="float:left;">Rp. </div>
                      <div style="float:right;"><?php echo number_format($row->totalnilai, 2,',','.'); ?> </div>
                    </th>

                    <!-- <th style="text-align: right; vertical-align: middle; padding: 4px"> <?php echo number_format(round($row->totalbobot),3,',','.'); ?></th> -->

                    <th style="text-align: right; vertical-align: middle; padding: 4px"> <?php echo number_format($row->totalbobot,3,',','.'); ?></th>
                  <?php } } ?>

                  <th></th>
                  <!-- ini bobot sampai minggu ini -->
                  <th style="text-align: right; vertical-align: middle; padding: 4px">
                    <?php
                      // $idm = $idminggul-1;
                      // echo $row->idkerja;
                      $minggu_sdinia =  "SELECT SUM(bobot_akhir) as bobotsdminggu FROM `new_bobot_uraian_kerja`JOIN new_pekerjaan ON new_pekerjaan.id = new_bobot_uraian_kerja.fk_id_new_pekerjaan WHERE fk_id_minggu = {$idminggul} AND new_pekerjaan.proyek= '{$proyek}'";
                      $query = $this->db->query($minggu_sdinia);
                      if ($query->num_rows() > 0) {
                        foreach ($query->result() as $rowk) {
                          echo number_format($rowk->bobotsdminggu, 3,',','.');
                            $bbt_sdmingguini = $rowk->bobotsdminggu;
                      }}
                      ?>
                  </th>
                  <th></th>
                  <th></th>
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
                    <td colspan="5" style=" text-align: right; padding: 4px; vertical-align: middle;"><strong>PPN 10%</strong></td>
                    <th style=" text-align: right; padding: 4px; vertical-align: middle;">
                      <div style="float:left;">Rp. </div>
                      <div style="float:right;"><?php echo number_format($ppn, 2,',','.'); ?> </div>
                    </th>

                    <th style=" text-align: right; vertical-align: middle; padding: 4px"></th>

                  <?php } } ?> 

                  <th style=""></th>
                  <th style=" text-align: right; vertical-align: middle; padding: 4px">
                  </th>
                  <th style=""></th>
                  <th style="text-align: right; vertical-align: middle; padding: 4px">
                  </th>
                </tr>

                <?php $pln =0; ?>
                
                <tr>
                  <?php 
                  $jml=0;
                  $sql ="SELECT pekerjaan, SUM(nilai) as totalnilai, SUM(bobot) as totalbobot FROM `new_pekerjaan` WHERE proyek = '$proyek'";
                  $query = $this->db->query($sql);
                  if ($query->num_rows() > 0) {
                    foreach ($query->result() as $row) {
                   ?>
                    <td colspan="5" style=" text-align: right; padding: 4px; vertical-align: middle;"><strong>JUMLAH TOTAL</strong></td>
                    <th style=" text-align: right; padding: 4px; vertical-align: middle;">
                      <div style="float:left;">Rp. </div>
                      <?php $jml = $ppn+$row->totalnilai+$pln; ?>
                      <div style="float:right;"><?php echo number_format($jml, 2,',','.'); ?> </div>
                    </th>

                    <th style=" text-align: right; vertical-align: middle; padding: 4px"></th>

                    <!-- <th style="text-align: right; vertical-align: middle; padding: 4px"> <?php echo number_format($row->totalbobot,3,',','.'); ?></th> -->
                  <?php } } ?>

                  <th style=""></th>
                  <th style=" text-align: right; vertical-align: middle; padding: 4px">
                  </th>
                  <th style=""></th>
                  <th style="text-align: right; vertical-align: middle; padding: 4px">
                  </th>
                </tr>
                <tr>
                  <?php 
                  $bulat=0;
                  $total_bulat=0;
                  $sql ="SELECT pekerjaan, SUM(nilai) as totalnilai, SUM(bobot) as totalbobot FROM `new_pekerjaan` WHERE proyek = '$proyek'";
                  $query = $this->db->query($sql);
                  if ($query->num_rows() > 0) {
                    foreach ($query->result() as $row) {
                   ?>
                    <td colspan="5" style=" text-align: right; padding: 4px; vertical-align: middle;"><strong>DIBULATKAN</strong></td>
                    <th style=" text-align: right; padding: 4px; vertical-align: middle;">
                      <div style="float:left;">Rp. </div>
                      <div style="float:right;">
                        <?php 
                        // $jml = "5253240999.91";
                        $ambilnilai = (round($jml -1));
                        $ambilnilaiatas = substr($ambilnilai,0, -3);
                        $ambilnilaibawah = substr($ambilnilai, -3);

                        if ($ambilnilaibawah <= 999){
                          $nilaiasli = $ambilnilaiatas."000";
                          echo number_format($nilaiasli,2,',','.');
                        }
                        ?>
                      </div>
                    </th>

                    <th style=" text-align: right; vertical-align: middle; padding: 4px"></th>

                    <!-- <th style="text-align: right; vertical-align: middle; padding: 4px"> <?php echo number_format($row->totalbobot,3,',','.'); ?></th>-->
                  <?php } } ?> 

                  <th style=""></th>
                  <th style=" text-align: right; vertical-align: middle; padding: 4px">
                  </th>
                  <th style=""></th>
                  <th style="text-align: right; vertical-align: middle; padding: 4px">
                  </th>
                </tr>
                <tr>
                  <td colspan="15" style="padding: 15px;">
                    <table style="border: 0; border-spacing: 0; border: 0px solid #CCC;">
                      <tr>
                        <td style="border: none;">Keterangan :</td>
                      </tr>
                      <tr>
                        <?php
                          // ambil progres komulatif
                        $rencana=0;
                        $sql ="SELECT bobot_total_acuan_komulatif FROM `new_minggu` WHERE id = '$idminggul'";
                        $query = $this->db->query($sql);
                        if ($query->num_rows() > 0) {
                          foreach ($query->result() as $row) {
                            $rencana=$row->bobot_total_acuan_komulatif;
                          }
                        }
                        ?>
                        <td style="border: none;">Progres Rencana</td> <td style="border: none;">:</td> <td style="border: none;"><?= $rencana ?></td> <td style="border: none;">%</td>
                      </tr>
                      <tr>
                        <td style="border: none;">Realisasi s/d Minggu Ini</td> <td style="border: none;">:</td> <td style="border: none;"><?= number_format($bbt_sdmingguini, 3,',','.') ?></td> <td style="border: none;">%</td>
                      </tr>
                      <tr>
                        <td style="border: none;">Deviasi +/-</td> <td style="border: none;">:</td> 

                        <?php
                          if ($bbt_sdmingguini < $rencana) { ?>
                              <td style="color:red; border: none;"><?= number_format($bbt_sdmingguini-$rencana, 3,',','.') ?></td> <td style="color:red; border: none;">%</td>
                              <td style="border: none;"> Minus/Progres Lambat</td>
                            <?php }else{ ?>
                              <td style="border: none;"><?= number_format($bbt_sdmingguini-$rencana, 3,',','.') ?></td> <td style="border: none;">%</td>
                              <td style="border: none;"> Plus/Progres Cepat</td>
                            <?php } ?>
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
            <!-- ini akhir perulangan session -->
        </div>
        <!-- /.row -->
      </div>
      <!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>