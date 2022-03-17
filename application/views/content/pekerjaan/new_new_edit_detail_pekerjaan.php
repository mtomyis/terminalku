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
              <form method='post' action='<?php echo base_url('pekerjaan/new_new_update_kelola_pekerjaan') ?>' enctype="multipart/form-data">
                
              <div class="row">
                <div class="col-6">
                <div class="card-body">
                  <div class='form-group'>
                    <label>Nama Proyek</label>
                    <input type="hidden" class="form-control form-control-sm" value="<?= $data->id ?>" name="id" required>
                    <input type="text" class="form-control form-control-sm" value="<?= $data->proyek ?>" name="" readonly="readonly" required>
                  </div>
                  <!-- <div class='form-group'>
                    <label>Lokasi</label>
                    <input type="text" class="form-control form-control-sm" value="<?= $data->lokasi ?>" name="lokasi" required>
                  </div> -->

                  <div class='form-group'>
                    <label>Lokasi Terminal</label>
                    <select class='form-control form-control-sm' id='terminal' name='terminal'>
                      <option value='<?= $data->fk_id_terminal ?>'><? 

                      if ($data->fk_id_terminal != null) {
                      $sql ="SELECT `nama` FROM `terminal` WHERE id = '$data->fk_id_terminal' ";
                        $query = $this->db->query($sql);
                        if ($query->num_rows() > 0) {
                          foreach ($query->result() as $row) {
                            echo $row->nama;
                          }
                        }
                    }

                    ?></option>
                      <? foreach($terminal as $value){ ?>
                      <option value="<?php echo $value->id;?>" > <?php echo $value->nama;?></option>
                    <? } ?>
                      
                    </select>
                  </div>

                  <div class='form-group'>
                    <label>Provinsi</label>
                    <input type="text" class="form-control form-control-sm" value="<?= $data->provinsi ?>" name="provinsi" required>
                  </div>
                  <div class='form-group'>
                    <label>Tahun Anggaran</label>
                    <input type="text" class="form-control form-control-sm" value="<?= $data->thn_anggaran ?>" name="thn" required>
                  </div>
                  <div class='form-group'>
                    <label>Tanggal</label>
                    <input type="text" class="form-control form-control-sm" value="<?= $data->tanggalawal ?> - <?= $data->tanggalakhir ?>" name="" readonly="readonly" required>
                  </div>
                  
                  <div class='form-group'>
                    <label>Pelaksana</label>
                    <input type="text" class="form-control form-control-sm" value="<?= $data->pelaksana ?>" name="pelaksana" required>
                  </div>
                  
                </div>
              </div>
              <div class="col-6">
                <div class="card-body">
                  <div class='form-group'>
                    <label>Pengawas</label>

                    <select class='form-control form-control-sm' id='pengawas' name='pengawas' required>
                      <option value='<?= $data->fk_id_pengawas ?>'><? 

                      if ($data->fk_id_pengawas != null) {
                      $sql ="SELECT `email` FROM `pengguna` WHERE id = '$data->fk_id_pengawas' ";
                        $query = $this->db->query($sql);
                        if ($query->num_rows() > 0) {
                          foreach ($query->result() as $row) {
                            echo $row->email;
                          }
                        }
                    } 

                    ?></option>
                      <? foreach($pengawas as $value){ ?>
                      <option value="<?php echo $value->id;?>" > <?php echo $value->email;?></option>
                    <? } ?>
                      
                    </select>
                  </div>
                  <div class='form-group'>
                    <label>PPK</label>
                    <select class='form-control form-control-sm' id='ppk' name='ppk' required>
                      <option value='<?= $data->fk_id_ppk ?>'><? 

                      if ($data->fk_id_ppk != null) {
                      $sql ="SELECT `email` FROM `pengguna` WHERE id = '$data->fk_id_ppk' ";
                        $query = $this->db->query($sql);
                        if ($query->num_rows() > 0) {
                          foreach ($query->result() as $row) {
                            echo $row->email;
                          }
                        }
                    } 

                    ?></option>
                      <? foreach($ppk as $value){ ?>
                      <option value="<?php echo $value->id;?>" > <?php echo $value->email;?></option>
                    <? } ?>
                      
                    </select>
                  </div>
                  <div class='form-group'>
                    <label>KPA</label>
                    <select class='form-control form-control-sm' id='kpa' name='kpa' required>
                      <option value='<?= $data->fk_id_kpa ?>'><? 

                      if ($data->fk_id_kpa != null) {
                      $sql ="SELECT `email` FROM `pengguna` WHERE id = '$data->fk_id_kpa' ";
                        $query = $this->db->query($sql);
                        if ($query->num_rows() > 0) {
                          foreach ($query->result() as $row) {
                            echo $row->email;
                          }
                        }
                    }

                    ?></option>
                      <? foreach($kpa as $value){ ?>
                      <option value="<?php echo $value->id;?>" > <?php echo $value->email;?></option>
                    <? } ?>
                      
                    </select>
                  </div>

                  



                  <div hidden class='form-group'>
                    <label>PPSPM</label>
                    <select class='form-control form-control-sm' id='ppspm' name='ppspm'>
                      <option value='<?= $data->fk_id_ppspm ?>'><? 

                      if ($data->fk_id_ppspm != null) {
                      $sql ="SELECT `email` FROM `pengguna` WHERE id = '$data->fk_id_ppspm' ";
                        $query = $this->db->query($sql);
                        if ($query->num_rows() > 0) {
                          foreach ($query->result() as $row) {
                            echo $row->email;
                          }
                        }
                    }

                    ?></option>
                      <? foreach($ppspm as $value){ ?>
                      <option value="<?php echo $value->id;?>" > <?php echo $value->email;?></option>
                    <? } ?>
                      
                    </select>
                  </div>
                  <div hidden class='form-group'>
                    <label>KASUBDIT</label>
                    <select class='form-control form-control-sm' id='kasubdit' name='kasubdit'>
                      <option value='<?= $data->fk_id_kasubdit ?>'><? 

                      if ($data->fk_id_kasubdit != null) {
                      $sql ="SELECT `email` FROM `pengguna` WHERE id = '$data->fk_id_kasubdit' ";
                        $query = $this->db->query($sql);
                        if ($query->num_rows() > 0) {
                          foreach ($query->result() as $row) {
                            echo $row->email;
                          }
                        }
                    }

                    ?></option>
                      <? foreach($kasubdit as $value){ ?>
                      <option value="<?php echo $value->id;?>" > <?php echo $value->email;?></option>
                    <? } ?>
                      
                    </select>
                  </div>
                  
                  <div class='form-group'>
                    <label>Unit Kerja</label>
                    <input type="text" class="form-control form-control-sm" value="<?= $data->unitkerja ?>" name="unitkerja" required>
                  </div>
                  
                </div>
              </div>
              </div>
              <div class="card-footer"  align="center">
                <a class="btn btn-warning" href="<?php echo base_url('pekerjaan/new_new_kelola_pekerjaan') ?>">Cancel</a>
               <input class="btn btn-primary" type='submit' value='Update' name='save'>
              </div>
              </form>

            </div>
            <!-- /.card -->
          </div>
        <!-- /.row -->
  </div><!--/. container-fluid -->
</div>