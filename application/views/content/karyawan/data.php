<div class="row">
	<div class="col-md-5">
		<div class="d-form">
			<div class="d-form-title">
				<h1 class="d-title"><img class="img-fluid img-title" src="<?php echo base_url();?>aset/icon/icon_karyawan.png"> Data Karyawan</h1>
			</div>
			<div class="d-form-in">
				<form method="post" id="form" action="<?php echo base_url();?>karyawan/save">
					<div class="form-group">
						<label for="nama_barang">Nama:</label>
						<input type="text" class="form-control" id="nama" name="nama" required autofocus>
					</div>
					<div class="form-group">
						<label for="satuan">Email:</label>
						<input type="email" class="form-control" id="email" name="email">
					</div>
					<div class="form-group">
						<label for="satuan">No Telp:</label>
						<input type="text" class="form-control" id="no_telpn" name="no_telpn">
					</div>
				<div class="form-group">
						<label for="satuan">Alamat:</label>
						<textarea class="form-control" id="alamat" name="alamat" rows="4"></textarea>
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
							<input placeholder="search nama karyawan" class="form-control"name="cari" id="cari">
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
							<th>Nama</th>
							<th>Email</th>
							<th>No Telpn</th>
							<th>Alamat</th>
							<th></th>
						</tr
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
									"url"	: "<?php echo site_url('karyawan/ajax_list')?>",
									"type"	: "POST",
									data	:{
										cari:cari
									}
								},
				"columnDefs"	:
								[
									{ className: "text-center", "targets": [0],width:'40' },
									{ className: "text-center", "targets": [4]},
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
		$('#form').attr('action', '<?php echo base_url();?>karyawan/save');
		$('#nama').focus();
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
						$('.loading').fadeOut('fast');
						reload_table();
						reset_form();
				
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
					url : "<?php echo site_url('karyawan/delete')?>",
					type: "POST",
					dataType: "JSON",
					data :{id:id},
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
	
	function edit(id)
	{
		$('.loading').fadeIn('fast');
		$('#form')[0].reset();
		$('#form').attr('action', "<?php echo base_url('karyawan/update/');?>"+id);
		$.ajax({
			url : "<?php echo site_url('karyawan/edit/')?>" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('.loading').fadeOut('fast');
				$('#nama').val(data.nama);
				$('#email').val(data.email);
				$('#no_telpn').val(data.no_telpn);
				$('#alamat').val(data.alamat);
				$('#ind').text("Update");
				$('#nama').focus();			
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				$('.loading').fadeOut('fast');
				swal('Upss..!','Terjadi kesalahan jaringan error message: '+errorThrown,'error');
			}
		});	
	}
</script>