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
          <th>No.</th>
          <th>Proyek</th>
          <th>Lokasi</th>
          <th>Tanggal</th>
          <th>Pengawas</th>
          <th>PPK</th>
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
          <td><a href="<?php echo site_url('pekerjaan/new_new_add_kelola_pekerjaan/'.$value->id); ?>"><?php echo $value->proyek; ?></a> </td>
          
          <?php
          $sql ="SELECT `nama` FROM `terminal` WHERE id = '$value->fk_id_terminal' ";
          $query = $this->db->query($sql);
          if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
              $lokasi_terminal = $row->nama;
            }
          }
          ?>
          <td><?php echo $lokasi_terminal; ?> </td>
          
          <!--<td><?php echo $value->lokasi; ?> </td>-->
          <td><a href="<?php echo site_url('pekerjaan/new_new_add_kelola_pekerjaan_bobotperminggu/'.$value->id); ?>"><?php echo $value->tanggalawal; ?> - <?php echo $value->tanggalakhir; ?></a></td>
          <td>
            <?php
              if ($value->fk_id_pengawas != null) {
                  $sql ="SELECT `email` FROM `pengguna` WHERE id = '$value->fk_id_pengawas' ";
                    $query = $this->db->query($sql);
                    if ($query->num_rows() > 0) {
                      foreach ($query->result() as $row) {
                        echo $row->email;
                      }
                    }
                }
                else{
                  echo "Belum memilih Pengawas";
                }
            ?>
          </td>
          <td>
            <?php
              if ($value->fk_id_ppk != null) {
                  $sql ="SELECT `email` FROM `pengguna` WHERE id = '$value->fk_id_ppk' ";
                    $query = $this->db->query($sql);
                    if ($query->num_rows() > 0) {
                      foreach ($query->result() as $row) {
                        echo $row->email;
                      }
                    }
                }
                else{
                  echo "Belum memilih PPK";
                }
            ?>
          </td>

          <td>
            <a href="<?php echo site_url('pekerjaan/new_new_edit_kelola_pekerjaan/'.$value->id); ?>">Edit</a>
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
