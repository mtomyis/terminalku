<div class="row container-fluid" style="margin-top: 10px;">
  <div class="card col-md-12 col-xs-12">
    <div class="card-header">
      <h5 class="card-title" style="text-align: center;">Data Pekerjaan</h5>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive">
      <table id="example1" class="table table-bordered table-striped responsif">
        <thead>
        <tr>
          <th rowspan="2">No.</th>
          <th rowspan="2">Minggu</th>
          <th rowspan="2">Tanggal</th>
          <th colspan="2">Rencana Persentase</th>
          <th rowspan="2">Aksi</th>
        </tr>
        <tr>
          <th>perminggu</th>
          <th>Komulatif</th>
        </tr>
        </thead>
        <tbody>
          <?php
              $no = 1;
              foreach ($data as $value) {
              ?>
        <tr>
          <td><?php echo $no++ ?></td>
          <td><?php echo $value->minggu; ?></td>
          <td><?php echo $value->tgl_awal; ?> - <?php echo $value->tgl_akhir; ?></td>
          <td style="text-align: right; vertical-align: middle; padding: 4px"><!-- volume minggu ini -->
            <form action="<?php echo base_url('pekerjaan/bobotperminggu') ?>" method="post">
            <input type="hidden" id="minggu" name="datamingguke" value="<?php echo $value->minggu; ?>">
            <input type="hidden" id="proyek" name="dataproyek" value="<?php echo $value->proyek; ?>">
            <input type="hidden" id="idminggu" name="idminggu" value="<?php echo $value->id; ?>">
            <input style=" border:none; width:100%; ;height:100%; text-align: center;" type=number step=0.001 name="databobotacuan" placeholder="<?php echo $value->bobot_persentase_total_acuan; ?>">
          </td>
          <td style="text-align: center;">
            <?php echo $value->bobot_persentase_total_acuan_komulatif; ?>
          </td>

          <td style="text-align: center;">
            <button type="submit">Save</button>
          </td>
            </form>
        </tr>
              <?php } ?>

        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>

<!-- page script -->
<!-- <script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
</script> -->
