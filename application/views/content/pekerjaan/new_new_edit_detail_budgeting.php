<div class="row">
  <div class="container">
        <!-- Info boxes -->
         <div class="col-md-9 col-xs-9 col-lg-9">
            <!-- general form elements -->
            <div class="card card-primary" style="margin-top: 10px;">
              <div class="card-header" align="center">
                <h6 class="card-title">Detail Pekerjaan</h6>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method='post' action='<?php echo base_url('pekerjaan/new_new_update_kelola_budget') ?>' enctype="multipart/form-data">
                
              <div class="row">
                <div class="col-12">
                <div class="card-body">
                  <div class='form-group'>
                    <label>Nama Proyek</label>
                    <input type="hidden" class="form-control form-control-sm" value="<?= $data->id_budgeting ?>" name="id" required>
                    <input class="form-control form-control-sm" type="text" class="form-control form-control-sm" value="<?= $data->proyek ?>" name="" readonly="readonly" required>
                  </div>
                  <!-- <div class='form-group'> -->
                    <!-- <label>Biaya Total</label> -->
                    <input type="hidden" class="form-control form-control-sm" value="<?= $data->biaya_total ?>" name="biaya_total" readonly="readonly">
                    <input type="hidden" class="form-control form-control-sm" value="<?= $data->fk_id_kontruksi ?>" name="fk_id_kontruksi" readonly="readonly">

                  <!-- </div> -->
                  <div class='form-group'>
                    <label>Biaya Kontruksi</label>
                    <input class="form-control prc form-control-sm" type="number" value="<?= $data->biaya_kontruksi ?>" name="biaya_kontruksi" required>
                  </div>
                  <!-- <div class='form-group'>
                    <label>Biaya Honorium</label>
                    <input class="form-control prc form-control-sm" type="number" value="<?= $data->biaya_honorium ?>" name="biaya_honorium" required>
                  </div>
                  <div class='form-group'>
                    <label>Biaya Perjalanan Dinas</label>
                    <input class="form-control prc form-control-sm" type="number" value="<?= $data->biaya_perjalanan ?>" name="biaya_perjalanan" required>
                  </div>
                  <div class='form-group'>
                    <label>Biaya Habis Pakai</label>
                    <input class="form-control prc form-control-sm" type="number" value="<?= $data->biaya_habis_pakai ?>" name="biaya_habis_pakai" required>
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
                    $("input[name=biaya_total]").val(toplam);
                  });
                });
              </script>
            </div>
            <!-- /.card -->
          </div>
        <!-- /.row -->
  </div><!--/. container-fluid -->
</div>