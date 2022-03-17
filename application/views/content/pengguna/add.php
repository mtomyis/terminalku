<div class="row">
  <div class="container">
        <!-- Info boxes -->
         <div class="col-md-5 col-xs-12 col-lg-5">
            <!-- general form elements -->
            <div class="card card-primary" style="margin-top: 10px;">
              <div class="card-header">
                <h6 class="card-title">Tambahkan pengguna sesuai proyek</h6>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <form method='post' action='<?php echo base_url('pengguna/save') ?>' enctype="multipart/form-data">
                <div class="card-body">

                  <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-sm" placeholder="Nama Pengguna" name="nama" required>
                    <div class="input-group-append">
                    </div>
                  </div>
                  
                  <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-sm" placeholder="Email" name="email" required>
                    <div class="input-group-append">
                    </div>
                  </div>

                  <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-sm" placeholder="NIP" name="nip" required>
                    <div class="input-group-append">
                    </div>
                  </div>

                  <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-sm" placeholder="Password" name="password" required>
                    <div class="input-group-append">
                    </div>
                  </div>

                  <div class='form-group'>
                    <label>Pilih Posisi :</label>
                    <select class='form-control form-control-sm' id='posisi' name='posisi' required>
                      <option value='0'>--pilih--</option>
                      <option value='Pengawas'>Pengawas</option>
                      <option value='PPK'>PPK</option>
                      <option value='PPSPM'>PPSPM</option>
                      <option value='KPA'>KPA</option>
                      <option value='KASUBDIT'>KASUBDIT</option>
                    </select>
                  </div>
                  
                  <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-sm" placeholder="Konsultan Pengawas" name="pengawas">
                    <div class="input-group-append">
                    </div>
                  </div>
                  
                  <div class='form-group'>
                    <label>Pilih Logo Konsultan :</label>
                    <input type="file" class="form-control form-control-sm" name="fotopost">
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input class="btn btn-primary" type='submit' value='Simpan' name='save'>
                  <br><p>*catatan. data pengguna yang dimasukkan digunakan untuk melakukan login dan mengakses aplikasi android.</p>
                </div>
                
              </form>
            </div>
            <!-- /.card -->
          </div>
        <!-- /.row -->
  </div><!--/. container-fluid -->
</div>