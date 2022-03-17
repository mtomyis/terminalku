<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-9" style="margin-top: 10px;">
            <h5 class="m-0 text-dark">Laporan Pekerjaan</h5>
          </div><!-- /.col -->
          <!-- /.col -->
          <div class="col-sm-1" style="margin-top: 10px;">
              <form method="post" id="form" action="<?php echo base_url('pekerjaan/printpdf')?>">
                  <input type="hidden" name="proyek" value="<?= $proyek; ?>">
                  <!-- <input type="text" name="proyekk"> -->
                  <button type="submit" id="" class="btn btn-success"><span><i class=""></i> </span><p id="ind">Cek</p></button>
              </form> 
              
              </div>

              <div class="col-sm-1" style="margin-top: 10px;">
              <form id="formdelete" method="post" id="form" action="<?php echo base_url('pekerjaan/new_kosongkan')?>">
                  <input type="hidden" name="proyek" value="<?= $proyek; ?>">
                  <!-- <input type="text" name="proyekk"> -->
                  <button type="submit" id="" class="btn btn-warning"><p id="ind">Hapus</p></button>
<!--                   <a href="javascript:void(0)" title="Delete" onclick="delete_data()">
              <span class="nav-icon"><i class="delete-icon"></i></span>
            </a> -->
              </form> 
              
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
<!--             <div class="card-header">
              <h6 class="card-title"> </strong></h6>
            </div> -->
            <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table id="example1" class="table table-bordered responsif">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Uraian pekerjaan</th>
                    <th>Sat</th>
                    <th>Volume</th>
                    <th>Harga Sat</th>
                    <th>Nilai</th>
                    <th>Bobot</th>
                  </tr>

                  <?php 
                  foreach ($section0 as $i) : 
                    $section = $i['section'];
                    // ini untuk perulangan section dimana sati section memiliki banyak pekerjaan

                    $sql ="SELECT id , `pekerjaan` FROM `new_pekerjaan` WHERE section = '$section' GROUP by pekerjaan ORDER BY id ASC";
                    $query = $this->db->query($sql);
                    if ($query->num_rows() > 0) {
                      foreach ($query->result() as $row) {
                        // ini untuk perulangan pekerjaan dengan where kondisi session yang sedang berjalan, misal session 0 meiliki 1 atau 2 pekerjaan
                        ?>

                  
                  </thead>
                  <tbody>
                  <tr>
                    <td colspan="7" style="text-align:left;"><?php echo $section; ?> -> <strong><?php echo $row->pekerjaan; ?></td>
                  </tr>

                  <?php 
                  // untuk mendapatkan Uraian pekerjaan dengan kondisi where hasil perulangan pekerjaan diatas
                  $n = 1;
                  $sql ="SELECT * FROM new_pekerjaan WHERE pekerjaan = '$row->pekerjaan' AND section = '$section' AND proyek = '$proyek' ORDER BY id ASC";
                  $query = $this->db->query($sql);
                  if ($query->num_rows() > 0) {
                    foreach ($query->result() as $row) {
                  ?>

                  <tr>
                    <td style="text-align: center; vertical-align: middle;"><?= $n; ?></td>
                    <td><?= $row->uraian_pekerjaan; ?></td>
                    <td style="text-align: center; vertical-align: middle;"><?= $row->satuan; ?></td>
                    <td style="text-align: right; vertical-align: middle;"><?= number_format($row->volume,3,',','.'); ?></td>
                    <td style="text-align: right; vertical-align: middle;">
                      <div style="float:left;">Rp. </div>
                        <div style="float:right;"><?= number_format($row->harga_satuan, 2,',','.'); ?>
                        </div>
                      </td>
                    <td style="text-align: right; vertical-align: middle;">
                        <div style="float:left;">Rp. </div>
                        <div style="float:right;"><?= number_format($row->nilai, 2,',','.'); ?></div>
                    </td>
                    <td style="text-align: right; vertical-align: middle;"><?= number_format($row->bobot, 3); ?></td>
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
                    <td colspan="5" style="text-align: right;">Sub Total</td>
                    <th>
                      <div style="float:left;">Rp. </div>
                      <div style="float:right;"><?php echo number_format($row->totalnilai, 2,',','.'); ?> </div>
                    </th>
                    <th> <?php echo number_format($row->totalbobot,3,',','.'); ?> % </th>
                  
                  <?php } } ?>
                  <!-- ini untuk mendapatkan nilai bobot dari kondisi where pekerjaan -->
                  </tr>
                  </tbody>
                  <tfoot>
                  
                  </tfoot>
          <?php } } ?>
          <!-- ini akhir perulangan lihat pekerjaan darikondisi where section -->

          <?php endforeach; ?>
          <!-- ini akhir perulangan lihat section -->


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

<script type="text/javascript">
  function delete_data()
  {
    swal({
    title: "DELETE FILE !",
    text: "Are you sure?",
    type: "warning",
    showCancelButton: true,
    confirmButtonText: 'Yes, delete!',
    cancelButtonText: "No, cancel!",
    closeOnConfirm: true,
    closeOnCancel: true,
    },
    function(isConfirm)
    {
      if (isConfirm)
      {
        $('.loading').fadeIn('fast');
        var vproyek = $("#proyek").val();
        $.ajax({
          url : "<?php echo site_url('pekerjaan/kosongkan')?>",
          data: $('#formdelete').serialize(),
          type: "POST",
          dataType: "JSON",
          success: function(data)
          {
            $('.loading').fadeOut('fast');
            if(data.status)
            {
              reload_table();
              reset_form();
            }
            else
            {
              swal("Peringatan ...!", "Anda tidak berhak melakukan perintah ini !", "error"); 
            }
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            $('.loading').fadeOut('fast');
            swal("Upss...!", "Terjadi kesalahan jaringan pesan error : !"+errorThrown, "error");
          }
        });
      } 
      else 
      {
        $('.loading').fadeOut('fast');
          swal("Batal", "Data masih tersimpan:)", "error");
      }
    });
  }
</script>