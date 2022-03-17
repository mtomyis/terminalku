<div class="row">
	<div class="col-md-5">
		<div class="d-form">
			<div class="d-form-title">
				<h1 class="d-title"><img class="img-fluid img-title" src="<?php echo base_url();?>aset/icon/icon_detail_pekerjaan.png">Add Item Pekerjaan</h1>
			</div>
			<div class="d-form-in">
				<form method="post" id="form" action="<?php echo base_url();?>pekerjaan/save_item">
					<div class="form-group">
						<label for="nama_pekerjaan">Nama Pekerjaan:</label>
						<select class="form-control" name="id_pekerjaan" id="id_pekerjaan" required autofocus>
							<option></option>
							<?php 
							foreach($pekerjaan as $p)
							{
								echo '<option value="'.$p->id_pekerjaan.'">'.$p->nama_pekerjaan.'</option>';
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="nama_pekerjaan">Nama Sub Pekerjaan:</label>
						<select class="form-control" name="id_sub_pekerjaan" id="id_sub_pekerjaan" required>
						</select>
					</div>
					<div class="form-group">
						<label for="nama_pekerjaan">No. Refrensi:</label>
						<input type="text" class="form-control" id="no_refrensi_item_pekerjaan" name="no_refrensi_item_pekerjaan">
					</div>
					<div class="form-group">
						<label for="tahun_anggaran">Nama Item Pekerjaan:</label>
						<input type="text" class="form-control" id="nama_item_pekerjaan" name="nama_item_pekerjaan" required>
					</div>
					<div class="form-group">
						<label for="tahun_anggaran">Satuan:</label>
						<input type="text" class="form-control" id="satuan" name="satuan">
					</div>
					<div class="btn-group" role="group" aria-label="Basic example">
  						<button type="submit" id="btn-save" class="btn btn-primary"><span><i class="save-icon"></i> </span><p id="ind">Save</p></button>
  						<button type="button" onClick="reset_form_all()" class="btn btn-warning"><span><i class="reset-icon"></i> </span><p>Reset</p></button>
					</div>
				</form> 
			</div>
		</div>
	</div>
	<div class="col-md-7">
		<div id="x-table">
		<div class="d-table">
			<div class="d-form-title table-title">
				<h1 class="d-title"><img class="img-fluid img-title" src="<?php echo base_url();?>aset/icon/icon_pekerjaan.png"> <span id="pekerjaan"></span></h1>
			</div>
			<div class="search-table">
				<div class="row">
					<div class="col-md-6"></div>
					<div class="col-sm-6">
						<div class="input-group input-group">
							<input placeholder="search no ref./nama sub pekerjaan" class="form-control"name="cari" id="cari">
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
							<th>No Ref.</th>
							<th>Nama Item Pekerjaan</th>
							<th>Satuan</th>
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
</div>
<script>
$(document).ready(function() {
	$('#x-table').hide();
});
	function load_data_order(cari=null,id=null)
 	{
		if(id != null || id != "")
		{
			$('#x-table').show();
		}
		else
		{
			$('#x-table').hide();
		}
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
									"url"	: "<?php echo site_url('pekerjaan/ajax_list_item/')?>"+id,
									"type"	: "POST",
									data	:{
										cari:cari
									}
								},
				"columnDefs"	:
								[
									{ className: "text-center", "targets": [0],width:'40' },
									{ className: "text-center", "targets": [2],width:'10' },
									{ className: "text-center", "targets": [3]}
								]
		});
	}
	function reload_table()
	{
		var id = $('#id_sub_pekerjaan').val();
		if(id == null || id == ""){id ="-1";}
		var cari = $('#cari').val();
		$('#table').DataTable().destroy();
		load_data_order(cari,id);
	}
	function reset_form()
	{
		$('#form').attr('action', '<?php echo base_url();?>pekerjaan/save_item');
		$('#no_refrensi_item_pekerjaan').val("");
		$('#nama_item_pekerjaan').val("");
		$('#satuan').val("");
		$('#ind').text("Save");
		$('#no_refrensi_item_pekerjaan').focus();
	}
	function reset_form_all()
	{
		$('#form')[0].reset();
		$('#form').attr('action', '<?php echo base_url();?>pekerjaan/save_item');
		$('#id_pekerjaan').focus();
		$("#pekerjaan").text("");
		$('#ind').text("Save");
		reload_table();
		$('#x-table').hide();
	}
	$('#cari').keyup(function () {
		reload_table();
	});
	$('#id_pekerjaan').change(function () {
		get_all_sub();
	});
	$('#id_sub_pekerjaan').change(function () {
		reload_table();
		var pek = $("#id_pekerjaan").find('option:selected').text();
		var sub = $(this).find('option:selected').text();
		$("#pekerjaan").text(pek+"/"+sub);
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
						swal("Upss... ! Penyimpanan Gagal", "Pastikan inputan anda terisi dengan benar!", "error");
					}
        		}
			});
		});
	});
	function edit(id)
	{
		$('.loading').fadeIn('fast');
		reset_form();
		$('#form').attr('action', "<?php echo base_url('pekerjaan/update_item/');?>"+id);
		$.ajax({
			url : "<?php echo site_url('pekerjaan/edit_item/')?>" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('.loading').fadeOut('fast');
				$('#id_pekerjaan').val(data.id_pekerjaan);
				$('#id_sub_pekerjaan').val(data.id_sub_pekerjaan);
				$('#no_refrensi_item_pekerjaan').val(data.no_refrensi_item_pekerjaan);
				$('#nama_item_pekerjaan').val(data.nama_item_pekerjaan);
				$('#satuan').val(data.satuan);
				$('#ind').text("Update");
				$('#no_refrensi_item_pekerjaan').focus();			
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
					url : "<?php echo site_url('pekerjaan/delete_item')?>/"+id,
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
	function get_all_sub()
	{	
		$('.loading').fadeIn('fast');
		var id = $("#id_pekerjaan").val();
		if(id == null || id == "")
		{
			id = "-1";
		}
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
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				$('.loading').fadeOut('fast');
				swal('Upss..!','Terjadi kesalahan jaringan error message: '+errorThrown,'error');
			}
		});
	}
</script>