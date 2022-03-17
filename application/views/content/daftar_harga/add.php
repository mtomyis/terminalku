<div class="row">
	<div class="col-md-5">
		<div class="d-form">
			<div class="d-form-title">
				<h1 class="d-title"><img class="img-fluid img-title" src="<?php echo base_url();?>aset/icon/icon_daftar_harga.png"> Daftar Harga</h1>
			</div>
			<div class="d-form-in">
				<form method="post" id="form" action="<?php echo base_url();?>daftar_harga/save">
					<div class="form-group">
						<select class="form-control" id="id_toko" name="id_toko" required autofocus>
							<option></option>
							<?php 
								foreach($toko as $t)
								{
									echo '<option value="'.$t->id_toko.'">'.$t->nama_toko.'</option>';
								}

							?>
						</select>
					</div>
					<div class="form-group">
						<label for="nama_barang">Nama Barang:</label>
						<input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
					</div>
					<div class="form-group">
						<label for="nama_barang">Merk:</label>
						<input type="text" class="form-control" id="merk" name="merk">
					</div>
					<div class="form-group">
						<label for="satuan">Satuan:</label>
						<input type="text" class="form-control" id="satuan" name="satuan" required>
					</div>
					<div class="form-group">
						<label for="harga">Harga:</label>
						<input type="text" class="form-control ribuan" id="harga" name="harga" required>
					</div>
					<div class="btn-group" role="group" aria-label="Basic example">
  						<button type="submit" id="btn-save" class="btn btn-primary"><span><i class="save-icon"></i> </span><p id="ind">Save</p></button>
  						<button type="button" onClick="reset_form()" class="btn btn-warning"><span><i class="reset-icon"></i> </span><p>Reset</p></button>
					</div>
				</form> 
			</div>
		</div>
	</div>
	<div class="col-md-7">
		<div class="d-table">
			<div class="search-table">
				<div class="row">
					<div class="col-md-6"></div>
					<div class="col-sm-6">
						<div class="input-group input-group">
							<input placeholder="search barang" class="form-control"name="cari" id="cari">
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
							<th>Nama Toko</th>
							<th>Nama Barang</th>
							<th>Merk</th>
							<th>Satuan</th>
							<th>Harga</th>
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
									"url"	: "<?php echo site_url('daftar_harga/ajax_list')?>",
									"type"	: "POST",
									data	:{
										cari:cari
									}
								},
				"columnDefs"	:
								[
									{ className: "text-center", "targets": [0],width:'40' },
									{ className: "text-center", "targets": [3]},
									{ className: "text-right", "targets": [5]},
									{ className: "text-center", "targets": [6]},
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
		$('#form').attr('action', '<?php echo base_url();?>daftar_harga/save');
		$('#id_toko').focus();
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
    				if(data.status) //if success close modal and reload ajax table
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
	function edit(id)
	{
		$('.loading').fadeIn('fast');
		$('#form')[0].reset();
		$('#form').attr('action', "<?php echo base_url('daftar_harga/update/');?>"+id);
		$.ajax({
			url : "<?php echo site_url('daftar_harga/edit/')?>" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('.loading').fadeOut('fast');
				$('#nama_barang').val(data.nama_barang);
				$('#id_toko').val(data.id_toko);
				$('#merk').val(data.merk);
				$('#satuan').val(data.satuan);
				$('#harga').val(formatRibuan(data.harga));
				$('#ind').text("Update");
				$('#id_toko').focus();			
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				$('.loading').fadeOut('fast');
				swal('Upss..!','Terjadi kesalahan jaringan error message: '+errorThrown,'error');
			}
		});	
	}
	function delete_data(id)
	{
	 	swal({
		title: "DELETE FILE !",
		text: "Are you sure?",
		type: "warning",
		showCancelButton: true,
		confirmButtonText: 'Yes, delete!',
		cancelButtonText: "No, cancel!",
		closeOnConfirm: true,
		closeOnCancel: true,
		},
		function(isConfirm)
		{
			if (isConfirm)
			{
				$('.loading').fadeIn('fast');
				$.ajax({
					url : "<?php echo site_url('daftar_harga/delete')?>/"+id,
					type: "POST",
					dataType: "JSON",
					success: function(data)
					{
						$('.loading').fadeOut('fast');
						if(data.status)
						{
							reload_table();
							reset_form();
						}
						else
						{
							swal("Peringatan ...!", "Anda tidak berhak melakukan perintah ini !", "error");	
						}
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						$('.loading').fadeOut('fast');
						swal("Upss...!", "Terjadi kesalahan jaringan pesan error : !"+errorThrown, "error");
					}
				});
			} 
			else 
			{
				$('.loading').fadeOut('fast');
			  	swal("Batal", "Data masih tersimpan:)", "error");
			}
		});
	}
</script>