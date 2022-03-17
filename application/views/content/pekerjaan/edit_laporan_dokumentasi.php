<div class="row">
  <div class="container">
        <!-- Info boxes -->
         <div class="col-md-12 col-xs-12 col-lg-12">
            <!-- general form elements -->
            <div class="card card-primary" style="margin-top: 10px;">
              <div class="card-header">
                <h6 class="card-title">Laporan Dokumentasi</h6>
              </div>
              <form method='post' action='<?php echo base_url('pekerjaan_dephub/edit_upload_dokumentasi') ?>' enctype="multipart/form-data">
                <input type="hidden" name="proyek" value="<?= $proyek; ?>">
                <input type="hidden" name="fk_idminggu" value="<?= $idminggul; ?>">
                <input type="hidden" name="id" value="<?php echo $tbl_dokumentasi->id; ?>" />

                <div class="card-body col-md-12 row">

                <div class="col-md-4">
                    <div class='form-group'>
                      <div class='form-group'>
                        <img style="width:150px; height:87px; object-fit: cover;" src="<?php echo base_url('upload/dokumentasi/').$tbl_dokumentasi->foto1; ?>">    
                      </div>
                      <label>Upload Foto 1 :</label>
                      <input type="file" class="form-control form-control-sm" name="fotopost1">
                      <input type="hidden" name="filelama1" value="<?=$tbl_dokumentasi->foto1 ?>">
                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-sm" value="<?php echo $tbl_dokumentasi->keterangan1; ?>" name="keterangan1">
                      <div class="input-group-append">
                      </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class='form-group'>
                      <div class='form-group'>
                        <img style="width:150px; height:87px; object-fit: cover;" src="<?php echo base_url('upload/dokumentasi/').$tbl_dokumentasi->foto2; ?>">    
                      </div>
                      <label>Upload Foto 2 :</label>
                      <input type="file" class="form-control form-control-sm" name="fotopost2">
                      <input type="hidden" name="filelama2" value="<?=$tbl_dokumentasi->foto2 ?>">

                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-sm" value="<?php echo $tbl_dokumentasi->keterangan2; ?>" name="keterangan2">
                      <div class="input-group-append">
                      </div>
                  </div>
                </div>

                <div class="col-md-4">
                    <div class='form-group'>
                      <div class='form-group'>
                        <img style="width:150px; height:87px; object-fit: cover;" src="<?php echo base_url('upload/dokumentasi/').$tbl_dokumentasi->foto3; ?>">    
                      </div>
                      <label>Upload Foto 3 :</label>
                      <input type="file" class="form-control form-control-sm" name="fotopost3">
                      <input type="hidden" name="filelama3" value="<?=$tbl_dokumentasi->foto3 ?>">

                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-sm" value="<?php echo $tbl_dokumentasi->keterangan3; ?>" name="keterangan3">
                      <div class="input-group-append">
                      </div>
                  </div>
                </div>

                <div class="col-md-4">
                    <div class='form-group'>
                      <div class='form-group'>
                        <img style="width:150px; height:87px; object-fit: cover;" src="<?php echo base_url('upload/dokumentasi/').$tbl_dokumentasi->foto4; ?>">    
                      </div>
                      <label>Upload Foto 4 :</label>
                      <input type="file" class="form-control form-control-sm" name="fotopost4">
                      <input type="hidden" name="filelama4" value="<?=$tbl_dokumentasi->foto4 ?>">

                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-sm" value="<?php echo $tbl_dokumentasi->keterangan4; ?>" name="keterangan4">
                      <div class="input-group-append">
                      </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class='form-group'>
                      <div class='form-group'>
                        <img style="width:150px; height:87px; object-fit: cover;" src="<?php echo base_url('upload/dokumentasi/').$tbl_dokumentasi->foto5; ?>">    
                      </div>
                      <label>Upload Foto 5 :</label>
                      <input type="file" class="form-control form-control-sm" name="fotopost5">
                      <input type="hidden" name="filelama5" value="<?=$tbl_dokumentasi->foto5 ?>">

                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-sm" value="<?php echo $tbl_dokumentasi->keterangan5; ?>" name="keterangan5">
                      <div class="input-group-append">
                      </div>
                  </div>
                </div>

                <div class="col-md-4">
                    <div class='form-group'>
                      <div class='form-group'>
                        <img style="width:150px; height:87px; object-fit: cover;" src="<?php echo base_url('upload/dokumentasi/').$tbl_dokumentasi->foto6; ?>">    
                      </div>
                      <label>Upload Foto 6 :</label>
                      <input type="file" class="form-control form-control-sm" name="fotopost6">
                      <input type="hidden" name="filelama6" value="<?=$tbl_dokumentasi->foto6 ?>">

                    </div>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control form-control-sm" value="<?php echo $tbl_dokumentasi->keterangan6; ?>" name="keterangan6">
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