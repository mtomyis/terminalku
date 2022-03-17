<div class="row container-fluid" style="margin-top: 10px;">
  <div class="card col-md-12 col-xs-12">
    <div class="card-header">
      <h5 class="card-title" style="text-align: center;">Data Keuangan</h5>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive">
      <table id="example1" class="table table-bordered table-striped responsif">
        <thead>
        <tr>
          <th>No.</th>
          <th>Proyek</th>
          <th>Bobot</th>
          <th>Jangka Waktu</th>
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
          <td><?php echo $value['proyek']; ?></td>
          <td><?php echo $value['total_bobot']; ?> %</td>
          <td><?php echo $value['tersisa']; ?> Hari Tersisa</td>
          <td style="text-align: center;">
            <form class="d-inline" method="post" id="form" action="<?php echo base_url('keuangan/add')?>">
                <input type="hidden" name="proyek" value="<?= $value['proyek']; ?>">
                <button type="submit" class="d-inline btn btn-sm btn-primary"><span><i class=""></i> </span><p id="">Input Termin</p></button>
            </form>
            <form class="d-inline" method="post" id="form" action="<?php echo base_url('keuangan/index')?>">
                <input type="hidden" name="proyek" value="<?= $value['proyek']; ?>">
                <button type="submit" class="d-inline btn btn-sm btn-success"><span><i class=""></i> </span><p id="">History</p></button>
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
