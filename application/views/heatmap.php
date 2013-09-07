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
		<div id="map-canvas"></div>
		<div class="well controller map_controller">
			<span class='on_label pull-left'>HeatMap: </span>
			<div class="onoffswitch">
	    		<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" onclick="toggleHeatmap()">
	    		<label class="onoffswitch-label" for="myonoffswitch">
		        	<div class="onoffswitch-inner"></div>
		       		<div class="onoffswitch-switch"></div>
	    		</label>
			</div>
			<span class='on_label pull-left'>Friends: </span>
			<div class="onoffswitch">
	    		<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch2" onclick="" checked>
	    		<label class="onoffswitch-label" for="myonoffswitch2">
		        	<div class="onoffswitch-inner"></div>
		       		<div class="onoffswitch-switch"></div>
	    		</label>
			</div>
			<span class='on_label pull-left'>Facebook: </span>
			<div class="onoffswitch">
	    		<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch3" onclick="fb_mgr.toggle()" checked>
	    		<label class="onoffswitch-label" for="myonoffswitch3">
		        	<div class="onoffswitch-inner"></div>
		       		<div class="onoffswitch-switch"></div>
	    		</label>
			</div>
			<span class='on_label pull-left'>Twitter: </span>
			<div class="onoffswitch">
	    		<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch4" onclick="">
	    		<label class="onoffswitch-label" for="myonoffswitch4">
		        	<div class="onoffswitch-inner"></div>
		       		<div class="onoffswitch-switch"></div>
	    		</label>
			</div>
			<span class='on_label pull-left'>Instagram: </span>
			<div class="onoffswitch">
	    		<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch5" onclick="toggleHeatmap()">
	    		<label class="onoffswitch-label" for="myonoffswitch5">
		        	<div class="onoffswitch-inner"></div>
		       		<div class="onoffswitch-switch"></div>
	    		</label>
			</div>
		</div>
	</div>		
</div>


</body>
</html>