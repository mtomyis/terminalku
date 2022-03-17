<div class="row">
  <div class="container">
        <!-- Info boxes -->
         <div class="col-md-5 col-xs-12 col-lg-5">
            <!-- general form elements -->
            <div class="card card-primary" style="margin-top: 10px;">
              <div class="card-header">
                <h6 class="card-title">Edit data terminal</h6>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <form method='post' action='<?php echo base_url('terminal/update') ?>' enctype="multipart/form-data">
                <div class="card-body">

                <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $terminal->id; ?>" />
                <div class='form-group'>
                  <label>Nama :</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-sm" value="<?php echo $terminal->nama; ?>" name="nama" required>
                    <div class="input-group-append">
                    </div>
                  </div>
                </div>
                
                <div class='form-group'>
                  <label>Lokasi :</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-sm" value="<?php echo $terminal->lokasi; ?>" name="lokasi" required>
                    <div class="input-group-append">
                    </div>
                  </div>
                </div>
                
                <div class='form-group'>
                  <img style="width:150px; height:87px; object-fit: cover;" src="<?php echo base_url('upload/logo/').$terminal->gambar; ?>">    
                </div>
                
                <div class='form-group'>
                  <label>Foto :</label>
                  <input type="file" class="form-control form-control-sm" name="fotopost">
                  <input type="hidden" name="filelama" value="<?=$terminal->gambar ?>">
                </div>
                
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input class="btn btn-primary" type='submit' value='Update' name='save'>
                </div>
                
              </form>
            </div>
            <!-- /.card -->
          </div>
        <!-- /.row -->
  </div><!--/. container-fluid -->
</div>