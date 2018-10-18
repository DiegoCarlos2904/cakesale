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
						var infowindow_1 = new google.maps.InfoWindow({
							content: contentString_1
						});
						var posicion_1 = {lat: -11.996333, lng: -77.120194};
						var marker_1 = new google.maps.Marker({
							position: posicion_1,
							map: map,
							title: 'Callao'
						});
						marker_1.addListener('click', function() {
							infowindow_1.open(map, marker_1);
						});


						var contentString_2 = '<div id="content">'+
						'<div id="siteNotice">'+
						'</div>'+
						'<h1 id="firstHeading" class="firstHeading">San martin de porres</h1>'+
						'<div id="bodyContent">'+
						'<p>La panederia se encuentra ubicado entre la avenida san juan macias con la avenida candada, en el distrito de San martin de porres.</p>'+
						'</div>'+
						'</div>';
						var infowindow_2 = new google.maps.InfoWindow({
							content: contentString_2
						});
						var posicion_2 = {lat: -11.973611, lng: -77.081694};
						var marker_2 = new google.maps.Marker({
							position: posicion_2,
							map: map,
							title: 'San martin de porres'
						});
						marker_2.addListener('click', function() {
							infowindow_2.open(map, marker_2);
						});


						var contentString_3 = '<div id="content">'+
						'<div id="siteNotice">'+
						'</div>'+
						'<h1 id="firstHeading" class="firstHeading">Los olivos</h1>'+
						'<div id="bodyContent">'+
						'<p>La panederia se encuentra ubicado entre la avenida san juan macias con la avenida candada, en el distrito de Los olivos.</p>'+
						'</div>'+
						'</div>';
						var infowindow_3 = new google.maps.InfoWindow({
							content: contentString_3
						});
						var posicion_3 = {lat: -11.995167, lng: -77.07675};
						var marker_3 = new google.maps.Marker({
							position: posicion_3,
							map: map,
							title: 'Los olivos'
						});
						marker_3.addListener('click', function() {
							infowindow_3.open(map, marker_3);
						});


						var contentString_4 = '<div id="content">'+
						'<div id="siteNotice">'+
						'</div>'+
						'<h1 id="firstHeading" class="firstHeading">Santa anita</h1>'+
						'<div id="bodyContent">'+
						'<p>La panederia se encuentra ubicado entre la avenida san <br> juan macias con la avenida candada, en el distrito de Santa anita.</p>'+
						'</div>'+
						'</div>';
						var infowindow_4 = new google.maps.InfoWindow({
							content: contentString_4
						});
						var posicion_4 = {lat: -12.050583, lng: -76.976167};
						var marker_4 = new google.maps.Marker({
							position: posicion_4,
							map: map,
							title: 'Santa anita'
						});
						marker_4.addListener('click', function() {
							infowindow_4.open(map, marker_4);
						});
						var contentString_5 = '<div id="content">'+
						'<div id="siteNotice">'+
						'</div>'+
						'<h1 id="firstHeading" class="firstHeading">La Molina</h1>'+
						'<div id="bodyContent">'+
						'<p>La panederia se encuentra ubicado entre la avenida san juan macias con la avenida candada, en el distrito de La Molina.</p>'+
						'</div>'+
						'</div>';
						var infowindow_5 = new google.maps.InfoWindow({
							content: contentString_5
						});
						var posicion_5 = {lat: -12.073722, lng: -76.952611};
						var marker_5 = new google.maps.Marker({
							position: posicion_5,
							map: map,
							title: 'Molina'
						});
						marker_5.addListener('click', function() {
							infowindow_5.open(map, marker_5);
						});
					}
				</script>
				<script async defer src="https://maps.googleapis.com/maps/api/js?callback=initMap"> </script>
			</div>
		</div>
		<?php $this->load->view('footer')?>