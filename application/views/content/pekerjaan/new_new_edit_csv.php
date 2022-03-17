<div class="row">

  <div class="container">
        <!-- Info boxes -->
     <div class="col-md-12 col-xs-12 col-lg-12">
        <!-- general form elements -->
        <div class="card card-primary" style="margin-top: 10px;">
          <div class="card-header" align="center">
            <h6 class="card-title">Detail Pekerjaan</h6>
          </div>
          <?php 
           // Message
           if(isset($response)){
             echo $response;
           }
           ?>
          <!-- /.card-header -->
          <!-- form start -->
          <form method='post' action='<?php echo base_url('pekerjaan/new_new_simpan_edit_csv') ?>' enctype="multipart/form-data">

          <div class="row">
            <div class="col-12">
            <div class="card-body">
              <div class='form-group'>
                <label>Nama Proyek</label>
                <input type="text" class="form-control form-control-sm" value="<?= $data ?>" name="proyek" readonly="readonly" required>
                <input type="hidden" class="form-control form-control-sm" value="<?= $id ?>" name="id" readonly="readonly" required>
                <input type="hidden" class="form-control form-control-sm" value="<?= $id_add ?>" name="id_add" readonly="readonly" required>

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
          </div>
          </div>
          </div>
        <div class="card-footer"  align="center">
          <a class="btn btn-primary" style="margin-right: 20px;" href="<?php echo base_url('pekerjaan/new_new_kelola_pekerjaan') ?>">Kembali</a>
         <?php 
           // Message
           if(isset($response)){ ?>
          <a class="btn btn-danger" style="margin-right: 20px;" href="<?php echo base_url('pekerjaan/new_new_editcsv_pilihminggu/'.$id.'/'.$id_add) ?>">Pilih Minggu</a>
           <?php } ?>
         <input class="btn btn-success" type='submit' value='Ganti CSV' name='simpanedit'>
        </div>
        </form>
        <!-- /.card -->
      </div>
    </div>
  </div><!--/. container-fluid -->

  <div class="col-md-12 col-xs-12 col-lg-12" style="margin-top: 30px;">
    <div class="card card-primary">
      <div class="card-header" align="center">
        <h6 class="card-title">History Edit CSV</h6>
      </div>
      <div class="card-body table-responsive">
        <table id="example1" class="table table-bordered table-striped responsif">
          <thead>
          <tr>
            <th rowspan="2">No.</th>
            <th rowspan="2">Surat Addendum</th>
            <th rowspan="2">Tanggal</th>
            <th colspan="2">Perubahan</th>
            <th rowspan="2">Aksi</th>
          </tr>
          <tr>
            <th>Penyesuaian Data</th>
            <th>Data Matang</th>
          </tr>
          </thead>
          <tbody>
            <?php
                $no = 1;
                foreach ($datahistory as $value) {
                ?>
          <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $value->surat_addendum; ?></td>
            <td><?php echo $value->tanggal; ?></td>
            <td style="text-align: center;"><?php echo $value->minggu_penyesuaian; ?></td>
            <td style="text-align: center;"><?php echo $value->minggu_matang; ?></td>
            <td style="text-align: center;">Edit | Delete</td>
          </tr>
            <?php } ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>

