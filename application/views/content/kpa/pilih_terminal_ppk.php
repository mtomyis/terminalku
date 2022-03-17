<div class="row">
  <div class="container-fluid">
    <div class="col-md-12 col-xs-12 col-lg-12" style="margin-top: 15px;">
      <p style="text-align: center; font-size: 12pt;"><strong>Pilih Terminal</strong></p>
      <div class="row">      
      <?php
      $no = 1;
      foreach ($terminal as $value) {
      ?>
      <div class="col-md-3 col-xs-12">
        <div class="card card-primary">
          <div class="card-body" style="text-align: center;">
            <img style="width:100%; height:150px; object-fit: cover;" src="<?php echo base_url('upload/logo/').$value->gambar; ?>" >
            <br><br>
            <a href="<?php echo site_url('pekerjaan/new_new_pilih_proyek_ppk/'.$value->id); ?>"> <strong><?php echo $value->nama; ?></strong> </a>
            <br>
            <?php echo $value->lokasi; ?>
          </div>
        </div>
      </div>
      <?php } ?>
      </div>
    </div>
  </div>
</div>