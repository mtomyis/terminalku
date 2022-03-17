<div class="row">
	<div class="col-md-5">
		<div class="d-form">
			<div class="d-form-title">
				<h1 class="d-title"><img class="img-fluid img-title" src="<?php echo base_url();?>aset/icon/icon_sub_pekerjaan.png">Add Sub Pekerjaan</h1>
			</div>
			<div class="d-form-in">
				<form method="post" id="form" action="<?php echo base_url();?>pekerjaan/save_sub">
					<div class="form-group">
						<label for="nama_pekerjaan">Nama Pekerjaan:</label>
						<select class="form-control" name="id_pekerjaan" id="id_pekerjaan" required autofocus>
							<option value="-1"></option>
							<?php 
							foreach($pekerjaan as $p)
							{
								echo '<option value="'.$p->id_pekerjaan.'">'.$p->nama_pekerjaan.'</option>';
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="nama_pekerjaan">No. Refrensi:</label>
						<input type="text" class="form-control" id="no_refrensi" name="no_refrensi" required>
					</div>
					<div class="form-group">
						<label for="tahun_anggaran">Nama Sub Pekerjaan:</label>
						<input type="text" class="form-control" id="nama_sub_pekerjaan" name="nama_sub_pekerjaan" required>
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
							<th>Nama Sub Pekerjaan</th>
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
	
	function load_data_order(cari=null,id="-1")
 	{
		if(id != "-1")
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
									"url"	: "<?php echo site_url('pekerjaan/ajax_list_sub/')?>"+id,
									"type"	: "POST",
									data	:{
										cari:cari
									}
								},
				"columnDefs"	:
								[
									{ className: "text-center", "targets": [0],width:'40' },
									{ className: "text-center", "targets": [2]},
								]
		});
		
		
	}
	function reload_table()
	{
		var id = $('#id_pekerjaan').val();
		var cari = $('#cari').val();
		$('#table').DataTable().destroy();
		load_data_order(cari,id);
	}
	function reset_form()
	{
		$('#form').attr('action', '<?php echo base_url();?>pekerjaan/save_sub');
		$('#no_refrensi').val("");
		$('#nama_sub_pekerjaan').val("");
		$('#ind').text("Save");
		$('#no_refrensi').focus();
	}
	function reset_form_all()
	{
		$('#form')[0].reset();
		$('#form').attr('action', '<?php echo base_url();?>pekerjaan/save_sub');
		$('#id_pekerjaan').focus();
		$("#pekerjaan").text("");
		$('#ind').text("Save");
		reload_table();
	}
	$('#cari').keyup(function () {
		reload_table();
	});
	
	$('#id_pekerjaan').change(function () {
		reload_table();
		var selectedText = $(this).find('option:selected').text();
		$("#pekerjaan").text(selectedText);
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
						$('.loading-1').fadeOut('fast');
						reload_table();
						reset_form();
						swal("Upss... !", data.error, "error");
					}
        		}
			});
		});
	});
	function edit(id)
	{
		$('.loading').fadeIn('fast');
		reset_form();
		$('#form').attr('action', "<?php echo base_url('pekerjaan/update_sub/');?>"+id);
		$.ajax({
			url : "<?php echo site_url('pekerjaan/edit_sub/')?>" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('.loading').fadeOut('fast');
				$('#id_pekerjaan').val(data.id_pekerjaan);
				$('#no_refrensi').val(data.no_refrensi);
				$('#nama_sub_pekerjaan').val(data.nama_sub_pekerjaan);
				$('#ind').text("Update");
				$('#no_refrensi').focus();			
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
					url : "<?php echo site_url('pekerjaan/delete_sub')?>/"+id,
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