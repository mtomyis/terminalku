<?php
$urlnama;
if ($nama != null ) {
      $foto = file_get_contents(base_url('upload/').$nama); 
      $urlnama = "data:image/png;base64,".base64_encode($foto);
  }
  else{
      $foto = file_get_contents(base_url('upload/ttd/kosong.png')); 
      $urlnama = "data:image/png;base64,".base64_encode($foto);
  }
?>
<img style="width:1000px; height:499px; object-fit: cover;" src="<?php echo $urlnama; ?>">