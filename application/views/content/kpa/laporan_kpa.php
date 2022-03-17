<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src='https://cdn.amcharts.com/lib/4/core.js'></script>
<script src='https://cdn.amcharts.com/lib/4/charts.js'></script>
<script src='https://cdn.amcharts.com/lib/4/themes/animated.js'></script>

<div class="row">
  <div class="container-fluid">
    <div class="card card-primary">
          <div class="card-body">

    <div class="col-md-12 col-xs-12 col-lg-12" style="margin-top: 10px;">
      <p style="text-align: center; font-size: 12pt;"><strong>Laporan Revitalisasi Terminal</strong></p>
      <div class="row" style="margin-top: 10px;">
      <div class="col-md-6 col-xs-12">
        <!-- schedule -->
        <p style="text-align: center;"><strong>Grafik Jadwal Pekerjaan</strong></p>
        <div class="table-responsive">
          <table id="example1" class="table-bordered" style="font-size: 10pt; width: 100%">
            <tr>
              <td>
                <canvas id="myChart"></canvas>
              </td>
            </tr>
          </table>
        </div>
      </div>
      <div class="col-md-6 col-xs-12">
        <!-- keuangan -->
        <p style="text-align: center;"><strong>Grafik Keuangan Pekerjaan</strong></p>
        <style>
        #chartdiv {
          width: 100%;
          height: 350px;
        }
        </style>
        <div id='chartdiv'></div>
      </div>

    </div>

    <div class="row" style="margin-top: 30px;">
      <div class="col-md-12 col-xs-12">
        <!-- mingguan -->
        <p style="text-align: center;"><strong>Laporan Pekerjaan</strong></p>
        <div class="table-responsive">
            <table id="example1" class="table-bordered" style="font-size: 10pt; width: 100%">
              <thead>
              <tr>
                <th style="width: 10px; text-align: center;" rowspan="2">No</th>
                <th rowspan="2" style="width: 200px; text-align: center;">Uraian pekerjaan</th>
                <th rowspan="2" style="width: 30px; text-align: center;">Nilai</th>
                <th style="text-align: center; width: 30px;" rowspan="2">Bobot</th>
                <th style="text-align: center;" colspan="3">Realisasi Mingguan</th>
                <th style="text-align: center; width: 50px;" rowspan="2">Bobot Individu</th>
              </tr>
              <tr>
                <th style="text-align: center; width: 30px;">Bobot Minggu Lalu</th>
                <th style="text-align: center; width: 30px;">Bobot Minggu ini</th>
                <th style="text-align: center; width: 30px;">Bobot s/d Minggu ini</th>
              </tr>
              </thead>
              <form class="form-volume" action="<?php echo base_url('pekerjaan_dephub/save_edit_ajax') ?>" method="post">

              <?php 
                $n = 1;
                $totalnilai=0;
                $totalbobot=0;

                $sql ="SELECT new_pekerjaan_dephub.id as idkerja, 
                new_pekerjaan_dephub.uraian_subpekerjaan, 
                new_pekerjaan_dephub.nilai, 
                new_pekerjaan_dephub.bobot, 
                new_bobot_uraian_kerja_dephub.persentase_detail,
                new_bobot_uraian_kerja_dephub.persentase_akhir,
                new_bobot_uraian_kerja_dephub.bobot_persentase_detail,
                new_bobot_uraian_kerja_dephub.bobot_persentase_akhir
                FROM new_pekerjaan_dephub JOIN new_bobot_uraian_kerja_dephub
                ON new_pekerjaan_dephub.id = new_bobot_uraian_kerja_dephub.fk_idnew_pekerjaan_dephub
                WHERE new_pekerjaan_dephub.proyek = '$proyek' AND new_bobot_uraian_kerja_dephub.fk_id_minggu = '$idminggul' ORDER BY new_pekerjaan_dephub.id ASC";
                $query = $this->db->query($sql);
                if ($query->num_rows() > 0) {
                  foreach ($query->result() as $row) {
                    // ini untuk perulangan pekerjaan dengan where kondisi session yang sedang berjalan, misal session 0 meiliki 1 atau 2 pekerjaan
                    ?>
              <tbody>
                <tr>
                  <td style="text-align: center; vertical-align: middle;"><?= $n++; ?></td>
                  <td style="padding: 4px; text-align: left;"><?php echo $row->uraian_subpekerjaan; ?></td>
                  <td style="text-align: right; vertical-align: middle; padding: 4px">
                    <div style="float:left;">Rp. </div>
                    <div style="float:right;"><?= number_format($row->nilai, 2,',','.'); ?></div>
                  </td>
                  <td style="text-align: right; vertical-align: middle; padding: 4px;"><?= number_format($row->bobot, 3,',','.'); ?></td>
                  <td style="text-align: right; vertical-align: middle; padding: 4px">
                    <!-- minggu lalu -->
                    <?php if ($minggu=="minggu ke- 1") {
                      echo "0";
                    } elseif ($minggu!=="minggu ke- 1"){
                      $idm = $idminggul-1;
                      $minggulalu =  "SELECT persentase_akhir FROM `new_bobot_uraian_kerja_dephub` WHERE fk_id_minggu = '$idm' AND fk_idnew_pekerjaan_dephub = '$row->idkerja' AND proyek = '{$proyek}'";
                      $query = $this->db->query($minggulalu);
                      if ($query->num_rows() > 0) {
                        foreach ($query->result() as $royw) {
                          echo number_format($royw->persentase_akhir, 3,',','.');
                        }}
                    }
                    ?>
                  </td>
                  <td style="text-align: right; vertical-align: middle; padding: 4px">
                    <!-- minggu ini -->
                    <input type="hidden" id="iddataproyek" name="dataproyek[]" value="<?php echo $proyek; ?>">
                    <input type="hidden" id="mingg" name="datamingguke[]" value="<?php echo $minggu; ?>">
                    <input type="hidden" id="iduraian" name="iduraian[]" value="<?php echo $row->idkerja; ?>">
                    <input type="hidden" id="idminggu" name="idminggu[]" value="<?php echo $idminggul; ?>">
                    <input type="hidden" id="bobotasli" name="bobotasli[]" value="<?php echo $row->bobot; ?>">
                    <?php if($posisi = $this->session->userdata('posisi') == "0"){ ?>
                    <?php echo $row->persentase_detail; ?>
                    <?php }?>
                    <?php if($posisi = $this->session->userdata('posisi') != "0"){ ?>
                    <?php echo $row->persentase_detail; ?>
                    <?php }?>
                  </td>

                  <td style="text-align: right; vertical-align: middle; padding: 4px">
                    <!-- sd minggu ini -->
                    <?php
                      $minggulalulka =  "SELECT persentase_akhir as bobotsdminggu FROM `new_bobot_uraian_kerja_dephub` WHERE fk_idnew_pekerjaan_dephub = {$row->idkerja} AND fk_id_minggu = {$idminggul} AND proyek= '{$proyek}'";
                      $query = $this->db->query($minggulalulka);
                      if ($query->num_rows() > 0) {
                        foreach ($query->result() as $rowp) {
                          echo number_format($rowp->bobotsdminggu, 3,',','.');
                        }
                      }
                    ?>
                  </td>

                  <td style="text-align: right; vertical-align: middle; padding: 4px">
                    <!-- sd minggu ini -->
                    <?php
                      $minggulalulka =  "SELECT bobot_persentase_akhir as bobotsdminggu FROM `new_bobot_uraian_kerja_dephub` WHERE fk_idnew_pekerjaan_dephub = {$row->idkerja} AND fk_id_minggu = {$idminggul} AND proyek= '{$proyek}'";
                      $query = $this->db->query($minggulalulka);
                      if ($query->num_rows() > 0) {
                        foreach ($query->result() as $rowp) {
                          echo number_format($rowp->bobotsdminggu, 1,',','.')." %";
                        }
                      }
                    ?>
                  </td>

                </tr>
              </tbody>
              <?php
              $totalnilai+=$row->nilai;
              $totalbobot+=$row->bobot;
              ?>
              <?php } } ?>
              <tfoot>
                <tr>
                  <th style="text-align: right; vertical-align: middle; padding: 4px" colspan="2">
                    Sub Total
                  </th>
                  <th style="text-align: right; vertical-align: middle; padding: 4px">
                    <div style="float:left;">Rp. </div>
                    <div style="float:right;"><?= number_format($totalnilai, 2,',','.'); ?></div>
                  </th>
                  <th style="text-align: right; vertical-align: middle; padding: 4px;"><?= number_format($totalbobot,3,',','.'); ?> %</th>
                  <th style="text-align: right; vertical-align: middle; padding: 4px">
                    <!-- total akhir persentase lalu -->
                    <?php
                    $bbt_minggulalu=0;
                    $bbt_mingguini=0;
                    $bbt_sdmingguini=0;

                    if ($minggu=="minggu ke- 1") {
                      echo "0 %";
                    } elseif ($minggu!=="minggu ke- 1"){
                      $idm = $idminggul-1;
                      $minggulalu =  "SELECT SUM(persentase_akhir) as persentase_akhir FROM `new_bobot_uraian_kerja_dephub` WHERE fk_id_minggu = '$idm' AND proyek = '{$proyek}'";
                      $query = $this->db->query($minggulalu);
                      if ($query->num_rows() > 0) {
                        foreach ($query->result() as $royw) {
                          echo number_format($royw->persentase_akhir, 3,',','.')." %";
                          $bbt_minggulalu = $royw->persentase_akhir;
                        }}
                    }
                    ?>
                  </th>
                  <th style="text-align: center; vertical-align: middle; padding: 4px">
                    <!-- total akhir persentase ini -->
                    <?php
                      $mingguini =  "SELECT SUM(persentase_detail) as persentase_detail FROM `new_bobot_uraian_kerja_dephub` WHERE fk_id_minggu = {$idminggul} AND proyek= '{$proyek}'";
                      $query = $this->db->query($mingguini);
                      if ($query->num_rows() > 0) {
                        foreach ($query->result() as $rowp) {
                          echo number_format($rowp->persentase_detail, 3,',','.')." %";
                          $bbt_mingguini = $rowp->persentase_detail;
                        }
                      }
                    ?>
                  </th>
                  <th style="text-align: right; vertical-align: middle; padding: 4px">
                    <!-- total akhir persentase sd ini -->
                    <?php
                      $minggusd_ini =  "SELECT SUM(persentase_akhir) as persentase_akhir FROM `new_bobot_uraian_kerja_dephub` WHERE fk_id_minggu = {$idminggul} AND proyek= '{$proyek}'";
                      $query = $this->db->query($minggusd_ini);
                      if ($query->num_rows() > 0) {
                        foreach ($query->result() as $rowp) {
                          echo number_format($rowp->persentase_akhir, 3,',','.')." %";
                          $bbt_sdmingguini = $rowp->persentase_akhir;
                        }
                      }
                    ?>
                  </th>
                  <th></th>
                </tr>
                <tr>
                  <td colspan="8" style="text-align: right;">
                    <a target="_blank" href="<?php echo site_url('upload/laporan/'.$pdfdokumentasi); ?>" class="btn btn-sm btn-primary"><span><i class=""></i> </span><p id="">Dokumentasi</p></a>
                  </td>
                  <!-- <td style="text-align: center; vertical-align: middle; padding: 4px">
                    <?php echo ""; ?>
                  </td> -->
                </tr>
                <tr>
                  <td colspan="8" style="padding: 15px;">
                    <table style="border: 0; border-spacing: 0; border: 0px solid #CCC;">
                      <tr>
                        <td style="border: none;">Keterangan :</td>
                      </tr>
                      <tr>
                      <?php
                        // ambil progres komulatif
                        $rencana=0;
                        $sql ="SELECT bobot_persentase_total_acuan_komulatif FROM `new_minggu_dephub` WHERE id = '$idminggul'";
                        $query = $this->db->query($sql);
                        if ($query->num_rows() > 0) {
                          foreach ($query->result() as $row) {
                            $rencana=$row->bobot_persentase_total_acuan_komulatif;
                          }
                        }
                      ?>
                        <td style="border: none;">Progres Rencana </td>
                        <td style="border: none;">&nbsp;:&nbsp;</td>
                        <td style="border: none;"><?= number_format($rencana, 3,',','.') ?></td><td style="border: none;">%</td>
                      </tr>
                      <tr>
                        <td style="border: none;">Realisasi Minggu Lalu</td> <td style="border: none;">&nbsp;:&nbsp;</td> <td style="border: none;"><?= number_format($bbt_minggulalu, 3,',','.') ?></td> <td style="border: none;">%</td>
                      </tr>
                      <tr>
                        <td style="border: none;">Realisasi Minggu Ini</td> <td style="border: none;">&nbsp;:&nbsp;</td> <td style="border: none;"><?= number_format($bbt_mingguini, 3,',','.') ?></td> <td style="border: none;">%</td>
                      </tr>
                      <tr>
                        <td style="border: none;">Realisasi s/d Minggu Ini</td> <td style="border: none;">&nbsp;:&nbsp;</td> <td style="border: none;"><?= number_format($bbt_sdmingguini, 3,',','.') ?></td> <td style="border: none;">%</td>
                      </tr>
                      <tr>
                        <td style="border: none;">Deviasi +/- </td> <td style="border: none;">&nbsp;:&nbsp;</td> 
                        <?php
                        if ($bbt_sdmingguini < $rencana) { ?>
                            <td style="color:red; border: none;"><?= number_format($bbt_sdmingguini-$rencana, 3,',','.') ?></td> <td style="color:red; border: none;">%</td>
                            <td style="border: none;">&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#exampleModalCenter">Minus/Progres Lambat</a></td>
                          <?php }elseif ($bbt_sdmingguini==$rencana) { ?>
                            <td style="border: none;"><?= number_format($bbt_sdmingguini-$rencana, 3,',','.') ?></td> <td style="border: none;">%</td>
                            <td style="border: none;">Sesuai <strong><i>Schedule</i></strong></td>
                          <?php }else{ ?>
                            <td style="border: none;"><?= number_format($bbt_sdmingguini-$rencana, 3,',','.') ?></td> <td style="border: none;">%</td>
                            <td style="border: none;">&nbsp;&nbsp;Plus/Progres Cepat</td>
                        <?php } ?>
                      </tr>
                    </table>
                  </td>
                </tr>
              </tfoot>
            </table>
        </div> <!-- div table responsif -->
      </div>
      <!-- <div class="col-md-4 col-xs-12"> -->
        <!-- dokumentasi -->
      <!-- </div> -->
    </div> <!-- div row -->
    
    </div>

      </div> <!-- div card body -->
  </div> <!-- div card primary -->

  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Keterangan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
        // ambil progres komulatif
        $masalah=0;
        $solusi=0;
        $sql ="SELECT masalah, solusi FROM `new_minggu_dephub` WHERE id = '$idminggul'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
          foreach ($query->result() as $row) {
            $masalah=$row->masalah;
            $solusi=$row->solusi;
          }
        }
      ?>
      <h5> Permasalahan : </h5>
      <p style="white-space: pre-line"><?= $masalah; ?></p>
      <h5> Solusi : </h5>
      <p style="white-space: pre-line"><?= $solusi; ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- srcipt schedul grafik -->
  <script>
  var datarencana = [];
  var datarealisasi = [];
  var dataminggu = [];

  $.each(<?= json_encode($datarencanaa) ?>, function(test, item){
      if (item.persentase_total_acuan_komulatif == 0) {
        item.persentase_total_acuan_komulatif = null;
    }
      datarencana.push(item.persentase_total_acuan_komulatif);
  })
  $.each(<?= json_encode($datarealisasia) ?>, function(test, item){
    if (item.persentase_total == 0) {
        item.persentase_total = null;
    }
      datarealisasi.push(item.persentase_total);
  })

  $.each(<?= json_encode($dataminggua) ?>, function(test, item){
      dataminggu.push(item.minggu);
  })

  var ctx = document.getElementById('myChart').getContext('2d');

  var myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: dataminggu,
          datasets: [{
              label: 'Realisasi',
              data: datarealisasi,
              backgroundColor: ['rgba(255, 99, 132, 0.2)'],
              borderColor: ['rgba(255, 99, 132, 1)'],
              borderWidth: 1
          },{
        label: 'Rencana',
              data: datarencana,
        backgroundColor: ['rgba(54, 162, 235, 1)'],
              borderColor: ['rgba(75, 192, 192, 1)'],
              borderWidth: 1
        }
          ]
      },
      options: {
      responsive: true,
      title: {
        display: true,
        text: 'Grafik Jadwal Rencana dan Realisasi'
      },
      tooltips: {
        mode: 'index',
        intersect: false,
      },
      hover: {
        mode: 'nearest',
        intersect: true
      },
      scales: {
        xAxes: [{
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Minggu'
          }
        }],
              
        yAxes: [{
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Bobot'
          }
        }]
      }
    }
  });
