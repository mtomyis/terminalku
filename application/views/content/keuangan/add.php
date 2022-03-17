<div class="row">
  <div class="container">
        <!-- Info boxes -->
         <div class="col-md-5 col-xs-12 col-lg-5">
            <!-- general form elements -->
            <div class="card card-primary" style="margin-top: 10px;">
              <div class="card-header">
                <h6 class="card-title">Input Termin Pekerjaan <?= $proyek; ?></h6>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <script>
                $( function() {
                  $( "#date" ).datepicker({
                    autoclose:true,
                    todayHighlight:true,
                    format:'yyyy-mm-dd',
                    language: 'id'
                  });
                } );
              </script>

              <form method='post' action='<?php echo base_url('keuangan/save') ?>' enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="date">Tanggal</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="hidden" id="proyek" class="form-control form-control-sm" name="proyek" value="<?= $proyek; ?>">
                        <input type="text" id="date" class="form-control form-control-sm" name="tanggal">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                  <label for="nominal">Nominal</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="number" id="nominal" class="form-control form-control-sm" placeholder="Masukkan nominal Termin" name="uang" required>
                      </div>
                    </div>
                  </div>
                    <div class="form-group">
                    <label for="rincian">Rincian</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="text" id="rincian" class="form-control form-control-sm" placeholder="Keterangan" name="rincian" required>
                        </div>
                      </div>
                    </div>
                  <!-- <div class='form-group'>
                    <label for="kategori">Kategori</label>
                    <select class='form-control form-control-sm' id='kategori' name='kategori' required>
                      <option value='0'>--pilih--</option>
                      <option value='pelaksana'>Pelaksana</option>
                      <option value='pengawas'>Pengawas</option>
                      <option value='perencana'>Perencana</option>
                      <option value='honorium'>Honorium</option>
                      <option value='perjalanan_dinas'>Perjalanan Dinas</option>
                      <option value='habis_pakai'>Habis Pakai</option>
                    </select>
                  </div> -->
                  <div class='form-group'>
                    <label for="surat">Surat :</label>
                    <input id="surat" type="file" class="form-control form-control-sm" name="surat">
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input class="btn btn-primary" type='submit' value='Simpan' name='save'>
                </div>
                <?php 
               // Message response
               if(isset($response)){
                 echo $response;
               }
               ?>
              </form>
            </div>
            <!-- /.card -->
          </div>
        <!-- /.row -->
  </div><!--/. container-fluid -->
</div>