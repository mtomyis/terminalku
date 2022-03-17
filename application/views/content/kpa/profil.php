<div class="row">
  <div class="container">
        <!-- Info boxes -->
         <div class="col-md-5 col-xs-12 col-lg-5">
            <!-- general form elements -->
            <div class="card card-primary" style="margin-top: 10px;">
              <div class="card-header">
                <h6 class="card-title">Profil</h6>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <form method='post' action='<?php echo base_url('kpa/update_profil') ?>' enctype="multipart/form-data">
                <div class="card-body">

                <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $pengguna->id; ?>" />
                <div class='form-group'>
                  <label>Nama :</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-sm" value="<?php echo $pengguna->nama; ?>" name="nama" required>
                    <div class="input-group-append">
                    </div>
                  </div>
                </div>
                
                <div class='form-group'>
                  <label>Email :</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-sm" value="<?php echo $pengguna->email; ?>" name="email" required>
                    <div class="input-group-append">
                    </div>
                  </div>
                </div>

                <div class='form-group'>
                  <label>Password :</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-sm" value="<?php echo $pengguna->password; ?>" name="password" required>
                    <div class="input-group-append">
                    </div>
                  </div>
                </div>
                  
                  <div class='form-group'>
                    <img style="width:150px; height:87px; object-fit: cover;" src="<?php echo base_url('upload/logo/').$pengguna->logopengawas; ?>">    
                  </div>
                  
                  <div class='form-group'>
                    <label>Upload Foto Pengguna :</label>
                    <input type="file" class="form-control form-control-sm" name="fotopost">
                    <input type="hidden" name="filelama" value="<?=$pengguna->logopengawas ?>">
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