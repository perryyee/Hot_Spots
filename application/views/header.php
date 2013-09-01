<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $title; ?></title>
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css"/>
	<script type="text/javascript" src="/assets/js/bootstrap.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-inverse" role="navigation">
		<div class="container">
			<div class="navcontent">
			
				<a class="glyph pull-left" href="/topspots"><i class="icon-home icon-2x"></i></a>
				<div class="dropdown pull-right">
					<a class="glyph2 pull-right" href="javascript:;" data-toggle="dropdown"><i class="icon-cog"></i></a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
				    	<li role="presentation"><a role="menuitem" tabindex="-1" href="/users/edit">Settings</a></li>
				    	<li role="presentation" class="divider"></li>
				    	<li role="presentation"><a role="menuitem" tabindex="-1" href="/main/logout">Logout</a></li>
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
<?php 	
   	   	   echo form_open('Heatmap/process',array('class' => 'form-inline navform'));
?>		
					<div class="row">
						<div class="col-lg-8 col-lg-offset-2 nav-form">
							<input class='form-control smaller' type="text" name="location">
							<select class='form-control smallest' name='location'>
								<option value="city">City</option>
								<option value="zip">Zip Code</option>
							</select>
							<input class='form-control smaller' type="text">
							<select class='form-control smallest' name='Time'>
								<option value="hours">Hours</option>
								<option value="days">Days</option>
								<option value="week">Weeks</option>
							</select>
							<button class='glyph linkbut' type="submit"><i class="icon-search icon-1x"></i></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</nav>
</body>
</html>