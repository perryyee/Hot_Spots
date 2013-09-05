<div class="container">
	<div id="results"></div>
	<div class="row">
		<h1 class="text-center">Top Spots of the Week</h1>
		<div class="col-lg-12">
			<div id="toppics">
				<a data-toggle="modal" href="#myModal"><img class="topspots" src="/assets/images/deyoung.jpg" alt="Top Pick1"></a>
				<a data-toggle="modal" href="#myModal"><img class="topspots" src="/assets/images/twinpeaks.jpg" alt="Top Pick2"></a>
				<a data-toggle="modal" href="#myModal"><img class="topspots" src="/assets/images/umami.jpg" alt="Top Pick3"></a>
				<a data-toggle="modal" href="#myModal"><img class="topspots" src="/assets/images/rubyskye.jpg" alt="Top Pick4"></a>
				<a data-toggle="modal" href="#myModal"><img class="topspots" src="/assets/images/alcatraz.jpg" alt="Top Pick5"></a>
				<a data-toggle="modal" href="#myModal"><img class="topspots" src="/assets/images/chinatown.jpg" alt="Top Pick6"></a>
			</div>
			<img class='logo pull-right' src="/assets/images/logo.png" alt="Logo"/>
		</div>
	</div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        	<div class="modal-body">
	        	<img class = 'pull-left' id='modal_pic' src="/assets/images/deyoung.jpg" alt="Top Pick1"/>
	        	<div id = 'topspot_info'>
	        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        		<h3>de Young Museum</h3><br/> <!--Title -->
	        		<p>50 Hagiwara Tea Garden Drive<br/>
	        		San Francisco, CA 94118<br/><!-- Address -->
					(415) 750-3600<br/><!-- Phone Number -->
					<a href='javascript:;'>famsf.org</a></p><br/><!-- Website -->
					<p>Located in Golden Gate Park, the city's oldest art museum (founded in 1895) in an undulating, copper-clad building that affords views of the city via its 144-ft-tall observation tower; its collection includes fine and decorative arts as well as sculpture, textiles, crafts and installation pieces...<a href='javascript:;'>Read More</a></p><br/><br/><br/><!--Info -->
					<a href='javascript:;'>See All Reviews</a>
	        	</div>
        	</div>
        </div>
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

<div class="modal2 fade" id="first_time" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal2-dialog">
        <div class="modal2-content">
        	<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h3 class="modal-title text-center">First Facebook Login</h3>
		    </div>
        	<div class="modal2-body modal_info">
        		<input id='first_login' type="hidden" name='first_time' value= <?= $this->session->userdata['user_session']['first_time']; ?> >
        		<img src="/assets/images/facebook.png" alt="Facebook" class="pull-left fb_logo">
	        	<p>We noticed this is your first time logging in with Facebook. We encourage you to discover your friends' checkins.</p>
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