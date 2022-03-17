<div class="row">
	<div class="col-md-4">
		<div class="d-form">
			
			<div class="d-form-title">
				<h1 class="d-title"><img class="img-fluid img-title" src="<?php echo base_url();?>aset/icon/icon_permohonan.png"> Permohonan Pengeluaran</h1>
			</div>
			<div class="d-form-in permohonan">
				<form method="post" id="form" action="<?php echo base_url();?>permohonan/save">
					<div class="form-group has-error">
						<label for="satuan">Jenis Transaksi:</label>
						<select class="form-control form-control-sm" name="jenis_transaksi" id="jenis_transaksi" required>
							<option></option>
							<option value="1">Budgeter</option>
							<option value="2">Non Budgeter</option>
						</select>
					</div>
					<div class="form-group has-error">
						<label for="nama_barang">Nama Pekerjaan:</label>
						<select class="form-control form-control-sm" name="id_pekerjaan" id="id_pekerjaan" required autofocus>
							<option></option>
							<?php 
							foreach($pekerjaan as $p)
							{
								echo '<option value="'.$p->id_pekerjaan.'">'.$p->nama_pekerjaan.'</option>';
							}
								
							?>
						</select>
					</div>
					<div class="form-group has-error">
						<label for="satuan">Sub Pekerjaan:</label>
						<select class="form-control form-control-sm" name="id_sub_pekerjaan" id="id_sub_pekerjaan" required disabled>
						</select>
					</div>
					<div class="form-group has-error">
						<label for="satuan">Item Pekerjaan:</label>
						<select class="form-control form-control-sm" name="id_item_pekerjaan" id="id_item_pekerjaan" required ="" disabled>
						</select>
					</div>
					<div class="form-group">
						<label for="satuan">Nama Barang:</label>
						<select onChange="get_harga()" class="form-control form-control-sm" name="id_barang" id="id_barang" required>
							<option></option>
							<?php 
							foreach($barang as $p)
							{
								echo '<option value="'.$p->id_daftar_harga.'">'.$p->nama_barang.'</option>';
							}
								
							?>
						</select>
					</div>
					<div class="form-group row x-row">
						<div class="col-md-6">
						<label for="harga">Harga Satuan:</label>
						<input type="text" class="form-control form-control-sm ribuan" id="harga_satuan" name="harga_satuan" required>
							</div>
						<div class="col-md-6">
						<div class="form-group">
						<label for="harga">Quantity:</label>
						<input type="text" onKeyUp="kali()" class="form-control form-control-sm ribuan" id="quantity" name="quantity" required>
					</div>
						</div>
					</div>
					<div class="form-group has-error keatas-15">
						<label for="harga">Uraian:</label>
						<input type="text" class="form-control form-control-sm" id="uraian" name="uraian" required="">
					</div>
					
					<div class="form-group">
						<label for="harga">Jumlah:</label>
						<input type="text" class="form-control form-control-sm ribuan" id="jumlahx" name="jumlahx" required>
						<input type="hidden" id="jumlah" name="jumlah">
					</div>
					
					
					<input type="hidden" id="nama_barang_permohonan" name="nama_barang_permohonan">
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
							<input placeholder="search barang" class="form-control form-control-sm"name="cari" id="cari">
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
							<th>Tanggal</th>
							<th>Uraian</th>
							<th>Nama Barang</th>
							<th>Satuan</th>
							<th>Harga Satuan</th>
							<th>Quantity</th>
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
									"url"	: "<?php echo site_url('permohonan/ajax_list')?>",
									"type"	: "POST",
									data	:{
										cari:cari
									}
								},
				"columnDefs"	:
								[
									{ className: "text-center", "targets": [0],width:'40' },
									{ className: "text-center", "targets": [2]},
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
		$('#form').attr('action', '<?php echo base_url();?>permohonan/save');
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
			swal({
			title: "PERINGATAN !",
			text: "Karena tidak ada menu edit pada form ini. Mohon pastikan isian yang anda masukkan benar!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: 'Yes, save!',
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
				}
				else 
				{
					$('.loading').fadeOut('fast');
					swal("Batal", "Data batal disimpan", "error");
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
					url : "<?php echo site_url('permohonan/delete')?>/"+id,
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
		get_all_sub();
	});
	$('#id_sub_pekerjaan').change(function () {
		get_all_item();
	});
	function get_all_sub()
	{	
		disable($("#id_item_pekerjaan"));
		$("#id_barang").val("-1");
		$("#harga_satuan").val("");
		$("#quantity").val("");
		$("#jumlah").val("");
		$("#uraian").val("");
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
				url : "<?php echo site_url('pekerjaan/get_all_sub/')?>" + id,
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
		$("#id_barang").val("");
		$("#harga_satuan").val("");
		$("#quantity").val("");
		$("#jumlah").val("");
		$("#uraian").val("");
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
	
	
	$("#id_item_pekerjaan").change(function(){
		var id = this.value;
		if(id == "" || id == null)
		{
			$("#id_barang").val("-1");
			$("#harga_satuan").val("");
			$("#quantity").val("");
			$("#jumlah").val("");
			$("#uraian").val("");		
		}
		else
		{
			$("#id_barang").val("-1");
			$("#jumlah").val("");
			$("#harga_satuan").val("");
			$("#quantity").val("");
			$("#uraian").val("");	
		}
		
		
	});
	
	
	function kali()
	{
		var h_satuan = $('#harga_satuan').val(),
			qty = $('#quantity').val(),
			x = 0,
			y = 0;
		if(h_satuan != null || h_satuan != ""){
			x = h_satuan;
		}
		
		if (qty != null || qty != ""){
			y = qty;		
		}
		
		var x1 = x.replace(/\./g, ""),
			y1 = y.replace(/\./g, "");
		var z = parseFloat(x1) * parseFloat(y1);
		if(!isNaN(z))
		{
			$('#jumlah').val(z);	
			$('#jumlahx').val(formatRibuan(z));	
		}
		else
		{
			$('#jumlah').val("");	
			$('#jumlahx').val("");	
		}
	}
	
	function get_harga()
	{	
		
		var id = $('#id_barang').val();
		var text = $('#id_barang').find('option:selected').text();
		
		if(id == "" || id == "")
		{
			$('#harga_satuan').val("");
			$('#quantity').val("");
			$('#jumlah').val("");
			$("#quantity").attr('disabled','disabled');
			$("#nama_barang_permohonan").val("");
		}
		else
		{
			$("#nama_barang_permohonan").val(text);
			$('.loading').fadeIn('fast');
			$.ajax({
				url : "<?php echo site_url('permohonan/get_harga_barang/')?>" + id,
				type: "GET",
				dataType: "JSON",
				success: function(data)
				{
					var x = "";
					try {
						x= data.harga;
					}
					catch(err) {

					}
					$('.loading').fadeOut('fast');
					$("#quantity").attr('disabled','disabled');
					$('#quantity').val("");
					$('#jumlah').val("");
					$('#harga_satuan').val(formatRibuan(x));
					kali();
					$("#quantity").removeAttr('disabled');
					$('#quantity').focus();

				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					$('.loading').fadeOut('fast');
					swal('Upss..!','Terjadi kesalahan jaringan error message: '+errorThrown,'error');
				}
			});
		}
	}
	$('#jumlahx').keyup(function(){
		var x = this.value.replace(/\./g, "");
		$('#jumlah').val(x);
	});
	function disable(x)
	{
		$(x).attr('disabled','disabled');
	}
	function enable(x)
	{
		$(x).removeAttr('disabled');
	}
</script>