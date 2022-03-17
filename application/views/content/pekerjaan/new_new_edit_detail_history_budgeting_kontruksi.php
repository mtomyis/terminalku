<div class="row">
  <div class="container">
        <!-- Info boxes -->
         <div class="col-md-9 col-xs-9 col-lg-9">
            <!-- general form elements -->
            <div class="card card-primary" style="margin-top: 10px;">
              <div class="card-header" align="center">
                <h6 class="card-title">Detail History Pembayaran</h6>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php 
               // Message response
               if(isset($response)){
                 echo $response;
               }
               ?>
              <form method='post' action='<?php echo base_url('keuangan/update') ?>' enctype="multipart/form-data">
                
              <div class="row">
                <div class="col-12">
                <div class="card-body">
                  <div class='form-group'>
                    <label>Nama Proyek</label>
                    <input type="hidden" class="form-control form-control-sm" value="<?= $data->id ?>" name="id" required>
                    <input type="hidden" class="form-control form-control-sm" value="<?= $data->fk_id_kontruksi_history ?>" name="fk_id" required>

                    <input class="form-control form-control-sm" type="text" class="form-control form-control-sm" value="<?= $data->proyek ?>" name="proyek" readonly="readonly" required>
                  </div>
                  <div class='form-group'>
                  <label>Tanggal</label>
                    <input type="date" class="form-control form-control-sm" value="<?= $data->tanggal ?>" name="tanggal" required>
                  </div>

                  <div class='form-group'>
                    <label>Kategori</label>
                    <select class='form-control form-control-sm' id='kategori' name='kategori' required>
                      <option value='<?= $data->kategori ?>'><?= $data->kategori ?></option>
                      <option value="perencana">perencana</option>
                      <option value="pengawas">pengawas</option>
                      <option value="pelaksana">pelaksana</option>
                      <option value="honorium">biaya honorium</option>
                      <option value="perjalanan_dinas">perjalanan dinas</option>
                      <option value="habis_pakai">biaya habis pakai</option>
                    </select>
                  </div>
                  <div class='form-group'>
                    <label>Rincian</label>
                    <input class="form-control prc form-control-sm" value="<?= $data->rincian ?>" name="rincian" required>
                  </div>
                  <div class='form-group'>
                    <label>Nilai (Rp.)</label>
                    <input class="form-control prc form-control-sm" value="<?= $data->nilai ?>" name="nilai" required>
                  </div>
                  <div class='form-group'>
                    <label>Ubah Surat</label>
                    <input type="file" class="form-control form-control-sm" name="filesurat">
                    <input type="hidden" class="form-control prc form-control-sm" value="<?= $data->surat ?>" name="surat" required>
                  </div>
                </div>
              </div>
              </div>
              <div class="card-footer"  align="center">
                <a class="btn btn-warning" href="<?php echo site_url('pekerjaan/new_new_kelola_budget_history/'.$data->fk_id_kontruksi_history); ?>">Cancel</a>
                <a class="btn btn-danger" href="<?php echo site_url('pekerjaan/new_new_hapus_budget_history/'.$data->fk_id_kontruksi_history.'/'.$data->id); ?>">Hapus</a>
               <input class="btn btn-primary" type='submit' value='Update' name='save'>
              </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        <!-- /.row -->
  </div><!--/. container-fluid -->
</div>