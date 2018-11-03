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
						var direcciones = <?= json_encode($list); ?>;
						console.log( direcciones );
						direcciones.forEach( function ( item, index ) {
							var contentString = '<div id="content">'+
							'<div id="siteNotice">'+
							'</div>'+
							'<h1 id="firstHeading" class="firstHeading">' + item.name + '</h1>'+
							'<div id="bodyContent">'+
							'<p>' + item.description + '</p>'+
							'</div>'+
							'</div>';
							var infowindow = new google.maps.InfoWindow({
								content: contentString
							});
							var posicion = {lat: item.lat *1 , lng: item.lng *1};
							var marker = new google.maps.Marker({
								position: posicion,
								map: map,
								title: 'Callao'
							});
							console.log( marker );
							marker.addListener('click', function() {
								infowindow.open(map, marker);
							});
						} );

					}
				</script>
				<script async defer src="https://maps.googleapis.com/maps/api/js?callback=initMap"> </script>
			</div>
		</div>
		<?php $this->load->view('footer')?>