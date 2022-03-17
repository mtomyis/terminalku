<div class="row">
	<div class="col-md-4">
		<div class="d-form">
			
			<div class="d-form-title">
				<h1 class="d-title"><img class="img-fluid img-title" src="<?php echo base_url();?>aset/icon/icon_pemasukan.png">Pengajuan Kas</h1>
			</div>
			<div class="d-form-in permohonan">
				<form method="post" id="form" action="<?php echo base_url();?>kas/save_pengajuan">
					<div class="form-group has-error">
						<label for="satuan">Uraian:</label>
						<textarea class="form-control" name="uraian" id="uraian" rows="3"></textarea>
					</div>
		
					<div class="form-group">
						<label for="harga">Jumlah:</label>
						<input type="text" class="form-control ribuan" id="jumlah" name="jumlah" required>
					</div>
					
					<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
  						<button type="submit" id="btn-save" class="btn btn-primary"><span><i class="save-icon"></i> </span><p id="ind">Save</p></button>
  						<button type="button" onClick="reset_form()" class="btn btn-warning"><span><i class="reset-icon"></i> </span><p>Reset</p></button>
					</div>
				</form> 
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="d-table">
			<div class="search-table">
				<div class="row">
					<div class="col-md-6"></div>
					<div class="col-sm-6">
						<div class="input-group input-group">
							<input placeholder="search tanggal/uraian" class="form-control form-control-sm"name="cari" id="cari">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-search"></i></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="table-responsive">
				<table id="table" class="table table-bordered">
					<thead valign="middle">
						<tr>
							<th>No</th>
							<th>No. Pengajuan</th>
							<th>Tanggal</th>
							<th>Uraian</th>
							<th>Jumlah</th>
							<th>Status</th>
							<th></th>
						</tr>
					</thead>
					<tbody valign="middle">
					</tbody>
				</table>                      
			</div>
		</div>
	</div>
</div>

<script>
	load_data_order(null);
	function load_data_order(cari=null)
 	{
		var	table = $('#table').DataTable({ 
				"oLanguage"		: {"sSearch": "Search : "},
				"processing"	: true,
				responsive		: true, 
				"serverSide"	: true,
				'paging'		: true,
				'lengthChange'	: false,
				'ordering'    	: false,
				'info'        	: false,
				'autoWidth'   	: false,
				"searching"		: false,
				"aLengthMenu"	: [[25,50,75,100,-1], [25,50,75,100,"Semua"]],
				"ajax"			:
								{
									"url"	: "<?php echo site_url('kas/ajax_list_pengajuan')?>",
									"type"	: "POST",
									data	:{
										cari:cari
									}
								},
				"columnDefs"	:
								[
									{ className: "text-center", "targets": [0],width:'40' },
									{ className: "text-right", "targets": [4,6]},
									{ className: "text-center", "targets": [2,1]},
								]
		});
	}
	function reload_table()
	{
		var cari = $('#cari').val();
		$('#table').DataTable().destroy();
		load_data_order(cari);
	}
	function reset_form()
	{
		$('#form')[0].reset();
		$('#ind').text("Save");
		$('#form').attr('action', '<?php echo base_url();?>kas/save_pengajuan');
	}
	$('#cari').keyup(function () {
		reload_table();
	});
	$(function(){
		$('#form').submit(function(evt) 
		{
			$('.loading').fadeIn('fast');	
			evt.preventDefault();
			evt.stopImmediatePropagation();
    		var url = $(this).attr('action');
    		var formData = new FormData($(this)[0]);
    		$.ajax({
				url : url,
				type: "POST",
				dataType: "JSON",
				data:formData,
				processData: false,
				contentType: false,
				success: function (data) 
				{
    				if(data.success == 1)
					{
						reload_table();
						reset_form();
						$('.loading').fadeOut('fast');
					}
					else
					{
						$('.loading').fadeOut('fast');
						reload_table();
						reset_form();
						swal("Upss... !","Terjadi Kesalahan pada input anda. Mohon periksa kembali inputan anda!", "error");
					}
        		}
			});
		});
	});
</script>