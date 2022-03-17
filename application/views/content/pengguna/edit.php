<div class="row">
  <div class="container">
        <!-- Info boxes -->
         <div class="col-md-5 col-xs-12 col-lg-5">
            <!-- general form elements -->
            <div class="card card-primary" style="margin-top: 10px;">
              <div class="card-header">
                <h6 class="card-title">Edit data pengguna</h6>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <form method='post' action='<?php echo base_url('pengguna/update') ?>' enctype="multipart/form-data">
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
                  <label>Konsultan Pengawas :</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-sm" value="<?php echo $pengguna->pengawas; ?>" name="pengawas">
                    <div class="input-group-append">
                    </div>
                  </div>
                </div>
                
                <div class='form-group'>
                  <label>NIP :</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-sm" value="<?php echo $pengguna->nip; ?>" name="nip" required>
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
                    <label>Pilih Posisi :</label>
                    <select class='form-control form-control-sm' id='posisi' name='posisi' required>
                      <option value='<?php echo $pengguna->posisi; ?>'><?php echo $pengguna->posisi; ?></option>
                      <option value='0'>-------</option>

                      <option value='Pengawas'>Pengawas</option>
                      <option value='PPK'>PPK</option>
                      <option value='PPSPM'>PPSPM</option>
                      <option value='KPA'>KPA</option>
                      <option value='KASUBDIT'>KASUBDIT</option>

                    </select>
                  </div>
                  
                  <div class='form-group'>
                    <img style="width:150px; height:87px; object-fit: cover;" src="<?php echo base_url('upload/logo/').$pengguna->logopengawas; ?>">    
                  </div>
                  
                  <div class='form-group'>
                    <label>Ganti Logo Konsultan :</label>
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