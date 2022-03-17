<!DOCTYPE html>
<html lang="en">
	<head>
  		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Login</title>
        <meta name="description" content="Custom Login Form Styling with CSS3" />
        <meta name="keywords" content="css3, login, form, custom, input, submit, button, html5, placeholder" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="<?php echo base_url();?>aset/img/fav.png">
		<link href="<?php echo base_url();?>aset/plugins/swal/sweetalert.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>aset/css/login.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>aset/css/loading.css" />
		<script src="<?php echo base_url();?>aset/js/jquery.js"></script>
		<script src="<?php echo base_url();?>aset/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>aset/js/modernizr.custom.63321.js"></script>
		<script src="<?php echo base_url();?>aset/plugins/swal/sweetalert.min.js"></script>
    </head>
    <body>
		<div class="loading">
			<div class="cssload-container">
				<div class="cssload-zenith"></div>
			</div>
 		</div>  
        <div class="container">
			<section class="main">
				<form method="post" id="form" class="form-3" action="<?php echo base_url();?>login/validasi">
				    <p class="clearfix">
				        <label for="email">Email : </label>
				        <input type="email" name="email" id="email" placeholder="Email" autofocus>
				    </p>
				    <p class="clearfix">
				        <label for="password">Password :</label>
				        <input type="password" name="password" id="password" placeholder="Password"> 
				    </p>
				    <p class="clearfix">
				        <input type="checkbox" name="remember" id="remember">
				        <label for="remember">Remember me</label>
				    </p>
				    <p class="clearfix">
				        <input type="submit" name="submit" value="Sign in">
				    </p>       
				</form>
			</section>
        </div>
		<script>


		</script>
    </body>
</html>