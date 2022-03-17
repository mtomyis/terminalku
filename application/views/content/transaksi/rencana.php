<div class="row">
	<div class="col-md-4">
		<div class="d-form">
			
			<div class="d-form-title">
				<h1 class="d-title"><img class="img-fluid img-title" src="<?php echo base_url();?>aset/icon/icon_pemasukan.png">Perencanaan Order Material</h1>
			</div>
			<div class="d-form-in permohonan">
				<form method="post" id="form" action="<?php echo base_url();?>order_material/save_rencana">
					<div class='form-group'>
						<label>Pilih Proyek :</label>
						<select class='form-control form-control-sm' id='provinsi' name='proyek' required>
							<option value='0'>--pilih--</option>
							<?php 
							foreach ($pekerjaan as $prov) {
								echo "<option  value='$prov[proyek]'>$prov[proyek]</option>";
							}
							?>
						</select>
					</div>
					<div class='form-group'>
						<label>Pilih Pekerjaan</label>
						<select class='form-control form-control-sm' id='kabupaten-kota' name="pekerjaan" required>
							<option  value='0'>--pilih--</option>
						</select>
					</div>
					<div class='form-group'>
						<label>Uraian Pekerjaan</label>
						<select class='form-control form-control-sm' id='kecamatan' name="uraian_pekerjaan" required>
							<option  value='0'>--pilih--</option>
						</select>
					</div>
					<div class="form-group">
						<label for="satuan">Nama Toko:</label>
						<select onChange="get_all_barang()" class="form-control form-control-sm" name="id_toko" id="id_toko" required>
							<option></option>
							<?php 
							foreach($toko as $p)
							{
								echo '<option value="'.$p->id_toko.'">'.$p->nama_toko.'</option>';
							}
								
							?>
						</select>
					</div>
					<div class="form-group has-error">
						<label for="satuan">Nama Barang:</label>
						<!-- <select onChange="get_harga()" class="form-control form-control-sm" name="id_barang" id="id_barang" required> -->
						<select onChange="get_harga_barang()" class="form-control form-control-sm" name="id_barang" id="id_barang" required>

							<option></option>
						</select>
					</div>
					
					
					<div class="form-group">
						<label for="satuan">Volume:</label>
						<!-- <select onChange="get_harga()" class="form-control form-control-sm" name="id_barang" id="id_barang" required> -->
						<select class="form-control form-control-sm" name="jumlah" id="jumlah" required>
							<option value='0'></option>
						</select>

						<!-- <label for="harga">Volume:</label>
						<input type="text" class="form-control form-control-sm ribuan" id="jumlah" name="jumlah" required> -->

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
			
			<div class="btn-save-rencana">
					<a id="kirim_pengajuan" class="btn btn-primary" href="javascript:void(0)">Kirim Pengajuan</a>
			
			</div>
			
			
			<div class="search-table">
				<div class="row">
					<div class="col-md-6"></div>
					<div class="col-sm-6">
						<div class="input-group input-group">
							<input placeholder="search barang/nama toko" class="form-control form-control-sm"name="cari" id="cari">
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
							<th>Jumlah</th>
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
									"url"	: "<?php echo site_url('order_material/ajax_list_rencana')?>",
									"type"	: "POST",
									data	:{
										cari:cari
									}
								},
				"columnDefs"	:
								[
									{ className: "text-center", "targets": [0],width:'40' },
									{ className: "text-right", "targets": [3]},
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
		$('#form').attr('action', '<?php echo base_url();?>order_material/save_rencana');
		$("#id_item_pekerjaan").empty();
		$("#id_sub_pekerjaan").empty();
		$('#id_pekerjaan').focus();
		disable($("#id_item_pekerjaan"));
		disable($("#id_sub_pekerjaan"));
	}
	$('#cari').keyup(function () {
		reload_table();
	});
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
		$('#form').attr('action', "<?php echo base_url('order_material/update_rencana/');?>"+id);
		$.ajax({
			url : "<?php echo site_url('order_material/edit_rencana/')?>" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('.loading').fadeOut('fast');
				$('#id_pekerjaan').val(data.id_pekerjaan);
				$('#id_toko').val(data.id_toko);
				$('#jumlah').val(formatRibuan(data.jumlah));
				$('#ind').text("Update");
				$('#id_pekerjaan').focus();
				enable($("#id_item_pekerjaan"));
				enable($("#id_sub_pekerjaan"));
				new_get_all_pekerjaan_edit(data.id_sub_pekerjaan,data.id_pekerjaan);
				get_all_barang_edit(data.id_barang);
				
				get_all_item_edit(data.id_item_pekerjaan,data.id_sub_pekerjaan);
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
					url : "<?php echo site_url('order_material/delete_rencana')?>/"+id,
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
	$('#id_pekerjaan').change(function () {
		new_get_all_pekerjaan();
	});
	$('#id_sub_pekerjaan').change(function () {
		get_all_item();
	});
	function new_get_all_pekerjaan()
	{	
		disable($("#id_item_pekerjaan"));
		$("#id_item_pekerjaan").empty();
		var id = $("#id_pekerjaan").val();
		if(id == "" || id == null)
		{
			id = "-1"
			$("#id_sub_pekerjaan").empty();
			disable($("#id_sub_pekerjaan"));
		}
		else{
			$('.loading').fadeIn('fast');
			$.ajax({
				url : "<?php echo site_url('pekerjaan/new_get_all_pekerjaan/')?>" + id,
				type: "GET",
				dataType: "JSON",
				success: function(data)
				{
					$('.loading').fadeOut('fast');
						var len = data.length;
						$("#id_sub_pekerjaan").empty();
						$("#id_sub_pekerjaan").append('<option></option>');
						for( var i = 0; i<len; i++){
							var id = data[i]['id_sub_pekerjaan'];
							var no_ref = data[i]['no_refrensi'];
							var sub_pekerjaan = data[i]['nama_sub_pekerjaan'];
							$("#id_sub_pekerjaan").append('<option value="'+id+'">'+no_ref+'. '+sub_pekerjaan+'</option>');
						}
					
					enable($("#id_sub_pekerjaan"));

				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					$('.loading').fadeOut('fast');
					swal('Upss..!','Terjadi kesalahan jaringan error message: '+errorThrown,'error');
				}
			});
		}
	}
	function get_all_item()
	{	
		var id = $("#id_sub_pekerjaan").val();
		if(id == "" || id == null)
		{
			id = "-1";
			$("#id_item_pekerjaan").empty();
			disable($("#id_item_pekerjaan"));
		}
		else{
			$('.loading').fadeIn('fast');
			$.ajax({
				url : "<?php echo site_url('pekerjaan/get_all_item/')?>" + id,
				type: "GET",
				dataType: "JSON",
				success: function(data)
				{
					$('.loading').fadeOut('fast');
						var len = data.length;
						$("#id_item_pekerjaan").empty();
						disable($("#id_item_pekerjaan"));
						$("#id_item_pekerjaan").append('<option></option>');
						for( var i = 0; i<len; i++){
							var id = data[i]['id_item_pekerjaan'];
							var no_ref = data[i]['no_refrensi_item_pekerjaan'];
							var sub_pekerjaan = data[i]['nama_item_pekerjaan'];
							$("#id_item_pekerjaan").append('<option value="'+id+'">'+no_ref+'. '+sub_pekerjaan+'</option>');
						}
						enable($("#id_item_pekerjaan"));
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					$('.loading').fadeOut('fast');
					swal('Upss..!','Terjadi kesalahan jaringan error message: '+errorThrown,'error');
				}
			});
		}
	}

	
	function get_all_barang()
	{	
		var id = $("#id_toko").val();
		if(id == "" || id == null)
		{
			id = "-1";
			$("#id_barang").empty();
		}
		else{
			$('.loading').fadeIn('fast');
			$.ajax({
				url : "<?php echo site_url('order_material/get_all_barang/')?>" + id,
				type: "GET",
				dataType: "JSON",
				success: function(data)
				{
					$('.loading').fadeOut('fast');
						var len = data.length;
						$("#id_barang").empty();
						$("#id_barang").append('<option></option>');
						for( var i = 0; i<len; i++){
							var id = data[i]['id_daftar_harga'];
							var nama_barang = data[i]['nama_barang'];
							$("#id_barang").append('<option value="'+id+'">'+nama_barang+'</option>');
						}
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					$('.loading').fadeOut('fast');
					swal('Upss..!','Terjadi kesalahan jaringan error message: '+errorThrown,'error');
				}
			});
		}
	}

	function get_harga_barang()
	{	
		var id = $("#id_barangs").val();
		if(id == "" || id == null)
		{
			id = "-1";
			$("#jumlah").empty();
		}
		else{
			$('.loading').fadeIn('fast');
			$.ajax({
				url : "<?php echo site_url('order_material/get_harga_barang/')?>" + id,
				type: "GET",
				dataType: "JSON",
				success: function(data)
				{
					$('.loading').fadeOut('fast');
						var len = data.length;
						$("#jumlah").empty();

						$("#jumlah").append('<option></option>');
						for( var i = 0; i<len; i++){
							var id = data[i]['harga'];
							var jumlah = data[i]['harga'];
							$("#jumlah").append('<option value="'+id+'">'+jumlah+'</option>');
						}
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					$('.loading').fadeOut('fast');
					swal('Upss..!','Terjadi kesalahan jaringan error message: '+errorThrown,'error');
				}
			});
		}
	}

	
	function disable(x)
	{
		$(x).attr('disabled','disabled');
	}
	function enable(x)
	{
		$(x).removeAttr('disabled');
	}
	
	
	function new_get_all_pekerjaan_edit(id_x,idn)
	{	
			$('.loading').fadeIn('fast');
			$.ajax({
				url : "<?php echo site_url('pekerjaan/new_get_all_pekerjaan/')?>" + idn,
				type: "GET",
				dataType: "JSON",
				success: function(data)
				{
					$('.loading').fadeOut('fast');
						var len = data.length;
						$("#id_sub_pekerjaan").empty();
						$("#id_sub_pekerjaan").append('<option></option>');
						for( var i = 0; i<len; i++){
							var id = data[i]['id_sub_pekerjaan'];
							var no_ref = data[i]['no_refrensi'];
							var sub_pekerjaan = data[i]['nama_sub_pekerjaan'];
							$("#id_sub_pekerjaan").append('<option value="'+id+'">'+no_ref+'. '+sub_pekerjaan+'</option>');
						}
					
					enable($("#id_sub_pekerjaan"));
					$("#id_sub_pekerjaan").val(id_x);

				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					$('.loading').fadeOut('fast');
					swal('Upss..!','Terjadi kesalahan jaringan error message: '+errorThrown,'error');
				}
			});
	}
	function get_all_item_edit(id_x,idn)
	{	
		
	
		console.log("TES BRO");
			$('.loading').fadeIn('fast');
			$.ajax({
				url : "<?php echo site_url('pekerjaan/get_all_item/')?>" + idn,
				type: "GET",
				dataType: "JSON",
				success: function(data)
				{
					$('.loading').fadeOut('fast');
						var len = data.length;
						$("#id_item_pekerjaan").empty();
						disable($("#id_item_pekerjaan"));
						$("#id_item_pekerjaan").append('<option></option>');
						for( var i = 0; i<len; i++){
							var id = data[i]['id_item_pekerjaan'];
							var no_ref = data[i]['no_refrensi_item_pekerjaan'];
							var sub_pekerjaan = data[i]['nama_item_pekerjaan'];
							$("#id_item_pekerjaan").append('<option value="'+id+'">'+no_ref+'. '+sub_pekerjaan+'</option>');
						}
					enable($("#id_item_pekerjaan"));
					$("#id_item_pekerjaan").val(id_x);
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					$('.loading').fadeOut('fast');
					swal('Upss..!','Terjadi kesalahan jaringan error message: '+errorThrown,'error');
				}
			});
		
	}
	
	
	
	
	function get_all_barang_edit(id_x)
	{	
		var id = $("#id_toko").val();
		if(id == "" || id == null)
		{
			id = "-1";
			$("#id_barang").empty();
		}
		else{
			$('.loading').fadeIn('fast');
			$.ajax({
				url : "<?php echo site_url('order_material/get_all_barang/')?>" + id,
				type: "GET",
				dataType: "JSON",
				success: function(data)
				{
					$('.loading').fadeOut('fast');
						var len = data.length;
						$("#id_barang").empty();
						$("#id_barang").append('<option></option>');
						for( var i = 0; i<len; i++){
							var id = data[i]['id_daftar_harga'];
							var nama_barang = data[i]['nama_barang'];
							$("#id_barang").append('<option value="'+id+'">'+nama_barang+'</option>');
						}
					
					$('#id_barang').val(id_x);
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					$('.loading').fadeOut('fast');
					swal('Upss..!','Terjadi kesalahan jaringan error message: '+errorThrown,'error');
				}
			});
		}
	}
	$('#kirim_pengajuan').click(function(){
		
		$('.loading').fadeIn('fast');
			$.ajax({
				url : "<?php echo site_url('order_material/kirim_pengajuan/')?>",
				type: "GET",
				dataType: "JSON",
				success: function(data)
				{
					if(data.success == 1)
					{
						reload_table();
						reset_form();
						$('.loading').fadeOut('fast');
						swal('Sucess','Data berhasil di kirim','success');
					}
					
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					$('.loading').fadeOut('fast');
					swal('Upss..!','Terjadi kesalahan jaringan error message: '+errorThrown,'error');
				}
			});
	});
</script>

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