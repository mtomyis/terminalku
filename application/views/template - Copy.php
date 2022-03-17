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
		<script src="<?php echo base_url();?>aset/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>aset/vendor/datatables/jquery.dataTables.js"></script>
		<script src="<?php echo base_url();?>aset/vendor/datatables/dataTables.bootstrap4.js"></script>
		<script src="<?php echo base_url();?>aset/vendor/datatables/jquery.dataTables.js"></script>
		<script src="<?php echo base_url();?>aset/vendor/datatables/dataTables.bootstrap4.js"></script>
		<script src="<?php echo base_url();?>aset/plugins/swal/sweetalert.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>aset/js/jquery.mask.min.js"></script>
	</head>
	<body>
		<div class="loading">
			<div class="cssload-container">
				<div class="cssload-zenith"></div>
			</div>
 		</div>  
		<?php echo $header ;?>
		<div class="content">
			<?php echo $content ;?>
		</div>
		<script>
			$("#logout").click(function(){
				firebase.auth().signOut().then(function() {
				window.location.replace("<?php echo site_url();?>login/logout");
				}).catch(function(error) {
				});
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
		</script>
	</body>
</html>