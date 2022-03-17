<div class="row">
  <div class="container">
        <!-- Info boxes -->
         <div class="col-md-12 col-xs-12 col-lg-12">
            <!-- general form elements -->
            <div class="card card-primary" style="margin-top: 10px;">
              <div class="card-header">
                <h6 class="card-title">Laporan Dokumentasi</h6>
              </div>
              <form method='post' action='<?php echo base_url('pekerjaan_dephub/upload_dokumentasi') ?>' enctype="multipart/form-data">
                <input type="hidden" name="proyek" value="<?= $proyek; ?>">
                <input type="hidden" name="fk_idminggu" value="<?= $idminggul; ?>">

                <div class="card-body col-md-12 row">

                <div class="col-md-4">
                    <div class='form-group'>
                      <label>Upload Foto 1 :</label>
                      <input type="file" class="form-control form-control-sm" name="fotopost1" required>
                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-sm" placeholder="Keterangan Foto 1" name="keterangan1">
                      <div class="input-group-append">
                      </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class='form-group'>
                      <label>Upload Foto 2 :</label>
                      <input type="file" class="form-control form-control-sm" name="fotopost2" required>
                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-sm" placeholder="Keterangan Foto 2" name="keterangan2">
                      <div class="input-group-append">
                      </div>
                  </div>
                </div>

                <div class="col-md-4">
                    <div class='form-group'>
                      <label>Upload Foto 3 :</label>
                      <input type="file" class="form-control form-control-sm" name="fotopost3" required>
                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-sm" placeholder="Keterangan Foto 3" name="keterangan3">
                      <div class="input-group-append">
                      </div>
                  </div>
                </div>

                <div class="col-md-4">
                    <div class='form-group'>
                      <label>Upload Foto 4 :</label>
                      <input type="file" class="form-control form-control-sm" name="fotopost4" required>
                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-sm" placeholder="Keterangan Foto 4" name="keterangan4">
                      <div class="input-group-append">
                      </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class='form-group'>
                      <label>Upload Foto 5 :</label>
                      <input type="file" class="form-control form-control-sm" name="fotopost5" required>
                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-sm" placeholder="Keterangan Foto 5" name="keterangan5">
                      <div class="input-group-append">
                      </div>
                  </div>
                </div>

                <div class="col-md-4">
                    <div class='form-group'>
                      <label>Upload Foto 6 :</label>
                      <input type="file" class="form-control form-control-sm" name="fotopost6" required>
                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-sm" placeholder="Keterangan Foto 6" name="keterangan6">
                      <div class="input-group-append">
                      </div>
                  </div>
                </div>

              </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input class="btn btn-primary" type='submit' value='Simpan' name='save'>
                  <br>
                </div>
                
              </form>
            </div>
            <!-- /.card -->
          </div>
        <!-- /.row -->
  </div><!--/. container-fluid -->
</div>