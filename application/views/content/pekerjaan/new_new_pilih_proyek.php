<div class="row container-fluid" style="margin-top: 10px;">
  <div class="card col-md-12 col-xs-12">
    <div class="card-header">
      <h5 class="card-title" style="text-align: center;">Data Proyek</h5>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive">
      <table id="example1" class="table table-bordered table-striped responsif">
        <thead>
        <tr>
          <th>No.</th>
          <th>Proyek</th>
          <th>Minggu</th>
          <th>Bobot</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
          <?php
              $no = 1;
              foreach ($data as $value) {

              ?>
        <tr>
          <td><?php echo $no++ ?></td>
          <td><?php echo $value->nama_proyek; ?> </td>
          <td style="text-align: center;"><?php echo $value->minggu; ?> (<?php echo $value->tgl_pertama; ?> - <?php echo $value->tgl_kedua; ?>)</td>
          <td style="text-align: center;"><?php echo number_format($value->total_bobot, 1,',','.'); ?> % </td>

          <td style="text-align: center;">
            <form method="post" id="form" action="<?php echo base_url('pekerjaan/new_new_lihat_validasi_minggu')?>">
                <input type="hidden" name="proyek" value="<?= $value->nama_proyek; ?>">
                <input type="hidden" name="idminggu" value="<?= $value->id_minggu; ?>">

                <!-- <input type="text" name="proyekk"> -->
                <button type="submit" id="" class="btn btn-sm btn-primary"><span><i class=""></i> </span><p id="">Cek</p></button>
            </form>
          </td>
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
  });
</script>
