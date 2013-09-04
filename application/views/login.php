<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>HotSpots | Login</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css"/>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/assets/js/bootstrap.js"></script>
	<script type="text/javascript"></script>
	<script>
		$(function(){
    		$('.window_resize').css({'height':((($(window).height())-375)/2)+'px'});
    		$(window).resize(function(){
          		$('.window_resize').css({'height':((($(window).height())-375)/2)+'px'});
    		});
		});
		$(document).ready(function(){
			$('#loading_but').click(function () {
		        var btn = $(this)
		        btn.button('loading');
   			});
		});

	</script>
</head>
<body class="login_back">
<div class="container">
<?php 
	$errors = $this->session->flashdata('errors');
	$message = $this->session->flashdata('message');

	if ($errors) {
		echo 	"<div class='alert alert-warning alert-dismissable'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					$errors
				</div>";
	}
	if ($message) {
		echo 	"<div class='alert alert-success alert-dismissable'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					$message
				</div>";
	}
?>	
	<div class="window_resize"></div>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<div class="well login">
				<img class="text-center"src="/assets/images/logo.png" alt="Logo"/>
<?php 	   echo form_open('/users/process_login'); ?>
					<input class="form-control" type="text" name="username" placeholder="Username"/><br/>
					<input class="form-control" type="password" name="password" placeholder="Password"/><br/>
					<button class="btn btn-primary pull-right" type="submit">Login</button>
					<div class="clear"></div>
					<a href="/register">Don't have an account? Register here.</a><br/>
				</form>
				<p>OR</p>
<?php      echo form_open('/users/facebook_request'); ?>					
					<button type="submit" data-loading-text="Logging In..." class="btn btn-default" id='loading_but'><img class='fb_login' src="/assets/images/facebook.png" alt="Facebook"/>Login with Facebook</button>
					
				</form>
			</div>
			
		</div>
	</div>
</div>


</body>
</html>