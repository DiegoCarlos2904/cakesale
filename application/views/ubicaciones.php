		<?php $this->load->view('header')?>
		<div class="row">
			<div class="col-12">
				<div class="embed-responsive embed-responsive-16by9">
					<div id="map" class="embed-responsive-item"></div>
				</div>
				<script>
					function initMap() {
						var uluru = {lat: -12.0552477, lng: -77.0802422};
						var map = new google.maps.Map(document.getElementById('map'), {
							zoom: 12,
							center: uluru
						});
						var contentString_1 = '<div id="content">'+
						'<div id="siteNotice">'+
						'</div>'+
						'<h1 id="firstHeading" class="firstHeading">Callao</h1>'+
						'<div id="bodyContent">'+
						'<p>La panederia se encuentra ubicado entre la avenida san juan macias con la avenida candada, en el distrito del Callao.</p>'+
						'</div>'+
						'</div>';
						var contentString_2 = '<div id="content">'+
						'<div id="siteNotice">'+
						'</div>'+
						'<h1 id="firstHeading" class="firstHeading">San martin de porres</h1>'+
						'<div id="bodyContent">'+
						'<p>La panederia se encuentra ubicado entre la avenida san juan macias con la avenida candada, en el distrito de San martin de porres.</p>'+
						'</div>'+
						'</div>';
						var contentString_3 = '<div id="content">'+
						'<div id="siteNotice">'+
						'</div>'+
						'<h1 id="firstHeading" class="firstHeading">Los olivos</h1>'+
						'<div id="bodyContent">'+
						'<p>La panederia se encuentra ubicado entre la avenida san juan macias con la avenida candada, en el distrito de Los olivos.</p>'+
						'</div>'+
						'</div>';
						var contentString_4 = '<div id="content">'+
						'<div id="siteNotice">'+
						'</div>'+
						'<h1 id="firstHeading" class="firstHeading">Santa anita</h1>'+
						'<div id="bodyContent">'+
						'<p>La panederia se encuentra ubicado entre la avenida san <br> juan macias con la avenida candada, en el distrito de Santa anita.</p>'+
						'</div>'+
						'</div>';
						var contentString_5 = '<div id="content">'+
						'<div id="siteNotice">'+
						'</div>'+
						'<h1 id="firstHeading" class="firstHeading">La Molina</h1>'+
						'<div id="bodyContent">'+
						'<p>La panederia se encuentra ubicado entre la avenida san juan macias con la avenida candada, en el distrito de La Molina.</p>'+
						'</div>'+
						'</div>';
						var infowindow_1 = new google.maps.InfoWindow({
							content: contentString_1
						});
						var infowindow_2 = new google.maps.InfoWindow({
							content: contentString_2
						});
						var infowindow_3 = new google.maps.InfoWindow({
							content: contentString_3
						});
						var infowindow_4 = new google.maps.InfoWindow({
							content: contentString_4
						});
						var infowindow_5 = new google.maps.InfoWindow({
							content: contentString_5
						});
						var posicion_1 = {lat: -11.996333, lng: -77.120194};
						var posicion_2 = {lat: -11.973611, lng: -77.081694};
						var posicion_3 = {lat: -11.995167, lng: -77.07675};
						var posicion_4 = {lat: -12.050583, lng: -76.976167};
						var posicion_5 = {lat: -12.073722, lng: -76.952611};
						var marker_1 = new google.maps.Marker({
							position: posicion_1,
							map: map,
							title: 'Callao'
						});
						marker_1.addListener('click', function() {
							infowindow_1.open(map, marker_1);
						});
						var marker_2 = new google.maps.Marker({
							position: posicion_2,
							map: map,
							title: 'San martin de porres'
						});
						marker_2.addListener('click', function() {
							infowindow_2.open(map, marker_2);
						});
						var marker_3 = new google.maps.Marker({
							position: posicion_3,
							map: map,
							title: 'Los olivos'
						});
						marker_3.addListener('click', function() {
							infowindow_3.open(map, marker_3);
						});
						var marker_4 = new google.maps.Marker({
							position: posicion_4,
							map: map,
							title: 'Santa anita'
						});
						marker_4.addListener('click', function() {
							infowindow_3.open(map, marker_4);
						});
						var marker_4 = new google.maps.Marker({
							position: posicion_5,
							map: map,
							title: 'Molina'
						});
						marker_4.addListener('click', function() {
							infowindow_3.open(map, marker_4);
						});
					}
				</script>
				<script async defer src="https://maps.googleapis.com/maps/api/js?callback=initMap"> </script>
				<!--<div class="embed-responsive embed-responsive-16by9">
					<iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3902.684285990793!2d-77.1223936858255!3d-11.996333991500945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTHCsDU5JzQ2LjgiUyA3N8KwMDcnMTIuNyJX!5e0!3m2!1ses-419!2spe!4v1539835839014" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
				<div class="embed-responsive embed-responsive-16by9">
					<iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3903.012806467151!2d-77.08387968582583!3d-11.973614991516074!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTHCsDU4JzI1LjAiUyA3N8KwMDQnNTQuMSJX!5e0!3m2!1ses-419!2spe!4v1539836410558" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
				<div class="embed-responsive embed-responsive-16by9">
					<iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3902.7012771797827!2d-77.07803939962822!3d-11.995159996995406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTHCsDU5JzQyLjYiUyA3N8KwMDQnMzYuMyJX!5e0!3m2!1ses-419!2spe!4v1539836531852" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
				<div class="embed-responsive embed-responsive-16by9">
					<iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.8972965400208!2d-76.9783416858249!3d-12.050586991464758!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTLCsDAzJzAyLjEiUyA3NsKwNTgnMzQuMiJX!5e0!3m2!1ses-419!2spe!4v1539836600555" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
				<div class="embed-responsive embed-responsive-16by9">
					<iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.560710879235!2d-76.95391339962788!3d-12.073716996976874!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTLCsDA0JzI1LjQiUyA3NsKwNTcnMDkuNCJX!5e0!3m2!1ses-419!2spe!4v1539836672747" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe> 
				</div>-->
			</div>
		</div>
		<?php $this->load->view('footer')?>