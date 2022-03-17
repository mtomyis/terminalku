<div class="row">
	<div class="col-md-5">
		<div class="d-form">
			<div class="d-form-title">
				<h1 class="d-title"><img class="img-fluid img-title" src="<?php echo base_url();?>aset/icon/icon_laporan.png"> Silahkan pilih proyek</h1>
			</div>
			<div class="d-form-in">
				<form method="post" id="form" action="<?php echo base_url();?>pekerjaan_dephub/new_lihat_pekerjaan_mingguan">
					<div class="form-group">
						<select class='form-control form-control-sm' id='provinsi' name='proyek' required>
							<option value='0'>--pilih--</option>
							<?php 
							foreach ($proyek as $prov) {
								echo "<option  value='$prov[proyek]'>$prov[proyek]</option>";
							}
							?>
						</select>
						<!-- <input type="text" name="proyekk"> -->
					</div>
					<div class='form-group'>
						<label>Pilih Minggu</label>
						<select class='form-control form-control-sm' id='kabupaten-kota' name="idminggu" required>
							<option  value='0'>--pilih--</option>
						</select>
					</div>
					<div class="btn-group" role="group" aria-label="Basic example">
  						<button type="submit" id="btn-save" class="btn btn-primary"><span><i class="save-icon"></i> </span><p id="ind">Save</p></button>
					</div>
				</form> 
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

		$(function(){

			$.ajaxSetup({
				type:"POST",
				url: "<?php echo base_url('/select/ambil_data') ?>",
				cache: false,
			});

			$("#provinsi").change(function(){

				var value=$(this).val();
				if(value!==0){
					$.ajax({
						data:{modul:'kabupaten',id:value},
						success: function(respond){
							$("#kabupaten-kota").html(respond);
						}
					})
				}

			});


			$("#kabupaten-kota").change(function(){
				var value=$(this).val();
				if(value!==0){
					$.ajax({
						data:{modul:'kecamatan',id:value},
						success: function(respond){
							$("#kecamatan").html(respond);
						}
					})
				}
			})

			$("#id_barang").change(function(){
				var value=$(this).val();
				if(value!==0){
					$.ajax({
						data:{modul:'id_barang',id:value},
						success: function(respond){
							$("#jumlah").html(respond);
						}
					})
				}
			})

		})

	</script>