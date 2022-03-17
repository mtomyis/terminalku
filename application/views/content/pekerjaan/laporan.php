<style type="text/css">
	h3 {text-align: center; margin-top: -5px;}
	p {text-align: left; font-size: 10pt;}
  table {
  border-collapse: collapse;
  }

  table, td, th {
    border: 1px solid black; font-size: 9pt;
}
</style>
<h3>Laporan Pekerjaan</h3>

<br>
<table style="border: 0; border-spacing: 0; border: 0px solid #CCC;">
  <tr>
    <td style="border: none;">
      <strong>Pekerjaan</strong>
    </td>
    <td style="border: none;">
      :
    </td>
    <td style="border: none;">
      <?php echo $tandatangandireksi->proyek ?>
    </td>
  </tr>
  <tr>
    <td style="border: none;">
      <strong>Lokasi</strong>
    </td>
    <td style="border: none;">
      :
    </td>
    <td style="border: none;">
      <?php echo $tandatangandireksi->lokasi ?>
    </td>
  </tr>
  <tr>
    <td style="border: none;">
      <strong>periode</strong>
    </td>
    <td style="border: none;">
      :
    </td>
    <td style="border: none;">
      <?php echo $tandatangandireksi->tanggalawal ?> - <?php echo $tandatangandireksi->tanggalakhir ?>
    </td>
  </tr>
  <tr>
    <td style="border: none;">
      <strong>Pelaksana</strong>
    </td>
    <td style="border: none;">
      :
    </td>
    <td style="border: none;">
      <?php echo $tandatangandireksi->pelaksana ?>
    </td>
  </tr>
  <tr>
    <td style="border: none;">
      <strong>Pengawas</strong>
    </td>
    <td style="border: none;">
      :
    </td>
    <td style="border: none;">
      PT. Concept Design Architect
    </td>
  </tr>
</table>
<br>

<!-- <table nobr="true" style="width: 100%; border: 0; border-spacing: 0; border: 0px solid #CCC;">
  <tr>
    <td style="border: none;"> -->


<table nobr="true" style="width: 100%;">
  <thead>
  <tr>
    <th>No</th>
    <th>Uraian pekerjaan</th>
    <th>Sat</th>
    <th>Volume</th>
    <th>Harga Sat</th>
    <th>Nilai</th>
    <th>Bobot</th>
  </tr>
  
  <?php 
  foreach ($section0 as $i) : 
    $section = $i['section'];
    // ini untuk perulangan section dimana sati section memiliki banyak pekerjaan

    $sql ="SELECT id , `pekerjaan` FROM `new_pekerjaan` WHERE section = '$section' GROUP by pekerjaan ORDER BY id ASC";
    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        // ini untuk perulangan pekerjaan dengan where kondisi session yang sedang berjalan, misal session 0 meiliki 1 atau 2 pekerjaan
        ?>
  </thead>
  <tbody>

    <tr nobr="true">
      <td nobr="true" colspan="7" style="text-align:left;"><strong><?php echo $section; ?> > <?php echo $row->pekerjaan; ?></td>
    </tr>

    <?php 
    // untuk mendapatkan Uraian pekerjaan dengan kondisi where hasil perulangan pekerjaan diatas
    $n = 1;
    $sql ="SELECT * FROM new_pekerjaan WHERE pekerjaan = '$row->pekerjaan' AND section = '$section' AND proyek = '$proyek' ORDER BY id ASC";
    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
    ?>

  <tr>
    <td nobr="true" style="text-align:  center;vertical-align: middle;"><?= $n; ?></td>
    <td nobr="true" style="text-align: left; vertical-align: middle;"><?= $row->uraian_pekerjaan; ?></td>
    <td nobr="true" style="text-align: center; vertical-align: middle;"><?= $row->satuan; ?></td>
    <td nobr="true" style="text-align: right; vertical-align: middle;"><?= number_format($row->volume,3,',','.'); ?></td>
    <td nobr="true" style="vertical-align: middle">
      <div style="float:left;">Rp. </div>
      <div style="float:right;"><?= number_format($row->harga_satuan, 2,',','.'); ?></div>
    </td>
    <td nobr="true" style="vertical-align: middle">
        <div style="float: right;"><?= number_format($row->nilai, 2,',','.'); ?> </div>
        <div style="float: left; margin-left: -16px;">Rp.</div>
    </td>
    <td nobr="true" style="text-align: right; vertical-align: middle;"><?= number_format($row->bobot, 3); ?></td>
    </tr>
  </tr>

  <?php $n++; } } ?>
  <!-- ini akhir perulangan where kondisi pekerjaan -->

  <tr>
  <?php 
  $sql ="SELECT pekerjaan, SUM(nilai) as totalnilai, SUM(bobot) as totalbobot FROM `new_pekerjaan` WHERE pekerjaan = '$row->pekerjaan' AND section = '$section' AND proyek = '$proyek'";
  $query = $this->db->query($sql);
  if ($query->num_rows() > 0) {
    foreach ($query->result() as $row) {
  
   ?>
    <td nobr="true" colspan="5" style="text-align: right;">Sub Total</td>
    <td nobr="true">
      <div style="float:left;  font: bold;">Rp.</div>
      <div style="float:right; font: bold;"><?php echo number_format($row->totalnilai, 2,',','.'); ?> </div>
    </td>
    <td nobr="true" style="text-align: right; font: bold;"> <?php echo number_format($row->totalbobot,3,',','.'); ?> % </td>
  
  <?php } } ?>
  <!-- ini untuk mendapatkan nilai bobot dari kondisi where pekerjaan -->
  </tr>
  </tbody>
  <tfoot>
  
  </tfoot>
<?php } } ?>
<!-- ini akhir perulangan lihat pekerjaan darikondisi where section -->

<?php endforeach; ?>
<!-- ini akhir perulangan lihat section -->
</table>

<!--     </td>
  </tr>
</table> -->


<br><br>
<table style="width: 100% border: 0; border-spacing: 0; border: 0px solid #CCC;">
  <tr>
    <td style="border: none; text-align: center;">
      Mengetahui<br>
      Pelaksana<br>
      <br>
      <br>
      <br>
      <?php echo $tandatanganpelaksana->nama ?><br>
      Nip. <?php echo $tandatanganpelaksana->nip; ?>
    </td>

    <td style="border: none; text-align: center;">
      Mengetahui<br>
      Pengawas<br>
      <br>
      <br>
      <br>
      <?php echo $tandatangandireksi->nama ?><br>
      Nip. <?php echo $tandatangandireksi->nip; ?>
    </td>
  </tr>
</table>