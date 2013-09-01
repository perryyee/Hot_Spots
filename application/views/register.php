<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>HotSpots | Register</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css"/>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<script type="text/javascript" src="/assets/js/bootstrap.js"></script>
</head>
<body class="register_back">

<div class="container">
<?php 
	$errors = $this->session->flashdata('errors');
	$message = $this->session->flashdata('message');

	if ($errors) {
		echo 	
	   "<div class='alert alert-warning alert-dismissable'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
			$errors
		</div>";
	}
	if ($message) {
		echo 	
		"<div class='alert alert-success'>
			$message
		</div>";
	}
?>	
		<div class="row register_center">
			<div class="col-lg-4 col-lg-offset-4">
				<div class="well register">
						<h2>Register</h2>
<?php echo form_open('/users/process_register'); ?>
						<input class="form-control" type="text" name="first_name" placeholder="First Name"/><br/>
						<input class="form-control" type="text" name="last_name" placeholder="Last Name"/><br/>
						<input class="form-control" type="text" name="email" placeholder="Email"/><br/>
						<input class="form-control" type="text" name="username" placeholder="Username"/><br/>
						<input class="form-control" type="password" name="password" placeholder="Password"/><br/>
						<input class="form-control" type="password" name="confirm_pass" placeholder="Confirm Password"/><br/>
						<button class="btn btn-primary pull-right" type="submit">Register</button>
					</form>
					<div class="clear"></div>
					<a href=<?= base_url() ?>>Already have an account? Login here.</a>
				</div>
			</div>
		</div>
	</div>
</div>


</body>
</html>