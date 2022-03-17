<div class="row">
  <div class="container">
        <!-- Info boxes -->
         <div class="col-md-9 col-xs-9 col-lg-9">
            <!-- general form elements -->
            <div class="card card-primary" style="margin-top: 10px;">
              <div class="card-header" align="center">
                <h6 class="card-title">Detail Pekerjaan</h6>
                <?php
                // $errorr = '&lt;?php echo $error?&gt;';
                if(!empty($error)) {
                  echo $error;
                }
                ?>             
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method='post' action='<?php echo base_url('pekerjaan/new_new_update_kelola_budget_kontruksi') ?>' enctype="multipart/form-data">
                
              <div class="row">
                <div class="col-12">
                <div class="card-body">
                  <div class='form-group'>
                    <label>Nama Proyek</label>
                    <input type="hidden" class="form-control form-control-sm" value="<?= $data->id_kontruksi ?>" name="id" required>
                    <input class="form-control form-control-sm" type="text" class="form-control form-control-sm" value="<?= $data->proyek ?>" name="" readonly="readonly" required>
                  </div>
                  <div class='form-group'>
                    <label>Budget Biaya Kontruksi</label>
                    <input class="form-control form-control-sm" value="<?= $data->biaya_kontruksi ?>" name="biaya_kontruksi" readonly="readonly" required>
                  </div>
                  <!-- <div class='form-group'>
                    <label>Perencanaan</label>
                    <input class="form-control prc form-control-sm" type="number" value="<?= $data->perencana ?>" name="perencana" required>
                  </div>
                  <div class='form-group'>
                    <label>Pengawas</label>
                    <input class="form-control prc form-control-sm" type="number" value="<?= $data->pengawas ?>" name="pengawas" required>
                  </div> -->
                  <div class='form-group'>
                    <label>Pelaksana + PPN 10%</label>
                    <input class="form-control prc form-control-sm" type="number" value="<?= $data->pelaksana ?>" name="pelaksana" readonly="readonly" required>
                  </div>

                  <!-- <div class='form-group'>
                    <label>Total Biaya</label>
                    <input class="form-control form-control-sm" type="" value="" name="sum" readonly="readonly" required>
                  </div> -->
                </div>

              </div>
              </div>
              <div class="card-footer"  align="center">
                <a class="btn btn-warning" href="<?php echo base_url('pekerjaan/new_new_kelola_budget') ?>">Cancel</a>
               <input class="btn btn-primary" type='submit' value='Update' name='save'>
              </div>
              </form>
                    <output id="total"></output>
              <script
                src="https://code.jquery.com/jquery-3.5.1.js"
                integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
                crossorigin="anonymous"></script>

              <script type="text/javascript">
                $(document).ready(function(e){
                  $("input").change(function(){
                    var toplam=0;
                    $("input[type=number]").each(function(){
                      toplam = toplam + parseInt($(this).val());
                    })
                    $("input[name=sum]").val(toplam);

                    if (toplam > $("input[name=biaya_kontruksi]").val()) {
                    alert('Total biaya melebihi budget konstruksi'); return false;
                    } else { return true; }

                  });
                });
              </script>

            </div>
            <!-- /.card -->
          </div>
        <!-- /.row -->
  </div><!--/. container-fluid -->
</div>