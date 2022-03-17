<div class="row">
	<div class="col-md-3">
		<div class="d-form">
			<div class="d-form-title">
				<h1 class="d-title"><img class="img-fluid img-title" src="<?php echo base_url();?>aset/icon/icon_pengeluaran.png">Rekap Reimbursement</h1>
			</div>
			<div class="d-form-in permohonan">
				<form method="post" id="form" action="<?php echo base_url();?>rekapitulasi/get_data_reimbursement">
					<div class="form-group">
						<label>Periode awal :</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-calendar"></i></span>
							</div>
							<input placeholder="__/__/____" class="form-control tgl" data-date-format="dd/mm/YYYY" name="tanggal_awal" id="tanggal_awal" required autofocus>
						</div>
					</div>
					<div class="form-group">
						<label>Periode akhir :</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-calendar"></i></span>
							</div>
							<input placeholder="__/__/____" class="form-control tgl" data-date-format="dd/mm/YYYY" name="tanggal_akhir" id="tanggal_akhir" required>
						</div>
					</div>
					<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
  						<button type="submit" id="btn-save" class="btn btn-outline-primary">Search</button>
  						<button type="button" onClick="reset_form()" class="btn btn-outline-success">Reset</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="d-form-in permohonan">
			<div class="preview-document-2">
				<iframe id="preview" width="100%" height="100%" frameborder="0" style="border: none; background-color:transparent">
				</iframe>
			</div>
		</div>
	</div>
</div>
<script>
	$(".table-responsive").hide();
	$(function(){
		$('#form').submit(function(evt) 
		{
			evt.preventDefault();
			evt.stopImmediatePropagation();
			var url = $(this).attr('action');
    		var formData = new FormData($(this)[0]);

				$('.loading').fadeIn('fast');	
				$.ajax({
					url : url,
					type: "POST",
					dataType: "JSON",
					data:formData,
					processData: false,
					contentType: false,
					success: function (data) 
					{
						if(data.status) //if success close modal and reload ajax table
						{
							$('.loading').fadeOut('fast');
							$('#preview').attr('src','http://docs.google.com/viewer?url='+data.isi+'&embedded=true');
							
							$(".preview-document-2").show();
						}
						else
						{
							$('.loading').fadeOut('fast');
							swal("Upss... !","Terjadi Kesalahan pada input anda. Mohon periksa kembali inputan anda!", "error");
						}
					}
				});
	  });
	});
	
	function convertTanggal(timestamp) 
	{
		var u = timestamp.split(" ",1);
		var t = u[0].toString();
		var x = t.split("-");
		var bl = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
		var tgl = x[2]+" "+bl[parseInt(x[1])-1]+" "+x[0]; 
		return tgl;
  	}
	
	function reset_form()
	{
		$('#form')[0].reset();
		$('#tanggal_awal').focus();
		$(".preview-document-2").hide();
	}
	
</script>