</script>
<!-- srcipt schedul grafik -->

<!-- srcipt keuangan grafik pie -->
<script>
  $(function () {
  // am4core.ready(function() {
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create('chartdiv', am4charts.PieChart);
    chart.data = [{
      'kategori': 'Terbayar',
      'persen': '<?= $persen_pelaksana; ?>',
      'color': am4core.color('#00cec9')
    }, {
      'kategori': 'Belum terbayar',
      'persen': '<?= $persen_kekurangan; ?>',
      'color': am4core.color('#ff7675')
    }];
    var pieSeries = chart.series.push(new am4charts.PieSeries());
    pieSeries.radius = am4core.percent(100);
    pieSeries.dataFields.value = 'persen';
    pieSeries.dataFields.category = 'kategori';
    pieSeries.slices.template.stroke = am4core.color('#fff');
    pieSeries.slices.template.strokeWidth = 2;
    pieSeries.slices.template.strokeOpacity = 1;
    
    // This creates initial animation
    pieSeries.hiddenState.properties.opacity = 1;
    pieSeries.hiddenState.properties.endAngle = -90;
    pieSeries.hiddenState.properties.startAngle = -90;
    
    pieSeries.labels.template.disabled = true;
    pieSeries.ticks.template.disabled = true;

    pieSeries.slices.template.propertyFields.fill = 'color';
    chart.legend = new am4charts.Legend();

  });
</script>
<!-- srcipt keuangan grafik pie -->
