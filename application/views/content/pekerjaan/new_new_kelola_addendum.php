<div class="row container-fluid" style="margin-top: 10px;">
  <div class="card col-md-12 col-xs-12">
    <div class="card-header">
      <h5 class="card-title" style="text-align: center;">Data Request Addendum</h5>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive">
      <table id="example1" class="table table-bordered responsif" style="font-size: 8pt; width: 100%">
        <thead>
        <tr>
          <th>No.</th>
          <th>Proyek</th>
          <th>PPK</th>
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
              <a href="<?php echo site_url('pekerjaan/new_new_edit_csv/'.$value->idproyek.'/'.$value->id_add); ?>"><?php echo $value->proyekadd; ?></a> 
            <? } else{ 
              echo $value->proyekadd; 
            } ?>
          </td>
          <td><?php echo $value->ppk; ?> </td>
          <td><?php echo $value->surat; ?></td>
          <td><?php echo $value->xls; ?> </td>
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
