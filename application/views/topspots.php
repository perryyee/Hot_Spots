<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>HotSpots | TopSpots</title>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css"/>
	<script type="text/javascript" src="/assets/js/bootstrap.js"></script>
	<script>
		$(document).ready(function(){
			$('.topspots').on('click', function(){
				$('#modal_pic').attr('src', $(this).attr('src'));
			});

			$('#first_time').modal();
		});
	</script>
</head>
<body>

<div class="container">

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
		        <h3 class="modal-title">First Time Facebook Login</h3>
		    </div>
        	<div class="modal2-body">
        		<img src="/assets/images/facebook.png" alt="Facebook" class="pull-left fb_logo">
	        	<p>We noticed this is your first time logging in with Facebook. We encourage you to discover your friends' checkins.</hp><br/><br/>
				<a href="/checkins/add_checkins"><button type="button" class="btn btn-primary">Accept</button></a>
        		<button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
        	</div>
        </div>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


</body>
</html>