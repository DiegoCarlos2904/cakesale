<?php 
	if( $this->input->post('is_submitted') ) {
		$name			= set_value('name');
		$lng			= set_value('lng');
		$lat			= set_value('lat');
		$description			= set_value('description');
	} else {
		$name			= '';
		$description			= '';
		$lat			= '';
		$lng			= '';
	}
?>
		<?php $this->load->view('admin/header')?>
		<script async defer src="https://maps.googleapis.com/maps/api/js?callback=initMap"> </script>
		<div class="form-signin">
			<h3 class="h3 mb-3  font-weight-normal"> Regsitrar Ubicación </h3>
			<?php if( isset($errors) ): ?>
				<div class="alert alert-danger text-left">
					<?php print_r($errors); ?>
				</div>
			<?php endif ?>
			<?=	form_open_multipart('',['data-toggle'=>"validator", 'class'=>'']) ?>
				<div class="form-group">
					<label for="name">Nombre</label> 
					<input value="<?= $name ?>" data-required-error="Ingrese un nombre" id="name" name="name" type="text" class="form-control" required="required">
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<label for="name">Descripción</label> 
					<textarea data-required-error="Ingrese una descripción" name="description" class="form-control" required="required" id="description" cols="30" rows="5"><?= $description ?></textarea>
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<div id="map" class="mb-4"></div>
					<style>
						#map {
							height: 260px;
						}
					</style>
					<script>
						function initMap() {
							var myLatlng = {lat: -12.0552477, lng: -77.0802422};

							var map = new google.maps.Map(document.getElementById('map'), {
								zoom: 13,
								center: myLatlng
							});

							var marker;

							google.maps.event.addListener(map, 'click', function(event) {
							   placeMarker(event.latLng);
							});

							function placeMarker(location) {
								if( marker == null ) {
									marker = new google.maps.Marker({
										position: location, 
										map: map
									});
								} else {
									marker.setPosition( location );
								}
								document.getElementById('lat').value= location.lat();
								document.getElementById('lng').value= location.lng();
							}
						}
					</script>
					<input value="<?= $lat ?>" id="lat" class="form-control" data-required-error="Debes seleccionar un punto en el mapa" name="lat" type="hidden" required="required">
					<input value="<?= $lng ?>" id="lng" class="form-control" name="lng" type="hidden" required="required">
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<input type="hidden" name="is_submitted" value="1">
					<button type="submit" class="btn btn-primary">Editar</button>
					<a href="<?= base_url( 'admin/ubicaciones' ) ?>" class="btn btn-danger">Cancelar</a>
				</div>
			<?= form_close() ?>
		</div>
		<?php $this->load->view('admin/footer')?>