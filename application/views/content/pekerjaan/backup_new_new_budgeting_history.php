

<script src='https://cdn.amcharts.com/lib/4/core.js'></script>
<script src='https://cdn.amcharts.com/lib/4/charts.js'></script>
<script src='https://cdn.amcharts.com/lib/4/themes/animated.js'></script>

<div class="row container-fluid" style="margin-top: 10px;">
  <div class="card col-md-12 col-xs-12">
    <div class="card-header">
      <h5 class="card-title" style="text-align: center;">Data Riwayat Pembayaran</h5>
      <h6 align="center"><?php echo $proyek; ?></h6>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive">
    <div class="row col-md-12">
      <div class="row col-md-6 col-xs-12">
        <!-- ini tabel grafik -->
        <table class="table table-bordered responsif" width="100%">
          <tr>
            <td></td>
            <td>Dana</td>
            <td>Tercairkan</td>
            <td>Belum</td>
          </tr>
          <tr>
            <td>Pelaksana</td>
            <td><?= $rp_asli_pelaksana; ?></td>
            <td><?= $rp_pelaksana; ?></td>
            <td><?= $rp_kurang_pelaksana; ?></td>
          </tr>
          <tr>
            <td>Perencana</td>
            <td><?= $rp_asli_perencana; ?></td>
            <td><?= $rp_perencana; ?></td>
            <td><?= $rp_kurang_perencana; ?></td>
          </tr>
          <tr>
            <td>Pengawas</td>
            <td><?= $rp_asli_pengawas; ?></td>
            <td><?= $rp_pengawas; ?></td>
            <td><?= $rp_kurang_pengawas; ?></td>
          </tr>
          <tr>
            <td>Honorium</td>
            <td><?= $rp_asli_honorium; ?></td>
            <td><?= $rp_honorium; ?></td>
            <td><?= $rp_kurang_honorium; ?></td>
          </tr>
          <tr>
            <td>Perjalanan Dinas</td>
            <td><?= $rp_asli_perjalanan; ?></td>
            <td><?= $rp_perjalanan; ?></td>
            <td><?= $rp_kurang_perjalanan; ?></td>
          </tr>
          <tr>
            <td>Biaya Habis Pakai</td>
            <td><?= $rp_asli_habis; ?></td>
            <td><?= $rp_habis; ?></td>
            <td><?= $rp_kurang_habis; ?></td>
          </tr>
          <tr style="background-color: #00cec9;">
            <td>Sub Total</td>
            <td><?= $rp_asli_total; ?></td>
            <td><?= $rp_total; ?></td>
            <td><?= $rp_kurang_total; ?></td>
          </tr>
        </table>
      </div>
      <div class="row col-md-6 col-xs-12">
        <style>
        #chartdiv {
          width: 100%;
          height: 400px;
        }
        </style>
        <div id='chartdiv'></div>
      </div>
    </div>
    <br><br>
    <div class="row col-md-12">
      <table id="example1" class="table table-bordered responsif" style="font-size: 8pt; width: 100%">
        <thead>
        <tr>
          <th>No.</th>
          <th>Tanggal</th>
          <th>Kategori</th>
          <th>Rincian</th>
          <th>Nilai (Rp.)</th>
          <th>Surat</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
          <?php
              $no = 1;
              $jml = 0;
              foreach ($data as $value) {
              ?>
        <tr>
          <td><?php echo $no++ ?></td>
          <td><?php echo $value->tanggal; ?></td>
          <td><?php echo $value->kategori; ?></a> </td>
          <td><?php echo $value->rincian; ?> </td>
          <td><?php echo number_format($value->nilai, 2,',','.'); ?></td>
          <td><a target="blank" href="<?php echo site_url('pekerjaan/new_new_lihat_history_budget_surat/'.$value->surat); ?>"><?php echo $value->surat; ?></a></td>
          <td>
            <a href="<?php echo site_url('pekerjaan/new_new_edit_kelola_history_budget/'.$value->id); ?>">Edit</a>
          </td>
        </tr>
        <?php $jml += $value->nilai; ?>
              <?php } ?>

        </tbody>
        <tfoot>
            <tr style = "font-weight: bold;">
                <td colspan="6" align ="right">Jumlah</td>
                <td>
                <?php
                echo number_format($jml, 2,',','.'); ?>
                </td>
            </tr>
        </tfoot>
      </table>
    </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>

<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    // am4core.ready(function() {
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create('chartdiv', am4charts.PieChart);
    chart.data = [{
      'kategori': 'Perencana',
      'persen': '<?= $persen_perencana; ?>',
      'color': am4core.color('#00b894')
    }, {
      'kategori': 'Pengawas',
      'persen': '<?= $persen_pengawas; ?>',
      'color': am4core.color('#0984e3')
    }, {
      'kategori': 'Pelaksana',
      'persen': '<?= $persen_pelaksana; ?>',
      'color': am4core.color('#ff7675')
    }, {
      'kategori': 'Honorium',
      'persen': '<?= $persen_honorium; ?>',
      'color': am4core.color('#00cec9')
    }, {
      'kategori': 'Perjalan Dinas',
      'persen': '<?= $persen_perjalanan; ?>',
      'color': am4core.color('#6c5ce7')
    }, {
      'kategori': 'Habis Pakai',
      'persen': '<?= $persen_habis; ?>',
      'color': am4core.color('#636e72')
    }, {
      'kategori': 'Belum terbayar',
      'persen': '<?= $persen_kekurangan; ?>',
      'color': am4core.color('#dfe6e9')
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
