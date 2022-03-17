<style type="text/css">
    .crop {
        width: 445px;
        height: 260px;
        overflow: hidden;
    }

    .crop img {
        width: 445px;
        height: 260px;
    }

    h3 {text-align: center; margin-top: -5px;}
    p {text-align: left; font-size: 10pt;}
    table {
    border-collapse: collapse;
    }
    
    table, td, th {
    border: 1px solid black;
    }
</style>
<!DOCTYPE html>
<html>
<head>
  <title>Laporan Dokumentasi</title>
</head>
<body>
  <div style="page-break-inside: avoid;">
    <table id="example1" style="font-size: 11pt; width: 100%; text-align: center; font-weight: bold;">
      <tr>
        <td style="width: 33%; text-align: center; font-weight: bold;">KONSULTAN PENGAWAS</td>
        <td style="width: 33%; text-align: center; font-weight: bold;">PEKERJAAN</td>
        <td style="width: 33%; text-align: center; font-weight: bold;">FORM FORMAT</td>
      </tr>
      <tr>
        <td style ="font-size: 9pt;">
            <?php
            $urllogo;
            if ($logo != null ) {
                  $foto = file_get_contents(base_url('upload/logo/').$logo); 
                  $urllogo = "data:image/png;base64,".base64_encode($foto);
              }
              else{
                  $foto = file_get_contents(base_url('upload/ttd/kosong.png')); 
                  $urllogo = "data:image/png;base64,".base64_encode($foto);
              }
            ?>
            <br><img style="width:50px; height:50px; object-fit: cover;" src="<?php echo $urllogo; ?>"> <br> <?php echo $pengawas; ?>
        </td>
        <td><?php echo $proyek ?></td>
        <td>LAPORAN VISUAL</td>
      </tr>
    </table>
    <br>
    <table style="font-size: 10pt; border: 0; border-spacing: 0; border: 0px solid #CCC; width: 100%">
      <tr>
        <td style="border: none; vertical-align:top">UNIT KERJA</td>
        <td style="border: none; vertical-align:top">: <?php echo $unitkerja ?></td>
        <td style="border: none; vertical-align:top">NAMA LAPORAN</td>
        <td style="border: none; vertical-align:top">: Laporan Visual</td>
      </tr>
      <tr>
        <td style="border: none; vertical-align:top">AGGARAN</td>
        <td style="border: none; vertical-align:top">: <?php echo $anggaran ?></td>
        <td style="border: none; vertical-align:top">TANGGAL</td>
        <td style="border: none; vertical-align:top">: <?php echo $periode ?></td>
      </tr>
      <tr>
        <td style="border: none; vertical-align:top">LOKASI</td>

        <?php
        $lokasiterminal;
        $sql ="SELECT `nama` FROM `terminal` WHERE id = '$fk_id_terminal' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
          foreach ($query->result() as $row) {
            $lokasiterminal = $row->nama;
          }
        }
        ?>

        <td style="border: none; vertical-align:top">: <?php echo $lokasiterminal ?></td>
        <td style="border: none; vertical-align:top">MINGGU KE</td>
        <td style="border: none; vertical-align:top">: <?php echo $minggu ?></td>
      </tr>
    </table>
    <br>
    
    <table id="example1" style="font-size: 11pt; width: 100%; text-align: center; font-weight: bold;">
    <?php 
    $n = 1;
    $sql ="SELECT * FROM `new_dokumentasi_dephub` WHERE fk_idminggu = '{$idminggu}' AND proyek = '{$proyek}' ORDER BY id ASC";
    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
          $url1;
          if ($row->foto1 != null ) {
              $foto1 = file_get_contents(base_url('upload/dokumentasi/').$row->foto1); 
              $url1 = "data:image/png;base64,".base64_encode($foto1);
          }
          else{
              $foto1 = file_get_contents(base_url('upload/ttd/kosong.png')); 
              $url1 = "data:image/png;base64,".base64_encode($foto1);
          }
          $url2;
          if ($row->foto2 != null ) {
              $foto2 = file_get_contents(base_url('upload/dokumentasi/').$row->foto2); 
              $url2 = "data:image/png;base64,".base64_encode($foto2);
          }
          else{
              $foto2 = file_get_contents(base_url('upload/ttd/kosong.png')); 
              $url2 = "data:image/png;base64,".base64_encode($foto2);
          }
          $url3;
          if ($row->foto3 != null ) {
              $foto3 = file_get_contents(base_url('upload/dokumentasi/').$row->foto3); 
              $url3 = "data:image/png;base64,".base64_encode($foto3);
          }
          else{
              $foto3 = file_get_contents(base_url('upload/ttd/kosong.png')); 
              $url3 = "data:image/png;base64,".base64_encode($foto3);
          }
          $url4;
          if ($row->foto4 != null ) {
              $foto4 = file_get_contents(base_url('upload/dokumentasi/').$row->foto4); 
              $url4 = "data:image/png;base64,".base64_encode($foto4);
          }
          else{
              $foto4 = file_get_contents(base_url('upload/ttd/kosong.png')); 
              $url4 = "data:image/png;base64,".base64_encode($foto4);
          }
          $url5;
          if ($row->foto5 != null ) {
              $foto5 = file_get_contents(base_url('upload/dokumentasi/').$row->foto5); 
              $url5 = "data:image/png;base64,".base64_encode($foto5);
          }
          else{
              $foto5 = file_get_contents(base_url('upload/ttd/kosong.png')); 
              $url5 = "data:image/png;base64,".base64_encode($foto5);
          }
          $url6;
          if ($row->foto6 != null ) {
              $foto6 = file_get_contents(base_url('upload/dokumentasi/').$row->foto6); 
              $url6 = "data:image/png;base64,".base64_encode($foto6);
          }
          else{
              $foto6 = file_get_contents(base_url('upload/ttd/kosong.png')); 
              $url6 = "data:image/png;base64,".base64_encode($foto6);
          }
        ?>

        <tr>
          <td style="width: 50%; text-align: center; vertical-align: middle;">1.</td>
          <td style="width: 50%; text-align: center; vertical-align: middle;">2.</td>
        </tr>
        <tr>
          <td style="text-align: center; vertical-align: middle;">
            <img style="width:230px; object-fit: cover;" src="<?php echo $url1; ?>">
          </td>
          <td style="text-align: center; vertical-align: middle;">
            <img style="width:230px; object-fit: cover;" src="<?php echo $url2; ?>">
          </td>
        </tr>
        <tr>
          <td style="text-align: center; vertical-align: middle;">
            <?= $row->keterangan1; ?>
          </td>
          <td style="text-align: center; vertical-align: middle;">
            <?= $row->keterangan2; ?>
          </td>
        </tr>

        <tr>
          <td style="width: 50%; text-align: center; vertical-align: middle;">3.</td>
          <td style="width: 50%; text-align: center; vertical-align: middle;">4.</td>
        </tr>
        <tr>
          <td style="text-align: center; vertical-align: middle;">
            <img style="width:230px; object-fit: cover;" src="<?php echo $url3; ?>">
          </td>
          <td style="text-align: center; vertical-align: middle;">
            <img style="width:230px; object-fit: cover;" src="<?php echo $url4; ?>">
          </td>
        </tr>
        <tr>
          <td style="text-align: center; vertical-align: middle;">
            <?= $row->keterangan3; ?>
          </td>
          <td style="text-align: center; vertical-align: middle;">
            <?= $row->keterangan4; ?>
          </td>
        </tr>

        <tr>
          <td style="width: 50%; text-align: center; vertical-align: middle;">5.</td>
          <td style="width: 50%; text-align: center; vertical-align: middle;">6.</td>
        </tr>
        <tr>
          <td style="text-align: center; vertical-align: middle;">
            <img style="width:230px; object-fit: cover;" src="<?php echo $url5; ?>">
          </td>
          <td style="text-align: center; vertical-align: middle;">
            <img style="width:230px; object-fit: cover;" src="<?php echo $url6; ?>">
          </td>
        </tr>
        <tr>
          <td style="text-align: center; vertical-align: middle;">
            <?= $row->keterangan5; ?>
          </td>
          <td style="text-align: center; vertical-align: middle;">
            <?= $row->keterangan6; ?>
          </td>
        </tr>

      <?php }} ?>
    </table>
  </div>

<br><br>
</body>
</html>

