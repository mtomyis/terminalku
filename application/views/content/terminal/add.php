<div class="row">
  <div class="container">
        <!-- Info boxes -->
         <div class="col-md-5 col-xs-12 col-lg-5">
            <!-- general form elements -->
            <div class="card card-primary" style="margin-top: 10px;">
              <div class="card-header">
                <h6 class="card-title">Tambahkan terminal</h6>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php 
             // Message
             if(isset($response)){
               echo $response;
             }
             ?>
              <form method='post' action='<?php echo base_url('terminal/save') ?>' enctype="multipart/form-data">
                <div class="card-body">

                  <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-sm" placeholder="Nama Terminal" name="nama" required>
                    <div class="input-group-append">
                    </div>
                  </div>
                  
                  <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-sm" placeholder="Lokasi" name="lokasi" required>
                    <div class="input-group-append">
                    </div>
                  </div>
                  
                  <div class='form-group'>
                    <label>Gambar :</label>
                    <input type="file" class="form-control form-control-sm" name="fotopost">
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