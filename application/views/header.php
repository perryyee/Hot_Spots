<?php  
	include (APPPATH.'libraries/facebook/facebook.php');
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $title; ?></title>
	 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	 <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	 <script type="text/javascript" src="/assets/js/bootstrap.js"></script>
<?php
	if(isset($page))
	{
		if ($page == 'modal')
		{
?>	
		<script type="text/javascript" src="/assets/js/spin.js"></script>
		<script>
			$(document).ready(function(){
				$('.topspots').on('click', function(){
					$('#modal_pic').attr('src', $(this).attr('src'));
				});

				$('#update_but').on('click', function(){
					$('#update_fb').modal();
				});
				
				$('#fb_form').submit(function(){
					$(this).parent().html('<p>Please Wait...</p><div id="info"></div><br/><br/><br/><p>This make take a few moments.</p>');
					var new_html = '';
					var opts = {
					  lines: 13, // The number of lines to draw
					  length: 10, // The length of each line
					  width: 3, // The line thickness
					  radius: 10, // The radius of the inner circle
					  corners: 1, // Corner roundness (0..1)
					  rotate: 0, // The rotation offset
					  direction: 1, // 1: clockwise, -1: counterclockwise
					  color: '#000', // #rgb or #rrggbb or array of colors
					  speed: 1, // Rounds per second
					  trail: 40, // Afterglow percentage
					  shadow: false, // Whether to render a shadow
					  hwaccel: false, // Whether to use hardware acceleration
					  className: 'spinner', // The CSS class to assign to the spinner
					  zIndex: 2e9, // The z-index (defaults to 2000000000)
					  top: '3px', // Top position relative to parent in px
					  left: 'auto' // Left position relative to parent in px
					};

					var target = document.getElementById('info');
					var spinner = new Spinner(opts).spin(target);

					$.post(
						$(this).attr('action'),
						$(this).serialize(),
						function(data) {
							if(data.outcome=='Success')
							{
								$('#info').parent().html('<br/><p>Thank you for your patience. Synchronization to Facebook has completed, enjoy!</p><a href="/heatmap"><button type="button" class="btn btn-primary">Explore!</button></a> <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>');
							}
						},
						"json"
					);
					return false;
				});
				
				if($('#first_login').val()==1) 
				{
					$('#first_time').modal();
				}
			});
		</script>
<?php  
		}
		else if ($page == 'heatmap')
		{
?>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2BJLwf7VA7ZTLyZQlGkA-FL6bBKOeFdA&libraries=visualization&sensor=true"></script>
		<script>
			(document).onkeypress = function keypressed(e){
			  	if (e.keyCode == 13) {
			      	codeAddress();
			  	}      
			}
		</script>
		<script>
			var map, pointarray, heatmap, geocoder;
			google.maps.visualRefresh = true;
			
			function initialize() {
				geocoder = new google.maps.Geocoder();
			  	var mapOptions = {
			    	zoom: 10,
			    	center: new google.maps.LatLng(37.755, -122.443),
			    	mapTypeId: google.maps.MapTypeId.ROADMAP
			  	};
			  	if (document.getElementById('location').value!='') 
			  	{
			  		codeAddress();
			  	}
			  	map = new google.maps.Map(document.getElementById('map-canvas'),
			    	mapOptions);

			  	var pointArray = new google.maps.MVCArray(heat_data);
			  	heatmap = new google.maps.visualization.HeatmapLayer({
   					data: pointArray,
   					radius: 30
   				});

   				heatmap.setMap(map);
   				toggleHeatmap();

			  	setMarkers(map, checkins);
			}

			function toggleHeatmap() {
				heatmap.setMap(heatmap.getMap() ? null : map);
			}

			function codeAddress() {
  				var address = document.getElementById('location').value;
  				geocoder.geocode( { 'address': address}, function(results, status) {
	    			if (status == google.maps.GeocoderStatus.OK) {
	      				map.setCenter(results[0].geometry.location);
	    			} 
	    			else 
	    			{
	      				alert('Error: ' + status + '\n\nPlease provide a legitimate location.');
	    			}
 				});
			}

			/**
			* Data for the markers consisting of a name, a LatLng and a zIndex for
			* the order in which these markers should display on top of each
			* other.
			*/
			var checkins = <?= $markers; ?>;
			var heat_data = [];
			// var heat_data = <?= $heat_points; ?>;
			for(var i=0; i<checkins.length; i++)
			{
				heat_data.push({location: new google.maps.LatLng(checkins[i][1], checkins[i][2]), weight: 1})
			}
				// format of array
				// [ ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
				//   ['Maroubra Beach', -33.950198, 151.259302, 1] ];

			var infowindow = new google.maps.InfoWindow();

			function setMarkers(map, locations) {
				// Add markers to the map

			 	// Marker sizes are expressed as a Size of X,Y
			  	// where the origin of the image (0,0) is located
			  	// in the top left of the image.

			  	// Origins, anchor positions and coordinates of the marker
			  	// increase in the X direction to the right and in
			  	// the Y direction down.
			  	var image = {
				    url: '/assets/images/fb_gmap.png',
				    // This marker is 20 pixels wide by 32 pixels tall.
				    size: new google.maps.Size(20, 32),
				    // The origin for this image is 0,0.
				    origin: new google.maps.Point(0,0),
				    // The anchor for this image is the base of the flagpole at 0,32.
				    anchor: new google.maps.Point(0, 32)
			  	};
			  // 	var shadow = {
				 //    url: '/assets/images/fb_gmaps.png',
				 //    // The shadow image is larger in the horizontal dimension
				 //    // while the position and offset are the same as for the main image.
				 //    size: new google.maps.Size(37, 32),
				 //    origin: new google.maps.Point(0,0),
				 //    anchor: new google.maps.Point(0, 32)
			 	// };
			  	// Shapes define the clickable region of the icon.
			  	// The type defines an HTML &lt;area&gt; element 'poly' which
			  	// traces out a polygon as a series of X,Y points. The final
			  	// coordinate closes the poly by connecting to the first
			  	// coordinate.

			  	var shape = {
			      	coord: [1, 1, 1, 20, 18, 20, 18 , 1],
			      	type: 'poly'
			  	};
			  	for (var i = 0; i < locations.length; i++) {
			    	var checkin = locations[i];
			    	var myLatLng = new google.maps.LatLng(checkin[1], checkin[2]);
			    	var marker = new google.maps.Marker({
				        position: myLatLng,
				        map: map,
				        icon: image,
				        shape: shape,
				        title: checkin[0],
				        content: checkin[4],
				        zIndex: parseInt(checkin[3])
			    	});
			    	// marker.content =  checkin[0]
			    	google.maps.event.addListener(marker, 'click', (function(marker,i) {
			    		return function() {
			    			infowindow.close()
			    			infowindow.setContent(marker.content)
			    			infowindow.open(map,marker);
			    		}
			    	})(marker,i));
			  	}
			}
			//initializes the map
			google.maps.event.addDomListener(window, 'load', initialize);
			
			//Dynanimcally changes the size of the screen
			$(function(){
	    		$('.feed').css({'height':(($(window).height())-40)+'px'});
	    		$('#map-container').css({'height':(($(window).height())-40)+'px'});
	    		var width = $('#map-container').css('width');
	    		$('.map_controller').css({'left':((parseInt(width)-650)/2)+'px'});

	    		$(window).resize(function(){
	          		$('.feed').css({'height':(($(window).height())-40+'px')});
	          		$('#map-container').css({'height':(($(window).height())-40+'px')});
	          		var width = $('#map-container').css('width');
	    			$('.map_controller').css({'left':((parseInt(width)-650)/2)+'px'});
	    		});
			});
		</script>
<?php 
		}
	}
