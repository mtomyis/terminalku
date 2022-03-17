<div class="row">
  <div class="container-fluid">
        <!-- Info boxes -->
         <div class="col-md-5 col-xs-12 col-lg-5">
            <!-- general form elements -->
            <div class="card card-primary" style="margin-top: 10px;">
              <div class="card-header">
                <h5 class="card-title">Unggah Data pekerjaan</h5>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php 
               // Message
               if(isset($response)){
                 echo $response;
               }
               ?>
               <script>
                  $( function() {
                    $( "#date" ).datepicker({
                      autoclose:true,
                      todayHighlight:true,
                      format:'yyyy-mm-dd',
                      language: 'id'
                    });
                  } );
                  $( function() {
                    $( "#datet" ).datepicker({
                      autoclose:true,
                      todayHighlight:true,
                      format:'yyyy-mm-dd',
                      language: 'id'
                    });
                  } );
                  </script>

              <form method='post' action='<?php echo base_url('pekerjaan_dephub/new_aksi_upload') ?>' enctype="multipart/form-data">
                <div class="card-body">

                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Nama Proyek" name="proyek" required>
                    <div class="input-group-append">
                    </div>
                  </div>

                  <!-- <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Lokasi" name="lokasi" required>
                    <div class="input-group-append">
                    </div>
                  </div> -->

                  <div class='form-group'>
                    <label>Lokasi Terminal</label>
                    <select class='form-control form-control-sm' id='terminal' name='terminal'>
                    <?
                      $sql ="SELECT `nama` FROM `terminal`";
                        $query = $this->db->query($sql);
                        if ($query->num_rows() > 0) {
                          foreach ($query->result() as $row) {
                            echo $row->nama;
                          }
                        }

                    ?></option>
                      <? foreach($terminal as $value){ ?>
                      <option value="<?php echo $value->id;?>" > <?php echo $value->nama;?></option>
                    <? } ?>
                      
                    </select>
                  </div>
                  
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Unit Kerja" name="unitkerja" required>
                    <div class="input-group-append">
                    </div>
                  </div>

                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Pelaksana" name="pelaksana" required>
                    <div class="input-group-append">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">Tanggal Awal</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="text" id="date" class="form-control" name="tanggalawal">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">Tanggal Akhir</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="text" id="datet" class="form-control" name="tanggalakhir">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <!-- <input type='file' name='file' > -->
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="file">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <h5><input class="btn btn-primary" type='submit' value='Upload' name='upload'></h5>
                  <p>
                  <p>Catatan. File yang didownload ber-ekstensi *.csv (Comma Delimited). Silahkan download file format laporannya <a target="_blank" href="<?php echo base_url('upload/Format_laporan.csv') ?>">disini.</a> </p>

                </div>
                
              </form>
            </div>
            <!-- /.card -->
          </div>
        <!-- /.row -->
  </div><!--/. container-fluid -->
</div>