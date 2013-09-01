<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit User Information</title>
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css"/>
	<script type="text/javascript" src="/assets/js/bootstrap.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
</head>
<body>

<div class="container">

<?php 

	$errors = $this->session->flashdata('errors');
	$message = $this->session->flashdata('message');
	if ($errors) {
		echo 	"<div class='alert alert-warning'>
					$errors
				</div>";
	}
	else if ($message) 
	{
		echo 	"<div class='alert alert-success'>
					$message
				</div>";
	}
?>

	<div class="row">
		<h2>Edit User</h2>
		<div class="col-lg-4 col-lg-offset-4">
			<div class="well">
				<h4>Edit Information</h4>
				<?php echo form_open('/users/process_edit'); ?>
					<label>Email Address:</label>
					<input class="form-control" type="text" name="email" placeholder=<?= '';//$email; ?>><br/>
					<label>First Name:</label>
					<input class="form-control" type="text" name="first_name" placeholder=<?= '';//$first_name; ?>><br/>
					<label>Last Name:</label>
					<input class="form-control" type="text" name="last_name" placeholder=<?= '';//$last_name; ?>><br/>
					<input type="hidden" name="user_id" value=<?= '';//$user_id; ?>>
					<input type="hidden" name="edit" value="profile">
					<input type="hidden" name="info" value="TRUE">
					<button class="btn btn-primary" type="submit">Save</button>
				</form>
			</div>
		</div>
		<div class="col-lg-4 col-lg-offset-4">
			<div class="well">
				<h4>Change Password</h4>
				<?php echo form_open('/users/process_edit'); ?>
					<label>Password:</label>
					<input class="form-control" type="password" name="password" placeholder="Password"/><br/>
					<label>Last Name:</label>
					<input class="form-control" type="password" name="confirm_pass" placeholder="Confirm Password"/><br/>
					<input type="hidden" name="user_id" value=<?= '';//$user_id; ?>>
					<input type="hidden" name="pass" value="TRUE">
					<input type="hidden" name="edit" value="profile">
					<button class="btn btn-primary" type="submit">Update Password</button>
				</form>
			</div>
		</div>
	</div>
	<img class='logo pull-right' src="/assets/images/logo.png" alt="Logo"/>
</div>

</body>
</html>