?>
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css"/>
</head>
<body>

<?php  
	if($this->session->userdata['account']=='facebook')
		{
			$ci =& get_instance();
			$ci->config->load('facebook', TRUE);
			$config = $ci->config->item('facebook');
			$facebook = new Facebook($config);
			$logout_url = $facebook->getLogoutUrl(array("next"=>base_url('main/logout/')));
		}
		else
		{
			$logout_url = base_url('main/logout/');
		}
?>
	<nav class="navbar navbar-inverse" role="navigation">
		<div class="container">
			<div class="row navcontent">
				<div class="col-lg-2">
					<a class="pull-left" href="/topspots"><img id='nav_logo' src="/assets/images/logo_2.png" alt="Logo"></a>
				</div>
				<div class="col-lg-8">
					<div class= 'form-inline navform'>
						<div class="form-group">
<?php 	
	if (isset($page) && $page!='heatmap') 
	{
   	   	  		   			echo form_open('/main/process_heatmap', array('class' => 'text-center'));
   	}
?>
								<input class='form-control smaller' name='address' type="text" id="location" value = '<?= $this->session->userdata['address'];?>' >
								<select class='form-control smallest' name='location_choice'>
									<option value="city">City, State</option>
									<option value="zip">Zip Code</option>
								</select>
								<input class='form-control smaller' type="text">
								<select class='form-control smallest' name='Time'>
									<option value="hours">Hours</option>
									<option value="days">Days</option>
									<option value="week">Weeks</option>
								</select>
								<button class='glyph btn btn-default linkbut' onclick='codeAddress()'><i class="icon-search icon-1x"></i></button>
<?php 	if (isset($page) && $page!='heatmap') 
		{ 
?>
							</form>
<?php  
		}
?>
						</div>
					</div>
				</div>
				<div class="col-lg-2">
					<div class="dropdown pull-right">
						<a class="glyph2 pull-right" href="javascript:;" data-toggle="dropdown"><i class="icon-cog"></i></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
					    	<li role="presentation"><a role="menuitem" tabindex="-1" href="/users/edit">Settings</a></li>
					    	<li role="presentation" class="divider"></li>
					    	<li role="presentation"><a role="menuitem" tabindex="-1" href=<?= $logout_url; ?>>Logout</a></li>
					  	</ul>
					</div>
				
					<div class="dropdown pull-right">
						<a class="glyph2 pull-right" href="javascript:;" data-toggle="dropdown"><i class="icon-globe"></i></a>
					  	<ul class="dropdown-menu menu2" role="menu" aria-labelledby="dropdownMenu2">
					    	<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;">Jeremy checked into...</a></li>
					    	<li role="presentation" class="divider"></li>
					    	<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;">Sue tweeted about...</a></li>
					    	<li role="presentation" class="divider"></li>
					    	<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;">Ken posted a picture...</a></li>
					    	<li role="presentation" class="divider"></li>
					    	<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;">Jennifer checked into...</a></li>
					    	<li role="presentation" class="divider"></li>
					    	<li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;">Emma posted a picture...</a></li>
					    	<li role="presentation" class="divider"></li>
					    	<li class="text-center" role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;">See All Activity...</a></li>
					  	</ul>
					</div>
					<span class='nav-name pull-right'><?= $this->session->userdata['user_session']['first_name']; ?></span>
				</div>
			</div>
		</div>
	</nav>
