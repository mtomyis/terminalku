<div class="row">
  <div class="container">
        <!-- Info boxes -->
         <div class="col-md-5 col-xs-12 col-lg-5">
            <!-- general form elements -->
            <div class="card card-primary" style="margin-top: 30px;">
              <div class="card-header">
                <h6 class="card-title">Upload Addendum</h6>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <form method='post' action='<?php echo base_url('pekerjaan/new_save_addendum') ?>' enctype="multipart/form-data">
                <div class="card-body">

                  <div class="form-group">
                    <label>Pilih Proyek :</label>
                    <select class='form-control form-control-sm' name='proyek' required>
                      <option value='0'>--pilih--</option>
                      <?php 
                      foreach ($proyek as $prov) {
                        echo "<option  value='$prov[proyek]'>$prov[proyek]</option>";
                      }
                      ?>
                    </select>
                  </div>
                  
                  <div class='form-group'>
                    <label>Pilih File Addendum :</label>
                    <input type="file" class="form-control form-control-sm" name="surat" required>
                  </div>

                  <div class='form-group'>
                    <label>Pilih File Excel Addendum :</label>
                    <input type="file" class="form-control form-control-sm" name="excel" required>
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