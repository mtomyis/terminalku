<div class="row">
  <div class="container">
        <!-- Info boxes -->
         <div class="col-md-12 col-xs-12 col-lg-12">
            <!-- general form elements -->
            <div class="card card-primary" style="margin-top: 10px;">
              <div class="card-header" align="center">
                <h6 class="card-title">Detail Pekerjaan</h6>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method='post' action='<?php echo base_url('pekerjaan/new_new_hapus_kelola_pekerjaan') ?>' enctype="multipart/form-data">

              <div class="row">
                <div class="col-6">
                <div class="card-body">
                  <div class='form-group'>
                    <label>Nama Proyek</label>
                    <input type="text" class="form-control form-control-sm" value="<?= $data->proyek ?>" name="proyek" readonly="readonly" required>
                  </div>
                 <!--  <div class='form-group'>
                    <label>Lokasi</label>
                    <input type="text" class="form-control form-control-sm" value="<?= $data->lokasi ?>" name="" readonly="readonly" required>
                  </div> -->
                  <div class='form-group'>
                    <label>Lokasi Terminal</label>
                    <input type="text" class="form-control form-control-sm" value="<?php

                    if ($data->fk_id_terminal != null) {
                      $sql ="SELECT `nama` FROM `terminal` WHERE id = '$data->fk_id_terminal' ";
                        $query = $this->db->query($sql);
                        if ($query->num_rows() > 0) {
                          foreach ($query->result() as $row) {
                            echo $row->nama;
                          }
                        }
                    }else{echo "Belum Dipilih"; }
                 ?>" name="" readonly="readonly" required>
                  </div>
                  <div class='form-group'>
                    <label>Provinsi</label>
                    <input type="text" class="form-control form-control-sm" value="<?= $data->provinsi ?>" name="" readonly="readonly" required>
                  </div>
                  <div class='form-group'>
                    <label>Tahun Anggaran</label>
                    <input type="text" class="form-control form-control-sm" value="<?= $data->thn_anggaran ?>" name="" readonly="readonly" required>
                  </div>
                  <div class='form-group'>
                    <label>Tanggal</label>
                    <input type="text" class="form-control form-control-sm" value="<?= $data->tanggalawal ?> - <?= $data->tanggalakhir ?>" name="" readonly="readonly" required>
                  </div>
                  
                  <div class='form-group'>
                    <label>Pelaksana</label>
                    <input type="text" class="form-control form-control-sm" value="<?= $data->pelaksana ?>" name="pelaksana" readonly="readonly" required>
                  </div>
                  
                </div>
              </div>
              <div class="col-6">
                <div class="card-body">
                  <div class='form-group'>
                    <label>Pengawas</label>
                    <input type="text" class="form-control form-control-sm" value="<?php

                    if ($data->fk_id_pengawas != null) {
                      $sql ="SELECT `email` FROM `pengguna` WHERE id = '$data->fk_id_pengawas' ";
                        $query = $this->db->query($sql);
                        if ($query->num_rows() > 0) {
                          foreach ($query->result() as $row) {
                            echo $row->email;
                          }
                        }
                    }else{echo "Belum Dipilih"; }
                 ?>" name="" readonly="readonly" required>
                  </div>
                  <div class='form-group'>
                    <label>PPK</label>
                    <input type="text" class="form-control form-control-sm" value="<?php

                    if ($data->fk_id_ppk != null) {
                      $sql ="SELECT `email` FROM `pengguna` WHERE id = '$data->fk_id_ppk' ";
                        $query = $this->db->query($sql);
                        if ($query->num_rows() > 0) {
                          foreach ($query->result() as $row) {
                            echo $row->email;
                          }
                        }
                    }else{echo "Belum Dipilih"; }
                 ?>" name="" readonly="readonly" required>
                  </div>
                  <div class='form-group'>
                    <label>KPA</label>
                    <input type="text" class="form-control form-control-sm" value="<?php

                    if ($data->fk_id_kpa != null) {
                      $sql ="SELECT `email` FROM `pengguna` WHERE id = '$data->fk_id_kpa' ";
                        $query = $this->db->query($sql);
                        if ($query->num_rows() > 0) {
                          foreach ($query->result() as $row) {
                            echo $row->email;
                          }
                        }
                    }else{echo "Belum Dipilih"; }
                 ?>" name="" readonly="readonly" required>
                  </div>
                  
                  <!-- <div class='form-group'>
                    <label>KASUBDIT</label>
                    <input type="text" class="form-control form-control-sm" value="<?php

                    if ($data->fk_id_kasubdit != null) {
                      $sql ="SELECT `email` FROM `pengguna` WHERE id = '$data->fk_id_kasubdit' ";
                        $query = $this->db->query($sql);
                        if ($query->num_rows() > 0) {
                          foreach ($query->result() as $row) {
                            echo $row->email;
                          }
                        }
                    }else{echo "Belum Dipilih"; }
                 ?>" name="" readonly="readonly" required>
                  </div> -->
                  
                  <div class='form-group'>
                    <label>Unit Kerja</label>
                    <input type="text" class="form-control form-control-sm" value="<?= $data->unitkerja ?>" name="unitkerja" readonly="readonly" required>
                  </div>
                  
                </div>
              </div>
              </div>
            </div>
            <div class="card-footer"  align="center">
              <a class="btn btn-warning" style="margin-right: 20px;" href="<?php echo base_url('pekerjaan/new_new_kelola_pekerjaan') ?>">Kembali</a>
              <!-- <a class="btn btn-primary" style="margin-right: 20px;" href="<?php echo base_url('pekerjaan/new_new_history_edit_csv/') ?><?= $data->id ?>">History Addendum</a> -->
             <input class="btn btn-danger" type='submit' value='Hapus' name='hapus'>
            </div>
            </form>
            <!-- /.card -->
          </div>
        <!-- /.row -->
  </div><!--/. container-fluid -->
</div>