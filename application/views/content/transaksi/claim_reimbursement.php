<div class="row">
	<div class="col-md-4">
		<div class="d-form">
			
			<div class="d-form-title">
				<h1 class="d-title"><img class="img-fluid img-title" src="<?php echo base_url();?>aset/icon/icon_pemasukan.png">Claim Reimbursement</h1>
			</div>
			<div class="d-form-in permohonan">
				<form method="post" id="form" action="<?php echo base_url();?>reimbursement/save_rencana">
		
				<div class="form-group">
					<label>Bukti Transaksi(*.png/jpg/jpeg) :</label>
					<div class="input-group">
						
						<input type="text" id="fake-file-input-name" disabled="disabled" placeholder="File not selected" class="form-control form-control-sm" required>
							<div class="input-group-prepend">
    						<button id="fake-file-button-browse" class="btn btn-danger btn-sm" type="button" autofocus><i class="fa fa-folder-open" aria-hidden="true"></i></button>
  						</div>
						
						
						<input accept=".jpeg,.jpg,.png" type="file" name="userfile" style="display: none" id="files-input-upload" required>
					
					</div>
				</div>
					
					
					
					<div class="form-group has-error">
						<label for="satuan">Jenis Transaksi:</label>
						<select class="form-control" name="jenis_transaksi" id="jenis_transaksi" required>
							<option></option>
							<option value="1">Operasional Kantor</option>
							<option value="2">Perjalanan Dinas</option>
							<option value="3">Lain-Lain</option>
						</select>
					</div>
					<div class="form-group has-error">
						<label for="satuan">Atas Nama:</label>
						<input type="text" class="form-control" id="atas_nama" name="atas_nama" required>
					</div>
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
			
			<div class="btn-save-rencana">
					<a id="kirim_pengajuan" class="btn btn-primary" href="javascript:void(0)">Kirim Pengajuan</a>
			
			</div>
			
			
			<div class="search-table">
				<div class="row">
					<div class="col-md-6"></div>
					<div class="col-sm-6">
						<div class="input-group input-group">
							<input placeholder="search uraian" class="form-control form-control-sm"name="cari" id="cari">
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
							<th>Jenis Transaksi</th>
							<th>Atas Nama</th>
							<th>Uraian</th>
							<th>Jumlah</th>
							<th>Bukti</th>
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
									"url"	: "<?php echo site_url('reimbursement/ajax_list_rencana')?>",
									"type"	: "POST",
									data	:{
										cari:cari
									}
								},
				"columnDefs"	:
								[
									{ className: "text-center", "targets": [0],width:'40' },
									{ className: "text-right", "targets": [4]},
									{ className: "text-center", "targets": [5,6]},
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
		$('#form').attr('action', '<?php echo base_url();?>reimbursement/save_rencana');
	}
	$('#cari').keyup(function () {
		reload_table();
	});
	$(function(){
		$('#form').submit(function(evt) 
		{
			$('.loading').fadeOut('fast');
			$('.loading-1').fadeIn('fast');
			$('.progress-bar').css('width',"0%");
        	$('.progress-bar').html("0%");
			$('.progress-bar').removeClass('bg-success').addClass('bg-info');
			$('#jml_qr').text('[ 0% ]');			
			evt.preventDefault();
			evt.stopImmediatePropagation();
    		var url = $(this).attr('action');
    		var formData = new FormData($(this)[0]);
    		$.ajax({
			 	xhr: function() 
				{
             		var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) 
					{
                   		if (evt.lengthComputable) 
						{
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            $('.progress-bar').css('width',percentComplete+"%");
                            $('.progress-bar').html(percentComplete+"%");
							$('#jml_qr').text('[ '+percentComplete+"% ]");
							if (percentComplete === 100) {
								$('.progress-bar').removeClass('bg-info').addClass('bg-success');
								setTimeout(reset_form,1000);
                        	}
                      	}
                    });
                    return xhr;
             	},		
				url : url,
				type: "POST",
				dataType: "JSON",
				data:formData,
				processData: false,
				contentType: false,
				success: function (data) 
				{
						$('.loading-1').fadeOut('fast');
    				if(data.status) //if success close modal and reload ajax table
					{
						reload_table();
						reset_form();
					
					}
					else
					{
						reload_table();
						reset_form();
						swal("Upss... !", data.error, "error");
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
					url : "<?php echo site_url('reimbursement/delete_rencana')?>/"+id,
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
	document.getElementById('fake-file-button-browse').addEventListener('click', function() {
		document.getElementById('files-input-upload').click();
	});
	document.getElementById('files-input-upload').addEventListener('change', function() {
		document.getElementById('fake-file-input-name').value = this.value;
	});
	
	function lihat_bukti(bukti)
	{
		$('#buktine').attr('src','<?php echo base_url();?>'+bukti);
		$("#fsModal").modal('show');
	}

	$('#kirim_pengajuan').click(function(){
		
		$('.loading').fadeIn('fast');
			$.ajax({
				url : "<?php echo site_url('reimbursement/kirim_pengajuan/')?>",
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


<div id="fsModal"
     class="modal animated bounceIn"
     tabindex="-1"
     role="dialog"
     aria-labelledby="myModalLabel"
     aria-hidden="true">

  <!-- dialog -->
  <div class="modal-dialog">

    <!-- content -->
    <div class="modal-content">

      <!-- header -->
      <div class="modal-header">
        <h1 id="myModalLabel"
            class="modal-title">
          Bukti Transaksi
        </h1>
      </div>
      <!-- header -->
      
      <!-- body -->
      <div class="modal-body">
       	<div class="bukti-transaksi">
		  	<img id="buktine" src="#" class="img-fluid"/>
		  
		  </div>

      </div>
      <!-- body -->

      <!-- footer -->
      <div class="modal-footer">
        <button class="btn btn-secondary"
               data-dismiss="modal">
          close
        </button>
      </div>
      <!-- footer -->

    </div>
    <!-- content -->

  </div>
  <!-- dialog -->

</div>
<!-- modal -->
