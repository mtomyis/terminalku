<div class="row container-fluid" style="margin-top: 10px;">
  <div class="card col-md-12 col-xs-12">
    <div class="card-header">
      <h5 class="card-title" style="text-align: center;">Data Pengajuan Addendum</h5>
    </div>
    <br>
      <a style="width: 200px;" class="btn btn-sm btn-success container" href="<?php echo site_url('pekerjaan/new_new_buat_addendum/'); ?>">Buat Addendum</a>
    <br>
    <!-- /.card-header -->
    <div class="card-body table-responsive">
      <table id="example1" class="table table-bordered responsif" style="font-size: 8pt; width: 100%">
        <thead>
        <tr>
          <th>No.</th>
          <th>Proyek</th>
          <th>Surat Addendum</th>
          <th>Excel</th>
          <th>Tanggal Request</th>
          <th>Tanggal Selesai</th>
          <th>Status</th>
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

          <td>
            <?php if ($value->status == "1") { ?>
              <?php echo $value->proyekadd; ?>
            <? } else{ 
              echo $value->proyekadd; 
            } ?>
          </td>
          <td><a href="<?php echo base_url('upload/bukti/'.$value->surat) ?>"><?php echo $value->surat; ?></a></td>
          <td><a href="<?php echo base_url('upload/bukti/'.$value->xls) ?>"><?php echo $value->xls; ?></a> </td>
          <td><?php echo $value->tanggal_request; ?> </td>
          <td><?php echo $value->tanggal_selesai; ?> </td>
          <td>
          <?php if ($value->status == "1") {
            echo '<span class="badge badge-warning">Request</span>';
          } else{
            echo '<span class="badge badge-success">Tervalidasi</span>';
          } ?>
          </td>
          <td>
            <a href="<?php echo site_url('pekerjaan/new_new_edit_kelola_addendum/'.$value->id_add); ?>">Edit</a>
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
