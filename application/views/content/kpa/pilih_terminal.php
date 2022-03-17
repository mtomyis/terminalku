<div class="row" style="align-items: center;">
  <div class="container">
    <div class="col-md-12 col-xs-12 col-lg-12" style="margin-top: 15px;">
      <p style="font-weight:bold; text-align: center; font-size: 14pt; font-family: century gothic">Terminal</p>
      <br>
      <div class="row" style="align-content: center;">      
      <?php
      $no = 1;
      foreach ($terminal as $value) {
      ?>
      <div class="col-md-3 col-xs-12">
        <div class="">
          <div class="" style="text-align: center;">
            <a href="<?php echo site_url('kpa/index/'.$value->id); ?>"><img style="border-radius: 8px; width:200px; height:100px; " src="<?php echo base_url('upload/logo/').$value->gambar; ?>" ></a>
            <br>
             <span style="font-variant-caps: all; font-weight:bold; font-size: 13pt; margin-top: 8px; font-family: century gothic"><?php echo $value->nama; ?></span><br>
            <?php echo $value->lokasi; ?>
          </div>
        </div>
      </div>
      <?php } ?>
      </div>
    </div>
  </div>
</div>