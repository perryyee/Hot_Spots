
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
				<h4 class='text-center'>Edit Information</h4>
				<?php echo form_open('/users/process_edit'); ?>
					<label>Email Address:</label>
					<input class="form-control" type="text" name="email" placeholder=<?= $this->session->userdata['user_session']['email']; ?>><br/>
					<label>First Name:</label>
					<input class="form-control" type="text" name="first_name" placeholder=<?= $this->session->userdata['user_session']['first_name']; ?>><br/>
					<label>Last Name:</label>
					<input class="form-control" type="text" name="last_name" placeholder=<?= $this->session->userdata['user_session']['last_name']; ?>><br/>
					<input type="hidden" name="user_id" value=<?= '';//$user_id; ?>>
					<input type="hidden" name="edit" value="profile">
					<input type="hidden" name="info" value="TRUE">
					<button class="btn btn-primary" type="submit">Save</button>
				</form>
			</div>
		</div>
		<div class="col-lg-4 col-lg-offset-4">
			<div class="well">
				<h4 class='text-center'>Change Password</h4>
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
	<div class="col-lg-4 col-lg-offset-4">
			<div class="well text-center">
				<h4>Update Facebook Information</h4>
				<p>If you would like to update your facebook checkin information. Please Click the button below.</p>
				<button class="btn btn-primary" id="update_but" type="submit">Update</button>
			</div>
		</div>
	</div>
	<img class='logo pull-right' src="/assets/images/logo.png" alt="Logo"/>
</div>

<div class="modal2 fade" id="update_fb" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal2-dialog">
        <div class="modal2-content">
        	<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h2 class="modal-title text-center">FB Checkin Update</h2>
		    </div>
        	<div class="modal2-body modal_info">
        		<img src="/assets/images/facebook.png" alt="Facebook" class="pull-left fb_logo">
	        	<p>Are you sure you want to update your hotspots?</p>
<?php  
			   echo form_open('/checkins/add_checkins', array('id' => 'fb_form'));
?>
					<button type="submit" class="btn btn-primary spin_but">Accept</button>
	        		<button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
        		</form>
        	</div>
        </div>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</body>
</html>