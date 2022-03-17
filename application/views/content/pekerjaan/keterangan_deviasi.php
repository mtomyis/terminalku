<div class="row">
  <div class="container">
        <!-- Info boxes -->
         <div class="col-md-5 col-xs-12 col-lg-5">
            <!-- general form elements -->
            <div class="card card-primary" style="margin-top: 10px;">
              <div class="card-header">
                <h6 class="card-title">Deviasi Minus, Harap Masukkkan keterangan</h6>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php 
             // Message
             if(isset($response)){
               echo $response;
             }
             ?>
              <form method='post' action='<?php echo base_url('pekerjaan_dephub/save_deviasi') ?>'>
                <div class="card-body">

                  <div class="input-group mb-3">
                    <!-- <label>Keterangan Masalah</label> -->
                    <input type="hidden" name="id_minggu" value="<?= $minggu->id; ?>">
                    <textarea type="text" class="form-control form-control-sm" placeholder="keterangan masalah yang terjadi" name="masalah" required><?php echo $minggu->masalah; ?></textarea>
                  </div>
                  
                  <div class="input-group mb-3">
                    <!-- <label>Tindakan / Solusi</label> -->
                    <textarea type="text" class="form-control form-control-sm" placeholder="Masukkkan solusi perbaikan" name="solusi" required><?php echo $minggu->solusi; ?></textarea>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input class="btn btn-primary" type='submit' value='Simpan' name='save'>
                </div>
                
              </form>
            </div>
            <!-- /.card -->
          </div>
        <!-- /.row -->
  </div><!--/. container-fluid -->
</div>