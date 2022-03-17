<div class="row">
	<div class="col-md-5">
		<div class="d-form">
			<div class="d-form-title">
				<h1 class="d-title"><img class="img-fluid img-title" src="<?php echo base_url();?>aset/icon/icon_laporan.png">Pilih minggu perubahan Addendum</h1>
			</div>
			<div class="d-form-in">
				<form method="post" id="form" action="<?php echo base_url();?>pekerjaan/new_lihat_pekerjaan_mingguan_editcsv">
					<div class="form-group">
                    	<input type="text" id="proyek" class="form-control form-control-sm" value="<?= $proyek ?>" name="proyek" readonly="readonly" required>
                		<input type="hidden" class="form-control form-control-sm" value="<?= $id_add ?>" name="id_add" readonly="readonly" required>
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

	window.onload = function() {
		$.ajaxSetup({
		type:"POST",
		url: "<?php echo base_url('/select/ambil_data') ?>",
		cache: false,
		});

		var value= document.getElementById("proyek").value;
		if(value!==0){
			$.ajax({
				data:{modul:'kabupaten',id:value},
				success: function(respond){
					$("#kabupaten-kota").html(respond);
				}
			})
		}
	};

</script>