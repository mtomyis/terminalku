<!DOCTYPE html>
<html lang="en">
	<head>
  		<meta charset="utf-8">
  		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  	<meta name="description" content="">
	  	<meta name="author" content="">
	  	<title><?php echo $title;?></title>
		<link rel="icon" href="<?php echo base_url();?>aset/img/fav.png">
  		<link href="<?php echo base_url();?>aset/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>aset/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
		<link href="<?php echo base_url();?>aset/plugins/swal/sweetalert.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Lato|Ubuntu:400,700" rel="stylesheet"> 
		<link href="<?php echo base_url();?>aset/font/css/font-awesome.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>aset/css/style.css" rel="stylesheet">
		<link href="<?php echo base_url();?>aset/css/loading.css" rel="stylesheet">
		<script src="<?php echo base_url();?>aset/js/jquery.js"></script>

		<script type="text/javascript" src="<?php echo base_url('aset/vendor/jquery/jquery.min.js') ?>"></script>

		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
	  	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
	  	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->

	  	

	  	<!-- datepicker bootstrap -->
	  	<link rel="stylesheet" href="<?php echo base_url('aset') ?>/date/css/bootstrap-datepicker.min.css">
	  	<script src="<?php echo base_url('aset') ?>/date/js/bootstrap-datepicker.min.js"></script>
	  	<script src="<?php echo base_url('aset') ?>/date/locales/bootstrap-datepicker.id.min.js"></script>


		<script src="<?php echo base_url();?>aset/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>aset/vendor/datatables/jquery.dataTables.js"></script>
		<script src="<?php echo base_url();?>aset/vendor/datatables/dataTables.bootstrap4.js"></script>
		<script src="<?php echo base_url();?>aset/vendor/datatables/jquery.dataTables.js"></script>
		<script src="<?php echo base_url();?>aset/vendor/datatables/dataTables.bootstrap4.js"></script>
		<script src="<?php echo base_url();?>aset/plugins/swal/sweetalert.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>aset/js/jquery.mask.min.js"></script>
</script>
	</head>
	<body>
		<div class="loading">
			<div class="cssload-container">
				<div class="cssload-zenith"></div>
			</div>
 		</div>  
		<div class="loading-1">
			<div class="cssload-container">
				<div class="cssload-zenith"></div>
			</div>
			
			<p class="saving">Uploading File <i class="jml_qr" id="jml_qr">[ 0% ]</i> please wait <span>.</span><span>.</span><span>.</span></p>
			<div class="ind-loading">
				<div class="progress">
					<div class="progress-bar progress-bar-striped progress-bar-animated bg-info" style="width:0%"></div>
				</div>
			</div>
 		</div> 
		<?php echo $header ;?>
		<div class="content">
			<?php echo $content ;?>
		</div>
		<!-- <script>
			$(function(){
				$('.tgl').mask('99/99/9999');
			});
			$('.angka').keyup(function(e)
            {
				if (/\D/g.test(this.value))
			  	{
					this.value = this.value.replace(/\D/g, '');
			  	}
			});
			jQuery(function($) 
			{
				$(".ribuan").mask("#.##0", {reverse: true});
				$('.ribuan').css('text-align', 'right');
			});
			function formatRibuan(angka) 
			{
			 	if (typeof(angka) != 'string') angka = angka.toString();
			 	var reg = new RegExp('([0-9]+)([0-9]{3})');
			 	while(reg.test(angka)) angka = angka.replace(reg, '$1.$2');
			 	return angka;
			}
		</script> -->
	</body>
</html>