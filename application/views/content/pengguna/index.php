<div class="row container-fluid" style="margin-top: 10px;">
  <div class="card col-md-12 col-xs-12">
    <div class="card-header">
      <h5 class="card-title" style="text-align: center;">Data Pengguna</h5>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive">
      <table id="example1" class="table table-bordered table-striped responsif">
        <thead>
        <tr>
          <th>No.</th>
          <th>Email</th>
          <th>Nama</th>
          <th>Password</th>
          <th>Posisi</th>
          <th>Konsultan Pengawas</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
          <?php
              $no = 1;
              foreach ($pengguna as $value) {
              ?>
        <tr>
          <td><?php echo $no++ ?></td>
          <td><?php echo $value->email; ?> </td>
          <td><?php echo $value->nama; ?> </td>
          <td><?php echo $value->password; ?></td>
          <td><?php echo $value->posisi; ?></td>
          <td><?php echo $value->pengawas; ?></td>

          <td> <a href="<?php echo site_url('pengguna/edit/'.$value->id); ?>">Edit</a> |&nbsp;
                  <a href="<?php echo site_url('pengguna/hapus/'.$value->id); ?>">Hapus</a></td>
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
