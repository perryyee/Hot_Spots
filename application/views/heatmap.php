<!doctype html>
<?php 	 
	//automaticaly generate the 10 latest data inputs, for now Facebook Checkins
?>
<div class="row no-margins">
	<div class="col-lg-2 no-margins">
		<div class="row well feed list-group no-margins" >
			<h3 class='text-center'>Recent Activity</h3>
<?php  
			echo $feed;
?>
		</div>
	</div>
	<div class="col-lg-10 col-lg-offset-2 no-margins" id="map-container">
		<div id="map-canvas">
		</div>
	</div>		
</div>


</body>
</html>