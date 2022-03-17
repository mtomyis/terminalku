<div class="row">
  <div class="col-md-12 col-xs-12 col-lg-12" style="margin-top: 30px;">
    <div class="card card-primary">
      <div class="card-header" align="center">
        <h6 class="card-title">History Addendum <?php echo $data; ?></h6>
      </div>
      <div class="card-body table-responsive">
        <table id="example1" class="table table-bordered table-striped responsif">
          <thead>
          <tr>
            <th rowspan="2">No.</th>
            <th rowspan="2">Surat || Excel</th>
            <th rowspan="2">Tanggal</th>
            <th colspan="2">Perubahan</th>
            <th rowspan="2">Aksi</th>
          </tr>
          <tr>
            <th>Penyesuaian Data</th>
            <th>Data Matang</th>
          </tr>
          </thead>
          <tbody>
            <?php
                $no = 1;
                foreach ($datahistory as $value) {
                ?>
          <tr>
            <td><?php echo $no++ ?></td>
            <td>
              <?php
                $surat="";
                $excel="";
                $pro = "SELECT * FROM `new_request_addendum` WHERE id = '$value->surat_addendum' ";
                $sanaa =  $this->db->query($pro);
                  if ($sanaa->num_rows() > 0) {
                    foreach ($sanaa->result() as $row) {
                      $surat = $row->surat;
                      $excel = $row->xls;
                    }
                  }
              ?>
              <a href="<?php echo site_url('upload/bukti/'.$surat); ?>"><?php echo $surat ?></a>
              ||
              <a href="<?php echo site_url('upload/bukti/'.$excel); ?>"><?php echo $excel ?></a>
            </td>
            <td><?php echo $value->tanggal; ?></td>
            <td style="text-align: center;"><?php echo $value->minggu_penyesuaian; ?></td>
            <td style="text-align: center;"><?php echo $value->minggu_matang; ?></td>
            <td style="text-align: center;">Edit | Delete</td>
          </tr>
            <?php } ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>

